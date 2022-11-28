@extends('layouts.header')
@section('content')
@include('layouts.userHeader')

<div class="p-0 col-md-12 inner_top padding-0">
    <div class="row">
        <div class="col-md-2" style="background: black;">
        	 @include('business.businessSidebar')
        </div>
		<div class="col-md-10">
            <div class="container-fluid p-0">
				<div class="row">
					<div class="col-md-6">
						<div class="tab-hed ">Manage Customers</div>
					</div>
					<div class="col-md-6">
						<a href="#" class="btn-nxt manage-cus-btn" data-toggle="modal" data-target="#newclient">Add New Client</a>
					</div>
				</div>
                <!--<div class="tab-hed manage-cus">Manage Customers</div>
				<button type="button" class="btn-nxt manage-cus-btn">Add New Client</button>-->
				<hr style="border: 3px solid black; width: 115%; margin-left: -38px; margin-top: 5px;">
            </div>
			<div class="row">
				<div class="col-md-6 col-xs-12">
					
				</div>
				<div class="col-md-6 col-xs-12">
					<div class="staff-main">
						<button type="button" class="btn-bck">Import List</button>
						<button type="button" class="btn-nxt">Export List</button>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12 col-xs-12">
					<div class="total-clients">
						<i class="fas fa-user-circle"></i>
						<label>You Have 144 Clients</label>
					</div>
					<div class="panel-group" id="accordion">
						<div class="custom-panel panel panel-default">
							<div class="custom panel-heading">
								<h4 class="panel-title">
									<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapseOne">
									A
									</a>
								</h4>
							</div>
							<div id="collapseOne" class="panel-collapse collapse in">
								<div class="panel-body">
									<div class="row">
										<div class="col-md-12">
											<div class="collapse-inner-box mrb-2">
												<div class="row">
													<div class="col-md-1">
														<div class="collapse-img">
															<img src="http://dev.fitnessity.co/public/uploads/profile_pic/index.jpg" class="imgboxes" alt="">
														</div>
													</div>
													<div class="col-md-2">
														<div class="client-name">
															<span>Adam Ladd</span>
															<p>Last Attended: 20/09/2019</p>
														</div>
													</div>
													<div class="col-md-1">
														<div class="client-age">
															<span>Age: 32</span>
														</div>
													</div>
													<div class="col-md-2">
														<div class="client-status">
															<label>Status: </label>
															<span class="green-fonts">Active</span>
														</div>
													</div>
													<div class="col-md-3">
														<div class="client-status">
															<label>Active Memberships: </label>
															<span class="green-fonts">2</span>
														</div>
													</div>
													<div class="col-md-2">
														<div class="client-status">
															<label>Expiring Soon: </label>
															<span class="red-fonts">1</span>
														</div>
													</div>
													<div class="col-md-1">
														<div class="client-status">
															<a href="{{ route('viewcustomer') }}">View</a>
														</div>
													</div>
													
												</div>
											</div>	
											
											<div class="collapse-inner-box mrb-2">
												<div class="row">
													<div class="col-md-1">
														<div class="collapse-img">
															<img src="http://dev.fitnessity.co/public/uploads/profile_pic/index.jpg" class="imgboxes" alt="">
														</div>
													</div>
													<div class="col-md-2">
														<div class="client-name">
															<span>Amber Morgan</span>
															<p>Last Attended: 20/09/2019</p>
														</div>
													</div>
													<div class="col-md-1">
														<div class="client-age">
															<span>Age: 23</span>
														</div>
													</div>
													<div class="col-md-2">
														<div class="client-status">
															<label>Status: </label>
															<span class="green-fonts">Inactive</span>
														</div>
													</div>
													<div class="col-md-3">
														<div class="client-status">
															<label>Active Memberships: </label>
															<span class="black-fonts">0</span>
														</div>
													</div>
													<div class="col-md-2">
														<div class="client-status">
															<label>Expiring Soon: </label>
															<span class="red-fonts">1</span>
														</div>
													</div>
													<div class="col-md-1">
														<div class="client-status">
															<a href="">View</a>
														</div>
													</div>
													
												</div>
											</div>
											
											<div class="collapse-inner-box mrb-2">
												<div class="row">
													<div class="col-md-1">
														<div class="collapse-img">
															<img src="http://dev.fitnessity.co/public/uploads/profile_pic/index.jpg" class="imgboxes" alt="">
														</div>
													</div>
													<div class="col-md-2">
														<div class="client-name">
															<span>Allan Norris</span>
															<p>Last Attended: 20/09/2019</p>
														</div>
													</div>
													<div class="col-md-1">
														<div class="client-age">
															<span>Age: 45</span>
														</div>
													</div>
													<div class="col-md-2">
														<div class="client-status">
															<label>Status: </label>
															<span class="green-fonts">Active</span>
														</div>
													</div>
													<div class="col-md-3">
														<div class="client-status">
															<label>Active Memberships: </label>
															<span class="green-fonts">1</span>
														</div>
													</div>
													<div class="col-md-2">
														<div class="client-status">
															<label>Expiring Soon: </label>
															<span class="red-fonts">1</span>
														</div>
													</div>
													<div class="col-md-1">
														<div class="client-status">
															<a href="">View</a>
														</div>
													</div>
													
												</div>
											</div>
											
											<div class="collapse-inner-box mrb-2">
												<div class="row">
													<div class="col-md-1">
														<div class="collapse-img">
															<img src="http://dev.fitnessity.co/public/uploads/profile_pic/index.jpg" class="imgboxes" alt="">
														</div>
													</div>
													<div class="col-md-2">
														<div class="client-name">
															<span>Ashley Wong</span>
															<p>Last Attended: 20/09/2019</p>
														</div>
													</div>
													<div class="col-md-1">
														<div class="client-age">
															<span>Age: 18</span>
														</div>
													</div>
													<div class="col-md-2">
														<div class="client-status">
															<label>Status: </label>
															<span class="green-fonts">Active</span>
														</div>
													</div>
													<div class="col-md-3">
														<div class="client-status">
															<label>Active Memberships: </label>
															<span class="green-fonts">3</span>
														</div>
													</div>
													<div class="col-md-2">
														<div class="client-status">
															<label>Expiring Soon: </label>
															<span class="red-fonts">2</span>
														</div>
													</div>
													<div class="col-md-1">
														<div class="client-status">
															<a href="">View</a>
														</div>
													</div>
													
												</div>
											</div>
											
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="custom-panel panel panel-default">
							<div class="custom panel-heading">
								<h4 class="panel-title">
									<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo">
									B
									</a>
								</h4>
							</div>
							<div id="collapseTwo" class="panel-collapse collapse">
								<div class="panel-body">
									<div class="row">
										<div class="col-md-12">
											<div class="collapse-inner-box mrb-2">
												<div class="row">
													<div class="col-md-1">
														<div class="collapse-img">
															<img src="http://dev.fitnessity.co/public/uploads/profile_pic/index.jpg" class="imgboxes" alt="">
														</div>
													</div>
													<div class="col-md-2">
														<div class="client-name">
															<span>Adam Ladd</span>
															<p>Last Attended: 20/09/2019</p>
														</div>
													</div>
													<div class="col-md-1">
														<div class="client-age">
															<span>Age: 32</span>
														</div>
													</div>
													<div class="col-md-2">
														<div class="client-status">
															<label>Status: </label>
															<span class="green-fonts">Active</span>
														</div>
													</div>
													<div class="col-md-3">
														<div class="client-status">
															<label>Active Memberships: </label>
															<span class="green-fonts">2</span>
														</div>
													</div>
													<div class="col-md-2">
														<div class="client-status">
															<label>Expiring Soon: </label>
															<span class="red-fonts">1</span>
														</div>
													</div>
													<div class="col-md-1">
														<div class="client-status">
															<a href="{{ route('viewcustomer') }}">View</a>
														</div>
													</div>
													
												</div>
											</div>	
											
											<div class="collapse-inner-box mrb-2">
												<div class="row">
													<div class="col-md-1">
														<div class="collapse-img">
															<img src="http://dev.fitnessity.co/public/uploads/profile_pic/index.jpg" class="imgboxes" alt="">
														</div>
													</div>
													<div class="col-md-2">
														<div class="client-name">
															<span>Allan Norris</span>
															<p>Last Attended: 20/09/2019</p>
														</div>
													</div>
													<div class="col-md-1">
														<div class="client-age">
															<span>Age: 45</span>
														</div>
													</div>
													<div class="col-md-2">
														<div class="client-status">
															<label>Status: </label>
															<span class="green-fonts">Active</span>
														</div>
													</div>
													<div class="col-md-3">
														<div class="client-status">
															<label>Active Memberships: </label>
															<span class="green-fonts">1</span>
														</div>
													</div>
													<div class="col-md-2">
														<div class="client-status">
															<label>Expiring Soon: </label>
															<span class="red-fonts">1</span>
														</div>
													</div>
													<div class="col-md-1">
														<div class="client-status">
															<a href="">View</a>
														</div>
													</div>
													
												</div>
											</div>
											
											<div class="collapse-inner-box mrb-2">
												<div class="row">
													<div class="col-md-1">
														<div class="collapse-img">
															<img src="http://dev.fitnessity.co/public/uploads/profile_pic/index.jpg" class="imgboxes" alt="">
														</div>
													</div>
													<div class="col-md-2">
														<div class="client-name">
															<span>Ashley Wong</span>
															<p>Last Attended: 20/09/2019</p>
														</div>
													</div>
													<div class="col-md-1">
														<div class="client-age">
															<span>Age: 18</span>
														</div>
													</div>
													<div class="col-md-2">
														<div class="client-status">
															<label>Status: </label>
															<span class="green-fonts">Active</span>
														</div>
													</div>
													<div class="col-md-3">
														<div class="client-status">
															<label>Active Memberships: </label>
															<span class="green-fonts">3</span>
														</div>
													</div>
													<div class="col-md-2">
														<div class="client-status">
															<label>Expiring Soon: </label>
															<span class="red-fonts">2</span>
														</div>
													</div>
													<div class="col-md-1">
														<div class="client-status">
															<a href="">View</a>
														</div>
													</div>
													
												</div>
											</div>
											
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="custom-panel panel panel-default">
							<div class="custom panel-heading">
								<h4 class="panel-title">
									<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapseThree">
									C
									</a>
								</h4>
							</div>
							<div id="collapseThree" class="panel-collapse collapse">
								<div class="panel-body">
									<div class="row">
										<div class="col-md-12">
											<div class="collapse-inner-box mrb-2">
												<div class="row">
													<div class="col-md-1">
														<div class="collapse-img">
															<img src="http://dev.fitnessity.co/public/uploads/profile_pic/index.jpg" class="imgboxes" alt="">
														</div>
													</div>
													<div class="col-md-2">
														<div class="client-name">
															<span>Adam Ladd</span>
															<p>Last Attended: 20/09/2019</p>
														</div>
													</div>
													<div class="col-md-1">
														<div class="client-age">
															<span>Age: 32</span>
														</div>
													</div>
													<div class="col-md-2">
														<div class="client-status">
															<label>Status: </label>
															<span class="green-fonts">Active</span>
														</div>
													</div>
													<div class="col-md-3">
														<div class="client-status">
															<label>Active Memberships: </label>
															<span class="green-fonts">2</span>
														</div>
													</div>
													<div class="col-md-2">
														<div class="client-status">
															<label>Expiring Soon: </label>
															<span class="red-fonts">1</span>
														</div>
													</div>
													<div class="col-md-1">
														<div class="client-status">
															<a href="{{ route('viewcustomer') }}">View</a>
														</div>
													</div>
													
												</div>
											</div>	
											
											<div class="collapse-inner-box mrb-2">
												<div class="row">
													<div class="col-md-1">
														<div class="collapse-img">
															<img src="http://dev.fitnessity.co/public/uploads/profile_pic/index.jpg" class="imgboxes" alt="">
														</div>
													</div>
													<div class="col-md-2">
														<div class="client-name">
															<span>Amber Morgan</span>
															<p>Last Attended: 20/09/2019</p>
														</div>
													</div>
													<div class="col-md-1">
														<div class="client-age">
															<span>Age: 23</span>
														</div>
													</div>
													<div class="col-md-2">
														<div class="client-status">
															<label>Status: </label>
															<span class="green-fonts">Inactive</span>
														</div>
													</div>
													<div class="col-md-3">
														<div class="client-status">
															<label>Active Memberships: </label>
															<span class="black-fonts">0</span>
														</div>
													</div>
													<div class="col-md-2">
														<div class="client-status">
															<label>Expiring Soon: </label>
															<span class="red-fonts">1</span>
														</div>
													</div>
													<div class="col-md-1">
														<div class="client-status">
															<a href="">View</a>
														</div>
													</div>
													
												</div>
											</div>
											
											<div class="collapse-inner-box mrb-2">
												<div class="row">
													<div class="col-md-1">
														<div class="collapse-img">
															<img src="http://dev.fitnessity.co/public/uploads/profile_pic/index.jpg" class="imgboxes" alt="">
														</div>
													</div>
													<div class="col-md-2">
														<div class="client-name">
															<span>Allan Norris</span>
															<p>Last Attended: 20/09/2019</p>
														</div>
													</div>
													<div class="col-md-1">
														<div class="client-age">
															<span>Age: 45</span>
														</div>
													</div>
													<div class="col-md-2">
														<div class="client-status">
															<label>Status: </label>
															<span class="green-fonts">Active</span>
														</div>
													</div>
													<div class="col-md-3">
														<div class="client-status">
															<label>Active Memberships: </label>
															<span class="green-fonts">1</span>
														</div>
													</div>
													<div class="col-md-2">
														<div class="client-status">
															<label>Expiring Soon: </label>
															<span class="red-fonts">1</span>
														</div>
													</div>
													<div class="col-md-1">
														<div class="client-status">
															<a href="">View</a>
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
	
<!-- The Modal Add Business
<div class="modal fade compare-model" id="newclient">
    <div class="modal-dialog modal-lg business">
        <div class="modal-content">
			<div class="modal-header" style="text-align: right;"> 
			  	<div class="closebtn">
					<button type="button" class="close close-btn-design" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">×</span>
					</button>
				</div>
			</div>

            <!-- Modal body 
            <div class="modal-body">
				<div class="row contentPop"> 
					<div class="col-lg-12">
					   <h4 class="modal-title" style="text-align: center; color: #000; line-height: inherit; font-weight: 600;">ADD BUSINESS</h4>
					</div>
                    <div class="col-lg-12">
                        <div class="modal-inner-txt">
                        	<p>Are you a customer or business owner wanting to add information about a business? <br>It’s free to add to Fitnessity!</p>
                        </div>
                    </div>
					<div class="col-lg-12 btns-modal">
					</div>
				 </div>
            </div>
        </div>
    </div>
</div>
<!-- end modal -->
</div>


@include('layouts.footer')

<!-- Latest compiled and minified JavaScript -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
