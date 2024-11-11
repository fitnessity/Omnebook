@inject('request', 'Illuminate\Http\Request')
@extends('layouts.business.header')

@section('content')
@include('layouts.business.business_topbar')
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

        <!-- ========================= Main ==================== -->
        @include('business.engage-clients.engage_clients_sidebar')

<div id="page-content-wrapper">
    <div class="container-fluid">
        <a href="#menu-toggle" class="btn btn-black mb-15" id="menu-toggle"><i class="fas fa-bars"></i></a>
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-xxl-12">
                        <!-- Nav tabs -->
                        <ul class="nav nav-tabs mb-3" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link" data-bs-toggle="tab" href="#links" role="tab" aria-selected="false">
                                    Links
                                </a>
                            </li>
                        </ul>
                        <!-- Tab panes -->
                        <div class="tab-content  text-muted">
                            <div class="tab-pane" id="widgets" role="tabpanel">
                                <div class="row">
                                    <div class="col-xl-12">
                                        <div class="">
                                            <div class="card-header align-items-center d-flex">
                                                <h4 class="card-title mb-0 flex-grow-1">Widgets</h4>
                                            </div><!-- end card header -->
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-sm-auto">
                                                        <div class="dropdown mb-25">
                                                            <button class="btn btn-red dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                                                Create New Widget
                                                            </button>
                                                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                                                <a class="dropdown-item" href="http://dev.fitnessity.co/design/registration_widget">Registration Widget</a>
                                                                <a class="dropdown-item" href="http://dev.fitnessity.co/design/schedule_widget">Schedule Widget</a>
                                                                <a class="dropdown-item" href="#">Enrollment Widget</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-auto">
                                                        <div class="mb-25">
                                                            <button href="#" class="btn btn-black">Refresh Widget Data</button>
                                                        </div>                                                           
                                                    </div>                                                        
                                                </div>
                                                <div class="live-preview">
                                                    <div class="table-responsive">
                                                        <table class="table align-middle table-nowrap mb-0">
                                                            <thead>
                                                                <tr>
                                                                    <th scope="col">Widget Title</th>
                                                                    <th scope="col">Type</th>
                                                                    <th scope="col">Deployed</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <tr>
                                                                    <th scope="row"><a href="http://dev.fitnessity.co/design/schedule_widget">Fall 2021 to 2022 Schedule</a></th>
                                                                    <td>Schedule</td>
                                                                    <td></td>
                                                                </tr>
                                                                <tr>
                                                                    <th scope="row"><a href="#">Login / Register (Default Registration Widget)</a></th>
                                                                    <td>Registration</td>
                                                                    <td></td>
                                                                </tr>
                                                                <tr>
                                                                    <th scope="row"><a href="#">Upcoming Events </a></th>
                                                                    <td>Enrollment</td>
                                                                    <td></td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>

                                            </div><!-- end card-body -->
                                        </div><!-- end card -->
                                    </div> <!-- end col -->
                                </div>
                            </div>
                            <div class="tab-pane  active" id="links" role="tabpanel">
                                <div class="card bg-soft-grey">
                                    <div class="card-header align-items-center d-flex bg-soft-grey">
                                        <h4 class="card-title mb-0 flex-grow-1">Create your link</h4>
                                    </div>
                                    <div class="card-body">
                                        <div class="live-preview">
                                            <div class="row ">
                                                <div class="col-lg-3">
                                                    <div class="mt-3 filter-check">
                                                        <label for="">Link type</label>
                                                        <select class="form-select mb-3" id="selectField">
                                                            <option selected="selected">Select...</option>
                                                            <option value="login">Login</option>     
                                                            <option value="register">Register</option>  
                                                            <option value="booking">Booking Schedule</option>
                                                        </select>
                                                        {{-- <select class="form-select mb-3" id="selectField">
                                                            <option value="select" {{ session('message') != 'login' && session('message') != 'register' && session('message') != 'booking' ? 'selected' : '' }}>Select...</option>
                                                            <option value="login" {{ session('message') == 'login' ? 'selected' : '' }}>Login</option>
                                                            <option value="register" {{ session('message') == 'register' ? 'selected' : '' }}>Register</option>
                                                            <option value="booking" {{ session('message') == 'booking' ? 'selected' : '' }}>Booking Schedule</option>
                                                        </select> --}}
                                                        
                                                    </div>
                                                </div>                                                  
                                            </div>
                                            <div id="login" class="lrcontent">
                                                    <div class="row">
                                                            <div class="col-lg-12">
                                                                <form action="{{route('business.login_details')}}" method="POST" enctype="multipart/form-data">
                                                                    @csrf
                                                                  <div class="row">                                                                    
                                                                      <div class="col-lg-6">
                                                                          <div class="card">
                                                                              <div class="card-body">
                                                                                  <div class="row">
                                                                                      <div class="col-12">
                                                                                          <div class="mt-3 filter-check">
                                                                                              <label for="">Button Text Color</label>
                                                                                          </div>
                                                                                          <div class="d-flex flex-wrap gap-2">
                                                                                              <div class="pickr">
                                                                                                  <div class="nano-colorpicker" data-picker="1"></div>
                                                                                                  <input type="hidden" id="selectedColor1" name="text_color" value="{{$color1}}">

                                                                                                  <!-- <button type="button" class="pcr-button" role="button" aria-label="toggle color picker dialog" style="--pcr-color: rgba(156, 39, 176, 1);"></button>  -->
                                                                                              </div>
                                                                                          </div>
                                                                                      </div>
                                                                                      <div class="col-12" >
                                                                                          <div class="mt-3 filter-check">
                                                                                              <label for="">Button Color</label>
                                                                                          </div>
                                                                                          <div class="d-flex flex-wrap gap-2">
                                                                                              <div class="pickr">
                                                                                                  <div class="nano-colorpicker" data-picker="2"></div>
                                                                                                  <input type="hidden" id="selectedColor2" name="background_color" value="{{$color2}}">

                                                                                                  <!-- <button type="button" class="pcr-button" role="button" aria-label="toggle color picker dialog" style="--pcr-color: rgba(244, 67, 54, 1);"></button> -->
                                                                                              </div>
                                                                                          </div>
                                                                                      </div>
                                                                                     
                                                                                  </div>
                                                                                  <div class="row">
                                                                                      <div class="col-lg-12 col-md-12 col-12">
                                                                                          <div class="mt-3 filter-check">
                                                                                              <label for="">Upload Logo</label>
                                                                                          </div>
                                                                                      </div>

                                                                                      <div class="col-lg-6">
                                                                                          <div class="profile-user position-relative mx-auto mb-2">
                                                                                              {{-- <img src="{{asset('images/fitnessity_logo1_black.png')}}" class="avatar-lg img-thumbnail user-profile-image shadow" alt="upload-image"> --}}
                                                                                              @if($logoUrl)
                                                                                              <img src="{{ $logoUrl }}" class="avatar-lg img-thumbnail user-profile-image shadow" alt="upload-image">
                                                                                            @else
                                                                                                <img src="{{ asset('images/fitnessity_logo1_black.png') }}" class="avatar-lg img-thumbnail user-profile-image shadow" alt="default-logo">
                                                                                            @endif
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
                                                                                  </div>
                                                                              </div>
                                                                          </div>
                                                                      </div>
                                                                      <div class="col-lg-6">
                                                                          <div class="card">
                                                                              <div class="card-header">
                                                                                  
                                                                                  <div class="row">
                                                                                      <div class="col-lg-6">
                                                                                          <h4 class="card-title mb-0">Upload Login screen photo</h4>
                                                                                      </div>
                                                                                      <div class="col-lg-6">
                                                                                          <div class="text-right">
                                                                                              <a href="" data-bs-toggle="modal" data-bs-target="#login_preview">Preview</a>
                                                                                          </div>
                                                                                      </div>
                                                                                  </div>
                                                                              </div>
                                                                              <!-- end card header -->
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
                                                                                          <input type="hidden" name="cover" value="">
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
                                                                                      @if(@$data->background_img)
                                                                                      <li class="mt-2" id="ddropzone-preview">
                                                                                          <input type="hidden" name="cover" value="{{$data->background_img}}">
                                                                                          <div class="border rounded">
                                                                                              <div class="d-flex p-2">
                                                                                                  <div class="flex-shrink-0 me-3">
                                                                                                      <div class="avatar-sm bg-light rounded product-display">
                                                                                                          <img class="img-fluid rounded d-block" src="{{Storage::URL($data->background_img)}}" alt="Product-Image"  loading="lazy"/>
                                                                                                      </div>
                                                                                                  </div>
                                                                                                  <div class="flex-grow-1">
                                                                                                      <div class="pt-1">
                                                                                                          <h5 class="fs-14 mb-1">&nbsp;{{basename($data->background_img)}}</h5>
                                                                                                      </div>
                                                                                                  </div>
                                                                                                  <div class="flex-shrink-0 ms-3">
                                                                                                      {{-- <button class="btn btn-sm btn-danger delete-btn" type="button">Delete</button> --}}
                                                                                                      <div class="flex-shrink-0 ms-3">
                                                                                                        <button class="btn btn-sm btn-danger delete-btn" data-id="{{ $data->id }}" type="button">Delete</button>
                                                                                                    </div>
                                                                                                    
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
                                                                      </div>
                                                                  </div>
                                                                    <button type="submit" class="btn btn-black">Save and Deploy</button>
                                                                </form>
                                                            </div>
                                                    </div>
                                            </div>
                                            <div id="register" class="lrcontent">
                                                    <div class="row">
                                                        <div class="col-xl-3 col-lg-4">
                                                            <form action="{{route('business.register_details')}}" method="POST" enctype="multipart/form-data">
                                                            @csrf
                                                                <div class="card">
                                                                    <div class="card-header">
                                                                        <div class="d-flex">
                                                                            <div class="flex-grow-1">
                                                                                <h5 class="fs-16">Registration Link Settings</h5>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="accordion accordion-flush filter-accordion">
                                                                        <div class="accordion-item">
                                                                            <h2 class="accordion-header" id="flush-headingBrands">
                                                                                <button class="accordion-button bg-transparent shadow-none" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseBrands" aria-expanded="true" aria-controls="flush-collapseBrands">
                                                                                    <span class="text-muted text-uppercase fs-12 fw-medium">Style</span> <span class="badge bg-success rounded-pill align-middle ms-1 filter-badge"></span>
                                                                                </button>
                                                                            </h2>
                                                                            <div id="flush-collapseBrands" class="accordion-collapse collapse show" aria-labelledby="flush-headingBrands">
                                                                                <div class="accordion-body text-body pt-0">
                                                                                    <div class="gap-2 mt-3 filter-check">
                                                                                        <label for="">Colors</label>
                                                                                        <p>By not setting a color, the defaults will be used.</p>
                                                                                        <label for="">Text Color</label>
                                                                                        <div class="pickr mb-15">
                                                                                            <div class="nano-colorpicker" data-picker="3"></div>
                                                                                            <input type="hidden" id="selectedColor3" name="reg_text_color" value="{{$color5}}">
                                                                                        </div>
                                                                                        <label for="">Button Background</label>
                                                                                        <div class="pickr mb-15">
                                                                                            <div class="nano-colorpicker" data-picker="4"></div>
                                                                                            <input type="hidden" id="selectedColor4" name="reg_bg_color" value="{{$color4}}">
                                                                                        </div>

                                                                                        <label for="">Background</label>
                                                                                        <div class="pickr mb-15">
                                                                                            <div class="nano-colorpicker" data-picker="7"></div>
                                                                                            <input type="hidden" id="selectedColor7" name="backreg_color" value="{{$color8}}">
                                                                                        </div>
                                                                                    </div>
                                                                                </div>                                    
                                                                            </div>
                                                                        </div>
                                                                        <!-- end accordion-item -->    
                                                                        <div class="accordion-item">
                                                                            <h2 class="accordion-header" id="flush-headingDiscount">
                                                                                <button class="accordion-button bg-transparent shadow-none collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseDiscount" aria-expanded="true" aria-controls="flush-collapseDiscount">
                                                                                    <span class="text-muted text-uppercase fs-12 fw-medium">Content</span> <span class="badge bg-success rounded-pill align-middle ms-1 filter-badge"></span>
                                                                                </button>
                                                                            </h2>
                                                                            <div id="flush-collapseDiscount" class="accordion-collapse collapse" aria-labelledby="flush-headingDiscount">
                                                                                <div class="accordion-body text-body pt-1">
                                                                                    <div class="gap-2 mt-3 filter-check">
                                                                                        <label for="">Send Email Notifications</label>
                                                                                        <div>
                                                                                            <button href="#" class="btn btn-red mb-15"><i class="ri-add-line align-bottom me-1"></i> Add an email</button>  
                                                                                            <p>When a new registration is added or a duplicate email is detected, we will send a notification email to these addresses. </p>
                                                                                        </div>                                                                                  
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <!-- end accordion-item -->                            
                                                                        <div class="accordion-item">
                                                                            <h2 class="accordion-header" id="flush-headingRating">
                                                                                <button class="accordion-button bg-transparent shadow-none collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseRating" aria-expanded="false" aria-controls="flush-collapseRating">
                                                                                    <span class="text-muted text-uppercase fs-12 fw-medium">Region</span> <span class="badge bg-success rounded-pill align-middle ms-1 filter-badge"></span>
                                                                                </button>
                                                                            </h2>

                                                                            <div id="flush-collapseRating" class="accordion-collapse collapse" aria-labelledby="flush-headingRating">
                                                                                <div class="accordion-body text-body">
                                                                                    {{-- <div class="gap-2 filter-check">
                                                                                        <label for="">Language</label>
                                                                                        <select class="form-select mb-3" aria-label="Default select example">
                                                                                            <option selected="">English </option>
                                                                                            <option value="1">Hindi </option>
                                                                                            <option value="2">Arabela </option>
                                                                                            <option value="3">Egyptian Arabic </option>
                                                                                            <option value="3">Auslan </option>
                                                                                        </select>
                                                                                    </div> --}}
                                                                                    <div class="gap-2 filter-check">
                                                                                        <label for="">Default Selected Country</label>
                                                                                        <select class="form-select mb-3" aria-label="Default select example" name="country">
                                                                                            <option value="United States" {{ isset($data) && $data->default_country == 'United States' ? 'selected' : '' }}>United States</option>
                                                                                            <option value="Canada" {{ isset($data) && $data->default_country == 'Canada' ? 'selected' : '' }}>Canada</option>
                                                                                            <option value="India" {{ isset($data) && $data->default_country == 'India' ? 'selected' : '' }}>India</option>
                                                                                        </select>
                                                                                    </div>
                                                                                    
                                                                                    <div class="gap-2 filter-check">
                                                                                        <label for="">Default Selected State</label>
                                                                                        <select class="form-select mb-3" aria-label="Default select example" name="state"> 
                                                                                            <option value="" {{ $selectedState == '' ? 'selected' : '' }}>None Selected</option>
                                                                                            {{-- <option selected="">None Selected </option> --}}
                                                                                                       <!-- United States -->
                                                                                            <optgroup label="United States">
                                                                                                <option value="AL" {{ $selectedState == 'AL' ? 'selected' : '' }}>Alabama</option>
                                                                                                <option value="AK" {{ $selectedState == 'AK' ? 'selected' : '' }}>Alaska</option>
                                                                                                <option value="AZ" {{ $selectedState == 'AZ' ? 'selected' : '' }}>Arizona</option>
                                                                                                <option value="AR" {{ $selectedState == 'AR' ? 'selected' : '' }}>Arkansas</option>
                                                                                                <option value="CA" {{ $selectedState == 'CA' ? 'selected' : '' }}>California</option>
                                                                                                <option value="CO" {{ $selectedState == 'CO' ? 'selected' : '' }}>Colorado</option>
                                                                                                <option value="CT" {{ $selectedState == 'CT' ? 'selected' : '' }}>Connecticut</option>
                                                                                                <option value="DE" {{ $selectedState == 'DE' ? 'selected' : '' }}>Delaware</option>
                                                                                                <option value="FL" {{ $selectedState == 'FL' ? 'selected' : '' }}>Florida</option>
                                                                                                <option value="GA" {{ $selectedState == 'GA' ? 'selected' : '' }}>Georgia</option>
                                                                                                <option value="HI" {{ $selectedState == 'HI' ? 'selected' : '' }}>Hawaii</option>
                                                                                                <option value="ID" {{ $selectedState == 'ID' ? 'selected' : '' }}>Idaho</option>
                                                                                                <option value="IL" {{ $selectedState == 'IL' ? 'selected' : '' }}>Illinois</option>
                                                                                                <option value="IN" {{ $selectedState == 'IN' ? 'selected' : '' }}>Indiana</option>
                                                                                            </optgroup>
                                                                                            <!-- Canada -->
                                                                                            <optgroup label="Canada">
                                                                                                <option value="AB" {{ $selectedState == 'AB' ? 'selected' : '' }}>Alberta</option>
                                                                                                <option value="BC" {{ $selectedState == 'BC' ? 'selected' : '' }}>British Columbia</option>
                                                                                                <option value="MB" {{ $selectedState == 'MB' ? 'selected' : '' }}>Manitoba</option>
                                                                                                <option value="NB" {{ $selectedState == 'NB' ? 'selected' : '' }}>New Brunswick</option>
                                                                                                <option value="NL" {{ $selectedState == 'NL' ? 'selected' : '' }}>Newfoundland and Labrador</option>
                                                                                                <option value="NS" {{ $selectedState == 'NS' ? 'selected' : '' }}>Nova Scotia</option>
                                                                                                <option value="NT" {{ $selectedState == 'NT' ? 'selected' : '' }}>Northwest Territories</option>
                                                                                                <option value="NU" {{ $selectedState == 'NU' ? 'selected' : '' }}>Nunavut</option>
                                                                                                <option value="ON" {{ $selectedState == 'ON' ? 'selected' : '' }}>Ontario</option>
                                                                                                <option value="PE" {{ $selectedState == 'PE' ? 'selected' : '' }}>Prince Edward Island</option>
                                                                                                <option value="QC" {{ $selectedState == 'QC' ? 'selected' : '' }}>Quebec</option>
                                                                                                <option value="SK" {{ $selectedState == 'SK' ? 'selected' : '' }}>Saskatchewan</option>
                                                                                                <option value="YT" {{ $selectedState == 'YT' ? 'selected' : '' }}>Yukon</option>
                                                                                            </optgroup>
                                                                                            <!-- India -->
                                                                                            <optgroup label="India">
                                                                                                <option value="AP" {{ $selectedState == 'AP' ? 'selected' : '' }}>Andhra Pradesh</option>
                                                                                                <option value="AR" {{ $selectedState == 'AR' ? 'selected' : '' }}>Arunachal Pradesh</option>
                                                                                                <option value="AS" {{ $selectedState == 'AS' ? 'selected' : '' }}>Assam</option>
                                                                                                <option value="BR" {{ $selectedState == 'BR' ? 'selected' : '' }}>Bihar</option>
                                                                                                <option value="CT" {{ $selectedState == 'CT' ? 'selected' : '' }}>Chhattisgarh</option>
                                                                                                <option value="GA" {{ $selectedState == 'GA' ? 'selected' : '' }}>Goa</option>
                                                                                                <option value="GJ" {{ $selectedState == 'GJ' ? 'selected' : '' }}>Gujarat</option>
                                                                                                <option value="HR" {{ $selectedState == 'HR' ? 'selected' : '' }}>Haryana</option>
                                                                                                <option value="HP" {{ $selectedState == 'HP' ? 'selected' : '' }}>Himachal Pradesh</option>
                                                                                                <option value="JK" {{ $selectedState == 'JK' ? 'selected' : '' }}>Jammu and Kashmir</option>
                                                                                                <option value="JH" {{ $selectedState == 'JH' ? 'selected' : '' }}>Jharkhand</option>
                                                                                                <option value="KA" {{ $selectedState == 'KA' ? 'selected' : '' }}>Karnataka</option>
                                                                                                <option value="KL" {{ $selectedState == 'KL' ? 'selected' : '' }}>Kerala</option>
                                                                                                <option value="MP" {{ $selectedState == 'MP' ? 'selected' : '' }}>Madhya Pradesh</option>
                                                                                                <option value="MH" {{ $selectedState == 'MH' ? 'selected' : '' }}>Maharashtra</option>
                                                                                                <option value="MN" {{ $selectedState == 'MN' ? 'selected' : '' }}>Manipur</option>
                                                                                                <option value="ML" {{ $selectedState == 'ML' ? 'selected' : '' }}>Meghalaya</option>
                                                                                                <option value="MZ" {{ $selectedState == 'MZ' ? 'selected' : '' }}>Mizoram</option>
                                                                                                <option value="NL" {{ $selectedState == 'NL' ? 'selected' : '' }}>Nagaland</option>
                                                                                                <option value="OD" {{ $selectedState == 'OD' ? 'selected' : '' }}>Odisha</option>
                                                                                                <option value="PB" {{ $selectedState == 'PB' ? 'selected' : '' }}>Punjab</option>
                                                                                                <option value="RJ" {{ $selectedState == 'RJ' ? 'selected' : '' }}>Rajasthan</option>
                                                                                                <option value="SK" {{ $selectedState == 'SK' ? 'selected' : '' }}>Sikkim</option>
                                                                                                <option value="TN" {{ $selectedState == 'TN' ? 'selected' : '' }}>Tamil Nadu</option>
                                                                                                <option value="TS" {{ $selectedState == 'TS' ? 'selected' : '' }}>Telangana</option>
                                                                                                <option value="TR" {{ $selectedState == 'TR' ? 'selected' : '' }}>Tripura</option>
                                                                                                <option value="UP" {{ $selectedState == 'UP' ? 'selected' : '' }}>Uttar Pradesh</option>
                                                                                                <option value="UT" {{ $selectedState == 'UT' ? 'selected' : '' }}>Uttarakhand</option>
                                                                                                <option value="WB" {{ $selectedState == 'WB' ? 'selected' : '' }}>West Bengal</option>
                                                                                            </optgroup>
                                                                                        </select>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div> 
                                                                        <!-- end accordion-item -->
                                                                    </div>
                                                                    <div class="card-footer">
                                                                        <div class="d-flex mt-3 mb-3">
                                                                            <div class="flex-grow-1">
                                                                                {{-- <a href="http://dev.fitnessity.co/design/deploy_widget" class="btn btn-black w-100">Save and Deploy</a> --}}
                                                                                <button class="btn btn-black w-100">Save and Deploy</button>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </form>
                                                        </div>
                                                        <div class="col-xl-9 col-lg-8">
                                                            <div class="card" id="preview_reg_color" style="background-color: {{ $color8 }}">
                                                                <div class="card-header align-items-center d-flex">
                                                                    <h4 class="card-title mb-0 flex-grow-1">Preview</h4>
                                                                    <div class="flex-shrink-0">
                                                                        <div>
                                                                        </div>
                                                                        <!-- <div class="form-check form-switch form-switch-right form-switch-md">
                                                                            <label for="dropdown-base-example" class="form-label text-muted">Preview Size</label>
                                                                            <input class="form-check-input code-switcher" type="checkbox" id="dropdown-base-example">
                                                                        </div> -->
                                                                    </div>
                                                                </div><!-- end card header -->
                                                                <div class="card-body">
                                                                    <div class="live-preview">
                                                                        <div class="row justify-content-md-center">
                                                                            <div class="col-lg-10">
                                                                                <form action="">
                                                                                    <div class="row">
                                                                                        <div class="col-md-12 col-lg-12"><h4 class="font-red" id="personal" style="color: {{ $color3 ?: '#EA1515' }};">Personal Info</h4></div>
                                                                                        <div class="col-md-4 col-lg-3">
                                                                                            <label class="mt-10 ">First Name<span id="star">*</span></label>
                                                                                            <input type="text" name="firstname" id="firstname" size="30" maxlength="80" class="form-control">
                                                                                        </div>
                                                                                        <div class="col-md-4 col-lg-3">
                                                                                            <label class="mt-10">Last Name<span id="star">*</span></label>
                                                                                            <input type="text" name="lastname" id="lastname" size="30" maxlength="80" class="form-control">
                                                                                        </div>
                                                                                        <div class="col-md-4 col-lg-3">
                                                                                            <label class="mt-10">Email<span id="star">*</span></label>
                                                                                            <input type="email" name="email" id="email" class="myemail form-control" size="30" maxlength="80" autocomplete="off">
                                                                                        </div>
                                                                                        <div class="col-md-4 col-lg-3">
                                                                                            <label class="mt-10">Birthday<span id="star">*</span></label>
                                                                                            <input type="hidden" class="form-control add-client-birthdate flatpickr-input" id="dob" name="dob"><input class="form-control add-client-birthdate form-control input" placeholder="" tabindex="0" type="text" readonly="readonly">
                                                                                        </div>

                                                                                        <div class="col-md-4 col-lg-3">
                                                                                            <label class="mt-10">Phone <span id="star">*</span></label>
                                                                                            <input type="text" name="contact" id="contact" size="30" maxlength="14" autocomplete="off" onkeypress="return event.charCode >= 48 &amp;&amp; event.charCode <= 57" data-behavior="text-phone" class="form-control">
                                                                                        </div>

                                                                                        <div class="col-md-4 col-lg-3">
                                                                                            <label class="mt-10">Gender<span id="star">*</span></label>
                                                                                            <select class="form-control" name="gender">
                                                                                                <option value="male">Male</option>
                                                                                                <option value="female">Female</option>
                                                                                                <option value="other">Other</option>
                                                                                            </select>
                                                                                        </div>
                                                                                                    
                                                                                        <div class="col-md-4 col-lg-3">
                                                                                            <div class="form-group check-box-info ">
                                                                                                <input class="check-box-primary-account" type="checkbox" id="primaryAccountHolder" name="primaryAccountHolder" value="1">
                                                                                                <label for="primaryAccountHolder"> Primary Account <span class="" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-original-title="You are paying for yourself and all added family members.">(i)</span></label>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="add-client-sapre-tor"></div>

                                                                                    <div class="row">
                                                                                        <div class="col-md-12 col-lg-12"><h4 class="font-red" id="address" style="color: {{ $color3 ?: '#EA1515' }};">Address</h4></div>
                                                                                        <div class="col-md-4 col-lg-3 mt-10">
                                                                                            <label >Address <span id="star">*</span></label>
                                                                                            <input type="text" class="form-control pac-target-input" autocomplete="off" name="address" id="addressCustomer" value="" required="" oninput="initMapCall('addressCustomer', 'cityCustomer', 'stateCustomer', 'countryCustomer', 'zipcodeCustomer', 'latitudeCustomer', 'longitudeCustomer')" aria-required="true"> 
                                                                                        </div>
                                                                                        <div class="col-md-4 col-lg-3 mt-10">
                                                                                            <label for="City">City <span id="star">*</span></label>
                                                                                            <input type="text" class="form-control" name="city" id="cityCustomer" size="30" maxlength="50" value="" required="" aria-required="true">
                                                                                        </div>
                                                                                        <input type="hidden" name="lon" id="longitudeCustomer" value="">
                                                                                        <input type="hidden" name="lat" id="latitudeCustomer" value="">

                                                                                        <div class="col-md-4 col-lg-3 mt-10">
                                                                                            <label for="state">State <span id="star">*</span></label>
                                                                                            <input type="text" class="form-control" name="state" id="stateCustomer" size="30" maxlength="50" value="" required="" aria-required="true">
                                                                                        </div>
                                                                                        <div class="col-md-4 col-lg-3 mt-10">
                                                                                            <label for="country">Country <span id="star">*</span></label>
                                                                                            <input type="text" class="form-control" name="country" id="countryCustomer" size="30" maxlength="50" value="" required="" aria-required="true">
                                                                                        </div> 

                                                                                        <div class="col-md-4 col-lg-3 mt-10">
                                                                                            <label for="zipcode">Zip Code <span id="star">*</span></label>
                                                                                            <input type="text" class="form-control" name="zipcode" id="zipcodeCustomer" size="30" maxlength="50" value="" required="" aria-required="true">
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="add-client-sapre-tor"></div>
                                                                                    <div class="row">
                                                                                        <div class="col-md-12 col-lg-12 mt-20"><h4 class="font-red" id="family_mem" style="color: {{ $color3 ?: '#EA1515' }};">Add Family Members (Optional)</h4></div>
                                                                                        <div class="error mb-10" id="familyerrormessage"></div>
                                                                                        <input type="hidden" name="familycnt" id="familycnt" value="0">
                                                                                        <div id="familymaindiv">
                                                                                            <div class="new-client mb-10" id="familydiv0" data-i="0" data-text="1">
                                                                                                <div class="accordion" id="default-accordion-example">
                                                                                                    <div class="accordion-item shadow">
                                                                                                        <h2 class="accordion-header" id="heading0">
                                                                                                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse0" aria-expanded="false" aria-controls="collapse0">
                                                                                                                <div class="container-fluid nopadding">
                                                                                                                    <div class="row"> 
                                                                                                                        <div class="col-lg-6 col-md-6 col-8"> Family Member #1 </div> 
                                                                                                                        <div class="col-lg-6 col-md-6 col-4"> 
                                                                                                                            <div class="multiple-options" id="deletediv0"> </div> 
                                                                                                                        </div> 
                                                                                                                    </div>
                                                                                                                </div>
                                                                                                            </button>
                                                                                                        </h2>
                                                                                                        <div id="collapse0" class="accordion-collapse collapse" aria-labelledby="heading0" data-bs-parent="#default-accordion-example" style="">
                                                                                                            <div class="accordion-body">
                                                                                                                <div class="row">
                                                                                                                    <div class="col-md-4 col-lg-3">
                                                                                                                        <label class="mt-10">First Name</label>
                                                                                                                        <input type="text" name="fname[]" id="fname" class="form-control required" aria-required="true">
                                                                                                                        <span class="error" id="err_fname"></span>
                                                                                                                    </div>
                                                                                                                    <div class="col-md-4 col-lg-3">
                                                                                                                        <label class="mt-10">Last Name</label>
                                                                                                                        <input type="text" name="lname[]" id="lname" class="form-control required" aria-required="true">
                                                                                                                        <span class="error" id="err_lname"></span>
                                                                                                                    </div>
                                                                                                                    <div class="col-md-4 col-lg-3">
                                                                                                                        <label class="mt-10">Birthday</label>
                                                                                                                        <input type="text" class="form-control" name="birthdate[]" id="birthdate">
                                                                                                                    </div>
                                                                                                                    <div class="col-md-4 col-lg-3">
                                                                                                                        <label class="mt-10">Gender</label>
                                                                                                                        <select name="familygender[]" id="gender" class="form-select gender" required="" aria-required="true">
                                                                                                                            <option value="male">Male</option>
                                                                                                                            <option value="female">Female</option>
                                                                                                                            <option value="other">Specify other</option>
                                                                                                                        </select>
                                                                                                                        <span class="error" id="err_gender"></span>
                                                                                                                    </div>
                                                                                                                    <div class="col-md-4 col-lg-3">
                                                                                                                        <label class="mt-10">Relationship</label>
                                                                                                                        <select name="relationship[]" id="relationship" class="form-select relationship required" aria-required="true">
                                                                                                                            <option value="">Select Relationship</option>
                                                                                                                            <option value="Brother">Brother</option>
                                                                                                                            <option value="Sister">Sister</option>
                                                                                                                            <option value="Father">Father</option>
                                                                                                                            <option value="Mother">Mother</option>
                                                                                                                            <option value="Wife">Wife</option>
                                                                                                                            <option value="Husband">Husband</option>
                                                                                                                            <option value="Son">Son</option>
                                                                                                                            <option value="Daughter">Daughter</option>
                                                                                                                        </select>
                                                                                                                        <span class="error" id="err_relationship"></span>
                                                                                                                    </div>
                                                                                                                    <div class="col-md-4 col-lg-3">
                                                                                                                        <label class="mt-10">Phone</label>
                                                                                                                        <input maxlength="14" type="text" name="mphone[]" id="mphone" class="form-control mobile_number" onkeypress="return event.charCode >= 48 &amp;&amp; event.charCode <= 57" data-behavior="text-phone">
                                                                                                                        <span class="error" id="err_mphone"></span>
                                                                                                                    </div>
                                                                                                                    <div class="col-md-4 col-lg-3">
                                                                                                                        <label class="mt-10">Email</label>
                                                                                                                        <input type="email" name="emailid[]" id="emailid" class="form-control email" required="" aria-required="true">
                                                                                                                        <span class="error" id="err_emailid"></span>
                                                                                                                    </div>
                                                                                                                    <div class="col-md-4 col-lg-3">
                                                                                                                        <label class="mt-10">Emergency Name</label>
                                                                                                                        <input type="text" name="emergency_name[]" id="emergency_name" class="form-control emergency_name">
                                                                                                                        <span class="error" id="err_emergency_name"></span>
                                                                                                                    </div>
                                                                                                                    <div class="col-md-4 col-lg-3">
                                                                                                                        <label class="mt-10">Emergency Phone</label>
                                                                                                                        <input maxlength="14" type="text" name="emergency_phone[]" id="emergency_phone" class="form-control emergency_phone" onkeypress="return event.charCode >= 48 &amp;&amp; event.charCode <= 57" data-behavior="text-phone">
                                                                                                                        <span class="error" id="err_emergency_phone"></span>
                                                                                                                    </div>
                                                                                                                    <div class="col-md-4 col-lg-3">
                                                                                                                        <label class="mt-10">Emergency Email</label>
                                                                                                                        <input type="text" name="emergency_email[]" id="emergency_email" class="form-control emergency_email">
                                                                                                                        <span class="error" id="err_emergency_email"></span>
                                                                                                                    </div>
                                                                                                                    <div class="col-md-4 col-lg-3">
                                                                                                                        <label class="mt-10">Emergency Relation</label>
                                                                                                                        <select name="emergency_relation[]" id="emergency_relation" class="form-select emergency_relation">
                                                                                                                            <option value="">Select Emergency Relationship</option>
                                                                                                                            <option value="Brother">Brother</option>
                                                                                                                            <option value="Sister">Sister</option>
                                                                                                                            <option value="Father">Father</option>
                                                                                                                            <option value="Mother">Mother</option>
                                                                                                                            <option value="Wife">Wife</option>
                                                                                                                            <option value="Husband">Husband</option>
                                                                                                                            <option value="Son">Son</option>
                                                                                                                            <option value="Daughter">Daughter</option>
                                                                                                                        </select>
                                                                                                                        <span class="error" id="err_emergency_relation"></span>
                                                                                                                    </div>
                                                                                                                    <div class="col-md-4 col-lg-3"> 
                                                                                                                        <div class="form-group check-box-info">
                                                                                                                            <input class="check-box-primary-account primaryAcCheck" type="checkbox" id="primaryAccount" name="primaryAccount" value="1">
                                                                                                                            <label for="primaryAccount"> Primary Account <span class="" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-original-title="Choose the primary account holder to determine whose card covers bookings for up to two family members (e.g., Mom or Dad). All cards stored under the primary account will be available at checkout.">(i)</span></label>
                                                                                                                        </div>
                                                                                                                    </div>
                                                                                                                </div>
                                                                                                            </div>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="">
                                                                                            <div class="col-md-12 col-lg-12 text-right">
                                                                                                <button type="button" class="btn btn-red mt-10" id="add_family"  style="background-color: {{ $color4 ?: '#ea1515' }}; border: 1px solid {{ $color4 ?: '#ea1515' }}; color: {{ $color3 ?: '#fff' }};">Add New Family Member</button>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="add-client-sapre-tor"></div>
                                                                                    <div class="row">
                                                                                        <div class="col-md-12 col-lg-12 mt-20"><h4 class="font-red" id="about" style="color: {{ $color3 ?: '#EA1515' }};">How did you hear about us</h4></div>
                                                                                        <div class="row">
                                                                                            <div class="col-md-4 col-lg-4 mt-10">
                                                                                                <label class="mt-10">How did you hear about us?</label>
                                                                                                <select class="form-select" name="know_from">
                                                                                                    <option value="male">Search engine (Google, Bing, etc)</option>
                                                                                                    <option value="Google maps search">Google maps search</option>
                                                                                                    <option value="Referral">Referral</option>
                                                                                                    <option value="Social media">Social media</option>
                                                                                                    <option value="Online communities / forums">Online communities / forums</option>
                                                                                                    <option value="Online advertisement">Online advertisement</option>
                                                                                                    <option value="Offine advertisement">Offine advertisement</option>
                                                                                                    <option value="Noticed the physical location">Noticed the physical location</option>
                                                                                                    <option value="Website">Website</option>
                                                                                                    <option value="Event">Event</option>
                                                                                                    <option value="School">School</option>
                                                                                                    <option value="Other">Other</option>
                                                                                                </select>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="add-client-sapre-tor"></div>
                                                                                    <div class="row">
                                                                                        <div class="col-md-12 col-lg-12 mt-20"><h4 class="font-red" id="accounts_pass" style="color: {{ $color3 ?: '#EA1515' }};">Account Password</h4></div>
                                                                                        <div class="row">
                                                                                            <label class="mt-10">Please pick a password to log-in to your account later.</label>
                                                                                            <div class="col-md-4 col-lg-3 mt-10">
                                                                                                <label class="mt-10">Password</label>
                                                                                                <input type="text" name="password" id="password" class="form-control">
                                                                                            </div>
                                                                                            <div class="col-md-4 col-lg-3 mt-10">
                                                                                                <label class="mt-10">Confirm Password</label>
                                                                                                <input type="text" name="confirmpassword" id="confirmpassword" class="form-control">
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="add-client-sapre-tor"></div>
                                                                                    <div class="row"> 
                                                                                        <div class="col-md-12 col-lg-12 mt-20">
                                                                                            <h4 class="font-red" id="agree_terms" style="color: {{ $color3 ?: '#EA1515' }};"> Agree to Terms, Waiver &amp; Contract Signature</h4>
                                                                                        </div>
                                                                                        <div class="col-md-12">
                                                                                            <div class="col-lg-12" id="termsdiv">
                                                                                                <div class="terms-head">
                                                                                                    <div>
                                                                                                        <a href="#" data-url="http://dev.fitnessity.co/getTerms?id=29&amp;termsType=refundpolicytext&amp;termsHeader=Refund%20Policy" class="font-13 color-red-a" data-behavior="termsModelOpen">Refund Policy</a> 
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                        <label class="mt-10">To continue, please read the terms &amp; waivers above. A signature is required to participate. </label>
                                                                                        <div class="row">
                                                                                            <div class="col-lg-12">
                                                                                                <canvas id="signatureCanvas" name="signatureCanvas"></canvas>
                                                                                                <input type="hidden" name="signpath" id="signpath" value="">
                                                                                            </div>
                                                                                            <div class="col-lg-12">
                                                                                                <div class="col-md-4 col-lg-3 col-lg-3">
                                                                                                    <button type="button" id="clearButton" class="btn btn-primary btn-black"  style="background-color: {{ $color4 ?: '#ea1515' }}; border: 1px solid {{ $color4 ?: '#ea1515' }}; color: {{ $color3 ?: '#fff' }};">Clear</button>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="row">
                                                                                        <div class="col-md-12 col-lg-12 text-center">
                                                                                            <div class="wrap-sp">
                                                                                                <input type="checkbox" name="b_trm1" id="b_trm1" class="form-check-input" value="1">
                                                                                                <label for="b_trm1" class="text-center">I agree to Fitnessity Terms of Service and Privacy Policy</label>
                                                                                            </div>
                                                                                            <div id="termserror" class="font-red fs-15 text-center mb-10"></div>
                                                                                            <div id="systemMessage" class="mb-10 fs-15 mb-10"></div>
                                                                                        </div>
                                                                                        <div class="col-md-12 col-lg-12 text-center">
                                                                                            <button type="button" class="btn btn-red register_submit" id="register_submit" style="background-color: {{ $color4 ?: '#ea1515' }}; border: 1px solid {{ $color4 ?: '#ea1515' }}; color: {{ $color3 ?: '#fff' }};">Add Credit Card</button>
                                                                                            <button type="button" class="btn btn-red register_submit" id="register_skip" style="background-color: {{ $color4 ?: '#ea1515' }}; border: 1px solid {{ $color4 ?: '#ea1515' }}; color: {{ $color3 ?: '#fff' }};">Skip</button>
                                                                                        </div>
                                                                                    </div>
                                                                                </form>
                                                                            </div>
                                                                        </div>
                                                                    </div>

                                                                    {{-- <div class="d-none code-view">
                                                                        <div class="row justify-content-md-center">
                                                                            <div class="col-lg-7">
                                                                                <form action="">
                                                                                    <div class="row ">
                                                                                        <div class="col-md-12 col-lg-12"><h4 class="font-red ">Personal Info</h4></div>
                                                                                        <div class="col-md-4 col-lg-3">
                                                                                            <label class="mt-10 ">First Name<span id="star">*</span></label>
                                                                                            <input type="text" name="firstname" id="firstname" size="30" maxlength="80" class="form-control">
                                                                                        </div>
                                                                                        <div class="col-md-4 col-lg-3">
                                                                                            <label class="mt-10">Last Name<span id="star">*</span></label>
                                                                                            <input type="text" name="lastname" id="lastname" size="30" maxlength="80" class="form-control">
                                                                                        </div>
                                                                                        <div class="col-md-4 col-lg-3">
                                                                                            <label class="mt-10">Email<span id="star">*</span></label>
                                                                                            <input type="email" name="email" id="email" class="myemail form-control" size="30" maxlength="80" autocomplete="off">
                                                                                        </div>
                                                                                        <div class="col-md-4 col-lg-3">
                                                                                            <label class="mt-10">Birthday<span id="star">*</span></label>
                                                                                            <input type="hidden" class="form-control add-client-birthdate flatpickr-input" id="dob" name="dob"><input class="form-control add-client-birthdate form-control input" placeholder="" tabindex="0" type="text" readonly="readonly">
                                                                                        </div>

                                                                                        <div class="col-md-4 col-lg-3">
                                                                                            <label class="mt-10">Phone <span id="star">*</span></label>
                                                                                            <input type="text" name="contact" id="contact" size="30" maxlength="14" autocomplete="off" onkeypress="return event.charCode >= 48 &amp;&amp; event.charCode <= 57" data-behavior="text-phone" class="form-control">
                                                                                        </div>

                                                                                        <div class="col-md-4 col-lg-3">
                                                                                            <label class="mt-10">Gender<span id="star">*</span></label>
                                                                                            <select class="form-control" name="gender">
                                                                                                <option value="male">Male</option>
                                                                                                <option value="female">Female</option>
                                                                                                <option value="other">Other</option>
                                                                                            </select>
                                                                                        </div>
                                                                                                    
                                                                                        <div class="col-md-4 col-lg-3">
                                                                                            <div class="form-group check-box-info ">
                                                                                                <input class="check-box-primary-account" type="checkbox" id="primaryAccountHolder" name="primaryAccountHolder" value="1">
                                                                                                <label for="primaryAccountHolder"> Primary Account <span class="" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-original-title="You are paying for yourself and all added family members.">(i)</span></label>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="add-client-sapre-tor"></div>

                                                                                    <div class="row">
                                                                                        <div class="col-md-12 col-lg-12"><h4 class="font-red ">Address</h4></div>
                                                                                        <div class="col-md-4 col-lg-3 mt-10">
                                                                                            <label>Address <span id="star">*</span></label>
                                                                                            <input type="text" class="form-control pac-target-input" autocomplete="off" name="address" id="addressCustomer" value="" required="" oninput="initMapCall('addressCustomer', 'cityCustomer', 'stateCustomer', 'countryCustomer', 'zipcodeCustomer', 'latitudeCustomer', 'longitudeCustomer')" aria-required="true"> 
                                                                                        </div>
                                                                                        <div class="col-md-4 col-lg-3 mt-10">
                                                                                            <label for="City">City <span id="star">*</span></label>
                                                                                            <input type="text" class="form-control" name="city" id="cityCustomer" size="30" maxlength="50" value="" required="" aria-required="true">
                                                                                        </div>
                                                                                        <input type="hidden" name="lon" id="longitudeCustomer" value="">
                                                                                        <input type="hidden" name="lat" id="latitudeCustomer" value="">

                                                                                        <div class="col-md-4 col-lg-3 mt-10">
                                                                                            <label for="state">State <span id="star">*</span></label>
                                                                                            <input type="text" class="form-control" name="state" id="stateCustomer" size="30" maxlength="50" value="" required="" aria-required="true">
                                                                                        </div>
                                                                                        <div class="col-md-4 col-lg-3 mt-10">
                                                                                            <label for="country">Country <span id="star">*</span></label>
                                                                                            <input type="text" class="form-control" name="country" id="countryCustomer" size="30" maxlength="50" value="" required="" aria-required="true">
                                                                                        </div> 

                                                                                        <div class="col-md-4 col-lg-3 mt-10">
                                                                                            <label for="zipcode">Zip Code <span id="star">*</span></label>
                                                                                            <input type="text" class="form-control" name="zipcode" id="zipcodeCustomer" size="30" maxlength="50" value="" required="" aria-required="true">
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="add-client-sapre-tor"></div>
                                                                                    <div class="row">
                                                                                        <div class="col-md-12 col-lg-12 mt-20"><h4 class="font-red ">Add Family Members (Optional)</h4></div>
                                                                                        <div class="error mb-10" id="familyerrormessage"></div>
                                                                                        <input type="hidden" name="familycnt" id="familycnt" value="0">
                                                                                        <div id="familymaindiv">
                                                                                            <div class="new-client mb-10" id="familydiv0" data-i="0" data-text="1">
                                                                                                <div class="accordion" id="default-accordion-example">
                                                                                                    <div class="accordion-item shadow">
                                                                                                        <h2 class="accordion-header" id="heading0">
                                                                                                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse0" aria-expanded="false" aria-controls="collapse0">
                                                                                                                <div class="container-fluid nopadding">
                                                                                                                    <div class="row"> 
                                                                                                                        <div class="col-lg-6 col-md-6 col-8"> Family Member #1 </div> 
                                                                                                                        <div class="col-lg-6 col-md-6 col-4"> 
                                                                                                                            <div class="multiple-options" id="deletediv0"> </div> 
                                                                                                                        </div> 
                                                                                                                    </div>
                                                                                                                </div>
                                                                                                            </button>
                                                                                                        </h2>
                                                                                                        <div id="collapse0" class="accordion-collapse collapse" aria-labelledby="heading0" data-bs-parent="#default-accordion-example" style="">
                                                                                                            <div class="accordion-body">
                                                                                                                <div class="row">
                                                                                                                    <div class="col-md-4 col-lg-3">
                                                                                                                        <label class="mt-10">First Name</label>
                                                                                                                        <input type="text" name="fname[]" id="fname" class="form-control required" aria-required="true">
                                                                                                                        <span class="error" id="err_fname"></span>
                                                                                                                    </div>
                                                                                                                    <div class="col-md-4 col-lg-3">
                                                                                                                        <label class="mt-10">Last Name</label>
                                                                                                                        <input type="text" name="lname[]" id="lname" class="form-control required" aria-required="true">
                                                                                                                        <span class="error" id="err_lname"></span>
                                                                                                                    </div>
                                                                                                                    <div class="col-md-4 col-lg-3">
                                                                                                                        <label class="mt-10">Birthday</label>
                                                                                                                        <input type="text" class="form-control" name="birthdate[]" id="birthdate">
                                                                                                                    </div>
                                                                                                                    <div class="col-md-4 col-lg-3">
                                                                                                                        <label class="mt-10">Gender</label>
                                                                                                                        <select name="familygender[]" id="gender" class="form-select gender" required="" aria-required="true">
                                                                                                                            <option value="male">Male</option>
                                                                                                                            <option value="female">Female</option>
                                                                                                                            <option value="other">Specify other</option>
                                                                                                                        </select>
                                                                                                                        <span class="error" id="err_gender"></span>
                                                                                                                    </div>
                                                                                                                    <div class="col-md-4 col-lg-3">
                                                                                                                        <label class="mt-10">Relationship</label>
                                                                                                                        <select name="relationship[]" id="relationship" class="form-select relationship required" aria-required="true">
                                                                                                                            <option value="">Select Relationship</option>
                                                                                                                            <option value="Brother">Brother</option>
                                                                                                                            <option value="Sister">Sister</option>
                                                                                                                            <option value="Father">Father</option>
                                                                                                                            <option value="Mother">Mother</option>
                                                                                                                            <option value="Wife">Wife</option>
                                                                                                                            <option value="Husband">Husband</option>
                                                                                                                            <option value="Son">Son</option>
                                                                                                                            <option value="Daughter">Daughter</option>
                                                                                                                        </select>
                                                                                                                        <span class="error" id="err_relationship"></span>
                                                                                                                    </div>
                                                                                                                    <div class="col-md-4 col-lg-3">
                                                                                                                        <label class="mt-10">Phone</label>
                                                                                                                        <input maxlength="14" type="text" name="mphone[]" id="mphone" class="form-control mobile_number" onkeypress="return event.charCode >= 48 &amp;&amp; event.charCode <= 57" data-behavior="text-phone">
                                                                                                                        <span class="error" id="err_mphone"></span>
                                                                                                                    </div>
                                                                                                                    <div class="col-md-4 col-lg-3">
                                                                                                                        <label class="mt-10">Email</label>
                                                                                                                        <input type="email" name="emailid[]" id="emailid" class="form-control email" required="" aria-required="true">
                                                                                                                        <span class="error" id="err_emailid"></span>
                                                                                                                    </div>
                                                                                                                    <div class="col-md-4 col-lg-3">
                                                                                                                        <label class="mt-10">Emergency Name</label>
                                                                                                                        <input type="text" name="emergency_name[]" id="emergency_name" class="form-control emergency_name">
                                                                                                                        <span class="error" id="err_emergency_name"></span>
                                                                                                                    </div>
                                                                                                                    <div class="col-md-4 col-lg-3">
                                                                                                                        <label class="mt-10">Emergency Phone</label>
                                                                                                                        <input maxlength="14" type="text" name="emergency_phone[]" id="emergency_phone" class="form-control emergency_phone" onkeypress="return event.charCode >= 48 &amp;&amp; event.charCode <= 57" data-behavior="text-phone">
                                                                                                                        <span class="error" id="err_emergency_phone"></span>
                                                                                                                    </div>
                                                                                                                    <div class="col-md-4 col-lg-3">
                                                                                                                        <label class="mt-10">Emergency Email</label>
                                                                                                                        <input type="text" name="emergency_email[]" id="emergency_email" class="form-control emergency_email">
                                                                                                                        <span class="error" id="err_emergency_email"></span>
                                                                                                                    </div>
                                                                                                                    <div class="col-md-4 col-lg-3">
                                                                                                                        <label class="mt-10">Emergency Relation</label>
                                                                                                                        <select name="emergency_relation[]" id="emergency_relation" class="form-select emergency_relation">
                                                                                                                            <option value="">Select Emergency Relationship</option>
                                                                                                                            <option value="Brother">Brother</option>
                                                                                                                            <option value="Sister">Sister</option>
                                                                                                                            <option value="Father">Father</option>
                                                                                                                            <option value="Mother">Mother</option>
                                                                                                                            <option value="Wife">Wife</option>
                                                                                                                            <option value="Husband">Husband</option>
                                                                                                                            <option value="Son">Son</option>
                                                                                                                            <option value="Daughter">Daughter</option>
                                                                                                                        </select>
                                                                                                                        <span class="error" id="err_emergency_relation"></span>
                                                                                                                    </div>
                                                                                                                    <div class="col-md-4 col-lg-3"> 
                                                                                                                        <div class="form-group check-box-info">
                                                                                                                            <input class="check-box-primary-account primaryAcCheck" type="checkbox" id="primaryAccount" name="primaryAccount" value="1">
                                                                                                                            <label for="primaryAccount"> Primary Account <span class="" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-original-title="Choose the primary account holder to determine whose card covers bookings for up to two family members (e.g., Mom or Dad). All cards stored under the primary account will be available at checkout.">(i)</span></label>
                                                                                                                        </div>
                                                                                                                    </div>
                                                                                                                </div>
                                                                                                            </div>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="">
                                                                                            <div class="col-md-12 col-lg-12 text-right">
                                                                                                <button type="button" class="btn btn-red mt-10" id="add_family">Add New Family Member</button>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="add-client-sapre-tor"></div>
                                                                                    <div class="row">
                                                                                        <div class="col-md-12 col-lg-12 mt-20"><h4 class="font-red ">How did you hear about us</h4></div>
                                                                                        <div class="row">
                                                                                            <div class="col-md-4 col-lg-5 mt-10">
                                                                                                <label class="mt-10">How did you hear about us?</label>
                                                                                                <select class="form-select" name="know_from">
                                                                                                    <option value="male">Search engine (Google, Bing, etc)</option>
                                                                                                    <option value="Google maps search">Google maps search</option>
                                                                                                    <option value="Referral">Referral</option>
                                                                                                    <option value="Social media">Social media</option>
                                                                                                    <option value="Online communities / forums">Online communities / forums</option>
                                                                                                    <option value="Online advertisement">Online advertisement</option>
                                                                                                    <option value="Offine advertisement">Offine advertisement</option>
                                                                                                    <option value="Noticed the physical location">Noticed the physical location</option>
                                                                                                    <option value="Website">Website</option>
                                                                                                    <option value="Event">Event</option>
                                                                                                    <option value="School">School</option>
                                                                                                    <option value="Other">Other</option>
                                                                                                </select>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="add-client-sapre-tor"></div>
                                                                                    <div class="row">
                                                                                        <div class="col-md-12 col-lg-12 mt-20"><h4 class="font-red ">Account Password</h4></div>
                                                                                        <div class="row">
                                                                                            <label class="mt-10">Please pick a password to log-in to your account later.</label>
                                                                                            <div class="col-md-4 col-lg-4 mt-10">
                                                                                                <label class="mt-10">Password</label>
                                                                                                <input type="text" name="password" id="password" class="form-control">
                                                                                            </div>
                                                                                            <div class="col-md-4 col-lg-4 mt-10">
                                                                                                <label class="mt-10">Confirm Password</label>
                                                                                                <input type="text" name="confirmpassword" id="confirmpassword" class="form-control">
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="add-client-sapre-tor"></div>
                                                                                    <div class="row"> 
                                                                                        <div class="col-md-12 col-lg-12 mt-20">
                                                                                            <h4 class="font-red "> Agree to Terms, Waiver &amp; Contract Signature</h4>
                                                                                        </div>
                                                                                        <div class="col-md-12">
                                                                                            <div class="col-lg-12" id="termsdiv">
                                                                                                <div class="terms-head">
                                                                                                    <div>
                                                                                                        <a href="#" data-url="http://dev.fitnessity.co/getTerms?id=29&amp;termsType=refundpolicytext&amp;termsHeader=Refund%20Policy" class="font-13 color-red-a" data-behavior="termsModelOpen">Refund Policy</a> 
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                        <label class="mt-10">To continue, please read the terms &amp; waivers above. A signature is required to participate. </label>
                                                                                        <div class="row">
                                                                                            <div class="col-lg-12">
                                                                                                <canvas id="signatureCanvas" name="signatureCanvas"></canvas>
                                                                                                <input type="hidden" name="signpath" id="signpath" value="">
                                                                                            </div>
                                                                                            <div class="col-lg-12">
                                                                                                <div class="col-md-4 col-lg-3 col-lg-3">
                                                                                                    <button type="button" id="clearButton" class="btn btn-primary btn-black">Clear</button>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="row">
                                                                                        <div class="col-md-12 col-lg-12 text-center">
                                                                                            <div class="wrap-sp">
                                                                                                <input type="checkbox" name="b_trm1" id="b_trm1" class="form-check-input" value="1">
                                                                                                <label for="b_trm1" class="text-center">I agree to Fitnessity Terms of Service and Privacy Policy</label>
                                                                                            </div>
                                                                                            <div id="termserror" class="font-red fs-15 text-center mb-10"></div>
                                                                                            <div id="systemMessage" class="mb-10 fs-15 mb-10"></div>
                                                                                        </div>
                                                                                        <div class="col-md-12 col-lg-12 text-center">
                                                                                            <button type="button" class="btn btn-red register_submit" id="register_submit" onclick="getType('submit');">Add Credit Card</button>
                                                                                            <button type="button" class="btn btn-red register_submit" id="register_skip" data-type="skip" onclick="getType('skip');">Skip</button>
                                                                                        </div>
                                                                                    </div>
                                                                                </form>
                                                                            </div>
                                                                        </div>
                                                                    </div> --}}
                                                                </div><!-- end card-body -->
                                                            </div><!-- end card -->
                                                        </div> <!-- end col -->
                                                    </div> 
                                                    <!-- end row-->
                                            </div>
                                            <div id="booking" class="lrcontent">
                                                    <div class="row">
                                                        <div class="col-xl-3 col-lg-4">
                                                            <form action="{{route('business.schedule_details')}}" method="POST" enctype="multipart/form-data">
                                                                @csrf
                                                            <div class="card">
                                                                <div class="card-header">
                                                                    <div class="d-flex ">
                                                                        <div class="flex-grow-1">
                                                                            <h5 class="fs-16">Widget Settings</h5>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="accordion accordion-flush filter-accordion">
                                                                    <div class="accordion-item">
                                                                        <h2 class="accordion-header" id="flush-headingBrands">
                                                                            <button class="accordion-button bg-transparent shadow-none" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseBrands" aria-expanded="true" aria-controls="flush-collapseBrands">
                                                                                <span class="text-muted text-uppercase fs-12 fw-medium">Style</span> <span class="badge bg-success rounded-pill align-middle ms-1 filter-badge"></span>
                                                                            </button>
                                                                        </h2>
                                                                      
                                                                        <div id="flush-collapseBrands" class="accordion-collapse collapse show" aria-labelledby="flush-headingBrands">
                                                                            <div class="accordion-body text-body pt-0">
                                                                                <div class="mb-25">
                                                                                    <div class="gap-2 mt-3 filter-check">
                                                                                        <label class="font-15">Color Scheme</label>
                                                                                    </div>
                                                                                    <div class="gap-2 mt-3 filter-check">                                            
                                                                                        <label for="">Button Text Color</label>
                                                                                        <div class="col-lg-auto">
                                                                                            <div class="d-flex flex-wrap gap-2">
                                                                                                <div class="pickr">
                                                                                                    <div class="nano-colorpicker" data-picker="5"></div>
                                                                                                        <input type="hidden" id="selectedColor5" name="primary_color" value="{{$color5}}">
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="gap-2 mt-3 filter-check" id="Btncolor">                                            
                                                                                        <label for="">Button Color</label>
                                                                                        <div class="col-lg-auto">
                                                                                            <div class="d-flex flex-wrap gap-2">
                                                                                                <div class="pickr">
                                                                                                    <div class="nano-colorpicker" id="hcolour" data-picker="6"></div>
                                                                                                    <input type="hidden" id="selectedColor6" name="secondary_color" value="{{$color6}}">
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>

                                                                                    <div class="gap-2 mt-3 filter-check" id="Btncolor">                                            
                                                                                        <label for="">Label Background Color</label>
                                                                                        <div class="col-lg-auto">
                                                                                            <div class="d-flex flex-wrap gap-2">
                                                                                                <div class="pickr">
                                                                                                    <div class="nano-colorpicker" data-picker="9"></div>
                                                                                                    <input type="hidden" id="selectedColor9" name="label_color" value="{{$color10}}">
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="gap-2 mt-3 filter-check">                                            
                                                                                        <label for="">Label Text Color</label>
                                                                                        <div class="col-lg-auto">
                                                                                            <div class="d-flex flex-wrap gap-2">
                                                                                                <div class="pickr">
                                                                                                    <div class="nano-colorpicker" data-picker="10"></div>
                                                                                                    <input type="hidden" id="selectedColor10" name="label_text_color" value="{{$color11}}">
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>

                                                                                    <div class="gap-2 mt-3 filter-check">                                            
                                                                                        <label for="">Date Text Color</label>
                                                                                        <div class="col-lg-auto">
                                                                                            <div class="d-flex flex-wrap gap-2">
                                                                                                <div class="pickr">
                                                                                                    <div class="nano-colorpicker" data-picker="11"></div>
                                                                                                    <input type="hidden" id="selectedColor11" name="date_text_color" value="{{$color12}}">
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="gap-2 mt-3 filter-check">                                            
                                                                                        <label for="">Background</label>
                                                                                        <div class="col-lg-auto">
                                                                                            <div class="d-flex flex-wrap gap-2">
                                                                                                <div class="pickr">
                                                                                                    <div class="nano-colorpicker" data-picker="8"></div>
                                                                                                    <input type="hidden" id="selectedColor8" name="backcolor" value="{{$color9}}">                                                                                          
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                    {{-- <div class="gap-2 mt-3 filter-check">                                            
                                                                                        <label for="">Secondary</label>
                                                                                        <div class="col-lg-auto">
                                                                                            <div class="d-flex flex-wrap gap-2">
                                                                                                <div class="pickr">
                                                                                                    <button type="button" class="pcr-button" role="button" aria-label="toggle color picker dialog" style="--pcr-color: rgba(244, 67, 54, 1);"></button>
                                                                                                </div>
                                                                                            </div>
                                                                                            <!-- <div class="pickesettings">
                                                                                                <input type="text" autocomplete="off" spellcheck="false">
                                                                                                <input type="color" value="#ea1515">
                                                                                            </div> -->
                                                                                        </div>
                                                                                    </div> --}}
                                                                                </div>            
                                                                                <div class="mb-25">
                                                                                    <div class="gap-2 mt-3 filter-check">                                            
                                                                                        <label for="">Font</label>
                                                                                        {{-- <select class="form-select" name="font">
                                                                                            <option value="Arial" {{ isset($data) && $data->font == 'Arial' ? 'selected' : '' }}>Arial</option>
                                                                                            <option value="Calibri"{{ isset($data) && $data->font == 'Calibri' ? 'selected' : '' }}>Calibri</option>
                                                                                            <option value="Cambria" {{ isset($data) && $data->font == 'Cambria' ? 'selected' : '' }}>Cambria</option>
                                                                                            <option value="Monospace" {{ isset($data) && $data->font == 'Monospace' ? 'selected' : '' }} >Monospace</option>
                                                                                        </select> --}}
                                                                                        <select class="form-select" name="font" id="fontSelector">
                                                                                            <option value="lato-family"  {{ isset($data) && $data->font == 'lato-family' ? 'selected' : '' }}>Lato</option>
                                                                                            <option value="oswald-family" {{ isset($data) && $data->font == 'oswald-family' ? 'selected' : '' }}>Oswald</option>
                                                                                            <option value="space-grotesk-family" {{ isset($data) && $data->font == 'space-grotesk-family' ? 'selected' : '' }}>Space Grotesk</option>
                                                                                            <option value="josefin-sans-family" {{ isset($data) && $data->font == 'josefin-sans-family' ? 'selected' : '' }}>Josefin Sans</option>
                                                                                            <option value="signika-family" {{ isset($data) && $data->font == 'signika-family' ? 'selected' : '' }}>Signika</option>
                                                                                            <option value="sofadi-one-family" {{ isset($data) && $data->font == 'sofadi-one-family' ? 'selected' : '' }}>Sofadi One</option>
                                                                                            <option value="gowun-batang-family" {{ isset($data) && $data->font == 'gowun-batang-family' ? 'selected' : '' }}>Gowun Batang</option>
                                                                                            <option value="kanit-family" {{ isset($data) && $data->font == 'kanit-family' ? 'selected' : '' }}>Kanit</option>
                                                                                            <option value="playpen-family" {{ isset($data) && $data->font == 'playpen-family' ? 'selected' : '' }}>Playpen Sans</option>
                                                                                            <option value="great-vibes-family" {{ isset($data) && $data->font == 'great-vibes-family' ? 'selected' : '' }}>Great Vibes</option>
                                                                                            <option value="arsenal-family" {{ isset($data) && $data->font == 'arsenal-family' ? 'selected' : '' }}>Arsenal SC</option>
                                                                                        </select>
                                                                                    </div>
                                                                                </div>  
                                                                                <div class="mb-25">
                                                                                    <div class="gap-2 mt-3 filter-check">                                            
                                                                                        <label for="">Button Text</label>
                                                                                        <select class="form-select" name="button_text" id="buttonTextSelect">
                                                                                            <option value="Book Now" {{isset($data) && $data->button_text == 'Book Now' ? 'selected' : '' }}>Book Now</option>
                                                                                            <option value="Reserve" {{isset($data) && $data->button_text == 'Reserve' ? 'selected' : '' }}>Reserve</option>
                                                                                            <option value="Sign Up" {{isset($data) && $data->button_text == 'Sign Up' ? 'selected' : '' }}>Sign Up</option>
                                                                                            <option value="Register" {{isset($data) && $data->button_text == 'Register' ? 'selected' : '' }}>Register</option>
                                                                                            <option value="Schedule" {{isset($data) && $data->button_text == 'Schedule' ? 'selected' : '' }}>Schedule</option>
                                                                                            "Enroll
                                                                                            <option value="Enroll" {{isset($data) && $data->button_text == 'Enroll' ? 'selected' : '' }}>Enroll</option>
                                                                                        </select>
                                                                                    </div>
                                                                                </div> 
                                                                                <div class="mb-25">
                                                                                    <div class="gap-2 mt-3 filter-check">                                            
                                                                                        <label for="">Button Style</label>
                                                                                        <div>
                                                                                            <input type="radio" id="html" name="style" value="text-only" {{ isset($data) && $data->button_style == 'text-only' ? 'checked' : '' }}>
                                                                                            <label for="html">Text only</label><br>
                                                                                            <input type="radio" id="css" name="style" value="outline-strokeme" {{ isset($data) && $data->button_style == 'outline-strokeme' ? 'checked' : '' }}>
                                                                                            <label for="css">Outline</label><br>
                                                                                            <input type="radio" id="javascript" name="style" value="font-solid" {{ isset($data) && $data->button_style == 'font-solid' ? 'checked' : '' }}>
                                                                                            <label for="javascript">Solid</label> 
                                                                                        </div>                                               
                                                                                    </div>
                                                                                </div>
                                                                            </div>                                    
                                                                        </div>
                                                                    </div>
                                                                    <!-- end accordion-item -->    
                                                                    <div class="accordion-item">
                                                                        <h2 class="accordion-header" id="flush-headingDiscount">
                                                                            <button class="accordion-button bg-transparent shadow-none collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseDiscount" aria-expanded="true" aria-controls="flush-collapseDiscount">
                                                                                <span class="text-muted text-uppercase fs-12 fw-medium">Content</span> <span class="badge bg-success rounded-pill align-middle ms-1 filter-badge"></span>
                                                                            </button>
                                                                        </h2>
                                                                        <div id="flush-collapseDiscount" class="accordion-collapse collapse" aria-labelledby="flush-headingDiscount">
                                                                            <div class="accordion-body text-body pt-1">
                                                                                <div class="gap-2 mt-3 filter-check">
                                                                                    <div>
                                                                                        <button class="btn btn-red mb-15 w-100">Select Schedule Contents</button>  
                                                                                    </div>                                                                                  
                                                                                </div>
                                                                                <div class="mb-25">
                                                                                    <div class="gap-2 mt-3 filter-check">                                            
                                                                                        <label for="">Main Schedule</label>
                                                                                        <p>Select what you'd like to show in the main view of the schedule.</p>
                                                                                        <div>
                                                                                            <input type="checkbox" id="vehicle1" name="vehicle1" value="Bike">
                                                                                            <label for="vehicle1">Staff </label><br>
                                                                                            <input type="checkbox" id="vehicle2" name="vehicle2" value="Car">
                                                                                            <label for="vehicle2">Class type </label><br>
                                                                                            <input type="checkbox" id="vehicle3" name="vehicle3" value="Boat">
                                                                                            <label for="vehicle3">Class level </label><br> 
                                                                                        </div>                                               
                                                                                    </div>
                                                                                </div>

                                                                                <div class="mb-25">
                                                                                    <div class="gap-2 mt-3 filter-check">                                            
                                                                                        <label for="">Date Range</label>
                                                                                        <div>
                                                                                            <input type="radio" id="html" name="fav_language" value="HTML">
                                                                                            <label for="html">Week </label><br>
                                                                                            <input type="radio" id="css" name="fav_language" value="CSS">
                                                                                            <label for="css">Day</label><br>
                                                                                        </div>                                               
                                                                                    </div>
                                                                                </div>

                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <!-- end accordion-item -->                            
                                                                    <div class="accordion-item">
                                                                        <h2 class="accordion-header" id="flush-headingRating">
                                                                            <button class="accordion-button bg-transparent shadow-none collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseRating" aria-expanded="false" aria-controls="flush-collapseRating">
                                                                                <span class="text-muted text-uppercase fs-12 fw-medium">Filters</span> <span class="badge bg-success rounded-pill align-middle ms-1 filter-badge"></span>
                                                                            </button>
                                                                        </h2>

                                                                        <div id="flush-collapseRating" class="accordion-collapse collapse" aria-labelledby="flush-headingRating">
                                                                            <div class="accordion-body text-body">
                                                                                <div class="gap-2 filter-check">
                                                                                    <label for="">Select a maximum of 4</label>
                                                                                    <div>
                                                                                        <input type="radio" id="html" name="filter" value="class" {{ isset($data) && $data->filters == 'class' ? 'checked' : '' }}>
                                                                                        <label for="html">Class </label><br>
                                                                                        <input type="radio" id="css" name="filter" value="staff" {{ isset($data) && $data->filters == 'staff' ? 'checked' : '' }}>
                                                                                        <label for="css">Staff </label><br>
                                                                                        <input type="radio" id="javascript" name="filter" value="class_type" {{ isset($data) && $data->filters == 'class_type' ? 'checked' : '' }}>
                                                                                        <label for="javascript">Class Type</label> <br>
                                                                                        <input type="radio" id="javascript1" name="filter" value="class_level" {{ isset($data) && $data->filters == 'class_level' ? 'checked' : '' }}>
                                                                                        <label for="javascript1">Class Level</label> 
                                                                                    </div>  
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div> 
                                                                    <!-- end accordion-item -->

                                                                    <div class="accordion-item">
                                                                        <h2 class="accordion-header" id="flush-headingregion">
                                                                            <button class="accordion-button bg-transparent shadow-none collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseregion" aria-expanded="false" aria-controls="flush-collapseregion">
                                                                                <span class="text-muted text-uppercase fs-12 fw-medium">Region</span> <span class="badge bg-success rounded-pill align-middle ms-1 filter-badge"></span>
                                                                            </button>
                                                                        </h2>

                                                                        <div id="flush-collapseregion" class="accordion-collapse collapse" aria-labelledby="flush-headingregion">
                                                                            <div class="accordion-body text-body">
                                                                                <div class="gap-2 filter-check">
                                                                                    <label for="">Language</label>
                                                                                    <select class="form-select mb-3" aria-label="Default select example">
                                                                                        <option selected="">English </option>
                                                                                        <option value="1">Hindi </option>
                                                                                        <option value="2">Arabela </option>
                                                                                        <option value="3">Egyptian Arabic </option>
                                                                                        <option value="3">Auslan </option>
                                                                                    </select>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div> 
                                                                    <!-- end accordion-item -->
                                                                </div>
                                                                <div class="card-footer">
                                                                    <div class="d-flex mt-3 mb-3">
                                                                        <div class="flex-grow-1">
                                                                            <button type="submit" class="btn btn-black w-100">Save and Deploy</button>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </form>
                                                        </div>

                                                        <div class="col-xl-9 col-lg-8">
                                                            <div class="card" id="preview_color" style="background-color:{{$color9}}">
                                                                <div class="card-header align-items-center d-flex">
                                                                    <h4 class="card-title mb-0 flex-grow-1">Preview</h4>
                                                                    <!--<div class="flex-shrink-0">
                                                                        <div class="form-check form-switch form-switch-right form-switch-md">
                                                                            <label for="dropdown-base-example" class="form-label text-muted">Preview Size</label>
                                                                            <input class="form-check-input code-switcher" type="checkbox" id="dropdown-base-example">
                                                                        </div>
                                                                    </div>-->
                                                                </div><!-- end card header -->

                                                                <div>
                                                                    <div class="live-preview" id="livepreview" >
                                                                
                                                                        <div class="row">
                                                                            <div class="col-lg-3 col-md-3">
                                                                                <div class="row">
                                                                                    <div class="col-lg-12 service-pr-0">
                                                                                        <div class="card-header bg-soft-grey">
                                                                                            <label class="card-title mb-0 flex-grow-1">Services</label>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="col-lg-12">
                                                                                        <div class="card-body">
                                                                                            <select class="form-select" name="know_from">
                                                                                                <option value="All Services" Selected>All Services</option>
                                                                                                <option value="Classes">Classes</option>
                                                                                                <option value="Private Lessons">Private Lessons</option>
                                                                                                <option value="Events">Events</option>
                                                                                                <option value="Experience">Experience</option>
                                                                                            </select>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>                                        
                                                                            </div>
                                                                            <div class="col-lg-3 col-md-3">
                                                                                <div class="row">
                                                                                    <div class="col-lg-12 fall-schedule">
                                                                                        <div class="card-header bg-soft-grey">
                                                                                            <label class="card-title mb-0 flex-grow-1">Great For</label>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="col-lg-12 fall-schedule">
                                                                                        <div class="card-body">
                                                                                            <select class="form-select" name="know_from">
                                                                                                <option value="All" Selected>All</option>
                                                                                                <option value="adults">Adults</option>
                                                                                                <option value="kids">Kids</option>
                                                                                                <option value="infants">Infants</option>
                                                                                            </select>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>                                        
                                                                            </div>
                                                                            <div class="col-lg-3 col-md-3">
                                                                                <div class="row">
                                                                                    <div class="col-lg-12 fall-schedule">
                                                                                        <div class="card-header bg-soft-grey">
                                                                                            <label class="card-title mb-0 flex-grow-1">Difficulty Level</label>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="col-lg-12 fall-schedule">
                                                                                        <div class="card-body">
                                                                                            <select class="form-select" name="know_from">
                                                                                                <option value="All Levels" Selected>All Levels</option>
                                                                                                <option value="Beginner">Beginner</option>
                                                                                                <option value="Intermediate">Intermediate</option>
                                                                                                <option value="Advance">Advance</option>
                                                                                                <option value="Pro">Pro</option>
                                                                                            </select>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>                                        
                                                                            </div>
                                                                            <div class="col-lg-3 col-md-3">
                                                                                <div class="row">
                                                                                    <div class="col-lg-12 staff-pl-0">
                                                                                        <div class="card-header bg-soft-grey">
                                                                                            <label class="card-title mb-0 flex-grow-1">All Staff</label>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="col-lg-12 staff-pl-0">
                                                                                        <div class="card-body">
                                                                                            <select class="form-select" name="know_from">
                                                                                                <option value="All Staff" Selected>All Staff</option>
                                                                                            </select>
                                                                                        </div>
                                                                                    </div>
                                                                                </div> 
                                                                            </div>
                                                                        </div>

                                                                        <div>
                                                                            <div class="card-header bg-soft-grey">
                                                                                <div class="row">
                                                                                    <div class="col-lg-6 col-6">
                                                                                        <label class="card-title mb-0 flex-grow-1">Find Date</label>
                                                                                    </div>
                                                                                    <div class="col-lg-6 col-6">
                                                                                        <div class="calendar-icon float-right">
                                                                                            <input type="text" name="date" class="date datepicker" readonly placeholder="DD/MM/YYYY" />
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                                
                                                                                
                                                                            </div>
                                                                            <div class="card-body">
                                                                                <div class="row">
                                                                                    <div class="col-md-2 col-sm-2 col-xs-6 col-6">
                                                                                        <div class="pairets schedule_color" style="{{ isset($color10) && !empty($color10) ? 'background-color:' . $color10 . ';' : '' }}">
                                                                                            <!-- <div class="pairets-inviable"> -->
                                                                                            <a href="#" class="calendar-btn" style="color:{{$color12 ?? '#fff'}}">Wed 14</a>
                                                                                        </div>
                                                                                    </div>
                                                                                                            
                                                                                    <div class="col-md-2 col-sm-2 col-xs-6 col-6">
                                                                                        <div class="pairets-inviable">
                                                                                            <!-- <div class="pairets-inviable"> -->
                                                                                            <a href="#" class="calendar-btn" style="color:{{$color12 ?? '#fff'}}">Thu 15</a>
                                                                                        </div>
                                                                                    </div>
                                                                                                            
                                                                                    <div class="col-md-2 col-sm-2 col-xs-6 col-6">
                                                                                        <div class="pairets-inviable">
                                                                                            <!-- <div class="pairets-inviable"> -->
                                                                                            <a href="#" class="calendar-btn" style="color:{{$color12 ?? '#fff'}}">Fri 16</a>
                                                                                        </div>
                                                                                    </div>
                                                                                                            
                                                                                    <div class="col-md-2 col-sm-2 col-xs-6 col-6">
                                                                                        <div class="pairets-inviable">
                                                                                            <!-- <div class="pairets-inviable"> -->
                                                                                            <a href="#" class="calendar-btn" style="color:{{$color12 ?? '#fff'}}">Sat 17</a>
                                                                                        </div>
                                                                                    </div>
                                                                                                            
                                                                                    <div class="col-md-2 col-sm-2 col-xs-6 col-6">
                                                                                        <div class="pairets-inviable">
                                                                                            <!-- <div class="pairets-inviable"> -->
                                                                                            <a href="#" class="calendar-btn" style="color:{{$color12 ?? '#fff'}}">Sun 18</a>
                                                                                        </div>
                                                                                    </div>
                                                                                                            
                                                                                    <div class="col-md-2 col-sm-2 col-xs-6 col-6">
                                                                                        <div class="pairets-inviable">
                                                                                            <!-- <div class="pairets-inviable"> -->
                                                                                            <a href="#" class="calendar-btn" style="color:{{$color12 ?? '#fff'}}">Mon 19</a>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            <!-- <div class="row justify-content-md-center">
                                                                                    <div class="col-lg-12">
                                                                                        <div class="mt-3">
                                                                                            <input type="text" class="form-control" data-provider="flatpickr" data-date-format="d M, Y" data-deafult-date="24 01,2021" data-inline-date="true">
                                                                                        </div>
                                                                                    </div>
                                                                                </div> -->
                                                                            </div>
                                                                        </div>     
                                                                        <div>
                                                                            <div class="card-header bg-soft-grey">
                                                                                <label class="card-title mb-0 flex-grow-1">Wednesday, February 14</label>
                                                                            </div>
                                                                            <div class="card-body card-body-schedule show-all">
                                                                                <div class="row justify-content-md-center">
                                                                                    <div class="col-lg-2 col-md-2 col-xs-12 col-sm-2 col-12">
                                                                                        <div class="table-inner-data">
                                                                                            <span class="mg-time"> 06:30 AM </span>
                                                                                            <div class="bg-red-nen schedule_color" style="{{ isset($color10) && !empty($color10) ? 'background-color:' . $color10 . ';' : '' }}">
                                                                                                <span class="timings" style="color:{{$color11}}"> 1 hour </span>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="col-lg-7 col-md-7 col-xs-12 col-sm-7 col-12">
                                                                                        <div class="table-inner-data-sec">
                                                                                            <img src="https://fitnessity-production.s3.amazonaws.com/activity/meka8JsFR68TpdRhatzxzZpTFPVUSvgEx1MGILm5.jpg" alt="Fitnessity">
                                                                                            <div class="p-name font-change">
                                                                                                <label>jumping 1</label>
                                                                                                <div class="d-grid">
                                                                                                    <p> Personal Training | Bungee Jumping | Spot Available - 1/1</p>
                                                                                                    <p>Instructor: Darryl Phipps <span class="difficult-level">Difficulty Level: Pro </span></p>  
                                                                                                </div>
                                                                                                            
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="col-lg-1 col-md-1 col-xs-3 col-sm-1 col-6">
                                                                                        <div class="star-rest">
                                                                                            <div class="activity-inner-data">
                                                                                                <i class="fas fa-star schedule_ncolor" style="{{ isset($color10) && !empty($color10) ? 'color:' . $color10 . ';' : '' }}"></i>
                                                                                                <span> 5 </span>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="col-lg-2 col-md-2 col-xs-6 col-sm-2 col-6">
                                                                                        <div class="join-btn">
                                                                                            <a class="btn book_now" id="book_now" href="#" style="background-color: {{ $color6 ?: '#ea1515' }}; border: 1px solid {{ $color6 ?: '#ea1515' }}; color: {{ $color5 ?: '#fff' }};">{{ isset($data) ? $data->button_text : 'Book Now' }}</a>                                                                                            
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="schedule-widget-sapre-tor"></div>
                                                                            </div>

                                                                            <div class="card-body card-body-schedule show-all">
                                                                                <div class="row">
                                                                                    <div class="col-md-12">
                                                                                        <div class="border-list">
                                                                                            <div class="row">
                                                                                                <div class="col-lg-2 col-md-2 col-xs-12 col-sm-2  col-12">
                                                                                                    <div class="table-inner-data">
                                                                                                        <span class="mg-time"> 09:00 AM </span>
                                                                                                        <div class="bg-red-nen schedule_color" style="{{ isset($color10) && !empty($color10) ? 'background-color:' . $color10 . ';' : '' }}">
                                                                                                            <span  class="timings" style="color:{{$color11 ?? '#fff'}}"> 1 hour 15 minute </span>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                </div>
                                                                                                <div class="col-lg-7 col-md-7 col-xs-12 col-sm-7  col-12">
                                                                                                    <div class="table-inner-data-sec">
                                                                                                        <img src="https://fitnessity-production.s3.amazonaws.com/activity/eisJPbu7UPhASgD4edJSOufZSXENkw3TkZV281HL.jpg" alt="Fitnessity">
                                                                                                        <div class="p-name font-change">
                                                                                                            <label>Summer Camp at Valor</label>
                                                                                                            <div class="d-grid">
                                                                                                                <p> Events | Day Camp | Spot Available - 200/200</p>
                                                                                                                <p>Instructor: Darryl Phipps <span class="difficult-level">Difficulty Level: Beginner</span></p>   
                                                                                                            </div>                                                                   
                                                                                                        </div>
                                                                                                    </div>
                                                                                                </div>
                                                                                                <div class="col-lg-1 col-md-1 col-xs-3 col-sm-1  col-6">
                                                                                                    <div class="star-rest">
                                                                                                        <div class="activity-inner-data">
                                                                                                            <i class="fas fa-star schedule_ncolor" style="{{ isset($color10) && !empty($color10) ? 'color:' . $color10 . ';' : '' }}"></i>
                                                                                                            <span> 0 </span>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                </div>
                                                                                                <div class="col-lg-2 col-md-2 col-xs-6 col-sm-2  col-6">
                                                                                                    <div class="join-btn">
                                                                                                        <a class="btn book_now" href="#" id="book_now" style="background-color: {{ $color6 ?: '#ea1515' }}; border: 1px solid {{ $color6 ?: '#ea1515' }}; color: {{ $color5 ?: '#fff' }};">{{ isset($data) ? $data->button_text : 'Book Now' }}</a>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="schedule-widget-sapre-tor"></div>
                                                                            </div>

                                                                            <div class="card-body card-body-schedule show-all">
                                                                                <div class="row">
                                                                                    <div class="col-md-12">
                                                                                        <div class="border-list">
                                                                                            <div class="row">
                                                                                                <div class="col-lg-2 col-md-2 col-xs-12 col-sm-2  col-12">
                                                                                                    <div class="table-inner-data">
                                                                                                        <span class="mg-time"> 09:15 AM </span>
                                                                                                        <div class="bg-red-nen schedule_color" style="{{ isset($color10) && !empty($color10) ? 'background-color:' . $color10 . ';' : '' }}">
                                                                                                            <span  class="timings" style="color:{{$color11 ?? '#fff'}}"> 1 hour </span>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                </div>
                                                                                                <div class="col-lg-7 col-md-7 col-xs-12 col-sm-7  col-12">
                                                                                                    <div class="table-inner-data-sec">
                                                                                                        <img src="https://fitnessity-production.s3.amazonaws.com/activity/wvahqhcKOL6C8NQ1IBqh3vtfVOc3MOAM3aarjoLf.jpg" alt="Fitnessity">
                                                                                                        <div class="p-name font-change">
                                                                                                            <label>Bucephalus Riding and Polo Club1</label>
                                                                                                            <div class="d-grid">
                                                                                                                <p> Events | Horseback Riding | Spot Available - 10/10</p>
                                                                                                                <p>Instructor: Darryl Phipps <span class="difficult-level">Difficulty Level: Advance</span></p>  
                                                                                                            </div>                                                                                                                        
                                                                                                        </div>
                                                                                                    </div>
                                                                                                </div>
                                                                                                <div class="col-lg-1 col-md-1 col-xs-3 col-sm-1  col-6">
                                                                                                    <div class="star-rest">
                                                                                                        <div class="activity-inner-data">
                                                                                                            <i class="fas fa-star schedule_ncolor" style="{{ isset($color10) && !empty($color10) ? 'color:' . $color10 . ';' : '' }}"></i>
                                                                                                            <span> 0 </span>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                </div>
                                                                                                <div class="col-lg-2 col-md-2 col-xs-6 col-sm-2  col-6">
                                                                                                    <div class="join-btn">
                                                                                                        <a class="btn book_now" href="#"  id="book_now" style="background-color: {{ $color6 ?: '#ea1515' }}; border: 1px solid {{ $color6 ?: '#ea1515' }}; color: {{ $color5 ?: '#fff' }};">{{ isset($data) ? $data->button_text : 'Book Now' }}</a>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="schedule-widget-sapre-tor"></div>
                                                                            </div>
                                                                        </div>                             
                                                                    </div>
                                                                </div><!-- end card-body -->
                                                            </div><!-- end card -->
                                                        </div> <!-- end col -->
                                                    </div> 
                                                    <!-- end row-->
                                            </div> 
                                        </div>
                                    </div>
                                </div>

                                <div class="card bg-soft-grey" id="copyCodeCard" style="display: none;">
                                    <div class="card-header align-items-center d-flex bg-soft-grey">
                                        <h4 class="card-title mb-0 flex-grow-1">Copy your code</h4>
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <div class="copy-code">
                                                    <p>Paste the code into your webpage where you would like the link to appear. Changes made above automatically update your code.</p>
                                                    <textarea class="form-control" id="des-info-description-input" rows="4" readonly>{!! $selectLink !!} </textarea>
                                                    <button class="btn btn-red mt-15" id="copyButton">Copy</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                        
                            </div>
                            <div class="tab-pane" id="site_settings" role="tabpanel">
                                <div class="">
                                    <div class="card-header align-items-center d-flex">
                                        <h4 class="card-title mb-0 flex-grow-1">Site Settings - Valor Mixed Martial Arts</h4>
                                    </div><!-- end card header -->

                                    <div class="card-body">
                                        <div class="live-preview">
                                            <div class="row ">
                                                <div class="col-lg-12">
                                                    <button href="#" class="btn btn-black">Refresh all fitnessity data</button>
                                                </div>                                                  
                                            </div>
                                        </div>
                                    </div><!-- end card-body -->
                                </div><!-- end card -->

                                <div class="card bg-soft-grey ">
                                    <div class="card-header align-items-center d-flex bg-soft-grey">
                                        <h4 class="card-title mb-0 flex-grow-1">Who powers your website?</h4>
                                    </div><!-- end card header -->

                                    <div class="card-body">
                                        <div class="live-preview">
                                            <div class="row ">
                                                <div class="col-lg-3">
                                                    <div class="mt-3 filter-check">
                                                        <label for="">Who powers your website?</label>
                                                        <select class="form-select mb-3" aria-label="Default select example">
                                                            <option selected="">Wordpress </option>
                                                            <option value="1">Facebook </option>
                                                            <option value="2">GoDaddy </option>
                                                            <option value="3">Joomla </option>
                                                            <option value="3"> Drupal</option>                                                               
                                                        </select>
                                                    </div>
                                                </div>                                                  
                                            </div>
                                        </div>
                                    </div><!-- end card-body -->
                                </div><!-- end card -->

                                <div class="card bg-soft-grey ">
                                    <div class="card-header align-items-center d-flex bg-soft-grey">
                                        <h4 class="card-title mb-0 flex-grow-1">Branding </h4>
                                    </div><!-- end card header -->

                                    <div class="card-body">
                                        <div class="live-preview">
                                            <div class="row ">
                                                <div class="col-lg-6">
                                                    <div class="row y-middle mb-15">
                                                        <div class="col-lg-5">
                                                            <label for="">Primary Color</label>
                                                        </div>
                                                        <div class="col-lg-auto">
                                                            <div class="pickesettings">
                                                                <input type="text" autocomplete="off" spellcheck="false">
                                                                <input type="color" value="#FFB61A">
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="row y-middle mb-15">
                                                        <div class="col-lg-5">
                                                            <label for="">Secondary Color</label>
                                                        </div>
                                                        <div class="col-lg-auto">
                                                            <div class="pickesettings">
                                                                <input type="text" autocomplete="off" spellcheck="false">
                                                                <input type="color" value="#FFB35A">
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="row y-middle">
                                                        <div class="col-lg-5">
                                                            <label for="">Widget background Color</label>
                                                        </div>
                                                        <div class="col-lg-auto">
                                                            <div class="pickesettings">
                                                                <input type="text" autocomplete="off" spellcheck="false">
                                                                <input type="color" value="#FCB91A">
                                                            </div>
                                                        </div>
                                                    </div>

                                                </div>                                                  
                                            </div>
                                        </div>
                                    </div><!-- end card-body -->
                                </div><!-- end card -->

                                <div class="card bg-soft-grey ">
                                    <div class="card-header align-items-center d-flex bg-soft-grey">
                                        <h4 class="card-title mb-0 flex-grow-1">Account Registration</h4>
                                    </div><!-- end card header -->

                                    <div class="card-body">
                                        <div class="live-preview">
                                            <div class="row ">
                                                <div class="col-lg-3">
                                                    <div class="mt-3 filter-check">
                                                        <label for="">Default Registration Widget</label>
                                                        <select class="form-select mb-3" aria-label="Default select example">
                                                            <option selected="">Login/Register </option>
                                                            <option value="1">Register an Account 02 </option>                                      
                                                        </select>
                                                    </div>
                                                </div>                                                  
                                            </div>
                                        </div>
                                    </div><!-- end card-body -->
                                </div><!-- end card -->

                                <div class="card bg-soft-grey ">
                                    <div class="card-header align-items-center d-flex bg-soft-grey">
                                        <h4 class="card-title mb-0 flex-grow-1">Locations</h4>
                                    </div><!-- end card header -->

                                    <div class="card-body">
                                        <div class="live-preview">
                                            <div class="row ">
                                                <div class="col-lg-3">
                                                    <div class="mt-3 filter-check">
                                                        <label for="">Valor Mixed Martial Arts</label>
                                                    </div>
                                                </div>                                                  
                                            </div>
                                        </div>
                                    </div><!-- end card-body -->
                                </div><!-- end card -->

                                <div class="card bg-soft-grey ">
                                    <div class="card-header align-items-center d-flex bg-soft-grey">
                                        <h4 class="card-title mb-0 flex-grow-1">Region</h4>
                                    </div><!-- end card header -->

                                    <div class="card-body">
                                        <div class="live-preview">
                                            <div class="row ">
                                                <div class="col-lg-6">
                                                    <div class="row y-middle mb-15">
                                                        <div class="col-lg-3">
                                                            <div class="filter-check">
                                                                <label for="">Currency Symbol</label>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6">
                                                            <select class="form-select" aria-label="Default select example">
                                                                <option selected="">$ (Dollar)</option>                         
                                                            </select>
                                                        </div>
                                                    </div>    
                                                    <div class="row y-middle mb-15">
                                                        <div class="col-lg-3">
                                                            <div class="filter-check">
                                                                <label for="">Language </label>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6">
                                                            <select class="form-select" aria-label="Default select example">
                                                                <option selected="">English</option>     
                                                                <option>Hindi</option>                     
                                                            </select>
                                                        </div>
                                                    </div>                                                      
                                                </div>                                                  
                                            </div>
                                        </div>
                                    </div><!-- end card-body -->
                                </div><!-- end card -->

                                <div class="card bg-soft-grey ">
                                    <div class="card-header align-items-center d-flex bg-soft-grey">
                                        <h4 class="card-title mb-0 flex-grow-1">Users</h4>
                                    </div><!-- end card header -->

                                    <div class="card-body">
                                        <div class="live-preview">
                                            <button href="#" class="btn btn-black" data-bs-toggle="modal" data-bs-target="#adduser">Add New User</button>
                                            <div class="row ">
                                                <div class="col-lg-12">
                                                    <div class="table-responsive">
                                                        <table class="table align-middle table-nowrap mb-0">
                                                            <thead>
                                                                <tr>
                                                                    <th scope="col">Name</th>
                                                                    <th scope="col">Email</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <tr>
                                                                    <th scope="row">Darryl Phipps</th>
                                                                    <td>mrphipps@valormmanyc.com</td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>                                                  
                                            </div>
                                        </div>
                                    </div><!-- end card-body -->
                                </div><!-- end card -->

                            </div>
                        </div>
                    </div>
                    <!--end col-->
                </div>
            </div>
        </div>
    </div>
    <!-- container-fluid -->
