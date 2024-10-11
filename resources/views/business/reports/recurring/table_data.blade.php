<div class="membership-expirations-table">
	<div class="table-responsive">
		<table class="table mb-0">
			<thead>
				<tr>
					<th>No</th>
					<th>Payment Date</th>
					<th>Name</th>
					<th>Membership Type</th>
					<th>Card Being charged</th>
					<th>Amount</th>
					<th>Status</th>
					<th></th>
				</tr>
			</thead>
			<tbody>
				@php $counter = 1; @endphp
				@forelse($data as $i=>$list) 
					@if($list->customer_name)
						<tr>
							<td>{{$counter}}</td>
							<td>{{date('m-d-Y', strtotime($list->payment_date))}}</td>
							<td><a href="{{url('business/'.@$business_id.'/customers/'.@$list->customer_id)}}" class="fw-medium" target="_blank">{{@$list->customer_name}}</a> </td>
							<td>{{@$list->membership_name}}</td>
							<td>{{@$list->card}}</td>
							<td>$ {{$list->total_amount}}</td>
							<td class="{{($list->status != 'Completed') ? 'font-red' : 'font-green' }}">{{$list->status == 'Retry' ? 'Failed': $list->status}}</td>
							<td>
								<a href="{{url('business/'.@$business_id.'/customers/'.@$list->customer_id)}}"> View </a>
							</td>
						</tr>
						@php $counter++; @endphp
					@endif
				@empty
					<tr> <td colspan="8">No Recurring Payment Details To Display </td> </tr>
				@endforelse
			</tbody>
		</table>
	</div>
</div>