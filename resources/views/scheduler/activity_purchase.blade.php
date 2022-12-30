@extends('layouts.header')
@section('content')
@include('layouts.userHeader')

@php 
	use Carbon\Carbon;
	use App\UserBookingDetail;
	use App\BusinessPriceDetailsAges;
	use App\BusinessServices;
	use App\BusinessService;
	use App\BusinessPriceDetails;
	use App\BusinessServiceReview;
	use App\User;
	use App\BusinessActivityScheduler;
	use App\CompanyInformation;
	use App\UserFamilyDetail;
    use App\BusinessTerms;
    use App\BusinessSubscriptionPlan;
@endphp

<div class="p-0 col-md-12 inner_top padding-0">
    <div class="row">
        <div class="col-md-2 col-sm-12" style="background: black;">
        	 @include('business.businessSidebar')
        </div>
		<div class="col-md-10 col-sm-12">
            <div class="container-fluid p-0">
				<div class="row">
					<div class="col-md-6 col-xs-12 col-sm-12">
						<div class="tab-hed scheduler-txt"><span>Check Out Register </span> </div>
					</div>
				</div>
				<hr style="border: 3px solid black; width: 127%; margin-left: -38px; margin-top: 5px; margin-bottom: 0px;">
				<div class="row">
					<div class="col-md-7 col-sm-12 col-xs-12">
						<div class="activity_purchase-box">
							<div class="row">
								<div class="col-md-4 col-sm-12 col-xs-12">
									<a href="#" class="btn-nxt manage-cus-btn search-add-client" data-toggle="modal" data-target="#newclient">Add New Client</a>
									<!-- <button type="button" class="btn-nxt manage-search search-add-client" id="">Add New Client </button> -->
								</div>
								<div class="col-md-5 col-sm-12 col-xs-12 ">
									<div class="manage-search serchcustomer">
										<div class="sub">
											<input type="text" id="serchclient" name="fname" placeholder="Search for client" autocomplete="off" value="{{Request::get('fname')}}">
											<div id="option-box1" style="display:none;">
						                        <ul class="customer-list">
						                        </ul>
						                    </div>
											<button ><i class="fa fa-search"></i></button>
										</div>
									</div>
								</div>
								<div class="col-md-3 col-sm-12 col-xs-12">
									<button type="button" class="btn-bck manage-search search-add-client"> Quick Sale </button>
								</div>
								
								<div class="col-md-12">
									<div class="check-client-info">
										<div class="row">
											<div class="col-md-12 col-sm-12 col-xs-12 nopadding">
												<label>Client Quick Stats</label>
											</div>
											<div class="col-md-6 col-sm-12 col-xs-12 nopadding">
												<label>Client Name: </label><span> @if($username !='') {{$username}} ({{$age}} yrs Old) @endif</span>
											</div>
											<div class="col-md-6 col-sm-12 col-xs-12 nopadding">
												<label>Location: </label><span> {{$address}}</span>
											</div>
											<div class="col-md-6 col-sm-12 col-xs-12 nopadding">
												<label>Visits:  </label><span> 20</span>
											</div>
											<div class="col-md-6 col-sm-12 col-xs-12 nopadding">
												<label>Activities Bookings: </label><span>  {{$book_cnt}}</span>
											</div>
											<div class="col-md-6 col-sm-12 col-xs-12 nopadding">
												<label>Last Membership: </label><span> {{ $price_title}}</span>
											</div>
											<div class="col-md-6 col-sm-12 col-xs-12 nopadding">
												<label>Status: </label><span> {{$status}} </span>
											</div>
											<div class="col-md-6 col-sm-12 col-xs-12 nopadding">
												<label>Current Membership: </label><span>None</span>
											</div>
											<div class="col-md-6 col-sm-12 col-xs-12 nopadding">
												<label>Last Purchase: </label><span> {{ $purchasefor}}</span>
											</div>
										</div>
									</div>
								</div>
								
								<div class="col-md-12 col-sm-12">
									<div class="check-out-steps"><label><h2 class="color-red">Step 1: </h2> Select Service</label></div>
									<div class="check-client-info-box">
										<div class="row">
											<div class="col-md-4 col-sm-4 col-xs-12">
												<div class="select0service">
													<label>Participant Quantity </label>
													<div class="choose-tip">
														<select name="qty_dropdown" id="qty_dropdown" class="form-control"onchange="gettotal('qty',this.value);">
															<option value="1" >Select </option>
															@for($i=1;$i<15;$i++)
															<option value="{{$i}}">{{$i}}</option>
															@endfor
														</select>
													</div>
												</div>
											</div>
											<div class="col-md-4 col-sm-4 col-xs-12">
												<div class="select0service">
													<label>Who's Participating </label>
													<select name="program_list" id="program_list" class="form-control" onchange="loaddropdown('participat',this,this.value);">
														@php  
															$pc_regi_id = @$user_data->id;
															$pc_value = $username.'(me)';
															$pc_user_tp = $user_type;
														@endphp
														<option value="{{@$user_data->id}}~~{{$pc_user_tp}}">{{$username}}(me)</option>
														@if(!empty($userfamily))
														@foreach($userfamily as $ufd)
															<option value="{{$ufd->id}}~~family^^{{$username}}">{{$ufd->first_name}} {{$ufd->last_name}} </option>
														@endforeach
														@endif
													</select>
												</div>
											</div>
											<div class="col-md-4 col-sm-4 col-xs-12">
												<div class="select0service">
													<label>Select Program </label>
													<select name="program_list" id="program_list" class="form-control" onchange="loaddropdown('program',this,this.value);">
														<option value="">Select</option>
														@if(!empty(@$program_list))
														@foreach($program_list as $pl)
															<option value="{{$pl->id}}">{{$pl->program_name}}</option>
														@endforeach
														@endif
													</select>
												</div>
											</div>
										</div>
										<div class="row">
											<div class="col-md-4 col-sm-4 col-xs-12">
												<label>Select Catagory </label>
												<select name="category_list" id="category_list" class="form-control" onchange="loaddropdown('category',this,this.value);">
													<option value="">Select</option>
												</select>
											</div>
											<div class="col-md-4 col-sm-4 col-xs-12">
												<label>Select Price Option  </label>
												<select name="priceopt_list" id="priceopt_list" class="form-control" onchange="loaddropdown('priceopt',this,this.value);">
													<option value="">Select</option>
												</select>
											</div>
											<div class="col-md-4 col-sm-4 col-xs-12">
												<label> Membership Option</label>
												<select name="membership_opt_list" id="membership_opt_list" class="form-control" onchange="loaddropdown('mpopt',this,this.value);">
													<option value="">Select</option>
												</select>
											</div>
										</div>
									</div>
								</div>
								
								<div class="col-md-12">
									<div class="check-out-steps"><label><h2 class="color-red">Step 2: </h2> Check Details </label></div>
									<div class="check-client-info-box">
										<div class="row">
											<div class="col-md-4 col-sm-4 col-xs-12">
												<div class="select0service">
													<label>Price </label>
													<input type="text" class="form-control valid" id="price" placeholder="$0.00" onkeyup="gettotal('','');">
												</div>
											</div>
											<div class="col-md-4 col-sm-4 col-xs-12">
												<div class="select0service">
													<label>Discount</label>
													<div class="row">
														<div class="col-md-6 col-sm-6 col-xs-6 nopadding">
															<div class="choose-tip">
																<select name="dis_amt_drop" id="dis_amt_drop" class="form-control" onchange="gettotal('','');">
																	<option value="">Choose $ or % </option>
																	<option value="$">$</option>
																	<option value="%">%</option>
																</select>
															</div>
														</div>
														<div class="col-md-6 col-sm-6 col-xs-6 nopadding">
															<div class="choose-tip">
																<input type="text" class="form-control valid" id="dis_amt" name="dis_amt" placeholder="Enter Amount" onkeyup="gettotal('','');">
															</div>
														</div>
													</div>
												</div>
											</div>
											<div class="col-md-4 col-sm-4 col-xs-12">
												<div class="select0service">
													<label>Tip Amount</label>
													<div class="row">
														<div class="col-md-6 col-sm-6 col-xs-6 nopadding">
															<div class="choose-tip">
																<select name="tip_amt_drop" id="tip_amt_drop" class="form-control" onchange="gettotal('','');">
																	<option value="">Choose $ or % </option>
																	<option value="$">$</option>
																	<option value="%">%</option>
																</select>
															</div>
														</div>
														<div class="col-md-6 col-sm-6 col-xs-6 nopadding">
															<div class="choose-tip">
																<input type="text" class="form-control valid" id="tip_amt" name="tip_amt" placeholder="Enter Amount" onkeyup="gettotal('','');">
															</div>
														</div>
													</div>
												</div>
											</div>
										</div>
										
										<div class="row">
											<div class="col-md-4 col-sm-4 col-xs-12">
												<div class="select0service">
													<div class="date-activity-scheduler date-activity-check paynowset">
														<input type="checkbox" id="paynow" name="paynow" value="1" checked>
														<label for="paynow"> Pay Now</label>
													</div>
												</div>
												
											</div>
											<div class="col-md-4 col-sm-4 col-xs-12">
												<div class="select0service">
													<label>Duration</label>
													<div class="row">
														<div class="col-md-6 col-sm-6 col-xs-6 nopadding">
															<input type="text" class="form-control valid" id="duration_int" name=duration_int placeholder="12" value="1" onkeyup="changevalue();">
														</div>
														<div class="col-md-6 col-sm-6 col-xs-6 nopadding">
															<div class="choose-tip">
																<select name="duration_dropdown" id="duration_dropdown" class="form-control" onchange="loaddropdown('duration',this,this.value);">
																	<option value="Day">Day(s) </option>
																	<option value="Hour">Hour(s)</option>
																	<option value="Minute">Minute(s)</option>
																</select>
															</div>
														</div>
													</div>
												</div>
											</div>
											<div class="col-md-4 col-sm-4 col-xs-12">
												<div class="select0service">
													<label>Date This Activaties?</label>
													<div class="date-activity-scheduler date-activity-check">
														<input type="text"  id="managecalendarservice" placeholder="Search By Date" class="form-control activity-scheduler-date w-80" autocomplete="off" value="{{date('m/d/Y')}}" onchange="changedate();">
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
								
								<div class="col-md-12">
									<div class="check-out-steps"><label><h2 class="color-red">Step 3: </h2> Check Your Booking Summary</label></div>
									<form method="post" action="{{route('addtocart')}}">
										@csrf
										<input type="hidden" name="chk" value="activity_purchase">
										<input type="hidden" name="value_tax" id="value_tax" value="0">
										<input type="hidden" name="type" value="{{$user_type}}">
										<input type="hidden" name="pageid" value="{{$book_id}}">
										<input type="hidden" name="pid" id="pid" value="">
										<input type="hidden" name="checkount_qty" id="checkount_qty" value="">
										<input type="hidden" name="priceid" value="" id="priceid">
										<input type="hidden" name="actscheduleid" value="1 Day(s)" id="actscheduleid">
										<input type="hidden" name="sesdate" value="{{date('Y-m-d')}}" id="sesdate">
										<input type="hidden" name="pricetotal" id="pricetotal" value="" class="product-price">
										<input type="hidden" name="tip_amt_val" id="tip_amt_val" value="" class="product-price">
										<input type="hidden" name="dis_amt_val" id="dis_amt_val" value="" class="product-price">
										<input type="hidden" name="pc_regi_id" id="pc_regi_id" value="{{$pc_regi_id}}" class="product-price">
										<input type="hidden" name="pc_user_tp" id="pc_user_tp" value="{{$pc_user_tp}}" class="product-price">
										<input type="hidden" name="pc_value" id="pc_value" value="{{$pc_value}}" class="product-price">
										<div class="check-client-info">
											<div class="row payment-detials">
												<div class="col-md-6 col-sm-6 col-xs-6"> 
													<label >Program Name</label>
												</div>
												<div class="col-md-6 col-sm-6 col-xs-6"> 
													<span id="p_name"></span>
												</div>
													
												<div class="col-md-6 col-sm-6 col-xs-6"> 
													<label>Catagory</label>
												</div>
												<div class="col-md-6 col-sm-6 col-xs-6"> 
													<span id="c_name"></span>
												</div>
													
												<div class="col-md-6 col-sm-6 col-xs-6"> 
													<label>Price Option</label>
												</div>
												<div class="col-md-6 col-sm-6 col-xs-6"> 
													<span id="pt_name"></span>
												</div>
													
												<div class="col-md-6 col-sm-6 col-xs-6"> 
													<label>Memberhsip Option</label>
												</div>
												<div class="col-md-6 col-sm-6 col-xs-6"> 
													<span id="mp_name"></span>
												</div>
													
												<div class="col-md-6 col-sm-6 col-xs-6"> 
													<label>Participant Quantity	</label>
												</div>
												<div class="col-md-6 col-sm-6 col-xs-6"> 
													<span id="qty"></span>
												</div>

												<div class="col-md-6 col-sm-6 col-xs-6"> 
													<label>Who's Participating</label>
												</div>
												<div class="col-md-6 col-sm-6 col-xs-6"> 
													<span id="participate">{{$username}}</span>
												</div>
													
												<div class="col-md-6 col-sm-6 col-xs-6"> 
													<label>Duration</label>
												</div>
												<div class="col-md-6 col-sm-6 col-xs-6"> 
													<span id="duration">1 Day(s)</span>
												</div>
												
												<div class="col-md-6 col-sm-6 col-xs-6"> 
													<label>Starts on </label>
												</div>
												<div class="col-md-6 col-sm-6 col-xs-6"> 
													<span id="date">{{date('m/d/Y')}}</span>
												</div>
													
												<div class="col-md-12 col-sm-12 col-xs-12">
													<div class="checkout-sapre-tor">
													</div>
												</div>
												
												<div class="col-md-6 col-sm-6 col-xs-6"> 
													<label>Tip Amount</label>
												</div>
												<div class="col-md-6 col-sm-6 col-xs-6"> 
													<span id="tip_amt_span">$0.00</span>
												</div>
												
												<div class="col-md-6 col-sm-6 col-xs-6"> 
													<label>Discount </label>
												</div>
												<div class="col-md-6 col-sm-6 col-xs-6"> 
													<span id="dis_amt_span">$0.00</span>
												</div>
												
												<div class="col-md-6 col-sm-6 col-xs-6"> 
													<div class="tax-check">
														<label>Tax </label>
														<input type="checkbox" id="tax" name="tax" value="1">
														<label for="tax"> No Tax</label><br>
													</div>
												</div>
												<div class="col-md-6 col-sm-6 col-xs-6"> 
													<span id="taxvalspan">$0.00</span>
												</div>
												
												<div class="col-md-6 col-sm-6 col-xs-6"> 
													<h2>Total</h2>
												</div>
												<div class="col-md-6 col-sm-6 col-xs-6"> 
													<h2 class="total-amount" id="total_amount">$0.00</h2>
												</div>
											</div>
										</div>
										<button type="submit" class="btn-nxt btn-search-checkout mb-00" id="">Add To Order </button>
									</form>
								</div>
							</div>						
						</div>
					</div>
					
					<div class="col-md-5 col-sm-12 col-xs-12">
						<div class="activity_purchase-box">
							<div class="ticket-summery ticket-title">
								<h4>Order Summary</h4>
							</div>
							<form method="post" action="{{route('checkout_register')}}">
								<div class="row">
									<div class="col-md-12">
										<div class="check-client-info-box">
											@php $i=1; $subtotal =0; $tip =$discount = $taxes = $service_fee= 0; $checkout_btun_chk = 0; @endphp
											@if(!empty($cart))
											@foreach($cart['cart_item'] as $item)
											@if($item['chk'] == 'activity_purchase')
											@php 
												$checkout_btun_chk = 1;
												if ($item['image']!="") {
						    						if (File::exists(public_path("/uploads/profile_pic/" . $item['image']))) {
						    							$profilePic = url('/public/uploads/profile_pic/' . $item['image']);
						    						} else {
						    							$profilePic = url('/public/images/service-nofound.jpg');
						    						}
						    					}else{ 
						    						$profilePic = url('/public/images/service-nofound.jpg');
						    					}

												$subtotal += $item['totalprice'] * @$item['qty_from_checkout_regi'];
												$tip += $item['tip'] * @$item['qty_from_checkout_regi'];
												$discount += $item['discount'] * @$item['qty_from_checkout_regi'];
												$taxval = $item["tax"];
												$participate = $item["participate_from_checkout_regi"]['pc_name'];
												$taxes += $taxval;
												$act = BusinessServices::where('id', $item["code"])->first();
												$serprice = BusinessPriceDetails::where('id', $item['priceid'])->first();
												$serpricecate = BusinessPriceDetailsAges::where('id',$serprice->category_id)->first();

												$total = $item['qty_from_checkout_regi'] *($item['totalprice'] + $item['tip']  - $item['discount'] ) + $taxval;
												$iprice = number_format($total,0, '.', '');
											@endphp
												<input type="hidden" name="itemid[]" value="<?= $item["code"]; ?>" />
							                    <input type="hidden" name="itemimage[]" value="<?= $profilePic ?>" />
							                    <input type="hidden" name="itemname[]" value="<?= $item["name"]; ?>" />
							                    <input type="hidden" name="itemqty[]" value="1" />
							                    <input type="hidden" name="itemprice[]" value="<?= $iprice * 100; ?>" />
							                   
							                    <input type="hidden" name="itemparticipate[]" id="itemparticipate" value="" />
												<div class="close-cross-icon"> 
													<i class="fas fa-pencil-alt"></i>
												</div>
												<div class="close-cross-icon-trash">
													<a href="{{route('removetocart',['code'=>$item['code'],'pageid'=>$book_id,'chk'=>'purchase','user_type'=>$user_type])}}" class="p-red-color">
													<i class="fas fa-trash-alt"></i></a>
												</div>
												<div class="ticket-summery-details">
													<div class="row">
														<div class="col-md-6 col-sm-6 col-xs-6">
															<label>Program Name </label>
														</div>
														<div class="col-md-6 col-sm-6 col-xs-6">
															<span>{{$act->program_name}} </span>
														</div>
														
														<div class="col-md-6 col-sm-6 col-xs-6">
															<label>Catagory: </label>
														</div>
														<div class="col-md-6 col-sm-6 col-xs-6">
															<span>{{$serpricecate->category_title}}</span>
														</div>
														
														<div class="col-md-6 col-sm-6 col-xs-6">
															<label>Price Option:</label>
														</div>
														<div class="col-md-6 col-sm-6 col-xs-6">
															<span>{{@$serprice['price_title']}} - {{@$serprice['pay_session']}} Sessions</span>
														</div>
														
														<div class="col-md-6 col-sm-6 col-xs-6">
															<label>Membership Option:</label>
														</div>
														<div class="col-md-6 col-sm-6 col-xs-6">
															<span>{{@$serprice['membership_type']}}</span>
														</div>

														<div class="col-md-6 col-sm-6 col-xs-6">
															<label>Participant Quantity:</label>
														</div>
														<div class="col-md-6 col-sm-6 col-xs-6">
															<span>{{@$item['qty_from_checkout_regi']}}</span>
														</div>

														<div class="col-md-6 col-sm-6 col-xs-6">
															<label>Who's Participating:</label>
														</div>
														<div class="col-md-6 col-sm-6 col-xs-6">
															<span>{{@$participate}}</span>
														</div>

														<div class="col-md-6 col-sm-6 col-xs-6">
															<label>Duration:</label>
														</div>
														<div class="col-md-6 col-sm-6 col-xs-6">
															<span>{{$item['actscheduleid']}}</span>
														</div>

														<div class="col-md-6 col-sm-6 col-xs-6">
															<label>Starts On:</label>
														</div>
														<div class="col-md-6 col-sm-6 col-xs-6">
															<span>{{date('m/d/Y',strtotime($item['sesdate']))}}</span>
														</div>
														
														<div class="col-md-6 col-sm-6 col-xs-6">
															<label class="total0spretor">Tip Amount </label>
														</div>
														<div class="col-md-6 col-sm-6 col-xs-6">
															<span class="total0spretor">${{$item['tip'] * @$item['qty_from_checkout_regi']}}</span>
														</div>
														
														<div class="col-md-6 col-sm-6 col-xs-6">
															<label>Discount </label>
														</div>
														<div class="col-md-6 col-sm-6 col-xs-6">
															<span>${{$item['discount'] * @$item['qty_from_checkout_regi']}}</span>
														</div>
														
														<div class="col-md-6 col-sm-6 col-xs-6">
															<label>Taxes (NYC) </label>
														</div>
														<div class="col-md-6 col-sm-6 col-xs-6">
															<span>${{$taxval}}</span>
														</div>
														
														<div class="col-md-6 col-sm-6 col-xs-6">
															<h2>Total </h2>
														</div>
														<div class="col-md-6 col-sm-6 col-xs-6">
															<h2 class="total-amount"> ${{$total}}</h2>
														</div>
														@if($i != count($cart['cart_item']))
														<div class="col-md-12 col-sm-12 col-xs-12">
															<div class="checkout-sapre-tor">
															</div>
														</div>
														@endif
													</div>
												</div>
											@php $i++;@endphp
											@endif
											@endforeach
											@endif
										</div>
									</div>
								</div>
								@php  	
									$service_fee= ($subtotal * $tax->service_fee)/100; 
							 		$grand_total  = 0 ;
							 		$grand_total = ($service_fee + $subtotal + $tip + $taxes) - $discount;
							 		$grand_total = number_format($grand_total,0, '.', '');
								@endphp
								<div class="row">
									<div class="col-md-12">
										<div class="check-client-info total-checkout">
											<div class="row">
												<div class="col-md-6 col-sm-6 col-xs-6">
													<h3 class="total0spretor-bt">Subtotal </h3>
												</div>
												<div class="col-md-6 col-sm-6 col-xs-6">
													<h3 class="total0spretor-bt total-amount">${{$subtotal}} </h3>
												</div>
												
												<div class="col-md-6 col-sm-6 col-xs-6">
													<label>Tip</label>
												</div>
												<div class="col-md-6 col-sm-6 col-xs-6">
													<span>${{$tip}}</span>
												</div>
												
												<div class="col-md-6 col-sm-6 col-xs-6">
													<label>Discount </label>
												</div>
												<div class="col-md-6 col-sm-6 col-xs-6">
													<span>${{$discount}}</span>
												</div>
												
												<div class="col-md-6 col-sm-6 col-xs-6">
													<label>Tax </label>
												</div>
												<div class="col-md-6 col-sm-6 col-xs-6">
													<span>${{$taxes}}</span>
												</div>
												
												<div class="col-md-6 col-sm-6 col-xs-6">
													<label>Service Fee: {{$tax->service_fee}}% </label>
												</div>
												<div class="col-md-6 col-sm-6 col-xs-6">
													<span> ${{$service_fee}}</span>
												</div>
												<div class="col-md-12 col-sm-12 col-xs-12">
													<div class="checkout-sapre-tor">
													</div>
												</div>
												<div class="col-md-6 col-sm-6 col-xs-6">
													<h2>Grandtotal</h2>
												</div>
												<div class="col-md-6 col-sm-6 col-xs-6">
													<h2 class="total-amount">${{$grand_total}}</h2>
												</div>
												
											</div>
										</div>
									</div>
								</div>
							
								@csrf
								
								<input type="hidden" name="user_id" value="{{@$user_data->id}}">
								<input type="hidden" name="user_type" value="{{@$user_type}}">
								<div class="row">
									<div class="col-md-12 col-sm-12 col-xs-12">
										<div class="payment-method">
											<label>Select Payment Method</label>
										</div>
									</div>
									<div class="col-md-4 col-sm-4 col-xs-12">
										<label class="pay-card" style="color:#000; background: #e9e9e9; margin-bottom: 15px;">
										<input name="cardinfo" class="payment-radio" type="radio" value="cash" >
											<span class="plan-details checkout-card">
	                                            <div class="row">
	                                               <div class="col-md-12">
	                                                  <div class="payment-method-img">
	                                                      <img src="{{asset('/public/images/cash-icon.png')}}" alt="img" class="w-100" width="100">
	                                                  </div>
	                                               </div>
	                                               <div class="col-md-12">
														<div class="cart-name checkout-cart">
	                                                        <span>Cash</span>
	                                                    </div>
	                                                    <div class="cart-num checkout-cart">
	                                                       <span></span>
	                                                    </div>
	                                               </div>
	                                            </div>
	                                       </span>
	                                     </label>
									</div>
									@if(!empty($cardInfo)) 
									 	@foreach($cardInfo as $card) 
	                                    	@php $brandname = ucfirst($card['brand']); @endphp
											<div class="col-md-4 col-sm-4 col-xs-12">
												<label class="pay-card" style="color:#000; background: #e9e9e9; margin-bottom: 15px;">
		                                        <input name="cardinfo" class="payment-radio" type="radio" value="cardonfile" extra-data="{{$brandname }}: XXXX{{$card['last4']}}  Exp. {{$card['exp_month']}}/{{$card['exp_year']}}" card-id="{{$card['id']}}">
		                                            <span class="plan-details checkout-card">
		                                                <div class="row">
		                                                    <div class="col-md-12">
		                                                        <div class="payment-method-img">
		                                                            <img src="{{asset('/public/images/cc-on-file.png')}}" alt="img" class="w-100" width="100">
		                                                        </div>
		                                                    </div>
		                                                    <div class="col-md-12">
																<div class="cart-name checkout-cart">
		                                                           <span>CC (On File)</span>
		                                                         </div>
		                                                         <div class="cart-num checkout-cart">
		                                                            <span>{{$brandname}} XX{{$card['last4']}}</span>
		                                                         </div>
		                                                    </div>
		                                                </div>
		                                           </span>
		                                       </label>
											</div>
										@endforeach
									@endif
									
									<div class="col-md-4 col-sm-4 col-xs-12">
										<label class="pay-card" style="color:#000; background: #e9e9e9; margin-bottom: 15px;">
	                                    <input name="cardinfo" class="payment-radio" type="radio" value="newcard">
	                                        <span class="plan-details checkout-card">
	                                            <div class="row">
	                                                <div class="col-md-12">
	                                                    <div class="payment-method-img">
	                                                        <img src="{{asset('/public/images/input-cc.png')}}" alt="img" class="w-100" width="100">
	                                                    </div>
	                                                </div>
	                                                <div class="col-md-12">
														<div class="cart-name checkout-cart">
	                                                        <span>CC (Input Cart)</span>
	                                                    </div>
	                                                    <div class="cart-num checkout-cart">
	                                                        <span></span>
	                                                    </div>
	                                                </div>
	                                            </div>
	                                        </span>
	                                   </label>
									</div>

									<div class="col-md-4 col-sm-4 col-xs-12">
										<label class="pay-card" style="color:#000; background: #e9e9e9; margin-bottom: 15px;">
                                        <input name="cardinfo" class="payment-radio" type="radio" value="check">
                                            <span class="plan-details checkout-card">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="payment-method-img">
                                                            <img src="{{asset('/public/images/check.png')}}" alt="img" class="w-100" width="100">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12">
														<div class="cart-name checkout-cart">
                                                           <span>Check</span>
                                                         </div>
                                                    </div>
                                                </div>
                                           </span>
                                       </label>
									</div>
									
									<div class="col-md-4 col-sm-4 col-xs-12">
										<label class="pay-card" style="color:#000; background: #e9e9e9; margin-bottom: 15px;">
                                        <input name="cardinfo" class="payment-radio" type="radio"  value="comp">
                                            <span class="plan-details checkout-card">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="payment-method-img">
                                                            <img src="{{asset('/public/images/comp.png')}}" alt="img" class="w-100" width="100">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12">
														<div class="cart-name checkout-cart">
                                                           <span>Comp</span>
                                                         </div>
                                                    </div>
                                                </div>
                                           </span>
                                       </label>
									</div>

									<div class="col-md-12">
										<div class="check-client-info mathod-display">
											<div class="payment-selection">
												<h3>Payment Method Selected</h3>
											</div>
											<div id="addpmtmethods">
												<div class="row" id="cashdiv" style="display: none;">
													<div class="col-md-1">
														<div class="close-div">
															<div class="close-cross"> 
																<i class="fas fa-times"></i>
															</div>
														</div>
													</div>
													<div class="col-md-3">
														<input type="text" class="form-control valid" id="cash_amt" name="cash_amt" placeholder="0.00"  value="{{$grand_total}}">
													</div>
													<div class="col-md-8">
														<label>Cash</label>
													</div>
													
													<div class="col-md-12">
														<div class="changecalce">
															<label>Change Calculator</label>
														</div>
													</div>
													<div class="col-md-5">
														<div class="cash-tend">
															<span>Cash tendered</span>
														</div>
													</div>
													<div class="col-md-3 nopadding">
														<input type="text" class="form-control valid" id="cash_amt_tender" name="cash_amt_tender" placeholder="0.00" >
													</div>
													<div class="col-md-2 nopadding">
														<div class="cash-tend-option">
															<span>(Optional)</span>
														</div>
													</div>
													<div class="col-md-5">
														<div class="cash-tend">
															<span>Cash Change:</span>
														</div>
													</div>

													<div class="col-md-2 nopadding">
														<div class="cash-tend-option">
															<label id="cash_amt_change">$0.00</label>
														</div>
													</div>

													<div class="col-md-12 col-sm-12 col-xs-12">
														<div class="checkout-sapre-tor">
														</div>
													</div>
												</div>
											
												<div class="row" id="ccfilediv"  style="display: none;">
													<div class="col-md-1">
														<div class="close-div">
															<div class="close-cross"> 
																<i class="fas fa-times"></i>
															</div>
														</div>
													</div>
													<div class="col-md-3">
														<input type="text" class="form-control valid" id="cc_amt" name="cc_amt" placeholder="0.00" >
													</div>
													<div class="col-md-8">
														<label>CC(Key/Stored)</label>
													</div>
													
													<div class="col-md-12">
														<div class="options-payment">
															<form action="">
																<input type="radio" id="html" name="fav_language" value="" checked>
															 	<label for="html">Option 1 :</label> 
																<span>Use billing information on  file.</span><br>
																<span class="visa-info"></span><br>
															</form>
														</div>
													</div>
													<div class="col-md-12 col-sm-12 col-xs-12">
														<div class="checkout-sapre-tor">
														</div>
													</div>
												</div>	

												<div class="row" id="checkdiv"  style="display: none;">
													<div class="col-md-1">
														<div class="close-div">
															<div class="close-cross"> 
																<i class="fas fa-times"></i>
															</div>
														</div>
													</div>
													<div class="col-md-3">
														<input type="text" class="form-control valid" id="check_amt" name="check_amt" placeholder="0.00" >
													</div>
													<div class="col-md-8">
														<label>Check</label>
													</div>
													<div class="col-md-12">
														<div class="row">
															<div class="cash-tend">
																<input type="text" class="form-control valid" id="check_number" name="check_number" placeholder="check#" >
															</div>
														</div>
													</div>
													<div class="col-md-12 col-sm-12 col-xs-12">
														<div class="checkout-sapre-tor">
														</div>
													</div>
												</div>	

												<div id="ccnewdiv"  style="display: none;"> 
													<div class="col-md-1">
														<div class="close-div">
															<div class="close-cross"> 
																<i class="fas fa-times"></i>
															</div>
														</div>
													</div>
													<div class="col-md-3">
														<input type="text" class="form-control valid" id="cc_new_card_amt" name="cc_new_card_amt" placeholder="0.00" >
													</div>
													<div class="col-md-8">
														<label>CC(Input Card)</label>
													</div>
													<div class="col-md-12">
						        						<div class="row" >
						        							<div class="col-xl-6 col-lg-6 col-md-6 col-sm-12  required">
						        								<div id="card-number-field" class="card-space">
						        									<label for="cardNumber">Card Number</label>
						        									<input  type="text" name="cardNumber" id="cardNumber" placeholder="0000 0000 0000 0000" class="form-control card-num" > 
						        								</div>
						        							</div>
						        							<div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 required" >
						        								<div id="" class="card-space">
						        									<label for="owner">Name On Card</label>
						                                            <input type="text" name="owner" id="owner" placeholder="ENTER YOUR NAME HERE" class="form-control">
						        								</div>
						        							</div>
						        						</div>
						        						<div class="row">
						        							<div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 expiration required">
						        								<div id="expiration-date" class="card-space">
						        									<label for="owner">Exp Month</label>
						                                            <input type="text" name="month" id="month" placeholder="MM" class="form-control card-expiry-month">
						        								</div>
						        							</div>
						                                    <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 expiration required">
						                                        <div id="expiration-date" class="card-space">
						                                            <label for="owner">Exp Year</label>
						                                            <input  type="text" name="year" id="year" placeholder="YYYY" class="form-control card-expiry-year">
						                                        </div>
						                                    </div>
						        							<div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 cvc required">
						        								<div id="" class="card-space">
						        									<label for="cvv">CVV</label>
						                                            <input  type="text" name="cvv" id="cvv" placeholder="- - -" class="form-control card-cvc">
						        								</div>
						        							</div>
						                                    <div class="col-md-12">
						                                        <div class="save-pmt-checkbox">
						                                            <input type="checkbox" id="save_card" name="save_card" value="1">
						                                            <label>Save for future payments</label>
						                                        </div>
						                                    </div>
						                                    <div class='form-row row'>
						                                        <div class='col-md-12 hide error form-group'>
						                                            <div class='alert-danger alert'>Fix the errors before you begin.</div>
						                                        </div>
						                                    </div>
						        						</div> 
						        						<div class="col-md-12 col-sm-12 col-xs-12">
															<div class="checkout-sapre-tor">
															</div>
														</div>
						        					</div>
					                            </div>

											</div>
										</div>
									</div>

									<input type="hidden" name="grand_total" id="grand_total" value="{{$grand_total}}">
									<input type="hidden" name="cash_change" id="cash_change" value="">
									<input type="hidden" name="card_id" id="card_id" value="">
									<div class="col-md-6 col-sm-6 col-xs-12 ">
										<button type="button" class="btn-bck activity-purchase mb-00" id="total_remaing">Total Amount Remaining $0.00</button>
									</div>

									<div class="col-md-6 col-sm-6 col-xs-12 ">
										<button type="submit" class="btn-nxt activity-purchase mb-00" @if($checkout_btun_chk == 0) disabled  @endif>Complete Payment</button>
									</div>
								</div>
							</form>				
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>

