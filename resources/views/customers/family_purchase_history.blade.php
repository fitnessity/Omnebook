<?php
// Increase memory limit and execution time
ini_set('memory_limit', '2056M');
ini_set('max_execution_time', 4800);
ini_set('memory_limit', '-1');

// Initialize purchase history array
$familyPurchaseHistory = [];
$booking_detail = App\UserBookingDetail::where('business_id', $company['id'])
    ->where('user_id', '!=', $id)
    ->whereNotNull('user_id')
    ->whereNull('deleted_at')
    ->get();

// Loop through booking details to populate purchase history
foreach ($booking_detail as $booking) {
    if (!empty($booking->user_id)) {
        $familyMembers = App\Customer::where('business_id', $company['id'])->where('id', $booking->user_id)->first();
        if ($familyMembers) {
            $familyPurchases = $familyMembers->family_purchase_history($id)
                ->orderBy('created_at', 'desc')
                ->get();
            $familyPurchaseHistory[$familyMembers->fname . ' ' . $familyMembers->lname] = $familyPurchases;
        }
    }
}
?>

@if(!empty($familyPurchaseHistory))
    @foreach($familyPurchaseHistory as $familyName => $purchases)
        @foreach($purchases as $history)
            @if($history->item_description(request()->business_id)['itemDescription'] != '')
                <tr>
                    <td>{{$cnt}}</td>
                    <td>@if($history->created_at) {{ date('m/d/Y', strtotime($history->created_at)) }} @else N/A @endif</td>
                    <td>{!! $history->item_description(request()->business_id)['itemDescription'] !!}
                        <small class="font-red">For:{{ $familyName }}</small>
                    </td>
                    <td>{{ $history->item_type_terms() }}</td>
                    <td>{{ $history->getPmtMethod() }}</td>
                    <td>${{ $history->amount }}</td>
                    <td>{{ $history->item_description(request()->business_id)['qty'] }}</td>
                    <td>
                        @if(($history->can_void() && $history->item_type == "UserBookingStatus") || $history->can_refund())
                            @foreach($booking_detail as $booking)
                                <a href="#" data-behavior="ajax_html_modal" 
                                   data-url="{{ route('void_or_refund_modal', ['business_id' => request()->business_id, 'id' => $customerdata->id, 'booking_detail_id' => $booking->id , 'booking_id' => $booking->booking_id]) }}" 
                                   data-modal-width="modal-100">Void</a>
                            @endforeach
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
                @php $cnt++; @endphp
            @endif
        @endforeach
    @endforeach
@endif
