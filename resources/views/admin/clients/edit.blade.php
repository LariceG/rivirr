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
                                <li><a href="{{ url('/admin/'.$active) }}">{{ucfirst($active)}}</a></li>								
								<li class="active"><span>{{$title}}</span></li>
							</ol>
						</div>
						<!-- /Breadcrumb -->
					
					</div>
					<!-- /Title -->
					
					<!-- Row -->
					<div class="row">
						<div class="col-md-12">
							<div class="panel panel-default card-view">
								<div class="panel-heading">
									<div class="pull-left">
										<h6 class="panel-title txt-dark">{{$title}}</h6>
									</div>
									<div class="clearfix"></div>
								</div>
								<div class="panel-wrapper collapse in">
									<div class="panel-body">
										
										<div class="row">
											<div class="col-md-12">
												<div class="form-wrap">
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
											<form action="{{ url('/admin/'.$active.'/update') }}" method="post" enctype="multipart/form-data" data-toggle="validator" role="form">
											<!--div class="form-group">
													<label class="control-label mb-10">Select Supervisor</label>
													<select class="form-control select2" onchange="getEmployees('{{ url('/admin/clients/getEmployees/') }}')" name="supervisor_id" id="supervisor_id" required>
														<option value="">Select Supervisor</option>
														@foreach($supervisors as $key => $supervisor)
														<option <?php if($supervisor->id == $data->supervisor_id){ echo 'selected'; } ?> value="{{$supervisor->id}}">{{$supervisor->name}}</option>
														@endforeach
													</select>
													<div class="help-block with-errors"></div>
											</div>
											<div class="form-group">
													<label class="control-label mb-10">Select Employee</label>
													<select class="form-control select2" id="employee_id" name="employee_id" required>
														<option value="">Select Employee</option>
														@foreach($employees as $key => $employee)
														<option <?php if($employee->id == $data->employee_id){ echo 'selected'; } ?> value="{{$employee->id}}">{{$employee->name}}</option>
														@endforeach
													</select>
													<div class="help-block with-errors"></div>
											</div-->
											<div class="col-md-12">
											<div class="col-md-6">
											<div class="form-group">
                                            <label for="username" class=" form-control-label">Name</label>
                                            <input type="text" id="username" value="{{$data->name}}" required name="name" placeholder="Enter Supervisor Name" class="form-control">
                                            <div class="help-block with-errors"></div>
                                                </div>
                                               
                                                <div class="form-group">
                                                    <label for="email" class=" form-control-label">Email</label>
                                                    <input type="email" required id="email"  name="email" placeholder="Enter Supervisor Email" value="{{$data->email}}" class="form-control">
                                                    <div class="help-block with-errors"></div>
                                                </div>
												</div>
												<div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="phone" class=" form-control-label">Phone</label>
                                                    <input type="number" required id="phone" value="{{$data->phone}}"  name="phone" placeholder="Enter Supervisor Phone Number"  class="form-control">
                                                    <div class="help-block with-errors"></div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="a_phone" class=" form-control-label">Alternate Phone</label>
                                                    <input type="number" required id="a_phone"  value="{{$data->alternate_phone}}" name="alternate_phone" placeholder="Enter Supervisor Alternate Phone Number"  class="form-control">
                                                    <div class="help-block with-errors"></div>
                                                </div>
												</div>
												<div class="col-md-12">
												<div class="form-group">
                                                    <label for="address" class=" form-control-label">Address</label>
                                                    <input type="text" required id="address" value="{{$data->address}}" name="address" placeholder="Enter Client Address"  class="form-control">
                                                    <div class="help-block with-errors"></div>
                                                </div>
												</div>
											<div class="col-sm-12 ol-md-12 col-xs-12">
											<div class="panel panel-default card-view">
												<div class="panel-heading">
													<div class="pull-left">
														<h6 class="panel-title txt-dark">Image</h6>
													</div>
													<div class="clearfix"></div>
												</div>
												<div class="panel-wrapper collapse in">
													<div class="panel-body">
														
														<div class="">
														@if($data->image != '')
															<div class="dropify-preview" style="display:block">
															<span class="dropify-render">
															<img width="200px" height="200px" src="{{$data->image}}">
															</span>
															<div class="dropify-infos">
															<div class="dropify-infos-inner">
															
															</div>
															</div>
															</div>
															@endif
															<input type="file" name="image" id="input-file-now" class="dropify" />
															<div class="help-block with-errors"></div>
														</div>	
													</div>
												</div>
											</div>
										</div>
												<input type="hidden" name="id" id="csrf-token" value="{{ $data->id }}" />
										        <input type="hidden" name="_token" id="csrf-token" value="{{ Session::token() }}" />
														<div class="form-group mb-0">
															<button type="submit" class="btn btn-success btn-anim"><i class="icon-rocket"></i><span class="btn-text">submit</span></button>
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
					<!-- /Row -->
				</div>
		

 @include('admin.includes.footer')   