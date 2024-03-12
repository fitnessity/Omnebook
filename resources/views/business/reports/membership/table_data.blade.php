<div class="membership-expirations-table">
	<div class="table-responsive">
		<table class="table mb-0">
			<thead>
				<tr>
					<th>No</th>
					<th>Client</th>
					<th>Purchase Date</th>
					<th>Expiration date</th>
					<th>Purchase Amount</th>
					<th>Status</th>
					@if(@$type)<th>Last Attended</th>@endif
					<th></th>
				</tr>
			</thead>
			<tbody>
				@php $counter = 1; @endphp
				@forelse($bookDetails as $i=>$list) 
					@php
						if($list->expired_at < date('Y-m-d') && @$type == 'notUsed' && $list->status == 'active'){
							$list->status = 'completed';
						}
					@endphp
					<tr>
						<td>{{$counter}}</td>
						<td><a href="{{url('business/'.@$business_id.'/customers/'.@$list->Customer->id)}}" class="fw-medium" target="_blank">{{@$list->Customer->full_name}}</a> </td>
						<td>{{date('m/d/Y', strtotime($list->contract_date))}}</td>
						<td>{{date('m/d/Y', strtotime($list->expired_at))}}</td>
						<td>$ {{$list->subtotal}}</td>
						<td class="{{($list->status == 'active') ? 'font-green' : 'font-red'}}"> {{$list->status}}</td>
						@if(@$type)<td>{{$list->last_attended}}</td>@endif
						<td>
							<a href="{{url('business/'.@$business_id.'/customers/'.@$list->Customer->id)}}"> View </a>
						</td>
					</tr>
					@php $counter++; @endphp
				@empty
					<tr> <td colspan="8">No Bookings To Display </td> </tr>
				@endforelse
			</tbody>
		</table>
	</div>
</div>