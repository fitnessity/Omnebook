
<tr>
    <td>{{date('m-d-Y',strtotime($dt->created_at))}}</td>
    <td> {{@$dt->Customer->full_name ?? 'N/A'}}</td>
    <td>{!!$dt->item_description($business_id)['itemDescription']!!}</td>
    <td>{!! @$dt->item_description($business_id)['location'] !!}</td>
    <td>{!!$dt->item_description($business_id)['notes']!!}</td>
    <td>{!!$dt->item_description($business_id)['itemPrice']!!}</td>
    <td>{!!$dt->item_description($business_id)['qty']!!}</td>
    <td>{!!$dt->item_description($business_id)['itemPrice']!!}</td>
    <td>{!!$dt->item_description($business_id)['itemDis']!!}</td>
    <td>{!!$dt->item_description($business_id)['itemTax']!!}</td>
    <td>{!!$dt->item_description($business_id)['itemSubTotal']!!}</td>
    <td>{!!$dt->item_description($business_id)['itemSubTotal']!!}</td>
</tr>
 
    