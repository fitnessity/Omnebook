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
		<h4>Sales Reports</h4>
	</div>

    <div class="card-header align-items-center d-flex">
        <h4 class="card-title mb-0 flex-grow-1" id="headingDate">{{$dates}}</h4>
    </div>
    @php
	    $grandtotal = $totalTax = $totalDiscount = $totalCheck =  $totalCard = $totalCash = $totalComp = 0;
    @endphp

    @if (count($cardData) > 0 ) 
        <div class="table-card"><label>Card</label></div>
        @foreach($cardData as $i=>$data)
            <div class="table-card"><label>{{strtoupper($i).'-Keyed'}}</label></div>
            <div class="pdf-table">
            	<table>
				    <tr>
				        <th>Sale Date</th>
				        <th>Client</th>
				        <th>Item name</th>
				        <th>Location</th>
				        <th>Notes</th>
				        <th>Item Price</th>
				        <th>Qty </th>
				        <th>Subtotal </th>
				        <th>Discount Amount</th>
				        <th>Tax </th>
				        <th>Item Total  </th>
				        <th>Total Paid/Payment Method </th>
				    </tr>
				    @forelse($data as $i=>$dt)
				        @php 
				        	$totalCard += $dt->item_description($business_id)['totalPaid']; 
				        	$totalTax += $dt->item_description($business_id)['totalTax'];
				        	$totalDiscount += $dt->item_description($business_id)['totalDis'];
        				@endphp
                		@include('business.sales_report.table_data' , ['dt'=> $dt,'business_id' =>$business_id ])
                	@empty
				    @endforelse
				</table>
            </div>
        @endforeach
    @endif

    @if(count($cashReport) > 0)
        <div class="table-card"><label>Cash</label></div>
        <div class="pdf-table">
        	<table>
			    <tr>
			        <th>Sale Date</th>
			        <th>Client</th>
			        <th>Item name</th>
			        <th>Location</th>
			        <th>Notes</th>
			        <th>Item Price</th>
			        <th>Qty </th>
			        <th>Subtotal </th>
			        <th>Discount Amount</th>
			        <th>Tax </th>
			        <th>Item Total  </th>
			        <th>Total Paid/Payment Method </th>
			    </tr>
			    @forelse($cashReport as $i=>$dt)
			        @php 
			        	$totalCash += $dt->item_description($business_id)['totalPaid']; 
			        	$totalTax += $dt->item_description($business_id)['totalTax'];
				        	$totalDiscount += $dt->item_description($business_id)['totalDis'];
    				@endphp
            		@include('business.sales_report.table_data' , ['dt'=> $dt,'business_id' =>$business_id ])
            	@empty
			    @endforelse
			</table>
        </div>
    @endif

    @if(count($compReport) > 0)
        <div class="table-card"><label>Comp</label></div>
        <div class="pdf-table">
        	<div class="pdf-table">
            	<table>
				    <tr>
				        <th>Sale Date</th>
				        <th>Client</th>
				        <th>Item name</th>
				        <th>Location</th>
				        <th>Notes</th>
				        <th>Item Price</th>
				        <th>Qty </th>
				        <th>Subtotal </th>
				        <th>Discount Amount</th>
				        <th>Tax </th>
				        <th>Item Total  </th>
				        <th>Total Paid/Payment Method </th>
				    </tr>
				    @forelse($compReport as $i=>$dt)
                		@include('business.sales_report.table_data' , ['dt'=> $dt,'business_id' =>$business_id ])
                	@empty
				    @endforelse
				</table>
            </div>
        </div>
    @endif

    @if(count($checkReport) > 0)
        <div class="table-card"><label>Check</label></div>
        <div class="pdf-table">
        	<div class="pdf-table">
            	<table>
				    <tr>
				        <th>Sale Date</th>
				        <th>Client</th>
				        <th>Item name</th>
				        <th>Location</th>
				        <th>Notes</th>
				        <th>Item Price</th>
				        <th>Qty </th>
				        <th>Subtotal </th>
				        <th>Discount Amount</th>
				        <th>Tax </th>
				        <th>Item Total  </th>
				        <th>Total Paid/Payment Method </th>
				    </tr>
				    @forelse($checkReport as $i=>$dt)
				        @php 
				        	$totalCheck += $dt->item_description($business_id)['totalPaid']; 
				        	$totalTax += $dt->item_description($business_id)['totalTax'];
				        	$totalDiscount += $dt->item_description($business_id)['totalDis'];
        				@endphp
                		@include('business.sales_report.table_data' , ['dt'=> $dt,'business_id' =>$business_id ])
                	@empty
				    @endforelse
				</table>
            </div>
        </div>
    @endif

    @php
	    $grandtotal = $totalCheck + $totalCard + $totalCash;
	@endphp
    
    <div class="table-card">
		<label>Grand Total </label>
	</div>
	<div class="pdf-table">
		<table>
			<tr>
				<th>Tax</th>
				<th>Discount </th>
				<th>Payment Method (Including tax)</th>
				<th>Cash</th>
				<th>Check</th>
				<th>Credit Card</th>
				<th>Comp.</th>
				<th>Total </th>
			</tr>
			<tr>
				<td>${{$totalTax}}</td>
				<td>${{$totalDiscount}}</td>
				<td>-</td>
				<td>${{$totalCash}}</td>
				<td>${{$totalCheck}}</td>
				<td>${{$totalCard}}</td>
				<td>$0</td>
				<td>${{$grandtotal}}</td>
			</tr>
		 </table>
	</div>
</body>
</html>