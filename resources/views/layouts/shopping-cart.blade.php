<?php
	use App\UserBookingDetail;
	use App\BusinessServices;
	use App\BusinessService;
	use App\BusinessPriceDetails;
	use App\BusinessServiceReview;
	use App\User;
	use App\BusinessActivityScheduler;
	use App\CompanyInformation;
	use App\UserFamilyDetail;
    use App\BusinessTerms;
	use Carbon\Carbon;

    if(Auth::user()){
        $username = Auth::user()->firstname.' '.Auth::user()->lastname ;
    }else{
        $username = '';
    }
  
?>

<link rel="stylesheet" type="text/css" href="{{ url('public/css/creditcard.css') }}">

<div id="shopping-cart">
	<?php
    if (!empty($cart['cart_item'])) { ?>
    <form action="{{route('create-checkout-session')}}" method="POST">
    @csrf
	<!--<div class="container">-->
		<div class="row">
			<div class="col-sm-6 col-md-7 col-lg-7 ord-details">
				<h3>Order Details</h3>
                <?php $item_price=0; 
					foreach ($cart['cart_item'] as $item) { 
						$item_price = $item_price + $item["price"];
						if ($item['image']!="") {
							if (File::exists(public_path("/uploads/profile_pic/thumb/" . $item['image']))) {
								$profilePic = url('/public/uploads/profile_pic/thumb/' . $item['image']);
							} else {
								$profilePic = '/public/images/service-nofound.jpg';
							}
						}else{ $profilePic = '/public/images/service-nofound.jpg'; }
						
						$bookscheduler = BusinessActivityScheduler::where('serviceid', $item["code"])->limit(1)->orderBy('id', 'ASC')->get()->toArray();
						$act = BusinessServices::where('id', $item["code"])->get()->toArray();
						//DB::enableQueryLog();
						$ser = BusinessService::where('cid', $act[0]["cid"])->get()->toArray();
						$company = CompanyInformation::where('id', $act[0]["cid"])->get()->toArray();
                        $BusinessTerms = BusinessTerms::where('cid',$act[0]["cid"])->first();
                        $termcondfaqtext = $BusinessTerms->termcondfaqtext;
                        $contracttermstext = $BusinessTerms->contracttermstext;
                        $liabilitytext = $BusinessTerms->liabilitytext;
                        $covidtext = $BusinessTerms->covidtext;
                        $refundpolicytext = $BusinessTerms->refundpolicytext;
						//dd(\DB::getQueryLog());
						$serprice = BusinessPriceDetails::where('id', $item['priceid'])->limit(1)->orderBy('id', 'ASC')->get()->toArray();
						//print_r($ser[0]);
						$service_fee= ($item["price"] * 7)/100;
						$tax= ($item["price"] * 8.875)/100;
						$total_amount = $item["price"] + $service_fee + $tax;
						$iprice = number_format($total_amount,0, '.', '');
						//echo $total_amount.'---'.$iprice.'---'.$item["price"];
						
				?>
            		<input type="hidden" name="itemid[]" value="<?= $item["code"]; ?>" />
                    <input type="hidden" name="itemimage[]" value="<?= $profilePic ?>" />
                    <input type="hidden" name="itemname[]" value="<?= $item["name"]; ?>" />
                    <input type="hidden" name="itemqty[]" value="<?= $item["quantity"]; ?>" />
                    <input type="hidden" name="itemprice[]" value="<?= $iprice * 100; ?>" />
                    <div class="row">
                        <div class="col-lg-3">	
                            <div class="ord-img"> 
                                <img src="<?php echo $profilePic; ?>" alt="">
                            </div>
                        </div>
                        <div class="col-lg-9">
                            <div class="row">
                                <div class="col-lg-7">
                                    <div class="ord-info">
                                        <h4><?= $item["name"]; ?></h4>
                                        <!--<div class="info-display">
                                            <label>Payment Type:</label>
                                            <span>Day Tour</label>
                                        </div>	-->
                                        <div class="info-display">
                                            <label>Date Reserved:</label>
                                            <span><?php 
												if($item["sesdate"]!='' && $item["sesdate"]!='0')
												{
													echo date('l jS \of F Y', strtotime( $item["sesdate"] ));
												}
												else{ echo date('l jS \of F Y'); }
											 ?></label>
                                        </div>
                                        <?php
                                        if(@$bookscheduler[0]['shift_end']!=''){
											echo '<div class="info-display"><label>Time:</label><span>'.date('h:ia', strtotime( $bookscheduler[0]['shift_start'] )).' to '.date('h:ia', strtotime( $bookscheduler[0]['shift_end'] )).'</span></label></div>';
										} 
										?>
                                        
                                        <?php
                                        if(@$bookscheduler[0]['set_duration']!=''){
											$tm=explode(' ',$bookscheduler[0]['set_duration']);
											$hr=''; $min=''; $sec='';
											if($tm[0]!=0){ $hr=$tm[0].'hr. '; }
											if($tm[2]!=0){ $min=$tm[2].'min. '; }
											if($tm[4]!=0){ $sec=$tm[4].'sec.'; }
											if($hr!='' || $min!='' || $sec!='')
											{ echo '<div class="info-display"><label>Duration:</label><span>'.$hr.$min.$sec.'</span></label></div>'; } 
										} ?>
                                        <div class="info-display">
                                            <label>Participant #: </label>
                                            <span><?php echo $item["quantity"]; ?></label>
                                        </div>
                                        <div class="info-display">
                                            <label>Price Option: </label>
                                            <span><?php echo @$serprice[0]['pay_session'].' Sessions'; ?></label>
                                        </div>
                                        <div class="info-display">
                                            <label>Service Type:</label>
                                            <span> <?php echo @$act[0]['select_service_type']; ?></label>
                                        </div>
                                        <div class="info-display">
                                            <label>Activity:</label>
                                            <span><?php echo @$act[0]['sport_activity']; ?></label>
                                        </div>
                                        <div class="info-display">
                                            <label>Activity Location:</label>
                                            <span><?php echo @$act[0]['activity_location']; ?></label>
                                        </div>
                                        
                                        <div class="info-display">
                                            <label>Great For: </label>
                                            <span><?php echo @$act[0]['activity_for']; ?></label>
                                        </div>
                                        <div class="info-display">
                                            <label>Age: </label>
                                            <span><?php echo @$act[0]['age_range']; ?></label>
                                        </div>
                                        <div class="info-display">
                                            <label>Language: </label>
                                            <span><?php echo @$ser[0]['languages']; ?></label>
                                        </div>
                                        <div class="info-display">
                                            <label>Skill Level: </label>
                                            <span><?php echo @$act[0]['difficult_level']; ?></label>
                                        </div>
                                        <div class="info-display">
                                            <label>Membership Type: </label>
                                            <span><?php echo @$serprice[0]['membership_type']; ?></label>
                                        </div>
                                        <div class="info-display">
                                            <label>Business Type: </label>
                                            <span><?php
												if($act[0]['service_type']=='individual'){ echo 'Personal Training'; }
												else { echo ucfirst(@$act[0]['service_type']); } ?></label>
                                        </div>
                                        <div class="info-display">
                                            <label>Company: </label>
                                            <span><?php echo $company[0]['company_name']; ?></label>
                                        </div><!--
                                        <div class="info-display">
                                            <label>Instructor: </label>
                                            <span>Darryl Phipps</label>
                                        </div>
                                        <a href="#">View Your Itinerary</a>-->
                                        
                                    </div>
                                </div>
                                <div class="col-lg-5">
                                    <div class="price-section">
                                        <h4><?= "$ " . number_format($item["price"], 2); ?></h4>
                                    </div>
                                    <div class="invite-share">
                                    	<!--
                                        <span>Invite Others</span>
                                        <i class="fas fa-envelope email-icon-share"></i>
                                        <a class="send-mesg" href="#" title="" data-toggle="tooltip" data-original-title="Send Message"><i class="fa fa-comment"></i></a>
                                        <span class="pipe"> | </span>-->
                                      <!--   <i class="fas fa-pencil-alt p-red-color"></i> -->
                                        <a href="/removetocart?code=<?php echo $item["code"]; ?>" class="p-red-color">
                                        <i class="fas fa-trash-alt p-red-color"></i></a>
                                    </div>
                                    <!--<div class="gift-activity">
                                        <a href="#"><img src="/img/gift.png" alt="">Gift This Activity</a>
                                    </div>-->
                                    
                                    <?php if (Auth::user()) { ?>
                                    <div class="mtp-15">
                                    	<?php
											$family = UserFamilyDetail::where('user_id', Auth::user()->id)->get()->toArray();
											
											for($i=0; $i<$item["quantity"]; $i++)
											{ ?>
                                            <select class="select-participat familypart" name="participat[]" id="participats" onchange="familypart(this.value,'<?php echo $i; ?>')">
                                                <option value="">Who is participating?</option>
                                                <?php foreach($family as $fa){ 
													$age = date_diff(date_create($fa['birthday']), date_create('today'))->y;
												?>
                                                	<option value="<?php echo $fa['id']; ?>" 
                                                    data-name="<?php echo $fa['first_name'].' '.$fa['last_name']; ?>"
                                                    data-cnt="<?php echo $i; ?>" data-act="<?php echo $item["code"]; ?>"
                                                    data-age="<?php echo $age; ?>" >
													<?php echo $fa['first_name'].' '.$fa['last_name']; ?></option>
                                                <?php } ?>
                                            </select>
                                        <?php } ?>

                                    </div>
                                    
                                    <div class="mtp-15 info-details">
                                    	<?php
											for($i=0; $i<$item["quantity"]; $i++)
											{ ?>
                                        		<p id='part<?php echo $i.$item["code"]; ?>'></p>
                                        <?php } ?>
                                    </div>
                                    <?php } ?>
                                </div>
							</div>
							<div class="row">
                                <div class="col-md-12 divmargin cart-terms-dis">
                                	<h4> Terms: </h4>
                                    @if($termcondfaqtext != '')
                                        <a href="" data-toggle="modal" class="font-13" data-target="#termsModal_{{$act[0]['cid']}}">Terms, Conditions, FAQ</a> | @endif 
                                    
                                    @if($liabilitytext != '')
                                        <a href="" data-toggle="modal" class="font-13" data-target="#liabilityModal_{{$act[0]['cid']}}">Liability Waiver</a> | @endif 
                                    @if($covidtext != '')
                                        <a href="" data-toggle="modal" class="font-13" data-target="#covidModal_{{$act[0]['cid']}}">Covid - 19 Protocols</a> |
                                    @endif
                                    @if($contracttermstext != '')
                                        <a href="" data-toggle="modal" class="font-13" data-target="#contractModal_{{$act[0]['cid']}}">Contract Terms</a> | @endif 
                                    @if($refundpolicytext != '')
                                        <a href="" data-toggle="modal" class="font-13" data-target="#refundModal_{{$act[0]['cid']}}">Refund Policy</a> @endif 
                                </div>
                            </div>
                            <!--<div class="ord-conditions">
                                <p>This provider requires that you agree to some terms and conditions before booking this activity.</p>
                                <div class="radio-types">
                                    <input type="radio" id="html" name="fav_language" value="HTML">
                                    <label for="html">Liability Waiver</label><br>
                                    <input type="radio" id="css" name="fav_language" value="CSS">
                                    <label for="css">Covid-19 Protocols</label><br>
                                    <input type="radio" id="javascript" name="fav_language" value="JavaScript">
                                    <label for="javascript">Terms, Conditions, FAQ</label><br>
                                    <input type="radio" id="css" name="fav_language" value="CSS">
                                    <label for="css">Cancelation Policy</label><br>
                                    <input type="radio" id="javascript" name="fav_language" value="JavaScript">
                                    <label for="javascript">Refund Policy</label><br>
                                </div>
                            </div>-->
                        </div>
                    </div>
                    <script>
						function familypart11(val,cnt)
						{
							/*alert(val+'---'+cnt);
							console.log($(this).find(':selected').data('id'));
   							console.log($(this).children("option:selected").val());
							
							var counter = cnt+1;
							var txt= 'participant#'+counter+':';
							$('#part'+cnt).text(txt);*/
						}
						
						$('.familypart').change(function() {
							var name = $(this).find(':selected').data('name');
							var cnt = $(this).find(':selected').data('cnt');
							var act = $(this).find(':selected').data('act');
							var age = $(this).find(':selected').data('age');
   							var value = $(this).children("option:selected").val();
							var counter = cnt+1;
							var txt= 'participant#'+counter+': '+name+' ('+age+')';
							$('#part'+cnt+act).text(txt);
						});
					</script>
                    <div class="border-wid-sp"><div class="border-wid-grey"></div></div>
                    <div class="modal fade compare-model" id="termsModal_{{$act[0]['cid']}}">
                        <div class="modal-dialog modal-lg business">
                            <div class="modal-content">
                                <div class="modal-header">
									<div class="row">
										<div class="col-md-6 col-xs-8 titletext"> 
											<p>Terms, Conditions, FAQ</p>
										</div>
										<div class="col-md-6 col-xs-4">
											<div class="closebtn">
												<button type="button" class="close close-btn-design" data-dismiss="modal" aria-label="Close">
													<span aria-hidden="true">×</span>
												</button>
											</div>
										</div>
									</div>
                                </div>
                                <!-- Modal body -->
                                <div class="modal-body">
                                 <p>{{$termcondfaqtext}}</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="modal fade compare-model" id="contractModal_{{$act[0]['cid']}}">
                        <div class="modal-dialog modal-lg business">
                            <div class="modal-content">
                                <div class="modal-header"> 
									<div class="row">
										<div class="col-md-6 col-xs-8 titletext">
											<p>Contarct Terms</p>
										</div>
										<div class="col-md-6 col-xs-4">
											<div class="closebtn">
												<button type="button" class="close close-btn-design" data-dismiss="modal" aria-label="Close">
													<span aria-hidden="true">×</span>
												</button>
											</div>
										</div>
									</div>
                                </div>
                                <!-- Modal body -->
                                <div class="modal-body">
                                 <p>{{$contracttermstext}}</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="modal fade compare-model" id="liabilityModal_{{$act[0]['cid']}}">
                        <div class="modal-dialog modal-lg business">
                            <div class="modal-content">
                                <div class="modal-header">
									<div class="row">
										<div class="col-md-6 col-xs-8 titletext">
											<p>Liability Waiver</p>
										</div>
										<div class="col-md-6 col-xs-4">
											<div class="closebtn">
											   <button type="button" class="close close-btn-design" data-dismiss="modal" aria-label="Close">
													<span aria-hidden="true">×</span>
												</button>
											</div>
										</div>
									</div>
                                </div>
                                <!-- Modal body -->
                                <div class="modal-body">
                                    <p>{{$liabilitytext}}</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="modal fade compare-model" id="covidModal_{{$act[0]['cid']}}">
                        <div class="modal-dialog modal-lg business">
                            <div class="modal-content">
                                <div class="modal-header"> 
                                    <div class="row">
                                        <div class="col-md-6 col-xs-8 titletext">
                                            <p>Covid - 19 Protocols</p>
                                        </div>
                                        <div class="col-md-6 col-xs-4">
											<div class="closebtn">
												<button type="button" class="close close-btn-design" data-dismiss="modal" aria-label="Close">
													<span aria-hidden="true">×</span>
												</button>
											</div>
                                        </div>
                                    </div>
                                </div>
                                <!-- Modal body -->
                                <div class="modal-body">
                                 <p>{{$covidtext}}</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="modal fade compare-model" id="refundModal_{{$act[0]['cid']}}">
                        <div class="modal-dialog modal-lg business">
                            <div class="modal-content">
                                <div class="modal-header"> 
                                    <div class="row">
                                        <div class="col-md-6 col-xs-8 titletext">
                                            <p>Refund Policy</p>
                                        </div>
                                        <div class="col-md-6 col-xs-4">
                                            <div class="closebtn">
                                                <button type="button" class="close close-btn-design" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">×</span>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- Modal body -->
                                <div class="modal-body">
                                 <p>{{$refundpolicytext}}</p>
                                </div>
                            </div>
                        </div>
                    </div>

				<?php } ?>
				<div class="btn-ord-txt">
                	<a href="/instant-hire" class="post-btn-red">Add Activity or Product + </a>
				</div>
			</div>
            <?php
				$service_fee= ($item_price * 7)/100;
				$tax= ($item_price * 8.875)/100;
				$total_amount = $item_price + $service_fee + $tax;
			?>
			
			<div class="col-sm-6 col-md-5 col-lg-5 order-sum-rp">
				<div class="ord-summary">
					<h3>Order Summary</h3>
					<div class="sum-box">
						<div class="row">
							<div class="col-lg-6 col-xs-6 booking-txt-rs">
								<div class="inner-box-left"> 
									<label>Bookings</label>
									<label>Subtotal </label>
									<label>Service Fee <i class="fas fa-info-circle info-tooltip" id="tooltipex" data-placement="top" title="The fee helps support the Fitnessity Platform and covers a broad range of operating cost including insurance, background checks, and customer support."></i></label>
									<label>Tax: </label>
									<label>Shpping:</label>
								</div>
							</div>
							<div class="col-lg-6 col-xs-6 booking-txt-rs-left"> 
								<div class="inner-box-right"> 
									<span> <?php echo count($cart['cart_item']); ?> </span>
									<span> <?php echo "$ " . number_format($item_price, 2); ?> </span>
									<span> <?php echo "$ " .number_format($service_fee,2); ?> </span>
									<span> <?php echo "$ " .number_format($tax,2); ?> </span>
									<span> $0 </span>
								</div>
							</div>
						</div>
						<div class="border-wid-sp"><div class="border-wid-grey"></div></div>
						<div class="row"> 
							<div class="col-lg-6 col-xs-6">
								<div class="total-txt-left">
									<label>Grand Total:</label>
								</div>
							</div>
							<div class="col-lg-6 col-xs-6">
								<div class="total-grand">
									<span><?php echo "$ " . number_format($total_amount,2); ?> </span>
								</div>	
							</div>
						</div>
                        <div class="mt-20">
                        	<div class="terms-wrap">
                            <input type="checkbox" id="terms_condition" name="terms_condition" value="">
                            <p class="cart-terms"> The provider(s) require that you agree to some terms and conditions before booking this activity. 
                            <br /> <br /> By checking this box, you {{$username}} agree on <?php echo date('m/d/Y');?> to the terms the provider(s) require upon booking. You agree that you are 18+ to book this activity. You also agree to the Fitnessity privacy policy & terms of agreement. </p>
                            </div>
                            <div id="error_check" style="display: none;"><p class="alertcolor font-14 pl-25">Please select Terms & Conditions</p></div>
                            
                        </div>
                        
					</div>
					 
					<div class="col-md-12">
						<!-- <div class="payment-sec">
							<label>PAYMENT SELECTION</label>
							<div class="sacecard-title">SAVE CARDS 
                                <a href="#" class="edit-cart"> Edit</a> 
                            </div>
							<div class="row">
								<div class="col-md-6">
									<div class="choose-carts">
										<img src="https://development.fitnessity.co/public/images/newimage/cartvisa.jpg" alt="">
									</div>
								</div>
								<div class="col-md-6">
									<div class="choose-carts">
										<img src="https://development.fitnessity.co/public/images/newimage/cartmaster.jpg" alt="">
									</div>
								</div>
							</div>
							<div class="sacecard-title">OTHER PAYMENT METHODS </div>
							<button class="card-btns">Credit / Debit Card</button>
							<button class="card-btns">Paypal</button>
							<button class="card-btns">Venmo</button>
							<div class="row">
								<div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
									<div id="card-number-field" class="card-no">
										<label for="cardNumber">Card Number</label>
										<input required="" type="text" name="cardNumber" id="cardNumber" placeholder="0000 0000 0000 0000" class="form-control"> 
									</div>
								</div>
								<div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
									<div id="" class="card-no">
										<label for="owner">Name On Card</label>
                                        <input required type="text" name="owner" id="owner" placeholder="ENTER YOUR NAME HERE" class="form-control">
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
									<div id="expiration-date" class="card-no">
										<label for="owner">Expiry Date</label>
                                        <input required type="text" name="owner" id="owner" placeholder="MM/YY" class="form-control">
									</div>
								</div>
								<div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
									<div id="" class="card-no">
										<label for="cvv">CVV</label>
                                        <input required type="text" name="cvv" id="cvv" placeholder="- - -" class="form-control">
									</div>
								</div>
							</div>
						</div> -->
                        <div class="btn-ord-txt">
                            <button class="post-btn-red" type="submit" id="checkout-button">Check Out</button>
                        </div>
					</div>
				</div>
			</div>
		<!--</div>-->
        </form>
        <?php }else {?>
            <div class="row">
                <div class="col-sm-6 col-md-7 col-lg-7 ord-details">
                    <h3>Order Details</h3>
                    <div class="empty-cart"> 
                        <p>Your Cart Is Empty</p>
                    </div>
                    <div class="border-wid-sp"><div class="border-wid-grey"></div></div>
                    <div class="btn-ord-txt">
                        <a href="/instant-hire" class="post-btn-red">Add Activity or Product + </a>
                    </div>
                </div>
                <div class="col-sm-6 col-md-5 col-lg-5 order-sum-rp">
                    <div class="ord-summary-empty">
                        <h3>Order Summary</h3>
                        <div class="sum-box">
                            <div class="row">
                                <div class="col-lg-6 col-xs-6 booking-txt-rs">
                                    <div class="inner-box-left"> 
                                        <label>Bookings</label>
                                        <label>Subtotal </label>
                                        <label>Service Fee <i class="fas fa-info-circle info-tooltip" id="tooltipex" data-placement="top" title="The fee helps support the Fitnessity Platform and covers a broad range of operating cost including insurance, background checks, and customer support."></i></label>
                                        <label>Tax: </label>
                                        <label>Shpping:</label>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-xs-6 booking-txt-rs-left"> 
                                    <div class="inner-box-right"> 
                                        <span> </span>
                                        <span> </span>
                                        <span> </span>
                                        <span> </span>
                                        <span> </span>
                                    </div>
                                </div>
                            </div>
                            <div class="border-wid-sp"><div class="border-wid-grey"></div></div>
                            <div class="row"> 
                                <div class="col-lg-6 col-xs-6">
                                    <div class="total-txt-left">
                                        <label>Grand Total:</label>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-xs-6">
                                    <div class="total-grand">
                                        <span> </span>
                                    </div>  
                                </div>
                            </div>
                            <div class="mt-20">
                                <div class="terms-wrap">
                                <input type="checkbox" id="terms_condition" name="terms_condition" value="">
                                <p class="cart-terms"> The provider(s) require that you agree to some terms and conditions before booking this activity. 
                                <br> <br> By checking this box, you {{$username}} agree on <?php echo date('m/d/Y');?> to the terms the provider(s) require upon booking. You agree that you are 18+ to book this activity. You also agree to the Fitnessity privacy policy &amp; terms of agreement. </p>
                                </div>
                                <div id="error_check" style="display: none;"><p class="alertcolor font-14 pl-25">Please select Terms &amp; Conditions</p></div>
                                
                                <div class="btn-ord-txt">
                                    <button class="post-btn-red" type="submit" id="checkout-button">Check Out</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php } ?>
	</div>
	
    <?php /*?><a id="btnEmpty" href="/emptycart">Empty Cart</a><?php */?>
    <?php
    /*?>$total_quantity = 0;
    $total_price = 0;
    if (isset($cart['cart_item'])) {
        ?>	
        <form action="{{route('create-checkout-session')}}" method="POST">
            @csrf
            <table class="tbl-cart" cellpadding="10" cellspacing="1">
                <tbody>
                    <tr>
                        <th style="text-align:left;">Name</th>
                        <th style="text-align:left;">Type</th>
                        <th style="text-align:right;" width="5%">Quantity</th>
                        <th style="text-align:right;" width="10%">Unit Price</th>
                        <th style="text-align:right;" width="10%">Price</th>
                        <th style="text-align:center;" width="5%">Remove</th>
                    </tr>	
                    <?php
                    foreach ($cart['cart_item'] as $item) {
                        $item_price = $item["price"];
						if ($item['image']!="") {
							if (File::exists(public_path("/uploads/profile_pic/thumb/" . $item['image']))) {
								$profilePic = url('/public/uploads/profile_pic/thumb/' . $item['image']);
							} else {
								$profilePic = '/public/images/service-nofound.jpg';
							}
						}else{ $profilePic = '/public/images/service-nofound.jpg'; }
                        ?>
                    <input type="hidden" name="itemid[]" value="<?= $item["code"] ?>" />
                    <input type="hidden" name="itemimage[]" value="<?= $profilePic ?>" />
                    <input type="hidden" name="itemname[]" value="<?= $item["name"]; ?>" />
                    <input type="hidden" name="itemqty[]" value="<?= $item["quantity"]; ?>" />
                    <input type="hidden" name="itemprice[]" value="<?= $item_price * 100; ?>" />
                   <?php /*?><input type="hidden" name="itemprice[]" value="<?= number_format(floatval($item_price), 2) * 100; ?>" /> <?php */?><?php /*?>
                    <input type="hidden" name="itemtype[]" value="<?= $item["type"]; ?>" />
                    
                    <?php $itype='';
						if($item["type"]=='individual'){ $itype='Personal Trainer'; }
						else{ $itype=$item["type"]; }
					?>
                    
                    <tr>
                        <td><img src="<?= $profilePic ?>" class="cart-item-image" /><?= $item["name"]; ?></td>
                        <td><?= $itype; ?></td>
                        <td style="text-align:right;"><?= $item["quantity"]; ?></td>
                        <td  style="text-align:right;"><?= "$ " . $item["price"]/$item["quantity"]; ?></td>
                        <td  style="text-align:right;"><?= "$ " . number_format($item["price"], 2); ?></td>
                        <td style="text-align:center;"><a href="/removetocart?code=<?= $item["code"]; ?>" class="btnRemoveAction"><i class="fa fa-trash" title="Remove Item"></i></a></td>
                    </tr>
                    <?php
                    $total_quantity += (int) $item["quantity"];
					$total_price += $item["price"];
                    //$total_price += ((int) $item["quantity"] * (float) $item["price"]);
                }
                ?>
                <tr>
                    <td colspan="2" align="right">Total:</td>
                    <td align="right"><?php echo $total_quantity; ?></td>
                    <td align="right" colspan="2"><strong><?php echo "$ " . number_format($total_price, 2); ?></strong></td>
                    <td></td>
                </tr>
                <tr><td colspan="6">&nbsp;</td></tr>
                <tr>
                    <td colspan="6" align="center">
                        <a class="btn-style-one" style="float: left;" href="/instant-hire"><i class="fa fa-arrow-left"></i> Continue Shopping</a>
                        <button type="submit" class="btn-style-one" id="checkout-button" style="float:right;">Checkout</button>
                    </td>
                </tr>
                </tbody>
            </table>
        </form>
        <?php
    } else {
        ?>
        <div class="no-records">Your Cart is Empty</div>
        <?php
    }<?php */
    ?>
