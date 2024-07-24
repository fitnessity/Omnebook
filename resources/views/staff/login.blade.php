@inject('request', 'Illuminate\Http\Request')
@extends('layouts.business.header')
<link rel='stylesheet' type='text/css' href="{{url('/public/css/frontend/general.css')}}">
<link rel='stylesheet' type='text/css' href="{{url('/public/css/responsive.css')}}">
@section('content')


<section class="register ptb-65" style="background-image: url({{ asset('public/images/register-bg.jpg')}})">
    <div class="container">
        <div class="col-lg-6 col-md-6 col-sm-7 col-xs-12">
            <div class="register_wrap" id="signup_normal">
                <input type="hidden" id="showstep" value="">
                <div class="logo-my">
                    <a href="javascript:void(0)"> <img src="{{ asset('public/images/logo-small.jpg')}}" alt="Fitnessity"> </a>
                </div>               
                <form method="post" action="{{route('dologin')}}" >
                    {{ csrf_field() }}
                    <div class="pop-title ftitle1 staff-login">
                        <h3 id="firsth">Welcome to fitnessity</h3>
						<h3 id="secondh"> for business</h3>
                    </div>
                    <br/> 
					<div class="pop-title ftitle1 staff-login">	
						<h3>Staff Login Only</h3>
					</div>

                    @if(session('errorMsg'))
                        <div id='systemMessage' class="alert alert-class alert-danger fs-14">
                            {{ session('errorMsg') }}
                        </div>
                    @endif

                    <input type="hidden" name="cid" id="cid" value="">
                    <input type="search" name="searchCompany" id="searchCompany" class="myemail" size="30" autocomplete="off" placeholder="Seach Company Name" maxlength="80" required>

                    <input type="email" name="email" id="email" class="myemail" size="30" autocomplete="off" placeholder="e-MAIL" maxlength="80" required>
                    <span class="text-danger cls-error fs-14" id="erremail"></span>        
					<div class="position-relative auth-pass-inputgroup">
						<input class="password-input" type="password" name="password" id="password" size="30" placeholder="Password" required>

						<button class="btn-link position-absolute password-addon" type="button" id="toggle-password">
							<i class="fas fa-eye"></i>
						</button>
						<span class="text-danger cls-error fs-14" id="errpass"></span>   
					</div>
					<div class="row">
						<div class="col-md-6"></div> 
						<!-- <div class="col-md-6">
							<div class="staff-pass remembermediv">
								<a class="forgot-pass">Forgot Password?</a>
							</div>
						</div> -->
					</div>

                    <button class="btn signup-new" id='login_submit' type="submit">Log in </button>
                    <div class="small-logo">
						<img src="{{ asset('public/images/fit-logo.png')}}" alt="Fitnessity"> 
					</div>
                </form>
            </div>
        </div>
    </div>
</section>

@include('layouts.business.footer')
<script>
    $(document).ready(function () {

        $('#toggle-password').on('click', function() {
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

        var url = "{{ url('/staff_login') }}";
        $( "#searchCompany" ).autocomplete({
        source: url,
        focus: function( event, ui ) {
             return false;
        },
        select: function( event, ui ) {
            $("#searchCompany").val(ui.item.company_name);
            $("#firsth").html('Log In to Manage');
            $("#secondh").html(ui.item.company_name);
            $("#cid").val(ui.item.id);
            return false;
        }
        }).data( "ui-autocomplete" )._renderItem = function( ul, item ) {
            let profile_img = '<div class="collapse-img"><div class="company-list-text" style="height: 50px;width: 50px;"><p style="padding: 0;">' + item.company_name.charAt(0).toUpperCase() + '</p></div></div> ';

            if(item.profile_pic_url){
                profile_img = '<img class="searchbox-img" src="' + (item.profile_pic_url ? item.profile_pic_url : '') + '" style="">';            
            }

            var inner_html = '<div class="row rowclass-controller"></div><div class="y-middle staff-login-home"><div class="col-lg-3 col-md-3 col-3 text-center">' + profile_img + '</div> <div class="col-lg-9 col-md-9 col-9 div-controller"> <p class="pstyle"><label class="liaddress">' + item.company_name + '</label></p></div></div>';
       
            return $( "<li></li>" )
                .data( "item.autocomplete", item )
                .append(inner_html)
                .appendTo( ul );
        };
    });

</script>
@endsection