<!-- Modal content-->
<?php $step_count=3;?>
<?php $current_step=1;?>
<style type="text/css">
    .instant_hire_btn {
        font-size: 16px !important;
        color: #FFF !important;
        background: #f53b49 !important;
        border: 0px !important;
        padding: 10px 15px !important;
        display: inline-table !important;
        font-weight: 300;
        width: 50% !important;
        margin: 0px 0px 20px 24px !important;
    }

    .for_btn {
        min-height: 140px !important;
    }

    .signleft-3row {
        width: 33%;
    }

    .new-signup-left-3row {
        min-height: 450px !important;
    }

    .new-signup-left-3row h2 {
        font-size: 31px !important;
    }

    .containr {
        position: relative;
        top: -32px;
        left: 36px;

    }

    .image {
        display: block;
        width: 84%;
        height: 340px;
    }

    .btn_select {
        font-size: 16px !important;
        color: #FFF !important;
        background: #f53b49 !important;
        border: 0px !important;
        padding: 10px 15px !important;
        display: inline-table !important;
        font-weight: 300;
        width: 50% !important;
        margin: 0px 0px 0px 24px !important;
    }

    .containr:hover .overlay {
        height: 60%;
    }

    .overlay {
        position: absolute;
        bottom: 0px;
        left: 0;
        right: 0;
        background-color: #00000085;
        overflow: hidden;
        width: 84%;
        height: 0;
        transition: .5s ease;
    }

</style>
<?php if(@$selectedSportId > 0){ 
   $url = '/direct-hire?selected_sport='.$selectedSportId;
   } else { 
   $url = '/direct-hire';
   } ?>

<div class="modal-content" id="chooseoption">
    <div class="modal-body login-pad">
        <div class="lesson_modal_content">
            <div class="pop-title">
                <h3>Booking &nbsp;&nbsp; Options</h3>
            </div>

            <button type="button" class="close modal-close" data-dismiss="modal">
                <img src="<?php echo Config::get('constants.FRONT_IMAGE'); ?>close.jpg" height="70" width="34" />
            </button>
            <div class="signup">
                <div class="row">
                    <p class="advance-para" style="padding: 0;margin: -39px 0px 0px 0px;">Choose how you would like to participate in this activity</p>
                    <div class="col-md-12">
                        <div class="col-lg-12 signup-3row signup-new-3row" style="padding: 0px 0px 30px 2px;">
                            <div class="signleft-3row">
                                <div class="img_overlay_pop">
                                    <p class="overlay_p">1-ON-1 TRAINING</p>

                                    <div class="containr">
                                        <img src="{{url('/')}}/public/images/signup-category/img1.jpg" alt="Avatar" class="image">
                                        <div class="overlay">
                                            <div class="text">Hire Personal Trainers, Coaches, Instructors, Therapists, Nutritionists, and more.</div>
                                        </div>
                                    </div>
                                    <!--<button type="button" id="hire_professional" class="btn_select">Select</button>-->
                                    <button type="button" onclick="close_lesson_model()" data-toggle="modal" data-target="#searchOption" class="btn_select  searchoption">Select</button>
                                </div>
                                <!-- <div class="new-signup-left-3row img1" style="">
                           <div class="for_btn">
                           <h2>HIRE A PROFESSIONAL</h2>
                           <h4 style="color: #fff;font-weight: 400;font-size: 17px;margin-top: -28px;margin-bottom: 23px;">Freelancers, Individuals, Trainers, Coaches, Therapist, Instructors and more</h4>
                        </div>
                           <button type="button" id="hire_professional">Select</button>
                        </div> -->

                            </div>

                            <div class="signleft-3row">
                                <div class="img_overlay_pop">
                                    <p class="overlay_p">TAKE A CLASS</p>
                                    <div class="containr">
                                        <img src="{{url('/')}}/public/images/signup-category/img2.jpg" alt="Avatar" class="image">
                                        <div class="overlay">
                                            <div class="text">Search local gyms and studios offering classes locally or online.</div>
                                        </div>
                                    </div>
                                    <button type="button" class="btn_select" onclick="window.location.href = '<?php echo $url; ?>'">Select</button>
                                </div>
                                <!-- <div class="new-signup-left-3row img2" style="">
                           <div class="for_btn">
                           <h2>SEARCH TRAINING FACILITIES</h2>
                           <h4 style="color: #fff;font-weight: 400;font-size: 17px;margin-top: -28px;margin-bottom: 23px;">Group Classes, Studios, Gyms, Recreational & Fitness Facility.</h4>
                        </div>
                           <button type="button" onclick="window.location.href = '<?php echo $url; ?>'">Select</button>
                        </div> -->
                            </div>
                            <div class="signleft-3row">
                                <div class="img_overlay_pop">
                                    <p class="overlay_p">GET ADVENTOUROUS</p>
                                    <div class="containr">
                                        <img src="{{url('/')}}/public/images/signup-category/img3.jpg" alt="Avatar" class="image">
                                        <div class="overlay">
                                            <div class="text">Stay active with activities by searching for experiences, adventures, camps, and tours.</div>
                                        </div>
                                    </div>
                                    <button type="button" class="btn_select" onclick="window.location.href = '<?php echo $url; ?>'">Select</button>
                                </div>
                                <!-- <div class="new-signup-left-3row img3" style="">
                           <div class="for_btn">
                           <h2>BOOK AN ADVENTURE OR TOUR</h2>
                           <h4 style="color: #fff;font-weight: 400;font-size: 17px;margin-top: -28px;margin-bottom: 23px;">Sky Diving, Zip Lining, Rafting and more</h4>
                        </div>
                           <button type="button" onclick="window.location.href = '<?php echo $url; ?>'">Select</button>
                        </div> -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>





