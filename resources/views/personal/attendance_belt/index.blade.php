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
							<label>Attendance & Promotions</label>
						</div>
					</div>
				</div><!--end row-->
				<div class="row">
					<div class="col-xxl-12">
						<div class="card">
							<div class="card-header card-dark">
								<div class="row y-middle">	
									<div class="col-lg-8">
										<div class="attendance-title">
											<h3>Attendance History</h3>
										</div>
									</div>
									<div class="col-lg-4">
										<div class="input-group">
											<input type="text" id="attendance-date" class="form-control flatpickr-range-attendance">
											<div class="input-group-text bg-primary border-primary text-white">
												<i class="ri-calendar-2-line"></i>
											</div>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-sm-auto">
										<div class="d-grid attendance-count mt-25">
											<label>Check-Ins</label>
											<span>{{$attendanceCnt}}</span>
										</div>
									</div>
									<div class="col-sm-auto">
										<div class="d-grid attendance-count mt-25">
											<label>Years</label>
											<span>{{$totalYears}}</span>
										</div>
									</div>
									<div class="col-sm-auto">
										<div class="d-grid attendance-count mt-25">
											<label>Months</label>
											<span>{{$totalMonths}}</span>
										</div>
									</div>
									<div class="col-sm-auto">
										<div class="d-grid attendance-count mt-25">
											<label>Days</label>
											<span>{{$totalDays}}</span>
										</div>
									</div>
									<div class="col-sm-auto">
										<div class="d-grid attendance-count mt-25">
											<label>Hours</label>
											<span>{{$totalHours}}</span>
										</div>
									</div>
									<div class="col-sm-auto">
										<div class="d-grid attendance-count mt-25">
											<label>Minutes</label>
											<span>{{$totalMinutes}}</span>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div><!-- end col -->
					<div class="col-xl-12">
						<div class="card">
							<div class="card-header border-0 align-items-center">
								<div class="row">
									<div class="col-lg-6 col-sm-6">
										<h4 class="card-title mb-0 flex-grow-1">Attendance</h4>
									</div>
									<div class="col-lg-6 col-sm-6">
										<div class="text-right mmb-10">
											<button type="button" class="btn btn-soft-secondary btn-sm shadow-none" onClick="filterGraph('day')">Day</button>
											<button type="button" class="btn btn-soft-secondary btn-sm shadow-none" onClick="filterGraph('week')">Week</button>
											<button type="button" class="btn btn-soft-secondary btn-sm shadow-none" onClick="filterGraph('month')">Month</button>
											<button type="button" class="btn btn-soft-secondary btn-sm shadow-none" onClick="filterGraph('year')">Year</button>
										</div>
									</div>
								</div>
							</div><!-- end card header -->

							<div class="card-body p-0 pb-2">
								<div class="w-100" id="graphDiv">
									@include('personal.attendance_belt.graph',['graphData' =>$graphData, 'categoryData' =>$categoryData])
								</div>
							</div><!-- end card body -->
						</div><!-- end card -->
					</div><!-- end col -->	
					<div class="col-xxl-12">
						<div class="card">	
							<div class="card-header align-items-center d-flex card-dark">
								<h4 class="card-title mb-0 flex-grow-1">Ranks</h4>
							</div>
							<div class="card-body">
								<div class="row y-middle">
									<label>Tracking Promotions Coming Soon</label>
									<!-- <div class="col-lg-5 col-sm-5 col-12">
										<div>
											<label>Martial Arts Schools</label>
										</div>
									</div>
									<div class="col-lg-5 col-sm-5 col-12">
										<div class="d-flex mmb-10">
											 <input type="color" class="form-control form-control-color w-50 mr-10" id="colorPicker" value="#f06548"> 
											<span class="mt-8"> Orange Belt</span>
										</div>
									</div>
									<div class="col-lg-2 col-sm-2 col-12">
										<div class="selected-date">
											<span>12/13/2023</span>
											<label>Promoted </label>
										</div>
									</div> --> 
								</div>
							</div>
						</div>
					</div>
				</div>
			</div><!-- container-fluid -->
		</div>
	</div><!-- end main content-->
	
</div><!-- END layout-wrapper -->

@include('layouts.business.footer')
@include('layouts.business.scripts')
<script type="text/javascript">
	
	function filterGraph(type){
		$.ajax({
			url: "{{route('personal.attendance-belt.create')}}",
			type:'GET',
			data:{
				type:type,
				id:'{{$id}}'
			},
			success:function(response){
				$('#graphDiv').html(response);
			},
		});
	}

	$(document).ready(function() {
		var stDate = '{{$stDateCal}}';
	    var edDate = '{{$endateCal}}';
	    
		flatpickr(".flatpickr-range-attendance", {
	        altInput: true,
	        mode:  "range",
	        altFormat: "m/d/Y",
	        dateFormat: "Y-m-d",
	        maxDate: "2050-01-01",
	        defaultDate: [stDate, edDate],
	        onChange: function(selectedDates, dateStr, instance) {
	        	url = '/personal/attendance-belt?business_id='+'{{$request->business_id}}'+'&dates='+dateStr;
	        	setTimeout(function() {
			        window.location.href = url;
			    }, 1000);
	           
	        },
		});
	});
	

</script>
@endsection