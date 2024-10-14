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
    									<label>Add/Edit Product</label>
    								</div>
    							</div>
                                <!--end col-->
    						</div>
                            <!--end row-->
    						
    						<form id="createproduct-form" autocomplete="off" class="needs-validation" novalidate action="{{route('business.products.store')}}" method="post" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="id" id="id" value="{{$id}}">
                                <div class="row">
                                    <div class="col-lg-9">
                                        <div class="card">
                                            <div class="card-body">
                                                <div class="mb-3">
                                                    <label class="form-label" for="product-title-input">Product Name</label>
                                                    <input type="text" class="form-control" id="product-title-input" name="product_name" value="{{@$product->name}}" placeholder="Enter product title" required>
                                                    <div class="invalid-feedback">Please Enter a product title.</div>
                                                </div>
                                                <div>
                                                    <label>Product Description</label>
                                                    <textarea name="description" id="ckeditor-classic" style="display: none;">{{@$product->description}}</textarea>
                                                    <div id="ckeditor-classic" >
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- end card -->

                                        <div class="card">
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
                                                                <input class="form-control d-none" value="" id="product-image-input" name="product_image" type="file" accept="image/png, image/gif, image/jpeg">
                                                            </div>
                                                            <div class="avatar-lg">
                                                                <div class="avatar-title bg-light rounded">
                                                                    <img src="@if(@$product->product_image != '' ) {{Storage::URL($product->product_image)}} @endif" id="product-img" class="avatar-md h-auto" />
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div>
                                                    <h5 class="fs-14 mb-1">Product Gallery</h5>
                                                    <p class="text-muted">Add Product Gallery Images.</p>

                                                    <div class="dropzone" >
                                                        <div class="fallback">
                                                            <input name="file[]" type="file" multiple="multiple" >
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
                                                            <!-- This is used as the file preview template -->
                                                            <div class="border rounded">
                                                                <div class="d-flex p-2">
                                                                    <div class="flex-shrink-0 me-3">
                                                                        <div class="avatar-sm bg-light rounded">
                                                                            <img data-dz-thumbnail class="img-fluid rounded d-block" src="#" alt="Product-Image"  />
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
                                                        @if(@$product->gallery)
                                                        @foreach(explode(',', rtrim($product->gallery, ',')) as $img)
                                                            <li class="mt-2" id="dropzone-preview-list">
                                                                <input type="hidden" name="galleryfile[]" value="{{$img}}">
                                                                <div class="border rounded">
                                                                    <div class="d-flex p-2">
                                                                        <div class="flex-shrink-0 me-3">
                                                                            <div class="avatar-sm bg-light rounded product-display">
                                                                                <img class="img-fluid rounded d-block" src="{{Storage::URL($img)}}" alt="Product-Image"  />
                                                                            </div>
                                                                        </div>
                                                                        <div class="flex-grow-1">
                                                                            <div class="pt-1">
                                                                                <h5 class="fs-14 mb-1">&nbsp;{{basename($img)}}</h5>
                                                                            </div>
                                                                        </div>
                                                                        <div class="flex-shrink-0 ms-3">
                                                                            <button class="btn btn-sm btn-danger delete-btn" type="button">Delete</button>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </li>
                                                        @endforeach
                                                        @endif
                                                    </ul>
                                                    <!-- end dropzon-preview -->
                                                </div>
                                            </div>
                                        </div>
                                        <!-- end card -->

                                        <div class="card">
                                            <div class="card-header">
                                                <ul class="nav nav-tabs-custom card-header-tabs border-bottom-0" role="tablist">
                                                    <li class="nav-item">
                                                        <a class="nav-link active" data-bs-toggle="tab" href="#addproduct-general-info" role="tab">
                                                            General Info
                                                        </a>
                                                    </li>
                                                    
        											<li class="nav-item">
                                                        <a class="nav-link" data-bs-toggle="tab" href="#addproduct-details" role="tab">
                                                            Product Details
                                                        </a>
                                                    </li>

                                                    <li class="nav-item">
                                                        <a class="nav-link" data-bs-toggle="tab" href="#addproduct-inventorycount" role="tab">
                                                            Inventory Count
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div>
                                            <!-- end card header -->
                                            <div class="card-body">
                                                <div class="tab-content">
                                                    <div class="tab-pane active" id="addproduct-general-info" role="tabpanel">
                                                        <div class="row">
        													<div class="col-lg-12">
        												
        														<input type="radio" id="sale" name="product_type" value="sale" @if(@$product->product_type == 'sale' || $product == '' ) checked @endif>
        														<label class="mr-15" for="sale">Sale Product</label>
        														
        														<input type="radio" id="rent" name="product_type" value="rent" @if(@$product->product_type == 'rent' ) checked @endif>
        														<label class="mr-15" for="rent">Rent Product</label>
        														
        														<input type="radio" id="both" name="product_type" value="both" @if(@$product->product_type == 'both' ) checked @endif>
        														<label class="mr-15" for="both">Both</label>
        														
        													</div>
        													
        													<div class="col-lg-3 col-sm-6 display-sale">
                                                                <div class="mb-3">
                                                                    <label class="form-label" for="product-price-input">Product Sale Price</label>
                                                                    <div class="input-group has-validation mb-3">
                                                                        <span class="input-group-text">$</span>
                                                                        <input type="text" class="form-control" placeholder="Enter price" required name="sale_price" value="{{@$product->sale_price}}">
                                                                    </div>
                                                                </div>
                                                            </div>
        													
        													<div class="col-lg-3 col-sm-6 display-rant d-none">
                                                                <div class="mb-3">
                                                                    <label class="form-label" for="product-price-input">Product Rental Price</label>
                                                                    <div class="input-group has-validation mb-3">
                                                                        <span class="input-group-text">$</span>
                                                                        <input type="text" class="form-control" placeholder="Enter price" required name="rental_price" value="{{@$product->rental_price}}">
                                                                    </div>

                                                                </div>
                                                            </div>
        													
        													<div class="col-lg-3 col-sm-6">
                                                                <div class="mb-3">
                                                                    <label class="form-label">Business Cost </label>
                                                                    <div class="input-group has-validation mb-3">
                                                                        <span class="input-group-text">$</span>
                                                                        <input type="text" class="form-control"  placeholder="Enter cost" required name="cost_price" value="{{@$product->business_cost}}" >
                                                                    </div>
                                                                </div>
                                                            </div>
        													
                                                            <!-- <div class="col-lg-3 col-sm-6">
                                                                <div class="mb-3">
                                                                    <label class="form-label">Add Sales Tax</label>
                                                                    <input type="text" class="form-control" placeholder="Add Tax" required name="sales_tax"  value="{{@$product->sales_tax}}" >
                                                                </div>
                                                            </div> -->
        													
        													<div class="col-lg-3 col-sm-6">
                                                                <div class="mb-3">
                                                                    <label class="form-label">Shipping Cost</label>
                                                                    <div class="input-group has-validation mb-3">
                                                                        <span class="input-group-text">$</span>
                                                                        <input type="text" class="form-control"  placeholder="Enter Shipping Cost"  required name="shipping_cost" value="{{@$product->shipping_cost}}" >
                                                                    </div>
                                                                </div>
                                                            </div>
        													
        													<div class="col-lg-3 col-sm-6">
                                                                <div class="mb-3">
                                                                    <label class="form-label">On Sale Price</label>
                                                                    <div class="input-group has-validation mb-3">
                                                                        <span class="input-group-text">$</span>
                                                                        <input type="text" class="form-control"  placeholder="Enter On Sale Price" required name="on_sale_price" value="{{@$product->on_sale_price}}" >
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <!-- end col -->
        													
        													<div class="col-lg-6 col-sm-6  display-rant d-none">
                                                                <div class="mb-3">
                                                                    <label class="form-label">Rental Duration</label>
        															<div class="rantal-duration">
        																<div class="input-number input-group has-validation mb-3">
        																	<input type="text" class="form-control"  placeholder="1"  required name="rental_duration_int" @if(@$product->rental_duration) value="{{substr(@$product->rental_duration, 0, strpos(@$product->rental_duration, ' '))}}" @endif>
        																</div>
        																<div class="select-duration input-group has-validation mb-3">
        																	<select class="form-select" name="rental_duration" required="" >
    																			<option @if(@$product->rental_duration && substr(@$product->rental_duration, strpos(@$product->rental_duration, ' ') + 1) == 'Minute') selected @endif>Minute</option>
    																			<option @if(@$product->rental_duration && substr(@$product->rental_duration, strpos(@$product->rental_duration, ' ') + 1) == 'Hour') selected @endif>Hour</option>
    																			<option @if(@$product->rental_duration && substr(@$product->rental_duration, strpos(@$product->rental_duration, ' ') + 1) == 'Day') selected @endif>Day</option>
    																			<option @if(@$product->rental_duration && substr(@$product->rental_duration, strpos(@$product->rental_duration, ' ') + 1) == 'Week') selected @endif>Week</option>
    																			<option @if(@$product->rental_duration && substr(@$product->rental_duration, strpos(@$product->rental_duration, ' ') + 1) == 'Month') selected @endif>Month</option>

                                                                                <option @if(@$product->rental_duration && substr(@$product->rental_duration, strpos(@$product->rental_duration, ' ') + 1) == 'Year') selected @endif>Year</option>

    																			<option @if(@$product->rental_duration && substr(@$product->rental_duration, strpos(@$product->rental_duration, ' ') + 1 )== 'Full Day') selected @endif>Full Day</option>
        																	</select>
        																</div>
        															</div>
                                                                </div>
                                                            </div>
                                                            <!-- end col -->
        													
        													<div class="col-lg-6 col-md-6 col-sm-6  display-rant d-none">
                                                                <div class="mb-3">
                                                                    <label class="form-label">Do you require a deposit?</label>
        															<div>
        																<label>
        																	<input type="radio" value="yes" name="require_deposite" class="radioCls" id="yes" @if(@$product->require_deposit =='yes') checked @endif> Yes
        																</label>
        																<label>
        																	<input type="radio" value="no" name="require_deposite" class="radioCls" id="no" @if(@$product->require_deposit =='no' || @$product == '') checked @endif> No
        																</label>
        															</div>
        															<div class="someData @if(@$product->require_deposit == 'yes' ) activeTab @endif" id="first">
        																<div class="row">
        																	<div class="col-lg-6 col-sm-12">
        																		<div class="mb-3">
        																		<label class="form-label">Deposit Amount</label>
        																			<div class="input-group has-validation mb-3">
        																				<span class="input-group-text">$</span>
        																				<input type="text" class="form-control" placeholder="Amount" required="" name="deposit_amount" value="{{@$product->deposit_amount}}">
        																			</div>
        																		</div>
        																	</div>
        																	<div class="col-lg-6 col-sm-12">
        																		<div class="mb-3">
        																		<label class="form-label">Delivery Method </label>
        																			<select class="form-select" name="delivery_method"required="">
                                                                                        <option value="">Select Method</option>
        																				<option value="pick_up" @if(@$product->require_deposit == 'yes' && @$product->delivery_method == 'pick_up') selected @endif >Pick Up</option>
        																				<option value="delivery_available" @if(@$product->require_deposit == 'yes' && @$product->delivery_method == 'delivery_available') selected @endif >delivery Available</option>
        																				<option value="add_shipping_cost" @if(@$product->require_deposit == 'yes' && @$product->delivery_method == 'add_shipping_cost') selected @endif>Add shipping cost</option>
        																			</select>
        																		</div>
        																	</div>
        																</div>
        															</div>
                                                                </div>
                                                            </div>
                                                        
        													<div class="col-lg-6 col-md-6 col-sm-6  display-rant d-none">
                                                                <div class="mb-3">
                                                                    <label class="form-label">Do you require ID to rent?</label>
        															<div>
        																<label>
        																	<input type="radio" value="yes" name="requireID" class="radioCls" id="idyes"  @if(@$product->require_ID_to_rent =='yes') checked @endif> Yes
        																</label>
        																<label>
        																	<input type="radio" value="no" name="requireID" class="radioCls" id="idno" @if(@$product->require_ID_to_rent =='no' || @$product == '') checked @endif> No
        																</label>
        															</div>

        															<div class="idrantData @if(@$product->require_ID_to_rent =='yes') activeTabid @endif" id="idrant">
        																<div class="row">
        																	<div class="col-lg-6 col-sm-12">
        																		<div class="mb-3">
        																		<label class="form-label">Image</label>
        																			<div class="text-center">
        																				<div class="profile-user position-relative d-inline-block mx-auto  mb-4">
        																				    <img src="@if(@$product->agreement_img)  {{Storage::URL($product->agreement_img)}} @endif" alt="" class="rounded-circle avatar-xl img-thumbnail user-profile-image shadow">
        																					<div class="avatar-xs p-0 rounded-circle profile-photo-edit">
        																						<input id="profile-img-file-input" type="file" class="profile-img-file-input" name="agreement_img"><label for="profile-img-file-input" class="profile-photo-edit avatar-xs">
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
        																			<textarea class="form-control" id="agreement_info" name="agreement_info" rows="6">{{@$product->agreement_info}}</textarea>
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
                                                                    <input type="text" class="form-control" placeholder="Enter Quantity" name="quantity" value="{{@$product->quantity}}">
                                                                </div>
                                                            </div> <!-- end col -->

                                                            <div class="col-lg-4">
                                                                <div class="mb-3">
                                                                    <label class="form-label" for="meta-keywords-input">Low Quantity Alert</label>
                                                                    <input type="text" class="form-control" placeholder="Enter Quantity Alert" id="meta-keywords-input" name="low_quantity_alert" value="{{@$product->low_quantity_alert}}">
                                                                </div>
                                                            </div>
                                                            <!-- end col -->
        													
        													 <div class="col-lg-4">
                                                                <div class="mb-3">
                                                                    <a data-url="{{route('business.products.addVariantModal',['name'=>'Vender'])}}" class="float-end" data-behavior="ajax_html_modal" data-modal-width="modal-20"> Create New Vendor</a>

                                                                    <label for="meta-keywords-input">Vendor</label>
        															<div class="priceselect">
        																<div class="product-vendor" id="vendor_id" style="" >
        																	<select id="vender" multiple name="vendor_id[]">
                                                                                @foreach($venders as $vender)
                                                                                    <option value="{{$vender->id}}">{{$vender->name}}</option>
                                                                                @endforeach
        																	</select>
        																</div>
        															</div>
                                                                </div>
                                                            </div>
                                                            <!-- end col -->
                                                        </div>
                                                        <!-- end row -->
                                                    </div>
                                                    <!-- end tab pane -->
        											
        											<div class="tab-pane" id="addproduct-details" role="tabpanel">
                                                        <div class="row">
                                                             <div class="col-lg-4">
                                                                <div class="mb-3">
																	<div class="row">
																		<div class="col-lg-12 col-md-12 col-12">
																			<label for="meta-keywords-input">Colors (Select all that apply) </label>
																		</div>
																		<div class="col-lg-12 col-md-12 col-12">
																			<a data-url="{{route('business.products.addVariantModal',['name'=>'Color'])}}" class="float-end text-right" data-behavior="ajax_html_modal" data-modal-width="modal-20"> Add new colors</a>
																		</div>
																	</div>
        															<div class="priceselect">
        																<div class="product-vendor" id="individualstype">
        																	<select id="color" multiple name="colors[]">
                                                                                @foreach($productColors as $color)
        																		    <option value="{{$color->id}}">{{$color->name}}</option>
                                                                                @endforeach
        																	</select>
        																</div>
        															</div>
                                                                </div>
                                                            </div>
                                                            <!-- end col -->

                                                            <div class="col-lg-4">
                                                                <div class="mb-3">
																	<div class="row">
																		<div class="col-lg-12 col-md-12 col-12">
																			<label  for="meta-keywords-input">Brands </label>
																		</div>
																		<div class="col-lg-12 col-md-12 col-12">
																			<a data-url="{{route('business.products.addVariantModal',['name'=>'Brand'])}}" class="float-end text-right" data-behavior="ajax_html_modal" data-modal-width="modal-20"> Add new brands</a>
																		</div>
																	</div>
																	<div class="priceselect">
        																<div class="product-vendor" id="individualstype">
        																	<select name="brands[]" multiple id="brand" >
        																		@foreach($productBrand as $brand)
                                                                                    <option value="{{$brand->id}}">{{$brand->name}}</option>
                                                                                @endforeach
        																	</select>
        																</div>
        															</div>
                                                                </div>
                                                            </div>
                                                            <!-- end col -->
        													
        													<div class="col-lg-4">
                                                                <div class="mb-3">
																	<div class="row">
																		<div class="col-lg-12 col-md-12 col-12">
																			<label  for="meta-keywords-input">Sizes (Select all that apply) </label>
																		</div>
																		<div class="col-lg-12 col-md-12 col-12">
																			<a data-url="{{route('business.products.addVariantModal',['name'=>'Size'])}}" class="float-end text-right" data-behavior="ajax_html_modal" data-modal-width="modal-20"> Add new size</a>
																		</div>
																	</div>
        															<div class="priceselect">
        																<div class="product-vendor" id="individualstype">
        																	<select id="size" multiple name="size[]">
        																		@foreach($productSize as $size)
                                                                                    <option value="{{$size->id}}">{{$size->name}}</option>
                                                                                @endforeach
        																	</select>
        																</div>
        															</div>
                                                                </div>
                                                            </div>
                                                            <!-- end col -->
        													
        													<div class="col-lg-4">
                                                                <div class="mb-3">
                                                                    <div class="col-lg-12 col-md-12 col-12">
                                                                        <label  for="meta-keywords-input">Category (Select all that apply) </label>
                                                                        <label  for="meta-keywords-input">Sizes (Select all that apply) </label>
                                                                    </div>
                                                                    <div class="col-lg-12 col-md-12 col-12">
                                                                        <a data-url="{{route('business.products.addVariantModal',['name'=>'Category'])}}" class="float-end text-right" data-behavior="ajax_html_modal" data-modal-width="modal-20"> Add new Category</a>
                                                                    </div>
        															<div class="priceselect">
        																<div class="product-vendor" id="individualstype">
        																	<select id="category" name="category[]" multiple>
                                                                                @foreach($productCategory as $c)
                                                                                    <option value="{{$c->id}}">{{$c->name}}</option>
                                                                                @endforeach
        																	</select>
        																</div>
        															</div>
                                                                </div>
                                                            </div>
                                                            <!-- end col -->
        													
        													<div class="col-lg-4">
                                                                <div class="mb-3">
                                                                    <label  for="meta-keywords-input">Great For (Select all that apply)</label>
        															<div class="priceselect">
        																<div class="product-vendor" id="individualstype">
        																	<select id="great-for" name="great_for[]" multiple>
                                                                                <option>Boys</option>
                                                                                <option>Girls</option>
                                                                                <option>Kids</option>
                                                                                <option>Men</option>
                                                                                <option>Women</option>
                                                                                <option>For All</option>
        																	</select>
        																</div>
        															</div>
                                                                </div>
                                                            </div>
                                                            <!-- end col -->
        													
        													<div class="col-lg-4">
                                                                <div class="mb-3">
                                                                    <label  for="meta-keywords-input">What activity is this for? (Select all that apply)</label>
        															<div class="priceselect">
        																<div class="product-vendor" id="individualstype">
        																	<select id="activity-for" name="activity_for[]" multiple>
        																		  @foreach(@$sportsData as $Sports)
                                                                                    @php $optiondata = app\Sports::where('parent_sport_id',$Sports['id'])->get(); @endphp
                                                                                    @if(count($optiondata)>0)
                                                                                        <optgroup label="{{$Sports['sport_name']}}">
                                                                                        @foreach($optiondata as $data)
                                                                                            <option @if(strtoupper(@$service->sport_activity) == strtoupper($data['sport_name'])) selected @endif >{{$data['sport_name']}}</option>
                                                                                        @endforeach
                                                                                        </optgroup>
                                                                                    @else
                                                                                    <option @if(strtoupper(@$service->sport_activity) == strtoupper($Sports['sport_name'])) selected @endif >{{$Sports['sport_name']}}</option>
                                                                                    @endif
                                                                                @endforeach
        																	</select>
        																</div>
        															</div>
                                                                </div>
                                                            </div>
                                                            <!-- end col -->
        													
        													<div class="col-lg-4">
                                                                <div class="mb-3">
																	<div class="row">
																		<div class="col-lg-12 col-md-12 col-12">
																			<label  for="meta-keywords-input">Material (Select all that apply) </label>
																		</div>
																		<div class="col-lg-12 col-md-12 col-12">
																			<a data-url="{{route('business.products.addVariantModal',['name'=>'Material'])}}" class="float-end text-right" data-behavior="ajax_html_modal" data-modal-width="modal-20"> Add new material</a>
																		</div>
																	</div>
        															<div class="priceselect">
        																<div class="product-vendor" id="individualstype">
        																	<select id="material" name="material[]" multiple>
                                                                                @foreach($productMaterial as $material)
                                                                                    <option value="{{$material->id}}">{{$material->name}}</option>
                                                                                @endforeach
        																	</select>
        																</div>
        															</div>
                                                                </div>
                                                            </div>
                                                            <!-- end col -->
        													
        													<div class="col-lg-12">
                                                                <div class="mb-3">
                                                                    <label  for="meta-keywords-input">Explain your policy and what steps to take for customers returning products.</label>
        															<textarea class="form-control" id="meta-description-input" placeholder="Enter meta description" rows="3" name="product_policy">{{@$product->policy_returning}}</textarea>
                                                                </div>
                                                            </div>
                                                            <!-- end col -->
        													
                                                        </div>
                                                        <!-- end row -->
                                                    </div>
                                                    <!-- end tab pane -->
                                                </div>
                                                <!-- end tab content -->
                                            </div>
                                            <!-- end card body -->
                                        </div>
                                        <!-- end card -->
                                        <div class="text-end mb-3">
                                            <button type="submit" class="btn btn-red w-sm">Submit</button>
                                        </div>
                                    </div><!-- end col -->
									<div class="col-lg-3">
										<div class="card">
											<div class="card-header">
												<h5 class="card-title mb-0">Publish</h5>
											</div>
											<div class="card-body">
												<div class="mb-3">
													<label for="choices-publish-status-input" class="form-label">Status</label>

													<select class="form-select" id="choices-publish-status-input" data-choices data-choices-search-false name="status">
														<option value="Draft" @if(@$product->status == '' || @$product->status =='Draft') selected @endif>Draft</option>
														<option value="Published"  @if(@$product->status =='Published') selected @endif>Published</option>
													</select>
												</div>

												<div>
													<label for="choices-publish-visibility-input" class="form-label">Visibility</label>
													<select class="form-select" id="choices-publish-visibility-input" data-choices data-choices-search-false name="visibility">
                                                        <option value="Public" @if(@$product->visibility == '' || @$product->status =='Public') selected @endif>Visible On Online</option>
														<option value="Hidden" @if(@$product->visibility =='Hidden') selected @endif>Hidden Online</option>
													</select>
												</div>
											</div>
											<!-- end card body -->
										</div>
										<!-- end card -->
									</div>
									<!-- end col -->
                                </div>
                                <!-- end row -->
                            </form>
        					
    					</div> <!-- end .h-100-->
                      </div> <!-- end col -->
                    </div>
                </div><!-- container-fluid -->
            </div><!-- End Page-content -->
         </div><!-- end main content-->
    </div><!-- END layout-wrapper -->

	@include('layouts.business.footer')
	<script>
        $(document).ready(function() {
            function toggleDisplay(productType) {
                if (productType == "rent" ) {
                    $('.display-rant').removeClass('d-none');
                    $('.display-sale').addClass('d-none');
                } else if (productType == "sale") {
                    $('.display-rant').addClass('d-none');
                    $('.display-sale').removeClass('d-none');
                } else {
                    $('.display-rant').removeClass('d-none');
                    $('.display-sale').removeClass('d-none');
                }
            }

            $('input[type=radio][name=product_type]').change(function() {
                toggleDisplay(this.value);
            });

            var selectedProductType = $('input[name="product_type"]:checked').val();
            toggleDisplay(selectedProductType);
        });

         $('ul#dropzone-preview').on('click', 'button.delete-btn', function() {
        // Remove the parent <li> element when the delete button is clicked
            $(this).closest('li').remove();
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

        ['vender', 'color', 'brand', 'size', 'category', 'great-for', 'activity-for', 'material'].forEach(function(id) {
            new SlimSelect({
                select: '#' + id
            });
        });
	</script>

    <script type="text/javascript">
        function initializeSlimSelect(id,data) {
            const arr = data.split(',');
            const select = new SlimSelect({ select: '#' + id });
            select.set(arr);
        }

        $(document).ready(function() {
            initializeSlimSelect('vender','{{@$product->vendor_id}}');
            initializeSlimSelect('color','{{@$product->color}}');
            initializeSlimSelect('brand','{{@$product->brand}}');
            initializeSlimSelect('size','{{@$product->size}}');
            initializeSlimSelect('category','{{@$product->category}}');
            initializeSlimSelect('great-for','{{@$product->great_for}}');
            initializeSlimSelect('activity-for','{{@$product->activity_is_for}}');
            initializeSlimSelect('material','{{@$product->material}}');
        });
    
    </script>
@endsection