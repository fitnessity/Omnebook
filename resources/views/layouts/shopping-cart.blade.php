@inject('request', 'Illuminate\Http\Request')
@extends('layouts.header')

@section('content')

<?php 
	$username = Auth::user() != '' ? Auth::user()->full_name : '';
    /*echo"<pre>";*/ /*print_r($cart['cart_item']);*/ /*exit();*/
    $ajaxname = '';

    $fees = App\BusinessSubscriptionPlan::where('id',1)->first();
    $cartCount = !empty(@$cart['cart_item']) ? count($cart['cart_item']) : 0;
    $soldOutChk = $timeChk = $item_price = $discount =0;
	$bookings = new App\Repositories\BookingRepository;
?>	
<div class="page-content">
    <div class="container-fluid">
        <div class="row">
            <div class="col">
                <div class="h-100">
                	<div class="row mb-3">
						<div class="col-12">
							<div class="page-heading">
								<label>Shopping Cart</label>
							</div>
						</div>
					</div>
                	
                	@if (!empty($cart['cart_item'])) 
                		<form action="{{route('create-checkout-session')}}" method="POST" class="validation" data-cc-on-file="false"  data-stripe-publishable-key="{{ env('STRIPE_PKEY') }}" id="payment-form">
                			@csrf
							<div class="row">
								<div class="col-xl-8">
									<div class="row align-items-center gy-3 mb-3">
										<div class="col-sm">
			                            <div>
			                                <h5 class="fs-14 mb-0">Your Cart ({{$cartCount}} items)</h5>
			                            </div>
			                        </div>
										<div class="col-sm-auto">
											<div class="float-end">
												<a href="{{route('activities_index')}}" class="fs-15 color-red-a">Continue Shopping</a>
											</div>
										</div>
									</div>
									@foreach ($cart['cart_item'] as $it=>$item) 
										<?php 
											$totalquantity = 0;
	                        				$soldOut = $timeChkTxt = '';

				    						if ($item['image']!="" && Storage::disk('s3')->exists($item['image'])) {
				    							$profilePic = Storage::URL($item['image']);
				    						} else {
				    							$profilePic = url('/public/images/service-nofound.jpg');
				    						}
				    						$act = App\BusinessServices::where('id', $item["code"])->first();
				    						$BusinessTerms = App\BusinessTerms::where('cid',@$act["cid"])->first();
					                        $termcondfaqtext = @$BusinessTerms->termcondfaqtext;
					                        $contracttermstext = @$BusinessTerms->contracttermstext;
					                        $liabilitytext = @$BusinessTerms->liabilitytext;
					                        $covidtext = @$BusinessTerms->covidtext;
					                        $refundpolicytext = @$BusinessTerms->refundpolicytext;

					                        $serprice =  App\BusinessPriceDetails::where('id', $item['priceid'])->limit(1)->orderBy('id', 'ASC')->first();
					                 
					                        $db_totalquantity = $bookings->gettotalbooking($item["actscheduleid"],$item["sesdate"]);
					                        
					                        if(!empty($item['adult'])){
					                            $totalquantity += $item['adult']['quantity'];
					                            $discount += $item['adult']['quantity'] * ($item['adult']['price'] * is_int(@$serprice['adult_discount']))/100; 
					                        }
					                        if(!empty($item['child'])){
					                            $totalquantity += $item['child']['quantity'];
					                            $discount += $item['child']['quantity'] *  ($item['child']['price'] * is_int(@$serprice['child_discount']))/100;
					                        }
					                        if(!empty($item['infant'])){
					                            $totalquantity += $item['infant']['quantity'];
					                            $discount += $item['infant']['quantity'] *  ($item['infant']['price'] *  is_int(@$serprice['infant_discount']))/100;
					                        }
					                        $tot_cart_qty = ($db_totalquantity + $totalquantity);
					                        $item_price = $item_price + $item["totalprice"];


					                        $daynum = '+'.@$serprice['pay_setnum'].' '.strtolower(@$serprice['pay_setduration']);
	    									$expired_at  = date('m/d/Y', strtotime(date('Y-m-d'). $daynum ));

	    									$schedule = App\BusinessActivityScheduler::where('id', $item["actscheduleid"])->orderBy('id', 'ASC')->first();
	    									$timeval = @$schedule != '' ? @$schedule->get_duration() : '';

	    									if(date('Y-m-d',strtotime($item["sesdate"])) == date('Y-m-d')){
								                $start = new DateTime($schedule->shift_start);
								                $start_time = $start->format("H:i");
								                $current = new DateTime();
								                $current_time =  $current->format("H:i");
								                if($current_time > $start_time){
								                   	$timeChk= 1;
								                   	$timeChkTxt = "You can't book this activity for this date";
								                }
								            }

					                        $tot_cart_qty = ($db_totalquantity + $totalquantity);
					                        if( @$schedule['spots_available'] <  $tot_cart_qty ){
					                            $soldOutChk = 1;
					                            $soldOut = "Sold Out";
					                        }

					                        $service_fee= ($item["totalprice"] * $fees->service_fee)/100;
					    					$tax= ($item["totalprice"] * $fees->site_tax)/100;
					    					$total_amount = $item["totalprice"] + $service_fee + $tax;
					    					$iprice = number_format($total_amount,0, '.', '');
					    					$daynum = '+'.@$serprice['pay_setnum'].' '.strtolower(@$serprice['pay_setduration']);
					    					$expired_at  = date('m/d/Y', strtotime(date('Y-m-d'). $daynum ));	
				    					?>
				    					<input type="hidden" name="itemid[]" value="<?= $item["code"]; ?>" />
					                    <input type="hidden" name="itemimage[]" value="<?= $profilePic ?>" />
					                    <input type="hidden" name="itemname[]" value="<?= $item["name"]; ?>" />
					                    <input type="hidden" name="itemqty[]" value="1" />
					                    <input type="hidden" name="itemprice[]" value="<?= $iprice * 100; ?>" />
					                    <input type="hidden" name="itemparticipate[]" id="itemparticipate" value="" />
										<div class="card nopadding mb-2rem">
											<div class="card-body">
												<div class="row">
													<div class="col-lg-6">
														<label class="font-red fs-17">{{$timeChkTxt}}</label>
													</div>
													<div class="col-lg-6">
														<div class="float-end">
															<label class="font-red fs-17">{{$soldOut}}</label>
														</div>
													</div>
												</div>
												<div class="row">
													<div class="col-sm-auto col-6" id="imgdiv">
														<div class="avatar-lg-custom bg-light rounded p-1 mmb-10 mb-10">
															<img src="{{$profilePic}}" alt="" class="img-fluid d-block">
														</div>
													</div>
													<div class="col-sm" id="bookdiv">
														<h5 class="fs-20 text-truncate"><a href="#" class="text-dark">{{$item["name"]}}</a></h5>
														<a class="fs-13 color-red-a" data-bs-toggle="modal" data-bs-target="#booking-details{{$it}}">Booking Details</a>
														<div class="row">
															<?php //$family = App\UserFamilyDetail::where('user_id', Auth::user()->id)->get()->toArray();
																$family = getFamilyMember(@$act["cid"]);
																//print_r($family);exit;
																for($i=0; $i<$totalquantity ; $i++)
																{ ?>
																	<div class="col-md-4 col-sm-6 mb-3">
																		<div class="text-left mt-40 mmt-10">
																			<h6 class="mb-3 mt-3 fs-12">Select Who's Participating</h6>
																		</div>
																		<div class="hstack gap-3 px-3 mx-n3">
																			<select class="form-select fs-13 familypart" name="participat[]" id="participats" >

																				<option value="" data-cnt="{{$i}}" data-priceid="{{$item['priceid']}}" data-type="user">Choose or Add Participant</option>
	                                            								
	                                            								<option value="{{Auth::user()->id}}" data-cnt="{{$i}}" data-priceid="{{$item['priceid']}}" data-type="user"  @if(@$item['participate'][$i]['id'] == Auth::user()->id) selected @endif>{{Auth::user()->firstname}} {{ Auth::user()->lastname }}</option>
	                                            									@foreach($family as $fa)
									                                            		<option value="{{$fa['id']}}"  data-name="{{$fa['full_name']}}" data-cnt="{{$i}}" data-priceid="{{$item['priceid']}}" data-age="" @if(@$item['participate'][$i]['id'] == $fa['id']) selected @endif data-type="{{$fa['type']}}">

									                                                    {{$fa['full_name']}}</option>
									                                            	@endforeach

	                                           	 								<option value="addparticipate">+ Add New Participant</option>
																			</select>
																		</div>
																	</div>
																<?php } ?>
														</div>
													</div>

													 <script>
														$('.familypart').change(function() {
															var $this = $(this);
															var selectedOption = $this.children("option:selected");
															var value = selectedOption.val();
															if(value == 'addparticipate'){
																$('.newparticipant').modal('show');
															}else{
																var data = {
															      	_token: $('meta[name="csrf-token"]').attr('content'),
															      	act: selectedOption.data('priceid'),
															      	familyid: value,
															      	counter: selectedOption.data('cnt'),
															      	type: selectedOption.data('type')
															    };

															    $.post('{{ route("form_participate") }}', data).done(function() {
														        	$(".participaingdiv" + data.act).load(" .participaingdiv" + data.act + ">*");
														      	});
									                       	}
														});
													</script>
													<div class="col-sm-auto col-6" id="pricediv">
														<div class="price-section">
						                                    <h4 class="fs-15">
						                                    	<!-- @if($item['adult'])
						                                    	<label class="highlight-fonts">  x{{$item['adult']['quantity']}} Adult </label> 
						                                    	  @if(@$serprice['adult_discount'])
						                                    	    ${{($item['adult']['price'] - ($item['adult']['price'] * @$serprice['adult_discount'])/100)}}<strike> ${{$item['adult']['price']}}</strike>/person
						                                    	  @endif
						                                    	  <br/>
						                                    	@endif

						                                    	@if($item['child'])
						                                    	 <label class="highlight-fonts">  x{{$item['child']['quantity']}} Child </label>
						                                    	  @if(@$serprice['child_discount'])
						                                    	    ${{ ($item['child']['price'] - ($item['child']['price'] * @$serprice['child_discount'])/100)}}<strike> ${{$item['child']['price']}}</strike>/person
						                                    	  @endif
						                                    	  <br/>
						                                    	@endif

						                                    	@if($item['infant'])
						                                    	 <label class="highlight-fonts">  x{{$item['infant']['quantity']}} Infant </label>
						                                    	  @if(@$serprice['infant_discount'])
						                                    	    ${{ ($item['infant']['price'] - ($item['infant']['price'] * @$serprice['infant_discount'])/100)}}<strike> ${{$item['infant']['price']}}</strike>/person
						                                    	  @endif
						                                    	  <br/>
						                                    	@endif -->
						                                    </h4>
						                                </div>
														<div class="text-lg-end item-price">
															<p class="text-muted mb-1">Item Price:</p>
															<h5 class="fs-20">$<span id="ticket_price" class="product-price">{{number_format($item["totalprice"] - $discount, 2)}}</span></h5>
														</div>
													</div>
													
													@if($termcondfaqtext != '' || $liabilitytext != '' || $covidtext != '' || $contracttermstext != '' || $refundpolicytext != '')
														<div class="col-lg-12" id="termsdiv">
															<div class="terms-head">
																<h4 class="fs-17"> Terms:</h4>
																<p class="fs-13"> View the terms and conditions from this provider below.</p>
																<div>
																	@if($termcondfaqtext != '')
							                                            <a href="#" data-url="{{route('getTerms',['id'=>$BusinessTerms->id , 'termsType' => 'termcondfaqtext' ,'termsHeader'=>'Terms, Conditions, FAQ'])}}"  class="font-13 color-red-a" data-behavior = 'termsModelOpen' >Terms, Conditions, FAQ</a> | @endif 
							                                        
							                                        @if($liabilitytext != '')
							                                            <a href="#" data-url="{{route('getTerms',['id'=>$BusinessTerms->id , 'termsType' =>'liabilitytext','termsHeader'=>'Liability Waiver'])}}"  class="font-13 color-red-a" data-behavior = 'termsModelOpen' >Liability Waiver</a> | @endif 

							                                        @if($covidtext != '')
							                                            <a href="#" data-url="{{route('getTerms',['id'=>$BusinessTerms->id , 'termsType' =>'covidtext','termsHeader'=>'Covid - 19 Protocols'])}}"  class="font-13 color-red-a" data-behavior = 'termsModelOpen' >Covid - 19 Protocols</a> | @endif

							                                        @if($contracttermstext != '')
							                                            <a href="#" data-url="{{route('getTerms',['id'=>$BusinessTerms->id , 'termsType' =>'contracttermstext','termsHeader'=>'Contract Terms'])}}"  class="font-13 color-red-a" data-behavior = 'termsModelOpen' >Contract Terms</a> | @endif 

							                                        @if($refundpolicytext != '')
							                                            <a href="#" data-url="{{route('getTerms',['id'=>$BusinessTerms->id , 'termsType' =>'refundpolicytext','termsHeader'=>'Refund Policy'])}}"  class="font-13 color-red-a" data-behavior = 'termsModelOpen' >Refund Policy</a> @endif
																</div>
															</div>
														</div>
													@endif
												</div>
											</div><!-- end card-body -->

											<div class="card-footer card-footer-checkout">
												<div class="row align-items-center gy-3">
													<div class="col-lg-5 col-4">
														<div class="d-flex flex-wrap my-n1">
															<!-- <div>
																<a href="#" class="d-block text-body p-1 px-2 font-14"><i class="fas fa-edit text-muted me-1"></i> Edit</a>
															</div> -->
															<div>
																<a href="#" class="d-block text-body p-1 px-2 font-14"><i class="fas fa-share-alt text-muted me-1"></i> Share</a>
															</div>
															<div>
																<a href="/removetocart?priceid=<?php echo $item["priceid"]; ?>" class="d-block text-body p-1 px-2 font-14"><i class="fas fa-trash-alt text-muted me-1"></i> Remove</a>
															</div>
														</div>
													</div>
													<div class="col-lg-7 col-8">
														<div class="d-grid float-end">
															<div class="d-flex align-items-center gap-2 float-end">
																<input class="ncart-payfor" type="checkbox" id="payforcheckbox{{$item['priceid']}}" name="payforcheckbox" value="" onclick="opengiftpopup('{{$item["priceid"]}}','{{$profilePic}}','{{$item["name"]}}','{{date("m/d/Y",strtotime($item["sesdate"]))}}')">
																<label class="ncart-payfor-label" >Paying or gifting for someone?</label>
															</div>
															<p class="fs-11 float-end">Share the booking details with them</p>
														</div>
													</div>
												</div>
											</div><!-- end card footer -->
										</div>

										<!-- Modal -->
											<div class="modal" id="booking-details{{$it}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
												<div class="modal-dialog modal-dialog-centered">
													<div class="modal-content">
														<div class="modal-header">
															<h5 class="modal-title" id="exampleModalLabel">{{$item["name"]}}</h5>
															<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
														</div>
														<div class="modal-body">
															<div class="row">
																<div class="col-md-6 col-xs-6 col-6">
																	<div class="info-display">
																		<label>Date Scheduled:</label>
																	</div>
																</div>
																<div class="col-md-6 col-xs-6 col-6">
																	<div class="info-display info-align">
																		<span> @if($item["sesdate"]!='' && $item["sesdate"]!='0') {{date('m/d/Y',strtotime($item["sesdate"]))}} @endif </span>
																	</div>
																</div>
															</div>
															<div class="row">
																<div class="col-md-6 col-xs-6"> 
																	<div class="info-display">
																		<label>Time & Duration:</label>
																	</div>
																</div> 
																<div class="col-md-6 col-xs-6"> 
																	<div class="info-display info-align"> 
																		<span>{{ date('h:ia', strtotime( @$schedule['shift_start'] ))}} to {{ date('h:ia', strtotime( @$schedule['shift_end'] )) }}  | {{$timeval}} </span>
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
																		<span>@if(!empty($item['adult'])) @if($item['adult']['quantity']  != 0) Adult x {{$item['adult']['quantity']}} @endif @endif</span> 
																		<span>@if(!empty($item['child']))  @if($item['child']['quantity']  != 0) Children x {{$item['child']['quantity']}} @endif @endif</span>
																		<span>@if(!empty($item['infant'])) @if($item['infant']['quantity'] != 0) Infant x {{$item['infant']['quantity'] }} @endif @endif</span>
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
																		<span>{!! getAddonService(@$item['addOnServicesId'],@$item['addOnServicesQty']) !!} </span>
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
																		<span>{{@$act->company_information->dba_business_name}}</span>
																	</div>
																</div>
															</div>
															
														</div>
													</div>
												</div>
											</div>
									@endforeach
								</div>
								<?php
					    			$service_fee= ($item_price * $fees->service_fee)/100;
					    			$tax= ($item_price * $fees->site_tax)/100;
					    			$total_amount =  number_format(($item_price + $service_fee + $tax - $discount),2,'.','');
					    		?>
					    		<input type="hidden" name="grand_total" id="total_amount" value="{{$total_amount}}">
					    		<input type="hidden" name="tax" id="tax" value="{{$tax}}">
					    		<input type="hidden" name="service_fee" id="service_fee" value="{{$service_fee}}">
								<div class="col-xl-4">
									<div class="sticky-side-div">
										<div class="card">
											<div class="card-header border-bottom-dashed">
												<h5 class="card-title mb-0 fs-17">Order Summary</h5>
											</div>
											<div class="card-body pt-2">
												<div class="row">	
													<div class="col-6">
														<label class="fs-15">Bookings</label>
													</div>
													<div class="col-6">
														<span class="fs-15 float-end">{{$cartCount}}</span>
													</div>
													<div class="col-6">
														<label class="fs-15">Subtotal {{$discount}}</label>
													</div>
													<div class="col-6">
														<span class="fs-15 float-end">
															@if($discount)
				    										<?php echo "$ " . number_format($item_price - $discount, 2); ?> 
					    									@else
					    										<?php echo "$ " . number_format($item_price, 2); ?> 
				    										@endif
				    									</span>
													</div>
													<div class="col-6">
														<label class="fs-15">Taxes & Fees: </label>
													</div>
													<div class="col-6">
														<span class="fs-15 float-end">$ {{(number_format(($tax + $service_fee),2))}}</span>
													</div>
													<div class="col-lg-12 col-12">
														<div class="border-wid-grey"></div>
													</div>
													<div class="col-6">
														<label class="fs-15">Grand Total:</label>
													</div>
													<div class="col-6">
														<label class="fs-15 float-end">${{$total_amount}}</label>
													</div>
													<div class="col-lg-12 col-12">
														<div class="border-wid-grey"></div>
													</div>
													<div class="col-12">
														<label class="fs-15">Terms & Agreement</label>
														<div class="terms-wrap">
															<input type="checkbox" id="terms_condition" name="terms_condition" value="">
															<p class="cart-terms fs-13"> The provider(s) require that you agree to some terms and conditions before booking this activity. 
															<br> <br> By checking this box, you {{$username}} agree on {{ date('m/d/Y')}} to the terms the provider(s) require upon booking. You agree that you are 18+ to book this activity. You also agree to the Fitnessity privacy policy & terms of agreement. </p>
														</div>
													</div>
												</div>
											</div>
										</div>
										@if(!empty($cardInfo)) 
											<div class="card">
												<div class="card-header border-bottom-dashed">
													<h5 class="card-title mb-0 fs-17">Payment Selection</h5>
												</div>
												<div class="card-body pt-2">
													<div class="row">	
														<div class="col-6">
															<label class="fs-15">Save Cards</label>
														</div>
														<div class="col-6">
															<!-- <a href="/personal-profile/payment-info" class="edit-cart fs-15 color-red-a float-end"> Edit</a> -->

															<a href="{{route('personal.credit-cards')}}" class="edit-cart fs-15 color-red-a float-end"> Edit</a>
														</div>
													</div>
														
													<div class="row">
														@foreach($cardInfo as $card) 
		                                        			@php $brandname = strtolower($card['brand']); @endphp
															<div class="col-md-6">
																<label class="pay-card" style="color:#ffffff; background-image: url(/public/img/visa-card-bg.jpg );">
																	<input name="cardinfo" class="payment-radio" type="radio" value="{{$card['payment_id']}}">
																	<span class="plan-details">
																		<div class="row">
																			<div class="col-md-12">
																				<div class="cart-name">
																					<span>{{$brandname}}</span>
																				</div>
																			</div>
																			<div class="col-md-12">
																				<div class="cart-num">
																					<span>XXXX XXXX XXXX {{$card['last4']}}</span>
																				</div>
																			</div>
																		</div>
																	</span>
																</label>
															</div>
														@endforeach
													</div>
													
													<div class="row">
														<div class="col-lg-12">
															<div class="sacecard-title fs-14 mt-15">OTHER PAYMENT METHODS </div>
															<button class="card-btns fs-14" type="button">Credit / Debit Card</button>
														</div>
														
														<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
															<div id="payment-element" style="margin-top: 8px;">
															</div>
														</div>
														
														<div class="col-md-12 col-xs-12">
															<div class="save-pmt-checkbox">
																<input type="checkbox" id="save_card" name="save_card" value="1" checked>
																<input type="hidden" id="new_card_payment_method_id" name="new_card_payment_method_id" value="">
																<label class="fs-14">Save For Future Payments</label>
															</div>
															<div class='form-row row'>
																<div class='col-md-12 hide error form-group'>
																	<div class='alert-danger alert '>Fix the errors before you begin.</div>
																</div>
															</div>
														</div>
														@if (session('stripeErrorMsg'))
									    					<div class='form-row row'>
									                            <div class='col-md-12 error form-group'>
									                                <div class='alert-danger alert'> {{ session('stripeErrorMsg') }}</div>
									                            </div>
									                        </div>
								                        @endif

								                        <div id="error_check" class="d-none"><p class="font-14 font-red text-center">Please select Terms & Conditions.</p></div>
														<div class="text-center mb-4">
															<span class="font-red fs-14 d-none participateAlert">Please Select Who Is Participating.</span>
														</div>

														<div class="text-end mb-4">
															<button class="btn btn-cart-checkout btn-label right ms-auto" type="submit"  id="checkout-button" @if($soldOutChk == 1 || $timeChk == 1) disabled @endif >
																<i class="fas fa-arrow-right label-icon align-bottom fs-16 ms-2"></i> Check out
															</button>
														</div>
													</div>
												</div>
											</div>
										@endif
									</div>
								</div>
							</div>	
						</form>
					@else
					<div class="row">
						<div class="col-xl-8">
							<div class="card nopadding mb-2rem">									
								<div class="card-body">
									<div class="row">
										<div class="col-lg-12">
											<div class="text-center empty-cart">
												<h4 class="fs-17"> Your Cart Is Empty.</h4>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="col-xl-4">
							<div class="sticky-side-div">
								<div class="card">
									<div class="card-header border-bottom-dashed">
										<h5 class="card-title mb-0 fs-17">Order Summary</h5>
									</div>
									<div class="card-body pt-2">
										<div class="row">	
											<div class="col-6">
												<label class="fs-15">Bookings</label>
											</div>
											<div class="col-6">
												<span class="fs-15 float-end">0</span>
											</div>
											<div class="col-6">
												<label class="fs-15">Subtotal</label>
											</div>
											<div class="col-6">
												<span class="fs-15 float-end">$ 0</span>
											</div>
											<div class="col-6">
												<label class="fs-15">Taxes & Fees:</label>
											</div>
											<div class="col-6">
												<span class="fs-15 float-end">$ 0 </span>
											</div>
											<div class="col-lg-12 col-12">
												<div class="border-wid-grey"></div>
											</div>
											<div class="col-6">
												<label class="fs-15">Grand Total:</label>
											</div>
											<div class="col-6">
												<label class="fs-15 float-end">$0</label>
											</div>
											<div class="col-12">
												<div class="terms-wrap">
												<input type="checkbox" id="terms_condition" name="terms_condition" value="">
												<p class="cart-terms fs-13"> The provider(s) require that you agree to some terms and conditions before booking this activity. 
												<br> <br> By checking this box, you {{$username}} agree on {{ date('m/d/Y')}} to the terms the provider(s) require upon booking. You agree that you are 18+ to book this activity. You also agree to the Fitnessity privacy policy & terms of agreement. </p>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					@endif				
				</div> <!-- end .h-100-->
          	</div> <!-- end col -->
        </div>
    </div><!-- container-fluid -->
