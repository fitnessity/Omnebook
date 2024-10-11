<?php 
	$html = $data = '';$remaining = 0;$firstDataProcessed = false; 
    $customer = App\Customer::where('business_id', request()->business_id)->find($cid);
    $active_memberships = $customer->active_memberships()->where('user_booking_details.user_id',request()->cid)->get();

    foreach($active_memberships as $active_membership){
        $remainingSession = $active_membership->getremainingsession();
        $priceDetail = $active_membership->business_price_detail;

        $chkSession = count(array_filter($finalSessionAry, function($item,$key) use ($priceDetail,$i) {
            return $item['priceId'] == @$priceDetail->id && $i != $key;
        }, ARRAY_FILTER_USE_BOTH));

        $remainingSession = $remainingSession - max($chkSession,0);
        if($remainingSession > 0 && $priceDetail){
            $html .= '<option value="'.$priceDetail->id.'" data-did ="'.$active_membership->id.'">'.$priceDetail->price_title.'</option>';
        }
    }

    if($html != ''){
        $data .='<option value="" data-did ="0">Choose Membership</option>';
        $data .= $html;
    }

    echo $data;
?>