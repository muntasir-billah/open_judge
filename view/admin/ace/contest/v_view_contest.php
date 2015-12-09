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
					<li class="active">
						<a data-toggle="modal" role="button" href="#add_problems">
							Add Problem(s)
						</a>
					</li>
					<li class="active">
						<a href="<?php echo base_url().$this->module.'/contest/manage_judges?contest_id='.$contest->contest_id; ?>">Manage Judges</a>
					</li>
					<li class="active">
						<a href="<?php echo base_url().$this->module.'/contest/manage_contestants?contest_id='.$contest->contest_id; ?>">Manage Contestants</a>
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

									<a class="red col-xs-2 remove_problem" href="#" problemid="<?php echo $problem->problem_id; ?>" contestid="<?php echo $contest->contest_id; ?>" title="Remove from this Contest">
										<i class="ace-icon fa fa-trash-o bigger-130"></i>
									</a>
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
									<th>Solved / Tried</th>
									<th> # </th>
									<th>Title</th>
								</tr>
							</thead>

							<tbody>
								<?php $serial = 64; ?>
								<?php foreach($problems as $key => $problem) {?>
								<tr>
									<td>10/87</td>
									<td><?php printf("Problem %c", ++$serial); ?></td>
									<td>
										<a href="<?php echo base_url($this->module.'/problem/view_problem?problem_id='.$problem->problem_id); ?>">
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
									$serial = 64;
									$first = true;
								?>
								<?php foreach($problems as $key => $problem) {?>
								<li class="<?php if($first) echo 'active'; ?>">
									<a href="#<?php echo ++$serial; ?>" data-toggle="tab" aria-expanded="<?php if($first) echo 'true'; else echo 'false'; ?>">
										<?php printf("%c", $serial); ?>
									</a>
								</li>
								<?php $first = false; ?>
								<?php } ?>
							</ul>

							<div class="tab-content">
								<?php
									$serial = 64;
									$first = true;
									foreach($problems as $key => $problem) {
								?>
								<div class="tab-pane fade <?php if($first) echo 'active in'; ?>" id="<?php echo ++$serial; ?>">
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
						Submissions
					</div>
					<div class="tab-pane fade" id="clar">
						<div class="row">
							<div class="col-xs-12 col-sm-10 col-sm-offset-1">
								<div class="timeline-container">
									<div class="timeline-label">
										<span class="label label-primary arrowed-in-right label-lg">
											<b>AJAX Contest</b>
										</span>
									</div>

									<div class="timeline-items">
										<div class="timeline-item clearfix">
											<div class="timeline-info">
												<img src="<?php echo $fullpath; ?>assets/avatars/avatar2.png" alt="Susan't Avatar">
												<span class="label label-info label-sm">16:22</span>
											</div>

											<div class="widget-box transparent">
												<div class="widget-header">
													<h5 class="widget-title smaller">
														<span class="blue">IST_CodePanda</span>
													</h5>
													<span class="widget-toolbar">
														<i class="ace-icon fa fa-clock-o bigger-110"></i>
														4:22 PM
													</span>
													<span class="widget-toolbar">
														<a href="#" title="Reply"><i class="ace-icon fa fa-reply green"></i></a>
														<a href="#" title="Ignore"><i class="ace-icon fa fa-ban orange"></i></a>
														<a href="#" title="Delete"><i class="ace-icon fa fa-times red bigger-110"></i></a>
													</span>
												</div>

												<div class="widget-body" style="display: block;">
													<div class="widget-main">
														Where can I get the STL Library content?
														<div class="space-6"></div>
													</div>
												</div>
											</div>
										</div><!-- timeline-item ends -->

										<div class="timeline-item clearfix">
											<div class="timeline-info">
												<img src="<?php echo $fullpath; ?>assets/avatars/avatar5.png" alt="Susan't Avatar">
												<span class="label label-info label-sm">16:22</span>
											</div>

											<div class="widget-box transparent">
												<div class="widget-body">
													<div class="widget-main">You can download it at www.example.com</div>
												</div>
											</div>
										</div><!-- timeline-item ends -->
										<div class="timeline-item clearfix" style="box-shadow: 0 0 4px #005dff;">
											<div class="timeline-info">
												<img src="<?php echo $fullpath; ?>assets/avatars/avatar2.png" alt="Susan't Avatar">
												<span class="label label-info label-sm">16:22</span>
											</div>

											<div class="widget-box transparent">
												<div class="widget-header">
													<h5 class="widget-title smaller">
														<span class="blue">IST_CodePanda</span>
													</h5>
													<span class="widget-toolbar">
														<i class="ace-icon fa fa-clock-o bigger-110"></i>
														4:22 PM
													</span>
													<span class="widget-toolbar">
														<a href="#" title="Reply"><i class="ace-icon fa fa-reply green"></i></a>
														<a href="#" title="Ignore"><i class="ace-icon fa fa-ban orange"></i></a>
														<a href="#" title="Delete"><i class="ace-icon fa fa-times red bigger-110"></i></a>
													</span>
												</div>

												<div class="widget-body" style="display: block;">
													<div class="widget-main">
														Where can I get the STL Library content?
														<div class="space-6"></div>
													</div>
												</div>
											</div>
										</div><!-- timeline-item ends -->
									</div><!-- /.timeline-items -->
								</div><!-- /.timeline-container -->
							</div><!-- col-xs-12 ends -->
						</div><!-- row ends -->
					</div><!-- clarifications ends -->
					<div class="tab-pane fade" id="ranklist">
						<table class="oj_datatable table table-striped table-bordered table-hover">
							<thead>
								<tr>
									<th>Problem Title</th>
									<th>Problem Dash</th>
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
									<td>
										<a href="<?php echo base_url($this->module.'/problem/view_problem?problem_id='.$problem->problem_id); ?>">
											<?php echo $problem->problem_name; ?>
										</a>
									</td>
								</tr>
								<?php } ?>
							</tbody>
						</table>
					</div>
				</div><!-- tab-content ends -->
			</div><!-- Tabable Ends -->
		</div><!-- col-xs-12, contestant view -->
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
	</div>	<!-- row ends -->
</div> <!-- page content ends -->

