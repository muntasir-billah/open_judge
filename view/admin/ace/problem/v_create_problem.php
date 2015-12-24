<div class="page-content">
	<div class="page-header">
		<h1>Add A New Problem</h1>
	</div><!-- /.page-header -->

	<?php
		$action = base_url($module.'/problem/store_problem');
	?>

	<div class="row">
		<div class="col-xs-12">
			<!-- PAGE CONTENT BEGINS -->
			<form enctype="multipart/form-data" class="form-horizontal" role="form" action="<?php echo $action; ?>" method="post">
				<div class="form-group">
					<label class="col-xs-12 no-padding-right" for="problem_name">
						<h3>Problem Name</h3>
					</label>
					<div class="col-xs-12">
						<input type="text" placeholder="Problem Name" name="problem_name" class="col-xs-12 col-md-8" />
					</div>
				</div><!-- form group end -->
				<div class="form-group">
					<label class="col-xs-12 no-padding-right" for="problem_time_limit">
						<h3>Judging Information</h3>
					</label>
					<div class="col-xs-12 col-sm-3">
						<input type="text" class="form-control" placeholder="Time Limit In MS" name="problem_time_limit" class="col-xs-12 col-md-8" />
					</div>
					<div class="col-xs-12 col-sm-3">
						<input type="text" class="form-control" placeholder="Memory Limit In KB" name="problem_memory_limit" class="col-xs-12 col-md-8" />
					</div>
					<div class="col-xs-12 col-sm-3">
						<input type="text" class="form-control" placeholder="Input Channel" name="problem_input_channel" class="col-xs-12 col-md-8" />
					</div>
					<div class="col-xs-12 col-sm-3">
						<input type="text" class="form-control" placeholder="Output Channel" name="problem_output_channel" class="col-xs-12 col-md-8" />
					</div>
				</div><!-- form group end -->
				<div class="form-group">
					<label class="col-xs-12 no-padding-right" for="problem_description">
						<h3>Problem Description</h3>
					</label>

					<div class="col-xs-12">
						<textarea name="problem_description" class="col-xs-12 tinymce_textbox"></textarea>
					</div>
				</div><!-- form group end -->
				<div class="form-group">
					<label class="col-xs-12 no-padding-right" for="problem_input">
						<h3>Input</h3>
					</label>

					<div class="col-xs-12">
						<textarea name="problem_input" class="col-xs-12 tinymce_textbox"></textarea>
					</div>
				</div><!-- form group end -->
				<div class="form-group">
					<label class="col-xs-12 no-padding-right" for="problem_output">
						<h3>Output</h3>
					</label>

					<div class="col-xs-12">
						<textarea name="problem_output" class="col-xs-12 tinymce_textbox"></textarea>
					</div>
				</div><!-- form group end -->
				<div class="form-group">
					<div class="col-md-6">
						<label class="col-xs-12 no-padding-right" for="problem_sample_input">
							<h3>Sample Input</h3>
						</label>

						<div class="col-xs-12">
							<textarea name="problem_sample_input" class="col-xs-12 autosize-transition form-control"></textarea>
						</div>
					</div>
					<div class="col-md-6">
						<label class="col-xs-12 no-padding-right" for="problem_sample_output">
							<h3>Sample Output</h3>
						</label>

						<div class="col-xs-12">
							<textarea name="problem_sample_output" class="col-xs-12 autosize-transition form-control"></textarea>
						</div>
					</div>
				</div><!-- form group end -->
				<div class="form-group">
					<div class="col-md-6">
						<label class="col-xs-12 no-padding-right" for="problem_judge_input">
							<h3>Judge Input</h3>
						</label>

						<div class="col-xs-12" id="judge_input">
							<textarea name="problem_judge_text_input" class="col-xs-12 autosize-transition form-control"></textarea>
							<div style="display:none;" class="col-xs-12">
								<br />
								<input type="file" name="problem_judge_file_input" class="single_file_uploader" />
								<br />
							</div>
						</div>
					</div>
					<div class="col-md-6">
						<label class="col-xs-12 no-padding-right" for="problem_judge_output">
							<h3>Judge Output</h3>
						</label>

						<div class="col-xs-12" id="judge_output">
							<textarea name="problem_judge_text_output" class="col-xs-12 autosize-transition form-control"></textarea>
							<div style="display:none;" class="col-xs-12">
								<br />
								<input type="file" name="problem_judge_file_output" class="single_file_uploader" />
								<br />
							</div>
						</div>
					</div>
					<div class="col-xs-12">
						<label class="col-xs-12 no-padding-right">
						</label>
						<div class="col-xs-12">
							<div class="alert alert-info col-xs-12">
								<strong>You know what?!</strong><br />
								If your judge input/output is too big ( > 1 MB), pasting it into a textarea wouldn't be a very good idea.<br />
								Instead You can Upload Files as Judge Input and Output, 
							</div>
							<label class="col-xs-12">
								<h5>Do you want to upload files as Judge I/O?</h5>
								<input name="file_as_judge_input" type="hidden" value="0" />
								<input id="file_as_judge_input" name="file_as_judge_input" class="ace ace-switch ace-switch-3" type="checkbox" />
								<span class="lbl" data-lbl="YES&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;NO"></span>
							</label>
						</div>
					</div>
				</div><!-- form group end -->
				<div class="form-group">
					<label class="col-xs-12 no-padding-right" for="problem_sample_output">
						<h3>Notes/Hints for Contestants</h3>
					</label>

					<div class="col-xs-12">
						<textarea name="problem_hint" class="col-xs-12 tinymce_textbox"></textarea>
					</div>
				</div><!-- form group end -->
				<div class="form-group">
					<label class="col-xs-12 no-padding-right" for="problem_sample_output">
						<h3>Upload Image</h3>
					</label>
					<div class="col-xs-12 col-sm-3">
						<input name="problem_image" type="file" class="multi_image_uploader" />
					</div>
				</div><!-- form group end -->
				<div class="form-group">
					<label class="col-xs-12 no-padding-right" for="problem_setter">
						<h3>Problem Setter</h3>
					</label>
					<div class="col-xs-12">
						<input type="text" placeholder="Who set this awesome problem?" name="problem_setter" class="col-xs-12 col-md-8" />
					</div>
				</div><!-- form group end -->
				<div class="form-group">
					<label class="col-xs-12 no-padding-right">
						<h3>Tags</h3>
					</label>
					<div class="col-xs-12">
						<div class="col-xs-5">
							<select multiple="" name="problem_tags[]" class="chosen-select form-control tag-input-style" data-placeholder='"To choose or not to choose..." - Shakespear'>
							<?php foreach($tags as $key => $tag) { ?>
								<option value="<?php echo $tag->category_id; ?>"><?php echo $tag->category_name; ?></option>
							<?php } ?>
							</select>
						</div>
					</div><!-- Tags ends here -->
				</div><!-- form group end -->
				<div class="form-group">
					<label class="col-xs-12 no-padding-right" for="problem_special_judge">
						<h3>Special Judge Option</h3>
					</label>
					<label class="col-xs-12">
						<h5>Is it a <span class="blue">Special Judge</span> Problem?</h5>
						<input type="hidden" name="problem_special_judge" value="0" />
						<input name="problem_special_judge" class="ace ace-switch ace-switch-3" type="checkbox" />
						<span class="lbl" data-lbl="YES&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;NO"></span>
					</label>
				</div><!-- form group end -->

				<div class="clearfix form-actions">
					<div class="col-md-offset-3 col-md-9">
						<button class="btn btn-info" type="submit">
							<i class="ace-icon fa fa-check bigger-110"></i>
							Submit
						</button>

						<!--
						<button class="btn" type="reset">
							<i class="ace-icon fa fa-undo bigger-110"></i>
							Reset
						</button>
						-->
					</div>
				</div>
			</form>
		</div><!-- /.col -->
	</div><!-- /.row -->
</div><!-- /.page-content -->