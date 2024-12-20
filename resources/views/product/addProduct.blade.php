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
									<h1>Manage Product</h1>
								</div>
							</div><!--end col-->
						</div><!--end row-->
                        <form id="createproducts" action="{{route('products')}}" method="post" enctype="multipart/form-data">
                        @csrf
                        	<div class="row">
                                <div class="col-lg-12">
                                	@if(session()->has('success'))
                                        <div class="alert alert-success">
                                            {{ session()->get('success') }}
                                        </div>
                                    @endif
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="mb-3">
                                                <label class="form-label" for="product-title-input">Product Name</label>
                                                <input type="hidden" class="form-control" id="formAction" name="formAction" value="add">
                                                <input type="text" class="form-control d-none" id="product-id-input">
                                                <input type="text" class="form-control" id="pname" name="pname" placeholder="Enter product title" required>
                                                <div class="invalid-feedback">Please Enter a product title.</div>
                                            </div>
                                            <div>
                                                <label>Product Description</label>
                                                <textarea name="description" id="ckeditor-classic"></textarea>
                                            </div>
                                        </div>
                                    </div><!-- end card -->
                                   <?php /*?> <div class="card">
                                        <div class="card-header">
                                            <h5 class="card-title mb-0">Product Gallery</h5>
                                        </div>
                                        <div class="card-body">
                                            <div class="mb-4">
                                                <h5 class="fs-14 mb-1">Product Image</h5>
                                                <p class="text-muted">Add Product main Image.</p>
                                                <div class="text-center">
                                                    <div class="position-relative d-inline-block">
                                                        <div class="position-absolute top-100 start-100 translate-middle">
                                                            <label for="product-image-input" class="mb-0" data-bs-toggle="tooltip" data-bs-placement="right" title="Select Image">
                                                                <div class="avatar-xs">
                                                                    <div class="avatar-title bg-light border rounded-circle text-muted cursor-pointer">
                                                                        <i class="ri-image-fill"></i>
                                                                    </div>
                                                                </div>
                                                            </label>
                                                            <input class="form-control d-none" value="" id="product-image-input" type="file" accept="image/png, image/gif, image/jpeg">
                                                        </div>
                                                        <div class="avatar-lg">
                                                            <div class="avatar-title bg-light rounded">
                                                                <img src="" id="product-img" class="avatar-md h-auto" />
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div>
                                                <h5 class="fs-14 mb-1">Product Gallery</h5>
                                                <p class="text-muted">Add Product Gallery Images.</p>
    
                                                <div class="dropzone">
                                                    <div class="fallback">
                                                        <input name="file" type="file" multiple="multiple">
                                                    </div>
                                                    <div class="dz-message needsclick">
                                                        <div class="mb-3">
                                                            <i class="display-4 text-muted ri-upload-cloud-2-fill"></i>
                                                        </div>
    
                                                        <h5>Drop files here or click to upload.</h5>
                                                    </div>
                                                </div>
    
                                                <ul class="list-unstyled mb-0" id="dropzone-preview">
                                                    <li class="mt-2" id="dropzone-preview-list">
                                                        <div class="border rounded">
                                                            <div class="d-flex p-2">
                                                                <div class="flex-shrink-0 me-3">
                                                                    <div class="avatar-sm bg-light rounded">
                                                                        <img data-dz-thumbnail class="img-fluid rounded d-block" src="#" alt="Product-Image" />
                                                                    </div>
                                                                </div>
                                                                <div class="flex-grow-1">
                                                                    <div class="pt-1">
                                                                        <h5 class="fs-14 mb-1" data-dz-name>&nbsp;</h5>
                                                                        <p class="fs-13 text-muted mb-0" data-dz-size></p>
                                                                        <strong class="error text-danger" data-dz-errormessage></strong>
                                                                    </div>
                                                                </div>
                                                                <div class="flex-shrink-0 ms-3">
                                                                    <button data-dz-remove class="btn btn-sm btn-danger">Delete</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </li>
                                                </ul>
                                                <!-- end dropzon-preview -->
                                            </div>
                                        </div>
                                    </div><!-- end card -->
                                    
                                    <div class="card">
                                        <div class="card-header">
                                            <ul class="nav nav-tabs-custom card-header-tabs border-bottom-0" role="tablist">
                                                <li class="nav-item">
                                                    <a class="nav-link active" data-bs-toggle="tab" href="#addproduct-general-info" role="tab">
                                                        General Info
                                                    </a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link" data-bs-toggle="tab" href="#addproduct-inventorycount" role="tab">
                                                        Inventory Count
                                                    </a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link" data-bs-toggle="tab" href="#addproduct-details" role="tab">
                                                        Product Details
                                                    </a>
                                                </li>
                                            </ul>
                                        </div><!-- end card header -->
                                        <div class="card-body">
                                            <div class="tab-content">
                                                <div class="tab-pane active" id="addproduct-general-info" role="tabpanel">
                                                    <div class="row">
                                                        <div class="col-lg-12">
                                                            <input type="radio" id="sale" name="product" value="sale" checked="">
                                                            <label class="mr-15" for="sale">Sale Product</label>
                                                            <input type="radio" id="rant" name="product" value="rant">
                                                            <label class="mr-15" for="rant">Rent Product</label>
                                                            <input type="radio" id="both" name="product" value="both">
                                                            <label class="mr-15" for="both">Both</label>
                                                        </div>
                                                        
                                                        <div class="col-lg-3 col-sm-6 display-sale">
                                                            <div class="mb-3">
                                                                <label class="form-label" for="product-price-input">Product Sale Price</label>
                                                                <div class="input-group has-validation mb-3">
                                                                    <span class="input-group-text">$</span>
                                                                    <input type="text" class="form-control" placeholder="Enter price" required>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-3 col-sm-6 display-rant d-none">
                                                            <div class="mb-3">
                                                                <label class="form-label" for="product-price-input">Product Rental Price</label>
                                                                <div class="input-group has-validation mb-3">
                                                                    <span class="input-group-text">$</span>
                                                                    <input type="text" class="form-control" placeholder="Enter price" required>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-3 col-sm-6">
                                                            <div class="mb-3">
                                                                <label class="form-label">Business Cost </label>
                                                                <div class="input-group has-validation mb-3">
                                                                    <span class="input-group-text">$</span>
                                                                    <input type="text" class="form-control"  placeholder="Enter cost" required>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-3 col-sm-6">
                                                            <div class="mb-3">
                                                                <label class="form-label">Add Sales Tax</label>
                                                                <input type="text" class="form-control" placeholder="Add Tax" required>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-3 col-sm-6">
                                                            <div class="mb-3">
                                                                <label class="form-label">Shipping Cost</label>
                                                                <div class="input-group has-validation mb-3">
                                                                    <span class="input-group-text">$</span>
                                                                    <input type="text" class="form-control"  placeholder="Enter Shipping Cost"  required>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        
                                                        <div class="col-lg-3 col-sm-6">
                                                            <div class="mb-3">
                                                                <label class="form-label">On Sale Price</label>
                                                                <div class="input-group has-validation mb-3">
                                                                    <span class="input-group-text">$</span>
                                                                    <input type="text" class="form-control"  placeholder="Enter On Sale Price"  required>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6 col-sm-6  display-rant d-none">
                                                            <div class="mb-3">
                                                                <label class="form-label">Rental Duration</label>
                                                                <div class="rantal-duration">
                                                                    <div class="input-number input-group has-validation mb-3">
                                                                        <input type="text" class="form-control"  placeholder="1"  required>
                                                                    </div>
                                                                     <div class="select-duration input-group has-validation mb-3">
                                                                        <select class="form-select" name="sports" data-choices="" data-choices-search-false="" required="">
                                                                                <option value="">Minute</option>
                                                                                <option>Hour</option>
                                                                                <option>Day</option>
                                                                                <option>Week</option>
                                                                                <option>Month</option>
                                                                                <option>Year</option>
                                                                                <option>Full Day</option>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div><!-- end col -->
                                                        <div class="col-lg-6 col-md-6 col-sm-6  display-rant d-none">
                                                            <div class="mb-3">
                                                                <label class="form-label">Do you require a deposit?</label>
                                                                <div>
                                                                    <label>
                                                                        <input type="radio" value="" name="anything" class="radioCls" id="yes"> Yes
                                                                    </label>
                                                                    <label>
                                                                        <input type="radio" value="" name="anything" class="radioCls" id="no"> No
                                                                    </label>
                                                                </div>
                                                                <div class="someData" id="first">
                                                                    <div class="row">
                                                                        <div class="col-lg-6 col-sm-12">
                                                                            <div class="mb-3">
                                                                            <label class="form-label">Deposit Amount</label>
                                                                                <div class="input-group has-validation mb-3">
                                                                                    <span class="input-group-text">$</span>
                                                                                    <input type="text" class="form-control" placeholder="Amount" required="">
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-lg-6 col-sm-12">
                                                                            <div class="mb-3">
                                                                            <label class="form-label">Delivy method </label>
                                                                                <select class="form-select" name="sports"required="">
                                                                                    <option value="">Pick Up</option>
                                                                                    <option>delivery Available</option>
                                                                                    <option>Add shipping cost</option>
                                                                                </select>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div><!-- end col -->
                                                        <div class="col-lg-6 col-md-6 col-sm-6  display-rant d-none">
                                                            <div class="mb-3">
                                                                <label class="form-label">Do you require ID to rent?</label>
                                                                <div>
                                                                    <label>
                                                                        <input type="radio" value="" name="requireID" class="radioCls" id="idyes"> Yes
                                                                    </label>
                                                                    <label>
                                                                        <input type="radio" value="" name="requireID" class="radioCls" id="idno"> No
                                                                    </label>
                                                                </div>
                                                                <div class="idrantData" id="idrant">
                                                                    <div class="row">
                                                                        <div class="col-lg-6 col-sm-12">
                                                                            <div class="mb-3">
                                                                            <label class="form-label">Image</label>
                                                                                <div class="text-center">
                                                                                    <div class="profile-user position-relative d-inline-block mx-auto  mb-4">
                                                                                    <img src="https://fitnessity-production.s3.amazonaws.com/staff/vDRFy43xfa4zPHK5qSvRKH4hjc65QFgulk7w4tzA.jpg" alt="" class="rounded-circle avatar-xl img-thumbnail user-profile-image shadow">
                                                                                            
                                                                                        <div class="avatar-xs p-0 rounded-circle profile-photo-edit">
                                                                                            <input id="profile-img-file-input" type="file" class="profile-img-file-input" name="image"><label for="profile-img-file-input" class="profile-photo-edit avatar-xs">
                                                                                                <span class="avatar-title rounded-circle bg-light text-body shadow">
                                                                                                    <i class="ri-camera-fill"></i>
                                                                                                </span>
                                                                                            </label>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-lg-6 col-sm-12">
                                                                            <div class="mb-3">
                                                                            <label class="form-label">Add Rental Agreement Info</label>
                                                                                <textarea class="form-control" id="" name="bio" rows="6"></textarea>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div><!-- end row -->
                                                </div><!-- end tab-pane -->
                                                
                                                <div class="tab-pane" id="addproduct-inventorycount" role="tabpanel">
                                                    <div class="row">
                                                        <div class="col-lg-4">
                                                            <div class="mb-3">
                                                                <label class="form-label">Quantity</label>
                                                                <input type="text" class="form-control" placeholder="Enter Quantity">
                                                            </div>
                                                        </div><!-- end col -->
    
                                                        <div class="col-lg-4">
                                                            <div class="mb-3">
                                                                <label class="form-label" for="meta-keywords-input">Low Quantity Alert</label>
                                                                <input type="text" class="form-control" placeholder="Enter Quantity Alert" id="meta-keywords-input">
                                                            </div>
                                                        </div><!-- end col -->
                                                        <div class="col-lg-4">
                                                            <div class="mb-3">
                                                                <a href="#" class="float-end" data-bs-toggle="modal" data-bs-target=".add-vendor"> Create New Vendor</a>
                                                                <label for="meta-keywords-input">Vendor</label>
                                                                <div class="priceselect">
                                                                    <div class="product-vendor" id="productVendor" style="">
                                                                        <select name="frm_servicetype[]" id="productVendorSel" multiple>
                                                                            <option value="Personal Training">Vendor One</option>
                                                                            <option value="Coaching">Vendor Two</option>
                                                                            <option value="Therapy">Vendor Three</option>
                                                                            <option value="Event">Vendor Four</option>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div><!-- end col -->
                                                    </div><!-- end row -->
                                                </div><!-- end tab pane -->
                                                <div class="tab-pane" id="addproduct-details" role="tabpanel">
                                                    <div class="row">
                                                         <div class="col-lg-4">
                                                            <div class="mb-3">
                                                                <label for="meta-keywords-input">Colors (Select all that apply) </label>
                                                                <a href="#" class="float-end" data-bs-toggle="modal" data-bs-target=".add-color"> Add new colors</a>
                                                                <div class="priceselect">
                                                                    <div class="product-vendor" id="individualstype">
                                                                        <select name="frm_servicetype[]" id="selectcolor" multiple>
                                                                            <option>Red</option>
                                                                            <option>Green</option>
                                                                            <option>Pink</option>
                                                                            <option>Black</option>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div> <!-- end col -->
                                                        <div class="col-lg-4">
                                                            <div class="mb-3">
                                                                <label  for="meta-keywords-input">Brands </label>
                                                                <a href="#" class="float-end" data-bs-toggle="modal" data-bs-target=".add-brand">Add new brands</a>
                                                                <div class="priceselect">
                                                                    <div class="product-vendor" id="individualstype">
                                                                        <select name="frm_servicetype[]" id="brands" multiple>
                                                                            <option>Option One</option>
                                                                            <option>Option Two</option>
                                                                            <option>Option Three</option>
                                                                            <option>Option Four</option>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div><!-- end col -->
                                                        <div class="col-lg-4">
                                                            <div class="mb-3">
                                                                <label  for="meta-keywords-input">Sizes (Select all that apply) </label>
                                                                <a href="#" class="float-end" data-bs-toggle="modal" data-bs-target=".add-size">Add New Size</a>
                                                                <div class="priceselect">
                                                                    <div class="product-vendor" id="individualstype">
                                                                        <select name="frm_servicetype[]" id="product-size" multiple>
                                                                            <option>15</option>
                                                                            <option>20</option>
                                                                            <option>25</option>
                                                                            <option>30</option>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div> <!-- end col -->
                                                        <div class="col-lg-4">
                                                            <div class="mb-3">
                                                                <label  for="meta-keywords-input">Category (Select all that apply) </label>
                                                                <div class="priceselect">
                                                                    <div class="product-vendor" id="individualstype">
                                                                        <select name="frm_servicetype[]" id="product-category" multiple>
                                                                            <option>Category 1 </option>
                                                                            <option>Category 2</option>
                                                                            <option>Category 3</option>
                                                                            <option>Category 4</option>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div><!-- end col -->
                                                        <div class="col-lg-4">
                                                            <div class="mb-3">
                                                                <label  for="meta-keywords-input">Great For (Select all that apply)</label>
                                                                <div class="priceselect">
                                                                    <div class="product-vendor" id="individualstype">
                                                                        <select name="frm_servicetype[]" id="product-great" multiple>
                                                                            <option>1 </option>
                                                                            <option>2</option>
                                                                            <option>3</option>
                                                                            <option>4</option>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div><!-- end col -->
                                                        <div class="col-lg-4">
                                                            <div class="mb-3">
                                                                <label  for="meta-keywords-input">What activity is this for? (Select all that apply)</label>
                                                                <div class="priceselect">
                                                                    <div class="product-vendor" id="individualstype">
                                                                        <select name="frm_servicetype[]" id="product-activity" multiple>
                                                                            <option>1 </option>
                                                                            <option>2</option>
                                                                            <option>3</option>
                                                                            <option>4</option>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div><!-- end col -->
                                                        <div class="col-lg-4">
                                                            <div class="mb-3">
                                                                <label  for="meta-keywords-input">Material (Select all that apply) </label>
                                                                <a href="#" class="float-end" data-bs-toggle="modal" data-bs-target=".add-material">Add new material</a>
                                                                <div class="priceselect">
                                                                    <div class="product-vendor" id="individualstype">
                                                                        <select name="frm_servicetype[]" id="product-material" multiple>
                                                                            <option>Material 1</option>
                                                                            <option>Material 2</option>
                                                                            <option>Material 3</option>
                                                                            <option>Material 4</option>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div><!-- end col -->
                                                        <div class="col-lg-12">
                                                            <div class="mb-3">
                                                                <label  for="meta-keywords-input">Explain your policy and what steps to take for customers returning products.</label>
                                                                <textarea class="form-control" id="meta-description-input" placeholder="Enter meta description" rows="3"></textarea>
                                                            </div>
                                                        </div><!-- end col -->
                                                    </div><!-- end row -->
                                            	</div><!-- end tab pane -->
                                        	</div><!-- end tab content -->
                                    	</div><!-- end card body --><?php */?>
                                	</div><!-- end card -->
                                    <div class="text-end mb-3">
                                        <button type="submit" class="btn btn-red w-sm">Submit</button>
                                    </div>
                            	</div><!-- end col -->
							</div><!-- end row -->

                        </form>
                        
                
                	</div><!-- h-100 -->
                </div><!-- col -->
			</div>
		</div><!-- containe -->
	</div><!-- page-content -->
