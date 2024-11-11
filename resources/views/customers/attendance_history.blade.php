<div class="row">
    <div class="col-md-12 col-xs-12">
        <div class="visit-table-data">
            <label>Total Number of Visits:</label>
            <span>{{$customerdata->visits_count()}}</span>
        </div>
    </div>
</div>
<div class="purchase-history">
    <div class="table-responsive">
        <table class="table mb-0">
            <thead>
                <tr>
                    <th>Date</th>
                    <th>Time</th>
                    <th>Program Name </th>
                    <th>Program Title </th>
                    <th>Status</th>
                    <th>Instructor</th>
                </tr>
            </thead>
            <tbody>
                @foreach($visits as $visit)
                     @if($visit->order_detail)
                        <tr>
                            <td>@if($visit->checkin_date) {{date('m/d/Y',strtotime($visit->checkin_date))}} @else N/A @endif</td>
                            <td>
                                {{date('h:i A', strtotime($visit->checked_at))}}
                            </td>
                            <td>{{$visit->order_detail->business_services_with_trashed->program_name}}</td>
                            <td>{{$visit->order_detail->business_price_detail_with_trashed->price_title}}</td>
                            
                            <td>
                                @if($visit->status_term())
                                    {{$visit->status_term()}}
                                @else
                                    <a class="font-red" onclick="getCheckInDetailsModel({{$visit->order_detail->business_id}}, {{$visit->business_activity_scheduler_id}} ,'{{$visit->checkin_date}}','{{$customerdata->id}}');">Unprocess</a>
                                @endif
                                
                            </td>
                            <td>{{ App\BusinessStaff::getinstructorname($visit->order_detail->business_services_with_trashed->instructor_id)}}</td>
                        </tr>
                    @endif
                @endforeach
            </tbody>
        </table>
    </div>
</div>
<script>
    	function getCheckInDetailsModel(business_id,scheduleId,date,cid){
			if(scheduleId != 0){
				$.ajax({	
					url:"/business/"+business_id+"/schedulers/"+scheduleId+"/checkin_details?date="+date+"&customerId="+cid,
					type:'GET',
					success:function(data){
						$('#checkInHtml').html(data);
						$('.checkinDetails').modal('show');
					}
				});
			}	
		}
</script>