</div><!-- End Page-content -->

<!-- The Modal Add Business-->
	<div class="modal" id="leavegift" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
	    <div class="modal-dialog modal-lg giftsmodals modal-dialog-centered">
	        <div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="staticBackdropLabel">Leave a gift for your friends and family</h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>

	            <!-- Modal body -->
	        	<div class="modal-body" id="leavegiftbody">
	        	</div>					        
	       	</div>
		</div>
	</div>
<!-- end modal -->

<div class="modal fade in newparticipant" tabindex="-1" aria-modal="true" role="dialog" data-bs-focus="false">
	<div class="modal-dialog modal-dialog-centered mw-70" >
		<div class="modal-content">
			<div class="modal-header p-3">
				<h5 class="modal-title" id="exampleModalLabel">Add Family or Friends</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" id="close-modal"></button>
			</div>
			<form action="{{route('personal.manage-account.store')}}" method="post">
				@csrf
				<div class="modal-body">
					<div class="row">	
						<div class="col-lg-4 col-md-4 col-sm-6">
							<div class="photo-select product-edit user-dash-img mb-10">
								<input type="hidden" name="old_pic" value="">
								<img src="{{'/images/service-nofound.jpg'}}" class="pro_card_img blah" id="showimg">
									<input type="file" id="profile_pic" name="profile_pic" class="text-center fs-12">
							</div>
						</div>
						<div class="col-lg-8 col-md-8 fs-12">	
							<div class="row">
								<div class="col-xl-6 col-lg-6 col-md-6 col-sm-6">
									<div class="form-group mb-10">
										<label>First Name</label>
										<input type="text" name="fname" class="form-control fs-12" required="required" value="">
									</div>
								</div>
								<div class="col-xl-6 col-lg-6 col-md-6 col-sm-6">
									<div class="form-group mb-10">
										<label>Last Name</label>
										<input type="text" name="lname" id="lname" class="form-control fs-12" required="required" value="">
									</div>
								</div>
								<div class="col-xl-6 col-lg-6 col-md-6 col-sm-6">
									<div class="form-group mb-10">
										<label>Gender</label>
										<select name="gender" id="gender" class="form-select fs-12" required="required">
											<option value="" hidden="">Select Gender</option>
											<option value="Male">Male</option>
											<option value="Female">Female</option>
										</select>
									</div>
								</div>
								<div class="col-xl-6 col-lg-6 col-md-6 col-sm-6">
									<div class="form-group mb-10">	
										<label>Email</label>
										<input type="email" name="email" id="email" class="form-control fs-12" value="" required="required">
									</div>
								</div>
								<div class="col-xl-6 col-lg-6 col-md-6 col-sm-6">
									<div class="form-group mb-10">
										<label>Relationship</label>
										<select name="relationship" id="relationship" class="form-select fs-12" required="required">
											<option value="" hidden="">Select Relationship</option>
											<option value="Brother">Brother</option>
											<option value="Sister">Sister</option>
											<option value="Father">Father</option>
											<option value="Mother">Mother</option>
											<option value="Wife">Wife</option>
											<option value="Husband">Husband</option>
											<option value="Son">Son</option>
											<option value="Daughter">Daughter</option>
											<option value="Friend">Friend</option>
										</select>
									</div>
								</div>
								<div class="col-xl-6 col-lg-6 col-md-6 col-sm-6">
									<div class="form-group mb-10">
										<label>Birth date</label>
										<input type="text" class="fs-12 form-control flatpickr-input" name="birthdate" id="birthdate" readonly="readonly">
									</div>
								</div>
								<div class="col-xl-6 col-lg-6 col-md-6 col-sm-6">
									<div class="form-group mb-10">
										<label>Mobile Number</label>
										<input type="text" name="mobile" id="mobile"  class="form-control fs-12" value="" data-behavior="text-phone" maxlength="14">
									</div>
								</div>
								<div class="col-xl-6 col-lg-6 col-md-6 col-sm-6">
									<div class="form-group mb-10">
										<label>Emergency Contact Number</label>
										<input type="text" name="emergency_contact" id="emergency_contact" class="form-control fs-12" maxlength="14" value="" data-behavior="text-phone">
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<div class="hstack gap-2 justify-content-end">
						<button type="submit" id="btn_family" class="btn-cart-checkout fs-12">Submit</button>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>

