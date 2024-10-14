@extends('layouts.header')
@section('content')
@include('layouts.userHeader')
<style>
    .avatar {
        vertical-align: middle;
        width: 70px;
        height: 70px;
        border-radius: 50%;
    }
    .texttr{
        text-transform:capitalize;
    }
</style>
<div class="p-0 col-md-12 inner_top padding-0">
    <div class="row">
        
        <div class="col-md-2" style="background: black;">
        	@include('business.businessSidebar')
            <?php /*?><div class="navbar1">
                <a href="{{route('business-welcome')}}"><div class="navlink1" id="tab1">Welcome</div></a>
                <a href="{{route('createNewBusinessProfile')}}"><div class="navlink1" id="tab2">Company Details</div></a>
                <a href="{{route('createNewBusinessProfile')}}"><div class="navlink1" id="tab3">Your Experience</div></a>
                <a href="{{route('createNewBusinessProfile')}}"><div class="navlink1" id="tab4">Company Specifics</div></a>
                <a href="{{route('createNewBusinessProfile')}}"><div class="navlink1" id="tab5">Set Your Terms</div></a>
                <a href="{{route('createNewBusinessProfile')}}"><div class="navlink1" id="tab6">Get Verified</div></a>
                <a href="{{route('createNewBusinessProfile')}}"><div class="navlink1" id="tab7">Create Services & Prices</div></a>
                <a href="{{route('createNewBusinessProfile')}}"><div class="navlink1" id="tab8">Booking Info</div></a>
            </div><?php */?>
        </div>
        {{-- @include('business.leftNavigation') --}}

		<?php if(false){?>
		<div class="col-md-10">


                <div class="container-fluid p-0" id="comp-info">
                    <div class="tab-hed">Create Your Business Profile</div>
                    <hr style="border: 15px solid black;width: 104%;margin-left: -38px;">
                    <form id="frmWelcome" name="frmWelcome" method="post" action="{{route('addbstep')}}">
                    @csrf
                    <input type="hidden" name="userid" id="userid" value="{{Auth::user()->id}}">
                    <input type="hidden" name="bstep" id="bstep1" value="2">
                    <input type="hidden" name="cid" value="0">
                    <input type="hidden" name="serviceid" value="0">
                    <section class="row">
                        <div class="col-md-12 text-center">
                            <div class="tab-hed">Welcome To <span style="color: red;">OmneBook For Business</span></div>
                        </div>
                        <div class="col-md-12 text-center">

                            <p class="tab-para1"><img src="/public/images/fitnessity_logo.png" loading="lazy"> <span style="font-size: 33px;">+</span> <img width=300 src="/public/images/stripe.jpg"></p>

                            <p class="tab-para1"><b>Your Stripe Payment Verification Process Is</b></p>
                                                        
                            <p class="tab-para1" style="color: red;"><b>Pending</b></p>
                         <!--   <p class="tab-para1">Add your business information, images, videos, services, prices, get verified by completed a background check, start getting reviews,<br/>
                                manage your customers and accounts and much more. Start receiving bookings from customers looking for activites and services your offer.</p>-->
                                
                        </div>

                        <div class="col-md-12">
                            <br/><br/><br/>
                            <div class="row">
                                <div class="col-md-6"></div>
                                <div class="col-md-6 text-right">
                                    <button type="submit" class="btn-nxt" id="next-btn">Restart <i class="fa fa-arrow-right"></i></button>
                                </div>
                            </div>
                            <br/>
                        </div>
                    </section>
                    </form>
                    
                    <?php /*?><section class="row">
                        <?php
						
                        $loggedinUser = Auth::user();
                        $customerName = $loggedinUser->firstname . ' ' . $loggedinUser->lastname;
                        $profilePicture = $loggedinUser->profile_pic;
                        ?>
                        @if(isset($company) && !empty($company[0]))
                        <div class="col-md-12 text-center">
                            <div class="tab-hed">Manage Company</div>
                        </div>
                        @foreach($company as $cp => $comp)
                        
                        <div class="col-md-6" style="padding-bottom:50px">
                        <form id="frmCompany<?=$cp?>" name="frmCompany<?=$cp?>" method="post" action="{{route('editBusinessProfile')}}">
                            @csrf
                            <input type="hidden" name="cid" value="{{ $comp->id }}" />
                            <input type="hidden" name="serviceid" value="{{ $comp->serviceid }}" />
                            <div class="network_block nw-profile_block">
                                <div class="row">
                                    <div class="nw-user-detail-block">
                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 nw-user-detail">
                                            <div class="row">
                                                <div class="col-lg-3 col-md-3 col-sm-3">
                                                    <img src="{{url('/').'/public/uploads/profile_pic/thumb/'.$comp->logo}}" alt="Avatar" class="avatar" onerror="this.onerror=null;this.src='https://www.fitnessity.co/public/images/default-avatar.png';">
                                                </div>
                                                <div class="col-lg-5 col-md-5 col-sm-5">
                                                    <p class="texttr">{{$comp->dba_business_name}}</p>
                                                    <p class="texttr">{{$comp->first_name}} {{$comp->last_name}}</p>
                                                </div>
                                                <div class="col-lg-2 col-md-2 col-sm-2">
                                                    <input type="submit" class="btn btn-info" name="btnedit" id="btnedit" value="Edit" />
                                                </div>
                                                <div class="col-lg-2 col-md-2 col-sm-2">
                                                    <input type="submit" class="btn btn-info" name="btnview" id="btnview" value="View" />
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                        </div>
                        
                        @endforeach
                        @endif
                    </section><?php */?>
                </div>
          
        </div>
		<?php }else{ ?>
        <div class="col-md-10">


                <div class="container-fluid p-0" id="comp-info">
                    <div class="tab-hed">Create Your Business Profile</div>
                    <hr style="border: 15px solid black;width: 104%;margin-left: -38px;">
                    <form id="frmWelcome" name="frmWelcome" method="post" action="{{route('addbstep')}}">
                    @csrf
                    <input type="hidden" name="userid" id="userid" value="{{Auth::user()->id}}">
                    <input type="hidden" name="bstep" id="bstep1" value="2">
                    <input type="hidden" name="cid" value="0">
                    <input type="hidden" name="serviceid" value="0">
                    <input type="hidden" name="gostripe" value="1">
                    <section class="row">
                        <div class="col-md-12 text-center">
                            <div class="tab-hed">Welcome To <span style="color: red;">OmneBook For Business</span></div>
                        </div>
                        <div class="col-md-12 text-center">
                            <div class="tab-para">INTRODUCE YOURSELF, YOUR BUSINESS, SERVICES & PRODUCTS TO THE WORLD! </div>
                            <br/>
                            <p class="tab-para1">Your business profile is your first point of contact for your current and potential clients.
You can offer your services online, at your place of business, or on the go. Start by adding your business information, images, videos, services, and prices and <br/><br/>Once you're done setting up, you're ready to start
receiving bookings from customers looking for the activities and services you offer.</p>

                            <p class="tab-para1"><b>How to Start Your Onboarding Process with OmneBook</b></p>
                            <p class="tab-para1"><b>Step 1.</b> Get started by setting up your account with stripe and tell us how you want to get paid.</p>
                                                        
                            <p class="tab-para1" style="color: red;"><b>*Things to know*</b></p>
                         <!--   <p class="tab-para1">Add your business information, images, videos, services, prices, get verified by completed a background check, start getting reviews,<br/>
                                manage your customers and accounts and much more. Start receiving bookings from customers looking for activites and services your offer.</p>-->
                                
                        </div>
                        <div class="col-md-12" style="margin-left:25%">
                        	<ul>
                                	<li>OmneBook partners with stripe to handle all merchant transactions and payouts to providers like you.</li>
                                    <li>After you are done with the stripe process, it can take up to 5 minutes to get verified with stripe.</li>
                               	</ul>
                        </div>

                        <div class="col-md-12 text-center">
                            <p class="tab-para1"><br/><b>Step 2.</b> Once you are verified and done with stripe, you will continue your onboarding process with OmneBook and gain access to start tell us more about what you do.</p>
                        </div>
                        <div class="col-md-12">
                            <br/><br/><br/>
                            <div class="row">
                                <div class="col-md-6"></div>
                                <div class="col-md-6 text-right">
                                    <button type="submit" class="btn-nxt" id="next-btn">Get Started <i class="fa fa-arrow-right"></i></button>
                                </div>
                            </div>
                            <br/>
                        </div>
                    </section>
                    </form>
                    
                    <?php /*?><section class="row">
                        <?php
						
                        $loggedinUser = Auth::user();
                        $customerName = $loggedinUser->firstname . ' ' . $loggedinUser->lastname;
                        $profilePicture = $loggedinUser->profile_pic;
                        ?>
                        @if(isset($company) && !empty($company[0]))
                        <div class="col-md-12 text-center">
                            <div class="tab-hed">Manage Company</div>
                        </div>
                        @foreach($company as $cp => $comp)
                        
                        <div class="col-md-6" style="padding-bottom:50px">
                        <form id="frmCompany<?=$cp?>" name="frmCompany<?=$cp?>" method="post" action="{{route('editBusinessProfile')}}">
                            @csrf
                            <input type="hidden" name="cid" value="{{ $comp->id }}" />
                            <input type="hidden" name="serviceid" value="{{ $comp->serviceid }}" />
                            <div class="network_block nw-profile_block">
                                <div class="row">
                                    <div class="nw-user-detail-block">
                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 nw-user-detail">
                                            <div class="row">
                                                <div class="col-lg-3 col-md-3 col-sm-3">
                                                    <img src="{{url('/').'/public/uploads/profile_pic/thumb/'.$comp->logo}}" alt="Avatar" class="avatar" onerror="this.onerror=null;this.src='https://www.fitnessity.co/public/images/default-avatar.png';">
                                                </div>
                                                <div class="col-lg-5 col-md-5 col-sm-5">
                                                    <p class="texttr">{{$comp->dba_business_name}}</p>
                                                    <p class="texttr">{{$comp->first_name}} {{$comp->last_name}}</p>
                                                </div>
                                                <div class="col-lg-2 col-md-2 col-sm-2">
                                                    <input type="submit" class="btn btn-info" name="btnedit" id="btnedit" value="Edit" />
                                                </div>
                                                <div class="col-lg-2 col-md-2 col-sm-2">
                                                    <input type="submit" class="btn btn-info" name="btnview" id="btnview" value="View" />
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                        </div>
                        
                        @endforeach
                        @endif
                    </section><?php */?>
                </div>
          
        </div>
        <?php } ?>

    </div>
</div>

@include('layouts.footer')

@endsection
