<h5 class="modal-title mb-10" id="myModalLabel">Cancel Activity</h5>
<form method="post" action="{{route('business.schedulers.destroy', ['scheduler' => $schedule->id])}}">
   @csrf
   <input type="hidden" name="_method" value="delete">
   <input type ="hidden" name="can_id" value="{{@$activityCancel->id}}">
   <input type="hidden" name="return_url" value="{{$return_url}}">
   <input type="hidden" name="schedule_id" value="{{$schedule->id}}">
   <input type="hidden" name="cancel_date" value="{{$cancelDate->format('Y-m-d')}}">
   <div class="row">
      <div class="col-md-12">
         <div class="">
            <input type="checkbox" id="cancel_date_chk" name="cancel_date_chk" value="1" {{$cancelDateChk}}>
            <label for="cancel_date_chk"> Cancel this activity for today only</label><br>

            <input type="radio" id="show_cancel_on_schedule" name="chk_cancel_on_schedule" value="1" {{$showCancelOnSchedule}}>
            <label for="show_cancel_on_schedule">Show cancellation on schedule</label><br>
            <input type="radio" id="hide_cancel_on_schedule" name="chk_cancel_on_schedule" value="0"{{$hideCancelOnSchedule}}>
            <label for="hide_cancel_on_schedule">Hide cancellation on schedule</label><br>
         </div>
      </div>
   </div>
   <hr style="border: 1px solid #efefef; width: 107%; margin-left: -15px; margin-top: 15px;">
   <div class="row">
      <div class="col-md-12">
         <h5 class="modal-title mb-10">Alert others of the cancellations</h5> 
         <div class="">
            <input type="checkbox" id="email_Instructor" name="email_Instructor" value="1"{{$emailInstructor}}>
            <label for="email_Instructor">Email Instructor</label><br>
            <input type="checkbox" id="email_clients" name="email_clients" value="1"{{$emailClients}}>
            <label for="email_clients">You have {{$schedule->spots_reserved($cancelDate)}} clients registered </label><br>
            <label class="alert-label"> Alert registed clients with an email</label><br>
         </div>
         <button type="submit" class="btn btn-red float-right">Submit</a>
      </div>
   </div>
</form>