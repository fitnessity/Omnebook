@extends('admin.layouts.layout')



<style type="text/css">

  .width{

    width: 100%;

  }

  .color{

    border-color: #767676 !important;

  }

     

</style>



@section('content')

<?php 

  $address = '';

  $add_data = '';

  $add = '';

  $address = $data->address;

  if (strpos($address, ',') !== false) {

    $explode = explode(',', $address);

    if(!empty($explode)){

      $add_data = $explode[1];

      $add = $explode[0];

     /* echo  $add_data ;

      echo "-".  $add;exit();*/

    }

  }else{

    $add =   $address;

  }

    



  function timeSlotOptionforservice($lbl, $val) {

    $start = "00:00"; //you can write here 00:00:00 but not need to it

    $end = "23:30";



    $tStart = strtotime($start);

    $tEnd = strtotime($end);

    $tNow = $tStart;

    

    $startpm = "00:00"; //you can write here 00:00:00 but not need to it

    $endpm = "11:30";

    

    echo '<select name="'.$lbl.'" id="'.$lbl.'" class="'.$lbl.' form-control">';

    echo '<option value="">Select Time</option>';

    while($tNow <= $tEnd){

      if($val == date("H:i",$tNow)) {

        echo '<option selected value="'.date("H:i",$tNow).'">'.date("h:i A",$tNow).'</option>';

      } else {

        echo '<option value="'.date("H:i",$tNow).'">'.date("h:i A",$tNow).'</option>';

      }

      $tNow = strtotime('+15 minutes',$tNow);

    }

    echo '</select>';

  }



