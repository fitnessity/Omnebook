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
                                    <button type="button" class="btn btn-red">Use Template</button>
                                </div>
                            </div>
							<div class="card-body">
                                <form action="javascript:void(0);">
									<div class="row">
										<div class="col-lg-3">
											<div class="mb-3">
												<label for="firstnameInput" class="form-label">Program Name</label>
												<input type="text" class="form-control" id="firstnameInput" placeholder="Enter your firstname" value="Taekwondo">
											</div>
										</div><!--end col-->
                                    	<div class="col-lg-3">
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
                                    	<div class="col-lg-3">
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
                                    	<div class="col-lg-3">
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

										<div class="col-lg-3">
											<div class="steps-title mmb-10">
												<div class="mb-3">
													<label for="JoiningdatInput" class="form-label">Promotion Requirements</label>
													<div class="row">
														<div class="col-6">
															<div>
																<input type="checkbox" id="vehicle1" name="vehicle1" value="Bike">
																<label for="vehicle1">Sessions</label><br>
																<input type="checkbox" id="vehicle2" name="vehicle2" value="Car">
																<label for="vehicle2">Hours</label><br>
																<input type="checkbox" id="vehicle3" name="vehicle3" value="Boat">
																<label for="vehicle3">Days in Rank</label><br> 
															</div>
														</div>
														<div class="col-6">
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

										<div class="col-lg-3">
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
                                        <table class="table caption-top table-nowrap mb-0">
                                            <thead class="table-light">
                                                <tr>
                                                    <th scope="col">Rank </th>
                                                    <th scope="col">Stripes</th>
                                                    <th scope="col">Color</th>
                                                    <th scope="col">Promotion Requirments</th>
													<th scope="col">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>
														<div class="d-inline-block mr-10"><input type="text" class="form-control"></div>
														<div class="d-inline-block"><div class="cgreen w-100px mr-5"></div></div>
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
														<div class="d-inline-block"><div class="nano-colorpicker"></div></div>
													</td>
                                                    <td>
														<div class="d-inline-block text-center mr-15">
															<div class="nano-colorpicker"></div>Main
														</div> 
														<div class="d-inline-block text-center">
															<div class="nano-colorpicker"></div>Secondary
														</div>
													</td>
                                                    <td></td>
													<td>
														<a href="javascript:void(0);" class="fs-17 mr-15"><i class="fas fa-trash-alt"></i></a>
														<a href="javascript:void(0);" class="fs-15"><i class="fas fa-plus"></i></a>													
													</td>
                                                </tr>

												<!--<tr>
                                                    <td>
														<div class="d-inline-block mr-10"><input type="text" class="form-control"></div>
														<div class="d-inline-block">
															<div class="cyellow">
                                                            	 <div class="inner-belt">                                                                                                    
                                                            	</div>
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
														<div class="d-inline-block"><div class="nano-colorpicker"></div></div>
													</td>
                                                    <td>
														<div class="d-inline-block text-center mr-15">
															<div class="nano-colorpicker"></div>Main
														</div> 
														<div class="d-inline-block text-center">
															<div class="nano-colorpicker"></div>Secondary
														</div>
													</td>
                                                    <td></td>
													<td>
														<a href="javascript:void(0);" class="fs-17 mr-15"><i class="fas fa-trash-alt"></i></a>
														<a href="javascript:void(0);" class="fs-15"><i class="fas fa-plus"></i></a>													
													</td>
                                                </tr> -->
                                            </tbody>
                                    	</table>
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
@include('layouts.business.footer')
@endsection