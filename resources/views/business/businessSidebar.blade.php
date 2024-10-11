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

@if (!$companyId)
	<div class="navbar1">
	  <div class="row businessprofile-navigationlink">
	  	<div class="sidebar-title">
	  		<a style="float:inherit" href="{{route('manageCompany')}}">(switch)</a>
	  	</div>
			<div class="sidebar-menu-custom">
				<ul>
					<li>
						<span><img src="/public/img/home.png" alt="Fitnessity" loading="lazy"></span>
						<a href="{{route('business_dashboard')}}">DASHBOARD</a>
					</li>
					<li>
						<span><img src="/public/img/company-set-up.png" alt="Fitnessity" loading="lazy"></span>
						<a>COMPANY SET UP</a>
						<a href="{{route('business-welcome')}}" class="businesslink @if(Route::current()->getName()=='createNewBusinessProfile') active @endif"><div class="navlink1" id="tab2">Welcome</div></a>
						<a href="/businessjumps/2/{{$companyId}}" class="businesslink @if(Route::current()->getName()=='createNewBusinessProfile') active @endif"><div class="navlink1" id="tab2">Company Details</div></a>
						<a href="/businessjumps/3/{{$companyId}}" class="businesslink @if(Route::current()->getName()=='createNewBusinessProfile') active @endif"><div class="navlink1" id="tab3">Your Experience</div></a>
						<a href="/businessjumps/4/{{$companyId}}" class="businesslink @if(Route::current()->getName()=='createNewBusinessProfile') active @endif"><div class="navlink1" id="tab4">Company Specifics</div></a>
						<a href="/businessjumps/5/{{$companyId}}" class="businesslink @if(Route::current()->getName()=='createNewBusinessProfile') active @endif"><div class="navlink1" id="tab5">Set Your Terms</div></a>
						<a href="/businessjumps/6/{{$companyId}}" class="businesslink @if(Route::current()->getName()=='createNewBusinessProfile') active @endif"><div class="navlink1" id="tab6">Get Verified</div></a>
					</li>
					<li>
						<span><img src="/public/img/service-price.png" alt="Fitnessity" loading="lazy"></span>
						<a @if($companyId!='') onclick="linkJump(7);" @else href="{{route('createNewBusinessProfile')}}" @endif><div class="navlink1 service-price" id="tab7">SERVICES & PRICES</div></a>
					</li>
					<li>
						<span><img src="/public/img/manage-company.png" alt="Fitnessity" loading="lazy"></span>
						<a>MANAGE</a>
						@if($companyId)
							<a href="{{route('business.schedulers.index')}}"><div class="navlink1 @if(Route::current()->getName()=='business.schedulers.index') tab-active @endif" id="tab9">Manage Bookings</div></a>
							<a href="{{route('business.services.index')}}"><div class="navlink1 @if(Route::current()->getName() == 'business.services.index') tab-active @endif" id="">Manage Service</div></a>
							<a href="{{route('business.products.index')}}"><div class="navlink1 @if(Route::current()->getName() == 'business.products.index') tab-active @endif">Add/Manage Product</div></a>
							<a href="{{route('business.staff.index')}}"><div class="navlink1 @if(Route::current()->getName() == 'business.staff.index') tab-active @endif" id="">Add/Manage Staff</div></a>
						@endif
					</li>
					@if($companyId)
					<li>
						<span><img src="/public/img/clients.png" alt="Fitnessity"></span>
						<a href="{{route('business_customer_index')}}" class="@if(Route::current()->getName() == 'business_customer_index' || Route::current()->getName() == 'business_customer_show') tab-active @endif"><div class="navlink1 service-price " id="tab12">CLIENTS</div></a>
					</li>
					@endif
					<li>
						<span><img src="/public/img/email1.png" alt="Fitnessity" loading="lazy"></span>
						<a href="{{route('booking_request')}}" class="@if(Route::current()->getName() == 'booking_request') tab-active @endif">INBOX</a>
					</li>
					<li>
						<span><img src="/public/img/calender.png" alt="Fitnessity" loading="lazy"></span>
						<a href="{{route('provider_calendar')}}" class="@if(Route::current()->getName() == 'provider_calendar' ) tab-active @endif">CALENDAR</a>
					</li>
					<li>
						<span><img src="/public/img/financial-dash.png" alt="Fitnessity" loading="lazy"></span>
						<a href="{{route('stripe-dashboard')}}" target="_blank"><div class="navlink1 service-price" id="tab1">FINANCIAL DASHBOARD</div></a> 
					</li>
					<li>
						<span><img src="/public/img/checkout-register.png" alt="Fitnessity" loading="lazy"></span>
						<a @if($companyId) href="{{ route('business.orders.create', [ 'book_id'=>'0']) }}"   @endif class="@if(Route::current()->getName()=='business.orders.create') tab-active @endif"><div class="navlink1 service-price " id="tab1" >CHECKOUT REGISTER</div></a>
					</li>
					<li>
						<span><img src="/public/img/salesreports.png" alt="Fitnessity" loading="lazy"></span>
						<a>SALES REPORTS</a>
					</li>
				</ul>
			</div>
	  </div>
 	</div>
