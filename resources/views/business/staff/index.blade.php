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
										<label>Manage Staff</label>
									</div>
								</div>
								<div class="col-6">
									<div class="import-export float-end mt-10">
										<button href="#" data-bs-toggle="modal" data-bs-target=".uploadfile" class="btn btn-red">Upload</button>
									</div>
								</div>
							</div>
							<div class="">
								<label id="systemMessage1" class="font-16"></label>
							</div>
							<div class="row">
								<div class="col-lg-12">
									<div class="card" id="customerList">
										<div class="card-header border-bottom-dashed">
											<div class="row g-4 align-items-center">
												<div class="col-sm">
													<div>
														<h5 class="card-title mb-0">Staff List</h5>
													</div>
												</div>
											</div>
										</div>
										<div class="card-body border-bottom-dashed border-bottom">
											<form>
												<div class="row g-3">
													<div class="col-xl-6 col-sm-8 col-md-8 col-12">
														<div class="row g-3">
															<div class="col-lg-4 col-md-5 col-sm-4">
																<div>
																	<button data-behavior="ajax_html_modal" data-url="{{route('business.staff.create',['business_id'=>$request->business_id])}}"  data-modal-width="modal-80"  type="button" class="btn btn-red w-100">Add Staff</button>
																</div>
															</div>
														</div>
													</div>
													<div class="col-xl-6 col-sm-4 col-md-4 col-12">
														<div class="row g-3">
															<div class="col-lg-4 col-sm-9 col-md-9 col-6">
															</div>
															<div class="col-lg-8 col-sm-3 col-md-3 col-6">
																<a data-behavior="ajax_html_modal" data-url="{{route('business.staff.position_modal',['business_id'=>$request->business_id])}}" data-modal-width=" " class="float-end"><i class="ri-more-fill"></i></a>
															</div>
														</div>
													</div>
												</div>
											</form>
										</div>
										<div class="font-red text-center mb-10 mt-10">{{ session('error') }}</div>
										<div class="font-green text-center mb-10 mt-10">{{ session('success') }}</div>
										<div class="card-body">
											<div>
												<div class="table-responsive table-card mb-1">
													<table class="table align-middle" id="customerTable">
														<thead class="table-light text-muted">
															<tr>
																<th class="sort" data-sort="customer_name">Profile Image</th>
																<th class="sort" data-sort="email">Full Name</th>
																<th class="sort" data-sort="phone">Position</th>
																<th class="sort" data-sort="status">Status</th>
																<th class="sort" data-sort="action">Action</th>
															</tr>
														</thead>
														<tbody class="form-check-all">
															@foreach($companyStaff as $cf)
															<tr>
																<td class="">
																	@if(Storage::disk('s3')->exists($cf->profile_pic))
																		<img src="{{Storage::Url($cf->profile_pic)}}" alt="" class="avatar-xs rounded-circle me-2 shadow">
																	@else
																		<div class="avatar-xsmall">
																			<span class="mini-stat-icon avatar-title xsmall-font rounded-circle text-success bg-soft-red fs-4 uppercase">{{$cf->first_name[0]}}</span>
		                                          						</div>
																	@endif
																</td>
																<td class="customer_name">{{$cf->full_name}}</td>
																<td class="">{{$cf->position}}</td>
																<td class="status">
																	<span class="badge badge-soft-success text-uppercase">Active</span>
																</td>
																<td>
																	<ul class="list-inline hstack gap-2 mb-0">
																		<li class="list-inline-item edit" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="top" title="Edit">
																			<a href="{{route('business.staff.show',['business_id'=>$cf->business_id,'staff'=>$cf->id])}}" class="font-black d-inline-block edit-item-btn">
																				<i class="ri-pencil-fill fs-16"></i>
																			</a>
																		</li>
																		<li class="list-inline-item" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="top" title="Remove">
																			<a href="#" data-id="{{$cf->id}}" data-cid="{{$cf->business_id}}" class="text-danger d-inline-block remove-item-btn" >
																				<i class="ri-delete-bin-5-fill fs-16"></i>
																			</a>
																		</li>
																	</ul>
																</td>
															</tr>
															@endforeach
														</tbody>
													</table>
													<div class="noresult" style="display: none">
														<div class="text-center">
															<lord-icon src="https://cdn.lordicon.com/msoeawqm.json" trigger="loop" colors="primary:#121331,secondary:#08a88a" style="width:75px;height:75px"></lord-icon>
															<h5 class="mt-2">Sorry! No Result Found</h5>
															<p class="text-muted mb-0">We've searched more than 150+ customer We did not find any customer for you search.</p>
														</div>
													</div>
												</div>
												<div class="d-flex justify-content-end">
													<div class="pagination-wrap hstack gap-2">
														<a class="page-item pagination-prev disabled" href="#">
															Previous
														</a>
														<ul class="pagination listjs-pagination mb-0"></ul>
														<a class="page-item pagination-next" href="#">
															Next
														</a>
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
					<input type="file" class="form-control" name="file" id="staffFile" onchange="readURL(this)">
					 <p class="err" style="color:red;padding-top:10px;"></p>
				</div>					
			</div>
			<div class="modal-footer">
				<button type="button" id="upload-csv" class="btn btn-primary btn-red">Upload File</button>
			</div>
		</div>
	</div>
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
        		business_id = '{{$request->business_id}}';
	        	var formdata = new FormData();
	        	formdata.append('import_file',profile_pic_var);
	        	formdata.append('business_id',business_id);
	         formdata.append('_token','{{csrf_token()}}')
	         $.ajax({
               url:'/import-staff',
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
                   	 setTimeout(function(){
                       window.location.reload();
                    	},2500)
                 	}
                 	else{
               		$('.uploadfile').modal('hide');
               		$('#systemMessage1').addClass('font-red font-16');
               		$('#systemMessage1').html("Upload Error, Try again.").addClass('alert alert-danger alert-dismissible');
                 	}
                 	$('#staffFile').val('')
              	}
	        	});
        	}
    	});
   });

</script>
<script type="text/javascript">
	$('.remove-item-btn').click(function(e){
		$.ajax({
			url:'/business/'+$(this).attr('data-cid')+'/staff/'+$(this).attr('data-id'),
			type:'DELETE',
			data:{_token:$('meta[name="csrf-token"]').attr('content')},
			success:function(response){
				if(response == 'success'){
					alert('Staff member successfully deletd.');
					window.location.reload();
				}else{
					alert("You can't delete this staff member as it has already been assigned.");
				}
			}
		});
	});
</script>
@endsection