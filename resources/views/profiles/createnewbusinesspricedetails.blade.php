@extends('layouts.header')
@section('content')
@include('layouts.userHeader')


<?php  
	use App\BusinessPriceDetailsAges;
	use App\BusinessServices;

 	$bsdata = BusinessServices::where('id',$catdata['serviceid'])->first();

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

 ?>
<div class="p-0 col-md-12 inner_top padding-0">
	<div class="row">
	 	<div class="col-md-2" style="background: black;">
        	 @include('business.businessSidebarforprice')
        </div>
        <div class="col-md-10">
        	<h3>SCHEDULE YOUR PROGRAM</h3>
        	 <div class="container-fluid p-0">
				<div style="background: black;width: 107%;margin-left: -38px;padding: 6px;">
                    <span class="individualTxt nav-link1 subtab" style="{{ ($bsdata['service_type']=='individual')?'color:red':'' }}">PERSONAL TRAINER</span>
                    <span class="classesTxt nav-link1 subtab1" style="{{ ($bsdata['service_type']=='classes')?'color:red':'' }}">GYM/STUDIO</span>
                    <span class="experienceTxt nav-link1 subtab2" style="{{ ($bsdata['service_type']=='experience')?'color:red':'' }}">EXPERIENCE</span>
                </div>
            </div>

        	<div class="row">
				<div class="col-md-8" >
					<div class="step-four">
						<p class="step-four-highlight">Your Setting the schedule for {{$catdata['category_title']}} under the program name {{$bsdata['program_name']}}.</p>
						<p>Get started by selecting the dates and times this activity will happen</p>
						<p>You can schedule one or more time slots per day for this category.</p>
					</div>
				</div>
			</div>
			<?php  $activity_meets = $starting = $schedule_until =$shift_start = $shift_end = $set_duration = $activity_days = $schedule  = $scdate = $act_met= $act_until= "";
				foreach($business_activity as $data){
					$schedule = $data['scheduled_day_or_week_num'];
					$starting =  date('m/d/Y',strtotime($data['starting']));
					$act_met = $data['activity_meets'];
					$act_until = $data['scheduled_day_or_week'];
				}	
            ?>
	        <form id="scheduleform" action="{{route('addbusinessschedule')}}" method="post"> 
	        	@csrf
	        	<input type="hidden" name="catid" value="{{$catid}}">   
	        	<input type="hidden" name="cid" value="{{$catdata['cid']}}">   
	        	<input type="hidden" name="serviceid" value="{{$catdata['serviceid']}}">   
				<div class="row">
					<div class="col-md-3">
						<div class="form-group">
	                        <label>Activity Starts On </label>
	                        <div class="activityselect3 special-date">

	                            <input type="text" class="form-control frm_starting" name="starting" id="startingpicker" value="{{ $starting }}" min="<?php echo date('Y-m-d');?>" autocomplete="off" placeholder="Date" required="required">
	                            <!-- <i class="fa fa-calendar"></i> -->
							</div>
							<div id="errdate"></div>
	                    </div>
					</div>

					<div class="col-md-3">
						<div class="form-group">
							<label>Activity Meets</label>
							<select class="form-control" name="frm_class_meets" id="frm_class_meets">
								<option <?=($act_met=='Weekly')?"selected":""?> value="Weekly">Weekly</option>
								<option value="On a specific day"<?=($act_met=='On a specific day')?"selected":""?>>On a specific day</option>
							</select>
						</div>
	                </div>

					<div class="col-md-3">
						<div class="form-group">
							<label class="schedule-title">Scheduled Until</label>
							<input class="days-input" type="text" name="scheduled" id="scheduled" placeholder="4" class="form-control" @if($schedule != '') value="{{$schedule}}" @else value="1" @endif>
							<select class="form-control week-section" name="until" id="until">
								<option value="days"  <?=($act_until=='days')?"selected":""?>>  Day(s) </option>
								<option value="week"  <?=($act_until=='week')?"selected":""?>>Week(s)</option><option value="month"  <?=($act_until=='month')?"selected":""?>>Month(s) </option>
								<option value="years"  <?=($act_until=='years')?"selected":""?>>Year(s)</option>
							</select>
						</div>
						<div id="errschedule"></div>
	                </div>
					<hr style="border: 1px solid #000; width: 100%; float: left;">
				</div>
				<?php 
					if(isset($business_activity) && count($business_activity) > 0) { ?>
	                    <input type="hidden"  name="duration_cnt" id="duration_cnt" value="<?php echo count($business_activity)-1; ?>" />
	            <?php } else { ?>
	                  	<input type="hidden"  name="duration_cnt" id="duration_cnt" value="0" />
	            <?php } ?>
				<div id="day-circle">
					<?php 
						$i=0;
	                 	$shift_start = $shift_end = $set_duration = $activity_days =$spots_available = "";
		                if(isset($business_activity) && count($business_activity) > 0) {
			                foreach($business_activity as $activity) {
			                    if(isset($activity['activity_days']) && !empty($activity['activity_days'])) {
			                        $activity_days = $activity['activity_days'];
			                    }
			                    if(isset($activity['shift_start']) && !empty($activity['shift_start'])) {
			                        $shift_start = $activity['shift_start'];
			                    }
			                    if(isset($activity['shift_end']) && !empty($activity['shift_end'])) {
			                        $shift_end = $activity['shift_end'];
			                    }
			                    if(isset($activity['set_duration']) && !empty($activity['set_duration'])) {
			                        $set_duration = $activity['set_duration'];
			                    }
			                    if(isset($activity['spots_available']) && !empty($activity['spots_available'])) {
			                        $spots_available = $activity['spots_available'];
			                    }

		            ?>		
		            	<div id="dayduration{{$i}}">
		            		<div class="col-md-12"><i class="remove-activity fa fa-trash-o" style="color:red; font-weight:bold; cursor:pointer; float:right;margin-right: 20px;" title="Remove activity"></i></div>
			                <div class="daycircle" id="editscheduler">
			                	<input type="hidden" name="id[]" id="id" value="{{$activity['id']}}" />
		                    	<input type="hidden" name="activity_days[]" id="activity_days" class="activity_days" width="800" value="<?=$activity_days?>" />
								<div class="row weekdays">
									<div class="col-md-11" style="display: flex;">
										<div data-day="Monday" class="col-sm-1 timezone-round day_circle Monday dys <?=(str_contains($activity_days, 'Monday')) ? 'day_circle_fill' : '' ?>">
	                                        <p>Mo</p>
	                                    </div>
	                                    <div data-day="Tuesday" class="col-sm-1 timezone-round day_circle Tuesday dys <?=(str_contains($activity_days, 'Tuesday')) ? 'day_circle_fill' : '' ?>">
	                                        <p>Tu</p>
	                                    </div>
	                                    <div data-day="Wednesday" class="col-sm-1 timezone-round day_circle Wednesday dys <?=(str_contains($activity_days, 'Wednesday')) ? 'day_circle_fill' : '' ?>">
	                                        <p>We</p>
	                                    </div>
	                                    <div data-day="Thursday" class="col-sm-1 timezone-round day_circle Thursday dys <?=(str_contains($activity_days, 'Thursday')) ? 'day_circle_fill' : '' ?>">
	                                        <p>Th</p>
	                                    </div>
	                                    <div data-day="Friday" class="col-sm-1 timezone-round day_circle Friday dys <?=(str_contains($activity_days, 'Friday')) ? 'day_circle_fill' : '' ?>">
	                                        <p>Fr</p>
	                                    </div>
	                                
	                                    <div data-day="Saturday" class="col-sm-1 timezone-round day_circle Saturday dys <?=(str_contains($activity_days, 'Saturday')) ? 'day_circle_fill' : '' ?>">
	                                        <p>Sa</p>
	                                    </div>
	                                    <div data-day="Sunday" class="col-sm-1 timezone-round day_circle Sunday dys <?=(str_contains($activity_days, 'Sunday')) ? 'day_circle_fill' : '' ?>">
		                                    <p>Su</p>
	                                    </div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-2">
										<div class="form-group">
										<label>Start Time</label>
											 <?php timeSlotOption('shift_start', $shift_start); ?>
										</div>
									</div>

									<div class="col-md-1">
										<div class="weekly-time-estimate">
											<label>To</label>
										</div>
									</div>

									<div class="col-md-2">
										<div class="form-group">
											<label>End Time</label>
											 <?php timeSlotOption('shift_end', $shift_end); ?>
										</div>
									</div>

									<div class="col-md-2">
										<label>Duration</label>
										<div class="sp-bottom">
											<input type="text" name="set_duration[]" id="set_duration" value="{{ $set_duration }}" readonly class="set_duration form-control">
										</div>
									</div>
									<div class="col-md-2">
										<label># Spots Available</label>
										<div class="sp-bottom">
											<input type="text" class="form-control valid" name="sport_avail[]" id="sport_avail" value="{{ $spots_available}}" required="required">
										</div>
									</div>
								</div>
							</div>
						</div>
					<?php $i++;
	                        }
	                    }else{ ?>
	                    	<div id="dayduration0">
	                    		<div class="col-md-12"><i class="remove-activity fa fa-trash-o" style="color:red; font-weight:bold; cursor:pointer; float:right;margin-right: 20px;" title="Remove activity"></i></div>
	                    		<div class="daycircle" style="display:none;">
	                    			<input type="hidden" name="id[]" id="id" value="" />
									<input type="hidden" name="activity_days[]" id="activity_days" class="activity_days" width="800" value="" />
									<div class="row weekdays">
										<div class="col-md-11" style="display: flex;">
											<div data-day="Monday" class="col-sm-1 timezone-round day_circle Monday dys">
												<p>Mo</p>
											</div>

											<div data-day="Tuesday" class="col-sm-1 timezone-round day_circle Tuesday dys">
												<p>Tu</p>
											</div>

											<div data-day="Wednesday" class="col-sm-1 timezone-round day_circle Wednesday dys">
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
									<div class="row">
										<div class="col-md-2">
											<div class="form-group">
											<label>Start Time</label>
												 <?php timeSlotOption('shift_start',''); ?>
											</div>
										</div>

										<div class="col-md-1">
											<div class="weekly-time-estimate">
												<label>To</label>
											</div>
										</div>

										<div class="col-md-2">
											<div class="form-group">
												<label>End Time</label>
												 <?php timeSlotOption('shift_end', ''); ?>
											</div>
										</div>

										<div class="col-md-2">
											<label>Duration</label>
											<div class="sp-bottom">
												<input type="text" name="set_duration[]" id="set_duration" value="" readonly class="set_duration form-control">
											</div>
										</div>
										<div class="col-md-2">
											<label># Spots Available</label>
											<div class="sp-bottom">
												<input type="text" class="form-control valid" name="sport_avail[]" id="sport_avail" @if(count($business_activity)==0) value="1" @endif  required="required">
											</div>
										</div>
									</div>
								</div>
	                    	</div>
							
					<?php }?>
				</div>
				<div id="activity_scheduler_body">
	                <!-- Activity description will fill here -->
	            </div>
	            <div class="row">
	            	<div class="col-md-12">
						<div class="btn-ano-time">
							<button class="showall-btn add-cate add-another-time" type="button">Add Another Time</button>
							<button class="showall-btn add-cate" type="submit">Save</button>
						</div>
					</div>
	            </div>
			</form>
			<div class="row">
				<div class="col-md-12">	
					<table class="schedule-breakdown" style="width:100%">
						<tr>
							<th class="schedule-breakdown-title" colspan="8">Your Schedule Breakdown</th>
						</tr>
						<tr>
							<th>Day </th>
							<th>Date </th>
							<th>Time</th>
							<th>Duration</th>
							<th># of Spots</th>
							<!-- <th>Instructor</th> -->
							<th>Location</th>
						</tr>
						@foreach($business_activity as $data)
						<?php 
							$time = '';
							if($data['set_duration']!=''){
	                            $tm=explode(' ',$data['set_duration']);
	                            $hr=''; $min=''; $sec='';
	                            if($tm[0]!=0){ $hr=$tm[0].'hr. '; }
	                            if($tm[2]!=0){ $min=$tm[2].'min. '; }
	                            if($tm[4]!=0){ $sec=$tm[4].'sec.'; }
	                            if($hr!='' || $min!='' || $sec!='')
	                            { $time = $hr.$min.$sec; } 
	                        } 
	                        $start = date('h:i a', strtotime( $data['shift_start'] )); 
	                        $end= date('h:i a', strtotime( $data['shift_end'] )); 
	                        $day = $data['activity_days'];
	                        $day = substr($day , 0, -1); 
	                        if($data['scheduled_day_or_week'] == 'days'){
	                        	$daynum = '+'.$data['scheduled_day_or_week_num'].' days';
	                        	$expdate  = date('m/d/Y', strtotime($data['starting']. $daynum ));
	                        }else if($data['scheduled_day_or_week'] == 'month'){
								$daynum = '+'.$data['scheduled_day_or_week_num'].' month';
								$expdate  = date('m/d/Y', strtotime($data['starting']. $daynum ));
	                        }else if($data['scheduled_day_or_week'] == 'years'){
	                        	$daynum = '+'.$data['scheduled_day_or_week_num'].' years';
								$expdate  = date('m/d/Y', strtotime($data['starting']. $daynum ));
	                        }else{
								$daynum = '+'.$data['scheduled_day_or_week_num'].' week';
								$expdate  = date('m/d/Y', strtotime($data['starting']. $daynum ));
	                        }
	                        	
                        ?>
						<tr>
							<td>{{$day}}</td>
							<td>{{$data['starting']}} to {{$expdate}}</td>
							<td>{{$start }} to {{$end}}</td>
							<td>{{$time }}</td>
							<td>{{$data['spots_available']}}</td>
							<!-- <td>Darryl Phipps</td> -->
							<td>{{$bsdata['activity_location']}}</td>
						</tr>
						@endforeach
					</table>
				</div>
			</div>
        </div>
	</div>
