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
                @foreach($purchase_history as $history)
                    @if($history->item_description(request()->business_id)['itemDescription'] != '' )
                    <tr>
                        <td>@if($history->created_at) {{date('m/d/Y',strtotime($history->created_at))}} @else N/A @endif </td>
                        <td>{!!$history->item_description(request()->business_id)['itemDescription']!!}</td>
                        <td>{{$history->item_type_terms()}}</td>
                        <td>{{$history->getPmtMethod()}}</td>
                        <td>${{$history->amount}}</td>
                        <td>{{$history->item_description(request()->business_id)['qty']}}</td>
                        <td>
                            @if(($history->can_void() && $history->item_type=="UserBookingStatus") || ($history->can_refund()))
                                <a href="#" data-behavior="ajax_html_modal" data-url="{{route('void_or_refund_modal', ['business_id' => request()->business_id, 'id' => $customerdata->id,'booking_detail_id' => @$booking_detail->id , 'booking_id' => @$booking_detail->booking_id])}}" data-modal-width="modal-100">Void</a>
                            @else
                                {{$history->status}}
                            @endif
                        </td>
                        <td><a class="mailRecipt" data-behavior="send_receipt" data-url="{{route('receiptmodel',['orderId'=>$history->item_id,'customer'=>$customerdata->id])}}" data-item-type="{{$history->item_type_terms()}}" data-modal-width="modal-70" ><i class="far fa-file-alt" aria-hidden="true"></i></a>
                        </td>
                    </tr>
                    @endif
                @endforeach

                @foreach($familyPurchaseHistory as $familyName => $purchaseGroups)
                    @foreach($purchaseGroups as $purchases)
                        @foreach($purchases as $prehistory)		
                            @php
                            $history=App\Transaction::where('id',$prehistory['id'])->first();
                            $itemDescription = $history->item_description(request()->business_id);
                            @endphp
                            @if($itemDescription && isset($itemDescription['itemDescription']) && $itemDescription['itemDescription'] != '')
                                <tr>
                                    <td>@if($history->created_at) {{ date('m/d/Y', strtotime($history->created_at)) }} @else N/A @endif</td>
                                    <td>
                                        {!! $itemDescription['itemDescription'] !!}
                                        <small class="font-red">For: {{ $familyName }}</small>
                                    </td>
                                    <td>{{ $history->item_type_terms() }}</td>
                                    <td>{{ $history->getPmtMethod() }}</td>
                                    <td>${{ $history->amount }}</td>
                                    <td>{{ $itemDescription['qty'] }}</td>
                                    <td>
                                        @if(($history->can_void() && $history->item_type == "UserBookingStatus") || $history->can_refund())
                                            <a href="#" data-behavior="ajax_html_modal" 
                                            data-url="{{ route('void_or_refund_modal', ['business_id' => request()->business_id, 'id' => $customerdata->id, 'booking_detail_id' => @$booking_detail->id , 'booking_id' => @$booking_detail->booking_id]) }}" 
                                            data-modal-width="modal-100">Void</a>
                                        @else
                                            {{ $history->status }}
                                        @endif
                                    </td>
                                    <td>
                                        <a class="mailRecipt" data-behavior="send_receipt" 
                                        data-url="{{ route('receiptmodel', ['orderId' => $history->item_id, 'customer' => $customerdata->id]) }}" 
                                        data-item-type="{{ $history->item_type_terms() }}" 
                                        data-modal-width="modal-70">
                                            <i class="far fa-file-alt" aria-hidden="true"></i>
                                        </a>
                                    </td>
                                </tr>
                            @endif 
                        @endforeach
                    @endforeach
                @endforeach
            </tbody>
        </table>
    </div>
</div>