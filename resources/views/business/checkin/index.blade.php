@inject('request', 'Illuminate\Http\Request')
@extends('layouts.business.header')

@section('content')

    @include('layouts.business.business_topbar')
    <!-- ============================================================== -->
    <!-- Start right Content here -->
    <!-- ============================================================== -->
    <div class="main-content">
        <div class="page-content">
            <div class="container-fluid">
               <div class="row">
                  <div class="col">
                    <div class="h-100">
                        <div class="row mb-3">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <div class="page-heading">
                                    <label>Check-in Settings</label>
                                </div>
                            </div>
                            
                            <!--end col-->
                        </div>
                        <!--end row-->
                        
                        <form action="{{route('checkin-portal-settings.store')}}" method="post" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="business_id" value="{{request()->business_id}}">

                            <input type="hidden" id="selectedColor1" name="welcome_screen_color" value="{{$data->welcome_screen_color ?? '#ea1515'}}">
                            <input type="hidden" id="selectedColor2" name="digit_screen_color" value="{{$data->digit_screen_color ?? '#ea1515'}}">
                            <input type="hidden" id="selectedColor3" name="alert_screen_color" value="{{$data->alert_screen_color ?? '#ea1515'}}">

                            <div class="row">

                                <div class="col-lg-6">

                                    <div class="card">
                                        <div class="middle-border">
                                            <div class="card-body">
                                                <div class="row y-middle">
                                                    <div class="col-xxl-1 col-lg-2 col-md-1 col-sm-1 col-2">
                                                        <div class="d-flex flex-wrap gap-2">
                                                            <div class="nano-colorpicker" data-picker="1"></div>
                                                        </div>
                                                    </div>
                                                    <div class="col-xxl-11 col-lg-10 col-md-11 col-sm-11 col-10">
                                                        <h5>Change welcome screen button color</h5>
                                                        <p class="mb-0">Your button color will be change.</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>   

                                        <div class="middle-border">
                                            <div class="card-body">
                                                <div class="row y-middle">
                                                    <div class="col-xxl-1 col-lg-2 col-md-1 col-sm-1 col-2">
                                                        <div class="d-flex flex-wrap gap-2">
                                                            <div class="nano-colorpicker" data-picker="2"></div>
                                                        </div>
                                                    </div>
                                                    <div class="col-xxl-10 col-lg-8 col-md-10 col-sm-10 col-8">
                                                        <h5>Change your 4 digit screen button color</h5>
                                                        <p class="mb-0">Your button color will be change.</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="middle-border">
                                            <div class="card-body">
                                                <div class="row y-middle">
                                                    <div class="col-xxl-1 col-lg-2 col-md-1 col-sm-1 col-2">
                                                        <div class="d-flex flex-wrap gap-2">
                                                           <div class="nano-colorpicker" data-picker="3"></div>
                                                        </div>
                                                    </div>
                                                    <div class="col-xxl-10 col-lg-8 col-md-10 col-sm-10 col-8">
                                                        <h5>Change alert pop up button color</h5>
                                                        <p class="mb-0">Your button color will be change.</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="middle-border">
                                            <div class="card-body">
                                                <div class="row y-middle">
                                                    <div class="col-xxl-1 col-lg-2 col-md-1 col-sm-2 col-3">
                                                        <div class="profile-user position-relative d-inline-block mx-auto mb-2">
                                                            <img src="{{url('/public/images/fitnessity_logo1_black.png')}}" class="avatar-sm img-thumbnail user-profile-image  shadow" alt="upload-image" loading="lazy">
                                                            <div class="avatar-xxs p-0 rounded-circle profile-photo-edit">
                                                                <input id="profile-img-file-input" type="file" class="profile-img-file-input" name="logo">
                                                                <label for="profile-img-file-input" class="profile-photo-edit logo-change avatar-xxs">
                                                                    <span class="avatar-title rounded-circle bg-light text-body shadow">
                                                                        <i class="fas fa-plus"></i>
                                                                    </span>
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-xxl-11 col-lg-10 col-md-11 col-sm-10 col-9">
                                                        <h5>Logo</h5>
                                                        <p class="mb-0">Add a logo to show off your brand in the check in app</p>
                                                        <p class="mb-0 fs-12">Please upload 250*250 logo</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div> 

                                        <div class="middle-border">
                                            <div class="card-body">
                                                <div class="row y-middle">
                                                    <div class="col-xxl-2 col-lg-4 col-md-2 col-sm-2 col-5">
                                                        <div class="d-flex flex-wrap gap-2">
                                                            <select name="customer_return_back_time" data-behavior="on_change_submit" class="form-select" id="customer_return_back_time" data-choices="" data-choices-search-false="">
                                                                <option value="60" @if(@$data->customer_return_back_time == 60) selected="" @endif>60 sec</option>
                                                                <option value="50" @if(@$data->customer_return_back_time== 50 ) selected="" @endif>50 sec</option>
                                                                <option value="40" @if(@$data->customer_return_back_time == 40 ) selected="" @endif>40 sec</option>
                                                            </select>                                                                  
                                                        </div>
                                                    </div>
                                                    <div class="col-xxl-10 col-lg-8 col-md-10 col-sm-10 col-7">
                                                        <h5>Automatically Return to Home</h5>
                                                        <p class="mb-0">After a time of inactivity, the app will return home.</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div> 
                                          
                                        
                                        <div class="middle-border">
                                            <div class="card-body">
                                                <div class="row y-middle">
                                                    <div class="col-xxl-7 col-lg-8 col-md-10 col-sm-10 col-7">
                                                        <h5>Play Sound</h5>
                                                        <p class="mb-0">Choose if sounds play at successful or failing action </p>
                                                    </div>
                                                    <div class="col-xxl-5 col-lg-4 col-md-2 col-sm-2 col-5">
                                                        <div class="radio_container">
                                                            @php
                                                                $playSoundValues = explode(',', $data->play_sound ?? '');
                                                            @endphp
                                                            <input type="checkbox" name="radio[]" id="success" value="success" {{ in_array('success', $playSoundValues) ? 'checked' : '' }}>
                                                            <label for="success">Success</label>
                                                            <input type="checkbox" name="radio[]" id="fail" value="fail" {{ in_array('fail', $playSoundValues) ? 'checked' : '' }}>
                                                            <label for="fail">Failure</label>
                                                            <input type="checkbox" name="radio[]" value="none" id="no" {{ in_array('none', $playSoundValues) ? 'checked' : '' }}>
                                                            <label for="no">None</label>
                                                        </div>
                                                    </div>                                               
                                                </div>
                                            </div>
                                        </div>

                                        <div class="middle-border">
                                            <div class="card-body">
                                                <div class="row y-middle">
                                                    <div class="col-xxl-7 col-lg-8 col-md-10 col-sm-10 col-7">
                                                        <h5>Membership Purchase</h5>
                                                        <p class="mb-0">Require users to sign up for a membership at registration, or make it optional</p>
                                                    </div>
                                                    <div class="col-xxl-5 col-lg-4 col-md-2 col-sm-2 col-5">
                                                        <div class="radio_container">
                                                            <input type="radio" name="membership_option" id="none"  value="0" @if(@$data->membership_option == 0) checked @endif> 
                                                            <label for="none">None</label>
                                                            <input type="radio" name="membership_option" id="required" value="1"  @if(@$data->membership_option == 1 || @$data == '') checked @endif>
                                                            <label for="required">Required</label>
                                                        </div>
                                                    </div>                                               
                                                </div>
                                            </div>
                                        </div>
                                    </div>  
                                </div>
                                <div class="col-lg-6">  
                                    <div class="card">
                                        <div class="card-header">
                                            {{-- <h4 class="card-title mb-0">Upload welcome screen photo</h4> --}}
                                            <div class="row">
                                                <div class="col-lg-6">
                                                    <h4 class="card-title mb-0">Upload welcome screen photo</h4>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="text-right">
                                                        <a href="" data-bs-toggle="modal" data-bs-target="#welcomeModal">Preview</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- end card header -->

                                        <div class="card-body">
                                            <div class="dropzone">
                                                <div class="fallback">
                                                    <input name="cover" type="file">
                                                </div>
                                                <div class="dz-message needsclick">
                                                    <div class="mb-3">
                                                        <i class="display-4 text-muted ri-upload-cloud-2-fill"></i>
                                                    </div>
                                                    <h4>Drop files here or click to upload.</h4>
                                                </div>
                                            </div>

                                            <ul class="list-unstyled mb-0" id="dropzone-preview">
                                                <li class="mt-2" id="dropzone-preview-list">
                                                    <div class="border rounded">
                                                        <div class="d-flex p-2">
                                                            <div class="flex-shrink-0 me-3">
                                                                <div class="avatar-sm bg-light rounded">
                                                                    <img data-dz-thumbnail class="img-fluid rounded d-block" src="assets/images/new-document.png" alt="Dropzone-Image" loading="lazy"/>
                                                                </div>
                                                            </div>
                                                            <div class="flex-grow-1">
                                                                <div class="pt-1">
                                                                    <h5 class="fs-14 mb-1" data-dz-name>&nbsp;</h5>
                                                                    <p class="fs-13 text-muted mb-0" data-dz-size></p>
                                                                    <strong class="error text-danger" data-dz-errormessage></strong>
                                                                </div>
                                                            </div>
                                                            <div class="flex-shrink-0 ms-3">
                                                                <button data-dz-remove class="btn btn-sm btn-danger">Delete</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </li>

                                                @if(@$data->welcome_cover_photo)
                                                    <li class="mt-2" id="ddropzone-preview">
                                                        <input type="hidden" name="cover" value="{{$data->welcome_cover_photo}}">
                                                        <div class="border rounded">
                                                            <div class="d-flex p-2">
                                                                <div class="flex-shrink-0 me-3">
                                                                    <div class="avatar-sm bg-light rounded product-display">
                                                                        <img class="img-fluid rounded d-block" src="{{Storage::URL($data->welcome_cover_photo)}}" alt="Product-Image"  loading="lazy"/>
                                                                    </div>
                                                                </div>
                                                                <div class="flex-grow-1">
                                                                    <div class="pt-1">
                                                                        <h5 class="fs-14 mb-1">&nbsp;{{basename($data->welcome_cover_photo)}}</h5>
                                                                    </div>
                                                                </div>
                                                                <div class="flex-shrink-0 ms-3">
                                                                    <button class="btn btn-sm btn-danger delete-btn" type="button">Delete</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </li>
                                                @endif

                                            </ul>
                                            <!-- end dropzon-preview -->
                                        </div>
                                        <!-- end card body -->
                                    </div>

                                    <div class="card">
                                        <div class="card-header">
                                            {{-- <h4 class="card-title mb-0">Upload passcode page cover photo </h4> --}}
                                            <div class="row">
                                                <div class="col-lg-6">
                                                    <h4 class="card-title mb-0">Upload passcode page cover photo </h4>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="text-right">
                                                        <a href="" data-bs-toggle="modal" data-bs-target="#passcodeModal">Preview</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div><!-- end card header -->

                                        <div class="card-body">
                                            <div class="dropzone dropzone-passcode">
                                                <div class="fallback">
                                                    <input name="passcode" type="file">
                                                </div>
                                                <div class="dz-message needsclick">
                                                    <div class="mb-3">
                                                        <i class="display-4 text-muted ri-upload-cloud-2-fill"></i>
                                                    </div>
                                                    <h4>Drop files here or click to upload.</h4>
                                                </div>
                                            </div>

                                            <ul class="list-unstyled mb-0" id="dropzone-preview-passcode">
                                                <li class="mt-2" id="dropzone-preview-list-passcode">
                                                    <!-- This is used as the file preview template -->
                                                    <div class="border rounded">
                                                        <div class="d-flex p-2">
                                                            <div class="flex-shrink-0 me-3">
                                                                <div class="avatar-sm bg-light rounded">
                                                                    <img data-dz-thumbnail class="img-fluid rounded d-block" src="assets/images/new-document.png" alt="Dropzone-Image" loading="lazy"/>
                                                                </div>
                                                            </div>
                                                            <div class="flex-grow-1">
                                                                <div class="pt-1">
                                                                    <h5 class="fs-14 mb-1" data-dz-name>&nbsp;</h5>
                                                                    <p class="fs-13 text-muted mb-0" data-dz-size></p>
                                                                    <strong class="error text-danger" data-dz-errormessage></strong>
                                                                </div>
                                                            </div>
                                                            <div class="flex-shrink-0 ms-3">
                                                                <button data-dz-remove class="btn btn-sm btn-danger">Delete</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </li>

                                                @if(@$data->passcode_cover_photo)
                                                    <li class="mt-2" id="ddropzone-preview-list-passcode">
                                                        <input type="hidden" name="passcode" value="{{$data->passcode_cover_photo}}">
                                                        <div class="border rounded">
                                                            <div class="d-flex p-2">
                                                                <div class="flex-shrink-0 me-3">
                                                                    <div class="avatar-sm bg-light rounded product-display">
                                                                        <img class="img-fluid rounded d-block" src="{{Storage::URL($data->passcode_cover_photo)}}" alt="Product-Image"  loading="lazy"/>
                                                                    </div>
                                                                </div>
                                                                <div class="flex-grow-1">
                                                                    <div class="pt-1">
                                                                        <h5 class="fs-14 mb-1">&nbsp;{{basename($data->passcode_cover_photo)}}</h5>
                                                                    </div>
                                                                </div>
                                                                <div class="flex-shrink-0 ms-3">
                                                                    <button class="btn btn-sm btn-danger delete-btn" type="button">Delete</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </li>
                                                @endif

                                            </ul>
                                            <!-- end dropzon-preview -->
                                        </div>
                                        <!-- end card body -->
                                    </div>

                                    <div class="card">
                                        <div class="card-header">
                                            <!-- {{-- <h4 class="card-title mb-0">Upload photo for alert pop up</h4> --}} -->
                                            <div class="row">
                                                <div class="col-lg-6">
                                                    <h4 class="card-title mb-0">Upload photo for alert pop up</h4>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="text-right">
                                                        <a href="" data-bs-toggle="modal" data-bs-target="#alertModal">Preview</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div><!-- end card header -->

                                        <div class="card-body">
                                            <div class="dropzone dropzone-checkin">
                                                <div class="fallback">
                                                    <input name="check_in_photo" type="file" >
                                                </div>
                                                <div class="dz-message needsclick">
                                                    <div class="mb-3">
                                                        <i class="display-4 text-muted ri-upload-cloud-2-fill"></i>
                                                    </div>
                                                    <h4>Drop files here or click to upload.</h4>
                                                </div>
                                            </div>

                                            <ul class="list-unstyled mb-0" id="dropzone-preview-checkin">
                                                <li class="mt-2" id="dropzone-preview-list-checkin">
                                                    <!-- This is used as the file preview template -->
                                                    <div class="border rounded">
                                                        <div class="d-flex p-2">
                                                            <div class="flex-shrink-0 me-3">
                                                                <div class="avatar-sm bg-light rounded">
                                                                    <img data-dz-thumbnail class="img-fluid rounded d-block" src="assets/images/new-document.png" alt="Dropzone-Image" loading="lazy"/>
                                                                </div>
                                                            </div>
                                                            <div class="flex-grow-1">
                                                                <div class="pt-1">
                                                                    <h5 class="fs-14 mb-1" data-dz-name>&nbsp;</h5>
                                                                    <p class="fs-13 text-muted mb-0" data-dz-size></p>
                                                                    <strong class="error text-danger" data-dz-errormessage></strong>
                                                                </div>
                                                            </div>
                                                            <div class="flex-shrink-0 ms-3">
                                                                <button data-dz-remove class="btn btn-sm btn-danger">Delete</button>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    @if(@$data->alerts_photo)
                                                        <li class="mt-2" id="ddropzone-preview-list-checkin">
                                                            <input type="hidden" name="checkin" value="{{$data->alerts_photo}}">
                                                            <div class="border rounded">
                                                                <div class="d-flex p-2">
                                                                    <div class="flex-shrink-0 me-3">
                                                                        <div class="avatar-sm bg-light rounded product-display">
                                                                            <img class="img-fluid rounded d-block" src="{{Storage::URL($data->alerts_photo)}}" alt="Product-Image"  loading="lazy"/>
                                                                        </div>
                                                                    </div>
                                                                    <div class="flex-grow-1">
                                                                        <div class="pt-1">
                                                                            <h5 class="fs-14 mb-1">&nbsp;{{basename($data->alerts_photo)}}</h5>
                                                                        </div>
                                                                    </div>
                                                                    <div class="flex-shrink-0 ms-3">
                                                                        <button class="btn btn-sm btn-danger delete-btn" type="button">Delete</button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </li>
                                                    @endif

                                                </li>
                                            </ul> <!-- end dropzon-preview -->
                                        </div>
                                        <!-- end card body -->
                                    </div>

                                    <div class="col-md-12">
                                        <div class="float-right">
                                            <button type="submit" class="btn-red-primary btn-red w-100">Save</button>
                                        </div>
                                    </div>
                                </div> 

                        </form>
                                <!-- {{-- <div class="col-lg-6">      
                                    <div class="auth-page-content">
                                        <div class="mb-25">
                                            <div class="container-fluid ">
                                                <div class="row justify-content-center">
                                                    <div class="col-lg-12 nopadding">
                                                        <label class="fs-16">Welcome Preview</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- end container -->
                                             <div style="background-image:url('/public/dashboard-design/images/check-in-bg.jpg')">
                                                <div class="container-fuild">
                                                    <div class="z-1">
                                                        <div class="card-body self-check-sp-preview">
                                                            <div class="cross-check-preview">
                                                                <div class="row">
                                                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 ">
                                                                        <div class="page-heading text-right">
                                                                            <label class="mb-15"><a class="btn btn-red" href="">Exit</a></label>
                                                                        </div>
                                                                        
                                                                    </div>

                                                                    <div class="col-lg-6 col-12">
                                                                        <div class="self-welcome-logo">
                                                                            <a href="#" class="d-inline-block auth-logo">
                                                                                <img src="{{url('/public/images/fitnessity_logo1_black.png')}}" alt="logo" loading="lazy">
                                                                            </a>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-lg-6 col-12">
                                                                        <div class="text-right wel-date-time">
                                                                            <span>June 10, 2024</span>
                                                                            <h3>5:14 AM</h3>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-lg-6 col-12">
                                                                        <div class="welcome-title-preview d-grid text-center">
                                                                            <label>Welcome To</label>
                                                                            <span>Fitness Pvt. Ltd. </span>
                                                                        </div>
                                                                        <div class="text-center">
                                                                            <a href="http://dev.fitnessity.co/quick-checkin" class="btn btn-red fs-15 mb-15"><i class="ri-add-line align-bottom me-1"></i>Check In</a>
                                                                            <a href="http://dev.fitnessity.co/business/68/create-customer" class="btn btn-black fs-15 mb-15"><i class="ri-add-line align-bottom me-1"></i>Sign Up</a>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-lg-6 col-12 mobile-none">
                                                                        <div class="float-right qr-code">
                                                                            <div class="text-center">
                                                                                <img src="http://dev.fitnessity.co/dashboard-design/images/qr-code.png" alt="logo" loading="lazy">
                                                                                <p>Scan QR Code for touchless check-in or sign-up</p>
                                                                            </div>                                               
                                                                        </div>
                                                                    </div>
                                                                </div>                                   
                                                            </div>
                                                        </div>
                                                        <!-- end card body -->
                                                    </div>                      
                                                    <!-- end card -->
                                                </div>
                                             </div>
                                            
                                        </div>

                                        <div class="mb-25">
                                            <div class="container-fluid ">
                                                <div class="row justify-content-center">
                                                    <div class="col-lg-12 nopadding">
                                                        <label class="fs-16">Passcode Preview</label>
                                                    </div>
                                                    <div class="col-lg-6 back-check-img"  style="background-image:url('/dashboard-design/images/check-in-bg.jpg')">
                                                        <div class="card-check-in-preview p-relative h-100">
                                                            <div class="pb-60 text-center">
                                                                <a href="#" class="register-check">
                                                                    <img src="{{url('/public/images/fitnessity_logo1_black.png')}}" alt="logo" loading="lazy">
                                                                </a>
                                                            </div>  
                                                            <div class="welcome-provider-preview text-center">
                                                                <h3>Welcome to</h3>
                                                                <span>Fitness Pvt. Ltd.</span>
                                                                <p>Please select a check-in option to the right. </p>
                                                            </div>  
                                                            <div class="self-check-arrow">
                                                                <i class="fas fa-long-arrow-alt-left"></i>
                                                            </div>  
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6 nopadding">
                                                        <div class=" bg-white">
                                                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                                <div class="page-heading text-right">
                                                                    <label class="mr-10"><a class="btn btn-red" href="">Exit</a></label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        
                                                        <div class="card-check-in-preview bg-white">
                                                            <div class="text-center">
                                                                <label class="fs-16 m-b-50 font-red">Already have an account?</label>
                                                            </div>
                                                            <div class="text-center reg-up-img-preview">
                                                                <div class="mb-3">
                                                                    <img src="http://dev.fitnessity.co//public/dashboard-design/images/u-login.png" alt="logo" loading="lazy">
                                                                </div>
                                                            </div>
                                                            <div class="container">
                                                                <div class="row justify-content-center">
                                                                    <div class="col-lg-9">
                                                                        <div class="or-text p-relative pt-15 pb-15">
                                                                            <div class="mb-3">
                                                                                <button type="button" class="btn-red-primary btn-red mt-25 w-100" data-bs-toggle="modal" data-bs-target="#exampleModal">Enter a quick four digit code </button>
                                                                            </div>
                                                                        </div> 
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- end container -->
                                        </div>

                                        <div class="mb-25">
                                            <div class="container-fluid ">
                                                <div class="row justify-content-center">
                                                    <div class="col-lg-12 nopadding">
                                                        <label class="fs-16">Alert pop-up preview</label>
                                                    </div>
                                                    <div class="col-lg-12 nopadding">
                                                        <div class="p-0 bg-white">
                                                            <div class="p-relative modal-close-set">
                                                                <button type="button" class="btn-close" ></button>
                                                            </div>
                                                            <div class="row y-middle">
                                                                <div class="col-lg-6 col-md-6">
                                                                    <div class="checking-popup">
                                                                        <img src="https://fitnessity-production.s3.amazonaws.com/checkin/d839c659-2b85-4f57-9917-1209cf2c0d30.jpg" loading="lazy">
                                                                    </div>                                                                                                          
                                                                </div>
                                                                <div class="col-lg-6 col-md-6">
                                                                    <div class="text-center mb-mv-25">
                                                                        <div class="tick-set">
                                                                            <img src="http://dev.fitnessity.co/dashboard-design/images/cross.png" loading="lazy">
                                                                        </div>
                                                                        <div class="mb-15">
                                                                            <label class="fs-24 mb-0"> Sorry, I can't check you in yet.</label>
                                                                            <label class="fs-24 mb-0"> You have a failed auto payment.</label>
                                                                            <label class="fs-24 mb-0"> You can see the front desk or resolve now.</label>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="p-relative">
                                                                    <div class="finish-btn">
                                                                        <a href="#" data-modal-chkbackdrop="1" data-reload="1" data-modal-width="" data-behavior="ajax_html_modal" data-url="" class="btn btn-red" onclick="closeModal()">Resolve</a>
                                                                        <a class="btn btn-red" href="">Finish</a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div> <!-- end container -->
                                        </div>
                                    </div>
                                <!-- </div>                          --}} --> 
                            </div> <!-- end row -->    

                    </div> <!-- end .h-100-->
                  </div> <!-- end col -->
                </div>
            </div><!-- container-fluid -->
        </div><!-- End Page-content -->
     </div><!-- end main content-->