<?php /*?><div class="modal-content" id="signupoption" style="display: none;">
    <div class="modal-body login-pad">
        <div class="lesson_modal_content" id="step_0">
            <div class="pop-title">
                <h3>OPTION &nbsp;&nbsp; IS &nbsp;&nbsp; YOURS</h3>
            </div>
            <button type="button" class="close modal-close clsbtn" data-dismiss="modal">
                <img src="<?php echo Config::get('constants.FRONT_IMAGE'); ?>close.jpg" height="70" width="34" />
            </button>
            <div class="signup">
                <div class="signup advance-search-popup">
                    <!-- <p class="advance-para" style="margin-bottom: 0px !important; ">CHOOSE HOW YOU WOULD LIKE TO HIRE FOR A PROFESSOINAL</p> -->
                    <p class="advance-para" style="margin-bottom: 0px !important; ">CHOOSE HOW YOU WOULD LIKE TO HIRE A PROFESSOINAL</p>
                    <div class="signleft">
                        <div class="img_overlay_pop">
                            <p class="overlay_heading">INSTANT &nbsp; MATCH</p>
                            <div class="containr">
                                <img src="{{url('/')}}/public/images/signup-category/img3.jpg" alt="Avatar" class="image">
                                <div class="overlay">
                                    <div class="text">Get matched instantly with top professionals in your area that match what you are looking for</div>
                                </div>
                            </div>
                            <button type="button" class="btn_select" onClick="showStep('sport_select')">CONTINUE</button>
                        </div>
                    </div>
                    <div class="signright">
                        <div class="img_overlay_pop">
                            <p class="overlay_heading">INSTANT &nbsp; HIRE</p>
                            <div class="containr">
                                <img src="{{url('/')}}/public/images/signup-category/img3.jpg" alt="Avatar" class="image">
                                <div class="overlay">
                                    <!-- <div class="text">Do a more in-depth search for professionals, local studios, and adventurous activities. Compare up to 3 providers side-by-side. Specify the criteria to narrow down your search. Once you’re ready, hire the best provider that matches you immediately.</div> -->
                                    <div class="text">Receive Quotes from top professional in your area.</div>
                                </div>
                            </div>
                            @if(@$selectedSportId > 0)
                            <a href="/direct-hire?selected_sport={{ $selectedSportId }}" class="instant_hire_btn">CONTINUE</a>
                            @else
                            <a href="/direct-hire" style="font-size: 16px !important;
                            color: #FFF !important;
                            background: #f53b49 !important;
                            border: 0px !important;
                            padding: 10px 15px !important;
                            display: inline-table !important;
                            font-weight: 300;
                            width: 50% !important;
                            margin: 0px 0px 38px 24px !important;">CONTINUE</a>
                            @endif
                            <br>
                            <!--  <button type="button" class="btn_select" onClick="showStep('sport_select')">CONTINUE</button> -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <form method="POST" action="/lesson/getquotes" id="qouteform">
            <!-- sports selection step starts  -->
            <div class="lesson_modal_content" id="step_sport_select" style="display:none;">
                <div class="modal-body login-pad">
                    <input type="hidden" name="hire_type" value="quick">
					<input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <div class="qh-step-bar">
                        <div class="qh-step-bar-status"> </div>
                    </div>
                    <div class="modal-body login-pad">
                        <div class="qh-step-title">
                            <span class="qh-info"><i class="fa fa-info"></i></span>
                            <h1 class="qh-title head-hd" style="color:red">Step <?php echo $current_step++." of ".$step_count;?></h1>
                            <h1 class="qh-title subtitle-hd">Let’s get started by asking you a few questions to help you find the service provider that matches what you are looking for.</h1>
                            <button type="button" class="close qh-close" data-dismiss="modal"><img src="<?php echo Config::get('constants.FRONT_IMAGE'); ?>close.jpg" height="70" width="34" /> </button>
                        </div>
                        <div class="emplouyee-form employee-frm">
                            <!-- Step_1-->
                            <div class="form-group">
                                <label>Choose Your Activity</label>
                                <div class="select-style review-select2">
                                    <select name="sport" class="selectpicker">

                                        @foreach ($sports_list as $record)
                                        <option value="{{$record->value}}"> {{$record->title}} </option>
                                        @endforeach

                                    </select>
                                </div>
                            </div>
                            <!-- Step_2-->
                            <div class="form-group">
                                <span id="quotesmsg"></span>
                                <label>How many quotes would you like to receive from professionals?<br> (Choose a minimum of 5 and maximum of 20)</label>
                                <input type="text" name="question[qoutes][answer]" id="quotes" placeholder="Number of quotes" />
                            </div>
							<!-- Step_3-->
                            <div class="form-group">
                                <div class="multiples">
                                    <label>Who is participating ?</label>
                                    <select id="activity_for" name="question[train_wants][answer][]" class="selectpicker" multiple>
                                        @foreach ($activity as $pkey => $pval)

                                        <option value='{{$pkey}}'> {{$pval}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
							<!-- Step_3-->
                            <div class="form-group">
                                <div class="multiples">
                                    <label>Language your professional should speak.</label>
                                    <!-- <div class="select-style review-select2"> -->
                                    <select id="Language" class="selectpicker" multiple>
                                        <option>English</option>
                                        <option>Spanish</option>
                                        <option>French</option>
                                        <option>Hebrew</option>
                                        <option>Russions</option>
                                        <option>Italian</option>
                                    </select>
                                    <!-- </div> -->
                                </div>
                            </div>
							<!-- Step_4-->
                            <div class="form-group">
                                <label>What’s your skill level in this activity?</label>
                                <div class="select-style review-select2">
                                    <select name="question[skill][answer]" class="selectpicker">
                                        <option>What’s your skill level in this activity</option>
                                        @foreach ($expLevel as $elkey => $elval)
                                        <option value='{{$elkey}}'> {{$elval}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <!-- Step_4-->
                            <div class="form-group">
                                <label>What activity experience are you looking for?</label>
                                <div class="select-style review-select2">
                                    <?php
                      $experience  = array(
                          "Technical"=>"Technical",
                          "Workout"=>"Workout",
                          "Bootcamp"=>"Bootcamp",
                          "Challenging and Tough "=>"Challenging and Tough ",
                          "Strength and Conditioning"=>"Strength and Conditioning",
                          "Learning a skill"=>"Learning a skill",
                          "Educational"=>"Educational",
                          "Adventurous"=>"Adventurous"
                        );
                      ?>
                                    <select name="question[experience][answer]" class="selectpicker">
                                        <option>What activity experience are you looking for?</option>
                                        @foreach($experience as $key=> $p)
                                        <?php $key = str_replace(' ','_',strtolower($key)); ?>
                                        <option value="{{$key}}">{{$p}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <!-- Step_4-->
                            <div class="form-group">
                                <label>What experience level should your professional have?</label>
                                <div class="select-style review-select2">
                                    <select name="question[experiencelevel][answer]" class="selectpicker">
                                        <option>What experience level should your professional have?</option>
                                        <option value="Level 1 (less than 6 months)">Level 1 (less than 6 months)</option>
                                        <option value="Level 2 (One year and less)">Level 2 (One year and less)</option>
                                        <option value="Level 3 (5 years and less)">Level 3 (5 years and less)</option>
                                        <option value="Level 4 (10 years and less)">Level 4 (10 years and less)</option>
                                        <option value="Level 5 (10 Years or more)">Level 5 (10 Years or more)</option>
                                    </select>
                                </div>
                            </div>
							<!-- Step_4-->
                            <div class="form-group">
                                <label>Do you have gear for this activity?</label><br>

                                <label class="radio-inline" style="margin-top: 2%;padding-left: 12px;">
                                    <input type="radio" onclick="javascript:yesnoCheck4();" name="question[gear][answer]" value="false" id="noCheck4" checked="checked"><span style="margin-left: 80%;">No</span>
                                </label>
                                <label class="radio-inline" style="margin-top: 2%;margin-left: 40px;">
                                    <input type="radio" onclick="javascript:yesnoCheck4();" name="question[gear][answer]" value="true" id="yesCheck4"><span style="margin-left: 80%;">Yes</span>
                                </label>
                                <div id="ifYes4" style="display: none;">
                                    <input type='text' id='yes' placeholder="Please list the gear you have to participate in the activity." name="question[gear][otheranswer]">
                                </div>
                            </div>
							<!-- Step_5-->
                            <div class="form-group">
                                <label>How often are you active?</label>
                                <div class="select-style review-select2">
                                    <select name="frm_servicesport" class="selectpicker">
                                        <option>How often are you active</option>
                                        <option value="I’m not active at all">I’m not active at all</option>
                                        <option value="It’s been a while">It’s been a while</option>
                                        <option value="A Few Times in a Week">A Few Times in a Week</option>
                                        <option value="More than a few times a week">More than a few times a week</option>
                                        <option value="Almost Daily">Almost Daily</option>
                                        <option value="Other">Other</option>
                                    </select>
                                </div>
                            </div>
							<!-- Step_6-->
						</div>
                        <div class="clearfix"></div>
                        <div class="qh-next">
                            <a class="qh-continue" id="qcheck">continue</a>
                        </div>
                    </div>
                </div>
            </div>
			<div class="lesson_modal_content" id="step_1" style="display:none;">
                <div class="qh-step-bar">
                    <div class="qh-step-bar-status"> </div>
                </div>
                <div class="modal-body login-pad">
                    <div class="qh-step-title">
                        <span class="qh-info"><i class="fa fa-info"></i></span>
                        <h1 class="qh-title" style="color:red"><b>Step <?php echo $current_step++." of ".$step_count;?></b></h1>
                        <button type="button" class="close qh-close" data-dismiss="modal"><img src="<?php echo Config::get('constants.FRONT_IMAGE'); ?>close.jpg" height="70" width="34" /> </button>
                    </div>
					<div class="emplouyee-form employee-frm">
                        <!-- STEP7-->
                        <div class="form-group">
                            <div class="multiples">
                                <label>Where would you like to do this activity?</label>
                                <!-- <div class="select-style review-select2"> -->
                                <select id="do_activity" class="selectpicker" multiple>
                                    <option>Online</option>
                                    <option>Local Gym</option>
                                    <option>Studio</option>
                                    <option>Training Facility</option>
                                    <option>My Home/ Apartment</option>
                                    <option>My Office</option>
                                    <option>Outside</option>
                                    <option>Recommended by Provider</option>
                                    <option>Any</option>
                                    <!-- name="question[train_location][answer][]"  -->
                                    <!-- <option>Where would you like to do this activity?</option>
                            @foreach ($serviceLocation as $slkey => $slval)
                        <?php $slkey = str_replace(' ','_',strtolower($slkey));?>
                        <option value='{{$slkey}}'>{{$slval}}</option>
                        @endforeach -->
                                </select>
                                <!-- </div> -->
                            </div>
                        </div>
						<!-- STEP8-->
                        <div class="form-group">
                            <div class="multiples">
                                <label>Which personality & habits should your professional have? </label>
                                <!-- <div class="select-style review-select2"> -->
                                <select id="which_personality" class="selectpicker" multiple>
                                    <option>An educator & teacher</option>
                                    <option>A lot of energy</option>
                                    <option>A drill sergeant</option>
                                    <option>Inspiring</option>
                                    <option>Motivational</option>
                                    <option>Supportive, Soft and Nurturing</option>
                                    <!-- name="question[best_work][answer][]" -->
                                    <!-- <option>Which personality & habits should your professional have?</option>
                          @foreach ($teaching as $elkey => $elval)
                        <option value='{{$elkey}}'> {{$elval}}</option>
                        @endforeach -->
                                </select>
                                <!-- </div> -->
                            </div>
                        </div>
                        <!-- STEP9-->
                        <div class="form-group">
                            <label>Any Gender Preference?</label>
                            <div class="select-style review-select2">
                                <select name="question[gender][answer]" class="selectpicker">
                                    <option>Any Gender Preference</option>
                                    <option value="Male">Male</option>
                                    <option value="Female">Female</option>
                                    <option value="No">No Preference</option>
                                </select>
                            </div>
                        </div>
                        <!-- STEP10-->
                        <div class="form-group">
                            <label>What is the Age Range?</label>
                            <div class="select-style review-select2">
                                <select name="question[age][answer]" class="selectpicker">
                                    <option>What is the Age Range?</option>
                                    @foreach ($ageRange as $arkey => $arval)
                                    <?php $arkey = str_replace(' ','_',strtolower($arkey));?>
                                    <option value='{{$arval}}'> {{$arval}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <!-- STEP11-->
                        <div class="form-group">
                            <label>How often will you participate in this activity?</label>
                            <div class="select-style review-select2">
                                <select name="question[train_interest][answer]" class="selectpicker">
                                    <option> How often will you participate in this activity?</option>
                                    <option value="One time">One time</option>
                                    <option value="1x a week">1x a week</option>
                                    <option value="2x a week">2x a week</option>
                                    <option value="3x a week">3x a week</option>
                                    <option value="4x a week">4x a week</option>
                                    <option value="5x a week">5x a week</option>
                                    <option value="6x a week">6x a week</option>
                                    <option value="Monthly">Monthly</option>
                                    <option value="Yearly">Yearly</option>
                                    <option value="Other">Other</option>
                                </select>
                            </div>
                        </div>
                        <!-- STEP12-->
                        <div class="form-group">
                            <div class="multiples">
                                <label>What days are you free?</label>
                                <select id="days" name="question[days_available][answer][]" class="selectpicker" multiple>
                                    <option value="Sunday">Sunday</option>
                                    <option value="Monday">Monday</option>
                                    <option value="Tuesday">Tuesday</option>
                                    <option value="Wednesday">Wednesday</option>
                                    <option value="Thursday">Thursday</option>
                                    <option value="Friday">Friday</option>
                                    <option value="Saturday">Saturday</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <!-- <div class="clearfix"></div> -->
                    <div class="qh-next" style="margin-top: -40px;">
                        <!-- <button type="button" class="close qh-back" onClick="gobackStep('sport_select')" ><img src="<?php echo Config::get('constants.FRONT_IMAGE'); ?>back.jpg" height="70" width="34"/> </button> -->
                        <a class="qh-continue" onClick="gobackStep('sport_select')">Previous</a>
                        <a class="qh-continue" onclick="$('#step_1').hide();$('#step_2').show();">continue</a>
                    </div>
                </div>
            </div>
			<div class="lesson_modal_content" id="step_2" style="display:none;">
                <div class="qh-step-bar">
                    <div class="qh-step-bar-status"> </div>
                </div>
                <div class="modal-body login-pad">
                    <div class="qh-step-title">
                        <span class="qh-info"><i class="fa fa-info"></i></span>
                        <h1 class="qh-title" style="color:red"><b>Step <?php echo $current_step++." of ".$step_count;?></b></h1>
                        <button type="button" class="close qh-close" data-dismiss="modal"><img src="<?php echo Config::get('constants.FRONT_IMAGE'); ?>close.jpg" height="70" width="34" /> </button>
                    </div>
                    <div class="emplouyee-form employee-frm">
                        <!-- Step_13 -->
                        <div class="form-group">
                            <div class="multiples">
                                <label>What time period works best for you?</label>
                                <select id="time_period" name="question[time_available][answer][]" class="selectpicker" multiple>
                                    <option value="Early Morning(Before 9am)">Early Morning(Before 9am)</option>
                                    <option value="Morning(9am-Noon)">Morning(9am-Noon)</option>
                                    <option value="Early Afternoon(Noon-3pm)">Early Afternoon(Noon-3pm)</option>
                                    <option value="Late Afternoon(3pm-6pm)">Late Afternoon(3pm-6pm)</option>
                                    <option value="Evening(After 6pm)">Evening(After 6pm)</option>
                                    <option value="Other">Other</option>
                                </select>
                            </div>
                        </div>
						<!-- Step_14 -->
                        <div class="form-group">
                            <label>Any medical issues?</label>
                            <br>
                            <label class="radio-inline" style="padding-left: 12px;">
                                <input type="radio" onclick="javascript:yesnoCheck();" name="question[medical][answer]" value="false" id="noCheck" checked="checked"><span style="margin-left: 80%;">No</span>
                            </label>
                            <label class="radio-inline" style="margin-left: 40px;">
                                <input type="radio" onclick="javascript:yesnoCheck();" name="question[medical][answer]" value="true" id="yesCheck"><span style="margin-left: 80%;">Yes</span>
                            </label>
                            <div id="ifYes" style="display: none;">
                                <input type='text' id='yes' placeholder="Please list your medical issues so the professional can plan accordingly." name='question[medical][otheranswer]'>
                            </div>
                        </div>
						<!-- Step_15 -->
                        <div class="form-group">
                            <label>Are you willing to travel to the professionals specified training location? (park, gym, etc.)</label>
                            <div class="select-style review-select2">
                                <select name="question[personal_train_occur][answer]" class="selectpicker">
                                    <option></option>
                                    <option "notravel">-I Prefer not to travel</option>
                                    <option "yes travel">- I am willing to travel</option>
                                </select>
                            </div>
                        </div>
                        <!-- Step_15 -->
                        <div class="form-group">
                            <label>How soon do you want to start?</label>
                            <div class="select-style review-select2">
                                <select name="question[personal_training][answer]" class="selectpicker">
                                    <option value="ASAP">Soon as possible</option>
                                    <option value="Tomorrow">Tomorrow</option>
                                    <option value="ThisWeek">This week </option>
                                    <option value="ThisMonths">This month</option>
                                    <option value="UpcomingTrip">Upcoming Trip</option>
                                    <option value="Other">Other</option>
                                </select>
                            </div>
                        </div>
                        <!-- Step_15 -->
                        <div class="form-group">
                            <label>I am willing to travel up to</label>
                            <div class="select-style review-select2">
                                <select name="question[travel_upto][answer]" class="selectpicker">
                                    <option value="1">1 Mile</option>
                                    <option value="3">3 Miles</option>
                                    <option value="5">5 Miles</option>
                                    <option value="10">10 Miles</option>
                                    <option value="15">15 Miles</option>
                                    <option value="20">20 Miles</option>
                                    <option value="30">30 Miles</option>
                                </select>
                            </div>
                        </div>
						<div class="form-group">
                            <label>What activity experience are you looking for?</label>
                            <div class="select-style review-select2">
                                <select name="frm_servicesport" class="selectpicker">
                                    <option></option>
                                    <option>Educational</option>
                                    <option>Adventurous</option>
                                    <option>Bootcamp</option>
                                    <option>Challenging & Touch</option>
                                    <option>Strength & Conditioning</option>
                                    <option>Technical</option>
                                    <option>Workout</option>
                                    <option>Other</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">

                            <label id="zipmsg">Enter the desired zip code. We locate the top service providers closest to you.</label>
                            <input type="text" name="zipcode" id="zipcode" placeholder="10982" />
                        </div>
                    </div>
                    <div class="clearfix"></div>
                    <div class="qh-next">
                        <input type="hidden" name="notificationby" class="chkqt" value="email">
                        <!--  <button type="button" class="close qh-back"  onClick="gobackStep('1')"><img src="<?php echo Config::get('constants.FRONT_IMAGE'); ?>back.jpg" height="70" width="34"/> </button> -->
                        <a class="qh-continue" onClick="gobackStep('1')">Previous</a>
                        <a class="qh-continue" id="submitform">Send</a>
                    </div>
                </div>
            </div>
		</div>
    <input type="hidden" name="_token" id="token" value="{{csrf_token()}}">
    </form>
    <!-- step 9 ends -->
</div><?php */?>
<style type="text/css">
    .errcheck {
        color: red;
        font-size: 16px;
    }

