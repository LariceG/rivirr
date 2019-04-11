@include('valet.includes.header')
<div class="row">
    <div class="col-xs-12 col-sm-12 heading">
      <p class="text-form"><b>Enter Direct Ticket No</b></p>
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
  <form action="{{ url('/valet/check_ticket') }}" method="post" enctype="multipart/form-data">
  <div class="row">
    <div class="m20 ticket">
      <div class="col-sm-4"><label>Ticket No.</label></div><div class="col-sm-8"><input type="number" name="ticketno" class="form-control"  /></div>
	  @if ($errors->first('ticketno'))
	<label class="error">
	{{ $errors->first('ticketno') }}
	</label>
	@endif
    
     <input type="hidden" name="_token" id="csrf-token" value="{{ Session::token() }}" />
    </div>
    <input type="submit" name="enter2" class="btn sbt ticket" value="Submit" />
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
