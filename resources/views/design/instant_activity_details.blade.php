@inject('request', 'Illuminate\Http\Request')
@extends('layouts.header')
@section('content')

<style>
	/* .flatpickr-months{
		background-color: #000;
	}
	.flatpickr-weekdays{
		background-color: #000;
	}
	span.flatpickr-weekday{
		background: #000;
	}
	.flatpickr-day.endRange, .flatpickr-day.endRange.inRange, .flatpickr-day.endRange.nextMonthDay, .flatpickr-day.endRange.prevMonthDay, .flatpickr-day.endRange:focus, .flatpickr-day.endRange:hover, .flatpickr-day.selected, .flatpickr-day.selected.inRange, .flatpickr-day.selected.nextMonthDay, .flatpickr-day.selected.prevMonthDay, .flatpickr-day.selected:focus, .flatpickr-day.selected:hover, .flatpickr-day.startRange, .flatpickr-day.startRange.inRange, .flatpickr-day.startRange.nextMonthDay, .flatpickr-day.startRange.prevMonthDay, .flatpickr-day.startRange:focus, .flatpickr-day.startRange:hover{background: #000; border-color: #000;}
	.flatpickr-day.today {
		border-color: #000;
		background-color: #46464614;
		color: #000
	} */
	.modal-open .modal {
		padding-right: 0 !important;
		padding-left: 0 !important;
	}
	.modal-dialog-centered{
		min-height: calc(100% - 0.5rem * 2);
		display: flex;
		align-items: center;
	}
	.modal-content {
		border-radius: 5px;
	}
</style>
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
											<button type="button" class="btn btn-red" data-toggle="modal" data-target="#mainModal">Request To Book</button>
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