</style>
</div>
<script>
	function close_lesson_model()
	{
		console.log('model close');
		$('#lesson_modal').modal('toggle');
	}
    $('#chkzip').keyup(function() {
        $(".chkerror").text("");

        if (!$.isNumeric(this.value)) {
            $(".chkerror").text("*Invalid Zipcode Number");
            $("#sub").attr("disabled", true);
            return false;
        } else if ($.isNumeric(this.value) && this.value > 999999 || this.value <= 000000 || this.value <= 999) {
            $(".chkerror").text("*Please provide valid zipe code between 6 digit");
            $("#sub").attr("disabled", true);
            return false;
        } else {
            $("#sub").attr("disabled", false);
        }
    });

</script>
<script>
    $(document).on("ajaxComplete", function() {
        //   setTimeout(function(){
        //       console.log(localStorage.getItem('myData'))
        //   },100)
		
        var s = localStorage.getItem('myData')
        console.log(s)
        if (s == 'Professional') {
            $('#signupoption').css('display', 'block');
           /* $('#chooseoption').css('display', 'none');*/ //-----nnnn
            $('#child_sports_modal').css('display', 'none');
        }
        $('#hire_professional').on('click', function() {
            $('#signupoption').css('display', 'block');
            /*$('#chooseoption').css('display', 'none');*/ //-----nnnn
        });

        $('.modal').on('hidden.bs.modal', function() {
            $('#signupoption').css('display', 'none');
        })

        var selectedSportId = $("#selectedSportId").val();
        if (selectedSportId != '' && selectedSportId > 0) {
            $('#chk_' + selectedSportId).click();
        }
        $("label.btn").click(function() {
            // find clicked button radio option name
            var radio_option = $(this).find('input[type=radio]');
            if ($(radio_option).is(':radio')) {
                var radio_option_name = $(radio_option).attr('name');
                // make all other options to null
                $('input[type=radio][name="' + radio_option_name + '"]').each(function() {
                    $(this).closest('label.btn').removeClass('active');
                });
                // make current selection active
                $(this).addClass('active');
            }
        });

        // if(pre_selected_sports){
        //     $(".chk").unbind("click");
        //     $(".chk").parent().find('.active').removeClass('active');
        //     $(".otherchk").unbind("click");
        //     $('input:radio[name=sport][value=<?php echo @$selectedSportId; ?>]').click();  
        // } 

    });

