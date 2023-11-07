<div class="pdf-table">
	<table>
		<tr>
			<th>No</th>
			<th>Name</th>
			<th>Membership Type</th>
			<th>Started on</th>
			<th>Expires On</th>
		</tr>
		@php $counter = 1; @endphp
			@forelse($memberships as $i=>$list)
				<tr>
					<td>{{$counter}}</td>
					<td>{{@$list->Customer->full_name}}</td>
					<td>{{@$list->business_price_detail->price_title}}</td>
					<td>{{date('m-d-Y', strtotime($list->contract_date))}}</td>
					<td>{{date('m-d-Y', strtotime($list->expired_at))}}</td>
				</tr>
				 @php $counter++; @endphp
			@empty
				<tr> <td colspan="6"></td> </tr>
			@endforelse
	 </table>
</div>