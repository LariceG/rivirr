
<div class="modal-dialog"><div class="modal-content">
			<div class="modal-header">
				 <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
				 <h5 class="modal-title" id="myModalLabel">Edit Profile</h5>
			 </div>
			 <div class="modal-body">
				 <!-- Row -->
				 <div class="row">
					 <div class="col-lg-12">
						 <div class="">
							 <div class="panel-wrapper collapse in">
								 <div class="panel-body pa-0">
								 <form action="{{ url('/admin/client/site/update/')}}" method="post" enctype="multipart/form-data">
									 <div class="col-sm-12 col-xs-12">
										 <div class="form-wrap">
										 
	
	 <div class="form-body overflow-hide">
	 <div class="form-group">
<label class="control-label mb-10">Select Supervisor</label>
<select class="form-control select2" onchange="getEditEmployees('{{ url('/admin/clients/getEmployees/') }}')" name="supervisor_id" id="supervisor_Id" required>
<option value="">Select Supervisor</option>
@foreach($supervisors as $supervisor)
<option <?php if($supervisor->id == $site->supervisor_id){ echo 'selected'; }?> value="{{$supervisor->id}}">{{$supervisor->name}}</option>
@endforeach
  </select>
<div class="help-block with-errors"></div>
</div>
<div id="modalError">
											
</div> 
<div class="form-group">
<label class="control-label mb-10">Select Employee</label>
<select class="form-control select2" id="employee_id" name="employee_id"  required>
<option value="">Select Employee</option>
@foreach($employees as $employee)
<option <?php if($employee->id == $site->employee_id){ echo 'selected'; }?> value="{{$employee->id}}">{{$employee->name}}</option>
@endforeach

</select>
<div class="help-block with-errors"></div>
</div>
<div class="form-group">
	
	<label class="control-label mb-10">Select Shift</label>
		<select class="form-control select2" id="Shift" name="Shift" required  onchange="modalValidation()">
			<option value="">Select Shift</option>
			<option <?php if($site->shift == 'morning') { echo "selected" ;} ;?> value="morning">Morning</option>
			<option <?php if($site->shift == 'evening') { echo "selected" ;} ;?> value="evening">Evening</option>
			<option <?php if($site->shift == 'night') { echo "selected" ;} ;?> value="night">Night</option>
		</select>
		<div class="help-block with-errors"></div>
</div>
<div class="form-group">
		
				 <label for="email" class=" form-control-label">Site Name</label>
				 <input type="text" required  id="site_name_modal"  name="site_name" placeholder="Enter Site Name"  class="form-control" value="{{$site->site_name}}">
				 <div class="help-block with-errors"></div>
		 </div>

		 
		 </div>
		 <div class="form-group">
			
				 <label for="password" class=" form-control-label">Site Location</label>
				 <input type="text" required id="site_location_modal"  name="site_location" placeholder="Enter Site Location"  class="form-control" value="{{$site->site_location}}"> 
				 <div class="help-block with-errors"></div>
		 </div>
		 <input type="hidden" name="_token" id="csrf-token" value="{{ Session::token() }}" />
         <input type="hidden" name="site_id" id="site_id" value="{{$site->id}}" />
         <input type="hidden" name="client_id" id="client_id" value="{{$site->client_id}}" />
	 </div>
	 <div class="form-actions mt-10">			
		 <button type="button" class="btn btn-success mr-10 mb-30" id="update" onclick="modalValidation()">Update profile</button>
	 </div>				
 
 
 	</div>
	 </form>	
 </div>
</div>
</div>
</div>
</div>
</div>
</div>

</div>