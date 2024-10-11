@php 
  use Carbon\Carbon;
  use App\BusinessStaff;
@endphp
    <h4 class="mb-10">Activity Scheduler</h4>
    <div class="scheduler-table">
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
                        <tr>
                            <td><p class="mb-0">{{date('m/d/Y',strtotime($visit->checkin_date))}}</p></td>
                            <td><p class="mb-0">{{date('h:i A', strtotime(@$visit->order_detail->business_activity_scheduler->shift_start))}}</p></td>
                            <td><p class="mb-0">{{$visit->order_detail->business_services->program_name}}</p></td>
                            <td><p class="mb-0">{{$visit->order_detail->business_price_detail->price_title}}</p></td>
                            <td><p class="mb-0">{{$visit->status_term()}}</p></td>
                            <td><p class="mb-0">{{BusinessStaff::getinstructorname($visit->order_detail->business_services->instructor_id)}}</p></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>