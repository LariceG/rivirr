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
												@if(Session::get('user_type') == 'employee')
												<form action="{{ url('/employee/'.$active.'/genrate') }}" method="post" enctype="multipart/form-data" data-toggle="validator" role="form">
												@else
											<form action="{{ url('/admin/'.$active.'/insert') }}" method="post" enctype="multipart/form-data" data-toggle="validator" role="form">
											@endif
											<div class="col-md-12">
											<div class="col-md-6">
										
                                            <div class="form-group">
                                            <label for="username" class=" form-control-label">Title</label>
                                            <input type="text" id="reportTitle" required name="reportTitle" placeholder="Enter Title" class="form-control">
                                            <div class="help-block with-errors"></div>
                                                </div>
                                             
												</div>
												<div class="col-md-6 ">
												
                                                <div class="form-group">
                                                    <label for="password" class="form-control-label">Description</label>
                                                    
													<textarea name="reportDescription" id="reportDescription" cols="30" rows="1" class="form-control" style=" min-height: 42px;" placeholder="Write Description..."></textarea>
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
															<input type="file" name="image[]" id="input-file-now" class="dropify" multiple />
															<div class="help-block with-errors"></div>
														</div>	
													</div>
												</div>
											</div>
										</div>
										<div class="clearfix"></div>
										
										<input type="hidden" name="userId" id="userId" value="{{ $admin->id }}" />
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