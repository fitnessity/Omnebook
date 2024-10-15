@extends('layouts.business.header')
@section('content')
<head>
    <link rel='stylesheet' type='text/css' href="{{url('/public/css/frontend/general.css')}}">
    <link rel='stylesheet' type='text/css' href="{{url('/public/css/responsive.css')}}">
</head>
<style>
.location-right {
  float: left;
  width: 100%;
  text-align: center;
}
.location-right .rat-fb{
	float: right;
}
.location-right p {
  float: left;
  width: 100%;
  padding-bottom: 6px;
  font-size: 16px;
}
.fb-rat-star{
	font-size: 17px;
	float: right;
}
textarea {
  resize: none;
}
.location-right input{
	margin-bottom: 10px;
}
.location-right textarea{
	margin-bottom: 10px;
}
.location-detail {
  padding: 50px 0 30px 0;
}
.font-feed{
	font-size: 18px;
	margin-bottom: 30px;
}
.side-img img{
	border-radius: 12px;
	width: 100%;
	height: 442px;
}
.alert {
  text-align: left;
  margin-bottom: 0 !important;
}

.alert {
 /* padding: 15px;
    padding-right: 15px;
  margin-bottom: 20px;*/ 
  border: 1px solid transparent;
  border-radius: 4px;
}
@media screen and (max-width: 400px){
.breadcrumbs {
	padding: 158px 8px 17px 12px;
}
}
@media screen and (min-width: 401px) and (max-width: 767px){
.breadcrumbs {
	padding: 106px 8px 17px 12px;
}
}
@media screen and (min-width: 768px) and (max-width: 992px){}
@media screen and (min-width: 1920px) and (max-width: 2500px){
	.side-img img {
	  border-radius: 12px;
	  width: 100%;
	  height: 403px;
	}
}
</style>
<img src="/images/feedback.jpg"  style="width: 100%;">
<section class="main-slider contact-banner">
    <div class="container"> <h1>Feedback</h1> </div>
</section>

<section class="breadcrumbs">
    <div class="container">
        <ul>
            <li><a href="{{ Config::get('constants.SITE_URL') }}">HOME</a></li><li><i class="fa fa-angle-right"></i></li>
            <li>Feedback</li>
        </ul>
    </div>
</section>                                
<!-- <div class="alert alert-success fade in alert-dismissible show successmsg" style="display: none;">
	<button type="button" class="close" data-dismiss="alert" aria-label="Close" >
    	<span aria-hidden="true" style="font-size:20px">×</span>
	</button> {{ session()->get('success') }}
</div>  --> 
<div class="location-detail contactpage-sec feedback-sec">
    <div class="container">
		<div class="row">
        	<div class="col-sm-12 col-md-12 col-lg-12 text-center">
                <div class="alert alert-success fade in alert-dismissible successmsg" id="showalert" style="display: none;">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close" >
                        <span aria-hidden="true" style="font-size:20px">×</span>
                    </button> {{ session()->get('success') }}
                </div>
        	</div>
			<div class="col-sm-12 col-md-12 col-lg-12 text-center">
				<h2 class="text-center">We value your Feedback.</h2>
				<div class="font-feed">
					<p>Please complete the following form and help us improve our customer experience.</p>
				</div>
					<?php /*?><div class="side-img">
						<img src="/images/fedd-side-3.jpg">
					</div><?php */?>
				<div class="location-right">
					<div id='systemMessage' class="contactUsMessage"></div>
                    <div class="container">
                    <div class="row justify-content-md-center">
                    	<div class="col-sm-12 col-md-8 col-lg-8">
							<form id="frmfeedback" method="post" action="{{url('/feedback/saveFeedback')}}">
								@csrf
								<p>
	                            	<input type="hidden" name="rating" id="rating" value="0">
									<span class="rat-fb">Ratings</span>
									<div id="stars" class="starrr fb-rat-star"></div>
								</p> 
								@if (Auth::guest())
									<p><input type="text" placeholder="Name" name="name" id="name" /></p>
									<p><input type="text" placeholder="Email" name="email" id="email" autocomplete="off" /></p>
								@else
									<?php $loggedinUser = Auth::user(); ?>
									<input type="text" name="name" id="name" size="255" maxlength="255" placeholder="name" value="{{ $loggedinUser['firstname'] }} {{ $loggedinUser['lastname'] }}" readonly>
										<input type="email" name="email" id="email" size="255" placeholder="Email Address" maxlength="255" value="{{ $loggedinUser['email'] }}" readonly>
							    @endif 
								<textarea placeholder="Say something About Omnebook" name="comment" id="comment" rows="5"></textarea>
								<textarea placeholder="Any suggestions for us ?" name="suggestion" id="suggestion" rows="5"></textarea>
								@if ($errors->has('suggestion'))
									<span class="help-block" style="color:red; font-size: 15px; display: block;">
										<strong>{{ $errors->first('suggestion') }}</strong>
									</span>
							   	@endif
								<input type="hidden" name="_token" id="token" value="{{csrf_token()}}">
								<button type="submit">SEND  FEEDBACK </button>
							</form>
							<div class="font-green fs-18">{{ session()->get('success') }}</div>
                        </div>
					</div>
				</div>
                </div>
			</div>
		</div>
    </div>
</div>      
  
@include('layouts.business.footer')
<script src="{{url('/public/js/ratings.js')}}"></script>
<script type="text/javascript">
    $(document).ready(function () {
        $(".main-slider").remove();
       

        function SubmitContact() {
            var validForm = $('#frmcontact').valid();
            var posturl = '/contact-us';
            if (validForm) {
                var formData = $("#frmcontact").serialize();
                $.ajaxSetup({
                  headers: {
                      'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
                  }
              });
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
                        location.reload();
                        /*$('#showalert').css("display", "block");
						$('#showalert').addClass('show');*/
                    }
                });
            }
        }
    });
</script>
@endsection