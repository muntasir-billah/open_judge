<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Contest extends OJ_Controller {

	public $module = 'admin';	// defines the module
	public $template = 'ace';	// Current Template Name
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
        $data['page_scripts'] = array('js_table_tools.php');

        $data['contests'] = $this->m_admin->all_contests();

    	$data['content'] = $this->subview.'/v_all_contests.php';
    	$this->load->view($this->viewpath.'v_main', $data);
    }

    public function create() {
        $data = $this->data;
        $data['title'] .= 'Create Contest';

        // Page CSS Files
        $data['page_css'] = array('css_form_elements.php');

        // Page JS Scripts
        $data['page_scripts'] = array('js_form_elements.php', 'js_create_contest.php');

        $data['content'] = $this->subview.'/v_create_contest.php';
        $this->load->view($this->viewpath.'v_main', $data);
    }

    public function store_contest() {
        $contest = array();

        $contest['contest_name'] = $_POST['contest_name'];
        $contest['contest_type'] = $_POST['contest_type'];
        if($contest['contest_type'] == 1) 
            $contest['contest_pass'] = md5($_POST['contest_pass']);
        $contest['contest_start'] = $_POST['contest_start'];
        $contest['contest_end'] = $_POST['contest_end'];

        $start = new DateTime(date($contest['contest_start']));
        $end = new DateTime (date($contest['contest_end']));

        if($start >= $end) redirect(base_url($this->module.'/contest/create'));

        $insert_id = $this->m_admin->add_contest($contest);

        if($insert_id) {
            redirect(base_url($this->module.'/'.$this->subview.'/view_contest?contest_id='.$insert_id));
        }
        else {
            echo 'Not Done'; 
        }

    }

    public function view_contest() {
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

        $data['users'] = array();
        $contest_users = $this->m_admin->get_users_for_contest($contest_id);
        foreach($contest_users as $c_key => $cont_user) {
            $data['users'][$cont_user->user_id] = $cont_user->user_name;
        }
        $data['submissions'] = $this->m_admin->get_sub_for_contest($contest_id);

        foreach($data['submissions'] as $key => $sub) {
            if(!isset($data['users'][$sub->user_id])) {
                $temp_user = $this->m_admin->get_user($sub->user_id);
                $data['users'][$sub->user_id] = $temp_user->user_name;
            }
        }

        // Fetching Clarifications
        $data['clarifications'] = $this->m_admin->get_clar_for_contest($contest_id);

        foreach($data['clarifications'] as $key => $clar) {
            if($clar->user_id != NULL && !isset($data['users'][$clar->user_id])) {
                $temp_user = $this->m_user->get_user($clar->user_id);
                $data['users'][$clar->user_id] = $temp_user->user_name;
            }
        }

        $data['count'] = $this->m_admin->get_prob_cont_count($contest_id);
        
        $prob_cont_rel = $this->m_admin->get_prob_cont_rel_for_cont($contest_id);
        $prob_tried_solved = array();
        foreach($prob_cont_rel as $key => $rel) {
            $prob_tried_solved[$rel->problem_id] = array();
            $prob_tried_solved[$rel->problem_id]['tried'] = $rel->prob_cont_tried;
            $prob_tried_solved[$rel->problem_id]['solved'] = $rel->prob_cont_solved;
        }

        $data['prob_tried_solved'] = $prob_tried_solved;


        $data['ranklist'] = $this->m_admin->get_ranklist($contest_id);

        $data['title'] .= $data['contest']->contest_name;

        if($data['contest']->contest_status == -1) {
            //$data['all_problems'] = $this->m_admin->probs_except_contest($contest_id);
            $data['all_problems'] = $this->m_admin->probs_except_contest($contest_id);
            $data['all_tags'] = array();

            foreach($data['all_problems'] as $key => $problem) {
                array_push($data['all_tags'], $this->m_admin->tags_for_problem($problem->problem_id));
                $data['all_problems'][$key]->problem_description = $this->__excerpt($problem->problem_description);

                if($data['all_problems'][$key]->problem_time_limit >= 1000) {
                    $data['all_problems'][$key]->problem_time_limit /= 1000;
                    $data['all_problems'][$key]->problem_time_limit .= 's';
                }
                else $data['all_problems'][$key]->problem_time_limit .= 'ms';

                if($data['all_problems'][$key]->problem_memory_limit >= 1024) {
                    $data['all_problems'][$key]->problem_memory_limit /= 1024;
                    $data['all_problems'][$key]->problem_memory_limit .= ' MB';
                }
                else $data['all_problems'][$key]->problem_memory_limit .= ' KB';
            }
        }

        $data['problems'] = $this->m_admin->probs_for_contest($data['contest']->contest_id);
        $data['individual_tags'] = array();

        $data['nos'] = array();
        $no = 'A';

        foreach($data['problems'] as $key => $problem) {
            $data['nos'][$problem->problem_id] = $no++;
            array_push($data['individual_tags'], $this->m_admin->tags_for_problem($problem->problem_id));
            $data['problems'][$key]->problem_excerpt = $this->__excerpt($problem->problem_description);

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

    public function edit_contest($contest_id = 0) {
        if($contest_id == 0) redirect(base_url($this->module));


        $data = $this->data;

        if(!$data['contest'] = $this->m_admin->get_single_contest($contest_id)) {
            redirect(base_url('four'));
        }

        $data['title'] .= 'Edit Contest';

        // Page CSS Files
        $data['page_css'] = array('css_form_elements.php');

        // Page JS Scripts
        $data['page_scripts'] = array('js_form_elements.php', 'js_create_contest.php');

        $data['content'] = $this->subview.'/v_edit_contest.php';
        $this->load->view($this->viewpath.'v_main', $data);
    }

    public function update_contest($contest_id = 0) {
        if($contest_id == 0) redirect(base_url($this->module));

        $contest = $_POST;

        if($contest['contest_type'] == 1) 
            $contest['contest_pass'] = md5($contest['contest_pass']);

        $now = new DateTime(date('Y-m-d H:i:s'));
        $start = new DateTime(date($contest['contest_start']));
        $end = new DateTime (date($contest['contest_end']));

        if($start >= $end) redirect(base_url($this->module.'/contest/create'));

        if($now < $start) $contest['contest_status'] = -1; // Waiting to Start
        else if($now > $start && $now < $end) $contest['contest_status'] = 1; // Contest Running
        else if($now > $end) $contest['contest_status'] = 2; // Contest Ended

        $aff = $this->m_admin->update_contest($contest_id, $contest);
        if($aff) {
            $url = base_url($this->module."/contest/view_contest?contest_id=".$contest_id);
            redirect($url);
        }
        else {
            $url = base_url($this->module."/contest/view_contest?contest_id=".$contest_id);
            redirect($url);
        }
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
        if($this->__is_running($contest_id)) {
            redirect(base_url($this->module.'/contest'));
        }
        $count = 0;
        foreach ($_POST['problem_id'] as $problem_id) {
            $res = $this->m_admin->get_prob_cont_rel($problem_id, $contest_id);

            if($res == NULL) {
                $count = $this->m_admin->get_prob_cont_count($contest_id);
                $data = array();
                $data['problem_id'] = $problem_id;
                $data['contest_id'] = $contest_id;
                $data['prob_cont_rel_order'] = ++$count;

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
        if($this->__is_running($contest_id)) {
            redirect(base_url($this->module.'/contest'));
        }
        $aff = $this->m_admin->remove_prob_cont_rel($problem_id, $contest_id);
        if($aff) echo 'yes';
        else echo 'no';
    }

    public function delete_contest($contest_id) {
        if($this->__is_running($contest_id)) {
            redirect(base_url($this->module.'/contest'));
        }
        $aff = $this->m_admin->delete_contest($contest_id);
        if($aff) echo 'yes';
        else echo 'no';
    }

    public function compile($submission_id) {
        $submission = $this->m_admin->get_single_submission($submission_id);
        $contest = $this->m_admin->get_single_contest($submission->contest_id);

        $user_id = $submission->user_id;
        $contest_id = $submission->contest_id;
        $problem_id = $submission->problem_id;
        $prob_count = $this->m_admin->get_prob_cont_count($contest_id);
        $order = $this->m_admin->get_prob_cont_order($contest_id, $problem_id);
        --$order;
        echo '<br />';

        $prev_submissions = $this->m_admin->get_prev_submissions_by_user($user_id, $contest_id, $problem_id);
        --$prev_submissions;
        echo 'Prev: '.$prev_submissions.'<br /><br />';

        // Updating Total Solved for this problem
        $prob_cont_rel = $this->m_admin->get_prob_cont_rel($problem_id, $contest_id);
        $prob_cont_update = array();

        if($prev_submissions) {
            //checking if this problem is already solved by this user;
            if($this->m_admin->check_existing_solution($user_id, $contest_id, $problem_id)){
                echo 'Already Solved';
                $sub = array();
                $sub['submission_status'] = 0;
                $sub['submission_result'] = 7;

                $aff = $this->m_admin->update_submission($submission_id, $sub);
                exit();
            }
        }
        else {
            $prob_cont_update['prob_cont_tried'] = $prob_cont_rel->prob_cont_tried + 1;
        }

        $res = $this->__process($submission_id);
        $result = $res['result'];
        $time = $res['time'];
        echo '<br />';
        $sub = array();
        $sub['submission_status'] = 0;
        $sub['submission_result'] = $result;
        $sub['submission_tle'] = $time;

        $aff = $this->m_admin->update_submission($submission_id, $sub);


        if($this->m_admin->if_first_submission($user_id, $contest_id)) {
            $rank = array();
            $rank['user_id'] = $user_id;
            $rank['contest_id'] = $contest_id;
            $minute_diff = 0;
            if($result == 1) {
                // Updating Total Solved for this problem
                $prob_cont_update['prob_cont_solved'] = $prob_cont_rel->prob_cont_solved + 1;

                $rank['rank_solved'] = 1;
                // Calculating Penalty
                $second_diff = strtotime($submission->submission_time) - strtotime($contest->contest_start);
                $minute_diff = (int)($second_diff / 60);
            }
            else $rank['rank_solved'] = 0;
            $rank['rank_penalty'] = $minute_diff;

            $rank['rank_details'] = '';
            for($i = 0; $i < $prob_count; ++$i) {
                if($i > 0) $rank['rank_details'] .= ',';
                if($i != $order)
                    $rank['rank_details'] .= '0,NA,0';
                else {
                    $rank['rank_details'] .= '1,';
                    if($result == 1) $rank['rank_details'] .= $minute_diff.','.$minute_diff;
                    else $rank['rank_details'] .= $minute_diff.',0';
                }
            }
            $insert_id = $this->m_admin->insert_rank($rank);
            if($insert_id) echo 'OK';
            else echo 'NOT Inserted';
        }
        else { // This is not the first submission from this user.
            $current_rank = $this->m_admin->get_rank($user_id, $contest_id);
            $c_rank = explode(',', $current_rank->rank_details);
            $rank = array();

            $minute_diff = 0;
            if($result == 1) {
                // Updating Total Solved for this problem
                $prob_cont_update['prob_cont_solved'] = $prob_cont_rel->prob_cont_solved + 1;

                $rank['rank_solved'] = $current_rank->rank_solved + 1;
                // Calculating Penalty
                $second_diff = strtotime($submission->submission_time) - strtotime($contest->contest_start);
                $minute_diff = (int)($second_diff / 60);
                $penalty = ($prev_submissions * 20) + $minute_diff;
                $rank['rank_penalty'] = $current_rank->rank_penalty + $penalty;
            }

            $rank['rank_details'] = '';
            for($i = 0, $k=0; $k < $prob_count; $i += 3, ++$k) {
                if($i > 0) $rank['rank_details'] .= ',';
                if($k != $order)
                    $rank['rank_details'] .= $c_rank[$i].','.$c_rank[$i+1].','.$c_rank[$i+2];
                else {
                    $rank['rank_details'] .=  ($c_rank[$i]+1).',';
                    if($result == 1) $rank['rank_details'] .= $minute_diff.','.$penalty;
                    else $rank['rank_details'] .= $minute_diff.',0';
                }
            }

            $aff = $this->m_admin->update_rank($user_id, $contest_id, $rank);
            if($aff) echo 'OK';
            else echo 'NOT Updated';
        }
        echo '<pre>';
        echo 'Rank<br />';
        print_r($rank);
        echo '</pre>';
        echo '<pre>';
        echo 'Rank<br />';
        print_r($prob_cont_update);
        echo '</pre>';

        $aff = $this->m_admin->update_prob_cont_rel($prob_cont_rel->prob_cont_rel_id, $prob_cont_update);

        // $new = $this->m_admin->new_submission_for_contest($contest_id);
        // if(count($new) > 0) {
        //     $temp_data['contest_status'] = 0;
        //     $aff = $this->m_admin->update_contest_status($contest_id, $temp_data);
        // }
    }

    public function process_submissions() {
        $new = $this->m_admin->new_sub();
        if($new != '') {
            $this->compile($new->submission_id);
        }
    }

    public function reply_clar() {
        $clar_id = $_POST['clarification_id'];

        $clar = array();


        if($_POST['clarification_reply'] != 'ignored') {
            $clar = $_POST;
            $clar['clarification_status'] = 1;
        }
        else {
            $clar['clarification_status'] = 2;
        }
        
        if($this->session->admin_type == 'admin') $clar['admin_id'] = $this->session->admin_id;
        else $clar['judge_id'] = $this->session->judge_id;

        $aff = $this->m_admin->update_clarification($clar, $clar_id);

        if($aff) {
            echo 'yes';
        }
        else {
            echo 'no';
        }
    }


    public function judge_clar() {
        $clar = $_POST;
        $clar['clarification_time'] = date('Y-m-d H:i:s');
        $clar['clarification_status'] = 0;

        if($this->session->admin_type == 'admin') $clar['admin_id'] = $this->session->admin_id;
        else $clar['judge_id'] = $this->session->judge_id;


        $insert_id = $this->m_admin->insert_clarification($clar);

        if($insert_id) {
            echo 'yes';
        }
        else {
            echo 'no';
        }
    } // Judge Clarification ends

    public function delete_clar() {
        $clar_id = $_POST['clar_id'];

        $aff = $this->m_admin->delete_clarification($clar_id);

        if($aff) echo 'yes';
        else echo 'no';
    }

    public function fetch_submission($submission_id) {
        $submission = $this->m_admin->get_single_submission($submission_id);
        echo htmlentities($submission->submission_source);
    }

}
