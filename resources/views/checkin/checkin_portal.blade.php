@inject('request', 'Illuminate\Http\Request')
@extends('layouts.business.header')

@section('content')

	@include('layouts.business.new-header')

@php  use App\ActivityCancel; 
$serviceTypeAry = array("all","classes","individual","events","experience");
    $company_data = Auth::user()->current_company;
@endphp
	

    <div class="mt-10">
		<div class="mt-10">
            <div class="container-fluid mt-10">
               <div class="row">
                  <div class="col">
                    <div class="h-100">
                        <div class="row mb-3">
							<div class="col-lg-10 col-md-11 col-sm-11 col-xs-11 mt-10">
								<div class="page-heading">
									<label class="mb-15">Check-in Portal </label>
								</div>
								<div class="page-subheading mb-5">
									<span class="fs-20">Good Morning, {{$name}}</span>
								</div>
								<div class="page-subheading mb-5">
									<span class="fs-15">Date & Time: {{date('m/d/Y')}}, {{date('g:i:s A')}}</span>
								</div>
								<div class="page-subheading mb-5">
									<span class="fs-15">Check-In. You can also quick check alerts and news from {{$company_data->company_name}}</span>
								</div>
							</div>

							<div class="col-lg-2 col-md-1 col-sm-1 col-xs-1 mt-10">
								<div class="page-heading text-right d-flex float-end">
									<!-- <label class="mb-15"><a class="btn btn-red" href="{{route('checkin.check_out' ,['type' => 1])}}">Exit</a></label> -->
									<label class="mb-15 me-3">
										{{-- <a class="btn btn-red" href="{{ route('clear-session-and-welcome') }}" style="background-color: {{ $settings ? $settings->digit_screen_color : '' }}; 
											border-color: {{ $settings ? $settings->digit_screen_color : '' }};" onclick="clearLocalStorage()"> Finish
										</a> --}}
										<a class="btn btn-red" href="#" data-bs-toggle="modal" data-bs-target="#confirmModal">
											Finish
										</a>
									</label>									
									<label class="mb-15"><a type="button" class="btn btn-red" data-bs-toggle="modal" data-bs-target=".exitModal" onclick="clearLocalStorage()">Exit</a></label>
								</div>
								
							</div> <!--end col-->
						</div> <!--end row-->
						
                        <div class="row">
                            <div class="col-xl-3 col-lg-4">								
                                <div class="card">
									<div class="card-body border-bottom-grey">
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <div class="text-center">
													<div class="check-in-profile d-inline-block">
														@if($customer->profile_pic_url)
				                                            <img src="{{$customer->profile_pic_url}}" class="img-thumbnail rounded-circle" alt="user-profile-image">
				                                        @else
				                                            <div class="rounded-circle avatar-xl img-thumbnail user-profile-image shadow no-img-latter">
				                                                <p class="character character-renovate">{{$customer->first_letter}}</p>
				                                            </div>
				                                        @endif
													</div>
													<div class="check-pro-name mt-3">
														<span>{{$name}}</span>
													</div>													
                                                </div>                                                
                                            </div>
                                        </div>
                                    </div>

                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <div class="text-center">
                                                    <label class="fs-15">Money Owed</label>
                                                    @forelse($missedPayments as $i=> $p)
														<div class="row y-middle">
															<div class="col-lg-8 col-md-8 col-8">
																<div class="mb-15">
																	<span>{{$i+1}}. Missed Payment for ${{$p->total_amount}}</span>
																</div>
															</div>
															<div class="col-lg-4 col-md-4 col-4">
																<div class="mb-15">
																	<button type="button" class="btn btn-red"  data-bs-toggle="modal" data-bs-target="#payment-view{{$p->id}}">View</button>
																</div>
															</div>
														</div>

														<!-- Modal -->
														<div class="modal fade payment-view" id="payment-view{{$p->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
															<div class="modal-dialog modal-dialog-centered modal-70">
																<div class="modal-content">
																	<div class="modal-header">
																		<h5 class="modal-title" id="exampleModalLabel"></h5>
																		<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
																	</div>
																	<div class="modal-body">
														           		<div class="live-preview">
														            		<div class="table-responsive">
														                    	<table class="table align-middle table-nowrap mb-0">
														                        	<thead>
														                            	<tr>
														                                	<th scope="col">Payment</th>
														                                 	<th scope="col">Status</th>
														                                   	<th scope="col">Failed or Missed</th>
														                                 	<th scope="col">Failed Payment date </th>
														                                  	<th scope="col"></th>
														                              	</tr>
														                           	</thead>
														                          	<tbody>
														                            	<tr>
														                                	<th scope="row"><a href="#" class="fw-medium">{{$p->UserBookingDetail->business_services_with_trashed->program_name}}</a></th>
														                                 	<td>Failed</td>
														                                  	<td>Failed</td>
														                                  	<td>{{date('m/d/Y' , strtotime($p->payment_date))}}</td>
														                                	<td><a href="#" data-reload="1" data-modal-width="" data-behavior="ajax_html_modal" data-url="{{route('checkin.card_editing_form', ['customer_id' => $customer->id, 'return_url' => url()->full(),'price' => $p->total_amount ,'rid'=> $p->id])}}"  class="link-dangure" onclick="closeModal()">Paynow <i class="ri-arrow-right-line align-middle"></i></a></td>
														                              	</tr>
														                         	</tbody>
														                       	</table>
														                 	</div>
														               	</div>
																	</div>
																</div>
															</div>
														</div>
													@empty
														<div class="row y-middle">
															<div class="col-lg-12 col-md-12 col-12">
																<p class="text-center">No Missed Payment Available</p>
															</div>
														</div>
													@endforelse	
                                                </div>                                                
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- end card -->
                            </div>
                            <!-- end col -->

                            <div class="col-xl-9 col-lg-8">
                                <div>
                                    <div class="card">
                                        <div class="card-header">
                                            <div class="row align-items-center">
                                                <div class="col">
                                                    <ul class="nav nav-tabs-custom card-header-tabs border-bottom-0" role="tablist">
														<li class="nav-item">
                                                            <a class="nav-link fw-semibold @if(request()->activetab == 'checkin' || request()->activetab == '') active @endif" data-bs-toggle="tab" href="#schedule-booking" role="tab">
                                                            	Schedule Bookings
                                                            </a>
                                                        </li>
                                                        <li class="nav-item">
                                                            <a class="nav-link fw-semibold @if(request()->activetab == 'booking' ) active @endif" data-bs-toggle="tab" href="#booking-tab" role="tab">
                                                                Reserve By Membership
                                                            </a>
                                                        </li>
                                                        <li class="nav-item">
                                                            <a class="nav-link fw-semibold @if(request()->activetab == 'schedule' ) active @endif" data-bs-toggle="tab" href="#schedule-tab" role="tab">
                                                                Full Schedule
                                                            </a>
                                                        </li>
                                                    </ul>
                                                </div>
                                                <div class="col-auto">
                                                    <div id="selection-element">
                                                        <div class="my-n1 d-flex align-items-center text-muted">
                                                            Select <div id="select-content" class="text-body fw-semibold px-1"></div> Result <button type="button" class="btn btn-link link-danger p-0 ms-3 shadow-none" data-bs-toggle="modal" data-bs-target="#removeItemModal">Remove</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- end card header -->
                                        <div class="card-body">
                                            <div class="tab-content text-muted">
												<div class="tab-pane @if(request()->activetab == 'checkin' || request()->activetab == '') active @endif" id="schedule-booking" role="tabpanel">
													<div class="col-xxl-12 col-lg-12">
														<div class="card">
															<div class="card-header align-items-center d-flex">
																<h4 class="card-title mb-0 flex-grow-1 font-red">Your Upcoming Classes</h4>
															</div><!-- end card header -->

															<div class="mt-10 ml-10 fs-14" id="error-message"></div>	

															<div class="card-body">
																<div class="live-preview">
																	<div class="table-responsive">
																		<table class="table align-middle table-nowrap mb-0">
																			<thead>
																				<tr>
																					<th scope="col">Session</th>
																					<th scope="col">Program Name </th>
																					<th scope="col">Time and Date</th>
																					<th scope="col">Membership</th>
																					<th scope="col"></th>
																					<th scope="col"></th>
																				</tr>
																			</thead>
																			<tbody>
																				@forelse(@$classes as $c)
																					<tr>
																						<th scope="row">{{@$c->order_detail->getRemainingSessionAfterAttend()."/".@$c->order_detail->pay_session}}</th>
																						<td>{{ @$c->order_detail->business_services_with_trashed->program_name }}</td>
																						<td>{{ date('m/d/Y' ,strtotime($c->checkin_date))}}  {{ date("g:i A", strtotime(@$c->scheduler->shift_start))}} </td>
																						<td> {{ @$c->order_detail->business_price_detail_with_trashed->price_title }}</td>
																						<td>
																							<div class="">
																								<a class="btn btn-red" id="{{$c->id}}"  @if(!$c->checked_at) onclick="checkin('{{$c->id}}');" @endif >@if($c->checked_at) Checked In @else Check-In @endif</a>
																							</div>
																						</td>
																						<td>
																							<div class="">
																								<a class="btn btn-red" href="{{ url('/check-in-portal') . '?' . http_build_query(['business_id' => $c->customer->business_id, 'customer_id' => $c->customer_id,'activetab' => 'booking']) }}">View Booking</a>
																							</div>
																						</td>
																					</tr>
																				@empty
																					{{-- <tr class="text-center"><td colspan="6">No Upcoming Class Available</td></tr> --}}
																					<tr class="text-center"><td colspan="6">No Upcoming Reservations</td></tr>
																				@endforelse
																			</tbody>
																		</table>
																	</div>
																</div>
															</div><!-- end card-body -->
														</div><!-- end card -->
													</div>

													<div class="col-xxl-12 col-lg-12">
														<div class="card space-btw">
															<div class="card-header align-items-center d-flex">
																<h4 class="card-title mb-0 flex-grow-1 font-red">Important Alerts</h4>
															</div><!-- end card-header -->

															<div class="card-body">
																<div class="dashed-border p-tb-10">
																	<div class="row y-middle">
																		<div class="col-lg-8 col-md-8 col-sm-8 col-12">
																			<div class="d-flex">
																				<i class="fa fa-user fs-18"></i>
																				<h6 class="mb-1 lh-base ms-3">Total Active Memberships <span class="font-red">({{$activeMembershipCnt}})({{$activeMembershipCntNew}} New)</span></h6>
																			</div>
																		</div>
																		<div class="col-lg-4 col-md-4 col-sm-4 col-12">
																			<div class="flex-grow-1 ms-3 text-end">

																				<a class="btn btn-red" href="{{ url('/check-in-portal') . '?' . http_build_query(['business_id' => request()->business_id, 'customer_id' => request()->has('customer_id') ? request()->customer_id : null,'type' => request()->has('type') ? request()->type : null ,'activetab' => 'booking']) }}">View</a>
																			</div>
																		</div>
																	</div>
																</div>

																<div class="dashed-border p-tb-10">
																	<div class="row y-middle">
																		<div class="col-lg-8 col-md-8 col-sm-8 col-12">
																			<div class="d-flex">
																				<i class="fa fa-sticky-note fs-18"></i>
																				<h6 class="mb-1 lh-base ms-3"> Notes &amp; Alerts <span class="font-red">({{$notesCnt}})({{$notesCntNew}} New)</span> </h6>
																			</div>
																		</div>
																		<div class="col-lg-4 col-md-4 col-sm-4 col-12">
																			<div class="flex-grow-1 ms-3 text-end">
																				<button type="button" class="btn btn-red zfold-none" onClick="opennotesalerts()"> View </button>
																			</div>

																			<nav class="com-sidebar">
																				<div class="navbar-wrapper">
																					<div id="Notes_Alerts" class="com-sidepanel setsidepanel">
																						<div class="navbar-content">
																							<div class="container"> 
																								<div class="row">
																									<div class="col-lg-8 col-8">
																										<div class="setup-title">
																											<label>Notes and Alerts</label>
																										</div>
																									</div>
																									<div class="col-lg-4 col-4">
																										<div class="p-relative">
																											<a href="javascript:void(0)" class="com-cancle fa fa-times" onClick="closenotesalerts()"></a>
																										</div>
																									</div>
																								</div>	
																							</div>
																							<div class="border-bottom-grey mt-10 mb-10"></div>	
																							<div class="container">
																								<!-- Nav tabs -->
																								<ul class="nav nav-tabs mb-3" role="tablist">
																									<li class="nav-item">
																										<a class="nav-link active" data-bs-toggle="tab" href="#Notes" role="tab" aria-selected="false">
																											Provider Notes ({{count($notes)}})
																										</a>
																									</li>
																									<li class="nav-item">
																										<a class="nav-link" data-bs-toggle="tab" href="#Alerts" role="tab" aria-selected="false">
																											 Alerts ({{$alertCount}})
																										</a>
																									</li>
																								</ul>
																								<!-- Tab panes -->
																								<div class="tab-content  text-muted">
																									<div class="tab-pane active" id="Notes" role="tabpanel">
																										<div class="container-fluid nopadding">
																											<div class="row">	
																												@forelse($notes as $n)
																													<div class="row">
																														<div class="col-md-10">
																															<div class="row">
																																<div class="col-md-4">{{$n->title}}</div>
																																<input type="hidden" id="noteTitle{{$n->id}}" value="{{$n->title}}">
																																<input type="hidden" id="noteContent{{$n->id}}" value="{{$n->note}}">
																																<div class="col-md-4">{{date('m/d/Y' ,strtotime($n->created_at))}}</div>
																																<div class="col-md-4">Uploded By  {{$n->User->full_name}}</div>
																															</div>
																														</div>
																														
																														<div class="col-md-2 mb-10">
																															<div class="text-right">
																																<button class="btn btn-red btn-sm dropdown" onclick="openNoteModal('{{$n->id}}')" ><i class="ri-eye-fill fs-14" ></i></button>
																															</div>
																															
																														</div>
																													</div>
																												@empty
																													<p>No Notes Available</p>
																												@endforelse
																											</div>
																										</div>
																									</div>
																									<div class="tab-pane" id="Alerts" role="tabpanel">
																										<div class="row">
																											<div class="col-xxl-12 col-lg-12">
																												<div class="card">
																													<div class="card-body">
																														<div class="live-preview">
																															<div class="accordion" id="default-accordion-example">
																																<div class="accordion-item shadow">
																																	<h2 class="accordion-header" id="headingOne">
																																		<button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
																																			Expired Credit Card ({{count($expiredCards)}})
																																		</button>
																																	</h2>
																																	<div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#default-accordion-example">
																																		<div class="accordion-body">
																																			@forelse($expiredCards as $c)
																																			<div class="row y-middle mt-5">
																																				<div class="col-lg-6 col-md-6 col-sm-6 col-3">
																																					Card : **** **** **** {{$c->last4}}
																																				</div>
																																				<div class="col-lg-3 col-md-3 col-sm-3 col-3">
																																					Card Type: {{ $c->brand}}
																																				</div>										
																																				<div class="col-lg-3 col-md-3 col-sm-3 col-3">
																																					Expired On: {{$c->exp_month}}/{{$c->exp_year}}
																																				</div>
																																			</div>
																																			@empty
																																				Not Expired Credit Card Available
																																			@endforelse
																																		</div>
																																	</div>
																																</div>
																																<div class="accordion-item shadow">
																																	<h2 class="accordion-header" id="headingTwo">
																																		<button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
																																			Missed Payment ({{count($missedPayments)}})
																																		</button>
																																	</h2>
																																	<div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#default-accordion-example">
																																		<div class="accordion-body">
																																			<div class="purchase-history">
																																				<div class="table-responsive">
																																					<table class="table mb-0">
																																						<thead>
																																							<tr>
																																								<th>Purchase Date </th>
																																								<th>Item Description </th>
																																								<th>Item Type</th>
																																								<th>Price</th>
																																								<th>Qty</th>
																																								<th>Payment Failed Date</th>
																																							</tr>
																																						</thead>
																																						<tbody>
																																							@forelse($missedPayments as $p)
																																								@if($p->UserBookingDetail)
																																									<tr>
																																										<td>{{date('Y-m-d' , strtotime($p->UserBookingDetail->created_at))}}</td>
																																										<td>{{$p->UserBookingDetail->business_services_with_trashed->program_name}}<br></td>
																																										<td>Membership</td>
																																										<td>${{$p->total_amount}}</td>
																																										<td>1</td>
																																										<td>{{date('m/d/Y' , strtotime($p->payment_date))}}</td>
																																									</tr>	
																																								@endif
																																							@empty
																																								Not Missed Payment Available
																																							@endforelse							
																																						</tbody>
																																					</table>
																																				</div>
																																			</div>
																																		</div>
																																	</div>
																																</div>
																																
																															</div>
																														</div>
																													</div><!-- end card-body -->
																												</div><!-- end card -->
																											</div>
																										</div>
																									</div>
																								</div>
																							</div>
																						</div>
																					</div>
																				</div>
																			</nav>
																		</div>
																	</div>
																</div>

																<div class="dashed-border p-tb-10">
																	<div class="row y-middle">
																		<div class="col-lg-8 col-md-8 col-sm-8 col-12">
																			<div class="d-flex">
																				<i class="fa fa-bullhorn fs-18"></i>
																				<h6 class="mb-1 lh-base ms-3">Announcements &amp; News <span class="font-red">({{$announcemetCnt}})({{$announcemetCntNew}} New)</span></h6>
																			</div>
																		</div>
																		<div class="col-lg-4 col-md-4 col-sm-4 col-12">
																			<div class="flex-grow-1 ms-3 text-end">
																				<button type="button" class="btn btn-red zfold-none" onClick="openannouncements()"> View </button>
																			</div>

																			<nav class="com-sidebar">
																				<div class="navbar-wrapper">
																					<div id="Announcements_News" class="com-sidepanel setsidepanel">
																						<div class="navbar-content">
																							<div class="container"> 
																								<div class="row">
																									<div class="col-lg-8 col-8">
																										<div class="setup-title">
																											<label>Announcement & News</label>
																										</div>
																									</div>
																									<div class="col-lg-4 col-4">
																										<div class="p-relative">
																											<a href="javascript:void(0)" class="com-cancle fa fa-times" onClick="closeannouncements()"></a>
																										</div>
																									</div>
																								</div>	
																							</div>
																							<div class="border-bottom-grey mt-10 mb-10"></div>	
																							<div class="container mb-10">
																								@forelse($announcement as $a)
																									<div class="mb-10 border-bottom-grey pb-10">
																										<div class="row y-middle ">
																											<div class="col-lg-2 col-md-2 col-3">
																												<div class="announcement-day">
																													<span>
																														{{$a->formatDateTime($a->announcement_date.' '.$a->announcement_time)}}</span>
																												</div>
																											</div>
																											<div class="col-lg-9 col-md-10 col-9 border-left">
																												<div class="announcement-heading">
																													<h5>{{$a->title}}</h5>
																													<p>{{$a->short_description ?? "N/A"}}</p>
																												</div>
																											</div>
																											<div class="col-lg-1">
																												<div class="text-right">
																													<button class="btn btn-red btn-sm dropdown" onclick="openAnnoucement('{{$a->id}}');" ><i class="ri-eye-fill fs-14" ></i></button>
																												</div>
																											</div>
																										</div>
																									</div>
																								@empty
																								@endforelse
																							</div>
																						</div>
																					</div>
																				</div>
																			</nav>
																		</div>
																	</div>
																</div>

																<div class="dashed-border p-tb-10">
																	<div class="row y-middle">
																		<div class="col-lg-8 col-md-8 col-sm-8 col-12">
																			<div class="d-flex">
																				<i class="fa fa-file fs-18"></i>
																				<h6 class="mb-1 lh-base ms-3">Documents &amp; Terms Alerts <span class="font-red">({{$docCnt}})({{$docCntNew}} New)</span></h6>
																			</div>
																		</div>
																		<div class="col-lg-4 col-md-4 col-sm-4 col-12">
																			<div class="flex-grow-1 ms-3 text-end">
																				<button type="button" class="btn btn-red zfold-none" onClick="opendoc()"> View </button>
																			</div>

																			<nav class="com-sidebar">
																				<div class="navbar-wrapper">
																					<div id="documents_Terms" class="com-sidepanel setsidepanel">
																						<div class="navbar-content">
																							<div class="container"> 
																								<div class="row">
																									<div class="col-lg-8 col-8">
																										<div class="setup-title">
																											<label>Documents & Terms Alerts</label>
																										</div>
																									</div>
																									<div class="col-lg-4 col-4">
																										<div class="p-relative">
																											<a href="javascript:void(0)" class="com-cancle fa fa-times" onClick="closedoc()"></a>
																										</div>
																									</div>
																								</div>	
																							</div>
																							<div class="border-bottom-grey mt-10 mb-10"></div>	

																							<div class="container"> 
																								<div class="card-header align-items-center d-flex">
																									<h4 class="card-title mb-0 flex-grow-1">Documents</h4>
																								</div><!-- end card header -->

																								@forelse($documents as $d)
																									<div class="row y-middle border-bottom-documents mt-5">
																										<div class="col-lg-3 col-md-2 col-sm-2 col-12">
																											 <div class="">
																												<span><a @if(!$d->CustomerDocumentsRequested->isEmpty())  href="#" onclick="openDocumentModal('{{$d->id}}','load')"  @elseif($d->path) href="{{ route('download', ['id' => $d->id]) }}" target="_blank" @endif> {{$d->title}}</a></span>
																											 </div>
																										</div>
																										<div class="col-lg-3 col-md-3 col-sm-2 col-12">
																											 <div class="">
																												<span><i class="fas fa-link"></i> Uploaded on {{date('m/d/Y', strtotime($d->created_at))}}</span>
																											 </div>
																										</div>
																										<div class="col-lg-2 col-md-2 col-sm-2 col-12">
																											@if($d->sign_date)
																											<div class="">
																												<span>Signed On {{date('m/d/Y', strtotime($d->sign_date))}}</span>
																											</div>
																											@endif
																										</div>

																										<div class="col-lg-1 col-md-2 col-sm-2 col-3">
																											@if($d->status == 1)
																											<div>
																												<button type="button" class="btn btn-red mb-5 mmt-10 mmb-10" onclick="openModal('{{$d->id}}','{{$d->sign_path ? Storage::URL($d->sign_path) :''}}')"> @if($d->sign_date) Edit @else Sign @endif</button>
																											</div>
																											@endif
																										</div>
																										
																										<div  class="col-lg-2 col-md-2 col-sm-3 col-8">
																											@if(!$d->CustomerDocumentsRequested->isEmpty())
																												<button type="button" class="btn btn-red mb-5 mmt-10 mmb-10" onclick="openDocumentModal('{{$d->id}}','{{ $d->checkUploadDocument() == 1 ? "load" : "upload"}}')"> @if($d->checkUploadDocument() == 1) Edit Document @else Document Requested @endif </button>

																											@endif
																										</div>

																										<div class="col-lg-1 col-md-1 col-sm-1 col-1">
																											<div class="multiple-options">
																												<div class="setting-icon">
																													<i class="ri-more-fill"></i>
																													<ul>
																														<li><a  @if(!$d->CustomerDocumentsRequested->isEmpty())  href="#" onclick="event.preventDefault(); openDocumentModal('{{$d->id}}','load')"  @elseif($d->path) href="{{Storage::URL(@$d->path)}}" target="_blank" @endif >  <i class="fas fa-plus text-muted"></i>View</a></li>
																														<li class="dropdown-divider"></li>

																														<li><a @if(!$d->CustomerDocumentsRequested->isEmpty())  href="#" onclick="event.preventDefault(); openDocumentModal('{{$d->id}}','load')"  @elseif($d->path) href="{{ route('download', ['id' => $d->id]) }}" target="_blank" @endif > <i class="fas fa-plus text-muted"></i>Download</a></li>
																														<li class="dropdown-divider"></li>

																														<li><a onclick="deleteDoc({{$d->id}},{{$d->business_id}})"><i class="ri-delete-bin-fill align-bottom me-2 text-muted"></i>Delete</a></li>
																													</ul>
																												</div>
																											</div>
																										</div>
																									</div>
																								@empty	
																									Document Not Available
																								@endforelse
																							</div>
																							<div class="container"> 
																								<div class="row">
																									<div class="col-lg-8 col-8">
																										<div class="setup-title">
																											<label>Agreed Terms & Contracts</label>
																										</div>
																									</div>
																								</div>	
																							</div>

																							<div class="container">
																								<div class="row y-middle border-bottom-documents">
																									<div class="col-lg-7 col-md-5 col-sm-5 col-7">
																										<div class="mmt-10 mmb-10">
																											<span>Covid-19 Protocols @if(@$customer->terms_covid) agreed on {{date('m/d/Y',strtotime(@$customer->terms_covid))}} @endif  </span>
																										</div>
																									</div>
																									<div class="col-lg-3 col-md-3 col-sm-3 col-7">
																										@if(@$customer->terms_covid)
																										 	<div class="mmt-10 mmb-10">
																												<span>Signed on {{date('m/d/Y',strtotime(@$customer->terms_covid))}} </span>
																										 	</div>
																										@endif
																									</div>

																									<div class="col-lg-1 col-md-2 col-sm-2 col-3">
																										@if(!@$customer->terms_covid)
																										<div>
																											<button type="button" class="btn btn-red float-right mb-5 mt-5" onclick="openTermsModal('{{$customer->id}}','{{$customer->covid_sign_path ? Storage::URL($customer->covid_sign_path) :''}}','covid')">Sign </button>
																										</div>
																										@endif
																									</div>

																									<div class="col-lg-1 col-md-2 col-sm-2 col-2">
																										<div class="multiple-options">
																											<div class="setting-icon">
																												<i class="ri-more-fill"></i>
																												<ul>
																													<li><a onclick="downloadPdf('{{request()->business_id}}', 'covid');"><i class="fas fa-plus text-muted"></i>Download</a></li>
																													<li><a onclick="viewPdf('covidDiv');"><i class="fas fa-plus text-muted"></i>View</a></li>
																												</ul>
																											</div>
																										</div>
																									</div>									
																								</div>
																								<div class="row y-middle border-bottom-documents">
																									<div class="col-lg-7 col-md-5 col-sm-5 col-7">
																										<div class="mmt-10 mmb-10">
																											<span>Liability Waiver @if(@$customer->terms_liability) agreed on {{date('m/d/Y',strtotime(@$customer->terms_liability))}}  @endif</span>
																										</div>
																									</div>

																									<div class="col-lg-3 col-md-3 col-sm-3 col-7">
																										@if(@$customer->terms_liability)
																										 	<div class="mmt-10 mmb-10">
																												<span>Signed on {{date('m/d/Y',strtotime(@$customer->terms_liability))}} </span>
																										 	</div>
																										@endif
																									</div>
																									
																									<div class="col-lg-1 col-md-2 col-sm-2 col-3">
																										@if(!@$customer->terms_liability)
																										<div>
																											<button type="button" class="btn btn-red float-right mb-5 mt-5" onclick="openTermsModal('{{$customer->id}}','{{$customer->liability_sign_path ? Storage::URL($customer->liability_sign_path) :''}}','liability')">Sign </button>
																										</div>
																										@endif
																									</div>
																									<div class="col-lg-1 col-md-2 col-sm-2 col-2">
																										<div class="multiple-options">
																											<div class="setting-icon">
																												<i class="ri-more-fill"></i>
																												<ul>
																													<li><a onclick="downloadPdf('{{request()->business_id}}', 'liability');"><i class="fas fa-plus text-muted"></i>Download</a></li>
																													<li><a onclick="viewPdf('liabilityDiv');"><i class="fas fa-plus text-muted"></i>View</a></li>
																												</ul>
																											</div>
																										</div>
																									</div>										
																								</div>

																															
																								<div class="row y-middle border-bottom-documents">
																									<div class="col-lg-7 col-md-5 col-sm-5 col-7">
																										 <div class="mmt-10 mmb-10">
																											<span>Contract Terms @if(@$customer->terms_contract) agreed on {{date('m/d/Y',strtotime(@$customer->terms_contract))}}  @endif</span>
																										 </div>
																									</div>

																									<div class="col-lg-3 col-md-3 col-sm-3 col-7">
																										@if(@$customer->terms_contract)
																										 	<div class="mmt-10 mmb-10">
																												<span>Signed on {{date('m/d/Y',strtotime(@$customer->terms_contract))}} </span>
																										 	</div>
																										@endif
																									</div>
																									
																									<div class="col-lg-1 col-md-2 col-sm-2 col-3">
																										@if(!@$customer->terms_contract)
																										<div>
																											<button type="button" class="btn btn-red float-right mb-5 mt-5" onclick="openTermsModal('{{$customer->id}}','{{$customer->contract_sign_path ? Storage::URL($customer->contract_sign_path) :''}}','contract')">Sign </button>
																										</div>
																										@endif
																									</div>
																									
																									<div class="col-lg-1 col-md-2 col-sm-2 col-2">
																										<div class="multiple-options">
																											<div class="setting-icon">
																												<i class="ri-more-fill"></i>
																												<ul>
																													<li><a onclick="downloadPdf('{{request()->business_id}}', 'contract');"><i class="fas fa-plus text-muted"></i>Download</a></li>
																													<li><a onclick="viewPdf('contractDiv');"><i class="fas fa-plus text-muted"></i>View</a></li>
																												</ul>
																											</div>
																										</div>
																									</div>									
																								</div>

																								@php 
																									$refundDate = @$lastBooking->created_at != '' ? date('m/d/Y',strtotime(@$lastBooking->created_at)) : date('m/d/Y',strtotime(@$customer->terms_refund)); 
																								@endphp
																								<div class="row y-middle border-bottom-documents">
																									<div class="col-lg-7 col-md-5 col-sm-5 col-7">
																										 <div class="mmt-10 mmb-10">
																											<span>Refund Policy @if(@$refundDate) agreed on {{$refundDate}} @endif</span>
																										 </div>
																									</div>

																									<div class="col-lg-3 col-md-3 col-sm-3 col-7">
																										@if(@$refundDate)
																										 	<div class="mmt-10 mmb-10">
																												<span>Signed on {{$refundDate}} </span>
																										 	</div>
																										@endif
																									</div>
																									
																									<div class="col-lg-1 col-md-2 col-sm-2 col-3">
																										@if(!@$lastBooking->created_at)
																										<div>
																											<button type="button" class="btn btn-red float-right mb-5 mt-5" onclick="openTermsModal('{{$customer->id}}','{{$customer->refund_sign_path ? Storage::URL($customer->refund_sign_path) :''}}','refund')">{{$customer->refund_sign_path != '' ?  'Edit' : 'Sign' }} </button>
																										</div>
																										@endif
																									</div>
																									<div class="col-lg-1 col-md-2 col-sm-2 col-2">
																										<div class="multiple-options">
																											<div class="setting-icon">
																												<i class="ri-more-fill"></i>
																												<ul>
																													<li><a onclick="downloadPdf('{{request()->business_id}}', 'refund');"><i class="fas fa-plus text-muted"></i>Download</a></li>
																													<li><a onclick="viewPdf('refundDiv');"><i class="fas fa-plus text-muted"></i>View</a></li>
																												</ul>
																											</div>
																										</div>
																									</div>								
																								</div>

																								@php 
																									$termsDate = @$lastBooking->created_at != '' ? date('m/d/Y',strtotime(@$lastBooking->created_at)) : date('m/d/Y',strtotime(@$customer->terms_condition)); 
																								@endphp
																								<div class="row y-middle border-bottom-documents">
																									<div class="col-lg-7 col-md-5 col-sm-5 col-7">
																										 <div class="mmt-10 mmb-10">
																											<span>Terms, Conditions, FAQ  @if(@$termsDate) agreed on {{@$termsDate}} @endif</span>
																										 </div>
																									</div>

																									<div class="col-lg-3 col-md-3 col-sm-3 col-7">
																										@if(@$termsDate)
																										 	<div class="mmt-10 mmb-10">
																												<span>Signed on {{$termsDate}} </span>
																										 	</div>
																										@endif
																									</div>

																									<div class="col-lg-1 col-md-2 col-sm-2 col-3">
																										@if(!@$lastBooking->created_at)
																										<div>
																											<button type="button" class="btn btn-red float-right mb-5 mt-5" onclick="openTermsModal('{{$customer->id}}','{{$customer->terms_sign_path ? Storage::URL($customer->terms_sign_path) :''}}','terms')">{{$customer->terms_sign_path != '' ?  'Edit' : 'Sign' }} </button>
																										</div>
																										@endif
																									</div>
																									<div class="col-lg-1 col-md-2 col-sm-2 col-2">
																										<div class="multiple-options">
																											<div class="setting-icon">
																												<i class="ri-more-fill"></i>
																												<ul>
																													<li><a onclick="downloadPdf('{{request()->business_id}}', 'terms');"><i class="fas fa-plus text-muted"></i>Download</a></li>
																													<li><a onclick="viewPdf('termsDiv');"><i class="fas fa-plus text-muted"></i>View</a></li>
																												</ul>
																											</div>
																										</div>
																									</div>									
																								</div>

																							</div>
																						</div>
																					</div>
																				</div>
																			</nav>
																		</div>
																	</div>
																</div>
															</div><!-- end card body -->
														</div><!-- end card -->
													</div>
												</div>

                                                <div class="tab-pane  @if(request()->activetab == 'booking') active @endif" id="booking-tab" role="tabpanel">
													<div class="row">
														<div class="col-lg-12">
															<div class="card">
																<div class="card-body">
																	<div class="row">
																		<div class="col-lg-12 col-md-6 col-12">
																			<div class="form-group mmt-10 desktop-none-booking">
																				<select class="form-select" name="filterOption" id="filterOption" onchange="changeType(this)">
																					<option value="all" @if(request()->serviceType == '' || request()->serviceType == 'all') selected @endif>All</option>
																					<option value="individual" @if(request()->serviceType == 'individual') selected @endif>Personal Trainer </option>
																					<option value="classes" @if(request()->serviceType == 'classes') selected @endif>Classes </option>
																					<option value="events" @if(request()->serviceType == 'events') selected @endif>Events</option>
																					<option value="experience" @if(request()->serviceType == 'experience') selected @endif>Experiences </option>
																				</select>
																			</div>
																		</div>
																		<div class="col-lg-12 col-md-6 col-12">
																			<div class="form-group mmt-10 desktop-none-booking">
																				<select class="form-select" name="changeTab" id="changeTab" onchange="changeTab(this.value ,'mobile')">
																					<option value="current">Active Memberships</option>
																					<option value="today">Today </option>
																					<option value="upcoming">Upcoming</option>
																					<option value="past">Past</option>
																				</select>
																			</div>
																		</div>
																	</div>

																	<div class="nav-custom-grey nav-custom mb-3">
																		<div class="row">
																			<div class="col-lg-6">
																				<div class="btn-group mobile-none">
									                                                <button class="btn btn-booking-activity dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
									                                                    @if(request()->serviceType) @if(request()->serviceType == 'individual') Personal Traning @else {{ucfirst(request()->serviceType)}} @endif @else Filter Options @endif
									                                                </button>
									                                                <div class="dropdown-menu" style="">
									                                                    <a class="dropdown-item" href="{{route('check-in-portal',array_merge(request()->query(), ['serviceType'=> null, 'activetab' => 'booking']))}}">All</a>
									                                                    <a class="dropdown-item" href="{{route('check-in-portal',array_merge(request()->query(), ['serviceType'=>'individual','activetab' => 'booking']))}}">Personal Trainer </a>
									                                                    <a class="dropdown-item" href="{{route('check-in-portal', array_merge(request()->query(), ['serviceType'=>'classes','activetab' => 'booking']))}}">Classes </a>
																						<a class="dropdown-item" href="{{route('check-in-portal',array_merge(request()->query(), ['serviceType'=>'events','activetab' => 'booking']))}}">Events </a>
																						<a class="dropdown-item" href="{{route('check-in-portal',array_merge(request()->query(), ['serviceType'=>'experience','activetab' => 'booking']))}}">Experiences </a>
									                                                </div>
									                                            </div>
																			</div>
																				
																			<div class="col-lg-6">
																				<!-- Nav tabs -->
																				<ul class="nav nav-pills float-right mobile-none" role="tablist">
																					<li class="nav-item">
																						<a class="nav-link active" data-bs-toggle="tab" href="#nav-current" role="tab" onclick="changeTab('curernt','')">Active Memberships</a>
																					</li>
																					<li class="nav-item">
																						<a class="nav-link" data-bs-toggle="tab" href="#nav-today" role="tab" onclick="changeTab('today','')">Today</a>
																					</li>
																					<li class="nav-item">
																						<a class="nav-link" data-bs-toggle="tab" href="#nav-upcoming" role="tab" onclick="changeTab('upcoming','')">Upcoming</a>
																					</li>
																					<li class="nav-item">
																						<a class="nav-link" data-bs-toggle="tab" href="#nav-past" role="tab" onclick="changeTab('past','')">Past</a>
																					</li>
																				</ul>
																			</div>
																		</div>
																	</div>
																	<div class="tab-content text-muted">
																		<input type="hidden" id="serchType" value="current">
																		<div class="row">
																			<div class="col-lg-5 col-md-5 col-12">
																				<label class="text-muted">
																					Today Date: {{ date('l, F d, Y')}}
																				</label>
																			</div>
																			<div class="col-lg-7 col-md-7 col-12">
																				<div class="float-right mb-20">
																					<div class="search-set mr-5">
																						<div class="position-relative">
																							<input type="text" class="form-control" placeholder="Search By Activity" autocomplete="off" onkeyup="serchByActivty()" id="activityName">
																							<!--<span class="mdi mdi-magnify search-widget-icon"></span>-->
																						</div>
																					</div>
																					
																					<div class="multiple-options">
																						<a class="setting-icon" data-bs-toggle="modal" data-bs-target=".accessControl" >
																							<i class="ri-more-fill"></i>
																						</a>
																					</div>
																				</div>
																			</div>
																			<div class="col-lg-12 col-12">
																				<div class="active-member">
																					<h3>Active Membership Available For Bookings</h3>
																					<p>You can use an available membership below to reserve your spot in an activity</p>
																					<!-- <button class="btn btn-red" data-bs-toggle="modal" data-bs-target="#detailsmdoal">Modal</button> -->
																				</div>
																			</div>
																		</div>

																		<div class="tab-pane active" id="nav-current" role="tabpanel">
																			<div class="">
																				<div class="live-preview">
																					<div class="accordion custom-accordionwithicon accordion-border-box tabdatacurrent" id="accordionnesting">
																						@include('personal.orders.user_booking_detail', ['orderDetails' =>$currentBooking,'tabName' => 'current' ,'reserveUrl' => 1,'membershipbtn' => @$settings->membership_option ?? 1 ])
																					</div>
																				</div>
																			</div><!-- end card-body -->
									                                    </div>
																		<div class="tab-pane" id="nav-today" role="tabpanel">
																			<div class="">
																				<div class="live-preview">
																					@php  
																						$todayBooking= [];
										                                                $br = new \App\Repositories\BookingRepository;
										                                                $BookingDetail = $br->tabFilterData($bookingDetails,'today',request()->serviceType ,date('Y-m-d'));
										                                                foreach($BookingDetail as $i=>$book_details){
																				            $todayBooking[@$book_details->business_services_with_trashed->id .'!~!'.@$book_details->business_services_with_trashed->program_name] [] = $book_details;
																				        }
										                                            @endphp
																					<div class="accordion custom-accordionwithicon accordion-border-box tabdatatoday" id="accordionnesting">
																						@include('personal.orders.user_booking_detail', ['orderDetails' => @$todayBooking, 'tabName' => 'today','customer'=>$customer ,'reserveUrl' => 1 ,'membershipbtn' => @$settings->membership_option ?? 1 ])
																					</div>
																				</div>
																			</div><!-- end card-body -->
									                                    </div>
																		<div class="tab-pane" id="nav-upcoming" role="tabpanel">
																			<div class="">
																				<div class="live-preview">
																					@php
																						$upcomimgBooking= [];
										                                                $br = new \App\Repositories\BookingRepository;
										                                                $BookingDetail = $br->tabFilterData($bookingDetails,'upcoming',request()->serviceType ,date('Y-m-d'));
										                                                foreach($BookingDetail as $i=>$book_details){
																				            $upcomimgBooking[@$book_details->business_services_with_trashed->id .'!~!'.@$book_details->business_services_with_trashed->program_name] [] = $book_details;
																				        }
										                                            @endphp
																					<div class="accordion custom-accordionwithicon accordion-border-box tabdataupcoming" id="accordionnesting">
																						@include('personal.orders.user_booking_detail', ['orderDetails' => @$upcomimgBooking, 'tabName' => 'upcoming','customer'=>$customer,'reserveUrl' => 1,'membershipbtn' => @$settings->membership_option ?? 1])
																					</div>
																				</div>
																			</div><!-- end card-body -->
									                                    </div>
																		<div class="tab-pane" id="nav-past" role="tabpanel">
																			<div class="">
																				<div class="live-preview">
																					@php
																						$upcomimgBooking= [];
										                                                $br = new \App\Repositories\BookingRepository;
										                                                $BookingDetail = $br->tabFilterData($bookingDetails,'past',request()->serviceType ,date('Y-m-d'));
										                                                foreach($BookingDetail as $i=>$book_details){
																				            $upcomimgBooking[@$book_details->business_services_with_trashed->id .'!~!'.@$book_details->business_services_with_trashed->program_name] [] = $book_details;
																				        }
											                                        @endphp
																					<div class="accordion custom-accordionwithicon accordion-border-box tabdatapast" id="accordionnesting" >
																						@include('personal.orders.user_booking_detail', ['orderDetails' => @$upcomimgBooking, 'tabName' => 'past','customer'=>$customer,'reserveUrl' => 1,'membershipbtn' => @$settings->membership_option ?? 1])
																					</div>
																				</div>
																			</div><!-- end card-body -->
									                                    </div>
																	</div>
																</div><!-- end card-body -->
															</div>
														</div><!-- end col -->
													</div>
                                                </div>
                                                <!-- end tab pane -->

                                                <div class="tab-pane  @if(request()->activetab == 'schedule') active @endif" id="schedule-tab" role="tabpanel">
													<div class="row">
														<div class="col-md-12 col-xs-12 ">
															<div class="activity-schedule-tabs">
																<ul class="nav nav-tabs" role="tablist">
																	@foreach($serviceTypeAry as $st)
																		<li @if($serviceType == $st ) class="active" @endif>
																			<a class="nav-link" href="{{$request->fullUrlWithQuery(['stype' => $st ,'activetab' => 'schedule'])}}"  aria-expanded="true">@if( $st == 'individual') PRIVATE LESSONS @else {{strtoupper($st)}} @endif</a>
																		</li>
																	@endforeach
																</ul>
																<div class="tab-content" style="min-height: 600px;">
																	@foreach($serviceTypeAry as $st)
																	<div class="tab-pane @if($serviceType == $st ) active @endif" id="tabs-{{$st}}" role="tabpanel">
																		<div class="row">
																			<div class="col-md-12 col-sm-12 col-xs-12 text-right">
																				<div class="calendar-icon">
																					<input type="text" name="date" class="date datepicker" readonly placeholder="DD/MM/YYYY" />
																				</div>
																			</div>
																		</div>
																		<div class="row">
																			<div class="owl-carousel owl-theme schedulers-arrows">
																			@foreach ($days as $date)
																				@php
																					$hint_class = ($filter_date->format('Y-m-d') == $date->format('Y-m-d')) ? 'pairets' : 'pairets-inviable';
																				@endphp
																				<div class="item">
																					<div class="{{$hint_class}}">
																						<a href="{{$request->fullUrlWithQuery(['date' => $date->format('Y-m-d') ,'activetab' => 'schedule'])}}" class="calendar-btn">{{$date->format("D d")}}</a>
																					</div>
																				</div>
																			@endforeach
																			</div>
																		</div>
																		
																		<div class="tab-data">
																			<div class="row">
																				<div class="col-md-4 col-sm-4 col-xs-12">
																					<div class="checkout-sapre-tor">
																					</div>
																				</div>
																				<div class="col-md-4 col-sm-4 col-xs-12 valor-mix-title">
																					<label>Activities on {{$filter_date->format("l, F j")}}</label>
																				</div>
																				<div class="col-md-4 col-sm-4 col-xs-12">
																					<div class="checkout-sapre-tor">
																					</div>
																				</div>
																			</div>
																			<div class="activity-tabs">
																				@php $categoryList = []; @endphp
																				@if($serviceType == $st && !empty($services))
																					@foreach($services as $ser)
																						@php  
																							if($priceid != ''){
																								$pricelist =  @$ser->price_details()->find($priceid);
																								if(@$pricelist->business_price_details_ages){
																									$categoryList [] = @$pricelist->business_price_details_ages;
																								}
																							}else{
																								// $cat=App\BusinessPriceDetailsAges::where('serviceid',$ser->id)->where('class_type',$ser->service_type)->get();
																								$cat = App\BusinessPriceDetailsAges::getCategoriesByServiceAndType($ser->id, $ser->service_type);
																								foreach ($cat as $category) {
																									$categoryList [] = $category;
																								}
																								// foreach(@$ser->BusinessPriceDetailsAges as $cat){
																								// 	$categoryList [] = $cat;
																								// }
																							}
																						@endphp
																					@endforeach
																					@php 	
																						function customKeySort($a, $b) {
																						    $timeA = strtotime($a);
																						    $timeB = strtotime($b);
																						    
																						    if ($timeA == $timeB) {
																						        return 0;
																						    }
																						    return ($timeA < $timeB) ? -1 : 1;
																						}
																						$schedule = [];
																						foreach($categoryList as $c){
																							
																							foreach($c->BusinessActivityScheduler as $sc){
																								if($sc->end_activity_date >= $filter_date->format('Y-m-d') && $sc->starting <= $filter_date->format('Y-m-d')){
																									if(strpos($sc->activity_days, $filter_date->format('l')) !== false){
																										$cancelSc = $sc->activity_cancel->where('cancel_date',$filter_date->format('Y-m-d'))->first();
																										$hide_cancel = @$cancelSc->hide_cancel_on_schedule;
																										if(@$cancelSc->cancel_date_chk == 0 ){
																											$hide_cancel = 0;
																										}
																										if($hide_cancel == '' || $hide_cancel != 1 ){
																											$schedule[$sc->shift_start][] = $c;
																										}
																									}
																								}
																							}
																						}

																						uksort($schedule, 'customKeySort');
																						$categoryListFull = [];
																						foreach ($schedule as $value) {
																						    $categoryListFull = array_merge($categoryListFull, (array)$value);
																						}
																						$categoryListFull = array_unique($categoryListFull);
																					@endphp 

																					@if(!empty($categoryListFull) && count($categoryListFull)>0)
																						@foreach($categoryListFull as $cList)
																							@php  $sche_ary = [];
																							foreach($cList->BusinessActivityScheduler as $sc){
																								if($sc->end_activity_date >= $filter_date->format('Y-m-d') && $sc->starting <= $filter_date->format('Y-m-d')){
																									if(strpos($sc->activity_days, $filter_date->format('l')) !== false){
																										$cancelSc = $sc->activity_cancel->where('cancel_date',$filter_date->format('Y-m-d'))->first();
																										$hide_cancel = @$cancelSc->hide_cancel_on_schedule;
																										if(@$cancelSc->cancel_date_chk == 0 ){
																											$hide_cancel = 0;
																										}
																										if($hide_cancel == '' || $hide_cancel != 1 ){
																											$sche_ary [] = $sc;
																										}
																									}
																								}
																							} 
																							if(!empty($sche_ary)){
																							@endphp
																								<div class="row">
																									<div class="col-md-6 col-sm-6 col-xs-12">
																										<div class="classes-info text-left">
																											<div class="row">
																												{{-- 
																												<div class="col-md-12 col-xs-12">
																													<label class="fs-16">Scheduler Name: </label> <span class="fs-16">{{@$cList->category_title}}</span>
																												</div>
																												--}}
																												<div class="col-md-12 col-xs-12 ">
																													<label>Activity Name: </label> <span> {{$cList->BusinessServices->program_name}}</span>
																												</div>
																												<div class="col-md-12 col-xs-12">
																													<div class="text-left line-height-1">
																														<label>Activity: </label> <span> {{$cList->BusinessServices->sport_activity}}</span>
																													</div>
																												</div>
																											</div>
																										</div>
																									</div>
																									
																									<div class="col-md-6 col-sm-6 col-xs-12">
																										<div class="row">
																											@if(!empty($sche_ary))
																												@foreach($sche_ary as $scary)
																													@php 
																														$duration = $scary->get_duration();

																														$SpotsLeftdis = 0;
																														$bs = new  \App\Repositories\BookingRepository;
																														$bookedspot = $bs->gettotalbooking($scary->id,$filter_date->format('Y-m-d')); 
																														$SpotsLeftdis = $scary->spots_available - $bookedspot;
																														
																												        $cancel_chk = 0;
																														$canceldata = ActivityCancel::where(['cancel_date'=>$filter_date->format('Y-m-d'),'schedule_id'=>$scary->id,'cancel_date_chk'=>1])->first();
																														$date = $filter_date->format('Y-m-d');
																														$time = $scary->shift_start;
																														$st_time = date('Y-m-d H:i:s', strtotime("$date $time"));
																														$current  = date('Y-m-d H:i:s');
																														$difference = round((strtotime($st_time) - strtotime($current))/3600, 1);
																														$timeOfActivity = date('h:i a', strtotime($scary->shift_start));
																														$grayBtnChk = 0;$class = '';
																														if($filter_date->format('Y-m-d') == date('Y-m-d') ){
																															
																															$start = new DateTime($scary->shift_start);
																											                $current = new DateTime();
																											                $current_time =  $current->format("Y-m-d H:i");

																											                if($cList->BusinessServices->can_book_after_activity_starts == 'No' && $cList->BusinessServices->beforetime != '' && $cList->BusinessServices->beforetimeint != ''){
																											                    $matchTime = $start->modify('-'.$cList->BusinessServices->beforetimeint.' '.$cList->BusinessServices->beforetime)->format("Y-m-d H:i");
																											                    if($current_time > $matchTime){
																											                        $grayBtnChk = 1;
																																	$class = 'btn-schedule-grey';
																											                    }
																											                    
																											                }else if($cList->BusinessServices->can_book_after_activity_starts == 'Yes' && $cList->BusinessServices->beforetime != '' && $cList->BusinessServices->beforetimeint != ''){
																											                    $matchTime = $start->modify('+'.$cList->BusinessServices->aftertimeint.' '.$cList->BusinessServices->aftertime)->format("Y-m-d H:i");
																											                    if($current_time > $matchTime){
																											                        $grayBtnChk = 1;
																																	$class = 'btn-schedule-grey';
																											                    }
																											                }

																														}


																														if($SpotsLeftdis == 0){
																															$grayBtnChk = 2;
																															$class = 'btn-schedule-grey';
																														}

																														if($canceldata != ''){
																															$grayBtnChk = 3;
																															$class = 'btn-schedule-grey';
																														}

																														if($scary->chkReservedToday($filter_date->format('Y-m-d'))){
																															$class = 'btn-schedule-grey';
																															$grayBtnChk = 4;
																														}

																														$insName = $scary->getInstructure($filter_date->format('Y-m-d'));
																													@endphp

																													<div class="col-md-4 col-sm-5 col-xs-12">
																														<div class="classes-time">
																															<button class="post-btn {{$class}} activity-scheduler" onclick="openPopUp({{$scary->id}} , {{$cList->BusinessServices->id}} ,'{{$cList->BusinessServices->program_name}}','{{$timeOfActivity}}',{{$grayBtnChk}},'{{$scary->category_id}}');"  {{ ( $SpotsLeftdis == 0 || $grayBtnChk == 4 || $canceldata != '' )?  "disabled" : ''}}  >{{$timeOfActivity}} <br>{{$duration}}</button>
																															<label>{{ $SpotsLeftdis == 0 ? 
																																"Sold Out" : $SpotsLeftdis."/".$scary->spots_available."  Spots Left" }}</label>

																															@if($canceldata != '')<label class="font-red">Cancelled</label>@endif

																															@if($scary->chkReservedToday($filter_date->format('Y-m-d')))<label class="font-green">Already Reserved</label>@endif

																															<label>{{ $insName }}</label>
																														</div>
																													</div>
																												@endforeach
																											@else
																												<div class="col-md-12 col-sm-6 col-xs-12 noschedule">No Time available</div>
																											@endif
																											</div>
																										</div>
																										<div class="col-md-12 col-xs-12">
																											<div class="checkout-sapre-tor">
																											</div>
																										</div>
																									</div> 
																							@php } @endphp
																						@endforeach
																					@endif
																				@endif
																			</div>
																		</div>
																	</div>
																	@endforeach
																</div>
															</div>
														</div>
													</div>
                                                </div>
                                                <!-- end tab pane --> 

                                            </div>
                                            <!-- end tab content -->
                                        </div>
                                        <!-- end card body -->
                                    </div>
                                    <!-- end card -->
                                </div>
                            </div>
                            <!-- end col -->
                        </div><!-- end row -->
					</div> <!-- end .h-100-->
                  </div> <!-- end col -->
                </div>
            </div><!-- container-fluid -->
        </div><!-- End Page-content -->
    </div><!-- end main content-->

