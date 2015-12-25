<?php
	$language = array(1=>'GNU C11', 2=>'GNU C++14');
?>

<div class="my_modal">
	<span class="my_modal_close btn btn-md btn-danger"><i class="ace-icon fa fa-times bigger-110"></i></span>
	<div class="my_modal_body">
		<form class="judge_reply_form">
			<div class="form-group">
			  <label class="col-xs-12 no-padding-right" for="problem_name">
			    <h4 class="clar_question"></h4>
			    <hr />
			  </label>
			  <div class="col-xs-12">
			  	<p>Judge Reply:</p>
			    <textarea class="clar_reply form-control" class="col-xs-12"></textarea>
			    <input id="clar_id" type="hidden" value="" />
			  </div>
			</div>
			<div class="clearfix form-actions">
				<br />
			    <button type="submit" class="btn btn-info pull-right">
			      <i class="ace-icon fa fa-reply bigger-110"></i>
			      Reply
			    </button>
			    <span class="btn btn-danger" id="ignore_button">
			      <i class="ace-icon fa fa-ban bigger-110"></i>
			      Ignore
			    </span>
			</div>
		</form>
	</div>
</div><!-- my_modal ends -->

<div id="clar_success" class="clar_alert alert alert-success alert-dismissable">
  <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
  <h4><i class="icon fa fa-check"></i> Success!</h4>
</div>
<div id="clar_error" class="clar_alert alert alert-danger alert-dismissable">
  <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
  <h4><i class="icon fa fa-ban"></i> Failed to Submit Clarification!</h4>
  Please try again a while later.
</div>