</div><!-- END layout-wrapper -->
    


<!-- {{-- my code start --}} -->

<!-- Modal -->
<div class="modal fade" id="welcomeModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Welcome Screen Preview</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
               @if($data && $data->welcome_cover_photo)
                       <div id="welcomeModalBackground" class="check-img-set" style="background-image: url('{{ Storage::url($data->welcome_cover_photo) }}')">
                    @else
                        <div id="welcomeModalBackground" class="check-img-set" style="background-image: url('../../dashboard-design/images/check-in-bg.jpg')">
                @endif
                <div class="container-fuild">
                        <div class="z-1">
                            <div class="card-body self-check-sp-preview">
                                <div class="cross-check-preview">
                                    <div class="row">
                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 ">
                                            <div class="page-heading text-right">
                                                <label class="mb-15">
                                                    {{-- <a class="btn" id="exitButton" style="background-color: #ea1515; border: 1px solid #ea1515; color: #fff; border-radius: 10px;" href="http://dev.fitnessity.co/checkin/check-out?type=1">Exit</a></label> --}}
                                                    <a class="btn" id="exitButton" 
                                                    style="background-color: {{ $color1 ?: '#ea1515' }}; border: 1px solid {{ $color1 ?: '#ea1515' }}; color: #fff; border-radius: 10px;" 
                                                    href="http://dev.fitnessity.co/checkin/check-out?type=1">Exit</a>                                                 
                                                </div>
                                        </div>

                                        <div class="col-lg-6 col-12">
                                            <div class="self-welcome-logo">
                                                <a href="#" class="d-inline-block auth-logo">
                                                    <img src="http://dev.fitnessity.co/images/fitnessity_logo1_black.png" alt="logo" loading="lazy">
                                                </a>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-12">
                                            <div class="text-right wel-date-time">
                                                <span>June 10, 2024</span>
                                                <h3>5:14 AM</h3>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-12">
                                            <div class="welcome-title-preview d-grid text-center">
                                                <label>Welcome To</label>
                                                <span>Fitness Pvt. Ltd. </span>
                                            </div>
                                            <div class="text-center">
                                                {{-- <a href="http://dev.fitnessity.co/quick-checkin" class="btn fs-15 mb-15" id="checkInButton" style="background-color: #ea1515; border: 1px solid #ea1515; color: #fff; border-radius: 10px;"><i class="ri-add-line align-bottom me-1"></i>Check In</a> --}}
                                                <a href="http://dev.fitnessity.co/quick-checkin" class="btn fs-15 mb-15" id="checkInButton" style="background-color: {{ $color1 ?: '#ea1515' }}; border: 1px solid {{ $color1 ?: '#ea1515' }}; color: #fff; border-radius: 10px;"><i class="ri-add-line align-bottom me-1"></i>Check In</a>
                                                <a href="http://dev.fitnessity.co/business/68/create-customer" class="btn fs-15 mb-15" style="background-color: #000; border: 1px solid #000; color: #fff; border-radius: 10px;"><i class="ri-add-line align-bottom me-1"></i>Sign Up</a>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-12 mobile-none">
                                            <div class="float-right qr-code">
                                                <div class="text-center">
                                                    <img src="http://dev.fitnessity.co/dashboard-design/images/qr-code.png" alt="logo" loading="lazy">
                                                    <p>Scan QR Code for touchless check-in or sign-up</p>
                                                </div>                                               
                                            </div>
                                        </div>
                                    </div>                                   
                                </div>
                            </div>
                            <!-- end card body -->
                        </div>                      
                        <!-- end card -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>




