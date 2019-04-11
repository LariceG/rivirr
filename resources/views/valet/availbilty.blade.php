@include('valet.includes.header')
  <div class="row">
    <div class="col-xs-12 col-sm-12 heading">
     <p class="text-uppercase">Valet</p>
    </div>
  </div>
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
  <div class="row">
<a href="{{ url('/valet/go_to_available/'.$ticket) }}"><div class="col-md-12 available"><input type="button" class="btn " value="Go to available" /></div></a>
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