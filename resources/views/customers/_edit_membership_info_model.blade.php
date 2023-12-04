
<h5 class="modal-title" id="myModalLabel">Edit Details </h5>
<div class="red-separator mb-10">
	<div class="container-fluid nopadding">
		<div class="row">	
			<div class="col-lg-6 col-md-6">
				<div class="modal-sub-title">
					<h4>Edit info for membership {{$booking_detail->business_services_with_trashed->program_name}}</h4>
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
		<div class="col-lg-12">
			<!-- Nav tabs -->
			<ul class="nav nav-tabs mb-3" role="tablist">
				<li class="nav-item">
					<a class="nav-link active" data-bs-toggle="tab" href="#Booking" role="tab" aria-selected="false">
						Current Booking Details
					</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" data-bs-toggle="tab" href="#Edit_section" role="tab" aria-selected="false">
						Edit Section 
					</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" data-bs-toggle="tab" href="#updated-sections" role="tab" aria-selected="false">
						Updated Sections 
					</a>
				</li>
			</ul>
			<!-- Tab panes -->
			<div class="tab-content  text-muted">
				<div class="tab-pane active" id="Booking" role="tabpanel">
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
									<span>{{$booking_detail->booking->order_id}} </span>
								</div>
							</div>
							
							<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 col-6">
								<div class="sub-info-customer">
									<label>Program Name: </label>
								</div>
							</div>
							<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 col-6">
								<div class="sub-info-customer">
									<span> {{$booking_detail->business_services_with_trashed->program_name}}</span>
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
									<label>Activity Type:</label>
								</div>
							</div>
							<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 col-6">
								<div class="sub-info-customer">
									<span>{{$booking_detail->business_services_with_trashed->sport_activity}}</span>
								</div>
							</div>
							
							<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 col-6">
								<div class="sub-info-customer">
									<label>Service Type:</label>
								</div>
							</div>
							<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 col-6">
								<div class="sub-info-customer">
									<span>{{$booking_detail->business_services_with_trashed->service_type}}</span>
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
				<div class="tab-pane" id="Edit_section" role="tabpanel">
					<div class="title-middle-part">
						<h4 class="edit-booking-title">Edit Section </h4>
						<p class="text-center">Use this section to edit the membership details you need below</p>
					</div>
					<div class="">
						<div class="row">
							<div class="col-md-12 col-xs-12 col-sm-12">
								<div class="bottom-border-sparetor sessions-no">
									<label>Number of sessions</label>
									<input class="form-control" type="text" id="editSession" name="editSession" placeholder="20" value="{{$booking_detail->pay_session}}">
								</div>
							</div>
							<div class="col-md-12 col-xs-12 col-sm-12">
								<div class="activation-date">
									<label>Membership Activation Date</label>
									<div class="date-activity-check">
										<div class="input-group">
											<input type="text" id="activation_select" name="contract_date" data-orginal-date="{{date('m/d/Y',strtotime($booking_detail->contract_date))}}" class="form-control border-0 dash-filter-picker width-flatpiker flatpiker-with-border flatpickr-input active flatpickr" value="{{date('m/d/Y',strtotime($booking_detail->contract_date))}}" readonly>
										</div>
									</div>
								</div>
							</div>

							<div class="col-md-12 col-xs-12 col-sm-12">
								<div class="membership-duration">
									<label>Membership Expiration</label>
								</div>
								<div class="input-group">
									<input type="text" class="form-control border-0 dash-filter-picker width-flatpiker flatpiker-with-border flatpickr-input active flatpickr" id="expiration_select" name="expired_at" data-orginal-date="{{date('m/d/Y',strtotime($booking_detail->expired_at))}}" readonly="readonly"  autocomplete="off" value="{{date('m/d/Y',strtotime($booking_detail->expired_at))}}">
								</div>
								<button type="button" class="btn btn-red membership-save float-end" id="" data-behavior="update_order_details" data-booking-detail-id = "{{$booking_detail->id}}" data-booking-id = "{{$booking_detail->booking_id}}" data-customer-id = "{{$customer_id}}">Save </button>
							</div>
						</div>
					</div>
				</div>
				<div class="tab-pane" id="updated-sections" role="tabpanel">
					<div class="title-sp-customer">
						<h4 class="edit-booking-title">Updated Sections </h4>
						<p class="text-center">Review the changes below. Changes are listed in red</p>
					</div>
					<div class="">
						<div class="row">
							<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 col-6">
								<label>Total Remaining</label>
							</div>
							<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 col-6">
								<div class="remaining-number">
									<span id="span_remaining_session">{{$booking_detail->getremainingsession()}}/{{$booking_detail->pay_session}}</span>
								</div>
							</div>
							
							<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 col-6">
								<div class="sub-info-customer">
									<label>Booking # </label>
								</div>
							</div>
							<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 col-6">
								<div class="sub-info-customer line-break">
									<span>{{$booking_detail->booking->order_id}}</span>
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
									<span id="editsession_span">{{$booking_detail->pay_session}}</span>
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
									<span><?php $a = json_decode($booking_detail->qty);
											if( !empty($a->adult) ){ echo 'Adult x '.$a->adult; }
											if( !empty($a->child) ){ echo '<br> Child x '.$a->child; }
											if( !empty($a->infant) ){ echo '<br>Infant x '.$a->infant; }
										?></span>
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
										?></span>
								</div>
							</div>
							
							<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 col-6">
								<div class="sub-info-customer">
									<label>Activity Type:</label>
								</div>
							</div>
							<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 col-6">
								<div class="sub-info-customer">
									<span>{{$booking_detail->business_services_with_trashed->sport_activity}}</span>
								</div>
							</div>
							
							<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 col-6">
								<div class="sub-info-customer">
									<label>Service Type:</label>
								</div>
							</div>
							<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 col-6">
								<div class="sub-info-customer">
									<span>{{$booking_detail->business_services_with_trashed->service_type}}</span>
								</div>
							</div>
							
							<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 col-6">
								<div class="sub-info-customer">
									<label>Membership Duration:</label>
								</div>
							</div>
							<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 col-6">
								<div class="sub-info-customer">
									<span id="span_membership_duration">{{$booking_detail->expired_duration}}</span>
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
									<span id="span_membership_activation" >{{date('m/d/Y',strtotime($booking_detail->contract_date))}}</span>
								</div>
							</div>
							
							<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 col-6">
								<div class="sub-info-customer">
									<label>Membership Expiration: </label>
								</div>
							</div>
							<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 col-6">
								<div class="sub-info-customer">
									<span id="span_membership_expiration" class="">{{date('m/d/Y',strtotime($booking_detail->expired_at))}}</span>
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
								<div class="">
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
			</div>
		</div>
	</div>
