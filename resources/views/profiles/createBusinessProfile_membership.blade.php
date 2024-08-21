@extends('layouts.profile')

@section('content')

<div class="profile-div">

  <div class="container">

    <div class="row"> 

    	<div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">

        	<div class="signup-block">

            	<h1>Create Your Profile</h1>

                <p>Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat. Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat, vel illum dolore eu feugiat nulla facilisis at vero eros et accumsan et iusto odio dignissim qui blandit praesent luptatum</p>

            </div>

            <div class="steps-block">

	            <div class="line-process"></div>

	            	<div class="row">

	                	<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 steps"><span class="pull-left step_1">1</span>

	                    </div>

	                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 steps"><span class="step_2">2</span>

	                    </div>

	                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 steps pull-right"><span class="step-active pull-right step_3">3</span>

	                    </div>

	                </div>

	        </div> 

	        <!-- step 3 starts -->

	        <!-- <form id="frmMembership" method="post" action="/profile/saveProfileMembership"> -->
	        <form id="frmMembership" method="post">

		    	{!! csrf_field() !!}

		    	<input type="hidden" name="selected_plans" id="selected_plans" value="">

		    	<div id='systemMessage'></div>

		    	<div id="singup_step_3" class="singup_steps">

					<div class="membership_title">
					    <h1>FITNESSITY BUSINESS MEMBERSHIP</h1>
					    <p>Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat. Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse mole</p>
					</div>
					@include('profiles.plan-details')
					<div class="step-block1">
			        	<!-- <button class="button-nxt button-back" style="float:left !important;"><i class="fa fa-angle-double-left"></i> Back</button> -->
			         	<button class="button-nxt" id='register_submit' onclick="$('#frmregister').submit();">
			         		Save & Continue<i class="fa fa-angle-double-right"></i></button>
			        </div>
			</div>

		    <!-- step 3 ends -->

        </div>

        @include('includes.sidebar_signup')

    </div>    

  </div>

</div>

<div class="modal fade" id="profileCompletion" role="dialog">
      <div class="modal-dialog modal-lg"> 
        
        <div class="modal-content">
          <div class="modal-body login-pad">
           <button type="button" class="close modal-close" data-dismiss="modal">
				<img src="<?php echo Config::get('constants.FRONT_IMAGE'); ?>close.jpg" height="70" width="34"/>
			</button>
          	<div class="signup-pop">
          	<div class="row">
            	<div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
                    <div class="signup-title"><i class="fa fa-thumbs-up"></i> </div>
            	</div>
                <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12 text-left">NICE WORK, YOUR PROFILE IS READY FOR THE NEXT STEP !</div>
            </div>
            </div>
            <div class="signup-content-pop">
            
            <div id='systemMessage_prosubmit'></div>

              <p>Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat. Duis autem vel eum iriure dolor in hendrerit in vulpu</p>
              <div class="clearfix"></div>
              <span class="sgn-pro-img">
              	<?php if($users->profile_pic != '' && file_exists($users->profile_pic)) {
		        		echo '<img src="'.Config::get('constants.USER_IMAGE_THUMB').$users->profile_pic.'" height="72" width="66" />';
		      		} ?>

              	<img src="<?php echo Config::get('constants.FRONT_IMAGE'); ?>user.png" alt="" width="143" height="143"/>
              </span>
              <p class="sgn-pro-name mrgn-btn">LOREM IPSUM DOLOR</p>
              <p class="text-center mrgn-btn">quis nostrud exerci tation </p>
              <a href="/profile/viewProfile">Preview Profile</a>
              <div class="clearfix"></div>
              <div class="sngp-button">
              	<button type="button" id="submit_review" class="prosubmit_action">SUBMIT FOR REVIEW</button>
                <button type="button" id="save_draft" class="prosubmit_action">SAVE AS  A DRAFT</button>
              </div>
            </div>
          </div>
        </div>
      </div>
</div>

</form>

