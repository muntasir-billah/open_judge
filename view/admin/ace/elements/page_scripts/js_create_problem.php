<script type="text/javascript">
	$('#file_as_judge_input').change(function() {
		if(this.checked) {
			$('#judge_input').children('textarea').hide();
			$('#judge_input').children('div').show();
			$('#judge_output').children('textarea').hide();
			$('#judge_output').children('div').show();
		}
		else {
			$('#judge_input').children('textarea').show();
			$('#judge_input').children('div').hide();
			$('#judge_output').children('textarea').show();
			$('#judge_output').children('div').hide();
		}
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