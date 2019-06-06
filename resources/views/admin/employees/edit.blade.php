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
											<div class="col-md-12">
											<div class="col-md-6">
											<div class="form-group">
													<label class="form-control-label">Select Supervisor</label>
													<select class="form-control select2" name="supervisor_id" required>
														<option value="">Select Supervisor</option>
														@foreach($supervisors as $key => $supervisor)
														<option <?php if($supervisor->id == $data->supervisor_id){ echo 'selected'; } ?> value="{{$supervisor->id}}">{{$supervisor->name}}</option>
														@endforeach
													</select>
													<div class="help-block with-errors"></div>
											</div>
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
												<div class="form-group">
                                                    <label for="email" class=" form-control-label">Date Of Birth</label>
                                                    <input type="date" required id="date_of_birth"  name="date_of_birth" placeholder="Enter Supervisor Email"  class="form-control" value="{{$data->date_of_birth}}">
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
                                                    <label for="email" class=" form-control-label">Position</label>
                                                    <select class="form-control" name="position" id="position">
													<option value="">Select</option>
													@foreach($positions as $position)
													
													<option <?php if($data->position == $position->id) { echo "selected" ; }; ?> value="{{$position->id}}">{{$position->name}}</option>
													@endforeach
													</select>
                                                    <div class="help-block with-errors"></div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="a_phone" class=" form-control-label">Alternate Phone</label>
                                                    <input type="number" required id="a_phone"  value="{{$data->alternate_phone}}" name="alternate_phone" placeholder="Enter Supervisor Alternate Phone Number"  class="form-control">
                                                    <div class="help-block with-errors"></div>
                                                </div>
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
										<div class="col-md-12">
                                                <div class="form-group col-md-4 certificate-img-outer">
												<label for="phone" class="  h4 text-dark col-md-12">ID/Licence</label>
												<div class="clearfix"></div>
												@if($licence_images != '')
												             
															   @foreach($licence_images as $licence_image)
															  
															<div class="dropify-preview col-md-4" style="display:block; min-height:100px;">
															<span class="delete-img" name="delete_licence_image" id="{{$licence_image->id}}" style="cursor: pointer;" onclick="imgDelete({{$licence_image->id}},'licence_images')">&times;</span> 
															<span class="dropify-render ">
														
															<img width="100%" src="{{$licence_image->images}}">
															</span>
															<input type="hidden" id="licence_image_id" value="{{$licence_image->id}}">
															<input type="hidden" id="table_licence" value="licence_images">
															<div class="dropify-infos">
															<div class="dropify-infos-inner">
															
															</div>
															</div>
															</div>
															
															@endforeach
												
															
															@endif
															<div class="clearfix"></div>
                                                   
                                                    <input type="file"  id="licence"  name="licence[]" placeholder="Enter Supervisor Phone Number"  class="form-control" multiple>
                                                    <div class="help-block with-errors"></div>
                                                </div>

												<div class="form-group col-md-4 certificate-img-outer">
												<label for="a_phone" class="h4 text-dark col-md-12">Contract policy</label>
                                                  
                                                    <div class="help-block with-errors"></div>
												     @if($id_images != '')
										
														@foreach($id_images as $id_image)
												    <div class="dropify-preview col-md-4" style="display:block; min-height:100px;">
															<span class="delete-img" onclick="imgDelete({{$id_image->id}},'id_images')" style="cursor: pointer;">&times;</span>
															<span class="dropify-render ">
															
															<img width="100%" src="{{$id_image->images}}">
															</span>
															<div class="dropify-infos">
															<div class="dropify-infos-inner">
															
															</div>
															</div>
															</div>
															@endforeach
															@endif
															<div class="clearfix"></div>
                                               <input type="file"  id="adhar"  name="adhar[]" placeholder="Enter Supervisor Alternate Phone Number"  class="form-control" multiple>
                                                </div>

												<div class="form-group col-md-4 certificate-img-outer">
												<label for="a_phone" class="h4 text-dark col-md-12">Certification</label>
                                                  
                                                    <div class="help-block with-errors"></div>
													@if($certification_images != '')
											
														@foreach($certification_images as $certification_image)
												    <div class="dropify-preview col-md-4" style="display:block; min-height:100px;">
															<span class="delete-img" onclick="imgDelete({{$certification_image->id}},'certification_images')" style="cursor: pointer;">&times;</span>
															<span class="dropify-render ">
															
															<img width="100%" src="{{$certification_image->images}}">
															</span>
															<div class="dropify-infos">
															<div class="dropify-infos-inner">
															
															</div>
															</div>
															</div>
															@endforeach
															@endif
															<div class="clearfix"></div>
                                               <input type="file"  id="Certification"  name="digree[]" placeholder="Enter Supervisor Alternate Phone Number"  class="form-control" multiple>
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