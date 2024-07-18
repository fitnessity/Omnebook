@foreach($cardInfo as $card) 
    @php $brandname = strtolower($card['brand']); @endphp
    <div class="col-md-6">
        <label class="pay-card" style="color:#ffffff; background-image: url(/public/img/visa-card-bg.jpg );">
            <input name="cardinfo" class="payment-radio" type="radio" value="{{$card['payment_id']}}">
            <span class="plan-details">
                <div class="row">
					<div class="col-lg-12">
                        <a data-behavior="delete_card" data-url="{{route('cardDelete', ['stripe_payment_method' => $card['payment_id']])}}" data-cardid="{{$card['id']}}" title="Delete Card" class="text-right float-end card-remove"><i class="fa fa-trash"></i> </a>
					</div>
                    <div class="col-md-12">
                        <div class="cart-name">
                            <span>{{$brandname}}</span>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="cart-num">
                            <span>XXXX XXXX XXXX {{$card['last4']}}</span>
                        </div>
                    </div>									
                </div>
            </span>
        </label>
    </div>
@endforeach