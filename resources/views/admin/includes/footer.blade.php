<!-- Footer -->
<footer class="footer container-fluid pl-30 pr-30">
				<!---div class="row">
					<div class="col-sm-12">
						<p>2019 &copy; Security App. Parpered by Smartzminds</p>
					</div>
				</div-->
			</footer>
			<!-- /Footer -->
			
		</div>
        <!-- /Main Content -->

    </div>
    <!-- /#wrapper -->
	
	<!-- JavaScript -->
	
    <!-- jQuery -->
    <script src="{{ URL::asset('vendors/bower_components/jquery/dist/jquery.min.js') }}"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="{{ URL::asset('vendors/bower_components/bootstrap/dist/js/bootstrap.min.js') }}"></script>

	<script src="{{ URL::asset('vendors/bower_components/dropify/dist/js/dropify.min.js') }}"></script>
		
	<!-- Form Flie Upload Data JavaScript -->
	<script src="{{ URL::asset('dist/js/form-file-upload-data.js') }}"></script>

	<script src="{{ URL::asset('dist/js/custom.js') }}"></script>

	<script src="{{ URL::asset('vendors/bower_components/switchery/dist/switchery.min.js') }}"></script>
	<!-- Select2 JavaScript -->
	<script src="{{ URL::asset('vendors/bower_components/select2/dist/js/select2.full.min.js') }}"></script>
		
		<!-- Bootstrap Select JavaScript -->
		<script src="{{ URL::asset('vendors/bower_components/bootstrap-select/dist/js/bootstrap-select.min.js') }}"></script>
		
		<!-- Bootstrap Tagsinput JavaScript -->
		<script src="{{ URL::asset('vendors/bower_components/bootstrap-tagsinput/dist/bootstrap-tagsinput.min.js') }}"></script>
		
		<!-- Bootstrap Touchspin JavaScript -->
		<script src="{{ URL::asset('vendors/bower_components/bootstrap-touchspin/dist/jquery.bootstrap-touchspin.min.js') }}"></script>
		
		<!-- Multiselect JavaScript -->
		<script src="{{ URL::asset('vendors/bower_components/multiselect/js/jquery.multi-select.js') }}"></script>
    <script src="{{ URL::asset('vendors/bower_components/bootstrap-switch/dist/js/bootstrap-switch.min.js') }}"></script>

	<script src="{{ URL::asset('dist/js/form-advance-data.js') }}"></script>


	<script src="{{ URL::asset('vendors/bower_components/bootstrap-validator/dist/validator.min.js') }}"></script>

	<!-- Data table JavaScript -->
	<script src="{{ URL::asset('vendors/bower_components/datatables/media/js/jquery.dataTables.min.js') }}"></script>
	<script src="{{ URL::asset('dist/js/dataTables-data.js') }}"></script>
	<script src="{{ URL::asset('vendors/bower_components/datatables.net-buttons/js/dataTables.buttons.min.js') }}"></script>
	<script src="{{ URL::asset('vendors/bower_components/datatables.net-buttons/js/buttons.flash.min.js') }}"></script>
	<script src="{{ URL::asset('vendors/bower_components/jszip/dist/jszip.min.js') }}"></script>
	<script src="{{ URL::asset('vendors/bower_components/pdfmake/build/pdfmake.min.js') }}"></script>
	<script src="{{ URL::asset('vendors/bower_components/pdfmake/build/vfs_fonts.js') }}"></script>
	
	<script src="{{ URL::asset('vendors/bower_components/datatables.net-buttons/js/buttons.html5.min.js') }}"></script>
	<script src="{{ URL::asset('vendors/bower_components/datatables.net-buttons/js/buttons.print.min.js') }}"></script>
	<script src="{{ URL::asset('dist/js/export-table-data.js') }}"></script>

	<script src="{{ URL::asset('vendors/bower_components/sweetalert/dist/sweetalert.min.js') }}"></script>
		
		<script src="{{ URL::asset('dist/js/sweetalert-data.js') }}"></script>

	
	<!-- Slimscroll JavaScript -->
	<script src="{{ URL::asset('dist/js/jquery.slimscroll.js') }}"></script>
	
	<!-- simpleWeather JavaScript -->
	<script src="{{ URL::asset('vendors/bower_components/moment/min/moment.min.js') }}"></script>
	<script src="{{ URL::asset('vendors/bower_components/simpleWeather/jquery.simpleWeather.min.js') }}"></script>
	<script src="{{ URL::asset('dist/js/simpleweather-data.js') }}"></script>
	
	<!-- Progressbar Animation JavaScript -->
	<script src="{{ URL::asset('vendors/bower_components/waypoints/lib/jquery.waypoints.min.js') }}"></script>
	<script src="{{ URL::asset('vendors/bower_components/jquery.counterup/jquery.counterup.min.js') }}"></script>
	
	<!-- Fancy Dropdown JS -->
	<script src="{{ URL::asset('dist/js/dropdown-bootstrap-extended.js') }}"></script>
	
	<!-- Sparkline JavaScript -->
	<script src="{{ URL::asset('vendors/jquery.sparkline/dist/jquery.sparkline.min.js') }}"></script>
	
	<!-- Owl JavaScript -->
	<script src="{{ URL::asset('vendors/bower_components/owl.carousel/dist/owl.carousel.min.js') }}"></script>
	
	<!-- Toast JavaScript -->
	<script src="{{ URL::asset('vendors/bower_components/jquery-toast-plugin/dist/jquery.toast.min.js') }}"></script>
	
	<!-- EChartJS JavaScript -->
	<script src="{{ URL::asset('vendors/bower_components/echarts/dist/echarts-en.min.js') }}"></script>
	<script src="{{ URL::asset('vendors/echarts-liquidfill.min.js') }}"></script>
	
	<!-- Switchery JavaScript -->
	<script src="{{ URL::asset('vendors/bower_components/switchery/dist/switchery.min.js') }}"></script>
	
	<!-- Init JavaScript -->
	<script src="{{ URL::asset('dist/js/init.js') }}"></script>
	<script src="{{ URL::asset('dist/js/dashboard5-data.js') }}"></script>
    
	
	<script>
     
	function modelShow(siteId)
	{
	 
		$.ajax({
		'type':'GET',
	  'url':'{{url("/admin/client/site/edit")}}',	 
	  data:{id:siteId},
		success:function(result)
	 {
	 
		 $('#myModal').modal('show');
     $('#myModal').html(result);
	  
	 }



	  });


	}
	</script>
	<script>
	function validation()
	{
		 var employeeId = $('#employeeID').val();
		 var shift = $('#shift').val();
		$.ajax({
			 type:"GET",
			 url:"{{url('/admin/client/site/validate')}}",
			 data:{employeeId:employeeId,shift:shift},	
    	success:function(result)
			{
				//alert(result);
				$('#employeeError').remove();
				$('#error').append("<span id='employeeError' style='color: red;'>"+result+"</span>");
				if(result)
				{
					$('#site_name').attr('disabled','disabled');
				  $('#site_location').attr('disabled','disabled');
				}
				 else
				 {
					$('#site_name').removeAttr('disabled','disabled');
				  $('#site_location').removeAttr('disabled','disabled');
					$('#bttn').click(function(){
					$("form").submit();  
					
				});
				 }
			}
 
		 });	
     

	}
	</script>
		<script>
	function modalValidation()
	{
		 var employeeId = $('#employee_id').val();
		 var shift = $('#Shift').val();
    
		$.ajax({
			 type:"GET",
			 url:"{{url('/admin/client/site/validate')}}",
			 data:{employeeId:employeeId,shift:shift},	
    	success:function(result)
			{
			
				$('#employee_Error').remove();
				$('#modalError').append("<span id='employee_Error' style='color: red;'>"+result+"</span>");
				if(result)
				{
					$('#update').attr('disabled','disabled');
				  //$('#site_location_modal').attr('disabled','disabled');
				}
				 else
				 {
					$('#update').removeAttr('disabled','disabled');
				  //$('#site_location_modal').removeAttr('disabled','disabled');
					$('#update').click(function(){
					$("form").submit();  
					
				});
				 }
			}
 
		 });	
 

	}
	</script>
	<script>
	 $('#subMit').click(function(){

   alert("ok");
	 });
	</script>
	 <script>
	 function deleteImg(Id)
	 {
		 alert();
	 }
	
	</script>
	<script>
	function imgDelete(Id,Table)
	{
	
		$.ajax({
     type:"GET",
		 url:"{{ url('/delete/image')}}",
		 data:{id:Id,table:Table},
		 success:function(result){
			window.location.reload();
		 }

		});
	}
	</script>
	</body>

</html>