</div><!-- main-content -->


<div class="modal fade add-color" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="myModalLabel">Add a new color </h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body">
				<div class="row y-middle"> 
					<div class="col-lg-4">
						<div>
							<label class="fs-15"> Color Name </label>
						</div>
					</div>
					<div class="col-lg-8">
						<div>
							<input type="text" class="form-control" placeholder="Add Color">
						</div>
					</div>
					
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-primary btn-red">Add</button>
			</div>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<div class="modal fade add-brand" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="myModalLabel">Add a new brand </h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body">
				<div class="row y-middle"> 
					<div class="col-lg-4">
						<div>
							<label class="fs-15">Brand Name </label>
						</div>
					</div>
					<div class="col-lg-8">
						<div>
							<input type="text" class="form-control">
						</div>
					</div>
					
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-primary btn-red">Add</button>
			</div>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<div class="modal fade add-size" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="myModalLabel">Add a new size </h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body">
				<div class="row y-middle"> 
					<div class="col-lg-4">
						<div>
							<label class="fs-15">Size Name </label>
						</div>
					</div>
					<div class="col-lg-8">
						<div>
							<input type="text" class="form-control">
						</div>
					</div>
					
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-primary btn-red">Add</button>
			</div>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<div class="modal fade add-material" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="myModalLabel">Add a new material </h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body">
				<div class="row y-middle"> 
					<div class="col-lg-4">
						<div>
							<label class="fs-15"> Material Name </label>
						</div>
					</div>
					<div class="col-lg-8">
						<div>
							<input type="text" class="form-control">
						</div>
					</div>
					
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-primary btn-red">Add</button>
			</div>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<div class="modal fade add-vendor" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="myModalLabel">Add a new vendor </h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body">
				<div class="row y-middle"> 
					<div class="col-lg-4">
						<div>
							<label class="fs-15"> Vendor Name </label>
						</div>
					</div>
					<div class="col-lg-8">
						<div>
							<input type="text" class="form-control">
						</div>
					</div>
					
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-primary btn-red">Add</button>
			</div>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div><!-- /.modal -->



