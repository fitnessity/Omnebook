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
						<!-- <a  class="btn-grey" href="#" data-toggle="modal" data-target="#product-modal" > Add Product</a> -->
						<a  class="btn-grey" href="{{route('business.products.create')}}" > Add Product</a>
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
</div> 


@include('layouts.footer')

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
