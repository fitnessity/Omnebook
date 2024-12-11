@inject('request', 'Illuminate\Http\Request')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title>Login</title>
    
    <link href="{{ url('/dashboard-design/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
    <link rel='stylesheet' type='text/css' href="{{ asset('/css/bootstrap-select.min.css') }}">
    <link href="{{ url('/public/dashboard-design/css/style.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{ url('/public/dashboard-design/css/custom.css') }}" rel="stylesheet" type="text/css" />
    {{-- <link rel='stylesheet' type='text/css' href="{{ url('/public/css/frontend/general.css') }}"> --}}
    <link rel='stylesheet' type='text/css' href="{{ url('/public/css/responsive.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ url('/public/css/all.css')}}">
    <script src="{{url('public/dashboard-design/js/jquery-3.6.4.min.js')}}"></script>
 
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
        margin-bottom: 15px;
        margin-top: 25px;
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
                            <input type="hidden" name="code" value="{{ encrypt($code->id) }}">
                            <input type="hidden" name="redirect" value="{{ $request->redirect }}">
                            <input type="email" name="email" id="email" class="myemail" size="30"
                                autocomplete="off" placeholder="e-MAIL" maxlength="80" autocomplete="off">
                            <span class="text-danger cls-error fs-14" id="erremail"></span>
                            <div class="position-relative auth-pass-inputgroup">
                                <input class="password-input" type="password" name="password" id="password" size="30" placeholder="Password" autocomplete="off">
                                <button class="btn-link position-absolute password-addon toggle-password" type="button" id="password-addon" style="width:10%"><i class="fas fa-eye"></i></button>
                            </div>
                            <span class="text-danger cls-error fs-14" id="errpass"></span>
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
    {{-- <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-xl" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Register</h5>
                        <h5 class="modal-title" id="exampleModalLabel">Register</h5>
                        <button type="button" class="btn-close" onclick="window.location.reload()"></button>
                    </div>
                    <div class="modal-body register_page"></div>
                </div>
              </div>
        </div> --}}
    {{--end modal --}}


    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Register</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="register_page">
                </div>
                
            </div>
        </div>
    </div>
    <script src="{{ url('/public/dashboard-design/js/bootstrap.bundle.min.js') }}"></script>
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
            var companyInfo = @json($companyinfo->id ?? Null);
            var code = {{$code->id ?? 'null'}};
            var csrfToken = '{{ csrf_token() }}'; 

            $('#myForm').submit(function(event) {
                event.preventDefault();
                var form = document.getElementById('myForm');
                var formData = new FormData(form);
                formData.append('company_info', companyInfo);
        
                $.ajax({
                    url: '/sub_auth_user',
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': csrfToken 
                    },

                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        if (response.type === 'success') {
                            if (response.redirect) {
                                window.location.href = response.redirect;
                            }
                        }
                        if (response.type === 'not_exists' || response.type === 'danger') {
                                $('.register').css('display', 'block');
                                $('#systemMessage').removeClass('alert-danger alert-success')
                                                .addClass('alert-danger')
                                                .text(response.msg)
                                                .show();
                            }
                    },
                    error: function(xhr, status, error) {
                                console.log('Full response:', xhr);
                                console.log('Status:', status);
                                console.log('Error:', error);
                                
                                var errorMsg = 'An error occurred: ';
                                if (xhr.responseJSON && xhr.responseJSON.msg) {
                                    errorMsg += xhr.responseJSON.msg;  
                                } else if (xhr.responseJSON && xhr.responseJSON.message) {
                                    errorMsg += xhr.responseJSON.message;  
                                } else if (xhr.responseText) {
                                    errorMsg += xhr.responseText;  
                                } else {
                                    errorMsg += error || 'Unknown error occurred.';
                                }
                            }


                });
            });
        </script>
        <script>
            $('#signUpLink').on('click', function(e) {
            e.preventDefault();
            var code = @json($code->unique_code);

            $.ajax({
                url: '/register-page',  
                method: 'GET',
                data: { unique_code: code },
                success: function(response) {
                    $('#register_page').html(response);
                    var myModal = new bootstrap.Modal(document.getElementById('exampleModal'));
                    myModal.show(); 
                },
                error: function(xhr, status, error) {
                    console.error("Error fetching register page:", error);
                }
            });
        });
        </script>
</body>
</html>
