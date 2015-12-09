<div class="page-content">
	<div class="page-header">
		<h1>Problem Volume</h1>
	</div><!-- /.page-header -->
	<div class="row">
		<div class="col-xs-12">
			<div class="clearfix">
				<div class="pull-left tableTools-container"></div>
			</div>
			<div>
				<table class="oj_datatable table table-striped table-bordered table-hover">
					<thead>
						<tr>
							<th>Problem Title</th>
							<th class="oj_tag_column">Tags</th>
							<th class="hidden-480 oj_tl_ml" title="Time Limit">TL</th>
							<th class="hidden-480 oj_tl_ml" title="Memory Limit">ML</th>

							<th class="oj_description_column">
								<i class="ace-icon fa fa-clock-o bigger-110 hidden-480"></i>
								Description
							</th>
							<th>Setter</th>
							<th class="hidden-480">Date Added</th>

							<th class="oj_option_col">Options</th>
						</tr>
					</thead>

					<tbody>
						<?php foreach($problems as $key => $problem) {?>
						<tr id="problem<?php echo $problem->problem_id; ?>">
							<td>
								<a href="<?php echo base_url($this->module.'/problem/view_problem?problem_id='.$problem->problem_id); ?>">
									<?php echo $problem->problem_name; ?>
								</a>
							</td>
							<td class="oj_tag_column">
								<?php foreach ($individual_tags[$key] as $tag) { ?>
								<span class="tag_pill btn btn-info btn-xs">
									<a href="#"><?php echo $tag->category_name; ?></a>
								</span>
								<?php } ?>
							</td>
							<td class="hidden-480 oj_tl_ml"><?php echo $problem->problem_time_limit; ?></td>
							<td class="hidden-480 oj_tl_ml"><?php echo $problem->problem_memory_limit; ?></td>
							<td class="oj_description_column"><?php echo $problem->problem_description; ?></td>

							<td><?php echo $problem->problem_setter; ?></td>
							<td class="hidden-480"><?php echo date('h:i A, M d, Y', strtotime($problem->problem_add_date)); ?></td>

							<td class="oj_option_col">
								<div class="action-buttons">
									<a problemid="<?php echo $problem->problem_id; ?>" class="blue col-xs-2 judge_io_button" data-toggle="modal" role="button" href="#judge_io" title="View Judge I/O">
										<i class="ace-icon fa fa-eye bigger-130"></i>
									</a>

									<a class="green col-xs-2" href="#" title="Edit">
										<i class="ace-icon fa fa-pencil bigger-130"></i>
									</a>

									<a class="red col-xs-2 delete_problem" href="#" problemid="<?php echo $problem->problem_id; ?>" title="Remove from this Contest">
										<i class="ace-icon fa fa-trash-o bigger-130"></i>
									</a>
								</div>
							</td>
						</tr>
						<?php } ?>
					</tbody>
				</table>
			</div>
		</div><!-- col-xs-12 -->
	</div><!-- row -->
</div><!-- page-content -->

<div tabindex="-1" class="modal fade" id="judge_io" style="display: none;" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header no-padding">
				<div class="table-header">
					<button aria-hidden="true" data-dismiss="modal" class="close" type="button">
						<span class="white">×</span>
					</button>
					Judge I/O
				</div>
			</div>

			<div class="modal-body no-padding">
				<div class="col-sm-6" id="judge_input">

				</div>
				<div class="col-sm-6" id="judge_output">

				</div>
			</div>

				<!--
				<div class="modal-footer no-margin-top">
					<button class="btn btn-sm btn-info pull-right">
						<i class="ace-icon fa fa-plus"></i>
						Add
					</button>
				</div> <!-- -->
			</div><!-- /.modal-content -->
		</div><!-- /.modal-dialog -->
</div><!-- Modal End -->