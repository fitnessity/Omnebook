<div class="app-menu navbar-menu" ><!-- LOGO -->
    <div class="navbar-brand-box"><!-- Dark Logo-->
        <a href="#" class="logo logo-dark">
            <span class="logo-sm">
                <img src="" alt="img" height="22">
            </span>
            <span class="logo-lg">
                <img src="" alt="img" height="17">
            </span>
        </a> <!-- Light Logo-->
        <a href="#" class="logo logo-light">
            <span class="logo-sm">
                <img src="" alt="img" height="22">
            </span>
            <span class="logo-lg">
                <img src="" alt="img" height="17">
            </span>
        </a>
        <button type="button" class="btn btn-sm p-0 fs-20 header-item float-end btn-vertical-sm-hover" id="vertical-hover">
            <i class="ri-record-circle-line"></i>
        </button>
    </div>

    <div id="scrollbar" class="personal-sidebar">
        <div class="container-fluid">
            <div id="two-column-menu">
            </div>
            <ul class="navbar-nav dash-sidebar-account-menu" id="navbar-nav">
                @if(request()->business_id) 
                    @php
                        $business = App\CompanyInformation::find(request()->business_id);
                    @endphp
                    
					<div class="d-flex align-items-center c-padding">
                        @if($business->getCompanyImage()) 
                            <div class="flex-shrink-0 me-2">
                                <img src="{{$business->getCompanyImage()}}" alt="img" class="avatar-xs rounded-circle shadow">
                            </div>
                        @else
                            <div class="avatar-xsmall me-2">
                                <span class="mini-stat-icon avatar-title xsmall-font rounded-circle text-success bg-soft-red fs-4 uppercase">{{$business->first_letter}}</span>
                            </div>
                        @endif

						<div class="font-white flex-grow-1">{{$business->company_name}}</div>
					</div>
                @endif

				<li class="menu-title border-bottom width-250">
                    @php
                        if(request()->customer_id){
                            if(request()->type == 'user'){
                                $familyMember = Auth::user()->user_family_details()->where('id',request()->customer_id)->first();
                                $name = @$familyMember->full_name;
                            }else{
                                $customer = App\Customer::find(request()->customer_id);
                                $name = @$customer->full_name;
                            }
                        }else{
                            $name = Auth::user()->full_name;
                        }
                    @endphp
					<span class="font-white switch-business" data-key="t-menu">Welcome  {{ $name}} </span>
				</li>
                <li class="menu-title"><span data-key="t-menu">Menu</span></li>

                @if(request()->business_id) 
                    <li class="nav-item">
                        <a class="nav-link menu-link {{ request()->is('*dashboard*') ? 'active' : '' }}" href="{{ url('/personal/dashboard') . '?' . http_build_query(['business_id' => request()->business_id, 'customer_id' => request()->has('customer_id') ? request()->customer_id : null,'type' => request()->has('type') ? request()->type : null]) }}" aria-controls="sidebarDashboards">
                            <img src="{{asset('/public/img/social-profile.png')}}" alt="Fitnessity"> <span data-key="t-dashboards">Dashboard</span>
                        </a>
                    </li>
                @endif

                @if(!request()->customer_id || !$request->has('customer_id'))
    				<li class="nav-item">
                        <a class="nav-link menu-link" href="{{route('profile-viewProfile')}}" aria-controls="sidebarDashboards">
                            <img src="{{asset('/public/img/social-profile.png')}}" alt="Fitnessity"> <span data-key="t-dashboards">View Social Profile</span>
                        </a>
                    </li>
                @endif

                @php
                    $currentUrl = url()->current();
                    $containsCustomerId = Str::contains($currentUrl, 'customer_id');
                @endphp

				<li class="nav-item">
                    <a class="nav-link menu-link {{ request()->is('*profile*') ? 'active' : '' }}" href="{{ url('/personal/profile') . '?' . http_build_query([ 'business_id' => request()->business_id,'customer_id' => request()->has('customer_id') ? request()->customer_id : null,'type' => request()->has('type') ? request()->type : null]) }}" aria-controls="sidebarDashboards">
                        <img src="{{asset('/public/img/edit-2.png')}}" alt="Fitnessity"> <span data-key="t-dashboards">  @if(request()->customer_id && $containsCustomerId) Edit Profile @else Edit Profile & Password @endif</span>
                    </a>
                </li>
				<li class="nav-item">
                    <a class="nav-link menu-link {{ request()->is('*manage-account*') ? 'active' : '' }}" href="{{route('personal.manage-account.index')}}" aria-controls="sidebarLanding">
                        <img src="{{asset('/public/img/menu-icon5.svg')}}" alt="Fitnessity"> <span data-key="t-landing">Manage Accounts</span>
                    </a>
                </li>
				<li class="nav-item">
                    <a class="nav-link menu-link {{ request()->is('*calendar*') ? 'active' : '' }}" href="{{ url('/personal/calendar') . '?' . http_build_query([ 'business_id' => request()->business_id, 'customer_id' => request()->has('customer_id') ? request()->customer_id : null,'type' => request()->has('type') ? request()->type : null]) }}" aria-controls="sidebarUI">
                        <img src="{{asset('/public/img/calender.png')}}" alt="Fitnessity"> <span data-key="t-base-ui"> Calender</span>
                    </a>
                </li>

                @if(request()->business_id)
                
    				<li class="nav-item">
                        <a class="nav-link menu-link {{ request()->is('*orders*') ? 'active' : '' }}" href="{{ url('/personal/orders') . '?' . http_build_query(['business_id' => request()->business_id, 'customer_id' => request()->has('customer_id') ? request()->customer_id : null,'type' => request()->has('type') ? request()->type : null]) }}" aria-controls="sidebarDashboards">
                            <img src="{{asset('/public/img/booking-2.png')}}" alt="Fitnessity"> <span data-key="t-dashboards">Bookings & Memberships</span>
                        </a>
                    </li> 

                    @if(!request()->customer_id || !$request->has('customer_id'))
    				<li class="nav-item">
                        <a class="nav-link menu-link {{ request()->is('*payment-history*') ? 'active' : '' }}" href="{{ url('/personal/payment-history?business_id='.request()->business_id) }}" aria-controls="sidebarDashboards">
                            <img src="{{asset('/public/img/payment.png')}}" alt="Fitnessity"> <span data-key="t-dashboards">Payment History</span>
                        </a>
                    </li>
                    @endif
    				<li class="nav-item">
                        <a class="nav-link menu-link {{ request()->is('*business_activity_schedulers*') || request()->is('*multibooking*')   ? 'active' : '' }}" href="{{ url('/business_activity_schedulers/'.request()->business_id) . '?' . http_build_query([ 'customer_id' => request()->has('customer_id') ? request()->customer_id : null,'type' => request()->has('type') ? request()->type : null,]) }}" aria-controls="sidebarDashboards">
                            <img src="{{asset('/public/img/schedule-1.png')}}" alt="Fitnessity"> <span data-key="t-dashboards"> Schedule</span>
                        </a>
                    </li>
    				<li class="nav-item">
                        <a class="nav-link menu-link {{ request()->is('*attendance-belt*') ? 'active' : '' }}"  href="{{ url('/personal/attendance-belt') . '?' . http_build_query(['business_id' => request()->business_id, 'customer_id' => request()->has('customer_id') ? request()->customer_id : null,'type' => request()->has('type') ? request()->type : null]) }}" aria-controls="sidebarDashboards">
                            <img src="{{asset('/public/img/attendance.png')}}" alt="Fitnessity"> <span data-key="t-dashboards"> Attendance & Promotions </span>
                        </a>
                    </li>

                @endif

                @if(!request()->customer_id || !$request->has('customer_id'))
				<li class="nav-item">
                    <a class="nav-link menu-link {{ request()->is('*credit-cards*') ? 'active' : '' }}" href="{{url('personal/credit-cards'). '?' . http_build_query(['business_id' => request()->business_id]) }}" aria-controls="sidebarDashboards">
                        <img src="{{asset('/public/img/credit-card.png')}}" alt="Fitnessity"> <span data-key="t-dashboards"> Credit Card </span>
                    </a>
                </li>  
                @endif

				@if(request()->business_id)
                    @if(!request()->customer_id || !$request->has('customer_id'))
                    <li class="nav-item">
                        <a class="nav-link menu-link {{ request()->is('*announcement*') ? 'active' : '' }}" href="{{route('personal.announcement-news' ,['business_id' => request()->business_id])}}" >
                            <img src="{{asset('/public/img/announcement.png')}}" alt="Fitnessity"> <span data-key="t-widgets">Announcement & News</span>
                        </a>
                    </li> 
                    @endif
    				<li class="nav-item">
                        <a class="nav-link menu-link {{ request()->is('*notes*') ? 'active' : '' }}" href="{{ url('/personal/notes-alerts') . '?' . http_build_query([ 'business_id' => request()->business_id ,'customer_id' => request()->has('customer_id') ? request()->customer_id : null,'type' => request()->has('type') ? request()->type : null]) }}" aria-controls="sidebarDashboards">
                            <img src="{{asset('/public/img/notes.png')}}" alt="Fitnessity"> <span data-key="t-dashboards"> Notes & Alerts </span>
                        </a>
                    </li>
    				<li class="nav-item">
                      <a class="nav-link menu-link {{ request()->is('*documents-contract*') ? 'active' : '' }}" href="{{ url('/personal/documents-contract') . '?' . http_build_query(['business_id' => request()->business_id, 'customer_id' => request()->has('customer_id') ? request()->customer_id : null,'type' => request()->has('type') ? request()->type : null]) }}" aria-controls="sidebarDashboards">
                        <img src="{{ asset('/public/img/doc.png') }}" alt="Fitnessity">
                        <span data-key="t-dashboards">Documents & Contracts</span>
                    </a>
                    </li>
                @endif		
                
                @if(!request()->customer_id || !$request->has('customer_id'))
                <li class="nav-item">
                    <a class="nav-link menu-link {{ request()->is('*favourite*') ? 'active' : '' }}" href="{{url('personal/favourite'). '?' . http_build_query(['business_id' => request()->business_id]) }}" >
                        <img src="{{asset('/public/img/favorite.png')}}" alt="Fitnessity"> <span data-key="t-widgets">Favorite</span>
                    </a>
                </li>
				
				<li class="nav-item">
                    <a class="nav-link menu-link {{ request()->is('*followers*') ? 'active' : '' }}" href="{{url('personal/followers'). '?' . http_build_query(['business_id' => request()->business_id]) }}" >
                        <img src="{{asset('/public/img/follower.png')}}" alt="Fitnessity"> <span data-key="t-widgets">Followers</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link menu-link {{ request()->is('*following*') ? 'active' : '' }}" href="{{url('personal/following'). '?' . http_build_query(['business_id' => request()->business_id]) }}">
                        <img src="{{asset('/public/img/follower.png')}}" alt="Fitnessity"> <span data-key="t-widgets">Following</span>
                    </a>
                </li> 
                @endif  
            </ul>
        </div>
    </div>
    <div class="sidebar-background"></div>
</div>