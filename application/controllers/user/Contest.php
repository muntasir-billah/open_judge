<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Contest extends OJ_Controller {

	public $module = 'user';	// defines the module
	public $template = 'AdminLTE-2.3.0';	// Current Template Name
	public $viewpath = '';
    public $subview = 'contest';
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
    	$data['title'] .= 'Contests';

        // Page CSS Files
        $data['page_css'] = array();

        // Page JS Scripts
        $data['page_scripts'] = array();

        $data['contests'] = $this->m_user->get_all_contests($this->session->user_id);

    	$data['content'] = $this->subview.'/v_all_contests.php';
    	$this->load->view($this->viewpath.'v_main', $data);
    }

    public function view_contest() {
        if(isset($_GET['contest_id'])) $contest_id = $_GET['contest_id'];
        else redirect(base_url($this->module.'/'.$this->subview));

        $data = $this->data;

        // Page CSS Files
        $data['page_css'] = array();

        // Page JS Scripts
        $data['page_scripts'] = array('js_table_tools.php', 'js_view_contest.php');

        if(!$data['contest'] = $this->m_user->get_single_contest($contest_id)) {
            redirect(base_url('four'));
        }

        if(!$this->__check_access($contest_id, $this->session->user_id)) {
            echo 'You have not access to this contest';
            exit();
        }

        $data['title'] .= $data['contest']->contest_name;

        $data['problems'] = $this->m_user->probs_for_contest($data['contest']->contest_id);

        foreach($data['problems'] as $key => $problem) {
            if($data['problems'][$key]->problem_time_limit >= 1000) {
                $data['problems'][$key]->problem_time_limit /= 1000;
                $data['problems'][$key]->problem_time_limit .= 's';
            }
            else $data['problems'][$key]->problem_time_limit .= 'ms';

            if($data['problems'][$key]->problem_memory_limit >= 1024) {
                $data['problems'][$key]->problem_memory_limit /= 1024;
                $data['problems'][$key]->problem_memory_limit .= ' MB';
            }
            else $data['problems'][$key]->problem_memory_limit .= ' KB';
        }

        $data['content'] = $this->subview.'/v_view_contest.php';
        $this->load->view($this->viewpath.'v_main', $data);
    }

    public function submit() {
        // echo '<pre>';
        // print_r($_POST);
        // echo '</pre>';

        extract($_POST);
    }

}
