<div class="col-md-12 col-sm-12 col-xs-12 border-bottom mt-10">
	<div class="row">
		<div class="col-md-10 col-sm-18 col-xs-6 col-6">
			<div class="counter-titles mb-15">
				<p class="fs-15">{{$product->name}} (This product is for @if($product->product_type == "both" ) both rent and sale. @elseif($product->product_type == "sale") sale. @else rent @endif) <span class="font-red">@if($reminingQty == 0) Sold Out @elseif($reminingQty <= $lowAlertQty ) Only {{$reminingQty}} remining.@endif </span></p>
			</div>
		</div>
		@php $pType= ''; $pPrice= 0;
			$pType = ($product->product_type == 'both') ? 'sale' : $product->product_type;
			$pType = $sptype ?? $pType;

			$pPrice = ($product->product_type == 'both' || $product->product_type == 'sale')  ? $product->sale_price : $product->rental_price;

		@endphp
		<div class="col-md-2 col-sm-2 col-xs-6 col-6">
			<div class="qty counter-txt mb-15">
				<span class="minus bg-darkbtn prominus" aid="{{$product->id}}" chk="{{$chk}}" remining="{{$reminingQty}}"><i class="fa fa-minus"></i></span>
				<input type="text" class="count" id="product_{{$product->id}}" min="0" value="{{$qty}}" readonly="" apirce="{{$pPrice}}" ptype="{{$pType}}" pname = "{{$product->name}}">
				<span class="plus bg-darkbtn proplus" aid="{{$product->id}}" chk="{{$chk}}" remining="{{$reminingQty}}"><i class="fa fa-plus"></i></span>
			</div>
		</div>
		<div class="col-lg-2 col-md-3 col-3">
			<div class="mb-15">
				<img src="{{$product->getPic()}}" class="rounded avatar-md shadow">
			</div>
		</div>
		<div class="col-lg-10 col-md-9 col-9">
			<div class="mb-15" id="product-description">
				<label>Description</label>
				<div class="d-text show-more-height">{!! $product->description !!}</div>
				  <div class="show-more">Show More</div>
			</div>
			<div class="row">
				@if($product->size)
				<div class="col-lg-4 col-md-6 col-sm-4 col-xs-6 col-6">
					<div class="select0service mb-10">
						<label>Select Size </label>
						<select id="size{{$product->id}}" class="form-select sizeList" chk="{{$chk}}">
							@foreach($productSize as $size)
								@if(str_contains($product->size, $size->id))
	                            	<option value="{{$size->id}}" @if(@$psize == $size->id) selected @endif>{{$size->name}}</option>
	                            @endif
	                        @endforeach
						</select>
					</div>
				</div>
				@endif

				@if($product->color)
				<div class="col-lg-4 col-md-6 col-sm-4 col-xs-6 col-6">
					<div class="select0service mb-10">
						<label>Select Color {{$pcolor}}</label>
						<select id="color{{$product->id}}" class="form-select colorList" chk="{{$chk}}">
							@foreach($productColor as $color)
								@if(str_contains($product->color, $color->id))
	                            	<option value="{{$color->id}}" @if(@$pcolor == $color->id) selected @endif>{{$color->name}}</option>
	                            @endif
	                        @endforeach
						</select>
					</div>
				</div>
				@endif
			</div>
			@if($product->product_type == 'both')
			<div class="row">
				<div class="col-md-12">
					<input type="radio" id="sale" name="product_type{{$product->id}}" value="sale" aid="{{$product->id}}" price="{{$product->sale_price}}" @if($pType== 'sale' ) checked @endif chk="{{$chk}}" >
					<label class="mr-15" for="sale">Sale Product</label>
					<input type="radio" id="rent" name="product_type{{$product->id}}" value="rent" aid="{{$product->id}}" price="{{$product->rental_price}}" chk="{{$chk}}" @if($pType== 'rent' ) checked @endif>
					<label class="mr-15" for="rent">Rent Product</label>
				</div>
			</div>
			@endif
		</div>
	</div>
</div>
	
<script>
	$(document).ready(function() {
	    $(document).on('change', 'input[type=radio][name=product_type{{$product->id}}]', function() {
	    	let id = $(this).attr('aid');
			let chk= $(this).attr('chk');
			$('#product_'+id).attr('ptype' , this.value);
			$('#product_'+id).attr('apirce' , $(this).attr('price'));
			setProductTotal(chk);
		});
	});

	$(".show-more").click(function () {
        if($(".d-text").hasClass("show-more-height")) {
            $(this).text("Show Less");
        } else {
            $(this).text("Show More");
        }
        $(".d-text").toggleClass("show-more-height");
    });

    $('#product_{{$product->id}}').prop('readonly', true);


    $('#color{{$product->id}}').change(function(e){
    	let chk= $(this).attr('chk');
    	setProductTotal(chk);
    });

    $('#size{{$product->id}}').change(function(e){
    	let chk= $(this).attr('chk');
    	setProductTotal(chk);
    });

</script>