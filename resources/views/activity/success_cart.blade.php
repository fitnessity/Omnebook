@inject('request', 'Illuminate\Http\Request')
@extends('layouts.header')
@section('content')

<?php 
													 
use App\BusinessActivityScheduler;
use App\BusinessPriceDetails;
use App\BusinessServiceReview;
use App\BusinessServicesFavorite;

$total_quantity=0;
 $item_price=0;
if(!empty($cart["cart_item"])) {
    foreach($cart['cart_item'] as $item){
        $total_quantity = count($cart["cart_item"]);
        $item_price = $item_price + $item["totalprice"];
    }
    $cartdata = $cart['cart_item'][$pid];
    $totalprice = $cart['cart_item'][$pid]['totalprice'];
    if ($cart['cart_item'][$pid]['image']!="") {
    	if (File::exists(public_path("/uploads/profile_pic/thumb/" . $cart['cart_item'][$pid]['image']))) {
    			$profilePicact = url('/public/uploads/profile_pic/thumb/' . $cart['cart_item'][$pid]['image']);
    	} else {
    			$profilePicact = url('/public/images/service-nofound.jpg');
    	}
    }else{ $profilePicact = url('/public/images/service-nofound.jpg'); }

    $bookschedulercart = BusinessActivityScheduler::where('id', $cartdata["actscheduleid"])->limit(1)->orderBy('id', 'ASC')->first();
    $timecart = $tot_dura= '';
    if(@$bookschedulercart->shift_end !=''){
			$timecart =  date('h:ia', strtotime( @$bookschedulercart->shift_end)).' - '.date('h:ia', strtotime( @$bookschedulercart->shift_end));
		} 
		if(@$bookschedulercart->set_duration !=''){
			$tm=explode(' ',$bookschedulercart->set_duration);
			$hr=''; $min=''; $sec='';
			if($tm[0]!=0){ $hr=$tm[0].'hr. '; }
			if($tm[2]!=0){ $min=$tm[2].'min. '; }
			if($tm[4]!=0){ $sec=$tm[4].'sec.'; }
			if($hr!='' || $min!='' || $sec!='')
			{ 
				$tot_dura = $hr.$min.$sec; 
			} 
		}
}
?>
<link rel="stylesheet" href="<?php echo Config::get('constants.FRONT_CSS'); ?>compare/style.css">

