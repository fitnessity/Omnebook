@extends('layouts.business.header')

<link rel='stylesheet' type='text/css' href="{{url('/public/css/frontend/general.css')}}">
<link rel='stylesheet' type='text/css' href="{{url('/public/css/frontend/custom.css')}}">

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

<div class="business-offer-main claimyour-business" style="background-image: url(../img/claim-a-business-design.jpg);">
    <div class="firststp-claim">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-12 col-12 col-md-offset-1">
                    <div class="frm-claim">
                        <!--<img src="<?php echo Config::get('constants.FRONT_IMAGE'); ?>businessclaim.png">-->
                        <h1>Let’s look up your business</h1>
                        <p>Your business may already be on Fitnessity. Type in your business name. It will come up automtically if it's listed already. if not, you can add it now.</p>
                        <div class="formfield-block">
                            <input id="business_name" style="margin-top:10px;" type="text" class="form-control" placeholder="Your Business Name Here" />
                            <div id="option-box">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-5 col-md-12 col-12">
                    <div class="claim-rightblock">
                        <h2>Why Should I Claim?</h2>
                        <p><i class="fa fa-check"></i> Respond to reviews from customers</p>
                        <p><i class="fa fa-check"></i> Direct messaging with potential customers</p>
                        <p><i class="fa fa-check"></i> Update your company details</p>
                        <p><i class="fa fa-check"></i> Complete a background check so your profile shows verified and claimed.</p>
                        <p><i class="fa fa-check"></i> Upload photos and videos</p>
                        <p><i class="fa fa-check"></i> Showcase your business to millions of customers looking activities and service you offer for free</p>
                        <p><i class="fa fa-check"></i> Receive leads, free marketing and bookings</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- <div class="modal fade opnmodal" tabindex="-1" role="dialog" aria-labelledby="gridSystemModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="gridSystemModalLabel"></h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12 text-center"> 
                        <a class="btn btn-red" onclick="doLogin()">Login</a>
                        <a class="btn btn-red" onclick="doOnBoard()">OnBoarded Process</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
 -->
@include('layouts.business.footer')

<script>
	function redirect_to_detail()
	{ 
         window.location.href = '{{route('onboard_process.welcome')}}';
        /*if ("{{Auth::check()}}") {
            var  check = 'login';
            var redirect ="/business-welcome";   
        }else{
            var  check = 'not';
            var redirect ="/userlogin";  
        }

        $.ajax({
            url: "/set-unset-session-business-welcome"+"/"+check,
            type:"GET",
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            success:function(response){
                window.location.href = redirect;
            },
        });*/
           
		//window.location="claim-your-business-detail";
	}

    $(document).ready(function() {
        /* City Name */
        $("#pac-input1").keyup(function() {
            var _token = $('input[name="_token"]').val();
            $.ajax({
                type: "POST",
                url: "/searchactioncity",
                data: {query: $(this).val(), _token: _token },
                beforeSend: function() {
                    //$("#label").css("background","#FFF url(LoaderIcon.gif) no-repeat 165px");
                },
                success: function(data) {
                    $("#city-box").show();
                    $("#city-box").html(data);
                    $("#pac-input1").css("background", "#FFF");
                }
            });
        });

        $(document).on('click', '.searchclickcity', function() {
            $("#pac-input1").val($(this).attr('data-num'));
            $("#city-box").hide();
        });

        /* Business Name */
        $("#business_name").keyup(function() {
            $.ajax({
                type: "POST",
                url: "/searchbussinessaction",
                data: { query: $(this).val(),  _token: '{{csrf_token()}}', },
                beforeSend: function() {
                    //$("#label").css("background","#FFF url(LoaderIcon.gif) no-repeat 165px");
                },
                success: function(data) {
                    $("#option-box").show();
                    $("#option-box").html(data);
                    $("#business_name").css("background", "#FFF");
                }
            });
        });
    
    })

</script>

<script>
    var globalCid;
    var globalStatus;
    function searchclick(status,cid){
        $("#business_name").val($(this).attr('data-num'));
        $("#option-box").hide();
        globalCid = cid; // Store cid in the global variable
        globalStatus = status; // Store cid in the global variable
        if ("{{Auth::check()}}") {
            if(status == 0){
                window.location.href = "claim-your-business-detail"+"/"+cid;
            }else{
                window.location.href = "already-claim-business";
            }
        }else{
            if(status == 1){
                window.location.href = "already-claim-business";
            }else{
                /*$('.opnmodal').modal('show');*/
                doLogin(cid);
            }
        }
    }

    /*function doOnBoard(){
        var url = '{{route('onboard_process.welcome',['cid' => 'cidval'])}}'
        url = url.replace('cidval' ,globalCid );
        window.location.href = url
        //window.location.href = "/onboard_process?cid="+globalCid;
    }*/


    function doLogin(cid){
        $.ajax({
            url: "/set-session-for-claim/"+cid+"/"+globalStatus,
            type:"GET",
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            success:function(response){
                window.location.href = "/userlogin?cid="+cid;
            },
        });
    }

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

