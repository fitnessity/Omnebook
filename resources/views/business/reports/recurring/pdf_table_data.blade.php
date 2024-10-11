<div class="pdf-table">
	<table>
		<tr>
			<th>No</th>
			<th>Name</th>
			<th>Membership Name</th>
			<th>Purchase Date</th>
			<th>Payment Date</th>
			<th>Status</th>
		</tr>
		@php $counter = 1; @endphp
		@forelse($data as $i=>$list) 
			@if($list->customer_name)
				<tr>
					<td>{{$counter}}</td>
					<td>{{@$list->customer_name}}</td>
					<td>{{@$list->membership_name}}</td>
					<td>{{date('m-d-Y', strtotime($list->UserBookingDetail->created_at))}}</td>
					<td>{{date('m-d-Y', strtotime($list->payment_date))}}</td>
					<td class="{{($list->status != 'Completed') ? 'font-red' : 'font-green' }}">{{$list->status == 'Retry' ? 'Failed': $list->status}}</td>
				</tr>
				@php $counter++; @endphp
			@endif
		@empty
			<tr> <td colspan="6" >No Recurring Payment Details To Display </td> </tr>
		@endforelse
	 </table>
</div>