@extends('admin.layouts.index')
@section('content')
<div class="login-box">
  <div class="login-logo">
    <a href="/"><b>FITNESSITY</a>
  </div>
  <!-- /.login-logo -->
  <div class="login-box-body">
    <p class="login-box-msg">Sign up to create your session</p>

    <form action="/admin/register" method="post">
    {{ csrf_field() }}
      <div class="form-group has-feedback">
        <input type="text" name="company" class="form-control" placeholder="Comapny">
        <span class="glyphicon glyphicon-user form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input type="text" name="username" class="form-control" placeholder="User Name">
        <span class="glyphicon glyphicon-user form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input type="email" name="email" class="form-control" placeholder="Email">
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input type="password" name="password" class="form-control" placeholder="Password">
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input type="password" name="password_confirm" class="form-control" placeholder="Confirm Password">
        <span class="glyphicon glyphicon-log-in form-control-feedback"></span>
      </div>
      <div class="row">
        <!-- <div class="col-xs-8">
          <div class="checkbox icheck">
            <label>
              <input type="checkbox"> Remember Me
            </label>
          </div>
        </div> -->
        <!-- /.col -->
        <div class="col-xs-6">
          <button type="submit" class="btn btn-primary btn-block btn-flat">Sign Up</button>
        </div>
         <div class="col-xs-6">
          <a  href="/admin" class="btn btn-success btn-block btn-flat">Sign In</a>
        </div>
        <!-- /.col -->
      </div>
    </form>

    <!-- <div class="social-auth-links text-center">
      <p>- OR -</p>
      <a href="#" class="btn btn-block btn-social btn-facebook btn-flat"><i class="fa fa-facebook"></i> Sign in using
        Facebook</a>
      <a href="#" class="btn btn-block btn-social btn-google btn-flat"><i class="fa fa-google-plus"></i> Sign in using
        Google+</a>
    </div> -->
    <!-- /.social-auth-links -->

   <!--  <a href="#">I forgot my password</a> --><br>
    <!-- <a href="admin/register" class="btn btn-primary btn-block btn-flat">Register a new membership</a> -->
    <!-- <button type="submit" class="btn btn-danger btn-block btn-flat">Forgot Password</button> -->
  </div>
  <!-- /.login-box-body -->
</div>
<!-- /.login-box -->
@stop