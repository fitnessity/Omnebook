<style>
.dollar-span{
    left: 3px;
    position: relative;
    top: 45px;
}
 .Zebra_DatePicker {
    background: #666;
    border-radius: 4px;
    box-shadow: 0 0 10px #888;
    color: #222;
    font: 13px Tahoma,Arial,Helvetica,sans-serif;
    padding: 3px;
    position: absolute;
    display: table;
    *width: 255px;
    z-index: 1200
}
.Zebra_DatePicker *,
.Zebra_DatePicker :after,
.Zebra_DatePicker :before {
    box-sizing: content-box!important
}
.Zebra_DatePicker * {
    padding: 0
}
.Zebra_DatePicker table {
    border-collapse: collapse;
    border-radius: 4px;
    border-spacing: 0;
    width: 100%
}
.Zebra_DatePicker td,
.Zebra_DatePicker th {
    padding: 5px;
    cursor: pointer;
    text-align: center;
    min-width: 25px;
    width: 25px
}
.Zebra_DatePicker .dp_body td,
.Zebra_DatePicker .dp_body th {
    border: 1px solid #bfbfbf
}
.Zebra_DatePicker .dp_body td:first-child,
.Zebra_DatePicker .dp_body th:first-child {
    border-left: none
}
.Zebra_DatePicker .dp_body td:last-child,
.Zebra_DatePicker .dp_body th:last-child {
    border-right: none
}
.Zebra_DatePicker .dp_body tr:first-child td,
.Zebra_DatePicker .dp_body tr:first-child th {
    border-top: none
}
.Zebra_DatePicker .dp_body tr:last-child td,
.Zebra_DatePicker .dp_body tr:last-child th {
    border-bottom: none
}
.Zebra_DatePicker .dp_body td {
    background: #e6e5e5
}
.Zebra_DatePicker .dp_body .dp_weekend {
    background: #d6d6d6
}
.Zebra_DatePicker .dp_body .dp_not_in_month {
    background: #e0e6f2;
    color: #98acd4
}
.Zebra_DatePicker .dp_body .dp_time_controls_condensed td {
    width: 25%
}
.Zebra_DatePicker .dp_body .dp_current {
    color: #cc236b
}
.Zebra_DatePicker .dp_body .dp_selected {
    background: #b56a6a;
    color: #fff
}
.Zebra_DatePicker .dp_body .dp_disabled {
    background: #f2f2f2;
    color: #ccc;
    cursor: text
}
.Zebra_DatePicker .dp_body .dp_disabled.dp_current {
    color: #b56a6a
}
.Zebra_DatePicker .dp_body .dp_hover {
    color: #fff;
    background: #88a09e
}
.Zebra_DatePicker .dp_body .dp_hover.dp_time_control {
    background-color: #8c8c8c;
    color: #fff
}
.Zebra_DatePicker .dp_monthpicker td,
.Zebra_DatePicker .dp_timepicker td,
.Zebra_DatePicker .dp_yearpicker td {
    width: 33.3333%
}
.Zebra_DatePicker .dp_timepicker .dp_disabled {
    border: none;
    color: #222;
    font-size: 26px;
    font-weight: 700
}
.Zebra_DatePicker .dp_time_separator div {
    position: relative
}
.Zebra_DatePicker .dp_time_separator div:after {
    content: ":";
    color: 1px solid #bfbfbf;
    font-size: 20px;
    left: 100%;
    margin-left: 2px;
    margin-top: -13px;
    position: absolute;
    top: 50%;
    z-index: 1
}
.Zebra_DatePicker .dp_header {
    margin-bottom: 3px
}
@supports (-ms-ime-align:auto) {
    .Zebra_DatePicker .dp_header {
        font-family: 'Segoe UI Symbol',Tahoma,Arial,Helvetica,sans-serif
    }
}
.Zebra_DatePicker .dp_footer {
    margin-top: 3px
}
.Zebra_DatePicker .dp_footer .dp_icon {
    width: 50%
}
.Zebra_DatePicker .dp_actions td {
    border-radius: 4px;
    color: #fff
}
.Zebra_DatePicker .dp_actions .dp_caption {
    font-weight: 700;
    width: 100%
}
.Zebra_DatePicker .dp_actions .dp_next,
.Zebra_DatePicker .dp_actions .dp_previous {
    *padding: 0 10px
}
.Zebra_DatePicker .dp_actions .dp_hover {
    background-color: #8c8c8c;
    color: #fff
}
.Zebra_DatePicker .dp_daypicker th {
    background: #ed3948;
    cursor: text;
    font-weight: 700
}
.Zebra_DatePicker.dp_hidden {
    display: none
}
.Zebra_DatePicker .dp_icon {
    height: 16px;
    background-image: url(icons.png);
    background-repeat: no-repeat;
    text-indent: -9999px;
    *text-indent: 0
}
.Zebra_DatePicker .dp_icon.dp_confirm {
    background-position: center -123px
}
.Zebra_DatePicker .dp_icon.dp_view_toggler {
    background-position: center -91px
}
.Zebra_DatePicker .dp_icon.dp_view_toggler.dp_calendar {
    background-position: center -59px
}
button.Zebra_DatePicker_Icon {
    background: url(icons.png) center top no-repeat;
    border: none;
    cursor: pointer;
    display: block;
    height: 16px;
    line-height: 0;
    padding: 0;
    position: absolute;
    text-indent: -9000px;
    width: 16px
}
button.Zebra_DatePicker_Icon.Zebra_DatePicker_Icon_Disabled {
    background-position: center -32px;
    cursor: default
}
.day_circle{
    width: 50px;
    height: 50px;
    border-radius: 25px;
    background: beige;
    margin-left:30px;
    box-shadow: 0 0 0 3px beige;
    cursor:pointer;
}
.day_circle_fill{
    width: 50px;
    height: 50px;
    border-radius: 25px;
    background: red;
    margin-left:30px;
    box-shadow: 0 0 0 3px red;
    cursor:pointer;
}
.day_circle p{
    position: relative;
    top: 21%;
    text-transform:capitalize;
}
  .step{
    background-color: #69af6a;
  }
  button#submit_service{
    float: right;
    width: auto;
    display: inline-block;
    font-size: 14px;
    margin: 40px 0 25px;
    background: #f53b49 none repeat scroll 0 0;
    border: 1px solid #f53b49;
    padding: 8px 35px;
    cursor: pointer;
    text-transform: uppercase;
    color: #fff;
  }
  div#recurring_pay {
    margin-left: 30px;
    margin-bottom: 30px;
}
.step2multiples{
  width: 50%;
}
  .stepbtn{
    width: auto;
    display: inline-block;
    font-size: 14px;
    margin: 40px 0 25px;
    background: #f53b49 none repeat scroll 0 0;
    border: 1px solid #f53b49;
    padding: 8px 35px;
    cursor: pointer;
    text-transform: uppercase;
    color: #fff;
  }
.hrsam {
    border-top: 1px solid #dedede;
    padding: 20px 0px 5px 0px;
    text-align: initial;
}
  #salestaxpercentage{
        position: relative;
    top: -21px;
    right: -80px;
  }
  div#duestaxpercentage {
    position: relative;
    top: -21px;
    right: -80px;
}
#multisession{
  position: relative;
    top: -30px;
    right: -120px;
}
.ui-timepicker-container.ui-timepicker-standard {
    z-index: 99999999 !important;
}
.pop-title1 {
    background: #f53b49;
    text-align: right;
    width: 50%;
    padding: 10px 20px;
    height: 70px;
    margin: 30px 0 -60px;
    float: none;
    position: relative;
    left: -20px;
    top: -100px;
}
.pop-title2 {
    background: #f53b49;
    text-align: right;
    width: 50%;
    padding: 10px 20px;
    height: 70px;
    margin: 30px 0 -60px;
    float: none;
    position: relative;
    left: -20px;
    top: -100px;
}
.pop-title3 {
    background: #f53b49;
    text-align: right;
    width: 50%;
    padding: 10px 20px;
    height: 70px;
    margin: 10px 0 -60px;
    float: none;
    position: relative;
    left: -20px;
    top: -100px;
}
.pop-title1 h3 {
    color: #fff;
    font-size: 48px;
    font-family: 'bebasregular';
    line-height: 58px;
}
.pop-title2 h3 {
    color: #fff;
    font-size: 48px;
    font-family: 'bebasregular';
    line-height: 58px;
}
.pop-title3 h3 {
    color: #fff;
    font-size: 48px;
    font-family: 'bebasregular';
    line-height: 58px;
}

</style>
<?php @$service=@$service[0];
          $login_id = Auth::user();
          @$hours = json_decode($service['serv_time_slot'],true);
            ?>
<form method="post" enctype="multipart/form-data" id="servicedata" class="edit-addprgm">
          <input type="hidden" name="_token" value="{{csrf_token()}}"> 
          <input type="hidden" name="editrowcount_service" id="editrowcount_service" value="">
          <input type="hidden" name="editservice_id" id="editservice_id" value="{{$service['id']}}">
          <div class="modal-dialog modal-lg">
            <!-- Modal content-->
            <div class="modal-content">
              <div class="modal-body login-pad">
                
                <button type="button" class="close modal-close mymodalclose mymodalclose2" >
                <img src="<?php echo Config::get('constants.FRONT_IMAGE'); ?>close.jpg" height="70" width="34"/>
                </button>
                <div class="signup">
                  <div id='systemMessage_service'></div>
 <!--start mayankstep1-->
<div id="mayankstep1">
                <div class="pop-title1 employe-title">
                  <h3>Add Your Program</h3>
                </div>
                <div class="emplouyee-form">
                  <div class="row">
                    <div class="col-sm-12">
                      	<div class="select-style review-select2">
                            <select name="frm_servicesport" id="frm_servicesport" class="selectpicker">
                            {!! $sports_select !!}
                            </select>
                          </div>
                          <input type="text" name="frm_servicetitle" id="frm_servicetitle" placeholder="Name of Program" title="servicetitle" value="{{$service['title']}}" style="margin-top: 0px;margin-bottom: 2px;"/>
                           <!--<div class="row">-->
                           <!--    <div class="col-sm-6">-->
                           <!--        <input type="text" placeholder="Time Spot From" class="timepicker" name="frm_servicetimeslotfrom" value="{{$service['timeslot_from']}}" autocomplete="off" style="width:100%">-->
                           <!--    </div>-->
                           <!--    <div class="col-sm-6">-->
                           <!--        <input type="text" placeholder="Time Spot To" class="timepicker" name="frm_servicetimeslotto" value="{{$service['timeslot_to']}}" autocomplete="off" style="width:100%">-->
                           <!--    </div>-->
                           <!--</div>-->
                      </div>
                    </div>
                  </div>
                  
                  
                    <!--<div class="row">
                	            <div class="col-lg-9 col-md-9 col-sm-9 col-xs-9">
                	                <div class="clearfix"></div>
                                    <p style="padding: 0px !important;text-align: left !important;"><b>Upload Picture</b></p>
                	                <input class="upload-pic" type="file" name="profile_pic" id="profile_pic" class="form-control" value="{{ old('profile_pic') }}" onchange="readURL(this);" >
                                    <br>
                                    <font style="color:red">@if ($errors->has('profile_pic')) {{$errors->first('profile_pic')}} @endif</font>
                	            </div>
                	           <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3" style="padding-top: 11px;">
                	           	<span class="user-img uploadedpic"><i class="fa fa-user"></i></span>
                	           </div>-->
                	           
                	           
                <div class="emplouyee-form hrsam">
                    <div class="row">
                      <div class="col-md-12">
                        <div class="emplouyee-form">
                          <p class="para-upload"> <b>Upload an image that best represents your program.</b>
                            (Uploading a professional image of your program will appear on your profile and increase your chances of being picked by customers.)
                          </p>
                          <input type="hidden" name="old_profile_pic" id="old_profile_pic" title="old_profile_pic">
                          <input type="hidden" name="updated_profile_pic" id="updated_profile_pic" title="updated_profile_pic">
                          
                          <?php
                              //if($service && $service['image'] != ''&& $service['image'] != null && file_exists(public_path().DIRECTORY_SEPARATOR.'uploads'.DIRECTORY_SEPARATOR.'service_profile_pic'.DIRECTORY_SEPARATOR.'thumb'.DIRECTORY_SEPARATOR.$service['image'])) {
                                //echo '<img src="'.Config::get('constants.SERVICE_IMAGE_THUMB').$service['image'].'"  id="display_user_profile_pic_view_profile" class="display_user_profile_pic_view_profile" style="width: 75px;height: 75px"/>';
                             // }
                            ?>
                        
                          <input class="upload-pic" type="file" name="frm_profile_pic" id="frm_profile_pic" class="form-control" title="profile_pic" value="{{ old('image') }}" onchange="readURL(this)" style="width:75%;">
                          <br>
                          <font style="color:red">@if ($errors->has('profile_pic')) {{$errors->first('profile_pic')}} @endif</font>
                          
                          
                          @if($image)
                           <span class="user-img uploadedpic" style="margin-left: 13px;width: 75px;height: 75px"><img src="<?php echo 'https://fitnessitynew.raursoft.org/public/uploads/service_profile_pic/'.$image; ?>" height="70" width="34"/></span>
                           
                           @else
                          <span class="user-img uploadedpic" style="margin-left: 13px;width: 75px;height: 75px"><i class="fa fa-user" style="line-height: 56px;"></i></span>
                          @endif
                        </div>
                      </div>
                    </div>
                    <div class="icondoller-wrap">
                    <span class="dollar-span"  @if($service['price'] != null && $service['price'] != 'undefined')style="display:show;" @else style="display:none;"@endif>$</span>
                    @if($service['price'] != null && $service['price'] != 'undefined')
                    <input type="number" name="frm_serviceprice" oninput="var j = $(this).val();if(j == ''){$('.dollar-span').hide();}else{$('.dollar-span').show();}" onchange="var j = $(this).val();if(j == ''){$('.dollar-span').hide();}else{$('.dollar-span').show();}var k = j.split('.');$(this).val(parseFloat(k[0]).toFixed(2));" id="frm_serviceprice" value="{{str_replace('$','',$service['price'])}}" placeholder="Price($)" title="serviceprice" style="margin-top: 15px;">
                    @else
                    <input type="number" name="frm_serviceprice" oninput="var j = $(this).val();if(j == ''){$('.dollar-span').hide();}else{$('.dollar-span').show();}" onchange="var j = $(this).val();if(j == ''){$('.dollar-span').hide();}else{$('.dollar-span').show();}var k = j.split('.');$(this).val(parseFloat(k[0]).toFixed(2));" id="frm_serviceprice" placeholder="Price($)" title="serviceprice" style="margin-top: 15px;">
                    @endif
                    </div>
                    <textarea name="frm_servicedesc" id="frm_servicedesc" placeholder="Program Description">{{$service['servicedesc']}}</textarea>
                 <!--   <textarea name="frm_tcdesc" id="frm_tcdesc" placeholder="Terms and Conditions for this program" required></textarea>-->
                   
                  </div>

                  <div>
                    <span class="step active"></span>
                    <span class="step"></span>
                    <span class="step"></span>
                  </div>
                    <div class="modallink mt20">
              <div class="signup-new-customer text-center">
                  <button type="button" class="stepbtn" href="#" onclick="$('#mayankstep1').hide();$('#mayankstep2').show();$('#mayankstep3').hide();">NEXT</button>
                </div>
              </div>
                  {{--  additional option  --}}
                   <div id="taxmsg" style="display:none"></div>
                   <br>

 <!--end mayankstep1-->
</div>






<!--start mayankstep2-->
<div id="mayankstep2" style="display: none;">
              <div class="pop-title2 employe-title">
                  <h3>Tell us more about your services</h3>
              </div>
<!--- timing -->
              <!--             <div class="row">
         
        </div> -->
                    <!-- end timing -->



<div class="row">
  <div class="col-md-12">
<div class="emplouyee-form">
                    
                    <div class="multiples">
                      <label>Choose Provider Type</label> 
                      <select name="frm_servicetype[]" id="categ" multiple>
                        @foreach ($businessType as $bkey => $bval)
                        <?php $servicetype = json_decode($service['servicetype'],true);
                          ?> 
                        <option value='{{$bkey}}' @if(@in_array($bkey,$servicetype)) selected @endif> {{$bval->type}}</option>
                        @endforeach
                      </select>
                    </div>
                    <div class="multiples">
                     <label>Activity Designed For</label>
                      <select name="activitydesignsfor[]" id="activitydesigned" multiple>
                        @foreach ($activity as $pkey => $pval)
                          <?php $pkey = str_replace(' ','_',strtolower($pkey)); 
                          $activitydesignsfor = json_decode($service['activitydesignsfor'],true);
                          ?>
                        <option value='{{$pkey}}'  @if(@in_array($pkey,$activitydesignsfor)) selected @endif> {{$pval}}</option>
                        @endforeach
                      </select>
                    </div>
                    <div class="multiples">
                      <label>Choose Activity Type </label>
                      <select name="activitytype[]" id="activitytype" multiple>
                        @foreach ($programType as $pkey => $pval)
                         <?php $pkey = str_replace(' ','_',strtolower($pkey)); 
                         $activitytype = json_decode($service['activitytype'],true);?>
                        <option value='{{$pkey}}' @if(@in_array($pkey,$activitytype)) selected @endif> {{$pval}}</option>
                        @endforeach
                      </select>
                    </div>
                    <div class="multiples">
                      <label>Age Range</label>
                      <select name="frm_agerange[]" id="frm_agerange" multiple>
                        @foreach ($ageRange as $arkey => $arval)
                         <?php $arkey = str_replace(' ','_',strtolower($arkey)); 
                         $agerange = json_decode($service['agerange'],true);
                         ?>
                        <option value='{{$arkey}}' @if(@in_array($arkey,$agerange)) selected @endif> {{$arval}}</option>
                        @endforeach
                      </select>
                    </div>
                    <div class="multiples">
                      <label>Activity For?</label>
                      <select name="frm_programfor[]" id="frm_programfor" multiple>
                        @foreach ($programFor as $pfkey => $pfval)
                         <?php $pfkey = str_replace(' ','_',strtolower($pfkey));
                         $programfor = json_decode($service['programfor'],true);
                          ?>
                        <option value='{{$pfkey}}' @if(@in_array($pfkey,$programfor)) selected @endif> {{$pfval}}</option>
                        @endforeach
                      </select>
                    </div>
                    <div class="multiples">
                      <label>Participates Number</label>
                      <select name="frm_numberofpeople[]" id="frm_numberofpeople">
                        @foreach ($numberOfPeople as $npkey => $npval)
                         <?php $npkey = str_replace(' ','_',strtolower($npkey)); 
                         $numberofpeople = json_decode($service['numberofpeople'],true);
                         ?>
                        <option value='{{$npkey}}' @if(@in_array($npkey,$numberofpeople)) selected @endif> {{$npval}}</option>
                        @endforeach
                      </select>
                    </div>
                    <div class="multiples">
                      <label>Program Experience Level</label>
                      <select name="frm_experience_level[]" id="frm_experience_level" multiple>
                        @foreach ($expLevel as $elkey => $elval)
                         <?php 
                         $experience_level = json_decode($service['experience_level'],true);
                         ?>
                        <option value='{{$elkey}}' @if(@in_array($elkey,$experience_level)) selected @endif> {{$elval}}</option>
                        @endforeach
                      </select>
                    </div>
                    <div class="multiples">
                      <label>Teaching Style</label>
                      <select name="frm_teachingstyle[]" id="teaching" multiple>
                        @foreach ($teaching as $elkey => $elval)
                         <?php 
                         $frm_teachingstyle = json_decode($service['frm_teachingstyle'],true);
                         ?>
                        <option value='{{$elkey}}' @if(@in_array($elkey,$frm_teachingstyle)) selected @endif> {{$elval}}</option>
                        @endforeach
                      </select>
                    </div>
                    <div class="multiples">
                      <label>Activity Location</label>
                      <select name="frm_servicelocation[]" id="frm_servicelocation" multiple>
                        @foreach ($serviceLocation as $slkey => $slval)
                        <?php $slkey = str_replace(' ','_',strtolower($slkey));
                         $servicelocation = json_decode($service['servicelocation'],true);
                         ?>
                        <option value='{{$slkey}}' @if(@in_array($slkey,$servicelocation)) selected @endif>{{$slval}}</option>
                        @endforeach
                      </select>
                    </div>
                    <div class="multiples">
                      <label>Activity Experience</label>
                      <select name="frm_servicefocuses[]" id="frm_servicefocuses" multiple>
                        @foreach ($pFocuses as $pfkey => $pfval)
                          <?php $pfkey = str_replace(' ','_',strtolower($pfkey)); 
                          $focuses = json_decode($service['focuses'],true);
                          ?>
                        <option value='{{$pfkey}}' @if(@in_array($pfkey,$focuses)) selected @endif> {{$pfval}}</option>
                        @endforeach
                      </select>
                    </div>
                    <div>
                      
                      </div>
                                       
                  </div>