<script>

    $(document).ready(function(){

    	var user_status = "<?php echo $users->status; ?>";
    	console.log(user_status);

    	$(".modal").on("hidden.bs.modal", function(){
            $(this).removeData();
        });

        $("#profileCompletion").on("show.bs.modal", function(){
            if(user_status == "review_pending") {
            	showSystemMessages('#systemMessage_prosubmit', 'success', 'Profile is submitted to review!');
            	$("#submit_review").hide();
	            $("#save_draft").hide();
	        }
	        else if(user_status == "draft") {
	        	showSystemMessages('#systemMessage_prosubmit', 'sucess', 'Profile is saved in draft!');
	            $("#save_draft").hide();
	        }
        });

        $("#profileCompletion").on("hidden.bs.modal", function(){
            window.location = "/";
        });

    	$('.added_plans').hide();
    	
  		$(".add_plans").click(function() {

  			// get selected plan
  			var selected_plan = $(this).attr("id").split("_");
  			selected_plan = selected_plan[1];

  			// get previously selected plans
  			/*if($('#selected_plans').val() != "")
  				var prev_selected_plan = $('#selected_plans').val().split(",");
  			else
  				var prev_selected_plan = new Array();

  			// append selected plan to previously selected plans
  			prev_selected_plan[prev_selected_plan.length] = selected_plan;

  			// inplode back selected plan and save to hidden element
  			prev_selected_plan = prev_selected_plan.join(",");
  			*/
  			$('#selected_plans').val(selected_plan);

  			//de-select all other options
  			$('.added_plans').not(this).each(function(){
	        	$(this).hide();
	        	$(this).closest('div').find('.add_plans').show();
	     	});

  			$(this).hide();
  			$(this).closest('div').find('.added_plans').show();
  		});

  		$(".added_plans").click(function() {

  			// get plan id to remove
  			var removeItem = $(this).attr("id").split("_");
  			removeItem = removeItem[1];

  			// get previously selected plans
  			var prev_selected_plans = $('#selected_plans').val().split(",");

  			// remove plan id from previously selected plans
			prev_selected_plans = jQuery.grep(prev_selected_plans, function(value) {
			  return value != removeItem;
			});

			// implode back selected plan and save to hidden element
			selected_plans = prev_selected_plans.join(",");
			$('#selected_plans').val(selected_plans)

  			$(this).hide();
  			$(this).closest('div').find('.add_plans').show();
  		});

  		$("#frmMembership").submit(function(e){

        	e.preventDefault();

        	var formData = $("#frmMembership").serialize();

	        $.ajax({
	              url:'/profile/saveProfileMembership',
	              type:'POST',
	              dataType: 'json',
	              data:formData,
	              beforeSend: function () {
	                // $('#register_submit').prop('disabled', true);
	              },
	              complete: function () {
	                // $('#register_submit').prop('disabled', false);
	              },
	              success: function (response) {   
	                  if (response.type == 'danger')
	                  {
	                    showSystemMessages('#systemMessage', response.type, response.msg);
	                  }
	                  else if (response.type == 'success')
	                  {
	                    showSystemMessages('#systemMessage', response.type, response.msg);
	                    $("#profileCompletion").modal('show');
	                  }
	                  if (typeof (response.msg) != undefined)
	                  {
	                    showSystemMessages('#systemMessage', response.type, response.msg);
	                  }
	                }
	        });

    	});

    	$(".prosubmit_action").click(function() {

    		var formData = $("#frmMembership").serialize();
    		var selected_action = $(this).attr('id');
    		$.ajax({
	              url:'/profile/sendProfileToReview/'+selected_action,
	              type:'POST',
	              dataType: 'json',
	              data:formData,
	              beforeSend: function () {
	                // $('#register_submit').prop('disabled', true);
	                showSystemMessages('#systemMessage_prosubmit', 'info', 'Please wait while we save your request');
	              },
	              complete: function () {
	                // $('#register_submit').prop('disabled', false);
	              },
	              success: function (response) {

	              	  $("#systemMessage_prosubmit").show();   
	                  if (response.type == 'danger')
	                  {
	                    showSystemMessages('#systemMessage_prosubmit', response.type, response.msg);
	                  }
	                  else if (response.type == 'success')
	                  {
	                    showSystemMessages('#systemMessage_prosubmit', response.type, response.msg);
	                    if(selected_action == "submit_review") {
	                    	$("#submit_review").hide();
	                    	$("#save_draft").hide();
	                    }	                    	
	                    else if(selected_action == "save_draft") {
	                    	$("#save_draft").hide();
	                    }
	                  }
	                  if (typeof (response.msg) != undefined)
	                  {
	                    showSystemMessages('#systemMessage_prosubmit', response.type, response.msg);
	                  }
	                }
	        });
    	});

    });

</script>

@endsection