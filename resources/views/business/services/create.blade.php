@inject('request', 'Illuminate\Http\Request')
@extends('layouts.business.header')
@section('content')

    @include('layouts.business.business_topbar')
   
    <div class="main-content">
        <div class="page-content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col">
                        <div class="h-100">
                            <div class="row mb-3">
                                <div class="col-12">
                                    <div class="page-heading">
                                        <label>Add/Edit Services and Prices for "{{$serviceType == 'individual' ? "Personal Traning" : ucfirst($serviceType)}}"</label>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="row ">
                                <div class="col-md-12">
                                    <div class="card">
                                        <div class="card-header align-items-center d-flex">
                                            <h4 class="card-title mb-0 flex-grow-1 nesting-steps-title">Step 1: Program Details</h4>
                                        </div>

                                        <div class="card-body">
                                            <div class="live-preview">
                                                <div class="accordion" id="stepone">
                                                    <div class="accordion-item shadow">
                                                        <h2 class="accordion-header" id="stepheadingOne">
                                                            <button class="accordion-custom-btn accordion-button {{$serviceId != '' ? 'collapsed' : '' }}" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                                                Explain to your customer what this program is.
                                                            </button>
                                                        </h2>
                                                        <div id="collapseOne" class="accordion-collapse collapse {{$serviceId == '' ? 'show' : '' }}" aria-labelledby="stepheadingOne" data-bs-parent="#stepone">
                                                            <form action="{{route('business.services.store')}}" method="POST" enctype="multipart/form-data">
                                                                @csrf
                                                                <input type="hidden" name="step" id="step1" value="1">
                                                                <input type="hidden" name="serviceId" id="serviceId" value="{{$serviceId}}">
                                                                <input type="hidden" name="serviceType" id="serviceType" value="{{$serviceType}}">
                                                                <div class="accordion-body">
                                                                    <div class="row">
                                                                        <div class="col-md-6">
                                                                            <div class="steps-title">
                                                                                <div class="mb-3">
                                                                                    <select class="form-select" name="sports" id="sports" data-choices data-choices-search-false required>
                                                                                        <option value="">Choose a Sport/Activity</option>
                                                                                        @foreach(@$sportsData as $Sports)
                                                                                            @php $optiondata = app\Sports::where('parent_sport_id',$Sports['id'])->get(); @endphp
                                                                                            @if(count($optiondata)>0)
                                                                                                <optgroup label="{{$Sports['sport_name']}}">
                                                                                                @foreach($optiondata as $data)
                                                                                                    <option @if(strtoupper(@$service->sport_activity) == strtoupper($data['sport_name'])) selected @endif >{{$data['sport_name']}}</option>
                                                                                                @endforeach
                                                                                                </optgroup>
                                                                                            @else
                                                                                            <option @if(strtoupper(@$service->sport_activity) == strtoupper($Sports['sport_name'])) selected @endif >{{$Sports['sport_name']}}</option>
                                                                                            @endif
                                                                                        @endforeach
                                                                                    </select>
                                                                                </div>
                                                                            </div>
                                                                            <div class="steps-title">
                                                                                <div class="mb-3">
                                                                                    <label for="choices-publish-status-input" class="form-label">Program Title</label>
                                                                                    <input type="text" value="{{@$service->program_name}}" name="programName" id="programName" class="form-control" placeholder="ex. Kickboxing for adults)" placeholder="ex. Kickboxing for adults)" required>
                                                                                </div>
                                                                            </div>
                                                                            <div class="steps-title">
                                                                                <div class="mb-3">
                                                                                    <label for="choices-publish-status-input" class="form-label">Program Description</label>
                                                                                    <textarea name="programDesc" id="programDesc" class="form-control" rows="4" maxlength="500" required placeholder="Enter program description" >{{@$service->program_desc}}</textarea>
                                                                                    <span class="error" id="errProgramDescLeft"></span>
                                                                                    <div class="float-right"><span id="programDescLeft">500</span> Characters Left</div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="steps-title">
                                                                                <div class="mb-3">
                                                                                    <label for="choices-publish-status-input" class="form-label">Give your customers THINGS TO KNOW and information on how and what to prepare before they book</label> 
                                                                                    <textarea class="form-control" name="thingsToKnow" id="thingsToKnow" required rows="4" maxlength="2000" placeholder="Tell your customers how they should conduct themselves when attending your place of business or participating in your activity. Set out a few guidelines to help things go smoothly.">{{@$service->know_before_you_go}}</textarea>
                                                                                    <span class="error" id="errThingsToKnow"></span>
                                                                                    <div class="float-right"><span id="thingsToKnowLeft">2000</span> Characters Left</div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="steps-title">
                                                                                <h3>Choose Instructor</h3>
                                                                                <a href="" data-bs-toggle="modal" data-bs-target=".bs-example-modal-center" class="">Add Instructor</a>
                                                                                <p>Which staff member(s) will lead this program?</p>
                                                                                <div class="mb-3 selectinstructor">
                                                                                    <select class="form-select"  name="instructor_id" id="instructor_id" data-choices data-choices-search-false>
                                                                                        <option value="">{{Auth::user()->current_company->full_name}}(Provider)</option>
                                                                                        @if(!empty($staffData))
                                                                                            @foreach($staffData as $data)
                                                                                                <option value="{{$data->id}}" @if(@$service->instructor_id == $data->id) selected @endif> {{$data->first_name}} {{$data->last_name}} </option>
                                                                                            @endforeach
                                                                                        @endif
                                                                                    </select>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-6">
                                                                            <div class="add-photos">
                                                                                <h3>Add Photos For Your Program</h3>
                                                                                <ul>
                                                                                    <li>Photos uploaded should show details and people in action</li>
                                                                                    <li>Photos should be high resolution and not pixelated.</li>
                                                                                    <li>Photos should be professional and reflect the best of what your program represents.</li>
                                                                                    <li>Photos should not have heavy filters, distortion, overlaid text, or watermarks </li>
                                                                                </ul>
                                                                                
                                                                                <div id="dropBox" class="dropBoximg">
                                                                                    <p>Drag & Drop Images Here...</p>
                                                                                   <!--  <form class="imgUploader"> -->
                                                                                    <input type="file" id="imgUpload" name="imgUpload[]" multiple="" accept="image/*" onchange="filesManager(this.files)">
                                                                                    <label class="buttonimg" for="imgUpload">...or Upload from your device</label>
                                                                                   <!--  </form> -->
                                                                                    <div id="gallery">
                                                                                        @if(is_array(@$profile_pic))
                                                                                            @if(!empty(@$profile_pic))
                                                                                                @foreach(@$profile_pic as $key=>$img)
                                                                                                    @if(!empty($img))
                                                                                                    <div class="imagediv imgno_{{$key}}" >
                                                                                                        <div class="more-option">
                                                                                                            <div class="more">
                                                                                                                <div class="more-post-optns">
                                                                                                                    <i class="fa fa-ellipsis-h"></i>
                                                                                                                    <ul>
                                                                                                                        <li><a  imgname="{{$img}}" class="editpopup" href="javascript:void(0);" serviceid="{{$service->id}}"><i class="fa fa-pencil-square-o"></i>Edit Image</a></li>
                                                                                                                        <li><a href="javascript:void(0);" class="delImage" serviceid="{{$service->id}}" imgname="{{$img}}" valofi={{$key}}><i class="fa fa-trash"></i>Delete Image</a></li>
                                                                                                                    </ul>
                                                                                                                </div>
                                                                                                            </div>
                                                                                                        </div>
                                                                                                        <img src="{{Storage::Url($img)}}">
                                                                                                    </div>
                                                                                                    @endif
                                                                                                @endforeach
                                                                                            @endif
                                                                                        @else
                                                                                            @if(!empty($profile_pic))
                                                                                                <div class="imagediv  imgno_0" >
                                                                                                    <div class="more-option">
                                                                                                        <div class="more">
                                                                                                            <div class="more-post-optns">
                                                                                                                <i class="fa fa-ellipsis-h"></i>
                                                                                                                <ul>
                                                                                                                    <li>
                                                                                                                       <a imgname="{{$profile_pic}}" class="editpopup" href="javascript:void(0);" serviceid="{{$service->id}}"><i class="fa fa-pencil-square-o"></i>Edit Post</a>
                                                                                                                    </li>
                                                                                                                    <li><a href="javascript:void(0);" class="delImage" serviceid="{{$service->id}}" imgname="{{$profile_pic}}" valofi="0"><i class="fa fa-trash"></i>Delete Post</a></li>
                                                                                                                </ul>
                                                                                                            </div>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                    <img src="{{Storage::Url($profile_pic)}}">
                                                                                                </div>
                                                                                            @endif
                                                                                        @endif
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row">
                                                                        <div class="col-md-12 col-12">
                                                                            <button type="submit" class="btn-red-primary btn-red float-right mt-15" id="nextindividual2">Save</button>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div><!-- end card-body -->
                                    </div><!-- end card -->
                                </div><!--end col-->
                            </div>

                            <div class="row ">
                                <div class="col-md-12">
                                    <div class="card">
                                        <div class="card-header align-items-center d-flex">
                                            <h4 class="card-title mb-0 flex-grow-1 nesting-steps-title">Step 2: Booking Settings</h4>
                                        </div><!-- end card header -->

                                        <div class="card-body">
                                            <div class="live-preview">
                                                <div class="accordion" id="steptwo">
                                                    <div class="accordion-item shadow">
                                                        <h2 class="accordion-header" id="stepheadingTwo">
                                                            <button class="accordion-custom-btn accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                                                Provide more details to get booked
                                                            </button>
                                                        </h2>
                                                        <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="stepheadingTwo" data-bs-parent="#steptwo">
                                                        <form action="{{route('business.services.store')}}" method="POST" enctype="multipart/form-data">
                                                        @csrf
                                                            <input type="hidden" name="step" id="step2" value="2">
                                                            <input type="hidden" name="serviceId" id="serviceId" value="{{$serviceId}}">
                                                            <input type="hidden" name="serviceType" id="serviceType" value="{{$serviceType}}">
                                                            <div class="accordion-body">
                                                                <div class="steps-title">
                                                                    <div class="mb-3">
                                                                        <div class="form-check form-switch">
                                                                            <input class="custom-switch form-check-input" type="checkbox" name="instantbooking" id="instantbooking" onchange="changetoggle('instantbooking');" @if(@$service->request_booking == 0 || @$service->instant_booking == 1) checked @endif>
                                                                            <label class="form-check-label" for="flexSwitchCheckDefault">INSTANT BOOKING:</label>
                                                                            <p>Allow customers to book you instantly (Recommeded to get more bookings)</p>
                                                                        </div>
                                                                        <div class="form-check form-switch">
                                                                            <input class="custom-switch form-check-input" type="checkbox" name="requestbooking" id="requestbooking"  onchange="changetoggle('requestbooking');" @if(@$service->request_booking == 1) checked @endif>
                                                                            <label class="form-check-label" for="flexSwitchCheckChecked">REQUEST BOOKING:</label>
                                                                            <p>Customers can request a booking, but you want to confirm first.(Less booking frequency with this option) </p>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-md-6 col-lg-5 col-xxl-4">
                                                                        <div class="participant-req">
                                                                            <p>What is the minimum participant requirement for each booking?</p>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-3">
                                                                        <div class="">
                                                                            <input name="minParticipate" id="minParticipate" placeholder="1" value="{{ @$service->frm_min_participate != '' ? $service->frm_min_participate : 1 }}" type="text" class="form-control">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-md-4 col-lg-4 col-xxl-3">
                                                                        <div class="participant-req">
                                                                            <p>Whats the latest a customer can cancel?</p>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-1">
                                                                        <input name="cancelBeforeInt" id="cancelBeforeInt" placeholder="1" value="{{ @$service->cancelbeforeint != '' ? $service->cancelbeforeint : 1 }}" type="text" class="form-control mmb-15">
                                                                    </div>
                                                                    <div class="col-md-2">
                                                                        <select class="form-select" name="cancelBefore" id="cancelBefore" data-choices="" data-choices-search-false="">
                                                                            <option value="minutes"  <?=(@$service->cancelbefore=='minutes')?"selected":""?>>Minute(s)</option>
                                                                            <option value="hours"  <?=(@$service->cancelbefore=='hours')?"selected":""?>>Hour(s)</option>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-lg-3 col-md-6 col-sm-6">
                                                                        <div class="priceselect sp-select">
                                                                            <label>Select Service Type</label>
                                                                            <div id="individualstype" style="">
                                                                                <select name="serviceTypes[]" id="serviceTypes" multiple>
                                                                                    <option value="Personal Training">Personal Training</option>
                                                                                    <option value="Coaching">Coaching{{$serviceType}}</option>
                                                                                    <option value="Therapy">Therapy</option>
                                                                                    <option value="Event">Event </option>
                                                                                    <option value="Seminar">Seminar </option>
                                                                                    @if(strtolower($serviceType) == 'experience')
                                                                                        <option value="Gym">Gym</option>
                                                                                        <option value="Adventure">Adventure</option>
                                                                                        <option value="Trip">Trip</option>
                                                                                        <option value="Tour">Tour</option>
                                                                                        <option value="Camp">Camp</option>
                                                                                        <option value="Team">Team</option>
                                                                                        <option value="Clinic">Clinic</option>
                                                                                    @endif
                                                                                </select>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-lg-3 col-md-6 col-sm-6">
                                                                        <div class="priceselect sp-select">
                                                                            <label>Location of Activity ?</label>
                                                                            <select name="serviceLocation[]" id="serviceLocation" multiple>
                                                                                <option value="Online">Online</option>
                                                                                <option value="At Business">At Business</option>
                                                                                <option value="On Location">On Location</option>
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-lg-3 col-md-6 col-sm-6">
                                                                        <div class="priceselect sp-select">
                                                                            <label>Activity Great For ?</label>
                                                                            <select name="programFor[]" id="programFor" multiple>
                                                                                <option value="Kids">Kids</option>
                                                                                <option value="Teens">Teens</option>
                                                                                <option value="Adults">Adults</option>
                                                                                <option value="Family">Family</option>
                                                                                <option value="Groups">Groups</option>
                                                                                <option value="Paralympic">Paralympic</option>
                                                                                <option value="Prenatal">Prenatal</option>
                                                                                <option value="Any">Any</option>
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-lg-3 col-md-6 col-sm-6">
                                                                        <div class="priceselect sp-select">
                                                                            <label>What age is this for?</label>
                                                                            <select name="ageRange[]" id="ageRange" multiple>
                                                                                <option value="Baby (0 to 12 months)">Baby (0 to 12 months)</option>
                                                                                <option value="Toddler (1 to 3 yrs.)">Toddler (1 to 3 yrs.)</option>
                                                                                <option value="Preschool (4 to 5 yrs.)">Preschool (4 to 5 yrs.)</option>
                                                                                <option value="Grade School (6 to 12 yrs.)">Grade School (6 to 12 yrs.)</option>
                                                                                <option value="Teen (13 to 17 yrs.)">Teen (13 to 17 yrs.)</option>
                                                                                <option value="Young Adult (18 to 21 yrs.)">Young Adult (18 to 21 yrs.)</option>
                                                                                <option value="Older Adult (21 to 39 yrs.)">Older Adult (21 to 39 yrs.)</option>
                                                                                <option value="Middle Age (40 to 59 yrs.)">Middle Age (40 to 59 yrs.)</option>
                                                                                <option value="Senior Adult (60 +)">Senior Adult (60 +)</option>
                                                                                <option value="Any">Any</option>
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-lg-3 col-md-6 col-sm-6">
                                                                        <div class="priceselect sp-select">
                                                                            <label>Difficulty Levels?</label>
                                                                            <select name="difficultLevel[]" id="difficultLevel" multiple>
                                                                                <option>Easy</option>
                                                                                <option>Medium</option>
                                                                                <option>Hard</option>
                                                                                <option>Any</option>
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-lg-4 col-md-6 col-sm-6">
                                                                        <div class="priceselect sp-select">
                                                                            <label>Customers Experience for this Activity?</label>
                                                                            <select name="serviceFocus[]" id="serviceFocus" multiple>
                                                                                <option value="Have Fun"> Have Fun</option>
                                                                                <option value="Adventurous">Adventurous</option>
                                                                                <option value="Thrilling">Thrilling</option>
                                                                                <option value="Physically Challenging">Physically Challenging </option>
                                                                                <option value="Mentally Challenging">Mentally Challenging </option>
                                                                                <option value="Peaceful">Peaceful</option>
                                                                                <option value="Calm">Calm</option>
                                                                                <option value="Gain Focus">Gain Focus</option>
                                                                                <option value="Learning a skill">Learning a skill</option>
                                                                                <option value="To accomplish a goal">To accomplish a goal</option>
                                                                                <option value="Gain Discipline">Gain Discipline</option>
                                                                                <option value="Gain Confidence">Gain Confidence</option>
                                                                                <option value="Better hand-eye coordination">Better hand-eye coordination</option>
                                                                                <option value="Get a toned body">Get a toned body</option>
                                                                                <option value="Get better nutrition habits">Get better nutrition habits</option>
                                                                                <option value="Release Pain">Release Pain</option>
                                                                                <option value="Relax">Relax</option>
                                                                                <option value="Body Alignment">Body Alignment</option>
                                                                                <option value="Strength and Conditioning">Strength and Conditioning </option>
                                                                                <option value="Athletic Conditioning">Athletic Conditioning</option>
                                                                                <option value="Better Technique">Better Technique</option>
                                                                                <option value="Weight Loss Help">Weight Loss Help</option>
                                                                                <option value="Competition training and prep">Competition training and prep</option>
                                                                                <option value="Gain better cardio">Gain better cardio</option>
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-lg-4 col-md-6 col-sm-6">
                                                                        <div class="priceselect sp-select">
                                                                            <label>Personality & Habits of Instructor?</label>
                                                                            <select name="teachingStyle[]" id="teachingStyle" multiple>
                                                                                <option value="An educator">An Educator</option>
                                                                                <option value="A teacher">A Teacher</option>
                                                                                <option value="A lot of energy">A lot of energy</option>
                                                                                <option value="A drill sergeant">A drill sergeant</option>
                                                                                <option value="Inspiring">Inspiring</option>
                                                                                <option value="Motivational">Motivational</option>
                                                                                <option value="Supportive, Soft and Nurturing">Supportive, Soft and Nurturing</option>
                                                                                <option value="Tough and Firm">Tough and Firm</option>
                                                                                <option value="Gentle">Gentle</option>
                                                                                <option value="Intense">Intense</option>
                                                                                <option value="Likes to talk">Likes to talk</option>
                                                                                <option value="Punctual">An entertainer</option>
                                                                                <option value="Organized">Stern</option>
                                                                                <option value="Stern">Friendly & outgoing</option>
                                                                                <option value="Tells jokes and funny">Tells jokes and funny</option>
                                                                                <option value="Loves to talk">Loves to talk about the details</option>
                                                                                <option value="Very Organized">Very Organized</option>
                                                                                <option value="Punctual">Punctual</option>
                                                                                <option value="On Time">On Time</option>
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div @if($serviceType != 'experience') class="d-none" @endif>
                                                                    <div class="row">
                                                                        <div class="col-lg-12">
                                                                            <div class="itinerary-data">
                                                                                <h3>Set Up Your Itinerary</h3>
                                                                                <p>(Let customers know what they will be doing for this experience)</p>
                                                                                <div class="dropdown-divider"></div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row">
                                                                        <div class="col-lg-6">
                                                                            <div class="itinerary-data">
                                                                                <h3>Experience Highlights</h3> 
                                                                                <textarea name="expHighlight" id="expHighlight" maxlength="1000" class="form-control valid" rows="6"  placeholder="Briefly describe a few highlights so customer understand what they will be doing. ">{{@$service->exp_highlight}}</textarea>
                                                                                <div class="float-right"><span id="expHighlightLeft">1000</span>  Characters Left</div> 
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="dropdown-divider mt-20 mb-20"></div>
                                                                    <div class="row">
                                                                        <div class="col-lg-12 col-md-12">
                                                                            <div class="booking-titles">
                                                                                <h3>What’s Included with this experience?</h3>
                                                                                <p>What do you provide for your customers?</p>
                                                                                <p>Examples: You provide pick up and drop off transportation from hotels etc., provider, food and drinks, special equipment, video and photography services etc.)</p>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row">
                                                                        <div class="col-lg-6 col-md-12 col-sm-12">
                                                                            <div class="activity-width">
                                                                                <div class="special-offer select-dropoff">
                                                                                    <div class="multiples">
                                                                                        <select name="includedThings[]" id="includedThings" multiple="" class="mt-10" tabindex="-1" >
                                                                                            <option value="Safety and Protective Gear">Safety and Protective Gear</option>
                                                                                            <option value="Activity Equipment">Activity Equipment</option>
                                                                                            <option value="Breakfast">Breakfast</option>
                                                                                            <option value="Lunch">Lunch</option>
                                                                                            <option value="Dinner">Dinner</option>
                                                                                            <option value="Snacks">Snacks</option>
                                                                                            <option value="Drinks (tea, coffee, soda, bottled water, etc.) ">Drinks (tea, coffee, soda, bottled water, etc.)</option>
                                                                                            <option value="Alcohol (beer, champagne, wine, mixed drink etc.)">Alcohol (beer, champagne, wine, mixed drink etc.)</option>
                                                                                            <option value="Transportation">Transportation</option>
                                                                                            <option value="Insurance Coverage">Insurance Coverage</option>
                                                                                            <option value="Entrance Fees ">Entrance Fees </option>
                                                                                            <option value="Airfare">Airfare</option>
                                                                                            <option value="Taxes">Taxes</option>
                                                                                            <option value="Professional Guide">Professional Guide</option>
                                                                                            <option value="Guide Gratuity">Guide Gratuity</option>
                                                                                            <option value="Accommodations">Accommodations</option>
                                                                                            <option value="Video">Video</option>
                                                                                            <option value="Photography">Photography</option>
                                                                                            <option value="Fully Narrated">Fully Narrated</option>
                                                                                            <option value="Historic landmarks">Historic landmarks</option>
                                                                                            <option value="Rest period">Rest period</option>
                                                                                            <option value="Typical souvenir">Typical souvenir</option>
                                                                                        </select>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row">
                                                                        <div class="col-lg-12 col-md-12">
                                                                            <div class="booking-titles">
                                                                                <h3>What’s Not Included with this experience?</h3>
                                                                                <p>List the items or services that are not includes with this experience. i.e. no food or drinks, no equipment, no insurance, etc. </p>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row">
                                                                        <div class="col-lg-6  col-md-12 col-sm-12">
                                                                            <div class="activity-width">
                                                                                <div class="special-offer select-dropoff">
                                                                                    <div class="multiples">
                                                                                        <select name="notIncludedThings[]" id="notIncludedThings" multiple="" tabindex="-1" " data-ssid="ss-30992">
                                                                                            <option value="Safety and Protective Gear">Safety and Protective Gear</option>
                                                                                            <option value="Activity Equipment">Activity Equipment</option>
                                                                                            <option value="Breakfast">Breakfast</option>
                                                                                            <option value="Lunch">Lunch</option>
                                                                                            <option value="Dinner">Dinner</option>
                                                                                            <option value="Snacks">Snacks</option>
                                                                                            <option value="Drinks (tea, coffee, soda, bottled water, etc.) ">Drinks (tea, coffee, soda, bottled water, etc.)</option>
                                                                                            <option value="Alcohol (beer, champagne, wine, mixed drink etc.)">Alcohol (beer, champagne, wine, mixed drink etc.)</option>
                                                                                            <option value="Transportation">Transportation</option>
                                                                                            <option value="Insurance Coverage">Insurance Coverage</option>
                                                                                            <option value="Entrance Fees ">Entrance Fees </option>
                                                                                            <option value="Airfare">Airfare</option>
                                                                                            <option value="Taxes">Taxes</option>
                                                                                            <option value="Professional Guide">Professional Guide</option>
                                                                                            <option value="Guide Gratuity">Guide Gratuity</option>
                                                                                            <option value="Accommodations">Accommodations</option>
                                                                                            <option value="Video">Video</option>
                                                                                            <option value="Photography">Photography</option>
                                                                                            <option value="Fully Narrated">Fully Narrated</option>
                                                                                            <option value="Historic landmarks">Historic landmarks</option>
                                                                                            <option value="Rest period">Rest period</option>
                                                                                            <option value="Typical souvenir">Typical souvenir</option>
                                                                                        </select>
                                                                                         <span class="error" id="err_what_not_included"></span>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row">
                                                                        <div class="col-lg-12 col-md-12">
                                                                            <div class="booking-titles">
                                                                                <h3>What Should Guest Bring and Wear?</h3>
                                                                                <p>If guests need anything in order to enjoy your experience, this is the place to tell them. Be as detailed as possible and add each item individually. </p>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row">
                                                                        <div class="col-lg-6 col-md-12 col-sm-12">
                                                                            <div class="activity-width">
                                                                                <div class="special-offer select-dropoff">
                                                                                    <div class="multiples">
                                                                                        <select name="wearThings[]" id="wearThings" multiple="" tabindex="-1" data-ssid="ss-87640">
                                                                                            <option value="Any Clothing Type">Any Clothing Type</option>
                                                                                            <option value="Dress for warm weather">Dress for warm weather</option>
                                                                                            <option value="Dress for wet weather">Dress for wet weather</option>
                                                                                            <option value="Dress for cold weather">Dress for cold weather</option>
                                                                                            <option value="Dress for nature activities">Dress for nature activities</option>
                                                                                            <option value="Dress for wet activities">Dress for wet activities</option>
                                                                                            <option value="Dress for cold activities">Dress for cold activities</option>
                                                                                            <option value="Pants">Pants</option>
                                                                                            <option value="Long Sleeve">Long Sleeve</option>
                                                                                            <option value="Jacket">Jacket</option>
                                                                                            <option value="Sandals">Sandals</option>
                                                                                            <option value="Shoes">Shoes</option>
                                                                                            <option value="Hats">Hats</option>
                                                                                            <option value="Sunglasses">Sunglasses</option>
                                                                                            <option value="Sunblock">Sunblock</option>
                                                                                            <option value="Bug Spray">Bug Spray</option>
                                                                                            <option value="Safety Goggles">Safety Goggles</option>
                                                                                            <option value="Dinner">Dinner</option>
                                                                                            <option value="Snacks">Snacks</option>
                                                                                            <option value="First Aid Kit">First Aid Kit</option>
                                                                                            <option value="Rain jacket">Rain jacket</option>
                                                                                            <option value="Daypack">Daypack</option>
                                                                                            <option value="Backpack">Backpack</option>
                                                                                            <option value="Headlamp">Headlamp</option>
                                                                                            <option value="Water bottle">Water bottle</option>
                                                                                            <option value="Compass">Compass</option>
                                                                                            <option value="Swimsuit">Swimsuit</option>
                                                                                            <option value="Drybag (waterproof)">Drybag (waterproof)</option>
                                                                                            <option value="Bandana or Buff headwear">Bandana or Buff headwear</option>
                                                                                            <option value="Sleeping bag">Sleeping bag</option>
                                                                                            <option value="Padlock">Padlock</option>
                                                                                            <option value="Duct Tape">Duct Tape</option>
                                                                                            <option value="Ear Plugs">Ear Plugs</option>
                                                                                            <option value="Tent">Tent</option>
                                                                                            <option value="Small Cooking Kit">Small Cooking Kit</option>
                                                                                            <option value="Rope">Rope</option>
                                                                                            <option value="Utility Knife">Utility Knife</option>
                                                                                        </select>
                                                                                        <span class="error" id="err_what_guest_bring"></span>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row">
                                                                        <div class="col-lg-12 col-md-12">
                                                                            <div class="booking-titles">
                                                                                <h3>Accessibility</h3>
                                                                                <p>Explain if there is easy access for the disabled</p>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row">
                                                                        <div class="col-lg-6 col-md-12 col-sm-12">
                                                                            <div class="accessibility select-dropoff">
                                                                                <textarea name="accessibility" id="accessibility" maxlength="500" class="form-control valid" rows="3" >{{@$service->accessibility}}</textarea>
                                                                                <div class="float-right"><span id="accessibilityLeft">500</span>  Characters Left</div> 
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row">
                                                                        <div class="col-lg-12 col-md-12">
                                                                            <div class="booking-titles">
                                                                                <h3>Additional Information & FAQ</h3>
                                                                                <p>Have a few things you want your customers to know before arriving? </p>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row">
                                                                        <div class="col-lg-6 col-md-12 col-sm-12">
                                                                            <div class="accessibility select-dropoff">
                                                                                <textarea class="form-control valid" rows="6" name="additionalInfo" id="additionalInfo" maxlength="1000"
                                                                                >{{@$service->addi_info}}</textarea>
                                                                                <div class="float-right"><span id="additionalInfoLeft">1000</span>  Characters Left</div>                                                                           
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="dropdown-divider mt-20 mb-20"></div>
                                                                    <div class="row">
                                                                        <div class=" col-lg-12 col-md-12">
                                                                            <div class="plandaybyday">
                                                                                <h3>Let’s Plan Your Day By Day</h3>
                                                                                <p>Give your customers a day by day plan. Include a title, image and description of what the customers will be doing for that day. You can create multiple days. </p>
                                                                                @php 
                                                                                    $dplantitle = @$service->days_plan_title != '' ? json_decode(@$service->days_plan_title,true) : [];
                                                                                    $dplanimg = @$service->days_plan_img != '' ? explode(",",$service->days_plan_img) : []; 
                                                                                    $dplandesc = @$service->days_plan_desc != '' ? json_decode($service->days_plan_desc,true) : []; 
                                                                                @endphp
                                                                                @if(count($dplantitle) > 0)
                                                                                    <input type="hidden"  name="planday_count" id="planday_count" value="{{count($dplantitle) - 1}}" />
                                                                                @else
                                                                                    <input type="hidden"  name="planday_count" id="planday_count" value="0" />
                                                                                @endif
                                                                                <div class="add-another-day-schedule-block">
                                                                                    @if(count($dplantitle) > 0 )
                                                                                        @foreach($dplantitle as $i=>$title)
                                                                                            <div class="add_another_day">
                                                                                                @if($i != 0)
                                                                                                    <div class="col-md-11"></div>
                                                                                                    <div class="col-md-1">
                                                                                                        <i class="remove-day-schedule fa fa-trash-o" style="color:red; font-weight:bold; cursor:pointer; float:right" 
                                                                                                        title="Remove Day"></i>
                                                                                                    </div>
                                                                                                @endif
                                                                                                <label class="select-dropoff">Day - {{$i+1}}</label>
                                                                                                <div class="row">
                                                                                                    <div class="col-md-12 col-sm-12">
                                                                                                        <div class="row">
                                                                                                            <div class="col-lg-2 col-md-4 col-sm-3">
                                                                                                                <div class="photo-upload">
                                                                                                                    <label for="dayplanpic{{$i}}" id="label">
                                                                                                                    @php    $old_pic = @$dplanimg[$i] != ''  ?  @$dplanimg[$i] : ''; 
                                                                                                                            $day_pic = @$dplanimg[$i] != ''  ?  Storage::Url(@$dplanimg[$i]) : url('/public/images/Upload-Icon.png'); @endphp
                                                                                                                    <img src="{{$day_pic}}" class="pro_card_img blah planblah{{$i}}" id="showimg">
                                                                                                                    <span id="span_{{$i}}">Upload your file here</span>
                                                                                                                        <input name="dayplanpic_{{$i}}" id="dayplanpic{{$i}}" onchange="planImg(this,{{$i}});" type="file" class="uploadFile img" value="Upload Photo" >
                                                                                                                    </label>
                                                                                                                    <span class="error" id="err_oldservicepic2{{$i}}"></span>
                                                                                                                    <input type="hidden" id="olddayplanpic2{{$i}}" name="olddayplanpic_{{$i}}" value="{{$old_pic}}">
                                                                                                                </div>
                                                                                                            </div>
                                                                                                            <div class="col-lg-5 col-md-8 col-sm-9">
                                                                                                                <div>
                                                                                                                    <input name="days_title[]" id="days_title" value="{{$dplantitle[$i]}}" type="text" class="form-control" placeholder="Give a heading for this day." title="servicetitle">
                                                                                                                </div>
                                                                                                                <div class="description-txt">
                                                                                                                    <textarea name="days_description[]" id="days_description{{$i}}" oninput="changedesclenght({{$i}});" class="form-control valid" rows="2" placeholder="Give a description for this day" maxlength="500" 
                                                                                                                    oninput="changedesclenght(0);">{{$dplandesc[$i]}}</textarea>
                                                                                                                    <div class="float-right"><span id="days_description_left{{$i}}" class="word-counter ">500 Characters Left</span> </div>
                                                                                                                </div>
                                                                                                                <script type="text/javascript">
                                                                                                                    $('#days_description_left{{$i}}').text(500-parseInt($("#days_description{{$i}}").val().length)); 
                                                                                                                </script>
                                                                                                            </div>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                        @endforeach
                                                                                    @else
                                                                                        <div class="add_another_day">
                                                                                            <label class="select-dropoff">Day - 1</label>
                                                                                            <div class="row">
                                                                                                <div class="col-md-8">
                                                                                                    <div class="row">
                                                                                                        <div class="col-md-3">
                                                                                                            <div class="photo-upload">
                                                                                                                <label for="dayplanpic0" id="label">
                                                                                                                    <img src="{{url('/public/images/Upload-Icon.png')}}" class="pro_card_img blah planblah0" id="showimg" >
                                                                                                                    <span id="span_0">Upload your file here</span>
                                                                                                                    <input type="file" name="dayplanpic_0" id="dayplanpic0" class="uploadFile img" value="Upload Photo" onchange="planImg(this,0);">
                                                                                                                </label>
                                                                                                                <span class="error" id="err_oldservicepic20"></span>
                                                                                                                <input type="hidden" id="olddayplanpic20" name="olddayplanpic_0" value="">
                                                                                                            </div>
                                                                                                        </div>
                                                                                                        <div class="col-md-6">
                                                                                                            <div>
                                                                                                                <input type="text" class="form-control" name="days_title[]" id="days_title" placeholder="Give a heading for this day." title="servicetitle">
                                                                                                            </div>
                                                                                                            <div class="description-txt">
                                                                                                                <textarea class="form-control valid" rows="2" name="days_description[]" id="days_description0" 
                                                                                                                laceholder="Give a description for this day" maxlength="500" oninput="changedesclenght(0);"></textarea>
                                                                                                                <div class="float-right"> <span id="days_description_left0" >500</span> Character Left</div>
                                                                                                            </div>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                    @endif
                                                                                </div> 
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-12">
                                                                            <span class="addnewdiv add-another-day-schedule">+ Add another day</span>
                                                                        </div>
                                                                    </div>
                                                                    <div class="dropdown-divider mt-20 mb-20"></div>
                                                                    <div class="row">   
                                                                        <div class="col-md-12 col-mg-6">
                                                                            <div class="return-info">
                                                                                <h3>Departure & Return Info & Describe the Location</h3>
                                                                                <p>Tell customers how and when you will depart and return, how to meet up, where to meet up, meeting point name and how to find you once the customer arrives. Don’t leave it up to customers to figure out how to meet up with you. Let them know before hand.</p>
                                                                                
                                                                                <textarea class="form-control valid" rows="6" name="descLocation" id="descLocation" 
                                                                                placeholder="(Ex. Please arrive at the location of our business.The address reminder is ABC Anytown town, 12345 USA.) Or; We will pick you up at your hotel. Or; Please talk with your front desk staff about the meeting point, Or; Please meet us at Central Park at the entrance of 81st and Central Park West (CPW). Wait at the seating area if you arrive early. The instructor will have on a red hat and yellow vest. Please arrive 10 minutes before your activity starts.)" 
                                                                                maxlength="500">{{@$service->desc_location}}</textarea>
                                                                                <div class="float-right"><span id="descLocationLeft">500</span> Character Left</div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row">   
                                                                        <div class="col-md-12 col-lg-6">                  
                                                                            <div class="companydetails">
                                                                                <h3>Where should customers meet you?</h3>
                                                                                <p>If the meet up spot is different from the address you set earlier in Company Details, then you can set it here.</p>
                                                                            </div>
                                                                            <div class="row">
                                                                                <div class="col-lg-6 col-md-6">
                                                                                    <div class="companydetails-info">
                                                                                        <label>Street address </label>
                                                                                        <input type="text" name="address" id="address" class="form-control pac-target-input" 
                                                                                        value="{{@$service->exp_address}}" placeholder="Enter a location" autocomplete="off">
                                                                                    </div>
                                                                                </div>
                                                                                <input type="hidden" id="address_p" @if($service) value="{{$service->fullAdressForMap()}}"  @endif>
                                                                                <input type="hidden" name="lat" id="lat" value="{{@$service->exp_lat}}">
                                                                                <input type="hidden" name="lng" id="lng" value="{{@$service->exp_lng}}">
                                                                                <div id="map" style="display: none;"></div>
                                                                                <div class="col-lg-6 col-md-6">
                                                                                    <div class="companydetails-info">
                                                                                        <label>Country / Region </label>
                                                                                        <input name="country" id="country" value="{{@$service->exp_country}}" type="text" class="form-control">
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="row">
                                                                                <div class="col-lg-6 col-md-6">
                                                                                    <div class="companydetails-info">
                                                                                        <label>Bldg (optional)</label>
                                                                                        <input name="addiAddress" id="addiAddress" value="{{@$service->exp_building}}"  type="text" class="form-control" value=""> 
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-lg-6 col-md-6">
                                                                                    <div>
                                                                                        <label> City </label>
                                                                                        <input value="{{@$service->exp_city}}" name="city" id="city" class="form-control" type="text">
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-lg-6 col-md-6">
                                                                                    <div>
                                                                                        <label>State  </label>
                                                                                        <input type="text" name="state" id="state" class="form-control" value="">
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-lg-6 col-md-6">
                                                                                    <div>
                                                                                        <label> ZIP code</label>
                                                                                        <input value="{{@$service->exp_zip}}" name="zip" id="zip" class="form-control" type="text" >
                                                                                    </div>
                                                                                </div>
                                                                                <div class="fonts-red" id="mapError"></div>
                                                                                <div class="col-md-12 col-lg-12">
                                                                                    <div class="select-dropoff">
                                                                                        <button class="showall-btn btn-red" type="button" onclick="loadMaponclick();">Update Map</button>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            
                                                                            <div class="row">
                                                                                <div class="col-md-12 col-lg-12">
                                                                                    <div class="pin-on-map">
                                                                                        <h3>Adjust the pin on the map</h3>
                                                                                        <p>You can drag the map so the pin is in the right location.</p>
                                                                                      <div class="mysrchmap_cus" style="height: 100%;min-height: 300px;">
                                                                                            <div id="map_canvas_cus">
                                                                                                <div class="maparea">
                                                                                                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d24176.251535935986!2d-73.96828678121815!3d40.76133318281456!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x89c258c4d85a0d8d%3A0x11f877ff0b8ffe27!2sRoosevelt%20Island!5e0!3m2!1sen!2sin!4v1620041765199!5m2!1sen!2sin" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="dropdown-divider mt-20 mb-20"></div>
                                                                    <div class="row">
                                                                        <div class="col-md-12 col-lg-6">
                                                                            <div class="customers-help">
                                                                                <h3>Confirm your phone number if customers need your help</h3>
                                                                                <p>If customers have trouble finding your location, or need questions with help, they may need to call you. The number on file we'll give them is +1 (123) 333-3333. </p>
                                                                                <h3>Any additinal information for help</h3>
                                                                                <textarea name="addiInfoHelp" id="addiInfoHelp" class="form-control valid" rows="3" 
                                                                                maxlength="500" >{{@$service->addi_info_help}}</textarea>
                                                                                <span id="addiInfoHelpLeft">500 Characters Left</span>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row">
                                                                        <div class="col-md-12 col-lg-8">
                                                                            <div class="customers-help">
                                                                                <h3>Require Safety Verifications </h3>
                                                                                <p>The primary booker has to successfully complete verified ID in order for them and their guests to attend your experience.</p>

                                                                                <input id="idProof" name="idProof" {{@$proofVerification}} value="1" type="checkbox">
                                                                                <label for="idProof">Require the booker to have ID upon arrival for verificaiton of age and identity</label><br>
                                                                               
                                                                                <input type="checkbox" id="idVaccine" {{@$vaccinefVerification}} name="idVaccine" value="1">

                                                                                <label for="idVaccine">Require the booker to have proof of Vacination. </label><br>

                                                                                <input type="checkbox" id="idCovid"  {{@$covidVerification}} name="idCovid" value="1">
                                                                                <label for="idCovid">Require the booker to have proof of a negative Covid-19 test. </label><br> 
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-md-12 col-12">
                                                                        <button type="submit" class="btn-red-primary btn-red float-right mt-15" id="nextindividual2"  @if($serviceId == 0) disabled @endif>Save </button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div><!-- end card-body -->
                                    </div><!-- end card -->
                                </div>
                            </div>

                            <div class="row ">
                                <div class="col-md-12">
                                    <div class="card">
                                        <div class="card-header align-items-center d-flex">
                                            <h4 class="card-title mb-0 flex-grow-1 nesting-steps-title">Step 3: Set the price for this program</h4>
                                        </div>
                                        <div class="p-3 bg-light rounded">
                                            <div class="row g-2">
                                                <div class="col-lg-auto">
                                                    <select class="form-control" data-choices data-choices-search-false name="choices-select-status" id="choices-select-status">
                                                        <option value="">Search by Category Name</option>
                                                        <option value="Completed">Categories 1</option>
                                                        <option value="Inprogress">Categories 2</option>
                                                        <option value="Pending">Categories 3</option>
                                                    </select>
                                                </div>
                                                <div class="col-lg">
                                                    <div class="search-box search-width">
                                                        <input type="text" id="searchTaskList" class="form-control search" placeholder="Search by Price Option">
                                                        <i class="ri-search-line search-icon"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-body">
                                            <form action="{{route('business.services.store')}}" method="POST" enctype="multipart/form-data">
                                                @csrf
                                                <input type="hidden" name="step" id="step3" value="3">
                                                <input type="hidden" name="serviceId" id="serviceId" value="{{$serviceId}}">
                                                <input type="hidden" name="serviceType" id="serviceType" value="{{$serviceType}}">
                                                <div class="live-preview" id="categoryMainDiv">
                                                    @php $categoryData = [];
                                                        $categoryData = @$service->BusinessPriceDetailsAges; 
                                                    @endphp

                                                    @if(!empty($categoryData) && count($categoryData) > 0)
                                                        <input type="hidden"  name="categoryCount" id="categoryCount" value="{{count($categoryData) - 1}}" />
                                                        @foreach($categoryData as $i=>$category)
                                                            <div class="accordion custom-accordionwithicon accordion-border-box mt-3" id="category{{$i}}">
                                                                <div class="accordion-item shadow">
                                                                    <h2 class="accordion-header" id="accordionnestingcat{{$i}}">
                                                                        <button class="accordion-custom-btn accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#accor_nestingcategory{{$i}}" aria-expanded="false" aria-controls="accor_nestingcategory{{$i}}">
                                                                            <div class="container-fluid nopadding">
                                                                                <div class="row ">
                                                                                    <div class="col-lg-6 col-md-6 col-8">
                                                                                        Category {{@$category->category_title != '' ? " : ".@$category->category_title :'' }}
                                                                                    </div>
                                                                                    <div class="col-lg-6 col-md-6 col-4">
                                                                                        <div class="multiple-options">
                                                                                            <div class="setting-icon">
                                                                                                <i class="ri-more-fill"></i>
                                                                                                <ul id="catUl{{$i}}">
                                                                                                    <li><a href="" data-bs-toggle="modal" data-bs-target=".tax{{$i}}">
                                                                                                        <i class="fas fa-plus text-muted"></i>Taxes</a></li>
                                                                                                    <li><a onclick="scheduleLink('{{@$category->cid}}','{{@$category->id}}');"><i class="fas fa-plus text-muted"></i>Schedule</a></li>
                                                                                                    <li><a onclick=" return add_another_price_duplicate_category({{$i}});"><i class="fas fa-plus text-muted"></i>Duplicate Entire Category</a></li>
                                                                                                    @if($i!=0)
                                                                                                    <li class="dropdown-divider"></li>
                                                                                                    <li><a href="" onclick="removeCategoryDiv({{$i}});"><i class="ri-delete-bin-fill align-bottom me-2 text-muted"></i>Delete</a></li>
                                                                                                    @endif    
                                                                                                </ul>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </button>
                                                                    </h2>
                                                                    <div id="accor_nestingcategory{{$i}}" class="accordion-collapse collapse" aria-labelledby="accordionnestingcat{{$i}}" data-bs-parent="#category{{$i}}">
                                                                        <div class="accordion-body">
                                                                            <div class="row">
                                                                                <div class="col-md-12">
                                                                                    <div class="flex-shrink-0 float-right">
                                                                                        <div class="form-check form-switch form-switch-right form-switch-md">
                                                                                            <label for="default-base-showcode" class="form-label text-muted visibilitytext{{$i}}">Show To Public</label>
                                                                                            <input class="custom-switch form-check-input visibility{{$i}}" type="checkbox" name="visibility_to_public[]" value="1" @if(@$category->visibility_to_public) checked @endif>
                                                                                        </div>
                                                                                        <script>
                                                                                            $(".visibility{{$i}}").change(function() {
                                                                                                if(this.checked) {
                                                                                                    $('.visibilitytext{{$i}}').html("Show To Public");
                                                                                                }else{
                                                                                                    $('.visibilitytext{{$i}}').html("Hide From Public");
                                                                                                }
                                                                                            });
                                                                                        </script>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-lg-3 col-md-6">
                                                                                    <div class="set-price mb-0">
                                                                                        <input type="hidden" name="cat_id_db[]" id="cat_id_db" value="{{$category->id}}">
                                                                                        <label>Category Title</label>
                                                                                        <input name="category_title[]" id="category_title" value="{{$category->category_title}}" class="form-control" required type="text" placeholder="Ex: Kids Martial Arts (5 to 7 yrs Old)">
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            @php $priceData = @$category->BusinessPriceDetails; @endphp
                                                                            <input type="hidden"  name="priceCount{{$i}}" id="priceCount{{$i}}" value="{{count($priceData)-1}}" />
                                                                            <div id="priceOptionDiv{{$i}}">
                                                                                @foreach($priceData as $j=>$price)
                                                                                    @include('business.services._price_option',['price'=> $price, 'i'=>$i,'j'=>$j])
                                                                                @endforeach
                                                                            </div>

                                                                            <div class="col-md-12">
                                                                                <div class="addanother">
                                                                                    <a class="" onclick=" return add_another_price_ages({{$i}});"> +Add Another Price Option</a>
                                                                                </div>  
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="modal fade tax{{$i}}" tabindex="-1" aria-labelledby="mySmallModalLabel" aria-hidden="true">
                                                                    <div class="modal-dialog modal-dialog-centered">
                                                                        <div class="modal-content">
                                                                            <div class="modal-header">
                                                                                <h5 class="modal-title" id="myModalLabel">Taxes</h5>
                                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                            </div>
                                                                            <div class="modal-body">
                                                                                <div class="mb-3">
                                                                                    <input type="text" name="sales_tax[]" id="sales_tax" class="form-control" value="{{$category->sales_tax}}" placeholder="Sales Tax">
                                                                                </div>
                                                                                <div class="mb-3">
                                                                                    <input type="text" name="dues_tax[]" id="dues_tax" class="form-control" value="{{$category->dues_tax}}" placeholder="Dues Tax"> 
                                                                                </div>
                                                                            </div>
                                                                            <div class="modal-footer">
                                                                                <button type="button" data-bs-dismiss="modal" class="btn btn-primary btn-red">Submit</button>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        @endforeach
                                                    @else
                                                        <input type="hidden"  name="categoryCount" id="categoryCount" value="0" />
                                                        <div class="accordion custom-accordionwithicon accordion-border-box mt-3" id="category0">
                                                            <div class="accordion-item shadow">
                                                                <h2 class="accordion-header" id="accordionnestingcat0">
                                                                    <button class="accordion-custom-btn accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#accor_nestingcategory0" aria-expanded="false" aria-controls="accor_nestingcategory0">
                                                                        <div class="container-fluid nopadding">
                                                                            <div class="row ">
                                                                                <div class="col-md-6">
                                                                                    Category
                                                                                </div>
                                                                                <div class="col-md-6">
                                                                                    <div class="multiple-options">
                                                                                        <div class="setting-icon">
                                                                                            <i class="ri-more-fill"></i>
                                                                                            <ul id="catUl0">
                                                                                                <li><a href="" data-bs-toggle="modal" data-bs-target=".tax0">
                                                                                                    <i class="fas fa-plus text-muted"></i>Taxes</a></li>
                                                                                                <li><a onclick=" return add_another_price_duplicate_category(0);"><i class="fas fa-plus text-muted"></i>Duplicate Entire Category</a></li>
                                                                                            </ul>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </button>
                                                                </h2>
                                                                <div id="accor_nestingcategory0" class="accordion-collapse collapse" aria-labelledby="accordionnestingcat0" data-bs-parent="#category0">
                                                                    <div class="accordion-body">
                                                                        <div class="row">
                                                                            <div class="col-md-12">
                                                                                <div class="flex-shrink-0 float-right">
                                                                                    <div class="form-check form-switch form-switch-right form-switch-md">
                                                                                        <label for="default-base-showcode" class="form-label text-muted visibilitytext0">Show To Public</label>
                                                                                        <input class="custom-switch form-check-input visibility0" type="checkbox" name="visibility_to_public[]" value="1" checked>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <script type="text/javascript">
                                                                                $(".visibility0").change(function() {
                                                                                    if(this.checked) {
                                                                                        $('.visibilitytext0').html("Show To Public");
                                                                                    }else{
                                                                                        $('.visibilitytext0').html("Hide From Public");
                                                                                    }
                                                                                });
                                                                            </script>
                                                                            <div class="col-lg-3 col-md-6">
                                                                                <div class="set-price mb-0">
                                                                                    <input type="hidden" name="cat_id_db[]" id="cat_id_db" value="">
                                                                                    <label>Category Title</label>
                                                                                    <input name="category_title[]" id="category_title" class="form-control" required type="text" placeholder="Ex: Kids Martial Arts (5 to 7 yrs Old)">
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <input type="hidden"  name="priceCount0" id="priceCount0" value="0" />
                                                                        <div id="priceOptionDiv0">
                                                                            @include('business.services._price_option',['i'=>0,'j'=>0])
                                                                        </div>

                                                                        <div class="col-md-12">
                                                                            <div class="addanother">
                                                                                <a class="" onclick=" return add_another_price_ages(0);"> +Add Another Price Option</a>
                                                                            </div>  
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="modal fade tax0" tabindex="-1" aria-labelledby="mySmallModalLabel" aria-hidden="true">
                                                                <div class="modal-dialog modal-dialog-centered">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header">
                                                                            <h5 class="modal-title" id="myModalLabel">Taxes</h5>
                                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                        </div>
                                                                        <div class="modal-body">
                                                                            <div class="mb-3">
                                                                                <input type="text" name="sales_tax[]" id="sales_tax" class="form-control" value="" placeholder="Sales Tax">
                                                                            </div>
                                                                            <div class="mb-3">
                                                                                <input type="text" name="dues_tax[]" id="dues_tax" class="form-control" value="" placeholder="Dues Tax"> 
                                                                            </div>
                                                                        </div>
                                                                        <div class="modal-footer">
                                                                            <button type="button" data-bs-dismiss="modal" class="btn btn-primary btn-red">Submit</button>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endif
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="add-category">
                                                            <a class="add-category-btn" onclick="addCategory()">Add Another Category</a>
                                                            <p>This is a new category section</p>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-12 col-12">
                                                        <button type="submit" class="btn-red-primary btn-red float-right mt-15" @if($serviceId == 0) disabled @endif>Save </button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div> <!-- end .h-100-->
                    </div> <!-- end col -->
                </div>
            </div>
            <!-- container-fluid -->
        </div>
        <!-- End Page-content -->
    </div>
    <!-- end main content-->
