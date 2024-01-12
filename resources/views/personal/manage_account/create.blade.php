<form method="post" action="{{route('personal.manage-account.store')}}" enctype="multipart/form-data">
	@csrf
	<div class="row">	
		<h4 class="text-center font-red mb-20">Add Family or Friends</h4>
		<div class="col-lg-4 col-md-4 col-sm-6">
			<div class="photo-select product-edit user-dash-img mb-10">
				<input type="hidden" name="old_pic" value="">
				<img src="{{url('/images/service-nofound.jpg')}}" class="pro_card_img blah" id="showimg">
					<input type="file" id="profile_pic" name="profile_pic" class="text-center">
			</div>
		</div>
		<div class="col-lg-8 col-md-8">	
			<div class="row">
				<div class="col-xl-6 col-lg-6 col-md-6 col-sm-6">
					<div class="form-group mb-10">
						<label>First Name</label>
						<input type="text" name="fname" class="form-control" required="required" value="">
					</div>
				</div>
				<div class="col-xl-6 col-lg-6 col-md-6 col-sm-6">
					<div class="form-group mb-10">
						<label>Last Name</label>
						<input type="text" name="lname" id="lname" class="form-control" required="required" value="">
					</div>
				</div>
				<div class="col-xl-6 col-lg-6 col-md-6 col-sm-6">
					<div class="form-group mb-10">
						<label>Gender</label>
						<select name="gender" id="gender" class="form-select" required="required">
							<option value="" hidden="">Select Gender</option>
							<option value="Male">Male</option>
							<option value="Female">Female</option>
						</select>
					</div>
				</div>
				<div class="col-xl-6 col-lg-6 col-md-6 col-sm-6">
					<div class="form-group mb-10">	
						<label>Email</label>
						<input type="email" name="email" id="email" class="form-control" value="" required="required">
					</div>
				</div>
				<div class="col-xl-6 col-lg-6 col-md-6 col-sm-6">
					<div class="form-group mb-10">
						<label>Relationship</label>
						<select name="relationship" id="relationship" class="form-select" required="required">
							<option value="" hidden="">Select Relationship</option>
							<option value="Brother">Brother</option>
							<option value="Sister">Sister</option>
							<option value="Father">Father</option>
							<option value="Mother">Mother</option>
							<option value="Wife">Wife</option>
							<option value="Husband">Husband</option>
							<option value="Son">Son</option>
							<option value="Daughter">Daughter</option>
							<option value="Friend">Friend</option>
						</select>
					</div>
				</div>
				<div class="col-xl-6 col-lg-6 col-md-6 col-sm-6">
					<div class="form-group mb-10">
						<label>Birth date</label>
						<input type="text" class="form-control" name="birthdate" id="birthdate" readonly="readonly">
					</div>
				</div>
				<div class="col-xl-6 col-lg-6 col-md-6 col-sm-6">
					<div class="form-group mb-10">
						<label>Mobile Number</label>
						<input type="text" name="mobile" id="mobile"  class="form-control" value="" data-behavior="text-phone" maxlength="14">
					</div>
				</div>
				<div class="col-xl-6 col-lg-6 col-md-6 col-sm-6">
					<div class="form-group mb-10">
						<label>Emergency Contact Number</label>
						<input type="text" name="emergency_contact" id="emergency_contact" class="form-control" maxlength="14" value="" data-behavior="text-phone">
					</div>
				</div>
			</div>
		</div>
		<div class="hstack gap-2 justify-content-end">
			<button type="submit" id="btn_family" class="btn btn-red">Submit</button>
		</div>
	</div>
</form>

<script type="text/javascript">
	
	flatpickr('#birthdate',{
		altInput:true,
		dateFormat: "Y-m-d",
		altFormat: "m/d/Y",
		maxDate:"today",
		minDate:"1970-01-01"
	});
</script>
