<div class="page-content">
	<div class="page-header">
		<h1><?php echo $problem->problem_name; ?></h1>
	</div><!-- /.page-header -->

	<div class="row">
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
			</div>
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
		</div>
	</div>
</div>