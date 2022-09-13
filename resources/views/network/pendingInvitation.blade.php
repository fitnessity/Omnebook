@extends('layouts.profile')

@section('content')


<div class="business-offer-main">


      @include('includes.sidebar_profile_left')

  
  <div class="business-middle">

    @include('includes.network_tab_menu')

    <div class="busines-offer-list busines-off-profile-list">

      <div class="network_block">

          <ul id="myTab_1" class="tab_topic">
            <li class="active"><a href="#pendingNetworkRcv" data-toggle="tab" id="pendingNetworkRcvTab">Invitations Received</a></li>
            <li><a href="#pendingNetworkSent" data-toggle="tab" id="pendingNetworkSentTab" >Invitations Sent</a></li>
          </ul>

          <div class="message_block"><div id="systemMessage_network"></div></div>

          <div id="myTabContent" class="tab-content">

            <!-- invitations received tab content -->
            <div id="pendingNetworkRcv" class="tab-pane active in fade job_listing_block">
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

@include('includes.followers_script')

<script type="text/javascript">
$(document).on("ready", function(){

  getpendingNetworkRcvTabContent();
  $("#pendingNetworkRcvTab").click(function() {
    getpendingNetworkRcvTabContent();
  });

  $("#pendingNetworkSentTab").click(function() {
    getpendingNetworkSentTabContent();
  });

  $("#myTab_1").find('li').click(function() {
    $("#systemMessage_network").html('');
  });
});

function getpendingNetworkRcvTabContent() {
  $.ajax({
          url:'/network/getNetworkRequestReceived',
          type:'GET',
          data:{},
          beforeSend: function () {
            $("#pendingNetworkRcv").html('');
          },
          complete: function () {
          },
          success: function (response) {
            $("#pendingNetworkRcv").html(response);
          }
        });
}

function getpendingNetworkSentTabContent() {
  $.ajax({
          url:'/network/getNetworkRequestSent',
          type:'GET',
          data:{},
          beforeSend: function () {
            $("#pendingNetworkSent").html('');
          },
          complete: function () {
          },
          success: function (response) {
            $("#pendingNetworkSent").html(response);
          }
        });
}

function removeNetwork(element) {
    var selectedblock = $(element).closest('li.networkblock');
    var selectedblock_id = $(selectedblock).attr("id");
    selectedblock_id = selectedblock_id.split("_");
    var selected_id = selectedblock_id[1];

    var nameDiv = $(selectedblock).find('.network-name').find('p').html();
    if($(element).attr('title') == "Withdraw Invitation") {
      if(!confirm("Are you sure you want to withdraw this invitation?"))
          return false;
    }
    else if($(element).attr('title') == "Ignore Invitation") {
      if(!confirm("Are you sure you want to remove this invitation?"))
          return false;
    }

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
            var parentListDiv = $(selectedblock).closest('ul.network-list');
            $(selectedblock).remove();
            if($(parentListDiv).children().length == 0) {
              $(parentListDiv).closest('div.tab-pane').html("No Invitation Found");
            }
          }
        });
    return false;
}

function acceptNetwork(element) {
    var selectedblock = $(element).closest('li.networkblock');
    var selectedblock_id = $(selectedblock).attr("id");
    selectedblock_id = selectedblock_id.split("_");
    var selected_id = selectedblock_id[1];

    $.ajax({
          url:'/network/acceptNetwork',
          type:'GET',
          dataType: 'json',
          data:{id:selected_id},
          beforeSend: function () {
          },
          complete: function () {
          },
          success: function (response) { 
            showSystemMessages('#systemMessage_network', response.type, response.msg);
            var parentListDiv = $(selectedblock).closest('ul.network-list');
            $(selectedblock).remove();
            if($(parentListDiv).children().length == 0) {
              $(parentListDiv).closest('div.tab-pane').html("No Invitation Found");
            }
          }
        });
    return false;
}
</script>

@endsection