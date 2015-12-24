<div class="page-content">
	<div class="page-header">
		<div class="page_actions pull-right">
			<button class="btn btn-sm btn-info active" id="view_row">View</button>
			<button class="btn btn-sm btn-warning" id="edit_row">Edit</button>
		</div>
		<h1><?php echo $problem->problem_name; ?></h1>
	</div><!-- /.page-header -->

	<div class="row view_row">
		<div class="col-xs-12">
			<div class="col-sm-6">
				<p class="lead">Problem Setter: <?php echo $problem->problem_setter; ?></p>
			</div>
			<div class="col-sm-6">
				<ul class="nav nav-pills oj_problem_tag">
					<?php foreach ($tags as $tag) { ?>
					<li class="active">
						<a href="#"><?php echo $tag->category_name; ?></a>
					</li>
					<?php } ?>
					<div class="clearfix"></div>
				</ul>
			</div>
		</div>
		<div class="col-xs-12 oj_problem_specification">
			<div class="col-sm-3">
				<i class="ace-icon fa fa-clock-o blue"></i>
				<span class="blue"> <?php echo $problem->problem_time_limit; ?><span>
			</div>
			<div class="col-sm-3">
				<i class="ace-icon fa fa-hdd-o red"></i>
				<span class="red"> <?php echo $problem->problem_memory_limit; ?><span>
			</div>
			<div class="col-sm-3">
				<i class="ace-icon fa fa-angle-double-down green"></i>
				<span class="green"> <?php echo $problem->problem_input_channel; ?><span>
			</div>
			<div class="col-sm-3">
				<i class="ace-icon fa fa-angle-double-up green"></i>
				<span class="green"> <?php echo $problem->problem_output_channel; ?><span>
			</div>
		</div> <!-- problem specification ends -->
		<div class="col-xs-12 oj_problem_view">
			<h2>Problem Description</h2><hr />
			<?php echo $problem->problem_description; ?>
			<!-- Problem Image -->
			<?php if($problem->problem_image != '') { ?>
			<div class="oj_problem_image">
				<img src="<?php echo base_url($this->problem_image_path.$problem->problem_image); ?>" alt="<?php echo $problem->problem_name; ?>" />
			</div>
			<?php } ?> <!-- Problem Image Ends -->
			<h2>Input</h2><hr />
			<?php echo $problem->problem_input; ?>
			<h2>Output</h2><hr />
			<?php echo $problem->problem_output; ?>
			<div class="col-sm-6">
				<h2>Sample Input</h2><hr />
				<pre><?php echo $problem->problem_sample_input; ?></pre>
			</div>
			<div class="col-sm-6">
				<h2>Sample Output</h2><hr />
				<pre><?php echo $problem->problem_sample_output; ?></pre>
			</div>
			<div class="clearfix"></div>
			<?php if($problem->problem_hint != '') { ?>
			<h2>Hint</h2><hr />
			<?php
					echo $problem->problem_hint;
				}
			?>
		</div> <!-- problem view ends -->
	</div><!-- row -->
	<div class="row edit_row">
		<div class="col-xs-12">
			<!-- PAGE CONTENT BEGINS -->
			<?php
				$action = base_url($module.'/problem/update_problem?problem_id='.$problem->problem_name);
			?>
			<form enctype="multipart/form-data" class="form-horizontal" role="form" action="<?php echo $action; ?>" method="post">
				<div class="form-group">
					<label class="col-xs-12 no-padding-right" for="problem_name">
						<h3>Problem Name</h3>
					</label>
					<div class="col-xs-12">
						<input type="hidden" name="problem_id" value="<?php echo $problem->problem_id; ?>" />
						<input value="<?php echo $problem->problem_name; ?>" type="text" placeholder="Problem Name" name="problem_name" class="col-xs-12 col-md-8" />
					</div>
				</div><!-- form group end -->
				<div class="form-group">
					<label class="col-xs-12 no-padding-right" for="problem_time_limit">
						<h3>Judging Information</h3>
					</label>
					<div class="col-xs-12 col-sm-3">
						<input value="<?php echo $problem->problem_time_limit_ms; ?>" type="text" class="form-control" placeholder="Time Limit In MS" name="problem_time_limit" class="col-xs-12 col-md-8" />
					</div>
					<div class="col-xs-12 col-sm-3">
						<input value="<?php echo $problem->problem_memory_limit_kb; ?>" type="text" class="form-control" placeholder="Memory Limit In KB" name="problem_memory_limit" class="col-xs-12 col-md-8" />
					</div>
					<div class="col-xs-12 col-sm-3">
						<input value="<?php echo $problem->problem_input_channel; ?>" type="text" class="form-control" placeholder="Input Channel" name="problem_input_channel" class="col-xs-12 col-md-8" />
					</div>
					<div class="col-xs-12 col-sm-3">
						<input value="<?php echo $problem->problem_output_channel; ?>" type="text" class="form-control" placeholder="Output Channel" name="problem_output_channel" class="col-xs-12 col-md-8" />
					</div>
				</div><!-- form group end -->
				<div class="form-group">
					<label class="col-xs-12 no-padding-right" for="problem_description">
						<h3>Problem Description</h3>
					</label>

					<div class="col-xs-12">
						<textarea name="problem_description" class="col-xs-12 tinymce_textbox"><?php echo $problem->problem_description; ?></textarea>
					</div>
				</div><!-- form group end -->
				<div class="form-group">
					<label class="col-xs-12 no-padding-right" for="problem_input">
						<h3>Input</h3>
					</label>

					<div class="col-xs-12">
						<textarea name="problem_input" class="col-xs-12 tinymce_textbox"><?php echo $problem->problem_input; ?></textarea>
					</div>
				</div><!-- form group end -->
				<div class="form-group">
					<label class="col-xs-12 no-padding-right" for="problem_output">
						<h3>Output</h3>
					</label>

					<div class="col-xs-12">
						<textarea name="problem_output" class="col-xs-12 tinymce_textbox"><?php echo $problem->problem_output; ?></textarea>
					</div>
				</div><!-- form group end -->
				<div class="form-group">
					<div class="col-md-6">
						<label class="col-xs-12 no-padding-right" for="problem_sample_input">
							<h3>Sample Input</h3>
						</label>

						<div class="col-xs-12">
							<textarea name="problem_sample_input" class="col-xs-12 autosize-transition form-control"><?php echo $problem->problem_sample_input; ?></textarea>
						</div>
					</div>
					<div class="col-md-6">
						<label class="col-xs-12 no-padding-right" for="problem_sample_output">
							<h3>Sample Output</h3>
						</label>

						<div class="col-xs-12">
							<textarea name="problem_sample_output" class="col-xs-12 autosize-transition form-control"><?php echo $problem->problem_sample_output; ?></textarea>
						</div>
					</div>
				</div><!-- form group end -->
				<div class="form-group">
					<div class="col-md-6">
						<label class="col-xs-12 no-padding-right" for="problem_judge_input">
							<h3>Judge Input</h3>
						</label>

						<div class="col-xs-12" id="judge_input">
							<textarea <?php if($problem->problem_io_type) echo ' style="display:none;" '; ?> name="problem_judge_text_input" class="col-xs-12 autosize-transition form-control"><?php if(!$problem->problem_io_type) echo $problem->problem_judge_input; ?></textarea>
							<div <?php if(!$problem->problem_io_type) echo ' style="display:none;" '; ?> class="col-xs-12">
								<?php if($problem->problem_io_type) 
									echo '<a href="'.base_url().$this->judge_io_path.$problem->problem_judge_input.'" target="_blank">Judge Input File</a>'; 
								?>
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
							<textarea <?php if($problem->problem_io_type) echo ' style="display:none;" '; ?> name="problem_judge_text_output" class="col-xs-12 autosize-transition form-control"><?php if(!$problem->problem_io_type) echo $problem->problem_judge_output; ?></textarea>
							<div <?php if(!$problem->problem_io_type) echo ' style="display:none;" '; ?> class="col-xs-12">
								<?php if($problem->problem_io_type) 
									echo '<a href="'.base_url().$this->judge_io_path.$problem->problem_judge_output.'" target="_blank">Judge Output File</a>'; 
								?>
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
								<input <?php if($problem->problem_io_type) echo 'checked '; ?> id="file_as_judge_input" name="file_as_judge_input" class="ace ace-switch ace-switch-3" type="checkbox" />
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
						<textarea name="problem_hint" class="col-xs-12 tinymce_textbox"><?php echo $problem->problem_hint; ?></textarea>
					</div>
				</div><!-- form group end -->
				<?php if($problem->problem_image != '') { ?>
				<div class="form-group problem_image_div">
					<label class="col-xs-12 no-padding-right" for="problem_sample_output">
						<h3>Problem Image</h3>
					</label>
					<div class="col-xs-12 col-sm-3">
						<span class="btn btn-sm btn-danger" title="Remove Image"><i class="menu-icon fa fa-times"></i></span>
						<img src="<?php echo base_url($this->problem_image_path.$problem->problem_image); ?>" alt="<?php echo $problem->problem_name; ?>" />
					</div>
				</div><!-- form group end -->
				<?php } ?>
				<div class="form-group">
					<label class="col-xs-12 no-padding-right" for="problem_sample_output">
						<h3>Upload/Change Image</h3>
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
						<input value="<?php echo $problem->problem_setter; ?>" type="text" placeholder="Who set this awesome problem?" name="problem_setter" class="col-xs-12 col-md-8" />
					</div>
				</div><!-- form group end -->
				<div class="form-group">
					<label class="col-xs-12 no-padding-right">
						<h3>Tags</h3>
					</label>
					<div class="col-xs-12">
						<div class="col-xs-5">
							<select multiple="" name="problem_tags[]" class="chosen-select form-control tag-input-style" data-placeholder='"To choose or not to choose..." - Shakespear'>
							<?php foreach($all_tags as $key => $tag) { ?>
								<option <?php if(isset($problem_tags[$tag->category_id])) echo 'selected '; ?> value="<?php echo $tag->category_id; ?>">
									<?php echo $tag->category_name; ?>
								</option>
							<?php } ?>
							</select>
						</div>
					</div>
				</div><!-- form group end -->
				<div class="form-group">
					<label class="col-xs-12 no-padding-right" for="problem_special_judge">
						<h3>Special Judge Option</h3>
					</label>
					<label class="col-xs-12">
						<h5>Is it a <span class="blue">Special Judge</span> Problem?</h5>
						<input type="hidden" name="problem_special_judge" value="0" />
						<input <?php if($problem->problem_special_judge) echo 'checked '; ?> name="problem_special_judge" class="ace ace-switch ace-switch-3" type="checkbox" />
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
</div><!-- page contest ends -->