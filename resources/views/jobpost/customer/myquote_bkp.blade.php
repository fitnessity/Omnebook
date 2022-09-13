@extends('layouts.profile')

@section('content')
@include('includes.booking_tab_menu')
<div class="profile-div">
  <div class="container">
    <div class="row">
      <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
      
        <div class=" review-dtl-block">
        @if(count($joblist)>0)
          @foreach( $joblist as $job )
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
                              <a href="/booking/viewBooking/{{ $job->id }}" title="Click here to view more" class="readmore">
                                <h1>{{ $job->UserBookingDetail->sport }}</h1>
                              </a>
                              @if($job['status'] == "confirmed")
                                <span><font style="color:#84a04a">Booked</font>
                                </span>
                              @elseif($job['business_id'] != null && $job['status'] == "requested")
                                <span><font style="color:#f53b49">Confirmation Pending</font>
                                </span>
                              @elseif($job['status'] == "rejected")
                                <span><font style="color:#878af9">Rejected</font>
                                </span>
                              @endif
                          </div>
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
                      <div class="job_post_dtls">
                          <p>Your Quote: {{ $job['quote_price'] }} <br>
                            <?php $quote = substr(str_replace(PHP_EOL,"<br>",$job['quote']), 0, 500);
                                  echo $quote.' <a href="/booking/postquote/'.$job->id.'" class="readmore">Read More</a>';
                            ?>
                          </p>
                      </div>
                   </div>
              </div>
           </div>
           @endforeach

           <div class="pagination_last">
                {!! $joblist->render() !!}
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


@endsection