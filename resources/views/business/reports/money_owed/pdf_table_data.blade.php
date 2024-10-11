<div class="pdf-table">
	<table>
		<tr>
			<th>No</th>
			<th>Purchase Date</th>
			<th>Customer Name</th>
			<th>Membership Type</th>
			<th>Card Being charged</th>
			<th>Amount</th>
			<th>Status</th>
		</tr>
		@php $counter = 1; @endphp
		@forelse($data as $i=>$list) 
			<tr>
				<td>{{$counter}}</td>
				<td>{{date('m-d-Y', strtotime($list->created_at))}}</td>
				<td>{{@$list->getCustomer($business_id)->full_name}}</td>
				<td>{!! @$list->item_description($business_id)['itemDescription'] !!}</td>
				<td>{{$list->getPmtMethod()}}</td>
				<td>$ {{$list->amount}}</td>
				<td class="font-red"> {{ ($list->status == 'requires_capture') ? 'Payment Need to Capture' : $list->status}}</td>
			</tr>
			@php $counter++; @endphp
		@empty
			<tr> <td colspan="8">No Money Owed Details To Display </td> </tr>
		@endforelse
	 </table>
</div>