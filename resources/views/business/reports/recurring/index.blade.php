@inject('request', 'Illuminate\Http\Request')
@extends('layouts.business.header')

@section('content')
<style>
	
	@media print {
		.printnone {
			display: none !important;
		}

		.exclude-from-print {
			display: block !important;
		}
	}
</style>

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
                     <div class="row mb-3 printnone">
                     	<div class="col-12">
									<div class="page-heading">
										<a href="{{route('business.reports.index')}}" class="btn btn-red">Back</a>
									</div>
								</div>
								<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
									<div class="page-heading">
										<label>Autopay Details & History</label>
									</div>
								</div><!--end col-->
							</div><!--end row-->
							
							<div class="row printnone">
								<div class="col-xxl-12">
									<div class="card">
										<div class="card-header">
											<div class="d-flex align-items-center">
												<h6 class="card-title mb-0 flex-grow-1">Filter</h6>
											</div>
										</div>
										<div class="row g-0">
											<div class="col-lg-6 col-md-6 col-sm-6">
												<div class="card-body">
													<div class="d-flex align-items-center mb-25">
														<div class="avatar-sm flex-shrink-0">
															<span class="avatar-title bg-primary rounded-circle fs-2">1</span>
														</div>
														<div class="flex-grow-1 ms-3 sale-date">
															<h2 class="mb-0">Choose Date Range</h2>
														</div>
													</div>  
													<form method="GET">
														<div class="row d-flex align-items-center">
															<div class="col-lg-3 col-md-4 col-sm-4">
																<label> Start Date </label>
															</div>
															<div class="col-lg-7 col-md-8 col-sm-8">
																<div class="form-group mb-10">	
																	<div class="input-group">
																		<input type="text" class="form-control border-0 flatpickr-range flatpiker-with-border" name="startDate" id="startDate"  readonly="readonly" placeholder="StartDate" value="{{$today->format('Y-m-d')}}">
																		<div class="input-group-text bg-primary border-primary text-white">
																			<i class="ri-calendar-2-line"></i>
																		</div>
																	</div>
																</div>
															</div>
														</div>
														<div class="row d-flex align-items-center">
															<div class="col-lg-3 col-md-4 col-sm-4">
																<label> End Date </label>
															</div>
															<div class="col-lg-7 col-md-8 col-sm-8">
																<div class="form-group mb-25">	
																	<div class="input-group">
																		<input type="text" class="form-control border-0 flatpickr-range flatpiker-with-border" name="endDate" id="endDate"  readonly="readonly" value="{{$today->format('Y-m-d')}}" placeholder="EndDate">
																		<div class="input-group-text bg-primary border-primary text-white">
																			<i class="ri-calendar-2-line"></i>
																		</div>
																	</div>
																</div>
															</div>
														</div>
														<div class="row justify-content-md-center">
															<div class="col-lg-6">
																<button  type="button" class="btn btn-black w-100 mb-25" data-behavior="on_change_submit" id="generate_btn"> Generate Reports </button>
															</div>
														</div>
													</form>
												</div>
											</div>
											<div class="col-lg-6 col-md-6 col-sm-6">
												<div class="card-body border-end-left">
													<div class="d-flex align-items-center mb-25">
														<div class="avatar-sm flex-shrink-0">
															<span class="avatar-title bg-primary rounded-circle fs-2">
																2
															</span>
														</div>
														<div class="flex-grow-1 ms-3 sale-date">
															<h2 class="mb-0">Export Options</h2>
														</div>
													</div> 	
													<div class="row justify-content-md-center">
														<div class="col-lg-6">
															<div class="form-group mb-10">
																<select class="form-select" name="exportOptions" id="exportOptions" required="">
																	<option value="">Select Export Options</option>
																	<option value="print">Print this report</option>
																	<option value="excel">Export to excel</option>
																	<option value="pdf">Export to PDF</option>
																</select>
															</div>
															<button type="button" class="btn btn-black w-100 mb-25" onclick="exportData();" id="go_btn">Go!</button>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
									<!-- end card -->
								</div><!-- end col -->
							</div>

							<div class="row exclude-from-print mt-5">
								<div class="col-xl-12">
									<div class="card">
										<div class="card-header align-items-center d-flex">
											<h4 class="card-title mb-0 flex-grow-1" id="headingDate">{{$today->format('l, F j, Y')}}</h4>
										</div><!-- end card header -->
										<div class="card-body">
											<input type="hidden" id="type" value="">
										   <div class="live-preview">
												<div class="accordion custom-accordionwithicon accordion-border-box" id="accordionnesting">
													<div class="accordion-item shadow">
														<h2 class="accordion-header" id="accordionnestingExampleUpcoming">
															<button class="accordion-button collapsed uppercase" type="button" data-bs-toggle="collapse" data-bs-target="#accor_nestingExamplecollapseUpcoming" aria-expanded="false" aria-controls="accor_nestingExamplecollapseUpcoming"  onclick="getData('Upcoming','')" id="Upcomingdaysbtn">Upcoming Autopay Payments</button>
														</h2>
														<div id="accor_nestingExamplecollapseUpcoming" class="accordion-collapse collapse scroll-customer" aria-labelledby="accordionnestingExampleUpcoming" data-bs-parent="#accordionnesting">
															<div class="accordion-body" id="targetDivUpcoming"></div>
														</div>
													</div>

													<div class="accordion-item shadow">
														<h2 class="accordion-header" id="accordionnestingExampledonToday">
															<button class="accordion-button collapsed uppercase" type="button" data-bs-toggle="collapse" data-bs-target="#accor_nestingExamplecollapsedonToday" aria-expanded="false" aria-controls="accor_nestingExamplecollapsedonToday"  onclick="getData('onToday','')" id="onTodaydaysbtn">Processed Payments</button>
														</h2>
														<div id="accor_nestingExamplecollapsedonToday" class="accordion-collapse collapse scroll-customer" aria-labelledby="accordionnestingExampledonToday" data-bs-parent="#accordionnesting">
															<div class="accordion-body" id="targetDivonToday"></div>
														</div>
													</div>

													<div class="accordion-item shadow">
														<h2 class="accordion-header" id="accordionnestingExampleFailedPayment">
															<button class="accordion-button collapsed uppercase" type="button" data-bs-toggle="collapse" data-bs-target="#accor_nestingExamplecollapseFailedPayment" aria-expanded="false" aria-controls="accor_nestingExamplecollapseFailedPayment"  onclick="getData('FailedPayment','')" id="FailedPaymentdaysbtn"> Failed Autopay Payments</button>
														</h2>
														<div id="accor_nestingExamplecollapseFailedPayment" class="accordion-collapse collapse scroll-customer" aria-labelledby="accordionnestingExampleFailedPayment" data-bs-parent="#accordionnesting">
															<div class="accordion-body" id="targetDivFailedPayment"></div>
														</div>
													</div>

													<div class="accordion-item shadow">
														<h2 class="accordion-header" id="accordionnestingExampleAll">
															<button class="accordion-button collapsed uppercase" type="button" data-bs-toggle="collapse" data-bs-target="#accor_nestingExamplecollapseAll" aria-expanded="false" aria-controls="accor_nestingExamplecollapseAll" onclick="getData('All','')" id="Alldaysbtn"> Autopay History  </button>
														</h2>
														<div id="accor_nestingExamplecollapseAll" class="accordion-collapse collapse scroll-customer" aria-labelledby="accordionnestingExampleAll" data-bs-parent="#accordionnesting">
															<div class="accordion-body" id="targetDivAll"></div>
														</div>
													</div>

													<div class="accordion-item shadow">
														<h2 class="accordion-header" id="accordionnestingExampleWhoOwnMoney">
															<button class="accordion-button collapsed uppercase" type="button" data-bs-toggle="collapse" data-bs-target="#accor_nestingExamplecollapseWhoOwnMoney" aria-expanded="false" aria-controls="accor_nestingExamplecollapseWhoOwnMoney" onclick="getData('WhoOwnMoney','')" id="WhoOwnMoneydaysbtn"> Customers who owe money </button>
														</h2>
														<div id="accor_nestingExamplecollapseWhoOwnMoney" class="accordion-collapse collapse scroll-customer" aria-labelledby="accordionnestingExampleWhoOwnMoney" data-bs-parent="#accordionnesting">
															<div class="accordion-body" id="targetDivWhoOwnMoney"></div>
														</div>
													</div>
												</div>
											</div>
										</div><!-- end card-body -->
									</div><!-- end card -->
								</div><!--end col-->
							</div><!--end row-->						
						</div> <!-- end .h-100-->
               </div> <!-- end col -->
            </div>
         </div><!-- container-fluid -->
      </div><!-- End Page-content -->
    </div><!-- end main content-->
