<script type="text/javascript" src="/AdminLTE/plugins/bootstrap-slider/bootstrap-slider.js"></script>
<link rel="stylesheet" type="text/css" href="/AdminLTE/plugins/bootstrap-slider/slider.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/slim-select/1.18.10/slimselect.min.js"></script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/slim-select/1.18.10/slimselect.min.css" rel="stylesheet">
<link rel="stylesheet" href="/js/select/select.css" />
<style>
	.choose-sport {
		padding-top: 0px;
	}
</style>
<?php
    $levelOfExp = [];
    $whoIsTraining = '';
    $gender = '';
    $personality = '';
    $availability_days = [];
    $selected_location = '';
    $selected_location_lat = '';
    $selected_location_lng = '';
    $filter_review_star = '';
    $miles_radius_filter = 0;
?>
{!! Form::open(array('id' => 'frmsearchCategory', 'url' => 'instant-hire', 'method' => 'post')) !!}

<div class="direct-hire-sidebar">
    <a href="javascript:void(0)" class="filter-btn myfilter2" style="width: 100%; text-align: center;margin-top: -11px;" onclick="submitForm();">
        SEARCH
    </a>
    <div class="reset-filter" style="text-align: center;">
        <a href="javascript:void();" onclick="refreshPage();">
            RESET ALL FILTERS
            <i class="fa fa-filter" aria-hidden="true"></i>
        </a>
    </div>
    <!-- <div class="reset-filter"> 
    <a href="javascript:void(0);" class="filter-btn myfilter2" style="width: 100%; text-align: center;">
        CLICK TO APPLY FILTERS
    </a>
    <!-- </div> -->
    <br>
    <div class="choose-sport">
        <div class="special-offer">
            <div class="multiples">
                <h2>Business Type</h2>
                <select id="providerservices" name="service_type[]" class="myfilter" multiple="multiple">
                    <option value="individual">Personal Trainer</option>
					<option value="classes">Gym/Studio</option>
                    <option value="experience">Experience</option>
                </select>
            </div>
        </div>
        <div class="special-offer">
            <div class="multiples">
                <h2>Membership Type</h2>
                <select id="activity_Member" name="activity_Member[]" multiple class="myfilter">
                    <option>Drop In</option>
                    <option>Semester</option>
                </select>
            </div>
        </div>
        <div class="special-offer">
            <div class="multiples">
                <h2>Service Type</h2>
                <select id="servicetypetwo" name="service_type_two[]" class="myfilter" multiple="multiple">
                    <option>Personal Training</option>
					<option>Coaching</option>
                    <option>Therapy</option>
                    <option>Group Class</option>
                    <option>Seminar</option>
                    <option>Workshop</option>
                    <option>Clinic</option>
                    <option>Camp</option>
                    <option>Team</option>
                    <option>Corporate</option>
                    <option>Tour</option>
                    <option>Adventure</option>
                    <option>Retreat</option>
                    <option>Workshop</option>
                    <option>Seminar</option>
                    <option>Private experience</option>
                </select>
            </div>
        </div>
		<div class="special-offer">
            <div class="multiples">
                <h2>Search by Activity</h2>
                <select id="programservices" name="program_type[]" class="myfilter">
                	<option></option>
					<option>Aerobics</option>
					<option>Archery</option>
					<option>Badminton</option>
					<option>Barre</option>
					<option>Baseball</option>
					<option>Basketball</option>
					<option>Beach Vollyball</option>
					<option>Bouldering</option>
					<option>Bungee Jumping</option>
					<optgroup label="Camps & Clinics">
						<option>Day Camp</option>
						<option>Sleep Away</option>
						<option>Winter Camp</option>
					</optgroup>
					<option>Canoeing</option>
					<optgroup label="Cycling">
						<option>Indoor cycling</option>
					</optgroup>
					<option>Dance</option>
					<option>Diving</option>
					<optgroup label="Field Hockey">
						<option>Ice Hockey</option>
					</optgroup>
					<option>Football</option>
					<option>Golf</option>
					<option>Gymnastics</option>
					<option>Hang Gliding</option>
					<option>Hiit</option>
					<option>Hiking - Backpacking</option>
					<option>Horseback Riding</option>
					<option>Ice Skating</option>
					<option>Kayaking</option>
					<option>lacrosse</option>
					<option>Laser Tag</option>
					<optgroup label="Martial Arts">
						<option>Boxing</option>
						<option>Jiu-Jitsu</option>
						<option>Karate</option>
						<option>Kick Boxing</option>
						<option>Kung Fu</option>
						<option>MMA</option>
						<option>Self-Defense</option>
						<option>Tai Chi</option>
						<option>Wrestling</option>
					</optgroup>
					<option>Massage Therapy</option>
					<option>Nutrition</option>
					<option>Paint Ball</option>
					<option>Physical Therapy</option>
					<option>Pilates</option>
					<option>Rafting</option>
					<option>Rapelling</option>
					<option>Rock Climbing</option>
					<option>Rowing</option>
					<option>Running</option>
					<optgroup label="Sightseeing Tours">
						<option>Airplane Tour</option>
						<option>ATV Tours</option>
						<option>Boat Tours</option>
						<option>Bus Tour</option>
						<option>Caving Tours</option>
						<option>Helicopter Tour</option>
					</optgroup>
					<option>Sailing</option>
					<option>Scuba Diving</option>
					<option>Sky diving</option>
					<option>Snow Skiing</option>
					<option>Snowboarding</option>
					<option>Strength &amp; Conditioning</option>
					<option>Surfing</option>
					<option>Swimming</option>
					<option>Tennis</option>
					<option>Tours</option>
					<option>Vollyball</option>
					<option>Weight training</option>
					<option>Windsurfing</option>
					<option>Yoga</option>
					<option>Zip-Line</option>
					<option>Zumba</option>
                </select>
            </div>
        </div>
        <?php /*?><div class="special-offer">
            <h2>SEARCH BY ACTIVITY</h2>
            <?php		
                if(Session::has('professional_type')){	
                        $professional_type = Session::get('professional_type');
                    } else {
                        $professional_type = '1';
                    }
            ?> <select name="professional_type[]" id="professional_type" class="myfilter">
            <?php foreach ($businessType as $bkey => $bval) { ?>
                <option value="{{$bkey}}">{{$bval['type']}}</option>
                <?php } ?>
            </select>
        </div><?php */?>
        <div class="special-offer">
            <div class="multiples">
                <h2>Location Of Activity</h2>
                <select id="activity_location" name="activity_location[]" multiple class="myfilter">
                    @foreach (@$serviceLocation as $slkey => $slval)
                    <?php $slkey = str_replace(' ','_',strtolower($slkey)) ;?>
                    <option value='{{$slkey}}'>{{$slval}}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="special-offer">
            <h2>Search By Location</h2>
            <div class="view">
                <input id="pac-input" type="text" class="location-control myfilter" name="location" placeholder="search by state, city, zip" value="@if(isset($selected_location) && $selected_location != NULL){{$selected_location }}@endif" />
                <script>
                    /*google.maps.event.addDomListener(window, 'load', initialize);
                    function initialize() {
                        var options = {
                            types: ['(cities)'],
                            componentRestrictions: {
                                country: "US"
                            }
                        };
                        var input = document.getElementById('pac-input');
                        var autocomplete = new google.maps.places.Autocomplete(input, options);
                        autocomplete.addListener('place_changed', function() {
                            var place = autocomplete.getPlace();
                            if (place.formatted_address == undefined) {
                                $("#selected_location").val('');
                                $("#selected_location_lat").val('');
                                $("#selected_location_lng").val('');
                                $("#miles_radius_filter").slider("disable");
                            } else {
                                $("#selected_location").val(place.formatted_address);
                                $("#selected_location_lat").val(place.geometry['location'].lat());
                                $("#selected_location_lng").val(place.geometry['location'].lng());
                                $("#miles_radius_filter").slider("enable");
                                $(".miles_radius_filter_error").html('');
                            }
                        });
                    }
                    $('#pac-input').keyup(function() {
                        if ($('#pac-input').val() == '') {
                            $("#selected_location").val('');
                            $("#selected_location_lat").val('');
                            $("#selected_location_lng").val('');
                            $("#miles_radius_filter").slider("disable");
                            $(".miles_radius_filter_error").html('');
                        }
                    });*/
                </script>
            </div>
        </div>
        <div class="special-offer">
            <div class="multiples">
                <h2>Great For</h2>
                <select id="activity_type" multiple name="activity_type[]" class="myfilter">
                    <option>Individual</option>
                    <option>Kids</option>
                    <option>Teens</option>
                    <option>Adults</option>
                    <option>Family</option>
                    <option>Groups</option>
                    <option>Paralympic</option>
                    <option>Prenatal</option>
                    <option>Any</option>
                </select>
            </div>
        </div>
        <div class="special-offer">
            <div class="multiples">
                <h2>Age Range</h2>
                <select id="age_range" multiple name="age_range[]" class="myfilter">
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
            </div>
        </div>
        <div class="special-offer">
            <div class="multiples">
                <h2>Group Size</h2>
                <select name="frm_cnumberofpeople[]" id="frm_cnumberofpeople" tabindex="-1">
                	<option hidden=""></option>
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
            </div>
        </div>
        <div class="special-offer">
            <div class="multiples">
                <h2>Duration</h2>
                <select id="duration" multiple name="duration[]" class="myfilter">
                    <option hidden="">Select Value</option>
                    <option>30 Minutes</option>
                    <option>45 Minutes</option>
                    <option>1 Hour</option>
                    <option>1 Hour 15 Minutes</option>
                    <option>1 Hour 30 Minutes</option>
                    <option>1 Hour 45 Minutes</option>
                    <option>2 Hours</option>
                    <option>2 Hours 15 Minutes</option>
                    <option>2 Hours 30 Minutes</option>
                    <option>2 Hours 45 Minutes</option>
                    <option>3 Hours</option>
                    <option>3 Hours 15 Minutes</option>
                    <option>3 Hours 30 Minutes</option>
                    <option>3 Hours 45 Minutes</option>
                    <option>4 Hours</option>
                    <option>4 Hours 15 Minutes</option>
                    <option>4 Hours 30 Minutes</option>
                    <option>4 Hours 45 Minutes</option>
                    <option>5 Hours</option>
                    <option>5 Hours 15 Minutes</option>
                    <option>5 Hours 30 Minutes</option>
                    <option>5 Hours 45 Minutes</option>
                    <option>1 Day</option>
                    <option>2 Days</option>
                    <option>3 Days</option>
                    <option>4 Days</option>
                    <option>5 Days</option>
                    <option>6 Days</option>
                    <option>7 Days</option>
                    <option>8 Days</option>
                    <option>9 Days</option>
                    <option>10 Days</option>
                    <option>1 Week</option>
                    <option>2 Week</option>
                    <option>3 Week</option>
                    <option>4 Week</option>
                    <option>5 Week</option>
                    <option>6 Week</option>
                    <option>1 Month</option>
                    <option>2 Month</option>
                    <option>3 Month</option>
                    <option>4 Month</option>
                    <option>5 Month</option>
                    <option>6 Month</option>
                    <option>7 Month</option>
                    <option>8 Month</option>
                    <option>9 Month</option>
                    <option>10 Month</option>
                    <option>11 Month</option>
                    <option>12 Month</option>
                </select>
            </div>
        </div>
        
        <div class="special-offer">
            <div class="multiples">
                <h2>Difficulty Level</h2>
                <select id="difficultylevel" multiple name="difficultylevel[]" class="myfilter">
                    <option>Easy</option>
                    <option>Medium</option>
                    <option>Hard</option>
                    <option>Any</option>
                </select>
            </div>
        </div>
        
        <?php /*?><div class="special-offer">
            <div class="multiples">
                <h2>Gender Preference</h2>
                <select id="genderpreference" multiple name="genderpreference[]" class="myfilter">
                    <option>Male</option>
                    <option>Female</option>
                    <option>Any</option>
                </select>
            </div>
        </div>

        <div class="special-offer">
            <div class="multiples">
                <h2>Preferred Language</h2>
                <select id="categ" multiple name="language[]" class="myfilter">
                    @foreach(@$alllanguages as $language)
                    <option value="{{$language}}">{{$language}}</option>
                    @endforeach
                </select>
            </div>
        </div> <?php */?>
        <div class="special-offer">
            <div class="multiples">
                <h2>Activity Experience</h2>
                <select id="activity_exp" name="activity_exp[]" multiple class="myfilter">
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
            </div>
        </div>

        <div class="special-offer">
            <div class="multiples">
                <h2>Personality & Habits</h2>
                <select id="personality_habit" multiple name="personality_habit[]" class="myfilter">
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
            </div>
        </div>
        <?php 		
            $selected_sport = '';
            if(Session::has('selected_sport'))
                $selected_sport = Session::get('selected_sport');
        ?>
        <!-- Modal -->
        <div class="modal fade" id="viewAllSports" role="dialog">
            <div class="modal-dialog modal-lg">
                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-body login-pad">
                        <div class="pop-title employe-title">
                            <h3>CHOOSE SPORT</h3>
                        </div>
                        <button type="button" class="close modal-close" data-dismiss="modal">
                            <img src="<?php echo Config::get('constants.FRONT_IMAGE'); ?>close.jpg" height="70" width="34" />
                        </button>
                        <div class="signup">
                            <div id='systemMessage_detail'></div>
                            <div class="emplouyee-form">
                                <ul>
                                    @if(count($sports) > 0)
                                    @foreach($sports as $index => $sport_detail)
                                    <li>
                                        <span> {{ $index }} </span>
                                        <div class="choose-sportlist">
                                            @if(is_array($sport_detail))
                                            @foreach($sport_detail as $sport)
                                            <?php $class = ''; ?>
                                            @if($sport->value == $selected_sport)
                                            <?php $class = 'active'; ?>
                                            @endif
                                            @if(count($sport->child) > 0)
                                            <p class="parentsport">{{ $sport->title }}</p>
                                            @else
                                            <a href="javascript:void(0);" class="sports_selection {{$class}}" id="{{ $sport->value }}">{{ $sport->title }}</a>
                                            @endif
                                            @if(count($sport->child) > 0)
                                            @foreach($sport->child as $child_sports_key=>$child_sports_val)
                                            <?php $child_class = ''; ?>
                                            @if($child_sports_key == $selected_sport)
                                            <?php $child_class = 'active'; ?>
                                            @endif
                                            <a href="javascript:void(0);" class="sports_selection childsport {{$child_class}}" id="{{ $child_sports_key }}">{{ $child_sports_val }}</a>
                                            @endforeach
                                            @endif
                                            @endforeach
                                            @endif
                                        </div>
                                    </li>
                                    @endforeach
                                    @endif
                                </ul>
                            </div>
                        </div>

                    </div>

                </div>

            </div>

        </div>

        <!-- Modal -->

    </div>


    <?php		
        if(Session::has('who_is_training'))
		{ $whoIsTraining = Session::get('who_is_training'); }
        if(Session::has('gender'))
		{ $gender = Session::get('gender');}
		if(Session::has('level_of_experience'))
		{ $levelOfExp = Session::get('level_of_experience'); }
		if(Session::has('personality'))
		{ $personality = Session::get('personality'); }
		if(Session::has('availability_days'))
        { $availability_days = Session::get('availability_days'); }
		if(Session::has('selected_location'))
		{ $selected_location = Session::get('selected_location'); }
		if(Session::has('selected_location_lat'))
		{ $selected_location_lat = Session::get('selected_location_lat'); }
		if(Session::has('selected_location_lng'))
		{ $selected_location_lng = Session::get('selected_location_lng'); }
		if(Session::has('filter_review_star'))
		{ $filter_review_star = Session::get('filter_review_star'); }
		if(Session::has('miles_radius_filter'))
		{ $miles_radius_filter = Session::get('miles_radius_filter'); }
	?>
    {!! Form::close() !!}
    <a href="javascript:void(0)" class="filter-btn myfilter2" style="width: 100%; text-align: center;margin-top: -11px;">
        SEARCH
    </a>

    <div class="reset-filter" style="text-align: center;">
        <a href="javascript:void();" onclick="refreshPage();">
            RESET ALL FILTERS
            <i class="fa fa-filter" aria-hidden="true"></i>
        </a>
    </div>
