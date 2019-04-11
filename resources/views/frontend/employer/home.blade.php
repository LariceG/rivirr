@include('frontend/includes/header')
  <!-----------------section1-------------------->
  <section id="section1">
   @if(!empty($home_video))
  <iframe width="100%" height="100%" src="{{$home_video->video}}" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
    @else

     <iframe width="100%" height="100%" src="http://commondatastorage.googleapis.com/gtv-videos-bucket/sample/BigBuckBunny.mp4" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
     @endif
     <!--video height="100%" width="100%" controls="" loop="" autoplay="" style="object-fit: cover;">
       <?php
          $video_data=DB::table('employers')->where('home_page_video','home_vedio')->first();
        
         ?>
          @if($video_data)
         <source src="{{$video_data->video}}" type="video/mp4">
         @else
        <source src="http://commondatastorage.googleapis.com/gtv-videos-bucket/sample/BigBuckBunny.mp4" type="video/mp4"> 
       @endif
  
      </video--> 
      @if(!empty($video_data))
    <div class="play-btn">
      <img src="{{ url('/public/assets/frontend/images/play-button.png')}}" alt="">
      <div class="view-profile-btn text-center mt-5">
        <button class="btn" onclick="window.location.href='/profile/{{$video_data->id}}'">
          VIEW PROFILE
        </button>
      </div>
    </div>
    @endif
  </section>
  <!-----------------------find-emloyers form------------------------->
  <section id="find-emloyers">
    <div class="container">
    <div class="col-md-12">
        <form action="search" class="form-group" autocomplete="off" method="get">
          <div class="row align-items-center">
            <div class="col-md-5 ">
              <input type="text" name="employee" id="" class="form-control find-employer-input px-4" placeholder="Search Employers">
            </div>
<div class="col-md-5 ">
              <input type="text" name="location" id="location" class="form-control find-employer-input px-4 locationSearch" placeholder="Search By Location">
              <input type="hidden" id="latitude" name="latitude" value="" class="form-control">
							<input type="hidden" id="longitude" name="longitude" value="" class="form-control">
            </div>
            <div class="col-2">
              <button type="submit" class="btn bg-green py-3 px-3 find-employer-search-btn"><img src="http://www.rivirr.com/public/assets/frontend/images/search-icon.png" class="icon-search" alt="" id="search_btn"></button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </section>
  <!-------------------------------Best Employers For New Grad SupportBest--------------------------->



<section id="section3">
    <div class="container">
      <h2 class="font-weight-bold">Best Employers For New Grad SupportBest</h2>
      <section class="center slider pb-5 pt-3">
      
          @foreach($new_grad_support as $data)
          <div class="top-eco-friendly-employer" onclick="window.location.href='/profile/{{$data->id}}'">
          <div class="top-employer-content text-center pb-2">
            <img src="{{ url('/public/uploads/employers/logo/'.$data->logo)}}" alt="" class="border-round">
            <div class="top-employer-name text-center">
              <h5 class="font-weight-bolder pt-3 mb-0">{{$data->name}}</h5>
              <p class="mb-2">{{$data->title}}</p>
              <img src="{{ url('/public/assets/frontend/images/3img.png')}}" class="img-auto mx-auto" alt="">
            </div>
          </div>
        </div>
        @endforeach
      </section>
    </div>
  </section>  

 <!--------Best Employers For Women In Leadership-------------------->
  <section id="section4">
    <div class="container">
      <h2 class="font-weight-bold">Best Employers For Women In Leadership</h2>
      <section class="autoplay slider py-3">
          @foreach($women_in_leadership as $data)
        <div class="top-employers-outer" onclick="window.location.href='/profile/{{$data->id}}'">
          <div class="top-employers-inner row align-items-center justify-content-between">
            <div class="top-employers-img">
              <img src="{{ url('/public/uploads/employers/logo/'.$data->logo)}}" alt="">
            </div>
            <div class="top-employer-name ">
              <h5 class="font-weight-bolder  mb-0">{{$data->name}}</h5>
              <p class="mb-2 fs-10 font-weight-bold">{{$data->title}} <img src="{{ url('/public/assets/frontend/images/3img.png')}}" alt="" class="top-employ-stars"></p>
            </div>
          </div>
        </div>
       @endforeach
      </section>
    </div>
  </section>
  
  
  <!-------------------------Best Employers for Giving Back-------------------->
  
  