</div>
    <!-- END layout-wrapper -->

<div class="modal fade bs-example-modal-center" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="myModalLabel">Add Instructor</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form  method="post" enctype="multipart/form-data insform" name="addinsform" id="addinsform" >
            @csrf
                <div class="modal-body rev-post-box">
                    <span class="fonts-red" id="addinserro"> </span>
                    <input type="hidden" name="fromservice" id="fromservice" value="fromservice">
                    <input type="hidden" name="position" id="position" value="Instructure">
                    <input type="hidden" name="phone" id="phone" value="(000) 000-000">
                    <div class="mb-3">
                        <input type="text" class="form-control" name="first_name" id="insfirstname" placeholder="Instructor First Name">
                    </div>
                    <div class="mb-3">
                        <input type="text" class="form-control" name="last_name" id="inslastname"  placeholder="Instructor Last Name">
                    </div>
                    <div class="mb-3">
                        <input type="text" class="form-control" name="email" id="insemail" placeholder="Instructor Email">
                    </div>
                    <div class="mb-3">
                        <textarea  name="bio" id="bio" class="form-control" placeholder="Public Bio" rows="3"></textarea>
                    </div>
                    <div class="mb-3">
                        <input type="file" name="insimg" id="insimg" class="form-control">
                    </div>
                </div>
                <div class="modal-footer">
                     <div class="fonts-red" id="addinserro"> </div>
                    <button type="button" onclick="submit_staffmember()" id="submit_member" class="btn btn-primary btn-red">Submit</button>
                </div>
            </form>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<div class="modal fade edit-photo" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true" >
    <div class="modal-dialog modal-dialog-centered modal-80">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="myModalLabel">Edit Photo</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="post" action="{{route('activityimgupdate')}}" enctype="multipart/form-data">
            @csrf                   
                <div class="modal-body">
                    <div class="row justify-content-md-center">
                        <div class="col-md-6">
                            <div class="friend-info">      
                                <div class="post-meta" id="edit_image">
                                </div>
                            </div>
                        </div>
                    </div>                  
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary btn-red">Update</button>
                </div>
            </form>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>

