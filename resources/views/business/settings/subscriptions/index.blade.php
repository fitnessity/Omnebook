@inject('request', 'Illuminate\Http\Request')
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
            <div class="row">
               <div class="col">
                  <div class="h-100">
							<div class="row mb-3">
								<div class="col-12">
									<div class="page-heading">
										<a href="{{route('business.settings.index')}}" class="btn btn-red">Back</a>
									</div>
								</div>
								<div class="col-6">
									<div class="page-heading">
										<label>Fitnessity Subscriptions</label>
									</div>
								</div><!--end col-->
							</div> <!--end row-->

							@if(session('success'))
							   <div class="alert alert-success">
							        {{ session('success') }}
							   </div>
							@endif

							<div class="row">
								<div class="col-md-12">
									<div class="card">
										<div class="card-header align-items-center d-flex">
											<h4 class="card-title mb-0 flex-grow-1"> </h4>
											<div class="flex-shrink-0">
												<div class="form-check form-switch form-switch-right form-switch-md">
													<label class="form-label text-muted text-uppercase">Card Number</label>
													<div>
														<label class="form-label text-muted text-uppercase">{{ Auth::user()->default_card ? '*'.Auth::user()->default_card : 'N/A'}}</label>
													</div>
												</div>
											</div>
											<div class="flex-shrink-1 ">
												<a data-bs-toggle="modal" data-bs-target=".editcard">
													<i class="fas fa-pencil-alt fs-15"></i>
												</a>
											</div>
										</div>
										<div class="card-body card-350-body mb-25">
											<div class="row">
												<div class="col-xxl-12 col-lg-12 col-md-12 col-sm-12">
													<div class="row y-middle mmb-10">
														<div class="col-lg-9 col-md-7">
															<div class="subscriptions-info mt-10 mb-10">
																@if(@$currentPlan)
																	<h1>{{@$currentPlan ? @$currentPlan->plan->title : 'N/A'}}</h1>
																	<span>
																			Billed on {{ date('m/d/Y',strtotime($currentPlan->starting_date)) }}: ${{$currentPlan->amount}} @if($currentPlan->payment_for) / {{ucfirst($currentPlan->payment_for)}} @endif
																	</span>
																@else
																	<h1>There is no active plan available.</h1>
																@endif
																<span>{{Auth::user()->full_name}}</span>
																@if(@$currentPlan->amount == 0)
																	<span>You have {{Auth::user()->chkDaysLeft()}} Days in your trial left</span>
																@endif
																
															</div>
														</div>
														<div class="col-lg-3 col-md-5">
															<div class="text-right">
																@if(@$currentPlan)
																	<span class="font-black font-bold">Current Plan </span>
																	<a class="btn btn-red" href="{{route('choose-plan.index')}}">Switch Plan</a>
																@else
																	<a class="btn btn-red" href="{{route('choose-plan.index')}}">Buy Plan</a>
																@endif
															</div>
														</div>
													</div>
												</div>
											</div>
										</div><!-- end cardbody -->
									</div><!-- end card -->
								</div><!--end col-->
							</div><!--end row-->	

							<div class="row">
								<div class="col-md-12">
									<div class="card">
										<div class="card-body card-350-body mb-25">
											<div class="row">
												<div class="invoices-select">
													<label class="fs-16 mr-5">Invoices</label>
													<select class="form-select mb-3 width-30" aria-label="Default select example" onchange="getData(this.value)">
                                        	<option value="all">All available years </option>
                                        	@forelse(@$years as $y)
	                                        	<option value="{{$y}}">{{$y}}</option>
	                                       @empty
	                                       @endforelse
                                    	</select>
												</div>

												<div>
													<p class="fs-12">Older invoices may not be displayed. To retrieve these invoices, contact fitnessity customer support</p>
												</div>
												<div class="col-xxl-12 col-lg-12 col-md-12 col-sm-12">
													<div class="scheduler-table">
														<div class="table-responsive">
															<table class="table mb-0">
																<thead>
																	<tr>
																		<th>Invoice Date</th>
																		<th>Invoice</th>
																		<th>Amount</th>
																		<th>Download PDF</th>
																	</tr>
																</thead>
																<tbody id="plandata">
																	@forelse($plans as $p)
																	<tr>
																		<td><p class="mb-0">{{date('m/d/Y',strtotime($p->starting_date))}}</p></td>
																		<td><p class="mb-0">{{$p->invoice_no}}</p></td>
																		<td><p class="mb-0">$ {{$p->amount}}</p></td>
																		<td><a onclick="downloadpdf({{$p->id}},'{{$p->invoice_no}}');"><i class="fas fa-download"></i></a></td>
																	</tr>
																	@empty
																		<tr><td colspan="4" class="text-center">No Data Found</td></tr>
																	@endforelse
																</tbody>
															</table>
														</div>
													</div>
												</div>
											</div>
										</div><!-- end cardbody -->
									</div><!-- end card -->
								</div><!--end col-->
							</div><!--end row-->
						</div> <!-- end .h-100-->
               </div> <!-- end col -->
            </div>
         </div>
      </div>
   </div>
</div>
	 
<div class="modal fade editcard" tabindex="-1" aria-labelledby="mySmallModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="myModalLabel"> </h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body">
					{!!$cardForm!!}
			</div>
		</div>
	</div>
</div>
	
@include('layouts.business.footer')
@include('layouts.business.scripts')
	
<script type="text/javascript">
	function  getData(val) {
		$.ajax({
			url:'{{route('business.get_plan_html')}}',
			type:'post',
			data: {
				_token: '{{csrf_token()}}',
				year: val,
			},
			success: function(response){
				$('#plandata').html(response);
			},
		});
	}	

	function downloadpdf(id,name){
		var downloadUrl = '{{ route("business.subscription.export") }}' +'?id=' + id ;
		filename = name != '' ? name+'.pdf' : 'invoice.pdf';
		var link = document.createElement('a');
		link.href = downloadUrl;
		link.download = filename;
		document.body.appendChild(link);
		link.click();
		document.body.removeChild(link);
	}
</script>

@endsection