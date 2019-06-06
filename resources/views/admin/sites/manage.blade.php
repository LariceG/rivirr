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
						<li class="active"><span>{{$title}}</span></li>
					  </ol>
					</div>
					<!-- /Breadcrumb -->
				</div>
				<!-- /Title -->
				
				<!-- Row -->
				<div class="row">
					<div class="col-sm-12">
						<div class="panel panel-default card-view">
							<div class="panel-wrapper collapse in">
								<div class="panel-body">
									<div class="table-wrap">
									@if (Session::get('success'))
									<div class="alert alert-success">
									{{ Session::get('success') }}
									</div>
									@endif
									@if (Session::get('error'))
									<div class="alert alert-danger text-center">
									{{ Session::get('error') }}
									</div>
									@endif
									@if(Session::get('user_type') == 'admin')
									<div style="width:100%;display:flex;justify-content:flex-end;"><a href="{{ url('/admin/'.$active.'/add') }}"><button class="btn  btn-success ">Add Site</button></a></div>
									@endif
										<div class="table-responsive">
											<table id="example" class="table table-hover display  pb-30" >
                                            <thead>
                                            <tr>
                                                <th>Sr.No</th>
												<th>Site Name</th>
												<th>Site Location</th>                                     
												@if(Session::get('user_type') != 'employee')
											   <th>Action</th>
												@endif
                                            </tr>
                                        </thead>
                                        <tbody>
										
										@foreach($datas as $key => $data)
                                            <tr>
                                                <td>{{ $key+1 }}</td>
												<td>{{ $data->site_name }}</td>
												<td>{{ $data->site_location }}</td>
                                           	  @if(Session::get('user_type') != 'employee')
												<td>  <div class="table-data-feature">
                                                    
                                                    <a href="{{ url('/admin/'.$active.'/edit/'.$data->id) }}"><button class="btn btn-primary" data-toggle="tooltip" data-placement="top" title="Edit">
                                                        Edit
                                                    </button></a>&nbsp;&nbsp;
                                                    <button type="button" onclick="deleteRow('{{ url('/admin/'.$active.'/delete/'.$data->id) }}')" class="btn btn-danger" data-toggle="tooltip" data-placement="top"  title="Delete">
                                                        Delete
                                                    </button></a>
                                                   
                                                </div></td>
												@endif
                                            </tr>
											
                                         @endforeach
										
                                        </tbody>
											</table>
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