@include('layouts.business.footer')

<!-- <script src="https://maps.googleapis.com/maps/api/js?libraries=places&key="+GOOGLE_MAP_KEY+"&callback=initMap" async defer></script> -->
<script>
    $(document).ready(function(){ 
        $('#programDescLeft').text(500-parseInt($("#programDesc").val().length));
        $('#thingsToKnowLeft').text(2000-parseInt($("#thingsToKnow").val().length));
        $('#expHighlightLeft').text(1000-parseInt($("#expHighlight").val().length));
        $('#accessibilityLeft').text(500-parseInt($("#accessibility").val().length));
        $('#additionalInfoLeft').text(1000-parseInt($("#additionalInfo").val().length));
        $('#descLocationLeft').text(500-parseInt($("#descLocation").val().length));
        $('#addiInfoHelpLeft').text(500-parseInt($("#addiInfoHelp").val().length));

        $("#programDesc").on('input', function() {
            $('#programDescLeft').text(500-parseInt(this.value.length));
        });

        $("#thingsToKnow").on('input', function() {
            $('#thingsToKnowLeft').text(2000-parseInt(this.value.length));
        });

        $("#expHighlight").on('input', function() {
            $('#expHighlightLeft').text(1000-parseInt(this.value.length));
        });

        $("#accessibility").on('input', function() {
            $('#accessibilityLeft').text(500-parseInt(this.value.length));
        });

        $("#additionalInfo").on('input', function() {
            $('#additionalInfoLeft').text(1000-parseInt(this.value.length));
        });

        $("#descLocation").on('input', function() {
            $('#descLocationLeft').text(500-parseInt(this.value.length));
        });

        $("#addiInfoHelp").on('input', function() {
            $('#addiInfoHelpLeft').text(500-parseInt(this.value.length));
        });
    });

    function changetoggle(id){
        otherid = id == 'requestbooking' ? 'instantbooking' : "requestbooking";
        type = $('#'+id).is(':checked') ? false : true;
        otherchkval = $('#'+id).is(':checked') ? 0 : 1;
        chkval = $('#'+id).is(':checked') ? 1 : 0;
        $('#'+otherid).prop("checked", type);
        $('#'+otherid).val(otherchkval);
        $('#'+id).val(chkval);
    }

    function openmodelbox(i,j,val) {
       var checkBox = document.getElementById("is_recurring_"+val+i+j);
        if (checkBox.checked == true){
            $('#btn_recurring_'+val+i+j).trigger("click");
            $('#is_recurring_'+val+i+j).val(1);
        }else{
            $('#is_recurring_'+val+i+j).val(0);
        }
    }

    function recurrint_id(i,j,val) {
        $('#btn_recurring_'+val+i+j).attr("data-bs-target",".edit-"+val+i+j);
    }

    function pay_session_select(i,j,selectedval){
        if(selectedval=='Single') { 
            $('#pay_session'+i+j).val('1');
            $('#pay_session'+i+j).attr('readonly', true); 
        }

        if(selectedval=='Multiple') {
            $('#pay_session'+i+j).val('0');
            $('#pay_session'+i+j).attr('readonly', false);
        }

        if(selectedval=='Unlimited') {
            $('#pay_session'+i+j).val('10000');
            $('#pay_session'+i+j).attr('readonly', true);
        }
    }

    function submit_staffmember() {
        $('.fonts-red').hide();

        if($('#insfirstname').val() !='' && $('#inslastname').val() !='' && $('#bio').val() !='' ){ 
            if (IsEmail($('#insemail').val()) == false) {
                $('#addinserro').show(); 
                $('#addinserro').html('Email-id is invalid');
                return false;
            }

            var formData = new FormData();
            formData.append('first_name', $('#insfirstname').val());
            formData.append('last_name', $('#inslastname').val());
            formData.append('email',$('#insemail').val());
            formData.append('bio', $('#bio').val());
            formData.append("insimg", $('#insimg').val());
            formData.append("position", $("#position").val());
            formData.append("phone", $("#phone").val());
            formData.append("fromservice", $("#fromservice").val());
            formData.append("_token",$('meta[name="csrf-token"]').attr('content'));
            $.ajax({
                url: "{{route('business.staff.store')}}",
                type: 'POST',
                xhrFields: {
                    withCredentials: true
                },
                enctype: 'multipart/form-data',
                cache: false,
                contentType: false,
                processData: false,
                data: formData,
                success: function (response) {
                    if(response)
                    {  
                        $('.rev-post-box').load(' .rev-post-box > *');
                        $('.selectinstructor').load(' .selectinstructor > *')
                        $('#addinserro').show(); 
                        $('#addinserro').html('Instructure Added Successfully..'); 
                    }                    
                }
            });
        }else {
            $('#addinserro').show(); 
            $('#addinserro').html('Please add all details.'); 
            return false;
        }
    }

    function showdiv(i,j){
        var chk = $("input[name='sectiondisplay"+i+j+"']:checked").val();  

        if(chk == 'freeprice'){
            $('.displaysectiondiv'+i+j).addClass('d-none');
            $("#freeprice"+i+j).attr('checked','checked');
            $("#weekendprice"+i+j).removeAttr('checked');
            $("#weekdayprice"+i+j).removeAttr('checked');
        }else if(chk == 'weekendprice'){
            $("#weekendprice"+i+j).attr('checked','checked');
            $("#freeprice"+i+j).removeAttr('checked');
            $("#weekdayprice"+i+j).removeAttr('checked');
            $('.Weekend'+i+j).removeClass('d-none');
            $('.displaysectiondiv'+i+j).css('display','block');
        }else{
            $("#weekdayprice"+i+j).attr('checked','checked');
            $("#freeprice"+i+j).removeAttr('checked');
            $("#weekendprice"+i+j).removeAttr('checked');
            $('.Weekend'+i+j).addClass('d-none');
            $('.displaysectiondiv'+i+j).css('display','block');  
        }
    }

    function changedesclenght(i){
        var desc = $('#days_description'+i).val();
        $('#days_description_left'+i).text(500-parseInt(desc.length));
    }

    function initMap() {
        var map = new google.maps.Map(document.getElementById('map'), {
            center: {lat: -33.8688, lng: 151.2195},
            zoom: 13
        });

        var autocomplete2 = new google.maps.places.Autocomplete(document.getElementById('address'), { types: [ 'geocode' ] });
        google.maps.event.addListener(autocomplete2, 'place_changed', function() {
            infowindow.close();
            marker.setVisible(false);
            var place = autocomplete2.getPlace();
            if (!place.geometry) {
                window.alert("Autocomplete's returned place contains no geometry");
                return;
            }

            // If the place has a geometry, then present it on a map.
            if (place.geometry.viewport) {
                map.fitBounds(place.geometry.viewport);
            } else {
                map.setCenter(place.geometry.location);
                map.setZoom(17);
            }

            marker.setIcon(({
                url: place.icon,
                size: new google.maps.Size(71, 71),
                origin: new google.maps.Point(0, 0),
                anchor: new google.maps.Point(17, 34),
                scaledSize: new google.maps.Size(35, 35)
            }));

            marker.setPosition(place.geometry.location);
            marker.setVisible(true);
            var address = '';
            var badd = '';
            var sublocality_level_1 = '';
            if (place.address_components) {
                address = [
                  (place.address_components[0] && place.address_components[0].short_name || ''),
                  (place.address_components[1] && place.address_components[1].short_name || ''),
                  (place.address_components[2] && place.address_components[2].short_name || '')
                ].join(' ');
            }

            infowindow.setContent('<div><strong>' + place.name + '</strong><br>' + address);
            infowindow.open(map, marker);
           
            // Location details
            for (var i = 0; i < place.address_components.length; i++) {
                if(place.address_components[i].types[0] == 'postal_code'){
                  $('#zip').val(place.address_components[i].long_name);
                }
                if(place.address_components[i].types[0] == 'country'){
                  $('#country').val(place.address_components[i].long_name);
                }

                if(place.address_components[i].types[0] == 'locality'){
                    $('#city').val(place.address_components[i].long_name);
                }

                if(place.address_components[i].types[0] == 'sublocality_level_1'){
                    sublocality_level_1 = place.address_components[i].long_name;
                }

                if(place.address_components[i].types[0] == 'street_number'){
                   badd = place.address_components[i].long_name ;
                }

                if(place.address_components[i].types[0] == 'route'){
                   badd += ' '+place.address_components[i].long_name ;
                } 

                if(place.address_components[i].types[0] == 'administrative_area_level_1'){
                  $('#state').val(place.address_components[i].long_name);
                }
            }

            if(badd == ''){
              $('#address').val(sublocality_level_1);
            }else{
              $('#address').val(badd);
            }
            $('#address_p').val(place.formatted_address);
            $('#lat').val(place.geometry.location.lat());
            $('#lng').val(place.geometry.location.lng());
        });
    }

    function loadMaponclick(){
        $('#mapError').hide();
        var locations = $('#address_p').val();
        var lat = $('#lat').val();
        var lng = $('#lng').val();
        var map1 = ''
        var infowindow1 = ''
        var marker1 = ''
        var markers1 = []
        var circle = ''
        
        if (locations.length != 0) { 
            $('#map_canvas_cus').empty(); 
            console.log('!empty');
            map1 = new google.maps.Map(document.getElementById('map_canvas_cus'), {
                zoom:18,
                center: new google.maps.LatLng(lat, lng),
                mapTypeId: google.maps.MapTypeId.ROADMAP,
            });
            infowindow1 = new google.maps.InfoWindow();
            var bounds = new google.maps.LatLngBounds();
            var marker1;
            var icon1 = {
                url: "{{url('/public/images/hoverout2.png')}}",
                scaledSize: new google.maps.Size(50, 50),
                labelOrigin: {x: 25, y: 16}
            };
            for (var i = 0; i < locations.length; i++) {
                var labelText = i + 1
                marker1 = new google.maps.Marker({
                    position: new google.maps.LatLng(lat,lng),
                    map: map1,
                    icon: icon1,
                    title: labelText.toString(),
                    label: {
                        text: labelText.toString(),
                        color: '#222222',
                        fontSize: '12px',
                        fontWeight: 'bold'
                    }
                });

                bounds.extend(marker1.position);
            }               
            $('.mysrchmap_cus').show()
        } else {
            $('#mapError').show(); 
            $('#mapError').html('Plese Enter All Value For Map');
        }
    }

    function planImg(input,cnt) { 
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                $('.planblah'+cnt).attr('src', e.target.result);
                $("#oldservicepic2"+cnt).val(e.target.result);
            };
            profile_pic_var = input.files[0];
            reader.readAsDataURL(input.files[0]);
        }
    }

    $(document).on('click', '.editpopup', function(e){
        var imgname = $(this).attr("imgname");
        var serviceid =$(this).attr('serviceid');
        $.ajax({
            url: "{{route('editactivityimg')}}",
            xhrFields: {
                    withCredentials: true
                },
            type: 'get',
            data:{
                imgname:imgname,
                serviceid:serviceid,
            },
            success: function (response) {
               $(".edit-photo").modal('show');
                $('#edit_image').html(response);
            }
        });
    });

    $(document).on('click', '.delImage', function(){
        if(confirm("Are you sure you want to delete this?")){
            var _token = $("meta[name='csrf-token']").attr('content');
            var serviceid =$(this).attr('serviceid');
            var imgname =$(this).attr('imgname');
            var valofi =$(this).attr('valofi');
            $.ajax({
                url: "{{route('business.service.destroyimage')}}",
                xhrFields: {
                    withCredentials: true
                },
                type: 'post',
                data:{
                    _token:_token,
                    business_id:'{{$companyId}}',
                    serviceid:serviceid,
                    imgname:imgname,
                },
                success: function (data) {
                    if(data=='success'){
                        $(".imgno_"+valofi).remove();
                    }
                }
            });
        }
    });