</div>


<script type="text/javascript">

	$("#expiration_select").change(function () { 
		if($(this).data('orginal-date') == $(this).val()){
			$('#span_membership_expiration').removeClass('font-red').html($(this).data('orginal-date'));	
		}else{
			$('#span_membership_expiration').addClass('font-red').html($(this).val());	
		}
	});
	$("#activation_select").change(function () { 
		if($(this).data('orginal-date') == $(this).val()){
			$('#span_membership_activation').removeClass('font-red').html($(this).data('orginal-date'));	
		}else{
			$('#span_membership_activation').addClass('font-red').html($(this).val());	
		}
	});

	$("#editSession").keyup(function () {
		if($(this).val() != undefined && $(this).val() != ''){
			$('#editsession_span').html($(this).val());
			$('#editsession_span').addClass('font-red');
			$('#span_remaining_session').addClass('font-red');
			$('#span_remaining_session').html('{{$booking_detail->getremainingsession()}}'+'/'+ $(this).val());
		}else{
			$('#editsession_span').html('{{$booking_detail->business_price_detail_with_trashed->pay_session}}');
			$('#span_remaining_session').html('{{$booking_detail->getremainingsession()}}/{{$booking_detail->business_price_detail_with_trashed->pay_session}}');
			$('#editsession_span').removeClass('font-red');
			$('#span_remaining_session').removeClass('font-red');
		}
	});
  
    $( ".flatpickr" ).flatpickr({ 
        dateFormat:'m/d/Y',
        maxDate:'01/01/2050'
    });

    $(document).on('click', "[data-behavior~=update_order_details]", function(e){
    	e.preventDefault();
        $.ajax({
            url: "/business/{{$business_id}}/orders/" + $(this).data('booking-detail-id'),
            type: "PATCH",
            data:{
                _token: '{{csrf_token()}}', 
                booking_id:  $(this).data('booking-id'),
                booking_detail_id: $(this).data('booking-detail-id'),
                customer_id:  $(this).data('customer-id'),
                pay_session: $('#editSession').val(),
                contract_date: $('#activation_select').val(),
                expired_at: $('#expiration_select').val()
            },
            success:function(response) {
                location.reload()
            },
        });
    });

</script>