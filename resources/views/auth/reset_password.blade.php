@inject('request', 'Illuminate\Http\Request')
@extends('layouts.business.header')
@section('content')
<div class="reset-pass-tb">
<div class="profile-div reset-div">
  <div class="container">
    <div class="row justify-content-md-center"> 
        <div class="col-lg-6 col-md-6 col-sm-12 col-12">
            <div class="step-block1 rest-password-title">
                <h1 class="text-center">Reset Password</h1>
                <div class="signup-block card">
                    <div class="social-connect card-body p-4">
                        <!-- Display Validation Errors -->
                        <div class="continer">
                            <div class="row">
                                {!! Form::open(array('url' => '/postResetPassword', 'id' => 'frmresetpassword', 'method' => 'POST')) !!}
                                    {!! csrf_field() !!}
                                        <input type="hidden" name="user_id" value="{{ $user_id }}">
                                    
                                        <div class="row">
                                            <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                                                <label class="form-label">Password  <span class="font-red">*</span></label>
                                            </div>
                                            <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12 {{ $errors->has('password') ? ' has-error' : '' }}">
                                                <input class="form-control mb-20" type="password" name="password" placeholder="Enter Password"/>
                                                <!-- <span class="req-line"></span> -->
                                                @if($errors->has('password'))
                                                    <p class="help-block">
                                                        {{ $errors->first('password') }}
                                                    </p>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="row">
                                           
                                            <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                                                <label class="form-label">Confirm Password  <span class="font-red">*</span></label>
                                            </div>
                                            <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12 {{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                                                <input class="form-control mb-20" type="password" name="password_confirmation" placeholder="Re-Enter Password"/>
                                                <!-- <span class="req-line"></span> -->
                                                @if($errors->has('password_confirmation'))
                                                    <p class="help-block">
                                                        {{ $errors->first('password_confirmation') }}
                                                    </p>
                                                @endif
                                            </div>
                                            
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 col-12">
                                                <div class="float-right">
                                                    <button class="button-nxt button-next btn btn-red">Submit</button>
                                                </div>
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
</div>
</div>
@include('layouts.business.footer')
@endsection