</div>
@include('layouts.footer')

<script>
	$(document).ready(function(){ 

		/*$( "#scheduleform" ).submit(function( event ) {  
			event.preventDefault();
			$('#errdate').html('');
			$('#errschedule').html('');
			if($('#startingpicker').val() == ''){
				$('#errdate').html('Plese Select Date..');
				return false;
			}else if($('#scheduled').val() == ''){
				$('#errschedule').html('Plese Enter Scheduled Day or Week..');
				return false;
			}else{
				$( "#scheduleform" ).submit();
				return true;
			}
		});*/

		$('#startingpicker').datepicker({
	       minDate: 0,
	       changeMonth: true,
      	 changeYear: true
	    }).change(activitySchedule);

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
	        
	        //console.log(timeStart + '-' + timeEnd + '=' + duration);
	        
	        $(this).parent().parent().parent().find('.set_duration').val(duration);
	    });

	    $('body').delegate('.timezone-round','click',function(){  
		  	/*if($('#frm_class_meets').val()=='Weekly')
		    {*/   
		    	if($(this).hasClass("day_circle_fill"))
		      		$(this).removeClass('day_circle_fill');
		    	else
		      		$(this).addClass('day_circle_fill');
		  	/*}*/
		});

		$("body").on("click", ".daycircle", function(){
			/*alert($("#frm_class_meets").val());*/
        	/*if($("#frm_class_meets").val() == 'Weekly')
    		{*/
            	activity_days = "";     
      			$(this).find(".weekdays").each( function() {
        			$.each( $(this).find('.day_circle'), function( key, value ) {
			          	if ($(this).hasClass('day_circle_fill')) {            
			            	activity_days += value.classList[3] + ",";
			          	}  
        			});
      			});
      			var cnt = $('#duration_cnt').val();
    			if(cnt == 0){
    				$('.activity_days').val(activity_days);
    			}else{
    				$(this).find('.activity_days').val(activity_days);
    			}
            	
        	/*}
		    if($("#frm_class_meets").val() == 'On a specific day')
		    {
		      	activity_days = "";
	            $.each( $(this).find('.weekdays').children(".day_circle_fill"), function( key, value ) {
	                activity_days += value.classList[3] + ","
	            });
	            $(this).find('.activity_days').val(activity_days);
		    }*/
		});

		$("#frm_class_meets").on("change", function () {
			/*alert('hii');*/
    		/*$('#startingpicker').val('');*/
	        $(".daycircle").hide();
	        $(".remove-week").hide();
	        var day = moment($('#startingpicker').val(), 'MM-DD-YYYY').format('dddd');
	        var activityMeet = $(this).val();
	        $("#activity_scheduler_body").html("");
	        $(".timezone-round").removeClass('day_circle_fill');
	        $(".timezone-round").css('pointer-events', 'none');
	        $(".Monday").css('pointer-events', 'auto');
	        $(".Tuesday").css('pointer-events', 'auto');
	        $(".Wednesday").css('pointer-events', 'auto');
	        $(".Thursday").css('pointer-events', 'auto');
	        $(".Friday").css('pointer-events', 'auto');
	        $(".Saturday").css('pointer-events', 'auto');
	        $(".Sunday").css('pointer-events', 'auto');
	       /* if(activityMeet == 'Weekly') {*/
	        	/*$('#weekendday').css('display', 'none');
	        	$('#weekday').css('display', 'block');*/
	            /*if(day=='Monday') {
	                $(".Monday").css('pointer-events', 'auto');
	                $(".Tuesday").css('pointer-events', 'auto');
	                $(".Wednesday").css('pointer-events', 'auto');
	                $(".Thursday").css('pointer-events', 'auto');
	                $(".Friday").css('pointer-events', 'auto');
	                $(".Saturday").css('pointer-events', 'auto');
	                 $(".Sunday").css('pointer-events', 'auto');
	            }
	            if(day=='Tuesday') {
	                $(".Tuesday").css('pointer-events', 'auto');
	                $(".Wednesday").css('pointer-events', 'auto');
	                $(".Thursday").css('pointer-events', 'auto');
	                $(".Friday").css('pointer-events', 'auto');
	                $(".Saturday").css('pointer-events', 'auto');
	                 $(".Sunday").css('pointer-events', 'auto');
	            }
	            if(day=='Wednesday') {
	                $(".Wednesday").css('pointer-events', 'auto');
	                $(".Thursday").css('pointer-events', 'auto');
	                $(".Friday").css('pointer-events', 'auto');
	                $(".Saturday").css('pointer-events', 'auto');
	                 $(".Sunday").css('pointer-events', 'auto');
	            }
	            if(day=='Thursday') {
	                $(".Thursday").css('pointer-events', 'auto');
	                $(".Friday").css('pointer-events', 'auto');
	                $(".Saturday").css('pointer-events', 'auto');
	                 $(".Sunday").css('pointer-events', 'auto');
	            }
	            if(day=='Friday') {
	                $(".Friday").css('pointer-events', 'auto');
	                $(".Saturday").css('pointer-events', 'auto');
	                 $(".Sunday").css('pointer-events', 'auto');
	            }
	            if(day=='Saturday') {
	                $(".Saturday").css('pointer-events', 'auto');
	                $(".Sunday").css('pointer-events', 'auto');
	            }
	            if(day=='Sunday') {
	                $(".Sunday").css('pointer-events', 'auto');
	            }*/
	            //$(".remove-week").show();
	        /*}*/
	        $(".timezone-round").removeClass('day_circle_fill');
	        /*$(".daycircle ."+day).addClass('day_circle_fill');*/
	        var cnt=$('#duration_cnt').val();
		    if(cnt>=0){
		      	$("#editscheduler").hide();
		      	$("#dayduration0 .daycircle").show();
		      	$('#duration_cnt').val('0');
		    }
		    else
		    {
		      	$("#activity_scheduler_body").append($("#day-circle").html());
		    }
	        /*$("#activity_scheduler_body").append($("#day-circle").html());*/
	        $("#activity_scheduler_body .daycircle").show();
	        $('#startingpicker').datepicker('hide');   
	    });

	    $("body").on("click", ".add-another-time", function(){ 
	    	var cnt=$('#duration_cnt').val();
		    cnt++;
		    $('#duration_cnt').val(cnt);
		    var add_time = "";
        	add_time += '<div id="dayduration'+cnt+'"><div class="daycircle" >';
        	add_time += $(".daycircle").html();
        	add_time += '</div></div>';
        	/*alert(add_time);*/
        	$("#activity_scheduler_body").append(add_time);
        	$(".remove-week").show();
        	parent = document.querySelector("#dayduration"+cnt);
		    shift_start = parent.querySelector('#shift_start').value='';
		    shift_end = parent.querySelector('#shift_end').value='';
		    set_duration = parent.querySelector('#set_duration').value='';
		    sport_avail = parent.querySelector('#sport_avail').value='';
		    id = parent.querySelector('#id').value='';
		    activity_days = parent.querySelector('#activity_days').value='';
		    $("#dayduration"+cnt).find('div.timezone-round').removeClass("day_circle_fill");
		});

		$("body").on("click", ".remove-activity", function(){
	       var cnt=$('#duration_cnt').val();
	       var cnt1;
	       if( cnt <= 0){ cnt1 = 0; }
	       else{ cnt1 = cnt-1; }
	       //alert(cnt+'--'+cnt1);
	       $('#duration_cnt').val(cnt1);
	       $(this).parent().parent().remove();
	    });
    
	});
