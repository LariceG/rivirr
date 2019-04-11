@include('valet.includes.header')
<div class="row">
    <div class="col-xs-12 col-sm-12 heading">
     
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
  <form action="{{ url('/valet/generate_ticket') }}" method="post" enctype="multipart/form-data">
  <div class="row">
    <div class="m20 ticket">
      <div class="col-sm-4"><label>Ticket No.</label></div><div class="col-sm-8"><input type="number" value="{{ old('phone') }}{{  mt_rand(100000000, 999999999) }}" name="ticketno" class="form-control"  /></div>
	  @if ($errors->first('ticketno'))
	<label class="error">
	{{ $errors->first('ticketno') }}
	</label>
	@endif
      <div class="col-sm-4"><label>Phone</label></div><div class="col-sm-8"><input type="number" name="phone" class="form-control" /></div>
	   @if ($errors->first('phone'))
	<label class="error">
	{{ $errors->first('phone') }}
	</label>
	@endif
     <input type="hidden" name="_token" id="csrf-token" value="{{ Session::token() }}" />
    </div>
    <input type="submit" name="enter2" class="btn sbt ticket" value="Send" />
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
