<div class="row">
    <div class="col-md-6 col-xs-6">
        <div class="text-left">
            <label>BOOKING#</label>
        </div>
    </div>
    <div class="col-md-6 col-xs-6">
        <div class="float-end text-right">
            <span>{{$odt['confirm_id']}}</span>
        </div>
    </div>

    <div class="col-md-6 col-xs-6">
        <div class="text-left">
            <label>PROVIDER COMPANY NAME:</label>
    </div>
    </div>
    <div class="col-md-6 col-xs-6">
        <div class="float-end text-right">
            <span>{{$odt['company_name']}}</span>
        </div>
    </div>

    <div class="col-md-6 col-xs-6">
        <div class="text-left">
            <label>PROGRAM NAME:</label>
        </div>
    </div>
    <div class="col-md-6 col-xs-6">
        <div class="float-end text-right">
            <span>{{$odt['program_name']}}</span>
        </div>
    </div>

    <div class="col-md-6 col-xs-6">
        <div class="text-left">
            <label>CATEGORY:</label>
        </div>
    </div>
    <div class="col-md-6 col-xs-6">
        <div class="float-end text-right">
            <span>{{$odt['categoty_name']}}</span>
        </div>
    </div>

    <div class="col-md-6 col-xs-6">
        <div class="text-left">
            <label>PRICE OPTION:</label>
        </div>
    </div>

    <div class="col-md-6 col-xs-6">
        <div class="float-end text-right">
            <span>@if(@$odt['BusinessPriceDetails']) {{@$odt['BusinessPriceDetails']['price_title']}} @else N/A @endif</span>
        </div>
    </div>

    <div class="col-md-6 col-xs-6">
        <div class="text-left">
            <label>NUMBER OF SESSIONS:</label>
        </div>
    </div>
    <div class="col-md-6 col-xs-6">
        <div class="float-end text-right">
            <span>{{@$odt['pay_session']}}</span>
        </div>
    </div>

    <div class="col-md-6 col-xs-6">
        <div class="text-left">
            <label>MEMBERSHIP OPTION:</label>
        </div>
    </div>
    <div class="col-md-6 col-xs-6">
        <div class="float-end text-right">
            <span>@if(@$odt['BusinessPriceDetails'])  {{@$odt['BusinessPriceDetails']['membership_type']}} @else N/A @endif</span>
        </div>
    </div>

    <div class="col-md-6 col-xs-6">
        <div class="text-left">
            <label>PARTICIPANT QUANTITY:</label>
        </div>
    </div>
    <div class="col-md-6 col-xs-6">
        <div class="float-end text-right">
            <span>{{$odt['qty'] != '' ? $odt['qty'] : "N/A"}}</span>
        </div>
    </div>

    <div class="col-md-6 col-xs-6">
        <div class="text-left">
            <label>WHO IS PRATICIPATING? / WHO'S PRODUCT  </label>
        </div>
    </div>
    <div class="col-md-6 col-xs-6">
        <div class="float-end text-right">
            <span>{{$odt['parti_data']}}</span>
        </div>
    </div>

    <div class="col-md-6 col-xs-6">
        <div class="text-left">
            <label>ACTIVITY TYPE:</label>
        </div>
    </div>
    <div class="col-md-6 col-xs-6">
        <div class="float-end text-right">
            <span>{{$odt['sport_activity']}}</span>
        </div>
    </div>

    <div class="col-md-6 col-xs-6">
        <div class="text-left">
            <label>SERVICE TYPE:</label>
        </div>
    </div>
    <div class="col-md-6 col-xs-6">
        <div class="float-end text-right">
            <span>{{$odt['select_service_type']}}</span>
        </div>
    </div>

    <div class="col-md-6 col-xs-6">
        <div class="text-left">
            <label>MEMBERSHIP DURATION:</label>
        </div>
    </div>
    <div class="col-md-6 col-xs-6">
        <div class="float-end text-right">
            <span>
            @if($order_detail->order_type == 'Membership') 
                {{ $order_detail->expired_duration}}
            @else
                N/A
            @endif</span>
        </div>
    </div>

    <div class="col-md-6 col-xs-6">
        <div class="text-left">
            <label>PURCHASE DATE:</label>
        </div>
    </div>
    <div class="col-md-6 col-xs-6">
        <div class="float-end text-right">
            <span>{{$odt['created_at']}}</span>
        </div>
    </div>

    <div class="col-md-6 col-xs-6">
        <div class="text-left">
            <label>MEMBERSHIP ACTIVATION DATE:</label>
        </div>
    </div>
    <div class="col-md-6 col-xs-6">
        <div class="float-end text-right">
            <span>
                @if($order_detail->order_type == 'Membership') 
                   {{date('d-m-Y',strtotime($order_detail->contract_date))}}
                @else
                    N/A
                @endif
            </span>
        </div>
    </div>

    <div class="col-md-6 col-xs-6">
        <div class="text-left">
            <label>MEMBERSHIP EXPIRATION:</label>
        </div>
    </div>
    <div class="col-md-6 col-xs-6">
        <div class="float-end text-right">
            <span>@if($order_detail->order_type == 'Membership') 
                   {{date('d-m-Y',strtotime($order_detail->expired_at))}}
                @else
                    N/A
                @endif
            </span>
        </div>
    </div>

    <div class="col-md-6 col-xs-6">
        <div class="text-left">
            <label>ADD ON SERVICE:</label>
        </div>
    </div>
    <div class="col-md-6 col-xs-6">
        <div class="float-end text-right">
            <span>{!! getAddonService(@$odt['addOnServicesId'],@$odt['addOnServicesQty']) !!}</span>
        </div>
    </div>

    <div class="col-md-6 col-xs-6">
        <div class="text-left">
            <label>PRODUCTS:</label>
        </div>
    </div>
    <div class="col-md-6 col-xs-6">
        <div class="float-end text-right">
            <span>{!! getProducts(@$odt['productIds'],@$odt['productQtys'],@$odt['productTypes']) !!}</span>
        </div>
    </div>

    <div class="col-md-6 col-xs-6">
        <div class="text-left">
            <label>PRICE:</label>
        </div>
    </div>
    <div class="col-md-6 col-xs-6">
        <div class="float-end text-right">
            <span>${{$odt['totprice_for_this']}}</span>
        </div>
    </div>

    <div class="col-md-6 col-xs-6">
        <div class="text-left">
            <label>DISCOUNT:</label>
        </div>
    </div>
    <div class="col-md-6 col-xs-6">
        <div class="float-end text-right">
            <span>${{$odt['discount']}}</span>
        </div>
    </div>

    <div class="col-md-6 col-xs-6">
        <div class="text-left">
            <label>TOTAL:</label>
        </div>
    </div>
    <div class="col-md-6 col-xs-6">
        <div class="float-end text-right">
            <span>${{$per_total}}</span>
        </div>
    </div>
</div>

<div class="col-md-12 col-sm-12 col-xs-12">
    <div class="main-separator mb-10"></div>
</div>