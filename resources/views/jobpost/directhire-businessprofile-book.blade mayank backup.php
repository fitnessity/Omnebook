@extends('layouts.app')

@section('content')

<section class="direc-hire">

  @include('includes.search_category_sidebar')

  <div class="direc-right">
    <h1> Book Professional</h1>
      <div class="business-offer-main">
        <div class="network_block nw-profile_block">
          <div class="busines-offer-list busines-off-profile-list">
            <div class="job_block">
              {!! Form::open(array('id' => 'frmBookingDetail')) !!}
              <input type="hidden" name="_token" id="token" value="{{csrf_token()}}">
              <input type="hidden" name="professional_id" value="{{ $UserProfileDetail['id'] }}">

              <div id='systemMessage_booking'></div>

              <div class="row">
                  <div class="nw-user-detail-block">                  
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 nw-user-detail profiledetail">
                      <?php
                        $selected_sport = null;
                        $user = getLoggedInUser();
                        
                        if(Session::has('selected_sport'))
                            $selected_sport = Session::get('selected_sport');
                        ?>
                        <div class="select-style review-select2">

                        <select name="sport" id="frm_sport" class="selectpicker">
                          <option value="">Select Sport</option>
                          <?php 
                            ksort($userSport);
                            foreach ($userSport as $sportKey => $sportValue) {
                                if(@count(@$sportValue['child']) > 0){
                                  asort($sportValue['child']);
                                  echo "<optgroup label='".$sportKey."'>";
                                    foreach ($sportValue['child'] as $key => $value) {
                                      echo "<option value='$key'";
                                      if($selected_sport == $key) echo 'selected';
                                      echo ">$value</option>";  
                                    }
                                  echo "</optgroup>";
                                } else {
                                  foreach ($sportValue['self'] as $key1 => $value1) {
                                    echo "<option value='$key1'";
                                    if($selected_sport == $key1) echo 'selected';
                                    echo ">".$value1."</option>";
                                  }
                                }
                            }
                          ?>
                        </select>
                        </div>
                        <div class="emplouyee-form" style="width:100%">
                          <textarea name="booking_detail" id="frm_booking_detail" placeholder="Description"></textarea>
                        </div>
                        <p id="showSportPrice" style="display: none;"> 
                          Sport Price : <span id="sportPrice"></span>
                            <input type="hidden" id="sportPriceVal" name="sportPriceVal">
                            <input type="hidden" id="scheduleHoursVal" name="scheduleHoursVal">
                        </p>
                        
                      <div class="social-connect">
                          <div class="row">
                              <div class="form-control">
                                <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                                  <label>Name</label>
                                </div>
                                <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
                                  <input type="text" disabled="disabled" value="{{ Auth::user()->firstname. ' ' . Auth::user()->lastname }}" name="h_name" id="h_name" class="form-control"/>
                                </div>
                              </div>
                              <div class="form-control">
                                <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                                  <label>Email</label>
                                </div>
                                <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
                                  <input type="text" disabled="disabled" value="{{ Auth::user()->email }}"  name="h_email" id="h_email" class="form-control"/>
                                </div>
                              </div>
                              <div class="form-control">
                                <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                                  <label>Phone Number</label>
                                </div>
                                <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
                                  <input type="text" disabled="disabled" value="{{ Auth::user()->phone_number }}" name="h_phone" id="h_phone" class="form-control"/>
                                </div>
                              </div>
                          </div>
                        </div>
                    </div>
                    <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
                        <div style="float:right;">
                            <h4>My Availability : </h4>
                            <div class="select-schedule">
                              <div id="businessHoursContainer" class="text-center" ></div>
                            </div>
                        </div>
                    </div>                      
                  </div>
                  @if(Auth::User()->id != $user_id)
                  <div class="emplouyee-form">
                      <button class="btn btn-primary" id="submit_bookingdetail" >Submit</button>
                  </div>
                  @endif
                  {!! Form::close() !!}
              </div>
            </div>
          </div>
          
          <div class="clearfix"></div>

          <div class="row">
              <div class="nw-user-detail-block">
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 text-center">
                  <div class="nw-user-img">
                    <?php
                    if($UserProfileDetail['profile_pic'] != '' && file_exists(public_path().DIRECTORY_SEPARATOR.'uploads'.DIRECTORY_SEPARATOR.'profile_pic'.DIRECTORY_SEPARATOR.'thumb'.DIRECTORY_SEPARATOR.$UserProfileDetail['profile_pic'])) {
                      echo '<img src="'.Config::get('constants.USER_IMAGE_THUMB').$UserProfileDetail['profile_pic'].'" width="254" height="275" id="display_user_profile_pic" />';
                    }
                    else {
                      echo '<img src="'.Config::get('constants.FRONT_IMAGE').'user.png" width="254" height="275" id="display_user_profile_pic" />';
                    }
                    ?>
                  </div>
                </div>

                <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12 nw-user-detail profiledetail">
                  <h1 class="nw-user-nm">{{ $UserProfileDetail['firstname']." ".$UserProfileDetail['lastname'] }}</h1>
                  <p>Lobortis nisl ut aliquip ex ea commodo  Duis autem vel eum iriure 
                    dolor in hendrerit in vulputate velit esse molestie consequat </p>
                  <div class="nw-user-edit profiledetail">
                    <div class="nw-dtl-edit">
                      <span class="nw-label">Company Name:</span>
                      <span id="display_user_company">{{ $UserProfileDetail['company_name'] }}</span>
                    </div>
                    <div class="nw-dtl-edit">
                      <span class="nw-label">Name:</span>
                      <span id="display_user_name">{{ $UserProfileDetail['firstname'] }} {{ $UserProfileDetail['lastname']}}</span>
                    </div>
                    <div class="nw-dtl-edit">
                      <span class="nw-label">Gender:</span>
                      <span id="display_user_name">{{ $UserProfileDetail['gender'] }}</span>
                    </div>
                    <div class="nw-dtl-edit">
                      <span class="nw-label">Email : </span><span>{{ $UserProfileDetail['email'] }}</span>
                    </div>
                    <div class="nw-dtl-edit">
                      <span class="nw-label" id="display_user_phone">Phone : </span><span>{{ $UserProfileDetail['phone_number'] }}</span>
                    </div>
                    <div class="nw-dtl-edit">
                      <span class="nw-label">Address :  </span>
                      <span class="nw-detail-txt" id="display_user_address">
                        {{ $UserProfileDetail['address'] }}
                        <br>
                        {{ $UserProfileDetail['cities']['city_name'] }}, {{ $UserProfileDetail['states']['state_name'] }} {{ $UserProfileDetail['zipcode'] }}
                        <br>
                        {{ $UserProfileDetail['countries']['country_name'] }}                  
                        <div class="clearfix"></div>
                        <a href="#"><i class="fa fa-phone"></i></a><a href="#"><i class="fa fa-map-marker"></i></a><a href="#"><i class="fa fa-envelope"></i></a>
                      </span>
                    </div>          
                  </div>
                </div>
              </div>
          </div>          
     <br><br><br>
    

   

