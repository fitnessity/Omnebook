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
    
    <div class="business-middle">
        <!--<a href="javascript:void(0);" onclick="window.history.back(-1);" class="backlink">GO BACK</a>-->
    <div class="network_block nw-profile_block">
    <?php 
    $userDetail = $data['jobsObj']['user'];
    $UserBookingDetail = $data['jobsObj']['user_booking_detail'];
    $businessuser = $data['jobsObj']['businessuser'];
    ?>
    @if($data['jobsObj']['booking_type'] == 'direct')
    <div class="row">
        <!-- <div class="quotetitle notopmargin">LESSON DETAILS</div> -->
        <div class="nw-user-detail-block">
            <div class="col-lg-1 col-md-1 col-sm-1 col-xs-1 text-center"></div>
            <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12 nw-user-detail">
                <a href="javascript:void(0);" class="readmore">
                  <h1 class="nw-user-nm" style="width:65% !important;">{{ @$sportsList[$UserBookingDetail['sport']] }}</h1>
                </a>
              <div class="nw-user-edit">
                  <div class="nw-dtl-edit">
                      <p>
                        <?php 
                        $detail = substr(str_replace(PHP_EOL,"<br>",$UserBookingDetail['booking_detail']), 0, 500);
                        echo $detail;
                        ?>
                      </p>
                      <p>
                              Sport Price: {{ $UserBookingDetail['price'] }}
                            </p>
                            <p> 
                              Schedule<br>
                              <div id="businessHoursWidget"></div>
                            </p>
                  </div>
                  <div class="clearfix"></div>
                  <span>Booking Status: </span>
                  
                      @if($data['jobsObj']['status'] == "requested" && $data['jobsObj']['business_id'] != null)
                        <span class="booking-pending-text">Confirmation Pending</span>
                      @elseif($data['jobsObj']['status'] == "requested" && $data['jobsObj']['business_id'] == null)
                        <span class="boking-openall-text"> Open to All </span>
                      @elseif($data['jobsObj']['status'] == "rejected")
                        <span class="booking-rejected-text"> Rejected </span>
                        <br>
                        <span>Rejected Reason: </span>
                        <div class="topmargin10 leftmargin40">
                          <p><?php echo nl2br($data['jobsObj']['rejected_reason']);?></p>
                        </div>
                      @elseif($data['jobsObj']['status'] == "confirmed")
                        <span class="booking-booked-text">Booked</span>
                      @endif                  
                  <div class="clearfix"></div>
              </div>
            </div>
        </div>
        <div class="nw-user-detail-line"></div>
    </div>
    <div class="clearfix"></div>
    <br><br>
    <div class="row">
        <div class="nw-user-detail-block">
          <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 text-center">
            <div class="nw-user-img">
              <?php              
              if($businessuser['profile_pic'] != '' && file_exists(public_path().DIRECTORY_SEPARATOR.'uploads'.DIRECTORY_SEPARATOR.'profile_pic'.DIRECTORY_SEPARATOR.'thumb'.DIRECTORY_SEPARATOR.$businessuser['profile_pic'])) {
                echo '<img src="'.Config::get('constants.USER_IMAGE_THUMB').$businessuser['profile_pic'].'" width="254" height="275" id="display_user_profile_pic" />';
              }
              else {
                echo '<img src="'.Config::get('constants.FRONT_IMAGE').'user.png" width="254" height="275" id="display_user_profile_pic" />';
              }
              ?>
            </div>
          </div>
          <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12 nw-user-detail">
            <h1 class="nw-user-nm" style="width:65% !important;">{{ $businessuser['firstname']." ".$businessuser['lastname'] }}</h1>

            <!-- <p>Lobortis nisl ut aliquip ex ea commodo  Duis autem vel eum iriure 
              dolor in hendrerit in vulputate velit esse molestie consequat </p> -->
            <div class="nw-user-edit">
              <a href="javascript:void(0);" style="float: right" data-toggle="modal" data-target="#editProfileDetailModal">
              </a>
              <div class="nw-dtl-edit">
                <span class="nw-label">Company Name:</span>
                <span id="display_user_company">{{ $businessuser['company_name'] }}</span>
              </div>
              <div class="nw-dtl-edit">
                <span class="nw-label">Name:</span>
                <span id="display_user_name">{{ $businessuser['firstname'] }} {{ $businessuser['lastname']}}</span>
              </div>
              <div class="nw-dtl-edit">
                <span class="nw-label">Email : </span><span>{{ $businessuser['email'] }}</span>
              </div>
              <div class="nw-dtl-edit">
                <span class="nw-label" id="display_user_phone">Phone : </span><span>{{ $businessuser['phone_number'] }}</span>
              </div>
              <div class="nw-dtl-edit">
                <span class="nw-label">Address :  </span>
                <span class="nw-detail-txt" id="display_user_address">
                  {{ $businessuser['address'] }}
                  <div class="clearfix"></div>
                  <a href="#"><i class="fa fa-phone"></i></a><a href="#"><i class="fa fa-map-marker"></i></a><a href="#"><i class="fa fa-envelope"></i></a>
                </span>
              </div>
              <div class="nw-dtl-edit">
                <span class="nw-label" id="display_user_phone">About : </span><span> @if(isset($businessuser['about_me'])) {!! nl2br(@$businessuser['about_me']) !!} @else - @endif</span>
              </div>
              <div class="nw-dtl-edit">
                <span class="nw-label" id="display_user_phone">About Business : </span><span> @if(isset($businessuser['about_business'])) {!! nl2br(@$businessuser['about_business']) !!} @else - @endif</span>
              </div>
            </div>
          </div>
          <div class="nw-user-detail-line"></div>
        </div>
      </div>
      <div class="clearfix"></div>
    
      @else
      
      <div class="row">
        <!-- <div class="quotetitle notopmargin">LESSON DETAILS</div> -->
        <div class="nw-user-detail-block">
            <div class="col-lg-1 col-md-1 col-sm-1 col-xs-1 text-center"></div>
            <div class="col-lg-11 col-md-11 col-sm-11 col-xs-12 nw-user-detail">
                <a href="javascript:void(0);" class="readmore">
                  <h1 class="nw-user-nm" style="width:77% !important;">{{ @$sportsList[$UserBookingDetail['sport']] }}</h1>
              </a>
              <div class="nw-user-edit">                  
                  <div class="clearfix"></div>
                  <h4><span>Booking Status: </span>
                      @if($data['jobsObj']['business_id'] != null && $data['jobsObj']['status'] == "requested")
                        <span class="booking-booked-text">Awarded</span>
                      @elseif($data['jobsObj']['business_id'] == null && $data['jobsObj']['status'] == "requested")
                        <span class="booking-openall-text">Open to All</span>
                      @elseif($data['jobsObj']['status'] == "rejected")
                        <span class="booking-rejected-text">Rejected</span>
                        <br>
                        <span>Rejected Reason: </span>
                        <div class="topmargin10 leftmargin40">
                          <p><?php echo nl2br($data['jobsObj']['rejected_reason']); ?></p>
                        </div>
                      @elseif($data['jobsObj']['status'] == "confirmed")
                        <span class="booking-booked-text">Booked</span>
                      @endif 
                    </h4>
                  <div class="clearfix"></div>
              </div>
            </div>
        </div>
        <!--<div class="nw-user-detail-line"></div>-->
        
    </div>


    <div class="clearfix"></div>

    <div class="row"><br />
    <div class="review-list-block noborder">
          <?php $jobpostquestions = $data['jobsObj']['jobpostquestions']; ?>
            @if(count($jobpostquestions) > 0)              
              @foreach($jobpostquestions as $k => $job)
                <div class="nw-user-detail-sumry">
                  <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 nw-user-sumry">
                      <h1>{{$job['question']}}</h1>
                      <span class="timenplace border-rgt"></span>
                      <div class="clearfix"></div>
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
        </div>
    </div>
    
      <?php
      $bookingQuote = $data['jobsObj']['bookingQuotes'];
      $awardedQuote = $data['jobsObj']['awardedQuote'];
      ?>
      @if(count($bookingQuote)>0)
        <!-- show awarded quote if any -->
        @if(count($awardedQuote) > 0)
        <div class="awardquotetitle">AWARDED QUOTE</div>
        <div class="review-list-block noborder">
            <div class="row">
                <div class="col-lg-2 col-md-2 col-sm-8 col-xs-12">
                    <span class="review-user">
                    <?php
                    if($awardedQuote['BookingQuoteUser']['profile_pic'] != '' && file_exists(public_path().DIRECTORY_SEPARATOR.'uploads'.DIRECTORY_SEPARATOR.'profile_pic'.DIRECTORY_SEPARATOR.'thumb150'.DIRECTORY_SEPARATOR.$awardedQuote['BookingQuoteUser']['profile_pic'])) {
                        echo '<img src="'.Config::get('constants.USER_IMAGE_THUMB150').$awardedQuote['BookingQuoteUser']['profile_pic'].'" width="66" height="72" />';
                    }
                    else {
                        echo '<img src="'.Config::get('constants.FRONT_IMAGE').'user.png" width="66" height="72" />';
                    }
                    ?>
                  </span>
                </div>
                <div class="col-lg-10 col-md-10 col-sm-8 col-xs-12">
                    <div class="review-detail job-list-div">
                        <a data-toggle="modal" data-target="#professionaldetail_modal" href="/viewbusinessprofile/{{ $awardedQuote['BookingQuoteUser']['id'] }}" title="Click here to view more" class="readmore">
                            <h1>{{ $awardedQuote['BookingQuoteUser']['firstname'] }} {{ $awardedQuote['BookingQuoteUser']['lastname'] }}</h1>
                        </a>
                        @if($data['jobsObj']['status'] == "requested" && $data['jobsObj']['business_id'] == null)
                            <a href="javascript:void(0);" class="bookprofessionaloption" style="float:right;" data-business-id="{{ $awardedQuote['BookingQuoteUser']['id'] }}" onclick="bookprofessional({{ $awardedQuote['BookingQuoteUser']['id'] }});">
                                <font style="color:#f53b49;font-size: 16px;font-weight: 600;text-decoration:underline;">BOOK THIS PROFESSIONAL</font>
                            </a>
                        @endif
                        <br>
                        <a data-toggle="modal" data-target="#professionaldetail_modal" href="/viewbusinessprofile/{{ $awardedQuote['BookingQuoteUser']['id'] }}" title="Click here to view Profile" class="readmore" style="font-size:13px;">
                        (View Profile)
                        </a>
                        @if($data['jobsObj']['status'] == "requested" && $data['jobsObj']['business_id'] == $awardedQuote['BookingQuoteUser']['id'])
                            <a href="javascript:void(0);" class="bookprofessionaloption" style="float:right;">
                                <font style="color:#ffb300;font-size: 16px;font-weight: 600;text-decoration:underline;">CONFIRMATION PENDING</font>
                            </a>
                        @endif
                        <div class="nw-dtl-edit"><div id='systemMessage_booking'></div></div>
                        <div class="clearfix"></div>
                        <br>
                        <p>Price: {{ $awardedQuote['quote_price'] }}</p>
                        <br>
                        <p>Rate Type: {{ ucfirst($awardedQuote['rate_type']) }}</p>
                        <br>
                          <p> 
                            <?php 
                            $quote_desc = str_replace(PHP_EOL,"<br>",$awardedQuote['quote']);
                            echo $quote_desc;
                            ?>
                        </p>
                      </div>
                      <div class="job_post_dtls">                        
                        <a href="#" style="cursor:default;"><i class="fa fa-calendar"></i>
                          {{ date("m/d/Y", strtotime($awardedQuote['created_at'])) }}
                        </a>
                      </div>                      
                   </div>
              </div>
           </div>
        @endif     
      
        <input type="hidden" name="_token" id="token" value="{{csrf_token()}}">
        <input type="hidden" name="booking_id" id="booking_id" value="{{ $data['jobsObj']['id'] }}">
        <div class="quotetitle">PROFESSIONAL'S QUOTES</div>
        @foreach($bookingQuote as $quote)        
            <div class="review-list-block">
            <div class="row">
                <div class="col-lg-2 col-md-2 col-sm-8 col-xs-12">
                    <span class="review-user">
                    <?php
                    if($quote['BookingQuoteUser']['profile_pic'] != '' && file_exists(public_path().DIRECTORY_SEPARATOR.'uploads'.DIRECTORY_SEPARATOR.'profile_pic'.DIRECTORY_SEPARATOR.'thumb150'.DIRECTORY_SEPARATOR.$quote['BookingQuoteUser']['profile_pic'])) {
                        echo '<img src="'.Config::get('constants.USER_IMAGE_THUMB150').$quote['BookingQuoteUser']['profile_pic'].'" width="66" height="72" />';
                    }
                    else {
                        echo '<img src="'.Config::get('constants.FRONT_IMAGE').'user.png" width="66" height="72" />';
                    }
                    ?>
                  </span>
                </div>
                <div class="col-lg-10 col-md-10 col-sm-8 col-xs-12">
                    <div class="review-detail job-list-div">
                        <a data-toggle="modal" data-target="#professionaldetail_modal" href="/viewbusinessprofile/{{ $quote['BookingQuoteUser']['id'] }}" title="Click here to view Profile" class="readmore">
                            <h1>{{ $quote['BookingQuoteUser']['firstname'] }} {{ $quote['BookingQuoteUser']['lastname'] }}</h1>
                        </a>

                        @if($data['jobsObj']['status'] == "requested" && $data['jobsObj']['business_id'] == null)
                            <a href="javascript:void(0);" class="bookprofessionaloption" style="float:right;" data-business-id="{{ $quote['BookingQuoteUser']['id'] }}" onclick="bookprofessional({{ $quote['BookingQuoteUser']['id'] }});">
                                <font style="color:#f53b49;font-size: 16px;font-weight: 600;text-decoration:underline;">BOOK THIS PROFESSIONAL</font>
                            </a>
                        @endif
                        <br>
                        <a data-toggle="modal" data-target="#professionaldetail_modal" href="/viewbusinessprofile/{{ $quote['BookingQuoteUser']['id'] }}" title="Click here to view Profile" class="readmore" style="font-size:13px;">
                        (View Profile)
                        </a>
                        <div class="nw-dtl-edit"><div id='systemMessage_booking'></div></div>
                        <div class="clearfix"></div>
                        <br>
                        <p>Price: {{ $quote['quote_price'] }}</p>
                        <br>
                        <p>Rate Type: {{ ucfirst($quote['rate_type']) }}</p>
                        
                        <br>
                          <p> 
                            <?php 
                            $quote_desc = str_replace(PHP_EOL,"<br>",$quote['quote']);
                            echo $quote_desc;
                            ?>
                        </p>
                      </div>
                      <div class="job_post_dtls">                        
                        <a href="#" style="cursor:default;"><i class="fa fa-calendar"></i>
                          {{ date("m/d/Y", strtotime($quote['created_at'])) }}
                        </a>
                      </div>                      
                   </div>
              </div>
           </div>
        @endforeach
        <div class="pagination_last">
            {!! $data['jobsObj']['bookingQuotes']->render() !!}
        </div>
      @else
      <div class="quotetitle">PROFESSIONAL'S QUOTES</div>
      <div class="review-list-block">
        <div class="row">
            <div class="col-lg-11 col-md-11 col-sm-9 col-xs-12">
                No Quotes Yet
            <div class="clearfix"></div>
            </div>
        </div>
      </div>
      @endif

      @endif
    </div>
  </div>
  @include('includes.sidebar_profile_right')
