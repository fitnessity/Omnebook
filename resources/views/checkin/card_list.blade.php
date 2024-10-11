 <div class="row">
	<div class="col-lg-12">
		<div class="text-center">
    		<h5 class="fs-16 font-red">Add or Update Cards</h5>
			<div class="card-body pt-2">
		        <div class="row">
		            @foreach($cards as $card) 
		                @php $brandname = strtolower($card['brand']); @endphp
		                <div class="col-md-6">
		                    <label class="pay-card" style="color:#ffffff; background-image: url(/public/img/visa-card-bg.jpg );">
		                        <input name="cardinfo" class="payment-radio" type="radio" value="{{$card['payment_id']}}">
		                        <span class="plan-details">
		                            <div class="row">
		                                <div class="col-md-12">
											<div class="p-relative">
												<div class="modal-update-card">
													<a class="card-remove mr-10" onclick="editCard('{{$card->payment_id}}','{{$card->exp_month}}','{{$card->exp_year}}')" data-cardid="{{$card->id}}">
														<i class="fas fa-pencil-alt"></i> 
													</a>
												</div>
											</div>
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

		        <form id="payment-form" data-secret="{{$intent['client_secret']}}" style="padding: 16px;margin-bottom: 0px;">
				    <div id="payment-element" style="margin-top: 8px;"></div>
				    <div id="error-message" class="alert alert-danger mt-10" role="alert" style="display: none;"></div>
				    <div class="text-center mt-10"><button class="btn btn-red align-center" type="submit" id="submit">Add on file</button></div>

				    <div id="messages" role="alert" style="display: none;"></div>
				</form>
		    </div>
		</div>
	</div>
</div>

<script type="text/javascript" >
	function editCard(cardId,month,year){
		$('#cardId').val(cardId);
		$('#year').val(year);
		$('#month').val(month);
		$('#ajax_html_modal').modal('hide');
		$('.editCard').modal('show');
	}

    const stripe_bcus = Stripe('{{ env('STRIPE_PKEY') }}');
    const options_bcus = {
        clientSecret: '{{$intent['client_secret']}}',
        appearance: {
          theme: 'flat'
        },
    };

    // Set up Stripe.js and Elements to use in checkout form, passing the client secret obtained in step 3
    const elements_bcus = stripe_bcus.elements(options_bcus);

    // Create and mount the Payment Element
    const paymentElement_bcus = elements_bcus.create('payment');
    paymentElement_bcus.mount('#payment-element');
    const form_bcus = document.getElementById('payment-form');

    form_bcus.addEventListener('submit', async (event) => {
        event.preventDefault();
        $('#submit').text('loading...')

        const {error: error_bcus} = await stripe_bcus.confirmSetup({
            //`Elements` instance that was used to create the Payment Element
           elements: elements_bcus,
            confirmParams: {
                return_url: '{{route('business.customers.refresh_payment_methods', ['business_id' => request()->business_id ,'customer_id' => request()->customer_id])}}&return_url={{request()->return_url}}',
            }
        });

        if (error_bcus) {

            //alert(error_bcus.message)
            // This point will only be reached if there is an immediate error when
            // confirming the payment. Show error to your customer (for example, payment
            // details incomplete)  
            const messageContainer_bcus = document.querySelector('#error-message');
            messageContainer_bcus.textContent = error_bcus.message;
            $('#error-message').show();
        } else {
            // Your customer will be redirected to your `return_url`. For some payment
            // methods like iDEAL, your customer will be redirected to an intermediate
            // site first to authorize the payment, then redirected to the `return_url`.
        }
        $('#submit').text('Add on file')
  });

</script>