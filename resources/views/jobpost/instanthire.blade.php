<?php

	use App\UserFavourite;

	use App\BusinessServicesFavorite;

	use Illuminate\Support\Str;

	use Illuminate\Support\Facades\Auth;

	use App\UserBookingDetail;

	use App\BusinessServiceReview;

	use App\BusinessPriceDetails;

?>

@inject('request', 'Illuminate\Http\Request')

@extends('layouts.header')

@section('content')

<style>

    .direc-list-detail p span {

        font-size: 14px !important;

    }

	.card-claimed-business .content-left-claimed ul li{ margin-left: 3px; }

    .book-professional-link,

    .book-professional-link:hover {

        color: #ffffff !important;

        background: #f53b49 !important;

        padding: 6px;

    }

    /* td.booking_btn{

        background:  !important;

    }*/

    

    @media (min-width: 992px) {

        .modal-lg {

            width: 980px;

        }

    }

    .contentPop {

        width: 100% !important;

        margin-left: 0 !important;

        height: auto !important;

        padding: 0 !important;

    }

    tr.d_none {

        display: none;

    }

    td.bg_color {

        background: #f53b49;

        color: #fff;

        font-weight: bold;

        border: 1px dotted white !important;

        border-left: 1px solid #575656 !important;

    }

    div#id01 {

        padding: 0px !important;

    }

    table.compareItemParent.relPos.comparetable {

        margin: 0 !important;

    }

    a.whiteFont.w3-padding.w3-closebtn.closeBtn {

        color: #fff !important;

        padding: 8px 16px !important;

        background: #f53b49 !important;

        position: initial !important;

        margin-right: 14.2% !important;

        float: right !important;

    }

    .w3-row.contentPop.w3-margin-top {

        margin-top: 0px !important;

    }

    .compareThumb {

        height: 250px;

        width: 250px;

        /*border: 3px solid #f53b49;

        border-radius: 50%;

        box-shadow: 3px 3px 7px 0px #808080ab;*/

    }

    .volarimg img{

        width: 80px;

        height: 80px;

        border-radius: 50%;

        max-width: 100%;

    }

    .kickboxing-block1 .topimg-content {

        height: 190px;

        overflow: hidden;

    }

    .btn-addtocart {

        background-color: #ea1515;

        color: #fff !important;

        text-transform: uppercase;

        border-radius: 5px;

        border: 1px solid #ea1515;

        text-align: center;

        font-size:10px;

        font-weight: bold;

    }

    #milesnew {

        -webkit-appearance: none;

        -moz-appearance: none;

        background: transparent;

        background-image: url("data:image/svg+xml;utf8,<svg fill='black' height='24' viewBox='0 0 24 24' width='24' xmlns='http://www.w3.org/2000/svg'><path d='M7 10l5 5 5-5z'/><path d='M0 0h24v24H0z' fill='none'/></svg>");

        background-repeat: no-repeat;

        background-position-x: 100%;

        background-position-y: 13px;

        border: 1px solid #dfdfdf;

        border-radius: 2px;

        margin-right: 2rem;

        padding: 1rem;

        padding-right: 2rem;

        border:0;

    }

    #instantbook {

        -webkit-appearance: none;

        -moz-appearance: none;

        background: transparent;

        background-image: url("data:image/svg+xml;utf8,<svg fill='black' height='24' viewBox='0 0 24 24' width='24' xmlns='http://www.w3.org/2000/svg'><path d='M7 10l5 5 5-5z'/><path d='M0 0h24v24H0z' fill='none'/></svg>");

        background-repeat: no-repeat;

        background-position-x: 100%;

        background-position-y: 13px;

        border: 1px solid #dfdfdf;

        border-radius: 2px;

        margin-right: 2rem;

        padding: 1rem;

        padding-right: 2rem;

        border:0;

    }

	.sid{  

      margin-top: 20px;

      margin-bottom: 20px;

      color: white;

      font-weight: bold;

    }	

	.card-body h5 {

		font-size: 14px;

	}

	.card-body h4 {

		font-size: 18px;

		font-weight: bold;

	}

	.card-body.h{

      font-weight: bold;



    }

    .card-body.p{

		text-align: justify;

    }

    .card-body p{

      margin-top: 20px;

      font-size: 12px;

    }

    .card-body.rating{

      background-color: red; 

      align-content: center;

      color: white;

      font-size: 8px;

      width: 15px;

    }

	.comparetable{float: left; /*width:100%;*/ margin-top: 10px;margin-bottom: 10px;}

	.comparetable table{}

	.comparetable table tr{}

	.comparetable table tr th{ width: 30%; background:#2e2e2e; text-align: left; padding: 0 20px;}

	.comparetable table tr th h3{ color: #fff; font-size: 14px; font-weight: bold;}

	.comparetable table tr td{/*border-right: none !important;*/}

	.comparetable table tr td{ width:200px !important;}

	.comparetable table tr td h4{ margin: 0; font-weight: bold; font-size: 18px;}

	.comparetable table tr td p{text-align: left; font-size: 12px;}

	.checked { color: white; }

	.rating { background-color: red; align-content: center; color: white; font-size: 8px; padding: 1px 2px;}

	.comparetable table tr td .rating-info p {font-size: 13px; display: inline-block;}

	.fav-fun-1{

		top: 12px;

		color: #f91942;

		position: absolute;

		left: 287px;

		background: white;

		width: 30px;

		height: 30px;

		border: 1px solid #f91942;

		padding: 6px 5px 5px 5px;

		border-radius: 4px;

	}

	.fav-fun-2{

		top: 12px;

		color: #f91942;

		position: absolute;

		background: rgba(255, 255, 255, 0.8);

		padding: 6px 8px;

		border-radius: 4px;

		right: 10px;

	}

	.fav-fun-2 i, .fav-fun-2 p{ display: inline-block; }

	.fav-fun-2 p{ text-transform: uppercase; margin-left: 2px; font-size: 13px; font-weight: bold; font-family: "Segoe UI",Arial,sans-serif; }

	.from-price{

		top: 12px;

		color: #f91942;

		position: absolute;

		background: rgba(255, 255, 255, 0.8);

		padding: 7px 8px;;

		border-radius: 4px;

		left: 10px;

	}

	.from-price p{ color: #000000; font-size: 13px; font-weight: bold; font-family: "Segoe UI",Arial,sans-serif; }

	.compimgtd{ paddint-bottom:0px; }

	.find-business p{font-weight: 600; text-align: center; color: #000000;}

	.find-business{ padding: 15px 0; margin-bottom: 30px;}

	.inner-txt{font-size: 14px; font-weight: normal !important;}

	.addbusiness-btn{

		background: #ea1515;

		color: #fff;

		padding: 6px 12px;

		display: inline-block;

		border-radius: 4px;

		font-weight: 700;

		font-size: 13px;

		margin: 10px 0;

		font-family: "Segoe UI",Arial,sans-serif;

		text-transform: uppercase;

	}

	.addbusiness-btn:hover{color: #fff !important;}

	.modal-inner-txt p{font-size: 18px; text-align: center; padding: 18px; color: #000;}

	.btns-modal{text-align: center;}

	.addbusiness-btn-modal{

		background: #ea1515;

		color: #fff;

		padding: 12px 15px;

		display: inline-block;

		border-radius: 4px;

		font-weight: 700;

		font-size: 13px;

		margin: 10px 0;

		font-family: "Segoe UI",Arial,sans-serif;

		text-transform: uppercase;

	}

	.addbusiness-btn-modal:hover{color: #fff !important;}

	.addbusiness-btn-black{

		background: #fff;

		color: #000;

		padding: 12px 15px;

		display: inline-block;

		border-radius: 4px;

		font-weight: 700;

		font-size: 13px;

		margin: 10px 0;

		font-family: "Segoe UI",Arial,sans-serif;

		text-transform: uppercase;

		border: 1px solid #000;

	}

	.addbusiness-btn-black:hover{color: #ea1515 !important}

	.addbusiness-btn-black:focus{color: #ea1515 !important;}



	

</style>



<link rel="stylesheet" href="<?php echo Config::get('constants.FRONT_CSS'); ?>compare/style.css">

<link rel="stylesheet" href="<?php echo Config::get('constants.FRONT_CSS'); ?>compare/w3.css">

<link href="https://code.jquery.com/ui/1.12.1/themes/pepper-grinder/jquery-ui.css" type="text/css" rel="stylesheet" />

<script src="<?php echo Config::get('constants.FRONT_JS'); ?>compare/Compare.js"></script>



<script src="{{ url('public/js/jquery-ui.multidatespicker.js') }}"></script>

<script src="{{ url('public/js/jquery-ui.min.js') }}"></script>



<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.css">

<script src="https://cdn.jsdelivr.net/npm/@fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.js"></script>


<section class="direc-hire" style="margin-top:50px">

    <?php 

    use App\User;

    use App\AddrCities;    

    ?>

    @include('includes.search_category_sidebar')

    

    <div class="direc-right direc-right-new">

        <div class="distance-block">

            <?php

			

            $ZipCode = $Country = "";

            $miles_arr = array('1'=>'1 Mile','3'=>'3 Miles','5'=>'5 Miles','10'=>'10 Miles','15'=>'15 Miles','20'=>'20 Miles');

            ?>

            <!-- <select name="distance" id="milesnew">

                <option value="0">Distance (1 Mile)</option>

                <?php foreach($miles_arr as $key=>$value) { ?>

                <option value="<?= $key; ?>"><?php echo $value; ?></option>

                <?php } ?>

            </select> -->

            

            <select name="instantbook" id="instantbook" style="display:none">

                <option value="">Instant Book</option>

                <option>Instant Hire</option>

                <option>Other</option>

            </select>

            

            <div class="mapsb">Show Maps

                <label class="switch" for="maps">

                    <input type="checkbox" name="maps" id="maps" checked>

                    <span class="slider round"></span>

                </label>

            </div>

            

        </div>

        <div class="col-md-8 col-xs-12 leftside-kickboxing">

            <div class="col-md-12 col-xs-12" id="buisnessuser">

                <?php

                    $companyid = $companylogo = $companyname = $companyaddress = $latitude = $longitude = $serviceid = "";

                    $pay_session = $pay_price = $pay_setduration = $pay_discount = $languages = $companyabout = "";

    				$companycity = $companycountry = $companyzip = "";

                    if (isset($serviceData)) {

                        $servicetype = [];

                        foreach ($serviceData as $loop => $service) {

                            $company = $price = $businessSp = [];

    						$serviceid = $service['id'];

                            $sport_activity = $service['sport_activity'];

                            $servicetype[$service['service_type']] = $service['service_type'];

                            $area = !empty($service['area']) ? $service['area'] : 'Location';

                            if (isset($companyData)) {

                                if (isset($companyData[$service['cid']]) && !empty($companyData[$service['cid']])) {

                                    $company = $companyData[$service['cid']];

                                    $company = isset($company[0]) ? $company[0] : [];

                                    if(!empty($company)) {

                                        $companyid = $company['id'];

                                        $companylogo = $company['logo'];

                                        $companyname = $company['company_name'];

                                        $companyaddress = $company['address'];

                                        $latitude = $company['latitude'];

                                        $longitude = $company['longitude'];

    									$companycity = $company['city'];

    									$companycountry = $company['country'];

    									$companyzip = $company['zip_code'];

    									$companyabout = $company['about_company'];

                                    }

                                    $price = $servicePrice[$service['cid']];

                                    $price = isset($price[0]) ? $price[0] : [];

                                    if(!empty($price)) {

                                        $pay_session = $price['pay_session'];

                                        $pay_price = !empty($price['pay_price']) ? $price['pay_price'] : '100';

                                        $pay_setduration = $price['pay_setduration'];

                                        $pay_discount = $price['pay_discount'];

                                    }

                                    $businessSp = $businessSpec[$service['cid']];

                                    $businessSp = isset($businessSp[0]) ? $businessSp[0] : [];

                                    if(!empty($businessSp)) {

                                        $languages = $businessSp['languages'];

                                    }

                                }

                            }



                            if ($service['profile_pic']!="") {

    							if(File::exists(public_path("/uploads/profile_pic/thumb/" . $service['profile_pic']))) {

                                	$profilePic = url('/public/uploads/profile_pic/thumb/'.$service['profile_pic']);

    							} else {

    								$profilePic = '/public/images/service-nofound.jpg';

    							}

    						}else{ $profilePic = '/public/images/service-nofound.jpg'; }

    						

    						$price_all = BusinessPriceDetails::where('serviceid', $service['id'])->get()->toArray();

    						//print_r($price_all);

    						//echo $price_all['pay_price'];

    						if(!empty($price_all))

    						{

    							$pay_session = $price_all[0]['pay_session'];

                               	$pay_price = !empty($price_all[0]['pay_price']) ? $price_all[0]['pay_price'] : '100';

    							$pay_setduration = $price_all[0]['pay_setduration'];

    							$pay_discount = $price_all[0]['pay_discount'];

    						}

    						

                            ?>

                            <div class="col-md-6 col-xs-12 kickboxing-block1 selectProduct" data-id="{{ $service['id'] }}" data-title="{{ $service['program_name'] }}" data-name="{{ $service['program_name'] }}" data-companyname="{{ $companyname }}" data-email="" data-address="{{ $companyaddress }}" data-img="{{ $profilePic }}" data-price="{{ $pay_price }}" data-token="{{ csrf_token() }}"> 

                                @if(Auth::check())

    								<?php

                                    $loggedId = Auth::user()->id;

                                    $favData = BusinessServicesFavorite::where('user_id',$loggedId)->where('service_id',$service['id'])->first();                   

                                    ?>

                                    <?php /*?>@if(!empty($favData))

                                        <div class="topimg-content fav-fun serv_fav" company_id="{{$companyid}}" ><?php */?>

                                        <div class="topimg-content serv_fav" ser_id="{{$service['id']}}" >

                                            <img src="{{ $profilePic }}" class="Fitnessity productImg">

                                            <?php /*?><a class="from-price"><p> From $25 - $3000 </p> </a><?php */?>

                                            <a class="fav-fun-2" id="serfav{{$service['id']}}">

                                            	<?php

                                            	if( !empty($favData) ){ ?>

                                                	<i class="fas fa-heart"></i> <p> Favorite </p>

                                                <?php }

    											else{ ?>

                                            		<i class="far fa-heart"></i> <p> Favorite </p>

                                                <?php } ?> 

                                            </a>

                                           

                                        </div>

                                    <?php /*?>@endif<?php */?>

                                @else

                                    <div class="topimg-content" company_id="{{$companyid}}">

                                        <img src="{{ $profilePic }}" class="productImg">

                                        <a class="fav-fun-2" href="{{ Config::get('constants.SITE_URL') }}/userlogin" ><i class="far fa-heart"></i> <p> Favorite </p> </a>                                    

                                    </div>

                                @endif

                                

                                <?php

                                if ($companylogo!="" && File::exists(public_path("/uploads/profile_pic/thumb/" . $companylogo))) {

                                    $companyLogo = url('/public/uploads/profile_pic/thumb/' . $companylogo);

                                } else {

                                    $companyLogo = '/public/images/default-avatar.png';

                                }

    							$reviews_count = BusinessServiceReview::where('service_id', $service['id'])->count();

    							$reviews_sum = BusinessServiceReview::where('service_id', $service['id'])->sum('rating');

    									

    							$reviews_avg=0;

    							if($reviews_count>0)

    							{	$reviews_avg= round($reviews_sum/$reviews_count,2); }

                                ?>

                                <div class="bottom-content">

                                    <div class="ratset-img">

                                        <div class="rattxt"><i class="fa fa-star" aria-hidden="true"></i> {{$reviews_avg}} ({{$reviews_count}})</div>

                                        <div class="volarimg"><img src="{{ $companyLogo }}"></div>

                                        <div class="verifiedimg" style="min-width: 50px;">

                                        	<img src="/public/images/verified-logo.png" style="display:none;">

                                        </div>

                                    </div>

                                    <?php

    									$redlink = str_replace(" ","-",$companyname)."/".$service['cid'];

    								?>

                                    <?php /*?><h3 class="card-title card-claimed-businessnew" myposition="{{ $loop }}" company_id="{{$companyid}}" business_name="{{$companyname}}" logo="{{$companyLogo}}" latitude="{{$latitude}}"  longitude="{{$longitude}}"><?= $service['program_name'] ?></h3><?php */?>

                                    <h2><a <?php if (Auth::check()) { ?> href="{{ Config::get('constants.SITE_URL') }}/businessprofile/{{$redlink}}" <?php } else { ?> href="{{ Config::get('constants.SITE_URL') }}/userlogin" <?php }?> target="_blank">{{ $service['program_name'] }}</a></h2>

                                    <p class="aboutcomp"> {{ Str::limit($service['program_desc'], 80, $end='') }} 

                                    	<?php if( strlen($service['program_desc']) >80 ){

    											echo '<a href=""> more... </a>';

    										}

    									?>

                                    </p>

                                    

                                    <p class="caddress"><a <?php if (Auth::check()) { ?> href="{{ Config::get('constants.SITE_URL') }}/businessprofile/{{$redlink}}" <?php } else { ?> target="_blank" href="{{ Config::get('constants.SITE_URL') }}/userlogin" <?php }?>>{{ $companyname }}</a></p>

                                    <?php if( !empty($companycity) || !empty($companycountry) || !empty($companyzip) ){

    										echo '<p class="ccountry">';

    										if(!empty($companyaddress)) { echo $companyaddress; }

                                    		if(!empty($companycity)) { echo ', '.$companycity; }

                                   			if(!empty($companycountry)) { echo ', '.$companycountry; }

                                    		if(!empty($companyzip)) { echo ', '.$companyzip; }

    										echo '</p>';

    									}

    									$service_type='';

    									if($service['service_type']!=''){

    										if( $service['service_type']=='individual' ){ $service_type = 'Personal Training'; }

    										else if( $service['service_type']=='classes' ){ $service_type = 'Group Classe'; }

    										else if( $service['service_type']=='experience' ){ $service_type = 'Experience'; }

    								?> 

                                    <p class="sertype"> {{ $service_type }} </p>

                                    <?php } ?>

                                    <h5>{{ $service['sport_activity'] }}</h5>

                                    <hr>

                                    <a class="moredetails-btn" data-toggle="modal" data-target='#mykickboxing{{$service["id"]}}'>More Details</a>

                                    <p class="addToCompare" id='compid{{$service["id"]}}' title="Add to Compare">COMPARE SIMILAR Activity +</p>

                                  

                                </div>

                                

                            </div>

                            

                            @include('jobpost.instanthire_detail')

                            <?php

                        }

                    }



                    if (isset($searchDataProfile)) {

                        $servicetype = [];

                        foreach ($searchDataProfile as  $searchDataProfiles) {

                            $userData = User::find($searchDataProfiles->id);

                            $city = AddrCities::find($userData->city);

                           

                            ?>

                            <div class="col-md-6 col-xs-12 kickboxing-block1 selectProduct"> 

                                <div class="topimg-content">

                                    <?php

                                    

                                    ?>

                                    <img src="{{ url('public/uploads/profile_pic/thumb/') }}/{{$userData->profile_pic}}" class="productImg">

                                    <div class="sorttext">

                                        <div class="fromtxt hide">From #25 - #3000</div>

                                        <div class="claimedtxt hide">CLAIMED</div>

                                        <div class="favoritetxt hide"><i class="fa fa-heart-o"></i>FAVORITE</div>

                                    </div>

                                </div>

                                

                                <div class="bottom-content 22">

                                    <div class="ratset-img">

                                        <div class="rattxt"><!--<i class="fa fa-star" aria-hidden="true"></i> 4.6 (146)--></div>

                                        <div class="volarimg"><img src="{{ url('public/uploads/profile_pic/thumb/') }}/{{$userData->profile_pic}}"></div>

                                        <div class="verifiedimg"><!--<img src="/public/images/verified-logo.png">--></div>

                                    </div>

                                    <h3 class="card-title card-claimed-businessnew"><?php echo $userData->username ?></h3>

                                   <!--  <h6><a href="/blade-check/<?=$companyid?>" target="_blank" style="font-size:15px; font-weight:bold; color:red">aa</a></h6> -->

                                    <p><?php echo $userData->phone_number ?></p>

                                    <h5>{{$city->city_name}}</h5>

                                    <hr>

                                    <a href="{{route('profileDetail',$userData->id)}}" class="moredetails-btn"  >More Details</a>

                                   <!--  <p class="addToCompare" title="Add to Compare">COMPARE SIMILAR OPTION +</p> -->

                                </div>

                            </div>

                            

                            <?php

                        }

                    }
                

               

               /* @include('jobpost.instanthire_checkout') */?>

                <div class="pagenation" style="display:none">

                    <a href="#" class="active">1</a>

                    <a href="#">2</a>

                </div>

                <div class="col-md-12 col-xs-12">{!! $serviceData->links() !!}</div>

				<div class="row">

					<div class="col-md-9 col-xs-12">

						<div class="find-business">

							<p>Can't Find A Business Offering Your Favorite Activity?</p>

							<p class="inner-txt">You can add a business to fitnessity for free.</p>

						</div>

					</div>

					<div class="col-md-3 col-xs-12 txt-center find-business">

						<a href="#" class="addbusiness-btn" data-toggle="modal" data-target="#addbusiness" >Add A Business</a>

					</div>

				</div>
 
            </div>
	</div>
            <div class="col-md-4 col-sm-12 col-xs-12 kickboxing_map">

                <div class="mysrchmap" style="display:none; position:relative; height:100vh;">

                    <div id="map_canvas" style="position: absolute; top: 0; right: 0; bottom: 0; left: 0;"></div>

                </div>

                <div class="maparea ">

                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d24176.251535935986!2d-73.96828678121815!3d40.76133318281456!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x89c258c4d85a0d8d%3A0x11f877ff0b8ffe27!2sRoosevelt%20Island!5e0!3m2!1sen!2sin!4v1620041765199!5m2!1sen!2sin" style="border:0;" allowfullscreen="" loading="lazy"></iframe>

                </div>

            </div>

			

            

            

            <!--preview panel-->

            <div class="w3-container w3-center">

                <div class="w3-row w3-card-4 w3-round-large w3-border comparePanle w3-margin-top">

                    <div class="w3-row">

                        <div class="w3-col l12 m12 s12 w3-margin-top">

                            <h4 style="text-transform: uppercase; font-weight: bold; margin-bottom: 30px;">

                                Added for Comparison

                                <span title="Close" class="closeItems" style="float:right; padding-right:15px; cursor: pointer;color:#ea1515">

                                <i class="fas fa-times-circle"></i> </span>

                            </h4>                            

                        </div>

                        <!--  <div class="w3-col l3 m4 s6 w3-margin-top">

                                &nbsp;

                                <button type="button" class="btn btn-primary notActive cmprBtn" data-toggle="modal" data-target="#myModal" disabled>Compare</button>

                                 <button class="w3-round-small w3-border notActive cmprBtn" disabled>Compare</button> 

                            </div> -->

                    </div>

                    <div class=" titleMargin w3-container comparePan">

                        <button type="button" class="btn btn-primary notActive cmprBtn addtcmpr-btn" data-toggle="modal" data-target="#myModal">Compare</button>

                    </div>

                </div>

            </div>

            <!--end of preview panel-->

			

			<!-- The Modal Add Business-->

            <div class="modal fade compare-model" id="addbusiness">

                <div class="modal-dialog modal-lg business">

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

								<div class="col-lg-12">

								   <h4 class="modal-title" style="text-align: center; color: #000; line-height: inherit; font-weight: 600;">ADD BUSINESS</h4>

								</div>

                                <div class="col-lg-12">

                                    <div class="modal-inner-txt">

                                    	<p>Are you a customer or business owner wanting to add information about a business? <br>It’s free to add to Fitnessity!</p>

                                    </div>

                                </div>

								<div class="col-lg-12 btns-modal">

									<a href="#" class="addbusiness-btn-modal">I'M A CUSTOMER</a>

									<a href="https://fitnessity.co/claim-your-business" class="addbusiness-btn-black">I'M A BUSINESS OWNER</a>

								</div>

							 </div>

                        </div>

                    </div>

                </div>

            </div>

			<!-- end modal -->

			

            <!-- The Modal -->

            <div class="modal fade compare-model" id="myModal">

                <div class="modal-dialog modal-lg">

                    <div class="modal-content">

						<div class="modal-header" style="text-align: right;">

						  <button class="clear_compare_list" type="button" style="color: white; border-color: red; background-color: red; margin-top: -5px;" data-dismiss="modal">×</button>

                         <?php /*?> <button type="button" style="color: white; border-color: red; background-color: red; margin-top: -5px;" 

                          class="compdetailclose" >×</button><?php */?>

						</div>

                        <?php /*?><div class="modal-header" style="background:rgba(24, 24, 24, .9); color:#FFF; font-size:30px">

                            <h4 class="modal-title" style="text-align: center; font-weight: bold">

                                COMPARE WITH SIMILAR ITEMS

                                <span title="Close" data-dismiss="modal" class="closeItems" style="float:right; padding-right:15px; cursor: pointer"><i class="fas fa-times-circle"></i></span>

                            </h4>

                            

                        </div>

<?php */?>

                        <!-- Modal body -->

                        <div class="modal-body" style="padding: 0px;">

							<div class="row contentPop">

								<div class="col-lg-12 theme-black-bgcolor">

								   <h4 class="modal-title" style="text-align: center; color: white; line-height: inherit; padding: 6px;">COMPARE WITH SIMILAR ITEMS</h4>

								</div>

                                <div class="col-lg-12" style="padding-left: 0;padding-right: 0;">

                                    <div class="comparetable compare-records-div">

                                    	

                                    </div>

                                </div>

								

								<!-- <div class="col-lg-12" > &nbsp;</div>

								<div class="col-lg-2 col-6" style="background:black;  margin-top: 70px;">

								

								  <div class="card"  >

									<div class="card-body" > 

									  <h5 class="sid">Program Name</h5>

									  <h5 class="sid">Description</h5>

									  <h5 class="sid">Activity Type</h5>

									  <h5 class="sid">Reviews</h5>

									  <h5 class="sid">Price Renge</h5>

									  <h5 class="sid">State,City,Zip Code</h5>

									  <h5 class="sid">Business Name</h5>

									  <h5 class="sid">Business Verified</h5>

									  <h5 class="sid">Background Checked</h5>

									  <h5 class="sid">Offers Services To</h5>

									  <h5 class="sid">Other Activities Offerd</h5>

									  <h5 class="sid">Personality of Instructor</h5>

									  <h5 class="sid">Type of Service</h5>

									  <h5 class="sid">Location of Service</h5>

									  <h5 class="sid">Experience of Activity</h5>

									</div> 

								  </div>

								</div>-->

								<!--<div class="compare-records-div">

									  

								</div>-->

							 </div>

                           <!-- <div id="id01" class="w3-animate-zoom w3-white w3-modal modPos">

								<div class="w3-row contentPop w3-margin-top">

								</div>

							</div>-->

                        </div>



                        <!-- Modal footer -->

                        <!-- <div class="modal-footer">

                    			<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

                    		</div> -->



                    </div>

                </div>

            </div>

            <!-- comparision popup-->



            <!--end of comparision popup-->

            <!--  warning model  -->



            <div id="WarningModal" class="w3-modal">

                <div class="w3-modal-content warningModal">

                    <header class="w3-container w3-teal" style="background-color:#f53b49 !important;">

                        <h3>

                            <span>&#x26a0;</span> You cannot compare more then 3 Activity

                            <button id="warningModalClose" onclick="document.getElementById('id01').style.display='none'" class="w3-btn w3-hexagonBlue w3-margin-bottom" style="float:right;background-color:#f53b49 !important;">X</button>

                        </h3>

                    </header>

                    <div class="w3-container">

                        <h4>Maximum of Three products are allowed for comparision</h4>

                    </div>

                </div>

            </div>

            <!--  end of warning model  -->



        </div>

        

    </div>

</section>

<div class="modal fade compare-model11" id="actreview">

	<div class="modal-dialog">

		<div class="modal-content">

			<div class="modal-header" style="text-align: right;">

            	<button class="clear_compare_list" type="button" style="color: white; border-color: red; background-color: red; margin-top: -5px;" id="closeActreview" >×</button>

                

            </div>

            <div class="modal-body" style="padding: 0px;">

				<div class="row">

					<div class="col-lg-12">

                    	<div id="actreviewBody" class="service-review actreviewBody">

                        	<div class="row">

                                <div class="col-md-8"> 

                                    <h3 class="subtitle"> 

                                        <div class="row">

                                            <div class="col-md-3"> Reviews: </div>

                                            <div class="col-md-9">

                                                <p> <a class="activered font-bold"> By Everyone  </a>

                                                    <a class="font-bold"> | By People I know </a>

                                                </p>

                                            </div>

                                        </div>

                                    </h3>

                                    <div class="service-review-desc">

										<?php

                                        $reviews_count = BusinessServiceReview::where('service_id', 4)->count();

                                        $reviews_sum = BusinessServiceReview::where('service_id', 4)->sum('rating');

                                        

                                        $reviews_avg=0;

                                        if($reviews_count>0)

                                        {	$reviews_avg= round($reviews_sum/$reviews_count,2); }

                                        ?>

                                        

                                        <p> {{$reviews_count}} Reviews </p> 

                                        <div class="rattxt activered"><i class="fa fa-star" aria-hidden="true"></i> {{$reviews_avg}} </div>

                                    </div>

								</div> <!-- 8 -->

                                <div class="col-md-4"> 

                            		<?php /*?><a class="btn submit-rev mt-10"> Submit Review </a><?php */?>

                                	<div class="rev-follow">

                                    	<a class="rev-follow-txt">{{$reviews_count}} People Reviewed This</a>

                                        <div class="users-thumb-list">

                                            <?php 

                                            $reviews_people = BusinessServiceReview::where('service_id',4)->orderBy('id','desc')->limit(6)->get(); 

                                            ?>

                                            @if(!empty($reviews_people))

                                                @foreach($reviews_people as $people)

                                                    <?php $userinfo = User::find($people->user_id); ?>

                                                    <a href="<?php echo config('app.url'); ?>/userprofile/{{@$userinfo->username}}" target="_blank" title="{{$userinfo->firstname}} {{$userinfo->lastname}}" data-toggle="tooltip">

                                                        <!--<img src="{{ url('public//images/newimage/userlist-1.jpg') }}" alt="">  -->

                                                        @if(File::exists(public_path("/uploads/profile_pic/thumb/".$userinfo->profile_pic)))

                                                        <img src="{{ url('/public/uploads/profile_pic/thumb/'.$userinfo->profile_pic) }}" alt="{{$userinfo->firstname}} {{$userinfo->lastname}}">

                                                        @else

                                                            <?php

                                                            $pf=substr($userinfo->firstname, 0, 1).substr($userinfo->lastname, 0, 1);

                                                            echo '<div class="admin-img-text"><p>'.$pf.'</p></div>'; ?>

                                                        @endif

                                                    </a>

                                                @endforeach

                                            @endif

                                            

                                        </div>

									</div><!-- rev-follow -->

								</div> <!-- 4 -->

                                <div class="col-md-12"> 

                                    <div class="ser-review-list" id="user_ratings_div<?php echo 4; ?>">

                                    <?php

                                        $reviews = BusinessServiceReview::where('service_id', 4)->get();

                                    ?>

                                        @if(!empty($reviews))

                                            @foreach($reviews as $review)

                                            <?php $userinfo = User::find($review->user_id); ?>

                                                <div class="ser-rev-user">

                                                    <div class="row">

                                                        <div class="col-md-2"> 

                                                            @if(File::exists(public_path("/uploads/profile_pic/thumb/".$userinfo->profile_pic)))

                                                            <img class="rev-img" src="{{ url('/public/uploads/profile_pic/thumb/'.$userinfo->profile_pic) }}" alt="{{$userinfo->firstname}} {{$userinfo->lastname}}">

                                                            @else

                                                                <?php

                                                                $pf=substr($userinfo->firstname, 0, 1).substr($userinfo->lastname, 0, 1);

                                                                echo '<div class="reviewlist-img-text"><p>'.$pf.'</p></div>'; ?>

                                                            @endif

                                                        </div>

                                                        <div class="col-md-10">

                                                            <h4> {{$userinfo->firstname}} {{$userinfo->lastname}}

                                                            <div class="rattxt activered"><i class="fa fa-star" aria-hidden="true"></i> {{$review->rating}} </div> </h4> 

                                                            <p class="rev-time"> {{date('d M-Y',strtotime($review->created_at))}} </p>

                                                        </div>

                                                    </div>

                                                </div>

                                                <div class="rev-dt">

                                                	<p class="mb-15"> {{$review->title}} </p>

                                                    <p> {{$review->review}} 111 </p>

                                                    <?php

														if( !empty($review->images) ){

															$rimg=explode('|',$review->images);

															echo '<div class="listrimage">';

															foreach($rimg as $img)

															{ ?>

																<a href="{{ url('/public/uploads/review/'.$img) }}" data-fancybox="group" data-caption="{{$review->title}}">

																<img src="{{ url('/public/uploads/review/'.$img) }}" alt="Fitnessity" />

																</a>

																<?php

															}

															echo '</div>';

														}

													?>

                                                </div>

                                            @endforeach

                                        @endif

                                	</div>

                                </div> <!-- 12 -->

                                

							</div> <!-- row --> 

                                    

                                    

                        </div>

            		</div>

				</div>

			</div> 

                    

		</div>

	</div>

</div>

                        





@include('layouts.footer')



<script>
$(document).ready(function () {
    var locations = @json($locations);
   /* alert(locations);*/
    var map = ''
    var infowindow = ''
    var marker = ''
    var markers = []
    var circle = ''
    $('#map_canvas').empty();

    if (locations.length != 0) {  console.log('!empty');
        map = new google.maps.Map(document.getElementById('map_canvas'), {
            zoom:18,
            center: new google.maps.LatLng(locations[0][1], locations[0][2]),
            mapTypeId: google.maps.MapTypeId.ROADMAP,
        });
        infowindow = new google.maps.InfoWindow();
        var bounds = new google.maps.LatLngBounds();
        var marker, i;
        var icon = {
            url: "https://fitnessity.govindcrankrod.com/public/images/hoverout2.png",
            scaledSize: new google.maps.Size(50, 50),
            labelOrigin: {x: 25, y: 16}
        };
        for (i = 0; i < locations.length; i++) {
            var labelText = i + 1
            marker = new google.maps.Marker({
                position: new google.maps.LatLng(locations[i][1], locations[i][2]),
                map: map,
                icon: icon,
                title: labelText.toString(),
                label: {
                    text: labelText.toString(),
                    color: '#222222',
                    fontSize: '12px',
                    fontWeight: 'bold'
                }
            });

            bounds.extend(marker.position);

            var img_path = "{{Config::get('constants.USER_IMAGE_THUMB')}}";
            var contents =
                    '<div class="card-claimed-business"> <div class="row"><div class="col-lg-12" >' +
                    '<div class="img-claimed-business">' +
                    '<img src=' + img_path + encodeURIComponent(locations[i][4]) + ' alt="">' +
                    '</div></div> </div>' +
                    '<div class="row"><div class="col-lg-12" ><div class="content-claimed-business">' +
                    '<div class="content-claimed-business-inner">' +
                    '<div class="content-left-claimed">' +
                    '<a href="/pcompany/view/' + locations[i][3] + '">' + locations[i][0] + '</a>' +
                    '<ul>' +
                    '<li class="fill-str"><i class="fa fa-star"></i></li>' +
                    '<li class="fill-str"><i class="fa fa-star"></i></li>' +
                    '<li class="fill-str"><i class="fa fa-star "></i></li>' +
                    '<li><i class="fa fa-star"></i></li>' +
                    '<li><i class="fa fa-star"></i></li>' +
                    '<li class="count">25</li>' +
                    '</ul>' +
                    '</div>' +
                    '<div class="content-right-claimed"></div>' +
                    '</div>' +
                    '</div></div></div>' +
                    '</div>';

            google.maps.event.addListener(marker, 'mouseover', (function (marker, contents, infowindow) {
                return function () {
                    infowindow.setPosition(marker.latLng);
                    infowindow.setContent(contents);
                    infowindow.open(map, this);
                };
            })(marker, contents, infowindow));
            markers.push(marker);
        }

        //nnn commented on 18-05-2022 - its not displaying proper map
       // map.fitBounds(bounds);
       // map.panToBounds(bounds);
        
        $('.mysrchmap').show()
    } else {
        $('#mapdetails').hide()
        
        /*console.log('else map');
        map = new google.maps.Map(document.getElementById('map_canvas'), {
            zoom: 8,
            center: new google.maps.LatLng(42.567200, -83.807250),
            mapTypeId: google.maps.MapTypeId.ROADMAP
        });
        $('.mysrchmap').show()*/
    }
});
</script>

<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js">

  /*$(".fav-fun").click(function () {
        var company_id = $(this).attr('company_id');
        var _token = $("input[name='_token']").val();
        var cid = company_id;
        $.ajax({
            type: 'POST',
            url: '{{route("favourite")}}',
            data: {
                _token: _token,
                cid: cid
            },
            success: function (data) {
                window.location.reload();
            }
        });
    });*/

    $(document).on('click', '.serv_fav', function(){
        var ser_id = $(this).attr('ser_id');
        var _token = $("input[name='_token']").val();
        $.ajax({
            type: 'POST',
            url: '{{route("service_fav")}}',
            xhrFields: {
                withCredentials: true
            },
            data: {
                _token: _token,
                ser_id: ser_id
            },

            success: function (data) {
                if(data.status=='like'){
                    $('#serfav'+ser_id).html('<i class="fas fa-heart"></i><p> Favorite </p>');
                }else{
                    $('#serfav'+ser_id).html('<i class="far fa-heart"></i><p> Favorite </p>');
                }
            }
        });
    });  
</script>


@if(!empty($cart['cart_item']))

<script type="text/javascript">

    $(window).on('load', function() {

        //$('#successAddCart').modal('show');

    });

</script>

@endif



<script>

function viewActreview(aid)

{

	var _token = $("input[name='_token']").val();

	$.ajax({

		type: 'POST',

		url: '{{route("viewActreview")}}',

		data: {

			_token: _token,

			aid: aid

		},

		success: function (data) {

			$('#actreviewBody').html(data);

			$("#actreview").modal('show');

		}

	});

}



$(document).ready(function () {

	$("#closeActreview").click(function(){

    	$("#actreview").modal('hide');

		return false;

    });

	

    $(document).on('click', '.show-compare-detail', function () {

		$('.compare-model').modal('hide');

		let itemID = $(this).data('id');

		$('#mykickboxing'+itemID).modal('show');

	});

    

	$("#milesnew").on("change", function() {

        var distance = $(this).val();

        var zipcode = '<?=$ZipCode?>';

        var country = '<?=$Country?>';

        var searchString = "new delhi";

        

        if(zipcode != '' || country != '') {

        	searchString = zipcode + '&amp;' + country;

        } else {

        	searchString = ($("#exp_city").val() != "") ? $("#exp_city").val() : "new delhi";

        }

        /*

        var mapURL = "https://maps.google.com/maps?width=400&amp;height=300&amp;hl=en&amp;t=&amp;ie=UTF8&amp;iwloc=B&amp;output=embed";

        mapURL += "&amp;q=" + searchString;

        mapURL += "&amp;z=" + distance;



        var frame = '<iframe id="gmap_iframe" src="' + mapURL + '" style="border:0;" allowfullscreen="" loading="lazy"></iframe>';

        $(".maparea").html(frame);

        */

    });

    

    $(".mapsb .switch .slider").click(function () {

        $(".kickboxing_map").toggleClass("mapskick");

        $(".leftside-kickboxing").toggleClass("kicks");

    });

});



$(document).ready(function () {

    // Close modal on button click

    $(".btn-addtocart").click(function () {

        $(".mykickboxing").modal('hide');

    });

});



$(document).ready(function () {

    // Close modal on button click

    $(".conti").click(function () {

        $(".successAddCart").modal('hide');

    });

});



$(document).on("click", "i.del", function () {

    // to remove card

    $(this).parent().remove();

    // to clear image

    // $(this).parent().find('.imagePreview').css("background-image","url('')");

});



$(function () {

    $(document).on("change", ".uploadFile", function () {

        var uploadFile = $(this);

        var files = !!this.files ? this.files : [];

        if (!files.length || !window.FileReader)

            return; // no file selected, or no FileReader support



        if (/^image/.test(files[0].type)) { // only image file

            var reader = new FileReader(); // instance of the FileReader

            reader.readAsDataURL(files[0]); // read the local file



            reader.onloadend = function () { // set image data as background of div

                //alert(uploadFile.closest(".upimage").find('.imagePreview').length);

                uploadFile.closest(".imgUp").find('.imagePreview').css("background-image", "url(" + this.result + ")");

            }

        }



    });

});



$("#viewmore1").click(function () {

    $("#kickboxing1").addClass("intro");

    $("#viewless1").show();

    $("#viewmore1").hide();

});

$("#viewless1").click(function () {

    $("#kickboxing1").removeClass("intro");

    $("#viewless1").hide();

    $("#viewmore1").show();

});

$("#viewmore2").click(function () {

    $("#kickboxing2").addClass("intro1");

    $("#viewless2").show();

    $("#viewmore2").hide();

});

$("#viewless2").click(function () {

    $("#kickboxing2").removeClass("intro1");

    $("#viewless2").hide();

    $("#viewmore2").show();

});

$("#viewmore3").click(function () {

    $("#kickboxing3").addClass("intro2");

    $("#viewless3").show();

    $("#viewmore3").hide();

});

$("#viewless3").click(function () {

    $("#kickboxing3").removeClass("intro2");

    $("#viewless3").hide();

    $("#viewmore3").show();

});

</script>

<script src="<?php echo Config::get('constants.FRONT_JS'); ?>ratings.js"></script>

<script>

/*$(function(){

    $(".starrr").on("click", function(){

		var sid=$(this).attr("data-service"); 

        var $this = $(this); //  assign $(this) to $this

        var ratingValue = $this.val();  // use '.val()' as shown here 

		alert(ratingValue);

        $('#rating'+sid).val(ratingValue);

    });

});*/



function submit_rating(sid)
{
	@if(Auth::check())
    	//var formData = $("#sreview"+sid).serialize();
    	var formData = new FormData();
    	var rating=$('#rating'+sid).val();
    	var review=$('#review'+sid).val();
    	var rtitle=$('#rtitle'+sid).val();
    	var _token = $("input[name='_token']").val();

    	TotalFiles = $('#rimg'+sid)[0].files.length;
    	let rimg = $('#rimg'+sid)[0];
    	for (let i = 0; i < TotalFiles; i++) {
    		formData.append('rimg' + i, rimg.files[i]);
    	}

    	formData.append('TotalFiles', TotalFiles);
        formData.append('rtitle', rtitle);
    	formData.append('review', review);
    	formData.append('rating', rating);
    	formData.append('sid', sid);
    	formData.append('_token', _token);

    	if(rating!='' && review!='')
    	{ 
    		$.ajax({
    			url: "{{route('save_business_service_reviews')}}",
    			type: 'POST',
                contentType: 'multipart/form-data',
                xhrFields: {
                    withCredentials: true
                },
                cache: false,
                contentType: false,
                processData: false,
                data: formData,
    			success: function (response) {
    				if(response=='submitted')
    				{	$('#reviewerro'+sid).show(); $('#reviewerro'+sid).html('Review submitted'); 
    					//$("#user_ratings_div"+sid).load(location.href + " #user_ratings_div"+sid);
    					$("#user_ratings_div"+sid).load(location.href+" #user_ratings_div"+sid+">*","");
    					$('#rating'+sid).val(' ');
    					$('#review'+sid).val(' '); $('#rtitle'+sid).val(' ');
                        $(".service-review"+sid).load(" .service-review"+sid+" > *");
    				}

    				else if(response=='already')
    				{ 
                        $('#reviewerro'+sid).show(); 
    					$('#reviewerro'+sid).html('You have already submitted your review for this activity.'); 
                    }else if(response=='addreview'){ 
                        $('#reviewerro'+sid).show(); $('#reviewerro'+sid).html('Add your review and select rating for activity');  
                    }
                }
    		});
    	}
    	else{

    		$('#reviewerro'+sid).show(); 
    		$('#reviewerro'+sid).html('Please add your reivew and select rating'); 
    		$('#rating'+sid).val(' ');
    		$('#review'+sid).val(' ');
    		return false;
    	}
	@else
		$('#reviewerro'+sid).show(); 
		$('#reviewerro'+sid).html('Please login in your account to review this activity');
		$('#rating'+sid).val(' ');
		$('#review'+sid).val(' ');
		return false;
	@endif
}

function changeactpr(aid,val,part,div,maid)

{

	var n = val.split('~~');

	var pr; var qty;

	var actfilparticipant=$('#actfilparticipant'+maid).val();

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

		if( n[1]!='' ){ pr=qty*n[1]; } else { pr='100'; }

	}

	var data = '<p>Price Option: '+n[0]+' Session</p><p>Participants: '+qty+'</p><p>Total: $'+pr+'/person</p>';

    var bookdata= '<p>Category: '+ category_title +'</p><p> '+ time +' </p><p>Spots Left: '+sportsleft +'</p><br><p>Price Title: '+ price_title+'</p><p>Price Option: '+n[0]+' Session</p><p>Participants: '+qty+'</p><p>Total: $'+pr+'/person</p>';

	if(div=='book'){

		$('#book'+maid+aid).html(bookdata);

		$('#pricequantity'+maid+aid).val(qty);

		$('#price'+maid+aid).val(pr);

		$('#priceid'+maid+aid).val(n[2]);

	}

	else if (div=='bookmore'){

		console.log(aid);

		$('#bookmore'+maid+aid).html(bookdata);

		$('#pricebookmore'+maid+aid).val(pr);

		$('#priceid'+maid+aid).val(n[2]);

	}

	else if (div=='bookajax'){

		$('#bookajax'+maid+aid).html(bookdata);

		$('#pricebookajax'+maid+aid).val(pr);

		$('#pricequantity'+maid+aid).val(qty);

		$('#priceid'+maid+aid).val(n[2]);

	}

}



function changeactsession(main,aid,val,div)

{   

   /* alert('hii');*/



    var price_title = $('#price_title_hidden'+main+aid).val();

    var time = $('#time_hidden'+main+aid).val();

    var sportsleft = $('#sportsleft_hidden'+main+aid).val();

    var pricequantity = $('#pricequantity'+main+aid).val();



    if(div =='book'){

        var price = $('#price'+main+aid).val();

    }else if (div =='bookmore'){

        var price = $('#pricebookmore'+main+aid).val();

    }else{

        var price = $('#pricebookajax'+main+aid).val();   

    }

    var session = $('#session'+main+aid).val();



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

				$("#pricechng"+main+aid).html(data[0]);

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
                     $('#time_hidden'+main+aid).val(spotle[0]);
                    var bookdata= '<p>Category: '+ timetitle[0] +'</p><p> '+ spotle[0] +' </p><p>Spots Left: '+spotle[1] +'</p><br><p>Price Title: '+ price_title+'</p><p>Price Option: '+session+' Session</p><p>Participants: '+pricequantity+'</p><p>Total: $'+price+'/person</p>';

                    if(spotle[1] == 0){

                        $('#addtocart'+main+aid).css('display','none');

                    }else{

                       

                        $('#addtocart'+main+aid).css('display','block');

                    }

                }else{

                    var bookdata= '<p>Category: '+ timetitle[0] +'</p><p></p><p>Spots Left: 0 </p><br><p>Price Title: '+ price_title+'</p><p>Price Option: '+session+' Session</p><p>Participants: '+pricequantity+'</p><p>Total: $'+price+'/person</p>';

                    $('#addtocart'+main+aid).css('display','none');

                }

                

                if(div =='book'){

                    $('#book'+main+aid).html(bookdata);

                }else if (div =='bookmore'){

                    $('#bookmore'+main+aid).html(bookdata);

                }else{

                    $('#bookajax'+main+aid).html(bookdata);

                }

               

                if(timetitle[0] != ''){

                    $('#cate_title'+main+aid).val(timetitle[0]);

                }

			}

		});

	}

}

/*function submit_rating(sid)

{

	@if(Auth::check())

	//var formData = $("#sreview"+sid).serialize();

	var rating=$('#rating'+sid).val();

	var review=$('#review'+sid).val();

	var rtitle=$('#rtitle'+sid).val();

	

	if(rating!='' && review!='')

	{ 

		var _token = $("input[name='_token']").val();

		$.ajax({

			url: "{{route('save_business_service_reviews')}}",

			type: 'POST',

			data:{

				_token: _token,

				type: 'POST',

				sid:sid,

				rating:rating,

				review:review,

				rtitle:rtitle

			},

			success: function (response) { //alert(response)

				$("#user_ratings_div"+sid).load(location.href + " #user_ratings_div"+sid);

				$('#rating'+sid).val(' ');

				$('#review'+sid).val(' '); $('#rtitle'+sid).val(' ');

			}

		});

	}

	else

	{

		alert("Please add your reivew and select rating");

		$('#rating'+sid).val(' ');

				$('#review'+sid).val(' ');

		return false;

	}

	@else

		alert("Please login in your account to review this activity");

		$('#rating'+sid).val(' ');

				$('#review'+sid).val(' ');

		return false;

	@endif

	

}*/

</script>

@endsection

<style>

    .mysrchmap{ position: sticky !important; top: 0; }

    div#map_canvas{ width: 109% !important; }

    .direc-right ul li{ padding: 2px !important;

        /*padding: 0 !important; margin: 30% 5px !important;*/

    }

    .card-claimed-business .content-left-claimed { width: 100% !important; }

    .card-claimed-business .content-left-claimed ul{ display: inline-flex !important; }

	a.page-link:focus { background-color: #f53b49 !important; color: #fff !important; }

	li.page-item { width: auto !important; margin: 0px !important; padding: 0px !important; }

	.modal-body { overflow: hidden; }

</style>

