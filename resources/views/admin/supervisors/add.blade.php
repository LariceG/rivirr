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
											<form action="{{ url('/admin/'.$active.'/insert') }}" method="post" enctype="multipart/form-data" data-toggle="validator" role="form">
											<div class="col-md-12">
											<div class="col-md-6">
											<div class="form-group">
                                            <label for="username" class=" form-control-label">Name</label>
                                            <input type="text" id="username" required name="name" placeholder="Enter Supervisor Name" class="form-control">
                                            <div class="help-block with-errors"></div>
                                                </div>
												<div class="form-group">
                                                    <label for="a_phone" class=" form-control-label">Alternate Phone</label>
                                                    <input type="number" required id="a_phone"  name="alternate_phone" placeholder="Enter Supervisor Alternate Phone Number"  class="form-control">
                                                    <div class="help-block with-errors"></div>
                                                </div>
                                              
                                                <div class="form-group">
                                                    <label for="email" class=" form-control-label">Email</label>
                                                    <input type="email" required id="email"  name="email" placeholder="Enter Supervisor Email"  class="form-control">
                                                    <div class="help-block with-errors"></div>
                                                </div>
												<div class="form-group">
                                                    <label for="address" class=" form-control-label">Address</label>
                                                    <input type="text" required id="address" name="address" placeholder="Enter Client Address"  class="form-control">
                                                    <div class="help-block with-errors"></div>
                                                </div>
												
												</div>
												<div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="phone" class=" form-control-label">Phone</label>
                                                    <input type="number" required id="phone"  name="phone" placeholder="Enter Supervisor Phone Number"  class="form-control">
                                                    <div class="help-block with-errors"></div>
                                                </div>
												
												<div class="form-group">
                                                    <label for="email" class=" form-control-label">Position</label>
                                                    <select class="form-control" name="position" id="position">
													<option value="">Select</option>
													@foreach($positions as $position)
												
													<option  value="{{$position->id}}">{{$position->name}}</option>
													@endforeach
													</select>
                                                    <div class="help-block with-errors"></div>
                                                </div>                                               
												 
                                               
												<div class="form-group">
                                                    <label for="password" class=" form-control-label">Password</label>
                                                    <input type="password" required id="password"  name="password" placeholder="Enter Supervisor Password"  class="form-control">
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
															<input type="file" name="image" id="input-file-now" class="dropify" />
															<div class="help-block with-errors"></div>
														</div>	
													</div>
												</div>
											</div>
										</div>
                                      
										<div class="col-md-12">
                                                <div class="form-group col-md-4">
                                                    <label for="phone" class=" form-control-label">ID/Driving Licence</label>
                                                    <input type="file" required id="licence"  name="licence[]" placeholder="Enter Supervisor Phone Number"  class="form-control" multiple>
                                                    <div class="help-block with-errors"></div>
                                                </div>
                                                <div class="form-group col-md-4">
                                                    <label for="a_phone" class=" form-control-label">Contract policy</label>
                                                    <input type="file" required id="adhar"  name="adhar[]" placeholder="Enter Supervisor Alternate Phone Number"  class="form-control" multiple>
                                                    <div class="help-block with-errors"></div>
                                                </div>
												<div class="form-group col-md-4">
                                                    <label for="address" class=" form-control-label">Certification</label>
                                                    <input type="file" required id="digree" name="digree[]" placeholder="Enter Client Address"  class="form-control" multiple>
                                                    <div class="help-block with-errors"></div>
                                                </div>
												</div>
												<div class="clearfix"></div>
                                               
										        <input type="hidden" name="_token" id="csrf-token" value="{{ Session::token() }}" />
														<div class="form-group mb-0 text-center">
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