<script type="text/javascript">

	function changevalue(){
		$('#duration').html($('#duration_int').val() +' '+ $('#duration_dropdown').val());
		$('#actscheduleid').html($('#duration_int').val() +' '+ $('#duration_dropdown').val());
	}

	function changedate(){
		$('#date').html($('#managecalendarservice').val());
		$('#sesdate').val($('#managecalendarservice').val());
	}

	function loaddropdown(chk,val,id){
		var selectedText = val.options[val.selectedIndex].innerHTML;
		if(chk == 'program'){
			$('#pid').val(id);
			$('#p_name').html(selectedText);
			$('#category_list').html('');
			$('#priceopt_list').html('');
			$('#membership_opt_list').html('');
		}
		if(chk == 'category'){
			$('#c_name').html(selectedText);
			$('#priceopt_list').html('');
			$('#membership_opt_list').html('');
		}
		if(chk == 'priceopt'){
			$('#priceid').val(id);
			$('#pt_name').html(selectedText);
			$('#membership_opt_list').html('');
		}
		if(chk == 'mpopt'){
			$('#mp_name').html(selectedText);
		}

		if(chk == 'duration'){
			$('#duration').html($('#duration_int').val() +' '+ selectedText);
			$('#actscheduleid').val($('#duration_int').val() +' '+ selectedText);
		}

		if(chk == 'participat'){
			var data = id.split('~~');
			var data1 = data[1].split('^^');
			$('#pc_regi_id').val(data[0]);
			$('#pc_user_tp').val(data1[0]);
		}
		
		
		$.ajax({
			url: '{{route("getdropdowndata")}}',
			type: 'get',
			data:  {
				'sid':id,
				'chk':chk,
				'user_type':'{{$user_type}}',
			},
			success:function(data){
				if(chk == 'program'){
					$('#category_list').html(data);
				}
				if(chk == 'category'){
					$('#priceopt_list').html(data);
				}
				if(chk == 'priceopt'){
					$('#membership_opt_list').html(data);
				}

				if(chk == 'participat'){
					$('#participate').html(data);
					$('#pc_value').val(data);
				}
				
			}
		});
	}

	function gettotal(chk,dropval){
		var dis_val = 0;
		var tip_val = 0;
		var sub_tot = 0;
		var sub_tot_tip = 0;
		var sub_tot_dis = tax = 0;
		var price = parseInt($('#price').val());
		var dis = $('#dis_amt_drop').val();
	 	var tip = $('#tip_amt_drop').val();
	 	dis_val  = parseInt($('#dis_amt').val());
		tip_val =parseInt($('#tip_amt').val());
		tax = parseFloat($('#value_tax').val());
		if(tip != undefined){
	 		if($('#tip_amt').val() != ''){
		 		if(tip == '' || tip == '%'){
		 			sub_tot_tip = (price * tip_val) /100;
		 			$('#tip_amt_span').html($('#tip_amt').val() + ' %');
		 		}else{
		 			sub_tot_tip = tip_val;
		 			$('#tip_amt_span').html($('#tip_amt').val() + ' $');
		 		}
		 		$('#tip_amt_val').val(sub_tot_tip);
		 	}else{
		 		$('#tip_amt_val').val('');
		 	}
	 	}

	 	if(dis != undefined){
	 		if($('#dis_amt').val() != ''){
	 			if(dis == '' || dis == '%'){
	 				sub_tot_dis = (price * dis_val) /100;
	 				$('#dis_amt_span').html($('#dis_amt').val() + ' %');
		 		}else{
		 			sub_tot_dis = dis_val;
					$('#dis_amt_span').html($('#dis_amt').val() + ' $');
		 		}
		 		$('#dis_amt_val').val(sub_tot_dis);
	 		}else{
	 			$('#dis_amt_val').val('');
	 		}
	 	}
	 	

	 	if($('#price').val() != ''){
	 		var tot = price + sub_tot_tip - sub_tot_dis;
	 		if(dropval !=''){
	 			tot = dropval * tot;
	 		}else{
	 			tot = $('#qty_dropdown').val() * tot;
	 		}
	 		
	 		tot = tax + tot ; 
	 		$('#total_amount').html('$'+ tot);
	 		$('#pricetotal').val(price);
	 	}

	 	if(chk == 'qty'){
			$('#qty').html(dropval);
			$('#checkount_qty').val(dropval);
		}
	}   

	$('.close-div').click(function() {
		var name = $(this).parent('div').parent('div').attr('id');
		$("#"+name).css('display','none');
		if(name == 'cashdiv'){
			$('#cash_amt_tender').val(0);
			//$('#cash_amt').val('');
			$('#cash_amt_change').html('$0.00');
		}else if(name == 'ccfilediv'){
			$('#cc_amt').val(0);
			$('#card_id').val('');
		}else if(name == 'newcard'){
			$('#cc_new_card_amt').val(0);
		}else if(name == 'checkdiv'){
			$('#check_amt').val(0);
		}
		
		myMethod();
	});

	$('input[type=radio][name=cardinfo]').change(function() {
	    if (this.value == 'cash') {
	    	$('#cashdiv').css('display','block');
	    }else if(this.value == 'check'){
	    	if($('#cashdiv').is(":hidden") && $('#ccfilediv').is(":hidden") && $('#ccnewdiv').is(":hidden")) {
	    		$('#check_amt').val('{{$grand_total}}');
	    	}
	        $('#checkdiv').css('display','block');
	        myMethod();
	    }else if(this.value == 'newcard'){
	    	if($('#cashdiv').is(":hidden") && $('#ccfilediv').is(":hidden")) {
	    		$('#cc_new_card_amt').val('{{$grand_total}}');
	    	}
	    	$('#ccnewdiv').css('display','block');
	    	myMethod();
	    }else if(this.value == 'cardonfile'){
	    	if($('#cashdiv').is(":hidden") && $('#ccnewdiv').is(":hidden")) {
	    		$('#cc_amt').val('{{$grand_total}}');
	    	}
	    	$('#card_id').val($(this).attr("card-id"));
	    	$('.visa-info').html($(this).attr("extra-data"));
	        $('#ccfilediv').css('display','block');
	        myMethod();
	    }else{

	    }
	});

	document.getElementById("cash_amt").onkeyup = function() {myMethod()};

	document.getElementById("cash_amt_tender").onkeyup = function() {myMethod()};

	function myMethod() {
		var cash_amt_tender = parseFloat($('#cash_amt_tender').val());
		var cash_amt = parseFloat($('#cash_amt').val());
		var tot =0;
		if($('#cash_amt_tender').val()!= ''  && $('#cash_amt').val()!= ''){
			tot  = Math.abs(Number(cash_amt-cash_amt_tender));
			if(cash_amt_tender < cash_amt){
				tot_btn  = tot;
				if($('#ccfilediv').is(':visible')){
					$('#cc_amt').val(tot_btn);
				}
				if($('#ccnewdiv').is(':visible')){
					$('#cc_new_card_amt').val(tot_btn);
				}
				$('#cash_change').val('0');
			}else{
				tot_btn  = '0.00';
				if($('#ccfilediv').is(':visible')){
					$('#cc_amt').val(0);
				}
				if($('#ccnewdiv').is(':visible')){
					$('#cc_new_card_amt').val(0);
				}
				$('#cash_change').val(tot);
			}
			if($('#ccfilediv').is(':visible')){
				var cash = cash_amt_tender + parseFloat($('#cc_amt').val());
				if( cash === cash_amt){
					$('#total_remaing').html('Total Amount Remaining $0.00');
				}else{
					$('#total_remaing').html('Total Amount Remaining $'+tot_btn);
				}
			}else if($('#ccnewdiv').is(':visible')){
				var cash = cash_amt_tender + parseFloat($('#cc_new_card_amt').val());
				if( cash === cash_amt){
					$('#total_remaing').html('Total Amount Remaining $0.00');
				}else{
					$('#total_remaing').html('Total Amount Remaining $'+tot_btn);
				}
			}else{
				$('#total_remaing').html('Total Amount Remaining $'+tot_btn);
			}
			$('#cash_amt_change').html('$'+ tot);
		}
	}

    $(document).on('keyup', '#serchclient', function() {
    	var _token = '{{csrf_token()}}';
	  	$.ajax({
	      	type: "GET",
	      	url: "{{route("business_customer_index", ['business_id' => $companyId])}}",
	      	data: { fname: $(this).val(),  _token: _token, },
	      	success: function(data) {
	        	$("#option-box1 .customer-list").html('');
	        	console.log(data);
	        	$.each(data, function(index, customer){

	        		let customer_row = $('<li class="searchclick" onClick="searchclick(' + customer.id + ')"><input type="hidden" name="_token" value="'+_token+'"><div class="row rowclass-controller"></div>');
		          	let content = customer_row.find('.rowclass-controller');
		          	let profile_img = '<div class="collapse-img"><div class="company-list-text" style="height: 50px;width: 50px;"><p style="padding: 0;">A</p></div></div>';

		          	if(customer.profile_pic_url){
		            	profile_img = '<img src="' + (customer.profile_pic_url ? customer.profile_pic_url : '') + '" style="width: 50px;height: 50">';            
		          	}
		          	customer_row.append('<div class="col-md-2">' + profile_img + '</div>');
		          	customer_row.append('<div class="col-md-10 div-controller">' + 
		              '<p class="pstyle"><label class="liaddress">' + customer.fname + ' ' +  customer.lname  + (customer.age ? ' (52  Years Old)' : '') + '</label></p>' +
		              '<p class="pstyle liaddress">' + customer.email +'</p>' + 
		              '<p class="pstyle liaddress">' + customer.phone_number + '</p></div></li>');
		          	$("#option-box1 .customer-list").append(customer_row);
		        })
	        	$("#option-box1").show();
	      	}
	  	});
	});

	$("#tax").click(function () {
		var tax = '';
        if ($("#tax").is(":checked")) {
        	if($('#price').val() != ''){
        		tax = '$' + (parseFloat($('#price').val()) * '{{ $tax->site_tax}}')/100 ;
        		$('#value_tax').val((parseFloat($('#price').val()) * '{{ $tax->site_tax}}')/100 );
        	}else{
        		tax = '$0.00';
        		$('#value_tax').val(0);
        	}
            $("#taxvalspan").html(tax);
        } else {
            $("#taxvalspan").html('$0.00');
            $('#value_tax').val(0);
        }
        gettotal('','');
    });

    function searchclick(cid){
    	var url = '{{env("APP_URL")}}';
    	//document.getElementById("myForm").submit();
    	var url = url+'/activity_purchase/0/'+cid;
	 	window.location.href = url;
	}

