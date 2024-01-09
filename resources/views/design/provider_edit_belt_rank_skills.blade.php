@inject('request', 'Illuminate\Http\Request')
@extends('layouts.business.header')

@section('content')
@include('layouts.profile.business_topbar')
	<div class="main-content">
		<div class="page-content">
			<div class="container-fluid">
				<div class="row">
					<div class="col-xxl-12">
						<div class="card">
                            <div class="card-header align-items-center d-flex">
                                <h4 class="card-title mb-0 flex-grow-1">Program Details</h4>
                                <div class="flex-shrink-0">
                                    <button type="button" class="btn btn-red" data-bs-toggle="modal" data-bs-target="#temp">Use Template</button>
                                </div>
                            </div>
							<div class="card-body">
                                <form action="javascript:void(0);">
									<div class="row">
										<div class="col-lg-3 col-md-6">
											<div class="mb-3">
												<label for="firstnameInput" class="form-label">Program Name</label>
												<input type="text" class="form-control" id="firstnameInput" placeholder="Enter your firstname" value="Taekwondo">
											</div>
										</div><!--end col-->
                                    	<div class="col-lg-3 col-md-6">
											<div class="steps-title mmb-10">
												<div class="mb-3">
													<label for="JoiningdatInput" class="form-label">Type</label>
													<select name="activity_type" data-behavior="on_change_submit" class="form-select" id="choices-publish-status-input" data-choices="" data-choices-search-false="">
														<option value=""> Martial Arts </option>
														<option value="">Yoga</option>
													</select>
												</div>
											</div>
                                     	</div>
                                    	<div class="col-lg-3 col-md-6">
											<div class="steps-title mmb-10">
												<div class="mb-3">
													<label for="JoiningdatInput" class="form-label">Level / Rank Style</label>
													<select name="activity_type" data-behavior="on_change_submit" class="form-select" id="choices-publish-status-input" data-choices="" data-choices-search-false="">
														<option value=""> Solid Color </option>
														<option value="">Normal Color</option>
													</select>
												</div>
											</div>
                                    	</div> <!--end col-->
                                    	<div class="col-lg-3 col-md-6">
											<div class="steps-title mmb-10">
												<div class="mb-3">
													<label for="JoiningdatInput" class="form-label">Secondary Color</label>
													<select name="activity_type" data-behavior="on_change_submit" class="form-select" id="choices-publish-status-input" data-choices="" data-choices-search-false="">
														<option value=""> Middle of the rank </option>
														<option value="">First rank</option>
													</select>
												</div>
											</div>
                                		</div><!--end col-->

										<div class="col-lg-4 col-md-6">
											<div class="steps-title mmb-10">
												<div class="mb-3">
													<label for="JoiningdatInput" class="form-label">Promotion Requirements</label>
													<div class="row">
														<div class="col-lg-6 col-md-12 col-12">
															<div>
																<input type="checkbox" id="vehicle1" name="vehicle1" value="Bike">
																<label for="vehicle1">Sessions</label><br>
																<input type="checkbox" id="vehicle2" name="vehicle2" value="Car">
																<label for="vehicle2">Hours</label><br>
																<input type="checkbox" id="vehicle3" name="vehicle3" value="Boat">
																<label for="vehicle3">Days in Rank</label><br> 
															</div>
														</div>
														<div class="col-lg-6 col-md-12 col-12">
															<div>
																<input type="checkbox" id="vehicle1" name="vehicle1" value="Bike">
																<label for="vehicle1">Days Attended</label><br>
																<input type="checkbox" id="vehicle2" name="vehicle2" value="Car">
																<label for="vehicle2">Skill Requirements</label><br>
																<input type="checkbox" id="vehicle3" name="vehicle3" value="Boat">
																<label for="vehicle3">Minimum Age</label><br> 
															</div>
														</div>
													</div>
													
												</div>
											</div>
                                		</div>

										<div class="col-lg-3 col-md-6">
											<div class="steps-title mmb-10">
											<div class="mb-3">
													<div class="form-check form-switch form-switch-dark form-check-right">
                                                        <input class="form-check-input" type="checkbox" role="switch" id="SwitchCheck7" checked="">    
														<label  class="form-check-label" for="SwitchCheck7">Auto Assign Initial Rank</label>                                                    
                                                    </div>												
												</div>
												<div class="mb-3">
													<label for="JoiningdatInput" class="form-label">Promotion Setting</label>
													<select name="activity_type" data-behavior="on_change_submit" class="form-select" id="choices-publish-status-input" data-choices="" data-choices-search-false="">
														<option value="">Manual Promotions </option>
														<option value="">Automatically Promotions</option>
													</select>
												</div>
											</div>
                                		</div><!--end col-->

                                    	<div class="col-lg-12">
                                        	<div class="hstack gap-2 justify-content-end">
                                         		<button type="submit" class="btn btn-red">Save Program</button>
                                        	</div>
                                    	</div> <!--end col-->
                               		</div>
                               	 <!--end row-->
                            	</form>
							</div><!-- end card-body -->
						</div><!-- end card -->
					</div><!--end col-->
				</div>
				<div class="row">
					<div class="col-xxl-12">
						<div class="card">
							<div class="card-header align-items-center d-flex">
                                <h4 class="card-title mb-0 flex-grow-1">Levels / Ranks</h4>
                                <div class="flex-shrink-0">
                                    <button type="button" class="btn btn-red">Add Ranks</button>
                                </div>
                            </div>
							<div class="card-body">
								<div class="live-preview">
                                    <div class="table-responsive">
                                        <table class="table caption-top table-nowrap mb-0" id="sortable-table">
                                            <thead class="table-light">
                                                <tr>
                                                    <th scope="col">Rank </th>
													<th></th>
                                                    <th scope="col">Stripes</th>
													<th scope="col">Stripe Color</th>
                                                    <th scope="col">Main Color </th>
                                                    <th scope="col">Promotion Requirments</th>
													<th scope="col">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr class="sortable-row">
                                                    <td class="width-15 rank">
														<div class="d-inline-block"><input type="text" class="form-control"></div>
													</td>
													<td>
														<div class="cgreen"></div>
													</td>
                                                    <td>
														<div class="d-inline-block mr-10">
															<select name="activity_type" class="form-select">
																<option value="">0</option>
																<option value="">1</option>
																<option value="">2</option>
																<option value="">3</option>
																<option value="">4</option>
																<option value="">5</option>
																<option value="">6</option>
															</select>
														</div>
													</td>
													<td><div class="d-inline-block"><div class="nano-colorpicker"></div></div></td>
                                                    <td>
														<div class="d-inline-block text-center mr-15">
															<div class="nano-colorpicker"></div>Main
														</div> 
														<div class="d-inline-block text-center">
															<div class="nano-colorpicker"></div>Secondary Color
														</div>
													</td>
                                                    <td>
														<div class="row">
															<div class="col-lg-6 col-md-6 col-12">
																<div class="check-table">
																	<input type="text" class="mr-10"><label>Sessions</label>
																</div>		
																<div class="check-table">
																	<input type="text" class="mr-10"><label>Days in rank</label>
																</div>	
																<div class="check-table">
																	<input type="text" class="mr-10"><label>Minimum Age</label>
																</div>													
															</div>
															<div class="col-lg-6 col-md-6 col-12">
																<div class="check-table">
																	<input type="text" class="mr-10"><label>Hours</label>
																</div>
																<div class="check-table">
																	<input type="text" class="mr-10"><label>Days attended</label>
																</div>
																<div class="check-table">
																	<button type="button" class="btn btn-black" data-bs-toggle="modal" data-bs-target="#skills">Skills</button>
																</div>
															</div>
														</div>														
													</td>
													<td>
														<a href="javascript:void(0);" class="fs-15 mr-15 moverow"><i class="fas fa-arrows-alt"></i></a>		
														<a href="javascript:void(0);" class="fs-17 mr-15"><i class="fas fa-trash-alt"></i></a>
														<a href="javascript:void(0);" class="fs-15 mr-15"><i class="fas fa-plus"></i></a>															
													</td>
                                                </tr>

												<tr class="sortable-row">
                                                    <td class="width-15 rank">
														<div class="d-inline-block"><input type="text" class="form-control"></div>
													</td>
													<td>
														<div class="cyellow">
                                                   			<div class="inner-belt">                                                                                                    
                                                        	</div>
                                                    	 </div>
													</td>
                                                    <td>
														<div class="d-inline-block mr-10">
															<select name="activity_type" class="form-select">
																<option value="">0</option>
																<option value="">1</option>
																<option value="">2</option>
																<option value="">3</option>
																<option value="">4</option>
																<option value="">5</option>
																<option value="">6</option>
															</select>
														</div>
													</td>
													<td><div class="d-inline-block"><div class="nano-colorpicker"></div></div></td>
                                                    <td>
														<div class="d-inline-block text-center mr-15">
															<div class="nano-colorpicker"></div>Main
														</div> 
														<div class="d-inline-block text-center">
															<div class="nano-colorpicker"></div>Secondary Color
														</div>
													</td>
                                                    <td>
														<div class="row">
															<div class="col-lg-6 col-md-6 col-12">
																<div class="check-table">
																	<input type="text" class="mr-10"><label>Sessions</label>
																</div>		
																<div class="check-table">
																	<input type="text" class="mr-10"><label>Days in rank</label>
																</div>	
																<div class="check-table">
																	<input type="text" class="mr-10"><label>Minimum Age</label>
																</div>													
															</div>
															<div class="col-lg-6 col-md-6 col-12">
																<div class="check-table">
																	<input type="text" class="mr-10"><label>Hours</label>
																</div>
																<div class="check-table">
																	<input type="text" class="mr-10"><label>Days attended</label>
																</div>
																<div class="check-table">
																	<button type="button" class="btn btn-black" data-bs-toggle="modal" data-bs-target="#skills">Skills</button>
																</div>
															</div>
														</div>														
													</td>
													<td>
														<a href="javascript:void(0);" class="fs-15 mr-15 moverow"><i class="fas fa-arrows-alt"></i></a>		
														<a href="javascript:void(0);" class="fs-17 mr-15"><i class="fas fa-trash-alt"></i></a>
														<a href="javascript:void(0);" class="fs-15 mr-15"><i class="fas fa-plus"></i></a>									
													</td>
                                                </tr>

                                                <tr class="sortable-row">
												    <td class="width-15 rank">
														<div class="d-inline-block"><input type="text" class="form-control"></div>
													</td>
													<td>
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
													</td>
												    <td>
														<div class="d-inline-block mr-10">
															<select name="activity_type" class="form-select">
																<option value="">0</option>
																<option value="">1</option>
																<option value="">2</option>
																<option value="">3</option>
																<option value="">4</option>
																<option value="">5</option>
																<option value="">6</option>
															</select>
														</div>
													</td>
													<td><div class="d-inline-block"><div class="nano-colorpicker"></div></div></td>
												    <td>
														<div class="d-inline-block text-center mr-15">
															<div class="nano-colorpicker"></div>Main
														</div> 
														<div class="d-inline-block text-center">
															<div class="nano-colorpicker"></div>Secondary Color
														</div>
													</td>
												    <td>
														<div class="row">
															<div class="col-lg-6 col-md-6 col-12">
																<div class="check-table">
																	<input type="text" class="mr-10"><label>Sessions</label>
																</div>		
																<div class="check-table">
																	<input type="text" class="mr-10"><label>Days in rank</label>
																</div>	
																<div class="check-table">
																	<input type="text" class="mr-10"><label>Minimum Age</label>
																</div>													
															</div>
															<div class="col-lg-6 col-md-6 col-12">
																<div class="check-table">
																	<input type="text" class="mr-10"><label>Hours</label>
																</div>
																<div class="check-table">
																	<input type="text" class="mr-10"><label>Days attended</label>
																</div>
																<div class="check-table">
																	<button type="button" class="btn btn-black" data-bs-toggle="modal" data-bs-target="#skills">Skills</button>
																</div>
															</div>
														</div>														
													</td>
													<td>
														<a href="javascript:void(0);" class="fs-15 mr-15"><i class="fas fa-arrows-alt"></i></a>		
														<a href="javascript:void(0);" class="fs-17 mr-15"><i class="fas fa-trash-alt"></i></a>
														<a href="javascript:void(0);" class="fs-15 mr-15"><i class="fas fa-plus"></i></a>									
													</td>
												</tr>
                                            </tbody>
                                    	</table>
                                	</div>
									<div class="row">
										<div class="col-lg-6 col-md-6 col-sm-6 col-6">
											<button type="button" class="btn btn-red mt-10">Remove Program</button>
										</div>
										<div class="col-lg-6 col-md-6 col-sm-6 col-6">
											<div class="text-end">
												<button type="button" class="btn btn-black mt-10">Save Program</button>
											</div>
										</div>
									</div>
                           		</div>
							</div>
						</div>
					<div>
				</div>
			</div><!-- container-fluid -->
		</div>
	</div><!-- end main content-->
	
