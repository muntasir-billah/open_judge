<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_management extends OJ_Controller {

	public $module = 'admin';	// defines the module
	public $template = 'ace';	// Current Template Name
	public $viewpath = '';
    public $subview = 'user_management';
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
    	$url = site_url().$this->module.'/User_management/contestant';
        redirect($url);
    }

    public function judge() {
    	echo 'U-man';
    }

	public function create_judge() {
    	echo 'U-man';
	}

	public function contestant() {
        $data = $this->data;
        $data['title'] .= 'Contests';

        // Page CSS Files
        $data['page_css'] = array();

        // Page JS Scripts
        $data['page_scripts'] = array('js_table_tools.php', 'js_view_contest.php');

        $data['users'] = $this->m_admin->all_contestants();

        $data['content'] = $this->subview.'/v_all_users.php';
        $this->load->view($this->viewpath.'v_main', $data);
	}

	public function create_contestant() {
        $data = $this->data;
        $data['title'] .= 'Create Contestant';

        // Page CSS Files
        $data['page_css'] = array('css_form_elements.php');

        // Page JS Scripts
        $data['page_scripts'] = array('js_form_elements.php');

        $data['content'] = $this->subview.'/v_create_user.php';
        $this->load->view($this->viewpath.'v_main', $data);
	}

    public function store_contestant() {
        $url = site_url().$this->module.'/user_management/create_contestant';

        if($_POST['user_pass1'] != $_POST['user_pass2']) {
            redirect($url);
        }

        $user = array();
        $user['user_name'] = $_POST['user_name'];
        $user['user_handle'] = $_POST['user_handle'];
        $user['user_phone'] = $_POST['user_phone'];
        $user['user_email'] = $_POST['user_email'];
        $user['user_pass'] = md5($_POST['user_pass1']);

        $insert_id = $this->m_admin->add_contestant($user);

        if($insert_id) {
            redirect(site_url().$this->module.'/user_management/view_contestant?user_id='.$insert_id);
        }
        else {
            redirect($url);
        }
    }

    public function update_contestant() {
        $user_id = $_POST['user_id'];

        $url = site_url().$this->module.'/user_management/view_contestant?user_id='.$user_id;

        if($_POST['user_pass1'] != $_POST['user_pass2']) {
            redirect($url);
        }

        $user = array();
        $user['user_name'] = $_POST['user_name'];
        $user['user_handle'] = $_POST['user_handle'];
        $user['user_phone'] = $_POST['user_phone'];
        $user['user_email'] = $_POST['user_email'];
        if($_POST['user_pass1'] != '')
            $user['user_pass'] = md5($_POST['user_pass1']);

        $aff = $this->m_admin->update_contestant($user_id, $user);

        if($aff) {
            redirect(site_url().$this->module.'/user_management/view_contestant?user_id='.$user_id);
        }
        else {
            redirect($url);
        }
    }

    public function view_contestant() {
        if(isset($_GET['user_id'])) $user_id = $_GET['user_id'];
        else redirect(base_url($this->module.'/'.$this->subview));

        $data = $this->data;
        $data['title'] .= 'Contestants';

        // Page CSS Files
        $data['page_css'] = array();

        // Page JS Scripts
        $data['page_scripts'] = array('js_table_tools.php', 'js_view_contest.php', 'js_form_elements.php');

        if(!$data['user'] = $this->m_admin->get_single_user($user_id)) {
            redirect(site_url().'four');
        }

        $data['content'] = $this->subview.'/v_view_user.php';
        $this->load->view($this->viewpath.'v_main', $data);
    }

	public function bulk_contestant() {
		echo 'U-man';
	}

	public function create_bulk_contestant() {
		echo 'U-man';
	}
}