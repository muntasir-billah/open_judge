<?php

class OJ_Controller extends CI_Controller
{

	public $problem_image_path = 'problem_images/';	// Directory to upload problem images
	public $judge_io_path = 'judge_io/';				// Directory to upload Judge I/O
	public $sandbox_path = 'sandbox/';					// Directory to the sandbox
	public $verdict = array('In Queue', 'Accepted', 'Wrong Answer', 'Time Limit Exceeded', 'Runtime Error', 'Compilation Error', 'Memory Limit Exceeded', 'Ignored');
    public $verdict_class = array('primary', 'success', 'danger', 'danger', 'danger', 'warning', 'danger', 'default');

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

    public function __is_running($contest_id) {
    	$status = $this->m_admin->if_contest_running($contest_id);
    	$status = $status->contest_status;

    	if($status == 0 || $status ==1) return true;
    	else return false;
    }

    public function __remove_dir($dir) { 
		if (is_dir($dir)) { 
			$objects = scandir($dir); 
			foreach ($objects as $object) { 
				if ($object != "." && $object != "..") { 
					if (is_dir($dir."/".$object)) rrmdir($dir."/".$object);
					else unlink($dir."/".$object); 
				} 
			}
			rmdir($dir); 
		} 
	}

	public function __process($submission_id) {
        $submission = $this->m_admin->get_single_submission($submission_id);
        $problem = $this->m_admin->get_single_problem_full($submission->problem_id);
        $contest = $this->m_admin->get_single_contest($submission->contest_id);

        $result = 0;

        $sandbox = $this->config->item('root').$this->sandbox_path.$submission->submission_id;
        mkdir($sandbox);

        echo $sandbox.'<br /><br />';
        // echo '<pre>';
        // echo $submission->submission_source;
        // echo '</pre>';
        //exit();

        $ext = array(1=>'.c', 2=>'.cpp');
        $compiler = array(1=>'gcc', 2=>'g++');


        $file_name = 'program';

        $output = $file_name.'.out';
        $input = 'judge.in';

        $error = 'error.txt';
        $fault = 'fault.txt';

        $filename = $file_name.$ext[$submission->language_id];
        
        $program = fopen($sandbox.'/'.$filename, "w");
        fwrite($program, $submission->submission_source);

        $judge_in = fopen($sandbox.'/'.'judge.in', "w");
        fwrite($judge_in, $problem->problem_judge_input);

        $judge_out = fopen($sandbox.'/'.'judge.out', "w");
        fwrite($judge_out, $problem->problem_judge_output);

        $ret = $this->__compile($problem->problem_time_limit, $compiler[$submission->language_id], $sandbox, $ext[$submission->language_id], $filename, $file_name, $output, $input, $error, $fault);

         /*
        Verdicts============

        0 -> In Queue
        1 -> AC
        2 -> WA
        3 -> TLE
        4 -> RE
        5 -> CE
        6 -> MLE

        $verdict = array('In Queue', 'AC', WA', 'TLE', 'RE', 'CE', 'MLE');

        */
        
        fclose($program);
        fclose($judge_in);
        fclose($judge_out);
        $judge_out = 'judge.out';

        // $point = fopen($sandbox.'/'.$error, "r"); // Checking for compilation error
        // $content = fread($point,filesize($sandbox.'/'.$error));
        // fclose($point);
        if(filesize($sandbox.'/'.$error) > 0) {
            echo 'Compilation Error';
            $result = 5;
        }
        else {
            // echo $ret['time'].'<br />';
            // echo $ret['return_val'].'<br />';
            // $point = fopen($sandbox.'/'.$fault, "r"); // Runtime Error
            // $content = fread($point,filesize($sandbox.'/'.$fault));
            // fclose($point);
            if($ret['time'] >= ($problem->problem_time_limit/1000)) { // Time Limit Exceeded
                echo 'Time Limit Exceeded';
                $result = 3;
            }
            else {
                if(filesize($sandbox.'/'.$fault) > 0 || $ret['return_val'] != 0) {
                    echo 'Runtime Error';
                    $result = 4;
                }
                else {
                    if(filesize($sandbox.'/'.$output) == filesize($sandbox.'/'.$judge_out)) {
                        // Wrong Answer

                        $point = fopen($sandbox.'/'.$output, "r"); 
                        $content = fread($point,filesize($sandbox.'/'.$output));
                        fclose($point);

                        $point2 = fopen($sandbox.'/'.$judge_out, "r");
                        $content2 = fread($point2,filesize($sandbox.'/'.$judge_out));
                        fclose($point2);

                        if($content != $content2) {
                            echo '1st Wrong Answer: Output doesn\'t Match exactly ';
                            $result = 2;
                        }
                        else {
                            echo 'Accepted';
                            $result = 1;
                        }
                    }
                    else {
                        echo '2nd Wrong Answer: Output file size doesn\'t match';
                        $result = 2;
                    }
                }
            }
        } // Processing Ends 
        $this->__remove_dir($sandbox);
        return $result;

    }

    public function __compile($time, $compiler, $path, $ext, $file, $file_name, $output, $input, $error, $fault) {
        echo '<pre>';
        $time /= 1000; // Converting to Seconds;
        $tle = 'timeout '.$time.'s ';

        $return_val = '';

        $gener = '';

        $command = "$compiler $path/$file -o $path/$file_name 2> $path/$error";

        //echo $command.'<br />';

        exec($command); // compiling

        $command = "$path/$file_name < $path/$input > $path/$output 2> $path/$fault";

        $command = $tle.$command; // Adding Time Limit to the Command
        //echo $command.'<br />';

        $time_start = microtime(true);
        exec($command, $gener, $return_val); //running;
        $time_end = microtime(true);

        $total_time = $time_end - $time_start;

        $ret = array('time' => $total_time, 'return_val' => $return_val);

        return $ret;

    }

}

?>