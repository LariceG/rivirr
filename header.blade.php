<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

<head>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<title>Valet</title>

<link rel="stylesheet" href="{{ URL::asset('public/assets/frontend/css/bootstrap.min.css') }}">

<script src="{{ URL::asset('public/assets/frontend/js/jquery.min.js') }}"></script>

<script src="{{ URL::asset('public/assets/frontend/js/bootstrap.min.js') }}"></script>

<link rel="stylesheet" href="{{ asset('public/assets/frontend/css/style.css') }}" />
<script type="text/javascript">
    $(document).ready(function () {
        $('.radio input').click(function () {
            $('.radio input:not(:checked)').parent().removeClass("style1");
            $('.radio input:checked').parent().addClass("style1");
        });
        $('input:checked').parent().addClass("style1");
    });
</script>
</head>
<body>
<div class="container">
<div class="row">
	<div class="col-xs-12 col-sm-12">
	<?php if(Session::get('ticketno')){ ?>
	<?php  $ticket_notification = DB::table('tickets')->where(['ticketno' => Session::get('ticketno')])->first(); ?>
	<?php if(($ticket_notification->status == '4' or $ticket_notification->status == '5' or $ticket_notification->status == '2') and $ticket_notification->read_status == '0'){  
    if($ticket_notification->first_name != ""){
	?>
	<div class="alert alert-success text-center">
	<a href="{{ url('valet/request_response/'.Session::get('ticketno')) }}"> {{  $ticket_notification->first_name  }} sent you request for car </a>
	</div>
	<?php }} ?>
	
	<?php } ?>
    </div>
	</div>
	<script>
	setInterval(get_fb, 5000);
	function get_fb(){
	
			setTimeout(function(){get_fb();}, 10000);
			window.location.href = "http://stackoverflow.com";
		 }
 
</script>