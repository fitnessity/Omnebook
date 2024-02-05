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
                                    <a class="nav-link active text-black" data-bs-toggle="tab" href="#chats" role="tab">
                                       All Chats
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link text-black" data-bs-toggle="tab" href="#client" role="tab">
                                       Client
                                    </a>
                                </li>
								<li class="nav-item">
                                    <a class="nav-link text-black" data-bs-toggle="tab" href="#staff" role="tab">
                                       Staff
                                    </a>
                                </li>
								<li class="nav-item">
                                    <a class="nav-link text-black" data-bs-toggle="tab" href="#Favorite" role="tab">
                                       Favorite
                                    </a>
                                </li>
								<li class="nav-item">
                                    <a class="nav-link text-black" data-bs-toggle="tab" href="#Request" role="tab">
                                       Request
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
										<div class="d-flex align-items-center px-4 mt-4 pt-2 mb-2">
                                            <div class="flex-grow-1">
                                                <h4 class="mb-0 fs-11 text-muted text-uppercase">Group Chats</h4>
                                            </div>
                                            <div class="flex-shrink-0">
                                                <div data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="bottom" aria-label="Create group" data-bs-original-title="Create group">
                                                    <!-- Button trigger modal -->
                                                    <button type="button" class="btn btn-soft-success btn-sm">
                                                        <i class="ri-add-line align-bottom"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
										<div class="chat-message-list">        
                                            <ul class="list-unstyled chat-list chat-user-list mb-0" id="channelList">
											   <li id="contact-id-10" data-name="channel" class="active">
												  <a href="javascript: void(0);" class="unread-msg-user">
													 <div class="d-flex align-items-center">
														<div class="flex-shrink-0 chat-user-img align-self-center me-2 ms-0">
														   <div class="avatar-xxs">
															  <div class="avatar-title bg-light rounded-circle text-body">#</div>
														   </div>
														</div>
														<div class="flex-grow-1 overflow-hidden">
														   <p class="text-truncate mb-0">Landing Design</p>
														</div>
														<div>
														   <div class="flex-shrink-0 ms-2"><span class="badge bg-dark-subtle text-body rounded p-1">7</span></div>
														</div>
													 </div>
												  </a>
											   </li>
											   <li id="contact-id-11" data-name="channel" class="">
												  <a href="javascript: void(0);">
													 <div class="d-flex align-items-center">
														<div class="flex-shrink-0 chat-user-img align-self-center me-2 ms-0">
														   <div class="avatar-xxs">
															  <div class="avatar-title bg-light rounded-circle text-body">#</div>
														   </div>
														</div>
														<div class="flex-grow-1 overflow-hidden">
														   <p class="text-truncate mb-0">General</p>
														</div>
														<div></div>
													 </div>
												  </a>
											   </li>
											   <li id="contact-id-12" data-name="channel" class="">
												  <a href="javascript: void(0);" class="unread-msg-user">
													 <div class="d-flex align-items-center">
														<div class="flex-shrink-0 chat-user-img align-self-center me-2 ms-0">
														   <div class="avatar-xxs">
															  <div class="avatar-title bg-light rounded-circle text-body">#</div>
														   </div>
														</div>
														<div class="flex-grow-1 overflow-hidden">
														   <p class="text-truncate mb-0">Project Tasks</p>
														</div>
														<div>
														   <div class="flex-shrink-0 ms-2"><span class="badge bg-dark-subtle text-body rounded p-1">2</span></div>
														</div>
													 </div>
												  </a>
											   </li>
											   <li id="contact-id-13" data-name="channel" class="">
												  <a href="javascript: void(0);">
													 <div class="d-flex align-items-center">
														<div class="flex-shrink-0 chat-user-img align-self-center me-2 ms-0">
														   <div class="avatar-xxs">
															  <div class="avatar-title bg-light rounded-circle text-body">#</div>
														   </div>
														</div>
														<div class="flex-grow-1 overflow-hidden">
														   <p class="text-truncate mb-0">Meeting</p>
														</div>
														<div></div>
													 </div>
												  </a>
											   </li>
											   <li id="contact-id-14" data-name="channel" class="">
												  <a href="javascript: void(0);">
													 <div class="d-flex align-items-center">
														<div class="flex-shrink-0 chat-user-img align-self-center me-2 ms-0">
														   <div class="avatar-xxs">
															  <div class="avatar-title bg-light rounded-circle text-body">#</div>
														   </div>
														</div>
														<div class="flex-grow-1 overflow-hidden">
														   <p class="text-truncate mb-0">Reporting</p>
														</div>
														<div></div>
													 </div>
												  </a>
											   </li>
											</ul>
                                        </div>
                                        
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
								<div class="tab-pane" id="Favorite" role="tabpanel">
								</div>
								<div class="tab-pane" id="Request" role="tabpanel">
								</div>
                            </div>
                            <!-- end tab contact -->
                        </div>
					</div>
                    <!-- end chat leftsidebar -->
                    <!-- Start User chat -->
					<div class="width-75per">
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
    
                                                            <li class="list-inline-item d-lg-inline-block m-0">
                                                                <button type="button" class="btn btn-ghost-secondary btn-icon shadow-none" data-bs-toggle="offcanvas" data-bs-target="#userProfileCanvasExample" aria-controls="userProfileCanvasExample">
                                                                  <i class="fas fa-users"></i>
                                                                </button>
                                                            </li>
															<li class="list-inline-item d-lg-inline-block m-0">
                                                                <button type="button" class="btn btn-ghost-secondary btn-icon shadow-none" data-bs-toggle="offcanvas" data-bs-target="#userProfileCanvasExample1" aria-controls="userProfileCanvasExample1">
                                                                    <i class="fas fa-user"></i>
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
				</div>
                 <!-- end chat-wrapper -->
					
            </div><!-- container-fluid -->
            <!-- End Page-content -->
     </div><!-- end main content-->