<!-- Modal -->
	
	<div class="modal fade removeaccess" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-modal="true">
		<div class="modal-dialog modal-dialog-centered" id="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<div class="modal-body">
					<div class="text-center">
						<p class="fs-14">You are about to remove your sync with Fitness {{@$business->public_company_name}} denying access, the provider will no longer be able to link with your account. This allows the provider to automatically update your account and booking information with them.</p>
						<a class="addbusiness-btn-modal btn btn-red" href="{{route('personal.grantAccess',['business_id'=>request()->business_id ,'customerId'=>@$customer->id ,'type' => request()->type,'status' =>'deny'])}}">Deny Access</a>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="modal fade accessControl" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-modal="true">
		<div class="modal-dialog modal-dialog-centered" id="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<div class="modal-body">
					<div class="text-center mb-mv-25">
						<h4 class="mb-10">Access Control</h4>
						@if(@$customer->user_id)
							<a class="btn btn-success">Access Granted</a>
							<a class="addbusiness-btn-modal btn btn-red" data-bs-toggle="modal" data-bs-target=".removeaccess" >Deny Access</a>
						@else
							<a class=" btn btn-red" href="{{route('personal.grantAccess',['business_id'=>request()->business_id ,'customerId'=>@$customer->id ,'type' => request()->type,'status' =>'grant'])}}">No-Access Granted</a>
						@endif
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="modal fade in modal-middle ajax_html_modal" tabindex="-1" aria-labelledby="mySmallModalLabel" data-bs-focus="false"  aria-hidden="true" >
		<div class="modal-dialog modal-dialog-centered" id="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<div class="modal-body" id='booking-time-model'>
	            </div>
			</div>
		</div>
	</div>

	<div class="modal fade"  id="selectbooking" tabindex="-1" aria-labelledby="mySmallModalLabel" data-bs-focus="false"  aria-hidden="true" >
		<div class="modal-dialog modal-dialog-centered" id="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<div class="modal-body" id='select-booking-type-checkin'>
	            </div>
			</div>
		</div>
	</div>

	<div class="modal fade" tabindex="-1" aria-labelledby="mySmallModalLabel" data-bs-focus="false"  aria-hidden="true" id="success-reservation">
		<div class="modal-dialog modal-dialog-centered modal-50" id="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="btn-close" aria-label="Close" onClick="window.location.reload();"></button>
				</div>
				<div class="modal-body" id="receiptbody">
	            	<div class="pay-confirm font-green text-center fs-16"></div>
	            </div>
			</div>
		</div>
	</div>

	<!-- Modal -->
	<div class="modal fade checkinModal" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
	  	<div class="modal-dialog finish-modal-80 modal-dialog-centered">
			<div class="modal-content border-none">
				<div class="modal-body p-0">
					<div class="row y-middle">
						<div class="col-lg-6 col-md-6">
							<div class="checking-popup">
								<img src="{{@$settings->alerts_photo_cover}}" alt="Fitnessity">
							</div>																											
						</div>
						<div class="col-lg-6 col-md-6">
							<div class="text-center mb-mv-25">
								<div class="tick-set">
									<img src="{{url('/dashboard-design/images/tick.png')}}" alt="Fitnessity">
								</div>
								<label class="fs-24 checkinContent"></label>
								<h5 class="mt-3">Is there anything else you would like to do?</h5>
							</div>
							
						</div>
						<div class="p-relative">
							<div class="finish-btn">
								{{-- <a href="{{route('quick-checkin')}}" class="btn btn-red" >Finish</a> --}}
								<a id="yesButton" class="btn btn-red" >Yes</a>
								<a href="{{route('check-in-welcome')}}" class="btn btn-red" >Finish</a>
							</div>
						</div>
					</div>
				</div>
			</div>
	  	</div>
	</div>

	<div class="modal fade autoPayFailedModal" id="exampleModalstaff" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" data-bs-backdrop="static">
	  	<div class="modal-dialog finish-modal-80 modal-dialog-centered">
			<div class="modal-content border-none">
				<!-- <div class="modal-header">
					<button type="button" class="btn-close" onclick="window.location.reload()"></button>
				</div> -->
				<div class="modal-body p-0">
					<div class="p-relative modal-close-set">
						{{-- <button type="button" class="btn-close" onclick="window.location.reload()"></button> --}}
						<button type="button" class="btn-close" onclick="openOtherModal()"></button>
					</div>
					<div class="row y-middle">
						<div class="col-lg-6 col-md-6">
							<div class="checking-popup">
								<img src="{{@$settings->alerts_photo_cover}}" alt="Fitnessity">
							</div>																											
						</div>
						<div class="col-lg-6 col-md-6">
							<div class="text-center mb-mv-25">
								<div class="tick-set">
									<img src="{{url('/dashboard-design/images/cross.png')}}" alt="Fitnessity">
								</div>
								<div class="mb-15">
									<label class="fs-24 mb-0"> Sorry, I can't check you in yet.</label>
									<label class="fs-24 mb-0"> You have a failed auto payment.</label>
									<label class="fs-24 mb-0"> You can see the front desk or resolve now.</label>
								</div>
							</div>
						</div>
						<div class="p-relative">
							<div class="finish-btn">
								<a href="#" data-modal-chkBackdrop="1" data-reload="1" data-modal-width="" data-behavior="ajax_html_modal" data-url="{{route('checkin.autopay_list', ['customer_id' => $customer->id])}}" class="btn btn-red" onclick="closeModal()">Resolve</a>
								{{-- <a class="btn btn-red" href="{{route('checkin.check_out' ,['type' => 0])}}">Finish</a> --}}
								<a class="btn btn-red" href="{{route('check-in-welcome')}}">Finish</a>

							</div>
						</div>
					</div>
				</div>
			</div>
	  	</div>
	</div>

	<div class="modal fade cardExpiredModal" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true"  data-bs-backdrop="static" >
	  	<div class="modal-dialog finish-modal-80 modal-dialog-centered">
			<div class="modal-content border-none">
				<div class="modal-body p-0">
					<div class="row y-middle">
						<div class="col-lg-6 col-md-6">
							<div class="checking-popup">
								<img src="{{@$settings->alerts_photo_cover}}" alt="Fitnessity">
							</div>																											
						</div>
						<div class="col-lg-6 col-md-6">
							<div class="text-center">
								<div class="tick-set">
									<img src="{{url('/dashboard-design/images/cross.png')}}" alt="Fitnessity">
								</div>
								<label class="fs-24"> Sorry, I can't check you in yet. </label>
								<label class="fs-24"> Your Credit Card expired. Please update your card.</label>
							</div>
							
						</div>
						<div class="p-relative">
							<div class="finish-btn">
								<a href="#" data-reload="1" data-modal-chkBackdrop="1" data-modal-width="" data-behavior="ajax_html_modal" data-url="{{route('checkin.card_list', ['customer_id' => $customer->id,'return_url' => url()->full()])}}" class="btn btn-red" onclick="closeModal()">Update Card</a>
							</div>
						</div>
					</div>
				</div>
			</div>
	  	</div>
	</div>

	<div class="modal fade sign" tabindex="-1" aria-labelledby="mySmallModalLabel" aria-modal="true" role="dialog">
		<div class="modal-dialog modal-dialog-centered width-345">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="myModalLabel">Sign Below</h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<div class="modal-body">
					<div class="row">
						<div class="col-lg-12">
							<canvas id="signatureCanvas"></canvas>
						</div>						
					</div>
				</div>
				<div class="modal-footer">
					<button type="submit" id="clearButton" class="btn btn-primary btn-black">Clear</button>
					<button type="submit" class="btn btn-primary btn-red" id="saveSignature" data-did = "" data-type="">Submit</button>
				</div>
			</div><!-- /.modal-content -->
		</div><!-- /.modal-dialog -->
	</div>	

	<div class="modal fade modalDocument" tabindex="-1" aria-labelledby="mySmallModalLabel">
		<div class="modal-dialog modal-dialog-centered modal-50" id="doc-width">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="myModalLabel">Requested Documents</h5>
						<button type="button" class="btn-close"  aria-label="Close"  onclick="window.location.reload()"></button>
				</div>
				<div class="modal-body" id="modalDocumentHtml">

				</div>
			</div>
		</div>
	</div>

	<div class="modal fade modalTerms" tabindex="-1" aria-labelledby="mySmallModalLabel">
		<div class="modal-dialog modal-dialog-centered modal-70" id="doc-width">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="myModalLabel">Terms</h5>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<div class="modal-body" >
					<div class="col-md-12 text-justify mb-10 fs-14" id="termsHtml"></div>
				</div>
			</div>
		</div>
	</div>

	<div class="modal fade notes" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true" data-bs-focus="false">
		<div class="modal-dialog modal-dialog-centered modal-30">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				
				<div class="modal-body" id="noteHtml">		
					<h5 class="modal-title text-center notes-title" id="staticBackdropLabel"></h5>
					<div class="row y-middle mt-10">
						<div class="col-lg-12 col-sm-12 col-md-12">
							<div class="mb-3 ck-content notes-content"></div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="modal fade announcementModal" tabindex="-1" id="detail-modal" aria-labelledby="staticBackdropLabel" aria-modal="true" role="dialog" >
		<div class="modal-dialog modal-dialog-centered modal-50">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<div class="modal-body html-content">
					<h5 class="modal-title text-center annTitle" id="staticBackdropLabel"></h5>
					<div class="row y-middle mt-10">
						<div class="col-lg-12 col-sm-12 col-md-12">
							<div class="mb-3 ck-content annContent"></div>
						</div>
						<div class="col-lg-12 col-sm-12 col-md-12 text-center">
							<div class="mb-3"> Announcement Posted On <p class="p-date"></p></div>
						</div>
					</div>
				</div>
			</div>
		</div>
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


	<!--<div class="modal fade" id="detailsmdoal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
	 	<div class="modal-dialog modal-dialog-centered">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<div class="modal-body">
					<div class="row">
						<div class="col-md-12 col-sm-12 col-xs-12">
							<label class="mb-10">Step: 1 </label> <span>Select Date</span>
							<div class="activityselect3 special-date mb-15">
								<input type="text" class="form-control flatpickr" data-provider="flatpickr"  data-date-format="d M, Y" data-deafult-date="24 Nov, 2021" placeholder="Select date" />
							</div>
						</div>
						<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
							<div class="mb-15">
								<label class="mb-10">Step: 2 </label> <span>Select Category</span>
								<select name="activity_type" data-behavior="on_change_submit" class="form-select" id="choices-publish-status-input" data-choices="" data-choices-search-false="">
									<option value="">Summer Camp Full Day (8:30 am to 3:00 pm)</option>
								</select>
							</div>
						</div>
						<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
							<div class="mb-15">
								<label class="mb-10">Step: 3 </label> <span>Select Price Optiony</span>
								<select name="activity_type" data-behavior="on_change_submit" class="form-select" id="choices-publish-status-input" data-choices="" data-choices-search-false="">
									<option value="">Basic Flight Package</option>
									<option value="">Silver Flight Package</option>
									<option value="">Gold Package</option>
								</select>
							</div>
						</div>
						<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
							<div class="mb-15">
								<label class="mb-10">Step: 4 </label> <span> Select Time</span>
								<div class="row" id="timeschedule">
									<div class="col-lf-4 col-md-4 col-sm-6 col-xs-12">
										<div class="donate-now">
											<input type="radio" id="1145" name="amount" value="09:00" onclick="addhiddentime(1145,146,0);" checked="">
											<label for="1145">09:00 am</label>
											<p class="end-hr text-center">200/200 Spots Left.</p>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
							<div class="mb-15">
							<label class="mb-10">Step: 5 </label> <span> Select Participant</span>
								<div class="accordion" id="default-accordion-example">
									<div class="accordion-item shadow">
										<h2 class="accordion-header" id="headingOne">
											<button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
												Participant
											</button>
										</h2>
										<div id="collapseOne" class="accordion-collapse collapse" aria-labelledby="headingOne" data-bs-parent="#default-accordion-example">
											<div class="accordion-body">
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
						<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
							<div class="mb-15">
								<label class="mb-10">Step: 6 </label> <span> Select Add-On Service (Optional) </span>
								<div class="accordion" id="default-accordion-example">
	                                <div class="accordion-item shadow">
	                                    <h2 class="accordion-header" id="headingTwo">
	                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
												Add-On Services
	                                       	</button>
	                                   	</h2>
	                                    <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#default-accordion-example">
	                                        <div class="accordion-body">
												<div class="add-onservice btn-group">
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
						<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
							<div class="">
								<a href="#" data-bs-toggle="modal" data-bs-target="#booking-summery" >Booking Summary </a>
							</div>
						</div>
						<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
							<div class="book0total-price">	
								<label>Total Price: </label>
								<span>$54 USD</span>
							</div>
						</div>
						<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
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
	</div> -->

	<div class="modal fade" id="scheduleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
	  	<div class="modal-dialog modal-lg" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title"></h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<div class="modal-body"  id="schedulebody"></div>
			</div>
	  	</div>
	</div>

	<div class="modal fade exitModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title"></h5>
					<button type="button" class="btn-close" onclick="window.location.reload()"></button>
				</div>
				<div class="modal-body">
					<div class="text-center mb-20">
				        <h2 class="font-red">Exit Check-In Mode</h2>
						<p>To deactivate check-in mode, please enter your staff passcode</p>
				    </div>
				    <div class="d-flex justify-content-center mb-20">
					    <input type="text" class="form-control w-50 numberfield" id="numberInput" placeholder="Enter 4 digit code.." onkeypress="return event.charCode >= 48 && event.charCode <= 57" disabled>
					</div>
				    <div class="container">
					    <div id="pincode_check">
						    <div class="table">
							    <div class="">
								    <div id="numbers_check" class="numbers_check">
									    <div class="grid">
											<div class="grid__col grid__col--1-of-3"><button>1</button></div>
											<div class="grid__col grid__col--1-of-3"><button>2</button></div>
											<div class="grid__col grid__col--1-of-3"><button>3</button></div>

											<div class="grid__col grid__col--1-of-3"><button>4</button></div>
											<div class="grid__col grid__col--1-of-3"><button>5</button></div>
											<div class="grid__col grid__col--1-of-3"><button>6</button></div>

											<div class="grid__col grid__col--1-of-3"><button>7</button></div>
											<div class="grid__col grid__col--1-of-3"><button>8</button></div>
											<div class="grid__col grid__col--1-of-3"><button>9</button></div>

											<div class="grid__col grid__col--1-of-3"></div>
											<div class="grid__col grid__col--1-of-3"><button>0</button></div>
											<div class="grid__col grid__col--1-of-3"><button class="fs-20"><i class="fas fa-backspace"></i></button></div>
								        </div>
							        </div>
							    </div>
						    </div>
					    </div>
				    </div>	

                	<div class="text-center text-danger fs-16" id="error-message-code"></div>	
				</div>
				<div class="modal-footer">
					<label class="mb-15">
						{{-- <a type="button" class="btn btn-red" data-bs-toggle="modal" data-bs-target="#exampleModal">Exit</a> --}}
					    <button type="button" class="btn btn-red" id="checkExit">Exit</button>
					</label>
	            </div>
			</div>
	  	</div>
	</div>
