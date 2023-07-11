<?php 
    $adultTxt = $childTxt = $infantTxt = '';
    if(@$price->is_recurring_adult == '1'){
        $recurringStrAdult = explode(" ",@$price->recurring_customer_chage_by_adult);
        if(!empty($recurringStrAdult) && is_numeric(@$price->recurring_nuberofautopays_adult) && is_numeric($recurringStrAdult[0])){
            $adultTxt  .='( '.$price->recurring_nuberofautopays_adult * $recurringStrAdult[0].' '.@$recurringStrAdult[1].' contract ';
            $adultTxt  .= '| $'.@$price->recurring_first_pmt_adult.' per '.@$recurringStrAdult[0].' '.@$recurringStrAdult[1];
            $adultTxt  .= ' | Totalling $'.@$price->recurring_total_contract_revenue_adult;
        }
    }

    if(@$price->is_recurring_child == '1'){
        $recurringStrChild = explode(" ",@$price->recurring_customer_chage_by_child);
        if(!empty($recurringStrChild) && is_numeric(@$price->recurring_nuberofautopays_child) && is_numeric($recurringStrChild[0])){
            $childTxt  .='( '.$price->recurring_nuberofautopays_child * $recurringStrChild[0].' '.@$recurringStrChild[1].' contract ';
            $childTxt  .= '| $'.@$price->recurring_first_pmt_child.' per '.@$recurringStrChild[0].' '.@$recurringStrChild[1];
            $childTxt  .= '| Totalling $'.@$price->recurring_total_contract_revenue_child;
        }
    }

    if(@$price->is_recurring_infant == '1'){
        $recurringStrInfant = explode(" ",@$price->recurring_customer_chage_by_infant);
        if(!empty($recurringStrInfant) && is_numeric(@$price->recurring_nuberofautopays_infant) && is_numeric($recurringStrInfant[0])){
            $infantTxt  .='( '.$price->recurring_nuberofautopays_infant * $recurringStrInfant[0].' contract ';
            $infantTxt  .= '| $'.@$price->recurring_first_pmt_infant.' per '.@$recurringStrInfant[0].' '.@$recurringStrInfant[1];
            $infantTxt  .= '| Totalling $'.@$price->recurring_total_contract_revenue_infant;
        }

    }
    
