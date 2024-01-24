<form id="payment-form" data-secret="{{$intent['client_secret']}}" style="padding: 16px;margin-bottom: 0px;">

  <div id="error-message" class="alert alert-danger" role="alert" style="display: none;"></div>
  <div id="payment-element" style="margin-top: 8px;"></div>
   
  <div class="text-center mt-10"><button class="btn btn-red align-center" type="submit" id="submit">Add on file</button></div>
</form>

<script type="text/javascript" >
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

    const {error_bcus} = await stripe_bcus.confirmSetup({
      //`Elements` instance that was used to create the Payment Element
       elements: elements_bcus,
      confirmParams: {
        return_url: '{{route('business.customers.refresh_payment_methods', ['customer_id' => request()->customer_id])}}&return_url={{request()->return_url}}',
      }
    });

    if (error_bcus) {
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


