<div class="navbar1">
  <div class="row businessprofile-navigationlink">
  	<div class="sidebar-title">{{Auth::user()->current_company->company_name}}</div>
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
	     <!--  <a href="{{route('business-welcome')}}" class="businesslink @if(Route::current()->getName()=='business-welcome') active @endif"><div class="navlink1" id="tab1">Welcome</div></a> -->
	  <?php }?>
		<div class="sidebar-menu-custom">
			<ul>
				<li>
					<span><img src="http://dev.fitnessity.co/public/img/home.png" alt="Fitnessity"></span>
					<a href="">DASHBOARD</a>
				</li>
				<li>
					<span><img src="http://dev.fitnessity.co/public/img/company-set-up.png" alt="Fitnessity"></span>
					<a>COMPANY SET UP</a>
					<a @if($companyId!='') onclick="linkJump(2);" @else href="{{route('createNewBusinessProfile')}}" @endif class="businesslink @if(Route::current()->getName()=='createNewBusinessProfile') active @endif"><div class="navlink1" id="tab2">Company Details</div></a>
					<a @if($companyId!='') onclick="linkJump(3);" @else href="{{route('createNewBusinessProfile')}}" @endif><div class="navlink1" id="tab3">Your Experience</div></a>
					<a @if($companyId!='') onclick="linkJump(4);" @else href="{{route('createNewBusinessProfile')}}" @endif><div class="navlink1" id="tab4">Company Specifics</div></a>
					<a @if($companyId!='') onclick="linkJump(5);" @else href="{{route('createNewBusinessProfile')}}" @endif><div class="navlink1" id="tab5">Set Your Terms</div></a>
					<a @if($companyId!='') onclick="linkJump(6);" @else href="{{route('createNewBusinessProfile')}}" @endif><div class="navlink1" id="tab6">Get Verified</div></a>
				</li>
				<li>
					<span><img src="http://dev.fitnessity.co/public/img/service-price.png" alt="Fitnessity"></span>
					<a @if($companyId!='') onclick="linkJump(7);" @else href="{{route('createNewBusinessProfile')}}" @endif><div class="navlink1 service-price" id="tab7">SERVICES & PRICES</div></a>
				</li>
				<li>
					<span><img src="http://dev.fitnessity.co/public/img/manage-company.png" alt="Fitnessity"></span>
					<a>MANAGE</a>
					<a href="{{route('activity-scheduler')}}"><div class="navlink1 @if(Route::current()->getName()=='activity-scheduler') tab-active @endif" id="tab9">Manage Bookings</div></a>
					<a href="{{route('manageCompany')}}"><div class="navlink1 @if(Route::current()->getName() == 'manageCompany') tab-active @endif" id="tab8">Manage Company</div></a>
					<a href="{{route('manageService',['company_id'=>Auth::user()->current_company->id])}}"><div class="navlink1 @if(Route::current()->getName() == 'manageService') tab-active @endif" id="">Manage Service</div></a>
					<a ><div class="navlink1" id="">Add/Manage Product</div></a>
					<a ><div class="navlink1" id="">Add/Manage Staff</div></a>
				</li>
				<li>
					<span><img src="http://dev.fitnessity.co/public/img/clients.png" alt="Fitnessity"></span>
					<a href="{{route('business_customer_index', ['business_id' => Auth::user()->current_company->id])}}" class="@if(Route::current()->getName() == 'business_customer_index' || Route::current()->getName() == 'business_customer_show') tab-active @endif"><div class="navlink1 service-price " id="tab12">CLIENTS</div></a>
				</li>
				<li>
					<span><img src="http://dev.fitnessity.co/public/img/email1.png" alt="Fitnessity"></span>
					<a href="{{route('booking_request')}}" class="@if(Route::current()->getName() == 'booking_request') tab-active @endif">INBOX</a>
				</li>
				<li>
					<span><img src="http://dev.fitnessity.co/public/img/calender.png" alt="Fitnessity"></span>
					<a href="{{route('provider_calendar')}}" class="@if(Route::current()->getName() == 'provider_calendar' ) tab-active @endif">CALENDAR</a>
				</li>
				<li>
					<span><img src="http://dev.fitnessity.co/public/img/financial-dash.png" alt="Fitnessity"></span>
					<a href="{{route('stripe-dashboard')}}" target="_blank"><div class="navlink1 service-price" id="tab1">FINANCIAL DASHBOARD</div></a> 
				</li>
				<li>
					<span><img src="http://dev.fitnessity.co/public/img/checkout-register.png" alt="Fitnessity"></span>
					<a href="{{route('activity_purchase',['book_id'=>0])}}" class="@if(Route::current()->getName()=='activity_purchase') tab-active @endif"><div class="navlink1 service-price " id="tab1">CHECKOUT REGISTER</div></a>
				</li>
				<li>
					<span><img src="http://dev.fitnessity.co/public/img/salesreports.png" alt="Fitnessity"></span>
					<a>SALES REPORTS</a>
				</li>
			</ul>
		</div>
		<?php if($companyId){?>
		    <?php /*?><a @if($companyId!='') onclick="linkJump(2);" @else href="{{route('createNewBusinessProfile')}}" @endif class="businesslink @if(Route::current()->getName()=='createNewBusinessProfile') active @endif"><div class="navlink1" id="tab2">Business Details</div></a><?php */?>
		    
		    <?php /*?><a @if($companyId!='') onclick="linkJump(3);" @else href="{{route('createNewBusinessProfile')}}" @endif><div class="navlink1" id="tab3">Your Experience</div></a><?php */?>
		    <?php /*?><a @if($companyId!='') onclick="linkJump(4);" @else href="{{route('createNewBusinessProfile')}}" @endif><div class="navlink1" id="tab4">Company Specifics</div></a><?php */?>
		    <?php /*?><a @if($companyId!='') onclick="linkJump(5);" @else href="{{route('createNewBusinessProfile')}}" @endif><div class="navlink1" id="tab5">Set Your Terms</div></a><?php */?>
		    <?php /*?><a @if($companyId!='') onclick="linkJump(6);" @else href="{{route('createNewBusinessProfile')}}" @endif><div class="navlink1" id="tab6">Get Verified</div></a><?php */?>
		    <?php /*?><a @if($companyId!='') onclick="linkJump(7);" @else href="{{route('createNewBusinessProfile')}}" @endif><div class="navlink1" id="tab7">Create/Manage Services</div></a><?php */?>
		   <?php /*?> <a @if($companyId!='') onclick="linkJump(8);" @else href="{{route('createNewBusinessProfile')}}" @endif><div class="navlink1" id="tab8">Booking Info</div></a><?php */?>
		<?php }?>
  </div>
	<?php if($companyId){?>
    <div class="row businessprofile-navigationlink">
       <?php /*?> <div>BOOKING DETAILS</div>
        <a href="{{route('stripe-dashboard')}}" target="_blank"><div class="navlink1" id="tab1">Financial Dashboard</div></a><?php */?>      
        <?php  ?>
      <!--  <a href="{{route('scheduler_checkin')}}"><div class="navlink1 @if(Route::current()->getName()=='scheduler-checkin') tab-active @endif" id="tab1">Manage Schedule</div></a>-->
        <?php /*?> <a href="{{route('activity-scheduler')}}"><div class="navlink1 @if(Route::current()->getName()=='manage-scheduler') tab-active @endif" id="tab1">Manage Bookings</div></a><?php */?>
       <?php /*?> <a href="{{route('business_customer_index', ['business_id' => $companyId])}}"><div class="navlink1 @if(Route::current()->getName() == 'business_customer_index' || Route::current()->getName() == 'business_customer_show') tab-active @endif" id="tab1">Customers</div></a><?php */?>
       <?php /*?> <a href="{{route('activity_purchase',['book_id'=>0])}}"><div class="navlink1 @if(Route::current()->getName()=='manage-scheduler') tab-active @endif" id="tab1">Check Out Register</div></a><?php */?>
        <!--<a href="{{route('business-welcome')}}"><div class="navlink1" id="tab1">Calendar</div></a>

        <a href="{{route('business-welcome')}}"><div class="navlink1" id="tab1">Checkout Register</div></a>-->
        <?php  ?>
   	</div>
<?php }?>
 </div>
			
 <div class="advertise text-center">
	<label>{{Auth::user()->current_company->company_name}}</label>
	<label>BUSINESS MEMBERSHIP TYPE</label>
	<span>Pay-As-You Go <a href="{{route('manageCompany')}}">(Change)</a> </span> 
</div>
			
<script>
  function linkJump(bstep) {
      var cid = '<?=$companyId?>';
     // if(cid!='') {
          location.href = '/businessjumps/'+bstep+'/'+cid;
     // }
  }
</script>