?>
<div class="accordion nesting2-accordion custom-accordionwithicon accordion-border-box mt-3" id="priceoption{{$i}}{{$j}}">
    <div class="accordion-item shadow">
        <h2 class="accordion-header" id="acc_nesting{{$i}}{{$j}}">
            <button class="accordion-custom-btn accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#accor_nestingprice{{$i}}{{$j}}" aria-expanded="true" aria-controls="accor_nestingprice{{$i}}{{$j}}">
                <div class="container-fluid nopadding">
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-8">
                            Price Option   {{@$price->price_title != '' ? " : ".@$price->price_title :'' }}
                        </div>
                        <div class="col-lg-6 col-md-6 col-4">
                            <div class="priceoptionsettings">
                                <div class="setting-icon">
                                    <i class="ri-more-fill"></i>
                                    <ul id="ul{{$i}}{{$j}}">
                                        <li class="non-collapsing" data-bs-toggle="collapse" data-bs-target><a onclick=" return add_another_price_duplicate_session({{$i}},{{$j}});"><i class="fas fa-plus text-muted"></i>Duplicate This Price Option Only</a></li>
                                        @if($j!= 0)
                                        <li class="dropdown-divider"></li>
                                        <li><a href="" onclick="deletePriceOption({{$i}},{{$j}})"><i class="ri-delete-bin-fill align-bottom me-2 text-muted"></i>Delete</a></li>
                                        @endif
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </button>
        </h2>
        <div id="accor_nestingprice{{$i}}{{$j}}" class="accordion-collapse collapse" aria-labelledby="acc_nesting{{$i}}{{$j}}" data-bs-parent="#priceoption{{$i}}{{$j}}">
            <div class="accordion-body">
                <input type="hidden" name="price_id_db_{{$i}}{{$j}}" id="price_id_db{{$i}}{{$j}}" value="{{@$price->id}}" />
                <div class="row">
                    <div class="col-lg-3 col-md-6">
                        <div class="set-price mb-0">
                            <label>Price Title</label>
                            <input name="price_title_{{$i}}{{$j}}" id="price_title{{$i}}{{$j}}" value ="{{@$price->price_title}}" oninput="getpricetitle({{$i}},{{$j}})" class="form-control" type="text" placeholder="Ex: 6 month Membership" >
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="set-price mb-0">
                            <label>Session Type</label>
                            <select name="pay_session_type_{{$i}}{{$j}}" id="pay_session_type{{$i}}{{$j}}" onchange="pay_session_select({{$i}},{{$j}},this.value);" class="form-select"  data-choices="" data-choices-search-false="" >
                                <option value="Single" {{(@$price->pay_session_type=='Single')?'selected':'' }} >Single</option>
                                <option value="Multiple" {{(@$price->pay_session_type=='Multiple')?'selected':'' }}>Multiple</option>
                                <option value="Unlimited" {{(@$price->pay_session_type=='Unlimited')?'selected':'' }}>Unlimited</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="set-price mb-0">
                            <label>Number of Sessions</label>
                            <input name="pay_session_{{$i}}{{$j}}" id="pay_session{{$i}}{{$j}}" value="{{(@$price->pay_session != '') ? @$price->pay_session :  1 }}" {{(@$price->pay_session_type != 'Multiple') ? "readonly" :  ''}} class="form-control pay_session" type="text" placeholder="1"  onkeypress="return event.charCode >= 46 && event.charCode <= 57">
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="set-price mb-0">
                            <label>Membership Type</label>
                            <select name="membership_type_{{$i}}{{$j}}" id="membership_type{{$i}}{{$j}}" class="form-select membership_type" data-choices="" data-choices-search-false="" >
                                <option value="Drop In"  {{(@$price->membership_type=='Drop In')?'selected':'' }}>Drop In</option>
                                <option value="Semester" {{(@$price->membership_type=='Semester')?'selected':'' }}>Semester (Long Term)</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <p class="info-txt-price">You can set your prices to be the same or different based on age, the weekday or the weekend. To add prices for children or infants, click on the box.</p>
                    </div>
                    <div class="col-md-12">
                        <div class="mt-15 price-selection">
                            <input type="radio" id="freeprice{{$i}}{{$j}}" name="sectiondisplay{{$i}}{{$j}}" onclick="showdiv({{$i}},{{$j}});" value="freeprice" {{@$price->dispaly_section == 'free' ? 'checked' : ''}}>
                            <label class="recurring-pmt">Free</label>
                                            
                            <input type="radio" id="weekdayprice{{$i}}{{$j}}" name="sectiondisplay{{$i}}{{$j}}" onclick="showdiv({{$i}},{{$j}});" value="weekdayprice" {{@$price->dispaly_section == 'weekdayprice' ? 'checked' : ''}}>
                            <label class="recurring-pmt">Everyday Price</label>
                                            
                            <input type="radio" id="weekendprice{{$i}}{{$j}}" name="sectiondisplay{{$i}}{{$j}}" onclick="showdiv({{$i}},{{$j}});" value="weekendprice"  {{(@$price->dispaly_section == 'weekendprice' || @$price->dispaly_section == '' )? 'checked' : ''}} >
                            <label class="recurring-pmt">Weekend Price</label>
                        </div>
                    </div>
                    <div class="col-md-12 displaysectiondiv{{$i}}{{$j}}">
                        <div class="choose-age price-selection">
                            <p>Select who this price option is for. (choose all that apply)</p>
                            <input type="checkbox" id="all{{$i}}{{$j}}" name="all{{$i}}{{$j}}" onclick="priceOptionFor({{$i}},{{$j}},this.value);" value="all" >
                            <label class="recurring-pmt">All</label>
                            
                            <input type="checkbox" id="adult{{$i}}{{$j}}" name="adult{{$i}}{{$j}}" onclick="priceOptionFor({{$i}},{{$j}},this.value);" value="adult" {{(@$price->adult_cus_weekly_price != '' || @$price == '') ? 'checked': ''}}>
                            <label class="recurring-pmt">Adults (12 and up)</label>
                                            
                            <input type="checkbox" id="child{{$i}}{{$j}}" name="child{{$i}}{{$j}}" onclick="priceOptionFor({{$i}},{{$j}},this.value);" value="child" {{@$price->child_cus_weekly_price != '' ? 'checked': ''}}>
                            <label class="recurring-pmt">Children (2 to 12)</label>
                                            
                            <input type="checkbox" id="infant{{$i}}{{$j}}" name="infant{{$i}}{{$j}}" onclick="priceOptionFor({{$i}},{{$j}},this.value);" value="infant" {{@$price->infant_cus_weekly_price != '' ? 'checked': ''}}>
                            <label class="recurring-pmt">Infants ( 2 and Under)</label>
                        </div>
                    </div>
                </div>
                
                <div class="accordion nesting4-accordion custom-accordionwithicon accordion-border-box mt-3 displaysectiondiv{{$i}}{{$j}} {{(@$price->adult_cus_weekly_price != '' || @$price == '') ? '': 'd-none'}}" id="accor_nestingadult{{$i}}{{$j}}">
                    <div class="accordion-item shadow">
                        <h2 class="accordion-header" id="accordionnesting4Example2">
                            <button class="accordion-custom-btn accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#accor_adult{{$i}}{{$j}}" aria-expanded="false" aria-controls="accor_adult{{$i}}{{$j}}">
                                Prices Options for Adults
                            </button>
                        </h2>
                        <div id="accor_adult{{$i}}{{$j}}" class="accordion-collapse collapse" aria-labelledby="accor_nestingadult{{$i}}{{$j}}" data-bs-parent="#accor_nestingadult{{$i}}{{$j}}">
                            <div class="accordion-body">
                                <div class="container nopadding">
                                    <div class="row">
                                        <div class="age-cat">
                                            <div class="cat-age sp-select">
                                                <label>Adults</label>
                                                <p>Ages 12 & Older</p>
                                            </div>
                                        </div>
                                        <div class="weekly-customer">
                                            <div class="cus-week-price sp-select">
                                                <label>Weekday Price</label>
                                                <p> (Monday - Sunday)</p>
                                                <input name="adult_cus_weekly_price_{{$i}}{{$j}}" id="adult_cus_weekly_price{{$i}}{{$j}}" value="{{@$price->adult_cus_weekly_price}}" onkeyup="changeWDayPrice({{$i}},{{$j}},'adult');" type="text" class="form-control "onkeypress="return event.charCode >= 46 && event.charCode <= 57" placeholder="$"></div> 
                                        </div>
                                        <div class="weekend-price Weekend{{$i}}{{$j}} @if(@$price->dispaly_section == 'weekdayprice') d-none @endif">
                                            <div class="cus-week-price sp-select">
                                                <label>Weekend Price </label>
                                                <p> (Saturday & Sunday)</p>
                                                <input name="adult_weekend_price_diff_{{$i}}{{$j}}" id="adult_weekend_price_diff{{$i}}{{$j}}" value="{{@$price->adult_weekend_price_diff}}" onkeyup="changeWEndPrice({{$i}},{{$j}},'adult');" value="" class="form-control" type="text" placeholder="$" onkeypress="return event.charCode >= 46 && event.charCode <= 57"></div>
                                        </div>
                                        <div class="re-discount">
                                            <div class="discount sp-select">
                                                <label>Any Discount? </label>
                                                <p> (Recommended 10% to 15%)</p>
                                                <input class="form-control" type="text" name="adult_discount_{{$i}}{{$j}}" id="adult_discount{{$i}}{{$j}}" value="{{@$price->adult_discount}}" onkeyup="changeDiscount({{$i}},{{$j}},'adult');" value="" onkeypress="return event.charCode >= 46 && event.charCode <= 57">
                                            </div>
                                        </div>
                                        <div class="single-dash">
                                            <div class="desh sp-select">
                                                <label>-</label>
                                            </div>
                                        </div>
                                        <div class="fit-fees">
                                            <div class="fees sp-select">
                                                <label>Introduction Fee 
													<span type="button" class="tool-tip" data-bs-toggle="tooltip" data-bs-placement="top" title="Lorem Ipsum is simply dummy text of the printing and typesetting industry.">
														<i class="fas fa-info"></i>
													</span>
													<p> {{$fitnessity_fee}}% Amount</p>
												</label>
                                                <label>Recurring Fee  
													<span type="button" class="tool-tip" data-bs-toggle="tooltip" data-bs-placement="top" title="Lorem Ipsum is simply dummy text of the printing and typesetting industry.">
														<i class="fas fa-info"></i>
													</span>
													<p> {{$recurring_fee}}% Amount</p>
												</label>
                                            </div>
                                        </div>
                                        <div class="single-equal">
                                            <div class="equal sp-select">
                                                <label>=</label>
                                            </div>
                                        </div>
                                        <div class="estimated-earn">
                                            <div class="cus-week-price earn sp-select">
                                                <label>Weekday Estimated Earnings </label>
                                                <input class="form-control" type="text" name="adult_estearn_{{$i}}{{$j}}" id="adult_estearn{{$i}}{{$j}}" value="{{@$price->adult_estearn}}"  onkeypress="return event.charCode >= 46 && event.charCode <= 57" placeholder="$" value="">
                                            </div>
                                        </div>
                                        <div class="estimated-earn Weekend{{$i}}{{$j}} @if(@$price->dispaly_section == 'weekdayprice') d-none @endif">
                                            <div class="cus-week-price earn sp-select">
                                                <label>Weekend Estimated Earnings </label>
                                                <input class="form-control" type="text" name="weekend_adult_estearn_{{$i}}{{$j}}" id="weekend_adult_estearn{{$i}}{{$j}}" value="{{@$price->weekend_adult_estearn}}" onkeypress="return event.charCode >= 46 && event.charCode <= 57" placeholder="$" value="">
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="mb-15 mt-15 checkbox-selection">
                                                <input data-count="0"  type="checkbox" id="is_recurring_adult{{$i}}{{$j}}" name="is_recurring_adult_{{$i}}{{$j}}" @if(@$price->is_recurring_adult == '1') Checked value="1" @else value="0"" @endif onclick="openmodelbox({{$i}},{{$j}},'adult');" >
                                                <button id="btn_recurring_adult{{$i}}{{$j}}" name="btn_recurring_adult_{{$i}}{{$j}}[]" type="button" data-count="0" class="btn btn-primary recurrint_id d-none" data-bs-toggle="modal" data-bs-target=".edit-adult{{$i}}{{$j}}" onclick="recurrint_id({{$i}},{{$j}},'adult');">Launch demo modal</button>
                                                <label for="adults1" id="recurringtxtadult{{$i}}{{$j}}">Is This A Recurring Payment? Set the payment terms for Adults @if(@$price->is_recurring_adult == '1') {{$adultTxt}} <a href="" data-bs-toggle="modal" data-bs-target=".edit-adult{{$i}}{{$j}}" class="">Edit</a> ) <div class="delete-recurring" onclick="deleteRecurring('{{$i}}','{{$j}}','adult')"><i class="fas fa-trash-alt"></i></div> @endif </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="accordion nesting4-accordion custom-accordionwithicon accordion-border-box mt-3 displaysectiondiv{{$i}}{{$j}} {{@$price->child_cus_weekly_price != ''  ? '': 'd-none'}}" id="accor_nestingchild{{$i}}{{$j}}" >
                    <div class="accordion-item shadow">
                        <h2 class="accordion-header" id="accordionnesting4Example2">
                            <button class="accordion-custom-btn accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#accor_child{{$i}}{{$j}}" aria-expanded="false" aria-controls="accor_child{{$i}}{{$j}}">
                                Prices Options for Children
                            </button>
                        </h2>
                        <div id="accor_child{{$i}}{{$j}}" class="accordion-collapse collapse" aria-labelledby="accor_nestingchild{{$i}}{{$j}}" data-bs-parent="#accor_nestingchild{{$i}}{{$j}}">
                            <div class="accordion-body">
                                <div class="container nopadding">
                                    <div class="row">
                                        <div class="age-cat">
                                            <div class="cat-age sp-select">
                                                <label>Children</label>
                                                <p>Ages 12 & Older</p>
                                            </div>
                                        </div>
                                        <div class="weekly-customer">
                                            <div class="cus-week-price sp-select">
                                                <label>Weekday Price</label>
                                                <p> (Monday - Sunday)</p>
                                                <input  name="child_cus_weekly_price_{{$i}}{{$j}}" id="child_cus_weekly_price{{$i}}{{$j}}" value="{{@$price->child_cus_weekly_price}}" onkeyup="changeWDayPrice({{$i}},{{$j}} ,'child');" type="text" class="form-control "onkeypress="return event.charCode >= 46 && event.charCode <= 57" placeholder="$"></div> 
                                        </div>
                                        <div class="weekend-price Weekend{{$i}}{{$j}} @if(@$price->dispaly_section == 'weekdayprice') d-none @endif">
                                            <div class="cus-week-price sp-select">
                                                <label>Weekend Price </label>
                                                <p> (Saturday & Sunday)</p>

                                                <input name="child_weekend_price_diff_{{$i}}{{$j}}" id="child_weekend_price_diff{{$i}}{{$j}}" value="{{@$price->child_weekend_price_diff}}" onkeyup="changeWEndPrice({{$i}},{{$j}},'child');" class="form-control" type="text" placeholder="$" onkeypress="return event.charCode >= 46 && event.charCode <= 57"></div>
                                        </div>
                                        <div class="re-discount">
                                            <div class="discount sp-select">
                                                <label>Any Discount? </label>
                                                <p> (Recommended 10% to 15%)</p>
                                                <input class="form-control" type="text" name="child_discount_{{$i}}{{$j}}" id="child_discount{{$i}}{{$j}}" value="{{@$price->child_discount}}" onkeyup="changeDiscount({{$i}},{{$j}},'child');"  onkeypress="return event.charCode >= 46 && event.charCode <= 57">
                                            </div>
                                        </div>
                                        <div class="single-dash">
                                            <div class="desh sp-select">
                                                <label>-</label>
                                            </div>
                                        </div>
                                        <div class="fit-fees">
                                            <div class="fees sp-select">
                                                <label>Introduction Fee 
													<span type="button" class="tool-tip" data-bs-toggle="tooltip" data-bs-placement="top" title="Lorem Ipsum is simply dummy text of the printing and typesetting industry.">
														<i class="fas fa-info"></i>
													</span>
													<p> {{$fitnessity_fee}}% Amount</p>
												</label>
                                                <label>Recurring Fee 
													<span type="button" class="tool-tip" data-bs-toggle="tooltip" data-bs-placement="top" title="Lorem Ipsum is simply dummy text of the printing and typesetting industry.">
														<i class="fas fa-info"></i>
													</span>
													<p> {{$recurring_fee}}% Amount</p>
												</label>
                                                
                                                
                                            </div>
                                        </div>
                                        <div class="single-equal">
                                            <div class="equal sp-select">
                                                <label>=</label>
                                            </div>
                                        </div>
                                        <div class="estimated-earn">
                                            <div class="cus-week-price earn sp-select">
                                                <label>Weekday Estimated Earnings </label>
                                                <input class="form-control" type="text" name="child_estearn_{{$i}}{{$j}}" id="child_estearn{{$i}}{{$j}}" value="{{@$price->child_estearn}}" onkeypress="return event.charCode >= 46 && event.charCode <= 57" placeholder="$" >
                                            </div>
                                        </div>
                                        <div class="estimated-earn Weekend{{$i}}{{$j}} @if(@$price->dispaly_section == 'weekdayprice') d-none @endif">
                                            <div class="cus-week-price earn sp-select">
                                                <label>Weekend Estimated Earnings </label>
                                                <input class="form-control" type="text" name="weekend_child_estearn_{{$i}}{{$j}}" id="weekend_child_estearn{{$i}}{{$j}}" value="{{@$price->weekend_child_estearn}}" onkeypress="return event.charCode >= 46 && event.charCode <= 57" placeholder="$" >
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="mb-15 mt-15 checkbox-selection">
                                                <input data-count="0"  type="checkbox" id="is_recurring_child{{$i}}{{$j}}" name="is_recurring_child_{{$i}}{{$j}}" @if(@$price->is_recurring_child == '1') Checked value="1" @else value="0"  @endif onclick="openmodelbox({{$i}},{{$j}},'child');" >
                                                <label for="child" id="recurringtxtchild{{$i}}{{$j}}">Is This A Recurring Payment? Set the payment terms for Children  @if(@$price->is_recurring_child == '1') {{$childTxt}} <a href="" data-bs-toggle="modal" data-bs-target=".edit-child{{$i}}{{$j}}" class="">Edit</a> ) <div class="delete-recurring" onclick="deleteRecurring('{{$i}}','{{$j}}','child')"><i class="fas fa-trash-alt"></i></div> @endif </label>

                                                <button id="btn_recurring_child{{$i}}{{$j}}" name="btn_recurring_child_{{$i}}{{$j}}[]" type="button" data-count="0" class="btn btn-primary recurrint_id d-none" data-bs-toggle="modal" data-bs-target=".edit-child{{$i}}{{$j}}" onclick="recurrint_id({{$i}},{{$j}},'child');">Launch demo modal</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="accordion nesting4-accordion custom-accordionwithicon accordion-border-box mt-3 displaysectiondiv{{$i}}{{$j}} {{@$price->infant_cus_weekly_price != ''  ? '': 'd-none'}}" id="accor_nestinginfant{{$i}}{{$j}}">
                    <div class="accordion-item shadow">
                        <h2 class="accordion-header" id="accordionnesting4Example2">
                            <button class="accordion-custom-btn accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#accor_infant{{$i}}{{$j}}" aria-expanded="false" aria-controls="accor_infant{{$i}}{{$j}}">
                                Prices Options for Infants
                            </button>
                        </h2>
                        <div id="accor_infant{{$i}}{{$j}}" class="accordion-collapse collapse" aria-labelledby="accor_nestinginfant{{$i}}{{$j}}" data-bs-parent="#accor_nestinginfant{{$i}}{{$j}}">
                            <div class="accordion-body">
                                <div class="container nopadding">
                                    <div class="row">
                                        <div class="age-cat">
                                            <div class="cat-age sp-select">
                                                <label>Infant</label>
                                                <p>Ages 12 & Older</p>
                                            </div>
                                        </div>
                                        <div class="weekly-customer">
                                            <div class="cus-week-price sp-select">
                                                <label>Weekday Price</label>
                                                <p> (Monday - Sunday)</p>
                                                <input  name="infant_cus_weekly_price_{{$i}}{{$j}}" id="infant_cus_weekly_price{{$i}}{{$j}}" value="{{@$price->infant_cus_weekly_price}}" onkeyup="changeWDayPrice({{$i}},{{$j}},'infant');" type="text" class="form-control" onkeypress="return event.charCode >= 46 && event.charCode <= 57" placeholder="$">
                                            </div>
                                        </div>
                                        <div class="weekend-price Weekend{{$i}}{{$j}} @if(@$price->dispaly_section == 'weekdayprice') d-none @endif">
                                            <div class="cus-week-price sp-select">
                                                <label>Weekend Price </label>
                                                <p> (Saturday & Sunday)</p>
                                                <input name="infant_weekend_price_diff_{{$i}}{{$j}}" id="infant_weekend_price_diff{{$i}}{{$j}}" onkeyup="changeWEndPrice({{$i}},{{$j}},'infant');" value="{{@$price->infant_weekend_price_diff}}" class="form-control" type="text" placeholder="$" onkeypress="return event.charCode >= 46 && event.charCode <= 57">
                                            </div>
                                        </div>
                                        <div class="re-discount">
                                            <div class="discount sp-select">
                                                <label>Any Discount? </label>
                                                <p> (Recommended 10% to 15%)</p>
                                                <input class="form-control" type="text" name="infant_discount_{{$i}}{{$j}}" id="infant_discount{{$i}}{{$j}}" onkeyup="changeDiscount({{$i}},{{$j}},'infant');" value="{{@$price->infant_discount}}"onkeypress="return event.charCode >= 46 && event.charCode <= 57">
                                            </div>
                                        </div>
                                        <div class="single-dash">
                                            <div class="desh sp-select">
                                                <label>-</label>
                                            </div>
                                        </div>
                                        <div class="fit-fees">
                                            <div class="fees sp-select">
                                                <label>Introduction Fee 
													<span type="button" class="tool-tip" data-bs-toggle="tooltip" data-bs-placement="top" title="Lorem Ipsum is simply dummy text of the printing and typesetting industry.">
														<i class="fas fa-info"></i>
													</span>
													<p> {{$fitnessity_fee}}% Amount</p>
												</label>
                                                <label>Recurring Fee 
													<span type="button" class="tool-tip" data-bs-toggle="tooltip" data-bs-placement="top" title="Lorem Ipsum is simply dummy text of the printing and typesetting industry.">
														<i class="fas fa-info"></i>
													</span>
													<p> {{$recurring_fee}}% Amount</p>
												</label>
                                                
                                            </div>
                                        </div>
                                        <div class="single-equal">
                                            <div class="equal sp-select">
                                                <label>=</label>
                                            </div>
                                        </div>
                                        <div class="estimated-earn">
                                            <div class="cus-week-price earn sp-select">
                                                <label>Weekday Estimated Earnings </label>
                                                <input class="form-control" type="text" name="infant_estearn_{{$i}}{{$j}}" id="infant_estearn{{$i}}{{$j}}" value="{{@$price->infant_estearn}}" onkeypress="return event.charCode >= 46 && event.charCode <= 57" placeholder="$" >
                                            </div>
                                        </div>
                                        <div class="estimated-earn Weekend{{$i}}{{$j}} @if(@$price->dispaly_section == 'weekdayprice') d-none @endif">
                                            <div class="cus-week-price earn sp-select">
                                                <label>Weekend Estimated Earnings </label>
                                                <input class="form-control" type="text" name="weekend_infant_estearn_{{$i}}{{$j}}" id="weekend_infant_estearn{{$i}}{{$j}}" value="{{@$price->weekend_infant_estearn}}" onkeypress="return event.charCode >= 46 && event.charCode <= 57" placeholder="$">
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="mb-15 mt-15 checkbox-selection">
                                                <input data-count="0"  type="checkbox" id="is_recurring_infant{{$i}}{{$j}}" name="is_recurring_infant_{{$i}}{{$j}}" @if(@$price->is_recurring_infant == '1') Checked value="1" @else value="0"  @endif  onclick="openmodelbox({{$i}},{{$j}},'infant');" >
                                                <button id="btn_recurring_infant{{$i}}{{$j}}" name="btn_recurring_infant_{{$i}}{{$j}}[]" type="button" data-count="0" class="btn btn-primary recurrint_id d-none" data-bs-toggle="modal" data-bs-target=".edit-infant{{$i}}{{$j}}" onclick="recurrint_id({{$i}},{{$j}},'infant');">Launch demo modal</button>
                                                <label for="infant" id="recurringtxtinfant{{$i}}{{$j}}">Is This A Recurring Payment? Set the payment terms for Infant @if(@$price->is_recurring_infant == '1') {{$infantTxt}}  <a href="" data-bs-toggle="modal" data-bs-target=".edit-infant{{$i}}{{$j}}" class="">Edit</a> ) <div class="delete-recurring" onclick="deleteRecurring('{{$i}}','{{$j}}','infant')"><i class="fas fa-trash-alt"></i></div> @endif </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="serviceprice mt-10">
                            <h3>When Does This Price Setting Expire</h3>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
                        <div class="set-num">
                            <label>Set The Number</label>
                            <input type="text" name="pay_setnum_{{$i}}{{$j}}" id="pay_setnum{{$i}}{{$j}}" class="form-control valid" placeholder="(ex,1,2,3,etc.)" value="{{@$price->pay_setnum != '' ? @$price->pay_setnum : 1}}" onkeypress="return IsNumeric(event);" ondrop="return false;" onpaste="return false;" >
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
                        <div class="set-num">
                            <label>The Duration</label>
                            <select name="pay_setduration_{{$i}}{{$j}}" id="pay_setduration{{$i}}{{$j}}" class="form-control valid">
                                <option {{@$price->pay_setduration =='Days' ?'selected':'' }}>Days</option>
                                <option {{@$price->pay_setduration =='Weeks' ?'selected':'' }}>Weeks</option>
                                <option {{@$price->pay_setduration =='Months' ?'selected':'' }}>Months</option>
                                <option {{@$price->pay_setduration =='Years' ?'selected':'' }}>Years</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-1 col-md-2 col-xs-12">
                        <div class="set-num after">
                            <label>After</label>
                        </div>
                    </div>
                    <div class="col-lg-5 col-md-10 col-xs-12">
                        <div class="after-select">
                            <select name="pay_after_{{$i}}{{$j}}" id="pay_after{{$i}}{{$j}}" class="pay_after form-control valid">
                                <option value="1" {{@$price->pay_after =='1' ?'selected':'' }}>Starts to expire the day of purchase</option>
                                <option value="2" {{@$price->pay_after =='2' ?'selected':'' }}>Starts to expire when the customer first participates in the activity</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade edit-adult{{$i}}{{$j}}" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-70">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="ModelRecurringTitle_adult{{$i}}{{$j}}">Editing Recurring Payments Contract Settings for ({{ @$price->price_title != '' ? @$price->price_title.' for ' : ''}} "Adult")</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-lg-8">
                                <div class="setting-title">
                                    <h3>Settings </h3>
                                </div>
                                <div class="setting-box">
                                    <div class="row">
                                        <div class="col-lg-4 mb-10">
                                            <label class="contractsettings">How often will customers be charged?</label>
                                        </div>
                                        <div class="col-md-2 mb-10">
                                            <span class="every">Every</span>
                                        </div>
                                       
                                        <div class="col-md-3 mb-10">
                                            <input name="customer_charged_num_adult_{{$i}}{{$j}}" id="customer_charged_num_adult_{{$i}}{{$j}}" value="{{@$recurringStrAdult[0] != '' ? @$recurringStrAdult[0] : 1}}" oninput="changeduration({{$i}},{{$j}},'adult','number');" onkeypress="return event.charCode >= 48 && event.charCode <= 57"class="form-control valid" type="text" placeholder="1" >
                                        </div>
                                       
                                        <div class="col-md-3 mb-10">
                                            <select class="form-select" name="customer_charged_time_adult_{{$i}}{{$j}}" id="customer_charged_time_adult_{{$i}}{{$j}}" oninput="changeduration({{$i}},{{$j}},'adult','dropdown');"data-choices="" data-choices-search-false="">
                                                <option value="Week"  {{@$recurringStrAdult[1] == 'Week' ? 'selected' : ''}}>week</option>
                                                <option value="Month"  {{@$recurringStrAdult[1] == 'Month' ? 'selected' : ''}}>Month</option>
                                                <option value="Year"  {{@$recurringStrAdult[1] == 'Year' ? 'selected' : ''}}>Year</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4 mb-10">
                                            <label class="contractsettings">Number of autopays  </label>
                                        </div>
                                        <div class="col-md-8">
                                            <div class="autopays mb-10">
                                                <input type="text" class="form-control valid" name="nuberofautopays_adult_{{$i}}{{$j}}" id="nuberofautopays_adult{{$i}}{{$j}}" placeholder="1" value="{{@$price->recurring_nuberofautopays_adult}}" oninput="getnumberofpmt({{$i}},{{$j}},'adult');">
                                            </div>
                                            <div class="contract mb-10">
                                                <label>  Total duration of contract: </label>
                                                <p id="total_duration_adult{{$i}}{{$j}}"> {{@$price->recurring_nuberofautopays_adult == '' ?  "0 Week" : @$price->recurring_nuberofautopays_adult}} {{@$recurringStrAdult[1]}}  </p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <label class="contractsettings mb-10" id="contractsettings_adult{{$i}}{{$j}}">What happens after 4 payments?</label>
                                        </div>
                                        <div class="col-md-8">
                                            <div class="autopay mb-10">
                                                <input type="radio" id="happens_aftr_12_pmt_adult{{$i}}{{$j}}" name="happens_aftr_12_pmt_adult_{{$i}}{{$j}}" value="contract_expire"{{ (@$price->recurring_happens_aftr_12_pmt_adult == 'contract_expire' || @$price->recurring_happens_aftr_12_pmt_adult != 'contract_renew') ? 'checked' : '' }}>
                                                <label for="contract">Contract Expires</label><br>
                                                <input type="radio" id="happens_aftr_12_pmt_adult{{$i}}{{$j}}" name="happens_aftr_12_pmt_adult_{{$i}}{{$j}}" value="contract_renew" {{@$price->recurring_happens_aftr_12_pmt_adult == 'contract_renew' ? 'checked' : '' }}>
                                                <label for="renews" id="renew_adult{{$i}}{{$j}}">Contract Automaitcally Renews Every  {{@$price->recurring_nuberofautopays_adult != '' ? @$price->recurring_nuberofautopays_adult : 1}} payments</label><br> 
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <label class="contractsettings mb-10">When will clients be charged?</label>
                                        </div>
                                        <div class="col-md-8">
                                            <div class="saledate mb-10">
                                                <select class="form-select" name="client_be_charge_on_adult_{{$i}}{{$j}}" id="client_be_charge_on_adult{{$i}}{{$j}}" data-choices="" data-choices-search-false="">
                                                    <option value="sale date" {{@$price->recurring_client_be_charge_on_adult == 'sale date' ? 'selected' : ''}} >On the sale date </option> 
                                                    <option value="1stday" {{@$price->recurring_client_be_charge_on_adult == '1stday' ? 'selected' : ''}} > 1st Day of the Month</option>
                                                    <option value="15thday" {{@$price->recurring_client_be_charge_on_adult == '15thday' ? 'selected' : ''}} > 15th Day of the Month</option> 
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <label class="contractsettings mb-10">Recurring Price</label>
                                        </div>
                                        <div class="col-md-8">
                                            <input type="text" class="form-control valid mb-10" name="recurring_price_adult_{{$i}}{{$j}}" id="recurring_price_adult{{$i}}{{$j}}" placeholder="1" value="{{@$price->recurring_price_adult == '' ? @$price->adult_cus_weekly_price : @$price->recurring_price_adult}}" oninput="contract_revenue({{$i}},{{$j}},'adult');">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="setting-title mb-10">
                                    <h3>Contract Review </h3>
                                </div>
                                <div class="setting-box">
                                    <div class="set-border">
                                        <div class="row">
                                            <div class="col-md-8">
                                                <p class="font-black" id="p_price_title_adult{{$i}}{{$j}}">{{@$price->price_title}}</p>
                                            </div>
                                            <div class="col-md-4">
                                                <p class="font-black" id="p1_price_adult{{$i}}{{$j}}">${{ @$price->adult_cus_weekly_price != '' ? @$price->adult_cus_weekly_price : 0 }}</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="Settings-title">
                                                <h5> Revenue Breakdown </h5>
                                            </div>
                                        </div>

                                        <div class="col-md-10">
                                            <p class="font-black mbb-5" id="trems_payment_adult{{$i}}{{$j}}">Terms: {{ @$price->recurring_nuberofautopays_adult != '' ? @$price->recurring_nuberofautopays_adult : 0}} {{@$recurringStrAdult[1]}} Payments</p>
                                        </div>

                                        <div class="col-md-8">
                                            <p class="font-black mbb-5">First Payment:</p>
                                        </div>

                                        <div class="col-md-4">
                                            <p class="font-black mbb-5" id="p_first_pmt_adult{{$i}}{{$j}}">${{ @$price->recurring_first_pmt_adult != '' ? @$price->recurring_first_pmt_adult : 0}}</p>
                                        </div>

                                        <input type="hidden" name="first_pmt_adult_{{$i}}{{$j}}" id="first_pmt_adult{{$i}}{{$j}}" value="{{ @$price->recurring_first_pmt_adult != '' ? @$price->recurring_first_pmt_adult : 0}}">
                                        
                                        <input type="hidden" name="recurring_pmt_adult_{{$i}}{{$j}}" id="recurring_pmt_adult{{$i}}{{$j}}" value="{{ @$price->recurring_recurring_pmt_adult != '' ? @$price->recurring_recurring_pmt_adult : 0}}">

                                        <div class="col-md-8">
                                            <p class="font-black mbb-5">Recurring Payment: </p>
                                        </div>

                                        <div class="col-md-4">
                                            <p class="font-black mbb-5" id="p_recurring_pmt_adult{{$i}}{{$j}}">${{ @$price->recurring_recurring_pmt_adult != '' ? @$price->recurring_recurring_pmt_adult : 0}}</p>
                                        </div>

                                        <input type="hidden" name="total_contract_revenue_adult_{{$i}}{{$j}}" id="total_contract_revenue_adult{{$i}}{{$j}}" value="{{ @$price->recurring_total_contract_revenue_adult != '' ? @$price->recurring_total_contract_revenue_adult : 0}}">

                                        <div class="col-md-8">
                                            <label class="font-black mbb-5">Total Contract Revenue:  </label>
                                        </div>

                                        <div class="col-md-4">
                                            <p class="font-black mbb-5" id="p_total_contract_revenue_adult{{$i}}{{$j}}">${{ @$price->recurring_total_contract_revenue_adult != '' ? @$price->recurring_total_contract_revenue_adult : 0}} </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary btn-red" data-bs-dismiss="modal">Submit</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade edit-child{{$i}}{{$j}}" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-70">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="ModelRecurringTitle_child{{$i}}{{$j}}">Editing Recurring Payments Contract Settings for ({{ @$price->price_title != '' ? @$price->price_title.' for ' : ''}} "Children")</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-lg-8">
                                <div class="setting-title">
                                    <h3>Settings </h3>
                                </div>
                                <div class="setting-box">
                                    <div class="row">
                                        <div class="col-lg-4 mb-10">
                                            <label class="contractsettings">How often will customers be charged?</label>
                                        </div>
                                        <div class="col-md-2 mb-10">
                                            <span class="every">Every</span>
                                        </div>
                                        <div class="col-md-3 mb-10">
                                            <input name="customer_charged_num_child_{{$i}}{{$j}}" id="customer_charged_num_child_{{$i}}{{$j}}" value="{{@$recurringStrChild[0] != '' ? @$recurringStrChild[0] : 1}}" oninput="changeduration({{$i}},{{$j}},'child','number');" onkeypress="return event.charCode >= 48 && event.charCode <= 57"class="form-control valid" type="text" placeholder="1" >
                                        </div>
                                        <div class="col-md-3 mb-10">
                                            <select class="form-select" name="customer_charged_time_child_{{$i}}{{$j}}" id="customer_charged_time_child_{{$i}}{{$j}}" oninput="changeduration({{$i}},{{$j}},'child','dropdown');"data-choices="" data-choices-search-false="">
                                                <option value="Week"  {{@$recurringStrChild[1] == 'Week' ? 'selected' : ''}}>week</option>
                                                <option value="Month"  {{@$recurringStrChild[1] == 'Month' ? 'selected' : ''}}>Month</option>
                                                <option value="Year"  {{@$recurringStrChild[1] == 'Year' ? 'selected' : ''}}>Year</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4 mb-10">
                                            <label class="contractsettings">Number of autopays  </label>
                                        </div>
                                        <div class="col-md-8">
                                            <div class="autopays mb-10">
                                                <input type="text" class="form-control valid" name="nuberofautopays_child_{{$i}}{{$j}}" id="nuberofautopays_child{{$i}}{{$j}}" placeholder="1" value="{{@$price->recurring_nuberofautopays_child}}" oninput="getnumberofpmt({{$i}},{{$j}},'child');">
                                            </div>
                                            <div class="contract mb-10">
                                                <label>  Total duration of contract: </label>
                                                <p id="total_duration_child{{$i}}{{$j}}"> {{@$price->recurring_nuberofautopays_child == '' ?  "0 Week" : @$price->recurring_nuberofautopays_child}} {{@$price->customer_charged_time_child}}  </p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <label class="contractsettings mb-10" id="contractsettings_child{{$i}}{{$j}}">What happens after 4 payments?</label>
                                        </div>
                                        <div class="col-md-8">
                                            <div class="autopay mb-10">
                                                <input type="radio" id="happens_aftr_12_pmt_child{{$i}}{{$j}}" name="happens_aftr_12_pmt_child_{{$i}}{{$j}}" value="contract_expire"{{ (@$price->recurring_happens_aftr_12_pmt_child == 'contract_expire' || @$price->recurring_happens_aftr_12_pmt_child != 'contract_renew') ? 'checked' : '' }}>
                                                <label for="contract">Contract Expires</label><br>
                                                <input type="radio" id="happens_aftr_12_pmt_child{{$i}}{{$j}}" name="happens_aftr_12_pmt_child_{{$i}}{{$j}}" value="contract_renew" {{@$price->recurring_happens_aftr_12_pmt_child == 'contract_renew' ? 'checked' : '' }}>
                                                <label for="renews" id="renew_child{{$i}}{{$j}}">Contract Automaitcally Renews Every  {{@$price->recurring_nuberofautopays_child != '' ? @$price->recurring_nuberofautopays_child : 1}} payments</label><br> 
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <label class="contractsettings mb-10">When will clients be charged?</label>
                                        </div>
                                        <div class="col-md-8">
                                            <div class="saledate mb-10">
                                                <select class="form-select" name="client_be_charge_on_child_{{$i}}{{$j}}" id="client_be_charge_on_child{{$i}}{{$j}}" data-choices="" data-choices-search-false="">
                                                    <option value="sale date" {{@$price->recurring_client_be_charge_on_child == 'sale date' ? 'selected' : ''}} >On the sale date </option> 
                                                    <option value="1stday" {{@$price->recurring_client_be_charge_on_child == '1stday' ? 'selected' : ''}} > 1st Day of the Month</option>
                                                    <option value="15thday" {{@$price->recurring_client_be_charge_on_child == '15thday' ? 'selected' : ''}} > 15th Day of the Month</option> 
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <label class="contractsettings mb-10">Recurring Price</label>
                                        </div>
                                        <div class="col-md-8">
                                            <input type="text" class="form-control valid mb-10" name="recurring_price_child_{{$i}}{{$j}}" id="recurring_price_child{{$i}}{{$j}}" placeholder="1" value="{{@$price->recurring_price_child == '' ? @$price->child_cus_weekly_price : @$price->recurring_price_child}}" oninput="contract_revenue({{$i}},{{$j}},'child');">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="setting-title mb-10">
                                    <h3>Contract Review </h3>
                                </div>
                                <div class="setting-box">
                                    <div class="set-border">
                                        <div class="row">
                                            <div class="col-md-8">
                                                <p class="font-black" id="p_price_title_child{{$i}}{{$j}}">{{@$price->price_title}}</p>
                                            </div>
                                            <div class="col-md-4">
                                                <p class="font-black" id="p1_price_child{{$i}}{{$j}}">${{ @$price->child_cus_weekly_price != '' ? @$price->child_cus_weekly_price : 0 }}</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="Settings-title">
                                                <h5> Revenue Breakdown </h5>
                                            </div>
                                        </div>

                                        <div class="col-md-10">
                                            <p class="font-black mbb-5" id="trems_payment_child{{$i}}{{$j}}">Terms: {{ @$price->recurring_nuberofautopays_child != '' ? @$price->recurring_nuberofautopays_child : 0}} {{@$recurringStrChild[1]}} Payments</p>
                                        </div>

                                        <div class="col-md-8">
                                            <p class="font-black mbb-5">First Payment:</p>
                                        </div>

                                        <div class="col-md-4">
                                            <p class="font-black mbb-5" id="p_first_pmt_child{{$i}}{{$j}}">${{ @$price->recurring_first_pmt_child != '' ? @$price->recurring_first_pmt_child : 0}}</p>
                                        </div>

                                        <input type="hidden" name="first_pmt_child_{{$i}}{{$j}}" id="first_pmt_child{{$i}}{{$j}}" value="{{ @$price->recurring_first_pmt_child != '' ? @$price->recurring_first_pmt_child : 0}}">
                                        
                                        <input type="hidden" name="recurring_pmt_child_{{$i}}{{$j}}" id="recurring_pmt_child{{$i}}{{$j}}" value="{{ @$price->recurring_recurring_pmt_child != '' ? @$price->recurring_recurring_pmt_child : 0}}">

                                        <div class="col-md-8">
                                            <p class="font-black mbb-5">Recurring Payment: </p>
                                        </div>

                                        <div class="col-md-4">
                                            <p class="font-black mbb-5" id="p_recurring_pmt_child{{$i}}{{$j}}">${{ @$price->recurring_recurring_pmt_child != '' ? @$price->recurring_recurring_pmt_child : 0}}</p>
                                        </div>

                                        <input type="hidden" name="total_contract_revenue_child_{{$i}}{{$j}}" id="total_contract_revenue_child{{$i}}{{$j}}" value="{{ @$price->recurring_total_contract_revenue_child != '' ? @$price->recurring_total_contract_revenue_child : 0}}">

                                        <div class="col-md-8">
                                            <label class="font-black mbb-5">Total Contract Revenue:  </label>
                                        </div>

                                        <div class="col-md-4">
                                            <p class="font-black mbb-5" id="p_total_contract_revenue_child{{$i}}{{$j}}">${{ @$price->recurring_total_contract_revenue_child != '' ? @$price->recurring_total_contract_revenue_child : 0}} </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary btn-red" data-bs-dismiss="modal">Submit</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade edit-infant{{$i}}{{$j}}" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-70">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="ModelRecurringTitle_infant{{$i}}{{$j}}">Editing Recurring Payments Contract Settings for ({{ @$price->price_title != '' ? @$price->price_title.' for ' : ''}} "Infant")</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-lg-8">
                                <div class="setting-title">
                                    <h3>Settings </h3>
                                </div>
                                <div class="setting-box">
                                    <div class="row">
                                        <div class="col-lg-4 mb-10">
                                            <label class="contractsettings">How often will customers be charged?</label>
                                        </div>
                                        <div class="col-md-2 mb-10">
                                            <span class="every">Every</span>
                                        </div>
                                        <div class="col-md-3 mb-10">
                                            <input name="customer_charged_num_infant_{{$i}}{{$j}}" id="customer_charged_num_infant_{{$i}}{{$j}}" value="{{@$recurringStrAdult[0] != '' ? @$recurringStrAdult[0] : 1}}" oninput="changeduration({{$i}},{{$j}},'infant','number');" onkeypress="return event.charCode >= 48 && event.charCode <= 57"class="form-control valid" type="text" placeholder="1" >
                                        </div>
                                        <div class="col-md-3 mb-10">
                                            <select class="form-select" name="customer_charged_time_infant_{{$i}}{{$j}}" id="customer_charged_time_infant_{{$i}}{{$j}}" oninput="changeduration({{$i}},{{$j}},'infant','dropdown');"data-choices="" data-choices-search-false="">
                                                <option value="Week"  {{@$recurringStrAdult[1] == 'Week' ? 'selected' : ''}}>week</option>
                                                <option value="Month"  {{@$recurringStrAdult[1] == 'Month' ? 'selected' : ''}}>Month</option>
                                                <option value="Year"  {{@$recurringStrAdult[1] == 'Year' ? 'selected' : ''}}>Year</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4 mb-10">
                                            <label class="contractsettings">Number of autopays  </label>
                                        </div>
                                        <div class="col-md-8">
                                            <div class="autopays mb-10">
                                                <input type="text" class="form-control valid" name="nuberofautopays_infant_{{$i}}{{$j}}" id="nuberofautopays_infant{{$i}}{{$j}}" placeholder="1" value="{{@$price->recurring_nuberofautopays_infant}}" oninput="getnumberofpmt({{$i}},{{$j}},'infant');">
                                            </div>
                                            <div class="contract mb-10">
                                                <label>  Total duration of contract: </label>
                                                <p id="total_duration_infant{{$i}}{{$j}}"> {{@$price->recurring_nuberofautopays_infant == '' ?  "0 Week" : @$price->recurring_nuberofautopays_infant}} {{@$recurringStrAdult[1]}}  </p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <label class="contractsettings mb-10" id="contractsettings_infant{{$i}}{{$j}}">What happens after 4 payments?</label>
                                        </div>
                                        <div class="col-md-8">
                                            <div class="autopay mb-10">
                                                <input type="radio" id="happens_aftr_12_pmt_infant{{$i}}{{$j}}" name="happens_aftr_12_pmt_infant_{{$i}}{{$j}}" value="contract_expire"{{ (@$price->recurring_happens_aftr_12_pmt_infant == 'contract_expire' || @$price->recurring_happens_aftr_12_pmt_infant != 'contract_renew') ? 'checked' : '' }}>
                                                <label for="contract">Contract Expires</label><br>
                                                <input type="radio" id="happens_aftr_12_pmt_infant{{$i}}{{$j}}" name="happens_aftr_12_pmt_infant_{{$i}}{{$j}}" value="contract_renew" {{@$price->recurring_happens_aftr_12_pmt_infant == 'contract_renew' ? 'checked' : '' }}>
                                                <label for="renews" id="renew_infant{{$i}}{{$j}}">Contract Automaitcally Renews Every  {{@$price->recurring_nuberofautopays_infant != '' ? @$price->recurring_nuberofautopays_infant : 1}} payments</label><br> 
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <label class="contractsettings mb-10">When will clients be charged?</label>
                                        </div>
                                        <div class="col-md-8">
                                            <div class="saledate mb-10">
                                                <select class="form-select" name="client_be_charge_on_infant_{{$i}}{{$j}}" id="client_be_charge_on_infant{{$i}}{{$j}}" data-choices="" data-choices-search-false="">
                                                    <option value="sale date" {{@$price->recurring_client_be_charge_on_infant == 'sale date' ? 'selected' : ''}} >On the sale date </option> 
                                                    <option value="1stday" {{@$price->recurring_client_be_charge_on_infant == '1stday' ? 'selected' : ''}} > 1st Day of the Month</option>
                                                    <option value="15thday" {{@$price->recurring_client_be_charge_on_infant == '15thday' ? 'selected' : ''}} > 15th Day of the Month</option> 
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <label class="contractsettings mb-10">Recurring Price</label>
                                        </div>
                                        <div class="col-md-8">
                                            <input type="text" class="form-control valid mb-10" name="recurring_price_infant_{{$i}}{{$j}}" id="recurring_price_infant{{$i}}{{$j}}" placeholder="1" value="{{@$price->recurring_price_infant == '' ? @$price->infant_cus_weekly_price : @$price->recurring_price_infant}}" oninput="contract_revenue({{$i}},{{$j}},'infant');">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="setting-title mb-10">
                                    <h3>Contract Review </h3>
                                </div>
                                <div class="setting-box">
                                    <div class="set-border">
                                        <div class="row">
                                            <div class="col-md-8">
                                                <p class="font-black" id="p_price_title_infant{{$i}}{{$j}}">{{@$price->price_title}}</p>
                                            </div>
                                            <div class="col-md-4">
                                                <p class="font-black" id="p1_price_infant{{$i}}{{$j}}">${{ @$price->infant_cus_weekly_price != '' ? @$price->infant_cus_weekly_price : 0 }}</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="Settings-title">
                                                <h5> Revenue Breakdown </h5>
                                            </div>
                                        </div>

                                        <div class="col-md-10">
                                            <p class="font-black mbb-5" id="trems_payment_infant{{$i}}{{$j}}">Terms: {{ @$price->recurring_nuberofautopays_infant != '' ? @$price->recurring_nuberofautopays_infant : 0}} {{@$recurringStrAdult[1]}} Payments</p>
                                        </div>

                                        <div class="col-md-8">
                                            <p class="font-black mbb-5">First Payment:</p>
                                        </div>

                                        <div class="col-md-4">
                                            <p class="font-black mbb-5" id="p_first_pmt_infant{{$i}}{{$j}}">${{ @$price->recurring_first_pmt_infant != '' ? @$price->recurring_first_pmt_infant : 0}}</p>
                                        </div>

                                        <input type="hidden" name="first_pmt_infant_{{$i}}{{$j}}" id="first_pmt_infant{{$i}}{{$j}}" value="{{ @$price->recurring_first_pmt_infant != '' ? @$price->recurring_first_pmt_infant : 0}}">
                                        
                                        <input type="hidden" name="recurring_pmt_infant_{{$i}}{{$j}}" id="recurring_pmt_infant{{$i}}{{$j}}" value="{{ @$price->recurring_recurring_pmt_infant != '' ? @$price->recurring_recurring_pmt_infant : 0}}">

                                        <div class="col-md-8">
                                            <p class="font-black mbb-5">Recurring Payment: </p>
                                        </div>

                                        <div class="col-md-4">
                                            <p class="font-black mbb-5" id="p_recurring_pmt_infant{{$i}}{{$j}}">${{ @$price->recurring_recurring_pmt_infant != '' ? @$price->recurring_recurring_pmt_infant : 0}}</p>
                                        </div>

                                        <input type="hidden" name="total_contract_revenue_infant_{{$i}}{{$j}}" id="total_contract_revenue_infant{{$i}}{{$j}}" value="{{ @$price->recurring_total_contract_revenue_infant != '' ? @$price->recurring_total_contract_revenue_infant : 0}}">

                                        <div class="col-md-8">
                                            <label class="font-black mbb-5">Total Contract Revenue:  </label>
                                        </div>

                                        <div class="col-md-4">
                                            <p class="font-black mbb-5" id="p_total_contract_revenue_infant{{$i}}{{$j}}">${{ @$price->recurring_total_contract_revenue_infant != '' ? @$price->recurring_total_contract_revenue_infant : 0}} </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary btn-red" data-bs-dismiss="modal">Submit</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

