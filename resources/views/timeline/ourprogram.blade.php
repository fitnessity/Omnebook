<?php /*@extends('layouts.profile')

@section('content')

<div class="business-offer-main">

    @include('includes.sidebar_profile_left')

  <div class="business-middle">
    
  @include('includes.profile_tab_menu')    */ ?>
<style>
  .liclass{list-style:outside;font-size: 13px;}
</style>
    <div class="busines-offer-list">
      <?php $services = $UserProfileDetail['service']; ?>
        @if(count($services) > 0)
          @foreach($services as $service)
              <div class="busines-offer-con">
                <div class="middle-img">
                  <?php
                    if($service['image'] != '' && file_exists(public_path().DIRECTORY_SEPARATOR.'uploads'.DIRECTORY_SEPARATOR.'service_profile_pic'.DIRECTORY_SEPARATOR.'thumb'.DIRECTORY_SEPARATOR.$service['image'])) {
                      echo '<img src="'.Config::get('constants.SERVICE_IMAGE_THUMB').$service['image'].'" width="266" height="247" id="display_user_profile_pic_view_profile" class="display_user_profile_pic_view_profile"/>';
                    }
                    else {
                       echo '<img src="/images/offer1.jpg" height="247" width="266" />';
                    }
                  ?>
                </div>
                <div class="offer-list-detail">
                  <h3>{{ $service['title'] }}</h3>
                  <p>{{ $service['servicedesc'] }}</p>
                  <span>
                    <i class="fa" aria-hidden="true"></i> <strong> {{ $sports_names[$service['sport']] }} </strong>
                  </span>
                  <span>
                    <i class="fa" aria-hidden="true"></i> {{ $service['price'] }}
                  </span>
                  <div class="row">
                    <div class="col-md-12" style="padding-top: 20px;">
                      <div class="col-md-6">
                        <ul>
                        @if(isset($programType[$service['programtype']]))
                          <li class="liclass">
                            <!-- <b>Program Type: </b> -->
                            {{ $programType[$service['programtype']] }}
                          </li>
                        @endif
                        @if(isset($ageRange[$service['agerange']]))
                          <li class="liclass">Age Range: {{ $ageRange[$service['agerange']] }}</li>
                        @endif
                         @if(isset($numberOfPeople[$service['numberofpeople']]))
                            <li class="liclass">Number of People: {{ $numberOfPeople[$service['numberofpeople']] }}</li>
                          @endif
                        </ul>
                      </div>
                      <div class="col-md-6">
                          @if($service['servicelocation'] != '')
                            <li class="liclass">Place: 
                            @if($service['servicelocation'] == "indoor")
                            {{ $serviceLocation[$service['servicelocation']] }}
                            @else
                            Outdoors({{$serviceLocation['outdoors'][$service['servicelocation']] }})
                            @endif
                            </li>
                          @endif
                          @if(isset($pFocuses[$service['focuses']]))
                            <li class="liclass">Focuse:  {{ $pFocuses[$service['focuses']] }}</li>
                          @endif
                           @if(isset($duration[$service['duration']]))
                              <li class="liclass">Duration: {{ $duration[$service['duration']] }}</li>
                            @endif
                      </div>
                    </div>
                  </div>
                </div>
              </div>
          @endforeach
        @endif        
    </div>    

<?php /*
  </div>    

  @include('includes.sidebar_profile_right')

</div>

@endsection */ ?>