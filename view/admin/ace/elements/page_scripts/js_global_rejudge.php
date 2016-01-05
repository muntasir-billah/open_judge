
<script>
	$('#global_rejudge_start_button').click(function() {
		$('#global_rejudge_start_button').hide();
		$('#rejudging').fadeIn(300);
		$('#reset_ranklist').fadeIn(300);
		var url = "<?php echo base_url('admin/contest/reset_ranks/'.$contest->contest_id); ?>";
		$.post( url, function( data ) {
			if(data == 'finish') {
				$('#reset_ranklist').children('label').children('span').html('100%');
				$('#reset_ranklist').children('div.progress').children('div.progress-bar').css('width', '100%');
				reset_prob_cont_rel();
			}
		});
	});

	function reset_prob_cont_rel() {
		$('#reset_prob_cont_rel').fadeIn(300);
		var url = "<?php echo base_url('admin/contest/reset_prob_cont_rel/'.$contest->contest_id); ?>";
		$.post( url, function( data ) {
			if(data == 'finish') {
				$('#reset_prob_cont_rel').children('label').children('span').html('100%');
				$('#reset_prob_cont_rel').children('div.progress').children('div.progress-bar').css('width', '100%');
				reset_submissions();
			}
		});
	}

	function reset_submissions() {
		$('#reset_submissions').fadeIn(300);
		var url = "<?php echo base_url('admin/contest/reset_submissions/'.$contest->contest_id); ?>";
		$.post( url, function( data ) {
			if(data == 'finish') {
				$('#reset_submissions').children('label').children('span').html('100%');
				$('#reset_submissions').children('div.progress').children('div.progress-bar').css('width', '100%');
				rejudge();
			}
		});
	}

	function rejudge() {
		$('#rejudge').fadeIn(300);
		var url = "<?php echo base_url('admin/contest/reset_submissions/'.$contest->contest_id); ?>";
		$.post( url, function( data ) {
			if(data == 'finish')
				check_sub();
		});
	}

	var complete = 5;

	function check_sub() {
		var check_sub_percentage = function() {
			if(complete == 100) return 0;
			var total_sub = <?php echo $count; ?>;
			//var processed_sub = 1;

			var url = "<?php echo base_url('admin/contest/get_processed_sub_for_contest_count/'.$contest->contest_id); ?>";
			//$.post( url, function( data ) { processed_sub = data });
			$.post( url, function( data ) { 
				var processed_sub = data; 
				var percent = Math.floor((processed_sub/total_sub)*100);

				//alert('Total: ' + total_sub +', Processed: ' + processed_sub + ', Percentage: ' + percent);

				$('#rejudge').children('label').children('span').html(percent + '%');
				$('#rejudge').children('div.progress').children('div.progress-bar').css('width', percent+'%');

				if(percent == 100) {
					$('#rejudge').children('div.progress').children('div.progress-bar').removeClass('active');
					$('#success').fadeIn(300);
				}

				complete = percent;
			});
		};

		var interval = 500;

		setInterval(check_sub_percentage, interval);
	}

	
</script>