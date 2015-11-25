<script type="text/javascript">

	$('#contest_type').change(function() {
		var val = $(this).val();
		if(val == 1) {
			$('#contest_pass').show();
			$('#contest_pass_input').attr('required', '');
		}
		else {
			$('#contest_pass').hide();
			$('#contest_pass_input').removeAttr('required');
		}
	});

</script>