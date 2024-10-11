@extends('admin.layouts.index')
@section('content')
<div class="login-box">
  <div class="login-logo">
    <a href="/"><b>FITNESSITY</a>
  </div>
  <!-- /.login-logo -->
  <div class="login-box-body">
    <p class="login-box-msg">Reset Password</p>

    {!! Form::open(array('url' => '/password/reset', 'id' => 'frmresetpassword', 'method' => 'POST')) !!}
    {!! csrf_field() !!}

    <input type="hidden" name="token" value="{{ $token }}">
      <div class="form-group {{ $errors->has('email') ? ' has-error' : '' }} has-feedback">
        <input type="email" name="email" value="" class="form-control" placeholder="Enter Email *"/>
        @if($errors->has('email'))
            <p class="help-block">
                {{ $errors->first('email') }}
            </p>
        @endif
        <!-- <span class="glyphicon glyphicon-envelope form-control-feedback"></span> -->
      </div>
      <div class="form-group {{ $errors->has('password') ? ' has-error' : '' }} has-feedback">
        <input type="password" name="password" value="" class="form-control" placeholder="Password *"/>
        @if($errors->has('password'))
            <p class="help-block">
                {{ $errors->first('password') }}
            </p>
        @endif
        <!-- <span class="glyphicon glyphicon-lock form-control-feedback"></span> -->
      </div>
      <div class="form-group {{ $errors->has('password_confirmation') ? ' has-error' : '' }} has-feedback">
        <input type="password" name="password_confirmation" value="" class="form-control" placeholder="Confirm Password *"/>
        @if($errors->has('password_confirmation'))
            <p class="help-block">
                {{ $errors->first('password_confirmation') }}
            </p>
        @endif
        <!-- <span class="glyphicon glyphicon-lock form-control-feedback"></span> -->
      </div>
      <div class="row">
        <div class="col-xs-12">
          <button type="submit" class="btn btn-primary btn-block btn-flat">Submit</button>
        </div>
      </div>
    
    {!! Form::close() !!}
  </div>
  <!-- /.login-box-body -->
</div>
<!-- /.login-box -->
@stop