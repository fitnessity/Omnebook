<div class="calendar-body">
    <h3>{{$ser_data->program_name}}</h3>
    <p>{{$ser_data->company_information->dba_business_name}}</p>
    <p class="calendar-address">{{$ser_data->company_information->company_address()}}</p>
   <div class="calendar-time">
        <label>Time: </label> <span>{{$time}}</span>
    </div>
    <div class="calendar-time">
        <label>Who\'s Participating: </label> <span>{{$participate}} </span>
    </div>
    <div class="row">
        <div class="col-md-6 col-6">
            <div class="calendar-btns">
               <a class="btn btn-black" href="{{route('business_activity_schedulers',['business_id' => $ser_data->cid, 'business_service_id' => $ser_data->id, 'stype' =>  $ser_data->service_type])}}" target="_blank">Reschedule</a> 
            </div>
        </div>
        <div class="col-md-6 col-6">
            <div class="calendar-btns">
                <a class="btn btn-red float-end" href="{{route('business_customer_show', ['business_id' => $ser_data->cid,'id'=>$booking_detail->user_id])}}" target="_blank">View Booking</a> 
            </div>
        </div>
    </div>
</div>