<!-- Modal -->
<div class="modal fade" id="passcodeModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Passcode Screen Preview</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="container-fluid ">
                    <div class="row justify-content-center">
                    @if(@$data->passcode_cover_photo)
                        <div class="col-lg-6 back-check-img" style="background-image:url('{{Storage::URL($data->passcode_cover_photo)}}')">
                    @else
                        <div class="col-lg-6 back-check-img" style="background-image:url(../../dashboard-design/images/check-in-bg.jpg)">
                    @endif

                    <div class="card-check-in-preview p-relative h-100">
                                <div class="pb-60 text-center">
                                    <a href="#" class="register-check">
                                        <img src="http://dev.fitnessity.co//public/images/fitnessity_logo1_black.png" alt="logo" loading="lazy">
                                    </a>
                                </div>  
                                <div class="welcome-provider-preview text-center">
                                    <h3>Welcome to</h3>
                                    <span>Fitness Pvt. Ltd.</span>
                                    <p>Please select a check-in option to the right. </p>
                                </div>  
                                <div class="self-check-arrow">
                                    <i class="fas fa-long-arrow-alt-left"></i>
                                </div>  
                            </div>
                        </div>
                        <div class="col-lg-6 nopadding">
                            <div class=" bg-white">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <div class="page-heading text-right">
                                        <label class="mr-10">
                                            {{-- <a class="btn" style="background-color: #ea1515; border: 1px solid #ea1515; color: #fff; border-radius: 10px;" href="http://dev.fitnessity.co/checkin/check-out?type=1" id="passcodeExitButton">Exit</a> --}}
                                            <a class="btn" style="background-color: {{ $color2 ?: '#ea1515' }}; border: 1px solid {{ $color2 ?: '#ea1515' }}; color: #fff; border-radius: 10px;" href="http://dev.fitnessity.co/checkin/check-out?type=1" id="passcodeExitButton">Exit</a>
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="card-check-in-preview bg-white">
                                <div class="text-center">
                                    <label class="fs-16 m-b-50 font-red">Already have an account?</label>
                                </div>
                                <div class="text-center reg-up-img-preview">
                                    <div class="mb-3">
                                        <img src="http://dev.fitnessity.co//public/dashboard-design/images/u-login.png" alt="logo" loading="lazy">
                                    </div>
                                </div>
                                <div class="container">
                                    <div class="row justify-content-center">
                                        <div class="col-lg-9">
                                            <div class="or-text p-relative pt-15 pb-15">
                                                <div class="mb-3">
                                                    {{-- <button type="button" class="btn mt-25 w-100" style="background-color: #ea1515; border: 1px solid #ea1515; color: #fff; border-radius: 10px;" data-bs-toggle="modal" data-bs-target="#exampleModal" id="quickCodeButton">Enter a quick four digit code </button> --}}
                                                    <button type="button" class="btn mt-25 w-100" style="background-color: {{ $color2 ?: '#ea1515' }}; border: 1px solid {{ $color2 ?: '#ea1515' }}; color:#fff; border-radius: 10px;" data-bs-toggle="modal" data-bs-target="#exampleModal" id="quickCodeButton">Enter a quick four digit code </button>
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



