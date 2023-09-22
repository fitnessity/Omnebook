<div class="row">
     <div class="col-lg-12">
         <h4 class="modal-title partcipate-model">Select The Number of Participants</h4>
     </div>

     <div id="pricedivajax">
          @if($aduprice != '' &&  $aduprice != '0')
               <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="row">
                        <div class="col-md-8 col-sm-8 col-xs-7">
                             <div class="counter-titles">
                                  <p class="counter-age-heading">Adults</p>
                                  <p>Ages 13 & Up</p>
                             </div>
                        </div>
                        <div class="col-md-4 col-sm-4 col-xs-5">
                             <div class="qty counter-txt">
                                  <span class="minus bg-darkbtn adultminus"><i class="fa fa-minus"></i></span>
                                  <input type="text" class="count" name="adultcnt" id="adultcntajax" min="0" value="{{$aduqty}}" readonly>
                                  <span class="plus bg-darkbtn adultplus"><i class="fa fa-plus"></i></span>
                             </div>
                        </div>
                   </div>
               </div>
          @endif

          @if($childprice != '' &&  $childprice != '0')
               <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="row">
                         <div class="col-md-8 col-sm-8 col-xs-7">
                              <div class="counter-titles">
                                  <p class="counter-age-heading">Children</p>
                                  <p>Ages 2-12</p>
                              </div>
                         </div>
                         <div class="col-md-4 col-sm-4 col-xs-5">
                              <div class="qty counter-txt">
                                  <span class="minus bg-darkbtn childminus"><i class="fa fa-minus"></i></span>
                                  <input type="text" class="count" name="childcnt" id="childcntajax" min="0" value="{{$childqty}}" readonly>
                                  <span class="plus bg-darkbtn childplus"><i class="fa fa-plus"></i></span>
                              </div>
                         </div>
                    </div>
              </div>
          @endif
          
          @if($infantprice != '' &&  $infantprice != '0')
               <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="row">
                         <div class="col-md-8 col-sm-8 col-xs-7">
                              <div class="counter-titles">
                                  <p class="counter-age-heading">Infants</p>
                                  <p>Under 2</p>
                              </div>
                         </div>
                         <div class="col-md-4 col-sm-4 col-xs-5">
                              <div class="qty counter-txt">
                                  <span class="minus bg-darkbtn infantminus"><i class="fa fa-minus"></i></span>
                                  <input type="text" class="count" name="infantcnt" id="infantcntajax" value="{{$infantqty}}" min="0" readonly>
                                  <span class="plus bg-darkbtn infantplus"><i class="fa fa-plus"></i></span>
                              </div>
                         </div>
                    </div>
               </div>
          @endif
          <input type="hidden" name="session_val" id="session_valajax" value="{{$p_session}}" >
          <input type="hidden" name="adultprice" id="adultpriceajax" value="{{$aduprice}}" >
          <input type="hidden" name="childprice" id="childpriceajax" value="{{$childprice}}" >
          <input type="hidden" name="infantprice" id="infantpriceajax" value="{{$infantprice}}"> 
     </div>
</div>