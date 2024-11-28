<h5 class="modal-title mb-10" id="myModalLabel">Booking Receipt</h5>

@php
    use App\UserBookingDetail;
    use Carbon\Carbon;
    $totalTax  = $totDis = $totTip = $grandTotal=0;
    $idArry = ''; 
@endphp

<div class="row">
    <div class="col-lg-4 bg-sidebar">
        <div class="your-booking-page side-part">
            <div class="booking-page-meta">
                <a href="#" title="" class="underline"></a>
            </div>
            <div class="box-subtitle">
                <h4>Transaction Complete</h4>
                <div class="modal-inner-box">
                    <label></label>
                    <h3>Email Receipt</h3>
                    <div class="form-group mb-25">
                        <input type="text" name="email" id="clientEmail" placeholder="youremail@abc.com" class="form-control" value="{{$email}}">
                    </div>
                    <button class="btn btn-red width-100 mb-25" onclick="sendemail();">Send Email Receipt</button>
                    <div class="reviewerro" id="reviewerro"></div>
                </div>
            </div>
            <div class="powered-img">
                {{-- <label>Powered By</label> --}}
                <div class="booking-modal-logo">
                    <img src="{{url('/public/dashboard-design/images/powered-by-OMNEBOOK-white1.png')}}">
                    {{-- <img src="https://dev.fitnessity.co//public/dashboard-design/images/powered-by-OMNEBOOK.png" alt="Fitnessity"> --}}
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-8">
        <div class="modal-booking-info mmt-10 imt-10 main-separator mb-25">
            @foreach($array as $or)
                <?php 
                    $orderDetail = UserBookingDetail::find($or);
                    $idArry .= $or.',';
                    $totalTax += number_format($orderDetail->tax + $orderDetail->service_fee ,2);
                    $totDis +=  number_format($orderDetail->discount,2);
                    $totTip +=  number_format($orderDetail->tip,2);
                    $grandTotal +=  is_numeric($orderDetail->subtotal) ? $orderDetail->subtotal : 0;
                ?>
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-6 col-6">
                        <div class="text-left space-bottom">
                            <label>BOOKING#</label>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6 col-6">
                        <div class="float-end text-right">
                            <span>{{ $orderDetail->userBookingStatus->order_id}}</span>
                        </div>
                    </div>
                    
                    <div class="col-lg-6 col-md-6 col-sm-6 col-6">
                        <div class="text-left space-bottom">
                            <label>PROVIDER COMPANY NAME:</label>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6 col-6">
                        <div class="float-end text-right">
                            <span>{{ $orderDetail->company_information->company_name}}</span>
                        </div>
                    </div>
                    
                    <div class="col-lg-6 col-md-6 col-sm-6 col-6">
                        <div class="text-left space-bottom">
                            <label>PROGRAM NAME:</label>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6 col-6">
                        <div class="float-end text-right">
                            <span>{{ ($orderDetail->business_services_with_trashed ? $orderDetail->business_services_with_trashed->program_name : 'N/A' )}}</span>
                        </div>
                    </div>
                    
                    <div class="col-lg-6 col-md-6 col-sm-6 col-6">
                        <div class="text-left space-bottom">
                            <label>CATEGORY:</label>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6 col-6">
                        <div class="float-end text-right">
                            <span>{{@$orderDetail->businessPriceDetailsAgesTrashed->category_title ?? 'N/A'}} </span>
                        </div>
                    </div>
                    
                    <div class="col-lg-6 col-md-6 col-sm-6 col-6">
                        <div class="text-left space-bottom">
                            <label>PRICE OPTION:</label>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6 col-6">
                        <div class="float-end text-right">
                            <span>{{$orderDetail->business_services_with_trashed ? $orderDetail->business_price_detail_with_trashed->price_title : 'N/A'}}</span>
                        </div>
                    </div>
                    
                    <div class="col-lg-6 col-md-6 col-sm-6 col-6">
                        <div class="text-left space-bottom">
                            <label>NUMBER OF SESSIONS:</label>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6 col-6">
                        <div class="float-end text-right">
                            <span>{{$orderDetail->pay_session}} Session</span>
                        </div>
                    </div>
                    
                    <div class="col-lg-6 col-md-6 col-sm-6 col-6">
                        <div class="text-left space-bottom">
                            <label>MEMBERSHIP OPTION:</label>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6 col-6">
                        <div class="float-end text-right">
                            <span>{{$orderDetail->business_price_detail_with_trashed ? $orderDetail->business_price_detail_with_trashed->membership_type : 'N/A' }}</span>
                        </div>
                    </div>
                    
                    <div class="col-lg-6 col-md-6 col-sm-6 col-6">
                        <div class="text-left space-bottom">
                            <label>PARTICIPANT QUANTITY:</label>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6 col-6">
                        <div class="float-end text-right">
                            <span>{!! $orderDetail->getparticipate() ?? N/A !!}</span>
                        </div>
                    </div>
                    
                    <div class="col-lg-6 col-md-6 col-sm-6 col-6">
                        <div class="text-left space-bottom">
                            <label>WHO IS PRATICIPATING?</label>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6 col-6">
                        <div class="float-end text-right">
                            <span>{!! ($orderDetail->order_type == 'Membership') ? $orderDetail->decodeparticipate() : 'N/A' !!} </span>
                                @php
                                 $user = App\Customer::where('id',$orderDetail->user_id)->first();
                                 $name = @$user->fname.' '.@$user->lname .' ( age '. Carbon::parse(@$user->birthdate)->age .' ) ' ;                                 
                                @endphp
                                @if(empty($orderDetail->decodeparticipate()))
                                <span>{{$name}}</span>
                                @endif

                        </div>
                    </div>
                    
                    <div class="col-lg-6 col-md-6 col-sm-6 col-6">
                        <div class="text-left space-bottom">
                            <label>ACTIVITY TYPE:</label>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6 col-6">
                        <div class="float-end text-right">
                            <span>{{ $orderDetail->business_services_with_trashed   ? $orderDetail->business_services_with_trashed->sport_activity : 'N/A' }}</span>
                        </div>
                    </div>
                    
                    <div class="col-lg-6 col-md-6 col-sm-6 col-6">
                        <div class="text-left space-bottom">
                            <label>SERVICE TYPE:</label>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6 col-6">
                        <div class="float-end text-right">
                            <span>{{$orderDetail->business_services_with_trashed  ? $orderDetail->business_services_with_trashed->select_service_type : 'N/A'}}</span>
                        </div>
                    </div>
                    
                    <div class="col-lg-6 col-md-6 col-sm-6 col-6">
                        <div class="text-left space-bottom">
                            <label>MEMBERSHIP DURATION:</label>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6 col-6">
                        <div class="float-end text-right">
                            <span>{{$orderDetail->expired_duration ??  "—"}}</span>
                        </div>
                    </div>
                    
                    <div class="col-lg-6 col-md-6 col-sm-6 col-6">
                        <div class="text-left space-bottom">
                            <label>PURCHASE DATE:</label>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6 col-6">
                        <div class="float-end text-right">
                            <span>{{date('m-d-Y',strtotime($orderDetail->created_at))}}</span>
                        </div>
                    </div>
                    
                    <div class="col-lg-6 col-md-6 col-sm-6 col-6">
                        <div class="text-left space-bottom">
                            <label>MEMBERSHIP ACTIVATION DATE:</label>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6 col-6">
                        <div class="float-end text-right">
                            <span>{{date('d-m-Y',strtotime($orderDetail->contract_date))}}</span>
                        </div>
                    </div>
                    
                    <div class="col-lg-6 col-md-6 col-sm-6 col-6">
                        <div class="text-left space-bottom">
                            <label>MEMBERSHIP EXPIRATION:</label>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6 col-6">
                        <div class="float-end text-right">
                            <span>{{date('d-m-Y',strtotime($orderDetail->expired_at))}}</span>
                        </div>
                    </div>

                    <div class="col-md-6 col-xs-6">
                        <div class="text-left">
                            <label>ADD ON SERVICE:</label>
                        </div>
                    </div>
                    <div class="col-md-6 col-xs-6">
                        <div class="float-end text-right">
                            <span>{!! getAddonService($orderDetail->addOnServicesId,$orderDetail->addOnServicesQty) !!}</span>
                        </div>
                    </div>

                    <div class="col-md-6 col-xs-6">
                        <div class="text-left">
                            <label>PRODUCTS:</label>
                        </div>
                    </div>
                    <div class="col-md-6 col-xs-6">
                        <div class="float-end text-right">
                            <span>{!! getProducts($orderDetail->productIds,$orderDetail->productQtys,$orderDetail->productTypes) !!}</span>
                        </div>
                    </div>

                    
                    <div class="col-lg-6 col-md-6 col-sm-6 col-6">
                        <div class="text-left space-bottom">
                            <label>PRICE:</label>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6 col-6">
                        <div class="float-end text-right">
                            {{-- <span>{{ json_decode($orderDetail->price)->custom ?? 'N/A' }}</span> --}}
                            <span>${{$orderDetail->total() + $orderDetail->productTotalPrices + $orderDetail->addOnservice_total}}</span>
                        
                        </div>
                    </div>
                    @if (!$loop->last)
                        <div class="main-separator mb-10"></div>
                    @endif
                    <!-- <div class="col-lg-6 col-md-6 col-sm-6 col-6">
                        <div class="text-left space-bottom">
                            <label class="highlight-fonts">TOTAL:</label>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6 col-6">
                        <div class="float-end text-right">
                            <span class="highlight-fonts">${{$orderDetail->subtotal}}</span>
                        </div>
                    </div> -->
                </div>
            @endforeach
        </div>
        @php $idArry = rtrim($idArry,','); @endphp

        <input type="hidden" name="booking_id" id="booking_id" value="{{@$orderDetail->booking_id}}"> 
        <input type="hidden" name="orderdetalidary[]" id="orderdetalidary" value="{{$idArry}}"> 
        <div class="main-separator mb-10">
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-6 col-6">
                    <div class=" text-left">
                        <label class="font-red">PAYMENT METHOD</label>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6 col-6">
                    <div class="float-end line-break text-right">
                        <span class="font-red">{{ $orderDetail->userBookingStatus->getPaymentDetail()}}</span>
                    </div>
                </div>
            </div>
        </div>
                
        <div class="main-separator mb-10">
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-6 col-6">
                    <div class=" text-left">
                        <label class="font-red">TIP AMOUNT</label>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6 col-6">
                    <div class="float-end line-break text-right">
                        <span class="font-red">$ {{$totTip}}</span>
                    </div>
                </div>
            </div>
        </div>
                
        <div class="main-separator mb-10">
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-6 col-6">
                    <div class=" text-left">
                        <label class="font-red">DISCOUNT</label>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6 col-6">
                    <div class="float-end line-break text-right">
                        <span class="font-red">$ {{$totDis}} </span>
                    </div>
                </div>
            </div>
        </div>
                
        <div class="main-separator mb-10">
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-6 col-6">
                    <div class=" text-left">
                        <label class="font-red">TAXES AND FEES</label>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6 col-6">
                    <div class="float-end line-break text-right">
                        <span class="font-red">$ {{$totalTax}}</span>
                    </div>
                </div>
            </div>
        </div>
                
                
        <div class="main-separator mb-10">
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-6 col-6">
                    <div class=" text-left">
                        <label class="font-red">TOTAL AMOUNT PAID</label>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6 col-6">
                    <div class="float-end line-break text-right">
                        <span class="font-red">${{@$grandTotal}}</span>
                    </div>
                </div>
            </div>  
        </div>
        @if($orderDetail->status=='refund')
        <div class="main-separator mb-10">
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-6 col-6">
                    <div class=" text-left">
                        <label class="font-red">REFUNDED AMOUNT</label>
                    </div>
                </div>

                <div class="col-lg-6 col-md-6 col-sm-6 col-6">
                    <div class="float-end line-break text-right">
                        <span class="font-red">${{@$orderDetail->refund_amount}}</span>
                    </div>
                </div>
            </div>  
        </div>
        @endif

    </div>
</div>

<script type="text/javascript">
    function sendemail(){
        $('.reviewerro').html('');
        var email = $('#clientEmail').val();
        var orderdetalidary = $('#orderdetalidary').val();
        var booking_id = $('#booking_id').val();
        if(email == ''){
            $('.reviewerro').css('display','block');
            $('.reviewerro').html('Please Add Email Address..');
        }else if(!valid(email)){
            $('.reviewerro').css('display','block');
            $('.reviewerro').html('Please Enter Valid Email Address..');
        }else{
            $('.btn-modal-booking').attr('disabled',true);
            $('.reviewerro').css('display','block');
            $('.reviewerro').html('Sending...');
            $.ajax({
                url: "{{route('sendreceiptfromcheckout')}}",
                xhrFields: {
                    withCredentials: true
                },
                type: 'get',
                data:{
                    orderdetalidary:orderdetalidary,
                    email:email,
                    booking_id:booking_id,
                },
                success: function (response) {
                    $('.reviewerro').html('');
                    $('.reviewerro').css('display','block');
                    $('.reviewerro').html('Email Successfully Sent..');
                }
            });
        }
    }
</script>