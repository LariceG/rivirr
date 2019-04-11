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
    <title>Login</title>

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
  <style>
  .login-logo span{
	color: #50d8af;
}
.login-logo h1{
	color: #0c2e8a;
}
  </style>
</head>

<body class="animsition">
    <div class="page-wrapper">
        <div class="page-content--bge5">
            <div class="container">
                <div class="login-wrap">
                    <div class="login-content">
                        <div class="login-logo">
                          <img src="{{ url('/public/assets/images/icon/logo2.png')}}">
                        </div>
						@if (Session::get('error'))
						<div class="alert alert-danger text-center">
						{{ Session::get('error') }}
						</div>
						@endif
						
                        <div class="login-form">
                            <form action="{{ url('/admin/login') }}" method="post">
                                <div class="form-group">
                                    <label>Email Address</label>
                                    <input class="au-input au-input--full" type="text" value="{{ old('email') }}"  name="email" placeholder="Email">
                                </div>
								@if ($errors->first('email'))
								<label class="error">
							    {{ $errors->first('email') }}
							    </label>
								@endif
								<input type="hidden" name="_token" id="csrf-token" value="{{ Session::token() }}" />
								
                                <div class="form-group">
                                    <label>Password</label>
                                    <input class="au-input au-input--full" type="password" value="{{ old('password') }}" name="password" placeholder="Password">
                                </div>
								@if ($errors->first('password'))
								<label class="error">
							    {{ $errors->first('password') }}
							    </label>
								@endif
                                <!--<div class="login-checkbox">
                                    <label>
                                        <input type="checkbox" name="remember">Remember Me
                                    </label>
                                    <label>
                                        <a href="#">Forgotten Password?</a>
                                    </label>
                                </div>-->
                                <button class="au-btn au-btn--block au-btn--green m-b-20" type="submit">sign in</button>
                              
                            </form>
                          
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <!-- Jquery JS-->
    <script src="{{ URL::asset('assets/vendor/jquery-3.2.1.min.js') }}"></script>
    <!-- Bootstrap JS-->
    <script src="{{ URL::asset('assets/vendor/bootstrap-4.1/popper.min.js') }}"></script>
    <script src="{{ URL::asset('assets/vendor/bootstrap-4.1/bootstrap.min.js') }}"></script>
    <!-- Vendor JS       -->
    <script src="{{ URL::asset('assets/vendor/slick/slick.min.js') }}">
    </script>
    <script src="{{ URL::asset('assets/vendor/wow/wow.min.js') }}"></script>
    <script src="{{ URL::asset('assets/vendor/animsition/animsition.min.js') }}"></script>
    <script src="{{ URL::asset('vendor/bootstrap-progressbar/bootstrap-progressbar.min.js') }}">
    </script>
    <script src="{{ URL::asset('assets/vendor/counter-up/jquery.waypoints.min.js') }}"></script>
    <script src="{{ URL::asset('assets/vendor/counter-up/jquery.counterup.min.js') }}">
    </script>
    <script src="{{ URL::asset('assets/vendor/circle-progress/circle-progress.min.js') }}"></script>
    <script src="{{ URL::asset('assets/vendor/perfect-scrollbar/perfect-scrollbar.js') }}"></script>
    <script src="{{ URL::asset('assets/vendor/chartjs/Chart.bundle.min.js') }}"></script>
    <script src="{{ URL::asset('assets/vendor/select2/select2.min.js') }}">
    </script>

    <!-- Main JS-->
    <script src="{{ URL::asset('assets/js/main.js') }}"></script>

</body>

</html>
<!-- end document-->