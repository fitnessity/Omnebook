@inject('request', 'Illuminate\Http\Request')
@extends('layouts.business.header')

@section('content')
<style>
	
	@media screen {
		.printDiv{
			display: none !important;
		}
	}

	@media print {
		.printnone {
			display: none !important;
		}

		.exclude-from-print {
			display: block !important;
		}
	}
</style>

	@include('layouts.business.business_topbar')
    <div class="main-content printnone">
		<div class="page-content">
         	<div class="container-fluid">
	            <div class="row">
	                <div class="col">
	                   <div class="h-100">
	                        <div class="row mb-3">
								<div class="col-12">
									<div class="page-heading">
										<label>Manage Customers</label>
									</div>
								</div>
							</div>

							@if(session('success'))
							    <div class="alert alert-success">
							        {{ session('success') }}
							    </div>
							@endif

							@if($cardSuccessMsg == 1)
								<div class="fs-15 font-green mb-10">Your Card is uploaded successfully.</div>
					  	 	@endif

							<div class="row">
								<div class="col-xl-12">
									<div class="card">
										<div class="card-header align-items-center d-flex">
											<h4 class="card-title mb-0 flex-grow-1">{{@$customerdata->full_name}}'s Account </h4>
										</div><!-- end card header -->
										<div class="card-body">
											<div class="live-preview">
												<div class="accordion custom-accordionwithicon accordion-border-box" id="accordionnesting">
													<div class="accordion-item shadow">
														<h2 class="accordion-header" id="accordionnestingExample1">
															<button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#accor_nestingExamplecollapse1" aria-expanded="true" aria-controls="accor_nestingExamplecollapse1">
																Customer Information
															</button>
														</h2>
														<div id="accor_nestingExamplecollapse1" class="accordion-collapse collapse show" aria-labelledby="accordionnestingExample1" data-bs-parent="#accordionnesting">
															<div class="accordion-body">
																<div class="accordion-item shadow ">
																	<h2 class="accordion-header" id="accordionnesting7Example2">
																		<button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#accor_nesting7Examplecollapse2" aria-expanded="true" aria-controls="accor_nesting7Examplecollapse2">
																			Customers Details
																		</button>
																	</h2>
																	<div id="accor_nesting7Examplecollapse2" class="accordion-collapse collapse show" aria-labelledby="accordionnesting7Example2" data-bs-parent="#accordionnesting7">
																		<div class="accordion-body">
																			<div class="container-fluid mp-5">
																				<div class="pt-4 mb-lg-3 pb-lg-4 profile-wrapper">
																					<div class="row d-flex align-items-center">
																						<div class="col-12 col-md-3 col-lg-2 col-sm-4 customer-details-img">
																							<div class="avatar-lg">
																								@if(@$customerdata->profile_pic)
																									<img src="{{Storage::Url($customerdata->profile_pic)}}" class="customers-name rounded-circle" alt="">
																								@else
																									<div class="customers-name rounded-circle"><p>{{@$customerdata->fname[0]}}</p></div>
																								@endif
																							</div>
																								
																						</div>
																						<!--end col-->
																						<div class="col-lg-7 col-md-6 col-sm-5 col-xs-12 col-12">
																							<div class="p-2 mmt-10 m-customer-detials">
																								<h3 class="mb-1 m-d-grid">{{$customerdata->full_name}} @if($customerdata->primary_account == '1') <span class="font-green fs-14">(Primary Account)</span> @endif </h3>
																								<h3> <span class="fs-14">Member Id {{@$customerdata->user->unique_user_id}}</span></h3>
																							</div>
																						</div>
																						<!--end col-->
																						<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12 col-lg-auto order-last order-lg-0">
																							<div class="flex-shrink-0 float-end small0width">
																								<div class="multiple-options">
																									<div class="setting-icon">
																										<i class="ri-more-fill"></i>
																										<ul id="catUl0">
																											<li><a href="#" data-bs-toggle="modal" data-bs-target=".editprofile" ><i class="fas fa-plus text-muted"></i>Edit Profile</a></li>
																											<li><a onclick="sendmailTocustomer({{$customerdata->id}},{{$customerdata->business_id}});"><i class="fas fa-plus text-muted"></i>Send Welcome Email</a></li>
																											<li><a href=""><i class="fas fa-plus text-muted"></i>Set Password</a></li>
																											<li><a href="{{route('business.orders.create',['business_id' =>$customerdata->business_id , 'cus_id' => $customerdata->id])}}"><i class="fas fa-plus text-muted"></i>Purchase</a></li>
																											<li class="dropdown-divider"></li>
																											<li><a data-business_id = "{{$customerdata->business_id}}" data-id="{{$customerdata->id}}" class="delcustomer"><i class="ri-delete-bin-fill align-bottom me-2 text-muted"></i>Delete Account</a>
																											</li>				
																										</ul>
																									</div>
																								</div>
																								<!--<a href="#" data-bs-toggle="modal" data-bs-target=".editprofile" class="btn btn-black small0width">
																									<i class="ri-edit-box-line align-bottom"></i> Edit Profile
																								</a>-->
																							</div>
																						</div>
																						<!--end col-->
																					</div>
																					<!--end row-->
																				</div>
																				<div class="card card-border">
																					<div class="card-body mcard-body-sp">
																						<div class="container-fluid">
																							<div class="row">
																								<div class="col-lg-6">
																									<div class="row mb-10">
																										<div class="col-lg-5 col-sm-5">
																											<label class="font-black">Email :</label>
																										</div>
																										<div class="col-lg-7 col-sm-7">
																											<span>{{$customerdata->email}}</span>
																										</div>
																									</div>
																									<div class="row mb-10">
																										<div class="col-lg-5 col-sm-5">
																											<label class="font-black">Phone Number :</label>
																										</div>
																										<div class="col-lg-7 col-sm-7">
																											<span>{{$customerdata->phone_number}} </span>
																										</div>
																									</div>
																									<div class="row mb-10">
																										<div class="col-lg-5 col-sm-5">
																											<label class="font-black">Address :</label>
																										</div>
																										<div class="col-lg-7 col-sm-7">
																											<span>{{$customerdata->full_address()}}</span>
																										</div>
																									</div>
																									<div class="row mb-10">
																										<div class="col-lg-5 col-sm-5">
																											<label class="font-black">Last Visited :</label>
																										</div>
																										<div class="col-lg-7 col-sm-7">
																											<span>{{$customerdata->get_last_seen() ?? 'N/A'}}</span>
																										</div>
																									</div>
																									<div class="row mb-10">
																										<div class="col-lg-5 col-sm-5">
																											<label class="font-black">Birthday :</label>
																										</div>
																										<div class="col-lg-7 col-sm-7">
																											<span>@if($customerdata->birthdate != '' ) {{date('m/d/Y',strtotime($customerdata->birthdate))}} @else N/A @endif</span>
																										</div>
																									</div>

																									<div class="row mb-10"> 
																										<div class="col-lg-5 col-sm-5">
																											<label class="font-black">Your Self Check-In Code :</label>
																										</div>
																										<div class="col-lg-7 col-sm-7">
																											<span class="mr-25">{{$customerdata->user->unique_code}}</span>
																											<a href="#" data-bs-toggle="modal" data-bs-target="#check-in-code">(Add/Edit)</a>
																										</div>
																									</div>

																								</div>
																									
																								<div class="col-lg-6">
																									<div class="row mb-10">
																										<div class="col-lg-5 col-sm-5">
																											<label class="font-black">Age :</label>
																										</div>
																										<div class="col-lg-7 col-sm-7">
																											<span>{{$customerdata->age != '' ? $customerdata->age." Years Old" : "N/A" }}</span>
																										</div>
																									</div>
																									<div class="row mb-10">
																										<div class="col-lg-5 col-sm-5">
																											<label class="font-black">Gender :</label>
																										</div>
																										<div class="col-lg-7 col-sm-7">
																											<span>{{$customerdata->gender != null || $customerdata->gender != '' ? $customerdata->gender : "N/A" }}</span>
																										</div>
																									</div>
																									<div class="row mb-10">
																										<div class="col-lg-5 col-sm-5">
																											<label class="font-black">Location :</label>
																										</div>
																										<div class="col-lg-7 col-sm-7">
																											<span>{{$customerdata->country}}</span>
																										</div>
																									</div>
																									<div class="row mb-10"> 
																										<div class="col-lg-5 col-sm-5">
																											<label class="font-black">Member Since :</label>
																										</div>
																										<div class="col-lg-7 col-sm-7">
																											<span>{{date('m/d/Y',strtotime($customerdata->created_at))}}</span>
																										</div>
																									</div>

																									<div class="row mb-10"> 
																										<div class="col-lg-5 col-sm-5">
																											<label class="font-black">Member Id :</label>
																										</div>
																										<div class="col-lg-7 col-sm-7">
																											<span>{{@$customerdata->user->unique_user_id}}</span>
																										</div>
																									</div>
																								</div>
																							</div>
																						</div>
																					</div><!-- end card body -->
																				</div>
																				<div class="card card-border">
																					<div class="card-body mcard-body-sp">
																						<div class="container-fluid">
																							<div class="row">
																								<div class="col-lg-12">
																									<div class="customer-info">
																										<h4 class="card-title mb-15 flex-grow-1">Customer Information</h4>
																									</div>						
																								</div>
																							</div>
																							<div class="row">
																								<div class="col-lg-6">
																									<div class="row mb-10">
																										<div class="col-lg-6 col-sm-6">
																											<label class="font-black">Status</label>
																										</div>
																										<div class="col-lg-6 col-sm-6">
																											<span class="@if($customerdata->is_active() == 'InActive') font-red-fonts @else font-green @endif ">{{$customerdata->is_active()}}</span>
																											
																										</div>
																									</div>
																									<div class="row mb-10">
																										<div class="col-lg-6 col-sm-6">
																											<label class="font-black">Activities Booked</label>
																										</div>
																										<div class="col-lg-6 col-sm-6">
																											<span>{{$customerdata->memberships()}}</span>
																										</div>
																									</div>
																									<div class="row mb-10">
																										<div class="col-lg-6 col-sm-6">
																											<label class="font-black">Money Spent</label>
																										</div>
																										<div class="col-lg-6 col-sm-6">
																											<span>$ {{$customerdata->total_spend()}}</span>
																										</div>
																									</div>

																									<div class="row mb-10">
																										<div class="col-lg-6 col-sm-6">
																											<label class="font-black">Total Attendance</label>
																										</div>
																										<div class="col-lg-6 col-sm-6">
																											<span>{{$customerdata->visits_count()}}</span>
																										</div>
																									</div>

																								</div>
																								<div class="col-lg-6">
																									<div class="row mb-10">
																										<div class="col-lg-6 col-sm-6">
																											<label class="font-black">Number of Visits</label>
																										</div>
																										<div class="col-lg-6 col-sm-6">
																											<span>{{$customerdata->visits_count()}}</span>
																										</div>
																									</div>
																									<div class="row mb-10">
																										<div class="col-lg-6 col-sm-6">
																											<label class="font-black">Active Memberships</label>
																										</div>
																										<div class="col-lg-6 col-sm-6">
																											<span class="font-green">{{$customerdata->active_memberships()->get()->count()}}</span>
																										</div>
																									</div>
																									<div class="row mb-10">
																										<div class="col-lg-6 col-sm-6">
																											<label class="font-black">Expiring Memberships</label>
																										</div>
																										<div class="col-lg-6 col-sm-6">
																											<span>{{$customerdata->expired_soon()}}</span>
																										</div>
																									</div>

																									<div class="row mb-10">
																										<div class="col-lg-6 col-sm-6">
																											<label class="font-black">Completed Membership</label>
																										</div>
																										<div class="col-lg-6 col-sm-6">
																											<span>{{$customerdata->complete_booking_details()->count()}}</span>
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
																
															   <div class="accordion nesting2-accordion custom-accordionwithicon accordion-border-box mt-2" id="accordionnesting2">
																	<div class="accordion-item shadow">
																		<h2 class="accordion-header" id="accordionnesting2Example1">
																			<button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#accor_nesting2Examplecollapse1" aria-expanded="false" aria-controls="accor_nesting2Examplecollapse1">
																				Membership Details 
																			</button>
																		</h2>
																		<div id="accor_nesting2Examplecollapse1" class="accordion-collapse collapse " aria-labelledby="accordionnesting2Example1" data-bs-parent="#accordionnesting2">
																			<div class="accordion-body">
																				
																				<div class="accordion nesting4-accordion custom-accordionwithicon accordion-border-box mt-3" id="accordionnesting4">
																					<div class="accordion-item shadow">
																						<h2 class="accordion-header" id="accordionnesting4Example2">
																							<button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#accor_nesting4Examplecollapse2" aria-expanded="false" aria-controls="accor_nesting4Examplecollapse2">
																								Active Memberships ({{$active_memberships->count()}})
																							</button>
																						</h2>
																						<div id="accor_nesting4Examplecollapse2" class="accordion-collapse collapse" aria-labelledby="accordionnesting4Example2" data-bs-parent="#accordionnesting4">
																							<div class="accordion-body">
																								@foreach ($active_memberships as $i=>$booking_detail)
																								<div class="accordion nesting4-accordion custom-accordionwithicon accordion-border-box mt-3" id="accordionnestinga{{$i}}">
																									<div class="accordion-item shadow">
																										<h2 class="accordion-header" id="accordionnesting4Examplea{{$i}}}">
																											<button class="accordion-button collapsed mp-6" type="button" data-bs-toggle="collapse" data-bs-target="#accor_nesting4Examplecollapsea{{$i}}" aria-expanded="false" aria-controls="accor_nesting4Examplecollapse2">
																												<div class="container-fluid nopadding">
																													<div class="row mini-stats-wid d-flex align-items-center ">
																														<div class="col-lg-10 col-md-10 col-8"> {{@$booking_detail->business_services_with_trashed->program_name}} - {{@$booking_detail->business_price_detail_with_trashed->business_price_details_ages_with_trashed->category_title}} @if($booking_detail->contract_date) | Started On {{date('m/d/Y',strtotime(@$booking_detail->contract_date))}} @endif  @if($booking_detail->expired_at) | Expires On {{date('m/d/Y',strtotime(@$booking_detail->expired_at))}} @endif </div>
																														
																														<div class="col-lg-2 col-md-2 col-4">
																															<div class="multiple-options">
																																<div class="setting-icon">
																																	<i class="ri-more-fill"></i>
																																	<ul>
																																		<li>
																																			<a class="visiting-view" data-behavior="ajax_html_modal" data-url="{{route('visit_modal', ['business_id' => request()->business_id, 'id' => $customerdata->id, 'booking_detail_id' => @$booking_detail->id])}}" data-modal-width="modal-70" ><i class="fas fa-plus text-muted">
																																			</i> View Visits </a>
																																		</li>
																																		<li>
																																			<a class="edit-booking-customer" data-behavior="ajax_html_modal" data-url="{{route('visit_membership_modal', ['business_id' => request()->business_id, 'id' => $customerdata->id,'booking_detail_id' => @$booking_detail->id , 'booking_id' => @$booking_detail->booking_id])}}" data-modal-width="modal-50"> <i class="fas fa-plus text-muted">
																																			</i>Edit Booking </a>
																																		</li>
																																		<li>
																																			<a class="edit-booking-customer" data-behavior="ajax_html_modal" data-url="{{route('void_or_refund_modal', ['business_id' => request()->business_id, 'id' => $customerdata->id,'booking_detail_id' => @$booking_detail->id , 'booking_id' => @$booking_detail->booking_id])}}" data-modal-width="modal-50"> <i class="fas fa-plus text-muted">
																																			</i>Refund or Void</a>
																																		</li>
																																		<li>
																																			<a class="edit-booking-customer" data-behavior="ajax_html_modal" data-url="{{route('terminate_or_suspend_modal', ['business_id' => request()->business_id, 'id' => $customerdata->id,'booking_detail_id' => @$booking_detail->id , 'booking_id' => @$booking_detail->booking_id])}}" data-modal-width="modal-50"> <i class="fas fa-plus text-muted">
																																			</i>Suspend or Terminate</a>
																																		</li>
																																		<li>
																																			<a class="edit-booking-customer" data-behavior="ajax_html_modal" data-url="{{route('business.recurring.index', ['business_id' => request()->business_id, 'customer_id' => $customerdata->id, 'booking_detail_id' => @$booking_detail->id ,'type'=>'schedule'])}}" data-modal-width="modal-50" data-reload="1"><i class="fas fa-plus text-muted">
																																			</i>Autopay Schedule</a>
																																		</li>
																																		<li>
																																			<a class="edit-booking-customer" data-behavior="ajax_html_modal" data-url="{{route('business.recurring.index', ['business_id' => request()->business_id, 'customer_id' => $customerdata->id, 'booking_detail_id' => @$booking_detail->id ,'type'=>'history'])}}" data-modal-width="modal-50"><i class="fas fa-plus text-muted">
																																			</i>Autopay History</a>
																																		</li>
																																	</ul>
																																</div>
																															</div>
																														</div>
																													</div>
																												</div>
																											</button>
																										</h2>
																										<div id="accor_nesting4Examplecollapsea{{$i}}" class="accordion-collapse collapse" aria-labelledby="accordionnesting4Examplea{{$i}}}" data-bs-parent="#accordionnestinga{{$i}}">
																											<div class="accordion-body">
																												<div class="mb-10">
																													<div class="red-separator mb-10">
																														<div class="container-fluid nopadding">
																															<div class="row">
																																<div class="col-lg-6 col-md-6 col-sm-6 col-6">
																																	<div class="inner-accordion-titles">
																																		<label>{{@$booking_detail->business_services_with_trashed->program_name}}</label>	
																																	</div>
																																</div>
																																<div class="col-lg-6 col-md-6 col-sm-6 col-6">
																																	<div class="inner-accordion-titles float-end text-right line-break">
																																		<span>Remaining {{@$booking_detail->getRemainingSessionAfterAttend()}}/{{@$booking_detail->pay_session}}</span> 
																																		<a class="mailRecipt" data-behavior="send_receipt" data-url="{{route('receiptmodel',['orderId'=> @$booking_detail->booking_id ,'customer'=>$customerdata->id ])}}" data-item-type="no" data-modal-width="modal-70" >
																																			<i class="far fa-file-alt" aria-hidden="true"></i></a>
																																	</div>
																																</div>
																															</div>
																														</div>
																													</div>
																												
																													<div class="container-fluid nopadding">
																														<div class="row">
																															<div class="col-lg-6 col-md-6 col-sm-6 col-6">
																																<div class="line-break">
																																	<label>BOOKING # </label>
																																</div>
																															</div>
																															<div class="col-lg-6 col-md-6 col-sm-6 col-6">
																																<div class="float-end line-break text-right">
																																	<span> {{@$booking_detail->booking->order_id}} </span>
																																</div>
																															</div>
																														
																															<div class="col-lg-6 col-md-6 col-sm-6 col-6">
																																<div class="line-break">
																																	<label>TOTAL PRICE </label>
																																</div>
																															</div>
																															<div class="col-lg-6 col-md-6 col-sm-6 col-6">
																																<div class="float-end line-break text-right">
																																	<span> ${{@$booking_detail->booking->amount}} </span>
																																</div>
																															</div>
																														
																															<div class="col-lg-6 col-md-6 col-sm-6 col-6">
																																<div class="line-break">
																																	<label>PAYMENT TYPE:</label>
																																</div>
																															</div>
																															<div class="col-lg-6 col-md-6 col-sm-6 col-6">
																																<div class="float-end line-break text-right">
																																	<span>{{@$booking_detail->booking->getPaymentDetail()}}</span>
																																</div>
																															</div>
																														
																															<div class="col-lg-6 col-md-6 col-sm-6 col-6">
																																<div class="line-break">
																																	<label>TOTAL REMAINING:</label>
																																</div>
																															</div>
																															<div class="col-lg-6 col-md-6 col-sm-6 col-6">
																																<div class="float-end line-break text-right">
																																	<span>{{@$booking_detail->getRemainingSessionAfterAttend()}}/{{@$booking_detail->pay_session}}</span>
																																</div>
																															</div>
																														
																															<div class="col-lg-6 col-md-6 col-sm-6 col-6">
																																<div class="line-break">
																																	<label>PROGRAM NAME:</label>
																																</div>
																															</div>
																															<div class="col-lg-6 col-md-6 col-sm-6 col-6">
																																<div class="float-end line-break text-right">
																																	<span>{{@$booking_detail->business_services_with_trashed->program_name}} </span>
																																</div>
																															</div>

																															<div class="col-lg-6 col-md-6 col-sm-6 col-6">
																																<div class="line-break">
																																	<label>CATEGORY NAME:</label>
																																</div>
																															</div>
																															<div class="col-lg-6 col-md-6 col-sm-6 col-6">
																																<div class="float-end line-break text-right">
																																	<span>{{@$booking_detail->businessPriceDetailsAgesTrashed->category_title}} </span>
																																</div>
																															</div>

																															<div class="col-lg-6 col-md-6 col-sm-6 col-6">
																																<div class="line-break">
																																	<label>PRICE OPTION:</label>
																																</div>
																															</div>
																															<div class="col-lg-6 col-md-6 col-sm-6 col-6">
																																<div class="float-end line-break text-right">
																																	<span>{{@$booking_detail->business_price_detail_with_trashed->price_title}} </span>
																																</div>
																															</div>
																															
																															<div class="col-lg-6 col-md-6 col-sm-6 col-6">
																																<div class="line-break">
																																	<label>ACTIVATION START DATE:</label>
																																</div>
																															</div>
																															<div class="col-lg-6 col-md-6 col-sm-6 col-6">
																																<div class="float-end line-break text-right">
																																	<span> @if($booking_detail->contract_date) {{date('m/d/Y',strtotime(@$booking_detail->contract_date))}} @else N/A  @endif</span>
																																</div>
																															</div>

																															<div class="col-lg-6 col-md-6 col-sm-6 col-6">
																																<div class="line-break">
																																	<label>EXPIRATION DATE:</label>
																																</div>
																															</div>
																															<div class="col-lg-6 col-md-6 col-sm-6 col-6">
																																<div class="float-end line-break text-right">
																																	<span>@if($booking_detail->expired_at)  {{date('m/d/Y',strtotime(@$booking_detail->expired_at))}} @else N/A @endif</span>
																																</div>
																															</div>
																														
																															<div class="col-lg-6 col-md-6 col-sm-6 col-6">
																																<div class="line-break">
																																	<label>DATE BOOKED:	</label>
																																</div>
																															</div>
																															<div class="col-lg-6 col-md-6 col-sm-6 col-6">
																																<div class="float-end line-break text-right">
																																	<span>{{date('m/d/Y',strtotime(@$booking_detail->created_at))}}</span>
																																</div>
																															</div>
																															
																															@if (@$booking_detail->business_services_with_trashed)
																															<div class="col-lg-6 col-md-6 col-sm-6 col-6">
																																<div class="line-break">
																																	<label>BOOKING TIME: </label>
																																</div>
																															</div>
																															<div class="col-lg-6 col-md-6 col-sm-6 col-6">
																																<div class="float-end line-break text-right">
																																	<span> {{date('h:i A', strtotime(@$booking_detail->business_services_with_trashed->shift_start))}}</span>
																																</div>
																															</div>
																															@endif

																															@if (@$booking_detail->customer)
																																<div class="col-lg-6 col-md-6 col-sm-6 col-6">
																																	<div class="line-break">
																																		<label>BOOKED BY:</label>
																																	</div>
																																</div>
																																<div class="col-lg-6 col-md-6 col-sm-6 col-6">
																																	<div class="float-end line-break text-right">
																																		<span>{{@$booking_detail->customer->fname}} {{@$booking_detail->customer->lname}} (In person)</span>
																																	</div>
																																</div>
																															@endif
																															
																															@if (@$booking_detail->business_services_with_trashed)
																																<div class="col-lg-6 col-md-6 col-sm-6 col-6">
																																	<div class="line-break">
																																		<label>ACTIVITY TYPE:</label>
																																	</div>
																																</div>
																																<div class="col-lg-6 col-md-6 col-sm-6 col-6">
																																	<div class="float-end line-break text-right">
																																		<span>{{@$booking_detail->business_services_with_trashed->sport_activity}}</span>
																																	</div>
																																</div>
																															@endif

																															@if (@$booking_detail->business_services_with_trashed)
																																<div class="col-lg-6 col-md-6 col-sm-6 col-6">
																																	<div class="line-break">
																																		<label>SERVICE TYPE:</label>
																																	</div>
																																</div>
																																<div class="col-lg-6 col-md-6 col-sm-6 col-6">
																																	<div class="float-end line-break text-right">
																																		<span>{{@$booking_detail->business_services_with_trashed->formal_service_types()}}</span>
																																	</div>
																																</div>
																															@endif
																														</div>
																													</div>
																												</div>
																											</div>
																										</div>
																									</div>
																								</div>
																								@endforeach
																							</div>
																						</div>
																					</div>
																				</div>
																				
																				<div class="accordion nesting5-accordion custom-accordionwithicon accordion-border-box mt-3" id="accordionnesting5">
																					<div class="accordion-item shadow">
																						<h2 class="accordion-header" id="accordionnesting5Example2">
																							<button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#accor_nesting5Examplecollapse2" aria-expanded="false" aria-controls="accor_nesting5Examplecollapse2">
																								 Completed Memberships ({{$complete_booking_details->count()}})
																							</button>
																						</h2>
																						<div id="accor_nesting5Examplecollapse2" class="accordion-collapse collapse" aria-labelledby="accordionnesting5Example2" data-bs-parent="#accordionnesting5">
																							<div class="accordion-body">
																								@foreach ($complete_booking_details as $i=>$booking_detail)
																									<div class="accordion nesting5-accordion custom-accordionwithicon accordion-border-box mt-3" id="accordionnestingc{{$i}}">
																										<div class="accordion-item shadow">
																											<h2 class="accordion-header" id="accordionnesting01Examplec{{$i}}">
																												<button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#accor_nesting01Examplecollapsec{{$i}}" aria-expanded="false" aria-controls="accor_nesting01Examplecollapsec{{$i}}">
																													 <div class="container-fluid nopadding">
																														<div class="row mini-stats-wid d-flex align-items-center ">
																															<div class="col-lg-10 col-md-8 col-8">
																																{{@$booking_detail->business_services_with_trashed->program_name}} - {{@$booking_detail->business_price_detail_with_trashed->business_price_details_ages_with_trashed->category_title}}
																																
																																@if($booking_detail->status == 'refund')
																																	  | <span class="font-red">  Status: Refunded on {{date('m/d/Y',strtotime($booking_detail->refund_date))}} by {{$booking_detail->refunded_person}}	</span>
																																@endif

																																@if($booking_detail->status == 'terminate')
																																	| <span class="font-red">  Status: Terminated on {{date('m/d/Y',strtotime($booking_detail->terminated_at))}}  by {{$booking_detail->terminated_person}}		</span>
																																@endif

																																@if($booking_detail->status == 'suspend')
																																	| <span class="font-red"> Status: Freeze from {{date('m/d/Y',strtotime($booking_detail->suspend_started))}}	to {{date('m/d/Y',strtotime($booking_detail->suspend_ended))}} by {{$booking_detail->suspended_person}}	 </span>
																																	
																																@endif

																																@if($booking_detail->status == 'void')
																																	| <span class="font-red">  Status: Void </span>
																																@endif						
																															</div>
																															<div class="col-lg-2 col-md-4 col-4">
																																<div class="multiple-options">
																																	<div class="setting-icon">
																																		<i class="ri-more-fill"></i>
																																		<ul>
																																			<li>
																																			<a class="edit-booking-customer" data-behavior="ajax_html_modal" data-url="{{route('visit_membership_modal', ['business_id' => request()->business_id, 'id' => $customerdata->id,'booking_detail_id' => @$booking_detail->id , 'booking_id' => @$booking_detail->booking_id])}}" data-modal-width="modal-50"> <i class="fas fa-plus text-muted">
																																			</i>Edit Booking </a>
																																		</li>
																																			<li><a class="visiting-view" data-behavior="ajax_html_modal" data-url="{{route('visit_modal', ['business_id' => request()->business_id, 'id' => $customerdata->id, 'booking_detail_id' => @$booking_detail->id])}}" data-modal-width="modal-70" >
																																					<i class="fas fa-plus text-muted"></i> View Visits </a>
																																			</li>
																																			<li>
																																				<a class="edit-booking-customer" data-behavior="ajax_html_modal" data-url="{{route('business.recurring.index', ['business_id' => request()->business_id, 'customer_id' => $customerdata->id, 'booking_detail_id' => @$booking_detail->id ,'type'=>'schedule'])}}" data-modal-width="modal-50" data-reload="1"><i class="fas fa-plus text-muted">
																																				</i>Autopay Schedule</a>
																																			</li>
																																			<li>
																																				<a class="edit-booking-customer" data-behavior="ajax_html_modal" data-url="{{route('business.recurring.index', ['business_id' => request()->business_id, 'customer_id' => $customerdata->id, 'booking_detail_id' => @$booking_detail->id ,'type'=>'history'])}}" data-modal-width="modal-50"><i class="fas fa-plus text-muted">
																																				</i>Autopay History</a>
																																			</li>
																																		</ul>
																																	</div>
																																</div>
																															</div>
																														</div>
																													</div>
																												</button>
																											</h2>
																											<div id="accor_nesting01Examplecollapsec{{$i}}" class="accordion-collapse collapse" aria-labelledby="accordionnesting01Examplec{{$i}}" data-bs-parent="#accordionnestingc{{$i}}">
																												<div class="accordion-body">
																													<div class="mb-10">
																														<div class="red-separator mb-10">
																															<div class="container-fluid nopadding">
																																<div class="row">
																																	<div class="col-lg-6 col-md-6 col-sm-6 col-6">
																																		<div class="inner-accordion-titles">
																																			<label> {{@$booking_detail->business_services_with_trashed->program_name}}</label>	
																																		</div>
																																	</div>
																																</div>
																															</div>
																														</div>
																													
																														<div class="container-fluid nopadding">
																															<div class="row">
																																<div class="col-lg-6 col-md-6 col-sm-6 col-6">
																																	<div class="line-break">
																																		<label>BOOKING # </label>
																																	</div>
																																</div>
																																<div class="col-lg-6 col-md-6 col-sm-6 col-6">
																																	<div class="float-end line-break text-right">
																																		<span> {{@$booking_detail->booking->order_id}} </span>
																																	</div>
																																</div>
																															
																																<div class="col-lg-6 col-md-6 col-sm-6 col-6">
																																	<div class="line-break">
																																		<label>TOTAL PRICE </label>
																																	</div>
																																</div>
																																<div class="col-lg-6 col-md-6 col-sm-6 col-6">
																																	<div class="float-end line-break text-right">
																																		<span>  ${{@$booking_detail->booking->amount}} </span>
																																	</div>
																																</div>
																															
																																<div class="col-lg-6 col-md-6 col-sm-6 col-6">
																																	<div class="line-break">
																																		<label>PAYMENT TYPE:</label>
																																	</div>
																																</div>
																																<div class="col-lg-6 col-md-6 col-sm-6 col-6">
																																	<div class="float-end line-break text-right">
																																		<span>{{@$booking_detail->booking->getPaymentDetail()}}</span>
																																	</div>
																																</div>
																																
																																@if (@$booking_detail->business_price_detail_with_trashed)
																																	<div class="col-lg-6 col-md-6 col-sm-6 col-6">
																																		<div class="line-break">
																																			<label>TOTAL REMAINING:</label>
																																		</div>
																																	</div>
																																	<div class="col-lg-6 col-md-6 col-sm-6 col-6">
																																		<div class="float-end line-break text-right">
																																			<span>{{@$booking_detail->getRemainingSessionAfterAttend()}}/{{@$booking_detail->pay_session}}</span>
																																		</div>
																																	</div>
																																@endif
																																
																																<div class="col-lg-6 col-md-6 col-sm-6 col-6">
																																	<div class="line-break">
																																		<label>PROGRAM NAME:</label>
																																	</div>
																																</div>
																																<div class="col-lg-6 col-md-6 col-sm-6 col-6">
																																	<div class="float-end line-break text-right">
																																		@if (@$booking_detail->business_services_with_trashed)
																																			<span>{{@$booking_detail->business_services_with_trashed->program_name}} </span>
																																		@endif
																																	</div>
																																</div>

																																<div class="col-lg-6 col-md-6 col-sm-6 col-6">
																																	<div class="line-break">
																																		<label>CATEGORY NAME:</label>
																																	</div>
																																</div>
																																<div class="col-lg-6 col-md-6 col-sm-6 col-6">
																																	<div class="float-end line-break text-right">
																																		<span>{{@$booking_detail->businessPriceDetailsAgesTrashed->category_title}} </span>
																																	</div>
																																</div>

																																<div class="col-lg-6 col-md-6 col-sm-6 col-6">
																																	<div class="line-break">
																																		<label>PRICE OPTION:</label>
																																	</div>
																																</div>
																																<div class="col-lg-6 col-md-6 col-sm-6 col-6">
																																	<div class="float-end line-break text-right">
																																		<span>{{@$booking_detail->business_price_detail_with_trashed->price_title}} </span>
																																	</div>
																																</div>

																																<div class="col-lg-6 col-md-6 col-sm-6 col-6">
																																	<div class="line-break">
																																		<label>ACTIVATION START DATE:</label>
																																	</div>
																																</div>
																																<div class="col-lg-6 col-md-6 col-sm-6 col-6">
																																	<div class="float-end line-break text-right">
																																		<span> {{date('m/d/Y',strtotime(@$booking_detail->contract_date))}}</span>
																																	</div>
																																</div>
																															
																																<div class="col-lg-6 col-md-6 col-sm-6 col-6">
																																	<div class="line-break">
																																		<label>EXPIRATION DATE:</label>
																																	</div>
																																</div>
																																<div class="col-lg-6 col-md-6 col-sm-6 col-6">
																																	<div class="float-end line-break text-right">
																																		<span> {{date('m/d/Y',strtotime(@$booking_detail->expired_at))}}</span>
																																	</div>
																																</div>
																															
																																<div class="col-lg-6 col-md-6 col-sm-6 col-6">
																																	<div class="line-break">
																																		<label>DATE BOOKED:	</label>
																																	</div>
																																</div>
																																<div class="col-lg-6 col-md-6 col-sm-6 col-6">
																																	<div class="float-end line-break text-right">
																																		<span>{{date('m/d/Y',strtotime(@$booking_detail->created_at))}}</span>
																																	</div>
																																</div>
																																
																																@if (@$booking_detail->business_services_with_trashed)
																																	<div class="col-lg-6 col-md-6 col-sm-6 col-6">
																																		<div class="line-break">
																																			<label>BOOKING TIME: </label>
																																		</div>
																																	</div>
																																	<div class="col-lg-6 col-md-6 col-sm-6 col-6">
																																		<div class="float-end line-break text-right">
																																			<span> {{date('h:i A', strtotime(@$booking_detail->business_services_with_trashed->shift_start))}}</span>
																																		</div>
																																	</div>
																																@endif
																																@if (@$booking_detail->customer)
																																	<div class="col-lg-6 col-md-6 col-sm-6 col-6">
																																		<div class="line-break">
																																			<label>BOOKED BY:</label>
																																		</div>
																																	</div>
																																	<div class="col-lg-6 col-md-6 col-sm-6 col-6">
																																		<div class="float-end line-break text-right">
																																			<span>{{@$booking_detail->customer->fname}} {{@$booking_detail->customer->lname}} (In person)</span>
																																		</div>
																																	</div>
																																@endif
																																
																																@if (@$booking_detail->business_services_with_trashed)
																																	<div class="col-lg-6 col-md-6 col-sm-6 col-6">
																																		<div class="line-break">
																																			<label>ACTIVITY TYPE:</label>
																																		</div>
																																	</div>
																																	<div class="col-lg-6 col-md-6 col-sm-6 col-6">
																																		<div class="float-end line-break text-right">
																																			<span>{{@$booking_detail->business_services_with_trashed->sport_activity}}</span>
																																		</div>
																																	</div>
																																@endif
																																
																																@if (@$booking_detail->business_services_with_trashed)
																																	<div class="col-lg-6 col-md-6 col-sm-6 col-6">
																																		<div class="line-break">
																																			<label>SERVICE TYPE:</label>
																																		</div>
																																	</div>
																																	<div class="col-lg-6 col-md-6 col-sm-6 col-6">
																																		<div class="float-end line-break text-right">
																																			<span>{{@$booking_detail->business_services_with_trashed->formal_service_types()}}</span>
																																		</div>
																																	</div>
																																@endif
																															</div>
																														</div>
																													</div>
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
																		
																	@php
																		$totalPaid = 0;
																	@endphp

																	@foreach ($purchase_history as $history) 
																	    @if($history->item_description(request()->business_id)['itemDescription'] != '')
																	        @php
																	            $totalPaid += $history->amount;
																	        @endphp
																	    @endif
																	@endforeach
																	<div class="accordion-item shadow">
																			<h2 class="accordion-header" id="accordionnesting2Example2">
																				<button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#accor_nesting2Examplecollapse2" aria-expanded="false" aria-controls="accor_nesting2Examplecollapse2">
																					Purchase history - total ${{$totalPaid}}  
																				</button>
																			</h2>
																			<div id="accor_nesting2Examplecollapse2" class="accordion-collapse collapse" aria-labelledby="accordionnesting2Example2" data-bs-parent="#accordionnesting2">
																				<div class="accordion-body">
																					<div class="purchase-history">
																						<div class="table-responsive">
																							<table class="table mb-0">
																								<thead>
																									<tr>
																										<th>Sale Date </th>
																										<th>Item Description </th>
																										<th>Item Type</th>
																										<th>Pay Method</th>
																										<th>Price</th>
																										<th>Qty</th>
																										<th>Refund/Void</th>
																										<th>Receipt</th>
																									</tr>
																								</thead>
																								<tbody>
																									@foreach($purchase_history as $history) 
																										@if($history->item_description(request()->business_id)['itemDescription'] != '' )
																										<tr>
																											<td>@if($history->created_at) {{date('m/d/Y',strtotime($history->created_at))}} @else N/A @endif </td>
																											<td>{!!$history->item_description(request()->business_id)['itemDescription']!!}</td>
																											<td>{{$history->item_type_terms()}}</td>
																											<td>{{$history->getPmtMethod()}}</td>
																											<td>${{$history->amount}}</td>
																											<td>{{$history->item_description(request()->business_id)['qty']}}</td>
																											<td>
																												@if(($history->can_void() && $history->item_type=="UserBookingStatus") || ($history->can_refund()))
																													<a href="#" data-behavior="ajax_html_modal" data-url="{{route('void_or_refund_modal', ['business_id' => request()->business_id, 'id' => $customerdata->id,'booking_detail_id' => @$booking_detail->id , 'booking_id' => @$booking_detail->booking_id])}}" data-modal-width="modal-100">Void</a>

																												@else
																													{{$history->status}}
																												@endif
																											</td>
																											<td><a  class="mailRecipt" data-behavior="send_receipt" data-url="{{route('receiptmodel',['orderId'=>$history->item_id,'customer'=>$customerdata->id])}}" data-item-type="{{$history->item_type_terms()}}" data-modal-width="modal-70" ><i class="far fa-file-alt" aria-hidden="true"></i></a>
																											</td>
																										</tr>
																										@endif
																									@endforeach
																								</tbody>
																							</table>
																						</div>
																				</div>
																			</div>
																		</div>
																	</div>
																	
																	<div class="accordion-item shadow">
																		<h2 class="accordion-header" id="accordionnesting8Example2">
																			<button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#accor_nesting8Examplecollapse2" aria-expanded="false" aria-controls="accor_nesting8Examplecollapse2">
																				<div class="container-fluid nopadding">
																					<div class="row  y-middle">
																						<div class="col-lg-6 col-md-6 col-8">
																							Connected Family Accounts ({{count($customerdata->get_families())}})
																						</div>
																						<div class="col-lg-6 col-md-6 col-4">
																							<div class="multiple-options">
																								<div class="setting-icon">
																									<i class="ri-more-fill"></i>
																									  <ul>
																											<li><a href="#" onclick="redirctAddfamily({{$customerdata->id}});"><i class="fas fa-plus text-muted"></i>Add</a></li>
																										</ul>
																								</div>
																							</div>
																						</div>
																					</div>
																				</div>
																			</button>
																		</h2>
																		<div id="accor_nesting8Examplecollapse2" class="accordion-collapse collapse" aria-labelledby="accordionnesting8Example2" data-bs-parent="#accordionnesting8">
																			<div class="accordion-body">
																				<div class="row">
																					<div class="col-md-12">
																						<form class="app-search d-none d-md-block mb-10 float-right">
																							<div class="position-relative">
																								<input type="text" class="form-control ui-autocomplete-input" placeholder="Search for family member" autocomplete="off" id="serchFamilyMember" name="fname" value="">
																							</div>
																						</form>
																					</div>						
																				</div>
																				
																				<div class="purchase-history">
																					<div class="table-responsive">
																						<table class="table mb-0">
																							<thead>
																								<tr>
																									<th>Name</th>
																									<th>Relationship</th>
																									<th>Age</th>
																									<th class="action-width">Action</th>
																								</tr>
																							</thead>
																							<tbody>
																								@foreach($customerdata->get_families() as $index=>$family_member)
																								<tr>
																									<td> {{$family_member->full_name}} </td>
																									<td>{{$family_member->relationship ?? "N/A"}}</td>
																									<td>{{$family_member->age ?? "N/A"}}</td>
																									<td class="text-center">
																										<a onclick="deleteMember('{{$family_member->id}}')" class="btn btn-red mmb-10">Delete</a>

																										<a href="#" trget="_blank" onclick="redirctAddfamily({{$customerdata->id}});" class="btn btn-black mmb-10">Edit</a>

																										<a href="{{route('business_customer_show',['business_id' => request()->business_id, 'id'=>$family_member->id])}}" class="btn btn-red mmb-10">View</a></td>
																									
																								</tr>
																								@endforeach
																							</tbody>
																						</table>
																					</div>
																				</div>
																			</div>
																		</div>
																	</div>

																	<div class="accordion-item shadow">
																		<h2 class="accordion-header" id="accordionnesting6Example2">
																			<button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#accor_nesting6Examplecollapse2" aria-expanded="false" aria-controls="accor_nesting6Examplecollapse2">
																				Attendance History
																			</button>
																		</h2>
																		<div id="accor_nesting6Examplecollapse2" class="accordion-collapse collapse" aria-labelledby="accordionnesting6Example2" data-bs-parent="#accordionnesting6">
																			<div class="accordion-body">
																				<div class="row">
																					<div class="col-md-12 col-xs-12">
																						<div class="visit-table-data">
																							<label>Total Number of Visits:</label>
																							<span>{{$customerdata->visits_count()}}</span>
																						</div>
																					</div>
																				</div>
																				<div class="purchase-history">
																					<div class="table-responsive">
																						<table class="table mb-0">
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
																								 	@if($visit->order_detail)
																										<tr>
																											<td>@if($visit->checkin_date) {{date('m/d/Y',strtotime($visit->checkin_date))}} @else N/A @endif</td>
																											<td>
																												{{date('h:i A', strtotime($visit->checked_at))}}
																											</td>
																											<td>{{$visit->order_detail->business_services_with_trashed->program_name}}</td>
																											<td>{{$visit->order_detail->business_price_detail_with_trashed->price_title}}</td>
																											
																											<td>
																												@if($visit->status_term())
																													{{$visit->status_term()}}
																												@else
																													<a class="font-red" onclick="getCheckInDetailsModel({{$visit->order_detail->business_id}}, {{$visit->business_activity_scheduler_id}} ,'{{$visit->checkin_date}}','{{$customerdata->id}}');">Unprocess</a>
																												@endif
																												
																											</td>
																											<td>{{ App\BusinessStaff::getinstructorname($visit->order_detail->business_services_with_trashed->instructor_id)}}</td>
																										</tr>
																									@endif
																								@endforeach
																							</tbody>
																						</table>
																					</div>
																				</div>
																			</div>
																		</div>
																	</div>
																	
																	<div class="accordion-item shadow">
																		<h2 class="accordion-header" id="accordionnesting9Example2">
																			<button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#accor_nesting9Examplecollapse2" aria-expanded="false" aria-controls="accor_nesting9Examplecollapse2">
																				<div class="container-fluid nopadding">
																				   <div class="row y-middle">
																					   <div class="col-lg-6 col-md-6 col-8">
																						  	Credit Card Info     <span class="font-green ml-15">  CC  </span>  ({{$customerdata->stripePaymentMethods()->count()}})   
																					   </div>
																					   <div class="col-lg-6 col-md-6 col-4">
																						  	<div class="multiple-options">
																							  <div class="setting-icon">
																								  <i class="ri-more-fill"></i>
																								  <ul>
																									<li>
																										<a href="#" data-reload="1" data-modal-width=" " data-behavior="ajax_html_modal" data-url="{{route('business.customers.card_editing_form', ['customer_id' => $customerdata->id, 'return_url' => url()->full()])}}" >
																										<i class="fas fa-plus text-muted"></i>Add</a>
																									</li>
																								  </ul>
																							  </div>
																						  	</div>
																					   </div>
																				   </div>
																				</div>
																			</button>
																		</h2>
																		<div id="accor_nesting9Examplecollapse2" class="accordion-collapse collapse" aria-labelledby="accordionnesting9Example2" data-bs-parent="#accordionnesting9">
																			<div class="accordion-body">
																				<div class="row">
																					@foreach($customerdata->stripePaymentMethods()->get() as $card)
																							<div class="col-lg-3 col-sm-6">
																								<div class="cards-block dispalycard" style="cursor: pointer" data-name="{{$card->name}}" data-cvv="{{$card->last4}}" data-cnumber="{{$card->exp_month}}" data-month="{{$card->exp_month}}" data-year="{{$card->exp_year}}" data-type="{{strtolower($card->brand)}}" data-id="{{$card->id}}">
																									<div class="cards-content" style="background-image: url({{ url('public/img/visa-card-bg.jpg')}});">
																										<img src="{{ url('/public/images/creditcard/'.strtolower($card->brand).'.jpg') }}" alt="">
																										<span></span>
																										<p>{{ucfirst(strtolower($card->brand))}}</p>
																										<span>
																											<span class="dots"></span><span class="dots"></span><span class="dots"></span><span class="dots"></span>{{$card->last4}} 
																										</span>

																										<a class="float-end card-remove" data-behavior="delete_card" data-url="{{route('stripe_payment_methods.destroy', ['stripe_payment_method' => $card->payment_id])}}" data-cardid="{{$card->id}}" class="delCard">
																											<i class="fa fa-trash"></i> 
																										</a>

																										<a class="float-end card-remove mr-10" onclick="editCard('{{$card->payment_id}}','{{$card->exp_month}}','{{$card->exp_year}}')" data-cardid="{{$card->id}}">
																											<i class="fas fa-pencil-alt"></i> 
																										</a>

																										<h3>{{$card->exp_month}}/{{$card->exp_year}}</h3>
																									</div>
																								</div>
																							</div>
																					@endforeach
																				</div> 
																			</div>
																		</div>
																	</div>
																	
																	<div class="accordion-item shadow">
																		<h2 class="accordion-header" id="accordionnesting10Example2">
																			<button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#accor_nesting10Examplecollapse2" aria-expanded="false" aria-controls="accor_nesting10Examplecollapse2">

																				<div class="container-fluid nopadding">
																				   <div class="row y-middle">
																					   <div class="col-lg-6 col-md-6 col-8">
																							Customer Notes & Alerts ({{count($notes)}})
																						</div>
																						<div class="col-lg-6 col-md-6 col-4">
																							<div class="multiple-options">
																								<div class="setting-icon">
																									<i class="ri-more-fill"></i>
																									  <ul>
																											<li><a onclick="getNote('');"><i class="fas fa-plus text-muted"></i>Add</a></li>
																										</ul>
																								</div>
																							</div>
																						</div>
																					</div>
																			</button>
																		</h2>
																		<div id="accor_nesting10Examplecollapse2" class="accordion-collapse collapse" aria-labelledby="accordionnesting10Example2" data-bs-parent="#accordionnesting10">
																			<div class="accordion-body">
																				<div class="container-fluid nopadding">
																					<div class="row">	
																						@forelse($notes as $n)
																							
																							<div class="row">
																								<div class="col-md-10">
																									<div class="row">
																										<div class="col-md-3">{!!$n->title!!}</div>
																										<div class="col-md-2">{{date('M d, Y', strtotime($n->created_at))}} </div>
																										<div class="col-md-2">Due {{date('M d, Y', strtotime($n->due_date))}} , {{ date('h:i A', strtotime($n->time))}} </div>
																										<div class="col-md-2">{{ $n->display_chk == 0 ? "Not" : ''}} visible to member</div>
																										<div class="col-md-3">Added by {{$n->User->full_name}}</div>
																									</div>
																								</div>
																								
																								<div class="col-md-2">
																									<div class="multiple-options">
																										<div class="setting-icon">
																											<i class="ri-more-fill"></i>
																											  <ul>
																													<li><a onclick="getNote({{$n->id}})"><i class="fas fa-plus text-muted"></i>Edit</a></li>
																													<li><a onclick="deleteNote({{$n->id}})"><i class="fas fa-plus text-muted"></i>Delete</a></li>
																												</ul>
																										</div>
																									</div>
																								</div>
																							</div>
																						@empty
																							No Notes added yet.
																						@endforelse
																					</div>
																				</div>
																			</div>
																		</div>
																	</div>
																	
																	<div class="accordion-item shadow">
																		<h2 class="accordion-header" id="accordionnesting11Example2">
																			<button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#accor_nesting11Examplecollapse2" aria-expanded="false" aria-controls="accor_nesting11Examplecollapse2">
																				Documents & Contracts
																			</button>
																		</h2>
																		<div id="accor_nesting11Examplecollapse2" class="accordion-collapse collapse" aria-labelledby="accordionnesting11Example2" data-bs-parent="#accordionnesting11">
																			
																			<div class="accordion-body">
																				<div class="row">
																					<div class="col-lg-12 col-md-12 col-sm-12">
																						<a href="#" class="btn btn-red float-end mmb-10" data-bs-toggle="modal" data-bs-target=".terms">Edit</a>
																					</div>
																				</div>
																				<div class="mini-stats-wid d-flex align-items-center mt-3 cardinfo">
																					<div class="container-fluid nopadding">
																						<div class="row">
																							<div class="col-lg-10 col-md-10 col-10">
																								<span>1.</span>
																								<span>Covid-19 Protocols @if(@$customerdata->terms_covid != '') Agreed & Signed on  {{date('m/d/Y',strtotime(@$customerdata->terms_covid))}} @endif </span>
																							</div>
																							<div class="col-lg-2 col-md-2 col-2">
																								<div class="multiple-options">
																									<div class="setting-icon">
																										<i class="ri-more-fill"></i>
																										<ul>
																											<li>
																												<a onclick="printTerms('covidDiv' ,'Covid')">
																													<i class="fas fa-plus text-muted"></i>Print
																												</a>
																											</li>
																											<li>
																												<a onclick="emailTerms('covidDiv',{{@$customerdata->business_id}},'Covid',{{@$customerdata->id}})">
																													<i class="fas fa-plus text-muted"></i>Email
																												</a>
																											</li>
																										</ul>
																									</div>
																								</div>
																							</div>
																							<div class="col-lg-10 col-md-10 col-10">
																								<span> 2. </span>
																								<span>Liability Waiver @if(@$customerdata->terms_liability != '')  Agreed & Signed on {{date('m/d/Y',strtotime(@$customerdata->terms_liability))}} @endif  </span>
																							</div>
																							<div class="col-lg-2 col-md-2 col-2">
																								<div class="multiple-options">
																									<div class="setting-icon">
																										<i class="ri-more-fill"></i>
																										<ul>
																											<li>
																												<a onclick="printTerms('liabilityDiv' ,'Liability')">
																													<i class="fas fa-plus text-muted"></i>Print
																												</a>
																											</li>
																											<li>
																												<a onclick="emailTerms('liabilityDiv',{{@$customerdata->business_id}},'Liability',{{@$customerdata->id}})">
																													<i class="fas fa-plus text-muted"></i>Email
																												</a>
																											</li>
																										</ul>
																									</div>
																								</div>
																							</div>
																							<div class="col-lg-10 col-md-10 col-10">
																								<span>3. </span>
																								<span>Contract Terms @if(@$customerdata->terms_contract != '') Agreed & Signed on {{date('m/d/Y',strtotime(@$customerdata->terms_contract))}} @endif</span>
																							</div>
																							<div class="col-lg-2 col-md-2 col-2">
																								<div class="multiple-options">
																									<div class="setting-icon">
																										<i class="ri-more-fill"></i>
																										<ul>
																											<li>
																												<a onclick="printTerms('contractDiv' , 'Contract')">
																													<i class="fas fa-plus text-muted"></i>Print
																												</a>
																											</li>
																											<li>
																												<a onclick="emailTerms('contractDiv',{{@$customerdata->business_id}},'Contract',{{@$customerdata->id}})" >
																													<i class="fas fa-plus text-muted"></i>Email
																												</a>
																											</li>
																										</ul>
																									</div>
																								</div>
																							</div>
																							@php 
																								$refundDate = @$lastBooking->created_at != '' ? date('m/d/Y',strtotime(@$lastBooking->created_at)) : date('m/d/Y',strtotime(@$customerdata->terms_refund)); 
																							@endphp
																							<div class="col-lg-10 col-md-10 col-10">
																								<span>4. </span>
																								<span>Refund Policy @if(@$refundDate) agreed on {{$refundDate}} @endif</span>
																							</div>
																							<div class="col-lg-2 col-md-2 col-2">
																								<div class="multiple-options">
																									<div class="setting-icon">
																										<i class="ri-more-fill"></i>
																										<ul>
																											<li>
																												<a onclick="printTerms('refundDiv' , 'Refund')">
																													<i class="fas fa-plus text-muted"></i>Print
																												</a>
																											</li>
																											<li>
																												<a onclick="emailTerms('refundDiv',{{@$customerdata->business_id}},'Refund',{{@$customerdata->id}})" >
																													<i class="fas fa-plus text-muted"></i>Email
																												</a>
																											</li>
																										</ul>
																									</div>
																								</div>
																							</div>

																							@php 
																								$termsDate = @$lastBooking->created_at != '' ? date('m/d/Y',strtotime(@$lastBooking->created_at)) : date('m/d/Y',strtotime(@$customerdata->terms_condition)); 
																							@endphp
																							<div class="col-lg-10 col-md-10 col-10">
																								<span>5. </span>
																								<span>Terms, Conditions, FAQ @if(@$termsDate) agreed on {{$refundDate}} @endif</span>
																							</div>
																							<div class="col-lg-2 col-md-2 col-2">
																								<div class="multiple-options">
																									<div class="setting-icon">
																										<i class="ri-more-fill"></i>
																										<ul>
																											<li>
																												<a onclick="printTerms('termsDiv' , 'Terms')">
																													<i class="fas fa-plus text-muted"></i>Print
																												</a>
																											</li>
																											<li>
																												<a onclick="emailTerms('termsDiv',{{@$customerdata->business_id}},'Terms',{{@$customerdata->id}})">
																													<i class="fas fa-plus text-muted"></i>Email
																												</a>
																											</li>
																										</ul>
																									</div>
																								</div>
																							</div>
																						</div>
																					</div>
																				</div>

																				<div class="accordion-item shadow">
																					<h2 class="accordion-header" id="accordionnesting">
																						<button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#accor_nesting" aria-expanded="false" aria-controls="accor_nesting">
																							<div class="container-fluid nopadding">
																								<div class="row  y-middle">
																									<div class="col-lg-6 col-md-6 col-8"> Documents
																									</div>
																									<div class="col-lg-6 col-md-6 col-4">
																										<div class="multiple-options">
																											<div class="setting-icon">
																												<i class="ri-more-fill"></i>
																												  <ul>
																														<li><a href="#" data-bs-toggle="modal" data-bs-target=".documents"><i class="fas fa-plus text-muted"></i>Add New Document</a></li>
																														<li><a href="#/" onclick="openModalDoc()" ><i class="fas fa-plus text-muted"></i>Request A Document</a></li>
																													</ul>
																											</div>
																										</div>
																									</div>
																								</div>
																							</div>
																						</button>
																					</h2>
																					<div id="accor_nesting" class="accordion-collapse collapse" aria-labelledby="accordionnesting" data-bs-parent="#accordionnesting8">
																						<div class="accordion-body">
																							<div class="row mb-15">
																								<div class="col-md-3"> <span class="fs-14 font-black"> Document Name </span></div>
																								<div class="col-md-3"><span class="fs-14 font-black"> Uploaded On </span></div>
																								<div class="col-md-2"> <span class="fs-14 font-black">Uploaded By </span></div>
																								<div class="col-md-3"><span class="fs-14 font-black"> Status </span></div>
																							</div>
																							@forelse($documents as $d)
																							<div class="row">
																								<div class="col-md-3">
																									<a  @if(!$d->CustomerDocumentsRequested->isEmpty()) href="#" onclick="event.preventDefault(); openDocumentModal('{{$d->id}}','load')"  @elseif($d->path) href="{{ route('download', ['id' => $d->id]) }}" target="_blank" @endif  ><i class="fas fa-download"></i> {{$d->title}}</a>
																								</div>

																								<div class="col-md-3">
																									<i class="fas fa-paperclip"></i>
																									{{date('m/d/Y', strtotime($d->created_at))}}
																								</div>
																								<div class="col-md-2">{{@$d->uploaded_by}}</div>
																								<div class="col-md-3"> 
																									@if($d->status == 1)
																										@if($d->sign_requested_date && !$d->sign_date)
																							            <span class="font-red">Sign Requested on {{ date('m/d/Y' , strtotime($d->sign_requested_date)) }}</span>
																							         @endif
																							         @if($d->sign_date)
																							            <span class="font-green">Signed On {{ date('m/d/Y' , strtotime($d->sign_date)) }}</span>
																							         @endif 
																							      @endif

																							      @if(!$d->CustomerDocumentsRequested->isEmpty()) 
																							       	@if($d->doc_requested_date && !$d->doc_completed_date)
																							            <span class="font-red">Document Requested on {{ date('m/d/Y' , strtotime($d->doc_requested_date)) }}</span>
																							         @endif
																							         @if($d->doc_completed_date)
																							            <span class="font-green">Document Request Completed On {{ date('m/d/Y' , strtotime($d->doc_completed_date)) }}</span>
																							         @endif
																							      @endif 
																							   </div>
																								<div class="col-md-1">
																									<div class="multiple-options">
																										<div class="setting-icon">
																											<i class="ri-more-fill"></i>
																											  <ul>

																											  		@if($d->CustomerDocumentsRequested->isEmpty())
																												  		@if($d->status == 0)
																												  			<li><a onclick="requestSign({{$d->id}})"><i class="fas fa-plus text-muted"></i>Request Signature</a></li>
																												  		@elseif($d->status == 1)
																												  			<li><a><i class="fas fa-plus text-muted"></i>Signature Requested</a></li>
																												  		@else
																												  			<li><a><i class="fas fa-plus text-muted"></i>Signature Signed</a></li>
																												  		@endif
																												  	@endif
																											  		<!-- <li><a onclick="openModalDoc({{$d->id}})"><i class="fas fa-plus text-muted"></i>Request Document</a></li> -->
																											  		<li>
																											  			<a @if(!$d->CustomerDocumentsRequested->isEmpty())  onclick="event.preventDefault(); openDocumentModal('{{$d->id}}','load')"  @elseif($d->path) href="{{ route('download', ['id' => $d->id]) }}" target="_blank" @endif ><i class="fas fa-plus text-muted"></i>Download
																											  			</a>
																											  		</li>
																													<li><a onclick="deleteDoc({{$d->id}})"><i class="fas fa-plus text-muted"></i>Delete </a></li>
																												</ul>
																										</div>
																									</div>
																								</div>
																							</div>
																							@empty
																								No Documents added yet.
																							@endforelse
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
               		</div> 
            	</div>
        	</div>
      	</div>
   	</div>
