<div class="modal-header">
    <h5 class="modal-title" id="myModalLabel">View Your bookings for {{$programName}}</h5>
    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
</div>
<div class="modal-body">
    <div class="mt-3 mt-lg-0">
        <div class="row g-3 mb-10 align-items-center">
            <div class="col-sm-auto">
                <div class="input-group">
                    <input type="text" class="form-control border-0 dash-filter-picker shadow flatpickr" name="actfildate" id="managecalendarservice" class="form-control" onchange="getbookingmodel({{$sid}},'ajax' ,'date');" autocomplete="off" value="{{$date}}">
                    <div class="input-group-text bg-primary border-primary text-white">
                        <i class="ri-calendar-2-line"></i>
                    </div>
                </div>
            </div>
            <div class="col-sm-auto">
                <div class="date-info">
                    <label>Today Date:</label><span> {{$date}}</span>
                </div>
            </div>
            <div class="col-sm-auto">
                <div class="date-info">
                    <label>Total Bookings:</label> <span>{{count($data)}}</span>
                </div>
            </div>

            <div class="col-md-3">
                <label>Category</label>
                <div class="form-group mmt-10">
                    <select class="form-select" name="category" id="category" onchange="getbookingmodel({{$sid}},'ajax' ,'category','')">
                        <option value="all">All</option>
                        @foreach($categoryList as $c)
                        <option value="{{$c->id}}">{{$c->category_title}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>

        <div class="row g-3 mb-10 align-items-center tablist">
            <ul class="nav nav-tabs" id="myTab" role="tablist">
              <li class="nav-item" role="presentation">
                <button class="nav-link @if($type == 'date') active @endif fonts-red" id="today" data-bs-toggle="tab" type="button" role="tab" onclick="getbookingmodel({{$sid}},'simple' ,'date' ,'');">Today</button>
              </li>

              <li class="nav-item" role="presentation">
                <button class="nav-link fonts-red @if($type == 'week') active @endif " id="week" data-bs-toggle="tab" type="button" role="tab" onclick="getbookingmodel({{$sid}},'ajax' ,'week','');">Week</button>
              </li>

              <li class="nav-item" role="presentation">
                <button class="nav-link fonts-red @if($type == 'month') active @endif " id="month" data-bs-toggle="tab" type="button" role="tab" onclick="getbookingmodel({{$sid}},'ajax' ,'month','');">Month</button>
              </li>

              <li class="nav-item" role="presentation">
                <button class="nav-link fonts-red @if($type == '') active @endif " id="all" data-bs-toggle="tab" type="button" role="tab" onclick="getbookingmodel({{$sid}},'ajax' ,'','');">All</button>
              </li>
                
            </ul>
        </div>

        <div class="view-booking-table">
            <div class="table-responsive">
                <table class="table mb-0">
                    <thead>
                        <tr>
                            <th class="w-px-100">Name</th>
                            <th class="w-px-100">Date Booked</th>
                            <th class="w-px-100">Who's Participating</th>
                            <th class="w-px-100">Category Name</th>
                            <th class="w-px-100">Price Option</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($data as $i=>$dt)
                            @if($dt->UserBookingDetail != '' && $dt->UserBookingDetail->customer != '')
                                @php 
                                    $detail = $dt->UserBookingDetail;
                                    $link = $detail->customer != '' ? Config::get('constants.SITE_URL').'/business/'.$detail->customer->business_id.'/customers/'.$detail->customer->id : '';
                                @endphp
                                <tr>
                                    <td>{{($i+1)}}. <a target="_blank" href="{{$link}}" >{{@$detail->customer->full_name}}</a></td>
                                    <td>{{$dt->checkin_date != '' ? date('m-d-Y', strtotime($dt->checkin_date)) : "N/A"}}</td>
                                    <td>{!! $detail->decodeparticipate() !!}</td>
                                    <td> {{$detail->business_price_detail_with_trashed->business_price_details_ages_with_trashed->category_title}}</td>
                                    <td>{{$detail->business_price_detail_with_trashed->price_title }}</td>
                                </tr>
                            @endif
                        @empty
                            <tr><td colspan = 5><p class="fonts-red text-center">There Are No Bookings For This Activity Today</p></td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<script>
    flatpickr(".flatpickr", {
        dateFormat: "m/d/Y",
        maxDate: "01/01/2050",
        enable: [
            { 
                from: "01/01/2000", 
                to: "01/01/2050" 
            },
        ]
     });
</script>