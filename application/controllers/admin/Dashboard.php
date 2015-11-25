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

    	$data['content'] = 'v_home.php';
    	$this->load->view($this->viewpath.'v_main', $data);
    }

    public function check_contest_status() {
        // Checking waiting contests
        $result = $this->m_admin->get_contest_status(-1);
        foreach($result as $key => $contest) {
            $start = new DateTime(date($contest->contest_start));
            $end = new DateTime(date($contest->contest_end));
            $now = new DateTime(date('Y-m-d H:i:s'));

            // echo '<pre>';
            // echo 'Contest: '.$contest->contest_id.'<br />';
            // var_dump($start);
            // var_dump($end);
            // var_dump($now);
            // var_dump($now >= $start);
            // var_dump($now >= $end);
            // echo '===============================';
            // echo '</pre>';

            $data = array();

            if($now >= $start) {
                if($now >= $end) {
                    // Contest Ended
                    $data['contest_status'] = 2;
                }
                else {
                    // Contest Running
                    $data['contest_status'] = 1;
                }
                $aff = $this->m_admin->update_contest_status($contest->contest_id, $data);
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
                //$data['contest_status'] = 1;
                // Code for checking submission and compilation will be here
            }

        }
    }
}
