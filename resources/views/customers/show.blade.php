@extends('layouts.header')
@section('content')
@include('layouts.userHeader')

@php 
	use Carbon\Carbon;
	use App\BusinessStaff;
@endphp


<div class="p-0 col-md-12 inner_top padding-0">
    <div class="row">
        <div class="col-md-2 col-sm-12" style="background: black;">
        	@include('business.businessSidebar')
        </div>
        <div class="col-md-10 col-sm-12">
			<div class="container-fluid p-0">
				<div class="row">
					<div class="col-md-6 col-xs-6">
						<div class="tab-hed ">Manage Customers</div>
					</div>
					<!-- <div class="col-md-6 col-xs-6">
						<div class="row">
							<div class="col-md-4">
								<button type="button" class="btn-nxt manage-cus-btn">Add New Client</button>
							</div>
							<div class="col-md-5">
								<div class="manage-search">
									<form method="get" action="/activities/">
										<input type="text" name="label" id="" placeholder="Search for client" autocomplete="off" value="">
										<button id="serchbtn"><i class="fa fa-search"></i></button>
									</form>
								</div>
							</div>
							<div class="col-md-3">
								<button type="button" class="btn-nxt search-btn-sp">Search</button>
							</div>
						</div>
					</div> -->
				</div>
                <!--<div class="tab-hed">Manage Customers</div>-->
                <hr style="border: 3px solid black; width: 115%; margin-left: -38px; margin-top: 5px;">
            </div>
            @if($strpecarderror != '')
				<div id="sessionerr" class="red-fonts">{{$strpecarderror}}</div>
			@endif
					
			<div class="row">
				<div class="col-md-12">
					<div class="manage-cust-box">
						<div class="row">
							<div class="col-md-2 col-sm-3">
								<div class="manage-cust-img">
									@if($customerdata->profile_pic)
										<img src="{{Storage::Url($customerdata->profile_pic)}}" class="imgboxes" alt="">
									@else
										<div class="company-list-text"><p>{{$customerdata->fname[0]}}</p></div>
									@endif
                                </div>
							</div>
							<div class="col-md-5 col-sm-5 col-xs-12">
								<div class="client-info">
                                    <span>{{$customerdata->fname}} {{$customerdata->lname}}</span>
									<a data-toggle="modal" data-target="#editbooking"> Edit </a>
                                </div>
								<div class="row">
									<div class="col-md-5 col-xs-5">
										<label>Email</label>
									</div>
									<div class="col-md-7 col-xs-7">
										<span>{{$customerdata->email}} </span>
									</div>
								</div>
								<div class="row">
									<div class="col-md-5 col-xs-5">
										<label>Phone Number</label>
									</div>
									<div class="col-md-7 col-xs-7">
										<span>{{$customerdata->phone_number}} </span>
									</div>
								</div>
								<div class="row">
									<div class="col-md-5 col-xs-5">
										<label>Address</label>
									</div>
									<div class="col-md-7 col-xs-7">
										<span>{{$customerdata->full_address()}}</span>
									</div>
								</div>
								<div class="row">
									<div class="col-md-5 col-xs-5">
										<label>Last Visited</label>
									</div>
									<div class="col-md-7 col-xs-7">
										<span>{{$customerdata->get_last_seen()}}</span>
									</div>
								</div>
							</div>
							<div class="col-md-5 col-sm-4 col-xs-12 side-border">
								<div class="client-info-parts">
									<div class="row">
										<div class="col-md-5 col-xs-5">
											<label>Birthday</label>
										</div>
										<div class="col-md-7 col-xs-7">
											<span>{{date('m/d/Y',strtotime($customerdata->birthdate))}}</span>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-5 col-xs-5">
										<label>Age</label>
									</div>
									<div class="col-md-7 col-xs-7">
										<span>@if($customerdata->age) {{$customerdata->age}} Years Old @else -  @endif</span>
									</div>
								</div>
								<div class="row">
									<div class="col-md-5 col-xs-5">
										<label>Gender</label>
									</div>
									<div class="col-md-7 col-xs-7">
										<span>@if($customerdata->gender != null || $customerdata->gender != '') {{$customerdata->gender}} @else —   @endif</span>
									</div>
								</div>
								<div class="row">
									<div class="col-md-5 col-xs-5">
										<label>Location</label>
									</div>
									<div class="col-md-7 col-xs-7">
										<span>{{$customerdata->country}}</span>
									</div>
								</div>
								<div class="row">
									<div class="col-md-5 col-xs-5">
										<label>Customers Since</label>
									</div>
									<div class="col-md-7 col-xs-7">
										<span>{{date('m/d/Y',strtotime($customerdata->created_at))}}</span>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>	
			</div>
			<div class="row">
				<div class="col-md-12 col-xs-12 mobile-custom">
					<div class="view-customer">
						<ul class="nav nav-tabs" id="CustTab" role="tablist">
						  <li class="nav-item active">
							<a class="nav-link" id="customer-info-tab" data-toggle="tab" href="#customer-info" role="tab" aria-controls="customer-info" aria-selected="true">Customer Info</a>
						  </li>
						  <li class="nav-item">
							<a class="nav-link" id="visits-tab" data-toggle="tab" href="#visits" role="tab" aria-controls="visits" aria-selected="false">Visits</a>
						  </li>
						  <li class="nav-item">
							<a class="nav-link" id="account-details-tab" data-toggle="tab" href="#account-details" role="tab" aria-controls="account-details" aria-selected="false">Account Details</a>
						  </li>
						</ul>
					</div>
					<div  id="errordiv" class="activity-msg"></div>
					<div class="tab-custom tab-content" id="myTabContent">
						<div class="tab-pane fade active" id="customer-info" role="tabpanel" aria-labelledby="customer-info-tab">
							<div class="row">
								<div class="col-md-6 col-xs-12">
									<div class="manage-cust-box">
										<div class="row">
											<div class="col-md-12 col-xs-12">
												<label class="tab-titles">Quick Stats</label>
											</div>
											<div class="col-md-6 col-xs-6">
												<label>Status</label>
											</div>
											<div class="col-md-6 col-xs-6">
												@if($customerdata->is_active() == 0)
													InActive
												@else
													<span class="green-fonts">Active</span>
												@endif
											</div>
										</div>
										<div class="row">
											<div class="col-md-6 col-xs-6">
												<label>Activities Booked</label>
											</div>
											<div class="col-md-6 col-xs-6">
												<span>{{$customerdata->memberships()}}</span>
											</div>
										</div>
										<div class="row">
											<div class="col-md-6 col-xs-6">
												<label>Money Spent</label>
											</div>
											<div class="col-md-6 col-xs-6">
												<span>$ {{$customerdata->total_spend()}}</span>
											</div>
										</div>
										<div class="row">
											<div class="col-md-6 col-xs-6">
												<label>Number of Visits</label>
											</div>
											<div class="col-md-6 col-xs-6">
												<span>{{$customerdata->visits_count()}}</span>
											</div>
										</div>
										<div class="row">
											<div class="col-md-6 col-xs-6">
												<label>Active Memberships</label>
											</div>
											<div class="col-md-6 col-xs-6">
												<span class="green-fonts">{{$customerdata->active_memberships()}}</span>
											</div>
										</div>
										<div class="row">
											<div class="col-md-6 col-xs-6">
												<label>Expiring Memberships</label>
											</div>
											<div class="col-md-6 col-xs-6">
												<span>{{$customerdata->expired_soon()}}</span>
											</div>
										</div>
									</div>

									<div class="manage-cust-box">
										<div class="row">
											<div class="col-md-12 col-xs-12">
												<div class="customer-info">
													<label class="tab-titles">Billing Information</label>
													<a href="#" data-behavior="ajax_html_modal" data-url="{{route('business.customers.card_editing_form', ['customer_id' => $customerdata->id, 'return_url' => url()->full()])}}">Add</a>
												</div>
											</div>
										</div>

										@foreach($customerdata->stripePaymentMethods()->get() as $card)
											<div class="row">
												<div class="col-md-12 col-xs-12">
													<span>
														{{$card->brand}} **** **** **** {{$card->last4}}
														<a style="float:right" data-behavior="delete_card" data-url="{{route('stripe_payment_methods.destroy', ['stripe_payment_method' => $card->payment_id])}}" data-cardid="<?=$card['id']?>" title="Delete Card" class="delCard"><i class="fa fa-trash"></i> Remove</a>
													</span>
												</div>
											</div>
										@endforeach
									</div>
									
									<div class="manage-cust-box">
										<form action="{{route('business.customers.update', ['customer' => $customerdata->id])}}" method="POST">
											@csrf
											@method('PUT')
											<div class="row">
												<div class="col-md-12 col-xs-12">
													<label class="tab-titles">Notes</label>
												</div>
											</div>
											<div class="row">
												<div class="col-md-12 col-xs-12">
													<textarea name="notes" rows="4" style="width: 100%;">{{$customerdata->notes}} </textarea>
												</div>
											</div>
											<div class="row">
												<div class="col-md-12 col-xs-12">
													<button type="submit" class="btn-nxt" >Submit</button>
												</div>
											</div>
											
										</form>
									</div>
								
								</div>
								<div class="col-md-6 col-xs-12">
									<div class="manage-cust-box box-height">
										<div class="row">
											<div class="col-md-12 col-xs-12">
												<div class="customer-info">
													<label class="tab-titles">Family Members Added</label>
													<a href="/addcustomerfamily/{{$customerdata->id}}">Add</a>
												</div>
											</div>
										</div>
										@if(empty($customerdata->get_families()))
											<div class="row">
												<div class="col-md-12 col-xs-12">
													<div class="customer-info">
														<p>Family Member Details are not available.</p>
													</div>
												</div>
											</div>
										@else
											@foreach($customerdata->get_families() as $index=>$family_member)
												<div class="row">
													<div class="col-md-4 col-xs-12">
														<span>{{$index+1}}.</span>
														<label>Name:</label>
														<span>{{$family_member->fname}} {{$family_member->lname}} </span>
													</div>
													<div class="col-md-4 col-xs-12">
														<label>Relationship: </label>
														<span>{{$family_member->relationship}}</span>
													</div>
													<div class="col-md-2 col-xs-12">
														<label>Age</label>
														<span>({{$family_member->age}})</span>
													</div>
													<div class="col-md-1 col-xs-12">
														<a href="{{route('business_customer_show',['business_id' => request()->business_id, 'id'=>$family_member->id])}}">View</a>
													</div>
												</div>
											@endforeach
										@endif
									</div>
									
									<div class="manage-cust-box second-box-height">
										<div class="row">
											<div class="col-md-12 col-xs-12">
												<div class="customer-info">
													<label class="tab-titles">Agreed Terms of Service</label>
													<a data-toggle="modal" data-target="#edittermsofservice">Edit</a>
												</div>
											</div>
										</div>
										<div class="row">
											<div class="col-md-12 col-xs-12">
												<span>1.</span>
												<span>Covid-19 Protocols agreed on  @if(@$customerdata->terms_covid != '') {{date('m/d/Y',strtotime(@$customerdata->terms_covid))}} @endif </span>
											</div>
											<div class="col-md-12 col-xs-12">
												<span> 2. </span>
												<span>Liability Waiver agreed on @if(@$customerdata->terms_liability != '') {{date('m/d/Y',strtotime(@$customerdata->terms_liability))}} @endif </span>
											</div>
											<div class="col-md-12 col-xs-12">
												<span>3. </span>
												<span>Contract Terms  agreed on @if(@$customerdata->terms_contract != '') {{date('m/d/Y',strtotime(@$customerdata->terms_contract))}} @endif</span>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="tab-pane fade" id="visits" role="tabpanel" aria-labelledby="visits-tab">
							<div class="row">
								<div class="col-md-12 col-xs-12">
									<div class="row">
										<div class="col-md-12 col-xs-12">
											<div class="visit-table-data">
												<label>Total Number of Visits:</label>
												<span>{{$customerdata->visits_count()}}</span>
											</div>
										</div>
									</div>
									<div class="manage-cust-box">
										<div class="table-responsive">
											<table id="visitstable" class="table table-striped table-bordered" style="width:100%">
												<thead>
													<tr>
														<th>Date</th>
														<th>Time</th>
														<th>Program Name </th>
														<th>Program Title </th>
														<th>Status</th>
														<th>Instructor</th>
													</tr>
												</thead>
												<tbody>
													@foreach($visits as $visit)
														<tr>
															<td>{{date('m/d/Y',strtotime($visit->checkin_date))}}</td>
															<td>
																{{date('h:i A', strtotime($visit->checked_at))}}
															</td>
															<td>{{$visit->order_detail->business_services->program_name}}</td>
															<td>{{$visit->order_detail->business_price_detail->price_title}}</td>
															
															<td>
																@if($visit->status_term())
																	{{$visit->status_term()}}
																@else
																	<a target="_blank" href="{{route('business.schedulers.checkin_details.index',['scheduler'=>$visit->business_activity_scheduler_id, 'date' =>$visit->checkin_date])}}">Unprocess</a>
																@endif
																
															</td>
															<td>{{BusinessStaff::getinstructorname($visit->order_detail->business_services->instructor_id)}}</td>
														</tr>
													@endforeach
												</tbody>
											</table>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="tab-pane fade" id="account-details" role="tabpanel" aria-labelledby="account-details-tab">
							<div class="inner-pill-tabs">
								<ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
									<li class="nav-item active">
										<a class="nav-link" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab" aria-controls="pills-home" aria-selected="true">Activities Booked <label>|</label> </a>
										
									</li>
									<li class="nav-item">
										<a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#pills-profile" role="tab" aria-controls="pills-profile" aria-selected="false">Purchase History </a>
									</li>
								</ul>
							</div>
							<div class="tab-content" id="pills-tabContent">
								<div class="tab-pane fade active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
									<div class="panel-group" id="accordion">
										<div class="row">
											<div class="col-md-6 col-sm-6 col-xs-12">
												<div class="panel panel-default panel-space">
													<div class="inner-arrow panel-heading">
														<h4 class="panel-title">
															<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapseOne">
															Active Bookings ({{$active_booking_details->count()}})   
															</a>
														</h4>
													</div>
													<div id="collapseOne" class="panel-collapse collapse in">
														<div class="panel-body">
															@foreach ($active_booking_details as $booking_detail)
																<div class="row customer-custom-sparetor">
																	<div class="col-md-12 col-xs-12">
																		<div class="inner-accordion-titles">
																			<label> {{$booking_detail->business_services->program_name}}</label>															<span>Remaining {{$booking_detail->getremainingsession()}}/{{$booking_detail->pay_session}}</span> <div class="mailRecipt" data-behaiver="mail_receipt" data-booking-detail-id="{{$booking_detail->id}}"data-booking-id ="{{$booking_detail->booking_id}}" data-item-type="no" ><i class="far fa-file-alt"></i></div>
																			
																		</div>
																		<div class="customer-profile-info">
																			<div class="row">
																				<div class="col-md-6 col-xs-6">
																					<label>BOOKING # </label>
																				</div>
																				<div class="col-md-6 col-xs-6">
																					<span> {{$booking_detail->booking->order_id}} </span>
																				</div>
																			
																				<div class="col-md-6 col-xs-6">
																					<label>TOTAL PRICE </label>
																				</div>
																				<div class="col-md-6 col-xs-6">
																					<span>  ${{$booking_detail->booking->amount}} </span>
																				</div>
																				
																				<div class="col-md-6 col-xs-6">
																					<label>PAYMENT TYPE:</label>
																				</div>
																				<div class="col-md-6 col-xs-6">
																					<span></span>
																				</div>
																			
																				<div class="col-md-6 col-xs-6">
																					<label>TOTAL REMAINING:</label>
																				</div>
																				<div class="col-md-6 col-xs-6">
																					<span>
																						{{$booking_detail->getremainingsession()}}/{{$booking_detail->pay_session}}
																					</span>
																				</div>
																				
																				<div class="col-md-6 col-xs-6">
																					<label>PROGRAM NAME:</label>
																				</div>
																				<div class="col-md-6 col-xs-6">
																					<span>{{$booking_detail->business_services->program_name}} </span>
																				</div>
																				
																				<div class="col-md-6 col-xs-6">
																					<label>EXPIRATION DATE:	</label>
																				</div>

																				<div class="col-md-6 col-xs-6">
																					<span> {{date('m/d/Y',strtotime($booking_detail->expired_at))}}</span>
																				</div>
																				
																				<div class="col-md-6 col-xs-6">
																					<label>DATE BOOKED:	</label>
																				</div>
																				<div class="col-md-6 col-xs-6">
																					<span>{{date('m/d/Y',strtotime($booking_detail->created_at))}}</span>
																				</div>
																				
																				<div class="col-md-6 col-xs-6">
																					<label>BOOKING TIME: </label>
																				</div>
																				<div class="col-md-6 col-xs-6">
																					<span> {{date('h:i A', strtotime($booking_detail->business_services->shift_start))}}</span>
																				</div>
																				@if ($booking_detail->booking->user)
																					<div class="col-md-6 col-xs-6">
																						<label>BOOKED BY:</label>
																					</div>
																					<div class="col-md-6 col-xs-6">
																						<span>{{$booking_detail->booking->user->firstname}} {{$booking_detail->booking->user->lastname}} (Online Marketplace)</span>
																					</div>
																				@endif
																				@if ($booking_detail->booking->customer)
																					<div class="col-md-6 col-xs-6">
																						<label>BOOKED BY:</label>
																					</div>
																					<div class="col-md-6 col-xs-6">
																						<span>{{$booking_detail->booking->customer->fname}} {{$booking_detail->booking->customer->lname}} (In person)</span>
																					</div>
																				@endif
																				
																				
																				<div class="col-md-6 col-xs-6">
																					<label>ACTIVITY TYPE:</label>
																				</div>
																				<div class="col-md-6 col-xs-6">
																					<span>{{$booking_detail->business_services->sport_activity}}</span>
																				</div>
																				
																				<div class="col-md-6 col-xs-6">
																					<label>SERVICE TYPE:</label>
																				</div>
																				<div class="col-md-6 col-xs-6">
																					<span>{{$booking_detail->business_services->formal_service_types()}}</span>
																				</div>
																			</div>
																		</div>
																		<div class="row">
																			<div class="col-md-4 col-xs-4">
																				<div class="links-space">
																				<a class="visiting-view" data-behavior="ajax_html_modal" data-url="{{route('visit_modal', ['business_id' => request()->business_id, 'id' => $customerdata->id, 'booking_detail_id' => $booking_detail->id])}}"> View Visits </a>
																				</div>
																			</div>
																			<div class="col-md-4 col-xs-4 text-center">
																				<a class="edit-booking-customer" data-behavior="ajax_html_modal" data-url="{{route('business.visit_membership_modal', ['business_id' => request()->business_id, 'id' => $customerdata->id,'booking_detail_id' => $booking_detail->id , 'booking_id' => $booking_detail->booking_id])}}" data-modal-width="90%"> Edit Booking </a>
																				<!-- <a class="edit-booking-customer" data-toggle="modal" data-target="#bookingcustomer_{{$booking_detail->id}}"> Edit Booking </a> -->
																			</div>
																			<div class="col-md-4 col-xs-4">
																				<a class="edit-booking-customer" data-behavior="ajax_html_modal" data-url="{{route('business.recurring.index', ['business_id' => request()->business_id, 'customer_id' => $customerdata->id, 'booking_detail_id' => $booking_detail->id])}}" data-modal-width="1050px"> Auto Pay Details </a>
																				<!-- <a class="auto-pay" data-toggle="modal" data-target="#auto-pay"> Auto Pay Details </a> -->
																			</div>
																		</div>
																	</div>
																</div>
															@endforeach
														</div>
													</div>
												</div>
											</div>
											<div class="col-md-6 col-sm-6 col-xs-12">
												<div class="panel panel-default panel-space">
													<div class="inner-arrow panel-heading">
														<h4 class="panel-title">
															<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo">
															Completed  Bookings ({{$complete_booking_details->count()}})
															</a>
														</h4>
													</div>
													<div id="collapseTwo" class="panel-collapse collapse">
														<div class="panel-body">
															@foreach ($complete_booking_details as $booking_detail)
																<?php
																	if (!$booking_detail->booking){
																		continue;
																	}
																?>	
																<div class="row">
																	<div class="col-md-12 col-xs-12">
																		<div class="inner-accordion-titles">
																			@if ($booking_detail->business_services)
																				<label> {{$booking_detail->business_services->program_name}}</label>	
																			@endif
																			
																		</div>
																		<div class="customer-profile-info">
																			<div class="row">
																				<div class="col-md-6 col-xs-6">
																					<label>BOOKING # </label>
																				</div>
																				<div class="col-md-6 col-xs-6">
																					<span> {{$booking_detail->booking->order_id}} </span>
																				</div>
																			
																				<div class="col-md-6 col-xs-6">
																					<label>TOTAL PRICE </label>
																				</div>
																				<div class="col-md-6 col-xs-6">
																					<span>  ${{$booking_detail->booking->amount}} </span>
																				</div>
																				
																				<div class="col-md-6 col-xs-6">
																					<label>PAYMENT TYPE:</label>
																				</div>
																				<div class="col-md-6 col-xs-6">
																					<span> </span>
																				</div>

																				@if ($booking_detail->business_price_detail)
																					<div class="col-md-6 col-xs-6">
																						<label>TOTAL REMAINING:</label>
																					</div>
																					<div class="col-md-6 col-xs-6">
																						<span>{{$booking_detail->getremainingsession()}}/{{$booking_detail->pay_session}}</span>

																					</div>
																				@endif
																				
																				<div class="col-md-6 col-xs-6">
																					<label>PROGRAM NAME:</label>
																				</div>
																				<div class="col-md-6 col-xs-6">
																					@if ($booking_detail->business_services)
																					<span>{{$booking_detail->business_services->program_name}} </span>
																					}
																					@endif
																				</div>
																				
																				<div class="col-md-6 col-xs-6">
																					<label>EXPIRATION DATE:	</label>
																				</div>

																				<div class="col-md-6 col-xs-6">
																					<span> {{date('m/d/Y',strtotime($booking_detail->expired_at))}}</span>
																				</div>
																				
																				<div class="col-md-6 col-xs-6">
																					<label>DATE BOOKED:	</label>
																				</div>
																				<div class="col-md-6 col-xs-6">
																					<span>{{date('m/d/Y',strtotime($booking_detail->created_at))}}</span>
																				</div>
																				
																				@if ($booking_detail->business_services)
																					<div class="col-md-6 col-xs-6">
																						<label>BOOKING TIME: </label>
																					</div>
																					<div class="col-md-6 col-xs-6">
																						<span> {{date('h:i A', strtotime($booking_detail->business_services->shift_start))}}</span>
																					</div>
																				@endif
																				@if ($booking_detail->booking->user)
																					<div class="col-md-6 col-xs-6">
																						<label>BOOKED BY:</label>
																					</div>
																					<div class="col-md-6 col-xs-6">
																						<span>{{$booking_detail->booking->user->firstname}} {{$booking_detail->booking->user->lastname}} (Online Marketplace)</span>
																					</div>
																				@endif
																				@if ($booking_detail->booking->customer)
																					<div class="col-md-6 col-xs-6">
																						<label>BOOKED BY:</label>
																					</div>
																					<div class="col-md-6 col-xs-6">
																						<span>{{$booking_detail->booking->customer->fname}} {{$booking_detail->booking->customer->lname}} (In person)</span>
																					</div>
																				@endif
																				
																				@if ($booking_detail->business_services)
																					<div class="col-md-6 col-xs-6">
																						<label>ACTIVITY TYPE:</label>
																					</div>
																					<div class="col-md-6 col-xs-6">
																						<span>{{$booking_detail->business_services->sport_activity}}</span>
																					</div>
																				@endif
																				
																				@if ($booking_detail->business_services)
																				<div class="col-md-6 col-xs-6">
																					<label>SERVICE TYPE:</label>
																				</div>
																				<div class="col-md-6 col-xs-6">
																					<span>{{$booking_detail->business_services->formal_service_types()}}</span>
																				</div>
																				@endif
																			</div>
																		</div>
																	</div>
																</div>
															@endforeach
														</div>
													</div>
												</div>
											</div>
											
										</div>
									</div>
								</div>
								<div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
									<div class="table-staff table-responsive">
										<table id="purchase-history" class="table table-striped table-bordered" style="width:100%">
											<thead>
												<tr>
													<th>Sale Date </th>
													<th>Item Description </th>
													<th> Item Type</th>
													<th>Pay Method</th>
													<th>Price</th>
													<th>Qty</th>
													<th>Refund/Void</th>
													<th>Receipt</th>
												</tr>
											</thead>
											<tbody>
												@foreach ($purchase_history as $history)
													<tr>
														<td>{{date('m/d/Y',strtotime($history->created_at))}}</td>
														<td>{!!$history->item_description()!!}</td>
														<td>{{$history->item_type_terms()}}</td>
														<td>{{$history->getPmtMethod()}}</td>
														<td>${{$history->amount}}</td>
														<td>{{$history->qty}}</td>
														<td>Refund | Void</td>
														<td>
															<div class="table-icons-staff mailRecipt" class="mailRecipt" data-booking-detail-id="" data-booking-id ="{{$history->item_id}}" data-item-type="{{$history->item_type_terms()}}">
																<i class="fas fa-receipt"></i>
															</div>
														</td>
													</tr>
												@endforeach
											</tbody>
										</table>
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

	<!-- The Modal Add personal info-->
		<div class="modal fade compare-model" id="editbooking">
			<div class="modal-dialog editbooking">
				<div class="modal-content">
					<div class="modal-header" style="text-align: right;"> 
						<div class="closebtn">
							<button type="button" class="close close-btn-design manage-customer-close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">×</span>
							</button>
						</div>
					</div>

					<!-- Modal body -->
					<div class="modal-body body-tbm">
						<div class="row"> 
							<div class="col-lg-12">
							   <h4 class="modal-title" style="text-align: center; color: #000; line-height: inherit; font-weight: 600; margin-top: 9px; margin-bottom: 12px;">Edit Customer</h4>
							</div>
						</div>
						<form action="{{route('update_customer')}}" method="post" enctype="multipart/form-data">
							@csrf
							<input type="hidden" id="cus_id" name="cus_id" value="{{$customerdata->id}}">
							<input type="hidden" id="chk" name="chk" value="update_personal">
							<div class="row">
								<div class="col-md-6 col-xs-12">
									<div class="modal-from-txt">
										<label>	First Name</label>
										<input class="form-control" type="text" id="fname" name="fname" placeholder="First name" value="{{$customerdata->fname}}">
									</div>
								</div>
								<div class="col-md-6 col-xs-12">
									<div class="modal-from-txt">
										<label>Last Name</label>
										<input class="form-control" type="text" id="lname" name="lname" placeholder="Last Name" value="{{$customerdata->lname}}">
									</div>
								</div>
								<div class="col-md-6 col-xs-12">
									<div class="modal-from-txt">
										<label>Email</label>
										<input class="form-control" type="text" id="email" name="email" placeholder="Email" value="{{$customerdata->email}}">
									</div>
								</div>
								<div class="col-md-6 col-xs-12">
									<div class="modal-from-txt">
										<label>	Phone Number </label>
										<input class="form-control" type="text" id="phone_number" name="phone_number" placeholder="Phone Number" value="{{$customerdata->phone_number}}" data-behavior="text-phone">
									</div>
								</div>
								<div class="col-md-6 col-xs-12">
									<div class="modal-from-txt">
										<label>	Birthdate </label>
										<input class="form-control" type="text" data-behavior="datepicker" name="birthdate" placeholder="Birthdate" value="{{date('m/d/Y',strtotime($customerdata->birthdate))}}" >
									</div>
								</div>
								<div class="col-md-6 col-xs-12">
									<div class="modal-from-txt">
										<label>	Gender </label>
										<div>
										<input type="radio" name="gender" value="male" @if($customerdata->gender == 'male') checked @endif> Male
										<input type="radio" name="gender" value="female" @if($customerdata->gender == 'female') checked @endif> Female
										<input type="radio" name="gender" value="other" @if($customerdata->gender == 'other') checked @endif> Other
										</div>
									</div>
								</div>
								<div class="col-md-6 col-xs-12">
									<div class="modal-from-txt">
										<label>	Address </label>
										<input class="form-control" type="text" id="b_address" name="address" placeholder="Address" value="{{$customerdata->full_address()}}">
									</div>
								</div>
								 <div id="map" style="display: none;"></div>
								<div class="col-md-6 col-xs-12">
									<div class="modal-from-txt">
										<label>	City  </label>
										<input class="form-control" type="text" id="city" name="city" placeholder="City " value="{{$customerdata->city}}">
									</div>
								</div>
								<div class="col-md-6 col-xs-12">
									<div class="modal-from-txt">
										<label>	State </label>
										<input class="form-control" type="text" id="state" name="state" placeholder="State" value="{{$customerdata->state}}">
									</div>
								</div>
								<div class="col-md-6 col-xs-12">
									<div class="modal-from-txt">
										<label>	Country </label>
										<input class="form-control" type="text" id="country" name="country" placeholder="Country" value="{{$customerdata->country}}">
									</div>
								</div>
								<div class="col-md-6 col-xs-12">
									<div class="modal-from-txt">
										<label>	Zipcode </label>
										<input class="form-control" type="text" id="zipcode1" name="zipcode" placeholder="Zipcode" value="{{$customerdata->zipcode}}">
									</div>
								</div>
								
								<div class="col-md-6 col-xs-12">
									<div class="modal-from-txt">
										<label>	Profile Picture</label>
										<div class="userblock">
		                        			<div class="login_links">
		                                		@if($customerdata->profile_pic)
		                                			<img src="{{Storage::Url($customerdata->profile_pic)}}" class="imgboxes" alt="">
		                                		@else
		                                			<div class="company-list-text"><p>{{$customerdata->fname[0]}}</p></div>
		                                		@endif
		                                    </div>
		                                </div>
										<input type="file" id="profile_pic" name="profile_pic">						
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-12">
									<button type="submit" class="btn-nxt manage-cus-btn cancel-modal">Submit</button>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	<!-- end modal -->

	
	<!-- The Modal Add billing info-->
		<div class="modal fade compare-model" id="edittermsofservice">
			<div class="modal-dialog editbooking">
				<div class="modal-content">
					<div class="modal-header" style="text-align: right;"> 
						<div class="closebtn">
							<button type="button" class="close close-btn-design manage-customer-close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">×</span>
							</button>
						</div>
					</div>

					<!-- Modal body -->
					<div class="modal-body body-tbm">
						<div class="row"> 
							<div class="col-lg-12">
							   <h4 class="modal-title" style="text-align: center; color: #000; line-height: inherit; font-weight: 600; margin-top: 9px; margin-bottom: 12px;">Edit Terms of Service</h4>
							</div>
						</div>
						<form action="{{route('update_customer')}}" method="post" enctype="multipart/form-data">
							@csrf
							<input type="hidden" id="cus_id" name="cus_id" value="{{$customerdata->id}}">
							<input type="hidden" id="chk" name="chk" value="update_personal">
							<div class="row">
								<div class="col-md-12">
									<div class="modal-checkbox">
										<label>Covid-19 Protocols</label>
										<p>{{@$terms->covidtext}}</p>
										<div class="modal-terms-wrap">
											<input type="checkbox" id="terms_covid" name="terms_covid" value="1" @if(@$customerdata->terms_covid != '') checked @endif>
											<p class="modal-terms"> The provider(s) require that you agree to Covid-19 Protocols. </p>
										</div>
									</div>
									<div class="modal-checkbox">
										<label>Liability Waiver</label>
										<p>{{@$terms->liabilitytext}}</p>
										<div class="modal-terms-wrap">
											<input type="checkbox" id="terms_liability" name="terms_liability" value="1" @if(@$customerdata->terms_liability != '') checked @endif>
											<p class="modal-terms"> The provider(s) require that you agree to Liability Waiver. </p>
										</div>
									</div>
									<div class="modal-checkbox">
										<label>Contract Terms</label>
										<p>{{@$terms->contracttermstext}}</p>
										<div class="modal-terms-wrap">
											<input type="checkbox" id="terms_contract" name="terms_contract" value="1" @if(@$customerdata->terms_contract != '') checked @endif>
											<p class="modal-terms"> The provider(s) require that you agree to Contract Terms. </p>
										</div>
									</div>
									<div class="row">
										<div class="col-md-12">
											<button type="submit" class="btn-nxt manage-cus-btn cancel-modal">Submit</button>
										</div>
									</div>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	<!-- end modal -->
	