</div>
</div>







    <div >
            <span class="step"></span>
            <span class="step active"></span>
            <span class="step"></span>
          </div>
            <div class="modallink mt20">
              <div class="signup-new-customer text-center">
                  <button type="button" class="stepbtn" href="#" onclick="$('#mayankstep1').show();$('#mayankstep2').hide();$('#mayankstep3').hide();" style="">PREVIOUS</button>
                  <button type="button" class="stepbtn" href="#" onclick="$('#mayankstep1').hide();$('#mayankstep2').hide();$('#mayankstepwhere').show();">NEXT</button>
              </div>
          </div>
</div>
<br>
<!--end mayankstep2-->

<div id="mayankstepwhere" style="display: none;">
  <div class="pop-title2 employe-title">
      <h3>Where and When</h3>
  </div>
  
  <div class="emplouyee-form">

      <div class="row">
          <div class="col-md-12">
              <h4 class="text-left">Where and When</h4>
              <label class="text-left">Class Meets</label>
              <select name="frm_class_meets" id="frm_class_meets1">
                  <option @if($service['class_meets'] == 'Weekly') selected @endif value="Weekly">Weekly</option>
                  <option @if($service['class_meets'] == 'On a specific day') selected @endif value="On a specific day">On a specific day</option>
              </select>
          </div>
          <div class="col-md-12">
            <div class="row">
                <div class="col-md-6">
                    <label class="text-left">Starting</label>
                    <div class="row">
                     <div class="col-md-12" id="startingpicker-position">
                     <input type="text" style="width:100%" class="frm_starting frm_starting1" name="starting" placeholder="Starting" id="startingpicker1" autocomplete="off">
                     </div>
                     </div>
                </div>
                <div class="col-md-6 schedule_until_box" @if($service['class_meets'] != 'Weekly') style="display:none;"  @endif>
                    <input type="hidden" id="end_date" value="{{$service['end_date']}}" />
                    <label class="text-left">Schedule Until</label>
                    <select name="frm_schedule_until" id="frm_schedule_until">
                        <option @if($service['schedule_until'] == '1 Month') selected @endif value="1 Month">1 Month</option>
                        <option @if($service['schedule_until'] == '3 Months') selected @endif value="3 Months">3 Months</option>
                        <option @if($service['schedule_until'] == '6 Months') selected @endif value="6 Months">6 Months</option>
                        <option @if($service['schedule_until'] == '9 Months') selected @endif value="9 Months">9 Months</option>
                        <option @if($service['schedule_until'] == '12 Months') selected @endif value="12 Months">12 Months</option>
                    </select>
                </div>
            </div>
          </div>
          <div class="col-md-12">
          <div class="day-time-div-main">
         @if($service['serv_time_slot'] != null)
        
         @foreach(json_decode($service['serv_time_slot']) as $key => $value)
         <?php //print_r($key);die; ?>
          <div class="day-time-div">
              @if($key != 0)
                <i class="fa fa-trash pull-right" onclick="$(this).parent().remove()"></i>
              @endif
                <div class="row">
                    <div class="day_circle col-sm-1  Sunday dys {{$value->sunday_start != '' ? 'day_circle_fill':''}}">
                        <p>Su</p>
                    </div>
                    <div class="day_circle col-sm-1  Monday dys {{$value->monday_start != '' ? 'day_circle_fill':''}}">
                        <p>Mo</p>
                    </div>
                    <div class="day_circle col-sm-1  Tuesday dys {{$value->tuesday_start != '' ? 'day_circle_fill':''}}">
                        <p>Tu</p>
                    </div>
                    <div class="day_circle col-sm-1  Wednesday dys {{$value->wednesday_start != '' ? 'day_circle_fill':''}}">
                        <p>We</p>
                    </div>
                    <div class="day_circle col-sm-1  Thrusday dys {{$value->thrusday_start != '' ? 'day_circle_fill':''}}">
                        <p>Th</p>
                    </div>
                    <div class="day_circle col-sm-1  Friday dys {{$value->friday_start != '' ? 'day_circle_fill':''}}">
                        <p>Fr</p>
                    </div>
                    <div class="day_circle col-sm-1  Saturday dys {{$value->saturday_start != '' ? 'day_circle_fill':''}}">
                        <p>Sa</p>
                    </div>
                </div>
              <div class="wrapperow">
                  <div class="form-control sunday_start" @if($value->sunday_start !='') style="margin-top:10px;" @else @if($value->sunday_start !='') style="margin-top:10px;" @else style="display:none;margin-top:10px;" @endif @endif>
                      <div class="row">
                      <label class="col-md-12">Sunday Time</label><br/>
                        <div class="col-md-5" >
                            @if($key == 0)
                            <input type="text"  class="sunquicktimepicker" name="hours[sunday_start]" value="{{$value->sunday_start}}"  autocomplete="off" style=" width:100%">
                            @else
                            <input type="text"  class="{{'sunquicktimepicker'.($key+1)}}" name="hours[sunday_start]" value="{{$value->sunday_start}}"  autocomplete="off" style=" width:100%">
                            @endif
                        </div>
                        <div class="col-sm-2"> &nbsp;-&nbsp;</div>
                        <div class="col-md-5" >   
                            <input type="text" class="timepicker" name="hours[sunday_end]" value="{{$value->sunday_end}}"  autocomplete="off" style=" width:100%">
                        </div>
                      </div>
                  </div>
                 
                  
                  <div class="form-control monday_start" @if($value->monday_start !='') style="margin-top:10px;" @else style="display:none;margin-top:10px;" @endif>
                     <div class="row">
                        <label class="col-md-12">Monday Time</label><br/>
                        <div class="col-md-5" >
                            @if($key == 0)
                            <input type="text"  class="monquicktimepicker" name="hours[monday_start]" value="{{$value->monday_start}}"  autocomplete="off" style=" width:100%">
                            @else
                            <input type="text"  class="{{'monquicktimepicker'.($key+1)}}" name="hours[monday_start]" value="{{$value->monday_start}}"  autocomplete="off" style=" width:100%">
                            @endif
                        </div>
                        <div class="col-sm-2"> &nbsp;-&nbsp;</div>
                        <div class="col-md-5" >   
                            <input type="text" class="timepicker" name="hours[monday_end]" value="{{$value->monday_end}}" autocomplete="off" style=" width:100%">
                        </div>
                      </div>
                  </div>
              
              <div class="form-control tuesday_start" @if($value->tuesday_start !='') style="margin-top:10px;" @else style="display:none;margin-top:10px;" @endif>
                  <div class="row">
                    <label class="col-md-12">Tuesday Time</label><br/>
                    <div class="col-md-5" >
                         @if($key == 0)
                            <input type="text"  class="tuesquicktimepicker" name="hours[tuesday_start]" value="{{$value->tuesday_start}}"  autocomplete="off" style=" width:100%">
                         @else
                            <input type="text"  class="{{'tuesquicktimepicker'.($key+1)}}" name="hours[tuesday_start]" value="{{$value->tuesday_start}}"  autocomplete="off" style=" width:100%">
                         @endif
                    </div>
                    <div class="col-sm-2"> &nbsp;-&nbsp;</div>
                    <div class="col-md-5" >   
                        <input type="text" class="timepicker" name="hours[tuesday_end]" value="{{$value->tuesday_end}}" autocomplete="off" style=" width:100%">
                    </div>
                  </div>
              </div>
              
              <div class="form-control wednesday_start" @if($value->wednesday_start !='') style="margin-top:10px;" @else style="display:none;margin-top:10px;" @endif>
                 <div class="row">
                    <label class="col-md-12">Wednesday Time</label><br/>
                    <div class="col-md-5" >
                        @if($key == 0)
                            <input type="text"  class="wedquicktimepicker" name="hours[wednesday_start]" value="{{$value->wednesday_start}}"  autocomplete="off" style=" width:100%">
                         @else
                            <input type="text"  class="{{'wedquicktimepicker'.($key+1)}}" name="hours[wednesday_start]" value="{{$value->wednesday_start}}"  autocomplete="off" style=" width:100%">
                         @endif
                    </div>
                    <div class="col-sm-2"> &nbsp;-&nbsp;</div>
                    <div class="col-md-5" >   
                        <input type="text" class="timepicker" name="hours[wednesday_end]" value="{{$value->wednesday_end}}" autocomplete="off" style=" width:100%">
                    </div>
                  </div>
              </div>
              
              <div class="form-control thrusday_start" @if($value->thrusday_start !='') style="margin-top:10px;" @else style="display:none;margin-top:10px;" @endif>
                  <div class="row">
                    <label class="col-md-12">Thursday Time</label><br/>
                    <div class="col-md-5" >
                        @if($key == 0)
                            <input type="text"  class="thrusquicktimepicker" name="hours[thrusday_start]" value="{{$value->thrusday_start}}"  autocomplete="off" style=" width:100%">
                         @else
                            <input type="text"  class="{{'thrusquicktimepicker'.($key+1)}}" name="hours[thrusday_start]" value="{{$value->thrusday_start}}"  autocomplete="off" style=" width:100%">
                         @endif
                    </div>
                    <div class="col-sm-2"> &nbsp;-&nbsp;</div>
                    <div class="col-md-5" >   
                        <input type="text" class="timepicker" name="hours[thrusday_end]" value="{{$value->thrusday_end}}"  autocomplete="off" style=" width:100%">
                    </div>
                  </div>
              </div>
              
              <div class="form-control friday_start" @if($value->friday_start !='') style="margin-top:10px;" @else style="display:none;margin-top:10px;" @endif>
                 <div class="row">
                    <label class="col-md-12">Friday Time</label><br/>
                    <div class="col-md-5" >
                        @if($key == 0)
                            <input type="text"  class="friquicktimepicker" name="hours[friday_start]" value="{{$value->friday_start}}"  autocomplete="off" style=" width:100%">
                         @else
                            <input type="text"  class="{{'friquicktimepicker'.($key+1)}}" name="hours[friday_start]" value="{{$value->friday_start}}"  autocomplete="off" style=" width:100%">
                         @endif
                    </div>
                    <div class="col-sm-2"> &nbsp;-&nbsp;</div>
                    <div class="col-md-5" >   
                        <input type="text" class="timepicker" name="hours[friday_end]" value="{{$value->friday_end}}" autocomplete="off" style=" width:100%">
                    </div>
                  </div>
              </div>
              
              <div class="form-control saturday_start" @if($value->saturday_start !='') style="margin-top:10px;" @else style="display:none;margin-top:10px;" @endif>
                 <div class="row">
                    <label class="col-md-12">Saturday Time</label><br/>
                    <div class="col-md-5" >
                        @if($key == 0)
                            <input type="text"  class="satquicktimepicker" name="hours[saturday_start]" value="{{$value->saturday_start}}"  autocomplete="off" style=" width:100%">
                         @else
                            <input type="text"  class="{{'satquicktimepicker'.($key+1)}}" name="hours[saturday_start]" value="{{$value->saturday_start}}"  autocomplete="off" style=" width:100%">
                         @endif
                    </div>
                    <div class="col-sm-2"> &nbsp;-&nbsp;</div>
                    <div class="col-md-5" >   
                        <input type="text" class="timepicker" name="hours[saturday_end]" value="{{$value->saturday_end}}"  autocomplete="off" style=" width:100%">
                    </div>
                  </div>
              </div>
        
          </div>
          </div>
          @endforeach
          @else
            <div class="day-time-div mymy" style="display:none;">
          <div class="row">
              <div class="col-sm-1 day_circle Sunday dys">
                  <p>Su</p>
              </div>
              <div class="col-sm-1 day_circle Monday dys">
                  <p>Mo</p>
              </div>
              <div class="col-sm-1 day_circle Tuesday dys">
                  <p>Tu</p>
              </div>
              <div class="col-sm-1 day_circle Wednesday dys">
                  <p>We</p>
              </div>
              <div class="col-sm-1 day_circle Thrusday dys">
                  <p>Th</p>
              </div>
              <div class="col-sm-1 day_circle Friday dys">
                  <p>Fr</p>
              </div>
              <div class="col-sm-1 day_circle Saturday dys">
                  <p>Sa</p>
              </div>
          </div>
          <div class="wrapperow">
              <div class="form-control sunday_start" style="display:none;margin-top:10px;">
                  <div class="row">
                  <label class="col-md-12">Sunday Time</label><br/>
                    <div class="col-md-5" >
                        <input type="text"  class="sunquicktimepicker" name="hours[sunday_start]" value="{{$hours['sunday_start']}}" autocomplete="off" style=" width:100%">
                    </div>
                    <div class="col-sm-1"> &nbsp;-&nbsp;</div>
                    <div class="col-md-5" >   
                        <input type="text" class="timepicker" name="hours[sunday_end]" value="{{$hours['sunday_end']}}" autocomplete="off" style=" width:100%">
                    </div>
                  </div>
              </div>
              
              <div class="form-control monday_start" style="display:none;margin-top:10px;">
                 <div class="row">
                    <label class="col-md-12">Monday Time</label><br/>
                    <div class="col-md-5" >
                        <input type="text"  class="monquicktimepicker" name="hours[monday_start]" value="{{$hours['monday_start']}}" autocomplete="off" style=" width:100%">
                    </div>
                    <div class="col-sm-1"> &nbsp;-&nbsp;</div>
                    <div class="col-md-5" >   
                        <input type="text" class="timepicker" name="hours[monday_end]" value="{{$hours['monday_end']}}" autocomplete="off" style=" width:100%">
                    </div>
                  </div>
              </div>
              
              <div class="form-control tuesday_start" style="display:none;margin-top:10px;">
                  <div class="row">
                    <label class="col-md-12">Tuesday Time</label><br/>
                    <div class="col-md-5" >
                        <input type="text"  class="tuesquicktimepicker" name="hours[tuesday_start]" value="{{$hours['tuesday_start']}}" autocomplete="off" style=" width:100%">
                    </div>
                    <div class="col-sm-1"> &nbsp;-&nbsp;</div>
                    <div class="col-md-5" >   
                        <input type="text" class="timepicker" name="hours[tuesday_end]" value="{{$hours['tuesday_end']}}" autocomplete="off" style=" width:100%">
                    </div>
                  </div>
              </div>
              
              <div class="form-control wednesday_start" style="display:none;margin-top:10px;">
                 <div class="row">
                    <label class="col-md-12">Wednesday Time</label><br/>
                    <div class="col-md-5" >
                        <input type="text"  class="wedquicktimepicker" name="hours[wednesday_start]" value="{{$hours['wednesday_start']}}" autocomplete="off" style=" width:100%">
                    </div>
                    <div class="col-sm-1"> &nbsp;-&nbsp;</div>
                    <div class="col-md-5" >   
                        <input type="text" class="timepicker" name="hours[wednesday_end]" value="{{$hours['wednesday_end']}}" autocomplete="off" style=" width:100%">
                    </div>
                  </div>
              </div>
              
              <div class="form-control thrusday_start" style="display:none;margin-top:10px;">
                  <div class="row">
                    <label class="col-md-12">Thursday Time</label><br/>
                    <div class="col-md-5" >
                        <input type="text"  class="thrusquicktimepicker" name="hours[thrusday_start]" value="{{$hours['thrusday_start']}}" autocomplete="off" style=" width:100%">
                    </div>
                    <div class="col-sm-1"> &nbsp;-&nbsp;</div>
                    <div class="col-md-5" >   
                        <input type="text" class="timepicker" name="hours[thrusday_end]" value="{{$hours['thrusday_end']}}" autocomplete="off" style=" width:100%">
                    </div>
                  </div>
              </div>
              
              <div class="form-control friday_start" style="display:none;margin-top:10px;">
                 <div class="row">
                    <label class="col-md-12">Friday Time</label><br/>
                    <div class="col-md-5" >
                        <input type="text"  class="friquicktimepicker" name="hours[friday_start]" value="{{$hours['friday_start']}}" autocomplete="off" style=" width:100%">
                    </div>
                    <div class="col-sm-1"> &nbsp;-&nbsp;</div>
                    <div class="col-md-5" >   
                        <input type="text" class="timepicker" name="hours[friday_end]" value="{{$hours['friday_end']}}" autocomplete="off" style=" width:100%">
                    </div>
                  </div>
              </div>
              
              <div class="form-control saturday_start" style="display:none;margin-top:10px;">
                 <div class="row">
                    <label class="col-md-12">Saturday Time</label><br/>
                    <div class="col-md-5" >
                        <input type="text"  class="satquicktimepicker" name="hours[saturday_start]" value="{{$hours['saturday_start']}}" autocomplete="off" style=" width:100%">
                    </div>
                    <div class="col-sm-1"> &nbsp;-&nbsp;</div>
                    <div class="col-md-5" >   
                        <input type="text" class="timepicker" name="hours[saturday_end]" value="{{$hours['saturday_end']}}" autocomplete="off" style=" width:100%">
                    </div>
                  </div>
              </div>
        
          </div>
          </div>
          @endif
          </div>
          </div>
          <!--<button class="btn btn-primary add-another-time">Add another time</button>-->
          <a class="btn btn-primary add-another-time">Add another time</a>
          <div class="modallink mt20">
              <div class="signup-new-customer text-center">
                  <button type="button" class="stepbtn" href="#" onclick="$('#mayankstep2').show();$('#mayankstep1').hide();$('#mayankstepwhere').hide();" style="">PREVIOUS</button>
                  <button type="button" id="stepbtnwhen" class="stepbtn">NEXT</button>
              </div>
          </div>
      </div>
      </div>
      
</div>

