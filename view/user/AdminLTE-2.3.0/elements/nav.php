<?php
  $u_type = array('Regular Contestant', 'Bulk Contestant');
  $c_type = array('Selective', 'Private', 'Public');
  $c_status = array(-1 => 'Waiting to Start', 0 => 'Running', 1 => 'Running', 2 => 'Ended');
?>
<nav class="navbar navbar-static-top" role="navigation">
          <!-- Sidebar toggle button-->
          <a href="<?php echo $fullpath; ?>#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
          </a>
          <!-- Navbar Right Menu -->
          <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
              <!-- Messages: style can be found in dropdown.less--
              <li class="dropdown messages-menu">
                <a href="<?php echo $fullpath; ?>#" class="dropdown-toggle" data-toggle="dropdown">
                  <i class="fa fa-envelope-o"></i>
                  <span class="label label-success">4</span>
                </a>

                <ul class="dropdown-menu">
                  <li>
                    <!-- inner menu: contains the actual data --
                    <ul class="menu">
                      <li><!-- start message --
                        <a href="<?php echo $fullpath; ?>#">
                          <div class="pull-left">
                            <img src="<?php echo $fullpath; ?>dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
                          </div>
                          <h4>
                            Support Team
                            <small><i class="fa fa-clock-o"></i> 5 mins</small>
                          </h4>
                          <p>Why not buy a new awesome theme?</p>
                        </a>
                      </li><!-- end message --
                      
                    </ul>
                  </li>
                  <li class="footer"><a href="<?php echo $fullpath; ?>#">See My Clarifications</a></li>
                </ul>
              </li>
              <!-- User Account: style can be found in dropdown.less -->
              <li class="dropdown user user-menu">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  <i class="fa fa-user img-circle"></i>
                  <span class="hidden-xs"><?php echo $this->session->user_name; ?></span>
                </a>
                <ul class="dropdown-menu">
                  <!-- User image -->
                  <li class="user-header">
                    <i class="fa fa-user oj_white" style="font-size:3em;"></i>
                    <p>
                      <?php echo $this->session->user_name; ?>
                      <small>
                        Handle: <?php echo $this->session->user_handle; ?><br />
                        Type: <?php echo $u_type[$this->session->user_type]; ?><br />
                        <!--
                        Phone: <?php echo $this->session->user_phone; ?><br />
                        Email: <?php echo $this->session->user_email; ?><br /> -->
                      </small>
                    </p>
                  </li>
                  <!-- Menu Footer-->
                  <li class="user-footer">
                   <!--
                    <div class="pull-left">
                      <a href="<?php echo base_url().$module.'/dashboard/user_profile'; ?>" class="btn btn-default btn-flat">Profile</a>
                    </div>
                    -->
                    <div class="pull-right">
                      <a href="<?php echo base_url().$module.'/login/logout'; ?>" class="btn btn-default btn-flat">Sign out</a>
                    </div>
                  </li>
                </ul>
              </li>
              <!-- Control Sidebar Toggle Button --
              <li>
                <a href="<?php echo $fullpath; ?>#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
              </li>
              <!-- -->
            </ul>
          </div>

        </nav>