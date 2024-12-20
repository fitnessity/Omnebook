@extends('layouts.header')
@section('content')
@include('layouts.userHeader')

<div class="p-0 col-md-12 inner_top padding-0">
    <div class="row">
        <div class="col-md-2 col-sm-12" style="background: black;">
        	 @include('business.businessSidebar')
        </div>
		<div class="col-md-10 col-sm-12">
            <div class="container-fluid p-0">
				<div class="row">
					<div class="col-md-6 col-xs-6">
						<div class="tab-hed ">Manage Customers</div>
					</div>
					<div class="col-md-6 col-xs-6">
						<div class="row">
							<div class="col-md-4">
								<a href="#" class="btn-nxt manage-cus-btn" data-toggle="modal" data-target="#newclient">Add New Client</a>
							</div>
							<div class="col-md-5">
								<div class="manage-search">
									<form method="get" action="/activities/">
										<input type="text" name="label" id="" placeholder="Search for client" autocomplete="off" value="">
										<button id="serchbtn"><i class="fa fa-search"></i></button>
									</form>
								</div>
							</div>
							<div class="col-md-3">
								<button type="button" class="btn-nxt search-btn-sp">Search</button>
							</div>
						</div>
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
					<div class="panel-group" id="accordion-customer">
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
													<div class="col-md-1 col-xs-3 col-sm-1">
														<div class="collapse-img">
															<img src="/public/uploads/profile_pic/index.jpg" class="imgboxes" alt="">
														</div>
													</div>
													<div class="col-md-2 col-xs-8 col-sm-2">
														<div class="client-name">
															<span>Adam Ladd</span>
															<p>Last Attended: 20/09/2019</p>
														</div>
													</div>
													<div class="col-md-1 col-xs-12 col-sm-1">
														<div class="client-age">
															<span>Age: 32</span>
														</div>
													</div>
													<div class="col-md-2 col-xs-12 col-sm-2">
														<div class="client-status">
															<label>Status: </label>
															<span class="green-fonts">Active</span>
														</div>
													</div>
													<div class="col-md-3 col-xs-12 col-sm-3">
														<div class="client-status">
															<label>Active Memberships: </label>
															<span class="green-fonts">2</span>
														</div>
													</div>
													<div class="col-md-2 col-xs-12 col-sm-2">
														<div class="client-status">
															<label>Expiring Soon: </label>
															<span class="red-fonts">1</span>
														</div>
													</div>
													<div class="col-md-1 col-xs-12 col-sm-1">
														<div class="client-status">
															<a href="{{ route('viewcustomer') }}">View</a>
														</div>
													</div>
													
												</div>
											</div>	
											
											<div class="collapse-inner-box mrb-2">
												<div class="row">
													<div class="col-md-1 col-xs-3 col-sm-1">
														<div class="collapse-img">
															<img src="/public/uploads/profile_pic/index.jpg" class="imgboxes" alt="">
														</div>
													</div>
													<div class="col-md-2 col-xs-8 col-sm-2">
														<div class="client-name">
															<span>Amber Morgan</span>
															<p>Last Attended: 20/09/2019</p>
														</div>
													</div>
													<div class="col-md-1 col-xs-12 col-sm-1">
														<div class="client-age">
															<span>Age: 23</span>
														</div>
													</div>
													<div class="col-md-2 col-xs-12 col-sm-2">
														<div class="client-status">
															<label>Status: </label>
															<span class="green-fonts">Inactive</span>
														</div>
													</div>
													<div class="col-md-3 col-xs-12 col-sm-3">
														<div class="client-status">
															<label>Active Memberships: </label>
															<span class="black-fonts">0</span>
														</div>
													</div>
													<div class="col-md-2 col-xs-12 col-sm-2">
														<div class="client-status">
															<label>Expiring Soon: </label>
															<span class="red-fonts">1</span>
														</div>
													</div>
													<div class="col-md-1 col-xs-12 col-sm-1">
														<div class="client-status">
															<a href="">View</a>
														</div>
													</div>
													
												</div>
											</div>
											
											<div class="collapse-inner-box mrb-2">
												<div class="row">
													<div class="col-md-1 col-xs-3 col-sm-1">
														<div class="collapse-img">
															<img src="/public/uploads/profile_pic/index.jpg" class="imgboxes" alt="">
														</div>
													</div>
													<div class="col-md-2 col-xs-8 col-sm-2">
														<div class="client-name">
															<span>Allan Norris</span>
															<p>Last Attended: 20/09/2019</p>
														</div>
													</div>
													<div class="col-md-1 col-xs-12 col-sm-1">
														<div class="client-age">
															<span>Age: 45</span>
														</div>
													</div>
													<div class="col-md-2 col-xs-12 col-sm-2">
														<div class="client-status">
															<label>Status: </label>
															<span class="green-fonts">Active</span>
														</div>
													</div>
													<div class="col-md-3 col-xs-12 col-sm-3">
														<div class="client-status">
															<label>Active Memberships: </label>
															<span class="green-fonts">1</span>
														</div>
													</div>
													<div class="col-md-2 col-xs-12 col-sm-2">
														<div class="client-status">
															<label>Expiring Soon: </label>
															<span class="red-fonts">1</span>
														</div>
													</div>
													<div class="col-md-1 col-xs-12 col-sm-1">
														<div class="client-status">
															<a href="">View</a>
														</div>
													</div>
													
												</div>
											</div>
											
											<div class="collapse-inner-box mrb-2">
												<div class="row">
													<div class="col-md-1 col-xs-3 col-sm-1">
														<div class="collapse-img">
															<img src="/public/uploads/profile_pic/index.jpg" class="imgboxes" alt="">
														</div>
													</div>
													<div class="col-md-2 col-xs-8 col-sm-2">
														<div class="client-name">
															<span>Ashley Wong</span>
															<p>Last Attended: 20/09/2019</p>
														</div>
													</div>
													<div class="col-md-1 col-xs-12 col-sm-1">
														<div class="client-age">
															<span>Age: 18</span>
														</div>
													</div>
													<div class="col-md-2 col-xs-12 col-sm-2">
														<div class="client-status">
															<label>Status: </label>
															<span class="green-fonts">Active</span>
														</div>
													</div>
													<div class="col-md-3 col-xs-12 col-sm-3">
														<div class="client-status">
															<label>Active Memberships: </label>
															<span class="green-fonts">3</span>
														</div>
													</div>
													<div class="col-md-2 col-xs-12 col-sm-2">
														<div class="client-status">
															<label>Expiring Soon: </label>
															<span class="red-fonts">2</span>
														</div>
													</div>
													<div class="col-md-1 col-xs-12 col-sm-1">
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
													<div class="col-md-1 col-xs-3 col-sm-1">
														<div class="collapse-img">
															<img src="/public/uploads/profile_pic/index.jpg" class="imgboxes" alt="">
														</div>
													</div>
													<div class="col-md-2 col-xs-8 col-sm-2">
														<div class="client-name">
															<span>Adam Ladd</span>
															<p>Last Attended: 20/09/2019</p>
														</div>
													</div>
													<div class="col-md-1 col-xs-12 col-sm-1">
														<div class="client-age">
															<span>Age: 32</span>
														</div>
													</div>
													<div class="col-md-2 col-xs-12 col-sm-2">
														<div class="client-status">
															<label>Status: </label>
															<span class="green-fonts">Active</span>
														</div>
													</div>
													<div class="col-md-3 col-xs-12 col-sm-3">
														<div class="client-status">
															<label>Active Memberships: </label>
															<span class="green-fonts">2</span>
														</div>
													</div>
													<div class="col-md-2 col-xs-12 col-sm-2">
														<div class="client-status">
															<label>Expiring Soon: </label>
															<span class="red-fonts">1</span>
														</div>
													</div>
													<div class="col-md-1 col-xs-12 col-sm-1">
														<div class="client-status">
															<a href="{{ route('viewcustomer') }}">View</a>
														</div>
													</div>
													
												</div>
											</div>	
											
											<div class="collapse-inner-box mrb-2">
												<div class="row">
													<div class="col-md-1 col-xs-3 col-sm-1">
														<div class="collapse-img">
															<img src="/public/uploads/profile_pic/index.jpg" class="imgboxes" alt="">
														</div>
													</div>
													<div class="col-md-2 col-xs-8 col-sm-2">
														<div class="client-name">
															<span>Allan Norris</span>
															<p>Last Attended: 20/09/2019</p>
														</div>
													</div>
													<div class="col-md-1 col-xs-12 col-sm-1">
														<div class="client-age">
															<span>Age: 45</span>
														</div>
													</div>
													<div class="col-md-2 col-xs-12 col-sm-2">
														<div class="client-status">
															<label>Status: </label>
															<span class="green-fonts">Active</span>
														</div>
													</div>
													<div class="col-md-3 col-xs-12 col-sm-3">
														<div class="client-status">
															<label>Active Memberships: </label>
															<span class="green-fonts">1</span>
														</div>
													</div>
													<div class="col-md-2 col-xs-12 col-sm-2">
														<div class="client-status">
															<label>Expiring Soon: </label>
															<span class="red-fonts">1</span>
														</div>
													</div>
													<div class="col-md-1 col-xs-12 col-sm-1">
														<div class="client-status">
															<a href="">View</a>
														</div>
													</div>
													
												</div>
											</div>
											
											<div class="collapse-inner-box mrb-2">
												<div class="row">
													<div class="col-md-1 col-xs-3 col-sm-1">
														<div class="collapse-img">
															<img src="/public/uploads/profile_pic/index.jpg" class="imgboxes" alt="">
														</div>
													</div>
													<div class="col-md-2 col-xs-8 col-sm-2">
														<div class="client-name">
															<span>Ashley Wong</span>
															<p>Last Attended: 20/09/2019</p>
														</div>
													</div>
													<div class="col-md-1 col-xs-12 col-sm-1">
														<div class="client-age">
															<span>Age: 18</span>
														</div>
													</div>
													<div class="col-md-2 col-xs-12 col-sm-2">
														<div class="client-status">
															<label>Status: </label>
															<span class="green-fonts">Active</span>
														</div>
													</div>
													<div class="col-md-3 col-xs-12 col-sm-3">
														<div class="client-status">
															<label>Active Memberships: </label>
															<span class="green-fonts">3</span>
														</div>
													</div>
													<div class="col-md-2 col-xs-12 col-sm-2">
														<div class="client-status">
															<label>Expiring Soon: </label>
															<span class="red-fonts">2</span>
														</div>
													</div>
													<div class="col-md-1 col-xs-12 col-sm-1">
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
													<div class="col-md-1 col-xs-3 col-sm-1">
														<div class="collapse-img">
															<img src="/public/uploads/profile_pic/index.jpg" class="imgboxes" alt="">
														</div>
													</div>
													<div class="col-md-2 col-xs-8 col-sm-2">
														<div class="client-name">
															<span>Adam Ladd</span>
															<p>Last Attended: 20/09/2019</p>
														</div>
													</div>
													<div class="col-md-1 col-xs-12 col-sm-1">
														<div class="client-age">
															<span>Age: 32</span>
														</div>
													</div>
													<div class="col-md-2 col-xs-12 col-sm-2">
														<div class="client-status">
															<label>Status: </label>
															<span class="green-fonts">Active</span>
														</div>
													</div>
													<div class="col-md-3 col-xs-12 col-sm-3">
														<div class="client-status">
															<label>Active Memberships: </label>
															<span class="green-fonts">2</span>
														</div>
													</div>
													<div class="col-md-2 col-xs-12 col-sm-2">
														<div class="client-status">
															<label>Expiring Soon: </label>
															<span class="red-fonts">1</span>
														</div>
													</div>
													<div class="col-md-1 col-xs-12 col-sm-1">
														<div class="client-status">
															<a href="{{ route('viewcustomer') }}">View</a>
														</div>
													</div>
													
												</div>
											</div>	
											
											<div class="collapse-inner-box mrb-2">
												<div class="row">
													<div class="col-md-1 col-xs-3 col-sm-1">
														<div class="collapse-img">
															<img src="/public/uploads/profile_pic/index.jpg" class="imgboxes" alt="">
														</div>
													</div>
													<div class="col-md-2 col-xs-8 col-sm-2">
														<div class="client-name">
															<span>Amber Morgan</span>
															<p>Last Attended: 20/09/2019</p>
														</div>
													</div>
													<div class="col-md-1 col-xs-12 col-sm-1">
														<div class="client-age">
															<span>Age: 23</span>
														</div>
													</div>
													<div class="col-md-2 col-xs-12 col-sm-2">
														<div class="client-status">
															<label>Status: </label>
															<span class="green-fonts">Inactive</span>
														</div>
													</div>
													<div class="col-md-3 col-xs-12 col-sm-3">
														<div class="client-status">
															<label>Active Memberships: </label>
															<span class="black-fonts">0</span>
														</div>
													</div>
													<div class="col-md-2 col-xs-12 col-sm-2">
														<div class="client-status">
															<label>Expiring Soon: </label>
															<span class="red-fonts">1</span>
														</div>
													</div>
													<div class="col-md-1 col-xs-12 col-sm-1">
														<div class="client-status">
															<a href="">View</a>
														</div>
													</div>
													
												</div>
											</div>
											
											<div class="collapse-inner-box mrb-2">
												<div class="row">
													<div class="col-md-1 col-xs-3 col-sm-1">
														<div class="collapse-img">
															<img src="/public/uploads/profile_pic/index.jpg" class="imgboxes" alt="">
														</div>
													</div>
													<div class="col-md-2 col-xs-8 col-sm-2">
														<div class="client-name">
															<span>Allan Norris</span>
															<p>Last Attended: 20/09/2019</p>
														</div>
													</div>
													<div class="col-md-1 col-xs-12 col-sm-1">
														<div class="client-age">
															<span>Age: 45</span>
														</div>
													</div>
													<div class="col-md-2 col-xs-12 col-sm-2">
														<div class="client-status">
															<label>Status: </label>
															<span class="green-fonts">Active</span>
														</div>
													</div>
													<div class="col-md-3 col-xs-12 col-sm-3">
														<div class="client-status">
															<label>Active Memberships: </label>
															<span class="green-fonts">1</span>
														</div>
													</div>
													<div class="col-md-2 col-xs-12 col-sm-2">
														<div class="client-status">
															<label>Expiring Soon: </label>
															<span class="red-fonts">1</span>
														</div>
													</div>
													<div class="col-md-1 col-xs-12 col-sm-1">
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
	
