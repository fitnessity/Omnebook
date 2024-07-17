<div class="modal-header">
    <h5 class="modal-title" id="myModalLabel">View Your Client</h5>
    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
</div>
<div class="modal-body">
    <div class="mt-3 mt-lg-0">
        <div class="row g-3 mb-10 align-items-center">
            <div class="col-sm-auto">
                <div class="input-group">
                    <input type="text" class="form-control flatpickr-client-filter" id="clientdate" onchange="getNewClient('ajax' ,'date');"  value="{{$cDate}}">
                    <div class="input-group-text bg-primary border-primary text-white">
                        <i class="ri-calendar-2-line"></i>
                    </div>
                </div>
            </div>
            <div class="col-sm-auto">
                <div class="date-info">
                    <label>Today Date:</label><span> {{date('m/d/Y',strtotime($cDate))}}</span>
                </div>
            </div>
            <div class="col-sm-auto">
                <div class="date-info">
                    <label>Total New Clients:</label> <span>{{count($data)}}</span>
                </div>
            </div>
        </div>

        <div class="row g-3 mb-10 align-items-center tablist">
            <ul class="nav nav-tabs" id="myTab" role="tablist">
              <li class="nav-item" role="presentation">
                <button class="nav-link @if($type == 'date') active @endif fonts-red" data-id="today" data-bs-toggle="tab" type="button" role="tab" onclick="getNewClient('simple' ,'date' ,'');">Today</button>
              </li>

              <li class="nav-item" role="presentation">
                <button class="nav-link @if($type == 'week') active @endif fonts-red" data-id="week" data-bs-toggle="tab" type="button" role="tab" onclick="getNewClient('ajax' ,'week','');">Week</button>
              </li>

              <li class="nav-item" role="presentation">
                <button class="nav-link @if($type == 'month') active @endif fonts-red" data-id="month" data-bs-toggle="tab" type="button" role="tab" onclick="getNewClient('ajax' ,'month','');">Month</button>
              </li>

            </ul>
        </div>

        <div class="view-booking-table">
            <div class="table-responsive">
                <table class="table mb-0">
                    <thead>
                        <tr>
                            <th class="w-px-100">Name</th>
                            <th class="w-px-100">Email</th>
                            <th class="w-px-100">Age</th>
                            <th class="w-px-100">Status</th>
                            <th class="w-px-100">Customer Since</th>
                        </tr>
                    </thead>
                    <tbody id="tbody">
                        @php $counter = 0; @endphp
                        @forelse($data as $i=>$c)
                            @php  $counter++; @endphp
                            <tr>
                                <td>{{($counter)}}. <a target="_blank" href="{{route('business_customer_show' ,['business_id' => $c->business_id ,'id' => $c->id ])}}">{{@$c->full_name}}</a></td>
                                <td>{{$c->email ?? 'N/A'}}</td>
                                <td>{{$c->age ?? 'N/A'}}</td>
                                <td>{{$c->is_active()}}</td>
                                <td> {{date('m/d/Y', strtotime($c->created_at))}}</td>
                            </tr>
                        @empty
                            <tr><td colspan = 5><p class="fonts-red text-center">No New Clients Registed.</p></td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<script>
    flatpickr("#clientdate", {
        dateFormat: "Y-m-d",
        altInput: true,     
        altFormat: "m/d/Y",
     });

    function  changeCategory(chk,type,open) {
        $('tbody').html('<tr> <td colspan="5">Bookings is Loading..</td></tr>');
        var activeLiId =  $('ul.nav-tabs li.nav-item button.active').data('id');
        if(activeLiId == 'today'){
            activeLiId = 'date';
        }
    
        getNewClient(chk,activeLiId,open);
    }
</script>