<!-- formstep1 START -->
<div id="formstep1">
  <div class="row">
    <div class="col-md-2">
      <p class="stripetext">1. Service</p>
      <div class="formstrip strip1"></div>
    </div>
    <div class="col-md-2">
      <p class="stripetext">2. Time</p>
      <div class="formstrip strip2" style="background: #d9d9d9!important;"></div>
    </div>
    <div class="col-md-2">
      <p class="stripetext">3. Cart</p>
      <div class="formstrip strip3" style="background: #d9d9d9!important;"></div>
    </div>
    <div class="col-md-2">
      <p class="stripetext">4. Details</p>
      <div class="formstrip strip4" style="background: #d9d9d9!important;"></div>
    </div>
    <div class="col-md-2">
      <p class="stripetext">5. Payment</p>
      <div class="formstrip strip5" style="background: #d9d9d9!important;"></div>
    </div>
    <div class="col-md-2">
      <p class="stripetext">6. Done</p>
      <div class="formstrip strip6" style="background: #d9d9d9!important;"></div>
    </div>
  </div>
<br>
<p class="step_para">Please select from services this provider offers.</p>
<br>
<div class="row">
  <div class="col-md-4">
    <div class="form-group">
       <label for="sel1" style="color: #f53b49;">Select Catagory</label>
      <select class="form-control" id="sel1" name="sellist1">
        <option>Choose Activity</option>
        <option>2</option>
        <option>3</option>
        <option>4</option>
      </select>
    </div>
  </div>
  <div class="col-md-4">
     <div class="form-group">
       <label for="sel1" style="color: #f53b49;">Service Choice</label>
      <select class="form-control" id="sel1" name="sellist1">
        <option>Select Service</option>
        <option>2</option>
        <option>3</option>
        <option>4</option>
      </select>
    </div>
  </div>
  <div class="col-md-4">
     <div class="form-group">
       <label for="sel1" style="color: #f53b49;">Number of Persons</label>
      <select class="form-control" id="sel1" name="sellist1">
        <option>1</option>
        <option>2</option>
        <option>3</option>
        <option>4</option>
      </select>
    </div>
  </div>
