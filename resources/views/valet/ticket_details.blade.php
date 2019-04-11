@include('valet.includes.header')
<div class="row">
	<div class="col-xs-12 col-sm-12 heading">
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
      
	   <p class="text-form">Ticket No. {{ $ticket_details->ticketno }}</p>
    </div>
   </div>
  <div class="row">
    <div class="col-xs-12 col-sm-12 digit-ticket">
 <div class="frm"> <span>Client Name</span> <input type="text" class="form-control" readonly name="fname" value="{{ $ticket_details->first_name }}" /> </div>
 <div class="frm"> <span>Car Brand  </span><input type="text" readonly class="form-control" name="brand-car" value="{{ $ticket_details->brand }}" /></div>
  <div class="frm"> <span>  Color </span> <input type="text" readonly class="form-control" name="color" value="{{ $ticket_details->color }}" /></div>
<div class="frm">  <span> Year </span><input type="text" readonly class="form-control" name="year" value="{{ $ticket_details->year }}" /></div>
<div class="frm">  <span> Model </span><input type="text" readonly class="form-control" name="model" value="{{ $ticket_details->model }}" /></div>
 <a onclick="return confirm('Are you sure want to finish it? ');" href="{{ url('/valet/finish_job/'.$ticket_details->ticketno) }}"><div class="frm"> <input type="button" name="Finish Car Delivered" class="btn sbt" value="Finish Car Delivered" />
 </div></a>
  </div></div>
      <div class="row">
    <div class="col-xs-12 col-sm-12 ">
  <span class="client_btn">
  DRIVER
  </span>
  
  </div>
  
  </div>
  </div>
  