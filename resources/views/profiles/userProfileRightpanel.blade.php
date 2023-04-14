<?php
	use App\UserFollow;
	use App\User;
	use App\CompanyInformation;
	use App\ProfilePost;
	use App\Getstarted;
	use App\Bookactivity;
	use Carbon\Carbon;
	use App\UserBookingDetail;
	use App\BusinessServices;
	
	$totpost = ProfilePost::where('user_id', Auth::user()->id)->count();
	$FollowingThisweek = UserFollow::where('follower_id', @$loggedinUser->id)->whereBetween('created_at', 
[Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->get();

	
?>

<div class="right-box">
	<div class="static hide">
    	<h5><i class="far fa-bookmark mr-2"></i> Statistic </h5>
		<div class="static-soc">
        	<ul>
            	<li><a href="#"><i class="far fa-eye mr-2"></i> 0 Views </a></li>
				<li><a href="#"><i class="far fa-star mr-2"></i> 0 Ratings </a></li>
				<li><a href="#"><i class="far fa-heart mr-2"></i> 0 Favorites</a></li>
				<li><a href="#"><i class="fas fa-share mr-2"></i> 0 Shares </a></li>
			</ul>
		</div>
	</div>
    <div class="widget mdisplay-none">
    	<h4 class="widget-title">Your page</h4> 
		<div class="your-page">
        	<figure>
            	<?php if(File::exists(public_path("/uploads/profile_pic/thumb/".@$loggedinUser->profile_pic ))){ ?>
					<img src="{{ url('/public/uploads/profile_pic/thumb/'.@$loggedinUser->profile_pic) }}" alt="Fitnessity">
                <?php }else{ 
					$pf=substr(@$loggedinUser->firstname, 0, 1).substr(@$loggedinUser->lastname, 0, 1);
					echo '<div class="youpage-img-text"><p>'.$pf.'</p></div>';
				} ?>
			</figure>
            <div class="page-meta">
            	<a href="#" title="" class="underline">{{$customerName}}</a>
				<?php /*?><span><i class="far fa-comment-alt"></i><a href="#" title="">Messages </a></span>
				<span><i class="far fa-bell"></i><a href="#" title="">Notifications </a></span><?php */?>
			</div>
            <ul class="page-publishes">
            	<!--<li>
                	<span><i class="fa fa-user-circle"></i>Profile Views</span>
					<span>1.3m </span>
				</li>-->
                <li>
                	<span><i class="fa fa-mobile"></i>Post</span><br>
					<span><?php echo $totpost; ?></span>
				</li>
                <!--<li>
                	<span><i class="fa fa-thumbs-up"></i>Reviewed</span><br>
					<span>350</span>
                </li>
                <li>
                	<span><i class="fa fa-calendar"></i>Bookings Made</span>
					<span>246</span>
				</li>-->
			</ul>
            <div class="page-likes">
            	<ul class="nav nav-tabs likes-btn">
                	<li class="nav-item active"><a class="" href="#page_like" data-toggle="tab" data-ripple="">likes</a></li>
					<?php /*?><li class="nav-item"><a class="" href="#page_view" data-toggle="tab" data-ripple="">views</a></li><?php */?>
				</ul>
                <div class="tab-content">
                	<div class="tab-pane active in fade" id="page_like" >
						<span><i class="fa fa-heart-o"></i>{{ $totFollowers }}</span>
						<a href="#" title="weekly-likes">{{ count($FollowingThisweek) }} new likes this week</a>
						<div class="users-thumb-list">
                        	@foreach($FollowingThisweek as $weekf)
                            	<?php $queryUser = User::select("firstname", "lastname", "username", "profile_pic", "id")
									->where("id", $weekf->user_id)->first(); ?>
                            	<a href="{{ Config::get('constants.SITE_URL') }}/userprofile/{{ @$queryUser->username}}" 
                                title="{{ @$queryUser->username}}" data-toggle="tooltip">
                                	<?php 
									
									if(File::exists(public_path("/uploads/profile_pic/thumb/".@$queryUser->profile_pic ))){ ?>
                                    	<img src="{{ url('public/images/newimage/userlist-1.jpg') }}" alt="">  
                                    <?php }else { 
                                    	$pf=substr(@$queryUser->firstname, 0, 1).substr(@$queryUser->lastname, 0, 1);
										echo '<div class="admin-img-text"><p>'.$pf.'</p></div>';
                                    }?>
                                </a>
                            @endforeach
						</div>
					</div>
                    <div class="tab-pane fade" id="page_view" >
                    	<span><i class="fa fa-eye"></i>440</span>
						<a href="#" title="weekly-likes">440 new views this week</a>
						<div class="users-thumb-list">
                        	<a href="#" title="Anderw" data-toggle="tooltip">
								<img src="{{ url('public//images/newimage/userlist-1.jpg') }}" alt="">  
							</a>
                            <a href="#" title="frank" data-toggle="tooltip">
								<img src="{{ url('public/images/newimage/userlist-2.jpg') }}" alt="">  
							</a>
                            <a href="#" title="Sara" data-toggle="tooltip">
								<img src="{{ url('public/images/newimage/userlist-3.jpg') }}" alt="">  
							</a>
                            <a href="#" title="Amy" data-toggle="tooltip">
								<img src="{{ url('public/images/newimage/userlist-4.jpg') }}" alt="">  
							</a>
                            <a href="#" title="Ema" data-toggle="tooltip">
								<img src="{{ url('public/images/newimage/userlist-5.jpg') }}" alt="">  
							</a>
                            <a href="#" title="Sophie" data-toggle="tooltip">
								<img src="{{ url('public/images/newimage/userlist-6.jpg') }}" alt="">  
							</a>
                            <a href="#" title="Maria" data-toggle="tooltip">
								<img src="{{ url('public/images/newimage/userlist-7.jpg') }}" alt="">  
							</a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div><!-- page like widget -->
    <div class="widget-follower stick-widget mdisplay-none" style="">
		<h4 class="widget-title">Who's following</h4>
		<?php
			$following = UserFollow::select("user_id", "follow_id", "follower_id")
			->where("follower_id", "=", Auth::user()->id)->orderBy('id','desc')->limit(6)
			->get();
												
			if(isset($following)) { ?>
            	<ul class="followers ps-container ps-theme-default ps-active-y" id="myfollowers">
					<?php foreach ($following as $follow) { 
						$logo='';
						$queryUser = User::select("firstname", "lastname", "profile_pic", "id","created_at")->where("id", $follow['user_id'])->first();
						$followpic=@$queryUser["profile_pic"];
						$querycomp = CompanyInformation::select("first_name", "last_name", "logo", "user_id", "id")->where("user_id", $follow['user_id'])->first();
						$compid = isset($querycomp["id"]) ? $querycomp["id"] : "0";
						$isfollow = UserFollow::select("user_id", "follow_id", "follower_id")
						->where("follower_id", "=", @$queryUser['id'])
						->get();
					?>
                    <li>
                    	<?php
						if(File::exists(public_path("/uploads/profile_pic/thumb/".$followpic )))
						{ ?>
                        	<figure><img src="/public/uploads/profile_pic/thumb/<?php echo $followpic; ?>" alt="fitnessity"></figure>
						<?php }else{ 
							$pf=substr(@$queryUser["firstname"], 0, 1).substr(@$queryUser["lastname"], 0, 1);
						?>
                        	<div class="admin-img-text"><p><?php echo $pf; ?></p></div>
						<?php } ?>
                        <div class="friend-meta">
                        	<h4><a href="#"><?php  echo @$queryUser["firstname"] . " ".@$queryUser['lastname'] ;?></a></h4>
							<?php
							if ($isfollow->count()>0) { echo 'Following'; } 
							else { ?>
                            	<a class="underline followback" id="<?php echo $compid; ?>" data-user="<?php echo $follow['user_id']; ?>">Follow</a>
                            <?php } ?>
						</div>
					</li>
                    <?php } ?>
				</ul>
            <?php } ?>
	</div><!-- who's following -->
	<?php
		$getstarted = Getstarted::inRandomOrder()->limit(1)->get();
		foreach($getstarted as $start){
	?>
    	@if(File::exists(public_path("/uploads/getstarted/thumb/".$start->image)))
			<div class="get-started mdisplay-none">
            	<div class="get-img"><img src="{{ url('/public/uploads/getstarted/thumb/'.$start->image) }}" alt="{{$start->title}}" class="img-fluid"></div>
                @if ($start->title !='')
                	<div class="get-text">{{$start->title}}</div>
                @endif
                <div class="get-btn-box">
                	<a href="{{ Config::get('constants.SITE_URL') }}/activities" class="get-btn"> Get Started </a>
                </div>
			</div>
		@endif
        <?php } ?>
        <?php
        	$bookact = Bookactivity::inRandomOrder()->limit(1)->get();
			foreach($bookact as $bc){
		?>
            @if(File::exists(public_path("/uploads/book/thumb/".$bc->image)))
                <div class="ad-img mdisplay-none">
                    <img src="{{ url('/public/uploads/book/thumb/'.$bc->image) }}" alt="images" class="img-fluid">
                </div>
            @endif
		<?php } ?>
    
</div>