</div>
<!-- end main content-->	

<!-- Modal -->
<div class="modal fade" id="login_preview" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-100">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Preview</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
            <section class="register ptb-65" style="background-image: url(http://dev.fitnessity.co//public/images/register-bg.jpg)">
                <div class="container">
                    <div class="col-lg-6 col-md-6 col-sm-7 col-xs-12">
                        <div class="register_wrap" id="signup_normal">
                            <input type="hidden" id="showstep" value="">
                            <div class="logo-my">
                                <a href="javascript:void(0)"> <img src="http://dev.fitnessity.co//public/images/omnebook.png"> </a>
                            </div>               
                            <form method="post" action="">
                                <input type="hidden" name="_token" value="5QJLNEz2voSG1yd1mOKWRs91y0u50UhbqKLCiNJS">
                                <div class="pop-title ftitle1">
                                    <h3>Welcome to Fitnessity</h3>
                                </div>
                                <br> 
                                <input type="hidden" name="redirect" value="http://dev.fitnessity.co/design/integration_portal">
                                <input type="email" name="email" id="email" class="myemail" size="30" autocomplete="off" placeholder="e-MAIL" maxlength="80">
                                <span class="text-danger cls-error" id="erremail"></span> 
                                <div class="position-relative auth-pass-inputgroup">
                                    <input class="password-input" type="password" name="password" id="password" size="30" placeholder="Password" autocomplete="off">
                                    <button class="btn-link position-absolute password-addon toggle-password" type="button" id="password-addon">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                </div>
                                <span class="text-danger cls-error" id="errpass"></span>                    
                                <div class="remembermediv terms-wrap">
                                    <input type="checkbox" id="remember" name="remember" checked="" class="remembercheckbox">
                                    <span for="remember" class="rememberme">Remember me</span>
                                </div>
                                <div id="capchaimg"></div>
                                {{-- <button class="btn signup-new" id="login_submit" type="submit">Log in </button> --}}
                                <button class="btn signup-new" id="login_submit" type="button" style="background-color: {{ $color2 ?: '#ea1515' }}; border: 1px solid {{ $color2 ?: '#ea1515' }}; color: {{ $color1 ?: '#fff' }};">Log in</button>           
                                <p class="or-data">OR</p>
                                <div class="social-login">
                                    <a class="fb-login">
                                        <i class="fab fa-facebook" aria-hidden="true"></i> Login with Facebook
                                    </a>
                                </div>
                                <div class="text-center mb-10">
                                    <a class="fb-login btn signup-new">
                                        <i class="fab fa-google" aria-hidden="true"></i>   <span class="ml-10">Login with Google</span>
                                    </a>
                                </div>

                                <a class="forgotpass" data-behavior="ajax_html_modal" data-url="http://dev.fitnessity.co/auth/jsModalpassword">Forgot Password?</a>

                                <a class="forgotpass" href="http://dev.fitnessity.co/staff_login">Login For Staff Member?</a>

                                <p class="already">Don't have an account?
                                    <a style="color: {{ $color1 ?: '#fff' }};" id="sign_up">SIGN UP</a>     
                                </p>
                            </form>
                        </div>
                    </div>
                </div>
            </section>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="register_preview" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-100">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Preview</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
           		<section class="register ptb-65" style="background-image: url(http://dev.fitnessity.co//public/images/register-bg.jpg)">
                    <div class="container">
                        <div class="col-lg-6 col-md-6 col-sm-7 col-xs-12">
                            <div class="register_wrap modal-register-preview" id="signup_normal">
                                <input type="hidden" id="showstep" value="1">
                                <!--1-->
                                                <div class="logo-my">
                                    <a href="javascript:void(0)"> <img src="http://dev.fitnessity.co//public/images/omnebook.png" alt="Fitnessity"> </a>
                                </div>
                                <form id="frmregister" method="post" novalidate="novalidate">
                                    <div class="pop-title ftitle1">
                                        <h3>Welcome to fitnessity</h3>
                                    </div>
                                    <div id="systemMessage"></div>
                                    <input type="hidden" name="_token" value="E4MKIsrjC7a9tlI0LqoOFnqRZdAK85o1YLbI53LN">
                                    <input type="hidden" name="customerId" value="">
                
                                    <input type="text" name="firstname" id="firstname" size="30" maxlength="80" placeholder="First Name">
                                    <input type="text" name="lastname" id="lastname" size="30" maxlength="80" placeholder="Last Name">
                                    <input type="text" name="username" id="username" size="30" maxlength="80" placeholder="Username" autocomplete="off">
                
                                    <input type="email" name="email" id="email" class="myemail" size="30" placeholder="e-MAIL" maxlength="80" autocomplete="off">
                                    <input type="text" name="contact" id="contact" size="30" maxlength="14" autocomplete="off" placeholder="Phone" data-behavior="text-phone">
                                    <input type="text" id="dob" name="dob" class="flatpicker_birthdate1 flatpickr-input" placeholder="Birthday" readonly="readonly">
                                    <div class="position-relative auth-pass-inputgroup">	
                                        <input type="password" name="password" id="password" size="30" placeholder="Password" autocomplete="off">
                                        <button class="btn-link position-absolute password-addon toggle-password" type="button" data-tp="password">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                    </div>
                                    <div class="position-relative auth-pass-inputgroup">
                                        <input class="password-input" type="password" name="confirm_password" id="confirm_password" size="30" placeholder="Confirm Password" autocomplete="off">
                                        <button class="btn-link position-absolute password-addon toggle-password" type="button" data-tp="confirm_password">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                    </div>
                
                                    <div class="form-group check-box-info">
                                        <input class="check-box-primary-account" type="checkbox" id="primary_account" name="primary_account" value="1">
                                        <label for="primary_account"> Primary Account <span class="" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-original-title="You are paying for yourself and all added family members.">(i)</span></label>
                                    </div>
                                    
                
                                    <div class="terms-wrap">
                                        <input type="checkbox" name="b_trm1" id="b_trm1" class="form-check-input" value="1">
                                        <label for="b_trm1">I agree to Fitnessity <a href="/terms-condition" target="_blank">Terms of Service</a> and <a href="/privacy-policy" target="_blank">Privacy Policy</a></label>
                                    </div>
                                    <div id="termserror"></div><br>
                                    <button type="button" style="margin:0px;" class="signup-new" id="register_submit" onclick="$('#frmregister').submit();">Create Account</button>
                                    <br><br>
                                    <!-- <p class="or-data">OR</p>
                                    <div class="social-login">
                                        <a href="/login/facebook" class="fb-login">
                                            <i class="fa fa-facebook" aria-hidden="true"></i> Login with Facebook
                                        </a>
                                      <a href="/login/google" class="plus-login">
                                            <i class="fa fa-google-plus" aria-hidden="true"></i> Sign with Google+
                                        </a> 
                                    </div> -->
                                    <p class="already">Already have an account? <a href="/userlogin">Login</a></p>    
                                </form>
                            </div>
                        </div>
                    </div>
            	</section>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="booking_preview" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-100">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Preview</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
           		<div class="row mb-3">
					<div class="col-12">
                    	<div class="text-center pbooking-modal-logo">
                        	<img src="http://dev.fitnessity.co//public/images/fitnessity_logo1_black.png">
                        </div>
						<div class="page-heading text-center">
							<h2>Fitness Pvt. Ltd.</h2>
							<p>Booking Schedule for Nipa Soni (Demo)</p>
							<p>If you already have a membership with multiple sessions. Reserve your spot here.<br> If you don’t already have a membership, <a href="http://dev.fitnessity.co/activities">Book Here </a></p>
						</div>
					</div>
	            </div>
                
                <div class="row">
					<div class="col-12 ">
						<div class="">
							<div class="container p-0 inner-top-activity text-center">
								<div class="col-md-12 col-xs-12 ">
									<div class="activity-schedule-tabs">
										<ul class="nav nav-tabs" role="tablist">
											<li class="active">
												<a class="nav-link" href="#" aria-expanded="true"> ALL </a>
											</li>
											<li>
												<a class="nav-link" href="#" aria-expanded="true"> CLASSES </a>
											</li>
											<li>
												<a class="nav-link" href="#" aria-expanded="true"> PRIVATE LESSONS </a>
											</li>
											<li>
												<a class="nav-link" href="#" aria-expanded="true"> EVENTS </a>
											</li>
											<li>
												<a class="nav-link" href="#" aria-expanded="true"> EXPERIENCE </a>
											</li>
										</ul>
										<div class="tab-content" style="min-height: 600px;">
											<div class="tab-pane  active " id="tabs-all" role="tabpanel">
												<div class="row">
													<div class="col-md-12 col-sm-12 col-xs-12 text-right">
														<div class="calendar-icon">
															<input type="text" name="date" class="date datepicker hasDatepicker" readonly="" placeholder="DD/MM/YYYY" id="dp1720435536625"><img class="ui-datepicker-trigger" src="/public/img/calendar-icon.png" alt="Select date" title="Select date">
														</div>
													</div>
												</div>
                                                <div class="row">
                                                    <div class="col-lg-3">
                                                        <div class="item">
                                                            <div class="pairets">
                                                                <a href="#" class="calendar-btn">Mon 08</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-3">
                                                        <div class="item">
                                                            <div class="pairets-inviable">
                                                                <a href="#" class="calendar-btn">Tue 09</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-3">
                                                        <div class="item">
                                                            <div class="pairets-inviable">
                                                                <a href="#" class="calendar-btn">Wed 10</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-3">
                                                        <div class="item">
                                                            <div class="pairets-inviable">
                                                                <a href="#" class="calendar-btn">Thu 11</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
												
												<div class="tab-data">
													<div class="row">
														<div class="col-md-4 col-sm-4 col-xs-12">
															<div class="checkout-sapre-tor">
															</div>
														</div>
														<div class="col-md-4 col-sm-4 col-xs-12 valor-mix-title">
															<label>Activities on Monday, July 8</label>
														</div>
														<div class="col-md-4 col-sm-4 col-xs-12">
															<div class="checkout-sapre-tor">
															</div>
														</div>
													</div>
													<div class="activity-tabs">
														<div class="row">
															<div class="col-md-6 col-sm-6 col-xs-12">
																<div class="classes-info text-left">
																	<div class="row">
																		<div class="col-md-12 col-xs-12 ">
																			<label>Activity Name: </label> <span> Summer Dance</span>
																		</div>
																		<div class="col-md-12 col-xs-12">
																			<div class="text-left line-height-1">
																				<label>Activity: </label> <span> Dance</span>
																			</div>
																		</div>
																	</div>
																</div>
															</div>
															<div class="col-md-6 col-sm-6 col-xs-12">
																<div class="row">
																	<div class="col-md-4 col-sm-5 col-xs-12">
																		<div class="classes-time">
																			<button class="post-btn  activity-scheduler" onclick="openPopUp(1182 , 5 ,'Summer Dance','04:00 am',0,'516');">04:00 am <br>1 hr</button>
																				<label>2/2  Spots Left</label>
																				<label>Discover Test, Ashley Wong</label>
																		</div>
																	</div>
                                                                </div>
															</div>
															<div class="col-md-12 col-xs-12">
																<div class="checkout-sapre-tor">
																</div>
															</div>
														</div> 
																																																																																                                                        <div class="row"> 
															<div class="col-md-6 col-sm-6 col-xs-12">
																<div class="classes-info text-left">
																	<div class="row">
                                                                    	<div class="col-md-12 col-xs-12 ">
																			<label>Activity Name: </label> <span> Passion Airplane Tours New York NYny</span>
																		</div>
																		<div class="col-md-12 col-xs-12">
																			<div class="text-left line-height-1">
																				<label>Activity: </label> <span> Airplane Tour</span>
																			</div>
																		</div>
																	</div>
																</div>
															</div>
																			
															<div class="col-md-6 col-sm-6 col-xs-12">
																<div class="row">
																	<div class="col-md-4 col-sm-5 col-xs-12">
																		<div class="classes-time">
																			<button class="post-btn  activity-scheduler" onclick="openPopUp(1208 , 304 ,'Passion Airplane Tours New York NYny','08:45 am',0,'553');">08:45 am <br>1 hr</button>
																			<label>1/1  Spots Left</label>
																			<label>Discover Test, Gimmy Ttouqe</label>
																		</div>
																	</div>
																</div>
															</div>
															<div class="col-md-12 col-xs-12">
																<div class="checkout-sapre-tor">
																</div>
															</div>
														</div> 
                                                        <div class="row">
															<div class="col-md-6 col-sm-6 col-xs-12">
																<div class="classes-info text-left">
																	<div class="row">
																		<div class="col-md-12 col-xs-12 ">
																			<label>Activity Name: </label> <span> Passion Airplane Tours New York NYny</span>
																		</div>
																		<div class="col-md-12 col-xs-12">
																			<div class="text-left line-height-1">
																				<label>Activity: </label> <span> Airplane Tour</span>
																			</div>
																		</div>
																	</div>
																</div>
															</div>
															<div class="col-md-6 col-sm-6 col-xs-12">
																<div class="row">
																	<div class="col-md-4 col-sm-5 col-xs-12">
																		<div class="classes-time">
																			<button class="post-btn  activity-scheduler" onclick="openPopUp(1198 , 304 ,'Passion Airplane Tours New York NYny','09:00 pm',0,'554');">09:00 pm <br>5 hr</button>
																			<label>10/10  Spots Left</label>
																			<label>Discover Test</label>
																		</div>
																	</div>
                                                                </div>
															</div>
															<div class="col-md-12 col-xs-12">
																<div class="checkout-sapre-tor">
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
</div>

