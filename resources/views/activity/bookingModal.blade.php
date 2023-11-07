<h4 class="text-center font-red"> Booking Summary</h4>
<div class="modal-body">
	<div class="summery-recodes">
    <div class="row">
		<div class="col-md-5">
			<label>Category:</label>
		</div>
		<div class="col-md-7">
			<span class="float-right">{{@$category->category_title}}</span>
		</div>
		<div class="col-md-5">
			<label>Duration:</label>
		</div>
		<div class="col-md-7">
			<span class="float-right">@if($scheduler != '') {{@$scheduler->activity_time()}} / {{@$scheduler->get_clean_duration()}} @else "—" @endif</span>
		</div>
		<div class="col-md-5">
			<label>Price Title:</label>
		</div>
		<div class="col-md-7">
			<span class="float-right">{{@$price->price_title}}</span>
		</div>
		<div class="col-md-5">
			<label>Price Option:</label>
		</div>
		<div class="col-md-7">
			<span class="float-right">{{@$price->pay_session}} session</span>
		</div>
		<div class="col-md-5">
			<label>Membership:</label>
		</div>
		<div class="col-md-7">
			<span class="float-right">{{@$price->membership_type}}</span>
		</div>
		<div class="col-md-12">
			<div class="personcategory booking-d-grid">
				<span>{{$adultCount}} x Adults  =  @if($adult_price != $adultDiscount ) <strike class="font-red"><span class="font-red">${{$adult_price}}</span></strike> @endif  ${{$adultDiscount}}</span>
				<span>{{$childCount}} x Kids =  @if($child_price != $childDiscount )  <strike class="font-red"><span class="font-red"> ${{$child_price}}</span></strike> @endif  ${{$childDiscount}} </span>
				<span>{{$infantCount}} x Infants  =  @if($infant_price != $infantDiscount )  <strike class="font-red"><span class="font-red"> ${{$infant_price}}</span></strike> @endif ${{$infantDiscount}} </span>
			</div>
		</div>
		<div class="col-md-5">
			<label>Add On Service:</label>
		</div>
		<div class="col-md-7">
			<span class="float-right">{!! getAddonService($aosId,$aosQty) !!}</span>
		</div>

		<div class="col-md-12">
			<div class="cartstotal mt-20 text-right"> 
				<label>Total </label> 
				<span id="totalprice">${{$total}} USD</span> 
			</div>
		</div>
	</div>
</div>
</div>