<!-- Modal -->
<div class="modal fade" id="alertModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Passcode Screen Preview</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="container-fluid ">
                    <div class="row justify-content-center">
                        <div class="col-lg-12 nopadding">
                            <div class="p-0 bg-white">
                                <div class="row y-middle">
                                    <div class="col-lg-6 col-md-6">
                                        <div class="checking-popup">           
                                        @if(@$data->alerts_photo)
                                            <img src="{{Storage::URL($data->alerts_photo)}}" loading="lazy"/>
                                        @else                       
                                        <img src="https://fitnessity-production.s3.amazonaws.com/checkin/d839c659-2b85-4f57-9917-1209cf2c0d30.jpg" loading="lazy">
                                        @endif
                                        <!-- <img src="https://fitnessity-production.s3.amazonaws.com/checkin/d839c659-2b85-4f57-9917-1209cf2c0d30.jpg"> -->
                                    </div>																											
                                </div>
                                    <div class="col-lg-6 col-md-6">
                                        <div class="text-center mb-mv-25">
                                            <div class="tick-set">
                                                <img src="http://dev.fitnessity.co/dashboard-design/images/cross.png" loading="lazy">
                                            </div>
                                            <div class="mb-15">
                                                    <label class="fs-24 mb-0"> Sorry, I can't check you in yet.</label>
                                                    <label class="fs-24 mb-0"> You have a failed auto payment.</label>
                                                    <label class="fs-24 mb-0"> You can see the front desk or resolve now.</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="p-relative">
                                        <div class="finish-btn">
                                            {{-- <a href="#" data-modal-chkbackdrop="1" data-reload="1" data-modal-width="" data-behavior="ajax_html_modal" data-url="http://dev.fitnessity.co/checkin/autopay-list?customer_id=380" class="btn" id="resolveButton" style="background-color: #ea1515; border: 1px solid #ea1515; color: #fff; border-radius: 10px;" onclick="closeModal()">Resolve</a>
                                            <a class="btn" id="finishButton" style="background-color: #ea1515; border: 1px solid #ea1515; color: #fff; border-radius: 10px;" href="http://dev.fitnessity.co/checkin/check-out?type=0">Finish</a> --}}
                                            <a href="#" data-modal-chkbackdrop="1" data-reload="1" data-modal-width="" data-behavior="ajax_html_modal" data-url="http://dev.fitnessity.co/checkin/autopay-list?customer_id=380" class="btn" id="resolveButton" style="background-color: {{ $color3 ?: '#ea1515' }}; border: 1px solid {{ $color3 ?: '#ea1515' }}; color: #fff; border-radius: 10px;" onclick="closeModal()">Resolve</a>
                                            <a class="btn" id="finishButton"   style="background-color: {{ $color3 ?: '#ea1515' }}; border: 1px solid {{ $color3 ?: '#ea1515' }}; color: #fff; border-radius: 10px;" href="http://dev.fitnessity.co/checkin/check-out?type=0">Finish</a>
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



