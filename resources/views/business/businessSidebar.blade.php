<div class="navbar1">
                <div class="row businessprofile-navigationlink">
                <div>SET UP</div>
                <?php
				$companyId = $Companyname = $Address = $City = $State = $ZipCode = $Country = $EINnumber = $Establishmentyear = $Businessusername = $Profilepic = $Firstnameb = $Lastnameb = $Emailb = $Phonenumber = $Aboutcompany = $Shortdescription = $EmbedVideo = "";
               	if(isset($business_details)){
                	if(isset($business_details['cid']) && !empty($business_details['cid'])) {
                    	$companyId = $business_details['cid'];
                   	}
				}
// 				$company = CompanyInformation::where('id', $companyId)->get();

				

				?>
				<?php if(!$companyId){?>
                <a href="{{route('business-welcome')}}" class="businesslink @if(request()->route()->uri=='business-welcome') active @endif"><div class="navlink1" id="tab1">Welcome</div></a>
                <?php }?>

				<?php if($companyId){?>
                <a @if($companyId!='') onclick="linkJump(2);" @else href="{{route('createNewBusinessProfile')}}" @endif class="businesslink @if(request()->route()->uri=='createNewBusinessProfile') active @endif"><div class="navlink1" id="tab2">Business Details</div></a>
                
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
                    <?php ?>
                    <a href="{{route('activity-scheduler')}}"><div class="navlink1" id="tab1">Manage Bookings</div></a>
                    <a href="{{route('manage-customer')}}"><div class="navlink1 @if(request()->route()->uri=='manage-customer') tab-active @endif" id="tab1">Customers</div></a>
                    <a href="{{route('business-welcome')}}"><div class="navlink1" id="tab1">Calendar</div></a>

                    <a href="{{route('business-welcome')}}"><div class="navlink1" id="tab1">Checkout Register</div></a>
                    <?php ?>
               	</div>
			   <?php }?>
            </div>