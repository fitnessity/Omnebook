@inject('request', 'Illuminate\Http\Request')
@extends('layouts.business.header')
<link rel='stylesheet' type='text/css' href="{{url('/public/css/frontend/general.css')}}">
<link rel='stylesheet' type='text/css' href="{{url('/public/css/responsive.css')}}">
<link rel="stylesheet" type='text/css' href="{{url('/public/css/compare/style.css')}}">
@section('content')
<style>
    .register_wrap form{padding: 0 50px;}
    .sign-step_2 .reg-title-step2 input{max-width: 340px;}
    .sign-step_3 h2{letter-spacing: 6px}
    .sign-step_4 .form-group{padding:10px; width:355px;}
    .sign-step_5 .form-group{width:355px;}
    .Zebra_DatePicker_Icon_Wrapper{
        padding: 0 !important;
    }
	.sign-step_4 .form-group input{width: 83%;}
	.kickboxing-slider .owl-nav .owl-prev i{padding: 4px;}
	.kickboxing-slider .owl-nav .owl-next i{padding: 4px;}
	.kickboxing-slider .owl-nav .owl-prev{top: 40%;}
	.kickboxing-slider .owl-nav .owl-next{top: 40%;}

</style>
<?php 
													 
use App\BusinessActivityScheduler;
use App\BusinessPriceDetails;
use App\BusinessServiceReview;
use App\BusinessServicesFavorite;
use App\BusinessServices;

