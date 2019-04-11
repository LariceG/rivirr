   <!--div class="row">
                            <div class="col-md-12">
                                <div class="copyright">
                                    <p>Copyright © 2018 Smartzminds. All rights reserved. Template by <a target="_blank" href="https://smartzminds.com">Smartzminds</a>.</p>
                                </div>
                            </div>
                        </div-->
                    </div>
                </div>
            </div>
            <!-- END MAIN CONTENT-->
            <!-- END PAGE CONTAINER-->
        </div>
	
    <!-- Bootstrap JS-->
    <script src="{{ URL::asset('assets/vendor/bootstrap-4.1/popper.min.js') }}"></script>
    <script src="{{ URL::asset('assets/vendor/bootstrap-4.1/bootstrap.min.js') }}"></script>
    <!-- Vendor JS       -->
    <script src="{{ URL::asset('assets/vendor/slick/slick.min.js') }}">
    </script>
    <script src="{{ URL::asset('assets/vendor/wow/wow.min.js') }}"></script>
    <script src="{{ URL::asset('assets/vendor/animsition/animsition.min.js') }}"></script>
    <script src="{{ URL::asset('assets/vendor/bootstrap-progressbar/bootstrap-progressbar.min.js') }}">
    </script>
    <script src="{{ URL::asset('assets/vendor/counter-up/jquery.waypoints.min.js') }}"></script>
    <script src="{{ URL::asset('assets/vendor/counter-up/jquery.counterup.min.js') }}">
    </script>
    <script src="{{ URL::asset('assets/vendor/circle-progress/circle-progress.min.js') }}"></script>
    <script src="{{ URL::asset('assets/vendor/perfect-scrollbar/perfect-scrollbar.js') }}"></script>
    <script src="{{ URL::asset('assets/vendor/chartjs/Chart.bundle.min.js') }}"></script>
    <script src="{{ URL::asset('assets/vendor/select2/select2.min.js') }}"></script>
       <!-- Main JS-->
    <script src="{{ URL::asset('assets/js/main.js') }}"></script>
    <script src="//cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
	<!--AIzaSyCGu_V6bEIUGZcvd9lNDAoAMly5xziV0wc-->
	<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&key=AIzaSyDv32LWNs2vKC4iwLMXBfJgy3J3xuZcRF0&libraries=places"></script>
	              <script>
			  $(document).ready( function () {                       
					$('#myTable').DataTable();
				} );
				$(document).ready(function () {
    //@naresh action dynamic childs
    var next = 0;
    $("#add-more").click(function(e){
        e.preventDefault();
        var addto = "#field" + next;
        var addRemove = "#field" + (next);
        next = next + 1;
        var newIn = '<div id="field'+ next +'" name="field'+ next +'"><div class="form-group" id="location"><input type="text" name="location[]" placeholder="Enter Location" class="form-control autocomplete"> </div>';
        var newInput = $(newIn);
        var removeBtn = '<br><button style="margin-bottom: 5px;" id="remove' + (next - 1) + '" class="btn btn-danger remove-me" >Remove</button></div></div><div id="field">';
        var removeButton = $(removeBtn);
        $(addto).after(newInput);
        $(addRemove).after(removeButton);
        $("#field" + next).attr('data-source',$(addto).attr('data-source'));
        $("#count").val(next);  
        
		$('.remove-me').click(function(e){
			e.preventDefault();
			var fieldNum = this.id.charAt(this.id.length-1);
			var fieldID = "#field" + fieldNum;
			$(this).remove(); 
			$(fieldID).remove();
		});
        initialize();
        var acInputs = document.getElementsByClassName("autocomplete");

for (var i = 0; i < acInputs.length; i++) {
   //alert(acInputs[i]);
    var autocomplete = new google.maps.places.Autocomplete(acInputs[i]);
    autocomplete.inputId = acInputs[i].id;

    google.maps.event.addListener(autocomplete, 'place_changed', function () {
        //document.getElementById("log").innerHTML = 'You used input with id ' + this.inputId;
    });
}
    });

});
$(".autocomplete").keypress(function(){

    var acInputs = document.getElementsByClassName("autocomplete");

    for (var i = 0; i < acInputs.length; i++) {
       //alert(acInputs[i]);
        var autocomplete = new google.maps.places.Autocomplete(acInputs[i]);
        autocomplete.inputId = acInputs[i].id;

        google.maps.event.addListener(autocomplete, 'place_changed', function () {
            //document.getElementById("log").innerHTML = 'You used input with id ' + this.inputId;
            var latitude = autocomplete.getPlace().geometry.location.lat();
            var longitude = autocomplete.getPlace().geometry.location.lng();
            document.getElementById('latitude').value = latitude;
            document.getElementById('longitude').value = longitude;
        });
    }
});
//initialize();



			  </script>
<!------headquater-------->
<script>

function initialize() {

    var acInputs = document.getElementsByClassName("autoheadquater");

    for (var i = 0; i < acInputs.length; i++) {
       //alert(acInputs[i]);
        var autocomplete = new google.maps.places.Autocomplete(acInputs[i]);
        autocomplete.inputId = acInputs[i].id;

        google.maps.event.addListener(autocomplete, 'place_changed', function () {
            //document.getElementById("log").innerHTML = 'You used input with id ' + this.inputId;
        });
    }
}




</script>











</div>