<!-- Modal -->
<div class="modal fade" id="adduser" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add New User</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="mt-3">
                    <label for="">Important</label>
                    <p>User are able to create, edit, and delete widgets. Add only trusted users to your site!</p>
                </div>
                <div class="mt-3">
                    <label for="">Email</label>
                    <input type="text" class="form-control" id="email">
                </div>
                <div class="mt-3">
                    <label for="">Name</label>
                    <input type="text" class="form-control" id="username">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-red">Add</button>
            </div>
        </div>
    </div>
</div>


@include('layouts.business.footer')
@include('layouts.business.scripts')

@push('scripts')
    <script>
            $('ul#dropzone-preview').on('click', 'button.delete-btn', function() {
                $(this).closest('li').remove();
            });

            $('ul#dropzone-preview-passcode').on('click', 'button.delete-btn', function() {
                $(this).closest('li').remove();
            });

            $('ul#dropzone-preview-checkin').on('click', 'button.delete-btn', function() {
                $(this).closest('li').remove();
            });

    </script>
    <script src="{{asset('/public/dashboard-design/js/dropzone-min.js')}}"></script>
    <!--  <script src="{{asset('/public/dashboard-design/js/ecommerce-product-create.init.js')}}"></script> -->
    <script src="{{asset('/public/dashboard-design/js/dropzoneCover.js')}}"></script>
    <script src="{{asset('/public/dashboard-design/js/dropzonePasscode.js')}}"></script>
    <script src="{{asset('/public/dashboard-design/js/dropzoneCheckin.js')}}"></script>

