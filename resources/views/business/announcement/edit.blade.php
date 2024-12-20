<link rel="stylesheet" type="text/css" href="{{ url('public/dashboard-design/css/tempusdominus-bootstrap-4.css') }}"> 
	
	 <script src="{{asset('/public/dashboard-design/js/tempusdominus-bootstrap-4.min.js')}}"></script>

<h5 class="modal-title text-center" id="staticBackdropLabel">@if(request()->type == 'edit' ) Edit @else Create @endif Announcement </h5>
<form action="@if(request()->type == 'edit' ) {{route('business.announcement.update' ,['business_id' => $business_id ,'announcement' => $announcement->id ])}} @else  {{route('business.announcement.store')}} @endif" method="POST" class="needs-validation" >
	@if(request()->type == 'edit' )
		@method('PATCH')
	@endif
	@csrf
	<div class="row y-middle">
		<div class="col-lg-12">
			<div class="mb-3">
				<label class="form-label">Title</label>
				<input type="text" class="form-control" name="title" id="title" required="" maxlength="50" placeholder="Title"  value="{{$announcement->title}}">
				<div class="float-right">Max to be <span class="mr-15"> 50</span>  Remaining <span id="titleCount"> 0 </span></div>
			</div>
		</div>
		<div class="col-lg-12">
			<div class="form-group mb-3">
				<label class="form-label">Short Description</label>
				<textarea class="form-control" name="short_description" id="short_description" placeholder="Enter your description" rows="2" maxlength="200" required>{{$announcement->short_description}}</textarea>
				<div class="float-right">Max to be <span class="mr-15"> 200</span>  Remaining <span id="descCount"> 0 </span></div>
			</div>
		</div>
		<div class="col-lg-12">
			<div class="form-group mb-3">
				<label class="form-label">Category</label>
				<select name="category" id="category" class="form-select" required="required">
					@foreach($category as $c)
						<option value="{{$c->id}}" @if($announcement->category_id == $c->id) selected @endif>{{$c->name}}</option>
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
							<label><input type="checkbox" value="{{$cl->id}}~~custom" name="list[]" class="mr-15" @if($announcement->announcementContactList()->where(['list_name' =>'custom', 'value' => $cl->id])->exists()) checked @endif>{{$cl->name}}</label>
						</li>
						@endforeach

						<li>
							<label><input type="checkbox" value="male~~gender" name="list[]" class="mr-15" @if($announcement->announcementContactList()->where(['list_name' =>'gender', 'value' => 'male'])->exists()) checked @endif>Male</label>
						</li>
						<li>
							<label><input type="checkbox" value="female~~gender" name="list[]" class="mr-15" @if($announcement->announcementContactList()->where(['list_name' =>'gender', 'value' =>'female'])->exists()) checked @endif>Female</label>
						</li>

						<li>
							<label><input type="checkbox" value="18-29~~age" name="list[]" class="mr-15"  @if($announcement->announcementContactList()->where(['list_name' =>'age', 'value' =>'18-29'])->exists()) checked @endif> Adult 18-29</label>
						</li>
						<li>
							<label><input type="checkbox" value="30-29~~age" name="list[]" class="mr-15"  @if($announcement->announcementContactList()->where(['list_name' =>'age', 'value' =>'30-29'])->exists()) checked @endif>Adult 30 - 39</label>
						</li>
						<li>
							<label><input type="checkbox" value="40-49~~age" name="list[]" class="mr-15"  @if($announcement->announcementContactList()->where(['list_name' =>'age', 'value' =>'40-49'])->exists()) checked @endif> Adult 40 - 49</label>
						</li>
						<li>
							<label><input type="checkbox" value="50~~age" name="list[]" class="mr-15" @if($announcement->announcementContactList()->where(['list_name' =>'age', 'value' =>'50'])->exists()) checked @endif >  Adult 50+</label>
						</li>
						<li>
							<label><input type="checkbox" value="kids~~age" name="list[]" class="mr-15"  @if($announcement->announcementContactList()->where(['list_name' =>'age', 'value' =>'kids'])->exists()) checked @endif> Kids under 18</label>
						</li>

						<li>
							<label><input type="checkbox" value="Active~~customer" name="list[]" class="mr-15"  @if($announcement->announcementContactList()->where(['list_name' =>'customer', 'value' =>'Active'])->exists()) checked @endif> Active</label>
						</li>
						<li>
							<label><input type="checkbox" value="Inactive~~customer" name="list[]" class="mr-15"  @if($announcement->announcementContactList()->where(['list_name' =>'customer', 'value' =>'Inactive'])->exists()) checked @endif> Inactive</label>
						</li>
						<li>
							<label><input type="checkbox" value="Prospects~~customer" name="list[]" class="mr-15"  @if($announcement->announcementContactList()->where(['list_name' =>'customer', 'value' =>'Prospects'])->exists()) checked @endif> Prospects</label>
						</li>
						<li>
							<label><input type="checkbox" value="at-risk~~customer" name="list[]" class="mr-15"  @if($announcement->announcementContactList()->where(['list_name' =>'customer', 'value' =>'at-risk'])->exists()) checked @endif> At-Risk</label>
						</li>
						<li>
							<label><input type="checkbox" value="big-spenders~~customer" name="list[]" class="mr-15"  @if($announcement->announcementContactList()->where(['list_name' =>'customer', 'value' =>'big-spenders'])->exists()) checked @endif> Big-Spenders</label>
						</li>

						<li>
							<label><input type="checkbox" value="Month~~membership" name="list[]" class="mr-15"  @if($announcement->announcementContactList()->where(['list_name' =>'membership', 'value' =>'Month'])->exists()) checked @endif> Expire This Month</label>
						</li>
						<li>
							<label><input type="checkbox" value="Expired~~membership" name="list[]" class="mr-15"  @if($announcement->announcementContactList()->where(['list_name' =>'membership', 'value' =>'Expired'])->exists()) checked @endif>Expired</label>
						</li>

						@foreach($programList as $p) 
							<li>
								<label><input type="checkbox" value="{{$p->id}}~~program" name="list[]" class="mr-15"  @if($announcement->announcementContactList()->where(['list_name' =>'program', 'value' =>$p->id])->exists()) checked @endif>{{$p->program_name}}</label>
							</li>
                        @endforeach

                        @foreach($categoryList as $c) 
							<li>
								<label><input type="checkbox" value="{{$c->id}}~~category" name="list[]" class="mr-15"  @if($announcement->announcementContactList()->where(['list_name' =>'category', 'value' =>$c->id])->exists()) checked @endif>{{$c->category_title}}</label>
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
						<input type="text" class="form-control flatpickr announce-date" id="announcementDate" name="announcementDate" placeholder="Select date"  value="{{@$announcement->announcement_date}}"/>
					</div>
				</div>

				<div class="col-lg-6 col-md-6 col-sm-6 col-12">
					<div class="form-group mb-3">
						<label class="form-label font-bold">Announcement  Time</label>
						<div class="input-group input-group-solid date" id="announcementTime" data-target-input="nearest">
							<input type="text" class="form-control form-control-solid datetimepicker-input" placeholder="Select date & time" data-target="#announcementTime" name="announcementTime" value="{{@$announcement->announcement_time}}"/>
					        <div class="input-group-append" data-target="#announcementTime" data-toggle="datetimepicker">
					            <span class="input-group-text">
					               <i class="fa fa-clock"></i>
					            </span>
					        </div>
						</div>
						<!-- <input type="time" class="form-control announce-time" name="announcementTime"  value="{{@$announcement->announcement_time}}"> -->
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
				<textarea name="announcement" id="announcement" style="display: none;">{{$announcement->announcement}}</textarea>
			</div>
		</div>

		<div class="form-group mb-3">
				<label class="form-label">Status</label>
				<select name="status" class="form-select" required="required">
					<option value="active"  @if($announcement->status == 'active') selected @endif>Active</option>
					<option value="inactive"  @if($announcement->status == 'inactive') selected @endif>InActive</option>
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
									<textarea class="form-control" id="sms_text" name="sms_text" rows="3" maxlength="160">{{$announcement->sms_text}}</textarea>
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
						
										<input type="radio" name="delivery_method" value="choose" {{ $announcement->delivery_method == 'choose'  ? 'checked' : '' }}  /> <label class="fs-13 ml-5">Choose your delivery method</label> 
										
										<div id="optimized" class="desc">
											
										</div>
										<div id="choose" >
											<div class="row">
												<div class="col-lg-12 col-md-4 col-sm-6 col-12">
													<div class="mt-15">
														<div class="form-check form-switch form-switch-dark form-switch-md mb-3">
															<input class="form-check-input" type="checkbox" role="switch" id="delivery_method_sms" name="delivery_method_sms" {{ $announcement->delivery_method_sms  == 1 ?  'checked' : '' }} value="1">
															<label class="form-check-label" for="delivery_method_sms">SMS</label>
															<i class="fas fa-info-circle fs-15" data-bs-toggle="tooltip" data-bs-placement="right"  data-bs-original-title="You have a limited number of free marketing SMS based on your subscription. After you use them all, SMS cost $0.005 each."></i>
														</div>
														<div class="mb-15 ml-15">
															<input type="checkbox" id="send_sms_push_not_available" name="send_sms_push_not_available" {{ $announcement->send_sms_push_not_available  == 1 ?  'checked' : '' }} value="1">
															<label for="delivery_method_sms" class="push-notification">Send SMS if push notification isn't available</label>
														</div>
													</div>
												</div>

												<div class="col-lg-12 col-md-4 col-sm-6 col-12">
													<div>
														<div class="form-check form-switch form-switch-dark form-switch-md mb-3">
															<input class="form-check-input" type="checkbox" role="switch" name="delivery_method_push_notification" {{ $announcement->delivery_method_push_notification  == 1 ?  'checked' : '' }} value="1">
															<label class="form-check-label" for="delivery_method_push_notification">Push Notification</label>
														</div>
													</div>
												</div>

												<div class="col-lg-12 col-md-4 col-sm-6 col-12">
													<div>
														<div class="form-check form-switch form-switch-dark form-switch-md mb-3">
															<input class="form-check-input" type="checkbox" role="switch" name="delivery_method_email" {{ $announcement->delivery_method_email  == 1 ?  'checked' : '' }} value="1">
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
		        $('.enddate-display').removeClass('d-none');
		    } else {
		        $('.enddate-display').addClass('d-none');
		    }
		}

		handleCheckboxChange('{{$announcement->does_expire == 1 ? true : false }}');

		$('#expire').change(function() {
	        handleCheckboxChange($(this).is(':checked'));
	    });

	    $('#title').on('input', function() {
	    	$('#titleCount').html(50 - $(this).val().length);
	    });

	    $('#short_description').on('input', function() {
	    	$('#descCount').html(200 - $(this).val().length);
	    });

	    $('#sms_text').on('input', function() {
	    	$('#word_left_text').html(160 - $(this).val().length);
	    });

	    $('#descCount').html(200 - parseInt($('#short_description').val().length));
	    $('#titleCount').html(50 - parseInt($('#title').val().length));
	    $('#word_left_text').html(160 - parseInt($('#sms_text').val().length));


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
		var method = '{{ @$announcement->delivery_method }}' ?? '';
		if(method == "choose" ){
			$("#choose").show();
		}else{
			$("div.desc").hide();
		}

		
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

	var copyEmailBtn = document.querySelector('.js-emailcopybtn');  
	copyEmailBtn.addEventListener('click', function(event) {  
	// Select the email link anchor text  
	var emailLink = document.querySelector('.js-emaillink');  
	var range = document.createRange();  
	range.selectNode(emailLink);  
	window.getSelection().addRange(range);  

	try {  
		// Now that we've selected the anchor text, execute the copy command  
		var successful = document.execCommand('copy');  
		var msg = successful ? 'successful' : 'unsuccessful';  
		console.log('Copy email command was ' + msg);  
	} catch(err) {  
		console.log('Oops, unable to copy');  
	}  

	// Remove the selections - NOTE: Should use
	// removeRange(range) when it is supported  
	window.getSelection().removeAllRanges();  
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