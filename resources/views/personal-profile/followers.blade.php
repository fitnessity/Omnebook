@extends('layouts.header')
@section('content')
<?php
use App\UserFollow;
?>

<link rel="shortcut icon" href="{{ url('public/img/favicon.png') }}">

<!--<link rel="stylesheet" type="text/css" href="{{ url('public/css/bootstrap.css') }}">-->
<link rel="stylesheet" type="text/css" href="{{ url('public/css/all.css') }}">
<link rel="stylesheet" type="text/css" href="{{ url('public/css/metismenu.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ url('public/css/fullcalendar.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ url('public/css/profile.css') }}">

<div class="page-wrapper inner_top" id="wrapper">

    <div class="page-container">

        <!-- Left Sidebar End -->
        @include('personal-profile.left_panel')
        <!-- Left Sidebar End -->

        <div class="page-content-wrapper">

            <div class="content-page">

                <div class="container-fluid">

                    <div class="page-title-box">
                        <h4 class="page-title">Followers</h4>
                        <input type="hidden" name='_token' id='_token' value="{{ csrf_token() }}" />
                    </div>
					<div id='systemMessage'></div>
                    <div class="followers_section padding-1 white-bg border-radius1">
						{!! $testdata !!}
                       
                    </div>

                </div>

            </div>

        </div>

    </div>


</div>
@include('layouts.footer')

<?php /*?><script src="{{ url('public/js/jquery-3.3.1.slim.min.js') }}"></script><?php */?>

<script src="{{ url('public/js/bootstrap.min.js') }}"></script>

<script src="{{ url('public/js/metisMenu.min.js') }}"></script>

<script src="{{ url('public/js/jquery.slimscroll.js') }}"></script>

<script src="{{ url('public/js/moment.min.js') }}"></script>

<?php /*?><script src="{{ url('public/js/fullcalendar.min.js') }}"></script>

<script src="{{ url('public/js/jquery.fullcalendar.js') }}"></script><?php */?>

<script src="{{ url('public/js/custom.js') }}"></script>

<script type="text/javascript">

$(".followerfun").click(function(){

    var _token = $("input[name='_token']").val();
    var fid = $(this).attr('id');
   
    $.ajax({
        type: 'POST',
        url: '{{route("follow_company")}}',
        data: {
          _token: _token,
          fid:fid
        },
        success: function(data) {
          //alert(data);
          //window.location.reload();
        }
    });
}); 


$(".remove-btn").click(function(){
    var _token = $("input[name='_token']").val();
    var fid = $(this).attr('id');
    
    $.ajax({
        type: 'POST',
        url: '{{route("remove_follower")}}',
        data: {
          _token: _token,
          fid:fid
        },
        success: function(response) {
			$("#systemMessage").html(response.msg).addClass('alert-class alert-danger');
			window.location.reload();
        }
    });
}); 

$(".followback").click(function(){
    var _token = $("input[name='_token']").val();
    var id = $(this).attr('id');
    var userid = $(this).attr('data-user');
    
    $.ajax({
        type: 'POST',
        url: '{{route("follow_back")}}',
        data: {
          _token: _token,
          id:id,
          userid:userid
        },
        success: function(data) {
			window.location.reload();
        }
    });
});

</script>
@endsection