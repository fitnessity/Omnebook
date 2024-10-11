
<?php /* print_r($calendarCart);*/ ?>

<form action="{{route('calendar.order.store')}}" method="POST" class="validation" data-cc-on-file="false"  data-stripe-publishable-key="{{ env('STRIPE_PKEY') }}" id="payment-form">
    @csrf
    <div class="row">
        <div class="col-lg-6 col-md-6 mmb-10 side-border-right-red">
           <div class="calendar-title-modal"> <label class="font-red">Step 3: </label> <label> Booking Summary & Pay</label> </div>
            <div class="program-selection">
                <label>Client Info:</label>
                <div class="row">
                    <div class="col-md-6 col-sm-6 col-xs-6 col-6">
                        <div class="sub-info-customer">
                            <label>Client Name</label>
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-6 col-xs-6 col-6">
                        <span>{{$customer->full_name}}</span>
                    </div>
                    
                    <div class="col-md-6 col-sm-6 col-xs-6 col-6">
                        <div class="sub-info-customer">
                            <label>Age</label>
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-6 col-xs-6 col-6">
                        <span>{{$customer->age}}</span>
                    </div>
                    
                    <div class="col-md-6 col-sm-6 col-xs-6 col-6">
                        <div class="sub-info-customer">
                            <label>Email</label>
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-6 col-xs-6 col-6">
                        <span class="break-word">{{$customer->email}}</span>
                    </div>
                    
                    <div class="col-md-6 col-sm-6 col-xs-6 col-6">
                        <div class="sub-info-customer">
                            <label>Phone number</label>
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-6 col-xs-6 col-6">
                        <span>{{$customer->phone_number}}</span>
                    </div>
                    
                    <div class="col-md-6 col-sm-6 col-xs-6 col-6">
                        <div class="sub-info-customer">
                            <label>Location</label>
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-6 col-xs-6 col-6">
                        <span>{{$customer->full_address()}}</span>
                    </div>
                </div>  
                <div class="booking-border-sparetor mb-10"></div>
                <label>Booking Details:</label>
                @php $grand_total = $subtotal  = $taxes = 0 ; @endphp
                @foreach($calendarCart as $i=>$cart)
                    @php 
                        $category = App\BusinessPriceDetailsAges::where('id',$cart['categoryid'])->first(); 
                        $priceOption = App\BusinessPriceDetails::where('id',$cart['priceid'])->first();
                        $price = 0;
                        if($cart['adult']){
                            $price+= $cart['adult']['price'];
                        }
                        if($cart['child']){
                            $price+= $cart['child']['price'];
                        }
                        if($cart['infant']){
                            $price+= $cart['infant']['price'];
                        }
                        if ($cart['image']!="") {
                            if (File::exists(public_path("/uploads/profile_pic/" . $cart['image']))) {
                                $profilePic = url('/public/uploads/profile_pic/' . $cart['image']);
                            } else {
                                $profilePic = url('/public/images/service-nofound.jpg');
                            }
                        }else{ 
                            $profilePic = url('/public/images/service-nofound.jpg');
                        }
                        $subtotal += $cart['totalprice'];
                        $taxes += $cart["tax"];
                        $total = $cart['totalprice'] + $cart["tax"];
                        $iprice = number_format($total,0, '.', '');
                    @endphp
                    <input type="hidden" name="itemid[]" value="<?= $cart["code"]; ?>" />
                    <input type="hidden" name="itemimage[]" value="<?= $profilePic ?>" />
                    <input type="hidden" name="itemname[]" value="<?= $cart["name"]; ?>" />
                    <input type="hidden" name="itemqty[]" value="1" />
                    <input type="hidden" name="itemprice[]" value="<?= $iprice * 100; ?>" />
               
                    <input type="hidden" name="itemparticipate[]" id="itemparticipate" value="" />
                     <div class="row">
                        <div class="col-md-12 col-sm-6 ">
                            <div class="boxes_arts">
                                <div class="headboxes">
                                    <img src="{{Storage::URL($cart['image'])}}" class="imgboxes" alt="">
                                    <h4 class="fontsize">{{$cart['name']}}</h4>
                                </div>
                                <div class="middleboxes middletoday" id="current_{{$i}}">
                                    <p>
                                        <span class="text-left">CATAGORY NAME:</span>
                                        <span class="text-right">{{$category->category_title}}</span>
                                    </p>
                                    <p>
                                        <span class="text-left">PRICE OPTION:</span>
                                        <span class="text-right">{{$priceOption->price_title}}</span>
                                    </p>
                                    <p>
                                        <span class="text-left">PARTICIPANTS:</span>
                                        <span class="text-rihgt">@if($cart['adult']) adult: {{$cart['adult']['quantity']}} @endif  @if($cart['child']) child: {{$cart['child']['quantity']}} @endif  @if($cart['infant']) infant: {{$cart['infant']['quantity']}} @endif</span>
                                    </p>
                                    <p>
                                        <span class="text-left">DATE:</span>
                                        <span class="text-rihgt">{{date('m-d-Y',strtotime($cart['sesdate']))}}</span>
                                    </p>
                                    <p>
                                        <span class="text-left">DURATION:</span>
                                        <span class="text-rihgt">{{$cart['actscheduleid']}}</span>
                                    </p>
                                    <p>
                                        <span class="text-left">BOOKING RECURRENCE:</span>
                                        <span class="text-rihgt"></span>
                                    </p>
                                    <p>
                                        <span class="text-left">PRICE:</span>
                                        <span class="text-rihgt"> ${{$price}}  </span>
                                    </p>
                                    <p>
                                        <span class="text-left">SERVICE FEE:</span>
                                        <span class="text-rihgt"> $0  </span>
                                    </p>
                                    <p>
                                        <span class="text-left">TAX:</span>
                                        <span class="text-rihgt"> ${{$cart['tax']}} </span>
                                    </p>
                                    <p>
                                        <span class="text-left">TOTAL:</span>
                                        <span class="text-rihgt"> ${{$cart['totalprice']}}  </span>
                                    </p>
                                </div>
                                <div class="foterboxes">
                                    <div class="viewmore_links">
                                        <a id="viewmore_current{{$i}}" style="display:block">View More <img src="{{url('/public/img/arrow-down.png')}}" alt=""></a>
                                        <a id="viewless_current{{$i}}" style="display:none">View Less <img src="{{url('/public/img/arrow-down.png')}}" alt=""></a>
                                    </div>
                                    <script>
                                        $("#viewmore_current{{$i}}").click(function () {
                                            $("#current_{{$i}}").addClass("intro");
                                            $("#viewless_current{{$i}}").show();
                                            $("#viewmore_current{{$i}}").hide();
                                        });
                                        $("#viewless_current{{$i}}").click(function () {
                                            $("#current_{{$i}}").removeClass("intro");
                                            $("#viewless_current{{$i}}").hide();
                                            $("#viewmore_current{{$i}}").show();
                                        });
                                    </script>
                                </div>
                            </div>
                        </div>
                    </div>  
                @endforeach
            </div>
        </div>
        @php 
            $grand_total = $subtotal + $taxes;
            $grand_total = number_format($grand_total, 2, '.', '');
        @endphp
        <input type="hidden" name="user_id" value="{{$customer->id}}">
        <input type="hidden" name="user_type" value="customer">

        <div class="col-lg-6 col-md-6 mmb-10">
            <div class="calendar-title-modal"> <label class="font-red">Step 4: </label> <label> Payment Information</label> </div>
            <div class="row">
                <div class="col-md-4 col-sm-4 col-xs-6">
                    <label class="pay-card" style="color:#000; background: #e9e9e9; margin-bottom: 15px;">
                    <input name="cardinfo" class="payment-radio" type="radio" value="cash" >
                        <span class="plan-details checkout-card">
                            <div class="row">
                               <div class="col-md-12 col-xs-12">
                                  <div class="payment-method-img">
                                      <img src="{{asset('/public/images/cash-icon.png')}}" alt="img" class="w-100" width="100">
                                  </div>
                               </div>
                               <div class="col-md-12 col-xs-12">
                                    <div class="cart-name checkout-cart">
                                        <span>Cash</span>
                                    </div>
                                    <div class="cart-num checkout-cart">
                                       <span></span>
                                    </div>
                               </div>
                            </div>
                       </span>
                    </label>
                </div>

                @if(@$customer)
                    @foreach($customer->stripePaymentMethods()->get() as $card) 
                        @php $brandname = ucfirst($card['brand']); @endphp
                        <div class="col-md-4 col-sm-4 col-xs-6">
                            <label class="pay-card" style="color:#000; background: #e9e9e9; margin-bottom: 15px;">
                            <input name="cardinfo" class="payment-radio" type="radio" value="cardonfile" data-card-last4="{{$card->last4}}" data-card-id="{{$card->payment_id}}">
                                <span class="plan-details checkout-card">
                                    <div class="row">
                                        <div class="col-md-12 col-xs-12">
                                            <div class="payment-method-img">
                                                <img src="{{asset('/public/images/cc-on-file.png')}}" alt="img" class="w-100" width="100">
                                            </div>
                                        </div>
                                        <div class="col-md-12 col-xs-12">
                                            <div class="cart-name checkout-cart">
                                               <span>CC (On File)</span>
                                             </div>
                                             <div class="cart-num checkout-cart">
                                                <span>{{$card->brand}} XXXX {{$card->last4}}</span>
                                             </div>
                                        </div>
                                    </div>
                               </span>
                           </label>
                        </div>
                    @endforeach
                @endif

                <div class="col-md-4 col-sm-4 col-xs-6">
                    <label class="pay-card" style="color:#000; background: #e9e9e9; margin-bottom: 15px;">
                    <input name="cardinfo" class="payment-radio" type="radio" value="newcard">
                        <span class="plan-details checkout-card">
                            <div class="row">
                                <div class="col-md-12 col-xs-12">
                                    <div class="payment-method-img">
                                        <img src="{{asset('/public/images/input-cc.png')}}" alt="img" class="w-100" width="100">
                                    </div>
                                </div>
                                <div class="col-md-12 col-xs-12">
                                    <div class="cart-name checkout-cart">
                                        <span>CC (Input Cart)</span>
                                    </div>
                                    <div class="cart-num checkout-cart">
                                        <span></span>
                                    </div>
                                </div>
                            </div>
                        </span>
                   </label>
                </div>

                <div class="col-md-4 col-sm-4 col-xs-6">
                    <label class="pay-card" style="color:#000; background: #e9e9e9; margin-bottom: 15px;">
                    <input name="cardinfo" class="payment-radio" type="radio" value="check">
                        <span class="plan-details checkout-card">
                            <div class="row">
                                <div class="col-md-12 col-xs-12">
                                    <div class="payment-method-img">
                                        <img src="{{asset('/public/images/check.png')}}" alt="img" class="w-100" width="100">
                                    </div>
                                </div>
                                <div class="col-md-12 col-xs-12">
                                    <div class="cart-name checkout-cart">
                                       <span>Check</span>
                                     </div>
                                </div>
                            </div>
                       </span>
                   </label>
                </div>
                
                <div class="col-md-4 col-sm-4 col-xs-6">
                    <label class="pay-card" style="color:#000; background: #e9e9e9; margin-bottom: 15px;">
                    <input name="cardinfo" class="payment-radio" type="radio"  value="comp">
                        <span class="plan-details checkout-card">
                            <div class="row">
                                <div class="col-md-12 col-xs-12">
                                    <div class="payment-method-img">
                                        <img src="{{asset('/public/images/comp.png')}}" alt="img" class="w-100" width="100">
                                    </div>
                                </div>
                                <div class="col-md-12 col-xs-12">
                                    <div class="cart-name checkout-cart">
                                       <span>Comp</span>
                                     </div>
                                </div>
                            </div>
                       </span>
                   </label>
                </div>

                <div class="col-md-12 col-xs-12">
                    <div class="check-client-info mathod-display">
                        <div class="payment-selection">
                            <h3>Payment Method Selected</h3>
                        </div>
                        <div id="addpmtmethods">
                            <div class="row" id="cashdiv" style="display: none;">
                                <div class="col-md-1 col-xs-1 col-sm-1">
                                    <div class="close-div">
                                        <div class="close-cross"> 
                                            <i class="fas fa-times"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3 col-xs-6 col-sm-3">
                                    <input type="text" class="form-control valid" id="cash_amt" name="cash_amt" placeholder="0.00"  value="0" data-behavior="calculateRemaining" onkeypress="return ( event.charCode == 46 || (event.charCode >= 48 && event.charCode <= 57 ))">
                                </div>
                                <div class="col-md-8 col-xs-4 col-sm-3">
                                    <label>Cash</label>
                                </div>
                                
                                <div class="col-md-12 col-xs-12">
                                    <div class="changecalce">
                                        <label>Change Calculator</label>
                                    </div>
                                </div>
                                <div class="col-md-5 col-sm-4 col-xs-12">
                                    <div class="cash-tend">
                                        <span>Cash tendered</span>
                                    </div>
                                </div>
                                <div class="col-md-3 col-sm-4 col-xs-6 nopadding">
                                    <input type="text" class="form-control valid" id="cash_amt_tender" name="cash_amt_tender" placeholder="0.00"  value="0" data-behavior="calculateChange" onkeypress="return ( event.charCode == 46 || (event.charCode >= 48 && event.charCode <= 57 ))">
                                </div>
                                <div class="col-md-2 col-sm-4 col-xs-6 nopadding">
                                    <div class="cash-tend-option">
                                        <span>(Optional)</span>
                                    </div>
                                </div>
                                <div class="col-md-5 col-sm-5 col-xs-12">
                                    <div class="cash-tend">
                                        <span>Cash Change:</span>
                                    </div>
                                </div>

                                <div class="col-md-2 col-sm-4 nopadding">
                                    <div class="cash-tend-option">
                                        <label id="cash_amt_change">$0.00</label>
                                    </div>
                                </div>

                                <div class="col-md-12 col-sm-12 col-xs-12">
                                    <div class="checkout-sapre-tor">
                                    </div>
                                </div>
                            </div>
                        
                            <div class="row" id="ccfilediv"  style="display: none;">
                                <div class="col-md-1">
                                    <div class="close-div">
                                        <div class="close-cross"> 
                                            <i class="fas fa-times"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <input type="text" class="form-control valid" id="cc_amt" name="cc_amt" placeholder="0.00" value="0" data-behavior="calculateRemaining" onkeypress="return ( event.charCode == 46 || (event.charCode >= 48 && event.charCode <= 57 ))">
                                </div>
                                <div class="col-md-8">
                                    <label>CC(Key/Stored)</label>
                                </div>
                                
                                <div class="col-md-12">
                                    <div class="options-payment">
                                        <input type="radio" id="html" name="fav_language" value="" checked>
                                        <span id="use_billing_info">Use billing information on file.</span><br>
                                        <span class="visa-info"></span><br>
                                    </div>
                                </div>
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                    <div class="checkout-sapre-tor">
                                    </div>
                                </div>
                            </div>  

                            <div id="ccnewdiv"  class="row" style="display: none;"> 
                                <div class="col-md-1 col-sm-1 col-xs-2">
                                    <div class="close-div">
                                        <div class="close-cross"> 
                                            <i class="fas fa-times"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3 col-sm-4 col-xs-10">
                                    <input type="text" class="form-control valid" id="cc_new_card_amt" name="cc_new_card_amt" placeholder="0.00" value="0" data-behavior="calculateRemaining" onkeypress="return ( event.charCode == 46 || (event.charCode >= 48 && event.charCode <= 57 ))">
                                </div>
                                <div class="col-md-8 col-sm-4 col-xs-12">
                                    <label>CC(Input Card)</label>
                                </div>
                                <div class="col-md-12 col-xs-12">
                                    <div class="row" >
                                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                                            <div id="payment-element" style="margin-top: 8px;">
                                                
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12 col-xs-12">
                                            
                                            <div class="save-pmt-checkbox">
                                                <input type="checkbox" id="save_card" name="save_card" value="1" checked>
                                                <input type="hidden" id="new_card_payment_method_id" name="new_card_payment_method_id" value="">
                                                
                                                <label>Save for future payments</label>
                                            </div>
                                        </div>
                                        
                                    </div> 
                                    
                                </div>
                            </div>

                            <div class="row" id="checkdiv"  style="display: none;">
                                <div class="col-md-1 col-sm-1 col-xs-2">
                                    <div class="close-div">
                                        <div class="close-cross"> 
                                            <i class="fas fa-times"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3 col-sm-4 col-xs-6">
                                    <input type="text" class="form-control valid" id="check_amt" name="check_amt" placeholder="0.00" value="0" data-behavior="calculateRemaining" onkeypress="return ( event.charCode == 46 || (event.charCode >= 48 && event.charCode <= 57 ))">
                                </div>
                                <div class="col-md-8 col-sm-4 col-xs-2">
                                    <label>Check</label>
                                </div>
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                    <div class="">
                                        <div class="cash-tend">
                                            <input type="text" class="form-control valid" id="check_number" name="check_number" placeholder="check#" >
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                    <div class="checkout-sapre-tor">
                                    </div>
                                </div>
                            </div>  
                            <div class='form-row row'>
                                <div class='col-md-12 form-group d-none'>
                                    <div class='alert-danger alert'>Fix the errors before you begin.</div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

                @if (session('stripeErrorMsg'))
                    <div class="col-md-12">
                        <div class='form-row row'>
                            <div class='col-md-12  error form-group'>
                                <div class="alert-danger alert">
                                    {{ session('stripeErrorMsg') }}
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
                <input type="hidden" name="grand_total" id="grand_total" value="{{$grand_total}}">
                <input type="hidden" name="cash_change" id="cash_change" value="">
                <input type="hidden" name="card_id" id="card_id" value="">

                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                    <button type="button" class="btn btn-red mb-10" id="total_remaing">Total Amount Remaining ${{$grand_total}}</button>
                </div>

                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                    <div class="btn-ord-txt" style="float: right;">
                        <button class="btn btn-black" type="submit" id="checkout-button"style="margin-top: 0px;">Complete Payment</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>

