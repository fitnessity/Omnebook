<?php
use App\Bookactivity;
use App\BusinessService;
use App\BusinessServices;
use App\BusinessPriceDetails;
use App\UserBookingDetail;
use App\BusinessServiceReview;
use App\BusinessActivityScheduler;
use App\BusinessPriceDetailsAges;
use App\CompanyInformation;
use App\BusinessServicesFavorite;

if(!empty(request()->id)){ $cid = request()->id; }
else{ $cid = request()->page_id; }
//DB::enableQueryLog();
$actoffer = BusinessServices::where('cid', $cid)->groupBy('sport_activity')->get()->toArray();
//dd(\DB::getQueryLog());

?>
<div class="widget">
	<div class="wid-space"></div>
	<div class="your-page my-business-page">
    	<div class="row fromblock">
        	<h3> <a class="active"> View Activities </a>  </h3>
        	<div class="multiselect-block">
                <div class="col-md-12 col-lg-6 pl-0 pr-0">
                    <select name="actfiloffer" id="actfiloffer" class="bd-right bd-bottom" onchange="actFilter('<?php echo $cid; ?>','0')" autocomplete="off">
                        <option value="">Activity Offered</option>
                        <?php
                            if (!empty($actoffer)) {
                                foreach ($actoffer as  $off) { ?>
                                    <option><?php echo $off['sport_activity'];?></option>
                        <?php } } ?>
                    </select>
                </div>
                <div class="col-md-12 col-lg-6 pl-0 pr-0">
                    <select name="actfillocation" id="actfillocation" class="bd-bottom" onchange="actFilter('<?php echo $cid; ?>','0')" autocomplete="off">
                        <option value="">Location</option>
                        <option value="Online">Online</option>
                        <option value="At Business">At Business Address</option>
                        <option value="On Location">On Location</option>
                    </select>
                </div>
                <div class="col-md-12 col-lg-6 pl-0 pr-0">
                    <select id="actfilmtype" name="actfilmtype" class="bd-right bd-bottom" onchange="actFilter('<?php echo $cid; ?>','0')" autocomplete="off">
                        <option value="">Membership Type</option>
                        <option>Drop In</option>
                        <option>Semester</option>
                    </select>
                </div>
                <div class="col-md-12 col-lg-6 pl-0 pr-0">
                    <select name="actfilgreatfor" id="actfilgreatfor" class="bd-bottom" onchange="actFilter('<?php echo $cid; ?>','0')" autocomplete="off">
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
               <!--  <div class="col-md-12 col-lg-6 pl-0 pr-0 bd-right bd-bottom"> -->
                    <!-- <select name="actfilparticipant" id="actfilparticipant" class="bd-right bd-bottom" onchange="actFilter('<?php echo $cid; ?>','0')">
                        <option value="">#of Participants</option>
                        <?php /*for($i=1; $i<=100; $i++){
                            echo '<option>'.$i.'</option>';
                        }*/ ?>
                    </select> -->
                <!-- </div> -->
                <div class="col-md-12 col-lg-6 pl-0 pr-0">
                    <select id="actfilbtype" name="actfilbtype" class="bd-bottom bd-right" onchange="actFilter('<?php echo $cid; ?>','0')" autocomplete="off">
                        <option value="">Business Type</option>
                        <option value="individual">Personal Trainer</option>
                        <option value="classes">Classes</option>
                        <option value="events">Events</option>
                        <option value="experience">Experience</option>
                    </select>
                </div>
                
                <div class="col-md-12 col-lg-6 pl-0 pr-0">
                    <select name="actfilsType" id="actfilsType" onchange="actFilter('<?php echo $cid; ?>','0')" class="bd-bottom" autocomplete="off">
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

                <div class="col-md-12 col-lg-6 pl-0 pr-0">
                    <div class="special-date bd-right">
                    <input type="text" name="actfildate" id="actfildate" placeholder="Date" class="form-control" onchange="actFilter('<?php echo $cid; ?>','0')" value="{{date('M-d-Y')}}">
                    <i class="fa fa-calendar"></i>
                    </div>
                    <script>
                        $( function() {
                            $( "#actfildate" ).datepicker( { minDate: 0 } );
                        } );
                    </script>
                </div>
        	</div>
        </div>
        
      
        <?php $ascount = BusinessServices::where('cid', $cid)->where('is_active', '1')->count();?>

        <?php
            $activities_search = BusinessServices::where('cid', $cid)->where('is_active', '1')->orderBy('id', 'DESC')->get();
        ?>
            <div id="filtersearchdata">
                <?php
                    if (!empty($activities_search)) { 
                        $companyid = $companyname = $serviceid = $companycity = $companycountry = $pay_price  = "";
                        $i=1;
                        foreach ($activities_search as  $service) {
                            $company = $price = $businessSp = [];
                            $serviceid = $service['id'];
                            $sport_activity = $service['sport_activity'];
                            $companyData = CompanyInformation::where('id',$service['cid'])->first();
                            if (isset($companyData)) {

                                $companyid = $companyData['id'];
                                $companyname = $companyData['dba_business_name'];
                                $companycity = $companyData['city'];
                                $companycountry = $companyData['country'];
                                    
                            }
                           
                            if ($service['profile_pic']!="") {
                                if(str_contains($service['profile_pic'], ',')){
                                    $pic_image = explode(',', $service['profile_pic']);
                                    if( $pic_image[0] == ''){
                                       $p_image  = $pic_image[1];
                                    }else{
                                        $p_image  = $pic_image[0];
                                    }
                                }else{
                                    $p_image = $service['profile_pic'];
                                }

                                if (file_exists( public_path() . '/uploads/profile_pic/' . $p_image)) {
                                   $profilePic = url('/public/uploads/profile_pic/' . $p_image);
                                }else {
                                   $profilePic = url('/public/images/service-nofound.jpg');
                                }

                            }else{ $profilePic = '/public/images/service-nofound.jpg'; }
                            
                            $reviews_count = BusinessServiceReview::where('service_id', $service['id'])->count();
                            $reviews_sum = BusinessServiceReview::where('service_id', $service['id'])->sum('rating');
                            $reviews_avg=0;
                            if($reviews_count>0)
                            {   
                                $reviews_avg= round($reviews_sum/$reviews_count,2); 
                            }
                            $redlink = str_replace(" ","-",$companyname)."/".$service['cid'];
                            $service_type='';
                            if($service['service_type']!=''){
                                if( $service['service_type']=='individual' ) $service_type = 'Personal Training'; 
                                else if( $service['service_type']=='classes' )  $service_type = 'Group Class'; 
                                else if( $service['service_type']=='experience' ) $service_type = 'Experience'; 
                            }
                            $pricearr = [];
                            $price_all = '';
                            $ser_date = '';
                            $price_allarray = BusinessPriceDetails::where('serviceid', $service['id'])->get();
                            if(!empty($price_allarray)){
                                foreach ($price_allarray as $key => $value) {
                                    if(date('l') == 'Saturday' || date('l') == 'Sunday'){
                                        $pricearr[] = $value->adult_weekend_price_diff;
                                    }else{
                                        $pricearr[] = $value->adult_cus_weekly_price;
                                    }
                                }
                            }
                            if(!empty($pricearr)){
                                $price_all = min($pricearr);
                            }
                            
                            $bookscheduler='';
                            $time='';
                            $bookscheduler = BusinessActivityScheduler::where('serviceid', $service['id'])->limit(1)->orderBy('id', 'ASC')->get()->toArray();
                            if(@$bookscheduler[0]['set_duration']!=''){
                                $tm=explode(' ',$bookscheduler[0]['set_duration']);
                                $hr=''; $min=''; $sec='';
                                if($tm[0]!=0){ $hr=$tm[0].'hr. '; }
                                if($tm[2]!=0){ $min=$tm[2].'min. '; }
                                if($tm[4]!=0){ $sec=$tm[4].'sec.'; }
                                if($hr!='' || $min!='' || $sec!='')
                                { $time =  $hr.$min.$sec; } 
                            }
                            if($i<3){
                                if($time != ''){
                    ?>
                <div class="col-md-12 col-sm-8 col-xs-12 ">
                    <div class="find-activity">
                        <div class="row">
                            <div class="col-md-5 col-sm-4 col-xs-12 business-right-panel">
                                <div class="img-modal-left-bpage">
                                    <img src="{{ $profilePic }}" >
                                </div>
                            </div>
                            <div class="col-md-7 col-sm-8 col-xs-12 activity-data">
                                <div class="activity-inner-data">
                                    <i class="fas fa-star"></i>
                                    <span> {{$reviews_avg}} ({{$reviews_count}})  </span>
                                </div>
                                @if($time != '')
                                    <div class="activity-hours time-hours hours-sp">
                                        <span>{{$time}}</span>
                                    </div>
                                @endif
								@if(Auth::check())
										<?php
											$loggedId = Auth::user()->id;
											$favData = BusinessServicesFavorite::where('user_id',$loggedId)->where('service_id',$service['id'])->first();              
										?>
										<div class="serv_fav1 heart-side" ser_id="{{$service['id']}}">
											<a class="fav-fun-2" id="serfav{{$service['id']}}">
												<?php
												if( !empty($favData) ){ ?>
												<i class="fas fa-heart"></i>
												<?php }
													else{ ?>
													<i class="far fa-heart"></i>
												<?php } ?>
											</a>
										</div>
										@else
											<a class="fav-fun-2" href="{{ Config::get('constants.SITE_URL') }}/userlogin" ><i class="far fa-heart"></i></a>
										@endif
									<div class="activity-city city-space">
										<span>{{$companycity}}, &nbsp {{$companycountry}}</span>
										
									</div>
                                <div class="activity-information">
                                    <span><a 
                                        <?php if (Auth::check()) { ?> 
                                            href="{{ Config::get('constants.SITE_URL') }}/businessprofile/{{$redlink}}" 
                                        <?php } else { ?>
                                            href="{{ Config::get('constants.SITE_URL') }}/userlogin" 
                                        <?php }?>
                                            target="_blank">{{ $service['program_name'] }}</a></span>
                                    <p>{{ $service_type }} | {{ $service['sport_activity'] }}</p>
                                    <a class="showall-btn" href="{{route('activities_show',['serviceid'=>  $service['id']])}}">Book Now</a>
                                </div>
                                @if($price_all != '')
                                    <div class="text-center">
                                        <span class="activity-time">From ${{$price_all}}/Person</span>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                <?php 
                        $i++;
                            }
                        }
                    }
                }else{ ?>
                    <div class="col-md-4">
                        <p class="noactivity"> There Is No Activity</p>
                    </div>
                <?php   } ?>
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
    var datan = '';
    var price_title = '';
    if(n[2] != ''){
        datan = n[2].split('^');
        if(datan[1] != ''){
            //alert(datan[1]);
            price_title = datan[1];
            $('#price_title_hidden'+maid+aid).val(datan[1]);
        }
    }
	var actfilparticipant=$('#actfilparticipant').val();
	var category_title = $('#cate_title'+maid+aid).val();
   /* var price_title = $('#price_title_hidden'+maid+aid).val();*/
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
    var pr; var qty;
    //alert(actfiloffer);
    $.ajax({
        url: "{{route('act_detail_filter_business_pages')}}",
        type: 'POST',
        data:{
            _token: _token,
            type: 'POST',
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
        success: function (response) {
            /*alert(response);*/
            if(response != ''){
                $('#filtersearchdata').html(response);
            }else{
                $('#filtersearchdata').html('<div class="col-md-12 col-sm-8 col-xs-12 "><p>No Activity Found.</p></div>');
            }  
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
</script>