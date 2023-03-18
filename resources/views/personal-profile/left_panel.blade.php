<div class="page-sidebar-wrapper">
	<ul class="list-inline menu-left mb-0">
    	<li class="float-left"><button class="button-menu-mobile open-left"><i class="fas fa-bars"></i></button></li>
   	</ul>
	<div class="left side-menu">
		<div class="slimscroll-menu" id="remove-scroll">
			<div id="sidebar-menu">
				<ul class="metismenu" id="side-menu">
                            <li class="menu-title">{{Auth::User()->firstname}}'s Account</li>

                            <li class=" {{ (request()->is('personal-profile/user-profile*')) ? 'active' : '' }}">
                                <a href="{{ Config::get('constants.SITE_URL') }}/personal-profile/user-profile">
                                    <img src="{{ url('public/img/menu-icon1.svg') }}" alt="">
                                    <span>User Profile</span>
                                </a>
                            </li>
                            <?php ?>
                            
                            <li class=" {{ (request()->is('personal-profile/calendar*')) ? 'active' : '' }}">
                                <a href="{{ Config::get('constants.SITE_URL') }}/personal-profile/calendar">
                                    <img src="{{ url('public/img/menu-icon3.svg') }}" alt="">
                                    <span>Calendar</span>
                                </a>
                            </li> <?php ?>

                            <li class=" {{ (request()->is('personal-profile/add-family*')) ? 'active' : '' }}">
                                <a href="{{ Config::get('constants.SITE_URL') }}/personal-profile/add-family">
                                    <img src="{{ url('public/img/menu-icon5.svg') }}" alt="">
                                    <span>Add Family</span>
                                </a>
                            </li>
                            <?php /*?>
                            <li class=" {{ (request()->is('personal-profile/review*')) ? 'active' : '' }}">
                                <a href="{{ Config::get('constants.SITE_URL') }}/personal-profile/review">
                                    <img src="{{ url('public/img/menu-icon6.svg') }}" alt="">
                                    <span>Reviews</span>
                                </a>
                            </li> <?php */?>

                            <li class=" {{ (request()->is('personal-profile/payment-info*')) ? 'active' : '' }}">
                                <a href="{{ Config::get('constants.SITE_URL') }}/personal-profile/payment-info">
                                    <img src="{{ url('public/img/menu-icon2.svg') }}" alt="">
                                    <span>Payment Info</span>
                                </a>
                            </li>
                            
                            
                            <li class=" {{ (request()->is('personal/orders*')) ? 'active' : '' }}">
                                <a href="{{ route('personal.orders.index')}}">
                                    <img src="{{ url('public/img/menu-icon4.svg') }}" alt="">
                                    <span>Booking Info</span>
                                </a>
                            </li>

                            <li class=" {{ (request()->is('personal-profile/favorite*')) ? 'active' : '' }}">
                                <a href="{{ Config::get('constants.SITE_URL') }}/personal-profile/favorite">
                                    <img src="{{ url('public/img/menu-icon1.svg') }}" alt="">
                                    <span>Favorite</span>
                                </a>
                            </li> 

                            <li class=" {{ (request()->is('personal-profile/followers*')) ? 'active' : '' }}">
                                <a href="{{ Config::get('constants.SITE_URL') }}/personal-profile/followers">
                                    <img src="{{ url('public/img/menu-icon1.svg') }}" alt="">
                                    <span>Followers</span>
                                </a>
                            </li>

                            <li class=" {{ (request()->is('personal-profile/following*')) ? 'active' : '' }}">
                                <a href="{{ Config::get('constants.SITE_URL') }}/personal-profile/following">
                                    <img src="{{ url('public/img/menu-icon1.svg') }}" alt="">
                                    <span>Following</span>
                                </a>
                            </li> 
                        </ul>
			</div>
		</div>
	</div>
</div>