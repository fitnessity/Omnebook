@extends('layouts.header')
@section('content')

<link rel="shortcut icon" href="{{ url('public/img/favicon.png') }}">

<!--<link rel="stylesheet" type="text/css" href="{{ url('public/css/bootstrap.css') }}">-->
<link rel="stylesheet" type="text/css" href="{{ url('public/css/all.css') }}">
<link rel="stylesheet" type="text/css" href="{{ url('public/css/metismenu.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ url('public/css/fullcalendar.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ url('public/css/profile.css') }}">
<link rel="stylesheet" type="text/css" href="{{ url('public/css/pixelarity.css') }}">

<style type="text/css">
#profile label img {
    max-width: 100%;
    opacity: .5;
}
</style>
<?php   
    $phone_num = $UserProfileDetail['phone_number'];
    if (preg_match('/()-/', $phone_num)){
       
        $phone_number = $phone_num;
    }else{
        
        $phone_number = preg_replace('~.*(\d{3})[^\d]{0,7}(\d{3})[^\d]{0,7}(\d{4}).*~', '($1) $2-$3', $phone_num);
    }
?>
<div class="page-wrapper inner_top" id="wrapper">

    <div class="page-container">

        <!-- Left Sidebar Start -->
        @include('personal-profile.left_panel')
        <!-- Left Sidebar End -->

        <div class="page-content-wrapper">
            @if(@$UserProfileDetail['activated'] != 1)
            <div class="w3-panel w3-red">
                 <p>Please Verify Your Email.</p>
             </div> 
            @endif
            <div class="content-page">
                
                <div class="container-fluid">

                    <div class="page-title-box">
                        <h4 class="page-title">Edit Profile</h4>
                    </div>

                    <div class="edit_profile_section padding-1 white-bg border-radius1">
                        <form name="frm_profile" id="frm_profile" action="{{Route('updateuserprofile')}}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                    @if(session()->has('success'))
                                    <div class="alert alert-success fade in alert-dismissible show">
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close" style="line-height:23px">
                                            <span aria-hidden="true" style="font-size:20px">×</span>
                                        </button> {{ session()->get('success') }}
                                    </div>
                                    @elseif(session()->has('error'))
                                    <div class="alert alert-danger fade in alert-dismissible show">
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close" style="line-height:23px">
                                            <span aria-hidden="true" style="font-size:20px">×</span>
                                        </button> {{ session()->get('error') }}
                                    </div>
                                    @endif
                                </div>
                                <div class="col-xl-2 col-lg-2 col-md-2 col-sm-6 col-12 text-center">

                                    <label for="mediaFile">Profile Image</label>
                                    <div class="piccrop_block" id="file">
                                        @php
                                        if(@$UserProfileDetail['profile_pic']!="")
                                        $path='public/uploads/profile_pic/'.$UserProfileDetail['profile_pic'];
                                        else
                                        $path="public/img/upload.png"
                                        @endphp
                                        <label>Drop files to upload <br> or <br> <img id="thumb-2" src="/{{$path}}" alt=""> <br> <span>Upload Photo</span></label>
                                        <input type="file" id="mediaFile" name="frm_profile_pic" onchange="readURL(this);" accept="image/*" />
                                       
                                       <!-- <img class="result" id="result" name="frm_profile_pic1" >-->
                                    </div>

                                    <!--<div class="profile-block">
                                        <div id="profile">
                                            <div class="dashes"></div>
                                           
                                            <label>Drop files to upload <br> or <br> <img src="/{{$path}}" alt=""> <br> <span>Upload Photo</span></label>
                                        </div>
                                        <input type="file" id="mediaFile" name="frm_profile_pic" onchange="readURL(this);" accept="image/*" />
                                    </div>-->
                                </div>

                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                                    <div class="row">

                                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                            <div class="form-group editform">
                                                <input type="hidden" name="old_profile_pic" value="{{ $UserProfileDetail['profile_pic'] }}" />
												<label> First Name </label>
                                                <input type="text" name="firstname" id="firstname" placeholder="First Name" class="form-control" value="{{ $UserProfileDetail['firstname']}}">
                                                @if ($errors->has('firstname'))
                                                <span class="help-block" style="color:red">
                                                    <strong>Firstname required</strong>
                                                </span>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                            <div class="form-group editform">
												<label> Last Name </label>
                                                <input type="text" name="lastname" id="lastname" placeholder="Last Name" class="form-control" value="{{$UserProfileDetail['lastname'] }}">
                                                @if ($errors->has('lastname'))
                                                <span class="help-block" style="color:red">
                                                    <strong>Lastname is required</strong>
                                                </span>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                            <div class="form-group editform">
												<label> Gender </label>
                                                <input type="text" name="gender" id="gender" placeholder="Gender" class="form-control" value="{{$UserProfileDetail['gender'] }}">
                                                @if ($errors->has('gender'))
                                                <span class="help-block" style="color:red">
                                                    <strong>Gender is required</strong>
                                                </span>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                            <div class="form-group editform">
                                                <label>DOB:&nbsp;&nbsp;&nbsp;&nbsp;</label>
                                                <input type="date" name="birthdate"  placeholder="Birth Date" class="form-control rs-birthdate" value="{{$UserProfileDetail['birthdate'] }}">
                                                <br><br>
                                                <input type="radio" class="radio-dots" name="dobstatus" value="0" @if($UserProfileDetail['dobstatus'] == 0) checked="" @endif>
                                                <label style="font-weight: normal;">Show &nbsp;&nbsp;</label>
                                                <input type="radio" class="radio-dots" name="dobstatus" value="1" @if($UserProfileDetail['dobstatus'] == 1) checked="" @endif>
                                                <label style="font-weight: normal;">Hide</label>
                                                
                                            </div>
                                        </div>

                                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                            <div class="form-group editform">
												<label> User Name </label>
                                                <input type="text" readonly="readonly" placeholder="@username" class="form-control" value="{{$UserProfileDetail['username'] }}">
                                            </div>
                                        </div>
                                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                            <div class="form-group editform">
												<label> Phone Number </label>
                                                <input type="text" name="phone_number" id="phone_number" placeholder="Phone Number" class="form-control" onkeypress='return event.charCode >= 48 && event.charCode <= 57' value="{{$phone_number}}" maxlength="14"  onkeyup="changeformate()">
                                                @if ($errors->has('phone_number'))
                                                <span class="help-block" style="color:red">
                                                    <strong>Phone number is required</strong>
                                                </span>
                                                @endif
                                            </div>
                                        </div>

                                         <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                            <div class="form-group editform">
												<label> Address </label>
                                                <input type="text" name="address" id="address" placeholder="Address" class="form-control" value="{{$UserProfileDetail['address'] }}">
                                                @if ($errors->has('address'))
                                                <span class="help-block" style="color:red">
                                                    <strong>Address is required</strong>
                                                </span>
                                                @endif
                                            </div>
                                        </div>
                                        <div id="map"></div>
                                        <input type="hidden" name="lon" id="lon" value="">
                                        <input type="hidden" name="lat" id="lat" value="">
                                        
                                        
                                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                            <div class="form-group editform">
												<label> City </label>
                                                <input type="text" name="city" id="city" placeholder="City" class="form-control" value="{{$UserProfileDetail['city'] }}">
                                                @if ($errors->has('city'))
                                                <span class="help-block" style="color:red">
                                                    <strong>City is required</strong>
                                                </span>
                                                @endif
                                            </div>
                                        </div>
                                        
                                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                            <div class="form-group editform">
												<label> State </label>
                                                <input type="text" name="state" id="state" placeholder="State" class="form-control" value="{{$UserProfileDetail['state'] }}">
                                                @if ($errors->has('state'))
                                                <span class="help-block" style="color:red">
                                                    <strong>State is required</strong>
                                                </span>
                                                @endif
                                            </div>
                                        </div>
                                        
                                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                            <div class="form-group editform">
												<label> Country </label>
                                                <input type="text" name="country" id="country" placeholder="Country" class="form-control" value="{{$UserProfileDetail['country'] }}">
                                                @if ($errors->has('country'))
                                                <span class="help-block" style="color:red">
                                                    <strong>Country is required</strong>
                                                </span>
                                                @endif
                                            </div>
                                        </div>
                                        
                                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                            <div class="form-group editform">
												<label> Zipcode </label>
                                                <input type="text" name="zipcode" id="zipcode" placeholder="Zipcode" class="form-control" value="{{$UserProfileDetail['zipcode'] }}">
                                                @if ($errors->has('zipcode'))
                                                <span class="help-block" style="color:red">
                                                    <strong>Zipcode is required</strong>
                                                </span>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                            <div class="form-group editform">
												<label> Quick Intro </label>
                                                <textarea name="quick_intro" id="quick_intro" cols="30" minlength="50" maxlength="200" rows="2" placeholder="Quick Intro (max 100 Words)" class="form-control">{{$UserProfileDetail['quick_intro'] }}</textarea>
                                                <span id="quick_intro_count"><span id="display_count">0</span> words. Words left : <span id="word_left">200</span></span>
                                            </div>
                                        </div>

                                    </div>

                                    <input type="submit" name="btnprofile" id="btnprofile" value="Update" class="btn-style-one">
                                </div>

                                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-12">

                                    <div class="form-group editform">
										<label> Email </label>
                                        <input type="text" readonly placeholder="Email" class="form-control" value="{{$UserProfileDetail['email'] }}">
                                    </div>

                                    <div class="form-group editform">
										<label> Favorite Activities </label>
                                        <input type="text" name="favorit_activity" id="favorit_activity" placeholder="Favorite Activities (Can display up to 6 activites)" class="form-control" value="{{$UserProfileDetail['favorit_activity']}}">
                                    </div>

                                    <div class="form-group editform">
										<label> About </label>
                                        <textarea name="business_info" id="business_info" cols="30" rows="7" maxlength="1000" placeholder=" About (a short description about your business - max 1000 words)" class="form-control">{{$UserProfileDetail['business_info']}}</textarea>
                                        <span id="business_info_count"><span id="display_count_business">0</span> words. Words left : <span id="word_left_business">1000</span></span>
                                    </div>

                                </div>

                            </div>
                        </form>
                    </div>
                    
                    {{--
                    <div class="edit_profile_section padding-1 white-bg border-radius1 mt-4">

                        <div class="title-sub">Change Cover Photo</div>

                        <div class="row">

                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">

                                <div class="cover-tagbox">
                                    <i class="fas fa-info-circle"></i>
                                    <span>Your Cover Photo will be used to customize the header of your profile.</span>
                                </div>

                                <div class="file-upload">
                                    <form name="frm_cover" id="frm_cover" action="{{Route('savemycoverphoto')}}" method="post" enctype="multipart/form-data">
                                        @csrf
                                        <div class="image-upload-wrap piccrop_block" id="file1"@if(@$UserProfileDetail['cover_photo']!="" ) style="display: none;" @endif>
                                            <input class="file-upload-input" name="coverphoto" id="coverphoto" type='file' onchange="readURL(this);" accept="image/*" />

                                            <div class="drag-text">
                                                <h3>Drop your image here</h3>
                                                <button class="file-upload-btn" type="button" onclick="$('.file-upload-input').trigger( 'click' )">Select Your File</button>
                                            </div>
                                            <img class="result" id="result1">
                                        </div>
                                        @if ($errors->has('coverphoto'))
                                        <span class="help-block" style="color:red">
                                            <strong>Upload your photo</strong>
                                        </span>
                                        @endif
                                        <div class="file-upload-content piccrop_block" id="file1"@if(@$UserProfileDetail['cover_photo']!="" ) style="display: block;" @endif>
                                            @php
                                            if(@$UserProfileDetail['cover_photo']!="")
                                            $path='public/uploads/cover-photo/'.$UserProfileDetail['cover_photo'];
                                            else
                                            $path="#"

                                            @endphp
                                            <img class="file-upload-image" src="/{{$path}}" alt="your image" />
                                            
                                        </div>
                                        
                                        <div>
                                        </div>
                                        <div class="highlighted-txt-yellow">
                                            For best result, upload and image that is 1950px by 450px or larger.
                                        </div>

                                        <p>If you'd like to delete your current cover photo, use the delete Cover Photo button.</p>

                                        <div class="image-title-wrap">
                                            <input type="hidden" name="_token" value="{!! csrf_token() !!}">
                                            <button type="submit" id="submit_cover" name="submit_cover" class="remove-image">Save My Cover Photo</button>
                                            &nbsp;&nbsp;
                                            <button type="button" style="background:#000" onclick="removeUpload_coverphoto()" class="remove-image">Delete My Cover Photo</button>

                                        </div>
                                    </form>
                                </div>

                            </div>

                        </div>

                    </div>
                    
                    --}}
                    
                    <div class="edit_profile_section changepass-section padding-1 white-bg border-radius1 mt-4">

                        <div class="title-sub">Change Password</div>

                        <div class="row">

                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                                <form name="frm_pwd" id="frm_pwd" action="{{Route('updatechangepassword')}}" method="post" enctype="multipart/form-data">
                                    @csrf
                                    <div class="form-group editform">
										<label> Current Password </label>
                                        <input type="password" name="currpassword" id="currpassword" placeholder="Current Password" class="form-control">
                                        @if ($errors->has('currpassword'))
                                        <span class="help-block" style="color:red">
                                            <strong>Current password is required</strong>
                                        </span>
                                        @endif
                                    </div>

                                    <div class="form-group editform">
										<label> New Password </label>
                                        <input type="password" name="newpassword" id="newpassword" placeholder="New Password" class="form-control">
                                        <img src="{{ url('public/img/icon-verified-autorize.png') }}" alt="" class="password-img">
                                        @if ($errors->has('newpassword'))
                                        <span class="help-block" style="color:red">
                                            <strong>New password is required</strong>
                                        </span>
                                        @endif
                                    </div>

                                    <div class="form-group editform">
										<label> Retype Password </label>
                                        <input type="password" name="retypepassword" id="retypepassword" placeholder="Retype Password" class="form-control">
                                        <img src="{{ url('public/img/icon-verified-autorize.png') }}" alt="" class="password-img">
                                        @if ($errors->has('retypepassword'))
                                        <span class="help-block" style="color:red">
                                            <strong>Confirm password is required</strong>
                                        </span>
                                        @endif
                                    </div>

                                    <input type="submit" name="btn_change_pwd" id="btn_change_pwd" value="Change Password" class="btn-style-one">
                                </form>
                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>


