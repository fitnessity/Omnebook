@extends('layouts.header')
@section('content')

<div class="business-offer-main" style="padding: 20px;
     padding-left: 35%;">

    @if(!empty($data))
    <ul>
        <li>Business Name : {{$data->business_name}}</li>
        <li>Activity : {{$data->activity}}</li>
        <li>Website : {{$data->website}}</li>
        <li>Location : {{$data->location}}</li>
        <li>Phone : {{$data->phone}}</li>
        <li>Address : {{$data->address}}</li>
    </ul>
    @else
    <h5 class="text-center">No record found.</h5>
    @endif
</div>

<div class="business-offer-main claimyour-business">
    <div class="secondstp-claim">
        <div class="container">
            @if(\Session::has('msg'))
            <p class="alert alert-danger">{{ \Session::get('msg') }}</p>
            @endif



            @if(isset($mail_sent) && $mail_sent == 0)
            <div class="row">
                <div class="col-sm-12">
                    <div class="alert-claim">
                        @if(Auth::check())
                        <div class="alert-message">
                            You’re claiming this business using your account associated with <strong>{{Auth::user()->email}}</strong>. To use another account to claim, <a class="logout-link" id="login_here" href="javascript:;">click here</a>.
                        </div>
                        @endif
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="claimleft-wrap">
                        <h1>Choose How You Would Like to Verify</h1>
                        <p> By continuing, you agree to Fitnessity’s <a href="{{'/terms-condition'}}" target="_blank">Terms of Service</a> and acknowledge Fitnessity’s <a href="{{'/privacy-policy'}}" target="_blank">Privacy Policy</a>. You also represent that you have the authority to claim this account on behalf of this business. </p>
                        <p><strong>How would you like to verify?</strong></p>
                        <!--<form action="#">-->
                        <div class="wraparrange">
                            <div class="arrange_unit_icon">
                                <i class="fa fa-envelope"></i>
                            </div>
                            <div class="arrange_unit">
                                <button type="submit" value="submit" class=""><span>Email me at ...<span class="">{{ isset($data->email) ? $data->email : ''}}</span></span></button>
                                <div class="u-space-t1">
                                    Fitnessity will send a verification email to work email address below. Please check your email to verify.
                                </div><br>
                                <div class="u-space-t1">
                                    <div class="row">
                                        <form method="post" id="myform" action={{url('/make-verify-busiess-link')}}>
                                            <div class="col-sm-6">
                                                <input type="text" class="form-control" name="business_email" placeholder="username" />
                                            </div>
                                            <div class="col-sm-4 email_cont_page">
                                                <h5>{{ isset($data->website) ? $data->website : '' }}</h5>
                                            </div>
                                            <div class="col-sm-2">
                                                {!! csrf_field() !!}
                                                <input type="hidden" name="business_id" value="{{ isset($data->id) ? $data->id : 0}}" />
                                                <button type="submit" id="mailsendbtn" class="btn btn-primary">Send</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="wraparrange">
                        <div class="arrange_unit_icon">
                            <i class="fa fa-mobile"></i>
                        </div>
                        <div class="arrange_unit">
                            <form method="post" id="myform1" action={{url('/make-verify-busiess-link-via-phone-msg')}}>
                                {!! csrf_field() !!}
                                <input type="hidden" name="mobile_number" value="{{ isset($data->phone) ? $data->phone : ''}}" />
                                <input type="hidden" name="business_id" value="{{ isset($data->id) ? $data->id : 0}}" />
                                <button type="submit" value="submit" class=""><span>Text me at <span class="">{{ isset($data->phone) ? $data->phone : ''}}</span></span></button>
                            </form>
                            <div class="u-space-t1">
                                Fitnessity will send a 4-digit verification code via SMS. You’ll submit this code on the next screen.
                            </div>
                        </div>
                    </div>
                    <div class="wraparrange">
                        <div class="arrange_unit_icon">
                            <i class="fa fa-phone"></i>
                        </div>
                        <div class="arrange_unit">
                            <form method="post" id="myform2" action={{url('/make-verify-busiess-link-via-phone-call')}}>
                                {!! csrf_field() !!}
                                <input type="hidden" name="mobile_number" value="{{ isset($data->phone) ? $data->phone : ''}}" />
                                <input type="hidden" name="business_id" value="{{ isset($data->id) ? $data->id : 0 }}" />
                                <button type="submit" value="submit" class=""><span>Call me at <span class="">{{ isset($data->phone) ? $data->phone : ''}}</span></span></button>
                            </form>
                            <div class="u-space-t1">
                                Fitnessity will call you and a verification code will be displayed on the next screen. Submit this code using your phone.
                            </div>
                        </div>
                    </div>
                    <!--</form>-->
                    <p>If this phone number is incorrect you can <a href="javascript:;">add an extension</a> or <a href="javascript:;">change the business phone number</a>.</p>

                </div>
            </div>
            <div class="col-md-6">
                <div class="claimright-wrap">
                    <div class="right-boxclaim-inner">
                        <div class="photo-box">
                            <img alt="Fitnessity" class="photo-box-img" height="90" src="<?php echo Config::get('constants.FRONT_IMAGE'); ?>business_90_square.png" width="90"> 
                        </div>
                        <div class="media-title clearfix"> 
                            <strong class="biz-name">{{ isset($data->business_name) ? $data->business_name : ''}}</strong> 
                            <small> <span class="addr-city">{{ isset($data->address) ? $data->address : ''}}</span> </small>
                        </div>
                    </div>
                    <p>Not your business? <a href="{{url('/claim-your-business')}}">Search for a different business</a></p>
                </div>
            </div>
        </div>




    </div>
    @else
    @if(isset($mail_sent) && $mail_sent == 1)
    <div class="row">
        <div class="col-sm-12">
            <div class="alert-claim">

                <div class="alert-message">
                    We have sent verification link to <?php echo $email . '@' . isset($data->website) ? $data->website : ''; ?>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="claimleft-wrap">
                            <h1>Email sent, check your inbox</h1>
                            <p> To finish claiming {{$data->business_name}}, please click on the verification link that was emailed to <?php echo $email . '@' . $data->website; ?> .</p>

                            <form method="post" id="myform" action={{url('/make-verify-busiess-link')}}>
                                {!! csrf_field() !!}
                                <input type="hidden" class="form-control" name="business_email" value="{{$email}}" placeholder="username" />
                                <input type="hidden" name="business_id" value="{{ isset($data->id) ? $data->id : 0 }}" />
                                <button type="submit">Resend Verification Link</button>
                            </form>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="claimright-wrap">
                            <div class="right-boxclaim-inner">
                                <div class="photo-box">
                                    <img alt="Fitnessity" class="photo-box-img" height="90" src="<?php echo Config::get('constants.FRONT_IMAGE'); ?>business_90_square.png" width="90"> 
                                </div>
                                <div class="media-title clearfix"> 
                                    <strong class="biz-name">{{$data->business_name}}</strong> 
                                    <small> <span class="addr-city">{{$data->address}}</span> </small>
                                </div>
                            </div>
                            <p>Not your business? <a href="{{'/claim-your-business'}}">Search for a different business</a></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif
    @if(isset($msg_sent) && $msg_sent == 1)
    <div class="row">
        <div class="col-sm-12">
            <div class="alert-claim">

                <div class="alert-message">
                    We have sent OTP link to <?php echo $data->phone; ?>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="claimleft-wrap">
                            <h1>Msg sent, check your phone</h1>
                            <p> To finish claiming {{$data->business_name}}, please enter OTP that was msg to <?php echo $data->phone; ?> .</p>

                            <form method="post" id="myform" action={{url('/make-otp-busiess-link-via-sms')}}>
                                {!! csrf_field() !!}
                                <input type="hidden" class="form-control" name="business_phone" value="{{$data->phone}}" placeholder="phone" />
                                <input type="hidden" name="business_id" value="{{$data->id}}" />
                                <input type="text" name="otp" required />
                                <button type="submit">Submit OTP</button>
                            </form>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="claimright-wrap">
                            <div class="right-boxclaim-inner">
                                <div class="photo-box">
                                    <img alt="Fitnessity" class="photo-box-img" height="90" src="<?php echo Config::get('constants.FRONT_IMAGE'); ?>business_90_square.png" width="90"> 
                                </div>
                                <div class="media-title clearfix"> 
                                    <strong class="biz-name">{{$data->business_name}}</strong> 
                                    <small> <span class="addr-city">{{$data->address}}</span> </small>
                                </div>
                            </div>
                            <p>Not your business? <a href="{{'/claim-your-business'}}">Search for a different business</a></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif
    @if(isset($call_sent) && $call_sent == 1)
    <div class="row">
        <div class="col-sm-12">
            <div class="alert-claim">

                <div class="alert-message">
                    We have sent OTP link via call <?php echo $data->phone; ?>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="claimleft-wrap">
                            <h1>We have called you, check your phone</h1>
                            <p> To finish claiming {{$data->business_name}}, please enter OTP <?php echo $data->phone; ?> .</p>

                            <form method="post" id="myform" action={{url('/make-otp-busiess-link-via-sms')}}>
                                {!! csrf_field() !!}
                                <input type="hidden" class="form-control" name="business_phone" value="{{$data->phone}}" placeholder="phone" />
                                <input type="hidden" name="business_id" value="{{$data->id}}" />
                                <input type="text" name="otp" required />
                                <button type="submit">Submit OTP</button>
                            </form>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="claimright-wrap">
                            <div class="right-boxclaim-inner">
                                <div class="photo-box">
                                    <img alt="Fitnessity" class="photo-box-img" height="90" src="<?php echo Config::get('constants.FRONT_IMAGE'); ?>business_90_square.png" width="90"> 
                                </div>
                                <div class="media-title clearfix"> 
                                    <strong class="biz-name">{{$data->business_name}}</strong> 
                                    <small> <span class="addr-city">{{$data->address}}</span> </small>
                                </div>
                            </div>
                            <p>Not your business? <a href="{{'/claim-your-business'}}">Search for a different business</a></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif
    @endif
</div>
</div>
<script>
    $(document).ready(function () {

        $("#mailsendbtn").click(function () {
            $("#myform").submit();
        })

        $("#login_here").click(function () {
            $.ajax({
                url: "{{url('/make-new-logout')}}",
                type: 'get',
                beforeSend: function () {
                    $('.loader').show();
                },
                complete: function () {
                    $('.loader').hide();
                },
                success: function (response) {
                    $("#loginbtn").click();
                }
            })

        })
    })
</script>
@include('layouts.footer')
@endsection
<style>
    .col-sm-4.email_cont_page {
        margin: 8px 0;
        padding-left: 0;}
    .col-sm-4.email_cont_page h5{font-weight: bold;}
    button#mailsendbtn {
        background-color: #e0e0e0;
        color: #5f5f5fd1;
        border: 1px solid #96969670;
        border-radius: 3px;
        padding: 2px 7px 0px;
        font-weight: 500;
        margin: 4px 0px 0px;
        position: absolute;
        right: 24px;
    }
</style>