@inject('request', 'Illuminate\Http\Request')
@extends('layouts.business.header')

@section('content')
@include('layouts.profile.business_topbar')

	<div class="main-content">
		<div class="page-content">
			<div class="container-fluid">
				<div class="row mb-3">
					<div class="col-6">
						<div class="page-heading">
							<label>Manage Student Promotions</label>
                            <p>Manage belt ranks, promotions, curriculums, certifications for your students</p>
						</div>
					</div>
                    <div class="col-6">
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
										<a class="nav-link" data-bs-toggle="tab" href="#Clients" role="tab" aria-selected="false">
                                            Clients
										</a>
									</li>
									<li class="nav-item">
										<a class="nav-link active" data-bs-toggle="tab" href="#Notes" role="tab" aria-selected="false">
                                            Programs
										</a>
									</li>
									<li class="nav-item">
										<a class="nav-link" data-bs-toggle="tab" href="#Curriculum" role="tab" aria-selected="false">
                                            Curriculum
										</a>
									</li>
								</ul>
								<!-- Tab panes -->
								<div class="tab-content  text-muted">
									<div class="tab-pane active" id="Notes" role="tabpanel">
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
												<div class="card">
													<div class="card-body">
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
                                                        <div class="tab-content text-muted">
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
                                                            </div>
                                                            <div class="tab-pane" id="Library" role="tabpanel">
                                                                <div class="row">
                                                                    <div class="col-xl-12">
                                                                        <div class="card">
                                                                            <div class="card-body">
                                                                                <div class="live-preview">
                                                                                    <div class="accordion custom-accordionwithicon accordion-border-box" id="accordionnesting">
                                                                                        <div class="accordion-item shadow">
                                                                                            <h2 class="accordion-header" id="accordionnestingExample1">
                                                                                                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#accor_nestingExamplecollapse1" aria-expanded="true" aria-controls="accor_nestingExamplecollapse1">
                                                                                                    <div class="container-fluid nopadding">
                                                                                                        <div class="row">
                                                                                                            <div class="col-6">
                                                                                                                Show Skills
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
                                                                                                                                White
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
                                                                                                                    <div class="accordion nesting4-accordion custom-accordionwithicon accordion-border-box mt-3" id="accordionnesting4">
                                                                                                                        <div class="accordion-item shadow">
                                                                                                                            <h2 class="accordion-header" id="accordionnesting4Example2">
                                                                                                                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#accor_nesting4Examplecollapse2" aria-expanded="false" aria-controls="accor_nesting4Examplecollapse2">
                                                                                                                                    <div class="container-fluid nopadding">
                                                                                                                                        <div class="row">
                                                                                                                                            <div class="col-6">
                                                                                                                                                 Blocks
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
                        <div class="col-12">
                            <div id="ckeditor-classic">
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
var checkList = document.getElementById('list1');
checkList.getElementsByClassName('anchor')[0].onclick = function(evt) {
  if (checkList.classList.contains('visible'))
    checkList.classList.remove('visible');
  else
    checkList.classList.add('visible');
}
</script>
@endsection