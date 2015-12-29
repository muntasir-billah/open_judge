<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends OJ_Controller {

	public $module = 'user';	// defines the module
	public $template = 'AdminLTE-2.3.0';	// Current Template Name
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
    	$data['title'] .= 'Contestant Login';
    	$this->load->view($this->viewpath.'v_login', $data);
    }

    public function login_process() {

     //    echo '<pre>';
     //    print_r($_POST);
     //    echo '</pre>';

    	 extract($_POST);

     //    echo md5($password);
     //    exit();


		$result = $this->m_user->login_check_user($username, md5($password));
    	if(count($result) == 1) {
    		$temp = array(
                'user_id' => $result[0]->user_id, 
                'user_type' => $result[0]->user_type,
                'user_name' => $result[0]->user_name,
                'user_handle' => $result[0]->user_handle,
                'user_phone' => $result[0]->user_phone,
                'user_email' => $result[0]->user_email);
    		$this->session->set_userdata($temp);
    		//redirect(base_url($this->module.'/dashboard'));
            redirect(base_url($this->module.'/Contest'));
    	}    	
    	else {
    		$error = "Incorrect Username or Password";
    		$temp = array('login_error' => $error);
    		$this->session->set_userdata($temp);
    		redirect(base_url($this->module.'/login'));
    	}  	
    }

    public function logout() {
    	$temp = array('user_id', 'user_type');
    	$this->session->unset_userdata($temp);
    	redirect(base_url($this->module.'/login'));
    }
}