</div><!-- END layout-wrapper -->
 <div class="offcanvas offcanvas-end border-0" tabindex="-1" id="userProfileCanvasExample1">
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
                            </div>
                        </div>
                    </div>
                </div>
                <!--end col-->
            </div>
            <div class="p-3 text-center">
                <img src="https://fitnessity-production.s3.amazonaws.com/customer/IUwmNesKNJtrlzkSgjex1bzQoXhtvteofsrr44qQ.jpg" alt="" class="avatar-lg img-thumbnail rounded-circle mx-auto profile-img">
                <div class="mt-3">
                    <h5 class="fs-16 mb-1"><a href="javascript:void(0);" class="username">Lisa Parker (Clients) </a></h5>
					<span>Since 28/05/2000</span>
                    <p class="text-muted"><i class="ri-checkbox-blank-circle-fill me-1 align-bottom text-success"></i>Online</p>
                </div>

                <div class="d-flex gap-2 justify-content-center">
					<button type="button" class="btn avatar-xs p-0" data-bs-toggle="tooltip" data-bs-placement="top" title="Message">
                        <span class="avatar-title rounded bg-light text-body">
                            <i class="fas fa-camera"></i>
                        </span>
                    </button>
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
                       <!-- <button class="btn avatar-xs p-0" type="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <span class="avatar-title bg-light text-body rounded">
                                <i class="ri-more-fill"></i>
                            </span>
                        </button> -->

                        <ul class="dropdown-menu dropdown-menu-end">
                            <li><a class="dropdown-item" href="javascript:void(0);"><i class="ri-inbox-archive-line align-bottom text-muted me-2"></i>Archive</a></li>
                            <li><a class="dropdown-item" href="javascript:void(0);"><i class="ri-mic-off-line align-bottom text-muted me-2"></i>Muted</a></li>
                            <li><a class="dropdown-item" href="javascript:void(0);"><i class="ri-delete-bin-5-line align-bottom text-muted me-2"></i>Delete</a></li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="border-top border-top-dashed p-3">
                <h5 class="fs-15 mb-3">Client Details</h5>
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
				<div class="">
					<div class="card-body">
						<!-- Nav tabs -->
						<ul class="nav nav-tabs mb-3" role="tablist">
							<li class="nav-item">
								<a class="nav-link active" data-bs-toggle="tab" href="#Schedule" role="tab" aria-selected="false">
									Schedule
								</a>
							</li>
							<li class="nav-item">
								<a class="nav-link" data-bs-toggle="offcanvas" data-bs-target="#Booking_Request_client" aria-controls="Booking_Request_client">
									Booking Request
								</a>
							</li>
							<li class="nav-item">
								<a class="nav-link" data-bs-toggle="offcanvas"data-bs-target="#Account_Info" aria-controls="Account_Info">
									Account
								</a>
							</li>
						</ul>
						<!-- Tab panes -->
						<div class="tab-content  text-muted">
							<div class="tab-pane active" id="Schedule" role="tabpanel">
								<div class="dropdown-activity mt-4 mb-3">
									<a class="alinkdrop dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">Show All Activites</a>
									<ul class="dropdown-menu activityschedule" aria-labelledby="dropdownMenuButton1" style="">
										<li><a class="dropdown-item">Show All Activites</a></li>
										<li><a class="dropdown-item">Personal Training</a></li>
										<li><a class="dropdown-item">Classes</a></li>
										<li><a class="dropdown-item">Events</a></li>
										<li><a class="dropdown-item">Experience</a></li>
									</ul>
								</div>
								<div class="scheduledata">
									<div class="mini-stats-wid d-flex align-items-center mt-3">
										<div class="flex-shrink-0 avatar-sm">
											<span class="mini-stat-icon avatar-title rounded-circle text-success bg-soft-success fs-4 multiple-activites">
												2/2 
												<label>Spots left</label>
											</span>
										</div>
										<div class="flex-grow-1 ms-3 activity-info">
											<h6 class="mb-1">Love Tennis</h6>
											<p class="text-muted mb-0">Private Lessons Recurring Options</p>
											<p class="text-muted mb-0">30 Minute Private (01 Pack)</p>
										</div>
										<div class="flex-shrink-0 ms-3">
											<p class="text-muted mb-0 color-black">01:15 AM</p>
											<p class="text-muted mb-0 color-black">02:15 AM</p>
										</div>
									</div><!-- end -->
																																								<div class="mini-stats-wid d-flex align-items-center mt-3">
										<div class="flex-shrink-0 avatar-sm">
											<span class="mini-stat-icon avatar-title rounded-circle text-success bg-soft-success fs-4 multiple-activites">
												1/1 
												<label>Spots left</label>
											</span>
										</div>
										<div class="flex-grow-1 ms-3 activity-info">
											<h6 class="mb-1">Hocky Class On Fire</h6>
											<p class="text-muted mb-0">Hocky class1</p>
											<p class="text-muted mb-0">class 1</p>
										</div>
										<div class="flex-shrink-0 ms-3">
											<p class="text-muted mb-0 color-black">01:00 AM</p>
											<p class="text-muted mb-0 color-black">01:45 AM</p>
										</div>
									</div><!-- end -->									
								</div>
								<div class="mt-3 text-center">
									<a href="#" class="text-muted text-decoration-underline">View Booking</a>
								</div>
							</div>
							<div class="tab-pane" id="Booking_Request" role="tabpanel">
								
							</div>
							<div class="tab-pane" id="Account" role="tabpanel">								
									
							</div>
						</div>
					</div><!-- end card-body -->
				</div><!-- end card -->
            </div>
        </div>
        <!--end offcanvas-body-->
    </div>

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
                            </div>
                        </div>
                    </div>
                </div>
                <!--end col-->
            </div>
            <div class="p-3 text-center">
                <img src="https://fitnessity-production.s3.amazonaws.com/customer/IUwmNesKNJtrlzkSgjex1bzQoXhtvteofsrr44qQ.jpg" alt="" class="avatar-lg img-thumbnail rounded-circle mx-auto profile-img">
                <div class="mt-3">
                    <h5 class="fs-16 mb-1"><a href="javascript:void(0);" class="username">Lisa Parker (Staff) </a></h5>
					<span> Manager Since 28/05/2000</span>
                    <p class="text-muted"><i class="ri-checkbox-blank-circle-fill me-1 align-bottom text-success"></i>Online</p>
                </div>

                <div class="d-flex gap-2 justify-content-center">
					<button type="button" class="btn avatar-xs p-0" data-bs-toggle="tooltip" data-bs-placement="top" title="Message">
                        <span class="avatar-title rounded bg-light text-body">
                            <i class="fas fa-camera"></i>
                        </span>
                    </button>
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
                       <!-- <button class="btn avatar-xs p-0" type="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <span class="avatar-title bg-light text-body rounded">
                                <i class="ri-more-fill"></i>
                            </span>
                        </button> -->

                        <ul class="dropdown-menu dropdown-menu-end">
                            <li><a class="dropdown-item" href="javascript:void(0);"><i class="ri-inbox-archive-line align-bottom text-muted me-2"></i>Archive</a></li>
                            <li><a class="dropdown-item" href="javascript:void(0);"><i class="ri-mic-off-line align-bottom text-muted me-2"></i>Muted</a></li>
                            <li><a class="dropdown-item" href="javascript:void(0);"><i class="ri-delete-bin-5-line align-bottom text-muted me-2"></i>Delete</a></li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="border-top border-top-dashed p-3">
                <h5 class="fs-15 mb-3">Staff Details</h5>
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
				<div class="">
					<div class="card-body">
						<!-- Nav tabs -->
						<ul class="nav nav-tabs mb-3" role="tablist">
							<li class="nav-item">
								<a class="nav-link active" data-bs-toggle="tab" href="#Schedule_Staff" role="tab" aria-selected="false">
									Schedule
								</a>
							</li>
							<li class="nav-item">
								<a class="nav-link" data-bs-toggle="tab" href="#Booking_Request_Staff" role="tab" aria-selected="false">
									Booking Request
								</a>
							</li>
							<li class="nav-item">
								<a class="nav-link" data-bs-toggle="tab" href="#Task_List_Staff" role="tab" aria-selected="false">
									Task List
								</a>
							</li>
						</ul>
						<!-- Tab panes -->
						<div class="tab-content  text-muted">
							<div class="tab-pane active" id="Schedule_Staff" role="tabpanel">
								<div class="dropdown-activity mt-4 mb-3">
									<a class="alinkdrop dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">Show All Activites</a>
									<ul class="dropdown-menu activityschedule" aria-labelledby="dropdownMenuButton1" style="">
										<li><a class="dropdown-item">Show All Activites</a></li>
										<li><a class="dropdown-item">Personal Training</a></li>
										<li><a class="dropdown-item">Classes</a></li>
										<li><a class="dropdown-item">Events</a></li>
										<li><a class="dropdown-item">Experience</a></li>
									</ul>
								</div>
								<div class="scheduledata">
									<div class="mini-stats-wid d-flex align-items-center mt-3">
										<div class="flex-shrink-0 avatar-sm">
											<span class="mini-stat-icon avatar-title rounded-circle text-success bg-soft-success fs-4 multiple-activites">
												2/2 
												<label>Spots left</label>
											</span>
										</div>
										<div class="flex-grow-1 ms-3 activity-info">
											<h6 class="mb-1">Love Tennis</h6>
											<p class="text-muted mb-0">Private Lessons Recurring Options</p>
											<p class="text-muted mb-0">30 Minute Private (01 Pack)</p>
										</div>
										<div class="flex-shrink-0 ms-3">
											<p class="text-muted mb-0 color-black">01:15 AM</p>
											<p class="text-muted mb-0 color-black">02:15 AM</p>
										</div>
									</div><!-- end -->
																																								<div class="mini-stats-wid d-flex align-items-center mt-3">
										<div class="flex-shrink-0 avatar-sm">
											<span class="mini-stat-icon avatar-title rounded-circle text-success bg-soft-success fs-4 multiple-activites">
												1/1 
												<label>Spots left</label>
											</span>
										</div>
										<div class="flex-grow-1 ms-3 activity-info">
											<h6 class="mb-1">Hocky Class On Fire</h6>
											<p class="text-muted mb-0">Hocky class1</p>
											<p class="text-muted mb-0">class 1</p>
										</div>
										<div class="flex-shrink-0 ms-3">
											<p class="text-muted mb-0 color-black">01:00 AM</p>
											<p class="text-muted mb-0 color-black">01:45 AM</p>
										</div>
									</div><!-- end -->									
								</div>
								<div class="mt-3 text-center">
									<a href="#" class="text-muted text-decoration-underline">View Schedule</a>
								</div>
							</div>
							<div class="tab-pane" id="Booking_Request_Staff" role="tabpanel">
								<div class="table-responsive">
									<table class="table align-middle position-relative table-nowrap">
										<thead class="table-active">
											<tr>
												<th scope="col">Client</th>
												<th scope="col"> Date</th>
												<th scope="col">Time</th>
												<th scope="col"> Activity</th>
												<th scope="col">View</th>
											</tr>
										</thead>
										<tbody id="task-list">
											<tr>            
												<td>Nipa Soni</td>       
												<td>23 Apr, 2022</td>   
												<td>6:00PM</td> 
												<td>River Rafting</td>
												<td>
													<div class="hstack gap-2">   
														<button class="btn btn-sm btn-soft-info edit-list"  data-bs-toggle="offcanvas" data-bs-target="#Booking_Request_staff_modal" aria-controls="Booking_Request_staff_modal"><i class="far fa-eye"></i></button>            
													</div>
												</td>
											</tr>
											<tr>            
												<td>Ankita Patel</td>       
												<td>25 Apr, 2023</td>   
												<td>10:00PM</td> 
												<td>Rock Climbing At USA</td>
												<td>
													<div class="hstack gap-2">   
														<button class="btn btn-sm btn-soft-info edit-list"  data-bs-toggle="offcanvas" data-bs-target="#Booking_Request_staff_modal" aria-controls="Booking_Request_staff_modal"><i class="far fa-eye"></i></button>            
													</div>
												</td>
											</tr>
											<tr>            
												<td>Purvi Patel</td>       
												<td>21 Jan, 2023</td>   
												<td>8:00PM</td> 
												<td>Hocky Class On Fire</td>
												<td>
													<div class="hstack gap-2">   
														<button class="btn btn-sm btn-soft-info edit-list"  data-bs-toggle="offcanvas" data-bs-target="#Booking_Request_staff_modal" aria-controls="Booking_Request_staff_modal"><i class="far fa-eye"></i></button>            
													</div>
												</td>
											</tr>
										</tbody>
									</table>
								</div>								
							</div>
							<div class="tab-pane" id="Task_List_Staff" role="tabpanel">
								 <div class="todo-task" id="todo-task">
                                    <div class="table-responsive">
                                        <table class="table align-middle position-relative table-nowrap">
                                            <thead class="table-active">
                                                <tr>
                                                    <th scope="col">Title</th>
                                                    <th scope="col"> Date Appointed</th>
                                                    <th scope="col">Due Date</th>
                                                    <th scope="col">View Task</th>
                                                </tr>
                                            </thead>

                                            <tbody id="task-list">
												<tr>            
													<td>                
														<div class="d-flex align-items-start">                  
															<div class="flex-grow-1">                       
																<div class="form-check">                            
																	<input class="form-check-input" type="checkbox" value="15" id="todo15">                            
																	<label class="form-check-label" for="todo15">Added Select2</label>                        
																</div>                    
															</div>     
														</div>            
													</td>       
													<td>23 Apr, 2022</td>   
													<td>23 Apr, 2022</td> 
													<td>
														<div class="hstack gap-2">   
															<button class="btn btn-sm btn-soft-info edit-list"><i class="far fa-eye"></i></button>            
														</div>            
													</td>
												</tr>
												
											</tbody>
                                        </table>
                                    </div>
                                </div>
									
							</div>
						</div>
					</div><!-- end card-body -->
				</div><!-- end card -->
            </div>
        </div>
        <!--end offcanvas-body-->
    </div>
 <div class="offcanvas offcanvas-end border-0" tabindex="-1" id="Booking_Request_staff_modal">
        <!--end offcanvas-header-->
        <div class="offcanvas-body profile-offcanvas p-0">
            <div class="border-top border-top-dashed p-3">
				<div class="">
					<div class="card-body">
						<div class="btn nav-btn">
							<button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
						</div>
						<!-- Start Booking Details -->
						<div class="width-100per">
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
					
						
					</div><!-- end card-body -->
				</div><!-- end card -->
            </div>
        </div>
        <!--end offcanvas-body-->
    </div>
 <div class="offcanvas offcanvas-end border-0" tabindex="-1" id="Booking_Request_client">
        <!--end offcanvas-header-->
        <div class="offcanvas-body profile-offcanvas p-0">
            <div class="border-top border-top-dashed p-3">
				<div class="">
					<div class="card-body">
						<div class="btn nav-btn">
							<button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
						</div>
						<!-- Start Booking Details -->
						<div class="width-100per">
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
					
						
					</div><!-- end card-body -->
				</div><!-- end card -->
            </div>
        </div>
        <!--end offcanvas-body-->
    </div>

 <div class="offcanvas offcanvas-end offcanvas-end-accountinfo border-0" tabindex="-1" id="Account_Info">
        <!--end offcanvas-header-->
        <div class="offcanvas-body profile-offcanvas p-0">
            <div class="border-top border-top-dashed p-3">
				<div class="">
					<div class="card-body">
						<div class="btn nav-btn">
							<button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
						</div>
						<!-- Start Booking Details -->
						<div class="width-100per">
							<div class="booking-details-cart pt-4 mb-4">
								<div class="row">
									<div class="accordion nesting2-accordion custom-accordionwithicon accordion-border-box mt-2" id="accordionnesting2">
										<div class="accordion-item shadow">
											<h2 class="accordion-header" id="accordionnesting2Example1">
												<button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#accor_nesting2Examplecollapse1" aria-expanded="false" aria-controls="accor_nesting2Examplecollapse1">
													Membership Details 
												</button>
											</h2>
											<div id="accor_nesting2Examplecollapse1" class="accordion-collapse collapse " aria-labelledby="accordionnesting2Example1" data-bs-parent="#accordionnesting2">
												<div class="accordion-body">
													<div class="accordion nesting4-accordion custom-accordionwithicon accordion-border-box mt-3" id="accordionnesting4">
														<div class="accordion-item shadow">
															<h2 class="accordion-header" id="accordionnesting4Example2">
																<button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#accor_nesting4Examplecollapse2" aria-expanded="false" aria-controls="accor_nesting4Examplecollapse2">
																	Active Memberships (6)
																</button>
															</h2>
															<div id="accor_nesting4Examplecollapse2" class="accordion-collapse collapse" aria-labelledby="accordionnesting4Example2" data-bs-parent="#accordionnesting4">
																<div class="accordion-body">
																	<div class="accordion nesting4-accordion custom-accordionwithicon accordion-border-box mt-3" id="accordionnestinga0">
																		<div class="accordion-item shadow">
																			<h2 class="accordion-header" id="accordionnesting4Examplea0}">
																				<button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#accor_nesting4Examplecollapsea0" aria-expanded="false" aria-controls="accor_nesting4Examplecollapse2">
																					<div class="container-fluid nopadding">
																						<div class="row mini-stats-wid d-flex align-items-center ">
																							<div class="col-lg-10 col-md-10 col-8"> Love Tennis - Private Lessons 30 Min. (1 Person) |Started On 11/30/2023 | Expires On 01/30/2024 </div>
																							<div class="col-lg-2 col-md-2 col-4">
																								<div class="multiple-options">
																									<div class="setting-icon">
																										<i class="ri-more-fill"></i>
																										<ul>
																											<li>
																												<a class="visiting-view" data-behavior="ajax_html_modal" data-url="http://dev.fitnessity.co/business/68/customers/215/visit_modal?booking_detail_id=1182" data-modal-width="modal-70"><i class="fas fa-plus text-muted">
																												</i> View Visits </a>
																											</li>
																											<li>
																												<a class="edit-booking-customer" data-behavior="ajax_html_modal" data-url="http://dev.fitnessity.co/business/68/visit_membership_modal?id=215&amp;booking_detail_id=1182&amp;booking_id=1350" data-modal-width="modal-50"> <i class="fas fa-plus text-muted">
																												</i>Edit Booking </a>
																											</li>
																											<li>
																												<a class="edit-booking-customer" data-behavior="ajax_html_modal" data-url="http://dev.fitnessity.co/business/68/void_or_refund_modal?id=215&amp;booking_detail_id=1182&amp;booking_id=1350" data-modal-width="modal-50"> <i class="fas fa-plus text-muted">
																												</i>Refund or Void</a>
																											</li>
																											<li>
																												<a class="edit-booking-customer" data-behavior="ajax_html_modal" data-url="http://dev.fitnessity.co/business/68/terminate_or_suspend_modal?id=215&amp;booking_detail_id=1182&amp;booking_id=1350" data-modal-width="modal-50"> <i class="fas fa-plus text-muted">
																												</i>Suspend or Terminate</a>
																											</li>
																											<li>
																												<a class="edit-booking-customer" data-behavior="ajax_html_modal" data-url="http://dev.fitnessity.co/business/68/recurring?customer_id=215&amp;booking_detail_id=1182&amp;type=schedule" data-modal-width="modal-80"><i class="fas fa-plus text-muted">
																												</i>Autopay Schedule</a>
																											</li>
																											<li>
																												<a class="edit-booking-customer" data-behavior="ajax_html_modal" data-url="http://dev.fitnessity.co/business/68/recurring?customer_id=215&amp;booking_detail_id=1182&amp;type=history" data-modal-width="modal-80"><i class="fas fa-plus text-muted">
																												</i>Autopay History</a>
																											</li>
																										</ul>
																									</div>
																								</div>
																							</div>
																						</div>
																					</div>
																				</button>
																			</h2>
																			<div id="accor_nesting4Examplecollapsea0" class="accordion-collapse collapse" aria-labelledby="accordionnesting4Examplea0}" data-bs-parent="#accordionnestinga0">
																				<div class="accordion-body">
																					<div class="mb-10">
																						<div class="red-separator mb-10">
																							<div class="container-fluid nopadding">
																								<div class="row">
																									<div class="col-lg-6 col-md-6 col-sm-6 col-6">
																										<div class="inner-accordion-titles">
																											<label>Love Tennis</label>	
																										</div>
																									</div>
																									<div class="col-lg-6 col-md-6 col-sm-6 col-6">
																										<div class="inner-accordion-titles float-end text-right line-break">
																											<span>Remaining 1/1</span> 
																											<a class="mailRecipt" data-behavior="send_receipt" data-url="http://dev.fitnessity.co/receiptmodel/1350/215" data-item-type="no" data-modal-width="modal-70">
																											<i class="far fa-file-alt" aria-hidden="true"></i></a>
																										</div>
																									</div>
																								</div>
																							</div>
																						</div>
																						<div class="container-fluid nopadding">
																							<div class="row">
																								<div class="col-lg-6 col-md-6 col-sm-6 col-6">
																									<div class="line-break">
																										<label>BOOKING # </label>
																									</div>
																								</div>
																								<div class="col-lg-6 col-md-6 col-sm-6 col-6">
																									<div class="float-end line-break text-right">
																										<span> FS_20231130130951473 </span>
																									</div>
																								</div>
																								<div class="col-lg-6 col-md-6 col-sm-6 col-6">
																									<div class="line-break">
																										<label>TOTAL PRICE </label>
																									</div>
																								</div>
																								<div class="col-lg-6 col-md-6 col-sm-6 col-6">
																									<div class="float-end line-break text-right">
																										<span> $78.38 </span>
																									</div>
																								</div>
																								<div class="col-lg-6 col-md-6 col-sm-6 col-6">
																									<div class="line-break">
																										<label>PAYMENT TYPE:</label>
																									</div>
																								</div>
																								<div class="col-lg-6 col-md-6 col-sm-6 col-6">
																									<div class="float-end line-break text-right">
																										<span>visa ****4242</span>
																									</div>
																								</div>
																								<div class="col-lg-6 col-md-6 col-sm-6 col-6">
																									<div class="line-break">
																										<label>TOTAL REMAINING:</label>
																									</div>
																								</div>
																								<div class="col-lg-6 col-md-6 col-sm-6 col-6">
																									<div class="float-end line-break text-right">
																										<span>1/1</span>
																									</div>
																								</div>
																								<div class="col-lg-6 col-md-6 col-sm-6 col-6">
																									<div class="line-break">
																										<label>PROGRAM NAME:</label>
																									</div>
																								</div>
																								<div class="col-lg-6 col-md-6 col-sm-6 col-6">
																									<div class="float-end line-break text-right">
																										<span>Love Tennis </span>
																									</div>
																								</div>
																								<div class="col-lg-6 col-md-6 col-sm-6 col-6">
																									<div class="line-break">
																										<label>CATEGORY NAME:</label>
																									</div>
																								</div>
																								<div class="col-lg-6 col-md-6 col-sm-6 col-6">
																									<div class="float-end line-break text-right">
																										<span>Private Lessons 30 Min. (1 Person) </span>
																									</div>
																								</div>
																								<div class="col-lg-6 col-md-6 col-sm-6 col-6">
																									<div class="line-break">
																										<label>PRICE OPTION:</label>
																									</div>
																								</div>
																								<div class="col-lg-6 col-md-6 col-sm-6 col-6">
																									<div class="float-end line-break text-right">
																										<span>30 Minute Private (01 Pack) </span>
																									</div>
																								</div>
																								<div class="col-lg-6 col-md-6 col-sm-6 col-6">
																									<div class="line-break">
																										<label>ACTIVATION START DATE:</label>
																									</div>
																								</div>
																								<div class="col-lg-6 col-md-6 col-sm-6 col-6">
																									<div class="float-end line-break text-right">
																										<span> 11/30/2023</span>
																									</div>
																								</div>
																								<div class="col-lg-6 col-md-6 col-sm-6 col-6">
																									<div class="line-break">
																										<label>EXPIRATION DATE:</label>
																									</div>
																								</div>
																								<div class="col-lg-6 col-md-6 col-sm-6 col-6">
																									<div class="float-end line-break text-right">
																										<span> 01/30/2024</span>
																									</div>
																								</div>
																								<div class="col-lg-6 col-md-6 col-sm-6 col-6">
																									<div class="line-break">
																										<label>DATE BOOKED:	</label>
																									</div>
																								</div>
																								<div class="col-lg-6 col-md-6 col-sm-6 col-6">
																									<div class="float-end line-break text-right">
																										<span>11/30/2023</span>
																									</div>
																								</div>
																								<div class="col-lg-6 col-md-6 col-sm-6 col-6">
																									<div class="line-break">
																										<label>BOOKING TIME: </label>
																									</div>
																								</div>
																								<div class="col-lg-6 col-md-6 col-sm-6 col-6">
																									<div class="float-end line-break text-right">
																										<span> 07:00 PM</span>
																									</div>
																								</div>
																															
																								<div class="col-lg-6 col-md-6 col-sm-6 col-6">
																									<div class="line-break">
																										<label>BOOKED BY:</label>
																									</div>
																								</div>
																								<div class="col-lg-6 col-md-6 col-sm-6 col-6">
																									<div class="float-end line-break text-right">
																										<span>Darryl Smith (Demo (In person)</span>
																									</div>
																								</div>
																																																														
																								<div class="col-lg-6 col-md-6 col-sm-6 col-6">
																									<div class="line-break">
																										<label>ACTIVITY TYPE:</label>
																									</div>
																								</div>
																								<div class="col-lg-6 col-md-6 col-sm-6 col-6">
																									<div class="float-end line-break text-right">
																										<span>Tennis</span>
																									</div>
																								</div>
																															
																								<div class="col-lg-6 col-md-6 col-sm-6 col-6">
																									<div class="line-break">
																										<label>SERVICE TYPE:</label>
																									</div>
																								</div>
																								<div class="col-lg-6 col-md-6 col-sm-6 col-6">
																									<div class="float-end line-break text-right">
																										<span>Personal Training</span>
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
													</div>
													<div class="accordion nesting5-accordion custom-accordionwithicon accordion-border-box mt-3" id="accordionnesting5">
														<div class="accordion-item shadow">
															<h2 class="accordion-header" id="accordionnesting5Example2">
																<button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#accor_nesting5Examplecollapse2" aria-expanded="false" aria-controls="accor_nesting5Examplecollapse2">
																	Completed Memberships (8)
																</button>
															</h2>
															<div id="accor_nesting5Examplecollapse2" class="accordion-collapse collapse" aria-labelledby="accordionnesting5Example2" data-bs-parent="#accordionnesting5">
																<div class="accordion-body">
																	<div class="accordion nesting5-accordion custom-accordionwithicon accordion-border-box mt-3" id="accordionnestingc0">
																		<div class="accordion-item shadow">
																			<h2 class="accordion-header" id="accordionnesting01Examplec0">
																				<button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#accor_nesting01Examplecollapsec0" aria-expanded="false" aria-controls="accor_nesting01Examplecollapsec0">
																					<div class="container-fluid nopadding">
																						<div class="row mini-stats-wid d-flex align-items-center ">
																							<div class="col-lg-8 col-md-8 col-8">
																								Love Tennis - Private Lessons 45 Min. (1 Person)
																							</div>
																							<div class="col-lg-4 col-md-4 col-4">
																								<div class="multiple-options">
																									<div class="setting-icon">
																										<i class="ri-more-fill"></i>
																										<ul>
																											<li>
																												<a class="edit-booking-customer" data-behavior="ajax_html_modal" data-url="http://dev.fitnessity.co/business/68/visit_membership_modal?id=215&amp;booking_detail_id=896&amp;booking_id=1014" data-modal-width="modal-100"> <i class="fas fa-plus text-muted">
																												</i>Edit Booking </a>
																											</li>
																											<li><a class="visiting-view" data-behavior="ajax_html_modal" data-url="http://dev.fitnessity.co/business/68/customers/215/visit_modal?booking_detail_id=896" data-modal-width="modal-70">
																												<i class="fas fa-plus text-muted"></i> View Visits </a>
																											</li>
																											<li>
																												<a class="edit-booking-customer" data-behavior="ajax_html_modal" data-url="http://dev.fitnessity.co/business/68/recurring?customer_id=215&amp;booking_detail_id=896&amp;type=schedule" data-modal-width="modal-80"><i class="fas fa-plus text-muted">
																												</i>Autopay Schedule</a>
																											</li>
																											<li>
																												<a class="edit-booking-customer" data-behavior="ajax_html_modal" data-url="http://dev.fitnessity.co/business/68/recurring?customer_id=215&amp;booking_detail_id=896&amp;type=history" data-modal-width="modal-80"><i class="fas fa-plus text-muted">
																												</i>Autopay History</a>
																											</li>
																										</ul>
																									</div>
																								</div>
																							</div>
																						</div>
																					</div>
																				</button>
																			</h2>
																			<div id="accor_nesting01Examplecollapsec0" class="accordion-collapse collapse" aria-labelledby="accordionnesting01Examplec0" data-bs-parent="#accordionnestingc0">
																				<div class="accordion-body">
																					<div class="mb-10">
																						<div class="red-separator mb-10">
																							<div class="container-fluid nopadding">
																								<div class="row">
																									<div class="col-lg-6 col-md-6 col-sm-6 col-6">
																										<div class="inner-accordion-titles">
																											<label> Love Tennis</label>	
																										</div>
																									</div>
																								</div>
																							</div>
																						</div>
																						<div class="container-fluid nopadding">
																							<div class="row">
																								<div class="col-lg-6 col-md-6 col-sm-6 col-6">
																									<div class="line-break">
																										<label>BOOKING # </label>
																									</div>
																								</div>
																								<div class="col-lg-6 col-md-6 col-sm-6 col-6">
																									<div class="float-end line-break text-right">
																										<span> FS_20230606160822219 </span>
																									</div>
																								</div>
																								<div class="col-lg-6 col-md-6 col-sm-6 col-6">
																									<div class="line-break">
																										<label>TOTAL PRICE </label>
																									</div>
																								</div>
																								<div class="col-lg-6 col-md-6 col-sm-6 col-6">
																									<div class="float-end line-break text-right">
																										<span>  $817.6 </span>
																									</div>
																								</div>
																								<div class="col-lg-6 col-md-6 col-sm-6 col-6">
																									<div class="line-break">
																										<label>PAYMENT TYPE:</label>
																									</div>
																								</div>
																								<div class="col-lg-6 col-md-6 col-sm-6 col-6">
																									<div class="float-end line-break text-right">
																										<span>visa ****4242</span>
																									</div>
																								</div>
																								<div class="col-lg-6 col-md-6 col-sm-6 col-6">
																									<div class="line-break">
																										<label>TOTAL REMAINING:</label>
																									</div>
																								</div>
																								<div class="col-lg-6 col-md-6 col-sm-6 col-6">
																									<div class="float-end line-break text-right">
																										<span>9/10</span>
																									</div>
																								</div>
																								<div class="col-lg-6 col-md-6 col-sm-6 col-6">
																									<div class="line-break">
																										<label>PROGRAM NAME:</label>
																									</div>
																								</div>
																								<div class="col-lg-6 col-md-6 col-sm-6 col-6">
																									<div class="float-end line-break text-right">
																										<span>Love Tennis </span>
																									</div>
																								</div>
																								<div class="col-lg-6 col-md-6 col-sm-6 col-6">
																									<div class="line-break">
																										<label>CATEGORY NAME:</label>
																									</div>
																								</div>
																								<div class="col-lg-6 col-md-6 col-sm-6 col-6">
																									<div class="float-end line-break text-right">
																										<span>Private Lessons 45 Min. (1 Person) </span>
																									</div>
																								</div>
																								<div class="col-lg-6 col-md-6 col-sm-6 col-6">
																									<div class="line-break">
																										<label>PRICE OPTION:</label>
																									</div>
																								</div>
																								<div class="col-lg-6 col-md-6 col-sm-6 col-6">
																									<div class="float-end line-break text-right">
																										<span>45 Minute Private (10 Pack) </span>
																									</div>
																								</div>
																								<div class="col-lg-6 col-md-6 col-sm-6 col-6">
																									<div class="line-break">
																										<label>ACTIVATION START DATE:</label>
																									</div>
																								</div>
																								<div class="col-lg-6 col-md-6 col-sm-6 col-6">
																									<div class="float-end line-break text-right">
																										<span> 06/06/2023</span>
																									</div>
																								</div>
																															
																								<div class="col-lg-6 col-md-6 col-sm-6 col-6">
																									<div class="line-break">
																										<label>EXPIRATION DATE:</label>
																									</div>
																								</div>
																								<div class="col-lg-6 col-md-6 col-sm-6 col-6">
																									<div class="float-end line-break text-right">
																										<span> 10/06/2023</span>
																									</div>
																								</div>
																															
																								<div class="col-lg-6 col-md-6 col-sm-6 col-6">
																									<div class="line-break">
																										<label>DATE BOOKED:	</label>
																									</div>
																								</div>
																								<div class="col-lg-6 col-md-6 col-sm-6 col-6">
																									<div class="float-end line-break text-right">
																										<span>06/06/2023</span>
																									</div>
																								</div>
																																
																								<div class="col-lg-6 col-md-6 col-sm-6 col-6">
																									<div class="line-break">
																										<label>BOOKING TIME: </label>
																									</div>
																								</div>
																								<div class="col-lg-6 col-md-6 col-sm-6 col-6">
																									<div class="float-end line-break text-right">
																										<span> 07:00 PM</span>
																									</div>
																								</div>
																								<div class="col-lg-6 col-md-6 col-sm-6 col-6">
																									<div class="line-break">
																										<label>BOOKED BY:</label>
																									</div>
																								</div>
																								<div class="col-lg-6 col-md-6 col-sm-6 col-6">
																									<div class="float-end line-break text-right">
																										<span>Darryl Smith (Demo (In person)</span>
																									</div>
																								</div>
																								<div class="col-lg-6 col-md-6 col-sm-6 col-6">
																									<div class="line-break">
																										<label>ACTIVITY TYPE:</label>
																									</div>
																								</div>
																								<div class="col-lg-6 col-md-6 col-sm-6 col-6">
																									<div class="float-end line-break text-right">
																										<span>Tennis</span>
																									</div>
																								</div>
																								<div class="col-lg-6 col-md-6 col-sm-6 col-6">
																									<div class="line-break">
																										<label>SERVICE TYPE:</label>
																									</div>
																								</div>
																								<div class="col-lg-6 col-md-6 col-sm-6 col-6">
																									<div class="float-end line-break text-right">
																										<span>Personal Training</span>
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
													</div>
												</div>
											</div>
										</div>	    				    																	        																	    																	 
										<div class="accordion-item shadow">
											<h2 class="accordion-header" id="accordionnesting2Example2">
												<button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#accor_nesting2Examplecollapse2" aria-expanded="false" aria-controls="accor_nesting2Examplecollapse2">
													Purchase history - total $40741.55  
												</button>
											</h2>
											<div id="accor_nesting2Examplecollapse2" class="accordion-collapse collapse" aria-labelledby="accordionnesting2Example2" data-bs-parent="#accordionnesting2">
												<div class="accordion-body">
													<div class="purchase-history">
														<div class="table-responsive">
															<table class="table mb-0">
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
																<tbody>
																	<tr>
																		<td>05/30/2023</td>
																		<td>1. Love Tennis (Private Lessons 45 Min. (1 Person)) ,45 Minute Private (5 Pack)<br></td>
																		<td>Membership</td>
																		<td>visa ****4242</td>
																		<td>$584</td>
																		<td>1</td>
																		<td>
																			<a href="#" data-behavior="ajax_html_modal" data-url="http://dev.fitnessity.co/business/68/void_or_refund_modal?id=215&amp;booking_detail_id=1184&amp;booking_id=1352" data-modal-width="modal-100">Void</a>
																		</td>
																		<td><a class="mailRecipt" data-behavior="send_receipt" data-url="http://dev.fitnessity.co/receiptmodel/1012/215" data-item-type="Membership" data-modal-width="modal-70"><i class="far fa-file-alt" aria-hidden="true"></i></a>
																		</td>
																	</tr>
																																																			 
																	<tr>
																		<td>06/06/2023</td>
																		<td>1. Love Tennis (Private Lessons 45 Min. (1 Person)) ,45 Minute Private (10 Pack)<br></td>
																		<td>Membership</td>
																		<td>visa ****4242</td>
																		<td>$817.6</td>
																		<td>1</td>
																		<td>
																			<a href="#" data-behavior="ajax_html_modal" data-url="http://dev.fitnessity.co/business/68/void_or_refund_modal?id=215&amp;booking_detail_id=1184&amp;booking_id=1352" data-modal-width="modal-100">Void</a>
																		</td>
																		<td><a class="mailRecipt" data-behavior="send_receipt" data-url="http://dev.fitnessity.co/receiptmodel/1014/215" data-item-type="Membership" data-modal-width="modal-70"><i class="far fa-file-alt" aria-hidden="true"></i></a>
																		</td>
																	</tr>
																																																			 
																	<tr>
																		<td>06/09/2023</td>
																		<td>1. Love Tennis (Private Lessons 30 Min. (1 Person)) ,30 Minute Private (05 Pack)<br></td>
																		<td>Membership</td>
																		<td>visa ****4242</td>
																		<td>$642.4</td>
																		<td>1</td>
																		<td>
																			<a href="#" data-behavior="ajax_html_modal" data-url="http://dev.fitnessity.co/business/68/void_or_refund_modal?id=215&amp;booking_detail_id=1184&amp;booking_id=1352" data-modal-width="modal-100">Void</a>
																		</td>
																		<td><a class="mailRecipt" data-behavior="send_receipt" data-url="http://dev.fitnessity.co/receiptmodel/1015/215" data-item-type="Membership" data-modal-width="modal-70"><i class="far fa-file-alt" aria-hidden="true"></i></a>
																		</td>
																	</tr>
																		
																</tbody>
															</table>
														</div>
													</div>
												</div>
											</div>
										</div>
										
										<div class="accordion-item shadow">
											<h2 class="accordion-header" id="accordionnesting8Example2">
												<button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#accor_nesting8Examplecollapse2" aria-expanded="false" aria-controls="accor_nesting8Examplecollapse2">
													<div class="container-fluid nopadding">
														<div class="row  y-middle">
															<div class="col-lg-6 col-md-6 col-8">
																Connected Family Accounts (3)
															</div>
															<div class="col-lg-6 col-md-6 col-4">
																<div class="multiple-options">
																	<div class="setting-icon">
																		<i class="ri-more-fill"></i>
																		<ul>
																			<li><a href="#" onclick="redirctAddfamily(215);"><i class="fas fa-plus text-muted"></i>Add</a></li>
																		</ul>
																	</div>
																</div>
															</div>
														</div>
													</div>
												</button>
											</h2>
											<div id="accor_nesting8Examplecollapse2" class="accordion-collapse collapse" aria-labelledby="accordionnesting8Example2" data-bs-parent="#accordionnesting8">
												<div class="accordion-body">
													<div class="row">
														<div class="col-md-12">
															<form class="app-search d-none d-md-block mb-10 float-right">
																<div class="position-relative">
																	<input type="text" class="form-control ui-autocomplete-input" placeholder="Search for family member" autocomplete="off" id="serchFamilyMember" name="fname" value="">
																</div>
															</form>
														</div>						
													</div>
													<div class="purchase-history">
														<div class="table-responsive">
															<table class="table mb-0">
																<thead>
																	<tr>
																		<th>Name</th>
																		<th>Relationship</th>
																		<th>Age</th>
																		<th class="action-width">Action</th>
																	</tr>
																</thead>
																<tbody>
																	<tr>
																		<td> Odin Smith </td>
																		<td>0</td>
																		<td>11</td>
																		<td class="text-center">
																			<a onclick="deleteMember(274)" class="btn btn-red mmb-10">Delete</a>

																			<a href="#" trget="_blank" onclick="redirctAddfamily(215);" class="btn btn-black mmb-10">Edit</a>

																			<a href="http://dev.fitnessity.co/business/68/customers/274" class="btn btn-red mmb-10">View</a>
																		</td>
																	</tr>
																	<tr>
																		<td> Darryl Waters </td>
																		<td>0</td>
																		<td>41</td>
																		<td class="text-center">
																			<a onclick="deleteMember(295)" class="btn btn-red mmb-10">Delete</a>
																			<a href="#" trget="_blank" onclick="redirctAddfamily(215);" class="btn btn-black mmb-10">Edit</a>
																			<a href="http://dev.fitnessity.co/business/68/customers/295" class="btn btn-red mmb-10">View</a>
																		</td>
																	</tr>
																	<tr>
																		<td> Derick Davis </td>
																		<td>0</td>
																		<td>0</td>
																		<td class="text-center">
																			<a onclick="deleteMember(296)" class="btn btn-red mmb-10">Delete</a>

																			<a href="#" trget="_blank" onclick="redirctAddfamily(215);" class="btn btn-black mmb-10">Edit</a>

																			<a href="http://dev.fitnessity.co/business/68/customers/296" class="btn btn-red mmb-10">View</a>
																		</td>					
																	</tr>
																</tbody>
															</table>
														</div>
													</div>
												</div>
											</div>
										</div>

										<div class="accordion-item shadow">
											<h2 class="accordion-header" id="accordionnesting6Example2">
												<button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#accor_nesting6Examplecollapse2" aria-expanded="false" aria-controls="accor_nesting6Examplecollapse2">
													Attendance History
												</button>
											</h2>
											<div id="accor_nesting6Examplecollapse2" class="accordion-collapse collapse" aria-labelledby="accordionnesting6Example2" data-bs-parent="#accordionnesting6">
												<div class="accordion-body">
													<div class="row">
														<div class="col-md-12 col-xs-12">
															<div class="visit-table-data">
																<label>Total Number of Visits:</label>
																<span>12</span>
															</div>
														</div>
													</div>
													<div class="purchase-history">
														<div class="table-responsive">
															<table class="table mb-0">
																<thead>
																	<tr>
																		<th>Date</th>
																		<th>Time</th>
																		<th>Program Name </th>
																		<th>Program Title </th>
																		<th>Status</th>
																		<th>Instructor</th>
																	</tr>
																</thead>
																<tbody>
																	<tr>
																		<td>12/07/2023</td>
																		<td>07:00 PM</td>
																		<td>Love Tennis</td>
																		<td>45 Minute Private (5 Pack)</td>
																		<td>
																			<a class="font-red" onclick="getCheckInDetails(68, 1125 ,'2023-12-07','215');">Unprocess</a>
																		</td>
																		<td>Franecki Ardella</td>
																	</tr>
																	<tr>
																		<td>12/02/2023</td>
																		<td>07:00 PM</td>
																		<td>Love Tennis</td>
																		<td>45 Minute Private (10 Pack)</td>
																		<td>
																			<a class="font-red" onclick="getCheckInDetails(68, 1174 ,'2023-12-02','215');">Unprocess</a>
																		</td>
																		<td>Franecki Ardella</td>
																	</tr>
																</tbody>
															</table>
														</div>
													</div>
												</div>
											</div>
										</div>
																	
										<div class="accordion-item shadow">
											<h2 class="accordion-header" id="accordionnesting9Example2">
												<button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#accor_nesting9Examplecollapse2" aria-expanded="false" aria-controls="accor_nesting9Examplecollapse2">
													<div class="container-fluid nopadding">
														<div class="row y-middle">
															<div class="col-lg-6 col-md-6 col-8">
																Credit Card Info     <span class="font-green ml-15">  CC  </span>  (1)   
															</div>
															<div class="col-lg-6 col-md-6 col-4">
																<div class="multiple-options">
																	<div class="setting-icon">
																		<i class="ri-more-fill"></i>
																		<ul>
																			<li>
																				<a href="#" data-modal-width=" " data-behavior="ajax_html_modal" data-url="http://dev.fitnessity.co/business/68/customers/card_editing_form?customer_id=215&amp;return_url=http%3A%2F%2Fdev.fitnessity.co%2Fbusiness%2F68%2Fcustomers%2F215">
																				<i class="fas fa-plus text-muted"></i>Add</a>
																			</li>
																		</ul>
																	</div>
																</div>
															</div>
														</div>
													</div>
												</button>
											</h2>
											<div id="accor_nesting9Examplecollapse2" class="accordion-collapse collapse" aria-labelledby="accordionnesting9Example2" data-bs-parent="#accordionnesting9">
												<div class="accordion-body">
													<div class="row">
														<div class="col-lg-6 col-md-6 col-sm-6 col-12">
															<div class="cards-block dispalycard" style="cursor: pointer" data-name="" data-cvv="4242" data-cnumber="2" data-month="2" data-year="$card->exp_year" data-type="visa" data-id="83">
																<div class="cards-content" style="background-image: url(http://dev.fitnessity.co/public/img/visa-card-bg.jpg);">
																	<img src="http://dev.fitnessity.co/public/images/creditcard/visa.jpg" alt="">
																	<span></span>
																	<p>Visa</p>
																	<span>
																		<span class="dots"></span><span class="dots"></span><span class="dots"></span><span class="dots"></span>4242 
																	</span>

																	<a class="float-end card-remove" data-behavior="delete_card" data-url="http://dev.fitnessity.co/stripe_payment_methods/pm_1MniI6Cr65ASmcsq2SJgyCoJ" data-cardid="83">
																		<i class="fa fa-trash"></i> 
																	</a>
																</div>
															</div>
														</div>
													</div> 
												</div>
											</div>
										</div>
																	
										<div class="accordion-item shadow">
											<h2 class="accordion-header" id="accordionnesting10Example2">
												<button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#accor_nesting10Examplecollapse2" aria-expanded="false" aria-controls="accor_nesting10Examplecollapse2">
													<div class="container-fluid nopadding">
														<div class="row y-middle">
															<div class="col-lg-6 col-md-6 col-8">
																Customer Notes &amp; Alerts (3)
															</div>
															<div class="col-lg-6 col-md-6 col-4">
																<div class="multiple-options">
																	<div class="setting-icon">
																		<i class="ri-more-fill"></i>
																		<ul>
																			<li><a onclick="getNote('');"><i class="fas fa-plus text-muted"></i>Add</a></li>
																		</ul>
																	</div>
																</div>
															</div>
														</div>
													</div>
												</button>
											</h2>
											<div id="accor_nesting10Examplecollapse2" class="accordion-collapse collapse" aria-labelledby="accordionnesting10Example2" data-bs-parent="#accordionnesting10">
												<div class="accordion-body">
													<div class="container-fluid nopadding">
														<div class="row">
															<div class="col-md-11 mb-10">
																<div class="row">
																	<div class="col-md-2"><p>This is a test</p></div>
																	<div class="col-md-2">Nov 23, 2023 </div>
																	<div class="col-md-3">Due Nov 30, 2023 , 01:15 PM </div>
																	<div class="col-md-3">Not visible to member</div>
																	<div class="col-md-2">Added by Nipa Soni (Demo)</div>
																</div>
															</div>
															<div class="col-md-1">
																<div class="multiple-options">
																	<div class="setting-icon">
																		<i class="ri-more-fill"></i>
																		<ul>
																			<li><a onclick="getNote(14)"><i class="fas fa-plus text-muted"></i>Edit</a></li>
																			<li><a onclick="deleteNote(14)"><i class="fas fa-plus text-muted"></i>Delete</a></li>
																		</ul>
																	</div>
																</div>
															</div>
														</div>
																																													
														<div class="row">
															<div class="col-md-11 mb-10">
																<div class="row">
																	<div class="col-md-2"><p>This is a reminder test for locker rentals for Mateo</p></div>
																	<div class="col-md-2">Nov 23, 2023 </div>
																	<div class="col-md-3">Due Nov 30, 2023 , 01:00 PM </div>
																	<div class="col-md-3">Not visible to member</div>
																	<div class="col-md-2">Added by Nipa Soni (Demo)</div>
																</div>
															</div>
																								
															<div class="col-md-1">
																<div class="multiple-options">
																	<div class="setting-icon">
																		<i class="ri-more-fill"></i>
																		<ul>
																			<li><a onclick="getNote(15)"><i class="fas fa-plus text-muted"></i>Edit</a></li>
																			<li><a onclick="deleteNote(15)"><i class="fas fa-plus text-muted"></i>Delete</a></li>
																		</ul>
																	</div>
																</div>
															</div>
														</div>
														<div class="row">
															<div class="col-md-11">
																<div class="row">
																	<div class="col-md-2"><p>This is a note test</p></div>
																	<div class="col-md-2">Nov 27, 2023 </div>
																	<div class="col-md-3">Due Nov 30, 2023 , 01:00 PM </div>
																	<div class="col-md-3">Not visible to member</div>
																	<div class="col-md-2">Added by Nipa Soni (Demo)</div>
																</div>
															</div>
																								
															<div class="col-md-1">
																<div class="multiple-options">
																	<div class="setting-icon">
																		<i class="ri-more-fill"></i>
																		<ul>
																			<li><a onclick="getNote(16)"><i class="fas fa-plus text-muted"></i>Edit</a></li>
																			<li><a onclick="deleteNote(16)"><i class="fas fa-plus text-muted"></i>Delete</a></li>
																		</ul>
																	</div>
																</div>
															</div>
														</div>
																																											
													</div>
												</div>
											</div>
										</div>
																	
										<div class="accordion-item shadow">
											<h2 class="accordion-header" id="accordionnesting11Example2">
												<button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#accor_nesting11Examplecollapse2" aria-expanded="false" aria-controls="accor_nesting11Examplecollapse2">
													Documents &amp; Contracts
												</button>
											</h2>
											<div id="accor_nesting11Examplecollapse2" class="accordion-collapse collapse" aria-labelledby="accordionnesting11Example2" data-bs-parent="#accordionnesting11">
																			
												<div class="accordion-body">
													<div class="row">
														<div class="col-lg-12 col-md-12 col-sm-12">
															<a href="#" class="btn btn-red float-end mmb-10" data-bs-toggle="modal" data-bs-target=".terms">Edit</a>
														</div>
													</div>
													<div class="mini-stats-wid d-flex align-items-center mt-3 cardinfo">
														<div class="container-fluid nopadding">
															<div class="row">
																<div class="col-lg-10 col-md-10 col-10">
																	<span>1.</span>
																	<span>Covid-19 Protocols agreed on  01/16/2023  </span>
																</div>
																<div class="col-lg-2 col-md-2 col-2">
																	<div class="multiple-options">
																		<div class="setting-icon">
																			<i class="ri-more-fill"></i>
																			<ul>
																				<li>
																					<a onclick="printTerms('covidDiv' ,'Covid')">
																						<i class="fas fa-plus text-muted"></i>Print
																					</a>
																				</li>
																				<li>
																					<a onclick="emailTerms('covidDiv',68,'Covid',215)">
																						<i class="fas fa-plus text-muted"></i>Email
																					</a>
																				</li>
																			</ul>
																		</div>
																	</div>
																</div>
																<div class="col-lg-10 col-md-10 col-10">
																	<span> 2. </span>
																	<span>Liability Waiver   agreed on 01/16/2023   </span>
																</div>
																<div class="col-lg-2 col-md-2 col-2">
																	<div class="multiple-options">
																		<div class="setting-icon">
																			<i class="ri-more-fill"></i>
																			<ul>
																				<li>
																					<a onclick="printTerms('liabilityDiv' ,'Liability')">
																						<i class="fas fa-plus text-muted"></i>Print
																					</a>
																				</li>
																				<li>
																					<a onclick="emailTerms('liabilityDiv',68,'Liability',215)">
																						<i class="fas fa-plus text-muted"></i>Email
																					</a>
																				</li>
																			</ul>
																		</div>
																	</div>
																</div>
																<div class="col-lg-10 col-md-10 col-10">
																	<span>3. </span>
																	<span>Contract Terms  agreed on 01/16/2023 </span>
																</div>
																<div class="col-lg-2 col-md-2 col-2">
																	<div class="multiple-options">
																		<div class="setting-icon">
																			<i class="ri-more-fill"></i>
																			<ul>
																				<li>
																					<a onclick="printTerms('contractDiv' , 'Contract')">
																						<i class="fas fa-plus text-muted"></i>Print
																					</a>
																				</li>
																				<li>
																					<a onclick="emailTerms('contractDiv',68,'Contract',215)">
																						<i class="fas fa-plus text-muted"></i>Email
																					</a>
																				</li>
																			</ul>
																		</div>
																	</div>
																</div>
																<div class="col-lg-10 col-md-10 col-10">
																	<span>4. </span>
																	<span>Refund Policy </span>
																</div>
																<div class="col-lg-2 col-md-2 col-2">
																	<div class="multiple-options">
																		<div class="setting-icon">
																			<i class="ri-more-fill"></i>
																			<ul>
																				<li>
																					<a onclick="printTerms('refundDiv' , 'Refund')">
																						<i class="fas fa-plus text-muted"></i>Print
																					</a>
																				</li>
																				<li>
																					<a onclick="emailTerms('refundDiv',68,'Refund',215)">
																						<i class="fas fa-plus text-muted"></i>Email
																					</a>
																				</li>
																			</ul>
																		</div>
																	</div>
																</div>
																<div class="col-lg-10 col-md-10 col-10">
																	<span>5. </span>
																	<span>Terms, Conditions, FAQ </span>
																</div>
																<div class="col-lg-2 col-md-2 col-2">
																	<div class="multiple-options">
																		<div class="setting-icon">
																			<i class="ri-more-fill"></i>
																			<ul>
																				<li>
																					<a onclick="printTerms('termsDiv' , 'Terms')">
																						<i class="fas fa-plus text-muted"></i>Print
																					</a>
																				</li>
																				<li>
																					<a onclick="emailTerms('termsDiv',68,'Terms',215)">
																						<i class="fas fa-plus text-muted"></i>Email
																					</a>
																				</li>
																			</ul>
																		</div>
																	</div>
																</div>
															</div>
														</div>
													</div>

													<div class="accordion-item shadow">
														<h2 class="accordion-header" id="accordionnesting">
															<button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#accor_nesting" aria-expanded="false" aria-controls="accor_nesting">
																<div class="container-fluid nopadding">
																	<div class="row  y-middle">
																		<div class="col-lg-6 col-md-6 col-8"> Documents
																		</div>
																		<div class="col-lg-6 col-md-6 col-4">
																			<div class="multiple-options">
																				<div class="setting-icon">
																					<i class="ri-more-fill"></i>
																					<ul>
																						<li><a href="#" data-bs-toggle="modal" data-bs-target=".documents"><i class="fas fa-plus text-muted"></i>Add</a></li>
																					</ul>
																				</div>
																			</div>
																		</div>
																	</div>
																</div>
															</button>
														</h2>
														<div id="accor_nesting" class="accordion-collapse collapse" aria-labelledby="accordionnesting" data-bs-parent="#accordionnesting8">
															<div class="accordion-body">
																<div class="row">
																	
																	<div class="col-md-2"><a href="#" onclick="event.preventDefault(); openDocumentModal('10','load')"><i class="fas fa-download"></i> Test Doc 1</a></div>
																	<div class="col-md-4"><i class="fas fa-paperclip"></i> Uploaded on 11/30/2023</div>
																	<div class="col-md-4"> Uploaded by Nipa Soni (Demo)</div>																	
																	<div class="col-md-2">
																		<div class="multiple-options">
																			<div class="setting-icon">
																				<i class="ri-more-fill"></i>
																				<ul>
																					<li><a onclick="requestSign(10)"><i class="fas fa-plus text-muted"></i>Request Signature</a></li>
																					<li><a onclick="openModalDoc(10)"><i class="fas fa-plus text-muted"></i>Request Document</a></li>
																					<li><a onclick="event.preventDefault(); openDocumentModal('10','load')"><i class="fas fa-plus text-muted"></i>Download</a></li>
																					<li><a onclick="deleteDoc(10)"><i class="fas fa-plus text-muted"></i>Delete </a></li>
																				</ul>
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
							</div>
						</div>
					
						
					</div><!-- end card-body -->
				</div><!-- end card -->
            </div>
        </div>
        <!--end offcanvas-body-->
    </div>


@include('layouts.business.footer')

@endsection
