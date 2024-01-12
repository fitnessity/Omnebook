<div class="row">
	<div class="col-lg-12">
		<div class="review-header mb-20 mt-10">
			<h4 class="modal-title text-center" >Confirm Your Booking Selection For {{$company->company_name}}</h4>
		</div>
	</div>
</div>
<div class="time-slots-saprator mb-20">
	<label><span>{{count($finalSessionAry)}} </span>- Time Slots Selected</label>
</div>
<div class="mb-20 font-green" id="successMsg"></div>
<div class="row">
	<div class="col-md-12">
		<div class="table-responsive confirm-booking review-data">
			<table style="width:100%" class="table mb-0">
				<tr>
					<th>No</th>
					<th>Activity Name</th>
					<th>Date</th>
					<th>Time</th>
					<th>Duration</th>
					<th>Spots</th>
					<th>Choose Membership</th>
					<th>Action</th>
				</tr>

				@foreach($finalSessionAry as $i=>$sesAry)
				<tr id="blankTr">
					<td>{{$i+1}}.</td>
					<td>{{$sesAry['pname']}} @if(@$sesAry['catname']) -  {{@$sesAry['catname']}} @endif</td>
					<td>{{(new DateTime($sesAry['date']))->format("l, F j,Y")}}</td>
					<td>{{$sesAry['time']}} </td>
					<td>{{$sesAry['duration']}} </td>
					<td> 1 Slot </td>
					<td>  
						<?php 
							$html = $data = '';$remaining = 0;$firstDataProcessed = false; 
				            $customer = Auth::user()->customers()->find(request()->cid);

				            $active_memberships = $customer->active_memberships()->where('user_booking_details.user_id',request()->cid)->get();

				            foreach($active_memberships as $active_membership){
				                $remainingSession = $active_membership->getremainingsession();
				                if($remainingSession > 0 && $active_membership->business_price_detail){
				                    $priceDetail = $active_membership->business_price_detail;
				                    $html .= '<option value="'.$priceDetail->id.'" data-did ="'.$active_membership->id.'">'.$priceDetail->price_title.'</option>';
				                }
				            }

				            if($html != ''){
					            $data .='<select class="mb-10 form-control required" id="priceId'.$i.'" onchange="getRemainingSession('.$i.',\''.$sesAry["date"].'\','.$sesAry['timeId'].')"  ><option value="" data-did ="0">Choose Membership</option>'.$html.'</select>  <div class="font-red text-center" id="remainingSession'.$i.'"></div>';

					            //'<div class="font-red text-center" id="remainingSession'.$i.'">'.$remaining.' Session Remaining.</div>';
					        }
				        ?>
				        <div class="text-center">
				        	{!! $data != '' ? $data : '<p> No MemberShip Available</p>' !!}

				        	<div class="time-slots-saprator mb-20"></div><a href="/activity-details/{{$sesAry['serviceID']}}" class="btn btn-red" target="_blank">Purchase A Membership</a>
				        </div>
				    </td>
					<td><button class="btn-delete font-red" onclick="confirmdelete({{$sesAry['serviceID']}},'{{$sesAry["date"]}}' ,{{$sesAry['timeId']}} , 0);"> Delete </button></td>
				  </tr>
				@endforeach
			</table>
		</div>
	</div>
</div>
<div class="modal-footer mt-20">
	<button type="button" @if(count($finalSessionAry) > 0 ) onclick="confirmSchedule('{{count($finalSessionAry)}}');" @endif class="btn btn-red">Confirm Booking</button>
</div>

<script type="text/javascript">
	function confirmSchedule(cnt){
		if(confirm('Are you want to confirm this booking schedule ?')){
			if(cnt == 0){
				alert('Please select time first..');
			}else{
				var isValid = 1;
				$('.required').each(function() {
					if ($(this).val() === '') {
				        alert('Please select membership from each activity.');
				        isValid = 0;
			      	}
				});

				if (isValid == 1) {
					$.ajax({
			   			url: "{{route('multibooking.save')}}",
						type: 'POST',
						xhrFields: {
							withCredentials: true
				    	},
				    	data:{
							_token: '{{csrf_token()}}',
							cid: '{{$cid}}',
						},
						success: function (response) { 
							//window.location.reload();
							$('#blankTr').html('');
							$('#successMsg').html(response);
							setTimeout(function() {
							    window.location.href = "/business_activity_schedulers/" + "{{$company->id}}" + "?customer_id=" + "{{$cid}}";
							}, 2000);
							
						}
					});
				}
			}			
		}
	}
</script>