</div>
@include('layouts.footer')

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<!--<script src="{{ url('public/js/jquery-3.3.1.slim.min.js') }}"></script>-->

<script src="{{ url('public/js/bootstrap.min.js') }}"></script>

<script src="{{ url('public/js/metisMenu.min.js') }}"></script>

<script src="{{ url('public/js/jquery.slimscroll.js') }}"></script>

<script src="{{ url('public/js/moment.min.js') }}"></script>

<script src="{{ url('public/js/fullcalendar.min.js') }}"></script>

<script src="{{ url('public/js/jquery.fullcalendar.js') }}"></script>

<script src="{{ url('public/js/custom.js') }}"></script>

<script src="{{ url('public/js/pixelarity-face.js') }}"></script>

<script>
$(document).ready(function() {

            $("#file").change(function(e) {
                var img = e.target.files[0];

                if (!pixelarity.open(img, false, function(res, faces) {
                        console.log(faces);

                        $("#mediaFile").attr("src", res);
                        //$("#mediaFile").val(res);
                        $(".face").remove();

                        for (var i = 0; i < faces.length; i++) {
                            $("body").append("<div class='face' style='height: " + faces[i].height + "px; width: " + faces[i].width + "px; top: " + ($("#result").offset().top + faces[i].y) + "px; left: " + ($("#result").offset().left + faces[i].x) + "px;'>");
                        }

                    }, "jpg", 0.7, true)) {
                    alert("Whoops! That is not an image!");
                }

            });
            $("#file1").change(function(e) {
                var img = e.target.files[0];

                if (!pixelarity.open(img, false, function(res, faces) {
                        console.log(faces);

                        $("#result1").attr("src", res);
                        $(".face").remove();

                        for (var i = 0; i < faces.length; i++) {
                            $("body").append("<div class='face' style='height: " + faces[i].height + "px; width: " + faces[i].width + "px; top: " + ($("#result").offset().top + faces[i].y) + "px; left: " + ($("#result").offset().left + faces[i].x) + "px;'>");
                        }

                    }, "jpg", 0.7, true)) {
                    alert("Whoops! That is not an image!");
                }

            });
        });

    </script>

