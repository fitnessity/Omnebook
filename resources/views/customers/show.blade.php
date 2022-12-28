@extends('layouts.header')
@section('content')
@include('layouts.userHeader')

@php 
	use Carbon\Carbon;
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
										<span>04/07/2021</span>
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
					<div class="tab-custom tab-content" id="myTabContent">
						<div class="tab-pane fade active" id="customer-info" role="tabpanel" aria-labelledby="customer-info-tab">
							<div class="row">
								<div class="col-md-6 col-xs-12">
									<div class="manage-cust-box">
										<div class="row">
											<div class="col-md-12 col-xs-12">
												<label class="tab-titles">Quick Stats (TBD)</label>
											</div>
											<div class="col-md-6 col-xs-6">
												<label>Status</label>
											</div>
											<div class="col-md-6 col-xs-6">
												<span class="green-fonts">Active</span>
											</div>
										</div>
										<div class="row">
											<div class="col-md-6 col-xs-6">
												<label>Activities Booked</label>
											</div>
											<div class="col-md-6 col-xs-6">
												<span>5</span>
											</div>
										</div>
										<div class="row">
											<div class="col-md-6 col-xs-6">
												<label>Money Spent</label>
											</div>
											<div class="col-md-6 col-xs-6">
												<span>$5,459</span>
											</div>
										</div>
										<div class="row">
											<div class="col-md-6 col-xs-6">
												<label>Number of Visits</label>
											</div>
											<div class="col-md-6 col-xs-6">
												<span>50</span>
											</div>
										</div>
										<div class="row">
											<div class="col-md-6 col-xs-6">
												<label>Active Memberships</label>
											</div>
											<div class="col-md-6 col-xs-6">
												<span class="green-fonts">1</span>
											</div>
										</div>
										<div class="row">
											<div class="col-md-6 col-xs-6">
												<label>Expiring Memberships</label>
											</div>
											<div class="col-md-6 col-xs-6">
												<span>0</span>
											</div>
										</div>
									</div>
									<?php
									$name = '';
									$last4 = '';
                                    foreach($cardInfo as $card) {
                                    	$name=$card['name'];
                                    	$last4='CC ending in ****'.$card['last4'];
                                    }
                                    ?>
									<div class="manage-cust-box">
										<div class="row">
											<div class="col-md-12 col-xs-12">
												<div class="customer-info">
													<label class="tab-titles">Billing Information</label>
													<a data-toggle="modal" data-target="#editbillinginfo">Edit</a>
												</div>
											</div>
										</div>
										<div class="row">
											<div class="col-md-12 col-xs-12">
												<label>Card of File:</label>
											</div>
										</div>
										<div class="row">
											<div class="col-md-3 col-xs-4">
												<label>Name on card: </label>
											</div>
											<div class="col-md-8 col-xs-6">
												<span>{{$name}}</span>
											</div>
										</div>
										<div class="row">
											<div class="col-md-12 col-xs-12">
												<span>{{$last4}}</span>
											</div>
										</div>
									</div>
									
									<div class="manage-cust-box">
										<form action="{{route('savenotes')}}" method="POST">
											@csrf
											<input type="hidden" name="cus_id" value="{{$customerdata->id}}">
											<div class="row">
												<div class="col-md-12 col-xs-12">
													<label class="tab-titles">Notes</label>
												</div>
											</div>
											<div class="row">
												<div class="col-md-12 col-xs-12">
													<textarea name="notetext" rows="4" style="width: 100%;">{{$customerdata->notes}} </textarea>
												</div>
											</div>
											<button type="submit" class="btn-nxt">Submit</button>
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
												<span>50</span>
												<label>Total Number of Hours:</label>
												<span>125 hrs.</span>
											</div>
										</div>
									</div>
									<div class="manage-cust-box">
										<div class="table-responsive">
											<table id="visitstable" class="table table-striped table-bordered" style="width:100%">
												<thead>
													<tr>
														<th> Date </th>
														<th>Time </th>
														<th>Program Name </th>
														<th>Program Title </th>
														<th>Status</th>
														<th> Instructor</th>
													</tr>
												</thead>
												<tbody>
													<tr>
														<td>11/25/2022 </td>
														<td>9:00 am</td>
														<td> Valor MMA Personal Training Sessions</td>
														<td>45 Minute Session</td>
														<td> Checked In </td>
														<td>Darryl Phipps</td>
													</tr>
													<tr>
														<td>11/23/2022</td>
														<td>9:30 am</td>
														<td> Valor MMA Personal Training Sessions</td>
														<td>45 Minute Session</td>
														<td> Checked In </td>
														<td>Darryl Phipps</td>
													</tr>
													<tr>
														<td>11/20/2022 </td>
														<td>12:00 pm</td>
														<td> Valor MMA Personal Training Sessions</td>
														<td>45 Minute Session</td>
														<td> Checked In </td>
														<td>Darryl Phipps</td>
													</tr>
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
										<a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#pills-profile" role="tab" aria-controls="pills-profile" aria-selected="false">Products Booked  </a>
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
															Active Bookings (1)   
															</a>
														</h4>
													</div>
													<div id="collapseOne" class="panel-collapse collapse in">
														<div class="panel-body">
															<div class="row">
																<div class="col-md-12 col-xs-12">
																	<div class="inner-accordion-titles">
																		<label> Kickboxing for Adults</label>	
																		<span>Remaining 4/15 <i class="far fa-file-alt"></i></span>
																		
																	</div>
																	<div class="customer-profile-info">
																		<div class="row">
																			<div class="col-md-6 col-xs-6">
																				<label>BOOKING # </label>
																			</div>
																			<div class="col-md-6 col-xs-6">
																				<span> 3004 </span>
																			</div>
																		
																			<div class="col-md-6 col-xs-6">
																				<label>TOTAL PRICE </label>
																			</div>
																			<div class="col-md-6 col-xs-6">
																				<span>  $1,200 </span>
																			</div>
																			
																			<div class="col-md-6 col-xs-6">
																				<label>PAYMENT TYPE:</label>
																			</div>
																			<div class="col-md-6 col-xs-6">
																				<span>15 Sessions </span>
																			</div>
																		
																			<div class="col-md-6 col-xs-6">
																				<label>TOTAL REMAINING:</label>
																			</div>
																			<div class="col-md-6 col-xs-6">
																				<span>14/15</span>
																			</div>
																			
																			<div class="col-md-6 col-xs-6">
																				<label>PROGRAM NAME:</label>
																			</div>
																			<div class="col-md-6 col-xs-6">
																				<span>Kickboxing for Adults</span>
																			</div>
																			
																			<div class="col-md-6 col-xs-6">
																				<label>EXPIRATION DATE:	</label>
																			</div>
																			<div class="col-md-6 col-xs-6">
																				<span> 06/1/2021</span>
																			</div>
																			
																			<div class="col-md-6 col-xs-6">
																				<label>DATE BOOKED:	</label>
																			</div>
																			<div class="col-md-6 col-xs-6">
																				<span>04/07/2021</span>
																			</div>
																			
																			<div class="col-md-6 col-xs-6">
																				<label>RESERVED DATE: 	</label>
																			</div>
																			<div class="col-md-6 col-xs-6">
																				<span> 04/10/2021</span>
																			</div>
																			
																			<div class="col-md-6 col-xs-6">
																				<label>BOOKING TIME: </label>
																			</div>
																			<div class="col-md-6 col-xs-6">
																				<span> 12:00 PM EST</span>
																			</div>
																			
																			<div class="col-md-6 col-xs-6">
																				<label>BOOKED BY:</label>
																			</div>
																			<div class="col-md-6 col-xs-6">
																				<span>Darryl Phipps</span>
																			</div>
																			
																			<div class="col-md-6 col-xs-6">
																				<label>CHECK IN DATE: </label>
																			</div>
																			<div class="col-md-6 col-xs-6">
																				<span> 04/10/2021</span>
																			</div>
																			
																			<div class="col-md-6 col-xs-6">
																				<label>CHECK IN TIME: </label>
																			</div>
																			<div class="col-md-6 col-xs-6">
																				<span> 12:15pm EST</span>
																			</div>
																			
																			<div class="col-md-6 col-xs-6">
																				<label>ACTIVITY TYPE:</label>
																			</div>
																			<div class="col-md-6 col-xs-6">
																				<span>Kickboxing</span>
																			</div>
																			
																			<div class="col-md-6 col-xs-6">
																				<label>SERVICE TYPE:</label>
																			</div>
																			<div class="col-md-6 col-xs-6">
																				<span>Personal Training</span>
																			</div>
																		</div>
																	</div>
																	
																	<div class="row">
																		<div class="col-md-6 col-xs-6">
																			<div class="view-visits">
																				<a> View Visits </a>
																			</div>
																		</div>
																		<div class="col-md-6 col-xs-6">
																			<div class="edit-booking">
																				<a> Edit Booking  </a>
																			</div>
																		</div>
																	</div>
																</div>
															</div>
														</div>
													</div>
												</div>
											</div>
											<div class="col-md-6 col-sm-6 col-xs-12">
												<div class="panel panel-default panel-space">
													<div class="inner-arrow panel-heading">
														<h4 class="panel-title">
															<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo">
															Completed  Bookings (2)
															</a>
														</h4>
													</div>
													<div id="collapseTwo" class="panel-collapse collapse">
														<div class="panel-body">
															<div class="row">
																<div class="col-md-12 col-xs-12">
																	<div class="inner-accordion-titles">
																		<label> Kickboxing for Adults</label>	
																		<span>Remaining 4/15 <i class="far fa-file-alt"></i></span>
																		
																	</div>
																	<div class="customer-profile-info">
																		<div class="row">
																			<div class="col-md-6 col-xs-6">
																				<label>BOOKING # </label>
																			</div>
																			<div class="col-md-6 col-xs-6">
																				<span> 3004 </span>
																			</div>
																		
																			<div class="col-md-6 col-xs-6">
																				<label>TOTAL PRICE </label>
																			</div>
																			<div class="col-md-6 col-xs-6">
																				<span>  $1,200 </span>
																			</div>
																			
																			<div class="col-md-6 col-xs-6">
																				<label>PAYMENT TYPE:</label>
																			</div>
																			<div class="col-md-6 col-xs-6">
																				<span>15 Sessions </span>
																			</div>
																		
																			<div class="col-md-6 col-xs-6">
																				<label>TOTAL REMAINING:</label>
																			</div>
																			<div class="col-md-6 col-xs-6">
																				<span>14/15</span>
																			</div>
																			
																			<div class="col-md-6 col-xs-6">
																				<label>PROGRAM NAME:</label>
																			</div>
																			<div class="col-md-6 col-xs-6">
																				<span>Kickboxing for Adults</span>
																			</div>
																			
																			<div class="col-md-6 col-xs-6">
																				<label>EXPIRATION DATE:	</label>
																			</div>
																			<div class="col-md-6 col-xs-6">
																				<span> 06/1/2021</span>
																			</div>
																			
																			<div class="col-md-6 col-xs-6">
																				<label>DATE BOOKED:	</label>
																			</div>
																			<div class="col-md-6 col-xs-6">
																				<span>04/07/2021</span>
																			</div>
																			
																			<div class="col-md-6 col-xs-6">
																				<label>RESERVED DATE: 	</label>
																			</div>
																			<div class="col-md-6 col-xs-6">
																				<span> 04/10/2021</span>
																			</div>
																			
																			<div class="col-md-6 col-xs-6">
																				<label>BOOKING TIME: </label>
																			</div>
																			<div class="col-md-6 col-xs-6">
																				<span> 12:00 PM EST</span>
																			</div>
																			
																			<div class="col-md-6 col-xs-6">
																				<label>BOOKED BY:</label>
																			</div>
																			<div class="col-md-6 col-xs-6">
																				<span>Darryl Phipps</span>
																			</div>
																			
																			<div class="col-md-6 col-xs-6">
																				<label>CHECK IN DATE: </label>
																			</div>
																			<div class="col-md-6 col-xs-6">
																				<span> 04/10/2021</span>
																			</div>
																			
																			<div class="col-md-6 col-xs-6">
																				<label>CHECK IN TIME: </label>
																			</div>
																			<div class="col-md-6 col-xs-6">
																				<span> 12:15pm EST</span>
																			</div>
																			
																			<div class="col-md-6 col-xs-6">
																				<label>ACTIVITY TYPE:</label>
																			</div>
																			<div class="col-md-6 col-xs-6">
																				<span>Kickboxing</span>
																			</div>
																			
																			<div class="col-md-6 col-xs-6">
																				<label>SERVICE TYPE:</label>
																			</div>
																			<div class="col-md-6 col-xs-6">
																				<span>Personal Training</span>
																			</div>
																		</div>
																	</div>
																	
																	<div class="row">
																		<div class="col-md-6 col-xs-6">
																			<div class="view-visits">
																				<a> View Visits </a>
																			</div>
																		</div>
																		<div class="col-md-6 col-xs-6">
																			<div class="edit-booking">
																				<a> Edit Booking  </a>
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
								<div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
									
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
								<div class="col-md-6">
									<div class="modal-from-txt">
										<label>	First Name</label>
										<input class="form-control" type="text" id="fname" name="fname" placeholder="First name" value="{{$customerdata->fname}}">
									</div>
								</div>
								<div class="col-md-6">
									<div class="modal-from-txt">
										<label>Last Name</label>
										<input class="form-control" type="text" id="lname" name="lname" placeholder="Last Name" value="{{$customerdata->lname}}">
									</div>
								</div>
								<div class="col-md-6">
									<div class="modal-from-txt">
										<label>Email</label>
										<input class="form-control" type="text" id="email" name="email" placeholder="Email" value="{{$customerdata->email}}">
									</div>
								</div>
								<div class="col-md-6">
									<div class="modal-from-txt">
										<label>	Phone Number </label>
										<input class="form-control" type="text" id="phone_number" name="phone_number" placeholder="Phone Number" value="{{$customerdata->phone_number}}">
									</div>
								</div>
								<div class="col-md-6">
									<div class="modal-from-txt">
										<label>	Birthdate </label>
										<input class="form-control" type="text" id="birthdate" name="birthdate" placeholder="Birthdate" value="{{date('m/d/Y',strtotime($customerdata->birthdate))}}" maxlength="10" onkeypress="return event.charCode >= 48 && event.charCode <= 57" >
									</div>
								</div>
								<div class="col-md-6">
									<div class="modal-from-txt">
										<label>	Gender </label>
										<div>
										<input type="radio" name="gender" value="male" @if($customerdata->gender == 'male') checked @endif> Male
										<input type="radio" name="gender" value="female" @if($customerdata->gender == 'female') checked @endif> Female
										<input type="radio" name="gender" value="other" @if($customerdata->gender == 'other') checked @endif> Other
										</div>
									</div>
								</div>
								<div class="col-md-6">
									<div class="modal-from-txt">
										<label>	Address </label>
										<input class="form-control" type="text" id="b_address" name="address" placeholder="Address" value="{{$customerdata->full_address()}}">
									</div>
								</div>
								 <div id="map" style="display: none;"></div>
								<div class="col-md-6">
									<div class="modal-from-txt">
										<label>	City  </label>
										<input class="form-control" type="text" id="city" name="city" placeholder="City " value="{{$customerdata->city}}">
									</div>
								</div>
								<div class="col-md-6">
									<div class="modal-from-txt">
										<label>	State </label>
										<input class="form-control" type="text" id="state" name="state" placeholder="State" value="{{$customerdata->state}}">
									</div>
								</div>
								<div class="col-md-6">
									<div class="modal-from-txt">
										<label>	Country </label>
										<input class="form-control" type="text" id="country" name="country" placeholder="Country" value="{{$customerdata->country}}">
									</div>
								</div>
								<div class="col-md-6">
									<div class="modal-from-txt">
										<label>	Zipcode </label>
										<input class="form-control" type="text" id="zipcode1" name="zipcode" placeholder="Zipcode" value="{{$customerdata->zipcode}}">
									</div>
								</div>
								
								<div class="col-md-6">
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
		<div class="modal fade compare-model" id="editbillinginfo">
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
							   <h4 class="modal-title" style="text-align: center; color: #000; line-height: inherit; font-weight: 600; margin-top: 9px; margin-bottom: 12px;">Edit Billing Information </h4>
							</div>
						</div>
						<div class="row">
							<form method="post" id="frmpayment" action="{{Route('update_customer')}}">
								<div id="numbercarderror" class="red-fonts" style="text-align: center;margin-bottom: 15px"></div>
								<div class="page-wrapper" id="wrapper">
								    <div class="page-container">
								        <div class="page-content-wrapper">
								            <div class="content-page">
								                <div class="container-fluid">
								                    <div class="page-title-box">
								                        <h4 class="page-title">Payment Information</h4>
								                    </div>
								                    <div class="payment_info_section padding-1 white-bg border-radius1">
								                        <div class="payment-info-block">
								                            <div class="savecard-block">
								                                <?php
								                                if(!empty($cardInfo)) {
								                                ?>
								                                    <div class="sacecard-title">Your Saved Cards</div>
								                                    <?php
								                                    foreach($cardInfo as $card) {
								                                        $brandname = strtolower($card['brand']);
								                                    ?>
								                                    <div class="cards-block block-resize" style="cursor: pointer" data-name="<?=$card['name']?>" data-cvv="" data-cnumber="<?=$card['last4']?>" data-month="<?=$card['exp_month']?>" data-year="<?=$card['exp_year']?>" data-type="{{$brandname}}" data-ptype="update">
								                                    <div class="cards-content block-resize" style="color:#ffffff; background-image: url({{ url('public/img/visa-card-bg.jpg')}} );">
								                                        <img src="{{ url('/public/images/creditcard/'.$brandname.'.jpg') }}" alt="">
								                                        <span style="float:right"><?=$card['name']?></span>
								                                        <p><?=ucfirst($brandname)?></p>
								                                        <span>
								                                            <span class="dots"></span><span class="dots"></span><span class="dots"></span><span class="dots"></span> 
								                                        </span>
								                                        <span style="float:right" data-cardid="<?=$card['id']?>" title="Delete Card" class="delCard"><i class="fa fa-trash"></i></span>
								                                    </div>
								                                    </div>
								                                    <?php }
								                                } ?>
								                            </div>
								                            <div class="row" >
																<div class="col-md-12" >
																	<form  class="billing-block col-lg-7">
																		@csrf
																		<input type="hidden" id="cus_id" name="cus_id" value="{{$customerdata->id}}">
																		<input type="hidden" id="chk" name="chk" value="update_billing">
																		<input type="hidden" name="payment_type" id="payment_type" value="insert" />
																		<input type="hidden" name="_token" value="{{csrf_token()}}" />
																		<input type="hidden" name="card_type" id="card_type" value="visa" />
																		<div style="color:red" id="card-error"></div>
																		<div class="sacecard-title">Billing Address</div>

																		<div class="row">

																			<div class="col-xl-9 col-lg-9 col-md-9 col-sm-8 col-12 form-group">
																				<label for="owner">Name On Card</label>
																				<input required type="text" name="owner" id="owner" placeholder="" class="form-control">
																			</div>

																			<div class="col-xl-3 col-lg-3 col-md-3 col-sm-4 col-12 form-group">
																				<label for="cvv">CVV</label>
																				<input required type="text" name="cvv" id="cvv" placeholder="" class="form-control">
																			</div>

																			<div id="card-number-field" class="col-xl-8 col-lg-8 col-md-8 col-sm-8 col-12 form-group">
																				<label for="cardNumber">Card Number</label>
																				<input required type="text" name="cardNumber" id="cardNumber" placeholder="" class="form-control">
																			</div>
																			
																			<div id="expiration-date" class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12 form-group">
																				<input type="hidden" name="card_monthhidden" id="card_monthhidden" value="">
																				<input type="hidden" name="card_yearhidden" id="card_yearhidden" value="">
																				<select required id="card_month" name="card_month">
																					<option value="">Mon</option>
																					<option value="01">Jan</option>
																					<option value="02">Feb</option>
																					<option value="03">Mar</option>
																					<option value="04">Apr</option>
																					<option value="05">May</option>
																					<option value="06">Jun</option>
																					<option value="07">Jul</option>
																					<option value="08">Aug</option>
																					<option value="09">Sep</option>
																					<option value="10">Oct</option>
																					<option value="11">Nov</option>
																					<option value="12">Dec</option>
																				</select>
																				<select required id="card_year" name="card_year">
																					<option value="">Year</option>
																					<option value="2021">2021</option>
																					<option value="2022">2022</option>
																					<option value="2023">2023</option>
																					<option value="2024">2024</option>
																					<option value="2025">2025</option>
																					<option value="2026">2026</option>
																					<option value="2027">2027</option>
																					<option value="2028">2028</option>
																					<option value="2029">2029</option>
																					<option value="2030">2030</option>
																					<option value="2031">2031</option>
																					<option value="2032">2032</option>
																					<option value="2033">2033</option>
																					<option value="2034">2034</option>
																					<option value="2035">2035</option>
																					<option value="2036">2036</option>
																					<option value="2037">2037</option>
																					<option value="2038">2038</option>
																					<option value="2039">2039</option>
																					<option value="2040">2040</option>
																				</select>
																			</div>
																		</div>
																		<div class="row">
																			<div id="pay-now" class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12 form-group">
																				<input type="button" id="confirm-purchase" value="Confirm" class="btn-style-one">
																			</div>
																			<div id="credit_cards" class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12 form-group">
																				<img src="/public/images/creditcard/visa.jpg" id="visa">
																				<img src="/public/images/creditcard/mastercard.jpg" id="mastercard">
																				<img src="/public/images/creditcard/amex.jpg" id="amex">
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
								    </div>
								</div>
							</form>
						</div>
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