</div>

<div class="row mt-25">
		<div class="col-md-12 text-center printDiv mb-10 printnone" id="covidDiv">{!!@$terms->covidtext!!}</div>

		<div class="col-md-12 text-center printDiv mb-10 printnone" id="liabilityDiv">{!!@$terms->liabilitytext!!}</div>

		<div class="col-md-12 text-center printDiv mb-10 printnone" id="contractDiv">{!!@$terms->contracttermstext!!}</div>

		<div class="col-md-12 text-center printDiv mb-10 printnone" id="refundDiv">{!!@$terms->refundpolicytext!!}</div>

		<div class="col-md-12 text-center printDiv mb-10 printnone" id="termsDiv">{!!@$terms->termcondfaqtext!!}</div>
</div>


<div class="modal fade editCard" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true" data-bs-focus="false">
	<div class="modal-dialog modal-dialog-centered">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="myModalLabel">Edit Card</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<form id="editCardForm">
				<input type="hidden" id="cardId" name="cardId" value="">
				<div class="modal-body">
					<div class="row">
						<div class="col-lg-6 col-md-6 col-sm-6">
							<div class="mb-10">
								<label>Expiration Month</label>
								<input class="form-control" type="text" id="month" name="month" value="">
							</div>
						</div>
						<div class="col-lg-6 col-md-6 col-sm-6">
							<div class="mb-10">
								<label>Expiration Year</label>
								<input class="form-control" type="text" id="year" name="year" value="">
							</div>
						</div>
					</div>	
					<div class="col-md-12">
						<span class="card-error fs-16"></span>
					</div>				
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-primary btn-red" onclick="updateCard();">Submit</button>
				</div>
			</form>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div>

