@include('frontend/includes/header')

    <!-----------------------------------body section--------------------------->
    <section id="page-bg">
    <section id="login-body">
        <div class="container">
            <div class="login-form-outer">
                <div class="row">
                    <div class="col-md-12 text-center pb-5">
                        <h1 class="font-weight-bold">Login</h1>
                    </div>
                    <div class="col-md-8 offset-md-2 py-5 login-form-inner">
                        <form class="col-md-10 offset-md-1" method="post" action="{{url('/employer/login')}}">
                         @if(Session::has('error'))
                          <div class="alert alert-danger" role="alert">
                          {{Session::get('error')}}
                         </div>
                         @endif
                            <div class="row align-items-center justify-content-between">
                                <span style="color: red;">{{$errors->first('username')}}</span>
                                <div class="col-md-12 form-group">
                                    <label for="Email">Email</label>
                                    <input type="text" class="form-control" placeholder="abc@gmail.com"  name="username" value="{{ old('username')}}">
                                </div>
                                 <span style="color: red;">{{$errors->first('password')}}</span>
                                <div class="col-md-12 form-group">
                                    <label for="password">Password</label>
                                    <input type="password" placeholder="************" class="form-control"  name="password">
                                </div>
                                  <input type="hidden" name="_token" id="csrf-token" value="{{ Session::token() }}" />
                                <div class="col-md-6"> 
                                <button class="btn btn-success px-5 font-weight-normal" type="submit">Login</button>
                                </div>
                                <div class="col-md-6 text-right">
                                    <p class="mb-0 grey-500">forget Password?</p>
                                </div>
                            </div>
                        </form> 
                    </div>
                    <div class="col-md-12 pt-5 text-center ">
                        <p class=" grey-500">No Account Yet? <button class="btn btn-success px-4 py-1" onclick="window.location.href='/signup'">Sign Up</button></p>
                    </div>
                </div>
            </div>
        </div>
    </section>
@include('frontend/includes/footer')