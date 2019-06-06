<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />

	<title>Secuity App | Admin Panel</title>

	
	<!-- Favicon>
	<link rel="shortcut icon" href="favicon.ico">
	<link rel="icon" href="favicon.ico" type="image/x-icon">
    <link rel="alternate" type="application/rss+xml" title="RSS 2.0" href="http://www.datatables.net/rss.xml" -->
	<!-- Data table CSS -->
	<link href="{{ URL::asset('vendors/bower_components/datatables/media/css/jquery.dataTables.min.css') }}" rel="stylesheet" type="text/css"/>
	<link href="{{ URL::asset('vendors/bower_components/mjolnic-bootstrap-colorpicker/dist/css/bootstrap-colorpicker.min.css') }}" rel="stylesheet" type="text/css"/>
		
		<!-- select2 CSS -->
		<link href="{{ URL::asset('vendors/bower_components/select2/dist/css/select2.min.css') }}" rel="stylesheet" type="text/css"/>

		<link href="{{ URL::asset('vendors/bower_components/switchery/dist/switchery.min.css') }}" rel="stylesheet" type="text/css"/>

	<link href="{{ URL::asset('vendors/bower_components/bootstrap-select/dist/css/bootstrap-select.min.css') }}" rel="stylesheet" type="text/css"/>
		
		<!-- bootstrap-tagsinput CSS -->
		<link href="{{ URL::asset('vendors/bower_components/bootstrap-tagsinput/dist/bootstrap-tagsinput.css') }}" rel="stylesheet" type="text/css"/>
		
		<!-- bootstrap-touchspin CSS -->
		<link href="{{ URL::asset('vendors/bower_components/bootstrap-touchspin/dist/jquery.bootstrap-touchspin.min.css') }}" rel="stylesheet" type="text/css"/>
		
		<!-- multi-select CSS -->
		<link href="{{ URL::asset('vendors/bower_components/multiselect/css/multi-select.css') }}" rel="stylesheet" type="text/css"/>
	<!-- Toast CSS -->
	<link href="{{ URL::asset('vendors/bower_components/jquery-toast-plugin/dist/jquery.toast.min.css') }}" rel="stylesheet" type="text/css">
	
    <link href="{{ URL::asset('vendors/bower_components/switchery/dist/switchery.min.css') }}" rel="stylesheet" type="text/css"/>

	<link href="{{ URL::asset('vendors/bower_components/bootstrap-switch/dist/css/bootstrap3/bootstrap-switch.min.css') }}" rel="stylesheet" type="text/css"/>
	<!-- Custom CSS -->
	<link href="{{ URL::asset('vendors/bower_components/sweetalert/dist/sweetalert.css') }}" rel="stylesheet" type="text/css">
	<link href="{{ URL::asset('vendors/bower_components/dropify/dist/css/dropify.min.css') }}" rel="stylesheet" type="text/css"/>
	<link href="{{ URL::asset('dist/css/style.css') }}" rel="stylesheet" type="text/css">
	<style>
	.top-nav-icon-badge {
    background: #8BC34A;
    border-radius: 50%;
    color: #fff;
    font-size: 10px;
    height: 16px;
    line-height: 16px;
    position: absolute;
    right: 0;
    text-align: center;
    top: 16px;
    width: 16px;
}
	</style>
</head>

