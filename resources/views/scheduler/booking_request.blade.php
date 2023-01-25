@extends('layouts.header')
@section('content')
@include('layouts.userHeader')


<div class="p-0 col-md-12 inner_top padding-0">
    <div class="row">
        <div class="col-md-2" style="background: black;">
           @include('business.businessSidebar')
        </div>

        <div class="col-md-10 nopadding">   
			<div class="container-fluid no-padding">
				<div class="row">
					<div class="col-md-3">
						<div class="message-users">
							<div class="message-head">
								<i class="fas fa-bars"></i><h4>All messages</h4>
							</div>
							<div class="message-people-srch">
								<form method="post">
									<input type="text" placeholder="Search inbox">
									<button type="submit"><i class="fa fa-search"></i></button>
								</form>
							</div>
							<div class="mesg-peple">
								<ul class="nav nav-tabs nav-tabs--vertical msg-pepl-list ps-container ps-theme-default ps-active-y" data-ps-id="5183734a-f799-1f19-d3da-6b0a632c644a">
									<li class="nav-item unread">
										<a class="" href="#" data-toggle="tab">
											<figure><span> B </span></figure>
											<div class="user-name-chat">
												<label> Not Possible </label> 
												<h3 class="chat-date">Oct 18</h3>
												<h6 class="">B</h6>
												<span>you: what dates? Can you make a </span>
												<span>Sep 18-22 Newly renovated 3..</span>
											</div>
										</a>
									</li>
									<li class="nav-item">
										<a class="" href="#" data-toggle="tab">
											<figure><span> A </span></figure>
											<div class="user-name-chat">
												<h6 class="unread">Airbnb Support</h6>
												<h3 class="chat-date">Sep 24</h3>
												<span></span>
												<span>Do you still need help?</span>
											</div>
										</a>
									</li>
									<li class="nav-item">
										<a class="active" href="#" data-toggle="tab">
											<figure><img src="http://dev.fitnessity.co/public/uploads/profile_pic/thumb/1669274706-1650612371-20.jpg" alt="">
											</figure>
											<div class="user-name-chat">
												<label class="green-fonts"> Past guest </label> 
												<h6 class="unread">Jonasiah Monteau</h6>
												<span>Airbnb update: Reminder - Leave a</span>
												<span>Sep 22 - 24 Newly renovated 3..</span>
											</div>
											<div class="more">
												<div class="more-post-optns"><i class="fas fa-ellipsis-h"></i>
													<ul>
														<li><i class="fa fa-bell-slash-o"></i>Mute</li>
														<li><i class="ti-trash"></i>Delete</li>
														<li><i class="fa fa-folder-open-o"></i>Archive</li>
														<li><i class="fa fa-ban"></i>Block</li>
														<li><i class="fa fa-eye-slash"></i>Ignore Message</li>
														<li><i class="fa fa-envelope"></i>Mark Unread</li>
													</ul>
												</div>
											</div>
										</a>
									</li>
									<li class="nav-item">
										<a class="" href="#" data-toggle="tab">
											<figure><span> I </span></figure>
											<div class="user-name-chat">
												<label> Not Possible </label> 
												<h3 class="chat-date">Sep 13</h3>
												<h6 class="">Isaish</h6>
												<span>Airbnb update: Inquiry sent</span>
												<span>Sep13 - 18 Newly renivated 3</span>
											</div>
										</a>
									</li>
									<li class="nav-item">
										<a class="" href="#" data-toggle="tab">
											<figure><span> K </span></figure>
											<div class="user-name-chat">
												<label> Not Possible </label> 
												<h3 class="chat-date">Aug 09</h3>
												<h6 class="">Kapo</h6>
												<span>New event</span>
												<span>Aug 27 - 28 Newly renovated 3..</span>
											</div>
										</a>
									</li>
									<li class="nav-item">
										<a class="" href="#" data-toggle="tab">
											<figure><span> L </span></figure>
											<div class="user-name-chat">
												<label> Not Possible </label> 
												<h3 class="chat-date">Sep 13</h3>
												<h6 class="">Lacrecia</h6>
												<span>You: This is a new listing set about </span>
												<span>Aug 26 - 28 Newly renovated 3</span>
											</div>
										</a>
									</li>		
							</div>
						</div>
					</div>
						
					<div class="col-md-6 sepretor-line">
						<div class="row">
							<div class="col-md-6">
								<div class="mesg-area-head">
									<h6>Jonasiah</h6>
								</div>
							</div>
							<div class="col-md-6">
								<ul class="live-calls">
									<li class="audio-call"><span class="fas fa-comment-alt"></span></li>
									<li class="video-call"><span class="fas fa-star"></span></li>
									<li class="uzr-info"><span class="fas fa-box"></span></li>
								</ul>
							</div>
							<div class="col-md-12">	
								<div class="chat-last-date">
									<span>Sep 18,2022</span>
								</div>
							</div>
							<div class="col-md-12">
								<div class="chat-notice">
									<label> <i class="fas fa-flag"></i> </label>
									<span>To protect your payment, always communicate and pay through the Airbnb website or app.</span>
								</div>
								<div class="chat-notice">
									<label> <i class="fas fa-flag second-flag"></i> </label>
									<span>Booking confirmed - 3 guests, Sep 22 - Sep 24</span>
								</div>
							</div>
							<div class="col-md-12">	
								<div class="chat-last-date present-date">
									<span>Sep 22,2022</span>
								</div>
							</div>
							<div class="mesge-area">
								<ul class="conversations ps-container ps-theme-default ps-active-y" data-ps-id="a09f1cee-be3a-4828-9010-a253f1c03544">
									<li>
										<figure><img src="http://dev.fitnessity.co/public/uploads/profile_pic/thumb/1669274706-1650612371-20.jpg" alt=""></figure>
										<div class="text-box">
											<label>Jonasiah <span> 2:32PM</span></label>
											<p>Hey I'm trying to open this lockbox can you explain how to open it I put in the code</p>
										</div>
									</li>
									<li class="me">
										<figure><img src="/public/images/newimage/bus-experience.png" alt=""></figure>
										<div class="text-box">
											<label>Darryl <span> 2:32PM</span></label>
											<p>Hey! Please give me a call at 929-351-1258 again</p>
										</div>
									</li>
								</ul>
							</div>
							<div class="message-writing-box">
								<form method="post">
									<div class="chatbox-emojis">
										<div class="browse">
											<i class="fas fa-plus-circle"></i>
										</div>
										<div class="attach-file">
											<label class="fileContainer">
												<i class="fas fa-image"></i>
												<input type="file">
											</label>
										</div>
										<div class="chat">
											<i class="fas fa-comments"></i>
										</div>
									</div>
									<div class="text-area">
										<input type="text" placeholder="Type a message">
									</div>
									
								</form>
							</div>
						</div>
					</div>
					
					<div class="col-md-3">	
						<div class="row">
							<div class="col-md-12">
								<div class="right-bar-title">
									<h6>Booking Details</h6> 
									<i class="fas fa-times"></i>
								</div>
							</div>
							<div class="col-md-12">
								<div class="new-client-info">
									<figure>
			            				<img src="http://dev.fitnessity.co/public/uploads/profile_pic/thumb/1669274706-1650612371-20.jpg" alt="Fitnessity">
			                		</figure>
									<div class="page-meta">
										<label> New Client </label>
										<a href="#" title="" >Eric <span>(32 Years Old)</span> </a>
										<p>This clients full name, contact information and more will be shared after the booking is confirmed</p>
										<p>You have 24 hrs to respond  to this booking request..</p>
									</div>
								</div>
							</div>
							<div class="col-md-12">
								<div class="request-to-book">
									<h6>Quick Breakdown for your Request to Book </h6>
								</div>
								<div class="bottom-sepretor">
									<div class="row ">
										<div class="col-md-6">
											<label>Activity:</label>
										</div>
										<div class="col-md-6">
											<div class="fill-booking">
												<span>MMA</span>
											</div>
										</div>
										<div class="col-md-6">
											<label>Program Name:</label>
										</div>
										<div class="col-md-6">
											<div class="fill-booking">
												<span>Push further faster with Private lessons</span>
											</div>
										</div>
										<div class="col-md-6">
											<label>Category:</label>
										</div>
										<div class="col-md-6">
											<div class="fill-booking">
												<span>Private Lesson 45</span>
											</div>
										</div>
										
										<div class="col-md-6">
											<label>Membership Type: </label>
										</div>
										<div class="col-md-6">
											<div class="fill-booking">
												<span>Drop In</span>
											</div>
										</div>
										
										<div class="col-md-6">
											<label>Price Option: </label>
										</div>
										<div class="col-md-6">
											<div class="fill-booking">
												<span>45 Minute Private </span>
											</div>
										</div>
										
										<div class="col-md-6">
											<label>Neighborhood:</label>
										</div>
										<div class="col-md-6">
											<div class="fill-booking">
												<span>Upper West Side </span>
											</div>
										</div>
										
										<div class="col-md-6">
											<label>Language:</label>
										</div>
										<div class="col-md-6">
											<div class="fill-booking">
												<span>English </span>
											</div>
										</div>
										
										<div class="col-md-6">
											<label>Location:</label>
										</div>
										<div class="col-md-6">
											<div class="fill-booking">
												<span>New York</span>
											</div>
										</div>
										
										<div class="col-md-6">
											<label>Travel: </label>
										</div>
										<div class="col-md-6">
											<div class="fill-booking bottom-sepretor-sp">
												<span>Client will travel to trainer if need</span>
											</div>
										</div>
									</div>
								</div>
							</div>
							
							<div class="col-md-12">
								<div class="request-to-book">
									<h6>Booking Details</h6>
								</div>
								<div class="bottom-sepretor">
									<div class="row ">
										<div class="col-md-6">
											<label>Booking Request Date:</label>
										</div>
										<div class="col-md-6">
											<div class="fill-booking">
												<span>12/23/2022</span>
											</div>
										</div>
										<div class="col-md-6">
											<label>Requested Timeslot:</label>
										</div>
										<div class="col-md-6">
											<div class="fill-booking">
												<span>9:00am to 10:00 am</span>
											</div>
										</div>
										<div class="col-md-6">
											<label>Participant:</label>
										</div>
										<div class="col-md-6">
											<div class="fill-booking">
												<span>1 Customer</span>
											</div>
										</div>
										
										<div class="col-md-6">
											<label>Price:</label>
										</div>
										<div class="col-md-6">
											<div class="fill-booking">
												<span>$95</span>
											</div>
										</div>
									</div>
								</div>
							</div>
							
							<div class="col-md-12">
								<div class="request-to-book">
									<h6>Your Potential Earnings</h6>
								</div>
								<div class="bottom-sepretor">
									<div class="row ">
										<div class="col-md-6">
											<label>$95   x 1 Adult <br>
														 x 0 Children<br>
														 x 0 Infants</label>
										</div>
										<div class="col-md-6">
											<div class="fill-booking">
												<span>$95</span>
											</div>
										</div>
										<div class="col-md-6">
											<label>Service fee</label>
										</div>
										<div class="col-md-6">
											<div class="fill-booking">
												<span>$14.25</span>
											</div>
										</div>
										<div class="col-md-6">
											<label>Total (USD)</label>
										</div>
										<div class="col-md-6">
											<div class="fill-booking">
												<span>Total $80.75 (USD)</span>
											</div>
										</div>
									</div>
								</div>
							</div>
							
							<div class="col-md-12">
								<div clas="confirmed-bookings">
									<p>To get started, We you need to Confirm, Pass or Offer another time and date to book</p>
								</div>
								<div class="adjust-bnts">
									<button type="button" class="btn-nxt btn-size">Confirm</button>
									<button type="button" class="btn-nxt btn-size">Pass</button>
									<button type="button" class="btn-nxt btn-size">Offer</button>
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