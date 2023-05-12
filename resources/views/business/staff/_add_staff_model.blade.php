<div class="row contentPop">
	<div class="col-lg-12">
	   <h4 class="modal-title" style="text-align: left; color: #000; line-height: inherit; font-weight: 600; margin-bottom: 15px;">Add New Staff</h4>
	</div>
	<form action="{{route('business.staff.store')}}" method="post">
	@csrf
		<div class="col-lg-3">
			<div class="photo-select">
				<img src="{{asset('/public/images/service-nofound.jpg')}}" class="pro_card_img blah" id="showimg">
				<input type="file" id="files" class="hidden"/>
				<label for="files">Upload Image</label>
			</div>
			<p>Upload an image to showcase your staff</p>
		</div>
		<div class="col-lg-9">
			<div class="row">
				<div class="col-md-4 col-sm-6 col-xs-12">
					<div class="form-group">
						<label for="fname">First Name</label>
						<input type="text" class="form-control" name="first_name">
					</div>
				</div>
				<div class="col-md-4 col-sm-6 col-xs-12">
					<div class="form-group">
						<label for="lname">Last Name</label>
						<input type="text" class="form-control" name="last_name"	>
					</div>
				</div>
				<div class="col-md-4 col-sm-6 col-xs-12">
					<div class="form-group">
						<label for="cnumber">Cell Number</label>
						<input type="text" class="form-control" name="phone" data-behavior="text-phone">
					</div>
				</div>
				
				<div class="col-md-5 col-sm-6 col-xs-12">
					<div class="form-group">
						<label for="email">Email</label>
						<input type="text" class="form-control" name="email">
					</div>
				</div>
				<div class="col-md-3 col-sm-6 col-xs-12">
					<div class="form-group">
						<label for="position">Position</label> <a class="position-add">Add Position</a>
						<div class="special-offer">
							<div class="multiples">
								<select id="position" name="position" class="myfilter" >
									<option value="instructure">Instructure</option>
								</select>
							</div>
							
						</div>
					</div>
				</div>
				<div class="col-md-4 col-sm-6 col-xs-12">
					<div class="form-group">
						<label class="position-gander">How Do You Identify?</label>
						<div>
							<input type="radio" id="male" name="fav_language" value="male">
							<label class="inner-fonts-staff" for="male">Male</label>
							<input type="radio" id="female" name="fav_language" value="Female">
							<label class="inner-fonts-staff" for="female">Female</label>
							<input type="radio" id="other" name="fav_language" value="Other">
							<label class="inner-fonts-staff" for="other">Other</label>
						</div>
					</div>
				</div>
				
				<div class="col-md-5 col-sm-6 col-xs-12">
					<div class="form-group">
						<label for="address">Address</label>
						<input type="text" class="form-control" name="Address">
					</div>
				</div>
				<div class="col-md-3 col-sm-6 col-xs-12">
					<div class="form-group">
						<label for="city">City</label>
						<input type="text" class="form-control" name="City"	>
					</div>
				</div>
				<div class="col-md-4 col-sm-6 col-xs-12">
					<div class="form-group">
						<label for="state">State</label>
						<input type="text" class="form-control" name="State">
					</div>
				</div>
				
				<div class="col-md-5 col-sm-6 col-xs-12">
					<div class="form-group">
						<label for="postcode">Post Code</label>
						<input type="text" class="form-control" name="Address">
					</div>
				</div>
				<div class="form-group col-md-5 col-sm-6 col-xs-12">
					<label for="email">Birthday <!-- <span id="star">*</span> --></label>
					<div class="special-date">
						<input  type="text" class="form-control completionyear" id="completionyear" name="frm_passingdate[]" placeholder="Completion Date" autocomplete="off" value="" data-behavior="datepickerforbirtdate">
						<span class="error" id="b_certificateyear"></span>
					</div>
				</div>
			</div>
		</div>

		<div class="col-md-12">
			<div class="text-border public-bio">
				<label class="position-gander">Public Bio</label>
				<textarea id="w3review" name="w3review" rows="4" cols="80">Tell us something about your staff member. Customers will learn more about who they are training with.
				</textarea> 
			</div>
			<button class="button-fitness add-staff-btn" type="submit">Add</button>
		</div>
	</form>
</div>

<script>
    $(document).ready(function() {
      
        var categ = new SlimSelect({
            select: '#position'
        });
    });

</script>