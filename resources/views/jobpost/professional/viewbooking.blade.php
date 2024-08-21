@extends('layouts.profile')



@section('content')



<!-- <section class="direc-hire"> -->



<!-- <div class="direc-right"> -->



<div class="business-offer-main">

<style>

.colorBox.RestDayState, .colorBox.WorkingDayState {

  display: none;

}

.operationTime .mini-time {

  width: 60px !important;

}

</style>

    @include('includes.sidebar_profile_left')

    <?php

    $userQuote = $data['jobsObj']['bookingQuotes'][0];

    $userDetail = $data['jobsObj']['user'];

    // echo '<pre>'; print_r($followdetail); die();

    $UserBookingDetail = $data['jobsObj']['user_booking_detail'];

    ?>

    <div class="business-middle">    

    <div class="network_block nw-profile_block">     

     <div class="row">

        <div class="nw-user-detail-block" style="padding-bottom: 10px;">

            <!-- <div class="col-lg-1 col-md-1 col-sm-1 col-xs-1 text-center"></div> -->

            <div class="col-lg-5 col-md-5 col-sm-5 col-xs-12 nw-user-detail">

                <a href="javascript:void(0);" class="readmore">

                  <h1 class="nw-user-nm" style="width:65% !important;">{{ @$sportsList[$UserBookingDetail['sport']] }}</h1>

              </a>

              <div class="nw-user-edit">                  

                  <div class="clearfix"></div>

                  <h4><span>Booking Status:</span>

                      @if($data['jobsObj']['business_id'] != null && $data['jobsObj']['status'] == "requested")

                        <span>

                            <font style="color:#84a04a;font-weight: 600;">Awarded</font>

                        </span>

                      @elseif($data['jobsObj']['business_id'] == null && $data['jobsObj']['status'] == "requested")

                        <span>

                            <font style="color:#337ab7;;font-weight: 600;">Open to All</font>

                        </span>

                      @elseif($data['jobsObj']['status'] == "rejected")

                        <span>

                            <font style="color:#f53b49;font-weight: 600;">Rejected</font>

                        </span>

                        <br>

                        <span>Rejected Reason: </span>

                        <span>{{ $data['jobsObj']['rejected_reason'] }}</span>

                      @elseif($data['jobsObj']['status'] == "confirmed")

                        <span>

                            <font style="color:#84a04a;font-weight: 600;">Booked</font>

                        </span>

                      @endif 

                    </h4>

                  <div class="clearfix"></div>

              </div>              

            </div>

            <div class="col-lg-7 col-md-7 col-sm-7 col-xs-12 nw-user-detail" style="padding-bottom:10px;float: right;">



                {!! Form::open(array('id' => 'frmBookingDetail')) !!}

            <input type="hidden" name="_token" id="token" value="{{csrf_token()}}">

            <input type="hidden" name="booking_id" value="{{ $data['jobsObj']['id'] }}">

            @if($data['jobsObj']['status'] == "requested" && $data['jobsObj']['business_id'] == Auth::user()->id)

              <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 nw-user-detail">

                    <button type="button" class="nw-view-profile" id="confirm_booking">Confirm Request</button>

              </div>

              <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 nw-user-detail">

                    <button type="button" class="nw-view-profile" data-toggle="modal" data-target="#rejectBookingRequestModal" style="background-color:#3e4148 !important;">Reject Request</button>

              </div>

            @endif

            @if($data['jobsObj']['status'] == "confirmed")

            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 nw-user-detail" style="float: right;">

              </div>

            @endif

        {!! Form::close() !!}

            </div>

        </div>

        <!--<div class="nw-user-detail-line"></div>-->

    </div>

    <div class="clearfix"></div>

     @if(!empty($userQuote))

     <div class="social-connect noborder">

        <div class="row">

            <div class="quotetitle">YOUR QUOTE</div>

            <div class="nw-dtl-edit"><div id='systemMessage_booking'></div></div>

            <div class="nw-user-detail-block">

                

                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 nw-user-detail" id="quote_detail_div">

                    <div class="form-control">

                        <div class="col-lg-2 col-md-2 col-sm-12 col-xs-12">

                            <label>Quote Price</label>

                        </div>

                        <div class="col-lg-2 col-md-2 col-sm-12 col-xs-12">

                            <label id="quote_price_val">{{$userQuote['quote_price']}}</label>

                        </div>

                    </div>

                    <div class="form-control">

                        <div class="col-lg-2 col-md-2 col-sm-12 col-xs-12">

                            <label>Rate Type</label>

                        </div>

                        <div class="col-lg-2 col-md-2 col-sm-12 col-xs-12">

                            <label id="quote_price_val">{{$userQuote['rate_type']}}</label>

                        </div>

                    </div>

                    <div class="form-control">

                        <div class="col-lg-2 col-md-2 col-sm-12 col-xs-12">

                            <label>Quotes</label>

                        </div>

                        <div class="col-lg-10 col-md-1 col-sm-12 col-xs-12">

                            <p id="quote_desc_val">

                                <?php

                                $quote = str_replace(PHP_EOL,"<br>",$userQuote['quote']);

                                echo $quote;

                                ?>

                            </p>

                        </div>

                    </div>

                    <div class="form-control"></div>

                </div>

            </div>

        </div>

    </div>

    @endif

    

    <div class="row">

    <div class="quotetitle notopmargin">LESSON DETAILS</div>

        @if($data['jobsObj']['booking_type'] == "direct")       

            <div class="nw-user-detail-block">

              <div class="col-lg-1 col-md-1 col-sm-1 col-xs-1 text-center"></div>

              <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12 nw-user-detail">

                <div class="nw-user-edit">

                    <div class="nw-dtl-edit">

                        <p>

                          <?php 

                          $detail = json_decode($UserBookingDetail['booking_detail'], true);

                          
                        // activitytype":"personal_training","numberofpersons":"2","activitylocation":"studio","whoistraining":"me"

                          ?>
                        </p>
                        <p>Activity type : {{$detail['activitytype']}} </p>
                        <p>Number of Persons : {{$detail['numberofpersons']}} </p>
                        <p>Activity location : {{$detail['activitylocation']}} </p>
                        <p>Who is training : {{$detail['whoistraining']}} </p>

                        <p>

                                Sport Price: {{ $UserBookingDetail['price'] }}

                              </p>

                              <p> 

                                Schedule<br>

                                <div id="businessHoursWidget"></div>

                              </p>

                    </div>

                    <div class="clearfix"></div>

                </div>

              </div>

          </div>



          <div class="nw-user-detail-line"></div>



          @else

            <?php $jobpostquestions = $data['jobsObj']['jobpostquestions']; ?>

            @if(count($jobpostquestions) > 0)              

              @foreach($jobpostquestions as $k => $job)

                <div class="nw-user-detail-sumry">

                  <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 nw-user-sumry">

                    <h1>{{$job['question']}}</h1>

                    <!-- <a href="#" class="pull-right"><i class="fa fa-pencil"></i></a> -->

                    <!-- <div class="clearfix"></div> -->

                    <span class="timenplace border-rgt">

                    </span>

                    <!-- <span class="timenplace"></span> -->

                    <div class="clearfix"></div>

                    <!-- <p>Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat, vel illum dolore eu feugiat nulla facilisis at vero eros et accumsan et iusto odio dignissim qui blandit praesent luptatum zzril delenit augue duis dolore te feugait nulla facilisi. Nam liber tempor cum soluta nobis eleifend option congue nihil imperdiet doming id quod mazim placerat facer possim assum. Typi non habent claritatem insitam; est usus legentis in iis qui facit eorum claritatem. </p> -->

                    <p>

                      @if($job['full_answer'] == '')

                        {{$job['answer']}}

                      @else

                        {{$job['full_answer']}}

                      @endif

                    </p>

                    <p>{{$job['other']}}</p>

                    <div class="clearfix"></div>

                    <div class="nw-user-detail-line full-width"></div>

                  </div>

                </div>

              @endforeach

            @endif

          @endif

      </div>



    <div class="social-connect noborder">

      <div class="row">        

        <div class="nw-user-detail-block">

          <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 text-center">

            <div class="nw-user-img">

              <?php              

              if($userDetail['profile_pic'] != '' && file_exists(public_path().DIRECTORY_SEPARATOR.'uploads'.DIRECTORY_SEPARATOR.'profile_pic'.DIRECTORY_SEPARATOR.'thumb'.DIRECTORY_SEPARATOR.$userDetail['profile_pic'])) {

                echo '<img src="'.Config::get('constants.USER_IMAGE_THUMB').$userDetail['profile_pic'].'" width="254" height="275" id="display_user_profile_pic" />';

              }

              else {

                echo '<img src="'.Config::get('constants.FRONT_IMAGE').'user.png" width="254" height="275" id="display_user_profile_pic" />';

              }

              ?>

            </div>

            <?php 

            // echo '<pre>';print_r($followdetail['follows']); die();

              if(isset($followdetail['follows']) && count($followdetail['follows']) > 0 ){ ?>

                <button class="btn common-btn follow" id="{{ $followdetail['follows'][0]['follower_id'] }}">Unfollow</button>

            <?php } else { ?>

                <button class="btn common-btn follow" id="{{ $followdetail['id'] }}">Follow</button>  

            <?php } ?>

            <span id="userFavourite_{{$followdetail['id']}}" style="padding-left: 25px;">

                @if(isset($followdetail['favourites']) && count($followdetail['favourites']) > 0 )

                <a onclick="favourite({{ $followdetail['id'] }},'unfavourite');" class="removefavourite_{{$followdetail['id']}}" ><i class="fa fa-star fav-star"></i></a>

                @else

                &nbsp;<a onclick="favourite({{ $followdetail['id'] }},'favourite');" class="makefavourite_{{$followdetail['id']}}"><i class="fa fa-star-o unfav-star" style="font-size: 28px;padding-top: 8px;"></i></a>

                @endif

            </span>  

            <!-- <button class="btn common-btn">Favorites</button> -->

            <div id="follow-msg">Error</div>

          </div>

          <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12 nw-user-detail">

            <h1 class="nw-user-nm" style="width:65% !important;">{{ $userDetail['firstname']." ".$userDetail['lastname'] }}</h1>

            <div class="nw-dtl-edit"><div id='systemMessage_booking'></div></div>

            <!-- <p>Lobortis nisl ut aliquip ex ea commodo  Duis autem vel eum iriure 

              dolor in hendrerit in vulputate velit esse molestie consequat </p> -->

            <div class="nw-user-edit">

              <a href="javascript:void();" style="float: right" data-toggle="modal" data-target="#editProfileDetailModal">

              </a>

              <div class="nw-dtl-edit">

                <span class="nw-label">Company Name:</span>

                <span id="display_user_company">{{ $userDetail['company_name'] }}</span>

              </div>

              <div class="nw-dtl-edit">

                <span class="nw-label">Name:</span>

                <span id="display_user_name">{{ $userDetail['firstname'] }} {{ $userDetail['lastname']}}</span>

              </div>

              <div class="nw-dtl-edit">

                <span class="nw-label">Email : </span><span>{{ $userDetail['email'] }}</span>

              </div>

              <div class="nw-dtl-edit">

                <span class="nw-label" id="display_user_phone">Phone : </span><span>{{ $userDetail['phone_number'] }}</span>

              </div>

              <div class="nw-dtl-edit">

                <span class="nw-label">Address :  </span>

                <span class="nw-detail-txt" id="display_user_address">

                  {{ $userDetail['address'] }}

                  <div class="clearfix"></div>

                  <a href="#"><i class="fa fa-phone"></i></a><a href="#"><i class="fa fa-map-marker"></i></a><a href="#"><i class="fa fa-envelope"></i></a>

                </span>

              </div>

              <div class="nw-dtl-edit">

                <span class="nw-label" id="display_user_phone">About : </span><span> @if(isset($userDetail['about_me'])) {!! nl2br(@$userDetail['about_me']) !!} @else - @endif</span>

              </div>

            </div>

          </div>

          <div class="nw-user-detail-line"></div>

        </div>

      </div>

      <div class="clearfix"></div>

    </div>    



      



    </div>

  </div>

  @include('includes.sidebar_profile_right')

