<!DOCTYPE html>
<html>
<head>
    <style>
		.reports-card-header{
			text-align: center;
			margin-bottom: 0px;
			font-size: 17px;
		}
		.box-header{
			background: rgba(237, 36, 45, 0.05);
			padding: 5px;
			border-radius: .25rem;
  			border: 1px solid #e2e3e4;
		}
		.avatar-sm{
			height: 3rem;
			width: 3rem;
			border-radius: 5px;
		}
		.d-inline-block{
			display: inline-block;
		}
		.y-middle {
			display: flex;
			flex-wrap: wrap;
			align-items: center;
		}
		.ml-15{
			margin-left: 15px;
		}

		.mb-10{
			margin-bottom: 10px;
		}
		.col-6{
			width: 55%;
			display: inline-block;
		}
		.col-5{
			width: 40%;
			display: inline-block;
		}
		.box-body{
			display: flex;
			padding: 5px;
			border: 1px solid #e2e3e4;
			border-top: none;
		}
		.text-right{
			text-align: right;
		}
		.body-data{
			margin-bottom: 5px;
		}
	</style>
</head>
<body>

	<div class="reports-card-header">
		<h4>Booking Information</h4>
	</div>

	@forelse($bookings as $b)
		<div class="mb-10">
			<div class="box-header y-middle">
				<div class="d-inline-block">
					<img src="{{$b->getActivityPic()}}" alt="" class="rounded avatar-sm shadow mr-5"> 
				</div>
				<div class="mx-line d-inline-block ml-15">
					<label class="mr-10-title">Go Golfers</label>
					<label>Remaining: {{$b->getremainingsession()}}/{{$b->pay_session}} |</label>
					<label>Expiration:{{date('m/d/Y',strtotime($b->expired_at))}}</label>
				</div>
			</div>
			<div class="box-body">
				<div class="col-5">
					<div class="body-data">
						<label>BOOKING CONFIRMATION # </label>
					</div>
					<div class="body-data">
						<label>TOTAL PRICE</label>
					</div>
					<div class="body-data">
						<label>PRICE OPTION</label>
					</div>
					<div class="body-data">
						<label>PAYMENT TYPE</label>
					</div>
					<div class="body-data">
						<label>TOTAL REMAINING</label>
					</div>
					<div class="body-data">
						<label>PROGRAM NAME</label>
					</div>
					<div class="body-data">
						<label>EXPIRATION DATE</label>
					</div>
					<div class="body-data">
						<label>DATE BOOKED</label>
					</div>
					<div class="body-data">
						<label>RESERVED DATE</label>
					</div>
					<div class="body-data">
						<label>BOOKED BY</label>
					</div>
					<div class="body-data">
						<label>ACTIVITY TYPE</label>
					</div>
					<div class="body-data">
						<label>SERVICE TYPE</label>
					</div>
					<div class="body-data">
						<label>ACTIVITY LOCATION</label>
					</div>
					<div class="body-data">
						<label>ACTIVITY DURATION</label>
					</div>
					<div class="body-data">
						<label>GREAT FOR</label>
					</div>
					<div class="body-data">
						<label>PARTICIPANTS</label>
					</div>
					<div class="body-data">
						<label>WHO IS PARTICIPATING?</label>
					</div>
					<div class="body-data">
						<label>ADD ON SERVICES</label>
					</div>
				</div>
				<div class="col-6">
					<div class="text-right body-data">
						<span>{{$b->booking->order_id}}</span>
					</div>
					<div class="text-right body-data">
						<span>$ {{$b->booking->getPaymentDetail() != 'Comp' ? $b->subtotal : 0}}</span>
					</div>
					<div class="text-right body-data">
						<span>{{$b->business_price_detail_with_trashed->price_title}} - {{$b->pay_session}} Sessions</span>
					</div>
					<div class="text-right body-data">
						<span>{{$b->pay_session}} Sessions</span>
					</div>
					<div class="text-right body-data">
						<span>{{$b->getremainingsession()}}/{{$b->pay_session}}</span>
					</div>
					<div class="text-right body-data">
						<span>{{ $b->business_services_with_trashed->program_name}}</span>
					</div>
					<div class="text-right body-data">
						<span>{{date('m/d/Y',strtotime($b->expired_at))}}</span>
					</div>
					<div class="text-right body-data">
						<span> {{date('m/d/Y',strtotime($b->created_at))}} </span>
					</div>
					<div class="text-right body-data">
						<span>{{ $b->getReserveData('reserve_date') }}</span>
					</div>
					<div class="text-right body-data">
						<span> {{$b->booking->full_name}}</span>
					</div>
					<div class="text-right body-data">
						<span> {{$b->business_services_with_trashed->sport_activity}} </span>
					</div>
					<div class="text-right body-data">
						<span>{{$b->business_services_with_trashed->select_service_type ?? "N/A" }}</span>
					</div>
					<div class="text-right body-data">
						<span>{{$b->business_services_with_trashed->activity_location}}</span>
					</div>
					<div class="text-right body-data">
						<span>{{$b->getReserveData('reserve_time')}}</span>
					</div>
					<div class="text-right body-data">
						<span> {{$b->business_services_with_trashed->activity_for}} </span>
					</div>
					<div class="text-right body-data">
						<span>{{ $b->getparticipate()}}</span>
					</div>
					<div class="text-right body-data">
						<span>{{$b->decodeparticipate()}}</span>
					</div>
					<div class="text-right body-data">
						<span> {{getAddonService($b->addOnservice_ids,$b->addOnservice_qty)}}</span>
					</div>
				</div>
			</div>
		</div>
	@empty
		No Bookings Available
	@endforelse

</body>
</html>