<div class="submit_form" style="display:none;">
    <button class="submit_form_close btn btn-md btn-danger"><i class="fa fa-times"></i></button>
    <form role="form" method="post" action="<?php echo base_url($module.'/contest/submit'); ?>">
      <!-- select -->
      <div class="form-group">
        <label>Problem</label>
        <select name="problem_id" class="form-control">
        <?php
          $serial = 64;
        ?>
        <?php foreach($problems as $key => $problem) {?>
          <option value="<?php echo $problem->problem_id; ?>" id="option<?php printf("%c", ++$serial); ?>">
          <?php printf("%c", $serial); ?>
          </option>
        <?php } ?>
        </select>
      </div>
      <!-- textarea -->
      <div class="form-group">
        <label>Submit Solution</label>
        <input type="hidden" name="contest_id" value="<?php echo $contest->contest_id; ?>" />
        <code>
        <textarea name="submission_source" placeholder="Paste Solution Here ..." class="form-control"></textarea>
        </code>
      </div>

      <!-- radio -->
      <div class="form-group">
        <label>Language</label>
        <div class="radio">
          <label>
            <input type="radio" checked="" value="1" name="language_id">
            GNU C11
          </label>
        </div>
        <div class="radio">
          <label>
            <input type="radio" value="2" name="language_id">
            GNU C++14
          </label>
        </div>
      </div><!-- form-group ends -->

      <!-- textarea -->
      <div class="form-group">
        <button class="btn btn-md btn-primary pull-right" type="submit">Submit</button>
        <div class="clearfix"></div>
      </div>
    </form>
  </div><!-- submit_form ends -->

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1><?php echo $contest->contest_name; ?></h1>
      <!--
      <ol class="breadcrumb">
        <li><a href="<?php echo $fullpath; ?>#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Dashboard</li>
      </ol>
      -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-md-12">
          <div class="box">
            <div class="box-header with-border">
              <h3 class="box-title"><?php echo $this->session->user_name; ?></h3>
              <div class="box-tools pull-right">
                <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
            </div><!-- /.box-header -->
            <div class="box-body">
              <div class="row">
              	<div class="col-xs-12">
	              <!-- Custom Tabs -->
	              <div class="nav-tabs-custom">
	                <ul class="nav nav-tabs">
	                  <li class="active"><a data-toggle="tab" href="#overview">Overview</a></li>
	                  <li><a data-toggle="tab" href="#problems">Problems</a></li>
	                  <li class="dropdown"><!-- submission -->
	                    <a href="#" data-toggle="dropdown" class="dropdown-toggle">
	                      Submissions <span class="caret"></span>
	                    </a>
	                    <ul class="dropdown-menu">
	                      <li><a data-toggle="tab" href="#submission_my">My</a></li>
	                      <li><a data-toggle="tab" href="#submission_all">All</a></li>
	                    </ul>
	                  </li><!-- submission ends -->
	                  <li class="dropdown"><!-- Clarifications -->
	                    <a href="#" data-toggle="dropdown" class="dropdown-toggle">
	                      Clarifications <span class="caret"></span>
	                    </a>
	                    <ul class="dropdown-menu">
	                      <li><a data-toggle="tab" href="#clar_my">My</a></li>
	                      <li><a data-toggle="tab" href="#clar_all">All</a></li>
	                    </ul>
	                  </li><!-- Clarifications ends -->
	                  <li><a data-toggle="tab" href="#ranklist">Ranklist</a></li>
	                </ul><!-- tabbed box end-->
	                <div class="tab-content">
	                  <div id="overview" class="tab-pane active">
	                    <table class="table table-striped table-bordered table-hover">
	                    	<thead>
	                    		<tr>
	                    			<th>Solved / Tried</th>
	                    			<th> # </th>
	                    			<th>Title</th>
	                    		</tr>
	                    	</thead>

	                    	<tbody>
	                    		<?php $serial = 64; ?>
	                    		<?php foreach($problems as $key => $problem) {?>
	                    		<tr>
	                    			<td>10/87</td>
	                    			<td><?php printf("Problem %c", ++$serial); ?></td>
	                    			<td>
	                    				<a href="<?php echo base_url($this->module.'/problem/view_problem?problem_id='.$problem->problem_id); ?>">
	                    					<?php echo $problem->problem_name; ?>
	                    				</a>
	                    			</td>
	                    		</tr>
	                    		<?php } ?>
	                    	</tbody>
	                    </table>
	                  </div><!-- /.tab-pane -->
	                  <div id="problems" class="tab-pane">
	                  		<?php
	                  			if($contest->contest_status != -1) {
	                  		?>
		                  <div class="col-xs-12">
                            <!-- Custom Tabs -->
                            <div class="nav-tabs-custom">
                              <ul class="nav nav-tabs">
                              	<?php
                              		$serial = 64;
                              		$first = true;
                              	?>
                              	<?php foreach($problems as $key => $problem) {?>
                              	<li class="<?php if($first) echo 'active'; ?>">
                              		<a href="#<?php echo ++$serial; ?>" data-toggle="tab" aria-expanded="<?php if($first) echo 'true'; else echo 'false'; ?>">
                              			<?php printf("%c", $serial); ?>
                              		</a>
                              	</li>
                              	<?php $first = false; ?>
                              	<?php } ?>
                              </ul>
                              <div class="tab-content">
                              	<?php
                              		$serial = 64;
                              		$first = true;
                              		foreach($problems as $key => $problem) {
                              	?>
                              	<div class="tab-pane <?php if($first) echo 'active'; ?>" id="<?php echo ++$serial; ?>">
                              		<div class="row">
                              			<div class="col-xs-12">
                              				<button for="<?php printf("%c", $serial); ?>" class="submit_button btn btn-lg btn-primary">
                              					Submit Solution for Problem <?php printf("%c", $serial); ?>
                              				</button>
                              				<h1><?php printf("%c", $serial); ?> - <?php echo $problem->problem_name; ?></h1>
                              				<hr>
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
                              				<hr />
                              				<h2>Problem Description</h2>
                              				<?php echo $problem->problem_description; ?>
                              				<!-- Problem Image -->
                              				<?php if($problem->problem_image != '') { ?>
                              				<div class="oj_problem_image">
                              					<img src="<?php echo base_url($this->problem_image_path.$problem->problem_image); ?>" alt="<?php echo $problem->problem_name; ?>" />
                              				</div>
                              				<?php } ?> <!-- Problem Image Ends -->
                              				<hr />
                              				<h2>Input</h2>
                              				<?php echo $problem->problem_input; ?>
                              				<hr />
                              				<h2>Output</h2>
                              				<?php echo $problem->problem_output; ?>
                              				<hr />
                              				<div class="col-sm-6">
                              					<h2>Sample Input</h2>
                              					<pre><?php echo $problem->problem_sample_input; ?></pre>
                              				</div>
                              				<div class="col-sm-6">
                              					<h2>Sample Output</h2>
                              					<pre><?php echo $problem->problem_sample_output; ?></pre>
                              				</div>
                              				<div class="clearfix"></div><hr />
                              				<?php if($problem->problem_hint != '') { ?>
                              				<h2>Hint</h2>
                              				<?php
                              						echo $problem->problem_hint;
                              					}
                              				?>
                              				<hr />
                              			</div> <!-- problem view ends -->
                              		</div><!-- row -->
                              	</div><!-- tab-pane ends -->
                              	<?php $first = false; ?>
                              	<?php } ?>
                              </div><!-- /.tab-content -->
                            </div><!-- nav-tabs-custom -->
                          </div>
                          <?php
                          	}
                          	else {
                          ?>
                          	<h1>Contest yet to start</h1>
                          <?php
                          	}
                          ?>
	                  </div><!-- /.tab-pane -->
	                  <div id="submission_my" class="tab-pane">
	                    <b>Submissions My</b>
	                  </div><!-- /.tab-pane -->
	                  <div id="submission_all" class="tab-pane">
	                    <b>Submissions All</b>
	                  </div><!-- /.tab-pane -->
	                  <div id="clar_my" class="tab-pane">
	                    <b>Clar My</b>
	                  </div><!-- /.tab-pane -->
	                  <div id="clar_all" class="tab-pane">
	                    <b>Clar All</b>
	                  </div><!-- /.tab-pane -->
	                  <div id="ranklist" class="tab-pane">
	                    <b>Ranklist</b>
	                  </div><!-- /.tab-pane -->
	                  <div class="clearfix"></div>
	                </div><!-- /.tab-content -->
	              </div><!-- nav-tabs-custom -->
	            </div>
              </div><!-- /.row -->
            </div><!-- ./box-body -->
          </div><!-- /.box -->
        </div><!-- /.col -->
      </div><!-- /.row -->
    </section><!-- /.content -->
  </div><!-- /.content-wrapper -->