<!--start mayankstep3-->
<div id="mayankstep3" style="display: none;">
	<div class="pop-title3 employe-title">
		<h3>Setup your payments</h3>
	</div>
	<div class="multiples">
                    <h3>Set Up Your Pricing </h3>
                     
                    <label>Is this an special offer or a promotion</label>
                    <br>
                      <label class="setupprice">
                            <input type="radio" value="1" class="chkdy offpro" name="setupprice" autocomplete="off" @if($service['setupprice'] == 1) checked @endif>
                            <span class="promo">Yes</span>
                      </label>
                      <label class="setupprice">
                          <input type="radio" value="0" class="chkdy offpro" name="setupprice" autocomplete="off" @if($service['setupprice'] == 0) checked @endif>
                          <span class="promo">No</span>
                      </label>
                    </div>
                    <div class="multiples step2multiples" id="offprom_option" @if($service['setupprice'] == 0) style="display: none;" @endif >
                      
                      <select name="frm_specialdeals[]" id="frm_specialdeals" multiple>
                      @foreach ($specialDeals as $pfkey => $pfval)specialdeals
                                                <?php $pfkey = str_replace(' ','_',strtolower($pfkey)); 
                          $servicepriceoption =json_decode($service['specialdeals'],true);
                          ?>
                        <option value='{{$pfkey}}' @if(@in_array($pfkey,$servicepriceoption)) selected @endif> {{$pfval}}</option>
                      @endforeach
                      </select>
                    </div>
                    
                    <div class="multiples step2multiples">
                    <label>Service Price Options</label>
                      <select name="frm_servicepriceoption[]" id="frm_servicepriceoption" multiple>
                        @foreach ($servicePriceOption as $pfkey => $pfval)
                          <?php $pfkey = str_replace(' ','_',strtolower($pfkey)); 
                          $servicepriceoption =json_decode($service['servicepriceoption'],true);
                          ?>
                        <option value='{{$pfkey}}' @if(@in_array($pfkey,$servicepriceoption)) selected @endif> {{$pfval}}</option>
                        @endforeach
                      </select>
                    </div>
                    <br>

              <div class="row hrsam tax-wrapper">
                     <div class="col-md-3 col-sm-3"><h2 class="additionheading">Tax</h2></div>
                    <div class="col-md-9 col-sm-9">
                   
                      <div class="col-md-12 col-sm-12 col-xs-12 qh-steps-form samm">
                          <div class="form-control">
                            <div class="btn-group" data-toggle="buttons">
                              <label class="btn btn-primary percentageckeck  @if($service['salestax'] == 'salestax') active @endif">
                              <input type="checkbox"  value="salestax" class="" name="salestax" @if($service['salestax'] == 'salestax') checked @endif autocomplete="off">
                              <span class="glyphicon glyphicon-ok"></span> </label>
                              <span>Sales Tax</span><div class="tooltip"> ?
                              	<span class="tooltiptext">Lorem ipsum, or lipsum as it is sometimes known, is dummy text used in laying out print, graphic or web designs.</span>
                              </div>
                              <div id="salestaxpercentage" @if($service['salestax'] == '') style="display:none" @endif >
                          
                              <input type="text" value="{{$service['salestaxpercentage']}}" name="salestaxpercentage" maxlength="3" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" class="percentage">
                              %
                          
                             </div>
                            </div>
                          </div>
                      </div>
                      
                    <div class="col-md-12 col-sm-12 col-xs-12 qh-steps-form samm">
                    <div class="form-control">
                        <div class="btn-group" data-toggle="buttons">
                          <label class="btn btn-primary percentageckeck @if($service['duestax'] == 'duestax') active @endif">
                          <input type="checkbox" value="duestax" class="" name="duestax" @if($service['duestax'] == 'duestax') checked @endif>
                          <span class="glyphicon glyphicon-ok"></span> </label>
                          <span>Dues Tax</span><div class="tooltip"> ?
                              	<span class="tooltiptext">Lorem ipsum, or lipsum as it is sometimes known, is dummy text used in laying out print, graphic or web designs.</span>
                              </div>
                          <div id="duestaxpercentage" @if($service['duestax'] == '') style="display:none" @endif>
                          
                              <input type="text" value="{{$service['duestaxpercentage']}}" maxlength="3" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" name="duestaxpercentage" class="percentage">
                            %
                        
                      </div>
                      </div>
                      </div>
                      
                    </div>
                    </div>
                    </div>
                  <div class="row hrsam expire-wrapper">
                    <div class="col-md-3">
                        <h2 class="additionheading">Expires</h2>
                    </div>
                    <div class="col-md-9">
                    <div id="setnumbermsg" style="display:none"></div>
                      <div class="col-md-2 col-sm-2 pd-0">
                        <label>Set Number</label>
                        <input type="text" class="form-control setnumber" maxlength="3" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" name="expire_days" value="{{$service['expire_days']}}">
                      </div>
                      <div class="col-md-3 col-sm-3 pd-0">
                      <label>Duration</label>
                            <select name="expire_in_option" class="form-control" >
                                {{--<option @if($service['expire_in_option'] == 'Minute') selected @endif value="Minute">Minute</option>
                                <option @if($service['expire_in_option'] == 'Hour') selected @endif value="Hour">Hour</option>
                                <option @if($service['expire_in_option'] == 'Day') selected @endif value="Day">Day</option>--}}
                                <option @if($service['expire_in_option'] == 'Weeks') selected @endif value="Weeks">Weeks</option>
                                <option @if($service['expire_in_option'] == 'Months') selected @endif value="Months">Months(s)</option>
                                <option @if($service['expire_in_option'] == 'Year') selected @endif value="Year">Year</option>
                            </select>
                      </div>
                      <div class="col-sm-1">
                          <label>&nbsp;</label>
                      <span>after</span>
                      </div>
                      <div class="col-sm-6">
                          <label>&nbsp;</label>
                          <select name="after_drop" class="form-control" >
                                <option @if($service['after_drop'] && ($service['after_drop'] == 'The sales dates')) selected @endif value="The sales dates">The sales dates</option>
                                <option @if($service['after_drop'] && ($service['after_drop'] == 'The date of client first visit')) selected @endif value="The date of client first visit">The date of client's first visit</option>
                            </select>
                      </div>
                    </div>
                  </div>
                  <div class="row hrsam m-1 session-wrpper">
                    <div class="col-md-3">
                        <h2 class="additionheading">Number of Sessions</h2>
                    </div> <!-- col-md-3 -->
                    <div class="col-md-9">
                        <div class="col-md-12 qh-steps-form samm">
                          <div class="form-control">
                            <div class="btn-group" data-toggle="buttons">
                              <label class="btn btn-primary multises @if($service['sessions'] == 'single') active @endif">
                              <input type="radio" value="single" class="chkdy" name="sessions" autocomplete="off" @if($service['sessions'] == 'single') checked @endif>
                              <span class="glyphicon glyphicon-ok"></span> </label>
                              Single Session
                            </div>
                          </div>
                        </div>
                        <div class="col-md-6 qh-steps-form samm">
                          <div class="form-control">
                            <div class="btn-group" data-toggle="buttons">
                              <label class="btn btn-primary multises @if($service['sessions'] == 'multiple') active @endif">
                              <input type="radio" value="multiple" class="chkdy" @if($service['sessions'] == 'multiple') checked @endif name="sessions" autocomplete="off" >
                              <span class="glyphicon glyphicon-ok"></span> </label>
                              Multiple Sessions
                              <div id="multisession" style="text-align: initial; @if($service['sessions'] != 'multiple') display:none @endif">
                        <input type="text" name="multiple_count" value="{{$service['multiple_count']}}" class="msesinput"> &nbsp; <span style="margin-top: 10px;margin-left: 5px;font-size: 14px;color: #505050;">Sessions</span> 
                        </div>
                            </div>
                          </div>
                        </div>
                        
                        <div class="col-md-12 qh-steps-form samm">
                          <div class="form-control">
                            <div class="btn-group" data-toggle="buttons">
                              <label class="btn btn-primary multises @if($service['sessions'] == 'unlimited') active @endif">
                              <input type="radio" value="99999" class="chkdy" name="sessions" autocomplete="off" @if($service['sessions'] == 'unlimited') checked @endif>
                              <span class="glyphicon glyphicon-ok"></span> </label>
                              Unlimited Sessions
                            </div>
                          </div>
                        </div>
                    </div><!--col-md-9 -->
                  </div> <!-- row end -->

                  <div class="row hrsam">
                    <h3 class="setterms">Autopay Contract</h3>
                    <div class="col-md-3">

                      <h2 class="additionheading">Is this an recurring payment?</h2>
                    </div>
                    <div class="col-md-9">
                        <div class="col-md-12 qh-steps-form samm">
                          <div class="form-control">
                            <div class="btn-group" data-toggle="buttons">
                              <label class="btn btn-primary recurring_pay @if($service['recurring_pay'] == 1) active @endif">
                              <input type="radio" value="1" class="chkdy" @if($service['recurring_pay'] == 1) checked @endif name="recurring_pay" autocomplete="off">
                              <span class="glyphicon glyphicon-ok"></span> </label>
                              Yes
                            </div>
                          </div>
                        </div>
                        <div class="col-md-12 qh-steps-form samm">
                          <div class="form-control">
                            <div class="btn-group" data-toggle="buttons">
                              <label class="btn btn-primary recurring_pay @if($service['recurring_pay'] == 0) active @endif">
                              <input type="radio" value="0" class="chkdy" @if($service['recurring_pay'] == 0) checked @endif name="recurring_pay" autocomplete="off" >
                              <span class="glyphicon glyphicon-ok"></span> </label>
                              No
                            </div>
                          </div>
                        </div>
                      </div>
                  </div>
                <div @if($service['recurring_pay'] == 0) style="display:none" @endif id="recurring_pay">  
                  <div class="row hrsam">
                    <div class="col-md-3">
                      <h2 class="additionheading" style="color: #000;">Is this an Intro offer? (limit of 1 per client)</h2>
                    </div>
                    <div class="col-md-9">
                        <div class="col-md-12 qh-steps-form samm">
                          <div class="form-control">
                            <div class="btn-group" data-toggle="buttons">
                              <label class="btn btn-primary @if($service['introoffer'] == 0) active @endif">
                              <input type="radio" value="0" class="chkdy" name="introoffer" autocomplete="off" @if($service['introoffer'] == 0) checked  @endif>
                              <span class="glyphicon glyphicon-ok"></span> </label>
                              no
                            </div>
                          </div>
                        </div>
                        <div class="col-md-12 qh-steps-form samm">
                          <div class="form-control">
                            <div class="btn-group" data-toggle="buttons">
                              <label class="btn btn-primary @if($service['introoffer'] == 1) active @endif">
                              <input type="radio" value="1" class="chkdy" name="introoffer" autocomplete="off" @if($service['introoffer'] == 1) checked @endif >
                              <span class="glyphicon glyphicon-ok"></span> </label>
                              Yes, for new clinets only
                            </div>
                          </div>
                        </div>
                        <div class="col-md-12 qh-steps-form samm">
                          <div class="form-control">
                            <div class="btn-group" data-toggle="buttons">
                              <label class="btn btn-primary @if($service['introoffer'] == 2) active @endif">
                              <input type="radio" value="2" class="chkdy" name="introoffer" autocomplete="off" @if($service['introoffer'] ==2) checked @endif >
                              <span class="glyphicon glyphicon-ok"></span> </label>
                              Yes, for new and existing clinets
                            </div>
                          </div>
                        </div>
                    </div>
                  </div>
                  <div class="row hrsam" >
                    <div class="col-md-3">
                      <h2 class="additionheading" style="color: #000;">Run autopay</h2>
                    </div>
                    <div class="col-md-9">
                        <div class="col-md-12 qh-steps-form samm">
                          <div class="form-control">
                            <div class="btn-group" data-toggle="buttons">
                              <label class="btn btn-primary @if($service['runautopay'] == 'on_a_set_schedule') active @endif">
                              <input type="radio" value="on_a_set_schedule" class="chkdy" name="runautopay" autocomplete="off"@if($service['runautopay'] == 'on_a_set_schedule') checked @endif >
                              <span class="glyphicon glyphicon-ok"></span> </label>
                              On a set Schedule (recommended)
                            </div>
                          </div>
                        </div>
                        <div class="col-md-12 qh-steps-form samm">
                          <div class="form-control">
                            <div class="btn-group" data-toggle="buttons">
                              <label class="btn btn-primary @if($service['runautopay'] == 'when_the_priceing') active @endif">
                              <input type="radio" value="when_the_priceing" class="chkdy" name="runautopay" autocomplete="off"@if($service['runautopay'] == 'when_the_priceing') checked @endif >
                              <span class="glyphicon glyphicon-ok"></span> </label>
                              When the Pricing option run out
                            </div>
                          </div>
                        </div>
                    </div>
                  </div>

<!-- autopay-->
              <div class="row hrsam" >
                    <div class="col-md-3">
                      <h2 class="additionheading" style="color: #000;">how often will clients be charged?</h2>
                    </div>
                     <div class="col-md-9">
                        <div class="col-md-12 qh-steps-form samm">
                          <div class="form-control">
                            <div class="btn-group" data-toggle="buttons">
                              <label class="btn btn-primary myautopay @if($service['often'] == '0') active @endif">
                              <input type="radio" value="0" class="chkdy" name="often" @if($service['often'] == '0') checked @endif autocomplete="off">
                              <span class="glyphicon glyphicon-ok"></span> </label>
                              Set of number of autopay
                            </div>
                          </div>
                        </div>  
                          <div id="monthtomonth"  @if($service['often'] != '0') style="display:none" @endif>
                        <div class="col-md-3 often" style="width: auto;">
                          <p>Every</p>
                        </div>
                        <div class="col-md-3 often">
                          <select name="often_every_op1" class="form-control" id="select_box_number">
                             <option  @if($service['often_every_op1'] == 1) selected @endif value="1">1</option>
                             <option  @if($service['often_every_op1'] == 2) selected @endif value="2">2</option>
                             <option  @if($service['often_every_op1'] == 3) selected @endif value="3">3</option>
                             <option  @if($service['often_every_op1'] == 4) selected @endif value="4">4</option>
                             <option  @if($service['often_every_op1'] == 5) selected @endif value="5">5</option>
                             <option  @if($service['often_every_op1'] == 6) selected @endif value="6">6</option>
                             <option  @if($service['often_every_op1'] == 7) selected @endif value="7">7</option>
                             <option  @if($service['often_every_op1'] == 8) selected @endif value="8">8</option>
                             <option  @if($service['often_every_op1'] == 9) selected @endif value="9">9</option>
                             <option  @if($service['often_every_op1'] == 10) selected @endif value="10">10</option>
                             <option  @if($service['often_every_op1'] == 11) selected @endif value="11">11</option>
                             <option  @if($service['often_every_op1'] == 12) selected @endif value="12">12</option>
                             <option  @if($service['often_every_op1'] == 13) selected @endif value="13">13</option>
                             <option  @if($service['often_every_op1'] == 14) selected @endif value="14">14</option>
                             <option  @if($service['often_every_op1'] == 15) selected @endif value="15">15</option>
                             <option  @if($service['often_every_op1'] == 16) selected @endif value="16">16</option>
                             <option  @if($service['often_every_op1'] == 17) selected @endif value="17">17</option>
                             <option  @if($service['often_every_op1'] == 18) selected @endif value="18">18</option>
                             <option  @if($service['often_every_op1'] == 19) selected @endif value="19">19</option>
                             <option  @if($service['often_every_op1'] == 20) selected @endif value="20">20</option>
                             <option  @if($service['often_every_op1'] == 21) selected @endif value="21">21</option>
                             <option  @if($service['often_every_op1'] == 22) selected @endif value="22">22</option>
                             <option  @if($service['often_every_op1'] == 23) selected @endif value="23">23</option>
                             <option  @if($service['often_every_op1'] == 24) selected @endif value="24">24</option>
                             <option  @if($service['often_every_op1'] == 25) selected @endif value="25">25</option>
                             <option  @if($service['often_every_op1'] == 26) selected @endif value="26">26</option>
                             <option  @if($service['often_every_op1'] == 27) selected @endif value="27">27</option>
                             <option  @if($service['often_every_op1'] == 28) selected @endif value="28">28</option>
                             <option  @if($service['often_every_op1'] == 29) selected @endif value="29">29</option>
                             <option  @if($service['often_every_op1'] == 30) selected @endif value="30">30</option>
                             <option  @if($service['often_every_op1'] == 31) selected @endif value="31">31</option>
                             <option  @if($service['often_every_op1'] == 32) selected @endif value="32">32</option>
                             <option  @if($service['often_every_op1'] == 33) selected @endif value="33">33</option>
                             <option  @if($service['often_every_op1'] == 34) selected @endif value="34">34</option>
                             <option  @if($service['often_every_op1'] == 35) selected @endif value="35">35</option>
                             <option  @if($service['often_every_op1'] == 36) selected @endif value="36">36</option>
                             
                             </select>
                        </div>
                        <div class="col-md-3 often">
                             <select name="often_every_op2" class="form-control" id="select_box_month">
                                 <option  @if($service['often_every_op2'] == 'Week') selected @endif value="Week">Week</option>
                                  <option  @if($service['often_every_op2'] == 'Months') selected @endif value="Months">Month(s)</option>
                                  
                                  <option  @if($service['often_every_op2'] == 'Year') selected @endif value="Year">Year</option>
                             </select>
                        </div>
                        </div>
                        <br />
                        <div class="col-md-12 row">
                     <div id="myautopaynum" style="@if($service['often'] != '0') display:none; @endif width: auto; padding: 0;">
                    <div class="col-md-4 often" style="width: auto; padding: 0;">
                        <span>Number of autopay</span>
                    </div>
                    <div class="col-md-8 often">
                      <input type="number" class="form-control" id="numberofpays" name="numberofpays" style="width: 80%;border:1px solid;" value="{{$service['numberofpays']}}">
                      <span>Total duration of contract : <span id="number_span">0</span> <span id="month_span">Week</span></span>
                    </div>
                    </div>
                    </div>
                    <div class="col-md-12 qh-steps-form samm">
                      <div class="form-control">
                        <div class="btn-group" data-toggle="buttons">
                          <label class="btn btn-primary myautopay  @if($service['often'] == '1') active @endif">
                          <input type="radio" value="1" class="chkdy" name="often" autocomplete="off"  @if($service['often'] == '1') checked @endif>
                          <span class="glyphicon glyphicon-ok"></span> </label>
                          Month to month
                        </div>
                      </div>
                    </div>
                  
                      </div>    
              </div>
<!-- autopay end-->

                  <div class="row hrsam">
                    <div class="col-md-3">
                    <h2 class="additionheading" style="color: #000;">when will clients be charged?</h2>
                    </div>
                    <div class="col-md-6">
                    <?php
                    $op = array("on the sale date"=>"on the sale date",
"1st of the month"=>"1st of the month",
"15th of the month"=>"15th of the month",
"Last day of the month"=>"Last day of the month",
"1st of 15th of the month"=>"1st of 15th of the month",
"1st of 16th of the month"=>"1st of 16th of the month",
"15th of last day of the month"=>"15th of last day of the month",
"Specific date"=>"Specific date");
                    ?>
                     <select name="chargeclients" class="form-control">
                            @foreach ($op as $key=>$val)
                                <?php $key = str_replace(' ','_',strtolower($key)); 
                                
                                ?>
                                <option value="{{$key}}" @if($service['chargeclients'] == $key) selected @endif>{{$val}}</option>
                            @endforeach
                             </select>
                    </div>
                  </div>


                  </div> <!-- hide and show-->
                  <div class="row hrsam term-wrpp">
                  <h3 class="setterms">Set Your Terms</h3>
                  <p style="text-align: initial;padding-left: 17px;">Select the section you require your clients to agree to upon completing registration.</p>
                    <div class="col-md-3">
                        <div class="col-md-12 qh-steps-form samm">
                          <div class="form-control">
                            <div class="btn-group" data-toggle="buttons">
                              <label class="btn btn-primary termcondfaq @if($service['termcondfaq'] == 1) active @endif">
                              <input type="checkbox" value="1" class="chkdy" name="termcondfaq" @if($service['termcondfaq'] == 1) checked @endif autocomplete="off" >
                              <span class="glyphicon glyphicon-ok"></span> </label>
                              Terms, Conditions, FAQ 
                            </div>
                          </div>
                        </div>
                    </div>
                    <div class="col-md-6 textsam" id="termfaq" @if($service['termcondfaq'] != 1) style="display:none" @endif>
                      <textarea type="number" class="form-control" id="termcondfaqtext" name="termcondfaqtext"> {{$service['terms_conditions']}}</textarea>
                    </div>
                    <p id="termcondfaqtexterror" style="display:none;" class="error"></p>
                  </div>
                  <div class="row hrsam term-wrpp">
                    <div class="col-md-3">
                        <div class="col-md-12 qh-steps-form samm">
                          <div class="form-control">
                            <div class="btn-group" data-toggle="buttons">
                              <label class="btn btn-primary contractterms @if($service['contractterms'] == 1) active @endif">
                              <input type="checkbox" value="1" class="chkdy" name="contractterms" @if($service['contractterms'] == 1) checked @endif autocomplete="off" >
                              <span class="glyphicon glyphicon-ok"></span> </label>
                              Contract Terms
                            </div>
                          </div>
                        </div>
                    </div>
                    <div class="col-md-6 textsam" id="contractterms" @if($service['contractterms'] != 1) style="display:none" @endif>
                      <textarea type="number" class="form-control" id="contracttermstext" name="contracttermstext"> {{$service['contracttermstext']}}</textarea>
                    </div>
                    <p id="contracttermstexterror" style="display:none;" class="error"></p>
                  </div>
                  <div class="row hrsam term-wrpp">
                    <div class="col-md-3">
                        <div class="col-md-12 qh-steps-form samm">
                          <div class="form-control">
                            <div class="btn-group" data-toggle="buttons">
                              <label class="btn btn-primary liability @if($service['liability'] == 1) active @endif">
                              <input type="checkbox" value="1" class="chkdy" name="liability" @if($service['liability'] == 1) checked @endif autocomplete="off" >
                              <span class="glyphicon glyphicon-ok"></span> </label>
                              Liability
                            </div>
                          </div>
                        </div>
                    </div>
                    <div class="col-md-6 textsam" id="liability" @if($service['liability'] != 1) style="display:none" @endif>
                      <textarea type="number" class="form-control" id="liabilitytext" name="liabilitytext"> {{$service['liabilitytext']}}</textarea>
                    </div>
                    <p id="liabilitytexterror" style="display:none;" class="error"></p>
                  </div>
                  
                  <div class="row hrsam term-wrpp">
                    <div class="col-md-3">
                        <div class="col-md-12 qh-steps-form samm">
                          <div class="form-control">
                            <div class="btn-group" data-toggle="buttons">
                              <label class="btn btn-primary covid @if($service['covid'] == 1) active @endif">
                              <input type="checkbox" value="1" class="chkdy" name="covid" @if($service['covid'] == 1) checked @endif autocomplete="off" >
                              <span class="glyphicon glyphicon-ok"></span> </label>
                              Covid – 19 Protocols
                            </div>
                          </div>
                        </div>
                    </div>
                    <div class="col-md-6 textsam" id="covid" @if($service['covid'] != 1) style="display:none" @endif>
                      <textarea type="number" class="form-control" id="covidtext" name="covidtext"> {{$service['covidtext']}}</textarea>
                    </div>
                    <p id="covidtexterror" style="display:none;" class="error"></p>
                  </div>
                    <div>
                      <span class="step"></span>
                      <span class="step"></span>
                      <span class="step active"></span>
                    </div>

                     <div class="modallink mt20">
                      <div class="signup-new-customer text-center">

                      	<button type="button" class="stepbtn" href="#" onclick="$('#mayankstep1').hide();$('#mayankstep2').hide();$('#mayankstepwhere').show();$('#mayankstep3').hide();">PREVIOUS</button>
                       <button type="submit" class="stepbtn" id="submit_service">SUBMIT</button>
                      </div>
                    </div>
	
