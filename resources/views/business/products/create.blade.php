@extends('layouts.header')
@section('content')
@include('layouts.userHeader')

<link rel="stylesheet" type="text/css" href="http://dev.fitnessity.co/public/css/slimselect.min.css" />

<div class="p-0 col-md-12 inner_top nopadding">
    <div class="row">
        <div class="col-md-2" style="background: black;">
        	 @include('business.businessSidebar')
        </div>
		<div class="col-md-10">
            <div class="container-fluid p-0">
                <div class="tab-hed">Add New Product</div>
                <hr style="border: 15px solid black;width: 104%;margin-left: -38px;">
            </div>
			<div class="row">
				<div class="col-md-6 col-xs-12">
					<div class="form-group">
						<label>Product Name </label>
						<input type="text" name="pname" id="" class="form-control" maxlength="100" >
					</div>
				</div>
				<div class="col-md-6 col-xs-12">
					<div class="form-group">
						<label>Barcode # </label>
						<input type="text" name="barcode" id="" class="form-control" maxlength="100" >
					</div>
				</div>
				<div class="col-md-12 col-xs-12">
					<div class="product-des form-group">
						<label class="position-gander">Product Description</label>
						<textarea id="w3review" name="w3review" rows="4" cols="80">Add a description for the product.</textarea> 
					</div>
				</div>
				<div class="col-lg-3 col-xs-12">
					<div class="photo-select product-edit">
						<img src="{{asset('/public/images/service-nofound.jpg')}}" class="pro_card_img blah" id="showimg">
						<input type="file" id="files" class="hidden" multiple>
						<label for="files">Upload Image</label>
					</div>
					<p>Upload up to 10 images to showcase your product</p>
				</div>
				<div class="col-lg-9 col-xs-12">
					<div class="row">
						<div class="col-md-4 col-sm-6 col-xs-12">
							<div class="form-group">
								<label for="pprice">Product Price</label>
								<input type="text" class="form-control" name="Productprice" placeholder="$">
							</div>
						</div>
						<div class="col-md-4 col-sm-6 col-xs-12">
							<div class="form-group">
								<label for="bcost">Business Cost</label>
								<input type="text" class="form-control" name="Businesscost"	placeholder="$">
							</div>
						</div>
						<div class="col-md-4 col-sm-6 col-xs-12">
							<div class="form-group">
								<label for="tax">Add Sales Tax</label>
								<input type="text" class="form-control" name="Addsalestax">
							</div>
						</div>
								
						<div class="col-md-5 col-sm-6 col-xs-12">
							<div class="form-group">
								<label for="earnings">Your Estimated Earnings <i class="fas fa-info-circle red-fonts"></i></label>
								<input type="text" class="form-control" name="Earnings" placeholder="$">
							</div>
						</div>
						<div class="col-md-3 col-sm-6 col-xs-12">
							<div class="form-group">
								<label for="scost">Shipping Cost</label>
								<input type="text" class="form-control" name="Shippingcost"	placeholder="$">
							</div>
						</div>
						<div class="col-md-4 col-sm-6 col-xs-12">
							<div class="form-group">
								<label for="salepricet">On Sale Price</label>
								<input type="text" class="form-control" name="Saleprice" placeholder="$">
							</div>
						</div>
						<div class="col-md-12 col-sm-6 col-xs-12">
							<div class="product-sprator"></div>
						</div>
						<div class="col-md-12 col-sm-6 col-xs-12">
							<div class="product-sub-title">
								<label>Inventory Count</label>
							</div>
						</div>
						<div class="col-md-3 col-sm-6 col-xs-12">
							<div class="form-group">
								<label>Quantity</label>
								<input type="text" class="form-control" name="quantity" placeholder="0">
							</div>
						</div>
						<div class="col-md-4 col-sm-6 col-xs-12">
							<div class="form-group">
								<label>Low Quantity Alert</label>
								<input type="text" class="form-control" name="lquantity" placeholder="0">
							</div>
						</div>
						<div class="col-md-5 col-sm-6 col-xs-12">
							<div class="form-group">
								<label>Vendor</label> <a class="position-add">Create New Vendor</a>
								<select multiple id="vendorselect" name="vendorselect">
									<option value="Cardio Equipment">Cardio Equipment</option>
									<option value="Strength Equipment">Strength Equipment</option>
                                    <option value="Stretch Equipment">Stretch Equipment </option>
                                 </select>
								<script>
                                    var p = new SlimSelect({
										select: '#vendorselect'
                                    });
                                </script>
							</div>
						</div>
						<div class="col-md-12 col-sm-6 col-xs-12">
							<div class="product-sprator"></div>
						</div>
								
						<div class="col-md-12 col-sm-6 col-xs-12">
							<div class="product-sub-title">
								<label>Product Details</label>
							</div>
						</div>
						<div class="col-md-6 col-sm-6 col-xs-12">
							<div class="form-group">
								<label>Colors (Select all that apply) </label> <a class="position-add">Add new colors</a>
								<select multiple id="colorsselect" name="colorsselect">
									<option value="Cardio Equipment">Cardio Equipment</option>
									<option value="Strength Equipment">Strength Equipment</option>
                                    <option value="Stretch Equipment">Stretch Equipment </option>
                                 </select>
								<script>
                                    var p = new SlimSelect({
                                        select: '#colorsselect'
                                     });
                                </script>
							</div>
						</div>

						<div class="col-md-6 col-sm-6 col-xs-12">
							<div class="form-group">
								<label>Brands </label> <a class="position-add">Add new brands</a>
								<select multiple id="brandssselect" name="brandsselect">
									<option value="Cardio Equipment">Cardio Equipment</option>
									<option value="Strength Equipment">Strength Equipment</option>
                                    <option value="Stretch Equipment">Stretch Equipment </option>
                                </select>
								<script>
									var p = new SlimSelect({
                                        select: '#brandssselect'
                                    });
                                </script>
							</div>
						</div>

						<div class="col-md-6 col-sm-6 col-xs-12">
							<div class="form-group">
								<label>Sizes (Select all that apply)</label> <a class="position-add">Add New Size </a>
								<select multiple id="sizesselect" name="sizesselect">
									<option value="Cardio Equipment">15</option>
									<option value="Strength Equipment">20</option>
                                    <option value="Stretch Equipment">30</option>
                                </select>
								<script>
                                    var p = new SlimSelect({
                                        select: '#sizesselect'
                                    });
                                </script>
							</div>
						</div>

						<div class="col-md-6 col-sm-6 col-xs-12">
							<div class="form-group">
								<label>Catagory (Select all that apply) </label> 
									<select multiple id="catagoryselect" name="catagoryselect">
										<option value="Cardio Equipment">1</option>
										<option value="Strength Equipment">2</option>
                                        <option value="Stretch Equipment">3</option>
                                    </select>
									<script>
										var p = new SlimSelect({
                                            select: '#catagoryselect'
                                        });
									</script>
							</div>
						</div>

						<div class="col-md-6 col-sm-6 col-xs-12">
							<div class="form-group">
								<label>Great For (Select all that apply)</label> 
									<select multiple id="greatselect" name="greatselect">
										<option value="Cardio Equipment">15</option>
										<option value="Strength Equipment">20</option>
                                        <option value="Stretch Equipment">30</option>
                                    </select>
									<script>
                                        var p = new SlimSelect({
                                            select: '#greatselect'
                                         });
                                    </script>
							</div>
						</div>
								
						<div class="col-md-6 col-sm-6 col-xs-12">
							<div class="form-group">
								<label>What activity is this for? (Select all that apply)</label> 
									<select multiple id="activityselect" name="activityselect">
										<option value="Cardio Equipment">15</option>
										<option value="Strength Equipment">20</option>
										<option value="Stretch Equipment">30</option>
                                    </select>
									<script>
                                        var p = new SlimSelect({
                                           select: '#activityselect'
                                        });
                                    </script>
							</div>
						</div>

						<div class="col-md-6 col-sm-6 col-xs-12">
							<div class="form-group">
								<label>Material (Select all that apply) </label> <a class="position-add">Add new material </a>
								<select multiple id="materialselect" name="materialselect">
									<option value="Cardio Equipment">15</option>
									<option value="Strength Equipment">20</option>
                                    <option value="Stretch Equipment">30</option>
                                </select>
								<script>
                                    var p = new SlimSelect({
                                        select: '#materialselect'
                                    });
                                </script>
							</div>
						</div>
						<div class="col-md-12">
							<div class="product-des form-group">
								<label class="position-gander">Explain your policy and what steps to take for customers returning products.</label>
								<textarea id="w3review" name="w3review" rows="4" cols="80">	</textarea> 
							</div>
							<button class="button-fitness add-another-session-edudetails add-staff-btn sp-bottom">Add</button>
						</div>
					</div>
				</div>
	
			</div>
		</div>
	</div>
	

									
</div> 

<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script type="text/javascript" src="http://dev.fitnessity.co/public/js/slimselect.min.js"></script>

<script type="text/javascript">
	$('.completionyear').Zebra_DatePicker({
		format: 'm/d/Y',
		default_position: 'below'
    });
</script>

@include('layouts.footer')



@endsection