<div class="modal fade editprofile" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true" data-bs-focus="false">
	<div class="modal-dialog modal-dialog-centered modal-50">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="myModalLabel">Edit Customer</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<form action="{{route('update_customer')}}" method="post" enctype="multipart/form-data">
				@csrf
				<input type="hidden" id="cus_id" name="cus_id" value="{{$customerdata->id}}">
				<input type="hidden" id="chk" name="chk" value="update_personal">
				<div class="modal-body">
					<div class="row">
						<div class="col-lg-6 col-md-6 col-sm-6">
							<div class="mb-10">
								<label>First Name</label>
								<input class="form-control" type="text" id="fname" name="fname" placeholder="First name" value="{{$customerdata->fname}}">
							</div>
						</div>
						<div class="col-lg-6 col-md-6 col-sm-6">
							<div class="mb-10">
								<label>Last Name</label>
								<input class="form-control" type="text" id="lname" name="lname" placeholder="Last Name" value="{{$customerdata->lname}}">
							</div>
						</div>
						<div class="col-lg-6 col-md-6 col-sm-6">
							<div class="mb-10">
								<label>Email</label>
								<input class="form-control" type="text" id="email" name="email" placeholder="Email" value="{{$customerdata->email}}">
							</div>
						</div>
						<div class="col-lg-6 col-md-6 col-sm-6">
							<div class="mb-10">
								<label>	Phone Number </label>
								<input class="form-control" type="text" id="phone_number" name="phone_number" placeholder="Phone Number" value="{{$customerdata->phone_number}}" data-behavior="text-phone">
							</div>
						</div>
						<div class="col-lg-6 col-md-6 col-sm-6">
							<div class="mb-10">
								<label>	Birthdate </label>
								<div class="input-group">
									<input type="text" name="birthdate" class="form-control flatpiker-with-border flatpickr-date" value="@if($customerdata->birthdate != '') {{date('m/d/Y',strtotime($customerdata->birthdate))}} @endif" placeholder="Birthday">
								</div>
							</div>
						</div>
						<div class="col-lg-6 col-md-6 col-sm-6">
							<div class="mb-10">
								<label>	Gender </label>
								<div>
								<input type="radio" name="gender" value="male" {{strtolower($customerdata->gender) == 'male' ? "checked" : '' }}> Male
								<input type="radio" name="gender" value="female" {{strtolower($customerdata->gender) == 'female' ? "checked" : '' }}> Female
								<input type="radio" name="gender" value="other" {{strtolower($customerdata->gender) == 'other' ? "checked" : '' }}> Other
								</div>
							</div>
						</div>
						<div class="col-lg-6 col-md-6 col-sm-6">
							<div class="mb-10">
								<label>	Address </label>
								<input class="form-control pac-target-input" type="text" id="customer_address" name="address" placeholder="Address" value="{{$customerdata->address}}" >
							</div>
						</div>
						<div id="map" style="display: none;"></div>
						<div class="col-lg-6 col-md-6 col-sm-6">
							<div class="mb-10">
								<label>	City  </label>
								<input class="form-control" type="text" id="city" name="city" placeholder="City " value="{{$customerdata->city}}">
							</div>
						</div>
						<div class="col-lg-6 col-md-6 col-sm-6">
							<div class="mb-10">
								<label>	State </label>
								<input class="form-control" type="text" id="state" name="state" placeholder="State" value="{{$customerdata->state}}">
							</div>
						</div>
						<div class="col-lg-6 col-md-6 col-sm-6">
							<div class="mb-10">
								<label>	Country </label>
								<input class="form-control" type="text" id="country" name="country" placeholder="Country" value="{{$customerdata->country}}">
							</div>
						</div>
						<div class="col-lg-6 col-md-6 col-sm-6">
							<div class="mb-10">
								<label>	Zipcode </label>
								<input class="form-control" type="text" id="zipcode1" name="zipcode" placeholder="Zipcode" value="{{$customerdata->zipcode}}">
							</div>

							<div class="mb-10">
								<input class="check-box-primary-account" type="checkbox" id="primary_account" name="primary_account" value="1" @if($customerdata->primary_account == '1') checked @endif  >
								<!-- @if($resultDate->format('Y-m-d') <= $customerdata->birthdate) disabled @endif -->
								<label for="primary_account"> Primary Account <span class="" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-original-title="You are paying for yourself and all added family members.">(i)</span></label>
							</div>
						</div>
						<div class="col-lg-6 col-md-6 col-sm-6">
							<div class="mb-10">
								<label>	Profile Picture</label>
								<div class="userblock text-center">
									<div class="login_link s">
										@if($customerdata->profile_pic)
                          			<img src="{{Storage::Url($customerdata->profile_pic)}}" class="customers-name rounded-circle" alt="">
                          		@else
                          			<div class="company-list-text"><p>{{$customerdata->fname[0] ?? 'A'}}</p></div>
                          		@endif
									</div>
								</div>
								<input type="file" class="form-control mt-10" name="profile_pic" id="profile_pic">
							</div>
						</div>	
					</div>					
				</div>
				<div class="modal-footer">
					<button type="submit" class="btn btn-primary btn-red">Submit</button>
				</div>
			</form>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<div class="modal fade documents" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true" data-bs-focus="false">
	<div class="modal-dialog modal-dialog-centered modal-30">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="myModalLabel">Upload Document</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			
			<div class="modal-body">
				<div class="row">
					<div class="col-lg-12 col-md-12 col-sm-6">
						<div class="mb-10">
							<label>Document Title</label>
							<input class="form-control" type="text" id="docTitle" name="docTitle" placeholder="Enter Document Title..." value="">
						</div>
						<div class="mb-10">
							<input type="file" class="form-control mt-10" name="document" id="file" onchange="readURL(this)">
						</div>
						<div class="mb-10">
							<div class="form-check form-switch form-switch-right form-switch-md">
	                     <label> Signature Needed </label>
	                     <input class="custom-switch form-check-input" type="checkbox" name="signature" id="signature" value="1">
                     </div>
						</div>
						<p class='err mt-10 font-red'></p>
						<label id="docMessage" class="font-16"></label>
					</div>
				</div>					
			</div>
			<div class="modal-footer">
				<button type="button" id="upload-pdf" class="btn btn-primary btn-red upload-pdf">Add Document</button>
			</div>
		</div>
	</div>
