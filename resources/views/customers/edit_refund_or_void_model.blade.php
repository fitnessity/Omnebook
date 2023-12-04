
<h5 class="modal-title" id="myModalLabel">Void or Refund </h5>
<div class="red-separator mb-10">
	<div class="container-fluid nopadding">
		<div class="row">	
			<div class="col-lg-6 col-md-6">
				<div class="modal-sub-title">
					<h4>Edit info for {{$booking_detail->business_services_with_trashed->program_name}}</h4>
				</div>
			</div>
			<div class="col-lg-6 col-md-6">
				<div class="modal-side-title">
					<h4> Membership Status: 
					@if($booking_detail->status == 'active') 
						<span class="font-green"> Active </span> 
					@else
						<span class="font-red"> {{$booking_detail->status}} </span> 
					@endif
					</h4>
				</div>
			</div>
		</div> 
	</div>
</div>

<div class="container-fluid nopadding">
	<div class="row">
		<div class="col-lg-12">
			<!-- Nav tabs -->
			<ul class="nav nav-tabs mb-3" role="tablist">
				<li class="nav-item">
					<a class="nav-link active" data-bs-toggle="tab" href="#Booking__Details" role="tab" aria-selected="false">
						Current Booking Details
					</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" data-bs-toggle="tab" href="#Edit__Section" role="tab" aria-selected="false">
						Issue Refund/Void
					</a>
				</li>
			</ul>
			<!-- Tab panes -->
			<div class="tab-content  text-muted">
				<div class="tab-pane active" id="Booking__Details" role="tabpanel">
					<div class="title-sp-customer">
						<h4 class="edit-booking-title">Current Booking Details</h4>
						<p class="text-center">Review the membership details before any changes</p>
					</div>
					<div class="">
						<div class="row">
							<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 col-6">
								<div class="remaining-total">
									<label>Total Remaining</label>
								</div>
							</div>
							<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 col-6">
								<div class="remaining-number">
									<span>{{$booking_detail->getremainingsession()}}/{{$booking_detail->pay_session}}</span>
								</div>
							</div>
							
							<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 col-6">
								<div class="sub-info-customer">
									<label>Booking # </label>
								</div>
							</div>
							<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 col-6">
								<div class="sub-info-customer line-break">
									<span>{{$booking_detail->booking->order_id}}  </span>
								</div>
							</div>
							
							<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 col-6">
								<div class="sub-info-customer">
									<label>Program Name: </label>
								</div>
							</div>
							<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 col-6">
								<div class="sub-info-customer">
									<span>{{$booking_detail->business_services_with_trashed->program_name}}</span>
								</div>
							</div>
							
							<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 col-6">
								<div class="sub-info-customer">
									<label>Catagory: </label>
								</div>
							</div>
							<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 col-6">
								<div class="sub-info-customer">
									<span>{{$booking_detail->business_price_detail_with_trashed->business_price_details_ages_with_trashed->category_title}}</span>
								</div>
							</div>
							
							<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 col-6">
								<div class="sub-info-customer">
									<label>Price Option:</label>
								</div>
							</div>
							<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 col-6">
								<div class="sub-info-customer">
									<span>{{$booking_detail->business_price_detail_with_trashed->price_title}}</span>
								</div>
							</div>
							
							<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 col-6">
								<div class="sub-info-customer">
									<label>Number of Sessions:</label>
								</div>
							</div>
							<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 col-6">
								<div class="sub-info-customer">
									<span>{{$booking_detail->pay_session}}</span>
								</div>
							</div>
							
							<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 col-6">
								<div class="sub-info-customer">
									<label>Membership Option:</label>
								</div>
							</div>
							<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 col-6">
								<div class="sub-info-customer">
									<span>{{$booking_detail->business_price_detail_with_trashed->membership_type}}</span>
								</div>
							</div>
							
							<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 col-6">
								<div class="sub-info-customer">
									<label>Participant Quantity:</label>
								</div>
							</div>
							<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 col-6">
								<div class="sub-info-customer">
									<span>
										<?php $a = json_decode($booking_detail->qty);
											if( !empty($a->adult) ){ echo 'Adult x '.$a->adult; }
											if( !empty($a->child) ){ echo '<br> Child x '.$a->child; }
											if( !empty($a->infant) ){ echo '<br>Infant x '.$a->infant; }
										?>
									</span>
								</div>
							</div>
							
							<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 col-6">
								<div class="sub-info-customer">
									<label>Who's Participating:</label>
								</div>
							</div>
							<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 col-6">
								<div class="sub-info-customer">
									<span>
										<?php $p = json_decode($booking_detail->participate);
											foreach($p[0] as $key=>$value)
											{
												if($key=='pc_name')
													echo $value;
											}
											if( !empty($p->pc_name) ){ echo $p->pc_name; }
										?>
									</span>
								</div>
							</div>
							
							<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 col-6">
								<div class="sub-info-customer">
									<label>Membership Duration:</label>
								</div>
							</div>
							<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 col-6">
								<div class="sub-info-customer">
									<span>{{$booking_detail->expired_duration}}</span>
								</div>
							</div>
							
							<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 col-6">
								<div class="sub-info-customer">
									<label>Purchase Date:</label>
								</div>
							</div>
							<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 col-6">
								<div class="sub-info-customer">
									<span>{{date('m/d/Y',strtotime($booking_detail->created_at))}}</span>
								</div>
							</div>
							
							<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 col-6">
								<div class="sub-info-customer">
									<label>Membership Activation Date: </label>
								</div>
							</div>
							<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 col-6">
								<div class="sub-info-customer">
									<span>{{date('m/d/Y',strtotime($booking_detail->contract_date))}}</span>
								</div>
							</div>
							
							<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 col-6">
								<div class="sub-info-customer">
									<label>Membership Expiration: </label>
								</div>
							</div>
							<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 col-6">
								<div class="sub-info-customer">
									<span>{{date('m/d/Y',strtotime($booking_detail->expired_at))}}</span>
								</div>
							</div>
							<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 col-12">
								<div class="remaining-total tip-xp">
									<label>Payment Details</label>
								</div>
							</div>
							<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 col-6">
								<div class="sub-info-customer">
									<label>Tip Amount: </label>
								</div>
							</div>
							<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 col-6">
								<div class="sub-info-customer">
									<span>${{$booking_detail->getextrafees('tip')}}</span>
								</div>
							</div>
							
							<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 col-6">
								<div class="sub-info-customer">
									<label>Discount: </label>
								</div>
							</div>
							<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 col-6">
								<div class="sub-info-customer">
									<span>${{$booking_detail->getextrafees('discount')}}</span>
								</div>
							</div>
							
							<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 col-6">
								<div class="sub-info-customer">
									<label>Tax:</label>
								</div>
							</div>
							<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 col-6">
								<div class="sub-info-customer">
									<span>${{$booking_detail->getextrafees('tax')}}</span>
								</div>
							</div>
							
							<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 col-6">
								<div class="remaining-total">
									<label>Total Amount Paid </label>
								</div>
							</div>
							<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 col-6">
								<div class="remaining-number">
									<span>${{$booking_detail->total() + $booking_detail->getperoderprice()}}</span>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="tab-pane" id="Edit__Section" role="tabpanel">
					<!-- Nav tabs -->
					<ul class="nav nav-tabs mb-3" role="tablist">
						<li class="nav-item">
							<a class="nav-link active" data-bs-toggle="tab" href="#Issue_Refund" role="tab" aria-selected="false">
								 Issue Refund
							</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" data-bs-toggle="tab" href="#Void_Payment" role="tab" aria-selected="false">
								Void Payment
							</a>
						</li>
					</ul>
					<!-- Tab panes -->
					<div class="tab-content  text-muted">
						<div class="tab-pane active" id="Issue_Refund" role="tabpanel">
						<div class="title-sp-customer">
							<h4 class="edit-booking-title">Edit Section </h4>
							<p class="text-center">Use this section to edit the membership details you need below</p>
						</div>						
						@if($booking_detail->can_refund())
							<div class="radio-text">
								<form action="">
									<label for="void">Issue a Refund</label>
								</form>
							</div>
							<div class="refund-details"> 
								<label>Total Amount Paid: </label>
								<span> ${{$booking_detail->booking->amount}} (Original payment method: {{$booking_detail->booking->getPaymentDetail()}})  </span>
							</div>
							<div class="refund-details refund-date"> 
								<div class="row">
									<div class="col-lg-3 col-md-3 col-sm-4 col-12">
										<label>Refund Issue Date: </label>
									</div>
									<div class="col-lg-4 col-md-4 col-sm-5 col-12">
										<input type="text" id="refund_date" class="form-control border-0 flatpickr-range flatpiker-with-border flatpickr-input active" value="{{date('m/d/Y')}}">
									</div>
								</div>
							</div>
							<div class="refund-details refund-amount"> 
								<div class="row">
									<div class="col-lg-3 col-md-3 col-sm-4 col-12">
										<label>Refund Amount: </label>
									</div>
									<div class="col-lg-4 col-md-4 col-sm-5 col-12">
										<input class="form-control" type="text" id="refund_amount" name="refund_amount" placeholder="20" value="{{$booking_detail->refund_amount}}">
										<h4>(Refund amount can’t be greater than the total amount paid)</h4>
									</div>
								</div>
							</div>
							<div class="refund-details refund-method"> 
								<label>Refund Method: </label>
								<select class="form-control mb-10 form-select" id="refund_method" name="refund_method">
									<option value="credit" selected>Credit Card ({{$booking_detail->booking->getPaymentDetail()}})</option>
									<option value="cash">Cash</option>
									<option value="other">Other</option>
								</select>
							</div>
							<div class="refund-details text-center">
								<textarea class="form-control" rows="2" name="refund_reason" id="refund_reason" placeholder="Leave a note for the reason of the refund" maxlength="500">{{$booking_detail->refund_reason}}</textarea>
								<button type="button" class="btn btn-red mt-10 float-end" id="" data-behavior="refund_order_detail" data-booking-detail-id = "{{$booking_detail->id}}" data-booking-id = "{{$booking_detail->booking_id}}" data-customer-id = "{{$customer_id}}">Issue The Refund</button>
							</div>
						@endif
						</div>
						<div class="tab-pane" id="Void_Payment" role="tabpanel">
							@if($booking_detail->can_void())
							<div class="radio-text">
								<form action="">
									<label for="void">Void This Sale (Made a booking mistake? Training or testing a sale? You can void this membership.) before 01/01/2024</label>
								</form>
							</div>
							<div class="void-box">
								<div class="void-transaction">
									<p>Voiding this transaction will delete this record from your system, You will not be able to undo this once you agree to void.</p>
									<button type="button" class="btn btn-red" id="" data-behavior="destroy_order_detail" data-booking-detail-id = "{{$booking_detail->id}}" data-booking-id = "{{$booking_detail->booking_id}}" data-customer-id = "{{$customer_id}}">Yes, Void This Sale</button>
								</div>
							</div>
							<!--<div class="row">
								<div class="col-md-5 col-sm-5 col-xs-5 col-5">
									<div class="red-separator mt-7"></div>
								</div>
								<div class="col-md-2 col-sm-2 col-xs-2 col-2 text-center">
									<label> OR </label>
								</div>
								<div class="col-md-5 col-sm-5 col-xs-5 col-5">
									<div class="red-separator mt-7"></div>
								</div>
							</div>-->
						@endif
						</div>
					</div>
				</div>
            </div>
		</div>
	</div>
	<div class="row">
		<div class="col-lg-7 col-md-12 col-sm-12 col-xs-12 nopadding">
		
		</div>
	</div>
