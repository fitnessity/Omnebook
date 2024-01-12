<div class="pdf-table">
	<table>
		<tr>
			<th>No</th>
			<th>Name</th>
			<th>Membership Name</th>
			<th>Check In Date</th>
			@if($type == 'Cancellation')
				<th>Cancellation Action</th>
			@endif
		</tr>
		@php $counter = 1; @endphp
		@forelse($bookings as $i=>$list)
			<tr>
				<td>{{$counter}}</td>
				<td>{{$list->customer->full_name}}</td>
				<td>{{$list->UserBookingDetail->business_services->program_name}} - {{$list->UserBookingDetail->business_price_detail->price_title}}</td>
				<td>{{date('m-d-Y', strtotime($list->checkin_date))}}</td>
				@if($type == 'Cancellation')
					<td>{{$list->cancel_term()}} @if($list->no_show_action == 'charge_fee') "Charge Fee :".$list->no_show_charged @endif</td>
				@endif
			</tr>
			 @php $counter++; @endphp
		@empty
			<tr> <td colspan="@if($type == 'Cancellation') 5 @else 4 @endif">No Memberships To Display </td> </tr>
		@endforelse
	 </table>
</div>