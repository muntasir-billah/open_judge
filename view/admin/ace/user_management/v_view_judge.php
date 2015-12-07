<div class="page-content">
	<div class="page-header">
		<div class="page_actions pull-right">
			<button class="btn btn-sm btn-info active" id="view_row">View</button>
			<button class="btn btn-sm btn-warning" id="edit_row">Edit</button>
		</div>
		<h1>Judge: <?php echo $judge->judge_name; ?></h1>
	</div><!-- /.page-header -->
	<?php
		$type = array('Regular Contestant', 'Bulk Contestant');
	?>

	<div class="row view_row">
		<div class="col-xs-12">
			<table class="table table-striped table-bordered table-hover">
				<tr>
					<th>Name</th>
					<td><?php echo $judge->judge_name; ?></td>
				</tr>
				<tr>
					<th>Handle</th>
					<td><?php echo $judge->judge_user; ?></td>
				</tr>
				<tr>
					<th>Email</th>
					<td><?php echo $judge->judge_email; ?></td>
				</tr>
				<tr>
					<th>Phone</th>
					<td><?php echo $judge->judge_phone; ?></td>
				</tr>
			</table>
		</div>
	</div>
	<div class="row edit_row" style="display:none;">
		<div class="col-xs-12">
			<!-- PAGE CONTENT BEGINS -->
			<form class="form-horizontal password_field_form" role="form" action="<?php echo base_url($this->module.'/user_management/update_judge'); ?>" method="post">
				<div class="form-group">
					<label class="col-sm-3 control-label no-padding-right" for="judge_name"> Judge Name </label>

					<div class="col-sm-9">
						<input type="text" value="<?php echo $judge->judge_name; ?>" name="judge_name" required placeholder="Name" class="col-xs-10 col-sm-5" />
						<input type="hidden" value="<?php echo $judge->judge_id; ?>" name="judge_id"/>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label no-padding-right" for="judge_user"> Judge Username </label>

					<div class="col-sm-9">
						<input type="text" value="<?php echo $judge->judge_user; ?>" name="judge_user" required placeholder="Handle" class="col-xs-10 col-sm-5" />
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label no-padding-right" for="judge_pass1"> Change Password </label>

					<div class="col-sm-9">
						<input type="password" name="judge_pass1" placeholder="Password" class="col-xs-10 col-sm-5 pass1" />
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label no-padding-right" for="judge_pass2"> Confirm Password </label>

					<div class="col-sm-9">
						<input type="password" name="judge_pass2" placeholder="Confirm Password" class="col-xs-10 col-sm-5 pass2" />
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label no-padding-right" for="judge_phone"> Judge Phone </label>

					<div class="col-sm-9">
						<input type="text" value="<?php echo $judge->judge_phone; ?>" name="judge_phone" required placeholder="Phone" class="col-xs-10 col-sm-5" />
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label no-padding-right" for="judge_email"> Judge Email </label>

					<div class="col-sm-9">
						<input type="email" value="<?php echo $judge->judge_email; ?>" name="judge_email" placeholder="Email" class="col-xs-10 col-sm-5" />
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