</div>
<style>
    #shopping-cart {margin: 40px;}
    #product-grid {margin: 40px;}
    #shopping-cart table {width: 100%;background-color: #F0F0F0;}
    #shopping-cart table td {background-color: #FFFFFF; padding: 8px 0px;}
    .txt-heading {color: #211a1a;border-bottom: 1px solid #E0E0E0;overflow: auto;}
    #btnEmpty {background-color: #ffffff;border: #d00000 1px solid;padding: 5px 10px;color: #d00000;float: right;text-decoration: none;border-radius: 3px;margin: 10px 0px;}
    .btnAddAction {padding: 5px 10px;margin-left: 5px;background-color: #efefef;border: #E0E0E0 1px solid;color: #211a1a;float: right;text-decoration: none;border-radius: 3px;cursor: pointer;}
    #product-grid .txt-heading {margin-bottom: 18px;}
    .product-item {float: left;background: #ffffff;margin: 30px 30px 0px 0px;border: #E0E0E0 1px solid;}
    .product-image {height: 155px;width: 250px;background-color: #FFF;}
    .clear-float {clear: both;}
    .demo-input-box {border-radius: 2px;border: #CCC 1px solid;padding: 2px 1px;}
    .tbl-cart {font-size: 0.9em;}
    .tbl-cart th { font-weight: bold; padding: 8px 5px; color: #fff; background-color: #f91942; }
    .product-title {margin-bottom: 20px;}
    .product-price {float:left;}
    .cart-action {float: right;}
    .product-quantity {padding: 5px 10px;border-radius: 3px;border: #E0E0E0 1px solid;}
    .product-tile-footer {padding: 15px 15px 0px 15px;overflow: auto;}
    .cart-item-image {width: 30px;height: 30px;border-radius: 50%;border: #E0E0E0 1px solid;padding: 5px;vertical-align: middle;margin-right: 15px;}
    .no-records {text-align: center;clear: both;margin: 38px 0px;}
	
	.tooltip .tooltip-inner{
		max-width:310px;
		padding:3px 8px;
		color:#000;
		text-align:center;
		background-color:red !important;
		-webkit-border-radius:5px;
		-moz-border-radius:5px;
		border-radius:5px
	}
    .alertcolor{
        color: red !important;
    }
</style>
<script src="{{ url('public/js/jquery.payform.min.js') }}" charset="utf-8"></script>

<script src="{{ url('public/js/creditcard.js') }}"></script>
<script>
    $( document ).ready(function() {
        $('#checkout-button').click(function(){
            var check = document.querySelector( 'input[name="terms_condition"]:checked');
            if(check == null) {
                $('#error_check').show();
                return false;
            }
        });
    });
$(function () {
  $('#tooltipex').tooltip()
})
</script>