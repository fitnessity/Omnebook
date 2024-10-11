

@php
        function timeSlotOption($lbl, $val) {
            $start = "00:00"; //you can write here 00:00:00 but not need to it
            $end = "23:30";

            $tStart = strtotime($start);
            $tEnd = strtotime($end);
            $tNow = $tStart;
      
            $startpm = "00:00"; //you can write here 00:00:00 but not need to it
            $endpm = "11:30";
            echo '<select name="'.$lbl.'[]" id="'.$lbl.'" class="'.$lbl.' form-control" required="required">';
            echo '<option value="">Select Time</option>';
            while($tNow <= $tEnd){
            if($val == date("H:i",$tNow)) {
                echo '<option selected value="'.date("H:i",$tNow).'">'.date("h:i A",$tNow).'</option>';    
                } else {
                    echo '<option value="'.date("H:i",$tNow).'">'.date("h:i A",$tNow).'</option>';
                }
                $tNow = strtotime('+15 minutes',$tNow);
            }
        echo '</select>';
        }
    @endphp
<nav class="com-sidebar">
	<div class="navbar-wrapper mb-30">
		<div id="schedule_section{{$loop}}" class="com-sidepanel">
			<div class="navbar-content mb-30">
				<div class="container"> 
					<div class="row">
						<div class="col-lg-8 col-8">
							<div class="setup-title">
								<label>Set the schedule</label>
							</div>
						</div>
						<div class="col-lg-4 col-4">
							<div class="p-relative">
								<a href="javascript:void(0)" class="com-cancle fa fa-times" onClick="closeaddschedule('{{$loop}}')"></a>
							</div>
						</div>
					</div>	
				</div>
				<div class="border-bottom-grey mt-10 mb-10"></div>	
				<div class="card-body  mb-30">
					<div class="live-preview">
						<div class="accordion custom-accordionwithicon accordion-border-box mb-10" id="accordionnesting">
							<div class="accordion-item shadow">
								<h2 class="accordion-header" id="accordionnestingExample1">
									<button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#accor_nestingExamplecollapse1" aria-expanded="true" aria-controls="accor_nestingExamplecollapse1">
										Schedule your program
									</button>
								</h2>
								<div id="accor_nestingExamplecollapse1" class="accordion-collapse collapse show" aria-labelledby="accordionnestingExample1" data-bs-parent="#accordionnesting">
									<div class="accordion-body">
										<form id="scheduleform" action="{{route('business.schedulers.store')}}" method="post">
											@csrf 
											<input type="hidden" name="returnUrl" value="{{$returnUrl}}">   
											<input type="hidden" name="categoryId" value="{{$category->id}}">   
								        	<input type="hidden" name="cId" value="{{$category->cid}}">   
								        	<input type="hidden" name="serviceId" value="{{$category->serviceid}}">  
								        	@php
								        		$schedule = @$businessActivity[0]['scheduled_day_or_week_num'];
								        		$starting = @$businessActivity[0]['starting'] != '' ? date('m/d/Y',strtotime(@$businessActivity[0]['starting'])) : date('m/d/Y'); 
												$act_met = @$businessActivity[0]['activity_meets'];
												$act_until = @$businessActivity[0]['scheduled_day_or_week']; 
								        	@endphp
											<div class="row">
												<div class="col-md-12">
													<div class="step-four">
														<p class="step-four-highlight">Your Setting the schedule for {{$category->category_title}}  under the program name {{$category->BusinessServices->program_name}}.</p>
														<p>Get started by selecting the dates and times this activity will happen</p>
														<p>You can schedule one or more time slots per day for this category.</p>
													</div>
												</div>
												<div class="col-lg-12">
													<div class="row">
														<div class="col-lg-6 col-md-6 col-sm-6">
															<div class="form-group mmt-10 mb-15">
																<label>Activity Starts On </label>
																<div class="activityselect3 special-date">
																	<div class="input-group">
																		<input type="text" class="form-control border-0 dash-filter-picker shadow flatpickr flatpiker-with-border" value="{{$starting}}" name="starting">
																	</div>
																</div>
																<div id="errdate"></div>
															</div>
														</div>

														<div class="col-lg-6 col-md-6 col-sm-6">
															<div class="form-group mmt-10 mb-15">
																<label>Activity Meets</label>
																<select class="form-select" name="frm_class_meets" id="frm_class_meets">
																	<option value="Weekly" {{$act_met=='Weekly' ? "selected":""}}  >Weekly</option>
																	<option value="On a specific day" {{$act_met=='On a specific day' ? "selected":""}} >On a specific day</option>
																</select>
															</div>
														</div>

														<div class="col-lg-6 col-md-6 col-sm-6">
															<div class="form-group mmt-10 imt-10 mb-15">
																<label class="schedule-title">Scheduled Until</label>
																<input class="days-input" type="text" name="scheduled" id="scheduled" placeholder="4"  value="{{$schedule != ''? $schedule : 1 }}">
																<select class="form-select week-section" name="until" id="until">
																	<option value="days" {{$act_until=='days' ? "selected" : "" }}>  Day(s) </option>
																	<option value="week" {{$act_until=='week' ? "selected" : "" }}>Week(s)</option>
																	<option value="month" {{$act_until=='month' ? "selected" : "" }}>Month(s) </option>
																	<option value="years" {{$act_until=='years' ? "selected" : "" }}>Year(s)</option>
																</select>
															</div>
															<div id="errschedule"></div>
														</div>
													</div>
												</div>
											</div>

											@if(isset($businessActivity) && count($businessActivity) > 0) 
												<input type="hidden"  name="duration_cnt" id="duration_cnt" value="{{ count($businessActivity)-1 }}"> 
												@foreach($businessActivity as $i=>$schedule)
												<div id="dayduration{{$i}}">
													<div class="accordion nesting2-accordion custom-accordionwithicon accordion-border-box mt-3" id="accordionnestingin{{$i}}">
														<div class="accordion-item shadow">
															<h2 class="accordion-header" id="accordionnestinginExample{{$i}}">
																<button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#accor_nestinginExamplecollapse{{$i}}" aria-expanded="true" aria-controls="accor_nestinginExamplecollapse{{$i}}">
																	Time Select
																</button>
															</h2>
															<div id="accor_nestinginExamplecollapse{{$i}}" class="accordion-collapse collapse show" aria-labelledby="accordionnestinginExample{{$i}}" data-bs-parent="#accordionnestingin{{$i}}">
																<div class="accordion-body">
																	<div id="day-circle">
																		<div class="col-md-12" id="deleteschedule{{$i}}" @if($i == 0) style="display: none;" @endif onclick="removeschedule({{$i}});">
																			<i class="float-right ri-delete-bin-fill align-bottom me-2 text-muted"  title="Remove activity"></i>
																		</div>
																		<div class="daycircle" id="editscheduler">
																			<input type="hidden" name="id[]" id="id" value="{{$schedule->id}}">
																			<input type="hidden" name="activity_days[]" id="activity_days" class="activity_days" value="{{$schedule->activity_days}}" width="800">
																			<div class="weekdays">
																				<div class="col-md-12">
																					<div class="display-line">
																						<div data-day="Monday" class="col-sm-1 timezone-round day_circle Monday dys {{str_contains($schedule
																						->activity_days, 'Monday') ? 'day_circle_fill' : '' }}">
																							<p>Mo</p>
																						</div>
																						<div data-day="Tuesday" class="col-sm-1 timezone-round day_circle Tuesday dys {{str_contains($schedule
																						->activity_days, 'Tuesday') ? 'day_circle_fill' : '' }}">
																							<p>Tu</p>
																						</div>
																						<div data-day="Wednesday" class="col-sm-1 timezone-round day_circle Wednesday dys {{str_contains($schedule
																						->activity_days, 'Wednesday') ? 'day_circle_fill' : '' }}">
																							<p>We</p>
																						</div>
																						<div data-day="Thursday" class="col-sm-1 timezone-round day_circle Thursday dys {{str_contains($schedule
																						->activity_days, 'Thursday') ? 'day_circle_fill' : '' }}">
																							<p>Th</p>
																						</div>
																						<div data-day="Friday" class="col-sm-1 timezone-round day_circle Friday dys {{str_contains($schedule
																						->activity_days, 'Friday') ? 'day_circle_fill' : '' }}">
																							<p>Fr</p>
																						</div>
																					
																						<div data-day="Saturday" class="col-sm-1 timezone-round day_circle Saturday dys {{str_contains($schedule
																						->activity_days, 'Saturday') ? 'day_circle_fill' : '' }}">
																							<p>Sa</p>
																						</div>
																						<div data-day="Sunday" class="col-sm-1 timezone-round day_circle Sunday dys {{str_contains($schedule
																						->activity_days, 'Sunday') ? 'day_circle_fill' : '' }}">
																							<p>Su</p>
																						</div>
																					</div>
																				</div>
																			</div>
																			<div class="row">
																				<div class="col-lg-4 col-md-5 col-sm-5">
																					<div class="form-group mmt-10 mb-15">
																						<label>Start Time</label>{{timeSlotOption('shift_start',$schedule->shift_start)}}
																					</div>
																				</div>

																				<div class="col-lg-4 col-md-2 col-sm-2">
																					<div class="weekly-time-estimate">
																						<label>To</label>
																					</div>
																				</div>

																				<div class="col-lg-4 col-md-2 col-sm-2">
																					<div class="form-group mmt-10 mb-15">
																						<label>End Time</label>
																						{{timeSlotOption('shift_end', $schedule->shift_end)}}
																					</div>
																				</div>

																				<div class="col-lg-4 col-md-6 col-sm-6">
																					<label class="mmt-10 imt-10">Duration</label>
																					<div class="sp-bottom">
																						<input type="text" name="set_duration[]" id="set_duration" value="{{ $schedule->set_duration}}" readonly="" class="set_duration form-control">
																					</div>
																				</div>
																				<div class="col-lg-4 col-md-6 col-sm-6">
																					<label class="mmt-10 imt-10"># Spots Available</label>
																					<div class="sp-bottom">
																						<input type="text" class="form-control valid" name="sport_avail[]" id="sport_avail" value="{{ $schedule->spots_available}}" required="required">
																					</div>
																				</div>
																				<div class="col-lg-12 col-md-6 col-sm-6">
																					<div class="priceselect sp-select mt-10">
							                                                           <label>Choose Instructure</label>
																					   <!-- <div class="priceselect sp-select">
																							<label>Select Service Type</label>
																							<div id="individualstype" style="">
																								<select name="serviceTypes[]" id="serviceTypes1" multiple>
																									<option value="Personal Training">Personal Training</option>
																									<option value="Coaching">Coachingindividual</option>
																									<option value="Therapy">Therapy</option>
																									<option value="Event">Event </option>
																									<option value="Seminar">Seminar </option>
																								</select>
																							</div>
                                                                        				</div>
																						<script>
																							var serviceTypes1 = new SlimSelect({
																								select: '#serviceTypes1'
																							});
																							GetData['service_typetwo'] = serviceTypes1.selected();
																						</script> -->

							                                                           <input type="hidden" name="instructure[{{ $i }}]" value="">
							                                                           <select name="instructure[{{$i}}][]" id="instructure{{$i}}" multiple >
							                                                              @foreach($staffData as $data)
							                                                              <option value="{{$data->id}}"> {{$data->first_name}} {{$data->last_name}} </option>
							                                                           @endforeach
							                                                           </select>
							                                                           
							                                                           <script id="slimSelectScript{{$i}}">
																							new SlimSelect({
																						      select: '#instructure{{$i}}'
																						   });

																						    instructure{{$i}}  = '{{ @$schedule->instructure_ids }}';
																							insIds{{$i}}  = instructure{{$i}} ? instructure{{$i}}.split(',') : [];

																							s{{$i}}  = new SlimSelect({
																							   select: '#instructure{{$i}}'
																							});
																							s{{$i}}.set(insIds{{$i}});
																						   
																						</script>
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
												@endforeach
											@else
												<input type="hidden"  name="duration_cnt" id="duration_cnt" value="0"> 
												<div id="dayduration0">
													<div class="accordion nesting2-accordion custom-accordionwithicon accordion-border-box mt-3" id="accordionnestingin0">
														<div class="accordion-item shadow">
															<h2 class="accordion-header" id="accordionnestinginExample0">
																<button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#accor_nestinginExamplecollapse0" aria-expanded="true" aria-controls="accor_nestinginExamplecollapse0">
																	Time Select
																</button>
															</h2>
															<div id="accor_nestinginExamplecollapse0" class="accordion-collapse collapse show" aria-labelledby="accordionnestinginExample0" data-bs-parent="#accordionnestingin0">
																<div class="accordion-body">
																	<div id="day-circle">
																		<div class="col-md-12" id="deleteschedule0" style="display: none;" onclick="removeschedule(0);">
																			<i class="float-right ri-delete-bin-fill align-bottom me-2 text-muted"  title="Remove activity"></i>
																		</div>
																		<div class="daycircle" id="editscheduler">
																			<input type="hidden" name="id[]" id="id" value="">
																			<input type="hidden" name="activity_days[]" id="activity_days" class="activity_days" value="" width="800">
																			<div class="weekdays">
																				<div class="col-md-12">
																					<div class="display-line">
																						<div data-day="Monday" class="col-sm-1 timezone-round day_circle Monday dys">
																							<p>Mo</p>
																						</div>
																						<div data-day="Tuesday" class="col-sm-1 timezone-round day_circle Tuesday dys">
																							<p>Tu</p>
																						</div>
																						<div data-day="Wednesday" class="col-sm-1 timezone-round day_circle Wednesday dys ">
																							<p>We</p>
																						</div>
																						<div data-day="Thursday" class="col-sm-1 timezone-round day_circle Thursday dys">
																							<p>Th</p>
																						</div>
																						<div data-day="Friday" class="col-sm-1 timezone-round day_circle Friday dys">
																							<p>Fr</p>
																						</div>
																					
																						<div data-day="Saturday" class="col-sm-1 timezone-round day_circle Saturday dys">
																							<p>Sa</p>
																						</div>
																						<div data-day="Sunday" class="col-sm-1 timezone-round day_circle Sunday dys">
																							<p>Su</p>
																						</div>
																					</div>
																				</div>
																			</div>
																			<div class="row">
																				<div class="col-lg-4 col-md-5 col-sm-5">
																					<div class="form-group mmt-10">
																						<label>Start Time</label>{{timeSlotOption('shift_start','')}}
																					</div>
																				</div>

																				<div class="col-lg-4 col-md-2 col-sm-2">
																					<div class="weekly-time-estimate">
																						<label>To</label>
																					</div>
																				</div>

																				<div class="col-lg-4 col-md-2 col-sm-2">
																					<div class="form-group mmt-10">
																						<label>End Time</label>
																						{{timeSlotOption('shift_end', '')}}
																					</div>
																				</div>

																				<div class="col-lg-4 col-md-6 col-sm-6">
																					<label class="mmt-10 imt-10">Duration</label>
																					<div class="sp-bottom">
																						<input type="text" name="set_duration[]" id="set_duration" value="" readonly="" class="set_duration form-control">
																					</div>
																				</div>
																				<div class="col-lg-4 col-md-6 col-sm-6">
																					<label class="mmt-10 imt-10"># Spots Available</label>
																					<div class="sp-bottom">
																						<input type="text" class="form-control valid" name="sport_avail[]" id="sport_avail" value="1" required="required">
																					</div>
																				</div>

																				<div class="col-lg-12 col-md-6 col-sm-6">
							                                                        <div class="priceselect sp-select mt-10">
							                                                           <label>Choose Instructure</label>
							                                                           <input type="hidden" name="instructure[0]" value="">
							                                                           <select name="instructure[0][]" id="instructure0" multiple >
							                                                              @foreach($staffData as $data)
							                                                              <option value="{{$data->id}}" @if(@$service->instructor_id == $data->id) selected @endif> {{$data->first_name}} {{$data->last_name}} </option>
							                                                           @endforeach
							                                                           </select>
							                                                        </div>

							                                                        <script id="slimSelectScript0">
																						new SlimSelect({
																					      select: '#instructure0'
																					   });
																					</script>
							                                                     </div>
																			</div>
																		</div>
																	</div>
																</div>
															</div>
														</div>
													</div>
												</div>
											@endif

											<div id="activity_scheduler_body"></div>

											<div class="row">
												<div class="col-md-6 col-8">
													<div class="btn-ano-time mt-20">
														<button class="btn btn-red add-another-time" type="button" onclick="addSection();">Add Another Time</button>
													</div>
												</div>
												<div class="col-md-6 col-4">
													<div class="btn-ano-time mt-20 float-right">
														<button class="btn btn-red" type="submit">Save</button>
													</div>
												</div>
											</div>
										</form>
									</div>
								</div>
							</div>
						</div>

						<div class="accordion custom-accordionwithicon accordion-border-box mb-30" id="accordionnesting22">
							<div class="accordion-item shadow">
								<h2 class="accordion-header" id="accordionnestingExample22">
									<button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#accor_nestingExamplecollapse2" aria-expanded="false" aria-controls="accor_nestingExamplecollapse2">
										Your Schedule Breakdown
									</button>
								</h2>
								<div id="accor_nestingExamplecollapse2" class="accordion-collapse collapse" aria-labelledby="accordionnestingExample22" data-bs-parent="#accordionnesting22">
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
													@foreach($businessActivity as $schedule)
														<tr>
															<td>{{substr($schedule->activity_days , 0, -1)}}</td>
															<td>{{date('m/d/Y', strtotime($schedule->starting))}} to {{date('m/d/Y', strtotime($schedule->end_activity_date))}}</td>
															<td class="time-zone">{{ date('h:i a', strtotime( $schedule->shift_start ))}}  to {{date('h:i a', strtotime( $schedule->shift_end ))}}</td>
															<td>{{$schedule->get_clean_duration()}}</td>
															<td>{{$schedule->spots_available}}</td>
															<td>{{$schedule->business_service->activity_location}}</td>
														</tr>
													@endforeach
												</tbody>
											</table>
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
</nav>

