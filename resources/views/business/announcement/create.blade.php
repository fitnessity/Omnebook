	<link rel="stylesheet" type="text/css" href="{{ url('public/dashboard-design/css/tempusdominus-bootstrap-4.css') }}"> 
	
	 <script src="{{asset('/public/dashboard-design/js/tempusdominus-bootstrap-4.min.js')}}"></script>

<h5 class="modal-title text-center" id="staticBackdropLabel">Add Announcement</h5>
<form action="{{route('business.announcement.store')}}" method="POST" class="needs-validation" >
	@csrf
	<div class="row y-middle">
		<div class="col-lg-12">
			<div class="mb-3">
				<label class="form-label">Title</label>
				<input type="text" class="form-control" name="title" id="title" required="" maxlength="50" placeholder="Title" >
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

		<div class="col-lg-12 col-md-12 col-sm-12 col-12">
			<div class="form-group mb-3">
				<input type="checkbox" id="expire" name="expire" value="1">
				<label for="Expire1"> Does this have a start & end date and time ? 
					<i class="fas fa-info-circle fs-15" data-bs-toggle="tooltip" data-bs-placement="right" title="Set your expiration time and date if you want this announcement to expire. This will remove it from the client announcement portal"></i>
				</label>
			</div>
		</div>

		<div class="col-lg-6 col-md-6 col-sm-6 col-12 enddate-display d-none">
			<div class="form-group mb-3">
				<label class="form-label">Start Date</label>
				<input type="text" class="form-control flatpickr announce-date" id="startDate" name="startDate" placeholder="Select date"  required/>
				<div class="invalid-feedback fs-14" id="startDateValidation">Please select a start date.</div>
			</div>
		</div>
		<div class="col-lg-6 col-md-6 col-sm-6 col-12 enddate-display d-none">
			<div class="form-group mb-3">
				<label class="form-label">Start Time</label>
				<div class="input-group input-group-solid date" id="startTime" data-target-input="nearest">
					<input type="text" class="form-control form-control-solid datetimepicker-input" placeholder="Select date & time" data-target="#startTime" name="startTime"/>
			        <div class="input-group-append" data-target="#startTime" data-toggle="datetimepicker">
			            <span class="input-group-text">
			               <i class="fa fa-clock"></i>
			            </span>
			        </div>
				</div>
				<!-- <input  type="time"  class="form-control announce-time" name="startTime" id="startTime" value="" > -->
			</div>
		</div>
						
		<div class="col-lg-6 col-md-6 col-sm-6 col-12 enddate-display d-none">
			<div class="form-group mb-3">
				<label class="form-label">End Date</label>
				<input type="text" class="form-control end-flatpickr announce-date" id="endDate" name="endDate" placeholder="Select date" />
			</div>
		</div>
		<div class="col-lg-6 col-md-6 col-sm-6 col-12 enddate-display d-none">
			<div class="form-group mb-3">
				<label class="form-label">End Time</label>
				<div class="input-group input-group-solid date" id="endTime" data-target-input="nearest">
					<input type="text" class="form-control form-control-solid datetimepicker-input" placeholder="Select date & time" data-target="#endTime" name="endTime"/>
			        <div class="input-group-append" data-target="#endTime" data-toggle="datetimepicker">
			            <span class="input-group-text">
			               <i class="fa fa-clock"></i>
			            </span>
			        </div>
				</div>
				<!-- <input  type="time"  class="form-control announce-time" id="endTime" name="endTime" value=""> -->
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
		
		CKEDITOR.replace('announcement', {
	        height: 200,
	        extraPlugins: 'colorbutton,font,editorplaceholder,justify,image,widget',
	        filebrowserUploadUrl: "{{route('business.announcement-upload', ['_token' => csrf_token() ])}}",
			filebrowserUploadMethod: 'form',	
			image2_alignClasses: ['image-align-left', 'image-align-center', 'image-align-right'],
			image2_disableResizer: true,
		});	

		function handleCheckboxChange(isChecked) {
		    if (isChecked) {
		        $('.enddate-display').removeClass('d-none');
		    } else {
		        $('.enddate-display').addClass('d-none');
		    }
		}

		$('#expire').change(function() {
	        handleCheckboxChange($(this).is(':checked'));
	    });

	    $('#title').on('input', function() {
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