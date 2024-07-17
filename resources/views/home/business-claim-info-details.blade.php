@extends('layouts.business.header')
@section('content')
<head>
    <link rel='stylesheet' type='text/css' href="{{env('APP_URL')}}<?php echo Config::get('constants.FRONT_CSS'); ?>frontend/general.css">
    <link rel='stylesheet' type='text/css' href="{{env('APP_URL')}}<?php echo Config::get('constants.FRONT_CSS'); ?>css/responsive.css">
</head>
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

    .Alertred{
        color: red;
    }
    
</style>
<?php
    use App\CompanyInformation;
    $phone_number = $extension = $email = $user = $activePlan ='';
    $val = "null";
    $data = CompanyInformation::where('id',$cid)->first();
   
    if($data != ''){
        $phone_number = $data->business_phone;
        if($phone_number === $val || $phone_number == ''){
            $phone_number =  '';
        }else{
            $phone_number =  $data->business_phone;
        }

        $email =  $data->business_email;
        if($email === $val || $email == '' ){
            $email = '';
        }else{
            $arr_email = explode("@", $email);
            $extension = 'username@'.$arr_email[1];
        }

        if(Auth::check()){
            $user = Auth::user();
        }

        if($user){
            $user->update(['show_step' =>1]);
            $activePlan = $user->CustomerPlanDetails()->where('amount','!=',0)->whereDate('expire_date','>=',date('Y-m-d'))->whereDate('starting_date','<=',date('Y-m-d'))->latest()->first();
        }
    }
?>
<div class="claiming-section claimyour-business" style="background-image: url(../img/claim-a-business-design.jpg);">

    <div class="container">
		<div class="row">
        <div class="col-lg-6 col-md-12 col-12 claiming-business-block">

            <h3>CLAIMING YOUR BUSINESS LISTING</h3>

            <p>
                Let's get started! By continuing, you agree to Fitnessity's <a href="{{url('/terms-condition')}}"> Terms of Service</a> and Fitnessity's <a href="{{url('/privacy-policy')}}">Privacy Policy</a>. You are claiming as <b>{{Auth::user()->email}}</b>.You represent that you are the owner/representative to claim this account on behalf of this business. 
            </p>

            <h5>How Would You Would Like to Verify Ownership of {{$data->dba_business_name}}</h5>
            @if($user && !$activePlan) 
                <!-- <h3 class="fs-16 font-red">You have no active plan. Please <a href="{{route('choose-plan.index')}}" >buy plan.</a></h3>   -->

                <h3 class="fs-16 font-red">You have no active plan. Please buy plan.</h3>
            @endif
            <div id="error-email" style="display: none">
                <h5 class="Alertred">Your Email Is Not Match With Our Data. You Can't Claim This Business..</h5>
            </div>
            <input type="hidden" name="cid" id="cid" value="{{$cid}}">
            @if($email != '')
            <div class="claiming-boxn">
                <h4><i class="fa fa-envelope" aria-hidden="true"></i> EMAIL ME</h4>
                <p>Fitnessity will send a verification email to the email address below. Please check your email to verify.</p>
                <form id="varify_email_for_claim">
                    @csrf
                    <div class="form-group">
                        <span>Send email to:</span>
                        <input type="text" name="email_id" id="email_id" class="form-control" placeholder="{{$extension}}" required="">
                       <!--  <span>@gmail.com</span> -->
                        <span class="text-danger" id="email-error"></span>
                    </div>
                    <button type="submit" value="Send" class="btnsend" @if($user && !$activePlan) disabled @endif >Send</button>
                </form>
            </div>
            @endif

            <div id="error-phone" style="display: none"><h5 class="Alertred">We Can't Message on Your Phone Number..</h5></div>

            @if($phone_number != '')
            <div class="claiming-boxn twon">
                <h4><i class="fa fa-mobile" aria-hidden="true"></i> TEXT ME</h4>
                <p>Fitnessity will send a 4-digit verification code via SMS, You'll submit this code on the next screen.</p>
                <form id="varify_phone_for_claim">
                    <div class="form-group">
                        <span>Send text to: +1 {{$phone_number}}</span>
                        <input type="hidden" name="phone_num" id="phone_num" class="form-control" value="{{$phone_number}}">
                    </div>
                    <button type="submit" value="Send" class="btnsend" @if($user && !$activePlan) disabled @endif >Send</button>
                </form>
                <br>
                <!-- <h5>Note: Please add Your Country Code before Phone Number.</h5> -->
            </div>
            @endif

            @if($phone_number != '')
            <div id="error-call" style="display: none"><h5 class="Alertred">We Can't Call On Your Phone Number..</h5></div>
            <div class="claiming-boxn twon">
                <h4><i class="fas fa-phone-alt" aria-hidden="true"></i> CALL ME</h4>
                <p>Fitnessity will call you and with a verification code will be displayed on the next screen. Submit this code using your phone.</p>
                <form id="varify_call_for_claim">
                    @csrf
                    <div class="form-group">
                        <span>Call this number: + 1 {{$phone_number}}</span>
                       <!-- <input type="number" name="" id="" class="form-control" placeholder="555-555-5555">-->
                    </div>
                    <button type="submit" value="Send" class="btnsend" @if($user && !$activePlan) disabled @endif >Send</button>
                </form>
            </div> 
            @endif
        </div>

        <div class="col-lg-6 col-md-12 col-12 claiming-business-block-right">

            <p>
                Claim your business or create a new profile today for free! Update your profile so we can showcase what you do to everyone looking for your services.
            </p>

            <img src="{{ url('public/img/claim-your-business-detail.jpg') }}" alt="Fitnessity">

        </div>
		</div>
    </div>

