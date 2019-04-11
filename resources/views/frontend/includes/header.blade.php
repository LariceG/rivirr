<!DOCTYPE html>
<html lang="en">

<head>
  <title>Riverr</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="shortcut icon" href="{{ url('/public/assets/frontend/images/logo.png')}}" type="image/x-icon">
  <!--slick-->
  <link rel="stylesheet" type="text/css" href="{{ URL::asset('/public/assets/frontend/css/slick.css')}}">
  <link rel="stylesheet" type="text/css" href="{{ URL::asset('/public/assets/frontend/css/slick-theme.css')}}">
  <!---------css style----------->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css">
  <link href="https://fonts.googleapis.com/css?family=Montserrat:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Roboto+Condensed:300,300i,400,400i,700,700i" rel="stylesheet">
     <link rel="stylesheet" href="{{ URL::asset('/public/assets/frontend/css/datepicker.min.css')}}">
  <link rel="stylesheet" href="{{ URL::asset('/public/assets/frontend/css/style.css')}}">
  <link rel="stylesheet" href="{{ URL::asset('/public/assets/frontend/css/font-awesome.min.css')}}"> 

    </head>


<body class="main_body" <?php if( Request::segment(1) == 'search' ) { ?> id="search-page-body"  <?php  } ?> >
  <header id="header" class="py-3">
    <div class="container">
      <div class="row  align-items-center">
        <div class="col-md-4">
          <div class="logo">
            <a href="/"><img src="{{ url('/public/assets/images/icon/logo2.png')}}" alt=""></a>
          </div>
        </div>
        <div class="col-md-5">
          <nav class="navbar navbar-expand-lg navbar-light ">
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
              aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
              <ul class="navbar-nav ">
                <li class="nav-item active">
                  <a class="nav-link" href="{{ url('/about')}}">About us</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="#">Contact us</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="#">Find Employer</a>
                </li>
              </ul>
            </div>
          </nav>
        </div>
        @if(Session::has('user_id'))
          <div class="col-md-3">
         <div class="dropdown">
             <p class=" dropdown-toggle text-white font-weight-bold mb-0 user-dropdown" data-toggle="dropdown"> <i class="fa fa-user "></i>
    {{Session::get('user_name')}}
  </p>
  <div class="dropdown-menu">
    <a class="dropdown-item" href="{{url('edit_profile',Session::get('user_id'))}}">Edit Profile</a>
    <a class="dropdown-item" href="/logout">Logout</a>
  </div>
</div>
              
        </div>
          @else
        <div class="col-md-3">
          <button class="btn signin-btn btn-success font-weight-light" onclick="window.location.href='/employer'">Signin/Register</button>
        </div>
        @endif
        </div>
    </div>
  </header>