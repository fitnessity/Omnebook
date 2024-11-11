@foreach ($active_memberships as $i=>$booking_detail)
<div class="accordion nesting4-accordion custom-accordionwithicon accordion-border-box mt-3" id="accordionnestinga{{$i}}">
    <div class="accordion-item shadow">
        <h2 class="accordion-header" id="accordionnesting4Examplea{{$i}}}">
            <button class="accordion-button collapsed mp-6" type="button" data-bs-toggle="collapse" data-bs-target="#accor_nesting4Examplecollapsea{{$i}}" aria-expanded="false" aria-controls="accor_nesting4Examplecollapse2">
                <div class="container-fluid nopadding">
                    <div class="row mini-stats-wid d-flex align-items-center ">
                        <div class="col-lg-10 col-md-10 col-8">{{@$booking_detail->business_services_with_trashed->program_name}} - {{@$booking_detail->business_price_detail_with_trashed->business_price_details_ages_with_trashed->category_title}} @if($booking_detail->contract_date) | Started On {{date('m/d/Y',strtotime(@$booking_detail->contract_date))}} @endif  @if($booking_detail->expired_at) | Expires On {{date('m/d/Y',strtotime(@$booking_detail->expired_at))}} @endif																															
                        </div>
                        
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
                                        <?php 
                                                    if($booking_detail->can_refund()){
                                                        $transaction=App\Transaction::whereIn('user_type', ['customer', 'user'])->where('item_id',$booking_detail->booking_id)->whereIn('user_id',[$customerdata->id,$customerdata->user_id])->first();
                                                        if($transaction && $transaction->can_refund())
                                                            {
                                        ?>
                                        <li>
                                            <a class="edit-booking-customer" data-behavior="ajax_html_modal" data-url="{{route('void_or_refund_modal', ['business_id' => request()->business_id, 'id' => $customerdata->id,'booking_detail_id' => @$booking_detail->id , 'booking_id' => @$booking_detail->booking_id])}}" data-modal-width="modal-50"> <i class="fas fa-plus text-muted">
                                            </i>Refund or Void</a>
                                        </li>
                                        <?php					
                                                }
                                            }
                                        ?>
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
                                    <label>DATE BOOKED:	</label>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6 col-6">
                                <div class="float-end line-break text-right">
                                    <span>{{date('m/d/Y',strtotime(@$booking_detail->created_at))}}</span>
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