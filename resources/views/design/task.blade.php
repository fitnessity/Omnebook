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
							<label>Task</label>
						</div>
					</div>
				</div><!--end row-->
				<div class="row">
					<div class="col-xl-12">
						<div class="card">
							<div class="card-body">
								<div class="chat-wrapper d-lg-flex gap-1 p-1">
									<div class="file-manager-content w-100 pb-0">
										<div class="row mb-4">
											<div class="col-auto order-1 d-block d-lg-none">
												<button type="button" class="btn btn-soft-success btn-icon btn-sm fs-16 file-menu-btn">
													<i class="ri-menu-2-fill align-bottom"></i>
												</button>
											</div>
										</div>
										<div class="p-3 bg-light rounded mb-4">
											<div class="row g-2">
												<div class="col-lg-auto">
													<select class="form-control" data-choices data-choices-search-false name="choices-select-sortlist" id="choices-select-sortlist">
														<option value="">Sort</option>
														<option value="By ID">By ID</option>
														<option value="By Name">By Name</option>
													</select>
												</div>
												<div class="col-lg-auto">
													<select class="form-control" data-choices data-choices-search-false name="choices-select-status" id="choices-select-status">
														<option value="">All Tasks</option>
														<option value="Completed">Completed</option>
														<option value="Inprogress">Inprogress</option>
														<option value="Pending">Pending</option>
														<option value="New">New</option>
													</select>
												</div>
												<div class="col-lg">
													<div class="search-box">
														<input type="text" id="searchTaskList" class="form-control search" placeholder="Search task name">
														<i class="ri-search-line search-icon"></i>
													</div>
												</div>
												<div class="col-lg-auto">
													<button class="btn btn-red createTask" type="button" data-bs-toggle="modal" data-bs-target="#createTask">
														<i class="ri-add-fill align-bottom"></i> Add Tasks
													</button>
												</div>
											</div>
										</div>

										<div class="todo-content position-relative px-4 mx-n4" id="todo-content">
											<div class="todo-task" id="todo-task">
												<div class="table-responsive">
													<table class="table align-middle position-relative table-nowrap">
														<thead class="table-active">
															<tr>
																<th scope="col">Title</th>
																<th scope="col">Date Appointed</th>
																<th scope="col">Due Date</th>
															</tr>
														</thead>
														<tbody id="task-list">
															<tr>
																<td>
																	<div class="d-flex align-items-start">
																		<div class="flex-grow-1">
																		   <div class="form-check">                        
																				<input class="form-check-input" type="checkbox" value="15" id="todo15">                           
																				<label class="form-check-label" for="todo15">Added Select1</label>                        
																		   </div>
																		</div>
																	 </div>
																</td>     
																<td>23 Apr, 2022</td>
																<td>23 Apr, 2022</td>
															</tr>
															
															<tr>
																<td>
																	<div class="d-flex align-items-start">
																		<div class="flex-grow-1">
																		   <div class="form-check">                        
																				<input class="form-check-input" type="checkbox" value="15" id="todo15">                           
																				<label class="form-check-label" for="todo15">Added Select2</label>                        
																		   </div>
																		</div>
																	 </div>
																</td>     
																<td>24 Apr, 2022</td>
																<td>23 March, 2023</td>
															</tr>
															<tr>
																<td>
																	<div class="d-flex align-items-start">
																		<div class="flex-grow-1">
																		   <div class="form-check">                        
																				<input class="form-check-input" type="checkbox" value="15" id="todo15">                           
																				<label class="form-check-label" for="todo15">Added Select3</label>                        
																		   </div>
																		</div>
																	 </div>
																</td>     
																<td>21 Jan, 2022</td>
																<td>22 Fab, 2023</td>
															</tr>
														</tbody>
													</table>
												</div>
											</div>											
										</div>										
									</div>
								</div>
							</div><!-- end card Body -->							
						</div>
					</div>
				</div>
								
			</div><!-- container-fluid -->
		</div>
	</div><!-- end main content-->
	
</div><!-- END layout-wrapper -->

@include('layouts.business.footer')



@endsection