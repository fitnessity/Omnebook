@inject('request', 'Illuminate\Http\Request')
@extends('layouts.header')
@section('content')


<div class="container-fluid p-0 inner-top-activity">
	<div class="row">
		<div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
			<h3 class="subtitle details-sp mb-20 mtxt-cnter text-center" id="check_availability"> Check Availability </h3>
				<div class="row">
					<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
						<div class="book-instantly mb-20 text-center">
							<a class="font-red"> Book Instantly  </a>
							<span class="book-tool-tip" data-toggle="tooltip" data-placement="top" title="Lorem Ipsum is simply dummy text of the printing and typesetting industry.">
								<i class="fas fa-info"></i>
							</span>
						</div>
					</div>
					<!--<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
						<div class="text-right mb-20">
							<a class="font-red" data-toggle="modal" data-target="#requestbooking"> Request To Book </a>
							<span class="book-tool-tip" data-toggle="tooltip" data-placement="top" title="Lorem Ipsum is simply dummy text of the printing and typesetting industry.">
								<i class="fas fa-info"></i>
							</span>
						</div>
					</div>-->
				</div>
			<div class="activered" id="spoterror"></div>
			<div class="mainboxborder">	
				<div class="row">
					<div class="col-md-12 col-sm-12 col-xs-12">
						<div class="activities-calendar">
							<h3 class="date-title mt-10 mb-10">Friday, July 14,  2023</h3>
							<label class="mb-10">Step: 1 </label> <span class="">Select Date</span>
							<div class="row">
								<div class="col-md-12 col-sm-12 col-xs-12">
									<div class="activityselect3 special-date mb-20">
										<input type="text" name="actfildate_forcart" id="actfildate_forcart" placeholder="Date" class="form-control hasDatepicker" autocomplete="off" onchange="updatedetail(434,146);">
										<i class="fa fa-calendar"></i>
									</div>
								</div>
							</div>
						</div>
					</div>
						
					<div id="updatefilterforcart">
						<div class="col-md-12 col-sm-12 col-xs-12">
							<div class="choose-calendar-time">
								<div class="row">
									<div class="col-md-12 col-sm-12 col-xs-12">
										<label class="mb-10">Step: 2 </label> <span class="">Select Category</span>
										<select id="selcatpr146" name="selcatpr146" class="price-select-control" onchange="changeactsession('146','146',this.value,'book','ajax')">
											<option value="402">Summer Camp Full Day (8:30 am to 3:00 pm)</option>
										</select>
									
										<label class="mb-10">Step: 3 </label> <span class="">Select Price Option</span>
										<div class="priceoption" id="pricechng146146">
											<select id="selprice146" name="selprice146" class="price-select-control" onchange="changeactpr('146',this.value,'0','book','146')">
												<option value="1172">1 Day Full Camp</option><option value="1173">2 Day Full Camp</option>
											</select>
										</div>  

										<label class="mb-10">Step: 4 </label> <span class=""> Select Time</span>
										<div class="row" id="timeschedule">
											<div class="col-md-6 col-sm-4 col-xs-4">
												<div class="donate-now">
													<input type="radio" id="1145" name="amount" value="09:00" onclick="addhiddentime(1145,146,0);" checked="">
													<label for="1145">09:00 am</label>
													<p class="end-hr text-center">200/200 Spots Left.</p>
												</div>
											</div>
										</div>
									
										<label class="mb-10">Step: 5 </label> <span class=""> Select Participant</span>
											<div class="participant-accordion">
												<div class="content1">
													<div class="panel-group" id="accordion">
														<div class="panel panel-default">
															<div class="panel-heading">
																<h4 class="panel-title">
																	<a data-toggle="collapse" data-parent="#accordion" href="#collapseOne">Participant</a>
																</h4>
															</div>
															<div id="collapseOne" class="panel-collapse collapse">
																<div class="panel-body">
																	<div class="row">
																		<div class="col-md-12">
																			<div class="participant-selection btn-group">
																				<div class="row">
																					<div class="col-md-12 col-xs-12">
																						<div class="select">
																							<label class="btn button_select">Adults (Ages 13 & Up)</label>
																							<div class="qtyButtons">
																								<div class="qty count-members mt-5">
																									<span class="minus bg-darkbtn adultminus"><i class="fa fa-minus"></i></span>
																									<input type="text" class="count" name="adultcnt" id="adultcnt" min="0" value="0" readonly="">
																									<span class="plus bg-darkbtn adultplus"><i class="fa fa-plus"></i></span>
																								</div>   
																							</div>
																						</div>
																						
																						<div class="select">
																								<label class="btn button_select" for="item_2">Children (Ages 2-12)</label>
																								<div class="qtyButtons">
																								<div class="qty count-members mt-5">
																									<span class="minus bg-darkbtn childminus"><i class="fa fa-minus"></i></span>
																									<input type="text" class="count" name="childcnt" id="childcnt" min="0" value="0" readonly="">
																									<span class="plus bg-darkbtn childplus"><i class="fa fa-plus"></i></span>
																								</div>
																								</div>
																						</div>
																						
																						<div class="select">
																							<label class="btn button_select" for="item_3">Infants (Under 2)</label>
																							<div class="qtyButtons">
																								<div class="qty count-members mt-5">
																									<span class="minus bg-darkbtn infantminus"><i class="fa fa-minus"></i></span>
																									<input type="text" class="count" name="infantcnt" id="infantcnt" value="0" min="0" readonly="">
																									<span class="plus bg-darkbtn infantplus"><i class="fa fa-plus"></i></span>
																								</div>
																							</div>
																						</div>
																						
																					</div>
																				</div>
																			</div>
																		</div>
																	</div>
																</div>
															</div>
														</div>
													</div>
												</div>
											</div>
			
											<!--<div class="row y-middle mb-10">   
												<div class="col-md-6 col-sm-6 col-xs-6">
													<div class="">
														<p class="counter-age-heading">Adults</p>
														<p>Ages 13 &amp; Up</p>
													</div>
												</div>
												<div class="col-md-6 col-sm-6 col-xs-6">
													
												</div>
											</div>
											
										<div class="row y-middle mb-10">
											<div class="col-md-6 col-sm-6 col-xs-6">
												<div class="">
													<p class="counter-age-heading">Children</p>
													<p>Ages 2-12</p>
												</div>
											</div>
											<div class="col-md-6 col-sm-6 col-xs-6">
												
											</div>
										</div>
										
										<div class="row y-middle mb-20">
											<div class="col-md-6 col-sm-6 col-xs-6">
												<div class="">
													<p class="counter-age-heading">Infants</p>
													<p>Under 2</p>
												</div>
											</div>
											<div class="col-md-6 col-sm-6 col-xs-6">
												
											</div>
										</div>-->
									
										<label class="mb-10">Step: 6 </label> <span class=""> Select Add-On Service (Optional)</span>
											<div class="participant-accordion">
												<div class="content1">
													<div class="panel-group" id="accordiontwo">
														<div class="panel panel-default">
															<div class="panel-heading">
																<h4 class="panel-title">
																	<a data-toggle="collapse" data-parent="#accordiontwo" href="#collapseTwo">Add-On Services</a>
																</h4>
															</div>
															<div id="collapseTwo" class="panel-collapse collapse">
																<div class="panel-body">
																	<div class="row">
																		<div class="col-md-12">
																			<div class="add-onservice btn-group">
																				<div class="row">
																					<div class="col-md-12 col-xs-12">
																						<div class="select">
																							<input type="checkbox" id="item_4">
																							<label class="btn button_select" for="item_4">
																								Yoga
																								<span class="single-service-price"> $ 10.00</span>
																							</label>
																							<div class="qtyButtons">
																								<div class="qty count-members mt-5">
																									<span class="minus bg-darkbtn addonminus"><i class="fa fa-minus"></i></span>
																									<input type="text" class="count" name="add-one" id="add-one" min="0" value="0" readonly="">
																									<span class="plus bg-darkbtn addonplus"><i class="fa fa-plus"></i></span>
																								</div>   
																							</div>
																						</div>
																						
																						<div class="select">
																							<input type="checkbox" id="item_5">
																							<label class="btn button_select" for="item_5">
																								Beach Volleyball
																								<span class="single-service-price"> $ 20.00</span>
																							</label>
																							<div class="qtyButtons">
																								<div class="qty count-members mt-5">
																									<span class="minus bg-darkbtn addon2minus"><i class="fa fa-minus"></i></span>
																									<input type="text" class="count" name="add-two" id="add-two" min="0" value="0" readonly="">
																									<span class="plus bg-darkbtn addon2plus"><i class="fa fa-plus"></i></span>
																								</div>
																							</div>
																						</div>
																						
																					</div>
																				</div>
																			</div>
																		</div>
																	</div>
																</div>
															</div>
														</div>
													</div>
												</div>
											</div>
									<!--<div class="add-onservice btn-group ">
										<div class="row">
											<div class="col-md-12">
												<div class="select">
													<input type="checkbox" id="item_1">
													<label class="btn button_select" for="item_1">
														Yoga
														<span class="single-service-price"> $ 10.00</span>
													</label>
												</div>
												
												<div class="select">
														<input type="checkbox" id="item_2">
														<label class="btn button_select" for="item_2">
														Beach Volleyball
														<span class="single-service-price"> $ 20.00</span>
														</label>
												</div>
												
												<div class="select">
														<input type="checkbox" id="item_3">
														<label class="btn button_select" for="item_3">
														Raft & Ducky Trips
														<span class="single-service-price"> $ 25.00</span>
														</label>
												</div>
												
											</div>
										</div>
									</div>-->
									
									<!--<div class="row">
										<div class="col-md-12 col-sm-12 col-xs-6">
											<div class="counter-titles activity-counter mt-10">
												<p class="counter-age-heading">Adults</p>
												<p>(Ages 13 &amp; Up)</p>
											</div>
										</div>
										<div class="col-md-12 col-sm-12 col-xs-6">
											<div class="qty mt-5 text-center">
												<span class="minus bg-darkbtn adultminus"><i class="fa fa-minus"></i></span>
												<input type="text" class="count" name="adultcnt" id="adultcnt" min="0" value="0" readonly="">
												<span class="plus bg-darkbtn adultplus"><i class="fa fa-plus"></i></span>
											</div>
										</div>
									</div>
									
									<div class="row">
										<div class="col-md-12 col-sm-12 col-xs-6">
											<div class="counter-titles activity-counter mt-10">
												<p class="counter-age-heading">Children</p>
												<p>(Ages 2-12)</p>
											</div>
										</div>
										<div class="col-md-12 col-sm-12 col-xs-6">
											<div class="qty mt-5 text-center">
												<span class="minus bg-darkbtn childminus"><i class="fa fa-minus"></i></span>
												<input type="text" class="count" name="childcnt" id="childcnt" min="0" value="0" readonly="">
												<span class="plus bg-darkbtn childplus"><i class="fa fa-plus"></i></span>
											</div>
										</div>
									</div>
									
									<div class="row">
										<div class="col-md-12 col-sm-12 col-xs-6">
											<div class="counter-titles activity-counter mt-10">
												<p class="counter-age-heading">Infants</p>
												<p>(Under 2)</p>
											</div>
										</div>
										<div class="col-md-12 col-sm-12 col-xs-6">
											<div class="qty mt-5 text-center">
												<span class="minus bg-darkbtn infantminus"><i class="fa fa-minus"></i></span>
												<input type="text" class="count" name="infantcnt" id="infantcnt" value="0" min="0" readonly="">
												<span class="plus bg-darkbtn infantplus"><i class="fa fa-plus"></i></span>
											</div>
										</div>
									</div>-->
									
									</div>
								</div>
							</div>
						</div>
						<div class="">
							<div class="col-md-6 col-sm-6 col-xs-12">
								<div class="">
									<a href="#" data-toggle="modal" data-target="#booking-summery">Booking Summary </a>
								</div>
							</div>
							<div class="col-md-6 col-sm-6 col-xs-12">
								<div class="book0total-price">	
									<label>Total Price: </label>
									<span>$54 USD</span>
								</div>
							</div>
							<div class="col-md-12 col-sm-12 col-xs-12">
								<div class="text-right mt-10">
									<div id="cartadd">
										<div id="addcartdiv">
											<button type="button" id="btnaddcart" class="btn btn-red"> Add to Cart </button>
										</div>
									</div>
								</div>
							</div>
							
						
						</div>
					</div>
									
				</div>  
			</div>
	    </div>
		<div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
			<h3 class="subtitle details-sp mb-20 mtxt-cnter text-center" id="check_availability"> Check Availability </h3>
				<div class="row">
					<!--<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
						<div class="book-instantly mb-20 text-center">
							<a class="font-red"> Book Instantly  </a>
							<span class="book-tool-tip" data-toggle="tooltip" data-placement="top" title="Lorem Ipsum is simply dummy text of the printing and typesetting industry.">
								<i class="fas fa-info"></i>
							</span>
						</div>
					</div>-->
					<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
						<div class="text-center mb-20">
							<a class="font-red" data-toggle="modal" data-target="#requestbookinga"> Request To Book </a>
							<span class="book-tool-tip" data-toggle="tooltip" data-placement="top" title="Lorem Ipsum is simply dummy text of the printing and typesetting industry.">
								<i class="fas fa-info"></i>
							</span>
						</div>
					</div>
				</div>
			<div class="activered" id="spoterror"></div>
			<div class="mainboxborder">	
				<div class="row">
					<div class="col-md-12 col-sm-12 col-xs-12">
						<div class="activities-calendar">
							<h3 class="date-title mt-10 mb-10">Friday, July 14,  2023</h3>
							<label class="mb-10">Step: 1 </label> <span class="">Select Date</span>
							<div class="row">
								<div class="col-md-12 col-sm-12 col-xs-12">
									<div class="activityselect3 special-date mb-20">
										<input type="text" name="actfildate_forcart" id="actfildate_forcart" placeholder="Date" class="form-control hasDatepicker" autocomplete="off" onchange="updatedetail(434,146);">
										<i class="fa fa-calendar"></i>
									</div>
								</div>
							</div>
						</div>
					</div>
						
					<div id="updatefilterforcart">
						<div class="col-md-12 col-sm-12 col-xs-12">
							<div class="choose-calendar-time">
								<div class="row">
									<div class="col-md-12 col-sm-12 col-xs-12">
										<label class="mb-10">Step: 2 </label> <span class="">Select Category</span>
										<select id="selcatpr146" name="selcatpr146" class="price-select-control" onchange="changeactsession('146','146',this.value,'book','ajax')">
											<option value="402">Summer Camp Full Day (8:30 am to 3:00 pm)</option>
										</select>
									
										<label class="mb-10">Step: 3 </label> <span class="">Select Price Option</span>
										<div class="priceoption" id="pricechng146146">
											<select id="selprice146" name="selprice146" class="price-select-control" onchange="changeactpr('146',this.value,'0','book','146')">
												<option value="1172">1 Day Full Camp</option><option value="1173">2 Day Full Camp</option>
											</select>
										</div>  

										<label class="mb-10">Step: 4 </label> <span class=""> Select Time</span>
										<div class="row" id="timeschedule">
											<div class="col-md-6 col-sm-4 col-xs-4">
												<div class="donate-now">
													<input type="radio" id="1145" name="amount" value="09:00" onclick="addhiddentime(1145,146,0);" checked="">
													<label for="1145">09:00 am</label>
													<p class="end-hr text-center">200/200 Spots Left.</p>
												</div>
											</div>
										</div>
									
										<label class="mb-10">Step: 5 </label> <span class=""> Select Participant</span>
											<div class="participant-accordion">
												<div class="content1">
													<div class="panel-group" id="accordion">
														<div class="panel panel-default">
															<div class="panel-heading">
																<h4 class="panel-title">
																	<a data-toggle="collapse" data-parent="#accordion" href="#collapseOne">Participant</a>
																</h4>
															</div>
															<div id="collapseOne" class="panel-collapse collapse">
																<div class="panel-body">
																	<div class="row">
																		<div class="col-md-12">
																			<div class="participant-selection btn-group">
																				<div class="row">
																					<div class="col-md-12 col-xs-12">
																						<div class="select">
																							<label class="btn button_select">Adults (Ages 13 & Up)</label>
																							<div class="qtyButtons">
																								<div class="qty count-members mt-5">
																									<span class="minus bg-darkbtn adultminus"><i class="fa fa-minus"></i></span>
																									<input type="text" class="count" name="adultcnt" id="adultcnt" min="0" value="0" readonly="">
																									<span class="plus bg-darkbtn adultplus"><i class="fa fa-plus"></i></span>
																								</div>   
																							</div>
																						</div>
																						
																						<div class="select">
																								<label class="btn button_select" for="item_2">Children (Ages 2-12)</label>
																								<div class="qtyButtons">
																								<div class="qty count-members mt-5">
																									<span class="minus bg-darkbtn childminus"><i class="fa fa-minus"></i></span>
																									<input type="text" class="count" name="childcnt" id="childcnt" min="0" value="0" readonly="">
																									<span class="plus bg-darkbtn childplus"><i class="fa fa-plus"></i></span>
																								</div>
																								</div>
																						</div>
																						
																						<div class="select">
																							<label class="btn button_select" for="item_3">Infants (Under 2)</label>
																							<div class="qtyButtons">
																								<div class="qty count-members mt-5">
																									<span class="minus bg-darkbtn infantminus"><i class="fa fa-minus"></i></span>
																									<input type="text" class="count" name="infantcnt" id="infantcnt" value="0" min="0" readonly="">
																									<span class="plus bg-darkbtn infantplus"><i class="fa fa-plus"></i></span>
																								</div>
																							</div>
																						</div>
																						
																					</div>
																				</div>
																			</div>
																		</div>
																	</div>
																</div>
															</div>
														</div>
													</div>
												</div>
											</div>
			
											<!--<div class="row y-middle mb-10">   
												<div class="col-md-6 col-sm-6 col-xs-6">
													<div class="">
														<p class="counter-age-heading">Adults</p>
														<p>Ages 13 &amp; Up</p>
													</div>
												</div>
												<div class="col-md-6 col-sm-6 col-xs-6">
													
												</div>
											</div>
											
										<div class="row y-middle mb-10">
											<div class="col-md-6 col-sm-6 col-xs-6">
												<div class="">
													<p class="counter-age-heading">Children</p>
													<p>Ages 2-12</p>
												</div>
											</div>
											<div class="col-md-6 col-sm-6 col-xs-6">
												
											</div>
										</div>
										
										<div class="row y-middle mb-20">
											<div class="col-md-6 col-sm-6 col-xs-6">
												<div class="">
													<p class="counter-age-heading">Infants</p>
													<p>Under 2</p>
												</div>
											</div>
											<div class="col-md-6 col-sm-6 col-xs-6">
												
											</div>
										</div>-->
									
										<label class="mb-10">Step: 6 </label> <span class=""> Select Add-On Service (Optional)</span>
											<div class="participant-accordion">
												<div class="content1">
													<div class="panel-group" id="accordiontwo">
														<div class="panel panel-default">
															<div class="panel-heading">
																<h4 class="panel-title">
																	<a data-toggle="collapse" data-parent="#accordiontwo" href="#collapseTwo">Add-On Services</a>
																</h4>
															</div>
															<div id="collapseTwo" class="panel-collapse collapse">
																<div class="panel-body">
																	<div class="row">
																		<div class="col-md-12">
																			<div class="add-onservice btn-group">
																				<div class="row">
																					<div class="col-md-12 col-xs-12">
																						<div class="select">
																							<input type="checkbox" id="item_4">
																							<label class="btn button_select" for="item_4">
																								Yoga
																								<span class="single-service-price"> $ 10.00</span>
																							</label>
																							<div class="qtyButtons">
																								<div class="qty count-members mt-5">
																									<span class="minus bg-darkbtn addonminus"><i class="fa fa-minus"></i></span>
																									<input type="text" class="count" name="add-one" id="add-one" min="0" value="0" readonly="">
																									<span class="plus bg-darkbtn addonplus"><i class="fa fa-plus"></i></span>
																								</div>   
																							</div>
																						</div>
																						
																						<div class="select">
																							<input type="checkbox" id="item_5">
																							<label class="btn button_select" for="item_5">
																								Beach Volleyball
																								<span class="single-service-price"> $ 20.00</span>
																							</label>
																							<div class="qtyButtons">
																								<div class="qty count-members mt-5">
																									<span class="minus bg-darkbtn addon2minus"><i class="fa fa-minus"></i></span>
																									<input type="text" class="count" name="add-two" id="add-two" min="0" value="0" readonly="">
																									<span class="plus bg-darkbtn addon2plus"><i class="fa fa-plus"></i></span>
																								</div>
																							</div>
																						</div>
																						
																					</div>
																				</div>
																			</div>
																		</div>
																	</div>
																</div>
															</div>
														</div>
													</div>
												</div>
											</div>
									<!--<div class="add-onservice btn-group ">
										<div class="row">
											<div class="col-md-12">
												<div class="select">
													<input type="checkbox" id="item_1">
													<label class="btn button_select" for="item_1">
														Yoga
														<span class="single-service-price"> $ 10.00</span>
													</label>
												</div>
												
												<div class="select">
														<input type="checkbox" id="item_2">
														<label class="btn button_select" for="item_2">
														Beach Volleyball
														<span class="single-service-price"> $ 20.00</span>
														</label>
												</div>
												
												<div class="select">
														<input type="checkbox" id="item_3">
														<label class="btn button_select" for="item_3">
														Raft & Ducky Trips
														<span class="single-service-price"> $ 25.00</span>
														</label>
												</div>
												
											</div>
										</div>
									</div>-->
									
									<!--<div class="row">
										<div class="col-md-12 col-sm-12 col-xs-6">
											<div class="counter-titles activity-counter mt-10">
												<p class="counter-age-heading">Adults</p>
												<p>(Ages 13 &amp; Up)</p>
											</div>
										</div>
										<div class="col-md-12 col-sm-12 col-xs-6">
											<div class="qty mt-5 text-center">
												<span class="minus bg-darkbtn adultminus"><i class="fa fa-minus"></i></span>
												<input type="text" class="count" name="adultcnt" id="adultcnt" min="0" value="0" readonly="">
												<span class="plus bg-darkbtn adultplus"><i class="fa fa-plus"></i></span>
											</div>
										</div>
									</div>
									
									<div class="row">
										<div class="col-md-12 col-sm-12 col-xs-6">
											<div class="counter-titles activity-counter mt-10">
												<p class="counter-age-heading">Children</p>
												<p>(Ages 2-12)</p>
											</div>
										</div>
										<div class="col-md-12 col-sm-12 col-xs-6">
											<div class="qty mt-5 text-center">
												<span class="minus bg-darkbtn childminus"><i class="fa fa-minus"></i></span>
												<input type="text" class="count" name="childcnt" id="childcnt" min="0" value="0" readonly="">
												<span class="plus bg-darkbtn childplus"><i class="fa fa-plus"></i></span>
											</div>
										</div>
									</div>
									
									<div class="row">
										<div class="col-md-12 col-sm-12 col-xs-6">
											<div class="counter-titles activity-counter mt-10">
												<p class="counter-age-heading">Infants</p>
												<p>(Under 2)</p>
											</div>
										</div>
										<div class="col-md-12 col-sm-12 col-xs-6">
											<div class="qty mt-5 text-center">
												<span class="minus bg-darkbtn infantminus"><i class="fa fa-minus"></i></span>
												<input type="text" class="count" name="infantcnt" id="infantcnt" value="0" min="0" readonly="">
												<span class="plus bg-darkbtn infantplus"><i class="fa fa-plus"></i></span>
											</div>
										</div>
									</div>-->
									
									</div>
								</div>
							</div>
						</div>
						<div class="">
							<div class="col-md-6 col-sm-6 col-xs-12">
								<div class="">
									<a href="#" data-toggle="modal" data-target="#booking-summery">Booking Summary </a>
								</div>
							</div>
							<div class="col-md-6 col-sm-6 col-xs-12">
								<div class="book0total-price">	
									<label>Total Price: </label>
									<span>$54 USD</span>
								</div>
							</div>
							<div class="col-md-12 col-sm-12 col-xs-12">
								<div class="text-right mt-10">
									<div id="cartadd">
										<div id="addcartdiv">
											<button type="button" id="btnaddcart" class="btn btn-red"> Add Booking Request To Cart</button>
										</div>
									</div>
								</div>
							</div>
							
						
						</div>
					</div>
									
				</div>  
			</div>
	    </div>
		<div class="col-lg-3 col-md-3 col-sm-5 col-xs-12">
			<h3 class="subtitle details-sp mb-20 mtxt-cnter text-center" id="check_availability"> Check Availability </h3>
				<div class="row">
					<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
						<div class="text-center mb-20">
							<a class="font-red" data-toggle="modal" data-target="#requestbookinga"> Request To Book </a>
							<span class="book-tool-tip" data-toggle="tooltip" data-placement="top" title="Lorem Ipsum is simply dummy text of the printing and typesetting industry.">
								<i class="fas fa-info"></i>
							</span>
						</div>
					</div>
				</div>
			<div class="activered" id="spoterror"></div>
			<div class="mainboxborder not-claimed x-middle">	
				<div class="row">
					<div class="col-md-12 col-sm-12 col-xs-12">
						<div class="activities-calendar">
							<!--<h3 class="date-title mt-10 mb-10">Friday, July 14,  2023</h3>
							<label class="mb-10">Step: 1 </label> <span class="">Select Date</span>
							<div class="row">
								<div class="col-md-12 col-sm-12 col-xs-12">
									<div class="activityselect3 special-date mb-20">
										<input type="text" name="actfildate_forcart" id="actfildate_forcart" placeholder="Date" class="form-control hasDatepicker" autocomplete="off" onchange="updatedetail(434,146);">
										<i class="fa fa-calendar"></i>
									</div>
								</div>
							</div>-->
						</div>
					</div>
						
					<div id="updatefilterforcart">
						<!--<div class="col-md-12 col-sm-12 col-xs-12">
							<div class="choose-calendar-time">
								<div class="row">
									<div class="col-md-12 col-sm-12 col-xs-12">
										<label class="mb-10">Step: 2 </label> <span class="">Select Category</span>
										<select id="selcatpr146" name="selcatpr146" class="price-select-control" onchange="changeactsession('146','146',this.value,'book','ajax')">
											<option value="402">Summer Camp Full Day (8:30 am to 3:00 pm)</option>
										</select>
									
										<label class="mb-10">Step: 3 </label> <span class="">Select Price Option</span>
										<div class="priceoption" id="pricechng146146">
											<select id="selprice146" name="selprice146" class="price-select-control" onchange="changeactpr('146',this.value,'0','book','146')">
												<option value="1172">1 Day Full Camp</option><option value="1173">2 Day Full Camp</option>
											</select>
										</div>  

										<label class="mb-10">Step: 4 </label> <span class=""> Select Time</span>
										<div class="row" id="timeschedule">
											<div class="col-md-6 col-sm-4 col-xs-4">
												<div class="donate-now">
													<input type="radio" id="1145" name="amount" value="09:00" onclick="addhiddentime(1145,146,0);" checked="">
													<label for="1145">09:00 am</label>
													<p class="end-hr text-center">200/200 Spots Left.</p>
												</div>
											</div>
										</div>
									
										<label class="mb-10">Step: 5 </label> <span class=""> Select Participant</span>
											<div class="participant-accordion">
												<div class="content1">
													<div class="panel-group" id="accordion">
														<div class="panel panel-default">
															<div class="panel-heading">
																<h4 class="panel-title">
																	<a data-toggle="collapse" data-parent="#accordion" href="#collapseOne">Participant</a>
																</h4>
															</div>
															<div id="collapseOne" class="panel-collapse collapse">
																<div class="panel-body">
																	<div class="row">
																		<div class="col-md-12">
																			<div class="participant-selection btn-group">
																				<div class="row">
																					<div class="col-md-12 col-xs-12">
																						<div class="select">
																							<label class="btn button_select">Adults (Ages 13 & Up)</label>
																							<div class="qtyButtons">
																								<div class="qty count-members mt-5">
																									<span class="minus bg-darkbtn adultminus"><i class="fa fa-minus"></i></span>
																									<input type="text" class="count" name="adultcnt" id="adultcnt" min="0" value="0" readonly="">
																									<span class="plus bg-darkbtn adultplus"><i class="fa fa-plus"></i></span>
																								</div>   
																							</div>
																						</div>
																						
																						<div class="select">
																								<label class="btn button_select" for="item_2">Children (Ages 2-12)</label>
																								<div class="qtyButtons">
																								<div class="qty count-members mt-5">
																									<span class="minus bg-darkbtn childminus"><i class="fa fa-minus"></i></span>
																									<input type="text" class="count" name="childcnt" id="childcnt" min="0" value="0" readonly="">
																									<span class="plus bg-darkbtn childplus"><i class="fa fa-plus"></i></span>
																								</div>
																								</div>
																						</div>
																						
																						<div class="select">
																							<label class="btn button_select" for="item_3">Infants (Under 2)</label>
																							<div class="qtyButtons">
																								<div class="qty count-members mt-5">
																									<span class="minus bg-darkbtn infantminus"><i class="fa fa-minus"></i></span>
																									<input type="text" class="count" name="infantcnt" id="infantcnt" value="0" min="0" readonly="">
																									<span class="plus bg-darkbtn infantplus"><i class="fa fa-plus"></i></span>
																								</div>
																							</div>
																						</div>
																						
																					</div>
																				</div>
																			</div>
																		</div>
																	</div>
																</div>
															</div>
														</div>
													</div>
												</div>
											</div>
									
										<label class="mb-10">Step: 6 </label> <span class=""> Select Add-On Service (Optional)</span>
											<div class="participant-accordion">
												<div class="content1">
													<div class="panel-group" id="accordiontwo">
														<div class="panel panel-default">
															<div class="panel-heading">
																<h4 class="panel-title">
																	<a data-toggle="collapse" data-parent="#accordiontwo" href="#collapseTwo">Add-On Services</a>
																</h4>
															</div>
															<div id="collapseTwo" class="panel-collapse collapse">
																<div class="panel-body">
																	<div class="row">
																		<div class="col-md-12">
																			<div class="add-onservice btn-group">
																				<div class="row">
																					<div class="col-md-12 col-xs-12">
																						<div class="select">
																							<input type="checkbox" id="item_4">
																							<label class="btn button_select" for="item_4">
																								Yoga
																								<span class="single-service-price"> $ 10.00</span>
																							</label>
																							<div class="qtyButtons">
																								<div class="qty count-members mt-5">
																									<span class="minus bg-darkbtn addonminus"><i class="fa fa-minus"></i></span>
																									<input type="text" class="count" name="add-one" id="add-one" min="0" value="0" readonly="">
																									<span class="plus bg-darkbtn addonplus"><i class="fa fa-plus"></i></span>
																								</div>   
																							</div>
																						</div>
																						
																						<div class="select">
																							<input type="checkbox" id="item_5">
																							<label class="btn button_select" for="item_5">
																								Beach Volleyball
																								<span class="single-service-price"> $ 20.00</span>
																							</label>
																							<div class="qtyButtons">
																								<div class="qty count-members mt-5">
																									<span class="minus bg-darkbtn addon2minus"><i class="fa fa-minus"></i></span>
																									<input type="text" class="count" name="add-two" id="add-two" min="0" value="0" readonly="">
																									<span class="plus bg-darkbtn addon2plus"><i class="fa fa-plus"></i></span>
																								</div>
																							</div>
																						</div>
																						
																					</div>
																				</div>
																			</div>
																		</div>
																	</div>
																</div>
															</div>
														</div>
													</div>
												</div>
											</div>
							
									
									</div>
								</div>
							</div>
						</div>-->
						<div class="">
							<div class="col-md-12 col-sm-12 col-xs-12">
								<div class="text-center">
									<label>This Business Is Not Claimed</label>
									<span class="book-tool-tip" data-toggle="tooltip" data-placement="top" title="Lorem Ipsum is simply dummy text of the printing and typesetting industry.">
										<i class="fas fa-info"></i>
									</span>
								</div>
							</div>
							<div class="col-md-12 col-sm-12 col-xs-12">
								<div class="text-center mt-10">
									<div id="cartadd">
										<div id="addcartdiv">
											<button type="button" class="btn btn-red" data-toggle="modal" data-target="#requestbooking">Request To Book</button>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
									
				</div>  
			</div>
	    </div>
	</div>
