@extends('layouts.header')
@section('content')

<link rel="shortcut icon" href="{{ url('public/img/favicon.png') }}">

<!--<link rel="stylesheet" type="text/css" href="{{ url('public/css/bootstrap.css') }}">-->
<link rel="stylesheet" type="text/css" href="{{ url('public/css/all.css') }}">
<link rel="stylesheet" type="text/css" href="{{ url('public/css/metismenu.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ url('public/css/fullcalendar.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ url('public/css/profile.css') }}">
<style type="text/css">
   .dob label {
        background-color: lightblue;
        padding: 8px;
        color: white;
        margin-right: -3px;
        z-index: 999999;
        position: relative;
        float:left;
        border-top:solid 1px #000;
        border-bottom:solid 1px #000;
        border-left:solid 1px #000;
    }
    .dob input {
        padding: 10px 10px 10px 10px !important;
        width: 240px;
        border: solid 1px lightgray;
        border-radius: 20px;
    }
</style>
<?php 
    $today =date('m-d-Y') ;
?>
<div class="page-wrapper inner_top" id="wrapper">

    <div class="page-container">

        <!-- Left Sidebar Start -->
        <!-- Left Sidebar End -->

        <div class="page-content-wrapper">

            <div class="content-page">

                <div class="container-fluid">

                    <div class="page-title-box">
                        <h4 class="page-title">Add Family or Friends</h4>
                    </div>
					
					<div class="payment_info_section padding-2 white-bg border-radius1">
						<div class="add-family-frnd" style="cursor: pointer">
                            <div class="cards-content" style="color:#ffffff; background-image: url(http://dev.fitnessity.co/public/img/add-family.png );">
								<h2>Eric Phipps </h2>
								<p>(Son 35 yrs old)</p>
								<div class="familyfrnd-info">
									<a class="edit-family" href="#"  data-toggle="modal" data-target="#editfamilyorfrnd"> Edit </a>
									<a class="delete-family" href="#"> Delete </a>
								</div>
                             </div>
                         </div>
						 <div class="add-family-frnd" style="cursor: pointer">
                            <div class="cards-content" style="color:#ffffff; background-image: url(http://dev.fitnessity.co/public/img/add-family.png );">
								<h2>Eric Phipps </h2>
								<p>(Son 35 yrs old)</p>
								<div class="familyfrnd-info">
									<a class="edit-family" href="#"> Edit </a>
									<a class="delete-family" href="#"> Delete </a>
								</div>
                             </div>
                         </div>
						 <div class="add-family-frnd" style="cursor: pointer">
                            <div class="cards-content" style="color:#ffffff; background-image: url(http://dev.fitnessity.co/public/img/add-family.png );">
								<h2>Eric Phipps </h2>
								<p>(Son 35 yrs old)</p>
								<div class="familyfrnd-info">
									<a class="edit-family" href="#"> Edit </a>
									<a class="delete-family" href="#"> Delete </a>
								</div>
                             </div>
                         </div>
						 <div class="add-family-frnd" style="cursor: pointer">
                            <div class="cards-content" style="color:#ffffff; background-image: url(http://dev.fitnessity.co/public/img/add-family.png );">
								<h2>( + )</h2>
								<p class="add-fm-fr">Add Family Member or Friend</p>
                             </div>
                         </div>
					</div>
					
					<div class="row">
						<div class="col-md-12">
                            <div class="text-right btn-txt-pro">
								<button type="submit" class="btn-nxt-profile">PREV </button>
								<button type="submit" class="btn-nxt-profile">NEXT </button>
                            </div>
						</div>
					</div>
                
					<div class="modal fade compare-model" id="editfamilyorfrnd">
						<div class="modal-dialog modal-lg familyorfrnd">
							<div class="modal-content">
								<div class="modal-header" style="text-align: right;"> 
									<div class="closebtn">
										<button type="button" class="close close-btn-frnd" data-dismiss="modal" aria-label="Close">
											<span aria-hidden="true">×</span>
										</button>
									</div>
								</div>

								<!-- Modal body -->
								<div class="modal-body">
									<div class="row contentPop"> 
										<div class="col-lg-12">
										   <h4 class="modal-title" style="text-align: center; color: #000; line-height: inherit; font-weight: 600; margin-bottom: 15px;">Edit Family or Friends</h4>
										</div>
									 </div>
									 <div class="editfamily_frnds">
										 <div class="row">	
											<div class="col-xl-4 col-lg-4 col-md-4 col-sm-6">
												<div class="form-group">
													<input type="text" name="fname" placeholder="First Name" class="form-control" required="required" value="Ankita">
												</div>
											</div>
											<div class="col-xl-4 col-lg-4 col-md-4 col-sm-6">
												<div class="form-group">
													<input type="text" name="lname" id="lname" placeholder="Last Name" class="form-control" required="required" value="Patel">
												</div>
											</div>
											<div class="col-xl-4 col-lg-4 col-md-4 col-sm-6">
												<div class="form-group">
													<select name="gender" id="gender" class="form-control" required="required">
														<option value="" hidden="">Select Gender</option>
														<option value="Male">Male</option>
														<option selected="" value="Female">Female</option>
													</select>
												</div>
											</div>
											<div class="col-xl-4 col-lg-4 col-md-4 col-sm-6">
												<div class="form-group">
													<input type="email" name="email" id="email" placeholder="Email" class="form-control" value="ankita@gmail.com">
												</div>
											</div>
											<div class="col-xl-4 col-lg-4 col-md-4 col-sm-6">
												<div class="form-group">
													<select name="relationship" id="relationship" class="form-control" required="required">
														<option value="" hidden="">Select Relationship</option>
														<option value="Brother">Brother</option>
														<option selected="" value="Sister">Sister</option>
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
											<div class="col-xl-4 col-lg-4 col-md-4 col-sm-6">
												<div class="form-group dob">
													<label>mm/dd/yyyy</label>
													<input type="text" name="birthdate" id="birthdate" placeholder="Birthday" class="form-control" value="05/22/1992" required="required" data-behavior="datepicker">
												</div>
											</div>
											<div class="col-xl-4 col-lg-4 col-md-4 col-sm-6">
												<div class="form-group">
													<input type="text" name="mobile" id="mobile" placeholder="Mobile" class="form-control" value="(215) 614-1231" data-behavior="text-phone" maxlength="14">
												</div>
											</div>
											<div class="col-xl-4 col-lg-4 col-md-4 col-sm-6">
												<div class="form-group">
													<input type="text" name="emergency_name" id="emergency_name" placeholder="Emergency Contact Name" class="form-control" value="PurviPatel">
												</div>
											</div>
											<div class="col-xl-4 col-lg-4 col-md-4 col-sm-6">
												<div class="form-group">
													<input type="text" name="emergency_contact]" id="emergency_contact" placeholder="Emergency Contact Number" class="form-control" maxlength="14" value="(123) 456-7894">
												</div>
											</div>
											<div class="col-md-12 text-center p-0">
												<input type="submit" name="btn_family" id="btn_family" value="Submit" class="submit-btn">
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


</div>
@include('layouts.footer')

@endsection