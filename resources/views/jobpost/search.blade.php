<?php
use App\CompanyInformation;
use App\BusinessPriceDetails;
use App\BusinessService;
use App\BusinessServiceReview;

	$companyid = $companylogo = $companyname = $companyaddress = $latitude = $longitude = "";
	$pay_session = $pay_price = $pay_setduration = $pay_discount = $languages = $companyabout = "";
	$companycity = $companycountry = $companyzip = $servicetype= "";
	$serviceid ="";
	//$serviceData = json_decode(json_encode($serviceData), true);
	//print_r($filmember);
	//print_r($serviceData); exit;
	if (count($serviceData) > 0) {
		$servicetype = [];
		foreach ($serviceData as $loop => $service) { 
		//foreach ($serviceData as  $service) {
			 $company = $price = $businessSp = [];
			if( !empty($service['sport_activity']) ){
            	$sport_activity = $service['sport_activity'];
			}
			
           // $servicetype[$service['service_type']] = $service['service_type'];
			$serviceid = $service['id'];
            $area = !empty($service['area']) ? $service['area'] : 'Location';
			$company = CompanyInformation::where('id',$service['cid'])->get()->toArray();
			$servicePrice = BusinessPriceDetails::where('cid', $service['cid'])->get()->toArray();
			$business_spec = BusinessService::where('cid',$service['cid'])->get()->toArray();
			if( !empty($filmember) ){
				$filmember1 = BusinessPriceDetails::where('serviceid',$serviceid)->whereIn('membership_type',$filmember)->count();
				if($filmember1 <= 0)
					continue;
				
			}
            if (isset($company)) {
					if(!empty($company)) {
						$companyid = $service['cid'];
						$companylogo = $company[0]['logo'];
						$companyname = $company[0]['company_name'];
						$companyaddress = $company[0]['address'];
						$latitude = $company[0]['latitude'];
						$longitude = $company[0]['longitude'];
						$companycity = $company[0]['city'];
						$companycountry = $company[0]['country'];
						$companyzip = $company[0]['zip_code'];
					}
					if(!empty($servicePrice)) {
						$pay_session = $servicePrice[0]['pay_session'];
						$pay_price = !empty($servicePrice[0]['pay_price']) ? $servicePrice[0]['pay_price'] : '100';
						$pay_setduration = $servicePrice[0]['pay_setduration'];
						$pay_discount = $servicePrice[0]['pay_discount'];
					}
					if(!empty($businessSp)) {
						$languages = $businessSp[0]['languages'];
					}				
			}
			
			if (@$service['profile_pic']!="" && File::exists(public_path("/uploads/profile_pic/thumb/".@$service['profile_pic']))){
				$profilePic = url('/public/uploads/profile_pic/thumb/' . @$service['profile_pic']);
			} else {
				$profilePic = '/public/images/service-nofound.jpg';
			}
			?>
			<div class="col-md-6 kickboxing-block1 selectProduct" data-id="{{ @$service['id'] }}" data-title="{{ @$service['program_name'] }}" data-name="{{ @$service['program_name'] }}" data-companyname="{{ $companyname }}" data-email="" data-address="{{ $companyaddress }}" data-img="{{ $profilePic }}" data-price="{{ $pay_price }}" data-token="{{ csrf_token() }}"> 
				<div class="topimg-content">
					<img src="{{ $profilePic }}" class="productImg">
					<a class="fav-fun-2"><i class="far fa-heart"></i> <p> Favorite </p> </a>
				</div>
                <?php
				if ($companylogo!="" && File::exists(public_path("/uploads/profile_pic/thumb/" . $companylogo))) {
					$companyLogo = url('/public/uploads/profile_pic/thumb/' . $companylogo);
				} else {
					$companyLogo = '/public/images/default-avatar.png';
				}
				$reviews_count = BusinessServiceReview::where('service_id', $serviceid)->count();
				$reviews_sum = BusinessServiceReview::where('service_id', $serviceid)->sum('rating');
				$reviews_avg=0;
				if($reviews_count>0)
				{ $reviews_avg= round($reviews_sum/$reviews_count,2); }
				?>
				<div class="bottom-content">
					<div class="ratset-img">
						<div class="rattxt"><i class="fa fa-star" aria-hidden="true"></i> {{$reviews_avg}} ({{$reviews_count}})</div>
						<div class="volarimg"><img src="{{ $companyLogo }}"></div>
						<div class="verifiedimg"><img src="/public/images/verified-logo.png"></div>
					</div>
					<h2 class="card-title card-claimed-businessnew" myposition="{{ $loop }}" company_id="{{$companyid}}" business_name="{{$companyname}}" logo="{{$companyLogo}}" latitude="{{$latitude}}"  longitude="{{$longitude}}">
                    <a href="#">{{ @$service['program_name'] }}</a></h2>
					
                    <p class="aboutcomp"> {{ Str::limit(@$service['program_desc'], 80, $end='') }} 
                    	<?php if( strlen(@$service['program_desc']) >80 ){
								echo '<a href=""> more... </a>';
							}
						?>
                    </p>
                    <?php $redlink = str_replace(" ","-",$companyname)."/".@$service['cid']; ?>
                    <p class="caddress"><a href="{{ Config::get('constants.SITE_URL') }}/businessprofile/{{$redlink}}">{{ $companyname }}</a></p>
					<?php if( !empty($companycity) || !empty($companycountry) || !empty($companyzip) ){
							echo '<p class="ccountry">';
								if(!empty($companyaddress)) { echo $companyaddress; }
                                if(!empty($companycity)) { echo ', '.$companycity; }
                               	if(!empty($companycountry)) { echo ', '.$companycountry; }
                                if(!empty($companyzip)) { echo ', '.$companyzip; }
							echo '</p>';
						} 
						$service_type='';
						if(@$service['service_type']!=''){
							if( @$service['service_type']=='individual' ){ $service_type = 'Personal Training'; }
							else if( @$service['service_type']=='classes' ){ $service_type = 'Group Classe'; }
							else if( @$service['service_type']=='experience' ){ $service_type = 'Experience'; }
						?> 
						<p class="sertype"> {{ $service_type }} </p>
					<?php } ?>
                     <h5>{{ @$service['sport_activity'] }}</h5>
					<hr>
					<a href="#" class="moredetails-btn" data-toggle="modal" data-target="#mykickboxing<?php echo $serviceid; ?>">More Details</a>
					<p class="addToCompare" title="Add to Compare">COMPARE SIMILAR OPTION +</p>
				</div>
			</div>
			@include('jobpost.instanthire_detail')
			<?php
		}
		
	}
	else{
		echo 'No Record Found.';
	}
	?>
    
    <br/>
   <?php /*?> <div class="pagination_div" style="position: relative;">
        {!! $serviceData->render() !!}
    </div> <?php */?>
       
