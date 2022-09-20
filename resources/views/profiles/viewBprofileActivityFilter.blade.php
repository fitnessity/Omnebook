<?php
use App\Bookactivity;
use App\BusinessService;
use App\BusinessServices;
use App\BusinessPriceDetails;
use App\UserBookingDetail;
use App\BusinessServiceReview;
use App\BusinessActivityScheduler;
use App\BusinessPriceDetailsAges;

if(!empty(request()->id)){ $cid = request()->id; }
else{ $cid = request()->page_id; }
//DB::enableQueryLog();
$actoffer = BusinessServices::where('cid', $cid)->groupBy('sport_activity')->get()->toArray();
//dd(\DB::getQueryLog());

?>
<div class="widget">
	<div class="wid-space"></div>
	<div class="your-page">
    	<div class="row fromblock">
        	<h3> <a class="active"> View Activities </a>  </h3>
        	<div class="multiselect-block">
                <div class="col-md-12 col-lg-6 pl-0 pr-0">
                    <select name="actfiloffer" id="actfiloffer" class="bd-right bd-bottom" onchange="actFilter('<?php echo $cid; ?>','0')">
                        <option value="">Activity Offered</option>
                        <?php
                            if (!empty($actoffer)) {
                                foreach ($actoffer as  $off) { ?>
                                    <option><?php echo $off['sport_activity'];?></option>
                        <?php } } ?>
                    </select>
                </div>
                <div class="col-md-12 col-lg-6 pl-0 pr-0">
                    <select name="actfillocation" id="actfillocation" class="bd-bottom" onchange="actFilter('<?php echo $cid; ?>','0')">
                        <option value="">Location</option>
                        <option value="Online">Online</option>
                        <option value="At Business">At Business Address</option>
                        <option value="On Location">On Location</option>
                    </select>
                </div>
                <div class="col-md-12 col-lg-6 pl-0 pr-0">
                    <select id="actfilmtype" name="actfilmtype" class="bd-right bd-bottom" onchange="actFilter('<?php echo $cid; ?>','0')">
                        <option value="">Membership Type</option>
                        <option>Drop In</option>
                        <option>Semester</option>
                    </select>
                </div>
                <div class="col-md-12 col-lg-6 pl-0 pr-0">
                    <select name="actfilgreatfor" id="actfilgreatfor" class="bd-bottom" onchange="actFilter('<?php echo $cid; ?>','0')">
                            <option value="">Great For</option>
                            <option>Individual</option>
                            <option>Kids</option>
                            <option>Teens</option>
                            <option>Adults</option>
                            <option>Family</option>
                            <option>Groups</option>
                            <option>Paralympic</option>
                            <option>Prenatal</option>
                            <option>Any</option>
                    </select>
                </div>
                <div class="col-md-12 col-lg-6 pl-0 pr-0">
                    <select name="actfilparticipant" id="actfilparticipant" class="bd-right bd-bottom" onchange="actFilter('<?php echo $cid; ?>','0')">
                        <option value="">#of Participants</option>
                        <?php for($i=1; $i<=100; $i++){
                            echo '<option>'.$i.'</option>';
                        }?>
                    </select>
                </div>
                <div class="col-md-12 col-lg-6 pl-0 pr-0">
                    <select id="actfilbtype" name="actfilbtype" class="bd-bottom" onchange="actFilter('<?php echo $cid; ?>','0')" >
                        <option value="">Business Type</option>
                        <option value="individual">Personal Trainer</option>
                        <option value="classes">Gym/Studio</option>
                        <option value="experience">Experience</option>
                    </select>
                </div>
                <div class="col-md-12 col-lg-6 pl-0 pr-0">
                	<div class="special-date bd-right">
                    <input type="text" name="actfildate" id="actfildate" placeholder="Date" class="form-control" onchange="actFilter('<?php echo $cid; ?>','0')" >
                    <i class="fa fa-calendar"></i>
                    </div>
                    <script>
						$( function() {
							$( "#actfildate" ).datepicker( { minDate: 0 } );
						} );
					</script>
                </div>
                <div class="col-md-12 col-lg-6 pl-0 pr-0">
                    <select name="actfilsType" id="actfilsType" onchange="actFilter('<?php echo $cid; ?>','0')">
                            <option value="">Service Type</option>
                            <option>Personal Training</option>
                            <option>Coaching</option>
                            <option>Therapy</option>
                            <option>Group Class</option>
                            <option>Seminar</option>
                            <option>Workshop</option>
                            <option>Clinic</option>
                            <option>Camp</option>
                            <option>Team</option>
                            <option>Corporate</option>
                            <option>Tour</option>
                            <option>Adventure</option>
                            <option>Retreat</option>
                            <option>Workshop</option>
                            <option>Seminar</option>
                            <option>Private experience</option>
                    </select>
                    <input name="csrftoken" id="csrftoken" type="hidden" value="<?php echo csrf_token(); ?>">
                </div>
        	</div>
        </div>
        
    	<?php /*?><table>
        	<tr>
            	<td colspan="2">
					<select name="actfiloffer" id="actfiloffer" onchange="actFilter('<?php echo $cid; ?>','0')">
						<option value="">Activity Offered</option>
						<?php
							if (!empty($actoffer)) {
								foreach ($actoffer as  $off) { ?>
									<option><?php echo $off['sport_activity'];?></option>
						<?php } } ?>
					</select>
				</td>
				<td>
                	<select name="actfillocation" id="actfillocation" onchange="actFilter('<?php echo $cid; ?>','0')">
						<option value="">Location</option>
						<option value="Online">Online</option>
                        <option value="At Business">At Business Address</option>
                        <option value="On Location">On Location</option>
					</select>
				</td>
			</tr>
            <tr>
            	<td rowspan="2"><p>Date</p><img src="/images/newimage/calendar.png" width="20"></td>
				<td> 
                	<select name="actfilparticipant" id="actfilparticipant" onchange="actFilter('<?php echo $cid; ?>','0')">
						<option value="">#of Participants</option>
						<?php for($i=1; $i<=100; $i++){
							echo '<option>'.$i.'</option>';
						}?>
					</select>
				</td>
			</tr>
			<tr>
            	<td>
					<select name="actfilgreatfor" id="actfilgreatfor" onchange="actFilter('<?php echo $cid; ?>','0')">
						<option value="">Service For</option>
						<option>Kids</option>
                        <option>Teens</option>
                        <option>Adults</option>
                        <option>Any</option>
					</select>
				</td>
                <td>
                    <select name="actfilsType" id="actfilsType" onchange="actFilter('<?php echo $cid; ?>','0')">
                        <option value="">Service Type</option>
                        <option>Personal Training</option>
                        <option>Coaching</option>
                        <option>Therapy</option>
                        <option>Group Class</option>
                        <option>Seminar</option>
                        <option>Workshop</option>
						<option>Clinic</option>
                        <option>Camp</option>
                        <option>Team</option>
                        <option>Corporate</option>
                        <option>Tour</option>
                        <option>Adventure</option>
                        <option>Retreat</option>
                        <option>Workshop</option>
                        <option>Seminar</option>
                        <option>Private experience</option>
                    </select>
				</td>
			</tr>
		</table><?php */?>
        <div id="actsearch">
	        <?php
				//DB::enableQueryLog();
				$activities_search = BusinessServices::where('cid', $cid)->where('is_active', '1')->limit(2)->orderBy('id', 'DESC')->get();
				$ascount = BusinessServices::where('cid', $cid)->where('is_active', '1')->count();
				//dd(\DB::getQueryLog());
	            if (!empty($activities_search)) { 
					foreach ($activities_search as  $act) {
						$servicePrice = BusinessPriceDetails::where('serviceid', $act['id'])->limit(1)->orderBy('id', 'ASC')->get()->toArray();
						$pay_session1=''; $pay_price1=''; $priceid1='';
						if( !empty($servicePrice) )
						{
							if(@$servicePrice[0]['pay_session']!=''){
								$pay_session1 = @$servicePrice[0]['pay_session'];
							}
							if(@$servicePrice[0]['adult_cus_weekly_price']!=''){
								$pay_price1 = @$servicePrice[0]['adult_cus_weekly_price'];
							}
							if(@$servicePrice[0]['id']!=''){
                                $priceid1 = @$servicePrice[0]['id'];
                            }
						}
						$reviews_count = BusinessServiceReview::where('service_id', $act['id'])->count();
						$reviews_sum = BusinessServiceReview::where('service_id', $act['id'])->sum('rating');
						$reviews_avg=0;
						if($reviews_count>0)
						{ $reviews_avg = round($reviews_sum/$reviews_count,2); }
						$SpotsLeft = UserBookingDetail::where('sport', @$act['id'] )->count();
						$SpotsLeftdis=0;
						if( !empty($service['group_size']) )
						$SpotsLeftdis = $act['group_size']-$SpotsLeft;
						if( !empty($act['profile_pic']) ) {
							if (File::exists(public_path("/uploads/profile_pic/thumb/" . @$act['profile_pic']))) {
								$profilePic = url('/public/uploads/profile_pic/thumb/' . @$act['profile_pic']);
							} else {
								$profilePic = '/public/images/service-nofound.jpg';
							}
						}
						else{ $profilePic = '/public/images/service-nofound.jpg'; }
						$bookscheduler = BusinessActivityScheduler::where('serviceid', $act['id'])->limit(1)->orderBy('id', 'ASC')->get()->toArray();
						$ser_mem = BusinessPriceDetails::where('serviceid', $act['id'])->limit(1)->orderBy('id', 'ASC')->get()->toArray();
						?>
	                    <div class="kickshow-block">
                            <div class="topkick" id="kickboxing{{$act['id']}}">
                                <h5><?php echo @$act['program_name']; 
                                        $reviews_count = BusinessServiceReview::where('service_id', $act['id'])->count();
                                        $reviews_sum = BusinessServiceReview::where('service_id', $act['id'])->sum('rating');
                                    ?>
                                    <p>{{$reviews_count}} Reviews <span> <i class="fa fa-star" aria-hidden="true"></i>
                                     {{$reviews_avg}} </span></p>
                                </h5>
                                <div class="lefthalf">
                                	<div class="divdesc">
	                                	<div class="divleftserdes">
											<img src="<?php echo $profilePic; ?>" />
										</div>
										<div class="divrightserdes">
											<p> <b> Description </b> </p>
											<p> <?php echo Str::limit($act['program_desc'], 80, $end='...'); ?></p>
										</div>
									</div>
                                    <div class="divdesc">
                                        <?php
                                            //$SpotsLeft = UserBookingDetail::where('sport', @$act['id'] )->sum('qty');
                                           /* $today = date('Y-m-d');
                                            $SpotsLeft = UserBookingDetail::where('sport', @$act['id'] )->whereDate('created_at', '=', $today)->sum('qty');
                                            $SpotsLeftdis=0;
                                            if( !empty($act['group_size']) )
                                                $SpotsLeftdis = $act['group_size']-$SpotsLeft;*/
                                        ?>
                                        <p class="actsubtitle"> Details: </p>
                                        <ul>
                                            <li>
                                                <?php
                                                    if(@$bookscheduler[0]['starting']!=''){
                                                        //echo date('l jS \of F Y', strtotime( $bookscheduler[0]['starting'] ));
                                                        echo date('l, F jS,  Y' );
                                                    } 
                                                   /* if(@$bookscheduler[0]['shift_start']!=''){
                                                        //echo '<br>'.$bookscheduler[0]['shift_start'];
                                                        echo '<br>'.date('h:ia', strtotime( $bookscheduler[0]['shift_start'] )); 
                                                    }
                                                    if(@$bookscheduler[0]['shift_end']!=''){
                                                        //echo ' - '.$bookscheduler[0]['shift_end'];
                                                        echo ' - '.date('h:ia', strtotime( $bookscheduler[0]['shift_end'] )); 
                                                    }
                                                    if(@$bookscheduler[0]['set_duration']!=''){
                                                        $tm=explode(' ',$bookscheduler[0]['set_duration']);
                                                        $hr=''; $min=''; $sec='';
                                                        if($tm[0]!=0){ $hr=$tm[0].'hr. '; }
                                                        if($tm[2]!=0){ $min=$tm[2].'min. '; }
                                                        if($tm[4]!=0){ $sec=$tm[4].'sec.'; }
                                                        if($hr!='' || $min!='' || $sec!='')
                                                        { echo ' /'.$hr.$min.$sec; } 
                                                    }*/
                                                ?>
                                            </li>
                                           
                                            <li>Service Type: <?php echo @$act['select_service_type']; ?></li>
                                            <li>Activity: <?php echo @$act['sport_activity'] ?></li>
                                            <li>Activity Location: <?php echo @$act['activity_location'] ?></li>
                                            <li>Great For: <?php echo @$act['activity_for'] ?></li>
                                            <li>Age: <?php echo @$act['age_range'] ?></li>
                                            <li>Language: <?php echo @$languages?></li>
                                            <li>Skill Level: <?php echo @$act['difficult_level'] ?></li>
                                            <?php if(@$ser_mem[0]['membership_type']!=''){ ?>
                                                <li>Membership Type: <?php echo @$ser_mem[0]['membership_type'] ?></li>
                                            <?php } ?>
                                            <li>Business Type: <?php
                                                if($act['service_type']=='individual'){ echo 'Personal Training'; }
                                                else { echo @$act['service_type']; } ?></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="righthalf">
	                                <?php //echo $act['id'];
	                                    
	                                    $servicePrfirst = BusinessPriceDetails::where('serviceid', $act['id'])->orderBy('id', 'ASC')->first();
	                                    $sercate = BusinessPriceDetailsAges::where('serviceid', $act['id'])->orderBy('id', 'ASC')->get()->toArray();
	                                    $sercatefirst = BusinessPriceDetailsAges::where('serviceid', $act['id'])->orderBy('id', 'ASC')->get()->first();
	                                    $servicePr = BusinessPriceDetails::where('serviceid', $act['id'])->orderBy('id', 'ASC')->where('category_id',@$sercatefirst['id'])->get()->toArray();
	                                   /* print_r( $servicePr );exit();*/
	                                    $todayday = date("l");
	                                    $todaydate = date('m/d/Y');
	                                    $bus_schedule = BusinessActivityScheduler::where('category_id',@$sercatefirst['id'])->whereRaw('FIND_IN_SET("'.$todayday.'",activity_days)')->where('starting','<=',$todaydate )->get();
	                                    $start =$end= $time= '';$timedata = $SpotsLeft = 0; $Totalspot = $spot_avil= 0; 
	                                    if(!empty($bus_schedule)){
	                                        foreach($bus_schedule as $data){
	                                            if($data['scheduled_day_or_week'] == 'Days'){
	                                                $daynum = '+'.$data['scheduled_day_or_week_num'].' days';
	                                                $expdate  = date('m/d/Y', strtotime($data['starting']. $daynum ));
	                                            }else if($data['scheduled_day_or_week'] == 'Months'){
	                                                $daynum = '+'.$data['scheduled_day_or_week_num'].' month';
	                                                $expdate  = date('m/d/Y', strtotime($data['starting']. $daynum ));
	                                            }else if($data['scheduled_day_or_week'] == 'Years'){
	                                                $daynum = '+'.$data['scheduled_day_or_week_num'].' years';
	                                                $expdate  = date('m/d/Y', strtotime($data['starting']. $daynum ));
	                                            }else{
	                                                $daynum = '+'.$data['scheduled_day_or_week_num'].' week';
	                                                $expdate  = date('m/d/Y', strtotime($data['starting']. $daynum ));
	                                            }  
	                                            
	                                            if($todaydate <=$expdate){
	                                                 $timedata ='';
	                                                if(@$data['shift_start']!=''){
	                                                    $start = date('h:i a', strtotime( $data['shift_start'] ));

	                                                    $timedata .= $start;
	                                                }
	                                                if(@$data['shift_end']!=''){
	                                                    $end = date('h:i a', strtotime( $data['shift_end'] ));
	                                                     $timedata .= ' - '.$end;
	                                                } 
	                                                if(@$data['set_duration']!=''){
	                                                    $tm=explode(' ',$data['set_duration']);
	                                                    $hr=''; $min=''; $sec='';
	                                                    if($tm[0]!=0){ $hr=$tm[0].'hr. '; }
	                                                    if($tm[2]!=0){ $min=$tm[2].'min. '; }
	                                                    if($tm[4]!=0){ $sec=$tm[4].'sec.'; }
	                                                    if($hr!='' || $min!='' || $sec!='')
	                                                    { $time = $hr.$min.$sec; 
	                                                        $timedata .= ' / '.$time;} 
	                                                }
	                                            }
	                                            $today = date('Y-m-d');
	                                            $SpotsLeft = UserBookingDetail::where('sport', @$act['id'] )->whereDate('created_at', '=', $today)->sum('qty');
	                                            $SpotsLeftdis=0;
	                                            if( !empty($data['spots_available']) ){
	                                                $spot_avil=$data['spots_available'];
	                                                $SpotsLeftdis = $data['spots_available']-$SpotsLeft;
	                                                $Totalspot = $SpotsLeftdis.'/'.@$data['spots_available'];
	                                            }
	                                        }
	                                    }
	                                    if(date('l') == 'Saturday' || date('l') == 'Sunday'){
	                                        $total_price_val =  @$servicePrfirst['adult_weekend_price_diff'];
	                                        $selectval = '';$priceid = '';$i=1;
	                                        if(!empty(@$servicePr)){
	                                            foreach ($servicePr as  $pr) {
	                                                if($i==1){ 
	                                                    $priceid =$pr['id'];
	                                                    $selectval .='<option value="'.$pr['pay_session'].'~~'.$pr['adult_weekend_price_diff'].'~~'.$pr['id'].'">Select Price Option</option>'; }
	                                                if($pr['adult_weekend_price_diff'] != ''){
	                                                    $selectval .='<option value="'.$pr['pay_session'].'~~'.$pr['adult_weekend_price_diff'].'~~'.$pr['id'].'">Adult - '.$pr['price_title'].' - '.$pr['pay_session'].' Sessions - $'.$pr['adult_weekend_price_diff'].'</option>';}
	                                                if($pr['child_cus_weekly_price'] != ''){
	                                                    $selectval .='<option value="'.$pr['pay_session'].'~~'.$pr['child_weekend_price_diff'].'~~'.$pr['id'].'">Child - '.$pr['price_title'].' - '.$pr['pay_session'].' Sessions - $'.$pr['child_weekend_price_diff'].'</option>';
	                                                }
	                                                if($pr['infant_cus_weekly_price'] != ''){
	                                                    $selectval .='<option value="'.$pr['pay_session'].'~~'.$pr['infant_weekend_price_diff'].'~~'.$pr['id'].'">Infant - '.$pr['price_title'].' - '.$pr['pay_session'].' Sessions - $'.$pr['infant_weekend_price_diff'].'</option>';
	                                                }$i++;
	                                            }
	                                        }
	                                    }else{
	                                        $total_price_val =  @$servicePrfirst['adult_cus_weekly_price'];
	                                        $selectval = '';$priceid = '';$i=1;
	                                        if(!empty(@$servicePr)){
	                                            foreach ($servicePr as  $pr) {
	                                                if($i==1){ 
	                                                    $priceid =$pr['id'];
	                                                    $selectval .='<option value="'.$pr['pay_session'].'~~'.$pr['adult_cus_weekly_price'].'~~'.$pr['id'].'">Select Price Option</option>'; }
	                                                if($pr['adult_cus_weekly_price'] != ''){
	                                                    $selectval .='<option value="'.$pr['pay_session'].'~~'.$pr['adult_cus_weekly_price'].'~~'.$pr['id'].'">Adult - '.$pr['price_title'].' - '.$pr['pay_session'].' Sessions - $'.$pr['adult_cus_weekly_price'].'</option>';}
	                                                if($pr['child_cus_weekly_price'] != ''){
	                                                    $selectval .='<option value="'.$pr['pay_session'].'~~'.$pr['child_cus_weekly_price'].'~~'.$pr['id'].'">Child - '.$pr['price_title'].' - '.$pr['pay_session'].' Sessions - $'.$pr['child_cus_weekly_price'].'</option>';
	                                                }
	                                                if($pr['infant_cus_weekly_price'] != ''){
	                                                    $selectval .='<option value="'.$pr['pay_session'].'~~'.$pr['infant_cus_weekly_price'].'~~'.$pr['id'].'">Infant - '.$pr['price_title'].' - '.$pr['pay_session'].' Sessions - $'.$pr['infant_cus_weekly_price'].'</option>';
	                                                }$i++;
	                                            }
	                                        }
	                                    }
	                                ?>
                                    <select id="selcatpr<?php echo $act['id'];?>" name="selcatpr<?php echo $act['id'];?>" class="price-select-control" onchange="changeactsession('<?php echo $act['id'];?>','<?php echo $act['id'];?>',this.value,'bookmore')">
                                        <?php $c=1;  
                                        if (!empty($sercate)) { 
                                            foreach ($sercate as  $sc) {
                                               /* if($c==1){ 
                                                    echo '<option value="'.$sc['id'].'"> Select Category </option>';
                                                }*/
                                                echo '<option value="'.$sc['id'].'">'.$sc['category_title'].'</option>';
                                                $c++;
                                            }
                                        }
                                        ?>
                                    </select>
                                    <div id="pricechng<?php echo $act['id'];?>">
                                        <select id="selprice<?php echo $act['id'];?>" name="selprice<?php echo $act['id'];?>" class="price-select-control" onchange="changeactpr('<?php echo $act['id'];?>',this.value,'1','bookmore','<?php echo $act['id'];?>')" >
                                            <?php echo $selectval;?>
                                            ?>
                                        </select>
                                    </div><?php  $start=''; $end=''; $time = ''; ?>
                                    <label>Booking Details:</label>
                                    <div id="bookmore{{$act['id']}}">
                                        @if(@$sercatefirst['category_title'] != '')<p>Category: <?php echo @$sercatefirst['category_title'];?></p>@endif
                                        <p>@if($timedata!=0){{$timedata}} @endif</p>
                                        <p>Spots Left: {{$Totalspot}}</p><br>
                                        @if(@$servicePrfirst['price_title'] != '')<p>Price Title:  <?php echo @$servicePrfirst['price_title']; ?></p> @endif
                                        <p>Price Option: <?php echo @$servicePrfirst['pay_session']; ?> Session</p>
                                        <p>Participants: <?php echo '1'; ?></p>
                                            <?php /*?><p>Participants: <?php echo @$act['group_size'] ?></p><?php */?>
                                        <p>Total: $<?php echo $total_price_val.'/person'; ?></p>
                                    </div>
                                    <input type="hidden" name="price_title_hidden" id="price_title_hidden{{$act['id']}}{{$act['id']}}" value="{{@$servicePrfirst['price_title']}}">
                                    <input type="hidden" name="sportsleft_hidden" id="sportsleft_hidden{{$act['id']}}{{$act['id']}}" value="{{$Totalspot}}">
                                    <input type="hidden" name="time_hidden" id="time_hidden{{$act['id']}}{{$act['id']}}" value="{{$timedata}}">
                                    <form method="post" action="/addtocart" id="frmcart<?php echo @$act["id"]; ?>">
                                    @csrf
                                    	<input type="hidden" name="pid" value="<?php echo @$act["id"]; ?>" />
                                    	<input type="hidden" name="quantity" id="pricequantity<?php echo $act['id'].$act["id"]; ?>" value="1" class="product-quantity" />
                                   		<input type="hidden" name="price" id="pricebookmore<?php echo $act['id'].$act["id"]; ?>" value="<?php echo $total_price_val; ?>" class="product-price"  />
                                    	<input type="hidden" name="session" id="session<?php echo $act['id'].$act["id"]; ?>" value="<?php echo $pay_session1; ?>" />
	                                    <input type="hidden" name="priceid" value="<?php echo $priceid1; ?>" id="priceid<?php echo $act["id"].$act["id"]; ?>" />
	                                    <input type="hidden" name="sesdate" value="<?php echo date('Y-m-d' ); ?>" id="sesdate<?php echo $act["id"].$act["id"]; ?>" />
	                                    <input type="hidden" name="cate_title" value="{{@$sercatefirst['category_title']}}" id="cate_title{{$act['id']}}{{$act['id']}}" />
                                  
	                                    @if($SpotsLeft >= $spot_avil && $spot_avil!=0)
	                                        <?php /*?><input type="button" value="Sold Out" class="btn btn-addtocart mt-10" /><?php */?>
	                                         <a href='javascript:void(0)' class="btn btn-addtocart mt-10" style="pointer-events: none;">Sold Out</a>
	                                    @else
	                                        @if(@$servicePrfirst['adult_cus_weekly_price'] !='' && @$timedata!='')
	                                        <input type="submit" value="Add to Cart" onclick="changeqnt('<?php echo $act["id"]; ?>')" class="btn btn-addtocart mt-10"  id="addtocart{{$act['id']}}" />
	                                        @endif
	                                    @endif
                                    </form>
                                </div>
                            </div>
                            <div class="bottomkick">
                                <div class="viewmore_links">
                                    <a id="viewmore<?php echo $act['id']; ?>" style="display:block">View More </a>
                                    <a id="viewless<?php echo $act['id']; ?>" style="display:none">View Less </a>
                                </div>
                            </div>
                        </div>
                        <script>
                            $("#viewmore<?php echo $act['id']; ?>").click(function () {
                                $("#kickboxing<?php echo $act['id']; ?>").addClass("intro");
                                $("#viewless<?php echo $act['id']; ?>").show();
                                $("#viewmore<?php echo $act['id']; ?>").hide();
                            });
                            $("#viewless<?php echo $act['id']; ?>").click(function () {
                                $("#kickboxing<?php echo $act['id']; ?>").removeClass("intro");
                                $("#viewless<?php echo $act['id']; ?>").hide();
                                $("#viewmore<?php echo $act['id']; ?>").show();
                            });
                        </script>
			<?php } } ?>
        </div>
        <?php
        if ($ascount <=0 ) { if(Auth::check()){ if(Auth::user()->id==$compinfo->user_id){ ?>
            <div class="w-100 text-center">
                <a class="btn btn-red mt-10" href="<?php echo route('manageCompany'); ?>">Create Activity </a>
            </div>
        <?php } } } ?>
	</div>
