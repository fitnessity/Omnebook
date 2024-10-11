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