<form action="{{route('business.subscription.update-card')}}" method="POST" class="validation" data-cc-on-file="false"  data-stripe-publishable-key="{{ env('STRIPE_PKEY') }}" id="payment-form">
    @csrf

    <div class="card">
        <div class="card-body pt-2">
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
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                    <div id="payment-element" class="mt-10"></div>
                </div>
        
                @if (session('stripeErrorMsg'))
                    <div class='form-row row'>
                        <div class='col-md-12 error form-group'>
                            <div class='alert-danger alert'> {{ session('stripeErrorMsg') }}</div>
                        </div>
                    </div>
                @endif
                <div class="text-end mb-4">
                    <button class="btn btn-cart-checkout" type="submit"  id="submitbtn">Submit </button>
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

            $('#submitbtn').html('loading...').prop('disabled', true);
            var cardinfoRadio = document.querySelector( 'input[name="cardinfo"]:checked');
         
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
                        $('#submitbtn').prop('disabled', false);
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

                        $form.off('submit');
                        $form.submit();
                    }
                });
            }else{
                $form.off('submit');
                $form.submit();
            }
        });

        function stripeHandleResponse(status, response) {
            if (response.error) {
                $('.error').removeClass('hide').find('.alert').text(response.error.message);
            } else {
                var token = response['id'];
                $form.find('input[type=text]').empty();
                $form.append("<input type='hidden' name='stripeToken' value='" + token + "'/>");
                $form.get(0).submit();
            }
            $('#submitbtn').html('Submit').prop('disabled', false);
        }
    });

</script>

