
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
                    <div class="form-group">
                        <input type="text" name="email" id="email"  placeholder="youremail@abc.com" class="form-control" value="{{$email}}">
                    </div>
                    <button class="submit-btn btn-modal-booking post-btn-red" 
                 onclick="sendemail();">Send Email Receipt</button>
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
        <div class="modal-booking-info">
            <h3>Booking Receipt</h3>

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
                    <div class="col-md-6 col-xs-6">
                        <div class="booking-page-meta-info">
                            <label>BOOKING#</label>
                        </div>
                    </div>
                    <div class="col-md-6 col-xs-6">
                        <div class="booking-page-meta-info">
                            <span>{{ $odt['confirm_id']}}</span>
                        </div>
                    </div>

                    <div class="col-md-6 col-xs-6">
                        <div class="booking-page-meta-info">
                            <label>PROVIDER COMPANY NAME:</label>
                    </div>
                    </div>
                    <div class="col-md-6 col-xs-6">
                        <div class="booking-page-meta-info">
                            <span>{{ $odt['company_name']}}</span>
                        </div>
                    </div>

                    <div class="col-md-6 col-xs-6">
                        <div class="booking-page-meta-info">
                            <label>PROGRAM NAME:</label>
                        </div>
                    </div>
                    <div class="col-md-6 col-xs-6">
                        <div class="booking-page-meta-info">
                            <span>{{ $odt['program_name']}}</span>
                        </div>
                    </div>

                    <div class="col-md-6 col-xs-6">
                        <div class="booking-page-meta-info">
                            <label>CATEGORY:</label>
                        </div>
                    </div>
                    <div class="col-md-6 col-xs-6">
                        <div class="booking-page-meta-info">
                            <span>{{ $odt['categoty_name']}}</span>
                        </div>
                    </div>

                    <div class="col-md-6 col-xs-6">
                        <div class="booking-page-meta-info">
                            <label>PRICE OPTION:</label>
                        </div>
                    </div>

                    <div class="col-md-6 col-xs-6">
                        <div class="booking-page-meta-info">
                            <span>{{@$odt['BusinessPriceDetails']['price_title']}}</span>
                        </div>
                    </div>

                    <div class="col-md-6 col-xs-6">
                    <div class="booking-page-meta-info">
                            <label>NUMBER OF SESSIONS:</label>
                        </div>
                    </div>
                    <div class="col-md-6 col-xs-6">
                        <div class="booking-page-meta-info">
                            <span>{{@$odt['pay_session']}} Session</span>
                        </div>
                    </div>

                    <div class="col-md-6 col-xs-6">
                        <div class="booking-page-meta-info">
                            <label>MEMBERSHIP OPTION:</label>
                        </div>
                    </div>
                    <div class="col-md-6 col-xs-6">
                        <div class="booking-page-meta-info">
                            <span>{{$odt['BusinessPriceDetails']['membership_type']}}</span>
                        </div>
                    </div>

                    <div class="col-md-6 col-xs-6">
                        <div class="booking-page-meta-info">
                            <label>PARTICIPANT QUANTITY:</label>
                        </div>
                    </div>
                    <div class="col-md-6 col-xs-6">
                        <div class="booking-page-meta-info">
                            <span>{{ $odt['qty']}}</span>
                        </div>
                    </div>

                    <div class="col-md-6 col-xs-6">
                        <div class="booking-page-meta-info">
                            <label>WHO IS PRATICIPATING?</label>
                        </div>
                    </div>
                    <div class="col-md-6 col-xs-6">
                        <div class="booking-page-meta-info">
                            <span>{{ $odt['parti_data']}}</span>
                        </div>
                    </div>

                    <div class="col-md-6 col-xs-6">
                        <div class="booking-page-meta-info">
                            <label>ACTIVITY TYPE:</label>
                        </div>
                    </div>
                    <div class="col-md-6 col-xs-6">
                        <div class="booking-page-meta-info">
                            <span>{{ $odt['sport_activity']}}</span>
                        </div>
                    </div>

                    <div class="col-md-6 col-xs-6">
                        <div class="booking-page-meta-info">
                            <label>SERVICE TYPE:</label>
                        </div>
                    </div>
                    <div class="col-md-6 col-xs-6">
                        <div class="booking-page-meta-info">
                            <span>{{ $odt['select_service_type']}}</span>
                        </div>
                    </div>

                    <div class="col-md-6 col-xs-6">
                        <div class="booking-page-meta-info">
                            <label>MEMBERSHIP DURATION:</label>
                        </div>
                    </div>
                    <div class="col-md-6 col-xs-6">
                        <div class="booking-page-meta-info">
                            <span>{{$order_detail->expired_duration}}</span>
                        </div>
                    </div>

                    <div class="col-md-6 col-xs-6">
                        <div class="booking-page-meta-info">
                            <label>PURCHASE DATE:</label>
                        </div>
                    </div>
                    <div class="col-md-6 col-xs-6">
                        <div class="booking-page-meta-info">
                            <span>{{$odt['created_at']}}</span>
                        </div>
                    </div>

                    <div class="col-md-6 col-xs-6">
                        <div class="booking-page-meta-info">
                                <label>MEMBERSHIP ACTIVATION DATE:</label>
                        </div>
                    </div>
                    <div class="col-md-6 col-xs-6">
                        <div class="booking-page-meta-info">
                            <span>{{date('d-m-Y',strtotime($order_detail->contract_date))}}</span>
                        </div>
                    </div>

                    <div class="col-md-6 col-xs-6">
                        <div class="booking-page-meta-info">
                                <label>MEMBERSHIP EXPIRATION:</label>
                        </div>
                    </div>
                    <div class="col-md-6 col-xs-6">
                        <div class="booking-page-meta-info">
                            <span>{{date('d-m-Y',strtotime($order_detail->expired_at))}}</span>
                        </div>
                    </div>

                    <div class="col-md-6 col-xs-6">
                        <div class="">
                            <label>PRICE:</label>
                        </div>
                    </div>
                    <div class="col-md-6 col-xs-6">
                        <div class="booking-page-meta-info">
                            <span>${{$odt['totprice_for_this']}}</span>
                        </div>
                    </div>

                    <div class="col-md-6 col-xs-6">
                        <div class="">
                            <label>TOTAL:</label>
                        </div>
                    </div>
                    <div class="col-md-6 col-xs-6">
                        <div class="booking-page-meta-info">
                            <span>${{$per_total}}</span>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="black-sparetor"></div>
                </div>
            @endforeach

            @php $idarry = rtrim($idarry,','); @endphp

            <input type="hidden" name="booking_id" id="booking_id" value="{{$order_detail->booking_id}}"> 
            <input type="hidden" name="orderdetalidary[]" id="orderdetalidary" value="{{$idarry}}"> 
            <div class="row border-xx mg-tp">
                <div class="col-md-6 col-xs-6">
                   <div class="total-titles">
                        <label>PAYMENT METHOD</label>
                   </div>
                </div>
                <div class="col-md-6 col-xs-6">
                    <div class="total-titles">
                        <span>{{ $odt['pmt_type']}}</span>
                    </div>
                </div>
            </div>

            <div class="row border-xx">
                <div class="col-md-6 col-xs-6">
                    <div class="total-titles">
                        <label>TIP AMOUNT</label>
                    </div>
                </div>
                <div class="col-md-6 col-xs-6">
                    <div class="total-titles">
                        <span>${{UserBookingDetail::where('booking_id', $orderId)->sum('tip')}}</span>
                    </div>
                </div>
            </div>

            <div class="row border-xx">
                <div class="col-md-6 col-xs-6">
                   <div class="total-titles">
                        <label>DISCOUNT</label>
                   </div>
                </div>
                <div class="col-md-6 col-xs-6">
                   <div class="total-titles">
                        <span>${{UserBookingDetail::where('booking_id', $orderId)->sum('discount')}}</span>
                   </div>
                </div>
            </div>

            <div class="row border-xx">
                <div class="col-md-6 col-xs-6">
                    <div class="total-titles">
                        <label>TAXES AND FEES</label>
                    </div>
                </div>
                <div class="col-md-6 col-xs-6">
                    <div class="total-titles">
                        <span>${{ (UserBookingDetail::where('booking_id', $orderId)->sum('tax') )}}</span>
                    </div>
                </div>
            </div>

            <div class="row border-xx">
                <div class="col-md-6 col-xs-6">
                    <div class="total-titles">
                        <label>MERCHANT FEE</label>
                    </div>
                </div>
                <div class="col-md-6 col-xs-6">
                    <div class="total-titles">
                        <span>${{ ($odt['amount'] - UserBookingDetail::where('booking_id', $orderId)->sum('subtotal') )}}</span>
                    </div>
                </div>
            </div>


            <div class="row border-xx">
                <div class="col-md-6 col-xs-6">
                    <div class="total-titles">
                        <label>TOTAL AMOUNT PAID</label>
                    </div>
                </div>
                <div class="col-md-6 col-xs-6">
                    <div class="total-titles">
                        <span>${{$odt['amount']}}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    function sendemail(){
        $('.reviewerro').html('');
        var email = $('#email').val();
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