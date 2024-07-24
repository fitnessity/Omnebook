@inject('request', 'Illuminate\Http\Request')
@extends('layouts.business.header')
@section('content')

	@include('layouts.profile.business_topbar')
	<!-- ============================================================== -->
    <!-- Start right Content here -->
    <!-- ============================================================== -->
    <div class="main-content">
		<div class="page-content">
			<div class="container-fluid">
				 <div class="position-relative mx-n4 mt-n4">
					<div class="profile-wid-bg profile-setting-img">
						<img src="{{url('/assets/images/profile-bg.jpg')}}" class="profile-wid-img" alt="">
					</div>
				</div>
				
				<div class="row">
					<div class="col-xxl-3 col-lg-3">
						<div class="card mt-n5">
							<div class="card-body p-4">
								<div class="text-center">
									<div class="profile-user position-relative d-inline-block mx-auto  mb-4">
										@if($user->profile_pic_url)
											<img src="{{$user->profile_pic_url}}" class="rounded-circle avatar-xl img-thumbnail user-profile-image  shadow" alt="user-profile-image">
										@else
											<div class="rounded-circle avatar-xl img-thumbnail user-profile-image shadow no-img-latter">
												<p class="character character-renovate">{{$user->first_letter}}</p>
											</div>
										@endif
										
										<form id="image-upload-form" action="{{Route('personal.user_family_profile.update')}}" method="post" enctype="multipart/form-data">
											@csrf
											<div class="avatar-xs p-0 rounded-circle profile-photo-edit">
												<input type="hidden" name ="id" value="{{$user->id}}">
												<input id="profile-img-file-input" name ="profile_pic" type="file" class="profile-img-file-input">
												<label for="profile-img-file-input" class="profile-photo-edit avatar-xs">
													<span class="avatar-title rounded-circle bg-light text-body shadow">
														<i class="ri-camera-fill"></i>
													</span>
												</label>
											</div>
										</form>
									</div>
									<h5 class="fs-16 mb-1">{{$user->full_name}}</h5>
								</div>
							</div>
						</div><!--end card-->
					</div><!--end col-->

					

					<div class="col-xxl-9 col-lg-9">
						<div class="card mt-xxl-n5 mt-n5">
							<div class="card-header">
								<ul class="nav nav-tabs-custom rounded card-header-tabs border-bottom-0" role="tablist">
									<li class="nav-item">
										<a class="nav-link active text-black" data-bs-toggle="tab" href="#personalDetails" role="tab">
											<i class="fas fa-home"></i> Personal Details
										</a>
									</li>
								</ul>
							</div>
							<div class="card-body p-4">
								<div class="tab-content">

									<div class="col-md-12">
				                        @if(session()->has('success'))
				                        <div class="alert alert-success fade in alert-dismissible show"> {{ session()->get('success') }}  </div>
				                        @elseif(session()->has('error'))
				                        <div class="alert alert-danger fade in alert-dismissible show"> {{ session()->get('error') }}</div>
				                        @endif
			                    	</div>
									<div class="tab-pane active" id="personalDetails" role="tabpanel">
										<form  action="{{Route('personal.user_family_profile.update')}}" method="post" enctype="multipart/form-data">
											@csrf
											<input type="hidden" name="type" value="details">
											<input type="hidden" name ="id" value="{{$user->id}}">
											<div class="row">
												<div class="col-lg-4">
													<div class="mb-3">
														<label for="firstnameInput" class="form-label">First Name</label>
														<input type="text" class="form-control" name="firstname" id="firstname" placeholder="Enter your firstname" value="{{ $user->first_name}}" required>
														@error('firstname')
													        <div class="error">{{ $message }}</div>
													    @enderror
													</div>
												</div><!--end col-->

												<div class="col-lg-4">
                                                    <div class="mb-3">
                                                        <label for="lastnameInput" class="form-label">Last Name</label>
                                                        <input type="text" class="form-control" name="lastname" id="lastname" placeholder="Enter your lastname" value="{{ $user->last_name}}" required>
                                                        @error('lastname')
													        <div class="error">{{ $message }}</div>
													    @enderror
                                                    </div>
                                                </div><!--end col-->

                                                <div class="col-lg-4">
                                                    <div class="mb-3">
                                                        <label for="emailInput" class="form-label">Email Address</label>
                                                        <input type="email" class="form-control" placeholder="Enter your email" readonly value="{{ $user->email}}">
                                                    </div>
                                                </div><!--end col-->

												<div class="col-lg-4">
                                                    <div class="mb-3">
                                                        <label for="phonenumberInput" class="form-label">Phone Number</label>
                                                        <input type="text" class="form-control"name="phone_number" id="phone_number" placeholder="Enter your phone number" value="{{ $user->mobile}}" onkeypress='return event.charCode >= 48 && event.charCode <= 57' maxlength="14" data-behavior="text-phone">
                                                        @error('phone_number')
													        <div class="error">{{ $message }}</div>
													    @enderror
                                                    </div>
                                                </div><!--end col-->

                                                <div class="col-lg-4">
                                                    <div class="mb-3">
                                                        <label for="lastnameInput" class="form-label">Emergency Contact </label>
                                                        <input type="text" class="form-control" name="emergency_contact" placeholder="Enter your emergency contact name" value="{{ $user->emergency_contact}}" onkeypress='return event.charCode >= 48 && event.charCode <= 57' maxlength="14" data-behavior="text-phone">
                                                    </div>
                                                </div><!--end col-->

                                                <div class="col-lg-4">
                                                    <div class="mb-3">
                                                        <label for="JoiningdatInput" class="form-label">Date of Birth</label>
                                                        <input type="text" class="form-control flatpickr" name="birthday" placeholder="Birth Date" value="{{$user->birthday}}" />
                                                    </div>
                                                </div><!--end col-->

                                                

                                                <div class="col-lg-4">
													<div class="steps-title mmb-10">
														<div class="mb-3">
															<label for="JoiningdatInput" class="form-label"> Gender </label>
															<select name="gender" id="gender" class="form-select data-choices">
																<option value="male" {{strtolower($user->gender) == 'male' ? 'selected' : ''}}> Male </option>
																<option value="female" {{strtolower($user->gender) == 'female' ? 'selected' : ''}}>Female</option>
																<option value="other" {{strtolower($user->gender) == 'other' ? 'selected' : ''}}>Other</option>
															</select>
															@error('gender')
														        <div class="error">{{ $message }}</div>
														    @enderror
														</div>
													</div>
                                                </div>

                                                <div class="col-lg-4">
													<div class="steps-title mmb-10">
														<div class="mb-3">
															<label for="JoiningdatInput" class="form-label"> Relationship </label>
															<select name="relationship" id="relationship" class="form-select data-choices">
																<option value="" hidden="">Select Relationship</option>
																<option value="Brother" {{$user->relationship == 'Brother' ? 'selected' : ''}}>Brother</option>
																<option value="Sister" {{$user->relationship == 'Sister' ? 'selected' : ''}}>Sister</option>
																<option value="Father" {{$user->relationship == 'Father' ? 'selected' : ''}}>Father</option>
																<option value="Mother" {{$user->relationship == 'Mother' ? 'selected' : ''}}>Mother</option>
																<option value="Wife" {{$user->relationship == 'Wife' ? 'selected' : ''}}>Wife</option>
																<option value="Husband" {{$user->relationship == 'Husband' ? 'selected' : ''}}>Husband</option>
																<option value="Son" {{$user->relationship == 'Son' ? 'selected' : ''}}>Son</option>
																<option value="Daughter" {{$user->relationship == 'Daughter' ? 'selected' : ''}}>Daughter</option>
																<option value="Friend" {{$user->relationship == 'Friend' ? 'selected' : ''}}>Friend</option>
															</select>
														</div>
													</div>
                                                </div> <!--end col-->

                                                <div class="col-lg-12">
                                                    <div class="hstack gap-2 justify-content-end">
                                                        <button type="submit" class="btn btn-red">Updates</button>
                                                    </div>
                                                </div><!--end col-->
                                            </div><!--end row-->
                                        </form>
                                    </div><!--end tab-pane-->
                                </div>
                            </div>
                        </div>
                    </div><!--end col-->
                </div><!--end row-->
            </div><!-- container-fluid -->
		</div><!-- End Page-content -->
    </div><!-- end main content-->
</div><!-- END layout-wrapper -->


@include('layouts.business.footer')
@include('layouts.business.scripts')

<script>
	flatpickr(".flatpickr", {
		altInput:true,
        dateFormat: "Y-m-d",
        altFormat: "m/d/Y",
    });

    $('#profile-img-file-input').change(function() {
        // Trigger form submission when an image is selected
        $('#image-upload-form').submit();
    });
</script>

@endsection
