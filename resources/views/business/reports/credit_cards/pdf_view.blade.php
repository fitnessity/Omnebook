<!DOCTYPE html>
<html>
<head>
    <title>Reports</title>
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
		.font-green{
			color: green;
		}
		.font-red{
			color: red;
		}
        
</style>
</head>
<body>
	<div class="reports-card-header">
		<h4>Credit Card Expirations Report</h4>
	</div>
    <div class="card-header align-items-center d-flex">
        <h4 class="card-title mb-0 flex-grow-1" id="headingDate">{{$dates}}</h4>
    </div>
	
	@if(count($expiringCards) > 0)
		<div class="pdf-table">
			<table>
				<tr>
					<th>No</th>
					<th>Name</th>
					<th>Expire Month</th>
					<th>Expire Year</th>
				</tr>
				@php $counter = 1; @endphp
				@forelse($expiringCards as $i=>$list)
					<tr>
						<td>{{$counter}}</td>
						<td>{{@$list->Customer->full_name}}</td>
						<td>{{@$list->exp_month}}</td>
						<td>{{$list->exp_year}}</td>
					</tr>
					 @php $counter++; @endphp
				@empty
					<tr> <td colspan="6">No expired Cards Available</td> </tr>
				@endforelse
			</table>
		</div>
	@endif
</body>
</html>