<aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
          <!-- sidebar menu: : style can be found in sidebar.less -->
          <ul class="sidebar-menu">
            <li class="active">
              <a href="<?php echo base_url().$module; ?>">
                <i class="fa fa-dashboard"></i> <span>Dashboard</span>
              </a>
            </li><!-- Nav Item ends -->
            <li class="treeview">
              <a href="#">
                <i class="fa fa-list"></i>
                <span>Contest</span>
              </a>
              <ul class="treeview-menu">
                <li>
                  <a href="<?php echo base_url().$module.'/contest'; ?>">All Contests</a>
                </li>
                <li>
                  <a href="<?php echo base_url().$module.'/contest/my_contests'; ?>">My Contests</a>
                </li>
              </ul>
            </li><!-- Nav Item ends -->
            <li>======================</li>
            <li class="treeview">
              <a href="<?php echo $fullpath; ?>#">
                <i class="fa fa-files-o"></i>
                <span>Layout Options</span>
                <span class="label label-primary pull-right">4</span>
              </a>
              <ul class="treeview-menu">
                <li><a href="<?php echo $fullpath; ?>pages/layout/top-nav.html"><i class="fa fa-circle-o"></i> Top Navigation</a></li>
                <li><a href="<?php echo $fullpath; ?>pages/layout/boxed.html"><i class="fa fa-circle-o"></i> Boxed</a></li>
                <li><a href="<?php echo $fullpath; ?>pages/layout/fixed.html"><i class="fa fa-circle-o"></i> Fixed</a></li>
                <li><a href="<?php echo $fullpath; ?>pages/layout/collapsed-sidebar.html"><i class="fa fa-circle-o"></i> Collapsed Sidebar</a></li>
              </ul>
            </li>
            <li>
              <a href="<?php echo $fullpath; ?>pages/widgets.html">
                <i class="fa fa-th"></i> <span>Widgets</span> <small class="label pull-right bg-green">new</small>
              </a>
            </li>
            <li class="treeview">
              <a href="<?php echo $fullpath; ?>#">
                <i class="fa fa-pie-chart"></i>
                <span>Charts</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="<?php echo $fullpath; ?>pages/charts/chartjs.html"><i class="fa fa-circle-o"></i> ChartJS</a></li>
                <li><a href="<?php echo $fullpath; ?>pages/charts/morris.html"><i class="fa fa-circle-o"></i> Morris</a></li>
                <li><a href="<?php echo $fullpath; ?>pages/charts/flot.html"><i class="fa fa-circle-o"></i> Flot</a></li>
                <li><a href="<?php echo $fullpath; ?>pages/charts/inline.html"><i class="fa fa-circle-o"></i> Inline charts</a></li>
              </ul>
            </li>
            <li class="treeview">
              <a href="<?php echo $fullpath; ?>#">
                <i class="fa fa-laptop"></i>
                <span>UI Elements</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="<?php echo $fullpath; ?>pages/UI/general.html"><i class="fa fa-circle-o"></i> General</a></li>
                <li><a href="<?php echo $fullpath; ?>pages/UI/icons.html"><i class="fa fa-circle-o"></i> Icons</a></li>
                <li><a href="<?php echo $fullpath; ?>pages/UI/buttons.html"><i class="fa fa-circle-o"></i> Buttons</a></li>
                <li><a href="<?php echo $fullpath; ?>pages/UI/sliders.html"><i class="fa fa-circle-o"></i> Sliders</a></li>
                <li><a href="<?php echo $fullpath; ?>pages/UI/timeline.html"><i class="fa fa-circle-o"></i> Timeline</a></li>
                <li><a href="<?php echo $fullpath; ?>pages/UI/modals.html"><i class="fa fa-circle-o"></i> Modals</a></li>
              </ul>
            </li>
            <li class="treeview">
              <a href="<?php echo $fullpath; ?>#">
                <i class="fa fa-edit"></i> <span>Forms</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="<?php echo $fullpath; ?>pages/forms/general.html"><i class="fa fa-circle-o"></i> General Elements</a></li>
                <li><a href="<?php echo $fullpath; ?>pages/forms/advanced.html"><i class="fa fa-circle-o"></i> Advanced Elements</a></li>
                <li><a href="<?php echo $fullpath; ?>pages/forms/editors.html"><i class="fa fa-circle-o"></i> Editors</a></li>
              </ul>
            </li>
            <li class="treeview">
              <a href="<?php echo $fullpath; ?>#">
                <i class="fa fa-table"></i> <span>Tables</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="<?php echo $fullpath; ?>pages/tables/simple.html"><i class="fa fa-circle-o"></i> Simple tables</a></li>
                <li><a href="<?php echo $fullpath; ?>pages/tables/data.html"><i class="fa fa-circle-o"></i> Data tables</a></li>
              </ul>
            </li>
            <li>
              <a href="<?php echo $fullpath; ?>pages/calendar.html">
                <i class="fa fa-calendar"></i> <span>Calendar</span>
                <small class="label pull-right bg-red">3</small>
              </a>
            </li>
            <li>
              <a href="<?php echo $fullpath; ?>pages/mailbox/mailbox.html">
                <i class="fa fa-envelope"></i> <span>Mailbox</span>
                <small class="label pull-right bg-yellow">12</small>
              </a>
            </li>
            <li class="treeview">
              <a href="<?php echo $fullpath; ?>#">
                <i class="fa fa-folder"></i> <span>Examples</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="<?php echo $fullpath; ?>pages/examples/invoice.html"><i class="fa fa-circle-o"></i> Invoice</a></li>
                <li><a href="<?php echo $fullpath; ?>pages/examples/profile.html"><i class="fa fa-circle-o"></i> Profile</a></li>
                <li><a href="<?php echo $fullpath; ?>pages/examples/login.html"><i class="fa fa-circle-o"></i> Login</a></li>
                <li><a href="<?php echo $fullpath; ?>pages/examples/register.html"><i class="fa fa-circle-o"></i> Register</a></li>
                <li><a href="<?php echo $fullpath; ?>pages/examples/lockscreen.html"><i class="fa fa-circle-o"></i> Lockscreen</a></li>
                <li><a href="<?php echo $fullpath; ?>pages/examples/404.html"><i class="fa fa-circle-o"></i> 404 Error</a></li>
                <li><a href="<?php echo $fullpath; ?>pages/examples/500.html"><i class="fa fa-circle-o"></i> 500 Error</a></li>
                <li><a href="<?php echo $fullpath; ?>pages/examples/blank.html"><i class="fa fa-circle-o"></i> Blank Page</a></li>
              </ul>
            </li>
            <li class="treeview">
              <a href="<?php echo $fullpath; ?>#">
                <i class="fa fa-share"></i> <span>Multilevel</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="<?php echo $fullpath; ?>#"><i class="fa fa-circle-o"></i> Level One</a></li>
                <li>
                  <a href="<?php echo $fullpath; ?>#"><i class="fa fa-circle-o"></i> Level One <i class="fa fa-angle-left pull-right"></i></a>
                  <ul class="treeview-menu">
                    <li><a href="<?php echo $fullpath; ?>#"><i class="fa fa-circle-o"></i> Level Two</a></li>
                    <li>
                      <a href="<?php echo $fullpath; ?>#"><i class="fa fa-circle-o"></i> Level Two <i class="fa fa-angle-left pull-right"></i></a>
                      <ul class="treeview-menu">
                        <li><a href="<?php echo $fullpath; ?>#"><i class="fa fa-circle-o"></i> Level Three</a></li>
                        <li><a href="<?php echo $fullpath; ?>#"><i class="fa fa-circle-o"></i> Level Three</a></li>
                      </ul>
                    </li>
                  </ul>
                </li>
                <li><a href="<?php echo $fullpath; ?>#"><i class="fa fa-circle-o"></i> Level One</a></li>
              </ul>
            </li>
            <li><a href="<?php echo $fullpath; ?>documentation/index.html"><i class="fa fa-book"></i> <span>Documentation</span></a></li>
          </ul>
        </section>
        <!-- /.sidebar -->
      </aside>