<!-- The Modal Add Business-->
<div class="modal fade compare-model" id="newclient">
    <div class="modal-dialog manage-customer">
        <div class="modal-content">
			<div class="modal-header" style="text-align: right;"> 
			  	<div class="closebtn">
					<button type="button" class="close close-btn-design manage-customer-close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">×</span>
					</button>
				</div>
			</div>

            <!-- Modal body -->
            <div class="modal-body body-tbm">
				<div class="row"> 
                    <div class="col-lg-6 col-xs-12 space-remover">
						<div class="manage-customer-modal-title">
							<h4>Add New Client</h4>
						</div>
						<div class="manage-customer-from">
							<form>
								<input type="text" name="firstname" id="" size="30" maxlength="80" placeholder="First Name">
								<input type="text" name="lastname" id="" size="30" maxlength="80" placeholder="Last Name">
								<input type="text" name="username" id="" size="30" maxlength="80" placeholder="Username" autocomplete="off">
								<input type="email" name="email" id="" class="myemail" size="30" placeholder="Email-Address" maxlength="80" autocomplete="off">
								<input type="text" name="contact" id="contact" size="30" maxlength="14" autocomplete="off" placeholder="Phone">
								<input type="password" name="password" id="" size="30" placeholder="Password" autocomplete="off">
								<input type="password" name="confirm_password" id="" size="30" placeholder="Confirm Password" autocomplete="off">
								<div class="row check-txt-center">
									<div class="col-md-8">
										<div class="terms-wrap wrap-sp">
											<input type="checkbox" name="b_trm1" id="b_trm1" class="form-check-input" value="1">
											<label for="b_trm1">I agree to Omnebook <a href="/terms-condition" target="_blank">Terms of Service</a> and <a href="/privacy-policy" target="_blank">Privacy Policy</a></label>
										</div>
										<button type="button" style="margin:0px;" class="signup-new" id="register_submit" >Create Account</button>
									</div>
								</div>
								
							</form>
						</div>
                    </div>
					<div class="col-lg-6 col-xs-12 space-remover manage-customer-gray-bg">
                        <div class="manage-customer-search">
							<h4>Search For Client On Omnebook</h4>
							<p>"Your client could already have a profile on Omnebook"</p>
						</div>
						<div class="row check-txt-center">
							<div class="col-md-10 col-xs-10">
								<input id="business_name" type="text" class="form-control search-modal-customer" placeholder="Your Business Name Here">
							</div>
						</div>
                    </div>
				 </div>
            </div>
        </div>
    </div>
</div>
<!-- end modal -->
</div>


<!-- Latest compiled and minified JavaScript -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<!--<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>-->
@include('layouts.footer')

@endsection