<script>
    $(function() {

        $('#profile').addClass('dragging').removeClass('dragging');
    });

    $('#profile').on('dragover', function() {
        $('#profile').addClass('dragging')
    }).on('dragleave', function() {
        $('#profile').removeClass('dragging')
    }).on('drop', function(e) {
        $('#profile').removeClass('dragging hasImage');

        if (e.originalEvent) {
            var file = e.originalEvent.dataTransfer.files[0];
            console.log(file);

            var reader = new FileReader();

            //attach event handlers here...

            reader.readAsDataURL(file);
            reader.onload = function(e) {
                console.log(reader.result);
                $('#profile').css('background-image', 'url(' + reader.result + ')').addClass('hasImage');

            }

        }
    })
    $('#profile').on('click', function(e) {
        console.log('clicked')
        $('#mediaFile').click();
    });
    window.addEventListener("dragover", function(e) {
        e = e || event;
        e.preventDefault();
    }, false);
    window.addEventListener("drop", function(e) {
        e = e || event;
        e.preventDefault();
    }, false);
    $('#mediaFile').change(function(e) {

        var input = e.target;
        if (input.files && input.files[0]) {
            var file = input.files[0];

            var reader = new FileReader();

            reader.readAsDataURL(file);
            reader.onload = function(e) {
                console.log(reader.result);
                $('#profile').css('background-image', 'url(' + reader.result + ')').addClass('hasImage');
            }
        }
    });

    function readURL(input) {
        if (input.files && input.files[0]) {

            var reader = new FileReader();

            reader.onload = function(e) {
                $('.image-upload-wrap').hide();

                $('.file-upload-image').attr('src', e.target.result);
                $('.file-upload-content').show();

                $('.image-title').html(input.files[0].name);
            };

            reader.readAsDataURL(input.files[0]);

        } else {
            removeUpload();
        }
    }

    function readURLCOVER(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            
            reader.onload = function(e) {
            $('#thumb-2').attr('src', e.target.result);
            }
            
            reader.readAsDataURL(input.files[0]); // convert to base64 string
        }
        }

        $("#mediaFile").change(function() {
        readURLCOVER(this);
        });


    function removeUpload() {
        $('.file-upload-input').replaceWith($('.file-upload-input').clone());
        $('.file-upload-content').hide();
        $('.image-upload-wrap').show();
    }
    $('.image-upload-wrap').bind('dragover', function() {
        $('.image-upload-wrap').addClass('image-dropping');
    });
    $('.image-upload-wrap').bind('dragleave', function() {
        $('.image-upload-wrap').removeClass('image-dropping');
    });

