<link rel="stylesheet" type="text/css" href="{{ url('public/dashboard-design/css/tempusdominus-bootstrap-4.css') }}"> 
<script src="{{asset('/public/dashboard-design/js/tempusdominus-bootstrap-4.min.js')}}"></script>

<h5 class="modal-title text-center" id="staticBackdropLabel">Add Announcements</h5>
<form action="{{route('business.announcement.store')}}" method="POST" class="needs-validation" >
	@csrf
	<div class="row y-middle">
		<div class="col-lg-12">
			<div class="mb-3">
				<label class="form-label">Title</label>
				<input type="text" class="form-control" name="title" id="titleName" required="" maxlength="50" placeholder="Title" >
				<div class="float-right">Max to be <span class="mr-15"> 50</span>  Remaining <span id="titleCount"> 0 </span></div>
			</div>
		</div>
		<div class="col-lg-12">
			<div class="form-group mb-3">
				<label class="form-label">Short Description</label>
				<textarea class="form-control" name="short_description" id="short_description" placeholder="Enter your description" rows="2" maxlength="200" required></textarea>
				<div class="float-right">Max to be <span class="mr-15"> 200</span>  Remaining <span id="descCount"> 0 </span></div>
			</div>
		</div>
		<div class="col-lg-12">
			<div class="form-group mb-3">
				<label class="form-label">Category</label>
				<select name="category" id="category" class="form-select" required="required">
					@foreach($category as $c)
						<option value="{{$c->id}}">{{$c->name}}</option>
					@endforeach
				</select>
			</div>
		</div>

		<div class="col-lg-12">
			<div class="border-bottom-grey mb-15 mt-15"></div>
		</div>

		<div class="col-lg-12">
			<div class="required-settings-btns contact-custom-dropdwon mb-15">
				<label class="form-label"> Select Contact List</label>
				<div class="checkbox-dropdown">
					Client Contact List
					<ul class="checkbox-dropdown-list">
						@foreach($customList as $cl) 
						<li>
							<label><input type="checkbox" value="{{$cl->id}}~~custom" name="list[]" class="mr-15">{{$cl->name}}</label>
						</li>
						@endforeach

						<li>
							<label><input type="checkbox" value="male~~gender" name="list[]" class="mr-15" >Male</label>
						</li>
						<li>
							<label><input type="checkbox" value="female~~gender" name="list[]" class="mr-15">Female</label>
						</li>

						<li>
							<label><input type="checkbox" value="18-29~~age" name="list[]" class="mr-15" > Adult 18-29</label>
						</li>
						<li>
							<label><input type="checkbox" value="40-49~~age" name="list[]" class="mr-15" >Adult 30 - 39</label>
						</li>
						<li>
							<label><input type="checkbox" value="40-49~~age" name="list[]" class="mr-15" > Adult 40 - 49</label>
						</li>
						<li>
							<label><input type="checkbox" value="50~~age" name="list[]" class="mr-15" >  Adult 50+</label>
						</li>
						<li>
							<label><input type="checkbox" value="kids~~age" name="list[]" class="mr-15" > Kids under 18</label>
						</li>

						<li>
							<label><input type="checkbox" value="Active~~customer" name="list[]" class="mr-15" > Active</label>
						</li>
						<li>
							<label><input type="checkbox" value="Inactive~~customer" name="list[]" class="mr-15" > Inactive</label>
						</li>
						<li>
							<label><input type="checkbox" value="Prospects~~customer" name="list[]" class="mr-15" > Prospects</label>
						</li>
						<li>
							<label><input type="checkbox" value="at-risk~~customer" name="list[]" class="mr-15" > At-Risk</label>
						</li>
						<li>
							<label><input type="checkbox" value="big-spenders~~customer" name="list[]" class="mr-15" > Big-Spenders</label>
						</li>

						<li>
							<label><input type="checkbox" value="Month~~membership" name="list[]" class="mr-15" > Expire This Month</label>
						</li>
						<li>
							<label><input type="checkbox" value="Expired~~membership" name="list[]" class="mr-15" >Expired</label>
						</li>

						@foreach($programList as $p) 
							<li>
								<label><input type="checkbox" value="{{$p->id}}~~program" name="list[]" class="mr-15">{{$p->program_name}}</label>
							</li>
                        @endforeach

                        @foreach($categoryList as $c) 
							<li>
								<label><input type="checkbox" value="{{$c->id}}~~category" name="list[]" class="mr-15" >{{$c->category_title}}</label>
							</li>
                        @endforeach

					</ul>
				</div>
			</div>
		</div>

		<div class="mt-25 mb-25">
			<label class="form-label font-bold">Schedule When Announcement Is Posted</label>
			<div class="row">
				<div class="col-lg-6 col-md-6 col-sm-6 col-12">
				<div class="form-group mb-3">
						<label class="form-label font-bold">Announcement  Date</label>
						<input type="text" class="form-control flatpickr announce-date" id="announcementDate" name="announcementDate" placeholder="Select date"  />
					</div>
				</div>

				<div class="col-lg-6 col-md-6 col-sm-6 col-12">
					<div class="form-group mb-3">
						<label class="form-label font-bold">Announcement  Time</label>
						<div class="input-group input-group-solid date" id="announcementTime" data-target-input="nearest">
							<input type="text" class="form-control form-control-solid datetimepicker-input" placeholder="Select date & time" data-target="#announcementTime" name="announcementTime"/>
					        <div class="input-group-append" data-target="#announcementTime" data-toggle="datetimepicker">
					            <span class="input-group-text">
					               <i class="fa fa-clock"></i>
					            </span>
					        </div>
						</div>
						<!-- <input type="time" class="form-control announce-time" name="announcementTime" value=""> -->
					</div>
				</div>
			</div>
		</div>

		<div class="col-lg-12">
			<div class="border-bottom-grey mb-15 mt-15"></div>
		</div>

		<div class="col-lg-12 col-md-12 col-sm-12 col-12">
			<label class="form-label">Delivery Method</label>
			<div class="mb-15">
				<button type="button" class="btn btn-red mb-15 mmt-10" id="openSecondModalBtn">
					Deliver method
				</button>
				<div>
					<label>Edit your sms and push notification message</label>
				</div>
			</div>
		</div>
		
		<div class="col-lg-12">
			<div class="border-bottom-grey mb-15 mt-15"></div>
		</div>

		<div class="col-lg-12">
			<div class="">
				<label class="form-label">Announcement</label>
				<textarea name="announcement" id="announcement" style="display: none;"></textarea>
			</div>
		</div>

		<div class="form-group mb-3">
				<label class="form-label">Status</label>
				<select name="status" class="form-select" required="required">
					<option value="active">Active</option>
					<option value="inactive">InActive</option>
				</select>
			</div>
		</div>

		<div class="col-lg-12 float-left">
			<button type="submit" class="btn btn-red float-right">Submit</button>
		</div>
	</div>

	<div class="modal fade" id="secondModal" tabindex="-1" aria-labelledby="secondModalLabel" aria-hidden="true">
	  	<div class="modal-dialog modal-dialog-centered modal-70 modal-dialog-scrollable">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">Delivery Settings</h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<div class="modal-body">
					<div class="row">
						<div class="col-lg-12">
							<div class="delivery-method-note mb-15">
								<i class="fas fa-info mr-10 "></i>
								<p class="mb-0">Remembar that message blasts may only contain Omnebook links(e.g) reasons, any non Omnebook linkes will be removed from SMS, push notifications and e-mails.</p>
							</div>
							<div class="border-bottom-grey"></div>
						</div>
						<div class="col-lg-12">
							<div class="mt-20 mb-20">
								<label class="fs-18">SMS/Push notification </label>
							</div>
							<form>
								<div class="mb-4 pb-3">
									<label for="FormControlTextarea" class="form-label">Sms/Push Text </label>
									<textarea class="form-control" id="sms_text" name="sms_text" rows="3" maxlength="160"></textarea>
									<span class="float-right">
										 Words left : <span id="word_left_text">160</span>
									</span>
								</div>
							</form>
							<div class="border-bottom-grey mt-15"></div>
						</div>
						
						<div class="col-lg-12">
							<div class="mt-20 mb-20">
								<label class="fs-18">Delivery Method </label>
							</div>
							<div class="mb-4 pb-3">
								<div class="">
									<div id="myRadioGroup">
										<!-- <input type="radio" name="delivery_method" checked="checked" value="optimized"  /> <label class="fs-13 ml-5">Optimized delivery (recommended)</label> 
										<i class="fas fa-info-circle fs-15" data-bs-toggle="tooltip" data-bs-placement="right"  data-bs-original-title="Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book."></i> <br> -->

						
										<input type="radio" name="delivery_method" value="choose" checked /> <label class="fs-13 ml-5">Choose your delivery method</label> 
										
										<div id="optimized" class="desc">
											
										</div>
										<div id="choose" >
											<div class="row">
												<div class="col-lg-12 col-md-4 col-sm-6 col-12">
													<div class="mt-15">
														<div class="form-check form-switch form-switch-dark form-switch-md mb-3">
															<input class="form-check-input" type="checkbox" role="switch" id="delivery_method_sms" name="delivery_method_sms" checked value="1">
															<label class="form-check-label" for="delivery_method_sms">SMS</label>
															<i class="fas fa-info-circle fs-15" data-bs-toggle="tooltip" data-bs-placement="right"  data-bs-original-title="You have a limited number of free marketing SMS based on your subscription. After you use them all, SMS cost $0.005 each."></i>
														</div>
														<div class="mb-15 ml-15">
															<input type="checkbox" id="send_sms_push_not_available" name="send_sms_push_not_available" value="1">
															<label for="delivery_method_sms" class="push-notification">Send SMS if push notification isn't available</label>
														</div>
													</div>
												</div>

												<div class="col-lg-12 col-md-4 col-sm-6 col-12">
													<div>
														<div class="form-check form-switch form-switch-dark form-switch-md mb-3">
															<input class="form-check-input" type="checkbox" role="switch" id="delivery_method_push_notification" checked value="1">
															<label class="form-check-label" for="delivery_method_push_notification">Push Notification</label>
														</div>
													</div>
												</div>

												<div class="col-lg-12 col-md-4 col-sm-6 col-12">
													<div>
														<div class="form-check form-switch form-switch-dark form-switch-md mb-3">
															<input class="form-check-input" type="checkbox" role="switch" id="delivery_method_email" checked value="1">
															<label class="form-check-label" for="delivery_method_email">Email</label>
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
				<div class="modal-footer">
					<button type="button" class="btn btn-red" data-bs-dismiss="modal" aria-label="Close">Save</button>
				</div>
			</div>
	  	</div>
	</div>