</div>
<br>
<!--end mayankstep3-->



                </div>
              </div>
            </div>
          </div>
        </form>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Zebra_datepicker/1.9.15/zebra_datepicker.min.js" integrity="sha512-1y4nEuCxuenP6LwNp1dhlU0KnQd65JW270y7b8duFMSwAxxc9+LWlcjOpEOposA95fSMt9bCUAn2jvoqAQPrvA==" crossorigin="anonymous"></script>
<script>
 var yesterdar = moment().format('MM-DD-YYYY')
    $('#startingpicker1').Zebra_DatePicker({
        default_position: 'below',
        format: 'm-d-Y',
        direction: [yesterdar, false],
        container : $('#startingpicker-position'),
        onSelect: function() { 
            $('.mymy').show()
             $('.day-time-div').slice(1).remove()
            var day = moment($(this).context.value,'MM-DD-YYYY').format('dddd')
            var new_date = moment($('#startingpicker1').val(),"MM-DD-YYYY").add($('#frm_schedule_until').val().split(' ')[0],'M').format('YYYY-MM-DD')
             console.log(new_date)
             $('#end_date').val(new_date)
                    $('.day-time-div').slice(1).remove()
                    $('input[name="hours[sunday_start]"]').val('')
                    $('input[name="hours[monday_start]"]').val('')
                    $('input[name="hours[tuesday_start]"]').val('')
                    $('input[name="hours[wednesday_start]"]').val('')
                    $('input[name="hours[thrusday_start]"]').val('')
                    $('input[name="hours[friday_start]"]').val('')
                    $('input[name="hours[saturday_start]"]').val('')
                    $('input[name="hours[sunday_end]"]').val('')
                    $('input[name="hours[tuesday_end]"]').val('')
                    $('input[name="hours[wednesday_end]"]').val('')
                    $('input[name="hours[thrusday_end]"]').val('')
                    $('input[name="hours[friday_end]"]').val('')
                    $('input[name="hours[saturday_end]"]').val('')
                    $('input[name="hours[monday_end]"]').val('')
                    $(".dys").removeClass('day_circle_fill')
                    $(".sunday_start").hide()
                    $(".tuesday_start").hide()
                    $(".wednesday_start").hide()
                    $(".thrusday_start").hide()
                    $(".friday_start").hide()
                    $(".monday_start").hide()
                    $(".saturday_start").hide()
            if($('#frm_class_meets1').val() != 'Weekly'){
                if(day == 'Monday'){
                    $(".Monday").show()
                    $(".Monday").addClass('day_circle_fill')
                    $(".monday_start").show()
                    $(".Sunday").hide()
                    $(".Tuesday").hide()
                    $(".Wednesday").hide()
                    $(".Thrusday").hide()
                    $(".Friday").hide()
                    $(".Saturday").hide()
                }
                if(day == 'Tuesday'){
                    $(".Monday").hide()
                    $(".Sunday").hide()
                    $(".Tuesday").show()
                    $(".Tuesday").addClass('day_circle_fill')
                    $(".tuesday_start").show()
                    $(".Wednesday").hide()
                    $(".Thrusday").hide()
                    $(".Friday").hide()
                    $(".Saturday").hide()
                }
                if(day == 'Wednesday'){
                    $(".Monday").hide()
                    $(".Sunday").hide()
                    $(".Tuesday").hide()
                    $(".Wednesday").show()
                    $(".Wednesday").addClass('day_circle_fill')
                    $(".wednesday_start").show()
                    $(".Thrusday").hide()
                    $(".Friday").hide()
                    $(".Saturday").hide()
                }
                if(day == 'Thursday'){
                    $(".Monday").hide()
                    $(".Sunday").hide()
                    $(".Tuesday").hide()
                    $(".Wednesday").hide()
                    $(".Thrusday").show()
                    $(".Thrusday").addClass('day_circle_fill')
                    $(".thrusday_start").show()
                    $(".Friday").hide()
                    $(".Saturday").hide()
                }
                if(day == 'Friday'){
                    $(".Monday").hide()
                    $(".Sunday").hide()
                    $(".Tuesday").hide()
                    $(".Wednesday").hide()
                    $(".Thrusday").hide()
                    $(".Friday").show()
                    $(".Friday").addClass('day_circle_fill')
                    $(".friday_start").show()
                    $(".Saturday").hide()
                }
                if(day == 'Saturday'){
                    $(".Monday").hide()
                    $(".Sunday").hide()
                    $(".Tuesday").hide()
                    $(".Wednesday").hide()
                    $(".Thrusday").hide()
                    $(".Friday").hide()
                    $(".Saturday").show()
                    $(".Saturday").addClass('day_circle_fill')
                    $(".saturday_start").show()
                }
                if(day == 'Sunday'){
                    $(".Monday").hide()
                    $(".Sunday").show()
                    $(".Sunday").addClass('day_circle_fill')
                    $(".sunday_start").show()
                    $(".Tuesday").hide()
                    $(".Wednesday").hide()
                    $(".Thrusday").hide()
                    $(".Friday").hide()
                    $(".Saturday").hide()
                }
            }
            else{
                $(".sunday_start").hide()
                $(".tuesday_start").hide()
                $(".wednesday_start").hide()
                $(".thrusday_start").hide()
                $(".friday_start").hide()
                $(".monday_start").hide()
                $(".saturday_start").hide()
                $(".Monday").show()
                $(".Sunday").show()
                $(".Tuesday").show()
                $(".Wednesday").show()
                $(".Thrusday").show()
                $(".Friday").show()
                $(".Saturday").show()
                
                if(day == 'Monday'){
                    $(".Monday").show()
                    $(".Monday").addClass('day_circle_fill')
                    $(".monday_start").show()
                }
                if(day == 'Tuesday'){
                    $(".Tuesday").show()
                    $(".Tuesday").addClass('day_circle_fill')
                    $(".tuesday_start").show()
                }
                if(day == 'Wednesday'){
                   $(".Wednesday").show()
                    $(".Wednesday").addClass('day_circle_fill')
                    $(".wednesday_start").show()
                }
                if(day == 'Thursday'){
                    $(".Thrusday").show()
                    $(".Thrusday").addClass('day_circle_fill')
                    $(".thrusday_start").show()
                }
                if(day == 'Friday'){
                    $(".Friday").show()
                    $(".Friday").addClass('day_circle_fill')
                    $(".friday_start").show()
                }
                if(day == 'Saturday'){
                    $(".Saturday").show()
                    $(".Saturday").addClass('day_circle_fill')
                    $(".saturday_start").show()
                }
                if(day == 'Sunday'){
                    $(".Sunday").show()
                    $(".Sunday").addClass('day_circle_fill')
                    $(".sunday_start").show()
                }
            }
          }
});
var first_timei = 0;
setTimeout(function(){
    console.log("ddd "+"{{$service['starting_date']}}")
    if("{{$service['starting_date']}}") 
    $(".frm_starting1").val(moment("{{$service['starting_date']}}",'YYYY-MM-DD').format('MM-DD-YYYY')).data('Zebra_DatePicker').show();
    $('#frm_class_meets1').change()
    first_timei = 0
},1000)

$('#frm_class_meets1').change(function(){
    console.log("first_timei "+first_timei)
    if(first_timei == 1){
        $('.day-time-div').slice(1).remove()
          $('input[name="hours[monday_start]"]').val('')
                    $('input[name="hours[tuesday_start]"]').val('')
                    $('input[name="hours[wednesday_start]"]').val('')
                    $('input[name="hours[thrusday_start]"]').val('')
                    $('input[name="hours[friday_start]"]').val('')
                    $('input[name="hours[saturday_start]"]').val('')
                    $('input[name="hours[sunday_end]"]').val('')
                    $('input[name="hours[tuesday_end]"]').val('')
                    $('input[name="hours[wednesday_end]"]').val('')
                    $('input[name="hours[thrusday_end]"]').val('')
                    $('input[name="hours[friday_end]"]').val('')
                    $('input[name="hours[saturday_end]"]').val('')
                    $('input[name="hours[monday_end]"]').val('')
                    $(".dys").removeClass('day_circle_fill')
                    $(".sunday_start").hide()
                    $(".tuesday_start").hide()
                    $(".wednesday_start").hide()
                    $(".thrusday_start").hide()
                    $(".friday_start").hide()
                    $(".monday_start").hide()
                    $(".saturday_start").hide()
    
    if($("#frm_class_meets1").val() == 'Weekly'){
        $(".schedule_until_box").show()
        if($("#startingpicker1").val() != ''){
            console.log("run11")
           $(".Sunday").removeClass("day_circle_fill")
            $(".Monday").removeClass("day_circle_fill")
            $(".Tuesday").removeClass("day_circle_fill")
            $(".Wednesday").removeClass("day_circle_fill")
            $(".Thrusday").removeClass("day_circle_fill")
            $(".Friday").removeClass("day_circle_fill")
            $(".Saturday").removeClass("day_circle_fill")
            $(".Monday").show()
            $(".Sunday").show()
            $(".Tuesday").show()
            $(".Wednesday").show()
            $(".Thrusday").show()
            $(".Friday").show()
            $(".Saturday").show()
            if($("#startingpicker1").val() != ''){
             var day = moment($("#startingpicker1").val(),'MM-DD-YYYY').format('dddd')
             if(day == 'Monday'){
                    $(".Monday").show()
                    $(".Monday").addClass('day_circle_fill')
                    $(".monday_start").show()
                }
                if(day == 'Tuesday'){
                    $(".Tuesday").show()
                    $(".Tuesday").addClass('day_circle_fill')
                    $(".tuesday_start").show()
                }
                if(day == 'Wednesday'){
                   $(".Wednesday").show()
                    $(".Wednesday").addClass('day_circle_fill')
                    $(".wednesday_start").show()
                }
                if(day == 'Thursday'){
                    $(".Thrusday").show()
                    $(".Thrusday").addClass('day_circle_fill')
                    $(".thrusday_start").show()
                }
                if(day == 'Friday'){
                    $(".Friday").show()
                    $(".Friday").addClass('day_circle_fill')
                    $(".friday_start").show()
                }
                if(day == 'Saturday'){
                    $(".Saturday").show()
                    $(".Saturday").addClass('day_circle_fill')
                    $(".saturday_start").show()
                }
                if(day == 'Sunday'){
                    $(".Sunday").show()
                    $(".Sunday").addClass('day_circle_fill')
                    $(".sunday_start").show()
                }
        }
        }
    }
    else{
        $(".schedule_until_box").hide()
         if($("#startingpicker1").val() != ''){
             var day = moment($("#startingpicker1").val(),'MM-DD-YYYY').format('dddd')
             myday = moment($("#startingpicker1").val(),'MM-DD-YYYY').format('dddd')
             $('input[name="hours[sunday_start]"]').val('')
                    $('input[name="hours[monday_start]"]').val('')
                    $('input[name="hours[tuesday_start]"]').val('')
                    $('input[name="hours[wednesday_start]"]').val('')
                    $('input[name="hours[thrusday_start]"]').val('')
                    $('input[name="hours[friday_start]"]').val('')
                    $('input[name="hours[saturday_start]"]').val('')
                    $('input[name="hours[sunday_end]"]').val('')
                    $('input[name="hours[tuesday_end]"]').val('')
                    $('input[name="hours[wednesday_end]"]').val('')
                    $('input[name="hours[thrusday_end]"]').val('')
                    $('input[name="hours[friday_end]"]').val('')
                    $('input[name="hours[saturday_end]"]').val('')
                    $('input[name="hours[monday_end]"]').val('')
                    $(".dys").removeClass('day_circle_fill')
                    $(".sunday_start").hide()
                    $(".tuesday_start").hide()
                    $(".wednesday_start").hide()
                    $(".thrusday_start").hide()
                    $(".friday_start").hide()
                    $(".monday_start").hide()
                    $(".saturday_start").hide()
            if(day == 'Monday'){
                $(".sunday_start").hide()
                    $(".tuesday_start").hide()
                    $(".wednesday_start").hide()
                    $(".thrusday_start").hide()
                    $(".friday_start").hide()
                    $(".saturday_start").hide()
                    $('input[name="hours[sunday_start]"]').val('')
                    $('input[name="hours[tuesday_start]"]').val('')
                    $('input[name="hours[wednesday_start]"]').val('')
                    $('input[name="hours[thrusday_start]"]').val('')
                    $('input[name="hours[friday_start]"]').val('')
                    $('input[name="hours[saturday_start]"]').val('')
                    $('input[name="hours[sunday_end]"]').val('')
                    $('input[name="hours[tuesday_end]"]').val('')
                    $('input[name="hours[wednesday_end]"]').val('')
                    $('input[name="hours[thrusday_end]"]').val('')
                    $('input[name="hours[friday_end]"]').val('')
                    $('input[name="hours[saturday_end]"]').val('')
                    $(".Monday").show()
                    $(".Monday").addClass('day_circle_fill');
                    $(".monday_start").show()
                    $(".Sunday").hide()
                    $(".Tuesday").hide()
                    $(".Wednesday").hide()
                    $(".Thrusday").hide()
                    $(".Friday").hide()
                    $(".Saturday").hide()
                }
                if(day == 'Tuesday'){
                    $(".sunday_start").hide()
                    $(".monday_start").hide()
                    $(".wednesday_start").hide()
                    $(".thrusday_start").hide()
                    $(".friday_start").hide()
                    $(".saturday_start").hide()
                     $('input[name="hours[sunday_start]"]').val('')
                    $('input[name="hours[monday_start]"]').val('')
                    $('input[name="hours[wednesday_start]"]').val('')
                    $('input[name="hours[thrusday_start]"]').val('')
                    $('input[name="hours[friday_start]"]').val('')
                    $('input[name="hours[saturday_start]"]').val('')
                    $('input[name="hours[sunday_end]"]').val('')
                    $('input[name="hours[monday_end]"]').val('')
                    $('input[name="hours[wednesday_end]"]').val('')
                    $('input[name="hours[thrusday_end]"]').val('')
                    $('input[name="hours[friday_end]"]').val('')
                    $('input[name="hours[saturday_end]"]').val('')
                    $(".Monday").hide()
                    $(".Sunday").hide()
                    $(".Tuesday").show()
                    $(".Tuesday").addClass('day_circle_fill');
                    $(".tuesday_start").show()
                    $(".Wednesday").hide()
                    $(".Thrusday").hide()
                    $(".Friday").hide()
                    $(".Saturday").hide()
                }
                if(day == 'Wednesday'){
                    $(".sunday_start").hide()
                    $(".tuesday_start").hide()
                    $(".monday_start").hide()
                    $(".thrusday_start").hide()
                    $(".friday_start").hide()
                    $(".saturday_start").hide()
                     $('input[name="hours[sunday_start]"]').val('')
                    $('input[name="hours[tuesday_start]"]').val('')
                    $('input[name="hours[monday_start]"]').val('')
                    $('input[name="hours[thrusday_start]"]').val('')
                    $('input[name="hours[friday_start]"]').val('')
                    $('input[name="hours[saturday_start]"]').val('')
                    $('input[name="hours[sunday_end]"]').val('')
                    $('input[name="hours[tuesday_end]"]').val('')
                    $('input[name="hours[monday_end]"]').val('')
                    $('input[name="hours[thrusday_end]"]').val('')
                    $('input[name="hours[friday_end]"]').val('')
                    $('input[name="hours[saturday_end]"]').val('')
                    $(".Monday").hide()
                    $(".Sunday").hide()
                    $(".Tuesday").hide()
                    $(".Wednesday").show()
                    $(".Wednesday").addClass('day_circle_fill');
                    $(".wednesday_start").show()
                    $(".Thrusday").hide()
                    $(".Friday").hide()
                    $(".Saturday").hide()
                }
                if(day == 'Thursday'){
                    $(".sunday_start").hide()
                    $(".tuesday_start").hide()
                    $(".wednesday_start").hide()
                    $(".monday_start").hide()
                    $(".friday_start").hide()
                    $(".saturday_start").hide()
                     $('input[name="hours[sunday_start]"]').val('')
                    $('input[name="hours[tuesday_start]"]').val('')
                    $('input[name="hours[wednesday_start]"]').val('')
                    $('input[name="hours[monday_start]"]').val('')
                    $('input[name="hours[friday_start]"]').val('')
                    $('input[name="hours[saturday_start]"]').val('')
                    $('input[name="hours[sunday_end]"]').val('')
                    $('input[name="hours[tuesday_end]"]').val('')
                    $('input[name="hours[wednesday_end]"]').val('')
                    $('input[name="hours[monday_end]"]').val('')
                    $('input[name="hours[friday_end]"]').val('')
                    $('input[name="hours[saturday_end]"]').val('')
                    $(".Monday").hide()
                    $(".Sunday").hide()
                    $(".Tuesday").hide()
                    $(".Wednesday").hide()
                    $(".Thrusday").show()
                    $(".Thrusday").addClass('day_circle_fill');
                    $(".thrusday_start").show()
                    $(".Friday").hide()
                    $(".Saturday").hide()
                }
                if(day == 'Friday'){
                    $(".sunday_start").hide()
                    $(".tuesday_start").hide()
                    $(".wednesday_start").hide()
                    $(".thrusday_start").hide()
                    $(".monday_start").hide()
                    $(".saturday_start").hide()
                     $('input[name="hours[sunday_start]"]').val('')
                    $('input[name="hours[tuesday_start]"]').val('')
                    $('input[name="hours[wednesday_start]"]').val('')
                    $('input[name="hours[thrusday_start]"]').val('')
                    $('input[name="hours[monday_start]"]').val('')
                    $('input[name="hours[saturday_start]"]').val('')
                    $('input[name="hours[sunday_end]"]').val('')
                    $('input[name="hours[tuesday_end]"]').val('')
                    $('input[name="hours[wednesday_end]"]').val('')
                    $('input[name="hours[thrusday_end]"]').val('')
                    $('input[name="hours[monday_end]"]').val('')
                    $('input[name="hours[saturday_end]"]').val('')
                    $(".Monday").hide()
                    $(".Sunday").hide()
                    $(".Tuesday").hide()
                    $(".Wednesday").hide()
                    $(".Thrusday").hide()
                    $(".Friday").show()
                    $(".Friday").addClass('day_circle_fill');
                    $(".friday_start").show()
                    $(".Saturday").hide()
                }
                if(day == 'Saturday'){
                    $(".sunday_start").hide()
                    $(".tuesday_start").hide()
                    $(".wednesday_start").hide()
                    $(".thrusday_start").hide()
                    $(".friday_start").hide()
                    $(".monday_start").hide()
                     $('input[name="hours[sunday_start]"]').val('')
                    $('input[name="hours[tuesday_start]"]').val('')
                    $('input[name="hours[wednesday_start]"]').val('')
                    $('input[name="hours[thrusday_start]"]').val('')
                    $('input[name="hours[friday_start]"]').val('')
                    $('input[name="hours[monday_start]"]').val('')
                    $('input[name="hours[sunday_end]"]').val('')
                    $('input[name="hours[tuesday_end]"]').val('')
                    $('input[name="hours[wednesday_end]"]').val('')
                    $('input[name="hours[thrusday_end]"]').val('')
                    $('input[name="hours[friday_end]"]').val('')
                    $('input[name="hours[monday_end]"]').val('')
                    $(".Monday").hide()
                    $(".Sunday").hide()
                    $(".Tuesday").hide()
                    $(".Wednesday").hide()
                    $(".Thrusday").hide()
                    $(".Friday").hide()
                    $(".Saturday").show()
                    $(".Saturday").addClass('day_circle_fill');
                    $(".saturday_start").show()
                }
                if(day == 'Sunday'){
                    
                    $(".monday_start").hide()
                    $(".tuesday_start").hide()
                    $(".wednesday_start").hide()
                    $(".thrusday_start").hide()
                    $(".friday_start").hide()
                    $(".saturday_start").hide()
                     $('input[name="hours[monday_start]"]').val('')
                    $('input[name="hours[tuesday_start]"]').val('')
                    $('input[name="hours[wednesday_start]"]').val('')
                    $('input[name="hours[thrusday_start]"]').val('')
                    $('input[name="hours[friday_start]"]').val('')
                    $('input[name="hours[saturday_start]"]').val('')
                    $('input[name="hours[monday_end]"]').val('')
                    $('input[name="hours[tuesday_end]"]').val('')
                    $('input[name="hours[wednesday_end]"]').val('')
                    $('input[name="hours[thrusday_end]"]').val('')
                    $('input[name="hours[friday_end]"]').val('')
                    $('input[name="hours[saturday_end]"]').val('')
                    $(".Monday").hide()
                    $(".Sunday").show()
                    $(".Sunday").addClass('day_circle_fill');
                    $(".sunday_start").show()
                    $(".Tuesday").hide()
                    $(".Wednesday").hide()
                    $(".Thrusday").hide()
                    $(".Friday").hide()
                    $(".Saturday").hide()
                }
         }
    }
    }
    else{
        first_timei = 1;
        if($("#frm_class_meets1").val() != 'Weekly'){
        var day = moment($("#startingpicker1").val(),'MM-DD-YYYY').format('dddd')
          if(day == 'Monday'){
                    $(".Monday").show()
                    $(".Sunday").hide()
                    $(".Tuesday").hide()
                    $(".Wednesday").hide()
                    $(".Thrusday").hide()
                    $(".Friday").hide()
                    $(".Saturday").hide()
                }
                if(day == 'Tuesday'){
                    $(".Monday").hide()
                    $(".Sunday").hide()
                    $(".Tuesday").show()
                    $(".Wednesday").hide()
                    $(".Thrusday").hide()
                    $(".Friday").hide()
                    $(".Saturday").hide()
                }
                if(day == 'Wednesday'){
                    $(".Monday").hide()
                    $(".Sunday").hide()
                    $(".Tuesday").hide()
                    $(".Wednesday").show()
                    $(".Thrusday").hide()
                    $(".Friday").hide()
                    $(".Saturday").hide()
                }
                if(day == 'Thursday'){
                    $(".Monday").hide()
                    $(".Sunday").hide()
                    $(".Tuesday").hide()
                    $(".Wednesday").hide()
                    $(".Thrusday").show()
                    $(".Friday").hide()
                    $(".Saturday").hide()
                }
                if(day == 'Friday'){
                    $(".Monday").hide()
                    $(".Sunday").hide()
                    $(".Tuesday").hide()
                    $(".Wednesday").hide()
                    $(".Thrusday").hide()
                    $(".Friday").show()
                    $(".Saturday").hide()
                }
                if(day == 'Saturday'){
                    $(".Monday").hide()
                    $(".Sunday").hide()
                    $(".Tuesday").hide()
                    $(".Wednesday").hide()
                    $(".Thrusday").hide()
                    $(".Friday").hide()
                    $(".Saturday").show()
                }
                if(day == 'Sunday'){
                    
                    $(".Monday").hide()
                    $(".Sunday").show()
                    $(".Tuesday").hide()
                    $(".Wednesday").hide()
                    $(".Thrusday").hide()
                    $(".Friday").hide()
                    $(".Saturday").hide()
                }
        }
    }
    first_timei = 1;
})
 $('.day-time-div-main .timepicker').timepicker({
            timeFormat: 'h:mm p',
            interval: 30, 
            startTime: '00:00',
            dynamic: true,
            dropdown: true,
            scrollbar: true,
            change: function(time){
                if($(this).parent().parent().children(':nth-child(3)').children().val()== ''){
                    $(this).val('')
                    showSystemMessages('#systemMessage1', 'danger', 'Cant\'t select TO time without selecting from time.');
                }
            }
        });
        var yesterdar = moment().format('YYYY-MM-DD')


      

