<?php 
use App\Getstarted;
use App\Bookactivity;
use App\BusinessService;
$special_days_off = [];
$bustime = BusinessService::where('cid', request()->page_id)->first();
/*if($bustime != ''){
    if($bustime->special_days_off != '' || $bustime->special_days_off != NULL ){
        $special_days_off = explode(",",$bustime->special_days_off);
    }
}*/

?>
<div class="right-box">
                        <!--<div class="pr-verification" style="background-color:transparent;background-image:url('/public/images/get-verified.jpg');background-repeat: no-repeat;background-position: center;background-size: 360px 240px">
                            <div class="veri-icon-new" style="margin-top:112px">
                                <span >
                                    <a href="{{'tel:'.$UserProfileDetail['phone_number']}}" style="background-color:green;" title="phone" class="cophone"><i class="fa fa-phone" aria-hidden="true"></i></a>
                                </span>
                                <span >
                                    <a href="{{'mailto:'.$UserProfileDetail['email']}}" style="background-color:green;" title="email"  class="coemail"><i class="fa fa-envelope" aria-hidden="true"></i></a>
                                </span>
                                <span >
                                    <a href="{{'http://maps.google.com/?q='.$UserProfileDetail['address']}}" style="background-color:green;" title="address" class="coaddress" target="_blank"><i class="fa fa-map-marker" aria-hidden="true"></i></a>
                                </span>
                            </div>
                        </div>-->
                        
	<div class="static hide">
    	<h5><i class="far fa-bookmark mr-2"></i> Statistic </h5>
		<div class="static-soc">
        	<ul>
            	<li><a href="#"><i class="far fa-eye mr-2"></i> 0 Views </a></li>
				<li><a href="#"><i class="far fa-star mr-2"></i> 0 Ratings </a></li>
				<li><a href="#"><i class="far fa-heart mr-2"></i> 0 Favorites</a></li>
				<li><a href="#"><i class="fas fa-share mr-2"></i> 0 Shares </a></li>
			</ul>
		</div>
	</div>
    <div id="profile-description">
    	@include('profiles.viewBprofileActivityFilter')
        	<?php if( !empty ( $bustime ) ) { ?>
            <div class="widget">
            	<div class="cal-time">
                	<?php
						$day = date('N'); $today=''; $all=''; $mons=''; $mone=''; $tues=''; $tuee=''; $weds=''; $wede='';
							$thus=''; $thue=''; $fris=''; $frie=''; $sats=''; $sate=''; $suns=''; $sune='';
						if($bustime['mon_shift_start']!=''){ $mons= $bustime['mon_shift_start']; }
						if($bustime['mon_shift_end']!=''){ $mone= $bustime['mon_shift_end']; }
						if($bustime['tue_shift_start']!=''){ $tues= $bustime['tue_shift_start']; }
						if($bustime['tue_shift_end']!=''){ $tuee= $bustime['tue_shift_end']; }
						if($bustime['wed_shift_start']!=''){ $weds= $bustime['wed_shift_start']; }
						if($bustime['wed_shift_end']!=''){ $wede= $bustime['wed_shift_end']; }
						if($bustime['thu_shift_start']!=''){ $thus= $bustime['thu_shift_start']; }
						if($bustime['thu_shift_end']!=''){ $thue= $bustime['thu_shift_end']; }
						if($bustime['fri_shift_start']!=''){ $fris= $bustime['fri_shift_start']; }
						if($bustime['fri_shift_end']!=''){ $frie= $bustime['fri_shift_end']; }
						if($bustime['sat_shift_start']!=''){ $sats= $bustime['sat_shift_start']; }
						if($bustime['sat_shift_end']!=''){ $sate= $bustime['sat_shift_end']; }
						if($bustime['sun_shift_start']!=''){ $suns= $bustime['sun_shift_start']; }
						if($bustime['sun_shift_end']!=''){ $sune= $bustime['sun_shift_end']; }
					
						if($day=='1'){ $today=$mons.' - '.$mone; }
						else if($day=='2'){ $today=date('h:i a', strtotime($tues)).' - '.date('h:i a', strtotime($tuee)); }
						else if($day=='3'){ $today=date('h:i a', strtotime($weds)).' - '.date('h:i a', strtotime($wede)); }
						else if($day=='4'){ $today=date('h:i a', strtotime($thus)).' - '.date('h:i a', strtotime($thue)); }
						else if($day=='5'){ $today=date('h:i a', strtotime($fris)).' - '.date('h:i a', strtotime($frie)); }
						else if($day=='6'){ $today=date('h:i a', strtotime($sats)).' - '.date('h:i a', strtotime($sate)); }
						else if($day=='7'){ $today=date('h:i a', strtotime($suns)).' - '.date('h:i a', strtotime($sune)); }
					?>
					<h4>Today</h4><span><?php if($today!=''){ echo 'Open'; }else{ echo 'Closed'; } ?></span> <h5>{{$today}}</h5>
				</div>
                <div class="your-page">
					<dl>
                    	<dt>Monday</dt><dd><?php if($mons != ''){ echo date('h:i a', strtotime($mons)).' - '.date('h:i a', strtotime($mone)); }else{ echo "Closed" ;} ?></dd>
                        <dt>Tuesday</dt><dd><?php if($tues != ''){  echo date('h:i a', strtotime($tues)).' - '.date('h:i a', strtotime($tuee));  }else{ echo "Closed" ;}  ?></dd>
                        <dt>Wednesday</dt><dd><?php if($weds != ''){  echo date('h:i a', strtotime($weds)).' - '.date('h:i a', strtotime($wede));  }else{ echo "Closed" ;}  ?></dd>
                        <dt>Thursday</dt><dd><?php if($thus != ''){ echo date('h:i a', strtotime($thus)).' - '.date('h:i a', strtotime($thue)); }else{ echo "Closed" ;}  ?></dd>
                        <dt>Friday</dt><dd><?php if($fris != ''){ echo date('h:i a', strtotime($fris)).' - '.date('h:i a', strtotime($frie)); }else{ echo "Closed" ;}  ?></dd>
                        <dt>Saturday</dt><dd><?php if($sats != ''){ echo date('h:i a', strtotime($sats)).' - '.date('h:i a', strtotime($sate)); }else{ echo "Closed" ;}  ?></dd>
                        <dt>Sunday</dt><dd><?php if($suns != ''){ echo date('h:i a', strtotime($suns)).' - '.date('h:i a', strtotime($sune));  }else{ echo "Closed" ;}  ?></dd>
                        <?php if($mons!='' && $tues!='' && $weds!='' && $thus!='' && $fris!='' && $sats!='' && $suns) { $all='Open All Day'; } ?>
                        <dt></dt><dd> <?php echo $all; ?> </dd>
					</dl>	
				</div>
               @if(count($special_days_off) > 0)
               <!--  <h4 class="h4color">Special Days Off</h4>
                <div class="your-page-sec">
                    <dl>
                        @foreach($special_days_off as $day)
                        @php $date = date('F d, Y',strtotime($day)); 
                         $daytext = date("l",strtotime($day)); @endphp
                        <dt> {{$date}}</dt><dd>{{$daytext}}</dd>
                        @endforeach
                        <dt></dt><dd></dd>
                    </dl>   
                </div> -->
                @endif

			</div><!-- page like widget -->
            <?php } ?>
            <div class="widget" style="height:300px" id="mapdetails">
            	<div class="google-map">
					<div class="get-img"><!--<img src="/images/newimage/map.jpg" alt="images" class="img-fluid">-->
                    	<div id="map_canvas" style="position: absolute; top: 0; right: 0; bottom: 0; left: 0;height:300px"></div>
                    </div>
				</div>
            </div>
            <div class="widget">
				<h4 class="widget-title">Business Info
					<?php /*?><a href="#" class="direction"><i class="fas fa-hand-point-right fa-direction"></i>Get Directions</a><?php */?>
				</h4>	
				<?php /*?><div class="google-map">
					<div class="get-img"><img src="/images/newimage/map.jpg" alt="images" class="img-fluid"></div>
				</div><?php */?>
				<div class="map-info">
                	<?php $locations = []; ?>
                	@if ($company->address !='')
					<span>
						<i class="fas fa-map-marker-alt map-fa"></i><p>{{ $company->address }}
                        	@if ($company->city !='') <?php echo ', '.$company->city; ?> @endif
                            @if ($company->state !='') <?php echo ', '.$company->state; ?> @endif
                            @if ($company->country !='') <?php echo ', '.$company->country; ?> @endif
                            
                            <?php
                            if($company->latitude != '' || $company->longitude  != ''){
                                $lat = $company->latitude + ((floatVal('0.' . rand(1, 9)) * 1) / 10000);
                        		$long = $company->longitude + ((floatVal('0.' . rand(1, 9)) * 1) / 10000);
                        		$a = [$company->company_name, $lat, $long, $company->id, $company->logo];
                                array_push($locations, $a);
							}
                            ?>
                        </p>
					</span>
                    @endif
                    @if ($company->contact_number !='')
                    @php
                        $phone_num = $company->contact_number;
                        if (preg_match('/()-/', $phone_num)){
                           
                            $phone_number = $phone_num;
                        }else{
                            
                            $phone_number = preg_replace('~.*(\d{3})[^\d]{0,7}(\d{3})[^\d]{0,7}(\d{4}).*~', '($1) $2-$3', $phone_num);
                        }
                    @endphp
					<span>
						<i class="fas fa-phone-alt map-fa"></i><p>{{ $phone_number }}</p>
					</span>
                    @endif
                    @if ($company->email !='')
					<span>
						<i class="fa fa-envelope map-fa"></i><p>{{ $company->email }}</p>
					</span>
                    @endif
                    @if ($company->website !='')
					<span>
						<i class="fas fa-globe map-fa"></i><p>{{ $company->website }}</p>
					</span>
                    @endif
				</div>
				<?php /*?><div class="map-report">
					<p>Own this business? <a title="" href="#">Claim Now</a></p>
					<p>Want to report this business? <a title="" href="#">Report Now</a></p>
				</div><?php */?>
			</div><!-- Map-->
            <?php
            	$getstarted = Getstarted::inRandomOrder()->limit(1)->get();
				foreach($getstarted as $start){
			?>
            @if(File::exists(public_path("/uploads/getstarted/thumb/".$start->image)))
            <div class="get-started">
            	<div class="get-img"><img src="{{ url('/public/uploads/getstarted/thumb/'.$start->image) }}" alt="{{$start->title}}" class="img-fluid"></div>
                @if ($start->title !='')
                	<div class="get-text">{{$start->title}}</div>
                @endif
                <div class="get-btn-box">
                	<a href="{{ Config::get('constants.SITE_URL') }}/activities" class="get-btn"> Get Started </a>
                </div>
			</div>
            @endif
            <?php } ?>
            <?php
            	$bookact = Bookactivity::inRandomOrder()->limit(1)->get();
				foreach($bookact as $bc){
			?>
            @if(File::exists(public_path("/uploads/book/thumb/".$bc->image)))
                <div class="ad-img">
                    <img src="{{ url('/public/uploads/book/thumb/'.$bc->image) }}" alt="images" class="img-fluid">
                </div>
            @endif
            <?php } ?>
            
	</div><!-- profile-description -->
</div><!-- right-box -->
<script src="/public/js/compare/jquery-1.9.1.min.js"></script>
<script src="https://maps.googleapis.com/maps/api/js?libraries=places&key={{ env('GOOGLE_MAP_KEY') }}&sensor=false"></script>
<script>
$(document).ready(function () {
	
	var locations = @json($locations);
    console.log('hiiii'+locations)
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
            url: "{{url('/public/images/hoverout2.png')}}",
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