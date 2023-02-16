<div class="row"> 
	<div class="col-lg-6 col-sm-6">
	   <h4 class="modal-title" style="text-align: left; color: #000; line-height: inherit; font-weight: 600; margin-top: 9px; margin-bottom: 12px;">Edit info for membership {{$booking_detail->business_services->program_name}}</h4>
	</div>
	<div class="col-lg-6 col-sm-6">
	   <h4 class="modal-title" style="text-align: end; color: #000; line-height: inherit; font-weight: 600; margin-top: 9px; margin-bottom: 12px;"> | Membership Status: <span class="green-fonts"> Active </span> </h4>
	</div>
	<div class="col-lg-12">
		<div class="client-info"></div>
	</div>
	
	<div class="col-md-12 col-xs-12 mobile-custom">
		<div class="view-customer">
			<ul class="nav nav-tabs" id="CustTab" role="tablist">
			  <li class="nav-item active">
				<a class="nav-link active" id="edit-details-info-tab" data-toggle="tab" href="#edit-details" role="tab" aria-controls="customer-info" aria-selected="true" aria-expanded="true">Edit Details</a>
			  </li>
			  <li class="nav-item">
				<a class="nav-link" id="void-refund" data-toggle="tab" href="#void" role="tab" aria-controls="visits" aria-selected="false" aria-expanded="false">Void or Refund </a>
			  </li>
			  <li class="nav-item">
				<a class="nav-link" id="suspend-terminate-tab" data-toggle="tab" href="#suspend-terminate" role="tab" aria-controls="account-details" aria-selected="false" aria-expanded="false">Suspend or Terminate</a>
			  </li>
			</ul>
		</div>
		<div class="tab-custom tab-content" id="myTabContent">
			<div class="tab-pane fade active" id="edit-details" role="tabpanel" aria-labelledby="edit-details-info-tab">
				<div class="row">
					<div class="col-md-5 col-xs-12 col-sm-12">
						<div class="title-sp-customer">
							<h4 class="edit-booking-title">Current Booking Details</h4>
							<p class="text-center">Review the membership details before any changes</p>
						</div>
						<div class="side-border-right">
							<div class="row">
								<div class="col-md-6 col-sm-6 col-xs-6">
									<label>Total Remaining</label>
								</div>
								<div class="col-md-6 col-sm-6 col-xs-6">
									<div class="remaining-number">
										<span>{{$booking_detail->getremainingsession()}}/{{$booking_detail->pay_session}}</span>
									</div>
								</div>
								
								<div class="col-md-6 col-sm-6 col-xs-6">
									<div class="sub-info-customer">
										<label>Booking # </label>
									</div>
								</div>
								<div class="col-md-6 col-sm-6 col-xs-6">
									<div class="sub-info-customer">
										<span>{{$booking_detail->booking->order_id}} </span>
									</div>
								</div>
								
								<div class="col-md-6 col-sm-6 col-xs-6">
									<div class="sub-info-customer">
										<label>Program Name: </label>
									</div>
								</div>
								<div class="col-md-6 col-sm-6 col-xs-6">
									<div class="sub-info-customer">
										<span> {{$booking_detail->business_services->program_name}}</span>
									</div>
								</div>
								
								<div class="col-md-6 col-sm-6 col-xs-6">
									<div class="sub-info-customer">
										<label>Catagory: </label>
									</div>
								</div>
								<div class="col-md-6 col-sm-6 col-xs-6">
									<div class="sub-info-customer">
										<span>{{$booking_detail->business_price_detail->business_price_details_ages->category_title}}</span>
									</div>
								</div>
								
								<div class="col-md-6 col-sm-6 col-xs-6">
									<div class="sub-info-customer">
										<label>Price Option:</label>
									</div>
								</div>
								<div class="col-md-6 col-sm-6 col-xs-6">
									<div class="sub-info-customer">
										<span>{{$booking_detail->business_price_detail->price_title}}</span>
									</div>
								</div>
								
								<div class="col-md-6 col-sm-6 col-xs-6">
									<div class="sub-info-customer">
										<label>Number of Sessions:</label>
									</div>
								</div>
								<div class="col-md-6 col-sm-6 col-xs-6">
									<div class="sub-info-customer">
										<span>{{$booking_detail->business_price_detail->pay_session}}</span>
									</div>
								</div>
								
								<div class="col-md-6 col-sm-6 col-xs-6">
									<div class="sub-info-customer">
										<label>Membership Option:</label>
									</div>
								</div>
								<div class="col-md-6 col-sm-6 col-xs-6">
									<div class="sub-info-customer">
										<span>{{$booking_detail->business_price_detail->membership_type}}</span>
									</div>
								</div>
								
								<div class="col-md-6 col-sm-6 col-xs-6">
									<div class="sub-info-customer">
										<label>Participant Quantity:</label>
									</div>
								</div>
								<div class="col-md-6 col-sm-6 col-xs-6">
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
								
								<div class="col-md-6 col-sm-6 col-xs-6">
									<div class="sub-info-customer">
										<label>Who's Participating:</label>
									</div>
								</div>
								<div class="col-md-6 col-sm-6 col-xs-6">
									<div class="sub-info-customer">
										<span>
                                        <?php $p = json_decode($booking_detail->participate);
										
										foreach($p[0] as $key=>$value)
										{
											if($key=='pc_name')
												echo $value;
										}
										if( !empty($p->pc_name) ){ echo $p->pc_name; }
										?><span>
									</div>
								</div>
								
								<div class="col-md-6 col-sm-6 col-xs-6">
									<div class="sub-info-customer">
										<label>Activity Type:</label>
									</div>
								</div>
								<div class="col-md-6 col-sm-6 col-xs-6">
									<div class="sub-info-customer">
										<span>{{$booking_detail->business_services->sport_activity}}</span>
									</div>
								</div>
								
								<div class="col-md-6 col-sm-6 col-xs-6">
									<div class="sub-info-customer">
										<label>Service Type:</label>
									</div>
								</div>
								<div class="col-md-6 col-sm-6 col-xs-6">
									<div class="sub-info-customer">
										<span>{{$booking_detail->business_services->service_type}}</span>
									</div>
								</div>
								
								<div class="col-md-6 col-sm-6 col-xs-6">
									<div class="sub-info-customer">
										<label>Membership Duration:</label>
									</div>
								</div>
								<div class="col-md-6 col-sm-6 col-xs-6">
									<div class="sub-info-customer">
										<span>{{$booking_detail->expired_duration}}</span>
									</div>
								</div>
								
								<div class="col-md-6 col-sm-6 col-xs-6">
									<div class="sub-info-customer">
										<label>Purchase Date:</label>
									</div>
								</div>
								<div class="col-md-6 col-sm-6 col-xs-6">
									<div class="sub-info-customer">
										<span>{{date('m/d/Y',strtotime($booking_detail->created_at))}}</span>
									</div>
								</div>
								
								<div class="col-md-6 col-sm-6 col-xs-6">
									<div class="sub-info-customer">
										<label>Membership Activation Date: </label>
									</div>
								</div>
								<div class="col-md-6 col-sm-6 col-xs-6">
									<div class="sub-info-customer">
										<span>{{date('m/d/Y',strtotime($booking_detail->contract_date))}}</span>
									</div>
								</div>
								
								<div class="col-md-6 col-sm-6 col-xs-6">
									<div class="sub-info-customer">
										<label>Membership Expiration: </label>
									</div>
								</div>
								<div class="col-md-6 col-sm-6 col-xs-6">
									<div class="sub-info-customer">
										<span>{{date('m/d/Y',strtotime($booking_detail->expired_at))}}</span>
									</div>
								</div>
								
								<div class="col-md-6 col-sm-6 col-xs-6">
									<div class="sub-info-customer tip-xp">
										<label>Tip Amount: </label>
									</div>
								</div>
								<div class="col-md-6 col-sm-6 col-xs-6">
									<div class="sub-info-customer tip-xp">
										<span>${{$booking_detail->getextrafees('tip')}}</span>
									</div>
								</div>
								
								<div class="col-md-6 col-sm-6 col-xs-6">
									<div class="sub-info-customer">
										<label>Discount: </label>
									</div>
								</div>
								<div class="col-md-6 col-sm-6 col-xs-6">
									<div class="sub-info-customer">
										<span>${{$booking_detail->getextrafees('discount')}}</span>
									</div>
								</div>
								
								<div class="col-md-6 col-sm-6 col-xs-6">
									<div class="sub-info-customer">
										<label>Tax:</label>
									</div>
								</div>
								<div class="col-md-6 col-sm-6 col-xs-6">
									<div class="sub-info-customer">
										<span>${{$booking_detail->getextrafees('tax')}}</span>
									</div>
								</div>
								
								<div class="col-md-6 col-sm-6 col-xs-6">
									<div class="tip-xp">
										<label>Total Amount Paid </label>
									</div>
								</div>
								<div class="col-md-6 col-sm-6 col-xs-6">
									<div class="remaining-number tip-xp">
										<span>${{$booking_detail->getperoderprice()}}</span>
									</div>
								</div>
								
							</div>
						</div>
					</div>
					
					<div class="col-md-2 nopadding">
						<div class="title-middle-part">
							<h4 class="edit-booking-title">Edit Section </h4>
							<p class="text-center">Use this section to edit the membership details you need below</p>
						</div>
						<div class="side-border-right">
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
											<input type="text"  id="membershipactivationdate" placeholder="Search By Date" class="form-control activity-scheduler-date w-80" autocomplete="off" value="{{date('m/d/Y',strtotime($booking_detail->contract_date))}}" onchange="changedate();">
										</div>
									</div>
								</div>
								<div class="col-md-12 col-xs-12 col-sm-12">
									<div class="membership-duration">
										<label>Membership Duration</label>
									</div>
									<div class="duration-date">
										<input class="form-control" type="text" id="editduration" name="editduration" placeholder="14" value="{{explode(' ' , $booking_detail->expired_duration)[0]}}">
										<h3>{{explode(" " , $booking_detail->expired_duration)[1]}}</h3>
										<select name="duration_select" id="duration_select" class="form-control nopadding">
											<option value="Years" @if(explode(" " , $booking_detail->expired_duration)[1] == 'Years') selected @endif >Years</option>
											<option value="Months" @if(explode(" " , $booking_detail->expired_duration)[1] == 'Months') selected @endif >Months</option>
											<option value="Weeks" @if(explode(" " , $booking_detail->expired_duration)[1] == 'Weeks') selected @endif >Weeks</option>
											<option value="Days" @if(explode(" " , $booking_detail->expired_duration)[1] == 'Days') selected @endif >Days</option>
										</select>
									</div>
									<input type="hidden" id="expire_duration" value="{{$booking_detail->expired_duration}}">
									<button type="button" class="btn-nxt btn-search-checkout mb-00 membership-save" id="" data-behavior="update_order_detail" data-booking-detail-id = "{{$booking_detail->id}}" data-booking-id = "{{$booking_detail->booking_id}}" data-customer-id = "{{$customer_id}}">Save </button>
								</div>
							</div>
						</div>
					</div>
					
					<div class="col-md-5 col-sm-12 col-xs-12">
						<div class="title-sp-customer">
							<h4 class="edit-booking-title">Updated Sections </h4>
							<p class="text-center">Review the changes below. Changes are listed in red</p>
						</div>
						<div class="">
							<div class="row">
								<div class="col-md-6 col-sm-6 col-xs-6">
									<label>Total Remaining</label>
								</div>
								<div class="col-md-6 col-sm-6 col-xs-6">
									<div class="remaining-number">
										<span id="span_remaining_session">{{$booking_detail->getremainingsession()}}/{{$booking_detail->pay_session}}</span>
									</div>
								</div>
								
								<div class="col-md-6 col-sm-6 col-xs-6">
									<div class="sub-info-customer">
										<label>Booking # </label>
									</div>
								</div>
								<div class="col-md-6 col-sm-6 col-xs-6">
									<div class="sub-info-customer">
										<span>{{$booking_detail->booking->order_id}}</span>
									</div>
								</div>
								
								<div class="col-md-6 col-sm-6 col-xs-6">
									<div class="sub-info-customer">
										<label>Program Name: </label>
									</div>
								</div> 
								<div class="col-md-6 col-sm-6 col-xs-6">
									<div class="sub-info-customer">
										<span>{{$booking_detail->business_services->program_name}}</span>
									</div>
								</div>
								
								<div class="col-md-6 col-sm-6 col-xs-6">
									<div class="sub-info-customer">
										<label>Catagory: </label>
									</div>
								</div>
								<div class="col-md-6 col-sm-6 col-xs-6">
									<div class="sub-info-customer">
										<span>{{$booking_detail->business_price_detail->business_price_details_ages->category_title}}</span>
									</div>
								</div>
								
								<div class="col-md-6 col-sm-6 col-xs-6">
									<div class="sub-info-customer">
										<label>Price Option:</label>
									</div>
								</div>
								<div class="col-md-6 col-sm-6 col-xs-6">
									<div class="sub-info-customer">
										<span>{{$booking_detail->business_price_detail->price_title}}</span>
									</div>
								</div>
								
								<div class="col-md-6 col-sm-6 col-xs-6">
									<div class="sub-info-customer">
										<label>Number of Sessions:</label>
									</div>
								</div>
								<div class="col-md-6 col-sm-6 col-xs-6">
									<div class="sub-info-customer">
										<span id="editsession_span">{{$booking_detail->pay_session}}</span>
									</div>
								</div>
								
								<div class="col-md-6 col-sm-6 col-xs-6">
									<div class="sub-info-customer">
										<label>Membership Option:</label>
									</div>
								</div>
								<div class="col-md-6 col-sm-6 col-xs-6">
									<div class="sub-info-customer">
										<span>{{$booking_detail->business_price_detail->membership_type}}</span>
									</div>
								</div>
								
								<div class="col-md-6 col-sm-6 col-xs-6">
									<div class="sub-info-customer">
										<label>Participant Quantity:</label>
									</div>
								</div>
								<div class="col-md-6 col-sm-6 col-xs-6">
									<div class="sub-info-customer">
										<span><?php $a = json_decode($booking_detail->qty);
                                        if( !empty($a->adult) ){ echo 'Adult x '.$a->adult; }
                                        if( !empty($a->child) ){ echo '<br> Child x '.$a->child; }
                                        if( !empty($a->infant) ){ echo '<br>Infant x '.$a->infant; }
                                    ?></span>
									</div>
								</div>
								
								<div class="col-md-6 col-sm-6 col-xs-6">
									<div class="sub-info-customer">
										<label>Who's Participating:</label>
									</div>
								</div>
								<div class="col-md-6 col-sm-6 col-xs-6">
									<div class="sub-info-customer">
										<span><?php $p = json_decode($booking_detail->participate);
										
										foreach($p[0] as $key=>$value)
										{
											if($key=='pc_name')
												echo $value;
										}
										if( !empty($p->pc_name) ){ echo $p->pc_name; }
										?></span>
									</div>
								</div>
								
								<div class="col-md-6 col-sm-6 col-xs-6">
									<div class="sub-info-customer">
										<label>Activity Type:</label>
									</div>
								</div>
								<div class="col-md-6 col-sm-6 col-xs-6">
									<div class="sub-info-customer">
										<span>{{$booking_detail->business_services->sport_activity}}</span>
									</div>
								</div>
								
								<div class="col-md-6 col-sm-6 col-xs-6">
									<div class="sub-info-customer">
										<label>Service Type:</label>
									</div>
								</div>
								<div class="col-md-6 col-sm-6 col-xs-6">
									<div class="sub-info-customer">
										<span>{{$booking_detail->business_services->service_type}}</span>
									</div>
								</div>
								
								<div class="col-md-6 col-sm-6 col-xs-6">
									<div class="sub-info-customer">
										<label>Membership Duration:</label>
									</div>
								</div>
								<div class="col-md-6 col-sm-6 col-xs-6">
									<div class="sub-info-customer">
										<span id="span_membership_duration">{{$booking_detail->expired_duration}}</span>
									</div>
								</div>
								
								<div class="col-md-6 col-sm-6 col-xs-6">
									<div class="sub-info-customer">
										<label>Purchase Date:</label>
									</div>
								</div>
								<div class="col-md-6 col-sm-6 col-xs-6">
									<div class="sub-info-customer">
										<span>{{date('m/d/Y',strtotime($booking_detail->created_at))}}</span>
									</div>
								</div>
								
								<div class="col-md-6 col-sm-6 col-xs-6">
									<div class="sub-info-customer">
										<label>Membership Activation Date: </label>
									</div>
								</div>
								<div class="col-md-6 col-sm-6 col-xs-6">
									<div class="sub-info-customer">
										<span id="span_membership_activation">{{date('m/d/Y',strtotime($booking_detail->contract_date))}}</span>
									</div>
								</div>
								
								<div class="col-md-6 col-sm-6 col-xs-6">
									<div class="sub-info-customer">
										<label>Membership Expiration: </label>
									</div>
								</div>
								<div class="col-md-6 col-sm-6 col-xs-6">
									<div class="sub-info-customer">
										<span  id="span_membership_activation">{{date('m/d/Y',strtotime($booking_detail->expired_at))}}</span>
									</div>
								</div>
								
								<div class="col-md-6 col-sm-6 col-xs-6">
									<div class="sub-info-customer tip-xp">
										<label>Tip Amount: </label>
									</div>
								</div>
								<div class="col-md-6 col-sm-6 col-xs-6">
									<div class="sub-info-customer tip-xp">
										<span>${{$booking_detail->getextrafees('tip')}}</span>
									</div>
								</div>
								
								<div class="col-md-6 col-sm-6 col-xs-6">
									<div class="sub-info-customer">
										<label>Discount: </label>
									</div>
								</div>
								<div class="col-md-6 col-sm-6 col-xs-6">
									<div class="sub-info-customer">
										<span>${{$booking_detail->getextrafees('discount')}}</span>
									</div>
								</div>
								
								<div class="col-md-6 col-sm-6 col-xs-6">
									<div class="sub-info-customer">
										<label>Tax:</label>
									</div>
								</div>
								<div class="col-md-6 col-sm-6 col-xs-6">
									<div class="sub-info-customer">
										<span>${{$booking_detail->getextrafees('tax')}}</span>
									</div>
								</div>
								
								<div class="col-md-6 col-sm-6 col-xs-6">
									<div class="tip-xp">
										<label>Total Amount Paid </label>
									</div>
								</div>
								<div class="col-md-6 col-sm-6 col-xs-6">
									<div class="remaining-number tip-xp">
										<span>${{$booking_detail->getperoderprice()}}</span>
									</div>
								</div>
								
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="tab-pane fade" id="void" role="tabpanel" aria-labelledby="void-refund">
				<div class="row">
					<div class="col-md-5 col-sm-12 col-xs-12">
						<div class="title-sp-customer">
							<h4 class="edit-booking-title">Current Booking Details</h4>
							<p class="text-center">Review the membership details before any changes</p>
						</div>
						<div class="side-border-right">
							<div class="row">
								<div class="col-md-6 col-sm-6 col-xs-6">
									<label>Total Remaining</label>
								</div>
								<div class="col-md-6 col-sm-6 col-xs-6">
									<div class="remaining-number">
										<span>{{$booking_detail->getremainingsession()}}/{{$booking_detail->pay_session}}</span>
									</div>
								</div>
								
								<div class="col-md-6 col-sm-6 col-xs-6">
									<div class="sub-info-customer">
										<label>Booking # </label>
									</div>
								</div>
								<div class="col-md-6 col-sm-6 col-xs-6">
									<div class="sub-info-customer">
										<span>{{$booking_detail->booking->order_id}} </span>
									</div>
								</div>
								
								<div class="col-md-6 col-sm-6 col-xs-6">
									<div class="sub-info-customer">
										<label>Program Name: </label>
									</div>
								</div>
								<div class="col-md-6 col-sm-6 col-xs-6">
									<div class="sub-info-customer">
										<span>{{$booking_detail->business_services->program_name}}</span>
									</div>
								</div>
								
								<div class="col-md-6 col-sm-6 col-xs-6">
									<div class="sub-info-customer">
										<label>Catagory: </label>
									</div>
								</div>
								<div class="col-md-6 col-sm-6 col-xs-6">
									<div class="sub-info-customer">
										<span>{{$booking_detail->business_price_detail->business_price_details_ages->category_title}}</span>
									</div>
								</div>
								
								<div class="col-md-6 col-sm-6 col-xs-6">
									<div class="sub-info-customer">
										<label>Price Option:</label>
									</div>
								</div>
								<div class="col-md-6 col-sm-6 col-xs-6">
									<div class="sub-info-customer">
										<span>{{$booking_detail->business_price_detail->price_title}}</span>
									</div>
								</div>
								
								<div class="col-md-6 col-sm-6 col-xs-6">
									<div class="sub-info-customer">
										<label>Number of Sessions:</label>
									</div>
								</div>
								<div class="col-md-6 col-sm-6 col-xs-6">
									<div class="sub-info-customer">
										<span>{{$booking_detail->business_price_detail->pay_session}}</span>
									</div>
								</div>
								
								<div class="col-md-6 col-sm-6 col-xs-6">
									<div class="sub-info-customer">
										<label>Membership Option:</label>
									</div>
								</div>
								<div class="col-md-6 col-sm-6 col-xs-6">
									<div class="sub-info-customer">
										<span>{{$booking_detail->business_price_detail->membership_type}}</span>
									</div>
								</div>
								
								<div class="col-md-6 col-sm-6 col-xs-6">
									<div class="sub-info-customer">
										<label>Participant Quantity:</label>
									</div>
								</div>
								<div class="col-md-6 col-sm-6 col-xs-6">
									<div class="sub-info-customer">
										<span>
                                        	<?php $a = json_decode($booking_detail->qty);
                                        if( !empty($a->adult) ){ echo 'Adult x '.$a->adult; }
                                        if( !empty($a->child) ){ echo '<br> Child x '.$a->child; }
                                        if( !empty($a->infant) ){ echo '<br>Infant x '.$a->infant; }
                                    ?></span>
									</div>
								</div>
								
								<div class="col-md-6 col-sm-6 col-xs-6">
									<div class="sub-info-customer">
										<label>Who's Participating:</label>
									</div>
								</div>
								<div class="col-md-6 col-sm-6 col-xs-6">
									<div class="sub-info-customer">
										<span><?php $p = json_decode($booking_detail->participate);
										
										foreach($p[0] as $key=>$value)
										{
											if($key=='pc_name')
												echo $value;
										}
										if( !empty($p->pc_name) ){ echo $p->pc_name; }
										?></span>
									</div>
								</div>
								
								<div class="col-md-6 col-sm-6 col-xs-6">
									<div class="sub-info-customer">
										<label>Membership Duration:</label>
									</div>
								</div>
								<div class="col-md-6 col-sm-6 col-xs-6">
									<div class="sub-info-customer">
										<span>{{$booking_detail->expired_duration}}</span>
									</div>
								</div>
								
								<div class="col-md-6 col-sm-6 col-xs-6">
									<div class="sub-info-customer">
										<label>Purchase Date:</label>
									</div>
								</div>
								<div class="col-md-6 col-sm-6 col-xs-6">
									<div class="sub-info-customer">
										<span>{{date('m/d/Y',strtotime($booking_detail->created_at))}}</span>
									</div>
								</div>
								
								<div class="col-md-6 col-sm-6 col-xs-6">
									<div class="sub-info-customer">
										<label>Membership Activation Date: </label>
									</div>
								</div>
								<div class="col-md-6 col-sm-6 col-xs-6">
									<div class="sub-info-customer">
										<span>{{date('m/d/Y',strtotime($booking_detail->contract_date))}}</span>
									</div>
								</div>
								
								<div class="col-md-6 col-sm-6 col-xs-6">
									<div class="sub-info-customer">
										<label>Membership Expiration: </label>
									</div>
								</div>
								<div class="col-md-6 col-sm-6 col-xs-6">
									<div class="sub-info-customer">
										<span>{{date('m/d/Y',strtotime($booking_detail->expired_at))}}</span>
									</div>
								</div>
								
								<div class="col-md-6 col-sm-6 col-xs-6">
									<div class="sub-info-customer tip-xp">
										<label>Tip Amount: </label>
									</div>
								</div>
								<div class="col-md-6 col-sm-6 col-xs-6">
									<div class="sub-info-customer tip-xp">
										<span>${{$booking_detail->getextrafees('tip')}}</span>
									</div>
								</div>
								
								<div class="col-md-6 col-sm-6 col-xs-6">
									<div class="sub-info-customer">
										<label>Discount: </label>
									</div>
								</div>
								<div class="col-md-6 col-sm-6 col-xs-6">
									<div class="sub-info-customer">
										<span>${{$booking_detail->getextrafees('discount')}}</span>
									</div>
								</div>
								
								<div class="col-md-6 col-sm-6 col-xs-6">
									<div class="sub-info-customer">
										<label>Tax:</label>
									</div>
								</div>
								<div class="col-md-6 col-sm-6 col-xs-6">
									<div class="sub-info-customer">
										<span>${{$booking_detail->getextrafees('tax')}}</span>
									</div>
								</div>
								
								<div class="col-md-6 col-sm-6 col-xs-6">
									<div class="tip-xp">
										<label>Total Amount Paid </label>
									</div>
								</div>
								<div class="col-md-6 col-sm-6 col-xs-6">
									<div class="remaining-number tip-xp">
										<span>${{$booking_detail->getperoderprice()}}</span>
									</div>
								</div>
								
							</div>
						</div>
					</div>
					
					<div class="col-md-7 col-sm-12 col-xs-12 nopadding">
						<div class="title-sp-customer">
							<h4 class="edit-booking-title">Edit Section </h4>
							<p class="text-center">Use this section to edit the membership details you need below</p>
						</div>
						<div class="radio-text">
							<form action="">
							<input type="radio" id="void" name="fav_language" value="HTML">
							  <label for="void">Void This Sale (Made a booking mistake? Training or testing a sale? You can void this membership.)</label>
							</form>
						</div>
						<div class="void-box">
							<div class="void-transaction">
								<p>Voiding this transaction will delete this record from your system, You will not be able to undo this once you agree to void.</p>
								<button type="button" class="btn-nxt mt-00" id=""  data-behavior="destroy_order_detail" data-booking-detail-id = "{{$booking_detail->id}}" data-booking-id = "{{$booking_detail->booking_id}}" data-customer-id = "{{$customer_id}}">Yes, Void This Sale</button>
							</div>
						</div>
						<div class="row">
							<div class="col-md-5 col-sm-5 col-xs-5">
								<div class="red-sparetor"></div>
							</div>
							<div class="col-md-2 col-sm-2 col-xs-2 text-center">
								<label> OR </label>
							</div>
							<div class="col-md-5 col-sm-5 col-xs-5">
								<div class="red-sparetor"></div>
							</div>
						</div>
						
						<div class="radio-text">
							<form action="">
							<input type="radio" id="void" name="fav_language" value="HTML">
							  <label for="void">Issue a Refund</label>
							</form>
						</div>
						<div class="refund-details"> 
							<label>Total Amount Paid: </label>
							<span> ${{$booking_detail->booking->amount}} (Original payment method: {{$booking_detail->booking->getstripecard()}}) </span>
						</div>
						<div class="refund-details"> 
							<label>Refund Issue Date: </label>
							<div class="date-activity-check refund-date">
								<input type="text"  id="refunddate" placeholder="Search By Date" class="form-control activity-scheduler-date w-80" autocomplete="off" value="{{date('m/d/Y')}}" >
							</div>
						</div>
						<div class="refund-details refund-amount"> 
							<label>Refund Amount:  </label>
							<input class="form-control" type="text" id="refund_amount" name="refund_amount" placeholder="20" value="">
							<h4>(Refund amount can’t be greater than the total amount paid)</h4>
						</div>
						<div class="refund-details refund-method"> 
							<label>Refund Method: </label>
							<textarea class="form-control" rows="2" name="refund_method" id="refund_method" placeholder="Refund Method" maxlength="500"></textarea>
						</div>
						<div class="refund-details text-center">
							<textarea class="form-control" rows="2" name="refund_reason" id="refund_reason" placeholder="Leave a note for the reason of the refund" maxlength="500"></textarea>
							<button type="button" class="btn-nxt mb-00 mt-00" id="" data-behavior="refund_order_detail" data-booking-detail-id = "{{$booking_detail->id}}" data-booking-id = "{{$booking_detail->booking_id}}" data-customer-id = "{{$customer_id}}">Issue The Refund</button>
						</div>
						
					</div>
				</div>
			</div>
			<div class="tab-pane fade" id="suspend-terminate" role="tabpanel" aria-labelledby="suspend-terminate-tab">
				<div class="row">
					<div class="col-md-5">
						<div class="title-sp-customer">
							<h4 class="edit-booking-title">Current Booking Details</h4>
							<p class="text-center">Review the membership details before any changes</p>
						</div>
						<div class="side-border-right">
							<div class="row">
								<div class="col-md-6 col-sm-6 col-xs-6 ">
									<label>Total Remaining</label>
								</div>
								<div class="col-md-6 col-sm-6 col-xs-6">
									<div class="remaining-number">
										<span>{{$booking_detail->getremainingsession()}}/{{$booking_detail->pay_session}}</span>
									</div>
								</div>
								 
								<div class="col-md-6 col-sm-6 col-xs-6">
									<div class="sub-info-customer">
										<label>Booking # </label>
									</div>
								</div>
								<div class="col-md-6 col-sm-6 col-xs-6">
									<div class="sub-info-customer">
										<span>{{$booking_detail->booking->order_id}} </span>
									</div>
								</div>
								
								<div class="col-md-6 col-sm-6 col-xs-6">
									<div class="sub-info-customer">
										<label>Program Name: </label>
									</div>
								</div>
								<div class="col-md-6 col-sm-6 col-xs-6">
									<div class="sub-info-customer">
										<span> {{$booking_detail->business_services->program_name}}</span>
									</div>
								</div>
								
								<div class="col-md-6 col-sm-6 col-xs-6">
									<div class="sub-info-customer">
										<label>Catagory: </label>
									</div>
								</div>
								<div class="col-md-6 col-sm-6 col-xs-6">
									<div class="sub-info-customer">
										<span>{{$booking_detail->business_price_detail->business_price_details_ages->category_title}}</span>
									</div>
								</div>
								
								<div class="col-md-6 col-sm-6 col-xs-6">
									<div class="sub-info-customer">
										<label>Price Option:</label>
									</div>
								</div>
								<div class="col-md-6 col-sm-6 col-xs-6">
									<div class="sub-info-customer">
										<span>{{$booking_detail->business_price_detail->price_title}}</span>
									</div>
								</div>
								
								<div class="col-md-6 col-sm-6 col-xs-6">
									<div class="sub-info-customer">
										<label>Number of Sessions:</label>
									</div>
								</div>
								<div class="col-md-6 col-sm-6 col-xs-6">
									<div class="sub-info-customer">
										<span>{{$booking_detail->business_price_detail->pay_session}}</span>
									</div>
								</div>
								
								<div class="col-md-6 col-sm-6 col-xs-6">
									<div class="sub-info-customer">
										<label>Membership Option:</label>
									</div>
								</div>
								<div class="col-md-6 col-sm-6 col-xs-6">
									<div class="sub-info-customer">
										<span>{{$booking_detail->business_price_detail->membership_type}}</span>
									</div>
								</div>
								
								<div class="col-md-6 col-sm-6 col-xs-6">
									<div class="sub-info-customer">
										<label>Participant Quantity:</label>
									</div>
								</div>
								<div class="col-md-6 col-sm-6 col-xs-6">
									<div class="sub-info-customer">
										<span><?php $a = json_decode($booking_detail->qty);
                                        if( !empty($a->adult) ){ echo 'Adult x '.$a->adult; }
                                        if( !empty($a->child) ){ echo '<br> Child x '.$a->child; }
                                        if( !empty($a->infant) ){ echo '<br>Infant x '.$a->infant; }
                                    ?></span>
									</div>
								</div>
								
								<div class="col-md-6 col-sm-6 col-xs-6">
									<div class="sub-info-customer">
										<label>Who's Participating:</label>
									</div>
								</div>
								<div class="col-md-6 col-sm-6 col-xs-6">
									<div class="sub-info-customer">
										<span><?php $p = json_decode($booking_detail->participate);
										
										foreach($p[0] as $key=>$value)
										{
											if($key=='pc_name')
												echo $value;
										}
										if( !empty($p->pc_name) ){ echo $p->pc_name; }
										?></span>
									</div>
								</div>
								
								<div class="col-md-6 col-sm-6 col-xs-6">
									<div class="sub-info-customer">
										<label>Activity Type:</label>
									</div>
								</div>
								<div class="col-md-6 col-sm-6 col-xs-6">
									<div class="sub-info-customer">
										<span>{{$booking_detail->business_services->sport_activity}}</span>
									</div>
								</div>
								
								<div class="col-md-6 col-sm-6 col-xs-6">
									<div class="sub-info-customer">
										<label>Service Type:</label>
									</div>
								</div>
								<div class="col-md-6 col-sm-6 col-xs-6">
									<div class="sub-info-customer">
										<span>{{$booking_detail->business_services->service_type}}</span>
									</div>
								</div>
								
								<div class="col-md-6 col-sm-6 col-xs-6">
									<div class="sub-info-customer">
										<label>Membership Duration:</label>
									</div>
								</div>
								<div class="col-md-6 col-sm-6 col-xs-6">
									<div class="sub-info-customer">
										<span>{{$booking_detail->expired_duration}}</span>
									</div>
								</div>
								
								<div class="col-md-6 col-sm-6 col-xs-6">
									<div class="sub-info-customer">
										<label>Purchase Date:</label>
									</div>
								</div>
								<div class="col-md-6 col-sm-6 col-xs-6">
									<div class="sub-info-customer">
										<span>{{date('m/d/Y',strtotime($booking_detail->created_at))}}</span>
									</div>
								</div>
								
								<div class="col-md-6 col-sm-6 col-xs-6">
									<div class="sub-info-customer">
										<label>Membership Activation Date: </label>
									</div>
								</div>
								<div class="col-md-6 col-sm-6 col-xs-6">
									<div class="sub-info-customer">
										<span>{{date('m/d/Y',strtotime($booking_detail->contract_date))}}</span>
									</div>
								</div>
								
								<div class="col-md-6 col-sm-6 col-xs-6">
									<div class="sub-info-customer">
										<label>Membership Expiration: </label>
									</div>
								</div>
								<div class="col-md-6 col-sm-6 col-xs-6">
									<div class="sub-info-customer">
										<span>{{date('m/d/Y',strtotime($booking_detail->expired_at))}}</span>
									</div>
								</div>
								
								<div class="col-md-6 col-sm-6 col-xs-6">
									<div class="sub-info-customer tip-xp">
										<label>Tip Amount: </label>
									</div>
								</div>
								<div class="col-md-6 col-sm-6 col-xs-6">
									<div class="sub-info-customer tip-xp">
										<span>${{$booking_detail->getextrafees('tip')}}</span>
									</div>
								</div>
								
								<div class="col-md-6 col-sm-6 col-xs-6">
									<div class="sub-info-customer">
										<label>Discount: </label>
									</div>
								</div>
								<div class="col-md-6 col-sm-6 col-xs-6">
									<div class="sub-info-customer">
										<span>${{$booking_detail->getextrafees('discount')}}</span>
									</div>
								</div>
								
								<div class="col-md-6 col-sm-6 col-xs-6">
									<div class="sub-info-customer">
										<label>Tax:</label>
									</div>
								</div>
								<div class="col-md-6 col-sm-6 col-xs-6">
									<div class="sub-info-customer">
										<span>${{$booking_detail->getextrafees('tax')}}</span>
									</div>
								</div>
								
								<div class="col-md-6 col-sm-6 col-xs-6">
									<div class="tip-xp">
										<label>Total Amount Paid </label>
									</div>
								</div>
								<div class="col-md-6 col-sm-6 col-xs-6">
									<div class="remaining-number tip-xp">
										<span>${{$booking_detail->getperoderprice()}}</span>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="col-md-7 nopadding">
						<div class="title-sp-customer">
							<h4 class="edit-booking-title">Edit Section </h4>
							<p class="text-center">Use this section to edit the membership details you need below</p>
						</div>
						<div class="radio-text">
							<form action="">
							<input type="radio" id="void" name="fav_language" value="HTML">
							  <label for="void">Suspend/Freeze (Seeting a membership or contract suspension will freeze this membership for a duration of time.)</label>
							</form>
						</div>
						<div class="refund-details refund-method"> 
							<label>Reason for Suspension: </label>
							<textarea class="form-control" rows="2" name="suspension_reason" id="suspension_reason" placeholder="Leave a note for the reason of the refund" maxlength="500"></textarea>
						</div>
						<div class="refund-details refund-method"> 
							<label>Suspension Start Date: </label>
							<div class="date-activity-check start-date">
								<input type="text"  id="suspensionstartdate" placeholder="Search By Date" class="form-control activity-scheduler-date w-80" autocomplete="off" value="{{date('m/d/Y')}}" onchange="changedate('simple');">
							</div>
							<label>Suspension End Date: </label>
							<div class="date-activity-check start-date">
								<input type="text"  id="suspensionenddate" placeholder="Search By Date" class="form-control activity-scheduler-date w-80" autocomplete="off" value="{{date('m/d/Y')}}" onchange="changedate('simple');">
							</div>
						</div>
						<div class="refund-details refund-amount"> 
							<label>Suspension Fee: </label>
							<input class="form-control" type="text" id="suspension_fee" name="suspension_fee" placeholder="$">
						</div>
						<div class="row">
							<div class="col-md-6 col-xs-12">
								<div class="refundcomment">
									<label>Leave a comment:</label>
									<textarea class="form-control" rows="2" name="suspension_comment" id="suspension_comment" placeholder="Leave a note for the reason of the refund" maxlength="500"></textarea>
								</div>
							</div>
							<div class="col-md-6 col-xs-12">
								<button type="button" class="btn-nxt suspend" id=""  data-behavior="suspend_order_detail" data-booking-detail-id = "{{$booking_detail->id}}"  data-booking-id = "{{$booking_detail->booking_id}}" data-customer-id = "{{$customer_id}}">Suspend/Freeze</button>
							</div>
						</div>
						<div class="row">
							<div class="col-md-5 col-xs-5 col-sm-5">
								<div class="red-sparetor"></div>
							</div>
							<div class="col-md-2 col-xs-2 col-sm-2 text-center">
								<label> OR </label>
							</div>
							<div class="col-md-5 col-xs-5 col-sm-5">
								<div class="red-sparetor"></div>
							</div>
						</div>
						
						<div class="radio-text">
							<form action="">
							<input type="radio" id="void" name="fav_language" value="HTML">
							  <label for="void">Terminate/Cancel (Terminate/Cancel this membership)	  </label>
							</form>
						</div>
						<div class="refund-details refund-method"> 
							<label>Reason for Termination:  </label>
							<textarea class="form-control" rows="2" name="terminate_reason" id="terminate_reason" placeholder="Leave a note for the reason of the refund" maxlength="500"></textarea>
						</div>
						<div class="refund-details refund-method"> 
							<label>Termination  Date:</label>
							<div class="date-activity-check start-date">
								<input type="text"  id="terminationdate" placeholder="Search By Date" class="form-control activity-scheduler-date w-80" autocomplete="off" value="{{date('m/d/Y')}}" onchange="changedate('simple');">
							</div>
						</div>
						<div class="refund-details refund-amount"> 
							<label>Termination Fee: </label>
							<input class="form-control" type="text" id="terminate_fee" name="terminate_fee" placeholder="$">
						</div>
						<div class="row">
							<div class="col-md-5 col-xs-12">
								<div class="refundcomment">
									<label>Leave a comment:</label>
									<textarea class="form-control" rows="2" name="terminate_comment" id="terminate_comment" placeholder="Leave a note for the reason of the refund" maxlength="500"></textarea>
								</div>
							</div>
							<div class="col-md-7 col-xs-12">
								<div class="refundcomment refund-note">
									<p>By clicking terminate, you will be removing all remaining contract & membership agreements, payment agreements & scheduled recurring payments. </p>
									<button type="submit" class="btn-nxt" id="" data-behavior="terminate_order_detail" data-booking-detail-id = "{{$booking_detail->id}}" data-booking-id = "{{$booking_detail->booking_id}}" data-customer-id = "{{$customer_id}}">Terminate</button>
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
	$("#editduration").keyup(function () { 
		$('#span_membership_duration').html($(this).val() +' '+ $('#duration_select').val());
		$('#expire_duration').val($(this).val() +' '+ $('#duration_select').val());
		$('#span_membership_duration').addClass('red-fonts');
	});

	$("#duration_select").change(function () { 
		$('#span_membership_duration').html($('#editduration').val()  +' '+  $(this).val());
		$('#span_membership_duration').addClass('red-fonts');
		$('#expire_duration').val($('#editduration').val()  +' '+  $(this).val());
	});

	$("#editSession").keyup(function () {
		if($(this).val() != undefined && $(this).val() != ''){
			$('#editsession_span').html($(this).val());
			$('#editsession_span').addClass('red-fonts');
			$('#span_remaining_session').addClass('red-fonts');
			$('#span_remaining_session').html('{{$booking_detail->getremainingsession()}}'+'/'+ $(this).val());
		}else{
			$('#editsession_span').html('{{$booking_detail->business_price_detail->pay_session}}');
			$('#span_remaining_session').html('{{$booking_detail->getremainingsession()}}/{{$booking_detail->business_price_detail->pay_session}}');
			$('#editsession_span').removeClass('red-fonts');
			$('#span_remaining_session').removeClass('red-fonts');
		}
	});

	$( function() {
        $( "#membershipactivationdate" ).datepicker( { 
        	autoclose: true,
            minDate: 0,
            changeMonth: true,
            changeYear: true   
        } );
    } );

    $( function() {
        $( "#refunddate" ).datepicker( { 
        	autoclose: true,
            minDate: 0,
            changeMonth: true,
            changeYear: true   
        } );
    } );
	 $( function() {
        $( "#suspensionstartdate" ).datepicker( { 
        	autoclose: true,
            minDate: 0,
            changeMonth: true,
            changeYear: true   
        } );
    } );
	$( function() {
        $( "#suspensionenddate" ).datepicker( { 
        	autoclose: true,
            minDate: 0,
            changeMonth: true,
            changeYear: true   
        } );
    } );
	$( function() {
        $( "#terminationdate" ).datepicker( { 
        	autoclose: true,
            minDate: 0,
            changeMonth: true,
            changeYear: true   
        } );
    } ); 

    $(document).on('click', "[data-behavior~=update_order_detail]", function(){
        $.ajax({
            url: "/business/{{$business_id}}/orders/" + $(this).data('booking-detail-id'),
            type: "PATCH",
            data:{
                _token: '{{csrf_token()}}', 
                booking_detail_id: $(this).data('booking-detail-id'),
                expire_duration: $('#expire_duration').val(),
                membershipactivationdate: $('#membershipactivationdate').val(),
                session: $('#editSession').val(),
                customer_id:  $(this).data('customer-id'),
                booking_id:  $(this).data('booking-id'),
            },
            success:function(response) {
                location.reload()
            },
        });
    });
	$(document).on('click', "[data-behavior~=refund_order_detail]", function(){
        $.ajax({
            url: "/business/{{$business_id}}/refund/",
            type: "POST",
            data:{
                _token: '{{csrf_token()}}', 
                booking_detail_id: $(this).data('booking-detail-id'),
                refund_reason: $('#refund_reason').val(),
                refunddate: $('#refunddate').val(),
                refund_amount: $('#refund_amount').val(),
                refund_method: $('#refund_method').val(),
                customer_id:  $(this).data('customer-id'),
                booking_id:  $(this).data('booking-id'),
            },
            success:function(response) {
                location.reload()
            },
        });
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


    $(document).on('click', "[data-behavior~=destroy_order_detail]", function(){
        $.ajax({
            url: "/business/{{$business_id}}/orders/" + $(this).data('booking-id'),
            method: "DELETE",
            data:{
                _token: '{{csrf_token()}}', 
                customer_id:  $(this).data('customer-id'),
                booking_detail_id:  $(this).data('booking-detail-id'),
            },
            success:function(response) {
                location.reload()
            },
        });
    });
</script>