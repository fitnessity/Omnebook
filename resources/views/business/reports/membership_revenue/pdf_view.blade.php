<!DOCTYPE html>
<html>
<head>
    <title>{{ $title }}</title>
    <style>
		table {
		  border-collapse: collapse;
		  width: 100%;
		}
        th, td {
          border: 1px solid #dddddd;
		  font-size: 12px;
		  padding: 5px;
        }
		.table-card{
			padding: 15px 0;
		}
		.table-card label{
			color: #ed1b24;
			font-size: 14px;
		}
		.pdf-table table tr th{
			color: #fff;
			background-color: #ea1515;
		}

		.table-card label{
			font-weight: 700;
		}

		.reports-card-header{
			text-align: center;
			margin-bottom: 0px;
			font-size: 17px;
		}
</style>
</head>
<body>

	<div class="reports-card-header">
		<h4>Revenue Breakdown Membership Reports</h4>
	</div>

    <div class="card-header align-items-center d-flex">
        <h4 class="card-title mb-0 flex-grow-1" id="headingDate">{{$dates}}</h4>
    </div>
    @php
	    $grandTotal = $adultRevenue  = $childRevenue = $infantRevenue =  $singlePmt = $productRevenue = $recurringPmt = 0;
	    $revenueTotals = [ 'Classes' => 0, 'Personal Training' => 0, 'Experience' => 0, 'Events' => 0];
    @endphp

    @if (count($memberships) > 0 ) 
        <div class="table-card"><label>Single Payment Membership</label></div>
        <div class="pdf-table">
        	<table>
			    <tr>
			        <th>No</th>
					<th>Program Name</th>
					<th>Membership Type</th>
					<th>Membership For</th>
					<th>Price</th>
					<th>Qty</th>
					<th>Revenue</th>
			    </tr>
			  	
				@forelse($memberships as $i=>$m)
					@php 
						$revenue = $m->getMembershipRevenue($filterStartDate, $filterEndDate,$business_id);
						$adultRevenue += $m->getRevenueByType('adult',$filterStartDate, $filterEndDate,$business_id);
						$childRevenue += $m->getRevenueByType('child',$filterStartDate, $filterEndDate,$business_id);
						$infantRevenue += $m->getRevenueByType('infant',$filterStartDate, $filterEndDate,$business_id);

						$singlePmt += $revenue ;
						$grandTotal += $revenue ;

						$revenueTotals[$m->BusinessServices->formal_service_types()] += $revenue;
					@endphp
				<tr>
					<td>{{$i+1}}</td>
					<td>{{$m->BusinessServices->program_name}} - {{$m->price_title}}</td>
					<td>{{$m->BusinessServices->formal_service_types()}}</td>
					<td>{{$m->getMembershipFor($filterStartDate,$filterEndDate,$business_id)}}</td>
					<td>{{$m->getMembershipPrice($filterStartDate,$filterEndDate,$business_id)}}</td>
					<td>{{$m->getMembershipQty($filterStartDate,$filterEndDate,$business_id)}}</td>
					<td>${{$revenue}}</td>
				</tr>
				@empty
					<tr><td colspan="7">No Membership Available.</tr></td>
				@endforelse
			</table>
        </div>
    @endif

    @if(count($recurringMemberships) > 0)
        <div class="table-card"><label>Recurring Memberships</label></div>
        <div class="pdf-table">
        	<table>
			    <tr>
			        <th>No</th>
					<th>Program Name</th>
					<th>Membership Type</th>
					<th>Membership For</th>
					<th>Price</th>
					<th>Qty</th>
					<th>Revenue</th>
			    </tr>
			    @forelse($recurringMemberships as $i=>$m)
					@php 
						$recurringRevenue = $m->getRecurringMembershipRevenue($filterStartDate, $filterEndDate,$business_id);

						$adultRevenue += $m->getRecurringRevenueByType('adult',$filterStartDate, $filterEndDate,$business_id);
						$childRevenue += $m->getRecurringRevenueByType('child',$filterStartDate, $filterEndDate,$business_id);
						$infantRevenue += $m->getRecurringRevenueByType('infant',$filterStartDate, $filterEndDate,$business_id);

						$recurringPmt += $recurringRevenue ;
						$grandTotal += $recurringRevenue ;

						$revenueTotals[$m->BusinessServices->formal_service_types()] += $recurringRevenue;
					@endphp
					<tr>
						<td>{{$i+1}}</td>
						<td>{{$m->BusinessServices->program_name}} - {{$m->price_title}}</td>
						<td>{{$m->BusinessServices->formal_service_types()}}</td>
						<td>{{$m->getRecurringMembershipFor($filterStartDate,$filterEndDate,$business_id)}}</td>
						<td>{{$m->getRecurringMembershipPrice($filterStartDate,$filterEndDate,$business_id)}}</td>
						<td>{{$m->getRecurringMembershipQty($filterStartDate,$filterEndDate,$business_id)}}</td>
						<td>${{$recurringRevenue}}</td>
					</tr>
				@empty
					<tr><td colspan="7">No Recurring Membership Available.</td></tr>
				@endforelse
			</table>
        </div>
    @endif

    @if(count($products) > 0)
        <div class="table-card"><label>Products Shop</label></div>
    	<div class="pdf-table">
        	<table>
        		<tr>
				    <th>No</th>
					<th>Product Name</th>
					<th>Price</th>
					<th>Qty</th>
					<th>Revenue</th>
				</tr>
			    @forelse($products as $i=>$p)
				@php 
					$productRevenue += $p->getProductRevenue($filterStartDate,$filterEndDate,$business_id);
					$grandTotal += $p->getProductRevenue($filterStartDate,$filterEndDate,$business_id);
				@endphp 
				
				<tr>
					<td>{{$i+1}}</td>
					<td>{{$p->name}}</td>
					<td>{{$p->getProductPrice($filterStartDate,$filterEndDate,$business_id)}}</td>
					<td>{{$p->getProductQty($filterStartDate,$filterEndDate,$business_id)}}</td>
					<td>${{$p->getProductRevenue($filterStartDate,$filterEndDate,$business_id)}}</td>
				</tr>
				@empty
					<tr><td colspan="5">No Product Available.</td></tr>
				@endforelse
			</table>
        </div>
    @endif
    
    <div class="table-card">
		<label>Grand Total </label>
	</div>
	<div class="pdf-table">
		<table>
			<tr>
				<th>Infant</th>
				<th>Kids</th>
				<th>Adults</th>
				<th>Classes</th>
				<th>Personal Training</th>
				<th>Experience</th>
				<th>Events</th>
				<th>Product</th>
				<th>Recurring</th>
				<th>Single Payment</th>
				<th>Total</th>
			</tr>
			<tr>
				<td>${{$infantRevenue}}</td>
				<td>${{$childRevenue}}</td>
				<td>${{$adultRevenue}}</td>
				<td>${{$revenueTotals['Classes']}}</td>
				<td>${{$revenueTotals['Personal Training']}}</td>
				<td>${{$revenueTotals['Experience']}}</td>
				<td>${{$revenueTotals['Events']}}</td>
				<td>${{$productRevenue}}</td>
				<td>${{$recurringPmt}}</td>
				<td>${{$singlePmt}}</td>
				<td>${{$grandTotal}}</td>
			</tr>
		 </table>
	</div>
</body>
</html>