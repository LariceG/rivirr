@include('admin.includes.header')
<!-- MAIN CONTENT-->
            <div class="main-content">
                <div class="section__content section__content--p30">
                    <div class="container-fluid">
                        <div class="row">
                        
                            <div class="col-lg-12">
                                <div class="card">
                                    <div class="card-header">
                                          <div class="overview-wrap">
                                    <h2 class="title-1">Add Employer</h2>
                                    <a href="{{ url('/admin/employers') }}"><button class="au-btn au-btn-icon au-btn--green">
                                     Back</button></a>
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
									<form autocomplete="off" action="{{ url('/admin/employers/insert') }}" method="post" enctype="multipart/form-data">
                                    <div class="card-body card-block">
									<div class="form-group">
                                            <label for="name" class=" form-control-label">Employer Name</label>
                                            <input type="text" id="name" name="name" placeholder="Enter employer name" value="{{ old('name') }}" class="form-control">
                                        </div>
										@if ($errors->first('name'))
										<label class="error">
										{{ $errors->first('name') }}
										</label>
										@endif
										<div class="form-group">
                                            <label for="ceo" class=" form-control-label">Ceo Name</label>
                                            <input type="text" id="ceo" name="ceo" placeholder="Enter ceo name" value="{{ old('ceo') }}" class="form-control">
                                        </div>
										@if ($errors->first('ceo'))
										<label class="error">
										{{ $errors->first('ceo') }}
										</label>
										@endif
											
                                
										 <div class="form-group">
                                            <label for="name" class=" form-control-label">Email</label>
                                            <input type="text" id="name" name="email" placeholder="Enter employer email" value="{{ old('email') }}" class="form-control">
                                        </div>
										@if ($errors->first('email'))
										<label class="error">
										{{ $errors->first('email') }}
										</label>
										@endif
										 <div class="form-group">
                                            <label for="name" class=" form-control-label">Phone</label>
                                            <input type="number" id="name" name="phone" placeholder="Enter employer phone" value="{{ old('phone') }}" class="form-control">
                                        </div>
										@if ($errors->first('phone'))
										<label class="error">
										{{ $errors->first('phone') }}
										</label>
										@endif
											<div class="form-group">
                                            <label for="company_size" class=" form-control-label">Company Size</label>
                                            <input type="text" id="company_size Size" name="company_size" placeholder="Enter company size" value="{{ old('company_size') }}" class="form-control">
                                        </div>
										@if ($errors->first('company_size'))
										<label class="error">
										{{ $errors->first('company_size') }}
										</label>
										@endif 
										<div class="form-group">
										<label for="name" class=" form-control-label">Headquater Address</label>
										<input type="text" id="name" name="headquater" placeholder="Enter headquater address" value="{{ old('headquater') }}" class="form-control autoheadquater">
                                        </div>
										@if ($errors->first('headquater'))
										<label class="error">
										{{ $errors->first('headquater') }}
										</label>
										@endif
                                        <div class="form-group">
                                            <label for="logo" class=" form-control-label">Logo</label>
                                            <input type="file" id="logo" name="logo" class="form-control">                     
										</div>
										@if ($errors->first('logo'))
										<label class="error">
										{{ $errors->first('logo') }}
										</label>
										@endif
										<div class="form-group">
										<label for="video" class=" form-control-label">Video</label>
                                         
										<input type="text" id="video" name="video" placeholder="Enter video url" value="{{ old('video') }}" class="form-control">
                                      <label>You Tube</label>
                                       <input type="radio" value="youtube" name="video_type">
                                         <label>Vimeo</label>
                                       <input type="radio" value="vimeo" name="video_type">
                                        </div>
										@if ($errors->first('video'))
										<label class="error">
										{{ $errors->first('video') }} 
										</label>
										@endif
										<!------Radio button validation---------------->
											@if ($errors->first('video_type'))
										<label class="error">
										{{ $errors->first('video_type') }} 
										</label>
										@endif
										<div class="form-group">
                                            <label for="title" class=" form-control-label">Title</label>
                                            <input type="text" id="title" name="title" placeholder="Enter title" value="{{ old('title') }}" class="form-control">
                                        </div>
										@if ($errors->first('title'))
										<label class="error">
										{{ $errors->first('title') }}
										</label>
										@endif
                                        
										<div class="form-group">
                                            <label for="website_link" class=" form-control-label">Website Link</label>
                                            <input type="text" id="website_link" name="website_link" placeholder="Enter website link" value="{{ old('website_link') }}" class="form-control">
                                        </div>
										@if ($errors->first('website_link'))
										<label class="error">
										{{ $errors->first('website_link') }}
										</label>
										@endif
                                        
                                        
                                        	<div class="form-group">
                                            <label for="website_link" class=" form-control-label">Apply Now</label>
                                            <input type="text" id="apply_now" name="apply_now" placeholder="Enter website link" value="{{ old('website_link') }}" class="form-control">
                                        </div>
										@if ($errors->first('apply_now'))
										<label class="error">
										{{ $errors->first('apply_now') }}
										</label>
										@endif
                                        
                                        
                                        
                                        
                                        
                                        <div class="form-group">									

										<label for="multiple-select" class=" form-control-label">Select Industries</label>

										<select name="industry[]" id="industry" multiple="" class="form-control">
                                     	@foreach($industries as $industry)

										<option value="{{$industry->name }}">{{$industry->name }}</option>

										@endforeach;

										</select>										

                                        </div>
										@if ($errors->first('industry'))
										<label class="error">
										{{ $errors->first('industry') }}
										</label>
										@endif
                                        
                                        
                                        
                                        
                                        
                                             <div class="form-group">                                               

										<label for="multiple-select" class=" form-control-label">Select Category</label> 
                                            <select name="category" id="category" class="form-control" multiple="">

										<option value="">Please select</option>
										
										@foreach($categories as $key => $category)
										<option value="{{ $category->name }}">{{ $category->name }}</option>
										@endforeach;
										</select>                                               
                                        </div>
										@if ($errors->first('category'))
										<label class="error">
										{{ $errors->first('category') }}
										</label>
										@endif
										
										<div class="form-group">									
										<label for="multiple-select" class=" form-control-label">Select Majors</label>
										<select name="majors[]" id="majors" multiple="" class="form-control">
										@foreach($majors as $key => $major)
										<option value="{{ $major->name }}">{{ $major->name }}</option>
										@endforeach;
										</select>										
                                        </div>
										@if ($errors->first('majors'))
										<label class="error">
										{{ $errors->first('majors') }}
										</label>
										@endif
										<div class="form-group">										
											<label for="multiple-select" class=" form-control-label">Select Recruits</label>																			
											<select name="recruits[]" id="recruits" multiple="" class="form-control">
											@foreach($recruits as $key => $recruit)
											<option value="{{ $recruit->name }}">{{ $recruit->name }}</option>
											@endforeach;
											</select>
										
                                        </div>
										@if ($errors->first('recruits'))
										<label class="error">
										{{ $errors->first('recruits') }}
										</label>
										@endif
                                        
										<div class="form-group">										
											<label for="perks" class=" form-control-label">Select Perks</label>																			
											<select name="perks[]" id="perks" multiple="" class="form-control">
											@foreach($perks as $key => $perk)
											<option value="{{ $perk->name }}">{{ $perk->name }}</option>
											@endforeach;
											</select>
										@if ($errors->first('perks'))
										<label class="error">
										{{ $errors->first('perks') }}
										</label>
										@endif
                                        </div>
										
                                        
                                        
                                        
										
                                        <label>Diversity in Leadership</label>
                                        <select class="form-control" name="diversity" style="font-family:'FontAwesome', Helvetica;">
                                        <option value="no rating">No data</option>
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                        
                                        
                                        </select>
                                        
                                  
                                        
                                        <label>Women in leadership</label>
                                        <select class="form-control" name="Women_in_leadership" style="font-family:'FontAwesome', Helvetica;">
                                            
                                        <option value="no rating">No data</option>
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                        
                                        </select>
                                        
                                      
                                        
                                        <label>New Grad Support</label>
                                        <select class="form-control" name="New_Grad_Support" style="font-family:'FontAwesome', Helvetica;">
                                            
                                        <option value="no rating">No data</option>
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                        </select>
                                        
                                    
                                        
                                        
                                        
                                        
                                        <label>Sustainability</label>
                                        <select class="form-control" name="Sustainability" style="font-family:'FontAwesome', Helvetica;">
                                            
                                        <option value="no rating">No data</option>
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                        
                                        </select>
                                        
                                      
                                        
                                    
                                        
                                        <label>Giving Back </label>
                                        <select class="form-control" name="Giving_Back" style="font-family:'FontAwesome', Helvetica;">
                                            
                                        <option value="no rating">No data</option>
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                        
                                        </select>
								
                                        
                                            
                                       
                                             <div class="form-group">
                                            <label for="title" class=" form-control-label">Price</label>
                                            <input type="text" id="price" name="price" placeholder="Enter Price" value="{{ old('price') }}" class="form-control">
                                        </div>
										@if ($errors->first('price'))
										<label class="error">
										{{ $errors->first('price') }}
										</label>
										@endif
                                        
                                           <div class="form-group">
                                            <label for="title" class=" form-control-label">Skill</label>
                                            <input type="text" id="skill" name="skill" placeholder="Enter skills" value="{{ old('skill') }}" class="form-control">
                                        </div>
										@if ($errors->first('skill'))
										<label class="error">
										{{ $errors->first('skill') }}
										</label>
										@endif
                                        
                                        
                                        
                                        
                                        
                                        <div class="form-group">
										<label for="name" class=" form-control-label">Impact and Accomplishments</label>
										<textarea name="impact_accomplishment" id="textarea-input" rows="9" placeholder="enter Impact and Accomplishments" class="form-control">{{ old('impact_accomplishment') }}</textarea>
                                        </div>
										@if ($errors->first('impact_accomplishment'))
										<label class="error">
										{{ $errors->first('impact_accomplishment') }}
										</label>
										@endif
										<div class="form-group">
										<label for="name" class=" form-control-label">University Recruiting Program</label>
										<textarea name="university_recruiting_program" id="textarea-input" rows="9" placeholder="enter university recruiting program" class="form-control">{{ old('university_recruiting_program') }}</textarea>
                                        </div>
										@if ($errors->first('university_recruiting_program'))
										<label class="error">
										{{ $errors->first('university_recruiting_program') }}
										</label>
										@endif
										<div class="form-group">
										<label for="name" class=" form-control-label">Other Initiatives</label>
										<textarea name="other_initiatives" id="textarea-input" rows="9" placeholder="enter other initiatives" class="form-control">{{ old('other_initiatives') }}</textarea>
                                        </div>
										@if ($errors->first('other_initiatives'))
										<label class="error">
										{{ $errors->first('other_initiatives') }}
										</label>
										@endif
										<div class="form-group">
										<label for="name" class=" form-control-label">Internship Program</label>
										<textarea name="internship_program" id="textarea-input" rows="9" placeholder="enter internship program" class="form-control">{{ old('internship_program') }}</textarea>
                                        </div>
										@if ($errors->first('internship_program'))
										<label class="error">
										{{ $errors->first('internship_program') }}
										</label>
										@endif
										  
                                        <div class="form-group">
										<label for="name" class=" form-control-label">About</label>
										<textarea name="about" id="textarea-input" rows="9" placeholder="enter about" class="form-control">    {{ old('about') }}</textarea>
                                        </div>
                                        	@if ($errors->first('about'))
										<label class="error">
										{{ $errors->first('about') }}
										</label>
										@endif
                                        
                                        
                                        
                                    	<div class="form-group" id='location'>
                                        
										<div id="field">
											<div id="field0">
                                            <input type="text" name="location[]" placeholder="Enter Location" class="form-control autocomplete">
                                                               
										</div>
										</div>
										</div>
                                        
                                  
                                        
                                        
                                        
                                       <div class="form-group">
									  <div class="col-md-4">
										<button type="button" id="add-more" name="add-more" class="btn btn-primary">Add More</button>
									  </div>
									</div>
                                     	<div class="form-group">
                                            <label for="images" class=" form-control-label">Gallery Images Multiple(Optional)</label>
                                            <input type="file" id="images" name="images[]" multiple class="form-control">                     
										</div>
										<input type="hidden" name="_token" id="csrf-token" value="{{ Session::token() }}" />
									       <div class="card-footer">
										   <input type="hidden" id="latitude" name="latitude" value="" class="form-control">
										   <input type="hidden" id="longitude" name="longitude" value="" class="form-control">
                                        <button type="submit" class="btn btn-primary btn-sm">
                                            <i class="fa fa-dot-circle-o"></i> Submit
                                        </button>
                                        <a href="{{ url('/admin/employers') }}"><button type="button" class="btn btn-danger btn-sm">
                                            <i class="fa fa-ban"></i> Cancel
                                        </button></a>
                                    </div>
                                </div>
                               </form>
                               
                                
                            </div>
                </div>


                            
 @include('admin.includes.footer')   