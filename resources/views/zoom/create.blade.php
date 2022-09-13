@extends('layouts.profile')

@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.5.20/jquery.datetimepicker.css" />
<link href="https://cdn.jsdelivr.net/npm/zebra_datepicker@latest/dist/css/default/zebra_datepicker.min.css" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/Zebra_datepicker/1.9.15/zebra_datepicker.src.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.5.20/jquery.datetimepicker.min.css" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.5.20/jquery.datetimepicker.full.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.5.20/jquery.datetimepicker.min.js"></script>
<style>
    .Zebra_DatePicker {
        background: #666;
        border-radius: 4px;
        box-shadow: 0 0 10px #888;
        color: #222;
        font: 13px Tahoma, Arial, Helvetica, sans-serif;
        padding: 3px;
        position: absolute;
        display: table;
        *width: 255px;
        top: 58px !important;
        left: 15px !important;
        z-index: 1200
    }

    .Zebra_DatePicker *,
    .Zebra_DatePicker :after,
    .Zebra_DatePicker :before {
        box-sizing: content-box !important
    }

    .Zebra_DatePicker * {
        padding: 0
    }

    .Zebra_DatePicker table {
        border-collapse: collapse;
        border-radius: 4px;
        border-spacing: 0;
        width: 100%
    }

    .Zebra_DatePicker td,
    .Zebra_DatePicker th {
        padding: 5px;
        cursor: pointer;
        text-align: center;
        min-width: 25px;
        width: 25px
    }

    .Zebra_DatePicker .dp_body td,
    .Zebra_DatePicker .dp_body th {
        border: 1px solid #bfbfbf
    }

    .Zebra_DatePicker .dp_body td:first-child,
    .Zebra_DatePicker .dp_body th:first-child {
        border-left: none
    }

    .Zebra_DatePicker .dp_body td:last-child,
    .Zebra_DatePicker .dp_body th:last-child {
        border-right: none
    }

    .Zebra_DatePicker .dp_body tr:first-child td,
    .Zebra_DatePicker .dp_body tr:first-child th {
        border-top: none
    }

    .Zebra_DatePicker .dp_body tr:last-child td,
    .Zebra_DatePicker .dp_body tr:last-child th {
        border-bottom: none
    }

    .Zebra_DatePicker .dp_body td {
        background: #e6e5e5
    }

    .Zebra_DatePicker .dp_body .dp_weekend {
        background: #d6d6d6
    }

    .Zebra_DatePicker .dp_body .dp_not_in_month {
        background: #e0e6f2;
        color: #98acd4
    }

    .Zebra_DatePicker .dp_body .dp_time_controls_condensed td {
        width: 25%
    }

    .Zebra_DatePicker .dp_body .dp_current {
        color: #cc236b
    }

    .Zebra_DatePicker .dp_body .dp_selected {
        background: #b56a6a;
        color: #fff
    }

    .Zebra_DatePicker .dp_body .dp_disabled {
        background: #f2f2f2;
        color: #ccc;
        cursor: text
    }

    .Zebra_DatePicker .dp_body .dp_disabled.dp_current {
        color: #b56a6a
    }

    .Zebra_DatePicker .dp_body .dp_hover {
        color: #fff;
        background: #88a09e
    }

    .Zebra_DatePicker .dp_body .dp_hover.dp_time_control {
        background-color: #8c8c8c;
        color: #fff
    }

    .Zebra_DatePicker .dp_monthpicker td,
    .Zebra_DatePicker .dp_timepicker td,
    .Zebra_DatePicker .dp_yearpicker td {
        width: 33.3333%
    }

    .Zebra_DatePicker .dp_timepicker .dp_disabled {
        border: none;
        color: #222;
        font-size: 26px;
        font-weight: 700
    }

    .Zebra_DatePicker .dp_time_separator div {
        position: relative
    }

    .Zebra_DatePicker .dp_time_separator div:after {
        content: ":";
        color: 1px solid #bfbfbf;
        font-size: 20px;
        left: 100%;
        margin-left: 2px;
        margin-top: -13px;
        position: absolute;
        top: 50%;
        z-index: 1
    }

    .Zebra_DatePicker .dp_header {
        margin-bottom: 3px
    }

    @supports (-ms-ime-align:auto) {
        .Zebra_DatePicker .dp_header {
            font-family: 'Segoe UI Symbol', Tahoma, Arial, Helvetica, sans-serif
        }
    }

    .Zebra_DatePicker .dp_footer {
        margin-top: 3px
    }

    .Zebra_DatePicker .dp_footer .dp_icon {
        width: 50%
    }

    .Zebra_DatePicker .dp_actions td {
        border-radius: 4px;
        color: #fff
    }

    .Zebra_DatePicker .dp_actions .dp_caption {
        font-weight: 700;
        width: 100%
    }

    .Zebra_DatePicker .dp_actions .dp_next,
    .Zebra_DatePicker .dp_actions .dp_previous {
        *padding: 0 10px
    }

    .Zebra_DatePicker .dp_actions .dp_hover {
        background-color: #8c8c8c;
        color: #fff
    }

    .Zebra_DatePicker .dp_daypicker th {
        background: #fc3;
        cursor: text;
        font-weight: 700
    }

    .Zebra_DatePicker.dp_hidden {
        display: none
    }

    .Zebra_DatePicker .dp_icon {
        height: 16px;
        background-image: url(icons.png);
        background-repeat: no-repeat;
        text-indent: -9999px;
        *text-indent: 0
    }

    .Zebra_DatePicker .dp_icon.dp_confirm {
        background-position: center -123px
    }

    .Zebra_DatePicker .dp_icon.dp_view_toggler {
        background-position: center -91px
    }

    .Zebra_DatePicker .dp_icon.dp_view_toggler.dp_calendar {
        background-position: center -59px
    }

    button.Zebra_DatePicker_Icon {
        background: url(icons.png) center top no-repeat;
        border: none;
        cursor: pointer;
        display: block;
        height: 16px;
        line-height: 0;
        padding: 0;
        position: absolute;
        text-indent: -9000px;
        width: 16px
    }

    .Zebra_DatePicker .dp_daypicker th {
        background: #f53b49 !important;
        cursor: text;
        font-weight: 700;
        color: #fff !important;
    }

    button.Zebra_DatePicker_Icon.Zebra_DatePicker_Icon_Disabled {
        background-position: center -32px;
        cursor: default
    }

    section.main-slider.inner-banner.profile-banner {
        display: none;
    }

    h1,
    h3 {
        margin-bottom: 20px;
    }

    .col-md-8.right_side,
    .col-md-12.right_side {
        border: 0px solid #d4d4d4;
        margin: 30px 0px;
        padding: 15px 15px;
        border-radius: 3px;
        background-color: #f6f6f6c9;
    }

    .col-md-5.left_side {
        border: 0px solid #d4d4d4;
        margin: 30px 0px;
        padding: 15px 15px;
        border-radius: 3px;
        background-color: #f6f6f6c9;
    }

    .options {
        color: black;
        font-size: 13px;
        font-weight: 400;
    }

    .submit_service {
        background: #f53b49;
        color: #fff;
        padding: 6px 30px;
        border: none;
        font-size: 18px;
        border-radius: 6px;
        text-transform: uppercase;
    }
    
    .submit_service:hover {
        color: #fff;
    }

    #msg {
        background: #ff3636b0;
        padding: 7px 0px 3px 12px;
        margin-top: 10px;
        border-radius: 5px;
        color: #fff;
    }

    .xdsoft_timepicker.active {
        width: 100px;
    }

    .calfms {
        width: 20px;
        margin-left: 10px;
    }

    .curenttxt {
        text-align: center;
        font-size: 13px;
        margin-top: 20px;
    }

    .mt-1 {
        margin-top: 35px;
    }

    .custom-table th,
    .custom-table td {
        border: 0px !important;
    }

    .custom-table td a {
        color: #000;
        margin-right: 5px;
    }

    .custom-table td a:first-child {
        color: #014dff;
    }

    .bor1 {
        border-top: 1px solid #000;
    }

    caption {
        color: #000;
    }

