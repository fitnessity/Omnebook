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
			font-weight: 700;
		}
		.pdf-table table tr th{
			color: #fff;
			background-color: #ea1515;
		}
		.reports-card-header{
			text-align: center;
			margin-bottom: 0px;
			font-size: 17px;
		}
		.font-red{
			color: red;
		}

		.font-green{
			color: green;
		}
        
</style>
</head>
<body>
	<div class="reports-card-header">
		<h4>Membership Reports</h4>
	</div>
    <div class="card-header align-items-center d-flex">
        <h4 class="card-title mb-0 flex-grow-1" id="headingDate">{{$dates}}</h4>
    </div>
	
	@if(count($upcoming) > 0)
		<div class="table-card">
			<label>Upcoming Autopay Payments</label>
		</div>
		@include('business.reports.recurring.pdf_table_data' , ['data'=> $upcoming , 'business_id' => $business_id])
	@endif

    @if(count($sucessfull) > 0)
        <div class="table-card">
			<label>Processed Payments</label>
		</div>
        @include('business.reports.recurring.pdf_table_data' , ['data'=> $sucessfull , 'business_id' => $business_id])
    @endif

    @if(count($failed) > 0)
        <div class="table-card">
			<label>Failed Autopay Payments</label>
		</div>
        @include('business.reports.recurring.pdf_table_data' , ['data'=> $failed , 'business_id' => $business_id])
    @endif

    @if(count($all) > 0)
        <div class="table-card">
			<label> Autopay History </label>
		</div>
        @include('business.reports.recurring.pdf_table_data' , ['data'=> $all, 'business_id' => $business_id])
    @endif

    @if(count($reminingMoney) > 0)
        <div class="table-card">
			<label> Customers who owe money </label>
		</div>
        @include('business.reports.recurring.pdf_table_data' , ['data'=> $reminingMoney , 'business_id' => $business_id ])
    @endif

</body>
</html>