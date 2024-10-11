<h5 class="modal-title mb-10" id="myModalLabel">Cancel Activity</h5>
<form method="post" action="{{route('business.cancel_all_by_date_store')}}">
   @csrf
   <input type="hidden" name="activity_type" value="{{request()->activity_type}}">
   <div class="row">
      <div class="col-md-6">
         <div class="form-group mb-15">
            <label>Cancel Multiple Days</label>
            <div class="special-date">     
               <div class="input-group">
                  <input type="text" class="form-control "readonly="readonly" id="dates" name="dates" value="">
                  <div class="input-group-text bg-primary border-primary text-white">
                     <i class="ri-calendar-2-line"></i>
                  </div>
               </div>
            </div> 
         </div>
      </div>
      <div class="col-md-12">
         <div class="">
            <input type="radio" name="cancelStatus" value="1" checked>
            <label class="mr-5">Cancel</label>
            <input type="radio" name="cancelStatus" value="0">
            <label>UnCancel</label><br>
            <div class="status">
               <input type="radio" id="show_cancel_on_schedule" name="chk_cancel_on_schedule" value="1" checked>
               <label for="show_cancel_on_schedule">Show cancellation on schedule</label><br>
               <input type="radio" id="hide_cancel_on_schedule" name="chk_cancel_on_schedule" value="0">
               <label for="hide_cancel_on_schedule">Hide cancellation on schedule</label><br>
            </div>
         </div>
      </div>
   </div>
   <hr style="border: 1px solid #efefef; width: 100%;" class="ml-15">
   <div class="row">
      <div class="col-md-12">
         <h5 class="modal-title mb-10">Alert others of the cancellations</h5> 
         <div class="">
            <input type="checkbox" id="email_Instructor" name="email_Instructor" value="1">
            <label for="email_Instructor">Email Instructor</label><br>
            <input type="checkbox" id="email_clients" name="email_clients" value="1">
            <label class="alert-label"> Alert registed clients with an email</label><br>
         </div>
         <button type="submit" class="btn btn-red float-right">Submit</a>
      </div>
   </div>
</form>

<script>
   flatpickr("#dates", {
      altInput: true,
      mode: "multiple",
      altFormat: "m/d/Y", 
      dateFormat: "Y-m-d",
      minDate: "today",
   });

   $('input[name="cancelStatus"]').change(function () {
      var selectedValue = $('input[name="cancelStatus"]:checked').val();
      if(selectedValue == 0){
         $('.status').css('display','none');
      }else{
         $('.status').css('display','block');
      }
   });

</script>