<div class="modal fade req-time" id="mainModal" tabindex="-1" role="dialog" aria-labelledby="mainModalLabel">
	<div class="modal-dialog modal-sm modal-dialog-centered" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<div class="row">
					<div class="col-md-12 col-xs-2 col-sm-2">
						<button type="button" class="btn-close-custom" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">×</span>
						</button>
					</div>
				</div>
			</div>
			<div class="modal-body">
				<div class="row">
					<div class="col-lg-12">
						<div class="mt-80 mb-80 req-availability">
							<h2 class="fs-title mb-10">Request Availability</h2>		
							<p>Check availability for dates and times</p>
							<div class="">
								<button class="btn btn-req-red w-100" id="openNestedModal1">Request Availability</button>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="modal fade req-time" id="nestedModal1" role="dialog" aria-labelledby="nestedModal1Label">
	<div class="modal-dialog modal-sm modal-dialog-centered" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<div class="row">
					<div class="col-md-12 col-xs-12 col-sm-12">
						<button type="button" class="btn-close-custom" data-dismiss="modal" aria-label="Close">
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
						</ul>
						<!-- fieldsets -->
					
						<fieldset>
							<div class="mt-25 mb-30 fs-title-p">
								<h2 class="fs-title mb-15">Request A Date</h2>	
								<p class="mb-10">Select a day to check availability </p>
								<input type="text" placeholder="Select Date" class="form-control flatpickr" data-provider="flatpickr" data-date-format="d M, Y" data-deafult-date="today" data-inline="true">
							</div>
							
							<!-- <input type="button" name="previous" class="previous action-button-back" value="Back" /> -->
							<input type="button" name="next" class="next action-button" value="Next" />
							<!-- <div class="row y-middle">
								<div class="col-lg-6">
									<input type="button" name="previous" class="previous action-button action-button-back" value="Back" />
								</div>
								<div class="col-lg-6">
									<input type="button" name="next" class="next action-button" value="Next" />
								</div>
							</div> -->
						</fieldset>

						<fieldset>
							<div class="mt-25 mb-25">
								<h2 class="fs-title mb-25">Do You Have Any Time Preference</h2>
								<div class="req-book-x radio-buttons">
									<label class="custom-radio">
										<input type="radio" name="radio" checked>
										<span class="radio-btn">
											<div class="hobbies-icon">
											<h3 class="">Any time</h3>
											</div>
										</span>
									</label>
									<label class="custom-radio">
										<input type="radio" name="radio" >
										<span class="radio-btn">
											<div class="hobbies-icon">
											<h3 class="">Early morning (before 9am)</h3>
											</div>
										</span>
									</label>
									<label class="custom-radio">
										<input type="radio" name="radio" >
										<span class="radio-btn">
											<div class="hobbies-icon">
											<h3 class="">Morning (9am-noon)</h3>
											</div>
										</span>
									</label>
									<label class="custom-radio">
										<input type="radio" name="radio" >
										<span class="radio-btn">
											<div class="hobbies-icon">
											<h3 class="">Early afternoon (noon-3pm)</h3>
											</div>
										</span>
									</label>
									<label class="custom-radio">
										<input type="radio" name="radio" >
										<span class="radio-btn">
											<div class="hobbies-icon">
											<h3 class="">Late afternoon (3-6pm)</h3>
											</div>
										</span>
									</label>
									<label class="custom-radio">
										<input type="radio" name="radio" >
										<span class="radio-btn">
											<div class="hobbies-icon">
											<h3 class="">Evening (after 6pm)</h3>
											</div>
										</span>
									</label>
									<label class="custom-radio">
										<input type="radio" name="radio" >
										<span class="radio-btn">
											<div class="hobbies-icon">
											<h3 class="">Other</h3>
											</div>
										</span>
									</label>									
								</div>
							</div>
							
							<input type="button" name="previous" class="previous action-button-back" value="Back" />
							<input type="button" name="next" class="next action-button" value="Next" />
						</fieldset>
						
						<fieldset>
							<div class="mt-25 mb-25">
								<h2 class="fs-title mb-25">How soon would you like to start?</h2>
								<div class="req-book-x radio-buttons">
									<label class="custom-radio">
										<input type="radio" name="radio" checked>
										<span class="radio-btn">
											<div class="hobbies-icon">
											<h3 class="">As soon as possible</h3>
											</div>
										</span>
									</label>
									<label class="custom-radio">
										<input type="radio" name="radio" >
										<span class="radio-btn">
											<div class="hobbies-icon">
											<h3 class="">Within a few weeks</h3>
											</div>
										</span>
									</label>
									<label class="custom-radio">
										<input type="radio" name="radio" >
										<span class="radio-btn">
											<div class="hobbies-icon">
											<h3 class="">Within a month</h3>
											</div>
										</span>
									</label>
									<label class="custom-radio">
										<input type="radio" name="radio" >
										<span class="radio-btn">
											<div class="hobbies-icon">
											<h3 class="">Other</h3>
											</div>
										</span>
									</label>
								</div>
							</div>
							<input type="button" name="previous" class="previous action-button-back" value="Back" />
							<input type="button" name="next" class="next action-button" value="Next" />
						</fieldset>
					
						<fieldset>
							<div class="mt-25 mb-25 fs-title-p"> 
								<h2 class="fs-title mb-10">Select number of participants</h2>
								<p class="mb-25">Select how many people will be booking. Up to 10 guests can be added.</p>
								<div class="row y-middle mb-15">
									<div class="col-lg-5 col-5">
										<div class="text-left">
											<label>Adults</label>
										</div>
									</div>
									<div class="col-lg-7 col-7">
										<div class="participant-add">
											<div class="qtyButtons">
												<div class="qty count-members mt-5">
													<span class="minus bg-darkbtn adultminusone"><i class="fa fa-minus"></i></span>
													<input type="text" class="count" name="adultcntone" id="adultcntone" min="0" value="0" readonly="">
													<span class="plus bg-darkbtn adultplusone"><i class="fa fa-plus"></i></span>
												</div>
											</div>
										</div>
									</div>
								</div>

								<div class="row y-middle mb-15">
									<div class="col-lg-5 col-5">
										<div class="text-left">
											<label>Children</label>
										</div>
									</div>
									<div class="col-lg-7 col-7">
										<div class="participant-add">
											<div class="qtyButtons">
												<div class="qty count-members mt-5">
													<span class="minus bg-darkbtn childminusone"><i class="fa fa-minus"></i></span>
													<input type="text" class="count" name="childcntone" id="childcntone" min="0" value="0" readonly="">
													<span class="plus bg-darkbtn childplusone"><i class="fa fa-plus"></i></span>
												</div>
											</div>
										</div>
									</div>
									<div class="col-lg-12">
										<div class="form-group mt-10">
											<select class="form-select" name="businessType" required="">
												<option value="individual">Child Age</option>
												<option value="business">1</option>
												<option value="business">2</option>
												<option value="business">3</option>
												<option value="business">4</option>
												<option value="business">5</option>
												<option value="business">6</option>
												<option value="business">7</option>
												<option value="business">8</option>
												<option value="business">9</option>
												<option value="business">10</option>
											</select>
										</div>
									</div>
								</div>

								<div class="row y-middle mb-15">
									<div class="col-lg-5 col-5">
										<div class="text-left">
											<label>Infants</label>
											<p>Under 2</p>
										</div>
									</div>
									<div class="col-lg-7 col-7">
										<div class="participant-add">
											<div class="qtyButtons">
												<div class="qty count-members mt-5">
													<span class="minus bg-darkbtn infantsminusone"><i class="fa fa-minus"></i></span>
													<input type="text" class="count" name="infantscntone" id="infantscntone" min="0" value="0" readonly="">
													<span class="plus bg-darkbtn infantsplusone"><i class="fa fa-plus"></i></span>
												</div>
											</div>
										</div>
									</div>
									<div class="col-lg-12">
										<div class="form-group mt-10">
											<select class="form-select" name="businessType" required="">
												<option value="individual">Infants Age</option>
												<option value="business">1</option>
												<option value="business">2</option>
												<option value="business">3</option>
												<option value="business">4</option>
												<option value="business">5</option>
												<option value="business">6</option>
												<option value="business">7</option>
												<option value="business">8</option>
												<option value="business">9</option>
												<option value="business">10</option>
											</select>
										</div>
									</div>
								</div>
							</div>
							<input type="button" name="previous" class="previous action-button-back" value="Back" />
							<input type="button" name="next" class="next action-button" value="Next" />
						</fieldset>

						<fieldset>
							<div class="mt-25 mb-25">
								<h2 class="fs-title mb-25">What is your gender?</h2>
								<div class="radio-block">
									<div class="radio-content">
										<input id="radio17" type="radio" name="radio" checked>
										<label for="radio17"><span></span>Female</label>
									</div>
									<div class="radio-content">
										<input id="radio18" type="radio" name="radio" />
										<label for="radio18"><span></span>Male</label>
									</div>
									<div class="radio-content">
										<input id="radio19" type="radio" name="radio" />
										<label for="radio19"><span></span>Other (e.g. couple, group)</label>
									</div>
								</div>
							</div>
							<input type="button" name="previous" class="previous action-button-back" value="Back" />
							<input type="button" name="next" class="next action-button" value="Next" />
						</fieldset>
						
						<fieldset>
							<div class="mt-25 mb-25 fs-title-p">
								<h2 class="fs-title mb-10">Registration </h2>
								<p class="mb-15">Please complete in order to make sure you are 18+</p>
								<div>
									<div class="mb-15 book0req-register">
										<label for="firstnameInput" class="form-label">Name</label>
										<input type="text" class="form-control" name="name" id="name" value="" required="">
									</div>
									<div class="mb-15 book0req-register">
										<label for="location" class="form-label">Location</label>
										<input type="text" class="form-control" name="location" id="location" value="" required="">
									</div>
									<div class="mb-15 book0req-register">
										<label for="Zip" class="form-label"> Zip</label>
										<input type="text" class="form-control" name="Zip" id="Zip" value="" required="">
									</div>
									<div class="mb-15 book0req-register">
										<label for="state" class="form-label"> State</label>
										<input type="text" class="form-control" name="state" id="state" value="" required="">
									</div>
									<div class="mb-15 book0req-register">
										<label for="country" class="form-label"> Country</label>
										<input type="text" class="form-control" name="country" id="country" value="" required="">
									</div>
								</div>
							</div>
							
							<input type="button" name="previous" class="previous action-button-back" value="Back" />
							<input type="button" name="next" class="next action-button" value="Next" />
						</fieldset>
						
						<fieldset>
							<div class="mt-25 mb-25">
								<h2 class="fs-title mb-25">Request Booking Summary</h2>
								<div class="border-bottom-grey mb-10">
									<div class="row">
										<div class="col-lg-5">
											<div class="text-left req-book-summary">
												<label>Customer</label>
											</div>
										</div>
										<div class="col-lg-7">
											<div class="text-right req-book-summary">
												<span>Ankita</span>
											</div>
											
										</div>
									</div>
								</div>
								<div class="border-bottom-grey mb-10">
									<div class="row">
										<div class="col-lg-5">
											<div class="text-left req-book-summary">
												<label>Location</label>
											</div>
										</div>
										<div class="col-lg-7">
											<div class="text-right req-book-summary">
												<span>USA</span>
											</div>
											
										</div>
									</div>
								</div>
								<div class="border-bottom-grey mb-10">
									<div class="row">
										<div class="col-lg-5">
											<div class="text-left req-book-summary">
												<label>Date </label>
											</div>
										</div>
										<div class="col-lg-7">
											<div class="text-right req-book-summary">
												<span>21-10-2024</span>
											</div>
											
										</div>
									</div>
								</div>
								<div class="border-bottom-grey mb-10">
									<div class="row">
										<div class="col-lg-5">
											<div class="text-left req-book-summary">
												<label>Time  </label>
											</div>
										</div>
										<div class="col-lg-7">
											<div class="text-right req-book-summary">
												<span>Morning (9am-noon)</span>
											</div>
											
										</div>
									</div>
								</div>
								<div class="border-bottom-grey mb-10">
									<div class="row">
										<div class="col-lg-5">
											<div class="text-left req-book-summary">
												<label>Number of Guests </label>
											</div>
										</div>
										<div class="col-lg-7">
											<div class="text-right req-book-summary">
												<span>3</span>
											</div>
											
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-lg-12">
										<div class="mb-3 text-left d-grid">
											<label for="firstnameInput" class="form-label">Write a message to </label>
											<p class="mb-10">Please make a note of any medical issues or personal injuries.</p>
											<textarea class="form-control about_user" id="about_user" name="about_user" placeholder="Enter your description" rows="3" maxlength="1000"></textarea>
										</div>
									</div>
								</div>
							</div>
							
							<input type="button" name="previous" class="previous action-button-back" value="Back" />
							<button type="button" name="submit" class="submit btn action-button" id="openNestedModal2">Submit</button>
							<!-- <input type="submit" name="submit" class="submit action-button" value="Submit" /> -->
						</fieldset>

					</form>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="modal fade req-time" id="nestedModal2" tabindex="-1" role="dialog" aria-labelledby="nestedModal2Label">
	<div class="modal-dialog modal-sm modal-dialog-centered" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<div class="row">
					<div class="col-md-12 col-xs-12 col-sm-12">
						<button type="button" class="btn-close-custom" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">×</span>
						</button>
					</div>
				</div>
			</div>
			<div class="modal-body">
				<div class="mt-25 mb-25">
					<div class="text-center mb-40 mt-30 request-sucess">
						<h3> Request was sent successfully</h3>
					</div>
				</div>
			</div>
		</div>
	</div> 