</div>
<br>
<div class="row">
  <div class="col-md-3">
     <div class="form-group">
      <label for="email">I'm available on or after</label>
      <input type="text" class="form-control" id="usr" name="username" placeholder="April 13, 2018">
    </div>
  </div>

  <div class="col-md-3" style="margin-left: -29px;">
    <div class="row">
      <div class="col-md-1">
        <div class="form-group">
          <h5><b>Sun</b></h5>
          <label class="container Daysss">
  <input type="checkbox" checked="checked">
  <span class="checkmark"></span>
</label>          
        </div>
      </div>
      <div class="col-md-1">
        <div class="form-group">
          <h5><b>Mon</b></h5>
          <label class="container Daysss">
  <input type="checkbox" checked="checked">
  <span class="checkmark"></span>
</label>       
        </div>
      </div>
      <div class="col-md-1">
        <div class="form-group">
          <h5><b>Tue</b></h5>
          <label class="container Daysss">
  <input type="checkbox" checked="checked">
  <span class="checkmark"></span>
</label>       
        </div>
      </div>
      <div class="col-md-1">
        <div class="form-group">
          <h5><b>Wed</b></h5>
          <label class="container Daysss">
  <input type="checkbox" checked="checked">
  <span class="checkmark"></span>
</label>       
          
        </div>
      </div>
      <div class="col-md-1">
        <div class="form-group">
          <h5><b>Thu</b></h5>
          <label class="container Daysss">
  <input type="checkbox" checked="checked">
  <span class="checkmark"></span>
</label>       
          
        </div>
      </div>
      <div class="col-md-1">
        <div class="form-group">
         <h5><b>Fri</b></h5>
          <label class="container Daysss">
  <input type="checkbox" checked="checked">
  <span class="checkmark"></span>
</label>       
          
        </div>
      </div>
      <div class="col-md-1">
        <div class="form-group">
          <h5><b>Sat</b></h5>
          <label class="container Daysss">
  <input type="checkbox" checked="checked">
  <span class="checkmark"></span>
</label>       
          
        </div>
      </div>
    </div>
  </div>




  <div class="col-md-2">
    <div class="form-group">
       <label for="sel1">Start From</label>
      <select class="form-control" id="sel1" name="sellist1">
        <option>8:00 am</option>
        <option>2</option>
        <option>3</option>
        <option>4</option>
      </select>
    </div>
  </div>
  <div class="col-md-2">
    <div class="form-group">
       <label for="sel1">Finish by</label>
      <select class="form-control" id="sel1" name="sellist1">
        <option>6:00 pm</option>
        <option>2</option>
        <option>3</option>
        <option>4</option>
      </select>
    </div>
  </div>
  <div class="col-md-2">
    <div class="form-group">
      <label for="email" style="color: #f53b49;">Who is Training</label>
      <input type="text" class="form-control" id="usr" name="username">
    </div>
  </div
></div>

<hr>
<a href="#"style="float: left;"><div class="step1_days" style="text-align: center;padding: 8px 4px;"><i class='fas fa-cart-arrow-down' style="color: #fff"></i></div></a>
<button type="button" class="stepbtn" href="#" onclick="$('#formstep1').hide();$('#formstep2').show();" style="float: right;">NEXT</button>
</div>
<!-- formstep1 END -->








<!-- formstep2 START -->
<div id="formstep2" style="display: none;">
  <div class="row">
    <div class="col-md-2">
      <p class="stripetext">1. Service</p>
      <div class="formstrip strip1"></div>
    </div>
    <div class="col-md-2">
      <p class="stripetext">2. Time</p>
      <div class="formstrip strip2"></div>
    </div>
    <div class="col-md-2">
      <p class="stripetext">3. Cart</p>
      <div class="formstrip strip3" style="background: #d9d9d9!important;"></div>
    </div>
    <div class="col-md-2">
      <p class="stripetext">4. Details</p>
      <div class="formstrip strip4" style="background: #d9d9d9!important;"></div>
    </div>
    <div class="col-md-2">
      <p class="stripetext">5. Payment</p>
      <div class="formstrip strip5" style="background: #d9d9d9!important;"></div>
    </div>
    <div class="col-md-2">
      <p class="stripetext">6. Done</p>
      <div class="formstrip strip6" style="background: #d9d9d9!important;"></div>
    </div>
  </div>