</script>

<script type="text/javascript">
    function activitySchedule(event) { 
    	/*alert('activitySchedule');*/
        var d = new Date($('#startingpicker').val());
		/*alert(d);*/
    	var weekday = ["Sunday","Monday","Tuesday","Wednesday","Thursday","Friday","Saturday"];
    	//alert(weekday[d.getDay()]); 
    
   		$(".daycircle").hide();
        $(".remove-week").hide();
        //var day = moment($(this).val(), 'MM-DD-YYYY').format('dddd');
    	var day = weekday[d.getDay()];
    	//alert(day);
        var activityMeet = $("#frm_class_meets").val();
         /*alert(activityMeet);*/
        $("#activity_scheduler_body").html("");
        $(".timezone-round").removeClass('day_circle_fill');
        $(".timezone-round").css('pointer-events', 'none');
        $(".Monday").css('pointer-events', 'auto');
        $(".Tuesday").css('pointer-events', 'auto');
        $(".Wednesday").css('pointer-events', 'auto');
        $(".Thursday").css('pointer-events', 'auto');
        $(".Friday").css('pointer-events', 'auto');
        $(".Saturday").css('pointer-events', 'auto');
        $(".Sunday").css('pointer-events', 'auto');
      /*  if(activityMeet == 'Weekly') {*/
            /*if(day=='Monday') {
                $(".Monday").css('pointer-events', 'auto');
                $(".Tuesday").css('pointer-events', 'auto');
                $(".Wednesday").css('pointer-events', 'auto');
                $(".Thursday").css('pointer-events', 'auto');
                $(".Friday").css('pointer-events', 'auto');
                $(".Saturday").css('pointer-events', 'auto');
                 $(".Sunday").css('pointer-events', 'auto');
            }
            if(day=='Tuesday') {
                $(".Tuesday").css('pointer-events', 'auto');
                $(".Wednesday").css('pointer-events', 'auto');
                $(".Thursday").css('pointer-events', 'auto');
                $(".Friday").css('pointer-events', 'auto');
                $(".Saturday").css('pointer-events', 'auto');
                 $(".Sunday").css('pointer-events', 'auto');
            }
            if(day=='Wednesday') {
                $(".Wednesday").css('pointer-events', 'auto');
                $(".Thursday").css('pointer-events', 'auto');
                $(".Friday").css('pointer-events', 'auto');
                $(".Saturday").css('pointer-events', 'auto');
                 $(".Sunday").css('pointer-events', 'auto');
            }
            if(day=='Thursday') {
                $(".Thursday").css('pointer-events', 'auto');
                $(".Friday").css('pointer-events', 'auto');
                $(".Saturday").css('pointer-events', 'auto');
                 $(".Sunday").css('pointer-events', 'auto');
            }
            if(day=='Friday') {
                $(".Friday").css('pointer-events', 'auto');
                $(".Saturday").css('pointer-events', 'auto');
                 $(".Sunday").css('pointer-events', 'auto');
            }
            if(day=='Saturday') {
                $(".Saturday").css('pointer-events', 'auto');
                 $(".Sunday").css('pointer-events', 'auto');
            }
            if(day=='Sunday') {
                $(".Sunday").css('pointer-events', 'auto');
            }*/
            //$(".remove-week").show();
       /* }*/
    	$(".timezone-round").removeClass('day_circle_fill');
        //$(".daycircle ."+day).addClass('day_circle_fill');
    
    	var cnt=$('#duration_cnt').val();
	    if(cnt>=0){
	      	$("#editscheduler").hide();
	      	$("#dayduration0 .daycircle").show();
	      	$('#duration_cnt').val('0');
	    }
	    else
	    {
	      	$("#activity_scheduler_body").append($("#day-circle").html());
	    }
        $("#activity_scheduler_body .daycircle").show();
        $(this).datepicker('hide');
	    var cnt=$('#duration_cnt').val();
	    parent = document.querySelector("#dayduration"+cnt);
	    shift_start = parent.querySelector('#shift_start').value='';
	    shift_end = parent.querySelector('#shift_end').value='';
	    set_duration = parent.querySelector('#set_duration').value='';
        //alert(parent.querySelector('#shift_start').value);
    }
