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
        
</style>
</head>
<body>
	<div class="reports-card-header">
		<h4>{{$title}}</h4>
	</div>
    
	@if(count($clients) > 0)
		<div class="pdf-table">
			<table>
				<tr>
					<th>No</th>
					<th>Name</th>
					<th>Email</th>
					<th>Birthday</th>
					<th>Phone Number</th>
					<th>@if($clientType == 'inactive') Last Membership complated Date  @else Customers Since @endif</th>
				</tr>
				@forelse($clients as $i=>$list)
					<tr>
						<td>{{$i+1}}</td>
						<td>{{@$list->full_name}}</td>
						<td>{{@$list->email}}</td>
						<td>{{date('m/d/Y',strtotime($list->birthdate))}}</td>
						<td>{{@$list->phone_number ??  "N/A"}}</td>
						<td> @if($clientType == 'inactive') @else {{date('m/d/Y',strtotime($list->created_at))}} @endif</td>
					</tr>
				@empty
					<tr> <td colspan="6"></td></tr>
				@endforelse
			</table>
		</div>
	@endif
</body>
</html>