 @inject('request', 'Illuminate\Http\Request')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title>Schedule</title>
    <link href="{{ asset('/dashboard-design/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
    <link rel='stylesheet' type='text/css' href="{{ asset('/css/bootstrap-select.min.css') }}">
    <link href="{{ url('/public/dashboard-design/css/style.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ url('/public/dashboard-design/css/custom.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ url('/public/dashboard-design/css/icons.min.css')}}" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" type="text/css" href="{{ url('/public/css/all.css') }}">
</head>
<style>
    html {
        position: relative;
        min-height: 100%;
    }
    btn {
        width: auto;
    }

    body {
        font-family: Arial, sans-serif;
        margin: 0;
        padding: 0px;
        overflow-x: hidden;
    }

    input {
        display: block;
        /* margin: 10px 0; */
        padding: 5px;
        width: 100%;
    }

    button {
        display: block;
        padding: 5px;
    }

    #loom-companion-mv3 {
        display: none;
    }

    .wrap-sp {
        display: inline-flex;
    }
    .show-all .table-price {
        padding: 10px 0;
        float: right;
    }
    .poweredby-ul img {
        margin: 40px 0px 40px 0;
        width: 240px;
    }
    .password-addon i {
        right: 0 !important;
        top: 0;
        position: absolute;
        min-height: 45px;
        padding: 18px;
        color: #04344d;
        background: none;
        border: none;
    }
    .border-list{
        border-bottom: 1px solid #efefef;
        margin-bottom: 10px;
    }
    .show-all .table-inner-data-sec .p-name{
        width: 430px;
    }
    .poweredby-ul{
        text-align: center;
    }
    @media screen and (min-width: 1000px) and (max-width: 1200px){
        .register_wrap form {
            padding: 0 20px;
            float: none;
        }
    }
    @media screen and (min-width: 390px) and (max-width: 699px){ 
        .show-all .table-inner-data-sec .p-name {
            width: 300px;
        }
        .table-inner-data-sec{margin-bottom: 15px; margin-top: 15px;}
        .register_wrap form {
            padding: 0 15px;
        }
    }
    @media screen and (max-width: 389px){ 
        .show-all .table-inner-data-sec .p-name {
            width: 250px;
        }
        .table-inner-data-sec{margin-bottom: 15px; margin-top: 15px;}
        .register_wrap form {
            padding: 0 15px;
        }
        .poweredby-ul img{
            width: 215px;
        }
    }
    @media screen and (min-width: 768px) and (max-width: 992px){
        .register_wrap form {
            padding: 0 50px;
        }
        .show-all .table-inner-data-sec .p-name {
            width: 270px;
        }
    }
    .instructors
    {
        z-index: 9999;
    }
    .header-bg-show {
        background: #efefef;
        padding: 10px;
        border-radius: 4px;
        margin-bottom: 15px;
    }
    .header-bg-show .day-date span {
        font-size: 17px;
        font-weight: 500;
        }
    .header-bg-show .time-base {
            float: right;
        }
    .header-bg-show .time-base label {
        font-size: 17px;
        font-weight: 500;
     }
    .header-bg-show .time-base span {
        font-size: 17px;
        color: #337ab7;
        text-decoration: underline;
    }
