<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends OJ_Controller {

	public $module = 'admin';	// defines the module
	public $template = 'ace';	// Current Template Name
	public $viewpath = '';
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
    	$data['title'] .= 'Dashboard';

        // Page CSS Files
        $data['page_css'] = array();

        // Page JS Scripts
        $data['page_scripts'] = array('js_table_tools.php');

        $updated = $this->m_admin->get_contests(0);
        $not_updated = $this->m_admin->get_contests(1);

        $data['running_contests'] = array_merge($updated, $not_updated);
        $data['upcoming_contests'] = $this->m_admin->get_contests(-1);

    	$data['content'] = 'v_home.php';
    	$this->load->view($this->viewpath.'v_main', $data);
    }

    public function reorder_prob_for_cont($contest_id) {
        $prob_cont_rel = $this->m_admin->get_prob_cont_rel_for_cont($contest_id);

        foreach ($prob_cont_rel as $key => $pcr) {
            $data = array();
            $data['prob_cont_rel_order'] = $key+1;
            $aff = $this->m_admin->update_prob_cont_rel($pcr->prob_cont_rel_id, $data);
        }
    }

    public function check_contest_status() {
        // Checking waiting contests
        $result = $this->m_admin->get_contest_status(-1);
        foreach($result as $key => $contest) {
            $start = new DateTime(date($contest->contest_start));
            $end = new DateTime(date($contest->contest_end));
            $now = new DateTime(date('Y-m-d H:i:s'));

            $data = array();

            if($now >= $start) {
                if($now >= $end) {
                    // Contest Ended
                    $data['contest_status'] = 2;
                }
                else {
                    // Contest Running
                    $data['contest_status'] = 1;

                    // Creating blank ranks for the contestants of that contest
                    $users = $this->m_admin->get_users_for_contest($contest->contest_id);
                    $count = $this->m_admin->get_prob_cont_count($contest->contest_id);
                    $rank = array();
                    foreach($users as $u_key => $user) {
                        $temp_rank = array();
                        $temp_rank['contest_id'] = $contest->contest_id;
                        $temp_rank['user_id'] = $user->user_id;
                        $temp_rank['rank_solved'] = 0;
                        $temp_rank['rank_penalty'] = 0;

                        $temp_rank['rank_details'] = '';
                        $first_flag = true;
                        for($i=0; $i<$count; ++$i) {
                            if($first_flag) {
                                $first_flag = false;
                            }
                            else {
                                $temp_rank['rank_details'] .= ',';
                            }
                            $temp_rank['rank_details'] .= '0,NA,0';
                        }
                        $rank[$u_key] = $temp_rank;
                    }
                    $aff = $this->m_admin->insert_batch_rank($rank);
                }
                $aff = $this->m_admin->update_contest_status($contest->contest_id, $data);
                $this->reorder_prob_for_cont($contest->contest_id);
            }
        }


        //Checking running updated contests
        $result = $this->m_admin->get_contest_status(0);
        foreach($result as $key => $contest) {
            $end = new DateTime(date($contest->contest_end));
            $now = new DateTime(date('Y-m-d H:i:s'));

            $data = array();

            if($now >= $end) {
                // Contest Ended
                $data['contest_status'] = 2;
                $aff = $this->m_admin->update_contest_status($contest->contest_id, $data);
            }

        }


        //Checking running due to update contests
        $result = $this->m_admin->get_contest_status(1);
        foreach($result as $key => $contest) {
            $end = new DateTime(date($contest->contest_end));
            $now = new DateTime(date('Y-m-d H:i:s'));

            $data = array();


            if($now >= $end) {
                // Contest Ended
                $data['contest_status'] = 2;
                $aff = $this->m_admin->update_contest_status($contest->contest_id, $data);
            }
            else {
                // Contest Running
            }

        }
    }
}
