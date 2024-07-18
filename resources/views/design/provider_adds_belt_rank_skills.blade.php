@inject('request', 'Illuminate\Http\Request')
@extends('layouts.business.header')

@section('content')
@include('layouts.profile.business_topbar')

	<div class="main-content">
		<div class="page-content">
			<div class="container-fluid">
				<div class="row mb-3">
					<div class="col-lg-6 col-md-9 col-sm-12 col-12">
						<div class="page-heading">
							<label>Manage Students Promotions & Workouts</label>
                            <p>Manage workouts, belt ranks, promotions, curriculums, certifications and awards for your students</p>
						</div>
					</div>
                    <div class="col-lg-6 col-md-3 col-sm-12 col-12">
                        <div class="service-create">
                            <button type="button" class="btn btn-red">Add Program</button>
					    </div>
					</div>				
				</div><!--end row-->
				<div class="row">
					<div class="col-xxl-12">
						<div class="card">
							<div class="card-body">
								<!-- Nav tabs -->
								<ul class="nav nav-tabs mb-3" role="tablist">
                                     <li class="nav-item">
										<a class="nav-link active" data-bs-toggle="tab" href="#Clients" role="tab" aria-selected="false">
                                            Clients
										</a>
									</li>
									<li class="nav-item">
										<a class="nav-link " data-bs-toggle="tab" href="#Notes" role="tab" aria-selected="false">
                                            Programs
										</a>
									</li>
									<li class="nav-item">
										<a class="nav-link" data-bs-toggle="tab" href="#Curriculum" role="tab" aria-selected="false">
                                            Library
										</a>
									</li>
								</ul>
								<!-- Tab panes -->
								<div class="tab-content  text-muted">
                                    <div class="tab-pane active" id="Clients" role="tabpanel">
                                        <div class="card">
                                            <div class="card-header align-items-center d-flex">
                                                <div class="float-right">
                                                    <div class="search-set manage-search manage-space">
                                                        <div class="client-search">
                                                            <div class="position-relative">
                                                                <input type="text" class="form-control" placeholder="Search for client" autocomplete="off" id="search-options" value="">
                                                                <span class="mdi mdi-magnify search-widget-icon"></span>
                                                                <span class="mdi mdi-close-circle search-widget-icon search-widget-icon-close d-none" id="search-close-options"></span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div><!-- end card header -->
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-lg-2 col-md-6 col-sm-6 col-xxl-2">
                                                        <button type="button" class="btn btn-red mr-5  w-100 mb-25" data-bs-toggle="modal" data-bs-target="#exampleModal">Promote</button>
                                                    </div>
                                                    <div class="col-lg-3 col-md-6 col-sm-6 col-xxl-2">
                                                        <button type="button" class="btn btn-red mr-5 w-100 mb-25">Update Progress</button>
                                                    </div>
                                                    <!--<div class="col-lg-3 col-xxl-2">
                                                        <div class="mb-25">
                                                            <select class="form-select valid price-info" data-behavior="change_price_title" data-booking-checkin-detail-id="260">
                                                                <option value="" selected="">More Actions</option>
                                                                <option value="775">Option 1</option>
                                                                <option value="812">Option 2</option>
                                                            </select>
                                                        </div>
                                                    </div>-->
                                                    <div class="col-lg-12">
                                                        <div class="mb-15">
                                                            <label>Clients With Completed Criteria 00</label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                <table id="announcement_list" class="table table-bordered dt-responsive nowrap table-striped align-middle" style="width:100%">
                                                    <thead>
                                                        <tr>
                                                            <th scope="col" style="width: 10px;">
                                                                <div class="form-check">
                                                                    <input class="form-check-input fs-15" type="checkbox" id="checkAll" value="option">
                                                                </div>
                                                            </th>
                                                            <th data-ordering="false">Student Name</th>
                                                            <th data-ordering="false">Current Level</th>
                                                            <th data-ordering="false">Date Achieved</th>
                                                            <th data-ordering="false">Progress</th>
                                                            <th data-ordering="false">Hours At Level</th>
                                                            <th data-ordering="false"></th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>										
                                                        <tr>
                                                            <th scope="row">
                                                                <div class="form-check">
                                                                    <input class="form-check-input fs-15" type="checkbox" name="checkAll" value="option1">
                                                                </div>
                                                            </th>
                                                            <td>Nipa Soni</td>
                                                            <td><div class="d-flex w-ipad w-fold"><div class="cgreen w-50px mr-5"></div> <span class="lh-24">Green Belt</span></div></td>
                                                            <td>11/19/2023</td>
                                                            <td>0</td>
                                                            <td>0</td>
                                                            <td><ul class="list-inline hstack gap-2 mb-0">
                                                                <li class="list-inline-item" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="top" aria-label="View" data-bs-original-title="View">
                                                                    <a href="#" class="text-red d-inline-block" data-bs-toggle="modal" data-bs-target="#view_Modal">
                                                                        <i class="ri-eye-fill fs-16"></i>
                                                                    </a>
                                                                </li>
                                                            </ul></td>
                                                        </tr>        
                                                        <tr>
                                                            <th scope="row">
                                                                <div class="form-check">
                                                                    <input class="form-check-input fs-15" type="checkbox" name="checkAll" value="option1">
                                                                </div>
                                                            </th>
                                                            <td>Ankita Patel</td>
                                                            <td>
                                                                <div class="d-flex w-ipad w-fold">
                                                                    <div class="cyellow w-50px mr-5">
                                                                        <div class="inner-belt">                                                                                                    
                                                                        </div>
                                                                    </div>
                                                                    <span class="lh-24">Yellow Belt-1 Stripe</span>
                                                                </div>
                                                            </td>
                                                            <td>12/5/2022</td>
                                                            <td>0</td>
                                                            <td>0</td>
                                                            <td><ul class="list-inline hstack gap-2 mb-0">
                                                                <li class="list-inline-item" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="top" aria-label="View" data-bs-original-title="View">
                                                                    <a href="#" class="text-red d-inline-block" data-bs-toggle="modal" data-bs-target="#view_Modal">
                                                                        <i class="ri-eye-fill fs-16"></i>
                                                                    </a>
                                                                </li>
                                                            </ul></td>
                                                        </tr>      
                                                        <tr>
                                                            <th scope="row">
                                                                <div class="form-check">
                                                                    <input class="form-check-input fs-15" type="checkbox" name="checkAll" value="option1">
                                                                </div>
                                                            </th>
                                                            <td>Purvi Patel</td>
                                                            <td>
                                                                <div class="d-flex w-ipad w-fold">
                                                                    <div class="cred w-50px mr-5">
                                                                    </div>
                                                                    <span class="lh-24">Red Belt</span>
                                                                </div>
                                                            </td>
                                                            <td>12/5/2022</td>
                                                            <td>0</td>
                                                            <td>0</td>
                                                            <td><ul class="list-inline hstack gap-2 mb-0">
                                                                <li class="list-inline-item" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="top" aria-label="View" data-bs-original-title="View">
                                                                    <a href="#" class="text-red d-inline-block" data-bs-toggle="modal" data-bs-target="#view_Modal">
                                                                        <i class="ri-eye-fill fs-16"></i>
                                                                    </a>
                                                                </li>
                                                            </ul></td>
                                                        </tr>                               
                                                    </tbody>
                                                </table>
                                                </div>
                                            </div><!-- end card Body -->
                                        </div>
                                    </div>
									<div class="tab-pane" id="Notes" role="tabpanel">
                                        <div class="card card-height-100">
                                            <div class="card-header align-items-center d-flex">
                                                <h4 class="card-title mb-0 flex-grow-1">Martial Arts</h4>
                                            </div><!-- end card header -->

                                            <!-- card body -->
                                            <div class="card-body">
                                                <div class="py-2 mt-1">
                                                   <div class="row">
                                                        <div class="col-6">
                                                            <div class="teakwondo">
                                                                <label>Taekwondo</label>
                                                            </div>
                                                         </div>
                                                         <div class="col-6">
                                                            <div class="float-right">
                                                                <button type="button" class="btn btn-red">Edit</button>
                                                            </div>                                                             
                                                        </div>
                                                   </div>
                                                   <div class="row">
                                                        <div class="col-12">
                                                            <div class="live-preview py-2">
                                                                <div class="accordion custom-accordionwithicon-plus" id="accordionWithplusicon">
                                                                    <div class="accordion-item shadow">
                                                                        <h2 class="accordion-header" id="accordionwithplusExample1">
                                                                            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#accor_plusExamplecollapse1" aria-expanded="true" aria-controls="accor_plusExamplecollapse1">
                                                                                <div class="container-fluid nopadding">
                                                                                    <div class="row">
                                                                                        <div class="col-6">
                                                                                            Show Ranks
                                                                                        </div>
                                                                                        <div class="col-6">
                                                                                            <div class="float-end mr-15"><label class="fs-16">1 <span class="fs-13">Members</span></label></div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>                                                                              
                                                                            </button>
                                                                        </h2>
                                                                        <div id="accor_plusExamplecollapse1" class="accordion-collapse collapse show" aria-labelledby="accordionwithplusExample1" data-bs-parent="#accordionWithplusicon">
                                                                            <div class="accordion-body">
                                                                                <div class="greybox mb-10">
                                                                                    <div class="row">
                                                                                        <div class="col-lg-1 col-md-3 col-sm-3 col-6">
                                                                                            <div class="cgreen">
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="col-lg-3 col-md-3 col-sm-3 col-6">
                                                                                            <label>Green</label>
                                                                                        </div>
                                                                                        <div class="col-lg-8 col-sm-6 col-md-6 col-12">
                                                                                            <div class="float-end"><label class="fs-16 mb-0">1 <span class="fs-13">Members</span></label></div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>     
                                                                                
                                                                                <div class="greybox mb-10">
                                                                                    <div class="row">
                                                                                        <div class="col-lg-1 col-md-3 col-sm-3 col-6">
                                                                                            <div class="cyellow">
                                                                                                <div class="inner-belt">                                                                                                    
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="col-lg-3 col-md-3 col-sm-3 col-6">
                                                                                            <label>Yellow /Red Top</label>
                                                                                        </div>
                                                                                        <div class="col-lg-8 col-sm-6 col-md-6 col-12">
                                                                                            <div class="float-end"><label class="fs-16 mb-0">0 <span class="fs-13">Members</span></label></div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>

                                                                                <div class="greybox mb-10">
                                                                                    <div class="row">
                                                                                        <div class="col-lg-1 col-md-3 col-sm-3 col-6">
                                                                                            <div class="cblack">
                                                                                                <div class="vertical-inner-belt">                                                                                                    
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="col-lg-3 col-md-3 col-sm-3 col-6">
                                                                                            <label>Black 1st Dan</label>
                                                                                        </div>
                                                                                        <div class="col-lg-8 col-sm-6 col-md-6 col-12">
                                                                                            <div class="float-end"><label class="fs-16 mb-0">0 <span class="fs-13">Members</span></label></div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>

                                                                                <div class="greybox mb-10">
                                                                                    <div class="row">
                                                                                        <div class="col-lg-1 col-md-3 col-sm-3 col-6">
                                                                                            <div class="cblack">
                                                                                                <div class="vertical-inner-belt mr-5">                                                                                                    
                                                                                                </div>
                                                                                                <div class="vertical-inner-belt">                                                                                                    
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="col-lg-3 col-md-3 col-sm-3 col-6">
                                                                                            <label>Black 2nd Dan</label>
                                                                                        </div>
                                                                                        <div class="col-lg-8 col-sm-6 col-md-6 col-12">
                                                                                            <div class="float-end"><label class="fs-16 mb-0">0 <span class="fs-13">Members</span></label></div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>

                                                                                <div class="greybox mb-10">
                                                                                    <div class="row">
                                                                                        <div class="col-lg-1 col-md-3 col-sm-3 col-6">
                                                                                            <div class="cblack">
                                                                                                <div class="vertical-inner-belt mr-5">                                                                                                    
                                                                                                </div>
                                                                                                <div class="vertical-inner-belt mr-5">                                                                                                    
                                                                                                </div>
                                                                                                <div class="vertical-inner-belt mr-5">                                                                                                    
                                                                                                </div>
                                                                                                <div class="vertical-inner-belt mr-5">                                                                                                    
                                                                                                </div>
                                                                                                <div class="vertical-inner-belt mr-5">                                                                                                    
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="col-lg-3 col-md-3 col-sm-3 col-6">
                                                                                            <label>Black 5th Dan</label>
                                                                                        </div>
                                                                                        <div class="col-lg-8 col-sm-6 col-md-6 col-12">
                                                                                            <div class="float-end"><label class="fs-16 mb-0">1 <span class="fs-13">Members</span></label></div>
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
                                            <!-- end card body -->
                                        </div>
									</div>
									<div class="tab-pane" id="Curriculum" role="tabpanel">
										<div class="row">
											<div class="col-xxl-12 col-lg-12">
												<div class="">
													<div class="">
                                                        <ul class="nav nav-tabs mb-3" role="tablist">
                                                            <li class="nav-item">
                                                                <a class="nav-link active" data-bs-toggle="tab" href="#Belt_Curriculum" role="tab" aria-selected="false">
                                                                    Belt Curriculum
                                                                </a>
                                                            </li>
                                                            <!--<li class="nav-item">
                                                                <a class="nav-link" data-bs-toggle="tab" href="#Workouts" role="tab" aria-selected="false">
                                                                    Workouts
                                                                </a>
                                                            </li> -->
                                                            <li class="nav-item">
                                                                <a class="nav-link" data-bs-toggle="tab" href="#Video_Library" role="tab" aria-selected="false">
                                                                    Video Library
                                                                </a>
                                                            </li>                                                             
                                                        </ul>
                                                        <div class="tab-content text-muted">                                                            
                                                            <div class="tab-pane active" id="Belt_Curriculum" role="tabpanel">
                                                                <div class="">
                                                                    <div class="">
                                                                    <!-- Nav tabs -->
                                                                    <ul class="nav nav-tabs mb-3" role="tablist">
                                                                        <li class="nav-item">
                                                                            <a class="nav-link active" data-bs-toggle="tab" href="#Categories" role="tab" aria-selected="false">
                                                                                Categories
                                                                            </a>
                                                                        </li>
                                                                        <li class="nav-item">
                                                                            <a class="nav-link" data-bs-toggle="tab" href="#Library" role="tab" aria-selected="false">
                                                                                Skills Library
                                                                            </a>
                                                                        </li>  
                                                                    </ul>
                                                                    <!-- Tab panes -->
                                                                    <div class="tab-content  text-muted">
                                                                        <div class="tab-pane active" id="Categories" role="tabpanel">
                                                                            <div class="card">
                                                                                <div class="card-header align-items-center text-end">
                                                                                    <div>
                                                                                        <button type="button" class="btn btn-red" data-bs-toggle="modal" data-bs-target="#addcat">
                                                                                            Add Catagory
                                                                                        </button>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="card-body">
                                                                                    <div class="mb-25">
                                                                                        <div class="row">
                                                                                            <div class="col-lg-12">
                                                                                                <div class="text-center title-sparetor mb-25">
                                                                                                    <label class="fs-19 font-red">Martial Arts</label>
                                                                                                </div>                                                                                
                                                                                            </div>
                                                                                            <div class="col-lg-6">
                                                                                                <div class="skills-edit mb-10">
                                                                                                    <div class="row">
                                                                                                        <div class="col-lg-8 col-md-8 col-sm-8 col-6">
                                                                                                            <label class="mb-0">Kicks</label>
                                                                                                        </div>
                                                                                                        <div class="col-lg-4 col-md-4 col-sm-4 col-6">
                                                                                                            <div class="text-end">
                                                                                                                <button class="btn btn-sm btn-soft-danger remove-list" data-bs-toggle="modal" data-bs-target="#removeTaskItemModal" data-remove-id="15"><i class="ri-delete-bin-5-fill align-bottom"></i></button>
                                                                                                                <button class="btn btn-sm btn-soft-grey edit-list" data-bs-toggle="modal" data-bs-target="#createTask" data-edit-id="15"><i class="ri-pencil-fill align-bottom"></i></button>
                                                                                                            </div>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                </div> 
                                                                                            </div>
                                                                                            <div class="col-lg-6">
                                                                                                <div class="skills-edit mb-10">
                                                                                                    <div class="row">
                                                                                                        <div class="col-lg-8 col-md-8 col-sm-8 col-6">
                                                                                                            <label class="mb-0">Blocks</label>
                                                                                                        </div>
                                                                                                        <div class="col-lg-4 col-md-4 col-sm-4 col-6">
                                                                                                            <div class="text-end">
                                                                                                                <button class="btn btn-sm btn-soft-danger remove-list" data-bs-toggle="modal" data-bs-target="#removeTaskItemModal" data-remove-id="15"><i class="ri-delete-bin-5-fill align-bottom"></i></button>
                                                                                                                <button class="btn btn-sm btn-soft-grey edit-list" data-bs-toggle="modal" data-bs-target="#createTask" data-edit-id="15"><i class="ri-pencil-fill align-bottom"></i></button>
                                                                                                            </div>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                </div> 
                                                                                            </div>
                                                                                            <div class="col-lg-6">
                                                                                                <div class="skills-edit mb-10">
                                                                                                    <div class="row">
                                                                                                        <div class="col-lg-8 col-md-8 col-sm-8 col-6">
                                                                                                            <label class="mb-0">Punches</label>
                                                                                                        </div>
                                                                                                        <div class="col-lg-4 col-md-4 col-sm-4 col-6">
                                                                                                            <div class="text-end">
                                                                                                                <button class="btn btn-sm btn-soft-danger remove-list" data-bs-toggle="modal" data-bs-target="#removeTaskItemModal" data-remove-id="15"><i class="ri-delete-bin-5-fill align-bottom"></i></button>
                                                                                                                <button class="btn btn-sm btn-soft-grey edit-list" data-bs-toggle="modal" data-bs-target="#createTask" data-edit-id="15"><i class="ri-pencil-fill align-bottom"></i></button>
                                                                                                            </div>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                </div> 
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>

                                                                                    <div class="mb-25">
                                                                                        <div class="row">
                                                                                            <div class="col-lg-12">
                                                                                                <div class="text-center title-sparetor mb-25">
                                                                                                    <label class="fs-19 font-red">Fitness Training</label>
                                                                                                </div>                                                                                
                                                                                            </div>
                                                                                            <div class="col-lg-6">
                                                                                                <div class="skills-edit mb-10">
                                                                                                    <div class="row">
                                                                                                        <div class="col-lg-8 col-md-8 col-sm-8 col-6">
                                                                                                            <label class="mb-0">Bicep Curl Rep</label>
                                                                                                        </div>
                                                                                                        <div class="col-lg-4 col-md-4 col-sm-4 col-6">
                                                                                                            <div class="text-end">
                                                                                                                <button class="btn btn-sm btn-soft-danger remove-list" data-bs-toggle="modal" data-bs-target="#removeTaskItemModal" data-remove-id="15"><i class="ri-delete-bin-5-fill align-bottom"></i></button>
                                                                                                                <button class="btn btn-sm btn-soft-grey edit-list" data-bs-toggle="modal" data-bs-target="#createTask" data-edit-id="15"><i class="ri-pencil-fill align-bottom"></i></button>
                                                                                                            </div>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                </div> 
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>

                                                                                    <div class="mb-25">
                                                                                        <div class="row">
                                                                                            <div class="col-lg-12">
                                                                                                <div class="text-center title-sparetor mb-25">
                                                                                                    <label class="fs-19 font-red">Yoga & Pilates</label>
                                                                                                </div>                                                                                
                                                                                            </div>
                                                                                            <div class="col-lg-6">
                                                                                                <div class="skills-edit mb-10">
                                                                                                    <div class="row">
                                                                                                        <div class="col-lg-8 col-md-8 col-sm-8 col-6">
                                                                                                            <label class="mb-0">Opening Sequence</label>
                                                                                                        </div>
                                                                                                        <div class="col-lg-4 col-md-4 col-sm-4 col-6">
                                                                                                            <div class="text-end">
                                                                                                                <button class="btn btn-sm btn-soft-danger remove-list" data-bs-toggle="modal" data-bs-target="#removeTaskItemModal" data-remove-id="15"><i class="ri-delete-bin-5-fill align-bottom"></i></button>
                                                                                                                <button class="btn btn-sm btn-soft-grey edit-list" data-bs-toggle="modal" data-bs-target="#createTask" data-edit-id="15"><i class="ri-pencil-fill align-bottom"></i></button>
                                                                                                            </div>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                </div> 
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <a href="#" class="fs-15">+ Add Skills</a>
                                                                        </div>
                                                                        <div class="tab-pane" id="Library" role="tabpanel">
                                                                            <div class="row">
                                                                                <div class="col-xl-12">
                                                                                    <div class="">
                                                                                        <div class="">
                                                                                            <div class="live-preview">
                                                                                                <div class="accordion custom-accordionwithicon accordion-border-box" id="accordionnesting">
                                                                                                    <div class="accordion-item shadow">
                                                                                                        <h2 class="accordion-header" id="accordionnestingExample1">
                                                                                                            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#accor_nestingExamplecollapse1" aria-expanded="true" aria-controls="accor_nestingExamplecollapse1">
                                                                                                                <div class="container-fluid nopadding">
                                                                                                                    <div class="row">
                                                                                                                        <div class="col-6">
                                                                                                                            Belt Curriculum
                                                                                                                        </div>
                                                                                                                        <div class="col-6">
                                                                                                                            <div class="float-end mr-15"><label class="fs-16">1 <span class="fs-13">Skills</span></label></div>
                                                                                                                        </div>
                                                                                                                    </div>
                                                                                                                </div>
                                                                                                            </button>
                                                                                                        </h2>
                                                                                                        <div id="accor_nestingExamplecollapse1" class="accordion-collapse collapse show" aria-labelledby="accordionnestingExample1" data-bs-parent="#accordionnesting">
                                                                                                            <div class="accordion-body">
                                                                                                                <div class="accordion nesting2-accordion custom-accordionwithicon accordion-border-box mt-3" id="accordionnesting2">
                                                                                                                    <div class="accordion-item shadow">
                                                                                                                        <h2 class="accordion-header" id="accordionnesting2Example1">
                                                                                                                            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#accor_nesting2Examplecollapse1" aria-expanded="true" aria-controls="accor_nesting2Examplecollapse1">
                                                                                                                                <div class="container-fluid nopadding">
                                                                                                                                    <div class="row">
                                                                                                                                        <div class="col-6">
                                                                                                                                            White Belt
                                                                                                                                        </div>
                                                                                                                                        <div class="col-6">
                                                                                                                                            <div class="float-end mr-15 pluse-modal" data-bs-toggle="modal" data-bs-target="#plusModal">
                                                                                                                                                <i class="fas fa-plus-square"></i>
                                                                                                                                            </div>
                                                                                                                                        </div>
                                                                                                                                    </div>
                                                                                                                                </div>
                                                                                                                            </button>
                                                                                                                        </h2>
                                                                                                                        <div id="accor_nesting2Examplecollapse1" class="accordion-collapse collapse show" aria-labelledby="accordionnesting2Example1" data-bs-parent="#accordionnesting2">
                                                                                                                            <div class="accordion-body">
                                                                                                                                
                                                                                                                                <div class="accordion nesting4-accordion custom-accordionwithicon accordion-border-box mt-3" id="accordionnesting4">
                                                                                                                                    <div class="accordion-item shadow">
                                                                                                                                        <h2 class="accordion-header" id="accordionnesting4Example2">
                                                                                                                                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#accor_nesting4Examplecollapse2" aria-expanded="false" aria-controls="accor_nesting4Examplecollapse2">
                                                                                                                                                <div class="container-fluid nopadding">
                                                                                                                                                    <div class="row">
                                                                                                                                                        <div class="col-6">
                                                                                                                                                            Kicks
                                                                                                                                                        </div>
                                                                                                                                                        <div class="col-6">
                                                                                                                                                            <div class="float-end mr-15 pluse-modal" data-bs-toggle="modal" data-bs-target="#plusModal">
                                                                                                                                                                <i class="fas fa-plus-square"></i>
                                                                                                                                                            </div>
                                                                                                                                                        </div>
                                                                                                                                                    </div>
                                                                                                                                                </div>
                                                                                                                                            </button>
                                                                                                                                        </h2>
                                                                                                                                        <div id="accor_nesting4Examplecollapse2" class="accordion-collapse collapse" aria-labelledby="accordionnesting4Example2" data-bs-parent="#accordionnesting4">
                                                                                                                                            <div class="accordion-body">

                                                                                                                                                <div class="accordion nesting4-accordion custom-accordionwithicon accordion-border-box mt-3" id="accordionnesting5">
                                                                                                                                                    <div class="accordion-item shadow">
                                                                                                                                                        <h2 class="accordion-header" id="accordionnesting5Example2">
                                                                                                                                                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#accor_nesting5Examplecollapse2" aria-expanded="false" aria-controls="accor_nesting5Examplecollapse2">
                                                                                                                                                                Skills
                                                                                                                                                            </button>
                                                                                                                                                        </h2>
                                                                                                                                                        <div id="accor_nesting5Examplecollapse2" class="accordion-collapse collapse" aria-labelledby="accordionnesting5Example2" data-bs-parent="#accordionnesting5">
                                                                                                                                                            <div class="accordion-body">
                                                                                                                                                                <div class="row">
                                                                                                                                                                    <div class="col-lg-6">
                                                                                                                                                                        <div class="skills-edit mb-25">
                                                                                                                                                                            <div class="row">
                                                                                                                                                                                <div class="col-lg-8 col-md-8 col-sm-8 col-6">
                                                                                                                                                                                    <label class="mb-0">Front Snap Kick</label>
                                                                                                                                                                                </div>
                                                                                                                                                                                <div class="col-lg-4 col-md-4 col-sm-4 col-6">
                                                                                                                                                                                    <div class="text-end">
                                                                                                                                                                                        <button class="btn btn-sm btn-soft-danger remove-list" data-bs-toggle="modal" data-bs-target="#removeTaskItemModal" data-remove-id="15"><i class="ri-delete-bin-5-fill align-bottom"></i></button>
                                                                                                                                                                                        <button class="btn btn-sm btn-soft-grey edit-list" data-bs-toggle="modal" data-bs-target="#createTask" data-edit-id="15"><i class="ri-pencil-fill align-bottom"></i></button>
                                                                                                                                                                                    </div>
                                                                                                                                                                                </div>
                                                                                                                                                                            </div>
                                                                                                                                                                        </div>
                                                                                                                                                                    </div>
                                                                                                                                                                    <div class="col-lg-6">
                                                                                                                                                                        <div class="skills-edit mb-25">
                                                                                                                                                                            <div class="row">
                                                                                                                                                                                <div class="col-lg-8 col-md-8 col-sm-8 col-6">
                                                                                                                                                                                    <label class="mb-0">Upperward Block</label>
                                                                                                                                                                                </div>
                                                                                                                                                                                <div class="col-lg-4 col-md-4 col-sm-4 col-6">
                                                                                                                                                                                    <div class="text-end">
                                                                                                                                                                                        <button class="btn btn-sm btn-soft-danger remove-list" data-bs-toggle="modal" data-bs-target="#removeTaskItemModal" data-remove-id="15"><i class="ri-delete-bin-5-fill align-bottom"></i></button>
                                                                                                                                                                                        <button class="btn btn-sm btn-soft-grey edit-list" data-bs-toggle="modal" data-bs-target="#createTask" data-edit-id="15"><i class="ri-pencil-fill align-bottom"></i></button>
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
                                                                                                                    </div>
                                                                                                                </div>
                                                                                                            </div>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div><!-- end card-body -->
                                                                                    </div><!-- end card -->
                                                                                </div>
                                                                                <!--end col-->
                                                                            </div>
                                                                            <!--end row-->
                                                                        </div> 
                                                                    
                                                                    </div>
                                                                </div><!-- end card-body -->
                                                            </div>
                                                            </div>
                                                            <div class="tab-pane" id="Workouts" role="tabpanel">
                                                                <label>Comming Soon</label>
                                                            </div>
                                                            <div class="tab-pane" id="Video_Library" role="tabpanel">
                                                                <div class="card">
                                                                    <div class="card-header align-items-center text-end">
                                                                        <div>
                                                                            <button type="button" class="btn btn-red" data-bs-toggle="modal" data-bs-target="#addcat">
                                                                                Add Catagory
                                                                            </button>
                                                                            <button type="button" class="btn btn-red" data-bs-toggle="modal" data-bs-target="#addvideo">
                                                                                Add Video
                                                                            </button>
                                                                        </div>
                                                                    </div>
                                                                    <div class="card-body">
                                                                        <div class="mb-25">
                                                                            <div class="row">
                                                                                <div class="col-lg-12">
                                                                                    <div class="text-center title-sparetor mb-25">
                                                                                        <label class="fs-19 font-red">Fitness Training</label>
                                                                                    </div>                                                                                
                                                                                </div>
                                                                                <div class="col-lg-6">
                                                                                    <div class="skills-edit mb-10">
                                                                                        <div class="row">
                                                                                            <div class="col-lg-8 col-md-8 col-sm-8 col-6">
                                                                                                <label class="mb-0">Bicep Curl Rep</label>
                                                                                            </div>
                                                                                            <div class="col-lg-4 col-md-4 col-sm-4 col-6">
                                                                                                <div class="text-end">
                                                                                                    <button class="btn btn-sm btn-soft-danger remove-list" data-bs-toggle="modal" data-bs-target="#removeTaskItemModal" data-remove-id="15"><i class="ri-delete-bin-5-fill align-bottom"></i></button>
                                                                                                    <button class="btn btn-sm btn-soft-grey edit-list" data-bs-toggle="modal" data-bs-target="#createTask" data-edit-id="15"><i class="ri-pencil-fill align-bottom"></i></button>
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

													</div><!-- end card-body -->
												</div><!-- end card -->
											</div>
										</div>
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
<div class="modal fade" id="view_Modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-50 modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="col-xxl-12">
                    <ul class="nav nav-tabs mb-3" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" data-bs-toggle="tab" href="#Level" role="tab" aria-selected="false">
                                Level
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-bs-toggle="tab" href="#Curriculum_modal" role="tab" aria-selected="false">
                                Progress
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-bs-toggle="tab" href="#Attendance" role="tab" aria-selected="false">
                                Attendance
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-bs-toggle="tab" href="#Feedback" role="tab" aria-selected="true">
                                Feedback
                            </a>
                        </li>
                    </ul>
                    <!-- Tab panes -->
                    <div class="tab-content  text-muted">
                        <div class="tab-pane active" id="Level" role="tabpanel">
                            <div class="card">
                                <div class="card-header align-items-center d-flex">
                                    <h4 class="card-title mb-0 flex-grow-1">Kids Martial Arts | Kids Beginners</h4>
                                </div>
                                <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table caption-top table-nowrap mb-0" id="sortable-table">
                                        <thead class="table-light">
                                            <tr>
                                                <th scope="col">Current Level</th>
                                                <th scope="col">Show level</th>
                                                <th scope="col">Hours on level</th>
                                                <th scope="col">Date promoted</th>
                                                <th scope="col">Completed Skills </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr class="sortable-row">
											    <td> Green Belt </td>
											    <td> Orange Belt </td>
											    <td> 5 </td>
											    <td></td>
										        <td>10/50</td>
										    </tr>
                                        </tbody>
                                    </table>
                                </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane" id="Curriculum_modal" role="tabpanel">
                            <div class="card">
                                <div class="card-header align-items-center d-flex">
                                    <h4 class="card-title mb-0 flex-grow-1">Kids Martial Arts | Kids Beginners</h4>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="mb-3 align-items-center d-flex">
                                                <h4 class="card-title mb-0 flex-grow-1">Requirements</h4>
                                            </div><!-- end card header -->

                                            <div class="">
                                                <div class="live-preview">
                                                    <div class="accordion custom-accordionwithicon accordion-border-box" id="accordionnesting">
                                                        <div class="accordion-item shadow">
                                                            <h2 class="accordion-header" id="accordionnestingExample3">
                                                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#accor_nestingExamplecollapse3" aria-expanded="false" aria-controls="accor_nestingExamplecollapse3">
                                                                    Attendance (0)
                                                                </button>
                                                            </h2>
                                                            <div id="accor_nestingExamplecollapse3" class="accordion-collapse collapse" aria-labelledby="accordionnestingExample3" data-bs-parent="#accordionnesting">
                                                                <div class="accordion-body">
                                                                    <div>
                                                                        <div>
                                                                            <label>Client Can View Progress</label>
                                                                            <input type="checkbox" id="vehicle1" name="vehicle1" value="Bike" checked="">
                                                                            <label for="vehicle1"> Yes</label>
                                                                            <input type="checkbox" id="vehicle2" name="vehicle2" value="Bike">
                                                                            <label for="vehicle2"> No</label>                                                                        
                                                                        </div>
                                                                        <div class="dashed-border mb-3">
                                                                            <label>Attendance Attend 100 Classes</label>
                                                                            <div class="row y-middle mb-4">
                                                                                <div class="col-lg-1">
                                                                                    <i class="far fa-check-circle mr-15 fs-16"></i>
                                                                                </div>
                                                                                <div class="col-lg-11">
                                                                                    <div class="progress bg-soft-primary">
                                                                                        <div class="progress-bar bg-primary-purple bg-gradient" role="progressbar" style="width: 15%" aria-valuenow="15" aria-valuemin="0" aria-valuemax="100"></div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>                                                                         
                                                                        </div>  
                                                                        <div class="dashed-border mb-3">
                                                                            <label>Attendance be at this level for 6 months</label>
                                                                            <div class="row y-middle  mb-4">
                                                                                <div class="col-lg-1">
                                                                                    <i class="far fa-check-circle mr-15 fs-16"></i>
                                                                                </div>
                                                                                <div class="col-lg-11">
                                                                                    <div class="progress bg-soft-primary">
                                                                                        <div class="progress-bar bg-primary-purple bg-gradient" role="progressbar" style="width: 25%" aria-valuenow="15" aria-valuemin="0" aria-valuemax="100"></div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>                                                                         
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="accordion-item shadow">
                                                            <h2 class="accordion-header" id="accordionnestingExample1">
                                                                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#accor_nestingExamplecollapse1" aria-expanded="true" aria-controls="accor_nestingExamplecollapse1">
                                                                    Kicks
                                                                </button>
                                                            </h2>
                                                            <div id="accor_nestingExamplecollapse1" class="accordion-collapse collapse show" aria-labelledby="accordionnestingExample1" data-bs-parent="#accordionnesting">
                                                                <div class="accordion-body">
                                                                    <div>
                                                                        <label>Client Can View Progress</label>
                                                                        <input type="checkbox" id="vehicle1" name="vehicle1" value="Bike" checked>
                                                                        <label for="vehicle1"> Yes</label>
                                                                        <input type="checkbox" id="vehicle2" name="vehicle2" value="Bike">
                                                                        <label for="vehicle2"> No</label>                                                                        
                                                                    </div>

                                                                    <div class="accordion nesting2-accordion custom-accordionwithicon accordion-border-box mt-3 mb-3" id="accordionnesting2">
                                                                        <div class="accordion-item shadow">
                                                                            <h2 class="accordion-header" id="accordionnesting2Example1">
                                                                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#accor_nesting2Examplecollapse1" aria-expanded="true" aria-controls="accor_nesting2Examplecollapse1">
                                                                                    Proximity Drill 1
                                                                                </button>
                                                                            </h2>
                                                                            <div id="accor_nesting2Examplecollapse1" class="accordion-collapse collapse" aria-labelledby="accordionnesting2Example1" data-bs-parent="#accordionnesting2">
                                                                                <div class="accordion-body">
                                                                                    <div class="d-grid">
                                                                                        <span>3 min Rounds 1 min rest</span>
                                                                                        <span>3 fro 3 on all drills</span>
                                                                                        <span>10 squat jumps</span>
                                                                                        <span>10 leg lifts in between rounds</span>
                                                                                    </div>
                                                                                    <div class="row">
                                                                                        <div class="col-lg-12">
                                                                                            <button class="demo-video mb-3 mt-3"><i class="fas fa-play-circle"></i> Demo video</button>
                                                                                            <div class="data">
                                                                                                <div class="ratio ratio-21x9">
                                                                                                    <iframe class="rounded" src="https://www.youtube.com/embed/Z-fV2lGKnnU" title="YouTube video" allowfullscreen></iframe>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="col-lg-12">
                                                                                            <div class="mb-3 pb-2 mt-3 p-relative">
                                                                                                <label for="exampleFormControlTextarea" class="form-label">Comment</label>
                                                                                                <div class="video-file file p-relative">
                                                                                                    <label for="file" class="label"><i class="fas fa-video fs-18"></i></label>
                                                                                                    <input type="file" id="file" accept="video/*" />
                                                                                                </div>
                                                                                                <textarea class="form-control" id="emojionearea1" placeholder="Enter your comment" rows="3">
                                                                                                </textarea>                                                                
                                                                                                <span class="float-right" id="business_info_count">
                                                                                                    <span id="display_count_business">145</span> words. 
                                                                                                </span>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="accordion-item shadow">
                                                                            <h2 class="accordion-header" id="accordionnesting2Example2">
                                                                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#accor_nesting2Examplecollapse2" aria-expanded="false" aria-controls="accor_nesting2Examplecollapse2">
                                                                                    Proximity Drill 2
                                                                                </button>
                                                                            </h2>
                                                                            <div id="accor_nesting2Examplecollapse2" class="accordion-collapse collapse" aria-labelledby="accordionnesting2Example2" data-bs-parent="#accordionnesting2">
                                                                                <div class="accordion-body">
                                                                                    <div class="d-grid">
                                                                                        <span>3 min Rounds 1 min rest</span>
                                                                                        <span>3 fro 3 on all drills</span>
                                                                                        <span>10 squat jumps</span>
                                                                                        <span>10 leg lifts in between rounds</span>
                                                                                    </div>
                                                                                    <div class="row">
                                                                                        <div class="col-lg-12">
                                                                                            <button class="demo-video mb-3 mt-3"><i class="fas fa-play-circle"></i> Demo video</button>
                                                                                            <div class="data">
                                                                                                <div class="ratio ratio-21x9">
                                                                                                    <iframe class="rounded" src="https://www.youtube.com/embed/Z-fV2lGKnnU" title="YouTube video" allowfullscreen></iframe>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="col-lg-12">
                                                                                            <div class="mb-3 pb-2 mt-3">
                                                                                                <label for="exampleFormControlTextarea" class="form-label">Comment</label>
                                                                                                <div class="video-file file p-relative">
                                                                                                    <label for="file" class="label"><i class="fas fa-video fs-18"></i></label>
                                                                                                    <input type="file" id="file" accept="video/*" />
                                                                                                </div>
                                                                                                <textarea class="form-control" id="emojionearea2" placeholder="Enter your comment" rows="3">
                                                                                                </textarea>                                                                
                                                                                                <span class="float-right" id="business_info_count">
                                                                                                    <span id="display_count_business">145</span> words. 
                                                                                                </span>
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
                                                        <div class="accordion-item shadow">
                                                            <h2 class="accordion-header" id="accordionnestingExample2">
                                                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#accor_nestingExamplecollapse2" aria-expanded="false" aria-controls="accor_nestingExamplecollapse2">
                                                                    Technique Demonstration
                                                                </button>
                                                            </h2>
                                                            <div id="accor_nestingExamplecollapse2" class="accordion-collapse collapse" aria-labelledby="accordionnestingExample2" data-bs-parent="#accordionnesting">
                                                                <div class="accordion-body">
                                                                    <div class="accordion nesting3-accordion custom-accordionwithicon accordion-border-box mt-3" id="accordionnesting3">
                                                                        <div class="accordion-item shadow mt-2">
                                                                            <h2 class="accordion-header" id="accordionnesting3Example2">
                                                                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#accor_nesting3Examplecollapse2" aria-expanded="false" aria-controls="accor_nesting3Examplecollapse2">
                                                                                    Master Sparring Technique
                                                                                </button>
                                                                            </h2>
                                                                            <div id="accor_nesting3Examplecollapse2" class="accordion-collapse collapse" aria-labelledby="accordionnesting3Example2" data-bs-parent="#accordionnesting3">
                                                                                <div class="accordion-body">
                                                                                    <div class="row">
                                                                                        <div class="col-lg-12">
                                                                                            <div class="dashed-border fs-15 mb-3">
                                                                                                <input class="styled-checkbox" id="styled-checkbox-1" type="checkbox" value="value1">
                                                                                                <label for="styled-checkbox-1">Mastered Sparring Techniques #1-21</label>
                                                                                            </div>
                                                                                            <div class="dashed-border fs-15 mb-3">
                                                                                                <input class="styled-checkbox" id="styled-checkbox-2" type="checkbox" value="value2">
                                                                                                <label for="styled-checkbox-2">Assist with Instructing 15 Beginner Classes</label>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="col-lg-12">
                                                                                            <button class="demo-video mb-3"><i class="fas fa-play-circle"></i> Demo video</button>
                                                                                            <div class="data">
                                                                                                <div class="ratio ratio-21x9">
                                                                                                    <iframe class="rounded" src="https://www.youtube.com/embed/Z-fV2lGKnnU" title="YouTube video" allowfullscreen></iframe>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="col-lg-12">
                                                                                            <div class="mb-3">
                                                                                                <label for="formFileMultiple" class="form-label">Upload Video</label>
                                                                                                <input class="form-control" type="file" id="formFileMultiple" multiple="">
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="col-lg-12">
                                                                                            <div class="mb-3 pb-2">
                                                                                                <label for="exampleFormControlTextarea" class="form-label">Feedback</label>
                                                                                                <textarea class="form-control" id="exampleFormControlTextarea" placeholder="Enter your feedback" rows="3"></textarea>
                                                                                                <span class="float-right" id="business_info_count">
                                                                                                    <span id="display_count_business">145</span> words. 
                                                                                                </span>
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
                                                <div class="live-preview">
                                                    <div class="accordion" id="default-accordion-example">                                                     
                                                       <!-- <div class="accordion-item shadow">
                                                            <h2 class="accordion-header" id="headingTwo">
                                                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                                                    Kicks
                                                                </button>
                                                            </h2>
                                                            <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#default-accordion-example">
                                                                <div class="accordion-body">
                                                                    <div>
                                                                        <label>Client Can View Progress</label>
                                                                        <div class="">
                                                                            <input type="checkbox" id="vehicle1" name="vehicle1" value="Bike" checked>
                                                                            <label for="vehicle1"> Yes</label><br>
                                                                            <input type="checkbox" id="vehicle2" name="vehicle2" value="Bike">
                                                                            <label for="vehicle2"> No</label><br>
                                                                        </div>
                                                                        <div class="row">
                                                                            <div class="col-lg-12">
                                                                                <div class="mb-3 d-grid">
                                                                                    <label class="fs-16">Proximity Drill 1</label>
                                                                                    <span>3 min Rounds 1 min rest</span>
                                                                                    <span>3 fro 3 on all drills</span>
                                                                                    <span>10 squat jumps</span>
                                                                                    <span>10 leg lifts in between rounds</span>
                                                                                </div>                                                                                
                                                                            </div>
                                                                            <div class="col-lg-12">
                                                                                <button class="demo-video mb-3"><i class="fas fa-play-circle"></i> Demo video</button>
                                                                                <div class="data">
                                                                                    <div class="ratio ratio-21x9">
                                                                                        <iframe class="rounded" src="https://www.youtube.com/embed/Z-fV2lGKnnU" title="YouTube video" allowfullscreen></iframe>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-lg-12">
                                                                                <div class="mb-3">
                                                                                    <textarea class="form-control" id="meta-description-input" placeholder="Enter Results" rows="3"></textarea>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-lg-12">
                                                                                <div class="mb-3">
                                                                                    <label for="formFileMultiple" class="form-label">Upload Video</label>
                                                                                    <input class="form-control" type="file" id="formFileMultiple" multiple="">
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-lg-12">
                                                                                <div class="mb-3 pb-2">
                                                                                    <label for="exampleFormControlTextarea" class="form-label">Feedback</label>
                                                                                    <textarea class="form-control" id="exampleFormControlTextarea" placeholder="Enter your feedback" rows="3"></textarea>
                                                                                    <span class="float-right" id="business_info_count">
                                                                                        <span id="display_count_business">145</span> words. 
                                                                                    </span>
                                                                                </div>
                                                                            </div>
                                                                        </div>                                                                    
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div> -->
                                                       <!-- <div class="accordion-item shadow">
                                                            <h2 class="accordion-header" id="headingThree">
                                                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                                                    Blocks
                                                                </button>
                                                            </h2>
                                                            <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#default-accordion-example">
                                                                <div class="accordion-body">
                                                                    <div>
                                                                        <label>Client Can View Progress</label>
                                                                        <div class="">
                                                                            <input type="checkbox" id="vehicle1" name="vehicle1" value="Bike" checked>
                                                                            <label for="vehicle1"> Yes</label><br>
                                                                            <input type="checkbox" id="vehicle2" name="vehicle2" value="Bike">
                                                                            <label for="vehicle2"> No</label><br>
                                                                        </div>
                                                                        <form>
                                                                            <div class="row">
                                                                                <div class="col-lg-12">
                                                                                    <div class="mb-3">
                                                                                        <label for="formFileMultiple" class="form-label">Upload Video</label>
                                                                                        <input class="form-control" type="file" id="formFileMultiple" multiple="">
                                                                                    </div>                                                                                         
                                                                                    <div class="mb-3 pb-2">
                                                                                        <label for="exampleFormControlTextarea" class="form-label">Feedback</label>
                                                                                        <textarea class="form-control" id="exampleFormControlTextarea" placeholder="Enter your feedback" rows="3"></textarea>
                                                                                        <span class="float-right" id="business_info_count">
                                                                                            <span id="display_count_business">145</span> words. 
                                                                                        </span>
                                                                                    </div>                                                                                    
                                                                                </div>
                                                                            </div> 
                                                                        </form>                                                                         
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div> -->
                                                    </div>
                                                </div>
                                            </div><!-- end card-body -->
                                        </div>
                                    </div>
                                </div>
                            </div>
                           <!-- <div class="card">
                                <div class="card-header align-items-center d-flex">
                                    <h4 class="card-title mb-0 flex-grow-1">Program Name & Category Name</h4>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="dashed-border fs-15 mb-3">
                                                <label><i class="far fa-check-circle mr-15"></i>Mastered Sparring Techniques #1-21</label>
                                            </div>
                                            <div class="dashed-border fs-15 mb-3">
                                                <label><i class="far fa-check-circle mr-15"></i>Assist with Instructing 15 Beginner Classes</label>
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="mb-3 align-items-center d-flex">
                                                <h4 class="card-title mb-0 flex-grow-1">Category</h4>
                                            </div>

                                            <div class="">
                                                <div class="live-preview">
                                                    <div class="accordion" id="default-accordion-example">
                                                        <div class="accordion-item shadow">
                                                            <h2 class="accordion-header" id="headingOne">
                                                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                                                     Attendance 
                                                                </button>
                                                            </h2>
                                                            <div id="collapseOne" class="accordion-collapse collapse" aria-labelledby="headingOne" data-bs-parent="#default-accordion-example">
                                                                <div class="accordion-body">
                                                                    <div>
                                                                        <label>Client Can View Progress</label>
                                                                        <div class="">
                                                                            <input type="checkbox" id="vehicle1" name="vehicle1" value="Bike" checked>
                                                                            <label for="vehicle1"> Yes</label><br>
                                                                            <input type="checkbox" id="vehicle2" name="vehicle2" value="Bike">
                                                                            <label for="vehicle2"> No</label><br>
                                                                        </div>
                                                                        <div class="dashed-border mb-3">
                                                                            <label>Attendance Attend 100 Classes</label>
                                                                            <div class="progress bg-soft-primary mb-4">
                                                                                <div class="progress-bar bg-primary-purple bg-gradient" role="progressbar" style="width: 15%" aria-valuenow="15" aria-valuemin="0" aria-valuemax="100"></div>
                                                                            </div>
                                                                        </div>     
                                                                        <div class="dashed-border mb-3">
                                                                            <label>Attendance be at this level for 6 months</label>
                                                                            <div class="progress bg-soft-primary mb-4">
                                                                                <div class="progress-bar bg-primary-purple bg-gradient" role="progressbar" style="width: 25%" aria-valuenow="15" aria-valuemin="0" aria-valuemax="100"></div>
                                                                            </div>
                                                                        </div> 
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="accordion-item shadow">
                                                            <h2 class="accordion-header" id="headingTwo">
                                                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                                                    Kicks
                                                                </button>
                                                            </h2>
                                                            <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#default-accordion-example">
                                                                <div class="accordion-body">
                                                                    <div>
                                                                        <label>Client Can View Progress</label>
                                                                        <div class="">
                                                                            <input type="checkbox" id="vehicle1" name="vehicle1" value="Bike" checked>
                                                                            <label for="vehicle1"> Yes</label><br>
                                                                            <input type="checkbox" id="vehicle2" name="vehicle2" value="Bike">
                                                                            <label for="vehicle2"> No</label><br>
                                                                        </div>
                                                                        <div class="row">
                                                                            <div class="col-lg-12">
                                                                                <button class="demo-video mb-3"><i class="fas fa-play-circle"></i> Demo video</button>
                                                                                <div class="data">
                                                                                    <div class="ratio ratio-21x9">
                                                                                        <iframe class="rounded" src="https://www.youtube.com/embed/Z-fV2lGKnnU" title="YouTube video" allowfullscreen></iframe>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-lg-12">
                                                                                <div class="video-tab-iframe dashed-border mb-25">
                                                                                    <iframe src="http://dev.fitnessity.co//public/uploads/gallery/720/video/file_example_MP4_640_3MG.mp4" width="100%" frameborder="0" allowfullscreen=""></iframe>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-lg-12">
                                                                                <form>
                                                                                    <div class="mb-3 pb-2 mt-3">
                                                                                        <label for="exampleFormControlTextarea" class="form-label">Feedback</label>
                                                                                        <textarea class="form-control" id="exampleFormControlTextarea" placeholder="Enter your feedback" rows="3"></textarea>
                                                                                        <span class="float-right" id="business_info_count">
                                                                                            <span id="display_count_business">145</span> words. 
                                                                                        </span>
                                                                                    </div>
                                                                                </form>
                                                                            </div>
                                                                        </div>                                                                        
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="accordion-item shadow">
                                                            <h2 class="accordion-header" id="headingThree">
                                                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                                                    Blocks
                                                                </button>
                                                            </h2>
                                                            <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#default-accordion-example">
                                                                <div class="accordion-body">
                                                                    <div>
                                                                        <label>Client Can View Progress</label>
                                                                        <div class="">
                                                                            <input type="checkbox" id="vehicle1" name="vehicle1" value="Bike" checked>
                                                                            <label for="vehicle1"> Yes</label><br>
                                                                            <input type="checkbox" id="vehicle2" name="vehicle2" value="Bike">
                                                                            <label for="vehicle2"> No</label><br>
                                                                        </div>
                                                                        <div class="row">
                                                                            <div class="col-lg-12">
                                                                            <div class="video-tab-iframe dashed-border mb-25">
                                                                                <iframe src="http://dev.fitnessity.co//public/uploads/gallery/720/video/videoplayback.mp4" width="100%" frameborder="0" allowfullscreen=""></iframe>
                                                                            </div>
                                                                            </div>
                                                                            <div class="col-lg-12">
                                                                                <form>
                                                                                    <div class="mb-3 pb-2">
                                                                                        <label for="exampleFormControlTextarea" class="form-label">Feedback</label>
                                                                                        <textarea class="form-control" id="exampleFormControlTextarea" placeholder="Enter your feedback" rows="3"></textarea>
                                                                                        <span class="float-right" id="business_info_count">
                                                                                            <span id="display_count_business">145</span> words.
                                                                                        </span>
                                                                                    </div>
                                                                                </form>
                                                                            </div>
                                                                        </div>                                                                        
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="d-none code-view">
                                        
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div> -->
                        </div>
                        <div class="tab-pane" id="Attendance" role="tabpanel">
                            <div class="card">
                                <div class="card-header card-dark">
                                    <div class="row y-middle">	
                                        <div class="col-lg-8">
                                            <div class="attendance-title">
                                                <h3>Attendance History</h3>
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="input-group">
                                                <input type="text" class="form-control border-0 dash-filter-picker shadow" data-provider="flatpickr" data-range-date="true" data-date-format="d M, Y" data-deafult-date="01 Jan 2022 to 31 Jan 2022">
                                                <div class="input-group-text bg-primary border-primary text-white">
                                                    <i class="ri-calendar-2-line"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-auto">
                                            <div class="d-grid attendance-count mt-25">
                                                <label>Check-Ins</label>
                                                <span>0</span>
                                            </div>
                                        </div>
                                        <div class="col-sm-auto">
                                            <div class="d-grid attendance-count mt-25">
                                                <label>Years</label>
                                                <span>0</span>
                                            </div>
                                        </div>
                                        <div class="col-sm-auto">
                                            <div class="d-grid attendance-count mt-25">
                                                <label>Months</label>
                                                <span>0</span>
                                            </div>
                                        </div>
                                        <div class="col-sm-auto">
                                            <div class="d-grid attendance-count mt-25">
                                                <label>Days</label>
                                                <span>0</span>
                                            </div>
                                        </div>
                                        <div class="col-sm-auto">
                                            <div class="d-grid attendance-count mt-25">
                                                <label>Hours</label>
                                                <span>0</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-header border-0 align-items-center">
                                    <div class="row">
                                        <div class="col-lg-5 col-sm-4">
                                            <h4 class="card-title mb-0 flex-grow-1">Attendance</h4>
                                        </div>
                                        <div class="col-lg-3 col-sm-4">
                                            <div class="text-right mmb-10">
                                                <button type="button" class="btn btn-soft-secondary btn-sm shadow-none">
                                                    Day
                                                </button>
                                                <button type="button" class="btn btn-soft-secondary btn-sm shadow-none">
                                                    Week
                                                </button>
                                                <button type="button" class="btn btn-soft-secondary btn-sm shadow-none">
                                                    Month
                                                </button>
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-sm-4">
                                            <div class="input-group">
                                                <input type="text" class="form-control border-0 shadow" data-provider="flatpickr" data-range-date="true" data-date-format="d M, Y" data-deafult-date="01 Jan 2022 to 31 Jan 2022">
                                                <div class="input-group-text bg-primary border-primary text-white">
                                                    <i class="ri-calendar-2-line"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    
                                    
                                </div><!-- end card header -->

                                <div class="card-body p-0 pb-2">
                                    <div class="w-100">
                                        <div id="customer_impression_charts" data-colors='["--vz-success", "--vz-primary", "--vz-danger"]' class="apex-charts" dir="ltr"></div>
                                    </div>
                                </div><!-- end card body -->
                            </div><!-- end card -->
                        </div>
                        <div class="tab-pane" id="Feedback" role="tabpanel">
                            <div class="card">
                                <div class="card-body">
                                    <div class="mb-3">
                                        <label class="form-label" for="product-title-input">Feedback</label>
                                        <input type="text" class="form-control" id="product-title-input" value="" required>
                                    </div>
                                    <div>
                                        <label>Description</label>
                                        <div id="ckeditor-classic">
                                        
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-red">Save</button>
            </div>
        </div>
     </div>
