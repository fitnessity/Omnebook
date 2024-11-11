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
                                  | <span class="font-red">  Status: Refunded on {{date('m/d/Y',strtotime($booking_detail->refund_date))}} by {{$booking_detail->refunded_person}}</span>
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
                            <div class="col-lg-12">
                                <div class="bg-light-grey completed-member-text">
                                    <div class="row">
                                        <div class="col-lg-6 col-md-6 col-sm-6 col-6">
                                            <div class="line-break comp-rows">
                                                <label>BOOKING # </label>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-6 col-6">
                                            <div class="float-end line-break text-right">
                                                <span> {{@$booking_detail->booking->order_id}} </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class=" completed-member-text">
                                    <div class="row">
                                        <div class="col-lg-6 col-md-6 col-sm-6 col-6">
                                            <div class="line-break comp-rows">
                                                <label>TOTAL PRICE </label>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-6 col-6">
                                            <div class="float-end line-break text-right">
                                                <span>  ${{@$booking_detail->booking->amount}} </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="bg-light-grey completed-member-text">
                                    <div class="row">
                                        <div class="col-lg-6 col-md-6 col-sm-6 col-6">
                                            <div class="line-break comp-rows">
                                                <label>PAYMENT TYPE:</label>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-6 col-6">
                                            <div class="float-end line-break text-right">
                                                <span>{{@$booking_detail->booking->getPaymentDetail()}}</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class=" completed-member-text">
                                    <div class="row">
                                        @if (@$booking_detail->business_price_detail_with_trashed)
                                            <div class="col-lg-6 col-md-6 col-sm-6 col-6">
                                                <div class="line-break comp-rows">
                                                    <label>TOTAL REMAINING:</label>
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-md-6 col-sm-6 col-6">
                                                <div class="float-end line-break text-right">
                                                    <span>{{@$booking_detail->getRemainingSessionAfterAttend()}}/{{@$booking_detail->pay_session}}</span>
                                                </div>
                                            </div>
                                        @endif
                                    </div>
                                </div>

                                <div class="bg-light-grey completed-member-text">
                                    <div class="row">
                                        <div class="col-lg-6 col-md-6 col-sm-6 col-6">
                                            <div class="line-break comp-rows">
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
                                    </div>
                                </div>

                                <div class="completed-member-text">
                                    <div class="row">
                                        <div class="col-lg-6 col-md-6 col-sm-6 col-6">
                                            <div class="line-break comp-rows">
                                                <label>CATEGORY NAME:</label>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-6 col-6">
                                            <div class="float-end line-break text-right">
                                                <span>{{@$booking_detail->businessPriceDetailsAgesTrashed->category_title}} </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="bg-light-grey completed-member-text">
                                    <div class="row">
                                        <div class="col-lg-6 col-md-6 col-sm-6 col-6">
                                            <div class="line-break comp-rows">
                                                <label>PRICE OPTION:</label>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-6 col-6">
                                            <div class="float-end line-break text-right">
                                                <span>{{@$booking_detail->business_price_detail_with_trashed->price_title}} </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="completed-member-text">
                                    <div class="row">
                                        <div class="col-lg-6 col-md-6 col-sm-6 col-6">
                                            <div class="line-break comp-rows">
                                                <label>ACTIVATION START DATE:</label>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-6 col-6">
                                            <div class="float-end line-break text-right">
                                                <span> {{date('m/d/Y',strtotime(@$booking_detail->contract_date))}}</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="bg-light-grey completed-member-text">
                                    <div class="row">
                                        <div class="col-lg-6 col-md-6 col-sm-6 col-6">
                                            <div class="line-break comp-rows">
                                                <label>EXPIRATION DATE:</label>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-6 col-6">
                                            <div class="float-end line-break text-right">
                                                <span> {{date('m/d/Y',strtotime(@$booking_detail->expired_at))}}</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="completed-member-text">
                                    <div class="row">
                                        <div class="col-lg-6 col-md-6 col-sm-6 col-6">
                                            <div class="line-break comp-rows">
                                                <label>DATE BOOKED:	</label>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-6 col-6">
                                            <div class="float-end line-break text-right">
                                                <span>{{date('m/d/Y',strtotime(@$booking_detail->created_at))}}</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="bg-light-grey completed-member-text ">
                                    <div class="row">
                                        @if (@$booking_detail->business_services_with_trashed)
                                        <div class="col-lg-6 col-md-6 col-sm-6 col-6">
                                            <div class="line-break comp-rows">
                                                <label>BOOKING TIME: </label>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-6 col-6">
                                            <div class="float-end line-break text-right">
                                                <span> {{date('h:i A', strtotime(@$booking_detail->business_services_with_trashed->shift_start))}}</span>
                                            </div>
                                        </div>
                                        @endif
                                    </div>
                                </div>

                                <div class="completed-member-text">
                                    <div class="row">
                                        @if (@$booking_detail->customer)
                                            <div class="col-lg-6 col-md-6 col-sm-6 col-6">
                                                <div class="line-break comp-rows">
                                                    <label>BOOKED BY:</label>
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-md-6 col-sm-6 col-6">
                                                <div class="float-end line-break text-right">
                                                    <span>{{@$booking_detail->customer->fname}} {{@$booking_detail->customer->lname}} (In person)</span>
                                                </div>
                                            </div>
                                        @endif
                                    </div>
                                </div>

                                <div class="bg-light-grey completed-member-text">
                                    <div class="row">
                                    @if (@$booking_detail->business_services_with_trashed)
                                        <div class="col-lg-6 col-md-6 col-sm-6 col-6">
                                            <div class="line-break comp-rows">
                                                <label>ACTIVITY TYPE:</label>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-6 col-6">
                                            <div class="float-end line-break text-right">
                                                <span>{{@$booking_detail->business_services_with_trashed->sport_activity}}</span>
                                            </div>
                                        </div>
                                    @endif
                                    </div>
                                </div>

                                <div class="completed-member-text">
                                    <div class="row">
                                    @if (@$booking_detail->business_services_with_trashed)
                                        <div class="col-lg-6 col-md-6 col-sm-6 col-6">
                                            <div class="line-break comp-rows">
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
        </div>
    </div>
</div>
@endforeach