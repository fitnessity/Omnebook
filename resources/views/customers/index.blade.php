@inject('request', 'Illuminate\Http\Request')
@extends('layouts.business.header')

@section('content')

	@include('layouts.business.business_topbar')
	@php
	    $notifications = getCustomerFilesNotifiy()->pluck('id')->toArray();
	@endphp
	@if(!empty($notifications))
	@php
	markNotificationsAsSeenAndProcessed($notifications);
	@endphp
	@endif
	    <div class="main-content">
			<div class="page-content">
	         <div class="container-fluid">
	            <div class="row">
	                <div class="col">
	                  	<div class="h-100">

		                    <div class="row mb-3">
								<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
									<div class="page-heading">
										<label>Manage Customers</label>
									</div>
								</div>
								<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
									<div class="import-export float-end mt-10">
										<button href="#" data-bs-toggle="modal" data-bs-target=".uploadfileall" class="btn btn-red">Upload</button>
										<form method="get" action="/exportcustomer">
											<input type="hidden" name="chk" id="chk" value="empty">
											<input type="hidden" name="id" id="id" value="{{$company->id}}">
											<button type="submit" class="btn btn-black">Export List</button> 
										</form>
									</div>
								</div>
							</div>

							<div class="">
								<label id="systemMessage1" class="font-16"></label>
							</div>
								{{-- @php 	
								   $userId = Auth::id();
									$data=App\BusinessCustomerUploadFiles::where('status',1)->where('user_id', $userId)->first();
								@endphp
								@if($data)
									<label id="systemMessage1" class="font-16 font-green font-16">We are processing your file. Once completed,  we will send you an email and notification.</label>
								@endif --}}

								<label id="uploadedfile" class="font-16 font-green font-16"></label>
							<div class="row">
								<div class="col-lg-12">
									<div class="card">
										<div class="card-body client-tabs">
											<!-- Nav tabs -->
											<ul class="nav nav-tabs mb-3" role="tablist">
												<li class="nav-item">
													<a class="nav-link active" data-bs-toggle="tab" href="#client" role="tab" aria-selected="false">
														Clients
													</a>
												</li>
												<li class="nav-item">
													<a class="nav-link" data-bs-toggle="tab" href="#beltpromotions" role="tab" aria-selected="false">
														Promotions
													</a>
												</li>
												<li class="nav-item">
													<a class="nav-link" data-bs-toggle="tab" href="#clientstats" role="tab" aria-selected="false">
														Client Stats 
													</a>
												</li>
											</ul>
											<!-- Tab panes -->
											<div class="tab-content  text-muted">
												<div class="tab-pane active" id="client" role="tabpanel">
													<div class="row">
														<div class="col-lg-12">
															<div class="">
																<!-- Nav tabs -->
																<ul class="nav nav-tabs mb-3" role="tablist">
																	<li class="nav-item">
																		<a class="nav-link @if(request()->customer_type == '') active @endif" href="{{ route('business_customer_index', ['business_id' => request()->business_id]) }}" aria-selected="false" id="totalMembers">
																			Total Members (<img src="{{url('/public/images/processing.gif')}}" alt="Processing..." class="clientloading">)
																		</a>
																	</li>
																	<li class="nav-item">
																		<a class="nav-link @if(request()->customer_type == 'active') active @endif" href="{{ route('business_customer_index', ['business_id' => request()->business_id, 'customer_type' => 'active']) }}"  aria-selected="false" id="activeMembers">
																			Active Members (<img src="{{url('/public/images/processing.gif')}}" alt="Processing..." class="clientloading">)
																		</a>
																	</li>
																	<li class="nav-item">
																		<a class="nav-link @if(request()->customer_type == 'in-active') active @endif" href="{{ route('business_customer_index', ['business_id' => request()->business_id, 'customer_type' => 'in-active']) }}"  aria-selected="false" id="inactiveMembers">
																			Inactive Members (<img src="{{url('/public/images/processing.gif')}}" alt="Processing..." class="clientloading">)
																		</a>
																	</li>
																	<li class="nav-item">
																		<a class="nav-link @if(request()->customer_type == 'prospect') active @endif" href="{{ route('business_customer_index', ['business_id' => request()->business_id, 'customer_type' => 'prospect']) }}"  aria-selected="false" id="prospectMembers">
																			Prospects (<img src="{{url('/public/images/processing.gif')}}" alt="Processing..." class="clientloading">)
																		</a>
																	</li>
																	<li class="nav-item">
																		<a class="nav-link @if(request()->customer_type == 'suspended') active @endif"  href="{{ route('business_customer_index', ['business_id' => request()->business_id, 'customer_type' => 'suspended']) }}" role="tab" aria-selected="false" id="suspendedMembers">
																			Suspended (<img src="{{url('/public/images/processing.gif')}}" alt="Processing..." class="clientloading">)
																		</a>
																	</li>
																	<li class="nav-item">
																		<a class="nav-link @if(request()->customer_type == 'owed') active @endif"  href="{{ route('business_customer_index', ['business_id' => request()->business_id, 'customer_type' => 'owed']) }}" aria-selected="false" id="owedMembers">
																			Owed (<img src="{{url('/public/images/processing.gif')}}" alt="Processing..." class="clientloading">)
																		</a>
																	</li>
																	<li class="nav-item">
																		<a class="nav-link @if(request()->customer_type == 'at-risk') active @endif"  href="{{ route('business_customer_index', ['business_id' => request()->business_id, 'customer_type' => 'at-risk']) }}" aria-selected="false" id="atRiskMembers">
																			At-Risk (<img src="{{url('/public/images/processing.gif')}}" alt="Processing..." class="clientloading">)
																		</a>
																	</li>
																	<li class="nav-item">
																		<a class="nav-link @if(request()->customer_type == 'big-spenders') active @endif"  href="{{ route('business_customer_index', ['business_id' => request()->business_id, 'customer_type' => 'big-spenders']) }}" aria-selected="false" id="spenderMembers">
																			Big Spenders (<img src="{{url('/public/images/processing.gif')}}" alt="Processing..." class="clientloading">)
																		</a>
																	</li>
																</ul>
																<!-- Tab panes -->
																<div class="tab-content  text-muted">
																	<div class="tab-pane active" id="totalclient" role="tabpanel">
																		<div class="row">
																			<div class="col-xl-12">
																				<div class="card">
																					<div class="card-header align-items-center d-flex">
																						<div class="container-fluid nopadding">
																							<div class="row y-middle">

																								<div class="col-lg-6 col-md-6 col-sm-6 col-6">
																									<h4 class="card-title mb-0 flex-grow-1">Customers</h4>
																								</div>

																								<div class="col-lg-6 col-md-6 col-sm-6 col-6">
																									<div class="multiple-options">
																										<div class="setting-icon">
																											<i class="ri-more-fill fs-26"></i>
																											<ul id="catUl0">
																												<li><a href="#" data-bs-toggle="modal" data-bs-target="#merge_customer"><i class="fas fa-plus text-muted"></i>Merge Clients</a></li>
																												</li>				
																											</ul>
																										</div>
																									</div>
																								</div>	
																							</div>
																						</div>
																					</div><!-- end card header -->

																					<div class="card-body">
																						<div class="total-clients">
																							<i class="fas fa-user-circle"></i>
																							<label>You Have {{$currentCount}} Clients</label>
																						</div>
																						@if(request()->customer_type == 'big-spenders')
																							<div class="table-responsive">
																						        <table class="table align-middle table-nowrap mb-0">
																						            <thead>
																						                <tr>
																						                    <th scope="col">Member</th>
																						                    <th scope="col"></th>
																						                    <th scope="col">Age</th>
																						                    <th scope="col">Total Bookings</th>
																						                    <th scope="col">Total Paid</th>
																						                </tr>
																						            </thead>
																						            <tbody>
																						            	@foreach($customersCollection as $customer) 
																						                    <tr>
																						                        <th scope="row">
																						                        	<div class="mini-stats-wid d-flex align-items-center mt-3">
																							                        	<div class="flex-shrink-0 avatar-sm">
																															@if($customer->profile_pic)
																																<img class='mini-stat-icon avatar-title rounded-circle text-success bg-soft-red fs-4' src="{{Storage::Url($customer->profile_pic)}}" width=60 height=60 alt=""> 
																															@else
																																<span class="mini-stat-icon avatar-title rounded-circle text-success bg-soft-red fs-4 uppercase">{{$customer->first_letter}}</span>
																															@endif
																														</div>
																													</div>
																						                        </th>
																						                        <td><h6 class="mb-1">{{$customer->full_name}}</h6></td>
																						                        <td>{{ $customer->age != '' ? $customer->age : "-"}}</td>
																						                        <td>{{@$customer->bookingDetail()->count()}}</td>
																						                        <td>${{@$customer->total_spend()}}</td>
																						                    </tr>
																						                @endforeach
																						            </tbody>
																						        </table>
																						    </div>
																						@else
																							<div class="live-preview">
																								<div class="accordion custom-accordionwithicon accordion-border-box" id="accordionnesting">
																									@foreach ($validLetters as $letter)
																										<div class="accordion-item shadow">
																											<h2 class="accordion-header" id="accordionnestingExample{{$letter}}">
																												<button class="accordion-button collapsed uppercase" type="button" data-bs-toggle="collapse" data-bs-target="#accor_nestingExamplecollapse{{$letter}}" aria-expanded="false" aria-controls="accor_nestingExamplecollapse{{$letter}}" onclick="getData('{{$letter}}')">{{$letter}}</button>
																											</h2>
																											<div id="accor_nestingExamplecollapse{{$letter}}" class="accordion-collapse collapse scroll-customer" aria-labelledby="accordionnestingExample{{$letter}}" data-bs-parent="#accordionnesting">
																												<div class="accordion-body" id="targetDiv{{$letter}}"></div>
																											</div>
																										</div>
																									@endforeach
																								</div>
																							</div>
																						@endif
																					</div><!-- end card-body -->
																				</div><!-- end card -->
																			</div>
																			<!--end col-->
																		</div>
																		<!--end row-->	
																	</div>
																</div>
															</div><!-- end card-body -->
														</div><!-- end card -->
													</div>
												</div>
												<div class="tab-pane" id="beltpromotions" role="tabpanel">
													<h6>Coming soon</h6>
												</div>
												<div class="tab-pane" id="clientstats" role="tabpanel">
													<h6>Coming soon</h6>
												</div>
											</div>
										</div><!-- end card-body -->
									</div><!-- end card -->
								</div>
							</div>
						
						</div> <!-- end .h-100-->
	                </div> <!-- end col -->
	            </div>
	        </div><!-- container-fluid -->
	    </div><!-- End Page-content -->
	</div><!-- end main content-->
