<h5 class="modal-title" id="myModalLabel">Suspend or Terminate</h5>
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
		<div class="col-lg-12 col-md-12 col-12">
			<!-- Nav tabs -->
			<ul class="nav nav-tabs mb-3" role="tablist">
				<li class="nav-item">
					<a class="nav-link active" data-bs-toggle="tab" href="#Booking_Details" role="tab" aria-selected="false">
						Current Booking Details
					</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" data-bs-toggle="tab" href="#Edit_Section" role="tab" aria-selected="false">
						Edit Section
					</a>
				</li>
			</ul>
			<!-- Tab panes -->
			<div class="tab-content  text-muted">
				<div class="tab-pane active" id="Booking_Details" role="tabpanel">
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
									<span>{{@$booking_detail->businessPriceDetailsAgesTrashed->category_title}} </span>
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
				<div class="tab-pane" id="Edit_Section" role="tabpanel">
					<div class="title-sp-customer-terminate">
						<h4 class="edit-booking-title"> </h4>
						<p class="text-center">Use this section to Suspend/Freeze or Terminate/Cancel a membership</p>
					</div>
					<!-- Nav tabs -->
					<ul class="nav nav-tabs mb-3" role="tablist">
						<li class="nav-item">
							<a class="nav-link active" data-bs-toggle="tab" href="#Suspend_Freeze" role="tab" aria-selected="false">
								Suspend/Freeze
							</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" data-bs-toggle="tab" href="#Terminate_Cancel" role="tab" aria-selected="false">
								Terminate/Cancel
							</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" data-bs-toggle="tab" href="#Suspension_history" role="tab" aria-selected="false">
								Suspension history
							</a>
						</li>
					</ul>
					<!-- Tab panes -->
					<div class="tab-content  text-muted">
						<div class="tab-pane active" id="Suspend_Freeze" role="tabpanel">
							@if($booking_detail->can_suspend())
							<div class="radio-text">
								<form action="">
									{{-- <input type="radio" id="suspend" name="fav_language" value="suspend" @if($booking_detail->status == 'suspend') checked @endif> --}}
									<label for="void">Suspend/Freeze (Seeting a membership or contract suspension will freeze this membership for a duration of time.)</label>
								</form>
							</div>
							<div class="refund-details refund-method"> 
								<label>Reason for Suspension: </label>
								<textarea class="form-control" rows="2" name="suspension_reason" id="suspension_reason" placeholder="Leave a note for the reason of the refund" maxlength="500">{{$booking_detail->suspend_reason}}</textarea>
							</div>
							<?php  $suspensionStartDate = $booking_detail->suspend_started != '' ? $booking_detail->suspend_started : date('m/d/Y');  

								$suspensionEndDate = $booking_detail->suspend_ended != '' ? $booking_detail->suspend_ended : date('m/d/Y'); 
							?>
							<div class="row">
								<div class="col-lg-6 col-sm-6 col-md-6">
									<div class="refund-details refund-method">
										<label>Suspension Start Date: </label>
										<div class="input-group">
											<input type="text" id="suspensionstartdate" class="form-control border-0 dash-filter-picker flatpickr-range flatpiker-with-border flatpickr-input" value="{{$suspensionStartDate}}">
										</div>
									</div>
								</div>
								<div class="col-lg-6 col-sm-6 col-md-6">
									<div class="refund-details refund-method">
										<label>Suspension End Date:</label>
										<div class="input-group">
											<input type="text" class="form-control border-0 dash-filter-picker flatpickr-range flatpiker-with-border flatpickr-input" id="suspensionenddate" value="{{$suspensionEndDate}}">
										</div>
									</div>
								</div>

								<div class="col-lg-6 col-md-6 col-sm-6">
									<div class="refund-details mb-10"> 
										<div class="form-check form-switch mb-3">
											<label class="form-check-label" for="SwitchCheck1">Stop Recurring Payments During Freeze</label>
											<input class="form-check-input" type="checkbox" name="stop_recurring" role="switch" id="toggler" value="checked" checked>
										</div>
										<div class="" id="suspension_fees">
											<label>Suspension Fee: </label>
											<input class="form-control" type="text" id="suspension_fee" name="suspension_fee" placeholder="$" value="{{$booking_detail->suspend_fee}}">
										</div>
									</div>
								</div>
								
								<div class="col-lg-6 col-sm-6 col-md-6">
									<div class="refundcomment">
										<label>Leave a comment:</label>
										<textarea class="form-control" rows="1" name="suspension_comment" id="suspension_comment" placeholder="Leave a note for the reason of the refund" maxlength="500">{{$booking_detail->suspend_comment}}</textarea>
									</div>
								</div>
								<div class="col-lg-12 col-xs-12">
									<button type="button" class="btn btn-red float-end" id="" data-behavior="suspend_order_detail" data-booking-detail-id = "{{$booking_detail->id}}"  data-booking-id = "{{$booking_detail->booking_id}}" data-customer-id = "{{$customer_id}}">Suspend/Freeze</button>
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
							</div> -->
						@endif
						</div>
						<div class="tab-pane" id="Terminate_Cancel" role="tabpanel">
							@if($booking_detail->can_terminate())
							<div class="radio-text">
								<form action="">
									{{-- <input type="radio" id="termination" name="fav_language" value="termination" @if($booking_detail->status == 'cancel') checked @endif> --}}
									<label for="void">Terminate/Cancel (Terminate/Cancel this membership)</label>
								</form>
							</div>
							<div class="refund-details refund-method mb-10"> 
								<label>Reason for Termination:  </label>
								<textarea class="form-control" rows="2" name="terminate_reason" id="terminate_reason" placeholder="Leave a note for the reason of the refund" maxlength="500">{{$booking_detail->terminate_reason}}</textarea>
							</div>
							
							<div class="row">
								<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
									<label>Termination  Date:</label>
									<div class="input-group">
										<input type="text" id="terminate_date" class="form-control border-0 dash-filter-picker flatpickr-range flatpiker-with-border flatpickr-input" value="{{date('m/d/Y')}}" >
									</div>
								</div>
								<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
									<div class="mb-10"> 
										<label>Termination Fee: </label>
										<input class="form-control" type="text" id="terminate_fee" name="terminate_fee" placeholder="$" value="{{$booking_detail->terminate_fee}}">
									</div>
								</div>
							</div>
														
							<div class="row">
								<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
									<div class="refundcomment">
										<label>Leave a comment:</label>
										<textarea class="form-control" rows="2" name="terminate_comment" id="terminate_comment" placeholder="Leave a note for the reason of the refund" maxlength="500">{{$booking_detail->terminate_comment}}</textarea>
									</div>
								</div>
								<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
									<div class="refundcomment refund-note">
										<p>By clicking terminate, you will be removing all remaining contract &amp; membership agreements, payment agreements &amp; scheduled recurring payments. </p>
									</div>
								</div>
								<div class="col-lg-12 col-xs-12">
									<div class="fonts-red" id="addinserro"> </div>
									<button type="submit" class="btn btn-red float-end" id="" data-behavior="terminate_order_detail" data-booking-detail-id = "{{$booking_detail->id}}" data-booking-id = "{{$booking_detail->booking_id}}" data-customer-id = "{{$customer_id}}">Terminate</button>
								</div>
							</div>
						@endif
						</div>
						<div class="tab-pane" id="Suspension_history" role="tabpanel">
							<div class="suspension-history">
								<label>There is no Suspension history</label>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<script>
	const toggle = document.getElementById('toggler');
	const suspensionFeeInput = document.getElementById('suspension_fees');
	toggle.addEventListener('change', () => {	
		var product_id = toggle.value; 
		var status = toggle.checked ? "yes" : "no"; 
		if (status === "yes") {
            suspensionFeeInput.style.display = 'block';  
        } else {
            suspensionFeeInput.style.display = 'none';  
        }
	});