</div>

<div class="modal fade notes" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true" data-bs-focus="false">
	<div class="modal-dialog modal-dialog-centered modal-30">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title note-title" id="myModalLabel">Add Note</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			
			<div class="modal-body" id="noteHtml">		
			</div>
		</div>
	</div>
</div>

<div class="modal fade terms" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered modal-50">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="myModalLabel">Edit Terms of Service</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<form action="{{route('update_customer')}}" method="post" enctype="multipart/form-data">
				@csrf
				<input type="hidden" id="cus_id" name="cus_id" value="{{$customerdata->id}}">
				<input type="hidden" id="chk" name="chk" value="update_terms">
				<div class="modal-body">
					<div class="row">
						<div class="col-lg-12">
							<div class="modal-checkbox mb-15">
								<label>Covid-19 Protocols</label>
								@if(@$terms->covidtext != '' ) <p>{!!@$terms->covidtext!!}</p>@endif
								<div class="modal-terms-wrap">
									<input type="checkbox" id="terms_covid" name="terms_covid" value="1" @if(@$customerdata->terms_covid != '') checked @endif>
									<p> The provider(s) require that you agree to Covid-19 Protocols. </p>
								</div>
							</div>
						</div>
						<div class="col-lg-12">
							<div class="modal-checkbox mb-15">
								<label>Liability Waiver</label>
								@if(@$terms->liabilitytext != '' ) <p>{!!@$terms->liabilitytext!!}</p>@endif
								<div class="modal-terms-wrap">
									<input type="checkbox" id="terms_liability" name="terms_liability" value="1"  @if(@$customerdata->terms_liability != '') checked @endif>
									<p> The provider(s) require that you agree to Liability Waiver.</p>
								</div>
							</div>
						</div>
						<div class="col-lg-12">
							<div class="modal-checkbox mb-15">
								<label>Contract Terms</label>
								@if(@$terms->contracttermstext != '' ) <p>{!!@$terms->contracttermstext!!}</p>@endif
								<div class="modal-terms-wrap">
									<input type="checkbox" id="terms_contract" name="terms_contract" value="1" @if(@$customerdata->terms_contract != '') checked @endif>
									<p>The provider(s) require that you agree to Contract Terms.</p>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="submit" class="btn btn-primary btn-red">Submit</button>
				</div>
			</form>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div><!-- /.modal -->	

