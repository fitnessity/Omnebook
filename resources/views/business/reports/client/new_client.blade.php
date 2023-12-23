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
										<label>New Clients</label>
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
															<h2 class="mb-0">Choose Dates</h2>
														</div>
													</div>  
													<form method="GET">
														<input type="hidden" name="filterOptions" id="filterOptionsvalue" value="{{request()->filterOptions}}">
														<div class="row d-flex align-items-center">
															<div class="col-lg-3 col-md-4 col-sm-4">
																<label> Start Date </label>
															</div>
															<div class="col-lg-7 col-md-8 col-sm-8">
																<div class="form-group mb-10">	
																	<div class="input-group">
																		<input type="text" class="form-control border-0 flatpickr-range flatpiker-with-border" name="startDate" id="startDate"  readonly="readonly" value="{{$filterStartDate}}" placeholder="StartDate">
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
																		<input type="text" class="form-control border-0 flatpickr-range flatpiker-with-border" name="endDate" id="endDate"  readonly="readonly" value="{{$filterEndDate}}"  placeholder="StartDate">
																		<div class="input-group-text bg-primary border-primary text-white">
																			<i class="ri-calendar-2-line"></i>
																		</div>
																	</div>
																</div>
															</div>
														</div>
														<div class="row justify-content-md-center">
															<div class="col-lg-6">
																<a class="btn btn-black w-100 mb-25" data-behavior="on_change_submit" id="generateReport"> Generate Reports </a>
															</div>
														</div>
													</form>
												</div>
											</div>
											<div class="col-lg-6 col-md-6 col-sm-6">
												<div class="card-body border-end-left">
													<div class="d-flex align-items-center mb-25">
														<div class="avatar-sm flex-shrink-0">
															<span class="avatar-title bg-primary rounded-circle fs-2">2</span>
														</div>
														<div class="flex-grow-1 ms-3 sale-date"><h2 class="mb-0">Export Options</h2></div>
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
									</div><!-- end card -->
								</div><!-- end col -->
							</div>

							<div class="row exclude-from-print mt-5">
								@foreach($sortedDates as $y=>$date)
								@php 
									$clientsData = clone $clients; // Create a fresh copy of the query
					        		$clientsData = $clientsData->whereDate('created_at',$date->format('Y-m-d'))->get();
								@endphp
								@if($clientsData->isNotEmpty())
									<div class="col-xl-12">
										<div class="card">
											<div class="card-header align-items-center d-flex">
												<h4 class="card-title mb-0 flex-grow-1" id="headingDate">{{$date->format('l, F j, Y')}}</h4>
											</div><!-- end card header -->
											<div class="card-body">
												<input type="hidden" id="type" value="">
											   <div class="live-preview">
													<div class="accordion nesting2-accordion custom-accordionwithicon accordion-border-box mt-3" id="accordionnesting">
														<div class="membership-expirations-table">
															<div class="table-responsive">
																<table class="table mb-0">
																	<thead>
																		<tr>
																			<th>No</th>
																			<th>Name</th>
																			<th>Email </th>
																			<th>Birthday  </th>
																			<th>Phone Number  </th>
																			<th>Customers Since</th>
																			<th></th>
																		</tr>
																	</thead>
																	<tbody>
																		@forelse($clientsData as $i=>$list)
																			<tr>
																				<td>{{$i+1}}</td>
																				<td><a href="{{url('business/'.request()->business_id.'/customers/'.@$list->id)}}" class="fw-medium" target="_blank">  {{@$list->full_name}}  </a> </td>
																				<td>{{@$list->email}}</td>
																				<td>{{date('m/d/Y',strtotime($list->birthdate))}}</td>
																				<td>{{@$list->phone_number ?? 'N/A'}}</td>
																				<td>{{date('m/d/Y',strtotime($list->created_at))}}</td>
																				<td><a href="{{url('business/'.request()->business_id.'/customers/'.@$list->id)}}"> View </a></td>
																			</tr>
																		@empty
																			<tr> <td colspan="6"></td> </tr>
																		@endforelse
																	</tbody>
																</table>
															</div>
														</div>
													</div>
												</div>
											</div><!-- end card-body -->
										</div><!-- end card -->
									</div>
								@endif
								@endforeach
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

   flatpickr(".flatpickr-range", {
   	altInput: true,
   	altFormat: "m/d/Y",
     	dateFormat: "Y-m-d",
     	maxDate: "2050-01-01"
	});

	$(document).on('click', '[data-behavior~=on_change_submit]', function(e){
		e.preventDefault()
		$(this).parents('form').submit();
	});

	$(document).on('change', '[data-behavior~=on_change_submit]', function(e){
		$('#filterOptionsvalue').val(this.value);
		$('#generateReport').click();
	});

	function formatDate(dateString) {
    	const options = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' };
   	const formattedDate = new Date(dateString).toLocaleDateString(undefined, options);
    	return formattedDate;
	}

	function exportData(){
		let startDate = '<?= $filterStartDate ? $filterStartDate->format("Y-m-d") : ''; ?>' || $('#startDate').val();
		let endDate = '<?= $filterEndDate ? $filterEndDate->format("Y-m-d") : ''; ?>' ||  $('#endDate').val();
		var type = $('#exportOptions').val();
      var filename =  '';

		if(type != '' && type != 'print'){

			var downloadUrl = '{{ route("business.new_client.export") }}' + '?clientType=new&type=' + type +'&endDate=' + endDate +
		        '&startDate=' + startDate;

	    	if(type == 'excel'){
	    		filename = 'new-cleint.xlsx';
	    	}else if(type == 'pdf'){
	    		filename = 'new-cleint.pdf';
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
			}, 2000);
		}
	}

</script>

@endsection