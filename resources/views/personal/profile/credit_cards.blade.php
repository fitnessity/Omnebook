@inject('request', 'Illuminate\Http\Request')
@extends('layouts.business.header')

@section('content')

	@include('layouts.profile.business_topbar')
	<!-- ============================================================== -->
    <!-- Start right Content here -->
    <!-- ============================================================== -->
    <div class="main-content">
		<div class="page-content">
            <div class="container-fluid">
               <div class="row mb-3">
					<div class="col-12">
						<div class="page-heading">
							<label>Credit Card Information</label>
						</div>
					</div>
                </div><!--end row-->
				<div class="row">
					<div class="col-lg-12">
						<div class="card">
							<div class="card-header">
								<h4 class="card-title mb-0">Your Saved Cards</h4>
							</div><!-- end card header -->
							<div class="card-body">
								<div class="row">
									@forelse($cardInfo as $card) 
									    <div class="col-lg-3 col-sm-6">
										    <div class="cards-block dispalycard" style="cursor: pointer" data-name="{{$card['name']}}" data-cvv="" data-cnumber="{{$card['last4']}}" data-month="{{$card['exp_month']}}" data-year="{{$card['exp_year']}}" data-type="{{strtolower($card['brand'])}}" data-id="{{$card['id']}}" data-ptype="update">
											    <div class="cards-content" style="background-image: url(http://dev.fitnessity.co/public/img/visa-card-bg.jpg );">
		                                            <img src="{{ url('/public/images/creditcard/'.strtolower($card['brand']).'.jpg') }}" alt="">
		                                            <span>{{$card['name']}}</span>
		                                            <p>{{ucfirst(strtolower($card['brand']))}}</p>
		                                            <span>
                		                                <span class="dots"></span><span class="dots"></span><span class="dots"></span><span class="dots"></span>{{$card['last4']}} 
                		                            </span>
		                                           <a class="float-end card-remove" data-behavior="delete_card" data-url="{{route('personal.cardDelete', ['stripe_payment_method' => $card['payment_id']])}}" data-cardid="{{$card['id']}}" title="Delete Card" class="delCard"><i class="fa fa-trash"></i></a>
		                                        </div>
                                            </div>
									    </div>
									@empty
									@endforelse
									<div class="col-lg-3 col-sm-6">
										<div class="cards-block addcard" style="cursor: pointer" data-name="" data-cvv="" data-cnumber="" data-month="" data-year="" data-type="" data-ptype="insert">
                                            <div class="cards-content" style=" background-image: url(http://dev.fitnessity.co/public/img/visa-card-bg.jpg);">
                                                <span style="text-align: center">Add New Card</span>
                                            </div>
                                        </div>
									</div>

									<div class="row" id="stripediv" style="display:none;">
                                        <div class="col-md-6">
                                            @if (session('stripeErrorMsg'))
                                                <div class="col-md-12">
                                                    <div class='form-row row'>
                                                        <div class='col-md-12  error form-group'>
                                                            <div class="alert-danger alert">{{ session('stripeErrorMsg') }}</div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endif
                                            <form  class="validation" data-secret="{{$intent['client_secret']}}" id="payment-form">
                                                <div id="error-message" class="alert alert-danger" role="alert" style="display: none;"></div>
                                                <div id="payment-element" style="margin-top: 8px;"></div>
                                                <button class="btn btn-red" type="submit" id="submit">Save</button>
                                            </form>
                                        </div>
									</div>
								</div>                                    
							</div><!-- end card-body -->
						</div><!-- end card -->
					</div><!-- end col -->
				</div><!-- end row -->				
            </div><!-- container-fluid -->
        </div><!-- End Page-content -->
     </div><!-- end main content-->
</div><!-- END layout-wrapper -->

	
@include('layouts.business.footer')

<script>

    const stripe = Stripe('{{ env('STRIPE_PKEY') }}');
    const options1 = {
        clientSecret: '{{$intent['client_secret']}}',
        appearance: {
        theme: 'flat'
        },
    };

    // Set up Stripe.js and Elements to use in checkout form, passing the client secret obtained in step 3
    const elements = stripe.elements(options1);

    // Create and mount the Payment Element
    const paymentElement = elements.create('payment');
    paymentElement.mount('#payment-element');

    const form = document.getElementById('payment-form');

    form.addEventListener('submit', async (event) => {
        event.preventDefault();
        $('#submit').text('loading...')

        const {error} = await stripe.confirmSetup({
        //Elements` instance that was used to create the Payment Element
            elements,
            confirmParams: {
                return_url: '{{route("personal.cards-save")}}',
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

<script >
    
    var query_error = '<?=isset($_GET['error'])?$_GET['error']:0;?>';
    if(query_error == 1) {
        $("#card-error").html("Requested card number is already exists.");
    }

    $(document).on("click", "[data-behavior~=delete_card]", function(e){
        e.preventDefault()
        if (confirm('You are sure to delete card?')) {
            var cardid = $(this).data("cardid");
            $.ajax({
                type: 'post',
                url: $(this).data('url'),
                data: {
                    _token: '{{csrf_token()}}',
                    cardid:cardid
                },
                success: function(data) {
                    location.reload();
                }
            });
        } else {
            //alert('Why did you press cancel? You should have confirmed');
        }
    });
    
    $(".dispalycard").on("click", function(){
        $('#stripediv').css('display','none');
    });

    $(".addcard").on("click", function(){
        $('#stripediv').css('display','block');
    });
</script>
@endsection