<div class="row">
     <form method="post" action="{{route('business.addToCartForCheckout')}}">
          <input type="hidden" name="_token"  value="{{csrf_token()}}" />
          <div class="col-lg-12 col-xs-12 space-remover">
               <div class="manage-customer-modal-title">
                    <h4>Edit Cart Item</h4>
               </div>
               <div class="manage-customer-from">
                    <div class="row">
                         <div class="col-md-12 col-sm-12">
                              <div class="check-out-steps">
                                  <label><h2 class="color-red">Step 1: </h2> Select Service</label>
                              </div>
                              <div class="check-client-info-box">
                                   <div class="row">
                                        <input type="hidden" name="pc_regi_id" value="{{@$cart['participate_from_checkout_regi']['id']}}">
                                        <input type="hidden" name="pc_user_tp" value="{{@$cart['participate_from_checkout_regi']['pc_user_tp']}}">
                                        <div class="col-md-4 col-sm-4 col-xs-12">
                                             <div class="select0service">
                                                  <label>Who's Participating </label>
                                                  <select name="pc_value" id="participate_listajax" class="form-control">
                                                       <option value="{{@$cart['participate_from_checkout_regi']['id']}}">{{@$participate}}</option>
                                                  </select>
                                             </div>
                                        </div>
                                 
                                        <div class="col-md-4 col-sm-4 col-xs-12">
                                             <div class="select0service">
                                                  <label>Select Program </label>
                                                  <select name="program_listajax" id="program_listajax" class="form-control" onchange="loaddropdownajax('program',this,this.value);">
                                                       <option value="" >Select</option>
                                                       @if(!empty(@$program_list))
                                                            @foreach($program_list as $pl)
                                                                 <option value="{{$pl->id}}" @if($cart['code'] == $pl->id) selected @endif > {{$pl->program_name}}</option>
                                                            @endforeach
                                                       @endif
                                                  </select>
                                             </div>
                                        </div>
                                        <div class="col-md-4 col-sm-4 col-xs-12">
                                             <label>Select Catagory </label>
                                             <select name="category_listajax" id="category_listajax" class="form-control"  onchange="loaddropdownajax('category',this,this.value);">  
                                                  <option value="">Select Category</option>
                                                  @if(!empty(@$catelist)){
                                                       @foreach($catelist as $cl){
                                                            <option value="{{$cl->id}}" 
                                                            @if(@$cartselectedcategoryid->id == $cl->id) selected 
                                                            @endif >{{$cl->category_title}}</option>
                                                       @endforeach
                                                  @endif
                                             </select>
                                        </div>
                                   </div>
                          
                                   <div class="row">
                                        <div class="col-md-4 col-sm-4 col-xs-12">
                                             <label>Select Price Option  </label>
                                             <select name="priceopt_listajax" id="priceopt_listajax" class="form-control" onchange="loaddropdownajax('priceopt',this,this.value);">
                                                  <option value="">Select Price Title</option>
                                                  @if(!empty(@$pricelist))
                                                       @foreach($pricelist as $pl)
                                                            <option value="{{$pl->id}}" @if(@$cartselectedpriceid->id == $pl->id)  selected @endif >
                                                            {{$pl->price_title}} </option>
                                                       @endforeach
                                                  @endif
                                             </select>
                                        </div>
                                        <div class="col-md-4 col-sm-4 col-xs-12">
                                             <div class="select0service">
                                                  <div class="date-activity-scheduler date-activity-check paynowset">
                                                       <button type="button" class="btn btn-red" data-bs-toggle="modal" data-bs-target="#addpartcipateajax">Participant Quantity </button>
                                                  </div>
                                             </div>
                                        </div>
                                   </div>
                              </div>
                         </div>
                     
                         <div class="col-md-12">
                              <div class="check-out-steps"><label><h2 class="color-red">Step 2: </h2> Check Details </label></div>
                              <div class="check-client-info-box">
                                   <div class="row">
                                        <div class="col-md-2 col-sm-4 col-xs-12">
                                             <div class="select0service pricedollar">
                                                  <label>Price </label>
                                                  <div class="set-price">
                                                       <i class="fas fa-dollar-sign"></i>
                                                  </div>
                                                  <input type="text" class="form-control valid" id="priceajax" placeholder="$0.00" value="{{$cart['totalprice']}}">
                                             </div>
                                        </div>
                                        <div class="col-md-2 col-sm-4 col-xs-12">
                                             <div class="select0service pricedollar">
                                                  <label>Session</label>
                                                  <input type="text" class="form-control valid" id="p_sessionajax" name="pay_session" placeholder="1"  value="{{$cart['p_session']}}" >
                                             </div>
                                        </div>
                                        <div class="col-md-4 col-sm-4 col-xs-12">
                                             <div class="select0service">
                                                  <label>Discount</label>
                                                  <div class="row">
                                                       <div class="col-md-6 col-sm-6 col-xs-6 nopadding">
                                                            <div class="choose-tip">
                                                                 <select name="dis_amt_drop" id="dis_amt_dropajax" class="form-control" onchange="getdis();"> 
                                                                      <option value="">Choose $ or % </option>
                                                                      <option value="$" selected>$</option>
                                                                      <option value="%">%</option>
                                                                 </select>
                                                            </div>
                                                       </div>
                                                       <div class="col-md-6 col-sm-6 col-xs-6 nopadding">
                                                            <div class="choose-tip">
                                                                 <input type="text" class="form-control valid" id="dis_amtajax" name="dis_amtajax" placeholder="Enter Amount" value="{{$cart['discount']}}" onkeyup="getdis();">
                                                            </div>
                                                       </div>
                                                  </div>
                                             </div>
                                        </div>
                                        <div class="col-md-4 col-sm-4 col-xs-12">
                                             <div class="select0service">
                                                  <label>Tip Amount</label>
                                                  <div class="row">
                                                       <div class="col-md-6 col-sm-6 col-xs-6 nopadding">
                                                            <div class="choose-tip">
                                                                 <select name="tip_amt_dropajax" id="tip_amt_dropajax" class="form-control" onchange="getdis();" >
                                                                      <option value="">Choose $ or % </option>
                                                                      <option value="$" selected>$</option>
                                                                      <option value="%">%</option>
                                                                 </select>
                                                            </div>
                                                       </div>
                                                       <div class="col-md-6 col-sm-6 col-xs-6 nopadding">
                                                            <div class="choose-tip">
                                                                 <input type="text" class="form-control valid" id="tip_amtajax" name="tip_amtajax" placeholder="Enter Amount" value="{{$cart['tip']}}" onkeyup="getdis();">
                                                            </div>
                                                       </div>
                                                  </div>
                                             </div>
                                        </div>
                                   </div>
                                   <div class="row">
                                        <div class="col-md-4 col-sm-4 col-xs-12">
                                             <div class="col-md-6 col-sm-6 col-xs-6"> 
                                                  <div class="tax-check">
                                                       <label>Tax </label>
                                                       <input type="checkbox" id="taxajax" name="taxajax" value="1"
                                                            @if($cart['tax'] == 0 || $cart['tax'] == ''){
                                                             checked @endif>
                                                       <label for="tax"> No Tax</label><br>
                                                  </div>
                                             </div>
                                             <input type="hidden" name="duestax" id="duestaxajax" value="{{$duestaxajax}}">
                                             <input type="hidden" name="salestax" id="salestaxajax" value="{{$salestaxajax}}">
                                        </div>
                                        <div class="col-md-4 col-sm-4 col-xs-12">
                                             <div class="select0service">
                                                  <label>Duration</label>
                                                  <div class="row">
                                                       <div class="col-md-6 col-sm-6 col-xs-6 nopadding">
                                                            <input type="text" class="form-control valid" id="duration_intajax" name=duration_intajax placeholder="1" value="{{@$actscheduleid[0]}}" onkeyup="changeduration();">
                                                       </div>
                                                        
                                                       <div class="col-md-6 col-sm-6 col-xs-6 nopadding">
                                                            <div class="choose-tip">
                                                                 <select name="duration_dropdownajax" id="duration_dropdownajax" class="form-control" onchange="loaddropdownajax('duration',this,this.value);">
                                                                      <option value="Days" @if(@$actscheduleid[1] == "Days") selected  @endif >Day(s) </option>
                                                                      <option value="Weeks" @if(@$actscheduleid[1] == "Weeks") selected  @endif >Week(s)</option>
                                                                      <option value="Months" @if(@$actscheduleid[1] == "Months") selected  @endif >Month(s) </option>
                                                                      <option value="Years" @if(@$actscheduleid[1] == "Years") selected @endif >Year(s) </option>
                                                                 </select>
                                                            </div>
                                                       </div>
                                                  </div>
                                             </div>
                                        </div>
                                        <div class="col-md-4 col-sm-4 col-xs-12">
                                             <div class="select0service">
                                                  <label>Date This Activaties?</label>
                                                  <div class="date-activity-scheduler date-activity-check">
                                                       <input type="text"  name="actfildate"  id="contractajax" placeholder="Search By Date" class="form-control border-0 dash-filter-picker flatpickr-range flatpiker-with-border flatpickr-input active" value="{{date('m/d/Y',strtotime($cart['sesdate']))}}" onchange="changedate('ajax');">
                                                  </div>
                                             </div>
                                        </div>
                                   </div>
                              </div>
                         </div>
                    </div>
               </div>
          </div>
          <input type="hidden" name="aduquantity" id="adupricequantityajax" value="{{$aduqty}}" class="product-quantity"/>
          <input type="hidden" name="childquantity" id="childpricequantityajax" value="{{$childqty}}" class="product-quantity"/>
          <input type="hidden" name="infantquantity" id="infantpricequantityajax" value="{{$infantqty}}" class="product-quantity"/>

          <input type="hidden" name="cartaduprice" id="cartadupriceajax" value="{{$aduprice}}" class="product-quantity"/>
          <input type="hidden" name="cartchildprice" id="cartchildpriceajax" value="{{$childprice}}" class="product-quantity"/>
          <input type="hidden" name="cartinfantprice" id="cartinfantpriceajax" value="{{$infantprice}}" class="product-quantity"/>

          <input type="hidden" name="type" value="customer">
          <input type="hidden" name="pageid" value="{{$pageid}}">

          <input type="hidden" name="priceid" value="{{$cart['priceid']}}" id="priceidajax">
          <input type="hidden" name="actscheduleid" value="{{$cart['actscheduleid']}}" id="actscheduleidajax">
          <input type="hidden" name="sesdate" value="{{$cart['sesdate']}}" id="sesdateajax">
          <input type="hidden" name="pricetotal" id="pricetotalajax" value="{{$cart['totalprice']}}" class="product-price">
          <input type="hidden" name="tip_amt_val" id="tip_amt_valajax" value="{{$cart['tip']}}" class="product-price">
          <input type="hidden" name="dis_amt_val" id="dis_amt_valajax" value="{{$cart['discount']}}" class="product-price">
          <input type="hidden" name="pc_regi_id" id="pc_regi_idajax" value="{{$cart['participate_from_checkout_regi']['id']}}" class="product-price">
          <input type="hidden" name="pc_user_tp" id="pc_user_tpajax" value="{{$cart['participate_from_checkout_regi']['from']}}" class="product-price">
          <input type="hidden" name="pc_value" id="pc_valueajax" value="{{$participate}}" class="product-price">
          <input type="hidden" name="pid" id="pidajax" value="{{$cart['code']}}">
          <input type="hidden" name="deletepid" id="deletepid" value="{{$indexOfAry}}">
          <input type="hidden" name="categoryid" id="categoryidajax" value="{{$cart['categoryid']}}">
          <input type="hidden" name="chk" value="activity_purchase">
          <input type="hidden" name="value_tax" id="value_taxajax" value="{{$cart['tax']}}">
          <button type="submit" class="btn btn-red" >Submit</a>
     </form>
</div>

<script type="text/javascript">
    flatpickr(".flatpickr-input", {
        dateFormat: "m/d/Y",
        maxDate: "01/01/2050",
    });
</script>
