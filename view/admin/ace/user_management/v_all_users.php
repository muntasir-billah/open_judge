<div class="page-content">
	<div class="page-header">
		<div class="page_actions pull-right">
			<button class="btn btn-sm btn-info active" id="view_row">Contestants List</button>
			<button class="btn btn-sm btn-success" id="edit_row">Add New Contestant</button>
		</div>
		<h1>All Contestants</h1>
	</div><!-- /.page-header -->
	<?php
		$type = array('Regular', 'Bulk Contestant');
	?>

	<div class="row view_row">
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
								<?php
									$delete = site_url().$module.'/user_management/delete_contestant/'.$user->user_id;
								?>
								<a class="red col-xs-2 delete_button" href="<?php echo $delete; ?>" userid="<?php echo $user->user_id; ?>" title="Delete this Contestant">
									<i class="ace-icon fa fa-trash-o bigger-130"></i>
								</a>
							</div>
						</td>
					</tr>
					<?php } ?>
				</tbody>
			</table>
		</div>
	</div><!-- row -->
	<div class="row edit_row" style="display:none;">
		<div class="col-xs-12">
			<!-- PAGE CONTENT BEGINS -->
			<form class="form-horizontal password_field_form" role="form" action="<?php echo base_url($this->module.'/user_management/store_contestant'); ?>" method="post">
				<div class="form-group">
					<label class="col-sm-3 control-label no-padding-right" for="user_name"> Contestant Name </label>

					<div class="col-sm-9">
						<input type="text" name="user_name" required placeholder="Name" class="col-xs-10 col-sm-5" />
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label no-padding-right" for="user_handle"> Contestant Handle </label>

					<div class="col-sm-9">
						<input type="text" name="user_handle" required placeholder="Handle" class="col-xs-10 col-sm-5" />
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label no-padding-right" for="user_pass1"> Contestant Password </label>

					<div class="col-sm-9">
						<input type="password" name="user_pass1" required placeholder="Password" class="col-xs-10 col-sm-5 pass1" />
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label no-padding-right" for="user_pass2"> Confirm Password </label>

					<div class="col-sm-9">
						<input type="password" name="user_pass2" required placeholder="Confirm Password" class="col-xs-10 col-sm-5 pass2" />
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label no-padding-right" for="user_phone"> Contestant Phone </label>

					<div class="col-sm-9">
						<input type="text" name="user_phone" required placeholder="Phone" class="col-xs-10 col-sm-5" />
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label no-padding-right" for="user_email"> Contestant Email </label>

					<div class="col-sm-9">
						<input type="email" name="user_email" placeholder="Email" class="col-xs-10 col-sm-5" />
					</div>
				</div>

				<div class="clearfix form-actions">
					<div class="col-md-offset-3 col-md-9">
						<button class="btn btn-info" type="submit">
							<i class="ace-icon fa fa-check bigger-110"></i>
							Submit
						</button>
					</div>
				</div>
			</form>
		</div><!-- /.col -->
	</div><!-- /.row -->
</div>
