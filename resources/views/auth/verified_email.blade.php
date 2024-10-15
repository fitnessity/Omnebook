@extends('layouts.business.header')

@section('content')
<link rel='stylesheet' type='text/css' href="{{url('/public/css/frontend/general.css')}}">
<link rel='stylesheet' type='text/css' href="{{url('/public/css/responsive.css')}}">
<link href="<?php echo Config::get('constants.FRONT_CSS'); ?>dropzone.css" rel="stylesheet">
<link href="<?php echo Config::get('constants.FRONT_CSS'); ?>feedpost/jquery.lightbox-0.5.css" rel="stylesheet">
<link href="<?php echo Config::get('constants.FRONT_CSS'); ?>lightbox2.min.css" rel="stylesheet">
<script src="<?php echo Config::get('constants.FRONT_JS'); ?>lightbox-plus-jquery.min.js"></script>
<script src="<?php echo Config::get('constants.FRONT_JS'); ?>lightbox.js"></script>
<div class="profile-div inner_top">
	<div class="container">
		<div class="user-detail">
			<div class="user-verify">
				<!-- $user['email']-->


				<!-- Old code -->
					<h2 class="fs-17">Verify your email address to access all of Omnebook</h2><br />
					<p class="fs-15">We've just sent an email to your address : <strong> <?php if(isset($user['email'])){
						print_r($user['email']);
					}?> </strong></p>
					<p class="fs-15"> Please check your email and click on the link provided to verify your address.</p><br />
					<p class="fs-15">
						<input type="hidden" name="user_id" id="user_id" value="<?php echo $user['id'];?>">
						<input type="hidden" name="_token" id="token" value="{{csrf_token()}}">
						<button type="submit" class="btn btn-red btn-verify fs-14" id="resendBtn">Please re-send that verification email</button>
					</p>
					<label style="padding-top: 1px; color: #f53b49; display: none;" id="process">Processing...</label>
			</div>
		</div>
	</div>
</div>
@include('layouts.business.footer')
<script>
	$(document).ready( function($){
		
		$('#resendBtn').on('click', function(){
			  
			$('.btn-verify').css({"background-color": "#d2d2d2", "color": "#000"});
			$('#process').css({"display": "block"});

			var posturl = '/user/resendverify';

			var user_id = $('#user_id').val();
			if(user_id !== "" && user_id !== null && user_id !== undefined){

				$.ajax({
		          url:posturl,
		          type:'POST',
		          dataType: 'json',
		          data:'user_id='+user_id + "&_token="+$("#token").val(),
		          beforeSend: function () {
		            $('#resendBtn').prop('disabled', true);
		          },
		          complete: function () {
		            $('#resendBtn').prop('disabled', false);
		          },
		          success: function (response) { 
		          	showSystemMessages('#systemMessage_frgtpwd', response.type, response.msg);
		          	$('.btn-verify').css({"background-color": "#2e6da4", "color": "#fff"});
					$('#process').css({"display": "none"});
					
		          	if(response.verified === "true"){
		          		window.location.href = '/?success=true';
		          		// $('#loginbtn').trigger('click');
		          	}
		              // if(response.type == "success"){
		              // 	showSystemMessages('#systemMessage_frgtpwd', response.type, response.msg);
		              // }
		          }
		        });
			}
		})
	});
</script>
@endsection