<div class="modal fade checkinDetails" tabindex="-1" aria-labelledby="mySmallModalLabel" >
	<div class="modal-dialog modal-dialog-centered modal-70">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="myModalLabel">Activity Scheduler Check-In</h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body" id="checkInHtml">

			</div>
		</div>
	</div>
</div>

<div class="modal fade modalDocument" tabindex="-1" aria-labelledby="mySmallModalLabel">
	<div class="modal-dialog modal-dialog-centered">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="myModalLabel">Documents</h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body" id="modalDocumentHtml">

			</div>
		</div>
	</div>
</div>

<div class="modal fade modalDocumentDisplay" tabindex="-1" aria-labelledby="mySmallModalLabel">
	<div class="modal-dialog modal-dialog-centered modal-70" id="doc-width">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="myModalLabel">Requested Documents</h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body" id="modalDocumentDisplayHtml">

			</div>
		</div>
	</div>
</div>

<div class="modal fade" id="check-in-code" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  	<div class="modal-dialog modal-dialog-centered">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Add/Edit</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body">
				<div class="form-group mt-10">
					<label for="code">Self Check-In Code</label>
					<input type="text" class="form-control" name="code" id="code">
				</div>

				<div class="mt-10 ml-10 fs-14" id="error-message"></div>	

			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-red" id="submit-code">Submit</button>
			</div>
		</div>
  	</div>
