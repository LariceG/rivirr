@include('frontend/includes/header') 


<!-- body section-->
    <section class="body">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-6 greenclr p-5">
                    <div class="inner-row p-5">
                        <p class="pictext mt-5 pt-5">Rivirr is a employer listing website for new graduates. Our users
                            are
                            students who are about to
                            graduate, or have recently graduated. They come to us to find information on employers who
                            are
                            hiring university
                            graduates. </p>
                        <p class="want mt-5">WANT TO LEARN MORE <a href="" class="contact">CONTACT US</a></p>
                    </div>
                </div>
                <div class="col-md-6 px-0">
                    <img src="{{ url('/public/assets/frontend/images/university.png')}}">
                </div>
            </div>
        </div>
    </section>
    <div class="container my-5">
        <div class="row">
            <div class="col-md-12 mx-auto">
                <img class="globe" src="{{ url('/public/assets/frontend/images/globe.PNG')}}">
                <h1>Mission</h1>
            </div>
            <div class="col-md-2"></div>
            <div class="col-md-8">
                <p class="fontsz mt-4">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin et arcu sit amet
                    diam convallis
                    ullamcorper id et quam. Pellentesque tempus turpis ligula, non fringilla purus mattis in. Praesent
                    non sapien a magna sagittis finibus at eu tortor. </p>
                <p class="mt-5 pl-5">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin et arcu sit amet
                    diam convallis
                    ullamcorper id et quam. Pellentesque tempus turpis ligula, non fringilla purus mattis in. Praesent
                    non sapien a magna sagittis finibus at eu tortor. </p>
            </div>
            <div class="col-md-2"></div>
        </div>
    </div>
    <div class="container-fluid my-5">
        <div class="row borderimg">
            <div class="container">
                <div class="row">
                    <div class="col-md-4 flagimg p-5">
                        <div class="inner-padding p-3 px-5">
                            <img class="flag" src="{{ url('/public/assets/frontend/images/flag.PNG')}}">
                            <h6 class="Founded pl-5">Founded in <br /> <span class="font-weight-bold">2019</span></h6>
                            <p class="pad-5 mt-3">Rivirr.com was launched from Anthony’s drom room at the University of
                                Maryland.</p>
                        </div>
                    </div>
                    <div class="col-md-4 flagimg p-5">
                        <div class="inner-padding p-3 px-5">
                            <img class="flag" src="{{ url('/public/assets/frontend/images/money.PNG')}}">
                            <h6 class="Founded pl-5">TRACK SPEND <br /><span class="font-weight-bold">$3 Billions</span></h6>
                            <p class="pad-5 mt-3">Rivirr.com was launched from Anthony’s drom room at the University of
                                Maryland.</p>
                        </div>
                    </div>
                    <div class="col-md-4 groupimg p-5">
                        <div class="inner-padding p-3 px-5">
                            <img class="flag" src="{{ url('/public/assets/frontend/images/group.PNG')}}">
                            <h6 class="Founded pl-5">INTEGRATION PARTNERS <br /><span class="font-weight-bold">2000+</span></h6>
                            <p class="pad-5 mt-3">Rivirr.com was launched from Anthony’s drom room at the University of
                                Maryland.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@include('frontend/includes/footer') 