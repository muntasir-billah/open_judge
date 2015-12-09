<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends OJ_Controller {

	public $module = 'user';				// defines the module
	public $template = 'AdminLTE-2.3.0';	// Current Template Name
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

	public function index()
	{
		$data = $this->data;
		$data['title'] .= 'Dashboard';

        // Page CSS Files
        $data['page_css'] = array();

        // Page JS Scripts
        $data['page_scripts'] = array('');

        $updated = $this->m_user->get_contests(0, $this->session->user_id);
        $not_updated = $this->m_user->get_contests(1, $this->session->user_id);

        $data['running_contests'] = array_merge($updated, $not_updated);
        $data['upcoming_contests'] = $this->m_user->get_contests(-1, $this->session->user_id);
        $data['past_contests'] = $this->m_user->get_contests(2, $this->session->user_id);

		if($this->session->user_type) 				// Bulk User
			$data['content'] = 'v_home_bulk.php';
		else 										// Regular User
			$data['content'] = 'v_home_regular.php';
		$this->load->view($this->viewpath.'v_main', $data);
	}

	public function test() {
		echo $this->viewpath;
	}
}
