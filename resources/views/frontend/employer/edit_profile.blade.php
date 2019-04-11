@include('frontend/includes/header')	
<!----<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100">
				<form class="login100-form validate-form" method="post" action="{{url('/sign_up')}}" enctype="multipart/form-data">
					

					<span class="login100-form-title p-b-34 p-t-27">
						Sign Up
					</span>
                    <span style="color: red;"> {{$errors->first('username')}}</span>
					<div class="wrap-input100 validate-input" data-validate = "Enter username">
						<input class="input100" type="text" name="username" placeholder="Username" value="{{ old('username')}}">
						<span class="focus-input100" data-placeholder="&#xf207;"></span>
				    </div>
                    <span style="color: red;">	{{$errors->first('useremail')}}</span>
					<div class="wrap-input100 validate-input" data-validate = "Enter Email">
						<input class="input100" type="Email" name="useremail" placeholder="Email" value="{{ old('useremail')}}">
						<span class="focus-input100" data-placeholder="&#x2709;"></span>
				   </div>
                    <span style="color: red;">  {{$errors->first('phone')}}</span>
                    <div class="wrap-input100 validate-input" data-validate = "Enter Email">
						<input class="input100" type="text" name="phone" placeholder="Phone" value="{{ old('phone')}}">
						<span class="focus-input100" data-placeholder="&#xf2c8;"></span>
					
                    </div>
                    <span style="color: red;">  {{$errors->first('pass')}}</span>
					<div class="wrap-input100 validate-input" data-validate="Enter password">
						<input class="input100" type="password" name="pass" placeholder="Password">
						<span class="focus-input100" data-placeholder="&#xf191;"></span>
					
                    </div>
                    <span style="color: red;">  {{$errors->first('con_pass')}}</span>
					<div class="wrap-input100 validate-input" data-validate="Enter password">
						<input class="input100" type="password" name="con_pass" placeholder="Confirm Password">
						<span class="focus-input100" data-placeholder="&#xf191;"></span>
					 </div>
                    <span style="color: red;">  {{$errors->first('image')}}</span>
                    <div class="wrap-input100 validate-input" data-validate="Enter password">
						<input class="input100" type="file" name="image" placeholder="">
						<span class="focus-input100" data-placeholder="&#xf222;"></span>
					
                    </div>
                   <input type="hidden" name="_token" id="csrf-token" value="{{ Session::token() }}" />
					<div class="contact100-form-checkbox">
						<input class="input-checkbox100" id="ckb1" type="checkbox" name="remember-me">
						<label class="label-checkbox100" for="ckb1">
							I Agree to the terms and Conditions
						</label>
					</div>

					<div class="container-login100-form-btn">
						<button class="login100-form-btn">
							SignUp
						</button>
					</div>

					<div class="text-center p-t-90">
						<a class="txt2" href="#">
							Do you have an Account? Login Now!
						</a>
					</div>
				</form>
			</div>
		</div>
	</div-->

 <section id="page-bg">

        <section id="register-body-outer">

            <div class="register-inner container">

                <h2 class=" text-center">Edit your Rivvirr Account</h2>
              
                <div class="">
                 
                    <div class="col-md-6 offset-md-3 pt-4">
                        <form class="row registration-form-outer p-4"  method="post" action="{{url('/editprofile',$data->id)}}" enctype="multipart/form-data">
                            <span style="color: red;">	{{$errors->first('first_name')}}</span>
                            <div class="col-md-6 form-group">
                                <label for="">First Name</label>
                                <input type="text" class="form-control" name="first_name" value="{{$data->first_name}}">
                            </div>
                            <span style="color: red;">	{{$errors->first('last_name')}}</span>
                            <div class="col-md-6 form-group">
                                <label for="">last Name</label>
                                <input type="text" class="form-control" name="last_name" value="{{$data->last_name}}">
                            </div>
                            <span style="color: red;">	{{$errors->first('useremail')}}</span>
                            <div class="col-md-12 form-group">
                                <label for="">Email Address</label>
                                <div class="input-outer">
                                        <input type="text" class="form-control" name="useremail" value="{{$data->email}}">
                                   
                                    <i class="fa fa-check green-text input-icon"></i>
                                  
                                </div>
                            </div>
                            <span style="color: red;">	{{$errors->first('university')}}</span>
                            <div class="col-md-12 form-group">
                                <label for="">University Selection</label>
                                <select name="university" id="" class="form-control">
                                    
                                    <option <?php if($data->university == 'CU' ){ echo 'selected' ;} ;?> value="CU">CU</option>
                                    <option <?php if($data->university == 'punjab_university' ){ echo 'selected' ;} ;?> value="punjab_university">Punjab university</option>
                                    <option <?php if($data->university == 'patiala_university' ){ echo 'selected' ;} ;?> value="patiala_university">Patiala University</option>
                                </select>
                            </div>
                            <span style="color: red;">	{{$errors->first('major')}}</span>
                            <div class="col-md-12 form-group">
                                <label for="">Major Selection</label>
                                <input type="text" class="form-control" name="major" value="{{$data->major}}">
                            </div>
                            <span style="color: red;"> {{$errors->first('old_pass')}} {{session('worng_pass')}}</span>
                            <div class="col-md-12 form-group">
                                <label for="">Old Password</label>
                                <input type="password" class="form-control" name="old_pass">
                            </div>
                            <div class="col-md-12 form-group">
                                <label for="">new Password</label>
                                <input type="password" class="form-control" name="new_pass">
                            </div>
                             <input type="hidden" name="_token" id="csrf-token" value="{{ Session::token() }}" />
                            <div class="col-md-4">
                                <button class="btn btn-success w-100">Submit</button>
                            </div>

                        </form>
                    </div>

                </div>

            </div>


        </section>






@include('frontend/includes/footer')