?>



  <div class="panel panel-default">

    <div class="panel-heading">

      Edit

    </div>



    <div class="panel-body">

    

      <form method="post" action="{{route('update_unclaim')}}">

        @csrf

        <input type="hidden" name="chk" value="{{$chk}}">

        <input type="hidden" name="cid" id="cid" value="{{$data->id}}">

        <div class="row">

          <div class="col-md-5">

           <!--  <h4>Add Business Information</h4> -->

            <div class="form-group">

              <label>Business Name</label>

              <span class="color-red">*</span>

              <input class="width" type="text" name="bname" id="bname" value="{{$data->company_name}}" required>

            </div> 

        

            <div class="form-group">

              <label>Street Address</label>

              <input class="width" type="text" name="street_addr" id="street_addr" value="{{$add}}">

            </div> 

            <div id="map" style="display: none;"></div>
            <input type="hidden" name="lon" id="lon" value="">
            <input type="hidden" name="lat" id="lat" value="">

            <div class="form-group">

              <label>Additional Address Info </label>

              <input class="width" type="text" name="addi_addr" id="addi_addr" value="{{$add_data}}">

            </div> 

          

            <div class="form-group">

              <label>City/Town</label>

              <input class="width" type="text" name="city" id="city" value="{{$data->city}}">

            </div> 

        
            <input type="hidden" name="country" id="country" value="{{$data->country}}">
            <div class="form-group">

              <label>State/Province/Region  </label>

              <input class="width" type="text" name="state" id="state" value="{{$data->state}}">

            </div> 

          

            <div class="form-group">

              <label> Zipcode/Postal Code </label>

              <input class="width" type="text" name="zip" id="zip" value="{{$data->zip_code}}">

            </div>

          

            <div class="form-group">

              <label> Neighborhood/Location/Area</label>

              <input class="width" type="text" name="location" id="location" value="">

            </div>

          

            <div class="form-group">

              <label> Phone Number</label>

              <input class="width" type="text" name="phone" id="phone" value="@if($data->contact_number != 'null')  {{$data->contact_number}} @endif" onkeypress="return event.charCode >= 48 && event.charCode <= 57" onkeyup="changeformate()" maxlength="14">

            </div>

          

            <div class="form-group">

              <label> Website   </label>

              <input class="width" type="text" name="website" id="website" value="@if($data->website != 'null') {{$data->website}} @endif">

            </div>

        

            <div class="form-group">

              <label> Email   </label>

              <input class="width" type="text" name="email" id="email" value="{{$data->email}}">

            </div>

        

            <!--<div class="form-group">

                <label> Activity  </label> 

                <select name="frm_servicesport" id="frm_servicesport" class="width color form-control  my-form-xo">

                <option value="">Choose a Sport/Activity</option>

                <option value="Aerobics">Aerobics</option>

                <option value="Archery">Archery</option>

                <option value="Badminton">Badminton</option>

                <option value="Barre">Barre</option>

                <option value="Baseball">Baseball</option>

                <option value="Basketball">Basketball</option>

                <option value="Beach Vollyball">Beach Vollyball</option>

                <option value="Bouldering">Bouldering</option>

                <option value="Bungee Jumping">Bungee Jumping</option>

                <optgroup label="Camps &amp; Clinics">

                  <option value="Day Camp">Day Camp</option>

                  <option value="Sleep Away">Sleep Away</option>

                  <option value="Winter Camp">Winter Camp</option>

                </optgroup>

                <option value="Canoeing">Canoeing</option>

                <optgroup label="Cycling">

                  <option value="Indoor cycling">Indoor cycling</option>

                </optgroup>

                <option value="Dance">Dance</option>

                <option value="Diving">Diving</option>

                <optgroup label="Field Hockey">

                  <option value="Ice Hockey">Ice Hockey</option>

                </optgroup>

                <option value="Football">Football</option>

                <option value="Golf">Golf</option>

                <option value="Gymnastics">Gymnastics</option>

                <option value="Hang Gliding">Hang Gliding</option>

                <option value="Hiit">Hiit</option>

                <option value="Hiking - Backpacking">Hiking - Backpacking</option>

                <option value="Horseback Riding">Horseback Riding</option>

                <option value="Ice Skating">Ice Skating</option>

                <option value="Kayaking">Kayaking</option>

                <option value="lacrosse">lacrosse</option>

                <option value="Laser Tag">Laser Tag</option>

                <optgroup label="Martial Arts">

                  <option value="Boxing">Boxing</option>

                  <option value="Jiu-Jitsu">Jiu-Jitsu</option>

                  <option value="Karate">Karate</option>

                  <option value="Kick Boxing">Kick Boxing</option>

                  <option value="Kung Fu">Kung Fu</option>

                  <option value="MMA">MMA</option>

                  <option value="Self-Defense">Self-Defense</option>

                  <option value="Tai Chi">Tai Chi</option>

                  <option value="Wrestling">Wrestling</option>

                </optgroup>

                <option value="Massage Therapy">Massage Therapy</option>

                <option value="Nutrition">Nutrition</option>

                <option value="Paint Ball">Paint Ball</option>

                <option value="Physical Therapy">Physical Therapy</option>

                <option value="Pilates">Pilates</option>

                <option value="Rafting">Rafting</option>

                <option value="Rapelling">Rapelling</option>

                <option value="Rock Climbing">Rock Climbing</option>

                <option value="Rowing">Rowing</option>

                <option value="Running">Running</option>

                <optgroup label="Sightseeing Tours">

                  <option value="Airplane Tour">Airplane Tour</option>

                  <option value="ATV Tours">ATV Tours</option>

                  <option value="Boat Tours">Boat Tours</option>

                  <option value="Bus Tour">Bus Tour</option>

                  <option value="Caving Tours">Caving Tours</option>

                  <option value="Helicopter Tour">Helicopter Tour</option>

                </optgroup>

                <option value="Sailing">Sailing</option>

                <option value="Scuba Diving">Scuba Diving</option>

                <option value="Sky diving">Sky diving</option>

                <option value="Snow Skiing">Snow Skiing</option>

                <option value="Snowboarding">Snowboarding</option>

                <option value="Strength">Strength &amp; Conditioning</option>

                <option value="Surfing">Surfing</option>

                <option value="Swimming">Swimming</option>

                <option value="Tennis">Tennis</option>

                <option value="Tours">Tours</option>

                <option value="Vollyball">Vollyball</option>

                <option value="Weight training">Weight training</option>

                <option value="Windsurfing">Windsurfing</option>

                <option value="Yoga">Yoga</option>

                <option value="Zip-Line">Zip-Line</option>

                <option value="Zumba">Zumba</option>

                </select>

            </div>



            <div class="form-group">

                <label>Business Type </label>

                <select name="buss_type" id="buss_type" class="width color form-group my-form-xo" required>

                <option value="">Choose a Business Type</option>

                <option value="individual">Personal Trainer</option>

                <option value="experience">Experience</option>

                <option value="classes">Gym/Studio</option>

                </select>

            </div> -->

          </div>

    

        <div class="col-md-6">

         <!--  <h4>Other Activities Offered (Add up to 6)</h4> -->

          <div class="form-group">

            <h4>Hours of Operation</h4>       

          </div>

          <div class="company-specifics-day" id="selectdays">

            <div class="row">

              <div class="form-group col-md-3 col-sm-12 col-xs-12">

                <label for="mon">Monday</label>

              </div>

              <div class="form-group col-md-4 col-sm-6 col-xs-12">

                <?php timeSlotOptionforservice('mon_shift_start' ,$mon_shift_start); ?>

              </div>

              <div class="form-group col-md-1" style="text-align: center;">

                To

              </div>

              <div class="form-group col-md-4 col-sm-6 col-xs-12">

                <?php timeSlotOptionforservice('mon_shift_end' ,$mon_shift_end); ?>

              </div>

            </div>

            <div class="row">

              <div class="form-group col-md-3 col-sm-12 col-xs-12">

                <label for="tue">Tuesday</label>

              </div>

              <div class="form-group col-md-4 col-sm-6 col-xs-12">

               <?php timeSlotOptionforservice('tue_shift_start', $tue_shift_start); ?>

              </div>

              <div class="form-group col-md-1" style="text-align: center;">

                To

              </div>

              <div class="form-group col-md-4 col-sm-6 col-xs-12">

                <?php timeSlotOptionforservice('tue_shift_end', $tue_shift_end); ?>

              </div>

            </div>

            <div class="row">

              <div class="form-group col-md-3 col-sm-12 col-xs-12">

                <label for="wed">Wednesday</label>

              </div>

              <div class="form-group col-md-4 col-sm-6 col-xs-12">

                 <?php timeSlotOptionforservice('wed_shift_start', $wed_shift_start); ?>

              </div>

              <div class="form-group col-md-1" style="text-align: center;">

                To

              </div>

              <div class="form-group col-md-4 col-sm-6 col-xs-12">

                <?php timeSlotOptionforservice('wed_shift_end', $wed_shift_end); ?>

              </div>

            </div>

            <div class="row">

              <div class="form-group col-md-3 col-sm-12 col-xs-12">

                <label for="thu">Thursday</label>

              </div>

              <div class="form-group col-md-4 col-sm-6 col-xs-12">

                <?php timeSlotOptionforservice('thu_shift_start', $thu_shift_start); ?>

              </div>

              <div class="form-group col-md-1" style="text-align: center;">

                To

              </div>

              <div class="form-group col-md-4 col-sm-6 col-xs-12">

                <?php timeSlotOptionforservice('thu_shift_end', $thu_shift_end); ?>

              </div>

            </div>

            <div class="row">

              <div class="form-group col-md-3 col-sm-12 col-xs-12">

                <label for="fri">Friday</label>

              </div>

              <div class="form-group col-md-4 col-sm-6 col-xs-12">

                <?php timeSlotOptionforservice('fri_shift_start', $fri_shift_start); ?>

              </div>

              <div class="form-group col-md-1" style="text-align: center;">

                To

              </div>

              <div class="form-group col-md-4 col-sm-6 col-xs-12">

                <?php timeSlotOptionforservice('fri_shift_end', $fri_shift_end); ?>

              </div>

            </div>

            <div class="row">

              <div class="form-group col-md-3 col-sm-12 col-xs-12">

                <label for="sat">Saturday</label>

              </div>

              <div class="form-group col-md-4 col-sm-6 col-xs-12">

                <?php timeSlotOptionforservice('sat_shift_start', $sat_shift_start); ?>

              </div>

              <div class="form-group col-md-1" style="text-align: center;">

                To

              </div>

              <div class="form-group col-md-4 col-sm-6 col-xs-12">

                <?php timeSlotOptionforservice('sat_shift_end', $sat_shift_end); ?>

              </div>

            </div>

            <div class="row">

              <div class="form-group col-md-3 col-sm-12 col-xs-12">

                <label for="sun">Sunday</label>

              </div>

              <div class="form-group col-md-4 col-sm-6 col-xs-12">

                <?php timeSlotOptionforservice('sun_shift_start', $sun_shift_start); ?>

              </div>

              <div class="form-group col-md-1" style="text-align: center;">

                To

              </div>

              <div class="form-group col-md-4 col-sm-6 col-xs-12">

                <?php timeSlotOptionforservice('sun_shift_end', $sun_shift_end); ?>

              </div>

            </div>

            <div class="row">

              <div class="col-md-12">

                <label>Business Description</label>

                <textarea id="" class="panel-textarea" name="w3review" rows="4" cols="50">{{$data->about_company}}</textarea>

              </div>

            </div>

          </div>

        </div>

    </div>

  </div>





        <div class="row">

      <div class="col-md-12">

        <div class="box-footer text-center">          

          <button type="submit" id="submit" class="btn btn-primary " >Submit</button>

          <a href="/admin/unclaimbusiness" class="btn btn-danger ">Cancel</a>

        </div>

      </div>

        </div>

      </form>

    </div>

 

 <script type="text/javascript">
   function changeformate() {
        /*alert($('#contact').val());*/
        var con = $('#phone').val();
        var curchr = con.length;
        if (curchr == 3) {
            $("#phone").val("(" + con + ")" + "-");
        } else if (curchr == 9) {
            $("#phone").val(con + "-");
        }
    }
 </script>

 <script type="text/javascript">
        function initMap() {
            var map = new google.maps.Map(document.getElementById('map'), {
              center: {lat: -33.8688, lng: 151.2195},
              zoom: 13
            });
            var input = document.getElementById('street_addr');
            map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);

            var autocomplete = new google.maps.places.Autocomplete(input);
            autocomplete.bindTo('bounds', map);

            var infowindow = new google.maps.InfoWindow();
            var marker = new google.maps.Marker({
                map: map,
                anchorPoint: new google.maps.Point(0, -29)
            });

            autocomplete.addListener('place_changed', function() {
                infowindow.close();
                marker.setVisible(false);
                var place = autocomplete.getPlace();
                if (!place.geometry) {
                    window.alert("Autocomplete's returned place contains no geometry");
                    return;
                }
          
                // If the place has a geometry, then present it on a map.
                if (place.geometry.viewport) {
                    map.fitBounds(place.geometry.viewport);
                } else {
                    map.setCenter(place.geometry.location);
                    map.setZoom(17);
                }
                marker.setIcon(({
                    url: place.icon,
                    size: new google.maps.Size(71, 71),
                    origin: new google.maps.Point(0, 0),
                    anchor: new google.maps.Point(17, 34),
                    scaledSize: new google.maps.Size(35, 35)
                }));
                marker.setPosition(place.geometry.location);
                marker.setVisible(true);
            
                var address = '';
                var badd = '';
                var sublocality_level_1 = '';
                if (place.address_components) {
                    address = [
                      (place.address_components[0] && place.address_components[0].short_name || ''),
                      (place.address_components[1] && place.address_components[1].short_name || ''),
                      (place.address_components[2] && place.address_components[2].short_name || '')
                    ].join(' ');
                }
            
                infowindow.setContent('<div><strong>' + place.name + '</strong><br>' + address);
                infowindow.open(map, marker);
                
                // Location details
                for (var i = 0; i < place.address_components.length; i++) {
                    if(place.address_components[i].types[0] == 'postal_code'){
                      $('#zip').val(place.address_components[i].long_name);
                    }
               
                    if(place.address_components[i].types[0] == 'locality'){
                        $('#city').val(place.address_components[i].long_name);
                    }

                    if(place.address_components[i].types[0] == 'sublocality_level_1'){
                        sublocality_level_1 = place.address_components[i].long_name;
                    }

                    if(place.address_components[i].types[0] == 'street_number'){
                       badd = place.address_components[i].long_name ;
                    }

                    if(place.address_components[i].types[0] == 'route'){
                       badd += ' '+place.address_components[i].long_name ;
                    } 
                    if(place.address_components[i].types[0] == 'administrative_area_level_1'){
                      $('#state').val(place.address_components[i].long_name);
                    }
                    if(place.address_components[i].types[0] == 'country'){
                         $('#country').val(place.address_components[i].long_name);
                    }
                }
                if(badd == ''){
                  $('#street_addr').val(sublocality_level_1);
                }else{
                  $('#street_addr').val(badd);
                }
                $('#lat').val(place.geometry.location.lat());
                $('#lon').val(place.geometry.location.lng());
                
            });
        }
</script>
<script src="https://maps.googleapis.com/maps/api/js?libraries=places&key=AIzaSyCr7-ilmvSu8SzRjUfKJVbvaQZYiuntduw&callback=initMap" async defer></script>


@endsection