<script type="text/javascript">
	
	$("#frm_class_meets").on("change", function () {
            var result = confirm("Switching between Weekly and Specific will erase any times already created. Are you sure to switch ?");
            if(result){
                $('#startingpicker').val('');
              $(".daycircle").hide();
              $(".remove-week").hide();
              var day = moment($('#startingpicker').val(), 'MM-DD-YYYY').format('dddd');
              var activityMeet = $(this).val();
              $("#activity_scheduler_body").html("");
              $(".timezone-round").removeClass('day_circle_fill');
              $(".timezone-round").css('pointer-events', 'none');
              $("#activity_scheduler_body").html('');
              $(".timezone-round").removeClass('day_circle_fill');
              $(".timezone-round").css('pointer-events', 'none');
              $(".Monday").css('pointer-events', 'auto');
              $(".Tuesday").css('pointer-events', 'auto');
              $(".Wednesday").css('pointer-events', 'auto');
              $(".Thursday").css('pointer-events', 'auto');
              $(".Friday").css('pointer-events', 'auto');
              $(".Saturday").css('pointer-events', 'auto');
              $(".Sunday").css('pointer-events', 'auto');
        
            var cnt=$('#duration_cnt').val();
            if(cnt >= 0){
                for (var i = 1; i <= cnt; i++) {
                        $("#dayduration" + i).remove();
                    }
                    $("#dayduration0").html('');
                    var htmlData = '';
                htmlData = '<div id="dayduration0"> <div class="accordion nesting2-accordion custom-accordionwithicon accordion-border-box mt-3" id="accordionnestingin0"> <div class="accordion-item shadow"> <h2 class="accordion-header" id="accordionnestinginExample0"> <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#accor_nestinginExamplecollapse0" aria-expanded="true" aria-controls="accor_nestinginExamplecollapse0"> Time Select </button> </h2> <div id="accor_nestinginExamplecollapse0" class="accordion-collapse collapse show" aria-labelledby="accordionnestinginExample0" data-bs-parent="#accordionnestingin0"> <div class="accordion-body"> <div id="day-circle"> <div class="col-md-12" id="deleteschedule0" style="display: none;" onclick="removeschedule(0);"> <i class="float-right ri-delete-bin-fill align-bottom me-2 text-muted" title="Remove activity"></i> </div> <div class="daycircle" id="editscheduler"> <input type="hidden" name="id[]" id="id" value=""> <input type="hidden" name="activity_days[]" id="activity_days" class="activity_days" value="" width="800"> <div class="weekdays"> <div class="col-md-12"> <div class="display-line"> <div data-day="Monday" class="col-sm-1 timezone-round day_circle Monday dys"> <p>Mo</p> </div> <div data-day="Tuesday" class="col-sm-1 timezone-round day_circle Tuesday dys"> <p>Tu</p> </div> <div data-day="Wednesday" class="col-sm-1 timezone-round day_circle Wednesday dys "> <p>We</p> </div> <div data-day="Thursday" class="col-sm-1 timezone-round day_circle Thursday dys"> <p>Th</p> </div> <div data-day="Friday" class="col-sm-1 timezone-round day_circle Friday dys"> <p>Fr</p> </div> <div data-day="Saturday" class="col-sm-1 timezone-round day_circle Saturday dys"> <p>Sa</p> </div> <div data-day="Sunday" class="col-sm-1 timezone-round day_circle Sunday dys"> <p>Su</p> </div> </div> </div> </div> <div class="row"> <div class="col-lg-3 col-md-5 col-sm-5"> <div class="form-group mmt-10"> <label>Start Time</label>'+ '{{timeSlotOption("shift_start",'')}}' +' </div> </div> <div class="col-lg-1 col-md-2 col-sm-2"> <div class="weekly-time-estimate"> <label>To</label> </div> </div> <div class="col-lg-3 col-md-5 col-sm-5"> <div class="form-group mmt-10"> <label>End Time</label>'+'{{timeSlotOption("shift_end", '')}}' + '</div> </div> <div class="col-lg-3 col-md-6 col-sm-6"> <label class="mmt-10 imt-10">Duration</label> <div class="sp-bottom"> <input type="text" name="set_duration[]" id="set_duration" value="" readonly="" class="set_duration form-control"> </div> </div> <div class="col-lg-2 col-md-6 col-sm-6"> <label class="mmt-10 imt-10"># Spots Available</label> <div class="sp-bottom"> <input type="text" class="form-control valid" name="sport_avail[]" id="sport_avail" value="1" required="required"> </div> </div>';

           		htmlData += '<div class="col-lg-3 col-md-6 col-sm-6"><div class="priceselect sp-select mt-10"><label>Choose Instructure</label>';
                
               	htmlData += '{!!$staffDataHTml!!}';
              	
	        	let newScript = document.createElement('script');
	           	newScript.type = 'text/javascript';
	           	let newSelector = '#instructure'+cnt;
	           	let newScriptContent = `new SlimSelect({ select: '${newSelector}' });`;
	           	newScript.appendChild(document.createTextNode(newScriptContent));

            	htmlData += '<script id="slimSelectScript'+cnt+'">'+newScript+'<script>';
                htmlData +='</div></div>';
                htmlData +=     '</div> </div> </div> </div> </div> </div> </div> </div>';
                $("#dayduration0").html(htmlData);
               	$('#duration_cnt').val('0');
                } else{
                   $("#activity_scheduler_body").append($("#day-circle").html());
              	}

            	$("#activity_scheduler_body .daycircle").show();
            	$('#startingpicker').datepicker('hide');  
            }
    });

	function addSection(){
		var i = $('#duration_cnt').val();
        i++;
        var cnt = i;
       $('#duration_cnt').val(cnt);
       var htmlData =add_time = "";
       htmlData += '<div id="dayduration'+cnt+'"><div class="accordion nesting2-accordion custom-accordionwithicon accordion-border-box mt-3" id="accordionnestingin'+cnt+'"><div class="accordion-item shadow"><h2 class="accordion-header" id="accordionnestinginExample'+cnt+'"><button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#accor_nestinginExamplecollapse'+cnt+'" aria-expanded="false" aria-controls="accor_nestinginExamplecollapse'+cnt+'">Time Select</button></h2><div id="accor_nestinginExamplecollapse'+cnt+'" class="accordion-collapse collapse" aria-labelledby="accordionnestinginExample'+cnt+'" data-bs-parent="#accordionnestingin'+cnt+'" style=""><div class="accordion-body"><div id="day-circle">';

        htmlData += '<div class="daycircle" id="editscheduler"><div class="col-md-12" id="deleteschedule'+cnt+'" onclick="removeschedule('+cnt+');"><i class="float-right ri-delete-bin-fill align-bottom me-2 text-muted"  title="Remove activity"></i></div>';

        htmlData += $(".daycircle").html();
        htmlData += '</div>';

        htmlData += '</div></div></div></div></div></div>';
        add_time = htmlData.replace(/instructure\d+/,"instructure"+cnt);
        add_time = add_time.replaceAll(/instructure\[\d+\]/g,"instructure["+cnt+"]");
        add_time = add_time.replace(/slimSelectScript\d+/,"slimSelectScript"+cnt);
        add_time = add_time.replaceAll(/instructure\[\d+\]\[]/g,"instructure["+cnt+"][]");
        $("#activity_scheduler_body").append(add_time);
        $('#slimSelectScript'+cnt).html('');
        let newScript = document.createElement('script');
        newScript.type = 'text/javascript';
        let newSelector = '#instructure'+cnt;
        let newScriptContent = `new SlimSelect({ select: '${newSelector}' });`;
        newScript.appendChild(document.createTextNode(newScriptContent));

        $('#slimSelectScript'+cnt).html(newScript);
        parent = document.querySelector("#dayduration"+cnt);
       shift_start = parent.querySelector('#shift_start').value='';
       shift_end = parent.querySelector('#shift_end').value='';
       set_duration = parent.querySelector('#set_duration').value='';
       sport_avail = parent.querySelector('#sport_avail').value='';
       id = parent.querySelector('#id').value='';
       activity_days = parent.querySelector('#activity_days').value='';
       $("#dayduration"+cnt).find('div.timezone-round').removeClass("day_circle_fill");
	}

	/*$("body").on("click", ".add-another-time", function(){ 
        
    });*/
