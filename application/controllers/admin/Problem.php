<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Problem extends OJ_Controller {

	public $module = 'admin';	// defines the module
	public $template = 'ace';	// Current Template Name
	public $viewpath = '';
    public $subview = 'problem';
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
        $this->data['subview'] = $this->subview;
    }
    //====================================//

    public function index()
    {
    	
        $data = $this->data;
        $data['title'] .= 'Problem Volume';

        // Page CSS Files
        $data['page_css'] = array();

        // Page JS Scripts
        $data['page_scripts'] = array('js_table_tools.php', 'js_problem_volume.php');

        $data['tags'] = $this->m_admin->get_all_categories();
        $data['problems'] = $this->m_admin->get_all_problems();

        $data['individual_tags'] = array();

        foreach($data['problems'] as $key => $problem) {
            array_push($data['individual_tags'], $this->m_admin->tags_for_problem($problem->problem_id));
            $data['problems'][$key]->problem_description = $this->__excerpt($problem->problem_description);

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


        $data['content'] = $this->subview.'/v_problem_volume.php';
        $this->load->view($this->viewpath.'v_main', $data);
    } // End of index

    public function create() {
        $data = $this->data;
        $data['title'] .= 'Create Problem';

        // Page CSS Files
        $data['page_css'] = array('css_form_elements.php');

        // Page JS Scripts
        $data['page_scripts'] = array('js_form_elements.php', 'js_create_problem.php');

        $data['tags'] = $this->m_admin->get_all_categories();


        $data['content'] = $this->subview.'/v_create_problem.php';
        $this->load->view($this->viewpath.'v_main', $data);
    } // End of create

    public function store_problem() {

        $flag = true; // Will be used to determine the success of successive file uploads and for the database query in the end.
        $total_error = ''; // Stores all the errors

        $problem = array();

        $problem['problem_name'] = $_POST['problem_name'];
        $problem['problem_time_limit'] = $_POST['problem_time_limit'];
        $problem['problem_memory_limit'] = $_POST['problem_memory_limit'];
        $problem['problem_input_channel'] = $_POST['problem_input_channel'];
        if($problem['problem_input_channel'] == '') $problem['problem_input_channel'] = 'Standard Input';
        $problem['problem_output_channel'] = $_POST['problem_output_channel'];
        if($problem['problem_output_channel'] == '') $problem['problem_output_channel'] = 'Standard Output';
        $problem['problem_description'] = $_POST['problem_description'];
        $problem['problem_input'] = $_POST['problem_input'];
        $problem['problem_output'] = $_POST['problem_output'];
        $problem['problem_sample_input'] = $_POST['problem_sample_input'];
        $problem['problem_sample_output'] = $_POST['problem_sample_output'];
        $problem['problem_setter'] = $_POST['problem_setter'];
        $problem['problem_hint'] = $_POST['problem_hint'];
        $problem['problem_add_date'] = date('Y-m-d H:i:s');
        if($_POST['problem_special_judge'] == 'on') $problem['problem_special_judge'] = 1;
        else $problem['problem_special_judge'] = 0;


        $file_as_judge_input = $_POST['file_as_judge_input'];

        if($file_as_judge_input != 'on') {
            $problem['problem_io_type'] = 0;
            $problem['problem_judge_input'] = $_POST['problem_judge_text_input'];
            $problem['problem_judge_output'] = $_POST['problem_judge_text_output'];
        }
        else {
            $problem['problem_io_type'] = 1;

            // Configuration for Judge I/O File Upload
            $config['upload_path']          = $this->judge_io_path;
            $config['allowed_types']        = 'txt';
            $config['max_size']             = 10240;

            // Uploading Judge Input File
            $upload = $this->__do_upload('problem_judge_file_input', $config);

            if(!$upload['error']) {
                $problem['problem_judge_input'] = $upload['success']['file_name'];

                // Uploading Judge Output File
                $upload = $this->__do_upload('problem_judge_file_output', $config);

                if(!$upload['error']) $problem['problem_judge_output'] = $upload['success']['file_name'];
                else {
                    $url = $this->judge_io_path.$problem['problem_judge_input'];
                    unlink($url); // Deleting the uploaded input file on failure of the upload of the output file.
                    $flag = false;
                    $total_error .= 'Judge Output File Error'.$upload['error'];
                }
            }
            else {
                $flag = false;
                $total_error .= 'Judge Input File Error'.$upload['error'];
            }
        }

        if($flag) { // If the other two files uploaded successfully (in case of Files as Judge I/O)

            $problem_image = $_FILES['problem_image'];

            if($problem_image['error'] == 0) {

                // Configuration for Problem Image File Upload
                $config['upload_path']          = $this->problem_image_path;
                $config['allowed_types']        = 'gif|jpg|png';
                $config['max_size']             = 102;

                // Uploading Image
                $upload = $this->__do_upload('problem_image', $config);

                if(!$upload['error']) $problem['problem_image'] = $upload['success']['file_name'];
                else {
                    $flag = false;
                    $total_error .= 'Problem Image Error'.$upload['error'];
                }
            }
        }

        if($flag) { // If all the files were uploaded successfully
            // Inserting data into database
            $insert_id = $this->m_admin->insert_problem($problem);
            if(!$insert_id) {
                // Deleting uploaded files in case of a failure of DB Query
                $url = $this->judge_io_path.$problem['problem_judge_input'];
                unlink($url);
                $url = $this->judge_io_path.$problem['problem_judge_output'];
                unlink($url);
                $url = $this->problem_image_path.$problem['problem_image'];
                unlink($url);
                $flag = false;
                $total_error = 'Something went wrong. Please try again later';
            }
            else {
                // Calling Tagging function to add all the tags to this problem
                if(count($_POST['problem_tags']) > 0) {
                    $tagged = $this->tag_problem($insert_id, $_POST['problem_tags']);
                    if(!$tagged) {
                        $flag = false;
                        $total_error = 'Everything Went Fine, but somehow we managed to fail tagging your problem :( No worries, you can do that later, as always :)';
                        echo "<h1>$total_error</h1>";
                    }
                    else {
                        redirect(base_url($this->module.'/problem/view_problem?problem_id='.$insert_id));
                    }
                }
            }
        }
    } // End of store_problem

    public function view_problem() {
        if(isset($_GET['problem_id'])) $problem_id = $_GET['problem_id'];
        else redirect(base_url($this->module.'/'.$this->subview));

        $data = $this->data;

        // Page CSS Files
        $data['page_css'] = array('css_form_elements.php');

        // Page JS Scripts
        $data['page_scripts'] = array('js_create_problem.php', 'js_form_elements.php');

        if(!$data['problem'] = $this->m_admin->get_single_problem_full($problem_id)) {
            redirect(base_url('four'));
        }
        $data['tags'] = $this->m_admin->tags_for_problem($problem_id);
        $data['all_tags'] = $this->m_admin->get_all_categories();

        $data['problem_tags'] = array();
        foreach ($data['tags'] as $key => $tag) {
            $data['problem_tags'][$tag->category_id] = true;
        }

        $data['problem']->problem_time_limit_ms = $data['problem']->problem_time_limit;
        if($data['problem']->problem_time_limit >= 1000) {
            $data['problem']->problem_time_limit /= 1000;
            if((int)$data['problem']->problem_time_limit > 1)
                $data['problem']->problem_time_limit .= ' Seconds';
            else $data['problem']->problem_time_limit .= ' Second';
        }
        else $data['problem']->problem_time_limit .= ' Milliseconds';

        $data['problem']->problem_memory_limit_kb = $data['problem']->problem_memory_limit;
        if($data['problem']->problem_memory_limit >= 1024) {
            $data['problem']->problem_memory_limit /= 1024;
            $data['problem']->problem_memory_limit .= ' MB';
        }
        else $data['problem']->problem_memory_limit .= ' KB';

        $data['title'] .= $data['problem']->problem_name;

        $data['content'] = $this->subview.'/v_view_problem.php';
        $this->load->view($this->viewpath.'v_main', $data);

    } // End of view_problem

    public function update_problem() {
        // echo '<pre>';
        // print_r($_POST);
        // print_r($_FILES);
        // echo '</pre>';
        // exit();

        $problem_id = $_POST['problem_id'];

        if(!$problem_old = $this->m_admin->get_single_problem_full($problem_id)) {
            redirect(base_url('four'));
        }

        $flag = true; // Will be used to determine the success of successive file uploads and for the database query in the end.
        $total_error = ''; // Stores all the errors

        $problem = array();

        $problem['problem_name'] = $_POST['problem_name'];
        $problem['problem_time_limit'] = $_POST['problem_time_limit'];
        $problem['problem_memory_limit'] = $_POST['problem_memory_limit'];
        $problem['problem_input_channel'] = $_POST['problem_input_channel'];
        if($problem['problem_input_channel'] == '') $problem['problem_input_channel'] = 'Standard Input';
        $problem['problem_output_channel'] = $_POST['problem_output_channel'];
        if($problem['problem_output_channel'] == '') $problem['problem_output_channel'] = 'Standard Output';
        $problem['problem_description'] = $_POST['problem_description'];
        $problem['problem_input'] = $_POST['problem_input'];
        $problem['problem_output'] = $_POST['problem_output'];
        $problem['problem_sample_input'] = $_POST['problem_sample_input'];
        $problem['problem_sample_output'] = $_POST['problem_sample_output'];
        $problem['problem_setter'] = $_POST['problem_setter'];
        $problem['problem_hint'] = $_POST['problem_hint'];
        if($_POST['problem_special_judge'] == 'on') $problem['problem_special_judge'] = 1;
        else $problem['problem_special_judge'] = 0;


        $file_as_judge_input = $_POST['file_as_judge_input'];

        if($file_as_judge_input != 'on') {
            $problem['problem_io_type'] = 0;
            $problem['problem_judge_input'] = $_POST['problem_judge_text_input'];
            $problem['problem_judge_output'] = $_POST['problem_judge_text_output'];
        }
        else {
            $problem['problem_io_type'] = 1;

            // Configuration for Judge I/O File Upload
            $config['upload_path']          = $this->judge_io_path;
            $config['allowed_types']        = 'txt';
            $config['max_size']             = 10240;

            // Uploading Judge Input File
            $upload = $this->__do_upload('problem_judge_file_input', $config);

            if(!$upload['error']) {
                $problem['problem_judge_input'] = $upload['success']['file_name'];

                // Uploading Judge Output File
                $upload = $this->__do_upload('problem_judge_file_output', $config);

                if(!$upload['error']) $problem['problem_judge_output'] = $upload['success']['file_name'];
                else {
                    $url = $this->judge_io_path.$problem['problem_judge_input'];
                    unlink($url); // Deleting the uploaded input file on failure of the upload of the output file.
                    $flag = false;
                    $total_error .= 'Judge Output File Error'.$upload['error'];
                }
            }
            else {
                $flag = false;
                $total_error .= 'Judge Input File Error'.$upload['error'];
            }
        }

        if($flag) { // If the other two files uploaded successfully (in case of Files as Judge I/O)

            $problem_image = $_FILES['problem_image'];

            if($problem_image['error'] == 0) {

                // Configuration for Problem Image File Upload
                $config['upload_path']          = $this->problem_image_path;
                $config['allowed_types']        = 'gif|jpg|png';
                $config['max_size']             = 1024;

                // Uploading Image
                $upload = $this->__do_upload('problem_image', $config);

                if(!$upload['error']) $problem['problem_image'] = $upload['success']['file_name'];
                else {
                    $flag = false;
                    $total_error .= 'Problem Image Error'.$upload['error'];
                }
            }
        }

        if($flag) { // If all the files were uploaded successfully
            // Inserting data into database
            $aff = $this->m_admin->update_problem($problem, $problem_id);
            if(!$aff) {
                if(isset($_POST['problem_tags']) && count($_POST['problem_tags']) > 0) {
                    $tagged = $this->tag_problem($problem_id, $_POST['problem_tags']);
                    if(!$tagged) {
                        $flag = false;
                        $total_error = 'Everything Went Fine, but somehow we managed to fail tagging your problem :( No worries, you can do that later, as always :)';
                        echo "<h1>$total_error</h1>";
                    }
                    else {
                        redirect(base_url($this->module.'/problem/view_problem?problem_id='.$problem_id));
                    }
                }
                else {
                    if($file_as_judge_input == 'on') {
                        // Deleting uploaded files in case of a failure of DB Query
                        $url = $this->judge_io_path.$problem['problem_judge_input'];
                        unlink($url);
                        $url = $this->judge_io_path.$problem['problem_judge_output'];
                        unlink($url);
                    }
                    if($problem_image['error'] == 0) {
                        $url = $this->problem_image_path.$problem['problem_image'];
                        unlink($url);
                    }
                    $flag = false;
                    $total_error = 'Something went wrong. Please try again later';
                    echo "<h1>$total_error</h1>";
                }
            }
            else {
                // Calling Tagging function to add all the tags to this problem
                if(isset($_POST['problem_tags']) && count($_POST['problem_tags']) > 0) {
                    $tagged = $this->tag_problem($problem_id, $_POST['problem_tags']);
                    if(!$tagged) {
                        $flag = false;
                        $total_error = 'Everything Went Fine, but somehow we managed to fail tagging your problem :( No worries, you can do that later, as always :)';
                        echo "<h1>$total_error</h1>";
                    }
                    else {
                        redirect(base_url($this->module.'/problem/view_problem?problem_id='.$problem_id));
                    }
                }
            }
        }
    } // End of update_problem

    public function tag_problem($problem_id, $tags) {
        $data = array();
        $i = 0;
        foreach($tags as $key => $tag) {
            if(!$this->m_admin->check_problem_tag($problem_id, $tag)) {
                $data[$i++] = array('category_id' => $tag, 'problem_id' => $problem_id);
            }
        }

        $affected = $this->m_admin->tag_a_problem($data);

        return $affected;
    } // End of tag_problem

    public function get_judge_io($problem_id) {
        $io = $this->m_admin->get_judge_io($problem_id);

        $arr = json_encode($io);

        echo $arr;
    } // End of get_judge_io

    public function delete_problem($problem_id) {
        $aff = $this->m_admin->delete_problem($problem_id);
        if($aff) echo 'yes';
        else echo 'no';
    }
}