</div>
@include('layouts.business.footer')

<script>
    $(document).ready(function () {

        $('#varify_email_for_claim').on('submit',function(e){
            e.preventDefault();
            var _token = $("input[name='_token']").val();
            var email = $('#email_id').val();
            var cid = $('#cid').val();
            var type_enter = "email";
            $.ajax({
                url: "/varify-email-for-claim-business",
                type:"POST",
                headers: {'X-CSRF-TOKEN': _token},
                data:{
                    val:email,
                    cid:cid,
                    type_enter:type_enter
                },
                success:function(response){
                    if(response == 'Success'){
                        window.location.href = '/business-claim-varification/'+cid+'/'+type_enter;
                    }else{
                        $('#error-email').show();
                    }
                },
            });
        }); 

        $('#varify_phone_for_claim').on('submit',function(e){
            e.preventDefault();
            var _token = $("input[name='_token']").val();
            var phone = $('#phone_num').val();
            var cid = $('#cid').val();
            var type_enter = "phone";
            $.ajax({
                url: "/varify-email-for-claim-business",
                type:"POST",
                headers: {'X-CSRF-TOKEN': _token},
                data:{
                    val:phone,
                    cid:cid,
                    type_enter:type_enter
                },
                success:function(response){
                    if(response == 'Success'){
                        window.location.href = '/business-claim-varification/'+cid+'/'+type_enter;
                    }else{
                        $('#error-phone').show();
                    }
                },
            });
        });

        $('#varify_call_for_claim').on('submit',function(e){
            e.preventDefault();
            var _token = $("input[name='_token']").val();
            var phone = $('#phone_num').val();
            var cid = $('#cid').val();
            var type_enter = "call";
            $.ajax({
                url: "/varify-email-for-claim-business",
                type:"POST",
                headers: {'X-CSRF-TOKEN': _token},
                data:{
                    val:phone,
                    cid:cid,
                    type_enter:type_enter
                },
                success:function(response){
                    if(response == 'Success'){
                        window.location.href = '/business-claim-varification/'+cid+'/'+type_enter;
                    }else{
                        $('#error-call').show();
                    }
                },
            });
        });

        $("document").on("click", "#makeloginpopup", function () {
            console.log("gggggg")
            $("#loginbtn").click();
        })

        $('#business_name').keyup(function () {
            $.ajax({
                url: '/get-my-location-business?location=' + $('#pac-input1').val() + '&business_name=' + $('#business_name').val(),
                type: 'GET',
                beforeSend: function () {
                    $('.loader').show();
                    //showSystemMessages('#systemMessage', 'info', 'Please wait while we create a company with Fitnessity.');
                },
                complete: function () {
                    // $('.loader').hide();ccccccc
                    // $('.s_form').prop('disabled', false);
                },
                success: function (response) {
                    $('.loader').hide();
                    showSystemMessages('#systemMessage', response.type, response.msg);
                    if (response.status == 200) {
                        var str = '';
                        var check = "{{Auth::check()}}";
                        if (check == false) {
                            str = str + '<div class="option topsec-opt" style="padding-left:10px;"><div class="col-sm-12 text-left"><span>My Business isn\'t here</span> <a  type="button" data-toggle="modal" data-target="#login_modal" href="/auth/jsModallogin" class="addnewclaim-btn" id="makeloginpopup">Add New</button></div></div><br/>';
                        }
                        if (response.search_data2.length != 0 && response.search_data.length != 0) {
                            response.search_data2.forEach(function (value, key) {
                                var mysrc = "{{Config::get('constants.USER_IMAGE_THUMB')}}"
                                str = str + '<div class="option" style="padding-left:10px;" onclick="setValueInput(\'' + value.business_name + ' ' + value.location + '\',' + value.id + ',\'claimed\');"><div class="col-sm-12 row"><div class="col-sm-2"><img src="' + mysrc + '/' + value.logo + '" style="width:30px;height:30px;" alt="Fitnessity" /></div><div>' + value.business_name + '&nbsp;' + value.location + '</div></div></div>';
                                if (key + 1 == response.search_data2.length) {
                                    response.search_data.forEach(function (value, key) {
                                        var mysrc = "{{Config::get('constants.FRONT_IMAGE')}}"
                                        str = str + '<div class="option" style="padding-left:10px;" onclick="setValueInput(\'' + value.business_name + ' ' + value.location + '\',' + value.id + ',\'unclaimed\');"><div class="col-sm-12 row"><div  class="col-sm-2"><img src="' + mysrc + '/business_large_square.png' + '" style="width:30px;height:30px;" alt="Fitnessity" /></div><div>' + value.business_name + '&nbsp;' + value.location + '</div></div></div>';
                                        if (key + 1 == response.search_data.length) {
                                            $('#option-box').empty();
                                            $('#option-box').append(str);
                                            $('.option').show()
                                        }
                                    })
                                }
                            })
                        } else {
                            response.search_data2.forEach(function (value, key) {
                                var mysrc = "{{Config::get('constants.USER_IMAGE_THUMB')}}"
                                str = str + '<div class="option" style="padding-left:10px;" onclick="setValueInput(\'' + value.business_name + ' ' + value.location + '\',' + value.id + ',\'claimed\');"><div class="col-sm-12 row"><div class="col-sm-2"><img src="' + mysrc + '/' + value.logo + '" style="width:30px;height:30px;" alt="Fitnessity" /></div><div>' + value.business_name + '&nbsp;' + value.location + '</div></div></div>';
                                if (key + 1 == response.search_data2.length) {
                                    $('#option-box').empty();
                                    $('#option-box').append(str);
                                    $('.option').show()
                                }
                            })
                            response.search_data.forEach(function (value, key) {
                                var mysrc = "{{Config::get('constants.FRONT_IMAGE')}}"
                                str = str + '<div class="option" style="padding-left:10px;" onclick="setValueInput(\'' + value.business_name + ' ' + value.location + '\',' + value.id + ',\'unclaimed\');"><div class="col-sm-12 row"><div  class="col-sm-2"><img src="' + mysrc + '/business_large_square.png' + '" style="width:30px;height:30px;" alt="Fitnessity" /></div><div>' + value.business_name + '&nbsp;' + value.location + '</div></div></div>';
                                if (key + 1 == response.search_data.length) {
                                    $('#option-box').empty();
                                    $('#option-box').append(str);
                                    $('.option').show()
                                }
                            })
                        }
                        //   response.search_data2.forEach(function(value,key){
                        //       var mysrc = "{{Config::get('constants.USER_IMAGE_THUMB')}}"
                        //       str=str+'<div class="option" style="padding-left:10px;" onclick="setValueInput(\''+value.business_name +' '+ value.location+'\','+value.id+',\'claimed\');"><div class="col-sm-12 text-left"><img src="'+mysrc+'/'+value.logo+'" style="width:30px;height:30px;" />&nbsp;'+value.business_name+'&nbsp;'+value.location+'</div></div>';
                        //       if(key+1 ==  response.search_data2.length){
                        //           if( response.search_data.length == 0)
                        //             $('#option-box').empty();
                        //           $('#option-box').append(str);
                        //           $('.option').show()
                        //       }
                        //   })

                        //   response.search_data.forEach(function(value,key){
                        //       str=str+'<div class="option" style="padding-left:10px;" onclick="setValueInput(\''+value.business_name +' '+ value.location+'\','+value.id+',\'unclaimed\');"><div class="col-sm-12 text-left"><i class="fa fa-building" style="color:red; aria-hidden="true"></i>&nbsp;'+value.business_name+'&nbsp;'+value.location+'</div></div>';
                        //       if(key+1 ==  response.search_data.length){

                        //           $('#option-box').empty();
                        //           $('#option-box').append(str);
                        //           $('.option').show()
                        //       }
                        //   })
                        //   response.search_data2.forEach(function(value,key){
                        //       var mysrc = "{{Config::get('constants.USER_IMAGE_THUMB')}}"
                        //       str=str+'<div class="option" style="padding-left:10px;" onclick="setValueInput(\''+value.business_name +' '+ value.location+'\','+value.id+',\'claimed\');"><div class="col-sm-12 text-left"><img src="'+mysrc+'/'+value.logo+'" style="width:30px;height:30px;" />&nbsp;'+value.business_name+'&nbsp;'+value.location+'</div></div>';
                        //       if(key+1 ==  response.search_data2.length){
                        //           if( response.search_data.length == 0)
                        //             $('#option-box').empty();
                        //           $('#option-box').append(str);
                        //           $('.option').show()
                        //       }
                        //   })
                    }
                }
            });


            // console.log("aaaaa")
            // $('.option').show()
        })
    })

</script>
<script>
    function setValueInput(setValueInput1, valueid, type) {

        if (type == 'unclaimed') {
            if ("{{Auth::check()}}") {
                document.getElementById('pac-input1').value = setValueInput1
                window.location.href = '/get-business-detail/' + valueid
            } else {
                console.log("1")
                localStorage.setItem('custom_url', '/get-business-detail/' + valueid);

                document.getElementById('login_modal').modal();
                return;
            }
        } else {
            if ("{{Auth::check()}}") {
                window.location.href = '/pcompany/view/' + valueid;
            } else {
                localStorage.setItem('custom_url', '/pcompany/view/' + valueid);
                document.getElementById('login_modal').modal();
                return;
            }
        }
    }

</script>
@endsection