</style>
<style>
    @import url('https://fonts.googleapis.com/css2?family=Lato:ital,wght@0,100;0,300;0,400;0,700;0,900;1,100;1,300;1,400;1,700;1,900&display=swap');
    @import url('https://fonts.googleapis.com/css2?family=Oswald:wght@200..700&display=swap');
    @import url('https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@300..700&display=swap');
    @import url('https://fonts.googleapis.com/css2?family=Josefin+Sans:ital,wght@0,100..700;1,100..700&display=swap');
    @import url('https://fonts.googleapis.com/css2?family=Signika:wght@300..700&display=swap');
    @import url('https://fonts.googleapis.com/css2?family=Sofadi+One&display=swap');
    @import url('https://fonts.googleapis.com/css2?family=Gowun+Batang:wght@400;700&family=Sofadi+One&display=swap');
    @import url('https://fonts.googleapis.com/css2?family=Gowun+Batang:wght@400;700&family=Kanit:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Sofadi+One&display=swap');
    @import url('https://fonts.googleapis.com/css2?family=Gowun+Batang:wght@400;700&family=Kanit:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Playpen+Sans:wght@100..800&family=Sofadi+One&display=swap');
    @import url('https://fonts.googleapis.com/css2?family=Gowun+Batang:wght@400;700&family=Great+Vibes&family=Kanit:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Playpen+Sans:wght@100..800&family=Sofadi+One&display=swap');
    @import url('https://fonts.googleapis.com/css2?family=Arsenal+SC:ital,wght@0,400;0,700;1,400;1,700&family=Gowun+Batang:wght@400;700&family=Great+Vibes&family=Kanit:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Playpen+Sans:wght@100..800&family=Sofadi+One&display=swap');

</style>
</head>
@php
$logBgColor =
    isset($companyinfo) && is_object($companyinfo)
        ? $companyinfo->secondary_color
        : '#000';
$logTextColor =
    isset($companyinfo) && is_object($companyinfo)
        ? $companyinfo->primary_color
        : '#fff';
        $schedulecolor = isset($companyinfo) && is_object($companyinfo)
        ? $companyinfo->schedule_label
        : '#defaultTextColors';
    
    if (isset($companyinfo) && is_object($companyinfo)) {
        $schedule_back_color = $companyinfo->schedule_back_color;
        $font=$companyinfo->font;
        $btnstyle=$companyinfo->button_style;
        $btntext=$companyinfo->button_text;
        $schedulecolor=$companyinfo->schedule_label;
        $logBgColor = $companyinfo->secondary_color;
        $logTextColor = $companyinfo->primary_color;
        $scheduleLabel=$companyinfo->schedule_label;
        $scheduleText=$companyinfo->schedule_label_color;
        $scheduledate=$companyinfo->date_color;

    } else {
        $schedule_back=App\WebsiteIntegration::where('business_id',$code->id)->first();
        $schedule_back_color = $schedule_back->schedule_back_color;
        $font=$schedule_back->font;
        $btnstyle=$schedule_back->button_style;
        $btntext=$schedule_back->button_text;
        $schedulecolor=$schedule_back->schedule_label;
        $logBgColor = $schedule_back->secondary_color;
        $logTextColor = $schedule_back->primary_color;
        $scheduleLabel=$schedule_back->schedule_label;
        $scheduleText=$schedule_back->schedule_label_color;
        $scheduledate=$schedule_back->date_color;

    }   
   
@endphp

