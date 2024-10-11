@inject('request', 'Illuminate\Http\Request')

@extends('layouts.business.header')

@section('content')

	@include('layouts.business.business_topbar')
    @include('design.engage_clients_sidebar')


        <!-- Page Content -->
        <div id="page-content-wrapper">
            <div class="container-fluid">
                <a href="#menu-toggle" class="btn btn-black mb-15" id="menu-toggle"><i class="fas fa-bars"></i></a>

                <div class="row mb-3 y-middle">
					<div class="col-lg-6 col-7">
						<div class="page-heading">
							<label>Alerts Details</label>
						</div>
					</div>
                    <div class="col-lg-4 col-5">
                        <div class="text-right">
                            <a href="http://dev.fitnessity.co/design/automation_campaigns" type="button" class="btn btn-red">Back</a>
                        </div>
                    </div>
                    <div class="col-lg-2">

                    </div>
                </div>

                <div class="row">
                    <div class="col-xxl-10 col-lg-10">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-3 tab-right-border">
                                        <div class="nav flex-column nav-pills text-center alerts_details-nav" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                                            <a class="nav-link mb-2 active" id="v-pills-profile-tab" data-bs-toggle="pill" href="#v-pills-profile" role="tab" aria-controls="v-pills-profile" aria-selected="false">Email </a>
                                            <a class="nav-link mb-2" id="v-pills-home-tab" data-bs-toggle="pill" href="#v-pills-home" role="tab" aria-controls="v-pills-home" aria-selected="true">SMS/Push Notification </a>
                                            <a class="nav-link mb-2" id="v-pills-messages-tab" data-bs-toggle="pill" href="#v-pills-messages" role="tab" aria-controls="v-pills-messages" aria-selected="false">Delivery Timeline </a>
                                            <a class="nav-link" id="v-pills-settings-tab" data-bs-toggle="pill" href="#v-pills-settings" role="tab" aria-controls="v-pills-settings" aria-selected="false">Delivery Method </a>
                                        </div>
                                    </div><!-- end col -->
                                    <div class="col-md-9">
                                        <div class="tab-content text-muted mt-4 mt-md-0" id="v-pills-tabContent">
                                            <div class="tab-pane fade show active" id="v-pills-profile" role="tabpanel" aria-labelledby="v-pills-profile-tab">
                                                <div class="col-lg-12">
                                                    <div class="mt-20 mb-20">
                                                        <label class="fs-18">Email </label>
                                                    </div>
                                                    <div class="mb-20">
                                                        <div class="profile-user position-relative d-inline-block w-100 push-notification-email">
                                                            <img src="http://dev.fitnessity.co//public/uploads/slider/thumb/1648141166-snowboarding.jpg" class="img-thumbnail user-profile-image  shadow" alt="user-profile-image">
                                                            <div class="avatar-xs p-0 rounded-circle profile-photo-edit">
                                                                <input id="profile-img-file-input" type="file" class="profile-img-file-input">
                                                                <label for="profile-img-file-input" class="profile-photo-edit avatar-xs">
                                                                    <span class="avatar-title rounded-circle bg-light text-body shadow">
                                                                        <i class="ri-camera-fill"></i>
                                                                    </span>
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <form>
                                                        <div class="mb-3">
                                                            <label for="firstnameInput" class="form-label">Email Title</label>
                                                            <input type="text" class="form-control" id="firstnameInput" value="Dave">
                                                        </div>
                                                        <div class="mb-4 pb-3">
                                                            <label>Email Content</label>
                                                            <div id="ckeditor-classic">
                                                                <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.</p>
                                                                
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                            <div class="tab-pane fade " id="v-pills-home" role="tabpanel" aria-labelledby="v-pills-home-tab">
                                                <div class="row">
                                                    <div class="col-lg-12">
                                                        <div class="alert-title-edit">
                                                            <div class="row">
                                                                <div class="col-lg-6 col-md-6 col-9">
                                                                    <label>Welcome a new client</label>
                                                                </div>
                                                                <div class="col-lg-6 col-md-6 col-3">
                                                                    <div class="text-right">
                                                                        <button class="btn btn-black position-relative insights-p" data-bs-toggle="modal" data-bs-target="#exampleModal"><i class="fas fa-pencil-alt align-middle fs-13"></i></button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            
                                                        </div>
                                                        <!-- <form>
                                                            <div class="mt-20 mb-20">
                                                                <label for="FormControlTextarea" class="form-label">Alert Title Text </label>
                                                                <input type="text" class="form-control valid" id="p_session" name="p_session">
                                                            </div>
                                                        </form> -->
                                                        <div class="border-bottom-grey"></div>
                                                    </div>
                                                    <div class="col-lg-12">
                                                        <div class="mt-20 mb-20">
                                                            <label class="fs-18">SMS/Push notification </label>
                                                        </div>
                                                        <form>
                                                            <div class="mb-4 pb-3">
                                                                <label for="FormControlTextarea" class="form-label">Sms/Push Text </label>
                                                                <textarea class="form-control" id="FormControlTextarea" rows="3">We hope you loved your experience at valor mixed martial arts! We're so glad that you stopped in. Visit http://dev.fitnessity.co or give us a call or visit us in person to get your next appointment on the books.</textarea>
                                                                <span class="float-right" id="business_info_count">
                                                                    <span id="display_count_business">145</span> words. Words left : <span id="word_left_business">855</span>
                                                                </span>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            <div class="tab-pane fade" id="v-pills-messages" role="tabpanel" aria-labelledby="v-pills-messages-tab">
                                                <div class="col-lg-12">
                                                    <div class="mt-20 mb-20">
                                                        <label class="fs-18">Delivery Timeline  </label>
                                                    </div>
                                                    <div class="mb-20">
                                                        <div class="mb-4 pb-3">
                                                            <form action="">
                                                                <select name="activity_type" data-behavior="on_change_submit" class="form-select" id="choices-publish-status-input" data-choices="" data-choices-search-false="">
                                                                    <option value=""> 1 hour after client first visit </option>
                                                                    <option value="">2 hours after clients first visit (recommended)</option>
                                                                    <option value="">3 hour after client first visit</option>
                                                                    <option value="">5 hour after client first visit</option>
                                                                    <option value="">10 hour after client first visit</option>
                                                                </select>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="tab-pane fade" id="v-pills-settings" role="tabpanel" aria-labelledby="v-pills-settings-tab">
                                                <div class="col-lg-12">
                                                    <div class="mt-20 mb-20">
                                                        <label class="fs-18">Delivery Method </label>
                                                    </div>
                                                    <div class="mb-4 pb-3">
                                                        <div class="">
                                                            <div id="myRadioGroup">
                                                                <!-- <input type="radio" name="cars" checked="checked" value="twoCarDiv"  /> <label class="fs-13 ml-5">Optimized delivery (recommended)</label> 
                                                                <i class="fas fa-info-circle fs-15" data-bs-toggle="tooltip" data-bs-placement="right"  data-bs-original-title="Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book."></i> <br> -->

                                                                <!-- <button type="button" class="btn-grey" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-original-title=""><i class="fas fa-question fs-10"></i> </button> <br> -->
                                                                
                                                                <input type="radio" name="cars" value="threeCarDiv" /> <label class="fs-13 ml-5">Choose your delivery method</label> 
                                                                
                                                                <div id="twoCarDiv" class="desc">
                                                                    
                                                                </div>
                                                                <div id="threeCarDiv" class="desc">
                                                                    <div class="row">
                                                                        <div class="col-lg-12 col-md-4 col-sm-6 col-12">
                                                                            <div class="mt-15">
                                                                                <div class="form-check form-switch form-switch-dark form-switch-md mb-3">
                                                                                    <input class="form-check-input" type="checkbox" role="switch" id="SwitchCheck7" checked>
                                                                                    <label class="form-check-label" for="SwitchCheck7">SMS</label>
                                                                                    <i class="fas fa-info-circle fs-15" data-bs-toggle="tooltip" data-bs-placement="right"  data-bs-original-title="You have a limited number of free marketing SMS based on your subscription. After you use them all, SMS cost $0.005 each."></i>
                                                                                </div>
                                                                                <div class="mb-15 ml-15">
                                                                                    <input type="checkbox" id="vehicle1" name="vehicle1" value="Bike">
                                                                                    <label for="vehicle1" class="push-notification">Send SMS if push notification isn't available</label>
                                                                                </div>
                                                                            </div>
                                                                        </div>

                                                                        <div class="col-lg-12 col-md-4 col-sm-6 col-12">
                                                                            <div>
                                                                                <div class="form-check form-switch form-switch-dark form-switch-md mb-3">
                                                                                    <input class="form-check-input" type="checkbox" role="switch" id="SwitchCheck8" checked>
                                                                                    <label class="form-check-label" for="SwitchCheck8">Push Notification</label>
                                                                                </div>
                                                                            </div>
                                                                        </div>

                                                                        <div class="col-lg-12 col-md-4 col-sm-6 col-12">
                                                                            <div>
                                                                                <div class="form-check form-switch form-switch-dark form-switch-md mb-3">
                                                                                    <input class="form-check-input" type="checkbox" role="switch" id="SwitchCheck9" checked>
                                                                                    <label class="form-check-label" for="SwitchCheck9">Email</label>
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
                                    </div><!--  end col -->
                                </div>
                                <!--end row-->
                            </div><!-- end card-body -->
                        </div><!-- end card -->
                    </div>
                    <div class="col-xxl-2 col-lg-2">
                        <div class="row">
                            <div class="col-lg-12 col-md-4 col-6">
                                <button type="button" class="btn btn-red w-100 mb-15">Save</button>
                            </div>
                            <div class="col-lg-12 col-md-4 col-6">
                                <button type="button" class="btn btn-black w-100 mb-15">Continue</button>  
                            </div> 
                            <div class="col-lg-12 col-md-4 col-6">
                                <button type="button" class="btn btn-red w-100 mb-15">Send Text</button>  
                            </div>
                            <div class="col-lg-12 col-md-4 col-6">
                                <button type="button" class="btn btn-black w-100 mb-15">Preview</button> 
                            </div>
                            <div class="col-lg-12 col-md-4 col-12">
                                <button type="button" class="btn btn-red w-100 mb-15">Reset to Original Template</button>   
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /#page-content-wrapper -->
    </div>
</div>
<!-- /#wrapper -->


<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="mt-20 mb-20">
                        <label for="FormControlTextarea" class="form-label">Edit Title Text </label>
                        <input type="text" class="form-control valid" id="p_session" name="p_session">
                    </div>
                </form> 
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-red">Submit</button>
            </div>
        </div>
    </div>
</div>

    @include('layouts.business.footer')

    <script>
		$(document).ready(function() {
			$("div.desc").hide();
			$("input[name$='cars']").click(function() {
				var test = $(this).val();
				$("div.desc").hide();
				$("#" + test).show();
			});
		});
	</script>
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
        window.addEventListener('DOMContentLoaded', removeClassIfNecessary); // To handle initial load
    </script>


@endsection