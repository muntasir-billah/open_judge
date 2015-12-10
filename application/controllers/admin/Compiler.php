<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Compiler extends OJ_Controller {

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
    }
    //====================================//

    public function index()
    {

    }

    
}
