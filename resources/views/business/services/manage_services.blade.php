@inject('request', 'Illuminate\Http\Request')

@extends('layouts.business.header')

@section('content')

	@include('layouts.business.business_topbar')
    @include('business.services.manage_services_sidebar')

    @if(isset($service_data))
        <div id="page-content-wrapper">
            <div class="container-fluid">
                <a href="#menu-toggle" class="btn btn-black mb-15" id="menu-toggle"><i class="fas fa-bars"></i></a>

                <div class="row mb-3 y-middle">
                    <div class="col-lg-6 col-md-6 col-12">
                        <div class="page-heading">
                            <label>Manage {{@$companyName}} Services</label>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-12">
                        <div class="service-create">
                            <a href="{{route('business.service.select')}}" class="btn btn-dark-grey">Create New Service</a>
                        </div>
                        <div class="service-create mr-15">
                            {{-- https://dev.fitnessity.co/activity-details/304 --}}
                            <a href="{{ route('activities_show', ['serviceid' => $service_data->id]) }}" class="btn btn-light-grey" target="_blank">Preview</a>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-xl-7 col-lg-8 col-md-12 col-12">
                        <div class="card">
                            <div class="card-header align-items-center d-flex">
                                <h4 class="card-title mb-0 flex-grow-1 nesting-steps-title">Step 1: Basic Program Details</h4>
                            </div>

                            <div class="card-body">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="live-preview">
                                            <div class="accordion" id="stepone">
                                                <div class="accordion-item shadow">
                                                    <h2 class="accordion-header" id="stepheadingOne">
                                                        <button class="accordion-custom-btn accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
                                                            Explain to your customer what this program is.
                                                        </button>
                                                    </h2>
                                                    <div id="collapseOne" class="accordion-collapse collapse" aria-labelledby="stepheadingOne" data-bs-parent="#stepone">
                                                            <form id="serviceForm" action="{{route('business.services.updateService')}}" method="POST" enctype="multipart/form-data">
                                                                @csrf
                                                                <input type="hidden" name="step" id="step1" value="1">
                                                                <input type="hidden" name="serviceId" id="serviceId" value="{{$serviceId}}">
                                                                <input type="hidden" name="serviceType" id="serviceType" value="{{$serviceType}}">
                                                            <div class="accordion-body">
                                                                <div class="row">
                                                                    <div class="col-lg-12">
                                                                        <div class="steps-title">
                                                                            <div class="mb-3">
                                                                                <label for="choices-publish-status-input" class="form-label">Service Name</label>
                                                                                <input type="text" value="{{$service_data->program_name}}" name="programName" id="programName" class="form-control" placeholder="ex. Kickboxing for adults)" placeholder="ex. Kickboxing for adults)" required>                                                                                    
                                                                                <small id="charCount" class="form-text text-muted">9/30 characters used</small>
                                                                                <div id="error_msg" class="text-danger"></div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-lg-12">
                                                                        <div class="steps-title">
                                                                            <div class="mb-3">
                                                                                <label>Choose Service Type</label>                                                                               
                                                                                <select class="form-select" name="sports" id="sports" data-choices data-choices-search-false required>
                                                                                    <option value="">Choose Service Type</option>
                                                                                        @foreach(@$sportsData as $Sports)
                                                                                            @php $optiondata = app\Sports::where('parent_sport_id',$Sports['id'])->get(); @endphp
                                                                                                @if(count($optiondata)>0)
                                                                                                     <optgroup label="{{$Sports['sport_name']}}">
                                                                                                        @foreach($optiondata as $data)
                                                                                                            <option @if(strtoupper($service_data->sport_activity) == strtoupper($data['sport_name'])) selected @endif >{{$data['sport_name']}}</option>
                                                                                                        @endforeach
                                                                                                    </optgroup>
                                                                                                @else
                                                                                                <option @if(strtoupper($service_data->sport_activity) == strtoupper($Sports['sport_name'])) selected @endif >{{$Sports['sport_name']}}</option>
                                                                                                @endif
                                                                                        @endforeach
                                                                                </select>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    
                                                                    <div class="col-lg-12 mb-20">
                                                                        <div class="steps-title">
                                                                            <div class="mb-3">
                                                                                <label for="choices-publish-status-input" class="form-label">Description</label>
                                                                                <div id="contracttermdiv" style="display:block">
                                                                                    <textarea id="editor" name="programDesc" placeholder="Enter description">{{$service_data->program_desc}}</textarea> 
                                                                                </div>
                                                                                <span class="error" id="errProgramDescLeft"></span>
                                                                                <div class="float-right"><span id="programDescLeft">500</span> Characters Left</div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-lg-12 mt-20">
                                                                        <div class="steps-title">
                                                                            <div class="mb-3">
                                                                                <label for="choices-publish-status-input" class="form-label">Things To Know, Provide key info and details</label> 
                                                                                <p class="af13">This information will be included in the confirmation email.</p>
                                                                                <div id="contracttermdiv" style="display:block">
                                                                                    <!-- <textarea id="editor2" name="thingsToKnow" placeholder=""></textarea> -->
                                                                                    <textarea id="editor2" name="thingsToKnow" placeholder="Tell your customers how they should conduct themselves when attending your place of business or participating in your activity. Set out a few guidelines to help things go smoothly.">{{$service_data->know_before_you_go}}</textarea>
                                                                                </div>
                                                                                <span class="error" id="errThingsToKnow"></span> 
                                                                                <div class="float-right"><span id="thingsToKnowLeft">2000</span> Characters Left</div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                
                                                                <div class="row">
                                                                    <div class="col-md-12">
                                                                        <div class="form-group drag-drop-custom mb-25">
                                                                            <div class="service-price d-grid">
                                                                                <label>Cover Photo</label>
                                                                            </div>
                                                                            <div class="add-photos service-price d-grid">
                                                                                <label class="mb-20">Add Photos <p>(We require at least 5 images. 1 Cover  &amp; at least 4 additional)</p></label>
                                                                                <!-- <label>Add A Cover Photo - <p class="font-red">Dimensions are 500 X 630 </p> </label> -->
                                                                                <ul class="mb-25">
                                                                                    <li>Upload high-resolution photos that capture details and people in action.</li>
                                                                                    <li>Ensure photos are professional and showcase the best of your program.</li>
                                                                                    <li>Avoid heavy filters, distortion, overlaid text, or watermarks.</li>
                                                                                </ul>
                                                                            </div>
                                                                            <div class="dropzone-wrapper">
                                                                                <div class="dropzone-desc">
                                                                                    <p class="font-black d-grid">Drag 'n' drop file here, or click to select file. <label class="font-red display-inline">(Required dimensions for your cover photo is 500 X 311. )</label> </p>
                                                                                </div>
                                                                                <input type="file" class="dropzone" id="coverUpload" name="coverUpload" multiple="" accept="image/*" onchange="filesManager1(this.files)">
                                                                            </div>
                                                                            <div class="error-message mt-10 font-red text-center" id="coverImageError"></div>
                                                                            
                                                                            <!-- <div class="preview-zone "> -->
                                                                            <div class="preview-zone {{ $service_data->cover_photo ? '' : 'hidden' }}">
                                                                                <div class="box box-solid">
                                                                                    <div class="box-header with-border">
                                                                                    <div><b>Preview</b></div>
                                                                                    <div class="box-tools pull-right">
                                                                                        <button type="button" class="btn-bg-none remove-preview">
                                                                                            <i class="fa fa-times"></i> 
                                                                                        </button>
                                                                                    </div>
                                                                                    </div>
                                                                                    
                                                                                    <div class="box-body" id="gallery1">
                                                                                            @if($service_data->cover_photo)
                                                                                                <div class="imagediv  imgno_cover_0" >
                                                                                                        <div class="more-option">
                                                                                                            <div class="more">
                                                                                                                <div class="more-post-optns">
                                                                                                                    <i class="fa fa-ellipsis-h"></i>
                                                                                                                        <ul>
                                                                                                                            <li><a href="javascript:void(0);" class="delImage" serviceid="{{$service_data->id}}" imgname="{{$service_data->cover_photo}}" imagtype="cover" valofi="cover_0"><i class="fa fa-trash"></i>Delete Post</a></li>
                                                                                                                        </ul>
                                                                                                                </div>
                                                                                                            </div>
                                                                                                        </div>
                                                                                                    <img src="{{Storage::Url($service_data->cover_photo)}}" loading="lazy">
                                                                                                </div>
                                                                                            @endif
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                
                                                                <div class="row">
                                                                    <div class="col-lg-12">
                                                                        <div class="service-price d-grid mt-25">
                                                                            <label>Add Additional Photo's - <p>Dimensions are 500 X 311.</p></label>
                                                                        </div>
                                                                    </div>
                                                                    
                                                                    <div class="col-lg-12">
                                                                        <div class="add-photos">                                                                                        
                                                                            <div id="dropBox" class="dropBoximg">
                                                                                <p>Drag &amp; Drop Images Here...</p>
                                                                                <input type="file" id="imgUpload" name="imgUpload[]" multiple="" accept="image/*" onchange="filesManager(this.files)">
                                                                                <!-- <input type="file" id="imgUpload" name="imgUpload[]" multiple="" accept="image/*" onchange="filesManager(this.files)"> -->
                                                                                <label class="buttonimg" for="imgUpload">...or Upload from your device</label>
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
                                                                                                                                <li><a imgname="{{$img}}" class="editpopup" href="javascript:void(0);" serviceid="{{$service_data->id}}"><i class="fa fa-pencil-square-o"></i>Edit Image</a></li>
                                                                                                                                <li><a href="javascript:void(0);" class="delImage" serviceid="{{$service_data->id}}" imgname="{{$img}}" valofi={{$key}}><i class="fa fa-trash"></i>Delete Image</a></li>
                                                                                                                            </ul>
                                                                                                                        </div>
                                                                                                                    </div>
                                                                                                                </div>
                                                                                                                <img src="{{Storage::Url($img)}}" loading="lazy">
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
                                                                                                                                <a imgname="{{$profile_pic}}" class="editpopup" href="javascript:void(0);" serviceid="{{$service_data->id}}"><i class="fa fa-pencil-square-o"></i>Edit Post</a>
                                                                                                                            </li>
                                                                                                                            <li><a href="javascript:void(0);" class="delImage" serviceid="{{$service_data->id}}" imgname="{{$profile_pic}}" valofi="0"><i class="fa fa-trash"></i>Delete Post</a></li>
                                                                                                                        </ul>
                                                                                                                    </div>
                                                                                                                </div>
                                                                                                            </div>
                                                                                                            <img src="{{Storage::Url($profile_pic)}}" loading="lazy">
                                                                                                        </div>
                                                                                                    @endif
                                                                                            @endif
                                                                                </div>
                                                                            </div>
                                                                            <!-- <div class="text-center mt-10">
                                                                                <span id="b_embedvideo" class="font-red">Required Dimensions for Your Cover Photo Is 500 X 311. </span>
                                                                            </div> -->
                                                                            
                                                                            <div class="error-message mt-10 font-red text-center" id="imageError"></div>
                                                                        </div>

                                                                        <div class="add-photos mt-30">
                                                                            <h3 class="mb-4">Add A Video</h3>
                                                                            <ul>
                                                                                <li>Upload a professional video highlighting your best work.</li>
                                                                                <li>Show action and key details.</li>
                                                                                <li>Plan the video, remove clutter, and eliminate background noise.</li>
                                                                                <li>Use appropriate music; avoid profanity or inappropriate content.</li>
                                                                            </ul>
                                                                            <div class="steps-title">
                                                                                <div class="mb-3 mt-4">
                                                                                    <label for="choices-publish-status-input" class="form-label">Embed Video Code </label>
                                                                                    <input type="text" class="form-control" name="video" id="video" placeholder="Video Code" value="{{$service_data->video}}" maxlength="150">
                                                                                    <span id="b_embedvideo">Example: https://www.youtube.com/embed/<b>rW_fwcmyIfk</b></span>
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
                                    </div>
                                </div>
                            </div>
                            <!-- end card-body -->
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-xl-7 col-lg-8 col-md-12 col-12">
                        <div class="card">
                            <div class="card-header align-items-center d-flex">
                                <h4 class="card-title mb-0 flex-grow-1 nesting-steps-title">Step 2: Online Marketplace Settings</h4>
                            </div><!-- end card header -->

                            <div class="card-body">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="live-preview">
                                            <div class="accordion" id="steptwo">
                                                <div class="accordion-item shadow">
                                                    <h2 class="accordion-header" id="stepheadingTwo">
                                                        <button class="accordion-custom-btn accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                                            Provide more details to get booked
                                                        </button>
                                                    </h2>
                                                    <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="stepheadingTwo" data-bs-parent="#steptwo" style="">
                                                    <!-- <form action="https://dev.fitnessity.co/business/68/services" method="POST" enctype="multipart/form-data"> -->
                                                        <form action="{{route('business.services.updateService')}}" method="POST" enctype="multipart/form-data">
                                                        @csrf
                                                        <input type="hidden" name="step" id="step2" value="2">
                                                        <input type="hidden" name="serviceId" id="serviceId" value="{{$serviceId}}">
                                                        <input type="hidden" name="serviceType" id="serviceType" value="{{$serviceType}}">                                                        
                                                        <div class="accordion-body">
                                                            <div class="steps-title">
                                                                <div class="mb-3">
                                                                    <div class="form-check form-switch">
                                                                    <input class="custom-switch form-check-input" type="checkbox" name="instantbooking" id="instantbooking" onchange="changetoggle('instantbooking');" @if(@$service_data->request_booking == 0 || @$service_data->instant_booking == 1) checked @endif>
                                                                        <!-- <input class="custom-switch form-check-input" type="checkbox" name="instantbooking" id="instantbooking" onchange="changetoggle('instantbooking');" checked=""> -->
                                                                        <label class="form-check-label" for="flexSwitchCheckDefault">INSTANT BOOKING:</label>
                                                                        <p>Allow customers to book you instantly (Recommeded to get more bookings)</p>
                                                                    </div>
                                                                    <div class="form-check form-switch">
                                                                    <input class="custom-switch form-check-input" type="checkbox" name="requestbooking" id="requestbooking"  onchange="changetoggle('requestbooking');" @if(@$service_data->request_booking == 1) checked @endif>
                                                                        <!-- <input class="custom-switch form-check-input" type="checkbox" name="requestbooking" id="requestbooking" onchange="changetoggle('requestbooking');"> -->
                                                                        <label class="form-check-label" for="flexSwitchCheckChecked">REQUEST BOOKING:</label>
                                                                        <p>You confirm all booking request first. (Less frequent bookings)</p>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row mb-15">
                                                                <div class="col-lg-7 col-md-7 col-xxl-5 col-12">
                                                                    <div class="participant-req">
                                                                        <p>Minimum participants per booking?</p>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-5 col-md-3 col-xxl-7 col-12">
                                                                    <div class="">
                                                                        <input name="minParticipate" id="minParticipate" placeholder="1" value="{{ @$service_data->frm_min_participate != '' ? $service_data->frm_min_participate : 1 }}" type="text" class="form-control">
                                                                        <!-- <input name="minParticipate" id="minParticipate" placeholder="1" value="1" type="text" class="form-control"> -->
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="row mb-15 align-items-center">
                                                                <div class="col-md-6 col-lg-6 col-xxl-5 col-12">
                                                                    <div class="participant-req">
                                                                        <p>The latest someone can book online before the activity starts?</p>
                                                                    </div>
                                                                </div>
                                                                <!-- <div class="col-lg-2 col-md-3 col-xxl-3 col-12">
                                                                    <input name="beforetimeint" id="beforetimeint" placeholder="1" value="1" type="text" class="form-control mmb-15">
                                                                </div>
                                                                <div class="col-lg-3 col-md-3 col-xxl-4 col-12">
                                                                    <select class="form-select" name="beforetime" id="beforetime" data-choices="" data-choices-search-false="">
                                                                        <option value="minutes" selected="">Minute(s)</option>
                                                                        <option value="hours">Hour(s)</option>
                                                                    </select>
                                                                </div> -->
                                                                <div class="col-lg-2 col-md-3 col-xxl-3 col-12">
                                                                        <input name="beforetimeint" id="beforetimeint" placeholder="1" value="{{ @$service_data->beforetimeint != '' ? $service_data->beforetimeint : 1 }}" type="text" class="form-control mmb-15">
                                                                </div>
                                                                    <div class="col-lg-3 col-md-3 col-xxl-4 col-12">
                                                                            <select class="form-select" name="beforetime" id="beforetime" data-choices="" data-choices-search-false="">
                                                                                <option value="minutes"  <?=(@$service_data->beforetime=='minutes')?"selected":""?>>Minute(s)</option>
                                                                                <option value="hours"  <?=(@$service_data->beforetime=='hours')?"selected":""?>>Hour(s)</option>
                                                                            </select>
                                                                    </div>
                                                            </div>


                                                            <div class="row mb-15 align-items-center">
                                                                <div class="col-md-6 col-lg-8 col-xxl-5 col-12">
                                                                    <div class="participant-req">
                                                                        <p>Can customers book after the activity starts?</p>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-4 col-md-3 col-12">
                                                                    <div class="">
                                                                        <div class="price-selection">
                                                                            <!-- <input type="radio" name="can_book_after_activity_starts" value="No" onchange="handleRadioChange(this)" checked=""> -->
                                                                            <input type="radio"  name="can_book_after_activity_starts" value="No" onchange="handleRadioChange(this)"@if(@$service_data->can_book_after_activity_starts == 'No' || !@$service_data->can_book_after_activity_starts ) checked @endif>
                                                                            <label class="recurring-pmt">No</label>
                                                                            <input type="radio"  name="can_book_after_activity_starts" value="Yes"  onchange="handleRadioChange(this)" @if(@$service_data->can_book_after_activity_starts == 'Yes' )  checked @endif>      
                                                                            <!-- <input type="radio" name="can_book_after_activity_starts" value="Yes" onchange="handleRadioChange(this)"> -->
                                                                            <label class="recurring-pmt">Yes</label>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="row mb-15 @if(@$service_data->can_book_after_activity_starts != 'Yes' ) d-none @endif cutoff">
                                                                <div class="col-md-6 col-lg-4 col-xxl-4">
                                                                    <div class="participant-req">
                                                                        <p>Online Booking Cutoff</p>
                                                                    </div>
                                                                </div>
                                                            <div class="col-lg-2 col-xxl-3 col-md-3">
                                                                <input name="aftertimeint" id="aftertimeint" placeholder="1" value="{{ @$service_data->aftertimeint != '' ? $service_data->aftertimeint : 1 }}" type="text" class="form-control mmb-15">
                                                            </div>
                                                                <div class="col-lg-3 col-xxl-4 col-md-3">                                                                    
                                                                    <select class="form-select" name="aftertime" id="aftertime" data-choices="" data-choices-search-false="">
                                                                            <option value="minutes"  <?=(@$service_data->aftertime=='minutes')?"selected":""?>>Minute(s)</option>
                                                                            <option value="hours"  <?=(@$service_data->aftertime=='hours')?"selected":""?>>Hour(s)</option>
                                                                    </select>
                                                                </div>
                                                            </div>

                                                            <div class="row mb-15">
                                                                <div class="col-md-6 col-lg-7 col-xxl-5">
                                                                    <div class="participant-req">
                                                                        <p>Latest a customer can cancel online.</p>
                                                                    </div>
                                                                </div>
                                                                <!-- <div class="col-lg-2 col-xxl-3 col-md-3">
                                                                    <input name="cancelBeforeInt" id="cancelBeforeInt" placeholder="1" value="1" type="text" class="form-control mmb-15">
                                                                </div>
                                                                <div class="col-lg-3 col-xxl-4 col-md-3">
                                                                    <select class="form-select" name="cancelBefore" id="cancelBefore" data-choices="" data-choices-search-false="">
                                                                        <option value="minutes" selected="">Minute(s)</option>
                                                                        <option value="hours">Hour(s)</option>
                                                                    </select>
                                                                </div> -->
                                                                <div class="col-lg-2 col-xxl-3 col-md-3">
                                                                                <input name="cancelBeforeInt" id="cancelBeforeInt" placeholder="1" value="{{ @$service_data->cancelbeforeint != '' ? $service_data->cancelbeforeint : 1 }}" type="text" class="form-control mmb-15">
                                                                            </div>
                                                                            <div class="col-lg-3 col-xxl-4 col-md-3">
                                                                                <select class="form-select" name="cancelBefore" id="cancelBefore" data-choices="" data-choices-search-false="">
                                                                                    <option value="minutes" <?=(@$service_data->cancelbefore=='minutes')?"selected":""?>>Minute(s)</option>
                                                                                    <option value="hours" <?=(@$service_data->cancelbefore=='hours')?"selected":""?>>Hour(s)</option>
                                                                                </select>
                                                                            </div>
                                                                </div>

                                                            <div class="row mb-15">
                                                                <div class="col-lg-6 col-md-6 col-sm-6">
                                                                    <div class="priceselect sp-select">
                                                                        <label>Select Service Type</label>
                                                                        <!-- <div id="individualstype" style="">
                                                                            <select name="frm_servicetype[]" id="categSTypeidividuals" multiple>
                                                                                <option value="Personal Training">Personal Training</option>
                                                                                <option value="Coaching">Coaching</option>
                                                                                <option value="Therapy">Therapy</option>
                                                                                <option value="Event">Event </option>
                                                                                <option value="Seminar">Seminar </option>
                                                                            </select>
                                                                        </div> -->
                                                                                    <div id="individualstype" class="gray" style="">
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
                                                                <div class="col-lg-6 col-md-6 col-sm-6">
                                                                                <div class="priceselect sp-select gray">
                                                                                    <label>Location of Activity ?</label>
                                                                                    <select name="serviceLocation[]" id="serviceLocation" multiple>
                                                                                        <option value="Online">Online</option>
                                                                                        <option value="At Business">At Business</option>
                                                                                        <option value="On Location">On Location</option>
                                                                                    </select>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-lg-6 col-md-6 col-sm-6">
                                                                                <div class="priceselect sp-select gray">
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
                                                                            <div class="col-lg-6 col-md-6 col-sm-6">
                                                                                <div class="priceselect sp-select gray">
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
                                                                        <div class="row mb-15">
                                                                            <div class="col-lg-6 col-md-6 col-sm-6">
                                                                                <div class="priceselect sp-select gray">
                                                                                    <label>Difficulty Levels?</label>
                                                                                    <select name="difficultLevel[]" id="difficultLevel" multiple>
                                                                                        <option>Easy</option>
                                                                                        <option>Medium</option>
                                                                                        <option>Hard</option>
                                                                                        <option>Any</option>
                                                                                    </select>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-lg-6 col-md-6 col-sm-6">
                                                                                <div class="priceselect sp-select gray">
                                                                                    <label>Customers Experience?</label>
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
                                                                            <div class="col-lg-6 col-md-6 col-sm-6">
                                                                                <div class="priceselect sp-select gray">
                                                                                    <label>Host Personality</label>
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
                                                                    
                                                                        <div class="row mb-15">
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
                                    </div>
                                </div>
                            </div><!-- end card-body -->
                        </div><!-- end card -->
                    </div>
                </div>

                <div class="row">
                    <div class="col-xl-7 col-lg-8 col-md-12 col-12">
                        <div class="card">
                            <div class="card-header align-items-center d-flex">
                                <h4 class="card-title mb-0 flex-grow-1 nesting-steps-title">Step 3: Add More Details</h4>
                            </div>
                        
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="live-preview">
                                            <div class="accordion" id="step5">
                                                <div class="accordion-item shadow">
                                                    <h2 class="accordion-header" id="stepheading5">
                                                        <button class="accordion-custom-btn accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse5" aria-expanded="false" aria-controls="collapse5">
                                                        Set Up Your Itinerary (Let customers know what they will be doing for this experience)
                                                        </button>
                                                    </h2>
                                                    <div id="collapse5" class="accordion-collapse collapse" aria-labelledby="stepheading5" data-bs-parent="#step5" style="">
                                                    <form action="{{route('business.services.updateService')}}" method="POST" enctype="multipart/form-data" >
                                                           @csrf
                                                            <input type="hidden" name="step" id="step3" value="3">
                                                            <input type="hidden" name="serviceId" id="serviceId" value="{{$serviceId}}">
                                                            <input type="hidden" name="serviceType" id="serviceType" value="{{$serviceType}}">
                                                            <div class="accordion-body">
                                                                            
                                                                            <div class="row @if($serviceType != 'experience') d-none @endif">
                                                                                <div class="col-lg-6">
                                                                                    <div class="itinerary-data">
                                                                                        <h3>Experience Highlights</h3> 
                                                                                        <!-- <textarea name="expHighlight" id="expHighlight" maxlength="1000" class="form-control valid" rows="6"  placeholder="Briefly describe a few highlights so customer understand what they will be doing. ">{{@$service->exp_highlight}}</textarea>
                                                                                        <div class="float-right"><span id="expHighlightLeft">1000</span>  Characters Left</div>  -->
                                                                                        <textarea name="expHighlight" id="ckeditor-classic" style="display: none;">{{@$service_data->exp_highlight}}</textarea>
                                                                                        <div id="ckeditor-classic" >
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="dropdown-divider mt-20 mb-20 @if($serviceType != 'experience') d-none @endif"></div>
                                                                            <div class="row @if($serviceType != 'experience') d-none @endif">
                                                                                <div class="col-lg-12 col-md-12">
                                                                                    <div class="booking-titles">
                                                                                        <h3>What's Included? (e.g., transport, food, equipment, photos).</h3>
                                                                                        <!-- <p>What do you provide for your customers?</p>
                                                                                        <p>Examples: You provide pick up and drop off transportation from hotels etc., provider, food and drinks, special equipment, video and photography services etc.)</p> -->
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="row mb-15 @if($serviceType != 'experience') d-none @endif">
                                                                                <div class="col-lg-12 col-md-12 col-sm-12">
                                                                                    <div class="activity-width">
                                                                                        <div class="special-offer select-dropoff">
                                                                                            <div class="multiples gray">
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

                                                                            <div class="row @if($serviceType != 'experience') d-none @endif">
                                                                                <div class="col-lg-12 col-md-12">
                                                                                    <div class="booking-titles">
                                                                                        <h3>What’s not included? (e.g., no food, drinks, equipment, or insurance)</h3>
                                                                                        <!-- <p>List the items or services that are not includes with this experience. i.e. no food or drinks, no equipment, no insurance, etc. </p> -->
                                                                                    </div>
                                                                                </div>
                                                                            </div>

                                                                            <div class="row mb-15 @if($serviceType != 'experience') d-none @endif">
                                                                                <div class="col-lg-12 col-md-12 col-sm-12">
                                                                                    <div class="activity-width">
                                                                                        <div class="special-offer select-dropoff">
                                                                                            <div class="multiples gray">
                                                                                                <select name="notIncludedThings[]" id="notIncludedThings" multiple="" tabindex="-1" data-ssid="ss-30992">
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
                                                                                        <p>Select items and attire guests need for the experience. </p>
                                                                                        <!-- <p>If guests need anything in order to enjoy your experience, this is the place to tell them. Be as detailed as possible and add each item individually. </p> -->
                                                                                    </div>
                                                                                </div>
                                                                            </div>

                                                                            <div class="row mb-15">
                                                                                <div class="col-lg-12 col-md-12 col-sm-12">
                                                                                    <div class="activity-width">
                                                                                        <div class="special-offer select-dropoff">
                                                                                            <div class="multiples gray">
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

                                                                            <div class="row mb-15">
                                                                                <div class="col-lg-12 col-md-12">
                                                                                    <div class="booking-titles">
                                                                                        <h3>Accessibility</h3>
                                                                                        <p>Explain if there is easy access for the disabled</p>
                                                                                    </div>
                                                                                </div>
                                                                            </div>

                                                                            <div class="row mb-15">
                                                                                <div class="col-lg-12 col-md-12 col-sm-12">
                                                                                    <div class="accessibility select-dropoff">
                                                                                        <textarea name="accessibility" id="accessibility" maxlength="500" class="form-control valid" rows="3" >{{@$service_data->accessibility}}</textarea>
                                                                                        <div class="float-right"><span id="accessibilityLeft">500</span>  Characters Left</div> 
                                                                                    </div>
                                                                                </div>
                                                                            </div>

                                                                            <div class="row mb-15 @if($serviceType != 'experience') d-none @endif">
                                                                                <div class="col-lg-12 col-md-12">
                                                                                    <div class="booking-titles">
                                                                                        <h3>Additional Information & FAQ</h3>
                                                                                        <p>Have a few things you want your customers to know before arriving? </p>
                                                                                    </div>
                                                                                </div>
                                                                            </div>

                                                                            <div class="row mb-15 @if($serviceType != 'experience') d-none @endif">
                                                                                <div class="col-lg-12 col-md-12 col-sm-12">
                                                                                    <div class="accessibility select-dropoff">
                                                                                        <textarea class="form-control valid" rows="6" name="additionalInfo" id="additionalInfo" maxlength="1000"
                                                                                        >{{@$service_data->addi_info}}</textarea>
                                                                                        <div class="float-right"><span id="additionalInfoLeft">1000</span>  Characters Left</div>                                                                           
                                                                                    </div>
                                                                                </div>
                                                                            </div>

                                                                            <div class="dropdown-divider mt-20 mb-20 @if($serviceType != 'experience') d-none @endif"></div>

                                                                            <div class="row mb-15 @if($serviceType != 'experience') d-none @endif">
                                                                                <div class="col-lg-12 col-md-12">
                                                                                    <div class="plandaybyday">
                                                                                        <h2>Set Your Itinerary</h2>
                                                                                        <p class="fs-15 mb-15">You can set by Day or Time</p>
                                                                                        <h3>Let’s Plan Your Day By Day</h3>
                                                                                        <p>Provide a daily plan with a title, image, and description for each day </p>
                                                                                        @php 
                                                                                            $dplantitle = @$service_data->days_plan_title != '' ? json_decode(@$service_data->days_plan_title,true) : [];
                                                                                            $dplanimg = @$service_data->days_plan_img != '' ? explode(",",$service_data->days_plan_img) : []; 
                                                                                            $dplandesc = @$service_data->days_plan_desc != '' ? json_decode($service_data->days_plan_desc,true) : []; 
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
                                                                                                        <div class="row y-middle"> 
                                                                                                            <div class="col-lg-2 col-md-4 col-6">
                                                                                                                <label class="select-dropoff">Day - {{$i+1}}</label>
                                                                                                            </div>
                                                                                                            @if($i != 0)
                                                                                                                <div class="col-lg-5 col-md-8 col-6">
                                                                                                                    <i class="remove-day-schedule fas fa-trash i-remove-day mb-15" title="Remove Day"></i>
                                                                                                                </div>
                                                                                                            @endif
                                                                                                        </div>
                                                                                                        
                                                                                                        <div class="row">
                                                                                                            <div class="col-md-12 col-sm-12">
                                                                                                                <div class="row">
                                                                                                                    <div class="col-lg-4 col-md-4 col-sm-3">
                                                                                                                        <div class="photo-upload">
                                                                                                                            <label for="dayplanpic{{$i}}" id="label">
                                                                                                                            @php    $old_pic = @$dplanimg[$i] != ''  ?  @$dplanimg[$i] : ''; 
                                                                                                                                    $day_pic = @$dplanimg[$i] != ''  ?  Storage::Url(@$dplanimg[$i]) : url('/public/images/Upload-Icon.png'); @endphp
                                                                                                                            <img src="{{$day_pic}}" class="pro_card_img blah planblah{{$i}}" id="showimg" loading="lazy">
                                                                                                                            <span id="span_{{$i}}">Upload your file here</span>
                                                                                                                                <input name="dayplanpic_{{$i}}" id="dayplanpic{{$i}}" onchange="planImg(this,{{$i}});" type="file" class="uploadFile img" value="Upload Photo" >
                                                                                                                            </label>
                                                                                                                            <span class="error" id="err_oldservicepic2{{$i}}"></span>
                                                                                                                            <input type="hidden" id="olddayplanpic2{{$i}}" name="olddayplanpic_{{$i}}" value="{{$old_pic}}">
                                                                                                                        </div>
                                                                                                                    </div>
                                                                                                                    <div class="col-lg-8 col-md-8 col-sm-9">
                                                                                                                        <div>
                                                                                                                            <input name="days_title[]" id="days_title" value="{{$dplantitle[$i]}}" type="text" class="form-control" placeholder="Give a heading for this day." title="servicetitle">
                                                                                                                        </div>
                                                                                                                        <div class="description-txt">
                                                                                                                            <textarea name="days_description[]" id="days_description{{$i}}" oninput="changedesclenght({{$i}});" class="form-control valid" rows="2" placeholder="Give a description for this day" maxlength="500">{{$dplandesc[$i]}}</textarea>
                                                                                                                            <div class="float-right"><span id="days_description_left{{$i}}" class="word-counter ">500 Characters Left</span> </div>
                                                                                                                        </div>
                                                                                                                        <script type="text/javascript">
                                                                                                                            $('#days_description_left{{$i}}').text(500-parseInt($("#days_description{{$i}}").val().length)); 
                                                                                                                        </script>
                                                                                                                    </div>
                                                                                                                    <div class="col-lg-12">
                                                                                                                        <div class="border-bottom-grey mb-15"></div>
                                                                                                                    </div>
                                                                                                                </div>
                                                                                                            </div>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                @endforeach
                                                                                            @else
                                                                                                <div class="add_another_day">
                                                                                                <div class="row y-middle"> 
                                                                                                        <div class="col-lg-2 col-md-4 col-6">
                                                                                                            <label class="select-dropoff">Day - 1</label>
                                                                                                        </div>
                                                                                                    </div>

                                                                                                    <div class="row">
                                                                                                        <div class="col-md-12 col-sm-12">
                                                                                                            <div class="row">
                                                                                                                <div class="col-lg-4 col-md-4 col-sm-3">
                                                                                                                    <div class="photo-upload">
                                                                                                                        <label for="dayplanpic0" id="label">
                                                                                                                            <img src="{{url('/public/images/Upload-Icon.png')}}" class="pro_card_img blah planblah0" id="showimg" loading="lazy">
                                                                                                                            <span id="span_0">Upload your file here</span>
                                                                                                                            <input type="file" name="dayplanpic_0" id="dayplanpic0" class="uploadFile img" value="Upload Photo" onchange="planImg(this,0);">
                                                                                                                        </label>
                                                                                                                        <span class="error" id="err_oldservicepic20"></span>
                                                                                                                        <input type="hidden" id="olddayplanpic20" name="olddayplanpic_0" value="">
                                                                                                                    </div>
                                                                                                                </div>
                                                                                                                <div class="col-lg-8 col-md-8 col-sm-9">
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

                                                                            <div class="row mb-15">   
                                                                                <div class="col-md-12 col-mg-6">
                                                                                    <div class="return-info">
                                                                                        <h3>Departure & Return Info & Describe the Location</h3>
                                                                                        <p>Provide details on when and where to meet & how to find you</p>
                                                                                        <!-- <p>Tell customers how and when you will depart and return, how to meet up, where to meet up, meeting point name and how to find you once the customer arrives. Don’t leave it up to customers to figure out how to meet up with you. Let them know before hand.</p> -->
                                                                                        
                                                                                        <!-- <textarea class="form-control valid" rows="6" name="descLocation" id="descLocation" 
                                                                                        placeholder="(Ex. Please arrive at the location of our business.The address reminder is ABC Anytown town, 12345 USA.) Or; We will pick you up at your hotel. Or; Please talk with your front desk staff about the meeting point, Or; Please meet us at Central Park at the entrance of 81st and Central Park West (CPW). Wait at the seating area if you arrive early. The instructor will have on a red hat and yellow vest. Please arrive 10 minutes before your activity starts.)" 
                                                                                        maxlength="500">{{@$service->desc_location}}</textarea> -->
                                                                                        <textarea class="form-control valid" rows="6" name="descLocation" id="descLocation" 
                                                                                        placeholder="(Ex: Meet at Central Park, 81st & Central Park West entrance. Arrive 10 minutes early. Look for the host in a red hat and shirt.)" 
                                                                                        maxlength="500">{{@$service_data->desc_location}}</textarea>
                                                                                        <div class="float-right"><span id="descLocationLeft">500</span> Character Left</div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>

                                                                            <div class="row mb-15 @if($serviceType != 'experience') d-none @endif">   
                                                                                <div class="col-md-12 col-lg-12">                  
                                                                                    <div class="companydetails">
                                                                                        <h3>Where should customers meet you?</h3>
                                                                                        <p>Set meet-up spot here (map included in confirmation email).</p>
                                                                                    </div>
                                                                                    <div class="row">
                                                                                        <div class="col-lg-6 col-md-6">
                                                                                            <div class="companydetails-info">
                                                                                                <label>Street address </label>
                                                                                                <input type="text" name="address" id="address" class="form-control pac-target-input" 
                                                                                                value="{{@$service_data->exp_address}}" placeholder="Enter a location" autocomplete="off" oninput="initMapCall('address', 'city', 'state', 'country', 'zip', 'lat', 'lng')">
                                                                                            </div>
                                                                                        </div>
                                                                                        <input type="hidden" id="address_p" @if($service_data) value="{{$service_data->fullAdressForMap()}}"  @endif>
                                                                                        <input type="hidden" name="lat" id="lat" value="{{@$service_data->exp_lat}}">
                                                                                        <input type="hidden" name="lng" id="lng" value="{{@$service_data->exp_lng}}">
                                                                                        <div id="map" style="display: none;"></div>
                                                                                        <div class="col-lg-6 col-md-6">
                                                                                            <div class="companydetails-info">
                                                                                                <label>Country / Region </label>
                                                                                                <input name="country" id="country" value="{{@$service_data->exp_country}}" type="text" class="form-control">
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="row">
                                                                                        <div class="col-lg-6 col-md-6">
                                                                                            <div class="companydetails-info">
                                                                                                <label>Bldg (optional)</label>
                                                                                                <input name="addiAddress" id="addiAddress" value="{{@$service_data->exp_building}}"  type="text" class="form-control" value=""> 
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="col-lg-6 col-md-6">
                                                                                            <div class="companydetails-info">
                                                                                                <label> City </label>
                                                                                                <input value="{{@$service_data->exp_city}}" name="city" id="city" class="form-control" type="text">
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="col-lg-6 col-md-6">
                                                                                            <div class="companydetails-info">
                                                                                                <label>State  </label>
                                                                                                <input type="text" name="state" id="state" class="form-control" value="{{@$service_data->exp_state}}">
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="col-lg-6 col-md-6">
                                                                                            <div class="companydetails-info">
                                                                                                <label> ZIP code</label>
                                                                                                <input value="{{@$service_data->exp_zip}}" name="zip" id="zip" class="form-control" type="text" >
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="fonts-red" id="mapError"></div>
                                                                                        <div class="col-md-12 col-lg-12">
                                                                                            <div class="select-dropoff mt-15">
                                                                                                <button class="btn btn-red" type="button" onclick="loadMaponclick();">Update Map</button>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                    
                                                                                    <div class="row">
                                                                                        <div class="col-md-12 col-lg-12">
                                                                                            <div class="pin-on-map">
                                                                                                <!-- <h3>Adjust the pin on the map</h3> -->
                                                                                                <h3>Adjust the map pin if needed.</h3>
                                                                                                <p>You can drag the map so the pin is in the right location.</p>
                                                                                                <!-- <div class="mysrchmap_cus" style="height: 100%;min-height: 300px;">
                                                                                                    <div id="map_canvas_cus">
                                                                                                        <div class="maparea">
                                                                                                            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d24176.251535935986!2d-73.96828678121815!3d40.76133318281456!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x89c258c4d85a0d8d%3A0x11f877ff0b8ffe27!2sRoosevelt%20Island!5e0!3m2!1sen!2sin!4v1620041765199!5m2!1sen!2sin" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                </div> -->

                                                                                                <div class="widget" style="height:300px">
                                                                                                    <div class="mysrchmap">
                                                                                                        <div id="map_canvas" style="position: absolute; top: 0; right: 0; bottom: 0; left: 0;"></div>
                                                                                                    </div>
                                                                                                    <div class="maparea"></div>
                                                                                                </div>

                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>

                                                                            <div class="dropdown-divider mt-20 mb-20 @if($serviceType != 'experience') d-none @endif"></div>

                                                                            <div class="row mb-15 @if($serviceType != 'experience') d-none @endif">
                                                                                <div class="col-md-12 col-lg-12">
                                                                                    <div class="customers-help">
                                                                                        <h3>Confirm your phone number for customer support.</h3>
                                                                                        <p>If customers need help or can't find your location, they can call +1 (212) 213-2132.</p>
                                                                                        {{-- <p>If customers have trouble finding your location, or need questions with help, they may need to call you. The number on file we'll give them is +1 {{Auth::user()->current_company->business_phone}}. </p> --}}
                                                                                        {{-- <h3>Any additinal information for help</h3>
                                                                                        <textarea name="addiInfoHelp" id="addiInfoHelp" class="form-control valid" rows="3" 
                                                                                        maxlength="500" >{{@$service_data->addi_info_help}}</textarea>
                                                                                        <span id="addiInfoHelpLeft">500 Characters Left</span> --}}
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-md-12 col-lg-12 p-3">
                                                                                    <div class="return-info">
                                                                                        <h3>Any additinal information for help</h3>
                                                                                        <textarea name="addiInfoHelp" id="addiInfoHelp" class="form-control valid" rows="3" 
                                                                                        maxlength="500" >{{@$service_data->addi_info_help}}</textarea>
                                                                                        <span id="addiInfoHelpLeft">500 Characters Left</span>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            
                                                                            <div class="row mb-15">
                                                                                <div class="col-md-12 col-lg-12">
                                                                                    <div class="customers-help">
                                                                                        <h3>Require Verifications</h3>
                                                                                        {{-- <p>The primary booker has to successfully complete verified ID in order for them and their guests to attend your experience.</p> --}}
                                                                                        <p>Require the booker to show ID upon arrival & state medical issues. (Please add this as part of the booking confirmation email if selected)</p>
                                                                                        <input id="idProof" name="idProof" {{@$proofVerification}} value="1" type="checkbox">
                                                                                        {{-- <label for="idProof">Require the booker to have ID upon arrival for verificaiton of age and identity</label><br> --}}
                                                                                        <label for="idProof">Require a form of verification upon arrival</label><br>
                                                                                    
                                                                                        <input type="checkbox" id="idVaccine" {{@$vaccinefVerification}} name="idVaccine" value="1">

                                                                                        <!-- <label for="idVaccine">Require the booker to have proof of Vacination. </label><br> -->
                                                                                        {{-- <label for="idVaccine">Require customers to show one of these options to participate.</label><br> --}}
                                                                                        <label for="idVaccine">Require guest to explain medical issues or injuries </label><br>

                                                                                        <!-- <input type="checkbox" id="idCovid"  {{@$covidVerification}} name="idCovid" value="1"> -->
                                                                                        <!-- <label for="idCovid">Require the booker to have proof of a negative Covid-19 test. </label><br>  -->
                                                                                    </div>
                                                                                </div>
                                                                            </div>

                                                                            <div class="row">
                                                                                <div class="col-md-12 col-12">
                                                                                    <button type="submit" class="btn-red-primary btn-red float-right mt-15" id="nextindividual5">Save</button>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                        </form>
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

                <div class="row">
                    <div class="col-xl-7 col-lg-8 col-md-12 col-12">
                        <div class="card">
                            <div class="card-header align-items-center d-flex">
                                <h4 class="card-title mb-0 flex-grow-1 nesting-steps-title">Step 4: FAQ Details</h4>
                            </div>
                            
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-lg-12">
                                     

                                        <form action="{{route('business.services.updateService')}}" method="POST" enctype="multipart/form-data" >
                                            @csrf
                                            <div id="messageDiv" style="display:none;" class="alert"></div>
                                            <input type="hidden" name="step" id="step4" value="4">
                                            <input type="hidden" name="serviceId" id="serviceId" value="{{$serviceId}}">
                                            <input type="hidden" name="serviceType" id="serviceType" value="{{$serviceType}}">
                                            <div class="live-preview" id="faqMainDiv">
                                                @if(!empty($faqData) && count($faqData) > 0)
                                                    <input type="hidden"  name="faqCount" id="faqCount" value="{{count($faqData) - 1}}" />
                                                    @foreach($faqData as $i=>$faq)
                                                        <div class="accordion  accordion-border-box mt-3" id="faq{{$i}}">
                                                            <div class="accordion-item shadow">
                                                                <h2 class="accordion-header" id="accordionnestingfaq{{$i}}">
                                                                    <button class="accordion-custom-btn accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#accor_nestingfaq{{$i}}" aria-expanded="false" aria-controls="accor_nestingfaq{{$i}}">
                                                                        <div class="container-fluid nopadding">
                                                                            <div class="row ">
                                                                                <div class="col-lg-6 col-md-6 col-8 faqTitle{{$i}}">
                                                                                    FAQ {{@$faq->faq_title != '' ? " : ".@$faq->faq_title :'' }}
                                                                                </div>
                                                                                <div class="col-lg-6 col-md-6 col-4">
                                                                                    <div class="multiple-options">
                                                                                        @if($i!=0)
                                                                                        <div class="setting-icon">
                                                                                            <i class="ri-more-fill"></i>
                                                                                            <ul id="faqUl{{$i}}">
                                                                                                    <li>
                                                                                                        <a href="javascript:void(0);" onclick="removeFaqDiv('{{ $faq->id }}', '{{ $i }}', '{{ $companyId }}');">
                                                                                                            <i class="ri-delete-bin-fill align-bottom me-2 text-muted"></i>Delete
                                                                                                        </a>
                                                                                                    </li>
                                                                                                </ul>
                                                                                            </div>
                                                                                            @endif    
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </button>
                                                                </h2>
                                                                <div id="accor_nestingfaq{{$i}}" class="accordion-collapse collapse" aria-labelledby="accordionnestingfaq{{$i}}" data-bs-parent="#faq{{$i}}">
                                                                    <div class="accordion-body">
                                                                        <div class="row">
                                                                            <div class="col-lg-12 col-md-6">
                                                                                <div class="mb-0">
                                                                                    <input type="hidden" name="faq_id_db[]" id="faq_id_db" value="{{$faq->id}}">
                                                                                    <label>Faq Title</label>
                                                                                    <input name="faq_title[]" id="faq_title" value="{{$faq->faq_title}}" class="form-control"  type="text" placeholder="" oninput="changeFaqTittle('{{$i}}',this.value);" > 
                                                                                </div>
                                                                            </div>

                                                                            <div class="col-lg-12 col-md-6">
                                                                                <div class="mb-0 mt-10">
                                                                                    <label>Faq Answer</label>
                                                                                    <textarea name="faq_answer[]" id="faq_answer" class="form-control" rows="4">{{$faq->faq_answer}}</textarea>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                @else
                                                    <input type="hidden"  name="faqCount" id="faqCount" value="0" />
                                                    <div class="accordion accordion-border-box mt-3" id="faq0">
                                                        <div class="accordion-item shadow">
                                                            <h2 class="accordion-header" id="accordionnestingfaq0">
                                                                <button class="accordion-custom-btn accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#accor_nestingfaq0" aria-expanded="false" aria-controls="accor_nestingfaq0">
                                                                    <div class="container-fluid nopadding">
                                                                        <div class="row ">
                                                                            <div class="col-md-6 faqTitle0">
                                                                                FAQ
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </button>
                                                            </h2>
                                                            <div id="accor_nestingfaq0" class="accordion-collapse collapse" aria-labelledby="accordionnestingfaq0" data-bs-parent="#faq0">
                                                                <div class="accordion-body">
                                                                    <div class="row">
                                                                        <div class="col-lg-12 col-md-6">
                                                                            <div class="mb-0">
                                                                                <input type="hidden" name="faq_id_db[]" id="faq_id_db" value="">
                                                                                <label>Faq Title</label>
                                                                                <input name="faq_title[]" id="faq_title" class="form-control"  type="text" placeholder=""  oninput="changeFaqTittle(0,this.value);" >
                                                                            </div>
                                                                        </div>

                                                                        <div class="col-lg-12 col-md-6">
                                                                            <div class="mb-0 mt-10">
                                                                                <label>Faq Answer</label>
                                                                                <textarea name="faq_answer[]" id="faq_answer" class="form-control" rows="4"></textarea>
                                                                            </div>
                                                                        </div>
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
                                                        <a class="add-category-btn" onclick="addFaq()">Add Another Faq</a>
                                                        <p>This is a new faq section</p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12 col-12">
                                                    <button type="submit" class="btn-red-primary btn-red float-right mt-15" id="priceForm2" @if($serviceId == 0) disabled @endif >Save </button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-xl-7 col-lg-8 col-md-12 col-12">
                        <div class="card">
                            <div class="card-header align-items-center d-flex">
                                <h4 class="card-title mb-0 flex-grow-1 nesting-steps-title">Step 5: Create Category, Set Prices &amp; Duration</h4>
                            </div>
                            <div class="p-3 bg-light rounded">
                                <div class="row g-2">
                                    <div class="col-lg-auto">
                                        <select class="form-select" data-choices="" data-choices-search-false="" name="choices-select-status" id="categoryList" onchange="serchCategory(this.value,'category');">
                                            <option value="">Search by Category Name</option>
                                            @if(!empty($categoryData))
                                            @foreach($categoryData as $i=>$category)
                                                <option value="{{$i}}">{{$category->category_title}}</option>
                                            @endforeach
                                             @endif
                                        </select>
                                    </div>
                                    <div class="col-lg-auto">
                                        <select class="form-select" data-choices data-choices-search-false name="choices-select-status" id="priceList" onchange="serchCategory(this.value,'price');">
                                            <option value="">Search by Price Option</option>
                                            @if(!empty($categoryData))
                                            @foreach($categoryData as $i=>$category)
                                                @foreach($category->BusinessPriceDetails as $j=>$priceDetail)
                                                    <option value="{{$i}}">{{$priceDetail->price_title}}</option>
                                                @endforeach
                                            @endforeach
                                            @endif
                                        </select>
                                        <!-- <div class="search-box search-width">
                                            <input type="text" id="searchTaskList" class="form-control search" placeholder="Search by Price Option">
                                            <i class="ri-search-line search-icon"></i>
                                        </div> -->
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <form action="{{route('business.services.updateService')}}" method="POST" enctype="multipart/form-data" >
                                            @csrf
                                            <input type="hidden" name="step" id="step5" value="5">
                                            <input type="hidden" name="submitType" id="submitType" value="">
                                            <input type="hidden" name="displayRecPrice" id="displayRecPrice" value="">
                                            <input type="hidden" name="displayRecCategory" id="displayRecCategory" value="">
                                            <input type="hidden" name="displayType" id="displayType" value="">
                                            <input type="hidden" name="serviceId" id="serviceId" value="{{$serviceId}}">
                                            <input type="hidden" name="serviceType" id="serviceType" value="{{$serviceType}}">
                                            <div class="live-preview" id="categoryMainDiv">
                                                @if(!empty($categoryData) && count($categoryData) > 0)
                                                    <input type="hidden"  name="categoryCount" id="categoryCount" value="{{count($categoryData) - 1}}" />
                                                    @foreach($categoryData as $i=>$category)
                                                        <div class="accordion  accordion-border-box mt-3" id="category{{$i}}">
                                                            <div class="accordion-item shadow">
                                                                <h2 class="accordion-header" id="accordionnestingcat{{$i}}">
                                                                    <button class="accordion-custom-btn accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#accor_nestingcategory{{$i}}" aria-expanded="false" aria-controls="accor_nestingcategory{{$i}}">
                                                                        <div class="container-fluid nopadding">
                                                                            <div class="row ">
                                                                                <div class="col-lg-6 col-md-6 col-8 categoryTitle{{$i}}">
                                                                                    Category {{@$category->category_title != '' ? " : ".@$category->category_title :'' }}
                                                                                </div>
                                                                                <div class="col-lg-6 col-md-6 col-4">
                                                                                    <div class="multiple-options">
                                                                                        <div class="setting-icon">
                                                                                            <i class="ri-more-fill"></i>
                                                                                            <ul id="catUl{{$i}}">
                                                                                                <li class="non-collapsing" data-bs-toggle="collapse" data-bs-target><a onclick=" return add_another_price_duplicate_category({{$i}});" ><i class="fas fa-plus text-muted"></i>Duplicate Entire Category</a></li>
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
                                                                <div id="accor_nestingcategory{{$i}}" class="accordion-collapse @if($displayRecCategory == $category->id) show @else collapse @endif" aria-labelledby="accordionnestingcat{{$i}}" data-bs-parent="#category{{$i}}">
                                                                    <div class="accordion-body">
                                                                        <div class="row">
                                                                            <div class="col-md-12">
                                                                                <div class="flex-shrink-0 float-right">
                                                                                    <div class="form-check form-switch form-switch-right form-switch-md">
                                                                                        <label for="default-base-showcode" class="form-label text-muted visibilitytext{{$i}}">@if(@$category->visibility_to_public) Show To Public @else Hide From Public @endif </label>
                                                                                        <input class="custom-switch form-check-input visibility{{$i}}" type="checkbox" name="visibility_to_public[]" value="V{{$i}}" @if(@$category->visibility_to_public) checked @endif >
                                                                                    </div>
                                                                                    <script>
                                                                                        $(".visibility{{$i}}").change(function() {
                                                                                            if(this.checked) {
                                                                                                $('.visibilitytext{{$i}}').html("Show Online");
                                                                                            }else{
                                                                                                $('.visibilitytext{{$i}}').html("Hide Online");
                                                                                            }
                                                                                        });
                                                                                    </script>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-lg-5 col-md-6 col-12">
                                                                                <div class="set-price mb-0">
                                                                                    <input type="hidden" name="cat_id_db[]" id="cat_id_db" value="{{$category->id}}">
                                                                                    <label>Category Name</label>
                                                                                    <input name="category_title[]" id="category_title" value="{{$category->category_title}}" class="form-control"  type="text" placeholder="Ex: Kids Martial Arts (5 to 7 yrs Old)" oninput="changeCategoryTittle({{$i}},this.value);" > 
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        @php $priceData = @$category->BusinessPriceDetails;
                                                                        @endphp
                                                                        <input type="hidden" name="priceCount{{$i}}" id="priceCount{{$i}}" value="{{count($priceData)-1}}" />
                                                                        
                                                                        <div id="priceOptionDiv{{$i}}">
                                                                            @foreach($priceData as $j => $price)
                                                                            @include('business.services._price_option',['price'=> $price, 'i'=>$i,'j'=>$j])                                                                                    
                                                                            @endforeach
                                                                        </div>
                                                                        
                                                                        <div class="col-md-12">
                                                                            <div class="addanother">
                                                                                <a class="" onclick=" return add_another_price_ages({{$i}});"> +Add Another Price Option</a>
                                                                            </div>  
                                                                        </div>

                                                                        @php 
                                                                            $addOnServiceData = @$category->AddOnService;
                                                                            if(!empty($addOnServiceData) && count($addOnServiceData)>0 ){
                                                                                $addOnCount = count($addOnServiceData)-1;
                                                                            }else{
                                                                                $addOnCount = 0;
                                                                            }
                                                                        @endphp

                                                                    
                                                                        <input type="hidden"  name="addOnServiceCount{{$i}}" id="addOnServiceCount{{$i}}" value="{{$addOnCount}}" />
                                                                        <div id="addOnServiceDiv{{$i}}">
                                                                            @if(!empty($addOnServiceData) && count($addOnServiceData)>0 )
                                                                                @foreach($addOnServiceData as $j=>$ad_service)
                                                                                    @include('business.services._add_on_another_service',['addOnService'=> $ad_service, 'i'=>$i,'j'=>$j])
                                                                                @endforeach
                                                                            @else
                                                                                @include('business.services._add_on_another_service',[ 'i'=>$i,'j'=>0])
                                                                            @endif
                                                                        </div>

                                                                        <div class="col-md-12">
                                                                            <div class="addanother">
                                                                                <a class="" onclick=" return add_another_add_on_service({{$i}});"> +Add Another Add On Service</a>
                                                                            </div>  
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                @else
                                                    <input type="hidden"  name="categoryCount" id="categoryCount" value="0" />
                                                    <div class="accordion  accordion-border-box mt-3" id="category0">
                                                        <div class="accordion-item shadow">
                                                            <h2 class="accordion-header" id="accordionnestingcat0">
                                                                <button class="accordion-custom-btn accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#accor_nestingcategory0" aria-expanded="false" aria-controls="accor_nestingcategory0">
                                                                    <div class="container-fluid nopadding">
                                                                        <div class="row ">
                                                                            <div class="col-md-6 categoryTitle0">
                                                                                Category
                                                                            </div>
                                                                            <div class="col-md-6">
                                                                                <div class="multiple-options">
                                                                                    <div class="setting-icon">
                                                                                        <i class="ri-more-fill"></i>
                                                                                        <ul id="catUl0">
                                                                                            <!-- <li><a href="" data-bs-toggle="modal" data-bs-target=".tax0">
                                                                                                <i class="fas fa-plus text-muted"></i>Taxes</a></li> -->
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
                                                                                    <input class="custom-switch form-check-input visibility0" type="checkbox" name="visibility_to_public[]" value="V0" checked>
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
                                                                                <input name="category_title[]" id="category_title" class="form-control"  type="text" placeholder="Ex: Kids Martial Arts (5 to 7 yrs Old)"  oninput="changeCategoryTittle(0,this.value);" >
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

                                                                    <input type="hidden"  name="addOnServiceCount0" id="addOnServiceCount0" value="0" />
                                                                    <div id="addOnServiceDiv0">
                                                                        @include('business.services._add_on_another_service',['i'=>0,'j'=>0])
                                                                    </div>

                                                                    <div class="col-md-12">
                                                                        <div class="addanother">
                                                                            <a class="" onclick=" return add_another_add_on_service(0);"> +Add Another Add On Service</a>
                                                                        </div>  
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
                                                    <button type="submit" class="btn-red-primary btn-red float-right mt-15" id="priceForm" @if($serviceId == 0) disabled @endif >Save </button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xl-7 col-lg-8 col-md-12 col-12">
                        <div class="card">
                            <div class="card-header align-items-center d-flex">
                                <h4 class="card-title mb-0 flex-grow-1 nesting-steps-title">Step 6: Schedule  Classes</h4>
                            </div><!-- end card header -->
    
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="live-preview">
                                            <div class="accordion" id="stepFour">
                                                <div class="accordion-item shadow">
                                                    <h2 class="accordion-header" id="stepheadingFour">
                                                        <button class="accordion-custom-btn accordion-button collapsed collapseFourbtn" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                                                        Set Schedule for {{@$service_data->program_name}}
                                                        </button>
                                                    </h2>
                                                    <div id="collapseFour" class="accordion-collapse collapse" aria-labelledby="stepheadingFour" data-bs-parent="#stepFour">
                                                        <div class="accordion-body">
                                                            <div class="row">
                                                                <div class="col-lg-12 col-md-12">
                                                                    <div class="card-header p-0">
                                                                        <div class="row y-middle">  
                                                                            <div class="col-lg-6 col-md-6 col-5">
                                                                                <label class="fs-17"> {{ $serviceType == 'classes' ? 'Classes' : ($serviceType == 'experience' ? 'Adventures & Tours' : ( $serviceType == 'individual' ? 'Personal Training' :'Event')) }} </label>
                                                                            </div>
    
                                                                            @if(@$service_data)
                                                                                <div class="col-lg-6 col-md-6 col-7">
                                                                                    <button type="button" class="btn-red-primary btn-red float-right mb-15" id="" data-bs-toggle="modal" data-bs-target=".scheduleclass-modal">Create {{ ($serviceType == 'experience') ? 'Adventures & Tours' : ( $serviceType == 'individual' ? 'Personal Training' : ucfirst($serviceType))  }} Name </button>
                                                                                </div>
                                                                            @endif
                                                                        </div>
                                                                    </div>
                                                                    
                                                                    @forelse($classes as $i=> $class)
                                                                        @php
                                                                            $customListIds  = $class->businessClassPriceDetails()->pluck('price_id')->toArray();
                                                                            $oldPriceId = implode(',', $customListIds);
                                                                        @endphp
                                                                    <div class="classes-list">
                                                                        <div class="row">
                                                                            <div class="col-lg-6 col-md-4 col-sm-6 col-6">
                                                                                <div class="fs-14">
                                                                                    <span>{{$class->category_title}}</span>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="row">
                                                                            <div class="col-lg-12 col-md-8 col-sm-6 col-6">
                                                                                <div class="fs-14 links-set setoflinkes">
                                                                                    <!-- <a href="{{route('business.schedulers.create', ['business_id'=>$class->cid,'categoryId'=>$class->id]) }}">@if($class->BusinessActivityScheduler()->count() > 0 )  <a onclick="openScheduleModel('{{$class->id}}')" >{{$class->BusinessActivityScheduler()->count()}} Scheduled </a> @else  Not Scheduled @endif  </a> -->
                                                                                    <span>@if($class->BusinessActivityScheduler()->count() > 0 && $class->BusinessPriceDetails()->count() > 0 || $class->BusinessClassNPriceDetails()->count() > 0 ) 
                                                                                        <a onclick="openScheduleModel('{{$class->id}}')" >{{$class->BusinessActivityScheduler()->count()}} Scheduled </a> @else  Not Scheduled @endif</span>
                                                                                    <label class="mr-5 ml-5"> | </label>
                                                                                    <!-- <a href="{{route('business.schedulers.create', ['business_id'=>$class->cid,'categoryId'=>$class->id]) }}">+ Schedule </a> -->
    
                                                                                    <a onClick="openaddschedule('{{$i}}' , {{$class->id}})">+ Schedule </a>
                                                                                    <label class="mr-5 ml-5"> | </label>
                                                                                    <div class="userblock0">
                                                                                        <div class="login_links" onclick="openNavv('{{$class->id}}')">
                                                                                            <a href="javascript:void(0)" >+ Attach Prices </a>
                                                                                        </div>
                                                                                        <nav class="serviceclass">
                                                                                            <div class="navbar-wrapper">
                                                                                                <div id="Sidepanelone{{$class->id}}" class="service-sidepanel">
                                                                                                    <div class="navbar-content-side sc ">
                                                                                                        <div class="side-cross">
                                                                                                            <div class="row">
                                                                                                                <div class="col-lg-10 col-md-10 col-10">
                                                                                                                    <label>Choose the price options your clients can choose to book with this classes</label>
                                                                                                                </div>
                                                                                                                <div class="col-lg-2 col-md-2 col-2">
                                                                                                                    <a href="javascript:void(0)" class="cancel fa fa-times " onclick="closeNavv('{{$class->id}}')"></a>
                                                                                                                </div>
                                                                                                            </div>
                                                                                                        </div>
                                                                                                        <form action="{{route('business.class.storeClassPriceOptionupdate')}}" method="post" id="myForm">
                                                                                                            @csrf
                                                                                                            <input type="hidden" name="priceId{{$class->id}}" value="{{$oldPriceId}}"> 
                                                                                                            <input type="hidden" name="classId" value="{{$class->id}}">
                                                                                                            <input type="hidden" name="serviceid" value="{{$class->serviceid}}">
    
                                                                                                            <input type="hidden" name="serviceType" value="{{$service_data->service_type}}">
                                                                                                            <ul class="schedule-class-navbar">
                                                                                                                <li class="pc-caption mb-10">
                                                                                                                    <input type="checkbox" id="all" name="all" value="1" class="select-all" data-classId="{{$class->id}}">
                                                                                                                    <label for="all">  Select All</label>
                                                                                                                </li>
                                                                                                            </ul>
                                                                                                            @foreach($categoryData as $category)
                                                                                                            <div class="side-dropdown">
                                                                                                                <div class="form">
                                                                                                                    <input class="mr-5 checkbox-item select-category" type="checkbox" id="category" name="category[]" value="1" data-catid="{{$category->id}}" data-classId="{{$class->id}}">
                                                                                                                    <label for="cat" class="drop-header">{{$category->category_title}}  </label>
                                                                                                                    <button class="button-1" data-catid="{{$category->id}}"> <i class="fas fa-chevron-down fa-sm "></i></button>
                                                                                                                </div>
                                                                                                                <ul class="dropdownList{{$category->id}}">
                                                                                                                    @foreach($category->BusinessPriceDetails as $priceOp)
                                                                                                                        @php
                                                                                                                            $isChecked = in_array($priceOp->id, $customListIds);
                                                                                                                        @endphp
                                                                                                                        <li>
                                                                                                                            <input type="checkbox" id="price1" name="price[]" value="1" class="checkbox-item checkbox-price{{$category->id}} checkbox-price" data-priceid="{{$priceOp->id}}" data-classId="{{$class->id}}" @if($isChecked) checked @endif >
                                                                                                                            <label for="price1">{{$priceOp->price_title}}</label>
                                                                                                                        </li>
                                                                                                                    @endforeach
                                                                                                                </ul>
                                                                                                            </div>
                                                                                                            @endforeach
                                                                                                            <ul class="schedule-class-navbar">      
                                                                                                                <li class="pc-caption">
                                                                                                                    <div class="">
                                                                                                                        <div class="sche-submit">
                                                                                                                            <button type="submit" class="btn-red select-event"> Submit </button>
                                                                                                                        </div>
                                                                                                                    </div>         
                                                                                                                </li>                                
                                                                                                            </ul>
                                                                                                        </form>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                        </nav>
                                                                                    </div>
                                                                                    <label class="mr-5 ml-5"> | </label>
                                                                                    <div class="setting-icon schedule-adventures-icon">
                                                                                        <i class="ri-more-fill"></i>
                                                                                        <ul id="catUl0">
                                                                                            <li class="non-collapsing" data-bs-toggle="collapse" data-bs-target=""><a onclick="editClass('{{$class->id}}')"><i class="fas fa-plus text-muted"></i>Edit</a></li>
                                                                                            <li class="non-collapsing" data-bs-toggle="collapse" data-bs-target=""><a onclick="deleteClass('{{$class->id}}')"><i class="fas fa-plus text-muted"></i>Delete</a></li>
                                                                                        </ul>
                                                                                    </div>
                                                                                </div>
    
                                                                                
                                                                                <div class="navBarSection{{$i}}"></div>
                                                                                
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    @empty
                                                                        <div class="row">
                                                                            <div class="col-lg-12 col-12">
                                                                                <p class="mt-10">Click Create {{ ($serviceType == 'experience') ? 'Adventures & Tours' : ( $serviceType == 'individual' ? 'Personal Training' : ucfirst($serviceType))  }} Name to set up your classes.</p>
                                                                            </div>
                                                                        </div>
                                                                    @endforelse
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
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>
</div>
</div>
</div>
<!-- /#wrapper -->


@if(isset($service_data))
    <div class="modal fade scheduleclass-modal" tabindex="-1" aria-labelledby="mySmallModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="myModalLabel"> {{@$service->program_name}}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{route('business.class.store')}}" method="post">
                        @csrf
                        <input type="hidden" name="cid" value="{{$companyId}}">
                        <input type="hidden" name="serviceid" value="{{$serviceId}}">
                        <input type="hidden" name="serviceType" value="{{$service_data->service_type}}">
                        <div class="mb-3">
                            <label>Activity Name</label>
                            <input type="text" class="form-control" id="category_title" name="category_title" required="">
                            @error('category_title')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <!-- <div class="mb-3">
                            <label>Class Description</label>
                            <textarea name="desc" id="desc" style="display: none;"></textarea>
                        </div> -->
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary btn-red">Save</button>
                </div>
                </form>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div>


    <div class="modal fade editclass-modal" tabindex="-1" aria-labelledby="mySmallModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="myModalLabel"> {{@$service->program_name}}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body editclass-content">
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div>

    <div class="modal fade schedule-modal" tabindex="-1" aria-labelledby="mySmallModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-70">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="myModalLabel"> {{@$service->program_name}}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body schedule-content">
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div>

@endif

    @include('layouts.business.footer')
    @include('layouts.business.scripts')
    <script src="{{asset('/public/dashboard-design/ckeditor/ckeditor5.js')}}"></script>

<script>

    CKEDITOR.ClassicEditor.create(document.getElementById("editor"), {
        toolbar: {
            items: [
                'exportPDF','exportWord', '|',
                'findAndReplace', 'selectAll', '|',
                'heading', '|',
                'bold', 'italic', 'strikethrough', 'underline', 'code', 'subscript', 'superscript', 'removeFormat', '|',
                'bulletedList', 'numberedList', 'todoList', '|',
                'outdent', 'indent', '|',
                'undo', 'redo',
                '-',
                'fontSize', 'fontFamily', 'fontColor', 'fontBackgroundColor', 'highlight', '|',
                'alignment', '|',
                'link', 'insertImage', 'blockQuote', 'insertTable', 'mediaEmbed', 'codeBlock', 'htmlEmbed', '|',
                'specialCharacters', 'horizontalLine', 'pageBreak', '|',
                'textPartLanguage', '|',
                'sourceEditing'
            ],
            shouldNotGroupWhenFull: true
        },
        list: {
            properties: {
                styles: true,
                startIndex: true,
                reversed: true
            }
        },
        heading: {
            options: [
                { model: 'paragraph', title: 'Paragraph', class: 'ck-heading_paragraph' },
                { model: 'heading1', view: 'h1', title: 'Heading 1', class: 'ck-heading_heading1' },
                { model: 'heading2', view: 'h2', title: 'Heading 2', class: 'ck-heading_heading2' },
                { model: 'heading3', view: 'h3', title: 'Heading 3', class: 'ck-heading_heading3' },
                { model: 'heading4', view: 'h4', title: 'Heading 4', class: 'ck-heading_heading4' },
                { model: 'heading5', view: 'h5', title: 'Heading 5', class: 'ck-heading_heading5' },
                { model: 'heading6', view: 'h6', title: 'Heading 6', class: 'ck-heading_heading6' }
            ]
        },
        placeholder: '',
        fontFamily: {
            options: [
                'default',
                'Arial, Helvetica, sans-serif',
                'Courier New, Courier, monospace',
                'Georgia, serif',
                'Lucida Sans Unicode, Lucida Grande, sans-serif',
                'Tahoma, Geneva, sans-serif',
                'Times New Roman, Times, serif',
                'Trebuchet MS, Helvetica, sans-serif',
                'Verdana, Geneva, sans-serif'
            ],
            supportAllValues: true
        },
        fontSize: {
            options: [ 10, 12, 14, 'default', 18, 20, 22 ],
            supportAllValues: true
        },
        htmlSupport: {
            allow: [
                {
                    name: /.*/,
                    attributes: true,
                    classes: true,
                    styles: true
                }
            ]
        },
        htmlEmbed: {
            showPreviews: true
        },
        link: {
            decorators: {
                addTargetToExternalLinks: true,
                defaultProtocol: 'https://',
                toggleDownloadable: {
                    mode: 'manual',
                    label: 'Downloadable',
                    attributes: {
                        download: 'file'
                    }
                }
            }
        },
        mention: {
            feeds: [
                {
                    marker: '@',
                    feed: [
                        '@apple', '@bears', '@brownie', '@cake', '@cake', '@candy', '@canes', '@chocolate', '@cookie', '@cotton', '@cream',
                        '@cupcake', '@danish', '@donut', '@dragée', '@fruitcake', '@gingerbread', '@gummi', '@ice', '@jelly-o',
                        '@liquorice', '@macaroon', '@marzipan', '@oat', '@pie', '@plum', '@pudding', '@sesame', '@snaps', '@soufflé',
                        '@sugar', '@sweet', '@topping', '@wafer'
                    ],
                    minimumCharacters: 1
                }
            ]
        },
        removePlugins: [
            'CKBox',
            'CKFinder',
            'EasyImage',
            'RealTimeCollaborativeComments',
            'RealTimeCollaborativeTrackChanges',
            'RealTimeCollaborativeRevisionHistory',
            'PresenceList',
            'Comments',
            'TrackChanges',
            'TrackChangesData',
            'RevisionHistory',
            'Pagination',
            'WProofreader',
            'MathType'
        ]
    });
</script>
<script>
    CKEDITOR.ClassicEditor.create(document.getElementById("editor2"), {
        toolbar: {
            items: [
                'exportPDF','exportWord', '|',
                'findAndReplace', 'selectAll', '|',
                'heading', '|',
                'bold', 'italic', 'strikethrough', 'underline', 'code', 'subscript', 'superscript', 'removeFormat', '|',
                'bulletedList', 'numberedList', 'todoList', '|',
                'outdent', 'indent', '|',
                'undo', 'redo',
                '-',
                'fontSize', 'fontFamily', 'fontColor', 'fontBackgroundColor', 'highlight', '|',
                'alignment', '|',
                'link', 'insertImage', 'blockQuote', 'insertTable', 'mediaEmbed', 'codeBlock', 'htmlEmbed', '|',
                'specialCharacters', 'horizontalLine', 'pageBreak', '|',
                'textPartLanguage', '|',
                'sourceEditing'
            ],
            shouldNotGroupWhenFull: true
        },
        list: {
            properties: {
                styles: true,
                startIndex: true,
                reversed: true
            }
        },
        heading: {
            options: [
                { model: 'paragraph', title: 'Paragraph', class: 'ck-heading_paragraph' },
                { model: 'heading1', view: 'h1', title: 'Heading 1', class: 'ck-heading_heading1' },
                { model: 'heading2', view: 'h2', title: 'Heading 2', class: 'ck-heading_heading2' },
                { model: 'heading3', view: 'h3', title: 'Heading 3', class: 'ck-heading_heading3' },
                { model: 'heading4', view: 'h4', title: 'Heading 4', class: 'ck-heading_heading4' },
                { model: 'heading5', view: 'h5', title: 'Heading 5', class: 'ck-heading_heading5' },
                { model: 'heading6', view: 'h6', title: 'Heading 6', class: 'ck-heading_heading6' }
            ]
        },
        placeholder: '',
        fontFamily: {
            options: [
                'default',
                'Arial, Helvetica, sans-serif',
                'Courier New, Courier, monospace',
                'Georgia, serif',
                'Lucida Sans Unicode, Lucida Grande, sans-serif',
                'Tahoma, Geneva, sans-serif',
                'Times New Roman, Times, serif',
                'Trebuchet MS, Helvetica, sans-serif',
                'Verdana, Geneva, sans-serif'
            ],
            supportAllValues: true
        },
        fontSize: {
            options: [ 10, 12, 14, 'default', 18, 20, 22 ],
            supportAllValues: true
        },
        htmlSupport: {
            allow: [
                {
                    name: /.*/,
                    attributes: true,
                    classes: true,
                    styles: true
                }
            ]
        },
        htmlEmbed: {
            showPreviews: true
        },
        link: {
            decorators: {
                addTargetToExternalLinks: true,
                defaultProtocol: 'https://',
                toggleDownloadable: {
                    mode: 'manual',
                    label: 'Downloadable',
                    attributes: {
                        download: 'file'
                    }
                }
            }
        },
        mention: {
            feeds: [
                {
                    marker: '@',
                    feed: [
                        '@apple', '@bears', '@brownie', '@cake', '@cake', '@candy', '@canes', '@chocolate', '@cookie', '@cotton', '@cream',
                        '@cupcake', '@danish', '@donut', '@dragée', '@fruitcake', '@gingerbread', '@gummi', '@ice', '@jelly-o',
                        '@liquorice', '@macaroon', '@marzipan', '@oat', '@pie', '@plum', '@pudding', '@sesame', '@snaps', '@soufflé',
                        '@sugar', '@sweet', '@topping', '@wafer'
                    ],
                    minimumCharacters: 1
                }
            ]
        },
        removePlugins: [
            'CKBox',
            'CKFinder',
            'EasyImage',
            'RealTimeCollaborativeComments',
            'RealTimeCollaborativeTrackChanges',
            'RealTimeCollaborativeRevisionHistory',
            'PresenceList',
            'Comments',
            'TrackChanges',
            'TrackChangesData',
            'RevisionHistory',
            'Pagination',
            'WProofreader',
            'MathType'
        ]
    });
</script>

<script>
    function openNavv(id) {
        document.getElementById("Sidepanelone"+id).style.width = "350px";
    }

    function closeNavv(id) {
        document.getElementById("Sidepanelone"+id).style.width = "0";
    }
</script>

<script>
    $('#serviceForm').on('submit', function(event) {
        // alert('6');
    var imageCount = $('#gallery img').length;
    var coverCount = $('#gallery1 img').length;
    // alert(coverCount);
    // console.log(coverCount);
    if (coverCount < 1) {
        event.preventDefault();
        $('#coverImageError').text('Upload cover image.');
    } else {
        $('#coverImageError').text('');
    }

    if (imageCount < 4) {
        event.preventDefault();
        $('#imageError').text('You must upload more than 4 images.');
    } else {
        $('#imageError').text('');
    }
});

</script>

<script>
    CKEDITOR.replace('desc', {
        height: 200,
        extraPlugins: 'colorbutton,font,editorplaceholder,justify,widget'
    }); 

    $(document).ready(function(){ 
        if (window.location.hash === '#stepFour') {
            $('.collapseFourbtn').click();
        }

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

    function openScheduleModel(id){
        $.ajax({
            url: "{{route('business.service.get-schedule')}}",
            type: 'GET',
            data:{
                id:id,
            },
            success: function (response) {
                $('.schedule-content').html(response);
                $('.schedule-modal').modal('show');
            }
        });
    }

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
        $("#all"+i+j).prop("checked", false); 
        $("#adult"+i+j).prop("checked", false); 
        $("#child"+i+j).prop("checked", false); 
        $("#infant"+i+j).prop("checked", false); 
        $("#all"+i+j).prop("checked", false); 
       
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
            $('.displaysectiondiv'+i+j).removeClass('d-none');
        }else{
            $("#weekdayprice"+i+j).attr('checked','checked');
            $("#freeprice"+i+j).removeAttr('checked');
            $("#weekendprice"+i+j).removeAttr('checked');
            $('.Weekend'+i+j).addClass('d-none');
            $('.displaysectiondiv'+i+j).removeClass('d-none');  
        }

         $("#accor_nestingadult"+i+j).addClass('d-none'); 
        $("#accor_nestingchild"+i+j).addClass('d-none'); 
        $("#accor_nestinginfant"+i+j).addClass('d-none'); 
    }

    function changedesclenght(i){
        var desc = $('#days_description'+i).val();
        $('#days_description_left'+i).text(500-parseInt(desc.length));
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

    function serchCategory(value,type){
        if(type == 'category'){
            $('#priceList').val('');
        }else{
            $('#categoryList').val('');
        }
        var cnt = $('#categoryCount').val();
        for(var s=0; s<=cnt; s++)
        {
            $('#category'+s).css('display','block');
            if(s != value){
                $('#category'+s).css('display','none');
            }
        }
    }


    function SubmitForm(price,type,category){
        $('#submitType').val('recurring');
        $('#displayRecPrice').val(price);
        $('#displayRecCategory').val(category);
        $('#displayType').val(type);
        $('#priceForm').click();
    }
 

</script>


<script>
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
</script>

<script type="text/javascript">

    function openaddschedule(i,catId) {
        $.ajax({
            url: "{{route('business.service.get-schedule-data')}}",
            type: 'GET',
            data:{
                catId:catId,
                loop:i,
                returnUrl:'{{ url()->full() }}',
            },
            success: function (response) {
                $('.navBarSection'+i).html(response);

                if (window.innerWidth > 768) {
                    document.getElementById("schedule_section"+i).style.width = "650px";
                } else {
                    document.getElementById("schedule_section"+i).style.width = "95%"; 
                }
            }
        });
    }

    function closeaddschedule(i) {
        document.getElementById("schedule_section"+i).style.width = "0";
        $('.navBarSection'+i).html('');
    }

    $(document).ready(function(){ 
        var locations = $('#address_p').val();
        if (locations.length != 0) {
          loadMaponclick();
        }
        $('#mapError').hide();

        ClassicEditor.create(document.querySelector("#ckeditor-classic2")).then(function(e) {
				e.ui.view.editable.element.style.height = "200px"
			}).catch(function(e) {
				console.error(e)
			});
        });

    function loadMaponclick() {
    var locations = $('#address_p').val(); 
    var lat = parseFloat($('#lat').val());
    var lng = parseFloat($('#lng').val());
    $('#map_canvas').empty(); 
        var map1 = new google.maps.Map(document.getElementById('map_canvas'), {
            zoom: 18,
            center: new google.maps.LatLng(lat, lng),
            mapTypeId: google.maps.MapTypeId.ROADMAP,
        });

        var bounds = new google.maps.LatLngBounds();

        var icon1 = {
            url: "{{url('/public/images/hoverout2.png')}}",
            scaledSize: new google.maps.Size(50, 50),
            labelOrigin: new google.maps.Point(25, 16), 
        };

        const markerElement = document.createElement("div");
        markerElement.className = "custom-marker";
        markerElement.style.backgroundImage = `url(${icon1.url})`;
        markerElement.style.width = `${icon1.scaledSize.width}px`;
        markerElement.style.height = `${icon1.scaledSize.height}px`;
        markerElement.style.position = "relative";

        const labelElement = document.createElement("div");
        labelElement.textContent = "1"; 
        labelElement.style.color = "#222222";
        labelElement.style.fontSize = "12px";
        labelElement.style.fontWeight = "bold";
        labelElement.style.position = "absolute";
        labelElement.style.left = "50%";
        labelElement.style.top = "50%";
        labelElement.style.transform = "translate(-50%, -50%)";

        markerElement.appendChild(labelElement);

        const advancedMarker = new google.maps.marker.AdvancedMarkerElement({
            map: map1,
            position: new google.maps.LatLng(lat, lng),
            content: markerElement,
        });

        bounds.extend(advancedMarker.position);
   
        $('.mysrchmap').show();
   
}

</script>


<script type="text/javascript">
    $("body").on("click", ".add-another-day-schedule", function(){
        var cnt=$('#planday_count').val();
        cnt++;
        $('#planday_count').val(cnt);
        var service_price = ""; var daycnt='';
        daycnt = cnt+1;                          
        service_price += '<div class="add_another_day planday'+cnt+'" style="margin-top:20px; padding-top:10px;border-top:1px dotted #000;">'; 
        service_price += '<div class="row y-middle"> <div class="col-lg-2 col-md-4 col-6">  <label class="select-dropoff">Day - '+daycnt+'</label></div><div class="col-lg-5 col-md-8 col-6"> <i class="remove-day-schedule fas fa-trash i-remove-day mb-15" title="Remove Day"></i> </div></div>';

        var img = "{{url('/public/images/Upload-Icon.png')}}";
        service_price += '<div class="row"><div class="col-md-12 col-sm-12"><div class="row"><div class="col-lg-4 col-md-4 col-sm-3"><div class="photo-upload"><label for="dayplanpic'+cnt+'" id="label"><img src="'+img+'" class="pro_card_img blah planblah'+cnt+'" id="showimg"><span id="span_'+cnt+'">Upload your file here</span><input type="file" name="dayplanpic_'+cnt+'" id="dayplanpic'+cnt+'" class="uploadFile img" value="Upload Photo" onchange="planImg(this,'+cnt+');"></label><span class="error" id="err_oldservicepic2'+cnt+'"></span><input type="hidden" id="olddayplanpic2'+cnt+'" name="olddayplanpic_'+cnt+'" value=""></div></div><div class="col-lg-8 col-md-8 col-sm-9"><div><input type="text" class="form-control" name="days_title[]" id="days_title" placeholder="Give a heading for this day." title="servicetitle"></div><div class="description-txt"><textarea class="form-control valid" rows="2" name="days_description[]" id="days_description'+cnt+'" placeholder="Give a description for this day" maxlength="150" oninput="changedesclenght('+cnt+');"></textarea><div class="float-right"><span class="float-right" id="days_description_left'+cnt+'">500 Characters Left</span>500</span> Character Left</div></div></div></div></div></div>';
        service_price += '</div>';
        $(".add-another-day-schedule-block").append(service_price);
    });

    $("body").on("click", ".remove-day-schedule", function(){
        var cnt=$('#planday_count').val();
        cnt--;
        $(this).parent().parent().parent().remove();
       $('#planday_count').val(cnt);
    });
</script>

<script type="text/javascript">

    function changeFaqTittle(id, val){
        $('.faqTitle'+id).html('FAQ : '+val);
    }

    function addFaq(){
        var cnt = $('#faqCount').val();
        cnt++;
        $('#faqCount').val(cnt);
        data = '';
        data +='<div class="accordion accordion-border-box mt-3" id="faq'+cnt+'"> <div class="accordion-item shadow"> <h2 class="accordion-header" id="accordionnestingfaq'+cnt+'"> <button class="accordion-custom-btn accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#accor_nestingfaq'+cnt+'" aria-expanded="false" aria-controls="accor_nestingfaq'+cnt+'"> <div class="container-fluid nopadding"> <div class="row "> <div class="col-md-6 faqTitle'+cnt+'"> Faq </div> </div> </div> </button> </h2> <div id="accor_nestingfaq'+cnt+'" class="accordion-collapse collapse" aria-labelledby="accordionnestingfaq'+cnt+'" data-bs-parent="#faq'+cnt+'"> <div class="accordion-body"> <div class="row"> <div class="col-lg-12 col-md-6"> <div class="mb-0"> <input type="hidden" name="faq_id_db[]" id="faq_id_db" value=""> <label>Faq Title</label> <input name="faq_title[]" id="faq_title" class="form-control" type="text" placeholder="" oninput="changeFaqTittle('+cnt+',this.value);" > </div> </div> <div class="col-lg-12 col-md-6"> <div class="mb-0 mt-10"> <label>Faq Answer</label> <textarea name="faq_answer[]" id="faq_answer" class="form-control" rows="4"></textarea> </div> </div> </div> </div> </div> </div> </div>';
        $('#faqMainDiv').append(data);
    }  

    // function removeFaqDiv(i){
    //     var cnt = $('#faqCount').val();
    //     cnt--;
    //     $('#faqCount').val(cnt);
    //     $('#faq'+i).remove();
    // }  

    function removeFaqDiv(faqId, index,businessId) {
    if (confirm('Are you sure you want to delete this FAQ?')) {
        $.ajax({
            // url: `/faq/${faqId}`,
            url: `/business/${businessId}/faq/${faqId}`, // Constructed dynamic URL
            type: 'DELETE',
            data: {
                _token: $('meta[name="csrf-token"]').attr('content'), 
            },
            success: function(response) {
                const messageDiv = $('#messageDiv'); // Select the message container div

                if (response.success) {
                    var cnt = $('#faqCount').val();
                    cnt--;
                    $('#faqCount').val(cnt);
                    $('#faq' + index).remove();
                    // alert(response.message);
                    messageDiv
                        .removeClass('alert-danger')
                        .addClass('alert alert-success')
                        .text(response.message)
                        .fadeIn();
                        setTimeout(() => {
                        messageDiv.fadeOut();
                    }, 3000);
                } else {
                    // alert('Failed to delete FAQ.');
                    messageDiv
                        .removeClass('alert-success')
                        .addClass('alert alert-danger')
                        .text('Failed to delete FAQ.')
                        .fadeIn();

                    // Hide the message after 3 seconds
                    setTimeout(() => {
                        messageDiv.fadeOut();
                    }, 3000);
                }
            },
            error: function(xhr) {
                alert('An error occurred: ' + xhr.responseText);
            }
        });
    }
}

</script>

<script type="text/javascript">
    $(document).ready(function() {
        $('[data-bs-toggle="tooltip"]').tooltip({'placement': 'top'})
    });   
</script>

<script type="text/javascript">

    var selectConfigs = [
        { select: '#serviceTypes' },
        { select: '#serviceLocation' },
        { select: '#programFor' },
        { select: '#ageRange' },
        { select: '#difficultLevel' },
        { select: '#serviceFocus' },
        { select: '#teachingStyle' },
        { select: '#includedThings' },
        { select: '#notIncludedThings' },
        { select: '#wearThings' }
    ];

    selectConfigs.forEach(function(config) {
        new SlimSelect(config);
    });

    var selectValues = [
        { id: '#serviceTypes', values: '{{ @$service_data->select_service_type }}' },
        { id: '#serviceLocation', values: '{{ @$service_data->activity_location }}' },
        { id: '#programFor', values: '{{ @$service_data->activity_for }}' },
        { id: '#ageRange', values: '{{ @$service_data->age_range }}' },
        { id: '#difficultLevel', values: '{{ @$service_data->difficult_level }}' },
        { id: '#serviceFocus', values: '{{ @$service_data->activity_experience }}' },
        { id: '#teachingStyle', values: '{{ @$service_data->instructor_habit }}' },
        { id: '#includedThings', values: '{{ @$service_data->included_items }}' },
        { id: '#notIncludedThings', values: '{{ @$service_data->notincluded_items }}' },
        { id: '#wearThings', values: '{{ @$service_data->bring_wear }}' }
    ];

   
    selectValues.forEach(function(item) {
        var valuesArray = item.values.split(',');
        var selectInstance = new SlimSelect({
            select: item.id
        });
        selectInstance.set(valuesArray);
    });
</script>

<script>
    $(document).on('change', 'input[type="checkbox"].select-all', function() {
        let checkAllChecked = $(this).prop('checked'); 
        var classId = $(this).data('classid');
        $('.checkbox-item').prop('checked', checkAllChecked).each(function() {
            updateCidValue($(this), checkAllChecked ,classId);
        });
    });

    $(document).on('change', 'input[type="checkbox"].select-category', function() {
        let checkAllChecked = $(this).prop('checked'); 
        var catId = $(this).data('catid');
        var classId = $(this).data('classid');
        $('.checkbox-price'+catId).prop('checked', checkAllChecked).each(function() {
            updateCidValue($(this), checkAllChecked ,classId);
        });
    });

    $(document).on('change', 'input[type="checkbox"].checkbox-price', function() {
        var classId = $(this).data('classid');
        var pidInput = $('input[name="priceId'+classId+'"]');
        var currentPidValues = pidInput.val() ? pidInput.val().split(',') : [];
        if ($(this).is(':checked')) {
            currentPidValues.push($(this).data('priceid'));
        }else{
             var cidValueToRemove = String($(this).data('priceid'));
            currentPidValues = currentPidValues.filter(function(value) {
                return value !== cidValueToRemove;
            });
        }
        pidInput.val(currentPidValues.join(','));
    });


    function updateCidValue(checkbox, isChecked , classId) {
        var pidInput = $('input[name="priceId'+classId+'"]');
       var currentPidValues = new Set(pidInput.val() ? pidInput.val().split(',') : []);
        var cidValue = checkbox.data('priceid');
        if (isChecked ) {
            currentPidValues.add(cidValue);
        } else {
            currentPidValues.delete(String(cidValue));
        }
        pidInput.val(Array.from(currentPidValues).join(','));
    }

    $(function () {
        $(".button-1").click(function (e) {
            e.preventDefault();
            var catId = $(this).data('catid');
            $(".dropdownList"+catId).slideToggle(500);
            $(this).find(".fa-chevron-down").toggleClass("active");
        });
    });
    function openNavv(id) {
        document.getElementById("Sidepanelone"+id).style.width = "350px";
    }

    function closeNavv(id) {
        document.getElementById("Sidepanelone"+id).style.width = "0";
    }

    function deleteClass(id){
        if(window.confirm("Are you sure you want to delete this class?")){
            $.ajax({
                url: "/business/" + '{{$companyId}}' + "/class/delete/" + id,
                type: 'get',
                success: function (response) {
                    window.location.reload();
                }
            });
        }
    }

    function editClass(id){
        $.ajax({
            url: "/business/" + '{{$companyId}}' + "/class/edit/" + id,
            type: 'get',
            success: function (response) {
                $('.editclass-content').html(response);
                $('.editclass-modal').modal('show');
            }
        });
    }

</script>






<script>
    let dropBox1 = document.getElementById('dropBox1');

    // modify all of the event types needed for the script so that the browser
    // doesn't open the image in the browser tab (default behavior)
    ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(evt => {
        dropBox1.addEventListener(evt, prevDefault1, false);
    });
    function prevDefault1 (e) {
        e.preventDefault();
        e.stopPropagation();
    }

    // remove and add the hover class, depending on whether something is being
    // actively dragged over the box area
    ['dragenter', 'dragover'].forEach(evt => {
        dropBox1.addEventListener(evt, hover1, false);
    });
    ['dragleave', 'drop'].forEach(evt => {
        dropBox1.addEventListener(evt, unhover1, false);
    });
    function hover1(e) {
        dropBox1.classList.add('hover');
    }
    function unhover1(e) {
        dropBox1.classList.remove('hover');
    }

    // the DataTransfer object holds the data being dragged. it's accessible
    // from the dataTransfer property of drag events. the files property has
    // a list of all the files being dragged. put it into the filesManager function
    dropBox1.addEventListener('drop', mngDrop1, false);
    function mngDrop1(e) {
        let dataTrans = e.dataTransfer;
        let files = dataTrans.files;
        filesManager1(files);
    }

    // use FormData browser API to create a set of key/value pairs representing
    // form fields and their values, to send using XMLHttpRequest.send() method.
    // Uses the same format a form would use with multipart/form-data encoding
    function upFile1(file) {
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
            alert("Only images are allowed!", file);
        }
    }

    // use the FileReader API to get the image data, create an img element, and add
    // it to the gallery div. The API is asynchronous so onloadend is used to get the
    // result of the API function
    function previewFile1(file) {
        // only allow images to be dropped
        let imageType = /image.*/;
        if (file.type.match(imageType)) {
            let fReader = new FileReader();
            let gallery = document.getElementById('gallery1');
            // reads the contents of the specified Blob. the result attribute of this
            // with hold a data: URL representing the file's data
             gallery.innerHTML = '';
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
            alert("Only images are allowed!", file);
        }
    }

    function filesManager1(files) {
        // Ensure only one file is processed
        if (files.length == 1) {
            const file = files[0];
            upFile1(file);
            previewFile1(file);
        }else{
            alert("Only one file is allowed for the cover photo.");
            return;
        }
    }
</script>

<script>

    let formData1 = new FormData();
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

    dropBox.addEventListener('drop', mngDrop, false);
    function mngDrop(e) {
        let dataTrans = e.dataTransfer;
        let files = dataTrans.files;
        filesManager(files);
    }

    function upFile(file) {
        let imageType = /image.*/;
        if (file.type.match(imageType)) {
            let url = 'HTTP/HTTPS URL TO SEND THE DATA TO';
            formData1.append('file', file);
            fetch(url, {
                method: 'put',
                body: formData1
            })
            .then(response => response.json())
            .then(result => { console.log('Success:', result); })
            .catch(error => { console.error('Error:', error); });
        } else {
            console.error("Only images are allowed!", file);
        }
    }

    function previewFile(file) {
        let imageType = /image.*/;
        if (file.type.match(imageType)) {
            let fReader = new FileReader();
            let gallery = document.getElementById('gallery');
            fReader.readAsDataURL(file);
            fReader.onloadend = function() {
                let wrap = document.createElement('div');
                let img = document.createElement('img');
                img.src = fReader.result;
                let imgCapt = document.createElement('p');
                let fSize = (file.size / 1000) + ' KB';                
                gallery.appendChild(wrap).appendChild(img);
                gallery.appendChild(wrap).appendChild(imgCapt);
                let hiddenInput = document.createElement('input');
                hiddenInput.type = 'hidden';
                hiddenInput.name = 'imageBlobs[]'; 
                hiddenInput.value = fReader.result;
                gallery.appendChild(hiddenInput);
            }
        } else {
            console.error("Only images are allowed!", file);
        }
    }

    function filesManager(files) {
        files = [...files];
        files.forEach(previewFile);
    }
</script>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const programNameInput = document.getElementById('programName');
        const charCount = document.getElementById('charCount');
        const errorMsg = document.getElementById('error_msg');
        const form = document.getElementById('serviceForm');
        const maxLength = 30;
    
        function updateCharCount() {
            const currentLength = programNameInput.value.length;
            charCount.textContent = `${currentLength}/${maxLength} characters used`;
    
            if (currentLength > maxLength) {
                errorMsg.textContent = 'Title cannot exceed 36 characters.';
            } else {
                errorMsg.textContent = '';
            }
        }
    
        updateCharCount();
    
        programNameInput.addEventListener('input', function () {
            if (programNameInput.value.length > maxLength) {
                programNameInput.value = programNameInput.value.substring(0, maxLength);
            }
            updateCharCount();
        });
    
        form.addEventListener('submit', function (event) {
            if (programNameInput.value.length > maxLength) {
                event.preventDefault();
                errorMsg.textContent = 'Title cannot exceed 50 characters.';
            }
        });
    });
    </script>

    {{-- <script type="text/javascript">
        CKEDITOR.replace("ckeditor-classic");
    </script> --}}


<!-- {{-- ends here --}} -->

<script>
    function readFile(input) {
  if (input.files && input.files[0]) {
    var reader = new FileReader();

    reader.onload = function(e) {
      var htmlPreview =
        '<img width="200" src="' + e.target.result + '" />' +
        '<p>' + input.files[0].name + '</p>';
      var wrapperZone = $(input).parent();
      var previewZone = $(input).parent().parent().find('.preview-zone');
      var boxZone = $(input).parent().parent().find('.preview-zone').find('.box').find('.box-body');

      wrapperZone.removeClass('dragover');
      previewZone.removeClass('hidden');
      boxZone.empty();
      boxZone.append(htmlPreview);
    };

    reader.readAsDataURL(input.files[0]);
  }
}

function reset(e) {
  e.wrap('<form>').closest('form').get(0).reset();
  e.unwrap();
}

$(".dropzone").change(function() {
  readFile(this);
});

$('.dropzone-wrapper').on('dragover', function(e) {
  e.preventDefault();
  e.stopPropagation();
  $(this).addClass('dragover');
});

$('.dropzone-wrapper').on('dragleave', function(e) {
  e.preventDefault();
  e.stopPropagation();
  $(this).removeClass('dragover');
});

$('.remove-preview').on('click', function() {
  var boxZone = $(this).parents('.preview-zone').find('.box-body');
  var previewZone = $(this).parents('.preview-zone');
  var dropzone = $(this).parents('.form-group').find('.dropzone');
  boxZone.empty();
  previewZone.addClass('hidden');
  reset(dropzone);
});

</script>
<script>
    var p = new SlimSelect({
    select: '#categSTypeidividuals'
});
</script>

<script>
    var p = new SlimSelect({
    select: '#frm_servicelocation'
});
</script>
<script>
    var p = new SlimSelect({
    select: '#frm_programfor'
});
</script>

<script>
    var p = new SlimSelect({
    select: '#frm_agerange'
    });
</script>
<script>
    var p = new SlimSelect({
    select: '#frm_experience_level'
});
</script>
<script>
    var p = new SlimSelect({
    select: '#frm_servicefocuses'
});
</script>
<script>
    var p = new SlimSelect({
    select: '#teaching'
});
</script>

    <script>
        $("#menu-toggle").click(function(e) {
            e.preventDefault();
            $("#service_wrapper").toggleClass("toggled");
        });
    </script>
    <script>
        function removeClassIfNecessary() {
            var div = document.getElementById('service_wrapper');
            if (window.innerWidth <= 768) { // Example breakpoint
                div.classList.remove('toggled');
            } else {
            div.classList.add('toggled');
            }
        }
        window.addEventListener('resize', removeClassIfNecessary);
        window.addEventListener('DOMContentLoaded', removeClassIfNecessary); // To handle initial load
    </script>

    <script>
          $(document).on('click', '#btnactive', function(event) {
            var sid = $(this).attr('data-id');
            var btnactive = $(this).attr('data-btnactive');
            var companyid = '{{$request->current_company->id}}';
            $.ajax({ 
                url:"/business/"+companyid+"/services/"+sid,
                xhrFields: {
                    withCredentials: true
                },
                type:"PATCH",
                data: { 
                    _token: '{{csrf_token()}}', 
                    btnactive: btnactive
                },
                success: function(html){
                   location.reload();
                }
            });
        });

        $(document).on('click', '#btndelete', function(event) {
                let text = "Are you sure to delete this activity?";
                if (confirm(text) == true) {
                    var sid = $(this).attr('data-id');
                    var companyid = '{{$request->current_company->id}}';
                    $.ajax({ 
                        url:"/business/"+companyid+"/services/"+sid,
                        xhrFields: {
                            withCredentials: true
                        },
                        type:"delete",
                        data: { 
                            _token: '{{csrf_token()}}', 
                        },                
                        success: function(response) {
                        console.log('AJAX request successful:', response);
                        if (response.success) {
                            $('.messageDiv').addClass('btn btn-success');
                            $('.messageDiv').html(response.message);
                            setTimeout(function() {
                                $('.messageDiv').fadeOut(400, function() {
                                    $('.modal').modal('hide'); 
                                    location.reload();
                                });
                            }, 3000);
                        }
                    }

                    });
                }
            });

             
        $(document).ready(function() {
            var chkDisplay = '{{$displayModal}}';
            if(chkDisplay){
                $('.edit-schedule'+chkDisplay).modal('show');
            }
        });

        function getbookingmodel(sid,chk,type,open){  
            let date = '';
            if(chk == 'ajax'){
                date = $('#managecalendarservice').val();
            }else if(chk == 'simple'){
                date = new Date().toLocaleDateString();
                if(open == 'open'){
                    $('#bookingmodel').html('');
                }
            }

            $.ajax({
                url:"{{route('getbookingmodeldata')}}",
                xhrFields: {
                    withCredentials: true
                },
                type:"get",
                data:{
                    sid:sid,
                    date:date,
                    type:type,
                    categoryId:($('#category').val() == 'all') ? '' : $('#category').val(),
                },
                success:function(data){
                    $('.moreoptions'+sid).modal('hide');
                    $('#bookingmodel').html(data);
                    if(open == 'open'){
                        $('.view-booking').modal('show');
                    }
                }
            });
        } 
    </script>
@endsection
@push('scripts')
    {{-- <script src="{{url('/public/dashboard-design/js/ckeditor/ckeditor.js')}}"></script> --}}
    <script src="{{asset('/public/dashboard-design/js/dropzone-min.js')}}"></script>
    <script src="{{asset('/public/dashboard-design/js/ecommerce-product-create.init.js')}}"></script>
   
@endpush