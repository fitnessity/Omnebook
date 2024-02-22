@inject('request', 'Illuminate\Http\Request')
@extends('layouts.business.header')

@section('content')
@include('layouts.profile.business_topbar')

<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-xxl-12">
                    <div class="card">
                        <div class="card-body">
                            <!-- Nav tabs -->
                            <ul class="nav nav-tabs mb-3" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" data-bs-toggle="tab" href="#widgets" role="tab" aria-selected="false">
                                        Widgets
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-bs-toggle="tab" href="#links" role="tab" aria-selected="false">
                                        Links
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-bs-toggle="tab" href="#site_settings" role="tab" aria-selected="false">
                                        Site Settings
                                    </a>
                                </li>
                            </ul>
                            <!-- Tab panes -->
                            <div class="tab-content  text-muted">
                                <div class="tab-pane active" id="widgets" role="tabpanel">
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
                                                                    <a class="dropdown-item" href="#">Schedule Widget</a>
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
                                                                        <th scope="row"><a href="#">Fall 2021 to 2022 Schedule</a></th>
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
                                <div class="tab-pane" id="links" role="tabpanel">
                                    <div class="card bg-soft-grey ">
                                        <div class="card-header align-items-center d-flex bg-soft-grey">
                                            <h4 class="card-title mb-0 flex-grow-1">Create your link</h4>
                                        </div>

                                        <div class="card-body">
                                            <div class="live-preview">
                                                <div class="row ">
                                                    <div class="col-lg-3">
                                                        <div class="mt-3 filter-check">
                                                            <label for="">Link type</label>
                                                            <select class="form-select mb-3" aria-label="Default select example">
                                                                <option selected="">Login</option>                                                           
                                                            </select>
                                                        </div>
                                                    </div>                                                  
                                                </div>

                                                <div class="row">
                                                    <div class="col-12">
                                                        <div class="mt-3 filter-check">
                                                            <label for="">Text Color</label>
                                                        </div>
                                                        <label for="color-picker">Color:</label>
                                                        <input type="color" value="#000000" id="color-picker" />
                                                        <!--<div class="mt-3 d-grid">
                                                            <label for="">Preview</label>
                                                            <p>
                                                                Watch the paragraph colors change when you adjust the color picker. As you make changes in the color picker, the first paragraph's color changes.
                                                            </p>
                                                        </div>  -->
                                                    </div>
                                                    <div class="col-12">
                                                        <div class="mt-3 filter-check">
                                                            <label for="">Background Color</label>
                                                        </div>
                                                        <label for="color-picker">Color:</label>
                                                        <input type="color" value="#000000" id="color-picker" />
                                                    </div>
                                                    <div class="col-lg-3 col-md-4 col-12">
                                                        <div class="mt-3 filter-check">
                                                            <label for="">Background Image </label>
                                                            <input class="form-control" type="file" id="formFileMultiple" multiple="">
                                                        </div>
                                                    </div>
                                                    
                                                </div>
                                                <div class="row">
                                                    <div class="col-lg-3 col-md-4 col-12">
                                                        <div class="mt-3 filter-check">
                                                            <label for="">Upload Logo</label>
                                                            <input class="form-control" type="file" id="formFileMultiple" multiple="">
                                                        </div>
                                                    </div>
                                                </div>
                                            
                                                <div class="row">
                                                    <div class="col-lg-3">
                                                        <div class="mt-3 d-grid">
                                                            <label for="">Preview</label>
                                                            <button class="btn btn-red" data-bs-toggle="modal" data-bs-target="#login_preview"><i class="fas fa-user"></i></button>
                                                        </div>
                                                    </div>                                                  
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="card bg-soft-grey ">
                                        <div class="card-header align-items-center d-flex bg-soft-grey">
                                            <h4 class="card-title mb-0 flex-grow-1">Copy your code</h4>
                                        </div>

                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <div class="copy-code">
                                                        <p>Paste the code into your webpage where you would like the link to appear. Changes made above automatically update your code.</p>
                                                        <textarea class="form-control" placeholder="<script src=http://dev.fitnessity.co//public/dashboard-design/js/jquery-3.6.4.min.js></script><script src=https://maps.googleapis.com/maps/api/js?libraries=places&key=AIzaSyCr7-ilmvSu8SzRjUfKJVbvaQZYiuntduw async defer></script> <script async src=https://www.googletagmanager.com/gtag/js?id=G-KQRG55N3Q1></script>" id="des-info-description-input" rows="4" required=""></textarea>
                                                        <button class="btn btn-red mt-15">Copy</button>
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
                        </div><!-- end card-body -->
                    </div><!-- end card -->
                </div><!--end col-->
            </div>
        </div><!-- container-fluid -->
    </div>
</div><!-- end main content-->	
</div><!-- END layout-wrapper -->


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
                                <a href="javascript:void(0)"> <img src="http://dev.fitnessity.co//public/images/logo-small.jpg"> </a>
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
                                <button class="btn signup-new" id="login_submit" type="submit">Log in </button>
                                <p class="or-data">OR</p>
                                <div class="social-login">
                                    <a href="login/facebook" class="fb-login">
                                        <i class="fab fa-facebook" aria-hidden="true"></i> Login with Facebook
                                    </a>
                                </div>
                                <div class="text-center mb-10">
                                    <a href="login/google" class="fb-login btn signup-new">
                                        <i class="fab fa-google" aria-hidden="true"></i>   <span class="ml-10">Login with Google</span>
                                    </a>
                                </div>

                                <a class="forgotpass" data-behavior="ajax_html_modal" data-url="http://dev.fitnessity.co/auth/jsModalpassword">Forgot Password?</a>

                                <a class="forgotpass" href="http://dev.fitnessity.co/staff_login">Login For Staff Member?</a>

                                <p class="already">Don't have an account?
                                    <a href="/registration">SIGN UP</a>
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



<script>
// Inputs
const valueInput = document.querySelector('input[type="text"]');
const colorInput = document.querySelector('input[type="color"]');

// Sync the color from the picker
const syncColorFromPicker = () => {
  valueInput.value = colorInput.value;
};

// Sync the color from the field
const syncColorFromText = () => {
  colorInput.value = valueInput.value;
};

// Bind events to callbacks
colorInput.addEventListener("input", syncColorFromPicker, false);
valueInput.addEventListener("input", syncColorFromText, false);

// Optional: Trigger the picker when the text field is focused
valueInput.addEventListener("focus", () => colorInput.click(), false);

// Refresh the text field
syncColorFromPicker();

</script>
@endsection