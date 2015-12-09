<?php

class OJ_Controller extends CI_Controller
{

	public $problem_image_path = 'problem_images/';	// Directory to upload problem images
	public $judge_io_path = 'judge_io/';				// Directory to upload Judge I/O
	public $sandbox_path = 'sandbox/';					// Directory to the sandbox

	/*
	
	 sandbox_path is the directory where a program source code will be compiled and run for judging.

	*/

	 function __construct()
	 {
	 	parent::__construct();

		// Setting Timezone
	 	date_default_timezone_set("Asia/Dhaka");

		// loading models
	 	$this->load->model("admin/m_admin");
	 	$this->load->model("user/m_user");

        // loading libraries
	 	$this->load->library('session');
	 }

	 public function __is_logged_in($module) {
	 	if($module == 'user') {
			// Checking user_id in session
	 		$user_id = $this->session->user_id;
	 		if($user_id == NULL) {
	 			return false;
	 		}
	 		else return true;
	 	}
	 	else {
			// Checking admin_id in session
	 		$admin_id = $this->session->admin_id;
	 		if($admin_id == NULL) {
	 			return false;
	 		}
	 		else return true;
	 	}
	 }

	 public function __security($module) {
	 	if(!$this->__is_logged_in($module)) redirect(base_url($module.'/login'));
	 }

	 public function __do_upload($field, $config) {
		/*
			__do_upload() is a custom function to avoid te problem of loading the same library multiple times in the same CI controller and keep the code clean. It uses the same $config array format of CI upload library. $field is the name of the input field of the desired file upload form. 
		*/
			$result = array();
		$file_name = md5(microtime(true).$_FILES[$field]['name']); // Generating a unique name using current microtime
        $ext = pathinfo($_FILES[$field]['name'], PATHINFO_EXTENSION); // Extracting the filename extension from the original filename

        $file_name .= '.'.$ext;

        $config['file_name'] = $file_name;

        $this->load->library('upload');

        $this->upload->initialize($config); 

        if ( ! $this->upload->do_upload($field)) {
        	$result['error'] = $this->upload->display_errors();
        	return $result;
        }
        else {
        	$result['error'] = false;
        	$result['success'] = $this->upload->data();
        	return $result;

        }
    }

    public function __excerpt($text, $numb=50) {
    	if (strlen($text) > $numb) { 
    		$text = substr($text, 0, $numb); 
    		$text = substr($text, 0, strrpos($text," "));
    		$text .= " ...";
    	}
    	return $text; 
    }

    public function __check_access($contest_id, $user_id) {
    	if($this->m_user->check_user_access($contest_id, $user_id) === 1) return true;
    	else return false;
    }

}

?>