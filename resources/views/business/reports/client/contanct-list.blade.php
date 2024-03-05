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
										<label>Contact List</label>
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
															<h2 class="mb-0">Choose Type</h2>
														</div>
													</div>  
													<form method="GET">
														<input type="hidden" name="filter" id="filterOptions" value="{{@$filter}}">
														<input type="hidden" name="genderFilter" id="gender-filterOptions" value="{{@$genderFilter}}">
														<input type="hidden" name="statusFilter" id="status-filterOptions" value="{{@$statusFilter}}">

														<div class="row justify-content-md-center">
															<div class="col-lg-6 col-md-6 col-sm-6">
																<select class="form-select mb-10" name="type" id="type" required="">
																	<option value="email-list" >Email List</option>
																	<option value="mailing-list" @if($type == 'mailing-list') selected @endif>The Mailing List</option>
																</select>
															</div>
														</div>
													
														<div class="row justify-content-md-center">
															<div class="col-lg-6">
																<button type="button" class="btn btn-black w-100 mb-25" data-behavior="on_change_submit" id="generateReport"> Generate Reports </button>
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
														<div class="flex-grow-1 ms-3 sale-date"><h2 class="mb-0">Filter Options</h2></div>
													</div> 	

													<div class="row d-flex align-items-center">
														<div class="col-lg-3 col-md-4 col-sm-4">
															<label>Choose Member Type</label>
														</div>
														<div class="col-lg-6 col-md-6 col-sm-6">
															<div class="form-group">	
																<div class="input-group">
																	<select class="form-select mb-10" id="filter" data-behavior="on_change_dropdown" data-type="customer_type">
																		<option value="" >All</option>
																		<option value="Adult" @if($filter == 'Adult') selected @endif>Adult</option>
																		<option value="Child" @if($filter == 'Child') selected @endif>Child</option>
																		<option value="Infant" @if($filter == 'Infant') selected @endif>Infant</option>
																	</select>
																</div>
															</div>
														</div>
													</div>

													<div class="row d-flex align-items-center">
														<div class="col-lg-3 col-md-4 col-sm-4">
															<label>Choose Status</label>
														</div>
														<div class="col-lg-6 col-md-6 col-sm-6">
															<div class="form-group">	
																<div class="input-group">
																	<select class="form-select mb-10" id="statusFilter" data-behavior="on_change_dropdown" data-type="status">
																		<option value="" >All</option>
																		<option value="Active" @if($statusFilter == 'Active') selected @endif>Active</option>
																		<option value="InActive" @if($statusFilter == 'InActive') selected @endif>InActive</option>
																		<option value="Prospect" @if($statusFilter == 'Prospect') selected @endif>Prospect</option>
																		<option value="NoAddress" @if($statusFilter == 'NoAddress') selected @endif> No Address Added</option>
																		<option value="Birthday" @if($statusFilter == 'Birthday') selected @endif> Birthday</option>
																		<option value="At-Risk" @if($statusFilter == 'At-Risk') selected @endif> At-Risk</option>
																	</select>
																</div>
															</div>
														</div>
													</div>

													<div class="row d-flex align-items-center">
														<div class="col-lg-3 col-md-4 col-sm-4">
															<label>Choose Gender</label>
														</div>
														<div class="col-lg-6 col-md-6 col-sm-6">
															<div class="form-group">	
																<div class="input-group">
																	<select class="form-select mb-10" id="gender-filter" data-behavior="on_change_dropdown" data-type="gender">
																		<option value="" >All</option>
																		<option value="Male" @if($genderFilter == 'Male') selected @endif>Male</option>
																		<option value="Female" @if($genderFilter == 'Female') selected @endif>Female</option>
																	</select>
																</div>
															</div>
														</div>
													</div>

													<div class="d-flex align-items-center mb-25">
														<div class="avatar-sm flex-shrink-0">
															<span class="avatar-title bg-primary rounded-circle fs-2">3</span>
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
															<button type="button" class="btn btn-black w-100 mb-25" onclick="exportData();" id="go_btn">Go!</button>
														</div>
													</div>
												</div>
											</div>

										</div>
									</div><!-- end card -->
								</div><!-- end col -->
							</div>

							<div class="row exclude-from-print mt-5">
								@if($clients->isNotEmpty())
									<div class="col-xl-12">
										<div class="card">
											<div class="card-body">
												<input type="hidden" id="type" value="">
											   <div class="live-preview">
													<div class="accordion nesting2-accordion custom-accordionwithicon accordion-border-box mt-3" id="accordionnesting">
														<div class="membership-expirations-table">
															<div class="table-responsive " id="contact-table"> <!-- table-scroll remove to avoid -->
																<table class="table mb-0" >
																	<thead>
																		<tr>
																			<th>No</th>
																			<th>Name</th>
																			<th>Member ID</th>
																			<th>Email </th>
																			@if($type == 'mailing-list') 
																				<th>Address</th>
																				<th>City</th>
																				<th>State</th>
																				<th>Zip</th>
																			@endif
																			<th>Phone Number </th>
																			<th>Customer Type</th>
																			<th>Status</th>
																		</tr>
																	</thead>
																	<tbody id="contact-data">
																		@forelse($clients as $i=>$list)
																			<tr>
																				<td>{{$i+1}}</td>
																				<td><a href="{{url('business/'.request()->business_id.'/customers/'.@$list->id)}}" class="fw-medium" target="_blank">  {{@$list->full_name}}  </a> </td>
																				<td>{{@$list->member_id}}</td>
																				<td>{{@$list->email ?? 'N/A'}}</td>
																				@if($type == 'mailing-list') 
																					<td>{{@$list->address ?? 'N/A'}}</td>
																					<td>{{@$list->city ?? 'N/A'}}</td>
																					<td>{{@$list->state ?? 'N/A'}}</td>
																					<td>{{@$list->zipcode ?? 'N/A'}}</td>
																				@endif
																				<td>{{@$list->phone_number ?? 'N/A'}}</td>
																				<td>{{@$list->customer_type}}</td>
																				<td>{{@$list->is_active()}}</td>
																			</tr>
																		@empty
																			<tr> <td @if($type == 'mailing-list') colspan="10" @else colspan="6" @endif></td> </tr>
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

	let offset  = 1000;
 	var isLoading = false;

 	$(document).ready(function () {
      $(window).scroll(function () {
      	var type = $('#type').val();
   		if(type != ''){
	         if ($(window).scrollTop() + $(window).height() > $("#contact-table").height()) {
	            // Check if not already loading more records and not all records are loaded
	            if (!isLoading && offset !== -1) {
	               loadMoreRecords();
	            }
	         }
	      }
      });
   });

 	function loadMoreRecords() {
		let type = $('#type').val();
		let filter = $('#filterOptions').val();
		let genderFilter = $('#gender-filterOptions').val();
		let statusFilter = $('#status-filterOptions').val();
     	isLoading = true;
     	$.ajax({
         url: "{{route('business.contact-list.get-more')}}",
         method: 'GET',
         data: { 
         	offset: offset,
         	type: type,
         	filter: filter,
         	statusFilter: statusFilter,
         	genderFilter: genderFilter,
         },
         success: function (response) {
            if (response != '') {
               $('#contact-data').append(response);
               offset = offset + 1000;
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
		e.preventDefault()
		$('#generateReport').html('Loading..');
		$("#generateReport").prop("disabled", true);
		$(this).parents('form').submit();
	});

	$(document).on('change', '[data-behavior~=on_change_dropdown]', function(e){
		if($(this).attr('data-type') == 'gender'){
			$('#gender-filterOptions').val(this.value);
		}else if($(this).attr('data-type') == 'status'){
			$('#status-filterOptions').val(this.value);
		}else{
			$('#filterOptions').val(this.value);
		}
		$('#generateReport').click();
	});


	function formatDate(dateString) {
    	const options = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' };
   	const formattedDate = new Date(dateString).toLocaleDateString(undefined, options);
    	return formattedDate;
	}

	function exportData(){
		let startDate = '';
		let endDate = '' ;
		var type = $('#exportOptions').val();
		
		let filter = $('#filterOptions').val();
		let genderFilter = $('#gender-filterOptions').val();
		let statusFilter = $('#status-filterOptions').val();
		var listType = $('#type').val();

		if(type){
			$('#go_btn').html('Loading..'); 
			$("#go_btn").prop("disabled", true);
		}

      var filename =  '';
		if(type != '' && type != 'print'){

			var downloadUrl = '{{ route("business.contact-list.export") }}' + '?listType='+listType+'&type=' + type+'&filter=' + filter+'&genderFilter=' + genderFilter+'&statusFilter=' + statusFilter;

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

		setTimeout(function() {
				$('#go_btn').html('Go!'); 
				$("#go_btn").prop("disabled", false);
		}, 3000);

	}

</script>

@endsection