@include('admin.includes.header')
<!-- MAIN CONTENT-->
            <div class="main-content">
                <div class="section__content section__content--p30">
                    <div class="container-fluid">
                         <div class="row">
                            <div class="col-md-12">
                                <div class="overview-wrap">
                                    <h2 class="title-1">Manage Employers</h2>
                                    <a href="{{ url('/admin/employers/add') }}"><button class="au-btn au-btn-icon au-btn--green">
                                        <i class="zmdi zmdi-plus"></i>add employer</button></a>
                                </div>
                            </div>
                        </div>
                                <!-- DATA TABLE-->
            <section class="p-t-20">
                <div class="container">
                    <div class="row">
                        
                            <div class="col-md-12">
                                <!-- DATA TABLE-->
								
                                <div class="table-responsive m-b-40">
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
                                    <table class="table table-borderless table-data3">
                                        <thead>
                                            <tr>
                                                <th>Sr.No</th>
												<th>Name</th>
                                                <th>Category</th>                                             
                                                <th>Email</th>
                                                <th>Logo</th>
                                                <th>Make home video</th>
                                                <th>Action</th>
                                              
                                            </tr>
                                        </thead>
                                        <tbody>
										
										@foreach($datas as $key => $data)
                                            <tr>
                                                <td>{{ $key+1 }}</td>												
                                                <td>{{ $data->name }}</td>
												<td>{{ $data->category }}</td>
                                                <td>{{ $data->email }}</td>
                                                <td> 
                                            <img width="100px" src="{{ URL::asset('/uploads/employers/logo/'.$data->logo) }}"/>
										</td>
                                            <td><input type="radio" id="video_<?php echo $data->id; ?>" name="video" value="home_vedio" class="make-home-video" <?php if(!empty($data->home_page_video)) { echo 'checked' ;} ;?> ></td>  
                                                <td>  <div class="table-data-feature">
                                                    
                                                    <a href="{{ url('/admin/employers/edit/'.$data->id) }}"><button class="item" data-toggle="tooltip" data-placement="top" title="Edit">
                                                        <i class="zmdi zmdi-edit"></i>
                                                    </button></a>&nbsp;&nbsp;
                                                    <a onclick="return confirm('Are you sure want to delete it? ');" href="{{ url('/admin/employers/delete/'.$data->id) }}"> <button type="button" class="item" data-toggle="tooltip" data-placement="top"  title="Delete">
                                                        <i class="zmdi zmdi-delete"></i>
                                                    </button></a>
                                                   
                                                </div></td>
                                            </tr>
											<script>
        
                                        jQuery("#video_<?php echo $data->id; ?>").click(function(){
                                            
                                         var vdata=document.getElementById('video_<?php echo $data->id; ?>').value;                

                                             jQuery.ajax({
                                               type:"get",
                                                url:"{{ url('/admin/employers/home_video/'.$data->id)}}",
                                                data:{vdata:vdata}, 
                                                success:function(result){
                                                  // alert(vdata);
                                                }   



                                            });

                                           });

                                        </script>   
                                            
                                         @endforeach
										
                                        </tbody>
                                    </table>
                                </div>
                                <!-- END DATA TABLE-->
                            </div>
                        
                    </div>
                </div>
            </section>
			</div>
      
                    
                    

 @include('admin.includes.footer')   