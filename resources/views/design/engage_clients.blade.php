@inject('request', 'Illuminate\Http\Request')

@extends('layouts.business.header')

@section('content')

@include('layouts.business.business_topbar')

    <div class="main-content">
		<div class="page-content">
			<div class="container-fluid">
                <div class="row">
                    <div class="col-xl-3 col-lg-4">
                        <div class="card">
                            <div class="card-header">
                                <div class="d-flex mb-3">
                                    <div class="flex-grow-1">
                                        <h5 class="fs-16">Messaging</h5>
                                    </div>
                                </div>
                                <div class="engage-client-submenu">
                                    <ul class="list-unstyled mb-0 filter-list">
                                        <li>
                                            <a href="#" class="d-flex py-1 align-items-center active">
                                                <div class="flex-grow-1">
                                                    <h5 class="fs-13 mb-0 listname">Inbox</h5>
                                                </div>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#" class="d-flex py-1 align-items-center">
                                                <div class="flex-grow-1">
                                                    <h5 class="fs-13 mb-0 listname">Announcements</h5>
                                                </div>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#" class="d-flex py-1 align-items-center">
                                                <div class="flex-grow-1">
                                                    <h5 class="fs-13 mb-0 listname">Email Blast</h5>
                                                </div>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#" class="d-flex py-1 align-items-center">
                                                <div class="flex-grow-1">
                                                    <h5 class="fs-13 mb-0 listname">Automation Alerts</h5>
                                                </div>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <!-- end card -->
                    </div>
                    <!-- end col -->

                    <div class="col-xl-9 col-lg-8">
                        <div class="card">
                            <div class="card-body">
                                <div class="row align-items-center">
                                    <div class="col-6">

                                    </div>
                                </div>
                            </div>
                            <!-- end card header -->
                                  
                        </div>
                        <!-- end card -->
                    </div>
                    <!-- end col -->
                </div>
                <!-- end row -->
			</div>
		</div>
	</div>
</div><!-- END layout-wrapper -->

@include('layouts.business.footer')

@endsection