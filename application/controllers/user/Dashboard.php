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
        
        $this->load->model($this->module."/m_".$this->module);

        $this->viewpath = $this->module.'/'.$this->template.'/';	// Creating the Path
        $this->data['fullpath'] = base_url().'view/'.$this->viewpath;;
        $this->data['title'] = $this->config->item('title');
    }

	public function index()
	{
		$data = $this->data;
		$data['title'] .= 'Dashboard';

		$data['content'] = 'home.php';
		$this->load->view($this->viewpath.'main', $data);
	}

	public function test() {
		echo $this->viewpath;
	}
}