{{-- end --}}
@include('layouts.business.footer')
@include('layouts.business.scripts')

   
    <script>
        $('ul#dropzone-preview').on('click', 'button.delete-btn', function() {
        // Remove the parent <li> element when the delete button is clicked
            $(this).closest('li').remove();
        });

        $('ul#dropzone-preview-passcode').on('click', 'button.delete-btn', function() {
        // Remove the parent <li> element when the delete button is clicked
            $(this).closest('li').remove();
        });

        $('ul#dropzone-preview-checkin').on('click', 'button.delete-btn', function() {
        // Remove the parent <li> element when the delete button is clicked
            $(this).closest('li').remove();
        });

    </script>


@endsection
   
@push('scripts')
    <script src="{{asset('/public/dashboard-design/js/dropzone-min.js')}}"></script>
    <!--  <script src="{{asset('/public/dashboard-design/js/ecommerce-product-create.init.js')}}"></script> -->
    <script src="{{asset('/public/dashboard-design/js/dropzoneCover.js')}}"></script>
    <script src="{{asset('/public/dashboard-design/js/dropzonePasscode.js')}}"></script>
    <script src="{{asset('/public/dashboard-design/js/dropzoneCheckin.js')}}"></script>
    <script src="{{asset('/public/dashboard-design/js/pickr.min.js')}}"></script>

    <script>
        $(document).ready(function() {

            const colors = {
                1: '{{ $color1 }}',
                2: '{{ $color2 }}',
                3: '{{ $color3 }}'
            };

            $('.nano-colorpicker').each(function() {
                const pickerElement = $(this)[0];
                const pickerIndex = $(this).data('picker');
                const inputSelector = '#selectedColor' + pickerIndex;
                const defaultColor = colors[pickerIndex] || '#ea1515';

                const pickr = Pickr.create({
                    el: pickerElement,
                    theme: 'nano',
                    default: defaultColor,
                    swatches: [
                        'rgba(244, 67, 54, 1)',
                        'rgba(233, 30, 99, 0.95)',
                        'rgba(156, 39, 176, 0.9)',
                        'rgba(103, 58, 183, 0.85)',
                        'rgba(63, 81, 181, 0.8)',
                        'rgba(33, 150, 243, 0.75)',
                        'rgba(3, 169, 244, 0.7)'
                    ],
                    defaultRepresentation: 'HEXA',
                    components: {
                        preview: true,
                        opacity: true,
                        hue: true,
                        interaction: {
                            hex: false,
                            rgba: false,
                            hsva: false,
                            input: true,
                            clear: true,
                            save: true
                        }
                    }
                });

                pickr.on('save', (color, instance) => {
                    const selectedColor = color.toHEXA().toString();
                    $(inputSelector).val(selectedColor);
                    // $('#exitButton, #checkInButton').css({
                    //     'background-color': selectedColor,
                    //     'border-color': selectedColor
                    // });
                    if (pickerIndex == 1) {
                    $('#exitButton, #checkInButton').css({
                        'background-color': selectedColor,
                        'border-color': selectedColor
                    });
                    } else if (pickerIndex == 2) {
                        $('#passcodeExitButton, #quickCodeButton').css({
                            'background-color': selectedColor,
                            'border-color': selectedColor
                        });
                    }
                    else if (pickerIndex == 3) {
                    $('#resolveButton, #finishButton').css({
                        'background-color': selectedColor,
                        'border-color': selectedColor
                    });
                }
                    pickr.hide(); // Optional: hide the color picker after selection
                });
            });
        });
    </script>
    
</body>

@endpush