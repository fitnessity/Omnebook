<h4 class="text-center font-red mb-10">Instructor Data</h4>
{{-- <div class="row y-middle mb-10 border-bottom-grey">
	@forelse($scheduler->getInsdata() as $ins)
		<div class="col-md-2 col-xs-3 mb-10">
			<div class="">
				@if($ins->profile_pic_url)
				<img src="{{$ins->profile_pic_url}}" class="instructor-img-cart" alt="Fitnessity">
				@else
					<div class="mini-stats-wid ">
						<div class="instructor-img-cart mr-15">
							<div class="mini-stat-icon avatar-title rounded-circle text-success bg-soft-red fs-4 uppercase">
								<span> ap </span>
							</div>
						</div>
					</div>
				@endif
			</div>
		</div>
		<div class="col-md-10 col-xs-9 mb-10">
			<div class="instructor-inner-details">
				<span class="fs-14">{{@$ins->full_name}}</span>
			</div>
			<div><p class="fs-14">{{@$ins->bio}}</p></div>
		</div>
	@empty
	@endforelse
</div> --}}

{{-- <div class="row">
	<div class="col-lg-12">
		<div class="text-center host-photo">
			<!-- <center>
				<div class="instructor-img-cart-modal mb-15">
					<div class="mini-stat-icon-modal avatar-title rounded-circle text-success bg-soft-red fs-4 uppercase">
						<span> ap </span>
					</div>
				</div>
			</center> -->
			<img alt="avatar" width="200" height="200" src="https://fitnessity-production.s3.amazonaws.com/company/hF0n8CXQgiTjRiY7lFBtGV0JyHgObkLnHN7o6luY.jpg" class="mb-15 object-fit object-position">  
	   		<p class="fs-18">Nipas Soni</p>   
			<p>Experience: 5 Years</p>
		</div>
		<div class="row">
			<div class="col-lg-6">
				<label>Country Born: <span>USA</span></label>
			</div>
			<div class="col-lg-6 text-right">
				<label>Currently Live: <span>USA</span></label>
			</div>
		</div>
		</div>
		<div class="text-center mb-15 mt-15">
			Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.
		</div>
	</div>
</div> --}}


<div class="row">
	@forelse($scheduler->getInsdata() as $ins)
	<div class="col-lg-12">
		<div class="text-center host-photo">
			<!-- <center>
				<div class="instructor-img-cart-modal mb-15">
					<div class="mini-stat-icon-modal avatar-title rounded-circle text-success bg-soft-red fs-4 uppercase">
						<span> ap </span>
					</div>
				</div>
			</center> -->
			{{-- <img alt="avatar" width="200" height="200" src="https://fitnessity-production.s3.amazonaws.com/company/hF0n8CXQgiTjRiY7lFBtGV0JyHgObkLnHN7o6luY.jpg" class="mb-15 object-fit object-position">   --}}
			<center>
			@if($ins->profile_pic_url)
			<img src="{{$ins->profile_pic_url}}"  class="mb-15 object-fit object-position" alt="Fitnessity" alt="avatar" width="200" height="200">
			@else
				<div class="instructor-img-cart-modal mb-15">
					<div class="mini-stat-icon-modal avatar-title rounded-circle text-success bg-soft-red fs-4 uppercase">
						<span> ap </span>
					</div>
				</div>
			@endif
			</center>
			<p class="fs-18">{{@$ins->full_name}}</p>   
			{{-- <p>Experience: 5 Years</p> --}}
		</div>
		<div class="row">
			<div class="col-lg-6">
				@if (!empty($ins->state))
				<label>State Born: <span>{{ $ins->state }}</span></label>
				@endif
			</div>
			<div class="col-lg-6 text-right">
				@if (!empty($ins->city))
				<label>Currently Live: <span>{{ $ins->city }}</span></label>
				@endif
			</div>			
		</div>
		</div>
		<div class="text-center mb-15 mt-15">
			{{@$ins->bio}}
		</div>
	</div>
	@empty
	@endforelse
</div>
