@inject('request', 'Illuminate\Http\Request')
@extends('layouts.business.header')
<link rel='stylesheet' type='text/css' href="{{url('/public/css/frontend/general.css')}}">
<link rel='stylesheet' type='text/css' href="{{url('/public/css/responsive.css')}}">
@section('content')
<meta name="csrf-token" content="{{ csrf_token() }}" />

<?php 

$msg = '';
if(!empty(@$response)){
    print_r($response);
    $msg = $response['msg'];
}
?>
<section class="register" style="background-image: url({{ asset('public/images/register-bg.jpg')}})">
    <div class="container">
        <div class="row">
        <div class="col-lg-6 col-md-6 col-sm-7 col-xs-12">
            <div class="register_wrap" id="signup_normal">
                <input type="hidden" id="showstep" value="">
                <div class="logo-my">
                    <a href="javascript:void(0)"> <img src="{{ asset('/public/images/omnebook.png')}}" alt="Omnebook"> </a>
                </div>               
                <form method="post" action="{{route('auth/userlogin')}}">
                    {{ csrf_field() }}
                    <div class="pop-title ftitle1">
                        <h3>Welcome to <br> Omnebook</h3>
                    </div>
                    <br/> 


                    @if(session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    @if($msg != '')
                        <div id='systemMessage' class="alert-class alert-danger  fs-14">{{ $msg }}</div>
                    @endif
                    <input type="hidden" name="redirect" value="{{$request->redirect}}">
                    <input type="email" name="email" id="email" class="myemail" size="30" autocomplete="off" placeholder="e-MAIL" maxlength="80" autocomplete="off">
                    <span class="text-danger cls-error  fs-14" id="erremail"></span> 
					<div class="position-relative auth-pass-inputgroup">
						<input class="password-input" type="password" name="password" id="password" size="30" placeholder="Password" autocomplete="off">
						<button class="btn-link position-absolute password-addon toggle-password" type="button" id="password-addon" >
							<i class="fas fa-eye"></i>
						</button>
					</div>
                    <span class="text-danger cls-error" id="errpass"></span>                    
                    <div class="remembermediv terms-wrap">
                        <input type="checkbox" id="remember" name="remember" checked class="remembercheckbox" />
                        <span for="remember" class="rememberme">Remember me</span>
                    </div>

                    <?php echo/* form_password($password);*/ $show_captcha=""; ?>
                    <div id='capchaimg'><?php if ($show_captcha) { ?><?php echo $captcha_html; ?><?php } ?></div>
                    <?php if ($show_captcha) { ?> <?php echo form_input($captcha); ?> <?php } ?>
                    <button class="btn signup-new" id='login_submit' type="submit">Log in </button>
                    <p class="or-data">OR</p>
                    <div class="social-login">
                        <a href="{{ Config::get('constants.SITE_URL') }}login/facebook" class="fb-login">
                            <i class="fab fa-facebook" aria-hidden="true"></i> Login with Facebook
                        </a>
                    </div>
                    <div class="text-center mb-10">
                        <a href="{{ Config::get('constants.SITE_URL') }}login/google" class="fb-login btn signup-new">
                            <i class="fab fa-google" aria-hidden="true"></i>   <span class="ml-10">Login with Google</span>
                        </a>
                    </div>

                    <a class="forgotpass" data-behavior="ajax_html_modal" data-url="{{route('jsModalpassword')}}">Forgot Password?</a>

                    <a class="forgotpass" href="{{route('staff_login')}}">Login For Staff Member?</a>

                    <p class="already">Don't have an account?
                        @if(@$onboardCid)
                            <a href="{{ Config::get('constants.SITE_URL') }}/welcome_provider?cid={{@$onboardCid}}">SIGN UP</a>
                        @else
                            <a href="{{ Config::get('constants.SITE_URL') }}/registration">SIGN UP</a>
                        @endif
                    </p>
                </form>
            </div>
        </div>
        </div>
    </div>
</section>

@include('layouts.business.footer')
<script>
    $(document).ready(function() {

        $('.toggle-password').on('click', function() {
            var passwordField = $('#password');
            var toggleButton = $(this);

            if (passwordField.attr('type') === 'password') {
                passwordField.attr('type', 'text');
                toggleButton.html('<i class="fas fa-eye-slash"></i>');
            } else {
                passwordField.attr('type', 'password');
                toggleButton.html('<i class="fas fa-eye"></i>');
            }
        });

        $("#login_submit").click(function(){
            $("#erremail").html('');
            $("#errpass").html('');
            var email = $("#email");
            var pass = $("#password");
            var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
            if(email.val() == "") {
                $("#erremail").html("Please enter email address");
                email.focus();
                return false;
            }
            if(!regex.test(email.val())){
                $('#erremail').html('Please enter valid email xxx@xxx.xxx');
                email.focus();
                return false;
            }
            if(pass.val() == "") {
                $("#errpass").html("Please enter password");
                pass.focus();
                return false;
            }
            // LoginUser();
        });
    });
</script>
@endsection