<div class="page-content">
	<div class="page-header">
		<div class="page_actions pull-right">
			<button class="btn btn-sm btn-info active" id="view_row">View</button>
			<button class="btn btn-sm btn-warning" id="edit_row">Edit</button>
		</div>
		<h1><?php echo $contest->contest_name; ?></h1>
	</div><!-- /.page-header -->
	<?php
	$type = array('Selective Contest', 'Private Contest', 'Public Contest');
	$status = array(-1 => 'Waiting to Start', 0 => 'Contest Running', 1 => 'Contest Running', 2 => 'Contest Ended');
	$status_class = array(-1 => 'battery-full', 0 => 'battery-half', 1 => 'battery-half', 2 => 'battery-empty');
	?>

	<div class="row">						
		<div class="col-xs-12 oj_problem_specification oj_contest_specification">		
			<div class="col-sm-3" title="Contest Type">
				<i class="ace-icon fa fa-lock blue"></i>
				<span class="blue"> <?php echo $type[$contest->contest_type]; ?><span>
			</div>
			<div class="col-sm-3" title="Contest Start">
				<i class="ace-icon fa fa-clock-o green"></i>
				<span class="green"> <?php echo date('h:i A, M d, Y', strtotime($contest->contest_start)); ?><span>
			</div>
			<div class="col-sm-3" title="Contest End">
				<i class="ace-icon fa fa-clock-o red"></i>
				<span class="red"> <?php echo date('h:i A, M d, Y', strtotime($contest->contest_end)); ?><span>
			</div>
			<div class="col-sm-3"  title="Contest Status">
				<i class="ace-icon fa fa-<?php echo $status_class[$contest->contest_status]; ?> orange"></i>
				<span class="orange"> <?php echo $status[$contest->contest_status]; ?><span>
			</div>
		</div><!-- col-xs-12 -->
		<div class="col-xs-12">
			<div class="progress progress-striped progress-small">
				<div style="width: 60%" class="progress-bar progress-bar-success <?php if($contest->contest_status == 0 || $contest->contest_status == 1) echo 'active'; ?>"></div>
			</div>
		</div>
		<div class="col-xs-12 edit_row" style="display:none">
			<div class="clearfix">
				<div class="pull-left tableTools-container"></div>
				<ul class="pull-right nav nav-pills">
					<?php if($contest->contest_status == -1) { ?>
					<li class="active">
						<a data-toggle="modal" role="button" href="#add_problems">
							Add Problem(s)
						</a>
					</li>
					<?php } ?>
					<li class="active">
						<a href="<?php echo base_url().$this->module.'/contest/manage_judges?contest_id='.$contest->contest_id; ?>">Manage Judges</a>
					</li>
					<li class="active">
						<a href="<?php echo base_url().$this->module.'/contest/manage_contestants?contest_id='.$contest->contest_id; ?>">Manage Contestants</a>
					</li>
					<li class="active">
						<a href="<?php echo base_url().$this->module.'/contest/edit_contest/'.$contest->contest_id; ?>">Edit Contest Info</a>
					</li>
					<div class="clearfix"></div>
				</ul>
			</div>
			<div>
				<table class="oj_datatable table table-striped table-bordered table-hover">
					<thead>
						<tr>
							<th>Problem Title</th>
							<th class="oj_tag_column">Tags</th>
							<th class="hidden-480 oj_tl_ml" title="Time Limit">TL</th>
							<th class="hidden-480 oj_tl_ml" title="Memory Limit">ML</th>

							<th class="oj_description_column">
								<i class="ace-icon fa fa-clock-o bigger-110 hidden-480"></i>
								Description
							</th>
							<th>Setter</th>
							<th class="hidden-480">Date Added</th>

							<th class="oj_option_col">Options</th>
						</tr>
					</thead>

					<tbody>
						<?php foreach($problems as $key => $problem) {?>
						<tr id="problem<?php echo $problem->problem_id; ?>">
							<td>
								<a href="<?php echo base_url($this->module.'/problem/view_problem?problem_id='.$problem->problem_id); ?>">
									<?php echo $problem->problem_name; ?>
								</a>
							</td>
							<td class="oj_tag_column">
								<?php foreach ($individual_tags[$key] as $tag) { ?>
								<span class="tag_pill btn btn-info btn-xs">
									<a href="#"><?php echo $tag->category_name; ?></a>
								</span>
								<?php } ?>
							</td>
							<td class="hidden-480 oj_tl_ml"><?php echo $problem->problem_time_limit; ?></td>
							<td class="hidden-480 oj_tl_ml"><?php echo $problem->problem_memory_limit; ?></td>
							<td class="oj_description_column"><?php echo $problem->problem_excerpt; ?></td>

							<td><?php echo $problem->problem_setter; ?></td>
							<td class="hidden-480"><?php echo date('h:i A, M d, Y', strtotime($problem->problem_add_date)); ?></td>

							<td class="oj_option_col">
								<div class="action-buttons">
									<a class="blue col-xs-2" href="#" title="View Judge I/O">
										<i class="ace-icon fa fa-eye bigger-130"></i>
									</a>
									<?php if($contest->contest_status == -1) { ?>
									<a class="red col-xs-2 remove_problem" href="#" problemid="<?php echo $problem->problem_id; ?>" contestid="<?php echo $contest->contest_id; ?>" title="Remove from this Contest">
										<i class="ace-icon fa fa-trash-o bigger-130"></i>
									</a>
									<?php } ?>
								</div>
							</td>
						</tr>
						<?php } ?>
					</tbody>
				</table>
			</div>
		</div><!-- col-xs-12, admin_view -->
		<div class="col-xs-12 view_row">
			<div class="tabbable">
				<ul class="nav nav-tabs">
					<li class="active">
						<a href="#overview" data-toggle="tab" aria-expanded="true">Overview</a>
					</li>
					<li class="">
						<a href="#problems" data-toggle="tab" aria-expanded="true">Problem</a>
					</li>
					<li class="">
						<a href="#submissions" data-toggle="tab" aria-expanded="true">Submissions</a>
					</li>

					<li class="">
						<a href="#clar" data-toggle="tab" aria-expanded="false">
							Clarifications
							<span class="badge badge-warning">4</span>
						</a>
					</li>
					<li class="">
						<a href="#ranklist" data-toggle="tab" aria-expanded="true">Ranklist</a>
					</li>
				</ul>

				<div class="tab-content">
					<div class="tab-pane fade active in" id="overview">
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
					</div>
					<div class="tab-pane fade" id="problems">
						<div class="tabbable">
							<ul class="nav nav-tabs padding-12 tab-color-blue background-blue">
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
								<div class="tab-pane fade <?php if($first) echo 'active in'; ?>" id="<?php echo $serial++; ?>">
									<div class="row">
										<div class="col-xs-12">
											<h1><?php echo $problem->problem_name; ?></h1>
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
											<h2>Problem Description</h2><hr />
											<?php echo $problem->problem_description; ?>
											<!-- Problem Image -->
											<?php if($problem->problem_image != '') { ?>
											<div class="oj_problem_image">
												<img src="<?php echo base_url($this->problem_image_path.$problem->problem_image); ?>" alt="<?php echo $problem->problem_name; ?>" />
											</div>
											<?php } ?> <!-- Problem Image Ends -->
											<h2>Input</h2><hr />
											<?php echo $problem->problem_input; ?>
											<h2>Output</h2><hr />
											<?php echo $problem->problem_output; ?>
											<div class="col-sm-6">
												<h2>Sample Input</h2><hr />
												<pre><?php echo $problem->problem_sample_input; ?></pre>
											</div>
											<div class="col-sm-6">
												<h2>Sample Output</h2><hr />
												<pre><?php echo $problem->problem_sample_output; ?></pre>
											</div>
											<div class="clearfix"></div>
											<?php if($problem->problem_hint != '') { ?>
											<h2>Hint</h2><hr />
											<?php
													echo $problem->problem_hint;
												}
											?>
										</div> <!-- problem view ends -->
									</div><!-- row -->
								</div>
								<?php $first = false; ?>
								<?php } ?>
							</div><!-- problem tab tab-content ends -->
						</div><!-- problem_tab tabable ends -->
					</div>
					<div class="tab-pane fade" id="submissions">
	                    <table class="oj_datatable table table-striped table-bordered table-hover">
                        <thead>
                          <tr>
                          	<th>Submission ID</th>
                            <th>Contestant</th>
                            <th>Problem</th>
                            <th>Language</th>
                            <th>Time</th>
                            <th>Status</th>
                            <th>Actions</th>
                          </tr>
                        </thead>

                        <tbody>
                          <?php foreach($submissions as $key => $submission) {?>
                          <tr>
                            <td><?php echo $submission->submission_id; ?></td>
                            <td><?php echo $users[$submission->user_id]; ?></td>
                            <td>
                              <a target="_blank" href="<?php echo base_url($this->module.'/contest/view_contest?contest_id='.$contest->contest_id.'#problems/'.$nos[$submission->problem_id]); ?>">
                              <?php echo $nos[$submission->problem_id]; ?>
                              </a>
                            </td>
                            <td><?php echo $language[$submission->language_id]; ?></td>
                            <td><?php echo date('h:i A, M d, Y', strtotime($submission->submission_time)); ?></td>
                            <td><?php echo $verdict[$submission->submission_result]; ?></td>
                            <td>
                            	<div class="action-buttons">

									<a title="Judge" href="<?php echo base_url($module.'/contest/compile/'.$submission->submission_id); ?>" class="blue col-xs-2">
										<i class="ace-icon fa fa-cog bigger-130"></i>
									</a>
								</div>
                            </td>
                          </tr>
                          <?php } ?>
                        </tbody>
                      </table><!-- table ends -->
					</div>
					<div class="tab-pane fade" id="clar">
						<div class="">
				        <form id="judge_clarification">
				          <div class="form-actions">
				            <div class="input-group">
				              <input id="judge_clar_text" type="text" class="form-control" placeholder="Declare Judge Clarification here ...">
				              <span class="input-group-btn">
				                <button type="submit" class="btn btn-sm btn-info no-radius">
				                  <i class="ace-icon fa fa-share"></i>
				                  Send
				                </button>
				              </span>
				            </div>
				          </div>
				        </form>
						<?php
							foreach($clarifications as $key => $clar) {
						?>
				          <div class="itemdiv dialogdiv <?php echo 'clar'.$clar->clarification_id; ?>">
				            <div class="user">
				                <i class="<?php if($clar->clarification_status == 0 && $clar->user_id != NULL) echo 'new ' ?>clar_user ace-icon fa fa-user<?php if($clar->user_id == NULL) echo '-secret'; ?>"></i>
				            </div>
				            <div class="body">
				              <div class="time">
				                <i class="ace-icon fa fa-clock-o"></i>
				                <span class="green"><?php echo date('h:i A, M d, Y', strtotime($clar->clarification_time)); ?></span>
				                <a href="" class="delete_clar" clarid="<?php echo $clar->clarification_id; ?>">
				                	<i class="ace-icon fa fa-trash-o red bigger130"></i>
				                </a>
				              </div>

				              <div class="name">
				                <a href="#">
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
				              </div>
				              <div class="text"><?php echo $clar->clarification_question; ?></div>
				              <?php if($clar->clarification_status == 0 && $clar->user_id != NULL) { ?>
				              <div class="tools">
				                <a id="<?php echo $clar->clarification_id; ?>" class="judge_reply_button btn btn-minier btn-info" href="#">
				                  <i class="icon-only ace-icon fa fa-share"></i>
				                </a>
				              </div>
				              <?php } ?>
				            </div><!-- body ends -->
				          </div><!-- itemdiv ends -->
					          <?php if($clar->clarification_status != 0 && $clar->clarification_status != 2) { ?>
					          <div class="itemdiv dialogdiv reply_div <?php echo 'clar'.$clar->clarification_id; ?>">
					            <div class="user">
					                <i class="clar_user ace-icon fa fa-user-secret"></i>
					            </div>
					            <div class="body">
					              <div class="name">
					                <a href="#">Judge Reply</a>
					              </div>
					              <div class="text"><?php echo $clar->clarification_reply; ?></div>
					            </div><!-- body ends -->
					          </div><!-- itemdiv ends -->
					          <?php } ?>
				          <?php } ?>
						</div><!-- chatbox ends -->
					</div><!-- clarifications ends -->
					<div class="tab-pane fade" id="ranklist">
						<table class="oj_datatable table table-striped table-bordered table-hover">
	                        <thead>
	                          <tr>
	                            <th class="problem_no">#</th>
	                            <th>Contestant/Team</th>
	                            <th class="problem_no">Total</th>
	                            <td>&nbsp;</td>
	                            <?php
	                              $serial = 64;
	                              for($i = 0; $i< $count; ++$i) {
	                            ?>
	                            <th class="problem_no"><?php printf("%c", ++$serial); ?></th>
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
	                          <tr>
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
	                            <td class="problem_no"><button class="rank_box btn btn-sm btn-primary">
	                              <?php
	                                echo $rank->rank_solved;
	                                echo '<br />';
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
					</div>
				</div><!-- tab-content ends -->
			</div><!-- Tabable Ends -->
		</div><!-- col-xs-12, contestant view -->
		<?php if($contest->contest_status == -1) { ?>
		<div tabindex="-1" class="modal fade" id="add_problems" style="display: none;" aria-hidden="true">
			<form action="<?php echo base_url($module.'/contest/add_problems') ?>" method="post">
				<input type="hidden" name="contest_id" value="<?php echo $contest->contest_id; ?>" />
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header no-padding">
							<div class="table-header">
								<button aria-hidden="true" data-dismiss="modal" class="close" type="button">
									<span class="white">×</span>
								</button>
								Problems
							</div>
						</div>

						<div class="modal-body no-padding">
							<table class="oj_datatable table table-striped table-bordered table-hover">
								<thead>
									<tr>
										<th class="center">
										</th>
										<th>Problem Title</th>
										<th class="oj_tag_column">Tags</th>
										<th class="hidden-480 oj_tl_ml" title="Time Limit">TL</th>
										<th class="hidden-480 oj_tl_ml" title="Memory Limit">ML</th>

										<th class="oj_description_column">
											<i class="ace-icon fa fa-clock-o bigger-110 hidden-480"></i>
											Description
										</th>
										<th>Setter</th>
										<th class="hidden-480">Date Added</th>
									</tr>
								</thead>

								<tbody>
									<?php foreach($all_problems as $key => $problem) {?>
									<tr>
										<td class="center">
											<label class="pos-rel">
												<input name="problem_id[]" value="<?php echo $problem->problem_id; ?>" type="checkbox" class="ace" />
												<span class="lbl"></span>
											</label>
										</td>
										<td>
											<a href="<?php echo base_url($this->module.'/problem/view_problem?problem_id='.$problem->problem_id); ?>">
												<?php echo $problem->problem_name; ?>
											</a>
										</td>
										<td class="oj_tag_column">
											<?php foreach ($all_tags[$key] as $tag) { ?>
											<span class="tag_pill btn btn-info btn-xs">
												<a href="#"><?php echo $tag->category_name; ?></a>
											</span>
											<?php } ?>
										</td>
										<td class="hidden-480 oj_tl_ml"><?php echo $problem->problem_time_limit; ?></td>
										<td class="hidden-480 oj_tl_ml"><?php echo $problem->problem_memory_limit; ?></td>
										<td class="oj_description_column"><?php echo $problem->problem_description; ?></td>

										<td><?php echo $problem->problem_setter; ?></td>
										<td class="hidden-480"><?php echo date('h:i A, M d, Y', strtotime($problem->problem_add_date)); ?></td>
									</tr>
									<?php } ?>
								</tbody>
							</table>
						</div>

						<div class="modal-footer no-margin-top">
							<button class="btn btn-sm btn-info pull-right">
								<i class="ace-icon fa fa-plus"></i>
								Add
							</button>
						</div>
					</div><!-- /.modal-content -->
				</div><!-- /.modal-dialog -->
			</form>
		</div><!-- Modal End -->
		<?php } ?>
	</div>	<!-- row ends -->
</div> <!-- page content ends -->
