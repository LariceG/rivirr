@include('admin.includes.header')
<!-- Main Content -->
<div class="page-wrapper">
				<div class="container-fluid">
					<!-- Title -->
					<div class="row heading-bg">
						<div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
							<h5 class="txt-dark">Change Password</h5>
						</div>
					
						<!-- Breadcrumb -->
						<div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
							<ol class="breadcrumb">
								<li><a href="{{ url('/admin/dashboard') }}">Dashboard</a></li>								
								<li class="active"><span>Change Password</span></li>
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
										<h6 class="panel-title txt-dark">Change Password</h6>
									</div>
									<div class="clearfix"></div>
								</div>
								<div class="panel-wrapper collapse in">
									<div class="panel-body">
										
										<div class="row">
											<div class="col-md-12">
												<div class="form-wrap">
                                                @if (Session::get('success'))
                                                <div class="alert alert-success">
                                                {{ Session::get('success') }}
                                                </div>
                                                @endif
                                                @if (Session::get('error'))
                                                <div class="alert alert-danger alert-dismissable">
                                                {{ Session::get('error') }}
                                                </div>
                                                @endif
											<form action="{{ url('/admin/update_password') }}" method="post" enctype="multipart/form-data" data-toggle="validator" role="form">
                                            <div class="form-group">
                                            <label for="old_password" class=" form-control-label">Old Password</label>
                                            <input type="password" required id="old_password" name="old_password" placeholder="Enter your old password" class="form-control">
                                            <div class="help-block with-errors"></div>
                                                </div>
                                               
                                            <div class="form-group">
                                            <label for="new_password" class=" form-control-label">New Password</label>
                                            <input type="password" required id="new_password" name="new_password" placeholder="Enter your new password" class="form-control">
                                            <div class="help-block with-errors"></div>
                                            </div>
                                               
                                              
										        <input type="hidden" name="_token" id="csrf-token" value="{{ Session::token() }}" />
														<div class="form-group mb-0">
															<button type="submit" class="btn btn-success btn-anim"><i class="icon-rocket"></i><span class="btn-text">submit</span></button>
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