@inject('request', 'Illuminate\Http\Request')
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title>Login</title>
    <link rel='stylesheet' type='text/css' href="{{ url('/public/css/frontend/general.css') }}">
    <link rel='stylesheet' type='text/css' href="{{ url('/public/css/responsive.css') }}">

    <link href="{{ asset('/dashboard-design/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
    <link rel='stylesheet' type='text/css' href="{{ asset('/css/bootstrap-select.min.css') }}">
    <link href="{{ url('/public/dashboard-design/css/style.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{ url('/public/dashboard-design/css/custom.css') }}" rel="stylesheet" type="text/css" />
</head>

<body>
    <?php
    $msg = '';
    if (!empty(@$response)) {
        print_r($response);
        $msg = $response['msg'];
    }
    ?>
    @php
        $backgroundImg =
            isset($companyinfo) && is_object($companyinfo)
                ? $companyinfo->background_img
                : 'public/images/register-bg.jpg';
        $backgroundImgUrl = Storage::disk('s3')->exists($backgroundImg)
            ? asset(Storage::url($backgroundImg))
            : asset('public/images/register-bg.jpg');
    @endphp
    <div id="your-login-widget-container">
    </div>
    <section class="register height-vh" style="background-image: url('{{ $backgroundImgUrl }}');">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-7 col-xs-12">
                    <div class="register_wrap" id="signup_normal">
                        <input type="hidden" id="showstep" value="">
                        <div class="logo-my">
                            <a href="javascript:void(0)">
                                @if (isset($companyinfo) &&
                                        is_object($companyinfo) &&
                                        Storage::disk('s3')->exists($companyinfo->logo) &&
                                        $companyinfo->logo != '')
                                    <div class="item-inner">
                                        <img src="{{ Storage::disk('s3')->url($companyinfo->logo) }}" alt="Fitnessity"
                                            loading="lazy">
                                    </div>
                                @else
                                    <img src="{{ asset('public/images/logo-small.jpg') }}" alt="Fitnessity"
                                        loading="lazy">
                                @endif

                            </a>
                        </div>
                        <form method="post" action="#" id="myForm">
                            {{ csrf_field() }}
                            <div class="pop-title ftitle1">
                                <h3>Welcome to <br> fitnessity</h3>
                            </div>
                            <br />
                            @if (session('success'))
                                <div class="alert alert-success">
                                    {{ session('success') }}
                                </div>
                            @endif

                            
                                <div id='systemMessage' class="alert-class alert-danger fs-14 font-red">
                                </div>
                            
                            <input type="hidden" name="redirecthidden" id="redirecthidden" value="762788">
                            <input type="hidden" name="redirect" value="{{ $request->redirect }}">
                            <input type="email" name="email" id="email" class="myemail" size="30"
                                autocomplete="off" placeholder="e-MAIL" maxlength="80" autocomplete="off">
                            <span class="text-danger cls-error fs-14" id="erremail"></span>
                            <div class="position-relative auth-pass-inputgroup">
                                <input class="password-input" type="password" name="password" id="password"
                                    size="30" placeholder="Password" autocomplete="off">
                                <button class="btn-link position-absolute password-addon toggle-password" type="button"
                                    id="password-addon">
                                    <i class="fas fa-eye"></i>
                                </button>
                            </div>
                            <span class="text-danger cls-error" id="errpass"></span>
                            <div class="remembermediv terms-wrap">
                                <input type="checkbox" id="remember" name="remember" checked
                                    class="remembercheckbox" />
                                <span for="remember" class="rememberme">Remember me</span>
                            </div>

                            <?php echo /* form_password($password);*/ $show_captcha = ''; ?>
                            <div id='capchaimg'><?php if ($show_captcha) { ?><?php echo $captcha_html; ?><?php } ?></div>
                            <?php if ($show_captcha) { ?> <?php echo form_input($captcha); ?> <?php } ?>

                            @php
                                $logBgColor =
                                    isset($companyinfo) && is_object($companyinfo)
                                        ? $companyinfo->log_bg_color
                                        : '#defaultBackgroundColor';
                                $logTextColor =
                                    isset($companyinfo) && is_object($companyinfo)
                                        ? $companyinfo->log_textcolor
                                        : '#defaultTextColor';
                            @endphp

                            <button class="btn signup-new" id="login_submit" type="submit"
                                style="background-color: {{ $logBgColor }}; color: {{ $logTextColor }};">
                                Log in
                            </button>
                            <a class="forgotpass" data-behavior="ajax_html_modal"
                                data-url="{{ route('jsModalpassword') }}">Forgot Password?</a>
                            <p class="already">Don't have an account?
                                @if (@$onboardCid)
                                    <a
                                        href="{{ Config::get('constants.SITE_URL') }}/welcome_provider?cid={{ @$onboardCid }}">SIGN
                                        UP</a>
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
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
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

            $("#login_submit").click(function() {
                $("#erremail").html('');
                $("#errpass").html('');



                var email = $("#email");
                var pass = $("#password");


                //var hiddid = $("#your-login-widget-container").attr("data-code");
                // alert(hiddid);
                var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
                if (email.val() == "") {
                    $("#erremail").html("Please enter email address");
                    email.focus();
                    return false;
                }
                if (!regex.test(email.val())) {
                    $('#erremail').html('Please enter valid email xxx@xxx.xxx');
                    email.focus();
                    return false;
                }
                if (pass.val() == "") {
                    $("#errpass").html("Please enter password");
                    pass.focus();
                    return false;
                }
                // LoginUser();
            });
        });
    </script>
    <script>
        $(document).ready(function() {
            $('#myForm').submit(function(event) {
                event.preventDefault();
                var form = document.getElementById('myForm');
                var formData = new FormData(form);
                $.ajax({
                    url: '/auth/user',
                    method: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        console.log(response);
                        if(response.type=='success')
                        {
                            $('.register').css('display','none');
                            dashboard();
                        }               
                        if(response.type=='not_exists')
                        {
                            $('.register').css('display','block');
                            $('#systemMessage').removeClass('alert-danger alert-success').addClass(response.type == 'not_exists' ? 'alert-danger' : 'alert-success').text(response.msg).show();                              
                        }     
                    },
                    error: function(xhr, status, error) {
                        alert('Your form was not sent successfully.');
                        console.error(error);
                    }
                });
            });
        });
    </script>
    <script>
        function dashboard()
        {
            var container = $('#your-login-widget-container'); 
            $('#your-login-widget-container').css('height','100vh');
            $('#your-login-widget-container').css('overflow','hidden');
            var uniqueCode = container.attr('data-unique-code'); 
            var iframe = document.createElement('iframe');
            iframe.src = 'http://dev.fitnessity.co/customer_dashboard';
            iframe.style.border = 'none';
            iframe.style.width = '100%';
            iframe.style.height = '100%';
            
            var container = document.getElementById('your-login-widget-container');
            container.appendChild(iframe);

            window.addEventListener('message', function(event) {
                if (event.origin !== 'http://dev.fitnessity.co') return;        
                if (event.data === 'login_success') {
                    console.log('User logged in successfully');
                }
            }, false);
        }
    </script>
</body>
</html>