{{-- <body style="background-color:{{$companyinfo['schedule_back_color']}}"> --}}
    <body style="background-color:{{ $schedule_back_color ?? '#fff' }};" class="{{ $font }}"> 
        <div class="container mt-4" id="filters">
            <div class="row">
                <div class="col-lg-3 col-md-3">
                    <div class="row">
                        <div class="col-lg-12 service-pr-0">
                            <div class="mb-5">
                                <label class="card-title mb-0 flex-grow-1">Services</label>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="card-body">
                                <select class="form-select mb-15" name="services" id="servicesDropdown" onchange="filterBookings()">
                                    <option value="All Services" {{ request('services') == 'All Services' ? 'selected' : '' }}>All Services</option>
                                    <option value="classes" {{ request('services') == 'classes' ? 'selected' : '' }}>Classes</option>
                                    <option value="individual" {{ request('services') == 'individual' ? 'selected' : '' }}>Personal Trainer</option>
                                    <option value="events" {{ request('services') == 'events' ? 'selected' : '' }}>Events</option>
                                    <option value="experience" {{ request('services') == 'experience' ? 'selected' : '' }}>Adventures & Tours</option>
                                </select>
                            </div>
                        </div>
                    </div>                                        
                </div>
                <div class="col-lg-3 col-md-3">
                    <div>
                        <div class="col-lg-12 fall-schedule">
                            <div class="mb-5">
                                <label class="card-title mb-0 flex-grow-1">Great For</label>
                            </div>
                        </div>
                    
                        <div class="col-lg-12 fall-schedule">
                            <div class="card-body">
                                <select class="form-select mb-15" name="great_for" id="greatForDropdown" onchange="filterBookings()">
                                    <option value="All" {{ request('great_for') == 'All' ? 'selected' : '' }}>All</option>
                                    <option value="adults" {{ request('great_for') == 'adults' ? 'selected' : '' }}>Adults</option>
                                    <option value="kids" {{ request('great_for') == 'kids' ? 'selected' : '' }}>Kids</option>
                                    <option value="infants" {{ request('great_for') == 'infants' ? 'selected' : '' }}>Infants</option>
                                </select>
                            </div>
                        </div>
                    </div>                                        
                </div>
                <div class="col-lg-3 col-md-3">
                    <div>
                        <div class="col-lg-12 fall-schedule">
                            <div class="mb-5">
                                <label class="card-title mb-0 flex-grow-1">Difficulty Level</label>
                            </div>
                        </div>
                        @php
                            $difficultylevel=$difficultylevel??'All Levels';
                        @endphp
                        <div class="col-lg-12 fall-schedule">
                            <div class="card-body">
                                <select class="form-select mb-15" name="difficulty_level" id="difficultyLevelDropdown" onchange="filterBookings()">
                                    <option value="All Levels" {{ request('difficulty_level') == 'All Levels' ? 'selected' : '' }}>All Levels</option>
                                    <option value="easy" {{ request('difficulty_level') == 'easy' ? 'selected' : '' }}>Beginner</option>
                                    <option value="medium" {{ request('difficulty_level') == 'medium' ? 'selected' : '' }}>Intermediate</option>
                                    <option value="hard" {{ request('difficulty_level') == 'hard' ? 'selected' : '' }}>Advance</option>
                                </select>
                            </div>
                        </div>
                    </div>                                        
                </div>
                <div class="col-lg-3 col-md-3">
                    <div class="">
                        <div class="col-lg-12 staff-pl-0">
                            <div class="mb-5">
                                <label class="card-title mb-0 flex-grow-1">All Staff</label>
                            </div>
                        </div>
                        <div class="col-lg-12 staff-pl-0">
                            <div class="card-body">
                                <select class="form-select mb-15" name="know_from">
                                    <option value="All Staff" Selected>All Staff</option>
                                </select>
                            </div>
                        </div>
                    </div> 
                </div>
            </div>
        </div>
    <section class="show-all" id="show_all">
        <div class="container">
            <div class="row">
                @foreach ($days as $date)
                    @php
                        // $hint_class = ($filter_date->format('Y-m-d') == $date->format('Y-m-d')) ? 'pairets' : 'pairets-inviable';
                        $isCurrentDate = $filter_date->format('Y-m-d') == $date->format('Y-m-d');
                        $hint_class = $isCurrentDate ? 'pairets' : 'pairets-inviable';
                        $style = $isCurrentDate ? "background-color: " . ($schedulecolor ?? '#defaultColor') : '';
                     @endphp
                    <div class="col-md-2 col-sm-2 col-xs-6 col-6">
                        <div class="{{$hint_class}}" style="{{ $style }}">
                            {{-- <a href="{{$request->fullUrlWithQuery(['date' => $date->format('Y-m-d')])}}" class="calendar-btn" >{{$date->format("D d")}}</a> --}}
                            <a href="{{ $request->fullUrlWithQuery([
                                'date' => $date->format('Y-m-d'),
                                'services' => request('services'),
                                'great_for' => request('great_for'),
                                'difficulty_level' => request('difficulty_level')
                            ]) }}" class="calendar-btn" style="color:{{$scheduledate}}">{{$date->format("D d")}}</a>
                        </div>
                    </div>
                @endforeach
            </div>
        
            <div class="row">
                <div class="col-md-12">
                    <div class="header-bg-show">
                        <div class="row">
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <div class="day-date">
                                    <span>{{$filter_date->format("D d")}}</span>
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <div class="time-base">
                                    <label>Time Based On:</label>
                                    <span>New York, NY</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    @foreach ($bookschedulers as $bookscheduler)
                        @php
                         $spot_left = $bookscheduler->spots_left($filter_date);
                        @endphp
                        {{-- @if ($bookscheduler->price_detail() > 0 || $bookscheduler->class_detail() > 0   && $spot_left > 0) --}}
                        @if ($bookscheduler->class_detail() > 0 && $spot_left > 0)
                           <div class="row">
                                <div class="col-md-12">
                                    <div class="border-list">
                                        <div class="row mb-10">
                                            <div class="col-md-2 col-xs-12 col-sm-2">
                                                <div class="table-inner-data">
                                                    <span class="mg-time"> {{date('h:i A', strtotime($bookscheduler['shift_start']))}} </span>
                                                    <div class="bg-red-nen" style="color:{{$scheduleText}};background-color:{{$scheduleLabel}}">
                                                        <span> {{$bookscheduler->get_clean_duration()}} </span>
                                                    </div>
                                                </div> 
                                            </div>
                                            <div class="col-md-7 col-xs-12 col-sm-5">
                                                <div class="table-inner-data-sec">
                                                    {{-- <img src="{{ Storage::disk('s3')->exists($bookscheduler->business_service->first_profile_pic()) ? Storage::URL($bookscheduler->business_service->first_profile_pic()) : url('/images/service-nofound.jpg') }}" alt="Fitnessity"> --}}
                                                    <img src="{{ $bookscheduler->business_service->first_profile_pic() ? $bookscheduler->business_service->first_profile_pic() : url('/images/service-nofound.jpg') }}" alt="Fitnessity">                                                    
                                                    <div class="p-name font-change">
                                                        <label>{{$bookscheduler->business_service->program_name}}</label>
                                                        <p> {{$bookscheduler->business_service->formal_service_types()}} | {{$bookscheduler->business_service->sport_activity}} | Spot Available - {{$bookscheduler->spots_left($filter_date)}}/{{$bookscheduler->spots_available}}
                                                        </p>     
                                                        <p>Instructor: {{$bookscheduler->getInstructorNames()}} <span class="difficult-level">Difficulty Level:  {{$bookscheduler->getClassNames()}}</span></p>
                                                        @if ($bookscheduler->is_start_in_one_hour($filter_date))
                                                            <span> Starting in {{$bookscheduler->time_left($filter_date)->format('%i minutes')}} </span>
                                                        @endif
                                                        
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-1 col-xs-3 col-sm-2 col-2">
                                                <div class="star-rest">
                                                    <div class="activity-inner-data">
                                                        <i class="fas fa-star" style="color:{{$schedulecolor}}"></i>
                                                        <span> {{$bookscheduler->business_service->reviews_score()}} </span>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- <div class="col-md-1 col-xs-3 col-sm-1 col-4">
                                                <div class="table-price">
                                                    {{-- <span> ${{$bookscheduler->price_detail()}} {{$bookscheduler->class_detail()}}</span> --}}
                                                    {{-- <span> ${{$bookscheduler->class_detail()}}</span> --}}

                                                </div>
                                            </div> -->
                                            <div class="col-md-2 col-xs-6 col-sm-2 col-6">
                                                <div class="join-btn">
                                                    @php
                                                        $buttonStyle = '';
                                                        $buttonBackground = '';
                                                        $buttonBorder = '';
                                                        
                                                        if ($btnstyle == 'outline-strokeme') {
                                                            $buttonBackground = 'none';
                                                            $buttonBorder = '2px solid ' . $logBgColor;
                                                        } elseif ($btnstyle == 'text-only') {
                                                            $buttonBackground = 'none';
                                                            $buttonBorder = 'none';
                                                        } else {
                                                            $buttonBackground = $logBgColor;
                                                            $buttonBorder = '2px solid ' . $logBgColor;
                                                        }
                                                    @endphp
                                                    <button type="button" class="btn book_now {{ $btnstyle }}" data-bs-toggle="modal" data-bs-target="#example" data-bookingid="{{ $bookscheduler->id }}" style="background-color: {{ $buttonBackground }}; border: {{ $buttonBorder }}; color: {{ $logTextColor }};" onclick="updateModalBookingId(this)">
                                                        {{ $btntext ?? 'Book Now' }}
                                                    </button>
                                                 </div>                                                  
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                    @endforeach
                </div>
            </div>
        </div>
    </section>
    <section class="showall">
        <div class="container">
        </div>
    </section>
    @php
    $backgroundImg =
        isset($companyinfo) && is_object($companyinfo)
            ? $companyinfo->background_img
            : 'public/images/register-bg.jpg';
    $backgroundImgUrl = Storage::disk('s3')->exists($backgroundImg)
        ? asset(Storage::url($backgroundImg))
        : asset('public/images/register-bg.jpg');
    @endphp
    {{-- modals start --}}
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Sign In</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    @if(isset($bookscheduler))
                     <input type="hidden" id="booking-id-input" value="{{ $bookscheduler->id }}">
                    @endif
                    {{-- new code start --}}
                    <section class="register height-vh" style="background-image: url('{{ $backgroundImgUrl }}');">
                        <div class="container">
                            <div class="row">
                                <div class="col-lg-6 col-md-12 col-sm-7 col-xs-12">
                                    <div class="register_wrap" id="signup_normal">
                                        <input type="hidden" id="showstep" value="">
                                        <div class="logo-my">
                                            <a href="javascript:void(0)">
                                                @if (isset($companyinfo) &&
                                                        is_object($companyinfo) &&
                                                        Storage::disk('s3')->exists($companyinfo->logo) &&
                                                        $companyinfo->logo != '')
                                                    <div class="item-inner">
                                                        <img src="{{ Storage::disk('s3')->url($companyinfo->logo) }}" alt="Fitnessity"
                                                            loading="lazy">
                                                    </div>
                                                @else
                                                    <img src="{{ asset('public/images/omnebook.png') }}" alt="Fitnessity"
                                                        loading="lazy">
                                                @endif
                                            </a>
                                        </div>
                                        <form method="post" action="#" id="myForm">
                                            {{ csrf_field() }}
                                            <div class="pop-title ftitle1">
                                                <h3>{{$code->company_name}}</h3>
                                            </div>
                                            <br />
                                            @if (session('success'))
                                                <div class="alert alert-success">
                                                    {{ session('success') }}
                                                </div>
                                            @endif
                
                                                <div id='systemMessage' class="alert-class alert-danger fs-14 font-red">
                                                </div>
                                            
                                            <input type="hidden" name="redirecthidden" id="redirecthidden" value="762788">
                                            <input type="hidden" name="redirect" value="{{ $request->redirect }}">
                                            <input type="email" name="email" id="email" class="myemail" size="30"
                                                autocomplete="off" placeholder="e-MAIL" maxlength="80" autocomplete="off">
                                            <span class="text-danger cls-error fs-14" id="erremail"></span>
                                            <div class="position-relative auth-pass-inputgroup">
                                                <input class="password-input" type="password" name="password" id="password" size="30" placeholder="Password" autocomplete="off">
                                                <button class="btn-link position-absolute password-addon toggle-password" type="button" id="password-addon" style="width:10%"><i class="fas fa-eye"></i></button>
                                            </div>
                                            <span class="text-danger cls-error" id="errpass"></span>
                                            <div class="remembermediv terms-wrap">
                                                <input type="checkbox" id="remember" name="remember" checked
                                                    class="remembercheckbox" />
                                                <span for="remember" class="rememberme">Remember me</span>
                                            </div>
                
                                            <?php echo /* form_password($password);*/ $show_captcha = ''; ?>
                                            <div id='capchaimg'><?php if ($show_captcha) { ?><?php echo $captcha_html; ?><?php } ?></div>
                                            <?php if ($show_captcha) { ?> <?php echo form_input($captcha); ?> <?php } ?>
                
                                            @php
                                            $logBgColor = isset($companyinfo) && is_object($companyinfo)
                                                ? $companyinfo->log_bg_color
                                                : '#defaultBackgroundColor';
                                            $logTextColor = isset($companyinfo) && is_object($companyinfo)
                                                ? $companyinfo->log_textcolor
                                                : '#defaultTextColor';
                                        @endphp
                                        
                                        <button class="btn signup-new" id="login_submit" type="submit"
                                            style="background-color: {{ $logBgColor }}; color: {{ $logTextColor }}; border: 1px solid {{ $logBgColor }};">
                                            Log in
                                        </button>
                                        
                                                <div class="poweredby-ul">
                                                    <img src="https://dev.fitnessity.co//public/dashboard-design/images/powered-by-OMNEBOOK.png" alt="" >
                                                </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>  

                    {{-- ends --}}
                </div>
                {{-- <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div> --}}
            </div>
            </div>
        </div>
    {{-- modals end --}}

    {{-- purchase membership modal start --}}
    <div class="modal fade" id="anotherModal" tabindex="-1" aria-labelledby="anotherModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="anotherModalLabel">Membership Details</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Add your content here -->
                </div>
            </div>
        </div>
    </div>
    


    {{-- ends --}}

    	<!-- Modal Structure -->
        <div class="modal fade instructors" id="instructorModal" tabindex="-1" aria-labelledby="instructorModalLabel" aria-hidden="true">
            <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title" id="instructorModalLabel">Instructor Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                <div id="instructorContent">
                    <!-- Content will be injected here -->
                </div>
                </div>
                <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
            </div>
        </div>
        {{-- modal ends --}}
        {{-- membership modal starts --}}
        <div class="modal fade membership-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title"></h5>
                        <button type="button" class="btn-close" onclick="window.location.reload()"></button>
                    </div>
                    <div class="modal-body membership-modal-content"></div>
                </div>
              </div>
        </div>
    

        {{-- ends --}}
      <script src="https://dev.fitnessity.co/public/dashboard-design/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script type="text/javascript">
        $(document).on('click', '.show_activities_options', function(e){
            e.preventDefault()
    
            $('.more_activities_options').toggleClass('hidden')
        })
    </script>
 <script>
    function filterBookings() {
        var services = document.getElementById('servicesDropdown').value;
        var greatFor = document.getElementById('greatForDropdown').value;
        var difficultyLevel = document.getElementById('difficultyLevelDropdown').value;
        const companyinfo = @json($companyinfo);
        const filterData = {
            services: services,
            great_for: greatFor,
            difficulty_level: difficultyLevel,
            date: new URLSearchParams(window.location.search).get('date') || '',
            companyinfo: companyinfo 
        };
        $.ajax({
            url:'https://dev.fitnessity.co/api/get_data',
            method: 'GET',
            data: filterData,
            success: function(response) {
                document.getElementById("show_all").style.display = "none";
                $('.showall .container').html(response);
            },
            error: function(xhr, status, error) {
                console.error('Error:', error);
            }
        });
    }
    $('#servicesDropdown, #greatForDropdown, #difficultyLevelDropdown').change(function() {
        filterBookings();
    });