<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
@include('layouts.footer')


<script type="text/javascript">
    $(document).ready(function() {
    	$('.cards-block').click();
    });

    var query_error = '<?=isset($_GET['error'])?$_GET['error']:0;?>';
    if(query_error == 1) {
        $("#card-error").html("Requested card number is already exists.");
    }


	function changedate(){
		$('#span_membership_activation').html($('#membershipactivationdate').val());
		$('#span_membership_activation').addClass('red-fonts');
	}

    $("#confirm-purchase").on('click', function(){
    	var cardNumber = $('#cardNumber').val()
    	var cvv = $('#cvv').val();

    	var type = '';
    	if (Number.isInteger(+cardNumber)) {
    		type = 'true';
    	}else{
			type = 'false';
    	}

    	if (Number.isInteger(+cvv)) {
    		type = 'true';
    	}else{
			type = 'false';
    	}
    	if(type === 'false'){
    		$('#numbercarderror').html("Please Type Full Card Number and CVV");
    		return false;
    		 e.preventDefault();
    	}else{
 			$( "#frmpayment" ).submit();
    	}
  
    });

    $(document).on("click", "[data-behavior~=delete_card]", function(e){
    	e.preventDefault()

        if (confirm('You are sure to delete card?')) {

            var cardid = $(this).data("cardid");
            $.ajax({
                type: 'DELETE',
                url: $(this).data('url'),
                data: {
                    _token: '{{csrf_token()}}',

                },
                success: function(data) {

                   /* alert("Card removed successfully.");*/
                    location.reload();
                }
            });
        } else {
            //alert('Why did you press cancel? You should have confirmed');
        }
    });
    
    $(".cards-block").on("click", function(){
        /*alert($(this).data('type'));*/
        $("#card-error").html('');
        $("#payment_type").val($(this).data('ptype'));
        $("#owner").val($(this).data('name'));
        if($(this).data('month') != "") {
            $("#card_month option:selected").text(chkmonth($(this).data('month')));
            $("#card_year option:selected").text($(this).data('year'));
            $("#cardNumber").val('************'+$(this).data('cnumber'));
            $("#card_monthhidden").val($(this).data('month'));
            $("#card_yearhidden").val($(this).data('year'));
            $("#cvv").val('***');
            /*$("#confirm-purchase").attr('disabled', true);*/
        } else {
            $("#card_month option:selected").text("Mon");
            $("#card_year option:selected").text("Year");
            $("#cardNumber").val($(this).data('cnumber'));
            $("#cvv").val($(this).data('cvv'));
            $("#confirm-purchase").attr('disabled', false);
        }
       /* $("#card_month option:selected").val($(this).data('month'));*/
        $("#card_type").val($(this).data('type'));
        $("#credit_cards img").addClass('transparent');
        $("#"+$(this).data('type')).removeClass('transparent');
    });
    
    function chkmonth(id) {
        if(id==1)return "Jan";
        if(id==2)return "Feb";
        if(id==3)return "Mar";
        if(id==4)return "Apr";
        if(id==5)return "May";
        if(id==6)return "Jun";
        if(id==7)return "Jul";
        if(id==8)return "Aug";
        if(id==9)return "Sep";
        if(id==10)return "Oct";
        if(id==11)return "Nov";
        if(id==12)return "Dec";
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
                  $('#zipcode').val(place.address_components[i].long_name);
                }
                if(place.address_components[i].types[0] == 'country'){
                  $('#country').val(place.address_components[i].long_name);
                }

                if(place.address_components[i].types[0] == 'locality'){
                    $('#city').val(place.address_components[i].long_name);
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
                  $('#state').val(place.address_components[i].long_name);
                }
            }

            if(badd == ''){
              $('#b_address').val(sublocality_level_1);
            }else{
              $('#b_address').val(badd);
            }
           
            /*$('#lat').val(place.geometry.location.lat());
            $('#lon').val(place.geometry.location.lng());*/
        });
    }