</div>

<!-- Modal -->
<div class="modal fade" id="addvideo" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="addvideoLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addvideoLabel">Add Video</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="javascript:void(0);">
                    <div class="steps-title mmb-10">
					    <div class="mb-3">
					        <label for="JoiningdatInput" class="form-label">Categorie</label>
						    <select name="activity_type" data-behavior="on_change_submit" class="form-select" id="choices-publish-status-input" data-choices="" data-choices-search-false="">
						        <option value=""> Martial Arts </option>
						        <option value="">Fitness Training</option>
                                <option value="">Yoga & Pilates</option>
                                <option value="">Warm up </option>
                                <option value="">Exercises </option>
						    </select>
					    </div>
				    </div>
                    <div>
                        <label class="form-label">Add Video</label>
                        <input class="form-control" type="file" id="formFile" accept="video/*">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-red">Save Category</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="addcat" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="addcatLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addcatLabel">Add Category</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="javascript:void(0);">
                    <div class="steps-title mmb-10">
					    <div class="mb-3">
					        <label for="JoiningdatInput" class="form-label">Type</label>
						    <select name="activity_type" data-behavior="on_change_submit" class="form-select" id="choices-publish-status-input" data-choices="" data-choices-search-false="">
						        <option value=""> Martial Arts </option>
						        <option value="">Fitness Training</option>
                                <option value="">Yoga & Pilates</option>
						    </select>
					    </div>
				    </div>
                    <div class="mb-3">
			            <label for="firstnameInput" class="form-label">Title <span class="font-red">*</span></label>
				        <input type="text" class="form-control">
				    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-red">Save Category</button>
            </div>
        </div>
    </div>
