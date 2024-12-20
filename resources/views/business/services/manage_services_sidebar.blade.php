<div class="main-content">
    <div id="service_wrapper" class="clinet-page-content toggled ">
        <!-- Sidebar -->
        <div id="service-sidebar-wrapper">
            <ul class="navbar-nav s-sidebar-nav s-sidebar-top-bottom" id="navbar-nav">
                <li class="menu-title menu-title-service text-center"><span class="fs-13" data-key="t-menu">Services</span></li>
                @if(!empty($services))
                @foreach($services as $service)
                @php $profilePic = $service->first_profile_pic();
                $categories = $service->businessPriceDetailsAges; @endphp
                <li class="nav-item">
                    {{-- <a class="nav-link menu-link" href="#"> --}}
                        <div class="row">
                            <div class="col-lg-10 col-md-10 col-10">
                                <a class=" menu-link" href="{{route('business.show_service_details', ['id' => $service->id])}}">
                                <div class="service-nw-user-details s-service-space">
                                    <p class="texttr">{{$service->program_name}} ({{$service->sport_activity}}) <b>
                                            {{ ($service->is_active==1) ? "Active" : "Inactive"}} </b></p>
                                    <p class="texttr">
                                        <b>{{ ($service->service_type=='individual') ? 'Personal Training' : $service->service_type }}</b>
                                    </p>
                                </div>
                                </a>
                            </div>
                            <div class="col-lg-2 col-md-2 col-2">
                                <div class="float-end three-dots-btn">
                                    <button href="#" data-bs-toggle="modal"
                                        data-bs-target=".moreoptions{{$service->id}}"> <i class="ri-more-fill"></i>
                                    </button>

                                </div>
                            </div>
                        </div>
                    {{-- </a> --}}
                </li>

                <div class="modal fade edit-schedule{{$service->id}}" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-70">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="myModalLabel">Select the category you would like to schedule for {{$service->program_name}}</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="modal-inner-txt">
                                    <h4>Category</h4>
                                </div>
                                <div class="modal-inner-txt border-modal-data">
                                    @if(!empty($categories) && count($categories) >0)
                                        @foreach($categories as $i=>$category)
                                            @php
                                                $schedules = App\BusinessActivityScheduler::where('serviceid',$service->id)->where('cid',$service->cid)->where('category_id', $category->id);

                                                $time = 'Not Scheduled';
                                                if($schedules->first() != ''){ 
                                                    $time = $schedules->first()->get_clean_duration();
                                                } 
                                            @endphp
                                            <div class="row mb-25">
                                                <div class="col-lg-4 col-md-3 col-sm-5 col-xs-12 black-separator">
                                                    <span class="font-13">{{$i+1}}. {{$category->category_title}}</span>
                                                </div>
                                                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12 black-separator">
                                                    <span class="font-13">{{$time}}</span>
                                                </div>
                                                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12 black-separator">
                                                    <span class="font-13"> {{$schedules->count()}} TIMESLOTS SCHEDULED</span>
                                                </div>
                                                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12"> 
                                                    <span> <a href="{{route('business.schedulers.create', ['business_id'=>$category->cid,'categoryId'=>$category->id,'session'=> $service->id ]) }}">+ EDIT SCHEDULE</a></span>
                                                </div>
                                            </div>
                                        @endforeach
                                    @else
                                        <p>There Is No Category.</p>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal fade moreoptions{{$service->id}}" tabindex="-1" aria-labelledby="mySmallModalLabel"
                    aria-modal="true" role="dialog">
                    <div class="modal-dialog modal-dialog-centered modal-70">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="myModalLabel">Services</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="col-12">
                                    <div class="text-center mb-25">
                                        <div class="messageDiv"></div>
                                    </div>

                                </div>
                                <div class="row">
                                    <div class="col-lg-3 col-md-3 col-sm-6">
                                        <div class="manage-txt mb-15">
                                            <label class="highlight-font">Bookings Overview</label>
                                            <span>{{@$service->this_week_booking()}} Bookings This Week </span>
                                            <span>Service Expires on: {{$service->get_expired_time()}}</span>
                                            <a class="font-red"
                                                onclick="getbookingmodel({{$service->id}},'simple' ,'date' ,'open');">
                                                VIEW BOOKINGS</a>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-3 col-sm-6">
                                        <div class="manage-txt mb-15">
                                            <label class="highlight-font">Edit/Add Schedule</label>
                                            <span>{{ count($service->businessPriceDetailsAges)}} CATEGORIES CREATED |
                                                <br> {{$service->get_scheduled_categories($categories)}} CATEGORIES
                                                SCHEDULED | <br>
                                                <a href="#" data-bs-toggle="modal"
                                                    data-bs-target=".edit-schedule{{$service->id}}"
                                                    class="editSchedule{{$service->id}}"> + EDIT SCHEDULE</a>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="col-lg-2 col-md-3 col-sm-6">
                                        <div class="display-flex">
                                            {{-- <a class="btn btn-black mb-10 width-100 mr-15"
                                                href="{{route('business.services.create',['serviceType'=>$service->service_type,'serviceId'=>$service->id])}}">Edit
                                                Service</a> --}}
                                            <input type="button" class="btn btn-black mb-10 width-100" name="btndelete"
                                                id="btndelete" value="Delete Service" data-id="{{ $service->id }}">
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-md-3 col-sm-6">
                                        <input type="button" class="btn btn-red width-100" name="btnactive"
                                            id="btnactive"
                                            value="Make Service {{($service->is_active==1) ? 'Inactive' : 'Active'}}"
                                            data-id="{{ $service->id }}"
                                            data-btnactive="{{($service->is_active==1) ? 'Inactive' : 'Active'}}">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
                @endif
            </ul>
        </div>
        <!-- /#sidebar-wrapper -->
        <div class="modal fade view-booking" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-80">
                <div class="modal-content" id="bookingmodel">
                </div>
            </div>
        </div> 
        {{-- <div class="manage-comapny">    
            <a href="{{route('personal.company.index')}}">Back to Manage Company</a>
        </div>
         --}}
        <script>
        
            $(document).ready(function() {
                var chkDisplay = '{{$displayModal}}';
                if(chkDisplay){
                    $('.edit-schedule'+chkDisplay).modal('show');
                }
            });
    
            function getbookingmodel(sid,chk,type,open){  
                let date = '';
                if(chk == 'ajax'){
                    date = $('#managecalendarservice').val();
                }else if(chk == 'simple'){
                    date = new Date().toLocaleDateString();
                    if(open == 'open'){
                        $('#bookingmodel').html('');
                    }
                }
    
                $.ajax({
                    url:"{{route('getbookingmodeldata')}}",
                    xhrFields: {
                        withCredentials: true
                    },
                    type:"get",
                    data:{
                        sid:sid,
                        date:date,
                        type:type,
                        categoryId:($('#category').val() == 'all') ? '' : $('#category').val(),
                    },
                    success:function(data){
                        $('.moreoptions'+sid).modal('hide');
                        $('#bookingmodel').html(data);
                        if(open == 'open'){
                            $('.view-booking').modal('show');
                        }
                    }
                });
            } 
    
                $(document).on('click', '#btndelete', function(event) {
                    let text = "Are you sure to delete this activity?";
                    if (confirm(text) == true) {
                        var sid = $(this).attr('data-id');
                        var companyid = '{{$request->current_company->id}}';
                        $.ajax({ 
                            url:"/business/"+companyid+"/services/"+sid,
                            xhrFields: {
                                withCredentials: true
                            },
                            type:"delete",
                            data: { 
                                _token: '{{csrf_token()}}', 
                            },                
                            success: function(response) {
                            console.log('AJAX request successful:', response);
                            if (response.success) {
                                $('.messageDiv').addClass('btn btn-success');
                                $('.messageDiv').html(response.message);
                                setTimeout(function() {
                                    $('.messageDiv').fadeOut(400, function() {
                                        $('.modal').modal('hide'); 
                                        location.reload();
                                    });
                                }, 3000);
                            }
                        }
    
                        });
                    }
                });
    
            $(document).on('click', '#btnactive', function(event) {
                var sid = $(this).attr('data-id');
                var btnactive = $(this).attr('data-btnactive');
                var companyid = '{{$request->current_company->id}}';
                $.ajax({ 
                    url:"/business/"+companyid+"/services/"+sid,
                    xhrFields: {
                        withCredentials: true
                    },
                    type:"PATCH",
                    data: { 
                        _token: '{{csrf_token()}}', 
                        btnactive: btnactive
                    },
                    success: function(html){
                       location.reload();
                    }
                });
            });
    
        </script>