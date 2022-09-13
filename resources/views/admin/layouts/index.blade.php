<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Fitnessity</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link rel="shortcut icon" href="{{ url('public/images/email/favicon.ico') }}" >
  <!-- Bootstrap 3.3.6 -->
  <link rel="stylesheet" href="/public/AdminLTE/bootstrap/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="/public/AdminLTE/dist/css/AdminLTE.min.css">
  <link rel="stylesheet" href="/public/AdminLTE/dist/css/general.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="/public/AdminLTE/plugins/iCheck/square/blue.css">
  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
  <!-- jQuery 2.2.3 -->
  <script src="public/AdminLTE/plugins/jQuery/jquery-2.2.3.min.js"></script>
  <script src="<?php echo Config::get('constants.FRONT_JS'); ?>JQueryValidate/jquery.validate.js"></script>
  <script src="<?php echo Config::get('constants.FRONT_JS'); ?>general.js"></script>
</head>
<body class="hold-transition login-page">    
@yield('content')
<!-- Bootstrap 3.3.6 -->
<script src="public/AdminLTE/bootstrap/js/bootstrap.min.js"></script>
<!-- iCheck -->
<script src="public/AdminLTE/plugins/iCheck/icheck.min.js"></script>
<script>
  $(function () {
    $('input').iCheck({
      checkboxClass: 'icheckbox_square-blue',
      radioClass: 'iradio_square-blue',
      increaseArea: '20%' // optional
    });
  });
</script>
</body>
</html>