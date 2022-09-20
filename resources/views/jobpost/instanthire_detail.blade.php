<?php

    use App\UserBookingDetail;

    use App\BusinessServices;

    use App\BusinessPriceDetails;

	use App\BusinessPriceDetailsAges;

    use App\BusinessServiceReview;

    use App\User;

    use App\BusinessActivityScheduler;

    use Carbon\Carbon;

    

    //$current_act = BusinessServices::where('id', $serviceid)->limit(1)->get()->toArray();
    $companyactid = 0;
    $current_act = BusinessServices::where('id', $serviceid)->orderBy('id','desc')->first();
    if($current_act != ''){
        $companyactid = $current_act['cid'];
    }

    

?>

<div id="mykickboxing<?php echo $serviceid; ?>" class="mykickboxing ff modal kickboxing-moredetails" tabindex="-1">

    <div class="modal-dialog" role="document">

        <div class="modal-content">

            <div class="modal-header" style="padding:10px 40px 10px 10px; text-align: right;min-height: 30px;">

                <button type="button" class="close" data-dismiss="modal" aria-label="Close">

                    <span aria-hidden="true">&times;</span>

                </button>

                <div class="header-content hide">

                    <div class="addcompare"><a href="#" class="btnaddc">Add To Compare</a> <a href="#" class="inquirylink"><i class="fa fa-question-circle" aria-hidden="true"></i></a></div>

                    <div class="ratset-righthead">                                

                        <div class="ratset-threetxt">

                            <p><i class="fa fa-star" aria-hidden="true"></i> 4.6 (146)</p>

                            <div class="favtxt"><img src="{{ url('public/img/heartplus-icon.png') }}"> Favorite</div>

                            <div class="reviewtxt"><img src="{{ url('public/img/comment-icon.png') }}"> Submit Review</div>

                            <div class="sharetxt"><img src="{{ url('public/img/share-icon.png') }}"> Share</div>

                        </div>

                    </div>

                </div>

            </div>

            <div class="modal-body">

                <?php

                /*if (File::exists(public_path("/uploads/profile_pic/thumb/" . @$service['profile_pic']))) {

                    $profilePic = url('/public/uploads/profile_pic/thumb/' . @$service['profile_pic']);

                } else {

                    $profilePic = '/public/images/service-nofound.jpg';

                }*/

                ?>

                

                <div class="col-md-7">

                    <img src="{{ $profilePic }}" class="kickboximg-big">

                    <h3><?php echo @$service['program_name']; ?></h3>

                    <?php $redlink = str_replace(" ","-",$companyname)."/".$companyid; ?>

                    <p class="caddress"> <b> Provider: </b> <a href="{{ Config::get('constants.SITE_URL') }}/businessprofile/{{$redlink}}"> {{ $companyname }} </a>

                        <?php

                            if(!empty($companycity)) { echo $companycity; }

                            if(!empty($companycountry)) { echo ', '.$companycountry; }

                            if(!empty($companyzip)) { echo ', '.$companyzip; }

                        ?>

                    </p>

                    <h3 class="subtitle"> About </h3>

                    <p><?php echo @$service['program_desc'] ?></p>

                    <hr />

                    <div class="service-review<?php echo $serviceid; ?>">

                        <div class="row">

                            <div class="col-md-8 pl-0 pr-0"> 

                                <h3 class="subtitle"> 

                                    <div class="row">

                                        <div class="col-md-2 pl-0"> Reviews: </div>

                                        <div class="col-md-10 ">

                                            <p> <a class="activered f-16 font-bold"> By Everyone </a>

                                                <a class="f-16 font-bold"> | By People I know </a>

                                            </p>

                                        </div>

                                    </div>

                                </h3>

                                <div class="service-review-desc">

                                    <?php

                                    $reviews_count = BusinessServiceReview::where('service_id', $serviceid)->count();

                                    $reviews_sum = BusinessServiceReview::where('service_id', $serviceid)->sum('rating');

                                    

                                    $reviews_avg=0;

                                    if($reviews_count>0)

                                    { $reviews_avg = round($reviews_sum/$reviews_count,2); }

                                    ?>

                                    

                                    <p> {{$reviews_count}} Reviews </p> 

                                    <div class="rattxt activered"><i class="fa fa-star" aria-hidden="true"></i> {{$reviews_avg}} </div>

                                </div>

                            </div>

                            <div class="col-md-4 col-xs-12"> 

                                <!--<a class="btn submit-rev mt-10"> Submit Review </a>-->

                                <div class="rev-follow">

                                    <!--<a href="#" class="rev-follow-txt">100 Followers Reviewed This</a>-->

                                    <a href="#" class="rev-follow-txt">{{$reviews_count}} People Reviewed This</a>

                                    

                                    <div class="users-thumb-list">

                                        <?php 

                                        //DB::enableQueryLog();

                                        $reviews_people = BusinessServiceReview::where('service_id', $serviceid)->orderBy('id','desc')->limit(6)->get(); 

                                        //dd(\DB::getQueryLog());

                                        ?>

                                        @if(!empty($reviews_people))

                                            @foreach($reviews_people as $people)

                                                <?php $userinfo = User::find($people->user_id); ?>

                                                <a href="<?php echo config('app.url'); ?>/userprofile/{{@$userinfo->username}}" target="_blank" title="{{$userinfo->firstname}} {{$userinfo->lastname}}" data-toggle="tooltip">

                                                    <!--<img src="{{ url('public//images/newimage/userlist-1.jpg') }}" alt="">  -->

                                                    @if(File::exists(public_path("/uploads/profile_pic/thumb/".$userinfo->profile_pic)))

                                                    <img src="{{ url('/public/uploads/profile_pic/thumb/'.$userinfo->profile_pic) }}" alt="{{$userinfo->firstname}} {{$userinfo->lastname}}">

                                                    @else

                                                        <?php

                                                        $pf=substr($userinfo->firstname, 0, 1).substr($userinfo->lastname, 0, 1);

                                                        echo '<div class="admin-img-text"><p>'.$pf.'</p></div>'; ?>

                                                    @endif

                                                </a>

                                            @endforeach

                                        @endif

                                        

                                    </div>

                                </div>

                                    

                            </div>

                        </div>

                    </div>

                    

                    <div class="ser-review-list">

                        <div id="user_ratings_div<?php echo $serviceid; ?>" >

                        <?php

                            $reviews = BusinessServiceReview::where('service_id', $serviceid)->get();

                        ?>

                            @if(!empty($reviews))

                                @foreach($reviews as $review)

                                <?php $userinfo = User::find($review->user_id); ?>

                                <div class="ser-rev-user">

                            

                                    <div class="row">

                                        <div class="col-md-2 pl-0 pr-0">

                                            @if(File::exists(public_path("/uploads/profile_pic/thumb/".$userinfo->profile_pic)))

                                            <img class="rev-img" src="{{ url('/public/uploads/profile_pic/thumb/'.$userinfo->profile_pic) }}" alt="{{$userinfo->firstname}} {{$userinfo->lastname}}">

                                            @else

                                                <?php

                                                $pf=substr($userinfo->firstname, 0, 1).substr($userinfo->lastname, 0, 1);

                                                echo '<div class="reviewlist-img-text"><p>'.$pf.'</p></div>'; ?>

                                            @endif

                                        </div>

                                        <div class="col-md-10 pl-0">

                                            <h4> {{$userinfo->firstname}} {{$userinfo->lastname}}

                                            <div class="rattxt activered"><i class="fa fa-star" aria-hidden="true"></i> {{$review->rating}} </div> </h4> 

                                            <p class="rev-time"> {{date('d M-Y',strtotime($review->created_at))}} </p>

                                        </div>

                                    </div>

                               

                                </div>

                                <div class="rev-dt">

                                    <p class="mb-15"> {{$review->title}} </p>

                                    <p> {{$review->review}} </p>

                                    <?php

                                        if( !empty($review->images) ){

                                            $rimg=explode('|',$review->images);

                                            echo '<div class="listrimage">';

                                            foreach($rimg as $img)

                                            { ?>

                                                <a href="{{ url('/public/uploads/review/'.$img) }}" data-fancybox="group" data-caption="{{$review->title}}">

                                                <img src="{{ url('/public/uploads/review/'.$img) }}" alt="Fitnessity" />

                                                </a>

                                                <?php

                                            }

                                            echo '</div>';

                                        }

                                    ?>

                                    

                                </div>

                                 <!--<div class="rev-admin">

                                    <h4> Author </h4>

                                    <p> Thank you, Lorem ipsum dolor sit amet, consectetur adipiscing elit. </p>

                                </div>-->

                                @endforeach

                            @endif

                        </div>

                        <div class="ser-rev-take">

                            <div class="rev-post">

                                <div class="comet-avatar">

                                    <!--<img class="rev-take-img" src="https://development.fitnessity.co/public/uploads/profile_pic/thumb/1651248035-y6QXOYchR3w._UX970_TTW__.png"/>-->

                                    @if(Auth::check())

                                    @if(File::exists(public_path("/uploads/profile_pic/thumb/".Auth::user()->profile_pic)))

                                        <img class="rev-img" src="{{ url('/public/uploads/profile_pic/thumb/'.Auth::user()->profile_pic) }}" alt="{{Auth::user()->firstname}} {{Auth::user()->lastname}}">

                                        @else

                                            <?php

                                            $pf=substr(Auth::user()->firstname, 0, 1).substr(Auth::user()->lastname, 0, 1);

                                            echo '<div class="admin-img-text"><p>'.$pf.'</p></div>'; ?>

                                        @endif

                                     @else

                                        <?php

                                            $pf='F';

                                            echo '<div class="admin-img-text"><p>'.$pf.'</p></div>'; ?>

                                    @endif

                                </div>

                            </div>

                            <div class="rev-post-box">

                                <form method="post" enctype="multipart/form-data" name="sreview<?php echo $serviceid; ?>" id="sreview<?php echo $serviceid; ?>" >

                                @csrf

                                <div class="">

                                    <div class="clearfix"></div>
                                    <input type="hidden" name="serviceid<?php echo $serviceid; ?>" id="serviceid<?php echo $serviceid; ?>" value="<?php echo $serviceid; ?>">
                                    <input type="hidden" name="rating<?php echo $serviceid; ?>" id="rating<?php echo $serviceid; ?>" value="0">
                                    <div class="rvw-overall-rate rvw-ex-mrgn">
                                        <span>Rating</span>
                                        <div id="stars<?php echo $serviceid; ?>" data-service="<?php echo $serviceid; ?>" class="starrr" style="font-size:22px"></div>
                                    </div>
                                    <input type="text" name="rtitle<?php echo $serviceid; ?>" id="rtitle<?php echo $serviceid; ?>" placeholder="Review Title" class="inputs" />
                                    <textarea placeholder="Write your review" name="review<?php echo $serviceid; ?>" id="review<?php echo $serviceid; ?>"></textarea>
                                    <input type="file" name="rimg<?php echo $serviceid; ?>[]" id="rimg<?php echo $serviceid; ?>" class="inputs" multiple="multiple" />
                                    <div class="reviewerro" id="reviewerro<?php echo $serviceid; ?>"> </div>
                                    <input type="button" onclick="submit_rating('<?php echo $serviceid; ?>')" value="Submit" class="btn rev-submit-btn mt-10">
                                    <script>
                                        $('#stars<?php echo $serviceid; ?>').on('starrr:change', function(e, value){
                                            $('#rating<?php echo $serviceid; ?>').val(value);
                                        });
                                    </script>
                                </div>
                                </form>

                            </div>

                        </div>

                        

                    </div>

                    <div class="review-blockkick hide">

                        <h5>Add Review & Rate</h5>

                        <div class="ratestar">

                            <div>

                                <span>Quality</span>

                                <?php for($a=0; $a<10; $a++) { ?>

                                    <i class="fa fa-star" aria-hidden="true"></i>

                                <?php } ?>

                                <span><img src="{{ url('/public/img/emoji.png') }}"> Excellent</span>

                            </div>

                            <div>

                                <span>Location</span>

                                <?php for($a=0; $a<10; $a++) { ?>

                                    <i class="fa fa-star" aria-hidden="true"></i>

                                <?php } ?>

                                <span><img src="{{ url('public/img/emoji.png') }}"> Excellent</span>

                            </div>

                            <div>

                                <span>Space</span>

                                <?php for($a=0; $a<10; $a++) { ?>

                                    <i class="fa fa-star" aria-hidden="true"></i>

                                <?php } ?>

                                <span><img src="{{ url('public/img/emoji.png') }}"> Excellent</span>

                            </div>

                            <div>

                                <span>Service</span>

                                <?php for($a=0; $a<10; $a++) { ?>

                                    <i class="fa fa-star" aria-hidden="true"></i>

                                <?php } ?>

                                <span><img src="{{ url('public/img/emoji.png') }}"> Excellent</span>

                            </div>

                            <div>

                                <span>Price</span>

                                <?php for($a=0; $a<10; $a++) { ?>

                                    <i class="fa fa-star" aria-hidden="true"></i>

                                <?php } ?>

                                <span><img src="{{ url('public/img/emoji.png') }}"> Excellent</span>

                            </div>

                        </div>

                    </div>

                </div>

                <div class="col-md-5 col-xs-12 right-person">

                    <div class="fromblock">

                        <h3> <a class="active"> View Activities </a> <?php /*?>| <a> View Products </a><?php */?> </h3>

                        <?php /*?><h3>From $150 <span> / person</span></h3><?php */?>

                        <div class="multiselect-block">

                            <?php 

                                $actoffer = BusinessServices::where('cid', $companyactid)->groupBy('sport_activity')->get()->toArray();

                            ?>

                            <select id="actfiloffer<?php echo $serviceid; ?>" name="actfiloffer" class="form-control activityselect1" onchange="actFilter('<?php echo $companyactid; ?>','<?php echo $serviceid; ?>')">

                                <option value="">Activity Offered</option>

                                <?php

                                    if (!empty($actoffer)) {

                                    foreach ($actoffer as  $off) { ?>

                                        <option><?php echo $off['sport_activity'];?></option>

                                <?php } }  ?>

                                <?php /*?><option>Aerobics</option>

                                <option>Archery</option>

                                <option>Badminton</option>

                                <option>Barre</option>

                                <option>Baseball</option>

                                <option>Basketball</option>

                                <option>Beach Vollyball</option>

                                <option>Bouldering</option>

                                <option>Bungee Jumping</option>

                                <optgroup label="Camps &amp; Clinics">

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

                                <option>Zumba</option><?php */?>

                            </select>

                            <select id="actfillocation<?php echo $serviceid; ?>" name="actfillocation" class="form-control activityselect2" onchange="actFilter('<?php echo $companyactid; ?>','<?php echo $serviceid; ?>')">

                                <option value="">Location</option>

                                <option value="Online">Online</option>

                                <option value="At Business">At Business Address</option>

                                <option value="On Location">On Location</option>

                            </select>

                            <select id="actfilmtype<?php echo $serviceid; ?>" name="actfilmtype" class="form-control activityselmtype" onchange="actFilter('<?php echo $companyactid; ?>','<?php echo $serviceid; ?>')">

                                <option value="">Membership Type</option>

                                <option>Drop In</option>

                                <option>Semester</option>

                            </select>

                            <select id="actfilgreatfor<?php echo $serviceid; ?>" name="actfilgreatfor" class="form-control activityselgreatfor" onchange="actFilter('<?php echo $companyactid; ?>','<?php echo $serviceid; ?>')">

                                <option value="">Great For</option>

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

                            <select id="actfilparticipant<?php echo $serviceid; ?>" name="actfilparticipant" class="form-control activityselect4" onchange="actFilter('<?php echo $companyactid; ?>','<?php echo $serviceid; ?>')">

                                <option value="">Participant #</option>

                                <?php for($i=1; $i<=100; $i++){

                                    echo '<option value="'.$i.'">'.$i.'</option>';

                                }?>

                            </select>

                            <select id="actfilbtype<?php echo $serviceid; ?>" name="actfilbtype" class="form-control activityselbtype" 

                            onchange="actFilter('<?php echo $companyactid; ?>','<?php echo $serviceid; ?>')" >

                                <option value="">Business Type</option>

                                <option value="individual">Personal Trainer</option>

                                <option value="classes">Gym/Studio</option>

                                <option value="experience">Experience</option>

                            </select>

                            <div class="activityselect3 special-date">

                                <input type="text" name="actfildate" id="actfildate<?php echo $serviceid; ?>" placeholder="Date" class="form-control" onchange="actFilter('<?php echo $companyactid; ?>','<?php echo $serviceid; ?>')" autocomplete="off" >

                                <i class="fa fa-calendar"></i>

                            </div>

                            

                            <select id="actfilsType<?php echo $serviceid; ?>" name="actfilsType" class="form-control activityselect5" onchange="actFilter('<?php echo $companyactid; ?>','<?php echo $serviceid; ?>')">

                                <option value="">Service Type</option>

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

                            <script>

                                $( function() {

                                    $( "#actfildate<?php echo $serviceid; ?>" ).datepicker( { minDate: 0 } );

                                  } );

                            </script>

                        </div>

                        <div class="kickshow-block" id="statact<?php echo $serviceid; ?>">

                            <div class="topkick intro" id="kickboxing<?php echo $serviceid; ?>">

                                <h5><?php echo @$service['program_name']; 

                                    $reviews_count = BusinessServiceReview::where('service_id', $serviceid)->count();

                                    $reviews_sum = BusinessServiceReview::where('service_id', $serviceid)->sum('rating');

                                ?>

                                    <p>{{$reviews_count}} Reviews <span> <i class="fa fa-star" aria-hidden="true"></i> {{$reviews_avg}} </span> </p>

                                </h5>

                                <div class="lefthalf">

                                    <div class="divdesc">

                                        <div class="divleftserdes">

                                            <img src="{{$profilePic}}" />

                                        </div>

                                        <div class="divrightserdes">

                                            <p> <b> Description </b> </p>

                                            <p> 

                                                {{ Str::limit($service['program_desc'], 80, $end='...') }}

                                            </p>

                                        </div>

                                    </div>

                                    <div class="divdesc">

                                        <p class="actsubtitle"> Details: </p>

                                        <?php

                                            //$SpotsLeft = UserBookingDetail::where('sport', @$service['id'] )->count();

                                            //$SpotsLeft = UserBookingDetail::where('sport', @$service['id'] )->sum('qty');

                                             

                                            /*echo Auth::user()->id;

                                            DB::enableQueryLog();

                                            $sIdsch = !empty(Auth::user()->serviceid) ? Auth::user()->serviceid : "";

                                            $schedule = BusinessActivityScheduler::where('serviceid', $sIdsch)->get()->toArray();

                                            dd(\DB::getQueryLog());

                                            print_r($schedule);*/

                                            //DB::enableQueryLog();

                                            //$startDate= '2022-06-10';

                                            //$endDate= '2022-07-10';

                                            /*$bookscheduler = BusinessActivityScheduler::where('serviceid', $service['id'])->whereBetween('starting', [$startDate, $endDate])->limit(1)->orderBy('id', 'ASC')->get()->toArray();*/

                                                

                                            $bookscheduler = BusinessActivityScheduler::where('serviceid', $service['id'])->limit(1)->orderBy('id', 'ASC')->get()->toArray();

                                            

                                            /*$bookscheduler = BusinessActivityScheduler::where('serviceid', $service['id'])->

                                            WhereBetween(DB::raw('DATE_FORMAT(`starting`, "%Y-%m-%d")'), array(

                                            'starting',now()->addMonths(1)->format('Y-m-d')))

                                            ->orderBy('id', 'ASC')->get()->toArray();*/

                                            

                                            //dd(\DB::getQueryLog());

                                            $ser_mem = BusinessPriceDetails::where('serviceid', $service['id'])->limit(1)->orderBy('id', 'ASC')->get()->toArray();

                                            $currentDateTime = Carbon::now();

                                            $newDateTime = Carbon::parse('2022-06-10')->addMonths(3);

                                      

                                            //print_r($bookscheduler);

                                        ?>

                                        <ul>

                                            <li>

                                                <?php

                                                    //echo date('31-05-Y', strtotime('+6 month'));

                                                    /*echo date('Y-m-d', strtotime( @$bookscheduler[0]['starting'] ));

                                                    echo date('Y-m-d', strtotime("+1 year", strtotime(@$bookscheduler[0]['starting'])));

                                                    echo '<br>';*/

                                                    if(@$bookscheduler[0]['starting']!=''){

                                                        //echo date('l jS \of F Y', strtotime( $bookscheduler[0]['starting'] ));

                                                        echo date('l, F jS,  Y' );  

                                                    } 

                                                   /* if(@$bookscheduler[0]['shift_start']!=''){

                                                        echo '<br>'.date('h:ia', strtotime( $bookscheduler[0]['shift_start'] )); 

                                                    }

                                                    if(@$bookscheduler[0]['shift_end']!=''){

                                                        echo ' - '.date('h:ia', strtotime( $bookscheduler[0]['shift_end'] ));

                                                    }

                                                    if(@$bookscheduler[0]['set_duration']!=''){

                                                        $tm=explode(' ',$bookscheduler[0]['set_duration']);

                                                        $hr=''; $min=''; $sec='';

                                                        if($tm[0]!=0){ $hr=$tm[0].'hr. '; }

                                                        if($tm[2]!=0){ $min=$tm[2].'min. '; }

                                                        if($tm[4]!=0){ $sec=$tm[4].'sec.'; }

                                                        if($hr!='' || $min!='' || $sec!='')

                                                        { echo ' /'.$hr.$min.$sec; } 

                                                    } */

                                                ?>

                                            </li>

                                            <li>Service Type: <?php echo @$service['select_service_type']; ?></li>

                                            <li>Activity: <?php echo @$service['sport_activity'] ?></li>

                                            <li>Activity Location: <?php echo @$service['activity_location'] ?></li>

                                            <li>Great For: <?php echo @$service['activity_for'] ?></li>

                                            <li>Age: <?php echo @$service['age_range'] ?></li>

                                            <li>Language: <?php echo @$languages?></li>

                                            <li>Skill Level: <?php echo @$service['difficult_level'] ?></li>

                                            <?php if(@$ser_mem[0]['membership_type']!=''){ ?>

                                                <li>Membership Type: <?php echo @$ser_mem[0]['membership_type'] ?></li>

                                            <?php } ?>

                                            <li>Business Type: <?php

                                                if($service['service_type']=='individual'){ echo 'Personal Training'; }

                                                else { echo ucfirst(@$service['service_type']); } ?></li>

                                            

                                        </ul>

                                    </div>

                                </div>

                                <div class="righthalf">

                                <?php 

									$servicePr=[]; $bus_schedule=[];

									$servicePrfirst = BusinessPriceDetails::where('serviceid', $service['id'])->orderBy('id', 'ASC')->first();

									$sercate = BusinessPriceDetailsAges::where('serviceid', $service['id'])->orderBy('id', 'ASC')->get()->toArray();

									$sercatefirst = BusinessPriceDetailsAges::where('serviceid', $service['id'])->orderBy('id', 'ASC')->get()->first();

									//DB::enableQueryLog();

									if(!empty(@$sercatefirst)){

                                    	$servicePr = BusinessPriceDetails::where('serviceid', $service['id'])->orderBy('id', 'ASC')->where('category_id',@$sercatefirst['id'])->get()->toArray();

									}

									//dd(\DB::getQueryLog());

									

                                    $todayday = date("l");

                                    $todaydate = date('m/d/Y');

									if(!empty(@$sercatefirst)){

                                    	$bus_schedule = BusinessActivityScheduler::where('category_id',@$sercatefirst['id'])->whereRaw('FIND_IN_SET("'.$todayday.'",activity_days)')->where('starting','<=',$todaydate )->get();

									}

                                    /*  print_r($bus_schedule);*/

                                    $start =$end= $time= '';$timedata = '';$Totalspot= $spot_avil= 0;  $SpotsLeft =0 ;

                                    if(!empty(@$bus_schedule)){

                                        foreach($bus_schedule as $data){

                                            if($data['scheduled_day_or_week'] == 'Days'){

                                                $daynum = '+'.$data['scheduled_day_or_week_num'].' days';

                                                $expdate  = date('m/d/Y', strtotime($data['starting']. $daynum ));

                                            }else if($data['scheduled_day_or_week'] == 'Months'){

                                                $daynum = '+'.$data['scheduled_day_or_week_num'].' month';

                                                $expdate  = date('m/d/Y', strtotime($data['starting']. $daynum ));

                                            }else if($data['scheduled_day_or_week'] == 'Years'){

                                                $daynum = '+'.$data['scheduled_day_or_week_num'].' years';

                                                $expdate  = date('m/d/Y', strtotime($data['starting']. $daynum ));

                                            }else{

                                                $daynum = '+'.$data['scheduled_day_or_week_num'].' week';

                                                $expdate  = date('m/d/Y', strtotime($data['starting']. $daynum ));

                                            }  

                                            

                                            if($todaydate <=$expdate){

                                                if(@$data['shift_start']!=''){

                                                    $start = date('h:i a', strtotime( $data['shift_start'] ));

                                                    $timedata .= $start;

                                                }

                                                if(@$data['shift_end']!=''){

                                                    $end = date('h:i a', strtotime( $data['shift_end'] ));

                                                     $timedata .= ' - '.$end;

                                                } 

                                                if(@$data['set_duration']!=''){

                                                    $tm=explode(' ',$data['set_duration']);

                                                    $hr=''; $min=''; $sec='';

                                                    if($tm[0]!=0){ $hr=$tm[0].'hr. '; }

                                                    if($tm[2]!=0){ $min=$tm[2].'min. '; }

                                                    if($tm[4]!=0){ $sec=$tm[4].'sec.'; }

                                                    if($hr!='' || $min!='' || $sec!='')

                                                    { $time = $hr.$min.$sec; 

                                                        $timedata .= ' / '.$time;} 

                                                }

                                            }



                                            $today = date('Y-m-d');

                                            $SpotsLeft = UserBookingDetail::where('sport', @$service['id'] )->whereDate('created_at', '=', $today)->sum('qty');

                                            $SpotsLeftdis=0;

                                            if( !empty($data['spots_available']) ){

                                                $spot_avil=$data['spots_available'];

                                                $SpotsLeftdis = $data['spots_available']-$SpotsLeft;

                                                $Totalspot = $SpotsLeftdis.'/'.@$data['spots_available'];

                                            }

                                        }

                                    }

                                    

									if(date('l') == 'Saturday' || date('l') == 'Sunday'){
                                        $total_price_val =  @$servicePrfirst['adult_weekend_price_diff'];
                                        $selectval = '';$priceid = '';$i=1;
                                        if (!empty(@$servicePr)) {
                                            foreach ($servicePr as  $pr) {
                                                if($i==1){ 
                                                    $priceid =$pr['id'];
                                                    $selectval .='<option value="'.$pr['pay_session'].'~~'.$pr['adult_weekend_price_diff'].'~~'.$pr['id'].'^'.$pr['price_title'].'">Select Price Option</option>'; }
                                                if($pr['adult_weekend_price_diff'] != ''){
                                                    $selectval .='<option value="'.$pr['pay_session'].'~~'.$pr['adult_weekend_price_diff'].'~~'.$pr['id'].'^'.$pr['price_title'].'">Adult - '.$pr['price_title'].' - '.$pr['pay_session'].' Sessions - $'.$pr['adult_weekend_price_diff'].'</option>';}
                                                if($pr['child_cus_weekly_price'] != ''){
                                                    $selectval .='<option value="'.$pr['pay_session'].'~~'.$pr['child_weekend_price_diff'].'~~'.$pr['id'].'^'.$pr['price_title'].'">Child - '.$pr['price_title'].' - '.$pr['pay_session'].' Sessions - $'.$pr['child_weekend_price_diff'].'</option>';
                                                }
                                                if($pr['infant_cus_weekly_price'] != ''){
                                                    $selectval .='<option value="'.$pr['pay_session'].'~~'.$pr['infant_weekend_price_diff'].'~~'.$pr['id'].'^'.$pr['price_title'].'">Infant - '.$pr['price_title'].' - '.$pr['pay_session'].' Sessions - $'.$pr['infant_weekend_price_diff'].'</option>';
                                                }$i++;
                                            }
                                        }
                                    }else{
										$selectval = ''; $priceid = ''; $total_price_val='';
										//print_r($servicePr); exit;
										if(!empty(@$servicePr))
										{
											$total_price_val =  @$servicePrfirst['adult_cus_weekly_price'];
											$i=1;
                                            foreach ($servicePr as  $pr) {
												if($i==1){ 
													$priceid =$pr['id'];
													$selectval .='<option value="'.$pr['pay_session'].'~~'.$pr['adult_cus_weekly_price'].'~~'.$pr['id'].'^'.$pr['price_title'].'">Select Price Option</option>'; }
												if($pr['adult_cus_weekly_price'] != ''){
													$selectval .='<option value="'.$pr['pay_session'].'~~'.$pr['adult_cus_weekly_price'].'~~'.$pr['id'].'^'.$pr['price_title'].'">Adult - '.$pr['price_title'].' - '.$pr['pay_session'].' Sessions - $'.$pr['adult_cus_weekly_price'].'</option>';}
												if($pr['child_cus_weekly_price'] != ''){
													$selectval .='<option value="'.$pr['pay_session'].'~~'.$pr['child_cus_weekly_price'].'~~'.$pr['id'].'^'.$pr['price_title'].'">Child - '.$pr['price_title'].' - '.$pr['pay_session'].' Sessions - $'.$pr['child_cus_weekly_price'].'</option>';
												}
												if($pr['infant_cus_weekly_price'] != ''){
													$selectval .='<option value="'.$pr['pay_session'].'~~'.$pr['infant_cus_weekly_price'].'~~'.$pr['id'].'^'.$pr['price_title'].'">Infant - '.$pr['price_title'].' - '.$pr['pay_session'].' Sessions - $'.$pr['infant_cus_weekly_price'].'</option>';
												}$i++;
											}
										}

                                    }

                                ?>

                                    <select id="selcatpr<?php echo $serviceid;?>" name="selcatpr<?php echo $serviceid;?>" class="price-select-control" onchange="changeactsession('<?php echo $serviceid;?>','<?php echo $serviceid;?>',this.value,'book')">

                                    	<?php $c=1;  

										if (!empty($sercate)) { 

                                            foreach ($sercate as  $sc) {

												/*if($c==1){ 

													echo '<option value="'.$sc['id'].'"> Select Category </option>';

												}*/

												echo '<option value="'.$sc['id'].'">'.$sc['category_title'].'</option>';

												$c++;

											}

										}

										?>

                                    </select>

                                    <div class="priceoption" id="pricechng<?php echo $serviceid.$serviceid;?>">

                                        <select id="selprice<?php echo $serviceid;?>" name="selprice<?php echo $serviceid;?>" class="price-select-control" onchange="changeactpr('<?php echo $serviceid;?>',this.value,'<?php echo @$service['group_size'] ?>','book','<?php echo $serviceid;?>')">

                                            <?php echo $selectval; ?>

                                            

                                        </select>

                                    </div>

                                    <label>Booking Details: </label>

                                    <div id="book<?php echo $service["id"].$service["id"]; ?>">

                                        @if(@$sercatefirst['category_title'] != '')<p>Category: <?php echo @$sercatefirst['category_title'];?></p>@endif

                                        <p>{{$timedata}}</p>

                                        <p>Spots Left: {{$Totalspot}}</p><br>

                                       @if(@$servicePrfirst['price_title'] != '')<p>Price Title:  <?php echo @$servicePrfirst['price_title']; ?></p> @endif

                                       <?php if(!empty(@$servicePrfirst)) { ?>

                                        <p>Price Option: <?php echo @$servicePrfirst['pay_session']; ?> Session</p>

                                       <?php } ?>

                                        <p>Participants: <?php echo '1'; ?></p>

                                        <?php /*?><p>Participants: <?php echo @$service['group_size'] ?></p><?php */?>

                                        <?php if( !empty($total_price_val) ){ ?>

                                        	<p>Total: $<?php echo $total_price_val.'/person'; ?></p>

                                        <?php } ?>

                                    </div>

                					<?php if(!empty(@$servicePrfirst)) { ?>

                                    <input type="hidden" name="price_title_hidden" id="price_title_hidden{{$service['id']}}{{$service['id']}}" value="{{@$servicePrfirst['price_title']}}">

                                    <?php } ?>
                                    <input type="hidden" name="time_hidden" id="time_hidden{{$service['id']}}{{$service['id']}}" @if($timedata != 0 ) value="{{$timedata}}" @endif>

                                    <input type="hidden" name="sportsleft_hidden" id="sportsleft_hidden{{$service['id']}}{{$service['id']}}" value="{{$Totalspot}}">



                                    <form method="post" action="/addtocart" id="frmcart<?php echo $service["id"]; ?>">

                                        @csrf

                                        <input type="hidden" name="pid" value="<?php echo @$service["id"]; ?>" size="2" />

                                        

                                        <input type="hidden" name="quantity" id="pricequantity<?php echo $service["id"].$service["id"]; ?>" value="1" class="product-quantity" size="2" />

                                       <input type="hidden" name="price" id="price<?php echo $service["id"].$service["id"]; ?>" value="<?php echo $total_price_val; ?>" class="product-price" size="2" />

                                        <input type="hidden" name="session" id="session<?php echo $service["id"].$service["id"]; ?>" value="<?php echo $pay_session; ?>" />

                                        <input type="hidden" name="priceid" value="<?php echo $priceid; ?>" id="priceid<?php echo $service["id"].$service["id"]; ?>" />

                                        <input type="hidden" name="sesdate" value="<?php echo date('Y-m-d'); ?>" id="sesdate<?php echo $service["id"].$service["id"]; ?>" />

                                        <input type="hidden" name="cate_title" value="{{@$sercatefirst['category_title']}}" id="cate_title{{$service['id']}}{{$service['id']}}" />

                                        <span id="span<?php echo $service["id"]; ?>" name="span<?php echo $service["id"]; ?>"> </span>

                                        @if($SpotsLeft >= $spot_avil && $spot_avil!=0)

                                            <a href="javascript:void(0)" class="btn btn-addtocart mt-10" style="pointer-events: none;" >Sold Out</a>

                                        @else

                                          @if( !empty(@$servicePrfirst) )

                                            @if( @$servicePrfirst['adult_cus_weekly_price']!='' && @$timedata!='' )

                                                <input type="submit" value="Add to Cart" onclick="changeqnt('<?php echo $service["id"]; ?>')" class="btn btn-addtocart mt-10"  id="addtocart{{$service['id']}}{{$service['id']}}"/>

                                            @endif

                                          @endif

                                        @endif

                                    </form>

                                </div>

                            </div>

                            <div class="bottomkick">

                                <div class="viewmore_links">

                                        <a id="viewmore<?php echo $service['id']; ?>" style="display:none">View More <img src="{{ url('public/img/arrow-down.png') }}" alt=""></a>

                                        <a id="viewless<?php echo $service['id']; ?>" style="display:block">View Less <img src="{{ url('public/img/arrow-down.png') }}" alt=""></a>

                                </div>

                            </div>

                            <script>

                                $("#viewmore<?php echo $service['id']; ?>").click(function () {

                                    $("#kickboxing<?php echo $service['id']; ?>").addClass("intro");

                                    $("#viewless<?php echo $service['id']; ?>").show();

                                    $("#viewmore<?php echo $service['id']; ?>").hide();

                                });

                                $("#viewless<?php echo $service['id']; ?>").click(function () {

                                    $("#kickboxing<?php echo $service['id']; ?>").removeClass("intro");

                                    $("#viewless<?php echo $service['id']; ?>").hide();

                                    $("#viewmore<?php echo $service['id']; ?>").show();

                                });

                            </script>

                        </div>

                        

                        <div id="actsearch<?php echo $service["id"]; ?>" class="actsearch">

                        <?php

                        //DB::enableQueryLog();

                        $activities_search = BusinessServices::where('cid', $companyid)->where('is_active', '1')->where('id', '!=' , $service['id'])->limit(2)->orderBy('id', 'DESC')->get();

                        //dd(\DB::getQueryLog());

                        

                        if (!empty($activities_search)) { 

                            foreach ($activities_search as  $act) {

                                $servicePrice = BusinessPriceDetails::where('serviceid', $act['id'])->limit(1)->orderBy('id', 'ASC')->get()->toArray();

                                $pay_session1=''; $pay_price1=''; $priceid1='';

                                //print_r($servicePrice);

                                if( !empty($servicePrice) )

                                {

                                    if(@$servicePrice[0]['pay_session']!=''){

                                        $pay_session1 = @$servicePrice[0]['pay_session'];

                                    }

                                    if(@$servicePrice[0]['pay_price']!=''){

                                        $pay_price1 = @$servicePrice[0]['pay_price'];

                                    }

                                    if(@$servicePrice[0]['id']!=''){

                                        $priceid1 = @$servicePrice[0]['id'];

                                    }

                                }

                                $bookscheduler='';

                                $bookscheduler = BusinessActivityScheduler::where('serviceid', $act['id'])->limit(1)->orderBy('id', 'ASC')->get()->toArray();

                                $ser_mem = BusinessPriceDetails::where('serviceid', $act['id'])->limit(1)->orderBy('id', 'ASC')->get()->toArray();

                        ?>

                            <div class="kickshow-block">

                                <div class="topkick" id="kickboxing<?php echo $service['id'].$act['id']; ?>">

                                    <h5><?php echo @$act['program_name']; 

                                            $reviews_count = BusinessServiceReview::where('service_id', $act['id'])->count();

                                            $reviews_sum = BusinessServiceReview::where('service_id', $act['id'])->sum('rating');

                                        ?>

                                        <p>{{$reviews_count}} Reviews <span> <i class="fa fa-star" aria-hidden="true"></i>

                                         {{$reviews_avg}} </span></p>

                                    </h5>

                                    <div class="lefthalf">

                                        <div class="divdesc">

                                            <?php

                                                //$SpotsLeft = UserBookingDetail::where('sport', @$act['id'] )->sum('qty');

                                               /* $today = date('Y-m-d');

                                                $SpotsLeft = UserBookingDetail::where('sport', @$act['id'] )->whereDate('created_at', '=', $today)->sum('qty');

                                                $SpotsLeftdis=0;

                                                if( !empty($act['group_size']) )

                                                    $SpotsLeftdis = $act['group_size']-$SpotsLeft;*/

                                            ?>

                                            <p class="actsubtitle"> Details: </p>

                                            <ul>

                                                <li>

                                                    <?php

                                                        if(@$bookscheduler[0]['starting']!=''){

                                                            //echo date('l jS \of F Y', strtotime( $bookscheduler[0]['starting'] ));

                                                            echo date('l, F jS,  Y' );

                                                        } 

                                                       /* if(@$bookscheduler[0]['shift_start']!=''){

                                                            //echo '<br>'.$bookscheduler[0]['shift_start'];

                                                            echo '<br>'.date('h:ia', strtotime( $bookscheduler[0]['shift_start'] )); 

                                                        }

                                                        if(@$bookscheduler[0]['shift_end']!=''){

                                                            //echo ' - '.$bookscheduler[0]['shift_end'];

                                                            echo ' - '.date('h:ia', strtotime( $bookscheduler[0]['shift_end'] )); 

                                                        }

                                                        if(@$bookscheduler[0]['set_duration']!=''){

                                                            $tm=explode(' ',$bookscheduler[0]['set_duration']);

                                                            $hr=''; $min=''; $sec='';

                                                            if($tm[0]!=0){ $hr=$tm[0].'hr. '; }

                                                            if($tm[2]!=0){ $min=$tm[2].'min. '; }

                                                            if($tm[4]!=0){ $sec=$tm[4].'sec.'; }

                                                            if($hr!='' || $min!='' || $sec!='')

                                                            { echo ' /'.$hr.$min.$sec; } 

                                                        }*/

                                                    ?>

                                                </li>

                                               

                                                <li>Service Type: <?php echo @$act['select_service_type']; ?></li>

                                                <li>Activity: <?php echo @$act['sport_activity'] ?></li>

                                                <li>Activity Location: <?php echo @$act['activity_location'] ?></li>

                                                <li>Great For: <?php echo @$act['activity_for'] ?></li>

                                                <li>Age: <?php echo @$act['age_range'] ?></li>

                                                <li>Language: <?php echo @$languages?></li>

                                                <li>Skill Level: <?php echo @$act['difficult_level'] ?></li>

                                                <?php if(@$ser_mem[0]['membership_type']!=''){ ?>

                                                    <li>Membership Type: <?php echo @$ser_mem[0]['membership_type'] ?></li>

                                                <?php } ?>

                                                <li>Business Type: <?php

                                                    if($act['service_type']=='individual'){ echo 'Personal Training'; }

                                                    else { echo @$act['service_type']; } ?></li>

                                            </ul>

                                        </div>

                                    </div>

                                    <div class="righthalf">

                                    <?php //echo $act['id'];

                                        

                                        $servicePrfirst = BusinessPriceDetails::where('serviceid', $act['id'])->orderBy('id', 'ASC')->first();

                                        $sercate = BusinessPriceDetailsAges::where('serviceid', $act['id'])->orderBy('id', 'ASC')->get()->toArray();

                                        $sercatefirst = BusinessPriceDetailsAges::where('serviceid', $act['id'])->orderBy('id', 'ASC')->get()->first();

                                        $servicePr = BusinessPriceDetails::where('serviceid', $act['id'])->orderBy('id', 'ASC')->where('category_id',@$sercatefirst['id'])->get()->toArray();

                                       /* print_r( $servicePr );exit();*/

                                        $todayday = date("l");

                                        $todaydate = date('m/d/Y');

                                        $bus_schedule = BusinessActivityScheduler::where('category_id',@$sercatefirst['id'])->whereRaw('FIND_IN_SET("'.$todayday.'",activity_days)')->where('starting','<=',$todaydate )->get();

                                        $start =$end= $time= '';$timedata = $SpotsLeft = 0; $Totalspot = $spot_avil= 0; 

                                        if(!empty($bus_schedule)){

                                            foreach($bus_schedule as $data){

                                                if($data['scheduled_day_or_week'] == 'Days'){

                                                    $daynum = '+'.$data['scheduled_day_or_week_num'].' days';

                                                    $expdate  = date('m/d/Y', strtotime($data['starting']. $daynum ));

                                                }else if($data['scheduled_day_or_week'] == 'Months'){

                                                    $daynum = '+'.$data['scheduled_day_or_week_num'].' month';

                                                    $expdate  = date('m/d/Y', strtotime($data['starting']. $daynum ));

                                                }else if($data['scheduled_day_or_week'] == 'Years'){

                                                    $daynum = '+'.$data['scheduled_day_or_week_num'].' years';

                                                    $expdate  = date('m/d/Y', strtotime($data['starting']. $daynum ));

                                                }else{

                                                    $daynum = '+'.$data['scheduled_day_or_week_num'].' week';

                                                    $expdate  = date('m/d/Y', strtotime($data['starting']. $daynum ));

                                                }  

                                                

                                                if($todaydate <=$expdate){

                                                     $timedata ='';

                                                    if(@$data['shift_start']!=''){

                                                        $start = date('h:i a', strtotime( $data['shift_start'] ));



                                                        $timedata .= $start;

                                                    }

                                                    if(@$data['shift_end']!=''){

                                                        $end = date('h:i a', strtotime( $data['shift_end'] ));

                                                         $timedata .= ' - '.$end;

                                                    } 

                                                    if(@$data['set_duration']!=''){

                                                        $tm=explode(' ',$data['set_duration']);

                                                        $hr=''; $min=''; $sec='';

                                                        if($tm[0]!=0){ $hr=$tm[0].'hr. '; }

                                                        if($tm[2]!=0){ $min=$tm[2].'min. '; }

                                                        if($tm[4]!=0){ $sec=$tm[4].'sec.'; }

                                                        if($hr!='' || $min!='' || $sec!='')

                                                        { $time = $hr.$min.$sec; 

                                                            $timedata .= ' / '.$time;} 

                                                    }

                                                }

                                                $today = date('Y-m-d');

                                                $SpotsLeft = UserBookingDetail::where('sport', @$service['id'] )->whereDate('created_at', '=', $today)->sum('qty');

                                                $SpotsLeftdis=0;

                                                if( !empty($data['spots_available']) ){

                                                    $spot_avil=$data['spots_available'];

                                                    $SpotsLeftdis = $data['spots_available']-$SpotsLeft;

                                                    $Totalspot = $SpotsLeftdis.'/'.@$data['spots_available'];

                                                }

                                            }

                                        }

                                        if(date('l') == 'Saturday' || date('l') == 'Sunday'){
                                            $total_price_val =  @$servicePrfirst['adult_weekend_price_diff'];
                                            $selectval = '';$priceid = '';$i=1;
                                            if(!empty(@$servicePr)){
                                                foreach ($servicePr as  $pr) {
                                                    if($i==1){ 
                                                        $priceid =$pr['id'];
                                                        $selectval .='<option value="'.$pr['pay_session'].'~~'.$pr['adult_weekend_price_diff'].'~~'.$pr['id'].'^'.$pr['price_title'].'">Select Price Option</option>'; }
                                                    if($pr['adult_weekend_price_diff'] != ''){
                                                        $selectval .='<option value="'.$pr['pay_session'].'~~'.$pr['adult_weekend_price_diff'].'~~'.$pr['id'].'^'.$pr['price_title'].'">Adult - '.$pr['price_title'].' - '.$pr['pay_session'].' Sessions - $'.$pr['adult_weekend_price_diff'].'</option>';}
                                                    if($pr['child_cus_weekly_price'] != ''){
                                                        $selectval .='<option value="'.$pr['pay_session'].'~~'.$pr['child_weekend_price_diff'].'~~'.$pr['id'].'^'.$pr['price_title'].'">Child - '.$pr['price_title'].' - '.$pr['pay_session'].' Sessions - $'.$pr['child_weekend_price_diff'].'</option>';
                                                    }
                                                    if($pr['infant_cus_weekly_price'] != ''){
                                                        $selectval .='<option value="'.$pr['pay_session'].'~~'.$pr['infant_weekend_price_diff'].'~~'.$pr['id'].'^'.$pr['price_title'].'">Infant - '.$pr['price_title'].' - '.$pr['pay_session'].' Sessions - $'.$pr['infant_weekend_price_diff'].'</option>';
                                                    }$i++;
                                                }
                                            }
                                        }else{
                                            $total_price_val =  @$servicePrfirst['adult_cus_weekly_price'];
                                            $selectval = '';$priceid = '';$i=1;
                                            if(!empty(@$servicePr)){
                                                foreach ($servicePr as  $pr) {
                                                    if($i==1){ 
                                                        $priceid =$pr['id'];
                                                        $selectval .='<option value="'.$pr['pay_session'].'~~'.$pr['adult_cus_weekly_price'].'~~'.$pr['id'].'^'.$pr['price_title'].'">Select Price Option</option>'; }
                                                    if($pr['adult_cus_weekly_price'] != ''){
                                                        $selectval .='<option value="'.$pr['pay_session'].'~~'.$pr['adult_cus_weekly_price'].'~~'.$pr['id'].'^'.$pr['price_title'].'">Adult - '.$pr['price_title'].' - '.$pr['pay_session'].' Sessions - $'.$pr['adult_cus_weekly_price'].'</option>';}
                                                    if($pr['child_cus_weekly_price'] != ''){
                                                        $selectval .='<option value="'.$pr['pay_session'].'~~'.$pr['child_cus_weekly_price'].'~~'.$pr['id'].'^'.$pr['price_title'].'">Child - '.$pr['price_title'].' - '.$pr['pay_session'].' Sessions - $'.$pr['child_cus_weekly_price'].'</option>';
                                                    }
                                                    if($pr['infant_cus_weekly_price'] != ''){
                                                        $selectval .='<option value="'.$pr['pay_session'].'~~'.$pr['infant_cus_weekly_price'].'~~'.$pr['id'].'^'.$pr['price_title'].'">Infant - '.$pr['price_title'].' - '.$pr['pay_session'].' Sessions - $'.$pr['infant_cus_weekly_price'].'</option>';
                                                    }$i++;
                                                }
                                            }
                                        }
                                    ?>



                                        <select id="selcatpr<?php echo $act['id'];?>" name="selcatpr<?php echo $act['id'];?>" class="price-select-control" onchange="changeactsession('<?php echo $service['id'];?>','<?php echo $act['id'];?>',this.value,'bookmore')">

                                            <?php $c=1;  

                                            if (!empty(@$sercate)) { 

                                                foreach ($sercate as  $sc) {

                                                   /* if($c==1){ 

                                                        echo '<option value="'.$sc['id'].'"> Select Category </option>';

                                                    }*/

                                                    echo '<option value="'.$sc['id'].'">'.$sc['category_title'].'</option>';

                                                    $c++;

                                                }

                                            }

                                            ?>

                                        </select>

                                        <div id="pricechng<?php echo $service['id'].$act['id'];?>">

                                            <select id="selprice<?php echo $act['id'];?>" name="selprice<?php echo $act['id'];?>" class="price-select-control" onchange="changeactpr('<?php echo $act['id'];?>',this.value,'1','bookmore','<?php echo $service['id'];?>')" >

                                                <?php echo $selectval;?>

                                                ?>

                                            </select>

                                        </div><?php  $start=''; $end=''; $time = ''; ?>

                                        <label>Booking Details:</label>

                                        <div id="bookmore<?php echo $service['id'].$act["id"]; ?>">

                                            @if(@$sercatefirst['category_title'] != '')<p>Category: <?php echo @$sercatefirst['category_title'];?></p>@endif

                                            <p>@if($timedata!=0){{$timedata}} @endif</p>

                                            <p>Spots Left: {{$Totalspot}}</p><br>

                                            @if(@$servicePrfirst['price_title'] != '')<p>Price Title:  <?php echo @$servicePrfirst['price_title']; ?></p> @endif

                                            <p>Price Option: <?php echo @$servicePrfirst['pay_session']; ?> Session</p>

                                            <p>Participants: <?php echo '1'; ?></p>

                                                <?php /*?><p>Participants: <?php echo @$act['group_size'] ?></p><?php */?>

                                            <p>Total: $<?php echo $total_price_val.'/person'; ?></p>

                                        </div>

                                        <input type="hidden" name="price_title_hidden" id="price_title_hidden{{$service['id']}}{{$act['id']}}" value="{{@$servicePrfirst['price_title']}}">

                                        <input type="hidden" name="time_hidden" id="time_hidden{{$service['id']}}{{$act['id']}}" @if($timedata != 0 ) value="{{$timedata}}" @endif>

                                        <input type="hidden" name="sportsleft_hidden" id="sportsleft_hidden{{$service['id']}}{{$act['id']}}"  value="{{$Totalspot}}" >

                                        <form method="post" action="/addtocart" id="frmcart<?php echo @$act["id"]; ?>">

                                        @csrf

                                        <input type="hidden" name="pid" value="<?php echo @$act["id"]; ?>" />

                                        <input type="hidden" name="quantity" id="pricequantity<?php echo $service['id'].$act["id"]; ?>" value="1" class="product-quantity" />

                                       <input type="hidden" name="price" id="pricebookmore<?php echo $service['id'].$act["id"]; ?>" value="<?php echo $total_price_val; ?>" class="product-price"  />

                                        <input type="hidden" name="session" id="session<?php echo $service['id'].$act["id"]; ?>" value="<?php echo $pay_session1; ?>" />

                                        <input type="hidden" name="priceid" value="<?php echo $priceid1; ?>" id="priceid<?php echo $service["id"].$act["id"]; ?>" />

                                        <input type="hidden" name="sesdate" value="<?php echo date('Y-m-d' ); ?>" id="sesdate<?php echo $service["id"].$act["id"]; ?>" />

                                        <input type="hidden" name="cate_title" value="{{@$sercatefirst['category_title']}}" id="cate_title{{$service['id']}}{{$act['id']}}" />

                                      

                                        @if($SpotsLeft >= $spot_avil && $spot_avil!=0)

                                            <?php /*?><input type="button" value="Sold Out" class="btn btn-addtocart mt-10" /><?php */?>

                                             <a href='javascript:void(0)' class="btn btn-addtocart mt-10" style="pointer-events: none;">Sold Out</a>

                                        @else

                                            @if(@$servicePrfirst['adult_cus_weekly_price'] !='' && @$timedata!='')

                                            <input type="submit" value="Add to Cart" onclick="changeqnt('<?php echo $act["id"]; ?>')" class="btn btn-addtocart mt-10"  id="addtocart{{$service['id']}}{{$act['id']}}" />

                                            @endif

                                        @endif

                                        </form>

                                    </div>

                                </div>

                                <div class="bottomkick">

                                    <div class="viewmore_links">

                                        <a id="viewmore<?php echo $service['id'].$act['id']; ?>" style="display:block">View More <img src="{{ url('public/img/arrow-down.png') }}" alt=""></a>

                                        <a id="viewless<?php echo $service['id'].$act['id']; ?>" style="display:none">View Less <img src="{{ url('public/img/arrow-down.png') }}" alt=""></a>

                                    </div>

                                </div>

                            </div>

                           <script>

                            $("#viewmore<?php echo $service['id'].$act['id']; ?>").click(function () {

                                $("#kickboxing<?php echo $service['id'].$act['id']; ?>").addClass("intro");

                                $("#viewless<?php echo $service['id'].$act['id']; ?>").show();

                                $("#viewmore<?php echo $service['id'].$act['id']; ?>").hide();

                            });

                            $("#viewless<?php echo $service['id'].$act['id']; ?>").click(function () {

                                $("#kickboxing<?php echo $service['id'].$act['id']; ?>").removeClass("intro");

                                $("#viewless<?php echo $service['id'].$act['id']; ?>").hide();

                                $("#viewmore<?php echo $service['id'].$act['id']; ?>").show();

                            });

                            </script>

                       <?php } } ?>

                            

                        </div><!-- actsearch -->

                        

                    </div><!-- fromblock -->

                </div>

            </div>

        </div>

    </div>

