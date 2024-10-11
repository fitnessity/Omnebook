@extends('layouts.profile')

@section('content')
<style>
.colorBox.RestDayState {
  display: none;
}
.operationTime .mini-time {
  width: 60px !important;
}
</style>
<?php $loggedinUser = Auth::user(); ?>
@include('includes.booking_tab_menu')
<div class="profile-div">
  <div class="container">
      
    <div class="row">
      <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
      
        <div class=" review-dtl-block">
        @if(count($jobpostobj)>0)
          <link href="{{url('/public/css/scheduleHours/jquery.businessHours.css')}}" rel="stylesheet">
          <script src="{{url('/public/js/scheduleHours/jquery.businessHours.js')}}"></script>

          @foreach( $jobpostobj as $job )
           <div class="review-list-block">
            <div class="row">
                <div class="col-lg-2 col-md-2 col-sm-8 col-xs-12">
                    <span class="review-user">
                    <?php
                    $postedUser = $job['user'];
                    if($postedUser['profile_pic'] != '' && file_exists(public_path().DIRECTORY_SEPARATOR.'uploads'.DIRECTORY_SEPARATOR.'profile_pic'.DIRECTORY_SEPARATOR.'thumb150'.DIRECTORY_SEPARATOR.$postedUser['profile_pic'])) {
                        echo '<img src="'.Config::get('constants.USER_IMAGE_THUMB150').$postedUser['profile_pic'].'" width="66" height="72" />';
                    }
                    else {
                        echo '<img src="'.Config::get('constants.FRONT_IMAGE').'user.png" width="66" height="72" />';
                    }
                    ?>
                  </span>
                </div>
                <div class="col-lg-10 col-md-10 col-sm-8 col-xs-12">
                    <div class="review-detail job-list-div">
                        <!-- <a href="/viewBoking/{{ $job->id }}" title="Click here to view more"> -->
                          <h1>{{ $postedUser['firstname'] }} {{ $postedUser['lastname'] }}</h1>
                          <!-- </a> -->
                          <div class="review-rate-block">
                              <a href="/viewBooking/{{ $job->id }}" title="Click here to view more" class="readmore">
                                <h1>{{ isset($job->UserBookingDetail->sport) ? @$sportsList[$job->UserBookingDetail->sport] : '' }}</h1>
                              </a>
                              @if($job['status'] == "confirmed")
                                <span class="booking-booked-text">(Booked)</span>
                              @elseif($job['business_id'] != null && $job['status'] == "requested")
                                <span class="booking-pending-text">(Confirmation Pending)</span>
                              @elseif($job['business_id'] == null && $job['status'] == "requested")
                                <span class="boking-openall-text"> (Open to All)</span>
                              @elseif($job['status'] == "rejected")
                                <span class="booking-rejected-text"> (Rejected)</span>
                              @endif
                              @if($job['business_id'] != null && $job['status'] == "requested")
                              <br>
                              <span class="booking-rejected-text"><a href="/viewBooking/{{ $job->id }}" class="readmore">Confirm or Reject Request</a></span>
                              @else
                              <br>
                              <span class="booking-rejected-text"><a href="/viewBooking/{{ $job->id }}" class="readmore">View Detail</a></span>
                              @endif
                          </div>
                           <p>
                              Sport Price: {{ $job->UserBookingDetail['price'] }}
                            </p>
                            <p> 
                              <strong>Schedule</strong><br>
                              <div id="businessHoursWidget-{{ $job->id }}"></div>
                            </p>
                          <!-- <p>description here</p> -->
                          <div class="clearfix"></div>
                      </div>
                      <div class="job_post_dtls">
                        <a href="#" style="cursor:default;"><i class="fa fa-calendar"></i>
                          {{ date("m/d/Y", strtotime($job['created_at'])) }}
                        </a>
                        @if($job['booking_type'] == "quick")
                            <a href="#" style="cursor:default;"><i class="fa fa-map-marker"></i>
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
                        </a>
                      </div>                      
                   </div>
              </div>
           </div>


           @if($job['booking_type'] == "direct" && isset($job->UserBookingDetail['schedule']))
             <script>
             jQuery("#businessHoursWidget-{{ $job->id }}").businessHours(
               {
                 operationTime: {!! $job->UserBookingDetail['schedule'] !!}
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

     
 @include('includes.sidebar_profile_right')
    </div>
     
  </div>
 
</div>
<script>
  jQuery('.colorBox.WorkingDayState').hide();
  jQuery('.operationTimeFrom, .operationTimeTill').attr("readonly", "readonly");
</script>
@endsection
