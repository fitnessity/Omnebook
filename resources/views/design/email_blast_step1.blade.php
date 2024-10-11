@inject('request', 'Illuminate\Http\Request')

@extends('layouts.business.header')

@section('content')

@include('layouts.business.business_topbar')

        <!-- ========================= Main ==================== -->
        @include('business.engage-clients.engage_clients_sidebar')

         
        <!-- Page Content -->
        <div id="page-content-wrapper">
            <div class="container-fluid">
                <a href="#menu-toggle" class="btn btn-black mb-15" id="menu-toggle"><i class="fas fa-bars"></i></a>

                <div class="card">
                    <div class="card-body">
                        <div class="mb-35">
                            <div class="row y-middle">
                                <div class="col-lg-2">
                                    <div class="text-left">
                                        <a href="https://dev.fitnessity.co/design/email_blast" class="btn btn-red mr-5"> Back  </a> 
                                    </div>
                                </div>
                                <div class="col-lg-8">
                                    <div class="text-center">
                                        <label>Step 1 to 3: Create blast email</label>
                                        <h3>Choose a template</h3>
                                    </div>
                                </div>
                                    
                                <div class="col-lg-2">
                                    <div class="text-right">
                                        <a href="https://dev.fitnessity.co/design/email_blast_step2" class="btn btn-red mr-5"> Edit </a> 
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-12">
                                <div class="mb-25 align-items-center d-flex">
                                    <h4 class="card-title mb-0 flex-grow-1">Saved Templates</h4>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-4 col-sm-6">
                                <div class="gift-card-radio-buttons">
                                    <label class="gift-custom-radio w-100">
                                        <input type="radio" name="radio" checked>
                                        <span class="gift-btn"><i class="las la-check"></i>
                                            <div class="hobbies-icon">
                                                <img src="../dashboard-design/drag-and-drop/images/temp-1.jpg">
                                            </div>
                                        </span>
                                    </label>
                                </div>
                            </div>
                            <!-- <div class="col-lg-3 col-md-4 col-sm-6">
                                <div class="gift-card-radio-buttons">
                                    <label class="gift-custom-radio  w-100">
                                        <input type="radio" name="radio" >
                                        <span class="gift-btn"><i class="las la-check"></i>
                                            <div class="hobbies-icon">
                                                <img src="http://dev.fitnessity.co/public/dashboard-design/images/temp-2.jpg">
                                            </div>
                                        </span>
                                    </label>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-4 col-sm-6">
                                <div class="gift-card-radio-buttons">
                                    <label class="gift-custom-radio  w-100">
                                        <input type="radio" name="radio" >
                                        <span class="gift-btn"><i class="las la-check"></i>
                                            <div class="hobbies-icon">
                                                <img src="http://dev.fitnessity.co/public/dashboard-design/images/temp-3.jpg">
                                            </div>
                                        </span>
                                    </label>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-4 col-sm-6">
                                <div class="gift-card-radio-buttons">
                                    <label class="gift-custom-radio  w-100">
                                        <input type="radio" name="radio" >
                                        <span class="gift-btn"><i class="las la-check"></i>
                                            <div class="hobbies-icon">
                                                <img src="http://dev.fitnessity.co/public/dashboard-design/images/temp-4.jpg">
                                            </div>
                                        </span>
                                    </label>
                                </div>
                            </div> -->
                        </div>

                        <div class="row">
                            <div class="col-lg-12">
                                <div class="mb-25 mt-25 align-items-center d-flex">
                                    <h4 class="card-title mb-0 flex-grow-1">Get Started</h4>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-4 col-sm-6">
                                <div class="gift-card-radio-buttons">
                                    <label class="gift-custom-radio w-100">
                                        <input type="radio" name="radio" checked>
                                        <span class="gift-btn"><i class="las la-check"></i>
                                            <div class="hobbies-icon">
                                                <img src="../dashboard-design/drag-and-drop/images/get-started.jpg">
                                            </div>
                                        </span>
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-12">
                                <div class="mb-25 mt-25 align-items-center d-flex">
                                    <h4 class="card-title mb-0 flex-grow-1">Announcements & Promotions</h4>
                                </div>
                            </div>
                           <div class="col-lg-3 col-md-4 col-sm-6">
                                <div class="gift-card-radio-buttons">
                                    <label class="gift-custom-radio w-100">
                                        <input type="radio" name="radio">
                                        <span class="gift-btn"><i class="las la-check"></i>
                                            <div class="hobbies-icon">
                                                <img src="../dashboard-design/drag-and-drop/images/temp-4.jpg">
                                            </div>
                                        </span>
                                    </label>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-4 col-sm-6">
                                <div class="gift-card-radio-buttons">
                                    <label class="gift-custom-radio  w-100">
                                        <input type="radio" name="radio" >
                                        <span class="gift-btn"><i class="las la-check"></i>
                                            <div class="hobbies-icon">
                                                <img src="../dashboard-design/drag-and-drop/images/temp-5.jpg">
                                            </div>
                                        </span>
                                    </label>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-4 col-sm-6">
                                <div class="gift-card-radio-buttons">
                                    <label class="gift-custom-radio  w-100">
                                        <input type="radio" name="radio" >
                                        <span class="gift-btn"><i class="las la-check"></i>
                                            <div class="hobbies-icon">
                                                <img src="../dashboard-design/drag-and-drop/images/temp-6.jpg">
                                            </div>
                                        </span>
                                    </label>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-4 col-sm-6">
                                <div class="gift-card-radio-buttons">
                                    <label class="gift-custom-radio  w-100">
                                        <input type="radio" name="radio" >
                                        <span class="gift-btn"><i class="las la-check"></i>
                                            <div class="hobbies-icon">
                                                <img src="../dashboard-design/drag-and-drop/images/temp-7.jpg">
                                            </div>
                                        </span>
                                    </label>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-4 col-sm-6">
                                <div class="gift-card-radio-buttons">
                                    <label class="gift-custom-radio  w-100">
                                        <input type="radio" name="radio" >
                                        <span class="gift-btn"><i class="las la-check"></i>
                                            <div class="hobbies-icon">
                                                <img src="../dashboard-design/drag-and-drop/images/temp-8.jpg">
                                            </div>
                                        </span>
                                    </label>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-4 col-sm-6">
                                <div class="gift-card-radio-buttons">
                                    <label class="gift-custom-radio  w-100">
                                        <input type="radio" name="radio" >
                                        <span class="gift-btn"><i class="las la-check"></i>
                                            <div class="hobbies-icon">
                                                <img src="../dashboard-design/drag-and-drop/images/temp-9.jpg">
                                            </div>
                                        </span>
                                    </label>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-4 col-sm-6">
                                <div class="gift-card-radio-buttons">
                                    <label class="gift-custom-radio  w-100">
                                        <input type="radio" name="radio" >
                                        <span class="gift-btn"><i class="las la-check"></i>
                                            <div class="hobbies-icon">
                                                <img src="../dashboard-design/drag-and-drop/images/temp-16.jpg">
                                            </div>
                                        </span>
                                    </label>
                                </div>
                            </div>
                        </div>
                      
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="mb-25 mt-25 align-items-center d-flex">
                                    <h4 class="card-title mb-0 flex-grow-1">Holiday Templates</h4>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-4 col-sm-6">
                                <div class="gift-card-radio-buttons">
                                    <label class="gift-custom-radio w-100">
                                        <input type="radio" name="radio">
                                        <span class="gift-btn"><i class="las la-check"></i>
                                            <div class="hobbies-icon">
                                                <img src="../dashboard-design/drag-and-drop/images/temp-2.jpg">
                                            </div>
                                        </span>
                                    </label>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-4 col-sm-6">
                                <div class="gift-card-radio-buttons">
                                    <label class="gift-custom-radio  w-100">
                                        <input type="radio" name="radio" >
                                        <span class="gift-btn"><i class="las la-check"></i>
                                            <div class="hobbies-icon">
                                                <img src="../dashboard-design/drag-and-drop/images/temp-3.jpg">
                                            </div>
                                        </span>
                                    </label>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-4 col-sm-6">
                                <div class="gift-card-radio-buttons">
                                    <label class="gift-custom-radio  w-100">
                                        <input type="radio" name="radio" >
                                        <span class="gift-btn"><i class="las la-check"></i>
                                            <div class="hobbies-icon">
                                                <img src="../dashboard-design/drag-and-drop/images/temp-10.jpg">
                                            </div>
                                        </span>
                                    </label>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-4 col-sm-6">
                                <div class="gift-card-radio-buttons">
                                    <label class="gift-custom-radio  w-100">
                                        <input type="radio" name="radio" >
                                        <span class="gift-btn"><i class="las la-check"></i>
                                            <div class="hobbies-icon">
                                                <img src="../dashboard-design/drag-and-drop/images/temp-11.jpg">
                                            </div>
                                        </span>
                                    </label>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-4 col-sm-6">
                                <div class="gift-card-radio-buttons">
                                    <label class="gift-custom-radio  w-100">
                                        <input type="radio" name="radio" >
                                        <span class="gift-btn"><i class="las la-check"></i>
                                            <div class="hobbies-icon">
                                                <img src="../dashboard-design/drag-and-drop/images/temp-12.jpg">
                                            </div>
                                        </span>
                                    </label>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-4 col-sm-6">
                                <div class="gift-card-radio-buttons">
                                    <label class="gift-custom-radio  w-100">
                                        <input type="radio" name="radio" >
                                        <span class="gift-btn"><i class="las la-check"></i>
                                            <div class="hobbies-icon">
                                                <img src="../dashboard-design/drag-and-drop/images/temp-13.jpg">
                                            </div>
                                        </span>
                                    </label>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-4 col-sm-6">
                                <div class="gift-card-radio-buttons">
                                    <label class="gift-custom-radio  w-100">
                                        <input type="radio" name="radio" >
                                        <span class="gift-btn"><i class="las la-check"></i>
                                            <div class="hobbies-icon">
                                                <img src="../dashboard-design/drag-and-drop/images/temp-14.jpg">
                                            </div>
                                        </span>
                                    </label>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-4 col-sm-6">
                                <div class="gift-card-radio-buttons">
                                    <label class="gift-custom-radio  w-100">
                                        <input type="radio" name="radio" >
                                        <span class="gift-btn"><i class="las la-check"></i>
                                            <div class="hobbies-icon">
                                                <img src="../dashboard-design/drag-and-drop/images/temp-15.jpg">
                                            </div>
                                        </span>
                                    </label>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-4 col-sm-6">
                                <div class="gift-card-radio-buttons">
                                    <label class="gift-custom-radio  w-100">
                                        <input type="radio" name="radio" >
                                        <span class="gift-btn"><i class="las la-check"></i>
                                            <div class="hobbies-icon">
                                                <img src="../dashboard-design/drag-and-drop/images/temp-17.jpg">
                                            </div>
                                        </span>
                                    </label>
                                </div>
                            </div>

                        </div>

                    </div>
                    <!-- end card header -->
                </div>
                <!-- end card -->
            </div>
        </div>
        <!-- /#page-content-wrapper -->
    </div>
</div>
<!-- /#wrapper -->




@include('layouts.business.footer')
@include('layouts.business.scripts')
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
    <script>
        new DataTable('#add_clients', {
            responsive: true
        });
	</script>


@endsection