<div class="calendar-body">
    <div class="text-center">
        <h3>{{$booking_detail->business_price_detail_with_trashed->business_price_details_ages_with_trashed->category_title}}</h3>
        <div class="calendar-time">
             <label>Activity : </label> <span>{{$ser_data->program_name}}</span>
        </div>
        <div class="calendar-time">
             <label>Company : </label> <span>{{$ser_data->company_information->dba_business_name}}</span>
        </div>
       <div class="calendar-time">
            <label>Time: </label> <span>{{$time}}</span>
        </div>
        <div class="calendar-time">
            <label>Who\'s Participating: </label> <span>{{$participate}} </span>
        </div>
    </div>
    <div class="row mt-25">
        <div class="col-md-6 col-6">
            <div class="calendar-btns">
               <a class="btn btn-black" href="{{route('business_activity_schedulers',['business_id' => $ser_data->cid, 'business_service_id' => $ser_data->id, 'stype' =>  $ser_data->service_type])}}" target="_blank">Reschedule</a> 
            </div>
        </div>
        <div class="col-md-6 col-6">
            <div class="calendar-btns">
                <a class="btn btn-red float-end" href="{{route('personal.orders.index', ['business_id' => $ser_data->cid])}}" target="_blank">View Booking</a> 
            </div>
        </div>
    </div>
</div>