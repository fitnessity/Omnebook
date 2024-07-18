<div class="row y-middle">
    <div class="col-lg-12 col-md-12 col-12">
        <div class="mb-15">
            <span class="text-center">Payment for ${{ request()->price }}</span>
        </div>
    </div>
</div>


<form id="payment-form" data-secret="{{ $intent['client_secret'] }}" style="padding: 16px;margin-bottom: 0px;"
    action="{{ route('checkin.autopay_payment') }}" method="POST" class="validation" data-cc-on-file="false"
    data-stripe-publishable-key="{{ env('STRIPE_PKEY') }}">
    @csrf
    <div class="card-body pt-2">
        <div class="row">
            @foreach ($cardInfo as $card)
                @php $brandname = strtolower($card['brand']); @endphp
                <div class="col-md-6">
                    <label class="pay-card"
                        style="color:#ffffff; background-image: url(/public/img/visa-card-bg.jpg );">
                        <input name="cardinfo" class="payment-radio" type="radio" value="{{ $card['payment_id'] }}">
                        <span class="plan-details">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="cart-name">
                                        <span>{{ $brandname }}</span>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="cart-num">
                                        <span>XXXX XXXX XXXX {{ $card['last4'] }}</span>
                                    </div>
                                </div>
                            </div>
                        </span>
                    </label>
                </div>
            @endforeach
        </div>
    </div>

    <input type="hidden" id="price" name="price" value="{{ request()->price }}">
    <input type="hidden" id="customerId" name="customerId" value="{{ request()->customer_id }}">
    <input type="hidden" id="url" name="url" value="{{ request()->return_url }}">
    <input type="hidden" id="id" name="id" value="{{ request()->rid }}">
    <input type="hidden" id="new_card_payment_method_id" name="new_card_payment_method_id" value="">
    <div id="payment-element" style="margin-top: 8px;"></div>
    <div id="error-message" class="alert alert-danger mt-10" role="alert" style="display: none;"></div>
    <div class="text-center mt-10"><button class="btn btn-red align-center" type="submit"
            id="submit-button">Pay</button></div>

    <div id="messages" role="alert" style="display: none;" class="text-center font-green mt-10"></div>
</form>
<audio id="success-sound" src="{{ asset('music/success.mp3') }}" preload="auto"></audio>
<audio id="failure-sound" src="{{ asset('music/failure.mp3') }}" preload="auto"></audio>

@php
    $company_data = Auth::user()->current_company;
    $playSoundValues = [];
    
    if (!empty($company_data)) {
        $data = App\BusinessCheckinSettings::where('business_id', $company_data->id)->first();
        if ($data) {
            $playSoundValues = explode(',', $data->play_sound);
        }
    }
@endphp
<script>
    var playSoundValues = @json($playSoundValues);
</script>
<script type="text/javascript">
    $(function() {
        stripe = Stripe('{{ env('STRIPE_PKEY') }}');
        const client_secret = '{{ $intent ? $intent->client_secret : null }}';
        const options = {
            clientSecret: client_secret,
            // Fully customizable with appearance API.
            appearance: {
                /*...*/ },
        };
        const elements = stripe.elements(options);
        const paymentElement = elements.create('payment');

        paymentElement.mount('#payment-element');

        var $form = $(".validation");

        $('form.validation').bind('submit', function(e) {
            e.preventDefault()
            var $form = $(this);
            $('.error').addClass('hide').find('.alert').text('');
            $('#error_check').addClass('d-none');
            $('#submit-button').html('loading...').prop('disabled', true);

            var cardinfoRadio = document.querySelector('input[name="cardinfo"]:checked');
            var save_cardRadio = document.querySelector('input[name="save_card"]:checked');

            if (save_cardRadio == null) {
                $('#save_card').val(0);
            } else {
                $('#save_card').val(1);
            }

            if (cardinfoRadio == null) {
                var $form = $(".validation"),
                    inputVal = ['input[type=email]', 'input[type=password]',
                        'input[type=text]', 'input[type=file]',
                        'textarea'
                    ].join(', '),
                    $inputs = $form.find('.required').find(inputVal),
                    $errorStatus = $form.find('div.error'),
                    valid = true;
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
                    confirmParams: {}
                }).then(function(result) {
                    if (result.error) {
                        $('.error').removeClass('hide').find('.alert').text(result.error
                            .message);
                        $('#submit-button').html('Pay').prop('disabled', false);
                        return false;
                    } else {
                        $('#new_card_payment_method_id').val(result.setupIntent.payment_method)
                        $.ajax({
                            url: $form.attr('action'),
                            method: 'POST',
                            data: $form.serialize(),
                            success: function(response) {
                                $('#messages').text('Payment successfully done!')
                                    .show();
                                $('#submit-button').html('Pay');
                                // var successSound = document.getElementById('success-sound');
                                // successSound.play();
                                if (playSoundValues.includes('success') && !playSoundValues.includes('none')) {
                                    var successSound = document.getElementById('success-sound');
                                    successSound.play();
                                }
                                setTimeout(function() {
                                    window.location.reload();
                                }, 2000);
                            },
                            error: function(xhr) {
                                // var successSound = document.getElementById('success-sound');
                                // successSound.play();
                                if (playSoundValues.includes('fail') && !playSoundValues.includes('none')) {
                                    var failuresound = document.getElementById('failure-sound');
                                    failuresound.play();
                                }
                                const errorResponse = xhr.responseJSON;
                                $('#error-message').text(errorResponse.error ||
                                    'An error occurred while processing the payment.'
                                    ).show();
                                $('#submit-button').html('Pay').prop('disabled',
                                    false);
                            }
                        });

                        /* $form.off('submit');
                         $form.submit();*/
                    }
                });
            } else {
                /*$form.off('submit');
                $form.submit();*/

                $.ajax({
                    url: $form.attr('action'),
                    method: 'POST',
                    data: $form.serialize(),
                    success: function(response) {
                        $('#submit-button').html('Pay');
                        $('#messages').text('Payment successfully done!').show();
                        // var successSound = document.getElementById('success-sound');
                        // successSound.play();
                        if (playSoundValues.includes('success') && !playSoundValues.includes('none')) {
                            var successSound = document.getElementById('success-sound');
                            successSound.play();
                        }
                        setTimeout(function() {
                            window.location.reload();
                        }, 2000);
                    },
                    error: function(xhr) {
                        // var successSound = document.getElementById('success-sound');
                        // successSound.play();
                        if (playSoundValues.includes('fail')) {
                            var failuresound = document.getElementById('failure-sound');
                            failuresound.play();
                        }
                        const errorResponse = xhr.responseJSON;
                        $('#error-message').text(errorResponse.error ||
                            'An error occurred while processing the payment.').show();
                        $('#submit-button').html('Pay').prop('disabled', false);
                    }
                });

            }
        });

        function stripeHandleResponse(status, response) {
            if (response.error) {
                $('.error')
                    .removeClass('hide')
                    .find('.alert')
                    .text(response.error.message);
            } else {
                var token = response['id'];
                $form.find('input[type=text]').empty();
                $form.append("<input type='hidden' name='stripeToken' value='" + token + "'/>");
                $form.get(0).submit();
            }
            $('#submit-button').html('Pay').prop('disabled', false);
        }
    });
</script>
