@include('client.includes.header')
  <div class="row">
   
    <div class="col-xs-12 col-sm-12 heading m-btm">
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
      <p>TICKET<br />
      No. {{ $ticket_details->ticketno }}</p>
      <div class="profile">
      
       <img style="width: 460px;height: 460px;" src="{{ URL::asset('/uploads/valet/'.$ticket_details->image) }}" />
      
      </div> <!-- end of profile -->
      <p>{{ $ticket_details->name }}</p>
      </div>
   <div class="row">   
  <div class="col-md-6 truck_img">
  <img src="{{ URL::asset('assets/frontend/image/truck.png') }}" width="30%" height="35%" />
  
  </div> 
  
  </div>   
   <div class="row">     
    <div class="col-xs-12 col-sm-12 radio ">
     <div class="new">
          <label class="btn btn-primary"></span>
				<input name="receive" disabled id="option1" autocomplete="off" <?php if($ticket_details->status == '2'){ ?>checked="checked" <?php } ?> type="radio">
				On the way
			</label>
            </div>
                <div class="new">
             <label class="btn btn-primary">
				<input name="receive" disabled id="option2" <?php if($ticket_details->status == '3'){ ?>checked="checked" <?php } ?> autocomplete="off" type="radio">
			Ready
			</label>
            </div>
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
  
 
  
</div>
</body>
</html>