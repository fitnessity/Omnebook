<div class="modal fade compare-model" id="bookclienttraining" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
    <div class="modal-dialog book-client-training modal-dialog-centered modal-70">
        <div class="modal-content">
            <div class="modal-header">
				<h5 class="modal-title" id="myModalLabel">Schedule A Client</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
            <!-- Modal body -->
            <div class="modal-body">
                <div class="row"> 
                    <div class="col-lg-12">
                        <p class="text-center font-15">Book a client for training</p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-6 col-md-6 mmb-10 side-border-right-red">
                       <div class="calendar-title-modal"> <label class="font-red">Step 1: </label> <label>Select or Add a New Client</label> </div>
                        <div class="row">
                            <div class="col-lg-12">
                                <label>Search for customer</label>
                                <div class="search-customer mb-10">
                                    <input type="text" id="serchclient" name="fname" class=""   placeholder="Search for client who is making a purchase?" autocomplete="off" >

                                    <button id="serchbtn"><i class="fa fa-search"></i></button>
                                   
                                </div>
                            </div>
							 <div class="col-lg-12">
                                <label class="form-label">Notes</label>
                                <textarea class="form-control" id="booking-notes" placeholder="Enter your note" rows="3"></textarea>
                             </div>
                        </div>
                    </div>

                    <div class="col-lg-6 col-md-6 mmb-10">
                        <div class="">
                            <div class="calendar-title-modal"><label class="font-red">Step 2: </label> <label> Plan Your Session</label> </div>
                            <div class="program-selection mb-10">
                                <label>Select Program</label>
                                <select name="program_list" id="program_list" class="form-select valid" onchange="loaddropdown('program',this,this.value);">
                                    <option value="">Select Program</option>
                                    @if(!empty(@$program_list))
                                        @foreach($program_list as $pl)
                                            <option value="{{$pl->id}}">{{$pl->program_name}}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                                
                            <div class="program-selection mb-10">
                                <label>Select Catagory </label>
                                <select name="category_list" id="category_list" class="form-select valid" onchange="loaddropdown('category',this,this.value);">
                                    <option value="">Select Catagory</option>
                                </select>
                            </div>
                            
                            <div class="program-selection mb-10">
                                <label>Select Price Option </label>
                                <select name="priceopt_list" id="priceopt_list" class="form-select" onchange="loaddropdown('priceopt',this,this.value);">
                                    <option value="">Select Price</option>
                                </select>
                            </div>

                            <div class="program-selection mb-10 d-inline-grid">
                                <label>Select Participants</label>
                                <button type="button" data-bs-toggle="modal" data-bs-target="#addpartcipate" class="btn btn-red search-add-client"> Select </button>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="program-selection mb-10">
                                        <label>Price</label>
                                        <input type="text" class="form-control valid" name="price" id="price" placeholder="$" title="" >
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="program-selection mb-10">
                                        <label>Session</label>
                                        <input type="text" class="form-control valid" name="p_session" id="p_session" placeholder="$" title="" >
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="program-selection mb-10">
                                        <label>Memberhsip Option</label>
                                        <input type="text" class="form-control valid" id="mp_name" readonly>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="program-selection mb-10">
                                        <label>Date</label>
                                        <div class="input-group">
											<input type="text" class="form-control border-0 flatpiker-with-border flatpickr-input active sessionDate" id="managecalendarservice">
										</div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="program-selection mb-10">
                                        <label>Duration</label>
                                        <div class="duration-min">
                                            <input type="text" class="form-control valid mr-10" name="duration_int" id="duration_int" placeholder="1" value="1" onkeyup="changevalue();" onkeypress="return ( event.charCode == 46 || (event.charCode >= 48 && event.charCode <= 57 ))">
                                            <select name="duration_dropdown" id="duration_dropdown" class="form-select valid" onchange="loaddropdown('duration',this,this.value);">
                                                <option value="Days">Day(s) </option>
                                                <option value="Weeks">Week(s)</option>
                                                <option value="Months">Month(s) </option>
                                                <option value="Years">Year(s) </option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
							
							<div class="row">
								<div class="col-lg-12">
									<label>Repeat</label>
									<div class="repeat mb-10">
										<group>
											<div class="input-container">
                                                <input type="radio" name="booking-repeateTimeType" checked value="off"><label>Off</label>      
											</div>
											<div class="input-container">
                                                <input type="radio" name="booking-repeateTimeType" value="daily"><label>Daily</label>      
											</div>
											<div class="input-container">
                                                <input type="radio" name="booking-repeateTimeType" value="week"><label>Weekly</label>
											</div>
											<div class="input-container">
                                                <input type="radio" name="booking-repeateTimeType" value="month"><label>Monthly</label>     
											</div>
											<div class="input-container">
                                                <input type="radio" name="booking-repeateTimeType" value="year"><label>Yearly</label>  
											</div>											
										</group>
									</div>
								</div>

								<div class="col-lg-12 daily d-none hideall">
									<div class="mb-10">
										<label> End Date: </label>
										<div class="input-group">
											<input type="text" class="form-control border-0 flatpickr-range flatpickr-input active" value="" readonly="readonly" id="repeat_endDate1" >
										</div>
									</div>
								</div>

								<div class="col-lg-12 weeks d-none hideall">
									<div class="row">
										<div class="col-lg-6">
											<div class="mb-10">
												<label> Every Weeks: </label>
												<div class="number">
													<span class="minus">-</span>
													<input type="text" value="1" id="booking-everyWeeks"/>
													<span class="plus">+</span>
												</div>
											</div>
										</div>
										<div class="col-lg-6">
											<div class="mb-10">
												<label> End Date: </label>
												<div class="input-group">
													<input type="text" class="form-control border-0 flatpickr-range flatpiker-with-border flatpickr-input active" value="" readonly="readonly" id="repeat_endDate2">
												</div>
											</div>
										</div>
									</div>
                                    
									<div class="mb-10 weekDays">
                                        
										<label> Days: </label>
										<span class="btn-grp" id="divButtonGroup" data-bgval="2">
										  <button type="button" value="Sunday" id="Sunday" class="add-day">SU</button>
										  <button type="button" value="Monday" id="Monday" class="add-day">MO</button>
										  <button type="button" value="Tusesday" id="Tusesday" class="add-day">TU</button>
										  <button type="button" value="Wednesday" id="Wednesday" class="add-day">WE</button>
										  <button type="button" value="Thrusday" id="Thrusday" class="add-day">TH</button>
										  <button type="button" value="Friday" id="Friday" class="add-day">FR</button>
										  <button type="button" value="Saturday" id="Saturday" class="add-day">SA</button>
										</span>
									</div>
								</div>

								<div class="col-lg-12 month d-none hideall">
									<div class="row">
										<div class="col-lg-6">
											<div class="mb-10">
												<label> Days: </label>
												<div class="number">
													<span class="minus">-</span>
													<input type="text" value="1" id="booking-monthDays" />
													<span class="plus">+</span>
												</div>
											</div>
										</div>
										<div class="col-lg-6">
											<div class="mb-10">
												<label> End Date: </label>
												<div class="input-group">
													<input type="text" class="form-control border-0 flatpickr-range flatpiker-with-border flatpickr-input active" value="" readonly="readonly" id="repeat_endDate3">
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
                            
                            <!-- <div class="program-selection mb-10 select-favorite">
                                <label class="width-100">How Often Will this happen? </label>
                                <input type="radio" id="onedaybooking" name="to_book_type" value="oneday" checked>
                                <label class="onedaybooking" for="html">One Day Booking</label>
                                <input type="radio" id="onedaybooking" name="to_book_type" value="repeat">
                                <label class="onedaybooking" for="css">Repeat This Booking</label>
                            </div> -->

                            <div class="row mt-10">
                                <div class="col-md-6"> 
                                    <div class="tax-check">
                                        <label>Tax </label>
                                        <input type="checkbox" id="tax" name="tax" value="1" onclick="tax();">
                                        <label for="tax"> No Tax</label><br>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                      <span id="taxvalspan">$0</span>
                                </div>
                                <input type="hidden" name="duestax" id="duestax" value="">
                                <input type="hidden" name="salestax" id="salestax" value="">
                            </div>
                        </div>
                    </div>
				</div>
            </div>
			<div class="modal-footer">
				<button class="btn btn-red mb-00 pay-btn" type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">Cancel</button>
                <form id="addToCart">
                    @csrf
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <input type="hidden" name="chk" value="calendar_activity_purchase">
                    <input type="hidden" name="value_tax" id="value_tax" value="0">
                    <input type="hidden" name="type" value="customer">
                    <input type="hidden" name="pageid" id="pageid" value="">
                    <input type="hidden" name="pid" id="pid" value="">
                    <input type="hidden" name="categoryid" id="categoryid" value="">
                    <input type="hidden" name="checkount_qty" id="checkount_qty" value="">
                    <input type="hidden" name="pay_session" id="pay_session" value="">
                    <input type="hidden" name="aduquantity" id="adupricequantity" value="" />
                    <input type="hidden" name="childquantity" id="childpricequantity" value="" />
                    <input type="hidden" name="infantquantity" id="infantpricequantity" value="" />

                    <input type="hidden" name="cartaduprice" id="cartaduprice" value="" />
                    <input type="hidden" name="cartchildprice" id="cartchildprice" value="" />
                    <input type="hidden" name="cartinfantprice" id="cartinfantprice" value="" />

                    <input type="hidden" name="priceid" value="" id="priceid">
                    <input type="hidden" name="actscheduleid" value="1 Day(s)" id="actscheduleid">
                    <input type="hidden" name="sesdate" value="{{date('Y-m-d')}}" id="sesdate">
                    <input type="hidden" name="pricetotal" id="pricetotal" value="">
                    <input type="hidden" name="tip_amt_val" id="tip_amt_val" value="0" >
                    <input type="hidden" name="dis_amt_val" id="dis_amt_val" value="0" >
                    <input type="hidden" name="pc_regi_id" id="pc_regi_id" value="" >
                    <input type="hidden" name="pc_user_tp" id="pc_user_tp" value="customer">
                    <input type="hidden" name="pc_value" id="pc_value" value="" >
                    <input type="hidden" name="activity_days" id="activity_days" value="">
                    <input type="hidden" name="notes" id="notes" value="">
                    <input type="hidden" name="enddate" id="enddate" value="">
                    <input type="hidden" name="repeateTimeType" id="repeateTimeType" value="">
                    <input type="hidden" name="everyWeeks" id="everyWeeks" value="">
                    <input type="hidden" name="monthDays" id="monthDays" value="">
                    <button type="button" class="btn btn-black mb-00 pay-btn" id="doPayment" disabled="" onclick="addToCart();">Payment</button>
                </form>
			</div>
        </div>
    </div>
