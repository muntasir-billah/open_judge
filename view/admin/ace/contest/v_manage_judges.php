<div class="page-content">
	<div class="page-header">
		<h1>Judges for <?php echo $contest->contest_name; ?></h1>
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
		<div class="col-xs-12">
			<div class="clearfix">
				<div class="pull-left tableTools-container"></div>
				<ul class="pull-right nav nav-pills">
					<li class="active">
						<a data-toggle="modal" role="button" href="#add_judges">
							Add Judge(s)
						</a>
					</li>
					<li class="active">
						<a href="<?php echo base_url().$this->module.'/contest/view_contest?contest_id='.$contest->contest_id; ?>">Manage Problems</a>
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
							<th>Judge Name</th>
							<th>Judge Username</th>
							<th>Judge Phone</th>
							<th>Judge Email</th>
							<th class="oj_option_col">Options</th>
						</tr>
					</thead>

					<tbody>
						<?php foreach($judges as $key => $judge) {?>
						<tr id="judge<?php echo $judge->judge_id; ?>">
							<td>
								<a target="_blank" href="<?php echo base_url($this->module.'/user_management/view_judge?judge_id='.$judge->judge_id); ?>">
									<?php echo $judge->judge_name; ?>
								</a>
							</td>
							<td><?php echo $judge->judge_user; ?></td>
							<td><?php echo $judge->judge_phone; ?></td>
							<td><?php echo $judge->judge_email; ?></td>

							<td class="oj_option_col">
								<div class="action-buttons">
									<a class="red col-xs-2 remove_judge" href="#" judgeid="<?php echo $judge->judge_id; ?>" contestid="<?php echo $contest->contest_id; ?>" title="Remove from this Contest">
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
		
		<div tabindex="-1" class="modal fade" id="add_judges" style="display: none;" aria-hidden="true">
			<form action="<?php echo base_url($module.'/contest/add_judges') ?>" method="post">
				<input type="hidden" name="contest_id" value="<?php echo $contest->contest_id; ?>" />
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header no-padding">
							<div class="table-header">
								<button aria-hidden="true" data-dismiss="modal" class="close" type="button">
									<span class="white">×</span>
								</button>
								Judges
							</div>
						</div>

						<div class="modal-body no-padding">
							<table class="oj_datatable table table-striped table-bordered table-hover">
								<thead>
									<tr>
										<th class="center"></th>
										<th>Judge Name</th>
										<th>Judge Username</th>
										<th>Judge Phone</th>
										<th>Judge Email</th>
									</tr>
								</thead>

								<tbody>
									<?php foreach($all_judges as $key => $judge) {?>
									<tr>
										<td class="center">
											<label class="pos-rel">
												<input name="judge_id[]" value="<?php echo $judge->judge_id; ?>" type="checkbox" class="ace" />
												<span class="lbl"></span>
											</label>
										</td>
										<td>
											<a target="_blank" href="<?php echo base_url($this->module.'/user_management/view_judge?judge_id='.$judge->judge_id); ?>">
												<?php echo $judge->judge_name; ?>
											</a>
										</td>
										<td><?php echo $judge->judge_user; ?></td>
										<td><?php echo $judge->judge_phone; ?></td>
										<td><?php echo $judge->judge_email; ?></td>
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