</script>

<script src="https://maps.googleapis.com/maps/api/js?libraries=places&key=AIzaSyCr7-ilmvSu8SzRjUfKJVbvaQZYiuntduw&callback=initMap" async defer></script>

<script>
	$(document).ready(function() {
		$('#visitstable').DataTable();
		responsive: true
	} );

	$(".mailRecipt").click(function(){
		var item_type = $(this).data('item-type');
		if(item_type == 'no' || item_type == 'Membership'){
			var confirm_value = confirm("Do you want to mail the receipt to this Customer? ");
			if(confirm_value == true){
				$.ajax({
					url: "{{route('sendReceiptToCustomer')}}",
		            xhrFields: {
		                withCredentials: true
		            },
		            type: 'get',
		            data:{
		                odetailid: $(this).data('booking-detail-id'),
		                oid: $(this).data('booking-id'),
		           	},
		            success: function (response) {
		            	$('#errordiv').html('');
		            	$('#errordiv').removeClass('green-fonts');
		            	$('#errordiv').removeClass('reviewerro');
	                    $('#errordiv').css('display','block');
		                if(response == 'success'){
		                	$('#errordiv').addClass('green-fonts');
		                    $('#errordiv').html('Email Successfully Sent..');
		                }else{
		                	$('#errordiv').addClass('reviewerro');
		                    $('#errordiv').html("Can't Mail on this Address. Plese Check your Email..");
		                }
		            }
	            });
			}
		}
	});


	$(document).on('click', '[data-behavior~=mail_receipt]', function(e){
		alert('hii');
		/*confirm("Do you want to mail the receipt to this Customer? ");
		if(confirm){
			$.ajax({
				url: "{{route('sendReceiptToCustomer')}}",
	            xhrFields: {
	                withCredentials: true
	            },
	            type: 'get',
	            data:{
	                odetailid: $(this).data('booking-detail-id'),
	                oid: $(this).data('booking-id'),
	           	},
	            success: function (response) {
	                if(response == 'success'){
	                    $('.reviewerro').html('Email Successfully Sent..');
	                }else{
	                    $('.reviewerro').html("Can't Mail on this Address. Plese Check your Email..");
	                }
	            }
            });
		}*/
	});
	

	$('#visitstable').dataTable( {
		"searching": false,
		"ordering": false,
		"info":     false,
		"paging":   false,
	} );
</script>

@endsection