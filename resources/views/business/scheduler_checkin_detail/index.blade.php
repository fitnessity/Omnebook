@extends('layouts.header')
@section('content')
@include('layouts.userHeader')

<div class="p-0 col-md-12 inner_top padding-0">
    <div class="row">
        <div class="col-md-2 col-sm-12" style="background: black;">
             @include('business.businessSidebar')
        </div>
        <div class="col-md-10 col-sm-12">
            <div class="container-fluid p-0">
                <div class="row">
                    <div class="col-md-6 col-xs-12 col-sm-12">
                        <div class="tab-hed scheduler-txt"><span class="font-red">Activity Scheduler </span> | <a href="{{route('booking_request')}}">Booking Request </a></div>
                    </div>
                    <div class="col-md-6 col-xs-12 col-sm-12">
                        @include('customers._search_header', ['company_id' => request()->current_company->id])
                    </div>
                </div>
                <hr style="border: 3px solid black; width: 123%; margin-left: -38px; margin-top: 5px;">
              </div>
              <div class="container-fluid plr-0">
                <div class="row">
                    <div class="col-md-4 col-xs-12 col-sm-5">
                         <div class="scheduler-info">
                            <label>Program Name: </label>
                            <span>{{$business_activity_scheduler->business_service->program_name}} <br/></span>
                         </div>
                         <div class="scheduler-info">
                            <label>Category: </label>
                            <span>{{$business_activity_scheduler->businessPriceDetailsAges->category_title}}</span>
                         </div>
                         
                         <div class="scheduler-info">
                            <label>Date: </label><span>{{$filter_date->format('l, F j , Y')}} </span>
                         </div>
                         <div class="scheduler-info">
                            <label>Time: </label><span>{{date('h:i A', strtotime($business_activity_scheduler->shift_start))}}  - {{date('h:i A', strtotime($business_activity_scheduler->shift_end))}}</span>
                         </div>
                         <div class="scheduler-info">
                            <label>Duration:  </label><span>{{$business_activity_scheduler->get_clean_duration()}} </span>
                         </div>
                         <div class="scheduler-info">
                            <label>Spots: </label><span>{{$business_activity_scheduler->spots_left($filter_date)}}/{{$business_activity_scheduler->spots_available}} </span>
                         </div>
                    </div>
                    <div class="col-md-3 col-sm-12 col-sm-6">
                        <div class="row">
                            <div class="col-md-10 col-sm-12 col-sm-6">
                                <div class="manage-search manage-space">
                                    <div class="sub">
                                        <input type="text" id="search_postorder_client" name="fname" placeholder="Search for client" autocomplete="off" value="{{Request::get('fname')}}">
                                        <div id="serch_postorder_client_box" style="display:none;">
                                            <ul class="customer-list">
                                            </ul>
                                        </div>

                                        <button ><i class="fa fa-search"></i></button>
                                    </div>
                                    
                                </div>
                            </div>
                            <div class="col-md-2 col-sm-12 col-sm-6">
                                <a style="margin-top: 73px;" class="btn-nxt manage-cus-btn" href="#" data-business-activity-scheduler-id="{{$business_activity_scheduler->id}}"  data-behavior="add_client_to_booking_post_order">Add</a>
                            </div>
                        </div>

                    </div>
                </div>
                
                <hr style="border: 1px solid #efefef; width: 115%; margin-left: -15px; margin-top: 5px;">
                @if(session('success'))
                 <span class="alert alert-success" role="alert" style=" padding: 6px;">
                     <strong>{{ session('success') }}</strong>
                 </span>
                @endif
                <div class="row">
                    <div class="col-md-12">
                        <div class="row mobile-scheduler">
                            <div class="col-md-1">
                                <div class="scheduler-table-title">
                                    <label>  </label>
                                </div>
                            </div>
                            <div class="col-md-1">
                                <div class="scheduler-table-title">
                                    <label></label>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="scheduler-table-title">
                                    <label>Client Name  </label>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="scheduler-table-title">
                                    <label> Price Title  </label>
                                </div>
                            </div>
                            <div class="col-md-1">
                                <div class="scheduler-table-title">
                                    <label>  Remaining   </label>
                                </div>
                            </div>
                            <div class="col-md-1">
                                <div class="scheduler-table-title">
                                    <label> Expiration</label>
                                </div>
                            </div>
                            <div class="col-md-1">
                            </div>
                        </div>
                        
                        <div id="schedulelist">
                            
                            @foreach($booking_checkin_details as $booking_checkin_detail)

                                <div class="scheduler-info-box">
                                    <div class="row">
                                        <div class="col-md-1 col-xs-12 col-sm-4">
                                            <div class="scheduler-border scheduler-label">
                                                <a href="#" data-behavior="delete_checkin_detail" data-booking-checkin-detail-id="{{$booking_checkin_detail->id}}" ><i class="fas fa-times"></i></a>
                                            </div>
                                        </div>
                                        
                                        <div class="col-md-1 col-xs-3 col-sm-4">    
                                            @if($booking_checkin_detail->customer->profile_pic)
                                                <img class='img-circle' src="{{Storage::Url($booking_checkin_detail->customer->profile_pic)}}" width=60 height=60 alt="">
                                            @else
                                                <div class="scheduler-qty">
                                                    <span> 
                                                        {{$booking_checkin_detail->customer->first_letter}}
                                                    </span>
                                                </div>
                                            @endif
                                            
                                        </div>
                                        <div class="col-md-2 col-xs-9 col-sm-4">
                                            <div class="scheduled-activity-info">
                                                <span>{{$booking_checkin_detail->customer->full_name}}</span>
                                            </div>
                                        </div>
                                        <div class="col-md-2 col-xs-12 col-sm-4">
                                            <div class="scheduled-activity-info">
                                                <div class="price-mobileview">
                                                    <select class="form-control valid price-info" data-behavior="change_price_title" data-booking-checkin-detail-id="{{$booking_checkin_detail->id}}">
                                                        <option value=""  @if(!$booking_checkin_detail->order_detail) selected @endif>Choose option</option>
                                                        @foreach($booking_checkin_detail->customer->active_booking_details()->get() as $customer_booking_detail)
                                                            @if($customer_booking_detail->business_price_detail)
                                                            <option value="{{$customer_booking_detail->id}}" @if($booking_checkin_detail->order_detail && ($customer_booking_detail->id == $booking_checkin_detail->order_detail->id)) selected @endif>
                                                                {{$customer_booking_detail->business_price_detail->price_title}}
                                                            </option>
                                                            @endif
                                                        @endforeach
                                                        

                                                    </select>
                                                    @if($booking_checkin_detail->customer->active_memberships() < 1)
                                                        <span style="color:red;text-align:left;">No Active memberships</span>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-1 col-xs-12 col-sm-4">
                                            <div class="scheduled-location">
                                                @if($booking_checkin_detail->order_detail)
                                                    {{$booking_checkin_detail->order_detail->getremainingsession()}}/{{$booking_checkin_detail
                                                        ->order_detail->pay_session}}
                                                @else
                                                    N/A
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-md-1 col-xs-12 col-sm-4">
                                            <div class="scheduled-location">
                                                @if($booking_checkin_detail->order_detail)
                                                    {{Carbon\Carbon::parse($booking_checkin_detail->order_detail->expired_at)->format('m/d/Y')}}
                                                @else
                                                    N/A
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-md-2 col-xs-12 col-sm-4">

                                                <div class="checkbox-check">
                                                    <label style="font-weight: inherit;">
                                                    @if($booking_checkin_detail->order_detail)
                                                        <input type="checkbox" name="check_in" value="1"
                                                            data-behvaior="checkin"
                                                            data-booking-checkin-detail-id="{{$booking_checkin_detail->id}}"  
                                                            data-booking-detail-id="{{$booking_checkin_detail->booking_detail_id}}"
                                                            @if($booking_checkin_detail->checked_at) checked @endif >
                                                        
                                                    @endif
                                                     Check In</label><br>
                                                    <label style="font-weight: inherit;">
                                                    @if($booking_checkin_detail->order_detail)
                                                        <input type="checkbox" name="late_cancel" value="0" data-behavior="ajax_html_modal" data-url="{{route('business.scheduler_checkin_details.latecencel_modal', ['id' => $booking_checkin_detail->id, 'scheduler_id' => $business_activity_scheduler->id])}}" data-booking-detail-id="{{$booking_checkin_detail->order_detail->id}}"
                                                        @if($booking_checkin_detail->no_show_action) checked @endif 
                                                        >
                                                    @endif
                                                    Late Cancel</label>
                                                </div>
                                        </div>

                                        <div class="col-md-2 col-xs-12 col-sm-12">
                                            <div class="scheduled-btns">
                                                <a href="{{route('business.orders.create',['cus_id' => $booking_checkin_detail->customer_id])}}" class="btn-edit btn-sp">Purchase</a>
                                                <a href="{{route('business_customer_show',['business_id' => request()->current_company->id, 'id'=> $booking_checkin_detail->customer_id])}}" class="btn-edit" target="_blank">View Account</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>              
            </div>  
        </div>
    </div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
