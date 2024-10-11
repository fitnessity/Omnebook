<!DOCTYPE html>
<html>
<head>
    <style>
	body {
	  padding: 0;
	  margin: 0;
	  font-family: "Catamaran", sans-serif;
	  font-size: 16px;
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
	.col-md-12 {
		width: 100%;
		float: left;
		position: relative;
		min-height: 1px;
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
	.col-md-6 {
		width: 50%;
		float: left;
		position: relative;
		min-height: 1px;
	}
	.col-md-3 {
		width: 25%;
		float: left;
		position: relative;
		min-height: 1px;
	}
    .text-right{
		text-align: right;
	}
	.invoice-header{
		line-height: 22px;
	}
	h6{
		font-size: 16px;
		font-weight: bold;
		margin-top: 0px;
		margin-bottom: 5px;
	}
	h5{
		font-size: 14px;
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
	</style>
</head>
<body>
	<div class="container">
		<div class="invoice-head">
			<h4>Invoice Details</h4>
		</div>
	</div>
	<div class="container pt-30 pb-30  border-bottom">
		<div class="row">
			<div class="col-md-6">
				<div class="fit-logo">
					<img src="http://dev.fitnessity.co//public/images/fitnessity_logo1_black.png">
				</div>
				<!--<div class="pt-30">
					<h6>Address</h6>
					<p>California, United States</p>
					<p>Zip-code: 90201</p>
				</div> -->
			</div>
			<div class="col-md-6">				
				<div class="invoice-header text-right">
					<span>Email:</span>
					<span>contact@fitnessity.co </span>
				</div>
				
				<div class="invoice-header text-right">
					<span>Website:</span>
					<span>http://dev.fitnessity.co </span>
				</div>
				
				<div class="invoice-header text-right">
					<span>Contact No:</span>
					<span>+(01) 234 6789</span>
				</div>
				
			</div>
		</div>
	</div>
	
	<div class="container pt-30 pb-30 border-bottom">
		<div class="row">
			<div class="col-md-3">
				<h6>Invoice No</h6>
				<span>#VL25000355</span>
			</div>
			<div class="col-md-3">
				<h6>Date</h6>
				<span>23 Nov, 2021 02:36PM</span>
			</div>
			<div class="col-md-3">
				<h6>Payment Status</h6>
				<span>Paid</span>
			</div>
			<div class="col-md-3">
				<h6>Total Amount</h6>
				<span>$755.96</span>
			</div>
		</div>
	</div>

	<div class="container pt-30 border-bottom">
		<div class="row">
			<div class="col-md-3">
				<h6>Billing Address</h6>
				<h5>David Nichols</h5>
				<p>305 S San Gabriel Blvd</p>
				<p>Phone: +(123) 456-7890</p>
				<p>Tax: 12-3456789 </p>
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
			<tr>
				<td>01</td>
				<td>Basic</td>
				<td>5/10/2023</td>
				<td>9/10/2023</td>
				<td>$239.98</td>
			</tr>
			<tr class="border-bottom">
				<td>02</td>
				<td>Standard</td>
				<td>5/12/2023</td>
				<td>9/12/2023</td>
				<td>$239.98</td>
			</tr>
			<tr>
				<td></td>
				<td></td>
				<td></td>
				<td>Sub Total</td>
				<td>$699.96</td>
			</tr>
			<tr>
				<td></td>
				<td></td>
				<td></td>
				<td>Discount</td>
				<td>- $53.99</td>
			</tr>
			<tr>
				<td></td>
				<td></td>
				<td></td>
				<td class="border-top"><h6>Total Amount</h6></td>
				<td class="border-top"><h6>$755.96</h6></td>
			</tr>
		</table>
	</div>

	<div class="container pt-30"> 
		<div class="row">
			<div class="col-md-3">
				<h6>Payment Details:</h6>
				<p>Payment Method: Mastercard</p>
				<p>Card Holder: David Nichols</p>
				<p>Card Number: xxx xxxx xxxx 1234</p>
				<p>Total Amount: $ 755.96</p>
			</div>
		</div>
	</div>
	
</body>
</html>