</script>
<script type="text/javascript">
    function gobackStep(divname) {
        $('.lesson_modal_content').hide();
        $('#step_' + divname).show();
    }

    function showothertext() {
        if ($('#selectPerTra :selected').val() == 'Other') {
            $('#otherpertra').show();
        } else {
            $('#otherpertra').hide();

        }
    }

    function showStep(divname) {

        if (divname !== 'sport_select') {

            var chk = $("input:radio[class='chk']");
            var chkother = $("input:radio[id='otherchk']");

            var chkwhome = $("input:checkbox[class='chkwhome']");

            var chkskill = $("input:radio[class='chkskill']");
            var chkskillother = $("input:radio[id='chkskillother']");

            var chkgearf = $("input:radio[id='chkgearf']");
            var chkgeart = $("input:radio[id='chkgeart']");

            var chkwork = $("input:radio[class='chkwork']");

            var chkgoal = $("input:checkbox[class='chkgoal']");
            var chkgoalother = $("input:checkbox[id='chkgoalother']");

            var chktrain = $("input:checkbox[class='chktrain']");
            var chktrainother = $("input:checkbox[id='chkothertrn']");

            var chkbest = $("input:checkbox[class='chkbest']");
            var chkotherbest = $("input:checkbox[id='chkotherbest']");

            var chkgender = $("input:radio[class='chkgender']");


            var chkold = $("input:radio[class='chkold']");
            var chkoldother = $("input:radio[id='chkoldother']");


            var chkintr = $("input:radio[class='chkintr']");
            var chkintrother = $("input:radio[id='chkintrother']");

            var chkday = $("input:checkbox[class='chkdy']");

            var chktm = $("input:checkbox[class='chktm']");
            var chktmother = $("input:checkbox[id='chktmother']");

            var chkmedicalf = $("input:radio[id='chkmedicalf']");
            var chkmedicaly = $("input:radio[id='chkmedicaly']");


            var chknwy = $("input:radio[id='chknwy']");
            var chknwn = $("input:radio[id='chknwn']");

            var chkqt = $("input:radio[class='chkqt']");

            var chkoccr = $("input:radio[class='chkoccr']");

            var chkwill = $('#chwill');
            var chkwilly = $("input:radio[id='chkwilly']");




            $(".chkerror").text("");

            /*========    Sports Modal Validation start ========*/
            if (chk.is(":checked") && divname == 1) {
                if (chkother.is(":checked")) {
                    if ($('#sportval').val() == '') {
                        $(".chkerror").text("*Please fill other option");
                        return false;
                    }
                }

            } else if (!chk.is(":checked") && divname == 1) {
                $(".chkerror").text("*Please select atleast one option");
                return false;
            }
            /*========    Sports Modal Validation END ========*/

            /*========    Sports Modal Validation start ========*/
            if (divname == 2) {

                if (!$.isNumeric($('#qoutes').val())) {
                    $(".chkerror").text("*Please fill digits between Minimum 5 or Maximum 20");
                    return false;
                }

                if ($('#qoutes').val() == '') {
                    $(".chkerror").text("*Please fill the option");
                    return false;
                } else if ($('#qoutes').val() < 5 || $('#qoutes').val() > 20) {
                    $(".chkerror").text("*Minimum 5 and Maximum 20");
                    return false;
                }
            }
            /*========    Sports Modal Validation END ========*/


            /*========    To Whome Modal Validation start ========*/
            if (!chkwhome.is(":checked") && divname == 3) {
                $(".chkerror").text("*Please select atleast one option");
                return false;
            }


            /*========    To Whome Modal Validation END ========*/


            /*========    Skill Modal Validation start ========*/
            if (chkskill.is(":checked") && divname == 4) {
                if (chkskillother.is(":checked")) {
                    if ($('#otherskill').val() == '') {
                        $(".chkerror").text("*Please fill other option");
                        return false;
                    }
                }

            } else if (!chkskill.is(":checked") && divname == 4) {
                $(".chkerror").text("*Please select atleast one option");
                return false;
            }

            if (!chkgearf.is(":checked") && !chkgeart.is(":checked") && divname == 4) {
                $(".chkerror").text("*Please select atleast one option");
                return false;
            } else if (chkgeart.is(":checked")) {
                if ($('#othergear').val() == '') {
                    $(".chkerror").text("*Please select fill the option");
                    return false;
                }
            }
            /*========    Skill  Modal Validation END ========*/


            /*========    Work out  Modal Validation start ========*/
            if (!chkwork.is(":checked") && divname == 5) {
                $(".chkerror").text("*Please select atleast one option");
                return false;
            }
            /*========    work out Modal Validation END ========*/

            /*========    Goal Modal Validation start ========*/
            if (chkgoal.is(":checked") && divname == 6) {
                if (chkgoalother.is(":checked")) {
                    if ($('#othergl').val() == '') {
                        $(".chkerror").text("*Please fill other option");
                        return false;
                    }
                }

            } else if (!chkgoal.is(":checked") && divname == 6) {
                $(".chkerror").text("*Please select atleast one option");
                return false;
            }
            /*========    Goal Modal Validation END ========*/


            /*========    where train Modal Validation start ========*/
            if (chktrain.is(":checked") && divname == 7) {
                if (chktrainother.is(":checked")) {
                    if ($('#othertrn').val() == '') {
                        $(".chkerror").text("*Please fill other option");
                        return false;
                    }
                }

            } else if (!chktrain.is(":checked") && divname == 7) {
                $(".chkerror").text("*Please select atleast one option");
                return false;
            }
            /*========    where train Modal Validation END ========*/



            /*========    best Modal Validation start ========*/
            if (chkbest.is(":checked") && divname == 8) {
                if (chkotherbest.is(":checked")) {
                    if ($('#otherbest').val() == '') {
                        $(".chkerror").text("*Please fill other option");
                        return false;
                    }
                }

            } else if (!chkbest.is(":checked") && divname == 8) {
                $(".chkerror").text("*Please select atleast one option");
                return false;
            }
            /*========    best Modal Validation END ========*/

            /*========    gender  Modal Validation start ========*/
            if (!chkgender.is(":checked") && divname == 9) {
                $(".chkerror").text("*Please select atleast one option");
                return false;
            }
            /*========    wgender Modal Validation END ========*/

            /*========    old Modal Validation start ========*/
            if (chkold.is(":checked") && divname == 10) {
                if (chkoldother.is(":checked")) {
                    if ($('#otherold').val() == '') {
                        $(".chkerror").text("*Please fill other option");
                        return false;
                    }
                }

            } else if (!chkold.is(":checked") && divname == 10) {
                $(".chkerror").text("*Please select atleast one option");
                return false;
            }
            /*========    old Modal Validation END ========*/


            /*========    old Modal Validation start ========*/
            if (chkintr.is(":checked") && divname == 11) {
                if (chkintrother.is(":checked")) {
                    if ($('#otherintr').val() == '') {
                        $(".chkerror").text("*Please fill other option");
                        return false;
                    }
                }

            } else if (!chkintr.is(":checked") && divname == 11) {
                $(".chkerror").text("*Please select atleast one option");
                return false;
            }
            /*========    old Modal Validation END ========*/

            /*========    gender  Modal Validation start ========*/
            if (!chkday.is(":checked") && divname == 12) {
                $(".chkerror").text("*Please select atleast one option");
                return false;
            }
            /*========    wgender Modal Validation END ========*/


            /*========    Time Modal Validation start ========*/
            if (chktm.is(":checked") && divname == 13) {
                if (chktmother.is(":checked")) {
                    if ($('#othertm').val() == '') {
                        $(".chkerror").text("*Please fill other option");
                        return false;
                    }
                }

            } else if (!chktm.is(":checked") && divname == 13) {
                $(".chkerror").text("*Please select atleast one option");
                return false;
            }
            /*========    Time Modal Validation END ========*/

            /*========    medical Modal Validation END ========*/

            if (!chkmedicalf.is(":checked") && !chkmedicaly.is(":checked") && divname == 14) {

                $(".chkerror").text("*Please select atleast one option");
                return false;
            } else if (chkmedicaly.is(":checked")) {

                if ($('#othermedical').val() == '') {
                    $(".chkerror").text("*Please select fill the option");
                    return false;
                }
            }

            /*========    medical Modal Validation END ========*/
            if (chktm.is(":checked") && divname == 13) {
                if (chktmother.is(":checked")) {
                    if ($('#othertm').val() == '') {
                        $(".chkerror").text("*Please fill other option");
                        return false;
                    }
                }

            } else if (!chktm.is(":checked") && divname == 13) {
                $(".chkerror").text("*Please select atleast one option");
                return false;
            }

            /*========    Personal Training Modal Validation END ========*/

            if (!chkoccr.is(":checked") && divname == 15) {

                $(".chkerror").text("*Please select atleast one option");
                return false;
            } else if (chkwill.is(":checked")) {

                if ($('#selectMiles :selected').val() == '') {
                    $(".chkerror").text("*Please select the option");
                    return false;

                }
            }

            /*========    Personal Training Modal Validation END ========*/


            /*========    trainer know Modal Validation END ========*/

            if (!chknwn.is(":checked") && !chknwy.is(":checked") && divname == 16) {

                $(".chkerror").text("*Please select atleast one option");
                return false;
            } else if (chknwy.is(":checked")) {

                if ($('#otherkn').val() == '') {
                    $(".chkerror").text("*Please select fill the option");
                    return false;
                }
            }


            /*========    trainer know Modal Validation END ========*/

        }
        if (divname == 'sport_select') {
            var x = new SlimSelect({
                select: '#time_period'
            });
            var p = new SlimSelect({
                select: '#days'
            });
            var pp2 = new SlimSelect({
                select: '#activity_for'
            });
            var pp3 = new SlimSelect({
                select: '#Language'
            });
            var pp4 = new SlimSelect({
                select: '#do_activity'
            });
            var pp4 = new SlimSelect({
                select: '#which_personality'
            });
        }
        $('.lesson_modal_content').hide();
        $('#step_' + divname).show();

    }

