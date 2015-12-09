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
            echo 'You have not access to this contest';
            exit();
        }

        $data['title'] .= $data['contest']->contest_name;

        $data['problems'] = $this->m_user->probs_for_contest($data['contest']->contest_id);

        foreach($data['problems'] as $key => $problem) {
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

    public function manage_judges() {
        if(isset($_GET['contest_id'])) $contest_id = $_GET['contest_id'];
        else redirect(base_url($this->module.'/'.$this->subview));

        $data = $this->data;

        // Page CSS Files
        $data['page_css'] = array();

        // Page JS Scripts
        $data['page_scripts'] = array('js_table_tools.php', 'js_view_contest.php');

        if(!$data['contest'] = $this->m_admin->get_single_contest($contest_id)) {
            redirect(base_url('four'));
        }

        $data['title'] .= 'Manage Judges for '.$data['contest']->contest_name;

        $data['judges'] = $this->m_admin->get_judges_for_contest($contest_id);

        $data['all_judges'] = $this->m_admin->judges_except_contest($contest_id);

        $data['content'] = $this->subview.'/v_manage_judges.php';
        $this->load->view($this->viewpath.'v_main', $data);
    }

    public function manage_contestants() {
        if(isset($_GET['contest_id'])) $contest_id = $_GET['contest_id'];
        else redirect(base_url($this->module.'/'.$this->subview));

        $data = $this->data;

        // Page CSS Files
        $data['page_css'] = array();

        // Page JS Scripts
        $data['page_scripts'] = array('js_table_tools.php', 'js_view_contest.php');

        if(!$data['contest'] = $this->m_admin->get_single_contest($contest_id)) {
            redirect(base_url('four'));
        }

        $data['title'] .= 'Manage Contestants for '.$data['contest']->contest_name;

        $data['users'] = $this->m_admin->get_users_for_contest($contest_id);

        $data['all_users'] = $this->m_admin->users_except_contest($contest_id);

        $data['content'] = $this->subview.'/v_manage_contestants.php';
        $this->load->view($this->viewpath.'v_main', $data);
    }

    public function add_problems() {
        $contest_id = $_POST['contest_id'];
        $count = 0;
        foreach ($_POST['problem_id'] as $problem_id) {
            $res = $this->m_admin->get_prob_cont_rel($problem_id, $contest_id);

            if($res == NULL) {
                $data = array();
                $data['problem_id'] = $problem_id;
                $data['contest_id'] = $contest_id;

                $insert_id = $this->m_admin->add_prob_cont_rel($data);
                if($insert_id) ++$count;
            }
        }

        if($count > 0) {
            redirect(base_url($this->module.'/'.$this->subview.'/view_contest?contest_id='.$contest_id));
        }
        else {
            //redirect(base_url($this->module.'/'.$this->subview.'/view_contest?contest_id='.$contest_id));
            echo 'NOT OK';
        }
    }

    public function add_judges() {
        $contest_id = $_POST['contest_id'];
        $count = 0;
        foreach ($_POST['judge_id'] as $judge_id) {
            $res = $this->m_admin->get_judge_cont_rel($judge_id, $contest_id);

            if($res == NULL) {
                $data = array();
                $data['judge_id'] = $judge_id;
                $data['contest_id'] = $contest_id;

                $insert_id = $this->m_admin->add_judge_cont_rel($data);
                if($insert_id) ++$count;
            }
        }

        if($count > 0) {
            redirect(base_url($this->module.'/'.$this->subview.'/manage_judges?contest_id='.$contest_id));
        }
        else {
            //redirect(base_url($this->module.'/'.$this->subview.'/view_contest?contest_id='.$contest_id));
            echo 'NOT OK';
        }
    }

    public function add_users() {
        // echo '<pre>';
        // print_r($_POST);
        // echo '</pre>';
        // exit();

        $contest_id = $_POST['contest_id'];
        $count = 0;
        foreach ($_POST['user_id'] as $user_id) {
            $res = $this->m_admin->get_user_cont_rel($user_id, $contest_id);

            if($res == NULL) {
                $data = array();
                $data['user_id'] = $user_id;
                $data['contest_id'] = $contest_id;

                $insert_id = $this->m_admin->add_user_cont_rel($data);
                if($insert_id) ++$count;
            }
        }

        if($count > 0) {
            redirect(base_url($this->module.'/'.$this->subview.'/manage_contestants?contest_id='.$contest_id));
        }
        else {
            //redirect(base_url($this->module.'/'.$this->subview.'/view_contest?contest_id='.$contest_id));
            echo 'NOT OK';
        }
    }

    public function remove_contestant($user_id, $contest_id) {
        $aff = $this->m_admin->remove_user_cont_rel($user_id, $contest_id);
        if($aff) echo 'yes';
        else echo 'no';
    }

    public function remove_judge($judge_id, $contest_id) {
        $aff = $this->m_admin->remove_judge_cont_rel($judge_id, $contest_id);
        if($aff) echo 'yes';
        else echo 'no';
    }

    public function remove_problem($problem_id, $contest_id) {
        $aff = $this->m_admin->remove_prob_cont_rel($problem_id, $contest_id);
        if($aff) echo 'yes';
        else echo 'no';
    }

    public function delete_contest($contest_id) {
        $aff = $this->m_admin->delete_contest($contest_id);
        if($aff) echo 'yes';
        else echo 'no';
    }

}
