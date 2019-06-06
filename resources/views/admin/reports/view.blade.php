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
											
											@if(Session::get('user_type') == 'admin' || Session::get('user_type') == 'client')
											<div class="form-group">
                                            <label for="username" class=" form-control-label">Supervisor</label>
                                            <input type="text" id="username" readonly value="{{$data->supervisor_name}}" class="form-control">
                                            <div class="help-block with-errors"></div>
                                            </div>
                                            @endif   
                                                <div class="form-group">
                                                    <label for="email" class=" form-control-label">Employee</label>
                                                    <input type="text" readonly value="{{$data->employee_name}}" class="form-control">
                                                    <div class="help-block with-errors"></div>
                                                </div>
                                              
                                                <div class="form-group">
                                                    <label for="phone" class=" form-control-label">Report Title</label>
                                                    <input type="text" readonly value="{{$data->report_title}}"class="form-control">
                                                    <div class="help-block with-errors"></div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="a_phone" class=" form-control-label">Report Description</label>
													<textarea readonly class="form-control" rows="5">{{$data->report_description}}</textarea>
                                                    
                                                    <div class="help-block with-errors"></div>
                                                </div>
												
												<div class="col-sm-12 ol-md-12 col-xs-12">
											<div class="panel panel-default card-view">
												
												<div class="panel-wrapper collapse in">
													<div class="panel-body">
														
														<div class="">
														
															<div class="dropify-preview" style="display:block">
															<?php $images = explode(',',$data->images);
															foreach($images as $image)
															{
															?>
															<span class="dropify-render">
															<img width="200px" height="200px" src="{{$image}}">
															</span>
															<?php } ?>
															<div class="dropify-infos">
															<div class="dropify-infos-inner">
															
															</div>
															</div>
															</div>
														
														</div>	
													</div>
												</div>
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