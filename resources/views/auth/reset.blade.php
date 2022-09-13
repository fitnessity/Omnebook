@extends('layouts.app')

@section('content')

<div class="profile-div">

  <div class="container">

    <div class="row"> 

        <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">

            <div class="step-block1">
                <h1>Reset Password</h1>
                <div class="signup-block">

                    <div class="social-connect">

                        <!-- Display Validation Errors -->
                        
                        <div class="row">

                            {!! Form::open(array('url' => '/password/reset', 'id' => 'frmresetpassword', 'method' => 'POST')) !!}

                                {!! csrf_field() !!}

                                    <input type="hidden" name="token" value="{{ $token }}">
                                    
                                    <div class="form-control">
                                        <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                                            <label>Email  <span class="color-red">*</span></label>
                                        </div>
                                        <div class="form-group col-lg-8 col-md-8 col-sm-12 col-xs-12 {{ $errors->has('email') ? ' has-error' : '' }}">
                                            <input type="text" name="email" 
                                             placeholder="Enter an E-mail"/>
                                            <!-- <span class="req-line"></span> -->
                                            @if($errors->has('email'))
                                                <p class="help-block">
                                                    {{ $errors->first('email') }}
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
@endsection