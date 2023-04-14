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
			<span>{{$remaining}}/{{$autopaylistcnt}} </span>
			
			<label>Autopay History</label>
			<a> View </a>
		</div>
	</div>
	<div class="row history-tabs"> 
		<div class="col-md-12">
			<div class="autopay-schedule">
				<ul class="nav nav-tabs" id="myTab0" role="tablist">
					<li class="nav-item">
						<a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Schedule</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" id="history-tab" data-toggle="tab" href="#history" role="tab" aria-controls="history" aria-selected="false">History</a>
					</li>
				</ul>
				<div class="tab-content" id="myTabContent0">
					<div class="tab-pane active" id="home" role="tabpanel" aria-labelledby="home-tab">
						<div class="">
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
									@foreach($autopayListScheduled as $key=>$list)
										<tr>
											<td>
												<div class="special-date">
													<input  type="text" class="form-control"  name="payment_date"  id="payment_date{{$list->id}}" placeholder="" autocomplete="off" data-behavior="datepicker" value="{{date('m/d/Y' ,strtotime($list['payment_date']))}}">
												</div>
											</td>
											<td> 
												<div class="auto-amount">
													<label>$</label>
													<input type="text" class="form-control valid" name="amount"  id="amount{{$list->id}}" placeholder="0" value="{{$list['amount']}}">
												</div>
											</td>
											<td>${{$list['tax']}}</td>
											<td>@if($list['charged_amount'] != '') ${{$list['charged_amount']}} @else $0 @endif</td>
											<td> {{$list->getStripeCard()}} </td> 
											<td>{{$list['status']}}</td>
											<td><input type="checkbox" id="chkbox{{$list->id}}" name="chkbox[]" class="custom_chkbox" value="{{$list->id}}"></td>
											<td>
												<button id="submit" type="button" class="btn-nxt cancel-modal" data-behavior="updateAutoPay" data-recurring-id="{{$list->id}}">Save</button>
											</td>
										</tr>
										@php $i++; @endphp
									@endforeach
								</tbody>
							</table>
						</div>
						<div class="col-md-12 text-right">
							<button type="button" class="auto-pay-btns" data-behavior="delete_recurring_detail">Delete Checked Items</button> |
							<button type="button" class="auto-pay-btns" data-behavior="pay_recurring_item">Pay Checked Items</button>							
						</div>
					</div>
					<div class="tab-pane" id="history" role="tabpanel" aria-labelledby="history-tab">
						<div class="">
							<table id="pay-details" class="table table-striped table-bordered" style="width:100%">
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
											<td> {{$list->getStripeCard()}} </td> 
											<td>{{$list['status']}}</td>
										</tr>
										@php $i++; @endphp
									@endforeach
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	
</div>

<script type="text/javascript">

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

    $(document).on('click', '[data-behavior~=delete_recurring_detail]', function(e){
        e.preventDefault()

        var ids =$("input[type='checkbox']:checked").map(function () {
            return this.value;
        }).get().join(',');

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
        e.preventDefault()

        var ids =$("input[type='checkbox']:checked").map(function () {
            return this.value;
        }).get().join(',');

        if(ids != ''){
	        $.ajax({
	            url: "/business/{{$business_id}}/recurring/pay_recurring_item",
	            method: "POST",
	            data: { 
	                _token: '{{csrf_token()}}', 
	                ids: ids, 
	            },
	            success: function(html){
	              	location.reload();
	            }
	        })
	   	}else{
	   		alert("Please select items that you want to Pay. ")
	   	}
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
</script>