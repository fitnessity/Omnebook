@forelse($plans as $p)
<tr>
	<td><p class="mb-0">{{date('m/d/Y',strtotime($p->starting_date))}}</p></td>
	<td><p class="mb-0">{{$p->invoice_no}}</p></td>
	<td><p class="mb-0">$ {{$p->amount}}</p></td>
	<td><i class="fas fa-download"></i></td>
</tr>
@empty
	<tr><td colspan="4" class="text-center">No Data Found</td></tr>
@endforelse