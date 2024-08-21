@inject('request', 'Illuminate\Http\Request')
@extends('layouts.business.header')

@section('content')

	@include('layouts.business.business_topbar')
	<!-- ============================================================== -->
    <!-- Start right Content here -->
    <!-- ============================================================== -->
    <div class="main-content">
		<div class="page-content">
         	<div class="container-fluid">
            	<div class="row">
               		<div class="col">
                  		<div class="h-100">
                     		<div class="row mb-3">
								<div class="col-12">
									<div class="page-heading">
										<label>Activity Scheduler</label>
									</div>
								</div>
							</div>
					
							<div class="row">
								<div class="col-md-12">
									<div class="card">
										<div class="card-header border-0">
											<div class="row">
												<div class="col-xxl-6 col-lg-6 col-md-5 col-sm-5">
													<div class="scheduler-info">
														<label>Program Name: </label>
														<span> {{$business_activity_scheduler->business_service->program_name}}<br></span>
													</div>
													<div class="scheduler-info">
														<label>Category: </label>
														<span>{{@$business_activity_scheduler->businessPriceDetailsAges != '' ? $business_activity_scheduler->businessPriceDetailsAges->category_title : "N/A" }}</span>
													</div>
													<div class="scheduler-info">
														<label>Date: </label>
														<span> {{$filter_date->format('l, F j , Y')}}</span>
													 </div>
													 <div class="scheduler-info">
														<label>Time: </label>
														<span>{{date('h:i A', strtotime($business_activity_scheduler->shift_start))}}  - {{date('h:i A', strtotime($business_activity_scheduler->shift_end))}}</span>
													 </div>
													 <div class="scheduler-info">
														<label>Duration:  </label>
														<span> {{$business_activity_scheduler->get_clean_duration()}} </span>
													 </div>
													 <div class="scheduler-info">
														<label>Spots: </label>
														<span> {{$business_activity_scheduler->spots_left($filter_date)}}/{{$business_activity_scheduler->spots_available}} </span>
													 </div>
												</div>

												<div class="col-xxl-6 col-lg-6 col-md-7 col-sm-7">
													<div class="float-right">
														<div class="search-set manage-search manage-space">
															<div class="client-search">
																<div class="position-relative">
																	<input type="text" class="form-control" placeholder="Search for client" autocomplete="off" id="search_postorder_client" value="{{Request::get('fname')}}">
																	<span class="mdi mdi-magnify search-widget-icon"></span>
																	<span class="mdi mdi-close-circle search-widget-icon search-widget-icon-close d-none" id="search-close-options"></span>
																</div>
																<div class="dropdown-menu dropdown-menu-lg" id="search-dropdown"></div>
															</div>
														</div>
														<div class="btn-client-search">
															<a class="btn-red-primary btn-red mmt-10"  data-business-activity-scheduler-id="{{$business_activity_scheduler->id}}"  data-behavior="add_client_to_booking_post_order">Add </a>
															<!--<a class="btn-red-primary btn-red mmt-10" href="#" data-bs-toggle="modal" data-bs-target=".add_client">Add </a>-->
														</div>
													</div>
												</div>
											</div>
										</div>
										<div class="card-body pt-0 card-350-body">
											@foreach($booking_checkin_details as $i=>$booking_checkin_detail)
												<div class="container schedulers-container">
													<div class="row mini-stats-wid d-flex align-items-center mt-3 scheduler-box re-box">
														<div class="col-lg-2 col-md-1 col-sm-2 col-3">
															<div class="avatar-sm ">
																@if($booking_checkin_detail->customer->profile_pic)
																	<img class='mini-stat-icon avatar-title rounded-circle text-success bg-soft-red fs-4' src="{{Storage::Url($booking_checkin_detail->customer->profile_pic)}}" width=60 height=60 alt="">
																@else
																	<div class="mini-stat-icon avatar-title rounded-circle text-success bg-soft-red fs-4 uppercase">
																		<span> {{$booking_checkin_detail->customer->first_letter}} </span>
																	</div>
																@endif
															</div>
														</div>
														<div class="col-lg-2 col-md-2 col-sm-2 col-9">
															<h6 class="mb-1">{{$booking_checkin_detail->customer->full_name}}</h6>
														</div>
														<div class="col-lg-3 col-md-3 col-sm-2 col-12">
															<select class="form-select valid price-info mmt-10" data-behavior="change_price_title" data-booking-checkin-detail-id="{{$booking_checkin_detail->id}}">
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
														</div>
														<div class="col-lg-2 col-md-3 col-sm-3 col-6">
															<p class="mb-0 mmt-10">  @if($booking_checkin_detail->order_detail && $booking_checkin_detail->checkin_date == date('Y-m-d') ) <input type="checkbox" name="check_in" value="1" data-behvaior="checkin"data-booking-checkin-detail-id="{{$booking_checkin_detail->id}}"data-booking-detail-id="{{$booking_checkin_detail->booking_detail_id}}" @if($booking_checkin_detail->checked_at != '' ) checked @endif  > @endif  Check In</p>

															<p class="mb-0 mmt-10"> @if($booking_checkin_detail->order_detail && $booking_checkin_detail->checkin_date == date('Y-m-d'))
					                                        <input type="checkbox" name="late_cancel" value="0" data-behavior="ajax_html_modal" data-url="{{route('business.scheduler_checkin_details.latecencel_modal', ['id' => $booking_checkin_detail->id, 'scheduler_id' => $business_activity_scheduler->id])}}"  data-modal-width = "500px" data-booking-detail-id="{{$booking_checkin_detail->order_detail->id}}"
					                                        @if($booking_checkin_detail->no_show_action) checked @endif >@endif Late Cancel</p>
														</div>

														<div class="col-lg-2 col-md-2 col-sm-2 col-4">
															<h6 class="text-center mmt-10">Session Remaining</h6>
															<p class="mb-0 text-center">{{ $booking_checkin_detail->order_detail !='' ? $booking_checkin_detail->order_detail->getremainingSessionAfterCheckIn()."/".$booking_checkin_detail->order_detail->pay_session : "N/A"}}</p>
														</div>

														<div class="col-lg-1 col-md-1 col-sm-1 col-2">
															<a class="float-end mmt-10" href="#" data-bs-toggle="modal" data-bs-target=".checking-details{{$i}}"><i class="ri-more-fill"></i></a>
														</div>
													</div>
												</div>

												<div class="modal fade checking-details{{$i}}" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
													<div class="modal-dialog modal-dialog-centered width-50 bsw-35">
														<div class="modal-content">
															<div class="modal-header">
																<h5 class="modal-title" id="myModalLabel">Activity Scheduler</h5>
																	<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
															</div>
															<div class="modal-body">
																<div class="scheduler-table">
																	<div class="table-responsive">
																		<table class="table mb-0">
																			<thead>
																				<tr>
																					<th>Expiration</th>
																					<th></th>
																					<th></th>
																				</tr>
																			</thead>
																			<tbody>
																				<tr>
																					<td>
																						<p class="mb-0">{{$booking_checkin_detail->order_detail != '' ? Carbon\Carbon::parse($booking_checkin_detail->order_detail->expired_at)->format('m/d/Y') : "N/A"}}</p>
																					</td>
																					<td>
																						<div class="scheduled-btns">
																							<a href="{{route('business.orders.create',['cus_id' => $booking_checkin_detail->customer_id])}}" class="btn btn-red mb-10">Purchase</a>
																							<a href="{{route('business_customer_show',['business_id' => request()->current_company->id, 'id'=> $booking_checkin_detail->customer_id])}}"target="_blank" class="btn btn-black mb-10">View Account</a>
																						</div>
																					</td>
																					<td>
																						<div class="scheduled-btns">
																						 	<a href="#" data-behavior="delete_checkin_detail" data-booking-checkin-detail-id="{{$booking_checkin_detail->id}}"  class="btn btn-red">Delete</a>
																						</div>
																					</td>
																				</tr>
																			</tbody>
																		</table>
																	</div>
																</div>
															</div>
														</div><!-- /.modal-content -->
													</div><!-- /.modal-dialog -->
												</div>
											@endforeach
										</div>
									</div>
								</div>
							</div>
						</div> <!-- end .h-100-->
               		</div> <!-- end col -->
            	</div>
         	</div><!-- container-fluid -->
      	</div><!-- End Page-content -->
   </div><!-- end main content-->
</div><!-- END layout-wrapper -->
    

	
	
	@include('layouts.business.footer')
	<script>
		flatpickr(".flatpickr-range", {
	        dateFormat: "m/d/Y",
	        maxDate: "01/01/2050",
			defaultDate: [new Date()],
	     });
	</script>
	
	<script>
    
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
                $("[data-behavior~=add_client_to_booking_post_order]").show();
                 return false;
            }
        	}).data( "ui-autocomplete" )._renderItem = function( ul, item ) {
            let profile_img = '<div class="collapse-img"><div class="company-list-text" style="height: 50px;width: 50px;"><p style="padding: 0;">' + item.fname + '</p></div></div>';

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
    	});
	</script>
	
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
                location.reload();
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
	                location.reload()
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

   </script>


@endsection