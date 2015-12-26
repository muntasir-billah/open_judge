<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Contest extends OJ_Controller {

	public $module = 'user';	// defines the module
	public $template = 'AdminLTE-2.3.0';	// Current Template Name
	public $viewpath = '';
    public $subview = 'contest';
	//========================
	public $data = array();

	function __construct()
    {
        parent::__construct();

        $this->__security($this->module);

        $this->load->model($this->module."/m_".$this->module);

        $this->viewpath = $this->module.'/'.$this->template.'/';	// Creating the Path
        $this->data['fullpath'] = base_url().'view/'.$this->viewpath;;
        $this->data['title'] = $this->config->item('title');
        $this->data['module'] = $this->module;
        $this->data['verdict'] = $this->verdict;
        $this->data['verdict_class'] = $this->verdict_class;
    }
    //====================================//

    public function index()
    {
    	$data = $this->data;
    	$data['title'] .= 'Contests';

        // Page CSS Files
        $data['page_css'] = array();

        // Page JS Scripts
        $data['page_scripts'] = array();

        $data['contests'] = $this->m_user->get_all_contests($this->session->user_id);

    	$data['content'] = $this->subview.'/v_all_contests.php';
    	$this->load->view($this->viewpath.'v_main', $data);
    }

    public function view_contest() {
        if(isset($_GET['contest_id'])) $contest_id = $_GET['contest_id'];
        else redirect(base_url($this->module.'/'.$this->subview));

        $data = $this->data;

        // Page CSS Files
        $data['page_css'] = array();

        // Page JS Scripts
        $data['page_scripts'] = array('js_table_tools.php', 'js_view_contest.php');

        if(!$data['contest'] = $this->m_user->get_single_contest($contest_id)) {
            redirect(base_url('four'));
        }

        if(!$this->__check_access($contest_id, $this->session->user_id)) {
            redirect(base_url($this->module.'/'.$this->subview));
        }

        // Fetching Submissions
        $data['users'] = array();
        $data['submissions'] = $this->m_user->get_sub_for_contest($contest_id);

        foreach($data['submissions'] as $key => $sub) {
            if(!isset($data['users'][$sub->user_id])) {
                $temp_user = $this->m_user->get_user($sub->user_id);
                $data['users'][$sub->user_id] = $temp_user->user_name;
            }
        }

        // Fetching Clarifications
        $data['clarifications'] = $this->m_user->get_clar_for_contest($contest_id);

        foreach($data['clarifications'] as $key => $clar) {
            if($clar->user_id != NULL && !isset($data['users'][$clar->user_id])) {
                $temp_user = $this->m_user->get_user($clar->user_id);
                $data['users'][$clar->user_id] = $temp_user->user_name;
            }
        }

        // Others
        $data['count'] = $this->m_user->get_prob_cont_count($contest_id);

         
        $prob_cont_rel = $this->m_admin->get_prob_cont_rel_for_cont($contest_id);
        $prob_tried_solved = array();
        foreach($prob_cont_rel as $key => $rel) {
            $prob_tried_solved[$rel->problem_id] = array();
            $prob_tried_solved[$rel->problem_id]['tried'] = $rel->prob_cont_tried;
            $prob_tried_solved[$rel->problem_id]['solved'] = $rel->prob_cont_solved;
        }

        $data['prob_tried_solved'] = $prob_tried_solved;


        $data['ranklist'] = $this->m_user->get_ranklist($contest_id);

        $data['title'] .= $data['contest']->contest_name;

        $data['nos'] = array();
        $no = 'A';

        $data['problems'] = $this->m_user->probs_for_contest($data['contest']->contest_id);

        foreach($data['problems'] as $key => $problem) {
            $data['nos'][$problem->problem_id] = $no++;

            if($data['problems'][$key]->problem_time_limit >= 1000) {
                $data['problems'][$key]->problem_time_limit /= 1000;
                $data['problems'][$key]->problem_time_limit .= 's';
            }
            else $data['problems'][$key]->problem_time_limit .= 'ms';

            if($data['problems'][$key]->problem_memory_limit >= 1024) {
                $data['problems'][$key]->problem_memory_limit /= 1024;
                $data['problems'][$key]->problem_memory_limit .= ' MB';
            }
            else $data['problems'][$key]->problem_memory_limit .= ' KB';
        }

        $data['content'] = $this->subview.'/v_view_contest.php';
        $this->load->view($this->viewpath.'v_main', $data);
    }

    public function submit() {

        $user_id = $this->session->user_id;
        $contest_id = $_POST['contest_id'];


        if(!$contest = $this->m_user->get_single_contest($contest_id)) {
            redirect(base_url('four'));
        }

        if(!$this->__check_access($contest_id, $user_id)) {
            echo 'You have not access to this contest';
            exit();
        }

        if(!$this->__is_running($contest_id)) {
            $url = base_url($this->module.'/contest/view_contest?contest_id='.$contest_id);
            redirect($url);
        }

        $submission = array();

        $submission['problem_id'] = $_POST['problem_id'];
        $submission['contest_id'] = $_POST['contest_id'];
        $submission['submission_source'] = $_POST['submission_source'];
        $submission['language_id'] = $_POST['language_id'];
        $submission['user_id'] = $user_id;
        $submission['language_id'] = $_POST['language_id'];
        $submission['submission_type'] = 0; // Private for now
        $submission['submission_time'] = date('Y-m-d H:i:s');
        $submission['submission_status'] = 1;
        $submission['submission_result'] = 0;



        // echo '<pre>';
        // print_r($submission);
        // echo '</pre>';
        // echo '<br /><br />';

        /*
        Verdicts============

        0 -> In Queue
        1 -> AC
        2 -> WA
        3 -> TLE
        4 -> RE
        5 -> CE
        6 -> MLE

        */

        $insert_id = $this->m_user->submit_solution($submission);

        if($insert_id) {
            $temp = array('contest_status' => 1);
            $aff = $this->m_user->update_contest_status($contest_id, $temp);
            redirect(base_url($this->module.'/'.$this->subview."/view_contest?contest_id=".$submission['contest_id']."#submission_my"));
        }
        else {
            redirect(base_url($this->module.'/'.$this->subview."/view_contest?contest_id=".$submission['contest_id']."#submission_my"));
        }

    } // Submit Problem ends

    public function submit_clar() {
        $clar = $_POST;
        $clar['user_id'] = $this->session->user_id;
        $clar['clarification_time'] = date('Y-m-d H:i:s');
        $clar['clarification_status'] = 0;
        if($clar['problem_id'] == '') $clar['problem_id'] = NULL;

        $insert_id = $this->m_user->insert_clarification($clar);

        if($insert_id) {
            echo 'yes';
        }
        else {
            echo 'no';
        }
    } // Submit Clarification ends

}
