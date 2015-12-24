<!-- basic scripts -->

<!--[if !IE]> -->
<script src="<?php echo $fullpath; ?>assets/js/jquery.2.1.1.min.js"></script>

<?php require_once('oj_scripts.php'); ?>

<!-- <![endif]-->

		<!--[if IE]>
<script src="<?php echo $fullpath; ?>assets/js/jquery.1.11.1.min.js"></script>
<![endif]-->

<!--[if !IE]> -->
<script type="text/javascript">
	window.jQuery || document.write("<script src='<?php echo $fullpath; ?>assets/js/jquery.min.js'>"+"<"+"/script>");
</script>

<!-- <![endif]-->

		<!--[if IE]>
<script type="text/javascript">
 window.jQuery || document.write("<script src='<?php echo $fullpath; ?>assets/js/jquery1x.min.js'>"+"<"+"/script>");
</script>
<![endif]-->
<script type="text/javascript">
	if('ontouchstart' in document.documentElement) document.write("<script src='<?php echo $fullpath; ?>assets/js/jquery.mobile.custom.min.js'>"+"<"+"/script>");
</script>
<script src="<?php echo $fullpath; ?>assets/js/bootstrap.min.js"></script>
<script src="<?php echo $fullpath; ?>assets/js/jquery.stickytabs.js"></script>


<!-- page specific plugin scripts -->

<!--[if lte IE 8]>
  <script src="<?php echo $fullpath; ?>assets/js/excanvas.min.js"></script>
  <![endif]-->

<script src="<?php echo $fullpath; ?>assets/js/jquery-ui.custom.min.js"></script>
<script src="<?php echo $fullpath; ?>assets/js/jquery.ui.touch-punch.min.js"></script>



