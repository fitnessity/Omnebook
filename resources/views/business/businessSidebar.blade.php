<div class="navbar1">
                <div class="row businessprofile-navigationlink">
                <div>SET UP</div>
                <?php
				$companyId = $Companyname = $Address = $City = $State = $ZipCode = $Country = $EINnumber = $Establishmentyear = $Businessusername = $Profilepic = $Firstnameb = $Lastnameb = $Emailb = $Phonenumber = $Aboutcompany = $Shortdescription = $EmbedVideo = "";

               	if(isset($business_details) || request()->business_id){
                	if(isset($business_details['cid']) && !empty($business_details['cid'])) {
                    	$companyId = $business_details['cid'];
                   	}

                  if(request()->business_id){
                    $companyId = request()->business_id;
                  }
				}

				

				?>
				<?php if(!$companyId){?>
                <a href="{{route('business-welcome')}}" class="businesslink @if(Route::current()->getName()=='business-welcome') active @endif"><div class="navlink1" id="tab1">Welcome</div></a>
                <?php }?>

				<?php if($companyId){?>
                <a @if($companyId!='') onclick="linkJump(2);" @else href="{{route('createNewBusinessProfile')}}" @endif class="businesslink @if(Route::current()->getName()=='createNewBusinessProfile') active @endif"><div class="navlink1" id="tab2">Business Details</div></a>
                
                <a @if($companyId!='') onclick="linkJump(3);" @else href="{{route('createNewBusinessProfile')}}" @endif><div class="navlink1" id="tab3">Your Experience</div></a>
                <a @if($companyId!='') onclick="linkJump(4);" @else href="{{route('createNewBusinessProfile')}}" @endif><div class="navlink1" id="tab4">Company Specifics</div></a>
                <a @if($companyId!='') onclick="linkJump(5);" @else href="{{route('createNewBusinessProfile')}}" @endif><div class="navlink1" id="tab5">Set Your Terms</div></a>
                <?php /*?><a @if($companyId!='') onclick="linkJump(6);" @else href="{{route('createNewBusinessProfile')}}" @endif><div class="navlink1" id="tab6">Get Verified</div></a><?php */?>
                <a @if($companyId!='') onclick="linkJump(7);" @else href="{{route('createNewBusinessProfile')}}" @endif><div class="navlink1" id="tab7">Create/Manage Services</div></a>
               <?php /*?> <a @if($companyId!='') onclick="linkJump(8);" @else href="{{route('createNewBusinessProfile')}}" @endif><div class="navlink1" id="tab8">Booking Info</div></a><?php */?>
			   <?php }?>
                </div>
				<?php if($companyId){?>
                <div class="row businessprofile-navigationlink">
                    <div>BOOKING DETAILS</div>
                    <a href="{{route('stripe-dashboard')}}" target="_blank"><div class="navlink1" id="tab1">Financial Dashboard</div></a>                    
                    <?php  ?>
                  <!--  <a href="{{route('scheduler_checkin')}}"><div class="navlink1 @if(Route::current()->getName()=='scheduler-checkin') tab-active @endif" id="tab1">Manage Schedule</div></a>-->
                    <a href="{{route('activity-scheduler')}}"><div class="navlink1 @if(Route::current()->getName()=='manage-scheduler') tab-active @endif" id="tab1">Manage Bookings</div></a>
                    <a href="{{route('business_customer_index', ['business_id' => $companyId])}}"><div class="navlink1 @if(Route::current()->getName() == 'business_customer_index') tab-active @endif" id="tab1">Customers</div></a>
                    <!--<a href="{{route('business-welcome')}}"><div class="navlink1" id="tab1">Calendar</div></a>

                    <a href="{{route('business-welcome')}}"><div class="navlink1" id="tab1">Checkout Register</div></a>-->
                    <?php  ?>
               	</div>
			   <?php }?>
            </div>