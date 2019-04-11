@include('admin.includes.header')
<!-- MAIN CONTENT-->
            <div class="main-content">
                <div class="section__content section__content--p30">
                    <div class="container-fluid">
                        <div class="row">
                        
                            <div class="col-lg-12">
                                <div class="card">
                                    <div class="card-header">
                                        <strong>Edit</strong>
                                        <small> Profile</small>
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
									<form action="{{ url('/admin/update_profile') }}" method="post" enctype="multipart/form-data">
                                    <div class="card-body card-block">
                                        <div class="form-group">
                                            <label for="username" class=" form-control-label">Username</label>
                                            <input type="text" id="username" name="username" placeholder="Enter your Username" value="{{ $admin->username }}" class="form-control">
                                        </div>
										@if ($errors->first('username'))
										<label class="error">
										{{ $errors->first('username') }}
										</label>
										@endif
                                        <div class="form-group">
                                            <label for="email" class=" form-control-label">Email</label>
                                            <input type="text" id="email" name="email" placeholder="Enter your Email" value="{{ $admin->email }}" class="form-control">
                                        </div>
										@if ($errors->first('email'))
										<label class="error">
										{{ $errors->first('email') }}
										</label>
										@endif
                                        <div class="form-group">
                                            <label for="image" class=" form-control-label">Image</label>
                                            <input type="file" id="image" name="image" class="form-control">                     
										</div>
										@if ($errors->first('image'))
										<label class="error">
										{{ $errors->first('image') }}
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