</div><!-- widget -->

<script>

function changeactpr(aid,val,part,div,maid)
{
	/*alert(val);*/
	var n = val.split('~~');
	var actfilparticipant=$('#actfilparticipant').val();
	var category_title = $('#cate_title'+maid+aid).val();
    var price_title = $('#price_title_hidden'+maid+aid).val();
    var time = $('#time_hidden'+maid+aid).val();
    var sportsleft = $('#sportsleft_hidden'+maid+aid).val();
	if(actfilparticipant!='')
	{
		pr=actfilparticipant*n[1]; 
		qty=actfilparticipant;
	}
	else{ 
		qty=1; 
		if( n[1]!='' ){ pr=qty*n[1]; } else {  pr=n[1]; }
	}
	if(time == 0){
		time = '';
	}
	var data = '<p>Price Option: '+n[0]+' Session</p><p>Participants: '+part+'</p><p>Total: $'+pr+'/person</p>';
	var bookdata= '<p>Category: '+ category_title +'</p><p> '+ time +' </p><p>Spots Left: '+sportsleft +'</p><br><p>Price Title: '+ price_title+'</p><p>Price Option: '+n[0]+' Session</p><p>Participants: '+qty+'</p><p>Total: $'+pr+'/person</p>';
	/*if(div=='book'){
		$('#bookdt'+aid).html(data);
		$('#pricebook'+aid).val(pr);
	}
	else if (div=='bookmore'){
		$('#bookmore'+aid).html(data);
		$('#pricebookmore'+aid).val(pr);
	}
	else if (div=='bookajax'){
		$('#bookajax'+aid).html(data);
		$('#pricebookajax'+aid).val(pr);
	}*/

	if(div=='book'){
		$('#book'+aid).html(bookdata);
		$('#pricequantity'+aid).val(qty);
		$('#price'+aid+maid).val(pr);
		$('#priceid'+aid).val(n[2]);
	}
	else if (div=='bookmore'){
		console.log(aid);
		$('#bookmore'+aid).html(bookdata);
		$('#pricequantity'+aid).val(qty);
		$('#pricebookmore'+aid+maid).val(pr);
		$('#priceid'+aid).val(n[2]);
	}
	else if (div=='bookajax'){
		$('#bookajax'+aid).html(bookdata);
		$('#pricebookajax'+aid+maid).val(pr);
		$('#pricequantity'+aid).val(qty);
		$('#priceid'+aid).val(n[2]);
	}
}

