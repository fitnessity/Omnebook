<div class="membership-expirations-table">
	<div class="table-responsive">
		<table class="table mb-0">
			<thead>
				<tr>
					<th>No</th>
					<th>Name</th>
					<th>Email </th>
					<th>Birthday</th>
					<th>Phone Number</th>
					<th>Customers Since</th>
					<th></th>
				</tr>
			</thead>
			<tbody>
				@forelse($clients as $i=>$list)
					<tr>
						<td>{{$i+1}}</td>
						<td><a href="{{url('business/'.$list->business_id.'/customers/'.@$list->id)}}" class="fw-medium" target="_blank">  {{@$list->full_name}}  </a> </td>
						<td>{{@$list->email}}</td>
						<td>{{date('m/d/Y',strtotime($list->birthdate))}}</td>
						<td>{{@$list->phone_number != '' ? $list->phone_number : 'N/A'}}</td>
						<td>{{date('m/d/Y',strtotime($list->created_at))}}</td>
						<td><a href="{{url('business/'.$list->business_id.'/customers/'.@$list->id)}}"> View </a></td>
					</tr>
				@empty
					<tr> <td colspan="6">No In-Active Clients To Display </td> </tr>
				@endforelse
			</tbody>
		</table>
	</div>
</div>