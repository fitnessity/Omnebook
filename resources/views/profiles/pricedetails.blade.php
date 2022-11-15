@extends('layouts.header')
@section('content')
@include('layouts.userHeader')


<link href="https://cdnjs.cloudflare.com/ajax/libs/slim-select/1.18.10/slimselect.min.css" rel="stylesheet">
<link rel="stylesheet" href="/js/select/select.css" />

<div class="p-0 col-md-12 inner_top padding-0">
    <div class="row">
        <div class="col-md-2" style="background: black;">
        	 @include('business.businessSidebar')
        </div>
		<div class="col-md-10">
            <div class="container-fluid p-0">
                <div class="tab-hed">CREATE SERVICES & PRICES</div>
				<hr style="border: 15px solid black;width: 104%;margin-left: -38px;">
            </div>
			<div class="row">
				<div class="col-md-12">
					<div class="serviceprice">
						<h3>Step 3: Set the price for this program</h3>
						<p>How much you charge customer for this program is entirely up to you. Set the price you want customer and see what you can earn. Remember to be competitive when selecting your price options.</p>
					</div>
				</div>
				<div class="col-md-3">
					<div class="priceselect sp-select">
						<label>Category Title (Give a name for this category)</label>
						<input type="text" name="rtitle6" id=""  class="inputs">
					</div>
				</div>
				<div class="col-md-6">
					<div class="sp-select-sche">
						<p><a>+Set Your Schedule</a>(Schedule the times this activity will happen)</p>
					</div>
				</div>
				<div class="col-md-3">
					<div class="priceselect sp-select">
						<label>Is This A Recurring Payment?</label>
						<div class="">
							<input class="check-price" type="checkbox" id="" name="" value="">
							<label>Set recurring payment terms</label>
						</div>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-3 col-sm-6">
					<div class="priceselect sp-select">
						<label>Price Title</label>
						<input type="text" name="rtitle6" id=""  class="inputs" placeholder="30 Minute Session">
					</div>
				</div>
				<div class="col-md-3 col-sm-6">
					<div class="priceselect sp-select">
						<label>Session Type</label>
						<select name="actfiloffer" id="" class="bd-right bd-bottom" onchange="actFilter('68','0')">
							<option value="">Single Session</option>
							<option>Session</option>
							<option>Session</option>
							<option>Session</option>
						</select>
					</div>
				</div>
				
				<div class="col-md-3 col-sm-6">
					<div class="priceselect sp-select">
						<label>Number of Sessions</label>
						<input type="text" name="rtitle6" id=""  class="inputs" placeholder="1">
					</div>
				</div>
				
				<div class="col-md-3 col-sm-6">
					<div class="priceselect sp-select">
						<label>Membership Type</label>
						<select name="actfiloffer" id="" class="bd-right bd-bottom" onchange="actFilter('68','0')">
							<option value="">Drop In</option>
							<option>Aerobics</option>
							<option>Archery</option>
							<option>Bungee Jumping</option>
							<option>Dance</option>
							<option>Kick Boxing</option>
							<option>Yoga</option>
						</select>
					</div>
				</div>
				
			</div>
			
			<div class="row">
				<div class="col-md-12">
					<div class="setprice sp-select">
						<h3>You can set your prices to be the same or different based on age, the weekday or the weekend.To add prices for children or infants, click on the box.</h3>
					</div>
				</div>
			</div>
			
			<div class="row">
				<div class="age-cat">
					<div class="cat-age sp-select">
						<label>Adults</label>
						<p>Ages 12 & Older</p>
					</div>
				</div>
				<div class="weekly-customer">
					<div class="cus-week-price sp-select">
						<label>Customer Weekly Price</label>
						<p> (Monday-Thursday)</p>
						<input type="text" name="rtitle6" id="" placeholder="$">
					</div>
				</div>
				<div class="weekend-price">
					<div class="cus-week-price sp-select">
						<label>Weekend Price Difference? </label>
						<p> Optional (Friday-Sunday)</p>
						<input type="text" name="rtitle6" id="" placeholder="$">
					</div>
				</div>
				<div class="re-discount">
					<div class="discount sp-select">
						<label>Any Discount? </label>
						<p> (Recommended 10% to 15%)</p>
						<input type="text" name="rtitle6" id="">
					</div>
				</div>
				<div class="single-dash">
					<div class="desh sp-select">
						<label>-</label>
					</div>
				</div>
				
				<div class="fit-fees">
					<div class="fees sp-select">
						<label>Fitnessity Fee </label>
						<p> 15%</p>
					</div>
				</div>
				
				<div class="single-equal">
					<div class="equal sp-select">
						<label>=</label>
					</div>
				</div>
				
				<div class="estimated-earn">
					<div class="cus-week-price earn sp-select">
						<label>Estimated Earnings </label>
						<input type="text"  id="" placeholder="$">
					</div>
				</div>
			</div>
			
			<div class="row">
				<div class="age-cat">
					<div class="cat-age sp-select">
						<label>Children</label>
						<p>Ages 2 to 12</p>
					</div>
				</div>
				<div class="weekly-customer">
					<div class="cus-week-price sp-select">
						<label>Customer Weekly Price</label>
						<p> (Monday-Thursday)</p>
						<input type="text" name="rtitle6" id="" placeholder="$">
					</div>
				</div>
				<div class="weekend-price">
					<div class="cus-week-price sp-select">
						<label>Weekend Price Difference?</label>
						<p> Optional (Friday-Sunday)</p>
						<input type="text" name="rtitle6" id="" placeholder="$">
					</div>
				</div>
				<div class="re-discount">
					<div class="discount sp-select">
						<label>Any Discount?</label>
						<p> (Recommended 10% to 15%)</p>
						<input type="text" name="rtitle6" id="">
					</div>
				</div>
				<div class="single-dash">
					<div class="desh sp-select">
						<label>-</label>
					</div>
				</div>
				
				<div class="fit-fees">
					<div class="fees sp-select">
						<label>Fitnessity Fee</label>
						<p> 15%</p>
					</div>
				</div>
				
				<div class="single-equal">
					<div class="equal sp-select">
						<label>=</label>
					</div>
				</div>
				
				<div class="estimated-earn">
					<div class="cus-week-price earn sp-select">
						<label>Estimated Earnings</label>
						<input type="text"  id="" placeholder="$">
					</div>
				</div>
			</div>
			
			<div class="row">
				<div class="age-cat">
					<div class="cat-age sp-select">
						<label>Infants</label>
						<p>Ages 2 & Under</p>
					</div>
				</div>
				<div class="weekly-customer">
					<div class="cus-week-price sp-select">
						<label>Customer Weekly Price</label>
						<p> (Monday-Thursday)</p>
						<input type="text" name="rtitle6" id="" placeholder="$">
					</div>
				</div>
				<div class="weekend-price">
					<div class="cus-week-price sp-select">
						<label>Weekend Price Difference?</label>
						<p> Optional (Friday-Sunday)</p>
						<input type="text" name="rtitle6" id="" placeholder="$">
					</div>
				</div>
				<div class="re-discount">
					<div class="discount sp-select">
						<label>Any Discount?</label>
						<p> (Recommended 10% to 15%)</p>
						<input type="text" name="rtitle6" id="">
					</div>
				</div>
				<div class="single-dash">
					<div class="desh sp-select">
						<label>-</label>
					</div>
				</div>
				
				<div class="fit-fees">
					<div class="fees sp-select">
						<label>Fitnessity Fee</label>
						<p> 15%</p>
					</div>
				</div>
				
				<div class="single-equal">
					<div class="equal sp-select">
						<label>=</label>
					</div>
				</div>
				
				<div class="estimated-earn">
					<div class="cus-week-price earn sp-select">
						<label>Estimated Earnings</label>
						<input type="text"  id="" placeholder="$">
					</div>
				</div>
			</div>
			
			<div class="row">
				<div class="col-md-12 col-sm-12">
					<div class="serviceprice sp-select">
						<h3>When Does This Price Setting Expire</h3>
					</div>
				</div>
				<div class="col-md-3 col-sm-6 col-xs-12">
					<div class="set-num">
						<label>Set The Number</label>
						<input type="text" name="pay_setnum[]" id="pay_setnum" class="form-control valid" placeholder="(ex,1,2,3,etc.)" value="2" onkeypress="return IsNumeric(event);" ondrop="return false;" onpaste="return false;">
					</div>
				</div>
				
				<div class="col-md-3 col-sm-6 col-xs-12">
					<div class="set-num">
						<label>The Duration</label>
						<select name="pay_setduration[]" id="pay_setduration" class="form-control valid">
                            <option value="">Select Value</option>
                            <option selected="">Days</option>
                            <option>Months</option>
                            <option>Year</option>
                        </select>
					</div>
				</div>
				
				<div class="col-md-1 col-xs-12">
					<div class="set-num after">
						<label>After</label>
					</div>
				</div>
				<div class="col-md-5 col-xs-12">
					<div class="after-select">
						<select name="pay_after[]" id="pay_after" class="pay_after form-control valid">
                            <option value="">Select Value</option>
                            <option value="1" selected="">Starts to expire the day of purchase</option>
                            <option value="2">Starts to expire when the customer first participates in the activity</option>
                        </select>
					</div>
				</div>
				<div class="col-md-12">
					<div class="addanother">
						<a href="" > +Add Another Session </a>
					</div>	
				</div>
				<div class="col-md-12">
					<div class="btn-cart-price">
						<button class="showall-btn add-cate">Add Another Price Options</button>
						<p>This catagory price option is different from above</p>
					</div>
				</div>
			</div>
			
			
			<div class="row">
				<div class="col-md-5">
					<div class="step-one">
						<h3>Step 1: Program Details</h3>
						<p>Explain to your customer what this program is.</p>
					</div>
					<div class="priceactivity">
						<select name="frm_servicesport" id="" class="form-control">
							<option value="">Select Your Activity </option>
							<option>Aerobics</option>
							<option>Archery</option>
							<option>Badminton</option>
							<option>Barre</option>
							<option>Baseball</option>
							<option>Basketball</option>
							<option>Beach Vollyball</option>
						</select>
					</div>
					<div class="pro-title">
						<label>Program Title</label>
						<input type="text" class="form-control valid" name="frm_programname" id="" placeholder="(ex. Kickboxing for adults)" >
					</div>
					<div class="pro-title">
						<label>Program Description</label>
						<textarea class="form-control valid" rows="6" name="frm_programdesc" id="" maxlength="150"></textarea>
						<div class="text-right titlepro"><span id="">500</span> Characters Left</div>
					</div>
					
					<div class="selectinstructor">
						<h3>Choose Instructor</h3>
						<p>Which staff member(s) will lead this program?</p>
						<div class="selectstaff">
							<select name="frm_servicesport" id="" class="form-control">
								<option value="">Select Your Activity </option>
								<option>Aerobics</option>
								<option>Archery</option>
								<option>Badminton</option>
								<option>Barre</option>
								<option>Baseball</option>
								<option>Basketball</option>
								<option>Beach Vollyball</option>
							</select>
						</div>
					</div>
				</div>
				
				<div class="col-md-7">
					<div class="addphotos">
						<h3>Add Photos For Your Program</h3>
						<ul>
							<li>Photos uploaded should show details and people in action</li>
							<li>Photos should be high resolution and not pixelated.</li>
							<li>Photos should be professional and reflect the best of what your program represents.</li>
							<li>Photos should not have heavy filters, distortion, overlaid text, or watermarks </li>
						</ul>
					</div>
					<div class="photoupload">
						<div class="img-uploaded">
							<img src="https://development.fitnessity.co/public/img/select-photos.jpg" class="blah2" id="">
						</div>
						<div class="device">
							<label>Upload from your device<input type="file" name="servicepic" class="uploadFile img" value="Upload Photo" onchange="readServicePic2(this);" style="width: 0px;height: 0px;overflow: hidden;"></label>
						</div>
					</div>
				</div>
			</div>
			
			<div class="row">
				<div class="col-md-5">
					<div class="step-one">
						<h3>Step 1: Program Details</h3>
						<p>Explain to your customer what this program is.</p>
					</div>
					<div class="priceactivity">
						<select name="frm_servicesport" id="" class="form-control">
							<option value="">Select Your Activity </option>
							<option>Aerobics</option>
							<option>Archery</option>
							<option>Badminton</option>
							<option>Barre</option>
							<option>Baseball</option>
							<option>Basketball</option>
							<option>Beach Vollyball</option>
						</select>
					</div>
					<div class="pro-title">
						<label>Program Title</label>
						<input type="text" class="form-control valid" name="frm_programname" id="" placeholder="(ex. Kickboxing for adults)" >
					</div>
					<div class="pro-title">
						<label>Program Description</label>
						<textarea class="form-control valid" rows="6" name="frm_programdesc" id="" maxlength="150"></textarea>
						<div class="text-right titlepro"><span id="">500</span> Characters Left</div>
					</div>
					
					<div class="selectinstructor">
						<h3>Choose Instructor</h3>
						<p>Which staff member(s) will lead this program?</p>
						<div class="selectstaff">
							<select name="frm_servicesport" id="" class="form-control">
								<option value="">Select Staff </option>
								<option>Aerobics</option>
								<option>Archery</option>
								<option>Badminton</option>
								<option>Barre</option>
								<option>Baseball</option>
								<option>Basketball</option>
								<option>Beach Vollyball</option>
							</select>
						</div>
					</div>
				</div>
				
				<div class="col-md-7">
					<div class="addphotos">
						<h3>Add Photos For Your Program</h3>
						<ul>
							<li>Photos uploaded should show details and people in action</li>
							<li>Photos should be high resolution and not pixelated.</li>
							<li>Photos should be professional and reflect the best of what your program represents.</li>
							<li>Photos should not have heavy filters, distortion, overlaid text, or watermarks </li>
						</ul>
					</div>
					<div id="dropBox">
						<p>Drag & Drop Images Here...</p>
						<form class="imgUploader">
							<input type="file" id="imgUpload" multiple accept="image/*" onchange="filesManager(this.files)">
							<label class="buttonimg" for="imgUpload">...or Upload from your device</label>
						</form>
						<div id="gallery"></div>
					</div>
				</div>
			</div>
			
			<div class="row">
				<div class="col-md-12">
					<div class="step-one">
						<h3>Step 2: Booking Settings</h3>
						<p>Provide more details to get booked</p>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-1">	
					<div class="instantl-book map-sp">
						<div class="">
							<label class="switch" for="instant">
								<input type="checkbox" name="instant" id="instant" checked="">
								<span class="slider round"></span>
							</label>
							
						</div>
					</div>
				</div>
				<div class="col-md-11">
					<div class="booking-title">
						<label>INSTANT BOOKING:</label>
						<p>Allow customers to book you instantly (Recommeded to get more bookings)</p>
					</div>
				</div>
				
				<div class="col-md-1">	
					<div class="instantl-book map-sp">
						<div class="">
							<label class="switch" for="request">
								<input type="checkbox" name="request" id="request" checked="">
								<span class="slider round"></span>
							</label>
							
						</div>
					</div>
				</div>
				<div class="col-md-11">
					<div class="booking-title">
						<label>REQUEST BOOKING:</label>
						<p>Customers can request a booking, but you want to confirm first.(Less booking frequency with this option) </p>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-6 col-lg-5">
					<div class="participant-req">
						<p>What is the minimum participant requirement for each booking?</p>
					</div>
				</div>
				<div class="col-md-2">
					<div class="sp-bottom">
						<input type="text" class="form-control valid" name="frm_programname" id="" placeholder="1" >
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-6 col-lg-5">
					<div class="">
						<p>What is the latest a customer can book before your activity starts?</p>
					</div>
				</div>
				<div class="col-md-2">
					<div class="sp-bottom">
						<input type="text" class="form-control valid" name="frm_programname" id="" placeholder="1" >
					</div>
				</div>
				<div class="col-md-2">
					<div class="sp-bottom">
						<input type="text" class="form-control valid" name="frm_programname" id="" placeholder="Hour(s)+" >
					</div>
				</div>
			</div>
			
			<div class="row">
				<div class="col-md-3 col-sm-6">
					<div class="priceselect sp-select">
						<label>Select Service Type</label>
						<select name="actfiloffer" id="" class="bd-right bd-bottom" onchange="actFilter('68','0')">
							<option value="">Select Option   </option>
							<option>Session</option>
							<option>Session</option>
							<option>Session</option>
						</select>
					</div>
				</div>
				<div class="col-md-3 col-sm-6">
					<div class="priceselect sp-select">
						<label>Location of Activity ?</label>
						<select name="actfiloffer" id="" class="bd-right bd-bottom" onchange="actFilter('68','0')">
							<option value="">Select Option </option>
							<option>Session</option>
							<option>Session</option>
							<option>Session</option>
						</select>
					</div>
				</div>
				
				<div class="col-md-3 col-sm-6">
					<div class="priceselect sp-select">
						<label>Activity Great For ?</label>
						<select name="actfiloffer" id="" class="bd-right bd-bottom" onchange="actFilter('68','0')">
							<option value="">Select Option </option>
							<option>Session</option>
							<option>Session</option>
							<option>Session</option>
						</select>
					</div>
				</div>
				
				<div class="col-md-3 col-sm-6">
					<div class="priceselect sp-select">
						<label>What age is this for?</label>
						<select name="actfiloffer" id="" class="bd-right bd-bottom" onchange="actFilter('68','0')">
							<option value="">Select Option </option>
							<option>Session</option>
							<option>Session</option>
							<option>Session</option>
						</select>
					</div>
				</div>
				
			</div>
			
			
			<div class="row">
				<div class="col-md-3 col-sm-6">
					<div class="priceselect sp-select">
						<label>Difficulty Levels?</label>
						<select name="actfiloffer" id="" class="bd-right bd-bottom" onchange="actFilter('68','0')">
							<option value="">Select Option   </option>
							<option>Session</option>
							<option>Session</option>
							<option>Session</option>
						</select>
					</div>
				</div>
				<div class="col-md-4 col-sm-6">
					<div class="priceselect sp-select">
						<label>Customers Experience for this Activity?</label>
						<select name="actfiloffer" id="" class="bd-right bd-bottom" onchange="actFilter('68','0')">
							<option value="">Select Option </option>
							<option>Session</option>
							<option>Session</option>
							<option>Session</option>
						</select>
					</div>
				</div>
				
				<div class="col-md-3 col-sm-6">
					<div class="priceselect sp-select">
						<label>Personality & Habits of Instructor?</label>
						<select name="actfiloffer" id="" class="bd-right bd-bottom" onchange="actFilter('68','0')">
							<option value="">Select Option </option>
							<option>Session</option>
							<option>Session</option>
							<option>Session</option>
						</select>
					</div>
				</div>
			</div>
			
			
			<div class="row">
				<div class="col-md-6">
					<div class="step-four">
						<h3>Step 4: SCHEDULE YOUR PROGRAM</h3>
						<p>Ready to schedule your activity? If not, come back later</p>
						<p>You can schedule one or more time slots per day for this activity</p>
						<p>Get started by selecting the dates and times this activity will happen</p>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-3">
					<div class="form-group">
                        <label>Activity Starts On </label>
                        <div class="activityselect3 special-date">
							<input type="text" name="actfildate" id="actfildate0" placeholder="Date" class="form-control" onchange="actFilter" autocomplete="off" >
							<i class="fa fa-calendar"></i>
						</div>
                    </div>
				</div>
				<div class="col-md-3">
					<div class="form-group">
						<label>Activity Meets</label>
						<select class="form-control" name="frm_class_meets" id="frm_class_meets">
							<option value="Weekly">Weekly</option>
							<option value="On a specific day" selected="">Select Option</option>
						</select>
					</div>
                </div>
				<div class="col-md-3">
					<div class="form-group">
						<label class="schedule-title">Scheduled Until</label>
						<input class="days-input" type="text" name="actfildate" id="" placeholder="4" class="form-control" >
						<select class="form-control week-section" name="frm_class_meets" id="">
							<option value="Weekly">Weekly</option>
							<option value="On a specific day" selected="">  Day(s) </option>
						</select>
					</div>
                </div>
				<hr style="border: 1px solid #000; width: 100%; float: left;">
			</div>
			
			<div id="day-circle">
                <input type="hidden"  name="duration_cnt" id="duration_cnt" value="0" />
                    <div id="dayduration0">
						<div class="daycircle" style="">
							<input type="hidden" name="activity_days[]" class="activity_days" width="800" value="" />
							<div class="row weekdays" style="">
								<div class="col-md-11" style="display: flex;">
									<div data-day="Sunday" class="col-sm-1 timezone-round day_circle Sunday dys">
										<p>Su</p>
									</div>
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
								</div>
							</div>
						</div>
                    </div>
            </div>
			
			<!--<div class="row weekdays">
                <div class="col-md-11" style="display: flex;">
                    <div data-day="Sunday" class="col-sm-1 timezone-round day_circle Sunday dys">
                        <p>Su</p>
                    </div>
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
                </div>
			</div>-->
			
			<div class="row">
				<div class="col-md-2">
					<div class="form-group">
						<label>Start Time</label>
						<select class="form-control" name="" id="">
							<option value="Weekly">Weekly</option>
							<option value="On a specific day" selected="">Select Time </option>
						</select>
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
						<select class="form-control" name="" id="">
							<option value="Weekly">Weekly</option>
							<option value="On a specific day" selected="">Select Time </option>
						</select>
					</div>
                </div>
				<div class="col-md-2">
					<label>Duration</label>
					<div class="sp-bottom">
						<input type="text" class="form-control valid" name="frm_programname" id="" >
					</div>
				</div>
				<div class="col-md-2">
					<label># Spots Available</label>
					<div class="sp-bottom">
						<input type="text" class="form-control valid" name="frm_programname" id="" >
					</div>
				</div>
				<div class="col-md-12">
					<div class="btn-ano-time">
						<button class="showall-btn add-cate">Add Another Time</button>
					</div>
				</div>
			</div>
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
							<th>Instructor</th>
							<th>Location</th>
						</tr>
						<tr>
							<td>Monday</td>
							<td>8/15/2022 - 8/15 2023</td>
							<td>10:00 am to 11:00am</td>
							<td>1 hr</td>
							<td>20</td>
							<td>Darryl Phipps</td>
							<td>At Business</td>
						</tr>
					</table>
				</div>
			</div>
				
			<div class="row">
				<div class="col-md-3">
					<label class="pay-card" style="color:#ffffff; background-image: url(http://dev.fitnessity.co/public/img/visa-card-bg.jpg );">
						<input name="plan" class="payment-radio" type="radio" checked>
						<span class="plan-details">
							<div class="row">
								<div class="col-md-6">
									<div class="cart-num">
										<span>XXXX 4023</span>
									</div>
								</div>
								<div class="col-md-6">
									<div class="cart-name">
										<span>Visa</span>
									</div>
								</div>
							</div>
						</span>
					</label>
				</div>
				<div class="col-md-3">
					<label class="pay-card" style="color:#ffffff; background-image: url(http://dev.fitnessity.co/public/img/visa-card-bg.jpg );">
						<input name="plan" class="payment-radio" type="radio">
						<span class="hidden-visually">Pro - $50 per month, 5 team members, 500 GB per month, 5 concurrent builds</span>
						<span class="plan-details">
							<span>XXXX 5986</span>
							<span>Mastercard</span>
							
						</span>
					</label>
				</div>
			</div>
			
			<div class="row">
				<div class="col-md-12">
					<div class="itinerary-data">
						<h3>Set Up Your Itinerary</h3> <p>( Let customers know what they will be doing for this experience)</p>
						<hr style="border: 1px solid #ec1b24; width: 100%; float: left; margin-top: 5px;">
					</div>
					<div class="highlights-title">
						<label>Experience Highlights</label>
						<div class="row">
							<div class="col-md-6">
								<textarea class="form-control valid" rows="6" name="frm_programdesc" id="" maxlength="150" placeholder="Briefly describe a few highlights so customer understand what they will be doing. "></textarea>
								<span>1,000 Character Left</span>
							</div>
						</div>
					</div>
				</div> 
				<hr style="border: 1px solid #ec1b24; width: 100%; float: left; margin-top: 15px;">
					
				<div class="col-md-12">
					<div class="booking-titles">
						<h3>What’s Included with this experience?</h3>
						<p>What do you provide for your customers?</p>
						<p>Examples: You provide pick up and drop off transportation from hotels etc., provider, food and drinks, special equipment, video and photography services etc.)</p>
					</div>
					<div class="row">
						<div class="col-md-6">
							<div class="activity-width">
								<div class="special-offer select-dropoff">
									<div class="multiples">
										<select id="providepickup" name="" class="myfilter" multiple="multiple">
											<option>Personal Training</option>
											<option>Coaching</option>
											<option>Seminar</option>
											<option>Private experience</option>
										</select>
									</div>
								</div>
							</div>
						</div>
					</div>
					
					<div class="booking-titles">
						<h3>What’s Not Included with this experience?</h3>
						<p>List the items or services that are not includes with this experience. i.e. no food or drinks, no equipment, no insurance, etc. </p>
					</div>
					<div class="row">
						<div class="col-md-6">
							<div class="activity-width">
								<div class="special-offer select-dropoff">
									<div class="multiples">
										<select id="serviceitems" name="" class="myfilter" multiple="multiple">
											<option>Personal Training</option>
											<option>Coaching</option>
											<option>Seminar</option>
											<option>Private experience</option>
										</select>
									</div>
								</div>
							</div>
						</div>
					</div>
					
					<div class="booking-titles">
						<h3>What Should Guest Bring and Wear?</h3>
						<p>If guests need anything in order to enjoy your experience, this is the place to tell them. Be as detailed as possible and add each item individually.</p>
					</div>
					<div class="row">
						<div class="col-md-6">
							<div class="activity-width">
								<div class="special-offer select-dropoff">
									<div class="multiples">
										<select id="itemindividually" name="" class="myfilter" multiple="multiple">
											<option>Personal Training</option>
											<option>Coaching</option>
											<option>Seminar</option>
											<option>Private experience</option>
										</select>
									</div>
								</div>
							</div>
						</div>
					</div>
					
					<div class="booking-titles">
						<h3>Accessibility</h3>
						<p>Explain if there is easy access for the disabled </p>
					</div>
					<div class="row">
						<div class="col-md-6">
							<div class="accessibility select-dropoff">
								<textarea class="form-control valid" rows="1" name="frm_programdesc" id="" maxlength="150" ></textarea>
								<span>500 Character Left</span>
							</div>
						</div>
					</div>
					
					<div class="booking-titles">
						<h3>Additional Information & FAQ</h3>
						<p>Have a few things you want your customers to know before arriving? </p>
					</div>
					<div class="row">
						<div class="col-md-6">
							<div class="accessibility select-dropoff">
								<textarea class="form-control valid" rows="1" name="frm_programdesc" id="" maxlength="150" ></textarea>
								<span>1,000 Character Left</span>
							</div>
						</div>
					</div>
				</div>
				<hr style="border: 1px solid #ec1b24; width: 100%; float: left; margin-top: 15px;">
			</div>
			
			<div class="row">
				<div class="col-md-12">
					<div class="plandaybyday">
						<h3>Let’s Plan Your Day By Day</h3>
						<p>Give your customers a day by day plan. Include a title, image and description of what the customers will be doing for that day. You can create multiple days. </p>
						<label class="select-dropoff">Day - 1</label>
						<div class="row">
							<div class="col-md-8">
								<div class="row">
									<div class="col-md-3">
										<div class="photo-upload">
											<label for="input" id="label">
											  <img src="http://dev.fitnessity.co/public/images/Upload-Icon.png" class="pro_card_img blah" id="showimg">
											  <span id="span">Upload your file here</span>
											  <input id="input" type="file">
											</label>
										</div>
									</div>
									<div class="col-md-6">
										<div>
											<input type="text" class="form-control" name="frm_programname" id="" placeholder="Give a heading for this day." title="servicetitle">
										</div>
										<div class="description-txt">
											<textarea class="form-control valid" rows="2" name="frm_programdesc" placeholder="Give a description for this day" maxlength="150"></textarea>
											<span>500 Character Left</span>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="col-md-12">
					<span class="addnewdiv">+ Add another day</span>
				</div>
				<hr style="border: 1px solid #ec1b24; width: 100%; float: left; margin-top: 15px;">
			</div>
			<div class="row">	
				<div class="col-md-6">
					<div class="return-info">
						<h3>Departure & Return Info & Describe the Location</h3>
						<p>Tell customers how and when you will depart and return, how to meet up, where to meet up, meeting point name and how to find you once the customer arrives. Don’t leave it up to customers to figure out how to meet up with you. Let them know before hand.</p>
						
						<textarea class="form-control valid" rows="6" name="frm_programdesc" placeholder="(Ex. Please arrive at the location of our business. The address reminder  is ABC Anytown, town, 12345 USA.) Or; We will pick you up at your hotel. Or; Please talk with your front desk staff about the meeting point, Or; Please meet us at Central Park at the entrance of 81st and Central Park West (CPW). Wait at the seating area if you arrive early. The instructor will have on a red hat and yellow vest. Please arrive 10 minutes before your activity starts.)" maxlength="150"></textarea>
						<span>500 Character Left</span>
					</div>
				</div>
			</div>
			
			<div class="row">	
				<div class="col-md-6">					
					<div class="companydetails">
						<h3>Where should customers meet you?</h3>
						<p>If the meet up spot is different from the address you set earlier in Company Details, then you can set it here.</p>
					</div>
					<div class="row">
						<div class="col-md-6">
							<div class="companydetails-info">
								<label>Street address </label>
								<input type="text" class="form-control">
							</div>
						</div>
						<div class="col-md-6">
							<div class="companydetails-info">
								<label>Country / Region </label>
								<input type="text" class="form-control">
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-3">
							<div class="companydetails-info">
								<label>Bldg (optional)</label>
								<input type="text" class="form-control">
							</div>
						</div>
						<div class="col-md-3">
							<div>
								<label> City </label>
								<input type="text" class="form-control">
							</div>
						</div>
						<div class="col-md-3">
							<div>
								<label>State  </label>
								<input type="text" class="form-control">
							</div>
						</div>
						<div class="col-md-3">
							<div>
								<label> ZIP code</label>
								<input type="text" class="form-control">
							</div>
						</div>
						<div class="col-md-12">
							<div class="select-dropoff">
								<button class="showall-btn">Update Map</button>
							</div>
						</div>
					</div>
					
					<div class="row">
						<div class="col-md-12">
							<div class="pin-on-map">
								<h3>Adjust the pin on the map</h3>
								<p>You can drag the map so the pin is in the right location.</p>
								<div class="maparea">
									<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d24176.251535935986!2d-73.96828678121815!3d40.76133318281456!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x89c258c4d85a0d8d%3A0x11f877ff0b8ffe27!2sRoosevelt%20Island!5e0!3m2!1sen!2sin!4v1620041765199!5m2!1sen!2sin" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
								</div>
							</div>
						</div>
					</div>
				</div>
				<hr style="border: 1px solid #ec1b24; width: 100%; float: left; margin-top: 15px;">
			</div>
			
			<div class="row">
				<div class="col-md-6">
					<div class="customers-help">
						<h3>Confirm your phone number if customers need your help</h3>
						<p>If customers have trouble finding your location, or need questions with help, they may need to call you. The number on file we'll give them is +1 (555) 555-5555. </p>
						<h3>Any additinal information for help</h3>
						<textarea class="form-control valid" rows="3" maxlength="150"></textarea>
						<span>500 Character Left</span>
					</div>
				</div>
			</div>
			
			<div class="row">
				<div class="col-md-6">
					<div class="customers-help">
						<h3>Require Safety Verifications </h3>
						<p>The primary booker has to successfully complete verified ID in order for them and their guests to attend your experience.</p>
						
							<input type="checkbox" id="" name="one" value="">
							<label for="vehicle1">Require the booker to have ID upon arrival for verificaiton of age and identity</label><br>
							<input type="checkbox" id="" name="two" value="Car">
							<label for="vehicle2">Require the booker to have proof of Vacination. </label><br>
							<input type="checkbox" id="" name="three" value="Boat">
							<label for="vehicle3">Require the booker to have proof of a negative Covid-19 test. </label><br> 
					</div>
				</div>
			</div>
			
		</div>
		
	</div>
	
</div>

				

@include('layouts.footer')
<script>
	document.getElementById("input").addEventListener("change", (e) => {
  document.getElementById("span").innerText = e.target.files[0].name;
});
</script>
<script src="<?php echo Config::get('constants.FRONT_JS'); ?>compare/jquery-1.9.1.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/slim-select/1.18.10/slimselect.min.js"></script>
<script>
    $(document).ready(function() {
		var categ = new SlimSelect({
            select: '#providepickup'
        });
		
		var categ = new SlimSelect({
            select: '#serviceitems'
        });
		
		var categ = new SlimSelect({
            select: '#itemindividually'
        });
    });

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

      if($("#frm_class_meets").val() == 'On a specific day')

      {

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



  }); 


</script>

