{{-- @foreach($reviews as $review)
<div class="border-bottom-grey mb-15">
	<div class="row y-middle mb-15">
		<div class="col-lg-1 col-md-2 col-sm-2 col-3">
			<div class="review-text mb-10">
          		<p class="review-character">{{$review->User->first_letter}}</p>
			</div>
		</div>
		<div class="col-lg-11">
			<div class="review-sendername">
				<label>{{$review->User->full_name}}</label>
				<p>{{$review->User->country}}</p>
			</div>
		</div>
		<div class="col-lg-12">
			<div class="mt-15 inner-review-star">
				<div class="display-inline-b">
					@if($review->all_over_review > 0)
						@for($i = 1; $i < $review->all_over_review;$i++)
							<i class="fa fa-star text-black" aria-hidden="true"></i>
						@endfor
					@endif
				</div>
				<div class="display-inline-b"><i class="fas fa-circle dot-fs"></i></div>
				<div class="display-inline-b">
					<label>{{$review->date}}</label>
				</div>
			</div>
			<div class="mb-15">
				{{$review->message}}
			</div>
			@if($review->images)
				<div class="review-modal-imgs">
					@foreach(explode(',' ,$review->images) as $img)
					@if(!empty($img) && Storage::exists($img))
					<img src="{{Storage::URL($img)}}" alt="images">
					@endif
					@endforeach
				</div>
			@endif
		</div>
	</div>
</div>
@endforeach --}}
@foreach($reviews as $review)
<div class="border-bottom-grey mb-15">
	<div class="row y-middle mb-15">
		<div class="col-lg-1 col-md-2 col-sm-2 col-3">
			<div class="review-text mb-10">
				@if(is_object($review->User) && property_exists($review->User, 'first_letter'))
					<p class="review-character">{{$review->User->first_letter}}</p>
				@else
					<p class="review-character">N/A</p>
				@endif
			</div>
		</div>
		<div class="col-lg-11">
			<div class="review-sendername">
				@if(is_object($review->User))
					<label>{{$review->User->full_name}}</label>
					<p>{{$review->User->country}}</p>
				@else
					<label>Anonymous</label>
					<p>N/A</p>
				@endif
			</div>
		</div>
		<div class="col-lg-12">
			<div class="mt-15 inner-review-star">
				<div class="display-inline-b">
					@if($review->all_over_review > 0)
						@for($i = 1; $i < $review->all_over_review; $i++)
							<i class="fa fa-star text-black" aria-hidden="true"></i>
						@endfor
					@endif
				</div>
				<div class="display-inline-b"><i class="fas fa-circle dot-fs"></i></div>
				<div class="display-inline-b">
					<label>{{$review->date}}</label>
				</div>
			</div>
			<div class="mb-15">
				{{$review->message}}
			</div>
			@if($review->images)
				<div class="review-modal-imgs">
					@foreach(explode(',', $review->images) as $img)
						@if(!empty($img) && Storage::exists($img))
							<img src="{{ Storage::URL($img) }}" alt="images">
						@endif
					@endforeach
				</div>
			@endif
		</div>
	</div>
</div>
@endforeach
