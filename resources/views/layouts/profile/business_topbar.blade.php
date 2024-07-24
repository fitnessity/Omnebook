<html lang="en" data-layout="vertical" data-topbar="light" data-sidebar="dark" data-sidebar-size="lg" data-sidebar-image="none" data-preloader="disable">
<head>
    <meta charset="utf-8" />
    <title>Fitnessity </title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
    <meta content="Themesbrand" name="author" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="assets/images/favicon.ico">
	

    <!-- Layout config Js-->
    <script src="{{url('/public/dashboard-design/js/layout.js')}}"></script>
    <!-- Bootstrap Css -->
    <!-- <link href="{{url('/public/dashboard-design/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css" /> -->
    <link href="{{url('/public/dashboard-design/css/simplebar.min.css')}}" rel="stylesheet" type="text/css" />
	
    <!-- Style Css-->
    <link href="{{url('/public/dashboard-design/css/style.css')}}" rel="stylesheet" type="text/css" />
	
	<!-- Custom Css-->
    <link href="{{url('/public/dashboard-design/css/custom.css')}}" rel="stylesheet" type="text/css" />
	<link href="{{url('/public/dashboard-design/css/responsive.css')}}" rel="stylesheet" type="text/css" />
	
	<!-- icon -->
	<link href="{{url('/public/dashboard-design/css/icons.min.css')}}" rel="stylesheet" type="text/css" />
	<link href="{{url('/public/dashboard-design/css/icons.css')}}" rel="stylesheet" type="text/css" />

	<link href="{{url('/public/css/slimselect.min.css')}}" rel="stylesheet" type="text/css" />
	<link href="{{url('/public/js/select/select.css')}}" rel="stylesheet" type="text/css" />
	<script src="{{url('/public/dashboard-design/js/plugins.js')}}"></script>
	
	<!-- fullcalendar css >-->
	<link rel="stylesheet" type="text/css" href="{{ url('public/css/metismenu.min.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ url('public/css/fullcalendar/fullcalendar.min.css') }}"> 
	

	<!-- dropzone css -->
	<link href="{{url('/public/dashboard-design/css/dropzone.css')}}" rel="stylesheet" type="text/css" />
	
	<!-- glightbox css -->
	<link href="{{url('/public/dashboard-design/css/glightbox.min.css')}}" rel="stylesheet" type="text/css" />
	
	<!-- Emoji icons -->
	<link href="{{url('/public/dashboard-design/css/emojionearea.min.css')}}" rel="stylesheet" type="text/css" />
	
	<!-- app css 
	<link href="{{url('/public/dashboard-design/css/app.min.css')}}" rel="stylesheet" type="text/css" />-->

	<!-- Color Piker Css-->
    <link href="{{url('/public/dashboard-design/css/nano.min.css')}}" rel="stylesheet" type="text/css" />

	<!-- filepond -->
	<link rel="stylesheet" href="{{url('/public/dashboard-design/filepond/filepond.min.css')}}" type="text/css" />
	<link rel="stylesheet" href="{{url('/public/dashboard-design/filepond/filepond-plugin-image-preview.min.css')}}" type="text/css" />

	<link rel="stylesheet" href="{{url('/public/dashboard-design/css/dragula.min.css')}}" type="text/css" />