<section id="section3">
    <div class="container">
      <h2 class="font-weight-bold">Best Employers for Giving Back</h2>
      <section class="center slider pb-5 pt-3">
      
          @foreach($giving_back as $data)
          <div class="top-eco-friendly-employer" onclick="window.location.href='/profile/{{$data->id}}'">
          <div class="top-employer-content text-center pb-2">
            <img src="{{ url('/public/uploads/employers/logo/'.$data->logo)}}" alt="" class="border-round">
            <div class="top-employer-name text-center">
              <h5 class="font-weight-bolder pt-3 mb-0">{{$data->name}}</h5>
              <p class="mb-2">{{$data->title}}</p>
              <img src="{{ url('/public/assets/frontend/images/3img.png')}}" class="img-auto mx-auto" alt="">
            </div>
          </div>
        </div>
        @endforeach
      </section>
    </div>
  </section>
  
  
    <!-------------------------Best Employers for Diversity in Leadership-------------------->
  
   <section id="section5">
    <div class="container">
      <h2 class="font-weight-bold">Best Employers for Diversity in Leadership</h2>
      <section class="autoplay slider py-3">
          @foreach($diversity_in_leadership as $data)
        <div class="top-employers-outer" onclick="window.location.href='/profile/{{$data->id}}'">
          <div class="top-employers-inner row align-items-center justify-content-between">
            <div class="top-employers-img">
              <img src="{{ url('/public/uploads/employers/logo/'.$data->logo)}}" alt="">
            </div>
            <div class="top-employer-name ">
              <h5 class="font-weight-bolder  mb-0 text-left">{{$data->name}}</h5>
              <p class="mb-2 fs-10 font-weight-bold text-left">{{$data->title}} <img src="{{ url('/public/assets/frontend/images/3img.png')}}" alt="" class="top-employ-stars"></p>
            </div>
          </div>
        </div>
       @endforeach
      </section>
    </div>
  </section>
   
     <!-------------------------Top Environmentally Conscious Employers-------------------->
   <section id="section3">
    <div class="container">
      <h2 class="font-weight-bold">Best Environmentally Conscious Employerst</h2>
      <section class="center slider pb-5 pt-3">
      
          @foreach($conscious_employers as $data)
          <div class="top-eco-friendly-employer" onclick="window.location.href='/profile/{{$data->id}}'">
          <div class="top-employer-content text-center pb-2">
            <img src="{{ url('/public/uploads/employers/logo/'.$data->logo)}}" alt="" class="border-round">
            <div class="top-employer-name text-center">
              <h5 class="font-weight-bolder pt-3 mb-0">{{$data->name}}</h5>
              <p class="mb-2">{{$data->title}}</p>
              <img src="{{ url('/public/assets/frontend/images/3img.png')}}" class="img-auto mx-auto" alt="">
            </div>
          </div>
        </div>
        @endforeach
      </section>
    </div>
  </section>
   
   
   
    <!-------------------------Featured Employers-------------------->
  
   <section id="section6">
    <div class="container">
      <h2 class="font-weight-bold">Featured Employers</h2>
      <section class="autoplay slider py-3">
          @foreach($featured_employers as $data)
        <div class="top-employers-outer" onclick="window.location.href='/profile/{{$data->id}}'">
          <div class="top-employers-inner row align-items-center justify-content-between">
            <div class="top-employers-img">
              <img src="{{ url('/public/uploads/employers/logo/'.$data->logo)}}" alt="">
            </div>
            <div class="top-employer-name ">
              <h5 class="font-weight-bolder  mb-0">{{$data->name}}</h5>
              <p class="mb-2 fs-10 font-weight-bold">{{$data->title}} <img src="{{ url('/public/assets/frontend/images/3img.png')}}" alt="" class="top-employ-stars"></p>
            </div>
          </div>
        </div>
       @endforeach
      </section>
    </div>
  </section>   
   
   
  
  