</script>

<script>

	let dropBox = document.getElementById('dropBox');
	// modify all of the event types needed for the script so that the browser
	// doesn't open the image in the browser tab (default behavior)
	['dragenter', 'dragover', 'dragleave', 'drop'].forEach(evt => {
		dropBox.addEventListener(evt, prevDefault, false);
	});

	function prevDefault (e) {
		e.preventDefault();
		e.stopPropagation();
	}

	// remove and add the hover class, depending on whether something is being
	// actively dragged over the box area
	['dragenter', 'dragover'].forEach(evt => {
		dropBox.addEventListener(evt, hover, false);
	});

	['dragleave', 'drop'].forEach(evt => {
		dropBox.addEventListener(evt, unhover, false);
	});

	function hover(e) {
		dropBox.classList.add('hover');
	}

	function unhover(e) {
		dropBox.classList.remove('hover');
	}



	// the DataTransfer object holds the data being dragged. it's accessible
	// from the dataTransfer property of drag events. the files property has
	// a list of all the files being dragged. put it into the filesManager function

	dropBox.addEventListener('drop', mngDrop, false);
	function mngDrop(e) {
		let dataTrans = e.dataTransfer;
		let files = dataTrans.files;
		filesManager(files);
	}

	// use FormData browser API to create a set of key/value pairs representing
	// form fields and their values, to send using XMLHttpRequest.send() method.
	// Uses the same format a form would use with multipart/form-data encoding

	function upFile(file) {
		//only allow images to be dropped
		let imageType = /image.*/;
		if (file.type.match(imageType)) {
			let url = 'HTTP/HTTPS URL TO SEND THE DATA TO';
			// create a FormData object
			let formData = new FormData();
			// add a new value to an existing key inside a FormData object or add the
			// key if it doesn't exist. the filesManager function will loop through
			// each file and send it here to be added
			formData.append('file', file);
			// standard file upload fetch setup
			fetch(url, {
				method: 'put',
				body: formData
			})
			.then(response => response.json())
			.then(result => { console.log('Success:', result); })
			.catch(error => { console.error('Error:', error); });
		} else {
			console.error("Only images are allowed!", file);
		}
	}


	// use the FileReader API to get the image data, create an img element, and add
	// it to the gallery div. The API is asynchronous so onloadend is used to get the
	// result of the API function
	function previewFile(file) {
		// only allow images to be dropped
		let imageType = /image.*/;
		if (file.type.match(imageType)) {
			let fReader = new FileReader();
			let gallery = document.getElementById('gallery');
			// reads the contents of the specified Blob. the result attribute of this
			// with hold a data: URL representing the file's data
			fReader.readAsDataURL(file);
			// handler for the loadend event, triggered when the reading operation is
			// completed (whether success or failure)
			fReader.onloadend = function() {
				let wrap = document.createElement('div');
				let img = document.createElement('img');
				// set the img src attribute to the file's contents (from read operation)
				img.src = fReader.result;
				let imgCapt = document.createElement('p');
				// the name prop of the file contains the file name, and the size prop
				// the file size. convert bytes to KB for the file size
				let fSize = (file.size / 1000) + ' KB';
				gallery.appendChild(wrap).appendChild(img);
				gallery.appendChild(wrap).appendChild(imgCapt);
			}
		} else {
			console.error("Only images are allowed!", file);
		}
	}

	function filesManager(files) {
		// spread the files array from the DataTransfer.files property into a new
		// files array here
		files = [...files];
		// send each element in the array to both the upFile and previewFile
		// functions
		files.forEach(upFile);
		files.forEach(previewFile);
	}
</script>

<script>
	$( function() {
		$( "#actfildate0" ).datepicker( { minDate: 0 } );
	} );
</script>

@endsection
