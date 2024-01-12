<div class="membership-expirations-table">
	<div class="table-responsive">
		<table class="table mb-0">
			<thead>
				<tr>
					<th>No</th>
					<th>Name</th>
					<th>Membership Name</th>
					<th>Check In Date</th>
					@if($type == 'Cancellation')
						<th>Cancellation Action</th>
					@endif
					<th></th>
				</tr>
			</thead>
			<tbody>
				@php $counter = 1; @endphp
				@forelse($bookings as $i=>$list)
					<tr>
						<td>{{$counter}}</td>
						<td><a href="{{url('business/'.@$business_id.'/customers/'.$list->customer_id)}}" class="fw-medium">{{$list->customer->full_name}}</a></td>
						<td>{{$list->UserBookingDetail->business_services->program_name}} - {{$list->UserBookingDetail->business_price_detail->price_title}}</td>
						<td>{{date('m-d-Y', strtotime($list->checkin_date))}}</td>
						@if($type == 'Cancellation')
							<td>{{$list->cancel_term()}} @if($list->no_show_action == 'charge_fee') "Charge Fee :".$list->no_show_charged @endif</td>
						@endif
						<td>
							<a href="{{url('business/'.@$business_id.'/customers/'.$list->customer_id)}}"> View </a>
						</td>
					</tr>
					 @php $counter++; @endphp
				@empty
					<tr> <td colspan="6">No Memberships To Display </td> </tr>
				@endforelse
			</tbody>
		</table>
	</div>
</div>