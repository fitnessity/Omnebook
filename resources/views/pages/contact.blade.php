@extends('layouts.business.header')
<link rel='stylesheet' type='text/css' href="https://d2bgo0bc1t29nh.cloudfront.net/css/frontend/general.css">
@section('content')

<!-- 
<section class="main-slider contact-banner inner-banner pmt-105" style="background-image:url('/public/images/cont-banner.jpg')">
    <div class="container">
        <h1>CONTACT US</h1>
    </div>
</section> -->

<section class="breadcrumbs">
    <div class="container">
        <ul>
            <li><a href="{{ Config::get('constants.SITE_URL') }}">HOME</a></li><li><i class="fa fa-angle-right"></i></li>
            <li>CONTACT US sdsd</li>
        </ul>
    </div>
</section>
        <div class="alert alert-success fade in alert-dismissible successmsg" style="display: none;">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close" style="line-height:23px">
                <span aria-hidden="true" style="font-size:20px">×</span>
            </button> <!-- {{ session()->get('success') }} -->
        </div>  
        <div class="alert alert-success alert-dismissible successmsgcontact"style="display: none;">Thank you for contacting Fitnessity. We will get back to you soon!</div>                               
        
<div class="location-detail contactpage-sec">
    <div class="container">
        
        <div class="location-left">
            <h2>SEND ENQUIRY</h2>
            <div class="cont-detail">
                {!! $pageContent !!}
            </div>
        </div>

        <div class="location-right">
            <h2>Contact Us</h2>
            <div id='systemMessage' class="contactUsMessage"></div>
            <form  id="frmcontact" method="post">
                <p><input type="text" placeholder="Name" name="name" id="name" /></p>
                <p><input type="text" placeholder="Email" name="email" id="email" autocomplete="off" /></p>
                <textarea placeholder="Send us your Enquiry" name="message" id="message" rows="10"></textarea>
                <input type="hidden" name="_token" id="token" value="{{csrf_token()}}">
                <button type="submit" id='frmcontact_submit' onclick="$('#frmcontact').submit();">SEND  ENQUIRY <i class="fa fa-angle-right" aria-hidden="true"></i></button>
            </form>
        </div>

    </div>
</div>      

<style type="text/css">
    .location-detail{
        background-size: cover;
    }
</style>
@include('layouts.business.footer')

<script type="text/javascript">
    $(document).ready(function () {
        $(".main-slider").remove();
        $("#frmcontact").submit(function (e) {
            e.preventDefault();
            // check for validation
            $('#frmcontact').validate({
                rules: {
                    name: {
                        required: true
                    },
                    email: {
                        required: true,
                        email: true
                    },
                    message: {
                        required: true
                    }
                },
                messages: {
                    name: {
                        required: "Provide a name"
                    },
                    email: {
                        required: "Provide an email address",
                        email: "Please enter a valid email address",
                    },
                    message: "Provide a message"
                },
                submitHandler: SubmitContact
            });
        });

        function SubmitContact() {
            var validForm = $('#frmcontact').valid();
            var posturl = '/contact-us';
            if (validForm) {
                var formData = $("#frmcontact").serialize();
                $.ajax({
                    url: posturl,
                    type: 'POST',
                    dataType: 'json',
                    data: formData,
                    beforeSend: function () {
                        $('#frmcontact_submit').prop('disabled', true);
                        showSystemMessages('#systemMessage', 'info', 'Please wait while we save your Enquiry.');
                    },
                    complete: function () {
                        $('#frmcontact_submit').prop('disabled', false);
                    },
                    success: function (response) {
                        if (typeof (response.msg) != undefined)
                        {
                            showSystemMessages('#systemMessage', response.type, response.msg);
                        }
                        if (response.type == "success") {
                            $("#name").val('');
                            $("#email").val('');
                            $("#message").val('');
                        }
                        /* location.reload();*/
                        /*$('.successmsg').css("display", "block");*/
                        $('.successmsgcontact').css("display", "block");
                    }
                });
            }
        }
    });
</script>
@endsection