<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends OJ_Controller {

	public $module = 'admin';	// defines the module
	public $template = 'ace';	// Current Template Name
	public $viewpath = '';
	//========================
	public $data = array();
	public $model = 'm_';

	function __construct()
    {
        parent::__construct();

        $this->model .= $this->module;
        $this->load->model($this->module."/".$this->model);

        $this->viewpath = $this->module.'/'.$this->template.'/';	// Creating the Path
        $this->data['fullpath'] = base_url().'view/'.$this->viewpath;;
        $this->data['title'] = $this->config->item('title');
        $this->data['module'] = $this->module;
    }
    //====================================//

    public function index()
    {

    	if(!isset($_GET['url'])) $url = base_url($this->module.'/dashboard');
  		else $url = $_GET['url'];

    	if($this->__is_logged_in($this->module)) redirect($url);

    	$data = $this->data;
    	$data['title'] .= 'Panel Login';
    	$this->load->view($this->viewpath.'v_login', $data);
    }

    public function login_process() {
    	extract($_POST);


		$result = $this->m_admin->login_check_judge($username, md5($password));
    	if(count($result) == 1) {
    		$temp = array('admin_id' => $result[0]->judge_id, 'admin_type' => 'judge');
    		$this->session->set_userdata($temp);
    		redirect(base_url($this->module.'/dashboard'));
    	}    	
    	else {
    		$result = $this->m_admin->login_check_admin($username, md5($password));
	    	if(count($result) == 1) {
	    		$temp = array('admin_id' => $result[0]->admin_id, 'admin_type' => 'admin');
	    		$this->session->set_userdata($temp);
	    		redirect(base_url($this->module.'/dashboard'));
	    	}
	    	else {
	    		$error = "Incorrect Username or Password";
	    		$temp = array('login_error' => $error);
	    		$this->session->set_userdata($temp);
	    		redirect(base_url($this->module.'/login'));
	    	}  
    	}  	
    }

    public function logout() {
    	$temp = array('admin_id', 'admin_type');
    	$this->session->unset_userdata($temp);
    	redirect(base_url($this->module.'/login'));
    }
}
