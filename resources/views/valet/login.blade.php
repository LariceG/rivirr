<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

<head>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<title>Valet Login</title>

<link rel="stylesheet" href="{{ URL::asset('assets/frontend/css/bootstrap.min.css') }}">

<script src="{{ URL::asset('assets/frontend/js/jquery.min.js') }}"></script>

<script src="{{ URL::asset('assets/frontend/js/bootstrap.min.js') }}"></script>

<link rel="stylesheet" href="{{ URL::asset('assets/frontend/css/style.css') }}" />

</head>

<body>

<div class="container">

  <div class="row">

    <div class="col-xs-12 col-sm-12 heading">

      <h2>Valet</h2>

      <p>Sign in</p>

    </div>

  </div>

  <div class="row">

    <div class="col-xs-12 col-sm-12 m20">
      @if (Session::get('error'))
		<div class="alert alert-danger text-center">
		{{ Session::get('error') }}
		</div>
		@endif
	  <form action="{{ url('/valet/login') }}" method="post" enctype="multipart/form-data">
      <input type="text" name="point" class="form-control" placeholder="Point" />

      <input type="text" name="email" value="{{ old('email') }}" class="form-control" placeholder="Phone or Email" />
	  @if ($errors->first('email'))
		<label class="error">
		{{ $errors->first('email') }}
		</label>
		@endif
        <input type="password" name="password" class="form-control" placeholder="Password" />
       	@if ($errors->first('password'))
		<label class="error">
		{{ $errors->first('password') }}
		</label>
		@endif
			<input type="hidden" name="_token" id="csrf-token" value="{{ Session::token() }}" />
      <input type="submit" name="enter" class="btn sbt" value="Submit" />
	</form>
    </div>

  </div>

</div>

</body>

</html>

