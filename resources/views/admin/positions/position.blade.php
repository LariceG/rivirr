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
                                    <a href="{{ url('/positions/add')}}"><button class="btn  btn-success float-right" style="
    float: right;
">Add Position</button></a>
									<div class="clearfix"></div>
									@if(Session::has('success'))
									<div class="alert alert-success">
								    {{Session::get('success')}}
									</div>
								   @endif
                                   @if(Session::has('danger'))
									<div class="alert alert-danger text-center"> 
								     {{Session::get('danger')}}
									 </div>
							       @endif
						

										<div class="table-responsive">
											<table id="example" class="table table-hover display  pb-30" >
                                            <thead>
                                            <tr>
												<th>Sr.No</th>
											   <th>Name</th>
											   <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
										
										<?php
                                         $i=1;
                                        ?>
										@foreach($positions as $position)
                                            <tr>
												<td>{{$i}}</td>
                                                <td>{{$position->name}}</td>
																						
                                                
												<td>  <div class="table-data-feature">
                                                    
                                                    <a href="{{ url('/positions/edit').'/'.$position->id }}"><button class="btn btn-primary" data-toggle="tooltip" data-placement="top" title="Edit">
                                                        Edit
													</button></a>
													
													&nbsp;&nbsp;
                                                   <a href="{{url('/positions/delete').'/'.$position->id}}"><button type="button" class="btn btn-danger" data-toggle="tooltip" data-placement="top"  title="Delete">
                                                        Delete
                                                    </button></a>
												
                                                </div></td>
												
                                            </tr>
                                              <?php 
                                               $i++;
                                               ?>
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