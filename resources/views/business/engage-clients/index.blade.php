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
                        <div class="pb-100 pt-100">
                            <div class="container">
                                <div class="row y-middle">
                                    <div class="col-lg-6">
                                        <div class="engage-client-text-section">
                                            <h3 class="mb-25">Promote your business with blast campaigns </h3>
                                            <p class="mb-15">Increase bookings and engage with your clients by sharing special offers and important updates over email and text message.</p>
                                            <ul class="mb-25">
                                                <li>Customise the message content to suit your style</li>
                                                <li>Target all clients, specific client groups or individuals</li>
                                                <li>Access powerful real-time campaign reporting</li>
                                            </ul>
                                           <!--  <a href="" class="btn btn-red mr-15">Start now</a>
                                            <a href="" class="btn btn-black">Learn more</a> -->
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="engage-client-img text-center mmt-25 imt-25">
<<<<<<< HEAD
                                            <img src="{{url('/dashboard-design/images/engage-client.png')}}" loading="lazy">
=======
                                            <img src="{{url('/dashboard-design/images/engage-client.png')}}">
>>>>>>> ce3ab0fefd0bf653e3a91b71d818121ea9ec8394
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
<<<<<<< HEAD
@include('layouts.business.scripts')
=======
>>>>>>> ce3ab0fefd0bf653e3a91b71d818121ea9ec8394

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