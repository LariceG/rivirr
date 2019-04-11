@include('frontend/includes/header')

<section id="employer-profile-outer" style="margin-top:120px;">
        <div class="container mt-5 py-5 ">
            <div class="employer-heading">
                <div class="col-md-12">
                    <div class="employer-profile row  align-items-center">
                        <div class="employer-profile-pic-outer">
                            <img src="{{ url('/public/uploads/employers/logo/'.$data->logo)}}" alt="" class="img-responsive">
                        </div>
                        <div class="employer-info">
                            <h1 class="font-weight-bold mb-0 ">{{$data->name}}</h1>
                            <p class="mb-0">{{$data->title}}</p>
                            <a href="{{$data->website_link}}" target="_blank">{{$data->website_link}}</a>
                        </div>
                        <div class="employer-apply-btn">
                            <a href="{{$data->apply_now}}" target="_blank"><button class="btn btn-danger" >
                                Apply Now
                            </button></a>
                        </div> 
                    </div>
                </div>
            </div>
            <!---stars-->
            <div class="col-md-12 mt-5">
                <div class="row">
                    <div class="div-five">
                        <div class="div-five-inner text-center ">
                          <div class="div-five-img">
                              @if($data->diversity_in_leadership =='1')
                               <img src="{{ url('/public/assets/frontend/images/logo.png')}}" alt="" class="rating-icon">
                               @endif
                              @if($data->diversity_in_leadership =='2')
                               <img src="{{ url('/public/assets/frontend/images/logo.png')}}" alt="" class="rating-icon">
                              <img src="{{ url('/public/assets/frontend/images/logo.png')}}" alt="" class="rating-icon">
                               @endif
                              @if($data->diversity_in_leadership =='3')
                              <img src="{{ url('/public/assets/frontend/images/logo.png')}}" alt="" class="rating-icon">
                              <img src="{{ url('/public/assets/frontend/images/logo.png')}}" alt="" class="rating-icon">
                              <img src="{{ url('/public/assets/frontend/images/logo.png')}}" alt="" class="rating-icon">
                              @endif
                              @if($data->diversity_in_leadership == 'no rating') 
                              <?php
                              echo "Not available";
                              ?>
                              @endif
                            
                            </div>
                            <div class="employer-skills mt-2 ">
                                <p class="h5 text-white">Diversity In Leadership</p>
                            </div>                    
                        </div>
                    </div>
                    <div class="div-five">
                            <div class="div-five-inner text-center ">
                                    <div class="div-five-img">
                                @if($data->women_in_leadership =='1')
                               <img src="{{ url('/public/assets/frontend/images/logo.png')}}" alt="" class="rating-icon">
                               @endif
                              @if($data->women_in_leadership =='2')
                               <img src="{{ url('/public/assets/frontend/images/logo.png')}}" alt="" class="rating-icon">
                              <img src="{{ url('/public/assets/frontend/images/logo.png')}}" alt="" class="rating-icon">
                               @endif
                              @if($data->women_in_leadership =='3')
                              <img src="{{ url('/public/assets/frontend/images/logo.png')}}" alt="" class="rating-icon">
                              <img src="{{ url('/public/assets/frontend/images/logo.png')}}" alt="" class="rating-icon">
                              <img src="{{ url('/public/assets/frontend/images/logo.png')}}" alt="" class="rating-icon">
                             @endif 
                             @if($data->women_in_leadership == 'no rating') 
                              
                              <p class="mb0"><?php echo "Not available" ; ?></p>
                              
                              @endif
                                    </div>
                                      <div class="employer-skills mt-2 ">
                                          <p class="h5 text-white">Women In Leadership</p>
                                      </div>
                                  </div>                                
                    </div>
                    <div class="div-five">
                            <div class="div-five-inner text-center ">
                                    <div class="div-five-img">
                                @if($data->new_grad_support =='1')
                               <img src="{{ url('/public/assets/frontend/images/logo.png')}}" alt="" class="rating-icon">
                               @endif
                              @if($data->new_grad_support =='2')
                               <img src="{{ url('/public/assets/frontend/images/logo.png')}}" alt="" class="rating-icon">
                              <img src="{{ url('/public/assets/frontend/images/logo.png')}}" alt="" class="rating-icon">
                               @endif
                              @if($data->new_grad_support =='3')
                              <img src="{{ url('/public/assets/frontend/images/logo.png')}}" alt="" class="rating-icon">
                              <img src="{{ url('/public/assets/frontend/images/logo.png')}}" alt="" class="rating-icon">
                              <img src="{{ url('/public/assets/frontend/images/logo.png')}}" alt="" class="rating-icon">
                              @endif
                              @if($data->new_grad_support == 'no rating') 
                              
                                  <p class="mb0"><?php echo "Not available" ; ?></p>
                           
                                        
                              @endif
                                    </div>
                                      <div class="employer-skills mt-2 ">
                                          <p class="h5 text-white">New Grad Support</p>
                                      </div>
                                  </div>
                    </div>
                    <div class="div-five">
                            <div class="div-five-inner text-center ">
                                    <div class="div-five-img">
                                @if($data->sustainability =='1')
                               <img src="{{ url('/public/assets/frontend/images/logo.png')}}" alt="" class="rating-icon">
                               @endif
                              @if($data->sustainability =='2')
                               <img src="{{ url('/public/assets/frontend/images/logo.png')}}" alt="" class="rating-icon">
                              <img src="{{ url('/public/assets/frontend/images/logo.png')}}" alt="" class="rating-icon">
                               @endif
                              @if($data->sustainability =='3')
                              <img src="{{ url('/public/assets/frontend/images/logo.png')}}" alt="" class="rating-icon">
                              <img src="{{ url('/public/assets/frontend/images/logo.png')}}" alt="" class="rating-icon">
                              <img src="{{ url('/public/assets/frontend/images/logo.png')}}" alt="" class="rating-icon">
                            @endif  
                            @if($data->sustainability == 'no rating') 
                              
                                  <p class="mb0"><?php echo "Not available" ; ?></p>
                           
                                        
                               @endif
                                    </div>
                                      <div class="employer-skills mt-2 ">
                                          <p class="h5 text-white">Sustainablilty</p>
                                      </div>
                                  </div>               
                    </div>
                    <div class="div-five">
                            <div class="div-five-inner text-center ">
                                    <div class="div-five-img">
                                @if($data->giving_back =='1')
                               <img src="{{ url('/public/assets/frontend/images/logo.png')}}" alt="" class="rating-icon">
                               @endif
                              @if($data->giving_back =='2')
                               <img src="{{ url('/public/assets/frontend/images/logo.png')}}" alt="" class="rating-icon">
                              <img src="{{ url('/public/assets/frontend/images/logo.png')}}" alt="" class="rating-icon">
                               @endif
                              @if($data->giving_back =='3')
                              <img src="{{ url('/public/assets/frontend/images/logo.png')}}" alt="" class="rating-icon">
                              <img src="{{ url('/public/assets/frontend/images/logo.png')}}" alt="" class="rating-icon">
                              <img src="{{ url('/public/assets/frontend/images/logo.png')}}" alt="" class="rating-icon">
                             @endif
                                @if($data->giving_back == 'no rating') 
                              
                                  <p class="mb-0"><?php echo "Not available" ; ?></p>
                            
                                        
                               @endif
                                    </div>
                                      <div class="employer-skills mt-2 ">
                                          <p class="h5 text-white">Giving Back</p>
                                      </div>
                                  </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--youtube video section-->
    <section id="ceo-video-link my-5">
        <div class="container py-4">
            <div class="row align-items-center" >
                <div class="col-md-6">
                        <iframe width="90%" height="300" src="{{$data->video}}" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                </div>
                <div class="col-md-6">
                    <p class="h4 font-weight-bold dark-grey">CEO: <span class="h5">{{$data->ceo}}</span></p>
                    <?php $industry_data =explode(',',$data->industry);
                      $i=',';
                    ?>
                  
                    <p class="h5   dark-grey">Industry: @foreach($industry_data as $industries_data) {{$industries_data.$i}} @endforeach </p>
                  
                    <p class="h5  dark-grey">Company Size: {{$data->company_size}}</p>
                    <p class="h5   dark-grey">Headquarters: 
                    <?php
                      $headquater=explode(',',$data->headquater);
                    ?>
                     {{$headquater[0]}}</p>
                </div>
            </div>
        </div>

    </section>
    <!--Twillio listing -->
    <section class="mt-5">
        <div class="container">
            <div class="row justify-content-between">
                <div class="col-md-6">
                    <div class="about-employer">
                        <h3 class="font-weight-bold">About Twilio</h3>
                        <p>{{$data->about}}</p>
                    </div>
                    <div class="about-employer mt-4">
                            <h3 class="font-weight-bold">University Recruiting Program</h3>
                            <p>{{$data->university_recruiting_program}}</p>
                        </div>
                        <div class="about-employer mt-4">
                                <h3 class="font-weight-bold">Internship Program</h3>
                                <p>{{$data->internship_program}}</p>
                            </div>
                            <div class="about-employer mt-4">
                                    <h3 class="font-weight-bold">Other Initiatives</h3>
                                    <p>{{$data->other_initiatives}}</p>
                                </div>
                </div>
                <div class="col-md-6">
                    <div class="shortlist-heading">
                        <h3 class="mb-0">ON 458 SHORTLISTS</h3>
                        
                    </div>
                    <div class="recruiter-from">
                        <h3 class="my-3 font-weight-bold dark-grey">Recruits From</h3>
                        <div class="skills-span">
                            <?php
                            $recruit=explode(",",$data->recruits);
                            ?>
                            @foreach($recruit as $recruits)
                            <span>{{$recruits}}</span>                    
                            @endforeach
                        </div>
                    </div>
                    <br>
                    <div class="recruiter-from">
                            <h3 class="my-3 font-weight-bold dark-grey">Majors</h3>
                            <div class="skills-span">
                               <?php
                            $major=explode(",",$data->majors);
                            ?>
                            @foreach($major as $majors)
                            <span>{{$majors}}</span>                    
                            @endforeach                 
    
                            </div>
                        </div>
                        <br>
                        <div class="recruiter-from">
                                <h3 class="my-3 font-weight-bold dark-grey">Perks & Benefits</h3>
                                <div class="skills-span">
                                 <?php
                            $perks=explode(",",$data->perks);
                            ?>
                            @foreach($perks as $perk)
                            <span>{{$perk}}</span>                    
                            @endforeach    
                                    
                             
                                </div>
                            </div>
                </div>
            </div>
        </div>
    </section>
    <!--section gallery-->
    <section id="gallery " class="my-5">
        <div class="container">
                <div class="section-heading">
                        <h2 class="font-weight-bold my-4">Gallery</h2>
                    </div>
                <section class="center slider">
                        
                    @foreach($gallary as $images)
                    <div>
                          <img src="{{ url('/public/uploads/employers/gallery').'/'.$images->image}}">
                        </div>
                        @endforeach
                      </section>
        </div>

    </section>

    <!--location section-->
    <section class="location my-5">
        <div class="container">
            <div class="section-heading">
                <h2 class="font-weight-bold my-4">Location</h2>
            </div>
                <!--iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d50470.02848603651!2d-122.47270525830065!3d37.75776265293891!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x80859a6d00690021%3A0x4a501367f076adff!2sSan+Francisco%2C+CA%2C+USA!5e0!3m2!1sen!2sin!4v1551248110648" width="100%" height="500" frameborder="0" style="border:0" allowfullscreen></iframe-->
            <div class="multiple-location-outer">
               <?php
                            $location=explode(",",$data->locations);
                            ?>
                            @foreach($location as $location)
                           <span> <i class="fa fa-map-marker"> &nbsp;</i>{{$location}}</span>                    
                            @endforeach                 
    
            
             
            </div>

        </div>
    </section>

  <script type="text/javascript">
    $(".center").slick({
      dots: false,
      infinite: true,
      slidesToShow: 3,
      slidesToScroll: 1
    });
  </script>


   


@include('frontend/includes/footer')