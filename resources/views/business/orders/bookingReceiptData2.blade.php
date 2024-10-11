            <input type="hidden" name="booking_id" id="booking_id" value="{{$order_detail->booking_id}}"> 
            <input type="hidden" name="orderdetalidary[]" id="orderdetalidary" value="{{$idarry}}"> 
            <div class="row border-xx mg-tp">
                <div class="col-md-6 col-xs-6">
                   <div class="text-left">
                        <label>PAYMENT METHOD</label>
                   </div>
                </div>
                <div class="col-md-6 col-xs-6">
                    <div class="float-end text-right">
                        <span>{{$odt['pmt_type']}}</span>
                    </div>
                </div>
            </div>

            <div class="row border-xx">
                <div class="col-md-6 col-xs-6">
                    <div class="text-left">
                        <label>TIP AMOUNT</label>
                    </div>
                </div>
                <div class="col-md-6 col-xs-6">
                    <div class="float-end text-right">
                        <span>${{$tot_tip}}</span>
                    </div>
                </div>
            </div>

            <div class="row border-xx">
                <div class="col-md-6 col-xs-6">
                   <div class="text-left">
                        <label>DISCOUNT</label>
                   </div>
                </div>
                <div class="col-md-6 col-xs-6">
                   <div class="float-end text-right">
                        <span>${{$tot_dis}}</span>
                   </div>
                </div>
            </div>

            <div class="row border-xx">
                <div class="col-md-6 col-xs-6">
                    <div class="text-left">
                        <label>TAXES AND FEES</label>
                    </div>
                </div>
                <div class="col-md-6 col-xs-6">
                    <div class="float-end text-right">
                        <span>${{($totaltax +  $service_fee )}}</span>
                    </div>
                </div>
            </div>
            <div class="row border-xx">
                <div class="col-md-6 col-xs-6">
                    <div class="text-left">
                        <label>TOTAL AMOUNT PAID</label>
                    </div>
                </div>
                <div class="col-md-6 col-xs-6">
                    <div class="float-end text-right">
                        <span>${{$odt['amount']}}</span>
                    </div>
                </div>
            </div>
        </div>
   </div>
</div>