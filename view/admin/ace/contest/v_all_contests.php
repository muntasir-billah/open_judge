<div class="page-content">
	<div class="page-header">
		<h1>All Contests</h1>
	</div><!-- /.page-header -->
	<?php
		$type = array('Selective', 'Private', 'Public');
		$status = array(-1 => 'Waiting to Start', 0 => 'Running', 1 => 'Running', 2 => 'Ended');
	?>

	<div class="row">
		<div class="col-xs-12">

			<div class="clearfix">
				<div class="pull-left tableTools-container"></div>
			</div>
			<table class="oj_datatable table table-striped table-bordered table-hover">
				<thead>
					<tr>
						<th>Contest Name</th>
						<th>Type</th>
						<th>Start</th>
						<th>End</th>
						<th>Status</th>
						<th>Options</th>
					</tr>
				</thead>

				<tbody>
					<?php foreach ($contests as $key => $contest) { ?>
					<tr id="contest<?php echo $contest->contest_id; ?>">

						<td>
							<a href="<?php echo base_url($module.'/contest/view_contest?contest_id='.$contest->contest_id); ?>">
								<?php echo $contest->contest_name; ?>
							</a>
						</td>
						<td><?php echo $type[$contest->contest_type]; ?></td>
						<td><?php echo date('h:i A, M d, Y', strtotime($contest->contest_start)); ?></td>
						<td><?php echo date('h:i A, M d, Y', strtotime($contest->contest_end)); ?></td>
						<td><?php echo $status[$contest->contest_status]; ?></td>
						<td>
							<div class="action-buttons">

								<a class="green col-xs-2" href="#">
									<i class="ace-icon fa fa-pencil bigger-130"></i>
								</a>

								<a class="red col-xs-2 delete_contest" href="#" contestid="<?php echo $contest->contest_id; ?>" title="Delete this Contest">
									<i class="ace-icon fa fa-trash-o bigger-130"></i>
								</a>
							</div>
						</td>
					</tr>
					<?php } ?>
				</tbody>
			</table>
		</div>

	</div>
</div>