<script type="text/javascript">
    $(function() {
        stripe = Stripe('{{ env("STRIPE_PKEY") }}');    
        const client_secret = '{{$intent ? $intent->client_secret : null}}';
        const options = {
          clientSecret: client_secret,
          // Fully customizable with appearance API.
          appearance: {/*...*/},
        };
        const elements = stripe.elements(options);
        const paymentElement = elements.create('payment');

        paymentElement.mount('#payment-element');

        var $form = $(".validation");
        $('form.validation').bind('submit', function(e) {
            e.preventDefault()
            var $form = $(this);
            $('.error').addClass('hide').find('.alert').text('');
            $('#checkout-button').html('loading...').prop('disabled', true);
            let cash_amt = $('#cash_amt').val();
            let cc_amt = $('#cc_amt').val();
            let cc_new_card_amt = $('#cc_new_card_amt').val();
            let check_amt = $('#check_amt').val();

            var cardinfoRadio = $('input[name=cardinfo]:checked', '#payment-form').val();

            if(cash_amt <= 0 && cc_amt <=0 && cc_new_card_amt <=0 && check_amt <=0 && cardinfoRadio!= 'comp'){
                $('.error').removeClass('hide').find('.alert').text('Choose payment method first');
                $('#checkout-button').html('Complete Payment').prop('disabled', false);
                return false;
            }

            if(cc_new_card_amt > 0) {
                var $form  = $(".validation"),
                    inputVal = ['input[type=email]', 'input[type=password]',
                                     'input[type=text]', 'input[type=file]',
                                     'textarea'].join(', '),
                    $inputs       = $form.find('.required').find(inputVal),
                    $errorStatus = $form.find('div.error'),
                    valid         = true;
                    $errorStatus.addClass('hide');
                $('.has-error').removeClass('has-error');
                $inputs.each(function(i, el) {
                    var $input = $(el);
                    if ($input.val() === '') {
                        $input.parent().addClass('has-error');
                        $errorStatus.removeClass('hide');
                        e.preventDefault();
                    }
                });

                stripe.confirmSetup({
                  elements,
                  redirect: 'if_required',
                  confirmParams: {
                  }
                }).then(function(result){
                    if (result.error) {
                        $('.error').removeClass('hide').find('.alert').text(result.error.message);
                        $('#checkout-button').html('Complete Payment').prop('disabled', false);
                        return false;
                    }else{
                        $.ajax({
                            url: '{{route('business.customers.refresh_payment_methods', ['business_id'=> $business_id,'customer_id' => $customer->id])}}',
                            success: function(data){
                                console.log(data)
                                console.log('success')
                            }
                        })
                        $('#new_card_payment_method_id').val(result.setupIntent.payment_method)
                        $form.off('submit');

                        $form.submit();
                    }
                }); 
            }else{
                $form.off('submit');
                $form.submit();
            }
        });
    });
