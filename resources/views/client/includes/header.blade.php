<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

<head>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<title>Client</title>

<link rel="stylesheet" href="{{ URL::asset('assets/frontend/css/bootstrap.min.css') }}">

<script src="{{ URL::asset('assets/frontend/js/jquery.min.js') }}"></script>

<script src="{{ URL::asset('assets/frontend/js/bootstrap.min.js') }}"></script>


<link rel="stylesheet" href="{{ URL::asset('assets/frontend/css/style.css') }}" />
<link rel="stylesheet" href="{{ URL::asset('assets/frontend/css/sarbjit_style.css') }}" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.0/sweetalert.min.js"></script>
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