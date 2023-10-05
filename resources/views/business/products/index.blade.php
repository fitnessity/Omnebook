@inject('request', 'Illuminate\Http\Request')
@extends('layouts.business.header')
 

@section('content')
	<link href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>  
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
    <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
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
										<label>Manage Store</label>
									</div>
								</div><!--end col-->
							</div><!--end row-->
					
							<div class="row">
								<div class="col-xl-3 col-lg-4">
									<div class="card">
										<div class="accordion accordion-flush filter-accordion">
											<div class="card-body">
												<div>
													<p class="text-muted text-uppercase fs-12 fw-medium mb-2">Products</p>
													<ul class="list-unstyled mb-0 filter-list" id="categoryList">
														<li data-category="">
															<a class="d-flex py-1 align-items-center filter-active">
																<div class="flex-grow-1">
																	<h5 class="fs-13 mb-0 listname">All</h5>
																</div>
																<div class="flex-shrink-0 ms-2">
																	<span class="badge bg-light text-muted">{{$productCount}}</span>
																</div>
															</a>
														</li>
														@foreach($productCategory as $c)
															<li data-category="{{ $c->id }}">
																<a class="d-flex py-1 align-items-center">
																	<div class="flex-grow-1">
																		<h5 class="fs-13 mb-0 listname">{{$c->name}}</h5>
																	</div>
																	<div class="flex-shrink-0 ms-2">
																		<span class="badge bg-light text-muted">{{$c->getCategoryProductCount()->count()}}</span>
																	</div>
																</a>
															</li>
														@endforeach
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
                                          <a href="{{route('business.products.create')}}" class="btn btn-red" id="addproduct-btn"><i class="ri-add-line align-bottom me-1"></i> Add Product</a>
                                       </div>
                                    </div>
												<!-- <div class="col-sm">
                                       <div class="d-flex justify-content-sm-end">
                                          <div class="search-box ms-2">
                                             <input type="text" class="form-control" id="searchProductList" placeholder="Search Products...">
                                             <i class="ri-search-line search-icon"></i>
                                          </div>
                                       </div>
                                   </div> -->
											</div>
										</div>
										<div class="card-body">
											<div>
												<table class="table table-bordered data-table" id="data-table">
										        	<thead>
										            <tr>
										               <th>Product Image</th>
															<th>Product Name</th>
															<th>Catagory </th>
															<th>Qty</th>
															<th>Low Qty Alert</th>
															<th>Sale Price</th>
															<th>Rental Price</th>
															<th>Your Cost</th>
															<th>Shipping Cost</th>
										               <th width="100px">Action</th>
										            </tr>
										       	</thead>
											      <tbody>
											      </tbody>
										    	</table>

												<!-- <div class="table-responsive table-card mb-1">
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
																<th>Rental Price</th>
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
																<td> $14.00 </td>
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
																<td> $56.00 </td>
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
																<td> $34.00 </td>
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
																<td> $77.00 </td>
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
																<td> $22.00 </td>
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
																<td> $4.00 </td>
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
																<td> $13.00 </td>
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
																<td> $53.00 </td>
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
																<td> $23.00 </td>
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
												</div> -->

											</div>
										</div>
									</div>
								</div>
								<!--end col-->
							</div><!--end row-->
						</div> <!-- end .h-100-->
               </div> <!-- end col -->
            </div>
         </div><!-- container-fluid -->
      </div><!-- End Page-content -->
   </div><!-- end main content-->
</div><!-- END layout-wrapper -->

	@include('layouts.business.footer')


	<script type="text/javascript">

		$(document).ready(function() {
		    var table = $('#data-table').DataTable({
		        	processing: true,
		        	serverSide: true,
		        	ajax: "{{ route('business.products.index') }}", // Replace with your actual route
		        	order: [],
		         scrollY: "300px", 
		        	scrollCollapse: true,
		        	fixedHeader: true,
		        	columns: [
		            {data: 'product_image1', name: 'product_image1'},
		            {data: 'name', name: 'name'},
		            {data: 'category1',name: 'category1'},
		            {data: 'quantity', name: 'quantity'},
		            {data: 'low_quantity_alert', name: 'low_quantity_alert'},
		            {data: 'sale_price', name: 'sale_price'},
		            {data: 'rental_price', name: 'rental_price'},
		            {data: 'business_cost', name: 'business_cost'},
		            {data: 'shipping_cost', name: 'shipping_cost'},
		            {data: 'action', name: 'action', orderable: true, searchable: true},
			      ]
		   });

		   $('#categoryList li').click(function() {
		    	$('#categoryList a').removeClass('filter-active');
		      $(this).find('a').addClass('filter-active');
	        	var categoryId = $(this).data('category');
	        	table.ajax.url("{{ route('business.products.index') }}?categoryId=" + categoryId).load();
	    	});
		});

		function  deleteProduct(id) {
			if(confirm("Are you sure you want to delete this product?")){
				$.ajax({
					url:'/business/'+'{{$business_id}}'+'/products/'+id,
					method: "DELETE",
					data: { 
		            _token: '{{csrf_token()}}'
		        	},
					success:function(e){
						window.location.reload();
					}
				});
			}
		}

		function  EditProduct(id) {
			 window.open('/business/'+'{{$business_id}}'+'/products/create?id='+id, '_blank');	
		}
		
</script>

@endsection