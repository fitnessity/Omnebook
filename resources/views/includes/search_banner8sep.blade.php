<script src="https://maps.googleapis.com/maps/api/js?libraries=places&key=AIzaSyBeg1QiN3CKYXroVj8ivV9_Rq6E-xOkzno&sensor=false"></script>

<!-- <script src="https://maps.googleapis.com/maps/api/place/autocomplete/json?input=Vict&types=(cities)&key=AIzaSyBiY1c85uJoEIVd7XAwvcJNz0sLBtINssI"></script> -->

<section class="main-slider">

    <div class="flexslider" id="home_page_banners">

        <ul class="slides">

            <li>

                <img src="<?php echo Config::get('constants.FRONT_IMAGE'); ?>banner1.jpg" />

            </li>            <!--  <li>

                <img src="<?php echo Config::get('constants.FRONT_IMAGE'); ?>banner2.png" />

            </li>

            <li>

                <img src="<?php echo Config::get('constants.FRONT_IMAGE'); ?>banner3.jpg" />

            </li>

            <li>

                <img src="<?php echo Config::get('constants.FRONT_IMAGE'); ?>banner4.png" />

            </li>  -->

        </ul>

    </div>

    <div class="slider-block">

        <h1 style="word-spacing: 10px";>YOUR CONNECTION TO SPORTS & WELLNESS ACTIVITIES<br/>

        </h1>

        <p style="font-size: 20px">Get connected with personal trainers, coaches, studios, and local businesses offering lessons, classes, and activities in multiple sports locally, on the go, or online.</p>

        <form id="searchform" method="post" action="/filter">
<input type="hidden" name="_token" value="{{ csrf_token() }}">
            <input type="text" name="label" placeholder="Search by Sport, Facility, Professional..." value="@if(isset($selected_label) && $selected_label != NULL){{$selected_label }}@endif"  class="search_input_banner" style="width: 40%;" />
            <input id="pac-input" type="text" placeholder="Search by Location" value="@if(isset($selected_location) && $selected_location != NULL){{$selected_location }}@endif"/>
            <input type="hidden" name="location" id="location" value="@if(isset($selected_location) && $selected_location != NULL){{$selected_location }}@endif">
            <script>
            google.maps.event.addDomListener(window, 'load', initialize);
            function initialize() {
                var options = {
                  types: ['(cities)'],
                  componentRestrictions: {country: "US"}
                };
                var input = document.getElementById('pac-input');
                var autocomplete = new google.maps.places.Autocomplete(input, options);
                autocomplete.addListener('place_changed', function () {
                    var place = autocomplete.getPlace();
                    $("#location").val(place.formatted_address);
                    // place variable will have all the information you are looking for.
                    // console.log(place.geometry['location'].lat());
                    // console.log(place.geometry['location'].lng());
                });
            }
            </script>

            <input type="text" placeholder="Search by Zip code" name="zipcode" id="zipcode" value="@if(isset($selected_zipcode) && $selected_zipcode != NULL){{$selected_zipcode }}@endif"/>
           
            <button type="submit">SEARCH</button>

        </form>

    </div>

    <div class="how-it-works">

       <!-- <a href="#" class="slvj-link-lightbox 1" data-videoid="r0BXJYQ9JRs" data-videosite="youtube">

        <img src="<?php //echo Config::get('constants.FRONT_IMAGE'); ?>video.png" height="74" width="74"/>

        <span> How it works</span>

        </a> -->

    </div>

</section>

<section class="banner-bottom">

    <?php
    use Illuminate\Support\Facades\Route;
    $currentPath = Route::getFacadeRoot()->current()->uri();
    ?>

    @if($currentPath == "direct-hire")

        <h1 style="font-size: 32px;word-spacing: 5px">A MULTI-SPORTS & WELLNESS, BOOKING, SCHEDULING, ONLINE PAYMENTS AND NETWORKING PLATFORM</h1>
        <!--<p>Local Services In Your Area That Focus On: <span class="banner-bottom-span">SPORTS NAME</span> </p>-->

    @else

        <h1 style="font-size: 32px;word-spacing: 5px">A MULTI-SPORTS & WELLNESS, BOOKING, SCHEDULING, ONLINE PAYMENTS AND NETWORKING PLATFORM</h1>
        <!--<p>Local Services In Your Area That Focus On: <span class="banner-bottom-span">SPORTS NAME</span> </p>-->

        <!-- <h1>A more convenient way to</h1> -->

        <!-- <p>Fitnessity Makes It Convenient To Find and Book A Personal Trainers</p> -->

    @endif

</section>
