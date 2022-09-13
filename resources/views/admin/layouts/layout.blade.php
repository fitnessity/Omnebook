<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <link rel="shortcut icon" href="{{ url('public/images/email/favicon.ico') }}" >
        <link href="<?php echo Config::get('constants.FRONT_CSS'); ?>responsive.css" type="text/css" rel="stylesheet"/>
        <title>
            <?php echo !empty($pageTitle) ? $pageTitle . ' - ' : '';
            echo Config::get('constants.system_title'); ?>
        </title> 
        @include('admin.partials.include')
    </head>
    <body class="hold-transition skin-blue sidebar-mini">
        <!--include Header -->
        @include('admin.partials.header')
        <!--include Left Menu -->
        @include('admin.partials.left_menu')
        <!--Content Part  Start-->
        <div class="wrapper admin-wrapper">
            <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper">
                <!-- Content Header (Page header) -->
                <section class="content-header">                
                    <ol class="breadcrumb admin">
                        <li><a href="/admin/dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li class="active">
                            <?php if (isset($breadcrumbs) && $breadcrumbs != '') {
                                echo $breadcrumbs;
                            } else {
                                echo "Manage Customers";
                            } ?>
                        </li>
                    </ol>
                    <h3 class="admin-dashboard">
                        {{ $pageTitle }}
                    </h3>
                </section>
                <section class="content-header">
                    @if(Session::has('msg'))
                    <div class="flash-message">
                        <div class="alert alert-{{ Session::get('key') }}">
                            {{ Session::get('msg') }}
                        </div>
                    </div>
                    {{Session::forget('key')}}
                    {{Session::forget('msg')}}
                    @endif
                    <div class="flash-message">
                        <!-- @if($errors->any())
                            <p class="alert alert-danger">{{ $errors->first() }} <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>
                        @endif -->
                        <div class="flash-message">
                            @foreach (['danger', 'warning', 'success', 'info', ] as $msg)
                            @if(Session::has('alert-' . $msg))
                            <p class="alert alert-{{ $msg }}">{{ Session::get('alert-' . $msg) }} <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>
                            @endif
                            @endforeach
                            @if (session('status'))
                            @foreach (session('status') as $key=>$msg) 
                            <div class="alert alert-{{ $key }}">
                                {{ $msg }}
                            </div>
                            @endforeach
                            @endif
                        </div>
                    </div>
                    @yield('content')
                </section>
            </div> 
        </div>
        <!-- Content Part End -->    
        <!-- include Footer -->
        @include('admin.partials.footer')
        <!-- include Right Menu -->    
        @include('admin.partials.right_menu')
    </body>
</html>