<!-----------------------feataured employers----------------->
  <!-----section id="section4">
    <div class="container">
      <h2 class="font-weight-bold">Featured Employer</h2>
      <div class="row py-5">
        <div class="col-md-12 featured-bg">
          <div class="play-btn">
            <img src="{{ url('/public/assets/frontend/images/play-button.png')}}" alt="">
            <div class="view-profile-btn text-center mt-5">
              <button class="btn  ">
                VIEW PROFILE
              </button>
            </div>
          </div>
        </div>
      </div>
        </div>
  </section---------->
  <!-------------------------Popular Employers--------------------->

<!----section id="section3">
    <div class="container">
      <h2 class="font-weight-bold mb-0">Popular Employers</h2>
      <p class="font-weight-bold">A new selection of <span class="green-text font-weight-bold">Popular employers</span>
      </p>
      <section class="center slider pb-5 pt-3">
          @foreach($all as $data) 
      <?php
        
          $diversity_in_leadership=$data->diversity_in_leadership;
          $women_in_leadership=$data->women_in_leadership;
          $sustainability=$data->sustainability;
          $new_grad_support=$data->new_grad_support;
          $giving_back=$data->giving_back;
          $total=$diversity_in_leadership+$women_in_leadership+$sustainability+$new_grad_support+$giving_back;
          $average=$total/5;
          ?>
         @if($average >= '3')
        <div class="top-eco-friendly-employer" onclick="window.location.href='/profile/{{$data->id}}'">
          <div class="top-employer-content  ">
            <img src="{{ url('/public/uploads/employers/logo/'.$data->logo)}}" alt="" class="border-round">
            <div class="popular-employer-overlay text-white">
              <p class="mb-0">{{$data->title}}</p>
              <h3 class="font-weight-bold">{{$data->name}}</h3>
            </div>
          </div>
        </div>
        @endif
@endforeach
      </section>
    </div>
  </section----->
  
  <!------------------------------specilistes---------------------
  <section id="section5">
    <div class="container">
      <h2 class="font-weight-bold mb-0">Specialists </h2>
      <p class="font-weight-bold">Explorer Some od Rivirr top <span class="green-text font-weight-bold">specialists</span>      </p>
      <section class="center slider pb-5 pt-3">
      @foreach($all as $data)
        <div class="top-eco-friendly-employer">
          <div class="specialist-outer ">
            <div class="row py-2 align-items-center">
              <div class="col-4">
                <div class="specialist-img">
                  <img src="{{ url('/public/uploads/employers/logo/'.$data->logo)}}" alt="">
                </div>
              </div>
              <div class="col-8 px-3">
                <p class="green-text h5 mb-0"></p>
                <p class="fs-12 mb-1">Skilled </p>
                <p class="green-text font-weight-bold fs-12"> <img src="" alt="" style="width:15px;display: inline-block">
                 </p>
              </div>
              <div class="col-12">
                <div class="row justify-content-around">
                  <p class="font-weight-bold">${{$data->price}}<span class="font-weight-light">/hr</span></p>
                  <p>United States</p>
                </div>
              </div>
              <div class="col-12">
                <hr class="m-0">
              </div>
              <div class="col-12 py-2  px-3 specialist-skills">
              
               
                  <span class="mx-1"></span>
              
              </div>
              <div class="col-12 py-2 px-4 specialist-view-btn">
                <button class="btn btn-success " >View Profile</button>
              </div>
            </div>
          </div>
        </div>
     @endforeach
      </section>
    </div>
  </section------>

@include('frontend/includes/footer')

