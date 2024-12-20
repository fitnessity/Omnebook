@inject('request', 'Illuminate\Http\Request')
@extends('layouts.business.header')

@section('content')

	@include('layouts.business.business_topbar')
	<div class="main-content">
		<div class="page-content">
			<div class="container-fluid">
				<div class="row">
		          	<div class="col">
			            <div class="h-100">
			              	<div class="row mb-3">
								<div class="col-6">
									<div class="page-heading">
										<h1>Set Taxes</h1>
									</div>
								</div> <!--end col-->
						 	</div>	
						  	<div class="row">
								<div class="col-12">
									<div class="card">
										<div class="card-body">
											<div class="row">
												<form action="{{route('business.tax.store')}}" method="post" >
													@csrf
													<div class="col-lg-3 col-md-3">
														<div class="form-group mt-10 reports-title">
															<label>Sales Tax</label>
															<input type="text" class="form-control" name="salesTax" id="salesTax" size="30" value="{{$sales_tax}}">
														</div>
													</div>
													<div class="col-lg-3 col-md-3">
														<div class="form-group mt-10 reports-title">
															<label>Memberships & Dues Tax</label>
															<input type="text" class="form-control" name="duesTax" id="duesTax"  value="{{$dues_tax}}">
														</div>
													</div>
													<div class="col-lg-3 col-md-3">
														<button type="submit" class="btn btn-red mt-10">Save</button>
													</div>
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
		</div>
	</div>
	include('layouts.business.footer')
	@include('layouts.business.scripts')


@endsection