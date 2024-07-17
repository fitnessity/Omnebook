@inject('request', 'Illuminate\Http\Request')

@extends('layouts.business.header')

@section('content')

@include('layouts.business.business_topbar')

        <!-- ========================= Main ==================== -->
        @include('design.engage_clients_sidebar')

         
        <!-- Page Content -->
        <div id="page-content-wrapper">
            <div class="container-fluid">
                <a href="#menu-toggle" class="btn btn-black mb-15" id="menu-toggle"><i class="fas fa-bars"></i></a>
                <div class="row mb-3 y-middle">
					<div class="col-12">
						<div class="page-heading">
							<label>Smart Marketing Suite</label>
						</div>
					</div>
                </div>
                <div class="card">
                    <div class="card-body">
                        <div class="pb-100 pt-100">
                            <div class="container">
                                <div class="row y-middle">
                                    <div class="col-lg-6">
                                        <div class="engage-client-text-section">
                                            <h3 class="mb-25">Drive business growth and foster meaningful client connections through targeted email and text campaigns & alerts. </h3>
                                            <p class="mb-15">Elevate your business's performance and cultivate lasting relationships with your clientele by leveraging our innovative marketing solutions. With our comprehensive array of smart tools and actionable insights, you can unlock unprecedented growth opportunities and foster customer loyalty like never before.</p>
                                            <ul class="mb-25">
                                                <li>Tailor your message content to match your brand and needs. Our tools drive engagement and conversions for promotions, event invites, or updates.</li>
                                                <li>You can target all clients, specific demographics, or individuals with personalized messages for results.</li>
                                                <li>Use the suite of tools available to you to help you engage, grow and retain your clients.</li>
                                                <li>Our suite of tools supports every step of your customer journey, from acquisition to retention. With CRM features, advanced analytics, and reporting, you'll continuously refine strategies and maximize ROI.</li>
                                                <li>Harness the power of our smart marketing tools to boost bookings, attendance, and customer loyalty. Surpass your goals with confidence in today's competitive marketplace.</li>
                                            </ul>
                                            <!-- <a href="" class="btn btn-red mr-15">Start now</a>
                                            <a href="" class="btn btn-black">Learn more</a> -->
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="engage-client-img text-center mmt-25 imt-25">
                                            <img src="http://dev.fitnessity.co//dashboard-design/images/engage-client.png">
                                        </div>
                                    </div>
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
   


@endsection