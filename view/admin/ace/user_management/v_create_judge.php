<div class="page-content">
	<div class="page-header">
		<h1>Create a New Judge</h1>
	</div><!-- /.page-header -->

	<div class="row">
		<div class="col-xs-12">
			<!-- PAGE CONTENT BEGINS -->
			<form class="form-horizontal password_field_form" role="form" action="<?php echo base_url($this->module.'/user_management/store_judge'); ?>" method="post">
				<div class="form-group">
					<label class="col-sm-3 control-label no-padding-right" for="judge_name"> Judge Name </label>

					<div class="col-sm-9">
						<input type="text" name="judge_name" required placeholder="Name" class="col-xs-10 col-sm-5" />
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label no-padding-right" for="judge_user"> Judge Username </label>

					<div class="col-sm-9">
						<input type="text" name="judge_user" required placeholder="Handle" class="col-xs-10 col-sm-5" />
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label no-padding-right" for="judge_pass1"> Judge Password </label>

					<div class="col-sm-9">
						<input type="password" name="judge_pass1" required placeholder="Password" class="col-xs-10 col-sm-5 pass1" />
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label no-padding-right" for="judge_pass2"> Confirm Password </label>

					<div class="col-sm-9">
						<input type="password" name="judge_pass2" required placeholder="Confirm Password" class="col-xs-10 col-sm-5 pass2" />
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label no-padding-right" for="judge_phone"> Judge Phone </label>

					<div class="col-sm-9">
						<input type="text" name="judge_phone" required placeholder="Phone" class="col-xs-10 col-sm-5" />
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label no-padding-right" for="judge_email"> Judge Email </label>

					<div class="col-sm-9">
						<input type="email" name="judge_email" placeholder="Email" class="col-xs-10 col-sm-5" />
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