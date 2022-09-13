@inject('request', 'Illuminate\Http\Request')
<style>
ul.tt li a {
    padding: 6px;
    color: #b3b3b3;
        text-decoration: none;
}
ul.tt li a img {
    border-radius: 28px;
}
ul.tt li {
    display: initial;
}
.dropdown-menu{
        top: 50px;
    right: inherit;
    margin-left: 110px;
}
.dropdown-submenu {
    position: relative;
    
}
ul.tt li a i {
    font-size: 22px;
    color: #fff;
}

.dropdown-submenu>.dropdown-menu {
    top: 0;
    left: -160px;
    margin-top: -6px;
    margin-left: 1px;
    -webkit-border-radius: 6px 6px 6px 6px;
    -moz-border-radius: 6px 6px 6px;
    border-radius: 6px 6px 6px 6px;
}

.dropdown-submenu:hover>.dropdown-menu {
    display: block;
}



.dropdown-submenu.pull-left {
    float: none;
}

.dropdown-submenu.pull-left>.dropdown-menu {
    left: 100%;
    margin-left: 10px;
    -webkit-border-radius: 6px 0 6px 6px;
    -moz-border-radius: 6px 0 6px 6px;
    border-radius: 6px 0 6px 6px;
}

</style>
<?php 

 $loggedinUser = Auth::user();
        $email = $loggedinUser['email'];
        $email = substr($email, 0, strpos($email, "@"));
        global $wpdb;
        $table = $wpdb->prefix.'users';
        $sql =  "SELECT * FROM {$table} WHERE user_login='{$email}' OR user_email='{$loggedinUser["email"]}'";
        $result = $wpdb->get_results($sql); 
        $id = $result[0]->ID;
        $username = $result[0]->user_login;
        $mainurl = "/buddy/members/".$username;
?>

<div class="profile-header">

<?php $loggedinUser = Auth::user(); ?>

<?php 
$networks =  App\UserNetwork::select('*')
                            ->where('friend_id',  Auth::user()->id)
                            ->with('user')
                            ->where('status', 'requested')
                            ->get()
                            ->toArray();

?>
<div class="col-md-9">
  <div class="profile-menu">

    <ul>
   
        <li><a href="/timeline">HOME</a></li>

      @can('timeline_access')
        <li><a href="/mytimeline">ACTIVITY FEED</a></li>
      @endcan

      @can('profile_view_access')
        <li><a href="/profile/viewProfile">MY TIMELINE</a></li>
      @endcan

      @can('network_access')
        <li><a href="/network/mynetwork">MY NETWORK</a></li>
         <li><a href="{{$mainurl}}/messages">MESSAGES</a></li>
          <li><a href="{{$mainurl}}/notifications">NOTIFICATIONS</a></li>
          	 <li><a href="/mybooking">MY BOOKING</a></li>
             	
      @endcan     
       <li><a href="/createmeeting">MEET UP</a></li>
    </ul>


  </div>