<br>
<p class="step_para">Below you can find list of available time slots for {service_name} with {business_name}.</p>
<p class="step_para">Click on a time slot to proceed with the booking.</p>
<br>
<p style="color: #f53b49;font-weight: bold;">The selected time is not available anymore. Please, choose another time slot.</p>
<br>
<div class="form-group" style="width: 25%;">
      <select class="form-control" id="sel1" name="sellist1">
        <option>UTC+0</option>
        <option>2</option>
        <option>3</option>
        <option>4</option>
      </select>
    </div>
<!-- Table Start -->
<div class="step2_table">
  <table class="table table-bordered">
    <thead>
      <tr>
        <th>Fri, Apr 13</th>
        <th>Sat, Apr 14</th>
        <th>Sun, Apr 15</th>
        <th>Mon, Apr 16</th>
        <th>Tue, Apr 17</th>
        <th>Wed, Apr 18</th>
        <th>Thu, Apr 19</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td class="line_through"><input type="radio" class="form-check-input" value=""> 8:00 am</td>
        <td><input type="radio" class="form-check-input" value=""> 9:00 am</td>
        <td><input type="radio" class="form-check-input" value=""> 10:00 am</td>
        <td><input type="radio" class="form-check-input" value=""> 8:00 am</td>
        <td><input type="radio" class="form-check-input" value=""> 9:00 am</td>
        <td><input type="radio" class="form-check-input" value=""> 10:00 am</td>
        <td><input type="radio" class="form-check-input" value=""> 10:00 am</td>
      </tr>
      <tr>
        <td><input type="radio" class="form-check-input" value=""> 8:00 am</td>
        <td><input type="radio" class="form-check-input" value=""> 9:00 am</td>
        <td class="line_through"><input type="radio" class="form-check-input" value=""> 10:00 am</td>
        <td><input type="radio" class="form-check-input" value=""> 8:00 am</td>
        <td><input type="radio" class="form-check-input" value=""> 9:00 am</td>
        <td><input type="radio" class="form-check-input" value=""> 10:00 am</td>
        <td><input type="radio" class="form-check-input" value=""> 10:00 am</td>
      </tr>
      <tr>
       <tr>
        <td><input type="radio" class="form-check-input" value=""> 8:00 am</td>
        <td><input type="radio" class="form-check-input" value=""> 9:00 am</td>
        <td><input type="radio" class="form-check-input" value=""> 10:00 am</td>
        <td><input type="radio" class="form-check-input" value=""> 8:00 am</td>
        <td><input type="radio" class="form-check-input" value=""> 9:00 am</td>
        <td><input type="radio" class="form-check-input" value=""> 10:00 am</td>
        <td><input type="radio" class="form-check-input" value=""> 10:00 am</td>
      </tr>
      <tr>
        <td><input type="radio" class="form-check-input" value=""> 8:00 am</td>
        <td><input type="radio" class="form-check-input" value=""> 9:00 am</td>
        <td><input type="radio" class="form-check-input" value=""> 10:00 am</td>
        <td><input type="radio" class="form-check-input" value=""> 8:00 am</td>
        <td><input type="radio" class="form-check-input" value=""> 9:00 am</td>
        <td><input type="radio" class="form-check-input" value=""> 10:00 am</td>
        <td><input type="radio" class="form-check-input" value=""> 10:00 am</td>
      </tr>
      <tr>
        <td><input type="radio" class="form-check-input" value=""> 8:00 am</td>
        <td><input type="radio" class="form-check-input" value=""> 9:00 am</td>
        <td><input type="radio" class="form-check-input" value=""> 10:00 am</td>
        <td><input type="radio" class="form-check-input" value=""> 8:00 am</td>
        <td><input type="radio" class="form-check-input" value=""> 9:00 am</td>
        <td><input type="radio" class="form-check-input" value=""> 10:00 am</td>
        <td class="line_through"><input type="radio" class="form-check-input" value=""> 10:00 am</td>
      </tr>
      <tr>
        <td><input type="radio" class="form-check-input" value=""> 8:00 am</td>
        <td><input type="radio" class="form-check-input" value=""> 9:00 am</td>
        <td><input type="radio" class="form-check-input" value=""> 10:00 am</td>
        <td><input type="radio" class="form-check-input" value=""> 8:00 am</td>
        <td><input type="radio" class="form-check-input" value=""> 9:00 am</td>
        <td><input type="radio" class="form-check-input" value=""> 10:00 am</td>
        <td><input type="radio" class="form-check-input" value=""> 10:00 am</td>
      </tr>
    </tbody>
  </table>
