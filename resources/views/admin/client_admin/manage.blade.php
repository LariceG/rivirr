@include('admin/includes/header')

<div class="page-wrapper">
			<div class="container-fluid">
				
				<!-- Title -->
				<div class="row heading-bg">
					<div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
					  <h5 class="txt-dark">Manage Sites</h5>
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
							<div class="panel-heading">
								<div class="pull-left">
									<h6 class="panel-title txt-dark">Sites</h6>
								</div>
								<div class="clearfix"></div>
							</div>
							<div class="panel-wrapper collapse in">
								<div class="panel-body">
									<div class="table-wrap">
										<div class="table-responsive">
											<table id="datable_1" class="table table-hover display  pb-30" >
												<thead>
												<tr>
                                                  <th>S.no</th>  
																									<th>Supervisor Name</th>
																									<th>Employee Name</th>
																									<th>Site Name</th>
																									<th>Site Location</th>
																									</tr>
																										</thead>
																						
																										<tbody>
																										<?php $a=1 ;?>
                                                    @foreach($sites as $site)
																										<tr>
																										<td>{{$a}}</td>
																										<td>{{ucfirst($site->supervisor_name)}}</td>
                                                    <td>
                                                    {{ucfirst($site->employee_name)}}
																										</td>
																									<td>{{$site->site_name}}</td>
																									<td>{{$site->site_location}}</td>
																									</tr>
																									<?php $a++ ;?>
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
				</div>
				</div>

@include('admin/includes/footer')                    