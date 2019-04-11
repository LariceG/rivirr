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
                                    <h2 class="title-1">Edit Valet</h2>
                                    <a href="{{ url('/admin/valets') }}"><button class="au-btn au-btn-icon au-btn--green">
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
									<form action="{{ url('/admin/valets/update') }}" method="post" enctype="multipart/form-data">
                                    <div class="card-body card-block">
									<div class="form-group">                                               
										<label for="category" class=" form-control-label">Select Category</label> <select name="category" id="category" class="form-control-sm form-control">
										<option value="">Please select</option>
										@foreach($categories as $key => $category)
										<?php ?>
										<option value="{{ $category->name }}" <?php if($category->name == $data->category){ echo 'selected'; }?>>{{ $category->name }}</option>
										@endforeach;
										</select>                                               
                                        </div>
										@if ($errors->first('category'))
										<label class="error">
										{{ $errors->first('category') }}
										</label>
										@endif
                                        <div class="form-group">
                                            <label for="name" class=" form-control-label">Name</label>
                                            <input type="text" id="name" name="name" placeholder="Enter valet name" value="{{ $data->name}}" class="form-control">
                                        </div>
										@if ($errors->first('name'))
										<label class="error">
										{{ $errors->first('name') }}
										</label>
										@endif
                                         <div class="form-group">
                                            <label for="name" class=" form-control-label">Email</label>
                                            <input type="text" id="name" name="email" value="{{ $data->email}}" placeholder="Enter valet email" class="form-control">
                                        </div>
										@if ($errors->first('email'))
										<label class="error">
										{{ $errors->first('email') }}
										</label>
										@endif
										 <div class="form-group">
                                            <label for="name" class=" form-control-label">Phone</label>
                                            <input type="number" id="name" name="phone" value="{{ $data->phone}}" placeholder="Enter valet phone" class="form-control">
                                        </div>
										@if ($errors->first('phone'))
										<label class="error">
										{{ $errors->first('phone') }}
										</label>
										@endif
										
										<div class="form-group">
										<label for="name" class=" form-control-label">Address</label>
										<input type="text" id="name" name="address" value="{{ $data->name}}" placeholder="Enter valet address" value="{{ $data->address}}" class="form-control">
                                        </div>
										@if ($errors->first('address'))
										<label class="error">
										{{ $errors->first('address') }}
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
										<input type="hidden" name="id" id="id" value="{{ $data->id}}" />
										<input type="hidden" name="_token" id="csrf-token" value="{{ Session::token() }}" />
									       <div class="card-footer">
                                        <button type="submit" class="btn btn-primary btn-sm">
                                            <i class="fa fa-dot-circle-o"></i> Update
                                        </button>
                                        <a href="{{ url('/admin/valets') }}"><button type="button" class="btn btn-danger btn-sm">
                                            <i class="fa fa-ban"></i> Cancel
                                        </button></a>
                                    </div>
                                </div>
                               </form>
                               
                                
                            </div>
                
                        </div>

 @include('admin.includes.footer')   