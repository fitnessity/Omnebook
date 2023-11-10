@inject('request', 'Illuminate\Http\Request')

@extends('layouts.business.header')

@section('content')

	@include('layouts.business.business_topbar')
	<!-- ============================================================== -->
    <!-- Start right Content here -->
    <!-- ============================================================== -->
    <div class="main-content">
		<div class="page-content">
			<div class="container-fluid">
				<div class="chat-wrapper d-lg-flex gap-1 mx-n4 mt-n4 p-1">
					<div class="width-25per width-100per">
                        <div class="chat-leftsidebar">
                            <div class="px-4 pt-4 mb-4">
                                <div class="d-flex align-items-start">
                                    <div class="flex-grow-1">
                                        <h5 class="mb-4">Search Chats</h5>
                                    </div>
                                    <div class="flex-shrink-0">
                                        <div data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="bottom" title="Add Contact">

                                            <!-- Button trigger modal -->
                                            <button type="button" class="btn btn-soft-success btn-sm shadow-none">
                                                <i class="ri-add-line align-bottom"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                <div class="search-box">
                                    <input type="text" class="form-control bg-light border-light" placeholder="Search by client name or staff name">
                                    <i class="ri-search-2-line search-icon"></i>
                                </div>

                            </div> <!-- .p-4 -->

                            <ul class="nav nav-tabs nav-tabs-custom nav-success nav-justified" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" data-bs-toggle="tab" href="#chats" role="tab">
                                       All Chats
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-bs-toggle="tab" href="#client" role="tab">
                                       Client
                                    </a>
                                </li>
								<li class="nav-item">
                                    <a class="nav-link" data-bs-toggle="tab" href="#staff" role="tab">
                                       Staff
                                    </a>
                                </li>
                            </ul>

                            <div class="tab-content text-muted">
                                <div class="tab-pane active" id="chats" role="tabpanel">
                                    <div class="chat-room-list pt-3" data-simplebar style="max-height: calc(180vh - 308px);">
                                        <div class="d-flex align-items-center px-4 mb-2">
                                            <div class="flex-grow-1">
                                                <h4 class="mb-0 fs-11 text-muted text-uppercase">Direct Messages</h4>
                                            </div>
                                            <div class="flex-shrink-0">
                                                <div data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="bottom" title="New Message">
        
                                                    <!-- Button trigger modal -->
                                                    <button type="button" class="btn btn-soft-success btn-sm">
                                                        <i class="ri-add-line align-bottom"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
        
                                        <div class="chat-message-list">
                                           <ul class="list-unstyled chat-list chat-user-list" id="userList">
												<li id="contact-id-1" data-name="direct-message" class="active">	
													<a href="javascript: void(0);">
														<div class="d-flex align-items-center">                    
															<div class="flex-shrink-0 chat-user-img online align-self-center me-2 ms-0">                        
																<div class="avatar-xxs chats-person-img">
																	<img src="https://fitnessity-production.s3.amazonaws.com/customer/IUwmNesKNJtrlzkSgjex1bzQoXhtvteofsrr44qQ.jpg" class="rounded-circle img-fluid userprofile" alt="">
																	<span class="user-status"></span>
																</div>
															</div>                    
															<div class="flex-grow-1 overflow-hidden">	
																<p class="text-truncate mb-0">Lisa Parker (Staff)</p>
															</div>
														</div>
													</a>
												</li>
											
												<li id="contact-id-2" data-name="direct-message" class="">
													<a href="javascript: void(0);" class="unread-msg-user">
														<div class="d-flex align-items-center">
															<div class="flex-shrink-0 chat-user-img online align-self-center me-2 ms-0">
																<div class="avatar-xxs chats-person-img">
																	<img src="https://fitnessity-production.s3.amazonaws.com/activity/5gmokEA2e4XKU4TSPDErZfFKJyYImLAVbVwXQHlk.jpg" class="rounded-circle img-fluid userprofile" alt=""><span class="user-status"></span>
																</div>
															</div>
															<div class="flex-grow-1 overflow-hidden">
																<p class="text-truncate mb-0">Frank Thomas</p>
															</div>
															<div class="ms-auto">
																<span class="badge bg-dark-subtle font-red rounded p-1">8</span>
															</div>
														</div>
													</a>
												</li>
											
												<li id="contact-id-3" data-name="direct-message" class="">
													<a href="javascript: void(0);">
														<div class="d-flex align-items-center">
															<div class="flex-shrink-0 chat-user-img away align-self-center me-2 ms-0">
																<div class="avatar-xxs">
																	<div class="avatar-title rounded-circle bg-primary text-white fs-10">CT</div>
																	<span class="user-status"></span>
																</div>
															</div>
															<div class="flex-grow-1 overflow-hidden">
																<p class="text-truncate mb-0">Clifford Taylor</p>
															</div>
														</div>
													</a>
												</li>
											
												<li id="contact-id-4" data-name="direct-message" class="">
													<a href="javascript: void(0);">
														<div class="d-flex align-items-center">
															<div class="flex-shrink-0 chat-user-img online align-self-center me-2 ms-0">
																<div class="avatar-xxs chats-person-img">
																	<img src="http://dev.fitnessity.co/public/uploads/discover/thumb/1649648481-yoga classes.jpg" class="rounded-circle img-fluid userprofile" alt="">
																	<span class="user-status"></span>
																</div>
															</div>
															<div class="flex-grow-1 overflow-hidden">
																<p class="text-truncate mb-0">Janette Caster</p>
															</div>
														</div>
													</a>
												</li>
											
												<li id="contact-id-5" data-name="direct-message" class="">
													<a href="javascript: void(0);" class="unread-msg-user">
														<div class="d-flex align-items-center">
															<div class="flex-shrink-0 chat-user-img online align-self-center me-2 ms-0">
																<div class="avatar-xxs chats-person-img">
																	<img src="https://fitnessity-production.s3.amazonaws.com/activity/0BONWLWRLmu672gJmdMvxmoVTIYgfey3X23klhXE.jpg" class="rounded-circle img-fluid userprofile" alt="">
																	<span class="user-status"></span>
																</div>
															</div>
															<div class="flex-grow-1 overflow-hidden">
																<p class="text-truncate mb-0">Sarah Beattie</p>
															</div>
															<div class="ms-auto">
																<span class="badge bg-dark-subtle font-red rounded p-1">5</span>
															</div>
														</div>
													</a>
												</li>
											
												<li id="contact-id-6" data-name="direct-message" class="">
													<a href="javascript: void(0);" class="unread-msg-user">
														<div class="d-flex align-items-center">	
															<div class="flex-shrink-0 chat-user-img away align-self-center me-2 ms-0">
																<div class="avatar-xxs chats-person-img">
																	<img src="https://fitnessity-production.s3.amazonaws.com/activity/zDXu7qaPJEW54B2lS75HJovDW0A56UhdT9bSRy0n.jpg" class="rounded-circle img-fluid userprofile" alt="">
																	<span class="user-status"></span>
																</div>
															</div>
															<div class="flex-grow-1 overflow-hidden">
																<p class="text-truncate mb-0">Nellie Cornett</p>
															</div>
															<div class="ms-auto">
																<span class="badge bg-dark-subtle font-red rounded p-1">2</span>
															</div>
														</div>
													</a>
												</li>
											
												<li id="contact-id-7" data-name="direct-message" class="">
													<a href="javascript: void(0);">
														<div class="d-flex align-items-center">
															<div class="flex-shrink-0 chat-user-img online align-self-center me-2 ms-0">
																<div class="avatar-xxs">
																	<div class="avatar-title rounded-circle bg-primary text-white fs-10">CK</div>
																	<span class="user-status"></span>
																</div>
															</div>
															<div class="flex-grow-1 overflow-hidden">
																<p class="text-truncate mb-0">Chris Kiernan</p>
															</div>
														</div>
													</a>
												</li>
											
												<li id="contact-id-8" data-name="direct-message" class="">
													<a href="javascript: void(0);">
														<div class="d-flex align-items-center">
															<div class="flex-shrink-0 chat-user-img away align-self-center me-2 ms-0">
																<div class="avatar-xxs">
																	<div class="avatar-title rounded-circle bg-primary text-white fs-10">EE</div>
																	<span class="user-status"></span>
																</div>
															</div>
															<div class="flex-grow-1 overflow-hidden">
																<p class="text-truncate mb-0">Edith Evans</p>
															</div>
														</div>
													</a>
												</li>
											
												<li id="contact-id-9" data-name="direct-message" class="">
													<a href="javascript: void(0);">
														<div class="d-flex align-items-center">
															<div class="flex-shrink-0 chat-user-img away align-self-center me-2 ms-0">
																<div class="avatar-xxs chats-person-img">
																	<img src="https://fitnessity-production.s3.amazonaws.com/activity/bKNSsvUN6bVxgbWaggKgcpyfaE1HOWlWPw82ZIoc.jpg" class="rounded-circle img-fluid userprofile" alt="">
																	<span class="user-status"></span>
																</div>
															</div>
															<div class="flex-grow-1 overflow-hidden">
																<p class="text-truncate mb-0">Joseph Siegel</p>
															</div>
														</div>
													</a>
												</li>
												
											</ul>
                                        </div>
        
        
                                        <div class="chat-message-list">
        
                                            <ul class="list-unstyled chat-list chat-user-list mb-0" id="channelList">
                                            </ul>
                                        </div>
                                        <!-- End chat-message-list -->
                                    </div>
                                </div>
                                <div class="tab-pane" id="client" role="tabpanel">
                                    <div class="chat-room-list pt-3" data-simplebar>
                                        <div class="sort-contact text-center">     
											<button class="btn btn-red">Message All Clients</button>
                                        </div>
                                    </div>
                                </div>
								<div class="tab-pane" id="staff" role="tabpanel">
                                    <div class="chat-room-list pt-3" data-simplebar>
                                        <div class="sort-contact text-center">   	
											<button class="btn btn-red"> Message All Staff</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- end tab contact -->
                        </div>
					</div>
                    <!-- end chat leftsidebar -->
                    <!-- Start User chat -->
					<div class="width-50per">
                        <div class="user-chat w-100 overflow-hidden">
                            <div class="chat-content d-lg-flex">
                                <!-- start chat conversation section -->
                                <div class="w-100 overflow-hidden position-relative">
                                    <!-- conversation user -->
                                    <div class="position-relative">
                                        <div class="position-relative" id="users-chat">
                                            <div class="p-3 user-chat-topbar">
                                                <div class="row align-items-center">
                                                    <div class="col-sm-4 col-8">
                                                        <div class="d-flex align-items-center">
                                                            <div class="flex-shrink-0 d-block d-lg-none me-3">
                                                                <a href="javascript: void(0);" class="user-chat-remove fs-18 p-1"><i class="ri-arrow-left-s-line align-bottom"></i></a>
                                                            </div>
                                                            <div class="flex-grow-1">
                                                                <div class="d-flex align-items-center">
                                                                    <div class="flex-shrink-0 chat-user-img online user-own-img align-self-center me-3 ms-0">
                                                                        <img src="https://fitnessity-production.s3.amazonaws.com/customer/IUwmNesKNJtrlzkSgjex1bzQoXhtvteofsrr44qQ.jpg" class="rounded-circle avatar-xs" alt="">
                                                                        <span class="user-status"></span>
                                                                    </div>
                                                                    <div class="flex-grow-1 ">
                                                                        <h5 class="text-truncate mb-0 fs-16"><a class="text-reset username" data-bs-toggle="offcanvas" href="#userProfileCanvasExample" aria-controls="userProfileCanvasExample">Lisa Parker (Staff)</a></h5>
                                                                        <p class="text-truncate text-muted fs-14 mb-0 userStatus"><small>Online</small></p>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-8 col-4">
                                                        <ul class="list-inline user-chat-nav text-end mb-0">
                                                            <li class="list-inline-item m-0">
                                                                <div class="dropdown">
                                                                    <button class="btn btn-ghost-secondary btn-icon shadow-none" type="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                        <i data-feather="search" class="icon-sm"></i>
                                                                    </button>
                                                                    <div class="dropdown-menu p-0 dropdown-menu-end dropdown-menu-lg">
                                                                        <div class="p-2">
                                                                            <div class="search-box">
                                                                                <input type="text" class="form-control bg-light border-light" placeholder="Search here..." onkeyup="searchMessages()" id="searchMessage">
                                                                                <i class="ri-search-2-line search-icon"></i>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </li>
    
                                                            <li class="list-inline-item d-none d-lg-inline-block m-0">
                                                                <button type="button" class="btn btn-ghost-secondary btn-icon shadow-none" data-bs-toggle="offcanvas" data-bs-target="#userProfileCanvasExample" aria-controls="userProfileCanvasExample">
                                                                    <i data-feather="info" class="icon-sm"></i>
                                                                </button>
                                                            </li>
    
                                                            <li class="list-inline-item m-0">
                                                                <div class="dropdown">
                                                                    <button class="btn btn-ghost-secondary btn-icon" type="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                        <i data-feather="more-vertical" class="icon-sm"></i>
                                                                    </button>
                                                                    <div class="dropdown-menu dropdown-menu-end">
                                                                        <a class="dropdown-item d-block d-lg-none user-profile-show" href="#"><i class="ri-user-2-fill align-bottom text-muted me-2"></i> View Profile</a>
                                                                        <a class="dropdown-item" href="#"><i class="ri-inbox-archive-line align-bottom text-muted me-2"></i> Archive</a>
                                                                        <a class="dropdown-item" href="#"><i class="ri-mic-off-line align-bottom text-muted me-2"></i> Muted</a>
                                                                        <a class="dropdown-item" href="#"><i class="ri-delete-bin-5-line align-bottom text-muted me-2"></i> Delete</a>
                                                                    </div>
                                                                </div>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
    
                                            </div>
                                            <!-- end chat user head -->
                                            <div class="chat-conversation p-3 p-lg-4 " id="chat-conversation" data-simplebar>
                                                <!--<div id="elmLoader">
                                                    <div class="spinner-border text-primary avatar-sm" role="status">
                                                        <span class="visually-hidden">Loading...</span>
                                                    </div>
                                                </div>-->
                                                <ul class="list-unstyled chat-conversation-list" id="users-conversation">
													<li class="chat-list left" id="1">                        <div class="conversation-list"><div class="chat-avatar"><img src="https://fitnessity-production.s3.amazonaws.com/customer/IUwmNesKNJtrlzkSgjex1bzQoXhtvteofsrr44qQ.jpg" alt=""></div><div class="user-chat-content"><div class="ctext-wrap"><div class="ctext-wrap-content" id="1"><p class="mb-0 ctext-content">Good morning 😊</p></div><div class="dropdown align-self-start message-box-drop">                <a class="dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">                    <i class="ri-more-2-fill"></i>                </a>                <div class="dropdown-menu" style="">                    <a class="dropdown-item reply-message" href="#"><i class="ri-reply-line me-2 text-muted align-bottom"></i>Reply</a>                    <a class="dropdown-item" href="#"><i class="ri-share-line me-2 text-muted align-bottom"></i>Forward</a>                    <a class="dropdown-item copy-message" href="#"><i class="ri-file-copy-line me-2 text-muted align-bottom"></i>Copy</a>                    <a class="dropdown-item" href="#"><i class="ri-bookmark-line me-2 text-muted align-bottom"></i>Bookmark</a>                    <a class="dropdown-item delete-item" href="#"><i class="ri-delete-bin-5-line me-2 text-muted align-bottom"></i>Delete</a>                </div>            </div></div><div class="conversation-name"><span class="d-none name">Lisa Parker</span><small class="text-muted time">09:07 am</small> <span class="text-success check-message-icon"><i class="bx bx-check-double"></i></span></div></div>                </div>            </li>
                                                    
                                                </ul>
                                                <!-- end chat-conversation-list -->
                                            </div>
                                            <div class="alert alert-warning alert-dismissible copyclipboard-alert px-4 fade show " id="copyClipBoard" role="alert">
                                                Message copied
                                            </div>
                                        </div>

                                        <div class="position-relative" id="channel-chat">
                                            <div class="p-3 user-chat-topbar">
                                            <div class="row align-items-center">
                                                <div class="col-sm-4 col-8">
                                                    <div class="d-flex align-items-center">
                                                        <div class="flex-shrink-0 d-block d-lg-none me-3">
                                                            <a href="javascript: void(0);" class="user-chat-remove fs-18 p-1"><i class="ri-arrow-left-s-line align-bottom"></i></a>
                                                        </div>
                                                        <div class="flex-grow-1 overflow-hidden">
                                                            <div class="d-flex align-items-center">
                                                                <div class="flex-shrink-0 chat-user-img online user-own-img align-self-center me-3 ms-0">
                                                                    <img src="https://fitnessity-production.s3.amazonaws.com/customer/IUwmNesKNJtrlzkSgjex1bzQoXhtvteofsrr44qQ.jpg" class="rounded-circle avatar-xs" alt="">
                                                                </div>
                                                                <div class="flex-grow-1 overflow-hidden">
                                                                    <h5 class="text-truncate mb-0 fs-16"><a class="text-reset username" data-bs-toggle="offcanvas" href="#userProfileCanvasExample" aria-controls="userProfileCanvasExample">Lisa Parker</a></h5>
                                                                    <p class="text-truncate text-muted fs-14 mb-0 userStatus"><small>24 Members</small></p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-8 col-4">
                                                    <ul class="list-inline user-chat-nav text-end mb-0">
                                                        <li class="list-inline-item m-0">
                                                            <div class="dropdown">
                                                                <button class="btn btn-ghost-secondary btn-icon" type="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                    <i data-feather="search" class="icon-sm"></i>
                                                                </button>
                                                                <div class="dropdown-menu p-0 dropdown-menu-end dropdown-menu-lg">
                                                                    <div class="p-2">
                                                                        <div class="search-box">
                                                                            <input type="text" class="form-control bg-light border-light" placeholder="Search here..." onkeyup="searchMessages()" id="searchMessage">
                                                                            <i class="ri-search-2-line search-icon"></i>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </li>

                                                        <li class="list-inline-item d-none d-lg-inline-block m-0">
                                                            <button type="button" class="btn btn-ghost-secondary btn-icon shadow-none" data-bs-toggle="offcanvas" data-bs-target="#userProfileCanvasExample" aria-controls="userProfileCanvasExample">
                                                                <i data-feather="info" class="icon-sm"></i>
                                                            </button>
                                                        </li>

                                                        <li class="list-inline-item m-0">
                                                            <div class="dropdown">
                                                                <button class="btn btn-ghost-secondary btn-icon shadow-none" type="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                    <i data-feather="more-vertical" class="icon-sm"></i>
                                                                </button>
                                                                <div class="dropdown-menu dropdown-menu-end">
                                                                    <a class="dropdown-item d-block d-lg-none user-profile-show" href="#"><i class="ri-user-2-fill align-bottom text-muted me-2"></i> View Profile</a>
                                                                    <a class="dropdown-item" href="#"><i class="ri-inbox-archive-line align-bottom text-muted me-2"></i> Archive</a>
                                                                    <a class="dropdown-item" href="#"><i class="ri-mic-off-line align-bottom text-muted me-2"></i> Muted</a>
                                                                    <a class="dropdown-item" href="#"><i class="ri-delete-bin-5-line align-bottom text-muted me-2"></i> Delete</a>
                                                                </div>
                                                            </div>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>

                                        </div>
                                        <!-- end chat user head -->
                                            <div class="chat-conversation p-3 p-lg-4" id="chat-conversation" data-simplebar>
                                                <ul class="list-unstyled chat-conversation-list" id="channel-conversation">       
                                                </ul>
                                                <!-- end chat-conversation-list -->

                                            </div>
                                            <div class="alert alert-warning alert-dismissible copyclipboard-alert px-4 fade show " id="copyClipBoardChannel" role="alert">
                                                Message copied
                                            </div>
                                        </div>

                                        <!-- end chat-conversation -->

                                        <div class="chat-input-section p-3 p-lg-4">

                                            <form id="chatinput-form" enctype="multipart/form-data">
                                                <div class="row g-0 align-items-center">
                                                    <div class="col-auto">
                                                        <div class="chat-input-links me-2">
                                                            <div class="links-list-item">
                                                                <button type="button" class="btn btn-link text-decoration-none emoji-btn" id="emoji-btn">
                                                                    <i class="bx bx-smile align-middle"></i>
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col">
                                                        <div class="chat-input-feedback">
                                                            Please Enter a Message
                                                        </div>
                                                        <input type="text" class="form-control chat-input bg-light border-light" id="chat-input" placeholder="Type your message..." autocomplete="off">
                                                    </div>
                                                    <div class="col-auto">
                                                        <div class="chat-input-links ms-2">
                                                            <div class="links-list-item">
                                                                <button type="submit" class="btn btn-primary chat-send waves-effect waves-light shadow">
                                                                    <i class="ri-send-plane-2-fill align-bottom"></i>
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </div>

                                                </div>
                                            </form>
                                        </div>

                                        <div class="replyCard">
                                            <div class="card mb-0">
                                                <div class="card-body py-3">
                                                    <div class="replymessage-block mb-0 d-flex align-items-start">
                                                        <div class="flex-grow-1">
                                                            <h5 class="conversation-name"></h5>
                                                            <p class="mb-0"></p>
                                                        </div>
                                                        <div class="flex-shrink-0">
                                                            <button type="button" id="close_toggle" class="btn btn-sm btn-link mt-n2 me-n3 fs-18 shadow-none">
                                                                <i class="bx bx-x align-middle"></i>
                                                            </button>
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
					<!-- end User chat -->
					<!-- Start Booking Details -->
					<div class="width-25per width-100per">
						<div class="booking-details-cart px-4 pt-4 mb-4">
							<div class="right-bar-title">
								<h6>Booking Details</h6>
							</div>
							<div class="row">
								<div class="col-md-12">
									<div class="request-to-book">
										<h6>Quick Breakdown for your Request to Book </h6>
									</div>
									<div class="row ">
										<div class="col-md-6 col-6">
											<label>Activity:</label>
										</div>
										<div class="col-md-6 col-6">
											<div class="fill-booking">
												<span>MMA</span>
											</div>
										</div>
										<div class="col-md-6 col-6">
											<label>Program Name:</label>
										</div>
										<div class="col-md-6 col-6">
											<div class="fill-booking">
												<span>Push further faster with Private lessons</span>
											</div>
										</div>
										<div class="col-md-6 col-6">
											<label>Category:</label>
										</div>
										<div class="col-md-6 col-6">
											<div class="fill-booking">
												<span>Private Lesson 45</span>
											</div>
										</div>
										<div class="col-md-6 col-6">
											<label>Membership Type: </label>
										</div>
										<div class="col-md-6 col-6">
											<div class="fill-booking">
												<span>Drop In</span>
											</div>
										</div>
										<div class="col-md-6 col-6">
											<label>Price Option: </label>
										</div>
										<div class="col-md-6 col-6">
											<div class="fill-booking">
												<span>45 Minute Private </span>
											</div>
										</div>
										<div class="col-md-6 col-6">
											<label>Neighborhood:</label>
										</div>
										<div class="col-md-6 col-6">
											<div class="fill-booking">
												<span>Upper West Side </span>
											</div>
										</div>
										<div class="col-md-6 col-6">
											<label>Language:</label>
										</div>
										<div class="col-md-6 col-6">
											<div class="fill-booking">
												<span>English </span>
											</div>
										</div>
										<div class="col-md-6 col-6">
											<label>Location:</label>
										</div>
										<div class="col-md-6 col-6">
											<div class="fill-booking">
												<span>New York</span>
											</div>
										</div>
										<div class="col-md-6 col-6">
											<label>Travel: </label>
										</div>
										<div class="col-md-6 col-6">
											<div class="fill-booking bottom-sepretor-sp">
												<span>Client will travel to trainer if need</span>
											</div>
										</div>
										<div class="col-md-12 col-12">
											<div class="bottom-sepretor"></div>
										</div>
									</div>
								</div>
								
								<div class="col-md-12">
									<div class="row ">
										<div class="col-md-6 col-6">
											<label>Booking Request Date:</label>
										</div>
										<div class="col-md-6 col-6">
											<div class="fill-booking">
												<span>12/23/2022</span>
											</div>
										</div>
										<div class="col-md-6 col-6">
											<label>Requested Timeslot:</label>
										</div>
										<div class="col-md-6 col-6">
											<div class="fill-booking">
												<span>9:00am to 10:00 am</span>
											</div>
										</div>
										<div class="col-md-6 col-6">
											<label>Participant:</label>
										</div>
										<div class="col-md-6 col-6">
											<div class="fill-booking">
												<span>1 Customer</span>
											</div>
										</div>
										<div class="col-md-6 col-6">
											<label>Price:</label>
										</div>
										<div class="col-md-6 col-6">
											<div class="fill-booking">
												<span>$95</span>
											</div>
										</div>
										<div class="col-md-12 col-12">
												<div class="bottom-sepretor"></div>
										</div>
									</div>
								</div>
								
								<div class="col-md-12">
									<div class="request-to-book">
										<h6>Your Potential Earnings</h6>
									</div>
									<div class="bottom-sepretor">
										<div class="row ">
											<div class="col-md-6 col-6">
												<label>$95   x 1 Adult <br>
															 x 0 Children<br>
															 x 0 Infants</label>
											</div>
											<div class="col-md-6 col-6">
												<div class="fill-booking">
													<span>$95</span>
												</div>
											</div>
											<div class="col-md-6 col-6">
												<label>Service fee</label>
											</div>
											<div class="col-md-6 col-6">
												<div class="fill-booking">
													<span>$14.25</span>
												</div>
											</div>
											<div class="col-md-6 col-6">
												<label>Total (USD)</label>
											</div>
											<div class="col-md-6 col-6">
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
										<button type="button" class="btn btn-red">Confirm</button>
										<button type="button" class="btn btn-red">Pass</button>
										<button type="button" class="btn btn-red">Offer</button>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
                 <!-- end chat-wrapper -->
					
            </div><!-- container-fluid -->
            <!-- End Page-content -->
     </div><!-- end main content-->