</div>
<div class="col-md-3">
  <div class="myclass" style="margin-top: 10px;float: right;">
  <ul class="tt" style="list-style-type:none">
  <li>
 <a href="/buddy/members/<?php echo $username;?>">
  <span class=""><?php echo $username; ?></span><i class="bb-icon-angle-down"></i>
  </a>
  
  </li>

    <li>
      <a href="{{$mainurl}}" type="button" id="dropdown" data-toggle="dropdown" class="dropdown multi-level-dropdown"
      aria-haspopup="true" aria-expanded="false"><i class="fa fa-caret-down"></i></a>
      <ul  style = "list-style-type:none"class="dropdown-menu mt-2 rounded-0 white border-0 z-depth-1">
        <li class="dropdown-item dropdown-submenu p-0">
          <a href="{{$mainurl}}/profile" data-toggle="dropdown" class="dropdown-toggle dropdown-item w-100">Profile</a>
          <ul class="dropdown-menu  rounded-0 white border-0 z-depth-1">
            <li class="dropdown-item p-0">
              <a href="{{$mainurl}}/profile/" class="dropdown-item w-100">Veiw</a>
            </li>
            <li class="dropdown-item p-0">
              <a href="{{$mainurl}}/profile/edit" class="dropdown-item w-100">Edit</a>
            </li>
            <li class="dropdown-item p-0">
              <a href="{{$mainurl}}/profile/change-avatar" class="dropdown-item w-100">Profile Photo</a>
            </li>
            <li class="dropdown-item p-0">
              <a href="{{$mainurl}}/profile/change-cover-image" class="dropdown-item w-100">Cover Photo</a>
            </li>
          </ul>
        </li>
        <li class="dropdown-item dropdown-submenu p-0">
          <a href="{{$mainurl}}/settings" data-toggle="dropdown" class="dropdown-toggle dropdown-item w-100">Account</a>
          <ul class="dropdown-menu  rounded-0 white border-0 z-depth-1">
            <li class="dropdown-item p-0">
              <a href="{{$mainurl}}/settings/" class="dropdown-item w-100">Login Information</a>
            </li>
            <li class="dropdown-item p-0">
              <a href="{{$mainurl}}/settings/notifications" class="dropdown-item w-100">Email Preferences</a>
            </li>
            <li class="dropdown-item p-0">
              <a href="{{$mainurl}}/settings/profile" class="dropdown-item w-100">Privacy</a>
            </li>
            <li class="dropdown-item p-0">
              <a href="{{$mainurl}}/settings/export" class="dropdown-item w-100">Export Data</a>
            </li>
            <li class="dropdown-item p-0">
              <a href="{{$mainurl}}/settings/delete-account" class="dropdown-item w-100">Delete Account</a>
            </li>
          </ul>
        </li>
        <li class="dropdown-item dropdown-submenu p-0">
          <a href="{{$mainurl}}/activity" data-toggle="dropdown" class="dropdown-toggle dropdown-item w-100">Timeline</a>
          <ul class="dropdown-menu  rounded-0 white border-0 z-depth-1">
            <li class="dropdown-item p-0">
              <a href="{{$mainurl}}/activity/" class="dropdown-item w-100">Personal</a>
            </li>
            <li class="dropdown-item p-0">
              <a href="{{$mainurl}}/activity/favorites" class="dropdown-item w-100">Likes</a>
            </li>
            <li class="dropdown-item p-0">
              <a href="{{$mainurl}}/activity/friends" class="dropdown-item w-100">Connections</a>
            </li>
            <li class="dropdown-item p-0">
              <a href="{{$mainurl}}/activity/groups" class="dropdown-item w-100">Groups</a>
            </li>
             <li class="dropdown-item p-0">
              <a href="{{$mainurl}}/activity/mentions" class="dropdown-item w-100">Mentions</a>
            </li>
            <li class="dropdown-item p-0">
              <a href="{{$mainurl}}/activity/following" class="dropdown-item w-100">Following</a>
            </li>
          </ul>
        </li>
        <li class="dropdown-item dropdown-submenu p-0">
          <a href="{{$mainurl}}/notifications" data-toggle="dropdown" class="dropdown-toggle dropdown-item w-100">Notifications</a>
          <ul class="dropdown-menu  rounded-0 white border-0 z-depth-1">
            <li class="dropdown-item p-0">
              <a href="{{$mainurl}}/notifications/read" class="dropdown-item w-100">Read</a>
            </li>
            <li class="dropdown-item p-0">
              <a href="{{$mainurl}}/notifications/" class="dropdown-item w-100">Unread</a>
            </li>
          </ul>
        </li>
        <li class="dropdown-item dropdown-submenu p-0">
          <a href="{{$mainurl}}/messages" data-toggle="dropdown" class="dropdown-toggle dropdown-item w-100">Messages</a>
          <ul class="dropdown-menu  rounded-0 white border-0 z-depth-1">
            <li class="dropdown-item p-0">
              <a href="{{$mainurl}}/messages/" class="dropdown-item w-100">Messages</a>
            </li>
            <li class="dropdown-item p-0">
              <a href="{{$mainurl}}/messages/compose" class="dropdown-item w-100">New Messages</a>
            </li>
            
          </ul>
        </li>
        <li class="dropdown-item dropdown-submenu p-0">
          <a href="{{$mainurl}}/friends" data-toggle="dropdown" class="dropdown-toggle dropdown-item w-100">Connections</a>
          <ul class="dropdown-menu  rounded-0 white border-0 z-depth-1">
            <li class="dropdown-item p-0">
              <a href="{{$mainurl}}/friends" class="dropdown-item w-100">My Connections</a>
            </li>
            <li class="dropdown-item p-0">
              <a href="{{$mainurl}}/friends/requests" class="dropdown-item w-100">Pending Request</a>
            </li>
          </ul>
        </li>
        <li class="dropdown-item dropdown-submenu p-0">
          <a href="{{$mainurl}}/groups/" data-toggle="dropdown" class="dropdown-toggle dropdown-item w-100">Groups</a>
          <ul class="dropdown-menu  rounded-0 white border-0 z-depth-1">
            <li class="dropdown-item p-0">
              <a href="{{$mainurl}}/groups/" class="dropdown-item w-100">My Groups</a>
            </li>
            <li class="dropdown-item p-0">
              <a href="{{$mainurl}}/groups/invites" class="dropdown-item w-100">No Pending invites  </a>
            </li>
            <li class="dropdown-item p-0">
              <a href="{{$mainurl}}/groups/create" class="dropdown-item w-100">Create Groups</a>
            </li>
          </ul>
        </li>
        <li class="dropdown-item dropdown-submenu p-0">
          <a href="{{$mainurl}}forums/" data-toggle="dropdown" class="dropdown-toggle dropdown-item w-100">Forums</a>
          <ul class="dropdown-menu  rounded-0 white border-0 z-depth-1">
            <li class="dropdown-item p-0">
              <a href="{{$mainurl}}forums/topics" class="dropdown-item w-100">My Discussions</a>
            </li>
            <li class="dropdown-item p-0">
              <a href="{{$mainurl}}forums/replies" class="dropdown-item w-100">My Replies</a>
            </li>
            <li class="dropdown-item p-0">
              <a href="{{$mainurl}}forums/favorites" class="dropdown-item w-100">My Favorites</a>
            </li>
            <li class="dropdown-item p-0">
              <a href="{{$mainurl}}forums/subscriptions" class="dropdown-item w-100">Subscriptions</a>
            </li>
          </ul>
        </li>
        <li class="dropdown-item dropdown-submenu p-0">
          <a href="{{$mainurl}}/photos" data-toggle="dropdown" class="dropdown-toggle dropdown-item w-100">Photos</a>
          <ul class="dropdown-menu  rounded-0 white border-0 z-depth-1">
            <li class="dropdown-item p-0">
              <a href="{{$mainurl}}/photos" class="dropdown-item w-100">My Photo</a>
            </li>
            <li class="dropdown-item p-0">
              <a href="{{$mainurl}}/photos/albums" class="dropdown-item w-100">My Albums</a>
            </li>
          </ul>
        </li>
        <li class="dropdown-item dropdown-submenu p-0">
          <a href="{{$mainurl}}/invites/" data-toggle="dropdown" class="dropdown-toggle dropdown-item w-100">Email Invites</a>
          <ul class="dropdown-menu  rounded-0 white border-0 z-depth-1">
            <li class="dropdown-item p-0">
              <a href="{{$mainurl}}/invites/" class="dropdown-item w-100">Send Invites</a>
            </li>
            <li class="dropdown-item p-0">
              <a href="{{$mainurl}}/invites/sent-invites" class="dropdown-item w-100">Sent Invites</a>
            </li>
          </ul>
        </li>
        <li class="dropdown-item dropdown-submenu p-0">
          <a href="{{wp_logout_url()}}" data-toggle="dropdown" class="dropdown-toggle dropdown-item w-100">Logout</a>
         </li>
      </ul>
      </li>
    <li>
 <a href="/buddy/members/<?php echo $username;?>">
<?php echo get_avatar($id , 35)?>
  </a>
  </li>
    <li class="dropdown-item dropdown-submenu p-0">
  <a href="javascript:void()" class="clsbtn"><i class="fa fa-search"></i></a>
  </li>
  <li class="dropdown-item dropdown-submenu p-0">
  <a href="{{$mainurl}}/messages/"><i class="fa fa-inbox"></i></a>
  </li>
  <li class="dropdown-item dropdown-submenu p-0">
  <a href="{{$mainurl}}/notifications"><i class="fa fa-bell-o" aria-hidden="true"></i></a>
  </li>
    </ul>
  </div>
</div>
</div>

<script>

$('.multi-level-dropdown .dropdown-submenu > a').on("mouseenter", function(e) {
    var submenu = $(this);
    $('.multi-level-dropdown .dropdown-submenu .dropdown-menu').removeClass('show');
    submenu.next('.dropdown-menu').addClass('show');
    e.stopPropagation();
  });

  $('.multi-level-dropdown .dropdown').on("hidden.bs.dropdown", function() {
    // hide any open menus when parent closes
    $('.multi-level-dropdown .dropdown-menu.show').removeClass('show');
  });
   $('.clsbtn').click(function(){
$('.search').toggle();
});
</script>
