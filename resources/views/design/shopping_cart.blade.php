@inject('request', 'Illuminate\Http\Request')
@extends('layouts.header')

@section('content')
	
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
                            <!--end col-->
						</div>
                        <!--end row-->
						<div class="row">
							<div class="col-xl-8">
								<div class="row align-items-center gy-3 mb-3">
									<div class="col-sm">
                                    <div>
                                        <h5 class="fs-14 mb-0">Your Cart (02 items)</h5>
                                    </div>
                                </div>
									<div class="col-sm-auto">
										<div class="float-end">
											<a href="#" class="fs-15 color-red-a">Continue Shopping</a>
										</div>
									</div>
								</div>
								
								<div class="card nopadding mb-2rem">									
									<div class="card-body">
										<div class="row">
											<div class="col-lg-12">
												<div class="text-center empty-cart">
													<h4 class="fs-17"> Your Cart Is Empty.</h4>
												</div>
											</div>
										</div>
									</div><!-- end card-body -->
								
								</div><!-- end card -->
								
								<div class="card nopadding mb-2rem">									
									<div class="card-body">
										<div class="row">
											<div class="col-lg-6">
												<label class="font-red fs-17">You can't book this activity for this date</label>
											</div>
											<div class="col-lg-6">
												<div class="float-end">
													<label class="font-red fs-17">Sold Out</label>
												</div>
											</div>
										</div>
										<div class="row">
											<div class="col-sm-auto">
												<div class="avatar-lg-custom bg-light rounded p-1">
													<img src="http://dev.fitnessity.co/public/uploads/profile_pic/1667281048-glfimages (1).jpg" alt="" class="img-fluid d-block">
												</div>
											</div>
											<div class="col-sm">
												<h5 class="fs-20 mt-15 text-truncate"><a href="#" class="text-dark">Go Golfers</a></h5>
												<a class="fs-13 color-red-a" data-bs-toggle="modal" data-bs-target="#booking-details">Booking Details</a>
												<div class="row">
													<div class="col-md-4 col-sm-6 mb-3">
														<div class="text-left">
															<h6 class="mb-3 mt-3 fs-12">Select 1st Participant</h6>
														</div>
														<div class="hstack gap-3 px-3 mx-n3">
															<select class="form-select fs-13" name="position" required="">
																<option value="720" data-cnt="0" data-priceid="1077" data-type="user">Choose or Add Participant</option>
																<option value="720" data-cnt="0" data-priceid="1077" data-type="user">Nipa Soni</option>
																<option value="addparticipate">+ Add New Participant</option>
															</select>
														</div>
														<!--<div class="mt-3 mb-3">
															<label class="fs-13"> <b>Participant#1:</b> Olivia Anderson </label>
														</div>-->
													</div>
													<div class="col-md-4 col-sm-6 mb-3">
														<div class="text-left">
															<h6 class="mb-3 mt-3 fs-12">Select 2nd Participant</h6>
														</div>
														<div class="hstack gap-3 px-3 mx-n3">
															<select class="form-select fs-13" name="position" required="">
																<option value="720" data-cnt="0" data-priceid="1077" data-type="user">Choose or Add Participant</option>
																<option value="720" data-cnt="0" data-priceid="1077" data-type="user">Nipa Soni</option>
																<option value="addparticipate">+ Add New Participant</option>
															</select>
														</div>
														
													</div>
													<div class="col-md-4 col-sm-6 mb-3">
														<div class="text-left">
															<h6 class="mb-3 mt-3 fs-12">Select 3rd Participant</h6>
														</div>
														<div class="hstack gap-3 px-3 mx-n3">
															<select class="form-select fs-13" name="position" required="">
																<option value="720" data-cnt="0" data-priceid="1077" data-type="user">Choose or Add Participant</option>
																<option value="720" data-cnt="0" data-priceid="1077" data-type="user">Nipa Soni</option>
																<option value="addparticipate">+ Add New Participant</option>
															</select>
														</div>
														
													</div>
												</div>
											</div>
											<div class="col-sm-auto">
												<div class="text-lg-end item-price">
													<p class="text-muted mb-1">Item Price:</p>
													<h5 class="fs-20">$<span id="ticket_price" class="product-price">119.99</span></h5>
												</div>
											</div>
											
											<div class="col-lg-12">
												<div class="terms-head">
													<h4 class="fs-17"> Terms:</h4>
													<p class="fs-13"> View the terms and conditions from this provider below.</p>
													<div>
                                                       <a href="" class="font-13 color-red-a" data-bs-toggle="modal" data-bs-target="#termsModal_68">Terms, Conditions, FAQ</a> |  
                                                       <a href="" class="font-13 color-red-a" data-bs-toggle="modal" data-bs-target="#liabilityModal_68">Liability Waiver</a> |  
														<a href="" class="font-13 color-red-a" data-bs-toggle="modal" data-bs-target="#contractModal_68">Contract Terms</a> |  
													</div>
												</div>
											</div>
										</div>
									</div><!-- end card-body -->
									<div class="card-footer card-footer-checkout">
										<div class="row align-items-center gy-3">
											<div class="col-lg-5 col-5">
												<div class="d-flex flex-wrap my-n1">
													<div>
														<a href="#" class="d-block text-body p-1 px-2 font-14"><i class="fas fa-edit text-muted me-1"></i> Edit</a>
													</div>
													<div>
														<a href="#" class="d-block text-body p-1 px-2 font-14"><i class="fas fa-share-alt text-muted me-1"></i> Share</a>
													</div>
													<div>
														<a href="#" class="d-block text-body p-1 px-2 font-14"><i class="fas fa-trash-alt text-muted me-1"></i> Remove</a>
													</div>
												</div>
											</div>
											<div class="col-lg-7 col-7">
												<div class="d-grid float-end">
													<div class="d-flex align-items-center gap-2 float-end">
														<input class="ncart-payfor" type="checkbox" id="payforcheckbox" name="payforcheckbox" value="" onclick="opengiftpopup()">
														<label class="ncart-payfor-label" for="payforcheckbox">Paying or gifting for someone?</label>
													</div>
													<p class="fs-11 float-end">Share the booking details with them</p>
													<div class="btn-ord-txt">
														<a href="#" class="post-btn-red" data-bs-toggle="modal" data-bs-target="#leavegift" style="display:none;" id="giftanotheralink"></a>
													</div>
												</div>
											</div>
										</div>
									</div><!-- end card footer -->
								</div><!-- end card -->
								
								<div class="card nopadding mb-2rem">
									<div class="card-body">
										<div class="row">
											<div class="col-sm-auto">
												<div class="avatar-lg-custom bg-light rounded p-1">
													<img src="http://dev.fitnessity.co/public/uploads/profile_pic/1670234097-20220911_114723.jpg" alt="" class="img-fluid d-block">
												</div>
											</div>
											<div class="col-sm">
												<h5 class="fs-20 mt-15 text-truncate"><a href="#" class="text-dark">Rock Climbing At USA</a></h5>
												<a class="fs-13 color-red-a" data-bs-toggle="modal" data-bs-target="#booking-details">Booking Details</a>
												<div class="row">
													<div class="col-md-4 col-sm-6 mb-3">
														<div class="text-left">
															<h6 class="mb-3 mt-3 fs-12">Select Who's Participating</h6>
														</div>
														<div class="hstack gap-3 px-3 mx-n3">
															<select class="form-select fs-13" name="position" required="">
																<option value="720" data-cnt="0" data-priceid="1077" data-type="user">Choose or Add Participant</option>
																<option value="720" data-cnt="0" data-priceid="1077" data-type="user">Nipa Soni</option>
																<option value="addparticipate">+ Add New Participant</option>
															</select>
														</div>
													</div>
													<div class="col-md-4 col-sm-6 mb-3">
														<div class="text-left">
															<h6 class="mb-3 mt-3 fs-12">Select Who's Participating</h6>
														</div>
														<div class="hstack gap-3 px-3 mx-n3">
															<select class="form-select fs-13" name="position" required="">
																<option value="720" data-cnt="0" data-priceid="1077" data-type="user">Choose or Add Participant</option>
																<option value="720" data-cnt="0" data-priceid="1077" data-type="user">Nipa Soni</option>
																<option value="addparticipate">+ Add New Participant</option>
															</select>
														</div>
													</div>
													<div class="col-md-4 col-sm-6 mb-3">
														<div class="text-left">
															<h6 class="mb-3 mt-3 fs-12">Select Who's Participating</h6>
														</div>
														<div class="hstack gap-3 px-3 mx-n3">
															<select class="form-select fs-13" name="position" required="">
																<option value="720" data-cnt="0" data-priceid="1077" data-type="user">Choose or Add Participant</option>
																<option value="720" data-cnt="0" data-priceid="1077" data-type="user">Nipa Soni</option>
																<option value="addparticipate">+ Add New Participant</option>
															</select>
														</div>
													</div>
													
												</div>
											</div>
											<div class="col-sm-auto">
												<div class="text-lg-end item-price">
													<p class="text-muted mb-1">Item Price:</p>
													<h5 class="fs-20">$<span id="ticket_price" class="product-price">259.45</span></h5>
												</div>
											</div>
											
											<div class="col-lg-12">
												<div class="terms-head">
													<h4 class="fs-17"> Terms:</h4>
													<p class="fs-13"> View the terms and conditions from this provider below.</p>
													<div>
                                                       <a href="" data-toggle="modal" class="font-13 color-red-a" data-target="#termsModal_68">Terms, Conditions, FAQ</a> |  
                                                       <a href="" data-toggle="modal" class="font-13 color-red-a" data-target="#liabilityModal_68">Liability Waiver</a> |  
														<a href="" data-toggle="modal" class="font-13 color-red-a" data-target="#contractModal_68">Contract Terms</a> |  
													</div>
												</div>
											</div>
										</div>
									</div><!-- end card-body -->
									<div class="card-footer card-footer-checkout">
										<div class="row align-items-center gy-3">
											<div class="col-lg-5 col-5">
												<div class="d-flex flex-wrap my-n1">
													<div>
														<a href="#" class="d-block text-body p-1 px-2 font-14"><i class="fas fa-edit text-muted me-1"></i> Edit</a>
													</div>
													<div>
														<a href="#" class="d-block text-body p-1 px-2 font-14"><i class="fas fa-share-alt text-muted me-1"></i> Share</a>
													</div>
													<div>
														<a href="#" class="d-block text-body p-1 px-2 font-14"><i class="fas fa-trash-alt text-muted me-1"></i> Remove</a>
													</div>
												</div>
											</div>
											<div class="col-lg-7 col-7">
												<div class="d-grid float-end">
													<div class="d-flex align-items-center gap-2 float-end">
														<input class="ncart-payfor" type="checkbox" id="payforcheckbox" name="payforcheckbox" value="" onclick="opengiftpopup()">
														<label class="ncart-payfor-label" for="payforcheckbox">Paying or gifting for someone?</label>
													</div>
													<p class="fs-11 float-end">Share the booking details with them</p>
													<div class="btn-ord-txt">
														<a href="#" class="post-btn-red" data-bs-toggle="modal" data-bs-target="#leavegift" style="display:none;" id="giftanotheralink"></a>
													</div>
												</div>
											</div>
										</div>
									</div><!-- end card footer -->
								</div><!-- end card -->
								
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
													<span class="fs-15 float-end">2</span>
												</div>
												<div class="col-6">
													<label class="fs-15">Subtotal </label>
												</div>
												<div class="col-6">
													<span class="fs-15 float-end">$ 67.00 </span>
												</div>
												<div class="col-6">
													<label class="fs-15">Taxes & Fees:</label>
												</div>
												<div class="col-6">
													<span class="fs-15 float-end">$ 9.71</span>
												</div>
												<div class="col-lg-12 col-12">
													<div class="border-wid-grey"></div>
												</div>
												<div class="col-6">
													<label class="fs-15">Grand Total:</label>
												</div>
												<div class="col-6">
													<label class="fs-15 float-end">$76.71</label>
												</div>
												<div class="col-12">
													<div class="terms-wrap">
													<input type="checkbox" id="terms_condition" name="terms_condition" value="">
													<p class="cart-terms fs-13"> The provider(s) require that you agree to some terms and conditions before booking this activity. 
													<br> <br> By checking this box, you Nipa Soni agree on 07/04/2023 to the terms the provider(s) require upon booking. You agree that you are 18+ to book this activity. You also agree to the Fitnessity privacy policy &amp; terms of agreement. </p>
													</div>
												</div>
											</div>
										</div>
									</div>
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
													<a href="/personal-profile/payment-info" class="edit-cart fs-15 color-red-a float-end"> Edit</a>
												</div>
												
											</div>
												
											<div class="row">
												<div class="col-md-6">
													<label class="pay-card" style="color:#ffffff; background-image: url(/public/img/visa-card-bg.jpg );">
														<input name="cardinfo" class="payment-radio" type="radio" value="pm_1MnbvRCr65ASmcsq0hbAAK7a">
														<span class="plan-details">
															<div class="row">
																<div class="col-md-12">
																	<div class="cart-name">
																		<span>mastercard</span>
																	</div>
																</div>
																<div class="col-md-12">
																	<div class="cart-num">
																		<span>XXXX XXXX XXXX 3222</span>
																	</div>
																</div>
															</div>
														</span>
													</label>
												</div>
                                     
												<div class="col-md-6">
													<label class="pay-card" style="color:#ffffff; background-image: url(/public/img/visa-card-bg.jpg );">
														<input name="cardinfo" class="payment-radio" type="radio" value="pm_1MpRLZCr65ASmcsqWiLKPGuE">
														<span class="plan-details">
															<div class="row">
																<div class="col-md-12">
																	<div class="cart-name">
																		<span>discover</span>
																	</div>
																</div>
																<div class="col-md-12">
																	<div class="cart-num">
																		<span>XXXX XXXX XXXX 1113</span>
																	</div>
																</div>
															</div>
														</span>
													</label>
												</div>
                                     
												 <div class="col-md-6">
													<label class="pay-card" style="color:#ffffff; background-image: url(/public/img/visa-card-bg.jpg );">
														<input name="cardinfo" class="payment-radio" type="radio" value="pm_1Mw2aACr65ASmcsqyEo8vjqs">
														<span class="plan-details">
															<div class="row">
																<div class="col-md-12">
																	<div class="cart-name">
																		<span>mastercard</span>
																	</div>
																</div>
																<div class="col-md-12">
																	<div class="cart-num">
																		<span>XXXX XXXX XXXX 8210</span>
																	</div>
																</div>
															</div>
														</span>
													</label>
												</div>
                                     
												<div class="col-md-6">
													<label class="pay-card" style="color:#ffffff; background-image: url(/public/img/visa-card-bg.jpg );">
														<input name="cardinfo" class="payment-radio" type="radio" value="pm_1Mw2gLCr65ASmcsqdbN8Shj6">
														<span class="plan-details">
															<div class="row">
																<div class="col-md-12">
																	<div class="cart-name">
																		<span>visa</span>
																	</div>
																</div>
																<div class="col-md-12">
																	<div class="cart-num">
																		<span>XXXX XXXX XXXX 5556</span>
																	</div>
																</div>
															</div>
														</span>
													</label>
												</div>
                                     
												<div class="col-md-6">
													<label class="pay-card" style="color:#ffffff; background-image: url(/public/img/visa-card-bg.jpg );">
														<input name="cardinfo" class="payment-radio" type="radio" value="pm_1Mw2jmCr65ASmcsqzrsPfU4t">
														<span class="plan-details">
															<div class="row">
																<div class="col-md-12">
																	<div class="cart-name">
																		<span>amex</span>
																	</div>
																</div>
																<div class="col-md-12">
																	<div class="cart-num">
																		<span>XXXX XXXX XXXX 8431</span>
																	</div>
																</div>
															</div>
														</span>
													</label>
												</div>
                                     
												<div class="col-md-6">
													<label class="pay-card" style="color:#ffffff; background-image: url(/public/img/visa-card-bg.jpg );">
														<input name="cardinfo" class="payment-radio" type="radio" value="pm_1N0OpoCr65ASmcsq59sxzvJC">
														<span class="plan-details">
															<div class="row">
																<div class="col-md-12">
																	<div class="cart-name">
																		<span>visa</span>
																	</div>
																</div>
																<div class="col-md-12">
																	<div class="cart-num">
																		<span>XXXX XXXX XXXX 4242</span>
																	</div>
																</div>
															</div>
														</span>
													</label>
												</div>
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
												
												<div class="text-end mb-4">
													<button class="btn btn-cart-checkout btn-label right ms-auto">
														<i class="fas fa-arrow-right label-icon align-bottom fs-16 ms-2"></i> Checkout
													</button>
												</div>
										
											</div>
											
										</div>
									</div>
								</div>
							</div>
							
						</div><!--end row-->					
					</div> <!-- end .h-100-->
                  </div> <!-- end col -->
                </div>
            </div><!-- container-fluid -->
        </div><!-- End Page-content -->

												
