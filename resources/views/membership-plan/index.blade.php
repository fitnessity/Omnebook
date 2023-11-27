@inject('request', 'Illuminate\Http\Request')
@extends('layouts.business.header')

@section('content')

	@include('layouts.business.business_topbar')
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
								<div class="booking-titles text-center"><h4 class="fs-18">Plans & Pricing</h4></div>
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
												@foreach($plans as $p)
													<div class="col-lg-4 col-md-6 col-sm-6 mb-20">
														<div class="packages">
															<div>
																<img src="{{$p->getPic()}}" alt="">
															</div>
															<div class="basic-plan">
																<h1>{{$p->title}}</h1>
																<p>{{$p->heading}}</p>
															</div>
															<div class="v-plan-cart">
																<div class=" position-relative text-center">
																	<div class="d-flex justify-center align-center">
																		<sup class="text-sm me-1 mt-10">$</sup>
																		<h1 class="text1 text-5xl font-weight-medium font-red">{{$p->price_per_month}}</h1>
																		<h1 class="text2 text-5xl font-weight-medium font-red">{{$p->price_per_year / 12 }}</h1>
																		<sub class="text-sm font-weight-medium ms-1 mt-4">/month</sub>
																	</div>
																</div>
																<div class="price-list">
																	<label class="text1">USD {{$p->price_per_year}}/Year</label>
																</div>
															</div>

							
															<div class="v-plan-details">
																{!! $p->description !!}
															</div>
															<div class="width-100">
																<button onclick="getCardModal('{{$p->id}}','{{$p->price_per_month}}')" class="btn btn-red mt-25 width-100"  @if($p->price_per_month == 0) disabled @endif>Your Current Plan </button>
															</div>
														</div>
													</div>
													@endforeach
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
											<button type="buttom" class="btn btn-red" disabled> Start-14-day FREE trial </button>
										</div>
									</div>
									<div class="col-lg-4 col-md-5 col-sm-5">
										<div class="free-trial-img">
											<img src="{{url('dashboard-design/images/laptop-girl.png')}}" alt="">
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
													@foreach($features as $key=>$f)
														<div class="custom-table-data">
															<label>{{$f->name}}  
															<span type="button" class="plan-tlp" data-bs-toggle="tooltip" data-bs-placement="top" aria-label="	{{$f->tooltip_text}}" data-bs-original-title="{{$f->tooltip_text}}"><i class="fas fa-info"></i></span>
														</label>
														</div>
													@endforeach										
												</div>
												@foreach($plans as $p)
													<div class="col-md-2 @if(!$loop->last)fit-xop nopadding @endif @if($loop->last) pl-0 @endif">
														<div class="custom-table-header">
															<h1 class="text-muted fs-12 mb-1 text-uppercase"> {{$p->title}} </h1>
															<span class="text-muted fs-12 mb-0 text-uppercase"> @if($p->price_per_month != 0) ${{$p->price_per_month}}/MONTH @else FREE @endif  </span>
														</div>
														<div class="custom-table-data">
															<div class="check-right">
																<i class="fas fa-check"></i>
															</div>
														</div>
														@foreach(json_decode(@$p->featurs_details) as $i=> $f)
														<div class="custom-table-data">

															@if($f == 'Yes')
															<div class="check-right">
																<i class="fas fa-check"></i>
															</div>
															@elseif($f == 'No')
															<div class="check-wrong">
																<i class="fas fa-times"></i>
															</div>
															@elseif($f == 'Add On')
																<span class="badge badge-soft-red p-2"> ADD-ON AVAILABLE </span>
															@else
																<span class="badge badge-soft-red p-2"> {{$f}}</span>
															@endif
														</div>
														@endforeach
														<div class="custom-table-data-footer">
															<button onclick="getCardModal('{{$p->id}}','{{$p->price_per_month}}')"  class="btn btn-red" @if($p->price_per_month == 0) disabled @endif> Choose Plan </button>
														</div>
													</div>
												@endforeach
											</div>
										</div>
									</div>
								</div>
							</div>
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
											<div class="accordion-body">Checkout accepts all types of credit and debit cards.
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

<div class="modal fade card-form" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-modal="true">
	<div class="modal-dialog modal-dialog-centered" id="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body card-form-data"></div>
		</div>
	</div>
</div>
	
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

	function getCardModal(id,price){
		$.ajax({
            url: '{{route("choose-plan.getCardForm")}}',
            type: 'GET',
            data: {
            	'id':id,
            }, 
            success: function (response) {
            	$('.card-form-data').html(response);
            	$('.card-form').modal('show');
            }
        });
	}
</script>

@endsection