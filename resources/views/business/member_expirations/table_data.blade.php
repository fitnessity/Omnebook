<div class="membership-expirations-table">
	<div class="table-responsive">
		<table class="table mb-0">
			<thead>
				<tr>
					<th>No</th>
					<th>Name</th>
					<th>Membership Type</th>
					<th>Started on</th>
					<th>End on</th>
					<th></th>
				</tr>
			</thead>
			<tbody>
				@php $y=0; @endphp
				@forelse($expiringMembership as $i=>$list)
					@if($list->Customer != '' && $list->business_price_detail != '')
					@php $y++; @endphp
					<tr>
						<td>{{$y}}</td>
						<td>{{$list->Customer->full_name}}</td>
						<td>{{@$list->business_price_detail->price_title}}</td>
						<td>{{date('m-d-Y', strtotime($list->contract_date))}}</td>
						<td>{{date('m-d-Y', strtotime($list->expired_at))}}</td>
						<td>
							<a href="{{route('personal.orders.index',['business_id'=>$list->business_id])}}"> View </a>
						</td>
					</tr>
					@endif
				@empty
					<tr> <td colspan="6"></td> </tr>
				@endforelse
			</tbody>
		</table>
	</div>
</div>