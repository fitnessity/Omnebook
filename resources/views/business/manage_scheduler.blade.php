@extends('layouts.header')
@section('content')
@include('layouts.userHeader')

<link href="{{ url('public/css/jquery-ui.css') }}" rel="stylesheet" type="text/css">

<div class="p-0 col-md-12 inner_top padding-0">
    <div class="row">
        <div class="col-md-2 col-sm-12" style="background: black;">
        	 @include('business.businessSidebar')
        </div>
		<div class="col-md-10 col-sm-12">
            <div class="container-fluid p-0">
				<div class="row">
					<div class="col-md-6 col-xs-6">
						<div class="tab-hed scheduler-txt"><span class="font-red">Activity Scheduler </span> | Manage Customers</div>
					</div>
					<div class="col-md-6 col-xs-6">
						<div class="row">
							<div class="col-md-4">
								<a href="#" class="btn-nxt manage-cus-btn" data-toggle="modal" data-target="#newclient">Add New Client</a>
							</div>
							<div class="col-md-8">
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
				<hr style="border: 3px solid black; width: 115%; margin-left: -38px; margin-top: 5px;">
			  </div>
			  <div class="container-fluid plr-0">
				<div class="row">
					<div class="col-md-3">
						 <div class="date-activity-scheduler">
                            <label for="">Date:</label>
                            <input type="text"  id="" placeholder="Search By Date" class="form-control activity-scheduler-date w-80">
                            <i class="far fa-calendar-alt"></i>
                         </div>
					</div>
					<div class="col-md-5 col-sm-12">
                        <p><b>Today Date: Thursday, December 01 , 2022 </b></p>
                    </div>
				</div>
				<div class="row">
					<div class="col-md-12">
						<div class="schedule-viewing">
							<label>Schedule Viewing Date: </label>
							<span> Monday,  November 28, 2022</span>
						</div>
						<div class="priceactivity-scheduler">
                            <select name="frm_servicesport" id="frm-servicesport" class="form-control valid">
                                 <option value=""> Show All Activities </option>
								 <optgroup label="Badminton">
									 <option>abcd test</option>
									 <option>aaa</option>
                                 </optgroup>
								 <option>Baseball</option>
								 <option>Basketball</option>
								 <option>Beach Vollyball</option>
                            </select>
                       </div>
					</div>
				</div>
				<hr style="border: 1px solid #efefef; width: 115%; margin-left: -15px; margin-top: 5px;">
				<div class="row">
					<div class="col-md-12">
						<div class="row">
							<div class="col-md-1">
								<div class="scheduler-table-title">
									<label> Time </label>
								</div>
							</div>
							<div class="col-md-1">
								<div class="scheduler-table-title">
									<label>QTY</label>
								</div>
							</div>
							<div class="col-md-1">
								<div class="scheduler-table-title">
									<label>Duration</label>
								</div>
							</div>
							<div class="col-md-3">
								<div class="scheduler-table-title">
									<label> Scheduled Activity  </label>
								</div>
							</div>
							<div class="col-md-2">
								<div class="scheduler-table-title">
									<label> Location </label>
								</div>
							</div>
							<div class="col-md-2">
								<div class="scheduler-table-title">
									<label> Instructor </label>
								</div>
							</div>
						</div>
						
						<div class="scheduler-info-box">
							<div class="row">
								<div class="col-md-1">
									<div class="timeline">
										<span> 9:00 AM </span>
										<span> 9:45 AM </span>
									</div>
								</div>
								<div class="col-md-1">	
									<div class="scheduler-qty">
										<span> 9/30 </span>
									</div>
								</div>
								<div class="col-md-1">
									<div class="scheduled-activity-info">
										<span> 45 Min. </span>
									</div>
								</div>
								<div class="col-md-3">
									<div class="scheduled-activity-info">
										<span> Adult kickboxing Class  </span>
									</div>
								</div>
								<div class="col-md-2">
									<div class="scheduled-location">
										<span> At Business </span>
									</div>
								</div>
								<div class="col-md-2">
									<div class="scheduled-location">
										<span> Darryl Phipps </span>
									</div>
								</div>
								<div class="col-md-2">
									<div class="scheduled-btns">
										<button type="button" class="btn-edit btn-sp">Edit</button>
										<button type="button" class="btn-edit">Cancle</button>
									</div>
								</div>
							</div>
						</div>
						
						<div class="scheduler-info-box">
							<div class="row">
								<div class="col-md-1">
									<div class="timeline timeline-before">
										<span> 10:00 AM </span>
										<span> 10:45 AM </span>
									</div>
								</div>
								<div class="col-md-1">	
									<div class="scheduler-qty">
										<span> 1/20 </span>
									</div>
								</div>
								<div class="col-md-1">
									<div class="scheduled-activity-info">
										<span> 45 Min. </span>
									</div>
								</div>
								<div class="col-md-3">
									<div class="scheduled-activity-info">
										<span> Brazilian Jujitsu Class </span>
									</div>
								</div>
								<div class="col-md-2">
									<div class="scheduled-location">
										<span> At Business </span>
									</div>
								</div>
								<div class="col-md-2">
									<div class="scheduled-location">
										<span> Dan Covel </span>
									</div>
								</div>
								<div class="col-md-2">
									<div class="scheduled-btns">
										<button type="button" class="btn-edit btn-sp">Edit</button>
										<button type="button" class="btn-edit">Cancle</button>
									</div>
								</div>
							</div>
						</div>
						
						<div class="scheduler-info-box">
							<div class="row">
								<div class="col-md-1">
									<div class="timeline">
										<span> 12:00 PM </span>
										<span> 1:00 PM </span>
									</div>
								</div>
								<div class="col-md-1">	
									<div class="scheduler-qty">
										<span> 10/20 </span>
									</div>
								</div>
								<div class="col-md-1">
									<div class="scheduled-activity-info">
										<span> 1 Hr. </span>
									</div>
								</div>
								<div class="col-md-3">
									<div class="scheduled-activity-info">
										<span> Adult VMA Class </span>
									</div>
								</div>
								<div class="col-md-2">
									<div class="scheduled-location">
										<span> At Business </span>
									</div>
								</div>
								<div class="col-md-2">
									<div class="scheduled-location">
										<span> Darryl Phipps </span>
									</div>
								</div>
								<div class="col-md-2">
									<div class="scheduled-btns">
										<button type="button" class="btn-edit btn-sp">Edit</button>
										<button type="button" class="btn-edit">Cancle</button>
									</div>
								</div>
							</div>
						</div>
						
						<div class="scheduler-info-box">
							<div class="row">
								<div class="col-md-1">
									<div class="timeline timeline-before">
										<span>   2:00 PM </span>
										<span>  4:00 PM </span>
									</div>
								</div>
								<div class="col-md-1">	
									<div class="scheduler-qty">
										<span> 20/40 </span>
									</div>
								</div>
								<div class="col-md-1">
									<div class="scheduled-activity-info">
										<span> 45 Min. </span>
									</div>
								</div>
								<div class="col-md-3">
									<div class="scheduled-activity-info">
										<span> Adult kickboxing Class </span>
									</div>
								</div>
								<div class="col-md-2">
									<div class="scheduled-location">
										<span> At Business </span>
									</div>
								</div>
								<div class="col-md-2">
									<div class="scheduled-location">
										<span> Darryl Phipps  </span>
									</div>
								</div>
								<div class="col-md-2">
									<div class="scheduled-btns">
										<button type="button" class="btn-edit btn-sp">Edit</button>
										<button type="button" class="btn-edit">Cancle</button>
									</div>
								</div>
							</div>
						</div>
						
					</div>
				</div>
				
				<div class="row">
					<div class="col-md-6">
						<div class="activities-details">
							<label>Total Activities Today: </label> <span> 4 </span>
							<label>Total Reservations Today:</label> <span> 50 </span>
						</div>
					</div>
					<div class="col-md-6">
						<div class="pre-next-btns">
							<button type="button" class="btn-previous btn-sp"><i class="fas fa-caret-left preday-arrow"></i>Previous Day</button>
							<button type="button" class="btn-previous">Next Day <i class="fas fa-caret-right nextday-arrow"></i></button>
						</div>
					</div>
				</div>
				
			</div>	
			
			
		</div>
	</div>

</div>

<script>
 $('.activity-scheduler-date').datepicker({
        dateFormat: "mm/dd/yy"
    })
</script>
<script src="{{ url('public/js/jquery-ui.min.js') }}"></script>
@include('layouts.footer')

@endsection