$total_quantity = 0;
$item_price = 0;
$discount = 0;
$totalquantity = 0;
if(!empty($cart["cart_item"])) {
	$cartdata = $cart['cart_item'][$priceid];
    $serprice = BusinessPriceDetails::where('id', $cartdata['priceid'])->orderBy('id', 'ASC')->first();

    foreach($cart['cart_item'] as $item){
        $total_quantity = count($cart["cart_item"]);
        $item_price = $item_price + $item["totalprice"];

        if(!empty($item['adult'])){
            $totalquantity += $item['adult']['quantity'];
            $discount += ($item['adult']['price'] * is_int($serprice['adult_discount']))/100; 
        }
        if(!empty($item['child'])){
            $totalquantity += $item['child']['quantity'];
            $discount += ($item['child']['price'] * is_int($serprice['child_discount']))/100;
        }
        if(!empty($item['infant'])){
            $totalquantity += $item['infant']['quantity'];
            $discount += ($item['infant']['price'] * is_int($serprice['infant_discount']))/100;
        }
    }

    $pid = $cart['cart_item'][$priceid]['code'];
    $totalprice = $cart['cart_item'][$priceid]['totalprice'];
    
    $profilePicact  =  Storage::disk('s3')->exists($cart['cart_item'][$priceid]['image']) ? Storage::URL($cart['cart_item'][$priceid]['image']) : url('/images/service-nofound.jpg');  

    $bookschedulercart = BusinessActivityScheduler::where('id', $cartdata["actscheduleid"])->limit(1)->orderBy('id', 'ASC')->first();
    $act = BusinessServices::where('id', $cartdata["code"])->first();
    
    $daynum = '+'.@$serprice['pay_setnum'].' '.strtolower(@$serprice['pay_setduration']);
	$expired_at  = date('m/d/Y', strtotime(date('Y-m-d'). $daynum ));
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
			<div class="col-lg-5 col-md-12">
				<div class="bookedcard text-center">
					<h3>Your Cart Totals</h3>
					<!-- <h5>You Just Booked With </h5>
					<div class="row">
						<div class="col-md-2 col-sm-2 col-xs-3">
							<div class="userblock-card">
								<div class="login_links">
									<?php 
										if(@$companyData->logo != ''){
	    								if (File::exists(public_path("/uploads/profile_pic/" . $companyData->logo))) {
	    									$profilePic = url('/public/uploads/profile_pic/' . $companyData->logo);
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
								<span>{{@$companyData->dba_business_name}}</span>
								<p>{{@$companyData->address}}, {{@$companyData->city}}, {{@$companyData->state }} {{@$companyData->zip_code}}</p>
							</div>
						</div>
					</div> -->
					<div class="cart-items">
						<span>You have {{$total_quantity}} items In Your Cart</span>
					</div>
					<div class="cart-total">
						<label>Cart Total Amount: </label>
						<span>
							${{$item_price - $discount}}
						</span>
					</div>
					<div class="border-center"> </div>
				</div>
				
			</div>
			<div class="col-lg-7 col-md-12">
				<div class="row">
					<div class="col-md-4 col-sm-4">
						<div class="cart-itme-img">
							<img src="{{@$profilePicact}}">
							<h4>You Just Booked With </h4>
						</div>

						<div class="row">
							<div class="col-md-12 col-xs-12">
								<div class="img-title com-info">
									<h4>{{@$companyData->dba_business_name}}</h4>
									<p>{{@$companyData->address}}, {{@$companyData->city}}, {{@$companyData->state }} {{@$companyData->zip_code}}</p>
								</div>
							</div>
						</div>
					</div>
					<div class="col-md-8 col-sm-8">
						<div class="kick-adul">
							<h5>{{$cartdata['name']}}</h5>
							<div class="cart-details">
								<div class="row">
									<div class="col-md-6 col-xs-6 col-6">
										<div class="info-display">
											<label></label>
										</div>
									</div>
									<div class="col-md-6 col-xs-6 col-6">
										<div class="info-display info-align">
											@if($cart['cart_item'][$priceid]['adult'])
											  x{{$cart['cart_item'][$priceid]['adult']['quantity']}} Adult
											  	@if($serprice['adult_discount'])
												    @php
												      	$adult_discount_price = $cart['cart_item'][$priceid]['adult']['quantity'] * ($cart['cart_item'][$priceid]['adult']['price'] - ($cart['cart_item'][$priceid]['adult']['price'] * $serprice['adult_discount'])/100)
												    @endphp
												    ${{$adult_discount_price}}<strike> ${{$cart['cart_item'][$priceid]['adult']['quantity'] * $cart['cart_item'][$priceid]['adult']['price']}}</strike>/person
												@else
													${{$cart['cart_item'][$priceid]['adult']['quantity'] * $cart['cart_item'][$priceid]['adult']['price']}}/person
												@endif
											  <br/>
											@endif

											@if($cart['cart_item'][$priceid]['child'])
											  x{{$cart['cart_item'][$priceid]['child']['quantity']}} Child
											  	@if($serprice['child_discount'])
												    @php
												      $child_discount_price = $cart['cart_item'][$priceid]['child']['quantity'] * ($cart['cart_item'][$priceid]['child']['price'] - ($cart['cart_item'][$priceid]['child']['price'] * $serprice['child_discount'])/100)
												    @endphp
											    	${{$child_discount_price}}<strike> ${{$cart['cart_item'][$priceid]['child']['quantity'] *  $cart['cart_item'][$priceid]['child']['price']}}</strike>/person
											    @else
													${{$cart['cart_item'][$priceid]['child']['quantity'] * $cart['cart_item'][$priceid]['child']['price']}}/person
											  	@endif
											  <br/>
											@endif

											@if($cart['cart_item'][$priceid]['infant'])
											  x{{$cart['cart_item'][$priceid]['infant']['quantity']}} Infant
											  	@if($serprice['infant_discount'])
												    @php
													    $infant_discount_price = $cart['cart_item'][$priceid]['infant']['quantity'] * ($cart['cart_item'][$priceid]['infant']['price'] - ($cart['cart_item'][$priceid]['infant']['price'] * $serprice['infant_discount'])/100)
												    @endphp
												    ${{$infant_discount_price}}<strike> ${{$cart['cart_item'][$priceid]['infant']['quantity'] * $cart['cart_item'][$priceid]['infant']['price']}}</strike>/person
											  	@else
													${{$cart['cart_item'][$priceid]['infant']['quantity'] * $cart['cart_item'][$priceid]['infant']['price'] }}/person
											  	@endif
											  <br/>
											@endif
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-6 col-xs-6 col-6">
										<div class="info-display">
											<label>Date Scheduled:</label>
										</div>
									</div>
									<div class="col-md-6 col-xs-6 col-6">
										<div class="info-display info-align">
											<span>@if($cartdata["sesdate"]!='' && $cartdata["sesdate"]!='0') {{date('m/d/Y',strtotime($cartdata["sesdate"]))}} @endif</span>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-6 col-xs-6 col-6"> 
										<div class="info-display">
											<label>Time & Duration:</label>
										</div>
									</div> 
									<div class="col-md-6 col-xs-6 col-6"> 
										<div class="info-display info-align"> 
											<span>{{$timecart}} | {{$tot_dura}}</span>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-6 col-xs-6 col-6">
										<div class="info-display">
											<label>Category:</label>
										</div>
									</div>
									<div class="col-md-6 col-xs-6 col-6">
										<div class="info-display info-align">
											<span>{{ @$serprice->business_price_details_ages->category_title}}</span>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-6 col-xs-6 col-6">
										<div class="info-display">
											<label>Price Option: </label>
										</div>
									</div>
									<div class="col-md-6 col-xs-6 col-6">
										<div class="info-display info-align">
											<span>{{@$serprice['price_title']}}</span>
										</div>
									</div>
								</div>
								
								<div class="row">
									<div class="col-md-6 col-xs-6 col-6">
										<div class="info-display">
											<label>Date Booked: </label>
										</div>
									</div>
									<div class="col-md-6 col-xs-6 col-6">
										<div class="info-display info-align">
											<span>{{date('m/d/Y')}}</span>
										</div>
									</div>
								</div>

								<div class="row">
									<div class="col-md-6 col-xs-6 col-6">
										<div class="info-display">
											<label>Number of Sessions: </label>
										</div>
									</div>
									<div class="col-md-6 col-xs-6 col-6">
										<div class="info-display info-align">
											<span>{{@$serprice['pay_session']}} Sessions</span>
										</div>
									</div>
								</div>

								<div class="hide-part"> 
								
									<div class="row">
										<div class="col-md-6 col-xs-6 col-6">
											<div class="info-display">
												<label>Membership Option: </label>
											</div>
										</div>
										<div class="col-md-6 col-xs-6 col-6">
											<div class="info-display info-align">
												<span>{{@$serprice['membership_type']}}</span>
											</div>
										</div>
									</div>

									<div class="row">
										<div class="col-md-6 col-xs-6 col-6">
											<div class="info-display">
												<label>Participant Quantity: </label>
											</div>
										</div>
										<div class="col-md-6 col-xs-6 col-6">
											<div class="info-display info-align">
												<span>@if(!empty($cartdata['adult'])) @if($cartdata['adult']['quantity']  != 0) Adult x {{$cartdata['adult']['quantity']}} @endif @endif</span> 
												<span>@if(!empty($cartdata['child']))  @if($cartdata['child']['quantity']  != 0) Children x {{$cartdata['child']['quantity']}} @endif @endif</span>
												<span>@if(!empty($cartdata['infant'])) @if($cartdata['infant']['quantity'] != 0) Infant x {{$cartdata['infant']['quantity'] }} @endif @endif</span>
											</div>
										</div>
									</div>

									<div class="row">
										<div class="col-md-6 col-xs-6 col-6">
											<div class="info-display">
												<label>Add On Service: </label>
											</div>
										</div>
										<div class="col-md-6 col-xs-6 col-6">
											<div class="info-display info-align">
												<span>{!! getAddonService($cartdata['addOnServicesId'],$cartdata['addOnServicesQty']) !!} </span>
											</div>
										</div>
									</div>

									<div class="row">
										<div class="col-md-6 col-xs-6 col-6">
											<div class="info-display">
												<label>Activity Type:</label>
											</div>
										</div>
										<div class="col-md-6 col-xs-6 col-6">
											<div class="info-display info-align">
												<span>{{@$act['sport_activity']}}</span>
											</div>
										</div>
									</div>
									
									<div class="row">
										<div class="col-md-6 col-xs-6 col-6">
											<div class="info-display">
												<label>Service Type:</label>
											</div>
										</div>
										<div class="col-md-6 col-xs-6 col-6">	
											<div class="info-display info-align">
												<span> <?php echo @$act['select_service_type']; ?></span>
											</div>
										</div>
									</div>
										
									<div class="row">
										<div class="col-md-6 col-xs-6 col-6">
											<div class="info-display">
												<label>Membership Duration: </label>
											</div>
										</div>
										<div class="col-md-6 col-xs-6 col-6">	
											<div class="info-display info-align">
												<span>{{@$serprice['pay_setnum']}} {{@$serprice['pay_setduration']}}</span>
											</div>
										</div>
									</div>
									
									<div class="row">
										<div class="col-md-6 col-xs-6 col-6">
											<div class="info-display">
												<label>Purchase Date: </label>
											</div>
										</div>
										<div class="col-md-6 col-xs-6 col-6">	
											<div class="info-display info-align">
												<span>{{date('m/d/Y')}}</span>
											</div>
										</div>
									</div>

									<div class="row">
										<div class="col-md-6 col-xs-6 col-6">
											<div class="info-display">
												<label>Membership Activation Date: </label>
											</div>
										</div>
										<div class="col-md-6 col-xs-6 col-6">	
											<div class="info-display info-align">
												<span>{{date('m/d/Y')}}</span>
											</div>
										</div>
									</div>
								
									<div class="row">
										<div class="col-md-6 col-xs-6 col-6">
											<div class="info-display">
												<label>Membership Expiration: </label>
											</div>
										</div>
										<div class="col-md-6 col-xs-6 col-6">	
											<div class="info-display info-align">
												<span>{{$expired_at}}</span>
											</div>
										</div>
									</div>

									<div class="row">
										<div class="col-md-6 col-xs-6 col-6">
											<div class="info-display">
												<label>Provider Company: </label>
											</div>
										</div>
										<div class="col-md-6 col-xs-6 col-6">	
											<div class="info-display info-align">
												<span>{{$act->company_information->dba_business_name}}</span>
											</div>
										</div>
									</div>
								</div>

								<div class="show-more-cart"><a class="show-more">Show More <i class="fas fa-caret-down"></i></a> </div>
							</div>
						</div>
						<div class="cart-btns-continues">
							<div class="btn-cart-modal">
								<a type="submit" href="{{route('activities_index')}}" class="btn btn-black mt-10 fs-12" >Continue Shopping</a>
							</div>
							<div class="btn-cart-info instant-detail-booknow">
								@if(Auth::user())
									<a type="submit" href="{{route('carts_index')}}" class="btn btn-red mt-10 fs-12" >View Cart & Checkout</a>
								@else
									{{-- <a type="submit" class="btn btn-red mt-10" data-toggle="modal" data-target="#cartcheckout">View Cart & Checkout</a> --}}
									<a class="btn btn-red mt-10 fs-12" data-bs-toggle="modal" data-bs-target="#cartcheckout">View Cart & Checkout</a>
								@endif
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
					<span>View Other Activities Provided by {{@$companyData->dba_business_name}} ({{count($discovermore)}} items) <a class="cart-view" href="{{url('/activity-details/'.$pid)}}"> View All</a> </span>
				</div>
				<?php if (isset($discovermore) && count($discovermore)>0) { ?>
					<div class="owl-slider kickboxing-slider cart-slider">
						<div id="carousel-slider" class="owl-carousel">
							<?php
								$companyid = $companyname  = $latitude = $longitude = $serviceid =$profilePic ="";
								$companycity = $companycountry = $pay_price  = "";
									$servicetype = [];
									foreach ($discovermore as $loop => $service) {
										$company = $price = $businessSp = [];
										$serviceid = $service['id'];
										$sport_activity = $service['sport_activity'];
										$servicetype[$service['service_type']] = $service['service_type'];
										$area = !empty($service['area']) ? $service['area'] : 'Location';

										$companyid = $companyData->id;
										$companyname = $companyData->dba_business_name;
										$companycity = $companyData->city;
													
										$profilePic =  Storage::disk('s3')->exists($service->first_profile_pic()) ? Storage::URL($service->first_profile_pic()) : url('/images/service-nofound.jpg');  
					                  	$pic_image = explode(',',$service['profile_pic']);

										$bookscheduler= '';
										$bookscheduler = App\BusinessActivityScheduler::where('serviceid', $service['id'])->orderBy('id', 'ASC')->first();
										$time = @$bookscheduler != '' ? @$bookscheduler->get_duration() : '';
										
										$price_all = $service->min_price();       
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
													@if(is_array($pic_image))
														@foreach($pic_image as $img)
															@if(Storage::disk('s3')->exists($img) && $img != '' )
																<div class="item-inner cart-slider-dis">
																	<img src="{{Storage::URL($img)}}" class="productImg" alt="Omnebook">
																</div>
															@else
																<img src="{{url('/images/service-nofound.jpg')}}" class="productImg" alt="Omnebook">
															@endif
														@endforeach
													@else
														@if(Storage::disk('s3')->exists($pic_image) && $pic_image != '' )
															<div class="item-inner">
																<img src="{{Storage::URL($pic_image)}}">
															</div>
														@else
															<img src="{{url('/images/service-nofound.jpg')}}" class="productImg" alt="Omnebook">
														@endif
													@endif
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
												<span>From  {!! $price_all !!}/Person</span>
											@endif
										</div>
									@else
										<div class="kickboxing-topimg-content">
											<div class="inner-owl-slider-hire">
												<div id="owl-demo-learn_thismon{{$service['id']}}" class="owl-carousel owl-theme">
													@if(is_array($pic_image))
														@foreach($pic_image as $img)
															@if(Storage::disk('s3')->exists($img) && $img != '' )
																<div class="item-inner">
																	<img src="{{Storage::URL($img)}}" class="productImg" alt="Omnebook">
																</div>
															@else
																<img src="{{url('/images/service-nofound.jpg')}}" class="productImg" alt="Omnebook">
															@endif
														@endforeach
													@else
														@if(Storage::disk('s3')->exists($pic_image) && $pic_image != '' )
															<div class="item-inner">
																<img src="{{Storage::URL($pic_image)}}" alt="Omnebook">
															</div>
														@else
															<img src="{{url('/images/service-nofound.jpg')}}" class="productImg" alt="Omnebook">
														@endif
													@endif
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
											  <span>From ${!! $price_all !!}/Person</span>
											@endif
										</div>
									@endif
									<?php
										$reviews_count = BusinessServiceReview::where('service_id', $service['id'])->count();
										$reviews_sum = BusinessServiceReview::where('service_id', $service['id'])->sum('rating');
										$reviews_avg=  $reviews_count>0 ? round($reviews_sum/$reviews_count,2):0;
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
														<span>{{ $companyData->is_verified == 1 ? "CLAIMED" : "UNCLAIMED"}}</span>
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
												<p>{{ $service->formal_service_types() }} | {{ $service['sport_activity'] }}</p>
											</div>
											<hr>
											<div class="all-details">
												<a class="showall-btn" href="/activity-details/{{$serviceid}}">Book Now</a>
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

<!-- The Modal Checkout-->
<div class="modal fade compare-model" id="cartcheckout">
    <div class="modal-dialog cartcheckout">
        <div class="modal-content">
			<div class="modal-header" style="text-align: right;"> 
			  	<div class="closebtn">
					<button type="button" class="close close-btn-design manage-customer-close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">×</span>
					</button>
				</div>
			</div>

            <!-- Modal body -->
            <div class="modal-body body-space">
				<div class="row"> 
                    <div class="col-lg-12">
					   <h4 class="modal-title" style="text-align: center; color: #000; line-height: inherit; font-weight: 600;">Continue To Checkout</h4>
					</div>
					<div class="col-lg-12 btns-modal">
						<a href="{{route('addcheckoutsession')}}" class="addbusiness-btn-modal cart-btn-width">Log in</a>
						<a onclick="openRegistrationModal();" class="addbusiness-btn-modal" >Continue as Guest</a>
					</div>
				 </div>
            </div>
        </div>
    </div>
</div>
<!-- end modal -->

<!-- The Modal Registraion-->
<div class="modal fade compare-model" id="registermodal"  tabindex="-1" data-bs-focus="false">
    <div class="modal-dialog registermodal">
        <div class="modal-content">
			<div class="modal-header" style="text-align: right;"> 
			  	<div class="closebtn">
					<button type="button" class="close close-btn-design manage-customer-close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">×</span>
					</button>
				</div>
			</div>

            <!-- Modal body -->
            <div class="modal-body body-space register-bg">
				
            </div>
        </div>
    </div>
</div>

<!-- end modal -->


@include('layouts.business.footer')
<script type="text/javascript">
	flatpickr(".flatpicker_registration", {
		dateFormat: 'm/d/Y',
	    maxDate: '01/01/2050',		
	}); 
</script>


<script type="text/javascript">

	$(document).ready(function () {
		$(".show-more").click(function(event) {
			var txt = $(".hide-part").is(':visible') ? 'Show More <i class="fas fa-caret-down"></i>' : 'Show Less <i class="fas fa-caret-up"></i>';
			$(".hide-part").toggleClass("show-part");
			$(this).html(txt);
			event.preventDefault();
		});

	  	$(document).on('click', '.serv_fav1', function(){
	        var ser_id = $(this).attr('ser_id');
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

  	function openRegistrationModal(){
		$.ajax({
            url: '{{route('openGuestRegistration')}}',
            type: 'GET',
            success: function (response) {
            	$('.register-bg').html(response);
				$('#registermodal').modal('show');
            	// $('#registermodal').modal({ show: true, focus: false});
            }
        });
	}

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
	      		items: 2
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

