@include('frontend/includes/header');

    <!-----------------------------------body section--------------------------->
    <section id="search-page">
         <section class="search-heading ">
             <div class="container text-center">
                 <h1 class="text-white font-weight-normal">Search Results</h1>
             </div>
         </section>
         <!--serach input-->
         <section class="search-input py-5">
             <div class="container">
                 <div class="col-md-8 offset-md-2 ">
                     <form autocomplete="off" action="search">
                         <div class="search-input-outers d-flex flex-wrap justify-content-between">
                         <div class="col-md-6  ">
                            <label for="" class="search-input-label">
                                   <i class="fa fa-search search-icon"></i> <input type="text" name="employee"  id="search_input" class=" search-input-inner" value="{{$search_value}}" placeholder="Search by Employer"><i class="fa fa-times clear-search" id="search_cancel"></i>
                            </label>
                         </div>
                         <div class="col-md-6  ">
                            <label for="" class="search-input-label">
                                   <i class="fa fa-search search-icon"></i> <input type="text" name="location"  id="location_input" class=" search-input-inner locationSearch" value="{{$location}}" placeholder="Search by Location">
                                   <input type="hidden" id="latitude" name="latitude" value="{{$latitude}}" class="form-control">
							                      <input type="hidden" id="longitude" name="longitude" value="{{$longitude}}" class="form-control">
                                   <i class="fa fa-times clear-search" id="location_cancel"></i>
                            </label>
                         </div>
                         </div>
                         <input style="opacity:0;position:absolute" type="submit">
                     </form>
                 </div>
             </div>             
         </section>
         <!--search-result-->
         <section class="search-result">
             <div class="col-md-11 ">
                 <div class="row">
                     <div class="col-md-3 pl-0">
                        
                            <div class="list-group left-side-bar-outer">
                              <div class="list-group-item left-side-bar py-3">
                                <div class="position-absolute w-100">
                                    <span class="h6 grey-500 mb-0 pl-3 ">Department</span> <i class="fa fa-caret-down panel-caret-down mt-4 mr-4" aria-hidden="true"></i>
                                </div>
                                <select name="" id="" class="form-control mt-3 dark">
                                  <option value=""><span class="h4 dark">Design</span></option>
                                  <option value="">2</option>
                                  <option value="">3</option>

                                </select>
                              </div>
                              <div class="list-group-item left-side-bar py-3">
                                  <div class="position-absolute w-100">
                                      <span class="h6 grey-500 mb-0 pl-3 ">Project Type</span> <i class="fa fa-caret-down panel-caret-down mt-4 mr-4" aria-hidden="true"></i>
                                  </div>
                                  <select name="" id="" class="form-control mt-3 dark">
                                    <option value=""><span class="h4 dark">Cinema</span></option>
                                    <option value="">2</option>
                                    <option value="">3</option>
  
                                  </select>
                                </div>
                                <div class="list-group-item left-side-bar py-3">
                                    <div class="position-absolute w-100">
                                        <span class="h6 grey-500 mb-0 pl-3 ">Position</span> <i class="fa fa-caret-down panel-caret-down mt-4 mr-4" aria-hidden="true"></i>
                                    </div>
                                    <select name="" id="" class="form-control mt-3 dark">
                                      <option value=""><span class="h4 dark">Project Designer</span></option>
                                      <option value="">2</option>
                                      <option value="">3</option>
    
                                    </select>
                                  </div>
                                  <div class="list-group-item left-side-bar py-3">
                                      <div class="position-absolute w-100">
                                          <span class="h6 grey-500 mb-0 pl-3 ">Skills</span> <i class="fa fa-caret-down panel-caret-down mt-4 mr-4" aria-hidden="true"></i>
                                      </div>
                                      <select name="" id="" class="form-control mt-3 dark">
                                        <option value=""><span class="h4">Photoshop</span></option>
                                        <option value="">2</option>
                                        <option value="">3</option>
      
                                      </select>
                                    </div>
                                    <div class="list-group-item left-side-bar py-3 dark">
                                        <div class="position-absolute w-100">
                                            <span class="h6 grey-500 mb-0 pl-3 ">Location</span> <i class="fa fa-caret-down panel-caret-down mt-4 mr-4" aria-hidden="true"></i>
                                        </div>
                                        <select name="" id="" class="form-control mt-3">
                                          <option value=""><span class="h4 ">United States</span></option>
                                          <option value="">2</option>
                                          <option value="">3</option>
        
                                        </select>
                                      </div>
                                      <div class="panel-outer">
                                          <div class="panel-group">
                                              <div class="panel panel-default">
                                                <div class="panel-heading">
                                                  <div class="panel-title search-checkbox-outer">
                                                    <input type="checkbox" name="" id=""> <span class="dark h4 ml-2">Work Remotly</span>
                                                  </div>
                                                </div>
                                              </div>
                                            </div>
                                      </div>
                                      <div class="list-group-item left-side-bar py-3">
                                          <div class="position-absolute w-100">
                                              <span class="h6 grey-500 mb-0 pl-3 ">Experience</span> <i class="fa fa-caret-down panel-caret-down mt-4 mr-4" aria-hidden="true"></i>
                                          </div>
                                          <select name="" id="" class="form-control mt-3 dark">
                                            <option value=""><span class="h4 dark">7 Years Above</span></option>
                                            <option value="">2</option>
                                            <option value="">3</option>
          
                                          </select>
                                        </div>
                            </div>
                                  <!--panel7>
                         <div class="panel-outer">
                          <div class="panel-group">
                              <div class="panel panel-default">
                                <div class="datepicker-here" data-language='en'></div>                
                              </div>
                            </div>
                      </div>
                        <!--panel end-->
                     </div>
                     <!--right section-->
                     <div class="col-md-9">
                         <div class="search-right-heading py-4">
                             <h3 class=""> {{count($employees)}} Results found</h3>
                         </div>
                         <!--searched employers list-->
                   <div class="row">
                   
                     @foreach($employees as $employee)
                    
                        <div class="col-md-4 mb-4 px-1 ">                                
                                    <div class="searched-employers-outer">
                                        <div class="col-md-4"> 
                                            <img src="{{url('public/uploads/employers/logo/'.$employee->logo)}}" class="search-user-img" alt=""> 
                                         </div>
                                         <div class="col-md-8 pl-0  pt-2 " >
                                             <h5 class="dark fw-500 link" onclick="window.location.href='/profile/{{$employee->id}}'">{{$employee->name}}</h5>
                                             <p class="mb-1">Industry:<span class="fw-500">{{$employee->industry}}</span> </p>
                                              <?php    
                                                $total_rating = $employee->diversity_in_leadership+$employee->women_in_leadership+$employee->sustainability+$employee->new_grad_support+$employee->giving_back;
                                                 $avrage=$total_rating/5;
                                               
                                            ?>
                                             @if(round($avrage) == '1')
                                             <p><img src="{{ url('public/assets/frontend/images/logo.png')}}" class="rating-icon w-15" alt=""> <small>New Grad Rating</small></p>
                                             @endif
                                             @if(round($avrage) == '2')
                                             <p><img src="{{ url('public/assets/frontend/images/logo.png')}}" class="rating-icon w-15" alt=""> <img src="{{ url('public/assets/frontend/images/logo.png')}}" class="rating-icon w-15" alt=""> <small>New Grad Rating</small></p>
                                             @endif
                                             @if(round($avrage) == '3')
                                             <p><img src="{{ url('public/assets/frontend/images/logo.png')}}" class="rating-icon w-15" alt=""> <img src="{{ url('public/assets/frontend/images/logo.png')}}" class="rating-icon w-15" alt=""> <img src="{{ url('public/assets/frontend/images/logo.png')}}" class="rating-icon w-15" alt=""> <small>New Grad Rating</small></p>
                                             @endif

                                         
                                         </div>
                                         <div class="col-md-12">
                                             <p class="font-weight-bold border-tb py-2 fs-16 text-center my-2 line-clamp-1">{{$employee->perks}}</p>
                                         </div>
                                         <div class="searched-employer-description col-md-12">
                                             <h5 class="font-weight-bold">About Employer</h5>
                                             <p class="fw-500 fs-14 line-clamp-3">{{$employee->about}}</p>
                                         </div>
                                         <div class="searched-employer-gallery col-md-12">
                                         <h5 class="font-weight-bold w-100">Gallery</h5>
                                          <div class="searched-multiple-images-outer w-100 d-flex flex-wrap">
                                          <?php   $gallery_images=DB::table('employer_gallery')->where('employer_id',$employee->id)->get();  ?>
                                            @foreach($gallery_images as $images)
                                            <div class="img-outer-search mt-2">
                                                 <img src="{{url('public/uploads/employers/gallery/'.$images->image)}}" alt="">
                                            </div>
                                            @endforeach     
                                            </div>             
                                         </div>
                                         <div class="col-md-12 mt-3">
                                             <a href="{{$employee->apply_now}}" target="_blank"><button class="btn btn-success btn-large w-100"> Apply Now</button></a>
                                         </div>
                                    </div>
                            </div>
                     @endforeach
                    
    
                   </div>
                     </div>
                 </div>
             </div>
         </section>
    </section>

   
  
@include('frontend/includes/footer')