<!-- Modal -->

	<div class="modal fade membership-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog modal-lg" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title"></h5>
					<button type="button" class="btn-close" onclick="window.location.reload()"></button>
				</div>
				<div class="modal-body membership-modal-content"></div>
			</div>
	  	</div>
	</div>

	
	<div class="row mt-25">
		<div id="covidDiv" class="d-none">{!!@$terms->covidtext!!}</div>

		<div id="liabilityDiv"  class="d-none">{!!@$terms->liabilitytext!!}</div>

		<div id="contractDiv"  class="d-none">{!!@$terms->contracttermstext!!}</div>

		<div id="refundDiv"  class="d-none">{!!@$terms->refundpolicytext!!}</div>

		<div id="termsDiv"  class="d-none">{!!@$terms->termcondfaqtext!!}</div>
	</div>

	{{-- my code starts --}}
	<!-- Another Modal (Example) -->
	<div class="modal fade" id="anotherModal" tabindex="-1" aria-labelledby="anotherModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="anotherModalLabel">Staff Modal</h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<div class="modal-body">
					<div class="text-center mb-20">
						<h2 class="font-red">Check-In</h2>
					</div>
					<div class="d-flex justify-content-center mb-20">
						<input type="text" class="form-control w-50 numberfield" id="numberInput_staff" placeholder="Enter check-in code.." onkeypress="return event.charCode >= 48 && event.charCode <= 57" disabled>
					</div>
					<div class="container">
						<div id="pincode_check">
							<div class="table">
								<div class="">
									<div class="numbers_check" id="numbers_check">
										<div class="grid">
											<div class="grid__col grid__col--1-of-3"><button>1</button></div>
											<div class="grid__col grid__col--1-of-3"><button>2</button></div>
											<div class="grid__col grid__col--1-of-3"><button>3</button></div>
	
											<div class="grid__col grid__col--1-of-3"><button>4</button></div>
											<div class="grid__col grid__col--1-of-3"><button>5</button></div>
											<div class="grid__col grid__col--1-of-3"><button>6</button></div>
	
											<div class="grid__col grid__col--1-of-3"><button>7</button></div>
											<div class="grid__col grid__col--1-of-3"><button>8</button></div>
											<div class="grid__col grid__col--1-of-3"><button>9</button></div>
	
											<div class="grid__col grid__col--1-of-3"></div>
											<div class="grid__col grid__col--1-of-3"><button>0</button></div>
											<div class="grid__col grid__col--1-of-3"><button class="fs-20"><i class="fas fa-backspace"></i></button></div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>	
	
					<div class="text-center text-danger" id="error-message"></div>				
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-red" id="checkInButton">Check In</button>
				</div>
			</div>
		</div>
	</div>

	{{-- ends --}}
