<div class="row"> 
	<div class="col-lg-12">
	   <h4 class="modal-title" style="text-align: center; color: #000; line-height: inherit; font-weight: 600; margin-top: 9px; margin-bottom: 12px;">Autopay Schedule & History</h4>
	</div>
</div>
<div class="row">
	<div class="col-md-12">
		<div>
			<label>Auopay Schedule For:</label>
			<span>{{$customer->fname}} {{$customer->lname}} </span>
		</div>
	</div>
	<div class="col-md-5">
		<div>
			<label>Contract Details:</label>
			<span>{{$booking_detail->business_price_detail_with_trashed->business_price_details_ages_with_trashed->category_title}} , {{$booking_detail->business_price_detail_with_trashed->price_title}}</span>
		</div>
	</div>
	<div class="col-md-7">
		<div class="auto-details-location">
			<label>Location:</label>
			<span>{{$booking_detail->company_information->company_name}}</span>
			
			<label> Autopay Remaining</label>
			<span>{{$remaining}}/{{count($autopaylist)}} </span>
			
			<label>Autopay History</label>
			<a> View </a>
		</div>
	</div>
	<div class="col-md-12">
		<table id="pay-details" class="table table-striped table-bordered" style="width:100%">
			<thead>
				<tr>
					<th> Payment  Date </th>
					<th> Amount </th>
					<th> Tax </th>
					<th>Charged Amount </th>
					<th>Payment Method </th>
					<th> Status </th>
					<th><input type="checkbox" class="checkAll"> Check All  | Uncheck All </th>
					<th></th>
				</tr>
			</thead>
			<tbody>
				@foreach($autopaylist as $list)
					<tr>
						<td>
							<div class="special-date">
								<input  type="text" class="form-control" id="payment_date{{$i}}" name="payment_date" placeholder="" autocomplete="off" data-behavior="datepicker" value="{{$list['payment_date']}}">
							</div>
						</td>
						<td> 
							<div class="auto-amount">
								<label>$</label>
								<input type="text" class="form-control valid" name="amount"  placeholder="0" value="{{$list['amount']}}">
							</div>
						</td>
						<td>${{$list['tax']}}</td>
						<td>@if($list['charged_amount'] != '') ${{$list['charged_amount']}} @else $0 @endif</td>
						<td> {{$list->getStripeCard()}} </td> 
						<td>{{$list['status']}}</td>
						<td><input type="checkbox" id="chkbox" name="chkbox[]" class="custom_chkbox"></td>
						<td>
							<button type="submit" class="btn-nxt cancel-modal">Save</button>
						</td>
					</tr>
					@php $i++; @endphp
				@endforeach
			</tbody>
		</table>
	</div>
	<div class="col-md-12 text-right">
		<button type="submit" class="auto-pay-btns">Delete Checked Items</button> |
		<button type="submit" class="auto-pay-btns">Pay Checked Items</button>							
	</div>
</div>

<script type="text/javascript">
	$(".checkAll").on("click", function(){
		if($(".checkAll").is(':checked')) {
	        $(".custom_chkbox").each(function(){
	            $(this).prop("checked",true);
	        });
	    }else{
	    	$(".custom_chkbox").each(function(){
	            $(this).prop("checked",false);
	        });
	    }
    });
</script>