</div>

<div class="modal fade" id="booking-summery" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
		<div class="row">
			<div class="col-md-10">
				<h5 class="modal-title" id="exampleModalLabel">Booking Summary</h5>
			</div>
			<div class="col-md-2">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">&times;</span>
				</button>
			</div>
		</div>
      </div>
      <div class="modal-body">
	  <div class="summery-recodes">
        <div class="row">
			<div class="col-md-5">
				<label>Category:</label>
			</div>
			<div class="col-md-7">
				<span class="float-right">Summer Camp Full Day (8:30 am to 3:00 pm)</span>
			</div>
			<div class="col-md-5">
				<label>Duration:</label>
			</div>
			<div class="col-md-7">
				<span class="float-right">9:00 AM to 10:15 AM / 1 hr 15 Min</span>
			</div>
			<div class="col-md-5">
				<label>Price Title:</label>
			</div>
			<div class="col-md-7">
				<span class="float-right">1 Day Full Camp</span>
			</div>
			<div class="col-md-5">
				<label>Price Option:</label>
			</div>
			<div class="col-md-7">
				<span class="float-right">1 session</span>
			</div>
			<div class="col-md-5">
				<label>Membership:</label>
			</div>
			<div class="col-md-7">
				<span class="float-right">Drop In </span>
			</div>
			<div class="col-md-12">
				<div class="personcategory booking-d-grid">
					<span>Adults x 1 =  <strike style="color:red"><span style="color:black"> $10</span></strike>&nbsp; $9</span>
					<span>Kids x 1 =  <strike style="color:red"><span style="color:black"> $20</span></strike>&nbsp; $18</span>
					<span>Infants x 0 =  <strike style="color:red"><span style="color:black"> $30</span></strike>&nbsp; $27</span>
				</div>
			</div>
			<div class="col-md-12">
				<div class="cartstotal mt-20 text-right"> 
					<label>Total </label> 
					<span id="totalprice">$54 USD</span> 
				</div>
			</div>
		</div>
		</div>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="requestbooking" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-sm" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<div class="row">
					<div class="col-md-10 col-xs-10 col-sm-10">
						<h5 class="modal-title">Request To Book</h5>
					</div>
					<div class="col-md-2 col-xs-2 col-sm-2">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">×</span>
						</button>
					</div>
				</div>
			</div>
			<div class="modal-body">
				<div class="step-forms">
					<!-- multistep form -->
					<form id="msform">
						<!-- progressbar -->
						<ul id="progressbar">
							<li class="active"></li>
							<li></li>
							<li></li>
							<li></li>
							<li></li>
							<li></li>
							<li></li>
							<li></li>
						</ul>
						<!-- fieldsets -->
						<fieldset>
							<div class="paddingTop-35">
								<h2 class="fs-title mb-25">Request availability</h2>		
								<div class="">
									<button class="btn btn-red">Request a date and time</button>
								</div>
							</div>
							<input type="button" name="next" class="next action-button" value="Next" />
						</fieldset>
					
						<fieldset>
							<div class="paddingTop-35">
								<h2 class="fs-title mb-25">Request A Date</h2>	
								<p class="mb-10">Select a day to check availability </p>
								<input type="text" class="form-control flatpickr" data-provider="flatpickr" data-date-format="d M, Y" data-deafult-date="today" data-inline-date="true">
							</div>
							<input type="button" name="previous" class="previous action-button" value="Back" />
							<input type="button" name="next" class="next action-button" value="Next" />
						</fieldset>
						
						<fieldset>
							<h2 class="fs-title mb-25">Do You Have Any Time Preference</h2>
							<div class="custom-check-bocx mb-25">
								<div class="custom-check-questions">
									<input type="checkbox" value="yes">
									<label >Any time</label>
								</div>
								<div class="custom-check-questions">
									<input type="checkbox" value="yes">
									<label >Early morning (before 9am)</label>
								</div>
								<div class="custom-check-questions">
									<input type="checkbox" value="yes">
									<label >Morning (9am-noon)</label>
								</div>
								<div class="custom-check-questions">
									<input type="checkbox" value="yes">
									<label >Early afternoon (noon-3pm)</label>
								</div>
								<div class="custom-check-questions">
									<input type="checkbox" value="yes">
									<label >Late afternoon (3-6pm)</label>
								</div>
								<div class="custom-check-questions">
									<input type="checkbox" value="yes">
									<label >Evening (after 6pm)</label>
								</div>
								<div class="custom-check-questions">
									<input type="checkbox" value="yes">
									<label >Other</label>
								</div>
							</div>
							
							<input type="button" name="previous" class="previous action-button" value="Previous" />
							<input type="button" name="next" class="next action-button" value="Next" />
						</fieldset>
						
						<!-- <fieldset>
							<h2 class="fs-title">Question 4</h2>
							<div class="radio-block">
								<div class="radio-content">
									<input id="radio14" type="radio" name="radio4" checked>
									<label for="radio14"><span></span> Best choice</label>
								</div><br>
								<div class="radio-content">
									<input id="radio15" type="radio" name="radio" />
									<label for="radio15"><span></span> Second choice</label>
								</div><br>
								<div class="radio-content">
									<input id="radio16" type="radio" name="radio" />
									<label for="radio16"><span></span> Third choice</label>
								</div><br>
							</div>
							<input type="button" name="previous" class="previous action-button" value="Previous" />
							<input type="button" name="next" class="next action-button" value="Next" />
						</fieldset>

						<fieldset>
							<h2 class="fs-title">Question 5</h2>
							<div class="radio-block">
								<div class="radio-content">
									<input id="radio14" type="radio" name="radio4" checked>
									<label for="radio14"><span></span> Best choice</label>
								</div><br>
								<div class="radio-content">
									<input id="radio15" type="radio" name="radio" />
									<label for="radio15"><span></span> Second choice</label>
								</div><br>
								<div class="radio-content">
									<input id="radio16" type="radio" name="radio" />
									<label for="radio16"><span></span> Third choice</label>
								</div><br>
							</div>
							<input type="button" name="previous" class="previous action-button" value="Previous" />
							<input type="button" name="next" class="next action-button" value="Next" />
						</fieldset>
					
						<fieldset>
							<h2 class="fs-title">Question 6</h2>
							<div class="radio-block">
								<div class="radio-content">
									<input id="radio17" type="radio" name="radio5" checked>
									<label for="radio17"><span></span> Best choice</label>
								</div><br>
								<div class="radio-content">
									<input id="radio18" type="radio" name="radio" />
									<label for="radio18"><span></span> Second choice</label>
								</div><br>
								<div class="radio-content">
									<input id="radio19" type="radio" name="radio" />
									<label for="radio19"><span></span> Third choice</label>
								</div><br>
								<div class="radio-content">
									<input id="radio20" type="radio" name="radio" />
									<label for="radio20"><span></span> Fourth choice</label>
								</div><br>
							</div>
							<input type="button" name="previous" class="previous action-button" value="Previous" />
							<input type="submit" name="submit" class="submit action-button" value="Submit" />
						</fieldset> -->
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
@include('layouts.footer')

