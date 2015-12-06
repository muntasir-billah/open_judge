<div class="page-content">
	<div class="page-header">
		<div class="page_actions pull-right">
			<button class="btn btn-sm btn-info active" id="contestant_view">View</button>
			<button class="btn btn-sm btn-warning" id="admin_view">Edit</button>
		</div>
		<h1>Contestant: <?php echo $user->user_name; ?></h1>
	</div><!-- /.page-header -->
	<?php
		$type = array('Regular Contestant', 'Bulk Contestant');
	?>

	<div class="row">
		<div class="col-xs-12">
			<table class="table table-striped table-bordered table-hover">
				<tr>
					<th>Name</th>
					<td><?php echo $user->user_name; ?></td>
				</tr>
				<tr>
					<th>Handle</th>
					<td><?php echo $user->user_handle; ?></td>
				</tr>
				<tr>
					<th>User Type</th>
					<td><?php echo $type[$user->user_type]; ?></td>
				</tr>
				<tr>
					<th>Email</th>
					<td><?php echo $user->user_email; ?></td>
				</tr>
				<tr>
					<th>Phone</th>
					<td><?php echo $user->user_phone; ?></td>
				</tr>
			</table>
		</div>
	</div>
</div>