</div>
<!-- Table End -->

  <hr>
  <button type="button" class="stepbtn" href="#" onclick="$('#formstep1').show();$('#formstep2').hide();" style="float: left;">BACK</button> <a href="#"style="float: left;"><div class="step1_days" style="text-align: center;padding: 8px 4px;margin-left: 10px;"><i class='fas fa-cart-arrow-down' style="color: #fff"></i></div></a>
  <button type="button" class="stepbtn" href="#" onclick="$('#formstep2').hide();$('#formstep3').show();" style="float: right;">NEXT</button>
</div>
<!-- formstep2 END -->









<!-- formstep3 START -->
<div id="formstep3" style="display: none;">
  <div class="row">
    <div class="col-md-2">
      <p class="stripetext">1. Service</p>
      <div class="formstrip strip1"></div>
    </div>
    <div class="col-md-2">
      <p class="stripetext">2. Time</p>
      <div class="formstrip strip2"></div>
    </div>
    <div class="col-md-2">
      <p class="stripetext">3. Cart</p>
      <div class="formstrip strip3"></div>
    </div>
    <div class="col-md-2">
      <p class="stripetext">4. Details</p>
      <div class="formstrip strip4" style="background: #d9d9d9!important;"></div>
    </div>
    <div class="col-md-2">
      <p class="stripetext">5. Payment</p>
      <div class="formstrip strip5" style="background: #d9d9d9!important;"></div>
    </div>
    <div class="col-md-2">
      <p class="stripetext">6. Done</p>
      <div class="formstrip strip6" style="background: #d9d9d9!important;"></div>
    </div>
  </div>
<br>
<p class="step_para">Below you can find a list of the services you have selected for booking. Click BOOK MORE if you want to add more services.</p>
<p>The highlighted time is not available anymore. Please, choose another time slot.</p>
<br>
<button type="button" class="step3_bookmmore_btn" href="#">BOOK MORE</button>
<br><br>
<table class="table">
    <thead>
      <tr>
        <th>Service Choice</th>
        <th>Date</th>
        <th>Time</th>
        <th>Number of Persons</th>
        <th>Price</th>
        <th></th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td>Crown and Bridge</td>
        <td>April 15, 2018</td>
        <td>8:00 am</td>
        <td>Nick Knight</td>
        <td>$350.00</td>
        <td>
          <a href="#"><div class="step1_days" style="text-align: center;padding: 8px 4px;"><i class='fas fa-pencil-alt' style="color: #fff"></i></div></a>
        </td>
        <td>
          <a href="#"><div class="step1_days" style="text-align: center;padding: 8px 4px;"><i class='far fa-trash-alt' style="color: #fff"></i></div></a>
        </td>
      </tr>
      <tr>
        <td>Teeth Whitening</td>
        <td>April 16, 2018</td>
        <td>4.00 pm</td>
        <td>Wayne Turner</td>
        <td>$400.00</td>
        <td>
          <a href="#"><div class="step1_days" style="text-align: center;padding: 8px 4px;"><i class='fas fa-pencil-alt' style="color: #fff"></i></div></a>
        </td>
        <td>
          <a href="#"><div class="step1_days" style="text-align: center;padding: 8px 4px;"><i class='far fa-trash-alt' style="color: #fff"></i></div></a>
        </td>
      </tr>
      <tr>
        <td><b>Total:</b></td>
        <td></td>
        <td></td>
        <td></td>
        <td><b>$750.00</b></td>
        <td></td>
      </tr>
    </tbody>
  </table>