</script>

 <script>
    flatpickr(".flatpickr", {
      dateFormat: "m/d/Y",
      maxDate: "01/01/2050",
      enable: [{
        from: "today",
        to: "01/01/2050"
       }]
   });
</script>

<script>

    $("body").on("click", ".daycircle", function(){
 
      activity_days = "";     
        $(this).find(".weekdays").each( function() {
          $.each( $(this).find('.day_circle'), function( key, value ) {
            if ($(this).hasClass('day_circle_fill')) {         
              activity_days += value.classList[3] + ",";
            }  
          });
        });
        $(this).find('.activity_days').val(activity_days);
    });

   

    $('body').delegate('.timezone-round','click',function(){  
 
      if($(this).hasClass("day_circle_fill"))
         $(this).removeClass('day_circle_fill');
      else
         $(this).addClass('day_circle_fill');

   });

    $("body").on("change",".shift_start, .shift_end", function(){
        var timeStart = new Date("01/01/2007 " + $(this).parent().parent().parent().find('.shift_start').val());
        var timeEnd = new Date("01/01/2007 " + $(this).parent().parent().parent().find('.shift_end').val());

        var seconds = Math.floor((timeEnd - (timeStart))/1000);
        var minutes = Math.floor(seconds/60);
        var hours = Math.floor(minutes/60);
        var days = Math.floor(hours/24);

        hours = hours-(days*24);
        minutes = minutes-(days*24*60)-(hours*60);
        seconds = seconds-(days*24*60*60)-(hours*60*60)-(minutes*60);

        if(hours > 1 || hours < -1) {
            var duration = hours + ' hours ' + minutes + ' minutes ' + seconds + ' second';
        } else {
            var duration = hours + ' hour ' + minutes + ' minutes ' + seconds + ' second';  
        }
     
        $(this).parent().parent().parent().find('.set_duration').val(duration);
    });

    

    function removeschedule(i){
        var cnt=$('#duration_cnt').val();
        var cnt1 = cnt <=0 ? 0: (cnt-1);
        $('#duration_cnt').val(cnt1);
        $('#dayduration'+i).remove();
    }
</script>