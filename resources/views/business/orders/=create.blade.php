@extends('layouts.header')
@section('content')
@include('layouts.userHeader')
<style type="text/css">

	/*Prevent text selection*/
	span{
	    -webkit-user-select: none;
	    -moz-user-select: none;
	    -ms-user-select: none;
	}

	input::-webkit-outer-spin-button,
	input::-webkit-inner-spin-button {
	    -webkit-appearance: none;
	    margin: 0;
	}
	input:disabled{
	    background-color:white;
	}
   
</style>

@php 
	use Carbon\Carbon;
	use App\{BusinessPriceDetailsAges,BusinessServices,BusinessService,BusinessPriceDetails};
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
									<a href="#" class="btn-nxt manage-cus-btn search-add-client text-center search-checkout" data-toggle="modal" data-target="#newclient">Add New Client</a>
									<!-- <button type="button" class="btn-nxt manage-search search-add-client" id="">Add New Client </button> -->
								</div>
								<div class="col-md-5 col-sm-12 col-xs-12 nopadding">
									<div class="manage-search serchcustomer">
										<div class="sub">
											<input type="text" id="serchclient" name="fname" placeholder="Search for client who is making a purchase?" autocomplete="off" value="{{$username}}" data-id="{{$pageid}}">
											<!-- <div id="option-box1" style="display:none;">
						                        <ul class="customer-list">
						                        </ul>
						                    </div> -->
											<button ><i class="fa fa-search"></i></button>
										</div>
									</div>
								</div>
								<div class="col-md-3 col-sm-12 col-xs-12">
									<button type="button" class="btn-bck manage-search search-add-client quick-none"> Quick Sale </button>
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
												<label>Visits: </label><span>  {{$visits}}</span>
											</div>
											<div class="col-md-6 col-sm-12 col-xs-12 nopadding">
												<label>Activities Bookings: </label><span>  {{$book_cnt}}</span>
											</div>
											<div class="col-md-6 col-sm-12 col-xs-12 nopadding">
												<label>Last Membership: </label><span> {{ $last_membership}}</span>
											</div>
											<div class="col-md-6 col-sm-12 col-xs-12 nopadding">
												<label>Status: </label><span> {{$status}} </span>
											</div>
											<div class="col-md-6 col-sm-12 col-xs-12 nopadding">
												<label>Current Membership: </label><span>{{$current_membership}}</span>
											</div>
											<div class="col-md-6 col-sm-12 col-xs-12 nopadding">
												<label>Last Purchase: </label><span> {{ $purchasefor}}</span>
											</div>
										</div>
									</div>
								</div>
								
								<div class="col-md-12 col-sm-12 col-xs-12">
									<div class="check-out-steps"><label><h2 class="color-red">Step 1: </h2> Select Service</label></div>
									<div class="check-client-info-box">
										<div class="row">
											<div class="col-md-4 col-sm-4 col-xs-12">
												<div class="select0service">
													<label>Who's Participating </label>
													<select name="participate_list" id="participate_list" class="form-control" onchange="loaddropdown('participat',this,this.value);">
														@php  
															if(request()->participate_id != ''){
																$pc_regi_id = request()->participate_id;
																$pc_value = $participateName;
															}else{
																$pc_regi_id = @$user_data->id;
																$pc_value = $username.'(me)';
															}

															$pc_user_tp = $user_type;
														@endphp
														<option value="{{@$user_data->id}}~~{{$pc_user_tp}}">{{$username}}(me)</option>
														@if(!empty($userfamily))
														@foreach($userfamily as $ufd)
															<option value="{{$ufd->id}}~~family^^{{$username}}"
																@if($ufd->id == request()->participate_id)
																	selected
																@endif
																>@if($pc_user_tp == 'customer'){{$ufd->fname}} {{$ufd->lname}} @else {{$ufd->first_name}} {{$ufd->last_name}} @endif</option>
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
											<div class="col-md-4 col-sm-4 col-xs-12">
												<label>Select Catagory </label>
												<select name="category_list" id="category_list" class="form-control" onchange="loaddropdown('category',this,this.value);">
													<option value="">Select</option>
												</select>
											</div>
										</div>
										<div class="row">
											<div class="col-md-4 col-sm-4 col-xs-12">
												<label>Select Price Option  </label>
												<select name="priceopt_list" id="priceopt_list" class="form-control" onchange="loaddropdown('priceopt',this,this.value);">
													<option value="">Select</option>
												</select>
											</div>
											<div class="col-md-4 col-sm-4 col-xs-12">
												<div class="select0service">
													<label>Participant Quantity </label>
													<button type="button" data-toggle="modal" data-target="#addpartcipate" class="btn-nxt search-add-client"> Select </button>
												</div>
											</div>
											<!-- <div class="col-md-4 col-sm-4 col-xs-12">
												<label> Membership Option</label>
												<select name="membership_opt_list" id="membership_opt_list" class="form-control" onchange="loaddropdown('mpopt',this,this.value);">
													<option value="">Select</option>
												</select>
											</div> -->
										</div>
									</div>
								</div>
								
								<div class="col-md-12 col-xs-12">
									<div class="check-out-steps"><label><h2 class="color-red">Step 2: </h2> Check Details </label></div>
									<div class="check-client-info-box">
										<div class="row">
											<div class="col-md-2 col-sm-4 col-xs-12">
												<div class="select0service pricedollar">
													<label>Price </label>
													<div class="set-price">
														<i class="fas fa-dollar-sign"></i>
													</div>
													<input type="text" class="form-control valid" id="price" placeholder="$0.00" class="manualprice" onkeypress="return ( event.charCode == 46 || (event.charCode >= 48 && event.charCode <= 57 ))">
												</div>
											</div>
											<div class="col-md-2 col-sm-4 col-xs-12">
												<div class="select0service pricedollar">
													<label>Session</label>
													<input type="text" class="form-control valid" id="p_session" name="p_session" placeholder="1" onkeypress="return event.charCode >= 48 && event.charCode <= 57">
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
																<input type="text" class="form-control valid" id="dis_amt" name="dis_amt" placeholder="Enter Amount" onkeyup="gettotal('','');" onkeypress="return ( event.charCode == 46 || (event.charCode >= 48 && event.charCode <= 57 ))">
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
																<input type="text" class="form-control valid" id="tip_amt" name="tip_amt" placeholder="Enter Amount" onkeyup="gettotal('','');" onkeypress="return ( event.charCode == 46 || (event.charCode >= 48 && event.charCode <= 57 ))">
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
															<input type="text" class="form-control valid" id="duration_int" name=duration_int placeholder="12" value="1" onkeyup="changevalue();" onkeypress="return ( event.charCode == 46 || (event.charCode >= 48 && event.charCode <= 57 ))">
														</div>
														<div class="col-md-6 col-sm-6 col-xs-6 nopadding">
															<div class="choose-tip">
																<select name="duration_dropdown" id="duration_dropdown" class="form-control" onchange="loaddropdown('duration',this,this.value);">
																	<option value="Days">Day(s) </option>
																	<option value="Weeks">Week(s)</option>
																	<option value="Months">Month(s) </option>
																	<option value="Years">Year(s) </option>
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
														<input type="text"  id="managecalendarservice" placeholder="Search By Date" class="form-control activity-scheduler-date w-80" autocomplete="off" value="{{date('m/d/Y')}}" onchange="changedate('simple');">
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
										<input type="hidden" name="pageid" value="{{$pageid}}">
										<input type="hidden" name="pid" id="pid" value="">
										<input type="hidden" name="categoryid" id="categoryid" value="">
										<input type="hidden" name="checkount_qty" id="checkount_qty" value="">
										<input type="hidden" name="pay_session" id="pay_session" value="">
										<input type="hidden" name="aduquantity" id="adupricequantity" value="" class="product-quantity"/>
										<input type="hidden" name="childquantity" id="childpricequantity" value="" class="product-quantity"/>
										<input type="hidden" name="infantquantity" id="infantpricequantity" value="" class="product-quantity"/>

										<input type="hidden" name="cartaduprice" id="cartaduprice" value="" class="product-quantity"/>
										<input type="hidden" name="cartchildprice" id="cartchildprice" value="" class="product-quantity"/>
										<input type="hidden" name="cartinfantprice" id="cartinfantprice" value="" class="product-quantity"/>

										<input type="hidden" name="priceid" value="" id="priceid">
										<input type="hidden" name="actscheduleid" value="1 Day(s)" id="actscheduleid">
										<input type="hidden" name="sesdate" value="{{date('Y-m-d')}}" id="sesdate">
										<input type="hidden" name="pricetotal" id="pricetotal" value="" class="product-price">
										<input type="hidden" name="tip_amt_val" id="tip_amt_val" value="0" class="product-price">
										<input type="hidden" name="dis_amt_val" id="dis_amt_val" value="0" class="product-price">
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
													<label>Number Of Session</label>
												</div>
												<div class="col-md-6 col-sm-6 col-xs-6"> 
													<span id="session_span"></span>
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
													<span id="participate">@if($participateName != '') {{$participateName}} @else {{$username}} @endif</span>
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
												<input type="hidden" name="duestax" id="duestax" value="">
                     							<input type="hidden" name="salestax" id="salestax" value="">
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
							<form action="{{route('business.orders.store')}}" method="POST" class="validation" data-cc-on-file="false"  data-stripe-publishable-key="{{ env('STRIPE_PKEY') }}" id="payment-form">
								<div class="row">
									<div class="col-md-12 col-xs-12">
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

												$subtotal += $item['totalprice'] ;
												$tip += $item['tip'];
												$discount += $item['discount'];
												$taxval = $item["tax"];
												$participate = @$item["participate_from_checkout_regi"]['pc_name'];
												$taxes += $taxval;
												$act = BusinessServices::where('id', $item["code"])->first();
												$serprice =$act->price_details->find($item['priceid']);
												$serpricecate =$act->businessPriceDetailsAges->find(@$serprice->category_id);

												$total =($item['totalprice'] + $item['tip']  - $item['discount'] ) + $taxval;
												$iprice = number_format($total,0, '.', '');
												
											@endphp
												<input type="hidden" name="itemid[]" value="<?= $item["code"]; ?>" />
							                    <input type="hidden" name="itemimage[]" value="<?= $profilePic ?>" />
							                    <input type="hidden" name="itemname[]" value="<?= $item["name"]; ?>" />
							                    <input type="hidden" name="itemqty[]" value="1" />
							                    <input type="hidden" name="itemprice[]" value="<?= $iprice * 100; ?>" />
							                   
							                    <input type="hidden" name="itemparticipate[]" id="itemparticipate" value="" />
												<div class="close-cross-icon"> 
													<a class="p-red-color editcartitemaks" data-toggle="modal" data-priceid="{{$item['priceid']}}" data-pageid="{{$pageid}}"> 
													<i class="fas fa-pencil-alt"></i></a>
												</div>
												<div class="close-cross-icon-trash">
													<a href="{{route('removetocart',['priceid'=>$item['priceid'],'pageid'=>$pageid,'chk'=>'purchase','user_type'=>$user_type])}}" class="p-red-color">
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
															<span>{{@$serpricecate->category_title}}</span>
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
															<label>Number Of Seesion:</label>
														</div>
														<div class="col-md-6 col-sm-6 col-xs-6">
															<span>{{@$item['p_session']}}</span>
														</div>

														<div class="col-md-6 col-sm-6 col-xs-6">
															<label>Participant Quantity:</label>
														</div>
														<div class="col-md-6 col-sm-6 col-xs-6">
															<span>@if(!empty($item['adult'])) @if($item['adult']['quantity']  != 0) Adult : {{$item['adult']['quantity']}} @endif @endif</span> 
				                                            <span>@if(!empty($item['child']))  @if($item['child']['quantity']  != 0) Children : {{$item['child']['quantity']}} @endif @endif</span>
				                                            <span>@if(!empty($item['infant'])) @if($item['infant']['quantity'] != 0) Infant : {{$item['infant']['quantity'] }} @endif @endif</span>
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
														@php  $expired_at = '';
														 	$explodetime = explode(' ',$item['actscheduleid']);
														 	if(!empty($explodetime) && array_key_exists(1, $explodetime)){
									                            $daynum = '+'.$explodetime[0].' '.strtolower($explodetime[1]);
									                            $expired_at  = date('m/d/Y', strtotime($item['sesdate']. $daynum ));
									                    	} 
														@endphp
														<div class="col-md-6 col-sm-6 col-xs-6">
															<label>Expires On:</label>
														</div>
														<div class="col-md-6 col-sm-6 col-xs-6">
															<span>{{$expired_at}}</span>
														</div>
														
														<div class="col-md-12 col-sm-12 col-xs-12">
															<div class="black-sparetor"></div>
														</div>
														
														<div class="col-md-6 col-sm-6 col-xs-6">
															<label class="total0spretor">Tip Amount </label>
														</div>
														<div class="col-md-6 col-sm-6 col-xs-6">
															<span class="total0spretor">${{$item['tip'] }}</span>
														</div>
														
														<div class="col-md-6 col-sm-6 col-xs-6">
															<label>Discount </label>
														</div>
														<div class="col-md-6 col-sm-6 col-xs-6">
															<span>${{$item['discount'] }}</span>
														</div>
														
														<div class="col-md-6 col-sm-6 col-xs-6">
															<label>Taxes (NYC) </label>
														</div>
														<div class="col-md-6 col-sm-6 col-xs-6">
															<span>${{$taxval}}</span>
														</div>
														
														<div class="col-md-12 col-sm-12 col-xs-12">
															<div class="black-sparetor"></div>
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

									if($subtotal != $discount){
										$service_fee = (($subtotal + $tip - $discount) * Auth::User()->recurring_fee) / 100;

								 		$grand_total = ($subtotal + $tip + $taxes) - $discount;
								 		$grand_total = number_format($grand_total, 2, '.', '');
								 	}else{
								 		$grand_total = $subtotal  = $tax_ser_fees = 0 ;
								 	}
							 		//echo $tax_ser_fees;
								@endphp
								<div class="row">
									<div class="col-md-12 col-xs-12">
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
													<label>Taxes </label>
												</div>
												<div class="col-md-6 col-sm-6 col-xs-6">
													<span>${{$taxes}}</span>
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
								@if($user_data)
									<input type="hidden" name="user_id" value="{{@$user_data->id}}">
									<input type="hidden" name="user_type" value="{{@$user_type}}">
									<div class="row">
										<div class="col-md-12 col-sm-12 col-xs-12">
											<div class="payment-method">
												<label>Select Payment Method</label>
											</div>
										</div>
										<div class="col-md-4 col-sm-4 col-xs-6">
											<label class="pay-card" style="color:#000; background: #e9e9e9; margin-bottom: 15px;">
											<input name="cardinfo" class="payment-radio" type="radio" value="cash" >
												<span class="plan-details checkout-card">
		                                            <div class="row">
		                                               <div class="col-md-12 col-xs-12">
		                                                  <div class="payment-method-img">
		                                                      <img src="{{asset('/public/images/cash-icon.png')}}" alt="img" class="w-100" width="100">
		                                                  </div>
		                                               </div>
		                                               <div class="col-md-12 col-xs-12">
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
										@if($customer)
										 	@foreach($customer->stripePaymentMethods()->get() as $card) 
		                                    	@php $brandname = ucfirst($card['brand']); @endphp
												<div class="col-md-4 col-sm-4 col-xs-6">
													<label class="pay-card" style="color:#000; background: #e9e9e9; margin-bottom: 15px;">
			                                        <input name="cardinfo" class="payment-radio" type="radio" value="cardonfile" data-card-last4="{{$card->last4}}" data-card-id="{{$card->payment_id}}">
			                                            <span class="plan-details checkout-card">
			                                                <div class="row">
			                                                    <div class="col-md-12 col-xs-12">
			                                                        <div class="payment-method-img">
			                                                            <img src="{{asset('/public/images/cc-on-file.png')}}" alt="img" class="w-100" width="100">
			                                                        </div>
			                                                    </div>
			                                                    <div class="col-md-12 col-xs-12">
																	<div class="cart-name checkout-cart">
			                                                           <span>CC (On File)</span>
			                                                         </div>
			                                                         <div class="cart-num checkout-cart">
			                                                            <span>{{$card->brand}} XXXX {{$card->last4}}</span>
			                                                         </div>
			                                                    </div>
			                                                </div>
			                                           </span>
			                                       </label>
												</div>
											@endforeach
										@endif

										
										<div class="col-md-4 col-sm-4 col-xs-6">
											<label class="pay-card" style="color:#000; background: #e9e9e9; margin-bottom: 15px;">
		                                    <input name="cardinfo" class="payment-radio" type="radio" value="newcard">
		                                        <span class="plan-details checkout-card">
		                                            <div class="row">
		                                                <div class="col-md-12 col-xs-12">
		                                                    <div class="payment-method-img">
		                                                        <img src="{{asset('/public/images/input-cc.png')}}" alt="img" class="w-100" width="100">
		                                                    </div>
		                                                </div>
		                                                <div class="col-md-12 col-xs-12">
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

										<div class="col-md-4 col-sm-4 col-xs-6">
											<label class="pay-card" style="color:#000; background: #e9e9e9; margin-bottom: 15px;">
	                                        <input name="cardinfo" class="payment-radio" type="radio" value="check">
	                                            <span class="plan-details checkout-card">
	                                                <div class="row">
	                                                    <div class="col-md-12 col-xs-12">
	                                                        <div class="payment-method-img">
	                                                            <img src="{{asset('/public/images/check.png')}}" alt="img" class="w-100" width="100">
	                                                        </div>
	                                                    </div>
	                                                    <div class="col-md-12 col-xs-12">
															<div class="cart-name checkout-cart">
	                                                           <span>Check</span>
	                                                         </div>
	                                                    </div>
	                                                </div>
	                                           </span>
	                                       </label>
										</div>
										
										<div class="col-md-4 col-sm-4 col-xs-6">
											<label class="pay-card" style="color:#000; background: #e9e9e9; margin-bottom: 15px;">
	                                        <input name="cardinfo" class="payment-radio" type="radio"  value="comp">
	                                            <span class="plan-details checkout-card">
	                                                <div class="row">
	                                                    <div class="col-md-12 col-xs-12">
	                                                        <div class="payment-method-img">
	                                                            <img src="{{asset('/public/images/comp.png')}}" alt="img" class="w-100" width="100">
	                                                        </div>
	                                                    </div>
	                                                    <div class="col-md-12 col-xs-12">
															<div class="cart-name checkout-cart">
	                                                           <span>Comp</span>
	                                                         </div>
	                                                    </div>
	                                                </div>
	                                           </span>
	                                       </label>
										</div>

										<div class="col-md-12 col-xs-12">
											<div class="check-client-info mathod-display">
												<div class="payment-selection">
													<h3>Payment Method Selected</h3>
												</div>
												<div id="addpmtmethods">
													<div class="row" id="cashdiv" style="display: none;">
														<div class="col-md-1 col-xs-1 col-sm-1">
															<div class="close-div">
																<div class="close-cross"> 
																	<i class="fas fa-times"></i>
																</div>
															</div>
														</div>
														<div class="col-md-3 col-xs-6 col-sm-3">
															<input type="text" class="form-control valid" id="cash_amt" name="cash_amt" placeholder="0.00"  value="0" data-behavior="calculateRemaining" onkeypress="return ( event.charCode == 46 || (event.charCode >= 48 && event.charCode <= 57 ))">
														</div>
														<div class="col-md-8 col-xs-4 col-sm-3">
															<label>Cash</label>
														</div>
														
														<div class="col-md-12 col-xs-12">
															<div class="changecalce">
																<label>Change Calculator</label>
															</div>
														</div>
														<div class="col-md-5 col-sm-4 col-xs-12">
															<div class="cash-tend">
																<span>Cash tendered</span>
															</div>
														</div>
														<div class="col-md-3 col-sm-4 col-xs-6 nopadding">
															<input type="text" class="form-control valid" id="cash_amt_tender" name="cash_amt_tender" placeholder="0.00"  value="0" data-behavior="calculateChange" onkeypress="return ( event.charCode == 46 || (event.charCode >= 48 && event.charCode <= 57 ))">
														</div>
														<div class="col-md-2 col-sm-4 col-xs-6 nopadding">
															<div class="cash-tend-option">
																<span>(Optional)</span>
															</div>
														</div>
														<div class="col-md-5 col-sm-5 col-xs-12">
															<div class="cash-tend">
																<span>Cash Change:</span>
															</div>
														</div>

														<div class="col-md-2 col-sm-4 nopadding">
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
															<input type="text" class="form-control valid" id="cc_amt" name="cc_amt" placeholder="0.00" value="0" data-behavior="calculateRemaining" onkeypress="return ( event.charCode == 46 || (event.charCode >= 48 && event.charCode <= 57 ))">
														</div>
														<div class="col-md-8">
															<label>CC(Key/Stored)</label>
														</div>
														
														<div class="col-md-12">
															<div class="options-payment">
																<input type="radio" id="html" name="fav_language" value="" checked>
																<span id="use_billing_info">Use billing information on file.</span><br>
																<span class="visa-info"></span><br>
															</div>
														</div>
														<div class="col-md-12 col-sm-12 col-xs-12">
															<div class="checkout-sapre-tor">
															</div>
														</div>
													</div>	

													<div id="ccnewdiv"  style="display: none;"> 
														<div class="col-md-1 col-sm-1 col-xs-2">
															<div class="close-div">
																<div class="close-cross"> 
																	<i class="fas fa-times"></i>
																</div>
															</div>
														</div>
														<div class="col-md-3 col-sm-4 col-xs-10">
															<input type="text" class="form-control valid" id="cc_new_card_amt" name="cc_new_card_amt" placeholder="0.00" value="0" data-behavior="calculateRemaining" onkeypress="return ( event.charCode == 46 || (event.charCode >= 48 && event.charCode <= 57 ))">
														</div>
														<div class="col-md-8 col-sm-4 col-xs-12">
															<label>CC(Input Card)</label>
														</div>
														<div class="col-md-12 col-xs-12">
															<div class="row" >
																<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
																	<div id="payment-element" style="margin-top: 8px;">
							                                    		
							                                    	</div>
																</div>
															</div>
							        						<div class="row">
							                                    <div class="col-md-12 col-xs-12">
							                                    	
							                                        <div class="save-pmt-checkbox">
							                                            <input type="checkbox" id="save_card" name="save_card" value="1" checked>
							                                            <input type="hidden" id="new_card_payment_method_id" name="new_card_payment_method_id" value="">
							                                            
							                                            <label>Save for future payments</label>
							                                        </div>
							                                    </div>
							                                    
							        						</div> 
							        						
							        					</div>
						                            </div>

						                            <div class="row" id="checkdiv"  style="display: none;">
														<div class="col-md-1 col-sm-1 col-xs-2">
															<div class="close-div">
																<div class="close-cross"> 
																	<i class="fas fa-times"></i>
																</div>
															</div>
														</div>
														<div class="col-md-3 col-sm-4 col-xs-6">
															<input type="text" class="form-control valid" id="check_amt" name="check_amt" placeholder="0.00" value="0" data-behavior="calculateRemaining" onkeypress="return ( event.charCode == 46 || (event.charCode >= 48 && event.charCode <= 57 ))">
														</div>
														<div class="col-md-8 col-sm-4 col-xs-2">
															<label>Check</label>
														</div>
														<div class="col-md-12 col-sm-12 col-xs-12">
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
													<div class='form-row row'>
													    <div class='col-md-12 hide error form-group'>
													        <div class='alert-danger alert'>Fix the errors before you begin.</div>
													    </div>
													</div>

												</div>
											</div>
										</div>

										@if (session('stripeErrorMsg'))
											<div class="col-md-12">
												<div class='form-row row'>
			                                        <div class='col-md-12  error form-group'>
													    <div class="alert-danger alert">
													        {{ session('stripeErrorMsg') }}
													    </div>
													</div>
												</div>
											</div>
										@endif
										<input type="hidden" name="grand_total" id="grand_total" value="{{$grand_total}}">
										<input type="hidden" name="cash_change" id="cash_change" value="">
										<input type="hidden" name="card_id" id="card_id" value="">
										<div class="col-md-6 col-sm-6 col-xs-12 ">
											<button type="button" class="btn-bck activity-purchase mb-00" id="total_remaing">Total Amount Remaining ${{$grand_total}}</button>
										</div>

										<div class="col-md-6 col-sm-6 col-xs-12 ">
											<div class="btn-ord-txt" style="float: right;">
					                            <button class="post-btn-red" type="submit" id="checkout-button" @if($checkout_btun_chk == 0) disabled  @endif style="margin-top: 0px;">Complete Payment</button>
					                        </div>
											<!-- <button type="submit" class="btn-nxt activity-purchase mb-00" @if($checkout_btun_chk == 0) disabled  @endif>Complete Payment</button> -->
										</div>
									@endif
								</div>
							</form>				
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>


	<div class="modal fade compare-model" role="dialog" id="editcartitempp" >
		<div class="modal-dialog manage-customer">
			<div class="modal-content">
            	<div class="modal-header" style="text-align: right;"> 
				  	<div class="closebtn">
						<button type="button" class="close close-btn-design manage-customer-close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">×</span>
						</button>
					</div>
				</div>
				<div class="modal-body body-tbm editcartdiv">
				</div>
            </div>
		</div>
    </div>

    <div class="modal fade" role="dialog" id="addpartcipateajax" tabindex="-1">
        <div class="modal-dialog counter-modal-size">
            <div class="modal-content">
               <div class="modal-header"> 
                        <div class="closebtn">
                             <button type="button" class="close close-btn-design participateclosebtnajax" data-dismiss="modal" aria-label="Close">
                                  <span aria-hidden="true">×</span>
                             </button>
                        </div>
                   </div>  
                <div class="modal-body conuter-body" id="Countermodalbodyajax">
               	</div>            
                <div class="modal-footer conuter-body">
                    <button type="button" onclick="saveparticipateajax();" class="btn btn-primary rev-submit-btn">Save</button>
                </div>
         </div>                                                                       
        </div>                                          
    </div>

    <div class="modal fade" role="dialog" id="addpartcipate" tabindex="-1">
	    <div class="modal-dialog counter-modal-size">
	        <div class="modal-content">
	           <div class="modal-header"> 
					<div class="closebtn">
						<button type="button" class="close close-btn-design participateclosebtn" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">×</span>
						</button>
					</div>
				</div>  
	            <div class="modal-body conuter-body" id="Countermodalbody">
	            	<div class="row">
	            		<div class="col-lg-12">
                        	<h4 class="modal-title partcipate-model">Select The Number of Participants</h4>
                    	</div>
                    	<div id="pricediv">
	                    </div>
	                </div>
	            </div>            
	            <div class="modal-footer conuter-body">
	                <button type="button" onclick="saveparticipate();" class="btn btn-primary rev-submit-btn">Save</button>
	            </div>
	    	</div>                                                                       
	    </div>                                          
	</div>
