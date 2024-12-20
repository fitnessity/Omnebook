<div class="row">
	<div class="col-md-5">
		<div class="pro-name">
			<label>{{$business_activity_scheduler->business_service->program_name}}</label>
		</div>
		<div class="row">
			<div class="col-md-6">
				<span class="mb-3">{{@$business_activity_scheduler->businessPriceDetailsAges != '' ? $business_activity_scheduler->businessPriceDetailsAges->category_title : "N/A" }}</span>
			</div>
			<div class="col-md-6">
				<div class="mb-3">
					<span>{{$filter_date->format('l, F j, Y')}}</span>
				</div>
			</div>
		</div>
	</div>
	<div class="col-md-7">
		<div class="row">
			<div class="col-md-4 col-sm-4 col-6">
				<div class="gry-box d-grid side-box mb-3">
					<label>Time</label>
					<span>{{date('h:i A', strtotime($business_activity_scheduler->shift_start))}}  - {{date('h:i A', strtotime($business_activity_scheduler->shift_end))}}</span>
				</div>
			</div>
			<div class="col-md-4 col-sm-4 col-6">
				<div class="gry-box d-grid side-box mb-3">
					<label>Duration</label>
					<span>{{$business_activity_scheduler->get_clean_duration()}} </span>
				</div>
			</div>
			<div class="col-md-4 col-sm-4 col-6">
				<div class="gry-box d-grid side-box mb-3">
					<label>Spots</label>
					<span>{{$business_activity_scheduler->spots_left($filter_date)}}/{{$business_activity_scheduler->spots_available}} </span>
				</div>
			</div>
		</div>
	</div>
	<div class="col-md-4 col-sm-4 col-12">	
		<div class="mb-3 select-staff-member">
			<select name="activity_type" class="form-select" id="" onchange="changeInstructor(this.value)">
				<option value="">Select Staff Member</option>
				@foreach($staffMember as $sm)
					<option value="{{$sm->id}}" @if($instructor_id == $sm->id) selected @endif>{{$sm->full_name}}</option>
				@endforeach
			</select>
		</div>
	</div>
	<div class="col-md-8 col-sm-8 col-12">	
		<div class="float-right mb-3">
			<div class="search-set manage-search manage-space">
				<div class="client-search">
					<div class="position-relative">
						<input type="text" id="search_postorder_client" name="fname" placeholder="Search for client" autocomplete="off" value="" class="form-control" data-customer-id = "">
                      
						<!-- <input type="text" class="form-control ui-autocomplete-input" placeholder="Search for client" autocomplete="off" id="search_postorder_client" value=""> -->
						<span class="mdi mdi-magnify search-widget-icon"></span>
						<span class="mdi mdi-close-circle search-widget-icon search-widget-icon-close d-none" id="search-close-options"></span>
					</div>
					<div class="dropdown-menu dropdown-menu-lg" id="search-dropdown"></div>
				</div>
			</div>
			<div class="btn-client-search">
				<a class="btn-red-primary btn-red mmt-10 addCustomer" data-business-activity-scheduler-id="{{$business_activity_scheduler->id}}" data-behavior="add_client_to_booking_post_order">Add </a>
			</div>
		</div>
	</div>
	
	<div class="col-md-12">	
		<div class="booking-add-client">
			<div class="table-responsive dots">
				<table>
				  	<tr>
						<th>No</th>
						<th>Client</th>
						<th>Options</th>
						<th>Check In</th>
						<th>Remaining </th>
						<th>Expiration</th>
						<th>Alerts</th>
						<th></th>
					</tr>

					@foreach($booking_checkin_details as $i=>$booking_checkin_detail)
						<tr>
							<td>{{$i+1}}</td>
							<td>
								<div class="mini-stats-wid d-flex align-items-center width-185">
									<div class="avatar-sm mr-15">
										@if($booking_checkin_detail->customer->profile_pic)
											<img class='mini-stat-icon avatar-title rounded-circle text-success bg-soft-red fs-4' src="{{Storage::Url($booking_checkin_detail->customer->profile_pic)}}" width=60 height=60 alt="">
										@else
											<div class="mini-stat-icon avatar-title rounded-circle text-success bg-soft-red fs-4 uppercase">
												<span> {{$booking_checkin_detail->customer->first_letter}} </span>
											</div>
										@endif
									</div>
									<h6 class="mb-1">{{$booking_checkin_detail->customer->full_name}}</h6>
								</div>
							</td>
							<td>
								<select class="form-select valid price-info mmt-10 width-105" data-behavior="change_price_title" data-booking-checkin-detail-id="{{$booking_checkin_detail->id}}">
									<option value="" @if(!$booking_checkin_detail->order_detail) selected @endif>Choose option</option>
									@foreach($booking_checkin_detail->cus->active_memberships($business_activity_scheduler->business_service->id)->get() as $customer_booking_detail)
                         				@if($customer_booking_detail->business_price_detail)
                             				@if($customer_booking_detail->getremainingsession() > 0 || ($booking_checkin_detail->order_detail && $customer_booking_detail->id == $booking_checkin_detail->order_detail->id))
                                                <option value="{{$customer_booking_detail->id}}" @if($booking_checkin_detail->order_detail && ($customer_booking_detail->id == $booking_checkin_detail->order_detail->id)) selected @endif>
                                                     {{$customer_booking_detail->business_price_detail->price_title}}
                                                </option>
                             				@endif
                         				@endif
                     				@endforeach
								</select>
							</td>
							<td>
								<div class="check-cancel width-105">
									@if($booking_checkin_detail->order_detail && $booking_checkin_detail->checkin_date <= date('Y-m-d') ) 
										@php  
											$datetime = new DateTime($booking_checkin_detail->checkin_date.' '.$business_activity_scheduler->shift_start);
											$formattedDatetime = $datetime->format('Y-m-d H:i:s');
										@endphp
										<input type="checkbox" name="check_in" value="1" data-behvaior="checkin"data-booking-checkin-detail-id="{{$booking_checkin_detail->id}}"data-booking-detail-id="{{$booking_checkin_detail->booking_detail_id}}"  data-booking-detail-date="{{$formattedDatetime}}"			@if($booking_checkin_detail->checked_at != '' ) checked @endif  > 
									@endif 
									<label for="checkin" class="mb-0 mmt-10">Check In</label><br>

									@if($booking_checkin_detail->order_detail && $booking_checkin_detail->checkin_date == date('Y-m-d'))
					                    <input type="checkbox"  onclick="call()" name="late_cancel" value="0" data-behavior="ajax_html_modal" data-url="{{route('business.scheduler_checkin_details.latecencel_modal', ['id' => $booking_checkin_detail->id, 'scheduler_id' => $business_activity_scheduler->id])}}"  data-modal-width = "500px" data-booking-detail-id="{{$booking_checkin_detail->order_detail->id}}"
					                        @if($booking_checkin_detail->no_show_action) checked @endif >
					                @endif 
									<label for="cancel" class="mb-0 mmt-10"> Late Cancel</label><br>
								</div>
							</td>
							<td>
								<div>
									<p class="mb-0">{{ $booking_checkin_detail->order_detail !='' ? $booking_checkin_detail->order_detail->getremainingSessionAfterCheckIn()."/".$booking_checkin_detail->order_detail->pay_session : "N/A"}}</p>
								</div>
							</td>
							<td>{{$booking_checkin_detail->order_detail != '' ? Carbon\Carbon::parse($booking_checkin_detail->order_detail->expired_at)->format('m/d/Y') : "N/A"}}</td>
							<td>{!! $booking_checkin_detail->customer->chkSignedTerms() !!} {!!$booking_checkin_detail->customer->chkBirthday() !!} {!! $booking_checkin_detail->customer->findExpiredCC() !!} {!! $booking_checkin_detail->customer->chkRecurringPayment($booking_checkin_detail->booking_detail_id) !!}</td>
							<td>
								<div class="multiple-options">
									<div class="setting-icon">
										<i class="ri-more-fill"></i>
										<ul>
											<li><a href="{{route('business.orders.create',['cus_id' => $booking_checkin_detail->customer_id])}}"><i class="fas fa-plus text-muted"></i>Purchase</a></li>
											<li><a href="{{route('business_customer_show',['business_id' => request()->current_company->id, 'id'=> $booking_checkin_detail->customer_id])}}" target="_blank" ><i class="fas fa-plus text-muted"></i>View Account</a></li>
											<li>
												<a href="#" data-behavior="delete_checkin_detail" data-booking-checkin-detail-id="{{$booking_checkin_detail->id}}"><i class="ri-delete-bin-fill align-bottom me-2 text-muted"></i>Delete</a>
											</li>
										</ul>
									</div>
								</div>
							</td>
						</tr>
					@endforeach

				  	@if(count($booking_checkin_details) == 0 )
						<tr>
							<td colspan="8"> 
								<div class="no0signup text-center">
									<img src="{{url('/dashboard-design/images/sports-set.jpg')}}">
									<h3>No one is signed up. Add them to this activity</h3>
								</div>
							</td>
						</tr>
					@endif
				</table>
			</div>
		</div>
	</div>
