@extends('layouts.profile')

@section('content')

<div class="business-offer-main">
   @include('includes.sidebar_profile_left')
  <div class="business-middle">
    <div class="busines-offer-list busines-off-profile-list">
    <div class="network_block">
        <div class="message_block"><div id="systemMessage_network"></div></div>
        <div id="myTabContent" class="tab-content">
          <div id="mynetwork" class="tab-pane active in fade job_listing_block">
            @if(count($myfavourites) > 0)
              <ul class="network-list">
                @foreach($myfavourites as $favourite)
                
                  <li id="invitation_{{$favourite['id']}}" class="favouriteblock_{{$favourite['favouriteinfo']['id']}}">
                    <a href="/network/viewprofile/{{ $favourite['favouriteinfo']['id'] }}" data-toggle="modal" data-target="#profiledetail_modal" title="Click here to view full profile">
                      <div class="network-img">
                          @if($favourite['favouriteinfo']['profile_pic'] != '' && file_exists(public_path().DIRECTORY_SEPARATOR.'uploads'.DIRECTORY_SEPARATOR.'profile_pic'.DIRECTORY_SEPARATOR.'thumb150'.DIRECTORY_SEPARATOR.$favourite['favouriteinfo']['profile_pic']))
                            <img src="<?=Config::get('constants.USER_IMAGE_THUMB').$favourite['favouriteinfo']['profile_pic']?>" style="height:350px;" />
                          @else
                            <img src="<?=Config::get('constants.FRONT_IMAGE').'user.png';?>" height="72" width="66" style="height:350px;" />
                          @endif
                           <!--  <a href="janascript:void(0)" class="remove-network removeNetwork" title="Remove From Network" onclick="return removeNetwork(this);"><img src="<?php //echo Config::get('constants.FRONT_IMAGE'); ?>no-friend.png" alt="Remove From Network" width="30" height="30"/></a> -->                        

                        </div>
                      </a>
                        <div class="network-name" style="padding-top: 10px;padding-bottom: 10px;height: 64px;vertical-align: middle;">
                           <span id="userFavourite_{{$favourite['favouriteinfo']['id']}}" style="padding-left: 25px;">
                                <span onclick="favourite({{ $favourite['favouriteinfo']['id'] }},'unfavourite');" class="removefavourite_{{$favourite['favouriteinfo']['id']}}" ><i class="fa fa-star" style="font-size: 28px;color:#f53b49;padding-top: 8px;"></i></span>                               
                            </span>
                            <p style="padding-left: 35px;"><?php echo ucfirst($favourite['favouriteinfo']['firstname']) .' '.ucfirst($favourite['favouriteinfo']['lastname']); ?></p>
                        </div>
                    </li>
                  
                @endforeach
              </ul>
            @else
              Start making Your Favourite Today...
            @endif
          </div>

          <!-- invitations received tab content -->
          <div id="pendingNetworkRcv" class="tab-pane fade job_listing_block">
          </div>

          <!-- invitations sent tab content -->
          <div id="pendingNetworkSent" class="tab-pane fade job_listing_block">
          </div>

        </div>

      <span class="loading-text" style="display:none;">Loading...</span>

    </div>

    </div>

  </div>

   <div class="modal fade" id="profiledetail_modal" role="dialog">
    <div class="modal-dialog modal-lg">
          <div  id="professionaldetail_modal_content"></div>
          <div class="modal-body login-pad">
              <div class="pop-title employe-title">
                  <h3>Profile</h3>
              </div>
              <button type="button" class="close modal-close" data-dismiss="modal">
                  <img src="<?php echo Config::get('constants.FRONT_IMAGE'); ?>close.jpg" height="70" width="34"/>
              </button>
              <div class="modal-content">                
              </div>
          </div>
    </div>
  </div>
  @include('includes.sidebar_profile_right')

</div>

<script type="text/javascript">
$(document).on("ready", function(){

});

</script>

@endsection