@else
<div class="navbar1">
  <div class="row businessprofile-navigationlink">
  	<div class="sidebar-title">
  		{{Auth::user()->current_company->dba_business_name}} <a style="float:inherit" href="{{route('manageCompany')}}">(switch)</a>
  	</div>
		<div class="sidebar-menu-custom">
			<ul>
				<li>
					<span><img src="{{url('/public/img/home.png')}}" alt="Fitnessity" loading="lazy"></span>
					<a href="{{route('business_dashboard')}}">DASHBOARD</a>
				</li>
				<li>
					<span><img src="{{url('/public/img/company-set-up.png')}}" alt="Fitnessity" loading="lazy"></span>
					<a>COMPANY SET UP</a>
					<!-- <a href="{{route('business-welcome')}}">Welcome</a> -->
					<a href="/businessjumps/2/{{$companyId}}" class="businesslink @if(Route::current()->getName()=='createNewBusinessProfile') active @endif"><div class="navlink1" id="tab2">Company Details</div></a>
					<a href="/businessjumps/3/{{$companyId}}" class="businesslink @if(Route::current()->getName()=='createNewBusinessProfile') active @endif"><div class="navlink1" id="tab3">Your Experience</div></a>
					<a href="/businessjumps/4/{{$companyId}}" class="businesslink @if(Route::current()->getName()=='createNewBusinessProfile') active @endif"><div class="navlink1" id="tab4">Company Specifics</div></a>
					<a href="/businessjumps/5/{{$companyId}}" class="businesslink @if(Route::current()->getName()=='createNewBusinessProfile') active @endif"><div class="navlink1" id="tab5">Set Your Terms</div></a>
					<a href="/businessjumps/6/{{$companyId}}" class="businesslink @if(Route::current()->getName()=='createNewBusinessProfile') active @endif"><div class="navlink1" id="tab6">Get Verified</div></a>
				</li>
				<li>
					<span><img src="{{url('/public/img/service-price.png')}}" alt="Fitnessity" loading="lazy"></span>
					<a @if($companyId!='') onclick="linkJump(7);" @else href="{{route('createNewBusinessProfile')}}" @endif><div class="navlink1 service-price" id="tab7">SERVICES & PRICES</div></a>
				</li>
				<li>
					<span><img src="{{url('/public/img/manage-company.png')}}" alt="Fitnessity" loading="lazy"></span>
					<a>MANAGE</a>
					@if($companyId)
						<a href="{{route('business.schedulers.index')}}"><div class="navlink1 @if(Route::current()->getName()=='business.schedulers.index') tab-active @endif" id="tab9">Manage Bookings</div></a>
						<a href="{{route('business.services.index')}}"><div class="navlink1 @if(Route::current()->getName() == 'business.services.index') tab-active @endif" id="">Manage Service</div></a>
						<a href="{{route('business.products.index')}}"><div class="navlink1 @if(Route::current()->getName() == 'business.products.index') tab-active @endif">Add/Manage Product</div></a>
						<a href="{{route('business.staff.index')}}"><div class="navlink1 @if(Route::current()->getName() == 'business.staff.index') tab-active @endif" id="">Add/Manage Staff</div></a>
					@endif
				</li>
				@if($companyId)
				<li>
					<span><img src="{{url('/public/img/clients.png')}}" alt="Fitnessity" loading="lazy"></span>
					<a href="{{route('business_customer_index')}}" class="@if(Route::current()->getName() == 'business_customer_index' || Route::current()->getName() == 'business_customer_show') tab-active @endif"><div class="navlink1 service-price " id="tab12">CLIENTS</div></a>
				</li>
				@endif
				<li>
					<span><img src="{{url('/public/img/email1.png')}}" alt="Fitnessity" loading="lazy"></span>
					<a href="{{route('booking_request')}}" class="@if(Route::current()->getName() == 'booking_request') tab-active @endif">INBOX</a>
				</li>
				<li>
					<span><img src="{{url('/public/img/calender.png')}}" alt="Fitnessity" loading="lazy"></span>
					<a href="{{route('provider_calendar')}}" class="@if(Route::current()->getName() == 'provider_calendar' ) tab-active @endif">CALENDAR</a>
				</li>
				<li>
					<span><img src="{{url('/public/img/financial-dash.png')}}" alt="Fitnessity" loading="lazy"></span>
					<a href="{{route('stripe-dashboard')}}" target="_blank"><div class="navlink1 service-price" id="tab1">FINANCIAL DASHBOARD</div></a> 
				</li>
				<li>
					<span><img src="{{url('/public/img/checkout-register.png')}}" alt="Fitnessity" loading="lazy"></span>
					<a href="{{ route('business.orders.create', [ 'book_id'=>'0']) }}" class="@if(Route::current()->getName()=='business.orders.create') tab-active @endif"><div class="navlink1 service-price " id="tab1">CHECKOUT REGISTER</div></a>
				</li>
				<li>
					<span><img src="{{url('/public/img/salesreports.png')}}" alt="Fitnessity" loading="lazy"></span>
					<a>SALES REPORTS</a>
				</li>
			</ul>
		</div>
  </div>
	
 </div>
@endif


 <div class="advertise text-center">

	<label>BUSINESS MEMBERSHIP TYPE</label>
	<br/>
	<span>Pay-As-You Go</span> 
</div>
			
<script>
  function linkJump(bstep) {
      var cid = '<?=$companyId?>';
     // if(cid!='') {
          location.href = '/businessjumps/'+bstep+'/'+cid;
     // }
  }
</script>