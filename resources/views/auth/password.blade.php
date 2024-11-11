    <!-- Modal content-->

      <div class="modal-body">
		<div class="reset-title">
			 <h3>RESET PASSWORD</h3>
		</div>
		<div class="row">
			<div class="col-md-12">
				<div class="reset-passthru">
					<div id='systemMessage_frgtpwd' class="text-center fs-12"></div>
					<form  id="frmfrgtpwd" method="post">
						<input type="text" name="frgtpwd_email" id="frgtpwd_email" placeholder="Email" >
							<button class="btn signup-new" id="forgot_submit" type="button">Send Email </button>
							<p class="donthave">Already have an account? 
								<a href="{{route('userlogin')}}" data-toggle="modal" data-target="#login_modal" onclick="openLoginModal('login')">LOGIN</a>
							</p>
						<input type="hidden" name="_token" id="token_forget" value="{{csrf_token()}}">
					</form>
				</div>
			</div>
		</div>
	  </div>
<script>

  $("#forgot_submit").click(function(e){
  	e.preventDefault();
		var email = $("#frgtpwd_email").val();
  	if (email != '') {
	      $.ajax({
	          url:'{{route("postEmail")}}',
	          type:'POST',
	          data:'email='+$("#frgtpwd_email").val() + "&_token="+$("#token_forget").val(),
	          success: function (data) { 
	          	$('#systemMessage_frgtpwd').removeClass('green-fonts');
	          	$('#systemMessage_frgtpwd').removeClass('red-fonts');
	          	if(data == 'success'){
	          			$('.signup-new').attr("disabled", true); 
	          			$('#systemMessage_frgtpwd').addClass('green-fonts');
									$('#systemMessage_frgtpwd').html('Link Successfully Sent To Your Email');
	          	}else{
	          			$('#systemMessage_frgtpwd').addClass('red-fonts');
									$('#systemMessage_frgtpwd').html("Your Email Is Not In Our System. Plese Check It Again.");
	          	}
	          }
	        });
	    }else{
	    	$('#systemMessage_frgtpwd').addClass('red-fonts');
	    	$('#systemMessage_frgtpwd').html("Please enter a email address");
	    }
  }); 


	

	/*function SendResetPasswordMail() {
		alert('SendResetPasswordMail');
	    var validForm = $('#frmfrgtpwd').valid();
	    if (validForm) {
	      $.ajax({
	          url:'/password/email',
	          type:'POST',
	          data:'email='+$("#frgtpwd_email").val() + "&_token="+$("#token_forget").val(),
	          success: function (data) { 
	          	$('.signup-new').attr("disabled", true); 
	          	$('#systemMessage_frgtpwd').removeClass('green-fonts');
	          	$('#systemMessage_frgtpwd').removeClass('red-fonts');
	          	if(data == 'success'){
	          			$('#systemMessage_frgtpwd').addClass('green-fonts');
									$('#systemMessage_frgtpwd').html('Link Successfully Sent To Your Email');
	          	}else{
	          			$('#systemMessage_frgtpwd').addClass('red-fonts');
									$('#systemMessage_frgtpwd').html("Can't Send A Link To Your Email. Please Check Your Email Once..");
	          	}
	          }
	        });
	    }
	}*/
  
</script>