<script src="{{asset('/public/dashboard-design/js/pickr.min.js')}}"></script>
<script>
const colorInput = document.querySelector('input[type="color"]');
const syncColorFromPicker = () => {
  valueInput.value = colorInput.value;
};
const syncColorFromText = () => {
  colorInput.value = valueInput.value;
};
colorInput.addEventListener("input", syncColorFromPicker, false);
valueInput.addEventListener("input", syncColorFromText, false);
valueInput.addEventListener("focus", () => colorInput.click(), false);
syncColorFromPicker();
</script>

<!-- <script>
$(function() {
   $('.lrcontent').hide();
   $('#selectField').change(function() {
      $('.lrcontent').hide();
      $('#' + $(this).val()).show();
   });
});
</script> -->
<script>
    $("#menu-toggle").click(function(e) {
        e.preventDefault();
        $("#client_wrapper").toggleClass("toggled");
    });
</script>

<script>
    function removeClassIfNecessary() {
        var div = document.getElementById('client_wrapper');
        if (window.innerWidth <= 768) { // Example breakpoint
            div.classList.remove('toggled');
        } else {
        div.classList.add('toggled');
        }
    }
    window.addEventListener('resize', removeClassIfNecessary);
    window.addEventListener('DOMContentLoaded', removeClassIfNecessary);
