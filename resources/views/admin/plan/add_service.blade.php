@extends('admin.layouts.layout')

<style type="text/css">
  .button-fitness{
    padding: 6px 13px;
    background: red;
    color: #fff;
    font-size: 14px;
    text-decoration: none;
    display: inline-block;
    cursor: pointer;
  }

  .day_circle.timezone-round {
    position: relative;
    display: inline-block;
    width: 50px !important;
    height: 50px;
    margin: 20px 10px 30px;
    background-color: #ffffff;
    border: 1px solid #000;
    border-radius: 50%;
    cursor: pointer;
    line-height: 50px;
    font-size: 18px;
    text-transform: uppercase;
    padding: 0 !important;
  }



  .timezone-round p {
    font-weight: 700;
  }

  .spancolor{
    color: red !important;
  }

  .day_circle.timezone-round.day_circle_fill {
    background-color: red;
    color: #fff;
  }

  .day_circle.timezone-round {
    position: relative;
    display: inline-block;
    width: 50px !important;
    height: 50px;
    margin: 20px 10px 30px;
    background-color: #ffffff;
    border: 1px solid #000;
    border-radius: 50%;
    cursor: pointer;
    line-height: 50px;
    font-size: 18px;
    text-transform: uppercase;
    padding: 0 !important;
  }

 .error{
    color: #C9302C !important;
    display: block;
    text-align: left;
    font-size: 14px !important;
    font-weight: bold !important;
    text-transform: none !important;
  }

  .img-tab-btn {
    color: #fff;
    background-color: #ed1b24;
    border-color: #ed1b24;
    padding: 7px 60px;
  }

  .imagePreview{
    width: 100%;
    height: 220px;
    background-position: center center;
    background: url(http://cliquecities.com/assets/no-image-e3699ae….jpg);
    background-color: #fff;
    background-size: 100% 100%;
    background-repeat: no-repeat;
    display: inline-block;
    box-shadow:
  }

</style>

@section('content')
<?php 
  use App\BusinessSubscriptionPlan;
  $sport_activity= ''; 
  $starting = '';
  $fitnessity_fee= 0;
  $bspdata = BusinessSubscriptionPlan::where('id',1)->first();
  $fitnessity_fee = $bspdata->fitnessity_fee;

  function timeSlotOption($lbl, $val) {
    $start = "00:00"; //you can write here 00:00:00 but not need to it
    $end = "23:30";
    $tStart = strtotime($start);
    $tEnd = strtotime($end);
    $tNow = $tStart;

    $startpm = "00:00"; //you can write here 00:00:00 but not need to it
    $endpm = "11:30";

    echo '<select name="'.$lbl.'[]" id="'.$lbl.'" class="'.$lbl.' form-control">';
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
      CREATE SERVICES & PRICES
    </div>

    <div class="panel-body">
      <form method="post" action="{{route('add_services')}}" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="cid" id="cid" value="{{$cid}}">
        <div class="row" id="radiodetails">
          <div class="form-group col-md-12">
            <h4>Let's get a few details to set up your service<span class="spancolor">*</span></h4>
            <h5>Please select only one sport/activity to offer your clients</h5>
            <input type="radio" id="service_type" name="service_type" value="individual" checked><label class="panel-class" for="individual"> PERSONAL TRAINER</label>
            <input type="radio" id="service_type" name="service_type" value="classes"> <label class="panel-class" for="classes"> GYM/STUDIO</label>
            <input type="radio" id="service_type" name="service_type" value="experience"><label class="panel-class" for="experience"> EXPERIENCE</label>
            <input type="hidden" name="hidd_service_type" id="hidd_service_type" value="individual">
          </div>
        </div>

        <div id="divstep1">

          <div class="row">

            <div class="col-md-8">

              <div class="form-group col-md-12">

                <select name="frm_servicesport" id="frm_servicesport" class="form-control">

                  <option value="">Choose a Sport/Activity</option>

                  <option {{ ($sport_activity=='Aerobics')?'selected':''}}>Aerobics</option>

                  <option {{ ($sport_activity=='Archery')?'selected':''}}>Archery</option>

                  <option {{ ($sport_activity=='Badminton')?'selected':''}}>Badminton</option>

                  <option {{ ($sport_activity=='Barre')?'selected':''}}>Barre</option>

                  <option {{ ($sport_activity=='Baseball')?'selected':''}}>Baseball</option>

                  <option {{ ($sport_activity=='Basketball')?'selected':''}}>Basketball</option>

                  <option {{ ($sport_activity=='Beach Vollyball')?'selected':''}}>Beach Vollyball</option>

                  <option {{ ($sport_activity=='Bouldering')?'selected':''}}>Bouldering</option>

                  <option {{ ($sport_activity=='Bungee Jumping')?'selected':''}}>Bungee Jumping</option>

                  <optgroup label="Camps &amp; Clinics">

                      <option {{ ($sport_activity=='Day Camp')?'selected':''}}>Day Camp</option>

                      <option {{ ($sport_activity=='Sleep Away')?'selected':''}}>Sleep Away</option>

                      <option {{ ($sport_activity=='Winter Camp')?'selected':''}}>Winter Camp</option>

                  </optgroup>

                  <option {{ ($sport_activity=='Canoeing')?'selected':''}}>Canoeing</option>

                  <optgroup label="Cycling">

                      <option {{ ($sport_activity=='Indoor cycling')?'selected':''}}>Indoor cycling</option>

                  </optgroup>

                  <option {{ ($sport_activity=='Dance')?'selected':''}}>Dance</option>

                  <option {{ ($sport_activity=='Diving')?'selected':''}}>Diving</option>

                  <optgroup label="Field Hockey">

                      <option {{ ($sport_activity=='Ice Hockey')?'selected':''}}>Ice Hockey</option>

                  </optgroup>

                  <option {{ ($sport_activity=='Football')?'selected':''}}>Football</option>

                  <option {{ ($sport_activity=='Golf')?'selected':''}}>Golf</option>

                  <option {{ ($sport_activity=='Gymnastics')?'selected':''}}>Gymnastics</option>

                  <option {{ ($sport_activity=='Hang Gliding')?'selected':''}}>Hang Gliding</option>

                  <option {{ ($sport_activity=='Hiit')?'selected':''}}>Hiit</option>

                  <option {{ ($sport_activity=='Hiking - Backpacking')?'selected':''}}>Hiking - Backpacking</option>

                  <option {{ ($sport_activity=='Horseback Riding')?'selected':''}}>Horseback Riding</option>

                  <option {{ ($sport_activity=='Ice Skating')?'selected':''}}>Ice Skating</option>

                  <option {{ ($sport_activity=='Kayaking')?'selected':''}}>Kayaking</option>

                  <option {{ ($sport_activity=='lacrosse')?'selected':''}}>lacrosse</option>

                  <option {{ ($sport_activity=='Laser Tag')?'selected':''}}>Laser Tag</option>

                  <optgroup label="Martial Arts">

                      <option {{ ($sport_activity=='Boxing')?'selected':''}}>Boxing</option>

                      <option {{ ($sport_activity=='Jiu-Jitsu')?'selected':''}}>Jiu-Jitsu</option>

                      <option {{ ($sport_activity=='Karate')?'selected':''}}>Karate</option>

                      <option {{ ($sport_activity=='Kick Boxing')?'selected':''}}>Kick Boxing</option>

                      <option {{ ($sport_activity=='Kung Fu')?'selected':''}}>Kung Fu</option>

                      <option {{ ($sport_activity=='MMA')?'selected':''}}>MMA</option>

                      <option {{ ($sport_activity=='Self-Defense')?'selected':''}}>Self-Defense</option>

                      <option {{ ($sport_activity=='Tai Chi')?'selected':''}}>Tai Chi</option>

                      <option {{ ($sport_activity=='Wrestling')?'selected':''}}>Wrestling</option>

                  </optgroup>

                  <option {{ ($sport_activity=='Massage Therapy')?'selected':''}}>Massage Therapy</option>

                  <option {{ ($sport_activity=='Nutrition')?'selected':''}}>Nutrition</option>

                  <option {{ ($sport_activity=='Paint Ball')?'selected':''}}>Paint Ball</option>

                  <option {{ ($sport_activity=='Physical Therapy')?'selected':''}}>Physical Therapy</option>

                  <option {{ ($sport_activity=='Pilates')?'selected':''}}>Pilates</option>

                  <option {{ ($sport_activity=='Rafting')?'selected':''}}>Rafting</option>

                  <option {{ ($sport_activity=='Rapelling')?'selected':''}}>Rapelling</option>

                  <option {{ ($sport_activity=='Rock Climbing')?'selected':''}}>Rock Climbing</option>

                  <option {{ ($sport_activity=='Rowing')?'selected':''}}>Rowing</option>

                  <option {{ ($sport_activity=='Running')?'selected':''}}>Running</option>

                  <optgroup label="Sightseeing Tours">

                      <option {{ ($sport_activity=='Airplane Tour')?'selected':''}}>Airplane Tour</option>

                      <option {{ ($sport_activity=='ATV Tours')?'selected':''}}>ATV Tours</option>

                      <option {{ ($sport_activity=='Boat Tours')?'selected':''}}>Boat Tours</option>

                      <option {{ ($sport_activity=='Bus Tour')?'selected':''}}>Bus Tour</option>

                      <option {{ ($sport_activity=='Caving Tours')?'selected':''}}>Caving Tours</option>

                      <option {{ ($sport_activity=='Helicopter Tour')?'selected':''}}>Helicopter Tour</option>

                  </optgroup>

                  <option {{ ($sport_activity=='Sailing')?'selected':''}}>Sailing</option>

                  <option {{ ($sport_activity=='Scuba Diving')?'selected':''}}>Scuba Diving</option>

                  <option {{ ($sport_activity=='Sky diving')?'selected':''}}>Sky diving</option>

                  <option {{ ($sport_activity=='Snow Skiing')?'selected':''}}>Snow Skiing</option>

                  <option {{ ($sport_activity=='Snowboarding')?'selected':''}}>Snowboarding</option>

                  <option {{ ($sport_activity=='Strength')?'selected':''}}>Strength &amp; Conditioning</option>

                  <option {{ ($sport_activity=='Surfing')?'selected':''}}>Surfing</option>

                  <option {{ ($sport_activity=='Swimming')?'selected':''}}>Swimming</option>

                  <option {{ ($sport_activity=='Tennis')?'selected':''}}>Tennis</option>

                  <option {{ ($sport_activity=='Tours')?'selected':''}}>Tours</option>

                  <option {{ ($sport_activity=='Vollyball')?'selected':''}}>Vollyball</option>

                  <option {{ ($sport_activity=='Weight training')?'selected':''}}>Weight training</option>

                  <option {{ ($sport_activity=='Windsurfing')?'selected':''}}>Windsurfing</option>

                  <option {{ ($sport_activity=='Yoga')?'selected':''}}>Yoga</option>

                  <option {{ ($sport_activity=='Zip-Line')?'selected':''}}>Zip-Line</option>

                  <option {{ ($sport_activity=='Zumba')?'selected':''}}>Zumba</option>

                </select>

                <span class="error" id="err_frm_servicesportS2"></span>

              </div>

              <div class="form-group col-md-12">

                  <input type="text" class="form-control" name="frm_programname" id="frm_programname" placeholder="Enter Name of Program" title="servicetitle" value="">

                  <span class="error" id="err_frm_programname"></span>

              </div>

              <div class="form-group col-md-12">

                  <textarea class="form-control" rows="6" name="frm_programdesc" id="frm_programdesc" placeholder="Enter program description" maxlength="150"></textarea>

                  <span class="error" id="err_frm_programdesc"></span>

                  <div class="text-right"><span id="frm_programdesc_left">150</span> Characters Left</div>

              </div>

              <div class="row itenerary_div" style="display:none">

                <div class="form-group col-md-12">

                  <label><h3>Set Up Your Itinerary</h3></label>

                </div>

                <div class="form-group col-md-12">

                    <label class="labelstyle" for="what_you_doing">What will you be doing? </label>

                    <textarea class="form-control" rows="6" name="what_you_doing" id="what_you_doing" placeholder="Briefly describe what you'll do with your customers. Be specific about what guests will do on your activity." maxlength="500"></textarea>

                    <span class="error" id="err_what_you_doing"></span>

                    <div class="text-right"><span id="frm_what_you_doing">500</span> Characters Left</div>

                </div>

                <div class="form-group col-md-12 mt-25">

                    <label class="labelstyle">What's Included with this experience?</label><br>

                    <p>

                      What do you provide for your guest that will make the experience memorabel?

                      (You can provide transportation and pickup from hotels etc. Food an drinks, special

                      equipment, video and photography services, or anything else special to make your 

                      guests comfortable.)

                      Select all that apply </p>

                    <select name="frm_included_things[]" id="frm_included_things" multiple class="mt-10">

                        <option value="Safety & Protective Gear">Safety & Protective Gear</option>

                        <option value="Activity Equipment">Activity Equipment</option>

                        <option value="Breakfast">Breakfast</option>

                        <option value="Lunch">Lunch</option>

                        <option value="Dinner">Dinner</option>

                        <option value="Snacks">Snacks</option>

                        <option value="Drinks (tea, coffee, soda, bottled water, etc.) ">Drinks (tea, coffee, soda, bottled water, etc.)</option>

                        <option value="Alcohol (beer, champagne, wine, mixed drink etc.)">Alcohol (beer, champagne, wine, mixed drink etc.)</option>

                        <option value="Transportation">Transportation</option>

                        <option value="Insurance Coverage">Insurance Coverage</option>

                        <option value="Entrance Fees ">Entrance Fees </option>

                        <option value="Airfare">Airfare</option>

                        <option value="Taxes">Taxes</option>

                        <option value="Professional Guide">Professional Guide</option>

                        <option value="Guide Gratuity">Guide Gratuity</option>

                        <option value="Accommodations">Accommodations</option>

                        <option value="Video">Video</option>

                        <option value="Photography">Photography</option>

                        <option value="Fully Narrated">Fully Narrated</option>

                        <option value="Historic landmarks">Historic landmarks</option>

                        <option value="Rest period">Rest period</option>

                        <option value="Typical souvenir">Typical souvenir</option>

                      

                    </select>

                    <script>

                        var p = new SlimSelect({

                            select: '#frm_included_things'

                        });

                    </script>

                    <span class="error" id="err_what_included"></span>

                </div>

                <div class="form-group col-md-12">

                    <label class="labelstyle">What's Not Included with this experience?</label><br>

                    <p> List the items or services that are not includes with this experience. i.e. no food or drinks, no equipment, no insurance, etc.</p>

                    <select name="frm_notincluded_things[]" id="frm_notincluded_things" multiple>

                        <option value="Safety & Protective Gear">Safety & Protective Gear</option>

                        <option value="Activity Equipment">Activity Equipment</option>

                        <option value="Breakfast">Breakfast</option>

                        <option value="Lunch">Lunch</option>

                        <option value="Dinner">Dinner</option>

                        <option value="Snacks">Snacks</option>

                        <option value="Drinks (tea, coffee, soda, bottled water, etc.) ">Drinks (tea, coffee, soda, bottled water, etc.)</option>

                        <option value="Alcohol (beer, champagne, wine, mixed drink etc.)">Alcohol (beer, champagne, wine, mixed drink etc.)</option>

                        <option value="Transportation">Transportation</option>

                        <option value="Insurance Coverage">Insurance Coverage</option>

                        <option value="Entrance Fees ">Entrance Fees </option>

                        <option value="Airfare">Airfare</option>

                        <option value="Taxes">Taxes</option>

                        <option value="Professional Guide">Professional Guide</option>

                        <option value="Guide Gratuity">Guide Gratuity</option>

                        <option value="Accommodations">Accommodations</option>

                        <option value="Video">Video</option>

                        <option value="Photography">Photography</option>

                        <option value="Fully Narrated">Fully Narrated</option>

                        <option value="Historic landmarks">Historic landmarks</option>

                        <option value="Rest period">Rest period</option>

                        <option value="Typical souvenir">Typical souvenir</option>

                      

                    </select>

                    <script>

                        var p = new SlimSelect({

                            select: '#frm_notincluded_things'

                        });

                    </script>

                    <span class="error" id="err_what_not_included"></span>

                </div>

                <div class="form-group col-md-12">

                    <label  class="labelstyle">What should Guest Bring and Wear?</label><br>

                    <p> If guests need anything in order to enjoy your experience, this is the place to tell them. This list will be emailed to guests when they book your experience to help them prepare. Be as detailed as possible and each item individually.</p>

                    <select name="frm_wear[]" id="frm_wear" multiple>

                        <option value="Any Clothing Type">Any Clothing Type</option>

                        <option value="Dress for warm weather">Dress for warm weather</option>

                        <option value="Dress for wet weather">Dress for wet weather</option>

                        <option value="Dress for cold weather">Dress for cold weather</option>

                        <option value="Dress for nature activities">Dress for nature activities</option>

                        <option value="Dress for wet activities">Dress for wet activities</option>

                        <option value="Dress for cold activities">Dress for cold activities</option>

                        <option value="Pants">Pants</option>

                        <option value="Long Sleeve">Long Sleeve</option>

                        <option value="Jacket">Jacket</option>

                        <option value="Sandals">Sandals</option>

                        <option value="Shoes">Shoes</option>

                        <option value="Hats">Hats</option>

                        <option value="Sunglasses">Sunglasses</option>

                        <option value="Sunblock">Sunblock</option>

                        <option value="Bug Spray">Bug Spray</option>

                        <option value="Safety Goggles">Safety Goggles</option>

                        <option value="Dinner">Dinner</option>

                        <option value="Snacks">Snacks</option>

                        <option value="First Aid Kit">First Aid Kit</option>

                        <option value="Rain jacket">Rain jacket</option>

                        <option value="Daypack">Daypack</option>

                        <option value="Backpack">Backpack</option>

                        <option value="Headlamp">Headlamp</option>

                        <option value="Water bottle">Water bottle</option>

                        <option value="Compass">Compass</option>

                        <option value="Swimsuit">Swimsuit</option>

                        <option value="Drybag (waterproof)">Drybag (waterproof)</option>

                        <option value="Bandana or Buff headwear">Bandana or Buff headwear</option>

                        <option value="Sleeping bag">Sleeping bag</option>

                        <option value="Padlock">Padlock</option>

                        <option value="Duct Tape">Duct Tape</option>

                        <option value="Ear Plugs">Ear Plugs</option>

                        <option value="Tent">Tent</option>

                        <option value="Small Cooking Kit">Small Cooking Kit</option>

                        <option value="Rope">Rope</option>

                        <option value="Utility Knife">Utility Knife</option>

                      

                    </select>

                    <script>

                        var p = new SlimSelect({

                            select: '#frm_wear'

                        });

                    </script>

                    <span class="error" id="err_what_guest_bring"></span>

                </div>

                <div class="form-group col-md-12">

                    <label  class="labelstyle">Require Safety Verifications</label><br>

                    <p> The primary booker has to successfully complete verified ID in order for them and there guests to attend your experience.</p>

                    <div class="col-md-12">

                      <input type="checkbox" id="id_proof" name="id_proof" value="1" 

                        <?php 

                      if(!empty($req_safety)){

                      if(in_array("id_proof", $req_safety)){ echo 'checked'; } } ?> /> 

                        Require the booker to have ID upon arrival for verification of age and identity (This will be emailed to guest so the are prepared).

                    </div>

                    <div class="col-md-12">

                      <input type="checkbox" id="id_vaccine" name="id_vaccine" value="1" <?php if(!empty($req_safety)){ if(in_array("id_vaccine", $req_safety)){ echo 'checked'; } } ?> /> 

                        Require the booker to have proof of vacination. (This will be emailed to guest so they are prepared)

                    </div>

                    <div class="col-md-12">

                      <input type="checkbox" id="id_covid" name="id_covid" value="1" <?php if(!empty($req_safety)){ if(in_array("id_covid", $req_safety)){ echo 'checked'; } } ?> /> Require the booker to have proof of a nagative Covid-19 test. (This will be emailed to guest so they are prepared)

                    </div>

                </div>

                <div class="form-group col-md-12">

                    <label  class="labelstyle">Let's Plan Your Day By Day</label><br>

                    <p> Give your customers a day by day plan. Include a title, image and description of what the customers will be doing for that day. You can create multiple days.</p>

                    <input type="hidden"  name="planday_count" id="planday_count" value="0" />

                    <div class="col-md-12 add-another-day-schedule-block mt-25">

                      <div class="row add_another_day">

                          <div class="col-md-12"> <label class="mb-10"> Day 1 </label></div>

                                <div class="col-md-3 text-center">

                                    <div class="imagePreview divImgPreview">

                                        <img src="" class="imagePreview planblah0" id="showimgDayPlan">

                                    </div>

                                    <label class="img-tab-btn">Upload Image<input type="file" name="dayplanpic[]" class="uploadFile img" value="Upload Photo" onchange="planImg(this,0);" style="width: 0px;height: 0px;overflow: hidden;"></label>

                                    <span class="error" id="err_oldservicepic20"></span>

                                    <input type="hidden" id="olddayplanpic20" name="olddayplanpic" value="">

                                    

                                </div>

                                <div class="col-md-9">

                                    <input type="text" class="form-control" name="days_title[]" id="days_title0" placeholder="Give Heading for This Day"/><br />

                                    <textarea class="form-control" rows="6" name="days_description[]" id="days_description" placeholder="Give Description For This Day" maxlength="500"></textarea>

                                </div>

                          <?php //} ?>

                        </div>

                    </div>

                    <div class="col-md-12 text-center" style="margin-top: 50px;">

                      <a id="test" class="button-fitness add-another-day-schedule">Add Another Day</a>

                    </div>

                </div>

              </div>

            </div>

            <div class="col-md-4">

              <div class="col-md-12 imgUp">

                <div class="imagePreview divImgPreview">

                    <img src="{{ url('/public/images/default-avatar.png') }}" class="imagePreview blah2" id="showimgservice" style="width:70%;">

                </div>

                <label class="img-tab-btn">Upload Image<input type="file" name="servicepic" class="uploadFile img" value="Upload Photo" onchange="readServicePic2(this);" style="width: 0px;height: 0px;overflow: hidden;"></label>

                <span class="error" id="err_oldservicepic2"></span>

                <input type="hidden" id="oldservicepic" name="oldservicepic" value="" >

                <label style="font-size: 12px;">Upload an image that best represents your program</label>

              </div>

            </div>

          </div>

          <div class="row">

            <div class="col-md-12">

              <div class="box-footer text-center">  

                <a href="/admin/unclaimbusiness" class="btn btn-danger ">Back</a>

                <button type="button" id="next1" class="btn btn-primary ">Continue</button>

              </div>

            </div>

          </div>
        </div>

        <div id="divstep2" style="display: none">

          <div class="panel-body">

            <div class="row">

               <div class="col-md-12">

                <div class="col-md-6 location_div_experience" style="display: none">

                  <div class="row">

                      <div class="form-group col-md-12" >

                          <h3 style="font-size: 17px;font-weight: bold;">Describe the location</h3>

                          <div class="form-group">

                              <label>Tell customers how to meet up, where to meet up, meeting point name and how to find you once the customers arrive.Don't leave it up to customers to figure out how to meet up with you. Let them know before hand.</label><br>

                              <textarea class="form-control" value="yes" name="meetup_location" placeholder="(Ex. Please arrive at the location of our business. The address reminder is ABC Anytown, town 12345 USA.) Or; We will pick you up at your hotel. Or; Please talk with your front desk staff about the meeting poing, Or; Please meet us at Central Park at the entrance of 81st and Central Park West (CPW). Wait at the seating area if you arrive early. The instructor will have on a red hat and yellow vest. Please arrive 10 minutes before your activity starts.)"></textarea>

                          </div>

                      </div>

                  </div>

                </div>

                <div class="col-md-6 ">

                    <br>

                    <div class="row">

                        <div class="form-group col-md-12">

                            <label style="width: 100%">Select Service Type You Offer</label>

                            <select name="frm_servicetype[]" id="categSType" multiple>

                                <option value="Personal Training">Personal Training</option>

                                <option value="Coaching">Coaching</option>

                                <option value="Therapy">Therapy</option>

                            </select>

                            <script>

                                var p = new SlimSelect({

                                    select: '#categSType'

                                });

                            </script>

                        </div>

                        <div class="form-group col-md-12">

                            <label style="width: 100%">Location of Activity</label>

                            <select name="frm_servicelocation[]" id="frm_servicelocation" multiple>

                                <option value="Online">Online</option>

                                <option value="At Business">At Business</option>

                                <option value="On Location">On Location</option>

                            </select>

                            <script>

                                var p = new SlimSelect({

                                    select: '#frm_servicelocation'

                                });

                            </script>

                        </div>

                        <div class="form-group col-md-12">

                            <label style="width: 100%">Activity Great For</label>

                            <select name="frm_programfor[]" id="frm_programfor" multiple>

                               <?php /*?> <option>Individual</option><?php */?>

                                <option value="Kids">Kids</option>

                                <option value="Teens">Teens</option>

                                <option value="Adults">Adults</option>

                                <option value="Family">Family</option>

                                <option value="Groups">Groups</option>

                                <option value="Paralympic">Paralympic</option>

                                <option value="Prenatal">Prenatal</option>

                                <option value="Any">Any</option>

                            </select>

                            <script>

                                var p = new SlimSelect({

                                    select: '#frm_programfor'

                                });

                            </script>

                        </div>

                        <div class="form-group col-md-12">

                            <label style="width: 100%">Age Range</label>

                            <select name="frm_agerange[]" id="frm_agerange" multiple>

                                <option value="Baby (0 to 12 months)">Baby (0 to 12 months)</option>

                                <option value="Toddler (1 to 3 yrs.)">Toddler (1 to 3 yrs.)</option>

                                <option value="Preschool (4 to 5 yrs.)">Preschool (4 to 5 yrs.)</option>

                                <option value="Grade School (6 to 12 yrs.)">Grade School (6 to 12 yrs.)</option>

                                <option value="Teen (13 to 17 yrs.)">Teen (13 to 17 yrs.)</option>

                                <option value="Young Adult (18 to 21 yrs.)">Young Adult (18 to 21 yrs.)</option>

                                <option value="Older Adult (21 to 39 yrs.)">Older Adult (21 to 39 yrs.)</option>

                                <option value="Middle Age (40 to 59 yrs.)">Middle Age (40 to 59 yrs.)</option>

                                <option value="Senior Adult (60 +)">Senior Adult (60 +)</option>

                                <option value="Any">Any</option>

                            </select>

                            <script>

                                var p = new SlimSelect({

                                    select: '#frm_agerange'

                                });

                            </script>

                        </div>

                        <div class="form-group col-md-12">

                            <label style="width: 100%">Difficulty Level</label>

                            <select name="frm_experience_level[]" id="frm_experience_level" multiple>

                                <option>Easy</option>

                                <option>Medium</option>

                                <option>Hard</option>

                                <option>Any</option>

                                

                            </select>

                            <script>

                                var p = new SlimSelect({

                                    select: '#frm_experience_level'

                                });

                            </script>

                        </div>

                        <div class="form-group col-md-12">

                            <label style="width: 100%">Activity Experience</label>

                            <select name="frm_servicefocuses[]" id="frm_servicefocuses" multiple>

                                <option value="Have Fun"> Have Fun</option>

                                <option value="Adventurous">Adventurous</option>

                                <option value="Thrilling">Thrilling</option>

                               <?php /*?> <option value="Dangerous">Dangerous </option><?php */?>

                                <option value="Physically Challenging">Physically Challenging </option>

                                <option value="Mentally Challenging">Mentally Challenging </option>

                                <option value="Peaceful">Peaceful</option>

                                <option value="Calm">Calm</option>

                                <option value="Gain Focus">Gain Focus</option>

                                <option value="Learning a skill">Learning a skill</option>

                                <option value="To accomplish a goal">To accomplish a goal</option>

                                <option value="Gain Discipline">Gain Discipline</option>

                                <option value="Gain Confidence">Gain Confidence</option>

                                <option value="Better hand-eye coordination">Better hand-eye coordination</option>

                                <option value="Get a toned body">Get a toned body</option>

                                <option value="Get better nutrition habits">Get better nutrition habits</option>

                                <option value="Release Pain">Release Pain</option>

                                <option value="Relax">Relax</option>

                                <option value="Body Alignment">Body Alignment</option>

                                <option value="Strength and Conditioning">Strength and Conditioning </option>

                                <option value="Athletic Conditioning">Athletic Conditioning</option>

                                <option value="Better Technique">Better Technique</option>

                                <option value="Weight Loss Help">Weight Loss Help</option>

                                <option value="Competition training and prep">Competition training and prep</option>

                                <option value="Gain better cardio">Gain better cardio</option>

                            </select>

                            <script>

                                var p = new SlimSelect({

                                    select: '#frm_servicefocuses'

                                });

                            </script>

                        </div>

                        <div class="form-group col-md-12">

                            <label style="width: 100%">Personality & Habits of Instructor</label>

                            <select name="frm_teachingstyle[]" id="teaching" multiple>

                                <option value="An educator &amp; teacher">An Educator</option>

                                <option value="A lot of energy">A Teacher</option>

                                <option value="A drill sergeant">A lot of energy</option>

                                <option value="Inspiring">A drill sergeant</option>

                                <option value="Inspiring">Inspiring</option>

                                <option value="Motivational">Motivational</option>

                                <option value="Supportive, Soft and Nurturing">Supportive, Soft and Nurturing</option>

                                <option value="Tough and Firm">Tough and Firm</option>

                                <option value="Gentle">Gentle</option>

                                <option value="Intense">Intense</option>

                                <option value="Likes to talk">Likes to talk</option>

                                <option value="Punctual">An entertainer</option>

                                <option value="Organized">Stern</option>

                                <option value="Stern">Friendly & outgoing</option>

                                <option value="Tells jokes and funny">Tells jokes and funny</option>

                                <option value="Loves to talk">Loves to talk about the details</option>

                                <option value="Very Organized">Very Organized</option>

                                <option value="Punctual">Punctual</option>

                                <option value="On Time">On Time</option>

                            </select>

                            <script>

                                var p = new SlimSelect({

                                    select: '#teaching'

                                });

                            </script>

                        </div>

                    </div><!-- row -->

                </div>

              </div>

            </div><!-- row -->

          </div>

          <div class="row">

            <div class="col-md-12">

              <div class="box-footer text-center">  

                <a id="back2" class="btn btn-danger ">Back</a> 

                <button type="button" id="next2" class="btn btn-primary ">Continue</button>

              </div>

            </div>

          </div>
        </div>

        <div id="divstep3" style="display: none">

          <div class="panel-body">

            <div class="row" style="padding: 10px 100px;">

              <div class="col-md-12 text-center">

                  <h3 style="font-size: 17px;font-weight: bold;">SCHEDULE YOUR PROGRAM</h3>

                  <label>Let’s select the dates and times this activity will happen</label>

              </div>

              <div class="col-md-12 text-center" style="padding: 30px 20px;">

                  <div class="row">

                      <div class="form-group col-md-4">

                          <label>Activity Meets</label>

                          <select class="form-control" name="frm_class_meets" id="frm_class_meets">

                              <option value="Weekly">Weekly</option>

                              <option value="On a specific day">On a specific day</option>

                          </select>

                      </div>

                      <div class="form-group col-md-4" id="startingpicker-position">

                          <label>Starting</label>

                          <input type="text" class="form-control frm_starting" name="starting" id="startingpicker" value="" min="<?php echo date('Y-m-d');?>">

                      </div>

                      <div class="form-group col-md-4 schedule_until_box">

                          <input type="hidden" id="end_date" />

                          <label>Program Expire In</label>

                          <select class="form-control" name="frm_schedule_until" id="frm_schedule_until">

                              <option value="1 Month">1 Month</option>

                              <option value="2 Months">2 Months</option>

                              <option value="3 Months">3 Months</option>

                              <option value="4 Months" >4 Months</option>

                              <option value="5 Months" >5 Months</option>

                              <option value="6 Months" >6 Months</option>

                              <option value="7 Months" >7 Months</option>

                              <option value="8 Months" >8 Months</option>

                              <option value="9 Months" >9 Months</option>

                              <option value="10 Months" >10 Months</option>

                              <option value="11 Months" >11 Months</option>

                              <option value="1 Year" >1 Year</option>

                              <option value="2 Years" >2 Years</option>

                              <option value="3 Years" >3 Years</option>

                          </select>

                      </div>

                      <script>

                          $('#end_date').datepicker({

                              dateFormat: "mm/dd/yyyy",

                          });

                      </script>

                  </div>

                  <hr style="border: 1px solid #d4cfcf;width: 100%;">

                  

                  <div id="day-circle">
                    <input type="hidden"  name="duration_cnt" id="duration_cnt" value="0" />
                    <div id="dayduration0">
                      <div class="daycircle" style="display: none">
                         <input type="hidden" name="activity_days[]" class="activity_days" width="800" value="" />
                          <div class="row weekdays" style="justify-content: center;">

                            <div class="col-md-11" style="display: flex;justify-content: center;">

                              <div data-day="Sunday" class="col-sm-1 timezone-round day_circle Sunday dys">

                                  <p>Su</p>

                              </div>

                              <div data-day="Monday" class="col-sm-1 timezone-round day_circle Monday dys">

                                  <p>Mo</p>

                              </div>

                              <div data-day="Tuesday" class="col-sm-1 timezone-round day_circle Tuesday dys">

                                  <p>Tu</p>

                              </div>

                              <div data-day="Wednesday" class="col-sm-1 timezone-round day_circle Wednesday dys">

                                  <p>We</p>

                              </div>

                              <div data-day="Thursday" class="col-sm-1 timezone-round day_circle Thursday dys">

                                  <p>Th</p>

                              </div>

                              <div data-day="Friday" class="col-sm-1 timezone-round day_circle Friday dys">

                                  <p>Fr</p>

                              </div>

                              <div data-day="Saturday" class="col-sm-1 timezone-round day_circle Saturday dys">

                                  <p>Sa</p>

                              </div>

                              </div>

                              <div class="col-md-1"><i class="remove-activity fa fa-trash-o" style="color:red; font-weight:bold; cursor:pointer; float:right" title="Remove activity"></i></div>

                          </div>

                          <div class="row">

                              <div class="form-group col-md-4">

                                  From

                              </div>

                              <div class="form-group col-md-4">

                                  To

                              </div>

                              <div class="form-group col-md-4">

                                  Duration

                              </div>

                          </div>

                          <div class="row">

                              <div class="form-group col-md-4">

                                  <?php timeSlotOption('shift_start', ''); ?>

                              </div>

                              <div class="form-group col-md-4">

                                  <?php timeSlotOption('shift_end', ''); ?>

                              </div>

                              <div class="form-group col-md-4">

                                  <input type="text" name="set_duration[]" id="set_duration" value="" readonly class="set_duration form-control" style="width:90%">

                                   

                              </div>

                          </div>

                      </div>

                      </div>

                    </div>

                  <br/>

                  <div id="activity_scheduler_body">

                      <!-- Activity description will fill here -->

                  </div>

                  <div class="col-md-12 text-center" style="margin-top: 50px;">

                      <a id="test" class="button-fitness add-another-time">Add Another Time</a>

                  </div>

              </div>

            </div>

          </div>

          <div class="row">

            <div class="col-md-12">

              <div class="box-footer text-center">  

                <a id="back3" class="btn btn-danger ">Back</a>         

                <button type="button" id="next3" class="btn btn-primary ">Continue</button>

              </div>

            </div>

          </div>
        </div>

        <div id="divstep4" style="display: none"  >  
          <div class="panel-body">
            <div class="row">
              <div class="col-md-12">
                  <h3 style="font-size: 17px;font-weight: bold;">SET UP YOUR PRICING DETAILS</h3>
              </div>
              <div class="col-md-12" style="padding:10px 0">
              </div>

              <div class="service_price_block">
                <input type="hidden"  name="recurring_count" id="recurring_count" value="0" />
                <input type="hidden" name="fitnessity_fee" value="{{$fitnessity_fee}}">
                <div id="pricediv0">
                  <input type="hidden"  name="ages_count0" id="ages_count0" value="0" />
                  <div id="agesmaindiv0">
                    <div id="agesdiv00">
                      <div class="row">
                        <div class="col-md-3">
                          <div class="priceselect sp-select">
                            <label>Category Title (Give a name for this category)</label>
                            <input type="text" name="category_title[]" id="category_title"  class="inputs">
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="sp-select-sche">
                            <!--  <p><a onclick="setschedule();">+Set Your Schedule</a>(Schedule the times this activity will happen)</p> -->
                          </div>
                        </div>
                      </div>

                      <div class="row mt-30">
                        <div class="col-md-3 col-sm-6">
                          <div class="priceselect sp-select">
                            <label>Price Title</label>
                            <input type="text" name="price_title_00" id="price_title00"  class="inputs" placeholder="ex. 30 Minute Section" oninput="getpricetitle(0,0)">
                          </div>
                        </div>
                        <div class="col-md-3 col-sm-6">
                          <div class="priceselect sp-select">
                            <label>Session Type</label>
                            <select name="pay_session_type_00" id="pay_session_type00" class="bd-right bd-bottom pay_session_type" onchange="pay_session_select(0,0,this.value);">
                              <option value="">Select Value</option>
                              <option value="Single">Single</option>
                              <option value="Multiple">Multiple</option>
                              <option value="Unlimited">Unlimited</option>
                            </select>
                          </div>
                        </div>

                        <div class="col-md-3 col-sm-6">
                          <div class="priceselect sp-select">
                            <label>Number of Sessions</label>
                            <input type="text" name="pay_session_00" id="pay_session00"  class="inputs pay_session" placeholder="1" value="">
                          </div>
                        </div>

                        <div class="col-md-3 col-sm-6">
                          <div class="priceselect sp-select">
                            <label>Membership Type</label>
                            <select name="membership_type_00" id="membership_type00" class="bd-right bd-bottom membership_type">
                              <option value="Drop In">Drop In</option>
                              <option value="Semester">Semester (Long Term)</option>
                            </select>
                          </div>
                        </div>
                      </div>
                      <div class="row">
                          <div class="col-md-12">
                              <div class="setprice sp-select">
                                  <h3>You can set your prices to be the same or different based on age, the weekday or the weekend.To add prices for children or infants, click on the box.</h3>
                              </div>
                          </div>
                      </div>
                      <div class="row">
                        <div class="age-cat">
                          <div class="cat-age sp-select">
                              <label>Adults</label>
                              <p>Ages 12 & Older</p>
                          </div>
                        </div>
                        <div class="weekly-customer">
                            <div class="cus-week-price sp-select">
                                <label>Weekday Price</label>
                                <p> (Monday - Friday)</p>
                                <input type="text" name="adult_cus_weekly_price_00" id="adult_cus_weekly_price00" placeholder="$"  onkeyup="adultchangeestprice(0,0);">
                            </div>
                        </div>
                        <div class="weekend-price">
                            <div class="cus-week-price sp-select">
                                <label>Weekend Price </label>
                                <p> ( Saturday & Sunday)</p>
                                <input type="text" name="adult_weekend_price_diff_00" id="adult_weekend_price_diff00" placeholder="$" onkeyup="weekendadultchangeestprice(0,0);">
                            </div>
                        </div>
                        <div class="re-discount">
                            <div class="discount sp-select">
                                <label>Any Discount? </label>
                                <p> (Recommended 10% to 15%)</p>
                                <input type="text" name="adult_discount_00" id="adult_discount00" onkeyup="adultdischangeestprice(0,0);">
                            </div>
                        </div>
                        <div class="single-dash">
                            <div class="desh sp-select">
                                <label>-</label>
                            </div>
                        </div>
                        <div class="fit-fees">
                            <div class="fees sp-select">
                                <label>Fitnessity Fee </label>
                                <p> {{$fitnessity_fee}}%</p>
                            </div>
                        </div>
                        <div class="single-equal">
                            <div class="equal sp-select">
                                <label>=</label>
                            </div>
                        </div>
                        <div class="estimated-earn">
                            <div class="cus-week-price sp-select">
                                <label>Weekday Estimated Earnings </label>
                                <input type="text" name="adult_estearn_00" id="adult_estearn00" placeholder="$">
                            </div>
                        </div>
                        <div class="estimated-earn">
                          <div class="cus-week-price sp-select">
                              <label>Weekend Estimated Earnings</label>
                              <input type="text" name="weekend_adult_estearn_00" id="weekend_adult_estearn00" placeholder="$" >
                          </div>
                        </div>
                        <div class="col-md-12">
                          <div class="priceselect sp-select modelmargin">
                            <input class="modelcheckbox"  data-count="0"  type="checkbox" id="is_recurring_adult00" name="is_recurring_adult_00" value="0" onclick="openmodelbox(0,0,'adult');" >
                            <label>Is This A Recurring Payment? Set the monthly payment terms for Adults</label>
                            <button style="display:none" id="btn_recurring_adult00" name="btn_recurring_adult_00[]" type="button" data-count="0" class="btn btn-primary recurrint_id" data-toggle="modal" data-target="#ModelRecurring_adult00" onclick="recurrint_id(0,0,'adult');">Launch demo modal</button>
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="age-cat">
                            <div class="cat-age sp-select">
                                <label>Children</label>
                                <p>Ages 2 to 12</p>
                            </div>
                        </div>
                        <div class="weekly-customer">
                            <div class="cus-week-price sp-select">
                                <label>Weekday Price</label>
                                <p> (Monday - Friday)</p>
                                <input type="text" name="child_cus_weekly_price_00" id="child_cus_weekly_price00" placeholder="$" onkeyup="childchangeestprice(0,0);">
                            </div>
                        </div>
                        <div class="weekend-price">
                            <div class="cus-week-price sp-select">
                                <label>Weekend Price</label>
                                <p> ( Saturday & Sunday)</p>
                                <input type="text" name="child_weekend_price_diff_00" id="child_weekend_price_diff00" placeholder="$" onkeyup="weekendchildchangeestprice(0,0);">
                            </div>
                        </div>
                        <div class="re-discount">
                            <div class="discount sp-select">
                                <label>Any Discount?</label>
                                <p> (Recommended 10% to 15%)</p>
                                <input type="text" name="child_discount_00" id="child_discount00"  onkeyup="childdischangeestprice(0,0);">
                            </div>
                        </div>
                        <div class="single-dash">
                            <div class="desh sp-select">
                                <label>-</label>
                            </div>
                        </div>
                        <div class="fit-fees">
                            <div class="fees sp-select">
                                <label>Fitnessity Fee</label>
                                <p> {{$fitnessity_fee}}%</p>
                            </div>
                        </div>
                        <div class="single-equal">
                            <div class="equal sp-select">
                                <label>=</label>
                            </div>
                        </div>
                        <div class="estimated-earn">
                            <div class="cus-week-price sp-select">
                                <label>Weekday Estimated Earnings</label>
                                <input type="text" name="child_estearn_00" id="child_estearn00" placeholder="$" >
                            </div>
                        </div>
                        <div class="estimated-earn">
                          <div class="cus-week-price sp-select">
                              <label>Weekend Estimated Earnings</label>
                              <input type="text" name="weekend_child_estearn_00" id="weekend_child_estearn00" placeholder="$" >
                          </div>
                        </div>
                        <div class="col-md-12">
                          <div class="priceselect sp-select modelmargin">
                            <input class="modelcheckbox"  data-count="0"  type="checkbox" id="is_recurring_child00" name="is_recurring_child_00" value="0"  onclick="openmodelbox(0,0,'child');" >
                            <label>Is This A Recurring Payment? Set the monthly payment terms for Children</label>
                            <button style="display:none" id="btn_recurring_child00" name="btn_recurring_child_00[]" type="button" data-count="0" class="btn btn-primary recurrint_id" data-toggle="modal" data-target="#ModelRecurring_child00" onclick="recurrint_id(0,0,'child');">Launch demo modal</button>
                          </div>
                        </div>
                      </div>
                      <div class="row">
                          <div class="age-cat">
                              <div class="cat-age sp-select">
                                  <label>Infants</label>
                                  <p>Ages 2 & Under</p>
                              </div>
                          </div>
                          <div class="weekly-customer">
                              <div class="cus-week-price sp-select">
                                  <label>Weekday Price</label>
                                  <p> (Monday - Friday)</p>
                                  <input type="text" name="infant_cus_weekly_price_00" id="infant_cus_weekly_price00" placeholder="$" onkeyup="infantchangeestprice(0,0);">
                              </div>
                          </div>
                          <div class="weekend-price">
                              <div class="cus-week-price sp-select">
                                  <label>Weekend Price</label>
                                  <p> ( Saturday & Sunday)</p>
                                  <input type="text" name="infant_weekend_price_diff_00" id="infant_weekend_price_diff00" placeholder="$" onkeyup="weekendinfantchangeestprice(0,0);">
                              </div>
                          </div>
                          <div class="re-discount">
                              <div class="discount sp-select">
                                  <label>Any Discount?</label>
                                  <p> (Recommended 10% to 15%)</p>
                                  <input type="text" name="infant_discount_00" id="infant_discount00" onkeyup="infantdischangeestprice(0,0);">
                              </div>
                          </div>
                          <div class="single-dash">
                              <div class="desh sp-select">
                                  <label>-</label>
                              </div>
                          </div>
                          <div class="fit-fees">
                              <div class="fees sp-select">
                                  <label>Fitnessity Fee</label>
                                  <p> {{$fitnessity_fee}}%</p>
                              </div>
                          </div>
                          <div class="single-equal">
                              <div class="equal sp-select">
                                  <label>=</label>
                              </div>
                          </div>
                          <div class="estimated-earn">
                              <div class="cus-week-price sp-select">
                                  <label>Weekday Estimated Earnings</label>
                                  <input type="text" name="infant_estearn_00" id="infant_estearn00" placeholder="$">
                              </div>
                          </div>
                        <div class="estimated-earn">
                          <div class="cus-week-price sp-select">
                            <label>Weekend Estimated Earnings</label>
                            <input type="text" name="weekend_infant_estearn_00" id="weekend_infant_estearn00" placeholder="$">
                          </div>
                        </div>

                        <div class="col-md-12">
                          <div class="priceselect sp-select modelmargin">
                            <input class="modelcheckbox"  data-count="0"  type="checkbox" id="is_recurring_infant00"     name="is_recurring_infant_00" value="0"  onclick="openmodelbox(0,0,'infant');" >
                            <label>Is This A Recurring Payment? Set the monthly payment terms for Infants</label>
                            <button style="display:none" id="btn_recurring_infant00" name="btn_recurring_infant_00[]" type="button" data-count="0" class="btn btn-primary recurrint_id" data-toggle="modal" data-target="#ModelRecurring_infant00" onclick="recurrint_id(0,0,'infant');">Launch demo modal</button>
                          </div>
                        </div>
                      </div>
                      <div class="row">
                          <div class="col-md-12 col-sm-12">
                              <div class="serviceprice sp-select">
                                  <h3>When Does This Price Setting Expire</h3>
                              </div>
                          </div>
                          <div class="col-md-3 col-sm-6 col-xs-12">
                              <div class="set-num">
                                  <label>Set The Number</label>
                                  <input type="text" name="pay_setnum_00" id="pay_setnum00" class="form-control valid" placeholder="(ex,1,2,3,etc.)" value="1" onkeypress="return IsNumeric(event);" ondrop="return false;" onpaste="return false;">
                              </div>
                          </div>
                      
                          <div class="col-md-3 col-sm-6 col-xs-12">
                              <div class="set-num">
                                  <label>The Duration</label>
                                  <select name="pay_setduration_00" id="pay_setduration00" class="form-control valid">
                                      <option value="">Select Value</option>
                                      <option selected="">Days</option>
                                      <option>Months</option>
                                      <option>Year</option>
                                  </select>
                              </div>
                          </div>
                          <div class="col-md-1 col-xs-12">
                              <div class="set-num after">
                                  <label>After</label>
                              </div>
                          </div>
                          <div class="col-md-5 col-xs-12">
                              <div class="after-select">
                                  <select name="pay_after_00" id="pay_after00" class="pay_after form-control valid">
                                      <option value="">Select Value</option>
                                      <option value="1" selected="">Starts to expire the day of purchase</option>
                                      <option value="2">Starts to expire when the customer first participates in the activity</option>
                                  </select>
                              </div>
                          </div>
                      </div>

                                                          <div class="modal fade ModelRecurring_adult00" id="ModelRecurring_adult00" tabindex="-1" role="dialog" aria-labelledby="ModelRecurringTitle" aria-hidden="true">

                                        <div class="modal-dialog editingautopay" role="document">

                                            <div class="modal-content">

                                                <div class="modal-header">

                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">

                                                        <span aria-hidden="true">&times;</span>

                                                    </button>

                                                </div>

                                                <div class="modal-body">

                                                    <div class="row">

                                                        <div class="col-md-12">

                                                            <div class="editingautopay">

                                                                <h5 class="modal-title" id="ModelRecurringTitle_adult00">Editing Recurring Payments Contract Settings for ("Adults")  </h5>

                                                            </div>

                                                        </div>

                                                    </div>

                                                    <div class="row">

                                                        <div class="col-md-8">

                                                            <div class="Settings-title">

                                                                <h5> Settings </h5>

                                                            </div>

                                                            <div class="setting-box">

                                                                <!-- <div class="row set-78">

                                                                    <div class="col-md-4">

                                                                        <label class="contractsettings">Run Auto Pay</label>

                                                                    </div>

                                                                    <div class="col-md-8">

                                                                        <div class="autopay">

                                                                            <input type="radio" id="run_auto_pay_adult00" name="run_auto_pay_adult_00" value="on_set_schedule"  >

                                                                            <label for="on_set_schedule">On a set schedule (recommended)</label><br>

                                                                            <input type="radio" id="run_auto_pay_adult00" name="run_auto_pay_adult_00" value="price_opt_run_out" >

                                                                            <label for="price_opt_run_out">When price option runs out   </label><br> 

                                                                        </div>

                                                                    </div>

                                                                </div> -->

                                                                <div class="row set-78">

                                                                    <div class="col-md-4">

                                                                        <label class="contractsettings">How often will customers be charged?</label>

                                                                    </div>

                                                                    <div class="col-md-8">

                                                                       <!--  <div class="autopay">

                                                                            <input type="radio" id="cust_be_charge_adult00" name="cust_be_charge_adult_00" value="num_of_autopay" >

                                                                            <label for="Autopays">Set number of autopays</label><br>

                                                                            <input type="radio" id="cust_be_charge_adult00" name="cust_be_charge_adult_00" value="month-to-month" >

                                                                            <label for="Month">Month - to -Month    </label><br> 

                                                                        </div>

                                                                        <div class="customerscharged">

                                                                            <label> Every </label>

                                                                            <input type="text" class="form-control valid" name="every_time_num_adult_00" id="every_time_num_adult00" placeholder="1" value="">

                                                                            <select class="form-control" name="every_time_adult_00" id="every_time_adult00">

                                                                                <option value="Weekly" >Weekly</option>

                                                                                <option value="On a specific month">Month </option>

                                                                            </select>

                                                                        </div> -->

                                                                        <p>Customers will be charged every month for the duration of the contract</p>

                                                                    </div>

                                                                </div>

                                                                <div class="row set-78">

                                                                    <div class="col-md-4">

                                                                        <label class="contractsettings">Number of autopays  </label>

                                                                    </div>

                                                                    <div class="col-md-8">

                                                                        <div class="nuberofautopays">

                                                                            <input type="text" class="form-control valid" name="nuberofautopays_adult_00" id="nuberofautopays_adult00" placeholder="12" value="" oninput="getnumberofpmt(0,0,'adult');">

                                                                        </div>

                                                                        <div class="contract">

                                                                            <label>  Total duration of contract: </label>

                                                                            <p id="total_duration_adult00">0 months</p>

                                                                        </div>

                                                                    </div>

                                                                </div>

                                                                <div class="row set-78">

                                                                    <div class="col-md-4">

                                                                        <label class="contractsettings">What happens after 12 payments?</label>

                                                                    </div>

                                                                    <div class="col-md-8">

                                                                        <div class="autopay">

                                                                            <input type="radio" id="happens_aftr_12_pmt_adult00" name="happens_aftr_12_pmt_adult_00" value="contract_expire">

                                                                            <label for="contract">Contract Expires</label><br>

                                                                            <input type="radio" id="happens_aftr_12_pmt_adult00" name="happens_aftr_12_pmt_adult_00" value="contract_renew" >

                                                                            <label for="renews">Contract Automaitcally Renews Every 12 payments</label><br> 

                                                                        </div>

                                                                    </div>

                                                                </div>

                                                                <div class="row set-78">

                                                                    <div class="col-md-4">

                                                                        <label class="contractsettings">When will clients be charged?</label>

                                                                    </div>

                                                                    <div class="col-md-8">

                                                                        <div class="saledate">
                                                                            <input type="hidden" name="client_be_charge_on_adult_00" id="client_be_charge_on_adult_00" value="On the sale date">
                                                                                <p>On the sale date </p>
                                                                            <!-- <select class="form-control" name="client_be_charge_on_adult_00" id="client_be_charge_on_adult00">

                                                                                <option value="sale date" >On the sale date </option> -->

                                                                                <!-- <option value="date" >date</option> -->

                                                                            <!-- </select> -->

                                                                        </div>

                                                                    </div>

                                                                </div>

                                                            </div>

                                                        </div>

                                                        <div class="col-md-4">

                                                            <div class="Settings-title">

                                                                <h5> Contract Review </h5>

                                                            </div>

                                                            <div class="setting-box">

                                                                <div class="set-border">

                                                                    <div class="row">

                                                                        <div class="col-md-8">

                                                                            <p id="p_price_title_adult00"></p>

                                                                        </div>

                                                                        <div class="col-md-4">

                                                                            <p id="p1_price_adult00">$0</p>

                                                                        </div>

                                                                    </div>

                                                                </div>

                                                                <div class="row">

                                                                    <div class="col-md-12">

                                                                        <div class="Settings-title">

                                                                            <h5> Revenue Breakdown </h5>

                                                                        </div>

                                                                    </div>

                                                                    <div class="col-md-10">

                                                                        <p  id="trems_payment_adult00">Terms: 12 Monthly Payments</p>

                                                                    </div>

                                                                    <div class="col-md-8">

                                                                        <p>First Payment:</p>

                                                                    </div>

                                                                    <div class="col-md-4">

                                                                        <p id="p_first_pmt_adult00">$0</p>

                                                                    </div>

                                                                    <input type="hidden" name="first_pmt_adult_00" id="first_pmt_adult00" value="">

                                                                    <input type="hidden" name="recurring_pmt_adult_00" id="recurring_pmt_adult00" value="">

                                                                    <div class="col-md-8">

                                                                        <p>Recurring Payment: </p>

                                                                    </div>

                                                                    <div class="col-md-4">

                                                                        <p id="p_recurring_pmt_adult00">$0</p>

                                                                    </div>

                                                                    <input type="hidden" name="total_contract_revenue_adult_00" id="total_contract_revenue_adult00" value="">

                                                                    <div class="col-md-8">

                                                                        <label>Total Contract Revenue:  </label>

                                                                    </div>

                                                                    <div class="col-md-4">

                                                                        <p id="p_total_contract_revenue_adult00"> $0</p>

                                                                    </div>

                                                                </div>

                                                                <!-- <div class="modal-footer">

                                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

                                                                    <button type="button" class="btn button-fitness" data-dismiss="modal">Save</button>

                                                                </div> -->

                                                            </div>

                                                        </div>

                                                    </div>

                                                </div>

                                            </div>

                                        </div>

                                    </div> 

                                    

                                    <div class="modal fade ModelRecurring_child00" id="ModelRecurring_child00" tabindex="-1" role="dialog" aria-labelledby="ModelRecurringTitle" aria-hidden="true">

                                        <div class="modal-dialog editingautopay" role="document">

                                            <div class="modal-content">

                                                <div class="modal-header">

                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">

                                                        <span aria-hidden="true">&times;</span>

                                                    </button>

                                                </div>

                                                <div class="modal-body">

                                                    <div class="row">

                                                        <div class="col-md-12">

                                                            <div class="editingautopay">

                                                                <h5 class="modal-title" id="ModelRecurringTitle_child00">Editing Recurring Payments Contract Settings for ("Children") </h5>

                                                            </div>

                                                        </div>

                                                    </div>

                                                    <div class="row">

                                                        <div class="col-md-8">

                                                            <div class="Settings-title">

                                                                <h5> Settings </h5>

                                                            </div>

                                                            <div class="setting-box">

                                                                <!-- <div class="row set-78">

                                                                    <div class="col-md-4">

                                                                        <label class="contractsettings">Run Auto Pay</label>

                                                                    </div>

                                                                    <div class="col-md-8">

                                                                        <div class="autopay">

                                                                            <input type="radio" id="run_auto_pay_child00" name="run_auto_pay_child_00" value="on_set_schedule"  >

                                                                            <label for="on_set_schedule">On a set schedule (recommended)</label><br>

                                                                            <input type="radio" id="run_auto_pay_child00" name="run_auto_pay_child_00" value="price_opt_run_out" >

                                                                            <label for="price_opt_run_out">When price option runs out   </label><br> 

                                                                        </div>

                                                                    </div>

                                                                </div> -->

                                                                <div class="row set-78">

                                                                    <div class="col-md-4">

                                                                        <label class="contractsettings">How often will customers be charged?</label>

                                                                    </div>

                                                                    <div class="col-md-8">

                                                                        <!-- <div class="autopay">

                                                                            <input type="radio" id="cust_be_charge_child00" name="cust_be_charge_child_00" value="num_of_autopay">

                                                                            <label for="Autopays">Set number of autopays</label><br>

                                                                            <input type="radio" id="cust_be_charge_child00" name="cust_be_charge_child_00" value="month-to-month">

                                                                            <label for="Month">Month - to -Month    </label><br> 

                                                                        </div>

                                                                        <div class="customerscharged">

                                                                            <label> Every </label>

                                                                            <input type="text" class="form-control valid" name="every_time_num_child_00" id="every_time_num_child00" placeholder="1" value="">

                                                                            <select class="form-control" name="every_time_child_00" id="every_time_child00">

                                                                                <option value="Weekly">Weekly</option>

                                                                                <option value="On a specific month" >Month </option>

                                                                            </select>

                                                                        </div> -->

                                                                        <p>Customers will be charged every month for the duration of the contract</p>

                                                                    </div>

                                                                </div>

                                                                <div class="row set-78">

                                                                    <div class="col-md-4">

                                                                        <label class="contractsettings">Number of autopays  </label>

                                                                    </div>

                                                                    <div class="col-md-8">

                                                                        <div class="nuberofautopays">

                                                                            <input type="text" class="form-control valid" name="nuberofautopays_child_00" id="nuberofautopays_child00" placeholder="12" value="" oninput="getnumberofpmt(0,0,'child');">

                                                                        </div>

                                                                        <div class="contract">

                                                                            <label>  Total duration of contract: </label>

                                                                            <p id="total_duration_child00">0 months</p>

                                                                        </div>

                                                                    </div>

                                                                </div>

                                                                <div class="row set-78">

                                                                    <div class="col-md-4">

                                                                        <label class="contractsettings">What happens after 12 payments?</label>

                                                                    </div>

                                                                    <div class="col-md-8">

                                                                        <div class="autopay">

                                                                            <input type="radio" id="happens_aftr_12_pmt_child00" name="happens_aftr_12_pmt_child_00" value="contract_expire">

                                                                            <label for="contract">Contract Expires</label><br>

                                                                            <input type="radio" id="happens_aftr_12_pmt_child00" name="happens_aftr_12_pmt_child_00" value="contract_renew">

                                                                            <label for="renews">Contract Automaitcally Renews Every 12 payments</label><br> 

                                                                        </div>

                                                                    </div>

                                                                </div>

                                                                <div class="row set-78">

                                                                    <div class="col-md-4">

                                                                        <label class="contractsettings">When will clients be charged?</label>

                                                                    </div>

                                                                    <div class="col-md-8">

                                                                        <div class="saledate">
                                                                            <input type="hidden" name="client_be_charge_on_child_00" id="client_be_charge_on_child_00" value="On the sale date">
                                                                                <p>On the sale date </p>
                                                                            <!-- <select class="form-control" name="client_be_charge_on_child_00" id="client_be_charge_on_child00">

                                                                                <option value="sale date" >On the sale date </option> -->

                                                                               <!--  <option value="date">date</option> -->

                                                                           <!--  </select> -->

                                                                        </div>

                                                                    </div>

                                                                </div>

                                                            </div>

                                                        </div>

                                                        <div class="col-md-4">

                                                            <div class="Settings-title">

                                                                <h5> Contract Review </h5>

                                                            </div>

                                                            <div class="setting-box">

                                                                <div class="set-border">

                                                                    <div class="row">

                                                                        <div class="col-md-8">

                                                                            <p id="p_price_title_child00"></p>

                                                                        </div>

                                                                        <div class="col-md-4">

                                                                            <p  id="p1_price_child00">$0</p>

                                                                        </div>

                                                                    </div>

                                                                </div>

                                                                <div class="row">

                                                                    <div class="col-md-12">

                                                                        <div class="Settings-title">

                                                                            <h5> Revenue Breakdown </h5>

                                                                        </div>

                                                                    </div>

                                                                    <div class="col-md-10">

                                                                        <p id="trems_payment_child00">Terms: 12 Monthly Payments</p>

                                                                    </div>

                                                                    <div class="col-md-8">

                                                                        <p>First Payment:</p>

                                                                    </div>

                                                                    <div class="col-md-4">

                                                                        <p id="p_first_pmt_child00">$0</p>

                                                                    </div>

                                                                    <input type="hidden" name="first_pmt_child_00" id="first_pmt_child00" value="">

                                                                    <input type="hidden" name="recurring_pmt_child_00" id="recurring_pmt_child00" value="">

                                                                    <div class="col-md-8">

                                                                        <p>Recurring Payment: </p>

                                                                    </div>

                                                                    <div class="col-md-4">

                                                                        <p id="p_recurring_pmt_child00">$0</p>

                                                                    </div>

                                                                    <input type="hidden" name="total_contract_revenue_child_00" id="total_contract_revenue_child00" value="">

                                                                    <div class="col-md-8">

                                                                        <label>Total Contract Revenue:  </label>

                                                                    </div>

                                                                    <div class="col-md-4">

                                                                        <p id="p_total_contract_revenue_child00"> $0</p>

                                                                    </div>

                                                                </div>

                                                                <!-- <div class="modal-footer">

                                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

                                                                    <button type="button" class="btn button-fitness" data-dismiss="modal">Save</button>

                                                                </div> -->

                                                            </div>

                                                        </div>

                                                    </div>

                                                </div>

                                            </div>

                                        </div>

                                    </div>



                                    <div class="modal fade ModelRecurring_infant00" id="ModelRecurring_infant00" tabindex="-1" role="dialog" aria-labelledby="ModelRecurringTitle" aria-hidden="true">

                                        <div class="modal-dialog editingautopay" role="document">

                                            <div class="modal-content">

                                                <div class="modal-header">

                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">

                                                        <span aria-hidden="true">&times;</span>

                                                    </button>

                                                </div>

                                                <div class="modal-body">

                                                    <div class="row">

                                                        <div class="col-md-12">

                                                            <div class="editingautopay">

                                                                <h5 class="modal-title" id="ModelRecurringTitle_infant00">Editing Recurring Payments Contract Settings for ("Infant")  </h5>

                                                            </div>

                                                        </div>

                                                    </div>

                                                    <div class="row">

                                                        <div class="col-md-8">

                                                            <div class="Settings-title">

                                                                <h5> Settings </h5>

                                                            </div>

                                                            <div class="setting-box">

                                                                <!-- <div class="row set-78">

                                                                    <div class="col-md-4">

                                                                        <label class="contractsettings">Run Auto Pay</label>

                                                                    </div>

                                                                    <div class="col-md-8">

                                                                        <div class="autopay">

                                                                            <input type="radio" id="run_auto_pay_infant00" name="run_auto_pay_infant_00" value="on_set_schedule"  >

                                                                            <label for="on_set_schedule">On a set schedule (recommended)</label><br>

                                                                            <input type="radio" id="run_auto_pay_infant00" name="run_auto_pay_infant_00" value="price_opt_run_out" >

                                                                            <label for="price_opt_run_out">When price option runs out   </label><br> 

                                                                        </div>

                                                                    </div>

                                                                </div> -->

                                                                <div class="row set-78">

                                                                    <div class="col-md-4">

                                                                        <label class="contractsettings">How often will customers be charged?</label>

                                                                    </div>

                                                                    <div class="col-md-8">

                                                                        <!-- <div class="autopay">

                                                                            <input type="radio" id="cust_be_charge_infant00" name="cust_be_charge_infant_00" value="num_of_autopay" >

                                                                            <label for="Autopays">Set number of autopays</label><br>

                                                                            <input type="radio" id="cust_be_charge_infant00" name="cust_be_charge_infant_00" value="month-to-month">

                                                                            <label for="Month">Month - to -Month    </label><br> 

                                                                        </div>

                                                                        <div class="customerscharged">

                                                                            <label> Every </label>

                                                                            <input type="text" class="form-control valid" name="every_time_num_infant_00" id="every_time_num_infant00" placeholder="1" value="">

                                                                            <select class="form-control" name="every_time_infant_00" id="every_time_infant00">

                                                                                <option value="Weekly">Weekly</option>

                                                                                <option value="On a specific month" >Month </option>

                                                                            </select>

                                                                        </div> -->

                                                                        <p>Customers will be charged every month for the duration of the contract</p>

                                                                    </div>

                                                                </div>

                                                                <div class="row set-78">

                                                                    <div class="col-md-4">

                                                                        <label class="contractsettings">Number of autopays  </label>

                                                                    </div>

                                                                    <div class="col-md-8">

                                                                        <div class="nuberofautopays">

                                                                            <input type="text" class="form-control valid" name="nuberofautopays_infant_00" id="nuberofautopays_infant00" placeholder="12" value="" oninput="getnumberofpmt(0,0,'infant');">

                                                                        </div>

                                                                        <div class="contract">

                                                                            <label>  Total duration of contract: </label>

                                                                            <p id="total_duration_infant00">0 months</p>

                                                                        </div>

                                                                    </div>

                                                                </div>

                                                                <div class="row set-78">

                                                                    <div class="col-md-4">

                                                                        <label class="contractsettings">What happens after 12 payments?</label>

                                                                    </div>

                                                                    <div class="col-md-8">

                                                                        <div class="autopay">

                                                                            <input type="radio" id="happens_aftr_12_pmt_infant00" name="happens_aftr_12_pmt_infant_00" value="contract_expire">

                                                                            <label for="contract">Contract Expires</label><br>

                                                                            <input type="radio" id="happens_aftr_12_pmt_infant00" name="happens_aftr_12_pmt_infant_00" value="contract_renew" >

                                                                            <label for="renews">Contract Automaitcally Renews Every 12 payments</label><br> 

                                                                        </div>

                                                                    </div>

                                                                </div>

                                                                <div class="row set-78">

                                                                    <div class="col-md-4">

                                                                        <label class="contractsettings">When will clients be charged?</label>

                                                                    </div>

                                                                    <div class="col-md-8">

                                                                        <div class="saledate">
                                                                            <input type="hidden" name="client_be_charge_on_infant_00" id="client_be_charge_on_infant_00" value="On the sale date">
                                                                                <p>On the sale date </p>
                                                                            <!-- <select class="form-control" name="client_be_charge_on_infant_00" id="client_be_charge_on_infant00">

                                                                                <option value="sale date" >On the sale date </option> -->

                                                                                <!-- <option value="date">date</option> -->

                                                                            <!-- </select> -->

                                                                        </div>

                                                                    </div>

                                                                </div>

                                                            </div>

                                                        </div>

                                                        <div class="col-md-4">

                                                            <div class="Settings-title">

                                                                <h5> Contract Review </h5>

                                                            </div>

                                                            <div class="setting-box">

                                                                <div class="set-border">

                                                                    <div class="row">

                                                                        <div class="col-md-8">

                                                                            <p id="p_price_title_infant00"></p>

                                                                        </div>

                                                                        <div class="col-md-4">

                                                                            <p  id="p1_price_infant00">$0</p>

                                                                        </div>

                                                                    </div>

                                                                </div>

                                                                <div class="row">

                                                                    <div class="col-md-12">

                                                                        <div class="Settings-title">

                                                                            <h5> Revenue Breakdown </h5>

                                                                        </div>

                                                                    </div>

                                                                    <div class="col-md-10">

                                                                        <p id="trems_payment_infant00">Terms: 12 Monthly Payments</p>

                                                                    </div>

                                                                    <div class="col-md-8">

                                                                        <p>First Payment:</p>

                                                                    </div>

                                                                    <div class="col-md-4">

                                                                        <p id="p_first_pmt_infant00">$0</p>

                                                                    </div>

                                                                    <input type="hidden" name="first_pmt_infant_00" id="first_pmt_infant00" value="">

                                                                    <input type="hidden" name="recurring_pmt_infant_00" id="recurring_pmt_infant00" value="">

                                                                    <div class="col-md-8">

                                                                        <p>Recurring Payment: </p>

                                                                    </div>

                                                                    <div class="col-md-4">

                                                                        <p id="p_recurring_pmt_infant00">$0</p>

                                                                    </div>

                                                                    <input type="hidden" name="total_contract_revenue_infant_00" id="total_contract_revenue_infant00" value="">

                                                                    <div class="col-md-8">

                                                                        <label>Total Contract Revenue:  </label>

                                                                    </div>

                                                                    <div class="col-md-4">

                                                                        <p id="p_total_contract_revenue_infant00"> $0</p>

                                                                    </div>

                                                                </div>

                                                                <!-- <div class="modal-footer">

                                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

                                                                    <button type="button" class="btn button-fitness" data-dismiss="modal">Save</button>

                                                                </div> -->

                                                            </div>

                                                        </div>

                                                    </div>

                                                </div>

                                            </div>

                                        </div>

                                    </div>
                    </div>
                  </div>
                  <div  class="row">
                    <div class="col-md-12">
                      <div class="addanother">
                        <a class="" onclick=" return add_another_price_ages(0);"> +Add Another Session </a>
                      </div>  
                    </div>
                  </div>
                </div> 
              </div>
              <div class="col-md-12">
                <div class="row">
                  <div class="col-md-12">
                    <div class="btn-cart-price">
                      <a class="showall-btn add-cate add-another-category-price">Add Another Category Price Options</a>
                      <p>This catagory price option is different from above</p>
                    </div>
                  </div>
                </div>
              </div>  
            </div>
          </div>


          <div class="row">
            <div class="col-md-12">
              <div class="box-footer text-center"> 
                <a id="back4" class="btn btn-danger ">Back</a>
                <button type="submit" id="next4" class="btn btn-primary">Save & Continue</button>
              </div>
            </div>
          </div>
        </div>
      </form>
    </div>


<script type="text/javascript">
  function IsNumeric(evt) {
    var getNumCd = (evt.which) ? evt.which : event.keyCode;
    if (getNumCd != 46 && getNumCd > 31 && (getNumCd < 48 || getNumCd > 57))
      return false;
      return true;
  }

   function pay_session_select(i,j,selectedval){
        if(selectedval=='Single') { 
            $('#pay_session'+i+j).val('1');
            $('#pay_session'+i+j).attr('readonly', true); 
        }
        if(selectedval=='Multiple') {
            
            $('#pay_session'+i+j).val('0');
            $('#pay_session'+i+j).attr('readonly', false);
        }
        if(selectedval=='Unlimited') {
            $('#pay_session'+i+j).val('10000');
            $('#pay_session'+i+j).attr('readonly', true);
        }
    }

    function remove_agediv(i,j) {
        /*alert(i);*/
        var cnt=$('#ages_count'+i).val();
       /* alert(cnt);*/
        cnt--;
        $('#ages_count'+i).val(cnt);
       $('#agesdiv'+i+j).remove(); 

    }

    function setschedule(){
        $("#individualDiv5").hide();
        $("#individualDiv4").show();
    }

    function adultchangeestprice(i,j){

        var adult_discount = 0;
        var pay_price =  $('#adult_cus_weekly_price'+i+j).val();; 

        var adult_discount =  $('#adult_discount'+i+j).val();

        var fitnessity_fee = '{{$fitnessity_fee}}';

        $('#adult_estearn'+i+j).val(pay_price - (pay_price*fitnessity_fee)/100 - (pay_price*adult_discount)/100);

        $('#adult_estearn'+i+j).attr('readonly', true);
        if(pay_price == ''){
            pay_price = 0;
        }
        $('#p1_price_adult'+i+j).html('$'+pay_price);
        $('#p_total_contract_revenue_adult'+i+j).html('$'+pay_price);
        $('#p_recurring_pmt_adult'+i+j).html('$'+pay_price);
        $('#p_first_pmt_adult'+i+j).html('$'+pay_price);
        $('#first_pmt_adult'+i+j).val(pay_price);
        $('#recurring_pmt_adult'+i+j).val(pay_price);
    }



    function weekendadultchangeestprice(i,j){

        var adult_discount = 0;

        var pay_price =  $('#adult_weekend_price_diff'+i+j).val();; 

        var adult_discount =  $('#adult_discount'+i+j).val();

        var fitnessity_fee = '{{$fitnessity_fee}}';

        $('#weekend_adult_estearn'+i+j).val(pay_price - (pay_price*fitnessity_fee)/100 - (pay_price*adult_discount)/100);

        $('#weekend_adult_estearn'+i+j).attr('readonly', true);

    }



    function adultdischangeestprice(i,j){

        var adult_discount = 0;

        var pricval = 0;

        var week_price =  $('#adult_cus_weekly_price'+i+j).val();

        var priceoff = $('#adult_weekend_price_diff'+i+j).val();

        var adult_discount =  $('#adult_discount'+i+j).val();

        var fitnessity_fee = '{{$fitnessity_fee}}';

        $('#adult_estearn'+i+j).val(week_price - ((week_price * adult_discount)/100 + (week_price*fitnessity_fee)/100));

        $('#adult_estearn'+i+j).attr('readonly', true); 

        $('#weekend_adult_estearn'+i+j).val(priceoff - ((priceoff * adult_discount)/100 + (priceoff*fitnessity_fee)/100));

        $('#weekend_adult_estearn'+i+j).attr('readonly', true);

    }



    function childchangeestprice(i,j){

        var child_discount = 0;

        var pricval = 0;

        var pay_price =  $('#child_cus_weekly_price'+i+j).val();

        var child_discount =  $('#child_discount'+i+j).val();

        var fitnessity_fee = '{{$fitnessity_fee}}';

        $('#child_estearn'+i+j).val(pay_price - (pay_price*fitnessity_fee)/100 - (pay_price*child_discount)/100);

        $('#child_estearn'+i+j).attr('readonly', true);
        if(pay_price == ''){
            pay_price = 0;
        }
        $('#p1_price_child'+i+j).html('$'+pay_price);

        $('#p_total_contract_revenue_child'+i+j).html('$'+pay_price);
        $('#p_recurring_pmt_child'+i+j).html('$'+pay_price);
        $('#p_first_pmt_child'+i+j).html('$'+pay_price);
        $('#first_pmt_child'+i+j).val(pay_price);
        $('#recurring_pmt_child'+i+j).val(pay_price);
    }



    function  weekendchildchangeestprice(i,j){

        var child_discount = 0;

        var pricval = 0;

        var pay_price =  $('#child_weekend_price_diff'+i+j).val();

        var child_discount =  $('#child_discount'+i+j).val();

        var fitnessity_fee = '{{$fitnessity_fee}}';

        $('#weekend_child_estearn'+i+j).val(pay_price - (pay_price*fitnessity_fee)/100 - (pay_price*child_discount)/100);

        $('#weekend_child_estearn'+i+j).attr('readonly', true);

    }



    function childdischangeestprice(i,j){

        var child_discount = 0;

        var pricval = 0;

        var week_price =  $('#child_cus_weekly_price'+i+j).val();

        var priceoff = $('#child_weekend_price_diff'+i+j).val();

        var child_discount =  $('#child_discount'+i+j).val();

        var fitnessity_fee = '{{$fitnessity_fee}}';

        $('#child_estearn'+i+j).val(week_price - ((week_price * child_discount)/100 + (week_price*fitnessity_fee)/100));

        $('#child_estearn'+i+j).attr('readonly', true);

        $('#weekend_child_estearn'+i+j).val(priceoff - ((priceoff * child_discount)/100 + (priceoff*fitnessity_fee)/100));

        $('#weekend_child_estearn'+i+j).attr('readonly', true);

    }



    function infantchangeestprice(i,j){

        var infant_discount = 0;

        var pricval = 0;

        var pay_price =  $('#infant_cus_weekly_price'+i+j).val();

        var infant_discount =  $('#infant_discount'+i+j).val();

        var fitnessity_fee = '{{$fitnessity_fee}}';

        $('#infant_estearn'+i+j).val(pay_price - (pay_price*fitnessity_fee)/100 - (pay_price*infant_discount)/100);

        $('#infant_estearn'+i+j).attr('readonly', true);
        if(pay_price == ''){
            pay_price = 0;
        }
       /* alert(pay_price);*/
        $('#p1_price_infant'+i+j).html('$'+pay_price);

        $('#p_total_contract_revenue_infant'+i+j).html('$'+pay_price);
        $('#p_recurring_pmt_infant'+i+j).html('$'+pay_price);
        $('#p_first_pmt_infant'+i+j).html('$'+pay_price);
        $('#first_pmt_infant'+i+j).val(pay_price);
        $('#recurring_pmt_infant'+i+j).val(pay_price);
    }



    function weekendinfantchangeestprice(i,j){

        var infant_discount = 0;

        var pricval = 0;

        var pay_price =  $('#infant_weekend_price_diff'+i+j).val();

        var infant_discount =  $('#infant_discount'+i+j).val();

        var fitnessity_fee = '{{$fitnessity_fee}}';

        $('#weekend_infant_estearn'+i+j).val(pay_price - (pay_price*fitnessity_fee)/100 - (pay_price*infant_discount)/100);

        $('#weekend_infant_estearn'+i+j).attr('readonly', true);

    }



    function infantdischangeestprice(i,j){

        var infant_discount = 0;

        var pricval = 0;

        var pay_price =  $('#infant_cus_weekly_price'+i+j).val();

        var priceoff = $('#infant_weekend_price_diff'+i+j).val();

        var infant_discount =  $('#infant_discount'+i+j).val();

        var fitnessity_fee = '{{$fitnessity_fee}}';

        $('#infant_estearn'+i+j).val(pay_price - ((pay_price * infant_discount)/100 + (pay_price*fitnessity_fee)/100));

        $('#infant_estearn'+i+j).attr('readonly', true);

        $('#weekend_infant_estearn'+i+j).val(priceoff - ((priceoff * infant_discount)/100 + (priceoff*fitnessity_fee)/100));

        $('#weekend_infant_estearn'+i+j).attr('readonly', true);

    }



     function openmodelbox(i,j,val) {

       var checkBox = document.getElementById("is_recurring_"+val+i+j);

        if (checkBox.checked == true){

            $('#btn_recurring_'+val+i+j).trigger("click");

            $('#is_recurring_'+val+i+j).val(1);

        }else{

            $('#is_recurring_'+val+i+j).val(0);

        }

    }
    function recurrint_id(i,j) {
        $('#btn_recurring'+i+j).attr("data-target","#ModelRecurring"+i+j);
    }

    function add_another_price_ages(i){

        var fitnessity_fee = '{{$fitnessity_fee}}';

        var cnt = $('#ages_count'+i).val();

        /*alert(cnt);*/

        cnt++;

        $('#ages_count'+i).val(cnt);

        var ages_data = "";

        ages_data +='<div id="agesdiv'+i+cnt+'"><div class="row"><hr style="border: 1px solid #d4cfcf;width: 100%;"><div class="col-md-11"></div><div class="col-md-1"><i class="remove-agediv fa fa-trash-o" style="color:red; font-weight:bold; cursor:pointer; float:right" title="Remove emp option" onclick="remove_agediv('+i+','+cnt+');"></i></div></div><div class="row"><div class="col-md-4"> </div><div class="col-md-5"> </div></div> <div class="row mt-30"><div class="col-md-3 col-sm-6"><div class="priceselect sp-select"><label>Price Title</label><input type="text" name="price_title_'+i+cnt+'" id="price_title'+i+cnt+'"  class="inputs" placeholder="ex. 30 Minute Section" oninput="getpricetitle('+i+','+cnt+')"></div></div><div class="col-md-3 col-sm-6"><div class="priceselect sp-select"><label>Session Type</label><select name="pay_session_type_'+i+cnt+'" id="pay_session_type'+i+cnt+'" class="bd-right bd-bottom pay_session_type" onchange="pay_session_select('+i+','+cnt+',this.value);"><option value="">Select Value</option><option value="Single">Single</option><option value="Multiple">Multiple</option><option value="Unlimited">Unlimited</option></select></div></div><div class="col-md-3 col-sm-6"><div class="priceselect sp-select"><label>Number of Sessions</label><input type="text" name="pay_session_'+i+cnt+'" id="pay_session'+i+cnt+'"  class="inputs pay_session" placeholder="1" value=""></div></div><div class="col-md-3 col-sm-6"><div class="priceselect sp-select"><label>Membership Type</label><select name="membership_type_'+i+cnt+'" id="membership_type'+i+cnt+'" class="bd-right bd-bottom membership_type"><option value="Drop In">Drop In</option><option value="Semester">Semester (Long Term)</option></select></div></div></div><div class="row"><div class="col-md-12"><div class="setprice sp-select"><h3>You can set your prices to be the same or different based on age, the weekday or the weekend.To add prices for children or infants, click on the box.</h3></div></div></div><div class="row"><div class="age-cat"><div class="cat-age sp-select"><label>Adults</label><p>Ages 12 & Older</p></div></div><div class="weekly-customer"><div class="cus-week-price sp-select"><label>Weekday Price</label><p> (Monday - Friday)</p><input type="text" name="adult_cus_weekly_price_'+i+cnt+'" id="adult_cus_weekly_price'+i+cnt+'" placeholder="$"  onkeyup="adultchangeestprice('+i+','+cnt+');"></div></div><div class="weekend-price"><div class="cus-week-price sp-select"><label>Weekend Price </label><p> ( Saturday & Sunday)</p><input type="text" name="adult_weekend_price_diff_'+i+cnt+'" id="adult_weekend_price_diff'+i+cnt+'" placeholder="$" onkeyup="weekendadultchangeestprice('+i+','+cnt+');"></div></div><div class="re-discount"><div class="discount sp-select"><label>Any Discount? </label><p> (Recommended 10% to 15%)</p><input type="text" name="adult_discount_'+i+cnt+'" id="adult_discount'+i+cnt+'" onkeyup="adultdischangeestprice('+i+','+cnt+');"></div></div><div class="single-dash"><div class="desh sp-select"><label>-</label></div></div><div class="fit-fees"><div class="fees sp-select"><label>Fitnessity Fee </label><p> {{$fitnessity_fee}}%</p></div></div><div class="single-equal"><div class="equal sp-select"><label>=</label></div></div><div class="estimated-earn"><div class="cus-week-price sp-select"><label>Weekday Estimated Earnings </label><input type="text" name="adult_estearn_'+i+cnt+'" id="adult_estearn'+i+cnt+'" placeholder="$"></div></div><div class="estimated-earn"><div class="cus-week-price sp-select"><label>Weekend Estimated Earnings</label><input type="text" name="weekend_adult_estearn_'+i+cnt+'" id="weekend_adult_estearn'+i+cnt+'" placeholder="$" ></div></div><div class="col-md-12"><div class="priceselect sp-select modelmargin">';
        var onclickadult ="'adult'";

        ages_data +='<input class="modelcheckbox"  data-count="0"  type="checkbox" id="is_recurring_adult'+i+cnt+'" name="is_recurring_adult_'+i+cnt+'" value="0" onclick="openmodelbox('+i+','+cnt+','+onclickadult+');" ><label>Is This A Recurring Payment? Set the monthly payment terms for Adults</label><button style="display:none" id="btn_recurring_adult'+i+cnt+'" name="btn_recurring_adult_'+i+cnt+'[]" type="button" data-count="0" class="btn btn-primary recurrint_id" data-toggle="modal" data-target="#ModelRecurring_adult'+i+cnt+'" onclick="recurrint_id('+i+','+cnt+','+onclickadult+');">Launch demo modal</button></div></div></div><div class="row"><div class="age-cat"><div class="cat-age sp-select"><label>Children</label><p>Ages 2 to 12</p></div></div><div class="weekly-customer"><div class="cus-week-price sp-select"><label>Weekday Price</label><p> (Monday - Friday)</p><input type="text" name="child_cus_weekly_price_'+i+cnt+'" id="child_cus_weekly_price'+i+cnt+'" placeholder="$" onkeyup="childchangeestprice('+i+','+cnt+');"></div></div><div class="weekend-price"><div class="cus-week-price sp-select"><label>Weekend Price</label><p> ( Saturday & Sunday)</p><input type="text" name="child_weekend_price_diff_'+i+cnt+'" id="child_weekend_price_diff'+i+cnt+'" placeholder="$" onkeyup="weekendchildchangeestprice('+i+','+cnt+');"></div></div><div class="re-discount"><div class="discount sp-select"><label>Any Discount?</label><p> (Recommended 10% to 15%)</p><input type="text" name="child_discount_'+i+cnt+'" id="child_discount'+i+cnt+'"  onkeyup="childdischangeestprice('+i+','+cnt+');"></div></div><div class="single-dash"><div class="desh sp-select"><label>-</label></div></div><div class="fit-fees"><div class="fees sp-select"><label>Fitnessity Fee</label><p> {{$fitnessity_fee}}%</p></div></div><div class="single-equal"><div class="equal sp-select"><label>=</label></div></div><div class="estimated-earn"><div class="cus-week-price sp-select"><label>Weekday Estimated Earnings</label><input type="text" name="child_estearn_'+i+cnt+'" id="child_estearn'+i+cnt+'" placeholder="$" ></div></div><div class="estimated-earn"><div class="cus-week-price sp-select"><label>Weekend Estimated Earnings</label><input type="text" name="weekend_child_estearn_'+i+cnt+'" id="weekend_child_estearn'+i+cnt+'" placeholder="$" ></div></div><div class="col-md-12"><div class="priceselect sp-select modelmargin">';
        var onclickchild ="'child'";



       ages_data +='<input class="modelcheckbox"  data-count="0"  type="checkbox" id="is_recurring_child'+i+cnt+'" name="is_recurring_child_'+i+cnt+'" value="0"  onclick="openmodelbox('+i+','+cnt+','+onclickchild+');" ><label>Is This A Recurring Payment? Set the monthly payment terms for Children</label><button style="display:none" id="btn_recurring_child'+i+cnt+'" name="btn_recurring_child_'+i+cnt+'[]" type="button" data-count="0" class="btn btn-primary recurrint_id" data-toggle="modal" data-target="#ModelRecurring_child'+i+cnt+'" onclick="recurrint_id('+i+','+cnt+','+onclickchild+');">Launch demo modal</button></div></div></div><div class="row"><div class="age-cat"><div class="cat-age sp-select"><label>Infants</label><p>Ages 2 & Under</p></div></div><div class="weekly-customer"><div class="cus-week-price sp-select"><label>Weekday Price</label><p> (Monday - Friday)</p><input type="text" name="infant_cus_weekly_price_'+i+cnt+'" id="infant_cus_weekly_price'+i+cnt+'" placeholder="$" onkeyup="infantchangeestprice('+i+','+cnt+');"></div></div><div class="weekend-price"><div class="cus-week-price sp-select"><label>Weekend Price</label><p> ( Saturday & Sunday)</p><input type="text" name="infant_weekend_price_diff_'+i+cnt+'" id="infant_weekend_price_diff'+i+cnt+'" placeholder="$" onkeyup="weekendinfantchangeestprice('+i+','+cnt+');"></div></div><div class="re-discount"><div class="discount sp-select"><label>Any Discount?</label><p> (Recommended 10% to 15%)</p><input type="text" name="infant_discount_'+i+cnt+'" id="infant_discount'+i+cnt+'" onkeyup="infantdischangeestprice('+i+','+cnt+');"></div></div><div class="single-dash"><div class="desh sp-select"><label>-</label></div></div><div class="fit-fees"><div class="fees sp-select"><label>Fitnessity Fee</label><p> {{$fitnessity_fee}}%</p></div></div><div class="single-equal"><div class="equal sp-select"><label>=</label></div></div><div class="estimated-earn"><div class="cus-week-price sp-select"><label>Weekday Estimated Earnings</label><input type="text" name="infant_estearn_'+i+cnt+'" id="infant_estearn'+i+cnt+'" placeholder="$"></div></div><div class="estimated-earn"><div class="cus-week-price sp-select"><label>Weekend Estimated Earnings</label><input type="text" name="weekend_infant_estearn_'+i+cnt+'" id="weekend_infant_estearn'+i+cnt+'" placeholder="$"></div></div><div class="col-md-12"><div class="priceselect sp-select modelmargin">';

        var onclickinfant ="'infant'";

        ages_data +='<input class="modelcheckbox"  data-count="0"  type="checkbox" id="is_recurring_infant'+i+cnt+'"     name="is_recurring_infant_'+i+cnt+'" value="0"  onclick="openmodelbox('+i+','+cnt+','+onclickinfant+');" ><label>Is This A Recurring Payment? Set the monthly payment terms for Infants</label><button style="display:none" id="btn_recurring_infant'+i+cnt+'" name="btn_recurring_infant_'+i+cnt+'[]" type="button" data-count="0" class="btn btn-primary recurrint_id" data-toggle="modal" data-target="#ModelRecurring_infant'+i+cnt+'" onclick="recurrint_id('+i+','+cnt+','+onclickinfant+');">Launch demo modal</button></div></div></div><div class="row"><div class="col-md-12 col-sm-12"><div class="serviceprice sp-select"><h3>When Does This Price Setting Expire</h3></div></div><div class="col-md-3 col-sm-6 col-xs-12"><div class="set-num"><label>Set The Number</label><input type="text" name="pay_setnum_'+i+cnt+'" id="pay_setnum'+i+cnt+'" class="form-control valid" placeholder="(ex,1,2,3,etc.)" value="1" onkeypress="return IsNumeric(event);" ondrop="return false;" onpaste="return false;"></div></div><div class="col-md-3 col-sm-6 col-xs-12"><div class="set-num"><label>The Duration</label><select name="pay_setduration_'+i+cnt+'" id="pay_setduration'+i+cnt+'" class="form-control valid"><option value="">Select Value</option><option selected="">Days</option><option>Months</option><option>Year</option></select></div></div><div class="col-md-1 col-xs-12"><div class="set-num after"><label>After</label></div></div><div class="col-md-5 col-xs-12"><div class="after-select"><select name="pay_after_'+i+cnt+'" id="pay_after'+i+cnt+'" class="pay_after form-control valid"><option value="">Select Value</option><option value="1" selected="">Starts to expire the day of purchase</option><option value="2">Starts to expire when the customer first participates in the activity</option></select></div></div></div><div class="modal fade ModelRecurring_adult'+i+cnt+'" id="ModelRecurring_adult'+i+cnt+'" tabindex="-1" role="dialog" aria-labelledby="ModelRecurringTitle" aria-hidden="true"><div class="modal-dialog editingautopay" role="document"><div class="modal-content"><div class="modal-header"><button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button></div><div class="modal-body"><div class="row"><div class="col-md-12"><div class="editingautopay"><h5 class="modal-title" id="ModelRecurringTitle_adult'+i+cnt+'">Editing Recurring Payments Contract Settings for ("Adults")</h5></div></div></div><div class="row"><div class="col-md-8"><div class="Settings-title"><h5> Settings </h5></div><div class="setting-box"><div class="row set-78"><div class="col-md-4"><label class="contractsettings">How often will customers be charged?</label></div><div class="col-md-8"><p>Customers will be charged every month for the duration of the contract</p></div></div><div class="row set-78"><div class="col-md-4"><label class="contractsettings">Number of autopays  </label></div><div class="col-md-8"><div class="nuberofautopays"><input type="text" class="form-control valid" name="nuberofautopays_adult_'+i+cnt+'" id="nuberofautopays_adult'+i+cnt+'" placeholder="12" value="" oninput="getnumberofpmt('+i+','+cnt+','+onclickadult+');"></div><div class="contract"><label>  Total duration of contract: </label><p id="total_duration_adult'+i+cnt+'">0 months</p></div></div></div><div class="row set-78"><div class="col-md-4"><label class="contractsettings">What happens after 12 payments?</label></div><div class="col-md-8"><div class="autopay"><input type="radio" id="happens_aftr_12_pmt_adult'+i+cnt+'" name="happens_aftr_12_pmt_adult_'+i+cnt+'" value="contract_expire"><label for="contract">Contract Expires</label><br><input type="radio" id="happens_aftr_12_pmt_adult'+i+cnt+'" name="happens_aftr_12_pmt_adult_'+i+cnt+'" value="contract_renew" ><label for="renews">Contract Automaitcally Renews Every 12 payments</label><br> </div></div></div><div class="row set-78"><div class="col-md-4"><label class="contractsettings">When will clients be charged?</label></div><div class="col-md-8"><div class="saledate"><input type="hidden" name="client_be_charge_on_adult_'+i+cnt+'" id="client_be_charge_on_adult_'+i+cnt+'" value="On the sale date"><p>On the sale date </p></div></div></div></div></div><div class="col-md-4"><div class="Settings-title"><h5> Contract Review </h5></div><div class="setting-box"><div class="set-border"><div class="row"><div class="col-md-8"><p id="p_price_title_adult'+i+cnt+'"></p></div><div class="col-md-4"><p id="p1_price_adult'+i+cnt+'">$0</p></div></div></div><div class="row"><div class="col-md-12"><div class="Settings-title"><h5> Revenue Breakdown </h5></div></div><div class="col-md-10"><p id="trems_payment_adult'+i+cnt+'">Terms: 0 Monthly Payments</p></div><div class="col-md-8"><p>First Payment:</p></div><div class="col-md-4"><p id="p_first_pmt_adult'+i+cnt+'">$0</p></div><input type="hidden" name="first_pmt_adult_'+i+cnt+'" id="first_pmt_adult'+i+cnt+'" value=""><input type="hidden" name="recurring_pmt_adult_'+i+cnt+'" id="recurring_pmt_adult'+i+cnt+'" value=""><div class="col-md-8"><p>Recurring Payment: </p></div><div class="col-md-4"><p id="p_recurring_pmt_adult'+i+cnt+'">$0</p></div><input type="hidden" name="total_contract_revenue_adult_'+i+cnt+'" id="total_contract_revenue_adult'+i+cnt+'" value=""><div class="col-md-8"><label>Total Contract Revenue:  </label></div><div class="col-md-4"><p id="p_total_contract_revenue_adult'+i+cnt+'"> $0</p></div></div></div></div></div></div></div></div></div> <div class="modal fade ModelRecurring_child'+i+cnt+'" id="ModelRecurring_child'+i+cnt+'" tabindex="-1" role="dialog" aria-labelledby="ModelRecurringTitle" aria-hidden="true"><div class="modal-dialog editingautopay" role="document"><div class="modal-content"><div class="modal-header"><button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button></div><div class="modal-body"><div class="row"><div class="col-md-12"><div class="editingautopay"><h5 class="modal-title" id="ModelRecurringTitle_child'+i+cnt+'">Editing Recurring Payments Contract Settings for ("Children") </h5></div></div></div><div class="row"><div class="col-md-8"><div class="Settings-title"><h5> Settings </h5></div><div class="setting-box"><div class="row set-78"><div class="col-md-4"><label class="contractsettings">How often will customers be charged?</label></div><div class="col-md-8"><p>Customers will be charged every month for the duration of the contract</p></div></div><div class="row set-78"><div class="col-md-4"><label class="contractsettings">Number of autopays  </label></div><div class="col-md-8"><div class="nuberofautopays"><input type="text" class="form-control valid" name="nuberofautopays_child_'+i+cnt+'" id="nuberofautopays_child'+i+cnt+'" placeholder="12" value="" oninput="getnumberofpmt('+i+','+cnt+','+onclickchild+');"></div><div class="contract"><label>  Total duration of contract: </label><p id="total_duration_child'+i+cnt+'">0 months</p></div></div></div><div class="row set-78"><div class="col-md-4"><label class="contractsettings">What happens after 12 payments?</label></div><div class="col-md-8"><div class="autopay"><input type="radio" id="happens_aftr_12_pmt_child'+i+cnt+'" name="happens_aftr_12_pmt_child_'+i+cnt+'" value="contract_expire"><label for="contract">Contract Expires</label><br><input type="radio" id="happens_aftr_12_pmt_child'+i+cnt+'" name="happens_aftr_12_pmt_child_'+i+cnt+'" value="contract_renew"><label for="renews">Contract Automaitcally Renews Every 12 payments</label><br> </div></div></div><div class="row set-78"><div class="col-md-4"><label class="contractsettings">When will clients be charged?</label></div><div class="col-md-8"><div class="saledate"><input type="hidden" name="client_be_charge_on_child_'+i+cnt+'" id="client_be_charge_on_child_'+i+cnt+'" value="On the sale date"><p>On the sale date </p></div></div></div></div></div><div class="col-md-4"><div class="Settings-title"><h5> Contract Review </h5></div><div class="setting-box"><div class="set-border"><div class="row"><div class="col-md-8"><p id="p_price_title_child'+i+cnt+'"></p></div><div class="col-md-4"><p id="p1_price_child'+i+cnt+'">$0</p></div></div></div><div class="row"><div class="col-md-12"><div class="Settings-title"><h5> Revenue Breakdown </h5></div></div><div class="col-md-10"><p id="trems_payment_child'+i+cnt+'">Terms: 0 Monthly Payments</p></div><div class="col-md-8"><p>First Payment:</p></div><div class="col-md-4"><p id="p_first_pmt_child'+i+cnt+'">$0</p></div><input type="hidden" name="first_pmt_child_'+i+cnt+'" id="first_pmt_child'+i+cnt+'" value=""><input type="hidden" name="recurring_pmt_child_'+i+cnt+'" id="recurring_pmt_child'+i+cnt+'" value=""><div class="col-md-8"><p>Recurring Payment: </p></div><div class="col-md-4"><p id="p_recurring_pmt_child'+i+cnt+'">$0</p></div><input type="hidden" name="total_contract_revenue_child_'+i+cnt+'" id="total_contract_revenue_child'+i+cnt+'" value=""><div class="col-md-8"><label>Total Contract Revenue:  </label></div><div class="col-md-4"><p id="p_total_contract_revenue_child'+i+cnt+'"> $0</p></div></div></div></div></div></div></div></div></div><div class="modal fade ModelRecurring_infant'+i+cnt+'" id="ModelRecurring_infant'+i+cnt+'" tabindex="-1" role="dialog" aria-labelledby="ModelRecurringTitle" aria-hidden="true"><div class="modal-dialog editingautopay" role="document"><div class="modal-content"><div class="modal-header"><button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button></div><div class="modal-body"><div class="row"><div class="col-md-12"><div class="editingautopay"><h5 class="modal-title" id="ModelRecurringTitle_infant'+i+cnt+'">Editing Recurring Payments Contract Settings for ("Infant")</h5></div></div></div><div class="row"><div class="col-md-8"><div class="Settings-title"><h5> Settings </h5></div><div class="setting-box"><div class="row set-78"><div class="col-md-4"><label class="contractsettings">How often will customers be charged?</label></div><div class="col-md-8"><p>Customers will be charged every month for the duration of the contract</p></div></div><div class="row set-78"><div class="col-md-4"><label class="contractsettings">Number of autopays  </label></div><div class="col-md-8"><div class="nuberofautopays"><input type="text" class="form-control valid" name="nuberofautopays_infant_'+i+cnt+'" id="nuberofautopays_infant'+i+cnt+'" placeholder="12" value="" oninput="getnumberofpmt('+i+','+cnt+','+onclickinfant+');"></div><div class="contract"><label>  Total duration of contract: </label><p id="total_duration_infant'+i+cnt+'">0 months</p></div></div></div><div class="row set-78"><div class="col-md-4"><label class="contractsettings">What happens after 12 payments?</label></div><div class="col-md-8"><div class="autopay"><input type="radio" id="happens_aftr_12_pmt_infant'+i+cnt+'" name="happens_aftr_12_pmt_infant_'+i+cnt+'" value="contract_expire"><label for="contract">Contract Expires</label><br><input type="radio" id="happens_aftr_12_pmt_infant'+i+cnt+'" name="happens_aftr_12_pmt_infant_'+i+cnt+'" value="contract_renew" ><label for="renews">Contract Automaitcally Renews Every 12 payments</label><br> </div></div></div><div class="row set-78"><div class="col-md-4"><label class="contractsettings">When will clients be charged?</label></div><div class="col-md-8"><div class="saledate"><input type="hidden" name="client_be_charge_on_infant_'+i+cnt+'" id="client_be_charge_on_infant_'+i+cnt+'" value="On the sale date"><p>On the sale date </p></div></div></div></div></div><div class="col-md-4"><div class="Settings-title"><h5> Contract Review </h5></div><div class="setting-box"><div class="set-border"><div class="row"><div class="col-md-8"><p id="p_price_title_infant'+i+cnt+'"></p></div><div class="col-md-4"><p id="p1_price_infant'+i+cnt+'">$0</p></div></div></div><div class="row"><div class="col-md-12"><div class="Settings-title"><h5> Revenue Breakdown </h5></div></div><div class="col-md-10"><p id="trems_payment_infant'+i+cnt+'">Terms: 0 Monthly Payments</p></div><div class="col-md-8"><p>First Payment:</p></div><div class="col-md-4"><p id="p_first_pmt_infant'+i+cnt+'">$0</p></div><input type="hidden" name="first_pmt_infant_'+i+cnt+'" id="first_pmt_infant'+i+cnt+'" value=""><input type="hidden" name="recurring_pmt_infant_'+i+cnt+'" id="recurring_pmt_infant'+i+cnt+'" value=""><div class="col-md-8"><p>Recurring Payment: </p></div>';   

        ages_data +='<div class="col-md-4"><p id="p_recurring_pmt_infant'+i+cnt+'">$0</p></div><input type="hidden" name="total_contract_revenue_infant_'+i+cnt+'" id="total_contract_revenue_infant'+i+cnt+'" value=""><div class="col-md-8"><label>Total Contract Revenue:  </label></div><div class="col-md-4"><p id="p_total_contract_revenue_infant'+i+cnt+'"> $0</p></div></div></div></div></div></div></div></div></div></div>'; 



        ages_data +='</div>';         

        $("#agesmaindiv"+i).append(ages_data);
    }

    function getpricetitle(i,j){

        var x = document.getElementById("price_title"+i+j).value;

        document.getElementById("ModelRecurringTitle_adult"+i+j).innerHTML = 'Editing Recurring Payments Contract Settings for ( '+x +' for "Adults"';

        document.getElementById("ModelRecurringTitle_child"+i+j).innerHTML = 'Editing Recurring Payments Contract Settings for ('+x+' for "Children"';

        document.getElementById("ModelRecurringTitle_infant"+i+j).innerHTML = 'Editing Recurring Payments Contract Settings for ('+x+' for "Infant"';

        $("#p_price_title_adult"+i+j).html(x);

        $("#p_price_title_child"+i+j).html(x);

        $("#p_price_title_infant"+i+j).html(x);

        $("#p1_price_title_adult"+i+j).html(x);

        $("#p1_price_title_child"+i+j).html(x);

        $("#p1_price_title_infant"+i+j).html(x);
    }

    function getnumberofpmt(i,j,val){
        var part  = $("#nuberofautopays_"+val+i+j).val();
        var price = $("#"+val+"_cus_weekly_price"+i+j).val();
        if(price == ''){
            price = 0;
        }
        var total = part*price;
        if(total == 0){
            $("#p_total_contract_revenue_"+val+i+j).html('$'+price);
            $("#total_contract_revenue_"+val+i+j).val(price);
            $("#total_duration_"+val+i+j).html(0);
            $("#trems_payment_"+val+i+j).html('Terms: 0 Monthly Payments');
        }else{
            $("#p_total_contract_revenue_"+val+i+j).html('$'+total);
            $("#total_contract_revenue_"+val+i+j).val(total);
            $("#total_duration_"+val+i+j).html(part);
            $("#trems_payment_"+val+i+j).html('Terms: '+part+' Monthly Payments');
        }
    }
</script>

<script type="text/javascript">
  $(document).ready(function(){ 
    $("input[name=service_type]").on( "change", function() {
      var btn = $(this).val();
      if(btn == 'experience'){
        $('#hidd_service_type').val('experience');
        $('.itenerary_div').show();
      }else if(btn == 'classes'){
        $('#hidd_service_type').val('classes');
        $('.itenerary_div').hide();
      }else{
        $('#hidd_service_type').val('individual');
        $('.itenerary_div').hide();
      }
    });

    $("body").on("click", "#back4", function(){
      /*$('#divstep3').show();*/
      $('#divstep2').show();
      $('#radiodetails').hide();
      $('#divstep4').hide();
    });

    $("body").on("click", "#back3", function(){
      var service_type =  $('#hidd_service_type').val();
      $('#divstep2').show();
      $('#radiodetails').hide();
      $('#divstep3').hide();
      if(service_type == 'experience'){ 
        ('.location_div_experience').show();
      }
    });

    $("body").on("click", "#back2", function(){
      $('#divstep1').show();
      $('#radiodetails').show();
      $('#divstep2').hide();
    });

    $("body").on("click", ".remove-activity", function(){
        $(this).parent('div').parent('div').parent('div').remove();
    });

    $("body").on("click", ".add-another-time", function(){ 
      var cnt=$('#duration_cnt').val();
      cnt++;
      $('#duration_cnt').val(cnt);
      var add_time = "";
      add_time += '<div id="dayduration'+cnt+'"><div class="daycircle" >';
      add_time += $(".daycircle").html();
      add_time += '</div></div>';
      $("#activity_scheduler_body").append(add_time);
      parent = document.querySelector("#dayduration"+cnt);
      shift_start = parent.querySelector('#shift_start').value='';
      shift_end = parent.querySelector('#shift_end').value='';
      set_duration = parent.querySelector('#set_duration').value='';
      $("#dayduration"+cnt).parent().find('div.timezone-round').removeClass("day_circle_fill");
    });

    $('#frm_programdesc_left').text(150-parseInt($("#frm_programdesc").val().length));
    $("#frm_programdesc").on('input', function() {
      $('#frm_programdesc_left').text(150-parseInt(this.value.length));
    });

    $('#frm_what_you_doing').text(150-parseInt($("#frm_programdesc").val().length));
    $("#what_you_doing").on('input', function() {
      $('#frm_what_you_doing').text(150-parseInt(this.value.length));
    });

    $('#next1').on('click',function(e){
      e.preventDefault();
      var err = 0;
      var sport_activity = $("#frm_servicesport").val();
      var service_type =  $('#hidd_service_type').val();
      var program_name = $("#frm_programname").val();
      var program_desc = $("#frm_programdesc").val();
      var what_you_doing = $("#what_you_doing").val();
      var included_things = $("#frm_included_things").val();
      $('#err_what_included').html('');

      var notincluded_things = $("#frm_notincluded_things").val();

      $('#err_what_not_included').html('');

      var wear = $("#frm_wear").val();

      $('#err_what_guest_bring').html('');

      $('#err_what_you_doing').html('');

      if(sport_activity == ''){

        $('#err_frm_servicesportS2').html('Please select any sport activity.');

        $('#frm_servicesport').focus();

        return false;

      }else if(program_name == ''){

          $('#err_frm_programname').html('Please enter program name');

          $('#frm_programname').focus();

          return false;

      }else if(program_desc == ''){ 

          $('#err_frm_programdesc').html('Please enter program description.');

          $('#frm_programdesc').focus();

          return false;

      }else if(service_type == 'experience'){

        if(what_you_doing == '' || what_you_doing == null){ 

          $('#err_what_you_doing').html('Please enter what will you be doing.');

          $('#what_you_doing').focus();

          return false;

        }else if(included_things == '' || included_things == null){ 

          $('#err_what_included').html('Please Select.');

          $('#included_things').focus();

          return false;

        }else if(notincluded_things == '' || notincluded_things == null){ 

          $('#err_what_not_included').html('Please Select.');

          $('#notincluded_things').focus();

          return false;

        }else if(wear == ''  || wear == null){ 

          $('#err_what_guest_bring').html('Please Select.');

          $('#wear').focus();

          return false;

        }else{

          $('.location_div_experience').show();

          $('#divstep2').show();

          $('#radiodetails').hide();

          $('#divstep1').hide();

        }

      }else{

        $('#divstep2').show();

         $('#radiodetails').hide();

        $('#divstep1').hide();

      }
    });

    $('#next2').on('click',function(e){
      /*$('#divstep3').show();*/
      $('#divstep4').show();
      $('#radiodetails').hide();
      $('#divstep2').hide();
      $('#divstep1').hide(); 
    }); 

    $('#next3').on('click',function(e){
      $('#divstep4').show();
      $('#radiodetails').hide();
      $('#divstep3').hide();
      $('#divstep2').hide();
      $('#divstep1').hide();  
    });

    $("body").on("click", ".pay_session_type", function(){
      var pid = $(this).parent().parent().parent().attr('id');
      var com= "'#"+pid+" .pay_session'";
      var com1= "'#"+pid+"'";
      if($(this).val()=='Single') { 
        $('#'+pid).find('.pay_session:first').val('1');
        $('#'+pid).find('.pay_session:first').attr('readonly', true);
      }
      if($(this).val()=='Multiple') {
        $('#'+pid).find('.pay_session:first').val('0');
        $('#'+pid).find('.pay_session:first').attr('readonly', false);
      }

      if($(this).val()=='Unlimited') {
        $('#'+pid).find('.pay_session:first').val('10000');
        $('#'+pid).find('.pay_session:first').attr('readonly', true);
      }
    });

    $("body").on("blur", ".pay_price", function(){
      var pay_disc = 0;
      var pid = $(this).parent().parent().parent().attr('id');
      var pay_disc = $('#'+pid).find('#pay_discount:first').val();
      var fitnessity_fee = '{{$fitnessity_fee}}';
      $('#'+pid).find('.pay_estearn:first').val($(this).val() - ($(this).val()* fitnessity_fee)/100 - ($(this).val()*pay_disc)/100);
    });

    $("body").on("blur", "#pay_discount", function(){
      var p_dis_id = $(this).parent().parent().parent().attr('id');
      var pay_price = $('#'+p_dis_id).find('.pay_price:first').val();
      var fitnessity_fee = '{{$fitnessity_fee}}';
      $('#'+p_dis_id).find('.pay_estearn:first').val( pay_price - ((pay_price * $(this).val())/100 + (pay_price*fitnessity_fee)/100));
    });


    $("body").on("click", ".remove-service-price", function(){
      $(this).parent().parent().parent().remove();
    });


    $("body").on("click", ".add-another-session", function(){
      var cnt=$('#recurring_count').val();
      cnt++;
      $('#recurring_count').val(cnt);
      var service_price = "";
      service_price += '<div class="col-md-12 service_price serpridiv'+cnt+'" id="serpridiv'+cnt+'" style="margin-top:20px; padding-top:10px; float:left; border-top:1px dotted #000;">';
      service_price += '<div class="row"><div class="col-md-11"></div><div class="col-md-1"><i class="remove-service-price fa fa-trash-o" style="color:red; font-weight:bold; cursor:pointer; float:right" title="Remove price option"></i></div></div>';
      service_price += $(".service_price").html();
      service_price += '</div>';
      $(".service_price_block").append(service_price);
      parent = document.querySelector(".serpridiv"+cnt);
      pay_session_type = parent.querySelector('#pay_session_type').value='';
      pay_session = parent.querySelector('.pay_session').value='';
      membership_type = parent.querySelector('.membership_type').value='';
      pay_price = parent.querySelector('.pay_price').value='';
      pay_estearn = parent.querySelector('.pay_estearn').value='';
      pay_discount = parent.querySelector('#pay_discount').value='';
      pay_setnum = parent.querySelector('#pay_setnum').value='';
      pay_setduration = parent.querySelector('#pay_setduration').value='';
      pay_after = parent.querySelector('#pay_after').value='';
      var inps = document.getElementsByName('is_recurring[]');
      var cnt_chk=0;
      $('.is_recurring_cls').each(function(){
        var iid=$(this).attr('id');
        if(iid=='is_recurring0' && cnt_chk>0)
        { 
          $(this).attr('id', 'is_recurring'+cnt);
          $('#is_recurring'+cnt).attr("data-count",cnt);
        }
        cnt_chk++;
      });
      var cnt_chk=0;
      $('.recurrint_id').each(function(){ 
        var iid=$(this).attr('id'); 
        if(iid=='btn_recurring0' && cnt_chk>0)
        {
          $(this).attr('id', 'btn_recurring'+cnt);
          $('#btn_recurring'+cnt).attr("data-target","#ModelRecurring"+cnt);
          $('#btn_recurring'+cnt).attr("data-count",cnt);
        }
        cnt_chk++;
      });
      var cnt_chk=0;
      $('.model_cls').each(function(){
        var iid=$(this).attr('id');
        if(iid=='ModelRecurring0' && cnt_chk>0)
        {
          $(this).attr('id', 'ModelRecurring'+cnt);
        }
        cnt_chk++;
      });
      var cnt_chk=0;
      $('.rcprice').each(function(){
        var iid=$(this).attr('id');
        if(iid=='recurring_price0' && cnt_chk>0)
        {
          $(this).attr('id', 'recurring_price'+cnt);
        }
        cnt_chk++;
      });
      var cnt_chk=0;
      $('.rcevery').each(function(){
        var iid=$(this).attr('id');
        if(iid=='recurring_every0' && cnt_chk>0)
        {
          $(this).attr('id', 'recurring_every'+cnt);
        }
        cnt_chk++;
      });

      var cnt_chk=0;
      $('.rcduration').each(function(){
        var iid=$(this).attr('id');
        if(iid=='recurring_duration0' && cnt_chk>0)
        {
          $(this).attr('id', 'recurring_duration'+cnt);  
        }
        cnt_chk++;
      });
    });

    $("body").on("click", ".add-another-category-price", function(){

    var fitnessity_fee = '{{$fitnessity_fee}}';

    var cnt=$('#recurring_count').val();

    cnt++;

    $('#recurring_count').val(cnt);

    var service_price = "";

    service_price += '';

    service_price +='<div id="pricediv'+cnt+'"><div class="row"><hr style="border: 1px solid #d4cfcf;width: 100%;"><div class="col-md-11"></div><div class="col-md-1"><i class="remove-category-price fa fa-trash-o" style="color:red; font-weight:bold; cursor:pointer; float:right" title="Remove emp option"></i></div></div><input type="hidden" name="ages_count'+cnt+'" id="ages_count'+cnt+'" value="0"><div id="agesmaindiv'+cnt+'"><div id="agesdiv'+cnt+'0"><div class="row"><div class="col-md-3"><div class="priceselect sp-select"><label>Category Title (Give a name for this category)</label><input type="text" name="category_title[]" id="category_title"  class="inputs"></div></div><div class="col-md-6"><div class="sp-select-sche"></div></div></div><div class="row mt-30"><div class="col-md-3 col-sm-6"><div class="priceselect sp-select"><label>Price Title</label><input type="text" name="price_title_'+cnt+'0" id="price_title'+cnt+'0"  class="inputs" placeholder="ex. 30 Minute Section" oninput="getpricetitle('+cnt+',0)"></div></div><div class="col-md-3 col-sm-6"><div class="priceselect sp-select"><label>Session Type</label><select name="pay_session_type_'+cnt+'0" id="pay_session_type'+cnt+'0" class="bd-right bd-bottom pay_session_type" onchange="pay_session_select('+cnt+',0,this.value);"><option value="">Select Value</option><option value="Single">Single</option><option value="Multiple">Multiple</option><option value="Unlimited">Unlimited</option></select></div></div><div class="col-md-3 col-sm-6"><div class="priceselect sp-select"><label>Number of Sessions</label><input type="text" name="pay_session_'+cnt+'0" id="pay_session'+cnt+'0"  class="inputs pay_session" placeholder="1" value=""></div></div><div class="col-md-3 col-sm-6"><div class="priceselect sp-select"><label>Membership Type</label><select name="membership_type_'+cnt+'0" id="membership_type'+cnt+'0" class="bd-right bd-bottom membership_type"><option value="Drop In">Drop In</option><option value="Semester">Semester (Long Term)</option></select></div></div></div><div class="row"><div class="col-md-12"><div class="setprice sp-select"><h3>You can set your prices to be the same or different based on age, the weekday or the weekend.To add prices for children or infants, click on the box.</h3></div></div></div><div class="row"><div class="age-cat"><div class="cat-age sp-select"><label>Adults</label><p>Ages 12 & Older</p></div></div><div class="weekly-customer"><div class="cus-week-price sp-select"><label>Weekday Price</label><p> (Monday - Friday)</p><input type="text" name="adult_cus_weekly_price_'+cnt+'0" id="adult_cus_weekly_price'+cnt+'0" placeholder="$"  onkeyup="adultchangeestprice('+cnt+',0);"></div></div><div class="weekend-price"><div class="cus-week-price sp-select"><label>Weekend Price </label><p> ( Saturday & Sunday)</p><input type="text" name="adult_weekend_price_diff_'+cnt+'0" id="adult_weekend_price_diff'+cnt+'0" placeholder="$" onkeyup="weekendadultchangeestprice('+cnt+',0);"></div></div><div class="re-discount"><div class="discount sp-select"><label>Any Discount? </label><p> (Recommended 10% to 15%)</p><input type="text" name="adult_discount_'+cnt+'0" id="adult_discount'+cnt+'0" onkeyup="adultdischangeestprice('+cnt+',0);"></div></div><div class="single-dash"><div class="desh sp-select"><label>-</label></div></div><div class="fit-fees"><div class="fees sp-select"><label>Fitnessity Fee </label><p> {{$fitnessity_fee}}%</p></div></div><div class="single-equal"><div class="equal sp-select"><label>=</label></div></div><div class="estimated-earn"><div class="cus-week-price sp-select"><label>Weekday Estimated Earnings </label><input type="text" name="adult_estearn_'+cnt+'0" id="adult_estearn'+cnt+'0" placeholder="$"></div></div><div class="estimated-earn"><div class="cus-week-price sp-select"><label>Weekend Estimated Earnings</label><input type="text" name="weekend_adult_estearn_'+cnt+'0" id="weekend_adult_estearn'+cnt+'0" placeholder="$" ></div></div><div class="col-md-12"><div class="priceselect sp-select modelmargin">';



    var onclickadult ="'adult'";

        service_price +='<input class="modelcheckbox"  data-count="0"  type="checkbox" id="is_recurring_adult'+cnt+'0" name="is_recurring_adult_'+cnt+'0" value="0" onclick="openmodelbox('+cnt+',0,'+onclickadult+');" ><label>Is This A Recurring Payment? Set the monthly payment terms for Adults</label><button style="display:none" id="btn_recurring_adult'+cnt+'0" name="btn_recurring_adult_'+cnt+'0[]" type="button" data-count="0" class="btn btn-primary recurrint_id" data-toggle="modal" data-target="#ModelRecurring_adult'+cnt+'0" onclick="recurrint_id('+cnt+',0,'+onclickadult+');">Launch demo modal</button></div></div></div><div class="row"><div class="age-cat"><div class="cat-age sp-select"><label>Children</label><p>Ages 2 to 12</p></div></div><div class="weekly-customer"><div class="cus-week-price sp-select"><label>Weekday Price</label><p> (Monday - Friday)</p><input type="text" name="child_cus_weekly_price_'+cnt+'0" id="child_cus_weekly_price'+cnt+'0" placeholder="$" onkeyup="childchangeestprice('+cnt+',0);"></div></div><div class="weekend-price"><div class="cus-week-price sp-select"><label>Weekend Price</label><p> ( Saturday & Sunday)</p><input type="text" name="child_weekend_price_diff_'+cnt+'0" id="child_weekend_price_diff'+cnt+'0" placeholder="$" onkeyup="weekendchildchangeestprice('+cnt+',0);"></div></div><div class="re-discount"><div class="discount sp-select"><label>Any Discount?</label><p> (Recommended 10% to 15%)</p><input type="text" name="child_discount_'+cnt+'0" id="child_discount'+cnt+'0"  onkeyup="childdischangeestprice('+cnt+',0);"></div></div><div class="single-dash"><div class="desh sp-select"><label>-</label></div></div><div class="fit-fees"><div class="fees sp-select"><label>Fitnessity Fee</label><p> {{$fitnessity_fee}}%</p></div></div><div class="single-equal"><div class="equal sp-select"><label>=</label></div></div><div class="estimated-earn"><div class="cus-week-price sp-select"><label>Weekday Estimated Earnings</label><input type="text" name="child_estearn_'+cnt+'0" id="child_estearn'+cnt+'0" placeholder="$" ></div></div><div class="estimated-earn"><div class="cus-week-price sp-select"><label>Weekend Estimated Earnings</label><input type="text" name="weekend_child_estearn_'+cnt+'0" id="weekend_child_estearn'+cnt+'0" placeholder="$" ></div></div><div class="col-md-12"><div class="priceselect sp-select modelmargin">';



    var onclickchild ="'child'";



       service_price +='<input class="modelcheckbox"  data-count="0"  type="checkbox" id="is_recurring_child'+cnt+'0" name="is_recurring_child_'+cnt+'0" value="0"  onclick="openmodelbox('+cnt+',0,'+onclickchild+');" ><label>Is This A Recurring Payment? Set the monthly payment terms for Children</label><button style="display:none" id="btn_recurring_child'+cnt+'0" name="btn_recurring_child_'+cnt+'0[]" type="button" data-count="0" class="btn btn-primary recurrint_id" data-toggle="modal" data-target="#ModelRecurring_child'+cnt+'0" onclick="recurrint_id('+cnt+',0,'+onclickchild+');">Launch demo modal</button></div></div></div><div class="row"><div class="age-cat"><div class="cat-age sp-select"><label>Infants</label><p>Ages 2 & Under</p></div></div><div class="weekly-customer"><div class="cus-week-price sp-select"><label>Weekday Price</label><p> (Monday - Friday)</p><input type="text" name="infant_cus_weekly_price_'+cnt+'0" id="infant_cus_weekly_price'+cnt+'0" placeholder="$" onkeyup="infantchangeestprice('+cnt+',0);"></div></div><div class="weekend-price"><div class="cus-week-price sp-select"><label>Weekend Price</label><p> ( Saturday & Sunday)</p><input type="text" name="infant_weekend_price_diff_'+cnt+'0" id="infant_weekend_price_diff'+cnt+'0" placeholder="$" onkeyup="weekendinfantchangeestprice('+cnt+',0);"></div></div><div class="re-discount"><div class="discount sp-select"><label>Any Discount?</label><p> (Recommended 10% to 15%)</p><input type="text" name="infant_discount_'+cnt+'0" id="infant_discount'+cnt+'0" onkeyup="infantdischangeestprice('+cnt+',0);"></div></div><div class="single-dash"><div class="desh sp-select"><label>-</label></div></div><div class="fit-fees"><div class="fees sp-select"><label>Fitnessity Fee</label><p> {{$fitnessity_fee}}%</p></div></div><div class="single-equal"><div class="equal sp-select"><label>=</label></div></div><div class="estimated-earn"><div class="cus-week-price sp-select"><label>Weekday Estimated Earnings</label><input type="text" name="infant_estearn_'+cnt+'0" id="infant_estearn'+cnt+'0" placeholder="$"></div></div><div class="estimated-earn"><div class="cus-week-price sp-select"><label>Weekend Estimated Earnings</label><input type="text" name="weekend_infant_estearn_'+cnt+'0" id="weekend_infant_estearn'+cnt+'0" placeholder="$"></div></div><div class="col-md-12"><div class="priceselect sp-select modelmargin">';

    var onclickinfant ="'infant'";

        service_price +='<input class="modelcheckbox"  data-count="0"  type="checkbox" id="is_recurring_infant'+cnt+'0"     name="is_recurring_infant_'+cnt+'0" value="0"  onclick="openmodelbox('+cnt+',0,'+onclickinfant+');" ><label>Is This A Recurring Payment? Set the monthly payment terms for Infants</label><button style="display:none" id="btn_recurring_infant'+cnt+'0" name="btn_recurring_infant_'+cnt+'0[]" type="button" data-count="0" class="btn btn-primary recurrint_id" data-toggle="modal" data-target="#ModelRecurring_infant'+cnt+'0" onclick="recurrint_id('+cnt+',0,'+onclickinfant+');">Launch demo modal</button></div></div></div><div class="row"><div class="col-md-12 col-sm-12"><div class="serviceprice sp-select"><h3>When Does This Price Setting Expire</h3></div></div><div class="col-md-3 col-sm-6 col-xs-12"><div class="set-num"><label>Set The Number</label><input type="text" name="pay_setnum_'+cnt+'0" id="pay_setnum'+cnt+'0" class="form-control valid" placeholder="(ex,1,2,3,etc.)" value="1" onkeypress="return IsNumeric(event);" ondrop="return false;" onpaste="return false;"></div></div><div class="col-md-3 col-sm-6 col-xs-12"><div class="set-num"><label>The Duration</label><select name="pay_setduration_'+cnt+'0" id="pay_setduration'+cnt+'0" class="form-control valid"><option value="">Select Value</option><option selected="">Days</option><option>Months</option><option>Year</option></select></div></div><div class="col-md-1 col-xs-12"><div class="set-num after"><label>After</label></div></div><div class="col-md-5 col-xs-12"><div class="after-select"><select name="pay_after_'+cnt+'0" id="pay_after'+cnt+'0" class="pay_after form-control valid"><option value="">Select Value</option><option value="1" selected="">Starts to expire the day of purchase</option><option value="2">Starts to expire when the customer first participates in the activity</option></select></div></div></div><div class="modal fade ModelRecurring_adult'+cnt+'0" id="ModelRecurring_adult'+cnt+'0" tabindex="-1" role="dialog" aria-labelledby="ModelRecurringTitle" aria-hidden="true"><div class="modal-dialog editingautopay" role="document"><div class="modal-content"><div class="modal-header"><button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button></div><div class="modal-body"><div class="row"><div class="col-md-12"><div class="editingautopay"><h5 class="modal-title" id="ModelRecurringTitle_adult'+cnt+'0">Editing Recurring Payments Contract Settings for ("Adults") </h5></div></div></div><div class="row"><div class="col-md-8"><div class="Settings-title"><h5> Settings </h5></div><div class="setting-box"><div class="row set-78"><div class="col-md-4"><label class="contractsettings">How often will customers be charged?</label></div><div class="col-md-8"><p>Customers will be charged every month for the duration of the contract</p></div></div><div class="row set-78"><div class="col-md-4"><label class="contractsettings">Number of autopays  </label></div><div class="col-md-8"><div class="nuberofautopays"><input type="text" class="form-control valid" name="nuberofautopays_adult_'+cnt+'0" id="nuberofautopays_adult'+cnt+'0" placeholder="12" value="" oninput="getnumberofpmt('+cnt+',0,'+onclickadult+');"></div><div class="contract"><label>  Total duration of contract: </label><p id="total_duration_adult'+cnt+'0">0 months</p></div></div></div><div class="row set-78"><div class="col-md-4"><label class="contractsettings">What happens after 12 payments?</label></div><div class="col-md-8"><div class="autopay"><input type="radio" id="happens_aftr_12_pmt_adult'+cnt+'0" name="happens_aftr_12_pmt_adult_'+cnt+'0" value="contract_expire"><label for="contract">Contract Expires</label><br><input type="radio" id="happens_aftr_12_pmt_adult'+cnt+'0" name="happens_aftr_12_pmt_adult_'+cnt+'0" value="contract_renew" ><label for="renews">Contract Automaitcally Renews Every 12 payments</label><br> </div></div></div><div class="row set-78"><div class="col-md-4"><label class="contractsettings">When will clients be charged?</label></div><div class="col-md-8"><div class="saledate"><input type="hidden" name="client_be_charge_on_adult_'+cnt+'0" id="client_be_charge_on_adult_'+cnt+'0" value="On the sale date"><p>On the sale date </p></div></div></div></div></div><div class="col-md-4"><div class="Settings-title"><h5> Contract Review </h5></div><div class="setting-box"><div class="set-border"><div class="row"><div class="col-md-8"><p id="p_price_title_adult'+cnt+'0"></p></div><div class="col-md-4"><p id="p1_price_adult'+cnt+'0">$0</p></div></div></div><div class="row"><div class="col-md-12"><div class="Settings-title"><h5> Revenue Breakdown </h5></div></div><div class="col-md-10"><p id="trems_payment_adult'+cnt+'0">Terms: 0 Monthly Payments</p></div><div class="col-md-8"><p>First Payment:</p></div><div class="col-md-4"><p id="p_first_pmt_adult'+cnt+'0">$0</p></div><input type="hidden" name="first_pmt_adult_'+cnt+'0" id="first_pmt_adult'+cnt+'0" value=""><input type="hidden" name="recurring_pmt_adult_'+cnt+'0" id="recurring_pmt_adult'+cnt+'0" value=""><div class="col-md-8"><p>Recurring Payment: </p></div><div class="col-md-4"><p id="p_recurring_pmt_adult'+cnt+'0">$0</p></div><input type="hidden" name="total_contract_revenue_adult_'+cnt+'0" id="total_contract_revenue_adult'+cnt+'0" value=""><div class="col-md-8"><label>Total Contract Revenue:  </label></div><div class="col-md-4"><p id="p_total_contract_revenue_adult'+cnt+'0"> $0</p></div></div></div></div></div></div></div></div></div> <div class="modal fade ModelRecurring_child'+cnt+'0" id="ModelRecurring_child'+cnt+'0" tabindex="-1" role="dialog" aria-labelledby="ModelRecurringTitle" aria-hidden="true"><div class="modal-dialog editingautopay" role="document"><div class="modal-content"><div class="modal-header"><button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button></div><div class="modal-body"><div class="row"><div class="col-md-12"><div class="editingautopay"><h5 class="modal-title" id="ModelRecurringTitle_child'+cnt+'0">Editing Recurring Payments Contract Settings for ("Children")  </h5></div></div></div><div class="row"><div class="col-md-8"><div class="Settings-title"><h5> Settings </h5></div><div class="setting-box"><div class="row set-78"><div class="col-md-4"><label class="contractsettings">How often will customers be charged?</label></div><div class="col-md-8"><p>Customers will be charged every month for the duration of the contract</p></div></div><div class="row set-78"><div class="col-md-4"><label class="contractsettings">Number of autopays  </label></div><div class="col-md-8"><div class="nuberofautopays"><input type="text" class="form-control valid" name="nuberofautopays_child_'+cnt+'0" id="nuberofautopays_child'+cnt+'0" placeholder="12" value="" oninput="getnumberofpmt('+cnt+',0,'+onclickchild+');"></div><div class="contract"><label>  Total duration of contract: </label><p id="total_duration_child'+cnt+'0">0 months</p></div></div></div><div class="row set-78"><div class="col-md-4"><label class="contractsettings">What happens after 12 payments?</label></div><div class="col-md-8"><div class="autopay"><input type="radio" id="happens_aftr_12_pmt_child'+cnt+'0" name="happens_aftr_12_pmt_child_'+cnt+'0" value="contract_expire"><label for="contract">Contract Expires</label><br><input type="radio" id="happens_aftr_12_pmt_child'+cnt+'0" name="happens_aftr_12_pmt_child_'+cnt+'0" value="contract_renew"><label for="renews">Contract Automaitcally Renews Every 12 payments</label><br> </div></div></div><div class="row set-78"><div class="col-md-4"><label class="contractsettings">When will clients be charged?</label></div><div class="col-md-8"><div class="saledate"><input type="hidden" name="client_be_charge_on_child_'+cnt+'0" id="client_be_charge_on_child_'+cnt+'0" value="On the sale date"><p>On the sale date </p></div></div></div></div></div><div class="col-md-4"><div class="Settings-title"><h5> Contract Review </h5></div><div class="setting-box"><div class="set-border"><div class="row"><div class="col-md-8"><p id="p_price_title_child'+cnt+'0"></p></div><div class="col-md-4"><p id="p1_price_child'+cnt+'0">$0</p></div></div></div><div class="row"><div class="col-md-12"><div class="Settings-title"><h5> Revenue Breakdown </h5></div></div><div class="col-md-10"><p id="trems_payment_child'+cnt+'0">Terms: 0 Monthly Payments</p></div><div class="col-md-8"><p>First Payment:</p></div><div class="col-md-4"><p id="p_first_pmt_child'+cnt+'0">$0</p></div><input type="hidden" name="first_pmt_child_'+cnt+'0" id="first_pmt_child'+cnt+'0" value=""><input type="hidden" name="recurring_pmt_child_'+cnt+'0" id="recurring_pmt_child'+cnt+'0" value=""><div class="col-md-8"><p>Recurring Payment: </p></div><div class="col-md-4"><p id="p_recurring_pmt_child'+cnt+'0">$0</p></div><input type="hidden" name="total_contract_revenue_child_'+cnt+'0" id="total_contract_revenue_child'+cnt+'0" value=""><div class="col-md-8"><label>Total Contract Revenue:  </label></div><div class="col-md-4"><p id="p_total_contract_revenue_child'+cnt+'0"> $0</p></div></div></div></div></div></div></div></div></div><div class="modal fade ModelRecurring_infant'+cnt+'0" id="ModelRecurring_infant'+cnt+'0" tabindex="-1" role="dialog" aria-labelledby="ModelRecurringTitle" aria-hidden="true"><div class="modal-dialog editingautopay" role="document"><div class="modal-content"><div class="modal-header"><button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button></div><div class="modal-body"><div class="row"><div class="col-md-12"><div class="editingautopay"><h5 class="modal-title" id="ModelRecurringTitle_infant'+cnt+'0">Editing Recurring Payments Contract Settings for ("Infant") </h5></div></div></div><div class="row"><div class="col-md-8"><div class="Settings-title"><h5> Settings </h5></div><div class="setting-box"><div class="row set-78"><div class="col-md-4"><label class="contractsettings">How often will customers be charged?</label></div><div class="col-md-8"><p>Customers will be charged every month for the duration of the contract</p></div></div><div class="row set-78"><div class="col-md-4"><label class="contractsettings">Number of autopays  </label></div><div class="col-md-8"><div class="nuberofautopays"><input type="text" class="form-control valid" name="nuberofautopays_infant_'+cnt+'0" id="nuberofautopays_infant'+cnt+'0" placeholder="12" value="" oninput="getnumberofpmt('+cnt+',0,'+onclickinfant+');"></div><div class="contract"><label>  Total duration of contract: </label><p id="total_duration_infant'+cnt+'0">0 months</p></div></div></div><div class="row set-78"><div class="col-md-4"><label class="contractsettings">What happens after 12 payments?</label></div><div class="col-md-8"><div class="autopay"><input type="radio" id="happens_aftr_12_pmt_infant'+cnt+'0" name="happens_aftr_12_pmt_infant_'+cnt+'0" value="contract_expire"><label for="contract">Contract Expires</label><br><input type="radio" id="happens_aftr_12_pmt_infant'+cnt+'0" name="happens_aftr_12_pmt_infant_'+cnt+'0" value="contract_renew" ><label for="renews">Contract Automaitcally Renews Every 12 payments</label><br> </div></div></div><div class="row set-78"><div class="col-md-4"><label class="contractsettings">When will clients be charged?</label></div><div class="col-md-8"><div class="saledate"><input type="hidden" name="client_be_charge_on_infant_'+cnt+'0" id="client_be_charge_on_infant_'+cnt+'0" value="On the sale date"><p>On the sale date </p></div></div></div></div></div><div class="col-md-4"><div class="Settings-title"><h5> Contract Review </h5></div><div class="setting-box"><div class="set-border"><div class="row"><div class="col-md-8"><p id="p_price_title_infant'+cnt+'0"></p></div><div class="col-md-4"><p id="p1_price_infant'+cnt+'0">$0</p></div></div></div><div class="row"><div class="col-md-12"><div class="Settings-title"><h5> Revenue Breakdown </h5></div></div><div class="col-md-10"><p id="trems_payment_infant'+cnt+'0">Terms: 0 Monthly Payments</p></div><div class="col-md-8"><p>First Payment:</p></div><div class="col-md-4"><p id="p_first_pmt_infant'+cnt+'0">$0</p></div><input type="hidden" name="first_pmt_infant_'+cnt+'0" id="first_pmt_infant'+cnt+'0" value=""><input type="hidden" name="recurring_pmt_infant_'+cnt+'0" id="recurring_pmt_infant'+cnt+'0" value=""><div class="col-md-8"><p>Recurring Payment: </p></div><div class="col-md-4"><p id="p_recurring_pmt_infant'+cnt+'0">$0</p></div>';



                   

    service_price +='<input type="hidden" name="total_contract_revenue_infant_'+cnt+'0" id="total_contract_revenue_infant'+cnt+'0" value=""><div class="col-md-8"><label>Total Contract Revenue:  </label></div><div class="col-md-4"><p id="p_total_contract_revenue_infant'+cnt+'0"> $0</p></div></div></div></div></div></div></div></div></div></div>';

     service_price +='<div  class=""><div class="col-md-12"><div class="addanother"><a class="" onclick=" return add_another_price_ages('+cnt+');"> +Add Another Session </a></div> </div></div></div>';

    $(".service_price_block").append(service_price);

});

    $("body").on("click", ".remove-category-price ", function(){
        var cnt=$('#recurring_count').val();
        cnt--;
        $('#recurring_count').val(cnt);
        $(this).parent('div').parent('div').parent('div').remove();
    });


    $("body").on("click", ".add-another-day-schedule", function(){
      var cnt=$('#planday_count').val();
      cnt++;
      $('#planday_count').val(cnt);
      var service_price = ""; var daycnt='';
      daycnt = cnt+1;
      service_price += '<div class="row add_another_day planday'+cnt+'" style="margin-top:20px; padding-top:10px;border-top:1px dotted #000;">';
      service_price += '<div class="col-md-11"></div><div class="col-md-1"><i class="remove-day-schedule fa fa-trash-o" style="color:red; font-weight:bold; cursor:pointer; float:right" title="Remove Day"></i></div>';
      service_price += '<div class="col-md-12"> <label class="mb-10"> Day '+daycnt+' </label></div><div class="col-md-3 text-center"><div class="imagePreview divImgPreview"><img src="" class="imagePreview planblah'+cnt+'" id="showimgDayPlan"></div><label class="img-tab-btn">Upload Image<input type="file" name="dayplanpic[]" class="uploadFile img" value="Upload Photo" onchange="planImg(this,'+cnt+');" style="width: 0px;height: 0px;overflow: hidden;"></label><span class="error" id="err_oldservicepic2'+cnt+'"></span><input type="hidden" id="olddayplanpic2'+cnt+'" name="olddayplanpic" value=""></div>';

      service_price +='<div class="col-md-9"><input type="text" class="form-control" name="days_title[]" id="days_title0" placeholder="Give Heading for This Day"/><br /><textarea class="form-control" rows="6" name="days_description[]" id="days_description" placeholder="Give Description For This Day" maxlength="500"></textarea>';

      service_price += '</div>';
      $(".add-another-day-schedule-block").append(service_price);
    });

    $("body").on("click", ".remove-day-schedule", function(){
      $(this).parent().parent().remove();
    });

    $("body").on("change",".shift_start, .shift_end", function(){
      var timeStart = new Date("01/01/2007 " + $(this).parent().parent().find('.shift_start').val());
      var timeEnd = new Date("01/01/2007 " + $(this).parent().parent().find('.shift_end').val());
      var seconds = Math.floor((timeEnd - (timeStart))/1000);
      var minutes = Math.floor(seconds/60);
      var hours = Math.floor(minutes/60);
      var days = Math.floor(hours/24);
      hours = hours-(days*24);
      minutes = minutes-(days*24*60)-(hours*60);
      seconds = seconds-(days*24*60*60)-(hours*60*60)-(minutes*60);
      if(hours > 1 || hours < -1) {
        var duration = hours + ' hours ' + minutes + ' minutes ' + seconds + ' second';
      } else {
        var duration = hours + ' hour ' + minutes + ' minutes ' + seconds + ' second';  
      }
      $(this).parent().parent().find('.set_duration').val(duration);
    });

    $("body").on("click", ".daycircle", function(){
     /* alert($("#frm_class_meets").val());*/
      if($("#frm_class_meets").val() == 'Weekly')
      {
        activity_days = "";     
        $(this).find(".weekdays").each( function() {
          $.each( $(this).find('.day_circle'), function( key, value ) {
            if ($(this).hasClass('day_circle_fill')) {         
              activity_days += value.classList[3] + ",";
            }  
          });
        });
        $(this).find('.activity_days').val(activity_days);
      }

      if($("#frm_class_meets").val() == 'On a specific day')
      {
        activity_days = "";
        $.each( $(this).find('.weekdays').children(".day_circle_fill"), function( key, value ) {
          activity_days += value.classList[3] + ","
        });
        $(this).find('.activity_days').val(activity_days);
      }
    });

    $("#frm_class_meets").on("change", function () {
      $('#startingpicker').val('');
      $(".daycircle").hide();
      $(".remove-week").hide();
      var day = moment($('#startingpicker').val(), 'MM-DD-YYYY').format('dddd');
      var activityMeet = $(this).val();
      $("#activity_scheduler_body").html("");
      $(".timezone-round").removeClass('day_circle_fill');
      $(".timezone-round").css('pointer-events', 'none');
      $(".Monday").css('pointer-events', '');
      $(".Tuesday").css('pointer-events', '');
      $(".Wednesday").css('pointer-events', '');
      $(".Thursday").css('pointer-events', '');
      $(".Friday").css('pointer-events', '');
      $(".Saturday").css('pointer-events', '');
      $(".Sunday").css('pointer-events', '');
      /*if(activityMeet == 'Weekly') {

        if(day=='Monday') {

            $(".Monday").css('pointer-events', '');

            $(".Tuesday").css('pointer-events', '');

            $(".Wednesday").css('pointer-events', '');

            $(".Thursday").css('pointer-events', '');

            $(".Friday").css('pointer-events', '');

            $(".Saturday").css('pointer-events', '');

        }

        if(day=='Tuesday') {

            $(".Tuesday").css('pointer-events', '');

            $(".Wednesday").css('pointer-events', '');

            $(".Thursday").css('pointer-events', '');

            $(".Friday").css('pointer-events', '');

            $(".Saturday").css('pointer-events', '');

        }

        if(day=='Wednesday') {

            $(".Wednesday").css('pointer-events', '');

            $(".Thursday").css('pointer-events', '');

            $(".Friday").css('pointer-events', '');

            $(".Saturday").css('pointer-events', '');

        }

        if(day=='Thursday') {

            $(".Thursday").css('pointer-events', '');

            $(".Friday").css('pointer-events', '');

            $(".Saturday").css('pointer-events', '');

        }

        if(day=='Friday') {

            $(".Friday").css('pointer-events', '');

            $(".Saturday").css('pointer-events', '');

        }

        if(day=='Saturday') {

            $(".Saturday").css('pointer-events', '');

        }

        if(day=='Sunday') {

            $(".Monday").css('pointer-events', '');

            $(".Tuesday").css('pointer-events', '');

            $(".Wednesday").css('pointer-events', '');

            $(".Thursday").css('pointer-events', '');

            $(".Friday").css('pointer-events', '');

            $(".Saturday").css('pointer-events', '');

            $(".Sunday").css('pointer-events', '');

        }

            //$(".remove-week").show();
      }*/

      $(".timezone-round").removeClass('day_circle_fill');
      $(".daycircle ."+day).addClass('day_circle_fill');
      $("#activity_scheduler_body").append($("#day-circle").html());
      $("#activity_scheduler_body .daycircle").show();
      $('#startingpicker').datepicker('hide');
    });

    $('#startingpicker').datepicker({
       minDate: 0   
    }).change(activitySchedule);

    function activitySchedule(event) { //alert('aaaaa'+$('#startingpicker').val());
      var d = new Date($('#startingpicker').val());
      var weekday = ["Sunday","Monday","Tuesday","Wednesday","Thursday","Friday","Saturday"];
      $(".daycircle").hide();
      $(".remove-week").hide();
      var day = weekday[d.getDay()];
      var activityMeet = $("#frm_class_meets").val();
      $("#activity_scheduler_body").html("");
      $(".timezone-round").removeClass('day_circle_fill');
      $(".Monday").css('pointer-events', '');
      $(".Tuesday").css('pointer-events', '');
      $(".Wednesday").css('pointer-events', '');
      $(".Thursday").css('pointer-events', '');
      $(".Friday").css('pointer-events', '');
      $(".Saturday").css('pointer-events', '');
      $(".Sunday").css('pointer-events', '');

      /*if(activityMeet == 'Weekly') {

        if(day=='Monday') {

          $(".Monday").css('pointer-events', '');

          $(".Tuesday").css('pointer-events', '');

          $(".Wednesday").css('pointer-events', '');

          $(".Thursday").css('pointer-events', '');

          $(".Friday").css('pointer-events', '');

          $(".Saturday").css('pointer-events', '');

        }

        if(day=='Tuesday') {

            $(".Tuesday").css('pointer-events', '');

            $(".Wednesday").css('pointer-events', '');

            $(".Thursday").css('pointer-events', '');

            $(".Friday").css('pointer-events', '');

            $(".Saturday").css('pointer-events', '');

        }

        if(day=='Wednesday') {

            $(".Wednesday").css('pointer-events', '');

            $(".Thursday").css('pointer-events', '');

            $(".Friday").css('pointer-events', '');

            $(".Saturday").css('pointer-events', '');

        }

        if(day=='Thursday') {

            $(".Thursday").css('pointer-events', '');

            $(".Friday").css('pointer-events', '');

            $(".Saturday").css('pointer-events', '');

        }

        if(day=='Friday') {

            $(".Friday").css('pointer-events', '');

            $(".Saturday").css('pointer-events', '');

        }

        if(day=='Saturday') {

            $(".Saturday").css('pointer-events', '');

        }

        if(day=='Sunday') {

            $(".Monday").css('pointer-events', '');

            $(".Tuesday").css('pointer-events', '');

            $(".Wednesday").css('pointer-events', '');

            $(".Thursday").css('pointer-events', '');

            $(".Friday").css('pointer-events', '');

            $(".Saturday").css('pointer-events', '');

            $(".Sunday").css('pointer-events', '');

        }
      }*/

      $(".timezone-round").removeClass('day_circle_fill');
      var cnt=$('#duration_cnt').val();

      if(cnt>=0){

        $("#editscheduler").hide();

        $("#dayduration0 .daycircle").show();

        $('#duration_cnt').val('0');

      }else{

        $("#activity_scheduler_body").append($("#day-circle").html());

      }

      $("#activity_scheduler_body .daycircle").show();

      $(this).datepicker('hide');

      var cnt=$('#duration_cnt').val();

      parent = document.querySelector("#dayduration"+cnt);

      shift_start = parent.querySelector('#shift_start').value='';

      shift_end = parent.querySelector('#shift_end').value='';

      set_duration = parent.querySelector('#set_duration').value='';

    }



    $('body').delegate('.timezone-round','click',function(){  

      if($('#frm_class_meets').val()=='Weekly')

      {   

        if($(this).hasClass("day_circle_fill"))

          $(this).removeClass('day_circle_fill');

        else

          $(this).addClass('day_circle_fill');

      }

    });



  }); 



  function readServicePic2(input) { //alert(input);

        if (input.files && input.files[0]) {

          var reader = new FileReader();

          reader.onload = function(e) {

            $('.blah2').attr('src', e.target.result);

            //input.closest('.divImgPreview').html('<img src="'+e.target.result+'">');

            $("#oldservicepic").val(e.target.result);

            var html = '<img src="' + e.target.result + '">';

            $('.uploadedpic2').html(html);

          };

          profile_pic_var = input.files[0];

          reader.readAsDataURL(input.files[0]);

        }

  }





  function planImg(input,cnt) { //alert(input);

    if (input.files && input.files[0]) {

        var reader = new FileReader();

        reader.onload = function(e) {

            $('.planblah'+cnt).attr('src', e.target.result);

    $("#oldservicepic2"+cnt).val(e.target.result);

            var html = '<img src="' + e.target.result + '">';

            $('.uploadedpic2'+cnt).html(html);

        };

        profile_pic_var = input.files[0];

        reader.readAsDataURL(input.files[0]);

    }

  }





</script>

@endsection



