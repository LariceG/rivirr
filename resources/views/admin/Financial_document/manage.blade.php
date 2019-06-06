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

<!-- Row -->
<div class="row">
<div class="col-sm-12">
<div class="panel panel-default card-view">
<div class="panel-wrapper collapse in">
<div class="panel-body">
<div class="table-wrap">
@if (Session::get('success'))
<div class="alert alert-success text-center">
{{ Session::get('success') }}
</div>
@endif
@if (Session::get('error'))
<div class="alert alert-danger text-center">
{{ Session::get('error') }}
</div>
@endif

<div style="width:100%;display:flex;justify-content:flex-end;"><a href="{{ url('/admin/financial_documents/add') }}"><button class="btn  btn-success ">Add Document</button></a></div>

<div class="table-responsive">
<table id="example" class="table table-hover display  pb-30" >
<thead>
<tr>
<th>Sr.No</th>
<th>Document</th>

<th>Action</th>

</tr>
</thead>
<tbody>
<?php  $i=1 ;?>
@foreach($document as $documents)

<tr>
<td>{{$i}}</td>
<td> <img src="{{$documents->document}}" alt=""> </td>
<td>
<a href="{{ url('/admin/financial_documents/edit/').'/'.$documents->id}}"> <button class="btn btn-info">Edit</button> </a>

<a href="{{ url('/admin/financial_documents/delete/').'/'.$documents->id}}"><button class="btn btn-danger">Delete</button></a> 
</td>

</tr>
<?php $i++ ; ?>
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

@include('admin.includes.footer')   