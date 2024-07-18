<div class="membership-expirations-table">
	<div class="table-responsive">
		<table class="table mb-0">
			<thead>
				<tr>
					<th>No</th>
					<th>Name</th>
					<th>Membership Type</th>
					<th>Started on</th>
					<th>Expires On</th>
					<th></th>
				</tr>
			</thead>
			<tbody>
				@php $counter = 1; @endphp
				@forelse($memberships as $i=>$list)
					<tr>
						<td>{{$counter}}</td>
						<td><a href="{{url('business/'.@$list->business_price_detail->cid.'/customers/'.@$list->Customer->id)}}" class="fw-medium" target="_blank">  {{@$list->Customer->full_name}}  </a> </td>
						<td>{{@$list->business_price_detail->price_title}}</td>
						<td>{{date('m-d-Y', strtotime($list->contract_date))}}</td>
						<td>{{date('m-d-Y', strtotime($list->expired_at))}}</td>
						<td>
							<a href="{{url('business/'.@$list->business_price_detail->cid.'/customers/'.@$list->Customer->id)}}"> View </a>
						</td>
					</tr>
					 @php $counter++; @endphp
				@empty
					<tr> <td colspan="6">No Expiration Memberships To Display </td> </tr>
				@endforelse
			</tbody>
		</table>
	</div>
</div>