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
