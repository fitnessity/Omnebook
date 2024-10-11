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
							<label>Pricing Plans</label>
						</div>
					</div>
                </div><!--end row-->
				
				<div class="row">
					<div class="col-12">
						<div class="card">
							<div class="card-body">
								<div class="booking-titles text-center">
									<h4 class="fs-18">Plans & Pricing</h4>
									<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
								</div>
								<div class="price-switch">
									<div class="row">
										<div class="col-md-12">
											 <div class="top">
												<div class="toggle-btn">
													<span>Monthly</span>
													<label class="switch">
														<input type="checkbox" id="checbox" onclick="check()" ; />
														<span class="slider round"></span>
													</label>
													<span>Annual</span>
												</div>
											</div>
										</div>
									</div>
									<div class="row justify-content-center">
										<div class="col-xl-10 col-lg-10 mb-120">
											<div class="row">
												<div class="col-lg-4 col-md-6 col-sm-6 mb-20">
													<div class="packages">
														<div>
															<img src="http://dev.fitnessity.co/public/dashboard-design/images/dollar-coins.png" alt="">
														</div>
														<div class="basic-plan">
															<h1>Pay as you go</h1>
															<p>A simple start for everyone</p>
														</div>
														<div class="v-plan-cart">
															<div class=" position-relative text-center">
																<div class="d-flex justify-center align-center">
																	<sup class="text-sm me-1 mt-10">$</sup>
																	<h1 class="text1 text-5xl font-weight-medium font-red">0 </h1>
																	<h1 class="text2 text-5xl font-weight-medium font-red">0</h1>
																	<sub class="text-sm font-weight-medium ms-1 mt-4">/month</sub>
																</div>
															</div>
															<div class="price-list">
																<label class="text1">Free</label>
															</div>
														</div>
														<div class="v-plan-details">
															<ul>
																<li>100 responses a month</li>
																<li>Unlimited forms and surve</li>
																<li>Unlimited fields</li>
																<li>Basic form creation tools</li>
																<li>Up to 2 subdomains</li>
															</ul>
														</div>
														<div class="width-100">
															<button type="submit" class="btn btn-red mt-25 width-100">Your Current Plan </button>
														</div>
													</div>
												</div>
												<div class="col-lg-4 col-md-6 col-sm-6 mb-20">
													<div class="packages popular-box">
														<div class="pxyz">
															<span class="badge badge-soft-popular text-uppercase">Popular </span>
														</div>
														<div>
															<img src="http://dev.fitnessity.co/public/dashboard-design/images/3d-safe-box.png" alt="">
														</div>
														<div class="basic-plan">
															<h1>Basic </h1>
															<p>For small to medium businesses</p>
														</div>
														<div class="v-plan-cart">
															<div class=" position-relative text-center">
																<div class="d-flex justify-center align-center">
																	<sup class="text-sm me-1 mt-10">$</sup>
																	<h1 class="text1 text-5xl font-weight-medium font-red">42 </h1>
																	<h1 class="text2 text-5xl font-weight-medium font-red">38</h1>
																	<sub class="text-sm font-weight-medium ms-1 mt-4">/month</sub>
																</div>
															</div>
															<div class="price-list">
																<label class="text1">USD 460/Year</label>
															</div>
														</div>
														<div class="v-plan-details">
															<ul>
																<li>Unlimited responses</li>
																<li>Unlimited forms and surv..</li>
																<li>Instagram profile page</li>
																<li>Google Docs integration</li>
																<li>Custom “Thank you” pag..</li>
															</ul>
														</div>
														<div class="width-100">
															<button type="submit" class="btn btn-black mt-25 width-100">Upgrade</button>
														</div>
													</div>
												</div>
												<div class="col-lg-4 col-md-6 col-sm-6 mb-20">
													<div class="packages">
														<div>
															<img src="http://dev.fitnessity.co/public/dashboard-design/images/3d-space-rocket.png" alt="">
														</div>
														<div class="basic-plan">
															<h1>Pro</h1>
															<p>Solution for big organizations</p>
														</div>
														<div class="v-plan-cart">
															<div class=" position-relative text-center">
																<div class="d-flex justify-center align-center">
																	<sup class="text-sm me-1 mt-10">$</sup>
																	<h1 class="text1 text-5xl font-weight-medium font-red">84</h1>
																	<h1 class="text2 text-5xl font-weight-medium font-red">57</h1>
																	<sub class="text-sm font-weight-medium ms-1 mt-4">/month</sub>
																</div>
															</div>
															<div class="price-list">
																<label class="text1">USD 690/Year</label>
															</div>
														</div>
														<div class="v-plan-details">
															<ul>
																<li>PayPal payments</li>
																<li>Logic Jumps</li>
																<li>File upload with 5GB stora</li>
																<li>Custom domain support</li>
																<li>Stripe integration</li>
															</ul>
														</div>
														<div class="width-100">
															<button type="submit" class="btn btn-red mt-25 width-100">Upgrade</button>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
                            </div>	
							<div class="bg-light-red">
								<div class="row">
									<div class="col-lg-8 col-md-7 col-sm-7">
										<div class="free-trial-text">
											<h3> Still not convinced? Start with a 14-day FREE trial! </h3>
											<p>You will get full access to all the features for 14 days. </p>
											<button type="submit" class="btn btn-red "> Start-14-day FREE trial </button>
										</div>
									</div>
									<div class="col-lg-4 col-md-5 col-sm-5">
										<div class="free-trial-img">
											<img src="http://dev.fitnessity.co/public/dashboard-design/images/laptop-girl.png" alt="">
										</div>
									</div>
								</div>
							</div>	
							
							<div class="card-body">	
								<div class="booking-titles text-center mt-70">
									<h4 class="fs-18">Pick a plan that works best for you</h4>
									<p>Stay cool, we have a 48-hour money back guarantee!</p>
								</div>
								<div class="row">
									<div class="col-lg-12">	 
										<div class="fit-price-plan-table">
											<div class="row">
												<div class="col-md-6 fit-xop">
													<div class="custom-table-header">
														<h1 class="text-muted fs-12 mb-1 text-uppercase">FEATURES </h1>
														<span class="text-muted fs-12 mb-0 text-uppercase"> Native Front Features </span>
													</div>
													<div class="custom-table-data">
														<label>14-days free trial</label>
													</div>
													<div class="custom-table-data">
														<label>No user limit</label>
													</div>
													<div class="custom-table-data">
														<label>Product Support</label>
													</div>
													<div class="custom-table-data">
														<label>Email Support</label>
													</div>
													<div class="custom-table-data">
														<label>Integrations</label>
													</div>
													<div class="custom-table-data">
														<label>Removal of Front branding</label>
													</div>
													<div class="custom-table-data">
														<label>Active maintenance & support</label>
													</div>
													<div class="custom-table-data">
														<label>Data storage for 365 days</label>
													</div>
													<div class="custom-table-data-footer">
														<label>Data storage for 365 days </label>
													</div>											
												</div>
												<div class="col-md-2 fit-xop nopadding">
													<div class="custom-table-header">
														<h1 class="text-muted fs-12 mb-1 text-uppercase"> BASIC </h1>
														<span class="text-muted fs-12 mb-0 text-uppercase"> FREE </span>
													</div>
													<div class="custom-table-data">
														<div class="check-right">
															<i class="fas fa-check"></i>
														</div>
													</div>
													<div class="custom-table-data">
														<div class="check-wrong">
															<i class="fas fa-times"></i>
														</div>
													</div>
													<div class="custom-table-data">
														<div class="check-wrong">
															<i class="fas fa-times"></i>
														</div>
													</div>
													<div class="custom-table-data">
														<div class="check-wrong">
															<i class="fas fa-times"></i>
														</div>
													</div>
													<div class="custom-table-data">
														<div class="check-wrong">
															<i class="fas fa-times"></i>
														</div>
													</div>
													<div class="custom-table-data">
														<div class="check-wrong">
															<i class="fas fa-times"></i>
														</div>
													</div>
													<div class="custom-table-data">
														<div class="check-wrong">
															<i class="fas fa-times"></i>
														</div>
													</div>
													<div class="custom-table-data">
														<div class="check-wrong">
															<i class="fas fa-times"></i>
														</div>
													</div>
													<div class="custom-table-data-footer">
														<button type="submit" class="btn btn-red"> Choose Plan </button>
													</div>
													
												</div>
												<div class="col-md-2 fit-xop nopadding">
													<div class="custom-table-header">
														<h1 class="text-muted fs-12 mb-0 text-uppercase"> STANDARD 
															<div class="standard-price">
																<i class="far fa-star"></i>
															</div>
														</h1>
														<span class="text-muted fs-12 mb-0 text-uppercase">  $7.5/MONTH  </span>
													</div>
													<div class="custom-table-data">
														<div class="check-right">
															<i class="fas fa-check"></i>
														</div>
													</div>
													<div class="custom-table-data">
														<div class="check-wrong">
															<i class="fas fa-times"></i>
														</div>
													</div>
													<div class="custom-table-data">
														<div class="check-right">
															<i class="fas fa-check"></i>
														</div>
													</div>
													<div class="custom-table-data">
														<span class="badge badge-soft-red p-2"> ADD-ON AVAILABLE </span>
													</div>
													<div class="custom-table-data">
														<div class="check-right">
															<i class="fas fa-check"></i>
														</div>
													</div>
													<div class="custom-table-data">
														<span class="badge badge-soft-red p-2"> ADD-ON AVAILABLE </span>
													</div>
													<div class="custom-table-data">
														<div class="check-wrong">
															<i class="fas fa-times"></i>
														</div>
													</div>
													<div class="custom-table-data">
														<div class="check-wrong">
															<i class="fas fa-times"></i>
														</div>
													</div>
													<div class="custom-table-data-footer">
														<button type="submit" class="btn btn-black"> Choose Plan </button>
													</div>
												</div>
												<div class="col-md-2 pl-0">
													<div class="custom-table-header">
														<h1 class="text-muted fs-12 mb-1 text-uppercase"> ENTERPRISE </h1>
														<span class="text-muted fs-12 mb-0 text-uppercase"> $16/MONTH </span>
													</div>
													<div class="custom-table-data">
														<div class="check-right">
															<i class="fas fa-check"></i>
														</div>
													</div>
													<div class="custom-table-data">
														<div class="check-right">
															<i class="fas fa-check"></i>
														</div>
													</div>
													<div class="custom-table-data">
														<div class="check-right">
															<i class="fas fa-check"></i>
														</div>
													</div>
													<div class="custom-table-data">
														<div class="check-right">
															<i class="fas fa-check"></i>
														</div>
													</div>
													<div class="custom-table-data">
														<div class="check-right">
															<i class="fas fa-check"></i>
														</div>
													</div>
													<div class="custom-table-data">
														<div class="check-right">
															<i class="fas fa-check"></i>
														</div>
													</div>
													<div class="custom-table-data">
														<div class="check-right">
															<i class="fas fa-check"></i>
														</div>
													</div>
													<div class="custom-table-data">
														<div class="check-right">
															<i class="fas fa-check"></i>
														</div>
													</div>
													<div class="custom-table-data-footer">
														<button type="submit" class="btn btn-red"> Choose Plan </button>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
							
							<!--<div class="card-body">	
								<div class="booking-titles text-center mt-70">
									<h4 class="fs-18">Pick a plan that works best for you</h4>
									<p>Stay cool, we have a 48-hour money back guarantee!</p>
								</div>
								<div class="row">
									<div class="col-lg-12">
										<div class="priceplan-table">
											 <div class="table-responsive ">
												<table class="table table-borderless table-nowrap align-middle mb-25 mt-25">
													<thead class="table-light">
														<tr class="text-muted">
															<th scope="col"> 
																<h1 class="text-muted fs-12 mb-0 text-uppercase">FEATURES </h1>
																<span class="text-muted fs-12 mb-0 text-uppercase"> Native Front Features </span>
															</th>
															<th scope="col" style="width: 20%;">
																<h1 class="text-muted fs-12 mb-0 text-uppercase"> BASIC </h1>
																<span class="text-muted fs-12 mb-0 text-uppercase"> FREE </span>
															</th>
															<th scope="col">
																<h1 class="text-muted fs-12 mb-0 text-uppercase"> STANDARD 
																	<div class="standard-price">
																		<i class="far fa-star"></i>
																	</div>
																</h1>
																<span class="text-muted fs-12 mb-0 text-uppercase"> $7.5/MONTH </span>
															</th>
															<th scope="col" style="width: 16%;">
																<h1 class="text-muted fs-12 mb-0 text-uppercase"> ENTERPRISE </h1>
																<span class="text-muted fs-12 mb-0 text-uppercase"> $16/MONTH </span>
															</th>
														</tr>
													</thead>

													<tbody>
														<tr>
															<td>14-days free trial</td>
															<td>
																<div class="check-right">
																	<i class="fas fa-check"></i>
																</div>
															</td>
															<td>
																<div class="check-right">
																	<i class="fas fa-check"></i>
																</div>
															</td>
															<td>
																<div class="check-right">
																	<i class="fas fa-check"></i>
																</div>
															</td>
														</tr>
														<tr>
															<td>No user limit</td>
															 <td>
																<div class="check-wrong">
																	<i class="fas fa-times"></i>
																</div>
															</td>
															<td>
																<div class="check-wrong">
																	<i class="fas fa-times"></i>
																</div>
															</td>
															<td>
																<div class="check-right">
																	<i class="fas fa-check"></i>
																</div>
															</td>
														</tr>
														<tr>
															<td>Product Support</td>
															 <td>
																<div class="check-wrong">
																	<i class="fas fa-times"></i>
																</div>
															</td>
															<td>
																<div class="check-right">
																	<i class="fas fa-check"></i>
																</div>
															</td>
															<td>
																<div class="check-right">
																	<i class="fas fa-check"></i>
																</div>
															</td>
														</tr>
														<tr>
															<td>Email Support</td>
															  <td>
																<div class="check-wrong">
																	<i class="fas fa-times"></i>
																</div>
															</td>
															<td>
																<span class="badge badge-soft-red"> ADD-ON AVAILABLE </span>
															</td>
															<td>
																<div class="check-right">
																	<i class="fas fa-check"></i>
																</div>
															</td>
														</tr>
														<tr>
															<td>Integrations</td>
															<td>
																<div class="check-wrong">
																	<i class="fas fa-times"></i>
																</div>
															</td>
															<td>
																<div class="check-right">
																	<i class="fas fa-check"></i>
																</div>
															</td>
															<td>
																<div class="check-right">
																	<i class="fas fa-check"></i>
																</div>
															</td>
														</tr>
														<tr>
															<td>Removal of Front branding</td>
															<td>
																<div class="check-wrong">
																	<i class="fas fa-times"></i>
																</div>
															</td>
															<td>
																<span class="badge badge-soft-red"> ADD-ON AVAILABLE </span>
															</td>
															<td>
																<div class="check-right">
																	<i class="fas fa-check"></i>
																</div>
															</td>
														</tr>
														<tr>
															<td>Active maintenance & support</td>
															 <td>
																<div class="check-wrong">
																	<i class="fas fa-times"></i>
																</div>
															</td>
															<td>
																<div class="check-wrong">
																	<i class="fas fa-times"></i>
																</div>
															</td>
															<td>
																<div class="check-right">
																	<i class="fas fa-check"></i>
																</div>
															</td>
														</tr>
														<tr>
															<td>Data storage for 365 days</td>
															 <td>
																<div class="check-wrong">
																	<i class="fas fa-times"></i>
																</div>
															</td>
															<td>
																<div class="check-wrong">
																	<i class="fas fa-times"></i>
																</div>
															</td>
															<td>
																<div class="check-right">
																	<i class="fas fa-check"></i>
																</div>
															</td>
														</tr>
														<tr>
															<td>Data storage for 365 days </td>
															 <td>
																<button type="submit" class="btn btn-red"> Choose Plan </button>
															</td>
															<td>
																<button type="submit" class="btn btn-black"> Choose Plan </button>
															</td>
															<td>
																<button type="submit" class="btn btn-red"> Choose Plan </button>
															</td>
														</tr>
													</tbody>
												</table>
											</div>
										</div>
									</div>
								</div>
							</div>-->
						</div>
						<div class="row justify-content-center">
							<div class="col-lg-10 col-md-10  col-sm-12 col-12">
								<div class="booking-titles text-center mb-20 mt-20">
									<h4 class="fs-18">FAQ's </h4>
									<p>Let us help answer the most common questions. </p>
								</div>
								<div class="accordion accordion-border-box" id="genques-accordion">
									<div class="accordion-item shadow">
										<h2 class="accordion-header" id="genques-headingOne">
											<button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#genques-collapseOne" aria-expanded="true" aria-controls="genques-collapseOne">
												What counts towards the 100 responses limit?
											</button>
										</h2>
										<div id="genques-collapseOne" class="accordion-collapse collapse" aria-labelledby="genques-headingOne" data-bs-parent="#genques-accordion">
											<div class="accordion-body">
												Donec placerat, lectus sed mattis semper, neque lectus feugiat lectus, varius pulvinar diam eros in elit. Pellentesque convallis laoreet laoreet.Donec placerat, lectus sed mattis semper, neque lectus feugiat lectus, varius pulvinar diam eros in elit. Pellentesque convallis laoreet laoreet.
											</div>
										</div>
									</div>
									<div class="accordion-item shadow">
										<h2 class="accordion-header" id="genques-headingTwo">
											<button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#genques-collapseTwo" aria-expanded="false" aria-controls="genques-collapseTwo">
												How do you process payments?
											</button>
										</h2>
										<div id="genques-collapseTwo" class="accordion-collapse collapse" aria-labelledby="genques-headingTwo" data-bs-parent="#genques-accordion">
											<div class="accordion-body">
												We accept Visa®, MasterCard®, American Express®, and PayPal®. So you can be confident that your credit card information will be kept safe and secure.
											</div>
										</div>
									</div>
									<div class="accordion-item shadow">
										<h2 class="accordion-header" id="genques-headingThree">
											<button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#genques-collapseThree" aria-expanded="false" aria-controls="genques-collapseThree">
												What payment methods do you accept?
											</button>
										</h2>
										<div id="genques-collapseThree" class="accordion-collapse collapse" aria-labelledby="genques-headingThree" data-bs-parent="#genques-accordion">
											<div class="accordion-body">
												2Checkout accepts all types of credit and debit cards.
											</div>
										</div>
									</div>
									<div class="accordion-item shadow">
										<h2 class="accordion-header" id="genques-headingFour">
											<button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#genques-collapseFour" aria-expanded="false" aria-controls="genques-collapseFour">
												Do you have a money-back guarantee?
											</button>
										</h2>
										<div id="genques-collapseFour" class="accordion-collapse collapse" aria-labelledby="genques-headingFour" data-bs-parent="#genques-accordion">
											<div class="accordion-body">
												Yes. You may request a refund within 30 days of your purchase without any additional explanations.
											</div>
										</div>
									</div>
								</div><!--end accordion-->
							</div>
						</div>
					</div>
				</div>
				
            </div><!-- container-fluid -->
        </div><!-- End Page-content -->
     </div><!-- end main content-->
</div><!-- END layout-wrapper -->

	
	@include('layouts.business.footer')
<script>
	function check() {
	  	var checkBox = document.getElementById("checbox");
	  	var text1 = $(".text1");
	  	var text2 = $(".text2");

	  	if (checkBox.checked) {
	    	text1.css("display", "block");
	    	text2.css("display", "none");
	  	} else {
	    	text1.css("display", "none");
	    	text2.css("display", "block");
	  	}
	}
	check();
</script>

@endsection