</script>

<script type="text/javascript">
	$("#business_name").keyup(function() {
      $.ajax({
          type: "POST",
          url: "/searchcustomersaction",
          data: { query: $(this).val(),  _token: '{{csrf_token()}}', },
          beforeSend: function() {
              //$("#label").css("background","#FFF url(LoaderIcon.gif) no-repeat 165px");
          },
          success: function(data) {
              $("#option-box").show();
              $("#option-box").html(data);
              $("#business_name").css("background", "#FFF");
          }
      });
  	});

	function registerUser() {
    	
       /* var valchk = getAge();*/
        var validForm = $('#frmregister').valid();
        var posturl = '/customers/registration';
        if (!jQuery("#b_trm1").is(":checked")) {
           $("#termserror").html('Plese Agree Terms of Service and Privacy Policy.').addClass('alert-class alert-danger');
            return false;
        }
       /* if(valchk == 1){
            $('#register_submit').prop('disabled', true);*/
            if (validForm) {
                var formData = $("#frmregister").serialize();
                $.ajax({
                    url: posturl,
                    type: 'POST',
                    dataType: 'json',
                    data: formData,
                    beforeSend: function () {
                        $('#register_submit').prop('disabled', true).css('background','#999999');
                        showSystemMessages('#systemMessage', 'info', 'Please wait while we register you with Fitnessity.');
                        $("#systemMessage").html('Please wait while we register you with Fitnessity.').addClass('alert-class alert-danger');
                    },
                    complete: function () {
                    
                        $('#register_submit').prop('disabled', true).css('background','#999999');
                    },
                    success: function (response) {
                        $("#systemMessage").html(response.msg).addClass('alert-class alert-danger');
                        showSystemMessages('#systemMessage', response.type, response.msg);
                        if (response.type === 'success') {
                        	// $("#frmregister")[0].reset();
                        	$("#systemMessage").html(response.msg).addClass('alert-class alert-danger');
                        	$("#divstep1").css("display","none");
                        	$("#divstep3").css("display","block");
                        	$("#cust_id").val(response.id);
                        } else {
                            $('#register_submit').prop('disabled', false).css('background','#ed1b24');
                        }
                    }
                });
            }
        
        /*}else{
            $("#systemMessage").html('You must be at least 13 years old.').addClass('alert-class alert-danger');
        }*/
    }

  	function changeformate_fami_pho(idname) {
      /*alert($('#contact').val());*/
      var con = $('#'+idname).val();
      var curchr = con.length;
      if (curchr == 3) {
          $('#'+idname).val("(" + con + ")" + "-");
      } else if (curchr == 9) {
          $('#'+idname).val(con + "-");
      }
    }

    function getcustomerlist(){
		$('#option-box1').hide();
		var inpuval = $('#serchclient').val();
		if(inpuval == ''){
			$('#chk').val('empty');
			$('#id').val('{{$companyId}}');
		}else{
			$('#chk').val('notempty');
			$('#id').val(inpuval);
		}
		
		$.ajax({
<<<<<<< HEAD
			url:'',
=======
			url:'{{route("business_customer_index", ["business_id" => $companyId])}}',
>>>>>>> d5b69c6f719c6bc7b6dedd8c8f6edee37f23e331
			type:"GET",
			data:{
				inpuval:inpuval
			},
			success:function(response){
				$('#customerlist').html(response);
			}
		});
	}

	

	/*$("#serchclient").keyup(function() {
      $.ajax({
          type: "POST",
          url: "/searchcustomersaction",
          data: { query: $(this).val(),  _token: '{{csrf_token()}}', },
          beforeSend: function() {
              //$("#label").css("background","#FFF url(LoaderIcon.gif) no-repeat 165px");
          },
          success: function(data) {
              $("#option-box1").show();
              $("#option-box1").html(data);
              $("#serchclient").css("background", "#FFF");
          }
      });
    });*/

    $(".dobdate").keyup(function(){
      if ($(this).val().length == 2){
          $(this).val($(this).val() + "/");
      }else if ($(this).val().length == 5){
          $(this).val($(this).val() + "/");
      }
  	});

    $(".birthday").keyup(function(){
        if ($(this).val().length == 2){
            $(this).val($(this).val() + "/");
        }else if ($(this).val().length == 5){
            $(this).val($(this).val() + "/");
        }
    });

	$("#frmregister").submit(function (e) {
      e.preventDefault();
      $('#frmregister').validate({
          rules: {
              firstname: "required",
              lastname: "required",
              username: "required",
              email: {
                  required: true,
                  email: true
              },
              /*dob: {
                  required: true,
              },*/
              password: {
                  required: true,
                  minlength: 8
              },
              confirm_password: {
                  required: true,
                  minlength: 8,
                  equalTo: "#password"
              },
          },
          messages: {
              firstname: "Enter your Firstname",
              lastname: "Enter your Lastname",
              username: "Enter your Username",
              email: {
                  required: "Please enter a valid email address",
                  minlength: "Please enter a valid email address",
                  remote: jQuery.validator.format("{0} is already in use")
              },
             /* dob: {
                  required: "Please provide your date of birth",
              },*/
              password: {
                  required: "Provide a password",
                  minlength: jQuery.validator.format("Enter at least {0} characters")
              },
              confirm_password: {
                  required: "Repeat your password",
                  minlength: jQuery.validator.format("Enter at least {0} characters"),
                  equalTo: "Enter the same password as above"
              },
          },
          submitHandler: registerUser
      });
  	});

    $('#email').on('blur', function() {
      var posturl = '{{route("emailvalidation_customer")}}';
      var formData = $("#frmregister").serialize();
      $.ajax({
            url: posturl,
            type: 'get',
            dataType: 'json',
            data: formData,  
             beforeSend: function () {
                $("#systemMessage").html('');
            },             
            success: function (response) {                    
                $("#systemMessage").html(response.msg).addClass('alert-class alert-danger');  
            }
        });
  });

    $(document).on('click', '#step3_next', function () {
        $("#err_gender").html("");
        /*if ($('input[name="gender"]:checked').val() == '' || $('input[name="gender"]:checked').val() == 'undefined' || $('input[name="gender"]:checked').val() == undefined) {
            $("#err_gender").html('Please select your gender');
        } else {*/
            if ($('input[name="gender"]:checked').val() == 'other' && $('#othergender').val() == '') {
                $("#err_gender").html('Please enter other gender');
            } else {
                var posturl = '/customers/savegender';
                var formdata = new FormData();
                formdata.append('_token', '{{csrf_token()}}')
                formdata.append('cust_id', $('#cust_id').val())
                var g = $('input[name="gender"]:checked').val() == 'other' ? $('#othergender').val() : $('input[name="gender"]:checked').val();
                formdata.append('gender', g);
                $.ajax({
                    url: posturl,
                    type: 'POST',
                    dataType: 'json',
                    data: formdata,
                    processData: false,
                    contentType: false,
                    headers: {
                        'X-CSRF-TOKEN': $("#_token").val()
                    },                
                    beforeSend: function () {
                        $('.step3_next').prop('disabled', true).css('background','#999999');
                        $('#systemMessage').html('Please wait while we processed you with Fitnessity.');
                    },
                    complete: function () {
                        $('.step3_next').prop('disabled', false).css('background','#ed1b24');
                    },
                    success: function (response) {
                       $("#divstep3").css("display","none");
                       $("#divstep4").css("display","block");
                    }
                });
            }
        //}
    });

    $(document).on('click', '#step4_next', function () {
      
        var address_sign = $('#b_address').val();
        var country_sign = $('#b_country').val();
        var city_sign = $('#b_city').val();
        var state_sign = $('#b_state').val();
        var zipcode_sign = $('#b_zipcode').val();
        var lon = $('#lon').val();
        var lat = $('#lat').val();
        
        $('#err_address_sign').html('');
        $('#err_country_sign').html('');
        $('#err_city_sign').html('');
        $('#err_state_sign').html('');
        $('#err_zipcode_sign').html('');
        
        /*if(address_sign == ''){
            $('#err_address_sign').html('Please enter address');
            $('#address_sign').focus();
            return false;
        }
        if(country_sign == ''){
            $('#err_country_sign').html('Please enter country');
            $('#country_sign').focus();
            return false;
        }
        if(city_sign == ''){
            $('#err_city_sign').html('Please enter city');
            $('#city_sign').focus();
            return false;
        }
        if(state_sign == ''){
            $('#err_state_sign').html('Please enter state');
            $('#state_sign').focus();
            return false;
        }
        if(zipcode_sign == ''){
            $('#err_zipcode_sign').html('Please enter zipcode');
            $('#zipcode_sign').focus();
            return false;
        }*/

        var posturl = '/customers/saveaddress';
        var formdata = new FormData();
        formdata.append('_token', '{{csrf_token()}}')
        formdata.append('address', address_sign)
        formdata.append('country', country_sign)
        formdata.append('city', city_sign)
        formdata.append('state', state_sign)
        formdata.append('zipcode', zipcode_sign)
        formdata.append('lon', lon)
        formdata.append('lat', lat)
        formdata.append('cust_id', $('#cust_id').val())
        $.ajax({
            url: posturl,
            type: 'POST',
            dataType: 'json',
            data: formdata,
            processData: false,
            contentType: false,
            headers: {
                'X-CSRF-TOKEN': $("#_token").val()
            },
            beforeSend: function () {
                $('.step4_next').prop('disabled', true).css('background','#999999');
                $('#systemMessage').html('Please wait while we processed you with Fitnessity.');
            },
            complete: function () {
                $('.step4_next').prop('disabled', false).css('background','#ed1b24');
            },
            success: function (response) {
                $("#divstep4").css("display","none");
                $("#divstep5").css("display","block");
            }
        });
       
    });

    $(document).on('click', '#step44_next', function () {
      	var posturl = '/customers/savephoto';
       	var getData = new FormData($("#myformprofile")[0]);
      	getData.append('_token', '{{csrf_token()}}')       
      	getData.append('cust_id', $('#cust_id').val())       
      	$.ajax({
            url: posturl,
            type: 'POST',
            dataType: 'json',
            data: getData,
            cache: true,
            processData: false,
            contentType: false,
           
            success: function (response) {
                $("#divstep5").css("display","none");
                $("#divstep6").css("display","block");
            }
        });
  	});

  	$(document).on('click', '#step5_next', function () {
      
        var fname = $('#fname').val();
        var lname = $('#lname').val();
        var birthday_date = $('#birthday_date').val();
        var relationship = $('#relationship').val();
        var mphone = $('#mphone').val();
        var gender = $('#gender').val();
        var emailid = $('#emailid').val();
        
        $('#err_fname').html('');
        $('#err_lname').html('');
        $('#err_birthday_date').html('');
        $('#err_relationship').html('');
        $('#err_mphone').html('');
        $('#err_gender').html('');
        $('#err_emailid').html('');
        
        if(fname == ''){
            $('#err_fname').html('Please enter first name');
            $('#fname').focus();
            return false;
        }
        if(lname == ''){
            $('#err_lname').html('Please enter last name');
            $('#lname').focus();
            return false;
        }
        if(birthday_date == ''){
            $('#err_birthday_date').html('Please enter birth date');
            $('#birthday_date').focus();
            return false;
        }
        if(relationship == ''){
            $('#err_relationship').html('Please select relationship');
            $('#relationship').focus();
            return false;
        }
        if(mphone == ''){
            $('#err_mphone').html('Please enter mobile number');
            $('#mphone').focus();
            return false;
        }
        if(gender == ''){
            $('#err_gender').html('Please select gender');
            $('#gender').focus();
            return false;
        }
        if(emailid == ''){
            $('#err_emailid').html('Please enter emailid');
            $('#emailid').focus();
            return false;
        }
        
        var posturl = '/submitfamilyCustomer';
        var formdata = new FormData();
        formdata.append('_token', '{{csrf_token()}}')
        formdata.append('business_id', '{{$companyId}}')
        formdata.append('first_name', $('.first_name').val())
        formdata.append('last_name', $('.last_name').val())
        formdata.append('email', $('.email').val())
        formdata.append('relationship', $('.relationship').val())
        formdata.append('mobile_number', $('.mobile_number').val())
        formdata.append('emergency_phone', $('.emergency_phone').val())
        formdata.append('birthday', $('#birthday_date').val())
        formdata.append('gender', $('.gender').val())
        formdata.append('cust_id', $('#cust_id').val())

        setTimeout(function () {
            $.ajax({
                url: posturl,
                type: 'POST',
                dataType: 'json',
                data: formdata,
                processData: false,
                contentType: false,
                headers: {
                    'X-CSRF-TOKEN': $("#_token").val()
                },
                beforeSend: function () {
                    $('#step5_next').prop('disabled', true).css('background','#999999');
                  
                    $("#systemMessage").html('Please wait while we submitting the data.')
                },
                complete: function () {
                    $('#step5_next').prop('disabled', true).css('background','#999999');
                },
                success: function (response) {
                    $("#systemMessage").html(response.msg);
                    if (response.type === 'success') {
                        window.location.href = response.redirecturl;
                    } else {
                        $('#step5_next').prop('disabled', false).css('background','#ed1b24');
                    }
                }
            });
        }, 1000)
    });

    $(document).on('click', '#skip5_next', function () {
    	window.location.href = '/viewcustomer/'+$('#cust_id').val();
    });

    function getAge() {
        var dateString = document.getElementById("dob").value;
        var today = new Date();
        var birthDate = new Date(dateString);
        var age = today.getFullYear() - birthDate.getFullYear();
        if(age < 13)
        {
            var agechk = '0';
        } else {
           var agechk = '1';
        }
        return agechk;
    }