</div>


<!-- Modal -->
<div class="modal fade" id="plusModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable width-40">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add Skill</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="javascript:void(0);">
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                            <div class="mb-3">
                                <label for="firstnameInput" class="form-label">Title</label>
                                <input type="text" class="form-control" value="Dave">
                            </div>
                            <div class="mb-3">
                                <label for="JoiningdatInput" class="form-label">Program</label>
                                <select name="activity_type" data-behavior="on_change_submit" class="form-select" id="choices-publish-status-input" data-choices="" data-choices-search-false="">
                                    <option value="">Taekwondo</option>
                                </select>
                            </div>
                            <div class="mb-3 custom-check-dropdwon">
                                <div id="list1" class="dropdown-check-list" tabindex="100">
                                    <span class="anchor">Select Fruits</span>
                                    <ul class="items">
                                        <li><input type="checkbox" />White </li>
                                        <li><input type="checkbox" />Yellow</li>
                                        <li><input type="checkbox" />White / Yellow Tip</li>
                                        <li><input type="checkbox" />Green</li>
                                    </ul>
                                </div>
                            </div>
                            <div class="mb-3">
                                <input type="checkbox">
                                <label class="form-label">Visible on gym schedule </label>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                            <div class="mb-3">
                                <label for="JoiningdatInput" class="form-label">Measure</label>
                                <select name="activity_type" data-behavior="on_change_submit" class="form-select" id="choices-publish-status-input" data-choices="" data-choices-search-false="">
                                    <option value=""> Repetitions</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="JoiningdatInput" class="form-label">Category</label>
                                <select name="activity_type" data-behavior="on_change_submit" class="form-select" id="choices-publish-status-input" data-choices="" data-choices-search-false="">
                                    <option value="">Blocks</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <input type="checkbox">
                                <label class="form-label">Set as promotion requirement</label>
                            </div>
                        </div>
                        <div class="col-12 mb-3">
                            <label for="JoiningdatInput" class="form-label">Description</label>
                            <div id="ckeditor-classic-one">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label for="firstnameInput" class="form-label">Link to video</label>
                                <input type="text" class="form-control" id="product-title-input" value="" placeholder="Enter video link" required="">
                            </div>  
                        </div>
                        <div class="col-lg-2">
                            <div class="or-set">
                                <label>-OR-</label>
                            </div>                            
                        </div>
                        <div class="col-lg-4">
                            <div class="mb-3">
                                <label for="firstnameInput" class="form-label mb-25"></label>
                                <input class="form-control" type="file" id="formFile" accept="video/*">
                            </div>  
                        </div>
                        <div class="col-lg-12">
                            <div class="mb-3">
                                <label for="firstnameInput" class="form-label">Instructions</label>
                                <textarea class="form-control" id="meta-description-input" placeholder="Add instructions (optional)" rows="3"></textarea>
                            </div>  
                       </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-red">Save Skill</button>
            </div>
        </div>
    </div>
