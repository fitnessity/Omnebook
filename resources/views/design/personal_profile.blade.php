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
						<img src="assets/images/profile-bg.jpg" class="profile-wid-img" alt="">
						<div class="overlay-content">
							<div class="text-end p-3">
								<div class="p-0 ms-auto rounded-circle profile-photo-edit">
									<input id="profile-foreground-img-file-input" type="file" class="profile-foreground-img-file-input">
									<label for="profile-foreground-img-file-input" class="profile-photo-edit btn btn-light">
										<i class="ri-image-edit-line align-bottom me-1"></i> Change Cover
									</label>
								</div>
							</div>
						</div>
					</div>
				</div>
				
				<div class="row">
					<div class="col-xxl-3">
						<div class="card mt-n5">
							<div class="card-body p-4">
								<div class="text-center">
									<div class="profile-user position-relative d-inline-block mx-auto  mb-4">
										<img src="https://fitnessity-production.s3.amazonaws.com/customer/IUwmNesKNJtrlzkSgjex1bzQoXhtvteofsrr44qQ.jpg" class="rounded-circle avatar-xl img-thumbnail user-profile-image  shadow" alt="user-profile-image">
										<div class="avatar-xs p-0 rounded-circle profile-photo-edit">
											<input id="profile-img-file-input" type="file" class="profile-img-file-input">
											<label for="profile-img-file-input" class="profile-photo-edit avatar-xs">
												<span class="avatar-title rounded-circle bg-light text-body shadow">
													<i class="ri-camera-fill"></i>
												</span>
											</label>
										</div>
									</div>
									<h5 class="fs-16 mb-1">Nipa Soni</h5>
								</div>
							</div>
						</div>
						<!--end card-->
						<div class="card">
							<div class="card-body">
								<div class="d-flex align-items-center mb-4">
									<div class="flex-grow-1">
										<h5 class="card-title mb-0">Portfolio</h5>
									</div>
								</div>
								<div class="mb-3 d-flex">
									<div class="avatar-xs d-block flex-shrink-0 me-3">
										<span class="avatar-title rounded-circle fs-16 bg-primary shadow">
											<i class="ri-global-fill"></i>
										</span>
									</div>
									<input type="text" class="form-control" id="websiteInput" placeholder="www.example.com" value="dev.fitnessity.co">
								</div>
								<div class="mb-3 d-flex">
									<div class="avatar-xs d-block flex-shrink-0 me-3">
										<span class="avatar-title rounded-circle fs-16 bg-twitter-blue text-light shadow">
											<i class="fab fa-twitter"></i>
										</span>
									</div>
									<input type="email" class="form-control" id="twitterUsername" placeholder="Username" value="Fitnessitynyc">
								</div>
								
								<div class="mb-3 d-flex">
									<div class="avatar-xs d-block flex-shrink-0 me-3">
										<span class="avatar-title rounded-circle fs-16 bg-dark shadow">
											<i class="fab fa-instagram"></i>
										</span>
									</div>
									<input type="text" class="form-control" id="instaName" placeholder="Username" value="