</form>	



<script type="text/javascript">
	$(document).ready(function(){
	    $('#startTime').datetimepicker({
		    format: 'LT',
		});

		$('#endTime').datetimepicker({
		    format: 'LT',
		});

		$('#announcementTime').datetimepicker({
		    format: 'LT',
		});
	});

</script>

<script type="text/javascript">

	$(document).ready(function(){
		
		
		function handleCheckboxChange(isChecked) {
		    if (isChecked) {
		        $('.date-display').removeClass('d-none');
		    } else {
		        $('.date-display').addClass('d-none');
		    }
		}

		$('#expire').change(function() {
	        handleCheckboxChange($(this).is(':checked'));
	    });

	    $('#titleName').on('input', function() {
	    	$('#titleCount').html(50 - $(this).val().length);
	    });

	    $('#short_description').on('input', function() {
	    	$('#descCount').html(200 - $(this).val().length);
	    });

	    $('form').submit(function (event) {

	    	if($('#expire').is(':checked')){
	            var startDateValue = $('#startDate').val();

	            if (!startDateValue) {
	                $('#startDateValidation').show(); 
	                event.preventDefault(); 
	            } else {
	                $('#startDateValidation').hide(); 
	            }
	        }
        });
        
        $('#startDate').change(function () {
            $('#startDateValidation').hide();
        });

        $("#sms_text").on('input', function() {
            $('#word_left_text').text(160-parseInt(this.value.length));
        });

  
	});

	flatpickr(".announce-date", {
        altInput: true,
        dateFormat: "Y-m-d",
        altFormat: "m/d/Y",
        maxDate: "2050-01-01",
    });

    /*flatpickr(".announce-time", {
        enableTime: true,
	    noCalendar: true,
	    dateFormat: "H:i"
    });*/
</script>


<script>
		$(document).ready(function() {
			$("div.desc").hide();
			$("input[name$='delivery_method']").click(function() {
				var test = $(this).val();
				$("div.desc").hide();
				$("#" + test).show();
			});
		});


		$(".checkbox-dropdown").click(function () {
			$(this).toggleClass("is-active");
			});

			$(".checkbox-dropdown ul").click(function(e) {
				e.stopPropagation();
		});
</script>

<script>

	document.getElementById('openSecondModalBtn').addEventListener('click', function() {
		// Show the second modal
		var secondModal = new bootstrap.Modal(document.getElementById('secondModal'));
		secondModal.show();

		// Hide the backdrop of the first modal
		var firstModalBackdrop = document.querySelector('#firstModal .modal-backdrop');
		firstModalBackdrop.style.display = 'none';
	});
</script>



<script type="text/javascript">
	CKEDITOR.replace('announcement', {
        height: 200,
        extraPlugins: 'colorbutton,font,editorplaceholder,justify,widget,image2,uploadimage',
        filebrowserUploadUrl: "{{route('business.announcement-upload', ['_token' => csrf_token() ])}}",
		filebrowserUploadMethod: 'form',	
		image2_disableResizer: false,
	});	

</script>

