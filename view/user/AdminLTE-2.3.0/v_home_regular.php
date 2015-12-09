<div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Dashboard
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
                  <h3 class="box-title">Running Contests</h3>
                  <div class="box-tools pull-right">
                    <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                  </div>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <div class="row">
                    <div class="col-md-6">
                      <h3>Running Contests</h3>
                      <table class="oj_datatable table table-striped table-bordered table-hover">
                        <thead>
                          <tr>
                            <th>Contest Name</th>
                            <th>Type</th>
                            <th>Start</th>
                            <th>End</th>
                          </tr>
                        </thead>

                        <tbody>
                          <?php foreach ($running_contests as $key => $contest) { ?>
                          <tr id="contest<?php echo $contest->contest_id; ?>">

                            <td>
                              <a href="<?php echo base_url($module.'/contest/view_contest?contest_id='.$contest->contest_id); ?>">
                                <?php echo $contest->contest_name; ?>
                              </a>
                            </td>
                            <td><?php echo $c_type[$contest->contest_type]; ?></td>
                            <td><?php echo date('h:i A, M d, Y', strtotime($contest->contest_start)); ?></td>
                            <td><?php echo date('h:i A, M d, Y', strtotime($contest->contest_end)); ?></td>
                          </tr>
                          <?php } ?>
                        </tbody>
                      </table>

                    </div><!-- /.col -->
                    <div class="col-md-6">
                      <h3>Upcoming Contests</h3>
                      <table class="oj_datatable table table-striped table-bordered table-hover">
                        <thead>
                          <tr>
                            <th>Contest Name</th>
                            <th>Type</th>
                            <th>Start</th>
                            <th>End</th>
                          </tr>
                        </thead>

                        <tbody>
                          <?php foreach ($upcoming_contests as $key => $contest) { ?>
                          <tr id="contest<?php echo $contest->contest_id; ?>">

                            <td>
                              <a href="<?php echo base_url($module.'/contest/view_contest?contest_id='.$contest->contest_id); ?>">
                                <?php echo $contest->contest_name; ?>
                              </a>
                            </td>
                            <td><?php echo $c_type[$contest->contest_type]; ?></td>
                            <td><?php echo date('h:i A, M d, Y', strtotime($contest->contest_start)); ?></td>
                            <td><?php echo date('h:i A, M d, Y', strtotime($contest->contest_end)); ?></td>
                          </tr>
                          <?php } ?>
                        </tbody>
                      </table>

                    </div><!-- /.col -->
                  </div><!-- /.row -->
                </div><!-- ./box-body -->
              </div><!-- /.box -->
            </div><!-- /.col -->
          </div><!-- /.row -->
          <?php if(count($past_contests)) { ?>
          <div class="row">
            <div class="col-md-12">
              <div class="box">
                <div class="box-header with-border">
                  <h3 class="box-title">Running Contests</h3>
                  <div class="box-tools pull-right">
                    <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                  </div>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <div class="row">
                    <div class="col-md-12">
                      <h3>Past Contests</h3>
                      <table class="oj_datatable table table-striped table-bordered table-hover">
                        <thead>
                          <tr>
                            <th>Contest Name</th>
                            <th>Type</th>
                            <th>Start</th>
                            <th>End</th>
                          </tr>
                        </thead>

                        <tbody>
                          <?php foreach ($past_contests as $key => $contest) { ?>
                          <tr id="contest<?php echo $contest->contest_id; ?>">

                            <td>
                              <a href="<?php echo base_url($module.'/contest/view_contest?contest_id='.$contest->contest_id); ?>">
                                <?php echo $contest->contest_name; ?>
                              </a>
                            </td>
                            <td><?php echo $c_type[$contest->contest_type]; ?></td>
                            <td><?php echo date('h:i A, M d, Y', strtotime($contest->contest_start)); ?></td>
                            <td><?php echo date('h:i A, M d, Y', strtotime($contest->contest_end)); ?></td>
                          </tr>
                          <?php } ?>
                        </tbody>
                      </table>
                    </div><!-- /.col -->
                  </div><!-- /.row -->
                </div><!-- ./box-body -->
              </div><!-- /.box -->
            </div><!-- /.col -->
          </div><!-- /.row -->
          <?php } ?>
        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->