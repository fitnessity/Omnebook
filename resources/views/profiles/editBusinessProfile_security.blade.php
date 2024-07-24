@inject('request', 'Illuminate\Http\Request')

@extends('layouts.header')

<head>
  <meta charset="utf-8">
  <meta name="description" content="Looking for a place to grow your career. There are many good reasons to consider the great insurance jobs available through Legends United.">
  <meta name="keywords" content="Great Insurance Jobs">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title> Fitnessity </title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" />

  <link rel="preconnect" href="https://fonts.gstatic.com">
  <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">

  <link rel="stylesheet" href="{{url('/public/css/all.css')}}">
  <link rel="stylesheet" href="{{url('/public/css/stylenew.css')}}">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">.
  <link rel="stylesheet" type="text/css" href="{{ url('public/css/pixelarity.css') }}">
</head>
@section('content')



<div class="profile-div">



  <div class="container">



    <div class="row"> 



    	<div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">



        {{--	<div class="signup-block">



            	<h1>Edit Your Profile</h1>



                <!-- <p>Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat. Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat, vel illum dolore eu feugiat nulla facilisis at vero eros et accumsan et iusto odio dignissim qui blandit praesent luptatum</p> -->



            </div>--}}



            <div class="steps-block">



	           {{-- <div class="line-process"></div>--}}



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



		    	<input type="hidden" name="action" value="edit">



		    	<?php $UserSecurityQuestion = $UserProfileDetail['UserSecurityQuestion']; ?>

			    <div id="singup_step_2" class="singup_steps">

						<div class="step-block1">

							<h1 class="security-main-title">YOUR SECURITY IS IMPORTANT TO US</h1>

								<div class="signup-block security-block">

							          <h1 class="security-title">security question</h1>

							          <span class="required">Required</span>

							          <div class="clearfix"></div>

							          <!-- <p>Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat. Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat, vel illum dolore eu feugiat nulla facil

									  </p> -->

									  <p>Answer a few questions in case you forget your password</p>

							          <div class="clearfix"></div>

							          <div class="social-connect extra-md">

							            <div class="row">

							              

							              <div class="form-control">

							                <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">

							                  <label>Question</label>

							                </div>

							                <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">

							                  <span class="req-line2"></span>

							                  <input type="hidden" name="id1" value="@if(isset($UserSecurityQuestion[0])) {{ $UserSecurityQuestion[0]->id }} @endif">

							                  <select required name="question1" id="question1" value="@if(isset($UserSecurityQuestion[0])) {{ $UserSecurityQuestion[0]->question }} @endif" class="question @if ($errors->has('question1')) field-error @endif">

							                  	<option value="">Select Question</option>

							                  	<?php foreach ($question as $key => $value) {



							                  		$selected = '';

							                  		if(isset($UserSecurityQuestion[0]) && $key == $UserSecurityQuestion[0]->question)

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

							                <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12 form-group {{ $errors->has('answer1') ? ' has-error' : '' }}">

							                  <span class="req-line2"></span>

                                                                          <input required type="text" name="answer1"

							                  	value="@if(isset($UserSecurityQuestion[0])){{$UserSecurityQuestion[0]->answer}}@endif"

				                            	class="@if ($errors->has('answer1')) field-error @endif"/>

				                            	@if($errors->has('answer1'))

							                        <p class="help-block">

							                            {{ $errors->first('answer1') }}

							                        </p>

							                    @endif

							                  </div>

							              </div>

							              

							              <div class="form-control">

							                <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">

							                  <label>Question</label>

							                </div>

							                <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">

							                  <span class="req-line2"></span>

							                  <input type="hidden" name="id2" value="@if(isset($UserSecurityQuestion[1])){{$UserSecurityQuestion[1]->id}}@endif">

							                  <select required name="question2" id="question2" value="@if(isset($UserSecurityQuestion[1])) {{ $UserSecurityQuestion[1]->question }} @endif" class="question @if ($errors->has('question2')) field-error @endif">

							                  	<option value="">Select Question</option>

							                  	<?php foreach ($question as $key => $value) {



							                  		$selected = '';

							                  		if(isset($UserSecurityQuestion[1]) && $key == $UserSecurityQuestion[1]->question)

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

							                <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12 form-group {{ $errors->has('answer2') ? ' has-error' : '' }}">

							                  <span class="req-line2"></span>

							                  <input required type="text" name="answer2"

							                  	value="@if(isset($UserSecurityQuestion[1])){{$UserSecurityQuestion[1]->answer}}@endif"

			                            	 	class="@if ($errors->has('answer2')) field-error @endif"/>

			                            	 	@if($errors->has('answer2'))

							                        <p class="help-block">

							                            {{ $errors->first('answer2') }}

							                        </p>

							                    @endif

							                  </div>

							              </div>

							              <div class="form-control">

							                <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">

							                  <label>Question</label>

							                </div>

							                <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">

							                  <span class="req-line2"></span>

			<input type="hidden" name="id3" value="@if(isset($UserSecurityQuestion[2])){{$UserSecurityQuestion[2]->id}}@endif">

			<select required name="question3" id="question3" value="@if(isset($UserSecurityQuestion[2])) {{ $UserSecurityQuestion[2]->question }} @endif" class="question @if ($errors->has('question3')) field-error @endif">

							                  	<option value="">Select Question</option>

							                  	<?php foreach ($question as $key => $value) {

							                  		$selected = '';

							                  		if(isset($UserSecurityQuestion[2]) && $key == $UserSecurityQuestion[2]->question)

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

							                <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12 form-group {{ $errors->has('answer3') ? ' has-error' : '' }}">

							                  <span class="req-line2"></span>

							                  <input required type="text" name="answer3"

							                  	value="@if(isset($UserSecurityQuestion[2])){{$UserSecurityQuestion[2]->answer}}@endif"

			                            	 	class="@if ($errors->has('answer3')) field-error @endif"/>

			                            	 	@if($errors->has('answer3'))

							                        <p class="help-block">

							                            {{ $errors->first('answer3') }}

							                        </p>

							                    @endif

							                  </div>

							              </div>							              

							            </div>

							          </div>

							        </div>

						</div>



			            <div class="">            

				        <div class="step-block1">

				        	<a href="/profile/viewProfile"><i class="fa fa-angle-double-left"></i> Back </a>

			         		<button class="button-nxt">Save & Continue<i class="fa fa-angle-double-right"></i></button>

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