</div>

<div class="modal" id="bookingreceipt" role="dialog">
    <div class="modal-dialog modal-lg booking-receipt">
        <div class="modal-content">
            <div class="modal-header" style="text-align: right;"> 
                <div class="row">
                    <div class="col-md-12 text-center">
                       <label class="pay-confirm"> Booking & Payment Confirmed</label>
                    </div>
                    <div class="closebtn booking-pmt-close">
                        <button type="button" class="close close-btn-design booking-pmt-close-btn" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                </div>
            </div>

            <!-- Modal body -->
            <div class="modal-body" id="receiptbody">
				{!! $modeldata !!}
            </div>
        </div>
    </div>
</div> 


<script src="{{asset('/public/js/compare/jquery-1.9.1.min.js')}}"></script>

<script src="{{ url('public/js/jquery.payform.min.js') }}" charset="utf-8"></script>
 

<script src="{{ url('/public/js/front/jquery-ui.js') }}"></script>
<link href="{{ url('/public/css/frontend/jquery-ui.css') }}" rel="stylesheet" type="text/css" media="all"/>

<script>
	$(document).ready(function () {
		var business_id = '{{$companyId}}';
		var url = "{{ url('/business/business_id/customers') }}";
		url = url.replace('business_id', business_id);

    	$( "#serchclient" ).autocomplete({
      		source: url,
      		focus: function( event, ui ) {
      			 return false;
        	},
        	select: function( event, ui ) {
	            window.location.href = '/business/'+business_id+'/orders/create?cus_id='+ui.item.id;
	        }
    	}).data( "ui-autocomplete" )._renderItem = function( ul, item ) {
    		let profile_img = '<div class="collapse-img"><div class="company-list-text" style="height: 50px;width: 50px;"><p style="padding: 0;">A</p></div></div>';

          	if(item.profile_pic_url){
            	profile_img = '<img class="searchbox-img" src="' + (item.profile_pic_url ? item.profile_pic_url : '') + '" style="">';            
          	}

	        var inner_html = '<div class="row rowclass-controller"></div><div class="col-md-3 nopadding text-center">' + profile_img + '</div><div class="col-md-9 div-controller">' + 
		              '<p class="pstyle"><label class="liaddress">' + item.fname + ' ' +  item.lname  + (item.age ? ' (' + item.age+ '  Years Old)' : '') + '</label></p>' +
		              '<p class="pstyle liaddress">' + item.email +'</p>' + 
		              '<p class="pstyle liaddress">' + item.phone_number + '</p></div>';
	       
	        return $( "<li></li>" )
	                .data( "item.autocomplete", item )
	                .append(inner_html)
	                .appendTo( ul );
	    };
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
			$('#checkout-button').html('loading...').prop('disabled', true);
			let cash_amt = $('#cash_amt').val();
			let cc_amt = $('#cc_amt').val();
			let cc_new_card_amt = $('#cc_new_card_amt').val();
			let check_amt = $('#check_amt').val();

			var cardinfoRadio = $('input[name=cardinfo]:checked', '#payment-form').val();

			if(cash_amt <= 0 && cc_amt <=0 && cc_new_card_amt <=0 && check_amt <=0 && cardinfoRadio!= 'comp'){
				$('.error').removeClass('hide').find('.alert').text('Choose payment method first');
				$('#checkout-button').html('Complete Payment').prop('disabled', false);
				return false;
			}

	        if(cc_new_card_amt > 0) {
	            var $form  = $(".validation"),
	                inputVal = ['input[type=email]', 'input[type=password]',
	                                 'input[type=text]', 'input[type=file]',
	                                 'textarea'].join(', '),
	                $inputs       = $form.find('.required').find(inputVal),
	                $errorStatus = $form.find('div.error'),
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
        	    		$('#checkout-button').html('Complete Payment').prop('disabled', false);
        	    		return false;
        	    	}else{
        	    		$.ajax({
        	    			url: '{{route('business.customers.refresh_payment_methods', ['customer_id' => request()->cus_id])}}',
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
	});
</script>

<script>
	$(document).ready(function () {
		var modelchk = '{{$modelchk}}';
		if(modelchk == 1){	
 			$("#bookingreceipt").modal('show');
		}

	    $('#adultcnt').prop('readonly', true);
		$(document).on('click','.adultplus',function(){
			$('#adultcnt').val(parseInt($('#adultcnt').val()) + 1 );
		});
    	$(document).on('click','.adultminus',function(){
			$('#adultcnt').val(parseInt($('#adultcnt').val()) - 1 );
			if ($('#adultcnt').val() <= 0) {
				$('#adultcnt').val(0);
			}
	    });

	    $('#childcnt').prop('readonly', true);
		$(document).on('click','.childplus',function(){
			$('#childcnt').val(parseInt($('#childcnt').val()) + 1 );
		});
    	$(document).on('click','.childminus',function(){
			$('#childcnt').val(parseInt($('#childcnt').val()) - 1 );
			if ($('#childcnt').val() <= 0) {
				$('#childcnt').val(0);
			}
	    }); 

	    $('#infantcnt').prop('disabled', true);
		$(document).on('click','.infantplus',function(){
			$('#infantcnt').val(parseInt($('#infantcnt').val()) + 1 );
		});
    	$(document).on('click','.infantminus',function(){
			$('#infantcnt').val(parseInt($('#infantcnt').val()) - 1 );
			if ($('#infantcnt').val() <= 0) {
				$('#infantcnt').val(0);
			}
	    });
	});
</script>

<script>
	$(document).ready(function () {
	    $('#adultcntajax').prop('readonly', true);
		$(document).on('click','.adultplus',function(){
			$('#adultcntajax').val(parseInt($('#adultcntajax').val()) + 1 );
		});
    	$(document).on('click','.adultminus',function(){
			$('#adultcntajax').val(parseInt($('#adultcntajax').val()) - 1 );
			if ($('#adultcntajax').val() <= 0) {
				$('#adultcntajax').val(0);
			}
	    });

	    $('#childcntajax').prop('readonly', true);
		$(document).on('click','.childplus',function(){
			$('#childcntajax').val(parseInt($('#childcntajax').val()) + 1 );
		});
    	$(document).on('click','.childminus',function(){
			$('#childcntajax').val(parseInt($('#childcntajax').val()) - 1 );
			if ($('#childcntajax').val() <= 0) {
				$('#childcntajax').val(0);
			}
	    }); 

	    $('#infantcntajax').prop('disabled', true);
		$(document).on('click','.infantplus',function(){
			$('#infantcntajax').val(parseInt($('#infantcntajax').val()) + 1 );
		});
    	$(document).on('click','.infantminus',function(){
			$('#infantcntajax').val(parseInt($('#infantcntajax').val()) - 1 );
			if ($('#infantcntajax').val() <= 0) {
				$('#infantcntajax').val(0);
			}
	    });
	});
</script>

<script type="text/javascript">
	$(document).on('click', '.editcartitemaks', function () {
		var priceid = $(this).attr('data-priceid');
		var pageid = $(this).attr('data-pageid');
		$.ajax({
			url: '{{route("business.editcartmodel")}}',
			type: 'post',
			data:  {
				'priceid':priceid,
				'pageid':pageid,
				'companyId': '{{$companyId}}',
				_token: '{{csrf_token()}}', 
			},
			success:function(response){
				var data = response.split('~~');
				$('.editcartdiv').html(data[0]);
				$('#Countermodalbodyajax').html(data[1]);
				$('#editcartitempp').modal('show');
			}
		});

	});
</script>

<script type="text/javascript">

	function saveparticipate(){
		$('#qty').html('');
		var aducnt = $('#adultcnt').val();
		var chilcnt = $('#childcnt').val();
		var infcnt = $('#infantcnt').val();
		if(typeof(aducnt) == 'undefined'){
			aducnt = 0;
		}
		if(typeof(chilcnt) == 'undefined'){
			chilcnt = 0;
		}
		if(typeof(infcnt) == 'undefined'){
			infcnt = 0;
		}

		var adult = '';
		var child = '';
		var infant = '';

		var totalprice = 0;
		var totalpriceadult = 0;
		var totalpricechild = 0;
		var totalpriceinfant = 0; 
		var aduprice = $('#adultprice').val();
		var childprice = $('#childprice').val();
		var infantprice = $('#infantprice').val();
		var pay_session = $('#session_val').val();
	
		if(typeof(aduprice) != "undefined" && aduprice != null && aduprice != ''){
			totalpriceadult = parseInt(aducnt)*parseInt(aduprice);
			if(aducnt != 0){
				adult = '<span>Adults x '+aducnt+'</span><br>';
			}
			$('#adupricequantity').val(aducnt);
		}

		if(typeof(childprice) != "undefined" && childprice != null && childprice != ''){
			totalpricechild = parseInt(chilcnt)*parseInt(childprice);
			if(chilcnt != 0){
				child = '<span>Kids x  '+chilcnt+'</span><br>';
			}
			$('#childpricequantity').val(chilcnt);
		}
		if(typeof(infantprice) != "undefined" && infantprice != null && infantprice != ''){
			totalpriceinfant = parseInt(infcnt)*parseInt(infantprice);
			if(infcnt != 0){
				infant = '<span>Infants x  '+infcnt+'</span>';
			}
			$('#infantpricequantity').val(infcnt);
		}
	
		$('#cartaduprice').val(aduprice);
		$('#cartinfantprice').val(infantprice);
		$('#cartchildprice').val(childprice);

		totalprice = parseInt(totalpriceadult)+parseInt(totalpricechild)+parseInt(totalpriceinfant);
	
		$('#price').val(totalprice);
		$('#p_session').val(pay_session);
		$('#session_span').html(pay_session);
		$('#pay_session').val(pay_session);
		$('#qty').html(adult+' '+child+' '+infant);
		$('.participateclosebtn').click();
		gettotal('','')
		/*$("#addpartcipate").modal('hide');
		$("#addpartcipate").removeClass('show');*/
	}

	function saveparticipateajax (){
		var aducnt = $('#adultcntajax').val();
		var chilcnt = $('#childcntajax').val();
		var infcnt = $('#infantcntajax').val();
		if(typeof(aducnt) == 'undefined'){
			aducnt = 0;
		}
		if(typeof(chilcnt) == 'undefined'){
			chilcnt = 0;
		}
		if(typeof(infcnt) == 'undefined'){
			infcnt = 0;
		}

		var adult = '';
		var child = '';
		var infant = '';

		var adult = '';
		var child = '';
		var infant = '';

		var totalprice = 0;
		var totalpriceadult = 0;
		var totalpricechild = 0;
		var totalpriceinfant = 0; 
		var aduprice = $('#adultpriceajax').val();
		var childprice = $('#childpriceajax').val();
		var infantprice = $('#infantpriceajax').val();
	
		if(typeof(aduprice) != "undefined" && aduprice != null && aduprice != ''){
			totalpriceadult = parseInt(aducnt)*parseInt(aduprice);
		}

		if(typeof(childprice) != "undefined" && childprice != null && childprice != ''){
			totalpricechild = parseInt(chilcnt)*parseInt(childprice);
		}
		if(typeof(infantprice) != "undefined" && infantprice != null && infantprice != ''){
			totalpriceinfant = parseInt(infcnt)*parseInt(infantprice);
		}
		
		$('#adupricequantityajax').val(aducnt);
		$('#childpricequantityajax').val(chilcnt);
		$('#infantpricequantityajax').val(infcnt);
		$('#cartadupriceajax').val(aduprice);
		$('#cartinfantpriceajax').val(infantprice);
		$('#cartchildpriceajax').val(childprice);

		totalprice = parseInt(totalpriceadult)+parseInt(totalpricechild)+parseInt(totalpriceinfant);
	
		$('#priceajax').val(totalprice);
		$('#pricetotalajax').val(totalprice);
		$('.participateclosebtnajax').click();
		get_total_ajax();
	}

	function get_total_ajax() {
		tax =salestax= duestax= 0;
		salestax = $('#salestaxajax').val();
		duestax = $('#duestaxajax').val();
		if(salestax == ''){
			salestax = 0;
		}
		if(duestax == ''){
			duestax = 0;
		}
		var price = parseInt($('#priceajax').val());
		if($("#taxajax").is(":checked")){
 			tax = 0;
 			$('#value_taxajax').val(0);
 		}else{
 			if(duestax != 0){
	 			tax += (price*duestax)/100;
	 		}
	 		if(salestax != 0){
	 			tax += (price*salestax)/100;
	 		}
	 		$('#value_taxajax').val(tax);
 		}
	}

	function changevalue(){
		$('#duration').html($('#duration_int').val() +' '+ $('#duration_dropdown').val());
		$('#actscheduleid').html($('#duration_int').val() +' '+ $('#duration_dropdown').val());
	}

	function changedate(chk){
		if(chk == 'simple'){
			$('#date').html($('#managecalendarservice').val());
			$('#sesdate').val($('#managecalendarservice').val());
		}else{
			$('#sesdateajax').val($('#managecalendarserviceajax').val());
		}
	}

	function  changeduration() {
		$('#actscheduleidajax').val($('#duration_intajax').val() +' '+ $('#duration_dropdownajax').val());
	}

	function loaddropdownajax(chk,val,id){
		var selectedText = val.options[val.selectedIndex].innerHTML;
		if(chk == 'program'){
			$('#pidajax').val(id);
			$('#category_listajax').html('');
			$('#priceopt_listajax').html('');
			$('#membership_opt_listajax').html('');
		}
		if(chk == 'category'){
			$('#categoryidajax').val(id);
			$('#priceopt_listajax').html('');
			$('#membership_opt_listajax').html('');
		}
		if(chk == 'priceopt'){
			$('#priceidajax').val(id);
			$('#membership_opt_listajax').html('');
		}
		if(chk == 'duration'){
			$('#actscheduleidajax').val($('#duration_intajax').val() +' '+ id);
		}

		$.ajax({
			url: '{{route("getdropdowndata")}}',
			type: 'get',
			data:  {
				'sid':id,
				'chk':chk,
				'type':'ajax',
				'user_type':'{{$user_type}}',
			},
			success:function(data){
				if(chk == 'program'){
					$('#category_listajax').html(data);
				}
				if(chk == 'category'){
					var data1 = data.split('~~');
					$('#priceopt_listajax').html(data1[0]);

					var splittax =  data1[1].split('^^');
					$('#duestaxajax').val(splittax[0]);
					$('#salestaxajax').val(splittax[1]);
				}
				if(chk == 'priceopt'){
					$('#pricedivajax').html('');
					var data1 = data.split('~~');
					$('#membership_opt_listajax').html(data1[0]);
					var part = data1[1].split('^^');
					$('#pricedivajax').html(part[0]);
					var second = part[1].split('!!');
					$('#duration_intajax').val(second[0]);
					$('#duration_dropdownajax').val(second[1]);
					$('#actscheduleidajax').val(second[0]+ ' ' + second[1]);
				}
				
				/*if(chk != 'participat' && chk != 'mpopt'){
					$('#adultcnt').val(0);
					$('#childcnt').val(0);
					$('#infantcnt').val(0);
					$('#price').val(0);
				}*/
			}
		});

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
			$('#categoryid').val(id);
		}
		if(chk == 'priceopt'){
			$('#priceid').val(id);
			$('#pt_name').html(selectedText);
			$('#membership_opt_list').html('');
		}
		/*if(chk == 'mpopt'){
			$('#mp_name').html(selectedText);
		}*/

		if(chk == 'duration'){
			$('#duration').html($('#duration_int').val() +' '+ selectedText);
			$('#actscheduleid').val($('#duration_int').val() +' '+ id);
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
				'type':'simple',
				'user_type':'{{$user_type}}',
			},
			success:function(data){
				if(chk == 'program'){
					$('#category_list').html(data);
				}
				if(chk == 'category'){
					var data1 = data.split('~~');
					$('#priceopt_list').html(data1[0]);

					var splittax =  data1[1].split('^^');
					$('#duestax').val(splittax[0]);
					$('#salestax').val(splittax[1]);

				}
				if(chk == 'priceopt'){
					var data1 = data.split('~~');
					//$('#membership_opt_list').html(data1[0]);
					$('#mp_name').html(data1[0]);
					var part = data1[1].split('^^');
					$('#pricediv').html(part[0]);
					var second = part[1].split('!!');
					$('#duration_int').val(second[0]);
					$('#duration_dropdown').val(second[1]);
					$('#duration').html(second[0]+ ' ' +second[1]);
					$('#actscheduleid').val(second[0]+ ' ' +second[1]);
				}
				
				if(chk != 'participat' && chk != 'mpopt' && chk != 'duration'){
					$('#adultcnt').val(0);
					$('#childcnt').val(0);
					$('#infantcnt').val(0);
					$('#price').val(0);
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
		var sub_tot_dis = tax =salestax= duestax= 0;
		var price = parseInt($('#price').val());
		var dis = $('#dis_amt_drop').val();
	 	var tip = $('#tip_amt_drop').val();
	 	
	 	dis_val  = parseInt($('#dis_amt').val());
		tip_val =parseInt($('#tip_amt').val());
		salestax = $('#salestax').val();
		duestax = $('#duestax').val();
		if(salestax == ''){
			salestax = 0;
		}
		if(duestax == ''){
			duestax = 0;
		}
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
		 		$('#tip_amt_val').val(0);
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
	 			$('#dis_amt_val').val(0);
	 		}
	 	}
	 	

	 	if($('#price').val() != ''){
	 		if($("#tax").is(":checked")){
	 			tax = 0;
	 			$('#value_tax').val(0);
	 		}else{
	 			if(duestax != 0){
		 			tax += (price*duestax)/100;
		 		}
		 		if(salestax != 0){
		 			tax += (price*salestax)/100;
		 		}
		 		$('#value_tax').val(tax);
	 		}
	 		
	 		$('#taxvalspan').html('$'+tax);
	 		var tot = price + sub_tot_tip - sub_tot_dis;
	 		if(dropval !=''){
	 			tot = dropval * tot;
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

	function getdis(){
		var dis_val = 0;
		var tip_val = 0;
		var sub_tot = 0;
		var sub_tot_tip = 0;
		var sub_tot_dis = tax = 0;
		var price = parseInt($('#priceajax').val());
		var dis = $('#dis_amt_dropajax').val();
	 	var tip = $('#tip_amt_dropajax').val();
	 	
	 	dis_val  = parseInt($('#dis_amtajax').val());
		tip_val =parseInt($('#tip_amtajax').val());
		if(tip != undefined){
	 		if($('#tip_amtajax').val() != ''){
		 		if(tip == '' || tip == '%'){
		 			sub_tot_tip = (price * tip_val) /100;
		 		}else{
		 			sub_tot_tip = tip_val;
		 		}
		 		$('#tip_amt_valajax').val(sub_tot_tip);
		 	}else{
		 		$('#tip_amt_valajax').val('');
		 	}
	 	}

	 	if(dis != undefined){
	 		if($('#dis_amtajax').val() != ''){
	 			if(dis == '' || dis == '%'){
	 				sub_tot_dis = (price * dis_val) /100;
		 		}else{
		 			sub_tot_dis = dis_val;
		 		}
		 		$('#dis_amt_valajax').val(sub_tot_dis);
	 		}else{
	 			$('#dis_amt_valajax').val('');
	 		}
	 	}
	}

	document.getElementById("price").onkeyup = function() {
		var price = parseFloat($(this).val());
		var chkadu = chkchild = chkinfant = 0;
		var qty = uniqueprice = 0;
		if($('#adupricequantity').val() != '' && $('#adupricequantity').val() != 0 && $('#adultprice').val() != ''){
			qty += parseInt($('#adupricequantity').val());
			chkadu = 1;
		}if($('#childpricequantity').val() != '' && $('#childpricequantity').val() != 0 && $('#childprice').val() != ''){
			qty += parseInt($('#childpricequantity').val());
			chkchild = 1;
		}if($('#infantpricequantity').val() != '' && $('#infantpricequantity').val() != 0 && $('#infantprice').val() != ''){
			qty += parseInt($('#infantpricequantity').val());
			chkinfant = 1;
		}
		if(qty != 0 && price != 0 && price != 'undefined'){
			uniqueprice = parseFloat(price/parseFloat(qty));
		}

		if(chkadu == 1  && $('#adultprice').val() != ''){
			$('#cartaduprice').val(uniqueprice);
		}
		if(chkchild == 1 && $('#childprice').val() != ''){
			$('#cartchildprice').val(uniqueprice);
		}
		if(chkinfant == 1 && $('#infantprice').val() != ''){
			$('#cartinfantprice').val(uniqueprice);
		}
		gettotal('','');
	};

	$('.close-div').click(function() {
		var name = $(this).parent('div').parent('div').attr('id');
		$("#"+name).css('display','none');
		if(name == 'cashdiv'){
			$('#cash_amt_tender').val(0);
			$('#cash_amt').val(0);
			$('#cash_amt_change').html('$0.00');
		}else if(name == 'ccfilediv'){
			$('#cc_amt').val(0);
			$('#card_id').val('');
		}else if(name == 'ccnewdiv'){
			$('#cc_new_card_amt').val(0);
		}else if(name == 'checkdiv'){
			$('#check_amt').val(0);
		}
		
		calculateTotalRemaining();
	});
	
	$('input[type=radio][name=cardinfo]').change(function() {

	    if (this.value == 'cash') {
	    	if($('#check_amt').is(":hidden") && $('#ccfilediv').is(":hidden") && $('#ccnewdiv').is(":hidden")) {
	    		$('#cash_amt').val('{{$grand_total}}');
	    	}

	    	$('#cashdiv').show();
	    }else if(this.value == 'check'){
	    	if($('#cashdiv').is(":hidden") && $('#ccfilediv').is(":hidden") && $('#ccnewdiv').is(":hidden")) {
	    		$('#check_amt').val('{{$grand_total}}');
	    	}

	    	$('#checkdiv').show();
	    }else if(this.value == 'newcard'){
	    	if($('#cashdiv').is(":hidden") && $('#ccfilediv').is(":hidden") && $('#checkdiv').is(":hidden")) {
	    		$('#cc_new_card_amt').val('{{$grand_total}}');
	    	}
	    	
	    	$('#ccnewdiv').show();
	    }else if(this.value == 'cardonfile'){
	    	if($('#cashdiv').is(":hidden") && $('#ccnewdiv').is(":hidden") && $('#checkdiv').is(":hidden")) {
	    		$('#cc_amt').val('{{$grand_total}}');
	    	}


	    	$('#use_billing_info').html('Use xxxx xxxx xxxx' + $(this).data('card-last4') + ' on file.')
	    	$('#card_id').val($(this).data('card-id'))
	    	$('#ccfilediv').show();
	    }

	    if (this.value == 'comp') {
	    	$('#cash_amt').val(0);
	    	$('#check_amt').val(0);
	    	$('#cc_amt').val(0);
	    	$('#cc_new_card_amt').val(0);
	    	$('#cashdiv').hide();
	    	$('#checkdiv').hide();
	    	$('#ccfilediv').hide();
	    	$('#ccnewdiv').hide();
	    }
	    calculateTotalRemaining();
	});

	$(document).on("keyup", '[data-behavior=calculateRemaining]', calculateTotalRemaining)
	$(document).on("keyup", '[data-behavior=calculateChange]', function(e){
		let cash_amt = $('#cash_amt').val();
		let cash_amt_tender = $('#cash_amt_tender').val()
		$('#cash_change').val(parseFloat(cash_amt - cash_amt_tender).toFixed(2));
		$('#cash_amt_change').html(parseFloat(cash_amt - cash_amt_tender).toFixed(2));
		let total_remaing = 0;
		if(cash_amt_tender < cash_amt){
			total_remaing = Math.abs(parseFloat(cash_amt - cash_amt_tender).toFixed(2));
		}
		$('#total_remaing').html('Total Amount Remaining $' +  total_remaing);
	})
	// document.getElementById("cash_amt").onkeyup = function() {calculateTotalRemaining()};
	//document.getElementById("cc_new_card_amt").onkeyup = function() {calculateTotalRemaining()};
	//document.getElementById("check_amt").onkeyup = function() {calculateTotalRemaining()};

	// document.getElementById("cash_amt_tender").onkeyup = function() {calculateTotalRemaining()};

	function calculateTotalRemaining() {
		let total = $('#grand_total').val();

		let cash_amt = $('#cash_amt').val();
		let cc_amt = $('#cc_amt').val();
		let cc_new_card_amt = $('#cc_new_card_amt').val();
		let check_amt = $('#check_amt').val();
		$('#total_remaing').html('Total Amount Remaining $' + parseFloat(total - cash_amt - cc_amt - cc_new_card_amt - check_amt).toFixed(2));
		// var grand_total = '{{$grand_total}}';
		// var cash_amt_tender = parseFloat($('#cash_amt_tender').val());
		// var cash_amt = parseFloat($('#cash_amt').val());
		// var tot =0;
		// if($('#cash_amt_tender').val()!= ''  && $('#cash_amt').val()!= ''){
		// 	tot  = Math.abs(Number(cash_amt-cash_amt_tender));
		// 	if(cash_amt_tender < cash_amt){
		// 		tot_btn  = tot;
		// 		if($('#ccfilediv').is(':visible')){
		// 			$('#cc_amt').val(tot_btn);
		// 		}
		// 		if($('#ccnewdiv').is(':visible')){
		// 			$('#cc_new_card_amt').val(tot_btn);
		// 		}
		// 		if($('#checkdiv').is(':visible')){
		// 			$('#check_amt').val(tot_btn);
		// 		}
		// 		$('#cash_change').val('0');
		// 	}else{
		// 		tot_btn  = '0.00';
		// 		if($('#ccfilediv').is(':visible')){
		// 			$('#cc_amt').val(0);
		// 		}
		// 		if($('#ccnewdiv').is(':visible')){
		// 			$('#cc_new_card_amt').val(0);
		// 		}
		// 		if($('#checkdiv').is(':visible')){
		// 			$('#check_amt').val(0);
		// 		}
		// 		$('#cash_change').val(tot);
		// 	}

		// 	if($('#ccfilediv').is(':visible')){
		// 		var cash = cash_amt_tender + parseFloat($('#cc_amt').val());
		// 		if( cash === cash_amt){
		// 			$('#total_remaing').html('Total Amount Remaining $0.00');
		// 		}else{
		// 			$('#total_remaing').html('Total Amount Remaining $'+tot_btn);
		// 		}
		// 	}else if($('#ccnewdiv').is(':visible')){
		// 		var cash = cash_amt_tender + parseFloat($('#cc_new_card_amt').val());
		// 		if( cash === cash_amt){
		// 			$('#total_remaing').html('Total Amount Remaining $0.00');
		// 		}else{
		// 			$('#total_remaing').html('Total Amount Remaining $'+tot_btn);
		// 		}
		// 	}else if($('#checkdiv').is(':visible')){
		// 		var cash = cash_amt_tender + parseFloat($('#check_amt').val());
		// 		if( cash === cash_amt){
		// 			$('#total_remaing').html('Total Amount Remaining $0.00');
		// 		}else{
		// 			$('#total_remaing').html('Total Amount Remaining $'+tot_btn);
		// 		}
		// 	}else{
		// 		$('#total_remaing').html('Total Amount Remaining $'+tot_btn);
		// 	}
		// 	$('#cash_amt_change').html('$'+ tot);
		// }else{
		// 	if($('#ccfilediv').is(':visible')){
		// 		var cash = parseFloat($('#cc_amt').val());
		// 		if( cash === cash_amt){
		// 			$('#total_remaing').html('Total Amount Remaining $0.00');
		// 		}else{
		// 			$('#total_remaing').html('Total Amount Remaining $'+grand_total);
		// 		}
		// 	}else if($('#ccnewdiv').is(':visible')){
		// 		var cash = parseFloat($('#cc_new_card_amt').val());
		// 		if( cash === cash_amt){
		// 			$('#total_remaing').html('Total Amount Remaining $0.00');
		// 		}else{
		// 			$('#total_remaing').html('Total Amount Remaining $'+grand_total);
		// 		}
		// 	}else if($('#checkdiv').is(':visible')){
		// 		var cash = parseFloat($('#check_amt').val());
		// 		if( cash === cash_amt){
		// 			$('#total_remaing').html('Total Amount Remaining $0.00');
		// 		}else{
		// 			$('#total_remaing').html('Total Amount Remaining $'+grand_total);
		// 		}
		// 	}else{
		// 		$('#total_remaing').html('Total Amount Remaining $'+cash_amt);
		// 	}
		// }
	}

    $(document).on('keyup', '#p_session', function() {
    	$('#pay_session').val($(this).val());
    	$('#session_span').html($(this).val());
    });

	$("#tax").click(function () {
        gettotal('','');
    });

    function searchclick(cid){
    	//var url = '{{env("APP_URL")}}';
    	var url = "{{route('business.orders.create',['cus_id' => 'cid' ])}}";
    	url = url.replace('cid', cid);
    	// var url = url+'/activity_purchase/0/'+cid;
	 	window.location.href = url;
	}
</script>

<script type="text/javascript">
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

    function sendemail(){
        $('.reviewerro').html('');
        var email = $('#email').val();
        var orderdetalidary = $('#orderdetalidary').val();
        var booking_id = $('#booking_id').val();
        if(email == ''){
            $('.reviewerro').css('display','block');
            $('.reviewerro').html('Please Add Email Address..');
        }else if(!valid(email)){
            $('.reviewerro').css('display','block');
            $('.reviewerro').html('Please Enter Valid Email Address..');
        }else{
            $('.btn-modal-booking').attr('disabled',true);
            $('.reviewerro').css('display','block');
            $('.reviewerro').html('Sending...');
            $.ajax({
                url: "{{route('sendreceiptfromcheckout')}}",
                xhrFields: {
                    withCredentials: true
                },
                type: 'get',
                data:{
                    orderdetalidary:orderdetalidary,
                    email:email,
                    booking_id:booking_id,
                },
                success: function (response) {
                    $('.reviewerro').html('');
                    $('.reviewerro').css('display','block');
                    $('.reviewerro').html('Email Successfully Sent..');
                }
            });
        }
    }

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