</div>

<!-- </div> -->

<!-- </section> -->



<!-- Modal -->

  

                <div class="modal fade" id="rejectBookingRequestModal" role="dialog">

                  <div class="modal-dialog modal-lg">

                    <!-- Modal content-->

                    <div class="modal-content">



                      {!! Form::open(array('id' => 'frmRejectBookingRequest')) !!}

                      <input type="hidden" name="_token" id="token" value="{{csrf_token()}}">

                      <input type="hidden" name="booking_id" value="{{ $data['jobsObj']['id'] }}">



                      <div class="modal-body login-pad">

                        <div class="pop-title employe-title">

                          <h3>Reject Request</h3>

                        </div>

                        <button type="button" class="close modal-close" data-dismiss="modal">

                          <img src="<?php echo Config::get('constants.FRONT_IMAGE'); ?>close.jpg" height="70" width="34"/>

                        </button>



                        <div class="signup">

                          <div id='systemMessage_bookingreject'></div>

                          <div class="emplouyee-form">

                            <textarea name="reject_reason" id="frm_reject_reason" placeholder="Why you want to reject this booking request ?"></textarea>

                            <button type="submit" class="btn btn-primary" id="save_reject">Submit</button>

                          </div>

                        </div>

                      </div>

                      {!! Form::close() !!}

                    </div>                  

                  </div>

                </div>

  <!-- Modal -->

