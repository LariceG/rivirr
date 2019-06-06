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
				@if(Session::get('user_type') == 'employee')
					<div style="width:100%;display:flex;justify-content:flex-end;"><a href="{{ url('/employee/leaves/add') }}"><button class="btn  btn-success ">Add Leave</button></a></div>
					@endif 	
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
					
						<div class="table-responsive">
							<table id="example" class="table table-hover display  pb-30" >
							<thead>
							<tr>
								<th>Sr.No</th>
								@if(Session::get('user_type') == 'admin')
								<th>Supervisor Name</th>
								@endif
								@if(Session::get('user_type') != 'employee')
								<th>Client Name</th>
								<th>Employee Name</th>
								<th>Site Name</th>
								@endif
								<th>Leave From</th>                                                                                   
								<th>Leave To</th>
								<th>Reason</th>
								@if(Session::get('user_type') != 'employee')
								<th>Action</th>
								@endif
								@if(Session::get('user_type') == 'employee')
								<th>Status</th>
								@endif
							</tr> 
						</thead>
						<tbody>
						
              <?php  $i ='1';?>
			@foreach($leaves as $leave)
				<tr>
					 <td>{{$i}}</td>
					 @if(Session::get('user_type') == 'admin')
			         <td>{{$leave->supervisor_name}}</td>
					 @endif
					 @if(Session::get('user_type') != 'employee')
					<td>{{$leave->client_name}}</td>
			    <td>{{$leave->user_name}}</td>
					<td>{{$leave->site_name}}</td>	
					@endif
					<td>{{$leave->date_from}}</td>
					<td>{{$leave->date_to}}</td>	
					<td>{{$leave->message}}</td>
					@if(Session::get('user_type') != 'employee')										
					<td><div class="table-data-feature">
						@if($leave->status == '0')
						<a href="{{url('/change_status').'/'.$leave->id.'/'.'1'}}"><button class="btn btn-primary"  > 
						Accept
						</button></a>
                         @elseif($leave->status == '1')
						<a href="#"><button class="btn btn-primary" data-toggle="tooltip" data-placement="top" title="Edit" disabled>
						Accepted
						</button></a>
                          
						&nbsp;&nbsp;
						 @endif
						 @if($leave->status == '0')
						 <a href="{{url('/change_status').'/'.$leave->id.'/'.'2'}}"><button type="button"  class="btn btn-danger" >
						Decline
						</button></a>
                          @elseif($leave->status == '2')
						<button type="button"  class="btn btn-danger" data-toggle="tooltip" data-placement="top"  title="Delete" disabled>
						Declined
						</button>
				@endif
					</div></td>
					@endif
					@if(Session::get('user_type') == 'employee')
					<td>
					@if($leave->status == '0')
					<a href="#"><button class="btn btn-primary" data-toggle="tooltip" data-placement="top" title="Edit" disabled>
					 Pending
						</button></a>
					
					@elseif($leave->status == '1')
						<a href="#"><button class="btn btn-success" data-toggle="tooltip" data-placement="top" title="Edit" disabled>
						Accepted
						</button></a>
                          
						&nbsp;&nbsp;
					
						 @elseif($leave->status == '2')
						<button type="button"  class="btn btn-danger" data-toggle="tooltip" data-placement="top"  title="Delete" disabled>
						Declined
						</button>
				@endif
					</td>
					@endif
					<input type="hidden" name="status" id="status" value="{{$leave->id}}">
				</tr>
	   <?php $i++; ?>
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
function change_Status(status)
{
     var Id = $('#status').val();
	$.ajax({
   type:"get",
   url:"{{url('/change_status')}}"+'/'+$('#status').val()+'/'+status,
   success:function(data)
   {
   
   } 
   
});
   
}
</script>
 @include('admin.includes.footer')   