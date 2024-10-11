<!DOCTYPE html>
<html>
<head>
    <title>Online Reviews</title>
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
		<h4>Online Review</h4>
	</div>
    <div class="card-header align-items-center d-flex">
        <h4 class="card-title mb-0 flex-grow-1" id="headingDate">{{$dates}}</h4>
    </div>
	
	@if(count($reviews) > 0)
		<div class="pdf-table">
			<table>
				<tr>
					<th>No</th>
					<th>Activity Name</th>
					<th>Ratings</th>
					<th>Review Date</th>
					<th>Review By</th>
				</tr>
				@php $counter = 1; @endphp
				@forelse($reviews as $i=>$list) 
					<tr>
						<td>{{$counter}}</td>
						<td>{{$list->business_services_with_trashed->program_name}}</td>
						<td>{{$list->rating}}</td>
						<td>{{date('m-d-Y', strtotime($list->created_at))}}</td>
						<td>{{$list->User->full_name}}</td>
					</tr>
					@php $counter++; @endphp
				@empty
					<tr> <td colspan="5">No Reviews To Display </td> </tr>
				@endforelse
			</table>
		</div>
	@endif
</body>
</html>