</div><!-- END layout-wrapper -->

 <div class="offcanvas offcanvas-end border-0" tabindex="-1" id="userProfileCanvasExample">
        <!--end offcanvas-header-->
        <div class="offcanvas-body profile-offcanvas p-0">
            <div class="team-cover">
                <img src="assets/images/small/img-9.jpg" alt="" class="img-fluid" />
            </div>
            <div class="p-1 pb-4 pt-0">
                <div class="team-settings">
                    <div class="row g-0">
                        <div class="col">
                            <div class="btn nav-btn">
                                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                            </div>
                        </div>
                        <div class="col-auto">
                            <div class="user-chat-nav d-flex">
                                <button type="button" class="btn nav-btn favourite-btn active">
                                    <i class="ri-star-fill"></i>
                                </button>

                                <div class="dropdown">
                                    <a class="btn nav-btn" href="javascript:void(0);" data-bs-toggle="dropdown" aria-expanded="false">
                                        <i class="ri-more-2-fill"></i>
                                    </a>
                                    <ul class="dropdown-menu dropdown-menu-end">
                                        <li><a class="dropdown-item" href="javascript:void(0);"><i class="ri-inbox-archive-line align-bottom text-muted me-2"></i>Archive</a></li>
                                        <li><a class="dropdown-item" href="javascript:void(0);"><i class="ri-mic-off-line align-bottom text-muted me-2"></i>Muted</a></li>
                                        <li><a class="dropdown-item" href="javascript:void(0);"><i class="ri-delete-bin-5-line align-bottom text-muted me-2"></i>Delete</a></li>
                                    </ul>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                <!--end col-->
            </div>
            <div class="p-3 text-center">
                <img src="https://fitnessity-production.s3.amazonaws.com/customer/IUwmNesKNJtrlzkSgjex1bzQoXhtvteofsrr44qQ.jpg" alt="" class="avatar-lg img-thumbnail rounded-circle mx-auto profile-img">
                <div class="mt-3">
                    <h5 class="fs-16 mb-1"><a href="javascript:void(0);" class="link-primary username">Lisa Parker</a></h5>
                    <p class="text-muted"><i class="ri-checkbox-blank-circle-fill me-1 align-bottom text-success"></i>Online</p>
                </div>

                <div class="d-flex gap-2 justify-content-center">
                    <button type="button" class="btn avatar-xs p-0" data-bs-toggle="tooltip" data-bs-placement="top" title="Message">
                        <span class="avatar-title rounded bg-light text-body">
                            <i class="ri-question-answer-line"></i>
                        </span>
                    </button>

                    <button type="button" class="btn avatar-xs p-0" data-bs-toggle="tooltip" data-bs-placement="top" title="Favourite">
                        <span class="avatar-title rounded bg-light text-body">
                            <i class="ri-star-line"></i>
                        </span>
                    </button>  

                    <button type="button" class="btn avatar-xs p-0" data-bs-toggle="tooltip" data-bs-placement="top" title="Phone">
                        <span class="avatar-title rounded bg-light text-body">
                            <i class="ri-phone-line"></i>
                        </span>
                    </button>

                    <div class="dropdown">
                        <button class="btn avatar-xs p-0" type="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <span class="avatar-title bg-light text-body rounded">
                                <i class="ri-more-fill"></i>
                            </span>
                        </button>

                        <ul class="dropdown-menu dropdown-menu-end">
                            <li><a class="dropdown-item" href="javascript:void(0);"><i class="ri-inbox-archive-line align-bottom text-muted me-2"></i>Archive</a></li>
                            <li><a class="dropdown-item" href="javascript:void(0);"><i class="ri-mic-off-line align-bottom text-muted me-2"></i>Muted</a></li>
                            <li><a class="dropdown-item" href="javascript:void(0);"><i class="ri-delete-bin-5-line align-bottom text-muted me-2"></i>Delete</a></li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="border-top border-top-dashed p-3">
                <h5 class="fs-15 mb-3">Personal Details</h5>
                <div class="mb-3">
                    <p class="text-muted text-uppercase fw-medium fs-12 mb-1">Number</p>
                    <h6>+(256) 2451 8974</h6>
                </div>
                <div class="mb-3">
                    <p class="text-muted text-uppercase fw-medium fs-12 mb-1">Email</p>
                    <h6>lisaparker@gmail.com</h6>
                </div>
                <div>
                    <p class="text-muted text-uppercase fw-medium fs-12 mb-1">Location</p>
                    <h6 class="mb-0">California, USA</h6>
                </div>
            </div>

            <div class="border-top border-top-dashed p-3">
                <h5 class="fs-15 mb-3">Attached Files</h5>

                <div class="vstack gap-2">
                    <div class="border rounded border-dashed p-2">
                        <div class="d-flex align-items-center">
                            <div class="flex-shrink-0 me-3">
                                <div class="avatar-xs">
                                    <div class="avatar-title bg-light text-secondary rounded fs-20">
                                        <i class="ri-folder-zip-line"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="flex-grow-1 overflow-hidden">
                                <h5 class="fs-13 mb-1"><a href="#" class="text-body text-truncate d-block">App pages.zip</a></h5>
                                <div class="text-muted">2.2MB</div>
                            </div>
                            <div class="flex-shrink-0 ms-2">
                                <div class="d-flex gap-1">
                                    <button type="button" class="btn btn-icon text-muted btn-sm fs-18"><i class="ri-download-2-line"></i></button>
                                    <div class="dropdown">
                                        <button class="btn btn-icon text-muted btn-sm fs-18 dropdown" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                            <i class="ri-more-fill"></i>
                                        </button>
                                        <ul class="dropdown-menu">
                                            <li><a class="dropdown-item" href="#"><i class="ri-share-line align-bottom me-2 text-muted"></i> Share</a></li>
                                            <li><a class="dropdown-item" href="#"><i class="ri-bookmark-line align-bottom me-2 text-muted"></i> Bookmark</a></li>
                                            <li><a class="dropdown-item" href="#"><i class="ri-delete-bin-line align-bottom me-2 text-muted"></i> Delete</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="border rounded border-dashed p-2">
                        <div class="d-flex align-items-center">
                            <div class="flex-shrink-0 me-3">
                                <div class="avatar-xs">
                                    <div class="avatar-title bg-light text-secondary rounded fs-20">
                                        <i class="ri-file-ppt-2-line"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="flex-grow-1 overflow-hidden">
                                <h5 class="fs-13 mb-1"><a href="#" class="text-body text-truncate d-block">Velzon admin.ppt</a></h5>
                                <div class="text-muted">2.4MB</div>
                            </div>
                            <div class="flex-shrink-0 ms-2">
                                <div class="d-flex gap-1">
                                    <button type="button" class="btn btn-icon text-muted btn-sm fs-18"><i class="ri-download-2-line"></i></button>
                                    <div class="dropdown">
                                        <button class="btn btn-icon text-muted btn-sm fs-18 dropdown" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                            <i class="ri-more-fill"></i>
                                        </button>
                                        <ul class="dropdown-menu">
                                            <li><a class="dropdown-item" href="#"><i class="ri-share-line align-bottom me-2 text-muted"></i> Share</a></li>
                                            <li><a class="dropdown-item" href="#"><i class="ri-bookmark-line align-bottom me-2 text-muted"></i> Bookmark</a></li>
                                            <li><a class="dropdown-item" href="#"><i class="ri-delete-bin-line align-bottom me-2 text-muted"></i> Delete</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="border rounded border-dashed p-2">
                        <div class="d-flex align-items-center">
                            <div class="flex-shrink-0 me-3">
                                <div class="avatar-xs">
                                    <div class="avatar-title bg-light text-secondary rounded fs-20">
                                        <i class="ri-folder-zip-line"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="flex-grow-1 overflow-hidden">
                                <h5 class="fs-13 mb-1"><a href="#" class="text-body text-truncate d-block">Images.zip</a></h5>
                                <div class="text-muted">1.2MB</div>
                            </div>
                            <div class="flex-shrink-0 ms-2">
                                <div class="d-flex gap-1">
                                    <button type="button" class="btn btn-icon text-muted btn-sm fs-18"><i class="ri-download-2-line"></i></button>
                                    <div class="dropdown">
                                        <button class="btn btn-icon text-muted btn-sm fs-18 dropdown" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                            <i class="ri-more-fill"></i>
                                        </button>
                                        <ul class="dropdown-menu">
                                            <li><a class="dropdown-item" href="#"><i class="ri-share-line align-bottom me-2 text-muted"></i> Share</a></li>
                                            <li><a class="dropdown-item" href="#"><i class="ri-bookmark-line align-bottom me-2 text-muted"></i> Bookmark</a></li>
                                            <li><a class="dropdown-item" href="#"><i class="ri-delete-bin-line align-bottom me-2 text-muted"></i> Delete</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="border rounded border-dashed p-2">
                        <div class="d-flex align-items-center">
                            <div class="flex-shrink-0 me-3">
                                <div class="avatar-xs">
                                    <div class="avatar-title bg-light text-secondary rounded fs-20">
                                        <i class="ri-image-2-line"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="flex-grow-1 overflow-hidden">
                                <h5 class="fs-13 mb-1"><a href="#" class="text-body text-truncate d-block">bg-pattern.png</a></h5>
                                <div class="text-muted">1.1MB</div>
                            </div>
                            <div class="flex-shrink-0 ms-2">
                                <div class="d-flex gap-1">
                                    <button type="button" class="btn btn-icon text-muted btn-sm fs-18"><i class="ri-download-2-line"></i></button>
                                    <div class="dropdown">
                                        <button class="btn btn-icon text-muted btn-sm fs-18 dropdown" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                            <i class="ri-more-fill"></i>
                                        </button>
                                        <ul class="dropdown-menu">
                                            <li><a class="dropdown-item" href="#"><i class="ri-share-line align-bottom me-2 text-muted"></i> Share</a></li>
                                            <li><a class="dropdown-item" href="#"><i class="ri-bookmark-line align-bottom me-2 text-muted"></i> Bookmark</a></li>
                                            <li><a class="dropdown-item" href="#"><i class="ri-delete-bin-line align-bottom me-2 text-muted"></i> Delete</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="text-center mt-2">
                        <button type="button" class="btn btn-danger">Load more <i class="ri-arrow-right-fill align-bottom ms-1"></i></button>
                    </div>
                </div>
            </div>
        </div>
        <!--end offcanvas-body-->
    </div>

@include('layouts.business.footer')

@endsection
