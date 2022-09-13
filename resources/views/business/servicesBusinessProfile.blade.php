@extends('layouts.header')
@section('content')
@include('layouts.userHeader')

<?php @$hours = json_decode($service['serv_time_slot'], true); ?>

<div class="p-0 col-md-12 inner_top padding-0">
    <div class="row">

        @include('business.leftNavigation')

        <div class="col-md-10">


            <form name="creService" id="creService" method="post" action="{{route('addbusinessservices')}}">
                <div class="container-fluid p-0" id="detail-form7" style="display: none;">
                    <div class="tab-hed">Create Services & Prices</div>
                    <div style="background: black;width: 107%;margin-left: -38px;padding: 6px;">
                        <span class="nav-link1 subtab">INDEPENDENT</span>
                        <span class="nav-link1 subtab1">CLASSES</span>
                        <span class="nav-link1 subtab2">EXPERIENCES</span>
                    </div>
                    <section class="row">
                        <div class="col-md-12">
                            <br>
                            <div class="row">
                                <div class="col-md-8">
                                    <div class="row">
                                        <div class="form-group col-md-12">
                                            <label for="pwd">Setup the programs for your {kickboxing} service.<br>
                                                Let’s get a few detials about the program</label>
                                            <input type="text" class="form-control" name="frm_servicetitle" id="frm_servicetitle" placeholder="Enter Name of Program" title="servicetitle" value="" readonly>

                                        </div>
                                        <div class="form-group col-md-12">
                                            <textarea class="form-control" rows="6" name="frm_servicedesc" id="frm_servicedesc" placeholder="Enter program description"></textarea>
                                            <div class="text-right">150 Characters Left</div>
                                        </div>
                                        <div class="form-group col-md-12">
                                            <label class="switch" for="booking1">
                                                <input type="radio" name="booking" id="booking1">
                                                <span class="slider round"></span>
                                            </label>
                                            <span>INSTANT BOOKING : Allow customers to book you instantly</span>
                                        </div>
                                        <div class="form-group col-md-12">
                                            <label class="switch" for="booking2">
                                                <input type="radio" name="booking" id="booking2">
                                                <span class="slider round"></span>
                                            </label>
                                            <span>RESERVED BOOKING : You need to confirm each booking first before completion</span>
                                        </div>

                                        <div class="form-group col-md-12">
                                            <label>How much notice do you need for each booking ?</label>
                                        </div>

                                        <div class="form-group col-md-6">
                                            <?php $note = []; ?>
                                            <select class="form-control" name="notice_each_book_day" id="firstdayweek" rel="notice">
                                                <option hidden>Select Value</option>
                                                <option values="Days" @if(@array_key_exists("Days",$note)) selected @endif>Days</option>
                                                <option values="Weeks" @if(@array_key_exists("Weeks",$note)) selected @endif>Weeks</option>
                                                <option values="Months" @if(@array_key_exists("Months",$note)) selected @endif>Months</option>
                                            </select>

                                        </div>
                                        <div class="form-group col-md-6" id="notice_div">
                                            <select class="form-control" name="notice_each_book_ans" id="notice">
                                                <option hidden>Select Value</option>
                                                <option value="1">1</option>
                                                <option value="2">2</option>
                                                <option value="3">3</option>
                                                <option value="4">4</option>
                                                <option value="5">5</option>
                                                <option value="6">6</option>
                                                <option value="7">7</option>
                                                <option value="8">8</option>
                                                <option value="9">9</option>
                                                <option value="10">10</option>
                                                <option value="11">11</option>
                                                <option value="12">12</option>
                                                <option value="13">13</option>
                                                <option value="14">14</option>
                                                <option value="15">15</option>
                                                <option value="16">16</option>
                                                <option value="17">17</option>
                                                <option value="18">18</option>
                                                <option value="19">19</option>
                                                <option value="20">20</option>
                                                <option value="21">21</option>
                                                <option value="22">22</option>
                                                <option value="23">23</option>
                                                <option value="24">24</option>
                                                <option value="25">25</option>
                                                <option value="26">26</option>
                                                <option value="27">27</option>
                                                <option value="28">28</option>
                                                <option value="29">29</option>
                                                <option value="30">30</option>
                                                <option value="31">31</option>
                                            </select>
                                        </div>

                                        <script>
                                            $('#firstdayweek').change(function () {
                                                var t = $('#firstdayweek option:selected').val();
                                                var id = $('#firstdayweek').attr('rel');
                                                console.log(t, "---", id)
                                                if (t == 'Days') {
                                                    options_f(31, id);
                                                }
                                                if (t == 'Weeks') {
                                                    options_f(52, id);
                                                }
                                                if (t == 'Months') {
                                                    options_f(12, id);
                                                }
                                            });

                                        </script>
                                        <div class="form-group col-md-12">
                                            <label>How far in advance can a customer book ?</label>
                                        </div>
                                        <div class="form-group col-md-6">

                                            <?php $addv = []; ?>

                                            <select class="form-control" name="advance_book_day" id="secdayweek" rel="addvance" onchange="seconddayweek_change_event(this.value)">

                                                <option hidden>Select Value</option>
                                                <option values="Days" @if(@array_key_exists("Days",$addv)) selected @endif>Days</option>
                                                <option values="Weeks" @if(@array_key_exists("Weeks",$addv)) selected @endif>Weeks</option>
                                                <option values="Months" @if(@array_key_exists("Months",$addv)) selected @endif>Months</option>

                                            </select>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <select class="form-control" name="advance_book_ans" id="addvance">
                                                <option hidden>Select Value</option>
                                                <option value="1">1</option>
                                                <option value="2">2</option>
                                                <option value="3">3</option>
                                                <option value="4">4</option>
                                                <option value="5">5</option>
                                                <option value="6">6</option>
                                                <option value="7">7</option>
                                                <option value="8">8</option>
                                                <option value="9">9</option>
                                                <option value="10">10</option>
                                                <option value="11">11</option>
                                                <option value="12">12</option>
                                                <option value="13">13</option>
                                                <option value="14">14</option>
                                                <option value="15">15</option>
                                                <option value="16">16</option>
                                                <option value="17">17</option>
                                                <option value="18">18</option>
                                                <option value="19">19</option>
                                                <option value="20">20</option>
                                                <option value="21">21</option>
                                                <option value="22">22</option>
                                                <option value="23">23</option>
                                                <option value="24">24</option>
                                                <option value="25">25</option>
                                                <option value="26">26</option>
                                                <option value="27">27</option>
                                                <option value="28">28</option>
                                                <option value="29">29</option>
                                                <option value="30">30</option>
                                                <option value="31">31</option>
                                            </select>
                                        </div>

                                        <script>
                                            $('#secdayweek').change(function () {
                                                var t = $('#secdayweek option:selected').val();
                                                var id = $('#secdayweek').attr('rel');
                                                console.log(t, "---", id)
                                                if (t == 'Days') {
                                                    options_f(31, id);
                                                }
                                                if (t == 'Weeks') {
                                                    options_f(52, id);
                                                }
                                                if (t == 'Months') {
                                                    options_f(12, id);
                                                }
                                            });

                                        </script>

                                        <div class="form-group col-md-12">
                                            <label>What's the latest moment a person can book your activity?</label>
                                        </div>

                                        <div class="form-group col-md-6">
                                            <select class="form-control" name="c_notice_each_book_day" id="thirdminute" rel="minute">
                                                <option hidden>Select Value</option>
                                                <option values="Minute">Minute</option>
                                                <option values="Hours">Hours</option>
                                                <option values="Days">Days</option>
                                                <option values="Weeks">Weeks</option>
                                            </select>
                                        </div>

                                        <div class="form-group col-md-6">
                                            <select class="form-control" name="c_notice_each_book_ans" id="minute">
                                                <option hidden>Select Value</option>
                                                <option values="1">1</option>
                                                <option values="2">2</option>
                                                <option values="3">3</option>
                                                <option values="4">4</option>
                                                <option values="5">5</option>
                                                <option values="6">6</option>
                                                <option values="7">7</option>
                                                <option values="8">8</option>
                                                <option values="9">9</option>
                                                <option values="10">10</option>
                                                <option values="11">11</option>
                                                <option values="12">12</option>
                                                <option values="13">13</option>
                                                <option values="14">14</option>
                                                <option values="15">15</option>
                                                <option values="16">16</option>
                                                <option values="17">17</option>
                                                <option values="18">18</option>
                                                <option values="19">19</option>
                                                <option values="20">20</option>
                                                <option values="21">21</option>
                                                <option values="22">22</option>
                                                <option values="23">23</option>
                                                <option values="24">24</option>
                                                <option values="25">25</option>
                                                <option values="26">26</option>
                                                <option values="27">27</option>
                                                <option values="28">28</option>
                                                <option values="29">29</option>
                                                <option values="30">30</option>
                                                <option values="31">31</option>
                                            </select>
                                        </div>

                                        <script>
                                            $('#thirdminute').change(function () {
                                                var t = $('#thirdminute option:selected').val();
                                                var id = $('#thirdminute').attr('rel');
                                                console.log(t, "---", id)
                                                if (t == 'Minute') {
                                                    options_f(60, id);
                                                }
                                                if (t == 'Hours') {
                                                    options_f(24, id);
                                                }
                                                if (t == 'Days') {
                                                    options_f(31, id);
                                                }
                                                if (t == 'Weeks') {
                                                    options_f(52, id);
                                                }
                                            });

                                        </script>

                                        <div class="form-group col-md-12">
                                            <label>Whats th latest a customer can cancel?</label>
                                        </div>

                                        <div class="form-group col-md-6">
                                            <select class="form-control" name="c_advance_book_day" id="forthcancel" rel="forthcancel1">
                                                <option hidden>Select Value</option>
                                                <option>Hours</option>
                                                <option>Days</option>
                                                <option>Weeks</option>
                                                <option>Months</option>
                                            </select>
                                        </div>

                                        <div class="form-group col-md-6">
                                            <select class="form-control" name="c_advance_book_ans" id="forthcancel1">
                                                <option hidden>Select Value</option>
                                                <option value="1">1</option>
                                                <option value="2">2</option>
                                                <option value="3">3</option>
                                                <option value="4">4</option>
                                                <option value="5">5</option>
                                                <option value="6">6</option>
                                                <option value="7">7</option>
                                                <option value="8">8</option>
                                                <option value="9">9</option>
                                                <option value="10">10</option>
                                                <option value="11">11</option>
                                                <option value="12">12</option>
                                                <option value="13">13</option>
                                                <option value="14">14</option>
                                                <option value="15">15</option>
                                                <option value="16">16</option>
                                                <option value="17">17</option>
                                                <option value="18">18</option>
                                                <option value="19">19</option>
                                                <option value="20">20</option>
                                                <option value="21">21</option>
                                                <option value="22">22</option>
                                                <option value="23">23</option>
                                                <option value="24">24</option>
                                                <option value="25">25</option>
                                                <option value="26">26</option>
                                                <option value="27">27</option>
                                                <option value="28">28</option>
                                                <option value="29">29</option>
                                                <option value="30">30</option>
                                                <option value="31">31</option>
                                            </select>
                                        </div>
                                        <script>
                                            $('#forthcancel').change(function () {
                                                var t = $('#forthcancel option:selected').val();
                                                var id = $('#forthcancel').attr('rel');
                                                console.log(t, "---", id)
                                                if (t == 'Hours') {
                                                    options_f(24, id);
                                                }
                                                if (t == 'Days') {
                                                    options_f(31, id);
                                                }
                                                if (t == 'Weeks') {
                                                    options_f(52, id);
                                                }
                                                if (t == 'Months') {
                                                    options_f(12, id);
                                                }
                                            });

                                        </script>
                                    </div>
                                </div>

                                <div class="col-md-4 text-center">
                                    <div class="row">
                                        <div class="col-md-2"></div>
                                        <div class="col-md-8 imgUp">
                                            <div class="imagePreview"></div>
                                            <label class="img-tab-btn">Upload Image<input type="file" class="uploadFile img" value="Upload Photo" style="width: 0px;height: 0px;overflow: hidden;">
                                            </label>
                                            <label style="font-size: 12px;">Upload an image that best represents your program</label>
                                        </div><!-- col-2 -->
                                    </div><!-- row -->
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <br>
                            <div class="row">
                                <div class="col-md-6">
                                    <button type="button" class="btn-bck" id="bck-btn7"><i class="fa fa-arrow-left"></i> Back</button>
                                </div>
                                <div class="col-md-6 text-right">
                                    <button type="button" class="btn-nxt" id="btn-nxt8">Continue <i class="fa fa-arrow-right"></i></button>
                                </div>
                            </div>
                            <br>
                        </div>
                    </section>
                </div>

                <div class="container-fluid p-0" id="detail-form8" style="display: none;">
                    <div class="tab-hed">Create Services & Prices</div>
                    <div style="background: black;width: 107%;margin-left: -38px;padding: 6px;">
                        <span class="nav-link1 subtab">INDEPENDENT</span>
                        <span class="nav-link1 subtab1">CLASSES</span>
                        <span class="nav-link1 subtab2">EXPERIENCES</span>
                    </div>
                    <section class="row">
                        <br>
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-md-6 location_div">
                                    <div class="row">
                                        <div class="form-group col-md-12">
                                            <h3 style="font-size: 17px;font-weight: bold;">MORE DETAILS ABOUT YOUR SERVICES</h3>
                                            <div class="form-group">
                                                <label>Do you travel to clients to offer this service ? If yes, click yes to activate.</label><br>
                                                <input class="willing_to_travel" value="yes" type="radio" name="willing_to_travel" id="checkserviceyes" style="width: 25px;height: 25px;position: relative;top: 5px;">
                                                <span style="font-size: 20px;font-weight: bold;">Yes</span>
                                                <input class="willing_to_travel" value="no" type="radio" name="willing_to_travel" id="checkserviceno" style="width: 25px;height: 25px;position: relative;top: 5px;margin-left: 20px;">
                                                <span style="font-size: 20px;font-weight: bold;">No</span>
                                            </div>
                                            <div class="form-group" id="servicebox" style="display:block;">
                                                <label for="email">If yes, how far are you willing to travel out of your base zipcode ? Select the distance and check the map for reference of distance. </label>
                                                <!--<select class="form-control" name="travel_miles" id="milesnew">
                                                    <option value="1">1 Mile</option>
                                                    <option value="3">3 Miles</option>
                                                    <option value="5">5 Miles</option>
                                                    <option value="10">10 Miles</option>
                                                    <option value="15">15 Miles</option>
                                                    <option value="20">20 Miles</option>
                                                </select>-->
                                                <?php
                                                $miles_arr = array('1' => '1 Mile', '3' => '3 Miles', '5' => '5 Miles', '10' => '10 Miles', '15' => '15 Miles', '20' => '20 Miles');
                                                ?>
                                                <select class="form-control travel_miles_div" name="travel_miles" id="milesnew" disabled="disabled">
                                                    <option value="">Select Miles</option>
                                                    <?php foreach ($miles_arr as $key => $value) { ?>
                                                        <option value="<?php echo $key; ?>"><?php echo $value; ?></option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="where_do_you_work">
                                            <div class="col-md-6">
                                                <label>Where do you want to work ?</label>
                                                <input type="text" class="form-control" placeholder="Specific Area" readonly>
                                            </div>

                                            <!--<div class="col-md-6">
                                                <label>Distance</label>
                                                <input type="text" class="form-control" placeholder="Distance">
                                            </div>-->
                                        </div>

                                        <div class="map-block">
                                            <span class="travel_miles_div">
                                                <?php /* ?><p class="para-sec">If yes, how far are you willing to travel out of your base zipcode ? Select the distance and</p>
                                                  <div class="select-style">
                                                  <?php
                                                  $miles_arr = array('1'=>'1 Mile','3'=>'3 Miles','5'=>'5 Miles','10'=>'10 Miles','15'=>'15 Miles','20'=>'20 Miles');
                                                  ?>
                                                  <select class="selectpicker" name="travel_miles" id="milesnew">
                                                  <?php foreach($miles_arr as $key=>$value) { ?>
                                                  <option value="<?php echo $key; ?>"><?php echo $value; ?></option>
                                                  <?php } ?>
                                                  </select>
                                                  </div><?php */ ?>

                                                <div id="map_canvas"></div>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6  service_type">
                                    <br>
                                    <div class="row">
                                        <div class="form-group col-md-12">
                                            <label>Select Service Type</label>
                                            <select name="frm_servicetype[]" id="categ" multiple>
                                                <option>Personal Training</option>
                                                <option>Coaching</option>
                                                <option>Class</option>
                                                <option>Therapy</option>
                                                <option>Gym</option>
                                                <option>Adventure</option>
                                                <option>Trip</option>
                                                <option>Tour</option>
                                                <option>Camp</option>
                                                <option>Team</option>
                                                <option>Clinic</option>

                                            </select>

                                            <script>
                                                var p = new SlimSelect({
                                                    select: '#categ'
                                                });

                                            </script>



                                        </div>



                                        <div class="form-group col-md-12">
                                            <label>Location of Activity</label>
                                            <select name="frm_servicelocation[]" id="frm_servicelocation" multiple>

                                                <!--<option>Online</option>
                                                <option>Local Gym</option>
                                                <option>Studio</option>
                                                <option>Training Facility</option>
                                                <option>My Home/Apartment</option>
                                                <option>My Office</option>
                                                <option>Outside</option>
                                                <option>Recommended by Provider</option>
                                                <option>Any</option>-->
                                                <option>Online</option>
                                                <option>At Business</option>
                                                <option>On Location</option>

                                            </select>
                                            <script>
                                                var p = new SlimSelect({
                                                    select: '#frm_servicelocation'
                                                });

                                            </script>
                                        </div>
                                        <div class="form-group col-md-12">

                                            <label>Activity Great For</label>
                                            <select name="frm_programfor[]" id="frm_programfor" multiple>
                                                <option>Individual</option>
                                                <option>Kids</option>
                                                <option>Teens</option>
                                                <option>Adults</option>
                                                <option>Family</option>
                                                <option>Groups</option>
                                                <option>Any</option>
                                            </select>

                                            <script>
                                                var p = new SlimSelect({
                                                    select: '#frm_programfor'
                                                });

                                            </script>
                                        </div>
                                        <div class="form-group col-md-12">



                                            <label>Age Range</label>
                                            <select name="frm_agerange[]" id="frm_agerange" multiple>
                                                <option>Baby (0 to 12 months)</option>
                                                <option>Toddler (1 to 3 yrs.)</option>
                                                <option>Preschool (4 to 5 yrs.)</option>
                                                <option>Grade School (6 to 12 yrs.)</option>
                                                <option>Teen (13 to 17 yrs.)</option>
                                                <option>Young Adult (18 to 21 yrs.)</option>
                                                <option>Older Adult (21 to 39 yrs.)</option>
                                                <option>Middle Age (40 to 59 yrs.) </option>
                                                <option>Senior Adult (60 +)</option>
                                                <option>Any</option>
                                            </select>

                                            <script>
                                                var p = new SlimSelect({
                                                    select: '#frm_agerange'
                                                });

                                            </script>



                                        </div>



                                        <div class="form-group col-md-12">



                                            <label>Group Size</label>
                                            <select name="frm_numberofpeople[]" id="frm_numberofpeople">
                                                <option>1</option>
                                                <option>2</option>
                                                <option>3</option>
                                                <option>4</option>
                                                <option>5</option>
                                                <option>6</option>
                                                <option>7</option>
                                                <option>8</option>
                                                <option>9</option>
                                                <option>10</option>
                                                <option>15</option>
                                                <option>20</option>
                                                <option>25</option>
                                                <option>30</option>
                                                <option>35</option>
                                                <option>40</option>
                                                <option>45</option>
                                                <option>50</option>
                                                <option>55</option>
                                                <option>60</option>
                                                <option>65</option>
                                                <option>70</option>
                                                <option>75</option>
                                                <option>80</option>
                                                <option>85</option>
                                                <option>90</option>
                                                <option>95</option>
                                                <option>100</option>
                                            </select>

                                            <script>
                                                var p = new SlimSelect({
                                                    select: '#frm_numberofpeople'
                                                });

                                            </script>

                                        </div>



                                        <div class="form-group col-md-12">

                                            <label>Difficulty Level</label>
                                            <select name="frm_experience_level[]" id="frm_experience_level" multiple>

                                                <option>Beginner</option>
                                                <option>Intermediate</option>
                                                <option>Advanced</option>
                                                <option>Professional</option>
                                                <option>Expert</option>
                                                <option>Any</option>

                                            </select>

                                            <script>
                                                var p = new SlimSelect({
                                                    select: '#frm_experience_level'
                                                });

                                            </script>



                                        </div>



                                        <div class="form-group col-md-12">



                                            <label>Activity Experience</label>



                                            <select name="frm_servicefocuses[]" id="frm_servicefocuses" multiple>


                                                <option value="Have Fun"> Have Fun</option>
                                                <option value="Adventurous">Adventurous</option>
                                                <option value="Thrilling">Thrilling</option>
                                                <option value="Dangerous">Dangerous </option>
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
                                            <label>Personality & Habits of Instructor</label>
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
                        </div>
                        <div class="col-md-12">
                            <br>
                            <div class="row">
                                <div class="col-md-6">
                                    <button type="button" class="btn-bck" id="bck-btn8"><i class="fa fa-arrow-left"></i> Back</button>
                                </div>
                                <div class="col-md-6 text-right">
                                    <button type="button" class="btn-nxt" id="btn-nxt9">Continue <i class="fa fa-arrow-right"></i></button>
                                </div>
                            </div>
                            <br>
                        </div>
                    </section>
                </div>

                <div class="container-fluid p-0" id="detail-form9" style="display: none;">
                    <div class="tab-hed">Create Services & Prices</div>
                    <div style="background: black;width: 107%;margin-left: -38px;padding: 6px;">
                        <span class="nav-link1 subtab">INDEPENDENT</span>
                        <span class="nav-link1 subtab1">CLASSES</span>
                        <span class="nav-link1 subtab2">EXPERIENCES</span>
                    </div>
                    <section class="row">
                        <div class="col-md-12">
                            <div class="row" style="padding: 10px 100px;">
                                <div class="col-md-12 text-center">
                                    <h3 style="font-size: 17px;font-weight: bold;">ACTIVTIY SCHEDULER</h3>
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
                                            <!--<input type="text" readonly class="form-control" id="Startingval">-->
                                            <input type="text" readonly class="form-control frm_starting" name="starting" id="startingpicker">
                                            <script>
                                                $('#startingpicker').datepicker({
                                                    onSelect: function (dateText, inst) {
                                                        var date = $(this).datepicker('getDate');
                                                        //var date1 = $(this).datepicker.parseDate(inst.settings.dateFormat, dateText, inst.settings);
                                                        //console.log(date1);
                                                        var day = $.datepicker.formatDate('DD', date);
                                                        $('.mymy').show();
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

                                                        if ($("#frm_class_meets").val() == 'Weekly') {
                                                            $(".schedule_until_box").show()
                                                            if ($("#startingpicker").val() != '') {
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
                                                                if ($("#startingpicker").val() != '') {
                                                                    var day = moment($("#startingpicker").val(), 'MM-DD-YYYY').format('dddd')
                                                                    if (day == 'Monday') {
                                                                        $(".Monday").show()
                                                                        $(".Monday").addClass('day_circle_fill')
                                                                        $(".monday_start").show()
                                                                    }
                                                                    if (day == 'Tuesday') {
                                                                        $(".Tuesday").show()
                                                                        $(".Tuesday").addClass('day_circle_fill')
                                                                        $(".tuesday_start").show()
                                                                    }
                                                                    if (day == 'Wednesday') {
                                                                        $(".Wednesday").show()
                                                                        $(".Wednesday").addClass('day_circle_fill')
                                                                        $(".wednesday_start").show()
                                                                    }
                                                                    if (day == 'Thursday') {
                                                                        $(".Thrusday").show()
                                                                        $(".Thrusday").addClass('day_circle_fill')
                                                                        $(".thrusday_start").show()
                                                                    }
                                                                    if (day == 'Friday') {
                                                                        $(".Friday").show()
                                                                        $(".Friday").addClass('day_circle_fill')
                                                                        $(".friday_start").show()
                                                                    }
                                                                    if (day == 'Saturday') {
                                                                        $(".Saturday").show()
                                                                        $(".Saturday").addClass('day_circle_fill')
                                                                        $(".saturday_start").show()
                                                                    }
                                                                    if (day == 'Sunday') {
                                                                        $(".Sunday").show()
                                                                        $(".Sunday").addClass('day_circle_fill')
                                                                        $(".sunday_start").show()
                                                                    }
                                                                }
                                                            }
                                                        } else {
                                                            $(".schedule_until_box").hide()
                                                            if ($("#startingpicker").val() != '') {
                                                                var day = moment($("#startingpicker").val(), 'MM-DD-YYYY').format('dddd')
                                                                myday = moment($("#startingpicker").val(), 'MM-DD-YYYY').format('dddd')
                                                                if (day == 'Monday') {

                                                                    $('input[name="hours[sunday_start]"]').val('');
                                                                    $('input[name="hours[tuesday_start]"]').val('');
                                                                    $('input[name="hours[wednesday_start]"]').val('');
                                                                    $('input[name="hours[thrusday_start]"]').val('');
                                                                    $('input[name="hours[friday_start]"]').val('');
                                                                    $('input[name="hours[saturday_start]"]').val('');
                                                                    $('input[name="hours[sunday_end]"]').val('');
                                                                    $('input[name="hours[tuesday_end]"]').val('');
                                                                    $('input[name="hours[wednesday_end]"]').val('');
                                                                    $('input[name="hours[thrusday_end]"]').val('');
                                                                    $('input[name="hours[friday_end]"]').val('');
                                                                    $('input[name="hours[saturday_end]"]').val('');

                                                                    $(".monday_start").show();
                                                                    $(".tuesday_start").hide();
                                                                    $(".wednesday_start").hide();
                                                                    $(".thrusday_start").hide();
                                                                    $(".friday_start").hide();
                                                                    $(".saturday_start").hide();
                                                                    $(".sunday_start").hide();

                                                                    $(".Monday").show()
                                                                    $(".Monday").addClass('day_circle_fill');
                                                                    $(".Sunday").hide()
                                                                    $(".Tuesday").hide()
                                                                    $(".Wednesday").hide()
                                                                    $(".Thrusday").hide()
                                                                    $(".Friday").hide()
                                                                    $(".Saturday").hide()
                                                                }
                                                                if (day == 'Tuesday') {

                                                                    $('input[name="hours[sunday_start]"]').val('');
                                                                    $('input[name="hours[monday_start]"]').val('');
                                                                    $('input[name="hours[wednesday_start]"]').val('');
                                                                    $('input[name="hours[thrusday_start]"]').val('');
                                                                    $('input[name="hours[friday_start]"]').val('');
                                                                    $('input[name="hours[saturday_start]"]').val('');
                                                                    $('input[name="hours[sunday_end]"]').val('');
                                                                    $('input[name="hours[monday_end]"]').val('');
                                                                    $('input[name="hours[wednesday_end]"]').val('');
                                                                    $('input[name="hours[thrusday_end]"]').val('');
                                                                    $('input[name="hours[friday_end]"]').val('');
                                                                    $('input[name="hours[saturday_end]"]').val('');

                                                                    $(".monday_start").hide();
                                                                    $(".tuesday_start").show();
                                                                    $(".wednesday_start").hide();
                                                                    $(".thrusday_start").hide();
                                                                    $(".friday_start").hide();
                                                                    $(".saturday_start").hide();
                                                                    $(".sunday_start").hide();

                                                                    $(".Monday").hide()
                                                                    $(".Sunday").hide()
                                                                    $(".Tuesday").show()
                                                                    $(".Tuesday").addClass('day_circle_fill');
                                                                    $(".Wednesday").hide()
                                                                    $(".Thrusday").hide()
                                                                    $(".Friday").hide()
                                                                    $(".Saturday").hide()
                                                                }
                                                                if (day == 'Wednesday') {
                                                                    $(".sunday_start").hide();
                                                                    $(".tuesday_start").hide();
                                                                    $(".monday_start").hide();
                                                                    $(".thrusday_start").hide();
                                                                    $(".friday_start").hide();
                                                                    $(".saturday_start").hide();
                                                                    $('input[name="hours[sunday_start]"]').val('');
                                                                    $('input[name="hours[tuesday_start]"]').val('');
                                                                    $('input[name="hours[monday_start]"]').val('');
                                                                    $('input[name="hours[thrusday_start]"]').val('');
                                                                    $('input[name="hours[friday_start]"]').val('');
                                                                    $('input[name="hours[saturday_start]"]').val('');
                                                                    $('input[name="hours[sunday_end]"]').val('');
                                                                    $('input[name="hours[tuesday_end]"]').val('');
                                                                    $('input[name="hours[monday_end]"]').val('');
                                                                    $('input[name="hours[thrusday_end]"]').val('');
                                                                    $('input[name="hours[friday_end]"]').val('');
                                                                    $('input[name="hours[saturday_end]"]').val('');

                                                                    $(".monday_start").hide();
                                                                    $(".tuesday_start").hide();
                                                                    $(".wednesday_start").show();
                                                                    $(".thrusday_start").hide();
                                                                    $(".friday_start").hide();
                                                                    $(".saturday_start").hide();
                                                                    $(".sunday_start").hide();

                                                                    $(".Monday").hide()
                                                                    $(".Sunday").hide()
                                                                    $(".Tuesday").hide()
                                                                    $(".Wednesday").show()
                                                                    $(".Wednesday").addClass('day_circle_fill');
                                                                    $(".Thrusday").hide()
                                                                    $(".Friday").hide()
                                                                    $(".Saturday").hide()
                                                                }
                                                                if (day == 'Thursday') {
                                                                    $(".sunday_start").hide();
                                                                    $(".tuesday_start").hide();
                                                                    $(".wednesday_start").hide();
                                                                    $(".monday_start").hide();
                                                                    $(".friday_start").hide();
                                                                    $(".saturday_start").hide();
                                                                    $('input[name="hours[sunday_start]"]').val('');
                                                                    $('input[name="hours[tuesday_start]"]').val('');
                                                                    $('input[name="hours[wednesday_start]"]').val('');
                                                                    $('input[name="hours[monday_start]"]').val('');
                                                                    $('input[name="hours[friday_start]"]').val('');
                                                                    $('input[name="hours[saturday_start]"]').val('');
                                                                    $('input[name="hours[sunday_end]"]').val('');
                                                                    $('input[name="hours[tuesday_end]"]').val('');
                                                                    $('input[name="hours[wednesday_end]"]').val('');
                                                                    $('input[name="hours[monday_end]"]').val('');
                                                                    $('input[name="hours[friday_end]"]').val('');
                                                                    $('input[name="hours[saturday_end]"]').val('');

                                                                    $(".monday_start").hide();
                                                                    $(".tuesday_start").hide();
                                                                    $(".wednesday_start").hide();
                                                                    $(".thrusday_start").show();
                                                                    $(".friday_start").hide();
                                                                    $(".saturday_start").hide();
                                                                    $(".sunday_start").hide();

                                                                    $(".Monday").hide()
                                                                    $(".Sunday").hide()
                                                                    $(".Tuesday").hide()
                                                                    $(".Wednesday").hide()
                                                                    $(".Thrusday").show()
                                                                    $(".Thrusday").addClass('day_circle_fill');
                                                                    $(".Friday").hide()
                                                                    $(".Saturday").hide()
                                                                }
                                                                if (day == 'Friday') {
                                                                    $(".sunday_start").hide();
                                                                    $(".tuesday_start").hide();
                                                                    $(".wednesday_start").hide();
                                                                    $(".thrusday_start").hide();
                                                                    $(".monday_start").hide();
                                                                    $(".saturday_start").hide();
                                                                    $('input[name="hours[sunday_start]"]').val('');
                                                                    $('input[name="hours[tuesday_start]"]').val('');
                                                                    $('input[name="hours[wednesday_start]"]').val('');
                                                                    $('input[name="hours[thrusday_start]"]').val('');
                                                                    $('input[name="hours[monday_start]"]').val('');
                                                                    $('input[name="hours[saturday_start]"]').val('');
                                                                    $('input[name="hours[sunday_end]"]').val('');
                                                                    $('input[name="hours[tuesday_end]"]').val('');
                                                                    $('input[name="hours[wednesday_end]"]').val('');
                                                                    $('input[name="hours[thrusday_end]"]').val('');
                                                                    $('input[name="hours[monday_end]"]').val('');
                                                                    $('input[name="hours[saturday_end]"]').val('');

                                                                    $(".monday_start").hide();
                                                                    $(".tuesday_start").hide();
                                                                    $(".wednesday_start").hide();
                                                                    $(".thrusday_start").hide();
                                                                    $(".friday_start").show();
                                                                    $(".saturday_start").hide();
                                                                    $(".sunday_start").hide();

                                                                    $(".Monday").hide()
                                                                    $(".Sunday").hide()
                                                                    $(".Tuesday").hide()
                                                                    $(".Wednesday").hide()
                                                                    $(".Thrusday").hide()
                                                                    $(".Friday").show()
                                                                    $(".Friday").addClass('day_circle_fill');
                                                                    $(".Saturday").hide()
                                                                }
                                                                if (day == 'Saturday') {
                                                                    $(".sunday_start").hide();
                                                                    $(".tuesday_start").hide();
                                                                    $(".wednesday_start").hide();
                                                                    $(".thrusday_start").hide();
                                                                    $(".friday_start").hide();
                                                                    $(".monday_start").hide();
                                                                    $('input[name="hours[sunday_start]"]').val('');
                                                                    $('input[name="hours[tuesday_start]"]').val('');
                                                                    $('input[name="hours[wednesday_start]"]').val('');
                                                                    $('input[name="hours[thrusday_start]"]').val('');
                                                                    $('input[name="hours[friday_start]"]').val('');
                                                                    $('input[name="hours[monday_start]"]').val('');
                                                                    $('input[name="hours[sunday_end]"]').val('');
                                                                    $('input[name="hours[tuesday_end]"]').val('');
                                                                    $('input[name="hours[wednesday_end]"]').val('');
                                                                    $('input[name="hours[thrusday_end]"]').val('');
                                                                    $('input[name="hours[friday_end]"]').val('');
                                                                    $('input[name="hours[monday_end]"]').val('');

                                                                    $(".monday_start").hide();
                                                                    $(".tuesday_start").hide();
                                                                    $(".wednesday_start").hide();
                                                                    $(".thrusday_start").hide();
                                                                    $(".friday_start").hide();
                                                                    $(".saturday_start").show();
                                                                    $(".sunday_start").hide();

                                                                    $(".Monday").hide()
                                                                    $(".Sunday").hide()
                                                                    $(".Tuesday").hide()
                                                                    $(".Wednesday").hide()
                                                                    $(".Thrusday").hide()
                                                                    $(".Friday").hide()
                                                                    $(".Saturday").show()
                                                                    $(".Saturday").addClass('day_circle_fill');
                                                                }
                                                                if (day == 'Sunday') {

                                                                    $(".monday_start").hide();
                                                                    $(".tuesday_start").hide();
                                                                    $(".wednesday_start").hide();
                                                                    $(".thrusday_start").hide();
                                                                    $(".friday_start").hide();
                                                                    $(".saturday_start").hide();
                                                                    $('input[name="hours[monday_start]"]').val('');
                                                                    $('input[name="hours[tuesday_start]"]').val('');
                                                                    $('input[name="hours[wednesday_start]"]').val('');
                                                                    $('input[name="hours[thrusday_start]"]').val('');
                                                                    $('input[name="hours[friday_start]"]').val('');
                                                                    $('input[name="hours[saturday_start]"]').val('');
                                                                    $('input[name="hours[monday_end]"]').val('');
                                                                    $('input[name="hours[tuesday_end]"]').val('');
                                                                    $('input[name="hours[wednesday_end]"]').val('');
                                                                    $('input[name="hours[thrusday_end]"]').val('');
                                                                    $('input[name="hours[friday_end]"]').val('');
                                                                    $('input[name="hours[saturday_end]"]').val('');

                                                                    $(".monday_start").hide();
                                                                    $(".tuesday_start").hide();
                                                                    $(".wednesday_start").hide();
                                                                    $(".thrusday_start").hide();
                                                                    $(".friday_start").hide();
                                                                    $(".saturday_start").hide();
                                                                    $(".sunday_start").show();

                                                                    $(".Monday").hide()
                                                                    $(".Sunday").show()
                                                                    $(".Sunday").addClass('day_circle_fill');
                                                                    $(".Tuesday").hide()
                                                                    $(".Wednesday").hide()
                                                                    $(".Thrusday").hide()
                                                                    $(".Friday").hide()
                                                                    $(".Saturday").hide()
                                                                }
                                                            }
                                                        }
                                                    }
                                                });

                                            </script>
                                        </div>
                                        <div class="form-group col-md-4 schedule_until_box">
                                            <input type="hidden" id="end_date" />
                                            <label>Schedule Unti</label>
                                            <select class="form-control" name="frm_schedule_until" id="frm_schedule_until">
                                                <option value="1 Month">1 Month</option>
                                                <option value="3 Months">3 Months</option>
                                                <option value="6 Months">6 Months</option>
                                                <option value="9 Months">9 Months</option>
                                                <option value="12 Months">12 Months</option>
                                            </select>
                                        </div>
                                        <script>
                                            $('#end_date').datepicker({
                                                dateFormat: "mm/dd/yyyy"
                                            });

                                        </script>
                                    </div>
                                    <hr style="border: 1px solid #d4cfcf;width: 100%;">
                                    <div class="row">
                                        <!--<div class="col-md-12" style="padding: 30px 20px;">
                                            <input type="checkbox" name="d" class="checkwith-val">
                                            <span class="checkwith-ctn">Su</span>
                                            <input type="checkbox" name="d" class="checkwith-val">
                                            <span class="checkwith-ctn">Mo</span>
                                            <input type="checkbox" name="d" class="checkwith-val">
                                            <span class="checkwith-ctn">Tu</span>
                                            <input type="checkbox" name="d" class="checkwith-val">
                                            <span class="checkwith-ctn">We</span>
                                            <input type="checkbox" name="d" class="checkwith-val">
                                            <span class="checkwith-ctn">Th</span>
                                            <input type="checkbox" name="d" class="checkwith-val">
                                            <span class="checkwith-ctn">Fr</span>
                                            <input type="checkbox" name="d" class="checkwith-val">
                                            <span class="checkwith-ctn">Sa</span>
                                        </div>-->

                                        <div class="timezone-ne mymy" id="tmzone" style="display:none;">
                                            <div class="day-time-div-main">
                                                <div class="day-time-div">
                                                    <div class="row" style="justify-content: center;">
                                                        <div class="col-sm-1 timezone-round day_circle Sunday dys">
                                                            <p>Su</p>
                                                        </div>
                                                        <div class="col-sm-1 timezone-round day_circle Monday dys">
                                                            <p>Mo</p>
                                                        </div>
                                                        <div class="col-sm-1 timezone-round day_circle Tuesday dys">
                                                            <p>Tu</p>
                                                        </div>
                                                        <div class="col-sm-1 timezone-round day_circle Wednesday dys">
                                                            <p>We</p>
                                                        </div>
                                                        <div class="col-sm-1 timezone-round day_circle Thrusday dys">
                                                            <p>Th</p>
                                                        </div>
                                                        <div class="col-sm-1 timezone-round day_circle Friday dys">
                                                            <p>Fr</p>
                                                        </div>
                                                        <div class="col-sm-1 timezone-round day_circle Saturday dys">
                                                            <p>Sa</p>
                                                        </div>
                                                    </div>
                                                    <div class="wrapperow">
                                                        <div class="col-md-12 sunday_start" style="display:none;">
                                                            <div class="col-md-12">Sunday Time</div>
                                                            <div class="form-group col-md-4">
                                                                <label>From</label>
                                                                <input type="text" class="fromtime-sun form-control timepicker" name="hours[sunday_start]" autocomplete="off" style=" width:100%" value="{{$hours['sunday_start']}}">
                                                                <?php /* ?><input type="text" class="fromtime-sun form-control" id="start_time" name="start_time[]"><?php */ ?>
                                                            </div>
                                                            <div class="form-group col-md-4">
                                                                <label>To</label>
                                                                <input type="text" class="totime-sun form-control timepicker" name="hours[sunday_end]" autocomplete="off" style=" width:100%" value="{{$hours['sunday_end']}}">
                                                            </div>
                                                            <div class="form-group col-md-4">
                                                                <label>Duration</label>
                                                                <select name="sunduration" id="sunduration" class="form-control">

                                                                    <option value="">30 Minutes</option>
                                                                    <option value="">45 Minutes</option>
                                                                    <option value="">1 Hours</option>
                                                                    <option value="">2 Hours</option>
                                                                    <option value="">3 Hours</option>
                                                                    <option value="">4 Hours</option>
                                                                    <option value="">5 Hours</option>
                                                                    <option value="">6 Hours</option>
                                                                    <option value="">7 Hours</option>
                                                                    <option value="">8 Hours</option>
                                                                    <option value="">9 Hours</option>
                                                                    <option value="">10 Hours</option>
                                                                    <option value="">1 Day</option>
                                                                    <option value="">2 Days</option>
                                                                    <option value="">3 Days</option>
                                                                    <option value="">4 Days</option>
                                                                    <option value="">5 Days</option>
                                                                    <option value="">6 Days</option>
                                                                    <option value="">7 Days</option>
                                                                    <option value="">8 Days</option>
                                                                    <option value="">9 Days</option>
                                                                    <option value="">10 Days</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-12 monday_start" style="display:none;">
                                                            <div class="col-md-12">Monday Time</div>
                                                            <div class="form-group col-md-4">
                                                                <label>From</label>
                                                                <input type="text" class="fromtime-mon form-control timepicker" name="hours[monday_start]" autocomplete="off" style=" width:100%" value="{{$hours['monday_start']}}">
                                                            </div>
                                                            <div class="form-group col-md-4">
                                                                <label>To</label>
                                                                <input type="text" class="totime-mon form-control timepicker" name="hours[monday_end]" autocomplete="off" style=" width:100%" value="{{$hours['monday_end']}}">
                                                            </div>
                                                            <div class="form-group col-md-4">
                                                                <label>Duration</label>
                                                                <select name="monduration" id="monduration" class="form-control">
                                                                    <option value="">30 Minutes</option>
                                                                    <option value="">45 Minutes</option>
                                                                    <option value="">1 Hours</option>
                                                                    <option value="">2 Hours</option>
                                                                    <option value="">3 Hours</option>
                                                                    <option value="">4 Hours</option>
                                                                    <option value="">5 Hours</option>
                                                                    <option value="">6 Hours</option>
                                                                    <option value="">7 Hours</option>
                                                                    <option value="">8 Hours</option>
                                                                    <option value="">9 Hours</option>
                                                                    <option value="">10 Hours</option>
                                                                    <option value="">1 Day</option>
                                                                    <option value="">2 Days</option>
                                                                    <option value="">3 Days</option>
                                                                    <option value="">4 Days</option>
                                                                    <option value="">5 Days</option>
                                                                    <option value="">6 Days</option>
                                                                    <option value="">7 Days</option>
                                                                    <option value="">8 Days</option>
                                                                    <option value="">9 Days</option>
                                                                    <option value="">10 Days</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-12 tuesday_start" style="display:none;">
                                                            <div class="col-md-12">Tuesday Time</div>
                                                            <div class="form-group col-md-4">
                                                                <label>From</label>
                                                                <input type="text" class="fromtime-tue form-control timepicker" name="hours[tuesday_start]" autocomplete="off" style=" width:100%" value="{{$hours['tuesday_start']}}">
                                                            </div>
                                                            <div class="form-group col-md-4">
                                                                <label>To</label>
                                                                <input type="text" class="totime-tue form-control timepicker" name="hours[tuesday_end]" autocomplete="off" style=" width:100%" value="{{$hours['tuesday_end']}}">
                                                            </div>
                                                            <div class="form-group col-md-4">
                                                                <label>Duration</label>
                                                                <select name="tuesduration" id="tuesduration" class="form-control">
                                                                    <option value="">30 Minutes</option>
                                                                    <option value="">45 Minutes</option>
                                                                    <option value="">1 Hours</option>
                                                                    <option value="">2 Hours</option>
                                                                    <option value="">3 Hours</option>
                                                                    <option value="">4 Hours</option>
                                                                    <option value="">5 Hours</option>
                                                                    <option value="">6 Hours</option>
                                                                    <option value="">7 Hours</option>
                                                                    <option value="">8 Hours</option>
                                                                    <option value="">9 Hours</option>
                                                                    <option value="">10 Hours</option>
                                                                    <option value="">1 Day</option>
                                                                    <option value="">2 Days</option>
                                                                    <option value="">3 Days</option>
                                                                    <option value="">4 Days</option>
                                                                    <option value="">5 Days</option>
                                                                    <option value="">6 Days</option>
                                                                    <option value="">7 Days</option>
                                                                    <option value="">8 Days</option>
                                                                    <option value="">9 Days</option>
                                                                    <option value="">10 Days</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-12 wednesday_start" style="display:none;">
                                                            <div class="col-md-12">Wednesday Time</div>
                                                            <div class="form-group col-md-4">
                                                                <label>From</label>
                                                                <input type="text" class="fromtime-wed form-control timepicker" name="hours[wednesday_start]" autocomplete="off" style=" width:100%" value="{{$hours['wednesday_start']}}">
                                                            </div>
                                                            <div class="form-group col-md-4">
                                                                <label>To</label>
                                                                <input type="text" class="totime-wed form-control timepicker" name="hours[wednesday_end]" autocomplete="off" style=" width:100%" value="{{$hours['wednesday_end']}}">
                                                            </div>
                                                            <div class="form-group col-md-4">
                                                                <label>Duration</label>
                                                                <select name="wedduration" id="wedduration" class="form-control">

                                                                    <option value="">30 Minutes</option>
                                                                    <option value="">45 Minutes</option>
                                                                    <option value="">1 Hours</option>
                                                                    <option value="">2 Hours</option>
                                                                    <option value="">3 Hours</option>
                                                                    <option value="">4 Hours</option>
                                                                    <option value="">5 Hours</option>
                                                                    <option value="">6 Hours</option>
                                                                    <option value="">7 Hours</option>
                                                                    <option value="">8 Hours</option>
                                                                    <option value="">9 Hours</option>
                                                                    <option value="">10 Hours</option>
                                                                    <option value="">1 Day</option>
                                                                    <option value="">2 Days</option>
                                                                    <option value="">3 Days</option>
                                                                    <option value="">4 Days</option>
                                                                    <option value="">5 Days</option>
                                                                    <option value="">6 Days</option>
                                                                    <option value="">7 Days</option>
                                                                    <option value="">8 Days</option>
                                                                    <option value="">9 Days</option>
                                                                    <option value="">10 Days</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-12 thrusday_start" style="display:none;">
                                                            <div class="col-md-12">Thursday Time</div>
                                                            <div class="form-group col-md-4">
                                                                <label>From</label>
                                                                <input type="text" class="fromtime-thu form-control timepicker" name="hours[thrusday_start]" autocomplete="off" style=" width:100%" value="{{$hours['thrusday_start']}}">
                                                            </div>
                                                            <div class="form-group col-md-4">
                                                                <label>To</label>
                                                                <input type="text" class="totime-thu form-control timepicker" name="hours[thrusday_end]" autocomplete="off" style=" width:100%" value="{{$hours['thrusday_end']}}">
                                                            </div>
                                                            <div class="form-group col-md-4">
                                                                <label>Duration</label>
                                                                <select name="thuduration" id="thuduration" class="form-control">

                                                                    <option value="">30 Minutes</option>
                                                                    <option value="">45 Minutes</option>
                                                                    <option value="">1 Hours</option>
                                                                    <option value="">2 Hours</option>
                                                                    <option value="">3 Hours</option>
                                                                    <option value="">4 Hours</option>
                                                                    <option value="">5 Hours</option>
                                                                    <option value="">6 Hours</option>
                                                                    <option value="">7 Hours</option>
                                                                    <option value="">8 Hours</option>
                                                                    <option value="">9 Hours</option>
                                                                    <option value="">10 Hours</option>
                                                                    <option value="">1 Day</option>
                                                                    <option value="">2 Days</option>
                                                                    <option value="">3 Days</option>
                                                                    <option value="">4 Days</option>
                                                                    <option value="">5 Days</option>
                                                                    <option value="">6 Days</option>
                                                                    <option value="">7 Days</option>
                                                                    <option value="">8 Days</option>
                                                                    <option value="">9 Days</option>
                                                                    <option value="">10 Days</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-12 friday_start" style="display:none;">
                                                            <div class="col-md-12">Friday Time</div>

                                                            <div class="form-group col-md-4">
                                                                <label>From</label>
                                                                <input type="text" class="fromtime-fri form-control timepicker" name="hours[friday_start]" autocomplete="off" style=" width:100%" value="{{$hours['friday_start']}}">
                                                            </div>
                                                            <div class="form-group col-md-4">
                                                                <label>To</label>
                                                                <input type="text" class="totime-fri form-control timepicker" name="hours[friday_end]" autocomplete="off" style=" width:100%" value="{{$hours['friday_end']}}">
                                                            </div>
                                                            <div class="form-group col-md-4">
                                                                <label>Duration</label>
                                                                <select name="friduration" id="friduration" class="form-control">
                                                                    <option value="">30 Minutes</option>
                                                                    <option value="">45 Minutes</option>
                                                                    <option value="">1 Hours</option>
                                                                    <option value="">2 Hours</option>
                                                                    <option value="">3 Hours</option>
                                                                    <option value="">4 Hours</option>
                                                                    <option value="">5 Hours</option>
                                                                    <option value="">6 Hours</option>
                                                                    <option value="">7 Hours</option>
                                                                    <option value="">8 Hours</option>
                                                                    <option value="">9 Hours</option>
                                                                    <option value="">10 Hours</option>
                                                                    <option value="">1 Day</option>
                                                                    <option value="">2 Days</option>
                                                                    <option value="">3 Days</option>
                                                                    <option value="">4 Days</option>
                                                                    <option value="">5 Days</option>
                                                                    <option value="">6 Days</option>
                                                                    <option value="">7 Days</option>
                                                                    <option value="">8 Days</option>
                                                                    <option value="">9 Days</option>
                                                                    <option value="">10 Days</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-12 saturday_start" style="display:none;">
                                                            <div class="col-md-12">Saturday Time</div>
                                                            <div class="form-group col-md-4">
                                                                <label>From</label>
                                                                <input type="text" class="fromtime-sat form-control timepicker" name="hours[saturday_start]" autocomplete="off" style=" width:100%" value="{{$hours['saturday_start']}}">
                                                            </div>
                                                            <div class="form-group col-md-4">
                                                                <label>To</label>
                                                                <input type="text" class="totime-sat form-control timepicker" name="hours[saturday_end]" autocomplete="off" style=" width:100%" value="{{$hours['saturday_end']}}">
                                                            </div>
                                                            <div class="form-group col-md-4">
                                                                <label>Duration</label>
                                                                <select name="satduration" id="satduration" class="form-control">

                                                                    <option value="">30 Minutes</option>
                                                                    <option value="">45 Minutes</option>
                                                                    <option value="">1 Hours</option>
                                                                    <option value="">2 Hours</option>
                                                                    <option value="">3 Hours</option>
                                                                    <option value="">4 Hours</option>
                                                                    <option value="">5 Hours</option>
                                                                    <option value="">6 Hours</option>
                                                                    <option value="">7 Hours</option>
                                                                    <option value="">8 Hours</option>
                                                                    <option value="">9 Hours</option>
                                                                    <option value="">10 Hours</option>
                                                                    <option value="">1 Day</option>
                                                                    <option value="">2 Days</option>
                                                                    <option value="">3 Days</option>
                                                                    <option value="">4 Days</option>
                                                                    <option value="">5 Days</option>
                                                                    <option value="">6 Days</option>
                                                                    <option value="">7 Days</option>
                                                                    <option value="">8 Days</option>
                                                                    <option value="">9 Days</option>
                                                                    <option value="">10 Days</option>
                                                                </select>
                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                            <br>
                                            <div class="col-md-12 text-center" style="margin-top: 50px;">
                                                <a id="test" class="button-fitness add-another-time">Add Another Time</a>
                                            </div>
                                        </div>
                                        <!--mymy-->
                                        <!--<br>
                                        <div class="col-md-12 text-center" style="margin-top: 50px;">
                                            <a href="#" id="test" class="button-fitness add-another-time">Add Another Time</a>
                                        </div>-->
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <br>
                            <div class="row">
                                <div class="col-md-6">
                                    <button type="button" class="btn-bck" id="bck-btn9"><i class="fa fa-arrow-left"></i> Back</button>
                                </div>
                                <div class="col-md-6 text-right">
                                    <button type="button" class="btn-nxt" id="btn-nxt10">Continue <i class="fa fa-arrow-right"></i></button>
                                </div>
                            </div>
                            <br>
                        </div>
                    </section>
                </div>

                <div class="container-fluid p-0" id="detail-form10" style="display: none;">
                    <div class="tab-hed">Create Services & Prices</div>
                    <div style="background: black;width: 107%;margin-left: -38px;padding: 6px;">
                        <span class="nav-link1 subtab">INDEPENDENT</span>
                        <span class="nav-link1 subtab1">CLASSES</span>
                        <span class="nav-link1 subtab2">EXPERIENCES</span>
                    </div>
                    <section class="row">
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-md-12">
                                    <h3 style="font-size: 17px;font-weight: bold;">SET UP YOUR PRICING DETAILS</h3>
                                </div>
                                <div class="col-md-12" style="padding: 30px 20px;">

                                    <div class="form-group col-md-12">
                                        <label for="salestax" class="percentageckeck">
                                            <input type="checkbox" value="salestax" onClick="" class="" name="salestax" id="salestax"> Sales Tax <a href="#" class="tooltip-custom sp1" data-toggle="tooltip" data-placement="top" title="Lorem ipsum, or lipsum as it is sometimes known, is dummy text used in laying out print, graphic or web designs.">?</a>
                                        </label>
                                        <div class="salestaxpercentage" id="salestaxpercentage" style="position: absolute; left: 13%; top:-1px;">
                                            <input type="text" value="" name="salestaxpercentage" maxlength="3" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" class="form-control percentage"> %
                                        </div>
                                    </div>
                                    <div class="form-group col-md-12">
                                        <label for="duestax" class="percentageckeck">
                                            <input type="checkbox" onClick="" value="duestax" class="" name="duestax" id="duestax"> Dues Tax <a href="#" class="tooltip-custom sp1" data-toggle="tooltip" data-placement="top" title="Lorem ipsum, or lipsum as it is sometimes known, is dummy text used in laying out print, graphic or web designs.">?</a>
                                        </label>
                                        <div class="duestaxpercentage" id="duestaxpercentage" style="position: absolute; left: 13%; top:-1px;">
                                            <input type="text" value="" maxlength="3" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" name="duestaxpercentage" class="form-control percentage"> %
                                        </div>
                                    </div>
                                </div>
                                <div class="pricing_details_all">

                                    <div class="col-md-12 pricing-details">

                                        <div class="pricing-details-block recuring">
                                            <label for="">Recuring Payment</label>
                                            <input type="checkbox" name="" id="">
                                        </div>

                                        <div class="pricing-details-block">
                                            <label for="">Numbers of Sessions</label>
                                            <input type="text" name="" id="" class="form-control">
                                        </div>

                                        <div class="pricing-details-block price-b">
                                            <label for="">Price</label>
                                            <span class="dollar-span" style="display: block;">$</span>
                                            <input type="text" name="" id="" class="form-control">
                                        </div>

                                        <div class="pricing-details-block dis-cate">
                                            <label for="">Discount Category</label>
                                            <select name="discount_frm" id="discount_frm" multiple>
                                                <option hidden>Select Value</option>
                                                <option value="">Free</option>
                                                <option value="">Consultation</option>
                                                <option value="">Assessment</option>
                                                <option value="">Trial</option>
                                                <option value="">Gift</option>
                                                <option value="">Student </option>
                                                <option value="">Military</option>
                                                <option value="">Black Friday</option>
                                                <option value="">Holiday</option>
                                                <option value="">Cyber Monday</option>
                                                <option value="">New Years </option>
                                                <option value="">Summer</option>
                                                <option value="">Winter</option>
                                                <option value="">Fall</option>
                                                <option value="">Spring</option>
                                                <option value="">Online</option>
                                            </select>
                                            <script>
                                                var p = new SlimSelect({
                                                    select: '#discount_frm'
                                                });

                                            </script>
                                        </div>

                                        <div class="pricing-details-block">
                                            <label for="">Discount Type</label>
                                            <select name="discounttype" class="form-control" id="discount_type">
                                                <option value="">$ Dollar</option>
                                                <option value="">% Percentage</option>
                                            </select>
                                        </div>

                                        <div class="pricing-details-block">
                                            <label for="">Discount</label>

                                            <input type="text" name="" id="" class="form-control" placeholder="$100">
                                        </div>

                                        <div class="pricing-details-block earnings">
                                            <label for="">Your Estimated Earnings <a href="#" class="custom_que">?</a></label>
                                            <input type="text" name="" id="" class="form-control">
                                        </div>

                                        <div class="pricing-details-block">
                                            <label for="">Set Number</label>
                                            <input type="text" name="" id="" class="form-control" placeholder="(ex,1,2,3,etc.)">
                                        </div>

                                        <div class="pricing-details-block1">
                                            <p>Set Expiration</p>
                                            <div class="pricing-dblock">
                                                <label for="">Duration</label>
                                                <select name="duration" id="duration" class="form-control">
                                                    <option hidden>Select Value</option>
                                                    <option value="">30 Minutes</option>
                                                    <option value="">45 Minutes</option>
                                                    <option value="">1 Hours</option>
                                                    <option value="">2 Hours</option>
                                                    <option value="">3 Hours</option>
                                                    <option value="">4 Hours</option>
                                                    <option value="">5 Hours</option>
                                                    <option value="">6 Hours</option>
                                                    <option value="">7 Hours</option>
                                                    <option value="">8 Hours</option>
                                                    <option value="">9 Hours</option>
                                                    <option value="">10 Hours</option>
                                                    <option value="">1 Day</option>
                                                    <option value="">2 Days</option>
                                                    <option value="">3 Days</option>
                                                    <option value="">4 Days</option>
                                                    <option value="">5 Days</option>
                                                    <option value="">6 Days</option>
                                                    <option value="">7 Days</option>
                                                    <option value="">8 Days</option>
                                                    <option value="">9 Days</option>
                                                    <option value="">10 Days</option>
                                                </select>
                                            </div>
                                            <div class="pricing-dblock">
                                                <label for="">After</label>
                                                <select name="after_frm" id="after_frm" multiple>
                                                    <option hidden>Select Value</option>
                                                    <option value="">1</option>
                                                    <option value="">2</option>
                                                    <option value="">3</option>
                                                    <option value="">4</option>
                                                    <option value="">5</option>
                                                </select>
                                                <script>
                                                    var p = new SlimSelect({
                                                        select: '#after_frm'
                                                    });

                                                </script>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12" style="margin-top: 20px;">
                                    <a class="button-fitness add-another-session">+ Add Another Session</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <br>
                            <div class="row">
                                <div class="col-md-6">

                                    <button type="button" class="btn-bck" id="bck-btn10"><i class="fa fa-arrow-left"></i> Back</button>

                                </div>

                                <div class="col-md-6 text-right">

                                    <button type="button" class="btn-nxt" id="btn-nxt11">Complete <i class="fa fa-arrow-right"></i></button>

                                </div>
                            </div>
                            <br>
                        </div>
                    </section>
                </div>

                <div class="container-fluid p-0" id="classes_1" style="display: none;">

                    <div class="tab-hed">Create Services & Prices</div>

                    <div style="background: black;width: 107%;margin-left: -38px;padding: 6px;">
                        <span class="nav-link1 subtab">INDEPENDENT</span>
                        <span class="nav-link1 subtab1">CLASSES</span>
                        <span class="nav-link1 subtab2">EXPERIENCES</span>
                    </div>

                    <section class="row">


                        <div class="col-md-4">

                            <br>

                            <br>

                            <br>

                            <!--<button class="btn-cate">Click To Add Activity Category</button>-->
                            <select name="frm_servicesport1" id="frm_servicesport1" class="form-control">
                                <option value="">Choose a Sport/Activity</option>
                                <option value="18">Aerobics</option>
                                <option value="26">Archery</option>
                                <option value="31">Badminton</option>
                                <option value="71">Barre</option>
                                <option value="4">Baseball</option>
                                <option value="3">Basketball</option>
                                <option value="33">Beach Vollyball</option>
                                <option value="15">Bouldering</option>
                                <option value="65">Bungee Jumping</option>
                                <optgroup label="Camps &amp; Clinics">
                                    <option value="29">Day Camp</option>
                                    <option value="28">Sleep Away</option>
                                    <option value="77">Winter Camp</option>
                                </optgroup>
                                <option value="63">Canoeing</option>
                                <optgroup label="Cycling">
                                    <option value="72">Indoor cycling</option>
                                </optgroup>
                                <option value="74">Dance</option>
                                <option value="39">Diving</option>
                                <optgroup label="Field Hockey">
                                    <option value="6">Ice Hockey</option>
                                </optgroup>
                                <option value="1">Football</option>
                                <option value="2">Golf</option>
                                <option value="68">Gymnastics</option>
                                <option value="58">Hang Gliding</option>
                                <option value="70">Hiit</option>
                                <option value="60">Hiking - Backpacking</option>
                                <option value="42">Horseback Riding</option>
                                <option value="69">ice Skating</option>
                                <option value="40">Kayaking</option>
                                <option value="41">lacrosse</option>
                                <option value="50">Laser Tag</option>
                                <optgroup label="Martial Arts">
                                    <option value="5">Boxing</option>
                                    <option value="35">Jiu-Jitsu</option>
                                    <option value="21">Karate</option>
                                    <option value="13">Kick Boxing</option>
                                    <option value="17">Kung Fu</option>
                                    <option value="22">MMA</option>
                                    <option value="24">Self-Defense</option>
                                    <option value="46">Tai Chi</option>
                                    <option value="10">Wrestling</option>
                                </optgroup>
                                <option value="43">Massage Therapy</option>
                                <option value="25">Nutrition</option>
                                <option value="49">Paint Ball</option>
                                <option value="45">Physical Therapy</option>
                                <option value="44">Pilates</option>
                                <option value="57">Rafting</option>
                                <option value="66">Rapelling</option>
                                <option value="67">Rock Climbing</option>
                                <option value="48">Rowing</option>
                                <option value="47">Running</option>
                                <optgroup label="Sightseeing Tours">
                                    <option value="53">Airplane Tour</option>
                                    <option value="56">ATV Tours</option>
                                    <option value="55">Boat Tours</option>
                                    <option value="54">Bus Tour</option>
                                    <option value="59">Caving Tours</option>
                                    <option value="51">Helicopter Tour</option>
                                </optgroup>
                                <option value="61">Sailing</option>
                                <option value="38">Scuba Diving</option>
                                <option value="9">Sky diving</option>
                                <option value="34">Snow Skiing</option>
                                <option value="37">Snowboarding</option>
                                <option value="73">Strength &amp; Conditioning</option>
                                <option value="36">Surfing</option>
                                <option value="20">Swimming</option>
                                <option value="8">Tennis</option>
                                <option value="76">Tours</option>
                                <option value="32">Vollyball</option>
                                <option value="75">Weight training</option>
                                <option value="62">Windsurfing</option>
                                <option value="19">Yoga</option>
                                <option value="64">Zip-Line</option>
                                <option value="30">Zumba</option>
                            </select>


                            <br>

                            <input type="text" name="frm_servicetitle_1" id="frm_servicetitle_1" placeholder="Name of Program" title="servicetitle" value="" class="form-control">

                            <br>

                            <br>

                            <div class="text-center"> <label>No Service Added Yet.<br>
                                    Get started by selecting Add Activity Category to choose the activity.</label></div>
                        </div>

                        <div class="col-md-8 text-justify" style="padding: 10px 40px;">
                            <br>

                            <br>

                            <p>Let’s create your service details and prices for your independent business.
                                Let customers know why you are the best at what you do. 1-on-1 businesses can
                                be a competitive market. When creating your profile, how do you stand out from
                                others. Every image, video, description, price, background check, review, and the
                                way you deliver your services will help you become a top business professional
                                on Fitnessity</p>
                            <h3>Recommended Tips to Do :</h3>
                            <p>- Create a professional profile. It’s your website and resume to potential clients.</p>
                            <p>- Sell your business and show what makes your business the best.</p>
                            <p>- Take professional pictures and make your customers feel welcomed.</p>
                            <h3>Tips Not to Do :</h3>
                            <p>- Having images that are not of professional manner, creepy or not comfortable.</p>
                            <p>- Not having a well-planned experience.</p>
                            <p>- Just going with the flow will not give you repeat business.</p>
                            <p>- Creating a generic service that customers can easily do on their own.</p>
                            <p>- Offering a service you are not qualified or skilled to do.</p>
                        </div>

                        <div class="col-md-12">
                            <br>
                            <div class="row">
                                <div class="col-md-6">
                                    <button type="button" class="btn-bck" id="bck-btn11"><i class="fa fa-arrow-left"></i> Back</button>
                                </div>

                                <div class="col-md-6 text-right">
                                    <button type="button" class="btn-nxt" id="btn-nxt12">Continue <i class="fa fa-arrow-right"></i></button>
                                </div>
                            </div>
                            <br>
                        </div>

                    </section>
                </div>

                <div class="container-fluid p-0" id="classes_2" style="display: none;">

                    <div class="tab-hed">Create Services & Prices</div>

                    <div style="background: black;width: 107%;margin-left: -38px;padding: 6px;">
                        <span class="nav-link1 subtab">INDEPENDENT</span>
                        <span class="nav-link1 subtab1">CLASSES</span>
                        <span class="nav-link1 subtab2">EXPERIENCES</span>
                    </div>

                    <section class="row">

                        <div class="col-md-12">

                            <br>

                            <div class="row">

                                <div class="col-md-8">

                                    <div class="row">
                                        <div class="form-group col-md-12">
                                            <label for="pwd">Setup the programs for your {kickboxing} service.<br>
                                                Let’s get a few detials about the program</label>
                                            <input type="text" class="form-control" name="frm_servicetitle1" id="frm_servicetitle1" placeholder="Enter Name of Program" title="servicetitle" readonly value="">
                                        </div>

                                        <div class="form-group col-md-12">
                                            <textarea class="form-control" rows="6" name="frm_servicedesc" id="frm_servicedesc" placeholder="Enter program description"></textarea>
                                            <div class="text-right">150 Characters Left</div>
                                        </div>

                                        <div class="form-group col-md-12">
                                            <label class="switch" for="booking3">
                                                <input type="radio" name="booking" id="booking3">
                                                <span class="slider round"></span>
                                            </label>
                                            <span>INSTANT BOOKING : Allow customers to book you instantly</span>
                                        </div>

                                        <div class="form-group col-md-12">
                                            <label class="switch" for="booking4">
                                                <input type="radio" name="booking" id="booking4">
                                                <span class="slider round"></span>
                                            </label>
                                            <span>RESERVED BOOKING : You need to confirm each booking first before completion</span>
                                        </div>

                                        <div class="form-group col-md-12">
                                            <label>How much notice do you need for each booking ?</label>
                                        </div>

                                        <div class="form-group col-md-6">
                                            <select class="form-control" name="cnotice_each_book_day" id="cfirstdayweek" rel="noticec">
                                                <option hidden>Select Value</option>
                                                <option values="Days">Days</option>
                                                <option values="Weeks">Weeks</option>
                                                <option values="Months">Months</option>
                                            </select>
                                        </div>

                                        <div class="form-group col-md-6">
                                            <select class="form-control" name="cnotice_each_book_ans" id="noticec">
                                                <option hidden>Select Value</option>
                                                <option values="1">1</option>
                                                <option values="2">2</option>
                                                <option values="3">3</option>
                                                <option values="4">4</option>
                                                <option values="5">5</option>
                                                <option values="6">6</option>
                                                <option values="7">7</option>
                                                <option values="8">8</option>
                                                <option values="9">9</option>
                                                <option values="10">10</option>
                                                <option values="11">11</option>
                                                <option values="12">12</option>
                                                <option values="13">13</option>
                                                <option values="14">14</option>
                                                <option values="15">15</option>
                                                <option values="16">16</option>
                                                <option values="17">17</option>
                                                <option values="18">18</option>
                                                <option values="19">19</option>
                                                <option values="20">20</option>
                                                <option values="21">21</option>
                                                <option values="22">22</option>
                                                <option values="23">23</option>
                                                <option values="24">24</option>
                                                <option values="25">25</option>
                                                <option values="26">26</option>
                                                <option values="27">27</option>
                                                <option values="28">28</option>
                                                <option values="29">29</option>
                                                <option values="30">30</option>
                                                <option values="31">31</option>
                                            </select>
                                        </div>

                                        <script>
                                            $('#cfirstdayweek').change(function () {
                                                var t = $('#cfirstdayweek option:selected').val();
                                                var id = $('#cfirstdayweek').attr('rel');
                                                console.log(t, "---", id)
                                                if (t == 'Days') {
                                                    options_f(31, id);
                                                }
                                                if (t == 'Weeks') {
                                                    options_f(52, id);
                                                }
                                                if (t == 'Months') {
                                                    options_f(12, id);
                                                }
                                            });

                                        </script>

                                        <div class="form-group col-md-12">
                                            <label>How far in advance can a customer book ?</label>
                                        </div>

                                        <div class="form-group col-md-6">
                                            <select class="form-control" name="cadvance_book_day" id="csecdayweek" rel="addvancec">
                                                <option hidden>Select Value</option>
                                                <option>Days</option>
                                                <option>Weeks</option>
                                                <option>Months</option>
                                            </select>
                                        </div>

                                        <div class="form-group col-md-6">
                                            <select class="form-control" name="cadvance_book_ans" id="addvancec">
                                                <option hidden>Select Value</option>
                                                <option value="1">1</option>
                                                <option value="2">2</option>
                                                <option value="3">3</option>
                                                <option value="4">4</option>
                                                <option value="5">5</option>
                                                <option value="6">6</option>
                                                <option value="7">7</option>
                                                <option value="8">8</option>
                                                <option value="9">9</option>
                                                <option value="10">10</option>
                                                <option value="11">11</option>
                                                <option value="12">12</option>
                                                <option value="13">13</option>
                                                <option value="14">14</option>
                                                <option value="15">15</option>
                                                <option value="16">16</option>
                                                <option value="17">17</option>
                                                <option value="18">18</option>
                                                <option value="19">19</option>
                                                <option value="20">20</option>
                                                <option value="21">21</option>
                                                <option value="22">22</option>
                                                <option value="23">23</option>
                                                <option value="24">24</option>
                                                <option value="25">25</option>
                                                <option value="26">26</option>
                                                <option value="27">27</option>
                                                <option value="28">28</option>
                                                <option value="29">29</option>
                                                <option value="30">30</option>
                                                <option value="31">31</option>
                                            </select>
                                        </div>
                                        <script>
                                            $('#csecdayweek').change(function () {
                                                var t = $('#csecdayweek option:selected').val();
                                                var id = $('#csecdayweek').attr('rel');
                                                console.log(t, "---", id)
                                                if (t == 'Days') {
                                                    options_f(31, id);
                                                }
                                                if (t == 'Weeks') {
                                                    options_f(52, id);
                                                }
                                                if (t == 'Months') {
                                                    options_f(12, id);
                                                }
                                            });

                                        </script>

                                        <div class="form-group col-md-12">
                                            <label>What's the latest moment a person can book your activity?</label>
                                        </div>

                                        <div class="form-group col-md-6">
                                            <select class="form-control" name="c_notice_each_book_day" id="c_firstminute" rel="c_notice">
                                                <option hidden>Select Value</option>
                                                <option values="Minute">Minute</option>
                                                <option values="Hours">Hours</option>
                                                <option values="Days">Days</option>
                                                <option values="Weeks">Weeks</option>
                                            </select>
                                        </div>

                                        <div class="form-group col-md-6">
                                            <select class="form-control" name="c_notice_each_book_ans" id="c_notice">
                                                <option hidden>Select Value</option>
                                                <option values="1">1</option>
                                                <option values="2">2</option>
                                                <option values="3">3</option>
                                                <option values="4">4</option>
                                                <option values="5">5</option>
                                                <option values="6">6</option>
                                                <option values="7">7</option>
                                                <option values="8">8</option>
                                                <option values="9">9</option>
                                                <option values="10">10</option>
                                                <option values="11">11</option>
                                                <option values="12">12</option>
                                                <option values="13">13</option>
                                                <option values="14">14</option>
                                                <option values="15">15</option>
                                                <option values="16">16</option>
                                                <option values="17">17</option>
                                                <option values="18">18</option>
                                                <option values="19">19</option>
                                                <option values="20">20</option>
                                                <option values="21">21</option>
                                                <option values="22">22</option>
                                                <option values="23">23</option>
                                                <option values="24">24</option>
                                                <option values="25">25</option>
                                                <option values="26">26</option>
                                                <option values="27">27</option>
                                                <option values="28">28</option>
                                                <option values="29">29</option>
                                                <option values="30">30</option>
                                                <option values="31">31</option>
                                            </select>
                                        </div>

                                        <script>
                                            $('#c_firstminute').change(function () {
                                                var t = $('#c_firstminute option:selected').val();
                                                var id = $('#c_firstminute').attr('rel');
                                                console.log(t, "---", id)
                                                if (t == 'Minute') {
                                                    options_f(60, id);
                                                }
                                                if (t == 'Hours') {
                                                    options_f(24, id);
                                                }
                                                if (t == 'Days') {
                                                    options_f(31, id);
                                                }
                                                if (t == 'Weeks') {
                                                    options_f(52, id);
                                                }
                                            });

                                        </script>

                                        <div class="form-group col-md-12">
                                            <label>Whats th latest a customer can cancel?</label>
                                        </div>

                                        <div class="form-group col-md-6">
                                            <select class="form-control" name="c_advance_book_day" id="c_secdayhours" rel="c_addvance">
                                                <option hidden>Select Value</option>
                                                <option>Hours</option>
                                                <option>Days</option>
                                                <option>Weeks</option>
                                                <option>Months</option>
                                            </select>
                                        </div>

                                        <div class="form-group col-md-6">
                                            <select class="form-control" name="c_advance_book_ans" id="c_addvance">
                                                <option hidden>Select Value</option>
                                                <option value="1">1</option>
                                                <option value="2">2</option>
                                                <option value="3">3</option>
                                                <option value="4">4</option>
                                                <option value="5">5</option>
                                                <option value="6">6</option>
                                                <option value="7">7</option>
                                                <option value="8">8</option>
                                                <option value="9">9</option>
                                                <option value="10">10</option>
                                                <option value="11">11</option>
                                                <option value="12">12</option>
                                                <option value="13">13</option>
                                                <option value="14">14</option>
                                                <option value="15">15</option>
                                                <option value="16">16</option>
                                                <option value="17">17</option>
                                                <option value="18">18</option>
                                                <option value="19">19</option>
                                                <option value="20">20</option>
                                                <option value="21">21</option>
                                                <option value="22">22</option>
                                                <option value="23">23</option>
                                                <option value="24">24</option>
                                                <option value="25">25</option>
                                                <option value="26">26</option>
                                                <option value="27">27</option>
                                                <option value="28">28</option>
                                                <option value="29">29</option>
                                                <option value="30">30</option>
                                                <option value="31">31</option>
                                            </select>
                                        </div>
                                        <script>
                                            $('#c_secdayhours').change(function () {
                                                var t = $('#c_secdayhours option:selected').val();
                                                var id = $('#c_secdayhours').attr('rel');
                                                console.log(t, "---", id)
                                                if (t == 'Hours') {
                                                    options_f(24, id);
                                                }
                                                if (t == 'Days') {
                                                    options_f(31, id);
                                                }
                                                if (t == 'Weeks') {
                                                    options_f(52, id);
                                                }
                                                if (t == 'Months') {
                                                    options_f(12, id);
                                                }
                                            });

                                        </script>

                                    </div>
                                </div>

                                <div class="col-md-4 text-center">

                                    <div class="row">

                                        <div class="col-md-2"></div>

                                        <div class="col-md-8 imgUp">
                                            <div class="imagePreview"></div>
                                            <label class="img-tab-btn">Upload Image<input type="file" class="uploadFile img" value="Upload Photo" style="width: 0px;height: 0px;overflow: hidden;">
                                            </label>
                                            <label style="font-size: 12px;">Upload an image that best
                                                represents your program</label>
                                        </div>

                                    </div><!-- row -->

                                </div>

                            </div>

                        </div>

                        <div class="col-md-12">

                            <br>

                            <div class="row">

                                <div class="col-md-6">
                                    <button type="button" class="btn-bck" id="bck-btn12"><i class="fa fa-arrow-left"></i> Back</button>
                                </div>

                                <div class="col-md-6 text-right">
                                    <button type="button" class="btn-nxt" id="btn-nxt13">Continue <i class="fa fa-arrow-right"></i></button>
                                </div>

                            </div>

                            <br>

                        </div>
                    </section>
                </div>

                <div class="container-fluid p-0" id="classes_3" style="display: none;">

                    <div class="tab-hed">Create Services & Prices</div>

                    <div style="background: black;width: 107%;margin-left: -38px;padding: 6px;">
                        <span class="nav-link1 subtab">INDEPENDENT</span>
                        <span class="nav-link1 subtab1">CLASSES</span>
                        <span class="nav-link1 subtab2">EXPERIENCES</span>
                    </div>

                    <section class="row">

                        <br>

                        <div class="col-md-12">

                            <div class="row">

                                <div class="col-md-6 service_type">

                                    <br>

                                    <div class="row">

                                        <div class="form-group col-md-12">
                                            <label>Select Service Type</label>
                                            <select name="frm_cservicetype[]" id="ccateg" multiple>
                                                <option>Personal Training</option>
                                                <option>Coaching</option>
                                                <option>Class</option>
                                                <option>Therapy</option>
                                                <option>Gym</option>
                                                <option>Adventure</option>
                                                <option>Trip</option>
                                                <option>Tour</option>
                                                <option>Camp</option>
                                                <option>Team</option>
                                                <option>Clinic</option>
                                            </select>
                                            <script>
                                                var p = new SlimSelect({
                                                    select: '#ccateg'
                                                });

                                            </script>
                                        </div>

                                        <div class="form-group col-md-12">
                                            <label>Location of Activity</label>
                                            <select name="frm_cservicelocation[]" id="frm_cservicelocation" multiple>
                                                <option>Online</option>
                                                <option>At Business</option>
                                                <option>On Location</option>
                                            </select>
                                            <script>
                                                var p = new SlimSelect({
                                                    select: '#frm_cservicelocation'
                                                });

                                            </script>
                                        </div>

                                        <div class="form-group col-md-12">
                                            <label>Activity Great For</label>
                                            <select name="frm_cprogramfor[]" id="frm_cprogramfor" multiple>
                                                <option>Individual</option>
                                                <option>Kids</option>
                                                <option>Teens</option>
                                                <option>Adults</option>
                                                <option>Family</option>
                                                <option>Groups</option>
                                                <option>Any</option>
                                            </select>
                                            <script>
                                                var p = new SlimSelect({
                                                    select: '#frm_cprogramfor'
                                                });

                                            </script>
                                        </div>

                                        <div class="form-group col-md-12">
                                            <label>Age Range</label>
                                            <select name="frm_cagerange[]" id="frm_cagerange" multiple>
                                                <option>Baby (0 to 12 months)</option>
                                                <option>Toddler (1 to 3 yrs.)</option>
                                                <option>Preschool (4 to 5 yrs.)</option>
                                                <option>Grade School (6 to 12 yrs.)</option>
                                                <option>Teen (13 to 17 yrs.)</option>
                                                <option>Young Adult (18 to 21 yrs.)</option>
                                                <option>Older Adult (21 to 39 yrs.)</option>
                                                <option>Middle Age (40 to 59 yrs.) </option>
                                                <option>Senior Adult (60 +)</option>
                                                <option>Any</option>
                                            </select>
                                            <script>
                                                var p = new SlimSelect({
                                                    select: '#frm_cagerange'
                                                });

                                            </script>
                                        </div>

                                        <div class="form-group col-md-12">
                                            <label>Group Size</label>
                                            <select name="frm_cnumberofpeople[]" id="frm_cnumberofpeople">
                                                <option>1</option>
                                                <option>2</option>
                                                <option>3</option>
                                                <option>4</option>
                                                <option>5</option>
                                                <option>6</option>
                                                <option>7</option>
                                                <option>8</option>
                                                <option>9</option>
                                                <option>10</option>
                                                <option>15</option>
                                                <option>20</option>
                                                <option>25</option>
                                                <option>30</option>
                                                <option>35</option>
                                                <option>40</option>
                                                <option>45</option>
                                                <option>50</option>
                                                <option>55</option>
                                                <option>60</option>
                                                <option>65</option>
                                                <option>70</option>
                                                <option>75</option>
                                                <option>80</option>
                                                <option>85</option>
                                                <option>90</option>
                                                <option>95</option>
                                                <option>100</option>
                                            </select>
                                            <script>
                                                var p = new SlimSelect({
                                                    select: '#frm_cnumberofpeople'
                                                });

                                            </script>
                                        </div>
                                        <div class="form-group col-md-12">
                                            <label>Difficulty Level</label>
                                            <select name="frm_cexperience_level[]" id="frm_cexperience_level" multiple>
                                                <option>Beginner</option>
                                                <option>Intermediate</option>
                                                <option>Advanced</option>
                                                <option>Professional</option>
                                                <option>Expert</option>
                                                <option>Any</option>
                                            </select>
                                            <script>
                                                var p = new SlimSelect({
                                                    select: '#frm_cexperience_level'
                                                });

                                            </script>
                                        </div>
                                        <div class="form-group col-md-12">
                                            <label>Activity Experience</label>
                                            <select name="frm_cservicefocuses[]" id="frm_cservicefocuses" multiple>
                                                <option value="Have Fun"> Have Fun</option>
                                                <option value="Adventurous">Adventurous</option>
                                                <option value="Thrilling">Thrilling</option>
                                                <option value="Dangerous">Dangerous </option>
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
                                                    select: '#frm_cservicefocuses'
                                                });
                                            </script>
                                        </div>
                                        <div class="form-group col-md-12">
                                            <label>Personality & Habits of Instructor</label>
                                            <select name="frm_cteachingstyle[]" id="cteaching" multiple>
                                                <option hidden="">Select Value</option>
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
                                                <option value="Stern">Friendly &amp; outgoing</option>
                                                <option value="Tells jokes and funny">Tells jokes and funny</option>
                                                <option value="Loves to talk">Loves to talk about the details</option>
                                                <option value="Very Organized">Very Organized</option>
                                                <option value="Punctual">Punctual</option>
                                                <option value="On Time">On Time</option>
                                            </select>
                                            <script>
                                                var p = new SlimSelect({
                                                    select: '#cteaching'
                                                });
                                            </script>
                                        </div>
                                    </div><!-- row -->
                                </div>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <br>
                            <div class="row">
                                <div class="col-md-6">
                                    <button type="button" class="btn-bck" id="bck-btn13"><i class="fa fa-arrow-left"></i> Back</button>
                                </div>
                                <div class="col-md-6 text-right">
                                    <button type="button" class="btn-nxt" id="btn-nxt14">Continue <i class="fa fa-arrow-right"></i></button>
                                </div>
                            </div>
                            <br>
                        </div>
                    </section>
                </div>

                <div class="container-fluid p-0" id="classes_4" style="display: none;">
                    <div class="tab-hed">Create Services & Prices</div>
                    <div style="background: black;width: 107%;margin-left: -38px;padding: 6px;">
                        <span class="nav-link1 subtab">INDEPENDENT</span>
                        <span class="nav-link1 subtab1">CLASSES</span>
                        <span class="nav-link1 subtab2">EXPERIENCES</span>
                    </div>
                    <section class="row">
                        <div class="col-md-12">
                            <div class="row" style="padding: 10px 100px;">
                                <div class="col-md-12 text-center">
                                    <h3 style="font-size: 17px;font-weight: bold;">ACTIVTIY SCHEDULER</h3>
                                    <label>Let’s select the dates and times this activity will happen</label>
                                </div>
                                <div class="col-md-12 text-center" style="padding: 30px 20px;">
                                    <div class="row">
                                        <div class="form-group col-md-4">
                                            <label>Activity Meets</label>
                                            <select class="form-control" name="frm_class_meets" id="c_frm_class_meets">
                                                <option value="Weekly">Weekly</option>
                                                <option value="On a specific day">On a specific day</option>
                                            </select>
                                        </div>

                                        <div class="form-group col-md-4" id="c_startingpicker-position">
                                            <label>Starting</label>
                                            <input type="text" readonly class="form-control frm_starting" name="starting" id="c_startingpicker">
                                            <script>
                                                $('#c_startingpicker').datepicker({
                                                    onSelect: function (dateText, inst) {
                                                        var date = $(this).datepicker('getDate');
                                                        //var date1 = $(this).datepicker.parseDate(inst.settings.dateFormat, dateText, inst.settings);
                                                        //console.log(date1);
                                                        var day = $.datepicker.formatDate('DD', date);

                                                        $('.c_mymy').show();
                                                        $('.c_day-time-div').slice(1).remove()
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
                                                        $(".c_sunday_start").hide()
                                                        $(".c_tuesday_start").hide()
                                                        $(".c_wednesday_start").hide()
                                                        $(".c_thrusday_start").hide()
                                                        $(".c_friday_start").hide()
                                                        $(".c_monday_start").hide()
                                                        $(".c_saturday_start").hide()

                                                        if ($("#c_frm_class_meets").val() == 'Weekly') {
                                                            $(".c_schedule_until_box").show()
                                                            if ($("#c_startingpicker").val() != '') {
                                                                console.log("run11")
                                                                $(".c_Sunday").removeClass("day_circle_fill")
                                                                $(".c_Monday").removeClass("day_circle_fill")
                                                                $(".c_Tuesday").removeClass("day_circle_fill")
                                                                $(".c_Wednesday").removeClass("day_circle_fill")
                                                                $(".c_Thrusday").removeClass("day_circle_fill")
                                                                $(".c_Friday").removeClass("day_circle_fill")
                                                                $(".c_Saturday").removeClass("day_circle_fill")
                                                                $(".c_Monday").show()
                                                                $(".c_Sunday").show()
                                                                $(".c_Tuesday").show()
                                                                $(".c_Wednesday").show()
                                                                $(".c_Thrusday").show()
                                                                $(".c_Friday").show()
                                                                $(".c_Saturday").show()
                                                                if ($("#c_startingpicker").val() != '') {
                                                                    var day = moment($("#c_startingpicker").val(), 'MM-DD-YYYY').format('dddd')
                                                                    if (day == 'Monday') {
                                                                        $(".c_Monday").show()
                                                                        $(".c_Monday").addClass('day_circle_fill')
                                                                        $(".c_monday_start").show()
                                                                    }
                                                                    if (day == 'Tuesday') {
                                                                        $(".c_Tuesday").show()
                                                                        $(".c_Tuesday").addClass('day_circle_fill')
                                                                        $(".c_tuesday_start").show()
                                                                    }
                                                                    if (day == 'Wednesday') {
                                                                        $(".c_Wednesday").show()
                                                                        $(".c_Wednesday").addClass('day_circle_fill')
                                                                        $(".c_wednesday_start").show()
                                                                    }
                                                                    if (day == 'Thursday') {
                                                                        $(".c_Thrusday").show()
                                                                        $(".c_Thrusday").addClass('day_circle_fill')
                                                                        $(".c_thrusday_start").show()
                                                                    }
                                                                    if (day == 'Friday') {
                                                                        $(".c_Friday").show()
                                                                        $(".c_Friday").addClass('day_circle_fill')
                                                                        $(".c_friday_start").show()
                                                                    }
                                                                    if (day == 'Saturday') {
                                                                        $(".c_Saturday").show()
                                                                        $(".c_Saturday").addClass('day_circle_fill')
                                                                        $(".c_saturday_start").show()
                                                                    }
                                                                    if (day == 'Sunday') {
                                                                        $(".c_Sunday").show()
                                                                        $(".c_Sunday").addClass('day_circle_fill')
                                                                        $(".c_sunday_start").show()
                                                                    }
                                                                }
                                                            }
                                                        } else {
                                                            $(".c_schedule_until_box").hide()
                                                            if ($("#c_startingpicker").val() != '') {
                                                                var day = moment($("#c_startingpicker").val(), 'MM-DD-YYYY').format('dddd')
                                                                myday = moment($("#c_startingpicker").val(), 'MM-DD-YYYY').format('dddd')
                                                                if (day == 'Monday') {

                                                                    $('input[name="hours[sunday_start]"]').val('');
                                                                    $('input[name="hours[tuesday_start]"]').val('');
                                                                    $('input[name="hours[wednesday_start]"]').val('');
                                                                    $('input[name="hours[thrusday_start]"]').val('');
                                                                    $('input[name="hours[friday_start]"]').val('');
                                                                    $('input[name="hours[saturday_start]"]').val('');
                                                                    $('input[name="hours[sunday_end]"]').val('');
                                                                    $('input[name="hours[tuesday_end]"]').val('');
                                                                    $('input[name="hours[wednesday_end]"]').val('');
                                                                    $('input[name="hours[thrusday_end]"]').val('');
                                                                    $('input[name="hours[friday_end]"]').val('');
                                                                    $('input[name="hours[saturday_end]"]').val('');

                                                                    $(".c_monday_start").show();
                                                                    $(".c_tuesday_start").hide();
                                                                    $(".c_wednesday_start").hide();
                                                                    $(".c_thrusday_start").hide();
                                                                    $(".c_friday_start").hide();
                                                                    $(".c_saturday_start").hide();
                                                                    $(".c_sunday_start").hide();

                                                                    $(".c_Monday").show()
                                                                    $(".c_Monday").addClass('day_circle_fill');
                                                                    $(".c_Sunday").hide()
                                                                    $(".c_Tuesday").hide()
                                                                    $(".c_Wednesday").hide()
                                                                    $(".c_Thrusday").hide()
                                                                    $(".c_Friday").hide()
                                                                    $(".c_Saturday").hide()
                                                                }
                                                                if (day == 'Tuesday') {

                                                                    $('input[name="hours[sunday_start]"]').val('');
                                                                    $('input[name="hours[monday_start]"]').val('');
                                                                    $('input[name="hours[wednesday_start]"]').val('');
                                                                    $('input[name="hours[thrusday_start]"]').val('');
                                                                    $('input[name="hours[friday_start]"]').val('');
                                                                    $('input[name="hours[saturday_start]"]').val('');
                                                                    $('input[name="hours[sunday_end]"]').val('');
                                                                    $('input[name="hours[monday_end]"]').val('');
                                                                    $('input[name="hours[wednesday_end]"]').val('');
                                                                    $('input[name="hours[thrusday_end]"]').val('');
                                                                    $('input[name="hours[friday_end]"]').val('');
                                                                    $('input[name="hours[saturday_end]"]').val('');

                                                                    $(".c_monday_start").hide();
                                                                    $(".c_tuesday_start").show();
                                                                    $(".c_wednesday_start").hide();
                                                                    $(".c_thrusday_start").hide();
                                                                    $(".c_friday_start").hide();
                                                                    $(".c_saturday_start").hide();
                                                                    $(".c_sunday_start").hide();

                                                                    $(".c_Monday").hide()
                                                                    $(".c_Sunday").hide()
                                                                    $(".c_Tuesday").show()
                                                                    $(".c_Tuesday").addClass('day_circle_fill');
                                                                    $(".c_Wednesday").hide()
                                                                    $(".c_Thrusday").hide()
                                                                    $(".c_Friday").hide()
                                                                    $(".c_Saturday").hide()
                                                                }
                                                                if (day == 'Wednesday') {
                                                                    $(".c_sunday_start").hide();
                                                                    $(".c_tuesday_start").hide();
                                                                    $(".c_monday_start").hide();
                                                                    $(".c_thrusday_start").hide();
                                                                    $(".c_friday_start").hide();
                                                                    $(".c_saturday_start").hide();
                                                                    $('input[name="hours[sunday_start]"]').val('');
                                                                    $('input[name="hours[tuesday_start]"]').val('');
                                                                    $('input[name="hours[monday_start]"]').val('');
                                                                    $('input[name="hours[thrusday_start]"]').val('');
                                                                    $('input[name="hours[friday_start]"]').val('');
                                                                    $('input[name="hours[saturday_start]"]').val('');
                                                                    $('input[name="hours[sunday_end]"]').val('');
                                                                    $('input[name="hours[tuesday_end]"]').val('');
                                                                    $('input[name="hours[monday_end]"]').val('');
                                                                    $('input[name="hours[thrusday_end]"]').val('');
                                                                    $('input[name="hours[friday_end]"]').val('');
                                                                    $('input[name="hours[saturday_end]"]').val('');

                                                                    $(".c_monday_start").hide();
                                                                    $(".c_tuesday_start").hide();
                                                                    $(".c_wednesday_start").show();
                                                                    $(".c_thrusday_start").hide();
                                                                    $(".c_friday_start").hide();
                                                                    $(".c_saturday_start").hide();
                                                                    $(".c_sunday_start").hide();

                                                                    $(".c_Monday").hide()
                                                                    $(".c_Sunday").hide()
                                                                    $(".c_Tuesday").hide()
                                                                    $(".c_Wednesday").show()
                                                                    $(".c_Wednesday").addClass('day_circle_fill');
                                                                    $(".c_Thrusday").hide()
                                                                    $(".c_Friday").hide()
                                                                    $(".c_Saturday").hide()
                                                                }
                                                                if (day == 'Thursday') {
                                                                    $(".c_sunday_start").hide();
                                                                    $(".c_tuesday_start").hide();
                                                                    $(".c_wednesday_start").hide();
                                                                    $(".c_monday_start").hide();
                                                                    $(".c_friday_start").hide();
                                                                    $(".c_saturday_start").hide();
                                                                    $('input[name="hours[sunday_start]"]').val('');
                                                                    $('input[name="hours[tuesday_start]"]').val('');
                                                                    $('input[name="hours[wednesday_start]"]').val('');
                                                                    $('input[name="hours[monday_start]"]').val('');
                                                                    $('input[name="hours[friday_start]"]').val('');
                                                                    $('input[name="hours[saturday_start]"]').val('');
                                                                    $('input[name="hours[sunday_end]"]').val('');
                                                                    $('input[name="hours[tuesday_end]"]').val('');
                                                                    $('input[name="hours[wednesday_end]"]').val('');
                                                                    $('input[name="hours[monday_end]"]').val('');
                                                                    $('input[name="hours[friday_end]"]').val('');
                                                                    $('input[name="hours[saturday_end]"]').val('');

                                                                    $(".c_monday_start").hide();
                                                                    $(".c_tuesday_start").hide();
                                                                    $(".c_wednesday_start").hide();
                                                                    $(".c_thrusday_start").show();
                                                                    $(".c_friday_start").hide();
                                                                    $(".c_saturday_start").hide();
                                                                    $(".c_sunday_start").hide();

                                                                    $(".c_Monday").hide()
                                                                    $(".c_Sunday").hide()
                                                                    $(".c_Tuesday").hide()
                                                                    $(".c_Wednesday").hide()
                                                                    $(".c_Thrusday").show()
                                                                    $(".c_Thrusday").addClass('day_circle_fill');
                                                                    $(".c_Friday").hide()
                                                                    $(".c_Saturday").hide()
                                                                }
                                                                if (day == 'Friday') {
                                                                    $(".c_sunday_start").hide();
                                                                    $(".c_tuesday_start").hide();
                                                                    $(".c_wednesday_start").hide();
                                                                    $(".c_thrusday_start").hide();
                                                                    $(".c_monday_start").hide();
                                                                    $(".sc_aturday_start").hide();
                                                                    $('input[name="hours[sunday_start]"]').val('');
                                                                    $('input[name="hours[tuesday_start]"]').val('');
                                                                    $('input[name="hours[wednesday_start]"]').val('');
                                                                    $('input[name="hours[thrusday_start]"]').val('');
                                                                    $('input[name="hours[monday_start]"]').val('');
                                                                    $('input[name="hours[saturday_start]"]').val('');
                                                                    $('input[name="hours[sunday_end]"]').val('');
                                                                    $('input[name="hours[tuesday_end]"]').val('');
                                                                    $('input[name="hours[wednesday_end]"]').val('');
                                                                    $('input[name="hours[thrusday_end]"]').val('');
                                                                    $('input[name="hours[monday_end]"]').val('');
                                                                    $('input[name="hours[saturday_end]"]').val('');

                                                                    $(".c_monday_start").hide();
                                                                    $(".c_tuesday_start").hide();
                                                                    $(".c_wednesday_start").hide();
                                                                    $(".c_thrusday_start").hide();
                                                                    $(".c_friday_start").show();
                                                                    $(".c_saturday_start").hide();
                                                                    $(".c_sunday_start").hide();

                                                                    $(".c_Monday").hide()
                                                                    $(".c_Sunday").hide()
                                                                    $(".c_Tuesday").hide()
                                                                    $(".c_Wednesday").hide()
                                                                    $(".c_Thrusday").hide()
                                                                    $(".c_Friday").show()
                                                                    $(".c_Friday").addClass('day_circle_fill');
                                                                    $(".c_Saturday").hide()
                                                                }
                                                                if (day == 'Saturday') {
                                                                    $(".c_sunday_start").hide();
                                                                    $(".c_tuesday_start").hide();
                                                                    $(".c_wednesday_start").hide();
                                                                    $(".c_thrusday_start").hide();
                                                                    $(".c_friday_start").hide();
                                                                    $(".c_monday_start").hide();
                                                                    $('input[name="hours[sunday_start]"]').val('');
                                                                    $('input[name="hours[tuesday_start]"]').val('');
                                                                    $('input[name="hours[wednesday_start]"]').val('');
                                                                    $('input[name="hours[thrusday_start]"]').val('');
                                                                    $('input[name="hours[friday_start]"]').val('');
                                                                    $('input[name="hours[monday_start]"]').val('');
                                                                    $('input[name="hours[sunday_end]"]').val('');
                                                                    $('input[name="hours[tuesday_end]"]').val('');
                                                                    $('input[name="hours[wednesday_end]"]').val('');
                                                                    $('input[name="hours[thrusday_end]"]').val('');
                                                                    $('input[name="hours[friday_end]"]').val('');
                                                                    $('input[name="hours[monday_end]"]').val('');

                                                                    $(".c_monday_start").hide();
                                                                    $(".c_tuesday_start").hide();
                                                                    $(".c_wednesday_start").hide();
                                                                    $(".c_thrusday_start").hide();
                                                                    $(".c_friday_start").hide();
                                                                    $(".c_saturday_start").show();
                                                                    $(".c_sunday_start").hide();

                                                                    $(".c_Monday").hide()
                                                                    $(".c_Sunday").hide()
                                                                    $(".c_Tuesday").hide()
                                                                    $(".c_Wednesday").hide()
                                                                    $(".c_Thrusday").hide()
                                                                    $(".c_Friday").hide()
                                                                    $(".c_Saturday").show()
                                                                    $(".c_Saturday").addClass('day_circle_fill');
                                                                }
                                                                if (day == 'Sunday') {

                                                                    $(".c_monday_start").hide();
                                                                    $(".c_tuesday_start").hide();
                                                                    $(".c_wednesday_start").hide();
                                                                    $(".c_thrusday_start").hide();
                                                                    $(".c_friday_start").hide();
                                                                    $(".c_saturday_start").hide();
                                                                    $('input[name="hours[monday_start]"]').val('');
                                                                    $('input[name="hours[tuesday_start]"]').val('');
                                                                    $('input[name="hours[wednesday_start]"]').val('');
                                                                    $('input[name="hours[thrusday_start]"]').val('');
                                                                    $('input[name="hours[friday_start]"]').val('');
                                                                    $('input[name="hours[saturday_start]"]').val('');
                                                                    $('input[name="hours[monday_end]"]').val('');
                                                                    $('input[name="hours[tuesday_end]"]').val('');
                                                                    $('input[name="hours[wednesday_end]"]').val('');
                                                                    $('input[name="hours[thrusday_end]"]').val('');
                                                                    $('input[name="hours[friday_end]"]').val('');
                                                                    $('input[name="hours[saturday_end]"]').val('');

                                                                    $(".c_monday_start").hide();
                                                                    $(".c_tuesday_start").hide();
                                                                    $(".c_wednesday_start").hide();
                                                                    $(".c_thrusday_start").hide();
                                                                    $(".c_friday_start").hide();
                                                                    $(".c_saturday_start").hide();
                                                                    $(".c_sunday_start").show();

                                                                    $(".c_Monday").hide()
                                                                    $(".c_Sunday").show()
                                                                    $(".c_Sunday").addClass('day_circle_fill');
                                                                    $(".c_c_Tuesday").hide()
                                                                    $(".c_Wednesday").hide()
                                                                    $(".c_Thrusday").hide()
                                                                    $(".c_Friday").hide()
                                                                    $(".c_Saturday").hide()
                                                                }
                                                            }
                                                        }
                                                    }
                                                });

                                            </script>
                                        </div>

                                        <div class="form-group col-md-4 c_schedule_until_box">
                                            <input type="hidden" id="c_end_date" />
                                            <label>Schedule Unti</label>
                                            <select class="form-control" name="frm_schedule_until" id="c_frm_schedule_until">
                                                <option value="1 Month">1 Month</option>
                                                <option value="3 Months">3 Months</option>
                                                <option value="6 Months">6 Months</option>
                                                <option value="9 Months">9 Months</option>
                                                <option value="12 Months">12 Months</option>
                                            </select>
                                        </div>
                                        <script>
                                            $('#c_end_date').datepicker({
                                                dateFormat: "mm/dd/yyyy"
                                            });
                                        </script>
                                    </div>
                                    <hr style="border: 1px solid #d4cfcf;width: 100%;">
                                    <div class="row">
                                        <div class="timezone-ne c_mymy" id="tmzone" style="display:none;">
                                            <div class="c_day-time-div-main">
                                                <div class="c_day-time-div">
                                                    <div class="row" style="justify-content: center;">
                                                        <div class="col-sm-1 timezone-round day_circle c_Sunday dys">
                                                            <p>Su</p>
                                                        </div>
                                                        <div class="col-sm-1 timezone-round day_circle c_Monday dys">
                                                            <p>Mo</p>
                                                        </div>
                                                        <div class="col-sm-1 timezone-round day_circle c_Tuesday dys">
                                                            <p>Tu</p>
                                                        </div>
                                                        <div class="col-sm-1 timezone-round day_circle c_Wednesday dys">
                                                            <p>We</p>
                                                        </div>
                                                        <div class="col-sm-1 timezone-round day_circle c_Thrusday dys">
                                                            <p>Th</p>
                                                        </div>
                                                        <div class="col-sm-1 timezone-round day_circle c_Friday dys">
                                                            <p>Fr</p>
                                                        </div>
                                                        <div class="col-sm-1 timezone-round day_circle c_Saturday dys">
                                                            <p>Sa</p>
                                                        </div>
                                                    </div>
                                                    <div class="wrapperow">
                                                        <div class="col-md-12 c_sunday_start" style="display:none;">
                                                            <div class="col-md-12">Sunday Time</div>
                                                            <div class="form-group col-md-4">
                                                                <label>From</label>
                                                                <input type="text" class="c_sunquicktimepicker form-control" name="hours[sunday_start]" autocomplete="off" style=" width:100%" value="{{$hours['sunday_start']}}">
                                                            </div>
                                                            <div class="form-group col-md-4">
                                                                <label>To</label>
                                                                <input type="text" class="c_timepicker form-control" name="hours[sunday_end]" autocomplete="off" style=" width:100%" value="{{$hours['sunday_end']}}">
                                                            </div>
                                                            <div class="form-group col-md-4">
                                                                <label>Duration</label>
                                                                <select name="sunduration" id="c_sunduration" class="form-control">
                                                                    <option value="">30 Minutes</option>
                                                                    <option value="">45 Minutes</option>
                                                                    <option value="">1 Hours</option>
                                                                    <option value="">2 Hours</option>
                                                                    <option value="">3 Hours</option>
                                                                    <option value="">4 Hours</option>
                                                                    <option value="">5 Hours</option>
                                                                    <option value="">6 Hours</option>
                                                                    <option value="">7 Hours</option>
                                                                    <option value="">8 Hours</option>
                                                                    <option value="">9 Hours</option>
                                                                    <option value="">10 Hours</option>
                                                                    <option value="">1 Day</option>
                                                                    <option value="">2 Days</option>
                                                                    <option value="">3 Days</option>
                                                                    <option value="">4 Days</option>
                                                                    <option value="">5 Days</option>
                                                                    <option value="">6 Days</option>
                                                                    <option value="">7 Days</option>
                                                                    <option value="">8 Days</option>
                                                                    <option value="">9 Days</option>
                                                                    <option value="">10 Days</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-12 c_monday_start" style="display:none;">
                                                            <div class="col-md-12">Monday Time</div>
                                                            <div class="form-group col-md-4">
                                                                <label>From</label>
                                                                <input type="text" class="c_monquicktimepicker form-control" name="hours[monday_start]" autocomplete="off" style=" width:100%" value="{{$hours['monday_start']}}">
                                                            </div>
                                                            <div class="form-group col-md-4">
                                                                <label>To</label>
                                                                <input type="text" class="c_timepicker form-control" name="hours[monday_end]" autocomplete="off" style=" width:100%" value="{{$hours['monday_end']}}">
                                                            </div>
                                                            <div class="form-group col-md-4">
                                                                <label>Duration</label>
                                                                <select name="monduration" id="c_monduration" class="form-control">
                                                                    <option value="">30 Minutes</option>
                                                                    <option value="">45 Minutes</option>
                                                                    <option value="">1 Hours</option>
                                                                    <option value="">2 Hours</option>
                                                                    <option value="">3 Hours</option>
                                                                    <option value="">4 Hours</option>
                                                                    <option value="">5 Hours</option>
                                                                    <option value="">6 Hours</option>
                                                                    <option value="">7 Hours</option>
                                                                    <option value="">8 Hours</option>
                                                                    <option value="">9 Hours</option>
                                                                    <option value="">10 Hours</option>
                                                                    <option value="">1 Day</option>
                                                                    <option value="">2 Days</option>
                                                                    <option value="">3 Days</option>
                                                                    <option value="">4 Days</option>
                                                                    <option value="">5 Days</option>
                                                                    <option value="">6 Days</option>
                                                                    <option value="">7 Days</option>
                                                                    <option value="">8 Days</option>
                                                                    <option value="">9 Days</option>
                                                                    <option value="">10 Days</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-12 c_tuesday_start" style="display:none;">
                                                            <div class="col-md-12">Tuesday Time</div>

                                                            <div class="form-group col-md-4">
                                                                <label>From</label>
                                                                <input type="text" class="c_tuesquicktimepicker form-control" name="hours[tuesday_start]" autocomplete="off" style=" width:100%" value="{{$hours['tuesday_start']}}">
                                                            </div>
                                                            <div class="form-group col-md-4">
                                                                <label>To</label>
                                                                <input type="text" class="c_timepicker form-control" name="hours[tuesday_end]" autocomplete="off" style=" width:100%" value="{{$hours['tuesday_end']}}">
                                                            </div>
                                                            <div class="form-group col-md-4">
                                                                <label>Duration</label>
                                                                <select name="tuesduration" id="c_tuesduration" class="form-control">
                                                                    <option value="">30 Minutes</option>
                                                                    <option value="">45 Minutes</option>
                                                                    <option value="">1 Hours</option>
                                                                    <option value="">2 Hours</option>
                                                                    <option value="">3 Hours</option>
                                                                    <option value="">4 Hours</option>
                                                                    <option value="">5 Hours</option>
                                                                    <option value="">6 Hours</option>
                                                                    <option value="">7 Hours</option>
                                                                    <option value="">8 Hours</option>
                                                                    <option value="">9 Hours</option>
                                                                    <option value="">10 Hours</option>
                                                                    <option value="">1 Day</option>
                                                                    <option value="">2 Days</option>
                                                                    <option value="">3 Days</option>
                                                                    <option value="">4 Days</option>
                                                                    <option value="">5 Days</option>
                                                                    <option value="">6 Days</option>
                                                                    <option value="">7 Days</option>
                                                                    <option value="">8 Days</option>
                                                                    <option value="">9 Days</option>
                                                                    <option value="">10 Days</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-12 c_wednesday_start" style="display:none;">
                                                            <div class="col-md-12">Wednesday Time</div>
                                                            <div class="form-group col-md-4">
                                                                <label>From</label>
                                                                <input type="text" class="c_wedquicktimepicker form-control" name="hours[wednesday_start]" autocomplete="off" style=" width:100%" value="{{$hours['wednesday_start']}}">
                                                            </div>
                                                            <div class="form-group col-md-4">
                                                                <label>To</label>
                                                                <input type="text" class="c_timepicker form-control" name="hours[wednesday_end]" autocomplete="off" style=" width:100%" value="{{$hours['wednesday_end']}}">
                                                            </div>
                                                            <div class="form-group col-md-4">
                                                                <label>Duration</label>
                                                                <select name="wedduration" id="c_wedduration" class="form-control">
                                                                    <option value="">30 Minutes</option>
                                                                    <option value="">45 Minutes</option>
                                                                    <option value="">1 Hours</option>
                                                                    <option value="">2 Hours</option>
                                                                    <option value="">3 Hours</option>
                                                                    <option value="">4 Hours</option>
                                                                    <option value="">5 Hours</option>
                                                                    <option value="">6 Hours</option>
                                                                    <option value="">7 Hours</option>
                                                                    <option value="">8 Hours</option>
                                                                    <option value="">9 Hours</option>
                                                                    <option value="">10 Hours</option>
                                                                    <option value="">1 Day</option>
                                                                    <option value="">2 Days</option>
                                                                    <option value="">3 Days</option>
                                                                    <option value="">4 Days</option>
                                                                    <option value="">5 Days</option>
                                                                    <option value="">6 Days</option>
                                                                    <option value="">7 Days</option>
                                                                    <option value="">8 Days</option>
                                                                    <option value="">9 Days</option>
                                                                    <option value="">10 Days</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-12 c_thrusday_start" style="display:none;">
                                                            <div class="col-md-12">Thursday Time</div>
                                                            <div class="form-group col-md-4">
                                                                <label>From</label>
                                                                <input type="text" class="c_thrusquicktimepicker form-control" name="hours[thrusday_start]" autocomplete="off" style=" width:100%" value="{{$hours['thrusday_start']}}">
                                                            </div>
                                                            <div class="form-group col-md-4">
                                                                <label>To</label>
                                                                <input type="text" class="c_timepicker form-control" name="hours[thrusday_end]" autocomplete="off" style=" width:100%" value="{{$hours['thrusday_end']}}">
                                                            </div>
                                                            <div class="form-group col-md-4">
                                                                <label>Duration</label>
                                                                <select name="thuduration" id="c_thuduration" class="form-control">
                                                                    <option value="">30 Minutes</option>
                                                                    <option value="">45 Minutes</option>
                                                                    <option value="">1 Hours</option>
                                                                    <option value="">2 Hours</option>
                                                                    <option value="">3 Hours</option>
                                                                    <option value="">4 Hours</option>
                                                                    <option value="">5 Hours</option>
                                                                    <option value="">6 Hours</option>
                                                                    <option value="">7 Hours</option>
                                                                    <option value="">8 Hours</option>
                                                                    <option value="">9 Hours</option>
                                                                    <option value="">10 Hours</option>
                                                                    <option value="">1 Day</option>
                                                                    <option value="">2 Days</option>
                                                                    <option value="">3 Days</option>
                                                                    <option value="">4 Days</option>
                                                                    <option value="">5 Days</option>
                                                                    <option value="">6 Days</option>
                                                                    <option value="">7 Days</option>
                                                                    <option value="">8 Days</option>
                                                                    <option value="">9 Days</option>
                                                                    <option value="">10 Days</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-12 c_friday_start" style="display:none;">
                                                            <div class="col-md-12">Friday Time</div>
                                                            <div class="form-group col-md-4">
                                                                <label>From</label>
                                                                <input type="text" class="c_friquicktimepicker form-control" name="hours[friday_start]" autocomplete="off" style=" width:100%" value="{{$hours['friday_start']}}">
                                                            </div>
                                                            <div class="form-group col-md-4">
                                                                <label>To</label>
                                                                <input type="text" class="c_timepicker form-control" name="hours[friday_end]" autocomplete="off" style=" width:100%" value="{{$hours['friday_end']}}">
                                                            </div>
                                                            <div class="form-group col-md-4">
                                                                <label>Duration</label>
                                                                <select name="friduration" id="c_friduration" class="form-control">
                                                                    <option value="">30 Minutes</option>
                                                                    <option value="">45 Minutes</option>
                                                                    <option value="">1 Hours</option>
                                                                    <option value="">2 Hours</option>
                                                                    <option value="">3 Hours</option>
                                                                    <option value="">4 Hours</option>
                                                                    <option value="">5 Hours</option>
                                                                    <option value="">6 Hours</option>
                                                                    <option value="">7 Hours</option>
                                                                    <option value="">8 Hours</option>
                                                                    <option value="">9 Hours</option>
                                                                    <option value="">10 Hours</option>
                                                                    <option value="">1 Day</option>
                                                                    <option value="">2 Days</option>
                                                                    <option value="">3 Days</option>
                                                                    <option value="">4 Days</option>
                                                                    <option value="">5 Days</option>
                                                                    <option value="">6 Days</option>
                                                                    <option value="">7 Days</option>
                                                                    <option value="">8 Days</option>
                                                                    <option value="">9 Days</option>
                                                                    <option value="">10 Days</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-12 c_saturday_start" style="display:none;">
                                                            <div class="col-md-12">Saturday Time</div>
                                                            <div class="form-group col-md-4">
                                                                <label>From</label>
                                                                <input type="text" class="c_satquicktimepicker form-control" name="hours[saturday_start]" autocomplete="off" style=" width:100%" value="{{$hours['saturday_start']}}">
                                                            </div>

                                                            <div class="form-group col-md-4">
                                                                <label>To</label>
                                                                <input type="text" class="c_timepicker form-control" name="hours[saturday_end]" autocomplete="off" style=" width:100%" value="{{$hours['saturday_end']}}">
                                                            </div>

                                                            <div class="form-group col-md-4">
                                                                <label>Duration</label>
                                                                <select name="satduration" id="c_satduration" class="form-control">
                                                                    <option value="">30 Minutes</option>
                                                                    <option value="">45 Minutes</option>
                                                                    <option value="">1 Hours</option>
                                                                    <option value="">2 Hours</option>
                                                                    <option value="">3 Hours</option>
                                                                    <option value="">4 Hours</option>
                                                                    <option value="">5 Hours</option>
                                                                    <option value="">6 Hours</option>
                                                                    <option value="">7 Hours</option>
                                                                    <option value="">8 Hours</option>
                                                                    <option value="">9 Hours</option>
                                                                    <option value="">10 Hours</option>
                                                                    <option value="">1 Day</option>
                                                                    <option value="">2 Days</option>
                                                                    <option value="">3 Days</option>
                                                                    <option value="">4 Days</option>
                                                                    <option value="">5 Days</option>
                                                                    <option value="">6 Days</option>
                                                                    <option value="">7 Days</option>
                                                                    <option value="">8 Days</option>
                                                                    <option value="">9 Days</option>
                                                                    <option value="">10 Days</option>
                                                                </select>
                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                            <br>
                                            <div class="col-md-12 text-center" style="margin-top: 50px;">
                                                <a id="test" class="button-fitness c_add-another-time">Add Another Time</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <br>
                            <div class="row">
                                <div class="col-md-6">
                                    <button type="button" class="btn-bck" id="bck-btn14"><i class="fa fa-arrow-left"></i> Back</button>
                                </div>
                                <div class="col-md-6 text-right">
                                    <button type="button" class="btn-nxt" id="btn-nxt15">Continue <i class="fa fa-arrow-right"></i></button>
                                </div>
                            </div>
                            <br>
                        </div>
                    </section>
                </div>

                <div class="container-fluid p-0" id="classes_5" style="display: none;">

                    <div class="tab-hed">Create Services & Prices</div>

                    <div style="background: black;width: 107%;margin-left: -38px;padding: 6px;">
                        <span class="nav-link1 subtab">INDEPENDENT</span>
                        <span class="nav-link1 subtab1">CLASSES</span>
                        <span class="nav-link1 subtab2">EXPERIENCES</span>
                    </div>

                    <section class="row">

                        <div class="col-md-12">

                            <div class="row">

                                <div class="col-md-12">
                                    <h3 style="font-size: 17px;font-weight: bold;">SET UP YOUR PRICING DETAILS</h3>
                                </div>

                                <div class="col-md-12" style="padding: 30px 20px;">

                                    <div class="form-group col-md-12">
                                        <label for="c_salestax" class="c_percentageckeck">
                                            <input type="checkbox" value="csalestax" onClick="" class="" name="c_salestax" id="c_salestax"> Sales Tax <a href="#" class="tooltip-custom sp1" data-toggle="tooltip" data-placement="top" title="Lorem ipsum, or lipsum as it is sometimes known, is dummy text used in laying out print, graphic or web designs.">?</a>
                                        </label>
                                        <div class="c_salestaxpercentage" id="c_salestaxpercentage" style="position: absolute; left: 13%; top:-1px;">
                                            <input type="text" value="" name="c_salestaxpercentage" maxlength="3" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" class="form-control c_percentage"> %
                                        </div>

                                    </div>

                                    <div class="form-group col-md-12">
                                        <label for="c_duestax" class="c_percentageckeck">
                                            <input type="checkbox" onClick="" value="cduestax" class="" name="c_duestax" id="c_duestax"> Dues Tax <a href="#" class="tooltip-custom sp1" data-toggle="tooltip" data-placement="top" title="Lorem ipsum, or lipsum as it is sometimes known, is dummy text used in laying out print, graphic or web designs.">?</a>
                                        </label>
                                        <div class="c_duestaxpercentage" id="c_duestaxpercentage" style="position: absolute; left: 13%; top:-1px;">
                                            <input type="text" value="" maxlength="3" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" name="c_duestaxpercentage" class="form-control c_percentage"> %
                                        </div>

                                    </div>

                                </div>


                                <div class="pricing_details_all-c">
                                    <div class="col-md-12 pricing-details">

                                        <div class="pricing-details-block recuring">
                                            <label for="">Recuring Payment</label>
                                            <input type="checkbox" name="" id="">
                                        </div>

                                        <div class="pricing-details-block">
                                            <label for="">Numbers of Sessions</label>
                                            <input type="text" name="" id="" class="form-control">
                                        </div>

                                        <div class="pricing-details-block price-b">
                                            <label for="">Price</label>
                                            <span class="dollar-span" style="display: block;">$</span>
                                            <input type="text" name="" id="" class="form-control">
                                        </div>

                                        <div class="pricing-details-block dis-cate">
                                            <label for="">Discount Category</label>
                                            <select name="discount_frm" id="c_discount_frm" multiple>
                                                <option hidden>Select Value</option>
                                                <option value="">Free</option>
                                                <option value="">Consultation</option>
                                                <option value="">Assessment</option>
                                                <option value="">Trial</option>
                                                <option value="">Gift</option>
                                                <option value="">Student </option>
                                                <option value="">Military</option>
                                                <option value="">Black Friday</option>
                                                <option value="">Holiday</option>
                                                <option value="">Cyber Monday</option>
                                                <option value="">New Years </option>
                                                <option value="">Summer</option>
                                                <option value="">Winter</option>
                                                <option value="">Fall</option>
                                                <option value="">Spring</option>
                                                <option value="">Online</option>
                                            </select>
                                            <script>
                                                var p = new SlimSelect({
                                                    select: '#c_discount_frm'
                                                });

                                            </script>
                                        </div>

                                        <div class="pricing-details-block">
                                            <label for="">Discount Type</label>
                                            <select name="discounttype" class="form-control" id="discount_type">
                                                <option value="">$ Dollar</option>
                                                <option value="">% Percentage</option>
                                            </select>
                                        </div>

                                        <div class="pricing-details-block">
                                            <label for="">Discount</label>
                                            <input type="text" name="" id="" class="form-control" placeholder="$100">
                                        </div>

                                        <div class="pricing-details-block earnings">
                                            <label for="">Your Estimated Earnings <a href="#" class="custom_que">?</a></label>
                                            <input type="text" name="" id="" class="form-control">
                                        </div>

                                        <div class="pricing-details-block">
                                            <label for="">Set Number</label>
                                            <input type="text" name="" id="" class="form-control" placeholder="(ex,1,2,3,etc.)">
                                        </div>

                                        <div class="pricing-details-block1">
                                            <p>Set Expiration</p>
                                            <div class="pricing-dblock">
                                                <label for="">Duration</label>
                                                <select name="duration" id="duration" class="form-control">
                                                    <option hidden>Select Value</option>
                                                    <option value="">30 Minutes</option>
                                                    <option value="">45 Minutes</option>
                                                    <option value="">1 Hours</option>
                                                    <option value="">2 Hours</option>
                                                    <option value="">3 Hours</option>
                                                    <option value="">4 Hours</option>
                                                    <option value="">5 Hours</option>
                                                    <option value="">6 Hours</option>
                                                    <option value="">7 Hours</option>
                                                    <option value="">8 Hours</option>
                                                    <option value="">9 Hours</option>
                                                    <option value="">10 Hours</option>
                                                    <option value="">1 Day</option>
                                                    <option value="">2 Days</option>
                                                    <option value="">3 Days</option>
                                                    <option value="">4 Days</option>
                                                    <option value="">5 Days</option>
                                                    <option value="">6 Days</option>
                                                    <option value="">7 Days</option>
                                                    <option value="">8 Days</option>
                                                    <option value="">9 Days</option>
                                                    <option value="">10 Days</option>
                                                </select>
                                            </div>
                                            <div class="pricing-dblock">
                                                <label for="">After</label>
                                                <select name="after_frm" id="c_after_frm" multiple>
                                                    <option hidden>Select Value</option>
                                                    <option value="">1</option>
                                                    <option value="">2</option>
                                                    <option value="">3</option>
                                                    <option value="">4</option>
                                                    <option value="">5</option>
                                                </select>
                                                <script>
                                                    var p = new SlimSelect({
                                                        select: '#c_after_frm'
                                                    });

                                                </script>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12" style="margin-top: 20px;">
                                    <a class="button-fitness add-another-session-c">+ Add Another Session</a>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <br>
                            <div class="row">
                                <div class="col-md-6">
                                    <button type="button" class="btn-bck" id="bck-btn15"><i class="fa fa-arrow-left"></i> Back</button>
                                </div>

                                <div class="col-md-6 text-right">
                                    <button type="button" class="btn-nxt" id="btn-nxt16">Complete <i class="fa fa-arrow-right"></i></button>
                                </div>
                            </div>
                            <br>
                        </div>
                    </section>
                </div>

                <div class="container-fluid p-0" id="experiences1" style="display: none;">
                    <div class="tab-hed">Create Services & Prices</div>
                    <div style="background: black;width: 107%;margin-left: -38px;padding: 6px;">
                        <span class="nav-link1 subtab">INDEPENDENT</span>
                        <span class="nav-link1 subtab1">CLASSES</span>
                        <span class="nav-link1 subtab2">EXPERIENCES</span>
                    </div>

                    <section class="row">
                        <div class="col-md-4">
                            <br>
                            <br>
                            <br>
                            <!--<button class="btn-cate">Click To Add Activity Category</button>-->
                            <select name="frm_servicesport" id="frm_servicesport" class="form-control">
                                <option value="">Choose a Sport/Activity</option>
                                <option value="18">Aerobics</option>
                                <option value="26">Archery</option>
                                <option value="31">Badminton</option>
                                <option value="71">Barre</option>
                                <option value="4">Baseball</option>
                                <option value="3">Basketball</option>
                                <option value="33">Beach Vollyball</option>
                                <option value="15">Bouldering</option>
                                <option value="65">Bungee Jumping</option>
                                <optgroup label="Camps &amp; Clinics">
                                    <option value="29">Day Camp</option>
                                    <option value="28">Sleep Away</option>
                                    <option value="77">Winter Camp</option>
                                </optgroup>
                                <option value="63">Canoeing</option>
                                <optgroup label="Cycling">
                                    <option value="72">Indoor cycling</option>
                                </optgroup>
                                <option value="74">Dance</option>
                                <option value="39">Diving</option>
                                <optgroup label="Field Hockey">
                                    <option value="6">Ice Hockey</option>
                                </optgroup>
                                <option value="1">Football</option>
                                <option value="2">Golf</option>
                                <option value="68">Gymnastics</option>
                                <option value="58">Hang Gliding</option>
                                <option value="70">Hiit</option>
                                <option value="60">Hiking - Backpacking</option>
                                <option value="42">Horseback Riding</option>
                                <option value="69">ice Skating</option>
                                <option value="40">Kayaking</option>
                                <option value="41">lacrosse</option>
                                <option value="50">Laser Tag</option>
                                <optgroup label="Martial Arts">
                                    <option value="5">Boxing</option>
                                    <option value="35">Jiu-Jitsu</option>
                                    <option value="21">Karate</option>
                                    <option value="13">Kick Boxing</option>
                                    <option value="17">Kung Fu</option>
                                    <option value="22">MMA</option>
                                    <option value="24">Self-Defense</option>
                                    <option value="46">Tai Chi</option>
                                    <option value="10">Wrestling</option>
                                </optgroup>
                                <option value="43">Massage Therapy</option>
                                <option value="25">Nutrition</option>
                                <option value="49">Paint Ball</option>
                                <option value="45">Physical Therapy</option>
                                <option value="44">Pilates</option>
                                <option value="57">Rafting</option>
                                <option value="66">Rapelling</option>
                                <option value="67">Rock Climbing</option>
                                <option value="48">Rowing</option>
                                <option value="47">Running</option>
                                <optgroup label="Sightseeing Tours">
                                    <option value="53">Airplane Tour</option>
                                    <option value="56">ATV Tours</option>
                                    <option value="55">Boat Tours</option>
                                    <option value="54">Bus Tour</option>
                                    <option value="59">Caving Tours</option>
                                    <option value="51">Helicopter Tour</option>
                                </optgroup>
                                <option value="61">Sailing</option>
                                <option value="38">Scuba Diving</option>
                                <option value="9">Sky diving</option>
                                <option value="34">Snow Skiing</option>
                                <option value="37">Snowboarding</option>
                                <option value="73">Strength &amp; Conditioning</option>
                                <option value="36">Surfing</option>
                                <option value="20">Swimming</option>
                                <option value="8">Tennis</option>
                                <option value="76">Tours</option>
                                <option value="32">Vollyball</option>
                                <option value="75">Weight training</option>
                                <option value="62">Windsurfing</option>
                                <option value="19">Yoga</option>
                                <option value="64">Zip-Line</option>
                                <option value="30">Zumba</option>
                            </select>
                            <br>
                            <input type="text" name="frm_servicetitle_2" id="frm_servicetitle_2" placeholder="Name of Program" title="servicetitle" value="" class="form-control">
                            <br>
                            <br>
                            <div class="text-center"> <label>No Service Added Yet.<br>
                                    Get started by selecting Add Activity Category to choose the activity.</label></div>
                        </div>

                        <div class="col-md-8 text-justify" style="padding: 10px 40px;">
                            <br>
                            <br>
                            <p>
                                Let's create your itinerary, service details and prices for your experience. <br>
                                Let customers know what the plans are. Describe what you will do with your customers. <br>
                                What unique details set it apart from other similar experiences? How will you make customers feel included and engaged during your time together? Being specific about what guests will do on your activity. Set up a detailed itinerary so that guests know what to expect.
                            </p>
                            <h3>Recommended Tips to Do :</h3>
                            <p>- Create an experience around your activity.</p>
                            <p>- Make in unique and different</p>
                            <p>- Think about your meet-up points, how customers will get to you.</p>
                            <p>- Think about what your experience includes and what your customers will need to bring.</p>
                            <p>- Think about your plans and think about the experience your customer will have</p>
                            <h3>Tips Not to Do :</h3>
                            <p>- Having no experience planned around your activity</p>
                            <p>- Not having a well-planned experience.</p>
                            <p>- Giving incomplete information is not recommended.</p>
                            <p>- Creating generic experience and activities customers can easily do on their own.</p>
                            <p>- Offering an experience you are not qualified or skilled to host.</p>
                        </div>
                        <div class="col-md-12">
                            <br>
                            <div class="row">
                                <div class="col-md-6">
                                    <button type="button" class="btn-bck" id="bck-btn16"><i class="fa fa-arrow-left"></i> Back</button>
                                </div>
                                <div class="col-md-6 text-right">
                                    <button type="button" class="btn-nxt" id="btn-nxt17">Continue <i class="fa fa-arrow-right"></i></button>
                                </div>
                            </div>
                            <br>
                        </div>
                    </section>
                </div>

                <div class="container-fluid p-0" id="experiences2" style="display: none;">
                    <div class="tab-hed">Create Services & Prices</div>
                    <div style="background: black;width: 107%;margin-left: -38px;padding: 6px;">
                        <span class="nav-link1 subtab">INDEPENDENT</span>
                        <span class="nav-link1 subtab1">CLASSES</span>
                        <span class="nav-link1 subtab2">EXPERIENCES</span>
                    </div>
                    <section class="row">
                        <div class="col-md-12">
                            <br>
                            <div class="row">
                                <div class="col-md-8">
                                    <div class="row">
                                        <div class="form-group col-md-12">
                                            <label for="pwd">Set up the programs for your {Sightseeing- ATV} Experience. Let's get a few details about the experoence</label>
                                            <input type="text" class="form-control" name="frm_servicetitle2" id="frm_servicetitle2" title="servicetitle" readonly value="">
                                        </div>

                                        <div class="form-group col-md-12">
                                            <textarea class="form-control" rows="6" name="frm_servicedesc" id="frm_servicedesc" placeholder="Enter description of the experoence"></textarea>
                                            <div class="text-right">150 Characters Left</div>
                                        </div>

                                        <div class="form-group col-md-12">
                                            <label class="switch" for="booking5">
                                                <input type="radio" name="booking" id="booking5">
                                                <span class="slider round"></span>
                                            </label>
                                            <span>INSTANT BOOKING : Allow customers to book you instantly</span>
                                        </div>

                                        <div class="form-group col-md-12">
                                            <label class="switch" for="booking6">
                                                <input type="radio" name="booking" id="booking6">
                                                <span class="slider round"></span>
                                            </label>
                                            <span>RESERVED BOOKING : You need to confirm each booking first before completion</span>
                                        </div>

                                        <div class="form-group col-md-12">
                                            <label>How much notice do you need for each booking ?</label>
                                        </div>

                                        <div class="form-group col-md-6">
                                            <select class="form-control" name="notice_each_book_day" id="firstdayweek1" rel="notice1">
                                                <option hidden>Select Value</option>
                                                <option values="Days">Days</option>
                                                <option values="Weeks">Weeks</option>
                                                <option values="Months">Months</option>
                                            </select>
                                        </div>

                                        <div class="form-group col-md-6">
                                            <select class="form-control" name="notice_each_book_ans" id="notice1">
                                                <option hidden>Select Value</option>
                                                <option values="1">1</option>
                                                <option values="2">2</option>
                                                <option values="3">3</option>
                                                <option values="4">4</option>
                                                <option values="5">5</option>
                                                <option values="6">6</option>
                                                <option values="7">7</option>
                                                <option values="8">8</option>
                                                <option values="9">9</option>
                                                <option values="10">10</option>
                                                <option values="11">11</option>
                                                <option values="12">12</option>
                                                <option values="13">13</option>
                                                <option values="14">14</option>
                                                <option values="15">15</option>
                                                <option values="16">16</option>
                                                <option values="17">17</option>
                                                <option values="18">18</option>
                                                <option values="19">19</option>
                                                <option values="20">20</option>
                                                <option values="21">21</option>
                                                <option values="22">22</option>
                                                <option values="23">23</option>
                                                <option values="24">24</option>
                                                <option values="25">25</option>
                                                <option values="26">26</option>
                                                <option values="27">27</option>
                                                <option values="28">28</option>
                                                <option values="29">29</option>
                                                <option values="30">30</option>
                                                <option values="31">31</option>
                                            </select>
                                        </div>

                                        <script>
                                            $('#firstdayweek1').change(function () {
                                                var t = $('#firstdayweek1 option:selected').val();
                                                var id = $('#firstdayweek1').attr('rel');
                                                console.log(t, "---", id)
                                                if (t == 'Days') {
                                                    options_f(31, id);
                                                }
                                                if (t == 'Weeks') {
                                                    options_f(52, id);
                                                }
                                                if (t == 'Months') {
                                                    options_f(12, id);
                                                }
                                            });

                                        </script>

                                        <div class="form-group col-md-12">
                                            <label>How far in advance can a customer book ?</label>
                                        </div>

                                        <div class="form-group col-md-6">
                                            <select class="form-control" name="advance_book_day" id="secdayweek1" rel="addvance1">
                                                <option hidden>Select Value</option>
                                                <option>Days</option>
                                                <option>Weeks</option>
                                                <option>Months</option>
                                            </select>
                                        </div>

                                        <div class="form-group col-md-6">
                                            <select class="form-control" name="advance_book_ans" id="addvance1">
                                                <option hidden>Select Value</option>
                                                <option value="1">1</option>
                                                <option value="2">2</option>
                                                <option value="3">3</option>
                                                <option value="4">4</option>
                                                <option value="5">5</option>
                                                <option value="6">6</option>
                                                <option value="7">7</option>
                                                <option value="8">8</option>
                                                <option value="9">9</option>
                                                <option value="10">10</option>
                                                <option value="11">11</option>
                                                <option value="12">12</option>
                                                <option value="13">13</option>
                                                <option value="14">14</option>
                                                <option value="15">15</option>
                                                <option value="16">16</option>
                                                <option value="17">17</option>
                                                <option value="18">18</option>
                                                <option value="19">19</option>
                                                <option value="20">20</option>
                                                <option value="21">21</option>
                                                <option value="22">22</option>
                                                <option value="23">23</option>
                                                <option value="24">24</option>
                                                <option value="25">25</option>
                                                <option value="26">26</option>
                                                <option value="27">27</option>
                                                <option value="28">28</option>
                                                <option value="29">29</option>
                                                <option value="30">30</option>
                                                <option value="31">31</option>
                                            </select>
                                        </div>
                                        <script>
                                            $('#secdayweek1').change(function () {
                                                var t = $('#secdayweek1 option:selected').val();
                                                var id = $('#secdayweek1').attr('rel');
                                                console.log(t, "---", id)
                                                if (t == 'Days') {
                                                    options_f(31, id);
                                                }
                                                if (t == 'Weeks') {
                                                    options_f(52, id);
                                                }
                                                if (t == 'Months') {
                                                    options_f(12, id);
                                                }
                                            });

                                        </script>

                                        <div class="form-group col-md-12">
                                            <label>What's the latest moment a person can book your activity?</label>
                                        </div>

                                        <div class="form-group col-md-6">
                                            <select class="form-control" name="notice_each_book_day" id="firstminute" rel="notice2">
                                                <option hidden>Select Value</option>
                                                <option values="Minute">Minute</option>
                                                <option values="Hours">Hours</option>
                                                <option values="Days">Days</option>
                                                <option values="Weeks">Weeks</option>
                                            </select>
                                        </div>

                                        <div class="form-group col-md-6">
                                            <select class="form-control" name="notice_each_book_ans" id="notice2">
                                                <option hidden>Select Value</option>
                                                <option values="1">1</option>
                                                <option values="2">2</option>
                                                <option values="3">3</option>
                                                <option values="4">4</option>
                                                <option values="5">5</option>
                                                <option values="6">6</option>
                                                <option values="7">7</option>
                                                <option values="8">8</option>
                                                <option values="9">9</option>
                                                <option values="10">10</option>
                                                <option values="11">11</option>
                                                <option values="12">12</option>
                                                <option values="13">13</option>
                                                <option values="14">14</option>
                                                <option values="15">15</option>
                                                <option values="16">16</option>
                                                <option values="17">17</option>
                                                <option values="18">18</option>
                                                <option values="19">19</option>
                                                <option values="20">20</option>
                                                <option values="21">21</option>
                                                <option values="22">22</option>
                                                <option values="23">23</option>

                                                <option values="24">24</option>
                                                <option values="25">25</option>
                                                <option values="26">26</option>
                                                <option values="27">27</option>
                                                <option values="28">28</option>
                                                <option values="29">29</option>
                                                <option values="30">30</option>
                                                <option values="31">31</option>
                                            </select>
                                        </div>

                                        <script>
                                            $('#firstminute').change(function () {
                                                var t = $('#firstminute option:selected').val();
                                                var id = $('#firstminute').attr('rel');
                                                console.log(t, "---", id)
                                                if (t == 'Minute') {
                                                    options_f(60, id);
                                                }
                                                if (t == 'Hours') {
                                                    options_f(24, id);
                                                }
                                                if (t == 'Days') {
                                                    options_f(31, id);
                                                }
                                                if (t == 'Weeks') {
                                                    options_f(52, id);
                                                }
                                            });

                                        </script>

                                        <div class="form-group col-md-12">
                                            <label>Whats th latest a customer can cancel?</label>
                                        </div>

                                        <div class="form-group col-md-6">
                                            <select class="form-control" name="advance_book_day" id="secdayhours" rel="addvance2">
                                                <option hidden>Select Value</option>
                                                <option>Hours</option>
                                                <option>Days</option>
                                                <option>Weeks</option>
                                                <option>Months</option>
                                            </select>
                                        </div>

                                        <div class="form-group col-md-6">
                                            <select class="form-control" name="advance_book_ans" id="addvance2">
                                                <option hidden>Select Value</option>
                                                <option value="1">1</option>
                                                <option value="2">2</option>
                                                <option value="3">3</option>
                                                <option value="4">4</option>
                                                <option value="5">5</option>
                                                <option value="6">6</option>
                                                <option value="7">7</option>
                                                <option value="8">8</option>
                                                <option value="9">9</option>
                                                <option value="10">10</option>
                                                <option value="11">11</option>
                                                <option value="12">12</option>
                                                <option value="13">13</option>
                                                <option value="14">14</option>
                                                <option value="15">15</option>
                                                <option value="16">16</option>
                                                <option value="17">17</option>
                                                <option value="18">18</option>
                                                <option value="19">19</option>
                                                <option value="20">20</option>
                                                <option value="21">21</option>
                                                <option value="22">22</option>
                                                <option value="23">23</option>
                                                <option value="24">24</option>
                                                <option value="25">25</option>
                                                <option value="26">26</option>
                                                <option value="27">27</option>
                                                <option value="28">28</option>
                                                <option value="29">29</option>
                                                <option value="30">30</option>
                                                <option value="31">31</option>
                                            </select>
                                        </div>
                                        <script>
                                            $('#secdayhours').change(function () {
                                                var t = $('#secdayhours option:selected').val();
                                                var id = $('#secdayhours').attr('rel');
                                                console.log(t, "---", id)
                                                if (t == 'Hours') {
                                                    options_f(24, id);
                                                }
                                                if (t == 'Days') {
                                                    options_f(31, id);
                                                }
                                                if (t == 'Weeks') {
                                                    options_f(52, id);
                                                }
                                                if (t == 'Months') {
                                                    options_f(12, id);
                                                }
                                            });

                                        </script>

                                        <div class="form-group col-md-12">
                                            <label for="">What You Will Be Doing</label>
                                            <textarea class="form-control" rows="8" name="frm_servicedesc" id="frm_servicedesc" placeholder="Briefly describe what you'll do with your customers. Being Specific about what guests will do on your activity"></textarea>
                                            <div class="text-right">500 Characters Left</div>
                                        </div>

                                        <h3 class="col-md-12 text-center margin-bottom30" style="font-weight: bold;">
                                            What's Included with this experience?
                                        </h3>

                                        <div class="form-group col-md-12 wahts-b">
                                            <div class="included-block1">
                                                <label>You can Provide transportation and pick up from hotels etc., food and drinks, special equipment, video and photography services, or anything else special to make your guests comfortable..</label>
                                                <select name="frm_exe1" id="exeperience1" multiple>
                                                    <option>Safety & Protective Gear</option>
                                                    <option>Activity Equipment</option>
                                                    <option>Breakfast</option>
                                                    <option>Lunch</option>
                                                    <option>Dinner</option>
                                                    <option>Snacks</option>
                                                    <option>Drinks (tea, coffee, soda, bottled water, etc.) </option>
                                                    <option>Alcohol (beer, champagne, wine, mixed drink etc.)</option>
                                                    <option>Transportation</option>
                                                    <option>Insurance Coverage</option>
                                                    <option>Entrance Fees</option>
                                                    <option>Airfare</option>
                                                    <option>Taxes</option>
                                                    <option>Professional Guide</option>
                                                    <option>Guide Gratuity</option>
                                                    <option>Accommodations</option>
                                                    <option>Video</option>
                                                    <option>Photography</option>
                                                    <option>Fully Narrated</option>
                                                    <option>Historic landmarks</option>
                                                    <option>Rest period</option>
                                                    <option>Typical souvenir</option>
                                                </select>
                                            </div>
                                            <div class="addanother-ex" id="additem1">
                                                <i class="fa fa-plus"></i> Add another item
                                            </div>
                                            <script>
                                                var p = new SlimSelect({
                                                    select: '#exeperience1'
                                                });

                                            </script>
                                        </div>

                                        <h3 class="col-md-12 text-center margin-bottom30" style="font-weight: bold;">
                                            What's Not Included with this experience?
                                        </h3>

                                        <div class="form-group col-md-12 wahts_not">
                                            <div class="included-block2">
                                                <label>List the items or services that are not included with this experience. i.e. no food or drinks, no equipment, no insurance, etc.</label>
                                                <select name="frm_exe2" id="exeperience2" multiple>
                                                    <option>Safety & Protective Gear</option>
                                                    <option>Activity Equipment</option>
                                                    <option>Breakfast</option>
                                                    <option>Lunch</option>
                                                    <option>Dinner</option>
                                                    <option>Snacks</option>
                                                    <option>Drinks (tea, coffee, soda, bottled water, etc.) </option>
                                                    <option>Alcohol (beer, champagne, wine, mixed drink etc.)</option>
                                                    <option>Transportation</option>
                                                    <option>Insurance Coverage</option>
                                                    <option>Entrance Fees</option>
                                                    <option>Airfare</option>
                                                    <option>Taxes</option>
                                                    <option>Professional Guide</option>
                                                    <option>Guide Gratuity</option>
                                                    <option>Accommodations</option>
                                                    <option>Video</option>
                                                    <option>Photography</option>
                                                    <option>Fully Narrated</option>
                                                    <option>Historic landmarks</option>
                                                    <option>Rest period</option>
                                                    <option>Typical souvenir</option>
                                                </select>
                                            </div>
                                            <div class="addanother-ex" id="additem2">
                                                <i class="fa fa-plus"></i> Add another item
                                            </div>
                                            <script>
                                                var p = new SlimSelect({
                                                    select: '#exeperience2'
                                                });

                                            </script>
                                        </div>

                                        <h3 class="col-md-12 text-center margin-bottom30" style="font-weight: bold;">
                                            What Guest Should Bring and wear?
                                        </h3>

                                        <div class="form-group col-md-12 what_guest">
                                            <div class="included-block3">
                                                <label>If guests need anything in order to enjoy your exeperience, this is the place to tell them. This list will be emailed to guests when they book exeperience to help them prepare. Be as detailed as possible and add each item individually.</label>
                                                <select name="frm_exe3" id="exeperience3" multiple>
                                                    <option>Professional</option>
                                                    <option>Studio/Training Facility</option>
                                                    <option>Adventures & Tours</option>
                                                </select>
                                            </div>
                                            <div class="addanother-ex" id="additem3">
                                                <i class="fa fa-plus"></i> Add another item
                                            </div>
                                            <script>
                                                var p = new SlimSelect({
                                                    select: '#exeperience3'
                                                });

                                            </script>
                                        </div>

                                        <hr style="border: 1px solid #d4cfcf;width: 100%;">

                                        <h3 class="col-md-12 text-center margin-bottom30" style="font-weight: bold;">
                                            Require Verified ID
                                        </h3>

                                        <div class="form-group col-md-12">
                                            <label>The primary booker has to successfully complete verified ID in order for them and their guests to attend your exeperience.</label>
                                            <div class="require-block">
                                                <input type="checkbox" name="" id="">
                                                <label for="">Require the booker to have ID upon arrival for verification of age and identity <br> (This will be emailed to guest so they are prepared.)</label>
                                            </div>
                                        </div>

                                        <div class="col-md-12 text-center margin-bottom30">
                                            <h3 style="font-weight: bold;">Let's Plan Your Day By Day</h3>
                                            <p>No matter if its for one day or multiple days,</p>
                                        </div>

                                        <div class="form-group col-md-12 days_block">
                                            <div class="day-block">
                                                <div class="imgUp">
                                                    <label for="">Day-1</label>
                                                    <div class="imagePreview"></div>
                                                    <label class="img-tab-btn">Upload Image<input type="file" class="uploadFile img" value="Upload Photo" style="width: 0px;height: 0px;overflow: hidden;">
                                                    </label>
                                                </div>
                                                <div class="giveblock">
                                                    <input type="text" name="" id="" class="form-control" placeholder="Give a heading for this day.">
                                                    <textarea name="" id="" cols="30" rows="6" class="form-control" placeholder="Give a description for this day."></textarea>
                                                </div>
                                            </div>
                                            <div class="addanother-ex" id="addday1">
                                                <i class="fa fa-plus"></i> Add another day
                                            </div>
                                        </div>

                                    </div>
                                </div>

                                <div class="col-md-4 text-center">

                                    <div class="row">

                                        <div class="col-md-2"></div>

                                        <div class="col-md-8 imgUp">
                                            <div class="imagePreview"></div>
                                            <label class="img-tab-btn">Upload Image<input type="file" class="uploadFile img" value="Upload Photo" style="width: 0px;height: 0px;overflow: hidden;">
                                            </label>
                                            <label style="font-size: 12px;">Upload an image that best
                                                represents your program
                                            </label>
                                        </div>
                                    </div><!-- row -->
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <br>
                            <div class="row">
                                <div class="col-md-6">
                                    <button type="button" class="btn-bck" id="bck-btn17"><i class="fa fa-arrow-left"></i> Back</button>
                                </div>
                                <div class="col-md-6 text-right">
                                    <button type="button" class="btn-nxt" id="btn-nxt18">Continue <i class="fa fa-arrow-right"></i></button>
                                </div>
                            </div>
                            <br>
                        </div>
                    </section>
                </div>
                
                <div class="container-fluid p-0" id="detail-form5">
                    <div class="tab-hed">Create Services & Prices</div>
                    <div style="background: black;width: 107%;margin-left: -38px;padding: 6px;">
                        <span class="nav-link1 subtab">INDEPENDENT</span>
                        <span class="nav-link1 subtab1">CLASSES</span>
                        <span class="nav-link1 subtab2">EXPERIENCES</span>
                    </div>

                    <section class="row">
                        <div class="col-md-12 text-justify">
                            <br>
                            <p><span style="font-size: 22px;font-weight: bold;">YOU’RE ALMOST DONE!</span> This last section is where you will describe your programs, add attractive images, description, prices, taxes, terms
                                and conditions, contracts, one-time payments, recurring payment, sessions, and more. We recommend you make sure your price sare competitive to your skill level and to what the market demands</p>
                        </div>
                        <div class="col-md-12 text-center">
                            <br>
                            <span style="font-size: 20px;font-weight: bold;text-transform: uppercase;">Select Your Service Type</span><br>
                            <label>Click on the service option above start the process. Only choose the option that best represents the type of services you offer.<br> Don’t worry, you can set up more than one type of service.</label><br>
                        </div>
                        <div class="col-md-12">
                            <br> <br>
                            <div class="custome-div col-md-8">
                                <input type="radio" id="test1" name="radio-group" checked value="individual">
                                <label for="test1">
                                    <div class="row">
                                        <div class="col-md-2">
                                            <img src="/public/images/newimage/individual.jpeg" class="pro_card_img1">
                                        </div>
                                        <div class="col-md-10">
                                            <div class="tab-hed1">Individual</div>
                                            <p>A business service provider that offers personal training, coaching, nutrition advice, instructor and any business offering one-on-one services online, at a specific location or traveling to clients.</p>
                                        </div>
                                    </div>
                                </label>
                            </div>
                            <br>
                            <div class="custome-div col-md-8">
                                <input type="radio" id="test2" name="radio-group" value="classes">
                                <label for="test2">
                                    <div class="row">
                                        <div class="col-md-2">
                                            <img src="/public/images/newimage/media.jpg" class="pro_card_img1">
                                        </div>
                                        <div class="col-md-10">
                                            <div class="tab-hed1">Classes</div>
                                            <p>A business service provider that offers different types of group classes and training either online, your place of business or on location.</p>
                                        </div>
                                    </div>
                                </label>
                            </div>
                            <br>
                            <div class="custome-div col-md-8">
                                <input type="radio" id="test3" name="radio-group" value="experience">
                                <label for="test3">
                                    <div class="row">
                                        <div class="col-md-2">
                                            <img src="/public/images/newimage/get-started.jpg" class="pro_card_img1">
                                        </div>
                                        <div class="col-md-10">
                                            <div class="tab-hed1">Experience</div>
                                            <p>A business service provider that offers different types of adventures, tours and experiences either online, your place of business or on location.</p>
                                        </div>
                                    </div>
                                </label>
                            </div>
                            <br><br>

                        </div>

                        <div class="col-md-12">
                            <br>
                            <div class="row">
                                <div class="col-md-6">
                                    <button type="button" class="btn-bck" onclick="location.href ='{{route('verifiedBusinessProfile')}}'"><i class="fa fa-arrow-left"></i> Back</button>
                                </div>
                                <div class="col-md-6 text-right">
                                    <button type="button" class="btn-nxt" id="btn-nxt6">Continue <i class="fa fa-arrow-right"></i></button>
                                </div>
                            </div>
                            <br>
                        </div>
                    </section>
                </div>
                
                <div class="container-fluid p-0" id="experiences3" style="display: none;">

                    <div class="tab-hed">Create Services & Prices</div>

                    <div style="background: black;width: 107%;margin-left: -38px;padding: 6px;">
                        <span class="nav-link1 subtab">INDEPENDENT</span>
                        <span class="nav-link1 subtab1">CLASSES</span>
                        <span class="nav-link1 subtab2">EXPERIENCES</span>
                    </div>

                    <section class="row">

                        <br>

                        <div class="col-md-12">

                            <div class="row">

                                <div class="col-md-6">

                                    <div class="row">

                                        <div class="form-group col-md-12">

                                            <h3 style="font-size: 17px;font-weight: bold;">Describe the location</h3>

                                            <div class="form-group">
                                                <label>Tell customers how to meet up, where to meet up, meeting point name and how to find you once the customers arrive.</label><br>
                                                <textarea class="form-control" rows="6" name="frm_servicedesc" id="frm_servicedesc" placeholder="Don't leave it up to customers to figure out how to meet up with you. Let them know before hand. (Ex. We will pick you up at your hotel. Talk with your front desk staff or we will meet at Central Park at the entrance of 81st and Central Park West, (CPW). Wait at the seating area if you arrive early. The nstructor will have on a red hat and yellow vest. Please arrive 10 minutes before tour starts.)"></textarea>
                                            </div>

                                            <h3 style="font-size: 17px;font-weight: bold;">Where should customers meet you?</h3>

                                            <div class="form-group">
                                                <label for="email">if the meet up spot is different from the address you set earlier in Company Details, then you can set in here.</label>
                                            </div>

                                            <div class="row">

                                                <div class="form-group col-md-6">
                                                    <label for="">Country / Region</label>
                                                    <input type="text" name="" id="" class="form-control">
                                                </div>

                                                <div class="form-group col-md-6">
                                                    <label for="">Street address</label>
                                                    <input type="text" name="" id="" class="form-control">
                                                </div>

                                                <div class="form-group col-md-3" style="align-self: flex-end;">
                                                    <label for="">Apt, Suit, Bldg. <span style="font-size: 10px">(optional)</span></label>
                                                    <input type="text" name="" id="" class="form-control">
                                                </div>

                                                <div class="form-group col-md-3" style="align-self: flex-end;">
                                                    <label for="">City</label>
                                                    <input type="text" name="" id="" class="form-control">
                                                </div>

                                                <div class="form-group col-md-3" style="align-self: flex-end;">
                                                    <label for="">State</label>
                                                    <input type="text" name="" id="" class="form-control">
                                                </div>

                                                <div class="form-group col-md-3" style="align-self: flex-end;">
                                                    <label for="">ZIP Code</label>
                                                    <input type="text" name="" id="" class="form-control">
                                                </div>

                                                <div class="form-group col-md-12">
                                                    <a href="#" class="updat-map-btn">Update Map</a>
                                                </div>

                                                <h3 class="col-md-12" style="font-size: 17px;font-weight: bold;">Adjust the pin on the map</h3>

                                                <div class="form-group col-md-12">
                                                    <label for="email">You can drag the map so the pin is in the right location.</label>
                                                </div>

                                                <div class="col-md-12 maploaction-block">
                                                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d387190.2799160913!2d-74.25987584510597!3d40.6976700633816!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x89c24fa5d33f083b%3A0xc80b8f06e177fe62!2sNew%20York%2C%20NY%2C%20USA!5e0!3m2!1sen!2sin!4v1618213656452!5m2!1sen!2sin" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
                                                </div>

                                                <h3 class="col-md-12" style="font-size: 17px;font-weight: bold;">Confirm your phone number</h3>

                                                <div class="form-group col-md-12">
                                                    <label for="email">If customers have trouble finding your locatoin, they may need to call you. The number we'll give them is +1 (555) 555-5555. This was set during the company details section. You can update this number</label>
                                                </div>

                                            </div>

                                        </div>

                                    </div>
                                </div>

                                <div class="col-md-6">

                                    <br>

                                    <div class="row">

                                        <div class="form-group col-md-12">
                                            <label>Select Service Type</label>
                                            <select name="frmlservice" id="l_service" multiple>
                                                <option>Personal Training</option>
                                                <option>Coaching</option>
                                                <option>Class</option>
                                                <option>Therapy</option>
                                                <option>Gym</option>
                                                <option>Adventure</option>
                                                <option>Trip</option>
                                                <option>Tour</option>
                                                <option>Camp</option>
                                                <option>Team</option>
                                                <option>Clinic</option>
                                            </select>
                                            <script>
                                                var p = new SlimSelect({
                                                    select: '#l_service'
                                                });

                                            </script>
                                        </div>

                                        <div class="form-group col-md-12">
                                            <label>Location of Activity</label>
                                            <select name="frm_lactivity" id="l_activity" multiple>
                                                <option>Online</option>
                                                <option>At Business</option>
                                                <option>On Location</option>
                                            </select>
                                            <script>
                                                var p = new SlimSelect({
                                                    select: '#l_activity'
                                                });

                                            </script>
                                        </div>

                                        <div class="form-group col-md-12">
                                            <label>Activity Great For</label>
                                            <select name="frm_lgreat" id="l_greatfor" multiple>
                                                <option>Individual</option>
                                                <option>Kids</option>
                                                <option>Teens</option>
                                                <option>Adults</option>
                                                <option>Family</option>
                                                <option>Groups</option>
                                                <option>Any</option>
                                            </select>
                                            <script>
                                                var p = new SlimSelect({
                                                    select: '#l_greatfor'
                                                });

                                            </script>
                                        </div>

                                        <div class="form-group col-md-12">
                                            <label>Age Range</label>
                                            <select name="frm_lagerange" id="l_agerange" multiple>
                                                <option>Baby (0 to 12 months)</option>
                                                <option>Toddler (1 to 3 yrs.)</option>
                                                <option>Preschool (4 to 5 yrs.)</option>
                                                <option>Grade School (6 to 12 yrs.)</option>
                                                <option>Teen (13 to 17 yrs.)</option>
                                                <option>Young Adult (18 to 21 yrs.)</option>
                                                <option>Older Adult (21 to 39 yrs.)</option>
                                                <option>Middle Age (40 to 59 yrs.) </option>
                                                <option>Senior Adult (60 +)</option>
                                                <option>Any</option>
                                            </select>
                                            <script>
                                                var p = new SlimSelect({
                                                    select: '#l_agerange'
                                                });

                                            </script>
                                        </div>

                                        <div class="form-group col-md-12">
                                            <label>Difficulty Level</label>
                                            <select name="frm_ldifficulty" id="l_difficulty" multiple>
                                                <option>Beginner</option>
                                                <option>Intermediate</option>
                                                <option>Advanced</option>
                                                <option>Professional</option>
                                                <option>Expert</option>
                                                <option>Any</option>
                                            </select>
                                            <script>
                                                var p = new SlimSelect({
                                                    select: '#l_difficulty'
                                                });

                                            </script>
                                        </div>

                                        <div class="form-group col-md-12">
                                            <label>What experience will the customers have</label>
                                            <select name="frm_lcustomers" id="l_customershave" multiple>
                                                <option value="teaching_a_desired_skill"> Teaching a desired skill</option>
                                                <option value="accomplish_a_goal_or_skill"> Accomplish a goal or skill</option>
                                                <option value="cardio"> Cardio</option>
                                                <option value="weight_loss"> Weight loss</option>
                                                <option value="technique"> Technique</option>
                                                <option value="strength_and_conditioning"> Strength and conditioning</option>
                                                <option value="athletic_conditioning"> Athletic conditioning</option>
                                                <option value="body_building"> Body building</option>
                                                <option value="total_body_workout"> Total body workout</option>
                                                <option value="get_toned"> Get toned</option>
                                                <option value="with_equipment"> With equipment</option>
                                                <option value="fun_experience"> Fun experience</option>
                                                <option value="thrilling_experience"> Thrilling experience</option>
                                                <option value="challenging_experience"> Challenging experience</option>
                                                <option value="gross_motor_skills"> Gross motor skills</option>
                                                <option value="hand_eye_coordination"> Hand eye coordination</option>
                                                <option value="discipline"> Discipline</option>
                                                <option value="focus"> Focus</option>
                                                <option value="self-defense"> Self-Defense</option>
                                                <option value="confidence"> Confidence</option>
                                                <option value="mental_challenge"> Mental Challenge</option>
                                            </select>
                                            <script>
                                                var p = new SlimSelect({
                                                    select: '#l_customershave'
                                                });

                                            </script>
                                        </div>

                                        <div class="form-group col-md-12">
                                            <label>Personality & Habits of Instructor</label>
                                            <select name="frm_lproviders" id="l_providers" multiple>
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
                                                    select: '#l_providers'
                                                });

                                            </script>
                                        </div>
                                    </div><!-- row -->
                                </div>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <br>
                            <div class="row">

                                <div class="col-md-6">
                                    <button type="button" class="btn-bck" onclick="location.href ='{{route('verifiedBusinessProfile')}}'"><i class="fa fa-arrow-left"></i> Back</button>
                                </div>

                                <div class="col-md-6 text-right">
                                    <button type="button" class="btn-nxt" id="btn-nxt19">Complete <i class="fa fa-arrow-right"></i></button>
                                </div>
                            </div>
                            <br>
                        </div>
                    </section>
                </div>
                </

        </div>
    </div>
</div>

@include('layouts.footer')
<script src="{{ url('public/js/scripts.js') }}"></script>
@endsection
