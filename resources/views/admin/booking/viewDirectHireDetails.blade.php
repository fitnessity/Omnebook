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

            <p class="text-muted text-center">{{ $bookingDetails['user']['role'] }}</p>

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
        @if(count($bookingDetails['businessuser']) > 0)
        <div class="box box-primary">
          <div class="box-body box-profile">
            <?php
              if(@$bookingDetails['businessuser']['profile_pic'] != '' && file_exists(public_path().DIRECTORY_SEPARATOR.'uploads'.DIRECTORY_SEPARATOR.'profile_pic'.DIRECTORY_SEPARATOR.'thumb'.DIRECTORY_SEPARATOR.@$bookingDetails['businessuser']['profile_pic'])) {
                  echo '<img src="'.Config::get('constants.USER_IMAGE_THUMB').$bookingDetails['businessuser']['profile_pic'].'" class="profile-user-img img-responsive img-circle" style="height:180px;width:250px"/>';
              }
              else {
                  echo '<img src="'.Config::get('constants.FRONT_IMAGE').'user.png"  class="profile-user-img img-responsive img-circle" style="height:180px;width:250px" />';
              }
              ?>

            <h3 class="profile-username text-center">{{ @$bookingDetails['businessuser']['firstname'] }} {{ @$bookingDetails['businessuser']['lastname'] }}</h3>

            <p class="text-muted text-center">{{ $bookingDetails['businessuser']['role'] }}</p>

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
        
        <!-- Booking Details / Schedule -->
        <div class="col-md-8">
          <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
              <li class="active"><a href="#profile" data-toggle="tab">Booking Details</a></li>
            </ul>
            <div class="tab-content">
              <div class="row">
                <div class="nw-user-detail-block">
                    <div class="col-lg-1 col-md-1 col-sm-1 col-xs-1 text-center"></div>
                    <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12 nw-user-detail">
                        
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
                <!--<div class="nw-user-detail-line"></div>-->
            </div>
              
            <div class="row">
              <div class="active tab-pane" id="schedule">
                <form class="form-horizontal">
                  <hr>
                  <div class="col-md-1"></div>
                  <div class="col-md-11  nw-user-detail">

                  <div class="nw-user-edit" >                  
                      <div class="clearfix"></div>
                      <span><b>Price :</b> </span>
                          {{ $bookingDetails['user_booking_detail']['price'] }}
                      
                      <div class="clearfix"></div>
                      <br>
                      <span> <b> Booking Detail :</b> </span>
                      <br>
                      <?php 
                        $detail = substr(str_replace(PHP_EOL,"<br>",$bookingDetails['user_booking_detail']['booking_detail']), 0, 500);
                        echo $detail;
                        ?>
                      
                      <div class="clearfix"></div>
                      <br>
                      @if(isset($bookingDetails['user_booking_detail']['schedule']))
                       <span> <b> Schedule :</b> </span>
                          <br>
                          <ul>
                          @foreach(json_decode($bookingDetails['user_booking_detail']['schedule']) as $key => $value)
                            @if($value->isActive == true)
                            <li>
                             {{ $allDays[$key] }} ( {{ $value->timeFrom }} - {{ $value->timeTill }} ) 
                            </li>
                            @endif
                          @endforeach
                          </ul>
                      
                      <div class="clearfix"></div>
                      @endif
                  </div>
                  
                  </div>
                </form>
              </div>
            </div>

            <!-- /.tab-content -->
          </div>
          <!-- /.nav-tabs-custom -->
        </div>
        </div>

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