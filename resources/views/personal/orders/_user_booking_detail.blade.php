@if(!empty($bookingDetail))
    @foreach($bookingDetail as $i=>$book_details)
        <div class="col-md-4 col-sm-6 ">
            <div class="boxes_arts">
                <div class="headboxes">
                    @if( @$book_details->business_services_with_trashed  && Storage::disk('s3')->exists( @$book_details->business_services_with_trashed->first_profile_pic() ) )
                        <img src="{{Storage::URL(@$book_details->business_services_with_trashed->first_profile_pic())}}" class="imgboxes" alt="">
                    @else
                        <img src="{{url('/images/service-nofound.jpg')}}" class="imgboxes" alt="">
                    @endif
                    <h4 class="fontsize">{{@$book_details->business_services_with_trashed->program_name}}</h4>
					<div class="text-center">
						<span class="date-timebooking"> @if(@$book_details->getReserveData('reserve_date') != '—') {{@$book_details->getReserveData('reserve_date')}}  | {{@$book_details->getReserveData('reserve_time')}} @endif</span>
					</div>
					<div>
						<a class="openreceiptmodel set-file-icon" data-behavior="ajax_html_modal" data-url="{{route('getreceiptmodel',['orderid'=>@$book_details->booking_id , 'orderdetailid'=>@$book_details->id])}}" data-modal-width="900px">
							<i class="fas fa-file-alt file-booking-receipt" aria-hidden="true"></i>
						</a>
						@if($tabname == 'current')
						   <!--  <div class="booking-active @if(@$book_details->pay_session >0 ) booking-active-color @else booking-inactive-color @endif">@if(@$book_details->pay_session >0 ) Active @else Inactive @endif</div> -->
						@endif
						<div class="highlighted_box">Confirmed</div>
                   </div>
                </div>
                <div class="middleboxes middletoday" id="{{$tabname}}_<?php echo $i.'_'.@$book_details->business_services_with_trashed->id; ?>">
                    <p>
                        <span class="text-left">BOOKING CONFIRMATION #</span>
                        <span class="text-rihgt">{{@$book_details->booking->order_id}}</span>
                    </p>
                    <p>
                        <span class="text-left">TOTAL PRICE:</span>
                        <span class="text-rihgt">@if(@$book_details->booking->getPaymentDetail() != 'Comp') {{ @$book_details->subtotal}} @else 0 @endif </span>
                    </p>
                    <p>
                        <span class="text-left">PRICE OPTION:</span>
                        <span class="text-right">{{@$book_details->business_price_detail_with_trashed->price_title}} - {{@$book_details['pay_session']}} Sessions</span>
                    </p>
                    <p>
                        <span class="text-left">PAYMENT TYPE:</span>
                        <span class="text-rihgt"> {{@$book_details['pay_session']}} Sessions</span>
                    </p>

                    <p>
                        <span class="text-left">TOTAL REMAINING:</span>
                        <span class="text-rihgt">{{@$book_details->getremainingsession()}}/{{@$book_details['pay_session']}}</span>
                    </p>
                    <p>
                        <span class="text-left">PROGRAM NAME:</span>
                        <span class="text-rihgt">{{@$book_details->business_services_with_trashed->program_name}}</span>
                    </p>
                    <p>
                        <span class="text-left">EXPIRATION DATE:</span>
                        <span class="text-rihgt">{{date('m-d-Y',strtotime(@$book_details->expired_at))}}</span>
                    </p>
                    <p>
                        <span class="text-left">DATE BOOKED:</span>
                        <span class="text-rihgt">{{date('m-d-Y',strtotime(@$book_details->created_at))}}</span>
                    </p>
                    <p>
                        <span class="text-left">RESERVED DATE:</span>
                        <span class="text-rihgt">{{@$book_details->getReserveData('reserve_date')}}</span>
                    </p>
                
                    <p>
                        <span class="text-left">BOOKED BY:</span>
                        <span class="text-rihgt">{{@$book_details->booking->getBookedFirstName()}} {{@$book_details->booking->getBookedLastName()}} </span>
                    </p>

                    <p>
                        <span class="text-left">CHECK IN DATE:</span>
                        <span class="text-rihgt">{{@$book_details->getReserveData('reserve_date')}}</span>
                    </p> 
                    <p>
                        <span class="text-left">CHECK IN TIME:</span>
                        <span class="text-rihgt">{{@$book_details->getReserveData('check_in_time')}}</span>
                    </p>

                    <p>
                        <span class="text-left">ACTIVITY TYPE:</span>
                        <span class="text-rihgt">{{@$book_details->business_services_with_trashed->sport_activity}}</span>
                    </p>
                    <p>
                        <span class="text-left">SERVICE TYPE:</span>
                        <span class="text-rihgt">{{@$book_details->business_services_with_trashed->select_service_type ?? "—" }}</span>
                    </p>
                    
                    <p>
                        <span class="text-left">ACTIVITY LOCATION:</span>
                        <span class="text-rihgt">{{@$book_details->business_services_with_trashed->activity_location}}</span>
                    </p> 

                    <p>
                        <span class="text-left">ACTIVITY DURATION:</span>
                        <span class="text-rihgt">{{@$book_details->getReserveData('reserve_time')}}</span>
                    </p>

                    <p>
                        <span class="text-left">GREAT FOR:</span>
                        <span class="text-rihgt">{{@$book_details->business_services_with_trashed->activity_for}}</span>
                    </p>
                   
                    <p>
                        <span class="text-left">PARTICIPANTS:</span>
                        <span class="text-rihgt">{!!$book_details->getparticipate()!!}</span>
                    </p>
                    <p>
                        <span class="text-left">WHO IS PARTICIPATING?</span>
                        <span class="text-rihgt">{!!$book_details->decodeparticipate()!!}</span>
                    </p>
                    <p>
                        <span class="text-left">ADD ON SERVICES:</span>
                        <span class="text-rihgt">{!! getAddonService($book_details->addOnservice_ids,$book_details->addOnservice_qty) !!} </span>
                    </p>
                </div>
                <div class="foterboxes">
                    <div class="threebtn_fboxes">
                        @if($tabname != 'past' )
                            <a class="btn-booking-red"  href="{{route('business_activity_schedulers',['business_id' => $book_details['business_id'] ,'business_service_id'=>$book_details['sport'] ,'stype'=>@$book_details->business_services_with_trashed->service_type ,'priceid' =>$book_details['priceid'] ,'customer_id' =>$book_details['user_id'] ] )}}" target="_blank">Schedule</a>
                        @endif
                        @if($tabname == 'past')
                         <a href="{{route('activities_show',['serviceid' => $book_details->business_services_with_trashed->id ])}}" target="_blank">Rebook</a>
                        @endif

                       <!-- <button class="canclebtn" type="button" onclick="cancelorder({{@$book_details['user_booking_detail']['id']}});">Cancel</button> -->
                    </div>
                    <div class="threebtn_fboxes" id="anothertwobtn{{$i}}_{{@$book_details->business_services_with_trashed->id}}" style="display:none;">
                        <a href="<?php echo config('app.url'); ?>/businessprofile/<?php echo strtolower(str_replace(' ', '', $book_details->company_information->dba_business_name)).'/'.$book_details->company_information->id; ?>" target="_blank">View Provider</a>
                    </div>
                    <div class="viewmore_links">
                        <a id="viewmore_{{$tabname}}_{{$i}}_{{@$book_details->business_services_with_trashed->id}}" style="display:block">View More <img src="{{ url('public/img/arrow-down.png') }}" alt=""></a>
                        <a id="viewless_{{$tabname}}_{{$i}}_{{@$book_details->business_services_with_trashed->id}}" style="display:none">View Less <img src="{{ url('public/img/arrow-down.png') }}" alt=""></a>
                    </div>
                    <script>
                        $("#viewmore_{{$tabname}}_{{$i}}_{{@$book_details->business_services_with_trashed->id}}").click(function () {
                            $("#{{$tabname}}_{{$i}}_{{@$book_details->business_services_with_trashed->id}}").addClass("intro");
                            $("#viewless_{{$tabname}}_{{$i}}_{{@$book_details->business_services_with_trashed->id}}").show();
                            $("#viewmore_{{$tabname}}_{{$i}}_{{@$book_details->business_services_with_trashed->id}}").hide();
                            $("#anothertwobtn{{$i}}_{{@$book_details->business_services_with_trashed->id}}").show();
                        });
                        $("#viewless_{{$tabname}}_{{$i}}_{{@$book_details->business_services_with_trashed->id}}").click(function () {
                            $("#{{$tabname}}_{{$i}}_{{@$book_details->business_services_with_trashed->id}}").removeClass("intro");
                            $("#viewless_{{$tabname}}_{{$i}}_{{@$book_details->business_services_with_trashed->id}}").hide();
                            $("#viewmore_{{$tabname}}_{{$i}}_{{@$book_details->business_services_with_trashed->id}}").show();
                            $("#anothertwobtn{{$i}}_{{@$book_details->business_services_with_trashed->id}}").hide();
                        });
                    </script>
                </div>
            </div>
        </div>
    @endforeach
@endif

