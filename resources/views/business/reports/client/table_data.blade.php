<div class="membership-expirations-table">
	<div class="table-responsive">
		<table class="table mb-0">
			<thead>
				<tr>
					<th>No</th>
					<th>Name</th>
					<th>Email </th>
					<th>Birthday</th>
					<th>Last Attended</th>
					<th>Customers Since</th>
					<th></th>
				</tr>
			</thead>
			<tbody>
				@php $i=1;@endphp
				@forelse($clients as $list)

					<tr>
						<td>{{$i}}</td>
						<td><a href="{{url('business/'.$list->business_id.'/customers/'.@$list->id)}}" class="fw-medium" target="_blank">  {{@$list->full_name}}  </a> </td>
						<td>{{@$list->email ?? "N/A"}}</td>
						<td>{{date('m/d/Y',strtotime($list->birthdate))}}</td>
						<td>{{@$list->last_attend_date != 'N/A' ? date('m/d/Y',strtotime($list->last_attend_date)): 'N/A'}}</td>
						<td>{{date('m/d/Y',strtotime($list->created_at))}}</td>
						<td><a href="{{url('business/'.$list->business_id.'/customers/'.@$list->id)}}"> View </a></td>
					</tr>
					@php $i++; @endphp
				@empty
					<tr> <td colspan="6">No In-Active Clients To Display </td> </tr>
				@endforelse
			</tbody>
		</table>
	</div>
</div>