<!-- Modal -->
<div class="modal" id="booking-details" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Go Golfers</h5>
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
							<span> 05/19/2023 </span>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-6 col-xs-6"> 
						<div class="info-display">
							<label>Time &amp; Duration:</label>
						</div>
					</div> 
					<div class="col-md-6 col-xs-6"> 
						<div class="info-display info-align"> 
							<span>02:30am to 03:30am | 1hr. </span>
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
							<span>global acdamy</span>
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
							<span>30 Minute Private (01 Pack)</span>
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
							<span>07/04/2023</span>
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
							<span>10000 Sessions</span>
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
							<span>Drop In</span>
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
							<span>Adult x 1</span>
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
							<span>Golf </span>
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
							<span> Therapy,Class,Therapy </span>
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
							<span> 	1 Days</span>
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
							<span>07/04/2023</span>
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
							<span>07/04/2023 </span>
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
							<span>	07/05/2023</span>
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
							<span>Fitness Pvt. Ltd.</span>
						</div>
					</div>
				</div>
				
			</div>
		</div>
	</div>
</div>
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
	        		<div class="row">
						<div class="col-lg-2 col-sm-4 col-4">
							<div class="activity-title-img">
								<img src="http://dev.fitnessity.co/public/uploads/profile_pic/1667281048-glfimages (1).jpg" alt="Avatar" class="avatar-cart">
							</div>
						</div>
						<div class="col-lg-10 col-sm-8 col-8">
							<div class="activity-details">
								<h3 id="act_name">Go Golfers</h3>
								<p class="fs-13">We will include all of the booking details in the email your guest will receive</p>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-lg-6">
							<div class="gift-comments">
								<label class="">Leave a comment for them</label>
								<textarea class="form-control" rows="4" name="comment" id="comment" maxlength="150"></textarea>
								<label>From:</label>
								<input type="name" class="form-control myemail" name="gift_from" id="gift_from" autocomplete="off" placeholder="" size="30" maxlength="80" value="">
							</div>
						</div>
						<div class="col-lg-6">
							<div class="gift-comments email multiple-email" id="emaildiv">
								<input type="email" class="form-control myemail" name="Emailb[]" id="b_email" autocomplete="off" placeholder="Enter Recipient Email" size="30" maxlength="80" value="">
							</div>
							<a href="#" class="addnewemail fs-13" onclick="addemail();">+Add another email</a>
						</div>
					</div>
					<div class="row">
						<div class="col-lg-12">
							<div class="booking-checkbox">
								<input type="checkbox" id="price_show" name="price_show" value="1">
								<label class="fs-13" for="price_show">Don’t Show The Price</label>
								<p class="fs-13">If this is a gift, you can have the option not to show the price in the booking email.</p>
							</div>
						</div>
						<div class="col-lg-12 text-right">
							<button class="post-btn-red fs-13" type="submit" id="submit">Save</button>
						</div>
					</div>
	        	</div>					        
	       	</div>
		</div>
	</div>