<body>

	<!-- Preloader -->
	<div class="preloader-it">
		<div class="la-anim-1"></div>
	</div>
	<!-- /Preloader -->
    <div class="wrapper box-layout theme-1-active pimary-color-green">
		<!-- Top Menu Items -->
		<nav class="navbar navbar-inverse navbar-fixed-top">
			<div class="mobile-only-brand pull-left">
				<div class="nav-header pull-left">
					<div class="logo-wrap">
						<a href="{{ url('/admin/dashboard') }}">
							<img class="brand-img" src="{{ URL::asset('img/logo.png') }}" alt="brand"/>
							<span class="brand-text">Security App</span>
						</a>
					</div>
				</div>	
				<a id="toggle_nav_btn" class="toggle-left-nav-btn inline-block ml-20 pull-left" href="javascript:void(0);"><i class="zmdi zmdi-menu"></i></a>
				<a id="toggle_mobile_search" data-toggle="collapse" data-target="#search_form" class="mobile-only-view" href="javascript:void(0);"><i class="zmdi zmdi-search"></i></a>
				<a id="toggle_mobile_nav" class="mobile-only-view" href="javascript:void(0);"><i class="zmdi zmdi-more"></i></a>
				<form id="search_form" role="search" class="top-nav-search collapse pull-left">
					<div class="input-group">
						<input type="text" name="example-input1-group2" class="form-control" placeholder="Search">
						<span class="input-group-btn">
						<button type="button" class="btn  btn-default"  data-target="#search_form" data-toggle="collapse" aria-label="Close" aria-expanded="true"><i class="zmdi zmdi-search"></i></button>
						</span>
					</div>
				</form>
			</div>
			<div id="mobile_only_nav" class="mobile-only-nav pull-right">
				<ul class="nav navbar-right top-nav pull-right">
				<?php
				    $employee_info =  \App\User::where(['id'=>Session::get('admin_id')])->first(); 
				if(Session::get('user_type') == 'supervisor' || Session::get('user_type') == 'employee' || Session::get('user_type') =='admin')
				{
				$admin_id = Session::get('admin_id');
				if(Session::get('user_type') == 'supervisor')
				{
					$employees  = \App\User::leftJoin('inbox','inbox.sender_id', '=', 'users.id')->select('users.*','inbox.message')->orderBy('inbox.created_at','DESC')->where(['supervisor_id'=>Session::get('admin_id'),'user_type' => 'employee'])->Orwhere(['users.user_type'=>'admin'])->groupBy('users.id')->get();
				}
				elseif(Session::get('user_type') == 'employee')
				{
					
					$employees  = \App\User::leftJoin('inbox','inbox.sender_id', '=', 'users.id')->select('users.*','inbox.message')->orderBy('inbox.created_at','DESC')->where(['users.id'=>$employee_info->supervisor_id])->Orwhere(['users.user_type'=>'admin'])->groupBy('users.id')->get();
				}
				elseif(Session::get('user_type') == 'admin')
				{
					
					$employees  = \App\User::where('user_type','!=' ,'admin')->get();
					 
				}
				$chatCount  = \App\Inbox::select('inbox.id')->where(['sender_id'=>Session::get('admin_id'),'read_status'=>'0'])->orWhere(function($q)use ($admin_id) {
					$q->where(['receiver_id' => Session::get('admin_id'),'read_status'=>'0']);
				})->count();
				?>
					<li>
						<a id="open_right_sidebar"  onClick="getChat('{{url('/admin/supervisors/updateChatNotification')}}')" href="javascript:void(0)"><i class="zmdi zmdi-comment-outline top-nav-icon"></i></a>@if($chatCount >0)<span class="top-nav-icon-badge">{{$chatCount}}</span>@endif</a>
					</li>
				<?php } ?>
				<?php if(Session::get('user_type') != 'client'){ ?>
					<li class="dropdown app-drp">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="zmdi zmdi-apps top-nav-icon"></i></a>
						<ul class="dropdown-menu app-dropdown" data-dropdown-in="slideInRight" data-dropdown-out="flipOutX">
							<li>
								<div class="app-nicescroll-bar">
									<ul class="app-icon-wrap pa-10">
									<li>
                                     @if(Session::get('user_type') != 'employee')
										<li>
											<a href="{{ url('/admin/employees') }}" class="connection-item">
											<i class="glyphicon glyphicon-user txt-info"></i>
											<span class="block">Employees</span>
											</a>
										</li>
										@endif
										<li>
											<a href="{{ url('/admin/clients') }}" class="connection-item">
											<i class="glyphicon glyphicon-user txt-success"></i>
											<span class="block">Clients</span>
											</a>
										</li>
										<li>
											<a href="{{ url('/admin/reports') }}" class="connection-item">
											<i class="fa fa-file-text-o txt-primary"></i>
											<span class="block">Reports</span>
											</a>
										</li>
										@if(Session::get('user_type') == 'supervisor')
										<li>
											<a href="{{ url('/admin/leaves') }}" class="connection-item">
											<i class="fa fa-sign-out txt-danger"></i>
											<span class="block">Leaves</span>
											</a>
										</li>
										@endif
										
										<li>
											<a href="javascript:void(0)" class="connection-item">
											<i class="zmdi zmdi-comment-outline txt-warning"></i>
											<span class="block">chat</span>
											</a>
										</li>
										<li>
											<a href="javascript:void(0)" class="connection-item">
											<i class="zmdi zmdi-assignment-account"></i>
											<span class="block">contact</span>
											</a>
										</li>
									</ul>
								</div>	
							</li>
							<li>
								<div class="app-box-bottom-wrap">
									<hr class="light-grey-hr ma-0"/>
									<a class="block text-center read-all" href="javascript:void(0)"> more </a>
								</div>
							</li>
						</ul>
					</li>
				<?php } ?>
				<?php if(Session::get('user_type') == 'supervisor'){
					$notifications  = \App\UserLeaves::where(['supervisor_id'=>Session::get('admin_id'),'read_status'=>'0'])->get();
					?>
					<li class="dropdown alert-drp">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="zmdi zmdi-notifications top-nav-icon"></i>@if(count($notifications) >0)<span class="top-nav-icon-badge">{{count($notifications)}}</span>@endif</a>
						<ul  class="dropdown-menu alert-dropdown" data-dropdown-in="bounceIn" data-dropdown-out="bounceOut">
							<li>
								<div class="notification-box-head-wrap">
									<span class="notification-box-head pull-left inline-block">notifications</span>
									<a class="txt-danger pull-right clear-notifications inline-block" href="javascript:void(0)"> clear all </a>
									<div class="clearfix"></div>
									<hr class="light-grey-hr ma-0"/>
								</div>
							</li>
							<li>
							
								<div class="streamline message-nicescroll-bar">
								@if(count($notifications) >0)
								@foreach($notifications as $notification)
								<?php $userDet  = \App\User::where(['id'=>$notification->user_id])->first();
								 ?>
									<div class="sl-item">
										<a href="{{ url('/admin/leaves') }}">
											<div class="icon bg-green">
												<img src="{{$userDet->image}}" width="50px" height="50px" alt="" class="src">
											</div>
											<div class="sl-content">
												<span class="inline-block capitalize-font  pull-left truncate head-notifications">
												{{$userDet->name}} send you request for leave </span>
												<!--span class="inline-block font-11  pull-right notifications-time">2pm</span-->
												<div class="clearfix"></div>
												<p class="truncate">{{$notification->message}}.</p>
											</div>
										</a>	
									</div>
									<hr class="light-grey-hr ma-0"/>
									@endforeach									
									@else
									<div class="sl-item">
										No notification found yet
									</div>
									@endif
								</div>
								
							</li>
							@if(count($notifications) >0)
							<li>

								<div class="notification-box-bottom-wrap">
									<hr class="light-grey-hr ma-0"/>
									<a class="block text-center read-all" href="{{ url('/admin/leaves') }}"> read all </a>
									<div class="clearfix"></div>
								</div>
							</li>
							@endif
						</ul>
					</li>
				<?php }
				 elseif(Session::get('user_type') == 'employee')
				 {
					$employeeData = \App\User::where(['id'=>Session::get('admin_id')])->first();
					$dateOfBirth = $employeeData->date_of_birth;
					$birth_date = date("d", strtotime($dateOfBirth));
					$birth_month = date("m", strtotime($dateOfBirth));
					$notifications = 0;
					
					if($birth_date == date("d") && $birth_month == date("m") )
					{
						$notifications++;	
						$massage ="Wish you a very happy birthday dear ".$employeeData->name ;

						
					?>
                  
				  <li class="dropdown alert-drp">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="zmdi zmdi-notifications top-nav-icon"></i>@if(count($notifications) >0)<span class="top-nav-icon-badge">{{count($notifications)}}</span>@endif</a>
						<ul  class="dropdown-menu alert-dropdown" data-dropdown-in="bounceIn" data-dropdown-out="bounceOut">
							<li>
								<div class="notification-box-head-wrap">
									<span class="notification-box-head pull-left inline-block">notifications</span>
									<a class="txt-danger pull-right clear-notifications inline-block" href="javascript:void(0)"> clear all </a>
									<div class="clearfix"></div>
									<hr class="light-grey-hr ma-0"/>
								</div>
							</li>
							<li>
							
								<div class="streamline message-nicescroll-bar">
								@if(count($notifications) >0)
						
								
									<div class="sl-item">
										<a href="{{ url('/admin/leaves') }}">
											<div class="icon bg-green">
												<img src="{{$employeeData->image}}" width="50px" height="50px" alt="" class="src">
											</div>
											<div class="sl-content">
												<span class="inline-block capitalize-font  pull-left truncate head-notifications">
												{{$massage }} </span>
												<!--span class="inline-block font-11  pull-right notifications-time">2pm</span-->
												<div class="clearfix"></div>
												<p class="truncate">{{$massage}}.</p>
											</div>
										</a>	
									</div>
									<hr class="light-grey-hr ma-0"/>
															
									@else  
									<div class="sl-item">
										No notification found yet
									</div>
									@endif
								</div>
								
							</li>
							@if(count($notifications) >0)
							<li>

								<div class="notification-box-bottom-wrap">
									<hr class="light-grey-hr ma-0"/>
									<a class="block text-center read-all" href="{{ url('/admin/leaves') }}"> read all </a>
									<div class="clearfix"></div>
								</div>
							</li>
							@endif
						</ul>
					</li>


					<?php	} 
				 }
				
				?>
					<li class="dropdown auth-drp">
						<a href="#" class="dropdown-toggle pr-0" data-toggle="dropdown"><img src="{{ $admin->image }}" alt="user_auth" class="user-auth-img img-circle"/><span class="user-online-status"></span></a>
						<ul class="dropdown-menu user-auth-dropdown" data-dropdown-in="flipInX" data-dropdown-out="flipOutX">
							<li>
								<a href="{{ url('/admin/profile') }}"><i class="zmdi zmdi-account"></i><span>Profile</span></a>
							</li>
                            <li class="divider"></li>
							<li>
								<a href="{{ url('/admin/change_password') }}"><i class="zmdi zmdi-settings"></i><span>Change Password</span></a>
							</li>
							<li class="divider"></li>
					
							<li>
								<a href="{{ url('/admin/logout') }}"><i class="zmdi zmdi-power"></i><span>Log Out</span></a>
							</li>
						</ul>
					</li>
				</ul>
			</div>	
		</nav>
		<!-- /Top Menu Items -->
		
		<!-- Left Sidebar Menu -->
		<div class="fixed-sidebar-left">
			<ul class="nav navbar-nav side-nav nicescroll-bar">
				<li class="navigation-header">
					<span>Main</span> 
					<i class="zmdi zmdi-more"></i>
				</li>
                <li>
                <a class="@if ($active == 'dashboard') {{ 'active' }} @endif" href="{{ url('/admin/dashboard') }}"><div class="pull-left"><i class="zmdi zmdi-landscape mr-20"></i><span class="right-nav-text">Dashboard</span></div><div class="clearfix"></div></a>
                </li>
				@if(Session::get('user_type') == 'admin')
				<!--li>
				<a class="@if ($active == 'sites') {{ 'active' }} @endif" href="{{ url('/admin/sites') }}"><div class="pull-left"><i class="glyphicon glyphicon-home mr-20"></i><span class="right-nav-text">Manage Sites</span></div><div class="clearfix"></div></a>
                </li-->
                <li>
                <a class="@if ($active == 'supervisors') {{ 'active' }} @endif" href="{{ url('/admin/supervisors') }}"><div class="pull-left"><i class="glyphicon glyphicon-user mr-20"></i><span class="right-nav-text">Manage Supervisors</span></div><div class="clearfix"></div></a>
                </li>
				
				@endif
               
				@if(Session::get('user_type') != 'client' && Session::get('user_type') != 'employee' )
				<li>
                <a class="@if ($active == 'employees') {{ 'active' }} @endif" href="{{ url('/admin/employees') }}"><div class="pull-left"><i class="glyphicon glyphicon-user mr-20"></i><span class="right-nav-text">Manage Employees</span></div><div class="clearfix"></div></a>
                </li>
				@endif
				@if(Session::get('user_type') != 'client' && Session::get('user_type') != 'employee')
                <li>
                <a class="@if ($active == 'clients') {{ 'active' }} @endif" href="{{ url('/admin/clients') }}"><div class="pull-left"><i class="glyphicon glyphicon-user mr-20"></i><span class="right-nav-text">Manage Clients</span></div><div class="clearfix"></div></a>
                </li>
				@endif
				@if(Session::get('user_type') == 'client')
				<li>
                <a class="@if ($active == 'clients') {{ 'active' }} @endif" href="{{ url('/admin/client/sites') }}"><div class="pull-left"><i class="fa fa-building  mr-20"></i><span class="right-nav-text"> Manage Sites</span></div><div class="clearfix"></div></a>
                </li>
				@endif
				@if(Session::get('user_type') != 'client' && Session::get('user_type') != 'employee' )
				<li>
				<a class="@if ($active == 'reports') {{ 'active' }} @endif" href="{{ url('/admin/reports') }}"><div class="pull-left"><i class="fa fa-file-text-o mr-20"></i><span class="right-nav-text">Manage Reports</span></div><div class="clearfix"></div></a>
               
				</li>
				@endif
				@if(Session::get('user_type') == 'supervisor')
				<li>
				<a class="@if ($active == 'leaves') {{ 'active' }} @endif" href="{{ url('/admin/leaves') }}"><div class="pull-left"><i class="fa fa-sign-out mr-20"></i><span class="right-nav-text">Manage Leaves</span></div><div class="clearfix"></div></a>
               
                </li>
				@endif
				@if(Session::get('user_type') == 'admin')
				<li>
				<a class="@if ($active == 'Position') {{ 'active' }} @endif" href="{{ url('/admin/positions')}}"><div class="pull-left"><i class="fa fa-sign-out mr-20"></i><span class="right-nav-text">Manage Positions</span></div><div class="clearfix"></div></a>
               
                </li>
				<li>
				<a class="@if ($active == 'Financial Documents') {{ 'active' }} @endif" href="{{ url('/admin/financial_documents')}}"><div class="pull-left"><i class="fa fa-money mr-20" aria-hidden="true"></i><span class="right-nav-text">Financial Documents</span></div><div class="clearfix"></div></a>
               
                </li>
				@endif
                  @if(Session::get('user_type') == 'employee')
				  <li>
                <a class="@if ($active == 'employees') {{ 'active' }} @endif" href="{{ url('/employee/sites')}}"><div class="pull-left"><i class="fa fa-building  mr-20"></i><span class="right-nav-text"> Manage Sites</span></div><div class="clearfix"></div></a>
                </li>
				<li>
				<a class="@if ($active == 'reports') {{ 'active' }} @endif" href="{{ url('/employee/reports')}}"><div class="pull-left"><i class="fa fa-file-text-o mr-20"></i><span class="right-nav-text">Manage Reports</span></div><div class="clearfix"></div></a>
               
				</li>
