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
    	$url = base_url().$this->module.'/User_management/contestant';
        redirect($url);
    }

    public function judge() {
        $data = $this->data;
        $data['title'] .= 'Judges';

        // Page CSS Files
        $data['page_css'] = array();

        // Page JS Scripts
        $data['page_scripts'] = array('js_form_elements.php', 'js_table_tools.php', 'js_view_contest.php');

        $data['judges'] = $this->m_admin->all_judges();

        $data['content'] = $this->subview.'/v_all_judges.php';
        $this->load->view($this->viewpath.'v_main', $data);
    }

	public function create_judge() {
        $data = $this->data;
        $data['title'] .= 'Create Judge';

        // Page CSS Files
        $data['page_css'] = array('css_form_elements.php');

        // Page JS Scripts
        $data['page_scripts'] = array('js_form_elements.php');

        $data['content'] = $this->subview.'/v_create_judge.php';
        $this->load->view($this->viewpath.'v_main', $data);
	}

    public function store_judge() {
        $url = base_url().$this->module.'/user_management/create_judge';

        if($_POST['judge_pass1'] != $_POST['judge_pass2']) { // checking for password match
            redirect($url);
        }

        // checking for username availability
        if($this->m_admin->judge_handle_check($_POST['judge_user'])) {
            redirect($url);
        }

        $judge = array();
        $judge['judge_name'] = $_POST['judge_name'];
        $judge['judge_user'] = $_POST['judge_user'];
        $judge['judge_phone'] = $_POST['judge_phone'];
        $judge['judge_email'] = $_POST['judge_email'];
        $judge['judge_pass'] = md5($_POST['judge_pass1']);

        $insert_id = $this->m_admin->add_judge($judge);

        if($insert_id) {
            redirect(base_url().$this->module.'/user_management/view_judge?judge_id='.$insert_id);
        }
        else {
            redirect($url);
        }
    }

    public function delete_judge($judge_id=0) {
        if($judge_id) {
            $aff = $this->m_admin->delete_judge($judge_id);
            $url = base_url().$this->module.'/user_management/judge';
            if($aff) {
                redirect($url);
            }
            else {
                redirect($url);
            }
        }
        redirect(base_url().'four');
    }

    public function update_judge() {
        $judge_id = $_POST['judge_id'];

        $url = base_url().$this->module.'/user_management/view_judge?judge_id='.$judge_id;

        if($_POST['judge_pass1'] != $_POST['judge_pass2']) {
            redirect($url);
        }

        $judge = array();
        $judge['judge_name'] = $_POST['judge_name'];
        $judge['judge_user'] = $_POST['judge_user'];
        $judge['judge_phone'] = $_POST['judge_phone'];
        $judge['judge_email'] = $_POST['judge_email'];
        if($_POST['judge_pass1'] != '')
            $judge['judge_pass'] = md5($_POST['judge_pass1']);

        $aff = $this->m_admin->update_judge($judge_id, $judge);

        if($aff) {
            redirect(base_url().$this->module.'/user_management/view_judge?judge_id='.$judge_id);
        }
        else {
            redirect($url);
        }
    }

    public function view_judge() {
        if(isset($_GET['judge_id'])) $judge_id = $_GET['judge_id'];
        else redirect(base_url($this->module.'/'.$this->subview));

        $data = $this->data;
        $data['title'] .= 'judges';

        // Page CSS Files
        $data['page_css'] = array();

        // Page JS Scripts
        $data['page_scripts'] = array('js_table_tools.php', 'js_form_elements.php');

        if(!$data['judge'] = $this->m_admin->get_single_judge($judge_id)) {
            redirect(base_url().'four');
        }

        $data['content'] = $this->subview.'/v_view_judge.php';
        $this->load->view($this->viewpath.'v_main', $data);
    }

	public function contestant() {
        $data = $this->data;
        $data['title'] .= 'Contestants';

        // Page CSS Files
        $data['page_css'] = array();

        // Page JS Scripts
        $data['page_scripts'] = array('js_form_elements.php', 'js_table_tools.php', 'js_view_contest.php');

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
        $url = base_url().$this->module.'/user_management/create_contestant';

        if($_POST['user_pass1'] != $_POST['user_pass2']) { // checking for password match
            redirect($url);
        }

        // checking for username availability
        if($this->m_admin->user_handle_check($_POST['user_handle'])) {
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
            redirect(base_url().$this->module.'/user_management/view_contestant?user_id='.$insert_id);
        }
        else {
            redirect($url);
        }
    }

    public function delete_contestant($user_id=0) {
        if($user_id) {
            $aff = $this->m_admin->delete_contestant($user_id);
            $url = base_url().$this->module.'/user_management/contestant';
            if($aff) {
                redirect($url);
            }
            else {
                redirect($url);
            }
        }
        redirect(base_url().'four');
    }

    public function update_contestant() {
        $user_id = $_POST['user_id'];

        $url = base_url().$this->module.'/user_management/view_contestant?user_id='.$user_id;

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
            redirect(base_url().$this->module.'/user_management/view_contestant?user_id='.$user_id);
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
        $data['page_scripts'] = array('js_table_tools.php', 'js_form_elements.php');

        if(!$data['user'] = $this->m_admin->get_single_user($user_id)) {
            redirect(base_url().'four');
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