</div>

@include('layouts.footer')
<script src="/public/dashboard-design/js/flatpickr.min.js"></script>
<script>
    $(document).ready(function() {
        // Open Nested Modal 1
        $('#openNestedModal1').click(function() {
            $('#mainModal').modal('hide'); // Hide the main modal
            $('#nestedModal1').modal('show'); // Show nested modal 1
        });

        // Open Nested Modal 2
        $('#openNestedModal2').click(function() {
            $('#nestedModal1').modal('hide'); // Hide nested modal 1
            $('#nestedModal2').modal('show'); // Show nested modal 2
        });

        // Close both modals from Nested Modal 1
        $('#closeBothModals1').click(function() {
            $('#nestedModal1').modal('hide'); // Hide nested modal 1
            $('#mainModal').modal('hide'); // Hide main modal
        });

        // Close both modals from Nested Modal 2
        $('#closeBothModals2').click(function() {
            $('#nestedModal2').modal('hide'); // Hide nested modal 2
            $('#mainModal').modal('hide'); // Hide main modal
        });
    });
</script>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const flatpickrInput = document.querySelector('.flatpickr');
    flatpickrInput.style.display = 'none';

    flatpickr(flatpickrInput, {
        inline: true,
        defaultDate: "today",
        dateFormat: "d M, Y"
    });
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

