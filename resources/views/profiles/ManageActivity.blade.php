@extends('layouts.header')
@section('content')
@include('layouts.userHeader')

<div class="p-0 col-md-12 inner_top">
    <div class="row">
        <div class="col-md-2" style="background: black;">
        	 @include('business.businessSidebar')
        </div>
		<div class="col-md-10">
            <div class="container-fluid p-0">
                <div class="tab-hed">Activity Schedule</div>
                <hr style="border: 15px solid black;width: 104%;margin-left: -38px;">
            </div>
			<div class="row">
				<div class="col-md-6 col-xs-12">
					<div class="staff-main">
						<button type="button" class="btn-grey">Back</button>
					</div>
				</div>
				<div class="col-md-6 col-xs-12">
					<div class="staff-main customer">
						<button type="button" class="button-fitness search-staff">Add New Customer</button>
					</div>
				</div>
				<div class="col-md-12 col-xs-12">
					<div class="staff-main top-nav">
						<div class="data-manage" >
							<label>Date: </label>
							<span>Wednesday, April 07 2021</span>
							
							<label>Time: </label>
							<span>10:30 am - 11:00 am </span>
							
							<label>Activity: </label>
							<span>Nutrition Coaching </span>
							
							<label>Duration:  </label>
							<span>30m </span>
							
							<label>Spots:</label>
							<span>3/10</span>
						</div>
					</div>
				</div>
			</div>
			
			<div class="row">
				<div class="col-md-12 col-xs-12">
					<div class="table-responsive table-staff manage-table">
						<table id="example" class="table table-striped table-bordered" style="width:100%">
							<thead>
								<tr>
									<th> Booking #</th>
									<th>Client Name	</th>
									<th>Price</th>
									<th> Payment Type</th>
									<th>Remaining</th>
									<th>Expiration Date</th>
									<th>Check In </th>
									<th>Late Cancel</th>
									<th>Receipt</th>
									<th></th>
									<th></th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<td>3000</td>
									<td> Darryl Phipps</td>
									<td>$1,200</td>
									<td>40 Session Pack</td>
									<td>19/40</td>
									<td>07/06/2021</td>
									<td><input type="checkbox" id="vehicle1" name="check1" value=""></td>
									<td><input type="checkbox" id="vehicle1" name="check2" value=""></td>
									<td class="receipt-text"><i class="fas fa-receipt"></i></td>
									<td><button type="button" class="button-fitness purches">Purchase</button></td>
									<td><button type="button" class="button-fitness viewaccount">View Account</button></td>
								</tr>
								
							</tbody>
						</table>
					</div>
				</div>
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
		"searching": true
	} );
</script>
@endsection