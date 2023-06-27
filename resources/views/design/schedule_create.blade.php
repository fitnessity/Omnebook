@inject('request', 'Illuminate\Http\Request')
@extends('layouts.business.header')

@section('content')

	@include('layouts.business.business_topbar')
	<!-- ============================================================== -->
    <!-- Start right Content here -->
    <!-- ============================================================== -->
    <div class="main-content">
		<div class="page-content">
            <div class="container-fluid">
               <div class="row">
                  <div class="col">
                     <div class="h-100">
                        <div class="row mb-3">
							<div class="col-12">
								<div class="page-heading">
									<label>Set the schedule for a private lesson</label>
								</div>
							</div>
                            <!--end col-->
						</div>
                        <!--end row-->
						<div class="row">
							<div class="col-xl-12">
								<div class="card">
									<div class="card-body">
										<div class="live-preview">
											<div class="accordion custom-accordionwithicon accordion-border-box" id="accordionnesting">
												<div class="accordion-item shadow">
													<h2 class="accordion-header" id="accordionnestingExample1">
														<button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#accor_nestingExamplecollapse1" aria-expanded="true" aria-controls="accor_nestingExamplecollapse1">
															Schedule your program
														</button>
													</h2>
													<div id="accor_nestingExamplecollapse1" class="accordion-collapse collapse show" aria-labelledby="accordionnestingExample1" data-bs-parent="#accordionnesting">
														<div class="accordion-body">
															<div class="row">
																<div class="col-md-12">
																	<div class="step-four">
																		<p class="step-four-highlight">Your Setting the schedule for Private Lessons 30 Min. (1 Person) under the program name Bucephalus Riding and Polo Club1.</p>
																		<p>Get started by selecting the dates and times this activity will happen</p>
																		<p>You can schedule one or more time slots per day for this category.</p>
																	</div>
																</div>
																<div class="col-lg-12">
																	<form id="scheduleform" action="" method="post"> 
																		<div class="row">
																			<div class="col-lg-3 col-md-6 col-sm-6">
																				<div class="form-group mmt-10">
																					<label>Activity Starts On </label>
																					<div class="activityselect3 special-date">
																						<div class="input-group">
																							<input type="text" class="form-control border-0 dash-filter-picker shadow flatpickr-range flatpiker-with-border" data-range-date="false" data-date-format="d M, Y" data-deafult-date="01 Jan 2022 to 31 Jan 2022">
																						</div>
																					</div>
																					<div id="errdate"></div>
																				</div>
																			</div>

																			<div class="col-lg-3 col-md-6 col-sm-6">
																				<div class="form-group mmt-10">
																					<label>Activity Meets</label>
																					<select class="form-select" name="frm_class_meets" id="frm_class_meets">
																						<option selected="" value="Weekly">Weekly</option>
																						<option value="On a specific day">On a specific day</option>
																					</select>
																				</div>
																			</div>

																			<div class="col-lg-3 col-md-6 col-sm-6">
																				<div class="form-group mmt-10 imt-10">
																					<label class="schedule-title">Scheduled Until</label>
																					<input class="days-input" type="text" name="scheduled" id="scheduled" placeholder="4" value="1">
																					<select class="form-select week-section" name="until" id="until">
																						<option value="days">  Day(s) </option>
																						<option value="week">Week(s)</option><option value="month" selected="">Month(s) </option>
																						<option value="years">Year(s)</option>
																					</select>
																				</div>
																				<div id="errschedule"></div>
																			</div>
																		</div>
																	</form>
																</div>
															</div>
															<div class="accordion nesting2-accordion custom-accordionwithicon accordion-border-box mt-3" id="accordionnesting2">
																<div class="accordion-item shadow">
																	<h2 class="accordion-header" id="accordionnesting2Example1">
																		<button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#accor_nesting2Examplecollapse1" aria-expanded="true" aria-controls="accor_nesting2Examplecollapse1">
																			Time Select
																		</button>
																	</h2>
																	<div id="accor_nesting2Examplecollapse1" class="accordion-collapse collapse show" aria-labelledby="accordionnesting2Example1" data-bs-parent="#accordionnesting2">
																		<div class="accordion-body">
																			<div id="day-circle">
																				<div id="dayduration0">
																					<div class="col-md-12">
																						<i class="float-right ri-delete-bin-fill align-bottom me-2 text-muted"  title="Remove activity"></i>
																					</div>
																					<div class="daycircle" id="editscheduler">
																						<input type="hidden" name="id[]" id="id" value="1139">
																						<input type="hidden" name="activity_days[]" id="activity_days" class="activity_days" value="Monday,Tuesday,Wednesday,Thursday,Friday,Saturday,Sunday," width="800">
																						<div class="weekdays">
																							<div class="col-md-12">
																								<div class="display-line">
																									<div data-day="Monday" class="col-sm-1 timezone-round day_circle Monday dys day_circle_fill">
																										<p>Mo</p>
																									</div>
																									<div data-day="Tuesday" class="col-sm-1 timezone-round day_circle Tuesday dys day_circle_fill">
																										<p>Tu</p>
																									</div>
																									<div data-day="Wednesday" class="col-sm-1 timezone-round day_circle Wednesday dys day_circle_fill">
																										<p>We</p>
																									</div>
																									<div data-day="Thursday" class="col-sm-1 timezone-round day_circle Thursday dys day_circle_fill">
																										<p>Th</p>
																									</div>
																									<div data-day="Friday" class="col-sm-1 timezone-round day_circle Friday dys day_circle_fill">
																										<p>Fr</p>
																									</div>
																								
																									<div data-day="Saturday" class="col-sm-1 timezone-round day_circle Saturday dys day_circle_fill">
																										<p>Sa</p>
																									</div>
																									<div data-day="Sunday" class="col-sm-1 timezone-round day_circle Sunday dys day_circle_fill">
																										<p>Su</p>
																									</div>
																								</div>
																							</div>
																						</div>
																						<div class="row">
																							<div class="col-lg-3 col-md-5 col-sm-5">
																								<div class="form-group mmt-10">
																									<label>Start Time</label>
																									 <select name="shift_start[]" id="shift_start" class="shift_start form-select" required="required">
																									 <option value="">Select Time</option>
																									 <option selected="" value="00:00">12:00 AM</option>
																									 <option value="00:15">12:15 AM</option>
																									 <option value="00:30">12:30 AM</option>
																									 <option value="00:45">12:45 AM</option>
																									 <option value="01:00">01:00 AM</option>
																									 <option value="01:15">01:15 AM</option>
																									 <option value="01:30">01:30 AM</option>
																									 <option value="01:45">01:45 AM</option>
																									 <option value="02:00">02:00 AM</option>
																									 <option value="02:15">02:15 AM</option>
																									 <option value="02:30">02:30 AM</option>
																									 <option value="02:45">02:45 AM</option>
																									 <option value="03:00">03:00 AM</option>
																									 <option value="03:15">03:15 AM</option>
																									 <option value="03:30">03:30 AM</option>
																									 <option value="03:45">03:45 AM</option>
																									 <option value="04:00">04:00 AM</option>
																									 <option value="04:15">04:15 AM</option>
																									 <option value="04:30">04:30 AM</option>
																									 <option value="04:45">04:45 AM</option>
																									 <option value="05:00">05:00 AM</option>
																									 <option value="05:15">05:15 AM</option>
																									 <option value="05:30">05:30 AM</option>
																									 <option value="05:45">05:45 AM</option>
																									 <option value="06:00">06:00 AM</option>
																									 <option value="06:15">06:15 AM</option>
																									 <option value="06:30">06:30 AM</option>
																									 <option value="06:45">06:45 AM</option>
																									 <option value="07:00">07:00 AM</option>
																									 <option value="07:15">07:15 AM</option>
																									 <option value="07:30">07:30 AM</option>
																									 <option value="07:45">07:45 AM</option>
																									 <option value="08:00">08:00 AM</option>
																									 <option value="08:15">08:15 AM</option>
																									 <option value="08:30">08:30 AM</option>
																									 <option value="08:45">08:45 AM</option>
																									 <option value="09:00">09:00 AM</option>
																									 <option value="09:15">09:15 AM</option>
																									 <option value="09:30">09:30 AM</option>
																									 <option value="09:45">09:45 AM</option>
																									 <option value="10:00">10:00 AM</option>
																									 <option value="10:15">10:15 AM</option>
																									 <option value="10:30">10:30 AM</option>
																									 <option value="10:45">10:45 AM</option>
																									 <option value="11:00">11:00 AM</option>
																									 <option value="11:15">11:15 AM</option>
																									 <option value="11:30">11:30 AM</option>
																									 <option value="11:45">11:45 AM</option>
																									 <option value="12:00">12:00 PM</option>
																									 <option value="12:15">12:15 PM</option>
																									 <option value="12:30">12:30 PM</option>
																									 <option value="12:45">12:45 PM</option>
																									 <option value="13:00">01:00 PM</option>
																									 <option value="13:15">01:15 PM</option>
																									 <option value="13:30">01:30 PM</option>
																									 <option value="13:45">01:45 PM</option>
																									 <option value="14:00">02:00 PM</option>
																									 <option value="14:15">02:15 PM</option>
																									 <option value="14:30">02:30 PM</option>
																									 <option value="14:45">02:45 PM</option>
																									 <option value="15:00">03:00 PM</option>
																									 <option value="15:15">03:15 PM</option>
																									 <option value="15:30">03:30 PM</option>
																									 <option value="15:45">03:45 PM</option>
																									 <option value="16:00">04:00 PM</option>
																									 <option value="16:15">04:15 PM</option>
																									 <option value="16:30">04:30 PM</option>
																									 <option value="16:45">04:45 PM</option>
																									 <option value="17:00">05:00 PM</option>
																									 <option value="17:15">05:15 PM</option>
																									 <option value="17:30">05:30 PM</option>
																									 <option value="17:45">05:45 PM</option>
																									 <option value="18:00">06:00 PM</option>
																									 <option value="18:15">06:15 PM</option>
																									 <option value="18:30">06:30 PM</option>
																									 <option value="18:45">06:45 PM</option>
																									 <option value="19:00">07:00 PM</option>
																									 <option value="19:15">07:15 PM</option>
																									 <option value="19:30">07:30 PM</option>
																									 <option value="19:45">07:45 PM</option>
																									 <option value="20:00">08:00 PM</option>
																									 <option value="20:15">08:15 PM</option>
																									 <option value="20:30">08:30 PM</option>
																									 <option value="20:45">08:45 PM</option>
																									 <option value="21:00">09:00 PM</option>
																									 <option value="21:15">09:15 PM</option>
																									 <option value="21:30">09:30 PM</option>
																									 <option value="21:45">09:45 PM</option>
																									 <option value="22:00">10:00 PM</option>
																									 <option value="22:15">10:15 PM</option>
																									 <option value="22:30">10:30 PM</option>
																									 <option value="22:45">10:45 PM</option>
																									 <option value="23:00">11:00 PM</option>
																									 <option value="23:15">11:15 PM</option>
																									 <option value="23:30">11:30 PM</option>
																									</select>
																								</div>
																							</div>

																							<div class="col-lg-1 col-md-2 col-sm-2">
																								<div class="weekly-time-estimate">
																									<label>To</label>
																								</div>
																							</div>

																							<div class="col-lg-3 col-md-5 col-sm-5">
																								<div class="form-group mmt-10">
																									<label>End Time</label>
																									 <select name="shift_end[]" id="shift_end" class="shift_end form-select" required="required">
																									 <option value="">Select Time</option>
																									 <option value="00:00">12:00 AM</option>
																									 <option selected="" value="00:15">12:15 AM</option>
																									 <option value="00:30">12:30 AM</option>
																									 <option value="00:45">12:45 AM</option>
																									 <option value="01:00">01:00 AM</option>
																									 <option value="01:15">01:15 AM</option>
																									 <option value="01:30">01:30 AM</option>
																									 <option value="01:45">01:45 AM</option>
																									 <option value="02:00">02:00 AM</option>
																									 <option value="02:15">02:15 AM</option>
																									 <option value="02:30">02:30 AM</option>
																									 <option value="02:45">02:45 AM</option>
																									 <option value="03:00">03:00 AM</option>
																									 <option value="03:15">03:15 AM</option>
																									 <option value="03:30">03:30 AM</option>
																									 <option value="03:45">03:45 AM</option>
																									 <option value="04:00">04:00 AM</option>
																									 <option value="04:15">04:15 AM</option>
																									 <option value="04:30">04:30 AM</option>
																									 <option value="04:45">04:45 AM</option>
																									 <option value="05:00">05:00 AM</option>
																									 <option value="05:15">05:15 AM</option>
																									 <option value="05:30">05:30 AM</option>
																									 <option value="05:45">05:45 AM</option>
																									 <option value="06:00">06:00 AM</option>
																									 <option value="06:15">06:15 AM</option>
																									 <option value="06:30">06:30 AM</option>
																									 <option value="06:45">06:45 AM</option>
																									 <option value="07:00">07:00 AM</option>
																									 <option value="07:15">07:15 AM</option>
																									 <option value="07:30">07:30 AM</option>
																									 <option value="07:45">07:45 AM</option>
																									 <option value="08:00">08:00 AM</option>
																									 <option value="08:15">08:15 AM</option>
																									 <option value="08:30">08:30 AM</option>
																									 <option value="08:45">08:45 AM</option>
																									 <option value="09:00">09:00 AM</option>
																									 <option value="09:15">09:15 AM</option>
																									 <option value="09:30">09:30 AM</option>
																									 <option value="09:45">09:45 AM</option>
																									 <option value="10:00">10:00 AM</option>
																									 <option value="10:15">10:15 AM</option>
																									 <option value="10:30">10:30 AM</option>
																									 <option value="10:45">10:45 AM</option>
																									 <option value="11:00">11:00 AM</option>
																									 <option value="11:15">11:15 AM</option>
																									 <option value="11:30">11:30 AM</option>
																									 <option value="11:45">11:45 AM</option>
																									 <option value="12:00">12:00 PM</option>
																									 <option value="12:15">12:15 PM</option>
																									 <option value="12:30">12:30 PM</option>
																									 <option value="12:45">12:45 PM</option>
																									 <option value="13:00">01:00 PM</option>
																									 <option value="13:15">01:15 PM</option>
																									 <option value="13:30">01:30 PM</option>
																									 <option value="13:45">01:45 PM</option>
																									 <option value="14:00">02:00 PM</option>
																									 <option value="14:15">02:15 PM</option>
																									 <option value="14:30">02:30 PM</option>
																									 <option value="14:45">02:45 PM</option>
																									 <option value="15:00">03:00 PM</option>
																									 <option value="15:15">03:15 PM</option>
																									 <option value="15:30">03:30 PM</option>
																									 <option value="15:45">03:45 PM</option>
																									 <option value="16:00">04:00 PM</option>
																									 <option value="16:15">04:15 PM</option>
																									 <option value="16:30">04:30 PM</option>
																									 <option value="16:45">04:45 PM</option>
																									 <option value="17:00">05:00 PM</option>
																									 <option value="17:15">05:15 PM</option>
																									 <option value="17:30">05:30 PM</option>
																									 <option value="17:45">05:45 PM</option>
																									 <option value="18:00">06:00 PM</option>
																									 <option value="18:15">06:15 PM</option>
																									 <option value="18:30">06:30 PM</option>
																									 <option value="18:45">06:45 PM</option>
																									 <option value="19:00">07:00 PM</option>
																									 <option value="19:15">07:15 PM</option>
																									 <option value="19:30">07:30 PM</option>
																									 <option value="19:45">07:45 PM</option>
																									 <option value="20:00">08:00 PM</option>
																									 <option value="20:15">08:15 PM</option>
																									 <option value="20:30">08:30 PM</option>
																									 <option value="20:45">08:45 PM</option>
																									 <option value="21:00">09:00 PM</option>
																									 <option value="21:15">09:15 PM</option>
																									 <option value="21:30">09:30 PM</option>
																									 <option value="21:45">09:45 PM</option>
																									 <option value="22:00">10:00 PM</option>
																									 <option value="22:15">10:15 PM</option>
																									 <option value="22:30">10:30 PM</option>
																									 <option value="22:45">10:45 PM</option>
																									 <option value="23:00">11:00 PM</option>
																									 <option value="23:15">11:15 PM</option>
																									 <option value="23:30">11:30 PM</option>
																									 </select>
																								</div>
																							</div>

																							<div class="col-lg-3 col-md-6 col-sm-6">
																								<label class="mmt-10 imt-10">Duration</label>
																								<div class="sp-bottom">
																									<input type="text" name="set_duration[]" id="set_duration" value="0 hour 15 minutes 0 second" readonly="" class="set_duration form-control">
																								</div>
																							</div>
																							<div class="col-lg-2 col-md-6 col-sm-6">
																								<label class="mmt-10 imt-10"># Spots Available</label>
																								<div class="sp-bottom">
																									<input type="text" class="form-control valid" name="sport_avail[]" id="sport_avail" value="10" required="required">
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
																	<h2 class="accordion-header" id="accordionnesting2Example2">
																		<button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#accor_nesting2Examplecollapse2" aria-expanded="false" aria-controls="accor_nesting2Examplecollapse2">
																			Time Select
																		</button>
																	</h2>
																	<div id="accor_nesting2Examplecollapse2" class="accordion-collapse collapse" aria-labelledby="accordionnesting2Example2" data-bs-parent="#accordionnesting2">
																		<div class="accordion-body">
																			Comming Soon
																		</div>
																	</div>
																</div>
															</div>
															<div class="row">
																<div class="col-md-6 col-8">
																	<div class="btn-ano-time mt-20">
																		<button class="btn btn-red" type="button">Add Another Time</button>
																	</div>
																</div>
																<div class="col-md-6 col-4">
																	<div class="btn-ano-time mt-20 float-right">
																		<button class="btn btn-red" type="submit">Save</button>
																	</div>
																</div>
															</div>
														</div>
													</div>
												</div>
												<div class="accordion-item shadow">
													<h2 class="accordion-header" id="accordionnestingExample2">
														<button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#accor_nestingExamplecollapse2" aria-expanded="false" aria-controls="accor_nestingExamplecollapse2">
															Your Schedule Breakdown
														</button>
													</h2>
													<div id="accor_nestingExamplecollapse2" class="accordion-collapse collapse" aria-labelledby="accordionnestingExample2" data-bs-parent="#accordionnesting">
														<div class="accordion-body">
															<div class="table-responsive table-schedule">
																<table class="schedule-breakdown" style="width:100%">
																	<thead>
																		<tr>	
																			<th>Day </th>
																			<th>Date</th>
																			<th>Time</th>
																			<th>Duration</th>
																			<th># of Spots</th>
																			<th>Location</th>
																		</tr>
																	</thead>
																	<tbody>
																		<tr>
																			<td>Monday, Tuesday, Wednesday, Thursday, Friday, Saturday, Sunday</td>
																			<td>02-20-2023 to 05-14-2023</td>
																			<td class="time-zone">12:00 am  to 12:15 am</td>
																			<td>15min.</td>
																			<td>10</td>
																			<td></td>
																		</tr>
																	</tbody>
																</table>
															</div>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div><!-- end card-body -->
								</div><!-- end card -->
							</div>
						</div><!--end row-->					
					</div> <!-- end .h-100-->
                  </div> <!-- end col -->
                </div>
            </div><!-- container-fluid -->
        </div><!-- End Page-content -->
     </div><!-- end main content-->
