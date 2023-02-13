<div class="row">
   <div class="col-lg-12">
      <h4 class="modal-title" style="text-align: center; color: #000; line-height: inherit; font-weight: 600; margin-top: 9px;margin-bottom: 10px;">What happens if a customer late cancels or no show? </h4>
   </div>
</div>
<div class="row">

   <form method="post" action="{{route('business.schedulers.checkin_details.update', ['scheduler'=>$booking_checkin_detail->business_activity_scheduler_id, 'checkin_detail' => $booking_checkin_detail->id])}}">
     @csrf
     @method('PUT')


      <input type="radio" name="no_show_action" value="nothing" 
      @if($booking_checkin_detail->no_show_action == 'nothing' || $booking_checkin_detail->no_show_action == Null)
          checked
      @endif
      >
      <label for="nothing">Nothing</label>
      <br>

      <input type="radio" name="no_show_action" value="charge_fee"
      @if($booking_checkin_detail->no_show_action == 'charge_fee')
          checked
      @endif
      >
      <label for="fee">Charge Fee on Card</label>
      <input type="text" class="form-control feeamount" name="no_show_charged" placeholder="$ Fee Amount" value="{{$booking_checkin_detail->no_show_charged}}">
      <br>

      <input type="radio" name="no_show_action" value="deduct"
          @if($booking_checkin_detail->no_show_action == 'deduct')
               checked
          @endif
      >
      <label for="javascript">Deduct from membership</label> 
      <select class="form-control" name="booking_detail_id">
          @foreach($booking_checkin_detail->customer->active_booking_details()->get() as $customer_booking_detail)
            @if($customer_booking_detail->business_price_detail)
               <option value="{{$customer_booking_detail->id}}" >
                   {{$customer_booking_detail->business_price_detail['price_title']}}
               </option>
            @endif
          @endforeach

      </select>
      <button type="submit" class="btn-nxt manage-cus-btn cancel-modal">Submit</button>
   </form>
</div>