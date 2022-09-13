@extends('layouts.header')



@section('content')



<div class="profile-div" style="padding: 120px 0;">



  <div class="container">



    <div class="row"> 



    	<div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">



        	<div class="signup-block">



            	<h1>Change Password</h1>



                <!-- <p>Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat. Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat, vel illum dolore eu feugiat nulla facilisis at vero eros et accumsan et iusto odio dignissim qui blandit praesent luptatum</p> -->



            </div>
            



                      <div class="step-block1">
                <h1>Reset Password</h1>
                <div class="signup-block">

                    <div class="social-connect">

                        <!-- Display Validation Errors -->
                        
                        <div class="row">

                            {!! Form::open(array('url' => '/change-password/reset', 'id' => 'frmresetpassword', 'method' => 'POST')) !!}

                                {!! csrf_field() !!}

                                    
                                    
                                    <div class="form-control">
                                        <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                                            <label>Current Password  <span class="color-red">*</span></label>
                                        </div>
                                        <div class="form-group col-lg-8 col-md-8 col-sm-12 col-xs-12 {{ $errors->has('current_password') ? ' has-error' : '' }}">
                                            <input type="password" name="current_password" placeholder="Enter Current Password"/>
                                            <!-- <span class="req-line"></span> -->
                                            @if($errors->has('password'))
                                                <p class="help-block">
                                                    {{ $errors->first('password') }}
                                                </p>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="form-control">
                                        <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                                            <label>password  <span class="color-red">*</span></label>
                                        </div>
                                        <div class="form-group col-lg-8 col-md-8 col-sm-12 col-xs-12 {{ $errors->has('password') ? ' has-error' : '' }}">
                                            <input type="password" name="password" placeholder="Enter Password"/>
                                            <!-- <span class="req-line"></span> -->
                                            @if($errors->has('password'))
                                                <p class="help-block">
                                                    {{ $errors->first('password') }}
                                                </p>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="form-control">
                                        <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                                            <label>Confirm Password  <span class="color-red">*</span></label>
                                        </div>
                                        <div class="form-group col-lg-8 col-md-8 col-sm-12 col-xs-12 {{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                                            <input type="password" name="password_confirmation" placeholder="Re-Enter Password"/>
                                             <!-- <span class="req-line"></span> -->
                                             @if($errors->has('password_confirmation'))
                                                <p class="help-block">
                                                    {{ $errors->first('password_confirmation') }}
                                                </p>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="form-control">
                                        <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12"></div>
                                        <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12"> 
                                        <button class="button-nxt button-next">Submit</button>
                                        </div>
                                    </div>
                            {!! Form::close() !!}                   

                        </div>

                    </div>
                </div>
            </div>
    </div>    
  </div>
</div>
</div>
@include('layouts.footer')

@endsection