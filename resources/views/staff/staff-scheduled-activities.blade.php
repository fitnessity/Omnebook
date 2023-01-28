@extends('layouts.header')
@section('content')
@include('layouts.userHeader')

<div class="p-0 col-md-12 inner_top">
    <div class="row">
        <div class="col-md-2" style="background: black;">
        	 @include('business.businessSidebar')
            <?php /*?><div class="navbar1">
                <div class="navlink1" id="tab1" onclick="location.href='business-welcome';">Welcome</div>
                <div class="navlink1" id="tab2" onclick="linkJump(2);">Company Details</div>
                <div class="navlink1" id="tab3" onclick="linkJump(3);">Your Experience</div>
                <div class="navlink1" id="tab4" onclick="linkJump(4);">Company Specifics</div>
                <div class="navlink1" id="tab5" onclick="linkJump(5);">Set Your Terms</div>
                <div class="navlink1" id="tab6" onclick="linkJump(6);">Get Verified</div>
                <div class="navlink1" id="tab7" onclick="linkJump(7);">Create Services & Prices</div>
                <div class="navlink1" id="tab8" onclick="linkJump(8);">Booking Info</div>
            </div><?php */?>
            <?php /*
            @if(isset($business_details) && !empty($business_details['id']))
            <div class="navbar1">
                <div class="navlink1"><a style="color:#fff" href="/pcompany/view/{{ $business_details['id'] }}" target="_blank">Preview Profile</a></div>
            </div>
            @endif
             */ ?>
        </div>
		<div class="col-md-10">
            <div class="container-fluid p-0">
                <div class="tab-hed">Scheduled Activities</div>
                <hr style="border: 15px solid black;width: 104%;margin-left: -38px;">
            </div>
			
			<div class="row">
				<div class="col-md-12">
					<div class="staff-hed-info">
						<label>Legend: </label>
						<p class="con-week">C= Continuous Weekly | S= One Special Event</p>
						 <a href="#" class="share-staff">Share </a> <p> Schedule with instructor</p>
					</div>
				</div>
			</div>
				
			<div class="table-staff table-sp">
				<table id="example" class="table table-striped table-bordered" style="width:100%">
					<thead>
						<tr>
							<th> Activity </th>
							<th>Program</th>
							<th> Location</th>
							<th>Days of week</th>
							<th>Position</th>
							<th>Service Type</th>
							<th>Duration</th>
							<th>Time</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td>c  Kickboxing</td>
							<td>Kickboxing Level 1 for beginners </td>
							<td>At Business </td>
							<td>M,T,W,T,F </td>
							<td>Instructor</td>
							<td>Class</td>
							<td>45m</td>
							<td>6:15 pm to 7:00 pm </td>
						</tr>
						<tr>
							<td>c Kickboxing</td>
							<td>Kickboxing Level 1 for beginners</td>
							<td>At Business</td>
							<td> S,S  </td>
							<td>Instructor</td>
							<td>Class</td>
							<td>45m</td>
							<td>12:15 pm to 1:00 pm  </td>
						</tr>
						<tr>
							<td>s Krav Maga </td>
							<td>  Womens Self Defense</td>
							<td>At Business</td>
							<td> 03/26/2022</td>
							<td>Instructor</td>
							<td>Class</td>
							<td>2h 30m</td>
							<td>1:00 pm to 3:30 pm </td>
						</tr>
						<tr>
							<td>c   Kickboxing</td>
							<td>Personal Training </td>
							<td>On Location </td>
							<td>M,T,W,T,F,S,S </td>
							<td>Instructor</td>
							<td>Private Lesson</td>
							<td> 45 m	</td>
							<td>7:15 pm to 8:00 pm</td>
						</tr>
					</tbody>
				</table>
			</div>
			<a href="#" class="button-fitness add-another-session-edudetails">Manage Staff</a>
		</div>
		
	</div>

</div>
@include('layouts.footer')
<script>
	$(document).ready(function() {
		$('#example').DataTable();
	} );	
	
	$('#example').dataTable( {
		"searching": false
	} );
</script>

@endsection