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
			<select name="activity_type" class="form-select" id="" data-choices="" data-choices-search-false="">
				<option value="">Select Staff Member</option>
				<option value="">Option 2</option>
				<option value="">Option 3</option>
				<option value="">Option 4</option>
				<option value="">Option 5</option>
			</select>
		</div>
	</div>
	<div class="col-md-8 col-sm-8 col-12">	
		<div class="float-right mb-3">
			<div class="search-set manage-search manage-space">
				<div class="client-search">
					<div class="position-relative">
						<input type="text" class="form-control ui-autocomplete-input" placeholder="Search for client" autocomplete="off" id="search_postorder_client" value="">
						<span class="mdi mdi-magnify search-widget-icon"></span>
						<span class="mdi mdi-close-circle search-widget-icon search-widget-icon-close d-none" id="search-close-options"></span>
					</div>
					<div class="dropdown-menu dropdown-menu-lg" id="search-dropdown"></div>
				</div>
			</div>
			<div class="btn-client-search">
				<a class="btn-red-primary btn-red mmt-10" data-business-activity-scheduler-id="1101" data-behavior="add_client_to_booking_post_order">Add </a>
				<!--<a class="btn-red-primary btn-red mmt-10" href="#" data-bs-toggle="modal" data-bs-target=".add_client">Add </a>-->
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
									@foreach($booking_checkin_detail->customer->active_memberships()->get() as $customer_booking_detail)
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
									@if($booking_checkin_detail->order_detail && $booking_checkin_detail->checkin_date == date('Y-m-d') ) 
										<input type="checkbox" name="check_in" value="1" data-behvaior="checkin"data-booking-checkin-detail-id="{{$booking_checkin_detail->id}}"data-booking-detail-id="{{$booking_checkin_detail->booking_detail_id}}" 			@if($booking_checkin_detail->checked_at != '' ) checked @endif  > 
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
							<td>expired CC</td>
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
									<img src="http://dev.fitnessity.co/public/dashboard-design/images/sports-set.jpg">
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

	$(document).on('click', '[data-behavior~=delete_checkin_detail]', function(e){
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
	})

	$(document).on('click', '[data-behavior~=add_client_to_booking_post_order]', function(e){
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
                location.reload();
        	}
    	})
	})

	$(document).on('click', 'body', function(){
      $("#serch_postorder_client_box .customer-list").html('');
      $("#serch_postorder_client_box").hide();
   	})

	$(document).on('click', '.click_to_input', function(e){
        e.preventDefault()
        e.stopPropagation()
        $('#search_postorder_client').val($(this).data('name'))
        $('#search_postorder_client').data('customer-id', $(this).data('customer-id'))
        $("#serch_postorder_client_box").hide();
        $("#serch_postorder_client_box .customer-list").html('');
        $("[data-behavior~=add_client_to_booking_post_order]").show();
    })

    $(document).on('change', "[data-behvaior~=checkin]", function(e){
        checkbox = this
     	if(!$(this).data('booking-detail-id')){
            this.checked = false;
            alert('Need to choose price title first.');
            e.preventDefault()
            e.stopPropagation();
            return false
    	}
     
     	$.ajax({
            url: "/business/{{request()->current_company->id}}/schedulers/{{$business_activity_scheduler->id}}/checkin_details/" + $(this).data('booking-checkin-detail-id'),
            type: "PATCH",
            data:{
                _token: '{{csrf_token()}}', 
                checked_at: $(this).is(':checked') ? moment().format('YYYY-MM-DD[T]HH:mm:ss') : null,
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