</div><!-- END layout-wrapper -->

{{-- my code starts --}}
<!-- Confirmation Modal -->
<div class="modal fade" id="confirmModal" tabindex="-1" aria-labelledby="confirmModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-none">
            <div class="modal-header">
                <h5 class="modal-title" id="confirmModalLabel">Confirmation</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-center">
				Are you sure you are finished?
            </div>
            <div class="modal-footer">
				<div class="container">
					<div class="row">
						<div class="col-lg-12">
							<div class="text-center">
								<button type="button" class="btn btn-red" data-bs-dismiss="modal">Stay</button>
								<button type="button" class="btn btn-red" id="confirmYesButton">Finish</button>
							</div>
						</div>
					</div>
				</div>
            </div>
        </div>
    </div>
</div>
{{-- ends --}}
@include('layouts.business.footer')
<audio id="success-sound" src="{{ asset('music/success.mp3') }}" preload="auto"></audio>
<audio id="failure-sound" src="{{ asset('music/failure.mp3') }}" preload="auto"></audio>

@php
    $company_data = Auth::user()->current_company;
    $playSoundValues = [];
    
    if (!empty($company_data)) {
        $data = App\BusinessCheckinSettings::where('business_id', $company_data->id)->first();
        if ($data) {
            $playSoundValues = explode(',', $data->play_sound);
        }
    }