</div>

@include('layouts.business.footer')

<script type="text/javascript">
	
	$('#submit-code').on('click', function(e) {
        e.preventDefault();
        $('#error-message').removeClass('text-danger text-success').html('');

        var code = $('#code').val();

        if (code == '') {
            alert('Please enter a code.');
            return;
        }

        $.ajax({
            url: '{{ route("change-checkin-code") }}', 
            type: 'POST',
            data: {
                _token: '{{ csrf_token() }}',
                code: code,
                business_id: '{{$customerdata->business_id}}',
                customerId: '{{$customerdata->id}}'
            },
            success: function(response) {
                if(response.success) {
                	$('#error-message').addClass('text-success').html(response.message);
                	setTimeout(function(e){
                		window.location.reload();
                	},2000);
                } else {
                    $('#error-message').addClass('text-danger').html(response.message || 'An error occurred. Please try again.');
                }
            },
            error: function(xhr, status, error) {
                $('#error-message').addClass('text-danger').html('An error occurred. Please try again.');
            }
        });
    });

</script>

<script>
	
	var docToUpload = ''; ext = '';

	function readURL(input) {
	   if (input.files && input.files[0]) {
	      const name = input.files[0].name;
	  		const lastDot = name.lastIndexOf('.');
	  		const fileName = name.substring(0, lastDot);
	   	ext = name.substring(lastDot + 1);
	   	var reader = new FileReader();
         reader.onload = function (e) {
             
         };
         docToUpload = input.files[0];
         reader.readAsDataURL(input.files[0]);
      }
	}

	function editCard(cardId,month,year){
		$('#cardId').val(cardId);
		$('#year').val(year);
		$('#month').val(month);
		$('.editCard').modal('show');
	}

	function updateCard(){
		$('.card-error').removeClass('font-green font-red');

       	var cardId = $('#cardId').val();
       	$.ajax({
         	type: 'POST',
         	url: '/stripe_payment_methods/update',
          	data: {
          		year: $('#year').val(),
          		month: $('#month').val(),
          		customerID: '{{$customerdata->id}}',
          		cardId: $('#cardId').val(),
          		_token:'{{csrf_token()}}'
          	},
	        success: function (response) {
            	if(response == 'success'){
            		$('.card-error').addClass('font-green').html('Card updated successfully.');
            		setTimeout(function() {
				        window.location.reload();
				    }, 1000);

            	}else{
            		$('.card-error').addClass('font-red').html(response);
            	}
         	}
      	});
	}

	function openDocumentModal(id,type){
		$.ajax({
         type: 'GET',
         url: '/personal/getContent/'+id+'/'+type,
         success: function (response) {
         	$('#doc-width').removeClass('modal-50');
         	if(type == 'upload'){
         		if(!$('#doc-width').hasClass('modal-70')){
         			$('#doc-width').addClass('modal-70');
         		}
         	}else{
         		$('#doc-width').addClass('modal-50');
         	}
            $('#modalDocumentDisplayHtml').html(response);
				$('.modalDocumentDisplay').modal('show');
         }
      });
	}

	function requestSign(id){
		$.ajax({
         	type: 'GET',
         	url: '/business/'+'{{request()->business_id}}'+'/requestSign/'+id,
         	success: function (data) {
            	window.location.reload();
         	}
      	});
	}

	function openModalDoc(){
		var cust_id =  '{{$customerdata->id}}'
		$.ajax({
         	type: 'GET',
         	url: '/docContent/'+cust_id,
         	success: function (response) {
            	$('#modalDocumentHtml').html(response);
				$('.modalDocument').modal('show');
         	}
      	});
	}

	function requestDoc(id){
		$.ajax({
         	type: 'GET',
         	url: '/business/'+'{{request()->business_id}}'+'/requestDoc/'+id,
         	success: function (data) {
            	window.location.reload();
         	}
      	});
	}

	function deleteDoc(id){
		let text = "You are about to delete the document. Are you sure you want to continue?";
		if (confirm(text)) {
	      $.ajax({
	         type: 'GET',
	         url: '/removeDoc/'+id,
	         success: function (data) {
	            window.location.reload();
	         }
	      });
	   }
	}

	function deleteNote(id){
		let text = "You are about to delete the Note. Are you sure you want to continue?";
		if (confirm(text)) {
	      $.ajax({
	         type: 'GET',
	         url: '/business/'+'{{request()->business_id}}'+'/removenote/'+id,
	         success: function (data) {
	            window.location.reload();
	         }
	      });
	   }
	}

	function getNote(id){
		$.ajax({
         	type: 'GET',
         	url: '/business/'+'{{request()->business_id}}'+'/customer/'+'{{$customerdata->id}}'+'/getNote/'+id,
         	success: function (data) {
            	$('#noteHtml').html(data);
	            if(id){
	            	$('.note-title').html('Edit Note');
	            }else{
	            	$('.note-title').html('Add Note');
	            }
            	$('.notes').modal('show');
         	}
	   });
	}

	$('.upload-pdf').click(function(){
     	$('.err').html('');
     	var signature = ($('#signature').val() !== undefined && $('#signature').val() !== null) ? $('#signature').val() : 0;
      	var formdata = new FormData();
      	formdata.append('file',docToUpload);
      	formdata.append('sign',signature);
      	formdata.append('id','{{$customerdata->id}}');
      	formdata.append('title',$('#docTitle').val());
       	formdata.append('_token','{{csrf_token()}}')
       	$.ajax({
            url: '{{route('upload_docs')}}',
            type:'post',
            dataType: 'json',
            enctype: 'multipart/form-data',
            data:formdata,
            processData: false,
            contentType: false,
            headers: {'X-CSRF-TOKEN': $("#_token").val()},
            success: function (response) { 
            	$('#docMessage').removeClass();
               if(response.status == 200){
                  $('#docMessage').addClass('font-green font-16');
                  $('#docTitle').val('');
                  $('#docMessage').html(response.message);
                  setTimeout(function() {
					        window.location.reload();
					   }, 1000);
               }
               else{
             		$('#docMessage').addClass('font-red font-16');
             		$('#docMessage').html(response.message).addClass('alert alert-danger alert-dismissible');
               }
               $('#file').val('')
            }
      	});
    });

