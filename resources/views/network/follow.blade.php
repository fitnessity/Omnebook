@extends('layouts.profile')

@section('content')


<div class="business-offer-main">


      @include('includes.sidebar_profile_left')

  
  <div class="business-middle">

    @include('includes.followers_tab_menu')

    <div class="busines-offer-list busines-off-profile-list">

    <div id="follow-content"></div>

    </div>

  </div>

  <!-- professional detail modal -->
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

  $('#profiledetail_modal').on('hidden.bs.modal', function () {
        // remove the bs.modal data attribute from it
        $(this).removeData('bs.modal');
        // and empty the modal-content element
        $('#profiledetail_modal .modal-content').empty();
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