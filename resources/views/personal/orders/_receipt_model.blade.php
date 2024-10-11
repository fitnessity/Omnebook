<div class="row"> 
    <div class="col-lg-4 bg-sidebar">
       <div class="your-booking-page side-part">
            <figure>
                <img src="{{$odt['com_pic']}}" alt="Fitnessity">
            </figure>
            <div class="booking-page-meta">
                <a href="#" title="" class="underline">{{$odt['company_name']}}</a>
            </div>
            <div class="box-subtitle">
                <h4>Transaction Complete</h4>
                <div class="modal-inner-box">
                    <label>{{$odt['nameofbookedby']}}</label>
                    <h3>Email Receipt</h3>
                    <div class="form-group">
                        <input type="text" name="email" id="email"  placeholder="youremail@abc.com" class="form-control">
                    </div>
                    <button class="submit-btn btn-modal-booking" 
                    onclick="sendemail({{$odt['order_id']}} ,{{ $odt['booking_id']}});">Send Email Receipt</button>
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
            <div class="">
                <div class="row">
                    <div class="col-md-6 col-xs-6">
                        <div class="booking-page-meta-info">
                            <label>BOOKING#</label>
                        </div>
                    </div>
                    <div class="col-md-6 col-xs-6">
                        <div class="booking-page-meta-info">
                            <span>{{ $odt['confirm_id'] }}</span>
                        </div>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-md-6 col-xs-6">
                        <div class="booking-page-meta-info">
                            <label>TOTAL PRICE:</label>
                        </div>
                    </div>
                    <div class="col-md-6 col-xs-6">
                        <div class="booking-page-meta-info">
                            <span>${{$odt['totprice_for_this']}}</span>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 col-xs-6">
                        <div class="booking-page-meta-info">
                            <label>PRICE OPTION:</label>
                        </div>
                    </div>
                    <div class="col-md-6 col-xs-6">
                        <div class="booking-page-meta-info">
                            <span>{{$odt['price_opt']}}</span>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 col-xs-6">
                        <div class="booking-page-meta-info">
                            <label>TOTAL REMAINNIG:</label>
                        </div>
                    </div>
                    <div class="col-md-6 col-xs-6">
                        <div class="booking-page-meta-info">
                            <span>{{ $odt['to_rem']}}</span>
                        </div>
                    </div>
                </div>

                <div class="row">
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
                </div>

                <div class="row">
                    <div class="col-md-6 col-xs-6">
                        <div class="booking-page-meta-info">
                            <label>EXPIRATION DATE:</label>
                        </div>
                    </div>
                    <div class="col-md-6 col-xs-6">
                        <div class="booking-page-meta-info">
                            <span>{{ $odt['end_activity_date']}}</span>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 col-xs-6">
                        <div class="booking-page-meta-info">
                            <label>DATE BOOKED:</label>
                        </div>
                    </div>
                    <div class="col-md-6 col-xs-6">
                        <div class="booking-page-meta-info">
                            <span>{{ $odt['created_at']}}</span>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 col-xs-6">
                        <div class="booking-page-meta-info">
                            <label>RESERVED DATE:</label>
                        </div>
                    </div>
                    <div class="col-md-6 col-xs-6">
                        <div class="booking-page-meta-info">
                            <span>{{ $odt['created_at']}}</span>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 col-xs-6">
                        <div class="booking-page-meta-info">
                            <label>BOOKED BY:</label>
                        </div>
                    </div>
                    <div class="col-md-6 col-xs-6">
                        <div class="booking-page-meta-info">
                            <span>{{ $odt['nameofbookedby']}}</span>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 col-xs-6">
                        <div class="booking-page-meta-info">
                            <label>CHECK IN DATE:</label>
                        </div>
                    </div>
                    <div class="col-md-6 col-xs-6">
                        <div class="booking-page-meta-info">
                            <span>{{@$book_details->getReserveData('reserve_date')}}</span>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 col-xs-6">
                        <div class="booking-page-meta-info">
                            <label>CHECK IN TIME:</label>
                        </div>
                    </div>
                    <div class="col-md-6 col-xs-6">
                        <div class="booking-page-meta-info">
                            <span>{{ $odt['shift_start']}}</span>
                        </div>
                    </div>
                </div>

                <div class="row">
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
                </div>

                <div class="row">
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
                </div>

                <div class="row">
                    <div class="col-md-6 col-xs-6">
                        <div class="booking-page-meta-info">
                            <label>ACTIVITY LOCATION:</label>
                        </div>
                    </div>
                    <div class="col-md-6 col-xs-6">
                        <div class="booking-page-meta-info">
                            <span>{{ $odt['activity_location']}}</span>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 col-xs-6">
                        <div class="booking-page-meta-info">
                            <label>ACTIVITY DURATION:</label>
                        </div>
                    </div>
                    <div class="col-md-6 col-xs-6">
                        <div class="booking-page-meta-info">
                            <span>{{ $odt['time']}}</span>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 col-xs-6">
                        <div class="booking-page-meta-info">
                            <label>GREAT FOR:</label>
                        </div>
                    </div>
                    <div class="col-md-6 col-xs-6">
                        <div class="booking-page-meta-info">
                            <span>{{ $odt['activity_for']}}</span>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 col-xs-6">
                        <div class="booking-page-meta-info">
                            <label>PARTICIPANTS#</label>
                        </div>
                    </div>
                    <div class="col-md-6 col-xs-6">
                        <div class="booking-page-meta-info">
                            <span>{!! $odt['qty'] !!}</span>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 col-xs-6">
                        <div class="booking-page-meta-info">
                            <label>WHO IS PRATICIPATING?</label>
                        </div>
                    </div>
                    <div class="col-md-6 col-xs-6">
                        <div class="booking-page-meta-info">
                            <span>{!! $odt['parti_data'] !!}</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row border-xx mg-tp">
                <div class="col-md-6 col-xs-6">
                    <div class="total-titles">
                        <label>Payment Type</label>
                    </div>
                    
                </div>
                <div class="col-md-6 col-xs-6">
                    <div class="total-titles">
                        <span>{{$odt['last4']}}</span>
                    </div>
                </div>
            </div>
            <div class="row border-xx">
                <div class="col-md-6 col-xs-6">
                    <div class="total-titles">
                        <label>Sub-total</label>
                    </div>
                    
                </div>
                <div class="col-md-6 col-xs-6">
                    <div class="total-titles">
                        <span>${{$odt['totprice_for_this']}}</span>
                    </div>
                </div>
                
            </div>
            <div class="row border-xx">
                <div class="col-md-6 col-xs-6">
                    <div class="total-titles">
                        <label>Taxes & Service Fees</label>
                    </div>
                </div>
                <div class="col-md-6 col-xs-6">
                    <div class="total-titles">
                        <span>${{$odt['tax_for_this']}}</span>
                    </div>
                </div>
            </div>
            <div class="row border-xx">
                <div class="col-md-6 col-xs-6">
                    <div class="total-titles">
                        <label>Grand Total</label>
                    </div>
                </div>
                <div class="col-md-6 col-xs-6">
                    <div class="total-titles">
                        <span>${{$odt['main_total']}}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function valid(email)
    {
        var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
        return emailReg.test(email); //this will either return true or false based on validation
    }

    function sendemail(odetailid,oid){
        $('.reviewerro').html('');
        var email = $('#email').val();
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
                url: "{{route('sendemailofreceipt')}}",
                xhrFields: {
                    withCredentials: true
                },
                type: 'get',
                data:{
                    odetailid:odetailid,
                    oid:oid,
                    email:email,
                },
                success: function (response) {
                    $('.reviewerro').html('');
                    $('.reviewerro').css('display','block');
                    if(response == 'success'){
                        $('.reviewerro').html('Email Successfully Sent..');
                    }else{
                        $('.reviewerro').html("Can't Mail on this Address. Plese Check your Email..");
                    }
                }
            });
        }
    }
</script>
