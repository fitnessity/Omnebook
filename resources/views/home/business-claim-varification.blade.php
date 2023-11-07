@extends('layouts.header')
@section('content')

<style>
    #suggestions {
        -moz-box-sizing: border-box;
        box-sizing: border-box;
        border: 1px solid black;
        background-color: white;
        font-size: 12px;
    }

    .option {
        display: none;
        color: '#000';
        cursor: pointer;
        padding: 10px;
    }

    #option-box {
        font-size: 15px;
    }

</style>

<div class="claiming-section" style="margin-top:50px">
    <div class="container">
        <div class="col-md-6 claiming-business-block">
            <h3>CLAIMING YOUR BUSINESS</h3>
            <p>
                By continuing, you agree to Fitnessity's <a href="#"> Terms of Service</a> and acknowledge Fitnessity's <a href="#">Privacy Policy</a>. You also represent that you have the authority to claim this account on behalf of this business.
            </p>

            <div class="claiming-boxn">
                <h4><i class="fa fa-envelope" aria-hidden="true"></i>VERIFICATION CODE</h4>
                <form id="verify_code" class="mb-10">
                    @csrf
                    <input type="hidden" name="cid" id="cid" value="{{$cid}}">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-8">
                                <div class="">
                                    <input type="text" name="vari_code" id="vari_code" class="form-control" placeholder="Verification Code" required="">
                                </div>
                            </div>
                            <div class="col-md-4 text-right">
                                <input type="submit" value="Submit" class="btnsend">
                               
                            </div>
                            <div class="col-md-12">
                                <div class="mt-15">
                                    <a onclick="resendOtp();">Resend</a>
                                    <div class="fs-16" id="otpMsg"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
                <span class="text-danger" id="error_msg" style="display: none;">Verification code is not valid. Please enter valid code.</span>
                <br>
            </div> 
            <span class="text-danger" id="claim_error_msg" style="display: none;">Facing Issue to claim your Business .</span>
        </div>

        <div class="col-md-6 claiming-business-block-right">
            <p>
                Claim your business or create a new profile today for free! Update your profile so we can showcase what you do to everyone looking for your services.
            </p>
            <img src="{{ url('public/img/claim-d.jpg') }}">
        </div>
    </div>
</div>

@include('layouts.footer')

<script>

    $(document).ready(function () {
        $('#verify_code').on('submit',function(e){
            e.preventDefault();
            var _token = $("input[name='_token']").val();
            var code = $('#vari_code').val();
            var cid = $('#cid').val();
            $.ajax({
                url: "/varify-code-to-claim-business",
                type:"POST",
                headers: {'X-CSRF-TOKEN': _token},
                data:{
                    code:code,
                    cid:cid
                },
                xhrFields: {
                    withCredentials: true
                },

                success:function(response){
                    $('#otpMsg').html('');
                    if(response == 'Match'){
                        var url = "{{route('onboard_process.welcome',['cid' => 'val'])}}";
                        url = url.replace('val',cid);
                       window.location = url;
                    }else if(response == 'Not Match'){
                        $('#error_msg').show();
                    }else{
                        $('#claim_error_msg').show();
                    }
                    $("#verify_code")[0].reset(); 
                },
            });
        });
    })

    function resendOtp(){
        var _token = $("input[name='_token']").val();
        var cid = $('#cid').val();
        $.ajax({
            url: "/resend-otp-for-claim",
            type:"POST",
            headers: {'X-CSRF-TOKEN': _token},
            data:{
                cid:cid
            },
            success:function(response){
                $('#otpMsg').removeClass('font-red').addClass('font-green').html('Text message sent! Enter the code above.');
                /*if(response == 'success'){
                   $('#otpMsg').removeClass('font-red').addClass('font-green').html('Text message sent! Enter the code above.');
                }else{
                    $('#otpMsg').removeClass('font-green').addClass('font-red').html('Something went to wrong. Please try again');
                }*/
            },
        });
    }

</script>

@endsection

