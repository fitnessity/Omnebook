<div class="membership-expirations-table">
	<div class="table-responsive">
		<table class="table mb-0">
			<thead>
				<tr>
					<th>No</th>
					<th>Name</th>
					<th>Expire Month</th>
					<th>Expire Year</th>
					<th></th>
				</tr>
			</thead>
			<tbody>
				@php $counter = 1; @endphp
				@forelse($cards as $i=>$list)
					<tr>
						<td>{{$counter}}</td>
						<td><a href="{{url('business/'.@$business_id.'/customers/'.@$list->user_id)}}" class="fw-medium" target="_blank">  {{@$list->Customer->full_name}}  </a> </td>
						<td>{{@$list->exp_month}}</td>
						<td>{{$list->exp_year}}</td>
						<td>
							<a href="{{url('business/'.@$business_id.'/customers/'.@$list->user_id)}}"> View </a>
						</td>
					</tr>
					 @php $counter++; @endphp
				@empty
					<tr> <td colspan="6"></td> </tr>
				@endforelse
			</tbody>
		</table>
	</div>
</div>