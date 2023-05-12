@inject('request', 'Illuminate\Http\Request')
@extends('layouts.header')
@section('content')
<meta name="csrf-token" content="{{ csrf_token() }}" />

<section class="register ptb-65" style="background-image: url({{ asset('public/images/register-bg.jpg')}})">
    <div class="container">
        <div class="col-lg-6 col-md-6 col-sm-7 col-xs-12">
            <div class="register_wrap" id="signup_normal">
                <input type="hidden" id="showstep" value="">
                <div class="logo-my">
                    <a href="javascript:void(0)"> <img src="{{ asset('public/images/logo-small.jpg')}}"> </a>
                </div>               
                <form method="post" action="">
                    {{ csrf_field() }}
                    <div class="pop-title ftitle1 staff-login">
                        <h3>Welcome to fitnessity</h3>
						<h3> for business</h3>
                    </div>
                    <br/> 
					<div class="pop-title ftitle1 staff-login">	
						<h3>Staff Login Only</h3>
					</div>
                    
                    <div id='systemMessage' class="alert-class alert-danger"></div>
                    <input type="search" name="search" id="search" class="myemail" size="30" autocomplete="off" placeholder="Seach Company Name" maxlength="80" autocomplete="off">
                    <input type="email" name="email" id="email" class="myemail" size="30" autocomplete="off" placeholder="e-MAIL" maxlength="80" autocomplete="off">
                    <span class="text-danger cls-error" id="erremail"></span>                    
                    <input type="password" name="password" id="password" size="30" placeholder="Password" autocomplete="off">
                    <span class="text-danger cls-error" id="errpass"></span>   
					<div class="row">
						<div class="col-md-6">
							<div class="remembermediv terms-wrap remember-staff">
								<input type="checkbox" id="remember" name="remember" checked class="remembercheckbox" />
								<span for="remember" class="rememberme staff-remember">Remember me</span>
							</div>
						</div>
						<div class="col-md-6">
							<div class="staff-pass">
								<a class="forgot-pass">Forgot Password?</a>
							</div>
						</div>
					</div>

                    <button class="btn signup-new" id='login_submit' type="submit">Log in </button>
                    
                    <div class="small-logo">
						<img src="{{ asset('public/images/fit-logo.png')}}">
					</div>
                </form>
            </div>
        </div>
    </div>
</section>

@include('layouts.footer')
@endsection