<li>
<a class="@if ($active == 'leaves') {{ 'active' }} @endif" href="{{ url('/employee/leaves')}}"><div class="pull-left"><i class="fa fa-sign-out mr-20"></i><span class="right-nav-text">Manage Leaves</span></div><div class="clearfix"></div></a>

</li>
@endif
</ul>
</div>
<!-- /Left Sidebar Menu -->

<!-- Right Sidebar Menu -->
<div class="fixed-sidebar-right">
<ul class="right-sidebar">
<li>
<div  class="tab-struct custom-tab-1">

<ul role="tablist" class="nav nav-tabs" id="right_sidebar_tab">
<!--li class="active" role="presentation"><a aria-expanded="true"  data-toggle="tab" role="tab" id="chat_tab_btn" href="#chat_tab">chat</a></li-->

</ul>
<div class="tab-content" id="right_sidebar_content">
<div  id="chat_tab" class="tab-pane fade active in" role="tabpanel">
<div class="chat-cmplt-wrap">
<div class="chat-box-wrap">
<div class="add-friend">
	<a href="javascript:void(0)" class="inline-block txt-grey">
		<i class="zmdi zmdi-more"></i>
	</a>	
	<span class="inline-block txt-dark">Chat</span>
	<a href="javascript:void(0)" class="inline-block text-right txt-grey"><i class="zmdi zmdi-plus"></i></a>
	<div class="clearfix"></div>
