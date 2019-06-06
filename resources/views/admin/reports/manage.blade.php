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
							@if(Session::get('user_type') == 'employee')
					<div style="width:100%;display:flex;justify-content:flex-end;"><a href="{{ url('/employee/'.$active.'/add') }}"><button class="btn  btn-success ">Report genrate</button></a></div>
					@endif 
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
									
										<div class="table-responsive">
											<table id="example" class="table table-hover display  pb-30" >
                                            <thead>
                                            <tr>
												<th>Sr.No</th>
												@if(Session::get('user_type') == 'admin' || Session::get('user_type') == 'client')
												<th>Supervisor</th>
												@endif
												@if(Session::get('user_type') != 'employee')
												<th>Employee</th>
												@endif
												<th>Site</th>
                                                <th>Title</th>
                                                <th>Description</th> 
                                                <th>File</th>                                                                                   
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
										
										@foreach($datas as $key => $data)
										
                                            <tr>
												<td>{{ $key+1 }}</td>
												@if(Session::get('user_type') == 'admin' || Session::get('user_type') == 'client')
												<td>{{$data->supervisor_name}}</td>
												@endif
												@if(Session::get('user_type') != 'employee')
												<td>{{ $data->employee_name }}</td>
												@endif
												<td>{{ $data->site }}</td>
                                                <td>{{ $data->report_title }}</td>
                                                <td>{{ $data->report_description }}</td>												
                                                <td><img height="70px" width="70px" src="{{ $data->image }}"/></td>
												
                                                
												<td>  <div class="table-data-feature">
                                                    
                                                    <a href="{{ url('/admin/'.$active.'/view/'.$data->id) }}"><button class="btn btn-primary" data-toggle="tooltip" data-placement="top" title="Edit">
                                                        View
													</button></a>
													@if(Session::get('user_type') == 'admin')
													&nbsp;&nbsp;
                                                    <button type="button" onclick="deleteRow('{{ url('/admin/'.$active.'/delete/'.$data->id) }}')" class="btn btn-danger" data-toggle="tooltip" data-placement="top"  title="Delete">
                                                        Delete
                                                    </button></a>
													@endif
                                                </div></td>
												
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