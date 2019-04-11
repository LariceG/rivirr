@include('admin.includes.header')
<!-- MAIN CONTENT-->
            <div class="main-content">
                <div class="section__content section__content--p30">
                    <div class="container-fluid">
                        <div class="row">
                        
                            <div class="col-lg-12">
                                <div class="card">
                                    <div class="card-header">
                                        <strong>Change</strong>
                                        <small> Password</small>
                                    </div>
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
									<form action="{{ url('/admin/update_password') }}" method="post" enctype="multipart/form-data">
                                    <div class="card-body card-block">
                                        <div class="form-group">
                                            <label for="old_password" class=" form-control-label">Old Password</label>
                                            <input type="password" id="old_password" name="old_password" placeholder="Enter your old password" class="form-control">
                                        </div>
										@if ($errors->first('old_password'))
										<label class="error">
										{{ $errors->first('old_password') }}
										</label>
										@endif
                                        <div class="form-group">
                                            <label for="new_password" class=" form-control-label">New Password</label>
                                            <input type="password" id="new_password" name="new_password" placeholder="Enter your new password" class="form-control">
                                        </div>
										@if ($errors->first('new_password'))
										<label class="error">
										{{ $errors->first('new_password') }}
										</label>
										@endif                              
										<input type="hidden" name="_token" id="csrf-token" value="{{ Session::token() }}" />
									       <div class="card-footer">
                                        <button type="submit" class="btn btn-primary btn-sm">
                                            <i class="fa fa-dot-circle-o"></i> Submit
                                        </button>
                                        <a href="{{ url('/admin/dashboard') }}"><button type="button" class="btn btn-danger btn-sm">
                                            <i class="fa fa-ban"></i> Cancel
                                        </button></a>
                                    </div>
                                </div>
                               </form>
                               
                                
                            </div>
                
                        </div>

 @include('admin.includes.footer')   