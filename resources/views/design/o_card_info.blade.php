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
                        <h4 class="page-title">Payment Information</h4>
                    </div>
					<div class="payment_info_section padding-1 white-bg border-radius1">
                        <div class="payment-info-block">
                            <div class="savecard-block">
                                <div class="sacecard-title">Your Saved Cards</div>
								<!-- Mobile Slider Start -->
								 
									<!-- Mobile Slider Start -->
									<div class="col-md-12 desktop-none mobile-custom">
										<div class="mobile-slider payment-info owl-carousel owl-theme">
											<div class="owl-item" style="width: 300px;">
												<div class="card-info instant-section-info">
													<div class="cards-block dispalycard" style="cursor: pointer" data-name="" data-cvv="" data-cnumber="1117" data-month="3" data-year="2030" data-type="discover" data-id="88" data-ptype="update">
														<div class="cards-content" style="color:#ffffff; background-image: url(http://dev.fitnessity.co/public/img/visa-card-bg.jpg );">
															<img src="http://dev.fitnessity.co/public/images/creditcard/discover.jpg" alt="">
															<span style="float:right"></span>
															<p>Discover</p>
															<span>
																<span class="dots"></span><span class="dots"></span><span class="dots"></span><span class="dots"></span>1117 
															</span>

															<a style="float:right" data-behavior="delete_card" data-url="http://dev.fitnessity.co/personal-profile/payment-delete?stripe_payment_method=pm_1Mp4IyCr65ASmcsqdYxaqsCS" data-cardid="88" title="Delete Card" class="delCard"><i class="fa fa-trash"></i> </a>
														</div>
													</div>
												</div> 
											</div>
											<div class="owl-item" style="width: 300px;">
												<div class="card-info instant-section-info">
													<div class="cards-block dispalycard" style="cursor: pointer" data-name="" data-cvv="" data-cnumber="8210" data-month="2" data-year="2040" data-type="mastercard" data-id="111" data-ptype="update">
														<div class="cards-content" style="color:#ffffff; background-image: url(http://dev.fitnessity.co/public/img/visa-card-bg.jpg );">
															<img src="http://dev.fitnessity.co/public/images/creditcard/mastercard.jpg" alt="">
															<span style="float:right"></span>
															<p>Mastercard</p>
															<span>
																<span class="dots"></span><span class="dots"></span><span class="dots"></span><span class="dots"></span>8210 
															</span>

															<a style="float:right" data-behavior="delete_card" data-url="http://dev.fitnessity.co/personal-profile/payment-delete?stripe_payment_method=pm_1Mw2aACr65ASmcsqyEo8vjqs" data-cardid="111" title="Delete Card" class="delCard"><i class="fa fa-trash"></i> </a>
														</div>
													</div>
												</div> 
											</div>
											<div class="owl-item" style="width: 300px;">
												<div class="card-info instant-section-info">
													<div class="cards-block dispalycard" style="cursor: pointer" data-name="" data-cvv="" data-cnumber="5556" data-month="2" data-year="2058" data-type="visa" data-id="121" data-ptype="update">
														<div class="cards-content" style="color:#ffffff; background-image: url(http://dev.fitnessity.co/public/img/visa-card-bg.jpg );">
															<img src="http://dev.fitnessity.co/public/images/creditcard/visa.jpg" alt="">
															<span style="float:right"></span>
															<p>Visa</p>
															<span>
																<span class="dots"></span><span class="dots"></span><span class="dots"></span><span class="dots"></span>5556 
															</span>

															<a style="float:right" data-behavior="delete_card" data-url="http://dev.fitnessity.co/personal-profile/payment-delete?stripe_payment_method=pm_1Mw2gLCr65ASmcsqdbN8Shj6" data-cardid="121" title="Delete Card" class="delCard"><i class="fa fa-trash"></i> </a>
														</div>
													</div>
												</div>
											</div>
											<div class="owl-item" style="width: 290px;">
												<div class="card-info payment-side instant-section-info">
													<div class="cards-block dispalycard" style="cursor: pointer" data-name="" data-cvv="" data-cnumber="8431" data-month="2" data-year="2036" data-type="amex" data-id="130" data-ptype="update">
														<div class="cards-content" style="color:#ffffff; background-image: url(http://dev.fitnessity.co/public/img/visa-card-bg.jpg );">
															<img src="http://dev.fitnessity.co/public/images/creditcard/amex.jpg" alt="">
															<span style="float:right"></span>
															<p>Amex</p>
															<span>
																<span class="dots"></span><span class="dots"></span><span class="dots"></span><span class="dots"></span>8431 
															</span>

															<a style="float:right" data-behavior="delete_card" data-url="http://dev.fitnessity.co/personal-profile/payment-delete?stripe_payment_method=pm_1Mw2jmCr65ASmcsqzrsPfU4t" data-cardid="130" title="Delete Card" class="delCard"><i class="fa fa-trash"></i> </a>
														</div>
													</div>
												</div>
											</div>
											
											<div class="owl-item" style="width: 300px;">
												<div class="card-info instant-section-info">
													<div class="cards-block dispalycard" style="cursor: pointer" data-name="" data-cvv="" data-cnumber="1113" data-month="2" data-year="2050" data-type="discover" data-id="90" data-ptype="update">
														<div class="cards-content" style="color:#ffffff; background-image: url(http://dev.fitnessity.co/public/img/visa-card-bg.jpg );">
															<img src="http://dev.fitnessity.co/public/images/creditcard/discover.jpg" alt="">
															<span style="float:right"></span>
															<p>Discover</p>
															<span>
																<span class="dots"></span><span class="dots"></span><span class="dots"></span><span class="dots"></span>1113 
															</span>

															<a style="float:right" data-behavior="delete_card" data-url="http://dev.fitnessity.co/personal-profile/payment-delete?stripe_payment_method=pm_1MpRLZCr65ASmcsqWiLKPGuE" data-cardid="90" title="Delete Card" class="delCard"><i class="fa fa-trash"></i> </a>
														</div>
													</div>
												</div> 
											</div>
											<div class="owl-item" style="width: 300px;">
												<div class="card-info instant-section-info">
													<div class="cards-block dispalycard" style="cursor: pointer" data-name="" data-cvv="" data-cnumber="8431" data-month="4" data-year="2051" data-type="amex" data-id="91" data-ptype="update">
														<div class="cards-content" style="color:#ffffff; background-image: url(http://dev.fitnessity.co/public/img/visa-card-bg.jpg );">
															<img src="http://dev.fitnessity.co/public/images/creditcard/amex.jpg" alt="">
															<span style="float:right"></span>
															<p>Amex</p>
															<span>
																<span class="dots"></span><span class="dots"></span><span class="dots"></span><span class="dots"></span>8431 
															</span>

															<a style="float:right" data-behavior="delete_card" data-url="http://dev.fitnessity.co/personal-profile/payment-delete?stripe_payment_method=pm_1MnbgwCr65ASmcsqkqicJOJ5" data-cardid="91" title="Delete Card" class="delCard"><i class="fa fa-trash"></i> </a>
														</div>
													</div>
												</div> 
											</div>
											<div class="owl-item" style="width: 300px;">
												<div class="card-info instant-section-info">
													<div class="cards-block dispalycard" style="cursor: pointer" data-name="" data-cvv="" data-cnumber="9424" data-month="2" data-year="2030" data-type="discover" data-id="89" data-ptype="update">
														<div class="cards-content" style="color:#ffffff; background-image: url(http://dev.fitnessity.co/public/img/visa-card-bg.jpg );">
															<img src="http://dev.fitnessity.co/public/images/creditcard/discover.jpg" alt="">
															<span style="float:right"></span>
															<p>Discover</p>
															<span>
																<span class="dots"></span><span class="dots"></span><span class="dots"></span><span class="dots"></span>9424 
															</span>

															<a style="float:right" data-behavior="delete_card" data-url="http://dev.fitnessity.co/personal-profile/payment-delete?stripe_payment_method=pm_1Mp75eCr65ASmcsqyf0jFa9R" data-cardid="89" title="Delete Card" class="delCard"><i class="fa fa-trash"></i> </a>
														</div>
													</div>
												</div> 
											</div>
											
											<div class="owl-item" style="width: 300px;">
												<div class="card-info instant-section-info">
													<div class="cards-block dispalycard" style="cursor: pointer" data-name="" data-cvv="" data-cnumber="3222" data-month="2" data-year="2026" data-type="mastercard" data-id="82" data-ptype="update">
														<div class="cards-content" style="color:#ffffff; background-image: url(http://dev.fitnessity.co/public/img/visa-card-bg.jpg );">
															<img src="http://dev.fitnessity.co/public/images/creditcard/mastercard.jpg" alt="">
															<span style="float:right"></span>
															<p>Mastercard</p>
															<span>
																<span class="dots"></span><span class="dots"></span><span class="dots"></span><span class="dots"></span>3222 
															</span>

															<a style="float:right" data-behavior="delete_card" data-url="http://dev.fitnessity.co/personal-profile/payment-delete?stripe_payment_method=pm_1MnbvRCr65ASmcsq0hbAAK7a" data-cardid="82" title="Delete Card" class="delCard"><i class="fa fa-trash"></i> </a>
														</div>
													</div>
												</div> 
											</div>
											<div class="owl-item" style="width: 300px;">
												<div class="card-info instant-section-info">
													<div class="cards-block addcard" style="cursor: pointer" data-name="" data-cvv="" data-cnumber="" data-month="" data-year="" data-type="" data-ptype="insert">
														<div class="cards-content" style="height:166px; color:#ffffff;     background-image: url(http://dev.fitnessity.co/public/img/visa-card-bg.jpg);">
															<span style="text-align: center">Add New Card</span>
														</div>
													</div>
												</div> 
											</div>
										</div>
									</div>
									<!-- Mobile Slider End -->
									<div class="cards-block dispalycard mdisplay-none" style="cursor: pointer" data-name="" data-cvv="" data-cnumber="4105" data-month="2" data-year="2035" data-type="discover" data-id="233" data-ptype="update">
										<div class="cards-content" style="color:#ffffff; background-image: url(http://dev.fitnessity.co/public/img/visa-card-bg.jpg );">
											<img src="http://dev.fitnessity.co/public/images/creditcard/discover.jpg" alt="">
											<span style="float:right"></span>
											<p>Discover</p>
											<span>
												<span class="dots"></span><span class="dots"></span><span class="dots"></span><span class="dots"></span>4105 
											</span>
											<a style="float:right" data-behavior="delete_card" data-url="http://dev.fitnessity.co/personal-profile/payment-delete?stripe_payment_method=pm_1Nk4mCCr65ASmcsqkNe9vFla" data-cardid="233" title="Delete Card" class="delCard"><i class="fa fa-trash"></i> </a>
										</div>
									</div>
                                    <div class="cards-block dispalycard mdisplay-none" style="cursor: pointer" data-name="" data-cvv="" data-cnumber="4444" data-month="2" data-year="2035" data-type="mastercard" data-id="232" data-ptype="update">
										<div class="cards-content" style="color:#ffffff; background-image: url(http://dev.fitnessity.co/public/img/visa-card-bg.jpg );">
											<img src="http://dev.fitnessity.co/public/images/creditcard/mastercard.jpg" alt="">
											<span style="float:right"></span>
											<p>Mastercard</p>
											<span>
												<span class="dots"></span><span class="dots"></span><span class="dots"></span><span class="dots"></span>4444 
											</span>
											<a style="float:right" data-behavior="delete_card" data-url="http://dev.fitnessity.co/personal-profile/payment-delete?stripe_payment_method=pm_1Nk32WCr65ASmcsqU4FK5teY" data-cardid="232" title="Delete Card" class="delCard"><i class="fa fa-trash"></i> </a>
										</div>
									</div>
                                     
									<div class="cards-block dispalycard mdisplay-none" style="cursor: pointer" data-name="" data-cvv="" data-cnumber="4444" data-month="2" data-year="2032" data-type="mastercard" data-id="229" data-ptype="update">
										<div class="cards-content" style="color:#ffffff; background-image: url(http://dev.fitnessity.co/public/img/visa-card-bg.jpg );">
											<img src="http://dev.fitnessity.co/public/images/creditcard/mastercard.jpg" alt="">
											<span style="float:right"></span>
											<p>Mastercard</p>
											<span>
												<span class="dots"></span><span class="dots"></span><span class="dots"></span><span class="dots"></span>4444 
											</span>
											<a style="float:right" data-behavior="delete_card" data-url="http://dev.fitnessity.co/personal-profile/payment-delete?stripe_payment_method=pm_1NUpDaCr65ASmcsqjbOLg8bH" data-cardid="229" title="Delete Card" class="delCard"><i class="fa fa-trash"></i> </a>
										</div>
									</div>
									<div class="cards-block dispalycard mdisplay-none" style="cursor: pointer" data-name="" data-cvv="" data-cnumber="4242" data-month="2" data-year="2024" data-type="visa" data-id="176" data-ptype="update">
										<div class="cards-content" style="color:#ffffff; background-image: url(http://dev.fitnessity.co/public/img/visa-card-bg.jpg );">
											<img src="http://dev.fitnessity.co/public/images/creditcard/visa.jpg" alt="">
											<span style="float:right"></span>
											<p>Visa</p>
											<span>
												<span class="dots"></span><span class="dots"></span><span class="dots"></span><span class="dots"></span>4242 
											</span>
											<a style="float:right" data-behavior="delete_card" data-url="http://dev.fitnessity.co/personal-profile/payment-delete?stripe_payment_method=pm_1N0OpoCr65ASmcsq59sxzvJC" data-cardid="176" title="Delete Card" class="delCard"><i class="fa fa-trash"></i> </a>
										</div>
									</div>
                                    <div class="cards-block dispalycard mdisplay-none" style="cursor: pointer" data-name="" data-cvv="" data-cnumber="8431" data-month="2" data-year="2036" data-type="amex" data-id="130" data-ptype="update">
										<div class="cards-content" style="color:#ffffff; background-image: url(http://dev.fitnessity.co/public/img/visa-card-bg.jpg );">
											<img src="http://dev.fitnessity.co/public/images/creditcard/amex.jpg" alt="">
											<span style="float:right"></span>
											<p>Amex</p>
											<span>
												<span class="dots"></span><span class="dots"></span><span class="dots"></span><span class="dots"></span>8431 
											</span>
											<a style="float:right" data-behavior="delete_card" data-url="http://dev.fitnessity.co/personal-profile/payment-delete?stripe_payment_method=pm_1Mw2jmCr65ASmcsqzrsPfU4t" data-cardid="130" title="Delete Card" class="delCard"><i class="fa fa-trash"></i> </a>
										</div>
									</div>
                                    <div class="cards-block dispalycard mdisplay-none" style="cursor: pointer" data-name="" data-cvv="" data-cnumber="5556" data-month="2" data-year="2058" data-type="visa" data-id="121" data-ptype="update">
										<div class="cards-content" style="color:#ffffff; background-image: url(http://dev.fitnessity.co/public/img/visa-card-bg.jpg );">
											<img src="http://dev.fitnessity.co/public/images/creditcard/visa.jpg" alt="">
											<span style="float:right"></span>
											<p>Visa</p>
											<span>
												<span class="dots"></span><span class="dots"></span><span class="dots"></span><span class="dots"></span>5556 
											</span>
											<a style="float:right" data-behavior="delete_card" data-url="http://dev.fitnessity.co/personal-profile/payment-delete?stripe_payment_method=pm_1Mw2gLCr65ASmcsqdbN8Shj6" data-cardid="121" title="Delete Card" class="delCard"><i class="fa fa-trash"></i> </a>
										</div>
									</div>
                                     <div class="cards-block dispalycard mdisplay-none" style="cursor: pointer" data-name="" data-cvv="" data-cnumber="8210" data-month="2" data-year="2040" data-type="mastercard" data-id="111" data-ptype="update">
										<div class="cards-content" style="color:#ffffff; background-image: url(http://dev.fitnessity.co/public/img/visa-card-bg.jpg );">
											<img src="http://dev.fitnessity.co/public/images/creditcard/mastercard.jpg" alt="">
											<span style="float:right"></span>
											<p>Mastercard</p>
											<span>
												<span class="dots"></span><span class="dots"></span><span class="dots"></span><span class="dots"></span>8210 
											</span>

											<a style="float:right" data-behavior="delete_card" data-url="http://dev.fitnessity.co/personal-profile/payment-delete?stripe_payment_method=pm_1Mw2aACr65ASmcsqyEo8vjqs" data-cardid="111" title="Delete Card" class="delCard"><i class="fa fa-trash"></i> </a>
										</div>
									</div>
                                     
									<div class="cards-block dispalycard mdisplay-none" style="cursor: pointer" data-name="" data-cvv="" data-cnumber="1113" data-month="2" data-year="2050" data-type="discover" data-id="90" data-ptype="update">
										<div class="cards-content" style="color:#ffffff; background-image: url(http://dev.fitnessity.co/public/img/visa-card-bg.jpg );">
											<img src="http://dev.fitnessity.co/public/images/creditcard/discover.jpg" alt="">
											<span style="float:right"></span>
											<p>Discover</p>
											<span>
												<span class="dots"></span><span class="dots"></span><span class="dots"></span><span class="dots"></span>1113 
											</span>

											<a style="float:right" data-behavior="delete_card" data-url="http://dev.fitnessity.co/personal-profile/payment-delete?stripe_payment_method=pm_1MpRLZCr65ASmcsqWiLKPGuE" data-cardid="90" title="Delete Card" class="delCard"><i class="fa fa-trash"></i> </a>
										</div>
									</div>
                                            
									<div class="cards-block addcard mdisplay-none" style="cursor: pointer" data-name="" data-cvv="" data-cnumber="" data-month="" data-year="" data-type="" data-ptype="insert">
										<div class="cards-content" style="height:166px; color:#ffffff; background-image: url(http://dev.fitnessity.co/public/img/visa-card-bg.jpg);">
											<span style="text-align: center">Add New Card</span>
										</div>
									</div>
								</div>

                            <div class="row" id="stripediv" style="display:none;">
                                <div class="col-md-6">
									<form class="validation" data-secret="seti_1NmV4wCr65ASmcsq7T6Soivb_secret_OZeNeT3j6rksRe0TWBnKjKX10DwR5Rd" id="payment-form">
                                        <div id="error-message" class="alert alert-danger" role="alert" style="display: none;"></div>
                                        <div id="payment-element" style="margin-top: 8px;" class="StripeElement"><div class="__PrivateStripeElement" style="margin: -4px 0px !important; padding: 0px !important; border: medium none !important; display: block !important; background: transparent !important; position: relative !important; opacity: 1 !important; clear: both !important; transition: height 0.35s ease 0s !important;"><iframe name="__privateStripeFrame1687" allowtransparency="true" scrolling="no" role="presentation" src="https://js.stripe.com/v3/elements-inner-payment-2823909cb262005613b7352fb5bf4326.html#wait=false&amp;rtl=false&amp;componentName=payment&amp;keyMode=test&amp;apiKey=pk_test_OsczNDatguPzxcYVHzTfC2Bv009RQc4cYp&amp;referrer=http%3A%2F%2Fdev.fitnessity.co%2Fpersonal-profile%2Fpayment-info&amp;controllerId=__privateStripeController1681" title="Secure payment input frame" style="border: medium none !important; margin: -4px; padding: 0px !important; width: calc(100% + 8px); min-width: 100% !important; overflow: hidden !important; display: block !important; user-select: none !important; transform: translate(0px) !important; color-scheme: light only !important; height: 740.383px; opacity: 1; transition: height 0.35s ease 0s, opacity 0.4s ease 0.1s;" frameborder="0"></iframe></div></div>
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

<script src="{{ url('public/js/bootstrap.min.js') }}"></script>

<script src="{{ url('public/js/metisMenu.min.js') }}"></script>

<script src="{{ url('public/js/jquery.payform.min.js') }}" charset="utf-8"></script>

<script src="{{ url('public/js/creditcard.js') }}"></script>


@endsection