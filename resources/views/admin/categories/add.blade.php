@include('admin.includes.header')
<!-- MAIN CONTENT-->
            <div class="main-content">
                <div class="section__content section__content--p30">
                    <div class="container-fluid">
                        <div class="row">
                        
                            <div class="col-lg-12">
                                <div class="card">
                                    <div class="card-header">
                                          <div class="overview-wrap">
                                    <h2 class="title-1">Add Category</h2>
                                    <a href="{{ url('/admin/categories') }}"><button class="au-btn au-btn-icon au-btn--green">
                                     Back</button></a>
                                </div>
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
									<form action="{{ url('/admin/categories/insert') }}" method="post" enctype="multipart/form-data">
                                    <div class="card-body card-block">
                                        <div class="form-group">
                                            <label for="name" class=" form-control-label">Category Name</label>
                                            <input type="text" id="name" name="name" placeholder="Enter category name" value="{{ old('name') }}" class="form-control">
                                        </div>
										@if ($errors->first('name'))
										<label class="error">
										{{ $errors->first('name') }}
										</label>
										@endif
                                        
                                      
										<input type="hidden" name="_token" id="csrf-token" value="{{ Session::token() }}" />
									       <div class="card-footer">
                                        <button type="submit" class="btn btn-primary btn-sm">
                                            <i class="fa fa-dot-circle-o"></i> Submit
                                        </button>
                                        <a href="{{ url('/admin/categories') }}"><button type="button" class="btn btn-danger btn-sm">
                                            <i class="fa fa-ban"></i> Cancel
                                        </button></a>
                                    </div>
                                </div>
                               </form>
                               
                                
                            </div>
                
                        </div>

 @include('admin.includes.footer')   