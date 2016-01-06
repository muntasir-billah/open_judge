<div class="page-content">
	<div class="page-header">
		<h1>Rejudging <strong><?php echo $contest->contest_name; ?></strong></h1>
	</div><!-- /.page-header -->

	<div class="row">
		<div class="col-xs-12">
			<!-- PAGE CONTENT BEGINS -->
			<button class="btn btn-lg btn-success" id="global_rejudge_start_button">
				Start Global Rejudge Process
			</button>
			<div class="col-xs-12" id="rejudging" style="display:none">
				<div id="reset_ranklist" style="display:none">
					<label>Resetting Ranklist <span class="blue">0%</span></label>
					<div class="progress progress-striped progress-small">
						<div style="width: 0%" class="progress-bar progress-bar-success"></div>
					</div><!-- Progress Bar -->
				</div><!-- reset ranklist -->
				<div id="reset_prob_cont_rel" style="display:none">
					<label>Resetting Tried/Solved Counter <span class="blue">0%</span></label>
					<div class="progress progress-striped progress-small">
						<div style="width: 0%" class="progress-bar progress-bar-success"></div>
					</div><!-- Progress Bar -->
				</div><!-- reset_prob_cont_rel -->
				<div id="reset_submissions" style="display:none">
					<label>Resetting Submissions <span class="blue">0%</span></label>
					<div class="progress progress-striped progress-small">
						<div style="width: 0%" class="progress-bar progress-bar-success"></div>
					</div><!-- Progress Bar -->
				</div><!-- reset_submissions -->
				<div id="rejudge" style="display:none">
					<label>Rejudging <span class="blue">0%</span> (<i class="blue">0 of <?php echo $count; ?></i>)</label>
					<div class="progress progress-striped progress-small">
						<div style="width: 0%" class="progress-bar progress-bar-success active"></div>
					</div><!-- Progress Bar -->
				</div><!-- rejudging -->
				<div class="alert alert-success" id="success" style="display:none">
					  <button data-dismiss="alert" class="close" type="button">
					    <i class="ace-icon fa fa-times"></i>
					  </button>

					  <strong>
					    <i class="ace-icon fa fa-check"></i>
					    Rejudge Complete
					  </strong>
					  <br />
					  <?php
					  	$url = base_url('admin/contest/view_contest?contest_id='.$contest->contest_id.'#ranklist');
					  ?>
					  Click <a href="<?php echo $url; ?>">here</a> to view the updated ranklist.
					  <br>
				</div> <!-- success alert box ends -->
			</div>
		</div><!-- /.col -->
	</div><!-- /.row -->
</div><!-- /.page-content -->