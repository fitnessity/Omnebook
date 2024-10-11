  <?php
    $currentPath = explode("/", Request::path());
  ?>
	<div class="business-title">
      <h1>WELCOME TO FITNESSITY</h1>
      <p>Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. 

        Vestibulum tortor quam, feugiat vitae, ultricies eget, tempor sit amet, ante.</p>
    </div>

    <div class="business-menu">
        <ul>
          <li><a href="javascript::void(0);" id="userfollowers" class="active-tab">My Followers</a></li>
          <li><a href="javascript::void(0);" id="userfollowings" class="">Followings</a></li>
        </ul>
    </div>

<script>
  $(document).ready( function(){
    getpendingNetworkRcvTabContent();


    $('#userfollowings').click( function(){
      $(this).addClass('active-tab');
      $('#userfollowers').removeClass('active-tab');
        getpendingNetworkSentTabContent();
    });

    $('#userfollowers').click( function(){
      $(this).addClass('active-tab');
      $('#userfollowings').removeClass('active-tab');
        getpendingNetworkRcvTabContent();
    });

    function getpendingNetworkRcvTabContent() {
      $.ajax({
              url:'/network/followers',
              type:'GET',
              data:{},
              beforeSend: function () {
                $("#follow-content").html('');
              },
              complete: function () {
              },
              success: function (response) {
                $("#follow-content").html(response);
              }
            });
    }

    function getpendingNetworkSentTabContent() {
      $.ajax({
              url:'/network/followings',
              type:'GET',
              data:{},
              beforeSend: function () {
                $("#follow-content").html('');
              },
              complete: function () {
              },
              success: function (response) {
                $("#follow-content").html(response);
              }
            });
    }

  });

</script>