@include('layouts.footer')

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

    $(document).on('keyup', '#search_postorder_client', function() {
      $.ajax({
          type: "GET",
          url: "{{route("business_customer_index", ['business_id' => request()->current_company->id])}}",
          data: { fname: $(this).val(),  _token: '{{csrf_token()}}', },
          success: function(data) {
            $("#serch_postorder_client_box .customer-list").html('');
            console.log(data);
            
            $.each(data, function(index, customer){
            let customer_row = $('<div class="row rowclass-controller"></div>');
              let content = customer_row.find('.rowclass-controller');
              let profile_img = '<div class="collapse-img"><div class="company-list-text" style="height: 50px;width: 50px;"><p style="padding: 0;">A</p></div></div>';

              if(customer.profile_pic_url){
                profile_img = '<img class="img-circle" src="' + (customer.profile_pic_url ? customer.profile_pic_url : '') + '" style="width: 50px;height: 50px">';            
              }
              customer_row.append('<div class="col-md-3">' + profile_img + '</div>');
              customer_row.append('<div class="col-md-9 div-controller"><a data-customer-id="' + customer.id + '" data-name="'+customer.fname + ' ' +  customer.lname+'" class="click_to_input" style="color: black;" href="/business/' + {{request()->current_company->id}} +'/customers/'+ customer.id + '">' + 
                  '<p class="pstyle"><label class="liaddress">' + customer.fname + ' ' +  customer.lname  + (customer.age ? ' (' + customer.age+ '  Years Old)' : '') + '</label></p>' +
                  '<p class="pstyle liaddress">' + customer.email +'</p>' + 
                  '<p class="pstyle liaddress">' + customer.phone_number + '</p></a></div>');

              $("#serch_postorder_client_box .customer-list").append(customer_row);
              
            })

            
            $("#serch_postorder_client_box").show();
          }
      });
    });

    $(document).on('click', '.click_to_input', function(e){
        e.preventDefault()
        e.stopPropagation()
        $('#search_postorder_client').val($(this).data('name'))
        $('#search_postorder_client').data('customer-id', $(this).data('customer-id'))
        $("#serch_postorder_client_box").hide();
        $("#serch_postorder_client_box .customer-list").html('');
        $("[data-behavior~=add_client_to_booking_post_order]").show();
        
    })


    // $(document).on('change', 'input[data-behavior="show_latecancel"]', function(){
    //     if($(this).is(':checked')){
    //         $.ajax({
    //                 url:"/getbookingcancelmodel",
    //                 type: "POST",
    //                 data:{
    //                         _token: '{{csrf_token()}}', 
    //                         booking_detail_id:$(this).attr("booking-detail-id"),
    //                 },
    //                 success:function(response) {
    //                         $('.latecancle-types').html(response);
    //                         $('#latecancel').modal('show');
    //                 }
    //         });
    //         $('#booking_id').val($(this).attr("data-oid"));
    //         $('#order_detail_id').val($(this).attr("data-bookingid"));
            
    //     }
    // });

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