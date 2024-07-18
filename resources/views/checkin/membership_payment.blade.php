<div class="row">
	<div class="card">
		<div class="col-md-12 col-sm-12 col-xs-12">
			<h5 class="text-center font-red fs-20">Order Summary</h5>
		</div>

		<div class="card-header border-bottom-dashed">
			<h5 class="card-title mb-0 fs-17">Order Summary</h5>
		</div>
		<div class="card-body pt-2">
			<div class="row">	
				<div class="col-6">
					<label class="fs-15">Bookings</label>
				</div>
				<div class="col-6">
					<span class="fs-15 float-end">{{$cartCount}}</span>
				</div>
				<div class="col-6">
					<label class="fs-15">Subtotal</label>
				</div>
				<div class="col-6">
					<span class="fs-15 float-end">${{$subTotal}}</span>
				</div>
				<div class="col-6">
					<label class="fs-15">Taxes & Fees: </label>
				</div>
				<div class="col-6">
					<span class="fs-15 float-end">${{$taxDisplay}}</span>
				</div>
				<div class="col-lg-12 col-12">
					<div class="border-wid-grey"></div>
				</div>
				<div class="col-6">
					<label class="fs-15">Grand Total:</label>
				</div>
				<div class="col-6">
					<label class="fs-15 float-end">${{$total_amount}}</label>
				</div>
				<div class="col-lg-12 col-12">
					<div class="border-wid-grey"></div>
				</div>
			</div>
		</div>
	</div>


	<form id="payment-form" data-secret="{{$intent['client_secret']}}" style="padding: 16px;margin-bottom: 0px;" action="{{route('checkin.memberhsipPay')}}" method="POST" class="validation" data-cc-on-file="false"  data-stripe-publishable-key="{{ env('STRIPE_PKEY') }}" >
		@csrf
		<input type="hidden" name="grand_total" id="total_amount" value="{{$total_amount}}">
		<input type="hidden" name="customer_id" id="customer_id" value="{{request()->customer_id}}">
		<div class="card">
			<div class="card-header border-bottom-dashed">
				<h5 class="card-title mb-0 fs-17">Payment Selection</h5>
			</div>
			<div class="card-body pt-2">

				@if(count($cardInfo) > 0)
					<div class="row">	
						<div class="col-6">
							<label class="fs-15">Saved Cards</label>
						</div>
					</div>
						
					<div class="row">
						@foreach($cardInfo as $card) 
		        			@php $brandname = strtolower($card['brand']); @endphp
							<div class="col-md-4 col-lg-4 col-xxl-4 col-sm-6">
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
				@endif
				
				<div class="row">
					<div class="col-lg-12 mb-10">
						<div class="sacecard-title fs-14 mt-15">OTHER PAYMENT METHODS </div>
						<button class="card-btns fs-14" type="button">Credit / Debit Card</button>
					</div>
					
					<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
						<div id="payment-element" style="margin-top: 8px;">
						</div>
					</div>
					
					<div class="col-md-12 col-xs-12">
						<div class="save-pmt-checkbox">
							<input type="checkbox" id="save_card" name="save_card" value="1" checked>
							<input type="hidden" id="new_card_payment_method_id" name="new_card_payment_method_id" value="">
							<label class="fs-14 mt-15">Save For Future Payments</label>
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
					
					<div id="error-message" class="alert alert-danger mt-10" role="alert" style="display: none;"></div>


    				<div id="messages" role="alert" style="display: none;" class="text-center font-green mt-10 fs-16"></div>

					<div class="text-center mb-4">
						<span class="font-red fs-14 d-none participateAlert">Please Select Who Is Participating.</span>
					</div>

					<div class="text-end mb-4">
						<button class="btn btn-cart-checkout btn-label right ms-auto" type="submit"  id="checkout-button" >
							<i class="fas fa-arrow-right label-icon align-bottom fs-16 ms-2"></i> Check out
						</button>
					</div>
				</div>
			</div>
		</div>
	</form>
</div>


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
	    	$('#error_check').addClass('d-none');
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
	                inputVal = ['input[type=email]', 'input[type=password]','input[type=text]', 'input[type=file]', 'textarea'].join(', '),
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
        	      	confirmParams: {
        	      	}
        	    }).then(function(result){
        	    	if (result.error) {
        	    		$('.error').removeClass('hide').find('.alert').text(result.error.message);
        	    		$('#checkout-button').html('<i class="fas fa-arrow-right label-icon align-bottom fs-16 ms-2"></i>Check Out').prop('disabled', false);
        	    		return false;
        	    	}else{
        	    		console.log(result)
        	    		$.ajax({
        	    			url: '{{route('business.customers.refresh_payment_methods', ['business_id' => request()->businessId ,'customer_id' => request()->customer_id])}}',
        	    			success: function(data){
        	    				console.log(data)
        	    				console.log('success')
        	    			}
        	    		})

        	    		$('#new_card_payment_method_id').val(result.setupIntent.payment_method)
	        	    	/*$form.off('submit');
		                $form.submit();*/

		                $.ajax({
                            url: $form.attr('action'),
                            method: 'POST',
                            data: $form.serialize(),
                            success: function(response) {
                                $('#messages').text('Payment successfully done!').show();
                                $('#submit-button').html('Pay');
                                setTimeout(function() {
                                    window.location.href = "/check-in-portal?activetab=booking";
                                }, 2000); 
                            },
                            error: function(xhr) {
                                const errorResponse = xhr.responseJSON;
                                $('#error-message').text(errorResponse.error || 'An error occurred while processing the payment.').show();
                                $('#submit-button').html('Pay').prop('disabled', false);
                            }
                        });

        	    	}
        	    });
	        }else{
    	    	/*$form.off('submit');
                $form.submit();*/

                $.ajax({
                    url: $form.attr('action'),
                    method: 'POST',
                    data: $form.serialize(),
                    success: function(response) {
                        $('#messages').text('Payment successfully done!').show();
                        $('#submit-button').html('Pay');
                        setTimeout(function() {
                            window.location.href = "/check-in-portal?activetab=booking";
                        }, 2000); 
                    },
                    error: function(xhr) {
                        const errorResponse = xhr.responseJSON;
                        $('#error-message').text(errorResponse.error || 'An error occurred while processing the payment.').show();
                        $('#submit-button').html('Pay').prop('disabled', false);
                    }
                });

	        }
	    });
	});
</script>