</div>
<!-- </div> -->
<!-- </section> -->

<!-- professional detail modal -->
<div class="modal fade" id="professionaldetail_modal" role="dialog">
  <div class="modal-dialog modal-lg">
        <div  id="professionaldetail_modal_content"></div>
        <div class="modal-body login-pad">
            <div class="pop-title employe-title">
                <h3>Profile</h3>
            </div>
            <button type="button" class="close modal-close" data-dismiss="modal">
                <img src="<?php echo Config::get('constants.FRONT_IMAGE'); ?>close.jpg" height="70" width="34"/>
            </button>
            <div class="modal-content signup">                
            </div>
        </div>
  </div>
</div>
<script>
    function bookprofessional(business_id)
    {
        if(confirm('Are you sure you want to book this professional ?')) {
            $.ajax({
              url:'/book-professional',
              type:'POST',
              dataType: 'json',
              data:'booking_id='+$("#booking_id").val() + '&business_id='+business_id + "&_token="+$("#token").val(),
              beforeSend: function () {
                 showSystemMessages('#systemMessage_booking', 'info', 'Please wait while we save your request.');
              },
              complete: function () {
              },
              success: function (response) {
                    showSystemMessages('#systemMessage_booking', response.type, response.msg);
                    if(response.type == "success") {
                        $(".bookprofessionaloption").hide();
                       setTimeout(
                           function() 
                           {
                             location.reload();
                           }, 1000);
                    }                   
              }
            });
        }
    }
