<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

<head>

<meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Valet</title>

<link rel="stylesheet" href="{{ URL::asset('public/assets/frontend/css/bootstrap.min.css') }}">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css">
<script src="{{ URL::asset('public/assets/frontend/js/jquery.min.js') }}"></script>
<link href="https://fonts.googleapis.com/css?family=Quicksand:300,400,500,700" rel="stylesheet">
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
<?php if(request()->is('valet/type')){ ?>
	<div class="col-xs-12 col-sm-12">
	<?php if(Session::get('ticketno')){ ?>
	<?php  $ticket_notification = DB::table('tickets')->where(['ticketno' => Session::get('ticketno')])->first(); ?>
	<?php if(($ticket_notification->status == '4' or $ticket_notification->status == '5' or $ticket_notification->status == '2') and $ticket_notification->read_status == '0'){  
    if($ticket_notification->first_name != ""){
	if($ticket_notification->status == '2'){
	?>
	
	<div class="col-sm-12 ">
	<div class="alert alert-success text-center">
	<p class="avl"> {{  $ticket_notification->first_name  }} sent you request for car</p>
	
	<a href="{{ url('valet/request_response/'.Session::get('ticketno')) }}">  <input type="button" name="enter" class="btn acpt" value="ACCEPT REQUEST" /> </a></div></div>
	
	
	<?php }}} ?>
	<script>
	setInterval(get_fb, 10000);
	function get_fb(){
		$.ajax({
			type: "GET",
			url: "<?php echo url('valet/check_notification/'.Session::get('ticketno')); ?>",
			async: false,			
		   success: function(data){		 		
			setTimeout(function(){get_fb();}, 10000);
			if(data == '1'){
			window.location.href = "<?php echo $_SERVER['REQUEST_URI']; ?>";
			}
		 }
			
		});
	} 
</script>
	<?php } ?>
    </div>
<?php } ?>
	</div>
	