
	<?php
		$type = array('Selective', 'Private', 'Public');
		$status = array(-1 => 'Waiting to Start', 0 => 'Running', 1 => 'Running', 2 => 'Ended');
	?>

<div class="page-content">
	<div class="page-header">
		<h1>
			Dashboard
		</h1>
	</div><!-- /.page-header -->

	<div class="row">
		<div class="col-md-6">
			<h3>Running Contests</h3>
			<table class="oj_datatable table table-striped table-bordered table-hover">
				<thead>
					<tr>
						<th>Contest Name</th>
						<th>Type</th>
						<th>Start</th>
						<th>End</th>
					</tr>
				</thead>

				<tbody>
					<?php foreach ($running_contests as $key => $contest) { ?>
					<tr id="contest<?php echo $contest->contest_id; ?>">

						<td>
							<a href="<?php echo base_url($module.'/contest/view_contest?contest_id='.$contest->contest_id); ?>">
								<?php echo $contest->contest_name; ?>
							</a>
						</td>
						<td><?php echo $type[$contest->contest_type]; ?></td>
						<td><?php echo date('h:i A, M d, Y', strtotime($contest->contest_start)); ?></td>
						<td><?php echo date('h:i A, M d, Y', strtotime($contest->contest_end)); ?></td>
					</tr>
					<?php } ?>
				</tbody>
			</table>

		</div><!-- /.col -->
		<div class="col-md-6">
			<h3>Upcoming Contests</h3>
			<table class="oj_datatable table table-striped table-bordered table-hover">
				<thead>
					<tr>
						<th>Contest Name</th>
						<th>Type</th>
						<th>Start</th>
						<th>End</th>
					</tr>
				</thead>

				<tbody>
					<?php foreach ($upcoming_contests as $key => $contest) { ?>
					<tr id="contest<?php echo $contest->contest_id; ?>">

						<td>
							<a href="<?php echo base_url($module.'/contest/view_contest?contest_id='.$contest->contest_id); ?>">
								<?php echo $contest->contest_name; ?>
							</a>
						</td>
						<td><?php echo $type[$contest->contest_type]; ?></td>
						<td><?php echo date('h:i A, M d, Y', strtotime($contest->contest_start)); ?></td>
						<td><?php echo date('h:i A, M d, Y', strtotime($contest->contest_end)); ?></td>
					</tr>
					<?php } ?>
				</tbody>
			</table>

		</div><!-- /.col -->
	</div><!-- /.row -->
</div><!-- /.page-content -->