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
								<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
									<div class="page-heading">
										<label>Manage Customers</label>
									</div>
								</div>
								<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
									<div class="import-export float-end mt-10">
										<button href="#" data-bs-toggle="modal" data-bs-target=".uploadfileall" class="btn btn-red">Upload</button>
										<!-- <button href="#" data-bs-toggle="modal" data-bs-target=".uploadfile" class="btn btn-red">Import List</button> -->
										<form method="get" action="/exportcustomer">
											<input type="hidden" name="chk" id="chk" value="empty">
											<input type="hidden" name="id" id="id" value="{{$company->id}}">
											<button type="submit" class="btn btn-black">Export List</button> 
										</form>
										<!-- <button href="#" data-bs-toggle="modal" data-bs-target=".uploadmembership" class="btn btn-red">Import Membership Details</button> -->
									</div>
								</div>
							</div>

							<div class="">
								<label id="systemMessage1" class="font-16"></label>
							</div>
							
							<div class="row">
								<div class="col-xl-12">
									<div class="card">
										<div class="card-header align-items-center d-flex">
											<h4 class="card-title mb-0 flex-grow-1">Customers</h4>
										</div><!-- end card header -->
										<div class="card-body">
										   <div class="total-clients">
												<i class="fas fa-user-circle"></i>
												<label>You Have {{$customerCount}} Clients</label>
											</div>
										   <div class="live-preview">
												<div class="accordion custom-accordionwithicon accordion-border-box" id="accordionnesting">

													@foreach ($grouped_customers as $sectionLetter => $customers)
													<div class="accordion-item shadow">
														<h2 class="accordion-header" id="accordionnestingExample{{$sectionLetter}}">
															<button class="accordion-button collapsed uppercase" type="button" data-bs-toggle="collapse" data-bs-target="#accor_nestingExamplecollapse{{$sectionLetter}}" aria-expanded="false" aria-controls="accor_nestingExamplecollapse{{$sectionLetter}}">{{$sectionLetter}}</button></h2>
														<div id="accor_nestingExamplecollapse{{$sectionLetter}}" class="accordion-collapse collapse" aria-labelledby="accordionnestingExample{{$sectionLetter}}" data-bs-parent="#accordionnesting">
															<div class="accordion-body">
																@foreach ($customers as $customer) 
															   <div class="mini-stats-wid d-flex align-items-center mt-3 scheduler-box">
																	<div class="flex-shrink-0 avatar-sm">
																		@if($customer->profile_pic)
                                             				<img class='mini-stat-icon avatar-title rounded-circle text-success bg-soft-red fs-4' src="{{Storage::Url($customer->profile_pic)}}" width=60 height=60 alt="">
                                          				@else
                                                			<span class="mini-stat-icon avatar-title rounded-circle text-success bg-soft-red fs-4 uppercase">{{$sectionLetter}}</span>
                                          				@endif
																	</div>
																	<div class="col-lg-2 col-md-3 col-sm-3 ms-3">
																		<h6 class="mb-1">{{$customer->full_name}}</h6>
																		<p class="text-muted mb-0">Last Attended:  {{$customer->get_last_seen()}}</p>
																	</div>
																	<div class="col-lg-3 col-md-4 col-sm-4 ms-3">
																		<div class="client-age">
																			<h6 class="mb-1">Age</h6>
																			<span>{{ $customer->age != '' ? $customer->age : "-"}}</span>
																		</div>
																	</div>
													
																	<div class="flex-grow-1 ms-3">
																		<a class="float-end" href="#" data-bs-toggle="modal" data-bs-target=".customer-info{{$customer->id}}"><i class="ri-more-fill"></i></a>
																	</div>
																</div>

																<div class="modal fade customer-info{{$customer->id}}" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
																	<div class="modal-dialog modal-dialog-centered customer-modal-width">
																		<div class="modal-content">
																			<div class="modal-header">
																				<h5 class="modal-title" id="myModalLabel">Manage Customers</h5>
																				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
																			</div>
																			<div class="modal-body">
																				<div class="scheduler-table">
																					<div class="table-responsive">
																						<table class="table mb-0">
																							<thead>
																								<tr>
																									<th>Status</th>
																									<th>Active Memberships</th>
																									<th>Expiring Soon</th>
																									<th></th>
																									<th></th>
																								</tr>
																							</thead>
																							<tbody>
																								<tr>
																									<td><p class="mb-0 {{ $customer->is_active() == 0 ? 'font-red' : 'font-green'}}">{{ $customer->is_active() == 0 ? "InActive" : "Active"}}</p>
																									</td>
																									<td>
																										<p class="mb-0">{{$customer->active_memberships()->get()->count()}}</p>
																									</td>
																									<td>
																										<p class="mb-0">{{$customer->expired_soon()}}</p>
																									</td>
																									<td>
																										<div class="scheduled-btns">
																											<button type="submit" class="btn btn-red mb-10" onclick="sendmail({{$customer->id}},{{$company->id}});">Send Welcome Email</button>
																											<a type="button" class="btn btn-black mb-10" href="{{ route('business_customer_show',['business_id' => $company->id, 'id'=>$customer->id]) }}" target="_blank">View Account</a>
																										</div>
																									</td>
																									<td>
																										<div class="scheduled-btns">
																											<a data-business_id = "{{$company->id}}" data-id="{{$customer->id}}" class="btn btn-red delcustomer">Delete
																											</a>
																										</div>
																									</td>
																								</tr>
																							</tbody>
																						</table>
																					</div>
																				</div>
																			</div>
																		</div><!-- /.modal-content -->
																	</div><!-- /.modal-dialog -->
																</div>
															 	@endforeach
															</div>
														</div>
													</div>
													@endforeach
												</div>
											</div>
										</div><!-- end card-body -->
									</div><!-- end card -->
								</div>
								<!--end col-->
							</div>				
						</div> 
               </div> 
            </div>
         </div>
      </div>
   </div>