<div class="modal" id="termsModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content" id="termsModelContent"></div>
	</div>
</div>

										
@include('layouts.business.footer')
<script>
	flatpickr('.flatpickr-input',{
		dateFormat: "m-d-Y",
        maxDate: "today",
	});
	function opengiftpopup(pid,img,name,date){
		var checkBox = document.getElementById("payforcheckbox"+pid);
		if (checkBox.checked == true){
			$.ajax({
	           type:'post',
	           url:'/activity_gift_model',
	           data:{
	           		_token : '<?php echo csrf_token() ?>' ,
	           		name : name,
	           		img : img,
	           		pid : pid,
	           		date : date,
	           	},
	            success:function(data) {
	            	$('#leavegiftbody').html(data);
	            }
	        });
		    $('#leavegift').modal('show');
		}
	}

	function addemail(pid) {
		$('#emaildiv').append('<input type="email" class="form-control myemail" name="Emailb[]" id="b_email" autocomplete="off" placeholder="Enter Recipient Email" size="30" maxlength="80" value="">');
	}

	$(document).on('click', '[data-behavior~=termsModelOpen]', function(e){
        e.preventDefault()
        $.ajax({
            url: $(this).data('url'),
            success: function(html){
                $('#termsModelContent').html(html)
                $('#termsModal').modal('show')
            }
        })
    });