</div>


<div class="modal fade" role="dialog" id="addpartcipate" tabindex="-1" >
    <div class="modal-dialog counter-modal-size">
        <div class="modal-content">
            <div class="modal-header p-3">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" id="close-modal"></button>
            </div>  
            <div class="modal-body conuter-body" id="Countermodalbody">
                <div class="row">
                    <div class="col-lg-12">
                        <h4 class="modal-title mb-25 partcipate-model">Select The Number of Participants</h4>
                    </div>
                    <div id="pricediv">
                    </div>
                </div>
            </div>            
            <div class="modal-footer conuter-body">
                <button type="button" onclick="saveparticipate();" class="btn btn-red rev-submit-btn">Save</button>
            </div>
        </div>          
    </div>                                          
</div>

<button  id="paymentModal" class="d-none" data-behavior="ajax_html_modal" data-url="" data-modal-width="modal-70"></button>

<script>
    $(document).ready(function () {
        var business_id = '{{$companyId}}';
        var url = "{{ url('/business/business_id/customers') }}";
        url = url.replace('business_id', business_id);
        $( "#serchclient" ).autocomplete({
            source: url,
            focus: function( event, ui ) {
                 return false;
            },
            select: function( event, ui ) {
                $('#serchclient').val( ui.item.fname + ' ' +  ui.item.lname);
                $('#pc_value').val( ui.item.fname + ' ' +  ui.item.lname);
                $('#pageid').val( ui.item.id);
                $('#pc_regi_id').val( ui.item.id);
                $('#doPayment').prop('disabled', false); 
                return false;
            }
        }).data( "ui-autocomplete" )._renderItem = function( ul, item ) {
            let profile_img = '<div class="collapse-img"><div class="company-list-text" style="height: 50px;width: 50px;"><p style="padding: 0;">' + item.fname.charAt(0).toUpperCase() + '</p></div></div> ';

            if(item.profile_pic_url){
                profile_img = '<img class="searchbox-img" src="' + (item.profile_pic_url ? item.profile_pic_url : '') + '" style="">';            
            }

            var inner_html = '<div class="row rowclass-controller"></div><div class="row"><div class="col-md-3 nopadding text-center">' + profile_img + '</div><div class="col-md-9 div-controller">' + 
                      '<p class="pstyle"><label class="liaddress">' + item.fname + ' ' +  item.lname  + (item.age ? ' (' + item.age+ '  Years Old)' : '') + '</label></p>' +
                      '<p class="pstyle liaddress">' + item.email +'</p>' + 
                      '<p class="pstyle liaddress">' + item.phone_number + '</p></div></div>';
           
            return $( "<li></li>" )
                    .data( "item.autocomplete", item )
                    .append(inner_html)
                    .appendTo( ul );
        };

        $('#adultcnt').prop('readonly', true);
        $(document).on('click','.adultplus',function(){
            $('#adultcnt').val(parseInt($('#adultcnt').val()) + 1 );
        });
        $(document).on('click','.adultminus',function(){
            $('#adultcnt').val(parseInt($('#adultcnt').val()) - 1 );
            if ($('#adultcnt').val() <= 0) {
                $('#adultcnt').val(0);
            }
        });

        $('#childcnt').prop('readonly', true);
        $(document).on('click','.childplus',function(){
            $('#childcnt').val(parseInt($('#childcnt').val()) + 1 );
        });
        $(document).on('click','.childminus',function(){
            $('#childcnt').val(parseInt($('#childcnt').val()) - 1 );
            if ($('#childcnt').val() <= 0) {
                $('#childcnt').val(0);
            }
        }); 

        $('#infantcnt').prop('disabled', true);

        $(document).on('click','.infantplus',function(){
            $('#infantcnt').val(parseInt($('#infantcnt').val()) + 1 );
        });

        $(document).on('click','.infantminus',function(){
            $('#infantcnt').val(parseInt($('#infantcnt').val()) - 1 );
            if ($('#infantcnt').val() <= 0) {
                $('#infantcnt').val(0);
            }
        });

        $('.minus').click(function () {
            var $input = $(this).parent().find('input');
            var count = parseInt($input.val()) - 1;
            count = count < 1 ? 1 : count;
            $input.val(count);
            $input.change();
            return false;
        });
        $('.plus').click(function () {
            var $input = $(this).parent().find('input');
            $input.val(parseInt($input.val()) + 1);
            $input.change();
            return false;
        });

        $('body').delegate('.add-day','click',function(){  
            if($(this).hasClass("btn-sel")){
                $(this).removeClass('btn-sel');
            }
            else{
                $(this).addClass('btn-sel');
            }
        }); 

        $("body").on("click", ".weekDays", function(){
            activity_days = "";     
            $(this).find(".btn-grp").each( function() {
                $.each( $(this).find('.add-day'), function( key, value ) {
                    if ($(this).hasClass('btn-sel')) {         
                      activity_days += $(this).val() + ",";
                    }  
                });
            });
            
            $('#activity_days').val(activity_days);
        });

    });   

    function addToCart(){
        if($('#pageid').val() != ''){
            $.ajax({
                type: "POST",
                url: '{{route("addtocart")}}',
                data: $("#addToCart").serialize(),
                success: function(data) {
                    if(data != ''){
                        $('#bookclienttraining').modal('hide');
                        $('#paymentModal').data('url',data);
                        $('#paymentModal').click();
                    }
                }
            });
        }
        
    }

    function tax(){
        var tax = salestax= duestax= 0;
        salestax = $('#salestax').val();
        duestax = $('#duestax').val();
        salestax = (salestax == '') ? 0 : salestax;
        duestax = (duestax == '') ? 0 : duestax;

        var price = parseInt($('#price').val());
    
        if($("#tax").is(":checked")){
            tax = 0;
        }else{
            if(duestax != 0){
                tax += (price*duestax)/100;
            }
            if(salestax != 0){
                tax += (price*salestax)/100;
            }
        }
        $('#value_tax').val(tax);
        $('#taxvalspan').html('$'+tax)
        totalPrice = price + tax; 
        $('#pricetotal').val(totalPrice);
    }

    function changevalue(){
        $('#duration').html($('#duration_int').val() +' '+ $('#duration_dropdown').val());
        $('#actscheduleid').val($('#duration_int').val() +' '+ $('#duration_dropdown').val());
    }

    /*function changedate(chk,id){
        $('#'+chk).val($('#'+id).val());
    }*/

    function saveparticipate(){
        $('#qty').html('');
        var aducnt = $('#adultcnt').val();
        var chilcnt = $('#childcnt').val();
        var infcnt = $('#infantcnt').val();
        aducnt = typeof(aducnt) == 'undefined' ? 0: aducnt;
        chilcnt = typeof(chilcnt) == 'undefined' ? 0: chilcnt;
        infcnt = typeof(infcnt) == 'undefined' ? 0: infcnt;
        
        var adult = child = infant = '';
        var totalprice = totalpriceadult = totalpricechild = totalpriceinfant = 0; 

        var aduprice = $('#adultprice').val();
        var childprice = $('#childprice').val();
        var infantprice = $('#infantprice').val();
        var pay_session = $('#session_val').val();
    
        if(typeof(aduprice) != "undefined" && aduprice != null && aduprice != ''){
            totalpriceadult = parseInt(aducnt)*parseInt(aduprice);
            $('#adupricequantity').val(aducnt);
        }

        if(typeof(childprice) != "undefined" && childprice != null && childprice != ''){
            totalpricechild = parseInt(chilcnt)*parseInt(childprice);
            $('#childpricequantity').val(chilcnt);
        }
        if(typeof(infantprice) != "undefined" && infantprice != null && infantprice != ''){
            totalpriceinfant = parseInt(infcnt)*parseInt(infantprice);
            $('#infantpricequantity').val(infcnt);
        }
    
        $('#cartaduprice').val(aduprice);
        $('#cartinfantprice').val(infantprice);
        $('#cartchildprice').val(childprice);

        totalprice = parseInt(totalpriceadult)+parseInt(totalpricechild)+parseInt(totalpriceinfant);
    
        $('#price').val(totalprice);
        $('#p_session').val(pay_session);
        $('#session_span').html(pay_session);
        $('#pay_session').val(pay_session);
        tax();
        $("#addpartcipate").modal('hide');
        $("#addpartcipate").removeClass('show');
        $("#bookclienttraining").modal('show');
    }

    function loaddropdown(chk,val,id){
        var selectedText = val.options[val.selectedIndex].innerHTML;
        if(chk == 'program'){
            $('#pid').val(id);
            $('#p_name').html(selectedText);
            $('#category_list').html('');
            $('#priceopt_list').html('');
            $('#membership_opt_list').html('');
        }
        if(chk == 'category'){
            $('#c_name').html(selectedText);
            $('#priceopt_list').html('');
            $('#membership_opt_list').html('');
            $('#categoryid').val(id);
        }
        if(chk == 'priceopt'){
            $('#priceid').val(id);
            $('#pt_name').html(selectedText);
            $('#membership_opt_list').html('');
        }
    
        if(chk == 'duration'){
            $('#duration').html($('#duration_int').val() +' '+ selectedText);
            $('#actscheduleid').val($('#duration_int').val() +' '+ id);
        }
        
        $.ajax({
            url: '{{route("getdropdowndata")}}',
            type: 'get',
            data:  {
                'sid':id,
                'chk':chk,
                'type':'simple',
                'user_type':'{{Auth::user()->user_type}}',
                'page':'calendar',
            },
            success:function(data){
                if(chk == 'program'){
                    $('#category_list').html(data);
                }
                if(chk == 'category'){
                    var data1 = data.split('~~');
                    $('#priceopt_list').html(data1[0]);

                    var splittax =  data1[1].split('^^');
                    $('#duestax').val(splittax[0]);
                    $('#salestax').val(splittax[1]);

                }
                if(chk == 'priceopt'){
                    var data1 = data.split('~~');
                    $('#mp_name').val(data1[0]);
                    var part = data1[1].split('^^');
                    $('#pricediv').html(part[0]);
                    $('#pricediv1').html(part[0]);
                    var second = part[1].split('!!');
                    $('#duration_int').val(second[0]);
                    $('#duration_dropdown').val(second[1]);
                    $('#duration').html(second[0]+ ' ' +second[1]);
                    $('#actscheduleid').val(second[0]+ ' ' +second[1]);
                }
                
                if(chk != 'participat' && chk != 'mpopt' && chk != 'duration'){
                    $('#adultcnt').val(0);
                    $('#childcnt').val(0);
                    $('#infantcnt').val(0);
                    $('#price').val(0);
                }
            }
        });
    }

