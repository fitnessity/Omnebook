@extends('layouts.header')

@section('content')

<div class="profile-div">

  <div class="container">

    <div class="row"> 

    	<div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">

        {{--	<div class="signup-block">

            	<h1>Create Your Profile</h1>

                <p>Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat. Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat, vel illum dolore eu feugiat nulla facilisis at vero eros et accumsan et iusto odio dignissim qui blandit praesent luptatum</p>

            </div>--}}

            <div class="steps-block">

	            {{--<div class="line-process"></div>--}}

	            	<div class="row">

	                	<!--<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 steps"><span class="pull-left step_1">1</span>-->

	                 <!--   </div>-->

	                 <!--   <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 steps"><span class="step-active step_2">2</span>-->

	                 <!--   </div>-->

	                 <!--   <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 steps pull-right"><span class="pull-right step_3">3</span>-->

	                 <!--   </div>-->

	                </div>

	        </div>

	        <!-- step 2 starts -->

	        <form id="frmSecurity" method="post" action="/profile/saveProfileSecurity">

		    	{!! csrf_field() !!}

			    <div id="singup_step_2" class="singup_steps">
						<div class="step-block1">
							<h1 class="security-main-title">YOUR SECURITY IS IMPORTANT TO US</h1>
								<div class="signup-block security-block">
							          <h1 class="security-title">security question</h1>
							          <span class="required">Required</span>
							          <div class="clearfix"></div>
							          <p>Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat. Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat, vel illum dolore eu feugiat nulla facil
									  </p>
							          <div class="clearfix"></div>
							          <div class="social-connect extra-md">
							            <div class="row">
							              
							              <div class="form-control">
							                <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
							                  <label>Question</label>
							                </div>
							                <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
							                  <span class="req-line2"></span>
							                  <!-- <input type="text" name="question1" /> -->
							                  <select name="question1" id="question1" value="{{ old('question1') }}" class="question @if ($errors->has('question1')) field-error @endif">
							                  	<option value="">Select Question</option>
							                  	<?php foreach ($question as $key => $value) {

							                  		$selected = '';
							                  		if($key == old('question1'))
							                  			$selected = "selected";

							                  		echo '<option value="'.$key.'" '.$selected.'>'.$value.'</option>';
							                  	}?>
							                  </select>
							                  </div>
							              </div>
							              <div class="form-control">
							                <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
							                  <label>Answer</label>
							                </div>
							                <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
							                  <span class="req-line2"></span>
							                  <input type="text" name="answer1" value="{{ old('answer1') }}"
			                            	 class="@if ($errors->has('answer1')) field-error @endif"
			                            	 placeholder="@if ($errors->has('answer1')) {{$errors->first('answer1')}} @endif"/>
							                  </div>
							              </div>
							              
							              <div class="form-control">
							                <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
							                  <label>Question</label>
							                </div>
							                <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
							                  <span class="req-line2"></span>
							                  <select name="question2" id="question2" value="{{ old('question2') }}" class="question @if ($errors->has('question2')) field-error @endif">
							                  	<option value="">Select Question</option>
							                  	<?php foreach ($question as $key => $value) {

							                  		$selected = '';
							                  		if($key == old('question2'))
							                  			$selected = "selected";

							                  		echo '<option value="'.$key.'" '.$selected.'>'.$value.'</option>';
							                  	}?>
							                  </select>
							                  </div>
							              </div>
							              <div class="form-control">
							                <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
							                  <label>Answer</label>
							                </div>
							                <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
							                  <span class="req-line2"></span>
							                  <input type="text" name="answer2" value="{{ old('answer2') }}"
			                            	 class="@if ($errors->has('answer2')) field-error @endif"
			                            	 placeholder="@if ($errors->has('answer2')) {{$errors->first('answer2')}} @endif"/>
							                  </div>
							              </div>
							              <div class="form-control">
							                <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
							                  <label>Question</label>
							                </div>
							                <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
							                  <span class="req-line2"></span>
							                  <select name="question3" id="question3" value="{{ old('question3') }}" class="question @if ($errors->has('question3')) field-error @endif">
							                  	<option value="">Select Question</option>
							                  	<?php foreach ($question as $key => $value) {

							                  		$selected = '';
							                  		if($key == old('question3'))
							                  			$selected = "selected";

							                  		echo '<option value="'.$key.'" '.$selected.'>'.$value.'</option>';
							                  	}?>
							                  </select>
							                  </div>
							              </div>
							              <div class="form-control">
							                <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
							                  <label>Answer</label>
							                </div>
							                <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
							                  <span class="req-line2"></span>
							                  <input type="text" name="answer3" value="{{ old('answer3') }}"
			                            	 class="@if ($errors->has('answer3')) field-error @endif"
			                            	 placeholder="@if ($errors->has('answer3')) {{$errors->first('answer3')}} @endif"/>
							                  </div>
							              </div>
							              <!-- <div class="form-control">
							               
							                <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12 pull-right">
							                  <input type="submit" value="submit" />
							                 </div>
							              </div> -->
							              
							            </div>
							          </div>
							        </div>
						</div>

			            <div class="">            
				        <div class="step-block1">
			         		<button type="submit" class="button-nxt">Save & Continue<i class="fa fa-angle-double-right"></i></button>
			        	</div>
			        	</div>

			    </div>

			</form>
			    <!-- step 2 ends -->

        </div>

        @include('includes.sidebar_signup')

    </div>    

  </div>

</div>
@include('layouts.footer')

<script>

    $(document).ready(function(){
    	
  		$(".question").change(function() {

  			var selectedValue = $(this).val();
  			var selectedId = $(this).attr('id');

  			if(selectedValue == "") return;

  			$(".question:not(#"+selectedId+")").each(function() {
  				if($(this).val() == selectedValue) {
  					$('#'+selectedId).val('');
  					alert('This question is already selected. Please select a different question');
  				}
  			});

  		});

    });

</script>

@endsection