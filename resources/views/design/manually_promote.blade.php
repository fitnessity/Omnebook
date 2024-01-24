@inject('request', 'Illuminate\Http\Request')
@extends('layouts.business.header')

@section('content')
@include('layouts.profile.business_topbar')


<div class="main-content">
		<div class="page-content">
			<div class="container-fluid">
				<div class="row mb-3">
					<div class="col-12">
						<div class="page-heading">
							<label>Promote</label>
						</div>
					</div>
				</div><!--end row-->
				<div class="row">
					<div class="col-xl-12">
						<div class="card">
							<div class="card-body">
                                <div class="alert alert-primary shadow" role="alert">                                   
                                    Jane Jones has been selected for promotion. Select a level to confirm
                                </div>       
                                <table id="announcement_list" class="table table-bordered dt-responsive nowrap table-striped align-middle" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th data-ordering="false">Client Name</th>
                                            <th data-ordering="false">Current Level</th>
                                            <th data-ordering="false">Skills Completed </th>
                                            <th data-ordering="false">Promote</th>
                                            <th data-ordering="false">Progress </th>
                                        </tr>
                                    </thead>
                                    <tbody>										
                                        <tr>
                                            <td>Nipa Soni</td>
                                            <td><div class="d-flex"><div class="cgreen w-50px mr-5"></div> <span class="lh-24">Green Belt</span></div></td>
                                            <td>00/00</td>
                                            <td><button type="button" class="btn btn-red" data-bs-toggle="modal" data-bs-target="#updatebelt">Update</button></td>
                                            <td>
                                                <ul class="list-inline hstack gap-2 mb-0">
                                                    <li class="list-inline-item" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="top" aria-label="View" data-bs-original-title="View">
                                                        <a href="#" class="text-red d-inline-block" data-bs-toggle="modal" data-bs-target="#viewModal">
                                                            <i class="ri-eye-fill fs-16"></i>
                                                        </a>
                                                    </li>
                                                </ul>
                                            </td>                                            
                                        </tr>                                  
                                    </tbody>
                                </table>           
							</div><!-- end card Body -->
						</div>
					</div>
				</div>
										
			</div><!-- container-fluid -->
		</div>
	</div><!-- end main content-->
	
</div><!-- END layout-wrapper -->


<!-- Modal -->
<div class="modal fade" id="updatebelt" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel"></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="level-listing">
                    <div class="row">
                        <div class="col-lg-3">
                            <div>
                                <label>Current Level</label>
                            </div>
                        </div>
                        <div class="col-lg-9">
                            <div class="d-flex"><div class="cgreen w-50px mr-5"></div> <span class="lh-24">Green Belt</span></div>
                        </div>
                    </div>
                </div>
                <div class="p-a15 dashed-border">
                    <div class="row">
                        <div class="col-lg-1">
                            <input type="checkbox" id="vehicle1" name="vehicle1" value="Bike">
                        </div>
                        <div class="col-lg-11">
                            <div class="d-flex">
                                <div class="cyellow w-50px mr-5">
                                    <div class="inner-belt">                                                                                                    
                                    </div>
                                </div>
                                <span class="lh-24">Yellow Belt-1 Stripe</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="p-a15 dashed-border">
                    <div class="row">
                        <div class="col-lg-1">
                            <input type="checkbox" id="vehicle1" name="vehicle1" value="Bike">
                        </div>
                        <div class="col-lg-11">
                            <div class="d-flex">
                                <div class="cred w-50px mr-5">
                                </div>
                                <span class="lh-24">Red Belt</span>
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
<div class="modal fade" id="viewModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                                Promotion Details
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-bs-toggle="tab" href="#Curriculum_modal" role="tab" aria-selected="false">
                                Requirements <i class="fas fa-info-circle" data-bs-toggle="tooltip" data-bs-placement="right" title="See what's required to be promoted"></i>
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
                                                <th scope="col">Hours on level</th>
                                                <th scope="col">Date promoted</th>
                                                <th scope="col">Completed Skills </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr class="sortable-row">
											    <td> Green Belt </td>
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


@include('layouts.business.footer')
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
	new DataTable('#announcement_list', {
		responsive: true
	});
</script>
<script>
    $('.data').hide()
    jQuery('button').on('click',function(){
        jQuery('.data').toggle();
    })
</script>
@endsection