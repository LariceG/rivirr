<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags-->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="au theme template">
    <meta name="author" content="Hau Nguyen">
    <meta name="keywords" content="au theme template">
    <link rel="shortcut icon" href="{{ url('/public/assets/frontend/images/logo.png')}}" type="image/x-icon">
    <!-- Title Page-->
    <title>Admin Panel</title>

    <!-- Fontfaces CSS-->
    <link href="{{ URL::asset('assets/css/font-face.css') }}" rel="stylesheet" media="all">
    <link href="{{ URL::asset('assets/vendor/font-awesome-4.7/css/font-awesome.min.css') }}" rel="stylesheet" media="all">
    <link href="{{ URL::asset('assets/vendor/font-awesome-5/css/fontawesome-all.min.css') }}" rel="stylesheet" media="all">
    <link href="{{ URL::asset('assets/vendor/mdi-font/css/material-design-iconic-font.min.css') }}" rel="stylesheet" media="all">

    <!-- Bootstrap CSS-->
    <link href="{{ URL::asset('assets/vendor/bootstrap-4.1/bootstrap.min.css') }}" rel="stylesheet" media="all">

    <!-- Vendor CSS-->
    <link href="{{ URL::asset('assets/vendor/animsition/animsition.min.css') }}" rel="stylesheet" media="all">
    <link href="{{ URL::asset('assets/vendor/bootstrap-progressbar/bootstrap-progressbar-3.3.4.min.css') }}" rel="stylesheet" media="all">
    <link href="{{ URL::asset('assets/vendor/wow/animate.css') }}" rel="stylesheet" media="all">
    <link href="{{ URL::asset('assets/vendor/css-hamburgers/hamburgers.min.css') }}" rel="stylesheet" media="all">
    <link href="{{ URL::asset('assets/vendor/slick/slick.css') }}" rel="stylesheet" media="all">
    <link href="{{ URL::asset('assets/vendor/select2/select2.min.css') }}" rel="stylesheet" media="all">
    <link href="{{ URL::asset('assets/vendor/perfect-scrollbar/perfect-scrollbar.css') }}" rel="stylesheet" media="all">

    <!-- Main CSS-->
    <link href="{{ URL::asset('assets/css/theme.css') }}" rel="stylesheet" media="all">
    <link href="//cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css" rel="stylesheet" media="all">
    <!----input-tags--->
<link rel="stylesheet" href="{{ URL::asset('assets/input-tags/dist/bootstrap-tagsinput.css')}}">
    <script src="{{ URL::asset('assets/vendor/jquery-3.2.1.min.js') }}"></script>
 <style>
	img.gallery_image {
    margin: 3px;
    padding: 2px;
    /* border: 2px solid; */
}
.card-body.card-block h3 {
    margin-bottom: 10px;
}
.grly i {
    position: absolute;
    top: 2px;
    right: 3px;
    color: red;
}
.grly {
    float: left;
    position: relative;
}
.logo span{
	color: #50d8af;
}
.logo a{
	color: #0c2e8a;
}
.box{
padding: 0px;
display: none;
margin-top: 10px;
clear: both;

}
.red{display: block}
.green{}
.green ul li{
    float: left;
}
.green ul li:nth-child(1){
    width: 93%;
    padding-right: 5px;
}
.green ul li:nth-child(2){
    width: 7%;
}
.green ul li .btn {
    border: 1px solid transparent;
    border-radius: 0 !important;
    cursor: pointer;
    display: inline-block;
    font-size: 20px;
    font-weight: 400;
    line-height: 26px;
    margin-left: 1px !important;
    padding: 5px 12px;
}

	</style>
</head>

