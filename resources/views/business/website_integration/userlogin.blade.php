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
    <link rel="stylesheet" type="text/css" href="{{ url('/public/css/all.css')}}">
</head>
<style>
    body { font-family: Arial, sans-serif; margin: 0; padding: 0px; overflow: hidden;margin:0px;}
     input { display: block; margin: 10px 0; padding: 5px; width: 100%; }
     button { display: block; margin: 10px 0; padding: 5px; width: 100%; }
     #loom-companion-mv3{
         display: none;
     }
     .password-addon i {
        right: 0 !important;
        top: 0;
        position: absolute;
        min-height: 45px;
        padding: 12px;
        color: #04344d;
        background: none;
        border: none;
    }
    .poweredby-ul img{
        margin: 20px 0px 20px 0; 
        width: 240px;
    }
    .poweredby-ul{
        text-align: center;
    }
    .register_wrap .logo-my {
        text-align: center;
        margin-bottom: 45px;
        margin-top: 35px;
    }
    .register_wrap form{padding: 0 50px;}
</style>
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
    <div id="your-login-widget-containers">
    </div>
    <section class="register height-vh" id="registerSection" style="background-image: url('{{ $backgroundImgUrl }}');">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-12 col-sm-7 col-xs-12">
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
                                    <img src="{{ asset('public/images/omnebook.png') }}" alt="Fitnessity"
                                        loading="lazy">
                                @endif
                            </a>
                        </div>
                        <form method="post" action="#" id="myForm">
                            {{ csrf_field() }}
                            <div class="pop-title ftitle1">
                                {{-- <h3>Welcome to <br> fitnessity</h3> --}}
                                <h3>{{$code->company_name}}</h3>
                            </div>
                            <br />
                            @if (session('success'))
                                <div class="alert alert-success">
                                    {{ session('success') }}
                                </div>
                            @endif

                                <div id='systemMessage' class="alert-class alert-danger fs-14 font-red">
                                </div>                            
                            <input type="hidden" name="redirect" value="{{ $request->redirect }}">
                            <input type="email" name="email" id="email" class="myemail" size="30"
                                autocomplete="off" placeholder="e-MAIL" maxlength="80" autocomplete="off">
                            <span class="text-danger cls-error fs-14" id="erremail"></span>
                            <div class="position-relative auth-pass-inputgroup">
                                <input class="password-input" type="password" name="password" id="password" size="30" placeholder="Password" autocomplete="off">
                                <button class="btn-link position-absolute password-addon toggle-password" type="button" id="password-addon" style="width:10%"><i class="fas fa-eye"></i></button>
                            </div>
                            <span class="text-danger cls-error" id="errpass"></span>
                            {{-- <div class="remembermediv terms-wrap">
                                <input type="checkbox" id="remember" name="remember" checked
                                    class="remembercheckbox" />
                                <span for="remember" class="rememberme">Remember me</span>
                            </div> --}}
                            <?php echo /* form_password($password);*/ $show_captcha = ''; ?>
                            <div id='capchaimg'><?php if ($show_captcha) { ?><?php echo $captcha_html; ?><?php } ?></div>
                            <?php if ($show_captcha) { ?> <?php echo form_input($captcha); ?> <?php } ?>
                            @php
                            $logBgColor = isset($companyinfo) && is_object($companyinfo)
                                ? $companyinfo->log_bg_color
                                : '#defaultBackgroundColor';
                            $logTextColor = isset($companyinfo) && is_object($companyinfo)
                                ? $companyinfo->log_textcolor
                                : '#defaultTextColor';
                        @endphp
                        
                        <button class="btn signup-new" id="login_submit" type="submit"
                            style="background-color: {{ $logBgColor }}; color: {{ $logTextColor }}; border: 1px solid {{ $logBgColor }};">
                            Log in
                        </button>
                        
                            {{-- <a class="forgotpass" data-behavior="ajax_html_modal"
                                data-url="{{ route('jsModalpassword') }}">Forgot Password?</a> --}}
                            {{-- <p class="already">Don't have an account? --}}
                                {{-- @if (@$onboardCid)
                                    <a
                                        href="{{ Config::get('constants.SITE_URL') }}/welcome_provider?cid={{ @$onboardCid }}">SIGN
                                        UP</a>
                                @else --}}
                                    {{-- <a href="{{ Config::get('constants.SITE_URL') }}/registration">SIGN UP</a> --}}
                                {{-- @endif --}}
                                <p class="already">Don't have an account?
                                    <a href="#" id="signUpLink">SIGN UP</a>
                                </p>
                                <div class="poweredby-ul">
                                    <img src="https://dev.fitnessity.co//public/dashboard-design/images/powered-by-OMNEBOOK.png" alt="" >
                                </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Modal structure -->
        <div class="modal fade registerModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-xl" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Register</h5>
                        <button type="button" class="btn-close" onclick="window.location.reload()"></button>
                    </div>
                    <div class="modal-body register_page"></div>
                </div>
              </div>
        </div>
    <!-- {{--end modal --}} -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script>
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
            });
    </script>
        <script>
            var companyInfo = @json($companyinfo->id ?? 'null');
            var code = {{$code->id ?? 'null'}};
            $('#myForm').submit(function(event) {
                event.preventDefault();
                var form = document.getElementById('myForm');
                var formData = new FormData(form);
                formData.append('company_info', companyInfo);
                formData.append('code', code);

                $.ajax({
                    url:'https://dev.fitnessity.co/api/auth/user',
                    method: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        if(response.type=='success')
                        {
                            $('.register').css('display','none');
                            localStorage.setItem('customer',response.customer);
                            storeToken(response.token);
                            dashboard(response.token,code);
                        }               
                        if(response.type=='not_exists')
                        {
                            $('.register').css('display','block');
                            $('#systemMessage').removeClass('alert-danger alert-success').addClass(response.type == 'not_exists' ? 'alert-danger' : 'alert-success').text(response.msg).show();                              
                        } 
                        if(response.type=='register')
                        {
                            $('.register').css('display','block');
                            $('#systemMessage').removeClass('alert-danger alert-success').addClass(response.type == 'register' ? 'alert-danger' : 'alert-success').text(response.msg).show();                              
                        }      
                    },
                    error: function(xhr, status, error) {
                        alert('Your form was not sent successfully.');
                        console.error(error);
                    }
                });
            });
        </script>   

        <script>
            let dashboardExecuted = false;
            let retryCount = 0;
            const maxRetries = 1; 
            const retryDelay = 1000; 
            function dashboard(token,code)
            { 
                // if (localStorage.getItem('dashboardExecuted') === 'true') return;
                var customer = localStorage.getItem('customer');
                    const url = `https://dev.fitnessity.co/api/customer_dashboard?token=${encodeURIComponent(token)}&code=${encodeURIComponent(code)}&customer_id=${encodeURIComponent(customer)}`;
                    tryPostMessage(url);
                    localStorage.setItem('dashboardExecuted', 'true');
            }        
            function tryPostMessage(url) 
            {
                try {
                    window.parent.postMessage({ type: 'changeSrc', src: url }, '*');
                } catch (error) {
                    if (retryCount < maxRetries) {
                        retryCount++;
                        console.warn(`Retrying to postMessage... Attempt ${retryCount}`);
                        setTimeout(() => tryPostMessage(url), retryDelay); 
                    } else {
                        console.error("Failed to postMessage after multiple attempts. Please check the iframe.");
                    }
                }
            }
            
            function storeToken(token) {
                localStorage.setItem('authToken', token);
                localStorage.setItem('loggedin', true);
                var companyInfo = @json($code->id ?? null);
                localStorage.setItem('bussiness_id',companyInfo);
            }
            document.addEventListener('DOMContentLoaded', function() {
            window.addEventListener("load", (event) => {
                var tokenc = localStorage.getItem('authToken');
                var status =  localStorage.getItem('loggedin');
                var code = {{$code->id ?? 'null'}};  
              
                // new start

                if (status !== null && status !== undefined && tokenc !== null) {
                localStorage.setItem('dashboardExecuted', 'false');                
                if (localStorage.getItem('dashboardExecuted') === 'true') return;
                document.getElementById('registerSection').style.display = 'none';
                // Make an AJAX request to verify the token
                fetch('/api/check-token', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'Authorization': `Bearer ${tokenc}`
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.valid) {
                        document.getElementById('registerSection').style.display = 'none';
                        dashboard(tokenc, code);
                    } else {
                        document.getElementById('registerSection').style.display = 'block';

                    }
                })
                .catch(error => {
                    console.error('Error verifying token:', error);
                });
            }


                // end

            });
        });
      

     </script>
      <script src="https://dev.fitnessity.co/public/dashboard-design/js/bootstrap.bundle.min.js"></script>
      <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
        <script>
            $('#signUpLink').on('click', function(e) {
                e.preventDefault();
                var code = @json($code->unique_code);
                var htmlContent = '<div id="your-register-widget-container" data-unique-code="' + code + '"></div>';            
                $('.register_page').html(htmlContent);            
                $.getScript("https://dev.fitnessity.co/public/js/websiteintegration/register-widget.js")
                    .done(function(script, textStatus) {
                        console.log("Script loaded successfully.");
                        $('.registerModal').modal('show');
                    })
                    .fail(function(jqxhr, settings, exception) {
                        console.log("Script loading failed.");
                    });
            });
        </script>

</body>
</html>