function changeactsession(main,aid,val,div)
{   
   /* alert('hii');*/

    var price_title = $('#price_title_hidden'+main+aid).val();
   /* alert(price_title);*/
    var time = $('#time_hidden'+main+aid).val();
    var sportsleft = $('#sportsleft_hidden'+main+aid).val();
    var pricequantity = $('#pricequantity'+main+aid).val();

    if(div =='book'){
        var price = $('#price'+main+aid).val();
    }else if (div =='bookmore'){
        var price = $('#pricebookmore'+aid+main).val();
    }else{
        var price = $('#pricebookajax'+aid+main).val();   
    }
    var session = $('#session'+main+aid).val();;

	if(aid != '')
	{
		$.ajax({
			url: "{{route('pricecategory')}}",
			type: 'POST',
			xhrFields: {
				withCredentials: true
		    },
			data:{
				_token: '{{csrf_token()}}',
				type: 'POST',
				actid:aid,
				catid:val,
                sid:main,
                div:div,
			},
			success: function (response) { //alert(response);
                var  timetitle = '';
                var spotle ='';
                var data = response.split('~~~~~~~~');
				$("#pricechng"+aid).html(data[0]);
                if(data[1] != ''){
                   timetitle = data[1].split('^');
                    if(timetitle[1]!= ''){
                        var spotle = timetitle[1].split('****');
                    }
                }
                if(spotle[0] == 'no'){
                    spotle[0] ='';
                }
              
                if(timetitle != ''){
                    var bookdata= '<p>Category: '+ timetitle[0] +'</p><p> '+ spotle[0] +' </p><p>Spots Left: '+spotle[1] +'</p><br><p>Price Title: '+ price_title+'</p><p>Price Option: '+session+' Session</p><p>Participants: '+pricequantity+'</p><p>Total: $'+price+'/person</p>';
                    if(spotle[1] == 0){
                        $('#addtocart'+aid).css('display','none');
                    }else{
                       
                        $('#addtocart'+aid).css('display','block');
                    }
                }else{
                    var bookdata= '<p>Category: '+ timetitle[0] +'</p><p></p><p>Spots Left: 0 </p><br><p>Price Title: '+ price_title+'</p><p>Price Option: '+session+' Session</p><p>Participants: '+pricequantity+'</p><p>Total: $'+price+'/person</p>';
                    $('#addtocart'+aid).css('display','none');
                }
               
                if(div =='book'){
                    $('#book'+aid).html(bookdata);
                }else if (div =='bookmore'){
                    $('#bookmore'+aid).html(bookdata);
                }else{
                    $('#bookajax'+aid).html(bookdata);
                }
               
                if(timetitle[0] != ''){
                    $('#cate_title'+aid).val(timetitle[0]);
                }
			}
		});
	}
}


