<div class="page-content">
	<div class="page-header">
		<h1>All Contestants</h1>
	</div><!-- /.page-header -->
	<?php
		$type = array('Regular', 'Bulk Contestant');
	?>

	<div class="row">
		<div class="col-xs-12">
			<div class="clearfix">
				<div class="pull-left tableTools-container"></div>
			</div>
			<table class="oj_datatable table table-striped table-bordered table-hover">
				<thead>
					<tr>
						<th>Name</th>
						<th>Type</th>
						<th>Handle</th>
						<th>Phone</th>
						<th>Email</th>
						<th>Options</th>
					</tr>
				</thead>

				<tbody>
					<?php foreach ($users as $key => $user) { ?>
					<tr id="user<?php echo $user->user_id; ?>">

						<td>
							<a href="<?php echo base_url($module.'/user_management/view_contestant?user_id='.$user->user_id); ?>">
								<?php echo $user->user_name; ?>
							</a>
						</td>
						<td><?php echo $type[$user->user_type]; ?></td>
						<td><?php echo $user->user_handle; ?></td>
						<td><?php echo $user->user_phone; ?></td>
						<td><?php echo $user->user_email; ?></td>
						<td>
							<div class="action-buttons">

								<a class="green col-xs-2" href="#">
									<i class="ace-icon fa fa-pencil bigger-130"></i>
								</a>

								<a class="red col-xs-2 delete_contestant" href="#" userid="<?php echo $user->user_id; ?>" title="Delete this Contestant">
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
