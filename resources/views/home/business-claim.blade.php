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

<div class="business-offer-main claimyour-business" style="background-image: url(../img/claim-a-business-design.jpg);">
    <div class="firststp-claim">
        <div class="container">
            <div class="row">
                <div class="col-md-6 col-md-offset-1">
                    <div class="frm-claim">
                        <!--<img src="<?php echo Config::get('constants.FRONT_IMAGE'); ?>businessclaim.png">-->
                        <h1>Let’s look up your business</h1>
                        <p>Your business may already be on Fitnessity. Type in your business name. It will come up automtically if it's listed already. if not, you can add it now.</p>
                        <div class="formfield-block">
                            <!--<label>City Name</label>-->

                            <!-- <input id="pac-input1" type="text" class="form-control" placeholder="Search City Name" oninput="$('#option-box').empty();$('#business_name').val('');" /> -->
                           <!--  <input id="pac-input1" type="text" class="form-control" placeholder="Search City Name" />

                            <div id="city-box">

                            </div> -->
                                <!--<label>Business Name</label>-->
                                <input id="business_name" style="margin-top:10px;" type="text" class="form-control" placeholder="Your Business Name Here" />
                                <div id="option-box">
                                </div>

                            <!--<button type="button">CONTINUE</button>-->

                            <!-- <div class="addbusiness-block">
                                <p>Didn't find your business? Add it Fitnessity for Free</p>
                                <button type="button" onclick="redirect_to_detail()">Add Business</button>
                            </div> -->
                        </div>
                    </div>
                </div>

                <div class="col-md-5">
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

@include('layouts.footer')

<script>
	function redirect_to_detail()
	{ 

        if ("{{Auth::check()}}") {
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
        });
           
		//window.location="claim-your-business-detail";
	}

    $(document).ready(function() {
        $("document").on("click", "#makeloginpopup", function() {
            console.log("gggggg")
            $("#loginbtn").click();
        })

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

       /* $(document).on('click', '.searchclick', function() {
            $("#business_name").val($(this).attr('data-num'));
            $("#option-box").hide();
            var status = $("#claim_business_status").val();
            alert(status);  
            if(status == 0){
                window.location.href = "claim-your-business-detail";
            }else{

            }
        });*/

        /*$('#business_name').keyup(function() {
            $.ajax({
                url: '/get-my-location-business?location=' + $('#pac-input1').val() + '&business_name=' + $('#business_name').val(),
                type: 'GET',
                beforeSend: function() {
                    $('.loader').show();
                    //showSystemMessages('#systemMessage', 'info', 'Please wait while we create a company with Fitnessity.');
                },
                complete: function() {
                    // $('.loader').hide();ccccccc
                    // $('.s_form').prop('disabled', false);
                },
                success: function(response) {
                    $('.loader').hide();
                    showSystemMessages('#systemMessage', response.type, response.msg);
                    if (response.status == 200) {
                        var str = '';
                        var check = "{{Auth::check()}}";
                        if (check == false) {
                            str = str + '<div class="option topsec-opt" style="padding-left:10px;"><div class="col-sm-12 text-left"><span>My Business isn\'t here</span> <a  type="button" data-toggle="modal" data-target="#login_modal" href="/auth/jsModallogin" class="addnewclaim-btn" id="makeloginpopup">Add New</button></div></div><br/>';
                        }
                        if (response.search_data2.length != 0 && response.search_data.length != 0) {
                            response.search_data2.forEach(function(value, key) {
                                var mysrc = "{{Config::get('constants.USER_IMAGE_THUMB')}}"
                                str = str + '<div class="option" style="padding-left:10px;" onclick="setValueInput(\'' + value.business_name + ' ' + value.location + '\',' + value.id + ',\'claimed\');"><div class="col-sm-12 row"><div class="col-sm-2"><img src="' + mysrc + '/' + value.logo + '" style="width:30px;height:30px;" /></div><div>' + value.business_name + '&nbsp;' + value.location + '</div></div></div>';

                                if (key + 1 == response.search_data2.length) {

                                    response.search_data.forEach(function(value, key) {

                                        var mysrc = "{{Config::get('constants.FRONT_IMAGE')}}"

                                        str = str + '<div class="option" style="padding-left:10px;" onclick="setValueInput(\'' + value.business_name + ' ' + value.location + '\',' + value.id + ',\'unclaimed\');"><div class="col-sm-12 row"><div  class="col-sm-2"><img src="' + mysrc + '/business_large_square.png' + '" style="width:30px;height:30px;" /></div><div>' + value.business_name + '&nbsp;' + value.location + '</div></div></div>';

                                        if (key + 1 == response.search_data.length) {

                                            $('#option-box').empty();

                                            $('#option-box').append(str);

                                            $('.option').show()

                                        }

                                    })
                                }
                            })
                        } else {
                            response.search_data2.forEach(function(value, key) {
                                var mysrc = "{{Config::get('constants.USER_IMAGE_THUMB')}}"
                                str = str + '<div class="option" style="padding-left:10px;" onclick="setValueInput(\'' + value.business_name + ' ' + value.location + '\',' + value.id + ',\'claimed\');"><div class="col-sm-12 row"><div class="col-sm-2"><img src="' + mysrc + '/' + value.logo + '" style="width:30px;height:30px;" /></div><div>' + value.business_name + '&nbsp;' + value.location + '</div></div></div>';

                                if (key + 1 == response.search_data2.length) {

                                    $('#option-box').empty();

                                    $('#option-box').append(str);

                                    $('.option').show()

                                }
                            })

                            response.search_data.forEach(function(value, key) {

                                var mysrc = "{{Config::get('constants.FRONT_IMAGE')}}"

                                str = str + '<div class="option" style="padding-left:10px;" onclick="setValueInput(\'' + value.business_name + ' ' + value.location + '\',' + value.id + ',\'unclaimed\');"><div class="col-sm-12 row"><div  class="col-sm-2"><img src="' + mysrc + '/business_large_square.png' + '" style="width:30px;height:30px;" /></div><div>' + value.business_name + '&nbsp;' + value.location + '</div></div></div>';

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
        })*/
    })

</script>

<script>
    function searchclick(status,cid){
        $("#business_name").val($(this).attr('data-num'));
        $("#option-box").hide();
      /*  alert(status);*/
        // alert(cid);
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
                $.ajax({
                    url: "/set-session-for-claim/"+cid+"/"+status,
                    type:"GET",
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    success:function(response){
                        window.location.href = "/userlogin";
                    },
                });
            }
        }
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