</div>





<script>

/*function changerate(sid) {

    $('#rating').val(value);
    alert(sid);
}*/

function actFilter(cid,sid)

{

    var actoffer=$('#actfiloffer'+sid).val();

    var actloc=$('#actfillocation'+sid).val();

    var actfilmtype=$('#actfilmtype'+sid).val();

    var actfilgreatfor=$('#actfilgreatfor'+sid).val();

    var actfilparticipant=$('#actfilparticipant'+sid).val();

    var btype=$('#actfilbtype'+sid).val();

    var actdate=$('#actfildate'+sid).val();

    var actfilsType=$('#actfilsType'+sid).val();

    var _token = $("input[name='_token']").val();

    var serviceid =sid;

    var pr; var qty;

    //alert(actfiloffer);

    $.ajax({

        url: "{{route('act_detail_filter')}}",

        type: 'POST',

        xhrFields: {

            withCredentials: true

        },

        data:{

            _token: _token,

            type: 'POST',

            actoffer:actoffer,

            actloc:actloc,

            actfilmtype:actfilmtype,

            actfilgreatfor:actfilgreatfor,

            actfilparticipant:actfilparticipant,

            btype:btype,

            actdate:actdate,

            actfilsType:actfilsType,

            serviceid:serviceid,

            companyid:cid,

        },

        success: function (response) { 

            /*alert(response);*/

          

            var data = response.split('~~~~~~');

            $('#actsearch'+sid).html(data[0]);

            $('#statact'+sid).html(data[1]);

            //alert($('#price'+sid).val());

            var firstval=$("#selprice"+sid).prop("selectedIndex", 1).val();

            if(actdate!=''){

                var actdt = actdate.split('/');

                $('#sesdate'+sid+sid).val(actdt[2]+'-'+actdt[0]+'-'+actdt[1]);

            }

            

            /*var n = firstval.split('~~');

            if(actfilparticipant!='')

            {

                pr=actfilparticipant*n[1]; 

                qty=actfilparticipant;

            }

            else{ pr=n[1]; qty='1'; }

            var data = '<p>Price Option: '+n[0]+' Session</p><p>Participants: '+qty+'</p><p>Total: $'+pr+'/person</p>';

            $('#book'+sid).html(data);

            $('#pricequantity'+sid).val(qty);

            $('#price'+sid).val(pr);*/

            

        }

    });

}



/*function changeqnt(aid)

{

    var actfilparticipant=$('#actfilparticipant').val();

    if(actfilparticipant>0){

        $('#pricequantity'+aid).val(actfilparticipant);

    }

    else

    {

        $('#pricequantity'+aid).val('1');

    }

    return false;

}*/



</script>