$(".day-time-div-main").on('click','.dys',function(){
       if($(this).attr('class').includes("day_circle_fill")){
        $(this).removeClass("day_circle_fill")
        if($(this).attr('class').includes('Sunday')){
            $(this).parent().parent().children().children(".sunday_start").hide()
            $(this).parent().parent().children().children(".sunday_start").children().children().children($("input[name='hours[sunday_start]']")).val('')
            $(this).parent().parent().children().children(".sunday_start").children().children().children($("input[name='hours[sunday_end]']")).val('')
            
        }
        if($(this).attr('class').includes('Monday')){
            $(this).parent().parent().children().children(".monday_start").hide()
            $(this).parent().parent().children().children(".monday_start").children().children().children($("input[name='hours[monday_start]']")).val('')
            $(this).parent().parent().children().children(".monday_start").children().children().children($("input[name='hours[monday_end]']")).val('')
        }
        if($(this).attr('class').includes('Tuesday')){
            $(this).parent().parent().children().children(".tuesday_start").hide()
            $(this).parent().parent().children().children(".tuesday_start").children().children().children($("input[name='hours[tuesday_start]']")).val('')
            $(this).parent().parent().children().children(".tuesday_start").children().children().children($("input[name='hours[tuesday_end]']")).val('')
        }
        if($(this).attr('class').includes('Wednesday')){
            $(this).parent().parent().children().children(".wednesday_start").hide()
            $(this).parent().parent().children().children(".wednesday_start").children().children().children($("input[name='hours[wednesday_start]']")).val('')
            $(this).parent().parent().children().children(".wednesday_start").children().children().children($("input[name='hours[wednesday_end]']")).val('')
        }
        if($(this).attr('class').includes('Thrusday')){
            $(this).parent().parent().children().children(".thrusday_start").hide()
            $(this).parent().parent().children().children(".thrusday_start").children().children().children($("input[name='hours[thrusday_start]']")).val('')
            $(this).parent().parent().children().children(".thrusday_start").children().children().children($("input[name='hours[thrusday_end]']")).val('')
        }
        if($(this).attr('class').includes('Friday')){
            $(this).parent().parent().children().children(".friday_start").hide()
            $(this).parent().parent().children().children(".friday_start").children().children().children($("input[name='hours[friday_start]']")).val('')
            $(this).parent().parent().children().children(".friday_start").children().children().children($("input[name='hours[friday_end]']")).val('')
        }
        if($(this).attr('class').includes('Saturday')){
            $(this).parent().parent().children().children(".saturday_start").hide()
            $(this).parent().parent().children().children(".saturday_start").children().children().children($("input[name='hours[saturday_start]']")).val('')
            $(this).parent().parent().children().children(".saturday_start").children().children().children($("input[name='hours[saturday_end]']")).val('')
        }
    }
    else{
        $(this).addClass("day_circle_fill")
        if($(this).attr('class').includes('Sunday'))
            $(this).parent().parent().children().children(".sunday_start").show()
        if($(this).attr('class').includes('Monday'))
            $(this).parent().parent().children().children(".monday_start").show()
        if($(this).attr('class').includes('Tuesday'))
            $(this).parent().parent().children().children(".tuesday_start").show()
        if($(this).attr('class').includes('Wednesday'))
            $(this).parent().parent().children().children(".wednesday_start").show()
        if($(this).attr('class').includes('Thrusday'))
            $(this).parent().parent().children().children(".thrusday_start").show()
        if($(this).attr('class').includes('Friday'))
            $(this).parent().parent().children().children(".friday_start").show()
        if($(this).attr('class').includes('Saturday'))
            $(this).parent().parent().children().children(".saturday_start").show()
    }
    // $(this).addClass("day_circle_fill")
    //  if($(this).attr('class').includes('Sunday'))
    //         $(this).parent().parent().children().children(".sunday_start").show()
    //     if($(this).attr('class').includes('Monday'))
    //         $(this).parent().parent().children().children(".monday_start").show()
    //     if($(this).attr('class').includes('Tuesday'))
    //         $(this).parent().parent().children().children(".tuesday_start").show()
    //     if($(this).attr('class').includes('Wednesday'))
    //         $(this).parent().parent().children().children(".wednesday_start").show()
    //     if($(this).attr('class').includes('Thrusday'))
    //         $(this).parent().parent().children().children(".thrusday_start").show()
    //     if($(this).attr('class').includes('Friday'))
    //         $(this).parent().parent().children().children(".friday_start").show()
    //     if($(this).attr('class').includes('Saturday'))
    //         $(this).parent().parent().children().children(".saturday_start").show()
})

$('.day-time-div-main .sunquicktimepicker').timepicker({
            timeFormat: 'h:mm p',
            interval: 30, 
            startTime: '00:00',
            dynamic: true,
            dropdown: true,
            scrollbar: true,
            change: function(time){
                var sunday_start_arr = $('input[name="hours[sunday_start]"]').map(function () {
                    return this.value; // $(this).val()
                }).get();
                setTimeout(function(){
                    var j =sunday_start_arr.reverse();
                var k = j;
                var g = hasDuplicates(sunday_start_arr)
                     if(g == true){
                         showSystemMessages('#systemMessage1', 'danger', 'Cant\'t select same time on same day.');
                         $(".sunquicktimepicker").val('')
                     }
                },100)
            }
        });$('.day-time-div-main .tuesquicktimepicker').timepicker({
            timeFormat: 'h:mm p',
            interval: 30, 
            startTime: '00:00',
            dynamic: true,
            dropdown: true,
            scrollbar: true,
            change: function(time){
                var sunday_start_arr = $('input[name="hours[tuesday_start]"]').map(function () {
                    return this.value; // $(this).val()
                }).get();
                setTimeout(function(){
                    var j =sunday_start_arr.reverse();
                var k = j;
                var g = hasDuplicates(sunday_start_arr)
                     if(g == true){
                        showSystemMessages('#systemMessage1', 'danger', 'Cant\'t select same time on same day.');
                         $(".tuesquicktimepicker").val('')
                     }
                },100)
            }
        });$('.day-time-div-main .wedquicktimepicker').timepicker({
            timeFormat: 'h:mm p',
            interval: 30, 
            startTime: '00:00',
            dynamic: true,
            dropdown: true,
            scrollbar: true,
            change: function(time){
                var sunday_start_arr = $('input[name="hours[wednesday_start]"]').map(function () {
                    return this.value; // $(this).val()
                }).get();
                setTimeout(function(){
                    var j =sunday_start_arr.reverse();
                var k = j;
                var g = hasDuplicates(sunday_start_arr)
                     if(g == true){
                         showSystemMessages('#systemMessage1', 'danger', 'Cant\'t select same time on same day.');
                         $(".wedquicktimepicker").val('')
                     }
                },100)
            }
        });$('.day-time-div-main .thrusquicktimepicker').timepicker({
            timeFormat: 'h:mm p',
            interval: 30, 
            startTime: '00:00',
            dynamic: true,
            dropdown: true,
            scrollbar: true,
            change: function(time){
                var sunday_start_arr = $('input[name="hours[thrusday_start]"]').map(function () {
                    return this.value; // $(this).val()
                }).get();
                setTimeout(function(){
                    var j =sunday_start_arr.reverse();
                var k = j;
                var g = hasDuplicates(sunday_start_arr)
                     if(g == true){
                        showSystemMessages('#systemMessage1', 'danger', 'Cant\'t select same time on same day.');
                         $(".thrusquicktimepicker").val('')
                     }
                },100)
            }
        });$('.day-time-div-main .friquicktimepicker').timepicker({
            timeFormat: 'h:mm p',
            interval: 30, 
            startTime: '00:00',
            dynamic: true,
            dropdown: true,
            scrollbar: true,
            change: function(time){
                var sunday_start_arr = $('input[name="hours[friday_start]"]').map(function () {
                    return this.value; // $(this).val()
                }).get();
                setTimeout(function(){
                    var j =sunday_start_arr.reverse();
                var k = j;
                var g = hasDuplicates(sunday_start_arr)
                     if(g == true){
                         showSystemMessages('#systemMessage1', 'danger', 'Cant\'t select same time on same day.');
                         $(".friquicktimepicker").val('')
                     }
                },100)
            }
        });
        $('.day-time-div-main .satquicktimepicker').timepicker({
            timeFormat: 'h:mm p',
            interval: 30, 
            startTime: '00:00',
            dynamic: true,
            dropdown: true,
            scrollbar: true,
            change: function(time){
                var sunday_start_arr = $('input[name="hours[saturday_start]"]').map(function () {
                    return this.value; // $(this).val()
                }).get();
                setTimeout(function(){
                    var j =sunday_start_arr.reverse();
                var k = j;
                var g = hasDuplicates(sunday_start_arr)
                     if(g == true){
                        showSystemMessages('#systemMessage1', 'danger', 'Cant\'t select same time on same day.');
                         $(".satquicktimepicker").val('')
                     }
                },100)
            }
        });
        $('.day-time-div-main .monquicktimepicker').timepicker({
            timeFormat: 'h:mm p',
            interval: 30, 
            startTime: '00:00',
            dynamic: true,
            dropdown: true,
            scrollbar: true,
            change: function(time){
                var sunday_start_arr = $('input[name="hours[monday_start]"]').map(function () {
                    return this.value; // $(this).val()
                }).get();
                setTimeout(function(){
                    var j =sunday_start_arr.reverse();
                var k = j;
                var g = hasDuplicates(sunday_start_arr)
                     if(g == true){
                         showSystemMessages('#systemMessage1', 'danger', 'Cant\'t select same time on same day.');
                         $(".monquicktimepicker").val('')
                     }
                },100)
            }
        });
var arr1 = @json($service['serv_time_slot']);
var arr2 = JSON.parse(arr1)
console.log(arr2)
if(arr2 != null){
arr2.forEach(function(value,key){
    if(key!=0){
         $('.day-time-div-main .sunquicktimepicker'+(key+1)).timepicker({
            timeFormat: 'h:mm p',
            interval: 30, 
            startTime: '00:00',
            dynamic: true,
            dropdown: true,
            scrollbar: true,
            change: function(time){
                var sunday_start_arr = $('input[name="hours[sunday_start]"]').map(function () {
                    return this.value; // $(this).val()
                }).get();
                setTimeout(function(){
                    var j =sunday_start_arr.reverse();
                var k = j;
                var g = hasDuplicates(sunday_start_arr)
                    var g = hasDuplicates(k)
                    // console.log(g)
                     if(g == true){
                         showSystemMessages('#systemMessage1', 'danger', 'Cant\'t select same time on same day.');
                         $(".sunquicktimepicker"+(key+1)).val('')
                     }
                },100)
            }
        });$('.day-time-div-main .tuesquicktimepicker'+(key+1)).timepicker({
            timeFormat: 'h:mm p',
            interval: 30, 
            startTime: '00:00',
            dynamic: true,
            dropdown: true,
            scrollbar: true,
            change: function(time){
                var sunday_start_arr = $('input[name="hours[tuesday_start]"]').map(function () {
                    return this.value; // $(this).val()
                }).get();
                setTimeout(function(){
                    var j =sunday_start_arr.reverse();
                var k = j;
                    var g = hasDuplicates(k)
                    console.log(g)
                     if(g == true){
                         showSystemMessages('#systemMessage1', 'danger', 'Cant\'t select same time on same day.');
                         $(".tuesquicktimepicker"+(key+1)).val('')
                     }
                },100)
            }
        });$('.day-time-div-main .wedquicktimepicker'+(key+1)).timepicker({
            timeFormat: 'h:mm p',
            interval: 30, 
            startTime: '00:00',
            dynamic: true,
            dropdown: true,
            scrollbar: true,
            change: function(time){
                var sunday_start_arr = $('input[name="hours[wednesday_start]"]').map(function () {
                    return this.value; // $(this).val()
                }).get();
                setTimeout(function(){
                    var j =sunday_start_arr.reverse();
                var k = j;
                    var g = hasDuplicates(k)
                     console.log(g)
                     if(g == true){
                         showSystemMessages('#systemMessage1', 'danger', 'Cant\'t select same time on same day.');
                         $(".wedquicktimepicker"+(key+1)).val('')
                     }
                },100)
            }
        });$('.day-time-div-main .thrusquicktimepicker'+(key+1)).timepicker({
            timeFormat: 'h:mm p',
            interval: 30, 
            startTime: '00:00',
            dynamic: true,
            dropdown: true,
            scrollbar: true,
            change: function(time){
                var sunday_start_arr = $('input[name="hours[thrusday_start]"]').map(function () {
                    return this.value; // $(this).val()
                }).get();
                setTimeout(function(){
                    var j =sunday_start_arr.reverse();
                var k = j;
                    var g = hasDuplicates(k)
                     console.log(g)
                     if(g == true){
                         showSystemMessages('#systemMessage1', 'danger', 'Cant\'t select same time on same day.');
                         $(".thrusquicktimepicker"+(key+1)).val('')
                     }
                },100)
            }
        });$('.day-time-div-main .friquicktimepicker'+(key+1)).timepicker({
            timeFormat: 'h:mm p',
            interval: 30, 
            startTime: '00:00',
            dynamic: true,
            dropdown: true,
            scrollbar: true,
            change: function(time){
                var sunday_start_arr = $('input[name="hours[friday_start]"]').map(function () {
                    return this.value; // $(this).val()
                }).get();
                setTimeout(function(){
                    var j =sunday_start_arr.reverse();
                var k = j;
                    var g = hasDuplicates(k)
                     if(g == true){
                         showSystemMessages('#systemMessage1', 'danger', 'Cant\'t select same time on same day.');
                         $(".friquicktimepicker"+(key+1)).val('')
                     }
                },100)
            }
        });$('.day-time-div-main .satquicktimepicker'+(key+1)).timepicker({
            timeFormat: 'h:mm p',
            interval: 30, 
            startTime: '00:00',
            dynamic: true,
            dropdown: true,
            scrollbar: true,
            change: function(time){
                var sunday_start_arr = $('input[name="hours[saturday_start]"]').map(function () {
                    return this.value; // $(this).val()
                }).get();
                setTimeout(function(){
                    var j =sunday_start_arr.reverse();
                var k = j;
                    var g = hasDuplicates(k)
                     if(g == true){
                        showSystemMessages('#systemMessage1', 'danger', 'Cant\'t select same time on same day.');
                         $(".satquicktimepicker"+(key+1)).val('')
                     }
                },100)
            }
        });
        $('.day-time-div-main .monquicktimepicker'+(key+1)).timepicker({
            timeFormat: 'h:mm p',
            interval: 30, 
            startTime: '00:00',
            dynamic: true,
            dropdown: true,
            scrollbar: true,
            change: function(time){
                var sunday_start_arr = $('input[name="hours[monday_start]"]').map(function () {
                    return this.value; // $(this).val()
                }).get();
                setTimeout(function(){
                    var j =sunday_start_arr.reverse();
                var k = j;
                    var g = hasDuplicates(k)
                     console.log(g)
                     if(g == true){
                        showSystemMessages('#systemMessage1', 'danger', 'Cant\'t select same time on same day.');
                         $(".monquicktimepicker"+(key+1)).val('')
                     }
                },100)
            }
        });
    }
})
}
var i = arr2!=null ? arr2.length : 1

