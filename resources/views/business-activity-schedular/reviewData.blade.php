<div class="row">
	<div class="col-lg-12">
		<div class="review-header mb-20 mt-10">
			<h4 class="modal-title" style="">Confirm Your Booking Selection For</h4>
			<h4 class="modal-title" style="">{{$company->company_name}}</h4>
		</div>
	</div>
</div>
<div class="time-slots-saprator mb-20">
	<label><span>{{count($finalSessionAry)}} </span>- Time Slots Selected</label>
</div>
<div class="row">
	<div class="col-md-12">
		<div class="table-responsive confirm-booking purchase-history review-data">
			<table style="width:100%" class="table mb-0">
				<tr>
					<th>No</th>
					<th>Program</th>
					<th>Date</th>
					<th>Time</th>
					<th>Duration</th>
					<th>Spots</th>
					<th>Choose Membership</th>
					<th>Action</th>
				</tr>

				@foreach($finalSessionAry as $i=>$sesAry)
				  <tr>
					<td>{{$i+1}}.</td>
					<td>{{$sesAry['pname']}}</td>
					<td>{{(new DateTime($sesAry['date']))->format("l, F j,Y")}}</td>
					<td>{{$sesAry['time']}} </td>
					<td> {{$sesAry['duration']}} </td>
					<td> 1 Slot </td>
					<td>  
						<?php 
							$html = $data = '';$remaining = 0;$firstDataProcessed = false; 
							$bookingDetail = App\UserBookingDetail::where(['sport'=> $sesAry['serviceID'] ,'user_id'=>$sesAry['cid']])->whereDate('expired_at' ,'>' ,date('Y-m-d'))->orderby('created_at','desc')->get();
				            if(!empty($bookingDetail)){
				                foreach($bookingDetail as $detail){
				                    $remainingSession = $detail->getremainingsession();
				                    $priceDetail = $detail->business_price_detail;
				                    if($remainingSession != 0 &&  $priceDetail->category_id == @$sesAry['category_id']){
				                        if (!$firstDataProcessed) {
				                            $remaining = $remainingSession; 
				                            $firstDataProcessed = true; 
				                        }
				                        $html .= '<option value="'.$priceDetail->id.'" data-did ="'.$detail->id.'"';

				                        $html .= array_key_exists('priceId', $sesAry) && $sesAry['priceId'] == $priceDetail->id ? 'selected' : '';

				                        $html .= '>'.$priceDetail->price_title.'</option>';
				                    }
				                }
				            }
				            if($html != ''){
					            $data .='<select class="mb-10 form-control" id="priceId'.$i.'" onchange="getRemainingSession('.$i.',\''.$sesAry["date"].'\','.$sesAry['timeId'].')">'.$html.'</select><div class="font-red text-center" id="remainingSession'.$i.'">'.$remaining.' Session Remaining.</div>';
					        }
				        ?>
				        {!! $data != '' ? $data : "No MemberShip Available" !!}
				    </td>
					<td><button class="btn-delete font-red" onclick="confirmdelete({{$sesAry['serviceID']}},'{{$sesAry["date"]}}' ,{{$sesAry['timeId']}} , 0);"> Delete </button></td>
				  </tr>
				@endforeach
			</table>
		</div>
	</div>
</div>
<div class="modal-footer mt-20">
	<button type="button" @if(count($finalSessionAry) > 0 ) onclick="confirmSchedule('{{count($finalSessionAry)}}');" @endif class="btn btn-lp">Confirm Booking</button>
</div>

<script type="text/javascript">
	function confirmSchedule(cnt){
		if(confirm('Are you want to confirm this booking schedule ?')){
			if(cnt == 0){
				alert('Please select time first..');
			}else{
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
						window.location.reload();
					}
				});
			}			
		}
	}
</script>