</script>

<script type="text/javascript">
    $(document).ready(function(){ 
        loadMaponclick();
        $('#mapError').hide();
    });
</script>

<script type="text/javascript">
    $("body").on("click", ".add-another-day-schedule", function(){
        var cnt=$('#planday_count').val();
        cnt++;
        $('#planday_count').val(cnt);
        var service_price = ""; var daycnt='';
        daycnt = cnt+1;                          
        service_price += '<div class="add_another_day planday'+cnt+'" style="margin-top:20px; padding-top:10px;border-top:1px dotted #000;">'; 
        service_price += '<div class="col-md-11"></div><div class="col-md-1"><i class="remove-day-schedule fa fa-trash-o" style="color:red; font-weight:bold; cursor:pointer; float:right" title="Remove Day"></i></div>';
        var img = "{{url('/public/images/Upload-Icon.png')}}";
        service_price += '<label class="select-dropoff">Day - '+daycnt+' </label><div class="row"><div class="col-md-8"><div class="row"><div class="col-md-3"><div class="photo-upload"><label for="dayplanpic'+cnt+'" id="label"><img src="'+img+'" class="pro_card_img blah planblah'+cnt+'" id="showimg" ><span id="span_'+cnt+'">Upload your file here</span><input type="file" name="dayplanpic_'+cnt+'" id="dayplanpic'+cnt+'" class="uploadFile img" value="Upload Photo" onchange="planImg(this,'+cnt+');" ></label><span class="error" id="err_oldservicepic2'+cnt+'"></span><input type="hidden" id="olddayplanpic2'+cnt+'" name="olddayplanpic_'+cnt+'" value=""></div></div><div class="col-md-6"><div><input type="text" class="form-control" name="days_title[]" id="days_title" placeholder="Give a heading for this day." title="servicetitle"></div><div class="description-txt"><textarea class="form-control valid" rows="2" name="days_description[]" id="days_description'+cnt+'" placeholder="Give a description for this day" maxlength="150" oninput="changedesclenght('+cnt+');"></textarea> <div class="float-right"> <span class="float-right" id="days_description_left'+cnt+'">500 Characters Left</span>500</span> Character Left</div></div></div> </div></div></div>';
        service_price += '</div>';
        $(".add-another-day-schedule-block").append(service_price);
    });
