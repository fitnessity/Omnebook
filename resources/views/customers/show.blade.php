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
							<div class="row">
								<div class="col-xl-12">
									<div class="card">
										<div class="card-header align-items-center d-flex">
											<h4 class="card-title mb-0 flex-grow-1">{{@$customerdata->full_name}}'s Account</h4>
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
																			<div class="container-fluid">
																				<div class="pt-4 mb-4 mb-lg-3 pb-lg-4 profile-wrapper">
																					<div class="row d-flex align-items-center">
																						<div class="col-auto col-md-3 col-lg-2 col-sm-4">
																							<div class="avatar-lg">
																								@if(@$customerdata->profile_pic)
																									<img src="{{Storage::Url($customerdata->profile_pic)}}" class="customers-name rounded-circle" alt="">
																								@else
																									<div class="customers-name rounded-circle"><p>{{@$customerdata->fname[0]}}</p></div>
																								@endif
																							</div>
																								
																						</div>
																						<!--end col-->
																						<div class="col-lg-7 col-md-6 col-sm-5 col-xs-12 col-auto">
																							<div class="p-2 mmt-10">
																								<h3 class="mb-1">{{$customerdata->full_name}}</h3>
																							</div>
																						</div>
																						<!--end col-->
																						<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12 col-lg-auto order-last order-lg-0">
																							<div class="flex-shrink-0 float-end mfloat-left small0width">
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
																					<div class="card-body">
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
																											<span>{{$customerdata->get_last_seen()}}</span>
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
																											<label class="font-black">Customers Since :</label>
																										</div>
																										<div class="col-lg-7 col-sm-7">
																											<span>{{date('m/d/Y',strtotime($customerdata->created_at))}}</span>
																										</div>
																									</div>
																								</div>
																							</div>
																						</div>
																					</div><!-- end card body -->
																				</div>
																				<div class="card card-border">
																					<div class="card-body">
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
																											@if($customerdata->is_active() == 0)
																												<span class="red-fonts">InActive</span>
																											@else
																												<span class="green-fonts">Active</span>
																											@endif
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
																				Account Details
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
																											<button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#accor_nesting4Examplecollapsea{{$i}}" aria-expanded="false" aria-controls="accor_nesting4Examplecollapse2">
																												<div class="container-fluid nopadding">
																													<div class="row mini-stats-wid d-flex align-items-center ">
																														<div class="col-lg-6 col-md-6 col-8"> {{$booking_detail->business_services_with_trashed->program_name}} - {{$booking_detail->business_price_detail_with_trashed->business_price_details_ages_with_trashed->category_title}} </div>
																														<div class="col-lg-6 col-md-6 col-4">
																															<div class="multiple-options">
																																<div class="setting-icon">
																																	<i class="ri-more-fill"></i>
																																	<ul>
																																		<li>
																					                                       	<a class="visiting-view" data-behavior="ajax_html_modal" data-url="{{route('visit_modal', ['business_id' => request()->business_id, 'id' => $customerdata->id, 'booking_detail_id' => $booking_detail->id])}}" data-modal-width="modal-70" ><i class="fas fa-plus text-muted">
																					                                       	</i> View Visits </a>
																																		</li>
																																		<li>
																																			<a class="edit-booking-customer" data-behavior="ajax_html_modal" data-url="{{route('visit_membership_modal', ['business_id' => request()->business_id, 'id' => $customerdata->id,'booking_detail_id' => $booking_detail->id , 'booking_id' => $booking_detail->booking_id])}}" data-modal-width="modal-100"> <i class="fas fa-plus text-muted">
																																			</i>Edit Booking </a>
																																		</li>
																																		<li>
																																			<a class="edit-booking-customer" data-behavior="ajax_html_modal" data-url="{{route('void_or_refund_modal', ['business_id' => request()->business_id, 'id' => $customerdata->id,'booking_detail_id' => $booking_detail->id , 'booking_id' => $booking_detail->booking_id])}}" data-modal-width="modal-100"> <i class="fas fa-plus text-muted">
																																			</i>Refund or Void</a>
																																		</li>
																																		<li>
																																			<a class="edit-booking-customer" data-behavior="ajax_html_modal" data-url="{{route('terminate_or_suspend_modal', ['business_id' => request()->business_id, 'id' => $customerdata->id,'booking_detail_id' => $booking_detail->id , 'booking_id' => $booking_detail->booking_id])}}" data-modal-width="modal-100"> <i class="fas fa-plus text-muted">
																																			</i>Suspend or Terminate</a>
																																		</li>
																																		<li>
																																			<a class="edit-booking-customer" data-behavior="ajax_html_modal" data-url="{{route('business.recurring.index', ['business_id' => request()->business_id, 'customer_id' => $customerdata->id, 'booking_detail_id' => $booking_detail->id ,'type'=>'schedule'])}}" data-modal-width="modal-80"><i class="fas fa-plus text-muted">
																																			</i>Autopay Schedule</a>
																																		</li>
																																		<li>
																																			<a class="edit-booking-customer" data-behavior="ajax_html_modal" data-url="{{route('business.recurring.index', ['business_id' => request()->business_id, 'customer_id' => $customerdata->id, 'booking_detail_id' => $booking_detail->id ,'type'=>'history'])}}" data-modal-width="modal-80"><i class="fas fa-plus text-muted">
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
																																		<label>{{$booking_detail->business_services_with_trashed->program_name}}</label>	
																																	</div>
																																</div>
																																<div class="col-lg-6 col-md-6 col-sm-6 col-6">
																																	<div class="inner-accordion-titles float-end text-right line-break">
																																		<span>Remaining {{$booking_detail->getremainingsession()}}/{{$booking_detail->pay_session}}</span> 
																																		<a class="mailRecipt" data-behavior="send_receipt" data-url="{{route('receiptmodel',['orderId'=> $booking_detail->booking_id ,'customer'=>$customerdata->id ])}}" data-item-type="no" data-modal-width="modal-70" >
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
																																	<span> {{$booking_detail->booking->order_id}} </span>
																																</div>
																															</div>
																														
																															<div class="col-lg-6 col-md-6 col-sm-6 col-6">
																																<div class="line-break">
																																	<label>TOTAL PRICE </label>
																																</div>
																															</div>
																															<div class="col-lg-6 col-md-6 col-sm-6 col-6">
																																<div class="float-end line-break text-right">
																																	<span> ${{$booking_detail->booking->amount}} </span>
																																</div>
																															</div>
																														
																															<div class="col-lg-6 col-md-6 col-sm-6 col-6">
																																<div class="line-break">
																																	<label>PAYMENT TYPE:</label>
																																</div>
																															</div>
																															<div class="col-lg-6 col-md-6 col-sm-6 col-6">
																																<div class="float-end line-break text-right">
																																	<span>{{$booking_detail->booking->getPaymentDetail()}}</span>
																																</div>
																															</div>
																														
																															<div class="col-lg-6 col-md-6 col-sm-6 col-6">
																																<div class="line-break">
																																	<label>TOTAL REMAINING:</label>
																																</div>
																															</div>
																															<div class="col-lg-6 col-md-6 col-sm-6 col-6">
																																<div class="float-end line-break text-right">
																																	<span>{{$booking_detail->getremainingsession()}}/{{$booking_detail->pay_session}}</span>
																																</div>
																															</div>
																														
																															<div class="col-lg-6 col-md-6 col-sm-6 col-6">
																																<div class="line-break">
																																	<label>PROGRAM NAME:</label>
																																</div>
																															</div>
																															<div class="col-lg-6 col-md-6 col-sm-6 col-6">
																																<div class="float-end line-break text-right">
																																	<span>{{$booking_detail->business_services_with_trashed->program_name}} </span>
																																</div>
																															</div>

																															<div class="col-lg-6 col-md-6 col-sm-6 col-6">
																																<div class="line-break">
																																	<label>CATEGORY NAME:</label>
																																</div>
																															</div>
																															<div class="col-lg-6 col-md-6 col-sm-6 col-6">
																																<div class="float-end line-break text-right">
																																	<span>{{$booking_detail->business_price_detail_with_trashed->business_price_details_ages_with_trashed->category_title}} </span>
																																</div>
																															</div>

																															<div class="col-lg-6 col-md-6 col-sm-6 col-6">
																																<div class="line-break">
																																	<label>PRICE OPTION:</label>
																																</div>
																															</div>
																															<div class="col-lg-6 col-md-6 col-sm-6 col-6">
																																<div class="float-end line-break text-right">
																																	<span>{{$booking_detail->business_price_detail_with_trashed->price_title}} </span>
																																</div>
																															</div>
																															
																															<div class="col-lg-6 col-md-6 col-sm-6 col-6">
																																<div class="line-break">
																																	<label>ACTIVATION START DATE:</label>
																																</div>
																															</div>
																															<div class="col-lg-6 col-md-6 col-sm-6 col-6">
																																<div class="float-end line-break text-right">
																																	<span> {{date('m/d/Y',strtotime($booking_detail->contract_date))}}</span>
																																</div>
																															</div>

																															<div class="col-lg-6 col-md-6 col-sm-6 col-6">
																																<div class="line-break">
																																	<label>EXPIRATION DATE:</label>
																																</div>
																															</div>
																															<div class="col-lg-6 col-md-6 col-sm-6 col-6">
																																<div class="float-end line-break text-right">
																																	<span> {{date('m/d/Y',strtotime($booking_detail->expired_at))}}</span>
																																</div>
																															</div>
																														
																															<div class="col-lg-6 col-md-6 col-sm-6 col-6">
																																<div class="line-break">
																																	<label>DATE BOOKED:	</label>
																																</div>
																															</div>
																															<div class="col-lg-6 col-md-6 col-sm-6 col-6">
																																<div class="float-end line-break text-right">
																																	<span>{{date('m/d/Y',strtotime($booking_detail->created_at))}}</span>
																																</div>
																															</div>
																															
																															@if ($booking_detail->business_services_with_trashed)
																															<div class="col-lg-6 col-md-6 col-sm-6 col-6">
																																<div class="line-break">
																																	<label>BOOKING TIME: </label>
																																</div>
																															</div>
																															<div class="col-lg-6 col-md-6 col-sm-6 col-6">
																																<div class="float-end line-break text-right">
																																	<span> {{date('h:i A', strtotime($booking_detail->business_services_with_trashed->shift_start))}}</span>
																																</div>
																															</div>
																															@endif

																															@if ($booking_detail->customer)
																																<div class="col-lg-6 col-md-6 col-sm-6 col-6">
																																	<div class="line-break">
																																		<label>BOOKED BY:</label>
																																	</div>
																																</div>
																																<div class="col-lg-6 col-md-6 col-sm-6 col-6">
																																	<div class="float-end line-break text-right">
																																		<span>{{$booking_detail->customer->fname}} {{$booking_detail->customer->lname}} (In person)</span>
																																	</div>
																																</div>
																															@endif
																															
																															@if ($booking_detail->business_services_with_trashed)
																																<div class="col-lg-6 col-md-6 col-sm-6 col-6">
																																	<div class="line-break">
																																		<label>ACTIVITY TYPE:</label>
																																	</div>
																																</div>
																																<div class="col-lg-6 col-md-6 col-sm-6 col-6">
																																	<div class="float-end line-break text-right">
																																		<span>{{$booking_detail->business_services_with_trashed->sport_activity}}</span>
																																	</div>
																																</div>
																															@endif

																															@if ($booking_detail->business_services_with_trashed)
																																<div class="col-lg-6 col-md-6 col-sm-6 col-6">
																																	<div class="line-break">
																																		<label>SERVICE TYPE:</label>
																																	</div>
																																</div>
																																<div class="col-lg-6 col-md-6 col-sm-6 col-6">
																																	<div class="float-end line-break text-right">
																																		<span>{{$booking_detail->business_services_with_trashed->formal_service_types()}}</span>
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
																															<div class="col-lg-6 col-md-6 col-8">{{$booking_detail->business_services_with_trashed->program_name}} - {{$booking_detail->business_price_detail_with_trashed->business_price_details_ages_with_trashed->category_title}} </div>
																															<div class="col-lg-6 col-md-6 col-4">
																																<div class="multiple-options">
																																	<div class="setting-icon">
																																		<i class="ri-more-fill"></i>
																																		<ul>
																																			<li><a class="visiting-view" data-behavior="ajax_html_modal" data-url="{{route('visit_modal', ['business_id' => request()->business_id, 'id' => $customerdata->id, 'booking_detail_id' => $booking_detail->id])}}" data-modal-width="modal-70" >
																																					<i class="fas fa-plus text-muted"></i> View Visits </a>
																																			</li>
																																			<li>
																																				<a class="edit-booking-customer" data-behavior="ajax_html_modal" data-url="{{route('business.recurring.index', ['business_id' => request()->business_id, 'customer_id' => $customerdata->id, 'booking_detail_id' => $booking_detail->id ,'type'=>'schedule'])}}" data-modal-width="modal-80"><i class="fas fa-plus text-muted">
																																				</i>Autopay Schedule</a>
																																			</li>
																																			<li>
																																				<a class="edit-booking-customer" data-behavior="ajax_html_modal" data-url="{{route('business.recurring.index', ['business_id' => request()->business_id, 'customer_id' => $customerdata->id, 'booking_detail_id' => $booking_detail->id ,'type'=>'history'])}}" data-modal-width="modal-80"><i class="fas fa-plus text-muted">
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
																																			<label> {{$booking_detail->business_services_with_trashed->program_name}}</label>	
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
																																		<span> {{$booking_detail->booking->order_id}} </span>
																																	</div>
																																</div>
																															
																																<div class="col-lg-6 col-md-6 col-sm-6 col-6">
																																	<div class="line-break">
																																		<label>TOTAL PRICE </label>
																																	</div>
																																</div>
																																<div class="col-lg-6 col-md-6 col-sm-6 col-6">
																																	<div class="float-end line-break text-right">
																																		<span>  ${{$booking_detail->booking->amount}} </span>
																																	</div>
																																</div>
																															
																																<div class="col-lg-6 col-md-6 col-sm-6 col-6">
																																	<div class="line-break">
																																		<label>PAYMENT TYPE:</label>
																																	</div>
																																</div>
																																<div class="col-lg-6 col-md-6 col-sm-6 col-6">
																																	<div class="float-end line-break text-right">
																																		<span>{{$booking_detail->booking->getPaymentDetail()}}</span>
																																	</div>
																																</div>
																																
																																@if ($booking_detail->business_price_detail_with_trashed)
																																	<div class="col-lg-6 col-md-6 col-sm-6 col-6">
																																		<div class="line-break">
																																			<label>TOTAL REMAINING:</label>
																																		</div>
																																	</div>
																																	<div class="col-lg-6 col-md-6 col-sm-6 col-6">
																																		<div class="float-end line-break text-right">
																																			<span>{{$booking_detail->getremainingsession()}}/{{$booking_detail->pay_session}}</span>
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
																																		@if ($booking_detail->business_services_with_trashed)
																																			<span>{{$booking_detail->business_services_with_trashed->program_name}} </span>
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
																																		<span>{{$booking_detail->business_price_detail_with_trashed->business_price_details_ages_with_trashed->category_title}} </span>
																																	</div>
																																</div>

																																<div class="col-lg-6 col-md-6 col-sm-6 col-6">
																																	<div class="line-break">
																																		<label>PRICE OPTION:</label>
																																	</div>
																																</div>
																																<div class="col-lg-6 col-md-6 col-sm-6 col-6">
																																	<div class="float-end line-break text-right">
																																		<span>{{$booking_detail->business_price_detail_with_trashed->price_title}} </span>
																																	</div>
																																</div>

																																<div class="col-lg-6 col-md-6 col-sm-6 col-6">
																																	<div class="line-break">
																																		<label>ACTIVATION START DATE:</label>
																																	</div>
																																</div>
																																<div class="col-lg-6 col-md-6 col-sm-6 col-6">
																																	<div class="float-end line-break text-right">
																																		<span> {{date('m/d/Y',strtotime($booking_detail->contract_date))}}</span>
																																	</div>
																																</div>
																															
																																<div class="col-lg-6 col-md-6 col-sm-6 col-6">
																																	<div class="line-break">
																																		<label>EXPIRATION DATE:</label>
																																	</div>
																																</div>
																																<div class="col-lg-6 col-md-6 col-sm-6 col-6">
																																	<div class="float-end line-break text-right">
																																		<span> {{date('m/d/Y',strtotime($booking_detail->expired_at))}}</span>
																																	</div>
																																</div>
																															
																																<div class="col-lg-6 col-md-6 col-sm-6 col-6">
																																	<div class="line-break">
																																		<label>DATE BOOKED:	</label>
																																	</div>
																																</div>
																																<div class="col-lg-6 col-md-6 col-sm-6 col-6">
																																	<div class="float-end line-break text-right">
																																		<span>{{date('m/d/Y',strtotime($booking_detail->created_at))}}</span>
																																	</div>
																																</div>
																																
																																@if ($booking_detail->business_services_with_trashed)
																																	<div class="col-lg-6 col-md-6 col-sm-6 col-6">
																																		<div class="line-break">
																																			<label>BOOKING TIME: </label>
																																		</div>
																																	</div>
																																	<div class="col-lg-6 col-md-6 col-sm-6 col-6">
																																		<div class="float-end line-break text-right">
																																			<span> {{date('h:i A', strtotime($booking_detail->business_services_with_trashed->shift_start))}}</span>
																																		</div>
																																	</div>
																																@endif
																																@if ($booking_detail->customer)
																																	<div class="col-lg-6 col-md-6 col-sm-6 col-6">
																																		<div class="line-break">
																																			<label>BOOKED BY:</label>
																																		</div>
																																	</div>
																																	<div class="col-lg-6 col-md-6 col-sm-6 col-6">
																																		<div class="float-end line-break text-right">
																																			<span>{{$booking_detail->customer->fname}} {{$booking_detail->customer->lname}} (In person)</span>
																																		</div>
																																	</div>
																																@endif
																																
																																@if ($booking_detail->business_services_with_trashed)
																																	<div class="col-lg-6 col-md-6 col-sm-6 col-6">
																																		<div class="line-break">
																																			<label>ACTIVITY TYPE:</label>
																																		</div>
																																	</div>
																																	<div class="col-lg-6 col-md-6 col-sm-6 col-6">
																																		<div class="float-end line-break text-right">
																																			<span>{{$booking_detail->business_services_with_trashed->sport_activity}}</span>
																																		</div>
																																	</div>
																																@endif
																																
																																@if ($booking_detail->business_services_with_trashed)
																																	<div class="col-lg-6 col-md-6 col-sm-6 col-6">
																																		<div class="line-break">
																																			<label>SERVICE TYPE:</label>
																																		</div>
																																	</div>
																																	<div class="col-lg-6 col-md-6 col-sm-6 col-6">
																																		<div class="float-end line-break text-right">
																																			<span>{{$booking_detail->business_services_with_trashed->formal_service_types()}}</span>
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
																									@foreach ($purchase_history as $history) 
																										@if($history->item_description(request()->business_id)['itemDescription'] != '')
																										<tr>
																											<td>{{date('m/d/Y',strtotime($history->created_at))}}</td>
																											<td>{!!$history->item_description(request()->business_id)['itemDescription']!!}</td>
																											<td>{{$history->item_type_terms()}}</td>
																											<td>{{$history->getPmtMethod()}}</td>
																											<td>${{$history->amount}}</td>
																											<td>{{$history->item_description(request()->business_id)['qty']}}</td>
																											<td>Refund | Void</td>
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
																										<a onclick="deleteMember({{$family_member->id}})" class="btn btn-red mmb-10">Delete</a>

																										<a href="#" onclick="redirctAddfamily({{$customerdata->id}});" class="btn btn-black mmb-10">Edit</a>

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
																				View Visits
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
																									<tr>
																										<td>{{date('m/d/Y',strtotime($visit->checkin_date))}}</td>
																										<td>
																											{{date('h:i A', strtotime($visit->checked_at))}}
																										</td>
																										<td>{{$visit->order_detail->business_services_with_trashed->program_name}}</td>
																										<td>{{$visit->order_detail->business_price_detail_with_trashed->price_title}}</td>
																										
																										<td>
																											@if($visit->status_term())
																												{{$visit->status_term()}}
																											@else
																												<a class="font-red" onclick="getCheckInDetails({{$visit->order_detail->business_id}}, {{$visit->business_activity_scheduler_id}} ,'{{$visit->checkin_date}}','{{$customerdata->id}}');">Unprocess</a>
																											@endif
																											
																										</td>
																										<td>{{ App\BusinessStaff::getinstructorname($visit->order_detail->business_services_with_trashed->instructor_id)}}</td>
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
																										<a href="#" data-modal-width=" " data-behavior="ajax_html_modal" data-url="{{route('business.customers.card_editing_form', ['customer_id' => $customerdata->id, 'return_url' => url()->full()])}}">
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
																								<div class="cards-block dispalycard" style="cursor: pointer" data-name="{{$card->name}}" data-cvv="{{$card->last4}}" data-cnumber="{{$card->exp_month}}" data-month="{{$card->exp_month}}" data-year="$card->exp_year" data-type="{{strtolower($card->brand)}}" data-id="{{$card->id}}">
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
																				Customer Notes & Alerts
																			</button>
																		</h2>
																		<div id="accor_nesting10Examplecollapse2" class="accordion-collapse collapse" aria-labelledby="accordionnesting10Example2" data-bs-parent="#accordionnesting10">
																			<div class="accordion-body">
																				<div class="container-fluid nopadding">
																					<div class="row">
																						<form action="{{route('business.customers.update', ['customer' => $customerdata->id])}}" method="POST">
																							@csrf
																							@method('PUT')
																							<div class="col-lg-12">
																								<textarea class="form-control mb-10" name="notes" rows="4">{{$customerdata->notes}} </textarea>
																							</div>
																							<div class="col-lg-12">
																								<button type="submit" class="btn btn-red float-end">Submit</button>
																							</div>
																						</form>
																					</div>
																				</div>
																			</div>
																		</div>
																	</div>
																	
																	<div class="accordion-item shadow">
																		<h2 class="accordion-header" id="accordionnesting11Example2">
																			<button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#accor_nesting11Examplecollapse2" aria-expanded="false" aria-controls="accor_nesting11Examplecollapse2">
																				Agreed on Terms, Contracts, & Liability Waiver
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
																								<span>Covid-19 Protocols agreed on @if(@$customerdata->terms_covid != '') {{date('m/d/Y',strtotime(@$customerdata->terms_covid))}} @endif </span>
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
																								<span>Liability Waiver agreed on @if(@$customerdata->terms_liability != '') {{date('m/d/Y',strtotime(@$customerdata->terms_liability))}} @endif  </span>
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
																								<span>Contract Terms  agreed on @if(@$customerdata->terms_contract != '') {{date('m/d/Y',strtotime(@$customerdata->terms_contract))}} @endif</span>
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
																							<div class="col-lg-10 col-md-10 col-10">
																								<span>4. </span>
																								<span>Refund Policy </span>
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
																							<div class="col-lg-10 col-md-10 col-10">
																								<span>5. </span>
																								<span>Terms, Conditions, FAQ </span>
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
								<label>	First Name</label>
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
									<input type="text" name="birthdate" class="form-control border-0 dash-filter-picker flatpickr-range flatpiker-with-border" value="@if($customerdata->birthdate != '') {{date('m/d/Y',strtotime($customerdata->birthdate))}} @endif" placeholder="Birthday">
								</div>
							</div>
						</div>
						<div class="col-lg-6 col-md-6 col-sm-6">
							<div class="mb-10">
								<label>	Gender </label>
								<div>
								<input type="radio" name="gender" value="male" {{$customerdata->gender == 'male' ? "checked" : '' }}> Male
								<input type="radio" name="gender" value="female" {{$customerdata->gender == 'female' ? "checked" : '' }}> Female
								<input type="radio" name="gender" value="other" {{$customerdata->gender == 'other' ? "checked" : '' }}> Other
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
						</div>
						<div class="col-lg-6 col-md-6 col-sm-6">
							<div class="mb-10">
								<label>	Profile Picture</label>
								<div class="userblock text-center">
									<div class="login_link s">
										@if($customerdata->profile_pic)
                          			<img src="{{Storage::Url($customerdata->profile_pic)}}" class="customers-name rounded-circle" alt="">
                          		@else
                          			<div class="company-list-text"><p>{{$customerdata->fname[0]}}</p></div>
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
				<input type="hidden" id="chk" name="chk" value="update_personal">
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


<div class="modal fade checkinDetails" tabindex="-1" aria-labelledby="mySmallModalLabel" style="display: none;" aria-hidden="true">
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

@include('layouts.business.footer')
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
	        
	         return $( "<li></li>" )
	                 .data( "item.autocomplete", item )
	                 .append(inner_html)
	                 .appendTo( ul );
	     	};
	   });

		function getCheckInDetails(business_id,scheduleId,date,cid){
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

	   function deleteMember(id) {
			if(id == undefined){
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
		               window.location.reload();
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
      
		flatpickr(".flatpickr-range", {
        	dateFormat: "m/d/Y",
        	maxDate: "01/01/2050",
      });

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
   		window.location.href="/customer/add-family/"+id;
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

	<!-- <script src="https://maps.googleapis.com/maps/api/js?libraries=places&key={{ env('AUTO_COMPLETE_ADDRESS_GOOGLE_KEY') }}&callback=initMap" async defer></script>
 -->	
@endsection