</script>
@if($data['jobsObj']['booking_type'] == "direct" && isset($UserBookingDetail['schedule']))
    <link href="<?php echo Config::get('constants.FRONT_CSS'); ?>scheduleHours/jquery.businessHours.css" rel="stylesheet">
    <script src="<?php echo Config::get('constants.FRONT_JS'); ?>scheduleHours/jquery.businessHours.js"></script>

    <script>

      jQuery("#businessHoursWidget").businessHours(
      {
        operationTime: {!! $UserBookingDetail['schedule'] !!}
      });
    </script>
  @endif
<script type="text/javascript">
jQuery('.operationTimeFrom, .operationTimeTill').attr("readonly", "readonly");
/*var timeFrom = jQuery(".operationTimeFrom");

for(var i = 0; i< timeFrom.length; i++)
{
  if(timeFrom[i])
  {
    var date_obj = new Date("<?php //echo date('m-d-Y');?> " + timeFrom[i].value );
    var hours = date_obj.getHours();
    var morn_or_night;
      
      if (hours === 0) 
      {
          hours = 12;
          morn_or_night = 'AM';
      
      } else if (hours === 12) 
      {
          morn_or_night = 'PM'
      } else if (hours > 12) 
      {
          hours = hours - 12;
          morn_or_night = 'PM';
      } else 
      {
          morn_or_night = 'AM';
      }

      var finalValue = hours.toString()+':'+date_obj.getMinutes()+' '+morn_or_night;

      if(date_obj.getMinutes() == 0 )
      {
        var finalValue = hours.toString()+':'+date_obj.getMinutes()+'0 '+morn_or_night;        
      }
   
      timeFrom[i].value = finalValue;
  }
}

var timeTo = jQuery(".operationTimeTill");

for(var i = 0; i< timeTo.length; i++)
{
  if(timeTo[i])
  {
    var date_obj = new Date("<?php //echo date('m-d-Y');?> " + timeTo[i].value );
    var hours = date_obj.getHours();
    var morn_or_night;
      
      if (hours === 0) 
      {
          hours = 12;
          morn_or_night = 'AM';
      
      } else if (hours === 12) 
      {
          morn_or_night = 'PM'
      } else if (hours > 12) 
      {
          hours = hours - 12;
          morn_or_night = 'PM';
      } else 
      {
          morn_or_night = 'AM';
      }

       var finalValue = hours.toString()+':'+date_obj.getMinutes()+' '+morn_or_night;

      if(date_obj.getMinutes() == 0 )
      {
        var finalValue = hours.toString()+':'+date_obj.getMinutes()+'0 '+morn_or_night;        
      }
      timeTo[i].value = finalValue;
  }
}*/
</script>
@endsection