</div><!-- END layout-wrapper -->
    
@include('layouts.business.footer')
	
<script>

	let offset  = 10;
 	var isLoading = false;

	function getData(type,limit){
		let startDate = $('#startDate').val();
		let endDate = $('#endDate').val();
		$('#type').val(type);
		offset = 10;
		isLoading = false;
		$.ajax({
	  		type: "post",
         url: "{{route('business.recurring_payments.getMemberships')}}",
         data: {
         	endDate: endDate,
         	startDate: startDate,
         	type: type,
         	limit: limit,
         	_token: '{{csrf_token()}}',
         },
         success: function(response){
         	$('#targetDiv'+type).html(response);
         }
		});
	}	

	$(document).ready(function () {
      $(window).scroll(function () {
      	var type = $('#type').val();
   		if(type != ''){
	         if ($(window).scrollTop() + $(window).height() > $("#accor_nestingExamplecollapse"+type).height()) {
	            if (!isLoading && offset !== -1) {
	               loadMoreRecords(type);
	            }
	         }
	      }
      });
   });

   function loadMoreRecords(type) {
   	let startDate = $('#startDate').val();
		let endDate = $('#endDate').val();
     	isLoading = true;
     	$.ajax({
         url: "{{route('business.recurring_payments.getMoreMemberships')}}",
         method: 'GET',
         data: { 
         	offset: offset,
         	endDate: endDate,
         	startDate: startDate,
         	type: type,
         },
         success: function (response) {
            if (response != '') {
               $('#targetDiv'+type).html(response);
               offset = offset + 10;
               isLoading = false;
            }else {
               offset = -1;
            }
         }
     });
   }

   flatpickr(".flatpickr-range", {
   	altInput: true,
   	altFormat: "m/d/Y",
     	dateFormat: "Y-m-d",
     	maxDate: "2050-01-01"
	});

	$(document).on('click', '[data-behavior~=on_change_submit]', function(e){
		$('#generate_btn').html('Loading..');
		$("#generate_btn").prop("disabled", true);
		const sdate = formatDate($('#startDate').val());
		const edate = formatDate($('#endDate').val());
		if(sdate && edate){
		 	e.preventDefault()
			getData('Upcoming');
			$('#todaydaysbtn').removeClass('collapsed');
			$('#onTodaydaysbtn, #FailedPaymentdaysbtn, #Alldaysbtn,#WhoOwnMoneydaysbtn').addClass('collapsed');

			$('#accor_nestingExamplecollapsedonToday, #accor_nestingExamplecollapseFailedPayment, #accor_nestingExamplecollapseAll,#accor_nestingExamplecollapseWhoOwnMoney').removeClass('show')
			$('#accor_nestingExamplecollapseUpcoming').addClass('show');
			$('#headingDate').html(sdate + ' to ' + edate);
		}else{
			alert('Please Select Date Range.');
		}
		$('#generate_btn').html('Generate Reports'); 
		$("#generate_btn").prop("disabled", false);
	});

	function formatDate(dateString) {
    	const options = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' };
   	const formattedDate = new Date(dateString).toLocaleDateString(undefined, options);
    	return formattedDate;
	}

	function exportData(){
		$('#go_btn').html('Loading..'); 
		$("#go_btn").prop("disabled", true);
		$('#Upcomingdaysbtn, #onTodaydaysbtn, #FailedPaymentdaysbtn, #Alldaysbtn ,#WhoOwnMoneydaysbtn').removeClass('collapsed');
		$('#accor_nestingExamplecollapseUpcoming, #accor_nestingExamplecollapsedonToday, #accor_nestingExamplecollapseFailedPayment, #accor_nestingExamplecollapseAll,#accor_nestingExamplecollapseWhoOwnMoney').removeClass('scroll-customer');
		$('#accor_nestingExamplecollapseUpcoming, #accor_nestingExamplecollapsedonToday, #accor_nestingExamplecollapseFailedPayment, #accor_nestingExamplecollapseAll,#accor_nestingExamplecollapseWhoOwnMoney').addClass('show');
		getData('Upcoming' ,'all')
		getData('onToday' ,'all');
		getData('FailedPayment' ,'all');
		getData('All' ,'all');
		getData('WhoOwnMoney' ,'all');

		let startDate = $('#startDate').val();
		let endDate = $('#endDate').val();
		var type = $('#exportOptions').val();
      var filename =  '';

		if(type != '' && type != 'print'){

			var downloadUrl = '{{ route("business.recurring_payments.export") }}' +
	        '?endDate=' + endDate +
	        '&startDate=' + startDate +
	        '&type=' + type;

	    	if(type == 'excel'){
	    		filename = 'RecurrinPaymentDetails.xlsx';
	    	}else if(type == 'pdf'){
	    		filename = 'RecurrinPaymentDetails.pdf';
	    	}
	
	    	var link = document.createElement('a');
	    	link.href = downloadUrl;
	    	link.download = filename;
	    	document.body.appendChild(link);
	    	link.click();
	    	document.body.removeChild(link);
		}else if(type == 'print'){
			setTimeout(function() {
				print();
			}, 1000);

			setTimeout(function() {
				$('#accor_nestingExamplecollapseUpcoming, #accor_nestingExamplecollapsedonToday, #accor_nestingExamplecollapseFailedPayment, #accor_nestingExamplecollapseAll,#accor_nestingExamplecollapseWhoOwnMoney').addClass('scroll-customer');
				$('#Upcomingdaysbtn, #onTodaydaysbtn #FailedPaymentdaysbtn, #Alldaysbtn ,#WhoOwnMoneydaysbtn').addClass('collapsed');
				$('#accor_nestingExamplecollapseUpcoming, #accor_nestingExamplecollapsedonToday, #accor_nestingExamplecollapseFailedPayment, #accor_nestingExamplecollapseAll,#accor_nestingExamplecollapseWhoOwnMoney').removeClass('show');
			}, 2000)
		}

		$('#go_btn').html('Go!'); 
		$("#go_btn").prop("disabled", false);
	}

</script>

@endsection