</script>


<script type="text/javascript">
    function  priceOptionFor(i,j,val) {
        let displayArray = ['adult','child','infant'];
        $('[name="'+val+i+j+'"]').change(function(){
            if ($(this).is(':checked')) {
                if(val == 'all'){
                    displayArray.forEach((element) => {
                        $("#"+element+i+j).prop("checked", true); 
                        $("#accor_nesting"+element+i+j).removeClass('d-none');
                    });
                }
                $("#accor_nesting"+val+i+j).removeClass('d-none');
                
            }else{
                if(val == 'all'){
                    displayArray.forEach((element) => {
                        $("#"+element+i+j).prop("checked", false); 
                        $("#accor_nesting"+element+i+j).addClass('d-none');
                    });
                }
              $("#accor_nesting"+val+i+j).addClass('d-none');
            }
        });
    }

    function changeWEndPrice(i,j,type){
        var discount = 0;
        var pay_price =  $('#'+type+'_weekend_price_diff'+i+j).val();
        discount =  $('#'+type+'_discount'+i+j).val();
        var fitnessity_fee = '{{$fitnessity_fee}}';
        $('#weekend_'+type+'_estearn'+i+j).val(pay_price - (pay_price*fitnessity_fee)/100 - (pay_price*discount)/100);
        $('#weekend_'+type+'_estearn'+i+j).attr('readonly', true);
        $('#recurring_price_'+type+''+i+j).val(pay_price);
    }

    function changeDiscount(i,j,type){
        var discount = 0;
        var week_price =  $('#'+type+'_cus_weekly_price'+i+j).val();
        var priceoff = $('#'+type+'_weekend_price_diff'+i+j).val();
        discount =  $('#'+type+'_discount'+i+j).val();
        var fitnessity_fee = '{{$fitnessity_fee}}';

        $('#'+type+'_estearn'+i+j).val(week_price - ((week_price * discount)/100 + (week_price*fitnessity_fee)/100));
        $('#'+type+'_estearn'+i+j).attr('readonly', true);
        $('#weekend_'+type+'_estearn'+i+j).val(priceoff - ((priceoff * discount)/100 + (priceoff*fitnessity_fee)/100));
        $('#weekend_'+type+'_estearn'+i+j).attr('readonly', true);
    }

    function changeWDayPrice(i,j,type){
        var discount = 0;
        var contract_revenue = 0;
        var pay_price =  $('#'+type+'_cus_weekly_price'+i+j).val();
        var discount =  $('#'+type+'_discount'+i+j).val();
        var fitnessity_fee = '{{$fitnessity_fee}}';
        $('#'+type+'_estearn'+i+j).val(pay_price - (pay_price*fitnessity_fee)/100 - (pay_price*discount)/100);
        $('#'+type+'_estearn'+i+j).attr('readonly', true);
        pay_price = pay_price == '' ? 0 :pay_price
       
        var autopay = 1;
        autopay = $('#nuberofautopays_'+type+i+j).val();
        contract_revenue = (autopay *pay_price);
        $('#p1_price_'+type+i+j).html('$'+pay_price);
        $('#p_first_pmt_'+type+i+j).html('$'+pay_price);
        $('#p_recurring_pmt_'+type+i+j).html('$'+pay_price);
        $('#p_total_contract_revenue_'+type+i+j).html('$'+contract_revenue);
        $('#total_contract_revenue_'+type+i+j).val(contract_revenue);
       
        $('#first_pmt_'+type+i+j).val(pay_price);
        $('#recurring_price_'+type+i+j).val(pay_price);
        $('#recurring_pmt_'+type+i+j).val(pay_price);
    }

    function  add_another_price_ages(i) {
        var cnt = $('#priceCount'+i).val();
        cnt++;
        $('#priceCount'+i).val(cnt);
        data = getHtmlData(i,cnt);
        $('#priceOptionDiv'+i).append(data);
    }

    function addCategory(){
        var cnt=$('#categoryCount').val();
        cnt++;
        $('#categoryCount').val(cnt);
        data = '';
        data += '<div class="accordion custom-accordionwithicon accordion-border-box mt-3" id="category'+cnt+'"> <div class="accordion-item shadow"> <h2 class="accordion-header" id="accordionnestingcat0"> <button class="accordion-custom-btn accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#accor_nestingcategory'+cnt+'" aria-expanded="false" aria-controls="accor_nestingcategory'+cnt+'"><div class="container-fluid nopadding"> <div class="row "> <div class="col-md-6"> Category </div> <div class="col-md-6"> <div class="multiple-options"> <div class="setting-icon"> <i class="ri-more-fill"></i> <ul id="catUl'+cnt+'"> <li><a href="" data-bs-toggle="modal" data-bs-target=".tax'+cnt+'"> <i class="fas fa-plus text-muted"></i>Taxes</a></li><li><a onclick=" return add_another_price_duplicate_category('+cnt+');"><i class="fas fa-plus text-muted"></i>Duplicate Entire Category</a></li> <li class="dropdown-divider"></li> <li><a href="" onclick="removeCategoryDiv('+cnt+');"><i class="ri-delete-bin-fill align-bottom me-2 text-muted"></i>Delete</a></li> </ul> </div> </div> </div> </div> </div> </button> </h2> <div id="accor_nestingcategory'+cnt+'" class="accordion-collapse collapse" aria-labelledby="accordionnestingcat0" data-bs-parent="#category'+cnt+'"> <div class="accordion-body"> <div class="row"> <div class="col-md-12"> <div class="flex-shrink-0 float-right"> <div class="form-check form-switch form-switch-right form-switch-md"> <label for="default-base-showcode" class="form-label text-muted visibilitytext'+cnt+'">Show To Public</label> <input class="custom-switch form-check-input visibility'+cnt+'" type="checkbox" name="visibility_to_public[]" value="1" checked> </div> </div> </div> <div class="col-lg-3 col-md-6"> <div class="set-price mb-0"> <input type="hidden" name="cat_id_db[]" id="cat_id_db" value=""> <label>Category Title</label> <input name="category_title[]" id="category_title" class="form-control" required type="text" placeholder="Ex: Kids Martial Arts (5 to 7 yrs Old)"> </div> </div> </div> <input type="hidden" name="priceCount'+cnt+'" id="priceCount'+cnt+'" value="0" /> <div id="priceOptionDiv'+cnt+'">';
        data +=  getHtmlData(cnt,0);
        data += '</div> <div class="col-md-12"> <div class="addanother"> <a class="" onclick=" return add_another_price_ages('+cnt+');"> +Add Another Price Option</a> </div> </div> </div> </div> </div> </div>';
        data += '<div class="modal fade tax'+cnt+'" tabindex="-1" aria-labelledby="mySmallModalLabel" aria-hidden="true"> <div class="modal-dialog modal-dialog-centered"> <div class="modal-content"> <div class="modal-header"> <h5 class="modal-title" id="myModalLabel">Taxes</h5> <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button> </div> <div class="modal-body"> <div class="mb-3"> <input type="text" name="sales_tax[]" id="sales_tax" class="form-control" value="" placeholder="Sales Tax"> </div> <div class="mb-3"> <input type="text" name="dues_tax[]" id="dues_tax" class="form-control" value="" placeholder="Dues Tax"> </div> </div> <div class="modal-footer"> <button type="button" class="btn btn-primary btn-red" data-bs-dismiss="modal">Submit</button> </div> </div> </div> </div>';
        $('#categoryMainDiv').append(data);

        $(".visibility"+cnt).change(function() {
            if(this.checked) {
                $('.visibilitytext'+cnt).html("Show To Public");
            }else{
                $('.visibilitytext'+cnt).html("Hide From Public");
            }
        });
    }

    function getHtmlData(i,cnt) {
        var number = "'number'";
        var dropdown = "'dropdown'";
        var onclickadult ="'adult'";
        var onclickchild ="'child'";
        var onclickinfant ="'infant'";
        var fitnessityFee = '{{$fitnessity_fee}}';
        var recurringFee = '{{$recurring_fee}}';
        var data = "";
        data += '<div class="accordion nesting2-accordion custom-accordionwithicon accordion-border-box mt-3" id="priceoption'+i+cnt+'"> <div class="accordion-item shadow">';
        data += '<h2 class="accordion-header" id="acc_nesting'+i+cnt+'"> <button class="accordion-custom-btn accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#accor_nestingprice'+i+cnt+'" aria-expanded="true" aria-controls="accor_nestingprice'+i+cnt+'"> <div class="container-fluid nopadding"> <div class="row"> <div class="col-lg-6 col-md-6 col-8"> Price Option </div> <div class="col-lg-6 col-md-6 col-4"> <div class="priceoptionsettings"> <div class="setting-icon"> <i class="ri-more-fill"></i> <ul id="ul'+i+cnt+'"> <li><a onclick=" return add_another_price_duplicate_session('+i+');"><i class="fas fa-plus text-muted"></i>Duplicate This Price Option Only</a></li> <li class="dropdown-divider"></li> <li><a href="" onclick="deletePriceOption('+i+','+cnt+')"><i class="ri-delete-bin-fill align-bottom me-2 text-muted"></i>Delete</a></li></ul> </div> </div> </div> </div> </div> </button> </h2> <div id="accor_nestingprice'+i+cnt+'" class="accordion-collapse collapse" aria-labelledby="acc_nesting'+i+cnt+'" data-bs-parent="#priceoption'+i+cnt+'"> <div class="accordion-body"> <input type="hidden" name="price_id_db_'+i+cnt+'" id="price_id_db'+i+cnt+'" value="" /> <div class="row"> <div class="col-lg-3 col-md-6"> <div class="set-price mb-0"> <label>Price Title</label> <input name="price_title_'+i+cnt+'" id="price_title'+i+cnt+'" oninput="getpricetitle('+i+','+cnt+')" class="form-control" type="text" placeholder="Ex: 6 month Membership" required> </div> </div> <div class="col-lg-3 col-md-6"> <div class="set-price mb-0"> <label>Session Type</label> <select name="pay_session_type_'+i+cnt+'" id="pay_session_type'+i+cnt+'" onchange="pay_session_select('+i+','+cnt+',this.value);" class="form-select" data-choices="" data-choices-search-false="" required> <option value="Single">Single</option> <option value="Multiple">Multiple</option> <option value="Unlimited">Unlimited</option> </select> </div> </div> <div class="col-lg-3 col-md-6"> <div class="set-price mb-0"> <label>Number of Sessions</label> <input name="pay_session_'+i+cnt+'" id="pay_session'+i+cnt+'" class="form-control pay_session" readonly type="text" placeholder="1" required onkeypress="return event.charCode >= 46 && event.charCode <= 57"> </div> </div> <div class="col-lg-3 col-md-6"> <div class="set-price mb-0"> <label>Membership Type</label> <select name="membership_type_'+i+cnt+'" id="membership_type'+i+cnt+'" class="form-select membership_type" data-choices="" data-choices-search-false="" required> <option value="Drop In">Drop In</option> <option value="Semester">Semester (Long Term)</option> </select> </div> </div> <div class="col-lg-12"> <p class="info-txt-price">You can set your prices to be the same or different based on age, the weekday or the weekend. To add prices for children or infants, click on the box.</p> </div> <div class="col-md-12"> <div class="mt-15 price-selection"> <input type="radio" id="freeprice'+i+cnt+'" name="sectiondisplay'+i+cnt+'" onclick="showdiv('+i+','+cnt+');" value="freeprice"> <label class="recurring-pmt">Free</label> <input type="radio" id="weekdayprice'+i+cnt+'" name="sectiondisplay'+i+cnt+'" onclick="showdiv('+i+','+cnt+');" value="weekdayprice"> <label class="recurring-pmt">Everyday Price</label> <input type="radio" id="weekendprice'+i+cnt+'" name="sectiondisplay'+i+cnt+'" onclick="showdiv('+i+','+cnt+');" value="weekendprice" checked="checked"> <label class="recurring-pmt">Weekend Price</label> </div> </div> <div class="col-md-12 displaysectiondiv'+i+cnt+'"> <div class="choose-age price-selection"> <p>Select who this price option is for. (choose all that apply)</p> <input type="checkbox" id="all'+i+cnt+'" name="all'+i+cnt+'" onclick="priceOptionFor('+i+','+cnt+',this.value);" value="all" > <label class="recurring-pmt">All</label> <input type="checkbox" id="adult'+i+cnt+'" name="adult'+i+cnt+'" onclick="priceOptionFor('+i+','+cnt+',this.value);" value="adult" checked="checked"> <label class="recurring-pmt">Adults (12 and up)</label> <input type="checkbox" id="child'+i+cnt+'" name="child'+i+cnt+'" onclick="priceOptionFor('+i+','+cnt+',this.value);" value="child"> <label class="recurring-pmt">Children (2 to 12)</label> <input type="checkbox" id="infant'+i+cnt+'" name="infant'+i+cnt+'" onclick="priceOptionFor('+i+','+cnt+',this.value);" value="infant"> <label class="recurring-pmt">Infants ( 2 and Under)</label> </div> </div> </div>'; 
        data += '<div class="accordion nesting4-accordion custom-accordionwithicon accordion-border-box mt-3 displaysectiondiv'+i+cnt+'" id="accor_nestingadult'+i+cnt+'"> <div class="accordion-item shadow"> <h2 class="accordion-header" id="accordionnesting4Example2"> <button class="accordion-custom-btn accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#accor_adult'+i+cnt+'" aria-expanded="false" aria-controls="accor_adult'+i+cnt+'"> Prices Options for Adults </button> </h2> <div id="accor_adult'+i+cnt+'" class="accordion-collapse collapse" aria-labelledby="accor_nestingadult'+i+cnt+'" data-bs-parent="#accor_nestingadult'+i+cnt+'"> <div class="accordion-body"> <div class="container nopadding"> <div class="row"> <div class="age-cat"> <div class="cat-age sp-select"> <label>Adults</label> <p>Ages 12 & Older</p> </div> </div> <div class="weekly-customer"> <div class="cus-week-price sp-select"> <label>Weekday Price</label> <p> (Monday - Sunday)</p> <input name="adult_cus_weekly_price_'+i+cnt+'" id="adult_cus_weekly_price'+i+cnt+'" onkeyup="changeWDayPrice('+i+','+cnt+','+onclickadult+');" type="text" class="form-control "onkeypress="return event.charCode >= 46 && event.charCode <= 57" placeholder="$"></div> </div> <div class="weekend-price Weekend'+i+cnt+'"> <div class="cus-week-price sp-select"> <label>Weekend Price </label> <p> (Saturday & Sunday)</p> <input name="adult_weekend_price_diff_'+i+cnt+'" id="adult_weekend_price_diff'+i+cnt+'" onkeyup="changeWEndPrice('+i+','+cnt+','+onclickadult+');" value="" class="form-control" type="text" placeholder="$" onkeypress="return event.charCode >= 46 && event.charCode <= 57"></div> </div> <div class="re-discount"> <div class="discount sp-select"> <label>Any Discount? </label> <p> (Recommended 10% to 15%)</p> <input class="form-control" type="text" name="adult_discount_'+i+cnt+'" id="adult_discount'+i+cnt+'" onkeyup="changeDiscount('+i+','+cnt+','+onclickadult+');" value="" onkeypress="return event.charCode >= 46 && event.charCode <= 57"> </div> </div> <div class="single-dash"> <div class="desh sp-select"> <label>-</label> </div> </div> <div class="fit-fees"> <div class="fees sp-select"> <label>Introduction Fee<span type="button" class="tool-tip" data-bs-toggle="tooltip" data-bs-placement="top" title="Lorem Ipsum is simply dummy text of the printing and typesetting industry."> <i class="fas fa-info"></i></span><p> '+fitnessityFee+'% Amount</p></label>     <label>Recurring Fee <span type="button" class="tool-tip" data-bs-toggle="tooltip" data-bs-placement="top" title="Lorem Ipsum is simply dummy text of the printing and typesetting industry."> <i class="fas fa-info"></i></span><p> '+recurringFee+'% Amount</p></label></div> </div> <div class="single-equal"> <div class="equal sp-select"> <label>=</label> </div> </div> <div class="estimated-earn"> <div class="cus-week-price earn sp-select"> <label>Weekday Estimated Earnings </label> <input class="form-control" type="text" name="adult_estearn_'+i+cnt+'" id="adult_estearn'+i+cnt+'" onkeypress="return event.charCode >= 46 && event.charCode <= 57" placeholder="$" value=""> </div> </div> <div class="estimated-earn Weekend'+i+cnt+'"> <div class="cus-week-price earn sp-select"> <label>Weekend Estimated Earnings </label> <input class="form-control" type="text" name="weekend_adult_estearn_'+i+cnt+'" id="weekend_adult_estearn'+i+cnt+'" onkeypress="return event.charCode >= 46 && event.charCode <= 57" placeholder="$" value=""> </div> </div> <div class="col-md-12"> <div class="mb-15 mt-15 checkbox-selection"> <input data-count="0" type="checkbox" id="is_recurring_adult'+i+cnt+'" name="is_recurring_adult_'+i+cnt+'" value="0" onclick="openmodelbox('+i+','+cnt+','+onclickadult+');" > <button id="btn_recurring_adult'+i+cnt+'" name="btn_recurring_adult_'+i+cnt+'[]" type="button" data-count="0" class="btn btn-primary recurrint_id d-none" data-bs-toggle="modal" data-bs-target=".edit-adult'+i+cnt+'" onclick="recurrint_id('+i+','+cnt+','+onclickadult+');">Launch demo modal</button> <label for="adults1">Is This A Recurring Payment? Set the Weekly payment terms for Adults </label> </div> </div> </div> </div> </div> </div> </div> </div> <div class="accordion nesting4-accordion custom-accordionwithicon accordion-border-box mt-3 displaysectiondiv'+i+cnt+' d-none" id="accor_nestingchild'+i+cnt+'" > <div class="accordion-item shadow"> <h2 class="accordion-header" id="accordionnesting4Example2"> <button class="accordion-custom-btn accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#accor_child'+i+cnt+'" aria-expanded="false" aria-controls="accor_child'+i+cnt+'"> Prices Options for Children </button> </h2> <div id="accor_child'+i+cnt+'" class="accordion-collapse collapse" aria-labelledby="accor_nestingchild'+i+cnt+'" data-bs-parent="#accor_nestingchild'+i+cnt+'"> <div class="accordion-body"> <div class="container nopadding"> <div class="row"> <div class="age-cat"> <div class="cat-age sp-select"> <label>Children</label> <p>Ages 12 & Older</p> </div> </div> <div class="weekly-customer"> <div class="cus-week-price sp-select"> <label>Weekday Price</label> <p> (Monday - Sunday)</p> <input name="child_cus_weekly_price_'+i+cnt+'" id="child_cus_weekly_price'+i+cnt+'" onkeyup="changeWDayPrice('+i+','+cnt+' ,'+onclickchild+');" type="text" class="form-control "onkeypress="return event.charCode >= 46 && event.charCode <= 57" placeholder="$"></div> </div> <div class="weekend-price Weekend'+i+cnt+'"> <div class="cus-week-price sp-select"> <label>Weekend Price </label> <p> (Saturday & Sunday)</p> <input name="child_weekend_price_diff_'+i+cnt+'" id="child_weekend_price_diff'+i+cnt+'" onkeyup="changeWEndPrice('+i+','+cnt+','+onclickchild+');" value="" class="form-control" type="text" placeholder="$" onkeypress="return event.charCode >= 46 && event.charCode <= 57"></div> </div> <div class="re-discount"> <div class="discount sp-select"> <label>Any Discount? </label> <p> (Recommended 10% to 15%)</p> <input class="form-control" type="text" name="child_discount_'+i+cnt+'" id="child_discount'+i+cnt+'" onkeyup="changeDiscount('+i+','+cnt+','+onclickchild+');" value="" onkeypress="return event.charCode >= 46 && event.charCode <= 57"> </div> </div> <div class="single-dash"> <div class="desh sp-select"> <label>-</label> </div> </div> <div class="fit-fees"> <div class="fees sp-select"> <label>Introduction Fee<span type="button" class="tool-tip" data-bs-toggle="tooltip" data-bs-placement="top" title="Lorem Ipsum is simply dummy text of the printing and typesetting industry."> <i class="fas fa-info"></i></span><p> '+fitnessityFee+'% Amount</p></label>     <label>Recurring Fee <span type="button" class="tool-tip" data-bs-toggle="tooltip" data-bs-placement="top" title="Lorem Ipsum is simply dummy text of the printing and typesetting industry."> <i class="fas fa-info"></i></span><p> '+recurringFee+'% Amount</p></label></div> </div> <div class="single-equal"> <div class="equal sp-select"> <label>=</label> </div> </div> <div class="estimated-earn"> <div class="cus-week-price earn sp-select"> <label>Weekday Estimated Earnings </label> <input class="form-control" type="text" name="child_estearn_'+i+cnt+'" id="child_estearn'+i+cnt+'" onkeypress="return event.charCode >= 46 && event.charCode <= 57" placeholder="$" value=""> </div> </div> <div class="estimated-earn Weekend'+i+cnt+'"> <div class="cus-week-price earn sp-select"> <label>Weekend Estimated Earnings </label> <input class="form-control" type="text" name="weekend_child_estearn_'+i+cnt+'" id="weekend_child_estearn'+i+cnt+'" onkeypress="return event.charCode >= 46 && event.charCode <= 57" placeholder="$" value=""> </div> </div> <div class="col-md-12"> <div class="mb-15 mt-15 checkbox-selection"> <input data-count="0" type="checkbox" id="is_recurring_child'+i+cnt+'" name="is_recurring_child_'+i+cnt+'" value="0" onclick="openmodelbox('+i+','+cnt+','+onclickchild+');" > <label for="child">Is This A Recurring Payment? Set the Weekly payment terms for Children</label> <button id="btn_recurring_child'+i+cnt+'" name="btn_recurring_child_'+i+cnt+'[]" type="button" data-count="0" class="btn btn-primary recurrint_id d-none" data-bs-toggle="modal" data-bs-target=".edit-child'+i+cnt+'" onclick="recurrint_id('+i+','+cnt+','+onclickchild+');">Launch demo modal</button></div> </div> </div> </div> </div> </div> </div> </div> <div class="accordion nesting4-accordion custom-accordionwithicon accordion-border-box mt-3 displaysectiondiv'+i+cnt+' d-none" id="accor_nestinginfant'+i+cnt+'"> <div class="accordion-item shadow"> <h2 class="accordion-header" id="accordionnesting4Example2"> <button class="accordion-custom-btn accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#accor_infant'+i+cnt+'" aria-expanded="false" aria-controls="accor_infant'+i+cnt+'"> Prices Options for Infants </button> </h2> <div id="accor_infant'+i+cnt+'" class="accordion-collapse collapse" aria-labelledby="accor_nestinginfant'+i+cnt+'" data-bs-parent="#accor_nestinginfant'+i+cnt+'"> <div class="accordion-body"> <div class="container nopadding"> <div class="row"> <div class="age-cat"> <div class="cat-age sp-select"> <label>Infant</label> <p>Ages 12 & Older</p> </div> </div> <div class="weekly-customer"> <div class="cus-week-price sp-select"> <label>Weekday Price</label> <p> (Monday - Sunday)</p> <input name="infant_cus_weekly_price_'+i+cnt+'" id="infant_cus_weekly_price'+i+cnt+'" onkeyup="changeWDayPrice('+i+','+cnt+','+onclickinfant+');" type="text" class="form-control" onkeypress="return event.charCode >= 46 && event.charCode <= 57" placeholder="$"> </div> </div> <div class="weekend-price Weekend'+i+cnt+'"> <div class="cus-week-price sp-select"> <label>Weekend Price </label> <p> (Saturday & Sunday)</p> <input name="infant_weekend_price_diff_'+i+cnt+'" id="infant_weekend_price_diff'+i+cnt+'" onkeyup="changeWEndPrice('+i+','+cnt+','+onclickinfant+');" value="" class="form-control" type="text" placeholder="$" onkeypress="return event.charCode >= 46 && event.charCode <= 57"> </div> </div> <div class="re-discount"> <div class="discount sp-select"> <label>Any Discount? </label> <p> (Recommended 10% to 15%)</p> <input class="form-control" type="text" name="infant_discount_'+i+cnt+'" id="infant_discount'+i+cnt+'" onkeyup="changeDiscount('+i+','+cnt+','+onclickinfant+');" value=""onkeypress="return event.charCode >= 46 && event.charCode <= 57"> </div> </div> <div class="single-dash"> <div class="desh sp-select"> <label>-</label> </div> </div> <div class="fit-fees"> <div class="fees sp-select"> <label>Introduction Fee<span type="button" class="tool-tip" data-bs-toggle="tooltip" data-bs-placement="top" title="Lorem Ipsum is simply dummy text of the printing and typesetting industry."> <i class="fas fa-info"></i></span><p> '+fitnessityFee+'% Amount</p></label>     <label>Recurring Fee <span type="button" class="tool-tip" data-bs-toggle="tooltip" data-bs-placement="top" title="Lorem Ipsum is simply dummy text of the printing and typesetting industry."> <i class="fas fa-info"></i></span><p> '+recurringFee+'% Amount</p></label></div> </div> <div class="single-equal"> <div class="equal sp-select"> <label>=</label> </div> </div> <div class="estimated-earn"> <div class="cus-week-price earn sp-select"> <label>Weekday Estimated Earnings </label> <input class="form-control" type="text" name="infant_estearn_'+i+cnt+'" id="infant_estearn'+i+cnt+'" onkeypress="return event.charCode >= 46 && event.charCode <= 57" placeholder="$" value="" > </div> </div> <div class="estimated-earn Weekend'+i+cnt+'"> <div class="cus-week-price earn sp-select"> <label>Weekend Estimated Earnings </label> <input class="form-control" type="text" name="weekend_infant_estearn_'+i+cnt+'" id="weekend_infant_estearn'+i+cnt+'" onkeypress="return event.charCode >= 46 && event.charCode <= 57" placeholder="$" value=""> </div> </div> <div class="col-md-12"> <div class="mb-15 mt-15 checkbox-selection"> <input data-count="0" type="checkbox" id="is_recurring_infant'+i+cnt+'" name="is_recurring_infant_'+i+cnt+'" value="0" onclick="openmodelbox('+i+','+cnt+','+onclickinfant+');" > <button id="btn_recurring_infant'+i+cnt+'" name="btn_recurring_infant_'+i+cnt+'[]" type="button" data-count="0" class="btn btn-primary recurrint_id d-none" data-bs-toggle="modal" data-bs-target=".edit-infant'+i+cnt+'" onclick="recurrint_id('+i+','+cnt+','+onclickinfant+');">Launch demo modal</button> <label for="infant">Is This A Recurring Payment? Set the Weekly payment terms for Infants </label>';
        data += '</div> </div> </div> </div> </div> </div> </div> </div> <div class="row"> <div class="col-md-12"> <div class="serviceprice mt-10"> <h3>When Does This Price Setting Expire</h3> </div> </div> <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12"> <div class="set-num"> <label>Set The Number</label> <input type="text" name="pay_setnum_'+i+cnt+'" id="pay_setnum'+i+cnt+'" class="form-control valid" placeholder="(ex,1,2,3,etc.)" value="1" onkeypress="return IsNumeric(event);" ondrop="return false;" onpaste="return false;" required> </div> </div> <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12"> <div class="set-num"> <label>The Duration</label> <select name="pay_setduration_'+i+cnt+'" id="pay_setduration'+i+cnt+'" class="form-control valid"> <option>Days</option> <option>Months</option> <option>Years</option> </select> </div> </div> <div class="col-lg-1 col-md-2 col-xs-12"> <div class="set-num after"> <label>After</label> </div> </div> <div class="col-lg-5 col-md-10 col-xs-12"> <div class="after-select"> <select name="pay_after_'+i+cnt+'" id="pay_after'+i+cnt+'" class="pay_after form-control valid"> <option value="1" >Starts to expire the day of purchase</option> <option value="2">Starts to expire when the customer first participates in the activity</option> </select> </div> </div> </div> </div> </div>'; 
        data +='<div class="modal fade edit-adult'+i+cnt+'" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true"> <div class="modal-dialog modal-dialog-centered modal-70"> <div class="modal-content"> <div class="modal-header"> <h5 class="modal-title" id="ModelRecurringTitle_adult'+i+cnt+'">Editing Recurring Payments Contract Settings for ("Adult")</h5> <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button> </div> <div class="modal-body"> <div class="row"> <div class="col-lg-8"> <div class="setting-title"> <h3>Settings </h3> </div> <div class="setting-box"> <div class="row"> <div class="col-lg-4 mb-10"> <label class="contractsettings">How often will customers be charged?</label> </div> <div class="col-md-2 mb-10"> <span class="every">Every</span> </div> <div class="col-md-3 mb-10"> <input name="customer_charged_num_adult_'+i+cnt+'" id="customer_charged_num_adult_'+i+cnt+'" value="1" oninput="changeduration('+i+','+cnt+','+onclickadult+','+number+');" onkeypress="return event.charCode >= 48 && event.charCode <= 57"class="form-control valid" type="text" placeholder="1" > </div> <div class="col-md-3 mb-10"> <select class="form-select" name="customer_charged_time_adult_'+i+cnt+'" id="customer_charged_time_adult_'+i+cnt+'" oninput="changeduration('+i+','+cnt+','+onclickadult+','+dropdown+');"data-choices="" data-choices-search-false=""> <option value="Week">week</option> <option value="Month">Month</option> <option value="Year">Year</option> </select> </div> </div> <div class="row"> <div class="col-md-4 mb-10"> <label class="contractsettings">Number of autopays </label> </div> <div class="col-md-8"> <div class="autopays mb-10"> <input type="text" class="form-control valid" name="nuberofautopays_adult_'+i+cnt+'" id="nuberofautopays_adult'+i+cnt+'" placeholder="1" value="" oninput="getnumberofpmt('+i+','+cnt+','+onclickadult+');"> </div> <div class="contract mb-10"> <label> Total duration of contract: </label> <p id="total_duration_adult'+i+cnt+'"> 0 Week</p> </div> </div> </div> <div class="row"> <div class="col-md-4"> <label class="contractsettings mb-10" id="contractsettings_adult'+i+cnt+'">What happens after 4 payments?</label> </div> <div class="col-md-8"> <div class="autopay mb-10"> <input type="radio" id="happens_aftr_12_pmt_adult'+i+cnt+'" name="happens_aftr_12_pmt_adult_'+i+cnt+'" value="contract_expire" checked=""> <label for="contract">Contract Expires</label><br> <input type="radio" id="happens_aftr_12_pmt_adult'+i+cnt+'" name="happens_aftr_12_pmt_adult_'+i+cnt+'" value="contract_renew"> <label for="renews" id="renew_adult'+i+cnt+'">Contract Automaitcally Renews Every 1 payments</label><br> </div> </div> </div> <div class="row"> <div class="col-md-4"> <label class="contractsettings mb-10">When will clients be charged?</label> </div> <div class="col-md-8"> <div class="saledate mb-10"> <select class="form-select" name="client_be_charge_on_adult_'+i+cnt+'" id="client_be_charge_on_adult'+i+cnt+'" data-choices="" data-choices-search-false=""> <option value="sale date">On the sale date </option> <option value="1stday"> 1st Day of the Month</option> <option value="15thday"> 15th Day of the Month</option> </select> </div> </div> </div> <div class="row"> <div class="col-md-4"> <label class="contractsettings mb-10">Recurring Price</label> </div> <div class="col-md-8"> <input type="text" class="form-control valid mb-10" name="recurring_price_adult_'+i+cnt+'" id="recurring_price_adult'+i+cnt+'" placeholder="1" value="" oninput="contract_revenue('+i+','+cnt+','+onclickadult+');"> </div> </div> </div> </div> <div class="col-lg-4"> <div class="setting-title mb-10"> <h3>Contract Review </h3> </div> <div class="setting-box"> <div class="set-border"> <div class="row"> <div class="col-md-8"> <p class="font-black" id="p_price_title_adult'+i+cnt+'"></p> </div> <div class="col-md-4"> <p class="font-black" id="p1_price_adult'+i+cnt+'"> $0</p> </div> </div> </div> <div class="row"> <div class="col-md-12"> <div class="Settings-title"> <h5> Revenue Breakdown </h5> </div> </div> <div class="col-md-10"> <p class="font-black mbb-5" id="trems_payment_adult'+i+cnt+'">Terms: 0 Week Payments</p> </div> <div class="col-md-8"> <p class="font-black mbb-5">First Payment:</p> </div> <div class="col-md-4"> <p class="font-black mbb-5" id="p_first_pmt_adult'+i+cnt+'">$0</p> </div> <input type="hidden" name="first_pmt_adult_'+i+cnt+'" id="first_pmt_adult'+i+cnt+'" value=""> <input type="hidden" name="recurring_pmt_adult_'+i+cnt+'" id="recurring_pmt_adult'+i+cnt+'" value=""> <div class="col-md-8"> <p class="font-black mbb-5">Recurring Payment: </p> </div> <div class="col-md-4"> <p class="font-black mbb-5" id="p_recurring_pmt_adult'+i+cnt+'">$0</p> </div> <input type="hidden" name="total_contract_revenue_adult_'+i+cnt+'" id="total_contract_revenue_adult'+i+cnt+'" value="0"><div class="col-md-8"> <label class="font-black mbb-5">Total Contract Revenue: </label> </div> <div class="col-md-4"> <p class="font-black mbb-5" id="p_total_contract_revenue_adult'+i+cnt+'"> $0 </p> </div> </div> </div> </div> </div> </div> <div class="modal-footer"> <button type="button" class="btn btn-primary btn-red" data-bs-dismiss="modal">Submit</button> </div> </div> </div> </div>';
        data += '<div class="modal fade edit-child'+i+cnt+'" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true"> <div class="modal-dialog modal-dialog-centered modal-70"> <div class="modal-content"> <div class="modal-header"> <h5 class="modal-title" id="ModelRecurringTitle_child'+i+cnt+'">Editing Recurring Payments Contract Settings for ("child")</h5> <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button> </div> <div class="modal-body"> <div class="row"> <div class="col-lg-8"> <div class="setting-title"> <h3>Settings </h3> </div> <div class="setting-box"> <div class="row"> <div class="col-lg-4 mb-10"> <label class="contractsettings">How often will customers be charged?</label> </div> <div class="col-md-2 mb-10"> <span class="every">Every</span> </div> <div class="col-md-3 mb-10"> <input name="customer_charged_num_child_'+i+cnt+'" id="customer_charged_num_child_'+i+cnt+'" value="1" oninput="changeduration('+i+','+cnt+','+onclickchild+','+number+');" onkeypress="return event.charCode >= 48 && event.charCode <= 57"class="form-control valid" type="text" placeholder="1" > </div> <div class="col-md-3 mb-10"> <select class="form-select" name="customer_charged_time_child_'+i+cnt+'" id="customer_charged_time_child_'+i+cnt+'" oninput="changeduration('+i+','+cnt+','+onclickchild+','+dropdown+');"data-choices="" data-choices-search-false=""> <option value="Week">week</option> <option value="Month">Month</option> <option value="Year">Year</option> </select> </div> </div> <div class="row"> <div class="col-md-4 mb-10"> <label class="contractsettings">Number of autopays </label> </div> <div class="col-md-8"> <div class="autopays mb-10"> <input type="text" class="form-control valid" name="nuberofautopays_child_'+i+cnt+'" id="nuberofautopays_child'+i+cnt+'" placeholder="1" value="" oninput="getnumberofpmt('+i+','+cnt+','+onclickchild+');"> </div> <div class="contract mb-10"> <label> Total duration of contract: </label> <p id="total_duration_child'+i+cnt+'"> 0 Week</p> </div> </div> </div> <div class="row"> <div class="col-md-4"> <label class="contractsettings mb-10" id="contractsettings_child'+i+cnt+'">What happens after 4 payments?</label> </div> <div class="col-md-8"> <div class="autopay mb-10"> <input type="radio" id="happens_aftr_12_pmt_child'+i+cnt+'" name="happens_aftr_12_pmt_child_'+i+cnt+'" value="contract_expire" checked=""> <label for="contract">Contract Expires</label><br> <input type="radio" id="happens_aftr_12_pmt_child'+i+cnt+'" name="happens_aftr_12_pmt_child_'+i+cnt+'" value="contract_renew"> <label for="renews" id="renew_child'+i+cnt+'">Contract Automaitcally Renews Every 1 payments</label><br> </div> </div> </div> <div class="row"> <div class="col-md-4"> <label class="contractsettings mb-10">When will clients be charged?</label> </div> <div class="col-md-8"> <div class="saledate mb-10"> <select class="form-select" name="client_be_charge_on_child_'+i+cnt+'" id="client_be_charge_on_child'+i+cnt+'" data-choices="" data-choices-search-false=""> <option value="sale date">On the sale date </option> <option value="1stday"> 1st Day of the Month</option> <option value="15thday"> 15th Day of the Month</option> </select> </div> </div> </div> <div class="row"> <div class="col-md-4"> <label class="contractsettings mb-10">Recurring Price</label> </div> <div class="col-md-8"> <input type="text" class="form-control valid mb-10" name="recurring_price_child_'+i+cnt+'" id="recurring_price_child'+i+cnt+'" placeholder="1" value="" oninput="contract_revenue('+i+','+cnt+','+onclickchild+');"> </div> </div> </div> </div> <div class="col-lg-4"> <div class="setting-title mb-10"> <h3>Contract Review </h3> </div> <div class="setting-box"> <div class="set-border"> <div class="row"> <div class="col-md-8"> <p class="font-black" id="p_price_title_child'+i+cnt+'"></p> </div> <div class="col-md-4"> <p class="font-black" id="p1_price_child'+i+cnt+'"> $0</p> </div> </div> </div> <div class="row"> <div class="col-md-12"> <div class="Settings-title"> <h5> Revenue Breakdown </h5> </div> </div> <div class="col-md-10"> <p class="font-black mbb-5" id="trems_payment_child'+i+cnt+'">Terms: 0 Week Payments</p> </div> <div class="col-md-8"> <p class="font-black mbb-5">First Payment:</p> </div> <div class="col-md-4"> <p class="font-black mbb-5" id="p_first_pmt_child'+i+cnt+'">$0</p> </div> <input type="hidden" name="first_pmt_child_'+i+cnt+'" id="first_pmt_child'+i+cnt+'" value=""> <input type="hidden" name="recurring_pmt_child_'+i+cnt+'" id="recurring_pmt_child'+i+cnt+'" value=""> <div class="col-md-8"> <p class="font-black mbb-5">Recurring Payment: </p> </div> <div class="col-md-4"> <p class="font-black mbb-5" id="p_recurring_pmt_child'+i+cnt+'">$0</p> </div> <input type="hidden" name="total_contract_revenue_child_'+i+cnt+'" id="total_contract_revenue_child'+i+cnt+'" value="0"><div class="col-md-8"> <label class="font-black mbb-5">Total Contract Revenue: </label> </div> <div class="col-md-4"> <p class="font-black mbb-5" id="p_total_contract_revenue_child'+i+cnt+'"> $0 </p> </div> </div> </div> </div> </div> </div> <div class="modal-footer"> <button type="button" class="btn btn-primary btn-red" data-bs-dismiss="modal">Submit</button> </div> </div> </div> </div>'; 
        data += '<div class="modal fade edit-infant'+i+cnt+'" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true"> <div class="modal-dialog modal-dialog-centered modal-70"> <div class="modal-content"> <div class="modal-header"> <h5 class="modal-title" id="ModelRecurringTitle_infant'+i+cnt+'">Editing Recurring Payments Contract Settings for ("Infant")</h5> <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button> </div> <div class="modal-body"> <div class="row"> <div class="col-lg-8"> <div class="setting-title"> <h3>Settings </h3> </div> <div class="setting-box"> <div class="row"> <div class="col-lg-4 mb-10"> <label class="contractsettings">How often will customers be charged?</label> </div> <div class="col-md-2 mb-10"> <span class="every">Every</span> </div> <div class="col-md-3 mb-10"> <input name="customer_charged_num_infant_'+i+cnt+'" id="customer_charged_num_infant_'+i+cnt+'" value="1" oninput="changeduration('+i+','+cnt+','+onclickchild+','+number+');" onkeypress="return event.charCode >= 48 && event.charCode <= 57"class="form-control valid" type="text" placeholder="1" > </div> <div class="col-md-3 mb-10"> <select class="form-select" name="customer_charged_time_infant_'+i+cnt+'" id="customer_charged_time_infant_'+i+cnt+'" oninput="changeduration('+i+','+cnt+','+onclickchild+','+dropdown+');"data-choices="" data-choices-search-false=""> <option value="Week">week</option> <option value="Month">Month</option> <option value="Year">Year</option> </select> </div> </div> <div class="row"> <div class="col-md-4 mb-10"> <label class="contractsettings">Number of autopays </label> </div> <div class="col-md-8"> <div class="autopays mb-10"> <input type="text" class="form-control valid" name="nuberofautopays_infant_'+i+cnt+'" id="nuberofautopays_infant'+i+cnt+'" placeholder="1" value="" oninput="getnumberofpmt('+i+','+cnt+','+onclickchild+');"> </div> <div class="contract mb-10"> <label> Total duration of contract: </label> <p id="total_duration_infant'+i+cnt+'"> 0 Week</p> </div> </div> </div> <div class="row"> <div class="col-md-4"> <label class="contractsettings mb-10" id="contractsettings_infant'+i+cnt+'">What happens after 4 payments?</label> </div> <div class="col-md-8"> <div class="autopay mb-10"> <input type="radio" id="happens_aftr_12_pmt_infant'+i+cnt+'" name="happens_aftr_12_pmt_infant_'+i+cnt+'" value="contract_expire" checked=""> <label for="contract">Contract Expires</label><br> <input type="radio" id="happens_aftr_12_pmt_infant'+i+cnt+'" name="happens_aftr_12_pmt_infant_'+i+cnt+'" value="contract_renew"> <label for="renews" id="renew_infant'+i+cnt+'">Contract Automaitcally Renews Every 1 payments</label><br> </div> </div> </div> <div class="row"> <div class="col-md-4"> <label class="contractsettings mb-10">When will clients be charged?</label> </div> <div class="col-md-8"> <div class="saledate mb-10"> <select class="form-select" name="client_be_charge_on_infant_'+i+cnt+'" id="client_be_charge_on_infant'+i+cnt+'" data-choices="" data-choices-search-false=""> <option value="sale date">On the sale date </option> <option value="1stday"> 1st Day of the Month</option> <option value="15thday"> 15th Day of the Month</option> </select> </div> </div> </div> <div class="row"> <div class="col-md-4"> <label class="contractsettings mb-10">Recurring Price</label> </div> <div class="col-md-8"> <input type="text" class="form-control valid mb-10" name="recurring_price_infant_'+i+cnt+'" id="recurring_price_infant'+i+cnt+'" placeholder="1" value="" oninput="contract_revenue('+i+','+cnt+','+onclickchild+');"> </div> </div> </div> </div> <div class="col-lg-4"> <div class="setting-title mb-10"> <h3>Contract Review </h3> </div> <div class="setting-box"> <div class="set-border"> <div class="row"> <div class="col-md-8"> <p class="font-black" id="p_price_title_infant'+i+cnt+'"></p> </div> <div class="col-md-4"> <p class="font-black" id="p1_price_infant'+i+cnt+'"> $0</p> </div> </div> </div> <div class="row"> <div class="col-md-12"> <div class="Settings-title"> <h5> Revenue Breakdown </h5> </div> </div> <div class="col-md-10"> <p class="font-black mbb-5" id="trems_payment_infant'+i+cnt+'">Terms: 0 Week Payments</p> </div> <div class="col-md-8"> <p class="font-black mbb-5">First Payment:</p> </div> <div class="col-md-4"> <p class="font-black mbb-5" id="p_first_pmt_infant'+i+cnt+'">$0</p> </div> <input type="hidden" name="first_pmt_infant_'+i+cnt+'" id="first_pmt_infant'+i+cnt+'" value=""> <input type="hidden" name="recurring_pmt_infant_'+i+cnt+'" id="recurring_pmt_infant'+i+cnt+'" value=""> <div class="col-md-8"> <p class="font-black mbb-5">Recurring Payment: </p> </div> <div class="col-md-4"> <p class="font-black mbb-5" id="p_recurring_pmt_infant'+i+cnt+'">$0</p> </div> <input type="hidden" name="total_contract_revenue_infant_'+i+cnt+'" id="total_contract_revenue_infant'+i+cnt+'" value="0"><div class="col-md-8"> <label class="font-black mbb-5">Total Contract Revenue: </label> </div> <div class="col-md-4"> <p class="font-black mbb-5" id="p_total_contract_revenue_infant'+i+cnt+'"> $0 </p> </div> </div> </div> </div> </div> </div> <div class="modal-footer"> <button type="button" class="btn btn-primary btn-red" data-bs-dismiss="modal">Submit</button> </div> </div> </div> </div>'; 
        data += '</div> </div>';
        return data;
    }

    function deletePriceOption(i,j){
        var cnt=$('#priceCount'+i).val();
        cnt--;
        $('#priceCount'+i).val(cnt);
        $('#priceoption'+i+j).remove(); 
    }

    function removeCategoryDiv(i){
        var cnt=$('#categoryCount').val();
        cnt--;
        $('#categoryCount').val(cnt);
        $('#category'+i).remove();
    }

    function getnumberofpmt(i,j,val){  
        var part  = $("#nuberofautopays_"+val+i+j).val();
        var price = $("#recurring_price_"+val+i+j).val();
        price = (price == 0 || price == '') ?  $("#"+val+"_cus_weekly_price"+i+j).val() : price;

        if(part == 0){
            part = 0;
        }

        var time = $("#customer_charged_time_"+val+'_'+i+j).val();
        var number = $('#customer_charged_num_'+val+'_'+i+j).val();
        var total = part*price;
        var total_time = (part*number);

        displayPrice  =  total != 0 ? total : price;
        displayPart  =  total != 0 ? part : 0;
        displayTotalTime  =  total != 0 ? total_time : 0;

        $("#p_total_contract_revenue_"+val+i+j).html('$'+displayPrice);
        $("#total_contract_revenue_"+val+i+j).val('$'+displayPrice);
        $("#total_duration_"+val+i+j).html(displayTotalTime+' '+time);
        $("#trems_payment_"+val+i+j).html('Terms: '+displayPart+' '+time+' Payments');

        $("#p_first_pmt_"+val+i+j).html('$'+price);
        $("#p_recurring_pmt_"+val+i+j).html('$'+price);
        $("#first_pmt_"+val+i+j).val(price);
        $("#recurring_pmt_"+val+i+j).val(price);
        $("#contractsettings_"+val+i+j).html('What happens after '+part +' payments?');        
        $("#renew_"+val+i+j).html('Contract Automaitcally Renews Every '+part +' payments');
        $('#'+val+'_recurring_p').html('Is This A Recurring Payment? Set the '+time+'ly payment terms for '+val +' ('+total_time+' '+time+'s contract | $'+price+' A '+time+' for '+total_time+' '+time+'s | Totalling $'+total+' <button type="button" data-toggle="modal" data-target="#ModelRecurring_'+val+i+j+'" class="modelbox-edit-link">Edit</button> )');     
    }

    function getpricetitle(i,j){
        var x = document.getElementById("price_title"+i+j).value;
        let type = ["adult",'child','infant'];
        type.forEach((element) =>{
            document.getElementById("ModelRecurringTitle_"+element+i+j).innerHTML = 'Editing Recurring Payments Contract Settings for ( '+x +' for "'+element.charAt(0).toUpperCase() +element.slice(1)+'")';
            $("#p_price_title_"+element+i+j).html(x);
            $("#p1_price_title_"+element+i+j).html(x);
        });
    }

    function contract_revenue(i,j,val) {
        var autopay = 1;
        var contract_revenue = 1;
        var pay_price = $('#recurring_price_'+val+i+j).val(); 
        var fitnessity_fee = '{{$fitnessity_fee}}';
        autopay = $('#nuberofautopays_'+val+i+j).val();
        contract_revenue = (autopay *pay_price);

        var time = $("#customer_charged_time_"+val+'_'+i+j).val();
        var number = $('#customer_charged_num_'+val+'_'+i+j).val();
        var total_time = (autopay*number);

        $('#p1_price_'+val+i+j).html('$'+pay_price);
        $('#p_total_contract_revenue_'+val+i+j).html('$'+contract_revenue);
        $('#total_contract_revenue_'+val+i+j).val(contract_revenue);
        $('#p_recurring_pmt_'+val+i+j).html('$'+pay_price);
        $('#p_first_pmt_'+val+i+j).html('$'+pay_price);
        $('#first_pmt_'+val+i+j).val(pay_price);
        $('#recurring_price_'+val+i+j).val(pay_price);
        $('#recurring_pmt_'+val+i+j).val(pay_price);
        $('#'+val+'_cus_weekly_price'+i+j).val(pay_price);
        var discount =  $('#'+val+'_discount'+i+j).val();
        $('#'+val+'_estearn'+i+j).val(pay_price - (pay_price*fitnessity_fee)/100 - (pay_price*discount)/100);
        $('#'+val+'_recurring_p').html('Is This A Recurring Payment? Set the '+time+'ly payment terms for '+val +' ('+total_time+' '+time+' contract | $'+pay_price+' A Month for '+total_time+' '+time+'s | Totalling $'+contract_revenue+' <button type="button" data-toggle="modal" data-target="#ModelRecurring_'+val+i+j+'" class="modelbox-edit-link">Edit</button> )');   
    }

    function changeduration(i,j,val,type){
        var time = $('#customer_charged_time_'+val+'_'+i+j).val();
        var number = $('#customer_charged_num_'+val+'_'+i+j).val();
        var autopay = $('#nuberofautopays_'+val+i+j).val();
        let total_time = (autopay *number);
        $('#total_duration_'+val+i+j).html(total_time +' '+ time);
        $('#trems_payment_'+val+i+j).html('Terms: '+autopay+' '+time+' Payments');
    }

    function deleteRecurring(i,j,type) {
        $('#is_recurring_'+type+i+j).attr('checked',false);
        $('#recurringtxt'+type+i+j).html("Is This A Recurring Payment? Set the payment terms for "+type);
    }

    function scheduleLink(cid,id){
        window.open("/business/"+cid+"/schedulers/create?categoryId="+id,"_blank")
    }

    function add_another_price_duplicate_session(i,j){
        var cnt = $('#priceCount'+i).val();
        cnt++;
        var data = '';
        data += '<div id="priceoption'+i+cnt+'" class="accordion nesting2-accordion custom-accordionwithicon accordion-border-box mt-3">';
        data += $('#priceoption'+i+j).html();
        data += '</div>';
    
        var re = data.replaceAll(i+","+j,i+","+cnt);
        re = re.replaceAll("_"+i+j,"_"+i+cnt);
        if(i==0){
            re = re.replaceAll("0"+j,"0"+cnt);
        }else{
            re = re.replaceAll(i+''+j,i+''+cnt);
        }
        $('#priceOptionDiv'+i).append(re);
        $('#ul'+i+cnt).append('<li class="dropdown-divider"></li><li><a href="" onclick="deletePriceOption('+i+','+cnt+')"><i class="ri-delete-bin-fill align-bottom me-2 text-muted"></i>Delete</a></li>')
        $('#priceCount'+i).val(cnt);
        $('#priceoption'+i+cnt).find("input[name='price_id_db_"+i+cnt+"']").val('');
        
    }

    function add_another_price_duplicate_category(i){
        var cnt = $('#categoryCount').val();
        var agecnt = $('#priceCount'+i).val();
        cnt++;
        $('#categoryCount').val(cnt);
        $('#category'+i).children().first();
        var  data = '';
        data += '<div class="accordion custom-accordionwithicon accordion-border-box mt-3" id="category'+cnt+'">';
        data += $('#category'+i).html();
        data += '</div>';

        var re = data.replaceAll("accor_nestingcategory"+i,"accor_nestingcategory"+cnt);
       
        for(var z=0; z<=agecnt ;z++){  
            if(i== 0){ 
                re = re.replace(new RegExp("0"+""+z, "g"),cnt+""+z);
            }else{
                re = re.replace(new RegExp(i+""+z, "g"), cnt+""+z);
            }
        }
       
        re = re.replaceAll("accordionnestingcat"+i,"accordionnestingcat"+cnt);
        re = re.replaceAll("priceCount"+i,"priceCount"+cnt);
        re = re.replaceAll("#category"+i,"#category"+cnt);
        re = re.replaceAll("#visibilitytext"+i,"#visibilitytext"+cnt);
        re = re.replaceAll("#visibility"+i,"#visibility"+cnt);
        re = re.replaceAll("priceOptionDiv"+i,"priceOptionDiv"+cnt);
        re = re.replaceAll("catUl"+i,"catUl"+cnt);
        re = re.replaceAll("("+i+")","("+cnt+")");
        re = re.replaceAll("("+i+",","("+cnt+",");
    
        $('#categoryMainDiv').append(re);
        
        for(var z=0; z<=agecnt ;z++){
            $('#category'+cnt).find("input[name='price_id_db_"+cnt+""+z+"']").val('');
        }

        if(i==0){
           $('#catUl'+cnt).append('<li class="dropdown-divider"></li><li><a href="" onclick="removeCategoryDiv('+cnt+');"><i class="ri-delete-bin-fill align-bottom me-2 text-muted"></i>Delete</a></li>');
        }

        $('#category'+cnt).find("input[name='cat_id_db[]']").val('');
        var firstClass = $('#category'+i).find('.accordion-button').first();
        firstClass.addClass('collapsed');
        $('#accor_nestingcategory'+i).removeClass();
        //$('#accor_nestingcategory'+i).addClass("accordion-collapse collapse");

        /*var accordionHeader = document.querySelector('#accordionnestingcat'+cnt);
        accordionHeader.addEventListener('click', setAccordionHeight(cnt));*/
    }

    /*function setAccordionHeight(cnt) {
        var accordionContent = document.querySelector('#accordionnestingcat'+cnt);
        var accordionHeight = accordionContent.scrollHeight + 'px';
        accordionContent.style.height = accordionHeight;
    }*/
