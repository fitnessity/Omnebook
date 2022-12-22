@extends('layouts.header')
@section('content')
@include('layouts.userHeader')



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
									<button type="button" class="btn-nxt manage-search search-add-client" id="">Add New Client </button>
								</div>
								<div class="col-md-5 col-sm-12 col-xs-12">
									<div class="manage-search search-checkout">
										<form>
											<input type="text" name="serchclient" id="serchclient" placeholder="Search for previous client who is making a purchase?" autocomplete="off" value="">
											<div id="option-box1" style="display: none;"></div>
											<button><i class="fa fa-search"></i></button>
										</form>
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
												<label>Client Name: </label><span>Darryl Phipps (39 yrs Old)</span>
											</div>
											<div class="col-md-6 col-sm-12 col-xs-12 nopadding">
												<label>Location: </label><span>New York, NY United States</span>
											</div>
											<div class="col-md-6 col-sm-12 col-xs-12 nopadding">
												<label>Visits:  </label><span>20</span>
											</div>
											<div class="col-md-6 col-sm-12 col-xs-12 nopadding">
												<label>Activites Bookings: </label><span>5</span>
											</div>
											<div class="col-md-6 col-sm-12 col-xs-12 nopadding">
												<label>Last Membership: </label><span>3 Month Kickboxing (20 pack)</span>
											</div>
											<div class="col-md-6 col-sm-12 col-xs-12 nopadding">
												<label>Status: </label><span> Active </span>
											</div>
											<div class="col-md-6 col-sm-12 col-xs-12 nopadding">
												<label>Current Membership: </label><span>None</span>
											</div>
											<div class="col-md-6 col-sm-12 col-xs-12 nopadding">
												<label>Last Purchase: </label><span>T-shirt $34.95</span>
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
													<label>Select Program </label>
													<select name="cars" id="" class="form-control">
														<option value="1">Select Option</option>
														<option value="2">2</option>
														<option value="3">3</option>
														<option value="4">4</option>
													</select>
												</div>
											</div>
										</div>
										<div class="row">
											<div class="col-md-4 col-sm-4 col-xs-12">
												<label>Select Catagory </label>
												<select name="cars" id="" class="form-control">
													<option value="1">Select Option</option>
													<option value="2">2</option>
													<option value="3">3</option>
													<option value="4">4</option>
												</select>
											</div>
											<div class="col-md-4 col-sm-4 col-xs-12">
												<label>Select Price Option  </label>
												<select name="cars" id="" class="form-control">
													<option value="1">Select Option</option>
													<option value="2">2</option>
													<option value="3">3</option>
													<option value="4">4</option>
												</select>
											</div>
											<div class="col-md-4 col-sm-4 col-xs-12">
												<label> Membership Option</label>
												<select name="cars" id="" class="form-control">
													<option value="1">Select Option</option>
													<option value="2">2</option>
													<option value="3">3</option>
													<option value="4">4</option>
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
													<input type="text" class="form-control valid" id="" placeholder="$1200.00">
												</div>
											</div>
											<div class="col-md-4 col-sm-4 col-xs-12">
												<div class="select0service">
													<label>Discount</label>
													<div class="row">
														<div class="col-md-6 col-sm-6 col-xs-6 nopadding">
															<div class="choose-tip">
																<select name="cars" id="" class="form-control">
																	<option value="1">Choose $ or % </option>
																	<option value="2">2</option>
																	<option value="3">3</option>
																	<option value="4">4</option>
																</select>
															</div>
														</div>
														<div class="col-md-6 col-sm-6 col-xs-6 nopadding">
															<div class="choose-tip">
																<input type="text" class="form-control valid" id="" placeholder="Enter Amount">
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
																<select name="cars" id="" class="form-control">
																	<option value="1">Choose $ or % </option>
																	<option value="2">2</option>
																	<option value="3">3</option>
																	<option value="4">4</option>
																</select>
															</div>
														</div>
														<div class="col-md-6 col-sm-6 col-xs-6 nopadding">
															<div class="choose-tip">
																<input type="text" class="form-control valid" id="" placeholder="Enter Amount">
															</div>
														</div>
													</div>
												</div>
											</div>
										</div>
										
										<div class="row">
											<div class="col-md-4 col-sm-4 col-xs-12">
												<div class="select0service">
													<label>Quantity </label>
													<div class="choose-tip">
														<select name="cars" id="" class="form-control">
															<option value="1">Select </option>
															<option value="2">2</option>
															<option value="3">3</option>
															<option value="4">4</option>
														</select>
													</div>
												</div>
											</div>
											<div class="col-md-4 col-sm-4 col-xs-12">
												<div class="select0service">
													<label>Duration</label>
													<div class="row">
														<div class="col-md-6 col-sm-6 col-xs-6 nopadding">
															<input type="text" class="form-control valid" id="" placeholder="12">
														</div>
														<div class="col-md-6 col-sm-6 col-xs-6 nopadding">
															<div class="choose-tip">
																<select name="cars" id="" class="form-control">
																	<option value="1">Day(s) </option>
																	<option value="2">2</option>
																	<option value="3">3</option>
																	<option value="4">4</option>
																</select>
															</div>
														</div>
													</div>
												</div>
											</div>
											<div class="col-md-4 col-sm-4 col-xs-12">
												<div class="select0service">
													<label>Date This Activates?</label>
													<div class="date-activity-scheduler date-activity-check">
														<input type="text"  id="" placeholder="Search By Date" class="form-control activity-scheduler-date w-80">
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
								
								<div class="col-md-12">
									<div class="check-out-steps"><label><h2 class="color-red">Step 3: </h2> Check Your Booking Summary</label></div>
									<div class="check-client-info">
										<div class="row payment-detials">
											<div class="col-md-6 col-sm-6 col-xs-6"> 
												<label>Program Name</label>
											</div>
											<div class="col-md-6 col-sm-6 col-xs-6"> 
												<span></span>
											</div>
												
											<div class="col-md-6 col-sm-6 col-xs-6"> 
												<label>Catagory</label>
											</div>
											<div class="col-md-6 col-sm-6 col-xs-6"> 
												<span></span>
											</div>
												
											<div class="col-md-6 col-sm-6 col-xs-6"> 
												<label>Price Option</label>
											</div>
											<div class="col-md-6 col-sm-6 col-xs-6"> 
												<span></span>
											</div>
												
											<div class="col-md-6 col-sm-6 col-xs-6"> 
												<label>Memberhsip Option</label>
											</div>
											<div class="col-md-6 col-sm-6 col-xs-6"> 
												<span></span>
											</div>
												
											<div class="col-md-6 col-sm-6 col-xs-6"> 
												<label>Quantity	</label>
											</div>
											<div class="col-md-6 col-sm-6 col-xs-6"> 
												<span></span>
											</div>
											
											<div class="col-md-6 col-sm-6 col-xs-6"> 
												<label>Duration</label>
											</div>
											<div class="col-md-6 col-sm-6 col-xs-6"> 
												<span></span>
											</div>
											
											<div class="col-md-6 col-sm-6 col-xs-6"> 
												<label>Activates on 12/17/2022	</label>
											</div>
											<div class="col-md-6 col-sm-6 col-xs-6"> 
												<span></span>
											</div>
												
											<div class="col-md-12 col-sm-12 col-xs-12">
												<div class="checkout-sapre-tor">
												</div>
											</div>
											
											<div class="col-md-6 col-sm-6 col-xs-6"> 
												<label>Tip Amount</label>
											</div>
											<div class="col-md-6 col-sm-6 col-xs-6"> 
												<span></span>
											</div>
											
											<div class="col-md-6 col-sm-6 col-xs-6"> 
												<label>Discount </label>
											</div>
											<div class="col-md-6 col-sm-6 col-xs-6"> 
												<span></span>
											</div>
											
											<div class="col-md-6 col-sm-6 col-xs-6"> 
												<div class="tax-check">
													<label>Tax </label>
													<form action="">
													  <input type="checkbox" id="vehicle1" name="vehicle1" value="Bike">
													  <label for="vehicle1"> No Tax</label><br>
													</form>
												</div>
											</div>
											<div class="col-md-6 col-sm-6 col-xs-6"> 
												<span></span>
											</div>
											
											<div class="col-md-6 col-sm-6 col-xs-6"> 
												<h2>Total</h2>
											</div>
											<div class="col-md-6 col-sm-6 col-xs-6"> 
												<h2 class="total-amount"></h2>
											</div>
										</div>
									</div>
									<button type="button" class="btn-nxt btn-search-checkout mb-00" id="">Add To Order </button>
								</div>
							</div>						
							
						</div>
					</div>
					
					<div class="col-md-5 col-sm-12 col-xs-12">
						<div class="activity_purchase-box">
							<div class="ticket-summery ticket-title">
								<h4>Order Summary</h4>
							</div>
							
							<div class="row">
								<div class="col-md-12">
									<div class="check-client-info-box">
										<div class="close-cross-icon">
											<i class="fas fa-pencil-alt"></i>
										</div>
										<div class="close-cross-icon-trash">
											<i class="fas fa-trash-alt"></i>
										</div>
										<div class="ticket-summery-details">
											<div class="row">
												<div class="col-md-6 col-sm-6 col-xs-6">
													<label>Program Name </label>
												</div>
												<div class="col-md-6 col-sm-6 col-xs-6">
													<span>Kickboxing Class for Valor </span>
												</div>
												
												<div class="col-md-6 col-sm-6 col-xs-6">
													<label>Catagory: </label>
												</div>
												<div class="col-md-6 col-sm-6 col-xs-6">
													<span>Adult Kickboxing</span>
												</div>
												
												<div class="col-md-6 col-sm-6 col-xs-6">
													<label>Price Option:</label>
												</div>
												<div class="col-md-6 col-sm-6 col-xs-6">
													<span>Kickboxing for Adults - 20 sessions</span>
												</div>
												
												<div class="col-md-6 col-sm-6 col-xs-6">
													<label>Membership Option:</label>
												</div>
												<div class="col-md-6 col-sm-6 col-xs-6">
													<span>Drop In</span>
												</div>
												
												<div class="col-md-6 col-sm-6 col-xs-6">
													<label class="total0spretor">Subtotal </label>
												</div>
												<div class="col-md-6 col-sm-6 col-xs-6">
													<span class="total0spretor">$1200.00</span>
												</div>
												
												<div class="col-md-6 col-sm-6 col-xs-6">
													<label>Discount </label>
												</div>
												<div class="col-md-6 col-sm-6 col-xs-6">
													<span>$0.00</span>
												</div>
												
												<div class="col-md-6 col-sm-6 col-xs-6">
													<label>Taxes (NYC) </label>
												</div>
												<div class="col-md-6 col-sm-6 col-xs-6">
													<span>$102.00</span>
												</div>
												
												<div class="col-md-6 col-sm-6 col-xs-6">
													<h2>Total </h2>
												</div>
												<div class="col-md-6 col-sm-6 col-xs-6">
													<h2 class="total-amount"> $1,302.00</h2>
												</div>

												<div class="col-md-12 col-sm-12 col-xs-12">
													<div class="checkout-sapre-tor">
													</div>
												</div>
											</div>
										</div>

										<div class="close-cross-icon">
											<i class="fas fa-pencil-alt"></i>
										</div>
										<div class="close-cross-icon-trash">
											<i class="fas fa-trash-alt"></i>
										</div>
										<div class="ticket-summery-details">
											<div class="row">
												<div class="col-md-6 col-sm-6 col-xs-6">
													<label>Program Name </label>
												</div>
												<div class="col-md-6 col-sm-6 col-xs-6">
													<span>Kickboxing Class for Valor </span>
												</div>
												
												<div class="col-md-6 col-sm-6 col-xs-6">
													<label>Catagory: </label>
												</div>
												<div class="col-md-6 col-sm-6 col-xs-6">
													<span>Adult Kickboxing</span>
												</div>
												
												<div class="col-md-6 col-sm-6 col-xs-6">
													<label>Price Option:</label>
												</div>
												<div class="col-md-6 col-sm-6 col-xs-6">
													<span>Kickboxing for Adults - 20 sessions</span>
												</div>
												
												<div class="col-md-6 col-sm-6 col-xs-6">
													<label>Membership Option:</label>
												</div>
												<div class="col-md-6 col-sm-6 col-xs-6">
													<span>Drop In</span>
												</div>
												
												<div class="col-md-6 col-sm-6 col-xs-6">
													<label class="total0spretor">Subtotal </label>
												</div>
												<div class="col-md-6 col-sm-6 col-xs-6">
													<span class="total0spretor">$1200.00</span>
												</div>
												
												<div class="col-md-6 col-sm-6 col-xs-6">
													<label>Discount </label>
												</div>
												<div class="col-md-6 col-sm-6 col-xs-6">
													<span>$0.00</span>
												</div>
												
												<div class="col-md-6 col-sm-6 col-xs-6">
													<label>Taxes (NYC) </label>
												</div>
												<div class="col-md-6 col-sm-6 col-xs-6">
													<span>$102.00</span>
												</div>
												
												<div class="col-md-6 col-sm-6 col-xs-6">
													<h2>Total </h2>
												</div>
												<div class="col-md-6 col-sm-6 col-xs-6">
													<h2 class="total-amount"> $1,302.00</h2>
												</div>
											</div>
										</div>

									</div>
								</div>
							</div>
							
							<div class="row">
								<div class="col-md-12">
									<div class="check-client-info total-checkout">
										<div class="row">
											<div class="col-md-6 col-sm-6 col-xs-6">
												<h3 class="total0spretor-bt">Subtotal </h3>
											</div>
											<div class="col-md-6 col-sm-6 col-xs-6">
												<h3 class="total0spretor-bt total-amount">$3,672.76  </h3>
											</div>
											
											<div class="col-md-6 col-sm-6 col-xs-6">
												<label>Tip</label>
											</div>
											<div class="col-md-6 col-sm-6 col-xs-6">
												<span>$300</span>
											</div>
											
											<div class="col-md-6 col-sm-6 col-xs-6">
												<label>Discount </label>
											</div>
											<div class="col-md-6 col-sm-6 col-xs-6">
												<span>$0.00</span>
											</div>
											
											<div class="col-md-6 col-sm-6 col-xs-6">
												<label>Tax </label>
											</div>
											<div class="col-md-6 col-sm-6 col-xs-6">
												<span>$287.76</span>
											</div>
											
											<div class="col-md-6 col-sm-6 col-xs-6">
												<label>Service Fee: 7% </label>
											</div>
											<div class="col-md-6 col-sm-6 col-xs-6">
												<span> $257.04</span>
											</div>
											<div class="col-md-12 col-sm-12 col-xs-12">
												<div class="checkout-sapre-tor">
												</div>
											</div>
											<div class="col-md-6 col-sm-6 col-xs-6">
												<h2>Grandtotal</h2>
											</div>
											<div class="col-md-6 col-sm-6 col-xs-6">
												<h2 class="total-amount">$4,517.56</h2>
											</div>
											
										</div>
									</div>
								</div>
							</div>

							<div class="row">
								<div class="col-md-12 col-sm-12 col-xs-12">
									<div class="payment-method">
										<label>Select Payment Method</label>
									</div>
								</div>
								<div class="col-md-4 col-sm-4 col-xs-12">
									<div class="check-client-info payment-method-img">
										<img src="../public/images/cash-icon.png" alt="img" class="w-100" width="100">
										<label>Cash</label>
									</div>
								</div>

								<div class="col-md-4 col-sm-4 col-xs-12">
									<div class="check-client-info payment-method-img">
										<img src="../public/images/cc-on-file.png" alt="img" class="w-100" width="100">
										<label>CC (On File)</label>
									</div>
								</div>

								<div class="col-md-4 col-sm-4 col-xs-12">
									<div class="check-client-info payment-method-img">
										<img src="../public/images/input-cc.png" alt="img" class="w-100" width="100">
										<label>CC (On File)</label>
									</div>
								</div>
								<div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
									<button type="button" class="btn-nxt activity-purchase mb-00">Complete Payment</button>
								</div>
							</div>
							
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>





<script>
 $('.activity-scheduler-date').datepicker({
        dateFormat: "mm/dd/yy"
    })
</script>


@include('layouts.footer')

@endsection