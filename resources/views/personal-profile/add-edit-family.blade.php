<form method="post" action="{{route('addFamilyMember')}}" enctype="multipart/form-data">
	@csrf

	@php 
		$title = @$familyData != '' ? "Edit" : "Add";

		if($type == 'user'){
			$first_name = @$familyData->first_name;
			$last_name = @$familyData->last_name;
			$phone_number = @$familyData->mobile;
			$birthday = @$familyData->birthday;
		}else{
			$first_name = @$familyData->fname;
			$last_name = @$familyData->lname;
			$phone_number = @$familyData->phone_number;
			$birthday = @$familyData->birthdate;
		}

		$profile_pic = Storage::disk('s3')->exists(@$familyData->profile_pic) ? Storage::URL(@$familyData->profile_pic) : url('/images/service-nofound.jpg');

	@endphp

	<div class="row contentPop"> 
		<div class="col-lg-12">
		   <h4 class="modal-title" style="text-align: center; color: #000; line-height: inherit; font-weight: 600; margin-bottom: 15px; margin-top: 15px;">{{$title}} Family or Friends</h4>
		</div>
	</div>
	<input type="hidden" name="id" value="{{@$familyData->id}}">
	<input type="hidden" name="type" value="{{@$type}}">
	<div class="editfamily_frnds">
		<div class="row">	
			<div class="col-xl-4 col-lg-4 col-md-4 col-sm-6">
				<div class="photo-select product-edit user-dash-img">
						<input type="hidden" name="old_pic" value="{{@$familyData->profile_pic}}">
						<img src="{{$profile_pic}}" class="pro_card_img blah" id="showimg">
						<input type="file" id="profile_pic" name="profile_pic" class="text-center">
					</div>
			</div>
			<div class="col-xl-4 col-lg-4 col-md-4 col-sm-6">
				<div class="form-group">
					<input type="text" name="fname" placeholder="First Name" class="form-control" required="required" value="{{$first_name}}">
				</div>
			</div>
			<div class="col-xl-4 col-lg-4 col-md-4 col-sm-6">
				<div class="form-group">
					<input type="text" name="lname" id="lname" placeholder="Last Name" class="form-control" required="required" value="{{$last_name}}">
				</div>
			</div>
			<div class="col-xl-4 col-lg-4 col-md-4 col-sm-6">
				<div class="form-group">
					<select name="gender" id="gender" class="form-control" required="required">
						<option value="" hidden="">Select Gender</option>
						<option value="Male" @if(@$familyData->gender == 'Male') selected @endif>Male</option>
						<option value="Female"  @if(@$familyData->gender == 'Female') selected @endif>Female</option>
					</select>
				</div>
			</div>
			<div class="col-xl-4 col-lg-4 col-md-4 col-sm-6">
				<div class="form-group">
					<input type="email" name="email" id="email" placeholder="Email" class="form-control" value="{{@$familyData->email}}" required="required">
				</div>
			</div>
			<div class="col-xl-4 col-lg-4 col-md-4 col-sm-6">
				<div class="form-group">
					<select name="relationship" id="relationship" class="form-control" required="required">
						<option value="" hidden="">Select Relationship</option>
						<option value="Brother" @if(@$familyData->relationship == 'Brother') selected @endif>Brother</option>
						<option value="Sister" @if(@$familyData->relationship == 'Sister') selected @endif>Sister</option>
						<option value="Father" @if(@$familyData->relationship == 'Father') selected @endif>Father</option>
						<option value="Mother" @if(@$familyData->relationship == 'Mother') selected @endif>Mother</option>
						<option value="Wife" @if(@$familyData->relationship == 'Wife') selected @endif>Wife</option>
						<option value="Husband" @if(@$familyData->relationship == 'Husband') selected @endif>Husband</option>
						<option value="Son" @if(@$familyData->relationship == 'Son') selected @endif>Son</option>
						<option value="Daughter" @if(@$familyData->relationship == 'Daughter') selected @endif>Daughter</option>
						<option value="Friend" @if(@$familyData->relationship == 'Friend') selected @endif>Friend</option>
					</select>
				</div>
			</div>
			<div class="col-xl-4 col-lg-4 col-md-4 col-sm-6">
				<div class="form-group dob">
					<label>mm/dd/yyyy</label>
					<input type="text" name="birthdate" id="birthdate" placeholder="Birthday" class="form-control" value="" required="required" >
				</div>
			</div>
			<div class="col-xl-4 col-lg-4 col-md-4 col-sm-6">
				<div class="form-group">
					<input type="text" name="mobile" id="mobile" placeholder="Mobile" class="form-control" value="{{@$phone_number}}" data-behavior="text-phone" maxlength="14">
				</div>
			</div>
			@if($type == 'user')
			<div class="col-xl-4 col-lg-4 col-md-4 col-sm-6">
				<div class="form-group">
					<input type="text" name="emergency_name" id="emergency_name" placeholder="Emergency Contact Name" class="form-control" value="{{@$familyData->emergency_contact_name}}">
				</div>
			</div>
			@endif
			<div class="col-xl-4 col-lg-4 col-md-4 col-sm-6">
				<div class="form-group">
					<input type="text" name="emergency_contact" id="emergency_contact" placeholder="Emergency Contact Number" class="form-control" maxlength="14" value="{{@$familyData->emergency_contact}}" data-behavior="text-phone" >
				</div>
			</div>
			<div class="col-md-12 text-center p-0">
				<input type="submit" name="btn_family" id="btn_family" value="Submit" class="submit-btn">
			</div>
		</div>
	</div>
</form>

<script type="text/javascript">
	
	flatpickr('#birthdate',{
		dateFormat: "m-d-Y",
		maxDate:"today",
		minDate:"01-01-1970",
		defaultDate : '',
		onChange: function(selectedDates, dateStr, instance) {
            let date = moment(dateStr).format("YYYY-MM-DD");
            $("#birthdate").val(date);
        }
	});
</script>