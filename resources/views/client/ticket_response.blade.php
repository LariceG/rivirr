@include('client.includes.header')
 <div class="row">
	<div class="col-xs-12 col-sm-12 heading">
      <p class="text-form">Ticket No.{{ $ticket }}</p>
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
      <p>
	  <a onclick="return confirm('Are you sure want to send it? ');" href="{{ url('/client/send_request/'.$ticket) }}">	
	  <label class="btn btn-primary">			
				REQUEST Car
			</label>
			</a>
			</p>
            <p> <label class="btn btn-primary">
				<input name="receive" id="option2" autocomplete="off" type="radio">
				Contact Driver
			</label></p>
    </div>
  </div>
  
    <div class="row">
    <div class="col-xs-12 col-sm-12 ">
  <span class="client_btn">
  CLIENT
  </span>
  
  </div>
  
  </div>
	
</div>
