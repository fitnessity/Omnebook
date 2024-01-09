@inject('request', 'Illuminate\Http\Request')
@extends('layouts.business.header')
@section('content')
@include('layouts.profile.business_topbar')

<meta name="csrf-token" content="{{ csrf_token() }}">
<link rel="shortcut icon" href="{{ url('public/img/favicon.png') }}">
<link rel="stylesheet" type="text/css" href="{{ url('public/css/profile.css') }}">
<script src="{{ url('public/dashboard-design/js/jquery-2.1.4.js')}}"></script>
<style>
    body .fc {
        font-size: 14px;
    }
    .current-time {
        background-color: #000;
        color: #fff;
        position: relative;
        cursor: pointer;
        padding-right: 5px;
        text-align: right;
    }

   /* .fc-slats .fc-widget-content:not(.fc-axis):hover {
        background-color: #cccccc;
    }*/
    
</style>

    <div class="main-content">
        <div class="page-content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col">
                        <div class="h-100">
                            <div class="row mb-3">
                                <div class="col-6">
                                    <div class="page-heading">
                                        <label>Calendar</label>
                                    </div>
                                </div>
                            </div>
                        
                            <div class="row">
                                <div class="page-wrapper " id="wrapper">
                                    <div class="page-container">
                                        <div class="calender-wrapper">
                                            <div class=""> 
                                                <div class="">
                                                    <div class="edit_profile_section padding-1 white-bg border-radius1">
                                                        @if(!request()->business_id && !request()->customer_id)
                                                            <div class="row">
                                                                <div class="col-lg-3 col-md-5 col-sm-5">
                                                                    <label>Company</label>
                                                                    <div class="form-group mb-10">
                                                                        <select class="form-select" id="companies"  onChange="updateBusinessId(this.value)">
                                                                            <option value="all"> ALL</option>
                                                                            @if($companies->isNotEmpty())
                                                                                @foreach($companies as $c)
                                                                                  <option value="{{ $c->id}}" @if(request()->business_id == $c->id) selected @endif> {{$c->public_company_name}}</option> 
                                                                                @endforeach
                                                                            @endif
                                                                        </select>
                                                                    </div>
                                                                </div>

                                                                <div class="col-lg-3 col-md-5 col-sm-5">
                                                                    <label>Family Members</label>
                                                                    <div class="form-group mb-10">
                                                                        <select class="form-select" name="members" onChange="updateMember(this.value)" id="members">
                                                                            <option value="all"> ALL</option>
                                                                            @forelse($familyDetails as $fm)
                                                                              <option value="{{ $fm->id}}"> {{$fm->full_name}}</option>
                                                                            @empty
                                                                            @endforelse
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        @endif
                                                        <div id='calendar'></div>
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
            </div><!-- container-fluid -->
        </div><!-- End Page-content -->
    </div><!-- end main content-->
</div><!-- END layout-wrapper -->


<div class="modal fade" id="schedule-edit" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <!-- Modal body -->
            <div class="modal-body">
                <div class="form-group book-info">
                </div>
            </div>
        </div>
    </div>
</div>

@include('layouts.business.footer')

