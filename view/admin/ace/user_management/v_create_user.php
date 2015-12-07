<div class="page-content">
	<div class="page-header">
		<h1>Create a New Contestant</h1>
	</div><!-- /.page-header -->

	<div class="row">
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
</div><!-- /.page-content -->