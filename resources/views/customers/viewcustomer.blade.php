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
			<div class="row">
				<div class="col-md-12">
					<div class="manage-cust-box">
						<div class="row">
							<div class="col-md-2 col-sm-3">
								<div class="manage-cust-img">
                                    <img src="http://dev.fitnessity.co/public/uploads/profile_pic/index.jpg" class="imgboxes" alt="">
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
										<span>{{$address}}</span>
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
											<span>{{$bdate}}</span>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-5 col-xs-5">
										<label>Age</label>
									</div>
									<div class="col-md-7 col-xs-7">
										<span>@if($age != '—') {{$age}} Years Old @else {{$age}}  @endif</span>
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
										<span>{{$location}}</span>
									</div>
								</div>
								<div class="row">
									<div class="col-md-5 col-xs-5">
										<label>Customers Since</label>
									</div>
									<div class="col-md-7 col-xs-7">
										<span>{{$sincedate}}</span>
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
												<label class="tab-titles">Quick Stats</label>
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
									
									<div class="manage-cust-box">
										<div class="row">
											<div class="col-md-12 col-xs-12">
												<div class="customer-info">
													<label class="tab-titles">Billing Information</label>
													<a href="#">Edit</a>
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
												<span>Eric Santana</span>
											</div>
										</div>
										<div class="row">
											<div class="col-md-12 col-xs-12">
												<span>CC ending in ****9045</span>
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
													<a href="#">Edit</a>
												</div>
											</div>
										</div>
										@if(!empty($familydata) && count($familydata)>0)
											@foreach($familydata as $index=>$fdata)
											@php $age =  Carbon::parse($fdata->birthday)->age;@endphp
											<div class="row">
												<div class="col-md-4 col-xs-12">
													<span>{{$index+1}}.</span>
													<label>Name:</label>
													<span>{{$fdata->first_name}} {{$fdata->last_name}} </span>
												</div>
												<div class="col-md-4 col-xs-12">
													<label>Relationship: </label>
													<span>{{$fdata->relationship}}</span>
												</div>
												<div class="col-md-4 col-xs-12">
													<label>Age</label>
													<span>({{$age}})</span>
												</div>
											</div>
											@endforeach
										@else
											<div class="row">
												<div class="col-md-12 col-xs-12">
													<div class="customer-info">
														<p>Family Member Details are not available.</p>
													</div>
												</div>
											</div>
										@endif
									</div>
									
									<div class="manage-cust-box second-box-height">
										<div class="row">
											<div class="col-md-12 col-xs-12">
												<div class="customer-info">
													<label class="tab-titles">Agreed Terms of Service</label>
													<a href="#">Edit</a>
												</div>
											</div>
										</div>
										<div class="row">
											<div class="col-md-12 col-xs-12">
												<span>1.</span>
												<span>Covid-19 Protocols agreed on 10/10/2021</span>
											</div>
											<div class="col-md-12 col-xs-12">
												<span> 2. </span>
												<span>Liability Waiver agreed on 10/10/2021</span>
											</div>
											<div class="col-md-12 col-xs-12">
												<span>3. </span>
												<span>Contract Terms  agreed on 10/10/2021</span>
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
	<!-- The Modal Add Business-->
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
									<input class="form-control" type="text" id="name" name="pno" placeholder="Phone Number" value="{{$customerdata->phone_number}}">
								</div>
							</div>
							<div class="col-md-6">
								<div class="modal-from-txt">
									<label>	Birthdate </label>
									<input class="form-control" type="text" id="fname" name="pno" placeholder="Birthdate" value="{{$bdate}}">
								</div>
							</div>
							<div class="col-md-6">
								<div class="modal-from-txt">
									<label>	Gender </label>
									<div>
									<input type="radio" name="gender" value="male" @if($customerdata->gender == 'male') selected @endif> Male
									<input type="radio" name="gender" value="female" @if($customerdata->gender == 'female') selected @endif> Female
									<input type="radio" name="gender" value="other" @if($customerdata->gender == 'other') selected @endif> Other
									</div>
								</div>
							</div>
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
									<input class="form-control" type="text" id="zipcode" name="zipcode" placeholder="Zipcode" value="{{$customerdata->zipcode}}">
								</div>
							</div>
							<div class="col-md-6">
								<div class="modal-from-txt">
									<label>	Address </label>
									<input class="form-control" type="text" id="address" name="address" placeholder="Address" value="{{$customerdata->address}}">
								</div>
							</div>
							<div class="col-md-6">
								<div class="modal-from-txt">
									<label>	Profile Picture</label>
									<form action="/action_page.php">
									  <input type="file" id="myFile" name="filename">
									</form>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-12">
							
								<a href="#" class="btn-nxt manage-cus-btn cancel-modal">Submit</a>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- end modal -->

<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
@include('layouts.footer')

<!-- Latest compiled and minified JavaScript -->


<script>
	$(document).ready(function() {
		$('#visitstable').DataTable();
		responsive: true
	} );	
	
	$('#visitstable').dataTable( {
		"searching": false,
		"ordering": false,
		"info":     false,
		"paging":   false,
	} );
</script>


@endsection