@include('includes.followers_script')

<script>

$(document).ready(function(){



  $(".modal").on("hidden.bs.modal", function(){

      $("#frm_reject_reason").val('');

      $("#systemMessage_bookingreject").html(''); 

  });



  $('#confirm_booking').click(function() {

      $('#frmBookingDetail').submit();

  });



  $('#frmBookingDetail').submit(function(e) {

    e.preventDefault();

    if(!confirm('Are you sure you want to confirm this request ?')) {

        return false;

    }

    var formData = $("#frmBookingDetail").serialize();

        $.ajax({

              url:'/booking/confirmBooking',

              type:'POST',

              dataType: 'json',

              data:formData,

              beforeSend: function () {

                $('#confirm_booking').attr('disabled', true);

                // $("#frmBookingDetail").css('opacity', '0.5');

                showSystemMessages('#systemMessage_booking', 'info', 'Please wait while we save your request.');

              },

              complete: function () {

                $('#confirm_booking').attr('disabled', false);

                // $("#frmBookingDetail").css('opacity', '1');

              },

              success: function (response) {

                    showSystemMessages('#systemMessage_booking', response.type, response.msg);

                    if(response.type == "success") {

                      $('#submit_bookingdetail').prop('disabled', true);

                      setTimeout(

                        function() 

                        {

                          location.reload();

                        }, 1000);

                    }else {

                      $('#submit_bookingdetail').prop('disabled', false);

                    }

              }

        });

  });



  $('#frmRejectBookingRequest').submit(function(e) {

      e.preventDefault();

      if($("#frm_reject_reason").val() == "") {

        showSystemMessages('#systemMessage_bookingreject', 'danger', 'Please provide reason');

        return false;

      }

      if(!confirm('Are you sure you want to Reject this request ?')) {

        $("#rejectBookingRequestModal").modal('hide');

        $("#frm_reject_reason").val('');

        $("#systemMessage_bookingreject").html('');

        return false;

      }



      var formData = $("#frmRejectBookingRequest").serialize();

        $.ajax({

              url:'/booking/rejectBooking',

              type:'POST',

              dataType: 'json',

              data:formData,

              beforeSend: function () {

                $('#save_reject').attr('disabled', true);

                showSystemMessages('#systemMessage_bookingreject', 'info', 'Please wait while we save your request.');

              },

              complete: function () {

                $('#save_reject').attr('disabled', false);

              },

              success: function (response) {

                    showSystemMessages('#systemMessage_bookingreject', response.type, response.msg);

                    if(response.type == "success") {

                      $('#submit_rejectbookingdetail').prop('disabled', true);   

                      setTimeout(

                        function() 

                        {

                          location.reload();

                        }, 1000);

                    }else {

                      $('#submit_rejectbookingdetail').prop('disabled', false);

                    }

              }

        });      

  });

});

</script>

@if($data['jobsObj']['booking_type'] == "direct" && isset($UserBookingDetail['schedule']))

    <link href="{{url('/public/css/scheduleHours/jquery.businessHours.css')}}" rel="stylesheet">

    <script src="{{url('/public/css/scheduleHours/jquery.businessHours.js')}}"></script>



    <script>



      jQuery("#businessHoursWidget").businessHours(

      {

        operationTime: {!! $UserBookingDetail['schedule'] !!}

      });

      jQuery('.operationTimeFrom, .operationTimeTill').attr("readonly", "readonly");

    </script>

  @endif

@endsection

