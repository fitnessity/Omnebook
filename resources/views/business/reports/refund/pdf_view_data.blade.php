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
		.mb-20{
			margin-bottom: 20px;
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
		.pdf-table table tr th{
			color: #fff;
			background-color: #ea1515;
		}

		table {
		  border-collapse: collapse;
		  width: 100%;
		}
        th, td {
          border: 1px solid #dddddd;
		  font-size: 12px;
		  padding: 5px;
        }
        .table-card{
			padding: 15px 0;
		}

		.table-card label{
			color: #ed1b24;
			font-size: 14px;
			font-weight: 700;
		}
	</style>
</head>
<body>

	<div class="reports-card-header">
		<h4>Booking Information</h4>
	</div>

	@forelse($bookings as $bs)
		<div class="mb-10">
			<div class="box-header y-middle">
				<div class="d-inline-block">
					<img src="{{$bs->getActivityPic()}}" alt="" class="rounded avatar-sm shadow mr-5"> 
				</div>
				<div class="mx-line d-inline-block ml-15">
					<label class="mr-10-title">Go Golfers</label>
					<label>Remaining: {{$bs->getremainingsession()}}/{{$bs->pay_session}} |</label>
					<label>Expiration:{{date('m/d/Y',strtotime($bs->expired_at))}}</label>
				</div>
			</div>
			<div class="box-body">
				<div class="pdf-table">
					<table>
						<tr>
							<th>CLIENT NAME</th>
							<th>PROGRAM NAME</th>
							<th>PRICE OPTION</th>
							<th>TOTAL PRICE</th>
							<th>REFUND AMOUNT</th>
							<th>REASON FOR REFUND</th>
							<th>REFUND TO</th>
						</tr>
						<tr>
							<td>{{@$bs->customer->full_name}}</td>
							<td>{{@$bs->business_services_with_trashed->program_name}}</td>
							<td>{{@$bs->business_price_detail_with_trashed->price_title}} - {{@$bs['pay_session']}} Sessions</td>
							<td>$ @if(@$bs->booking->getPaymentDetail() != 'Comp') {{ @$bs->subtotal}} @else 0 @endif </td>
							<td>$ {{@$bs->refund_amount}}</td>
							<td>{{@$bs->refund_reason ?? 'N/A'}}</td>
							<td>{{@$bs->customer->full_name}}</td>
						</tr>
					 </table>
				</div>
			</div>
		</div>
	@empty
		No Bookings Available
	@endforelse

</body>
</html>