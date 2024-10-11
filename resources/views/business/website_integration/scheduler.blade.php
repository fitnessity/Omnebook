@inject('request', 'Illuminate\Http\Request')
@php
$logBgColor =
    isset($companyinfo) && is_object($companyinfo)
        ? $companyinfo->secondary_color
        : '#defaultBackgroundColors';
$logTextColor =
    isset($companyinfo) && is_object($companyinfo)
        ? $companyinfo->primary_color
        : '#defaultTextColors';
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
        $scheduleText=$companyinfo->schedule_label_color;
        $scheduleLabel=$companyinfo->schedule_label;
        $scheduledate=$companyinfo->date_color;


    } else {
        $schedule_back=App\WebsiteIntegration::where('business_id',$code->id)->first();
        $schedule_back_color = $schedule_back->schedule_back_color;
        $font=$schedule_back->font;
        $btnstyle=$schedule_back->button_style;
        $btntext=$schedule_back->button_text;
        $schedulecolor=$schedule_back
        ->schedule_label;
        $logBgColor = $schedule_back->secondary_color;
        $logTextColor = $schedule_back->primary_color;
        $scheduleText=$schedule_back->schedule_label_color;
        $scheduleLabel=$schedule_back->schedule_label;
        $scheduledate=$schedule_back->date_color;

    }      
@endphp
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
                        <a href="{{$request->fullUrlWithQuery(['date' => $date->format('Y-m-d')])}}" class="calendar-btn" style="color:{{$scheduledate}}">{{$date->format("D d")}}</a>
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

                    {{-- @if ($bookscheduler->price_detail() > 0  || $bookscheduler->class_detail() > 0  && $spot_left > 0) --}}
                    @if ($bookscheduler->class_detail() > 0   && $spot_left > 0)
                        <div class="row">
                            <div class="col-md-12">
                                <div class="border-list">
                                    <div class="row mb-10">
                                        <div class="col-lg-2 col-md-2 col-xs-12 col-sm-2">
                                            <div class="table-inner-data">
                                                <span class="mg-time"> {{date('h:i A', strtotime($bookscheduler['shift_start']))}} </span>
                                                <div class="bg-red-nen" style="color:{{$scheduleText}};background-color:{{$scheduleLabel}}">
                                                    <span> {{$bookscheduler->get_clean_duration()}}</span>
                                                </div>
                                            </div>
                                        </div>
                                      
                                        <div class="col-lg-7 col-md-7 col-xs-12 col-sm-5">
                                            <div class="table-inner-data-sec">
                                                {{-- <img src="{{ Storage::disk('s3')->exists($bookscheduler->business_service->first_profile_pic()) ? Storage::URL($bookscheduler->business_service->first_profile_pic()) : url('/images/service-nofound.jpg') }}" alt="Fitnessity"> --}}
                                                <img src="{{ $bookscheduler->business_service->first_profile_pic() ? $bookscheduler->business_service->first_profile_pic() : url('/images/service-nofound.jpg') }}" alt="Fitnessity">                                                    
                                                <div class="p-name">
                                                    <h3>{{$bookscheduler->business_service->program_name}}</h3>
                                                    <p> {{$bookscheduler->business_service->formal_service_types()}} | {{$bookscheduler->business_service->sport_activity}} | Spot Available - {{$bookscheduler->spots_left($filter_date)}}/{{$bookscheduler->spots_available}}
                                                        </p>
                                                    <p>Instructor: {{$bookscheduler->getInstructorNames()}} <span class="difficult-level">Difficulty Level:  {{$bookscheduler->getClassNames()}}</span></p>

                                                    @if ($bookscheduler->is_start_in_one_hour($filter_date))
                                                        <span> Starting in {{$bookscheduler->time_left($filter_date)->format('%i minutes')}} </span>
                                                    @endif
                                                    
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-1  col-md-1 col-xs-3 col-sm-2 col-2">
                                            <div class="star-rest">
                                                <div class="activity-inner-data">
                                                    <i class="fas fa-star" style="color:{{$schedulecolor}}"></i>
                                                    <span> {{$bookscheduler->business_service->reviews_score()}} </span>
                                                </div>
                                            </div>
                                        </div>
                                        {{-- <div class="col-md-1 col-xs-3 col-sm-1 col-4">
                                            <div class="table-price">
                                                <span> ${{$bookscheduler->class_detail()}} </span>
                                            </div>
                                        </div> --}}
                                        <div class="col-md-2 col-xs-6 col-sm-2 col-6">
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
                                        <div class="f-right">
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