<hr>
  <button type="button" class="stepbtn" href="#" onclick="$('#formstep2').show();$('#formstep3').hide();" style="float: left;">BACK</button>
  <button type="button" class="stepbtn" href="#" onclick="$('#formstep3').hide();$('#formstep4').show();" style="float: right;">NEXT</button>
</div>
<!-- formstep3 END -->










<!-- formstep4 START -->
<div id="formstep4" style="display: none;">
   <div class="row">
    <div class="col-md-2">
      <p class="stripetext">1. Service</p>
      <div class="formstrip strip1"></div>
    </div>
    <div class="col-md-2">
      <p class="stripetext">2. Time</p>
      <div class="formstrip strip2"></div>
    </div>
    <div class="col-md-2">
      <p class="stripetext">3. Cart</p>
      <div class="formstrip strip3"></div>
    </div>
    <div class="col-md-2">
      <p class="stripetext">4. Details</p>
      <div class="formstrip strip4"></div>
    </div>
    <div class="col-md-2">
      <p class="stripetext">5. Payment</p>
      <div class="formstrip strip5" style="background: #d9d9d9!important;"></div>
    </div>
    <div class="col-md-2">
      <p class="stripetext">6. Done</p>
      <div class="formstrip strip6" style="background: #d9d9d9!important;"></div>
    </div>
  </div>
<br>
<p class="step_para">You selected to book {service_name} with {business_name} at {service_time} on {service_date}. Price for the service is {service_price}.</p>
<p class="step_para">Please provide your details in the form below to proceed with the booking.</p>
<br>
<div class="row">
  <div class="col-md-6">
    <div class="form-group">
      <label for="F_name" style="color: #f53b49;">First Name:</label>
      <input type="text" class="form-control" id="usr" name="username">
    </div>
  </div>
  <div class="col-md-6">
     <div class="form-group">
      <label for="l_name" style="color: #f53b49;">Last Name:</label>
      <input type="text" class="form-control" id="usr" name="username">
    </div>
  </div>
  <div class="col-md-6">
     <div class="form-group">
      <label for="phone" style="color: #f53b49;">Phone:</label>
      <input type="text" class="form-control" id="usr" name="username">
    </div>
  </div>
  <div class="col-md-6">
     <div class="form-group">
      <label for="email" style="color: #f53b49;">Email:</label>
      <input type="text" class="form-control" id="usr" name="username">
    </div>
  </div>
  <div class="col-md-12">
     <div class="form-group">
      <label for="email" style="color: #f53b49;">Notes (medical issue, request, etc.)</label>
      <textarea class="form-control" rows="5" id="comment"></textarea>
    </div>
  </div>
</div>
<hr>
  <button type="button" class="stepbtn" href="#" onclick="$('#formstep3').show();$('#formstep4').hide();" style="float: left;">BACK</button>
  <button type="button" class="stepbtn" href="#" onclick="$('#formstep4').hide();$('#formstep5').show();" style="float: right;">NEXT</button>
</div>
<!-- formstep4 END -->













<!-- formstep5 START -->
<div id="formstep5" style="display: none;">
  <div class="row">
    <div class="col-md-2">
      <p class="stripetext">1. Service</p>
      <div class="formstrip strip1"></div>
    </div>
    <div class="col-md-2">
      <p class="stripetext">2. Time</p>
      <div class="formstrip strip2"></div>
    </div>
    <div class="col-md-2">
      <p class="stripetext">3. Cart</p>
      <div class="formstrip strip3"></div>
    </div>
    <div class="col-md-2">
      <p class="stripetext">4. Details</p>
      <div class="formstrip strip4"></div>
    </div>
    <div class="col-md-2">
      <p class="stripetext">5. Payment</p>
      <div class="formstrip strip5"></div>
    </div>
    <div class="col-md-2">
      <p class="stripetext">6. Done</p>
      <div class="formstrip strip6" style="background: #d9d9d9!important;"></div>
    </div>
  </div>
<br>
  <p class="step_para">Please tell us how you would like to pay:</p>
<br>
  <div class="form-check">
  <label class="form-check-label" style="color: #5f5d5d !important;">
    <input type="radio" class="form-check-input" name="optradio"> &nbsp; I will pay locally
  </label>
</div>
<div class="form-check">
  <label class="form-check-label" style="color: #5f5d5d !important;">
    <input type="radio" class="form-check-input" name="optradio"> &nbsp; I will pay now with PayPal &nbsp; <img src="https://cdn.clipart.email/e4884d00f7ccaad754a2c76cd973e1ae_paypal-donate-button-png-photos-png-mart_400-400.png" width="45px;">
  </label>