<script src="/public/dashboard-design/js/flatpickr.min.js"></script>
<script>
	flatpickr(".flatpickr", {
		altInput:true,
        dateFormat: "Y-m-d",
        altFormat: "m/d/Y",
    });

</script>
<script>
//jQuery time
var current_fs, next_fs, previous_fs; //fieldsets
var left, opacity, scale; //fieldset properties which we will animate
var animating; //flag to prevent quick multi-click glitches

$(".next").click(function(){
	if(animating) return false;
	animating = true;
	
	current_fs = $(this).parent();
	next_fs = $(this).parent().next();
	
	//activate next step on progressbar using the index of next_fs
	$("#progressbar li").eq($("fieldset").index(next_fs)).addClass("active");
	
	//show the next fieldset
	next_fs.show(); 
	//hide the current fieldset with style
	current_fs.animate({opacity: 0}, {
		step: function(now, mx) {
			//as the opacity of current_fs reduces to 0 - stored in "now"
			//1. scale current_fs down to 80%
			scale = 1 - (1 - now) * 0.2;
			//2. bring next_fs from the right(50%)
			left = (now * 50)+"%";
			//3. increase opacity of next_fs to 1 as it moves in
			opacity = 1 - now;
			current_fs.css({'transform': 'scale('+scale+')'});
			next_fs.css({'left': left, 'opacity': opacity});
		}, 
		duration: 00, 
		complete: function(){
			current_fs.hide();
			animating = false;
		}, 
		//this comes from the custom easing plugin
		easing: 'easeOutQuint'
	});
});