$(".add-another-time").click(function(){
  i= i+1
   // console.log("iii "+i)
    var str = '<div class="day-time-div">'+
    '<i class="fa fa-trash pull-right" onclick="$(this).parent().remove()"></i>'+
    '<div class="row">'+
        '<div class="col-sm-1 day_circle Sunday dys">'+
            '<p>Su</p>'+
        '</div>'+
        '<div class="col-sm-1 day_circle Monday dys">'+
            '<p>Mo</p>'+
        '</div>'+
        '<div class="col-sm-1 day_circle Tuesday dys">'+
            '<p>Tu</p>'+
        '</div>'+
        '<div class="col-sm-1 day_circle Wednesday dys">'+
            '<p>We</p>'+
        '</div>'+
        '<div class="col-sm-1 day_circle Thrusday dys">'+
            '<p>Th</p>'+
        '</div>'+
        '<div class="col-sm-1 day_circle Friday dys">'+
            '<p>Fr</p>'+
        '</div>'+
        '<div class="col-sm-1 day_circle Saturday dys">'+
            '<p>Sa</p>'+
        '</div>'+
    '</div>'+
    '<div class="wrapperow">'+
        '<div class="form-control sunday_start" style="display:none;margin-top:10px;"><div class="row">'+
            '<label class="col-md-12">Sunday Time</label><br/>'+
            '<div class="col-md-5" >'+
                '<input type="text"  class="sunquicktimepicker'+i+'"  name="hours[sunday_start]"  autocomplete="off" style=" width:100%">'+
            '</div>'+
           ' <div class="col-sm-2"> &nbsp;-&nbsp;</div>'+
            '<div class="col-md-5" >  '+ 
                '<input type="text" class="timepicker" name="hours[sunday_end]"  autocomplete="off" style=" width:100%">'+
            '</div></div>'+
        '</div>'+
        
        '<div class="form-control monday_start" style="display:none;margin-top:10px;"><div class="row">'+
            '<label class="col-md-12">Monday Time</label><br/>'+
            '<div class="col-md-5" >'+
                '<input type="text"  class="monquicktimepicker'+i+'" name="hours[monday_start]" autocomplete="off" style=" width:100%">'+
            '</div>'+
            '<div class="col-sm-2"> &nbsp;-&nbsp;</div>'+
            '<div class="col-md-5" >  '+ 
                '<input type="text" class="timepicker" name="hours[monday_end]" autocomplete="off" style=" width:100%">'+
            '</div></div>'+
        '</div>'+
        
        '<div class="form-control tuesday_start" style="display:none;margin-top:10px;"><div class="row">'+
            '<label class="col-md-12">Tuesday Time</label><br/>'+
            '<div class="col-md-5" >'+
                '<input type="text"  class="tuesquicktimepicker'+i+'" name="hours[tuesday_start]"  autocomplete="off" style=" width:100%">'+
            '</div>'+
            '<div class="col-sm-2"> &nbsp;-&nbsp;</div>'+
            '<div class="col-md-5" >'+   
                '<input type="text" class="timepicker" name="hours[tuesday_end]"  autocomplete="off" style=" width:100%">'+
            '</div></div>'+
        '</div>'+
        
        '<div class="form-control wednesday_start" style="display:none;margin-top:10px;"><div class="row">'+
            '<label class="col-md-12">Wednesday Time</label><br/>'+
            '<div class="col-md-5" >'+
                '<input type="text"  class="wedquicktimepicker'+i+'" name="hours[wednesday_start]"  autocomplete="off" style=" width:100%">'+
            '</div>'+
            '<div class="col-sm-2"> &nbsp;-&nbsp;</div>'+
            '<div class="col-md-5" > '+  
                '<input type="text" class="timepicker" name="hours[wednesday_end]" autocomplete="off" style=" width:100%">'+
            '</div></div>'+
        '</div>'+
        
        '<div class="form-control thrusday_start" style="display:none;margin-top:10px;"><div class="row">'+
            '<label class="col-md-12">Thursday Time</label><br/>'+
            '<div class="col-md-5" >'+
                '<input type="text"  class="thrusquicktimepicker'+i+'" name="hours[thrusday_start]" autocomplete="off" style=" width:100%">'+
            '</div>'+
            '<div class="col-sm-2"> &nbsp;-&nbsp;</div>'+
            '<div class="col-md-5" >'+
               ' <input type="text" class="timepicker" name="hours[thrusday_end]"  autocomplete="off" style=" width:100%">'+
            '</div></div>'+
        '</div>'+
        
        '<div class="form-control friday_start" style="display:none;margin-top:10px;"><div class="row">'+
            '<label class="col-md-12">Friday Time</label><br/>'+
            '<div class="col-md-5" >'+
                '<input type="text"  class="friquicktimepicker'+i+'" name="hours[friday_start]"  autocomplete="off" style=" width:100%">'+
            '</div>'+
            '<div class="col-sm-2"> &nbsp;-&nbsp;</div>'+
            '<div class="col-md-5" >'+ 
                '<input type="text" class="timepicker" name="hours[friday_end]" autocomplete="off" style=" width:100%">'+
            '</div></div>'+
        '</div>'+
        
        '<div class="form-control saturday_start" style="display:none;margin-top:10px;"><div class="row">'+
            '<label class="col-md-12">Saturday Time</label><br/>'+
            '<div class="col-md-5" >'+
                '<input type="text"  class="satquicktimepicker'+i+'" name="hours[saturday_start]" autocomplete="off" style=" width:100%">'+
            '</div>'+
            '<div class="col-sm-2"> &nbsp;-&nbsp;</div>'+
                        '<div class="col-md-5" >'+ 
                '<input type="text" class="timepicker" name="hours[saturday_end]" autocomplete="off" style=" width:100%">'+
            '</div></div>'+
        '</div>'+
  
    '</div>'+
    '</div>';
    
    $( ".day-time-div-main" ).append(str);
    setTimeout(function(){
        myDayFunction();
         $('.day-time-div-main .timepicker').timepicker({
            timeFormat: 'h:mm p',
            interval: 30, 
            startTime: '00:00',
            dynamic: true,
            dropdown: true,
            scrollbar: true
        });
         $('.day-time-div-main .sunquicktimepicker'+i).timepicker({
            timeFormat: 'h:mm p',
            interval: 30, 
            startTime: '00:00',
            dynamic: true,
            dropdown: true,
            scrollbar: true,
            change: function(time){
                var sunday_start_arr = $('input[name="hours[sunday_start]"]').map(function () {
                    return this.value; // $(this).val()
                }).get();
                //sunday_start_arr = sunday_start_arr.splice(0,1)
                setTimeout(function(){
                    var g = hasDuplicates(sunday_start_arr)
                     console.log(g)
                     if(g == true){
                         console.log(i)
                         showSystemMessages('#systemMessage1', 'danger', 'Cant\'t select same time on same day.');
                         $(".sunquicktimepicker"+i).val('')
                     }
                },100)
            }
        });$('.day-time-div-main .tuesquicktimepicker'+i).timepicker({
            timeFormat: 'h:mm p',
            interval: 30, 
            startTime: '00:00',
            dynamic: true,
            dropdown: true,
            scrollbar: true,
            change: function(time){
                var sunday_start_arr = $('input[name="hours[tuesday_start]"]').map(function () {
                    return this.value; // $(this).val()
                }).get();
                setTimeout(function(){
                    var j =sunday_start_arr.reverse();
                var k = j;
                    var g = hasDuplicates(k)
                     if(g == true){
                         console.log(i)
                         showSystemMessages('#systemMessage1', 'danger', 'Cant\'t select same time on same day.');
                         $(".tuesquicktimepicker"+i).val('')
                     }
                },100)
            }
        });$('.day-time-div-main .wedquicktimepicker'+i).timepicker({
            timeFormat: 'h:mm p',
            interval: 30, 
            startTime: '00:00',
            dynamic: true,
            dropdown: true,
            scrollbar: true,
            change: function(time){
                var sunday_start_arr = $('input[name="hours[wednesday_start]"]').map(function () {
                    return this.value; // $(this).val()
                }).get();
                setTimeout(function(){
                    var j =sunday_start_arr.reverse();
                var k = j;
                    var g = hasDuplicates(k)
                     if(g == true){
                         console.log(i)
                         showSystemMessages('#systemMessage1', 'danger', 'Cant\'t select same time on same day.');
                         $(".wedquicktimepicker"+i).val('')
                     }
                },100)
            }
        });$('.day-time-div-main .thrusquicktimepicker'+i).timepicker({
            timeFormat: 'h:mm p',
            interval: 30, 
            startTime: '00:00',
            dynamic: true,
            dropdown: true,
            scrollbar: true,
            change: function(time){
                var sunday_start_arr = $('input[name="hours[thrusday_start]"]').map(function () {
                    return this.value; // $(this).val()
                }).get();
                setTimeout(function(){
                    var j =sunday_start_arr.reverse();
                var k = j;
                    var g = hasDuplicates(k)
                     if(g == true){
                         console.log(i)
                         showSystemMessages('#systemMessage1', 'danger', 'Cant\'t select same time on same day.');
                         $(".thrusquicktimepicker"+i).val('')
                     }
                },100)
            }
        });$('.day-time-div-main .friquicktimepicker'+i).timepicker({
            timeFormat: 'h:mm p',
            interval: 30, 
            startTime: '00:00',
            dynamic: true,
            dropdown: true,
            scrollbar: true,
            change: function(time){
                var sunday_start_arr = $('input[name="hours[friday_start]"]').map(function () {
                    return this.value; // $(this).val()
                }).get();
                setTimeout(function(){
                    var j =sunday_start_arr.reverse();
                var k = j;
                    var g = hasDuplicates(k)
                     if(g == true){
                         console.log(i)
                         showSystemMessages('#systemMessage1', 'danger', 'Cant\'t select same time on same day.');
                         $(".friquicktimepicker"+i).val('')
                     }
                },100)
            }
        });$('.day-time-div-main .satquicktimepicker'+i).timepicker({
            timeFormat: 'h:mm p',
            interval: 30, 
            startTime: '00:00',
            dynamic: true,
            dropdown: true,
            scrollbar: true,
            change: function(time){
                var sunday_start_arr = $('input[name="hours[saturday_start]"]').map(function () {
                    return this.value; // $(this).val()
                }).get();
                setTimeout(function(){
                    var j =sunday_start_arr.reverse();
                var k = j;
                    var g = hasDuplicates(k)
                     if(g == true){
                         console.log(i)
                         showSystemMessages('#systemMessage1', 'danger', 'Cant\'t select same time on same day.');
                         $(".satquicktimepicker"+i).val('')
                     }
                },100)
            }
        });
        $('.day-time-div-main .monquicktimepicker'+i).timepicker({
            timeFormat: 'h:mm p',
            interval: 30, 
            startTime: '00:00',
            dynamic: true,
            dropdown: true,
            scrollbar: true,
            change: function(time){
                var sunday_start_arr = $('input[name="hours[monday_start]"]').map(function () {
                    return this.value; // $(this).val()
                }).get();
               setTimeout(function(){
                    var j =sunday_start_arr.reverse();
                var k = j;
                var g = hasDuplicates(sunday_start_arr)
                    var g = hasDuplicates(k)
                     if(g == true){
                         console.log(i)
                         showSystemMessages('#systemMessage1', 'danger', 'Cant\'t select same time on same day.');
                         $(".monquicktimepicker"+i).val('')
                     }
                },100)
            }
        });
    },200)
})
      $('#stepbtnwhen').click(function(){
     var sunday_start_arr = $('input[name="hours[sunday_start]"]').map(function () {
            return this.value; // $(this).val()
        }).get();
        var sunday_end_arr = $('input[name="hours[sunday_end]"]').map(function () {
            return this.value; // $(this).val()
        }).get();
        var monday_start_arr = $('input[name="hours[monday_start]"]').map(function () {
            return this.value; // $(this).val()
        }).get();
        var monday_end_arr = $('input[name="hours[monday_end]"]').map(function () {
            return this.value; // $(this).val()
        }).get();

        var tuesday_start_arr = $('input[name="hours[tuesday_start]"]').map(function () {
            return this.value; // $(this).val()
        }).get();
        var tuesday_end_arr = $('input[name="hours[tuesday_end]"]').map(function () {
            return this.value; // $(this).val()
        }).get();

        var wednesday_start_arr = $('input[name="hours[wednesday_start]"]').map(function () {
            return this.value; // $(this).val()
        }).get();
        var wednesday_end_arr = $('input[name="hours[wednesday_end]"]').map(function () {
            return this.value; // $(this).val()
        }).get();

        var thrusday_start_arr = $('input[name="hours[thrusday_start]"]').map(function () {
            return this.value; // $(this).val()
        }).get();
        var thrusday_end_arr = $('input[name="hours[thrusday_end]"]').map(function () {
            return this.value; // $(this).val()
        }).get();

        var friday_start_arr = $('input[name="hours[friday_start]"]').map(function () {
            return this.value; // $(this).val()
        }).get();
        var friday_end_arr = $('input[name="hours[friday_end]"]').map(function () {
            return this.value; // $(this).val()
        }).get();

        var saturday_start_arr = $('input[name="hours[saturday_start]"]').map(function () {
            return this.value; // $(this).val()
        }).get();
        var saturday_end_arr = $('input[name="hours[saturday_end]"]').map(function () {
            return this.value; // $(this).val()
        }).get();
        
    if($('#startingpicker1').val() ==''){
        showSystemMessages('#systemMessage1', 'danger', 'Select Date.');
    }
    else{
        if(sunday_start_arr[0] == '' &&
        monday_start_arr[0] == '' &&
        tuesday_start_arr[0] == '' &&
        wednesday_start_arr[0] == '' &&
        thrusday_start_arr[0] == '' &&
        friday_start_arr[0] == '' &&
        saturday_start_arr[0] == ''){
            showSystemMessages('#systemMessage1', 'danger', 'Select Time.');
        }
        else{
            //$('#service_new').text('Setup your payments');
             $('#mayankstep1').hide();$('#mayankstep3').show();$('#mayankstep2').hide();$('#mayankstepwhere').hide();
        }
    }
     
//      $('#service_new').text('Setup your payments');
// $('#mayankstep1').hide();$('#mayankstep3').show();$('#mayankstep2').hide();$('#mayankstepwhere').hide();
 })
        
function hasDuplicates(array) {
    console.log(new Set(array))
    console.log(array)
    console.log((new Set(array)).size !== array.length)
    return (new Set(array)).size !== array.length;
}
function myDayFunction(){
    console.log("run2")
    var day = moment($('#startingpicker1').val(),'MM-DD-YYYY').format('dddd')
            if($('#frm_class_meets1').val() != 'Weekly'){
                if(day == 'Monday'){
                    $(".sunday_start").hide()
                    $(".tuesday_start").hide()
                    $(".wednesday_start").hide()
                    $(".thrusday_start").hide()
                    $(".friday_start").hide()
                    $(".saturday_start").hide()
                    $(".Monday").show()
                    $(".Sunday").hide()
                    $(".Tuesday").hide()
                    $(".Wednesday").hide()
                    $(".Thrusday").hide()
                    $(".Friday").hide()
                    $(".Saturday").hide()
                }
                if(day == 'Tuesday'){
                    $(".sunday_start").hide()
                    $(".monday_start").hide()
                    $(".wednesday_start").hide()
                    $(".thrusday_start").hide()
                    $(".friday_start").hide()
                    $(".saturday_start").hide()
                    $(".Monday").hide()
                    $(".Sunday").hide()
                    $(".Tuesday").show()
                    $(".Wednesday").hide()
                    $(".Thrusday").hide()
                    $(".Friday").hide()
                    $(".Saturday").hide()
                }
                if(day == 'Wednesday'){
                    $(".sunday_start").hide()
                    $(".tuesday_start").hide()
                    $(".monday_start").hide()
                    $(".thrusday_start").hide()
                    $(".friday_start").hide()
                    $(".saturday_start").hide()
                    $(".Monday").hide()
                    $(".Sunday").hide()
                    $(".Tuesday").hide()
                    $(".Wednesday").show()
                    $(".Thrusday").hide()
                    $(".Friday").hide()
                    $(".Saturday").hide()
                }
                if(day == 'Thursday'){
                    $(".sunday_start").hide()
                    $(".tuesday_start").hide()
                    $(".wednesday_start").hide()
                    $(".monday_start").hide()
                    $(".friday_start").hide()
                    $(".saturday_start").hide()
                    $(".Monday").hide()
                    $(".Sunday").hide()
                    $(".Tuesday").hide()
                    $(".Wednesday").hide()
                    $(".Thrusday").show()
                    $(".Friday").hide()
                    $(".Saturday").hide()
                }
                if(day == 'Friday'){
                    $(".sunday_start").hide()
                    $(".tuesday_start").hide()
                    $(".wednesday_start").hide()
                    $(".thrusday_start").hide()
                    $(".monday_start").hide()
                    $(".saturday_start").hide()
                    $(".Monday").hide()
                    $(".Sunday").hide()
                    $(".Tuesday").hide()
                    $(".Wednesday").hide()
                    $(".Thrusday").hide()
                    $(".Friday").show()
                    $(".Saturday").hide()
                }
                if(day == 'Saturday'){
                    $(".sunday_start").hide()
                    $(".tuesday_start").hide()
                    $(".wednesday_start").hide()
                    $(".thrusday_start").hide()
                    $(".friday_start").hide()
                    $(".monday_start").hide()
                    $(".Monday").hide()
                    $(".Sunday").hide()
                    $(".Tuesday").hide()
                    $(".Wednesday").hide()
                    $(".Thrusday").hide()
                    $(".Friday").hide()
                    $(".Saturday").show()
                }
                if(day == 'Sunday'){
                    $(".monday_start").hide()
                    $(".tuesday_start").hide()
                    $(".wednesday_start").hide()
                    $(".thrusday_start").hide()
                    $(".friday_start").hide()
                    $(".saturday_start").hide()
                    $(".Monday").hide()
                    $(".Sunday").show()
                    $(".Tuesday").hide()
                    $(".Wednesday").hide()
                    $(".Thrusday").hide()
                    $(".Friday").hide()
                    $(".Saturday").hide()
                }
            }
            else{
                $(".Monday").show()
                $(".Sunday").show()
                $(".Tuesday").show()
                $(".Wednesday").show()
                $(".Thrusday").show()
                $(".Friday").show()
                $(".Saturday").show()
            }
          }
          $('#select_box_number').change(function(){
          //$("#number_span").text($('#select_box_number').val())
          if($('#numberofpays').val() != ''){
               var k = $('#select_box_number').val()
              var l = $('#numberofpays').val()
              var j = k * l
             $("#number_span").text(j)
          }
          //console.log($('#select_box_number').val())
      })
      $('#select_box_month').change(function(){
          $("#month_span").text($('#select_box_month').val())
          //console.log($('#select_box_month').val())
      })
      $('#numberofpays').keyup(function(){
          if($('#numberofpays').val() == ''){
              $("#number_span").text(0)
          }
          else{
              var k = $('#select_box_number').val()
              var l = $('#numberofpays').val()
              var j = k * l
             $("#number_span").text(j)
          }
      })
      
      
    $('.timepicker').timepicker({
            timeFormat: 'h:mm p',
            interval: 30, 
            startTime: '00:00',
            dynamic: true,
            dropdown: true,
            scrollbar: true
        });
        
      


      
      
  var x = new SlimSelect({
    select: '#train_to'
  });
  var  p= new SlimSelect({
    select: '#testdemo'
  });
  var  pp2= new SlimSelect({
    select: '#frm_servicefocuses'
  });
  
  var  pp= new SlimSelect({
    select: '#where_choose'
  });
  var  u= new SlimSelect({
    select: '#mcc'
  });
  var  activitydesigned= new SlimSelect({
    select: '#activitydesigned'
  });
  var  personality= new SlimSelect({
    select: '#personality'
  });
  var  personality_type= new SlimSelect({
    select: '#personality_type'
  });
  var  skill= new SlimSelect({
    select: '#skill'
  });
  var  fitness_goals_array= new SlimSelect({
    select: '#fitness_goals_array'
  });
  var  frm_servicelocation= new SlimSelect({
    select: '#frm_servicelocation'
  });
  var  teaching= new SlimSelect({
    select: '#teaching'
  });
  var  frm_experience_level= new SlimSelect({
    select: '#frm_experience_level'
  });
  var  frm_numberofpeople= new SlimSelect({
    select: '#frm_numberofpeople'
  });
  var  frm_programfor= new SlimSelect({
    select: '#frm_programfor'
  });
  var  frm_agerange= new SlimSelect({
    select: '#frm_agerange'
  });
  var  categ= new SlimSelect({
    select: '#categ'
  });
  var  activitytype= new SlimSelect({
    select: '#activitytype'
  });
 /* var  duration= new SlimSelect({
    select: '#duration'
  });*/
  var  frm_servicepriceoption= new SlimSelect({
    select: '#frm_servicepriceoption'
  });
  var  frm_specialdeals= new SlimSelect({
    select: '#frm_specialdeals'
  });