</div><!-- END layout-wrapper -->
    

	
	
	@include('layouts.business.footer')
	<script>
		flatpickr(".flatpickr-range", {
	        dateFormat: "m/d/Y",
	        maxDate: "01/01/2050",
			defaultDate: [new Date()],
	     });
	</script>
<script>

$("body").on("click", ".daycircle", function(){
     /* alert($("#frm_class_meets").val());*/
      if($("#frm_class_meets").val() == 'Weekly')
      {
        activity_days = "";     
        $(this).find(".weekdays").each( function() {
          $.each( $(this).find('.day_circle'), function( key, value ) {
            if ($(this).hasClass('day_circle_fill')) {         
              activity_days += value.classList[3] + ",";
            }  
          });
        });
        $(this).find('.activity_days').val(activity_days);
      }

      if($("#frm_class_meets").val() == 'On a specific day') {
        activity_days = "";
        $.each( $(this).find('.weekdays').children(".day_circle_fill"), function( key, value ) {
          activity_days += value.classList[3] + ","
        });
        $(this).find('.activity_days').val(activity_days);
      }
    });

    $("#frm_class_meets").on("change", function () {
      $('#startingpicker').val('');
      $(".daycircle").hide();
      $(".remove-week").hide();
      var day = moment($('#startingpicker').val(), 'MM-DD-YYYY').format('dddd');
      var activityMeet = $(this).val();
      $("#activity_scheduler_body").html("");
      $(".timezone-round").removeClass('day_circle_fill');
      $(".timezone-round").css('pointer-events', 'none');
      if(activityMeet == 'Weekly') {
        if(day=='Monday') {
            $(".Monday").css('pointer-events', '');
            $(".Tuesday").css('pointer-events', '');
            $(".Wednesday").css('pointer-events', '');
            $(".Thursday").css('pointer-events', '');
            $(".Friday").css('pointer-events', '');
            $(".Saturday").css('pointer-events', '');
        }
        if(day=='Tuesday') {
            $(".Tuesday").css('pointer-events', '');
            $(".Wednesday").css('pointer-events', '');
            $(".Thursday").css('pointer-events', '');
            $(".Friday").css('pointer-events', '');
            $(".Saturday").css('pointer-events', '');
        }

        if(day=='Wednesday') {
            $(".Wednesday").css('pointer-events', '');
            $(".Thursday").css('pointer-events', '');
            $(".Friday").css('pointer-events', '');
            $(".Saturday").css('pointer-events', '');
        }

        if(day=='Thursday') {
            $(".Thursday").css('pointer-events', '');
            $(".Friday").css('pointer-events', '');
            $(".Saturday").css('pointer-events', '');
        }

        if(day=='Friday') {
            $(".Friday").css('pointer-events', '');
            $(".Saturday").css('pointer-events', '');
        }

        if(day=='Saturday') {
            $(".Saturday").css('pointer-events', '');
        }

        if(day=='Sunday') {
            $(".Monday").css('pointer-events', '');
            $(".Tuesday").css('pointer-events', '');
            $(".Wednesday").css('pointer-events', '');
            $(".Thursday").css('pointer-events', '');
            $(".Friday").css('pointer-events', '');
            $(".Saturday").css('pointer-events', '');
            $(".Sunday").css('pointer-events', '');
        }
            //$(".remove-week").show();
      }

      $(".timezone-round").removeClass('day_circle_fill');
      $(".daycircle ."+day).addClass('day_circle_fill');
      $("#activity_scheduler_body").append($("#day-circle").html());
      $("#activity_scheduler_body .daycircle").show();
      $('#startingpicker').datepicker('hide');
    });

    $('#startingpicker').datepicker({
       minDate: 0   
    }).change(activitySchedule);

    function activitySchedule(event) { //alert('aaaaa'+$('#startingpicker').val());
      var d = new Date($('#startingpicker').val());
      var weekday = ["Sunday","Monday","Tuesday","Wednesday","Thursday","Friday","Saturday"];
      $(".daycircle").hide();
      $(".remove-week").hide();
      var day = weekday[d.getDay()];
      var activityMeet = $("#frm_class_meets").val();
      $("#activity_scheduler_body").html("");
      $(".timezone-round").removeClass('day_circle_fill');
      if(activityMeet == 'Weekly') {
        if(day=='Monday') {
          $(".Monday").css('pointer-events', '');
          $(".Tuesday").css('pointer-events', '');
          $(".Wednesday").css('pointer-events', '');
          $(".Thursday").css('pointer-events', '');
          $(".Friday").css('pointer-events', '');
          $(".Saturday").css('pointer-events', '');
        }

        if(day=='Tuesday') {
            $(".Tuesday").css('pointer-events', '');
            $(".Wednesday").css('pointer-events', '');
            $(".Thursday").css('pointer-events', '');
            $(".Friday").css('pointer-events', '');
            $(".Saturday").css('pointer-events', '');
        }

        if(day=='Wednesday') {
            $(".Wednesday").css('pointer-events', '');
            $(".Thursday").css('pointer-events', '');
            $(".Friday").css('pointer-events', '');
            $(".Saturday").css('pointer-events', '');
        }

        if(day=='Thursday') {
            $(".Thursday").css('pointer-events', '');
            $(".Friday").css('pointer-events', '');
            $(".Saturday").css('pointer-events', '');
        }

        if(day=='Friday') {
            $(".Friday").css('pointer-events', '');
            $(".Saturday").css('pointer-events', '');
        }

        if(day=='Saturday') {
            $(".Saturday").css('pointer-events', '');
        }

        if(day=='Sunday') {
            $(".Monday").css('pointer-events', '');
            $(".Tuesday").css('pointer-events', '');
            $(".Wednesday").css('pointer-events', '');
            $(".Thursday").css('pointer-events', '');
            $(".Friday").css('pointer-events', '');
            $(".Saturday").css('pointer-events', '');
            $(".Sunday").css('pointer-events', '');
        }

      }

      $(".timezone-round").removeClass('day_circle_fill');

      var cnt=$('#duration_cnt').val();

      if(cnt>=0){
        $("#editscheduler").hide();
        $("#dayduration0 .daycircle").show();
        $('#duration_cnt').val('0');
      }else{
        $("#activity_scheduler_body").append($("#day-circle").html());
      }
      $("#activity_scheduler_body .daycircle").show();
      $(this).datepicker('hide');
      var cnt=$('#duration_cnt').val();
      parent = document.querySelector("#dayduration"+cnt);
      shift_start = parent.querySelector('#shift_start').value='';
      shift_end = parent.querySelector('#shift_end').value='';
      set_duration = parent.querySelector('#set_duration').value='';
    }

    $('body').delegate('.timezone-round','click',function(){  

      if($('#frm_class_meets').val()=='Weekly')
      {   
        if($(this).hasClass("day_circle_fill"))
          $(this).removeClass('day_circle_fill');
        else
          $(this).addClass('day_circle_fill');
      }
    });

</script>


@endsection