<script type="text/javascript">

	$('.delete_problem').click(function () {
		if(confirm("Really? You want to delete this problem?")) {
			var problemid = $(this).attr('problemid');
			var id = 'problem' + problemid;
			var url = "<?php echo base_url($module.'/'.$this->subview.'/delete_problem'); ?>/" + problemid;
			$.post( url, function( data ) {
				if(data == 'yes') {
					//alert("Success");
					$('#'+id).fadeOut(1000);
				}
				else {
					alert("Failed to remove");
				}
			});
		}
		else return false;
	});

	
	$('.delete_problem').click(function () {
		if(confirm("Really? You want to delete this problem?")) {
			var problemid = $(this).attr('problemid');
			var id = 'problem' + problemid;
			var url = "<?php echo base_url($module.'/'.$this->subview.'/delete_problem'); ?>/" + problemid;
			$.post( url, function( data ) {
				if(data == 'yes') {
					//alert("Success");
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