</script>

<script>
    $('.data').hide()
    jQuery('button').on('click',function(){
      jQuery('.data').toggle();
    })

    flatpickr('.flatpickr-range',{
        dateFormat: "m/d/Y",
        maxDate: "01/01/2050",
        minDate: "today",
        defaultDate: "today",
        onChange: function(selectedDates, dateStr, instance) {
            let date = moment(dateStr).format("YYYY-MM-DD");
            $("#enddate").val( date);
        }
    });

    flatpickr('.sessionDate',{
        dateFormat: "m/d/Y",
        maxDate: "01/01/2050",
        minDate: "today",
        defaultDate: "today",
        onChange: function(selectedDates, dateStr, instance) {
            let date = moment(dateStr).format("YYYY-MM-DD");
            $("#sesdate").val( date);
        }
    });

    $('input[type=radio][name=booking-repeateTimeType]').change(function(){
        $('.hideall').addClass('d-none');
        if (this.value == 'daily') {
            $('.daily').removeClass('d-none');
        }

        if (this.value == 'week') {
            $('.weeks ').removeClass('d-none');
        }

        if (this.value == 'month') {
            $('.month ').removeClass('d-none');
        }
        $('#repeateTimeType').val(this.value);
    });

    $('#booking-notes').keyup(function() {
        $('#notes').val($(this).val());
    });

    $('#booking-monthDays').change(function(){
        $('#monthDays').val($(this).val());
    });

    $('#booking-everyWeeks').change(function(){
        $('#everyWeeks').val($(this).val());
    });
</script>