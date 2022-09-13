@extends('admin.layouts.layout')

@section('content') 

<div class="row">
        <div class="col-md-4">

        <!-- Customer Profile Image -->
        <div class="box box-primary">
          <div class="box-body box-profile">
            <?php
              if(@$bookingDetails['user']['profile_pic'] != '' && file_exists(public_path().DIRECTORY_SEPARATOR.'uploads'.DIRECTORY_SEPARATOR.'profile_pic'.DIRECTORY_SEPARATOR.'thumb'.DIRECTORY_SEPARATOR.@$bookingDetails['user']['profile_pic'])) {
                  echo '<img src="'.Config::get('constants.USER_IMAGE_THUMB').$bookingDetails['user']['profile_pic'].'" class="profile-user-img img-responsive img-circle" style="height:180px;width:250px"/>';
              }
              else {
                  echo '<img src="'.Config::get('constants.FRONT_IMAGE').'user.png"  class="profile-user-img img-responsive img-circle" style="height:180px;width:250px"/>';
              }
              ?>

            <h3 class="profile-username text-center">{{ @$bookingDetails['user']['firstname'] }} {{ @$bookingDetails['user']['lastname'] }}</h3>

            <p class="text-center">{{ @$bookingDetails['user']['role'] }}</p>

            <ul class="list-group list-group-unbordered">
              
              <li class="list-group-item">
                <b>Email :</b> <a class="pull-right">@if($bookingDetails['user']['email'] != "") {{ $bookingDetails['user']['email'] }} @else - @endif</a>
              </li>
              <li class="list-group-item">
                <b>Phone :</b> <a class="pull-right">@if($bookingDetails['user']['phone_number'] != "") {{ $bookingDetails['user']['phone_number'] }} @else - @endif</a>
              </li>
              <li class="list-group-item">
                <b>Gender :</b> <a class="pull-right">@if($bookingDetails['user']['gender'] != "") {{ $bookingDetails['user']['gender'] }} @else - @endif</a>
              </li>
              <li class="list-group-item" style="border-bottom: none !important;">
                <b>Address :</b> <a class="pull-right">
                @if(isset($bookingDetails['user']['address'])) {{ $bookingDetails['user']['address'] }} @else - @endif
                    <br>
                  @if(isset($bookingDetails['user']['city'])) {{ @$customerDetails->cities->city_name }}, @endif <br>
                  @if(isset($bookingDetails['user']['state'])) {{ @$customerDetails->states->state_name }}, @endif 
                  @if(isset($bookingDetails['user']['zipcode'])) {{ $bookingDetails['user']['zipcode'] }} @endif
                  <br>
                  @if(isset($bookingDetails['user']['country'])) {{ @$customerDetails->countries->country }}  @endif</a>
              </li>
            </ul>

          </div>
        </div>

        <!-- Business User Profile Image (If Status Confirmed) -->
        @if(@count($bookingDetails['businessuser']) > 0)
        <div class="box box-primary">
          <div class="box-body box-profile">
            <?php
              if(@$bookingDetails['businessuser']['profile_pic'] != '' && file_exists(public_path().DIRECTORY_SEPARATOR.'uploads'.DIRECTORY_SEPARATOR.'profile_pic'.DIRECTORY_SEPARATOR.'thumb'.DIRECTORY_SEPARATOR.@$bookingDetails['businessuser']['profile_pic'])) {
                  echo '<img src="'.Config::get('constants.USER_IMAGE_THUMB').$bookingDetails['businessuser']['profile_pic'].'" class="profile-user-img img-responsive img-circle" style="height:180px;width:250px"/>';
              }
              else {
                  echo '<img src="'.Config::get('constants.FRONT_IMAGE').'user.png"  class="profile-user-img img-responsive img-circle" style="height:180px;width:250px"/>';
              }
              ?>

            <h3 class="profile-username text-center">{{ @$bookingDetails['businessuser']['firstname'] }} {{ @$bookingDetails['businessuser']['lastname'] }}
            
            </h3>

            <p class="text-center">{{ @$bookingDetails['businessuser']['role'] }}</p>

            <ul class="list-group list-group-unbordered">
              
              <li class="list-group-item">
                <b>Email :</b> <a class="pull-right">@if($bookingDetails['businessuser']['email'] != "") {{ $bookingDetails['businessuser']['email'] }} @else - @endif</a>
              </li>
              <li class="list-group-item">
                <b>Phone :</b> <a class="pull-right">@if($bookingDetails['businessuser']['phone_number'] != "") {{ $bookingDetails['businessuser']['phone_number'] }} @else - @endif</a>
              </li>
              <li class="list-group-item">
                <b>Profession Type :</b> <a class="pull-right">
                @if(@$businessuserDetails['ProfessionalDetail']['professional_type'])
                  {{ ucfirst(@$businessuserDetails['ProfessionalDetail']['professional_type'])}}
                @else - 
                @endif
                </a>
              </li>
              <li class="list-group-item">
                <b>Gender :</b> <a class="pull-right">@if($bookingDetails['businessuser']['gender'] != "") {{ $bookingDetails['businessuser']['gender'] }} @else - @endif</a>
              </li>
              
              <li class="list-group-item" style="border-bottom: none !important;">
                <b>Address :</b> <a class="pull-right">
                @if(isset($bookingDetails['businessuser']['address'])) {{ $bookingDetails['businessuser']['address'] }} @else - @endif
                    <br>
                  @if(isset($bookingDetails['businessuser']['city'])) {{ @$businessuserDetails->cities->city_name }}, @endif <br>
                  @if(isset($bookingDetails['businessuser']['state'])) {{ @$businessuserDetails->states->state_name }}, @endif 
                  @if(isset($bookingDetails['businessuser']['zipcode'])) {{ $bookingDetails['businessuser']['zipcode'] }} @endif
                  <br>
                  @if(isset($bookingDetails['businessuser']['country'])) {{ @$businessuserDetails->countries->country }}  @endif</a>
              </li>
            </ul>

          </div>
        </div>
        @endif
        </div>
        
        <!-- Booking Details / Que-Ans -->
        <div class="col-md-8">
          <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
              <li class="active"><a href="#profile" data-toggle="tab">Booking Details</a></li>
              @if(@count($bookingQuoteList) > 0)
              <li class=""><a href="#quotesprofile" data-toggle="tab">Booking Quote Details</a></li>
              @endif
            </ul>
            <div class="tab-content">
              <div class="active tab-pane" id="profile">
                <div class="row nw-user-detail-block">
                    <div class="col-lg-1 col-md-1 col-sm-1 col-xs-1 text-center"></div>
                    <div class="col-lg-11 col-md-11 col-sm-11 col-xs-12 nw-user-detail">
                        
                      <h1 class="nw-user-nm" style="width:65% !important;text-transform: capitalize;">{{ @$sportsList[$bookingDetails['user_booking_detail']['sport']] }}</h1>
                      
                      <div class="nw-user-edit" >                  
                          <div class="clearfix"></div>
                          <h4><span>Booking Status : </span>
                              @if($bookingDetails['business_id'] != null && $bookingDetails['status'] == "requested")
                                <span class="booking-pending-text">Confirmation Pending</span>
                              @elseif($bookingDetails['business_id'] == null && $bookingDetails['status'] == "requested")
                                <span class="boking-openall-text"> Open to All </span>
                              @elseif($bookingDetails['status'] == "rejected")
                                <span class="booking-rejected-text"> Rejected </span>
                                <br><br>
                                <span>Rejected Reason : </span>
                                <div class="topmargin10 leftmargin40"><p><i><?php echo nl2br($bookingDetails['rejected_reason']); ?></i></p></div>
                              @elseif($bookingDetails['status'] == "confirmed")
                                <span class="booking-booked-text">Booked</span>
                              @endif 
                            </h4>
                          <div class="clearfix"></div>
                      </div>

                      <h4>
                      <span>Booking Type : </span>
                      <span> @if($bookingDetails['booking_type'] == 'quick')
                              Quick Hire
                             @else
                              Direct Hire
                             @endif 
                      </span>
                      </h4>
                      <div class="clearfix"></div>

                      <h4>
                      <span><i class="fa fa-calendar"></i> </span>
                      <!-- <span> <?php echo date('j<\s\up>S</\s\up> M Y', strtotime($bookingDetails['created_at'])); ?> </span> -->
                      <span>{{ date("m/d/Y", strtotime($bookingDetails['created_at'])) }}</span>
                      </h4>
                      <div class="clearfix"></div>
                    </div>
                </div>
                <div class="row">
                 <?php /* <form class="form-horizontal">
                    @if($bookingDetails['jobpostquestions'])
                    <hr>
                    @foreach($bookingDetails['jobpostquestions'] as $key=>$value)
                    <ul >  
                    <li>
                      <label>{{--@$questions[$value['question_id']]--}}</label>
                      <div>{{@$value['answer']}}</div>
                    </li>
                    </ul>
                   @endforeach 
                   @endif
                  </form> */ ?>


                  <form class="form-horizontal">
                   <?php $jobpostquestions = $jobsObj; ?>
                    @if(@count($jobpostquestions) > 0)              
                      @foreach($jobpostquestions as $k => $job)
                      <ul >  
                        <li>
                          <label>{{$job['question']}}</label>
                          <div>
                              <p>
                                @if($job['full_answer'] == '')
                                  {{$job['answer']}}
                                @else
                                  {{$job['full_answer']}}
                                @endif
                              </p>
                              <p>{{$job['other']}}</p>
                          </div>
                        </li>
                      </ul>
                      @endforeach
                    @endif
                  </form>
                </div>
              </div>
              @if(@count($bookingQuoteList) > 0)
              <div class="tab-pane" id="quotesprofile">
                <form class="form-horizontal">
                  @foreach($bookingQuoteList as $quote)
                    <div class="review-list-block">
                      <div class="row">
                        <div class="col-lg-2 col-md-2 col-sm-8 col-xs-12">
                            <span class="review-user">
                            <?php
                            if($quote['BookingQuoteUser']['profile_pic'] != '' && file_exists(public_path().DIRECTORY_SEPARATOR.'uploads'.DIRECTORY_SEPARATOR.'profile_pic'.DIRECTORY_SEPARATOR.'thumb'.DIRECTORY_SEPARATOR.$quote['BookingQuoteUser']['profile_pic'])) {
                                echo '<img src="'.Config::get('constants.USER_IMAGE_THUMB').$quote['BookingQuoteUser']['profile_pic'].'" class="profile-user-img img-responsive img-circle" style="height:100px;width:100px"/>';
                            }
                            else {
                                echo '<img src="'.Config::get('constants.FRONT_IMAGE').'user.png" class="profile-user-img img-responsive img-circle" style="height:100px;width:100px"/>';
                            }
                            ?>
                          </span>
                        </div>
                        <div class="col-lg-10 col-md-10 col-sm-8 col-xs-12" style="height: 400px; overflow:auto;">
                            <div class="review-detail job-list-div">
                                
                                <h3 style="color: #f53b49 !important">{{ $quote['BookingQuoteUser']['firstname'] }} {{ $quote['BookingQuoteUser']['lastname'] }}</h3>
                                
                                <div class="clearfix"></div>
                                <br>
                                <p>Price: {{ $quote['quote_price'] }}</p>
                                <p>Rate Type: {{ ucfirst($quote['rate_type']) }}</p>
                                <p>Email: {{ $quote['BookingQuoteUser']['email'] }}</p>
                                <br>
                                  <p> 
                                    <?php 
                                    $quote_desc = str_replace(PHP_EOL,"<br>",$quote['quote']);
                                    echo $quote_desc;
                                    ?>
                                </p>
                              </div>
                              <div class="job_post_dtls">                        
                                <i class="fa fa-calendar"></i>
                                {{ date("m/d/Y", strtotime($quote['created_at'])) }}
                                
                              </div>                      
                           </div>
                      </div>
                    </div>
                    <hr>
                  @endforeach 
                  <div class="pagination_last">
                  {!! $bookingQuoteList->render() !!}
                  </div>
                </form>
              </div>
               @endif
            <!-- /.tab-content -->
          </div>
          <!-- /.nav-tabs-custom -->
        </div>
        </div>
   
        <!-- Booking Quote Details -->
        <!-- @if(@count($bookingQuoteList) > 0)
        <div class="col-md-4"></div>
        <div class="col-md-8">
          <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
              <li class="active"><a href="#profile" data-toggle="tab">Booking Quote Details</a></li>
            </ul>
            <div class="tab-content">
              <div class="active tab-pane" id="quotesprofile">
              <form class="form-horizontal">
              
              @foreach($bookingQuoteList as $quote)
              <div class="review-list-block">
                <div class="row">
                  <div class="col-lg-2 col-md-2 col-sm-8 col-xs-12">
                      <span class="review-user">
                      <?php
                      if($quote['BookingQuoteUser']['profile_pic'] != '' && file_exists(public_path().DIRECTORY_SEPARATOR.'uploads'.DIRECTORY_SEPARATOR.'profile_pic'.DIRECTORY_SEPARATOR.$quote['BookingQuoteUser']['profile_pic'])) {
                          echo '<img src="'.Config::get('constants.USER_IMAGE').$quote['BookingQuoteUser']['profile_pic'].'" class="profile-user-img img-responsive img-circle"/>';
                      }
                      else {
                          echo '<img src="'.Config::get('constants.FRONT_IMAGE').'user.png" class="profile-user-img img-responsive img-circle" />';
                      }
                      ?>
                    </span>
                  </div>
                  <div class="col-lg-10 col-md-10 col-sm-8 col-xs-12" style="height: 400px; overflow:auto;">
                      <div class="review-detail job-list-div">
                          
                          <h3 style="color: #f53b49 !important">{{ $quote['BookingQuoteUser']['firstname'] }} {{ $quote['BookingQuoteUser']['lastname'] }}</h3>
                          
                          <div class="clearfix"></div>
                          <br>
                          <p>Price: {{ $quote['quote_price'] }}</p>
                          <p>Rate Type: {{ ucfirst($quote['rate_type']) }}</p>
                          <p>Email: {{ $quote['BookingQuoteUser']['email'] }}</p>
                          <br>
                            <p> 
                              <?php 
                              $quote_desc = str_replace(PHP_EOL,"<br>",$quote['quote']);
                              echo $quote_desc;
                              ?>
                          </p>
                        </div>
                        <div class="job_post_dtls">                        
                          <i class="fa fa-calendar"></i>
                          {{ date("m/d/Y", strtotime($quote['created_at'])) }}
                          
                        </div>                      
                     </div>
                </div>
              </div>
              <hr>
              @endforeach 
              <div class="pagination_last">
              {!! $bookingQuoteList->render() !!}
              </div>
              
              </form>
            </div>
          </div>

        </div>
        </div>

        @endif -->

<!-- Return Link -->
<div class="row">
  <div class="col-md-12">
    <div class="box-footer text-center">          
     <a href="\admin\bookings" class="btn btn-primary"><i class="fa fa-fw fa-mail-reply"></i> Return</a>
    </div>
  </div>
</div>

</div>            
@endsection