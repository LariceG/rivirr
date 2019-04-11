@include('admin.includes.header')
<!-- MAIN CONTENT-->
            <div class="main-content">
                <div class="section__content section__content--p30">
                    <div class="container-fluid">
                         <div class="row">
                            <div class="col-md-12">
                                <div class="overview-wrap">
                                    <h2 class="title-1">Manage Employees</h2>
                                    <!--a href="{{ url('/admin/employers/add') }}"><button class="au-btn au-btn-icon au-btn--green">
                                        <i class="zmdi zmdi-plus"></i>add employer</button></a-->
                                </div>
                            </div>
                        </div>
                                <!-- DATA TABLE-->
            <section class="p-t-20">
                <div class="container">
                    <div class="row">
                        
                            <div class="col-md-12">
                                <!-- DATA TABLE-->
								
                                <div class="table-responsive m-b-40">
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
                                    <table class="table table-borderless table-data3">
                                        <thead>
                                            <tr>
                                                <th>Sr.No</th>
												
                                                <th>First Name</th>                                             
                                                <th>Last Name</th>                                             
                                                <th>University</th>                                             
                                                <th>Major </th>                                             
                                                <th>Email</th>
                                                <th>Image</th>
                                                <th>Action</th>
                                              
                                            </tr>
                                        </thead>
                                        <tbody>
										
										@foreach($datas as $key => $data)
                                            <tr>
                                                <td>{{ $key+1 }}</td>												
                                                <td>{{ $data->first_name }}</td>
                                                <td>{{ $data->last_name }}</td>
												<td>{{ $data->email }}</td>
												<td>{{ $data->email }}</td>
												<td>{{ $data->email }}</td>
												<td>{{ $data->email }}</td>
												<td>{{ $data->email }}</td>
                                               
                                                <td> 
                                            <img width="100px" src="{{ URL::asset('/uploads/employees/'.$data->image) }}"/>
										</td>
                                              
                                                <td>  <div class="table-data-feature">
                                                    
                                                    <!--a href="{{ url('/admin/employers/edit/'.$data->id) }}"><button class="item" data-toggle="tooltip" data-placement="top" title="Edit">
                                                        <i class="zmdi zmdi-edit"></i>
                                                    </button></a>&nbsp;&nbsp;-->
                                                    <a onclick="return confirm('Are you sure want to delete it? ');" href="{{ url('/admin/employees/delete/'.$data->id) }}"> <button type="button" class="item" data-toggle="tooltip" data-placement="top"  title="Delete">
                                                        <i class="zmdi zmdi-delete"></i>
                                                    </button></a>
                                                   
                                                </div></td>
                                            </tr>
											
                                         @endforeach
										
                                        </tbody>
                                    </table>
                                </div>
                                <!-- END DATA TABLE-->
                            </div>
                        
                    </div>
                </div>
            </section>
			</div>
               

 @include('admin.includes.footer')   