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
										<label>Credit Cards Expirations</label>
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
																		<input type="text" class="form-control border-0 flatpickr-range flatpiker-with-border" name="startDate" id="startDate"  readonly="readonly" placeholder="StartDate" value="">
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
																		<input type="text" class="form-control border-0 flatpickr-range flatpiker-with-border" name="endDate" id="endDate"  readonly="readonly" value="" placeholder="EndDate">
																		<div class="input-group-text bg-primary border-primary text-white">
																			<i class="ri-calendar-2-line"></i>
																		</div>
																	</div>
																</div>
															</div>
														</div>
														<div class="row justify-content-md-center">
															<div class="col-lg-6">
																<p class="font-red">*All data considered as per month and year</p>
															</div>
														</div>
														
														<div class="row justify-content-md-center">
															<div class="col-lg-6">
																<a class="btn btn-black w-100 mb-25" data-behavior="on_change_submit"> Generate Reports </a>
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
															<button type="button" class="btn btn-black w-100 mb-25" onclick="exportData();">Go!</button>
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
														<h2 class="accordion-header" id="accordionnestingExampletoday">
															<button class="accordion-button collapsed uppercase" type="button" data-bs-toggle="collapse" data-bs-target="#accor_nestingExamplecollapsetoday" aria-expanded="false" aria-controls="accor_nestingExamplecollapsetoday"  onclick="getData('today','')" id="todaydaysbtn">Expiring Today</button>
														</h2>
														<div id="accor_nestingExamplecollapsetoday" class="accordion-collapse collapse scroll-customer" aria-labelledby="accordionnestingExampletoday" data-bs-parent="#accordionnesting">
															<div class="accordion-body" id="targetDivtoday"></div>
														</div>
													</div>

													<div class="accordion-item shadow">
														<h2 class="accordion-header" id="accordionnestingExample30">
															<button class="accordion-button collapsed uppercase" type="button" data-bs-toggle="collapse" data-bs-target="#accor_nestingExamplecollapse30" aria-expanded="false" aria-controls="accor_nestingExamplecollapse30"  onclick="getData('30','')" id="30daysbtn">Expiring in 30 days</button>
														</h2>
														<div id="accor_nestingExamplecollapse30" class="accordion-collapse collapse scroll-customer" aria-labelledby="accordionnestingExample30" data-bs-parent="#accordionnesting">
															<div class="accordion-body" id="targetDiv30"></div>
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

	function getData(days,limit){
		let startDate = $('#startDate').val();
		let endDate = $('#endDate').val();
		$('#type').val(days);
		offset = 10;
		isLoading = false;
		$.ajax({
	  		type: "post",
         url: "{{route('business.credit_card_report.getCards')}}",
         data: {
         	endDate: endDate,
         	startDate: startDate,
         	days: days,
         	limit: limit,
         	_token: '{{csrf_token()}}',
         },
         success: function(response){
         	$('#targetDiv'+days).html(response);
         }
		});
	}	

	$(document).ready(function () {
      $(window).scroll(function () {
      	var type = $('#type').val();
   		if(type != ''){
	         if ($(window).scrollTop() + $(window).height() > $("#accor_nestingExamplecollapse"+type).height()) {
	            // Check if not already loading more records and not all records are loaded
	            if (!isLoading && offset !== -1) {
	               loadMoreRecords(type);
	            }
	         }
	      }
      });
   });

   function loadMoreRecords(days) {
   	let startDate = $('#startDate').val();
		let endDate = $('#endDate').val();
     	isLoading = true;
     	$.ajax({
         url: "{{route('business.credit_card_report.getMoreCards')}}",
         method: 'GET',
         data: { 
         	offset: offset,
         	endDate: endDate,
         	startDate: startDate,
         	days: days,
         },
         success: function (response) {
            if (response != '') {
               $('#targetDiv'+days).html(response);
               offset = offset + 10;
               isLoading = false;
            }else {
               // All records have been loaded
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
		const sdate = formatDate($('#startDate').val());
		const edate = formatDate($('#endDate').val());
		if(sdate && edate){
		 	e.preventDefault()
			getData('today');
			$('#todaydaysbtn').removeClass('collapsed');
			$('#30daysbtn, #90daysbtn, #alldaysbtn').addClass('collapsed');

			$('#accor_nestingExamplecollapse30, #accor_nestingExamplecollapse90, #accor_nestingExamplecollapseall').removeClass('show');
			$('#accor_nestingExamplecollapsetoday').addClass('show');
			$('#headingDate').html(sdate + ' to ' + edate);
		}else{
			alert('Please Select Date Range.');
		}
	});

	function formatDate(dateString) {
    	const options = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' };
   	const formattedDate = new Date(dateString).toLocaleDateString(undefined, options);
    	return formattedDate;
	}

	function exportData(){
		$('#todaydaysbtn, #30daysbtn').removeClass('collapsed');
		$('#accor_nestingExamplecollapsetoday, #accor_nestingExamplecollapse30').removeClass('scroll-customer');
		$('#accor_nestingExamplecollapsetoday, #accor_nestingExamplecollapse30').addClass('show');
		getData('today' ,'all');
		getData('30' ,'all');

		let startDate = $('#startDate').val();
		let endDate = $('#endDate').val();
		var type = $('#exportOptions').val();
      	var filename =  '';

		if(type != '' && type != 'print'){

			var downloadUrl = '{{ route("business.member_expirations.export") }}' +
	        '?endDate=' + endDate +
	        '&startDate=' + startDate +
	        '&type=' + type;

	    	if(type == 'excel'){
	    		filename = 'membership.xlsx';
	    	}else if(type == 'pdf'){
	    		filename = 'sample.pdf';
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
				$('#accor_nestingExamplecollapsetoday, #accor_nestingExamplecollapse30').addClass('scroll-customer');
				$('#todaydaysbtn, #30daysbtn').addClass('collapsed');
				$('#accor_nestingExamplecollapsetoday, #accor_nestingExamplecollapse30').removeClass('show');
			}, 2000);
		}
	}

</script>

@endsection