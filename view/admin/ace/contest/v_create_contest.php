<div class="page-content">
	<div class="page-header">
		<h1>Create a New Contest</h1>
	</div><!-- /.page-header -->

	<div class="row">
		<div class="col-xs-12">
			<!-- PAGE CONTENT BEGINS -->
			<form class="form-horizontal" role="form" action="<?php echo base_url($this->module.'/contest/store_contest'); ?>" method="post">
				<div class="form-group">
					<label class="col-sm-3 control-label no-padding-right" for="contest_name"> Contest Name </label>

					<div class="col-sm-9">
						<input type="text" name="contest_name" placeholder="Name" class="col-xs-10 col-sm-5" />
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label no-padding-right" for="contest_type"> Contest Type </label>

					<div class="col-sm-9">
						<select id="contest_type" name="contest_type" class="col-xs-10 col-sm-5">
							<option value="0">Selective</option>
							<option value="1">Private</option>
							<option value="2">Public</option>
						</select>
					</div>
				</div>
				<div class="form-group" id="contest_pass" style="display:none;">
					<label class="col-sm-3 control-label no-padding-right" for="contest_pass"> Contest Password for Private Contest </label>

					<div class="col-sm-9">
						<input type="password" id="contest_pass_input" name="contest_pass" placeholder="Contest Password" class="col-xs-10 col-sm-5" />
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label no-padding-right" for="contest_start"> Contest Starts At </label>

					<div class="col-sm-3">
						<input type="text" name="contest_start" placeholder="Name" class="col-xs-10 col-sm-5 date-timepicker1 form-control" />
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label no-padding-right" for="contest_end"> Contest Ends At </label>

					<div class="col-sm-3">
						<input type="text" name="contest_end" placeholder="Name" class="col-xs-10 col-sm-5 date-timepicker1 form-control" />
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