</div><!-- END layout-wrapper -->

<div class="modal fade uploadfile" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="myModalLabel">Upload file for customer</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body">
				<div class="form-group mt-10">
					<label for="img">Choose File: </label>
					<input type="file" class="form-control" name="file" id="file1" onchange="readURL(this)">
					<p class='err mt-10 font-red'></p>
					<div class="row">
						<div class="col-md-12">
							<div class="loading-container text-center loading-width d-none">
							  	<img src="{{'/public/images/processing.gif'}}" alt="Processing..." />
							</div>
						</div>
					</div>
				</div>					
			</div>
			<div class="modal-footer">
					<button type="button" id="upload-csv" class="btn btn-primary btn-red">Upload File</button>
			</div>
		</div>
	</div>
</div>
<!-- /.modal -->

<div class="modal fade uploadmembership" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="myModalLabel">Upload file for Membership Details</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body">
				<div class="form-group mt-10">
					<label for="img">Choose File: </label>
					<input type="file" class="form-control" name="membershipFile" id="file1" onchange="readURL(this)">
					<p class='err mt-10 font-red'></p>
					<div class="row">
						<div class="col-md-12">
							<div class="loading-container text-center loading-width d-none">
							  	<img src="{{'/public/images/processing.gif'}}" alt="Processing..." />
							</div>
						</div>
					</div>
				</div>					
			</div>
			<div class="modal-footer">
				<button type="button" id="upload-membership" class="btn btn-primary btn-red">Upload File</button>
			</div>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<div class="modal fade uploadfileall" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered modal-50">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="myModalLabel">Upload file for customer</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body text-center">
				<div class="upload-files">
					<!-- @if ($company->customer_uploading)
					    <button type="button" disabled data-bs-toggle="modal" data-bs-target=".uploadfile" id="upload-csv1" class="btn btn-primary btn-red mb-10">Client importing</button>
					@else
					    <button type="button"  data-bs-toggle="modal" data-bs-target=".uploadfile" id="upload-csv1" class="btn btn-primary btn-red mb-10">Upload Client List</button>
					@endif -->
					
					<button type="button"  data-bs-toggle="modal" data-bs-target=".uploadfile" id="upload-csv1" class="btn btn-primary btn-red mb-10">Upload Client List</button>

					<button type="button" id="upload-csv2" class="btn btn-primary btn-black mb-10" data-bs-toggle="modal" data-bs-target=".uploadmembership" >Upload Membership Details</button>
					<button type="button" id="upload-csv3" class="btn btn-primary btn-red mb-10" data-bs-toggle="modal" data-bs-target=".uploadAttendance" >Upload Attendance Details</button>
					<br/>
					{{-- Client Import Logs:
					@if ($company->client_imported_at)
					    Skip List: <a href="{{Storage::url($company->client_skip_logs_url)}}">Link</a>
					    Fail List: <a href="{{Storage::url($company->client_fail_logs_url)}}">Link</a>
					@else
					    <button type="button"  data-bs-toggle="modal" data-bs-target=".uploadfile" id="upload-csv1" class="btn btn-primary btn-red mb-10">Upload Client List</button>
					@endif --}}
				</div>
			</div>
		</div>
	</div>
