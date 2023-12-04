<form action="{{route('choose-plan.store')}}" method="POST" class="validation" data-cc-on-file="false"  data-stripe-publishable-key="{{ env('STRIPE_PKEY') }}" id="payment-form">
    @csrf
    <input type="hidden" name="plan" value="{{$request->id}}">
    <input type="hidden" name="type" value="{{$request->type}}">
    <input type="hidden" name="total" id="total" value="{{$total}}">
    <input type="hidden" name="price" id="price" value="{{$total}}">
    <input type="hidden" name="discount" id="discount" value="0">
    <input type="hidden" name="promo_code_id" id="promo_code_id" value="">
    <input type="hidden" name="promo_code_name" id="promo_code_name" value="">
    <div class="card">
        <div class="card-header border-bottom-dashed">
            <div class="row"> 
                <div class="col-md-7">
                    <h5 class="card-title mb-0 fs-17">Payment Selection</h5>
                </div>
                <div class="col-md-5">
                    <h5 class="card-title mb-0 fs-17 font-red float-right" id="ph5">Price: ${{$total}}</h5>
                    <h5 class="card-title mb-0 fs-17 font-red float-right" id="dis5">Discount: $0</h5>
                    <h5 class="card-title mb-0 fs-17 font-red float-right" id="totalPrice">Total: ${{$total}}</h5>
                </div>
            </div>
        </div>

        <div class="card-body pt-2">
            <label>Have a Promo Code?</label>
            <div class="row">
                <div class="col-md-8">
                    <input type="text" name="promoCode" id="promoCode" value="" class="form-control" placeholder="Enter Promo Code.">
                </div>
                <div class="col-md-2">
                    <button type="button" class="btn btn-red applyCode mb-10">Apply</button>
                </div>
                <div class='col-md-12 form-group promo-error-parent-div'>
                    <div class='font-red fs-14 promo-error'> </div>
                </div>
            </div>

            <div class="row"> 
                <div class="col-6">
                    <label class="fs-15 mt-10">Saved Cards</label>
                </div>
            </div> 

            <div class="row">
                @foreach($cardInfo as $card) 
                    @php $brandname = strtolower($card['brand']); @endphp
                    <div class="col-md-6">
                        <label class="pay-card" style="color:#ffffff; background-image: url(/public/img/visa-card-bg.jpg );">
                            <input name="cardinfo" class="payment-radio" type="radio" value="{{$card['payment_id']}}">
                            <span class="plan-details">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="cart-name">
                                            <span>{{$brandname}}</span>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="cart-num">
                                            <span>XXXX XXXX XXXX {{$card['last4']}}</span>
                                        </div>
                                    </div>
                                </div>
                            </span>
                        </label>
                    </div>
                @endforeach
            </div>
        
            <div class="row">
                <div class="col-lg-12">
                    <div class="sacecard-title fs-14 mt-15">OTHER PAYMENT METHODS </div>
                    <button class="card-btns fs-14 font-black mt-15" type="button">Credit / Debit Card</button>
                </div>
              
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                    <div id="payment-element" class="mt-10"></div>
                </div>
          
                <div class="col-md-12 col-xs-12">
                    <div class="save-pmt-checkbox mt-15">
                        <input type="checkbox" id="save_card" name="save_card" value="1" checked>
                        <input type="hidden" id="new_card_payment_method_id" name="new_card_payment_method_id" value="">
                        <label class="fs-14">Save For Future Payments</label>
                    </div>
                    <div class='form-row row'>
                        <div class='col-md-12 hide error form-group'>
                            <div class='alert-danger alert '>Fix the errors before you begin.</div>
                        </div>
                    </div>
                </div>
                @if (session('stripeErrorMsg'))
                    <div class='form-row row'>
                        <div class='col-md-12 error form-group'>
                            <div class='alert-danger alert'> {{ session('stripeErrorMsg') }}</div>
                        </div>
                    </div>
                @endif
                <div class="text-end mb-4">
                    <button class="btn btn-cart-checkout btn-label right ms-auto" type="submit"  id="checkout-button">
                        <i class="fas fa-arrow-right label-icon align-bottom fs-16 ms-2"></i>Submit
                    </button>
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
            var cardinfoRadio = document.querySelector( 'input[name="cardinfo"]:checked');
            var save_cardRadio = document.querySelector( 'input[name="save_card"]:checked');
      
            if(save_cardRadio == null) {
                $('#save_card').val(0);
            }else{
                $('#save_card').val(1);
            }
         
           if(cardinfoRadio == null) {
                var $form  = $(".validation"),
                inputVal = ['input[type=email]', 'input[type=password]','input[type=text]', 'input[type=file]','textarea'].join(', '),
                $inputs       = $form.find('.required').find(inputVal),
                $errorStatus  = $form.find('div.error'),
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
                    onfirmParams: {
                    }
                }).then(function(result){
                    if (result.error) {
                        $('.error').removeClass('hide').find('.alert').text(result.error.message);
                        $('#checkout-button').html('<i class="fas fa-arrow-right label-icon align-bottom fs-16 ms-2"></i>Check Out').prop('disabled', false);
                        return false;
                    }else{
                        console.log(result)
                        $.ajax({
                            url: '{{route('refresh_payment_methods', ['user_id' => $user->id])}}',
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

        $('.applyCode').click(function(e){
            var pCode = $('#promoCode').val();
            var price = $('#price').val();
            if(pCode){
                $.ajax({
                    url: "{{route('choose-plan.checkPromoCode')}}",
                    type: 'POST',
                    dataType: 'json', 
                    data: {
                        _token:'{{csrf_token()}}',
                        pCode: pCode,
                        price: price,
                    },
                    success: function(response){
                        if(response.status === 'not'){
                            $('.promo-error-parent-div').removeClass('hide');
                            $('.promo-error').html('Promo Code Is Not Available');
                        }else{
                            $('.promo-error-parent-div').addClass('hide');
                            $('#totalPrice').html('Total: $'+response.totalAfterDiscount)
                            $('#ph5').html('Price: $'+price)
                            $('#dis5').html('Discount: $'+response.dis)
                            $('#total').val(response.totalAfterDiscount)
                            $('#discount').val(response.dis)
                            $('#promo_code_name').val(response.pCodeName)
                            $('#promo_code_id').val(response.pCodeId)
                        }
                    }
                })
            }else{
                $('.promo-error-parent-div').removeClass('hide');
                $('.promo-error').html('Please Enter Code.');
                updateDetail();
            }
        })
    
        function stripeHandleResponse(status, response) {
            if (response.error) {
                $('.error').removeClass('hide').find('.alert').text(response.error.message);
            } else {
                var token = response['id'];
                $form.find('input[type=text]').empty();
                $form.append("<input type='hidden' name='stripeToken' value='" + token + "'/>");
                $form.get(0).submit();
            }
            $('#checkout-button').html('Check Out').prop('disabled', false);
        }
    });

    $(document).ready(function() {
        $('#promoCode').on('input', function() {
            var pCode = $('#promoCode').val();
            if (pCode === '') {
                updateDetail();
            }
        });
    });

    function updateDetail() {
        var price = $('#price').val();
        $('#totalPrice').html('Total: $'+price)
        $('#ph5').html('Price: $'+price)
        $('#dis5').html('Discount: $0')
        $('#total').val(price)
        $('#discount').val(0)
        $('#promo_code_name').val('')
        $('#promo_code_id').val('')
    }
</script>

