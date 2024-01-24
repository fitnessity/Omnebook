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
					<th>Email</th>
					<th>Birthday</th>
					<th>Phone Number</th>
					@if($clientType == 'inactive') <th> Last Attended </th> @endif
					<th>Customers Since</th>
					@if($clientType == 'new')<th> Status</th> @endif
				</tr>
				@forelse($clients as $i=>$list)
					<tr>
						<td>{{$i+1}}</td>
						<td>{{@$list->full_name}}</td>
						<td>{{@$list->email}}</td>
						<td>{{date('m/d/Y',strtotime($list->birthdate))}}</td>
						<td>{{@$list->phone_number ??  "N/A"}}</td>
						@if($clientType == 'inactive') <td>  {{@$list->last_attend_date != 'N/A' ? date('m/d/Y',strtotime($list->last_attend_date)): 'N/A'}} </td> @endif
						<td>{{date('m/d/Y',strtotime($list->created_at))}} </td>
						@if($clientType == 'new')<td class="@if($list->is_active() == 'InActive' ) font-red @else font-green @endif ">{{($list->is_active() == 'Active' ? 'Member' : $list->is_active())}}</td>@endif
					</tr>
				@empty
					<tr> <td colspan="6"></td></tr>
				@endforelse
			</table>
		</div>
	@endif
</body>
</html>