function actFilter(cid,sid)
{
	var actoffer=$('#actfiloffer').val();
	var actloc=$('#actfillocation').val();
	var actfilmtype=$('#actfilmtype').val();
	var actfilgreatfor=$('#actfilgreatfor').val();
	var actfilparticipant=$('#actfilparticipant').val();
	var btype=$('#actfilbtype').val();
	var actdate=$('#actfildate').val();
	var actfilsType=$('#actfilsType').val();
	var _token = $('#csrftoken').val();
	var serviceid =sid;
	$.ajax({
		url: "<?php echo route('act_detail_filter_business_pages'); ?>",
		type: 'POST',
		data:{
			_token: _token,
			actoffer:actoffer,
			actloc:actloc,
			actfilmtype:actfilmtype,
			actfilgreatfor:actfilgreatfor,
			actfilparticipant:actfilparticipant,
			btype:btype,
			actdate:actdate,
			actfilsType:actfilsType,
			serviceid:serviceid,
			companyid:cid,
		},
		success: function (response) { //alert(response);
			/*var data = response.split('~~~~');*/
			$('#actsearch').html(response);
		}
	});
}

function changeqnt(aid,price)
{
	var actfilparticipant=$('#actfilparticipant').val();
	if(actfilparticipant>0){
		$('#pricequantity'+aid).val(actfilparticipant);
		if(div=='book'){
			$('#pricebook'+aid).val(price*actfilparticipant);
		}
	}
	else
	{
		$('#pricequantity'+aid).val('1');
	}
	return false;
}

/*function actFilter(cid,sid)
{ 
	var actoffer=$('#actfiloffer').val();
	var actloc=$('#actfillocation').val();
	var actfilmtype='';
	var actfilgreatfor=$('#actfilgreatfor').val();
	var actfilparticipant=$('#actfilparticipant').val();
	var btype=$('#actfilbtype').val();
	//var actdate=$('#actfildate').val();
	var actdate='';
	var actfilsType=$('#actfilsType').val();
	var _token = $("input[name='_token']").val();
	var serviceid =sid;
	//alert(serviceid);
	//alert('call');
	$.ajax({
		url: "{{route('Businessact_detail_filter')}}",
		type: 'POST',
		data:{
			_token: _token,
			actoffer:actoffer,
			actloc:actloc,
			actfilmtype:actfilmtype,
			actfilgreatfor:actfilgreatfor,
			actfilparticipant:actfilparticipant,
			btype:btype,
			actdate:actdate,
			actfilsType:actfilsType,
			serviceid:serviceid,
			companyid:cid,
		},
		success: function (response) { alert(response);
			
			$('#actsearch').html(response);
		}
	});
}
*/</script>