</script>

<script>
    $('input[type=radio][name=cardinfo]').change(function() {

        if (this.value == 'cash') {
            if($('#check_amt').is(":hidden") && $('#ccfilediv').is(":hidden") && $('#ccnewdiv').is(":hidden")) {
                $('#cash_amt').val('{{$grand_total}}');
            }

            $('#cashdiv').show();
        }else if(this.value == 'check'){
            if($('#cashdiv').is(":hidden") && $('#ccfilediv').is(":hidden") && $('#ccnewdiv').is(":hidden")) {
                $('#check_amt').val('{{$grand_total}}');
            }

            $('#checkdiv').show();
        }else if(this.value == 'newcard'){
            if($('#cashdiv').is(":hidden") && $('#ccfilediv').is(":hidden") && $('#checkdiv').is(":hidden")) {
                $('#cc_new_card_amt').val('{{$grand_total}}');
            }
            
            $('#ccnewdiv').show();
        }else if(this.value == 'cardonfile'){
            if($('#cashdiv').is(":hidden") && $('#ccnewdiv').is(":hidden") && $('#checkdiv').is(":hidden")) {
                $('#cc_amt').val('{{$grand_total}}');
            }


            $('#use_billing_info').html('Use xxxx xxxx xxxx' + $(this).data('card-last4') + ' on file.')
            $('#card_id').val($(this).data('card-id'))
            $('#ccfilediv').show();
        }

        if (this.value == 'comp') {
            $('#cash_amt').val(0);
            $('#check_amt').val(0);
            $('#cc_amt').val(0);
            $('#cc_new_card_amt').val(0);
            $('#cashdiv').hide();
            $('#checkdiv').hide();
            $('#ccfilediv').hide();
            $('#ccnewdiv').hide();
        }
        calculateTotalRemaining();
    });

    $(document).on("keyup", '[data-behavior=calculateRemaining]', calculateTotalRemaining)

    $(document).on("keyup", '[data-behavior=calculateChange]', function(e){
        let cash_amt = $('#cash_amt').val();
        let cash_amt_tender = $('#cash_amt_tender').val()
        $('#cash_change').val(parseFloat(cash_amt - cash_amt_tender).toFixed(2));
        $('#cash_amt_change').html(parseFloat(cash_amt - cash_amt_tender).toFixed(2));
        let total_remaing = 0;
        if(cash_amt_tender < cash_amt){
            total_remaing = Math.abs(parseFloat(cash_amt - cash_amt_tender).toFixed(2));
        }
        $('#total_remaing').html('Total Amount Remaining $' +  total_remaing);
    })
    
    function calculateTotalRemaining() {
        let total = $('#grand_total').val();

        let cash_amt = $('#cash_amt').val();
        let cc_amt = $('#cc_amt').val();
        let cc_new_card_amt = $('#cc_new_card_amt').val();
        let check_amt = $('#check_amt').val();
        $('#total_remaing').html('Total Amount Remaining $' + parseFloat(total - cash_amt - cc_amt - cc_new_card_amt - check_amt).toFixed(2));
    }

    $('.close-div').click(function() {
        var name = $(this).parent('div').parent('div').attr('id');
        $("#"+name).css('display','none');
        if(name == 'cashdiv'){
            $('#cash_amt_tender').val(0);
            $('#cash_amt').val(0);
            $('#cash_amt_change').html('$0.00');
        }else if(name == 'ccfilediv'){
            $('#cc_amt').val(0);
            $('#card_id').val('');
        }else if(name == 'ccnewdiv'){
            $('#cc_new_card_amt').val(0);
        }else if(name == 'checkdiv'){
            $('#check_amt').val(0);
        }
        
        calculateTotalRemaining();
    });
</script>