</script>

<script>
    $(document).ready(function() {
        
        var quick_intro = $("#quick_intro").val();
        var business_info = $("#business_info").val();
        $('#display_count').text(quick_intro.length);
        $('#word_left').text(200-parseInt(quick_intro.length));
        $('#display_count_business').text(business_info.length);
        $('#word_left_business').text(1000-parseInt(business_info.length));
    
        $("#quick_intro").on('input', function() {
            $('#display_count').text(this.value.length);
            $('#word_left').text(200-parseInt(this.value.length));
        });
        $("#business_info").on('input', function() {
            $('#display_count_business').text(this.value.length);
            $('#word_left_business').text(1000-parseInt(this.value.length));
        });
    });

</script>
<script>
    function removeUpload_coverphoto() {
        if (confirm("Are you sure you want to delete cover photo?")) {
            var _token = $("input[name='_token']").val();
            $.ajax({
                type: 'POST',
                url: '{{route("removeusercoverphoto")}}',
                data: {
                    _token: _token
                },
                success: function(data) {
                    alert("Cover photo removed successfully.");
                    $(".edit_profile_section").load(location.href + " .edit_profile_section");
                }
            });
        }
    }

    function changeformate(idname) {
        /*$('#b_contact').val();*/
        var con = $('#phone_number').val();
        var curchr = con.length;
        if (curchr == 3) {
            $('#phone_number').val("(" + con + ")" + " ");
        } else if (curchr == 9) {
            $('#phone_number').val(con + "-");
        }
    }

    function initMap() {
        var map = new google.maps.Map(document.getElementById('map'), {
          center: {lat: -33.8688, lng: 151.2195},
          zoom: 13
        });
        var input = document.getElementById('address');
        map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);

        var autocomplete = new google.maps.places.Autocomplete(input);
        autocomplete.bindTo('bounds', map);

        var infowindow = new google.maps.InfoWindow();
        var marker = new google.maps.Marker({
            map: map,
            anchorPoint: new google.maps.Point(0, -29)
        });

        autocomplete.addListener('place_changed', function() {
            infowindow.close();
            marker.setVisible(false);
            var place = autocomplete.getPlace();
            if (!place.geometry) {
                window.alert("Autocomplete's returned place contains no geometry");
                return;
            }
      
            // If the place has a geometry, then present it on a map.
            if (place.geometry.viewport) {
                map.fitBounds(place.geometry.viewport);
            } else {
                map.setCenter(place.geometry.location);
                map.setZoom(17);
            }
            marker.setIcon(({
                url: place.icon,
                size: new google.maps.Size(71, 71),
                origin: new google.maps.Point(0, 0),
                anchor: new google.maps.Point(17, 34),
                scaledSize: new google.maps.Size(35, 35)
            }));
            marker.setPosition(place.geometry.location);
            marker.setVisible(true);
        
            var address = '';
            var badd = '';
            var sublocality_level_1 = '';
            if (place.address_components) {
                address = [
                  (place.address_components[0] && place.address_components[0].short_name || ''),
                  (place.address_components[1] && place.address_components[1].short_name || ''),
                  (place.address_components[2] && place.address_components[2].short_name || '')
                ].join(' ');
            }
        
            infowindow.setContent('<div><strong>' + place.name + '</strong><br>' + address);
            infowindow.open(map, marker);
            
            // Location details
            for (var i = 0; i < place.address_components.length; i++) {
                if(place.address_components[i].types[0] == 'postal_code'){
                  $('#zipcode').val(place.address_components[i].long_name);
                }
           
                if(place.address_components[i].types[0] == 'locality'){
                    $('#city').val(place.address_components[i].long_name);
                }

                if(place.address_components[i].types[0] == 'sublocality_level_1'){
                    sublocality_level_1 = place.address_components[i].long_name;
                }

                if(place.address_components[i].types[0] == 'street_number'){
                   badd = place.address_components[i].long_name ;
                }

                if(place.address_components[i].types[0] == 'route'){
                   badd += ' '+place.address_components[i].long_name ;
                } 
                if(place.address_components[i].types[0] == 'country'){
                    $('#country').val(place.address_components[i].long_name);
                }
                if(place.address_components[i].types[0] == 'administrative_area_level_1'){
                    $('#state').val(place.address_components[i].long_name);
                }
            }
            if(badd == ''){
              $('#address').val(sublocality_level_1);
            }else{
              $('#address').val(badd);
            }
            var fulladdress = exclude(",",place.formatted_address);
            alert(fulladdress);

            $('#lat').val(place.geometry.location.lat());
            $('#lon').val(place.geometry.location.lng());
            
        });
    }

</script>


<script src="https://maps.googleapis.com/maps/api/js?libraries=places&key=AIzaSyCr7-ilmvSu8SzRjUfKJVbvaQZYiuntduw&callback=initMap" async defer></script>
@endsection
