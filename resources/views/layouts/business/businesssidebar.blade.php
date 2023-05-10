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
?>

<div class="app-menu navbar-menu" >
    <!-- LOGO -->
    <div class="navbar-brand-box">
        <!-- Dark Logo-->
        <a href="#" class="logo logo-dark">
            <span class="logo-sm">
                <img src="" alt="" height="22">
            </span>
            <span class="logo-lg">
                <img src="" alt="" height="17">
            </span>
        </a>
        <!-- Light Logo-->
        <a href="#" class="logo logo-light">
            <span class="logo-sm">
                <img src="" alt="" height="22">
            </span>
            <span class="logo-lg">
                <img src="" alt="" height="17">
            </span>
        </a>
        <button type="button" class="btn btn-sm p-0 fs-20 header-item float-end btn-vertical-sm-hover" id="vertical-hover">
            <i class="ri-record-circle-line"></i>
        </button>
    </div>

    <div id="scrollbar">
        <div class="container-fluid">
            <div id="two-column-menu">
            </div>
            <ul class="navbar-nav dash-sidebar-menu" id="navbar-nav">
                <li class="menu-title"><span data-key="t-menu">Menu</span></li>
                <li class="nav-item">
                    <a class="nav-link menu-link @if(Route::current()->getName()=='business_dashboard') active @endif" href="#sidebarDashboards" aria-controls="sidebarDashboards">
                        <img src="{{asset('/public/img/home.png')}}" alt="Fitnessity"> <span data-key="t-dashboards">Dashboards</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link menu-link" href="#sidebarApps" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarApps">
                        <img src="{{asset('/public/img/company-set-up.png')}}" alt="Fitnessity"> <span data-key="t-apps">Company Set Up</span>
                    </a>
                    <div class="collapse menu-dropdown" id="sidebarApps">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="/businessjumps/2/{{$companyId}}" class="nav-link @if(Route::current()->getName()=='createNewBusinessProfile') active @endif" data-key="t-calendar"> Company Details </a>
                            </li>
                            <li class="nav-item">
                                <a href="/businessjumps/3/{{$companyId}}" class="nav-link @if(Route::current()->getName()=='createNewBusinessProfile') active @endif" data-key="t-chat"> Your Experience </a>
                            </li>
                            <li class="nav-item">
                                <a href="/businessjumps/4/{{$companyId}}" class="nav-link @if(Route::current()->getName()=='createNewBusinessProfile') active @endif" data-key="t-email">Company Specifics </a>
                            </li>
                            <li class="nav-item">
                                <a href="/businessjumps/5/{{$companyId}}" class="nav-link @if(Route::current()->getName()=='createNewBusinessProfile') active @endif" data-key="t-ecommerce"> Set Your Terms
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="/businessjumps/6/{{$companyId}}" class="nav-link @if(Route::current()->getName()=='createNewBusinessProfile') active @endif" data-key="t-projects">Get Verified </a>
                            </li>
                        </ul>
                    </div>
                </li>

                <li class="nav-item">
                    <a class="nav-link menu-link"  @if($companyId!='') onclick="linkJump(7);" @else href="{{route('createNewBusinessProfile')}}" @endif aria-controls="sidebarLayouts">
                        <img src="{{asset('/public/img/service-price.png')}}" alt="Fitnessity"> <span data-key="t-layouts">Services & Prices </span> 
                    </a>
                </li> 
				
                <li class="nav-item">
                    <a class="nav-link menu-link" @if($companyId) href="#sidebarAuth" @endif data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarAuth">
                        <img src="{{asset('/public/img/manage-company.png')}}" alt="Fitnessity"> <span data-key="t-authentication">Manage </span>
                    </a>
                    <div class="collapse menu-dropdown" id="sidebarAuth">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="{{route('business.schedulers.index')}}" class="nav-link @if(Route::current()->getName()=='business.schedulers.index') tab-active @endif" data-key="t-signin"> Manage Bookings
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{route('business.services.index')}}" class="nav-link @if(Route::current()->getName() == 'business.services.index') tab-active @endif" data-key="t-signup"> Manage Service
                                </a>
                            </li>

                            <li class="nav-item">
                                <a href="{{route('business.products.index')}}" class="nav-link  @if(Route::current()->getName() == 'business.products.index') tab-active @endif" data-key="t-password-reset">Add/Manage Product
                                </a>
                            </li>

                            <li class="nav-item">
                                <a href="{{route('business.staff.index')}}" class="nav-link @if(Route::current()->getName() == 'business.staff.index') tab-active @endif" data-key="t-password-create">
                                    Add/Manage Staff
                                </a>
                            </li>
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

                <li class="nav-item">
                    <a class="nav-link menu-link @if(Route::current()->getName() == 'booking_request') tab-active @endif" href="{{route('booking_request')}}" aria-controls="sidebarLanding">
                        <img src="{{asset('/public/img/email1.png')}}" alt="Fitnessity"> <span data-key="t-landing">Inbox </span>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link menu-link @if(Route::current()->getName() == 'provider_calendar' ) tab-active @endif" href="{{route('provider_calendar')}}" aria-controls="sidebarUI">
                        <img src="{{asset('/public/img/calender.png')}}" alt="Fitnessity"> <span data-key="t-base-ui"> Calender</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link menu-link" href="{{route('stripe-dashboard')}}" aria-controls="sidebarAdvanceUI" target="_blank">
                        <img src="{{asset('/public/img/financial-dash.png')}}" alt="Fitnessity"> <span data-key="t-advance-ui">Financial Dashboard</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link menu-link @if(Route::current()->getName()=='business.orders.create') tab-active @endif" @if($companyId) href="{{ route('business.orders.create', [ 'book_id'=>'0']) }}"   @endif>
                        <img src="{{asset('/public/img/checkout-register.png')}}" alt="Fitnessity"> <span data-key="t-widgets">Checkout Register </span>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link menu-link"  aria-controls="sidebarForms">
                        <img src="{{asset('/public/img/salesreports.png')}}" alt="Fitnessity"> <span data-key="t-forms">Sales Reports</span>
                    </a>
                </li>
            </ul>
        </div>
        <!-- Sidebar -->
    </div>

    <div class="sidebar-background"></div>
</div>
<script>
    function linkJump(bstep) {
        var cid = '{{$companyId}}';
        location.href = '/businessjumps/'+bstep+'/'+cid;
    } 
</script>