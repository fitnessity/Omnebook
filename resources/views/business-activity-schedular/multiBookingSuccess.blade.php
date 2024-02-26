<div class="row">
	<div class="col-md-12"> 
		<h4 class="mb-10 lh-25 text-center"> Booking Confirmed</h4> 
	</div>
	<div class="col-md-12 text-center">
       <p class="pay-confirm fs-17 font-green">
       		@forelse($data as $i=>$d)
       		  {{$i+1}}. Your reservation for {{@$d->UserBookingDetail->business_services->program_name}} on {{date('m/d/Y', strtotime(@$d->checkin_date))}} at {{@$d->scheduler->activity_time()}} <br>
       		@empty
       		@endforelse
   		</p>
    </div>
</div>