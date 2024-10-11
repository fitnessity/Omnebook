<h4 class="text-center font-red"> Booking Summary</h4>
<div class="modal-body">
	<div class="summery-recodes">
		<div class="border-bottom-grey mb-10 mt-10">
			<div class="row">
				<div class="col-md-5 col-6">
					<label>Category:</label>
				</div>
				<div class="col-md-7 col-6">
					<span class="float-right">{{@$category->category_title}}</span>
				</div>
			</div>
		</div>
	    <div class="border-bottom-grey mb-10 mt-10">
			<div class="row">
				<div class="col-md-5 col-6">
					<label>Duration:</label>
				</div>
				<div class="col-md-7 col-6">
					<span class="float-right">@if($scheduler != '') {{@$scheduler->activity_time()}} / {{@$scheduler->get_clean_duration()}} @else "—" @endif</span>
				</div>
			</div>
		</div>
		<div class="border-bottom-grey mb-10 mt-10">
			<div class="row">
				<div class="col-md-5 col-6">
					<label>Price Title:</label>
				</div>
				<div class="col-md-7 col-6">
					<span class="float-right">{{@$price->price_title}}</span>
				</div>
			</div>
		</div>
		<div class="border-bottom-grey mb-10 mt-10">
			<div class="row">
				<div class="col-md-5 col-6">
					<label>Price Option:</label>
				</div>
				<div class="col-md-7 col-6">
					<span class="float-right">{{@$price->pay_session}} session</span>
				</div>
			</div>
		</div>
		
		<div class="border-bottom-grey mb-10 mt-10">
			<div class="row">
				<div class="col-md-5 col-6">
					<label>Membership:</label>
				</div>
				<div class="col-md-7 col-6">
					<span class="float-right">{{@$price->membership_type}}</span>
				</div>
			
				<div class="col-md-5 col-6">
					<label># of Participants:</label>
				</div>
				<div class="col-md-7 col-6">
					<div class="personcategory booking-d-grid">
						<span>{{$adultCount}} x Adults  =  @if($adult_price != $adultDiscount ) <strike class="font-red"><span class="font-red">${{$adult_price}}</span></strike> @endif  ${{$adultDiscount}}</span>
					</div>
				</div>

				<div class="col-md-12">
					<div class="personcategory booking-d-grid">
						<!-- <span>{{$adultCount}} x Adults  =  @if($adult_price != $adultDiscount ) <strike class="font-red"><span class="font-red">${{$adult_price}}</span></strike> @endif  ${{$adultDiscount}}</span> -->
						<span>{{$childCount}} x Kids =  @if($child_price != $childDiscount )  <strike class="font-red"><span class="font-red"> ${{$child_price}}</span></strike> @endif  ${{$childDiscount}} </span>
						<span>{{$infantCount}} x Infants  =  @if($infant_price != $infantDiscount )  <strike class="font-red"><span class="font-red"> ${{$infant_price}}</span></strike> @endif ${{$infantDiscount}} </span>
					</div>
				</div>
			</div>
		</div>
		<div class="border-bottom-grey mb-10 mt-10">
			<div class="row">
				<div class="col-md-5 col-6">
					<label>Who's participating:</label>
				</div>
				<div class="col-md-7 col-6">
					{{-- <span class="float-right">{{$participants->fname.$participants->lname}}</span> --}}
					@foreach ($participants as $index => $participant)
					<div class="d-grid">
						<span class="float-right">
							{{ $participant->fname . ' ' . $participant->lname }}
						</span>
					</div>
					
				@endforeach
				
				</div>
			</div>
		</div>
		<div class="border-bottom-grey mb-10 mt-10">
			<div class="row">
				<div class="col-md-5 col-6">
					<label>Add On Service:</label>
				</div>
				<div class="col-md-7 col-6">
					<span class="float-right">{!! getAddonService($aosId,$aosQty) !!}</span>
				</div>
			</div>
		</div>
		<div class="border-bottom-grey mb-10 mt-10">
			<div class="row">
				<div class="col-md-5 col-6">
					<label>Instructure:</label>
					<div class="d-none hiddenALinkforIns"></div>
				</div>

				<div class="col-md-7 col-6">
					<span class="float-right">
						@if(!empty($scheduler->getInsdata())) 
							@foreach($scheduler->getInsdata() as $key => $ins) 
								{{$ins->full_name}} 
								@if($key < count($scheduler->getInsdata()) - 1) 
									,
								@endif
							@endforeach

							<a class="font-red" onclick="getInsModal('{{$scheduler->id}}')">View Instructure</a></span>
						@else
							"N/A" 
						@endif 
					
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12">
				<div class="cartstotal font-bold text-right"> 
					<label class="font-bold">Total </label> 
					<span id="totalprice">${{$total}} USD</span> 
				</div>
			</div>
		</div>
	</div>
</div>





