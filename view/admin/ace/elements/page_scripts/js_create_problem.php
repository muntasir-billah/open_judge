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
</script>