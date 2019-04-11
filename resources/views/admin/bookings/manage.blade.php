@include('admin.includes.header')
<!-- MAIN CONTENT-->
            <div class="main-content">
                <div class="section__content section__content--p30">
                    <div class="container-fluid">
                         <div class="row">
                            <div class="col-md-12">
                                <div class="overview-wrap">
                                    <h2 class="title-1">Manage Bookings</h2>
                                  
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
                                                <th>Ticket No</th>
                                                <th>Valet</th>
                                                <th>Client</th>
                                                <th>Car Brand</th>
                                                <th>Car Color</th>
                                                <th>Job Status</th>
                                                <!--<th>Action</th>-->
                                              
                                            </tr>
                                        </thead>
                                        <tbody>
										
										@foreach($datas as $key => $data)
                                            <tr>
                                                <td>{{ $key+1 }}</td>
												<td>{{ $data->ticketno }}</td>
                                                <td>{{ $data->name }}</td>
                                                <td>{{ $data->first_name }}</td>
                                                <td>{{ $data->brand }}</td>
                                                <td>{{ $data->color }}</td>
                                                <td><?php if($data->status == '4'){ ?><button type="button" disabled class="btn btn-success">completed</button> <?php }else{ //if($data->status == '0') ?><button type="button" disabled class="btn btn-primary">pending</button> <?php } ?></td>
                                             
                                                <!--<td>  <div class="table-data-feature">
                                                    
                                                    <a href="{{ url('/admin/valets/edit/'.$data->id) }}"><button class="item" data-toggle="tooltip" data-placement="top" title="Edit">
                                                        <i class="zmdi zmdi-edit"></i>
                                                    </button></a>
                                                    <a onclick="return confirm('Are you sure want to delete it? ');" href="{{ url('/admin/valets/delete/'.$data->id) }}"> <button type="button" class="item"  title="Delete">
                                                        <i class="zmdi zmdi-delete"></i>
                                                    </button></a>
                                                   
                                                </div></td>-->
                                            </tr>
											
                                         @endforeach;
										
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