@inject('request', 'Illuminate\Http\Request')
@extends('layouts.business.header')
@section('content')
@include('layouts.profile.business_topbar')

<meta name="csrf-token" content="{{ csrf_token() }}">
<link rel="shortcut icon" href="{{ url('public/img/favicon.png') }}">
<link rel="stylesheet" type="text/css" href="{{ url('public/css/profile.css') }}">
<script src="{{ url('public/js/moment.min.js') }}"></script>

<style>
    body .fc {
        font-size: 14px;
    }
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
                                                                            @forelse($companies as $c)
                                                                              <option value="{{ $c->id}}" @if(request()->business_id == $c->id) selected @endif> {{$c->public_company_name}}</option> 
                                                                            @empty
                                                                            @endforelse
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
            editable: true,
            events: fullaryData,
            displayEventTime: false,
            editable: true,
            eventLimit: true,
            fixedWeekCount: false,
            header: {
                left: 'prev,next today',
                center: 'title',
                right: 'month,agendaWeek,agendaDay'
            },
            eventRender: function (event, element, view) {
                element.find('.fc-title').html(event.description);
                if (event.allDay === 'true') { event.allDay = true; } 
                else { event.allDay = false; }
            },
            selectable: true,
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

    $(document).ready(function () {
        var fullaryData = [
            @foreach($fullary as $dt)
            {
                allDay : false,
                id:'{{$dt["id"]}}',
                title:'{{$dt["title"] . ' \n '.date("h:i a", strtotime( $dt["shift_start"] )).' - '.$dt["time"] . ' \n '.$dt["full_name"]}}',  
                start:'{{$dt["start"].' '.date("h:i", strtotime( $dt["shift_start"]) )}}',
                end:'{{$dt["start"].' '.date("h:i", strtotime( $dt["shift_end"]) )}}',
            },
            @endforeach
        ];

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
