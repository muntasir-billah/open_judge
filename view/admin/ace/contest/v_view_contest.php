<div class="page-content">
	<div class="page-header">
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
						</div>
					</div><!-- col-xs-12 -->
					<div class="col-xs-12">
						<div class="clearfix">
							<div class="pull-left tableTools-container"></div>
							<ul class="pull-right nav nav-pills">
								<li class="active">
									<a data-toggle="modal" role="button" href="#add_problems">
										Add Problem(s)
									</a>
								</li>
								<li class="active">
									<a href="#">Manage Judges</a>
								</li>
								<li class="active">
									<a href="#">Manage Contestants</a>
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
										<td class="oj_description_column"><?php echo $problem->problem_description; ?></td>

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
					</div><!-- col-xs-12 -->
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
				</div>
			</div>