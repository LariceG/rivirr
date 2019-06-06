    @include('/admin/includes/header')
    <style>
		.mb-1{
			margin-bottom:10px;
		}
		.my-2{
			margin-top:10px;
			margin-bottom:20px;
		}
		</style>
    <!-- Main Content -->
			
		
    <div class="page-wrapper">

            <div class="container-fluid pt-25">
					
				<!-- Row -->
				<div class="row">
				<ol class="breadcrumb">
								<li><a href="{{ url('/admin/dashboard') }}">Dashboard</a></li>
                                <li><a href="{{ url('/admin/'.$active) }}">{{ucfirst($active)}}</a></li>								
						
							</ol>
					<div class="col-lg-3 col-xs-12">
					<div class="panel panel-default card-view  pa-0">
							<div class="panel-wrapper collapse in">
								<div class="panel-body  pa-0">
									<div class="profile-box">
										<div class="profile-cover-pic">
											<!--div class="fileupload btn btn-default">
												<span class="btn-text">edit</span>
												<input class="upload" type="file">
											</div-->
											<div class="profile-image-overlay"></div>
										</div>
										<div class="profile-info text-center">
											<div class="profile-img-wrap">
												<img class="inline-block mb-10" src="{{$user_deatil->image}}" alt="user"/>
												<!--div class="fileupload btn btn-default">
													<span class="btn-text">edit</span>
													<input class="upload" type="file">
												</div-->
											</div>	
											<h5 class="block mt-10 mb-5 weight-500 capitalize-font txt-success">{{$user_deatil->name}}</h5>
											<!--h6 class="block capitalize-font pb-20">Developer Geek</h6-->
										</div>	
										<div class="social-info">
											<div class="row">
												<div class="col-xs-4 text-center">
													<span class="counts block head-font"><span class="counter-anim"></span>{{count($sites)}}</span>
													<span class="counts-text block">Sites</span>
												</div>
												<!--div class="col-xs-4 text-center">
													<span class="counts block head-font"><span class="counter-anim">246</span></span>
													<span class="counts-text block">followers</span>
												</div-->
												<!--div class="col-xs-4 text-center">
													<span class="counts block head-font"><span class="counter-anim">898</span></span>
													<span class="counts-text block">tweets</span>
												</div-->
											</div>
											
												<!-- /.modal-dialog -->
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="col-lg-9 col-xs-12">
						<div class="panel panel-default card-view pa-0">
							<div class="panel-wrapper collapse in">
								<div  class="panel-body pb-0">
									<div  class="tab-struct custom-tab-1">
										<ul role="tablist" class="nav nav-tabs nav-tabs-responsive" id="myTabs_8">
											<li class="active" role="presentation" id="profile"><a  data-toggle="tab" id="profile_tab_8" role="tab" href="#profile_8" aria-expanded="false"><span>profile</span></a></li>

											<li role="presentation" id="sites"><a  data-toggle="tab" id="earning_tab_8" role="tab" href="#earnings_8" aria-expanded="true"><span>Sites</span></a></li>
											<!--li  role="presentation" class="next"><a aria-expanded="true"  data-toggle="tab" role="tab" id="follo_tab_8" href="#follo_8"><span>followers<span class="inline-block">(246)</span></span></a></li-->
											<!--li role="presentation" class=""><a  data-toggle="tab" id="photos_tab_8" role="tab" href="#photos_8" aria-expanded="false"><span>photos</span></a></li-->
											
											<li role="presentation" class=""><a  data-toggle="tab" id="settings_tab_8" role="tab" href="#settings_8" aria-expanded="false"><span>Add Site</span></a></li>
											<!--li class="dropdown" role="presentation">
												<a  data-toggle="dropdown" class="dropdown-toggle" id="myTabDrop_7" href="#" aria-expanded="false"><span>More</span> <span class="caret"></span></a>
												<ul id="myTabDrop_7_contents"  class="dropdown-menu">
													<li class=""><a  data-toggle="tab" id="dropdown_13_tab" role="tab" href="#dropdown_13" aria-expanded="true">About</a></li>
													<li class=""><a  data-toggle="tab" id="dropdown_14_tab" role="tab" href="#dropdown_14" aria-expanded="false">Followings</a></li>
													<li class=""><a  data-toggle="tab" id="dropdown_15_tab" role="tab" href="#dropdown_15" aria-expanded="false">Likes</a></li>
													<li class=""><a  data-toggle="tab" id="dropdown_16_tab" role="tab" href="#dropdown_16" aria-expanded="false">Reviews</a></li>
												</ul>
											</li-->
										</ul>
										<div class="tab-content" id="myTabContent_8">
											<div  id="profile_8" class="tab-pane fade active in" role="tabpanel">
											<div class="col-md-8">
											<h4 class="my-2">Profile Info</h4>
                                        <div class="row mb-1">
                                            <div class="col-md-6">
                                                <label>Name</label>
                                            </div>
                                            <div class="col-md-6">
                                                <p>{{ucfirst($user_deatil->name)}}</p>
                                            </div>
                                        </div>
                                        <div class="row mb-1">
                                            <div class="col-md-6">
                                                <label>Email </label>
                                            </div>
                                            <div class="col-md-6">
                                                <p>{{$user_deatil->email}}</p>
                                            </div>
                                        </div>
                                        <div class="row mb-1">
                                            <div class="col-md-6">
                                                <label>Phone No.</label>
                                            </div>
                                            <div class="col-md-6">
                                                <p>{{$user_deatil->phone}}</p>
                                            </div>
                                        </div>
                                        <div class="row mb-1">
                                            <div class="col-md-6">
                                                <label>Alternate Phone No.</label>
                                            </div>
                                            <div class="col-md-6">
                                                <p>{{$user_deatil->alternate_phone}}</p>
                                            </div>
                                        </div>
                                        <div class="row mb-1">
                                            <div class="col-md-6">
                                                <label>Address</label>
                                            </div>
                                            <div class="col-md-6">
                                                <p>{{$user_deatil->address}}</p>
                                            </div>
                                        </div>
                            </div>
											</div>
											
											<!--div  id="follo_8" class="tab-pane fade" role="tabpanel">
												<div class="row">
													<div class="col-lg-12">
														<div class="followers-wrap">
															<ul class="followers-list-wrap">
																<li class="follow-list">
																	<div class="follo-body">
																		<div class="follo-data">
																			<img class="user-img img-circle"  src="../img/user.png" alt="user"/>
																			<div class="user-data">
																				<span class="name block capitalize-font">Clay Masse</span>
																				<span class="time block truncate txt-grey">No one saves us but ourselves.</span>
																			</div>
																			<button class="btn btn-success pull-right btn-xs fixed-btn">Follow</button>
																			<div class="clearfix"></div>
																		</div>
																		<div class="follo-data">
																			<img class="user-img img-circle"  src="../img/user1.png" alt="user"/>
																			<div class="user-data">
																				<span class="name block capitalize-font">Evie Ono</span>
																				<span class="time block truncate txt-grey">Unity is strength</span>
																			</div>
																			<button class="btn btn-success btn-outline pull-right btn-xs fixed-btn">following</button>
																			<div class="clearfix"></div>
																		</div>
																		<div class="follo-data">
																			<img class="user-img img-circle"  src="../img/user2.png" alt="user"/>
																			<div class="user-data">
																				<span class="name block capitalize-font">Madalyn Rascon</span>
																				<span class="time block truncate txt-grey">Respect yourself if you would have others respect you.</span>
																			</div>
																			<button class="btn btn-success btn-outline pull-right btn-xs fixed-btn">following</button>
																			<div class="clearfix"></div>
																		</div>
																		<div class="follo-data">
																			<img class="user-img img-circle"  src="../img/user3.png" alt="user"/>
																			<div class="user-data">
																				<span class="name block capitalize-font">Mitsuko Heid</span>
																				<span class="time block truncate txt-grey">I’m thankful.</span>
																			</div>
																			<button class="btn btn-success pull-right btn-xs fixed-btn">Follow</button>
																			<div class="clearfix"></div>
																		</div>
																		<div class="follo-data">
																			<img class="user-img img-circle"  src="../img/user.png" alt="user"/>
																			<div class="user-data">
																				<span class="name block capitalize-font">Ezequiel Merideth</span>
																				<span class="time block truncate txt-grey">Patience is bitter.</span>
																			</div>
																			<button class="btn btn-success pull-right btn-xs fixed-btn">Follow</button>
																			<div class="clearfix"></div>
																		</div>
																		<div class="follo-data">
																			<img class="user-img img-circle"  src="../img/user1.png" alt="user"/>
																			<div class="user-data">
																				<span class="name block capitalize-font">Jonnie Metoyer</span>
																				<span class="time block truncate txt-grey">Genius is eternal patience.</span>
																			</div>
																			<button class="btn btn-success btn-outline pull-right btn-xs fixed-btn">following</button>
																			<div class="clearfix"></div>
																		</div>
																	</div>
																</li>
															</ul>
														</div>
													</div>
												</div>
											</div-->
											<!--div  id="photos_8" class="tab-pane fade" role="tabpanel">
												<div class="col-md-12 pb-20">
													<div class="gallery-wrap">
														<div class="portfolio-wrap project-gallery">
															<ul id="portfolio_1" class="portf auto-construct  project-gallery" data-col="4">
																<li  class="item"   data-src="../img/gallery/equal-size/mock1.jpg" data-sub-html="<h6>Bagwati</h6><p>Classic view from Rigwood Jetty on Coniston Water an old archive shot similar to an old post but a little later on.</p>" >
																	<a href="">
																	<img class="img-responsive" src="../img/gallery/equal-size/mock1.jpg"  alt="Image description" />
																	<span class="hover-cap">Bagwati</span>
																	</a>
																</li>
																<li class="item" data-src="../img/gallery/equal-size/mock2.jpg"   data-sub-html="<h6>Not a Keyboard</h6><p>Classic view from Rigwood Jetty on Coniston Water an old archive shot similar to an old post but a little later on.</p>">
																	<a href="">
																	<img class="img-responsive" src="../img/gallery/equal-size/mock2.jpg"  alt="Image description" />
																	<span class="hover-cap">Not a Keyboard</span>
																	</a>
																</li>
																<li class="item" data-src="../img/gallery/equal-size/mock3.jpg" data-sub-html="<h6>Into the Woods</h6><p>Classic view from Rigwood Jetty on Coniston Water an old archive shot similar to an old post but a little later on.</p>">
																	<a href="">
																	<img class="img-responsive" src="../img/gallery/equal-size/mock3.jpg"  alt="Image description" />
																	<span class="hover-cap">Into the Woods</span>
																	</a>
																</li>
																<li class="item" data-src="../img/gallery/equal-size/mock4.jpg"  data-sub-html="<h6>Ultra Saffire</h6><p>Classic view from Rigwood Jetty on Coniston Water an old archive shot similar to an old post but a little later on.</p>">
																	<a href="">
																	<img class="img-responsive" src="../img/gallery/equal-size/mock4.jpg"  alt="Image description" />
																	<span class="hover-cap"> Ultra Saffire</span>
																	</a>
																</li>
																
																<li class="item" data-src="../img/gallery/equal-size/mock5.jpg" data-sub-html="<h6>Happy Puppy</h6><p>Classic view from Rigwood Jetty on Coniston Water an old archive shot similar to an old post but a little later on.</p>">
																	<a href="">
																	<img class="img-responsive" src="../img/gallery/equal-size/mock5.jpg"  alt="Image description" />	
																	<span class="hover-cap">Happy Puppy</span>
																	</a>
																</li>
																<li class="item" data-src="../img/gallery/equal-size/mock6.jpg"  data-sub-html="<h6>Wooden Closet</h6><p>Classic view from Rigwood Jetty on Coniston Water an old archive shot similar to an old post but a little later on.</p>">
																	<a href="">
																	<img class="img-responsive" src="../img/gallery/equal-size/mock6.jpg"  alt="Image description" />
																	<span class="hover-cap">Wooden Closet</span>
																	</a>
																</li>
																<li class="item" data-src="../img/gallery/equal-size/mock7.jpg" data-sub-html="<h6>Happy Puppy</h6><p>Classic view from Rigwood Jetty on Coniston Water an old archive shot similar to an old post but a little later on.</p>">
																	<a href="">
																	<img class="img-responsive" src="../img/gallery/equal-size/mock7.jpg"  alt="Image description" />	
																	<span class="hover-cap">Happy Puppy</span>
																	</a>
																</li>
																<li class="item" data-src="../img/gallery/equal-size/mock8.jpg"  data-sub-html="<h6>Wooden Closet</h6><p>Classic view from Rigwood Jetty on Coniston Water an old archive shot similar to an old post but a little later on.</p>">
																	<a href="">
																	<img class="img-responsive" src="../img/gallery/equal-size/mock8.jpg"  alt="Image description" />
																	<span class="hover-cap">Wooden Closet</span>
																	</a>
																</li>
															</ul>
														</div>
													</div>
												</div>	
											</div-->
											<div  id="earnings_8" class="tab-pane fade " role="tabpanel">
												<!-- Row -->
												<div class="row">
													<div class="col-lg-12">
														<form id="example-advanced-form" action="#">
															<div class="table-wrap">
																<div class="table-responsive">
																	<table class="table table-striped display product-overview" id="datable_1">
																		<thead>
																			<tr>
																				<th>Site Name</th>
																				<th>Supervisor Name</th>
																				<th>Employee Name</th>
																				<th>Site Location</th>
																				<th>Action</th>
																				
																			</tr>
																		</thead>
																		<!--tfoot>
																			<tr>
																				<th colspan="2">total:</th>
																				<th></th>
																			</tr>
																		</tfoot-->
																		<tbody>
																		@foreach($sites as $site)
																		
																			<tr>
																				<td>{{$site->site_name}}</td>
																				<td>{{$site->supervisor_name}}</td>
																				<td>{{$site->employee_name}}</td>
																	      <td>{{$site->site_location}}</td>
																				<td>
																				<!--a href="{{ url('/admin/client/site/edit/'.Request::segment(4).'/'.$site->id)}}"><i class="fa fa-pencil"></i></a-->

															<button type="button" class="btn btn-success btn-block  btn-anim mt-30" onclick="modelShow('{{$site->id}}')"> <i class="fa fa-pencil"></i><span class="btn-text">Edit</span></button>

															<button type="button" onclick="deleteRow('{{ url('/admin/client/site/delete/'.$site->id) }}')" class="btn btn-danger mt-2 btn-block" data-toggle="tooltip" data-placement="top"  title="Delete">
                                                        Delete
                                                    </button></a>						
													  																
																				</td>
																			</tr>
																			@endforeach
																		</tbody>
																	</table>
																</div>
															</div>
														</form>
													</div>
												</div>
											</div>
											<div  id="settings_8" class="tab-pane fade" role="tabpanel">
												<!-- Row -->
												<div class="row">
													<div class="col-lg-12">
														<div class="">
															<div class="panel-wrapper collapse in">
																<div class="panel-body pa-0">
																	<div class="col-sm-12 col-xs-12">
																		<div class="form-wrap">
																		<form action="{{ url('/admin/client/insert_sites/'.Request::segment(4)) }}" method="post" enctype="multipart/form-data" data-toggle="validator" role="form">
																				<div class="form-body overflow-hide">
																				
																					<div class="form-group">
													<label class="control-label mb-10">Select Supervisor</label>
													<select class="form-control select2" onchange="getAddEmployees('{{ url('/admin/clients/getEmployees/') }}')" name="supervisor_id" id="supervisor_id" required>
														<option value="">Select Supervisor</option>
														@foreach($supervisors as $key => $supervisor)
														<option value="{{$supervisor->id}}">{{$supervisor->name}}</option>
														@endforeach
													</select>
													<div class="help-block with-errors"></div>
											</div>
											<div id="error">
											
											 </div>
											<div class="form-group">
										
												<label class="control-label mb-10">Select Employee</label>
													<select class="form-control select2" id="employeeID" name="employee_id" required  onchange="validation()">
														<option value="">Select Employee</option>
													</select>
													<div class="help-block with-errors"></div>
											</div>
											<div class="form-group">
										
												<label class="control-label mb-10">Select Shift</label>
													<select class="form-control select2" id="shift" name="shift" required  onchange="validation()">
														<option value="">Select Shift</option>
														<option value="morning">Morning</option>
														<option value="evening">Evening</option>
														<option value="night">Night</option>
													</select>
													<div class="help-block with-errors"></div>
											</div>
											<div class="form-group">
                                               
										 <label for="email" class=" form-control-label">Site Name</label>
										<input type="text" required  id="site_name"  name="site_name" placeholder="Enter Client Email"  class="form-control" >
										<div class="help-block with-errors"></div>
										</div>

										<div class="form-group">
                                                 
                                                    <label for="password" class=" form-control-label">Site Location</label>
                                                    <input type="text" required id="site_location"  name="site_location" placeholder="Enter Client Password"  class="form-control" >
                                                    <div class="help-block with-errors"></div>
                                                </div>
																								<input type="hidden" name="_token" id="csrf-token" value="{{ Session::token() }}" />
														<div class="form-group mb-0">
															<button type="button" class="btn btn-success btn-anim" onclick="validation()" id="bttn"><i class="icon-rocket"></i><span class="btn-text">submit</span></button>
														</div>
														</div>	
																				</div>
																						
																			</form>
																		</div>
																	</div>
																</div>
															</div>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>






					
						
							
					</div>
				</div>
				<!-- /Row -->
				
				<!-- Row -->
				<!--div class="row">
					<div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
								<div class="panel panel-default border-panel card-view">
									<div class="panel-heading">
										<div class="pull-left">
											<h6 class="panel-title pull-left">users</h6>
										</div>
										<div class="pull-right">
											<a href="#" class="pull-left inline-block mr-15">
												<i class="zmdi zmdi-search"></i>
											</a>
											<a class="pull-left inline-block" href="#" data-effect="fadeOut">
												<i class="zmdi zmdi-plus"></i>
											</a>
										</div>
										<div class="clearfix"></div>
									</div>
									<div class="panel-wrapper collapse in">
										<div class="panel-body row pa-0">
											<div class="chat-cmplt-wrap chat-for-widgets">
												<div class="chat-box-wrap">
													<div>
														<div class="users-nicescroll-bar">
															<ul class="chat-list-wrap">
																<li class="chat-list">
																	<div class="chat-body">
																		<a href="javascript:void(0)">
																			<div class="chat-data">
																				<img class="user-img img-circle"  src="../img/user.png" alt="user"/>
																				<div class="user-data">
																					<span class="name block capitalize-font">Clay Masse</span>
																					<span class="time block truncate txt-grey">No one saves us but ourselves.</span>
																				</div>
																				<div class="status away"></div>
																				<div class="clearfix"></div>
																			</div>
																		</a>
																		<a href="javascript:void(0)">
																			<div class="chat-data">
																				<img class="user-img img-circle"  src="../img/user1.png" alt="user"/>
																				<div class="user-data">
																					<span class="name block capitalize-font">Evie Ono</span>
																					<span class="time block truncate txt-grey">Unity is strength</span>
																				</div>
																				<div class="status offline"></div>
																				<div class="clearfix"></div>
																			</div>
																		</a>
																		<a href="javascript:void(0)">
																			<div class="chat-data">
																				<img class="user-img img-circle"  src="../img/user2.png" alt="user"/>
																				<div class="user-data">
																					<span class="name block capitalize-font">Madalyn Rascon</span>
																					<span class="time block truncate txt-grey">Respect yourself if you would have others respect you.</span>
																				</div>
																				<div class="status online"></div>
																				<div class="clearfix"></div>
																			</div>
																		</a>
																		<a href="javascript:void(0)">
																			<div class="chat-data">
																				<img class="user-img img-circle"  src="../img/user3.png" alt="user"/>
																				<div class="user-data">
																					<span class="name block capitalize-font">Mitsuko Heid</span>
																					<span class="time block truncate txt-grey">I’m thankful.</span>
																				</div>
																				<div class="status online"></div>
																				<div class="clearfix"></div>
																			</div>
																		</a>
																		<a href="javascript:void(0)">
																			<div class="chat-data">
																				<img class="user-img img-circle"  src="../img/user.png" alt="user"/>
																				<div class="user-data">
																					<span class="name block capitalize-font">Ezequiel Merideth</span>
																					<span class="time block truncate txt-grey">Patience is bitter.</span>
																				</div>
																				<div class="status offline"></div>
																				<div class="clearfix"></div>
																			</div>
																		</a>
																		<a href="javascript:void(0)">
																			<div class="chat-data">
																				<img class="user-img img-circle"  src="../img/user1.png" alt="user"/>
																				<div class="user-data">
																					<span class="name block capitalize-font">Jonnie Metoyer</span>
																					<span class="time block truncate txt-grey">Genius is eternal patience.</span>
																				</div>
																				<div class="status online"></div>
																				<div class="clearfix"></div>
																			</div>
																		</a>
																		<a href="javascript:void(0)">
																			<div class="chat-data">
																				<img class="user-img img-circle"  src="../img/user2.png" alt="user"/>
																				<div class="user-data">
																					<span class="name block capitalize-font">Angelic Lauver</span>
																					<span class="time block truncate txt-grey">Every burden is a blessing.</span>
																				</div>
																				<div class="status away"></div>
																				<div class="clearfix"></div>
																			</div>
																		</a>
																		<a href="javascript:void(0)">
																			<div class="chat-data">
																				<img class="user-img img-circle"  src="../img/user3.png" alt="user"/>
																				<div class="user-data">
																					<span class="name block capitalize-font">Priscila Shy</span>
																					<span class="time block truncate txt-grey">Wise to resolve, and patient to perform.</span>
																				</div>
																				<div class="status online"></div>
																				<div class="clearfix"></div>
																			</div>
																		</a>
																		<a href="javascript:void(0)">
																			<div class="chat-data">
																				<img class="user-img img-circle"  src="../img/user4.png" alt="user"/>
																				<div class="user-data">
																					<span class="name block capitalize-font">Linda Stack</span>
																					<span class="time block truncate txt-grey">Our patience will achieve more than our force.</span>
																				</div>
																				<div class="status away"></div>
																				<div class="clearfix"></div>
																			</div>
																		</a>
																	</div>
																</li>
															</ul>
														</div>
													</div>
												</div>
												<div class="recent-chat-box-wrap">
													<div class="recent-chat-wrap">
														<div class="panel-heading ma-0 pt-15">
															<div class="goto-back">
																<a  id="goto_back_widget" href="javascript:void(0)" class="inline-block txt-grey">
																	<i class="zmdi zmdi-chevron-left"></i>
																</a>	
																<span class="inline-block txt-dark">ryan</span>
																<a href="javascript:void(0)" class="inline-block text-right txt-grey"><i class="zmdi zmdi-more"></i></a>
																<div class="clearfix"></div>
															</div>
														</div>
														<div class="panel-wrapper collapse in">
															<div class="panel-body pa-0">
																<div class="chat-content">
																	<ul class="users-chat-nicescroll-bar pt-20">
																		<li class="friend">
																			<div class="friend-msg-wrap">
																				<img class="user-img img-circle block pull-left"  src="../img/user.png" alt="user"/>
																				<div class="msg pull-left">
																					<p>Hello Jason, how are you, it's been a long time since we last met?</p>
																					<div class="msg-per-detail text-right">
																						<span class="msg-time txt-grey">2:30 PM</span>
																					</div>
																				</div>
																				<div class="clearfix"></div>
																			</div>	
																		</li>
																		<li class="self mb-10">
																			<div class="self-msg-wrap">
																				<div class="msg block pull-right"> Oh, hi Sarah I'm have got a new job now and is going great.
																					<div class="msg-per-detail text-right">
																						<span class="msg-time txt-grey">2:31 pm</span>
																					</div>
																				</div>
																				<div class="clearfix"></div>
																			</div>	
																		</li>
																		<li class="self">
																			<div class="self-msg-wrap">
																				<div class="msg block pull-right">  How about you?
																					<div class="msg-per-detail text-right">
																						<span class="msg-time txt-grey">2:31 pm</span>
																					</div>
																				</div>
																				<div class="clearfix"></div>
																			</div>	
																		</li>
																		<li class="friend">
																			<div class="friend-msg-wrap">
																				<img class="user-img img-circle block pull-left"  src="../img/user.png" alt="user"/>
																				<div class="msg pull-left"> 
																					<p>Not too bad.</p>
																					<div class="msg-per-detail  text-right">
																						<span class="msg-time txt-grey">2:35 pm</span>
																					</div>
																				</div>
																				<div class="clearfix"></div>
																			</div>	
																		</li>
																	</ul>
																</div>
																<div class="input-group">
																	<input type="text" id="input_msg_send_widget" name="send-msg" class="input-msg-send form-control" placeholder="Type something">
																	<div class="input-group-btn emojis">
																		<div class="dropup">
																			<button type="button" class="btn  btn-default  dropdown-toggle" data-toggle="dropdown" ><i class="zmdi zmdi-mood"></i></button>
																			<ul class="dropdown-menu dropdown-menu-right">
																				<li><a href="javascript:void(0)">Action</a></li>
																				<li><a href="javascript:void(0)">Another action</a></li>
																				<li class="divider"></li>
																				<li><a href="javascript:void(0)">Separated link</a></li>
																			</ul>
																		</div>
																	</div>
																	<div class="input-group-btn attachment">
																		<div class="fileupload btn  btn-default"><i class="zmdi zmdi-attachment-alt"></i>
																			<input type="file" class="upload">
																		</div>
																	</div>
																</div>
															</div>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
					<!--div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
						<div class="panel panel-default border-panel card-view">
							<div class="panel-heading">
								<div class="pull-left">
									<h6 class="panel-title txt-dark">todo</h6>
								</div>
								<div class="pull-right">
									<div class="pull-left inline-block dropdown mr-15">
										<a class="dropdown-toggle" data-toggle="dropdown" href="#" aria-expanded="false" role="button"><i class="zmdi zmdi-more-vert"></i></a>
										<ul class="dropdown-menu bullet dropdown-menu-right"  role="menu">
											<li role="presentation"><a href="javascript:void(0)" role="menuitem"><i class="icon wb-reply" aria-hidden="true"></i>Edit</a></li>
											<li role="presentation"><a href="javascript:void(0)" role="menuitem"><i class="icon wb-share" aria-hidden="true"></i>Clear All</a></li>
											<li role="presentation"><a href="javascript:void(0)" role="menuitem"><i class="icon wb-trash" aria-hidden="true"></i>Select All</a></li>
										</ul>
									</div>
									<a class="pull-left inline-block close-panel" href="#" data-effect="fadeOut">
										<i class="zmdi zmdi-close"></i>
									</a>
								</div>
								<div class="clearfix"></div>
							</div>
							<div class="panel-wrapper collapse in">
								<div class="panel-body row pa-0">
									<div class="todo-box-wrap">
										<!-- Todo-List -->
										<!--ul class="todo-list todo-box-nicescroll-bar">
											<li class="todo-item">
												<div class="checkbox checkbox-default">
													<input type="checkbox" id="checkbox001"/>
													<label for="checkbox001">Record The First Episode</label>
												</div>
											</li>
											<li>
												<hr class="light-grey-hr"/>
											</li>
											<li class="todo-item">
												<div class="checkbox checkbox-pink">
													<input type="checkbox" id="checkbox002"/>
													<label for="checkbox002">Prepare The Conference Schedule</label>
												</div>
											</li>
											<li>
												<hr class="light-grey-hr"/>
											</li>
											<li class="todo-item">
												<div class="checkbox checkbox-warning">
													<input type="checkbox" id="checkbox003" checked/>
													<label for="checkbox003">Decide The Live Discussion Time</label>
												</div>
											</li>
											<li>
												<hr class="light-grey-hr"/>
											</li>
											<li class="todo-item">
												<div class="checkbox checkbox-success">
													<input type="checkbox" id="checkbox004" checked/>
													<label for="checkbox004">Prepare For The Next Project</label>
												</div>
											</li>
											<li>
												<hr class="light-grey-hr"/>
											</li>
											<li class="todo-item">
												<div class="checkbox checkbox-danger">
													<input type="checkbox" id="checkbox005" checked/>
													<label for="checkbox005">Finish Up AngularJs Tutorial</label>
												</div>
											</li>
											<li>
												<hr class="light-grey-hr"/>
											</li>
											<li class="todo-item">
												<div class="checkbox checkbox-purple">
													<input type="checkbox" id="checkbox006" checked/>
													<label for="checkbox006">Finish Infinity Project</label>
												</div>
											</li>
											<li>
												<hr class="light-grey-hr"/>
											</li>
										</ul>
										<!-- /Todo-List -->
										
										<!-- New Todo -->
										<!--div class="new-todo">
											<div class="input-group">
												<input type="text" id="add_todo" name="example-input2-group2" class="form-control" placeholder="Add new task">
												<span class="input-group-btn">
												<button type="button" class="btn btn-success"><i class="zmdi zmdi-plus txt-success"></i></button>
												</span> 
											</div>
										</div>
										<!-- /New Todo -->
									<!--/div>
								</div>
							</div>
						</div>
					</div-->
					<!--div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
						<div class="panel panel-default card-view">
							<div class="panel-wrapper collapse in">
								<div class="panel-body">
									<div class="calendar-wrap">
									  <div id="calendar_small" class="small-calendar"></div>
									</div>
								</div>
							</div>
						</div>	
					</div>
					<div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
						<div class="panel panel-default card-view bg-twitter">
							<div class="panel-wrapper collapse in">
								<div  class="panel-body">
									<div class="twitter-icon-wrap text-center mb-15">
										<i class="fa fa-twitter"></i>
									</div>
									<!-- START carousel-->
									<!--div id="twitter_slider" data-ride="carousel" class="carousel slide twitter-slider-wrap text-slider">
										<ol class="carousel-indicators">
										   <li data-target="#twitter_slider" data-slide-to="0" class="active"></li>
										   <li data-target="#twitter_slider" data-slide-to="1"></li>
										</ol>
										<div id="tweets_fetch" role="listbox" class="carousel-inner mb-50">
										</div>
									</div>
									<!-- END carousel-->
								<!---/div>
							</div>
						</div>
							<div class="panel panel-default card-view">
							<div class="panel-heading">
								<div class="pull-left">
									<h6 class="panel-title txt-dark">Madalyn Rascon</h6>
								</div>
								<div class="clearfix"></div>
							</div>
							<div class="panel-wrapper collapse in">
								<div  class="panel-body row pa-0">
									<!--Instagram-->
									<!--ul class="instagram-lite"></ul>
									<!--/Instagram-->
								<!--/div>
							</div>
						</div>
					</div>
				</div>
				<!-- /Row -->
			
			<!--/div>
			<!-- Footer -->
			<!--footer class="footer container-fluid pl-30 pr-30">
				<div class="row">
					<div class="col-sm-12">
						<p>2018 &copy; Droopy. Pampered by Hencework</p> 
					</div>
				</div>
			</footer>
			<!-- /Footer -->
			
		</div>
		<div id="myModal" class="modal fade in" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
										
		</div>
        <!-- /Main Content -->
        @include('/admin/includes/footer')