</div>
<!-- /.modal -->
    
<div class="modal fade uploadAttendance" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="myModalLabel">Upload file for Attendance Details</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body">
				<div class="form-group mt-10">
					<label for="img">Choose File: </label>
					<input type="file" class="form-control" name="attendanceFile" id="fileattendance" onchange="readURL(this)">
					<p class='err mt-10 font-red'></p>
					<div class="row">
						<div class="col-md-12">
							<div class="loading-container text-center loading-width d-none">
							  	<img src="{{'/public/images/processing.gif'}}" alt="Processing..." />
							</div>
						</div>
					</div>
				</div>					
			</div>
			<div class="modal-footer">
				<button type="button" id="upload-attendance" class="btn btn-primary btn-red">Upload File</button>
			</div>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div>

@include('layouts.business.footer')					

	<script>
		var profile_pic_var = '';
		var ext = '';
		function readURL(input) {
		   	if (input.files && input.files[0]) {
		      	const name = input.files[0].name;
		  		const lastDot = name.lastIndexOf('.');
		  		const fileName = name.substring(0, lastDot);
		   		ext = name.substring(lastDot + 1);
		   		var reader = new FileReader();
	         	reader.onload = function (e) {
	         	};
	         	profile_pic_var = input.files[0];
	         	eader.readAsDataURL(input.files[0]);
	     	}
		}
	</script>
	<script>
		$(document).ready(function() {
			// When the modal is closed
			$('.uploadAttendance').on('hidden.bs.modal', function () {
				// Reset the file input field
				$('#file1').val('');
			});
		});
	</script>
	<script type="text/javascript">
		$(document).ready(function () {
			/*updateCustomerCounts();*/
			const counters = [
		        { type: 'totalMembers', elementId: 'totalMembers' },
		        { type: 'activeMembers', elementId: 'activeMembers' },
		        { type: 'inactiveMembers', elementId: 'inactiveMembers' },
		        { type: 'prospectMembers', elementId: 'prospectMembers' },
		        { type: 'suspendedMembers', elementId: 'suspendedMembers' },
		        { type: 'owedMembers', elementId: 'owedMembers' },
		        { type: 'atRiskMembers', elementId: 'atRiskMembers' },
		        { type: 'spenderMembers', elementId: 'spenderMembers' },
		    ];


			var businessId = '{{ request()->business_id }}';
				$.ajax({
					url: '/getCustomerCounts/' + businessId,
					type: 'GET',
					dataType: 'json'
				}).then(function(response) {
					$('#totalMembers').text(response.totalMembers);
					$('#activeMembers').text(response.activeMembers);
					$('#inactiveMembers').text(response.inactiveMembers);
					$('#prospectMembers').text(response.prospectMembers);
					$('#suspendedMembers').text(response.suspendedMembers);
					$('#owedMembers').text(response.owedMembers);
					$('#atRiskMembers').text(response.atRiskMembers);
					$('#spenderMembers').text(response.spenderMembers);
					console.log('All counters updated successfully.');
				}).fail(function(xhr, status, error) {
					console.error('Error fetching counters:', error);
				});
		    // updateCountersSequentially(counters)
	        // .then(function() {
	        //     console.log('All counters updated successfully.');
	        // });


			function Fileupload(businessId, dataId) {
				var businessId = businessId; 
				var id=dataId;
				var url = "/business/" + businessId + "/upload/"+dataId;
				var csrfToken = $('meta[name="csrf-token"]').attr('content');
				// alert(url);
				$.ajax({
					url: url,
					type: 'get',
					data: JSON.stringify({
						id: dataId
					}),
					contentType: 'application/json; charset=utf-8',
					headers: {
						'X-CSRF-TOKEN': csrfToken
					},
					success: function(response) {
						console.log("AJAX call successful:", response);
						$('#uploadedfile').text(response.message);
						$('#systemMessage1').hide();

					},
				});
			}

			// FileuploadMember
			function FileuploadMember(businessId, dataId) {
				var businessId = businessId; 
				var id=dataId;
				var url = "/business/" + businessId + "/upload_member/"+dataId;
				var csrfToken = $('meta[name="csrf-token"]').attr('content');
				// alert(url);
				$.ajax({
					url: url,
					type: 'get',
					data: JSON.stringify({
						id: dataId
					}),
					contentType: 'application/json; charset=utf-8',
					headers: {
						'X-CSRF-TOKEN': csrfToken
					},
					success: function(response) {
						console.log("AJAX call successful:", response);
						$('#uploadedfile').text(response.message);
						$('#systemMessage1').hide();

					},
				});
			}

			// FileuploadAttendance
			function FileuploadAttendance(businessId, dataId) {
				var businessId = businessId; 
				var id=dataId;
				var url = "/business/" + businessId + "/upload_attendance/"+dataId;
				var csrfToken = $('meta[name="csrf-token"]').attr('content');
				// alert(url);
				$.ajax({
					url: url,
					type: 'get',
					data: JSON.stringify({
						id: dataId
					}),
					contentType: 'application/json; charset=utf-8',
					headers: {
						'X-CSRF-TOKEN': csrfToken
					},
					success: function(response) {
						console.log("AJAX call successful:", response);
						$('#uploadedfile').text(response.message);
						$('#systemMessage1').hide();

					},
				});
			}

	        $('#upload-csv').click(function(){
	        	if(profile_pic_var == ''){
	        		$('.err').html('Select file to upload.');
	        	}else if(ext != 'csv' && ext != 'csvx' && ext != 'xls' && ext != 'xlsx'){
	            	$('.err').html('File format is not supported.')
	        	}else{
	        		$('.loading-container').removeClass('d-none');
	         	var formdata = new FormData();
	         	formdata.append('import_file',profile_pic_var);
	         	formdata.append('business_id','{{$company->id}}');
	          	formdata.append('_token','{{csrf_token()}}')
	          	$.ajax({
	               url: '{{route('business.customers.import')}}',
	               type:'post',
	               dataType: 'json',
	               enctype: 'multipart/form-data',
	               data:formdata,
	               processData: false,
	               contentType: false,
	               headers: {'X-CSRF-TOKEN': $("#_token").val()},
	               success: function (response) { 
	                  $('.loading-container').addClass('d-none');
	               	$('#systemMessage1').removeClass();
	                  if(response.status == 200){
	                     $('.uploadfile').modal('hide');
	                     $('#systemMessage1').addClass('font-green font-16');
	                     $('#systemMessage1').html(response.message);
						 Fileupload(response.data.business_id, response.data.id);
							// console.log(response);
						 /* setTimeout(function(){
	                        window.location.reload();
	                     },2000)*/
	                  }
	                  else{
	                		$('.uploadfile').modal('hide');
	                		$('#systemMessage1').addClass('font-red font-16');
	                		$('#systemMessage1').html(response.message).addClass('alert alert-danger alert-dismissible');
	                  }
	                  $('#file').val('')
	               }
	         	});
	        	}
	    	});

			

	    	$('#upload-membership').click(function(){
	        	if(profile_pic_var == ''){
	        		$('.err').html('Select file to upload.');
	        	}else if(ext != 'csv' && ext != 'csvx' && ext != 'xls' && ext != 'xlsx'){
	            	$('.err').html('File format is not supported.')
	        	}else{
	        			$('.loading-container').removeClass('d-none');
	            	var formdata = new FormData();
	            	formdata.append('import_file',profile_pic_var);
	            	formdata.append('business_id','{{$company->id}}');
	             	formdata.append('_token','{{csrf_token()}}')
	             	$.ajax({
	                  url:'/import-membership',
	                  type:'post',
	                  dataType: 'json',
	                  enctype: 'multipart/form-data',
	                  data:formdata,
	                  processData: false,
	                  contentType: false,
	                  headers: {'X-CSRF-TOKEN': $("#_token").val()},
	                  success: function (response) { 
	                  	$('.loading-container').addClass('d-none');
	                  	$('#systemMessage1').removeClass();
	                     if(response.status == 200){
	                        $('.uploadmembership').modal('hide');
	                        $('#systemMessage1').addClass('font-green font-16');
	                        $('#systemMessage1').html(response.message);
							FileuploadMember(response.data.business_id, response.data.id);
	                        /*setTimeout(function(){
	                           window.location.reload();
	                        },2000)*/
							// Fileupload();
	                     }
	                     else{
	                   		$('.uploadmembership').modal('hide');
	                   		$('#systemMessage1').addClass('font-red font-16');
	                   		$('#systemMessage1').html(response.message).addClass('alert alert-danger alert-dismissible');
	                     }
								$('#file').val('')
	                  }
	            	});
	        	}
	    	})
		

	
	    	$('#upload-attendance').click(function(){
	        	if(profile_pic_var == ''){
	        		$('.err').html('Select file to upload.');
	        	}else if(ext != 'csv' && ext != 'csvx' && ext != 'xls' && ext != 'xlsx'){
	            	$('.err').html('File format is not supported.')
	        	}else{
	        		$('.loading-container').removeClass('d-none');
	         	var formdata = new FormData();
	         	formdata.append('import_file',profile_pic_var);
	         	formdata.append('business_id','{{$company->id}}');
	          	formdata.append('_token','{{csrf_token()}}')
	          	$.ajax({
	               url:'/import-attendance',
	               type:'post',
	               dataType: 'json',
	               enctype: 'multipart/form-data',
	               data:formdata,
	               processData: false,
	               contentType: false,
	               headers: {'X-CSRF-TOKEN': $("#_token").val()},
	               success: function (response) { 
	               	$('.loading-container').addClass('d-none');
	               	$('#systemMessage1').removeClass();
	                  if(response.status == 200){
						$('#fileattendance').val('');
	                     $('.uploadAttendance').modal('hide');
	                     $('#systemMessage1').addClass('font-green font-16');
	                     $('#systemMessage1').html(response.message);
						 FileuploadAttendance(response.data.business_id, response.data.id);
	                     /*setTimeout(function(){
	                        window.location.reload();
	                     },2000)*/
	                  }
	                  else{
							$('#fileattendance').val('');
	                		$('.uploadAttendance').modal('hide');
	                		$('#systemMessage1').addClass('font-red font-16');
	                		$('#systemMessage1').html(response.message).addClass('alert alert-danger alert-dismissible');
	                  }
							// $('#file').val('')
	               }
	         	});
	        	}
	    	})
	    	
	    	$(document).on('click', '.delcustomer', function(e){
				e.preventDefault();
				let text = "Are you sure to delete this customer?";
				if (confirm(text) == true) {
					var token = $("meta[name='csrf-token']").attr("content");
				   $.ajax({
				      url: '/business/'+$(this).attr('data-business_id')+'/customers/delete/'+$(this).attr('data-id'),
				      type: 'DELETE',
				      data: {
				          "_token": token,
				      },
				      success: function (){
				      	location.reload();
				      }
				   });
				}
			});
		});


		function updateCounterAsync(counterType, counterElementId) {
			var businessId = '{{ request()->business_id }}';
	        return $.ajax({
	            url: '/getCustomerCounts/' + businessId,
	            type: 'GET',
	            data: { counterType: counterType }
	        }).then(function(response) {
	            $('#' + counterElementId).text(response.count);
	        }).fail(function(xhr, status, error) {
	            console.error('Error fetching counter:', error);
	        });
	    }

	    function updateCountersSequentially(counters) {
	        // Start with a resolved promise to begin the chain
	        let promise = $.Deferred().resolve();

	        // Iterate over each counter and chain the AJAX calls
	        counters.forEach(function(counter) {
	            promise = promise.then(function() {
	                // Return the promise of the next AJAX call
	                return updateCounterAsync(counter.type, counter.elementId);
	            });
	        });

	        // Return the final promise
	        return promise;
	    }



		function updateCustomerCounts() {
			// alert('1');
            var businessId = '{{ request()->business_id }}';
            $.ajax({
                url: '/getCustomerCounts/' + businessId,
                method: 'GET',
                success: function(response) {
                    $('#totalMembers').text('Total Members (' +response.totalMembers + ')');
                    $('#activeMembers').text('Active Members ('+response.activeMembers+')');
                    $('#inactiveMembers').text('Inactive Members ('+response.inactiveMembers+')');
                    $('#prospectMembers').text('Prospects (' +response.prospectMembers + ')');
                    $('#suspendedMembers').text('Suspended (' +response.suspendedMembers + ')');
                    $('#owedMembers').text('Owed ('+response.owedMembers+')');
                    $('#atRiskMembers').text('At-Risk ('+response.atRiskMembers+')');
                    $('#spenderMembers').text('Big Spenders ('+response.spenderMembers+')');
                },
                error: function(xhr, status, error) {
                    console.error(error);
                }
            });
        }


	
	</script>

	<script type="text/javascript">

		let offset  = 20;
	 	var isLoading = false;


	 	function getData(char){

	 		$('#accor_nestingExamplecollapse' + char).on('shown.bs.collapse', function () {
				$('#char').val(char);
				offset = 20;
				isLoading = false;
				$.ajax({
		         	url: '{{ route("load.view") }}',
		         	type: 'GET',
		         	data: {
		            	char: char,// Pass the variable here
		            	customer_type: '{{request()->customer_type}}',// Pass the variable here
		         	},
		         	success: function(response) {
			            // On success, set the HTML of the target div with the loaded view
			            $('#targetDiv'+char).html(response);
		        	},
		         	error: function(xhr) {
		             	// Handle the error if the AJAX request fails
		             	console.log(xhr.responseText);
		         	}
		     	});
		    });
		}

		$(document).ready(function () {
	      $(window).scroll(function () {
	   		var char = $('#char').val();
	   		if(char != ''){
	            if ($(window).scrollTop() + $(window).height() > $("#accor_nestingExamplecollapse"+char).height()) {
	               // Check if not already loading more records and not all records are loaded
	               if (!isLoading && offset !== -1) {
	                  loadMoreRecords(char);
	               }
	            }
	         }
	      });
	   });

	   function loadMoreRecords(char) {
	     isLoading = true;
	     $.ajax({
	         url: '/get-more-records',
	         method: 'GET',
	         data: { 
	         	offset: offset,
	         	char: char,
	         	customer_type: '{{request()->customer_type}}',
	         },
	         success: function (response) {
	            if (response != '') {
	               $('#targetDiv'+char).append(response);
	               offset = offset + 20;
	               isLoading = false;
	            }else {
	               // All records have been loaded
	               offset = -1;
	            }
	         },
	         error: function (xhr, status, error) {
	             console.error(error);
	             isLoading = false;
	         }
	     });
	   }
	</script> 


@endsection