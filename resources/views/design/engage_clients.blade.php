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
                            </div>

                            <div class="accordion accordion-flush filter-accordion">
                                <div class="accordion-item">
                                     <h2 class="accordion-header" id="flush-headingBrands">
                                         <button class="accordion-button bg-transparent shadow-none" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseBrands" aria-expanded="true" aria-controls="flush-collapseBrands">
                                            <span class="text-uppercase fs-12 fw-medium">Inbox</span> <span class="badge bg-success rounded-pill align-middle ms-1 filter-badge"></span>
                                        </button>
                                    </h2>

                                    <div id="flush-collapseBrands" class="accordion-collapse collapse show" aria-labelledby="flush-headingBrands">
                                        <div class="accordion-body text-body pt-0">
                                            <div class="d-flex flex-column gap-2 side-submenu">
                                                <a href="#"><i class="ri-subtract-fill  mr-5"></i> Stats</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- end accordion-item -->

                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="flush-headingDiscount">
                                        <button class="accordion-button bg-transparent shadow-none collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseDiscount" aria-expanded="true" aria-controls="flush-collapseDiscount">
                                            <span class="text-uppercase fs-12 fw-medium">Announcements</span> <span class="badge bg-success rounded-pill align-middle ms-1 filter-badge"></span>
                                        </button>
                                    </h2>
                                    <div id="flush-collapseDiscount" class="accordion-collapse collapse" aria-labelledby="flush-headingDiscount">
                                        <div class="accordion-body text-body pt-1">
                                            <div class="d-flex flex-column gap-2 side-submenu">
                                                <a href="#"><i class="ri-subtract-fill  mr-5"></i> Stats</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- end accordion-item -->

                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="flush-headingRating">
                                        <button class="accordion-button bg-transparent shadow-none collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseRating" aria-expanded="false" aria-controls="flush-collapseRating">
                                            <span class="text-uppercase fs-12 fw-medium">Email Campaign</span> <span class="badge bg-success rounded-pill align-middle ms-1 filter-badge"></span>
                                        </button>
                                    </h2>

                                    <div id="flush-collapseRating" class="accordion-collapse collapse" aria-labelledby="flush-headingRating">
                                        <div class="accordion-body text-body pt-1">
                                            <div class="d-flex flex-column gap-2 side-submenu">
                                                <a href="#"><i class="ri-subtract-fill  mr-5"></i> Stats</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- end accordion-item -->

                                <div class="card-body card-header set-submenu-p">
                                    <div class="side-submenu">
                                        <a href="#" class="text-uppercase fs-12 fw-medium mb-4">Email Blast</a>
                                    </div>
                                </div>

                                <div class="card-body card-header set-submenu-p">
                                    <div class="side-submenu">
                                        <a href="#" class="text-uppercase fs-12 fw-medium mb-4">Automation Alerts</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- end card -->
                    </div>
                    <!-- <div class="col-xl-3 col-lg-4">
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
                    </div> -->
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