</div><!-- END layout-wrapper -->
<!-- Modal -->
<div class="modal fade" id="skills" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered">
    	<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="staticBackdropLabel">Pick Skills</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body">
				<form>
					<div class="row">
						<div class="col-lg-6">
							<div class="mb-3">
								<select name="activity_type" data-behavior="on_change_submit" class="form-select" id="choices-publish-status-input" data-choices="" data-choices-search-false="">
									<option value=""> Taekwondo </option>
									<option value="">Yoga</option>
									<option value="">Martial Arts</option>
								</select>
							</div>
						</div>
						<div class="col-lg-6">
							<select name="activity_type" data-behavior="on_change_submit" class="form-select" id="choices-publish-status-input" data-choices="" data-choices-search-false="">
								<option value=""> Select Category </option>
								<option value="">Option 1</option>
								<option value="">Option 2</option>
							</select>
						</div>
						<div class="col-lg-6">
							<select name="activity_type" data-behavior="on_change_submit" class="form-select" id="choices-publish-status-input" data-choices="" data-choices-search-false="">
								<option value=""> All Ranks / Levels </option>
								<option value="">Option 1</option>
								<option value="">Option 2</option>
							</select>
						</div>
					</div>
				<form>
				<div class="dashed-border mt-15 mb-15"></div>
				<form>
					<div class="row">
						<div class="col-lg-6">
							<div class="mb-3">
								<select name="activity_type" data-behavior="on_change_submit" class="form-select" id="choices-publish-status-input" data-choices="" data-choices-search-false="">
									<option value=""> 52 blocks </option>
									<option value="">Option 1</option>
									<option value="">Option 2</option>
								</select>
							</div>
						</div>
						<div class="col-lg-6">
							<select name="activity_type" data-behavior="on_change_submit" class="form-select" id="choices-publish-status-input" data-choices="" data-choices-search-false="">
								<option value="">Upperward Block</option>
								<option value="">Option 1</option>
								<option value="">Option 2</option>
							</select>
						</div>
						<div class="col-lg-6">
							<select name="activity_type" data-behavior="on_change_submit" class="form-select" id="choices-publish-status-input" data-choices="" data-choices-search-false="">
								<option value="">Front Snap Kick</option>
								<option value="">Option 1</option>
								<option value="">Option 2</option>
							</select>
						</div>
					</div>
				<form>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-red" data-bs-dismiss="modal">Save</button>
			</div>
   		</div>
  	</div>