</style>

<div class="createmeeting-sec">
    <div class="container">

        <div class="row">

            <div class="col-md-5 left_side creat_meeting">
                <h3><b>CREATE A MEET UP</b></h3>
                <form method="post" action="{{route('store')}}">
                    <input type="hidden" name="_token" value="{{csrf_token()}}">
                    <div class="form-group">
                        <label for="topic" style="color: #f53b49">Topic</label>
                        <input name="topic" class="form-control" type="text" value="" id="topic" required>
                    </div>

                    <div class="form-group">
                        <label for="topic" style="color: #f53b49">Description (Optional)</label>
                        <textarea name="agenda" class="form-control" type="text" value="" id="agenda"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="start_time" style="color: #f53b49">When</label>
                        <div class="row">
                            <div class="col-md-6"> <label for="start_time" style="color: #f53b49">Date</label>
                                <div id="datepicker-position">
                                    <input autocomplete="off" name="start_date" type="text" class="form-control" Required value="" id="start_time" />
                                </div>
                            </div>
                            <div class="col-md-3"> <label for="start_time" style="color: #f53b49">Time</label><input autocomplete="off" name="start_time" class="form-control" type="text" Required value="" id="1start_time"></div>
                            <div class="col-md-3"><label for="start_time" style="color: #f53b49">AM / PM</label><select name="ampm" class="form-control">
                                    <option value="am">AM</option>
                                    <option value="pm">PM</option>
                                </select>
                            </div>
                        </div>

                        <span>Starting Date and Time of the Meeting (Required).</span>
                    </div>

                    <div class="form-group">
                        <label for="timezone" style="color: #f53b49">Your Timezone</label>
                        <select name="timezone" class="" id="timezone">
                            <option value=""></option>
                            @foreach ($timezone as $key=>$record)
                            <option value="{{$key}}">{{$record}}</option>
                            @endforeach
                        </select>
                        <span>Meeting Timezone</span>
                    </div>
                    <div class="form-group">
                        <label for="password" style="color: #f53b49">Password (optional) but it is recommended</label>
                        <input name="password" class="form-control" type="text" value="" id="password" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" maxlength="10">
                        <span>Password length should be maximum 10 only </span>
                    </div>

                    <div class="form-group">
                        <label for="duration" style="color: #f53b49">Duration</label>
                        <div class="row">
                            <div class="col-md-6">
                                <label for="start_time" style="color: #f53b49">Hours</label>
                                <select name="durationh" class="form-control" id="duration">
                                    @for ($i=0;$i<=23;$i++) <option value="{{$i}}">{{$i}}</option>
                                        @endfor
                                </select></div>
                            <div class="col-md-6">
                                <label for="start_time" style="color: #f53b49">Min</label>
                                <select name="durationm" class="form-control" id="duration">
                                    <option value="0">0</option>
                                    <option value="15">15</option>
                                    <option value="30">30</option>
                                    <option value="45">45</option>

                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="form-group ">
                        <label for="option_jbh">
                            <input name="option_jbh" type="checkbox" value="1" id="option_jbh">
                            <span class="options">Recurring Meet Up</span>
                        </label>
                    </div>
                    <div class="form-group ">
                        <h4><b>Meeting Options</b></h4><br>
                        <label for="option_jbh" style="color: #f53b49">Join Before Host </label><br>
                        <label for="option_jbh" style="color: #f53b49">
                            <input name="option_jbh" type="checkbox" value="1" id="option_jbh">
                            <span class="options">Join meeting before host start the meeting. Only for scheduled or recurring meetings.</span></label>
                    </div>

                    <div class="form-group">
                        <label for="option_host_video" style="color: #f53b49">Host join start</label><br>
                        <label for="option_host_video" style="color: #f53b49">
                            <input name="option_host_video" type="checkbox" value="1" id="option_host_video">
                            <span class="options">Start video when host join meeting</span></label>
                    </div>

                    <div class="form-group">
                        <label for="option_participants_video" style="color: #f53b49">Participants Video</label><br>
                        <label for="option_participants_video" style="color: #f53b49">
                            <input name="option_participants_video" type="checkbox" value="1" id="option_participants_video">
                            <span class="options"> Start video when participants join meeting.</span></label>
                    </div>


                    {!! Form::submit('Create', ['class'=>'submit_service']) !!}

                </form>
            </div>

            <div class="col-md-7">

                <div class="col-md-8 right_side">
                    <h3><b>INVITE CUSTOMERS</b></h3>
                    <form method="post" action="{{route('invite')}}">
                        <input type="hidden" name="_token" value="{{csrf_token()}}">
                        <div class="form-group">
                            <label for="User" style="color: #f53b49">Select Users</label>
                            <select name="user[]" class="" id="user" multiple required="required">
                                <option value=""></option>
                                @foreach ($users as $record)
                                <option value="{{$record->email}}">{{$record->firstname.' '.$record->lastname}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="User" style="color: #f53b49">Select Meeting</label>
                            <select name="meeting" class="" id="mymeeting" required="required">
                                <option value=""></option>
                                @foreach ($meetings as $record)
                                <option value="{{$record['meeting_id']}}">{{$record['topic']}}</option>
                                @endforeach
                            </select>
                        </div>
                        {!! Form::submit('Invite', ['class'=>'submit_service']) !!}
                    </form>
                </div>
                <div class="col-md-4 mt-1" style="text-align:center; padding: 0;">
                    <a href="#" class="submit_service">UPGRADE</a>
                    <p class="curenttxt"><b>Current Membership</b> <br> <span>Free (30 Min. Meetings) Allowed)</span></p>
                </div>
                <br>
                <div class="col-md-12 title-meet">
                    <h3><b>MEET UPS</b><img src="{{ url('public/img/calendar-icon.jpg') }}" class="calfms"></h3>
                </div>
                <div class="col-md-12 right_side" style="margin-top:0px;">
                    <span><b>Upcoming</b></span>
                    <span><b>Previous</b></span>
                    <table class="table custom-table">
                        <thead>
                            <tr>
                                <th scope="col">Date</th>
                                <th scope="col">Time</th>
                                <th scope="col">Topic</th>
                                <th scope="col">Meeting ID</th>
                            </tr>
                        </thead>
                        <tbody>
                            <caption><b>Monday</b></caption>
                            <tr>
                                <td>05/03/2021</td>
                                <td>04:00 pm - 05:00 pm Est.</td>
                                <td>Kids Tues & Thursday Zoom Class</td>
                                <td>2000016776</td>
                            </tr>

                            <tr class="recuring-tr">
                                <td colspan="4"><a href="#">Start</a> <a href="#">Edit</a> <a href="#">Share</a> <a href="#">Delete</a> (recurring)</td>
                            </tr>

                            <tr>
                                <td>05/03/2021</td>
                                <td>01:00 pm - 02:30 pm Est.</td>
                                <td>Adult Tues & Thursday Zoom Class</td>
                                <td>2000016776</td>
                            </tr>
                            <tr class="recuring-tr">
                                <td colspan="4"><a href="#">Start</a> <a href="#">Edit</a> <a href="#">Share</a> <a href="#">Delete</a> (recurring)</td>
                            </tr>
                            <tr class="bor1">
                                <td colspan="4"><b>Tuesday</b></td>
                            </tr>
                            <tr>
                                <td>04/22/2021</td>
                                <td>04:00 pm - 05:00 pm Est.</td>
                                <td>Private Lesson with Ghass</td>
                                <td>2000016776</td>
                            </tr>
                            <tr>
                                <td colspan="4"><a href="#">Start</a> <a href="#">Edit</a> <a href="#">Share</a> <a href="#">Delete</a> </td>
                            </tr>

                        </tbody>
                    </table>
                </div>

                <div class="col-md-12">
                    <nav>
                        <ul class="pagination createpage">
                            <li class="page-item active" aria-current="page"><span class="page-link">1</span></li>
                            <li class="page-item"><a class="page-link" href="#">2</a></li>
                            <li class="page-item"><a class="page-link" href="#">3</a></li>
                            <li class="page-item"><a class="page-link" href="#">4</a></li>
                        </ul>
                    </nav>
                </div>

            </div>

        </div>
    </div>
</div>
<script>
    $('#start_time').Zebra_DatePicker({
        default_position: 'below',
        container: $('#datepicker-position')
    });
    $(document).ready(function() {
        $("#duration").keyup(function() {
            $('#msg').hide();
            if (!$.isNumeric($(this).val())) {
                $('#msg').text('Please Only number').show();
                $(this).val('');
                $(this).focus();
            }
        });
        var x = new SlimSelect({
            select: '#timezone'
        });
        var y = new SlimSelect({
            select: '#user'
        });
        var mymeeting = new SlimSelect({
            select: '#mymeeting'
        });

        $('.timepicker').timepicker({
            timeFormat: 'h:mm p',
            interval: 30,
            startTime: '00:00',
            dynamic: true,
            dropdown: true,
            scrollbar: true,
        });
    });
    // $('#start_time').datetimepicker(
    //     {timepicker:false,
    //     format:'d-m-Y',
    //     }
    // );
    $('#1start_time').datetimepicker({
        datepicker: false,
        timepicker: true,
        step: 30,
        format: 'h:i',
        formatTime: 'h:i',
    });

</script>

@endsection
