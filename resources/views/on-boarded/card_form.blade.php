<form id="payment-form" data-secret="{{$intent['client_secret']}}" style="padding: 16px;margin-bottom: 0px;">

  <div id="error-message" class="alert alert-danger" role="alert" style="display: none;"></div>
  <div id="payment-element" style="margin-top: 8px;"></div>
   
  <button class="btn btn-red" type="submit" id="submit">Add on file</button>
</form>

<script type="text/javascript" >
  const stripe = Stripe('{{ env('STRIPE_PKEY') }}');
  const options = {
    clientSecret: '{{$intent['client_secret']}}',
    appearance: {
      theme: 'flat'
    },
  };

  // Set up Stripe.js and Elements to use in checkout form, passing the client secret obtained in step 3
  const elements = stripe.elements(options);

  // Create and mount the Payment Element
  const paymentElement = elements.create('payment');
  paymentElement.mount('#payment-element');

  const form = document.getElementById('payment-form');

  form.addEventListener('submit', async (event) => {
    event.preventDefault();
    $('#submit').text('loading...')

    const {error} = await stripe.confirmSetup({
      //`Elements` instance that was used to create the Payment Element
      elements,
      confirmParams: {
        return_url: '{{route('storeCards', ['cid' => $company->id ])}}',
      }
    });

    if (error) {
      // This point will only be reached if there is an immediate error when
      // confirming the payment. Show error to your customer (for example, payment
      // details incomplete)  
      const messageContainer = document.querySelector('#error-message');
      messageContainer.textContent = error.message;
      $('#error-message').show();

    } else {
      // Your customer will be redirected to your `return_url`. For some payment
      // methods like iDEAL, your customer will be redirected to an intermediate
      // site first to authorize the payment, then redirected to the `return_url`.
    }
    $('#submit').text('Add on file')
  });
</script>


