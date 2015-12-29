<div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            All Contests 
          </h1>
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
                  <h3 class="box-title">All Contests</h3>
                  <div class="box-tools pull-right">
                    <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                  </div>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <div class="row">
                  	<div class="col-xs-12">
                  		<table class="oj_datatable table table-striped table-bordered table-hover">
      						<thead>
      							<tr>
      								<th>Contest Name</th>
      								<!-- <th>Type</th> -->
      								<th>Start</th>
      								<th>End</th>
      								<th>Status</th>
      							</tr>
      						</thead>

      						<tbody>
      							<?php foreach ($contests as $key => $contest) { ?>
      							<tr id="contest<?php echo $contest->contest_id; ?>">

      								<td>
      									<a href="<?php echo base_url($module.'/contest/view_contest?contest_id='.$contest->contest_id); ?>">
      										<?php echo $contest->contest_name; ?>
      									</a>
      								</td>
      							<!--	<td><?php echo $c_type[$contest->contest_type]; ?></td> -->
      								<td><?php echo date('h:i A, M d, Y', strtotime($contest->contest_start)); ?></td>
      								<td><?php echo date('h:i A, M d, Y', strtotime($contest->contest_end)); ?></td>
      								<td><?php echo $c_status[$contest->contest_status]; ?></td>
      							</tr>
      							<?php } ?>
      						</tbody>
      					</table>
                  	</div>
                  </div><!-- /.row -->
                </div><!-- ./box-body -->
              </div><!-- /.box -->
            </div><!-- /.col -->
          </div><!-- /.row -->
        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->