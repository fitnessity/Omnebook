<?php 
	use App\User;
	use App\PagePost;
	use App\BusinessServices;
	use App\PageLike;
	use Carbon\Carbon;
	use App\UserBookingDetail;
	
	$userData = User::where('id',$company->user_id)->first();
	$totpost = PagePost::where('user_id', $company->user_id)->where('page_id', request()->page_id)->count();
	$FollowingThisweek = PageLike::where('pageid', request()->id)->whereBetween('created_at', 
[Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->get();
	$totFollowers = PageLike::where('pageid', request()->id)->count();

	$current_data  = UserBookingDetail::get();
	$i = 0;
	foreach ($current_data as $key => $value) {
	    $serviceid = $value->sport;
	    $getdata = BusinessServices::where('id',$serviceid)->first();
	    if($getdata != ''){
	    	if($getdata->cid == $company->id ){
	      		$i++;
	    	}
	    }
	}
	$totalbookings = $i;
	$business_usre_name= '—';
	if(@$company->business_user_tag != ''){
		$business_usre_name = "@".$company->business_user_tag;
	}
?>

<?php /*?><div class="widget">
				<h4 class="widget-title">User Badges <a class="see-all" href="#" title="">See All</a></h4>
					<ul class="badgez-widget">
						<li>
							<a href="#" title="Male User" data-toggle="tooltip"><img src="/images/badges/badge2.png" alt=""></a>
						</li>
						<li>
							<a href="#" title="Earned $5000+" data-toggle="tooltip"><img src="/images/badges/badge12.png" alt=""></a>
						</li>
						<li>
							<a href="#" title="10 Years old User" data-toggle="tooltip"><img src="/images/badges/year10.png" alt=""></a>
						</li>
						<li>
							<a href="#" title="Page Admin" data-toggle="tooltip"><img src="/images/badges/badge1.png" alt=""></a>
						</li>
						<li>
							<a href="#" title="100+ Refferal" data-toggle="tooltip"><img src="/images/badges/badge8.png" alt=""></a>
						</li>
						<li>
							<a href="#" title="Tranding Posts" data-toggle="tooltip"><img src="/images/badges/badge21.png" alt=""></a>
						</li>
						<li>
							<a href="#" title="1000+ Subscribers" data-toggle="tooltip"><img src="/images/badges/badge3.png" alt=""></a>
						</li>
						<li>
							<a href="#" title="fitness Shirt winner" data-toggle="tooltip"><img src="/images/badges/badge20.png" alt=""></a>
						</li>
						<li>
							<a href="#" title="500+ Followers" data-toggle="tooltip"><img src="/images/badges/badge10.png" alt=""></a>
						</li>
					</ul>
</div><?php */?><!-- widget -->

<div class="widget">			
	<h4 class="widget-title">Profile Intro</h4>
	<div class="row">
		<div class="col-sm-12 col-md-12 col-lg-12">
			<div class="wid-sp">
				<h4 class="widget-dt">Details</h4>
			</div>&nbsp;
		</div>
	</div>
    <div class="row">
    	<div class="col-sm-12 col-md-12 col-lg-12">
			<div class="wid-sp">
				<b> Username: </b> {{$business_usre_name}}
			</div>
		</div>
	</div>
    <div class="row">
    	<div class="col-sm-12 col-md-12 col-lg-12">
			<div class="wid-sp">
				<div class="pro-intro">
					<b> Member Since: </b> <p><?php echo date('m/y', strtotime($company->created_at) ); ?></p>
				</div>
			</div>
		</div>
	</div>
    <div class="row">
    	<div class="col-sm-12 col-md-12 col-lg-12">
    		<?php 
    		$country = '';
    		if($company->country == 'usa' || $company->country == 'USA' || $company->country == 'United States' || $company->country == 'US' || $company->country == ''){
    			$country = 'United States';
    		} ?>
			<div class="wid-sp img-bot">
				<img src="https://upload.wikimedia.org/wikipedia/en/a/a4/Flag_of_the_United_States.svg" alt="images" class="img-fluid" width="25" height="15">
				{{ $country }}
			</div>
            <?php
				$activity = BusinessServices::where('cid',request()->page_id)->get();
				if(count($activity) >0){
			?>
			<div class="border-wid-sp"><div class="border-wid"></div></div>
			<div class="wid-sp">
				<h4 class="widget-dt">Other Activities Offered</h4> &nbsp;
                <p>
                <?php $i=1; foreach($activity as $act) { 
					if($i!=1){ echo ' - '; } echo $act['sport_activity']; $i++;
				} ?>
                </p>
			</div>
			<div class="border-wid-sp"><div class="border-wid"></div></div>
            <?php } ?>
			<?php /* Comment by Purvi ?><div class="wid-sp">
				<h4 class="widget-dt">Favorite Workout Music</h4>&nbsp;
				<div class="spoti-dis">
					<img src="/images/newimage/spotify.png" alt="images" class="img-fluid" width="20" height="12" />
					<p>Spotify Play List</p>
					<label>View List</label>
				</div>
			</div><?php */?>
		</div>
	</div> 
</div>    

<div class="widget">
	<h4 class="widget-title"></h4> 
	<div class="your-page">
        <figure>
            <?php if(File::exists(public_path("/uploads/profile_pic/thumb/".$userData['profile_pic'] ))){ ?>
                <img src="{{ url('/public/uploads/profile_pic/thumb/'.$userData['profile_pic']) }}" alt="Fitnessity">
            <?php }else{ 
                $pf=substr($userData['firstname'], 0, 1).substr($userData['lastname'], 0, 1);
                echo '<div class="youpage-img-text"><p>'.$pf.'</p></div>';
            } ?>
        </figure>
        <div class="page-meta">
            <a href="#" title="" class="underline">{{$customerName}}</a>
            <?php /*?><span><i class="far fa-comment-alt"></i><a href="#" title="">Messages </a></span>
            <span><i class="far fa-bell"></i><a href="#" title="">Notifications </a></span><?php */?>
        </div>
        <ul class="page-publishes">
            <?php /*?><li>
                <span><i class="fa fa-user-circle"></i>Profile Views</span><br>
                <span>1.3m </span>
            </li><?php */?>
            <li>
                <span><i class="fa fa-mobile"></i>Post</span><br>
                <span><?php echo $totpost; ?></span>
            </li>
           <?php /*?> <li>
                <span><i class="fa fa-thumbs-up"></i>Reviewed</span><br>
                <span>350</span>
            </li><?php */?>
            <li>
                <span><i class="fa fa-calendar"></i>Bookings Made</span><br>
                <span>{{$totalbookings}}</span>
            </li>
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
									->where("id", $weekf->follower_id)->first(); ?>
                                    <a href="{{ Config::get('constants.SITE_URL') }}/userprofile/{{ $queryUser->username}}" title="{{ $queryUser->username }}" data-toggle="tooltip">
                                    	<?php 
										if(File::exists(public_path("/uploads/profile_pic/thumb/".$queryUser->profile_pic ))){ ?>
                                        	<img src="{{ url('/public/uploads/profile_pic/thumb/'.$queryUser->profile_pic) }}" alt="Fitnessity">
                                        <?php } else { 
											$pf=substr($queryUser->firstname, 0, 1).substr($queryUser->lastname, 0, 1);
											echo '<div class="admin-img-text"><p>'.$pf.'</p></div>';
										} ?>
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
 
    <div class="row">
    	<div class="col-sm-12 col-md-12 col-lg-12">
			<div class="box-red">
				<h1 class="red-box-font">VERIFICATION</h1>
				<div class="veri-icon-new-1">
                	<?php $mapadd='';
						if($company->address!=''){ $mapadd .=$company->address; }
						if($company->city!=''){ $mapadd .=', '.$company->city; }
						if($company->state!=''){ $mapadd .=', '.$company->state; }
						if($company->country!=''){ $mapadd .=', '.$company->country; }
					?>
					<span>
                    	<a href="{{'tel:'.$company->contact_number}}" title="phone" class="cophone"><i class="fas fa-phone-alt"></i></a>
					</span>
					<span>
                    	<a href="{{'mailto:'.$company->email}}" title="email"  class="coemail"><i class="fa fa-envelope" aria-hidden="true"></i></a>
					</span>
					@if($compinfo->website != '')
					<?php 
						if(strpos($compinfo->website, "http") !== false)
						   $website = $compinfo->website;
						else
						    $website = 'https://'.$compinfo->website;
					?>
					<span>
                    	<a href="{{ $website }}" title="link" target="_blank" class=""><i class="fa fa-link" aria-hidden="true"></i></a>
					</span> 
					@endif
                    <?php if($mapadd!=''){ ?>
					<span>
                    	<a href="{{'http://maps.google.com/?q='.$company->address}}" title="address" class="coaddress" target="_blank"><i class="fas fa-map-marker-alt"></i></a>
					</span>
                    <?php } ?>
				</div>
                <!--<img src="/public/img/verification.png" />-->
			</div>
		</div>
	</div>
    
     
 