<style>
    ul.pagination li {
        padding: 0;
    }
</style>
<script>
    $(document).ready(function(){
        $('.pagination li a').click(function(e) {
            e.preventDefault();
			var values = {};
		//$.each($("form#frmsearchCategory").serializeArray(), function (i, field) {
		//	values[field.name] = field.value;
		//});
		//console.log(values);
		//var selectedValues = $('#providerservices').val();
		//console.log(selectedValues);
		
		//text_array = selected_buttons.selected('text')
		//value_array = selected_buttons.selected()
		var GetData = {};
		var serviceType = new SlimSelect({
            select: '#providerservices'
        });
		GetData['service_type'] = serviceType.selected();
		var servicetypetwo = new SlimSelect({
            select: '#servicetypetwo'
        });
		GetData['service_typetwo'] = servicetypetwo.selected();
		
		var programType = new SlimSelect({
            select: '#programservices'
        });
		GetData['program_type'] = programType.selected();
		
		var professionalType = new SlimSelect({
            select: '#professional_type'
        });
		GetData['professional_type'] = professionalType.selected();
		
		var activityLocation = new SlimSelect({
			select: '#activity_location'
        });
		GetData['activity_location'] = activityLocation.selected();
		
		GetData['location'] = $('#pac-input').val();
		
		var activityType = new SlimSelect({
            select: '#activity_type'
        });
		GetData['activity_type'] = activityType.selected();
		
		var ageRange = new SlimSelect({
            select: '#age_range'
        });
		GetData['age_range'] = ageRange.selected();
		
		var frmCnumberofpeople = new SlimSelect({
            select: '#frm_cnumberofpeople'
        });
		GetData['cnumber_people'] = frmCnumberofpeople.selected();
		
		var getDuration = new SlimSelect({
            select: '#duration'
        });
		GetData['duration'] = getDuration.selected();
		
		var difficultylevel = new SlimSelect({
            select: '#difficultylevel'
        });
		GetData['difficulty_level'] = difficultylevel.selected();
		
		/*var genderpreference = new SlimSelect({
            select: '#genderpreference'
        });
		GetData['gender'] = genderpreference.selected();
		
		var getLanguage = new SlimSelect({
            select: '#categ'
        });
		GetData['language'] = getLanguage.selected();*/
		
		var activityExp = new SlimSelect({
            select: '#activity_exp'
        });
		GetData['activity_exp'] = activityExp.selected();
		
		var personalityHabit = new SlimSelect({
            select: '#personality_habit'
        });
		GetData['personality_habit'] = personalityHabit.selected();
		console.log(GetData);
		
            var url = $(this).attr('href');
            var form = $("form#frmsearchCategory").serialize();
            $.ajax({
                url:url,
                type:'POST',
                headers: {
                'X-CSRF-TOKEN': '{{csrf_token()}}',
                },
                data: {
                "_token": '{{csrf_token()}}',
                        data : form
                },
                success:function(response){
                alert('2');
                $('.direc-right div#buisnessuser').empty();
                $('.direc-right div#buisnessuser').html(response);
                }
            });
        });
    });
</script>