</div>

<script type="text/javascript">
	$(document).ready(function () {
        var business_id = '{{request()->current_company->id}}';
        var url = "{{ url('/business/business_id/customers') }}";
        url = url.replace('business_id', business_id);

        $( "#search_postorder_client" ).autocomplete({
            source: url,
            focus: function( event, ui ) {
                 return false;
            },
            select: function( event, ui ) {
                $("#search_postorder_client").val( ui.item.fname + ' ' +  ui.item.lname);
                $('#search_postorder_client').data('customer-id', ui.item.id)
                 return false;
            }
        }).data( "ui-autocomplete" )._renderItem = function( ul, item ) {
            let profile_img = '<div class="collapse-img"><div class="company-list-text" style="height: 50px;width: 50px;"><p style="padding: 0;">A</p></div></div>';

            if(item.profile_pic_url){
                profile_img = '<img class="searchbox-img" src="' + (item.profile_pic_url ? item.profile_pic_url : '') + '" style="">';            
            }

            var inner_html = '<div class="row rowclass-controller"></div><div class="row"> <div class="col-md-3 nopadding text-center">' + profile_img + '</div><div class="col-md-9 div-controller">' + 
                      '<p class="pstyle"><label class="liaddress">' + item.fname + ' ' +  item.lname  + (item.age ? ' (' + item.age+ '  Years Old)' : '') + '</label></p>' +
                      '<p class="pstyle liaddress">' + item.email +'</p>' + 
                      '<p class="pstyle liaddress">' + item.phone_number + '</p></div></div>';
           
            return $( "<li></li>" )
                    .data( "item.autocomplete", item )
                    .append(inner_html)
                    .appendTo( ul );
        };
    });

	function changeInstructor(value){
		date = "{{$filter_date->format('Y-m-d')}}";
		today = "{{$today}}";
		if(today == date){
			$.ajax({
				url: "/business/{{request()->current_company->id}}/schedulers/{{$business_activity_scheduler->id}}/checkin_details/change_instructor",
		        method: "POST",
		        data: { 
		            _token: '{{csrf_token()}}',  
		            date: date, 
		            insID: value, 
		        },
		        success: function(html){
		        	getCheckInDetails('{{$business_activity_scheduler->id}}','{{$filter_date}}');
		            //location.reload();
		        }
			})
		}else{
			alert("You can't change instructor at this time.");
		}
	}

	$('[data-behavior~=delete_checkin_detail]').click(function(e){
	    e.preventDefault()
    	$.ajax({
	        url: "/business/{{request()->current_company->id}}/schedulers/{{$business_activity_scheduler->id}}/checkin_details/" + $(this).data('booking-checkin-detail-id'),
	        method: "DELETE",
	        data: { 
	            _token: '{{csrf_token()}}', 
	        },
	        success: function(html){
	        	getCheckInDetails('{{$business_activity_scheduler->id}}','{{$filter_date}}');
	            //location.reload();
	        }
    	})
	});

	$('[data-behavior~=add_client_to_booking_post_order]').click(function(e){
	    e.preventDefault()
    	if(!$('#search_postorder_client').data('customer-id')){
	        $('#search_postorder_client').focus();
	        return
    	}

       	$.ajax({
            url: "/business/{{request()->current_company->id}}/schedulers/{{$business_activity_scheduler->id}}/checkin_details",
            method: "POST",
            data: { 
                _token: '{{csrf_token()}}', 
                customer_id: $('#search_postorder_client').data('customer-id'),
                checkin_date: "{{$filter_date->format('Y/m/d')}}"
            },
            success: function(html){
                //location.reload();
                getCheckInDetails('{{$business_activity_scheduler->id}}','{{$filter_date}}');
        	}
    	})
	});

    $(document).on('change', "[data-behvaior~=checkin]", function(e){
        checkbox = this
     	if(!$(this).data('booking-detail-id')){
            this.checked = false;
            alert('Need to choose price title first.');
            e.preventDefault()
            e.stopPropagation();
            return false
    	}
     	
     	var date = $(this).data('booking-detail-date');
     	$.ajax({
            url: "/business/{{request()->current_company->id}}/schedulers/{{$business_activity_scheduler->id}}/checkin_details/" + $(this).data('booking-checkin-detail-id'),
            type: "PATCH",
            data:{
                _token: '{{csrf_token()}}', 
                checked_at: $(this).is(':checked') ? date : null,
            },
            success:function(response) {
            	getCheckInDetails('{{$business_activity_scheduler->id}}','{{$filter_date}}');
                //location.reload()
            },
            error: function(){
                checkbox.checked = false;
                e.preventDefault()
                e.stopPropagation();
            }
        });
    });

    $(document).on('change', "[data-behavior~=change_price_title]", function(){
        $.ajax({
            url: "/business/{{request()->current_company->id}}/schedulers/{{$business_activity_scheduler->id}}/checkin_details/" + $(this).data('booking-checkin-detail-id'),
            type: "PATCH",
            data:{
                _token: '{{csrf_token()}}', 
                booking_detail_id: $(this).val()
            },
            success:function(response) {
                location.reload()
            },
       	});
    });

    function call() {
    	$('.checkinDetails').modal('hide');
    }

</script>