@php 
  use Carbon\Carbon;
  use App\StaffMembers;
@endphp

<div class="row">
  <div class="col-md-12 col-xs-12">
      <div class="manage-cust-box">
          <div class="table-responsive">
              <table id="visitstable" class="table table-striped table-bordered" style="width:100%">
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
                              <td>{{date('m/d/Y',strtotime($visit->checkin_date))}}</td>
                              <td>{{date('h:i A', strtotime($visit->order_detail->business_activity_scheduler->shift_start))}}</td>
                              <td>{{$visit->order_detail->business_services->program_name}}</td>
                              <td>{{$visit->order_detail->business_price_detail->price_title}}</td>
                              
                              <td>
                              {{$visit->status_term()}}
                              </td>
                              <td>{{StaffMembers::getinstructorname($visit->order_detail->business_services->instructor_id)}}</td>
                          </tr>
                      @endforeach
                  </tbody>
              </table>
          </div>
      </div>
  </div>
</div>