</script>
<script>
    function yesnoCheck4() {
        if (document.getElementById('yesCheck4').checked) {
            document.getElementById('ifYes4').style.display = 'block';
        } else document.getElementById('ifYes4').style.display = 'none';

    }

    function yesnoCheck() {
        if (document.getElementById('yesCheck').checked) {
            document.getElementById('ifYes').style.display = 'block';
        } else document.getElementById('ifYes').style.display = 'none';

    }
    $(document).ready(function() {
        $("#submitform").click(function() {
            $('#zipmsg').hide();
            if ($('#zipcode').val() == "") {
                $('#zipmsg').css('color', "red").show();
                return false;
            }
            $('#qouteform').submit();
        });

        // $("#quotes").input(function(){
        //   $('#quotesmsg').hide();
        // var v = $('#quotes').val();
        // if( v>=5 && v<=20){
        //   $('#quotesmsg').text().css('color',"red").show();

        // }  else{
        //   $('#quotesmsg').text('Choose a minimum of 5 and maximum of 20').css('color',"red").show();
        //   $('#quotes').val('').focus();
        // }
        // });

        $("#quotes").change(function() {
            $('#quotesmsg').hide();
            var v = $('#quotes').val();
            if (v >= 5 && v <= 20) {
                $('#quotesmsg').text().css('color', "red").show();

            } else {
                $('#quotesmsg').text('Choose a minimum of 5 and maximum of 20').css('color', "red").show();
                $('#quotes').val('').focus();
            }
        });
        $("#qcheck").click(function() {
            console.log('sdfsfs')
            $('#quotesmsg').hide();
            var v = $('#quotes').val();
            if (v == '') {
                $('#quotesmsg').text('Please Fill this field').css('color', "red").show();
                $('#quotes').val('').focus();
                return 0;
            }
            if (v >= 5 && v <= 20) {
                $('#step_sport_select').hide();
                $('#step_1').show();

            } else {
                $('#quotesmsg').text('Choose a minimum of 5 and maximum of 20').css('color', "red").show();
                $('#quotes').val('').focus();
            }
        });

    });

</script>

<style>
    .emplouyee-form {
        margin: 0 auto 50px;
        width: 50%;
        text-align: center;
    }

    .form-group {
        text-align: left;
        margin-bottom: 12% !important;
    }

</style>

<script>
    $(document).ready(function() {
        $(document).on('load', '#time_period', function() {
            console.log('g2')
        })
        console.log("ggggg")
        var x = new SlimSelect({
            select: '#time_period'
        });
        var p = new SlimSelect({
            select: '#days'
        });
        var pp2 = new SlimSelect({
            select: '#activity_for'
        });
        var pp3 = new SlimSelect({
            select: '#Language'
        });
        var pp4 = new SlimSelect({
            select: '#do_activity'
        });
        var pp4 = new SlimSelect({
            select: '#which_personality'
        });
    })

</script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/slim-select/1.18.10/slimselect.min.js"></script>

<link href="https://cdnjs.cloudflare.com/ajax/libs/slim-select/1.18.10/slimselect.min.css" rel="stylesheet">


<link rel="stylesheet" href="/public/js/select/select.css" />
