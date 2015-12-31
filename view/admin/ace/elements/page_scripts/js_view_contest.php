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


	$('.remove_judge').click(function () {
		if(confirm("Really? You want to remove this judge from this contest?")) {
			var judgeid = $(this).attr('judgeid');
			var contestid = $(this).attr('contestid');
			var id = 'judge' + judgeid;
			var url = "<?php echo base_url($module.'/'.$this->subview.'/remove_judge'); ?>/" + judgeid + '/' + contestid;
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

	$('.remove_contestant').click(function () {
		if(confirm("Really? You want to remove this contestant from this contest?")) {
			var userid = $(this).attr('userid');
			var contestid = $(this).attr('contestid');
			var id = 'user' + userid;
			var url = "<?php echo base_url($module.'/'.$this->subview.'/remove_contestant'); ?>/" + userid + '/' + contestid;
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

	$('.judge_reply_button').click(function() {
		var question = $(this).parent('.tools').siblings('.text').html();
		var clar_id = $(this).attr("id");

		$('.clar_question').html(question);
		$('#clar_id').val(clar_id);
		$('.clar_reply').val('');
		$('#clar_reply_box_oj').fadeIn(300);

		return false;

	});

	$('.my_modal_close').click(function() {
		$('.my_modal').fadeOut(300);
	});


	$('.judge_reply_form').submit(function() {
		var url = "<?php echo base_url($module.'/contest/reply_clar'); ?>";
		var clar_id = $('#clar_id').val();
		var reply = $('.clar_reply').val();

		postData = {"clarification_id":clar_id, "clarification_reply":reply}

		$.post(url,postData, function(data){
			//alert(data);
			if(data == 'yes'){
			  $("#clar_success").fadeIn(300);
			  $("#clar_success").fadeOut(3000);
			}
			else{
			  $("#clar_error").fadeIn(300);
			  $("#clar_error").fadeOut(3000);
			}
		});

		$('.my_modal').fadeOut(300);
		return false;
  	});

	$('#judge_clarification').submit(function() {
		var url = "<?php echo base_url($module.'/contest/judge_clar'); ?>";
		var clar = $('#judge_clar_text').val();
		var contestid = <?php echo $contest->contest_id; ?>;

		postData = {"clarification_question":clar, "contest_id":contestid}

		$.post(url,postData, function(data){
			//alert(data);
			if(data == 'yes'){
			  $("#clar_success").fadeIn(300);
			  $("#clar_success").fadeOut(3000);
			  $('#judge_clar_text').val('');
			}
			else{
			  $("#clar_error").fadeIn(300);
			  $("#clar_error").fadeOut(3000);
			}
		});
		return false;
  	});

  	$('#ignore_button').click(function() {
		var reply = "ignored"
		$('.clar_reply').val(reply);
		$('.judge_reply_form').submit();
  	});

  	$('.delete_clar').click(function() {
		var url = "<?php echo base_url($module.'/contest/delete_clar'); ?>";
  		var id = $(this).attr('clarid');

		postData = {"clar_id":id}

		$.post(url,postData, function(data){
			//alert(data);
			if(data == 'yes'){
			  $("#clar_success").fadeIn(300);
			  $("#clar_success").fadeOut(3000);
			  id = 'clar'+id;
	  		  $('.'+id).fadeOut(1000);
			}
			else{
			  $("#clar_error").fadeIn(300);
			  $("#clar_error").fadeOut(3000);
			}
		});
  		return false;
  	});



	// Tab Url change
	$(function(){
		// jquery plugin call
		$('.nav-tabs').stickyTabs();

		var hash = window.location.hash;
		if(hash.indexOf('/')!== -1){
			var temp = hash.split('/')[0];
			var sub_hash = hash.split('/')[1];
			var sub_hash = '#'+sub_hash;
			temp && $('ul.nav a[href="' + temp + '"]').tab('show')
			sub_hash && $('ul.nav a[href="' + sub_hash + '"]').tab('show');
		}else{
			hash && $('ul.nav a[href="' + hash + '"]').tab('show');
		}
		

		$('.nav-tabs a').click(function (e) {
			if(this.hash.length < 3){
				$(this).tab('show');
				var scrollmem = $('body').scrollTop();
				var num_hash = this.hash.split('#')[1];
				window.location.hash = '#problems/'+num_hash;
				$('html,body').scrollTop(scrollmem);
			}
			else{
				$(this).tab('show');
				var scrollmem = $('body').scrollTop();
				window.location.hash = this.hash;
				$('html,body').scrollTop(scrollmem);
			}
		});
	});

	// ============== Custom Countdown Clock Timer =====================//
	<?php if($contest->contest_status != 2) { ?>
	var current_time = Date.parse("<?php echo $current; ?>");
	var end_time = "<?php echo $end; ?>";
	function getTimeRemaining(endtime) {
	  var t = Date.parse(endtime) - current_time;
	  var seconds = Math.floor((t / 1000) % 60);
	  var minutes = Math.floor((t / 1000 / 60) % 60);
	  var hours = Math.floor((t / (1000 * 60 * 60)) % 24);
	  var days = Math.floor(t / (1000 * 60 * 60 * 24));
	  return {
	    'total': t,
	    'days': days,
	    'hours': hours,
	    'minutes': minutes,
	    'seconds': seconds
	  };
	}

	function initializeClock(id, endtime) {
	  var clock = document.getElementById(id);
	  var daysSpan = clock.querySelector('.days');
	  var hoursSpan = clock.querySelector('.hours');
	  var minutesSpan = clock.querySelector('.minutes');
	  var secondsSpan = clock.querySelector('.seconds');

	  function updateClock() {

	    current_time += 1000;
	    var t = getTimeRemaining(endtime);

	    daysSpan.innerHTML = t.days;
	    hoursSpan.innerHTML = ('0' + t.hours).slice(-2);
	    minutesSpan.innerHTML = ('0' + t.minutes).slice(-2);
	    secondsSpan.innerHTML = ('0' + t.seconds).slice(-2);

	    if (t.total <= 0) {
	      clearInterval(timeinterval);
		  	var url = window.location.href;
		  	window.location.href = url;
	    }
	  }

	  updateClock();
	  var timeinterval = setInterval(updateClock, 1000);
	}

	var deadline = new Date(Date.parse(end_time));
	initializeClock('clockdiv', deadline);
	<?php } ?>
	// ================================================= //

	$('.view_submission').click(function() {
		var subid = $(this).html();

		var url = "<?php echo base_url($module.'/'.$this->subview.'/fetch_submission'); ?>/" + subid;
		$.post( url, function( data ) {
			if(data != '') {
				data = "<pre>" + data + "</pre>";
				$('#submission_source_box').html(data);
				$('#submission_source_modal').fadeIn(500);
			}
			else alert("Failed to fetch");
		});
	});

</script>