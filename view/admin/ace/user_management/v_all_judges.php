<div class="page-content">
	<div class="page-header">
		<div class="page_actions pull-right">
			<button class="btn btn-sm btn-info active" id="view_row">Judges List</button>
			<button class="btn btn-sm btn-success" id="edit_row">Add New Judge</button>
		</div>
		<h1>All Judges</h1>
	</div><!-- /.page-header -->

	<div class="row view_row">
		<div class="col-xs-12">
			<div class="clearfix">
				<div class="pull-left tableTools-container"></div>
			</div>
			<table class="oj_datatable table table-striped table-bordered table-hover">
				<thead>
					<tr>
						<th>Name</th>
						<th>Username</th>
						<th>Phone</th>
						<th>Email</th>
						<th>Options</th>
					</tr>
				</thead>

				<tbody>
					<?php foreach ($judges as $key => $judge) { ?>
					<tr id="judge<?php echo $judge->judge_id; ?>">

						<td>
							<a href="<?php echo base_url($module.'/user_management/view_judge?judge_id='.$judge->judge_id); ?>">
								<?php echo $judge->judge_name; ?>
							</a>
						</td>
						<td><?php echo $judge->judge_user; ?></td>
						<td><?php echo $judge->judge_phone; ?></td>
						<td><?php echo $judge->judge_email; ?></td>
						<td>
							<div class="action-buttons">
								<?php
									$delete = base_url().$module.'/user_management/delete_judge/'.$judge->judge_id;
								?>
								<a class="red col-xs-2 delete_button" href="<?php echo $delete; ?>" judgeid="<?php echo $judge->judge_id; ?>" title="Delete this judge">
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
</div>