</script>

<script type="text/javascript">
    function initMap() {
        var map = new google.maps.Map(document.getElementById('map'), {
            center: {lat: -33.8688, lng: 151.2195},
            zoom: 13
        });

        var input = document.getElementById('b_address');
        map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);
        var autocomplete = new google.maps.places.Autocomplete(input);
        autocomplete.bindTo('bounds', map);
        var infowindow = new google.maps.InfoWindow();
        var marker = new google.maps.Marker({
            map: map,
            anchorPoint: new google.maps.Point(0, -29)
        });

        autocomplete.addListener('place_changed', function() {
            infowindow.close();
            marker.setVisible(false);
            var place = autocomplete.getPlace();
            if (!place.geometry) {
                window.alert("Autocomplete's returned place contains no geometry");
                return;
            }

            // If the place has a geometry, then present it on a map.
            if (place.geometry.viewport) {
                map.fitBounds(place.geometry.viewport);
            } else {
                map.setCenter(place.geometry.location);
                map.setZoom(17);
            }

            marker.setIcon(({
                url: place.icon,
                size: new google.maps.Size(71, 71),
                origin: new google.maps.Point(0, 0),
                anchor: new google.maps.Point(17, 34),
                scaledSize: new google.maps.Size(35, 35)
            }));

            marker.setPosition(place.geometry.location);
            marker.setVisible(true);
            var address = '';
            var badd = '';
            var sublocality_level_1 = '';
            if (place.address_components) {
                address = [
                  (place.address_components[0] && place.address_components[0].short_name || ''),
                  (place.address_components[1] && place.address_components[1].short_name || ''),
                  (place.address_components[2] && place.address_components[2].short_name || '')
                ].join(' ');
            }

            infowindow.setContent('<div><strong>' + place.name + '</strong><br>' + address);
            infowindow.open(map, marker);
            // Location details
            for (var i = 0; i < place.address_components.length; i++) {
                if(place.address_components[i].types[0] == 'postal_code'){
                  $('#b_zipcode').val(place.address_components[i].long_name);
                }
                if(place.address_components[i].types[0] == 'country'){
                  $('#b_country').val(place.address_components[i].long_name);
                }

                if(place.address_components[i].types[0] == 'locality'){
                    $('#b_city').val(place.address_components[i].long_name);
                }

                if(place.address_components[i].types[0] == 'sublocality_level_1'){
                    sublocality_level_1 = place.address_components[i].long_name;
                }

                if(place.address_components[i].types[0] == 'street_number'){
                   badd = place.address_components[i].long_name ;
                }

                if(place.address_components[i].types[0] == 'route'){
                   badd += ' '+place.address_components[i].long_name ;
                } 

                if(place.address_components[i].types[0] == 'administrative_area_level_1'){
                  $('#b_state').val(place.address_components[i].long_name);
                }
            }

            if(badd == ''){
              $('#b_address').val(sublocality_level_1);
            }else{
              $('#b_address').val(badd);
            }
            
        
           /* $('#lat').val(place.geometry.location.lat());
            $('#lon').val(place.geometry.location.lng());*/
        });
    }
</script>
<script>
    $( function() {
        $( "#managecalendarservice" ).datepicker( { 
        	autoclose: true,
            minDate: 0,
            changeMonth: true,
            changeYear: true   
        } );
    } );
</script>

<script src="https://maps.googleapis.com/maps/api/js?libraries=places&key=AIzaSyCr7-ilmvSu8SzRjUfKJVbvaQZYiuntduw&callback=initMap" async defer></script>

<script type="text/javascript">
	$(document).mouseup(function (e) {
        if ($(e.target).closest("#option-box1").length === 0) {
            $("#option-box1").hide();
        } 
        if ($(e.target).closest("#option-box").length === 0) {
            $("#option-box").hide();
        }
    });
</script>

<script>
 $('.activity-scheduler-date').datepicker({
        dateFormat: "mm/dd/yy"
    })
</script>


@include('layouts.footer')

@endsection