<!-- Left side column. contains the logo and sidebar -->
@inject('request', 'Illuminate\Http\Request')
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <?php
          if(Auth::user()->profile_pic != '' && file_exists(public_path().DIRECTORY_SEPARATOR.'uploads'.DIRECTORY_SEPARATOR.'profile_pic'.DIRECTORY_SEPARATOR.'thumb150'.DIRECTORY_SEPARATOR.Auth::user()->profile_pic)) {
            echo '<img src="'.Config::get('constants.USER_IMAGE_THUMB150').Auth::user()->profile_pic.'" class="img-circle" />';
          }
          else {
            echo '<img src="'.Config::get('constants.FRONT_IMAGE').'user.png" class="img-circle" />';
          }
          ?>          
        </div>
        <div class="pull-left info">
          <p>{{Auth::user()->firstname}} {{Auth::user()->lastname}}</p>
          <!-- <a href="#"><i class="fa fa-circle text-success"></i> Online</a> -->
        </div>
      </div>

      <!-- search form -->
      <!-- <form action="#" method="get" class="sidebar-form">
        <div class="input-group">
          <input type="text" name="q" class="form-control" placeholder="Search...">
              <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
        </div>
      </form> -->
      <!-- /.search form -->
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu">
        <!-- <li class="header">MAIN NAVIGATION</li> -->
        <li class="{{ $request->segment(2) == 'dashboard' ? 'active' : '' }}">
          <a href="/admin/dashboard">
            <i class="fa fa-dashboard"></i> <span>Dashboard</span>  
          </a>
        </li>
        <li class="{{ $request->segment(2) == 'fees' ? 'active' : '' }}">
          <a href="/admin/fees">
            <i class="fa fa-usd"></i> <span>Fees</span>  
          </a>
        </li>
        <li class="{{ $request->segment(2) == 'slider' ? 'active' : '' }}">
          <a href="/admin/slider">
            <i class="fa fa-sliders"></i> <span>Manage Slider</span>  
          </a>
        </li>
        <li class="{{ $request->segment(2) == 'post' ? 'active' : '' }}">
          <a href="{{route('admin/post')}}">
            <i class="fa fa-sliders"></i> <span>Manage Post</span>  
          </a>
        </li>
        <li class="{{ $request->segment(2) == 'slider' ? 'active' : '' }}">
          <a href="/admin/inquiry">
            <i class="fa fa-sliders"></i> <span>Inquiry</span>  
          </a>
        </li>
        <li class="{{ $request->segment(2) == 'slider' ? 'active' : '' }}">
          <a href="/admin/contact-us">
            <i class="fa fa-sliders"></i> <span>Contact Us</span>  
          </a>
        </li>
        <li class="{{ ($request->segment(2) == 'trainer' || $request->segment(2) == 'trainer') ? 'active' : '' }}">
          <a href="/admin/trainer">
            <i class="fa fa-users"></i> <span>Manage Trainer</span>  
          </a>
        </li>
        <li class="{{ $request->segment(2) == 'cms' ? 'active' : '' }}">
          <a href="/admin/cms">
            <i class="fa fa-list-alt"></i> <span>Manage CMS</span>  
          </a>
        </li>
        <li class="{{ $request->segment(2) == 'online' ? 'active' : '' }}">
          <a href="/admin/online">
            <i class="fa fa-history"></i> <span>Manage Online Classes & Activity</span>  
          </a>
        </li>
        <li class="{{ $request->segment(2) == 'person' ? 'active' : '' }}">
          <a href="/admin/person">
            <i class="fa fa-history"></i> <span>Manage Person Classes & Activity</span>  
          </a>
        </li>

        <li class="{{ ($request->segment(2) == 'discover' || $request->segment(2) == 'discover') ? 'active' : '' }}">
          <a href="/admin/discover">
            <i class="fa fa-users"></i> <span>Manage Discover Activities</span>  
          </a>
        </li>

        <li class="{{ ($request->segment(2) == 'customers' || $request->segment(2) == 'customer') ? 'active' : '' }}">
          <a href="/admin/customers">
            <i class="fa fa-users"></i> <span>Manage Customers</span>  
          </a>
        </li>

        <!-- <li class="{{ $request->segment(2) == 'professionals' ? 'active' : '' }}">
          <a href="/admin/professionals">
            <i class="fa fa-users"></i> <span>Manage Professionals</span> 
          </a>
        </li> -->

        <li class="{{ $request->segment(2) == 'businessusers' ? 'active' : '' }}">
          <a href="/admin/businessusers">
            <i class="fa fa-users"></i> <span>Manage BusinessUsers</span> 
          </a>
        </li>

        <li class="{{ $request->segment(2) == 'plans' ? 'active' : '' }}">
          <a href="/admin/plans/membership-plan">
            <i class="fa fa-list-alt"></i> <span>Manage Memership Plans</span>  
          </a>
        </li>

        <li class="{{ $request->segment(2) == 'sports' ? 'active' : '' }}">
          <a href="/admin/sports">
            <i class="fa fa-futbol-o"></i> <span>Manage Sports</span>  
          </a>
        </li>

        <li class="{{ $request->segment(2) == 'newsletters' ? 'active' : '' }}">
          <a href="/admin/newsletters">
            <i class="fa fa-envelope"></i> <span>Newsletters</span>  
          </a>
        </li>
        
        <li class="{{ $request->segment(2) == 'feedbacks' ? 'active' : '' }}">
          <a href="/admin/feedbacks">
            <i class="fa fa-pencil-square-o"></i> <span>Feedbacks</span>  
          </a>
        </li>

        <li class="{{ $request->segment(2) == 'bookings' ? 'active' : '' }}">
          <a href="/admin/bookings">
            <i class="fa fa-pencil-square-o"></i> <span>Bookings</span>  
          </a>
        </li>
        <li class="{{ $request->segment(2) == 'helpdesk' ? 'active' : '' }}">
          <a href="{{route('helpdesk')}}">
            <i class="fa fa-question-circle"></i> <span>Help Center</span>  
          </a>
        </li>
        
        <li class="{{ $request->segment(2) == 'vatted_business_faq' ? 'active' : '' }}">
          <a href="{{route('vatted_business_faq')}}">
            <i class="fa fa-question-circle"></i> <span>Vetted  Business FAQ’s</span>  
          </a>
        </li>
        
          <li class="{{ $request->segment(2) == 'background_check_faq' ? 'active' : '' }}">
          <a href="{{route('background_check_faq')}}">
            <i class="fa fa-question-circle"></i> <span>Background Check FAQ’s</span>  
          </a>
        </li>

         <li class="{{ $request->segment(2) == 'reportedfeeds' ? 'active' : '' }}">
          <a href="/admin/reportedfeeds">
            <i class="fa fa-flag"></i> <span>Reported Posts/Comments</span>
          </a>
        </li>
        
        <!--<li class="{{ $request->segment(2) == 'claimbusiness' ? 'active' : '' }}">-->
        <!--  <a href="/admin/claimbusiness">-->
        <!--    <i class="fa fa-flag"></i> <span>Manage Claim a Business Data</span>-->
        <!--  </a>-->
        <!--</li>-->
        
        <li class="treeview">
          <a href="#">
            <i class="fa fa-flag"></i>
            <span>Manage Claim a business data</span>
            <!--<span class="pull-right-container">-->
            <!--  <span class="label label-primary pull-right"></span>-->
            <!--</span>-->
          </a>
          <ul class="treeview-menu">
            <li><a href="/admin/claimbusiness"><i class="fa fa-circle-o"></i> Claimed Business</a></li>
            <li><a href="/admin/unclaimbusiness"><i class="fa fa-circle-o"></i> Unclaimed Business</a></li>
          </ul>
        </li>

        <li class="treeview">
          <a href="#">

            <i class="fa fa-bullseye"></i>
            <span>Advertisment</span>
            <!--<span class="pull-right-container">-->
            <!--  <span class="label label-primary pull-right"></span>-->
            <!--</span>-->
          </a>
          <ul class="treeview-menu">
            <li><a href="{{route('bookactivity')}}"><i class="fa fa-circle-o"></i> Book an Activity</a></li>
            <li><a href="{{route('getstarted')}}"><i class="fa fa-circle-o"></i> Get Started</a></li>
          </ul>
        </li>
        
        
        <!-- <li class="active treeview">
          <a href="#">
            <i class="fa fa-dashboard"></i> <span>Main Menu</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="active"><a href="#"><i class="fa fa-circle-o"></i> Menu v1</a></li>
            <li><a href="#"><i class="fa fa-circle-o"></i> Menu v2</a></li>
          </ul>
        </li> -->
        <!-- <li class="treeview">
          <a href="#">
            <i class="fa fa-files-o"></i>
            <span>Layout Options</span>
            <span class="pull-right-container">
              <span class="label label-primary pull-right">4</span>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="../AdminLTE/pages/layout/top-nav.html"><i class="fa fa-circle-o"></i> Top Navigation</a></li>
            <li><a href="../AdminLTE/pages/layout/boxed.html"><i class="fa fa-circle-o"></i> Boxed</a></li>
            <li><a href="../AdminLTE/pages/layout/fixed.html"><i class="fa fa-circle-o"></i> Fixed</a></li>
            <li><a href="../AdminLTE/pages/layout/collapsed-sidebar.html"><i class="fa fa-circle-o"></i> Collapsed Sidebar</a></li>
          </ul>
        </li> -->
        <!-- <li>
          <a href="pages/widgets.html">
            <i class="fa fa-th"></i> <span>Widgets</span>
            <span class="pull-right-container">
              <small class="label pull-right bg-green">new</small>
            </span>
          </a>
        </li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-pie-chart"></i>
            <span>Charts</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="pages/charts/chartjs.html"><i class="fa fa-circle-o"></i> ChartJS</a></li>
            <li><a href="pages/charts/morris.html"><i class="fa fa-circle-o"></i> Morris</a></li>
            <li><a href="pages/charts/flot.html"><i class="fa fa-circle-o"></i> Flot</a></li>
            <li><a href="pages/charts/inline.html"><i class="fa fa-circle-o"></i> Inline charts</a></li>
          </ul>
        </li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-laptop"></i>
            <span>UI Elements</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="pages/UI/general.html"><i class="fa fa-circle-o"></i> General</a></li>
            <li><a href="pages/UI/icons.html"><i class="fa fa-circle-o"></i> Icons</a></li>
            <li><a href="pages/UI/buttons.html"><i class="fa fa-circle-o"></i> Buttons</a></li>
            <li><a href="pages/UI/sliders.html"><i class="fa fa-circle-o"></i> Sliders</a></li>
            <li><a href="pages/UI/timeline.html"><i class="fa fa-circle-o"></i> Timeline</a></li>
            <li><a href="pages/UI/modals.html"><i class="fa fa-circle-o"></i> Modals</a></li>
          </ul>
        </li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-edit"></i> <span>Forms</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="pages/forms/general.html"><i class="fa fa-circle-o"></i> General Elements</a></li>
            <li><a href="pages/forms/advanced.html"><i class="fa fa-circle-o"></i> Advanced Elements</a></li>
            <li><a href="pages/forms/editors.html"><i class="fa fa-circle-o"></i> Editors</a></li>
          </ul>
        </li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-table"></i> <span>Tables</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="pages/tables/simple.html"><i class="fa fa-circle-o"></i> Simple tables</a></li>
            <li><a href="pages/tables/data.html"><i class="fa fa-circle-o"></i> Data tables</a></li>
          </ul>
        </li>
        <li>
          <a href="pages/calendar.html">
            <i class="fa fa-calendar"></i> <span>Calendar</span>
            <span class="pull-right-container">
              <small class="label pull-right bg-red">3</small>
              <small class="label pull-right bg-blue">17</small>
            </span>
          </a>
        </li>
        <li>
          <a href="pages/mailbox/mailbox.html">
            <i class="fa fa-envelope"></i> <span>Mailbox</span>
            <span class="pull-right-container">
              <small class="label pull-right bg-yellow">12</small>
              <small class="label pull-right bg-green">16</small>
              <small class="label pull-right bg-red">5</small>
            </span>
          </a>
        </li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-folder"></i> <span>Examples</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="pages/examples/invoice.html"><i class="fa fa-circle-o"></i> Invoice</a></li>
            <li><a href="pages/examples/profile.html"><i class="fa fa-circle-o"></i> Profile</a></li>
            <li><a href="pages/examples/login.html"><i class="fa fa-circle-o"></i> Login</a></li>
            <li><a href="pages/examples/register.html"><i class="fa fa-circle-o"></i> Register</a></li>
            <li><a href="pages/examples/lockscreen.html"><i class="fa fa-circle-o"></i> Lockscreen</a></li>
            <li><a href="pages/examples/404.html"><i class="fa fa-circle-o"></i> 404 Error</a></li>
            <li><a href="pages/examples/500.html"><i class="fa fa-circle-o"></i> 500 Error</a></li>
            <li><a href="pages/examples/blank.html"><i class="fa fa-circle-o"></i> Blank Page</a></li>
            <li><a href="pages/examples/pace.html"><i class="fa fa-circle-o"></i> Pace Page</a></li>
          </ul>
        </li> -->
        <!-- <li class="treeview">
          <a href="#">
            <i class="fa fa-share"></i> <span>Multilevel Menu</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="#"><i class="fa fa-circle-o"></i> Level One</a></li>
            <li>
              <a href="#"><i class="fa fa-circle-o"></i> Level One
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>
              <ul class="treeview-menu">
                <li><a href="#"><i class="fa fa-circle-o"></i> Level Two</a></li>
                <li>
                  <a href="#"><i class="fa fa-circle-o"></i> Level Two
                    <span class="pull-right-container">
                      <i class="fa fa-angle-left pull-right"></i>
                    </span>
                  </a>
                  <ul class="treeview-menu">
                    <li><a href="#"><i class="fa fa-circle-o"></i> Level Three</a></li>
                    <li><a href="#"><i class="fa fa-circle-o"></i> Level Three</a></li>
                  </ul>
                </li>
              </ul>
            </li>
            <li><a href="#"><i class="fa fa-circle-o"></i> Level One</a></li>
          </ul>
        </li> -->
        <!-- <li><a href="documentation/index.html"><i class="fa fa-book"></i> <span>Documentation</span></a></li>
        <li class="header">LABELS</li>
        <li><a href="#"><i class="fa fa-circle-o text-red"></i> <span>Important</span></a></li>
        <li><a href="#"><i class="fa fa-circle-o text-yellow"></i> <span>Warning</span></a></li>
        <li><a href="#"><i class="fa fa-circle-o text-aqua"></i> <span>Information</span></a></li> -->
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>
