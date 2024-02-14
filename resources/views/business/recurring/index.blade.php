<h5 class="modal-title mb-10" id="myModalLabel">{{$pageName}}</h5>

<div class="container-fuild">
	<div class="row">
		<div class="col-lg-12">
			<label>Auopay Schedule For:</label>
			<span>{{$customer->full_name}}</span>
		</div>
		<div class="col-lg-6">
			<div>
				<label>Contract Details:</label>
				<span>{{$bookingDetail->business_price_detail_with_trashed->business_price_details_ages_with_trashed->category_title}} , {{$bookingDetail->business_price_detail_with_trashed->price_title}}</span>
			</div>
		</div>
		<div class="col-lg-6">
			<div class="auto-details-location float-end">
				<label>Location:</label>
				<span>{{$bookingDetail->company_information->dba_business_name}}</span>
				
				<label> Autopay Remaining</label>
				<span>{{$remaining}}/{{$autopayListCnt}}</span>
				
			</div>
		</div>
	</div>
</div>

<div class="mt-10 mb-10">
	<span class="fs-16" id="errmsgRecurring"></span>
</div>

<div class="scheduler-table">
	<div class="table-responsive">
		<table class="table mb-0">
		@if($type == 'schedule')
			<thead>
				<tr>
					<th>No</th>
					<th>Payment Date </th>
					<th>Original Amount</th>
					<th>Tax </th>
					<th>Charged Amount </th>
					<th>Payment Method </th>
					<th>Status </th>
					<th><input type="checkbox" class="checkAll"> Check All  | Uncheck All </th>
					<th></th>
				</tr>
			</thead>
			<tbody>
				@foreach($autopayListScheduled as $key=>$list)
					<tr>
						<td>{{$key + 1}}</td>
						<td>
							<div class="special-date">
								<input  type="text" class="form-control payment_date"  name="payment_date"  id="payment_date{{$list->id}}" placeholder="" autocomplete="off" value="{{date('m/d/Y' ,strtotime($list['payment_date']))}}">
							</div>
						</td>
						<td> 
							<div class="auto-amount">
								<label>$</label>
								<input type="text" class="form-control valid" name="amount"  id="amount{{$list->id}}" placeholder="0" value="{{$list->getTotalAmountAttribute()}}">
							</div>
						</td>
						<td>${{$list['tax']}}</td>
						<td>${{$list->getTotalAmountAttribute()}}</td>
						<td>{{$list->getStripeCard() ?? "N/A" }} </td> 
						<td>{{$list['status']}}</td>
						<td><input type="checkbox" id="chkbox{{$list->id}}" name="chkboxes[]" class="custom_chkbox" value="{{$list->id}}"></td>
						<td>
							<button id="submit" type="button" class="btn btn-red" data-behavior="updateAutoPay" data-recurring-id="{{$list->id}}">Save</button>
						</td>
					</tr>
					@php $i++; @endphp
				@endforeach
			</tbody>
		@else
			<thead>
				<tr>
					<th> Payment  Date </th>
					<th> Amount </th>
					<th> Tax </th>
					<th>Charged Amount </th>
					<th>Payment Method </th>
					<th> Status </th>
				</tr>
			</thead>
			<tbody>
				@foreach($autopayListHistory as $key=>$list)
					<tr>
						<td>{{date('m/d/Y' ,strtotime($list['payment_date']))}}</td>
						<td> {{$list['amount']}}</td>
						<td>${{$list['tax']}}</td>
						<td>@if($list['charged_amount'] != '') ${{$list['charged_amount']}} @else $0 @endif</td>
						<td> {{$list->getStripeCard() ?? "N/A"}} </td> 
						<td>{{$list['status']}}</td>
					</tr>
					@php $i++; @endphp
				@endforeach
			</tbody>
		@endif
		</table>
	</div>
</div>
@if($type == 'schedule')
	<div class="col-md-12 text-right mt-10">
		<button type="button" class="btn btn-red" data-behavior="delete_recurring_detail">Delete Checked Items</button> 
		<button type="button" class="btn btn-black" data-behavior="pay_recurring_item" id="payitems">Pay Checked Items</button>
	</div>
@endif

<script type="text/javascript">
	flatpickr(".payment_date", {
    	dateFormat: "m/d/Y",
    	maxDate: "01/01/2050",
    });

	$(document).ready(function() {
		$(document).on('click', '[data-behavior~=updateAutoPay]', function(e){
	        e.preventDefault()
	        $.ajax({
	            url: "/business/{{$business_id}}/recurring/" + $(this).data('recurring-id'),
	            method: "PATCH",
	            data: { 
	                _token: '{{csrf_token()}}', 
	                amount: $('#amount'+$(this).data('recurring-id')).val(), 
	                payment_date: $('#payment_date'+$(this).data('recurring-id')).val(), 
	            },
	            success: function(html){
	                location.reload();
	            }
	        });
	    });

	   

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
	});

	 $(document).on('click', '[data-behavior~=delete_recurring_detail]', function(e){
	        e.preventDefault()
	        var ids = '';
	       	var idsAry = [];
		    $("input[name='chkboxes[]']:checked").each(function() {
		        idsAry.push($(this).val());
		    });
		    ids = idsAry.join(',');

	        if(ids != ''){
		        $.ajax({
		            url: "/business/{{$business_id}}/recurring/" + ids,
		            method: "DELETE",
		            data: { 
		                _token: '{{csrf_token()}}', 
		            },
		            success: function(html){
		                location.reload();
		            }
		        })
		   	}else{
		   		alert("Please select items that you want to delete. ")
		   	}
	    });
	 	
	 	$(document).on('click', '[data-behavior~=pay_recurring_item]', function(e){
	 		e.stopPropagation();
	        e.preventDefault()
	        var ids = '';
	       	var idsAry = [];
		    $("input[name='chkboxes[]']:checked").each(function() {
		        idsAry.push($(this).val());
		    });
		    $('#payitems').html('Loading..');
		    ids = idsAry.join(',');
	        if(ids != ''){
	        	$('#payitems').attr("disabled", true);
		        $.ajax({
		            url: "/business/{{$business_id}}/recurring/pay_recurring_item",
		            method: "POST",
		            data: { 
		                _token: '{{csrf_token()}}', 
		                ids: ids, 
		            },
		            success: function(response){
		            	if(response.message == 'success'){
		            		$('#errmsgRecurring').addClass('font-green');
		            		$('#errmsgRecurring').html('Auto Payment Successfully Done.');
		            		setTimeout(function(e){
		            			location.reload();
		            		},2000);
		            	}else{
		            		$('#payitems').html('Pay Checked Items');
		            		$('#payitems').attr("disabled", false);
		            		$('#errmsgRecurring').addClass('font-red');
		            		$('#errmsgRecurring').html(response.message);
		            	}
		            }
		        })
		   	}else{ alert("Please select items that you want to Pay. ")}
	    });

</script>