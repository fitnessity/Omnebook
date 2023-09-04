@extends('layouts.header')
@section('content')

<link rel="shortcut icon" href="{{ url('public/img/favicon.png') }}">

<!--<link rel="stylesheet" type="text/css" href="{{ url('public/css/bootstrap.css') }}">-->
<link rel="stylesheet" type="text/css" href="{{ url('public/css/all.css') }}">
<link rel="stylesheet" type="text/css" href="{{ url('public/css/metismenu.min.css') }}">
<!-- <link rel="stylesheet" type="text/css" href="{{ url('public/css/fullcalendar.min.css') }}"> -->
<link rel="stylesheet" type="text/css" href="{{ url('public/css/profile.css') }}">
<link rel="stylesheet" type="text/css" href="{{ url('public/css/creditcard.css') }}">

<div class="page-wrapper inner_top" id="wrapper">
    <div class="page-container">
        <!-- Left Sidebar Start -->
        @include('personal-profile.left_panel')
        <!-- Left Sidebar End -->
        <div class="page-content-wrapper">
            <div class="content-page">
                <div class="container-fluid">
                    <div class="page-title-box">
                        <h4 class="page-title">Credit Card Details</h4>
                    </div>
					<div class="payment_info_section padding-1 white-bg border-radius1">
                        <div class="payment-info-block">
                            <div class="savecard-block">
                                <div class="sacecard-title">Your Saved Cards</div>
								<!-- Mobile Slider Start -->
								 
									<!-- Mobile Slider Start -->
									@if(!empty($cardInfo)) 
										<div class="col-md-12 desktop-none mobile-custom">
											<div class="mobile-slider payment-info owl-carousel owl-theme">
												@foreach($cardInfo as $card) 
                                       				@php $brandname = strtolower($card['brand']); @endphp
													<div class="owl-item" style="width: 300px;">
														<div class="card-info instant-section-info">
															<div class="cards-block dispalycard" style="cursor: pointer"  data-name="<?=$card['name']?>" data-cvv="" data-cnumber="<?=$card['last4']?>" data-month="<?=$card['exp_month']?>" data-year="<?=$card['exp_year']?>" data-type="{{$brandname}}" data-id="{{$card['id']}}" data-ptype="update">
																<div class="cards-content" style="color:#ffffff; background-image: url({{ url('public/img/visa-card-bg.jpg')}} );">
																	<img src="{{ url('/public/images/creditcard/'.$brandname.'.jpg') }}" alt="">
																	<span style="float:right">{{$card['name']}}</span>
																	<p>{{ucfirst($brandname)}}</p>
																	<span>
																		<span class="dots"></span><span class="dots"></span><span class="dots"></span><span class="dots"></span>{{$card['last4']}}   
																	</span>

																	<a style="float:right" data-behavior="delete_card" data-url="{{route('cardDelete', ['stripe_payment_method' => $card['payment_id']])}}" data-cardid="{{$card['id']}}" title="Delete Card" class="delCard"><i class="fa fa-trash"></i> </a>
																</div>
															</div>
														</div> 
													</div>
												@endforeach
												<div class="owl-item" style="width: 290px;">
													<div class="card-info payment-side instant-section-info">
														<div class="cards-block addcard" style="cursor: pointer"  data-name="" data-cvv="" data-cnumber="" data-month="" data-year="" data-type=""  data-ptype="insert">
															<div class="cards-content"style="height:166px; color:#ffffff; background-image: url({{ url('public/img/visa-card-bg.jpg')}});">
			                                            		<span style="text-align: center">Add New Card</span>
			                                        		</div>
			                                        	</div>
			                                        </div>
			                                    </div>
											</div>
										</div>
									@else
	                                    <div class="col-md-12 desktop-none mobile-custom">
	                                        <div style="padding:50px; text-align: center; font-size:14px; color:#585858">Upload a credit card safely so you can process bookings faster.</div>
	                                    </div>
	                                @endif
                                	
                                	<!-- Mobile Slider End -->

                                	@if(!empty($cardInfo)) 
                                    	@foreach($cardInfo as $card) 
	                                       	@php $brandname = strtolower($card['brand']); @endphp
											<div class="cards-block dispalycard mdisplay-none" style="cursor: pointer" data-name="{{$card['name']}}" data-cvv="{{$card['last4']}}" data-cnumber="{{$card['exp_month']}}" data-month="{{$card['exp_month']}}" data-year="$card['exp_year']" data-type="{{$brandname}}" data-id="{{$card['id']}}" data-ptype="update">
												<div class="cards-content" style="color:#ffffff; background-image: url({{ url('public/img/visa-card-bg.jpg')}});">
													<img src="{{ url('/public/images/creditcard/'.$brandname.'.jpg') }}" alt="">
													<span style="float:right">{{$card['name']}}</span>
													<p>{{ucfirst($brandname)}}</p>
													<span>
														<span class="dots"></span><span class="dots"></span><span class="dots"></span><span class="dots"></span>{{$card['last4']}} 
													</span>
													<a style="float:right" data-behavior="delete_card" data-url="{{route('cardDelete', ['stripe_payment_method' => $card['payment_id']])}}" data-cardid="{{$card['id']}}" title="Delete Card" class="delCard"><i class="fa fa-trash"></i> </a>
												</div>
											</div>
										@endforeach
	                                @else
	                                    <div class="mdisplay-none" style="padding:50px; text-align: center; font-size:14px; color:#585858">Upload a credit card safely so you can process bookings faster.</div>
	                                @endif

	                                <div class="cards-block addcard mdisplay-none" style="cursor: pointer" data-name="" data-cvv="" data-cnumber="" data-month="" data-year="" data-type=""  data-ptype="insert">
                                    <div class="cards-content"style="height:166px; color:#ffffff; background-image: url({{ url('public/img/visa-card-bg.jpg')}});">
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
                                                    <div class="alert-danger alert">
                                                        {{ session('stripeErrorMsg') }}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                    <form  class="validation" data-secret="{{$intent['client_secret']}}" id="payment-form">
                                        <div id="error-message" class="alert alert-danger" role="alert" style="display: none;"></div>
                                        <div id="payment-element" style="margin-top: 8px;"></div>
                                        <button class="post-btn-red" type="submit" id="submit">Save</button>
                                    </form>
                                </div>
							</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@include('layouts.footer')
<script>
    $(".payment-info").owlCarousel({
    	loop: false,
    	autoWidth: true,
    	autoplay: false,
    	autoplayTimeout: 2000, //2000ms = 2s;
    	autoplayHoverPause: true,
    	responsiveClass: true,
    	responsive: {
			0: {
				items: 1
			},

			600: {
				items: 2
			},

			1024: {
				items: 2
			},
			1200: {
				items: 3
			},
			1366: {
				items: 5
			},
        },
    });
</script>

<script type="text/javascript">

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
        //Elements` instance that was used to create the Payment Element
            elements,
            confirmParams: {
                return_url: '{{route("cards-save")}}',
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

<script type="text/javascript">
    
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

                   /* alert("Card removed successfully.");*/
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

<script src="{{ url('public/js/bootstrap.min.js') }}"></script>

<script src="{{ url('public/js/metisMenu.min.js') }}"></script>

<script src="{{ url('public/js/jquery.payform.min.js') }}" charset="utf-8"></script>

<script src="{{ url('public/js/creditcard.js') }}"></script>


@endsection