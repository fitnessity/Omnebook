<h5 class="modal-title mb-10" id="myModalLabel">Cancel Activity</h5>
<form method="post" action="{{route('business.cancel_all_store')}}">
   @csrf
   <input type="hidden" name="_method" value="post">
   <input type="hidden" name="return_url" value="{{$return_url}}">
   <input type="hidden" name="schedule_id" value="{{$scheduleIds}}">
   <input type="hidden" name="cancel_date" value="{{$cancelDate->format('Y-m-d')}}">
   <div class="row">
      <div class="col-md-12">
         <div class="">
            @if(@$cancelDateChk == 'checked')
               <input type="checkbox" id="un_cancel_date_chk" name="un_cancel_date_chk" value="1" >
               <label for="un_cancel_date_chk"> UnCancel this activity</label><br>
            @endif 

            <input type="radio" id="show_cancel_on_schedule" name="chk_cancel_on_schedule" value="1" {{$showCancelOnSchedule}}>
            <label for="show_cancel_on_schedule">Show cancellation on schedule</label><br>
            <input type="radio" id="hide_cancel_on_schedule" name="chk_cancel_on_schedule" value="0"{{$hideCancelOnSchedule}}>
            <label for="hide_cancel_on_schedule">Hide cancellation on schedule</label><br>
         </div>
      </div>
   </div>
   <hr style="border: 1px solid #efefef; width: 107%;" class="ml-15 mt-15">
   <div class="row">
      <div class="col-md-12">
         <h5 class="modal-title mb-10">Alert others of the cancellations</h5> 
         <div class="">
            <input type="checkbox" id="email_Instructor" name="email_Instructor" value="1"{{$emailInstructor}}>
            <label for="email_Instructor">Email Instructor</label><br>
            <input type="checkbox" id="email_clients" name="email_clients" value="1"{{$emailClients}}>
            <label class="alert-label"> Alert registed clients with an email</label><br>
            <label for="email_clients">You have {{$totalRegisteredClient}} clients registered </label><br>
         </div>
         <button type="submit" class="btn btn-red float-right">Submit</a>
      </div>
   </div>
</form>