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
                        if(!empty($item['adult'])){
                            $totalquantity += $item['adult']['quantity'];
                            $discount += ($item['adult']['price'] *$serprice['adult_discount'])/100; 
                        }
                        if(!empty($item['child'])){
                            $totalquantity += $item['child']['quantity'];
                            $discount += ($item['child']['price'] *$serprice['child_discount'])/100;
                        }
                        if(!empty($item['infant'])){
                            $totalquantity += $item['infant']['quantity'];
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
    					
                        $bookscheduler = BusinessActivityScheduler::where('id', $item["actscheduleid"])->limit(1)->orderBy('id', 'ASC')->get()->toArray();

                        $tot_cart_qty = ($db_totalquantity + $totalquantity);
                        if( $bookscheduler[0]['spots_available'] <  $tot_cart_qty ){
                            $soldout_chk = 1;
                            $Sold_out = "Sold Out";
                        }
    					$act = BusinessServices::where('id', $item["code"])->first();
                        $BusinessTerms = BusinessTerms::where('cid',$act["cid"])->first();
                        $termcondfaqtext = @$BusinessTerms->termcondfaqtext;
                        $contracttermstext = @$BusinessTerms->contracttermstext;
                        $liabilitytext = @$BusinessTerms->liabilitytext;
                        $covidtext = @$BusinessTerms->covidtext;
                        $refundpolicytext = @$BusinessTerms->refundpolicytext;
    					
    					$service_fee= ($item["totalprice"] * $fees->service_fee)/100;
    					$tax= ($item["totalprice"] * $fees->site_tax)/100;
    					$total_amount = $item["totalprice"] + $service_fee + $tax;
    					$iprice = number_format($total_amount,0, '.', '');
    					$daynum = '+'.@$serprice['pay_setnum'].' '.strtolower(@$serprice['pay_setduration']);
    					$expired_at  = date('m/d/Y', strtotime(date('Y-m-d'). $daynum ));	
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
										<div class="show-more-cart"><a class="show-more">Show More <i class="fas fa-caret-down"></i></a> </div>
                                    </div>
                                </div>
                                <div class="col-lg-5">
                                    <div class="price-section">
                                        <h4>
                                        	@if($item['adult'])
                                        	  x{{$item['adult']['quantity']}} Adult
                                        	  @if($serprice['child_discount'])
                                        	    @php
                                        	      $child_discount_price = ($item['adult']['price'] - ($item['adult']['price'] * $serprice['child_discount'])/100)
                                        	    @endphp
                                        	    ${{$child_discount_price}}<strike> ${{$item['adult']['price']}}</strike>/person
                                        	  @endif
                                        	  <br/>
                                        	@endif

                                        	@if($item['child'])
                                        	  x{{$item['child']['quantity']}} Child
                                        	  @if($serprice['child_discount'])
                                        	    @php
                                        	      $child_discount_price = ($item['child']['price'] - ($item['child']['price'] * $serprice['child_discount'])/100)
                                        	    @endphp
                                        	    ${{$child_discount_price}}<strike> ${{$item['child']['price']}}</strike>/person
                                        	  @endif
                                        	  <br/>
                                        	@endif

                                        	@if($item['infant'])
                                        	  x{{$item['infant']['quantity']}} Infant
                                        	  @if($serprice['child_discount'])
                                        	    @php
                                        	      $child_discount_price = ($item['infant']['price'] - ($item['infant']['price'] * $serprice['child_discount'])/100)
                                        	    @endphp
                                        	    ${{$child_discount_price}}<strike> ${{$item['infant']['price']}}</strike>/person
                                        	  @endif
                                        	  <br/>
                                        	@endif
                                        	total: <?= "$ " . number_format($item["totalprice"] - $discount, 2); ?>
                                        </h4>
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
                                            <select class="select-participat familypart" name="participat[]" id="participats" >
                                                <option value="{{Auth::user()->id}}" data-cnt="{{$i}}" data-priceid="{{$item['priceid']}}" data-type="user">Choose or Add Participant</option>
                                                <option value="{{Auth::user()->id}}" data-cnt="{{$i}}" data-priceid="{{$item['priceid']}}" data-type="user">{{Auth::user()->firstname}} {{ Auth::user()->lastname }}</option>
                                                <?php foreach($family as $fa){ 

                                                   /* $date_now = date_create();
                                                    $birthday = new DateTime($fa['birthday']);
                                                    $age = $date_now->diff($birthday)->y;*/
    												/*$age = date_diff($birthday,  $date_now)->y;*/
                                                   /* echo $age;  */  											?>   
                                                	<option value="<?php echo $fa['id']; ?>" 
                                                        data-name="<?php echo $fa['first_name'].' '.$fa['last_name']; ?>"
                                                        data-cnt="{{$i}}" data-priceid="{{$item['priceid']}}" data-age="<?php /*echo $age;*/ ?>" @if(@$item['participate'][$i]['id'] == $fa['id']) selected @endif data-type="family">
                                                        {{$fa['first_name']}} {{$fa['last_name']}}</option>
                                                <?php } ?>
                                                <option value="addparticipate">+ Add New Participant</option>
                                            </select> 
                                        <?php } ?>

                                    </div>
                                    <?php 
                                        $participatearray = [];
                                    ?>
                                    <div class="mtp-15 info-details participaingdiv{{$item['priceid']}}">
                                    	<?php
                                            $ajaxname = Auth::user()->firstname.' '.Auth::user()->lastname;
    										for($i=0; $i<$totalquantity; $i++)
    										{ 
                                                $family = UserFamilyDetail::where('id',@$item['participate'][$i]['id'])->first(); ?>
                                        		<p id='part<?php echo $i.$item["priceid"]; ?>'>
                                                    <b>Participant#{{$i+1}}: </b> @if(@$item['participate'][$i]['from'] == 'user') {{Auth::user()->firstname}} {{ Auth::user()->lastname }}  @else {{@$family->first_name}} {{ @$family->last_name}} @endif
                                                </p>
                                        <?php 
                                            } 
                                        ?>
                                    </div>
                                    <?php } ?>
                                    <div class="select-sparetor">
                                        <input class="payfor" type="checkbox" id="payforcheckbox{{$item['priceid']}}" name="payforcheckbox" value="" onclick="opengiftpopup('{{$item["priceid"]}}','{{$profilePic}}','{{$item["name"]}}','{{date("m/d/Y",strtotime($item["sesdate"]))}}')">
                                        <label class="payfor-label" for="payforcheckbox{{$item['priceid']}}">Paying or gifting for someone?</label>
                                        <p class="payfor-ptag">Share the booking details with them</p>
										<div class="btn-ord-txt">
											<a href="#" class="post-btn-red" data-toggle="modal" data-target="#leavegift" style="display:none;" id="giftanotheralink"></a>
										</div>
                                    </div>
                                </div>
    						</div>
    						<div class="row">
                                <div class="col-md-12 divmargin cart-terms-dis">
                                    @if($termcondfaqtext != '' || $liabilitytext != '' || $covidtext != '' || $contracttermstext != '' || $refundpolicytext != '')
                                    	<h4 class="termsdetails"> Terms: </h4> <span class="termsdetails terms-txt"> View the terms and conditions from this provider below </span>
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
    					$('.familypart').change(function() {
    						var value = $(this).children("option:selected").val();
    						if(value == 'addparticipate'){
    							$('#newparticipant').modal('show');
    						}else{
	    						var name = $(this).find(':selected').data('name');
	    						var cnt = $(this).find(':selected').data('cnt');
	    						var act = $(this).find(':selected').data('priceid');
	                            var type = $(this).find(':selected').data('type');
	    						// var age = $(this).find(':selected').data('age');
	    						
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
	                       		}
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
    								<label>Taxes & Fees: </label>
    							</div>
    						</div>
    						<div class="col-lg-6 col-xs-6 booking-txt-rs-left"> 
    							<div class="inner-box-right"> 
    								<span> <?php echo count($cart['cart_item']); ?> </span>
    								<span> 
    									@if($discount)
    										<?php echo "$ " . number_format($item_price - $discount, 2); ?> 
    									@else
    										<?php echo "$ " . number_format($item_price, 2); ?> 
    									@endif
    									
    								</span>
    								<span> <?php echo "$ " .(number_format(($tax + $service_fee),2)); ?> </span>
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
    					@if (session('stripeErrorMsg'))
    					<div class='form-row row'>
                            <div class='col-md-12 error form-group'>
                                <div class='alert-danger alert'> {{ session('stripeErrorMsg') }}</div>
                            </div>
                        </div>
                        @endif
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
                                    <label>Taxes & Fees:</label>
                                </div>
                            </div>
                            <div class="col-lg-6 col-xs-6 booking-txt-rs-left"> 
                                <div class="inner-box-right"> 
                                    <span> 0 </span>
                                    <span> $ 0.00 </span>
                                    <span> $ 0.00 </span>
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
	            
	        	<div class="modal-body" id="leavegiftbody">
	        		
	        	</div>					        
	       	</div>
		</div>
	</div>
	<!-- end modal -->

<!-- The Add New Participant Modal -->
	<div class="modal fade compare-model" id="newparticipant">
		<div class="modal-dialog eventcalender">
			<div class="modal-content">
				<div class="modal-header" style="text-align: right;"> 
					<div class="closebtn">
						<button type="button" class="close close-btn-design manage-customer-close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">×</span>
						</button>
					</div>
				</div>
				<!-- Modal body -->
				<div class="modal-body body-tbm">
					<div class="row"> 
						<div class="col-lg-12">
							<h4 class="modal-title" style="text-align: center; color: #000; line-height: inherit; font-weight: 600; margin-top: 9px; margin-bottom: 12px;">Add Family or Friends</h4>
						</div>
					</div>
					<div id='termserror'></div>
					<div class="row"> 
						<form action="{{route('addfamilyfromcart')}}" method="POST">
							@csrf
							<div class="col-md-6">
								<div class="new-participant">
									<label>First Name</label>
									<input type="text" name="fname" id="fname" class="form-control" required>
									
									<label>Last Name</label>
									<input type="text" name="lname" id="lname" class="form-control" required>
									
									<label>Select Gender</label>
									<select name="gender" id="gender" class="form-control" required>
										<option value="" hidden="">Select Gender</option>
										<option value="Male">Male</option>
										<option value="Female">Female</option>
									</select>
									
									<label>Email</label>
									<input type="text" name="email" id="email" class="form-control" >
									
									<label>Select Relationship</label>
									<select name="relationship" id="relationship" class="form-control" required>
										<option value="" hidden="">Select Relationship</option>
										<option>Brother</option><option>Sister</option>
										<option>Father</option><option>Mother</option>
										<option>Wife</option><option>Husband</option>
										<option>Son</option><option>Daughter</option>
										<option>Friend</option>
									</select>
								</div>
							</div>
							<div class="col-md-6">
								<div class="new-participant">
									<label>Birthday</label>
									<input required="required" type="text" name="birthdate" id="birthdate" class="form-control" maxlength= "10" value="" placeholder="Date Formate: dd/mm/yyyy">
									
									<label>Mobile Number</label>
									<input type="text" name="mobile" id="mobile" class="form-control" maxlength="14" onkeypress="return event.charCode >= 48 && event.charCode <= 57"  onkeyup="changeformate('mobile')">
									
									<label>Emergency Contact Name</label>
									<input type="text" name="emergency_name" id="emergency_name" class="form-control">
									
									<label>Emergency Contact Number</label>
									<input type="text" name="emergency_contact" id="emergency_contact" class="form-control" maxlength="14" onkeypress="return event.charCode >= 48 && event.charCode <= 57"  onkeyup="changeformate('emergency_contact')">
									
									<button type="submit" class="btn-nxt-part add-btn-submit" id="submitfamily">Submit</button>
								</div>
							</div>
						</form>
					</div>
				</div>
				
			</div>
		</div>
	</div>
<!-- end modal -->


<script>
	function opengiftpopup(pid,img,name,date){
		/*alert('hii');*/
		var checkBox = document.getElementById("payforcheckbox"+pid);
		//alert(checkBox.checked );
		if (checkBox.checked == true){
			$.ajax({
	           type:'post',
	           url:'/activity_gift_model',
	           data:{
	           		_token : '<?php echo csrf_token() ?>' ,
	           		name : name,
	           		img : img,
	           		pid : pid,
	           		date : date,
	           	},
	            success:function(data) {
	            	$('#leavegiftbody').html(data);
	            }
	        });
		    $('#giftanotheralink').click();
		}
		

		/*$('#emaildiv').html('<input type="email" class="form-control myemail" name="Emailb[]" id="b_email" autocomplete="off" placeholder="Enter Recipient Email" size="30" maxlength="80" value="">');
		$(".avatar").attr("src", img);
		$('#act_name').html(name);
		$('#priceid').val(pid);
		$('#sc_date').val(date);*/
		
	}

	function addemail(pid) {
		//alert('hii');
		$('#emaildiv').append('<input type="email" class="form-control myemail" name="Emailb[]" id="b_email" autocomplete="off" placeholder="Enter Recipient Email" size="30" maxlength="80" value="">');
	}
 
	$(".show-more").click(function(event) {
		var txt = $(".hide-part").is(':visible') ? 'Show More <i class="fas fa-caret-down"></i>' : 'Show Less <i class="fas fa-caret-up"></i>';
		$(".hide-part").toggleClass("show-part");
		$(this).html(txt);
		event.preventDefault();
	});

	$("#birthdate").keyup(function(){
        if ($(this).val().length == 2){
            $(this).val($(this).val() + "/");
        }else if ($(this).val().length == 5){
            $(this).val($(this).val() + "/");
        }
    });

    $('#submitfamily').click(function(e) {
    	$("#termserror").html('').removeClass('alert-class alert-danger');
    	let date = $('#birthdate').val();
    	const  today = new Date().toLocaleDateString('en-US', {year: 'numeric', month: '2-digit', day: '2-digit'}); 
    	if(!dateCheck("01/01/1960", today ,date)){
			$("#termserror").html('Plese Enter Valid Date.').addClass('alert-class alert-danger');
		   return false;
    	}
    });

	function dateCheck(from,to,check) {

	    var fDate,lDate,cDate;
	    fDate = Date.parse(from);
	    lDate = Date.parse(to);
	    cDate = Date.parse(check);

	    if((cDate <= lDate && cDate >= fDate)) {
	        return true;
	    }
	    return false;
	}

	function changeformate(idname) {
        var con = $('#'+idname).val();
        var curchr = con.length;
        if (curchr == 3) {
            $('#'+idname).val("(" + con + ")" + " ");
        } else if (curchr == 9) {
            $('#'+idname).val(con + "-");
        }
    }

</script>
<script src="{{ url('public/js/jquery.payform.min.js') }}" charset="utf-8"></script>

<!-- <script src="{{ url('public/js/creditcard.js') }}"></script> -->

<script type="text/javascript" src="https://js.stripe.com/v2/"></script>
  
<script type="text/javascript">
	$(function() {
	    var $form = $(".validation");
	    $('form.validation').bind('submit', function(e) {
	        $('#checkout-button').html('loading...').prop('disabled', true);
	        var check = document.querySelector( 'input[name="terms_condition"]:checked');
	        if(check == null) {
	            $('#error_check').show();
	            $('#checkout-button').html('Check Out').prop('disabled', false);
	            return false;
	        }

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
	        $('#checkout-button').html('Check Out').prop('disabled', false);
	    }
	});
</script>

<script>
    $( document ).ready(function() {
        $('#checkout-button').click(function(){
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