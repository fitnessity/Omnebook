<!DOCTYPE html>
<html>
<head>
    <title>Cancellation And No Show Details</title>
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
        
</style>
</head>
<body>
	<div class="reports-card-header">
		<h4>Cancellation And No Show Details</h4>
	</div>
    <div class="card-header align-items-center d-flex">
        <h4 class="card-title mb-0 flex-grow-1" id="headingDate">{{$dates}}</h4>
    </div>
	
	@if(count($cancel) > 0)
		<div class="table-card">
			<label>Cancellation</label>
		</div>
		@include('business.reports.client.cancellation_pdf_table' , ['bookings'=> $cancel ,'type'=>'Cancellation'])
	@endif

    @if(count($noShow) > 0)
        <div class="table-card">
			<label>NoShow</label>
		</div>
        @include('business.reports.client.cancellation_pdf_table' , ['bookings'=> $noShow , 'type'=>'NoShow'])
    @endif

</body>
</html>