</script>

<script type="text/javascript">
    $(document).ready(function() {
        $('[data-bs-toggle="tooltip"]').tooltip({'placement': 'top'})
    });
   
</script>

<script type="text/javascript">
     var p = new SlimSelect({
        select: '#serviceTypes'
    });
    var p1 = new SlimSelect({
        select: '#serviceLocation'
    });
    var p2 = new SlimSelect({
        select: '#programFor'
    });

    var p3 = new SlimSelect({
        select: '#ageRange'
    });
    var p4 = new SlimSelect({
        select: '#difficultLevel'
    });
    var p5 = new SlimSelect({
        select: '#serviceFocus'
    });
    var p6 = new SlimSelect({
        select: '#teachingStyle'
    });
    var p7= new SlimSelect({
        select: '#includedThings'
    });
    var p8 = new SlimSelect({
        select: '#notIncludedThings'
    });
    var p9 = new SlimSelect({
        select: '#wearThings'
    });

    var sTypes = [], sLocation = [], pFor = [], aRange = [], dLevel = [], sFocus = [], tStyle = [], iThings = [], nIThings = [], wThings = [];

    var serviceTypes = '{{ @$service->select_service_type }}';
    serviceTypes = serviceTypes.split(',');
    $.each(serviceTypes, function( index, value ) {
        sTypes.push(value);
    });
    const s1 = new SlimSelect({
        select: '#serviceTypes'
    });
    s1.set(sTypes); 

    var serviceLocation = '{{ @$service->activity_location }}';
    serviceLocation = serviceLocation.split(',');
    $.each(serviceLocation, function( index, value ) {
      sLocation.push(value);
    });
    const s2 = new SlimSelect({
      select: '#serviceLocation'
    });
    s2.set(sLocation); 

    
    var programFor = '{{ @$service->activity_for }}';
    programFor = programFor.split(',');
    $.each(programFor, function( index, value ) {
        pFor.push(value);
    });
    const s3 = new SlimSelect({
        select: '#programFor'
    });
    s3.set(pFor);

    
    var ageRange = '{{ @$service->age_range }}';
    ageRange = ageRange.split(',');
    $.each(ageRange, function( index, value ) {    
        aRange.push(value);
    });
    const s4 = new SlimSelect({
        select: '#ageRange'
    });
    s4.set(aRange);

    
    var difficultLevel = '{{ @$service->difficult_level }}';
    difficultLevel = difficultLevel.split(',');
    $.each(difficultLevel, function( index, value ) {
        dLevel.push(value);
    });
    const s5 = new SlimSelect({
        select: '#difficultLevel'
    });
    s5.set(dLevel);

    
    var serviceFocus = '{{ @$service->activity_experience }}';
    serviceFocus = serviceFocus.split(',');
    $.each(serviceFocus, function( index, value ) {
        sFocus.push(value);
    });
    const s6 = new SlimSelect({
        select: '#serviceFocus'
    });
    s6.set(sFocus); 

    var teachingStyle = '{{ @$service->instructor_habit }}';
    teachingStyle = teachingStyle.split(',');
    $.each(teachingStyle, function( index, value ) {
        tStyle.push(value);
    });  
    const s7 = new SlimSelect({
        select: '#teachingStyle'
    });
    s7.set(tStyle);
   
    var includedThings = '{{ @$service->included_items }}';
    includedThings = includedThings.split(',');
    $.each(includedThings, function( index, value ) {
        iThings.push(value);
    });  
    const s8 = new SlimSelect({
        select: '#includedThings'
    });
    s8.set(iThings);

    var notIncludedThings = '{{ @$service->notincluded_items }}';
    notIncludedThings = notIncludedThings.split(',');
    $.each(notIncludedThings, function( index, value ) {
        nIThings.push(value);
    });  
    const s9 = new SlimSelect({
        select: '#notIncludedThings'
    });
    s9.set(nIThings);

    var wearThings = '{{ @$service->bring_wear }}';
    wearThings = wearThings.split(',');
    $.each(wearThings, function( index, value ) {
        wThings.push(value);
    });  
    const s10 = new SlimSelect({
        select: '#wearThings'
    });
    s10.set(wThings);