<div id="" class="mykickboxing-activities" style="padding-top: 130px">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<div class="cart-title cart-success">
					<h5>SUCCESSFULLY ADDED TO YOUR CART</h5>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-5">
				<div class="bookedcard">
					<h5>You Just Booked With </h5>
					<div class="row">
						<div class="col-md-2 col-sm-2 col-xs-3">
							<div class="userblock-card">
								<div class="login_links">
									<?php 
										if(@$companyData->logo != ''){
	    								if (File::exists(public_path("/uploads/profile_pic/thumb/" . $companyData->logo))) {
	    									$profilePic = url('/public/uploads/profile_pic/thumb/' . $companyData->logo);
	    								} else {
	    									$profilePic = url('/public/images/service-nofound.jpg');
	    								}
	    							}else{ $profilePic = url('/public/images/service-nofound.jpg'); }
	    					?>
									<img src="{{$profilePic}}">
								</div>
							</div>
						</div>
						<div class="col-md-10 col-xs-9">
							<div class="img-title">
								<span>{{@$companyData->company_name}}</span>
								<p>{{@$companyData->address}}, {{@$companyData->city}}, {{@$companyData->state }} {{@$companyData->zip_code}}</p>
							</div>
						</div>
					</div>
					<div class="border-center"> </div>
					<div class="cart-items">
						<span>You have {{$total_quantity}} items In Your Cart</span>
					</div>
					<div class="cart-total">
						<label>Cart Total: </label>
						<span>${{$item_price}}</span>
					</div>
				</div>
				
			</div>
			<div class="col-md-7">
				<div class="row">
					<div class="col-md-4 col-sm-4">
						<div class="cart-itme-img">
							<img src="{{$profilePicact}}">
						</div>
					</div>
					<div class="col-md-8 col-sm-8">
						<div class="kick-adul">
							<h5>{{$cartdata['name']}}</h5>
							<h4>Booking Details</h4>
							<div class="cart-details">
								<span>@if($cartdata['sesdate']!='' && $cartdata['sesdate']!='0')
												{{date('l, jS \of F Y', strtotime( $item["sesdate"] ))}}
											@else  {{date('l, jS \of F Y')}} @endif</span>
								<span>{{$timecart}}</span>
								<span>Price: {{$totalprice}}</span>
								<span>Participants: @if(!empty($item['adult'])) @if($item['adult']['quantity']  != 0) Adult - {{$item['adult']['quantity']}} @endif @endif 
                     @if(!empty($item['child']))  @if($item['child']['quantity']  != 0) Children - {{$item['child']['quantity']}} @endif @endif
										@if(!empty($item['infant'])) @if($item['infant']['quantity'] != 0) Infant - {{$item['infant']['quantity'] }} @endif @endif </span>
								<span>Service Type: {{@$sdata->select_service_type}} </span>
								<span>Duration: {{$tot_dura}}</span>
								<span>Activity Location:  {{@$sdata->activity_location}}</span>
								<span>Service For: {{@$sdata->activity_for}}</span>
								<span>Age:  {{@$sdata->age_range}}</span>
								<span>Language: {{@$ser->languages}} </span>
								<span>Skill Level: {{@$sdata->difficult_level}}</span>
								<!-- <span>Instructor: Darryl Phipps</span> -->
							</div>
						</div>
					</div>
					<div class="col-md-7 col-sm-12">
						<div class="cart-btns-continues">
							<div class="btn-cart-modal">
								<a type="submit" href="{{route('activities_index')}}" class="btn btn-black mt-10" >Continue Shopping</a>
							</div>
							<div class="btn-cart-info instant-detail-booknow">
								<a type="submit" href="{{route('payments_card')}}" class="btn btn-red mt-10" >View Cart & Checkout</a>
							</div>
						</div>
					</div>
				</div>
			</div>
			
		</div>
		<div class="row">
			<div class="col-md-12">
				<div class="cart-border"> </div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12">
				<div class="cart-title">
					<h5>DISCOVER MORE BELOW</h5>
				</div>
			</div>
		</div>
		
		<section class="ptb-65 plr-60 float-left w-100 discover_activities" id="counter">
			<div class="container-fluid">
				<div class="cart-sub-title">
					<span>View Other Activities Provided by {{@$companyData->company_name}} ({{count($discovermore)}} items) <a class="cart-view" href="{{url('/activity-details/'.$pid)}}"> View All</a> </span>
				</div>
				<?php if (isset($discovermore) && count($discovermore)>0) { ?>
					<div class="owl-slider kickboxing-slider cart-slider">
						<div id="carousel-slider" class="owl-carousel">
							<?php
								$companyid = $companylat = $companylon = $companyname  = $latitude = $longitude = $serviceid = $companylogo = $companyaddress= $profilePic ="";
								$companycity = $companycountry = $pay_price  = "";
									$servicetype = [];
									foreach ($discovermore as $loop => $service) {
										$company = $price = $businessSp = [];
										$serviceid = $service['id'];
										$sport_activity = $service['sport_activity'];
										$servicetype[$service['service_type']] = $service['service_type'];
										$area = !empty($service['area']) ? $service['area'] : 'Location';

										$companyid = $companyData->id;
										$companyaddress = $companyData->address;
										$companyname = $companyData->company_name;
										$companycity = $companyData->city;
										$companycountry = $companyData->country;
										$companylogo = $companyData->logo;
										$companylat = $companyData->latitude;
										$companylon = $companyData->longitude;
													
										if ($service['profile_pic']!="") {
											if(str_contains($service['profile_pic'], ',')){
									    	$pic_image = explode(',', $service['profile_pic']);
										    if( $pic_image[0] == ''){
										       $p_image  = $pic_image[1];
										    }else{
										       $p_image  = $pic_image[0];
										    }
										  }else{
										  	$pic_image = $service['profile_pic'];
										   	$p_image = $service['profile_pic'];
											}

											if (file_exists( public_path() . '/uploads/profile_pic/' . $p_image)) {
										   	$profilePic = url('/public/uploads/profile_pic/' . $p_image);
											}else {
										   	$profilePic = url('/public/images/service-nofound.jpg');
											}
										}else{ $profilePic = '/public/images/service-nofound.jpg'; }

										$bookscheduler='';
										$time='';
										$bookscheduler = BusinessActivityScheduler::where('serviceid', $service['id'])->limit(1)->orderBy('id', 'ASC')->get()->toArray();
										if(@$bookscheduler[0]['set_duration']!=''){
											$tm=explode(' ',$bookscheduler[0]['set_duration']);
											$hr=''; $min=''; $sec='';
											if($tm[0]!=0){ $hr=$tm[0].'hr. '; }
											if($tm[2]!=0){ $min=$tm[2].'min. '; }
											if($tm[4]!=0){ $sec=$tm[4].'sec.'; }
											if($hr!='' || $min!='' || $sec!='')
											{ $time =  $hr.$min.$sec; } 
										}
										$pricearr = [];
										$price_all = '';
										$price_allarray = BusinessPriceDetails::where('serviceid', $service['id'])->get();
										if(!empty($price_allarray)){
											foreach ($price_allarray as $key => $value) {
												$pricearr[] = $value->pay_price;
											}
										}
										if(!empty($pricearr)){
											$price_all = min($pricearr);
										}        
							?>
								<div class="item">
								<div class="kickboxing-block">
									@if(Auth::check())
										<?php
											$loggedId = Auth::user()->id;
											$favData = BusinessServicesFavorite::where('user_id',$loggedId)->where('service_id',$service['id'])->first();                   
										?>
										<div class="kickboxing-topimg-content" ser_id="{{$service['id']}}" >
											<div class="inner-owl-slider-hire">
												<div id="owl-demo-learn_thismon{{$service['id']}}" class="owl-carousel owl-theme">
													<?php 
														$i = 0;
														if(is_array($pic_image)){
															foreach($pic_image as $img){
																$profilePic1 = '';
																if($img != ''){
																	if (file_exists( public_path() . '/uploads/profile_pic/' . $img)) {
											           				$profilePic1 = url('/public/uploads/profile_pic/' . $img);
																	}
											         		} 

										        				if($profilePic1 != ''){ ?>
																	<div class="item-inner">
																		<img src="{{$profilePic1}}" class="productImg">
																	</div>
																<?php }
															}
														}else{
															if (file_exists( public_path() . '/uploads/profile_pic/' . $pic_image)) {
										   					$profilePic1 = url('/public/uploads/profile_pic/' . $pic_image);
										    				}else {
										       				$profilePic1 = url('/public/images/service-nofound.jpg');
										    				} ?>
															<div class="item-inner">
																<img src="{{$profilePic1}}">
															</div>
													<?php } ?>
												</div>
											</div>
											<script type="text/javascript">
												$(document).ready(function() {
												  	$("#owl-demo-learn_thismon{{$service['id']}}").owlCarousel({
													   navText: ['<i class="fas fa-chevron-left"></i>', '<i class="fas fa-chevron-right"></i>'],
													   items : 1, 
													   loop:true,
													   nav:true,
													   dots: false,
												  	});
												});
											</script>
											<div class="serv_fav1" ser_id="{{$service['id']}}">
												<a class="fav-fun-2" id="serfav{{$service['id']}}">
													<?php
													if( !empty($favData) ){ ?>
														<i class="fas fa-heart"></i>
														<?php }
														else{ ?>
													<i class="far fa-heart"></i>
											 <?php } ?></a>
											</div>
											@if($price_all != '')
												<span>From ${{$price_all}}/Person</span>
											@endif
										</div>
									@else
										<div class="kickboxing-topimg-content">
											<div class="inner-owl-slider-hire">
												<div id="owl-demo-learn_thismon{{$service['id']}}" class="owl-carousel owl-theme">
													<?php 
														$i = 0;
														if(is_array($pic_image)){
															foreach($pic_image as $img){
																$profilePic1 = '';
																if($img != ''){
																	if (file_exists( public_path() . '/uploads/profile_pic/' . $img)) {
											           				$profilePic1 = url('/public/uploads/profile_pic/' . $img);
																	}
											         		} 

										        				if($profilePic1 != ''){ ?>
																	<div class="item-inner">
																		<img src="{{$profilePic1}}" class="productImg">
																	</div>
																<?php }
															}
														}else{
															if (file_exists( public_path() . '/uploads/profile_pic/' . $pic_image)) {
										   					$profilePic1 = url('/public/uploads/profile_pic/' . $pic_image);
										    				}else {
										       				$profilePic1 = url('/public/images/service-nofound.jpg');
										    				} ?>
															<div class="item-inner">
																<img src="{{$profilePic1}}">
															</div>
													<?php } ?>
												</div>
											</div>
											<script type="text/javascript">
												$(document).ready(function() {
												  	$("#owl-demo-learn_thismon{{$service['id']}}").owlCarousel({
													   navText: ['<i class="fas fa-chevron-left"></i>', '<i class="fas fa-chevron-right"></i>'],
													   items : 1, 
													   loop:true,
													   nav:true,
													   dots: false,
												  	});
												});
											</script>
											<a class="fav-fun-2" href="{{ Config::get('constants.SITE_URL') }}/userlogin" ><i class="far fa-heart"></i></a>
											@if($price_all != '')	
											  <span>From ${{$price_all}}/Person</span>
											@endif
										</div>
									@endif
									<?php
										$reviews_count = BusinessServiceReview::where('service_id', $service['id'])->count();
										$reviews_sum = BusinessServiceReview::where('service_id', $service['id'])->sum('rating');
										$reviews_avg=0;
										if($reviews_count>0)
										{	
											$reviews_avg= round($reviews_sum/$reviews_count,2); 
										}
									?>
									<div class="bottom-content">
										<div class="class-info">
											 <div class="row"> 
												<div class="col-md-7 ratingtime"> 
													<div class="activity-inner-data">
														<i class="fas fa-star"></i>
														<span>{{$reviews_avg}} ({{$reviews_count}})</span>
													</div>
													@if($time != '')
														<div class="activity-hours">
															<span>{{$time}}</span>
														</div>
													@endif

													<div class="claimed">
														<span>@if($companyData->is_verified == 1)
																		CLAIMED
																	@else
																		UNCLAIMED
																	@endif</span>
													</div>
											</div>
												<div class="col-md-5 country-instant">
													<div class="activity-city">
														<span>{{$companycity}}, {{$companycountry}}</span>
													</div>
												</div>
											</div>
										</div>
											<?php
												$redlink = str_replace(" ","-",$companyname)."/".$service['cid'];
												$service_type='';
												if($service['service_type']!=''){
													if( $service['service_type']=='individual' ) $service_type = 'Personal Training'; 
													else if( $service['service_type']=='classes' )	$service_type = 'Group Classe'; 
													else if( $service['service_type']=='experience' ) $service_type = 'Experience'; 
												}
											?>
											<div class="activity-information">
												<span><a 
													  <?php if (Auth::check()) { ?> 
														  href="{{ Config::get('constants.SITE_URL') }}/businessprofile/{{$redlink}}" 
													  <?php } else { ?>
														  href="{{ Config::get('constants.SITE_URL') }}/userlogin" 
													  <?php }?>
														  target="_blank">{{ $service['program_name'] }}</a>
												</span>
												<p>{{ $service_type }}  | {{ $service['sport_activity'] }}</p>
											</div>
											<hr>
											<div class="all-details">
												<a class="showall-btn" href="/activity-details/{{$serviceid}}">More Details</a>
											</div>
										</div>
									</div>
								</div>
									<?php } ?>
						</div>
					</div>
				
				<?php
					}else{ ?>
					<div class="kickboxing-slider cart-slider">
						<label class="text-center success-cart">This provider has no other services at this time.</label>
					</div>
				<?php } ?>
			</div>
		</section>
	</div>
