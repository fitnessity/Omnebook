<div class="membership-expirations-table">
	<div class="table-responsive">
		<table class="table mb-0">
			<thead>
				<tr>
					<th>No</th>
					<th>Purchase Date</th>
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
					<tr>
						<td>{{$counter}}</td>
						<td>{{date('m-d-Y', strtotime($list->created_at))}}</td>
						<td><a href="{{url('business/'.@$business_id.'/customers/'.@$list->getCustomer($business_id)->id)}}" class="fw-medium" target="_blank">{{@$list->getCustomer($business_id)->full_name}}</a> </td>
						<td>{!! @$list->item_description($business_id)['itemDescription'] !!}</td>
						<td>{{$list->getPmtMethod()}}</td>
						<td>$ {{$list->amount}}</td>
						<td class="font-red"> {{ ($list->status == 'requires_capture') ? 'Payment Need to Capture' : $list->status}}</td>
						<td>
							<a href="{{url('business/'.@$business_id.'/customers/'.@$list->getCustomer($business_id)->id)}}"> View </a>
						</td>
					</tr>
					@php $counter++; @endphp
				@empty
					<tr> <td colspan="8">No Money Owed Details To Display </td> </tr>
				@endforelse
			</tbody>
		</table>
	</div>
</div>