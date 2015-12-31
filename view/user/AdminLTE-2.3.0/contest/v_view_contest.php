<?php
  $language = array(1=>'GNU C', 2=>'GNU C++');
?>

<div class="submit_form" style="display:none;">
    <button class="submit_form_close btn btn-md btn-danger"><i class="fa fa-times"></i></button>
    <form role="form" method="post" action="<?php echo base_url($module.'/contest/submit'); ?>">
      <!-- select -->
      <div class="form-group">
        <label>Problem</label>
        <select name="problem_id" class="form-control">
        <?php
          $serial = 64;
        ?>
        <?php foreach($problems as $key => $problem) {?>
          <option value="<?php echo $problem->problem_id; ?>" id="option<?php printf("%c", ++$serial); ?>">
          Problem <?php printf("%c", $serial); ?>
          </option>
        <?php } ?>
        </select>
      </div>
      <!-- textarea -->
      <div class="form-group">
        <label>Submit Solution</label>
        <input type="hidden" name="contest_id" value="<?php echo $contest->contest_id; ?>" />
        <code>
        <textarea name="submission_source" placeholder="Paste Solution Here ..." class="form-control"></textarea>
        </code>
      </div>

      <!-- radio -->
      <div class="form-group">
        <label>Language</label>
        <?php
          $first = 'checked=""';
          foreach($language as $key => $lang) {
        ?>
        <div class="radio">
          <label>
            <input type="radio" <?php echo $first; ?> value="<?php echo $key; ?>" name="language_id">
            <?php echo $lang; ?>
          </label>
        </div>
        <?php
            $first = '';
          }
        ?>
      </div><!-- form-group ends -->

      <!-- textarea -->
      <div class="form-group">
        <button class="btn btn-md btn-primary pull-right" type="submit">Submit</button>
        <div class="clearfix"></div>
      </div>
    </form>
  </div><!-- submit_form ends -->

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1><?php echo $contest->contest_name; ?></h1>
      <!--
      <ol class="breadcrumb">
        <li><a href="<?php echo $fullpath; ?>#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Dashboard</li>
      </ol>
      -->
    </section>


    <section class="content-header contest_clock">
      <div class="row">
        <div class="col-xs-12">
          <h2 class="text-center countdown_timer">
            <div id="clockdiv">
              <?php
                if($contest->contest_status != 2) {
                  $current = date('Y-m-d H:i:s');
                  if($contest->contest_status == -1) { // Contest Waiting to Start
                    $end = $contest->contest_start;
                    echo '<h4>Time To Start</h4>';
                  }
                  else { // Contest Running
                    echo '<h4>Remaining Time</h4>';
                    $end = $contest->contest_end;
                  }
                  $current = date('D M d Y H:i:s O', strtotime($current));
                  $end = date('D M d Y H:i:s O', strtotime($end));
              ?>
                <span class="days" style="display:none"></span>
                <span class="hours"></span>:
                <span class="minutes"></span>:
                <span class="seconds"></span>
              <?php
                }
                else echo '<h4>Contest Ended</h4>';
              ?>
            </div><!-- Clockdiv ends -->
          </h2>
        </div><!-- col ends -->
      </div><!-- row ends -->
    </section><!-- contest clock ends -->

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-md-12">
          <div class="box">
            
            <div class="box-body">
              <div class="row">
              	<div class="col-xs-12">
	              <!-- Custom Tabs -->
	              <div class="nav-tabs-custom">
	                <ul class="nav nav-tabs">
	                  <li class="active"><a data-toggle="tab" href="#overview">Overview</a></li>
	                  <li><a data-toggle="tab" href="#problems">Problems</a></li>
	                  <li class="dropdown"><!-- submission -->
	                    <a href="#" data-toggle="dropdown" class="dropdown-toggle">
	                      Submissions <span class="caret"></span>
	                    </a>
	                    <ul class="dropdown-menu">
	                      <li><a data-toggle="tab" href="#submission_my">My</a></li>
	                      <li><a data-toggle="tab" href="#submission_all">All</a></li>
	                    </ul>
	                  </li><!-- submission ends -->
	                  <li class="dropdown"><!-- Clarifications -->
	                    <a href="#" data-toggle="dropdown" class="dropdown-toggle">
	                      Clarifications <span class="caret"></span>
	                    </a>
	                    <ul class="dropdown-menu">
	                      <li><a data-toggle="tab" href="#clar_my">My</a></li>
	                      <li><a data-toggle="tab" href="#clar_all">All</a></li>
	                    </ul>
	                  </li><!-- Clarifications ends -->
	                  <li><a data-toggle="tab" href="#ranklist">Ranklist</a></li>
	                </ul><!-- tabbed box end-->
	                <div class="tab-content">
	                  <div id="overview" class="tab-pane active">
	                    <table class="table table-striped table-bordered table-hover">
	                    	<thead>
	                    		<tr>
	                    			<!-- <th>Solved / Tried</th> -->
	                    			<th> # </th>
	                    			<th>Title</th>
	                    		</tr>
	                    	</thead>

	                    	<tbody>
	                    		<?php $serial = 'A'; ?>
	                    		<?php foreach($problems as $key => $problem) {?>
	                    		<tr>
	                    			<!-- <td>10/87</td> -->
	                    			<td><?php echo $serial; ?></td>
	                    			<td>
	                    				<a target="_blank" href="<?php echo base_url($this->module.'/contest/view_contest?contest_id='.$contest->contest_id.'#problems/'.$serial++); ?>">
	                    					<?php echo $problem->problem_name; ?>
	                    				</a>
	                    			</td>
	                    		</tr>
	                    		<?php } ?>
	                    	</tbody>
	                    </table>
	                  </div><!-- /.tab-pane -->
	                  <div id="problems" class="tab-pane">
	                  		<?php
	                  			if($contest->contest_status != -1) {
	                  		?>
		                  <div class="col-xs-12">
                            <!-- Custom Tabs -->
                            <div class="nav-tabs-custom">
                              <ul class="nav nav-tabs">
                              	<?php
                                  $serial = 'A';
                                  $first = true;
                                ?>
                                <?php foreach($problems as $key => $problem) {?>
                                <li class="<?php if($first) echo 'active'; ?>">
                                  <a href="#<?php echo $serial; ?>" data-toggle="tab" aria-expanded="<?php if($first) echo 'true'; else echo 'false'; ?>">
                                    <?php echo $serial++; ?>
                                  </a>
                                </li>
                                <?php $first = false; ?>
                                <?php } ?>
                              </ul>
                              <div class="tab-content">
                              	<?php
                              		$serial = 'A';
                              		$first = true;
                              		foreach($problems as $key => $problem) {
                              	?>
                              	<div class="tab-pane <?php if($first) echo 'active'; ?>" id="<?php echo $serial; ?>">
                              		<div class="row">
                              			<div class="col-xs-12">
                                      <?php if($contest->contest_status != 2) { ?>
                              				<button for="<?php echo $serial; ?>" class="submit_button btn btn-lg btn-primary">
                              					Submit Solution for Problem <?php echo $serial; ?>
                              				</button>
                                      <?php } ?>
                              				<h1><?php echo $serial++; ?> - <?php echo $problem->problem_name; ?></h1>
                              				<hr>
                              			</div>
                              			<div class="col-xs-12 oj_problem_specification">
                              				<div class="col-sm-3">
                              					<i class="ace-icon fa fa-clock-o blue"></i>
                              					<span class="blue"> <?php echo $problem->problem_time_limit; ?><span>
                              				</div>
                              				<div class="col-sm-3">
                              					<i class="ace-icon fa fa-hdd-o red"></i>
                              					<span class="red"> <?php echo $problem->problem_memory_limit; ?><span>
                              				</div>
                              				<div class="col-sm-3">
                              					<i class="ace-icon fa fa-angle-double-down green"></i>
                              					<span class="green"> <?php echo $problem->problem_input_channel; ?><span>
                              				</div>
                              				<div class="col-sm-3">
                              					<i class="ace-icon fa fa-angle-double-up green"></i>
                              					<span class="green"> <?php echo $problem->problem_output_channel; ?><span>
                              				</div>
                              			</div> <!-- problem specification ends -->
                              			<div class="col-xs-12 oj_problem_view">
                              				<hr />
                              				<h2>Problem Description</h2>
                              				<?php echo $problem->problem_description; ?>
                              				<!-- Problem Image -->
                              				<?php if($problem->problem_image != '') { ?>
                              				<div class="oj_problem_image">
                              					<img src="<?php echo base_url($this->problem_image_path.$problem->problem_image); ?>" alt="<?php echo $problem->problem_name; ?>" />
                              				</div>
                              				<?php } ?> <!-- Problem Image Ends -->
                              				<hr />
                              				<h2>Input</h2>
                              				<?php echo $problem->problem_input; ?>
                              				<hr />
                              				<h2>Output</h2>
                              				<?php echo $problem->problem_output; ?>
                              				<hr />
                              				<div class="col-sm-6">
                              					<h2>Sample Input</h2>
                              					<pre><?php echo $problem->problem_sample_input; ?></pre>
                              				</div>
                              				<div class="col-sm-6">
                              					<h2>Sample Output</h2>
                              					<pre><?php echo $problem->problem_sample_output; ?></pre>
                              				</div>
                              				<div class="clearfix"></div><hr />
                              				<?php if($problem->problem_hint != '') { ?>
                              				<h2>Hint</h2>
                              				<?php
                              						echo $problem->problem_hint;
                              					}
                              				?>
                              				<hr />
                              			</div> <!-- problem view ends -->
                              		</div><!-- row -->
                              	</div><!-- tab-pane ends -->
                              	<?php $first = false; ?>
                              	<?php } ?>
                              </div><!-- /.tab-content -->
                            </div><!-- nav-tabs-custom -->
                          </div>
                          <?php
                          	}
                          	else {
                          ?>
                          	<h1>Contest yet to start</h1>
                          <?php
                          	}
                          ?>
	                  </div><!-- /.tab-pane -->
	                  <div id="submission_my" class="tab-pane">
                      <table class="oj_datatable table table-striped table-bordered table-hover">
                        <thead>
                          <tr>
                            <th>Submission ID</th>
                            <th>Contestant</th>
                            <th>Problem</th>
                            <th>Language</th>
                            <th>CPU</th>
                            <th>Time</th>
                            <th>Status</th>
                          </tr>
                        </thead>

                        <tbody>
                          <?php 
                            foreach($submissions as $key => $submission) {
                              if($submission->user_id == $this->session->user_id) {
                          ?>
                          <tr>
                            <td><?php echo $submission->submission_id; ?></td>
                            <td><?php echo $users[$submission->user_id]; ?></td>
                            <td>
                              <a target="_blank" href="<?php echo base_url($this->module.'/contest/view_contest?contest_id='.$contest->contest_id.'#problems/'.$nos[$submission->problem_id]); ?>">
                              <?php echo $nos[$submission->problem_id]; ?>
                              </a>
                            </td>
                            <td><?php echo $language[$submission->language_id]; ?></td>
                            <td>
                              <?php
                                if($submission->submission_result != 3)
                                  printf("%.4fs", $submission->submission_tle);
                                else echo 'N/A';
                              ?>
                            </td>
                            <td><?php echo date('h:i A, M d, Y', strtotime($submission->submission_time)); ?></td>
                            <td><button class="btn btn-sm btn-<?php echo $verdict_class[$submission->submission_result]; ?>"><?php echo $verdict[$submission->submission_result]; ?></button></td>
                          </tr>
                          <?php
                              }
                            }
                          ?>
                        </tbody>
                      </table><!-- table ends -->
	                  </div><!-- /.tab-pane -->
	                  <div id="submission_all" class="tab-pane">
	                    <table class="oj_datatable table table-striped table-bordered table-hover">
                        <thead>
                          <tr>
                            <th>Submission ID</th>
                            <th>Contestant</th>
                            <th>Problem</th>
                            <th>CPU</th>
                            <th>Time</th>
                            <th>Status</th>
                          </tr>
                        </thead>

                        <tbody>
                          <?php foreach($submissions as $key => $submission) {?>
                          <tr class="<?php if($submission->user_id == $this->session->user_id) echo 'contestant'; ?>">
                            <td><?php echo $submission->submission_id; ?></td>
                            <td><?php echo $users[$submission->user_id]; ?></td>
                            <td>
                              <a href="<?php echo base_url($this->module.'/contest/view_problem?contest_id='.$contest->contest_id.'&problem='.$nos[$submission->problem_id]); ?>">
                              <?php echo $nos[$submission->problem_id]; ?>
                              </a>
                            </td>
                            <td>
                              <?php
                                if($submission->submission_result != 3)
                                  printf("%.4fs", $submission->submission_tle);
                                else echo 'N/A';
                              ?>
                            </td>
                            <td><?php echo date('h:i A, M d, Y', strtotime($submission->submission_time)); ?></td>
                            <td><button class="btn btn-sm btn-<?php echo $verdict_class[$submission->submission_result]; ?>"><?php echo $verdict[$submission->submission_result]; ?></button></td>
                          </tr>
                          <?php } ?>
                        </tbody>
                      </table><!-- table ends -->
	                  </div><!-- /.tab-pane -->
	                  <div id="clar_my" class="tab-pane">
                      <div class="col-md-12">
                        <div class="box box-success">
                          <div class="box-header ui-sortable-handle" style="cursor: move;">
                            <i class="fa fa-comments-o"></i>
                            <h3 class="box-title">My Clarifications</h3>
                          </div>
                          <div class="slimScrollDiv" style="position: relative;">

                            <div id="clar_success" class="clar_alert alert alert-success alert-dismissable">
                              <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                              <h4><i class="icon fa fa-check"></i> Success!</h4>
                            </div>
                            <div id="clar_error" class="clar_alert alert alert-danger alert-dismissable">
                              <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                              <h4><i class="icon fa fa-ban"></i> Failed to Submit Clarification!</h4>
                              Please try again a while later.
                            </div>

                            <div class="box-body chat" style="">
                            <?php
                              $clar_count = count($clarifications);
                              --$clar_count;
                              while($clar_count >= 0) {
                                $clar = $clarifications[$clar_count--];
                                if($clar->user_id == $this->session->user_id) {
                            ?>
                              <hr />
                              <!-- chat item -->
                              <div class="item">
                                <i class="online fa fa-user"></i>
                                <p class="message">
                                  <a class="name" href="#">
                                    <small class="text-muted pull-right">
                                      <i class="fa fa-clock-o"></i>
                                      <?php
                                        echo date('h:i A, M d, Y', strtotime($clar->clarification_time)); 
                                      ?>
                                    </small>
                                    <?php echo $users[$clar->user_id];
                                      if($clar->problem_id != NULL) echo " | [Problem ".$nos[$clar->problem_id]." ]";
                                      else echo ' | [General]';
                                      if($clar->clarification_status == 2)
                                        echo ' | [Ignored]';
                                    ?>
                                  </a>
                                  <?php echo $clar->clarification_question; ?>
                                </p>
                              </div><!-- /.item -->
                              <?php if($clar->clarification_status != 0 && $clar->clarification_status != 2) { ?>
                              <!-- chat item -->
                              <div class="item item_judge">
                                <i class="online fa fa-user-secret"></i>
                                <p class="message">
                                  <a class="name" href="#">Judge</a>
                                  <?php echo $clar->clarification_reply; ?>
                                </p>
                              </div><!-- /.item -->
                              <?php } ?>
                              <?php } ?>
                            <?php } ?>
                            </div>
                          </div><!-- /.chat -->
                          <div class="box-footer">
                            <form class="submit_clar" action="" method="post">
                              <div class="col-sm-3 col-md-2">
                                <div class="form-group">
                                  <select id="clarification_problem_id" class="form-control">
                                    <option value="">General</option>
                                  <?php
                                    $serial = 64;
                                  ?>
                                  <?php foreach($problems as $key => $problem) {?>
                                    <option value="<?php echo $problem->problem_id; ?>">
                                    Problem <?php printf("%c", ++$serial); ?>
                                    </option>
                                  <?php } ?>
                                  </select>
                                </div>
                              </div>
                              <div class="col-sm-9 col-md-10">
                                <div class="input-group">
                                  <input id="clarification_question" placeholder="Type your question..." class="form-control">
                                  <div class="input-group-btn">
                                    <button type="submit" class="btn btn-success"><i class="fa fa-plus"></i></button>
                                  </div>
                                </div>
                              </div>
                            </form>
                          </div><!-- box-footer ends -->
                        </div> <!-- chat box end -->
                      </div><!-- col-md-12 -->
	                  </div><!-- /.tab-pane -->
	                  <div id="clar_all" class="tab-pane">
                      <div class="col-md-12">
                        <div class="box box-success">
                          <div class="box-header ui-sortable-handle" style="cursor: move;">
                            <i class="fa fa-comments-o"></i>
                            <h3 class="box-title">All Clarifications</h3>
                          </div>
                          <div class="slimScrollDiv" style="position: relative;">
                            <div class="box-body chat" style="">
                            <?php
                              foreach($clarifications as $key => $clar) {
                            ?>
                              <hr />
                              <!-- chat item -->
                              <div class="item">
                                <i class="online fa fa-user<?php if($clar->user_id == NULL) echo '-secret'; ?>"></i>
                                <p class="message">
                                  <a class="name" href="#">
                                    <small class="text-muted pull-right">
                                      <i class="fa fa-clock-o"></i>
                                      <?php
                                        echo date('h:i A, M d, Y', strtotime($clar->clarification_time)); 
                                      ?>
                                    </small>
                                    <?php 
                                      if($clar->user_id != NULL) {
                                        echo $users[$clar->user_id];
                                        if($clar->problem_id != NULL) echo " | [Problem ".$nos[$clar->problem_id]." ]";
                                        else echo ' | [General]';
                                        if($clar->clarification_status == 2)
                                          echo ' | [Ignored]';
                                      }
                                      else echo 'Judge Clarification';
                                    ?>
                                  </a>
                                  <?php echo htmlentities($clar->clarification_question); ?>
                                </p>
                              </div><!-- /.item -->
                              <?php if($clar->clarification_status != 0 && $clar->clarification_status != 2) { ?>
                              <!-- chat item -->
                              <div class="item item_judge">
                                <i class="online fa fa-user-secret"></i>
                                <p class="message">
                                  <a class="name" href="#">Judge</a>
                                  <?php echo htmlentities($clar->clarification_reply); ?>
                                </p>
                              </div><!-- /.item -->
                              <?php } ?>
                            <?php } ?>
                            </div><!-- box-body chat ends -->
                          </div><!-- /.chat -->
                        </div> <!-- chat box end -->
                      </div><!-- col-md-12 -->
	                  </div><!-- /.tab-pane -->
	                  <div id="ranklist" class="tab-pane">
                      <table class="oj_datatable table table-striped table-bordered table-hover">
                        <thead>
                          <tr>
                            <th class="problem_no">#</th>
                            <th>Contestant/Team</th>
                            <th class="problem_no">Total</th>
                            <th>&nbsp;</th>
                              <?php
                                $serial = 64;
                                foreach($problems as $key => $problem) {
                              ?>
                              <th class="problem_no">
                                <?php printf("%c", ++$serial); ?><br />
                                <?php echo $prob_tried_solved[$problem->problem_id]['solved'].'/'.$prob_tried_solved[$problem->problem_id]['tried']; ?>
                              </th>
                            <?php
                              }
                            ?>
                          </tr>
                        </thead>

                        <tbody>
                            <?php
                              $order = 0;
                              foreach($ranklist as $key => $rank) {
                            ?>
                            <tr class="<?php if($rank->user_id == $this->session->user_id) echo 'contestant'; ?>">
                              <td class="rank_user problem_no">
                              <?php
                                if($key > 0) {
                                  if($rank->rank_solved != $ranklist[$key-1]->rank_solved ||
                                    $rank->rank_penalty != $ranklist[$key-1]->rank_penalty) {
                                    ++$order;
                                  }
                                }
                              else ++$order;
                                echo $order;
                              ?>
                              </td>
                            <td class="rank_user">
                              <?php echo $users[$rank->user_id]; ?>
                            </td>
                            <td class="problem_no"><button class="total_box rank_box btn btn-sm btn-primary">
                              <?php
                                echo $rank->rank_solved;
                                echo ' / ';
                                echo $rank->rank_penalty.'<br />';

                              ?>
                              </button>
                            </td>
                            <td>&nbsp;</td>
                            <?php
                              $c_rank = explode(',', $rank->rank_details);
                              for($i=0, $k=0; $k < $count; ++$k, $i += 3) {
                                $try = $c_rank[$i];
                                $time = $c_rank[$i+1];
                                if($time > 0) {
                                    $minutes = $time%60;
                                    if($minutes < 10) $minutes = '0'.$minutes;
                                    $time = (int)($time/60).':'.$minutes;
                                }
                                else $time = '- : - -';
                                $penalty = $c_rank[$i+2];
                            ?>
                              <td class="problem_no">
                                <button class="rank_box btn btn-sm btn-<?php if($penalty && $try) echo 'success'; else if(!$penalty && $try) echo 'danger'; else echo 'defautl'; ?>">
                                  <?php echo $try.' ('.$time.')<br />'.$penalty; ?>
                                </button>
                              </td>
                            <?php
                              }
                            ?>
                          </tr>
                          <?php } ?>
                        </tbody>
                      </table>
	                  </div><!-- /.tab-pane -->
	                  <div class="clearfix"></div>
	                </div><!-- /.tab-content -->
	              </div><!-- nav-tabs-custom -->
	            </div>
              </div><!-- /.row -->
            </div><!-- ./box-body -->
          </div><!-- /.box -->
        </div><!-- /.col -->
      </div><!-- /.row -->
    </section><!-- /.content -->
  </div><!-- /.content-wrapper -->

