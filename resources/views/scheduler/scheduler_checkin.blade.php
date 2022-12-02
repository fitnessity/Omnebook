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
					<div class="col-md-6 col-xs-12 col-sm-12">
						<div class="tab-hed scheduler-txt"><span class="font-red">Activity Scheduler </span> | Manage Customers</div>
					</div>
					<div class="col-md-6 col-xs-12 col-sm-12">
						<div class="row">
							<div class="col-md-4 col-xs-12 col-sm-3">
								<a href="#" class="btn-nxt manage-cus-btn">Add New Client</a>
							</div>
							<div class="col-md-8 col-xs-12 col-sm-6">
								<div class="manage-search">
									<form method="get" action="/activities/">
										<input type="text" name="label" id="" placeholder="Search for client" autocomplete="off" value="">
										<button id="serchbtn"><i class="fa fa-search"></i></button>
									</form>
								</div>
							</div>
						</div>
					</div>
				</div>
				<hr style="border: 3px solid black; width: 123%; margin-left: -38px; margin-top: 5px;">
			  </div>
			  <div class="container-fluid plr-0">
				<div class="row">
					<div class="col-md-4 col-xs-12 col-sm-5">
						 <div class="scheduler-info">
                            <label>Program Name: </label><span>Adult kickboxing 101 </span>
                         </div>
						 <div class="scheduler-info">
                            <label>Date: </label><span>Wednesday, April 07 2021 </span>
                         </div>
						 <div class="scheduler-info">
                            <label>Time: </label><span>10:30 am - 11:00 am </span>
                         </div>
						 <div class="scheduler-info">
                            <label>Duration:  </label><span>30m</span>
                         </div>
						 <div class="scheduler-info">
                            <label>Spots: </label><span>3/10</span>
                         </div>
					</div>
					<div class="col-md-3 col-sm-12 col-sm-6">
                        <div class="manage-search manage-space">
							<form method="get" action="/activities/">
								<input type="text" name="label" id="" placeholder="Search for client" autocomplete="off" value="">
								<button id="serchbtn"><i class="fa fa-search"></i></button>
							</form>
						</div>
                    </div>
				</div>
				
				<hr style="border: 1px solid #efefef; width: 115%; margin-left: -15px; margin-top: 5px;">
				<div class="row">
					<div class="col-md-12">
						<div class="row mobile-scheduler">
							<div class="col-md-2">
								<div class="scheduler-table-title">
									<label>  </label>
								</div>
							</div>
							<div class="col-md-1">
								<div class="scheduler-table-title">
									<label></label>
								</div>
							</div>
							<div class="col-md-2">
								<div class="scheduler-table-title">
									<label>Client Name  </label>
								</div>
							</div>
							<div class="col-md-2">
								<div class="scheduler-table-title">
									<label> Price Title  </label>
								</div>
							</div>
							<div class="col-md-2">
								<div class="scheduler-table-title">
									<label>  Remaining   </label>
								</div>
							</div>
							<div class="col-md-1">
								<div class="scheduler-table-title">
									<label> Expiration</label>
								</div>
							</div>
						</div>
						
						<div class="scheduler-info-box">
							<div class="row">
								<div class="col-md-2 col-xs-12 col-sm-4">
									<div class="scheduler-border scheduler-label">
										<a><i class="fas fa-times"></i></a>
										<div class="checkbox-check">
											<input type="checkbox" id="vehicle1" name="vehicle1" value="Bike">
											<label for="vehicle1"> Check In</label><br>
											<input type="checkbox" id="vehicle2" name="vehicle2" value="Car">
											<label for="vehicle2"> Late Cancel</label><br>
										</div>
									</div>
								</div>
								<div class="col-md-1 col-xs-3 col-sm-4">	
									<div class="scheduler-qty">
										<span> AL </span>
									</div>
								</div>
								<div class="col-md-2 col-xs-9 col-sm-4">
									<div class="scheduled-activity-info">
										<label class="scheduler-titles">Client Name: </label> <span> Adam Ladd </span>
									</div>
								</div>
								<div class="col-md-2 col-xs-12 col-sm-4">
									<div class="scheduled-activity-info">
										<div class="price-mobileview">
											<label class="scheduler-titles">Price Title:</label>
											<select name="frm_servicesport" id="frm-servicesport" class="form-control valid price-info">
												 <option value="">1 year kickboxing (Recurring)</option>
												 <option>11</option>
												 <option>22</option>
												 <option>33</option>
											</select>
										</div>
									</div>
								</div>
								<div class="col-md-2 col-xs-12 col-sm-4">
									<div class="scheduled-location">
										<label class="scheduler-titles">Remaining: </label> <span> 99945/100000 </span>
									</div>
								</div>
								<div class="col-md-1 col-xs-12 col-sm-4">
									<div class="scheduled-location">
										<label class="scheduler-titles">Expiration: </label><span> 12/15/2022 </span>
									</div>
								</div>
								<div class="col-md-2 col-xs-12 col-sm-12">
									<div class="scheduled-btns">
										<button type="button" class="btn-edit btn-sp">Purchase</button>
										<button type="button" class="btn-edit">View Account</button>
									</div>
								</div>
							</div>
						</div>
						
						<div class="scheduler-info-box">
							<div class="row">
								<div class="col-md-2 col-xs-12 col-sm-4">
									<div class="scheduler-border scheduler-border-red scheduler-label">
										<a><i class="fas fa-times"></i></a>
										<div class="checkbox-check">
											<input type="checkbox" id="vehicle1" name="vehicle1" value="Bike">
											<label for="vehicle1"> Check In</label><br>
											<input type="checkbox" id="vehicle2" name="vehicle2" value="Car">
											<label for="vehicle2"> Late Cancel</label><br>
										</div>
									</div>
								</div>
								<div class="col-md-1 col-xs-3 col-sm-4">	
									<div class="scheduler-qty">
										<span> AM </span>
									</div>
								</div>
								<div class="col-md-2 col-xs-9 col-sm-4">
									<div class="scheduled-activity-info">
										<label class="scheduler-titles">Client Name: </label> <span> Amber Morgan </span>
									</div>
								</div>
								<div class="col-md-2 col-xs-12 col-sm-4">
									<div class="scheduled-activity-info">
										<div class="price-mobileview">
											<label class="scheduler-titles">Price Title:</label>
											<select name="frm_servicesport" id="frm-servicesport" class="form-control valid price-info">
												 <option value="">10 Pack Drop In </option>
												 <option>11</option>
												 <option>22</option>
												 <option>33</option>
											</select>
										</div>
									</div>
								</div>
								<div class="col-md-2 col-xs-12 col-sm-4">
									<div class="scheduled-location">
										<label class="scheduler-titles">Remaining: </label> <span>  4/10 </span>
									</div>
								</div>
								<div class="col-md-1 col-xs-12 col-sm-4">
									<div class="scheduled-location">
										<label class="scheduler-titles">Expiration: </label><span> 11/27/2022 </span>
									</div>
								</div>
								<div class="col-md-2 col-xs-12 col-sm-12">
									<div class="scheduled-btns">
										<button type="button" class="btn-edit btn-sp">Purchase</button>
										<button type="button" class="btn-edit">View Account</button>
									</div>
								</div>
							</div>
						</div>
						
						<div class="scheduler-info-box">
							<div class="row">
								<div class="col-md-2 col-xs-12 col-sm-4">
									<div class="scheduler-border scheduler-label">
										<a><i class="fas fa-times"></i></a>
										<div class="checkbox-check">
											<input type="checkbox" id="vehicle1" name="vehicle1" value="Bike">
											<label for="vehicle1"> Check In</label><br>
											<input type="checkbox" id="vehicle2" name="vehicle2" value="Car">
											<label for="vehicle2"> Late Cancel</label><br>
										</div>
									</div>
								</div>
								<div class="col-md-1 col-xs-3 col-sm-4">	
									<div class="scheduler-qty">
										<span> AN </span>
									</div>
								</div>
								<div class="col-md-2 col-xs-9 col-sm-4">
									<div class="scheduled-activity-info">
										<label class="scheduler-titles">Client Name: </label> <span> Allan Nolan </span>
									</div>
								</div>
								<div class="col-md-2 col-xs-12 col-sm-4">
									<div class="scheduled-activity-info">
										<div class="price-mobileview">
											<label class="scheduler-titles">Price Title:</label>
											<select name="frm_servicesport" id="frm-servicesport" class="form-control valid price-info">
												 <option value="">6 Month  Membership </option>
												 <option>11</option>
												 <option>22</option>
												 <option>33</option>
											</select>
										</div>
									</div>
								</div>
								<div class="col-md-2 col-xs-12 col-sm-4">
									<div class="scheduled-location">
										<label class="scheduler-titles">Remaining: </label> <span> 99945/100000 </span>
									</div>
								</div>
								<div class="col-md-1 col-xs-12 col-sm-4">
									<div class="scheduled-location">
										<label class="scheduler-titles">Expiration: </label><span> 12/15/2022 </span>
									</div>
								</div>
								<div class="col-md-2 col-xs-12 col-sm-12">
									<div class="scheduled-btns">
										<button type="button" class="btn-edit btn-sp">Purchase</button>
										<button type="button" class="btn-edit">View Account</button>
									</div>
								</div>
							</div>
						</div>
						
						<div class="scheduler-info-box">
							<div class="row">
								<div class="col-md-2 col-xs-12 col-sm-4">
									<div class="scheduler-border scheduler-border-red scheduler-label">
										<a><i class="fas fa-times"></i></a>
										<div class="checkbox-check">
											<input type="checkbox" id="vehicle1" name="vehicle1" value="Bike">
											<label for="vehicle1"> Check In</label><br>
											<input type="checkbox" id="vehicle2" name="vehicle2" value="Car">
											<label for="vehicle2"> Late Cancel</label><br>
										</div>
									</div>
								</div>
								<div class="col-md-1 col-xs-3 col-sm-4">	
									<div class="scheduler-qty">
										<span> AW </span>
									</div>
								</div>
								<div class="col-md-2 col-xs-9 col-sm-4">
									<div class="scheduled-activity-info">
										<label class="scheduler-titles">Client Name: </label> <span> Alex Wilson </span>
									</div>
								</div>
								<div class="col-md-2 col-xs-12 col-sm-4">
									<div class="scheduled-activity-info">
										<div class="price-mobileview">
											<label class="scheduler-titles">Price Title:</label>
											<select name="frm_servicesport" id="frm-servicesport" class="form-control valid price-info">
												 <option value="">20 Pack Drop In </option>
												 <option>11</option>
												 <option>22</option>
												 <option>33</option>
											</select>
										</div>
									</div>
								</div>
								<div class="col-md-2 col-xs-12 col-sm-4">
									<div class="scheduled-location">
										<label class="scheduler-titles">Remaining: </label> <span>  9/20  </span>
									</div>
								</div>
								<div class="col-md-1 col-xs-12 col-sm-4">
									<div class="scheduled-location">
										<label class="scheduler-titles">Expiration: </label><span> 12/15/2022 </span>
									</div>
								</div>
								<div class="col-md-2 col-xs-12 col-sm-12">
									<div class="scheduled-btns">
										<button type="button" class="btn-edit btn-sp">Purchase</button>
										<button type="button" class="btn-edit">View Account</button>
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

@include('layouts.footer')

@endsection