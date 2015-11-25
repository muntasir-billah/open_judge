<!DOCTYPE html>
<html lang="en">

<?php require_once('elements/head.php'); ?>

<body class="no-skin">

	<?php require_once('elements/nav.php'); ?>

	<div class="main-container" id="main-container">

		<script type="text/javascript">
			try{ace.settings.check('main-container' , 'fixed')}catch(e){}
		</script>

		<?php require_once('elements/sidebar.php'); ?>

		<div class="main-content">
			<div class="main-content-inner">
				<!--
				<div class="breadcrumbs" id="breadcrumbs">
					<script type="text/javascript">
						try{ace.settings.check('breadcrumbs' , 'fixed')}catch(e){}
					</script>

			
					<ul class="breadcrumb">
						<li>
							<i class="ace-icon fa fa-tachometer home-icon"></i>
							<a href="<?php echo base_url($module); ?>#">Dashboard</a>
						</li>
						<li><?php echo $subview; ?></li>
						<li><?php echo $title; ?></li>
					</ul><!-- /.breadcrumb --

					<div class="nav-search" id="nav-search">
						<form class="form-search">
							<span class="input-icon">
								<input type="text" placeholder="Search ..." class="nav-search-input" id="nav-search-input" autocomplete="off" />
								<i class="ace-icon fa fa-search nav-search-icon"></i>
							</span>
						</form>
					</div><!-- /.nav-search --
				</div> <!-- Breadcrumbs end -->

				<!---------------- Content -------------------------->

				<?php require($content); ?>

				<!-- ----------- Content Ends ----------------------->

			</div><!-- main-content-inner" -->
		</div><!-- /.main-content -->

		<?php require_once('elements/footer.php'); ?>


	</div><!-- /.main-container -->


	<?php require_once('elements/top_scripts.php'); ?>


    <?php
        if(isset($page_scripts) && count($page_scripts) != 0) {
            foreach($page_scripts as $script) require_once('elements/page_scripts/'.$script);
        }
    ?>

	<?php require_once('elements/bottom_scripts.php'); ?>

</body>
</html>
