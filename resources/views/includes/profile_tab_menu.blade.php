  <?php
    $currentPath = explode("/", Request::path());
  ?>
	<!--<div class="business-title">-->
      <!--<h1>@if(Auth::user()->role == 'business') {{Auth::user()->company_name}} @else Welcome To Fitnessity @endif</h1>-->
      <!-- <p>Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. 

        Vestibulum tortor quam, feugiat vitae, ultricies eget, tempor sit amet, ante.</p> -->
        <!--<p>Fitnessity is an online and offline marketplace that matches fitness enthusiasts with local fitness professionals offering lessons, classes, and adventures in multiple sports. </p>-->
    <!--</div>-->

    <div class="business-menu">
      @if(Auth::user()->role == "business")
        <!--<ul>-->
        <!--  <li><a href="/mytimeline" class="profile-menu-tab active-tab">POST TO WALL  </a></li>-->
        <!--  <li><a href="/ourprogram" class="profile-menu-tab"> OUR PROGRAM   </a></li>-->
        <!--  <li><a href="/reviews"  class="profile-menu-tab">REVIEWS</a></li>-->
        <!--  <li><a href="/mytimelineimages"  class="profile-menu-tab">IMAGES</a></li>-->
        <!--  <li><a href="/mytimelinevideos"  class="profile-menu-tab">VIDEOS</a></li>-->
        <!--</ul>-->
      @else
        <!--<ul>-->
        <!--  <li><a href="/mytimeline" class="profile-menu-tab active-tab">POST TO WALL  </a></li>-->
        <!--  <li><a href="/reviews"  class="profile-menu-tab">REVIEWS</a></li>-->
        <!--  <li><a href="/mytimelineimages"  class="profile-menu-tab">IMAGES</a></li>-->
        <!--  <li><a href="/mytimelinevideos"  class="profile-menu-tab">VIDEOS</a></li>-->
        <!--</ul>-->
      @endif
    </div>
    <div class="review-btns">
      <div class="row" style="margin-bottom: 25px;">
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
              <a href="/reviews/add" class="review-btn-links pull-left active mrgn-rght8 profile-menu-tab2">Write Reviews</a>
              <a href="/reviews" class="review-btn-links pull-left active profile-menu-tab2">Reviews for me</a>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 text-right">
              <div class="dropdown  review-follow pull-right">
                <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false">Follow <i class="fa fa-angle-down"></i> </button>
                <ul class="dropdown-menu">
                  <li><a href="/network/followers" class="profile-menu-tab2">My Followers</a></li>
                  <li><a href="/network/followings" class="profile-menu-tab2">Followings</a></li>
                </ul>
              </div>
              <a href="/network/followers" class="review-btn-links pull-right mrgn-rght8 profile-menu-tab2">
                <?php $userFollowersCount = getUserFollowerCount(Auth::user()->id); ?>
                @if($userFollowersCount > 1)
                  {{ $userFollowersCount }} Followers
                @else
                  {{ $userFollowersCount }} Follower
                @endif
              </a>                
            </div>
            <div class="clearfix"></div>
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
<script>
  $(document).ready( function(){

      $('.profile-menu-tab').click( function(e){
          e.preventDefault();
          
          var attr = $(this);
          var href = $(this).attr('href');

          if(href !== '/reviews/add'){
            $('.profile-menu-tab').removeClass('active-tab');
            attr.addClass('active-tab');
          }


          if(href === '/mytimeline'){
            window.location.href = href;
          } else {
              getContent(href);
          }
      });

      $('.profile-menu-tab2').click( function(e){
          e.preventDefault();
          var attr = $(this);
          var href = $(this).attr('href');
          getContent(href);
      });


      function getContent(url){
        $.ajax({
          url : url,
          type : 'GET',
          dataType : 'html',
          contentType: 'text/html; charset=utf-8',
          success : function (response){
            $('#content-tab').html(response);
          }
        });
      }
  });
</script>