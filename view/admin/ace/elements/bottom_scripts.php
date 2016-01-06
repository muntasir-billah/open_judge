
<!-- ace scripts -->
<script src="<?php echo $fullpath; ?>assets/js/ace-elements.min.js"></script>
<script src="<?php echo $fullpath; ?>assets/js/ace.min.js"></script>

<script>
	$('.delete_button').click(function() {
		var text = $(this).attr('title');
		text = 'Are You Sure To ' + text + '?';
		if(!confirm(text)) return false;
	});

	

	$('.delete_contest').click(function () {
		if(confirm("Really? You want to delete this contest?")) {
			var contestid = $(this).attr('contestid');
			var id = 'contest' + contestid;
			var url = "<?php echo base_url($module.'/'.$this->subview.'/delete_contest'); ?>/" + contestid;
			$.post( url, function( data ) {
				if(data == 'yes') {
					$('#'+id).fadeOut(1000);
				}
				else {
					alert("Failed to remove");
				}
			});
		}
		else return false;
	});
	
	$('#edit_row').click(function() {
		$('.view_row').hide();
		$('#view_row').removeClass('active');
		$('.edit_row').show();
		$('#edit_row').addClass('active');
	});

	$('#view_row').click(function() {
		$('.edit_row').hide();
		$('#edit_row').removeClass('active');
		$('.view_row').show();
		$('#view_row').addClass('active');
	});
</script>

<?php if($this->session->admin_type == 'admin') { ?>
<script>
	var ajax_call = function() {

		var url = "<?php echo base_url($module.'/Dashboard/check_contest_status'); ?>/";
		$.post( url );

		var url = "<?php echo base_url($module.'/contest/process_submissions'); ?>/";
		$.post( url );
	};

	var X = 5;
	//var interval = 1000 * 60 * X; // where X is your every X minutes

	var interval = 400;

	setInterval(ajax_call, interval);
</script>
<?php } ?>