<script>
	$('#adultcntone').prop('readonly', true);
		$(document).on('click','.adultplusone',function(){
		    $('#adultcntone').val(parseInt($('#adultcntone').val()) + 1 );
		    $('#adultCountone').val(parseInt($('#adultcntone').val()));
		    $('#totalcntone').val(parseInt($('#totalcntone').val() + 1));
		    calculateTotal();
				participateCnt('adult');
			});

    	$(document).on('click','.adultminusone',function(){
			$('#adultcntone').val(parseInt($('#adultcntone').val()) - 1 );
			if ($('#adultcntone').val() <= 0) {
				$('#adultcntone').val(0);
			}
			$('#totalcntone').val(parseInt($('#totalcntone').val() - 1));
			if ($('#totalcntone').val() <= 0) {
				$('#totalcntone').val(0);
			}
			$('#adultCountone').val(parseInt($('#adultcntone').val()));
			calculateTotal();
				removeParticipateCnt('adult');
			});

	$('#childcntone').prop('readonly', true);
		$(document).on('click','.childplusone',function(){
			$('#childcntone').val(parseInt($('#childcntone').val()) + 1 );
			$('#totalcntone').val(parseInt($('#totalcntone').val() + 1));
			$('#childCountone').val(parseInt($('#childcntone').val()));
			calculateTotal();
				participateCnt('child');
			});
    	$(document).on('click','.childminusone',function(){
			$('#childcntone').val(parseInt($('#childcntone').val()) - 1 );
			$('#totalcntone').val(parseInt($('#totalcntone').val() - 1));
			if ($('#childcntone').val() <= 0) {
				$('#childcntone').val(0);
			}
			if ($('#totalcntone').val() <= 0) {
				$('#totalcntone').val(0);
			}
			$('#childCountone').val(parseInt($('#childcntone').val()));
			calculateTotal();
				removeParticipateCnt('child');
			}); 

	$('#infantscntone').prop('readonly', true);
		$(document).on('click','.infantsplusone',function(){
			$('#infantscntone').val(parseInt($('#infantscntone').val()) + 1 );
			$('#totalcntone').val(parseInt($('#totalcntone').val() + 1));
			$('#childCountone').val(parseInt($('#infantscntone').val()));
			calculateTotal();
				participateCnt('infants');
			});
    	$(document).on('click','.infantsminusone',function(){
			$('#infantscntone').val(parseInt($('#infantscntone').val()) - 1 );
			$('#totalcntone').val(parseInt($('#totalcntone').val() - 1));
			if ($('#infantscntone').val() <= 0) {
				$('#infantscntone').val(0);
			}
			if ($('#totalcntone').val() <= 0) {
				$('#totalcntone').val(0);
			}
			$('#infantsCountone').val(parseInt($('#infantscntone').val()));
			calculateTotal();
				removeParticipateCnt('infants');
			}); 
</script>

@endsection