@endphp

<script>
    document.getElementById('confirmYesButton').onclick = function() {
		if (localStorage.getItem('staffCodeVerified')) {
			localStorage.removeItem('staffCodeVerified');
		}
        window.location.href = "{{ route('clear-session-and-welcome') }}";
    };
</script>

<script>
	function openOtherModal() {
		$('#exampleModal').modal('hide');
		$('#anotherModal').modal('show');
	}
</script>
<script>
    var playSoundValues = @json($playSoundValues);
</script>
<script>
    jQuery(document).ready(function ($) {
        var pin = +!![] + [] + (!+[] + !![] + []) + (!+[] + !![] + !![] + []) + (!+[] + !![] + !![] + !![] + []);
        
        $("#numbers_check button").click(function () {
            var enterCode = $("#numberInput_staff").val();
            enterCode.toString();
            var clickedNumber = $(this).text().toString();
           
            if(clickedNumber != ''){
                enterCode = enterCode + clickedNumber;
                // Update the input field
                $("#numberInput_staff").val(enterCode);

                var lengthCode = parseInt(enterCode.length);
                lengthCode--;
                $("#fields .numberfield:eq(" + lengthCode + ")").addClass("active");
       
                if (lengthCode > 3) {
                    $("#numberInput_staff").val(clickedNumber);
                }
            }else{
                var originalString = $('#numberInput_staff').val();
                $('#numberInput_staff').val(originalString.slice(0, -1));
            }
        });
    });
 </script>