</div>

<script type="text/javascript">

	$(".flatpickr-input").flatpickr({ 
        dateFormat:'m/d/Y',
        maxDate:'01/01/2050'
    });

	$("[data-behavior~=destroy_order_detail]").click(function(e){
		e.preventDefault();

        $.ajax({
            url: "/business/{{$business_id}}/booking_details/" + $(this).data('booking-id') + '/void',
            method: "POST",
            data:{
                _token: '{{csrf_token()}}', 
                customer_id: $(this).data('customer-id')
            },
            error: function(xhr, status, error){
            	var errorMessage = JSON.parse(xhr.responseText);
            	alert(errorMessage.message);
            },
            success:function(response) {
                location.reload()
            },
        });
    });

	$("[data-behavior~=refund_order_detail]").click(function(e){
        $.ajax({
            url: "/business/{{$business_id}}/booking_details/" + $(this).data('booking-id') + '/refund',
            type: "POST",
            data:{
                _token: '{{csrf_token()}}', 
                customer_id:  $(this).data('customer-id'),
				refund_amount: $('#refund_amount').val(),
				refund_method: $('#refund_method').val(),
				refund_date: $('#refund_date').val(),
				refund_reason: $('#refund_reason').val(),
				booking_detail_id: $(this).data('booking-detail-id')
            },
            error: function(xhr, status, error){
            	var errorMessage = JSON.parse(xhr.responseText);
            	alert(errorMessage.message);
            },
            success:function(response) {

                location.reload()
            },
        });
    });
</script>