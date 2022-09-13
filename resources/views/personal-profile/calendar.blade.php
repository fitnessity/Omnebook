@extends('layouts.header')
@section('content')

<meta name="csrf-token" content="{{ csrf_token() }}">

<link rel="shortcut icon" href="{{ url('public/img/favicon.png') }}">

<!--<link rel="stylesheet" type="text/css" href="{{ url('public/css/bootstrap.css') }}">-->
<link rel="stylesheet" type="text/css" href="{{ url('public/css/all.css') }}">
<link rel="stylesheet" type="text/css" href="{{ url('public/css/metismenu.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ url('public/css/fullcalendar.min.css') }}">
<link rel="stylesheet" href="{{ url('public/css/fullcalendar.css') }}" />
<link rel="stylesheet" type="text/css" href="{{ url('public/css/profile.css') }}">

<!--<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" />-->

<!--<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>-->
<script src="{{ url('public/js/moment.min.js') }}"></script>

<script src="{{ url('public/js/fullcalendar.js') }}"></script>

<style>
    body .fc {
        font-size: 14px;
    }
    
    /*body {
        font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;
    }*/
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
                            <div class="complete-block">
                                <a href="#" class="complete-link">complete</a>
                                <a href="#" class="incomplete-link">incomplete</a>
                            </div>
                        </div>
                    </div>

                </div>

            </div>

        </div>

    </div>


</div>
@include('layouts.footer')

<?php /*<script src="{{ url('public/js/jquery.js') }}"></script>

<script src="{{ url('public/js/bootstrap.min.js') }}"></script>

<script src="{{ url('public/js/metisMenu.min.js') }}"></script>

<script src="{{ url('public/js/jquery.slimscroll.js') }}"></script>

<script src="{{ url('public/js/moment.min.js') }}"></script>

<script src="{{ url('public/js/fullcalendar.min.js') }}"></script>

<script src="{{ url('public/js/jquery.fullcalendar.js') }}"></script>

<script src="{{ url('public/js/custom.js') }}"></script>*/?>

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

            events:'{{route("calendar")}}',

            displayEventTime: false,

            editable: true,

            eventRender: function (event, element, view) {

                if (event.allDay === 'true') {

                        event.allDay = true;

                } else {

                        event.allDay = false;

                }

            },

            selectable: true,

            selectHelper: true,

            select: function (start, end, allDay) {

                var title = prompt('Event Title:');

                if (title) {

                    var start = $.fullCalendar.formatDate(start, "Y-MM-DD");

                    var end = $.fullCalendar.formatDate(end, "Y-MM-DD");

                    $.ajax({

                        url:'{{route("fullcalenderAjax")}}',

                        data: {
                            "_token": "{{ csrf_token() }}",
                            title: title,

                            start: start,

                            end: end,

                            type: 'add'

                        },

                        type: "POST",

                        success: function (data) {

                            displayMessage("Event Created Successfully");



                            calendar.fullCalendar('renderEvent',

                                {

                                    id: data.id,

                                    title: title,

                                    start: start,

                                    end: end,

                                    allDay: allDay

                                },true);



                            calendar.fullCalendar('unselect');

                        }

                    });

                }

            },

            eventDrop: function (event, delta) {

                var start = $.fullCalendar.formatDate(event.start, "Y-MM-DD");

                var end = $.fullCalendar.formatDate(event.end, "Y-MM-DD");



                $.ajax({

                    url:'{{route("fullcalenderAjax")}}',

                    data: {
                        "_token": "{{ csrf_token() }}",

                        title: event.title,

                        start: start,

                        end: end,

                        id: event.id,

                        type: 'update'

                    },

                    type: "POST",

                    success: function (response) {

                        displayMessage("Event Updated Successfully");

                    }

                });

            },
            
            eventClick: function (event) {

                var deleteMsg = confirm("Do you really want to delete?");

                if (deleteMsg) {

                    $.ajax({

                        type: "POST",

                        url:'{{route("fullcalenderAjax")}}',

                        data: {
                            "_token": "{{ csrf_token() }}",

                                id: event.id,

                                type: 'delete'

                        },

                        success: function (response) {

                            calendar.fullCalendar('removeEvents', event.id);

                            displayMessage("Event Deleted Successfully");

                        }

                    });

                }

            }
        });
    });



    function displayMessage(message) {

        toastr.success(message, 'Event');

    } 


</script>


@endsection