</script>
	
<script type="text/javascript">
	$(function() {
		stripe = Stripe('{{ env("STRIPE_PKEY") }}');	
		const client_secret = '{{$intent ? $intent->client_secret : null}}';
		const options = {
		  clientSecret: client_secret,
		  // Fully customizable with appearance API.
		  appearance: {/*...*/},
		};
		const elements = stripe.elements(options);
		const paymentElement = elements.create('payment');

		paymentElement.mount('#payment-element');

	    var $form = $(".validation");
	  
	    $('form.validation').bind('submit', function(e) {
	    	e.preventDefault()
	    	var $form = $(this);
	    	$('.error').addClass('hide').find('.alert').text('');
	    	 $('#error_check').addClass('d-none');
	        $('#checkout-button').html('loading...').prop('disabled', true);
	        var check = document.querySelector( 'input[name="terms_condition"]:checked');
	        if(check == null) {
	        	$('#error_check').removeClass('d-none');
	            $('#checkout-button').html('<i class="fas fa-arrow-right label-icon align-bottom fs-16 ms-2"></i>Check Out').prop('disabled', false);
	            return false;
	        }

	        var cardinfoRadio = document.querySelector( 'input[name="cardinfo"]:checked');
	        var save_cardRadio = document.querySelector( 'input[name="save_card"]:checked');
	    
	        if(save_cardRadio == null) {
	            $('#save_card').val(0);
	        }else{
	             $('#save_card').val(1);
	        }
	       
	        if(cardinfoRadio == null) {

	            var $form  = $(".validation"),
	                inputVal = ['input[type=email]', 'input[type=password]',
	                                 'input[type=text]', 'input[type=file]',
	                                 'textarea'].join(', '),
	                $inputs       = $form.find('.required').find(inputVal),
	                $errorStatus  = $form.find('div.error'),
	                valid         = true;
	                $errorStatus.addClass('hide');
	         
	            $('.has-error').removeClass('has-error');
	            $inputs.each(function(i, el) {
	                var $input = $(el);
	                if ($input.val() === '') {
	                    $input.parent().addClass('has-error');
	                    $errorStatus.removeClass('hide');
	                    e.preventDefault();
	                }
	            });  

	            stripe.confirmSetup({
        	      	elements,
        	      	redirect: 'if_required',
        	      	confirmParams: {
        	      	}
        	    }).then(function(result){
        	    	if (result.error) {
        	    		$('.error').removeClass('hide').find('.alert').text(result.error.message);
        	    		$('#checkout-button').html('<i class="fas fa-arrow-right label-icon align-bottom fs-16 ms-2"></i>Check Out').prop('disabled', false);
        	    		return false;
        	    	}else{
        	    		console.log(result)
        	    		$.ajax({
        	    			url: '{{route('refresh_payment_methods', ['user_id' => $user->id])}}',
        	    			success: function(data){
        	    				console.log(data)
        	    				console.log('success')
        	    			}
        	    		})

        	    		$('#new_card_payment_method_id').val(result.setupIntent.payment_method)
	        	    	$form.off('submit');
		                $form.submit();
        	    	}
        	    });
	        }else{
    	    	$form.off('submit');
                $form.submit();
	        }
	    });
	  
	    function stripeHandleResponse(status, response) {
	        if (response.error) {
	            $('.error')
	                .removeClass('hide')
	                .find('.alert')
	                .text(response.error.message);
	        } else {
	            var token = response['id'];
	            $form.find('input[type=text]').empty();
	            $form.append("<input type='hidden' name='stripeToken' value='" + token + "'/>");
	            $form.get(0).submit();
	        }
	        $('#checkout-button').html('Check Out').prop('disabled', false);
	    }
	});
</script>

<script>
    $( document ).ready(function() {
        $('#checkout-button').click(function(){
            @if(!Auth::user())
                $.ajax({
                   type:'GET',
                   url:'/addcheckoutsession',
                   data:'_token = <?php echo csrf_token() ?>',
                   success:function(data) {
                   }
                });
            @endif
        });

        $('form').submit(function() {
		    var isValid = true;

		    $('.familypart').each(function() {
		      	var selectedValue = $(this).val();
		      	if (!selectedValue || selectedValue === 'addparticipate') {
		      		$('.participateAlert').removeClass('d-none');
			        isValid = false;
			        return false; 
			    }else{
			    	$('.participateAlert').addClass('d-none');
			    }
		    });

		    return isValid;
		});
    });
</script>

@endsection