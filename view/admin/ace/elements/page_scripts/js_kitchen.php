<script>
$(document).ready(function() {
	var count = 0;
	var compile_url = "<?php echo base_url('admin/contest/compile'); ?>/";
	var fetch_url = "<?php echo base_url('admin/contest/fetch_sub_with_limit'); ?>/";
	var busy = false;

	// var current = $('#sub_table').children('tr:first').attr('id');
	// $('#'+current).children('td.sub_status').html('<i class="ace-icon fa fa-spinner fa-spin blue bigger-125"></i> Processing');

	function compile_function() {
		busy = true;
		var current = $('#sub_table').children('tr:first').attr('id');
		$('#'+current).children('td.sub_status').html('<i class="ace-icon fa fa-spinner fa-spin blue bigger-125"></i> Processing');
		var url = compile_url + current;
		$.post( url, function( data ) { 
			if(data != '') {
				//alert(data);
				$('#'+current).children('td.sub_status').html(data);
				--count;
				$('#'+current).fadeOut(300, function() {
					$(this).remove();
					busy = false;
				});
			}
		});
	}

	function fetch_sub() {
		var limit = 10;
		var url = fetch_url + limit;
		$.getJSON( url, function( data ) { 
			if(data != '') {
				count = data.length;
				for (var i = 0; i < count; i++) {
					var sub = data[i];
					var row = '<tr id="' + sub.submission_id + '">';
					row += '<td><a class="view_submission">' + sub.submission_id + '</a></td>';
					row += '<td><a href="<?php echo base_url("admin/problem/view_problem?problem_id="); ?>' + sub.problem_id + '" target="_blank">Problem ' + sub.problem_id + '</a></td>';
					row += '<td>' + sub.language_id + '</td>'
					row += '<td>' + sub.submission_time + '</td>';
					row += '<td class="sub_status">In Queue</td></tr>';

					$('#sub_table').append(row);
				}
			}
		});
	}


	var kitchen = function() {
		if(count > 0) {
			if(!busy) compile_function();
		}
		else if(count == 0) fetch_sub();
	};

	var interval = 400;

	setInterval(kitchen, interval);
});

</script>