</div>

@include('layouts.business.footer')
<script>
	new DataTable('#announcement_list', {
		responsive: true        
	});
</script>
<script>
$(document).ready(function() {
	$("#emojionearea1").emojioneArea({
  	
    pickerPosition: "bottom",
    tonesStyle: "bullet",
		events: {
         	keyup: function (editor, event) {d
           		console.log(editor.html());
           		console.log(this.getText());
        	}
    	}
	});
  
    $('#divOutside').click(function () {
        $('.emojionearea-button').click()
    })
});
$(document).ready(function() {
	$("#emojionearea2").emojioneArea({
  	
    pickerPosition: "bottom",
    tonesStyle: "bullet",
		events: {
         	keyup: function (editor, event) {d
           		console.log(editor.html());
           		console.log(this.getText());
        	}
    	}
	});
  
    $('#divOutside').click(function () {
        $('.emojionearea-button').click()
    })
});
</script>
<script>
var checkList = document.getElementById('list1');
checkList.getElementsByClassName('anchor')[0].onclick = function(evt) {
  if (checkList.classList.contains('visible'))
    checkList.classList.remove('visible');
  else
    checkList.classList.add('visible');
}
</script>
<script>
    ClassicEditor.create(document.querySelector("#ckeditor-classic-one")).catch((error) => {
        console.error(error);
    });
</script>
<script>
    $('.data').hide()
    jQuery('button').on('click',function(){
        jQuery('.data').toggle();
    })
</script>
@endsection