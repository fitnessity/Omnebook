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
									<div class="col-lg-3 col-sm-6">
										<div class="cards-block dispalycard" style="cursor: pointer" data-name="" data-cvv="" data-cnumber="4444" data-month="2" data-year="2032" data-type="mastercard" data-id="229" data-ptype="update">
											<div class="cards-content" style="background-image: url(http://dev.fitnessity.co/public/img/visa-card-bg.jpg );">
		                                        <img src="http://dev.fitnessity.co/public/images/creditcard/mastercard.jpg" alt="">
		                                        <span></span>
		                                        <p>Mastercard</p>
		                                        <span>
		                                            <span class="dots"></span><span class="dots"></span><span class="dots"></span><span class="dots"></span>4444 
		                                        </span>

		                                        <a class="float-end card-remove" data-behavior="delete_card" data-url="http://dev.fitnessity.co/personal-profile/payment-delete?stripe_payment_method=pm_1NUpDaCr65ASmcsqjbOLg8bH" data-cardid="229" title="Delete Card" class="delCard">
													<i class="fa fa-trash"></i> 
												</a>
		                                    </div>
                                        </div>
									</div>
									
									<div class="col-lg-3 col-sm-6">
										<div class="cards-block dispalycard" style="cursor: pointer" data-name="" data-cvv="" data-cnumber="4242" data-month="2" data-year="2024" data-type="visa" data-id="176" data-ptype="update">
		                                    <div class="cards-content" style="background-image: url(http://dev.fitnessity.co/public/img/visa-card-bg.jpg );">
		                                        <img src="http://dev.fitnessity.co/public/images/creditcard/visa.jpg" alt="">
		                                        <span style="float:right"></span>
		                                        <p>Visa</p>
		                                        <span>
		                                            <span class="dots"></span><span class="dots"></span><span class="dots"></span><span class="dots"></span>4242 
		                                        </span>

		                                        <a class="float-end card-remove" data-behavior="delete_card" data-url="http://dev.fitnessity.co/personal-profile/payment-delete?stripe_payment_method=pm_1N0OpoCr65ASmcsq59sxzvJC" data-cardid="176" title="Delete Card" class="delCard"><i class="fa fa-trash"></i> </a>
		                                    </div>
                                        </div>
									</div>
									
									<div class="col-lg-3 col-sm-6">
										<div class="cards-block dispalycard" style="cursor: pointer" data-name="" data-cvv="" data-cnumber="8431" data-month="2" data-year="2036" data-type="amex" data-id="130" data-ptype="update">
		                                    <div class="cards-content" style="background-image: url(http://dev.fitnessity.co/public/img/visa-card-bg.jpg );">
		                                        <img src="http://dev.fitnessity.co/public/images/creditcard/amex.jpg" alt="">
		                                        <span style="float:right"></span>
		                                        <p>Amex</p>
		                                        <span>
		                                            <span class="dots"></span><span class="dots"></span><span class="dots"></span><span class="dots"></span>8431 
		                                        </span>

		                                        <a class="float-end card-remove" data-behavior="delete_card" data-url="http://dev.fitnessity.co/personal-profile/payment-delete?stripe_payment_method=pm_1Mw2jmCr65ASmcsqzrsPfU4t" data-cardid="130" title="Delete Card" class="delCard"><i class="fa fa-trash"></i> </a>
		                                    </div>
                                        </div>
									</div>
									
									<div class="col-lg-3 col-sm-6">
										<div class="cards-block dispalycard" style="cursor: pointer" data-name="" data-cvv="" data-cnumber="5556" data-month="2" data-year="2058" data-type="visa" data-id="121" data-ptype="update">
		                                    <div class="cards-content" style="background-image: url(http://dev.fitnessity.co/public/img/visa-card-bg.jpg );">
		                                        <img src="http://dev.fitnessity.co/public/images/creditcard/visa.jpg" alt="">
		                                        <span style="float:right"></span>
		                                        <p>Visa</p>
		                                        <span>
		                                            <span class="dots"></span><span class="dots"></span><span class="dots"></span><span class="dots"></span>5556 
		                                        </span>

		                                        <a class="float-end card-remove" data-behavior="delete_card" data-url="http://dev.fitnessity.co/personal-profile/payment-delete?stripe_payment_method=pm_1Mw2gLCr65ASmcsqdbN8Shj6" data-cardid="121" title="Delete Card" class="delCard"><i class="fa fa-trash"></i> </a>
		                                    </div>
                                        </div>
									</div>
									
									<div class="col-lg-3 col-sm-6">
										<div class="cards-block dispalycard" style="cursor: pointer" data-name="" data-cvv="" data-cnumber="8210" data-month="2" data-year="2040" data-type="mastercard" data-id="111" data-ptype="update">
		                                    <div class="cards-content" style="background-image: url(http://dev.fitnessity.co/public/img/visa-card-bg.jpg );">
		                                        <img src="http://dev.fitnessity.co/public/images/creditcard/mastercard.jpg" alt="">
		                                        <span style="float:right"></span>
		                                        <p>Mastercard</p>
		                                        <span>
		                                            <span class="dots"></span><span class="dots"></span><span class="dots"></span><span class="dots"></span>8210 
		                                        </span>

		                                        <a class="float-end card-remove" data-behavior="delete_card" data-url="http://dev.fitnessity.co/personal-profile/payment-delete?stripe_payment_method=pm_1Mw2aACr65ASmcsqyEo8vjqs" data-cardid="111" title="Delete Card" class="delCard"><i class="fa fa-trash"></i> </a>
		                                    </div>
                                        </div>
									</div>
									
									<div class="col-lg-3 col-sm-6">
										<div class="cards-block dispalycard" style="cursor: pointer" data-name="" data-cvv="" data-cnumber="1113" data-month="2" data-year="2050" data-type="discover" data-id="90" data-ptype="update">
		                                    <div class="cards-content" style=" background-image: url(http://dev.fitnessity.co/public/img/visa-card-bg.jpg );">
		                                        <img src="http://dev.fitnessity.co/public/images/creditcard/discover.jpg" alt="">
		                                        <span style="float:right"></span>
		                                        <p>Discover</p>
		                                        <span>
		                                            <span class="dots"></span><span class="dots"></span><span class="dots"></span><span class="dots"></span>1113 
		                                        </span>

		                                        <a class="float-end card-remove" data-behavior="delete_card" data-url="http://dev.fitnessity.co/personal-profile/payment-delete?stripe_payment_method=pm_1MpRLZCr65ASmcsqWiLKPGuE" data-cardid="90" title="Delete Card" class="delCard"><i class="fa fa-trash"></i> </a>
		                                    </div>
                                        </div>
									</div>
									
									<div class="col-lg-3 col-sm-6">
										<div class="cards-block addcard" style="cursor: pointer" data-name="" data-cvv="" data-cnumber="" data-month="" data-year="" data-type="" data-ptype="insert">
                                        <div class="cards-content" style=" background-image: url(http://dev.fitnessity.co/public/img/visa-card-bg.jpg);">
                                            <span style="text-align: center">Add New Card</span>
                                        </div>
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

@endsection