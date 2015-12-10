
<!-- ace scripts -->
<script src="<?php echo $fullpath; ?>assets/js/ace-elements.min.js"></script>
<script src="<?php echo $fullpath; ?>assets/js/ace.min.js"></script>

<script>
	$('.delete_button').click(function() {
		var text = $(this).attr('title');
		text = 'Are You Sure To ' + text + '?';
		if(!confirm(text)) return false;
	});
</script>

<script>
	var ajax_call = function() {

		var url = "<?php echo base_url($module.'/Dashboard/check_contest_status'); ?>/";
		$.post( url );

		var url = "<?php echo base_url($module.'/contest/process_submissions'); ?>/";
		$.post( url );
	};

	var X = 5;

	//var interval = 1000 * 60 * X; // where X is your every X minutes

	var interval = 1000;

	setInterval(ajax_call, interval);
</script>