$(".previous").click(function(){
	if(animating) return false;
	animating = true;
	
	current_fs = $(this).parent();
	previous_fs = $(this).parent().prev();
	
	//de-activate current step on progressbar
	$("#progressbar li").eq($("fieldset").index(current_fs)).removeClass("active");
	
	//show the previous fieldset
	previous_fs.show(); 
	//hide the current fieldset with style
	current_fs.animate({opacity: 0}, {
		step: function(now, mx) {
			//as the opacity of current_fs reduces to 0 - stored in "now"
			//1. scale previous_fs from 80% to 100%
			scale = 0.8 + (1 - now) * 0.2;
			//2. take current_fs to the right(50%) - from 0%
			left = ((1-now) * 50)+"%";
			//3. increase opacity of previous_fs to 1 as it moves in
			opacity = 1 - now;
			current_fs.css({'left': left});
			previous_fs.css({'transform': 'scale('+scale+')', 'opacity': opacity});
		}, 
		duration: 00, 
		complete: function(){
			current_fs.hide();
			animating = false;
		}, 
		//this comes from the custom easing plugin
		easing: 'easeOutQuint'
	});
});

$(".submit").click(function(){
	return false;
})
</script>

<script>
	$(document).ready(function(){
	  $('[data-toggle="tooltip"]').tooltip();
	});
</script>

<script>
$(document).ready(function () {
		 $('#add-two').prop('readonly', true);
		$(document).on('click','.addon2plus',function(){
			$('#add-two').val(parseInt($('#add-two').val()) + 1 );
		});
    	$(document).on('click','.adult2minus',function(){
			$('#add-two').val(parseInt($('#add-two').val()) - 1 );
			if ($('#add-two').val() <= 0) {
				$('#add-two').val(0);
			}
	    });
	
		$('#add-one').prop('readonly', true);
		$(document).on('click','.addonplus',function(){
			$('#add-one').val(parseInt($('#add-one').val()) + 1 );
		});
    	$(document).on('click','.addonminus',function(){
			$('#add-one').val(parseInt($('#add-one').val()) - 1 );
			if ($('#add-one').val() <= 0) {
				$('#add-one').val(0);
			}
	    });
	
	
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


@endsection