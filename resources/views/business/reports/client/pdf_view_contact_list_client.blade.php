<!DOCTYPE html>
<html>
<head>
    <title>{{ @$title }}</title>
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
		<h4>{{@$title}}</h4>
	</div>
    
	@if(!empty(@$clients))
		<div class="pdf-table">
			<table>
				<tr>
					<th>No</th>
					<th>Name</th>
					<th>Member ID</th>
					<th>Email </th>
					@if($listType == 'mailing-list') 
						<th>Address</th>
						<th>City</th>
						<th>State</th>
						<th>Zip</th>
					@endif
					<th>Phone Number </th>
					<th>Customer Type</th>
					<th>Status</th>
				</tr>
				@forelse($clients as $i=>$list)
					<tr>
						<td>{{$i+1}}</td>
						<td>{{@$list->full_name}}</td>
						<td>{{@$list->member_id}}</td>
						<td>{{@$list->email}}</td>
						@if($listType == 'mailing-list') 
							<td>{{@$list->address ?? 'N/A'}}</td>
							<td>{{@$list->city ?? 'N/A'}}</td>
							<td>{{@$list->state ?? 'N/A'}}</td>
							<td>{{@$list->zipcode ?? 'N/A'}}</td>
						@endif
						<td>{{@$list->phone_number ?? 'N/A'}}</td>
						<td>{{@$list->customer_type}}</td>
						<td>{{@$list->is_active()}}</td>
					</tr>
				@empty
					<tr> <td @if($listType == 'mailing-list') colspan="10" @else colspan="6" @endif></td> </tr>
				@endforelse
			</table>
		</div>
	@endif
</body>
</html>