</script>

<script>
    $(document).ready(function() {
        const selectedStyle = document.querySelector('input[name="style"]:checked').value;
        const colors = 
        {
            1:'{{$color1}}',
            2:'{{$color2}}',
            3:'{{$color3}}',
            4:'{{$color4}}',
            5:'{{$color5}}',
            6:'{{$color6}}',
            7:'{{$color8}}',
            8:'{{$color9}}',
            9:'{{$color10}}',
            10:'{{$color11}}',
            11:'{{$color12}}',

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
                if (pickerIndex == 1) {
                    $('#login_submit').css({
                        'color': selectedColor,
                    });
                    $('#sign_up').css({
                        'color': selectedColor,
                    });
                } else if (pickerIndex == 2) {
                    $('#login_submit').css({
                        'background-color': selectedColor,
                        'border-color': selectedColor
                    });
                }
                else if (pickerIndex == 3) {
                    $('#register_submit').css({
                        'color': selectedColor,
                    });
                    $('#register_skip').css({
                        'color': selectedColor,
                    });
                    $('#personal').css({
                        'color':selectedColor,
                    });
                    $('#address').css({
                        'color':selectedColor,
                    });
                    $('#family_mem').css({
                        'color':selectedColor,
                    });
                    $('#about').css({
                        'color':selectedColor,
                    });
                    $('#accounts_pass').css({
                        'color':selectedColor,
                    });
                    $('#agree_terms').css({
                        'color':selectedColor,
                    });
                    $('#clearButton').css({
                        'color':selectedColor,
                    });
                    $('#add_family').css({
                        'color':selectedColor,
                    });
                    
                    
                }
                else if (pickerIndex == 4) {
                    $('#register_submit').css({
                        'background-color': selectedColor,
                        'border-color': selectedColor
                    });
                    $('#register_skip').css({
                        'background-color': selectedColor,
                        'border-color': selectedColor
                    });
                    $('#add_family').css({
                        'background-color': selectedColor,
                        'border-color': selectedColor
                    });
                    $('#clearButton').css({
                        'background-color': selectedColor,
                        'border-color': selectedColor
                    });
                    
                }
                else if (pickerIndex == 5) {
                    $('.book_now').css({
                        'color': selectedColor,
                    });
                }
                else if (pickerIndex == 6) {
                    $('.book_now').css({
                        'background-color': selectedColor,
                        'border-color': selectedColor
                    });
                }
                else if(pickerIndex==7)
                {
                    $('#preview_reg_color').css({
                        'background-color': selectedColor,
                    });
                }
                else if (pickerIndex == 8) {
                    $('#preview_color').css({
                        'background-color': selectedColor,
                    });
                }
                else if (pickerIndex == 9) {
                    $('.schedule_color').css({
                        'background-color': selectedColor,
                    });
                    $('.schedule_ncolor').css({
                        'color': selectedColor,
                    });
                }
                else if (pickerIndex == 10) {
                    $('.schedule_color').css({
                        'color': selectedColor,
                    });
                    // $('.calendar-btn').css({
                    //     'color': selectedColor,
                    // });
                    $('.timings').css({
                        'color': selectedColor,
                    });
                }
                else if (pickerIndex == 11) {
                    $('.calendar-btn').css({
                        'color': selectedColor,
                    });
                }
                pickr.hide(); 
            });
        });
    });
