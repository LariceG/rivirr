@include('valet.includes.header')
<div class="row">
    <div class="col-xs-12 col-sm-12 heading">
      <p class="text-uppercase">{{ $valet->name }}</p>
    </div>
  </div>
  <div class="row">
    <div class="col-xs-12 col-sm-12 radio ">
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
	<a href="{{ url('/valet/ticket') }}">
      <label class="btn btn-primary">			
				Receive
			</label>
			</a>
			<a href="{{ url('/valet/get_ticket') }}">
             <label class="btn btn-primary">	
				Deliver
			</label>
			</a>
    </div>
  </div>
  <div class="row">
  <div class="col-sm-12 driver"><span>Driver</span><label class="switch">
  <input type="checkbox" checked>
  <span class="slider round"></span>
</label></div>
  </div>
</div>
</body>
</html>
