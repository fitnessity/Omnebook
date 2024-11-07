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
										<label>Settings</label>
									</div>
								</div> <!--end col-->
						  </div>	
							<div class="row">
								<div class="col-12">
									<div class="card">
										<div class="card-body">
											<div class="row">
												<div class="col-12 col-lg-4 col-md-4">
													<div class="reports-title">
														<label>Business Details Settings</label>
													</div>
												</div>
												<div class="col-12 col-lg-6 col-md-8">
													<div class="card card-body box-border">
														<div class="d-grid align-items-center">
															<div class="report-links">
																<a href="#">Company Details</a>
															</div>
															<div class="report-links">
																<a href="#">Company Specifics</a>
															</div>
															<div class="report-links">
																<a href="{{route('business.tax.index')}}">Taxes</a>
															</div>
															<div class="report-links remove-border">
																<a href="#">Blocked Days Off</a>
															</div>
														</div>
													</div>												
												</div>
											</div>
											
											<div class="row">
												<div class="col-12 col-lg-4 col-md-4">
													<div class="reports-title">
														<label>Customer Settings </label>
													</div>
												</div>
												<div class="col-12 col-lg-6 col-md-8">
													<div class="card card-body box-border">
														<div class="d-grid align-items-center">
															<div class="report-links">
																<a href="#">New Customer</a>
															</div>
															<div class="report-links">
																<a href="#">Gender Options</a>
															</div>
															<div class="report-links">
																<a href="#">Allow Pronouns Display</a>
															</div>
															<div class="report-links remove-border">
																<a href="#">Referrals</a>
															</div>
														</div>
													</div>												
												</div>
											</div>
																					
											<div class="row">
												<div class="col-12 col-lg-4 col-md-4">
													<div class="reports-title">
														<label>Terms & Agreements</label>
													</div>
												</div>
												<div class="col-12 col-lg-6 col-md-8">
													<div class="card card-body box-border">
														<div class="d-grid align-items-center">
															<div class="report-links">
																<a href="#">Terms, Conditions, FAQ</a>
															</div>
															<div class="report-links">
																<a href="#">Liability Wavier</a>
															</div>
															<div class="report-links">
																<a href="#">Contract Agreement</a>
															</div>
															<div class="report-links">
																<a href="#">Refund Policy</a>
															</div>
															<div class="report-links">
																<a href="#">Cleaning Protocols</a>
															</div>
															<div class="report-links remove-border">
																<a href="#">Product Return Policy</a>
															</div>
														</div>
													</div>												
												</div>
											</div>
											
											
											<div class="row">
												<div class="col-12 col-lg-4 col-md-4">
													<div class="reports-title">
														<label>Subscriptions & Payments</label>
													</div>
												</div>
												<div class="col-12 col-lg-6 col-md-8">
													<div class="card card-body box-border">
														<div class="d-grid align-items-center">
															<div class="report-links">
																<a href="{{route('business.subscription.index')}}">Manage Account</a>
															</div>
															<!-- <div class="report-links">
																<a href="#">Manage Card On File</a>
															</div>
															<div class="report-links remove-border">
																<a href="#">Payment History</a>
															</div> -->
														</div>
													</div>												
												</div>
											</div>


											<div class="row">
												<div class="col-12 col-lg-4 col-md-4">
													<div class="reports-title">
														<label>Side Panel Color</label>
														<div id="success-message-panel" style="display: none; background-color: #d4edda; color: #155724; padding: 10px; margin-top: 10px; border: 1px solid #c3e6cb; border-radius: 5px;"></div>
													</div>
												</div>
												<div class="col-12 col-lg-6 col-md-8">
													<div class="card card-body box-border">
														<div class="d-grid align-items-center">
															<form>
																{{-- <input type="radio" id="black" name="fav_language" value="black" checked> --}}
																<input type="radio" id="black" name="fav_language" value="black" 
																{{ isset($sidecolor) && $sidecolor->side_panel_color == 1 ? 'checked' : '' }} onchange="updateSidePanelColor('black', {{ $sidecolor->id }})">																		
																<label for="black" class="mr-15">Black</label>
																<input type="radio" id="white" name="fav_language" value="white" {{ isset($sidecolor) && $sidecolor->side_panel_color == 0 ? 'checked' : '' }}  onchange="updateSidePanelColor('white', {{ $sidecolor->id }})">
																<label for="white">White</label>
															</form>
														</div>
													</div>												
												</div>
											</div>
											
										</div>
									</div>
								</div>
							</div>
						</div> <!-- end .h-100-->
          </div> <!-- end col -->
        </div>
			</div>
		</div>
	</div>

	
@include('layouts.business.footer')
@include('layouts.business.scripts')
<script>
	function updateSidePanelColor(color, businessId) {
		$.ajax({
			url: "/business/" + businessId + "/settings_store",  
			type: "POST",
			data: {
				_token: "{{ csrf_token() }}", 
				side_panel_color: color 
			},
			success: function(response) {
				$('#success-message').text(response.message).show();

				setTimeout(function() {
					$('#success-message-panel').fadeOut();
				}, 3000);
				window.location.reload();
			},
			error: function(xhr, status, error) {
				if (xhr.status === 422) {
					var errors = xhr.responseJSON.errors;
				} 
			}
		});
	}
</script>

@endsection