<script>
    jQuery(document).ready(function ($) {
        var pin = +!![] + [] + (!+[] + !![] + []) + (!+[] + !![] + !![] + []) + (!+[] + !![] + !![] + !![] + []);
        
        $("#numbers_check button").click(function () {
            var enterCode = $("#numberInput").val();
            enterCode.toString();
            var clickedNumber = $(this).text().toString();
           
            if(clickedNumber != ''){
                enterCode = enterCode + clickedNumber;
                // Update the input field
                $("#numberInput").val(enterCode);

                var lengthCode = parseInt(enterCode.length);
                lengthCode--;
                $("#fields .numberfield:eq(" + lengthCode + ")").addClass("active");
       
                if (lengthCode > 3) {
                    $("#numberInput").val(clickedNumber);
                }
            }else{
                var originalString = $('#numberInput').val();
                $('#numberInput').val(originalString.slice(0, -1));
            }
        });
    });
 </script>


<script type="text/javascript">
    $(document).ready(function() {
        $('#checkInExit').click(function(e) {
            e.preventDefault();
            $('#error-message-code').removeClass('text-success text-danger').html('');
            var checkInCode = $('#numberexitInput').val();
            if (checkInCode === '') {
                $('#error-message-code').addClass('text-danger').text('Please enter a 4 digit code.');
                return;
            }

            $.ajax({
                url: "{{route('checkin.chk-chckin-code_exit')}}", 
                type: 'POST',
                data: {
                    code: checkInCode,
                    _token: '{{ csrf_token() }}'  
                },
                success: function(response) {
                    if (response.success) {
                    	$('#error-message-code').addClass('text-success').text(response.message || 'An error occurred. Please try again.');
                     
                    
                        window.location.href = response.url
                    } else {
                    	$('#numberexitInput').val('');
                        $('#error-message-code').addClass('text-danger').text(response.message || 'An error occurred. Please try again.');
                       
                    }
                },
                error: function(xhr, status, error) {
                	$('#numberexitInput').val('');
                    $('#error-message-code').addClass('text-danger').text('An error occurred. Please try again.');
                   
                }
            });
        });
    });

