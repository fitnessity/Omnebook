<div class="main-content">
    <div id="client_wrapper" class="clinet-page-content toggled ">
        <!-- Sidebar -->
        <div id="sidebar-wrapper">
            <ul class="navbar-nav sidebar-nav" id="navbar-nav">
                <li class="menu-title"><span class="fs-13" data-key="t-menu">Marketing</span></li>
                <li class="nav-item">
                    <a class="nav-link menu-link" href="#sidebarInbox" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarInbox">
                        <i class="fas fa-inbox fs-15"></i> <span class="fs-15" data-key="t-dashboards">Inbox</span>
                    </a>
                    <div class="collapse menu-dropdown" id="sidebarInbox">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="http://dev.fitnessity.co/design/chat_inbox" class="nav-link" data-key="t-analytics"> Stats</a>
                            </li>
                        </ul>
                    </div>
                </li> <!-- end Dashboard Menu -->
                <li class="nav-item">
                    <a class="nav-link menu-link @if(Route::current()->getName() == 'business.announcement.index' ) active @endif" href="{{route('business.announcement.index')}}" >
                        <i class="fas fa-bullhorn fs-15"></i> <span class="fs-15" data-key="t-apps">Announcements</span>
                    </a>

                   <!--  <div class="collapse menu-dropdown @if(Route::current()->getName() == 'business.announcement.index' ) collapse show @endif" id="sidebarAnnouncements">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="{{route('business.announcement.index')}}" class="nav-link @if(Route::current()->getName() == 'business.announcement.index' ) active @endif" data-key="t-calendar"> Announcement </a>
                            </li>
                        </ul>
                    </div> -->
                </li>
                <!-- <li class="nav-item">
                    <a class="nav-link menu-link" href="#sidebarEmail" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarEmail">
                        <i class="fas fa-envelope fs-15"></i> <span class="fs-15" data-key="t-apps">Email Campaign</span>
                    </a>
                    <div class="collapse menu-dropdown" id="sidebarEmail">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="#" class="nav-link" data-key="t-calendar"> Stats </a>
                            </li>
                        </ul>
                    </div>
                </li> -->
                <li class="nav-item">
                    <a class="nav-link menu-link" href="http://dev.fitnessity.co/design/email_blast">
                        <i class="far fa-envelope fs-15"></i> <span class="fs-15" data-key="t-widgets">Email Blast</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link menu-link" href="http://dev.fitnessity.co/design/automation_campaigns">
                        <i class="fas fa-bell fs-15"></i> <span class="fs-15" data-key="t-widgets">Automation Alerts</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link menu-link" href="{{route('business.engage_client.contact-list')}}">
                        <i class="fas fa-address-book fs-15"></i> <span class="fs-15" data-key="t-widgets">Customer Contact List</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link menu-link" href="{{route('business.website_integration')}}">
                        <i class="fas fa-cogs fs-15"></i> <span class="fs-15" data-key="t-widgets">Website Integration</span>
                    </a>
                </li>
            </ul>
        </div>
        <!-- /#sidebar-wrapper -->