fitnessityofficial">
								</div>
								<div class="d-flex">
									<div class="avatar-xs d-block flex-shrink-0 me-3">
										<span class="avatar-title rounded-circle fs-16 shadow">
											<i class="fab fa-facebook-f"></i>
										</span>
									</div>
									<input type="text" class="form-control" id="facebookName" placeholder="Username" value="Fitnessity">
								</div>
							</div>
						</div>
						<!--end card-->
					</div>
					<!--end col-->
					<div class="col-xxl-9">
						<div class="card mt-xxl-n5">
							<div class="card-header">
								<ul class="nav nav-tabs-custom rounded card-header-tabs border-bottom-0" role="tablist">
									<li class="nav-item">
										<a class="nav-link active" data-bs-toggle="tab" href="#personalDetails" role="tab">
											<i class="fas fa-home"></i> Personal Details
										</a>
									</li>
									<li class="nav-item">
										<a class="nav-link" data-bs-toggle="tab" href="#changePassword" role="tab">
											<i class="far fa-user"></i> Change Password
										</a>
									</li>
									<!--<li class="nav-item">
										<a class="nav-link" data-bs-toggle="tab" href="#cardInfo" role="tab">
											<i class="far fa-credit-card"></i> Credit Card Info 
										</a>
									</li>
									<li class="nav-item">
										<a class="nav-link" data-bs-toggle="tab" href="#paymenthistory" role="tab">
											<i class="fas fa-file-invoice-dollar"></i> Payment History 
										</a>
									</li>-->
								</ul>
							</div>
							<div class="card-body">
								<div class="tab-content">
									<div class="tab-pane active" id="personalDetails" role="tabpanel">
										<form action="javascript:void(0);">
											<div class="row">
												<div class="col-lg-4">
													<div class="mb-3">
														<label for="firstnameInput" class="form-label">First Name</label>
														<input type="text" class="form-control" id="firstnameInput" placeholder="Enter your firstname" value="Dave">
													</div>
												</div>
												<!--end col-->
												<div class="col-lg-4">
													<div class="mb-3">
														<label for="lastnameInput" class="form-label">Last Name</label>
														<input type="text" class="form-control" id="lastnameInput" placeholder="Enter your lastname" value="Adame">
													</div>
												</div>
												<!--end col-->
												<div class="col-lg-4">
													<div class="mb-3">
														<label for="emailInput" class="form-label">Email Address</label>
														<input type="email" class="form-control" id="emailInput" placeholder="Enter your email" value="daveadame@velzon.com">
													</div>
												</div>
												<!--end col-->
												<div class="col-lg-4">
													<div class="mb-3">
														<label for="phonenumberInput" class="form-label">Phone Number</label>
														<input type="text" class="form-control" id="phonenumberInput" placeholder="Enter your phone number" value="+(1) 987 6543">
													</div>
												</div>
												<!--end col-->
												<div class="col-lg-4">
													<div class="mb-3">
														<label for="websiteInput1" class="form-label">User Name </label>
														<input type="text" class="form-control" id="websiteInput1" placeholder="Nipasoni14" value="" />
													</div>
												</div>
												<!--end col-->
												<div class="col-lg-4">
													<div class="mb-3">
														<label for="JoiningdatInput" class="form-label">Date of Birth</label>
														<input type="text" class="form-control flatpickr" data-provider="flatpickr" id="JoiningdatInput" data-date-format="d M, Y" data-deafult-date="24 Nov, 2021" placeholder="Select date" />
														<div class="dob-radio">
															<input type="radio" class="radio-dots" name="dobstatus" value="0" checked="">
															<label style="font-weight: normal;">Show &nbsp;&nbsp;</label>
															<input type="radio" class="radio-dots" name="dobstatus" value="1">
															<label style="font-weight: normal;">Hide</label>
														</div>
													</div>
												</div>
												<!--end col-->
												<div class="col-lg-4">
													<div class="steps-title mmb-10">
														<div class="mb-3">
															<label for="JoiningdatInput" class="form-label">Gender </label>
															<select name="activity_type" data-behavior="on_change_submit" class="form-select" id="choices-publish-status-input" data-choices="" data-choices-search-false="">
																<option value=""> Male </option>
																<option value="">Female</option>
																<option value="">Other</option>
															</select>
														</div>
													</div>
												</div>
												<!--end col-->
												<div class="col-lg-8">
													<div class="mb-3">
														<label for="addInput" class="form-label">Address</label>
														<input type="text" class="form-control" id="addInput" placeholder="City" value="2063 broadaway" />
													</div>
												</div>
												<!--end col-->
												<div class="col-lg-4">
													<div class="mb-3">
														<label for="cityInput" class="form-label">City</label>
														<input type="text" class="form-control" id="cityInput" placeholder="City" value="New York" />
													</div>
												</div>
												<!--end col-->
												<div class="col-lg-4">
													<div class="mb-3">
														<label for="cityInput" class="form-label">State</label>
														<input type="text" class="form-control" id="cityInput" placeholder="State" value="New York" />
													</div>
												</div>                                                    
												<!--end col-->
												<div class="col-lg-4">
													<div class="mb-3">
														<label for="countryInput" class="form-label">Country</label>
														<input type="text" class="form-control" id="countryInput" placeholder="Country" value="United States" />
													</div>
												</div>
												<!--end col-->
												<div class="col-lg-4">
													<div class="mb-3">
														<label for="zipcodeInput" class="form-label">Zip Code</label>
														<input type="text" class="form-control" minlength="5" maxlength="6" id="zipcodeInput" placeholder="Enter zipcode" value="90011">
													</div>
												</div>
												<!--end col-->
												<div class="col-lg-8">
													<div class="mb-3">
														<label for="zipcodeInput" class="form-label">Favorite Activities </label>
														<input type="text" class="form-control" minlength="5" maxlength="6" id="zipcodeInput" placeholder="Favorite Activities" value="Football, Baseball, Kickboxing, MMA, Yoga">
													</div>
												</div>
												<!--end col-->
												<div class="col-lg-12">
													<div class="mb-3 pb-2">
														<label for="exampleFormControlTextarea" class="form-label">About </label>
														<textarea class="form-control" id="exampleFormControlTextarea" placeholder="Enter your description" rows="3">Born and raised in Madeira, Ronaldo began his senior club career playing for Sporting CP, before signing with Manchester United in 2003, aged 18.</textarea>
														<span class="float-right" id="business_info_count">
															<span id="display_count_business">145</span> words. Words left : <span id="word_left_business">855</span>
														</span>
													</div>
												</div>
												<!--end col-->
												<div class="col-lg-12">
													<div class="mb-3 pb-2">
														<label for="exampleFormControlTextarea" class="form-label">Quick Intro </label>
														<textarea class="form-control" id="exampleFormControlTextarea" placeholder="Enter your description" rows="3">Cristiano Ronaldo dos Santos Aveiro GOIH ComM is a Portuguese professional footballer who plays as</textarea>
														<span class="float-right mb-3" id="quick_intro_count">
															<span id="display_count">98</span>
															words. Words left : <span id="word_left">102</span>
														</span>
													</div>
												</div>
												<!--end col-->
												<div class="col-lg-12">
													<div class="hstack gap-2 justify-content-end">
														<button type="submit" class="btn btn-red">Updates</button>
													</div>
												</div>
												<!--end col-->
											</div>
											<!--end row-->
										</form>
                                    </div>
									<!--end tab-pane-->
									<div class="tab-pane" id="changePassword" role="tabpanel">
										<form action="javascript:void(0);">
											<div class="row g-2">
												<div class="col-lg-4">
													<div>
														<label for="oldpasswordInput" class="form-label">Old Password*</label>
														<input type="password" class="form-control" id="oldpasswordInput" placeholder="Enter current password">
													</div>
												</div>
												<!--end col-->
												<div class="col-lg-4">
													<div>
														<label for="newpasswordInput" class="form-label">New Password*</label>
														<input type="password" class="form-control" id="newpasswordInput" placeholder="Enter new password">
													</div>
												</div>
												<!--end col-->
												<div class="col-lg-4">
													<div>
														<label for="confirmpasswordInput" class="form-label">Confirm Password*</label>
														<input type="password" class="form-control" id="confirmpasswordInput" placeholder="Confirm password">
													</div>
												</div>
												<!--end col-->
												<div class="col-lg-12">
													<div class="text-end">
														<button type="submit" class="btn btn-red">Change Password</button>
													</div>
												</div>
												<!--end col-->
											</div>
											<!--end row-->
										</form>
									</div>
									<!--end tab-pane-->
                                    <div class="tab-pane" id="cardInfo" role="tabpanel">
										<div class="row">
											<div class="col-lg-3 col-sm-6">
												<div class="cards-block dispalycard" style="cursor: pointer" data-name="" data-cvv="" data-cnumber="4444" data-month="2" data-year="2032" data-type="mastercard" data-id="229" data-ptype="update">
													<div class="cards-content" style="background-image: url(http://dev.fitnessity.co/public/img/visa-card-bg.jpg );">
														<img src="http://dev.fitnessity.co/public/images/creditcard/mastercard.jpg" alt="">
														<span></span>
														<p>Mastercard</p>
														<span>
															<span class="dots"></span><span class="dots"></span><span class="dots"></span><span class="dots"></span>4444 
														</span>

														<a class="float-end card-remove" data-behavior="delete_card" data-url="http://dev.fitnessity.co/personal-profile/payment-delete?stripe_payment_method=pm_1NUpDaCr65ASmcsqjbOLg8bH" data-cardid="229" title="Delete Card" class="delCard">
															<i class="fa fa-trash"></i> 
														</a>
													</div>
												</div>
											</div>
									
											<div class="col-lg-3 col-sm-6">
												<div class="cards-block dispalycard" style="cursor: pointer" data-name="" data-cvv="" data-cnumber="4242" data-month="2" data-year="2024" data-type="visa" data-id="176" data-ptype="update">
													<div class="cards-content" style="background-image: url(http://dev.fitnessity.co/public/img/visa-card-bg.jpg );">
														<img src="http://dev.fitnessity.co/public/images/creditcard/visa.jpg" alt="">
														<span style="float:right"></span>
														<p>Visa</p>
														<span>
															<span class="dots"></span><span class="dots"></span><span class="dots"></span><span class="dots"></span>4242 
														</span>

														<a class="float-end card-remove" data-behavior="delete_card" data-url="http://dev.fitnessity.co/personal-profile/payment-delete?stripe_payment_method=pm_1N0OpoCr65ASmcsq59sxzvJC" data-cardid="176" title="Delete Card" class="delCard"><i class="fa fa-trash"></i> </a>
													</div>
												</div>
											</div>
									
											<div class="col-lg-3 col-sm-6">
												<div class="cards-block dispalycard" style="cursor: pointer" data-name="" data-cvv="" data-cnumber="8431" data-month="2" data-year="2036" data-type="amex" data-id="130" data-ptype="update">
													<div class="cards-content" style="background-image: url(http://dev.fitnessity.co/public/img/visa-card-bg.jpg );">
														<img src="http://dev.fitnessity.co/public/images/creditcard/amex.jpg" alt="">
														<span style="float:right"></span>
														<p>Amex</p>
														<span>
															<span class="dots"></span><span class="dots"></span><span class="dots"></span><span class="dots"></span>8431 
														</span>

														<a class="float-end card-remove" data-behavior="delete_card" data-url="http://dev.fitnessity.co/personal-profile/payment-delete?stripe_payment_method=pm_1Mw2jmCr65ASmcsqzrsPfU4t" data-cardid="130" title="Delete Card" class="delCard"><i class="fa fa-trash"></i> </a>
													</div>
												</div>
											</div>
									
											<div class="col-lg-3 col-sm-6">
												<div class="cards-block dispalycard" style="cursor: pointer" data-name="" data-cvv="" data-cnumber="5556" data-month="2" data-year="2058" data-type="visa" data-id="121" data-ptype="update">
													<div class="cards-content" style="background-image: url(http://dev.fitnessity.co/public/img/visa-card-bg.jpg );">
														<img src="http://dev.fitnessity.co/public/images/creditcard/visa.jpg" alt="">
														<span style="float:right"></span>
														<p>Visa</p>
														<span>
															<span class="dots"></span><span class="dots"></span><span class="dots"></span><span class="dots"></span>5556 
														</span>

														<a class="float-end card-remove" data-behavior="delete_card" data-url="http://dev.fitnessity.co/personal-profile/payment-delete?stripe_payment_method=pm_1Mw2gLCr65ASmcsqdbN8Shj6" data-cardid="121" title="Delete Card" class="delCard"><i class="fa fa-trash"></i> </a>
													</div>
												</div>
											</div>
									
											<div class="col-lg-3 col-sm-6">
												<div class="cards-block dispalycard" style="cursor: pointer" data-name="" data-cvv="" data-cnumber="8210" data-month="2" data-year="2040" data-type="mastercard" data-id="111" data-ptype="update">
													<div class="cards-content" style="background-image: url(http://dev.fitnessity.co/public/img/visa-card-bg.jpg );">
														<img src="http://dev.fitnessity.co/public/images/creditcard/mastercard.jpg" alt="">
														<span style="float:right"></span>
														<p>Mastercard</p>
														<span>
															<span class="dots"></span><span class="dots"></span><span class="dots"></span><span class="dots"></span>8210 
														</span>

														<a class="float-end card-remove" data-behavior="delete_card" data-url="http://dev.fitnessity.co/personal-profile/payment-delete?stripe_payment_method=pm_1Mw2aACr65ASmcsqyEo8vjqs" data-cardid="111" title="Delete Card" class="delCard"><i class="fa fa-trash"></i> </a>
													</div>
												</div>
											</div>
									
											<div class="col-lg-3 col-sm-6">
												<div class="cards-block dispalycard" style="cursor: pointer" data-name="" data-cvv="" data-cnumber="1113" data-month="2" data-year="2050" data-type="discover" data-id="90" data-ptype="update">
													<div class="cards-content" style=" background-image: url(http://dev.fitnessity.co/public/img/visa-card-bg.jpg );">
														<img src="http://dev.fitnessity.co/public/images/creditcard/discover.jpg" alt="">
														<span style="float:right"></span>
														<p>Discover</p>
														<span>
															<span class="dots"></span><span class="dots"></span><span class="dots"></span><span class="dots"></span>1113 
														</span>

														<a class="float-end card-remove" data-behavior="delete_card" data-url="http://dev.fitnessity.co/personal-profile/payment-delete?stripe_payment_method=pm_1MpRLZCr65ASmcsqWiLKPGuE" data-cardid="90" title="Delete Card" class="delCard"><i class="fa fa-trash"></i> </a>
													</div>
												</div>
											</div>
									
											<div class="col-lg-3 col-sm-6">
												<div class="cards-block addcard" style="cursor: pointer" data-name="" data-cvv="" data-cnumber="" data-month="" data-year="" data-type="" data-ptype="insert">
													<div class="cards-content" style=" background-image: url(http://dev.fitnessity.co/public/img/visa-card-bg.jpg);">
														<span style="text-align: center">Add New Card</span>
													</div>
												</div>
											</div>
										</div>
									</div>
									<div class="tab-pane" id="paymenthistory" role="tabpanel">
										<div class="item-history mt-25">
											<div class="table-responsive">
												<table id="historyTable" class="table mb-25" style="width: 100%">
													<thead>
														<tr>
															<th>Sale Date </th>
															<th>Item Description </th>
															<th>Item Type</th>
															<th>Pay Method</th>
															<th>Price</th>
															<th>Qty</th>
															<th>Refund/Void</th>
															<th>Receipt</th>
														</tr>
													</thead>
													<tbody id="tbodydetail">
														<tr>
															<td>06/30/2023</td>
															<td>1. Spring Lake Day Camp (Summer Camp Full Day) ,1 Day Full Camp<br></td>
															<td>Membership</td>
															<td>cash</td>
															<td>$50</td>
															<td>1</td>
															<td>Refund | Void</td>
															<td><a class="mailRecipt" data-behavior="send_receipt" data-url="http://dev.fitnessity.co/receiptmodel/1057/380" data-item-type="Membership" data-modal-width="1200px"><i class="far fa-file-alt" aria-hidden="true"></i></a>
															</td>
														</tr>
														<tr>
															<td>06/26/2023</td>
															<td>1. Spring Lake Day Camp (Summer Camp Full Day) ,1 Day Full Camp<br></td>
															<td>Membership</td>
															<td>visa ****4242</td>
															<td>$56.94</td>
															<td>1</td>
															<td>Refund | Void</td>
															<td><a class="mailRecipt" data-behavior="send_receipt" data-url="http://dev.fitnessity.co/receiptmodel/1050/720" data-item-type="Membership" data-modal-width="900px"><i class="far fa-file-alt" aria-hidden="true"></i></a></td>
														</tr>
														<tr>
															<td>06/20/2023</td>
															<td>1. Love Tennis (Private Lessons 30 Min. (1 Person)) ,30 Minute Private (01 Pack)<br></td>
															<td>Membership</td>
															<td>discover ****1113</td>
															<td>$91.1</td>
															<td>1</td>
															<td>Refund | Void</td>
															<td><a class="mailRecipt" data-behavior="send_receipt" data-url="http://dev.fitnessity.co/receiptmodel/1035/720" data-item-type="Membership" data-modal-width="900px"><i class="far fa-file-alt" aria-hidden="true"></i></a></td>
														</tr>
														<tr>
															<td>06/20/2023</td>
															<td>1. Love Tennis (Private Lessons 30 Min. (1 Person)) ,30 Minute Private (01 Pack)<br></td>
															<td>Membership</td>
															<td>mastercard ****3222</td>
															<td>$150.73</td>
															<td>1</td>
															<td>Refund | Void</td>
															<td><a class="mailRecipt" data-behavior="send_receipt" data-url="http://dev.fitnessity.co/receiptmodel/1029/720" data-item-type="Membership" data-modal-width="900px"><i class="far fa-file-alt" aria-hidden="true"></i></a></td>
														</tr>
														<tr>
															<td>06/20/2023</td>
															<td>1. Love Tennis (Private Lessons 30 Min. (1 Person)) ,30 Minute Private (01 Pack)<br></td>
															<td>Membership</td>
															<td>mastercard ****3222</td>
															<td>$95.21</td>
															<td>1</td>
															<td>Refund | Void</td>
															<td><a class="mailRecipt" data-behavior="send_receipt" data-url="http://dev.fitnessity.co/receiptmodel/1027/720" data-item-type="Membership" data-modal-width="900px"><i class="far fa-file-alt" aria-hidden="true"></i></a></td>
														</tr>
														<tr>
															<td>05/24/2023</td>
															<td>1. Go Golfers (global acdamy) ,30 Minute Private (01 Pack)<br></td>
															<td>Membership</td>
															<td>discover ****1113</td>
															<td>$10.39</td>
															<td>1</td>
															<td>Refund | Void</td>
															<td><a class="mailRecipt" data-behavior="send_receipt" data-url="http://dev.fitnessity.co/receiptmodel/1011/720" data-item-type="Membership" data-modal-width="900px"><i class="far fa-file-alt" aria-hidden="true"></i></a></td>
														</tr>
														<tr>
															<td>05/11/2023</td>
															<td>1. Summer Camp at Valor (Summer Camp Full Day (8:30 am to 3:00 pm)) ,1 Day Full Camp<br>2. Love Tennis (Private Lessons 30 Min. (1 Person)) ,30 Minute Private (01 Pack)<br></td>
															<td>Membership</td>
															<td>visa ****4242</td>
															<td>$241.22</td>
															<td>2</td>
															<td>Refund | Void</td>
															<td><a class="mailRecipt" data-behavior="send_receipt" data-url="http://dev.fitnessity.co/receiptmodel/1009/720" data-item-type="Membership" data-modal-width="900px"><i class="far fa-file-alt" aria-hidden="true"></i></a></td>
														</tr>
														<tr>
															<td>05/06/2023</td>
															<td>1. Summer Aerobics (Solo Private Lessons) ,30 Minutes<br></td>
															<td>Membership</td>
															<td>mastercard ****3222</td>
															<td>$10.39</td>
															<td>1</td>
															<td>Refund | Void</td>
															<td><a class="mailRecipt" data-behavior="send_receipt" data-url="http://dev.fitnessity.co/receiptmodel/1008/720" data-item-type="Membership" data-modal-width="900px"><i class="far fa-file-alt" aria-hidden="true"></i></a></td>
														</tr>
														<tr>
															<td>05/06/2023</td>
															<td>1. Summer Camp at Valor (Summer Camp Full Day (8:30 am to 3:00 pm)) ,1 Day Full Camp<br></td>
															<td>Membership</td>
															<td>mastercard ****3222</td>
															<td>$155.81</td>
															<td>1</td>
															<td>Refund | Void</td>
															<td><a class="mailRecipt" data-behavior="send_receipt" data-url="http://dev.fitnessity.co/receiptmodel/1007/720" data-item-type="Membership" data-modal-width="900px"><i class="far fa-file-alt" aria-hidden="true"></i></a></td>
														</tr>
														<tr>
															<td>05/06/2023</td>
															<td>1. Summer Camp at Valor (Summer Camp Full Day (8:30 am to 3:00 pm)) ,1 Day Full Camp<br></td>
															<td>Membership</td>
															<td>mastercard ****8210</td>
															<td>$155.81</td>
															<td>1</td>
															<td>Refund | Void</td>
															<td><a class="mailRecipt" data-behavior="send_receipt" data-url="http://dev.fitnessity.co/receiptmodel/1006/720" data-item-type="Membership" data-modal-width="900px"><i class="far fa-file-alt" aria-hidden="true"></i></a></td>
														</tr>
													</tbody>
												</table>
												<div class="float-right">
													<nav>
														<ul class="pagination">
															<li class="page-item">
																<a class="page-link" href="#" rel="prev" aria-label="« Previous">‹</a>
															</li>
															<li class="page-item">
																<a class="page-link" href="#">1</a>
															</li>
															<li class="page-item active" aria-current="page">
																<span class="page-link">2</span>
															</li>
															<li class="page-item">
																<a class="page-link" href="#">3</a>
															</li>
															<li class="page-item">
																<a class="page-link" href="#">4</a>
															</li>
															<li class="page-item">
																<a class="page-link" href="#">5</a>
															</li>
															<li class="page-item">
																<a class="page-link" href="#" rel="next" aria-label="Next »">›</a>
															</li>
														</ul>
													</nav>
												</div>
											</div>
										</div>
									</div>
                                      
								</div>
							</div>
						</div>
					</div>
					<!--end col-->
				</div><!--end row-->
            </div><!-- container-fluid -->
        </div><!-- End Page-content -->
     </div><!-- end main content-->
</div><!-- END layout-wrapper -->



</div>	
	
	@include('layouts.business.footer')
	<script>
		flatpickr(".flatpickr-range", {
	        dateFormat: "m/d/Y",
	        maxDate: "01/01/2050",
			defaultDate: [new Date()],
	     });
		 
		 flatpickr(".flatpickr-range-birthdate", {
	        dateFormat: "m/d/Y",
	        maxDate: "01/01/2050",
			defaultDate: [new Date()],
	     });
		 
	</script>

@endsection