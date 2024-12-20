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
						<div class="page-heading"><h1>Pricing Plans</h1></div>
					</div>
            </div><!--end row-->

				@if (session('stripeErrorMsg'))
              <div class='form-row row'>
	               <div class='col-md-12 error form-group'>
	                    <div class='alert-danger alert'> {{ session('stripeErrorMsg') }}</div>
	               </div>
	            </div>
          	@endif

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
														<input type="checkbox" id="plan_time" onclick="check();"/>
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
															<div><img src="{{$p->getPic()}}" alt=""></div>
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
				
															<div class="v-plan-details">{!! $p->description !!}</div>
															<div class="width-100">
																<?php /*?><button onclick="getCardModal('{{$p->id}}','{{$p->price_per_month}}')" class="btn btn-red mt-25 width-100"  @if($p->price_per_month == 0) disabled @endif> @if($p->id == @$currentPlan->plan_id) Current Plan @else Choose Plan  @endif</button><?php */?>
                                                <button onclick="getCardModal('{{$p->id}}','{{$p->price_per_month}}')" class="btn btn-red mt-25 width-100 @if($p->id == @$currentPlan->plan_id) {{$currentPlan->payment_for ?? 'month'}} @endif"  @if($p->id == @$currentPlan->plan_id) disabled @endif id="plnbtn2"> @if($p->id == @$currentPlan->plan_id) Current Plan @else Choose Plan  @endif</button>
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
									<?php /*?><p>Stay cool, we have a 48-hour money back guarantee!</p><?php */?>
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
															<div class="check-right"><i class="fas fa-check"></i></div>
														</div>
														@foreach(json_decode(@$p->featurs_details) as $i=> $f)
														<div class="custom-table-data">
															@if($f == 'Yes')
																<div class="check-right"><i class="fas fa-check"></i></div>
															@elseif($f == 'No')
																<div class="check-wrong"><i class="fas fa-times"></i></div>
															@elseif($f == 'Add On')
																<span class="badge badge-soft-red p-2"> ADD-ON AVAILABLE </span>
															@else
																<span class="badge badge-soft-red p-2"> {{$f}}</span>
															@endif
														</div>
														@endforeach
														<div class="custom-table-data-footer">
															<?php /*?><button onclick="getCardModal('{{$p->id}}','{{$p->price_per_month}}')"  class="btn btn-red" @if($p->price_per_month == 0) disabled @endif> @if($p->id == @$currentPlan->plan_id) Current Plan @else Choose Plan  @endif </button><?php */?>
                                             <button onclick="getCardModal('{{$p->id}}','{{$p->price_per_month}}')"  class="btn btn-red @if($p->id == @$currentPlan->plan_id) {{$currentPlan->payment_for ?? 'month'}} @endif" @if($p->id == @$currentPlan->plan_id) disabled @endif  id="plnbtn1"> @if($p->id == @$currentPlan->plan_id) Current Plan @else Choose Plan  @endif </button>
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

									@forelse(@$faqs as $i=>$f)
										<div class="accordion-item shadow">
											<h2 class="accordion-header" id="genques-heading{{$i}}">
												<button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#genques-collapse{{$i}}" aria-expanded="false" aria-controls="genques-collapse{{$i}}">{{$f->title}}</button>
											</h2>
											<div id="genques-collapse{{$i}}" class="accordion-collapse collapse" aria-labelledby="genques-heading{{$i}}" data-bs-parent="#genques-accordion">
												<div class="accordion-body">{!!$f->content!!}</div>
											</div>
										</div>
									@empty
									@endforelse
								</div>
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
	  	var checkBox = document.getElementById("plan_time");
	  	var text1 = $(".text1");
	  	var text2 = $(".text2");

	  	if (checkBox.checked) {
	  		$('.year').prop('disabled',true)
	  		$('.month').prop('disabled',false);
	    	text1.css("display", "block");
	    	text2.css("display", "none");
	  	} else {
	  		$('.year').prop('disabled',false)
	  		$('.month').prop('disabled',true);
	    	text1.css("display", "none");
	    	text2.css("display", "block");
	  	}
	}
	check();

	function getCardModal(id,price){
		// alert('33');
		var type = '';
		if ($("#plan_time").is(":checked")) {
			type = 'year';
	   } else {
	   	type = 'month';
	   } 

	   if(price != 0){
	   	$.ajax({
            url: '{{route("choose-plan.getCardForm")}}',
            type: 'GET',
            data: {
            	'type':type,
            	'id':id,
            }, 
            success: function (response) {
            	$('.card-form-data').html(response);
            	$('.card-form').modal('show');
            }
        });
	   }else{
	   	if(confirm('This is free plan. Are you sure you want to proceed?')){
		   	$.ajax({
	            url: '{{route("choose-plan.store")}}',
	            type: 'POST',
	            data: {
	            	'_token':'{{csrf_token()}}',
	            	'type':type,
	            	'plan':id,
	            	'total':price,
	            }, 
	            success: function (response) {
	            	window.location = response;	
	            }
	        });
		  	}
	   }
	}
</script>

@endsection