</script>


<script>
		 flatpickr(".flatpickr", {
	        dateFormat: "m/d/Y",
	        maxDate: "01/01/2050",
			defaultDate: [new Date()],
	     });
			 
</script>
<script>

	$(document).ready(function (e){
		// $('.cardExpiredModal').modal('show');
		if (localStorage.getItem('staffCodeVerified') !== 'true') {
			@if(count($missedPayments) > 0 && $customer->isCardExpired() == 0)
				$('.autoPayFailedModal').modal('show');
			@endif

			@if($customer->isCardExpired() == 1)
				$('.cardExpiredModal').modal('show');
			@endif
		}
	});

	function closeModal() {
	    $('.payment-view').modal('hide');
	    $('.autoPayFailedModal').modal('hide');
	    $('.cardExpiredModal').modal('hide');
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
          		customerID: '{{$customer->id}}',
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

	function checkin(id) {
        $('#error-message').removeClass('text-danger').html('');
		$.ajax({
            url: "{{route('quick-check-in')}}", 
            type: 'POST',
            data: {
                checkinId: id,
                _token: '{{ csrf_token() }}'  
            },
            success: function(response) {

                if (response.success) {
					if (playSoundValues.includes('success') && !playSoundValues.includes('none')) 
					{
                        var successSound = document.getElementById('success-sound');
                        successSound.play();
                     }
                	$('.checkinModal').modal('show');
                    $('.checkinContent').html(response.message);
					$('#' + id).text('Checked In').prop('onclick', null).off('click');
                } else {
					if (playSoundValues.includes('fail') && !playSoundValues.includes('none')) {
                            var failuresound = document.getElementById('failure-sound');
                            failuresound.play();
                        }
                    $('#error-message').addClass('text-danger').html(response.message || 'An error occurred. Please try again.');
                }
            },
            error: function(xhr, status, error) {
				if (playSoundValues.includes('fail') && !playSoundValues.includes('none')) {
                            var failuresound = document.getElementById('failure-sound');
                            failuresound.play();
				}
                $('#error-message').addClass('text-danger').html('An error occurred. Please try again.');
            }
        });
	}	
</script>


 @if(@$settings->customer_return_back_time)
	{{-- <script type="text/javascript">
		$(document).ready(function() {
			var time = '{{$settings->customer_return_back_time}}';
		    var idleTime = 0;
		    var idleLimit = time * 1000; // 1000 milliseconds = 1 sec

		    var idleInterval = setInterval(timerIncrement, 1000); // 1 minute

		    $(this).mousemove(resetTimer);
		    $(this).keypress(resetTimer);

		    function timerIncrement() {
		        idleTime += 1000; // Increment idle time by 1 minute
		        if (idleTime >= idleLimit) {
		            callYourFunction();
		            idleTime = 0; 
		        }
		    }

		    function resetTimer() {
		        idleTime = 0; 
		    }

		    function callYourFunction() {
				if (localStorage.getItem('staffCodeVerified')) {
					localStorage.removeItem('staffCodeVerified');
				}
		      	// window.location.href = '/checkin/check-out?type=0';
				  window.location.href = '/check-in-welcome';
			}
		});

	</script> --}}
@endif 


<script>

	function opennotesalerts() {
		if (window.innerWidth > 768) {
	        document.getElementById("Notes_Alerts").style.width = "600px";
	    } else {
	        document.getElementById("Notes_Alerts").style.width = "95%"; 
	    }
	}

	function closenotesalerts() {
		document.getElementById("Notes_Alerts").style.width = "0";
	}

	function opendoc() {
		if (window.innerWidth > 768) {
	        document.getElementById("documents_Terms").style.width = "650px";
	    } else {
	        document.getElementById("documents_Terms").style.width = "95%"; 
	    }
	}

	function closedoc() {
		document.getElementById("documents_Terms").style.width = "0";
	}

	function openannouncements() {
		if (window.innerWidth > 768) {
	        document.getElementById("Announcements_News").style.width = "600px";
	    } else {
	        document.getElementById("Announcements_News").style.width = "95%"; 
	    }
	}

	function closeannouncements() {
		document.getElementById("Announcements_News").style.width = "0";
	}

	function changeType(type){
		var selectedValue = type.value;
		if(selectedValue == 'all'){
			selectedValue = '';
		}
		var currentUrl = window.location.href;
		var url = new URL(currentUrl);
		url.searchParams.set('serviceType', selectedValue);
		window.location.href = url.toString();
	}

	function changeTab(type,from){
		$('#serchType').val(type);
		if(from == 'mobile'){
			$('.nav-link').removeClass('active');
			$('[data-bs-toggle="tab"][href="#nav-' + type + '"]').addClass('active');
	        $('.tab-pane').removeClass('active');
         	$('#nav-' + type).addClass('active');
		}
	}
	
	function serchByActivty(){
        var text = $('#activityName').val();
        var type = $('#serchType').val();
        
    	$.ajax({
            type: "post",
            url:'{{route("personal.orders.searchActivity")}}',
            data:{
            	"_token":"{{csrf_token()}}" ,
            	"text":text ,
            	"type":type,
            	"businessId" :"{{$businessId}}" ,
            	'serviceType':'{{request()->serviceType}}',
            	'customerId':'{{request()->customer_id}}'
            },
            success: function(data){
                $(".tabdata"+type).html(data);
            }
        });
    }

    function openNoteModal(id){
    	$('.notes').modal('show');
    	$('.notes-title').html($('#noteTitle'+id).val());
		$('.notes-content').html($('#noteContent'+id).val());
    }

    function openAnnoucement(id){
    	$.ajax({
			url:'/checkin/annoucement-modal/'+id,
			type: 'GET',
			success:function(data){
				$('.html-content').html(data);
				$('.announcementModal').modal('show');
			}
		});
    }
</script>

<script>
	flatpickr(".flatpickr-range", {
	    dateFormat: "m/d/Y",
	    maxDate: "01/01/2050",
		defaultDate: [new Date()],
	});
</script>
	
<script>

	$( '.activity-schedule-tabs .nav-tabs a' ).on('click',function () {
		$( '.activity-schedule-tabs .nav-tabs' ).find( 'li.active' ).removeClass( 'active' );
		$( this ).parent( 'li' ).addClass( 'active' );
	});
	

	function getRemainingSession(){
		var did = $('#priceId').find('option:selected').data('did');
		if(did != ''){
			$.ajax({
				url:'/chksession/'+did,
				type: 'GET',
				success:function(data){
					$('#remainingSession').html(data+' Session Remaining.')
				}
			});
		}
	}

	function openPopUp(scheduleId,sid,activityName,time,chk,catId){
		if(chk == 1){
 			$('#select-booking-type-checkin').html('<div class="row contentPop"> <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12  text-center"> <div class="modal-inner-txt scheduler-time-txt"><p>You can\'t book this activity for today. The time has passed. Please choose another time.</p></div> </div></div>');
		}else{
			//$('#select-booking-type-checkin').html('<div class="row contentPop text-center"><div class="col-lg-12 btns-modal"><h4 class="mb-20">Choose How You Would Like To Book</h4><button type="button" class="btn btn-red mb-10" onclick="timeBookingPopUP('+scheduleId+','+sid+',\''+activityName+'\',\''+time+'\','+chk+','+catId+')" id="singletime" data-id="">Book 1 Time Slot</button>  <button type="button" class="btn btn-red mb-10" onclick="goToMultibookingPage('+sid+');">Book Multiple Time Slots At Once</button></div></div>');
			$('#select-booking-type-checkin').html('<div class="row contentPop text-center"><div class="col-lg-12 btns-modal"><h4 class="mb-20">Choose How You Would Like To Book</h4><button type="button" class="btn btn-red mb-10" onclick="timeBookingPopUP('+scheduleId+','+sid+',\''+activityName+'\',\''+time+'\','+chk+','+catId+')" id="singletime" data-id="">Book 1 Time Slot</button></div></div>');
		}
		
		$('#selectbooking').modal('show');
		
	}

	function goToMultibookingPage(sid) {
		let date = '{{$filter_date->format("Y-m-d")}}';
		//window.open('/schedule/multibooking/'+'{{$businessId}}'+'?business_service_id='+sid+'&priceid='+'{{$priceid}}'+'&customer_id='+'{{@$customer->id}}' , '_blank');
		window.open('/schedule/multibooking/'+'{{$businessId}}'+'?customer_id='+'{{@$customer->id}}'+'&date='+date, '_blank');
	}

	function timeBookingPopUP(scheduleId,sid,activityName,time,chk,catId) {
		var date = '{{$filter_date->format("m/d/Y")}}';
		$('#selectbooking').modal('hide');
		var membershipHtml = '';
		$.ajax({
			url:'{{route("chkOrderAvailable")}}',
			type: 'POST',
			data:{
				_token: '{{csrf_token()}}',
				sid : sid,
				cid : '{{@$customer->id}}',
				// priceId : '{{$priceid}}',
				catId : catId,
				businessId : '{{$businessId}}',
			},
			success:function(data){
				if(data == ''){
					// html = '<div class="row contentPop"> <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12  text-center"> <div class="modal-inner-txt scheduler-time-txt"><p>You don\'t have a membership for this activity.  </p> <p> Please buy a membership in order to book. </p></div> <a href="/activity-details/'+sid+'" class="btn btn-red">Buy Membership Now </a> </div> </div> ';
					html = '<div class="row contentPop"> <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12  text-center"> <div class="modal-inner-txt scheduler-time-txt"><p>You don\'t have a membership for this activity.  </p> <p> Please buy a membership in order to book. </p></div><a class="btn btn-red" data-modal-chkBackdrop="1" data-reload="1" data-modal-width="modal-50" data-behavior="ajax_html_modal" data-url="{{route('checkin.activity_booking_html')}}" class="btn btn-red"> Buy Membership Now </a> </div> </div> ';
				}else{
					html = '<div class="row contentPop"> <div class="col-md-12"> <h4 class="mb-10 lh-25 text-center"> You are booking 1 time slot for '+activityName+' </h4> </div> <div class="col-md-12"> <h4 class="mb-30 lh-25 text-center"> on '+date+' at '+time+' </h4> </div> <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 text-center mb-0"> <div class="modal-inner-txt"> <lable> Select Your Membership To Pay For This </lable> </div> </div> <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 btns-modal mb-20"  id="bookingDetails" >'+data+'</div> <div class="col-lg-12 text-center"> <div class="modal-inner-txt"><p>Are You Sure To Book This Date And Time?</p></div> </div> <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12  text-center"><a onclick="addtimedate('+scheduleId+' ,'+sid+',\''+activityName+'\',\''+time+'\')" class="btn btn-red">Yes</a> <a data-dismiss="modal" class="btn btn-black">No</a> </div> </div>';
				}
				$('.ajax_html_modal').modal('show');
 				$('#booking-time-model').html(html);
			}
		});
	}

	function addtimedate(scheduleId,sid,activityName,time){
	
		var priceId = $('#priceId').val();
		var selectedOption = $('#priceId').find("option:selected");
		var oid = selectedOption.attr("data-did");
		let date ='{{$filter_date->format("m-d-Y")}}';
	   	$.ajax({
	   		url: "{{route('personal.schedulers.store')}}",
			type: 'POST',
			xhrFields: {
				withCredentials: true
	    	},
	    	data:{
				_token: '{{csrf_token()}}',
				date:'{{$filter_date->format("Y-m-d")}}',
				timeid:scheduleId,
				businessId:'{{$businessId}}',
				serviceID:sid,
				customerID:'{{@$customer->id}}',
				priceId:priceId,
				oid:oid,
			},
			success: function (response) { //alert(response);
				if(response == 'success'){
					$('.pay-confirm').addClass('font-green');
					//$('.pay-confirm').html('<div class="row"><div class="col-md-12"> <h4 class="mb-10 lh-25 text-center"> Booking Confirmed</h4> </div><div class="col-md-12 text-center"><p class="pay-confirm fs-17 font-green">Your reservation for  '+activityName+' '+date+' at '+time +'</p></div></div>');
					$('.pay-confirm').html(`<div class="row"><div class="col-md-12"><h4 class="mb-10 lh-25 text-center">Booking Confirmed</h4></div><div class="col-md-12 text-center">
								<p class="pay-confirm fs-17 font-green">Your reservation for ${activityName} ${date} at ${time}</p>
							</div>
							<div class="col-md-12 text-center">
								<button class="btn btn-primary close-button">Close</button>
							</div>
						</div>
					`);
					$('.close-button').on('click', function() {
						window.location.href = '/check-in-portal';
					});
					$('#success-reservation').modal('show');
					$('.ajax_html_modal').modal('hide');
 					$(".activity-tabs").load(location.href+" .activity-tabs>*","");
				}else if(response == 'fail'){
					$('#booking-time-model').html('<div class="row contentPop"> <div class="col-lg-12 text-center"> <div class="modal-inner-txt scheduler-time-txt"><p>No membership/sessions available to pay for this activity.</p></div> </div> <div class="col-lg-12 btns-modal"><a href="/activity-details/'+sid+'"  class="addbusiness-btn-modal">Buy Membership Now</a></div> </div>');
					//window.location = '/activity-details/'+sid;
					//alert('schedule failed');
				}else{
					$('#booking-time-model').html('<div class="row contentPop"> <div class="col-lg-12 text-center"> <div class="modal-inner-txt scheduler-time-txt"><p>'+response+'</p></div> </div></div>');
				}

				//swindow.location.reload();
			}
	   	});
	}

	function ReScheduleOrder(checkinId){
		let text = "Are You Sure To ReSchedule This Booking?";
		if (confirm(text) == true) {
		   	$.ajax({
		   		url: "/personal/schedulers/" + checkinId,
				method: "DELETE",
		    	data:{
					_token: '{{csrf_token()}}',
				},
				success: function (response) { /*alert(response);*/
 					location.reload();
				}
		   	});
		}
	}
</script>

<script>
	$('.owl-carousel').owlCarousel({
	    loop:true,
	    margin:10,
	    nav:true,
		navText: ['<i class="fas fa-chevron-left"></i>', '<i class="fas fa-chevron-right"></i>'],
	    responsive:{
	        0:{
	            items:3
	        },
	        600:{
	            items:3
	        },
	        1000:{
	            items:5
	        }
	    }
		
	});
</script>

<script>
	$(function() {
		$( ".date" ).datepicker({
		 	dateFormat : 'yy-mm-dd',
		 	showOn: "both",
		 	buttonImage: "/public/img/calendar-icon.png",
		 	buttonImageOnly: true,
		 	buttonText: "Select date",
		 	changeMonth: true,
		 	changeYear: true,
		 	minDate: 'today',
		 	yearRange: "0:+20"
		}); 
	});

	$( ".datepicker" ).change(function(){
		var date  = $(this).val();
		var currentUrl = window.location.href;
		var url = new URL(currentUrl);
		var params = new URLSearchParams(url.search);
		if (params.has('date')) {
            params.set('date', date);
        } else {
            params.append('date', date);
        }

        if (params.has('activetab')) {
            params.set('activetab', 'schedule');
        } else {
            params.append('activetab', 'schedule');
        }

        url.search = params.toString();
        var updatedUrl = url.toString();
		window.location = updatedUrl;
    });
</script>

<!-- document -->
<script type="text/javascript">
	$(document).ready(function() {
		$('.sign').modal({
        backdrop: 'static',
        keyboard: false
    	});
   });

	function openDocumentModal(id,type){
		$.ajax({
         type: 'GET',
         url: '/personal/getContent/'+id+'/'+type,
         success: function (response) {
         	
         		$('#doc-width').addClass('modal-50');
         	
            $('#modalDocumentHtml').html(response);
				$('.modalDocument').modal('show');
         }
      });
	}

	function deleteDoc(id,cid){
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

	function downloadPdf(cid,name){
		var downloadUrl = '{{ route("personal.export") }}' +'?cid=' + cid +'&type=' + name;
		filename = name+'.pdf';
		var link = document.createElement('a');
		link.href = downloadUrl;
		link.download = filename;
		document.body.appendChild(link);
		link.click();
		document.body.removeChild(link);
	}

	function viewPdf(name){
		var data = $('#'+name).html(); 
		if (!data) {
			data = 'No Terms Available';
		}
		$('#termsHtml').html(data);
		$('.modalTerms').modal('show');
	}
</script>

<script>

    const canvas = document.getElementById('signatureCanvas');
    const ctx = canvas.getContext('2d');
    var drawing = false;

    function startDrawing(e) {
        e.preventDefault();
        var pos = getMouseOrTouchPos(canvas, e);
        ctx.beginPath();
        ctx.moveTo(pos.x, pos.y);
        drawing = true;
    }

    function draw(e) {
        e.preventDefault();
        if (!drawing) return;

        var pos = getMouseOrTouchPos(canvas, e);
        ctx.lineTo(pos.x, pos.y);
        ctx.stroke();
    }

    function stopDrawing(e) {
        e.preventDefault();
        drawing = false;
    }

    function getMouseOrTouchPos(canvas, e) {
        var rect = canvas.getBoundingClientRect();
        var clientX, clientY;

        if (e.touches && e.touches.length > 0) {
            clientX = e.touches[0].clientX;
            clientY = e.touches[0].clientY;
        } else {
            clientX = e.clientX;
            clientY = e.clientY;
        }

        return {
            x: clientX - rect.left,
            y: clientY - rect.top
        };
    }

    // Add unified event listeners
    canvas.addEventListener('mousedown', startDrawing);
    canvas.addEventListener('mousemove', draw);
    canvas.addEventListener('mouseup', stopDrawing);
    canvas.addEventListener('mouseout', stopDrawing);

    canvas.addEventListener('touchstart', startDrawing);
    canvas.addEventListener('touchmove', draw);
    canvas.addEventListener('touchend', stopDrawing);
    canvas.addEventListener('touchcancel', stopDrawing);

	const clearButton = document.getElementById('clearButton');
	clearButton.addEventListener('click', clearCanvas);

	function clearCanvas() {
  		ctx.clearRect(0, 0, canvas.width, canvas.height);
	}

	$('#saveSignature').click(function() {
	// Convert the canvas to an image (data URL)
    	var signatureDataUrl = canvas.toDataURL();

    	// Submit the signature using AJAX
	 	$.ajax({
        type: 'POST',
        url: "{{ route('personal.save.signature') }}",
        data: {
            _token: "{{ csrf_token() }}",
            signature: signatureDataUrl,
            id: $('#saveSignature').attr('data-did'),
            type: $('#saveSignature').attr('data-type'),
            cus_id: '{{@$customer->id}}',
        },
        success: function(response) {
            alert('Signature saved successfully.');
            window.location.reload();
        },
        error: function(error) {
            alert('Error saving signature.');
        }
		});
	});

	function  loadImage(imageData) {
    var proxyUrl = 'personal/image-proxy?url=' + encodeURIComponent(imageData);
    var img = new Image();
    img.crossOrigin = 'anonymous'; // Enable CORS for the image
    img.onload = function() {
        ctx.drawImage(img, 0, 0, canvas.width, canvas.height);
    };
    img.src = proxyUrl;
	}



		function openTermsModal(id,path,type){
 		ctx.clearRect(0, 0, canvas.width, canvas.height);
    	$('#saveSignature').attr('data-did',id);
    	$('#saveSignature').attr('data-type',type);
    	loadImage(path);
    	$('.sign').modal('show');
   }

   function openModal(id,path){
 		ctx.clearRect(0, 0, canvas.width, canvas.height);
    	$('#saveSignature').attr('data-did',id);
    	loadImage(path);
    	$('.sign').modal('show');
   }
</script>
<!-- end document -->

<script>
    $(document).ready(function() {
        $('#checkInButton').on('click', function() {
            var code = $('#numberInput_staff').val();
            $.ajax({
                url: "{{ route('checkin.check') }}",
                method: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    code: code
                },
                success: function(response) {
                    if (response.status === 'success') {
						localStorage.setItem('staffCodeVerified', 'true');
                        $('#anotherModal').modal('hide');
						$('#exampleModalstaff').modal('hide');
                        $('#exampleModalstaff').removeAttr('data-bs-backdrop');
						$('#exampleModalstaff').removeClass('autoPayFailedModal');

                    } else {
                        $('#error-message').text(response.message);
                    }
                },
                error: function() {
                    $('#error-message').text('An error occurred. Please try again.');
                }
            });
        });
		  // Check session storage on page load
		  if (localStorage.getItem('staffCodeVerified') === 'true') {
				hideModal();
			}
			function hideModal() {
				closeModal();	
			}

    });
</script>
<script>
	function clearLocalStorage() {
		if (localStorage.getItem('staffCodeVerified')) {
			localStorage.removeItem('staffCodeVerified');
		}
	}
	
	// Existing document ready function
	$(document).ready(function (e) {
		// Your existing code here...
		// Add event listeners for Finish and Exit buttons
		$('a[href="{{ route('clear-session-and-welcome') }}"]').on('click', clearLocalStorage);
		$('a[data-bs-target=".exitModal"]').on('click', clearLocalStorage);
	});
	</script>
<script>
    document.getElementById('yesButton').onclick = function() {
        var modal = document.getElementById('exampleModal');
        var bootstrapModal = bootstrap.Modal.getInstance(modal);
        bootstrapModal.hide();
    };
</script>


{{-- exit code starts--}}
<script type="text/javascript">
    
    $(document).ready(function() {
        $('#checkExit').click(function(e) {
            e.preventDefault();
            $('#error-message-code').removeClass('text-success text-danger').html('');
            var checkInCode = $('#numberInput').val();
            if (checkInCode === '') {
                $('#error-message-code').addClass('text-danger').text('Please enter a 4 digit code.');
                return;
            }

            $.ajax({
                url: "{{route('checkin.chk-chckin-code')}}", 
                type: 'POST',
                data: {
                    code: checkInCode,
                    _token: '{{ csrf_token() }}'  
                },
                success: function(response) {
                    if (response.success) {
                    	$('#error-message-code').addClass('text-success').text(response.message || 'An error occurred. Please try again.');
                        window.location.href = response.url
                    } else {
                    	$('#numberInput').val('');
                        $('#error-message-code').addClass('text-danger').text(response.message || 'An error occurred. Please try again.');
                    }
                },
                error: function(xhr, status, error) {
                	$('#numberInput').val('');
                    $('#error-message-code').addClass('text-danger').text('An error occurred. Please try again.');
                }
            });
        });
    });

</script>
{{-- ends --}}

@endsection