</div>
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
					<input type="file" class="form-control" name="file" id="file" onchange="readURL(this)">
					 <p class='err' style="color:red;padding-top:10px;"></p>
				</div>					
			</div>
			<div class="modal-footer">
				<button type="button" id="upload-csv" class="btn btn-primary btn-red">Upload File</button>
			</div>
		</div>
	</div>
</div><!-- /.modal -->

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
					<input type="file" class="form-control" name="membershipFile" id="file" onchange="readURL(this)">
					 <p class='err' style="color:red;padding-top:10px;"></p>
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
					<button type="button"  data-bs-toggle="modal" data-bs-target=".uploadfile" id="upload-csv1" class="btn btn-primary btn-red mb-10">Upload Client List</button>
					<button type="button" id="upload-csv2" class="btn btn-primary btn-black mb-10" data-bs-toggle="modal" data-bs-target=".uploadmembership" >Upload Membership Details</button>
					<button type="button" id="upload-csv3" class="btn btn-primary btn-red mb-10" data-bs-toggle="modal" data-bs-target=".uploadAttendance" >Upload Attendance Details</button>
				</div>
			</div>
		</div>
	</div>
</div><!-- /.modal -->
    
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
					<input type="file" class="form-control" name="attendanceFile" id="file" onchange="readURL(this)">
					 <p class='err' style="color:red;padding-top:10px;"></p>
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
         reader.readAsDataURL(input.files[0]);
     }
	}
</script>

	<script type="text/javascript">
		$(document).ready(function () {

	      $('#upload-csv').click(function(){
	        	if(profile_pic_var == ''){
	        		$('.err').html('Select file to upload.');
	        	}else if(ext != 'csv' && ext != 'csvx' && ext != 'xls' && ext != 'xlsx'){
	            	$('.err').html('File format is not supported.')
	        	}else{
            	var formdata = new FormData();
            	formdata.append('import_file',profile_pic_var);
            	formdata.append('business_id','{{$company->id}}');
             	formdata.append('_token','{{csrf_token()}}')
             	$.ajax({
                  url:'/import-customer',
                  type:'post',
                  dataType: 'json',
                  enctype: 'multipart/form-data',
                  data:formdata,
                  processData: false,
                  contentType: false,
                  headers: {'X-CSRF-TOKEN': $("#_token").val()},
                  beforeSend: function () {
                     $('.loader').show();
                  },
                  complete: function () {
                     $('.loader').hide();
                  },
                  success: function (response) { 
                  	$('#systemMessage1').removeClass();
                     if(response.status == 200){
                        $('.uploadfile').modal('hide');
                        $('#systemMessage1').addClass('font-green font-16');
                        $('#systemMessage1').html("Upload Successful..");
                       /* setTimeout(function(){
                           window.location.reload();
                        },2000)*/
                     }
                     else{
                   		$('.uploadfile').modal('hide');
                   		$('#systemMessage1').addClass('font-red font-16');
                   		$('#systemMessage1').html("Upload Error, Try again.").addClass('alert alert-danger alert-dismissible');
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
	                  	$('#systemMessage1').removeClass();
	                     if(response.status == 200){
	                        $('.uploadmembership').modal('hide');
	                        $('#systemMessage1').addClass('font-green font-16');
	                        $('#systemMessage1').html("Upload Successful..");
	                        /*setTimeout(function(){
	                           window.location.reload();
	                        },2000)*/
	                     }
	                     else{
	                   		$('.uploadmembership').modal('hide');
	                   		$('#systemMessage1').addClass('font-red font-16');
	                   		$('#systemMessage1').html("Upload Error, Try again.").addClass('alert alert-danger alert-dismissible');
	                     }
								$('#file').val('')
	                  }
	            	});
	        	}
	    	})

	    	*$('#upload-attendance').click(function(){
	        	if(profile_pic_var == ''){
	        		$('.err').html('Select file to upload.');
	        	}else if(ext != 'csv' && ext != 'csvx' && ext != 'xls' && ext != 'xlsx'){
	            	$('.err').html('File format is not supported.')
	        	}else{
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
                  	$('#systemMessage1').removeClass();
                     if(response.status == 200){
                        $('.uploadAttendance').modal('hide');
                        $('#systemMessage1').addClass('font-green font-16');
                        $('#systemMessage1').html("Upload Successful..");
                        /*setTimeout(function(){
                           window.location.reload();
                        },2000)*/
                     }
                     else{
                   		$('.uploadAttendance').modal('hide');
                   		$('#systemMessage1').addClass('font-red font-16');
                   		$('#systemMessage1').html("Upload Error, Try again.").addClass('alert alert-danger alert-dismissible');
                     }
							$('#file').val('')
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

		function  sendmail(cid,bid) {
			$.ajax({
				url:'{{route("sendemailtocutomer")}}',
				type:"GET",
				xhrFields: {
	            withCredentials: true
	         },
				data:{
					cid:cid,
					bid:bid,
				},
				success:function(response){
					if(response == 'success'){
	                    //$('.reviewerro').html('Email Successfully Sent..');
	                  alert('Email Successfully Sent..');
	                }else{
	                    //$('.reviewerro').html("Can't Mail on this Address. Plese Check your Email..");
	                  alert("Can't Mail on this Address. Plese Check Email..");
	                }
				}
			});
		}
	</script>
@endsection