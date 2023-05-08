@if(!empty($bookingDetail))
    @foreach($bookingDetail as $book_details)
    @php 
        $pic = url('/public/uploads/profile_pic');                 
        
        $pic =  url('/public/uploads/profile_pic/'.$book_details->business_services()->withTrashed()->first()->first_profile_pic());
        
    @endphp
        <div class="col-md-4 col-sm-6 ">
            <div class="boxes_arts">
                <div class="headboxes">
                    <img src="{{$pic}}" class="imgboxes" alt="">
                    <h4 class="fontsize">{{$book_details->business_services()->withTrashed()->first()->program_name}}</h4>

                    <a class="openreceiptmodel" data-behavior="ajax_html_modal" data-url="{{route('getreceiptmodel',['orderid'=>$book_details->booking_id , 'orderdetailid'=>$book_details->id])}}" data-modal-width="900px">
                        <i class="fas fa-file-alt file-booking-receipt" aria-hidden="true"></i>
                    </a>
                    @if($tabname == 'current')
                       <!--  <div class="booking-active @if($book_details->pay_session >0 ) booking-active-color @else booking-inactive-color @endif">@if($book_details->pay_session >0 ) Active @else Inactive @endif</div> -->
                    @endif
                    <div class="highlighted_box">Confirmed</div>
                   
                </div>
                <div class="middleboxes middletoday" id="{{$tabname}}_<?php echo $i.'_'.$book_details->business_services()->withTrashed()->first()->id; ?>">
                    <p>
                        <span class="text-left">BOOKING CONFIRMATION #</span>
                        <span class="text-rihgt">{{$book_details->booking->order_id}}</span>
                    </p>
                    <p>
                        <span class="text-left">TOTAL PRICE:</span>
                        <span class="text-rihgt">@if($book_details->booking->getPaymentDetail() != 'Comp') {{$book_details->getperoderprice() + $book_details->total()}} @else 0 @endif </span>
                    </p>
                    <p>
                        <span class="text-left">PRICE OPTION:</span>
                        <span class="text-right">{{@$book_details->business_price_detail_with_trashed->price_title}} - {{@$book_details['pay_session']}} Sessions
                        
                        </span>
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
                        <span class="text-rihgt">{{$book_details->business_services()->withTrashed()->first()->program_name}}</span>
                    </p>
                    <p>
                        <span class="text-left">EXPIRATION DATE:</span>
                        <span class="text-rihgt">{{date('m-d-Y',strtotime($book_details->expired_at))}}</span>
                    </p>
                    <p>
                        <span class="text-left">DATE BOOKED:</span>
                        <span class="text-rihgt">{{date('m-d-Y',strtotime($book_details->created_at))}}</span>
                    </p>
                    <p>
                        <span class="text-left">RESERVED DATE:</span>
                        <span class="text-rihgt">{{@$book_details->getReserveData('reserve_date')}}</span>
                    </p>
                
                    <p>
                        <span class="text-left">BOOKED BY:</span>
                        <span class="text-rihgt">{{$book_details->booking->getBookedFirstName()}} {{$book_details->booking->getBookedLastName()}} </span>
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
                        <span class="text-rihgt">{{$book_details->business_services()->withTrashed()->first()->sport_activity}}</span>
                    </p>
                    <p>
                        <span class="text-left">SERVICE TYPE:</span>
                        <span class="text-rihgt">@if($book_details->business_services()->withTrashed()->first()->select_service_type != '') {{$book_details->business_services()->withTrashed()->first()->select_service_type}} @else — @endif</span>
                    </p>
                    
                    <p>
                        <span class="text-left">ACTIVITY LOCATION:</span>
                        <span class="text-rihgt">{{$book_details->business_services()->withTrashed()->first()->activity_location}}</span>
                    </p> 

                    <p>
                        <span class="text-left">ACTIVITY DURATION:</span>
                        <span class="text-rihgt">{{@$book_details->getReserveData('reserve_time')}}</span>
                    </p>

                    <p>
                        <span class="text-left">GREAT FOR:</span>
                        <span class="text-rihgt">{{$book_details->business_services()->withTrashed()->first()->activity_for}}</span>
                    </p>
                   
                    <p>
                        <span class="text-left">PARTICIPANTS:</span>
                        <span class="text-rihgt">{!!$book_details->getparticipate()!!}</span>
                    </p>
                    <p>
                        <span class="text-left">WHO IS PARTICIPATING?</span>
                        <span class="text-rihgt">{!!$book_details->decodeparticipate()!!}</span>
                    </p>
                </div>
                <div class="foterboxes">
                    <div class="threebtn_fboxes">
                        @if($tabname == 'current' || $tabname == 'upcoming'  )
                            <a href="{{route('business_activity_schedulers',['business_id' => $book_details['business_id'] ,'business_service_id'=>$book_details['sport'] ,'stype'=>$book_details->business_services()->withTrashed()->first()->service_type ,'priceid' =>$book_details['priceid'] ,'customer_id' =>@$customer->id ] )}}" target="_blank">Schedule</a>
                        @endif
                        @if($tabname == 'past')
                         <a href="{{route('activities_show',['serviceid' => $book_details->business_services()->withTrashed()->first()->id ])}}" target="_blank">Rebook</a>
                        @endif

                       <!-- <button class="canclebtn" type="button" onclick="cancelorder({{@$book_details['user_booking_detail']['id']}});">Cancel</button> -->
                    </div>
                    <div class="threebtn_fboxes" id="anothertwobtn{{$i}}_{{$book_details->business_services()->withTrashed()->first()->id}}" style="display:none;">
                        <a href="<?php echo config('app.url'); ?>/businessprofile/<?php echo strtolower(str_replace(' ', '', $book_details->company_information->dba_business_name)).'/'.$book_details->company_information->id; ?>" target="_blank">View Provider</a>
                    </div>
                    <div class="viewmore_links">
                        <a id="viewmore_{{$tabname}}_{{$i}}_{{$book_details->business_services()->withTrashed()->first()->id}}" style="display:block">View More <img src="{{ url('public/img/arrow-down.png') }}" alt=""></a>
                        <a id="viewless_{{$tabname}}_{{$i}}_{{$book_details->business_services()->withTrashed()->first()->id}}" style="display:none">View Less <img src="{{ url('public/img/arrow-down.png') }}" alt=""></a>
                    </div>
                    <script>
                        $("#viewmore_{{$tabname}}_{{$i}}_{{$book_details->business_services()->withTrashed()->first()->id}}").click(function () {
                            $("#{{$tabname}}_{{$i}}_{{$book_details->business_services()->withTrashed()->first()->id}}").addClass("intro");
                            $("#viewless_{{$tabname}}_{{$i}}_{{$book_details->business_services()->withTrashed()->first()->id}}").show();
                            $("#viewmore_{{$tabname}}_{{$i}}_{{$book_details->business_services()->withTrashed()->first()->id}}").hide();
                            $("#anothertwobtn{{$i}}_{{$book_details->business_services()->withTrashed()->first()->id}}").show();
                        });
                        $("#viewless_{{$tabname}}_{{$i}}_{{$book_details->business_services()->withTrashed()->first()->id}}").click(function () {
                            $("#{{$tabname}}_{{$i}}_{{$book_details->business_services()->withTrashed()->first()->id}}").removeClass("intro");
                            $("#viewless_{{$tabname}}_{{$i}}_{{$book_details->business_services()->withTrashed()->first()->id}}").hide();
                            $("#viewmore_{{$tabname}}_{{$i}}_{{$book_details->business_services()->withTrashed()->first()->id}}").show();
                            $("#anothertwobtn{{$i}}_{{$book_details->business_services()->withTrashed()->first()->id}}").hide();
                        });
                    </script>
                </div>
            </div>
        </div>
    @php  $i++; @endphp
    @endforeach
@endif