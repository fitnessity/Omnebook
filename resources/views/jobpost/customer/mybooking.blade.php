@extends('layouts.profile')

@section('content')

<?php $loggedinUser = Auth::user(); ?>
@include('includes.booking_tab_menu')
<style>
.colorBox.RestDayState {
  display: none;
}
.operationTime .mini-time {
  width: 60px !important;
}
</style>


<div class="business-offer-main profile-sec">

    <?php 

       $loggedinUser = Auth::user(); 

       $customerName = $loggedinUser->firstname.' '.$loggedinUser->lastname;

       $profilePicture = $loggedinUser->profile_pic;

    ?>



    @include('includes.sidebar_profile_left',array ('customerName' => $customerName,'profilePicture' => $profilePicture))
    
      <div class="business-middle">
           <div class="network_block nw-profile_block">
    <div class="row">
      <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
         
        <div class=" review-dtl-block">
        @if(count($jobpostobj)>0)
        <link href="<?php echo Config::get('constants.FRONT_CSS'); ?>scheduleHours/jquery.businessHours.css" rel="stylesheet">
  <script src="<?php echo Config::get('constants.FRONT_JS'); ?>scheduleHours/jquery.businessHours.js"></script>

          @foreach( $jobpostobj as $job )
           <div class="review-list-block">
            <div class="row">
                <div class="col-lg-2 col-md-2 col-sm-8 col-xs-12">
                    <span class="review-user">
                    <?php
                    if($loggedinUser['profile_pic'] != '' && file_exists(public_path().DIRECTORY_SEPARATOR.'uploads'.DIRECTORY_SEPARATOR.'profile_pic'.DIRECTORY_SEPARATOR.'thumb150'.DIRECTORY_SEPARATOR.$loggedinUser['profile_pic'])) {
                        echo '<img src="'.Config::get('constants.USER_IMAGE_THUMB150').$loggedinUser['profile_pic'].'" width="66" height="72" />';
                    }
                    else {
                        echo '<img src="'.Config::get('constants.FRONT_IMAGE').'user.png" width="66" height="72" />';
                    }
                    ?>
                  </span>
                </div>
                <div class="col-lg-10 col-md-10 col-sm-8 col-xs-12">
                    <div class="review-detail job-list-div">
                        <a href="/viewBooking/{{ $job->id }}" title="Click here to view more" class="readmore">
                            <h1>{{ isset($job->UserBookingDetail->sport) ? @$sportsList[$job->UserBookingDetail->sport] : '' }}</h1>
                        </a>
                            <h5>
                              @if($job['status'] == "confirmed")
                                <span class="booking-booked-text">(Booked)</span>
                              @elseif($job['business_id'] != null && $job['status'] == "requested")
                                <span class="booking-pending-text">(Confirmation Pending)</span>
                              @elseif($job['business_id'] == null && $job['status'] == "requested")
                                <span class="boking-openall-text">(Open to All)</span>
                              @elseif($job['status'] == "rejected")
                                <span class="booking-rejected-text">(Rejected)</span>
                              @endif
                            </h5>
                          <div class="review-rate-block">
                              <!-- <a href="#">{{ $job->sports }}</a> -->
                              <span>
                              <a>{{ $job['businessuser']['firstname'] }} {{ $job['businessuser']['lastname'] }}</a>
                              <br><a href="/viewBooking/{{ $job->id }}" class="readmore">View Detail</a>
                              </span>
                          </div>
                          <!-- <p>description here</p> -->
                          <div class="clearfix"></div>
                          @if($job['booking_type'] == "direct")
                            <p> <?php 
                                if(isset($job->UserBookingDetail->booking_detail))
                                {
                                  $detail = substr(str_replace(PHP_EOL,"<br>",$job->UserBookingDetail->booking_detail), 0, 500);
                                  $detail2 = json_decode($detail);
                                 // echo $detail;
                                  echo "<b>Activity Type:</b> ".str_replace("_"," ",$detail2->activitytype);
                                  echo "<br><b>Number of Persons:</b> ".$detail2->numberofpersons;
                                  echo "<br><b>Activity Location:</b> ". str_replace("_"," ",$detail2->activitylocation);
                                  echo "<br><b>Who is Training:</b> ".implode(',',$detail2->whoistraining);
                                 // echo gettype(json_decode($detail));
                                }
                                ?>
                            </p>
                            <p>
                              @if(isset($job->UserBookingDetail->price))
                                Sport Price: {{ $job->UserBookingDetail->price }}
                              @endif
                            </p>
                            <p> 
                              <strong>Schedule</strong><br>
                              <div id="businessHoursWidget-{{ $job->id }}"></div>
                            </p>

                          @endif
                      </div>
                      <div class="job_post_dtls">                        
                        <span style="cursor:default;">
                          <i class="fa fa-calendar"></i>
                          {{ date("m/d/Y", strtotime($job['created_at'])) }}
                        </span>
                        @if($job['booking_type'] == "quick")
                            <a style="cursor:default;"><i class="fa fa-map-marker"></i>
                              Zip : {{$job->UserBookingDetail['zipcode']}}
                            </a>
                        @endif
                        @if($job['booking_type'] == "quick")                        
                          <a href="#" style="cursor:default;"><i class="fa fa-file-text-o"></i>                          
                              Quotes By: 
                              @if($job->UserBookingDetail['quote_by_email'] == 1)
                                'Email'
                              @endif
                              @if($job->UserBookingDetail['quote_by_text'] == 1)
                                'Text'
                              @endif                          
                          </a>                        
                        @endif
                      </div>                      
                   </div>
              </div>
           </div>

           @if($job['booking_type'] == "direct" && isset($job->UserBookingDetail->schedule))
            <script>
            // console.log({!! $job->UserBookingDetail->schedule !!});
              jQuery("#businessHoursWidget-{{ $job->id }}").businessHours(
              {
                operationTime: {!! $job->UserBookingDetail->schedule !!}
              });
            </script>

          @endif
           @endforeach

           <div class="pagination_last">
                {!! $jobpostobj->render() !!}
              </div>
        @else
          <div class="review-list-block">
            <div class="row">
                <div class="col-lg-11 col-md-11 col-sm-9 col-xs-12">
                    No Jobs Found
                <div class="clearfix"></div>
                </div>
            </div>
          </div>
        @endif
        </div>
      </div>

     
 
    </div>
    </div>
    </div>
     @include('includes.sidebar_profile_right') 
    </div>



<script type="text/javascript">
jQuery('.colorBox.WorkingDayState').hide();
jQuery('.operationTimeFrom, .operationTimeTill').attr("readonly", "readonly");
</script>
@endsection
