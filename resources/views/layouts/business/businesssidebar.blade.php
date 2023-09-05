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
    $dba_business_name = '';
    if($company != ''){
        $dba_business_name =  $company->dba_business_name != '' ? $company->dba_business_name : $company->company_name;
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
				<li class="menu-title border-bottom">
					<span class="font-white switch-business" data-key="t-menu">{{$dba_business_name}}
						<a href="" data-bs-toggle="modal" data-bs-target=".switch-business-modal">(switch)</a>
					</span>
				</li>
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
                        <img src="{{asset('/public/img/service-price.png')}}" alt="Fitnessity"> <span data-key="t-layouts">Services & Prices </span> 
                    </a>
                </li> 
				
                <li class="nav-item">
                    <a class="nav-link menu-link" @if($companyId) href="#sidebarAuth" @endif data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarAuth">
                        <img src="{{asset('/public/img/manage-company.png')}}" alt="Fitnessity"> <span data-key="t-authentication">Manage </span>
                    </a>
                    <div class="collapse menu-dropdown" id="sidebarAuth">
                        <ul class="nav nav-sm flex-column">
                            @if(!Session('StaffLogin'))
                                <li class="nav-item">
                                    <a href="{{route('personal.company.index')}}" class="nav-link @if(Route::current()->getName() == 'personal.company.index') tab-active @endif" data-key="t-signup"> Manage Company
                                    </a>
                                </li> 
                            @endif
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
                            @if(!Session('StaffLogin'))
                                <li class="nav-item">
                                    <a href="{{route('business.staff.index')}}" class="nav-link @if(Route::current()->getName() == 'business.staff.index') tab-active @endif" data-key="t-password-create">
                                        Add/Manage Staff
                                    </a>
                                </li>
                            @endif
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
                    <a class="nav-link menu-link @if(Route::current()->getName() == 'provider_calendar' ) tab-active @endif"  @if($companyId) href="{{route('provider_calendar')}}" @endif aria-controls="sidebarUI">
                        <img src="{{asset('/public/img/calender.png')}}" alt="Fitnessity"> <span data-key="t-base-ui"> Calender</span>
                    </a>
                </li>
                @if(!Session('StaffLogin'))
                    <li class="nav-item">
                        <a class="nav-link menu-link" @if($companyId) href="{{route('stripe-dashboard')}}" aria-controls="sidebarAdvanceUI"  @endif target="_blank">
                            <img src="{{asset('/public/img/financial-dash.png')}}" alt="Fitnessity"> <span data-key="t-advance-ui">Financial Dashboard</span>
                        </a>
                    </li>
                @endif
                <li class="nav-item">
                    <a class="nav-link menu-link @if(Route::current()->getName()=='business.orders.create') tab-active @endif" @if($companyId) href="{{ route('business.orders.create', [ 'book_id'=>'0']) }}"   @endif>
                        <img src="{{asset('/public/img/checkout-register.png')}}" alt="Fitnessity"> <span data-key="t-widgets">Checkout Register </span>
                    </a>
                </li>

				<li class="nav-item">
					<a class="nav-link menu-link" href="#sidebarForms" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarForms">
						<img src="{{asset('/public/img/salesreports.png')}}" alt="Fitnessity"> <span data-key="t-forms">Reports</span>
					</a>
					<div class="collapse menu-dropdown" id="sidebarForms">
						<ul class="nav nav-sm flex-column">
							<li class="nav-item">
								<a href="#" class="nav-link" data-key="t-basic-elements">Sales Reports</a>
							</li>
							<li class="nav-item">
								<a href="#" class="nav-link" data-key="t-form-select">Membership Expirations</a>
							</li>
						</ul>
					</div>
				</li>
            </ul>
        </div>
        <!-- Sidebar -->
    </div>

    <div class="sidebar-background"></div>
</div>
<div class="modal fade switch-business-modal" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="myModalLabel">Select Business</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body">
                @foreach($companyList as $list)
				<a class="business-click" onclick="changeCompany({{$list->id}})">
    				<div class="row y-middle divider">
    					<div class="col-md-2 col-2">
    						<div class="select-business">
                                @if( Storage::disk('s3')->exists($list->logo))
    							    <img src="{{Storage::URL($list->logo)}}" alt="Fitness pvt company, llc" >
                                @else
                                    <div class="company-list-text mb-10"><p class="character">{{$list->cname_first_letter}}</p></div>
                                @endif
    						</div>
    					</div>		
    					<div class="col-md-5 col-8">
    						<label class="business-name">{{$list->company_name}}</label>
    					</div>
    				</div>
				</a>
                @endforeach
			</div>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<script>
    function changeCompany(id) {
        location.href = '/dashboard/dates=/'+id;
    }
</script>