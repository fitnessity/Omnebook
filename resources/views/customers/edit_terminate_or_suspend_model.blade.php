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
					@if($booking_detail->expired_at > date('Y-m-d')) 
						<span class="font-green"> Active </span> 
					@else
						<span class="font-red"> InActive </span> 
					@endif
					</h4>
				</div>
			</div>
		</div> 
	</div>
</div>

<div class="container-fluid nopadding">
	<div class="row">
		<div class="col-lg-5 col-md-12 col-sm-12 col-xs-12">
			<div class="title-sp-customer">
				<h4 class="edit-booking-title">Current Booking Details</h4>
				<p class="text-center">Review the membership details before any changes</p>
			</div>
			<div class="side-border-right">
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
							<span>
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
					
					<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 col-6">
						<div class="sub-info-customer tip-xp">
							<label>Tip Amount: </label>
						</div>
					</div>
					<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 col-6">
						<div class="sub-info-customer tip-xp">
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
						<div class="remaining-total tip-xp mt-150">
							<label>Total Amount Paid </label>
						</div>
					</div>
					<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 col-6">
						<div class="remaining-number tip-xp mt-150">
							<span>${{$booking_detail->getperoderprice()}}</span>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="col-lg-7 col-md-12 col-sm-12 col-xs-12 nopadding">
			<div class="title-sp-customer">
				<h4 class="edit-booking-title">Edit Section </h4>
				<p class="text-center">Use this section to edit the membership details you need below</p>
			</div>
			<div class="radio-text">
				<form action="">
					<input type="radio" id="suspend" name="fav_language" value="suspend" @if($booking_detail->status == 'suspend') checked @endif>
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
							<input type="text" class="form-control border-0 dash-filter-picker flatpickr-range flatpiker-with-border flatpickr-input" value="{{$suspensionStartDate}}">
						</div>
					</div>
				</div>
				<div class="col-lg-6 col-sm-6 col-md-6">
					<div class="refund-details refund-method">
						<label>Suspension End Date:</label>
						<div class="input-group">
							<input type="text" class="form-control border-0 dash-filter-picker flatpickr-range flatpiker-with-border flatpickr-input" value="{{$suspensionStartDate}}" value="{{$suspensionEndDate}}">
						</div>
					</div>
				</div>
				<div class="col-lg-6  col-md-6 col-sm-6">
					<div class="refund-details mb-10"> 
						<label>Suspension Fee: </label>
						<input class="form-control" type="text" id="suspension_fee" name="suspension_fee" placeholder="$" value="{{$booking_detail->suspend_fee}}">
					</div>
				</div>
				<div class="col-lg-6 col-sm-6 col-md-6">
					<div class="refundcomment">
						<label>Leave a comment:</label>
						<textarea class="form-control" rows="1" name="suspension_comment" id="suspension_comment" placeholder="Leave a note for the reason of the refund" maxlength="500">{{$booking_detail->suspend_comment}}</textarea>
					</div>
				</div>
				<div class="col-lg-12 col-xs-12">
					<button type="button" class="btn btn-red float-end" id=""  data-behavior="suspend_order_detail" data-booking-detail-id = "{{$booking_detail->id}}"  data-booking-id = "{{$booking_detail->booking_id}}" data-customer-id = "{{$customer_id}}">Suspend/Freeze</button>
				</div>
			</div>
			<div class="row">
				<div class="col-md-5 col-sm-5 col-xs-5 col-5">
					<div class="red-separator mt-7"></div>
				</div>
				<div class="col-md-2 col-sm-2 col-xs-2 col-2 text-center">
					<label> OR </label>
				</div>
				<div class="col-md-5 col-sm-5 col-xs-5 col-5">
					<div class="red-separator mt-7"></div>
				</div>
			</div>
			
			<div class="radio-text">
				<form action="">
					<input type="radio" id="termination" name="fav_language" value="termination" @if($booking_detail->status == 'cancel') checked @endif>
					<label for="void">Terminate/Cancel (Terminate/Cancel this membership)	  </label>
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
						<input type="text" class="form-control border-0 dash-filter-picker flatpickr-range flatpiker-with-border flatpickr-input" value="{{date('m/d/Y')}}" >
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
			</div>
		</div>
	</div>
</div>

<div class="modal-footer">
    <div class="fonts-red" id="addinserro"> </div>
    <button type="submit" class="btn btn-red float-end" id="" data-behavior="terminate_order_detail" data-booking-detail-id = "{{$booking_detail->id}}" data-booking-id = "{{$booking_detail->booking_id}}" data-customer-id = "{{$customer_id}}">Terminate</button>
</div>

<script type="text/javascript">

	$(".flatpickr-input").flatpickr({ 
        dateFormat:'m/d/Y',
        maxDate:'01/01/2050'
    });

	$(document).on('click', "[data-behavior~=suspend_order_detail]", function(){
	    $.ajax({
	        url: "/business/{{$business_id}}/suspend/",
	        type: "POST",
	        data:{
	            _token: '{{csrf_token()}}', 
	            booking_detail_id: $(this).data('booking-detail-id'),
	            suspension_reason: $('#suspension_reason').val(),
	            suspensionstartdate: $('#suspensionstartdate').val(),
	            suspensionenddate: $('#suspensionenddate').val(),
	            suspension_fee: $('#suspension_fee').val(),
	            suspension_comment: $('#suspension_comment').val(),
	            customer_id:  $(this).data('customer-id'),
	            booking_id:  $(this).data('booking-id'),
	        },
	        success:function(response) {
	            location.reload()
	        },
	    });
	});

    $(document).on('click', "[data-behavior~=terminate_order_detail]", function(){
        $.ajax({
            url: "/business/{{$business_id}}/terminate/",
            type: "POST",
            data:{
                _token: '{{csrf_token()}}', 
                booking_detail_id: $(this).data('booking-detail-id'),
                terminate_reason: $('#terminate_reason').val(),
                terminated_at: $('#terminationdate').val(),
                terminate_fee: $('#terminate_fee').val(),
                terminate_comment: $('#terminate_comment').val(),
                customer_id:  $(this).data('customer-id'),
                booking_id:  $(this).data('booking-id'),
            },
            success:function(response) {
                location.reload()
            },
        });
    });
</script>