<div id="sidebar" class="sidebar responsive sidebar-fixed sidebar-scroll">
	<script type="text/javascript">
		try{ace.settings.check('sidebar' , 'fixed')}catch(e){}
	</script>

	<ul class="nav nav-list">
		<li class="active hover">
			<a href="<?php echo base_url($module); ?>">
				<i class="menu-icon fa fa-tachometer"></i>
				<span class="menu-text"> Dashboard </span>
			</a>

			<b class="arrow"></b>
		</li>
		<li class="hover">
			<a class="dropdown-toggle">
				<i class="menu-icon fa fa-list"></i>
				<span class="menu-text"> Contest </span>

				<b class="arrow fa fa-angle-right"></b>
			</a>

			<b class="arrow"></b>

			<ul class="submenu">
				<li class="hover">
					<a href="<?php echo base_url($module.'/contest'); ?>">
						<i class="menu-icon fa fa-hourglass-2"></i>
						All Contests
					</a>
				</li>
				<li class="hover">
					<a href="<?php echo base_url($module.'/contest/create'); ?>">
						<i class="menu-icon fa fa-plus"></i>
						Schedule a New Contest
					</a>
				</li>
			</ul>
		</li>

		<li class="hover">
			<a class="dropdown-toggle">
				<i class="menu-icon fa fa-book"></i>
				<span class="menu-text"> Problem Volume </span>

				<b class="arrow fa fa-angle-right"></b>
			</a>

			<b class="arrow"></b>

			<ul class="submenu">
				<li class="hover">
					<a href="<?php echo base_url($module.'/problem'); ?>">
						<i class="menu-icon fa fa-pie-chart"></i>
						All Problems
					</a>
				</li>
				<li class="hover">
					<a href="<?php echo base_url($module.'/problem/create'); ?>">
						<i class="menu-icon fa fa-pencil"></i>
						Add a New Problem
					</a>
				</li>
			</ul>
		</li>

		<li class="hover">
			<a class="dropdown-toggle" href="<?php echo base_url($module.'/user_management'); ?>">
				<i class="menu-icon fa fa-user"></i>
				<span class="menu-text"> User Management </span>

				<b class="arrow fa fa-angle-right"></b>
			</a>

			<b class="arrow"></b>

			<ul class="submenu">
				<li class="hover">
					<a class="dropdown-toggle">
						<i class="menu-icon fa fa-user-secret"></i>
						Manage Judges

						<b class="arrow fa fa-angle-right"></b>
					</a>
					<b class="arrow"></b>

					<ul class="submenu">
						<li class="hover">
							<a href="<?php echo base_url($module.'/user_management/judge'); ?>">
								<i class="menu-icon fa fa-user-plus"></i>
								All Judges
							</a>
						</li>
						<li class="hover">
							<a href="<?php echo base_url($module.'/user_management/create_judge'); ?>">
								<i class="menu-icon fa fa-user-plus"></i>
								Add a New Judge
							</a>
						</li>
					</ul>
				</li>
				<li class="hover">
					<a class="dropdown-toggle">
						<i class="menu-icon fa fa-user"></i>
						Manage Contestants
						<b class="arrow fa fa-angle-right"></b>
					</a>
					<b class="arrow"></b>

					<ul class="submenu">
						<li class="hover">
							<a href="<?php echo base_url($module.'/user_management/contestant'); ?>">
								<i class="menu-icon fa fa-user-plus"></i>
								All Contestants
							</a>
						</li>
						<li class="hover">
							<a href="<?php echo base_url($module.'/user_management/create_contestant'); ?>">
								<i class="menu-icon fa fa-user-plus"></i>
								Add a New Contestant
							</a>
						</li>
						<li class="hover">
							<a class="dropdown-toggle">
								<i class="menu-icon fa fa-users"></i>
								Bulk Contestant Pack
								<b class="arrow fa fa-angle-right"></b>
							</a>
							<b class="arrow"></b>

							<ul class="submenu">
								<li class="hover">
									<a href="<?php echo base_url($module.'/user_management/bulk_contestant'); ?>">
										<i class="menu-icon fa fa-user-plus"></i>
										All Bulk Contestant Packs
									</a>
								</li>
								<li class="hover">
									<a href="<?php echo base_url($module.'/user_management/create_bulk_contestant'); ?>">
										<i class="menu-icon fa fa-user-plus"></i>
										Add Bulk Contestant Pack
									</a>
								</li>
							</ul>
						</li>
					</ul>
				</li>
			</ul>
		</li>

		<li>
			<a>
			<span class="menu-text">======================</span>
			</a>
		</li>


		<li class="hover">
			<a href="<?php echo $fullpath; ?>#">
				<i class="menu-icon fa fa-desktop"></i>
				<span class="menu-text">
					UI &amp; Elements
				</span>

				<b class="arrow fa fa-angle-right"></b>
			</a>

			<b class="arrow"></b>

			<ul class="submenu">
				<li class="hover">
					<a href="<?php echo $fullpath; ?>#" class="dropdown-toggle">
						<i class="menu-icon fa fa-caret-right"></i>

						Layouts
						<b class="arrow fa fa-angle-right"></b>
					</a>

					<b class="arrow"></b>

					<ul class="submenu">
						<li class="hover">
							<a href="<?php echo $fullpath; ?>top-menu.html">
								<i class="menu-icon fa fa-caret-right"></i>
								Top Menu
							</a>

							<b class="arrow"></b>
						</li>

						<li class="hover">
							<a href="<?php echo $fullpath; ?>two-menu-1.html">
								<i class="menu-icon fa fa-caret-right"></i>
								Two Menus 1
							</a>

							<b class="arrow"></b>
						</li>

						<li class="hover">
							<a href="<?php echo $fullpath; ?>two-menu-2.html">
								<i class="menu-icon fa fa-caret-right"></i>
								Two Menus 2
							</a>

							<b class="arrow"></b>
						</li>

						<li class="hover">
							<a href="<?php echo $fullpath; ?>mobile-menu-1.html">
								<i class="menu-icon fa fa-caret-right"></i>
								Default Mobile Menu
							</a>

							<b class="arrow"></b>
						</li>

						<li class="hover">
							<a href="<?php echo $fullpath; ?>mobile-menu-2.html">
								<i class="menu-icon fa fa-caret-right"></i>
								Mobile Menu 2
							</a>

							<b class="arrow"></b>
						</li>

						<li class="hover">
							<a href="<?php echo $fullpath; ?>mobile-menu-3.html">
								<i class="menu-icon fa fa-caret-right"></i>
								Mobile Menu 3
							</a>

							<b class="arrow"></b>
						</li>
					</ul>
				</li>

				<li class="hover">
					<a href="<?php echo $fullpath; ?>typography.html">
						<i class="menu-icon fa fa-caret-right"></i>
						Typography
					</a>

					<b class="arrow"></b>
				</li>

				<li class="hover">
					<a href="<?php echo $fullpath; ?>elements.html">
						<i class="menu-icon fa fa-caret-right"></i>
						Elements
					</a>

					<b class="arrow"></b>
				</li>

				<li class="hover">
					<a href="<?php echo $fullpath; ?>buttons.html">
						<i class="menu-icon fa fa-caret-right"></i>
						Buttons &amp; Icons
					</a>

					<b class="arrow"></b>
				</li>

				<li class="hover">
					<a href="<?php echo $fullpath; ?>content-slider.html">
						<i class="menu-icon fa fa-caret-right"></i>
						Content Sliders
					</a>

					<b class="arrow"></b>
				</li>

				<li class="hover">
					<a href="<?php echo $fullpath; ?>treeview.html">
						<i class="menu-icon fa fa-caret-right"></i>
						Treeview
					</a>

					<b class="arrow"></b>
				</li>

				<li class="hover">
					<a href="<?php echo $fullpath; ?>jquery-ui.html">
						<i class="menu-icon fa fa-caret-right"></i>
						jQuery UI
					</a>

					<b class="arrow"></b>
				</li>

				<li class="hover">
					<a href="<?php echo $fullpath; ?>nestable-list.html">
						<i class="menu-icon fa fa-caret-right"></i>
						Nestable Lists
					</a>

					<b class="arrow"></b>
				</li>

				<li class="hover">
					<a href="<?php echo $fullpath; ?>#" class="dropdown-toggle">
						<i class="menu-icon fa fa-caret-right"></i>

						Three Level Menu
						<b class="arrow fa fa-angle-right"></b>
					</a>

					<b class="arrow"></b>

					<ul class="submenu">
						<li class="hover">
							<a href="<?php echo $fullpath; ?>#">
								<i class="menu-icon fa fa-leaf green"></i>
								Item #1
							</a>

							<b class="arrow"></b>
						</li>

						<li class="hover">
							<a href="<?php echo $fullpath; ?>#" class="dropdown-toggle">
								<i class="menu-icon fa fa-pencil orange"></i>

								4th level
								<b class="arrow fa fa-angle-right"></b>
							</a>

							<b class="arrow"></b>

							<ul class="submenu">
								<li class="hover">
									<a href="<?php echo $fullpath; ?>#">
										<i class="menu-icon fa fa-plus purple"></i>
										Add Product
									</a>

									<b class="arrow"></b>
								</li>

								<li class="hover">
									<a href="<?php echo $fullpath; ?>#">
										<i class="menu-icon fa fa-eye pink"></i>
										View Products
									</a>

									<b class="arrow"></b>
								</li>
							</ul>
						</li>
					</ul>
				</li>
			</ul>
		</li>

		<li class="hover">
			<a href="<?php echo $fullpath; ?>#" class="dropdown-toggle">
				<i class="menu-icon fa fa-list"></i>
				<span class="menu-text"> Tables </span>

				<b class="arrow fa fa-angle-right"></b>
			</a>

			<b class="arrow"></b>

			<ul class="submenu">
				<li class="hover">
					<a href="<?php echo $fullpath; ?>tables.html">
						<i class="menu-icon fa fa-caret-right"></i>
						Simple &amp; Dynamic
					</a>

					<b class="arrow"></b>
				</li>

				<li class="hover">
					<a href="<?php echo $fullpath; ?>jqgrid.html">
						<i class="menu-icon fa fa-caret-right"></i>
						jqGrid plugin
					</a>

					<b class="arrow"></b>
				</li>
			</ul>
		</li>

		<li class="hover">
			<a href="<?php echo $fullpath; ?>#" class="dropdown-toggle">
				<i class="menu-icon fa fa-pencil-square-o"></i>
				<span class="menu-text"> Forms </span>

				<b class="arrow fa fa-angle-right"></b>
			</a>

			<b class="arrow"></b>

			<ul class="submenu">
				<li class="hover">
					<a href="<?php echo $fullpath; ?>form-elements.html">
						<i class="menu-icon fa fa-caret-right"></i>
						Form Elements
					</a>

					<b class="arrow"></b>
				</li>

				<li class="hover">
					<a href="<?php echo $fullpath; ?>form-elements-2.html">
						<i class="menu-icon fa fa-caret-right"></i>
						Form Elements 2
					</a>

					<b class="arrow"></b>
				</li>

				<li class="hover">
					<a href="<?php echo $fullpath; ?>form-wizard.html">
						<i class="menu-icon fa fa-caret-right"></i>
						Wizard &amp; Validation
					</a>

					<b class="arrow"></b>
				</li>

				<li class="hover">
					<a href="<?php echo $fullpath; ?>wysiwyg.html">
						<i class="menu-icon fa fa-caret-right"></i>
						Wysiwyg &amp; Markdown
					</a>

					<b class="arrow"></b>
				</li>

				<li class="hover">
					<a href="<?php echo $fullpath; ?>dropzone.html">
						<i class="menu-icon fa fa-caret-right"></i>
						Dropzone File Upload
					</a>

					<b class="arrow"></b>
				</li>
			</ul>
		</li>

		<li class="hover">
			<a href="<?php echo $fullpath; ?>widgets.html">
				<i class="menu-icon fa fa-list-alt"></i>
				<span class="menu-text"> Widgets </span>
			</a>

			<b class="arrow"></b>
		</li>

		<li class="hover">
			<a href="<?php echo $fullpath; ?>calendar.html">
				<i class="menu-icon fa fa-calendar"></i>

				<span class="menu-text">
					Calendar

					<span class="badge badge-transparent tooltip-error" title="2 Important Events">
						<i class="ace-icon fa fa-exclamation-triangle red bigger-130"></i>
					</span>
				</span>
			</a>

			<b class="arrow"></b>
		</li>

		<li class="hover">
			<a href="<?php echo $fullpath; ?>gallery.html">
				<i class="menu-icon fa fa-picture-o"></i>
				<span class="menu-text"> Gallery </span>
			</a>

			<b class="arrow"></b>
		</li>

		<li class="hover">
			<a href="<?php echo $fullpath; ?>#" class="dropdown-toggle">
				<i class="menu-icon fa fa-tag"></i>
				<span class="menu-text"> More Pages </span>

				<b class="arrow fa fa-angle-right"></b>
			</a>

			<b class="arrow"></b>

			<ul class="submenu">
				<li class="hover">
					<a href="<?php echo $fullpath; ?>profile.html">
						<i class="menu-icon fa fa-caret-right"></i>
						User Profile
					</a>

					<b class="arrow"></b>
				</li>

				<li class="hover">
					<a href="<?php echo $fullpath; ?>inbox.html">
						<i class="menu-icon fa fa-caret-right"></i>
						Inbox
					</a>

					<b class="arrow"></b>
				</li>

				<li class="hover">
					<a href="<?php echo $fullpath; ?>pricing.html">
						<i class="menu-icon fa fa-caret-right"></i>
						Pricing Tables
					</a>

					<b class="arrow"></b>
				</li>

				<li class="hover">
					<a href="<?php echo $fullpath; ?>invoice.html">
						<i class="menu-icon fa fa-caret-right"></i>
						Invoice
					</a>

					<b class="arrow"></b>
				</li>

				<li class="hover">
					<a href="<?php echo $fullpath; ?>timeline.html">
						<i class="menu-icon fa fa-caret-right"></i>
						Timeline
					</a>

					<b class="arrow"></b>
				</li>

				<li class="hover">
					<a href="<?php echo $fullpath; ?>email.html">
						<i class="menu-icon fa fa-caret-right"></i>
						Email Templates
					</a>

					<b class="arrow"></b>
				</li>

				<li class="hover">
					<a href="<?php echo $fullpath; ?>login.html">
						<i class="menu-icon fa fa-caret-right"></i>
						Login &amp; Register
					</a>

					<b class="arrow"></b>
				</li>
			</ul>
		</li>

		<li class="hover">
			<a href="<?php echo $fullpath; ?>#" class="dropdown-toggle">
				<i class="menu-icon fa fa-file-o"></i>

				<span class="menu-text">
					Other Pages

					<span class="badge badge-primary">5</span>
				</span>

				<b class="arrow fa fa-angle-right"></b>
			</a>

			<b class="arrow"></b>

			<ul class="submenu">
				<li class="hover">
					<a href="<?php echo $fullpath; ?>faq.html">
						<i class="menu-icon fa fa-caret-right"></i>
						FAQ
					</a>

					<b class="arrow"></b>
				</li>

				<li class="hover">
					<a href="<?php echo $fullpath; ?>error-404.html">
						<i class="menu-icon fa fa-caret-right"></i>
						Error 404
					</a>

					<b class="arrow"></b>
				</li>

				<li class="hover">
					<a href="<?php echo $fullpath; ?>error-500.html">
						<i class="menu-icon fa fa-caret-right"></i>
						Error 500
					</a>

					<b class="arrow"></b>
				</li>

				<li class="hover">
					<a href="<?php echo $fullpath; ?>grid.html">
						<i class="menu-icon fa fa-caret-right"></i>
						Grid
					</a>

					<b class="arrow"></b>
				</li>

				<li class="hover">
					<a href="<?php echo $fullpath; ?>blank.html">
						<i class="menu-icon fa fa-caret-right"></i>
						Blank Page
					</a>

					<b class="arrow"></b>
				</li>
			</ul>
		</li>
	</ul><!-- /.nav-list -->

	<div class="sidebar-toggle sidebar-collapse" id="sidebar-collapse">
		<i class="ace-icon fa fa-angle-double-left" data-icon1="ace-icon fa fa-angle-double-left" data-icon2="ace-icon fa fa-angle-double-right"></i>
	</div>

	<script type="text/javascript">
		try{ace.settings.check('sidebar' , 'collapsed')}catch(e){}
	</script>
</div>