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
					<span class="font-white switch-business" data-key="t-menu">Nipa's Account</span>
				</li>
                <li class="menu-title"><span data-key="t-menu">Menu</span></li>
                <li class="nav-item">
                    <a class="nav-link menu-link " href="" aria-controls="sidebarDashboards">
                        <img src="{{asset('/public/img/menu-icon1.svg')}}" alt="Fitnessity"> <span data-key="t-dashboards">User Profile</span>
                    </a>
                </li>
				
				<li class="nav-item">
                    <a class="nav-link menu-link " href="" aria-controls="sidebarUI">
                        <img src="{{asset('/public/img/calender.png')}}" alt="Fitnessity"> <span data-key="t-base-ui"> Calender</span>
                    </a>
                </li>
				
				<li class="nav-item">
                    <a class="nav-link menu-link" href="" aria-controls="sidebarLanding">
                        <img src="{{asset('/public/img/menu-icon5.svg')}}" alt="Fitnessity"> <span data-key="t-landing">Manage Accounts</span>
                    </a>
                </li>
              
                <li class="nav-item">
                    <a class="nav-link menu-link " >
                        <img src="{{asset('/public/img/favorite.png')}}" alt="Fitnessity"> <span data-key="t-widgets">Favorite</span>
                    </a>
                </li>
				
				<li class="nav-item">
                    <a class="nav-link menu-link " >
                        <img src="{{asset('/public/img/follower.png')}}" alt="Fitnessity"> <span data-key="t-widgets">Followers</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link menu-link " >
                        <img src="{{asset('/public/img/follower.png')}}" alt="Fitnessity"> <span data-key="t-widgets">Following</span>
                    </a>
                </li>              
            </ul>
        </div>
        <!-- Sidebar -->
    </div>

    <div class="sidebar-background"></div>
</div>