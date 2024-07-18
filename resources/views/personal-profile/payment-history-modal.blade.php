<div class="row contentPop"> 
<div class="purchase-history">
	<div class="table-responsive">
		<table class="table mb-0">
			<thead>
				<tr>
					<th>Sale Date </th>
					<th>Item Description </th>
					<th>Item Type</th>
					<th>Pay Method</th>
					<th>Price</th>
					<th>Qty</th>
					<th>Refund/Void</th>
					<th>Receipt</th>
				</tr>
			</thead>
			<tbody>
				@foreach ($purchase_history as $history)
					@if($history->item_description()['itemDescription'] != '')
					<tr>
						<td>{{date('m/d/Y',strtotime($history->created_at))}}</td>
						<td>{!!$history->item_description()['itemDescription']!!}</td>
						<td>{{$history->item_type_terms()}}</td>
						<td>{{$history->getPmtMethod()}}</td>
						<td>${{$history->amount}}</td>
						<td>{{$history->item_description()['qty']}}</td>
						<td>Refund | Void</td>
						<td><a  class="mailRecipt" data-behavior="send_receipt" data-url="{{route('receiptmodel',['orderId'=>$history->item_id,'customer'=>$id])}}" data-item-type="{{$history->item_type_terms()}}" data-modal-width="900px" ><i class="far fa-file-alt" aria-hidden="true"></i></a>
						</td>
					</tr>
					@endif
				@endforeach
			</tbody>
		</table>
	</div>
</div>
</div>