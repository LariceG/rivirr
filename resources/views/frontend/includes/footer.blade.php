<!---------------------footer-------------->

  <footer>
    <div class="container">
      <div class="col-12">
        <hr>
      </div>
      <!--footer content-->
      <div class="row py-5">
        <div class="col-3">
          <img src="{{ url('/public/assets/frontend/images/footer-logo.png')}}" alt="" width="200px">
        </div>
        <div class="col-3">
          <h4 class="font-weight-bolder">
            Explore
          </h4>
          <ul class="list-group">
            <li class="list-group-item"> <a href="{{ url('/about')}}">About Us</a> </li>
            <li class="list-group-item"> <a href="#">Contact Us</a> </li>
            <li class="list-group-item"> <a href="#">Site Map</a> </li>
            <li class="list-group-item"> <a href="#">Internship</a> </li>
          </ul>
        </div>
        <div class="col-3">
            <h4 class="font-weight-bolder">
               Join Us
              </h4>
              <ul class="list-group">
                <li class="list-group-item"> <a href="/employer">Login</a> </li>
                <li class="list-group-item"> <a href="/signup">Signup / Register</a> </li>
                
              </ul>
        </div>
        <div class="col-3">
            <h4 class="font-weight-bolder">
               Further Information
              </h4>
              <ul class="list-group">
                <li class="list-group-item"> <a href="#">Privacy Policy</a> </li>
                <li class="list-group-item"> <a href="#">terms & Conditions</a> </li>
                <li class="list-group-item"> <a href="#">FAQs</a> </li>
              </ul>
        </div>
      </div>
      <!---hr ends-->
      <div class="col-12">
          <hr>
        </div>
        <div class="col-12">
            <div class="bottom-bar py-2">
                <p class="fs-12 font-weight-bold mb-0">Copyright &copy; 2019. All Right Reserved | Privacy Policy |Terms of Service</p>
                <div class="bottom-bar-btn">
                  <button class="btn fs-12">English</button> <button class="btn fs-12">USD-$</button>
                </div>
              </div>
        </div>
    </div>
    
  </footer>
     <!--Scripts-->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js"></script>
  <!--slick slider-->
  <script src="https://code.jquery.com/jquery-2.2.0.min.js" type="text/javascript"></script>
  <script src="{{ URL::asset('/public/assets/frontend/js/slick.js')}}" type="text/javascript" charset="utf-8"></script>
  <script src="https://maps.googleapis.com/maps/api/js?v=3.exp&key=AIzaSyDv32LWNs2vKC4iwLMXBfJgy3J3xuZcRF0&libraries=places"></script>
  <script>

function initialize() {

    var acInputs = document.getElementsByClassName("locationSearch");

    for (var i = 0; i < acInputs.length; i++) {
       //alert(acInputs[i]);
        var autocomplete = new google.maps.places.Autocomplete(acInputs[i]);
        autocomplete.inputId = acInputs[i].id;

        google.maps.event.addListener(autocomplete, 'place_changed', function () {
          var latitude = autocomplete.getPlace().geometry.location.lat();
            var longitude = autocomplete.getPlace().geometry.location.lng();
            document.getElementById('latitude').value = latitude;
            document.getElementById('longitude').value = longitude;
        });
    }
}
initialize();



</script>
  <script type="text/javascript">
  
    $(".center").slick({
      dots: false,
      infinite: true,
      slidesToShow: 4,
      slidesToScroll: 1
    });
  </script>
  <!--scroll -->
  <script>
    $(window).scroll(function () {
      var scroll = $(window).scrollTop();
      if (scroll <= 50) {
        $("header").addClass("darkHeader");
      }
    });
    $('.autoplay').slick({
      slidesToShow: 3,
      slidesToScroll: 1,
      autoplay: true,
      autoplaySpeed: 2000,
    });
    $('.slider').each(function () {
      var slickInduvidual = $(this);
      slickInduvidual.slick({
        nextArrow: slickInduvidual.next().find('.right'),
        prevArrow: slickInduvidual.next().find('.left')
      });
    })
  </script>
<!----- Date picker-------->
<script src="{{ URL::asset('/public/assets/frontend/js/datepicker.js')}}"></script>
<script src="{{ URL::asset('/public/assets/frontend/js/datepicker.en.js')}}"></script>

<script>
    $('#datepicker').datepicker({
        uiLibrary: 'bootstrap4'
    });
</script>


<script>
  $('#search_cancel').click(function()
    {        
      $("#search_input").val("")
    });
    $('#location_cancel').click(function()
    {      
        $("#location_input").val("");
    });
    </script>

</body>

</html>