$('.percentage').keyup(function(){
var val =parseInt($(this).val());
if($.isNumeric(val)){
  if(val==0 ){
    $(this).val('');
$('#taxmsg').text('Please enter the value greater than 0').show();
setTimeout(function(){ $('#taxmsg').hide() }, 3000);  
  }
if(val>100 ){
$(this).val('');
$('#taxmsg').text('Please enter the value less than 100').show();
setTimeout(function(){ $('#taxmsg').hide() }, 3000);
return false;
}
}else{
  $(this).val('');
$('#taxmsg').text('Please enter only numbers').show();
setTimeout(function(){ $('#taxmsg').hide() }, 3000);
}

});
$('.setnumber').keyup(function(){
  var val =parseInt($(this).val());
if($.isNumeric(val)){
  if(val==0 ){
    $(this).val('');
$('#setnumbermsg').text('Please enter the value greater than 0').show();
setTimeout(function(){ $('#taxmsg').hide() }, 3000);  
  }
if(val>100 ){
$(this).val('');
$('#setnumbermsg').text('Please enter the value less than 100').show();
setTimeout(function(){ $('#setnumbermsg').hide() }, 3000);
}
}else{
  $(this).val('');
$('#setnumbermsg').text('Please enter only numbers').show();
setTimeout(function(){ $('#setnumbermsg').hide() }, 3000);
}
});
  $(".myautopay").click(function() {
        var willing_to_travel_radio = $(this).find('input[type=radio]').val();
        if(willing_to_travel_radio == 0){
          $('#myautopaynum').show();
            $('#monthtomonth').show();
        } else {
        $('#monthtomonth').hide();
            $('#myautopaynum').hide();
        }
      });
       
             $('.timepicker').timepicker({
            timeFormat: 'h:mm p',
            interval: 30, 
            startTime: '00:00',
            dynamic: true,
            dropdown: true,
            scrollbar: true
        });
  
    function options_f(len,id){
      $('#'+id).empty();
      for (i = 1; i <= len ; i++) {
        $('#'+id).append('<option value="'+i+'">'+i+'</option>');
      }
    }
  
    $('#secdayweek').change(function(){
      var t = $('#secdayweek option:selected').val();
      var id = $('#secdayweek').attr('rel');
      console.log(t,"---",id)
      if(t=='Days'){
        options_f(31,id);
      }
      if(t=='Weeks'){
        options_f(52,id);
      }
      if(t=='Months'){
        options_f(12,id);
      }
    });
    $('#firstdayweek').change(function(){
      var t = $('#firstdayweek option:selected').val();
      var id = $('#firstdayweek').attr('rel');
      console.log(t,"---",id)
      if(t=='Days'){
        options_f(31,id);
      }
      if(t=='Weeks'){
        options_f(52,id);
      }
      if(t=='Months'){
        options_f(12,id);
      }
    });
  
    $('[type="search"]').keyup(function(){
      var t = $('[type="search"]').val();
      
      $.ajax({
          url: "/getlanguage",
          type: "post",
          data: { lang : t },
      headers: {
          'X-CSRF-TOKEN': '{{csrf_token()}}'
      },
          success: function(data){
        //alert(JSON.stringify(data));
        var myArray = $.map(data, function(element) {        
          return '<option value="'+element.name+'">'+element.name+'</option>';
          });
              $("#testdemo").html(myArray);
          }
      });
  }); 
     // $('#mdp-demo').multiDatesPicker('separator',',,,,');
      $('#mdp-demo').multiDatesPicker();
      $('#markcalendar').click(function() {
          $("#mdp-demo").focus();
        });
  
  
  
        $(".singup_steps").hide();
        $("#singup_step_1").show();
        //   $("#frm_serviceprice").keydown(function(e) {
        //       var field=this;
        //       setTimeout(function () {
        //           if(field.value.indexOf('$') !== 0) {
        //               $(field).val('$');
        //           } 
        //       }, 1);
        //   });
  
        /*** employment history form process - starts ***/
  
        $("#addEmployementHistory").on("hidden.bs.modal", function(){
              removeFormValues('addEmployementHistory');
          });
  
        // open employement history form 
          $("#add_sngp").click(function() {
            $('#addEmployementHistory').modal('show');
          });       
  
  
          // save employement history form
          $("#submit_employement_history").click(function() {
  
            // check validations
            if(!validateFormEmploymentHistory()) {
              return false;
            }
  
            // check if form is open in edit mode
            var editrowcount = $("#addEmployementHistory").find("input[name='editrowcount']").val();
            if(editrowcount != "") {
              var selected_id = $("#"+editrowcount).find("input[name='employmenthistory_id[]']").val();
              if(selected_id > 0) {
                if($("#edited_employmenthistory_id").val() == "")
                  $("#edited_employmenthistory_id").val(selected_id);
                else
                  $("#edited_employmenthistory_id").val($("#edited_employmenthistory_id").val() +","+ selected_id);
              }
              $("#addEmployementHistory").find("input").each(function() {
              var form_element_name = $(this).attr('name').split("_");
              form_element_name = form_element_name[1];
              $("#"+editrowcount).find("input[title='"+form_element_name+"']").val($(this).val());
            });
            }
            else {
              var last_row_id = $("#employement_history_table > tbody > tr:last-child").closest('tr').attr('id');
              var last_row_count = last_row_id.split("_");
              employement_history_count = parseInt(last_row_count[1]) + 1;
              var newrow = '<tr id="history_'+employement_history_count+'">'
                    + '<input type="hidden" name="employmenthistory_id[]" value="0">'
                    + '<td valign="middle">' 
                    + '<input type="text" name="organization[]" value="'+$("input:text[name='frm_organization']").val()+'" class="noborder" title="organization" readonly>'
                    +  '</td>'
                    + '<td valign="middle">' 
                    + '<input type="text" name="position[]" value="'+$("input:text[name='frm_position']").val()+'" class="noborder"  title="position" readonly>'
                    + '</td>'
                    + '<td valign="middle">'
                    + '<input type="hidden" name="ispresent[]" value="'+$("#frm_ispresent").val()+'" class="noborder" title="ispresent">'
                    + '<input type="text" name="servicestart[]" value="'+$("input:text[name='frm_servicestart']").val()+'" class="noborder"  title="servicestart" readonly>'
                    + '</td>'
                    + '<td valign="middle">' 
                    + '<input type="text" name="serviceend[]" value="'+$("input:text[name='frm_serviceend']").val()+'" class="noborder"  title="serviceend" readonly>'
                    + '</td>'
                    + '<td valign="middle" align="center">'
                    + '   <a href="javascript:editHistory('+employement_history_count+')"><i class="fa fa-pencil-square"></i></a>'
                    + '   <a href="javascript:deleteRow(\'history_'+employement_history_count+'\')" title="Delete this detail"><i class="fa fa-trash"></i></a>'
                    + '</td>'
                    + '</tr>';
  
              $("#employement_history_table > tbody:last-child").append(newrow);
            }         
  
            // remove form field values
            removeFormValues('addEmployementHistory');
            $('#addEmployementHistory').modal('hide');
          });
  
          /*** education form process - starts ***/
        $("#addEducation").on("hidden.bs.modal", function(){
              removeFormValues('addEducation');
          });
  
        // open education form 
          $("#add_education").click(function() {
            $('#addEducation').modal('show');
          });
  
          // save education form
          $("#submit_education").click(function() {
  
            // check validations
            if(!validateFormEducation()) {
              return false;
            }
  
            // check if form is open in edit mode
            var editrowcount = $("#addEducation").find("input[name='editrowcount_education']").val();
            if(editrowcount != "") {
              var selected_id = $("#"+editrowcount).find("input[name='education_id[]']").val();
              if(selected_id > 0) {
                if($("#edited_education_id").val() == "")
                  $("#edited_education_id").val(selected_id);
                else
                  $("#edited_education_id").val($("#edited_education_id").val() +","+ selected_id);
              }
              $("#addEducation").find("input").each(function() {
              var form_element_name = $(this).attr('name').split("_");
              form_element_name = form_element_name[1];
              $("#"+editrowcount).find("input[title='"+form_element_name+"']").val($(this).val());
            });
            }
            else {
  
              var last_row_id = $("#education_table > tbody > tr:last-child").closest('tr').attr('id');
              var last_row_count = last_row_id.split("_");
              education_count = parseInt(last_row_count[1]) + 1;
              var newrow = '<tr id="education_'+education_count+'">'
                    + '<input type="hidden" name="education_id[]" value="0">'
                    + '<td valign="middle">' 
                    + '<input type="text" name="course[]" value="'+$("input:text[name='frm_course']").val()+'" class="noborder" title="course" readonly>'
                    +  '</td>'
                    + '<td valign="middle">' 
                    + '<input type="text" name="university[]" value="'+$("input:text[name='frm_university']").val()+'" class="noborder"  title="university" readonly>'
                    + '</td>'
                    + '<td valign="middle">' 
                    + '<input type="text" name="passingyear[]" value="'+$("input:text[name='frm_passingyear']").val()+'" class="noborder"  title="passingyear" readonly>'
                    + '</td>'
                    + '<td valign="middle" align="center">'
                    + '   <a href="javascript:editEducation('+education_count+')"><i class="fa fa-pencil-square"></i></a>'
                    + '   <a href="javascript:deleteRow(\'education_'+education_count+'\')" title="Delete this detail"><i class="fa fa-trash"></i></a>'
                    + '</td>'
                    + '</tr>';
  
              $("#education_table > tbody:last-child").append(newrow);
            }         
  
            // remove form field values
            removeFormValues('addEducation');
            $('#addEducation').modal('hide');
          });
  
          /*** certification form process - starts ***/
        $("#addCertificate").on("hidden.bs.modal", function(){
              removeFormValues('addCertificate');
          });
  
        // open certification form 
          $("#add_certificate").click(function() {
            $('#addCertificate').modal('show');
          });
  
          // save certificate form
          $("#submit_certificate").click(function() {
  
            // check validations
            if(!validateFormCertificate()) {
              return false;
            }
  
            // check if form is open in edit mode
            var editrowcount = $("#addCertificate").find("input[name='editrowcount_certificate']").val();
            if(editrowcount != "") {
              var selected_id = $("#"+editrowcount).find("input[name='certificate_id[]']").val();
              if(selected_id > 0) {
                if($("#edited_certificate_id").val() == "")
                  $("#edited_certificate_id").val(selected_id);
                else
                  $("#edited_certificate_id").val($("#edited_certificate_id").val() +","+ selected_id);
              }
              $("#addCertificate").find("input").each(function() {
              var form_element_name = $(this).attr('name').split("_");
              form_element_name = form_element_name[1];
              $("#"+editrowcount).find("input[title='"+form_element_name+"']").val($(this).val());
            });
            }
            else {
  
              var last_row_id = $("#certificate_table > tbody > tr:last-child").closest('tr').attr('id');
              var last_row_count = last_row_id.split("_");
              certificate_count = parseInt(last_row_count[1]) + 1;
              var newrow = '<tr id="certificate_'+certificate_count+'">'
                    + '<input type="hidden" name="certificate_id[]" value="0">'
                    + '<td valign="middle">' 
                    + '<input type="text" name="certificatetitle[]" value="'+$("input:text[name='frm_certificatetitle']").val()+'" class="noborder" title="certificatetitle" readonly>'
                    +  '</td>'
                    + '<td valign="middle">' 
                    + '<input type="text" name="certificatecompletion[]" value="'+$("input:text[name='frm_certificatecompletion']").val()+'" class="noborder"  title="certificatecompletion" readonly>'
                    + '</td>'
                    + '<td valign="middle" align="center">'
                    + '   <a href="javascript:editCertificate('+certificate_count+')"><i class="fa fa-pencil-square"></i></a>'
                    + '   <a href="javascript:deleteRow(\'certificate_'+certificate_count+'\')" title="Delete this detail"><i class="fa fa-trash"></i></a>'
                    + '</td>'
                    + '</tr>';
  
              $("#certificate_table > tbody:last-child").append(newrow);
            }         
  
            // remove form field values
            removeFormValues('addCertificate');
            $('#addCertificate').modal('hide');
          });
  
          /*** services form process - starts ***/
        $("#addService").on("hidden.bs.modal", function(){
              removeFormValues('addService');
          });
  
        // open service form 
          $("#add_service").click(function() {
            $.ajax({
          url:'/get_serviceform',
          type:'get',
          success: function (response) { 
            $('#addService').html(response);
            console.log(response)
  $('#addService').modal('show');
            }
        });
            //$('#addService').modal('show');
          });
  
          // save service form
          // $("#submit_service1").click(function() {
         
  
      $(".button-back").click(function() {
        var steps_div_id = $(this).closest('div[class="singup_steps"]').attr("id");
        var step_id = steps_div_id.split("_");
        var current_step = step_id[2];
        var next_step = parseInt(current_step) - 1;
  
        $("#singup_step_"+current_step).fadeOut(function () {
          $("#singup_step_"+next_step).fadeIn(1000);
        });
  
        $('.steps').find('.step_'+next_step).addClass("step-active");
      });
  
      $(".experience_level_div").click(function() {
        $(".experience_level_div").removeClass('active');
        var label_value = $(this).find('label').html();
        $(this).addClass('active');
        $('#selected_experience_level').val(label_value);
      });
  
      $("label.present_work_btn").click(function() {
        $("#frm_ispresentcheck").attr("checked", !$("#frm_ispresentcheck").attr("checked"));
        changeDateBasedonPresent();
      });
      function changeDateBasedonPresent()
    {
      if($("#frm_ispresentcheck").attr("checked")) {
          $("#frm_ispresent").val("1");
          $("#dp2").val("Till Date");
          $("#dp2").attr("disabled", true); 
        }else {
          $("#frm_ispresent").val("0");
          $("#dp2").val("");
          $("#dp2").attr("disabled", false);
        }
    }
  
    function validateFormEmploymentHistory()
    {
      var msg = '';
      var returnVal;
      returnVal = true;
      if($("input:text[name='frm_organization']").val().trim() == "") {
        msg += '<br>Enter Organization';
        returnVal = false;
      }
      if($("input:text[name='frm_position']").val().trim() == "") {
        msg += '<br>Enter Position';
        returnVal = false;
      }
      if($("input:text[name='frm_servicestart']").val().trim() == "") {
        msg += '<br>Enter Service start date';
        returnVal = false;
      }
      if(!$("#frm_ispresentcheck").attr("checked") && $("input:text[name='frm_serviceend']").val() == "") {
        msg += '<br>Enter Service end date';
        returnVal = false;
      }
      if($("input:text[name='frm_servicestart']").val() != "" && !$("#frm_ispresentcheck").attr("checked") && $("input:text[name='frm_serviceend']").val() != "") {
        var selected_startDate = $("input:text[name='frm_servicestart']").val().split("-");
        var startDate = new Date(selected_startDate[2], selected_startDate[1]-1, selected_startDate[0]);
        var selected_endDate = $("input:text[name='frm_serviceend']").val().split("-");
        var endDate = new Date(selected_endDate[2], selected_endDate[1]-1, selected_endDate[0]);
        if (startDate.valueOf() > endDate.valueOf()) {
          msg += '<br>The from-date can not be greater then the to-date';
          returnVal = false;
        }
      }
      if(!returnVal) {
        showSystemMessages('#systemMessage_history', 'danger', msg);
        return false;
      }
      return true;    
    }
  
    function validateFormEducation()
    {
      var msg = '';
      var returnVal;
      returnVal = true;
      if($("input:text[name='frm_course']").val().trim() == "") {
        msg += '<br>Enter Course';
        returnVal = false;
      }
      if($("input:text[name='frm_university']").val().trim() == "") {
        msg += '<br>Enter University';
        returnVal = false;
      }
      if($("input:text[name='frm_passingyear']").val().trim() == "") {
        msg += '<br>Enter Passing year';
        returnVal = false;
      }
      if(!returnVal) {
        showSystemMessages('#systemMessage_education', 'danger', msg);
        return false;
      }
      return true;    
    }
  
    function validateFormCertificate()
    {
      var msg = '';
      var returnVal;
      returnVal = true;
      if($("input:text[name='frm_certificatetitle']").val().trim() == "") {
        msg += '<br>Enter Name of certification';
        returnVal = false;
      }
      if($("input:text[name='frm_certificatecompletion']").val().trim() == "") {
        msg += '<br>Enter Completion date';
        returnVal = false;
      }
      if(!returnVal) {
        showSystemMessages('#systemMessage_certificate', 'danger', msg);
        return false;
      }
      return true;    
    }
  
    function validateFormService()
    {
      var msg = '';
      var returnVal;
      returnVal = true;
  null
      if($("input:text[name='frm_servicetitle']").val().trim() == "") {
        msg += '<br>Enter Name of service';
        returnVal = false;
      }
    //   if($("input:text[name='frm_servicetimeslotfrom']").val().trim() == "") {
    //     msg += '<br>Enter From time slot';
    //     returnVal = false;
    //   }
    //   if($("input:text[name='frm_servicetimeslotto']").val().trim() == "") {
    //     msg += '<br>Enter To time slot';
    //     returnVal = false;
    //   }
    
    console.log($("#frm_serviceprice").val());
    
      if($("#frm_serviceprice").val().trim() == "") {
        msg += '<br>Enter Price for service';
        returnVal = false;
      }else {
        var price = $("#frm_serviceprice").val();
        var valid = /^\$?(\d{1,3}(\,\d{3})*|(\d+))(\.\d{0,2})?$/.test(price);                    
        if(!valid) {
          msg += '<br>Enter proper Price for service';
        returnVal = false;
        }
        }
                  //check valid amountc
      if($("#frm_servicedesc").val().trim() == "") {
        msg += '<br>Enter Description';
        returnVal = false;
      }
      if($("select[name='frm_servicesport']").val() == "") {
        msg += '<br>Select Sport';
        returnVal = false;
      }
      //----------------------new validation for new fields--------------------------------
    /*  if($("select[name='frm_servicetype[]']").val() == null) {
        msg += '<br>Choose Service Type';
        returnVal = false;
      }
      if($("select[name='activitydesignsfor[]']").val() == null) {
        msg += '<br>Choose Activity Designed For';
        returnVal = false;
      }
      if($("select[name='activitytype[]']").val() == null) {
        msg += '<br>Choose  Activity Type';
        returnVal = false;
      } 
      if($("select[name='frm_agerange[]']").val() == null) {
        msg += '<br>Select Age Range';
        returnVal = false;
      }
      if($("select[name='frm_programfor[]']").val() == null) {
        msg += '<br>Activity For?';
        returnVal = false;
      } 
      if($('[name="setupprice"]:checked').length ==0){
        msg += '<br>Is this an special offer or a promotion?';
        returnVal = false;
      }
      if($('[name="termcondfaqtext"]').val()==' '){
        msg += '<br>Terms, Conditions, FAQ';
        returnVal = false;
      }
      if($('[name="contracttermstext"]').val()==' '){
        msg += '<br>Contract Terms';
        returnVal = false;
      }
      if($('[name="liabilitytext"]').val()==' '){
        msg += '<br>Liability';
        returnVal = false;
      } 
      if($("select[name='frm_numberofpeople[]']").val() == null) {
        msg += '<br>Select Participates Number';
        returnVal = false;
      }
  
      if($("select[name='frm_experience_level[]']").val() == null) {
        msg += '<br>Select Program Experience Level';
        returnVal = false;
      }
      if($("select[name='frm_servicelocation[]']").val() == null) {
        msg += '<br>Select Service Location';
        returnVal = false;
      }
      if($("select[name='frm_teachingstyle[]']").val() == null) {
        msg += '<br>Select Teaching Style';
        returnVal = false;
      }     
      if($("select[name='frm_servicepriceoption[]']").val() == null) {
        msg += '<br>Select Service Price Options';
        returnVal = false;
      }
      if($("select[name='frm_serviceduration']").val() == null) {
        msg += '<br>Select Duration';
        returnVal = false;
      }
      if($("input[name='service_image']").val() == "") {
        msg += '<br>Select Profile pic';
        returnVal = false;
      }
      
*/
      if(!returnVal) {
        showSystemMessages('#systemMessage_service', 'danger', msg);
        return false;
      }
      return true;    
    }
  
      function editHistory(rowcount)
      {
        $("#history_"+rowcount).find("input").each(function() {
          var form_element_name = $(this).attr('title');
          $("#addEmployementHistory").find("input[name='frm_"+form_element_name+"']").val($(this).val());
        });
        if($("#frm_ispresent").val() == "1") {
          $("#frm_ispresentcheck").attr("checked",true);
          $("label.present_work_btn").addClass('active');
          changeDateBasedonPresent();
        }else {
          $("#frm_ispresentcheck").attr("checked",false);
        }
        $("#addEmployementHistory").find("input[id='editrowcount']").val("history_"+rowcount);
        $('#addEmployementHistory').modal('show');
      }
  
      function editEducation(rowcount)
      {
        $("#education_"+rowcount).find("input").each(function() {
          var form_element_name = $(this).attr('title');
          $("#addEducation").find("input[name='frm_"+form_element_name+"']").val($(this).val());
        });
        $("#addEducation").find("input[id='editrowcount_education']").val("education_"+rowcount);
        $('#addEducation').modal('show');
      }
  
      function editCertificate(rowcount)
      {
        $("#certificate_"+rowcount).find("input").each(function() {
          var form_element_name = $(this).attr('title');
          $("#addCertificate").find("input[name='frm_"+form_element_name+"']").val($(this).val());
        });
        $("#addCertificate").find("input[id='editrowcount_certificate']").val("certificate_"+rowcount);
        $('#addCertificate').modal('show');
      }
  
  
      function deleteRow(rowid)
      {
        var selected_section = rowid.split("_");
        var selected_section_id = ""; 
        if(selected_section[0] == "history") {
          selected_section_id = "employmenthistory_id";
        }
        else if(selected_section[0] == "education") {
          selected_section_id = "education_id";
        }
        else if(selected_section[0] == "certificate") {
          selected_section_id = "certificate_id";
        }
        else if(selected_section[0] == "service") {
          selected_section_id = "service_id";
        }
        var selected_id = $("#"+rowid).find("input[name='"+selected_section_id+"[]']").val();
          if(selected_id > 0) {
            if($("#deleted_"+selected_section_id).val() == "")
              $("#deleted_"+selected_section_id).val(selected_id);
            else
              $("#deleted_"+selected_section_id).val($("#deleted_"+selected_section_id).val() +","+ selected_id);
          }
        $("#"+rowid).remove();
      }        
  
      function removeFormValues(modalName)
      {
        var modalElement = $('#'+modalName).find("input");
        modalElement.each(function() {
          $(this).val('');
        });
        if(modalName == "addEmployementHistory") {
          $("#systemMessage_history").html('');
          $("#frm_ispresentcheck").attr("checked",false);
          $("label.present_work_btn").removeClass('active');
          $("#dp2").val("");
        $("#dp2").attr("disabled", false);
        }
        else if(modalName == "addEducation") {
          $("#systemMessage_education").html('');
        }     
        else if(modalName == "addCertificate") {
          $("#systemMessage_certificate").html('');
        }
        else if(modalName == "addService") {
          $('#servicedata')[0].reset();
          // $("#frm_servicedesc").val('');
          // $("#frm_servicesport").val('');
          $('.uploadedpic').html('<i class="fa fa-user" style="line-height: 56px;"></i>');
          $("#systemMessage_service").html('');
        }
      }
  
      $("label.btn").click(function() {
                // find clicked button radio option name
                var radio_option = $(this).find('input[type=radio]');
                if ($(radio_option).is(':radio')) {
                  var radio_option_name = $(radio_option).attr('name');
                  // make all other options to null
                  $('input[type=radio][name="'+radio_option_name+'"]').each(function() {
                    $(this).closest('label.btn').removeClass('active');
                  });
                 
                  $(this).addClass('active');
                }              
          });    
      
      $(".willing_to_travel").click(function() {
        var willing_to_travel_radio = $(this).find('input[type=radio]');  
        var willing_to_travel_val = $(willing_to_travel_radio).attr('value');     
  
        if(willing_to_travel_val == 'yes'){
          $('.travel_miles_div').show();
        } else {
        $('.travel_miles_div').hide();
        }
  
      });
     $(".medicaloption").click(function() {
        var willing_to_travel_radio = $(this).find('input[type=radio]');  
        var willing_to_travel_val = $(willing_to_travel_radio).attr('value');     
        if(willing_to_travel_val == 1){
          $('.medicalyesno').show();
        } else {
        $('.medicalyesno').hide();
        }
      });
    $(".fitgolsop").click(function() {
        var willing_to_travel_radio = $(this).find('input[type=radio]');  
        var willing_to_travel_val = $(willing_to_travel_radio).attr('value');     
        if(willing_to_travel_val == 1){
          $('.fitgolsyesno').show();
        } else {
        $('.fitgolsyesno').hide();
        }
      });
   $(".setupprice").click(function() {
        var willing_to_travel_radio = $(this).find('input[type=radio]').val();
        if(willing_to_travel_radio == 1){
          $('#offpromo').show();
          $('#offprom_option').show();
        } else {
        $('#offpromo').hide();
        $('#offprom_option').hide();
        }
      });
      
      $(".multises").click(function() {
        var willing_to_travel_radio = $(this).find('input[type=radio]').val();
        if(willing_to_travel_radio == 'multiple'){
          $('#multisession').show();
        } else {
        $('#multisession').hide();
        }
      });
      $(".termcondfaq").click(function() {
        var willing_to_travel_radio = $(this).find('input[type=checkbox]').val();
        if(willing_to_travel_radio == 1){
          $('#termfaq').toggle();
        } 
      });
      $(".liability").click(function() {
        var willing_to_travel_radio = $(this).find('input[type=checkbox]').val();
        if(willing_to_travel_radio == 1){
          $('#liability').toggle();
        } 
      });
      $(".covid").click(function() {
        var willing_to_travel_radio = $(this).find('input[type=checkbox]').val();
        if(willing_to_travel_radio == 1){
          $('#covid').toggle();
        } 
      });
      $(".contractterms").click(function() {
        var willing_to_travel_radio = $(this).find('input[type=checkbox]').val();
        if(willing_to_travel_radio == 1){
          $('#contractterms').toggle();
        } 
      });

      
      $(".recurring_pay").click(function() {
        var willing_to_travel_radio = $(this).find('input[type=radio]').val();
        if(willing_to_travel_radio == 1){
          $('#recurring_pay').show();
        } else {
        $('#recurring_pay').hide();
        }
      });

      $('.percentageckeck').click(function(){
        if($(this).find('input[type=checkbox]').val() =='salestax' ){
        $('#salestaxpercentage').toggle();
      }
     if($(this).find('input[type=checkbox]').val() == 'duestax'){
        $('#duestaxpercentage').toggle();
      }
      });
        
      
