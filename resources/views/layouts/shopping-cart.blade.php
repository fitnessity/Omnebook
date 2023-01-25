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
    use App\BusinessSubscriptionPlan;
	use Carbon\Carbon;
    use App\Repositories\BookingRepository;

    if(Auth::user()){
        $username = Auth::user()->firstname.' '.Auth::user()->lastname ;
    }else{
        $username = '';
    }
   /* echo"<pre>";*/  /*print_r($cart['cart_item']);*/ /*exit();*/
    $ajaxname = '';

    $fees = BusinessSubscriptionPlan::where('id',1)->first();

    $soldout_chk = 0;
    $bookings = new BookingRepository ;
?>

<link rel="stylesheet" type="text/css" href="{{ url('public/css/creditcard.css') }}">

<div id="shopping-cart">
	<?php
    if (!empty($cart['cart_item'])) { ?>
    <form action="{{route('create-checkout-session')}}" method="POST" class="validation" data-cc-on-file="false"  data-stripe-publishable-key="{{ env('STRIPE_PKEY') }}" id="payment-form">
        @csrf
    	<!--<div class="container">-->
    	<div class="row">
    		<div class="col-sm-6 col-md-7 col-lg-7 ord-details">
    			<h3>Order Details</h3>
                <?php $item_price = $discount =0;  
    				foreach ($cart['cart_item'] as $item) {
                        $totalquantity = 0;
                        $Sold_out = '';
                        $serprice = BusinessPriceDetails::where('id', $item['priceid'])->limit(1)->orderBy('id', 'ASC')->first();
                        $db_totalquantity = $bookings->gettotalbooking($item["actscheduleid"],$item["sesdate"]);
                      /*  print_r($item);exit();*/
                        if(!empty($item['adult'])){
                            $totalquantity += $item['adult']['quantity'];
                            /*echo $serprice['adult_discount'];
                            echo $item['adult']['price'];*/
                            $discount += ($item['adult']['price'] *$serprice['adult_discount'])/100; 
                        }
                        if(!empty($item['child'])){
                            $totalquantity += $item['child']['quantity'];
                           /* echo $serprice['child_discount'];
                            echo $item['child']['price'];*/
                            $discount += ($item['child']['price'] *$serprice['child_discount'])/100;
                        }
                        if(!empty($item['infant'])){
                            $totalquantity += $item['infant']['quantity'];
                            /*echo $serprice['infant_discount'];
                            echo $item['infant']['price'];*/
                            $discount += ($item['infant']['price'] *$serprice['infant_discount'])/100;
                        }

    					$item_price = $item_price + $item["totalprice"];
    					if ($item['image']!="") {
    						if (File::exists(public_path("/uploads/profile_pic/" . $item['image']))) {
    							$profilePic = url('/public/uploads/profile_pic/' . $item['image']);
    						} else {
    							$profilePic = url('/public/images/service-nofound.jpg');
    						}
    					}else{ $profilePic = url('/public/images/service-nofound.jpg'); }
    					
    					/*$bookscheduler = BusinessActivityScheduler::where('serviceid', $item["code"])->limit(1)->orderBy('id', 'ASC')->get()->toArray();*/
                        $bookscheduler = BusinessActivityScheduler::where('id', $item["actscheduleid"])->limit(1)->orderBy('id', 'ASC')->get()->toArray();

                        $tot_cart_qty = ($db_totalquantity + $totalquantity);
                        if( $bookscheduler[0]['spots_available'] <  $tot_cart_qty ){
                            $soldout_chk = 1;
                            $Sold_out = "Sold Out";
                        }
    					$act = BusinessServices::where('id', $item["code"])->first();
    					//DB::enableQueryLog();
                        $BusinessTerms = BusinessTerms::where('cid',$act["cid"])->first();
                        $termcondfaqtext = @$BusinessTerms->termcondfaqtext;
                        $contracttermstext = @$BusinessTerms->contracttermstext;
                        $liabilitytext = @$BusinessTerms->liabilitytext;
                        $covidtext = @$BusinessTerms->covidtext;
                        $refundpolicytext = @$BusinessTerms->refundpolicytext;
    					//dd(\DB::getQueryLog());
    					
    					$service_fee= ($item["totalprice"] * $fees->service_fee)/100;
    					$tax= ($item["totalprice"] * $fees->site_tax)/100;
    					$total_amount = $item["totalprice"] + $service_fee + $tax;
    					$iprice = number_format($total_amount,0, '.', '');
    					$daynum = '+'.@$serprice['pay_setnum'].' '.strtolower(@$serprice['pay_setduration']);
    					$expired_at  = date('m/d/Y', strtotime(date('Y-m-d'). $daynum ));
    					//echo $total_amount.'---'.$iprice.'---'.$item["price"];		
    			?>
            		<input type="hidden" name="itemid[]" value="<?= $item["code"]; ?>" />
                    <input type="hidden" name="itemimage[]" value="<?= $profilePic ?>" />
                    <input type="hidden" name="itemname[]" value="<?= $item["name"]; ?>" />
                    <input type="hidden" name="itemqty[]" value="1" />
                    <input type="hidden" name="itemprice[]" value="<?= $iprice * 100; ?>" />
                    <input type="hidden" name="itemparticipate[]" id="itemparticipate" value="" />
                    <div class="row">
                        <div class="col-md-12">
                            <label class="soldout-text">{{$Sold_out}}</label>
                        </div> 
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
										<div class="row">
											<div class="col-md-6">
												<div class="info-display">
													<label>Date Scheduled:</label>
												</div>
											</div>
											<div class="col-md-6">
												<div class="info-display info-align">
													<span>@if($item["sesdate"]!='' && $item["sesdate"]!='0') {{date('m/d/Y',strtotime($item["sesdate"]))}} @endif</span>
												</div>
											</div>
										</div>
                                        <?php
                                        if(@$bookscheduler[0]['set_duration']!=''){
                                            $tm=explode(' ',$bookscheduler[0]['set_duration']);
                                            $hr=''; $min=''; $sec='';
                                            if($tm[0]!=0){ $hr=$tm[0].'hr. '; }
                                            if($tm[2]!=0){ $min=$tm[2].'min. '; }
                                            if($tm[4]!=0){ $sec=$tm[4].'sec.'; }
                                            if($hr!='' || $min!='' || $sec!='')
                                            { $timeval = $hr.$min.$sec; } 
                                        }
                                        if(@$bookscheduler[0]['shift_end']!=''){
    										echo '<div class="row"><div class="col-md-6"> <div class="info-display"><label>Time & Duration:</label></div></div> <div class="col-md-6"> <div class="info-display info-align"> <span>'.date('h:ia', strtotime( $bookscheduler[0]['shift_start'] )).' to '.date('h:ia', strtotime( $bookscheduler[0]['shift_end'] )).' | '.$timeval.'</span></div></div></div>';
    									} 
    									?>
                                        
                                        <?php
                                        /*if(@$bookscheduler[0]['set_duration']!=''){
    										$tm=explode(' ',$bookscheduler[0]['set_duration']);
    										$hr=''; $min=''; $sec='';
    										if($tm[0]!=0){ $hr=$tm[0].'hr. '; }
    										if($tm[2]!=0){ $min=$tm[2].'min. '; }
    										if($tm[4]!=0){ $sec=$tm[4].'sec.'; }
    										if($hr!='' || $min!='' || $sec!='')
    										{ echo '<div class="info-display"><label>Duration:</label><span>'.$hr.$min.$sec.'</span></label></div>'; } 
    									} */?>
										<div class="row">
											<div class="col-md-6">
												<div class="info-display">
													<label>Category:</label>
												</div>
											</div>
											<div class="col-md-6">
												<div class="info-display info-align">
													<span>{{ @$serprice->business_price_details_ages->category_title}}</span>
												</div>
											</div>
										</div>
										
										<div class="row">
											<div class="col-md-6">
												<div class="info-display">
													<label>Price Option: </label>
												</div>
											</div>
											<div class="col-md-6">
												<div class="info-display info-align">
													<span>{{@$serprice['price_title']}}</span>
												</div>
											</div>
										</div>
										
										<div class="row">
											<div class="col-md-6">
												<div class="info-display">
													<label>Date Booked: </label>
												</div>
											</div>
											<div class="col-md-6">
												<div class="info-display info-align">
													<span>{{date('m/d/Y')}}</span>
												</div>
											</div>
										</div>

										<div class="row">
											<div class="col-md-6">
												<div class="info-display">
													<label>Number of Sessions: </label>
												</div>
											</div>
											<div class="col-md-6">
												<div class="info-display info-align">
													<span>{{@$serprice['pay_session']}} Sessions</span>
												</div>
											</div>
										</div>

										<div class="hide-part"> 
										
										<div class="row">
											<div class="col-md-6">
												<div class="info-display">
													<label>Membership Option: </label>
												</div>
											</div>
											<div class="col-md-6">
												<div class="info-display info-align">
													<span>{{@$serprice['membership_type']}}</span>
												</div>
											</div>
										</div>

										<div class="row">
											<div class="col-md-6">
												<div class="info-display">
													<label>Participant Quantity: </label>
												</div>
											</div>
											<div class="col-md-6">
												<div class="info-display info-align">
													<span>@if(!empty($item['adult'])) @if($item['adult']['quantity']  != 0) Adult x {{$item['adult']['quantity']}} @endif @endif</span> 
													<span>@if(!empty($item['child']))  @if($item['child']['quantity']  != 0) Children x {{$item['child']['quantity']}} @endif @endif</span>
													<span>@if(!empty($item['infant'])) @if($item['infant']['quantity'] != 0) Infant x {{$item['infant']['quantity'] }} @endif @endif</span>
												</div>
											</div>
										</div>
                                       
									   <div class="row">
											<div class="col-md-6">
												<div class="info-display">
													<label>Activity Type:</label>
												</div>
											</div>
											<div class="col-md-6">
												<div class="info-display info-align">
													<span>{{@$act['sport_activity']}}</span>
												</div>
											</div>
										</div>
										
										<div class="row">
											<div class="col-md-6">
												<div class="info-display">
													<label>Service Type:</label>
												</div>
											</div>
											<div class="col-md-6">	
												<div class="info-display info-align">
													<span> <?php echo @$act['select_service_type']; ?></span>
												</div>
											</div>
										</div>
											
										<div class="row">
											<div class="col-md-6">
												<div class="info-display">
													<label>Membership Duration: </label>
												</div>
											</div>
											<div class="col-md-6">	
												<div class="info-display info-align">
													<span>{{@$serprice['pay_setnum']}} {{@$serprice['pay_setduration']}}</span>
												</div>
											</div>
										</div>
										
										<div class="row">
											<div class="col-md-6">
												<div class="info-display">
													<label>Purchase Date: </label>
												</div>
											</div>
											<div class="col-md-6">	
												<div class="info-display info-align">
													<span>{{date('m/d/Y')}}</span>
												</div>
											</div>
										</div>

										<div class="row">
											<div class="col-md-6">
												<div class="info-display">
													<label>Membership Activation Date: </label>
												</div>
											</div>
											<div class="col-md-6">	
												<div class="info-display info-align">
													<span>{{date('m/d/Y')}}</span>
												</div>
											</div>
										</div>
									
										<div class="row">
											<div class="col-md-6">
												<div class="info-display">
													<label>Membership Expiration: </label>
												</div>
											</div>
											<div class="col-md-6">	
												<div class="info-display info-align">
													<span>{{$expired_at}}</span>
												</div>
											</div>
										</div>
                                        <!-- <div class="info-display">
                                            <label>Activity Location:</label>
                                            <span>{{@$act['activity_location']}}</label>
                                        </div>
                                        
                                        <div class="info-display">
                                            <label>Great For: </label>
                                            <span>{{@$act['activity_for']}}</label>
                                        </div>
                                        <div class="info-display">
                                            <label>Age: </label>
                                            <span>{{@$act['age_range']}}</label>
                                        </div>
                                        <div class="info-display">
                                            <label>Language: </label>
                                            <span></label>
                                        </div>
                                        <div class="info-display">
                                            <label>Skill Level: </label>
                                            <span>{{@$act['difficult_level']}}</label>
                                        </div>
                                        
                                        <div class="info-display">
                                            <label>Business Type: </label>
                                            <span><?php
    											/*if($act['service_type']=='individual'){ echo 'Personal Training'; }
    											else { echo ucfirst(@$act['service_type']); }*/ ?></label>
                                        </div> -->
										<div class="row">
											<div class="col-md-6">
												<div class="info-display">
													<label>Provider Company: </label>
												</div>
											</div>
											<div class="col-md-6">	
												<div class="info-display info-align">
													<span>{{$act->company_information->company_name}}</span>
												</div>
											</div>
										</div>
										</div>
										<div class="show-more-cart"><a class="show-more">Show More</a></div>
										
											<!--
                                        <div class="info-display">
                                            <label>Instructor: </label>
                                            <span>Darryl Phipps</label>
                                        </div>
                                        <a href="#">View Your Itinerary</a>-->
                                    </div>
                                </div>
                                <div class="col-lg-5">
                                    <div class="price-section">
                                        <h4><?= "$ " . number_format($item["totalprice"], 2); ?></h4>
                                    </div>
                                    <div class="invite-share">
                                    	<!--<span>Invite Others</span>
                                        <i class="fas fa-envelope email-icon-share"></i>
                                        <a class="send-mesg" href="#" title="" data-toggle="tooltip" data-original-title="Send Message"><i class="fa fa-comment"></i></a>
                                        <span class="pipe"> | </span>-->
                                      <!--   <i class="fas fa-pencil-alt p-red-color"></i> -->
                                       <i class="fas fa-share-alt"></i> <a href="/removetocart?priceid=<?php echo $item["priceid"]; ?>" class="p-red-color">
										 <i class="fas fa-trash-alt p-red-color"></i></a>
                                    </div>
                                    <!--<div class="gift-activity">
                                        <a href="#"><img src="/img/gift.png" alt="">Gift This Activity</a>
                                    </div>-->
                                    
                                    <?php if (Auth::user()) { ?>
                                    <label class="text-center participaingtxt">Select Who's Participating</label>
                                    <div class="">
                                    	<?php
    										$family = UserFamilyDetail::where('user_id', Auth::user()->id)->get()->toArray();
    										
    										for($i=0; $i<$totalquantity ; $i++)
    										{ ?>
                                            <select class="select-participat familypart" name="participat[]" id="participats" onchange="familypart(this.value,'<?php echo $i; ?>')">
                                                <option value="{{Auth::user()->id}}" data-cnt="<?php echo $i; ?>" data-act="<?php echo $item["code"]; ?>" data-type="user">Choose or Add Participant</option>
                                                <option value="{{Auth::user()->id}}" data-cnt="<?php echo $i; ?>" data-act="<?php echo $item["code"]; ?>" data-type="user">{{Auth::user()->firstname}} {{ Auth::user()->lastname }}</option>
                                                <?php foreach($family as $fa){ 

                                                   /* $date_now = date_create();
                                                    $birthday = new DateTime($fa['birthday']);
                                                    $age = $date_now->diff($birthday)->y;*/
    												/*$age = date_diff($birthday,  $date_now)->y;*/
                                                   /* echo $age;  */  											?>   
                                                	<option value="<?php echo $fa['id']; ?>" 
                                                        data-name="<?php echo $fa['first_name'].' '.$fa['last_name']; ?>"
                                                        data-cnt="<?php echo $i; ?>" data-act="<?php echo $item["code"]; ?>" data-age="<?php /*echo $age;*/ ?>" @if(@$item['participate'][$i]['id'] == $fa['id']) selected @endif data-type="family">
                                                        <?php echo $fa['first_name'].' '.$fa['last_name']; ?></option>
                                                <?php } ?>
                                            </select> 
                                        <?php } ?>

                                    </div>
                                    <?php 
                                        $participatearray = [];
                                    ?>
                                    <div class="mtp-15 info-details participaingdiv{{$item['code']}}">
                                    	<?php
                                            $ajaxname = Auth::user()->firstname.' '.Auth::user()->lastname;
    										for($i=0; $i<$totalquantity; $i++)
    										{ 
                                                $family = UserFamilyDetail::where('id',@$item['participate'][$i]['id'])->first(); ?>
                                        		<p id='part<?php echo $i.$item["code"]; ?>'>
                                                    participant#{{$i+1}}:  @if(@$item['participate'][$i]['from'] == 'user') {{Auth::user()->firstname}} {{ Auth::user()->lastname }}  @else {{@$family->first_name}} {{ @$family->last_name}} @endif
                                                </p>
                                        <?php 
                                            } 
                                        ?>
                                    </div>
                                    <?php } 
                                    ?>
                                    <div class="select-sparetor">
                                        <input class="payfor" type="checkbox" id="payforcheckbox{{$item['priceid']}}" name="payforcheckbox" value="" onclick="opengiftpopup()">
                                        <label class="payfor-label" for="payforcheckbox">Paying or gifting for someone?</label>
                                        <p class="payfor-ptag">Share the booking details with them</p>
										<div class="btn-ord-txt">
											<a href="#" class="post-btn-red" data-toggle="modal" data-target="#leavegift" style="display:none;" id="giftanotheralink"></a>
										</div>
										<script type="text/javascript">
											function opengiftpopup(){
											var checkBox = document.getElementById("payforcheckbox{{$item['priceid']}}");
												if (checkBox.checked == true){
												    $('#giftanotheralink').click();
												}
											}
										</script>
                                    </div>
                                </div>
    						</div>
    						<div class="row">
                                <div class="col-md-12 divmargin cart-terms-dis">
                                    @if($termcondfaqtext != '' || $liabilitytext != '' || $covidtext != '' || $contracttermstext != '' || $refundpolicytext != '')
                                    	<h4 class="termsdetails"> Terms: </h4> <span class="termsdetails"> View the terms and conditions from this provider below </span>
                                        <div>
                                            @if($termcondfaqtext != '')
                                                <a href="" data-toggle="modal" class="font-13" data-target="#termsModal_{{$act['cid']}}">Terms, Conditions, FAQ</a> | @endif 
                                            
                                            @if($liabilitytext != '')
                                                <a href="" data-toggle="modal" class="font-13" data-target="#liabilityModal_{{$act['cid']}}">Liability Waiver</a> | @endif 
                                            @if($covidtext != '')
                                                <a href="" data-toggle="modal" class="font-13" data-target="#covidModal_{{$act['cid']}}">Covid - 19 Protocols</a> |
                                            @endif
                                            @if($contracttermstext != '')
                                                <a href="" data-toggle="modal" class="font-13" data-target="#contractModal_{{$act['cid']}}">Contract Terms</a> | @endif 
                                            @if($refundpolicytext != '')
                                                <a href="" data-toggle="modal" class="font-13" data-target="#refundModal_{{$act['cid']}}">Refund Policy</a> @endif
                                        </div> 
                                    @endif
                                </div>
                            </div>
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
                            var type = $(this).find(':selected').data('type');
    						/*var age = $(this).find(':selected').data('age');*/
    						var value = $(this).children("option:selected").val();
    						var counter = cnt+1;
    						//var txt= 'participant#'+counter+': '+name+' ('+age+')';
                            
                            if(name == undefined){
                                name = '{{$ajaxname}}';
                            }
                            
                            
                            var txt= 'participant#'+counter+': '+name;
    						$('#part'+cnt+act).text(txt);
                           
                            var _token = $('meta[name="csrf-token"]'). attr('content');
                            $.ajax({
                                type: 'POST',
                                url: '{{route("form_participate")}}',
                                data: {
                                    _token: _token,
                                    act: act,
                                    familyid: value,
                                    counter: cnt,
                                    type: type,
                                },
                                success: function (data) {
                                    $(".participaingdiv"+act).load(" .participaingdiv"+act+">*");
                                }
                            });
    					});
    				</script>
                    <div class="border-wid-sp"><div class="border-wid-grey"></div></div>
                    <div class="modal fade compare-model" id="termsModal_{{$act['cid']}}">
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

                    <div class="modal fade compare-model" id="contractModal_{{$act['cid']}}">
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

                    <div class="modal fade compare-model" id="liabilityModal_{{$act['cid']}}">
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

                    <div class="modal fade compare-model" id="covidModal_{{$act['cid']}}">
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

                    <div class="modal fade compare-model" id="refundModal_{{$act['cid']}}">
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
                    	<a href="/activities" class="post-btn-red">Book Another Activity</a>
    			    </div>
    		</div>
            <?php
    			$service_fee= ($item_price * $fees->service_fee)/100;
    			$tax= ($item_price * $fees->site_tax)/100;
    			$total_amount = $item_price + $service_fee + $tax - $discount;
    		?>
    		<input type="hidden" name="grand_total" id="total_amount" value="{{$total_amount}}">
    		<div class="col-sm-6 col-md-5 col-lg-5 order-sum-rp">
    			<div class="ord-summary">
    				<h3>Order Summary</h3>
    				<div class="sum-box">
    					<div class="row">
    						<div class="col-lg-6 col-xs-6 booking-txt-rs">
    							<div class="inner-box-left"> 
    								<label>Bookings</label>
    								<label>Subtotal </label>
    								<!-- <label>Service Fee <i class="fas fa-info-circle info-tooltip" id="tooltipex" data-placement="top" title="The fee helps support the Fitnessity Platform and covers a broad range of operating cost including insurance, background checks, and customer support."></i></label> -->
    								<label>Taxes & Fees: </label>
                                    <label>Discount: </label>
    								<label>Shpping:</label>
    							</div>
    						</div>
    						<div class="col-lg-6 col-xs-6 booking-txt-rs-left"> 
    							<div class="inner-box-right"> 
    								<span> <?php echo count($cart['cart_item']); ?> </span>
    								<span> <?php echo "$ " . number_format($item_price, 2); ?> </span>
    								<!-- <span> <?php /*echo "$ " .number_format($service_fee,2);*/ ?> </span> -->
    								<span> <?php echo "$ " .(number_format(($tax + $service_fee),2)); ?> </span>
    								<span> {{number_format($discount,2)}} </span>
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
    					<div class="payment-sec">
                            @if(!empty($cardInfo)) 
        						<label>PAYMENT SELECTION</label>
        						<div class="sacecard-title">SAVE CARDS 
                                    <a href="/personal-profile/payment-info" class="edit-cart"> Edit</a> 
                                </div>
        						<div class="row">
                                    @foreach($cardInfo as $card) 
                                        @php $brandname = strtolower($card['brand']); @endphp
                                        <div class="col-md-6">
                                            <label class="pay-card" style="color:#ffffff; background-image: url(/public/img/visa-card-bg.jpg );">
                                                <input name="cardinfo" class="payment-radio" type="radio" value ="{{$card['id']}}">
                                                <span class="plan-details">
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div class="cart-name">
                                                                <span>{{$brandname}}</span>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-12">
                                                            <div class="cart-num">
                                                                <span>XXXX XXXX XXXX {{$card['last4']}}</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </span>
                                            </label>
                                        </div>
                                    @endforeach
        						</div>
                            @endif
    						<div class="sacecard-title">OTHER PAYMENT METHODS </div>
    						<button class="card-btns" type="button">Credit / Debit Card</button>
    						<!-- <button class="card-btns">Paypal</button>
    						<button class="card-btns">Venmo</button> -->
                            <div > 
        						<div class="row" >
        							<div class="col-xl-6 col-lg-6 col-md-6 col-sm-12  required">
        								<div id="card-number-field" class="card-no ">
        									<label for="cardNumber">Card Number</label>
        									<input  type="text" name="cardNumber" id="cardNumber" placeholder="0000 0000 0000 0000" class="form-control card-num" > 
        								</div>
        							</div>
        							<div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 required" >
        								<div id="" class="card-no">
        									<label for="owner">Name On Card</label>
                                            <input type="text" name="owner" id="owner" placeholder="ENTER YOUR NAME HERE" class="form-control">
        								</div>
        							</div>
        						</div>
        						<div class="row">
        							<div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 expiration required">
        								<div id="expiration-date" class="card-no">
        									<label for="owner">Exp Month</label>
                                            <input type="text" name="month" id="month" placeholder="MM" class="form-control card-expiry-month">
        								</div>
        							</div>
                                    <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 expiration required">
                                        <div id="expiration-date" class="card-no">
                                            <label for="owner">Exp Year</label>
                                            <input  type="text" name="year" id="year" placeholder="YYYY" class="form-control card-expiry-year">
                                        </div>
                                    </div>
        							<div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 cvc required">
        								<div id="" class="card-no">
        									<label for="cvv">CVV</label>
                                            <input  type="text" name="cvv" id="cvv" placeholder="- - -" class="form-control card-cvc">
        								</div>
        							</div>
                                    <div class="col-md-12">
                                        <div class="save-pmt-checkbox">
                                            <input type="checkbox" id="save_card" name="save_card" value="1">
                                            <label>Save for future payments</label>
                                        </div>
                                    </div>
                                    
                                    <div class='form-row row'>
                                        <div class='col-md-12 hide error form-group'>
                                            <div class='alert-danger alert'>Fix the errors before you begin.</div>
                                        </div>
                                    </div>
        						</div>
                            </div>
    					</div>
                        <div class="btn-ord-txt">
                            <button class="post-btn-red" type="submit" id="checkout-button" @if($soldout_chk == 1) disabled @endif>Check Out</button>
                        </div>
    				</div>
    			</div>
    		</div>
    	</div>
        <!--</div> -->
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
                    <a href="/activities" class="post-btn-red">Add Activity or Product + </a>
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
                                    <!-- <label>Service Fee <i class="fas fa-info-circle info-tooltip" id="tooltipex" data-placement="top" title="The fee helps support the Fitnessity Platform and covers a broad range of operating cost including insurance, background checks, and customer support."></i></label> -->
                                    <label>Taxes & Fees:</label>
                                    <label>Discount: </label>
                                    <label>Shpping:</label>
                                </div>
                            </div>
                            <div class="col-lg-6 col-xs-6 booking-txt-rs-left"> 
                                <div class="inner-box-right"> 
                                    <span> 0 </span>
                                    <span> $ 0.00 </span>
                                   <!--  <span> $ 0.00 </span> -->
                                    <span> $ 0.00 </span>
                                    <span> $ 0.00 </span>
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
                                    <span>$ 0.00  </span>
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
							if (File::exists(public_path("/uploads/profile_pic/" . $item['image']))) {
								$profilePic = url('/public/uploads/profile_pic/' . $item['image']);
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

<!-- The Modal Add Business-->
<div class="modal fade compare-model" id="leavegift">
    <div class="modal-dialog modal-lg giftsmodals">
        <div class="modal-content">
			<div class="modal-header" style="text-align: right;"> 
			  	<div class="closebtn">
					<button type="button" class="close close-btn-design" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">×</span>
					</button>
				</div>
			</div>

            <!-- Modal body -->
            <div class="modal-body">
				<div class="row contentPop"> 
					<div class="col-lg-12 nopadding">
					   <h4 class="modal-title" style="text-align: left; color: #000; line-height: inherit; font-weight: 600;">Leave a gift for your friends and family</h4>
					   <hr style="border: 8px solid #df0003; width: 80%; margin-left: -16px;">
					</div>
					<div class="row">
						<div class="col-lg-2">
							<div class="activity-title-img">
								<img src="http://dev.fitnessity.co/public/uploads/profile_pic/1667542553-Aerial-View.jpg" alt="Avatar" class="avatar">
							</div>
						</div>
						<div class="col-lg-10">
							<div class="activity-details">
								<h3>Valor MMA Personal Training Sessions</h3>
								<p>We will include all of the booking details in the email your guest will receive</p>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-lg-6">
							<div class="gift-comments">
								<label>Leave a comment for them</label>
								<textarea class="form-control" rows="4"  name="Aboutcompany" id="" maxlength="150"></textarea>
								<label>From:</label>
								<input type="name" class="form-control myemail" name="name" autocomplete="off" placeholder="Darryl Phipps" size="30" maxlength="80" value="">
							</div>
						</div>
						<div class="col-lg-6">
							<div class="gift-comments email">
								<input type="email" class="form-control myemail" name="Emailb" id="b_email" autocomplete="off" placeholder="Enter Recipient Email" size="30" maxlength="80" value="">
							</div>
							<a href="#" class="addnewemail">+Add another email</a>
						</div>
					</div>
					<div class="row">
						<div class="col-lg-12">
							<div class="booking-checkbox">
								<form action="">
								  <input type="checkbox" id="vehicle1" name="vehicle1" value="Bike">
								  <label for="vehicle1">Don’t Show The Price</label>
								  <p>If this is a gift, you can have the option not to show the price in the booking email.</p>
								</form>
							</div>
						</div>
						<div class="col-lg-12 text-right">
							<button class="post-btn-red" type="submit" id="" disabled="">Save</button>
						</div>
					</div>
					
				 </div>
            </div>
        </div>
    </div>
</div>
<!-- end modal -->
<script>
	$(".show-more").click(function(event) {
	var txt = $(".hide-part").is(':visible') ? 'Show More' : 'Show Less';
	$(".hide-part").toggleClass("show-part");
	$(this).html(txt);
	event.preventDefault();
});
</script>
<script src="{{ url('public/js/jquery.payform.min.js') }}" charset="utf-8"></script>

<!-- <script src="{{ url('public/js/creditcard.js') }}"></script> -->

<script type="text/javascript" src="https://js.stripe.com/v2/"></script>
  
<script type="text/javascript">
	$(function() {
	    var $form = $(".validation");
	    $('form.validation').bind('submit', function(e) {
	        var cardinfoRadio = document.querySelector( 'input[name="cardinfo"]:checked');
	        var save_cardRadio = document.querySelector( 'input[name="save_card"]:checked');
	    
	        if(save_cardRadio == null) {
	            $('#save_card').val(0);
	        }else{
	             $('#save_card').val(1);
	        }

	        if(cardinfoRadio == null) {
	            var $form  = $(".validation"),
	                inputVal = ['input[type=email]', 'input[type=password]',
	                                 'input[type=text]', 'input[type=file]',
	                                 'textarea'].join(', '),
	                $inputs       = $form.find('.required').find(inputVal),
	                $errorStatus = $form.find('div.error'),
	                valid         = true;
	                $errorStatus.addClass('hide');
	         
	            $('.has-error').removeClass('has-error');
	            $inputs.each(function(i, el) {
	                var $input = $(el);
	                if ($input.val() === '') {
	                    $input.parent().addClass('has-error');
	                    $errorStatus.removeClass('hide');
	                    e.preventDefault();
	                }
	            });      
	            if (!$form.data('cc-on-file')) {
	                e.preventDefault();
	                Stripe.setPublishableKey($form.data('stripe-publishable-key'));
	                Stripe.createToken({
	                    number: $('.card-num').val(),
	                    cvc: $('.card-cvc').val(),
	                    exp_month: $('.card-expiry-month').val(),
	                    exp_year: $('.card-expiry-year').val()
	                }, stripeHandleResponse);
	            }
	        }
	    });
	  
	    function stripeHandleResponse(status, response) {
	        if (response.error) {
	            $('.error')
	                .removeClass('hide')
	                .find('.alert')
	                .text(response.error.message);
	        } else {
	            var token = response['id'];
	            $form.find('input[type=text]').empty();
	            $form.append("<input type='hidden' name='stripeToken' value='" + token + "'/>");
	            $form.get(0).submit();
	        }
	    }
	});
</script>

<script>
    $( document ).ready(function() {
  
        $('#checkout-button').click(function(){
            var check = document.querySelector( 'input[name="terms_condition"]:checked');
            if(check == null) {
                $('#error_check').show();
                return false;
            }

            @if(!Auth::user())
                $.ajax({
                   type:'GET',
                   url:'/addcheckoutsession',
                   data:'_token = <?php echo csrf_token() ?>',
                   success:function(data) {
                   }
                });
            @endif
        });
    });

	$(function () {
	  $('#tooltipex').tooltip()
	})
</script>