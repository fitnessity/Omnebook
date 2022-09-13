
<div class="business-offer-main" style="    background: #eeeeee05 !important;">
    <div class="network_block nw-profile_block">
      <div class="row">
        <div class="nw-user-detail-block">
          <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 text-center">
            <div class="nw-user-img">
              <?php
              if($UserProfileDetail['profile_pic'] != '' && file_exists(public_path().DIRECTORY_SEPARATOR.'uploads'.DIRECTORY_SEPARATOR.'profile_pic'.DIRECTORY_SEPARATOR.'thumb150'.DIRECTORY_SEPARATOR.$UserProfileDetail['profile_pic'])) {
                echo '<img src="'.Config::get('constants.USER_IMAGE_THUMB').$UserProfileDetail['profile_pic'].'" width="254" height="275" id="display_user_profile_pic" />';
              }
              else {
                echo '<img src="'.Config::get('constants.FRONT_IMAGE').'user.png" width="254" height="275" id="display_user_profile_pic" />';
              }
              ?>
            </div>
            <?php 
              if(isset($UserProfileDetail['follows']) && count($UserProfileDetail['follows']) > 0 ){ ?>
                <button class="btn common-btn follow" id="{{ $UserProfileDetail['follows'][0]['follower_id'] }}">Unfollow</button>
            <?php } else { ?>
                <button class="btn common-btn follow" id="{{ $UserProfileDetail['id'] }}">Follow</button>  
            <?php } ?>
            <span id="userFavourite_{{$UserProfileDetail['id']}}" style="padding-left: 25px;">
                @if(isset($UserProfileDetail['favourites']) && count($UserProfileDetail['favourites']) > 0 )
                <a onclick="favourite({{ $UserProfileDetail['id'] }},'unfavourite');" class="removefavourite_{{$UserProfileDetail['id']}}" ><i class="fa fa-star fav-star"></i></a>
                @else
                &nbsp;<a onclick="favourite({{ $UserProfileDetail['id'] }},'favourite');" class="makefavourite_{{$UserProfileDetail['id']}}"><i class="fa fa-star-o unfav-star" style="font-size: 28px;padding-top: 8px;"></i></a>
                @endif
            </span>  
            <!-- <button class="btn common-btn">Favorites</button> -->
            <div id="follow-msg">Error</div>
          </div>

          <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12 nw-user-detail profiledetail">
            <h1 class="nw-user-nm">{{ $UserProfileDetail['firstname']." ".$UserProfileDetail['lastname'] }}</h1>
            
            <div class="nw-user-edit profiledetail">
              <div class="nw-dtl-edit">
                <span class="nw-label">Name:</span>
                <span id="display_user_name">{{ $UserProfileDetail['firstname'] }} {{ $UserProfileDetail['lastname']}}</span>
              </div>
              <div class="nw-dtl-edit">
                <span class="nw-label">Gender:</span>
                <span id="display_user_name">{{ $UserProfileDetail['gender'] }}</span>
              </div>
              <div class="nw-dtl-edit">
                <span class="nw-label">Email : </span><span>{{ $UserProfileDetail['email'] }}</span>
              </div>
              <div class="nw-dtl-edit">
                <span class="nw-label" id="display_user_phone">Phone : </span><span>{{ $UserProfileDetail['phone_number'] }}</span>
              </div>
              <div class="nw-dtl-edit">
                <span class="nw-label">Address :  </span>
                <span class="nw-detail-txt" id="display_user_address">
                  {{ $UserProfileDetail['address'] }}
                  <br>
                  {{ $UserProfileDetail['cities']['city_name'] }}, {{ $UserProfileDetail['states']['state_name'] }} {{ $UserProfileDetail['zipcode'] }}
                  <br>
                  {{ $UserProfileDetail['countries']['country_name'] }}                  
                  <div class="clearfix"></div>
                  <a href="#"><i class="fa fa-phone"></i></a><a href="#"><i class="fa fa-map-marker"></i></a><a href="#"><i class="fa fa-envelope"></i></a>
                </span>
              </div>

              <div class="nw-dtl-edit">
                <span class="nw-label">About :  </span>
                <span class="nw-detail-txt" id="display_user_address">
                   @if(isset($UserProfileDetail['customerDetail']->about_me)) {!! nl2br(ucfirst($UserProfileDetail['customerDetail']->about_me)) !!} @else - @endif
                </span>
              </div>
                         
            </div>
          </div>
          <div class="nw-user-detail-line"></div>
        </div>
      </div>
      <div class="clearfix"></div>
    </div>
    <div class="row"></div>
</div>

@include('includes.followers_script')
