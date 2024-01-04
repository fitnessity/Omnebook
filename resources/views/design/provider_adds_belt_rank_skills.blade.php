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
										<a class="nav-link" data-bs-toggle="tab" href="#Alerts" role="tab" aria-selected="false">
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
                                                                                        <div class="col-lg-1">
                                                                                            <div class="cgreen">
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="col-lg-3">
                                                                                            <label>Green</label>
                                                                                        </div>
                                                                                        <div class="col-lg-8">
                                                                                            <div class="float-end"><label class="fs-16 mb-0">1 <span class="fs-13">Members</span></label></div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>     
                                                                                
                                                                                <div class="greybox mb-10">
                                                                                    <div class="row">
                                                                                        <div class="col-lg-1">
                                                                                            <div class="cyellow">
                                                                                                <div class="inner-belt">                                                                                                    
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="col-lg-3">
                                                                                            <label>Yellow /Red Top</label>
                                                                                        </div>
                                                                                        <div class="col-lg-8">
                                                                                            <div class="float-end"><label class="fs-16 mb-0">0 <span class="fs-13">Members</span></label></div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>

                                                                                <div class="greybox mb-10">
                                                                                    <div class="row">
                                                                                        <div class="col-lg-1">
                                                                                            <div class="cblack">
                                                                                                <div class="vertical-inner-belt">                                                                                                    
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="col-lg-3">
                                                                                            <label>Black 1st Dan</label>
                                                                                        </div>
                                                                                        <div class="col-lg-8">
                                                                                            <div class="float-end"><label class="fs-16 mb-0">0 <span class="fs-13">Members</span></label></div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>

                                                                                <div class="greybox mb-10">
                                                                                    <div class="row">
                                                                                        <div class="col-lg-1">
                                                                                            <div class="cblack">
                                                                                                <div class="vertical-inner-belt mr-5">                                                                                                    
                                                                                                </div>
                                                                                                <div class="vertical-inner-belt">                                                                                                    
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="col-lg-3">
                                                                                            <label>Black 2nd Dan</label>
                                                                                        </div>
                                                                                        <div class="col-lg-8">
                                                                                            <div class="float-end"><label class="fs-16 mb-0">0 <span class="fs-13">Members</span></label></div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>

                                                                                <div class="greybox mb-10">
                                                                                    <div class="row">
                                                                                        <div class="col-lg-1">
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
                                                                                        <div class="col-lg-3">
                                                                                            <label>Black 5th Dan</label>
                                                                                        </div>
                                                                                        <div class="col-lg-8">
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
									<div class="tab-pane" id="Alerts" role="tabpanel">
										<div class="row">
											<div class="col-xxl-12 col-lg-12">
												<div class="card">
													<div class="card-body">
														<label>Cooming Soon</label>
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
@include('layouts.business.footer')
@endsection