</script>
<script>
$(document).ready(function() {
    document.getElementById("show_all").style.display = "block";
});
</script>
{{-- <script>
    function updateModalBookingId(button) {
        var loginWidgetContainer = document.getElementById('your-login-widget-container');
        loginWidgetContainer.setAttribute('data-bookingid', button.getAttribute('data-bookingid'));
    }
        document.querySelector('button[data-bs-target="#exampleModal"]').addEventListener('click', function() {
        updateModalBookingId(this);
    });
</script> --}}

<script>
    function updateModalBookingId(button) {
        var bookingId = button.getAttribute('data-bookingid');  
        document.getElementById('booking-id-input').value = bookingId;
        // document.getElementById('your-login-widget-container').setAttribute('data-bookingid', bookingId);        
        var bookingIdInput = $('#booking-id-input').get(0);
        if (bookingIdInput) {
            var bookingId = bookingIdInput.value;
         } 
         checkLogin(button);
    }
   
</script>

<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
<script>
    window.onload = function() {
    function sendHeight() {
        var height = document.body.scrollHeight;        
        window.parent.postMessage({
            height: height
        }, '*');  
    }
    sendHeight();
    window.addEventListener('message', function(event) {
        if (event.data.action === 'getHeight') {
            sendHeight(); 
        }
    });
}
</script>
    <script>
        $(document).ready(function() {

            $('.toggle-password').on('click', function() {
                var passwordField = $('#password');
                var toggleButton = $(this);

                if (passwordField.attr('type') === 'password') {
                    passwordField.attr('type', 'text');
                    toggleButton.html('<i class="fas fa-eye-slash"></i>');
                } else {
                    passwordField.attr('type', 'password');
                    toggleButton.html('<i class="fas fa-eye"></i>');
                }
            });

            $("#login_submit").click(function() {
                $("#erremail").html('');
                $("#errpass").html('');
                var email = $("#email");
                var pass = $("#password");
                var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
                if (email.val() == "") {
                    $("#erremail").html("Please enter email address");
                    email.focus();
                    return false;
                }
                if (!regex.test(email.val())) {
                    $('#erremail').html('Please enter valid email xxx@xxx.xxx');
                    email.focus();
                    return false;
                }
                if (pass.val() == "") {
                    $("#errpass").html("Please enter password");
                    pass.focus();
                    return false;
                }
                // LoginUser();
            });
        });
    </script>
    <script>
        $(document).ready(function() {
            var companyInfo = @json($companyinfo['id']);
            $('#myForm').submit(function(event) {
                event.preventDefault();
                var form = document.getElementById('myForm');
                var formData = new FormData(form);
                // new code start
                const input = document.getElementById("booking-id-input");
                const bookingId = input.value;
                // alert(inputValue);
                // end
                formData.append('company_info', companyInfo);
                formData.append('bookingid',bookingId);
                $.ajax({
                    url:'https://dev.fitnessity.co/api/auth/user',
                    method: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        console.log(response);
                        if(response.type=='success')
                        {                            
                            if(response.membership=='1')
                            {
                                $('#exampleModal').modal('hide');
                                $('#exampleModal input').val('');
                                storeToken(response.token);
                                membership();
                            }
                            // else{
                            //     alert('0');
                            // }
                        }               
                        if(response.type=='not_exists')
                        {
                            $('.register').css('display','block');
                            $('#systemMessage').removeClass('alert-danger alert-success').addClass(response.type == 'not_exists' ? 'alert-danger' : 'alert-success').text(response.msg).show();                              
                        } 
                        if(response.type=='register')
                        {
                            $('.register').css('display','block');
                            $('#systemMessage').removeClass('alert-danger alert-success').addClass(response.type == 'register' ? 'alert-danger' : 'alert-success').text(response.msg).show();                              
                        }      
                    },
                    error: function(xhr, status, error) {
                        // alert('Your form was not sent successfully.');
                        console.error(error);
                    }
                });
            });
        });
    </script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <script src="https://js.stripe.com/v3/"></script>
    <script>
        $(document).ready(function() {
            $("#actfildate_forcart").datepicker();
        });
    </script>
   <script>
        function checkLogin(button) {
        var token = localStorage.getItem('authToken');
        var status =  localStorage.getItem('loggedin');
        if (status !== null && status !== undefined && token!==null) {
            button.removeAttribute('data-bs-target');
            membership();                
        }
        else{
                button.setAttribute('data-bs-target', '#exampleModal');
                localStorage.removeItem('loggedin');
                $('#exampleModal').modal('show');
            }
        }
    </script>
    <script>
         function storeToken(token) {
            localStorage.setItem('authToken', token);
        }
    </script>
    <script>
        function membership() {
            const companyinfo = @json($companyinfo);
            $.ajax({
                url: '{{ route("membership") }}', 
                type: 'POST',
                data: {
                    companyinfo: companyinfo,
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    var val = '1';
                    localStorage.setItem('loggedin',val);
                    $('#anotherModal .modal-body').html(response);
                    $('#anotherModal').modal('show');
                },
                error: function(xhr, status, error) {
                    console.error('Error sending company info:', error);
                }
            });
        }
    </script>    


</body>
</html>