@include('layouts.business.footer')

@endsection
<script>
	$('input[type=radio][name=product]').change(function() {
		if (this.value == "rant" ) {
		   $('.display-rant').removeClass('d-none');
		   $('.display-sale').addClass('d-none');
		}else if (this.value == "sale") {
			$('.display-rant').addClass('d-none');
			$('.display-sale').removeClass('d-none');
		}else{
			$('.display-rant').removeClass('d-none');
			$('.display-sale').removeClass('d-none');
		}
	});
</script>
<script>
	$(document).ready(function(){
		//after load will check the checkbox is checked or not
		var check = $("#idyes").prop("checked");
		if(check){
			$("#idrant").addClass("activeTabid");
		}		
		//click on yes
		$("#idyes").on("click", function(){
			check = $(this).prop("checked");
			$("#seconda").removeClass("activeTabid");
			$("#idrant").addClass("activeTabid");	
		})
		//click on No
		$("#idno").on("click", function(){
			check = $(this).prop("checked");
			$("#idrant").removeClass("activeTabid");
			$("#seconda").addClass("activeTabid");
			console.log(check);
		})
	});
</script>
<script>
	$(document).ready(function(){
		//after load will check the checkbox is checked or not
		var check = $("#yes").prop("checked");
		if(check){
			$("#first").addClass("activeTab");
		}		
		//click on yes
		$("#yes").on("click", function(){
			check = $(this).prop("checked");
			$("#second").removeClass("activeTab");
			$("#first").addClass("activeTab");		
		})
		//click on No
		$("#no").on("click", function(){
			check = $(this).prop("checked");
			$("#first").removeClass("activeTab");
			$("#second").addClass("activeTab");
			console.log(check);
		})
	});
</script>
<script>
	flatpickr(".flatpickr-range", {
        dateFormat: "m/d/Y",
        maxDate: "01/01/2050",
		defaultDate: [new Date()],
     });
</script>
<script>
	var p = new SlimSelect({
		select: '#productVendorSel'
	});
</script>
<script>
	var p = new SlimSelect({
		select: '#selectcolor'
	});
</script>
<script>
	var p = new SlimSelect({
		select: '#brands'
	});
</script>
<script>
	var p = new SlimSelect({
		select: '#product-size'
	});
</script>
<script>
	var p = new SlimSelect({
		select: '#product-category'
	});
</script>
<script>
	var p = new SlimSelect({
		select: '#product-great'
	});
</script>
<script>
	var p = new SlimSelect({
		select: '#product-activity'
	});
</script>
<script>
	var p = new SlimSelect({
		select: '#product-material'
	});
</script>
