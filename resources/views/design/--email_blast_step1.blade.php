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
                                        <a href="#" class="btn btn-red mr-5"> Back  </a> 
                                    </div>
                                </div>
                                <div class="col-lg-8">
                                    <div class="text-center">
                                        <label>Step 1 to 4: Create blast email</label>
                                        <h3>Choose a template</h3>
                                    </div>
                                </div>
                                    
                                <div class="col-lg-2">
                                    <div class="text-right">
                                        <a href="#" class="btn btn-red mr-5"> Next Step  </a> 
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-3 col-md-4 col-sm-6">
                                <div class="gift-card-radio-buttons">
                                    <label class="gift-custom-radio w-100">
                                        <input type="radio" name="radio" checked>
                                        <span class="gift-btn"><i class="las la-check"></i>
                                            <div class="hobbies-icon">
                                            <img src="http://dev.fitnessity.co/public/dashboard-design/images/temp-1.jpg">
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