</head>

 <!-- Begin page -->
    <div id="layout-wrapper">
		<div id="page-topbar">
			<div class="layout-width">
				<div class="navbar-header">
					<div class="d-flex">
						<button type="button" class="btn btn-sm px-3 fs-16 header-item vertical-menu-btn topnav-hamburger shadow-none" id="topnav-hamburger-icon">
							<span class="hamburger-icon">
								<span></span>
								<span></span>
								<span></span>
							</span>
						</button>

					</div>

					<div class="d-flex align-items-center">

						<!-- <div class="dropdown d-md-none topbar-head-dropdown header-item">
							<button type="button" class="btn btn-icon btn-topbar btn-ghost-secondary rounded-circle shadow-none" id="page-header-search-dropdown" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
								<i class="bx bx-search fs-22"></i>
							</button>
							<div class="dropdown-menu dropdown-menu-lg dropdown-menu-end p-0" aria-labelledby="page-header-search-dropdown">
								<form class="p-3">
									<div class="form-group m-0">
										<div class="input-group">
											<input type="text" class="form-control" placeholder="Search for client" autocomplete="off" id="serchclient_navbar1"  name="fname" value="{{Request::get('fname')}}">

											<button class="btn btn-red" type="button"><i class="mdi mdi-magnify"></i></button>
										</div>
									</div>
								</form>
							</div>
						</div>
						<div> 
							<button type="button" class="btn btn-icon btn-topbar btn-ghost-secondary rounded-circle shadow-none desktop-add-client-none" data-bs-toggle="modal" data-bs-target=".new-client-steps">
								<i class='bx bx-message-square-add fs-22' ></i>
							</button>
						</div>-->
					
						<div class="ms-1 header-item d-none d-sm-flex">
							<button type="button" class="btn btn-icon btn-topbar btn-ghost-secondary rounded-circle shadow-none" data-toggle="fullscreen">
								<i class='bx bx-fullscreen fs-22'></i>
							</button>
						</div>

						<div class="ms-1 header-item d-none d-sm-flex">
							<button type="button" class="btn btn-icon btn-topbar btn-ghost-secondary rounded-circle light-dark-mode shadow-none">
								<i class='bx bx-moon fs-22'></i>
							</button>
						</div>

						<div class="dropdown topbar-head-dropdown ms-1 header-item" id="notificationDropdown">
							<button type="button" class="btn btn-icon btn-topbar btn-ghost-secondary rounded-circle shadow-none" id="page-header-notifications-dropdown" data-bs-toggle="dropdown" data-bs-auto-close="outside" aria-haspopup="true" aria-expanded="false">
								<i class='bx bx-bell fs-22'></i>
								<span class="position-absolute topbar-badge fs-10 translate-middle badge rounded-pill bg-danger">{{count(getNotificationPersonal(''))}}<span class="visually-hidden">unread messages</span></span>
							</button>
							<div class="dropdown-menu dropdown-menu-lg dropdown-menu-end p-0" aria-labelledby="page-header-notifications-dropdown">

								<div class="dropdown-head bg-primary bg-pattern rounded-top">
									<div class="p-3">
										<div class="row align-items-center">
											<div class="col">
												<h6 class="m-0 fs-16 fw-semibold text-white"> Notifications </h6>
											</div>
											<!-- <div class="col-auto dropdown-tabs">
												<span class="badge badge-soft-light fs-13"> 4 New</span>
											</div> -->
										</div>
									</div>

									<div class="px-2 pt-2">
										<ul class="nav nav-tabs dropdown-tabs nav-tabs-custom" data-dropdown-tabs="true" id="notificationItemsTab" role="tablist">
											<li class="nav-item waves-effect waves-light">
												<a class="nav-link active" data-bs-toggle="tab" href="#all-noti-tab" role="tab" aria-selected="true">
													All ({{count(getNotificationPersonal(''))}})
												</a>
											</li>
											<li class="nav-item waves-effect waves-light">
												<a class="nav-link" data-bs-toggle="tab" href="#messages-tab" role="tab" aria-selected="false">
													Messages (0)
												</a>
											</li>
											<li class="nav-item waves-effect waves-light">
												<a class="nav-link" data-bs-toggle="tab" href="#alerts-tab" role="tab" aria-selected="false">
													Alerts ({{count(getNotificationPersonal('Alert'))}})
												</a>
											</li>
										</ul>
									</div>
								</div>

								<div class="tab-content position-relative" id="notificationItemsTabContent">
									<div class="tab-pane fade show active py-2 ps-2" id="all-noti-tab" role="tabpanel">
										<div data-simplebar style="max-height: 300px;" class="pe-2">
											@forelse(getNotificationPersonal('') as $n)
												<div class="text-reset notification-item d-block dropdown-item">
													<div class="d-flex">
														@php
															if($n->table == 'CustomerDocumentsRequested'){
																$profilePic = $n->CustomerDocumentsRequested->Customer->profile_pic_url;
																$firstLetter = $n->CustomerDocumentsRequested->Customer->first_letter;
																$fullName = $n->CustomerDocumentsRequested->Customer->full_name;
																$text = $n->CustomerDocumentsRequested->content .' is required to be uploaded.';
																$link = "/personal/documents-contract?business_id=".$n->business_id."&customer_id=".$n->customer_id;
															}else if($n->table == 'CustomersDocuments'){
																$profilePic = $n->CustomersDocuments->Customer->profile_pic_url;
																$firstLetter = $n->CustomersDocuments->Customer->first_letter;
																$fullName = $n->CustomersDocuments->Customer->full_name;
																$text = $n->CustomersDocuments->title .' is required to be signed.';
																$link = "/personal/documents-contract?business_id=".$n->business_id."&customer_id=".$n->customer_id;
															}else if($n->table == 'CustomerNotes'){
																$profilePic = $n->CustomerNotes->customer->profile_pic_url;
																$firstLetter = $n->CustomerNotes->customer->first_letter;
																$fullName = $n->CustomerNotes->customer->full_name;
																$text = $n->CustomerNotes->title;
																$link = "/personal/notes-alerts?business_id=".$n->business_id."&customer_id=".$n->customer_id;
															}

														@endphp
														@if($profilePic)
															<img src="{{$profilePic}}" class="me-3 rounded-circle avatar-xs" alt="user-pic">
														@else
															<div class="avatar-xs me-3">
																<span class="avatar-title bg-soft-danger text-danger rounded-circle fs-14">{{$firstLetter}}</span>
															</div>
														@endif
														<div class="flex-1">
															<div class="">
																<div class="row">
																	<div class="col-md-7 col-12">
																		<a href="{{$link}}" >
																			<h6 class="mt-0 mb-1 fs-13 fw-semibold">{{$fullName}}</h6>
																		</a>

																	</div>
																	<div class="col-md-2 col-2">
																		<a href="{{$link}}" class="mb-0">View</a>
																	</div>
																	<div class="col-md-3 col-3">
																		<a onclick="deleteNoteFromNotification({{$n->id}})" class="mb-0">Delete</a>
																	</div>
																</div>
															</div>
															<div class="fs-13 text-muted mb-0 notetxt">
																{!!$text!!}
															</div>
															<p class="mb-0 fs-11 fw-medium text-uppercase text-muted">
																<span><i class="mdi mdi-clock-outline"></i> {{ timeAgo($n->created_at)}}</span>
															</p>
														</div>
													</div>
												</div> 
											@empty
											@endforelse
										</div>
									</div>

									<div class="tab-pane fade py-2 ps-2" id="messages-tab" role="tabpanel" aria-labelledby="messages-tab">
										<div data-simplebar style="max-height: 300px;" class="pe-2">
										
											<!-- <div class="my-3 text-center view-all">
												<button type="button" class="btn btn-soft-success waves-effect waves-light">View
													All Messages <i class="ri-arrow-right-line align-middle"></i></button>
											</div> -->
										</div>
									</div>

									<div class="tab-pane fade py-2 ps-2" id="alerts-tab" role="tabpanel" aria-labelledby="alerts-tab">
										<div data-simplebar style="max-height: 300px;">
											@if(!empty(getNotificationPersonal('Alert')))
												<input type="hidden" id="alertIds" value="{{ implode(',', getNotificationPersonal('Alert')->pluck('id')->toArray())}}">
											@endif
											@forelse(getNotificationPersonal('Alert') as $n)
												<div class="text-reset notification-item d-block dropdown-item">
													<div class="d-flex">
														@php
															if($n->table == 'CustomerDocumentsRequested'){
																$profilePic = $n->CustomerDocumentsRequested->Customer->profile_pic_url;
																$firstLetter = $n->CustomerDocumentsRequested->Customer->first_letter;
																$fullName = $n->CustomerDocumentsRequested->Customer->full_name;
																$text = $n->CustomerDocumentsRequested->content .' is required to be uploaded.';
																$link = "/personal/documents-contract?business_id=".$n->business_id."&customer_id".$n->customer_id;
															}else if($n->table == 'CustomersDocuments'){
																$profilePic = $n->CustomersDocuments->Customer->profile_pic_url;
																$firstLetter = $n->CustomersDocuments->Customer->first_letter;
																$fullName = $n->CustomersDocuments->Customer->full_name;
																$text = $n->CustomersDocuments->title .' is required to be signed.';
																$link = "/personal/documents-contract?business_id=".$n->business_id."&customer_id".$n->customer_id;
															}else if($n->table == 'CustomerNotes'){
																$profilePic = $n->CustomerNotes->customer->profile_pic_url;
																$firstLetter = $n->CustomerNotes->customer->first_letter;
																$fullName = $n->CustomerNotes->customer->full_name;
																$text = $n->CustomerNotes->title;
																$link = '';
															}

														@endphp
														@if($profilePic)
															<img src="{{$profilePic}}" class="me-3 rounded-circle avatar-xs" alt="user-pic">
														@else
															<div class="avatar-xs me-3">
																<span class="avatar-title bg-soft-danger text-danger rounded-circle fs-14">{{$firstLetter}}</span>
															</div>
														@endif
														<div class="flex-1">
															<div class="">
																<div class="row">
																	<div class="col-md-7 col-12">
																		<a href="{{$link}}" >
																			<h6 class="mt-0 mb-1 fs-13 fw-semibold">{{$fullName}}</h6>
																		</a>

																	</div>
																	<div class="col-md-2 col-2">
																		<a href="{{$link}}" class="mb-0">View</a>
																	</div>
																	<div class="col-md-3 col-3">
																		<a onclick="deleteNoteFromNotification({{$n->id}})" class="mb-0">Delete</a>
																	</div>
																</div>
															</div>
															<div class="fs-13 text-muted mb-0 notetxt">
																{!!$text!!}
															</div>
															<p class="mb-0 fs-11 fw-medium text-uppercase text-muted">
																<span><i class="mdi mdi-clock-outline"></i> {{timeAgo($n->created_at)}}</span>
															</p>
														</div>
													</div>
												</div>
											@empty
											@endforelse

											@if(count(getNotificationPersonal('Alert')) > 0)
												<div class="text-center">
													<button type="button" class="btn btn-red text-center clearAlert" onclick="clearAlert()">Clear All Alerts</button>
												</div>
											@endif
										</div>
									</div>
								</div>
							</div>
						</div>

				
					</div>
				</div>
			</div>
		</div>

		<!-- removeNotificationModal -->
		<div id="removeNotificationModal" class="modal fade zoomIn" tabindex="-1" aria-hidden="true">
		    <div class="modal-dialog modal-dialog-centered">
		        <div class="modal-content">
		            <div class="modal-header">
		                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" id="NotificationModalbtn-close"></button>
		            </div>
		            <div class="modal-body">
		                <div class="mt-2 text-center">
		                    <lord-icon src="https://cdn.lordicon.com/gsqxdxog.json" trigger="loop" colors="primary:#f7b84b,secondary:#f06548" style="width:100px;height:100px"></lord-icon>
		                    <div class="mt-4 pt-2 fs-15 mx-4 mx-sm-5">
		                        <h4>Are you sure ?</h4>
		                        <p class="text-muted mx-4 mb-0">Are you sure you want to remove this Notification ?</p>
		                    </div>
		                </div>
		                <div class="d-flex gap-2 justify-content-center mt-4 mb-2">
		                    <button type="button" class="btn w-sm btn-light" data-bs-dismiss="modal">Close</button>
		                    <button type="button" class="btn w-sm btn-danger" id="delete-notification">Yes, Delete It!</button>
		                </div>
		            </div>
		        </div>
		    </div>
		</div>

		@include('layouts.profile.left_panel')

		<!-- Vertical Overlay-->
        <div class="vertical-overlay"></div>

<script type="text/javascript">

	function deleteNoteFromNotification(id){
		let text = "You are about to delete the Notes from Notification. Are you sure you want to continue?";
		if (confirm(text)) {
	      $.ajax({
	         type: 'POST',
	         url: '/notification/delete/',
	         data:{
	         	'_token':'{{csrf_token()}}',
	         	'id':id,
	         },
	         success: function (data) {
	            window.location.reload();
	         }
	      });
	   }
	}

	function clearAlert(){
		var id = $('#alertIds').val();  
		deleteNoteFromNotification(id);
	}

	</script>