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
		text-align: center;
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
	.pt-10{
		padding-top:0px;
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

	<div class="container">
		<div class="invoice-head">
			<h4>{{$title}}</h4>
		</div>
	</div>

	<div class="container pt-0">
		{!! $details !!}
	</div>

	
	
</body>
</html>