</div>

<script src="<?php echo Config::get('constants.FRONT_JS'); ?>compare/jquery-1.9.1.min.js"></script>
<script src="https://maps.googleapis.com/maps/api/js?libraries=places&key={{ Config::get('constants.MAP_KEY') }}&sensor=false"></script>
<script>
    function submitForm() {
        var selectedSport = jQuery("li > .choose-sportlist .sports_selection.active").attr('id');
        $("#selected_sport").val(selectedSport);
        $('#frmsearchCategory').submit();
    }

    function submitProfessionType(professionType) {
        $("#professional_type").val(professionType);
        submitForm();
    }

    $('.signup-rates').click(function() {
        $(this).toggleClass('active');
        if ($(this).hasClass("active").toString() == 'true') {
            $(this).find("input[type='checkbox']").prop('checked', true);
        } else {
            $(this).find("input[type='checkbox']").prop('checked', false);
        }
    });

    function filterReviewStar(filter_stars) {
        $('.business-star').find(".start-list").removeClass('active');
        $('.filter-star-' + filter_stars).addClass('active');
        $("#filter_review_star").val(filter_stars);
    }

    function refreshPage() {
        window.location.href = '/instant-hire';
    }

</script>
<script>
    $(document).ready(function() {
        /*var categ = new SlimSelect({
            select: '#categ'
        });*/
        var categ = new SlimSelect({
            select: '#providerservices'
        });
		var categ = new SlimSelect({
            select: '#servicetypetwo'
        });
		var categ = new SlimSelect({
            select: '#programservices'
        });
        var categ = new SlimSelect({
            select: '#activity_type'
        });
        var categ = new SlimSelect({
            select: '#age_range'
        });
        var categ = new SlimSelect({
            select: '#activity_exp'
        });
        var categ = new SlimSelect({
            select: '#personality_habit'
        });
        var categ = new SlimSelect({
            select: '#activity_location'
        });
		var categ = new SlimSelect({
            select: '#activity_Member'
        });
        var categ = new SlimSelect({
            select: '#frm_cnumberofpeople',
			allowDeselect: true,
			deselectLabel: '<span class="red">✖</span>',
        });
        var categ = new SlimSelect({
            select: '#duration'
        });
        var categ = new SlimSelect({
            select: '#difficultylevel'
        });
        /*var categ = new SlimSelect({
            select: '#genderpreference'
        });*/
    });

</script>
