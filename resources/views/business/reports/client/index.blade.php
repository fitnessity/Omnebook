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
										<label>Inactive Clients</label>
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
																		<input type="text" class="form-control border-0 flatpickr-range flatpiker-with-border" name="startDate" id="startDate"  readonly="readonly" placeholder="StartDate" value="{{$filterStartDate->format('Y-m-01')}}">
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
																		<input type="text" class="form-control border-0 flatpickr-range flatpiker-with-border" name="endDate" id="endDate"  readonly="readonly" value="{{$filterEndDate->format('Y-m-d')}}" placeholder="EndDate">
																		<div class="input-group-text bg-primary border-primary text-white">
																			<i class="ri-calendar-2-line"></i>
																		</div>
																	</div>
																</div>
															</div>
														</div>
														<div class="row justify-content-md-center">
															<div class="col-lg-6">
																<button type="button" class="btn btn-black w-100 mb-25" data-behavior="on_change_submit" id="generate_btn"> Generate Reports </button>
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
															<button type="button" class="btn btn-black w-100 mb-25" onclick="exportData();" id="go_btn" >Go!</button>
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
											<h4 class="card-title mb-0 flex-grow-1" id="headingDate">{{$filterStartDate->format('l, F j, Y')}} to {{$filterEndDate->format('l, F j, Y')}}</h4>
										</div><!-- end card header -->
										<div class="card-body">
											<input type="hidden" id="type" value="">
										   <div class="live-preview">
												<div class="accordion custom-accordionwithicon accordion-border-box" id="accordionnesting">
													<div class="accordion-item shadow">
														<h2 class="accordion-header" id="accordionnestingExampletoday">
															<button class="accordion-button collapsed uppercase" type="button" data-bs-toggle="collapse" data-bs-target="#accor_nestingExamplecollapsetoday" aria-expanded="false" aria-controls="accor_nestingExamplecollapsetoday"  onclick="getData('today','')" id="todaydaysbtn">Inactive Today</button>
														</h2>
														<div id="accor_nestingExamplecollapsetoday" class="accordion-collapse collapse scroll-customer" aria-labelledby="accordionnestingExampletoday" data-bs-parent="#accordionnesting">
															<div class="accordion-body" id="targetDivtoday"></div>
														</div>
													</div>

													<div class="accordion-item shadow">
														<h2 class="accordion-header" id="accordionnestingExample30">
															<button class="accordion-button collapsed uppercase" type="button" data-bs-toggle="collapse" data-bs-target="#accor_nestingExamplecollapse30" aria-expanded="false" aria-controls="accor_nestingExamplecollapse30"  onclick="getData('30','')" id="30daysbtn">Inactive In 30 Days</button>
														</h2>
														<div id="accor_nestingExamplecollapse30" class="accordion-collapse collapse scroll-customer" aria-labelledby="accordionnestingExample30" data-bs-parent="#accordionnesting">
															<div class="accordion-body" id="targetDiv30"></div>
														</div>
													</div>

													<div class="accordion-item shadow">
														<h2 class="accordion-header" id="accordionnestingExample90">
															<button class="accordion-button collapsed uppercase" type="button" data-bs-toggle="collapse" data-bs-target="#accor_nestingExamplecollapse90" aria-expanded="false" aria-controls="accor_nestingExamplecollapse90"  onclick="getData('90','')" id="90daysbtn"> Inactive In 90 Days </button>
														</h2>
														<div id="accor_nestingExamplecollapse90" class="accordion-collapse collapse scroll-customer" aria-labelledby="accordionnestingExample90" data-bs-parent="#accordionnesting">
															<div class="accordion-body" id="targetDiv90"></div>
														</div>
													</div>

													<div class="accordion-item shadow">
														<h2 class="accordion-header" id="accordionnestingExampleall">
															<button class="accordion-button collapsed uppercase" type="button" data-bs-toggle="collapse" data-bs-target="#accor_nestingExamplecollapseall" aria-expanded="false" aria-controls="accor_nestingExamplecollapseall" onclick="getData('all','')" id="alldaysbtn"> All Inactive Members </button>
														</h2>
														<div id="accor_nestingExamplecollapseall" class="accordion-collapse collapse scroll-customer" aria-labelledby="accordionnestingExampleall" data-bs-parent="#accordionnesting">
															<div class="accordion-body" id="targetDivall"></div>
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
	let today = daysthree = daysnty = daysall = 0;
	let offset  = 10;
 	var isLoading = false;

	function getData(days,limit){
		$('#targetDiv'+days).html('');
		let startDate = $('#startDate').val();
		let endDate = $('#endDate').val();
		$('#type').val(days);
		offset = 10;
		isLoading = false;
		$.ajax({
	  		type: "post",
         url: "{{route('business.client.get-inactive-clients')}}",
         data: {
         	endDate: endDate,
         	startDate: startDate,
         	days: days,
         	limit: limit,
         	_token: '{{csrf_token()}}',
         },
         success: function(response){
         	$('#targetDiv'+days).html(response);
         	if(days == 'today'){
         		today = 1;
         	}else if(days == '30'){
         		daysthree = 1;
         	}else if(days == '90'){
         		daysnty = 1;
         	}else{
         		daysall = 1;
         	}
         	return 'success';
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
         url: "{{route('business.client.getMoreInactiveClients')}}",
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
		$('#generate_btn').html('Loading..');
		$("#generate_btn").prop("disabled", true);
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

		$('#generate_btn').html('Generate Reports'); 
		$("#generate_btn").prop("disabled", false);
	});

	function formatDate(dateString) {
    	const options = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' };
   	const formattedDate = new Date(dateString).toLocaleDateString(undefined, options);
    	return formattedDate;
	}

	function exportData(){
		let startDate = $('#startDate').val();
		let endDate = $('#endDate').val();
		var type = $('#exportOptions').val();
      if(type){
			$('#go_btn').html('Loading..'); 
			$("#go_btn").prop("disabled", true);
		}
      var filename =  '';
		if(type != '' && type != 'print'){
			var downloadUrl = '{{ route("business.client.export") }}' +
	        '?endDate=' + endDate +
	        '&startDate=' + startDate +
	        '&type=' + type;

	    	if(type == 'excel'){
	    		filename = 'InActiveClient.xlsx';
	    	}else if(type == 'pdf'){
	    		filename = 'InActiveClient.pdf';
	    	}
	
	    	var link = document.createElement('a');
	    	link.href = downloadUrl;
	    	link.download = filename;
	    	document.body.appendChild(link);
	    	link.click();
	    	document.body.removeChild(link);

	    	setInterval(() => {
		    	$('#go_btn').html('Go!'); 
						$("#go_btn").prop("disabled", false);
			}, 15000); 

		}else if(type == 'print'){
			$('#todaydaysbtn, #30daysbtn, #90daysbtn, #alldaysbtn').removeClass('collapsed');
			$('#accor_nestingExamplecollapsetoday, #accor_nestingExamplecollapse30, #accor_nestingExamplecollapse90, #accor_nestingExamplecollapseall').removeClass('scroll-customer');
			$('#accor_nestingExamplecollapsetoday, #accor_nestingExamplecollapse30, #accor_nestingExamplecollapse90, #accor_nestingExamplecollapseall').addClass('show');

			getData('today', 'all');
		   getData('30', 'all');
		   getData('90', 'all');
		   getData('all', 'all');

			const checkPromises = setInterval(() => {
		   	if(today == 1  && daysthree==1 &&  daysnty == 1 && daysall == 1){
		   			clearInterval(checkPromises);
	               print();
	               $('#accor_nestingExamplecollapsetoday, #accor_nestingExamplecollapse30, #accor_nestingExamplecollapse90, #accor_nestingExamplecollapseall').addClass('scroll-customer');
	               $('#accor_nestingExamplecollapseall').addClass('scroll-customer');
	               $('#accor_nestingExamplecollapseall').addClass('scroll-customer');
	               $('#accor_nestingExamplecollapseall').addClass('scroll-customer');
	               $('#todaydaysbtn, #30daysbtn, #90daysbtn, #alldaysbtn').addClass('collapsed');
	               $('#accor_nestingExamplecollapsetoday, #accor_nestingExamplecollapse30, #accor_nestingExamplecollapse90, #accor_nestingExamplecollapseall').removeClass('show');
	               $('#go_btn').html('Go!'); 
						$("#go_btn").prop("disabled", false);
						today = daysthree = daysnty = daysall = 0;
				}
	      }, 1000); 
		}
	}

</script>

@endsection