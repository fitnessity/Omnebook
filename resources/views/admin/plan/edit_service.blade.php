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
 use App\BusinessPriceDetailsAges;
 use App\BusinessPriceDetails;
 
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

      <form method="post" action="{{route('update_services')}}" enctype="multipart/form-data">
        <?php
          //echo "<pre>";print_r($business_service);die;
          $service_type = $sport_activity = "";
          $program_name = $program_desc = $profile_pic = $instant_booking = $reserved_booking = $meetup_location ="";
          $select_service_type = $activity_location = $activity_for = $age_range = $group_size = $difficult_level = $activity_experience = $instructor_habit = $is_late_fee ="";
          $late_fee = ""; $bring_wear=''; $notincluded_items=''; $included_items=''; $req_safety=''; $days_plan_title='';
          $days_plan_img='';
          
          $frm_servicedesc = $exp_country = $exp_address = $exp_building = $exp_city = $exp_state = $exp_zip = "";
          if(isset($business_service)) {
            if(isset($business_service['service_type']) && !empty($business_service['service_type'])) {
                $service_type = $business_service['service_type'];
            }
            if(isset($business_service['sport_activity']) && !empty($business_service['sport_activity'])) {
                $sport_activity = $business_service['sport_activity'];
            }
            if(isset($business_service['program_name']) && !empty($business_service['program_name'])) {
                $program_name = $business_service['program_name'];
            }
            if(isset($business_service['program_desc']) && !empty($business_service['program_desc'])) {
                $program_desc = $business_service['program_desc'];
            }
            if(isset($business_service['profile_pic']) && !empty($business_service['profile_pic'])) {
                $profile_pic = $business_service['profile_pic'];
            }
            if(isset($business_service['select_service_type']) && !empty($business_service['select_service_type'])) {
                $select_service_type = $business_service['select_service_type'];
            }
            if(isset($business_service['activity_location']) && !empty($business_service['activity_location'])) {
                $activity_location = $business_service['activity_location'];
            }
            if(isset($business_service['activity_for']) && !empty($business_service['activity_for'])) {
                $activity_for = $business_service['activity_for'];
            }
            if(isset($business_service['age_range']) && !empty($business_service['age_range'])) {
                $age_range = $business_service['age_range'];
            }
            if(isset($business_service['group_size']) && !empty($business_service['group_size'])) {
                $group_size = $business_service['group_size'];
            }
            if(isset($business_service['difficult_level']) && !empty($business_service['difficult_level'])) {
                $difficult_level = $business_service['difficult_level'];
            }
            if(isset($business_service['activity_experience']) && !empty($business_service['activity_experience'])) {
                $activity_experience = $business_service['activity_experience'];
            }
            if(isset($business_service['instructor_habit']) && !empty($business_service['instructor_habit'])) {
                $instructor_habit = $business_service['instructor_habit'];
            }
            if(isset($business_service['frm_servicedesc']) && !empty($business_service['frm_servicedesc'])) {
                $frm_servicedesc = $business_service['frm_servicedesc'];
            }
            if(isset($business_service['included_items']) && !empty($business_service['included_items'])) {
                $included_items = $business_service['included_items'];
            }
            if(isset($business_service['included_items']) && !empty($business_service['included_items'])) {
                $included_items = $business_service['included_items'];
            }
            if(isset($business_service['notincluded_items']) && !empty($business_service['notincluded_items'])) {
                $notincluded_items = $business_service['notincluded_items'];
            }
            if(isset($business_service['bring_wear']) && !empty($business_service['bring_wear'])) {
                $bring_wear = $business_service['bring_wear'];
            }
            if(isset($business_service['req_safety']) && !empty($business_service['req_safety']))
            {
              $req_safety=explode(',',$business_service['req_safety']);
            }
            if(isset($business_service['days_plan_title']) && !empty($business_service['days_plan_title'])) {
                $days_plan_title = $business_service['days_plan_title'];
            }
            if(isset($business_service['days_plan_desc']) && !empty($business_service['days_plan_desc'])) {
                $days_plan_desc = $business_service['days_plan_desc'];
            }
            if(isset($business_service['days_plan_img']) && !empty($business_service['days_plan_img'])) {
                $days_plan_img = $business_service['days_plan_img'];
            }

            if(isset($business_service['meetup_location']) && !empty($business_service['meetup_location'])) {
              $meetup_location = $business_service['meetup_location'];
            }
          }
                
          $activity_meets = $starting = $schedule_until = "";
          $sales_tax = $sales_tax_percent = $dues_tax = $dues_tax_percent = "";
        
          if(isset($business_activity[0])) {
              $activity = $business_activity[0];
              if(isset($activity['activity_meets']) && !empty($activity['activity_meets'])) {
                  $activity_meets = $activity['activity_meets'];
              }
              if(isset($activity['starting']) && !empty($activity['starting'])) {
                  $starting = $activity['starting'];
              }
              if(isset($activity['schedule_until']) && !empty($activity['schedule_until'])) {
                  $schedule_until = $activity['schedule_until'];
              }
              if(isset($activity['set_duration']) && !empty($activity['set_duration'])) {
                  $set_duration = $activity['set_duration'];
              }
              if(isset($activity['sales_tax']) && !empty($activity['sales_tax'])) {
                  $sales_tax = $activity['sales_tax'];
              }
              if(isset($activity['sales_tax_percent']) && !empty($activity['sales_tax_percent'])) {
                  $sales_tax_percent = $activity['sales_tax_percent'];
              }
              if(isset($activity['dues_tax']) && !empty($activity['dues_tax'])) {
                  $dues_tax = $activity['dues_tax'];
              }
              if(isset($activity['dues_tax_percent']) && !empty($activity['dues_tax_percent'])) {
                  $dues_tax_percent = $activity['dues_tax_percent'];
              }
          }
        ?>

        @csrf

        <input type="hidden" name="sid" id="sid" value="{{$business_service['id']}}">
        <input type="hidden" name="cid" id="cid" value="{{$business_service['cid']}}">
        <div class="row" id="radiodetails">
          <div class="form-group col-md-12">
            <h4>Let's get a few details to set up your service<span class="spancolor">*</span></h4>
            <h5>Please select only one sport/activity to offer your clients</h5>
            <input type="radio" id="service_type" name="service_type" value="individual" @if($service_type == 'individual') checked @endif><label class="panel-class" for="individual"> PERSONAL TRAINER</label>
            <input type="radio" id="service_type" name="service_type" value="classes" @if($service_type == 'classes') checked @endif> <label class="panel-class" for="classes"> GYM/STUDIO</label>
            <input type="radio" id="service_type" name="service_type" value="experience" @if($service_type == 'experience') checked @endif><label class="panel-class" for="experience"> EXPERIENCE</label>
            <input type="hidden" name="hidd_service_type" id="hidd_service_type" value="{{$service_type}}">
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
                  <input type="text" class="form-control" name="frm_programname" id="frm_programname" placeholder="Enter Name of Program" title="servicetitle" value="{{ $program_name }}">
                  <span class="error" id="err_frm_programname"></span>
              </div>
              <div class="form-group col-md-12">
                  <textarea class="form-control" rows="6" name="frm_programdesc" id="frm_programdesc" placeholder="Enter program description" maxlength="150">{{ $program_desc }}</textarea>
                  <span class="error" id="err_frm_programdesc"></span>
                  <div class="text-right"><span id="frm_programdesc_left">150</span> Characters Left</div>
              </div>
              <div class="row itenerary_div" @if($service_type != 'experience') style="display:none" @endif>
                <div class="form-group col-md-12">
                  <label><h3>Set Up Your Itinerary</h3></label>
                </div>
                <div class="form-group col-md-12">
                  <label class="labelstyle" for="what_you_doing">What will you be doing? </label>
                  <textarea class="form-control" rows="6" name="what_you_doing" id="what_you_doing" placeholder="Briefly describe what you'll do with your customers. Be specific about what guests will do on your activity." maxlength="500">{{ $program_desc }}</textarea>
                  <span class="error" id="err_what_you_doing"></span>
                  <div class="text-right"><span id="frm_what_you_doing">500</span> Characters Left</div>
                </div>
                <div class="form-group col-md-12 mt-25">
                  <label class="labelstyle">What's Included with this experience?</label><br>
                  <p>What do you provide for your guest that will make the experience memorabel?
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
                  @if(!empty($profile_pic) && File::exists(public_path("/uploads/profile_pic/thumb/".$profile_pic)))
                    <img src="{{ url('/public/uploads/profile_pic/thumb/'.$profile_pic) }}" class="imagePreview blah2" id="showimgservice">
                  @else
                    <img src="{{ url('/public/images/default-avatar.png') }}" class="imagePreview blah2" id="showimgservice">
                  @endif
              </div>
              <label class="img-tab-btn">Upload Image<input type="file" name="servicepic" class="uploadFile img" value="Upload Photo" onchange="readServicePic2(this);" style="width: 0px;height: 0px;overflow: hidden;"></label>
              <span class="error" id="err_oldservicepic2"></span>
              <input type="hidden" id="oldservicepic" name="oldservicepic" value="{{ $profile_pic }}" >
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
                          <option value="An educator ">An Educator</option>
                          <option value="A teacher">A Teacher</option>
                          <option value="A lot of energy">A ot of energy</option>
                          <option value="A drill sergeant">A drill sergeant</option>
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

         <div id="divstep4" style="display: none"  >  
          <div class="panel-body">
            <div class="row" >
              <div class="col-md-12">
                  <h3 style="font-size: 17px;font-weight: bold;">SET UP YOUR PRICING DETAILS</h3>
              </div>
              <div class="col-md-12" style="padding:10px 0">
              </div>

              <div class="service_price_block">
                <?php
                  if(isset($business_price_ages) && count($business_price_ages) > 0) { ?>
                      <input type="hidden"  name="recurring_count" id="recurring_count" value="{{count($business_price_ages) - 1}}" />
                  <?php }
                  if(isset($business_price_ages) && count($business_price_ages) > 0) {
                      $i=0;
                      foreach($business_price_ages as $priceagedata){
                  ?>  
                  <input type="hidden" name="fitnessity_fee" value="{{$fitnessity_fee}}">
                  <div id="pricediv{{$i}}">
                    @if($i != 0)
                        <div class="row">
                            <hr style="border: 1px solid #d4cfcf;width: 100%;">
                            <div class="col-md-11"></div><div class="col-md-1"><i class="remove-category-price fa fa-trash-o" style="color:red; font-weight:bold; cursor:pointer; float:right" title="Remove activity"></i></div>
                        </div>
                    @endif
                    <?php
                        $business_price_details =  BusinessPriceDetails::where('category_id',$priceagedata['id'])->where('cid', $priceagedata['cid'])->where('serviceid', $priceagedata['serviceid'])->get(); ?>
                        @if(count($business_price_details) > 0) 
                            @php $acnt = count($business_price_details) - 1 ; @endphp
                            <input type="hidden"  name="ages_count{{$i}}" id="ages_count{{$i}}" value="{{$acnt}}" />
                        @else
                            <input type="hidden"  name="ages_count{{$i}}" id="ages_count{{$i}}" value="0" />
                        @endif

                        <div id="agesmaindiv{{$i}}">
                            <?php $j=0;
                                if(isset($business_price_details) && count($business_price_details) > 0) {/*print_r($business_price_details);*/
                                    $pay_chk = $pay_session_type = $pay_session = $pay_price = $pay_discountcat = $pay_discounttype = $pay_discount = $pay_estearn = $pay_setnum = $pay_setduration = $pay_after = $recurring_duration =  $recurring_every  = $recurring_price = $membership_type = $is_recurring = $category_title = $price_title = $recurring_run_auto_pay  = $recurring_cust_be_charge = $recurring_every_time_num = $recurring_every_time = $recurring_nuberofautopays = $recurring_happens_aftr_12_pmt = $recurring_client_be_charge_on = $recurring_first_pmt = $recurring_recurring_pmt = $recurring_total_contract_revenue = "" ; $j=0;
                                    foreach($business_price_details as $price){ 
                                       /* print_r($price);*/
                                        if(isset($price['pay_chk']) && !empty($price['pay_chk'])) {
                                            $pay_chk = $price['pay_chk'];
                                        }
                                        if(isset($price['pay_session_type']) && !empty($price['pay_session_type'])) {
                                            $pay_session_type = $price['pay_session_type'];
                                        }
                                        if(isset($price['pay_session']) && !empty($price['pay_session'])) {
                                            $pay_session = $price['pay_session'];
                                        }
                                        if(isset($price['pay_price']) && !empty($price['pay_price'])) {
                                            $pay_price = $price['pay_price'];
                                        }
                                        if(isset($price['category_title']) && !empty($price['category_title'])) {
                                            $category_title = $price['category_title'];
                                        }
                                        if(isset($price['price_title']) && !empty($price['price_title'])) {
                                            $price_title = $price['price_title'];
                                        }
                                        if(isset($price['pay_discountcat']) && !empty($price['pay_discountcat'])) {
                                            $pay_discountcat = $price['pay_discountcat'];
                                        }
                                        if(isset($price['pay_discounttype']) && !empty($price['pay_discounttype'])) {
                                            $pay_discounttype = $price['pay_discounttype'];
                                        }
                                        if(isset($price['pay_discount']) && !empty($price['pay_discount'])) {
                                            $pay_discount = $price['pay_discount'];
                                        }
                                        if(isset($price['pay_estearn']) && !empty($price['pay_estearn'])) {
                                            $pay_estearn = $price['pay_estearn'];
                                        }
                                        if(isset($price['pay_setnum']) && !empty($price['pay_setnum'])) {
                                            $pay_setnum = $price['pay_setnum'];
                                        }
                                        if(isset($price['pay_setduration']) && !empty($price['pay_setduration'])) {
                                            $pay_setduration = $price['pay_setduration'];
                                        }
                                        if(isset($price['pay_after']) && !empty($price['pay_after'])) {
                                            $pay_after = $price['pay_after'];
                                        }
                                        if(isset($price['is_recurring']) && !empty($price['is_recurring'])) {
                                            $is_recurring = $price['is_recurring'];
                                        }
                                        if(isset($price['recurring_price']) && !empty($price['recurring_price'])) {
                                            $recurring_price = $price['recurring_price'];
                                        }
                                        if(isset($price['recurring_run_auto_pay']) && !empty($price['recurring_run_auto_pay'])) {
                                            $recurring_run_auto_pay = $price['recurring_run_auto_pay'];
                                        }
                                        if(isset($price['recurring_cust_be_charge']) && !empty($price['recurring_cust_be_charge'])) {
                                            $recurring_cust_be_charge = $price['recurring_cust_be_charge'];
                                        }
                                        if(isset($price['recurring_every_time_num']) && !empty($price['recurring_every_time_num'])) {
                                            $recurring_every_time_num = $price['recurring_every_time_num'];
                                        }
                                        if(isset($price['recurring_every_time']) && !empty($price['recurring_every_time'])) {
                                            $recurring_every_time = $price['recurring_every_time'];
                                        }
                                        if(isset($price['recurring_nuberofautopays']) && !empty($price['recurring_nuberofautopays'])) {
                                            $recurring_nuberofautopays = $price['recurring_nuberofautopays'];
                                        }
                                        if(isset($price['recurring_happens_aftr_12_pmt']) && !empty($price['recurring_happens_aftr_12_pmt'])) {
                                            $recurring_happens_aftr_12_pmt = $price['recurring_happens_aftr_12_pmt'];
                                        }
                                        if(isset($price['recurring_client_be_charge_on']) && !empty($price['recurring_client_be_charge_on'])) {
                                            $recurring_client_be_charge_on = $price['recurring_client_be_charge_on'];
                                        }
                                        if(isset($price['recurring_first_pmt']) && !empty($price['recurring_first_pmt'])) {
                                            $recurring_first_pmt = $price['recurring_first_pmt'];
                                        } 
                                        if(isset($price['recurring_recurring_pmt']) && !empty($price['recurring_recurring_pmt'])) {
                                            $recurring_recurring_pmt = $price['recurring_recurring_pmt'];
                                        } 
                                        if(isset($price['recurring_total_contract_revenue']) && !empty($price['recurring_total_contract_revenue'])) {
                                            $recurring_total_contract_revenue = $price['recurring_total_contract_revenue'];
                                        }
                                        /*if(isset($price['recurring_every']) && !empty($price['recurring_every'])) {
                                            $recurring_every = $price['recurring_every'];
                                        }
                                        if(isset($price['recurring_duration']) && !empty($price['recurring_duration'])) {
                                            $recurring_duration = $price['recurring_duration'];
                                        }*/
                                        if(isset($price['membership_type']) && !empty($price['membership_type'])) {
                                            $membership_type = $price['membership_type'];
                                        }                
                            ?>
                            <input type="hidden" name="fitnessity_fee" value="{{$fitnessity_fee}}">
                            <div id="agesdiv{{$i}}{{$j}}">
                                @if($j != 0)
                                    <div class="row">
                                        <hr style="border: 1px solid #d4cfcf;width: 100%;">
                                        <div class="col-md-11"></div><div class="col-md-1"><i class="remove-agediv fa fa-trash-o" style="color:red; font-weight:bold; cursor:pointer; float:right" title="Remove activity" onclick="remove_agediv({{$i}},{{$j}});"></i></div>
                                    </div>
                                @endif
                                <div class="row">
                                    <div class="col-md-3">
                                        @if($j == 0)
                                        <div class="priceselect sp-select">
                                            <label>Category Title (Give a name for this category)</label>
                                            <input type="text" name="category_title[]" id="category_title"  class="inputs" value="{{$priceagedata['category_title']}}" placeholder="Couples Private Lessons">
                                        </div>
                                        @endif
                                    </div>
                                    <div class="col-md-6">
                                        @if($j == 0)
                                        <div class="sp-select-sche">
                                            <!-- <p><a onclick="setschedule();">+Set Your Schedule</a>(Schedule the times this activity will happen)</p> -->
                                        </div>
                                        @endif
                                    </div>
                                    <div class="col-md-3">
                                        <div class="priceselect sp-select">
                                            <label>Is This A Recurring Payment?</label>
                                            <div class="">
                                                <input class="check-price"  data-count="0"  type="checkbox" id="is_recurring{{$i}}{{$j}}" name="is_recurring_{{$i}}{{$j}}" @if($price['is_recurring'] == '1') Checked value="1" @else value="0"  @endif onclick="openmodelbox({{$i}},{{$j}});" >
                                                <label>Set recurring payment terms</label>
                                                <button style="display:none" id="btn_recurring{{$i}}{{$j}}" name="btn_recurring_{{$i}}{{$j}}[]" type="button" data-count="0" class="btn btn-primary recurrint_id" data-toggle="modal" data-target="#ModelRecurring{{$i}}{{$j}}" onclick="recurrint_id({{$i}},{{$j}});">Launch demo modal</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal fade ModelRecurring{{$i}}{{$j}}" id="ModelRecurring{{$i}}{{$j}}" tabindex="-1" role="dialog" aria-labelledby="ModelRecurringTitle" aria-hidden="true">
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
                                                            <h5 class="modal-title" id="ModelRecurringTitle{{$i}}{{$j}}">Editing Autopay/Contract Settings for {{$price_title}}</h5>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-8">
                                                        <div class="Settings-title">
                                                            <h5> Settings </h5>
                                                        </div>
                                                        <div class="setting-box">
                                                            <div class="row set-78">
                                                                <div class="col-md-4">
                                                                    <label class="contractsettings">Run Auto Pay</label>
                                                                </div>
                                                                <div class="col-md-8">
                                                                    <div class="autopay">
                                                                        <input type="radio" id="run_auto_pay{{$i}}{{$j}}" name="run_auto_pay_{{$i}}{{$j}}" value="on_set_schedule"  @if($recurring_run_auto_pay == 'on_set_schedule') checked @endif>
                                                                        <label for="on_set_schedule">On a set schedule (recommended)</label><br>
                                                                        <input type="radio" id="run_auto_pay{{$i}}{{$j}}" name="run_auto_pay_{{$i}}{{$j}}" value="price_opt_run_out" @if($recurring_run_auto_pay == 'price_opt_run_out') checked @endif>
                                                                        <label for="price_opt_run_out">When price option runs out   </label><br> 
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row set-78">
                                                                <div class="col-md-4">
                                                                    <label class="contractsettings">How often will customers be charged?</label>
                                                                </div>
                                                                <div class="col-md-8">
                                                                    <div class="autopay">
                                                                        <input type="radio" id="cust_be_charge{{$i}}{{$j}}" name="cust_be_charge_{{$i}}{{$j}}" value="num_of_autopay" @if($recurring_cust_be_charge == 'num_of_autopay') checked @endif>
                                                                        <label for="Autopays">Set number of autopays</label><br>
                                                                        <input type="radio" id="cust_be_charge{{$i}}{{$j}}" name="cust_be_charge_{{$i}}{{$j}}" value="month-to-month" @if($recurring_cust_be_charge == 'month-to-month') checked @endif>
                                                                        <label for="Month">Month - to -Month    </label><br> 
                                                                    </div>
                                                                    <div class="customerscharged">
                                                                        <label> Every </label>
                                                                        <input type="text" class="form-control valid" name="every_time_num_{{$i}}{{$j}}" id="every_time_num{{$i}}{{$j}}" placeholder="1" value="{{$recurring_every_time_num}}">
                                                                        <select class="form-control" name="every_time_{{$i}}{{$j}}" id="every_time{{$i}}{{$j}}">
                                                                            <option value="Weekly" @if($recurring_every_time == 'Weekly') selected @endif>Weekly</option>
                                                                            <option value="On a specific month" @if($recurring_every_time == 'On a specific month') selected @endif>Month </option>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row set-78">
                                                                <div class="col-md-4">
                                                                    <label class="contractsettings">Number of autopays  </label>
                                                                </div>
                                                                <div class="col-md-8">
                                                                    <div class="nuberofautopays">
                                                                        <input type="text" class="form-control valid" name="nuberofautopays_{{$i}}{{$j}}" id="nuberofautopays{{$i}}{{$j}}" placeholder="12" value="{{$recurring_nuberofautopays}}">
                                                                    </div>
                                                                    <div class="contract">
                                                                        <label>  Total duration of contract: </label>
                                                                        <p>12 months</p>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row set-78">
                                                                <div class="col-md-4">
                                                                    <label class="contractsettings">What happens after 12 payments?</label>
                                                                </div>
                                                                <div class="col-md-8">
                                                                    <div class="autopay">
                                                                        <input type="radio" id="happens_aftr_12_pmt{{$i}}{{$j}}" name="happens_aftr_12_pmt_{{$i}}{{$j}}" value="contract_expire"@if($recurring_happens_aftr_12_pmt == 'contract_expire') checked @endif>
                                                                        <label for="contract">Contract Expires</label><br>
                                                                        <input type="radio" id="happens_aftr_12_pmt{{$i}}{{$j}}" name="happens_aftr_12_pmt_{{$i}}{{$j}}" value="contract_renew" @if($recurring_happens_aftr_12_pmt == 'contract_renew') checked @endif>
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
                                                                        <select class="form-control" name="client_be_charge_on_{{$i}}{{$j}}" id="client_be_charge_on{{$i}}{{$j}}">
                                                                            <option value="sale date" @if($recurring_client_be_charge_on == 'sale date') selected @endif>On the sale date </option>
                                                                            <option value="date" @if($recurring_client_be_charge_on == 'date') selected @endif>date</option>
                                                                        </select>
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
                                                                        <p id="p_price_title{{$i}}{{$j}}">{{$price_title}}</p>
                                                                    </div>
                                                                    <div class="col-md-4">
                                                                        <p>($Price )</p>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-md-12">
                                                                    <div class="Settings-title">
                                                                        <h5> Revenue Earned </h5>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-8">
                                                                    <p>First Payment:</p>
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <p id="p_first_pmt{{$i}}{{$j}}">$400</p>
                                                                </div>
                                                                <input type="hidden" name="first_pmt_{{$i}}{{$j}}" id="first_pmt{{$i}}{{$j}}" value="">
                                                                <input type="hidden" name="recurring_pmt_{{$i}}{{$j}}" id="recurring_pmt{{$i}}{{$j}}" value="">
                                                                <div class="col-md-8">
                                                                    <p>Recurring Payment: </p>
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <p id="p_recurring_pmt{{$i}}{{$j}}">$400</p>
                                                                </div>
                                                                <input type="hidden" name="total_contract_revenue_{{$i}}{{$j}}" id="total_contract_revenue{{$i}}{{$j}}" value="">
                                                                <div class="col-md-8">
                                                                    <label>Total Contract Revenue:  </label>
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <p id="p_total_contract_revenue{{$i}}{{$j}}"> $1,200</p>
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
                               
                                <div class="row mt-30">
                                    <div class="col-md-3 col-sm-6">
                                        <div class="priceselect sp-select">
                                            <label>Price Title</label>
                                            <input type="text" name="price_title_{{$i}}{{$j}}" id="price_title{{$i}}{{$j}}"  class="inputs" placeholder="ex. 30 Minute Section" value="{{$price_title}}" oninput="getpricetitle({{$i}},{{$j}})">
                                        </div>
                                    </div>
                                    <div class="col-md-3 col-sm-6">
                                        <div class="priceselect sp-select">
                                            <label>Session Type</label>
                                            <select name="pay_session_type_{{$i}}{{$j}}" id="pay_session_type{{$i}}{{$j}}" class="bd-right bd-bottom pay_session_type" onchange="pay_session_select({{$i}},{{$j}},this.value);">
                                                <option value="">Select Value</option>
                                                <option <?=($pay_session_type=='Single')?'selected':'' ?>>Single</option>
                                                <option <?=($pay_session_type=='Multiple')?'selected':'' ?>>Multiple</option>
                                                <option <?=($pay_session_type=='Unlimited')?'selected':'' ?>>Unlimited</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-3 col-sm-6">
                                        <div class="priceselect sp-select">
                                            <label>Number of Sessions</label>
                                            <input type="text" name="pay_session_{{$i}}{{$j}}" id="pay_session{{$i}}{{$j}}"  class="inputs pay_session" placeholder="1" value="{{$pay_session}}">
                                        </div>
                                    </div>

                                    <div class="col-md-3 col-sm-6">
                                        <div class="priceselect sp-select">
                                            <label>Membership Type</label>
                                            <select name="membership_type_{{$i}}{{$j}}" id="membership_type{{$i}}{{$j}}" class="bd-right bd-bottom membership_type">
                                                <option @if($membership_type=="Drop In") selected="selected" @endif value="Drop In">Drop In</option>
                                                <option @if($membership_type=="Semester") selected="selected" @endif value="Semester">Semester (Long Term)</option>
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
                                            <input type="text" name="adult_cus_weekly_price_{{$i}}{{$j}}" id="adult_cus_weekly_price{{$i}}{{$j}}" placeholder="$" onkeyup="adultchangeestprice({{$i}},{{$j}});" value="{{$price['adult_cus_weekly_price']}}">
                                        </div>
                                    </div>
                                    <div class="weekend-price">
                                        <div class="cus-week-price sp-select">
                                            <label>Weekend Price </label>
                                            <p> ( Saturday & Sunday)</p>
                                            <input type="text" name="adult_weekend_price_diff_{{$i}}{{$j}}" id="adult_weekend_price_diff{{$i}}{{$j}}" placeholder="$"  value="{{$price['adult_weekend_price_diff']}}" onkeyup="weekendadultchangeestprice({{$i}},{{$j}});">
                                        </div>
                                    </div>
                                    <div class="re-discount">
                                        <div class="discount sp-select">
                                            <label>Any Discount? </label>
                                            <p> (Recommended 10% to 15%)</p>
                                            <input type="text" name="adult_discount_{{$i}}{{$j}}" id="adult_discount{{$i}}{{$j}}" onkeyup="adultdischangeestprice({{$i}},{{$j}});" value="{{$price['adult_discount']}}" >
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
                                        <div class="cus-week-price earn sp-select">
                                            <label>Weekday Estimated Earnings </label>
                                            <input type="text" name="adult_estearn_{{$i}}{{$j}}" id="adult_estearn{{$i}}{{$j}}" placeholder="$" value="{{$price['adult_estearn']}}">
                                        </div>
                                    </div>
                                    <div class="estimated-earn">
                                        <div class="cus-week-price earn sp-select">
                                            <label>Weekend Estimated Earnings </label>
                                            <input type="text" name="weekend_adult_estearn_{{$i}}{{$j}}" id="weekend_adult_estearn{{$i}}{{$j}}" placeholder="$" value="{{$price['weekend_adult_estearn']}}">
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
                                            <input type="text" name="child_cus_weekly_price_{{$i}}{{$j}}" id="child_cus_weekly_price{{$i}}{{$j}}" placeholder="$"  onkeyup="childchangeestprice({{$i}},{{$j}});" value="{{$price['child_cus_weekly_price']}}">
                                        </div>
                                    </div>
                                    <div class="weekend-price">
                                        <div class="cus-week-price sp-select">
                                            <label>Weekend Price</label>
                                            <p> ( Saturday & Sunday)</p>
                                            <input type="text" name="child_weekend_price_diff_{{$i}}{{$j}}" id="child_weekend_price_diff{{$i}}{{$j}}" placeholder="$" value="{{$price['child_weekend_price_diff']}}" onkeyup="weekendchildchangeestprice({{$i}},{{$j}});" >
                                        </div>
                                    </div>
                                    <div class="re-discount">
                                        <div class="discount sp-select">
                                            <label>Any Discount?</label>
                                            <p> (Recommended 10% to 15%)</p>
                                            <input type="text" name="child_discount_{{$i}}{{$j}}" id="child_discount{{$i}}{{$j}}" onkeyup="childdischangeestprice({{$i}},{{$j}});" value="{{$price['child_discount']}}">
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
                                        <div class="cus-week-price earn sp-select">
                                            <label>Weekday Estimated Earnings</label>
                                            <input type="text" name="child_estearn_{{$i}}{{$j}}" id="child_estearn{{$i}}{{$j}}" placeholder="$" value="{{$price['child_estearn']}}">
                                        </div>
                                    </div>
                                    <div class="estimated-earn">
                                        <div class="cus-week-price earn sp-select">
                                            <label>Weekend Estimated Earnings</label>
                                            <input type="text" name="weekend_child_estearn_{{$i}}{{$j}}" id="weekend_child_estearn{{$i}}{{$j}}" placeholder="$" value="{{$price['weekend_child_estearn']}}">
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
                                            <input type="text" name="infant_cus_weekly_price_{{$i}}{{$j}}" id="infant_cus_weekly_price{{$i}}{{$j}}" placeholder="$" onkeyup="infantchangeestprice({{$i}},{{$j}});" value="{{$price['infant_cus_weekly_price']}}">
                                        </div>
                                    </div>
                                    <div class="weekend-price">
                                        <div class="cus-week-price sp-select">
                                            <label>Weekend Price</label>
                                            <p> ( Saturday & Sunday)</p>
                                            <input type="text" name="infant_weekend_price_diff_{{$i}}{{$j}}" id="infant_weekend_price_diff{{$i}}{{$j}}" placeholder="$" value="{{$price['infant_weekend_price_diff']}}" onkeyup="weekendinfantchangeestprice({{$i}},{{$j}});" value="{{$price['infant_cus_weekly_price']}}">
                                        </div>
                                    </div>
                                    <div class="re-discount">
                                        <div class="discount sp-select">
                                            <label>Any Discount?</label>
                                            <p> (Recommended 10% to 15%)</p>
                                            <input type="text" name="infant_discount_{{$i}}{{$j}}" id="infant_discount{{$i}}{{$j}}" onkeyup="infantdischangeestprice({{$i}},{{$j}});" value="{{$price['infant_discount']}}"> 
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
                                        <div class="cus-week-price earn sp-select">
                                            <label>Weekday Estimated Earnings</label>
                                            <input type="text" name="infant_estearn_{{$i}}{{$j}}" id="infant_estearn{{$i}}{{$j}}" placeholder="$" value="{{$price['infant_estearn']}}">
                                        </div>
                                    </div>
                                    <div class="estimated-earn">
                                        <div class="cus-week-price earn sp-select">
                                            <label>Weekend Estimated Earnings</label>
                                            <input type="text" name="weekend_infant_estearn_{{$i}}{{$j}}" id="weekend_infant_estearn{{$i}}{{$j}}" placeholder="$" value="{{$price['weekend_infant_estearn']}}">
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
                                            <input type="text" name="pay_setnum_{{$i}}{{$j}}" id="pay_setnum{{$i}}{{$j}}" class="form-control valid" placeholder="(ex,1,2,3,etc.)" value="1" onkeypress="return IsNumeric(event);" ondrop="return false;" onpaste="return false;">
                                        </div>
                                    </div>
                                    <div class="col-md-3 col-sm-6 col-xs-12">
                                        <div class="set-num">
                                            <label>The Duration</label>
                                            <select name="pay_setduration_{{$i}}{{$j}}" id="pay_setduration{{$i}}{{$j}}" class="form-control valid">
                                                <option value="">Select Value</option>
                                                <option <?=($pay_setduration=='Days')?'selected':'' ?>>Days</option>
                                                <option <?=($pay_setduration=='Months')?'selected':'' ?>>Months</option>
                                                <option <?=($pay_setduration=='Year')?'selected':'' ?>>Year</option>
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
                                            <select name="pay_after_{{$i}}{{$j}}" id="pay_after{{$i}}{{$j}}" class="pay_after form-control valid">
                                                <option value="">Select Value</option>
                                                <option value="1" <?=($pay_after=='1')?'selected':'' ?>>Starts to expire the day of purchase</option>
                                                <option value="2" <?=($pay_after=='2')?'selected':'' ?>>Starts to expire when the customer first participates in the activity</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php $j++; } 
                                }?>
                        </div>
                    <!-- <div  class="row"> -->
                      <div  class="">
                          <div class="col-md-12">
                              <div class="addanother">
                                  <a class="" onclick=" return add_another_price_ages({{$i}});"> +Add Another Session </a>
                              </div>  
                          </div>
                      </div>
                  </div>
                  <?php 
                    $i++;
                      }
                    }
                  ?>   
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


    function openmodelbox(i,j) {
       var checkBox = document.getElementById("is_recurring"+i+j);
        if (checkBox.checked == true){
            $('#btn_recurring'+i+j).trigger("click");
            $('#is_recurring'+i+j).val(1);
        }else{
            $('#is_recurring'+i+j).val(0);
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
         ages_data +='<div id="agesdiv'+i+cnt+'"><div class="row"><hr style="border: 1px solid #d4cfcf;width: 100%;"><div class="col-md-11"></div><div class="col-md-1"><i class="remove-agediv fa fa-trash-o" style="color:red; font-weight:bold; cursor:pointer; float:right" title="Remove emp option" onclick="remove_agediv('+i+','+cnt+');"></i></div></div><div class="row"><div class="col-md-4"> </div><div class="col-md-5"> </div><div class="col-md-3"><div class="priceselect sp-select"><label>Is This A Recurring Payment?</label><div class=""><input data-count="0" class="check-price" type="checkbox" id="is_recurring'+i+cnt+'" name="is_recurring_'+i+cnt+'" onclick="openmodelbox('+i+','+cnt+');"> <label>Set recurring payment terms</label> <button style="display:none" id="btn_recurring'+i+cnt+'" name="btn_recurring_'+i+cnt+'[]" type="button" data-count="0" class="btn btn-primary recurrint_id" data-toggle="modal" data-target="#ModelRecurring'+i+cnt+'" onclick="recurrint_id('+i+','+cnt+');">Launch demo modal</button></div> </div></div></div><div class="modal fade ModelRecurring'+i+cnt+'" id="ModelRecurring'+i+cnt+'" tabindex="-1" role="dialog" aria-labelledby="ModelRecurringTitle" aria-hidden="true"><div class="modal-dialog editingautopay" role="document"><div class="modal-content"><div class="modal-header"><button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button></div><div class="modal-body"><div class="row"><div class="col-md-12"><div class="editingautopay"><h5 class="modal-title" id="ModelRecurringTitle'+i+cnt+'">Editing Autopay/Contract Settings for </h5></div></div></div><div class="row"><div class="col-md-8"><div class="Settings-title"><h5> Settings </h5></div><div class="setting-box"><div class="row set-78"><div class="col-md-4"><label class="contractsettings">Run Auto Pay</label></div><div class="col-md-8"><div class="autopay"><input type="radio" id="run_auto_pay'+i+cnt+'" name="run_auto_pay_'+i+cnt+'" value="on_set_schedule"><label for="on_set_schedule">On a set schedule (recommended)</label><br><input type="radio" id="run_auto_pay'+i+cnt+'" name="run_auto_pay_'+i+cnt+'" value="price_opt_run_out"><label for="price_opt_run_out">When price option runs out   </label><br> </div></div></div><div class="row set-78"><div class="col-md-4"><label class="contractsettings">How often will customers be charged?</label></div><div class="col-md-8"><div class="autopay"><input type="radio" id="cust_be_charge'+i+cnt+'" name="cust_be_charge_'+i+cnt+'" value="num_of_autopay"><label for="Autopays">Set number of autopays</label><br><input type="radio" id="cust_be_charge'+i+cnt+'" name="cust_be_charge_'+i+cnt+'" value="month-to-month"><label for="Month">Month - to -Month    </label><br> </div><div class="customerscharged"><label> Every </label><input type="text" class="form-control valid" name="every_time_num_'+i+cnt+'" id="every_time_num'+i+cnt+'" placeholder="1" style="margin-left: 5px;"><select class="form-control" name="every_time_'+i+cnt+'" id="every_time'+i+cnt+'" style="margin-left: 5px;"><option value="Weekly" selected="">Weekly</option><option value="On a specific month" >Month </option></select></div></div></div><div class="row set-78"><div class="col-md-4"><label class="contractsettings">Number of autopays  </label></div><div class="col-md-8"><div class="nuberofautopays"><input type="text" class="form-control valid" name="nuberofautopays_'+i+cnt+'" id="nuberofautopays'+i+cnt+'" placeholder="12"></div><div class="contract"><label>  Total duration of contract: </label><p>12 months</p></div></div></div><div class="row set-78"><div class="col-md-4"><label class="contractsettings">What happens after 12 payments?</label></div><div class="col-md-8"><div class="autopay"><input type="radio" id="happens_aftr_12_pmt'+i+cnt+'" name="happens_aftr_12_pmt_'+i+cnt+'" value="contract_expire"><label for="contract">Contract Expires</label><br><input type="radio" id="happens_aftr_12_pmt'+i+cnt+'" name="happens_aftr_12_pmt_'+i+cnt+'" value="contract_renew"><label for="renews">Contract Automaitcally Renews Every 12 payments</label><br> </div></div></div><div class="row set-78"><div class="col-md-4"><label class="contractsettings">When will clients be charged?</label></div><div class="col-md-8"><div class="saledate"><select class="form-control" name="client_be_charge_on_'+i+cnt+'" id="client_be_charge_on'+i+cnt+'"><option value="sale date" selected="">On the sale date </option><option value="date">date</option></select></div></div></div></div></div><div class="col-md-4"><div class="Settings-title"><h5> Contract Review </h5></div><div class="setting-box"><div class="set-border"><div class="row"><div class="col-md-8"><p id="p_price_title'+i+cnt+'"></p></div><div class="col-md-4"><p>($Price )</p></div></div></div><div class="row"><div class="col-md-12"><div class="Settings-title"><h5> Revenue Earned </h5></div></div><div class="col-md-8"><p>First Payment:</p></div><div class="col-md-4"><p id="p_first_pmt'+i+cnt+'">$400</p></div><input type="hidden" name="first_pmt_'+i+cnt+'" id="first_pmt'+i+cnt+'" value=""><input type="hidden" name="recurring_pmt_'+i+cnt+'" id="recurring_pmt'+i+cnt+'" value=""><div class="col-md-8"><p>Recurring Payment: </p></div><div class="col-md-4"><p id="p_recurring_pmt'+i+cnt+'">$400</p></div><input type="hidden" name="total_contract_revenue_'+i+cnt+'" id="total_contract_revenue'+i+cnt+'" value=""><div class="col-md-8"><label>Total Contract Revenue:  </label></div><div class="col-md-4"><p id="p_total_contract_revenue'+i+cnt+'"> $1,200</p></div></div></div></div></div></div></div></div></div><div class="row mt-30"><div class="col-md-3 col-sm-6"><div class="priceselect sp-select"><label>Price Title</label> <input type="text" name="price_title_'+i+cnt+'" id="price_title'+i+cnt+'"  class="inputs" placeholder="ex. 30 Minute Section" value="" oninput="getpricetitle('+i+','+cnt+')"> </div> </div> <div class="col-md-3 col-sm-6"><div class="priceselect sp-select"><label>Session Type</label> <select name="pay_session_type_'+i+cnt+'" id="pay_session_type'+i+cnt+'" class="bd-right bd-bottom pay_session_type" onchange="pay_session_select('+i+','+cnt+',this.value);"><option value="">Select Value</option><option value="Single">Single</option><option value="Multiple">Multiple</option><option value="Unlimited">Unlimited</option></select></div></div><div class="col-md-3 col-sm-6"><div class="priceselect sp-select"><label>Number of Sessions</label><input type="text" name="pay_session_'+i+cnt+'" id="pay_session'+i+cnt+'"  class="inputs pay_session" placeholder="1" value=""></div></div><div class="col-md-3 col-sm-6"><div class="priceselect sp-select"><label>Membership Type</label><select name="membership_type_'+i+cnt+'" id="membership_type'+i+cnt+'" class="bd-right bd-bottom membership_type"><option value="Drop In">Drop In</option> <option value="Semester">Semester (Long Term)</option></select></div> </div></div>  <div class="row"><div class="col-md-12"><div class="setprice sp-select"><h3>You can set your prices to be the same or different based on age, the weekday or the weekend.To add prices for children or infants, click on the box.</h3></div></div></div><div class="row"><div class="age-cat"><div class="cat-age sp-select"><label>Adults</label><p>Ages 12 & Older</p></div></div> <div class="weekly-customer"><div class="cus-week-price sp-select"><label>Weekday Price</label> <p> (Monday - Friday)</p><input type="text" name="adult_cus_weekly_price_'+i+cnt+'" id="adult_cus_weekly_price'+i+cnt+'" placeholder="$"  onkeyup="adultchangeestprice('+i+','+cnt+');"></div></div><div class="weekend-price"><div class="cus-week-price sp-select"><label>Weekend Price </label> <p> ( Saturday & Sunday)</p> <input type="text" name="adult_weekend_price_diff_'+i+cnt+'" id="adult_weekend_price_diff'+i+cnt+'" placeholder="$"  onkeyup="weekendadultchangeestprice('+i+','+cnt+');"></div></div><div class="re-discount"><div class="discount sp-select"><label>Any Discount? </label><p> (Recommended 10% to 15%)</p><input type="text" name="adult_discount_'+i+cnt+'" id="adult_discount'+i+cnt+'" onkeyup="adultdischangeestprice('+i+','+cnt+');"></div> </div><div class="single-dash"><div class="desh sp-select"><label>-</label></div></div><div class="fit-fees"><div class="fees sp-select"><label>Fitnessity Fee </label><p> '+fitnessity_fee+'%</p></div></div><div class="single-equal"> <div class="equal sp-select"> <label>=</label></div></div><div class="estimated-earn"><div class="cus-week-price earn sp-select"> <label>Weekday Estimated Earnings </label><input type="text" name="adult_estearn_'+i+cnt+'" id="adult_estearn'+i+cnt+'" placeholder="$"></div></div><div class="estimated-earn"><div class="cus-week-price sp-select"><label>Weekend Estimated Earnings</label><input type="text" name="weekend_adult_estearn_'+i+cnt+'" id="weekend_adult_estearn'+i+cnt+'" placeholder="$"></div></div></div><div class="row"> <div class="age-cat"><div class="cat-age sp-select"><label>Children</label> <p>Ages 2 to 12</p></div> </div><div class="weekly-customer"> <div class="cus-week-price sp-select"><label>Weekday Price</label><p> (Monday - Friday)</p> <input type="text" name="child_cus_weekly_price_'+i+cnt+'" id="child_cus_weekly_price'+i+cnt+'" placeholder="$" onkeyup="childchangeestprice('+i+','+cnt+');"></div>  </div><div class="weekend-price"><div class="cus-week-price sp-select"><label>Weekend Price</label> <p> ( Saturday & Sunday)</p><input type="text" name="child_weekend_price_diff_'+i+cnt+'" id="child_weekend_price_diff'+i+cnt+'" placeholder="$" onkeyup="weekendchildchangeestprice('+i+','+cnt+');"></div></div><div class="re-discount"><div class="discount sp-select"> <label>Any Discount?</label><p> (Recommended 10% to 15%)</p> <input type="text" name="child_discount_'+i+cnt+'" id="child_discount'+i+cnt+'"  onkeyup="childdischangeestprice('+i+','+cnt+');"> </div></div> <div class="single-dash"> <div class="desh sp-select"><label>-</label> </div></div><div class="fit-fees"><div class="fees sp-select"><label>Fitnessity Fee</label><p> '+fitnessity_fee+'%</p></div></div><div class="single-equal"><div class="equal sp-select"> <label>=</label></div> </div> <div class="estimated-earn"><div class="cus-week-price earn sp-select"><label>Weekday Estimated Earnings</label><input type="text" name="child_estearn_'+i+cnt+'" id="child_estearn'+i+cnt+'" placeholder="$" ></div></div><div class="estimated-earn"><div class="cus-week-price sp-select"><label>Weekend Estimated Earnings</label><input type="text" name="weekend_child_estearn_'+i+cnt+'" id="weekend_child_estearn'+i+cnt+'" placeholder="$"></div></div></div><div class="row"> <div class="age-cat"><div class="cat-age sp-select"> <label>Infants</label><p>Ages 2 & Under</p> </div> </div><div class="weekly-customer"><div class="cus-week-price sp-select"><label>Weekday Price</label><p> (Monday - Friday)</p><input type="text" name="infant_cus_weekly_price_'+i+cnt+'" id="infant_cus_weekly_price'+i+cnt+'" placeholder="$" onkeyup="infantchangeestprice('+i+','+cnt+');"> </div> </div><div class="weekend-price"><div class="cus-week-price sp-select"><label>Weekend Price</label> <p> ( Saturday & Sunday)</p><input type="text" name="infant_weekend_price_diff_'+i+cnt+'" id="infant_weekend_price_diff'+i+cnt+'" placeholder="$" onkeyup="weekendinfantchangeestprice('+i+','+cnt+');"></div></div><div class="re-discount"><div class="discount sp-select"><label>Any Discount?</label><p> (Recommended 10% to 15%)</p><input type="text" name="infant_discount_'+i+cnt+'" id="infant_discount'+i+cnt+'" onkeyup="infantdischangeestprice('+i+','+cnt+');"></div></div><div class="single-dash"><div class="desh sp-select"><label>-</label></div></div> <div class="fit-fees"><div class="fees sp-select"><label>Fitnessity Fee</label> <p> '+fitnessity_fee+'%</p></div> </div><div class="single-equal"><div class="equal sp-select"><label>=</label> </div></div><div class="estimated-earn"><div class="cus-week-price earn sp-select"> <label> Weekday Estimated Earnings</label>  <input type="text" name="infant_estearn_'+i+cnt+'" id="infant_estearn'+i+cnt+'" placeholder="$"> </div></div><div class="estimated-earn"><div class="cus-week-price sp-select"><label>Weekend Estimated Earnings</label><input type="text" name="weekend_infant_estearn_'+i+cnt+'" id="weekend_infant_estearn'+i+cnt+'" placeholder="$"></div></div></div><div class="row"></div> <div class="col-md-12 col-sm-12"> <div class="serviceprice sp-select"><h3>When Does This Price Setting Expire</h3></div></div><div class="col-md-3 col-sm-6 col-xs-12"> <div class="set-num"><label>Set The Number</label><input type="text" name="pay_setnum_'+i+cnt+'" id="pay_setnum'+i+cnt+'" class="form-control valid" placeholder="(ex,1,2,3,etc.)" value="1" onkeypress="return IsNumeric(event);" ondrop="return false;" onpaste="return false;"></div>    </div><div class="col-md-3 col-sm-6 col-xs-12"> <div class="set-num"><label>The Duration</label> <select name="pay_setduration_'+i+cnt+'" id="pay_setduration'+i+cnt+'" class="form-control valid"><option value="">Select Value</option><option selected="" value="Days">Days</option><option value="Months">Months</option><option value="Year">Year</option></select></div></div> <div class="col-md-1 col-xs-12"><div class="set-num after"><label>After</label></div>            </div><div class="col-md-5 col-xs-12"><div class="after-select"><select name="pay_after_'+i+cnt+'" id="pay_after'+i+cnt+'" class="pay_after form-control valid"><option value="">Select Value</option><option selected="" value="1">Starts to expire the day of purchase</option><option value="2">Starts to expire when the customer first participates in the activity</option></select></div></div></div>';
        $("#agesmaindiv"+i).append(ages_data);
    }

    function getpricetitle(i,j){
        var x = document.getElementById("price_title"+i+j).value;
        document.getElementById("ModelRecurringTitle"+i+j).innerHTML = 'Editing Autopay/Contract Settings for '+x;
        document.getElementById("p_price_title"+i+j).innerHTML = x;
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
     /* $('#divstep3').show();*/
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
     /* $('#divstep3').show();*/
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


    $("body").on("click", ".add-another-category-price", function(){
        var fitnessity_fee = '{{$fitnessity_fee}}';
        var cnt=$('#recurring_count').val();
        cnt++;
        $('#recurring_count').val(cnt);
        var service_price = "";
        service_price +='<div id="pricediv'+cnt+'"><div class="row"><hr style="border: 1px solid #d4cfcf;width: 100%;"><div class="col-md-11"></div><div class="col-md-1"><i class="remove-category-price fa fa-trash-o" style="color:red; font-weight:bold; cursor:pointer; float:right" title="Remove emp option"></i></div></div><input type="hidden" name="ages_count'+cnt+'" id="ages_count'+cnt+'" value="0"><div id="agesmaindiv'+cnt+'"><div id="agesdiv'+cnt+'0"><div class="row"><div class="col-md-3"><div class="priceselect sp-select"><label>Category Title (Give a name for this category)</label><input type="text" name="category_title[]" id="category_title"  class="inputs" value="" placeholder="Couples Private Lessons"></div></div><div class="col-md-6"><div class="sp-select-sche"></div></div><div class="col-md-3"><div class="priceselect sp-select"><label>Is This A Recurring Payment?</label><div class=""><input data-count="0" class="check-price" type="checkbox" id="is_recurring'+cnt+'0" name="is_recurring_'+cnt+'0" onclick="openmodelbox('+cnt+',0);"><label>Set recurring payment terms</label><button style="display:none" id="btn_recurring'+cnt+'0" name="btn_recurring_'+cnt+'0[]" type="button" data-count="0" class="btn btn-primary recurrint_id" data-toggle="modal" data-target="#ModelRecurring'+cnt+'0" onclick="recurrint_id('+cnt+',0);">Launch demo modal</button></div></div></div></div><div class="modal fade ModelRecurring'+cnt+'0" id="ModelRecurring'+cnt+'0" tabindex="-1" role="dialog" aria-labelledby="ModelRecurringTitle" aria-hidden="true"><div class="modal-dialog editingautopay" role="document"><div class="modal-content"><div class="modal-header"><button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button></div><div class="modal-body"><div class="row"><div class="col-md-12"><div class="editingautopay"><h5 class="modal-title" id="ModelRecurringTitle'+cnt+'0">Editing Autopay/Contract Settings for </h5></div></div></div><div class="row"><div class="col-md-8"><div class="Settings-title"><h5> Settings </h5></div><div class="setting-box"><div class="row set-78"><div class="col-md-4"><label class="contractsettings">Run Auto Pay</label></div><div class="col-md-8"><div class="autopay"><input type="radio" id="run_auto_pay'+cnt+'0" name="run_auto_pay_'+cnt+'0" value="on_set_schedule"><label for="on_set_schedule">On a set schedule (recommended)</label><br><input type="radio" id="run_auto_pay'+cnt+'0" name="run_auto_pay_'+cnt+'0" value="price_opt_run_out"><label for="price_opt_run_out">When price option runs out   </label><br> </div></div></div><div class="row set-78"><div class="col-md-4"><label class="contractsettings">How often will customers be charged?</label></div><div class="col-md-8"><div class="autopay"><input type="radio" id="cust_be_charge'+cnt+'0" name="cust_be_charge_'+cnt+'0" value="num_of_autopay"><label for="Autopays">Set number of autopays</label><br><input type="radio" id="cust_be_charge'+cnt+'0" name="cust_be_charge_'+cnt+'0" value="month-to-month"><label for="Month">Month - to -Month    </label><br> </div><div class="customerscharged"><label> Every </label><input type="text" class="form-control valid" name="every_time_num_'+cnt+'0" id="every_time_num'+cnt+'0" placeholder="1" style="margin-left: 5px;"><select class="form-control" name="every_time_'+cnt+'0" id="every_time'+cnt+'0" style="margin-left: 5px;"><option value="Weekly" selected="">Weekly</option><option value="On a specific month" >Month </option></select></div></div></div><div class="row set-78"><div class="col-md-4"><label class="contractsettings">Number of autopays  </label></div><div class="col-md-8"><div class="nuberofautopays"><input type="text" class="form-control valid" name="nuberofautopays_'+cnt+'0" id="nuberofautopays'+cnt+'0" placeholder="12"></div><div class="contract"><label>  Total duration of contract: </label><p>12 months</p></div></div></div><div class="row set-78"><div class="col-md-4"><label class="contractsettings">What happens after 12 payments?</label></div><div class="col-md-8"><div class="autopay"><input type="radio" id="happens_aftr_12_pmt'+cnt+'0" name="happens_aftr_12_pmt_'+cnt+'0" value="contract_expire"><label for="contract">Contract Expires</label><br><input type="radio" id="happens_aftr_12_pmt'+cnt+'0" name="happens_aftr_12_pmt_'+cnt+'0" value="contract_renew"><label for="renews">Contract Automaitcally Renews Every 12 payments</label><br> </div></div></div><div class="row set-78"><div class="col-md-4"><label class="contractsettings">When will clients be charged?</label></div><div class="col-md-8"><div class="saledate"><select class="form-control" name="client_be_charge_on_'+cnt+'0" id="client_be_charge_on'+cnt+'0"><option value="sale date" selected="">On the sale date </option><option value="date">date</option></select></div></div></div></div></div><div class="col-md-4"><div class="Settings-title"><h5> Contract Review </h5></div><div class="setting-box"><div class="set-border"><div class="row"><div class="col-md-8"><p id="p_price_title'+cnt+'0"</p></div><div class="col-md-4"><p>($Price )</p></div></div></div><div class="row"><div class="col-md-12"><div class="Settings-title"><h5> Revenue Earned </h5></div></div><div class="col-md-8"><p>First Payment:</p></div><div class="col-md-4"><p id="p_first_pmt'+cnt+'0">$400</p></div><input type="hidden" name="first_pmt_'+cnt+'0" id="first_pmt'+cnt+'0" value=""><input type="hidden" name="recurring_pmt_'+cnt+'0" id="recurring_pmt'+cnt+'0" value=""><div class="col-md-8"><p>Recurring Payment: </p></div><div class="col-md-4"><p id="p_recurring_pmt'+cnt+'0">$400</p></div><input type="hidden" name="total_contract_revenue_'+cnt+'0" id="total_contract_revenue'+cnt+'0" value=""><div class="col-md-8"><label>Total Contract Revenue:  </label></div><div class="col-md-4"><p id="p_total_contract_revenue'+cnt+'0"> $1,200</p></div></div></div></div></div></div></div> </div></div> <div class="row mt-30"><div class="col-md-3 col-sm-6"><div class="priceselect sp-select"><label>Price Title</label><input type="text" name="price_title_'+cnt+'0" id="price_title'+cnt+'0"  class="inputs" placeholder="ex. 30 Minute Section" value="" oninput="getpricetitle('+cnt+',0)"></div></div><div class="col-md-3 col-sm-6"><div class="priceselect sp-select"><label>Session Type</label><select name="pay_session_type_'+cnt+'0" id="pay_session_type'+cnt+'0" class="bd-right bd-bottom pay_session_type" onchange="pay_session_select('+cnt+',0,this.value);"><option value="">Select Value</option><option value="Single">Single</option><option value="Multiple">Multiple</option><option value="Unlimited">Unlimited</option></select></div></div><div class="col-md-3 col-sm-6"><div class="priceselect sp-select"><label>Number of Sessions</label><input type="text" name="pay_session_'+cnt+'0" id="pay_session'+cnt+'0"  class="inputs pay_session" placeholder="1" value=""></div></div><div class="col-md-3 col-sm-6"><div class="priceselect sp-select"><label>Membership Type</label><select name="membership_type_'+cnt+'0" id="membership_type'+cnt+'0" class="bd-right bd-bottom membership_type"><option value="Drop In">Drop In</option><option value="Semester">Semester (Long Term)</option></select></div></div></div><div class="row"><div class="col-md-12"><div class="setprice sp-select"><h3>You can set your prices to be the same or different based on age, the weekday or the weekend.To add prices for children or infants, click on the box.</h3></div></div></div><div class="row"><div class="age-cat"><div class="cat-age sp-select"><label>Adults</label><p>Ages 12 & Older</p></div></div><div class="weekly-customer"><div class="cus-week-price sp-select"><label>Weekday Price</label><p> (Monday - Friday)</p><input type="text" name="adult_cus_weekly_price_'+cnt+'0" id="adult_cus_weekly_price'+cnt+'0" placeholder="$" onkeyup="adultchangeestprice('+cnt+',0);" value=""></div></div><div class="weekend-price"><div class="cus-week-price sp-select"><label>Weekend Price </label><p> ( Saturday & Sunday)</p><input type="text" name="adult_weekend_price_diff_'+cnt+'0" id="adult_weekend_price_diff'+cnt+'0" placeholder="$" onkeyup="weekendadultchangeestprice('+cnt+',0);" value=""></div></div><div class="re-discount"><div class="discount sp-select"><label>Any Discount? </label><p> (Recommended 10% to 15%)</p><input type="text" name="adult_discount_'+cnt+'0" id="adult_discount'+cnt+'0" onkeyup="adultdischangeestprice('+cnt+',0);" value=""></div></div><div class="single-dash"><div class="desh sp-select"><label>-</label></div></div><div class="fit-fees"><div class="fees sp-select"><label>Fitnessity Fee </label><p> '+fitnessity_fee+'%</p></div></div><div class="single-equal"><div class="equal sp-select"><label>=</label></div></div><div class="estimated-earn"><div class="cus-week-price earn sp-select"><label> Weekday Estimated Earnings </label><input type="text" name="adult_estearn_'+cnt+'0" id="adult_estearn'+cnt+'0" placeholder="$" value=""></div></div><div class="estimated-earn"><div class="cus-week-price sp-select"><label>Weekend Estimated Earnings</label><input type="text" name="weekend_adult_estearn_'+cnt+'0" id="weekend_adult_estearn'+cnt+'0" placeholder="$"></div></div></div><div class="row"><div class="age-cat"><div class="cat-age sp-select"><label>Children</label><p>Ages 2 to 12</p></div></div><div class="weekly-customer"><div class="cus-week-price sp-select"><label>Weekday Price</label><p> (Monday - Friday)</p><input type="text" name="child_cus_weekly_price_'+cnt+'0" id="child_cus_weekly_price'+cnt+'0" placeholder="$"  onkeyup="childchangeestprice('+cnt+',0);" value=""></div></div><div class="weekend-price"><div class="cus-week-price sp-select"><label>Weekend Price</label><p> ( Saturday & Sunday)</p><input type="text" name="child_weekend_price_diff_'+cnt+'0" id="child_weekend_price_diff'+cnt+'0" placeholder="$" onkeyup="weekendchildchangeestprice('+cnt+',0);" value=""></div></div><div class="re-discount"><div class="discount sp-select"><label>Any Discount?</label><p> (Recommended 10% to 15%)</p><input type="text" name="child_discount_'+cnt+'0" id="child_discount'+cnt+'0" onkeyup="childdischangeestprice('+cnt+',0);" value=""></div></div><div class="single-dash"><div class="desh sp-select"><label>-</label></div></div><div class="fit-fees"><div class="fees sp-select"><label>Fitnessity Fee</label><p> '+fitnessity_fee+'%</p></div></div><div class="single-equal"><div class="equal sp-select"><label>=</label></div></div><div class="estimated-earn"><div class="cus-week-price earn sp-select"><label>Weekday Estimated Earnings</label><input type="text" name="child_estearn_'+cnt+'0" id="child_estearn'+cnt+'0" placeholder="$" value=""></div></div><div class="estimated-earn"><div class="cus-week-price sp-select"><label>Weekend Estimated Earnings</label><input type="text" name="weekend_child_estearn_'+cnt+'0" id="weekend_child_estearn'+cnt+'0" placeholder="$"></div></div></div><div class="row"><div class="age-cat"><div class="cat-age sp-select"><label>Infants</label><p>Ages 2 & Under</p></div></div><div class="weekly-customer"><div class="cus-week-price sp-select"><label>Weekday Price</label><p> (Monday - Friday)</p><input type="text" name="infant_cus_weekly_price_'+cnt+'0" id="infant_cus_weekly_price'+cnt+'0" placeholder="$" onkeyup="infantchangeestprice('+cnt+',0);" value=""></div></div><div class="weekend-price"><div class="cus-week-price sp-select"><label>Weekend Price</label><p> ( Saturday & Sunday)</p><input type="text" name="infant_weekend_price_diff_'+cnt+'0" id="infant_weekend_price_diff'+cnt+'0" placeholder="$" value="" onkeyup="weekendinfantchangeestprice('+cnt+',0);"></div></div><div class="re-discount"><div class="discount sp-select"><label>Any Discount?</label><p> (Recommended 10% to 15%)</p><input type="text" name="infant_discount_'+cnt+'0" id="infant_discount'+cnt+'0" onkeyup="infantdischangeestprice('+cnt+',0);" value=""> </div></div><div class="single-dash"><div class="desh sp-select"><label>-</label></div></div><div class="fit-fees"><div class="fees sp-select"><label>Fitnessity Fee</label><p> '+fitnessity_fee+'%</p></div></div><div class="single-equal"><div class="equal sp-select"><label>=</label></div></div><div class="estimated-earn"><div class="cus-week-price earn sp-select"><label>Weekday Estimated Earnings</label><input type="text" name="infant_estearn_'+cnt+'0" id="infant_estearn'+cnt+'0" placeholder="$" value=""></div></div><div class="estimated-earn"><div class="cus-week-price sp-select"><label>Weekend Estimated Earnings</label><input type="text" name="weekend_infant_estearn_'+cnt+'0" id="weekend_infant_estearn'+cnt+'0" placeholder="$"></div></div></div><div class="row"><div class="col-md-12 col-sm-12"><div class="serviceprice sp-select"><h3>When Does This Price Setting Expire</h3></div></div><div class="col-md-3 col-sm-6 col-xs-12"><div class="set-num"><label>Set The Number</label><input type="text" name="pay_setnum_'+cnt+'0" id="pay_setnum'+cnt+'0" class="form-control valid" placeholder="(ex,1,2,3,etc.)" value="1" onkeypress="return IsNumeric(event);" ondrop="return false;" onpaste="return false;"></div></div><div class="col-md-3 col-sm-6 col-xs-12"><div class="set-num"><label>The Duration</label><select name="pay_setduration_'+cnt+'0" id="pay_setduration'+cnt+'0" class="form-control valid"><option value="">Select Value</option><option selected="" value="Days">Days</option><option value="Months">Months</option><option value="Year">Year</option></select></div></div><div class="col-md-1 col-xs-12"><div class="set-num after"><label>After</label></div></div><div class="col-md-5 col-xs-12"><div class="after-select"><select name="pay_after_'+cnt+'0" id="pay_after'+cnt+'0" class="pay_after form-control valid"><option value="">Select Value</option><option selected="" value="1">Starts to expire the day of purchase</option><option value="2" >Starts to expire when the customer first participates in the activity</option></select></div></div></div></div></div><div  class=""><div class="col-md-12"><div class="addanother"><a class="" onclick=" return add_another_price_ages('+cnt+');"> +Add Another Session </a></div> </div></div></div>';
            $(".service_price_block").append(service_price);
    });

    $("body").on("click", ".remove-category-price ", function(){
        var cnt=$('#recurring_count').val();
        cnt--;
        $('#recurring_count').val(cnt);
        $(this).parent('div').parent('div').parent('div').remove();
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
      var fitnessity_fee = 0;
      var pid = $(this).parent().parent().parent().attr('id');
      var pay_disc = $('#'+pid).find('#pay_discount:first').val();
      var fitnessity_fee = '{{$fitnessity_fee}}';
      $('#'+pid).find('.pay_estearn:first').val($(this).val() - ($(this).val()*fitnessity_fee)/100 - ($(this).val()*pay_disc)/100);
    });

    $("body").on("blur", "#pay_discount", function(){
      var fitnessity_fee = 0;
      var pay_price = 0;
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

    $('body').delegate('.timezone-round','click',function(){  
      if($('#frm_class_meets').val()=='Weekly')
      {   
        if($(this).hasClass("day_circle_fill"))
          $(this).removeClass('day_circle_fill');
        else
          $(this).addClass('day_circle_fill');
      }
    });

    /* Set the value of slimSelect drop down list */
    var servicetypearr = [];
    var servicetype = '{{ $select_service_type }}';
    servicetype = servicetype.split(',');
    $.each(servicetype, function( index, value ) {
        servicetypearr.push(value);
    });
    const serviceSelect1 = new SlimSelect({
        select: '#categSType'
    });
    serviceSelect1.set(servicetypearr);
  
    var included_thingsarr = [];
    var included_things = '<?php echo $included_items; ?>';
    included_things = included_things.split(',');
    $.each(included_things, function( index, value ) {
        included_thingsarr.push(value);
    });
    const included_thingsSelect = new SlimSelect({
        select: '#frm_included_things'
    });
    included_thingsSelect.set(included_thingsarr);
  
    var notincluded_thingsarr = [];
    var notincluded_things = '<?php echo $notincluded_items; ?>';
    notincluded_things = notincluded_things.split(',');
    $.each(notincluded_things, function( index, value ) {
        notincluded_thingsarr.push(value);
    });
    const notincluded_thingsSelect = new SlimSelect({
        select: '#frm_notincluded_things'
    });
    notincluded_thingsSelect.set(notincluded_thingsarr);
  
    var frm_wearsarr = [];
    var frm_wear = '<?php echo $bring_wear; ?>';
    frm_wear = frm_wear.split(',');
    $.each(frm_wear, function( index, value ) {
        frm_wearsarr.push(value);
    });
    const frm_wearSelect = new SlimSelect({
        select: '#frm_wear'
    });
    frm_wearSelect.set(frm_wearsarr);
  
    var servicelocationarr = [];
    var servicelocation = '{{ $activity_location }}';
  /*  alert(servicelocation); */
    servicelocation = servicelocation.split(',');
    $.each(servicelocation, function( index, value ) {
      servicelocationarr.push(value);
    });
    const serviceSelect2 = new SlimSelect({
      select: '#frm_servicelocation'
    });

    serviceSelect2.set(servicelocationarr);
  
    
    var programforarr = [];
    var programfor = '{{ $activity_for }}';
    programfor = programfor.split(',');
    $.each(programfor, function( index, value ) {
        programforarr.push(value);
    });
    const serviceSelect3 = new SlimSelect({
        select: '#frm_programfor'
    });
    serviceSelect3.set(programforarr);

    
    var agerangearr = [];
    var agerange = '{{ $age_range }}';
    agerange = agerange.split(',');
    $.each(agerange, function( index, value ) {
     
        agerangearr.push(value);
    });
    const serviceSelect4 = new SlimSelect({
        select: '#frm_agerange'
    });
    serviceSelect4.set(agerangearr);
    
   /* var numberofpeoplearr = [];
    var numberofpeople = '{{ $group_size }}';
    numberofpeople = numberofpeople.split(',');
    $.each(numberofpeople, function( index, value ) {
        numberofpeoplearr.push(value);
    });
    const serviceSelect5 = new SlimSelect({
        select: '#frm_numberofpeople'
    });
    serviceSelect5.set(numberofpeoplearr);*/
    
    var experiencelevelarr = [];
    var experiencelevel = '{{ $difficult_level }}';
    experiencelevel = experiencelevel.split(',');
    $.each(experiencelevel, function( index, value ) {
        experiencelevelarr.push(value);
    });
    const serviceSelect6 = new SlimSelect({
        select: '#frm_experience_level'
    });
    serviceSelect6.set(experiencelevelarr);
    
    var servicefocusesarr = [];
    var servicefocuses = '{{ $activity_experience }}';
    servicefocuses = servicefocuses.split(',');
    $.each(servicefocuses, function( index, value ) {
        servicefocusesarr.push(value);
    });
    const serviceSelect7 = new SlimSelect({
        select: '#frm_servicefocuses'
    });
    serviceSelect7.set(servicefocusesarr);
  
    
    var teachingstylearr = [];
    var teachingstyle = '{{ $instructor_habit }}';
    teachingstyle = teachingstyle.split(',');
    $.each(teachingstyle, function( index, value ) {
        teachingstylearr.push(value);
    });
    const serviceSelect8 = new SlimSelect({
        select: '#teaching'
    });
    serviceSelect8.set(teachingstylearr);

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



