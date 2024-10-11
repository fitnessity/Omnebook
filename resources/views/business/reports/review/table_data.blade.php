<div class="membership-expirations-table">
	<div class="table-responsive">
		<table class="table mb-0">
			<thead>
				<tr>
					<th>No</th>
					<th>Activity Name</th>
					<th>Ratings</th>
					<th>Review Date</th>
					<th>Review By</th>
					<th></th>
				</tr>
			</thead>
			<tbody>
				@php $counter = 1; @endphp
				@forelse($review as $i=>$list) 
					<tr>
						<td>{{$counter}}</td>
						<td>{{$list->business_services_with_trashed->program_name}}</td>
						<td>{{$list->rating}}</td>
						<td>{{date('m-d-Y', strtotime($list->created_at))}}</td>
						<td>{{$list->User->full_name}}</td>
						<td>
							<a href="{{url('/activity-details/'.$list->service_id)}}"> View </a>
						</td>
					</tr>
					@php $counter++; @endphp
				@empty
					<tr> <td colspan="6">No Bookings To Display </td> </tr>
				@endforelse
			</tbody>
		</table>
	</div>
</div>