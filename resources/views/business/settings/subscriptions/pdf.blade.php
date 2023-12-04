<!DOCTYPE html>
<html>
<head>
    <style>
	body {
	  padding: 0;
	  margin: 0;
	  font-family: "Catamaran", sans-serif;
	  font-size: 13px;
	}
	.container{
		max-width: 1140px;
		width: 100%;
		margin-right: auto;
		margin-left: auto;
	}
	.invoice-head{
		font-size: 16px;
		font-weight: bold;
		border-bottom: 1px solid #ededed;
	}
	.row {
		display: flex;
	}
	.fit-logo img{
		width: 200px;
	}
	.pt-30{
		padding-top:30px;
	}
	.pb-30{
		padding-bottom:30px;
	}	
    .text-right{
		text-align: right;
	}
	.invoice-header{
		line-height: 22px;
	}
	h6{
		font-size: 13px;
		font-weight: bold;
		margin-top: 0px;
		margin-bottom: 5px;
	}
	h5{
		font-size: 11px;
		font-weight: bold;
		margin-top: 0px;
		margin-bottom: 5px;
	}
	p{
		line-height: 7px;
	}
	.border-bottom{
		border-bottom: 1px dotted #000;
	}
	.border-top{
		border-top: 1px dotted #000;
	}
	table {
	  border-collapse: collapse;
	  width: 100%;
	}

	th{
	  text-align: left;
	  padding: 8px;
	  background: #f0f0f0;
	}
	td{
		text-align: left;
		padding: 10px;
	}
	.width-100{
		width: 100%;
	}
	.width-25{
		width: 24%;
		display: inline-block;
	}
	.line-break{
		line-break: auto;
	}
	.width-50{
		width: 48%;
		display: inline-block;
	}
	
	</style>
</head>
<body>
	<div class="container">
		<div class="invoice-head">
			<h4>Invoice Details</h4>
		</div>
	</div>
	<div class="container pt-30 pb-30 border-bottom">
		<div class="row">
			<div class="width-50">
				<div class="fit-logo">
					<img src="{{env('APP_URL')}}/images/fitnessity_logo1_black.png">
				</div>
			</div>
			<div class="width-50">				
				<div class="invoice-header text-right">
					<span>Email:</span>
					<span>contact@fitnessity.co</span>
				</div>
				
				<div class="invoice-header text-right">
					<span>Website:</span>
					<span>{{env('APP_URL')}}</span>
				</div>
			
			</div>
		</div>
	</div>
	
	<div class="container pt-30 pb-30 border-bottom">
		<div class="row">
			<div class="width-25">
				<h6>Invoice No</h6>
				<span class="line-break">{{$customerPlan->invoice_no}}</span>
			</div>
			<div class="width-25">
				<h6>Date</h6>
				<span>{{ \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $customerPlan->created_at)->format('d M, Y h:iA') }} </span>
			</div>
			<div class="width-25">
				<h6>Payment Status</h6>
				<span>{{$customerPlan->amount != 0 ? 'Paid' : 'N/A'}}</span>
			</div>
			<div class="width-25">
				<h6>Total Amount</h6>
				<span>${{$customerPlan->amount}}</span>
			</div>
		</div>
	</div>

	<div class="container pt-30 border-bottom">
		<div class="row">
			<div class="width-100">
				<h6>Billing Address</h6>
				<h5>{{$user->full_name}}</h5>
				<p>{{$user->getaddress()}}</p>
				<p>Phone: {{$user->phone_number}}</p>
			</div>
		</div>
	</div>
	
	<div class="container pt-30">
		<table class="w3-table w3-striped w3-bordered">
			<tr>
				<th>#</th>
				<th>Plan Details</th>
				<th>Starting Date</th>
				<th>Expiry Date</th>
				<th>Amount</th>
			</tr>

			<tr class="border-bottom">
				<td>01</td>
				<td>{{$customerPlan->plan->title}}</td>
				<td>{{date('m/d/Y', strtotime($customerPlan->starting_date))}}</td>
				<td>{{date('m/d/Y', strtotime($customerPlan->expire_date))}}</td>
				<td>${{$customerPlan->price}}</td>
			</tr>
			<tr>
				<td></td>
				<td></td>
				<td></td>
				<td>Sub Total</td>
				<td>${{$customerPlan->price}}</td>
			</tr>
			<tr>
				<td></td>
				<td></td>
				<td></td>
				<td>Discount</td>
				<td>- ${{$customerPlan->discount}}</td>
			</tr>
			<tr>
				<td></td>
				<td></td>
				<td></td>
				<td class="border-top"><h6>Total Amount</h6></td>
				<td class="border-top"><h6>${{$customerPlan->amount}}</h6></td>
			</tr>
		</table>
	</div>

	<div class="container pt-30"> 
		<div class="row">
			<div class="width-100">
				<h6>Payment Details:</h6>
				<p>Payment Method: {{$method}}</p>
				<p>Card Holder: {{$user->full_name}}</p>
				<p>Card Number: {{ $card != '' ? 'xxxx xxxx xxxx'.$card : "N/A" }} </p>
				<p>Total Amount: ${{$customerPlan->amount}}</p>
			</div>
		</div>
	</div>
	
</body>
</html>