</div>
<hr>
  <button type="button" class="stepbtn" href="#" onclick="$('#formstep4').show();$('#formstep5').hide();" style="float: left;">BACK</button>
  <button type="button" class="stepbtn" href="#" onclick="$('#formstep5').hide();$('#formstep6').show();" style="float: right;">NEXT</button>
</div>
<!-- formstep5 END -->











<!-- formstep6 START -->
<div id="formstep6" style="display: none;">
  <div class="row">
    <div class="col-md-2">
      <p class="stripetext">1. Service</p>
      <div class="formstrip strip1"></div>
    </div>
    <div class="col-md-2">
      <p class="stripetext">2. Time</p>
      <div class="formstrip strip2"></div>
    </div>
    <div class="col-md-2">
      <p class="stripetext">3. Cart</p>
      <div class="formstrip strip3"></div>
    </div>
    <div class="col-md-2">
      <p class="stripetext">4. Details</p>
      <div class="formstrip strip4"></div>
    </div>
    <div class="col-md-2">
      <p class="stripetext">5. Payment</p>
      <div class="formstrip strip5"></div>
    </div>
    <div class="col-md-2">
      <p class="stripetext">6. Done</p>
      <div class="formstrip strip6"></div>
    </div>
  </div>
<br>
<p class="step_para">Thank You! Your secure online booking with fitnessity is complete. an email with details of your booking has been sent to you and {business_name}.</p>

<hr>
  <button type="button" class="stepbtn" href="#" onclick="$('#formstep5').show();$('#formstep6').hide();" style="float: left;">BACK</button>
  <!-- <button type="button" class="stepbtn" href="#" onclick="$('#formstep2').hide();$('#formstep3').show();" style="float: right;">NEXT</button> -->
</div>
<!-- formstep6 END -->

</div>
</div>
  </div>   












  <link href="http://cdnjs.cloudflare.com/ajax/libs/jquery-timepicker/1.2.17/jquery.timepicker.min.css" rel="stylesheet">
  <link href="<?php echo Config::get('constants.FRONT_CSS'); ?>scheduleHours/jquery.businessHours.css" rel="stylesheet">
  <script src="<?php echo Config::get('constants.FRONT_JS'); ?>scheduleHours/jquery.businessHours.js"></script>
  <script src="http://cdnjs.cloudflare.com/ajax/libs/jquery-timepicker/1.2.17/jquery.timepicker.min.js"></script>
  <script src='https://kit.fontawesome.com/a076d05399.js'></script>

  <script>
    $(document).ready(function()
    {
      var priceChart = {};

      @if(is_array($userSpotPrice) && @count(@$userSpotPrice))
        priceChart = JSON.parse('<?php echo json_encode($userSpotPrice);?>');
      @endif

      console.log(priceChart);

      jQuery('.selectpicker').on('change', function()
      {
        var sportType = jQuery(this).val(),
            myPrice   = priceChart;
      
        if(myPrice[sportType] != null )
        {
          jQuery("#showSportPrice").show();
          jQuery("#sportPriceVal").val(myPrice[sportType]);
          jQuery("#sportPrice").html(myPrice[sportType]);
        }
        
      });

      var bHours =  $("#businessHoursContainer").businessHours({
                        postInit:function(){
                            $('.operationTimeFrom, .operationTimeTill').timepicker({
                                'timeFormat': 'h:i A',
                                'step': 15
                                });
                        },
                        dayTmpl:'<div class="dayContainer" style="width: 80px;">' +
                            '<div data-original-title="" class="colorBox"><input type="checkbox" class="invisible operationState"></div>' +
                            '<div class="weekday"></div>' +
                            '<div class="operationDayTimeContainer">' +
                            '<div class="operationTime input-group"><span class="input-group-addon"><i class="fa fa-sun-o"></i></span><input type="text" name="startTime" class="mini-time form-control operationTimeFrom" value=""></div>' +
                            '<div class="operationTime input-group"><span class="input-group-addon"><i class="fa fa-moon-o"></i></span><input type="text" name="endTime" class="mini-time form-control operationTimeTill" value=""></div>' +
                            '</div></div>'
                    });


      $(".modal").on("hidden.bs.modal", function(){
          $(this).validate().resetForm();
          $("#systemMessage_booking").html('');
          $("#frm_booking_detail").val('');
      });

      $('#frmBookingDetail').submit(function(e) 
      {
          e.preventDefault();

          var msg = '';
          var returnVal;
          returnVal = true;

        if($("#frm_sport").val().trim() == "") 
        {
          msg = 'Select Sport';
          returnVal = false;
        }

        if($("#frm_booking_detail").val().trim() == "") 
        {
          msg += '<br>Enter Description';
          returnVal = false;
        }

        if(!returnVal) {
          showSystemMessages('#systemMessage_booking', 'danger', msg);      
          return false;
        }

        var bHoursString = JSON.stringify(bHours.serialize());

        jQuery("#scheduleHoursVal").val(bHoursString);

        var formData = $("#frmBookingDetail").serialize();

        $.ajax({
                url:'/savedirecthirerequest',
                type:'POST',
                dataType: 'json',
                data:formData,
                beforeSend: function () {
                  $('#submit_bookingdetail').prop('disabled', true);
                  showSystemMessages('#systemMessage_booking', 'info', 'Please wait while we save your request.');
                },
                complete: function () {
                },
                success: function (response) {
                  console.log(response);
                      showSystemMessages('#systemMessage_booking', response.type, response.msg);
                      if(response.type == "success") {
                        $('#submit_bookingdetail').prop('disabled', true);                      
                        // $('#submit_bookingdetail').html('Booked');
                      }else {
                        $('#submit_bookingdetail').prop('disabled', false);
                      }
                }
          });
      });
    });
  </script>