</script> 

<script>
    let dropBox = document.getElementById('dropBox');

    // modify all of the event types needed for the script so that the browser
    // doesn't open the image in the browser tab (default behavior)
    ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(evt => {
        dropBox.addEventListener(evt, prevDefault, false);
    });
    function prevDefault (e) {
        e.preventDefault();
        e.stopPropagation();
    }

    // remove and add the hover class, depending on whether something is being
    // actively dragged over the box area
    ['dragenter', 'dragover'].forEach(evt => {
        dropBox.addEventListener(evt, hover, false);
    });
    ['dragleave', 'drop'].forEach(evt => {
        dropBox.addEventListener(evt, unhover, false);
    });
    function hover(e) {
        dropBox.classList.add('hover');
    }
    function unhover(e) {
        dropBox.classList.remove('hover');
    }

    // the DataTransfer object holds the data being dragged. it's accessible
    // from the dataTransfer property of drag events. the files property has
    // a list of all the files being dragged. put it into the filesManager function
    dropBox.addEventListener('drop', mngDrop, false);
    function mngDrop(e) {
        let dataTrans = e.dataTransfer;
        let files = dataTrans.files;
        filesManager(files);
    }

    // use FormData browser API to create a set of key/value pairs representing
    // form fields and their values, to send using XMLHttpRequest.send() method.
    // Uses the same format a form would use with multipart/form-data encoding
    function upFile(file) {
        //only allow images to be dropped
        let imageType = /image.*/;
        if (file.type.match(imageType)) {
            let url = 'HTTP/HTTPS URL TO SEND THE DATA TO';
            // create a FormData object
            let formData = new FormData();
            // add a new value to an existing key inside a FormData object or add the
            // key if it doesn't exist. the filesManager function will loop through
            // each file and send it here to be added
            formData.append('file', file);

            // standard file upload fetch setup
            fetch(url, {
                method: 'put',
                body: formData
            })
            .then(response => response.json())
            .then(result => { console.log('Success:', result); })
            .catch(error => { console.error('Error:', error); });
        } else {
            console.error("Only images are allowed!", file);
        }
    }

    // use the FileReader API to get the image data, create an img element, and add
    // it to the gallery div. The API is asynchronous so onloadend is used to get the
    // result of the API function
    function previewFile(file) {
        // only allow images to be dropped
        let imageType = /image.*/;
        if (file.type.match(imageType)) {
            let fReader = new FileReader();
            let gallery = document.getElementById('gallery');
            // reads the contents of the specified Blob. the result attribute of this
            // with hold a data: URL representing the file's data
            fReader.readAsDataURL(file);
            // handler for the loadend event, triggered when the reading operation is
            // completed (whether success or failure)
            fReader.onloadend = function() {
                let wrap = document.createElement('div');
                let img = document.createElement('img');
                // set the img src attribute to the file's contents (from read operation)
                img.src = fReader.result;
                let imgCapt = document.createElement('p');
                // the name prop of the file contains the file name, and the size prop
                // the file size. convert bytes to KB for the file size
                let fSize = (file.size / 1000) + ' KB';
                
                gallery.appendChild(wrap).appendChild(img);
                gallery.appendChild(wrap).appendChild(imgCapt);
            }
        } else {
            console.error("Only images are allowed!", file);
        }
    }

    function filesManager(files) {
        // spread the files array from the DataTransfer.files property into a new
        // files array here
        files = [...files];
        // send each element in the array to both the upFile and previewFile
        // functions
        files.forEach(upFile);
        files.forEach(previewFile);
    }
</script>

@endsection