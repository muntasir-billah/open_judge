<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_management extends OJ_Controller {

	public $module = 'admin';	// defines the module
	public $template = 'ace';	// Current Template Name
	public $viewpath = '';
    public $subview = 'User_management';
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

    public function index() {
    	echo 'U-man';
    }

    public function judge() {
    	echo 'U-man';
    }

	public function create_judge() {
    	echo 'U-man';
	}

	public function contestant() {
    	echo 'U-man';
	}

	public function create_contestant() {
    	echo 'U-man';
	}

	public function bulk_contestant() {
		echo 'U-man';
	}

	public function create_bulk_contestant() {
		echo 'U-man';
	}
}