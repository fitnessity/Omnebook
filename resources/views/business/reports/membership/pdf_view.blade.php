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
		<h4>{{$title}}</h4>
	</div>
    <div class="card-header align-items-center d-flex">
        <h4 class="card-title mb-0 flex-grow-1" id="headingDate">{{$dates}}</h4>
    </div>
	
	@if(count($bookings) > 0)
		<div class="pdf-table">
			<table>
				<tr>
					<th>No</th>
					<th>Client</th>
					<th>Purchase Date</th>
					<th>Expiration date</th>
					<th>Purchase Amount</th>
					<th>Status</th>
					@if(@$page == 'not_used')<th>Last Attended</th>@endif
				</tr>
				@php $counter = 1; @endphp
				@forelse($bookings as $i=>$list) 
					<tr>
						<td>{{$counter}}</td>
						<td>{{@$list->Customer->full_name}}</td>
						<td>{{date('m-d-Y', strtotime($list->contract_date))}}</td>
						<td>{{date('m-d-Y', strtotime($list->expired_at))}}</td>
						<td>$ {{$list->subtotal}}</td>
						<td class="{{($list->status == 'active') ? 'font-green' : 'font-red'}}"> {{$list->status}}</td>
						@if(@$page == 'not_used')<td>{{$list->last_attended}}</td>@endif
					</tr>
					@php $counter++; @endphp
				@empty
					<tr> <td colspan="8">No Bookings To Display </td> </tr>
				@endforelse
			</table>
		</div>
	@endif
</body>
</html>