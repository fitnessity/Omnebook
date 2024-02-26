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
														<div class="row justify-content-md-center">
															<div class="col-lg-6 col-md-6 col-sm-6">
																<select class="form-select mb-10" name="exportOptions" id="exportOptions" required="">
																	<option value="">Select Export Options</option>
																	<option value="email">Email List</option>
																	<option value="mailing">The Mailing List</option>
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
															<div class="table-responsive">
																<table class="table mb-0">
																	<thead>
																		<tr>
																			<th>No</th>
																			<th>Name</th>
																			<th>Email </th>
																			<th>Birthday  </th>
																			<th>Phone Number </th>
																			<th>Customers Since</th>
																			<th>Status</th>
																			<th></th>
																		</tr>
																	</thead>
																	<tbody>
																		@forelse($clients as $i=>$list)
																			<tr>
																				<td>{{$i+1}}</td>
																				<td><a href="{{url('business/'.request()->business_id.'/customers/'.@$list->id)}}" class="fw-medium" target="_blank">  {{@$list->full_name}}  </a> </td>
																				<td>{{@$list->email}}</td>
																				<td>{{date('m/d/Y',strtotime($list->birthdate))}}</td>
																				<td>{{@$list->phone_number ?? 'N/A'}}</td>
																				<td>{{date('m/d/Y',strtotime($list->created_at))}}</td>
																				<td class="@if($list->is_active() == 'InActive') font-red @else font-green @endif ">{{$list->is_active() == 'Active' ? 'Member' : $list->is_active()}}</td>
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
		$('#generateReport').html('Loading..');
		$("#generateReport").prop("disabled", true);
		$(this).parents('form').submit();
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
		if(type){
			$('#go_btn').html('Loading..'); 
			$("#go_btn").prop("disabled", true);
		}

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

		setTimeout(function() {
				$('#go_btn').html('Go!'); 
				$("#go_btn").prop("disabled", false);
		}, 3000);

	}

</script>

@endsection