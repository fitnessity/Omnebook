@forelse($clients as $i=>$list)
	<tr>
		<td>{{$i+1}}</td>
		<td><a href="{{url('business/'.$business_id.'/customers/'.@$list->id)}}" class="fw-medium" target="_blank">  {{@$list->full_name}}  </a> </td>
		<td>{{@$list->member_id}}</td>
		<td>{{@$list->email}}</td>
		@if($type == 'mailing-list') 
			<td>{{@$list->full_address()}}</td>
		@endif
		<td>{{@$list->phone_number ?? 'N/A'}}</td>
		<td>{{@$list->customer_type}}</td>
	</tr>
@empty
@endforelse

xczxc