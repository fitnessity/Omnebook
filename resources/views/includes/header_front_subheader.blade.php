@inject('request', 'Illuminate\Http\Request')
<style>
	li.dd-menu-li.create-com {
    cursor: pointer;
}
  .plus-btn{
    background: #d4f3ec;
    border: 0;
    border-radius: 100px;
    color: #179c96 !important;
    font-size: 24px !important;
    padding: 3px !important;
    height: 40px;
    width: 40px;
  }
  .plus-btn:hover, .plus-btn:focus{
    color: #fff!important;
  }
  .dd-menu{
    margin-left: -70px!important;
  }
  li.dd-menu-li {
    border-top: 1.5px solid #b1b0b075;
    width: 100%;
    padding: 4px 0px;
}
  .dd-menu-li:hover{
    background: #f53b49 !important;
    width: 100%;
    color: #fff !important;
    text-decoration: none !important;
    transition: 0.5s !important;
  }
  .dd-menu-li-heading{
    margin-left: 9px !important;
    padding: 5px !important;
    font-size: 17px !important;
  }
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

.loader {
       content: '';
display: block;
position: fixed;
left: 48%;
top: 40%;
width: 120px;
height: 120px;
border-style: solid;
border-color: #f53b49;
border-top-color: transparent;
border-width: 16px;
border-radius: 50%;
-webkit-animation: spin 2s linear infinite;
animation: spin 2s linear infinite;
z-index: 9999999;
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
        /*global $wpdb;
        $table = $wpdb->prefix.'users';
        $sql =  "SELECT * FROM {$table} WHERE user_login='{$email}' OR user_email='{$loggedinUser["email"]}'";
        $result = $wpdb->get_results($sql); 
        $id = $result[0]->ID;
        $username = $result[0]->user_login;
        $mainurl = "/buddy/members/".$username; */
		$mainurl="/buddy/members/";
		$username="";

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

<div class="loader" style="display:none"></div>
            
            

 <!-- Modal Start -->
    <div class="modal fade" id="CreateCompanyModal" role="dialog" style="max-height:80%;max-width:80%">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">

          </div>    
        </div>
    </div>
    <!--            </div>-->
    <!--        </div>-->
    <!--    </div>-->
    <!--</div>    -->
<!-- Modal Close-->
<!--<div class="modal fade" id="addService" style="overflow:auto;">-->
<!--        <div class="modal-dialog modal-lg">-->
<!--            <div id="systemMessage1"></div>-->
<!--            <div class="modal-content">-->
<!--            </div>-->
<!--        </div>-->
<!--</div>-->

<div class="col-md-9">
  <div class="profile-menu">
    <ul>
   
        <li><a href="/">HOME</a></li>

      @can('timeline_access')
       {{--<li><a href="javascript:void(0)" onclick="event.preventDefault(); put('{{url::to('buddy')}}'); ">SOCIAL FEED</a></li>--}}
       
      @endcan

      @can('profile_view_access')
        {{--<li><a href="javascript:void(0)" onclick="event.preventDefault();  put('{{url::to($mainurl.'/activity')}}'); ">MY TIMELINE</a></li>--}}
      @endcan

      @can('network_access')
      {{--  <li><a href="javascript:void(0)" onclick="event.preventDefault(); put('{{url::to($mainurl.'')}}'); ">MY NETWORK</a></li>
         <li><a href="javascript:void(0)" onclick="event.preventDefault(); put('{{url::to($mainurl.'/messages')}}'); ">MESSAGES</a></li>
          <li><a href="javascript:void(0)" onclick="event.preventDefault(); put('{{url::to($mainurl.'/notifications')}}'); ">NOTIFICATIONS</a></li>--}}
          	 <li><a href="/mybooking">MY BOOKING</a></li>
             	 <li><a href="/createmeeting">HOST MEETING</a></li>
             	 <li class="dropdown">
                   <a href="#" class="dropdown-toggle btn btn-info plus-btn" data-toggle="dropdown" role="button" aria-expanded="false">+</a>
                    <ul class="dropdown-menu dd-menu" role="menu">
                       <li class="dd-menu-li-heading" style="margin-left:10px;"><b>Fitnessity Business</b></li>
                       @if(Auth::user()->is_upgrade == 1 && Auth::user()->role == 'business')
                       <li class="dd-menu-li"><a href="#" id="switcAccount">Personal Profile</a></li>
                       @endif
                       <li class="dd-menu-li create-com"><a id="create_company_btn">Create Company +</a></li>
                       @if($company_count != 0)
                       <li class="dd-menu-li"><a id="mgco" href="#">Manage Company Profile</a></li>
                       @endif
                    </ul>
                </li>
      @endcan     
      
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
          <?php /*?><a href="{{wp_logout_url()}}" data-toggle="dropdown" class="dropdown-toggle dropdown-item w-100">Logout</a><?php */?>
          <a href="#" data-toggle="dropdown" class="dropdown-toggle dropdown-item w-100">Logout</a>
         </li>
      </ul>
      </li>
    <li>
 	<a href="/buddy/members/<?php echo $username;?>">
    <img alt="" src="https://fitnessity.co/==buddy/wp-content/plugins/buddyboss-platform/bp-core/images/mystery-man-50.jpg" srcset="https://fitnessity.co/buddy/wp-content/plugins/buddyboss-platform/bp-core/images/mystery-man-50.jpg 2x" class="avatar avatar-35 photo" loading="lazy" width="35" height="35">
	<?php //echo get_avatar($id , 35)?>
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
<!--  <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.css">-->
<!--<script src="//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.js" defer></script>-->

<script src="https://cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.js" defer></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Zebra_datepicker/1.9.15/zebra_datepicker.min.js" defer></script>
<script>
function put(r){
    $('#redirect_to').val(r);
    document.getElementById('buddyloginform').submit();
}


    $(document).ready(function(){
        console.log(window.location.href)
        if(window.location.href.includes('/profile/viewProfile?companyCreate=1')){
            console.log("if called")
            setTimeout(function(){
                $('#create_company_btn').click()
            },10)
            
        }
        
 /*       $(document).on('click','#markcalendar',function(){
            $('#mdp-demo').multiDatesPicker({
        	separator: ", "
            });
            $("#mdp-demo").multiDatesPicker("show");
            $("#mdp-demo").focus();
        });*/
        $('#create_company_btn').click(function(){
            console.log("runnnnnnnnnnn")
            var c_url = window.location.href
            console.log(c_url)
            if(!(c_url.includes('profile/viewProfile'))){
                console.log("else1")
                window.location.href = "{{'/profile/viewProfile?companyCreate=1'}}"
            }
            else{
                console.log("else")
               var phone =  "{{session('phone')}}";
               var myname =  "{{session('company_name')}}";
               var mybusinessid =  "{{session('business_id')}}";
               var mycity =  "{{session('city')}}";
               
              $.ajax({
              url:'/get_createcompanyform',
              type:'get',
              beforeSend: function () {
                 $('.loader').show();
              },
              complete: function () {
                 $('.loader').hide();
                 $.getScript("<?php echo Config::get('constants.FRONT_JS'); ?>ajax_request.js");
              },
              success: function (response) { 
                $('#CreateCompanyModal').html(response);
                $('#CreateCompanyModal').modal('show');
                $('.loader').hide();
                setTimeout(function(){
                    if(mybusinessid != null && mybusinessid != '' && mybusinessid != 'undefined'){
                        $('#mybusinessid').val(mybusinessid);
                        $('#b_city').val(mycity)
                        $('#b_city').prop( "disabled", true )
                    }
                    $('#b_companyname').val(myname)
                   
                   $('#b_contact').val(phone)
                },1000)
                //$('#CreateCompanyModal').modal('hide');
              }
            })
            }
          })
      $("#booklessonbtn").click(function(){
        //   setTimeout(function(){
        //      window.location.reload() 
        //   },2)
          
          $('#booklessonbtn').hide();
          $('#switcAccount').show();
      })
      
     $("#mgco").click(function(){ 
            formdata = new FormData();
            var token = '{{csrf_token()}}';
            formdata.append("_token",token)
            formdata.append("manage_company",'manage')
            $.ajax({
              url:'/profile/switchaccount',
              type:'POST',
              dataType: 'json',
              data:formdata,
              processData: false,
              contentType: false,
              headers: {'X-CSRF-TOKEN': $("#_token").val()},
              success: function (response) {
                  if(response.type === 'success'){
                     // $('#upgradeProfileForm').modal('hide'); 
                    window.location.href= "/manage/company";
                  }
                }
            });
        })
      
      $("#switcAccount").click(function(){
            formdata = new FormData();
            var token = '{{csrf_token()}}';
            formdata.append("_token",token)
            $.ajax({
              url:'/profile/switchaccount',
              type:'POST',
              dataType: 'json',
              data:formdata,
              processData: false,
              contentType: false,
              headers: {'X-CSRF-TOKEN': $("#_token").val()},
              success: function (response) {
                  if(response.type === 'success'){
                     // $('#upgradeProfileForm').modal('hide'); 
                    window.location.href= "/profile/viewProfile";
                  }
                }
            });
        })
    })
</script>