<script>

    function initializeCalendar(fullaryData) {
        var SITEURL = "{{ url('/') }}";
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        var calendar = $('#calendar').fullCalendar('destroy'); 
        var calendar = $('#calendar').fullCalendar({
            editable: false,
            defaultView: 'month',
            selectable: true,
            slotDuration:  '00:15:00',
            snapDuration:  '00:15:00',
            firstDay:      0,
            timeFormat:    'h:mmA',
            displayEventEnd: true,
            displayEventTime: false,
            header: {
                left: 'prev,next today',
                center: 'title',
                right: 'month,agendaWeek,agendaDay'
            },
            events: fullaryData,
            eventLimit: true,
            fixedWeekCount: false,
            defaultView: 'month',
            nowIndicator: true,
            slotDuration: '00:30:00', // Set the duration for events
            slotLabelInterval: '00:30:00', // Set the interval for time labels in the header
            //snapDuration:  '00:30:00',
            displayEventEnd: true,
            eventRender: function (event, element, view) {
                element.find('.fc-title').html(event.description);
                //if (event.allDay === 'true') { event.allDay = true; } 
               // else { event.allDay = false; }
            },
            selectHelper: true,
            
            eventClick: function(events) {
                var eventName = events.title;
                $.ajax({
                    type: "POST",
                    url: '{{route("eventmodelboxdata")}}',
                    data: "&id=" + events.id + "&start=" + events.start.toISOString(),
                    success: function(data) {
                        if(data != ''){
                            $('.book-info').html(data);
                            $("#schedule-edit").modal('show');
                        }
                    }
                });
            },
        });
        calendar.fullCalendar('refetchEvents');
    }

    /*$('.fc-widget-content').hover(function(){
        if(!$(this).html()){    
            for(i=0;i<7;i++){
                $(this).append('<td class="temp-cell" style="border: 0px; width:'+(Number($('.fc-day').width())+3)+'px"></td>');
            }

            $(this).children('td').each(function(){
                $(this).hover(function(){
                    $(this).html('<div class=current-time>'+$(this).parent().parent().data('time').substring(0,5)+'</div>');
                },function(){
                    $(this).html('');
                });
            });
        }
    },function(){
        $(this).children('.temp-cell').remove();
    });*/
    
    $(document).on({
        mouseenter: function() {
            //$(this).css('background-color', 'lightblue');
            /*let cellWidth = $('th.fc-day-header').width();
            let cellHeight = $(this).height();
            let columnCount = $('thead table.fc-col-header th.fc-col-header-cell').children().length;

            if (!$(this).html()) {
                for (var i = 0; i < columnCount; i++) {
                    $(this).append('<td class="temp-cell" style="border:0px; height:' + (cellHeight - 1) + 'px;width:' + (cellWidth + 3) + 'px"></td>');
                }
            }
            $(this).children('td').each(function() {
                $(this).hover(function() {
                    let dtime = $(this).parent().data('time').slice(0, -3);
                    $(this).html('<div class="current-time">' + dtime + '</div>');
                }, function() {
                    $(this).html('');
                });
            });*/
            if(!$(this).html()){    
            for(i=0;i<7;i++){
                //$(this).append('<td class="temp-cell" style="border: 0px; width:'+(Number($('.fc-day').width())+3)+'px"></td>');
                $(this).append('<td class="temp-cell" style="border: 0px; width:'+(Number($('.fc-day-header').width())+3)+'px"></td>');
            }

            let currentDate = new Date();

            $(this).children('td').each(function(){
                $(this).hover(function(){
                    let time24Hour = $(this).parent().parent().data('time');
                    let time = new Date(currentDate.toDateString() + " " + time24Hour).toLocaleTimeString('en-US', { hour: 'numeric', minute: 'numeric', hour12: true });

                    $(this).html('<div class=current-time>'+time+'</div>');
                },function(){
                    $(this).html('');
                });
            });
        }
        },

        mouseleave: function() {
            //$(this).css('background-color', '');
            $(this).children('.temp-cell').remove();
        }

    }, '.fc-widget-content');
 /*$('.fc-slats td.fc-widget-content:not(.fc-axis)').hover(
            alert('hii')
        );*/
    $(document).ready(function () {

       /* $('.fc-slats td.fc-widget-content:not(.fc-axis)').on('mouseenter', function() {
            alert('inn')
            $(this).css('background-color', '#cccccc');
          }).on('mouseleave', function() {
            $(this).css('background-color', '');
          });*/



        var fullaryData = [
          @foreach($fullary as $dt)
            {
                id:'{{$dt["id"]}}',
                title:'{{$dt["title"] . ' \n '.date("h:i a", strtotime( $dt["shift_start"] )).' - '.$dt["time"] . ' \n '.$dt["full_name"]}}',  
                start:'{{$dt["start"]}}',
                end:'{{$dt["end"]}}',
            },
            @endforeach
        ];
      /*  console.log(fullaryData);*/

        initializeCalendar(fullaryData);
    });

</script>
<script type="text/javascript">
    function updateBusinessId(id) {
        var currentUrl = window.location.origin + window.location.pathname;
        if(id != 'all'){
            currentUrl = currentUrl+'?business_id=' + id;
        }

        $.ajax({
            url: currentUrl,
            type: 'GET',
            dataType: 'json',
            success: function(data) {
                initializeCalendar(data.events);
                $('#members').html(data.familyDetails);
            },
            error: function(error) {
                console.error('Error:', error);
            }
        });

    }

    function updateMember(id) {
        var business_id = $('#companies').val();
        var currentUrl = new URL(window.location.href);
        if (id !== 'all') {
            if (currentUrl.searchParams) {
                currentUrl.searchParams.set('customer_id', id);
            } else {
                var params = new URLSearchParams(currentUrl.search);
                params.set('customer_id', id);
                currentUrl.search = params.toString();
            }
        }

        if(business_id != 'all'){
            if (currentUrl.searchParams) {
                currentUrl.searchParams.set('business_id', business_id);
            } else {
                var params = new URLSearchParams(currentUrl.search);
                params.set('business_id', business_id);
                currentUrl.search = params.toString();
            }
        }

       var  url = currentUrl.toString()+'&type=customer';
        $.ajax({
            url: url,
            type: 'GET',
            dataType: 'json',
            success: function(data) {
                initializeCalendar(data);
            },
            error: function(error) {
                console.error('Error:', error);
            }
        });
    }
</script>

@endsection