<!-- Latest compiled and minified JavaScript -->
<script type="text/javascript">
    $(document).ready(function() {
    	$('.cards-block').click();
    });

    var query_error = '<?=isset($_GET['error'])?$_GET['error']:0;?>';
    if(query_error == 1) {
        $("#card-error").html("Requested card number is already exists.");
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

    $(".delCard").on("click", function(){
        $("#owner").val("");
        $("#cvv").val("");
        $("#cardNumber").val("");
        $("#card-error").html("");
        $("#card_month option:selected").text("Mon");
        $("#card_year option:selected").text("Year");
        $("#card_month").val("");
        $("#card_year").val("");
        if (confirm('You are sure to delete card?')) {
            var _token = $("input[name='_token']").val();
            var cardid = $(this).data("cardid");
            $.ajax({
                type: 'POST',
                url: '{{route("paymentdeletecustomer")}}',
                data: {
                    _token: _token,
                    cardid: cardid,
                    cus_id:'{{$customerdata->id}}',
                },
                success: function(data) {
                   /* alert("Card removed successfully.");*/
                    window.location.reload();
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
	
	$("#birthdate").keyup(function(){
      if ($(this).val().length == 2){
          $(this).val($(this).val() + "/");
      }else if ($(this).val().length == 5){
          $(this).val($(this).val() + "/");
      }
  	});

	$('#visitstable').dataTable( {
		"searching": false,
		"ordering": false,
		"info":     false,
		"paging":   false,
	} );
</script>


@endsection