</div>

@include('layouts.footer')

<script type="text/javascript">
	$(document).ready(function () {
	  $(document).on('click', '.serv_fav1', function(){
        var ser_id = $(this).attr('ser_id');
        // var _token = $("input[name='_token']").val();
        var _token = $('meta[name="csrf-token"]'). attr('content');
        $.ajax({
            type: 'POST',
            url: '{{route("service_fav")}}',
            data: {
                _token: _token,
                ser_id: ser_id
            },
            success: function (data) {
                if(data.status=='like')
				{
					$('#serfav'+ser_id).html('<i class="fas fa-heart"></i>');
				}
				else
				{
					$('#serfav'+ser_id).html('<i class="far fa-heart"></i>');
				}
            }
        });
    });
  });
</script>
<script>
jQuery("#carousel-slider").owlCarousel({
  autoplay: true,
  rewind: true, /* use rewind if you don't want loop */
  margin: 20,
   /*
  animateOut: 'fadeOut',
  animateIn: 'fadeIn',
  */
  responsiveClass: true,
  autoHeight: true,
  autoplayTimeout: 7000,
  smartSpeed: 800,
  nav: true,
  navText: ['<i class="fas fa-chevron-left"></i>', '<i class="fas fa-chevron-right"></i>'],
  responsive: {
    0: {
      items: 1
    },

    600: {
      items: 3
    },

    1024: {
      items: 3
    },

    1366: {
      items: 3
    }
  }
});
</script>
@endsection

