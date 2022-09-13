<?php $currentPath = explode("/", Request::path()); ?>
    <div class="network_block">
      <div class="about-services-title">
        <h1>FOLLOWINGS</h1>
      </div>
        <div class="message_block"><div id="systemMessage_network"></div></div>

        <div id="myTabContent" class="tab-content">
        <!-- my network tab content -->
          <div id="followers" class="tab-pane active in fade job_listing_block">
            @if(count($followers) > 0)
              <ul class="network-list">
                @foreach($followers as $follower)

                <?php if(isset($follower['followings']) && !empty($follower['followings'])) { ?>
                <a href="/network/viewprofile/{{ $follower['followings']['id'] }}" data-toggle="modal" data-target="#profiledetail_modal" title="Click here to view full profile">
                  <li id="invitation_{{$follower['followings']['id']}}" class="networkblock">
                      <div class="network-img">
                          @if($follower['followings']['profile_pic'] != '' && file_exists(public_path().DIRECTORY_SEPARATOR.'uploads'.DIRECTORY_SEPARATOR.'profile_pic'.DIRECTORY_SEPARATOR.'thumb150'.DIRECTORY_SEPARATOR.$follower['followings']['profile_pic']))
                            <img src="<?=Config::get('constants.USER_IMAGE_THUMB').$follower['followings']['profile_pic']?>" height="72" width="66" style="height:350px;" />
                          @else
                            <img src="<?=Config::get('constants.FRONT_IMAGE').'user.png';?>" height="72" width="66" style="height:350px;" />
                          @endif

                            <a href="javascript:void(0)" class="remove-network removeNetwork un-follow" id="{{ $follower['followings']['id'] }}" title=""><img src="<?php echo Config::get('constants.FRONT_IMAGE'); ?>no-friend.png" alt="follow" width="30" height="30"/></a>

                        </div>

                        <div class="network-name">
                          <!-- <a href="#" class="remove-network" title="Accept Invitation"><img src="<?php //echo Config::get('constants.FRONT_IMAGE'); ?>add-friend.png" alt="Accept Invitation" width="30" height="30"/></a> -->

                            <p><?php echo ucfirst($follower['followings']['firstname']) .' '.ucfirst($follower['followings']['lastname']); ?></p>
                        </div>
                  </li>
                </a>
               <?php } ?>
                @endforeach
              </ul>
            @else
              Start Followings To Your Favourite Today...
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
    <script>
      $(document).ready( function(){
        $('#profiledetail_modal').on('hidden.bs.modal', function () {
          // remove the bs.modal data attribute from it
          $(this).removeData('bs.modal');
          // and empty the modal-content element
          $('#profiledetail_modal .modal-content').empty();
        });
      });
    </script>
    @include('includes.followers_script')