</div>
<!--form role="search" class="chat-search pl-15 pr-15 pb-15">
	<div class="input-group">
		<input type="text" id="example-input1-group2" name="example-input1-group2" class="form-control" placeholder="Search">
		<span class="input-group-btn">
		<button type="button" class="btn  btn-default"><i class="zmdi zmdi-search"></i></button>
		</span>
	</div>
</form-->
<div id="chat_list_scroll">
	<div class="nicescroll-bar">
		<ul class="chat-list-wrap">
			<li class="chat-list">
				<div class="chat-body">
		         @if(Session::get('user_type') == 'supervisor')
				@foreach($employees as $key => $employee)
				<?php 
				if($employee->message == '' || $employee->message == null){ 
					$employee->message  = \App\Inbox::where(['sender_id'=>Session::get('admin_id'),'receiver_id'=>$employee->id])->value('message');	
					}   
					?>
					<a href="javascript:void(0)" onClick="getConversation('{{url('/admin/supervisors/getChat/'.$employee->id)}}')">
						<div class="chat-data">
							<img class="user-img img-circle"  src="{{ $employee->image }}" alt="user"/>
							<div class="user-data">
								<span class="name block capitalize-font">{{ $employee->name }}</span>
								<span class="time block truncate txt-grey">{{ $employee->message }}</span>
							</div>
							<div class="status away"></div>
							<div class="clearfix"></div>
						</div>
					</a>
					
					@endforeach
			      @endif
				</div>
				<div class="chat-body">
		         @if(Session::get('user_type') == 'employee')
				@foreach($employees as $key => $employee)
				<?php 
				if($employee->message == '' || $employee->message == null){ 
					$employee->message  = \App\Inbox::where(['sender_id'=>Session::get('admin_id'),'receiver_id'=>$employee->id])->value('message');	
					}   
					?>
					<a href="javascript:void(0)" onClick="getConversation('{{url('/admin/supervisors/getChat/'.$employee->id)}}')">
						<div class="chat-data">
							<img class="user-img img-circle"  src="{{ $employee->image }}" alt="user"/>
							<div class="user-data">
								<span class="name block capitalize-font">{{ $employee->name }}</span>
								<span class="time block truncate txt-grey">{{ $employee->message }}</span>
							</div>
							<div class="status away"></div>
							<div class="clearfix"></div>
						</div>
					</a>
					
					@endforeach
			      @endif
				</div>
				<div class="chat-body">
		         @if(Session::get('user_type') == 'admin')
				   <?php
						 
						 
				   ?>
				@foreach($employees as $key => $employee)
				
				<?php 
                  
		
				  $employee_id = $employee->id;
				  $admin_id =  Session::get('admin_id');
				  $employee->message  = \App\Inbox::where(['sender_id' => $admin_id,'receiver_id' => $employee_id])->orWhere(function($q)use ($employee_id,$admin_id){ $q->where(['sender_id' => $employee_id,'receiver_id' => $admin_id]);
				  })->orderBy('created_at','DESC')->value('message');
				?>
					<a href="javascript:void(0)" onClick="getConversation('{{url('/admin/supervisors/getChat/'.$employee->id)}}')">
						<div class="chat-data">
							<img class="user-img img-circle"  src="{{ $employee->image }}" alt="user"/>
							<div class="user-data">
								<span class="name block capitalize-font">{{ $employee->name }}</span>
								<span class="time block truncate txt-grey">{{ $employee->message }}</span>
							</div>
							<div class="status away"></div>
							<div class="clearfix"></div>
						</div>
					</a>
					
					@endforeach
			      @endif
				</div>
			</li>
		</ul>
	</div>
</div>
</div>
<div class="recent-chat-box-wrap">

<div class="recent-chat-wrap">

										

									</div>
									</div>
								</div>
							</div>
								
							
							
						</div>
					</div>
				</li>
			</ul>
		</div>
		<!-- /Right Sidebar Menu -->

