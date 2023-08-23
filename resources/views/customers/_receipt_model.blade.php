
<h5 class="modal-title mb-10" id="myModalLabel">Booking Receipt</h5>

@php
    use App\UserBookingDetail;
    use App\Repositories\BookingRepository;
    $booking_repo = new BookingRepository;
    $totaltax = $subtotaltax = $tot_dis = $tot_tip = $service_fee = 0;
    $idarry = ''; 
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
                <label>Powered By</label>
                <div class="booking-modal-logo">
                    <img src="{{url('/public/images/fitnessity_logo1.png')}}">
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-8">
        <div class="modal-booking-info mmt-10 imt-10 main-separator mb-25">
            @foreach($array as $or)
                @php 
                    $order_detail = UserBookingDetail::where('id',$or)->first();
                    $idarry .= $or.',';
                    $odt = $booking_repo->getorderdetailsfromodid($order_detail->booking_id,$or);
                    $totaltax += $odt['tax_for_this'];
                    $tot_dis += $odt['discount'];
                    $tot_tip += $odt['tip'];
                    $service_fee += $odt['service_fee'];
                    $total = ($odt['totprice_for_this'] - $odt['discount']);
                    $subtotaltax += $total;
                    $per_total = $total;
                @endphp
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-6 col-6">
                        <div class="text-left space-bottom">
                            <label>BOOKING#</label>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6 col-6">
                        <div class="float-end text-right">
                            <span>{{ $odt['confirm_id']}}</span>
                        </div>
                    </div>
                    
                    <div class="col-lg-6 col-md-6 col-sm-6 col-6">
                        <div class="text-left space-bottom">
                            <label>PROVIDER COMPANY NAME:</label>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6 col-6">
                        <div class="float-end text-right">
                            <span>{{ $odt['company_name']}}</span>
                        </div>
                    </div>
                    
                    <div class="col-lg-6 col-md-6 col-sm-6 col-6">
                        <div class="text-left space-bottom">
                            <label>PROGRAM NAME:</label>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6 col-6">
                        <div class="float-end text-right">
                            <span>{{ $odt['program_name']}}</span>
                        </div>
                    </div>
                    
                    <div class="col-lg-6 col-md-6 col-sm-6 col-6">
                        <div class="text-left space-bottom">
                            <label>CATEGORY:</label>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6 col-6">
                        <div class="float-end text-right">
                            <span>{{ $odt['categoty_name']}}</span>
                        </div>
                    </div>
                    
                    <div class="col-lg-6 col-md-6 col-sm-6 col-6">
                        <div class="text-left space-bottom">
                            <label>PRICE OPTION:</label>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6 col-6">
                        <div class="float-end text-right">
                            <span>{{@$odt['BusinessPriceDetails']['price_title']}}</span>
                        </div>
                    </div>
                    
                    <div class="col-lg-6 col-md-6 col-sm-6 col-6">
                        <div class="text-left space-bottom">
                            <label>NUMBER OF SESSIONS:</label>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6 col-6">
                        <div class="float-end text-right">
                            <span>{{@$odt['pay_session']}} Session</span>
                        </div>
                    </div>
                    
                    <div class="col-lg-6 col-md-6 col-sm-6 col-6">
                        <div class="text-left space-bottom">
                            <label>MEMBERSHIP OPTION:</label>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6 col-6">
                        <div class="float-end text-right">
                            <span>{{$odt['BusinessPriceDetails']['membership_type']}}</span>
                        </div>
                    </div>
                    
                    <div class="col-lg-6 col-md-6 col-sm-6 col-6">
                        <div class="text-left space-bottom">
                            <label>PARTICIPANT QUANTITY:</label>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6 col-6">
                        <div class="float-end text-right">
                            <span>{{ $odt['qty']}}</span>
                        </div>
                    </div>
                    
                    <div class="col-lg-6 col-md-6 col-sm-6 col-6">
                        <div class="text-left space-bottom">
                            <label>WHO IS PRATICIPATING?</label>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6 col-6">
                        <div class="float-end text-right">
                            <span>{{ $odt['parti_data']}}</span>
                        </div>
                    </div>
                    
                    <div class="col-lg-6 col-md-6 col-sm-6 col-6">
                        <div class="text-left space-bottom">
                            <label>ACTIVITY TYPE:</label>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6 col-6">
                        <div class="float-end text-right">
                            <span>{{ $odt['sport_activity']}}</span>
                        </div>
                    </div>
                    
                    <div class="col-lg-6 col-md-6 col-sm-6 col-6">
                        <div class="text-left space-bottom">
                            <label>SERVICE TYPE:</label>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6 col-6">
                        <div class="float-end text-right">
                            <span>{{ $odt['select_service_type']}}</span>
                        </div>
                    </div>
                    
                    <div class="col-lg-6 col-md-6 col-sm-6 col-6">
                        <div class="text-left space-bottom">
                            <label>MEMBERSHIP DURATION:</label>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6 col-6">
                        <div class="float-end text-right">
                            <span>{{$order_detail->expired_duration != '' ? $order_detail->expired_duration : "—"}}</span>
                        </div>
                    </div>
                    
                    <div class="col-lg-6 col-md-6 col-sm-6 col-6">
                        <div class="text-left space-bottom">
                            <label>PURCHASE DATE:</label>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6 col-6">
                        <div class="float-end text-right">
                            <span>{{$odt['created_at']}}</span>
                        </div>
                    </div>
                    
                    <div class="col-lg-6 col-md-6 col-sm-6 col-6">
                        <div class="text-left space-bottom">
                            <label>MEMBERSHIP ACTIVATION DATE:</label>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6 col-6">
                        <div class="float-end text-right">
                            <span>{{date('d-m-Y',strtotime($order_detail->contract_date))}}</span>
                        </div>
                    </div>
                    
                    <div class="col-lg-6 col-md-6 col-sm-6 col-6">
                        <div class="text-left space-bottom">
                            <label>MEMBERSHIP EXPIRATION:</label>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6 col-6">
                        <div class="float-end text-right">
                            <span>{{date('d-m-Y',strtotime($order_detail->expired_at))}}</span>
                        </div>
                    </div>
                    
                    <div class="col-lg-6 col-md-6 col-sm-6 col-6">
                        <div class="text-left space-bottom">
                            <label class="highlight-fonts">PRICE:</label>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6 col-6">
                        <div class="float-end text-right">
                            <span class="highlight-fonts">${{$odt['totprice_for_this']}}</span>
                        </div>
                    </div>
                    
                    <div class="col-lg-6 col-md-6 col-sm-6 col-6">
                        <div class="text-left space-bottom">
                            <label class="highlight-fonts">TOTAL:</label>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6 col-6">
                        <div class="float-end text-right">
                            <span class="highlight-fonts">${{$per_total}}</span>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        @php $idarry = rtrim($idarry,','); @endphp

        <input type="hidden" name="booking_id" id="booking_id" value="{{$order_detail->booking_id}}"> 
        <input type="hidden" name="orderdetalidary[]" id="orderdetalidary" value="{{$idarry}}"> 
        <div class="main-separator mb-10">
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-6 col-6">
                    <div class=" text-left">
                        <label class="highlight-fonts">PAYMENT METHOD</label>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6 col-6">
                    <div class="float-end line-break text-right">
                        <span class="highlight-fonts">{{ $odt['pmt_type']}}</span>
                    </div>
                </div>
            </div>
        </div>
                
        <div class="main-separator mb-10">
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-6 col-6">
                    <div class=" text-left">
                        <label class="highlight-fonts">TIP AMOUNT</label>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6 col-6">
                    <div class="float-end line-break text-right">
                        <span class="highlight-fonts">${{UserBookingDetail::where('booking_id', $orderId)->sum('tip')}}</span>
                    </div>
                </div>
            </div>
        </div>
                
        <div class="main-separator mb-10">
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-6 col-6">
                    <div class=" text-left">
                        <label class="highlight-fonts">DISCOUNT</label>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6 col-6">
                    <div class="float-end line-break text-right">
                        <span class="highlight-fonts">${{UserBookingDetail::where('booking_id', $orderId)->sum('discount')}}</span>
                    </div>
                </div>
            </div>
        </div>
                
        <div class="main-separator mb-10">
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-6 col-6">
                    <div class=" text-left">
                        <label class="highlight-fonts">TAXES AND FEES</label>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6 col-6">
                    <div class="float-end line-break text-right">
                        <span class="highlight-fonts">${{ (UserBookingDetail::where('booking_id', $orderId)->sum('tax') )}}</span>
                    </div>
                </div>
            </div>
        </div>
                
        <div class="main-separator mb-10">
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-6 col-6">
                    <div class=" text-left">
                        <label class="highlight-fonts">MERCHANT FEE</label>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6 col-6">
                    <div class="float-end line-break text-right">
                        <span class="highlight-fonts">${{ ($odt['amount'] - UserBookingDetail::where('booking_id', $orderId)->sum('subtotal') )}}</span>
                    </div>
                </div>
            </div>
        </div>
                
        <div class="main-separator mb-10">
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-6 col-6">
                    <div class=" text-left">
                        <label class="highlight-fonts">TOTAL AMOUNT PAID</label>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6 col-6">
                    <div class="float-end line-break text-right">
                        <span class="highlight-fonts">${{$odt['amount']}}</span>
                    </div>
                </div>
            </div>  
        </div>
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