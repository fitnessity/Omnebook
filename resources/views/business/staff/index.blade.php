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
								<div class="col-12">
									<div class="page-heading">
										<label>Manage Staff</label>
									</div>
								</div>
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
															<!-- <div class="col-lg-8 col-md-7 col-sm-8">
																<div class="search-box">
																	<input type="text" class="form-control search" placeholder="Search Staff Name">
																	<i class="ri-search-line search-icon"></i>
																</div>
															</div> -->
														</div>
													</div>
													<div class="col-xl-6 col-sm-4 col-md-4 col-12">
														<div class="row g-3">
															<div class="col-lg-4 col-sm-9 col-md-9 col-6">
																<!-- <div>
																	<button type="button" class="btn btn-red w-100" onclick="SearchData();">Search</button>
																</div> -->
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
																<!-- <th scope="col" style="width: 50px;">
																	<div class="form-check">
																		<input class="form-check-input" type="checkbox" id="checkAll" value="option">
																	</div>
																</th> -->
																<th class="sort" data-sort="customer_name">Profile Image</th>
																<th class="sort" data-sort="email">Full Name</th>
																<th class="sort" data-sort="phone">Position</th>
																<th class="sort" data-sort="status">Status</th>
																<th class="sort" data-sort="action">Action</th>
															</tr>
														</thead>
														<tbody class="list form-check-all">
															@foreach($companyStaff as $cf)
															<tr>
																<!-- <th scope="row">
																	<div class="form-check">
																		<input class="form-check-input" type="checkbox" name="chk_child" value="option1">
																	</div>
																</th> -->
																<td class="">
																	@if($cf->profile_pic != '')
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
																	<!-- <span class="badge badge-soft-danger text-uppercase">Inactive</span> -->
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

    @include('layouts.business.footer')
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