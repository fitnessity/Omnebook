<?php
    if(request()->business_id){
        
        $companyId = request()->business_id;
        //temporary add here, wait for controller refactored
        URL::defaults(['business_id' => $companyId]);
    }else{
        $companyId = Auth::user()->cid;     
        //temporary add here, wait for controller refactored
        URL::defaults(['business_id' => $companyId]);
    }
    $companyList = Auth::user()->company()->select('id','logo','company_name')->get();
    $company = Auth::user()->current_company;
    $businessName = $company != '' ? @$company->public_company_name : '';
    $businessImage = $company != '' ? @$company->getCompanyImage() : '';
?>

<div class="app-menu navbar-menu" >
    <!-- LOGO -->
    <div class="navbar-brand-box">
        <!-- Dark Logo-->
        <!-- <a href="#" class="logo logo-dark">
            <span class="logo-sm"><img src="" alt="" height="22"></span>
            <span class="logo-lg"><img src="" alt="" height="17"></span>
        </a>-->
        <!-- Light Logo-->
        <!-- <a href="#" class="logo logo-light">
            <span class="logo-sm"><img src="" alt="" height="22"> </span>
            <span class="logo-lg"><img src="" alt="" height="17"></span>
        </a>  -->
        <button type="button" class="btn btn-sm p-0 fs-20 header-item float-end btn-vertical-sm-hover" id="vertical-hover"> <i class="ri-record-circle-line"></i> </button>
    </div>

    <div id="scrollbar">
        <div class="container-fluid">
            <div id="two-column-menu">
            </div>
			<div class="live-preview text-center">
				<div class="dropdown mt-70">
					<button class="btn btn-switch-business dropdown-toggle" type="button" id="dropdownMenuButton21" data-bs-toggle="dropdown" aria-expanded="false">{{$businessName}}</button>
					<ul class="dropdown-menu dropdown-menu-dark switch-account-dropdown" aria-labelledby="dropdownMenuButton21">
                        @if($companyId)
						<li>
							<a class="dropdown-item" onclick="changeCompany({{$companyId}})">
                                @if($businessImage)
                                    <img src="{{$businessImage}}" alt="Fitnessity" class="avatar-xs rounded-circle me-2 shadow">
                                @else
                                    <div class="avatar-xs me-2 one-latter">
                                        <span class="avatar-title rounded-circle bg-danger-red text-white">{{@$company->cname_first_letter}}</span>
                                    </div>
                                @endif

								<label class="fs-12">{{$businessName}}</label>
							</a>
						</li>
                        @endif
						<li>
							<a class="dropdown-item active" href="{{url('/family-member')}}"><i class="fa fa-user"></i> {{Auth::user()->full_name}} <br><span class="account-switchh"> Personal Account </span> </a>
						</li>
						<li> <hr class="dropdown-divider"></li>
						@forelse(@$companyList as $list)
						<li>
							<a class="dropdown-item" onclick="changeCompany({{$list->id}})">
								<div class="avatar-xs me-2 one-latter">
                                    @if( Storage::disk('s3')->exists($list->logo))
                                        <img src="{{Storage::URL($list->logo)}}" alt="Fitnessity" class="avatar-xs rounded-circle me-2 shadow">
                                    @else
                                        <span class="avatar-title rounded-circle bg-danger-red text-white">{{$list->cname_first_letter}}</span>
                                    @endif
									
								</div>
								<label class="fs-12">{{$list->company_name}}</label>
							</a>
						</li>
                        @empty
                        @endforelse
						<li> <hr class="dropdown-divider"></li>
						<li>
							<a class="dropdown-item" href="{{route('personal.company.create')}}" ><i class="fas fa-plus"></i> New Business Account </a>
						</li>
						<li> <hr class="dropdown-divider"></li>
						<li><a class="dropdown-item" href="{{ Config::get('constants.SITE_URL') }}/userlogout"><i class="fas fa-sign-out-alt"></i> Logout</a></li>
					</ul>
				</div>
			</div> 
            <ul class="navbar-nav dash-sidebar-menu" id="navbar-nav">
                <li class="menu-title"><span data-key="t-menu">Menu</span></li>
                <li class="nav-item">
                    <a class="nav-link menu-link @if(Route::current()->getName()=='business_dashboard') active @endif" href="{{route('business_dashboard')}}" aria-controls="sidebarDashboards">
                        <img src="{{asset('/public/img/home.png')}}" alt="Fitnessity"> <span data-key="t-dashboards">Dashboards</span>
                    </a>
                </li>
                
                <li class="nav-item">
                    @if(!Session('StaffLogin'))
                        <a class="nav-link menu-link @if(Route::current()->getName()=='personal.company.create') active @endif" href="{{route('personal.company.create',['company' => $companyId])}}" >
                                <img src="{{asset('/public/img/company-set-up.png')}}" alt="Fitnessity"> <span data-key="t-apps">Company Set Up</span>
                        </a>
                    @else
                        <a class="nav-link menu-link @if(Route::current()->getName()=='business.staff.show') active @endif" href="{{route('business.staff.show',['company' => $companyId,'staff'=>Session('StaffLogin')])}}" >
                                <img src="{{asset('/public/img/company-set-up.png')}}" alt="Fitnessity"> <span data-key="t-apps">Staff Personal Detail</span></a>
                    @endif
                </li>
                <li class="nav-item">
                    <a class="nav-link menu-link"  @if($companyId!='') href="{{route('business.service.select',['business_id'=>$companyId])}}" @endif aria-controls="sidebarLayouts">
                        <img src="{{asset('/public/img/service-price.png')}}" alt="Fitnessity"> <span data-key="t-layouts">Create New Service  </span> 
                    </a>
                </li> 
				
                <li class="nav-item">
                    <a class="nav-link menu-link" @if($companyId) href="#sidebarAuth"  @endif data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarAuth">
                        <img src="{{asset('/public/img/manage-company.png')}}" alt="Fitnessity"> <span data-key="t-authentication">Manage </span>
                    </a>
                    <div class="collapse menu-dropdown @if(Route::current()->getName() == 'personal.company.index' || Route::current()->getName() == 'personal.company.index' || Route::current()->getName()=='business.schedulers.index' || Route::current()->getName() == 'business.services.index')) collapse show @endif" id="sidebarAuth">
                        <ul class="nav nav-sm flex-column">
                            @if(!Session('StaffLogin'))
                                <li class="nav-item">
                                    <a href="{{route('personal.company.index')}}" class="nav-link @if(Route::current()->getName() == 'personal.company.index') active @endif" data-key="t-signup"> Manage Company
                                    </a>
                                </li> 
                            @endif
                            <li class="nav-item">
                                <a href="{{route('business.schedulers.index')}}" class="nav-link @if(Route::current()->getName()=='business.schedulers.index') active @endif" data-key="t-signin"> Manage Scheduler 
                                </a>
                            </li>
                            
                            <li class="nav-item">
                                <a href="{{route('business.services.index')}}" class="nav-link @if(Route::current()->getName() == 'business.services.index') active @endif" data-key="t-signup"> Manage Service
                                </a>
                            </li>

                            <li class="nav-item">
                                <a @if($companyId) href="{{route('business.products.index')}}" @endif class="nav-link  @if(Route::current()->getName() == 'business.products.index') active @endif" data-key="t-password-reset">Manage Product
									<span class="badge badge-pill bg-success" data-key="t-new">New</span>
                                </a>
                            </li>
                            @if(!Session('StaffLogin'))
                                <li class="nav-item">
                                    <a href="{{route('business.staff.index')}}" class="nav-link @if(Route::current()->getName() == 'business.staff.index') tab-active @endif" data-key="t-password-create">
                                        Manage Staff
                                    </a>
                                </li>
                            @endif
							<!--<li class="nav-item">
								<a href="#" class="nav-link " data-key="t-signup"> Manage Announcements 
								</a>
							</li> -->
                        </ul>
                    </div>
                </li>
                @if($companyId)
                <li class="nav-item">
                    <a class="nav-link menu-link @if(Route::current()->getName() == 'business_customer_index' || Route::current()->getName() == 'business_customer_show') tab-active @endif" href="{{route('business_customer_index')}}" aria-controls="sidebarPages">
                        <img src="{{asset('/public/img/clients.png')}}" alt="Fitnessity"> <span data-key="t-pages"> Clients </span>
                    </a>
                </li>
                @endif

               <!-- <li class="nav-item">
                    <a class="nav-link menu-link @if(Route::current()->getName() == 'booking_request') tab-active @endif" href="{{route('booking_request')}}" aria-controls="sidebarLanding">
                        <img src="{{asset('/public/img/email1.png')}}" alt="Fitnessity"> <span data-key="t-landing">Inbox </span>
                    </a>
                </li> -->

                <li class="nav-item">
                    <a class="nav-link menu-link @if(Route::current()->getName() == 'provider_calendar' ) tab-active @endif"  @if($companyId) href="{{route('provider_calendar')}}" @endif aria-controls="sidebarUI">
                        <img src="{{asset('/public/img/calender.png')}}" alt="Fitnessity"> <span data-key="t-base-ui"> Calender</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link menu-link @if(Route::current()->getName() == 'business.engage_client.index' ) tab-active @endif" href="{{route('business.engage_client.index')}}" >
                        <i class=" ri-user-follow-fill"></i> <span data-key="t-landing">Engage Clients </span>
                    </a>
                </li>

                <!-- <li class="nav-item">
                    <a class="nav-link menu-link @if(Route::current()->getName() == 'business.announcement.index' ) tab-active @endif" @if($companyId) href="{{route('business.announcement.index')}}" @endif aria-controls="sidebarUI">
                        <img src="{{asset('/public/img/calender.png')}}" alt="Fitnessity"> <span data-key="t-base-ui"> Announcement </span>
                    </a>
                </li> -->

                @if(!Session('StaffLogin'))
                    <li class="nav-item">
                        <a class="nav-link menu-link" @if($companyId) href="{{route('stripe-dashboard')}}" aria-controls="sidebarAdvanceUI"  @endif target="_blank">
                            <img src="{{asset('/public/img/financial-dash.png')}}" alt="Fitnessity"> <span data-key="t-advance-ui">Financial Dashboard</span>
                        </a>
                    </li>
                @endif
                <li class="nav-item">
                    <a class="nav-link menu-link @if(Route::current()->getName()=='business.orders.create') tab-active @endif" @if($companyId) href="{{ route('business.orders.create', [ 'book_id'=>'0']) }}"   @endif>
                        <img src="{{asset('/public/img/checkout-register.png')}}" alt="Fitnessity"> <span data-key="t-widgets">Point Of Sale </span>
                    </a>
                </li>

                <!-- <li class="nav-item">
                    <a class="nav-link menu-link" href="#checkinbar" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="checkinbar">
                        <i class="mdi mdi-account-circle-outline"></i> <span data-key="t-dashboards">Self Check-In</span>
                    </a>
                    <div class="collapse menu-dropdown @if(Route::current()->getName() == 'checkin-portal-settings') collapse show @endif" id="checkinbar">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="" class="nav-link" data-bs-toggle="modal" data-bs-target="#exampleModal"> Check-In Portal </a> -->
                                <!-- <a href="{{route('check-in-welcome')}}" class="nav-link" data-key="t-analytics"> Check-In Portal </a> -->
                            <!-- </li>
                            <li class="nav-item">
                                <a href="{{route('checkin-portal-settings')}}" class="nav-link @if(Route::current()->getName()=='checkin-portal-settings') active @endif" >Check-In Settings </a>
                            </li>
                        </ul>
                    </div>
                </li>  -->
                <!-- end Dashboard Menu -->

				<li class="nav-item">
					<a class="nav-link menu-link @if(Route::current()->getName()=='business.reports.index') tab-active @endif" @if($companyId) href="{{ route('business.reports.index') }}"   @endif aria-controls="sidebarForms">
						<img src="{{asset('/public/img/salesreports1.png')}}" alt="Fitnessity"> <span data-key="t-forms">Reports</span><span class="badge badge-pill bg-success" data-key="t-new">New</span>
					</a>
				</li>
				
				<li class="nav-item">
                    <a class="nav-link menu-link @if(Route::current()->getName()=='business.settings.index') tab-active @endif" @if($companyId) href="{{ route('business.settings.index') }}"   @endif >
                        <img src="{{asset('/public/img/setings-1.png')}}" alt="Fitnessity"> <span data-key="t-widgets">Settings </span><span class="badge badge-pill bg-success" data-key="t-new">New</span> 
                    </a>
                </li>
				
            </ul>
        </div>
        <!-- Sidebar -->
    </div>

    <div class="sidebar-background"></div>
</div>
<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"> Activate Check-In Mode</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="active-check-in-mode">
                            <p>Activating the check-in mode hides all the manager tools aside from member sign-up. You can turn off this mode at any time by entering your 4 digit passcode.</p>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="text-center">
                        <a href="{{route('check-in-welcome')}}" data-key="t-analytics" class="btn btn-red ">Activate Check-In Mode</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    function changeCompany(id) {
        location.href = '/dashboard/dates=/'+id;
    }
</script>