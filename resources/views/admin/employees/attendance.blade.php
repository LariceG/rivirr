@include('admin.includes.header')
<!-- Main Content -->
<div class="page-wrapper">
<div class="container-fluid">

<!-- Title -->
<div class="row heading-bg">
<div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
<h5 class="txt-dark">{{$title}}</h5>
</div>
<!-- Breadcrumb -->
<div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
<ol class="breadcrumb">
<li><a href="{{ url('/admin/dashboard') }}">Dashboard</a></li> 
<li class="active"><span>{{$title}}</span></li>
</ol>
</div>
<!-- /Breadcrumb -->
</div>
<!-- /Title -->
<p>Total Working Hours : {{$totalHours}}</p>
<!-- Row -->
<div class="row">
<div class="col-sm-12">
<div class="panel panel-default card-view">
<div class="panel-wrapper collapse in">
<div class="panel-body">
<div class="table-wrap">
@if (Session::get('success'))
<div class="alert alert-success">
{{ Session::get('success') }}
</div>
@endif
@if (Session::get('error'))
<div class="alert alert-danger text-center">
{{ Session::get('error') }}
</div>
@endif
@if(Session::get('user_type') == 'admin')
<div style="width:100%;display:flex;justify-content:flex-end;"><a href="{{ url('/admin/'.$active.'/add') }}"><button class="btn  btn-success ">Add Employee</button></a></div>
@endif
<div class="table-responsive">
<table id="example" class="table table-hover display  pb-30" >
<thead>
<tr>
<th>Sr.No</th>
<th>Date</th>
<th>Location</th>
<th>Time</th>
<th>Status</th>

</tr>
</thead>
<tbody>
<?php $i=1 ;
$start = 0;
$end = 0
?>
@foreach($attendance as $attendances)
<tr>
<td>{{$i}}</td>
<td>{{$attendances->date}}</td>
<td>{{$attendances->location}}</td>
<td>{{$attendances->time}}</td>
@if($attendances->checkin_status == 1 )
<td>{{'Checked in '}}</td>
@elseif($attendances->checkin_status == 0)
<td>{{'Checked Out '}}</td>
@endif

</tr>
<?php $i++ ;

?>
@endforeach

</tbody>
</table>
</div>
</div>
</div>
</div>
</div>	
</div>
</div>
<!-- /Row -->
</div>
<script>


</script>
@include('admin.includes.footer')   