<script type="text/javascript">

	$('.remove_problem').click(function () {
		if(confirm("Really? You want to remove this problem from this contest?")) {
			var problemid = $(this).attr('problemid');
			var contestid = $(this).attr('contestid');
			var id = 'problem' + problemid;
			var url = "<?php echo base_url($module.'/'.$this->subview.'/remove_problem'); ?>/" + problemid + '/' + contestid;
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

</script>