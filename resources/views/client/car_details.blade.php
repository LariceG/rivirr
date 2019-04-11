@include('client.includes.header')
 <div class="row">
	<div class="col-xs-12 col-sm-12 heading">
      <p class="text-form">Fill this to receive your digital ticket ({{ $ticket }})</p>
    </div>
   </div>
   <form action="{{ url('/client/update_car_details') }}" method="post" enctype="multipart/form-data">
  <div class="row">
    <div class="col-xs-12 col-sm-12 digit-ticket">
 <div class="frm"> <b>First Name</b> <input type="text" class="form-control" value="{{ old('first_name') }}" name="first_name" />
     @if ($errors->first('first_name'))
	<label class="error">
	{{ $errors->first('first_name') }}
	</label>
	@endif
 </div>
 <div class="frm"> <b> Brand Car </b><input type="text" class="form-control" value="{{ old('brand') }}" name="brand" />
  @if ($errors->first('brand'))
	<label class="error">
	{{ $errors->first('brand') }}
	</label>
	@endif
 </div>
  <div class="frm"> <b>  Color </b> <input type="text" class="form-control" value="{{ old('color') }}" name="color" />
   @if ($errors->first('color'))
	<label class="error">
	{{ $errors->first('color') }}
	</label>
	@endif
  </div>
<div class="frm">  <span> Year </span><input type="text" class="form-control" value="{{ old('year') }}" name="year" />
 @if ($errors->first('year'))
	<label class="error">
	{{ $errors->first('year') }}
	</label>
	@endif
</div>
<div class="frm">  <span> Model </span><input type="text" class="form-control" value="{{ old('model') }}" name="model" />
 @if ($errors->first('model'))
	<label class="error">
	{{ $errors->first('model') }}
	</label>
	@endif
	<input type="hidden" class="form-control" value="{{ $ticket }}" name="ticketno" />
	<input type="hidden" name="_token" id="csrf-token" value="{{ Session::token() }}" />
</div>
 <div class="frm"> <input type="submit" name="enter" class="btn sbt" value="Submit" />
 </div>
  </div>
  </div>
  </form>
  
  <div class="row">
    <div class="col-xs-12 col-sm-12 ">
  <span class="client_btn">
  CLIENT
  </span>
  
  </div>
  
 
  
  </div>
</div> 