</script> 
<script>
  if (top.location != location) {
      top.location.href = document.location.href ;
  }
  $(function(){
    window.prettyPrint && prettyPrint();
    $('#dp1').datepicker({
      format: 'dd-mm-yyyy'
    }).on('changeDate', function(ev){
        var selected_enddate = $('#dp2').val().split("-");
        var endDate = new Date(selected_enddate[2], selected_enddate[1]-1, selected_enddate[0]);
        console.log(ev.date +"--"+endDate +"--"+ ev.date.valueOf() +"--"+ endDate.valueOf());
        if (ev.date.valueOf() > endDate.valueOf()){ console.log(ev.date.valueOf());
          showSystemMessages('#systemMessage_history', 'danger', 'The from-date can not be greater then the to-date');
        } else {
          $('#systemMessage_history').html('');
          // startDate = new Date(ev.date);
        }
        $('#dp1').datepicker('hide');
    });
    $('#dp2').datepicker({
      format: 'dd-mm-yyyy'
    }).on('changeDate', function(ev){
        var selected_startDate = $('#dp1').val().split("-");
        var startDate = new Date(selected_startDate[2], selected_startDate[1]-1, selected_startDate[0]);
        console.log(startDate +"--"+ev.date +"--"+ startDate.valueOf() +"--"+ ev.date.valueOf());
        if (startDate.valueOf() > ev.date.valueOf()){ console.log(ev.date.valueOf());
          showSystemMessages('#systemMessage_history', 'danger', 'The from-date can not be greater then the to-date');
        } else {
          $('#systemMessage_history').html('');
          // startDate = new Date(ev.date);
        }
        $('#dp2').datepicker('hide');
    });
    $('#passingyear').datepicker({
      format: 'dd-mm-yyyy'
    });
    $('#certificatecompletion').datepicker({
      format: 'dd-mm-yyyy'
    });
  
        // disabling dates
        var nowTemp = new Date();
        var now = new Date(nowTemp.getFullYear(), nowTemp.getMonth(), nowTemp.getDate(), 0, 0, 0, 0);
  
        var checkin = $('#dpd1').datepicker({
          onRender: function(date) {
            return date.valueOf() < now.valueOf() ? 'disabled' : '';
          }
        }).on('changeDate', function(ev) {
          if (ev.date.valueOf() > checkout.date.valueOf()) {
            var newDate = new Date(ev.date)
            newDate.setDate(newDate.getDate() + 1);
            checkout.setValue(newDate);
          }
          checkin.hide();
          $('#dpd2')[0].focus();
        }).data('datepicker');
        var checkout = $('#dpd2').datepicker({
          onRender: function(date) {
            return date.valueOf() <= checkin.date.valueOf() ? 'disabled' : '';
          }
        }).on('changeDate', function(ev) {
          checkout.hide();
        }).data('datepicker');
  });
  
  
  $('#servicedata').submit(function(e) {

        e.preventDefault();
        if(!validateFormService()) {
            return false;
          }
        var inputData = new FormData($(this)[0]);
        var sunday_start_arr = $('input[name="hours[sunday_start]"]').map(function () {
            return this.value; // $(this).val()
        }).get();
        var sunday_end_arr = $('input[name="hours[sunday_end]"]').map(function () {
            return this.value; // $(this).val()
        }).get();
        var monday_start_arr = $('input[name="hours[monday_start]"]').map(function () {
            return this.value; // $(this).val()
        }).get();
        var monday_end_arr = $('input[name="hours[monday_end]"]').map(function () {
            return this.value; // $(this).val()
        }).get();

        var tuesday_start_arr = $('input[name="hours[tuesday_start]"]').map(function () {
            return this.value; // $(this).val()
        }).get();
        var tuesday_end_arr = $('input[name="hours[tuesday_end]"]').map(function () {
            return this.value; // $(this).val()
        }).get();

        var wednesday_start_arr = $('input[name="hours[wednesday_start]"]').map(function () {
            return this.value; // $(this).val()
        }).get();
        var wednesday_end_arr = $('input[name="hours[wednesday_end]"]').map(function () {
            return this.value; // $(this).val()
        }).get();

        var thrusday_start_arr = $('input[name="hours[thrusday_start]"]').map(function () {
            return this.value; // $(this).val()
        }).get();
        var thrusday_end_arr = $('input[name="hours[thrusday_end]"]').map(function () {
            return this.value; // $(this).val()
        }).get();

        var friday_start_arr = $('input[name="hours[friday_start]"]').map(function () {
            return this.value; // $(this).val()
        }).get();
        var friday_end_arr = $('input[name="hours[friday_end]"]').map(function () {
            return this.value; // $(this).val()
        }).get();

        var saturday_start_arr = $('input[name="hours[saturday_start]"]').map(function () {
            return this.value; // $(this).val()
        }).get();
        var saturday_end_arr = $('input[name="hours[saturday_end]"]').map(function () {
            return this.value; // $(this).val()
        }).get();
        setTimeout(function(){
            console.log("sunday_start_arr "+sunday_start_arr.length)
            console.log(thrusday_start_arr)
            var new_arr= [];
            for(var i = 0;i< sunday_start_arr.length;i++){
                //console.log(thrusday_start_arr[i])
                var tst = (thrusday_start_arr[i] == undefined ||thrusday_start_arr[i] == 'undefined' ) ? "" : thrusday_start_arr[i];
                var tend = (thrusday_end_arr[i] == undefined ||thrusday_end_arr[i] == 'undefined' ) ? "" : thrusday_end_arr[i];
                new_arr.push({"sunday_start":sunday_start_arr[i],"sunday_end":sunday_end_arr[i],"monday_start":monday_start_arr[i],"monday_end":monday_end_arr[i],"tuesday_start":tuesday_start_arr[i],"tuesday_end":tuesday_end_arr[i],"wednesday_start":wednesday_start_arr[i],"wednesday_end":wednesday_end_arr[i],"thrusday_start":tst,"thrusday_end":tend,"friday_start":friday_start_arr[i],"friday_end":friday_end_arr[i],"saturday_start":saturday_start_arr[i],"saturday_end":saturday_end_arr[i]})
                if(i+1 == sunday_start_arr.length)
                {
                    inputData.append("serv_time_slot",JSON.stringify(new_arr))
                    console.log(new_arr)
                }
            }
            //formdata.append("serv_time_slot")
            var c_id = window.location.href.split('/').pop();
            inputData.append('class_meets',$('#frm_class_meets1').val())
            inputData.append('starting_date',$('#startingpicker1').val())
            inputData.append('end_date',$('#end_date').val())
            inputData.append('schedule_until',$('#frm_schedule_until').val())
            if(c_id.split('#')[0] != 'viewProfile#' && c_id.split('#')[0] != 'viewProfile')
            inputData.append('company_id',c_id.split('#')[0])
        },100)
        //console.log(inputData);
        inputData.append('_token','{{csrf_token()}}');
        inputData.append('covidtext',$("#covidtext").val());

        if($("#termcondfaqtext").val() != '' && $("#termcondfaqtext").val() != ' ' && $("#termcondfaqtext").val() != 'undefined' && $("#termcondfaqtext").val() != undefined){
            $("#termcondfaqtexterror").text('')
            if($("#contracttermstext").val() != '' && $("#contracttermstext").val() != ' ' && $("#contracttermstext").val() != 'undefined' && $("#contracttermstext").val() != undefined){
                $("#contracttermstexterror").text('')
                if($("#liabilitytext").val() != '' && $("#liabilitytext").val() != ' ' && $("#liabilitytext").val() != 'undefined' && $("#liabilitytext").val() != undefined){
                    $("#liabilitytexterror").text('')
                    if($("#covidtext").val() != '' && $("#covidtext").val() != ' ' && $("#covidtext").val() != 'undefined' && $("#covidtext").val() != undefined){
                    setTimeout(function(){
                         $.ajax({
                          url:'/service/editservicedetail',
                          type:'POST',
                          dataType: 'json',
                          data:inputData,
                          processData:false,
                          contentType:false,
                          beforeSend: function () {
                             $('.loader').show();
                          },
                          complete: function () {
                             $('.loader').hide();
                          },
                          success: function (response) {
                                if (response.type == 'success') {
                                  showSystemMessages('#systemMessage', response.type, response.msg);
                                  $("#addService").find("#updated_profile_pic").val(response.image_name);
                                  $('#addService').modal('hide');
                
                                  saveValues();
                  
                                }else {
                                    showSystemMessages('#systemMessage', response.type, response.msg);
                                }
                            }
                        });
                        },200)
                    }
                    else{
                        showSystemMessages('#systemMessage1', 'danger', 'Covid – 19 Protocols Text is required.');
                        $("#covidtexterror").text('This field is required')
                    }
                }
                else{
                    showSystemMessages('#systemMessage1', 'danger', 'Liability Text is required.');
                    $("#liabilitytexterror").text('This field is required')
                }
            }
            else{
                showSystemMessages('#systemMessage1', 'danger', 'Contract Terms is required.');
                $("#contracttermstexterror").text('This field is required')
            }
        }
        else{
            showSystemMessages('#systemMessage1', 'danger', 'Terms & condition is required.');
            $("#termcondfaqtexterror").text('This field is required')
        }
        
  });
  function readURL(input) {
         if (input.files && input.files[0]) {
             var reader = new FileReader();
  
             reader.onload = function (e) {
              var html = '<img src="'+e.target.result+'">';
              $('.uploadedpic').html(html);
             };
            console.log(input.files[0]);
             reader.readAsDataURL(input.files[0]);
         }
     }
      function saveValues(){
                 var c_id = window.location.href.split('/').pop();
if(c_id.split('#')[0] != 'viewProfile'){
        $('#service_div').empty();
 //inputData.append('company_id',c_id.split('#')[0])
           $.ajax({
          url:'/getmyservices?company_id='+c_id.split('#')[0],
          type:'GET',
          beforeSend: function () {
             $('.loader').show();
           },
           complete: function () {
             $('.loader').hide();
           },
          success: function (response) { 
                  $('#service_div').html(response);
            }
        });
}
  }
  
  </script>
<script>
  
   


      $(document).ready(function(){
      $('.mymodalclose2').click(function(){
          $('.modal').modal('hide');
      })
      });
  
    
          // remove form field values
          
        // });
      
  
  /*
  function initialize() {
    geocoder = new google.maps.Geocoder();
    map = new google.maps.Map(document.getElementById('map_canvas'), {
    center: new google.maps.LatLng(37.23032838760389, -118.65234375),
    zoom: 6,
    mapTypeId: google.maps.MapTypeId.ROADMAP
  });
  
  layer = new google.maps.FusionTablesLayer(tableid);
  layer.setQuery("SELECT 'geometry' FROM " + tableid);
  layer.setMap(map);
  
  
  
  google.maps.event.addListener(map, "bounds_changed", function() {
    displayZips();
  });
  google.maps.event.addListener(map, "zoom_changed", function() {
    if (map.getZoom() < 11) {
      for (var i=0; i<labels.length; i++) {
        labels[i].setMap(null);
      }
    }
  });
  }*/

 
 
  
  function showEditDate() {
  $("#editDateDiv").toggle();
  $("#hoursshow").hide();
  }
  
  function hideEditDate() {
  $("#editDateDiv").hide();
  }
  function hidehoursshow(){
  $('#hoursshow').hide();
  }
  function hoursshow(){
  $('#hoursshow').toggle();
  $("#editDateDiv").hide();
  }
  
  
  
</script>
<style>
.tooltip {
 position: relative !important;
    opacity: 1;
    z-index: 10 !important;
    display: inline-block;
    font-size: 15px;
    background: #f53b49;
    border-radius: 100%;
    width: 20px;
    height: 20px;
    text-align: center;
    margin-left: 9px;
    color: #fff;
}

.tooltip .tooltiptext {
  visibility: hidden;
    width: 300px !important;
    font-size: 12px;
    background-color: black;
    color: #e8e8e8 !important;
    text-align: center;
    border-radius: 6px;
    padding: 7px 9px;
    position: absolute;
    z-index: 1;
    top: -40px;
    left: 25px !important;
}

.tooltip .tooltiptext::after {
  content: "";
  position: absolute;
  top: 50%;
  right: 100%;
  margin-top: -5px;
  border-width: 5px;
  border-style: solid;
  border-color: transparent black transparent transparent;
}
.tooltip:hover .tooltiptext {
  visibility: visible;
}
</style>