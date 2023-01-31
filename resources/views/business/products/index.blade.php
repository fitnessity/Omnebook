@extends('layouts.header')
@section('content')
@include('layouts.userHeader')

<div class="p-0 col-md-12 inner_top nopadding">
    <div class="row">
        <div class="col-md-2" style="background: black;">
        	 @include('business.businessSidebar')
            <?php /*?><div class="navbar1">
                <div class="navlink1" id="tab1" onclick="location.href='business-welcome';">Welcome</div>
                <div class="navlink1" id="tab2" onclick="linkJump(2);">Company Details</div>
                <div class="navlink1" id="tab3" onclick="linkJump(3);">Your Experience</div>
                <div class="navlink1" id="tab4" onclick="linkJump(4);">Company Specifics</div>
                <div class="navlink1" id="tab5" onclick="linkJump(5);">Set Your Terms</div>
                <div class="navlink1" id="tab6" onclick="linkJump(6);">Get Verified</div>
                <div class="navlink1" id="tab7" onclick="linkJump(7);">Create Services & Prices</div>
                <div class="navlink1" id="tab8" onclick="linkJump(8);">Booking Info</div>
            </div><?php */?>
            <?php /*
            @if(isset($business_details) && !empty($business_details['id']))
            <div class="navbar1">
                <div class="navlink1"><a style="color:#fff" href="/pcompany/view/{{ $business_details['id'] }}" target="_blank">Preview Profile</a></div>
            </div>
            @endif
             */ ?>
        </div>
		<div class="col-md-10">
            <div class="container-fluid p-0">
                <div class="tab-hed">Manage Products</div>
                <hr style="border: 15px solid black;width: 104%;margin-left: -38px;">
            </div>
			<div class="row">
				<div class="col-md-2">
					<div class="staff-main">
						<a  class="btn-grey" href="#" data-toggle="modal" data-target="#product-modal" > Add Product</a>
					</div>
				</div>
				<div class="col-md-5">
					<div class="staff-main top-nav search-staff">
						<input type="text" placeholder="Search by product or item #">
					</div>
				</div>
				<div class="col-md-2">
					<div class="staff-main">
						<button type="button" class="button-fitness search-staff fix-width">Search</button>
					</div>
				</div>
			</div>
			<div class="table-staff table-responsive">
				<table id="example" class="table table-striped table-bordered" style="width:100%">
					<thead>
						<tr>
							<th>Item # </th>
							<th>Product Name </th>
							<th>Catagory </th>
							<th>Qty </th>
							<th>Low Qty Alert </th>
							<th>Sell Price </th>
							<th>Sale Price  </th>
							<th>Your Cost </th>
							<th>Shipping Cost  </th>
							<th></th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td>10001 </td>
							<td> Boxing Gloves </td>
							<td>Training Gear </td>
							<td>50 </td>
							<td>5</td>
							<td>$50.00</td>
							<td>$10.00 </td>
							<td>$4.95</td>
							<td>$10.95</td>
							<td>
								<div class="table-icons-staff">
									<a href="#" title="Staff Scheduled Activities"><i class="fa fa-table"></i></a>
									<a title="Edit" ><i class="fa fa-pencil-square-o"></i></a>
									<i class="fa fa-trash" aria-hidden="true" title="Delete"></i>	
								</div>
							</td>
						</tr>
						
						<tr>
							<td>10001 </td>
							<td> Boxing Gloves </td>
							<td>Training Gear </td>
							<td>50 </td>
							<td>5</td>
							<td>$50.00</td>
							<td>$10.00 </td>
							<td>$4.95</td>
							<td>$10.95</td>
							<td>
								<div class="table-icons-staff">
									<a href="#" title="Staff Scheduled Activities"><i class="fa fa-table"></i></a>
									<a title="Edit" ><i class="fa fa-pencil-square-o"></i></a>
									<i class="fa fa-trash" aria-hidden="true" title="Delete"></i>	
								</div>
							</td>
						</tr>
						
						<tr>
							<td>10001 </td>
							<td> Boxing Gloves </td>
							<td>Training Gear </td>
							<td>50 </td>
							<td>5</td>
							<td>$50.00</td>
							<td>$10.00 </td>
							<td>$4.95</td>
							<td>$10.95</td>
							<td>
								<div class="table-icons-staff">
									<a href="#" title="Staff Scheduled Activities"><i class="fa fa-table"></i></a>
									<a title="Edit" ><i class="fa fa-pencil-square-o"></i></a>
									<i class="fa fa-trash" aria-hidden="true" title="Delete"></i>	
								</div>
							</td>
						</tr>
						
						<tr>
							<td>10001 </td>
							<td> Boxing Gloves </td>
							<td>Training Gear </td>
							<td>50 </td>
							<td>5</td>
							<td>$50.00</td>
							<td>$10.00 </td>
							<td>$4.95</td>
							<td>$10.95</td>
							<td>
								<div class="table-icons-staff">
									<a href="#" title="Staff Scheduled Activities"><i class="fa fa-table"></i></a>
									<a title="Edit" ><i class="fa fa-pencil-square-o"></i></a>
									<i class="fa fa-trash" aria-hidden="true" title="Delete"></i>	
								</div>
							</td>
						</tr>
						
					</tbody>
				</table>
			</div>
		</div>
	</div>

	<!-- The Modal Add Business-->
	<div class="modal fade compare-model" id="product-modal">
		<div class="modal-dialog modal-lg staff-modal">
			<div class="modal-content">
				<div class="modal-header" style="text-align: right;"> 
					<div class="closebtn">
						<button type="button" class="close close-btn-design-staff" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">×</span>
						</button>
					</div>
				</div>
	 
				<!-- Modal body -->
				<div class="modal-body">
					<div class="row contentPop">
						<div class="col-lg-12">
						   <h4 class="modal-title" style="text-align: left; color: #000; line-height: inherit; font-weight: 600; margin-bottom: 15px;">Add New Product</h4>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label>Product Name </label>
								<input type="text" name="pname" id="" class="form-control" maxlength="100" >
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label>Barcode # </label>
								<input type="text" name="barcode" id="" class="form-control" maxlength="100" >
							</div>
						</div>
						<div class="col-md-12">
							<div class="product-des form-group">
								<label class="position-gander">Product Description</label>
								<textarea id="w3review" name="w3review" rows="4" cols="80">Add a description for the product.</textarea> 
							</div>
						</div>
						<div class="col-lg-3">
							<div class="photo-select">
								<img src="{{asset('/public/images/service-nofound.jpg')}}" class="pro_card_img blah" id="showimg">
								<input type="file" id="files" class="hidden" multiple>
								<label for="files">Upload Image</label>
							</div>
							<p>Upload an image to showcase your staff</p>
						</div>
						<div class="col-lg-9">
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
								<!--<div class="col-md-3 col-sm-6 col-xs-12">
									<div class="form-group">
										<label for="position">Position</label> <a class="position-add">Add Position</a>
										<div class="special-offer">
											<div class="multiples">
												<select id="providerservices" name="service_type[]" class="myfilter" multiple="multiple">
													<option value="individual">select poisition</option>
													<option value="classes">select poisition</option>
												</select>
											</div>
											
										</div>
									</div>
								</div>-->
								<div class="col-md-4 col-sm-6 col-xs-12">
									<div class="form-group">
										<label for="salepricet">On Sale Price</label>
										<input type="text" class="form-control" name="Saleprice"	placeholder="$">
									</div>
								</div>
								
								<div class="staff-sprator"></div>
								
								<div class="col-md-5 col-sm-6 col-xs-12">
									<div class="form-group">
										<label for="address">Address</label>
										<input type="text" class="form-control" name="Address">
									</div>
								</div>
								<div class="col-md-3 col-sm-6 col-xs-12">
									<div class="form-group">
										<label for="city">City</label>
										<input type="text" class="form-control" name="City"	>
									</div>
								</div>
								<div class="col-md-4 col-sm-6 col-xs-12">
									<div class="form-group">
										<label for="state">State</label>
										<input type="text" class="form-control" name="State">
									</div>
								</div>
								
								<div class="col-md-5 col-sm-6 col-xs-12">
									<div class="form-group">
										<label for="postcode">Post Code</label>
										<input type="text" class="form-control" name="Address">
									</div>
								</div>
								<div class="form-group col-md-5 col-sm-6 col-xs-12">
									<label for="email">Birthday <!-- <span id="star">*</span> --></label>
									<div class="special-date">
										<input  type="text" class="form-control completionyear" id="completionyear" name="frm_passingdate[]" placeholder="Completion Date" autocomplete="off" value="">
										<span class="error" id="b_certificateyear"></span>
									</div>
								</div>
							</div>
						</div>
	
						
						<div class="col-md-12">
							<div class="text-border public-bio">
								<label class="position-gander">Public Bio</label>
								<textarea id="w3review" name="w3review" rows="4" cols="80">Tell us something about your staff member. Customers will learn more about who they are training with.
								</textarea> 
							</div>
							<button class="button-fitness add-another-session-edudetails add-staff-btn">Add</button>
							<!--<div class="staff-sprator"></div>
							<div class="table-header">Scheduled Activities</div>
								<table id="scheduled-activities" class="table table-striped table-bordered" style="width:100%">
									<thead>
										<tr>
											<th> Activity </th>
											<th>Program</th>
											<th> Location</th>
											<th>Days of week</th>
											<th>Position</th>
											<th>Service Type</th>
											<th>Duration</th>
											<th>Time</th>
										</tr>
									</thead>
									<tbody>
										<tr>
											<td>c   Kickboxing</td>
											<td>Kickboxing Level 1 for beginners </td>
											<td>At Business </td>
											<td>M,T,W,T,F </td>
											<td>Instructor</td>
											<td>Class</td>
											<td>45m</td>
											<td>6:15 pm to 7:00 pm </td>
										</tr>
									</tbody>
								</table>
								
							</div>-->
							
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- end modal -->
									
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
@include('layouts.footer')

<script type="text/javascript">
	$('.completionyear').Zebra_DatePicker({
		format: 'm/d/Y',
		default_position: 'below'
    });
</script>

<script>
	$(document).ready(function() {
		$('#example').DataTable();
	} );	
	
	$('#example').dataTable( {
		"searching": false
		"paging": false
	} );
</script>
<script>
	$(document).ready(function() {
		$('#scheduled-activities').DataTable();
	} );	
	
	$('#scheduled-activities').dataTable( {
		"searching": false
	} );
</script>
<script>
    $(document).ready(function() {
      
        var categ = new SlimSelect({
            select: '#providerservices'
        });
    });
</script>

@endsection