</script>

	<script type="text/javascript">

		$("[data-behavior~=transaction_void]").click(function(e){
			e.preventDefault();

	        $.ajax({
	            url: "/business/{{request()->business_id}}/booking_details/" + $(this).data('booking-detail-id') + '/void',
	            method: "POST",
	            data:{
	                _token: '{{csrf_token()}}', 
	                customer_id: $(this).data('customer-id')
	            },
	            error: function(xhr, status, error){
	            	var errorMessage = JSON.parse(xhr.responseText);
	            	alert(errorMessage.message);
	            },
	            success:function(response) {
	                location.reload()
	            },
	        });
	    });

		$("[data-behavior~=transaction_refund]").click(function(e){
			e.preventDefault();

	        $.ajax({
	            url: "/business/{{request()->business_id}}/booking_details/" + $(this).data('booking-detail-id') + '/refund',
	            method: "POST",
	            data:{
	                _token: '{{csrf_token()}}', 
	                customer_id: $(this).data('customer-id')
	            },
	            error: function(xhr, status, error){
	            	var errorMessage = JSON.parse(xhr.responseText);
	            	alert(errorMessage.message);
	            },
	            success:function(response) {
	            	console.log(response)
	                // location.reload()
	            },
	        });
	    });
	</script>

	<script>
		$(document).ready(function () {
			var business_id = '{{request()->business_id}}';
	     	var url = "{{ url('/business/business_id/customers') }}";
	      	url = url.replace('business_id', business_id);

			$("#serchFamilyMember").autocomplete({
	         	source: url,
	         	focus: function( event, ui ) {
	              	return false;
	         	},
	         	select: function( event, ui ) {
	         		callAddFamily(ui.item.id , business_id);
	            	return false;
	         	}
     		}).data( "ui-autocomplete" )._renderItem = function( ul, item ) {
         		let profile_img = '<div class="collapse-img"><div class="company-list-text" style="height: 50px;width: 50px;"><p style="padding: 0;">' + item.fname.charAt(0).toUpperCase() + '</p></div></div> ';

         		if(item.profile_pic_url){
             		profile_img = '<img class="searchbox-img" src="' + (item.profile_pic_url ? item.profile_pic_url : '') + '" style="">';            
         		}

         		var inner_html = '<div class="row rowclass-controller"></div><div class="row"><div class="col-lg-3 col-md-3 col-3 nopadding text-center">' + profile_img + '</div><div class="col-lg-9 col-md-9 col-9 div-controller">' + 
                   '<p class="pstyle"><label class="liaddress">' + item.fname + ' ' +  item.lname  + (item.age ? ' (' + item.age+ '  Years Old)' : '') + '</label></p>' +
                   '<p class="pstyle liaddress">' + item.email +'</p>' + 
                   '<p class="pstyle liaddress">' + item.phone_number + '</p></div></div>';
        
        		return $( "<li></li>" ).data( "item.autocomplete", item ).append(inner_html).appendTo( ul );
     		};
   		});

		function getCheckInDetailsModel(business_id,scheduleId,date,cid){
			if(scheduleId != 0){
				$.ajax({	
					url:"/business/"+business_id+"/schedulers/"+scheduleId+"/checkin_details?date="+date+"&customerId="+cid,
					type:'GET',
					success:function(data){
						$('#checkInHtml').html(data);
						$('.checkinDetails').modal('show');
					}
				});
			}	
		}

		function getCheckInDetails(scheduleId,date,chkInID,cus_id,chk,chkMsg,chkInMsg){
			var business_id = '{{$customerdata->business_id}}';
			$.ajax({	
				url:"/business/"+business_id+"/schedulers/"+scheduleId+"/checkin_details?date="+date+"&chkInId="+chkInID+"&cus_id="+cus_id+"&chk="+chk+"&msg="+chkMsg+"&chkInMsg="+chkInMsg,
				type:'GET',
				success:function(data){
					$('#checkInHtml').html(data);
					$('.checkinDetails').modal('show');
				}
			});	
		}

	   	function deleteMember(id) {
			if(id == ''){
				window.location.reload();
			}else{
				var _token = $("input[name='_token']").val();
		        $.ajax({
		            type: 'POST',
		            url: '{{route("removefamilyCustomer")}}',
		            data: {
		               _token: _token,
		               id: id
		            },
		            success: function (data) {
		               //window.location.reload();
		            }
		        });
			}
		}

		$(document).on('click', '.delcustomer', function(e){
			e.preventDefault();
			var business_id = $(this).attr('data-business_id');
			let text = "Are you sure to delete this customer?";
			if (confirm(text) == true) {
				var token = $("meta[name='csrf-token']").attr("content");
			   $.ajax({
			      url: '/business/'+business_id+'/customers/delete/'+$(this).attr('data-id'),
			      type: 'DELETE',
			      data: {
			          "_token": token,
			      },
			      success: function (){
			      	window.location = '/business/'+business_id+'/customers';
			      }
			   });
			}
		});

	   	function callAddFamily(cid ,business_id){
	   		if(cid == '{{$customerdata->id}}'){
	   			alert("You can't add your self as your family member..");
	   			return false;
	   		}
	   		$.ajax({
	            type: 'POST',
	            url: '{{route("addFamilyViaSearch")}}',
	            data: { 
	            	_token: '{{csrf_token()}}',
	            	business_id: business_id,
	            	cid: cid,
	            	currentCid:'{{$customerdata->id}}'
	         	},
	            success: function(data) {
	               location.reload();
	            }
         	});
	   	}
  
		flatpickr(".flatpickr-date", {
        	dateFormat: "m/d/Y",
        	maxDate: "01/01/2050",
        	onChange: function(selectedDates, dateStr, instance) {
              	var age = calculateAge(dateStr);
              	if (age < 18) {
                  $('.check-box-primary-account').prop('disabled', true);
                  if ($('.check-box-primary-account').is(':checked')) {
                      $('.check-box-primary-account').prop('checked', false);
                  }
              	} else {
                 $('.check-box-primary-account').prop('disabled', false);
              	}
          	}
      	});

      	function calculateAge(dateStr) {
        	var birthDate = new Date(dateStr);
        	var currentDate = new Date();
        	var age = currentDate.getFullYear() - birthDate.getFullYear();
        	var monthDiff = currentDate.getMonth() - birthDate.getMonth();
        	if (monthDiff < 0 || (monthDiff === 0 && currentDate.getDate() < birthDate.getDate())) {
            	age--;
        	}
        	return age;
    	}

      	function printTerms(divId,termsName){
      		var chk = $('#'+divId).html() != '' ? 1 : 0;
      		if(chk == 1){
	      		const divName = ['covidDiv','liabilityDiv','contractDiv','refundDiv','termsDiv'];
	      		divName.forEach(function(div) {
				   	if(divId == div){
				   		$('#'+divId).removeClass('printnone');
	      				$('#'+divId).addClass('exclude-from-print');
				   	}else{
				   		$('#'+div).addClass('printnone');
	      				$('#'+div).removeClass('exclude-from-print');
				   	}
				});
	      	
	      		print();
	      	}else{
	      		alert("There is not any " +termsName + " policy.");
	      	}
       	}

      	function emailTerms(divId,business_id,termsName,cid){
	      	var chk = $('#'+divId).html() != '' ? 1 : 0;
	      	if(chk == 1){
		      	$.ajax({
	               type: 'POST',
	               url: '{{route("sendTermsMail")}}',
	               data: { 
	               	_token: '{{csrf_token()}}',
	               	business_id: business_id,
	               	cid: cid,
	               	termsName: termsName,
	            	},
	               success: function(data) {
	                  alert('Email sent successfully.')
	               }
	            });
		    }else{
		      	alert("There is not any " +termsName + " policy.");
		    }
      	}

		$(document).on("click", "[data-behavior~=delete_card]", function(e){
    		e.preventDefault()
         	if (confirm('You are sure to delete card?')) {
            	var cardid = $(this).data("cardid");
            	$.ajax({
	               	type: 'DELETE',
	               	url: $(this).data('url'),
	               	data: { _token: '{{csrf_token()}}'},
	               	success: function(data) {
	                  	location.reload();
	               	}
            	});
         	}
     	});
	
   		function redirctAddfamily(id){
   			window.open('/customer/add-family/'+id, '_blank');
   		}
	</script>

	<script type="text/javascript">
    	function initMap() {
        	var map = new google.maps.Map(document.getElementById('map'), {
            center: {lat: -33.8688, lng: 151.2195},
            zoom: 13
        	});

        	var input = document.getElementById('customer_address');
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
                  $('#zipcode1').val(place.address_components[i].long_name);
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
              $('#customer_address').val(sublocality_level_1);
            }else{
              $('#customer_address').val(badd);
            }
        });
    	}
	</script>

@endsection