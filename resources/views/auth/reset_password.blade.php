@inject('request', 'Illuminate\Http\Request')
@extends('layouts.header')
@section('content')

<div class="profile-div reset-div">
  <div class="container">
    <div class="row"> 
        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 col-md-offset-3">
            <div class="step-block1">
                <h1 class="text-center">Reset Password</h1>
                <div class="signup-block">
                    <div class="social-connect">
                        <!-- Display Validation Errors -->
                        <div class="row">
                            {!! Form::open(array('url' => '/postResetPassword', 'id' => 'frmresetpassword', 'method' => 'POST')) !!}
                                {!! csrf_field() !!}
                                    <input type="hidden" name="user_id" value="{{ $user_id }}">
                                
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