@inject('request', 'Illuminate\Http\Request')
@extends('layouts.business.header')

@section('content')

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
                        <div class="row mb-3">
							<div class="col-12">
								<div class="page-heading">
									<label>Manage Staff</label>
								</div>
							</div>
                            <!--end col-->
						</div>
                        <!--end row-->
					
						<div class="row">
							<div class="col-xl-3 col-lg-4">
								<div class="card">
									<div class="accordion accordion-flush filter-accordion">
										<div class="card-body">
											<div>
												<p class="text-muted text-uppercase fs-12 fw-medium mb-2">Products</p>
												<ul class="list-unstyled mb-0 filter-list">
													<li>
														<a href="#" class="d-flex py-1 align-items-center">
															<div class="flex-grow-1">
																<h5 class="fs-13 mb-0 listname">Grocery</h5>
															</div>
														</a>
													</li>
													<li>
														<a href="#" class="d-flex py-1 align-items-center">
															<div class="flex-grow-1">
																<h5 class="fs-13 mb-0 listname">Fashion</h5>
															</div>
															<div class="flex-shrink-0 ms-2">
																<span class="badge bg-light text-muted">5</span>
															</div>
														</a>
													</li>
													<li>
														<a href="#" class="d-flex py-1 align-items-center">
															<div class="flex-grow-1">
																<h5 class="fs-13 mb-0 listname">Watches</h5>
															</div>
														</a>
													</li>
													<li>
														<a href="#" class="d-flex py-1 align-items-center">
															<div class="flex-grow-1">
																<h5 class="fs-13 mb-0 listname">Electronics</h5>
															</div>
															<div class="flex-shrink-0 ms-2">
																<span class="badge bg-light text-muted">5</span>
															</div>
														</a>
													</li>
													<li>
														<a href="#" class="d-flex py-1 align-items-center">
															<div class="flex-grow-1">
																<h5 class="fs-13 mb-0 listname">Furniture</h5>
															</div>
															<div class="flex-shrink-0 ms-2">
																<span class="badge bg-light text-muted">6</span>
															</div>
														</a>
													</li>
													<li>
														<a href="#" class="d-flex py-1 align-items-center">
															<div class="flex-grow-1">
																<h5 class="fs-13 mb-0 listname">Automotive Accessories</h5>
															</div>
														</a>
													</li>
													<li>
														<a href="#" class="d-flex py-1 align-items-center">
															<div class="flex-grow-1">
																<h5 class="fs-13 mb-0 listname">Appliances</h5>
															</div>
															<div class="flex-shrink-0 ms-2">
																<span class="badge bg-light text-muted">7</span>
															</div>
														</a>
													</li>

													<li>
														<a href="#" class="d-flex py-1 align-items-center">
															<div class="flex-grow-1">
																<h5 class="fs-13 mb-0 listname">Kids</h5>
															</div>
														</a>
													</li>
												</ul>
											</div>
										</div>


									</div>
								</div>
								<!-- end card -->
							</div>
							<!-- end col -->
							<div class="col-xl-9 col-lg-8">
								<div class="card" id="customerList">
									<div class="card-header border-bottom-dashed">
										<div class="row g-4">
											<div class="col-sm-auto">
                                                <div>
                                                    <a href="apps-ecommerce-add-product.html" class="btn btn-red" id="addproduct-btn"><i class="ri-add-line align-bottom me-1"></i> Add Product</a>
                                                </div>
                                            </div>
											<div class="col-sm">
                                                <div class="d-flex justify-content-sm-end">
                                                    <div class="search-box ms-2">
                                                        <input type="text" class="form-control" id="searchProductList" placeholder="Search Products...">
                                                        <i class="ri-search-line search-icon"></i>
                                                    </div>
                                                </div>
                                            </div>
										</div>
									</div>
									<div class="card-body">
										<div>
											<div class="table-responsive table-card mb-1">
												<table class="table align-middle" id="customerTable">
													<thead class="table-light text-muted">
														<tr>
															<th scope="col" style="width: 50px;">
																<div class="form-check">
																	<input class="form-check-input" type="checkbox" id="checkAll" value="option">
																</div>
															</th>

															<th>Product Image</th>
															<th>Product Name</th>
															<th>Catagory </th>
															<th>Qty</th>
															<th>Low Qty Alert</th>
															<th>Sale Price</th>
															<th>Your Cost</th>
															<th>Shipping Cost</th>
															<th>Action</th>
															 	
														</tr>
													</thead>
													<tbody class="list form-check-all">
														<tr>
															<th scope="row">
																<div class="form-check">
																	<input class="form-check-input" type="checkbox" name="chk_child" value="option1">
																</div>
															</th>
															<td class="">
																<div class="avatar-xsmall">
																	<span class="mini-stat-icon avatar-title xsmall-font rounded-circle text-success bg-soft-red fs-4 uppercase">A</span>
                                          						</div>
															</td>
															<td class="customer_name">T-Shirts</td>
															<td class="email">Fashion</td>
															<td class="status">50</td>
															<td>5</td>
															<td> $10.00 </td>
															<td>$4.95 </td>
															<td>$10.95</td>
															<td>
																<ul class="list-inline hstack gap-2 mb-0">
																	<li class="list-inline-item edit">
																		<a href="#" class="font-black d-inline-block edit-item-btn">
																			<i class="ri-pencil-fill fs-16"></i>
																		</a>
																	</li>
																	<li class="list-inline-item">
																		<a class="text-danger d-inline-block remove-item-btn" href="#">
																			<i class="ri-delete-bin-5-fill fs-16"></i>
																		</a>
																	</li>
																</ul>
															</td>
														</tr>
														<tr>
															<th scope="row">
																<div class="form-check">
																	<input class="form-check-input" type="checkbox" name="chk_child" value="option1">
																</div>
															</th>
															<td class="">
																<img src="http://dev.fitnessity.co/public/uploads/profile_pic/thumb/1669274706-1650612371-20.jpg" alt="" class="avatar-xs rounded-circle me-2 shadow">
															</td>
															<td class="customer_name">T-Shirts</td>
															<td class="email">Fashion</td>
															<td class="status">50</td>
															<td>5</td>
															<td> $10.00 </td>
															<td>$4.95 </td>
															<td>$10.95</td>
															<td>
																<ul class="list-inline hstack gap-2 mb-0">
																	<li class="list-inline-item edit">
																		<a href="#" class="font-black d-inline-block edit-item-btn">
																			<i class="ri-pencil-fill fs-16"></i>
																		</a>
																	</li>
																	<li class="list-inline-item">
																		<a class="text-danger d-inline-block remove-item-btn" href="#">
																			<i class="ri-delete-bin-5-fill fs-16"></i>
																		</a>
																	</li>
																</ul>
															</td>
														</tr>
														<tr>
															<th scope="row">
																<div class="form-check">
																	<input class="form-check-input" type="checkbox" name="chk_child" value="option1">
																</div>
															</th>
															<td class="">
																<img src="http://dev.fitnessity.co/public/uploads/profile_pic/thumb/1669274706-1650612371-20.jpg" alt="" class="avatar-xs rounded-circle me-2 shadow">
															</td>
															<td class="customer_name">T-Shirts</td>
															<td class="email">Fashion</td>
															<td class="status">50</td>
															<td>5</td>
															<td> $10.00 </td>
															<td>$4.95 </td>
															<td>$10.95</td>
															<td>
																<ul class="list-inline hstack gap-2 mb-0">
																	<li class="list-inline-item edit">
																		<a href="#" class="font-black d-inline-block edit-item-btn">
																			<i class="ri-pencil-fill fs-16"></i>
																		</a>
																	</li>
																	<li class="list-inline-item">
																		<a class="text-danger d-inline-block remove-item-btn" href="#">
																			<i class="ri-delete-bin-5-fill fs-16"></i>
																		</a>
																	</li>
																</ul>
															</td>
														</tr>
														<tr>
															<th scope="row">
																<div class="form-check">
																	<input class="form-check-input" type="checkbox" name="chk_child" value="option1">
																</div>
															</th>
															<td class="">
																<img src="http://dev.fitnessity.co/public/uploads/profile_pic/thumb/1669274706-1650612371-20.jpg" alt="" class="avatar-xs rounded-circle me-2 shadow">
															</td>
															<td class="customer_name">T-Shirts</td>
															<td class="email">Fashion</td>
															<td class="status">50</td>
															<td>5</td>
															<td> $10.00 </td>
															<td>$4.95 </td>
															<td>$10.95</td>
															<td>
																<ul class="list-inline hstack gap-2 mb-0">
																	<li class="list-inline-item edit">
																		<a href="#" class="font-black d-inline-block edit-item-btn">
																			<i class="ri-pencil-fill fs-16"></i>
																		</a>
																	</li>
																	<li class="list-inline-item">
																		<a class="text-danger d-inline-block remove-item-btn" href="#">
																			<i class="ri-delete-bin-5-fill fs-16"></i>
																		</a>
																	</li>
																</ul>
															</td>
														</tr>
														<tr>
															<th scope="row">
																<div class="form-check">
																	<input class="form-check-input" type="checkbox" name="chk_child" value="option1">
																</div>
															</th>
															<td class="">
																<img src="http://dev.fitnessity.co/public/uploads/profile_pic/thumb/1669274706-1650612371-20.jpg" alt="" class="avatar-xs rounded-circle me-2 shadow">
															</td>
															<td class="customer_name">T-Shirts</td>
															<td class="email">Fashion</td>
															<td class="status">50</td>
															<td>5</td>
															<td> $10.00 </td>
															<td>$4.95 </td>
															<td>$10.95</td>
															<td>
																<ul class="list-inline hstack gap-2 mb-0">
																	<li class="list-inline-item edit">
																		<a href="#" class="font-black d-inline-block edit-item-btn">
																			<i class="ri-pencil-fill fs-16"></i>
																		</a>
																	</li>
																	<li class="list-inline-item">
																		<a class="text-danger d-inline-block remove-item-btn" href="#">
																			<i class="ri-delete-bin-5-fill fs-16"></i>
																		</a>
																	</li>
																</ul>
															</td>
														</tr>
														<tr>
															<th scope="row">
																<div class="form-check">
																	<input class="form-check-input" type="checkbox" name="chk_child" value="option1">
																</div>
															</th>
															<td class="">
																<img src="http://dev.fitnessity.co/public/uploads/profile_pic/thumb/1669274706-1650612371-20.jpg" alt="" class="avatar-xs rounded-circle me-2 shadow">
															</td>
															<td class="customer_name">T-Shirts</td>
															<td class="email">Fashion</td>
															<td class="status">50</td>
															<td>5</td>
															<td> $10.00 </td>
															<td>$4.95 </td>
															<td>$10.95</td>
															<td>
																<ul class="list-inline hstack gap-2 mb-0">
																	<li class="list-inline-item edit">
																		<a href="#" class="font-black d-inline-block edit-item-btn">
																			<i class="ri-pencil-fill fs-16"></i>
																		</a>
																	</li>
																	<li class="list-inline-item">
																		<a class="text-danger d-inline-block remove-item-btn" href="#">
																			<i class="ri-delete-bin-5-fill fs-16"></i>
																		</a>
																	</li>
																</ul>
															</td>
														</tr>
														<tr>
															<th scope="row">
																<div class="form-check">
																	<input class="form-check-input" type="checkbox" name="chk_child" value="option1">
																</div>
															</th>
															<td class="">
																<img src="http://dev.fitnessity.co/public/uploads/profile_pic/thumb/1669274706-1650612371-20.jpg" alt="" class="avatar-xs rounded-circle me-2 shadow">
															</td>
															<td class="customer_name">T-Shirts</td>
															<td class="email">Fashion</td>
															<td class="status">50</td>
															<td>5</td>
															<td> $10.00 </td>
															<td>$4.95 </td>
															<td>$10.95</td>
															<td>
																<ul class="list-inline hstack gap-2 mb-0">
																	<li class="list-inline-item edit">
																		<a href="#" class="font-black d-inline-block edit-item-btn">
																			<i class="ri-pencil-fill fs-16"></i>
																		</a>
																	</li>
																	<li class="list-inline-item">
																		<a class="text-danger d-inline-block remove-item-btn" href="#">
																			<i class="ri-delete-bin-5-fill fs-16"></i>
																		</a>
																	</li>
																</ul>
															</td>
														</tr>
														<tr>
															<th scope="row">
																<div class="form-check">
																	<input class="form-check-input" type="checkbox" name="chk_child" value="option1">
																</div>
															</th>
															<td class="">
																<img src="http://dev.fitnessity.co/public/uploads/profile_pic/thumb/1669274706-1650612371-20.jpg" alt="" class="avatar-xs rounded-circle me-2 shadow">
															</td>
															<td class="customer_name"> T-Shirts</td>
															<td class="email">Fashion</td>
															<td class="status">50</td>
															<td>5</td>
															<td> $10.00 </td>
															<td>$4.95 </td>
															<td>$10.95</td>
															<td>
																<ul class="list-inline hstack gap-2 mb-0">
																	<li class="list-inline-item edit">
																		<a href="#" class="font-black d-inline-block edit-item-btn">
																			<i class="ri-pencil-fill fs-16"></i>
																		</a>
																	</li>
																	<li class="list-inline-item">
																		<a class="text-danger d-inline-block remove-item-btn" href="#">
																			<i class="ri-delete-bin-5-fill fs-16"></i>
																		</a>
																	</li>
																</ul>
															</td>
														</tr>
														<tr>
															<th scope="row">
																<div class="form-check">
																	<input class="form-check-input" type="checkbox" name="chk_child" value="option1">
																</div>
															</th>
															<td class="">
																<img src="http://dev.fitnessity.co/public/uploads/profile_pic/thumb/1669274706-1650612371-20.jpg" alt="" class="avatar-xs rounded-circle me-2 shadow">
															</td>
															<td class="customer_name">T-Shirts</td>
															<td class="email">Fashion</td>
															<td class="status">50</td>
															<td>5</td>
															<td> $10.00 </td>
															<td>$4.95 </td>
															<td>$10.95</td>
															<td>
																<ul class="list-inline hstack gap-2 mb-0">
																	<li class="list-inline-item edit">
																		<a href="#" class="font-black d-inline-block edit-item-btn">
																			<i class="ri-pencil-fill fs-16"></i>
																		</a>
																	</li>
																	<li class="list-inline-item">
																		<a class="text-danger d-inline-block remove-item-btn" href="#">
																			<i class="ri-delete-bin-5-fill fs-16"></i>
																		</a>
																	</li>
																</ul>
															</td>
														</tr>
														
													</tbody>
												</table>
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
							<!--end col-->
						</div>
						<!--end row-->
					
					</div> <!-- end .h-100-->
                  </div> <!-- end col -->
                </div>
            </div><!-- container-fluid -->
        </div><!-- End Page-content -->
     </div><!-- end main content-->
</div><!-- END layout-wrapper -->

	
	
	@include('layouts.business.footer')

@endsection