@extends('layouts.profile')

@section('content')


<div class="business-offer-main">


      @include('includes.sidebar_profile_left')

  
  <div class="business-middle">

    @include('includes.network_tab_menu')

    <div class="busines-offer-list busines-off-profile-list">

    <div class="network_block">

        <!-- <ul id="myTab_1" class="tab_topic">
          <li class="active"><a href="#mynetwork" data-toggle="tab" id="mynetworkTab">My Network</a></li>
          <li><a href="#pendingNetworkRcv" data-toggle="tab" id="pendingNetworkRcvTab">Invitations Received</a></li>
          <li><a href="#pendingNetworkSent" data-toggle="tab" id="pendingNetworkSentTab" >Invitations Sent</a></li>
        </ul> -->

        <div class="message_block"><div id="systemMessage_network"></div></div>

        <div id="myTabContent" class="tab-content">
        <!-- my network tab content -->
          <div id="mynetwork" class="tab-pane active in fade job_listing_block">
            @if(count($mynetwork) > 0)
              <ul class="network-list">
                @foreach($mynetwork as $network)
                <a href="/network/viewprofile/{{ $network['friendinfo']['id'] }}" data-toggle="modal" data-target="#profiledetail_modal" title="Click here to view full profile">
                  <li id="invitation_{{$network['id']}}" class="networkblock">
                      <div class="network-img">
                          @if($network['friendinfo']['profile_pic'] != '' && file_exists(public_path().DIRECTORY_SEPARATOR.'uploads'.DIRECTORY_SEPARATOR.'profile_pic'.DIRECTORY_SEPARATOR.'thumb150'.DIRECTORY_SEPARATOR.$network['friendinfo']['profile_pic']))
                            <img src="<?=Config::get('constants.USER_IMAGE_THUMB').$network['friendinfo']['profile_pic']?>" style="height:350px;" />
                          @else
                            <img src="<?=Config::get('constants.FRONT_IMAGE').'user.png';?>" height="72" width="66" style="height:350px;" />
                          @endif

                            <a href="janascript:void(0)" class="remove-network removeNetwork" title="Remove From Network" onclick="return removeNetwork(this);"><img src="<?php echo Config::get('constants.FRONT_IMAGE'); ?>no-friend.png" alt="Remove From Network" width="30" height="30" /></a>
                        </div>

                        <div class="network-name">
                          <!-- <a href="#" class="remove-network" title="Accept Invitation"><img src="<?php echo Config::get('constants.FRONT_IMAGE'); ?>add-friend.png" alt="Accept Invitation" width="30" height="30"/></a> -->
                            <p><?php echo ucfirst($network['friendinfo']['firstname']) .' '.ucfirst($network['friendinfo']['lastname']); ?></p>
                        </div>
                  </li>
                </a>
                @endforeach
              </ul>
            @else
              Start Building Your Network Today...
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

  @include('includes.network_profile_details')
  @include('includes.sidebar_profile_right')

</div>

<script type="text/javascript">
$(document).on("ready", function(){

  $("#mynetworkTab").click(function() {
    $(this).closest('ul').find('.active-tab').removeClass('active-tab');
    $(this).addClass("active-tab");
    $.ajax({
          url:'/network/getMyNetwork',
          type:'GET',
          // dataType: 'json',
          data:{},
          beforeSend: function () {
            $("#mynetwork").html('');
          },
          complete: function () {
          },
          success: function (response) {
            $("#mynetwork").html(response);
          }
        });
  });

});

function removeNetwork(element) {
    var selectedblock = $(element).closest('li.networkblock');
    var selectedblock_id = $(selectedblock).attr("id");
    selectedblock_id = selectedblock_id.split("_");
    var selected_id = selectedblock_id[1];

    var nameDiv = $(selectedblock).find('.network-name').find('p').html();
    if(!confirm("Are you sure you want to remove "+nameDiv+" from your Network?"))
          return false;

    $.ajax({
          url:'/network/removeNetwork',
          type:'GET',
          dataType: 'json',
          data:{id:selected_id},
          beforeSend: function () {
          },
          complete: function () {
          },
          success: function (response) {
            showSystemMessages('#systemMessage_network', response.type, response.msg);
            $(selectedblock).remove();
            if($(selectedblock).closest('ul.network-list').length == 0) {
              $("#mynetwork").html("Start Building Your Network Today...");
            }
          }
        });
    return false;
}
</script>

@endsection