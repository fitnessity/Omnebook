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
                        <div class="row">
                            <div class="col-lg-8">
                                <div class="page-heading">
                                    <label>Blast campaigns</label>
                                    <p>Choose a message type to customise from our ready-made templates</p>
                                </div>
                            </div>
                                
                            <div class="col-lg-4">
                                <div class="text-right mb-15">
                                    <a href="http://dev.fitnessity.co/design/email_blast_step1" class="btn btn-red"> Create Email  </a> 
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="filter-box mb-25"> 
                                    <div class="row">
                                        <div class="col-lg-5">
                                            <div class="search-box">
                                                <input type="text" id="searchTaskList" class="form-control search" placeholder="Search task name">
                                                <i class="ri-search-line search-icon"></i>
                                            </div>
                                        </div>
                                        <div class="col-lg-7">
                                            <div class="text-right">
                                                <div class="d-inline-block mt-15 mb-15">
                                                    <button type="button" class="btn btn-black mr-15 mr-5" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                                        Filters
                                                    </button>
                                                </div>
                                                <div class="d-inline-block">
                                                    <select class="form-select w-auto">
                                                        <option value="Sport/Activity" selected="">Created data (Newest first) </option>
                                                        <option value="Baseball">Campaign name (A-Z)</option>
                                                        <option value="Basketball">Campaign name (Z-A)</option>
                                                        <option value="Basketball">Created date (newest first)</option>
                                                        <option value="Basketball">Created date(oldest first)</option>
                                                        <option value="Basketball">Sent date(newest first)</option>
                                                        <option value="Basketball">Sent date(oldest first)</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>   
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-12">
                                <div class="card">
                                    <div class="card-body">
                                        <table id="example" class="table table-bordered dt-responsive nowrap table-striped align-middle" style="width:100%">
                                            <thead>
                                                <tr>
                                                    <th scope="col" style="width: 10px;">
                                                        <div class="form-check">
                                                            <input class="form-check-input fs-15" type="checkbox" id="checkAll" value="option">
                                                        </div>
                                                    </th>
                                                    <th data-ordering="false">Image</th>
                                                    <th data-ordering="false">Title</th>
                                                    <th data-ordering="false">Lists</th>
                                                    <th>Sent</th>
                                                    <th>Opens</th>
                                                    <th>Clicks</th>
                                                    <th>Send Date</th>
                                                    <th>Status</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <th scope="row">
                                                        <div class="form-check">
                                                            <input class="form-check-input fs-15" type="checkbox" name="checkAll" value="option1">
                                                        </div>
                                                    </th>
                                                    <td><img src="https://fitnessity-production.s3.amazonaws.com/activity/479e2f82-d571-4fec-9e51-e85e54122881.jpg" alt="" class="rounded avatar-md shadow"></td>
                                            
                                                    <td>
                                                    <div class="d-grid temp-info">
                                                        <label>Father's Day Discount</label>
                                                        <span>Email</span>
                                                    </div>
                                                    </td>
                                                    <td>All</td>
                                                    <td>0</td>
                                                    <td>0</td>
                                                    <td>0</td>
                                                    <td>
                                                        <div class="d-grid temp-info">
                                                            <p class="mb-0">14-jan-2024</p>
                                                            <p class="mb-0">12:30 PM</p>
                                                        </div>
                                                    </td>
                                                    <td><span class="badge rounded-pill text-bg-dark">Draft</span></td>
                                                    <td>
                                                        <div class="dropdown d-inline-block">
                                                            <button class="btn btn-red btn-sm dropdown" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                                <i class="ri-more-fill align-middle"></i>
                                                            </button>
                                                            <ul class="dropdown-menu dropdown-menu-end">

                                                                <li><a href="#!" class="dropdown-item"><i class="fas fa-plus me-2 text-muted"></i> Overview</a></li>
                                                                <li><a href="#!" class="dropdown-item"><i class="fas fa-plus me-2 text-muted"></i> Duplicate</a></li>
                                                                <li><a class="dropdown-item edit-item-btn"><i class="fas fa-plus me-2 text-muted"></i> Resend unopened emails</a></li>
                                                                <li><a class="dropdown-item remove-item-btn"><i class="fas fa-plus me-2 text-muted"></i> Send as text message</a></li>
                                                            </ul>
                                                        </div>
                                                    </td>
                                                </tr>

                                                <tr>
                                                    <th scope="row">
                                                        <div class="form-check">
                                                            <input class="form-check-input fs-15" type="checkbox" name="checkAll" value="option1">
                                                        </div>
                                                    </th>
                                                    <td><img src="https://fitnessity-production.s3.amazonaws.com/activity/px2AHtwuc2VNeFXIwiPxg3SyK9SVDKJCQNbKa1Ax.jpg" alt="" class="rounded avatar-md shadow"></td>
                                            
                                                    <td>
                                                    <div class="d-grid temp-info">
                                                        <label>Mother's Day Offer</label>
                                                        <span>Email</span>
                                                    </div>
                                                    </td>
                                                    <td>All</td>
                                                    <td>0</td>
                                                    <td>0</td>
                                                    <td>0</td>
                                                    <td>
                                                        
                                                    </td>
                                                    <td><span class="badge rounded-pill text-bg-success">Sent</span></td>
                                                    <td>
                                                        <div class="dropdown d-inline-block">
                                                            <button class="btn btn-red btn-sm dropdown" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                                <i class="ri-more-fill align-middle"></i>
                                                            </button>
                                                            <ul class="dropdown-menu dropdown-menu-end">

                                                                <li><a href="#!" class="dropdown-item"><i class="fas fa-plus me-2 text-muted"></i> Overview</a></li>
                                                                <li><a href="#!" class="dropdown-item"><i class="fas fa-plus me-2 text-muted"></i> Duplicate</a></li>
                                                                <li><a class="dropdown-item edit-item-btn"><i class="fas fa-plus me-2 text-muted"></i> Resend unopened emails</a></li>
                                                                <li><a class="dropdown-item remove-item-btn"><i class="fas fa-plus me-2 text-muted"></i> Send as text message</a></li>
                                                            </ul>
                                                        </div>
                                                    </td>
                                                </tr>
                                            
                                                <tr>
                                                    <th scope="row">
                                                        <div class="form-check">
                                                            <input class="form-check-input fs-15" type="checkbox" name="checkAll" value="option1">
                                                        </div>
                                                    </th>
                                                    <td><img src="https://fitnessity-production.s3.amazonaws.com/activity/meka8JsFR68TpdRhatzxzZpTFPVUSvgEx1MGILm5.jpg" alt="" class="rounded avatar-md shadow"></td>
                                            
                                                    <td>
                                                    <div class="d-grid temp-info">
                                                        <label>Send a limited time offer</label>
                                                        <span>Email</span>
                                                    </div>
                                                    </td>
                                                    <td>All</td>
                                                    <td>0</td>
                                                    <td>0</td>
                                                    <td>0</td>
                                                    <td>
                                                        <div class="d-grid temp-info">
                                                            <p class="mb-0">16-fab-2024</p>
                                                            <p class="mb-0">12:30 PM</p>
                                                        </div>
                                                    </td>
                                                    <td><span class="badge rounded-pill text-bg-success">Sent</span></td>
                                                    <td>
                                                        <div class="dropdown d-inline-block">
                                                            <button class="btn btn-red btn-sm dropdown" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                                <i class="ri-more-fill align-middle"></i>
                                                            </button>
                                                            <ul class="dropdown-menu dropdown-menu-end">

                                                                <li><a href="#!" class="dropdown-item"><i class="fas fa-plus me-2 text-muted"></i> Overview</a></li>
                                                                <li><a href="#!" class="dropdown-item"><i class="fas fa-plus me-2 text-muted"></i> Duplicate</a></li>
                                                                <li><a class="dropdown-item edit-item-btn"><i class="fas fa-plus me-2 text-muted"></i> Resend unopened emails</a></li>
                                                                <li><a class="dropdown-item remove-item-btn"><i class="fas fa-plus me-2 text-muted"></i> Send as text message</a></li>
                                                            </ul>
                                                        </div>
                                                    </td>
                                                </tr>

                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- <div class="email-blast-list mb-15">
                            <div class="row y-middle">
                                <div class="col-xxl-1 col-lg-2">
                                    <div class="">
                                        <img src="https://fitnessity-production.s3.amazonaws.com/activity/479e2f82-d571-4fec-9e51-e85e54122881.jpg" alt="" class="rounded avatar-md shadow">
                                    </div>
                                </div>
                                <div class="col-xxl-8">
                                    <div class="d-grid temp-info">
                                        <label>Father's Day Discount</label>
                                        <span>Email</span>
                                        <p class="mb-0 text-grey">17 Jun 2024</p>
                                    </div>
                                </div>
                                <div class="col-xxl-1">
                                    <span class="badge rounded-pill text-bg-success float-right">Sent</span>
                                </div>
                                <div class="col-xxl-1">
                                    <div class="d-grid temp-info float-right">
                                        <p class="mb-0 text-grey">Audience</p>
                                        <label>3 Clients</label>
                                    </div>
                                </div>
                                <div class="col-xxl-1">
                                    <div class="float-right client-btn-padding">
								        <div class="client-setting-icon email-blast-w">
										    <i class="ri-more-fill"></i>
										    <ul>
										        <li>
												    <a href="" data-bs-toggle="modal" data-bs-target=".tax"><i class="fas fa-plus text-muted"></i>Overview</a>
											    </li>
											    <li><a href=""><i class="fas fa-plus text-muted"></i>Duplicate</a></li>
                                                <li><a href=""><i class="fas fa-plus text-muted"></i>Resend unopened emails</a></li>
                                                <li><a href=""><i class="fas fa-plus text-muted"></i>Send as text message</a></li>
										    </ul>
									    </div>
								    </div>
                                </div>
                            </div>
                        </div>
                        <div class="email-blast-list mb-15">
                            <div class="row y-middle">
                                <div class="col-xxl-1 col-lg-2">
                                    <div class="">
                                        <img src="https://fitnessity-production.s3.amazonaws.com/activity/px2AHtwuc2VNeFXIwiPxg3SyK9SVDKJCQNbKa1Ax.jpg" alt="" class="rounded avatar-md shadow">
                                    </div>
                                </div>
                                <div class="col-xxl-8">
                                    <div class="d-grid temp-info">
                                        <label>Mother's Day Offer</label>
                                        <span>Email</span>
                                    </div>
                                </div>
                                <div class="col-xxl-1">
                                    <span class="badge rounded-pill text-bg-dark float-right">Draft</span>
                                </div>
                                <div class="col-xxl-1">
                                    
                                </div>
                                <div class="col-xxl-1">
                                    <div class="float-right client-btn-padding">
								        <div class="client-setting-icon email-blast-w">
										    <i class="ri-more-fill"></i>
										    <ul>
										        <li>
												    <a href="" data-bs-toggle="modal" data-bs-target=".tax"><i class="fas fa-plus text-muted"></i>Overview</a>
											    </li>
											    <li><a href=""><i class="fas fa-plus text-muted"></i>Duplicate</a></li>
                                                <li><a href=""><i class="fas fa-plus text-muted"></i>Resend unopened emails</a></li>
                                                <li><a href=""><i class="fas fa-plus text-muted"></i>Send as text message</a></li>
										    </ul>
									    </div>
								    </div>
                                </div>
                            </div>
                        </div>
                        <div class="email-blast-list mb-15">
                            <div class="row y-middle">
                                <div class="col-xxl-1 col-lg-2">
                                    <div class="">
                                        <img src="https://fitnessity-production.s3.amazonaws.com/activity/meka8JsFR68TpdRhatzxzZpTFPVUSvgEx1MGILm5.jpg" alt="" class="rounded avatar-md shadow">
                                    </div>
                                </div>
                                <div class="col-xxl-8">
                                    <div class="d-grid temp-info">
                                        <label>Send a limited time offer</label>
                                        <span>Email</span>
                                        <p class="mb-0 text-grey">2 April 2024</p>
                                    </div>
                                </div>
                                <div class="col-xxl-1">
                                    <span class="badge rounded-pill text-bg-success float-right">Sent</span>
                                </div>
                                <div class="col-xxl-1">
                                    <div class="d-grid temp-info float-right">
                                        <p class="mb-0 text-grey">Audience</p>
                                        <label>3 Clients</label>
                                    </div>
                                </div>
                                <div class="col-xxl-1">
                                    <div class="float-right client-btn-padding">
								        <div class="client-setting-icon email-blast-w">
										    <i class="ri-more-fill"></i>
										    <ul>
										        <li>
												    <a href="" data-bs-toggle="modal" data-bs-target=".tax"><i class="fas fa-plus text-muted"></i>Overview</a>
											    </li>
											    <li><a href=""><i class="fas fa-plus text-muted"></i>Duplicate</a></li>
                                                <li><a href=""><i class="fas fa-plus text-muted"></i>Resend unopened emails</a></li>
                                                <li><a href=""><i class="fas fa-plus text-muted"></i>Send as text message</a></li>
										    </ul>
									    </div>
								    </div>
                                </div>
                            </div>
                        </div> -->
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

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Filters</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div>
                    <div class="mb-3">
                        <label for="choices-publish-status-input" class="form-label">Campaign channel</label>
                        <select class="form-select">
                            <option value="" selected="">All</option>
                            <option value="">Option 1</option>
                            <option value="">Option 2</option>
                        </select>
			        </div>

                    <div class="mb-3">
                        <label for="choices-publish-status-input" class="form-label">Campaign status</label>
                        <select class="form-select">
                            <option value="" selected="">All</option>
                            <option value="">Option 1</option>
                            <option value="">Option 2</option>
                        </select>
			        </div>
                </div>
                <div class="row y-middle">
                    <div class="col-lg-6">
                        <a href="#">Clear all filters</a>
                    </div>
                    <div class="col-lg-6">
                        <div class="float-right">
                            <button type="button" class="btn btn-black" data-bs-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-red">Apply</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



@include('layouts.business.footer')
    <script>
        new DataTable('#example', {
            responsive: true,
            searching: false,
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
    <script>
        new DataTable('#add_clients', {
            responsive: true
        });
	</script>


@endsection