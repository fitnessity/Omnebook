@extends('layouts.header')
@section('content')

<link rel="shortcut icon" href="{{ url('public/img/favicon.png') }}">

<!--<link rel="stylesheet" type="text/css" href="{{ url('public/css/bootstrap.css') }}">-->
<link rel="stylesheet" type="text/css" href="{{ url('public/css/all.css') }}">
<link rel="stylesheet" type="text/css" href="{{ url('public/css/metismenu.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ url('public/css/fullcalendar.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ url('public/css/profile.css') }}">
<?php
use App\User;
?>
<div class="page-wrapper inner_top" id="wrapper">
    <div class="page-container">
        <!-- Left Sidebar Start -->
        @include('personal-profile.left_panel')
        <!-- Left Sidebar End -->
        <div class="page-content-wrapper">
            <div class="content-page">
                <div class="container-fluid">
                    <div class="page-title-box">
                        <h4 class="page-title">Following</h4>
                    </div>
                    <div class="followers_section padding-1 white-bg border-radius1">
                        <?php 
                        if(isset($FollowDetail)) {
							foreach ($FollowDetail as $data) {
								$logo='';
								$queryUser = User::select("firstname", "lastname", "profile_pic", "id","created_at")
								->where("id", $data['follower_id'])
								->first();
								$logo=$queryUser["profile_pic"];
							?>
                                <div class="followers-block">
                                    <div class="followers-content">
                                        <?php
                                        	if(File::exists(public_path("/uploads/profile_pic/thumb/".$logo )))
											{
												echo '<div class="admin-img">';
                                                echo '<img src="/public/uploads/profile_pic/thumb/'.$logo.'" alt="Fitnessity">';
											}
											else
											{
												echo '<div class="admin-img-text">';
												$pf=substr($queryUser["firstname"], 0, 1).substr($queryUser["lastname"], 0, 1);
												echo '<p>'.$pf.'</p>';
											}
										?>
                                        </div>
                                        <div class="followers-right-content">
                                            <h5> <?php  echo $queryUser["firstname"] . " ".$queryUser['lastname'] ;?> </h5>
                                            <ul>
                                                <li><span>Follower</span> 1</li>
                                                <li><span>Member Since</span> 
												<?php echo date('F Y',strtotime($queryUser['created_at'])); ?> </li>
                                                <li><span>Following</span> 2</li>
                                                
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="followers-button">
                                        <a href="#" class="following-btn unfollow" id="<?php  echo $queryUser['id']; ?>">Unfollow</a>
                                    </div>
        
                                </div>
							<?php 
							}
						} else {
						?>
                            <div class="pr-submit-bg text-center">
                                <p>You are not following anyone yet. Visit any profile and follow your favorite profiles.</p>
                                <div class="btn btn-submit" onclick="location.href='/instant-hire'"> Following </div>
                            </div>
						<?php
						} ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@include('layouts.footer')

<?php /*?><script src="{{ url('public/js/jquery-3.3.1.slim.min.js') }}"></script><?php */?>

<script src="{{ url('public/js/bootstrap.min.js') }}"></script>
<script src="{{ url('public/js/metisMenu.min.js') }}"></script>
<script src="{{ url('public/js/jquery.slimscroll.js') }}"></script>
<script src="{{ url('public/js/moment.min.js') }}"></script>
<script src="{{ url('public/js/fullcalendar.min.js') }}"></script>
<script src="{{ url('public/js/jquery.fullcalendar.js') }}"></script>
<script src="{{ url('public/js/custom.js') }}"></script>
<script type="text/javascript">

$(".unfollow").click(function(){

    var _token = $("input[name='_token']").val();
    var fid = $(this).attr('id');
    $.ajax({
        type: 'POST',
        url: '{{route("unfollow_company")}}',
        data: {
          "_token": "{{ csrf_token() }}",
          fid:fid
        },
        success: function(data) {
          window.location.reload();
        }
    });
});

</script>

@endsection