</script>
<script type="text/javascript">

	$(".flatpickr-input").flatpickr({ 
        dateFormat:'m/d/Y',
        maxDate:'01/01/2050'
    });

	
	$("[data-behavior~=suspend_order_detail]").click(function(e){
	    $.ajax({
			url: "/business/{{$business_id}}/booking_details/" + $(this).data('booking-id') + '/suspend',
	        type: "POST",
	        data:{
	            _token: '{{csrf_token()}}', 
	            booking_detail_id: $(this).data('booking-detail-id'),
	            suspension_reason: $('#suspension_reason').val(),
	            suspensionstartdate: $('#suspensionstartdate').val(),
	            suspensionenddate: $('#suspensionenddate').val(),
				stop_recurring: $('#toggler').is(":checked") ? 1 : 0 ,// Send checkbox value (1 for checked, 0 for unchecked)
	            suspension_fee: $('#suspension_fee').val(),
	            suspension_comment: $('#suspension_comment').val(),
	            customer_id:  $(this).data('customer-id'),
	            booking_id:  $(this).data('booking-id'),
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

	$("[data-behavior~=terminate_order_detail]").click(function(e){
        $.ajax({
            url: "/business/{{$business_id}}/booking_details/" + $(this).data('booking-id') + '/terminate',
            type: "POST",
            data:{
                _token: '{{csrf_token()}}', 
                booking_detail_id: $(this).data('booking-detail-id'),
                terminate_reason: $('#terminate_reason').val(),
                terminated_at: $('#terminate_date').val(),
                terminate_fee: $('#terminate_fee').val(),
                terminate_comment: $('#terminate_comment').val(),
                customer_id:  $(this).data('customer-id'),
                booking_id:  $(this).data('booking-id'),
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