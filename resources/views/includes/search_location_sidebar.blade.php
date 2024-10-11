<script type="text/javascript" src="/AdminLTE/plugins/bootstrap-slider/bootstrap-slider.js"></script>
<link rel="stylesheet" type="text/css" href="/AdminLTE/plugins/bootstrap-slider/slider.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/slim-select/1.18.10/slimselect.min.js"></script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/slim-select/1.18.10/slimselect.min.css" rel="stylesheet"></link>
<link rel="stylesheet" href="/public/js/select/select.css"/>
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
<div class="direct-hire-sidebar">
    <form method="GET" action="{{url('/search-result-location')}}" id="myscform">
        <div class="special-offer" style="margin-top: 5%;">
            <h2>CHOOSE SERVICE TYPE</h2>
            <ul class="direct-categories">
            <?php
            if (Session::has('professional_type')) {
                $professional_type = Session::get('professional_type');
            } else {
                $professional_type = '1';
            }
            ?>	
                <select name="professional_type[]" multiple id="professional_type"  class="myfilter">
                <?php foreach ($businessType as $bkey => $bval) { ?>
                        <option value="{{$bkey}}" @if($select_professional_type != null && in_array ( $bkey, $select_professional_type )) selected @endif>{{$bval['type']}}</option>
                <?php } ?>
                </select>
            </ul>
        </div>
        <div class="choose-sport">
        <?php
        $selected_sport = '';
        if (Session::has('selected_sport'))
            $selected_sport = Session::get('selected_sport');
        ?>
            <input type="hidden" name="_token" id="search_token" value="{{csrf_token()}}">
            <div class="select-style">			
                <select name="selected_sport" id="frm_servicesport" class="form-control selectpicker myfilter">
                    {!! $sports_select !!}
                </select>
            </div>			
            <div class="special-offer">
                <h2>Location</h2>
                <div class="view special-offer">
                    <input  type="text" id="mynewloc" class="location-control myfilter" name="location" value="{{$request_location}}" placeholder="search by country, city, state, zip" />
                </div>
            </div>
            <div class="special-offer">
                <div class="multiples">
                    <h2>Activity For</h2>
                    <select id="activity_for" multiple name="activity_for[]" class="myfilter" >
                        @foreach (@$activity as $pkey => $pval)
                        <?php $pkey = str_replace(' ', '_', strtolower($pkey)); ?>
                        <option value='{{$pkey}}' @if($select_activity_for != null && in_array ( $pkey, $select_activity_for )) selected @endif> {{$pval}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="special-offer">
                <div class="multiples">
                    <h2>Activity Type</h2>
                    <select id="activity_type" multiple name="activity_type[]" class="myfilter" >
                        @foreach (@$programType as $pkey => $pval)
                        <?php $pkey = str_replace(' ', '_', strtolower($pkey)); ?>
                        <option value='{{$pkey}}' @if($select_activity_type != null && in_array ( $pkey, $select_activity_type )) selected @endif> {{$pval}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="special-offer">
                <div class="multiples">
                    <h2>Age Range</h2>
                    <select id="age_range" multiple  name="age_range[]" class="myfilter" >
                        @foreach (@$ageRange as $arkey => $arval)
                        <?php $arkey = str_replace(' ', '_', strtolower($arkey)); ?>
                        <option value='{{$arkey}}' @if($select_age != null && in_array ( $arkey, $select_age )) selected @endif> {{$arval}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="special-offer">
                <div class="multiples">
                    <h2>Preferred Language</h2>
                    <select id="categ" multiple name="language[]" class="myfilter" >
                        @foreach(@$alllanguages as  $language)
                        <option value="{{$language}}" @if($select_language != null && in_array ( $language, $select_language )) selected @endif>{{$language}}</option>
                        @endforeach 
                    </select>
                </div>
            </div>
            <div class="special-offer">
                <div class="multiples">
                    <h2>Activity Experience</h2>
                    <select id="activity_exp" name="activity_exp[]" multiple  class="myfilter" >
                        @foreach (@$pFocuses as $pfkey => $pfval)
                        <?php $pfkey = str_replace(' ', '_', strtolower($pfkey)); ?>
                        <option value='{{$pfkey}}' @if($select_experience != null && in_array ( $pfkey, $select_experience )) selected @endif> {{$pfval}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="special-offer">
                <div class="multiples">
                    <h2>Personality & Habits</h2>
                    <select id="personality_habit" multiple name="personality_habit[]"  class="myfilter" >
                        <option @if($select_personality != null && in_array ( 'An Educator & Teacher', $select_personality )) selected @endif>An Educator & Teacher</option>
                        <option @if($select_personality != null && in_array ( 'A lot of energy', $select_personality )) selected @endif>A lot of energy </option>
                        <option @if($select_personality != null && in_array ( 'A drill sergeant', $select_personality )) selected @endif>A drill sergeant </option>
                        <option @if($select_personality != null && in_array ( 'Inspiring', $select_personality )) selected @endif>Inspiring</option>
                        <option @if($select_personality != null && in_array ( 'Motivational', $select_personality )) selected @endif>Motivational</option>
                        <option @if($select_personality != null && in_array ( 'Supportive, Soft and Nurturing', $select_personality )) selected @endif>Supportive, Soft and Nurturing </option>
                        <option @if($select_personality != null && in_array ( 'Tough and Firm', $select_personality )) selected @endif>Tough and Firm </option>
                        <option @if($select_personality != null && in_array ( 'Detail oriented', $select_personality )) selected @endif>Detail oriented</option>
                        <option @if($select_personality != null && in_array ( 'Gentle', $select_personality )) selected @endif >Gentle</option>
                        <option @if($select_personality != null && in_array ( 'Intense', $select_personality )) selected @endif>Intense </option>
                        <option @if($select_personality != null && in_array ( 'Calls a spade a spade', $select_personality )) selected @endif>Calls a spade a spade</option>
                        <option @if($select_personality != null && in_array ( 'Likes to talk', $select_personality )) selected @endif>Likes to talk</option>
                        <option @if($select_personality != null && in_array ( 'Punctual', $select_personality )) selected @endif>Punctual</option>
                        <option @if($select_personality != null && in_array ( 'Organized', $select_personality )) selected @endif>Organized</option>
                        <option @if($select_personality != null && in_array ( 'Stern', $select_personality )) selected @endif>Stern</option>
                        <option @if($select_personality != null && in_array ( 'Friendly & outgoing', $select_personality )) selected @endif>Friendly & outgoing </option>
                        <option @if($select_personality != null && in_array ( 'Other', $select_personality )) selected @endif>Other</option>
                        <option @if($select_personality != null && in_array ( 'Any', $select_personality )) selected @endif >Any</option>
                    </select>
                </div>
            </div>
            <div class="special-offer">
                <div class="multiples">
                    <h2>Activity Location</h2>
                    <select id="activity_location" name="activity_location[]" multiple  class="myfilter" >
                        @foreach (@$serviceLocation as $slkey => $slval)
                        <?php $slkey = str_replace(' ', '_', strtolower($slkey)); ?>
                        <option value='{{$slkey}}' @if($select_activity_location != null && in_array ( $slkey, $select_activity_location )) selected @endif>{{$slval}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
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
                                <img src="
<?php echo Config::get('constants.FRONT_IMAGE'); ?>close.jpg" height="70" width="34"/>
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
if (Session::has('who_is_training')) {
    $whoIsTraining = Session::get('who_is_training');
}
if (Session::has('gender')) {
    $gender = Session::get('gender');
}
if (Session::has('level_of_experience')) {
    $levelOfExp = Session::get('level_of_experience');
}
if (Session::has('personality')) {
    $personality = Session::get('personality');
}
if (Session::has('availability_days')) {
    $availability_days = Session::get('availability_days');
}
if (Session::has('selected_location')) {
    $selected_location = Session::get('selected_location');
}
if (Session::has('selected_location_lat')) {
    $selected_location_lat = Session::get('selected_location_lat');
}
if (Session::has('selected_location_lng')) {
    $selected_location_lng = Session::get('selected_location_lng');
}
if (Session::has('filter_review_star')) {
    $filter_review_star = Session::get('filter_review_star');
}
if (Session::has('miles_radius_filter')) {
    $miles_radius_filter = Session::get('miles_radius_filter');
}
?>  
        <button style="display:none;" id="mysrchloc" type="submit" class="filter-btn myfilter2" style="width: 100%; text-align: center;margin-top: -11px;">
            SEARCH
        </button>
        <div class="reset-filter" style="text-align: center;">
            <a class="reset-filter1" href="javascript:void();" >
                RESET ALL FILTERS 
                <i class="fa fa-filter" aria-hidden="true"></i>
            </a>
    </form>
</div>
</div>
<script src="<?php echo Config::get('constants.FRONT_JS'); ?>compare/jquery-1.9.1.min.js"></script>
<script src="https://maps.googleapis.com/maps/api/js?libraries=places&key={{ Config::get('constants.MAP_KEY') }}&sensor=false"></script>
<script src="{{url('/public/js/infobox.js')}}"></script>
<script>
// $('select').on('change', function() {
//     $('#mysrchloc').click();
// })

$('select').on('change', function () {
    var data = $('#myscform').serialize();
    $.ajax({
        url: '/search-result-location1?' + data,
        type: 'get',
        beforeSend: function () {
            $('.loader').show();
        },
        complete: function () {
            $('.loader').hide();
        },
        success: function (response) {
            $('#newfileeee').html(response)
        }
    })

})

$('.reset-filter1').on('click', function () {
    var url = "{{url('/search-result-location?location=')}}";
    window.location.href = url + $('#mynewloc').val();
});

function submitForm(){
    var selectedSport = jQuery("li > .choose-sportlist .sports_selection.active").attr('id');
    $("#selected_sport").val(selectedSport);
    $('#frmsearchCategory').submit();
}

function submitProfessionType(professionType){
    $("#professional_type").val(professionType);
    submitForm();
}

$('.signup-rates').click(function () {
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
    window.location.href = '/direct-hire';
}
</script>
<script>
    $(document).ready(function () {
        var categ = new SlimSelect({
            select: '#categ'
        });
        var categ = new SlimSelect({
            select: '#activity_type'
        });
        var categ = new SlimSelect({
            select: '#activity_for'
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
            select: '#professional_type'
        });
    })

</script>
<style>.col-md-4.mysrchmap {padding-left: 0;}
    .card-claimed-business .content-left-claimed ul li{
        width: 25px !important;
        height: 25px !important;
        padding: 4px !important;
        margin: 0px 2px !important;
    }
    .direc-right ul li i{
        font-size: 15px !important;
        color: #fff !important;
        padding-right: 0px !important;
    }
    form#frmsearchCategory {
        margin: 0;
    }
    .search-result-location {
        padding: 0px 0;
    }
</style>