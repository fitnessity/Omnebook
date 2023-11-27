<form action="{{route('choose-plan.store')}}" method="POST" class="validation" data-cc-on-file="false"  data-stripe-publishable-key="{{ env('STRIPE_PKEY') }}" id="payment-form">
  @csrf
  <div class="card">
      <div class="card-header border-bottom-dashed">
        <h5 class="card-title mb-0 fs-17">Payment Selection</h5>
      </div>
      <div class="card-body pt-2">
        <div class="row"> 
          <div class="col-6">
            <label class="fs-15">Save Cards</label>
          </div>
          <div class="col-6">
            <!-- <a href="/personal-profile/payment-info" class="edit-cart fs-15 color-red-a float-end"> Edit</a> -->

            <a href="{{route('creditCardInfo')}}" class="edit-cart fs-15 color-red-a float-end"> Edit</a>
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
          var check = document.querySelector( 'input[name="terms_condition"]:checked');
          if(check == null) {
              $('#error_check').show();
              $('#checkout-button').html('<i class="fas fa-arrow-right label-icon align-bottom fs-16 ms-2"></i>Check Out').prop('disabled', false);
              return false;
          }

          var cardinfoRadio = document.querySelector( 'input[name="cardinfo"]:checked');
          var save_cardRadio = document.querySelector( 'input[name="save_card"]:checked');
      
          if(save_cardRadio == null) {
              $('#save_card').val(0);
          }else{
               $('#save_card').val(1);
          }
         
          if(cardinfoRadio == null) {

              var $form  = $(".validation"),
                  inputVal = ['input[type=email]', 'input[type=password]',
                                   'input[type=text]', 'input[type=file]',
                                   'textarea'].join(', '),
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
          $('#checkout-button').html('Check Out').prop('disabled', false);
      }
  });
</script>