</div>

<!-- Modal -->
<div class="modal fade" id="temp" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  	<div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="staticBackdropLabel">Modal title</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body">
				<div class="accordion" id="accordionEx">
							<div class="accordion-item mb-3">
								<div class="accordion-header" id="headingOne">
									<button type="button" class="accordion-button" data-bs-target="#collapseOne" data-bs-toggle="collapse" aria-expanded="true" aria-controls="collapseOne">
										<div class="avatar-group-item shadow mr-15">
                                        	<img src="https://fitnessity-production.s3.amazonaws.com/customer/Pj5DKQgqQZvsvjBEQokyaKtuHHNHEmv0xTExXX2D.jpg" alt="" class="rounded-circle avatar-sm">
                                 		</div>
										Martial Arts
									</button>
								</div>
								<div id="collapseOne" class="accordion-collapse collapse " aria-labelledby="headingOne" data-bs-parent="accordionEx">
									<div class="accordion-body">
										<div class="row">
											<div class="col-md-6">
												<button type="button" class="btn border w-100 mb-3">Boxing</button>
												<button type="button" class="btn border w-100 mb-3">Brazilian Jiu Jitsu Kids</button>
												<button type="button" class="btn border w-100 mb-3">Judo</button>
												<button type="button" class="btn border w-100 mb-3">Kyokushin Karate</button>
												<button type="button" class="btn border w-100 mb-3">Taekwondo</button>
												<button type="button" class="btn border w-100 mb-3">Wrestling</button>
											</div>
											<div class="col-md-6">
												<button type="button" class="btn border w-100 mb-3">Brazilian Jiu Jitsu</button>
												<button type="button" class="btn border w-100 mb-3">Fencing</button>
												<button type="button" class="btn border w-100 mb-3">Kung Fu</button>
												<button type="button" class="btn border w-100 mb-3">Shotokan Karate</button>
												<button type="button" class="btn border w-100 mb-3">Tia-Chi</button>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="accordion-item mb-3">
								<div class="accordion-header" id="heading2">
									<button type="button" class="accordion-button" data-bs-target="#collapse2" data-bs-toggle="collapse" aria-expanded="true" aria-controls="collapse2">
										<div class="avatar-group-item shadow mr-15">
                                        	<img src="https://fitnessity-production.s3.amazonaws.com/gallery/jOazupMlBTmPjctkYXQ9HcEWDQvjDz0u6wwOhwBi.jpg" alt="" class="rounded-circle avatar-sm">
                                 		</div>
										Gymnastic, Cheer & Dance
									</button>
								</div>
								<div id="collapse2" class="accordion-collapse collapse " aria-labelledby="heading2" data-bs-parent="accordionEx">
									<div class="accordion-body">
										<div class="row">
											<div class="col-md-6">
												<button type="button" class="btn border w-100 mb-3">Boxing</button>
												<button type="button" class="btn border w-100 mb-3">Brazilian Jiu Jitsu Kids</button>
												<button type="button" class="btn border w-100 mb-3">Judo</button>
												<button type="button" class="btn border w-100 mb-3">Kyokushin Karate</button>
												<button type="button" class="btn border w-100 mb-3">Taekwondo</button>
												<button type="button" class="btn border w-100 mb-3">Wrestling</button>
											</div>
											<div class="col-md-6">
												<button type="button" class="btn border w-100 mb-3">Brazilian Jiu Jitsu</button>
												<button type="button" class="btn border w-100 mb-3">Fencing</button>
												<button type="button" class="btn border w-100 mb-3">Kung Fu</button>
												<button type="button" class="btn border w-100 mb-3">Shotokan Karate</button>
												<button type="button" class="btn border w-100 mb-3">Tia-Chi</button>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="accordion-item mb-3">
								<div class="accordion-header" id="heading3">
									<button type="button" class="accordion-button" data-bs-target="#collapse3" data-bs-toggle="collapse" aria-expanded="true" aria-controls="collapse3">
										<div class="avatar-group-item shadow mr-15">
                                        	<img src="http://dev.fitnessity.co/public/uploads/getstarted/thumb/1675243766-c176bda2bbaf9f64813fbe97b0d67e4b.jpg" alt="" class="rounded-circle avatar-sm">
                                 		</div>
										Gymnastic, Cheer & Dance
									</button>
								</div>
								<div id="collapse3" class="accordion-collapse collapse " aria-labelledby="heading3" data-bs-parent="accordionEx">
									<div class="accordion-body">
										<div class="row">
											<div class="col-md-6">
												<button type="button" class="btn border w-100 mb-3">Boxing</button>
												<button type="button" class="btn border w-100 mb-3">Brazilian Jiu Jitsu Kids</button>
												<button type="button" class="btn border w-100 mb-3">Judo</button>
												<button type="button" class="btn border w-100 mb-3">Kyokushin Karate</button>
												<button type="button" class="btn border w-100 mb-3">Taekwondo</button>
												<button type="button" class="btn border w-100 mb-3">Wrestling</button>
											</div>
											<div class="col-md-6">
												<button type="button" class="btn border w-100 mb-3">Brazilian Jiu Jitsu</button>
												<button type="button" class="btn border w-100 mb-3">Fencing</button>
												<button type="button" class="btn border w-100 mb-3">Kung Fu</button>
												<button type="button" class="btn border w-100 mb-3">Shotokan Karate</button>
												<button type="button" class="btn border w-100 mb-3">Tia-Chi</button>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="accordion-item mb-3">
								<div class="accordion-header" id="heading4">
									<button type="button" class="accordion-button" data-bs-target="#collapse4" data-bs-toggle="collapse" aria-expanded="true" aria-controls="collapse4">
										<div class="avatar-group-item shadow mr-15">
                                        	<img src="http://dev.fitnessity.co/public/uploads/gallery/720/paris.jpg" alt="" class="rounded-circle avatar-sm">
                                 		</div>
										Gymnastic, Cheer & Dance
									</button>
								</div>
								<div id="collapse4" class="accordion-collapse collapse " aria-labelledby="heading4" data-bs-parent="accordionEx">
									<div class="accordion-body">
										<div class="row">
											<div class="col-md-6">
												<button type="button" class="btn border w-100 mb-3">Boxing</button>
												<button type="button" class="btn border w-100 mb-3">Brazilian Jiu Jitsu Kids</button>
												<button type="button" class="btn border w-100 mb-3">Judo</button>
												<button type="button" class="btn border w-100 mb-3">Kyokushin Karate</button>
												<button type="button" class="btn border w-100 mb-3">Taekwondo</button>
												<button type="button" class="btn border w-100 mb-3">Wrestling</button>
											</div>
											<div class="col-md-6">
												<button type="button" class="btn border w-100 mb-3">Brazilian Jiu Jitsu</button>
												<button type="button" class="btn border w-100 mb-3">Fencing</button>
												<button type="button" class="btn border w-100 mb-3">Kung Fu</button>
												<button type="button" class="btn border w-100 mb-3">Shotokan Karate</button>
												<button type="button" class="btn border w-100 mb-3">Tia-Chi</button>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="accordion-item mb-3">
								<div class="accordion-header" id="heading5">
									<button type="button" class="accordion-button" data-bs-target="#collapse5" data-bs-toggle="collapse" aria-expanded="true" aria-controls="collapse2">
										<div class="avatar-group-item shadow mr-15">
                                        	<img src="https://fitnessity-production.s3.amazonaws.com/gallery/jOazupMlBTmPjctkYXQ9HcEWDQvjDz0u6wwOhwBi.jpg" alt="" class="rounded-circle avatar-sm">
                                 		</div>
										Gymnastic, Cheer & Dance
									</button>
								</div>
								<div id="collapse5" class="accordion-collapse collapse " aria-labelledby="heading5" data-bs-parent="accordionEx">
									<div class="accordion-body">
										<div class="row">
											<div class="col-md-6">
												<button type="button" class="btn border w-100 mb-3">Boxing</button>
												<button type="button" class="btn border w-100 mb-3">Brazilian Jiu Jitsu Kids</button>
												<button type="button" class="btn border w-100 mb-3">Judo</button>
												<button type="button" class="btn border w-100 mb-3">Kyokushin Karate</button>
												<button type="button" class="btn border w-100 mb-3">Taekwondo</button>
												<button type="button" class="btn border w-100 mb-3">Wrestling</button>
											</div>
											<div class="col-md-6">
												<button type="button" class="btn border w-100 mb-3">Brazilian Jiu Jitsu</button>
												<button type="button" class="btn border w-100 mb-3">Fencing</button>
												<button type="button" class="btn border w-100 mb-3">Kung Fu</button>
												<button type="button" class="btn border w-100 mb-3">Shotokan Karate</button>
												<button type="button" class="btn border w-100 mb-3">Tia-Chi</button>
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

	$('tbody').sortable({
	  	stop: function( event, ui ) {
		    $("tbody tr").removeClass("aaa");
		    $("tbody tr .name").removeClass("bbb");
		    
		    $("tbody tr:first-child").addClass("aaa");
		    $("tbody tr:first-child .name").addClass("bbb");
		}
	});
	$("tbody tr:first-child").addClass("aaa");
	$("tbody tr:first-child .name").addClass("bbb");
	
</script>

@endsection