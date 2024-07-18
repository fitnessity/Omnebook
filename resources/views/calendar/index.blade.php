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
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <!-- Modal body -->
            <div class="modal-body">
                <div class="form-group book-info">
                    <!-- <label id="activity_name"></label>
                    <a class="btn btn-danger" href="">View booking details</a> -->
                </div>
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
        var daydate = '';
        var calendar = $('#calendar').fullCalendar({
            editable: true,
           //events:'{{route("calendar")}}',
            events:[
                @foreach($fullary as $dt)
                {
                    allDay : false,
                    id:'{{$dt["id"]}}',
                    title:'{{$dt["title"] . ' \n '.date("h:i a", strtotime( $dt["shift_start"] )).' - '.$dt["time"] . ' \n '.$dt["full_name"]}}',    
                    //start:'{{$dt["start"]}}',
                    start:'{{$dt["start"].' '.date("h:i", strtotime( $dt["shift_start"]) )}}',
                    end:'{{$dt["start"].' '.date("h:i", strtotime( $dt["shift_end"]) )}}'
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

            /*dayClick: function(date, jsEvent, view) {

                alert('Clicked on: ' + date.format());

                alert('Coordinates: ' + jsEvent.pageX + ',' + jsEvent.pageY);

                alert('Current view: ' + view.name);

                // change the day's background color just for fun
                $(this).css('background-color', 'red');

              }
*/
            eventClick: function(events) {
                /*var time = events.start;*/
                var eventName = events.title;
                $.ajax({
                    type: "POST",
                    url: '{{route("eventmodelboxdata")}}',
                    data: "&id=" + events.id + "&start=" + events.start.toISOString(),
                    success: function(data) {
                        if(data != ''){
                            $('.book-info').html(data);
                            var modal = $("#schedule-edit");
                            modal.modal();
                        }
                    }
                });
                
               
              //$('#activity_name').html(eventName);
               
            },
            
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