<!-- end modal -->
<!-- The Modal Terms, Conditions, FAQ-->
	<div class="modal" id="termsModal_68" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
	    <div class="modal-dialog modal-dialog-centered">
	        <div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="staticBackdropLabel">Terms, Conditions, FAQ</h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				  </div>

	            <!-- Modal body -->
	        	<div class="modal-body">
				<h2>Lorem ipsum dolor sit am ollit anim id est laborum</h2>
	        	</div>					        
	       	</div>
		</div>
	</div>
<!-- end modal -->
<!-- The Modal Liability Waiver-->
	<div class="modal" id="liabilityModal_68" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
	    <div class="modal-dialog modal-dialog-centered">
	        <div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="staticBackdropLabel">Liability Waiver</h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				  </div>

	            <!-- Modal body -->
	        	<div class="modal-body">
				<h2>Lorem ipsum dolor sit am ollit anim id est laborum</h2>
	        	</div>					        
	       	</div>
		</div>
	</div>
<!-- end modal -->
<!-- The Modal Contract Terms-->
	<div class="modal" id="contractModal_68" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
	    <div class="modal-dialog modal-dialog-centered">
	        <div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title">Contract Terms</h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				  </div>

	            <!-- Modal body -->
	        	<div class="modal-body">
				<h2>Lorem ipsum dolor sit am ollit anim id est laborum</h2>
	        	</div>					        
	       	</div>
		</div>
	</div>
<!-- end modal -->

	@include('layouts.business.footer')
	<script>
	function opengiftpopup(){
		var checkBox = document.getElementById("payforcheckbox");
		if (checkBox.checked == true){
		    $('#leavegift').modal('show');
		}
	}
</script>
	

@endsection