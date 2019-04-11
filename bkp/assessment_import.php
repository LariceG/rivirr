 <!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h4><?php echo $title?></h4>
              </div>
			  <div class="title_right">
                <div class="text-right form-group pull-right top_search ">
                  <div class="input-group">          
				 <a href="<?php echo base_url(); ?>admin/students/assessment/<?php echo $data['id']; ?>"><button class="btn btn-primary">Back</button></a>
				</div>
                   
                  </div>
                </div>
             
            </div>
            <div class="clearfix"></div>

            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                 
                  <div class="x_content">
                    
						<?php if($this->session->flashdata('message')){ ?>
						 <div class="alert alert-success">
							  <?php echo $this->session->flashdata('message'); ?>
							</div>
						<?php } ?>
					 <?php if($this->session->flashdata('error')){ ?>
						
							 <div class="alert alert-danger">
							 <?php echo $this->session->flashdata('error'); ?>
							</div>
						<?php }
							$level = $this->Common_model->get_data_by_id('course_levels','name',$data['course']);
							$exam_det = $this->Common_model->get_data_by_id('exams','level_id',$level['id']);
						?>
		
                    <form class="form-horizontal form-label-left" method="POST" enctype="multipart/form-data" novalidate>					
                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="image">File (use only csv file) <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
							<input type="hidden" name="exam_id" value="<?php echo $exam_det['id']; ?>"/>
							<input type="hidden" name="level_id" value="<?php echo $level['id']; ?>"/>
							<input type="hidden" name="student_id" value="<?php echo $data['id']; ?>"/>
							<input type="hidden" name="centre" value="<?php echo $data['centre']; ?>"/>
                          <input id="image" class="form-control col-md-7 col-xs-12" name="file" required="required" type="file">
                        </div>
                      </div>
                   	  
                      <div class="ln_solid"></div>
                      <div class="form-group">
                        <div class="col-md-6 col-md-offset-3">
                          <a href="<?php echo base_url(); ?>admin/students/assessment/<?php echo $data['id']; ?>"><button type="button" class="btn btn-primary">Cancel</button></a>
                          <button id="send" type="submit" class="btn btn-success">Submit</button>
                        </div>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- /page content -->