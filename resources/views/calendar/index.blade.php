@extends('layouts.header')
@section('content')

<meta name="csrf-token" content="{{ csrf_token() }}">

<link rel="shortcut icon" href="{{ url('public/img/favicon.png') }}">

<link rel="stylesheet" type="text/css" href="{{ url('public/css/all.css') }}">
<link rel="stylesheet" type="text/css" href="{{ url('public/css/metismenu.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ url('public/css/fullcalendar/fullcalendar.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ url('public/css/profile.css') }}">
<script src="{{ url('public/js/moment.min.js') }}"></script>
<script src="{{ url('public/js/fullcalendar/fullcalendar.min.js') }}"></script>

<style>
    body .fc {
        font-size: 14px;
    }
    
</style>
<!--<div class="container">
</div>
<div id='calendar'></div>-->
<div class="page-wrapper inner_top" id="wrapper">
    <div class="page-container">
        <!-- Left Sidebar Start -->
        @include('personal-profile.left_panel')
        <!-- Left Sidebar End -->
        <div class="page-content-wrapper">
            <div class="content-page">
                <div class="container-fluid">
                    <div class="page-title-box">
                        <h4 class="page-title">Schedule</h4>
                    </div>
                    <div class="edit_profile_section padding-1 white-bg border-radius1">
                        <div id='calendar'>
                            <!--<div class="complete-block">
                                <a href="#" class="complete-link">complete</a>
                                <a href="#" class="incomplete-link">incomplete</a>
                            </div>-->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="schedule-add">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Add Your Schedule</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <!-- Modal body -->
            <div class="modal-body">
                <form>
                    <div class="form-group">
                        <label>Schedule Name:</label>
                        <input type="text" class="form-control">
                    </div>
                </form>
            </div>
            <!-- Modal footer -->
           
        </div>
    </div>
</div>


<div class="modal fade" id="schedule-edit">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Edit Your Schedule</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <!-- Modal body -->
            <div class="modal-body">
                <form>
                    <div class="form-group">
                        <label>Schedule Name:</label>
                        <input type="text" id="shedulename" class="form-control">
                    </div>
                </form>
            </div>
            <!-- Modal footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-success" onclick="openmodelbox()">Save Your Schedule</button>
            </div>
        </div>
    </div>
</div>
@include('layouts.footer')
<script>
	$(document).ready(function () {
		var SITEURL = "{{ url('/') }}";
        $.ajaxSetup({
            headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        var calendar = $('#calendar').fullCalendar({
            editable: true,
           //events:'{{route("calendar")}}',
            events:[
                @foreach($fullary as $dt)
                {
                    allDay : false,
                    id:'{{$dt["id"]}}',
                    title:'{{$dt["title"] . ' \n '.$dt["shift_start"].' - '.$dt["time"]}}',    
                    //start:'{{$dt["start"]}}',
                    start:'{{$dt["start"].'T'.$dt["shift_start"]}}',
                    end:'{{$dt["start"].'T'.$dt["shift_end"]}}',
                },
                @endforeach
            ], 
           
            displayEventTime: false,
            editable: true,
			fixedWeekCount:false,
			header: {
				left: 'prev,next today',
				center: 'title',
				right: 'month,agendaWeek,agendaDay'
			},
            eventRender: function (event, element, view) {
             //alert('call');
                if (event.allDay === 'true') { event.allDay = true; } 
				else { event.allDay = false; }
            },
            selectable: true,
            selectHelper: true,

            /*eventClick: function(events) {
                var eventName = events.title;
                var modal = $("#schedule-edit");
                var inputF = document.getElementById("shedulename");
                inputF.setAttribute('value', eventName);
                modal.modal();
            },*/
            
        });
    });
    function displayMessage(message) {
        toastr.success(message, 'Event');
    }

    function openmodelbox(){
        $('#schedule-edit').modal('hide');
        $('#schedule-add').modal('show');
    }
</script>

@endsection