</section>
@endsection
<style>
  button.stepbtn {
    color: #fff;
    background: #f53b49;
    border: 0;
    border-radius: 5px;
    width: 75px;
    padding: 6px;
    font-weight: 600;
    font-size: 14px;
}
.formstrip {
    background: #f53b49;
    height: 8px;
    border-radius: 6px;
}
.stripetext{
  color: #f53b49;
    font-weight: 600;
}
/*label {
    color: #f53b49;
}*/
.step_para{
  color: #5f5d5d;
    font-weight: 600;
}
.step1_days{
    border: 0px solid red;
    width: 30px;
    height: 30px;
    background: #f53b49;
    border-radius: 20px;
}
.col-md-1 {
    margin: 2px;
}
.step3_bookmmore_btn{
  color: #fff;
    background: #f53b49;
    border: 0;
    border-radius: 5px;
    padding: 7px 15px;
    font-weight: 600;
    font-size: 14px;
}
/* The container */
.Daysss {
  display: inline-block;
  position: relative;
  padding-left: 35px;
  margin-top: 10px !important;
  cursor: pointer;
  font-size: 22px;
  -webkit-user-select: none;
  -moz-user-select: none;
  -ms-user-select: none;
  user-select: none;
}

/* Hide the browser's default checkbox */
.Daysss input {
  position: absolute;
  opacity: 0;
  cursor: pointer;
  height: 0;
  width: 0;
}

/* Create a custom checkbox */
.checkmark {
  position: absolute;
  top: 0;
  left: 0;
  height: 30px;
  width: 30px;
  background-color: #eee;
  border-radius: 50px;
}

/* On mouse-over, add a grey background color */
.Daysss:hover input ~ .checkmark {
  background-color: #ccc;
}

/* When the checkbox is checked, add a blue background */
.Daysss input:checked ~ .checkmark {
  background-color: #f53b49;
}

/* Create the checkmark/indicator (hidden when not checked) */
.checkmark:after {
  content: "";
  position: absolute;
  display: none;
}

/* Show the checkmark when checked */
.Daysss input:checked ~ .checkmark:after {
  display: block;
}

/* Style the checkmark/indicator */
.Daysss .checkmark:after {
  left: 12px;
  top: 9px;
  width: 6px !important;
  height: 10px;
  border: solid white;
  border-width: 0 3px 3px 0;
  -webkit-transform: rotate(45deg);
  -ms-transform: rotate(45deg);
  transform: rotate(45deg);
}
.step2_table  th {
    background: #f53b49;
    color: #fff;
    text-align: center;
    font-size: 14px;
    font-weight: 500;
}
.step2_table tbody{
  text-align: center;
    font-size: 14px;
}
.line_through{
  text-decoration: line-through;
  color: #80808061;
}
</style>