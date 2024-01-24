@inject('request', 'Illuminate\Http\Request')
@extends('layouts.header')
@section('content')
<meta name="csrf-token" content="{{ csrf_token() }}" />

<?php 

$msg = '';
if(!empty(@$response)){
    print_r($response);
    $msg = $response['msg'];
}
?>
<section class="register ptb-65" style="background-image: url({{ asset('public/images/register-bg.jpg')}})">
    <div class="container">
        <div class="col-lg-6 col-md-6 col-sm-7 col-xs-12">
            <div class="register_wrap" id="signup_normal">
                <input type="hidden" id="showstep" value="">
                <div class="logo-my">
                    <a href="javascript:void(0)"> <img src="{{ asset('public/images/logo-small.jpg')}}"> </a>
                </div>               
                <form method="post" action="{{route('auth/userlogin')}}">
                    {{ csrf_field() }}
                    <div class="pop-title ftitle1">
                        <h3>Welcome to fitnessity</h3>
                    </div>
                    <br/> 


                    @if(session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    @if($msg != '')
                        <div id='systemMessage' class="alert-class alert-danger">{{ $msg }}</div>
                    @endif
                    <input type="hidden" name="redirect" value="{{$request->redirect}}">
                    <input type="email" name="email" id="email" class="myemail" size="30" autocomplete="off" placeholder="e-MAIL" maxlength="80" autocomplete="off">
                    <span class="text-danger cls-error" id="erremail"></span> 
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
                        <a href="{{ Config::get('constants.SITE_URL') }}/login/facebook" class="fb-login">
                            <i class="fa fa-facebook" aria-hidden="true"></i> Login with Facebook
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
</section>

@include('layouts.footer')
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

   /* function LoginUser() {
        var validForm = $('#frmlogin').valid();
        var posturl = '{{route("auth/userlogin")}}';
        if (validForm) {
            var formData = $("#frmlogin").serialize();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: posturl,
                type: 'POST',
                dataType: 'json',
                data: formData,
                beforeSend: function () {
                    $('#login_submit').prop('disabled', true).css('background','#999999');
                    showSystemMessages('#systemMessage', 'info', 'Please wait while we login you with Fitnessity.');
                    $("#systemMessage").html('Please wait while we login you with Fitnessity.').addClass('alert-class alert-danger');
                },
                complete: function () {
                    $('#login_submit').prop('disabled', false).css('background','#ed1b24');
                },
                success: function(response) {
                    $("#systemMessage").html(response.msg).addClass('alert-class alert-danger');
                    showSystemMessages('#systemMessage', response.type, response.msg);
                    if (response.type == 'success') {
                        //window.location = 'profile/viewProfile';
                        if(response.claim  == 'set'){
                            window.location.href = "/claim/reminder/"+response.claim_cname+"/"+response.claim_cid;
                        }else if(response.claim_welcome != ''){
                            window.location.href = "/business-welcome";
                        }else if(response.claim_company != ''){
                            window.location.href = "/manage/company";
                        }else{
                            window.location.href = "{{ route('profile-viewProfile')}}";
                        }
                    } else {
                        $('#login_submit').prop('disabled', false).css('background','#ed1b24');
                    }
                }
            });
        }
    }*/
</script>
@endsection

