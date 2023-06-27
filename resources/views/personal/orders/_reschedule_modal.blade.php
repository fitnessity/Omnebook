<div class="row contentPop"> 
    <div class="col-lg-12">
        <div class="modal-inner-txt">
            <h4 class="fontsize">This activity has already been scheduled for {{$reservedDate}} at {{$reserveTime}}. Would you like to reschedule?</h4>
        </div>
    </div>
    <div class="col-lg-12 btns-modal">
        <a href="{{route('business_activity_schedulers',['business_id' => $business_id ,'business_service_id'=>$business_service_id ,'stype'=>$stype ,'priceid' =>$priceid ,'customer_id' =>$customer_id ] )}}" class="addbusiness-btn-modal" target="_blank">ReSchedule</a>
        <a data-dismiss="modal" aria-label="Close" class="addbusiness-btn-black">Cancel</a>
    </div>
 </div>