</script>

    
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var selectField = document.getElementById("selectField");
            selectField.selectedIndex = 0; 
        });
    </script>
    <script type="text/javascript">
        document.addEventListener("DOMContentLoaded", function() {
            const selectField = document.getElementById('selectField');
            const textArea = document.getElementById('des-info-description-input');
            const loginContent = `{!! $login !!}`;
            const registerContent = `{!! $register !!}`;
            const scheduleContent='{!! $schedule !!}';
            const selectContent=`{!! $selectLink !!}`;
            selectField.addEventListener('change', function() {
                let selectedValue = selectField.value;
                let contentToDisplay;
                if (selectedValue === 'login') {
                    contentToDisplay = loginContent;
                    contentToDisplay += `<script src="https://dev.fitnessity.co/public/js/websiteintegration/login-widget.js"><\/script>`;
                } else if (selectedValue === 'register') {
                    contentToDisplay = registerContent;
                    contentToDisplay += `<script src="https://dev.fitnessity.co/public/js/websiteintegration/register-widget.js"><\/script>`;
                } 
                else if(selectedValue === 'booking')
                {
                    contentToDisplay = scheduleContent;
                    contentToDisplay += `<script src="https://dev.fitnessity.co/public/js/websiteintegration/schedule-widget.js"><\/script>`;
                }
                else {
                    contentToDisplay = selectContent;
                }
                textArea.value = contentToDisplay;
            });
        });
    </script>
    <script>
        document.getElementById('copyButton').addEventListener('click', function() {
            var textarea = document.getElementById('des-info-description-input');
            textarea.select();
            textarea.setSelectionRange(0, 99999);  
            navigator.clipboard.writeText(textarea.value)
        });
    </script>

    <script>
        $(document).ready(function() {
        $('.delete-btn').on('click', function() {
            var recordId = $(this).data('id'); 
                var button = $(this);
                if (confirm('Are you sure you want to delete this item?')) {
                    $.ajax({
                        url: '{{route("business.delete_img")}}',
                        type: 'get',
                        data: {
                            _token: $('meta[name="csrf-token"]').attr('content'),
                            'id':recordId,
                        },
                        success: function(response) {
                            if (response.success) {
                                button.closest('li').remove();
                            } else {
                                console.log('Failed to delete item');
                            }
                        },
                        error: function(xhr, status, error) {
                            console.error('Error:', error);
                        }
                    });
                }
            });
        });

    </script>

        <script>
            document.addEventListener('DOMContentLoaded', function () {
                const selectField = document.getElementById('selectField');
                const sessionMessage = "{{ session('message') }}";
                const copyCodeCard = document.getElementById('copyCodeCard');
                const loginContent = `{!! $login !!}`;
                const registerContent = `{!! $register !!}`;
                const scheduleContent='{!! $schedule !!}';
                const selectContent=`{!! $selectLink !!}`;
                const textArea = document.getElementById('des-info-description-input');

                function handleSelectChange() {
                    const val = $("#selectField option:selected").text();
                    
                    $('#login, #register, #booking').attr('style', 'display: none !important');
                    
                    if (val === 'Login') {
                        $('#login').attr('style', 'display: block !important');
                    } else if (val === 'Register') {
                        $('#register').attr('style', 'display: block !important');
                    } else if (val === 'Booking Schedule') {
                        $('#booking').attr('style', 'display: block !important');
                    }
                    
                    if (selectField.value === 'login' || selectField.value === 'register' || selectField.value === 'booking') {
                        copyCodeCard.style.display = 'block';
                    } else {
                        copyCodeCard.style.display = 'none';
                    }


                    if (selectField.value=== 'login') {
                        contentToDisplay = loginContent;
                        contentToDisplay += `<script src="https://dev.fitnessity.co/public/js/websiteintegration/login-widget.js"><\/script>`;
                    } else if (selectField.value === 'register') {
                        contentToDisplay = registerContent;
                        contentToDisplay += `<script src="https://dev.fitnessity.co/public/js/websiteintegration/register-widget.js"><\/script>`;
                    } 
                    else if(selectField.value === 'booking')
                    {
                        contentToDisplay = scheduleContent;
                        contentToDisplay += `<script src="https://dev.fitnessity.co/public/js/websiteintegration/schedule-widget.js"><\/script>`;
                    }
                    else {
                        contentToDisplay = '';
                    }
                    textArea.value = contentToDisplay;

                }
        
                if (sessionMessage === 'login' || sessionMessage === 'register' || sessionMessage === 'booking') {
                    selectField.value = sessionMessage;
                    handleSelectChange();
                } else {
                    selectField.selectedIndex = 0;
                    copyCodeCard.style.display = 'none';  // Hide by default if no session message
                }        



                selectField.addEventListener('change', handleSelectChange);
            });
        </script>
        
         <script>
            $(document).ready(function() {
                $('#selectField').change(function() {
                    var selectedValue = $(this).val();  
            
                    $('.lrcontent').hide();
            
                    if (selectedValue !== "Select...") {
                        $('#' + selectedValue).show();
                    }
                });
            });
        </script>
        <script>
            document.getElementById('fontSelector').addEventListener('change', function() {
                var previewElement = document.querySelector('#livepreview');
                previewElement.classList.remove('lato-family', 'oswald-family', 'space-grotesk-family', 'josefin-sans-family', 'signika-family','sofadi-one-family','gowun-batang-family','kanit-family','playpen-family','great-vibes-family','arsenal-family');
                previewElement.classList.add(this.value);
            });
            document.getElementById('fontSelector').dispatchEvent(new Event('change'));
        </script>

        <script>
            const buttons = document.querySelectorAll('.book_now');
            const styleRadios = document.querySelectorAll('input[name="style"]');
            const colorPickerInput = document.querySelector('#Btncolor'); 
            function updateButtonStyle() {
                const solidColor = document.querySelector('#selectedColor6').value;
                const selectedStyle = document.querySelector('input[name="style"]:checked').value;
                buttons.forEach(button => {
                    button.classList.remove('outline-strokeme', 'font-solid', 'text-only');
                    button.style.background = ''; 

                    if (selectedStyle === 'outline-strokeme') {
                        button.classList.add('outline-strokeme');
                        button.style.background = 'none'; 
                        button.style.border = '2px solid ' + solidColor; 
                        colorPickerInput.style.display = 'block';
                    } else if (selectedStyle === 'font-solid') {
                        button.classList.add('font-solid');
                        button.style.background = solidColor; 
                        button.style.border = '2px solid ' + solidColor;  
                        colorPickerInput.style.display = 'block';
                    } else if (selectedStyle === 'text-only') {
                        button.classList.add('text-only');
                        button.style.background = 'none';
                        button.style.border = 'none';  
                        colorPickerInput.style.display = 'none';
                    }
                });
            }
        
            styleRadios.forEach(radio => {
                radio.addEventListener('change', updateButtonStyle);
            });
            updateButtonStyle();
   
        </script>
        <script>
            document.getElementById('buttonTextSelect').addEventListener('change', function() {
                var selectedText = this.value;
                var buttons = document.querySelectorAll('.book_now');
                
                buttons.forEach(function(button) {
                    button.textContent = selectedText;
                });
            });
        </script>
    <!-- JavaScript to handle button style change -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const button = document.getElementsByClassName('book_now');
            const color6 = document.getElementById('selectedColor6').value || '#ea1515'; 
            function updateButtonStyle() {
                const selectedStyle = document.querySelector('input[name="style"]:checked').value;
                if (selectedStyle === 'outline-strokeme') {
                    button.classList.add('outline-strokeme');
                    button.style.backgroundColor = 'transparent'; 
                    button.style.borderColor = color6; 
                } else {
                    button.classList.remove('outline-strokeme');
                    button.style.backgroundColor = color6; 
                    button.style.borderColor = color6; 
                }
            }

            document.querySelectorAll('input[name="style"]').forEach(radio => {
                radio.addEventListener('change', updateButtonStyle);
            });
            updateButtonStyle();
        });
    </script>
@endpush
@endsection