<body class="animsition">
    <div class="page-wrapper">
        <!-- HEADER MOBILE-->
        <header class="header-mobile d-block d-lg-none">
            <div class="header-mobile__bar">
                <div class="container-fluid">
                    <div class="header-mobile-inner">
					<h1>
                        <a class="logo" href="{{ url('/admin/dashboard') }}">
						
                        <img src="{{ url('/public/assets/images/icon/logo2.png')}}">
                        </a>
						</h1>
                        <button class="hamburger hamburger--slider" type="button">
                            <span class="hamburger-box">
                                <span class="hamburger-inner"></span>
                            </span>
                        </button>
                    </div>
                </div>
            </div>
            <nav class="navbar-mobile">
                <div class="container-fluid">
                    <ul class="navbar-mobile__list list-unstyled">
					   <li class="@if ($active == 'dashboard') {{ 'active' }} @endif">
                            <a href="{{ url('/admin/dashboard') }}">
                                <i class="fas fa-tachometer-alt"></i>Dashboard</a>
                        </li>
						 <li class="@if ($active == 'majors') {{ 'active' }} @endif">
                            <a href="{{ url('/admin/majors') }}">
                                <i class="fas fa-compress"></i>Manage Majors</a>
                        </li>
						<li class="@if ($active == 'perks') {{ 'active' }} @endif">
                            <a href="{{ url('/admin/perks') }}">
                                <i class="fas fa-plus-square"></i>Manage Perks</a>
                        </li>
						  <li class="@if ($active == 'recruit') {{ 'active' }} @endif">
                            <a href="{{ url('/admin/recruits') }}">
                                <i class="fas fa-bookmark"></i>Manage Recruits</a>
                        </li>	
						 <li class="@if ($active == 'categories') {{ 'active' }} @endif">
                            <a href="{{ url('/admin/categories') }}">
                                <i class="fas fa-tag"></i>Manage Categories</a>
                        </li>
					
					 <li class="@if ($active == 'employers') {{ 'active' }} @endif">
                            <a href="{{ url('/admin/employers') }}">
                                <i class="fas fa-users"></i>Manage Employers</a>
                        </li>
							
						<li class="@if ($active == 'employees') {{ 'active' }} @endif">
                            <a href="{{ url('/admin/employees') }}">
                                <i class="fas fa-users"></i>Manage Employees</a>
                        </li>
                        <li class="@if ($active == 'industries') {{ 'active' }} @endif">
                          <a href="{{ url('/admin/industries') }}">
                          <i class="fas fa-industry">"></i>Manage Industries</a>
                        </li>
                       <!-- <li class="has-sub">
                            <a class="js-arrow" href="#">
                                <i class="fas fa-copy"></i>Pages</a>
                            <!--<ul class="navbar-mobile-sub__list list-unstyled js-sub-list">
                                <li>
                                    <a href="login.html">Login</a>
                                </li>
                                <li>
                                    <a href="register.html">Register</a>
                                </li>
                                <li>
                                    <a href="forget-pass.html">Forget Password</a>
                                </li>
                            </ul>
                        </li>-->
                      
                    </ul>
                </div>
            </nav>
        </header>
        <!-- END HEADER MOBILE-->

        <!-- MENU SIDEBAR-->
        <aside class="menu-sidebar d-none d-lg-block">
            <div class="logo">
			<h1>
                <a href="{{ url('/admin/dashboard') }}">
                <img src="{{ url('/public/assets/images/icon/logo2.png')}}">
                </a>
				</h1>
            </div>
            <div class="menu-sidebar__content js-scrollbar1">
                <nav class="navbar-sidebar">
                    <ul class="list-unstyled navbar__list">
					   <li class="@if ($active == 'dashboard') {{ 'active' }} @endif">
                            <a href="{{ url('/admin/dashboard') }}">
                                <i class="fas fa-tachometer-alt"></i>Dashboard</a>
                        </li>
						<li class="@if ($active == 'majors') {{ 'active' }} @endif">
                            <a href="{{ url('/admin/majors') }}">
                                <i class="fas fa-compress"></i>Manage Majors</a>
                        </li>
						<li class="@if ($active == 'perks') {{ 'active' }} @endif">
                            <a href="{{ url('/admin/perks') }}">
                                <i class="fas fa-plus-square"></i>Manage Perks</a>
                        </li>
						 <li class="@if ($active == 'recruit') {{ 'active' }} @endif">
                            <a href="{{ url('/admin/recruits') }}">
                                <i class="fas fa-bookmark"></i>Manage Recruits</a>
                        </li>	
						 <li class="@if ($active == 'categories') {{ 'active' }} @endif">
                            <a href="{{ url('/admin/categories') }}">
                                <i class="fas fa-tag"></i>Manage Categories</a>
                        </li>
					 
					 <li class="@if ($active == 'employers') {{ 'active' }} @endif">
                            <a href="{{ url('/admin/employers') }}">
                                <i class="fas fa-users"></i>Manage Employers</a>
                        </li>
							
						<li class="@if ($active == 'employees') {{ 'active' }} @endif">
                            <a href="{{ url('/admin/employees') }}">
                                <i class="fas fa-users"></i>Manage Employees</a>
                        </li>
						   <li class="@if ($active == 'industries') {{ 'active' }} @endif">
                          <a href="{{ url('/admin/industries') }}">
                          <i class="fas fa-industry"></i>Manage Industries</a>
                        </li>
						<!--li class="{{ request()->is('admin/bookings') ? 'active' : '' }}">
						<a href="{{ url('/admin/bookings') }}">
							<i class="fas fa-bookmark"></i>Manage Bookings</a>
                        </li-->
                        <!--<li class="active has-sub">
                            <a class="js-arrow" href="#">
                                <i class="fas fa-tachometer-alt"></i>Dashboard</a>
                            <ul class="list-unstyled navbar__sub-list js-sub-list">
                                <li>
                                    <a href="index.html">Dashboard 1</a>
                                </li>
                                <li>
                                    <a href="index2.html">Dashboard 2</a>
                                </li>
                                <li>
                                    <a href="index3.html">Dashboard 3</a>
                                </li>
                                <li>
                                    <a href="index4.html">Dashboard 4</a>
                                </li>
                            </ul>
                        </li>-->
                       
                    </ul>
                </nav>
            </div>
        </aside>
        <!-- END MENU SIDEBAR-->

        <!-- PAGE CONTAINER-->
        <div class="page-container">
            <!-- HEADER DESKTOP-->
            <header class="header-desktop">
                <div class="section__content section__content--p30">
                    <div class="container-fluid">
                        <div class="header-wrap">
                            <form class="form-header" action="" method="POST">
                               <!--<input class="au-input au-input--xl" type="text" name="search" placeholder="Search for datas &amp; reports..." />
                                <button class="au-btn--submit" type="submit">
                                    <i class="zmdi zmdi-search"></i>
                                </button>-->
                            </form>
                            <div class="header-button">
                                <div class="noti-wrap">
                                    <div class="noti__item js-item-menu">
                                        <i class="zmdi zmdi-comment-more"></i>
                                        <span class="quantity">1</span>
                                        <div class="mess-dropdown js-dropdown">
                                            <div class="mess__title">
                                                <p>You have 2 news message</p>
                                            </div>
                                            <div class="mess__item">
                                                <div class="image img-cir img-40">
                                                    <img src="{{ URL::asset('assets/images/icon/avatar-06.jpg') }}" alt="Michelle Moreno" />
                                                </div>
                                                <div class="content">
                                                    <h6>Michelle Moreno</h6>
                                                    <p>Have sent a photo</p>
                                                    <span class="time">3 min ago</span>
                                                </div>
                                            </div>
                                            <div class="mess__item">
                                                <div class="image img-cir img-40">
                                                    <img src="{{ URL::asset('assets/images/icon/avatar-04.jpg') }}" alt="Diane Myers" />
                                                </div>
                                                <div class="content">
                                                    <h6>Diane Myers</h6>
                                                    <p>You are now connected on message</p>
                                                    <span class="time">Yesterday</span>
                                                </div>
                                            </div>
                                            <div class="mess__footer">
                                                <a href="#">View all messages</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="noti__item js-item-menu">
                                        <i class="zmdi zmdi-email"></i>
                                        <span class="quantity">1</span>
                                        <div class="email-dropdown js-dropdown">
                                            <div class="email__title">
                                                <p>You have 3 New Emails</p>
                                            </div>
                                            <div class="email__item">
                                                <div class="image img-cir img-40">
                                                    <img src="{{ URL::asset('assets/images/icon/avatar-06.jpg') }}" alt="Cynthia Harvey" />
                                                </div>
                                                <div class="content">
                                                    <p>Meeting about new dashboard...</p>
                                                    <span>Cynthia Harvey, 3 min ago</span>
                                                </div>
                                            </div>
                                            <div class="email__item">
                                                <div class="image img-cir img-40">
                                                    <img src="{{ URL::asset('assets/images/icon/avatar-05.jpg') }}" alt="Cynthia Harvey" />
                                                </div>
                                                <div class="content">
                                                    <p>Meeting about new dashboard...</p>
                                                    <span>Cynthia Harvey, Yesterday</span>
                                                </div>
                                            </div>
                                            <div class="email__item">
                                                <div class="image img-cir img-40">
                                                    <img src="{{ URL::asset('assets/images/icon/avatar-04.jpg') }}" alt="Cynthia Harvey" />
                                                </div>
                                                <div class="content">
                                                    <p>Meeting about new dashboard...</p>
                                                    <span>Cynthia Harvey, April 12,,2018</span>
                                                </div>
                                            </div>
                                            <div class="email__footer">
                                                <a href="#">See all emails</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="noti__item js-item-menu">
                                        <i class="zmdi zmdi-notifications"></i>
                                        <span class="quantity">3</span>
                                        <div class="notifi-dropdown js-dropdown">
                                            <div class="notifi__title">
                                                <p>You have 3 Notifications</p>
                                            </div>
                                            <div class="notifi__item">
                                                <div class="bg-c1 img-cir img-40">
                                                    <i class="zmdi zmdi-email-open"></i>
                                                </div>
                                                <div class="content">
                                                    <p>You got a email notification</p>
                                                    <span class="date">April 12, 2018 06:50</span>
                                                </div>
                                            </div>
                                            <div class="notifi__item">
                                                <div class="bg-c2 img-cir img-40">
                                                    <i class="zmdi zmdi-account-box"></i>
                                                </div>
                                                <div class="content">
                                                    <p>Your account has been blocked</p>
                                                    <span class="date">April 12, 2018 06:50</span>
                                                </div>
                                            </div>
                                            <div class="notifi__item">
                                                <div class="bg-c3 img-cir img-40">
                                                    <i class="zmdi zmdi-file-text"></i>
                                                </div>
                                                <div class="content">
                                                    <p>You got a new file</p>
                                                    <span class="date">April 12, 2018 06:50</span>
                                                </div>
                                            </div>
                                            <div class="notifi__footer">
                                                <a href="#">All notifications</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="account-wrap">
                                    <div class="account-item clearfix js-item-menu">
                                        <div class="image">
                                            <img src="{{ URL::asset('/uploads/admin/'.$admin->image) }}" alt="John Doe" />
                                        </div>
                                        <div class="content">
                                            <a class="js-acc-btn" href="#">{{ $admin->username }}</a>
                                        </div>
                                        <div class="account-dropdown js-dropdown">
                                            <div class="info clearfix">
                                                <div class="image">
                                                    <a href="#">
                                                        <img src="{{ URL::asset('/uploads/admin/'.$admin->image) }}" alt="John Doe" />
                                                    </a>
                                                </div>
                                                <div class="content">
                                                    <h5 class="name">
                                                        {{ $admin->username }}
                                                    </h5>
                                                    <span class="email">{{ $admin->email }}</span>
                                                </div>
                                            </div>
                                            <div class="account-dropdown__body">
                                                <div class="account-dropdown__item">
                                                    <a href="{{ url('/admin/profile') }}">
                                                        <i class="zmdi zmdi-account"></i>Profile</a>
                                                </div>
                                                <div class="account-dropdown__item">
                                                    <a href="{{ url('/admin/change_password') }}">
                                                        <i class="zmdi zmdi-settings"></i>Change Password</a>
                                                </div>
                                               
                                            </div>
                                            <div class="account-dropdown__footer">
                                                <a href="{{ url('/admin/logout') }}">
                                                    <i class="zmdi zmdi-power"></i>Logout</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </header>
            <!-- HEADER DESKTOP-->