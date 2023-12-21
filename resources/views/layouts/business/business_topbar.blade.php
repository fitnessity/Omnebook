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
    <script src="{{asset('/public/dashboard-design/js/layout.js')}}"></script>
    <!-- Bootstrap Css -->
    <link href="{{asset('/public/dashboard-design/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('/public/dashboard-design/css/simplebar.min.css')}}" rel="stylesheet" type="text/css" />
	
    <!-- Style Css-->
    <link href="{{asset('/public/dashboard-design/css/style.css')}}" rel="stylesheet" type="text/css" />
	
	<!-- Custom Css-->
    <link href="{{asset('/public/dashboard-design/css/custom.css')}}" rel="stylesheet" type="text/css" />
	<link href="{{asset('/public/dashboard-design/css/responsive.css')}}" rel="stylesheet" type="text/css" />
	
	<!-- icon -->
	<link href="{{asset('/public/dashboard-design/css/icons.min.css')}}" rel="stylesheet" type="text/css" />

	<link href="{{asset('/public/css/slimselect.min.css')}}" rel="stylesheet" type="text/css" />
	<link href="{{asset('/public/js/select/select.css')}}" rel="stylesheet" type="text/css" />
	<script src="{{asset('/public/dashboard-design/js/plugins.js')}}"></script>
	
	<!-- fullcalendar css >-->
	<link rel="stylesheet" type="text/css" href="{{ url('public/css/metismenu.min.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ url('public/css/fullcalendar/fullcalendar.min.css') }}"> 
	

	<!-- dropzone css -->
	<link href="{{asset('/public/dashboard-design/css/dropzone.css')}}" rel="stylesheet" type="text/css" />
	
	<!-- glightbox css -->
	<link href="{{asset('/public/dashboard-design/css/glightbox.min.css')}}" rel="stylesheet" type="text/css" />
	
	<!-- app css 
	<link href="{{asset('/public/dashboard-design/css/app.min.css')}}" rel="stylesheet" type="text/css" />-->
</head>

 <!-- Begin page -->
    <div id="layout-wrapper printnone">
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

						<!-- App Search-->
						<form class="app-search d-none d-md-block">
							<div class="position-relative">
								<input type="text" class="form-control" placeholder="Search for client" autocomplete="off" id="serchclient_navbar"  name="fname" value="{{Request::get('fname')}}">
							</div>
						</form>
						<div class="app-search">
							<a href="#" class="add-client mobile-none"  data-bs-toggle="modal" data-bs-target=".new-client-steps">Add New Client</a>
						</div>
					</div>

					<div class="d-flex align-items-center">

						<!--<div class="dropdown d-md-none topbar-head-dropdown header-item">
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
								<span class="position-absolute topbar-badge fs-10 translate-middle badge rounded-pill bg-danger">{{count(getNotificationDashboard(''))}}<span class="visually-hidden">unread messages</span></span>
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
													All ({{count(getNotificationDashboard(''))}})
												</a>
											</li>
											<li class="nav-item waves-effect waves-light">
												<a class="nav-link" data-bs-toggle="tab" href="#messages-tab" role="tab" aria-selected="false">
													Messages (0)
												</a>
											</li>
											<li class="nav-item waves-effect waves-light">
												<a class="nav-link" data-bs-toggle="tab" href="#alerts-tab" role="tab" aria-selected="false">
													Alerts ({{count(getNotificationDashboard('Alert'))}})
												</a>
											</li>
										</ul>
									</div>
								</div>

								<div class="tab-content position-relative" id="notificationItemsTabContent">
									<div class="tab-pane fade show active py-2 ps-2" id="all-noti-tab" role="tabpanel">
										<div data-simplebar style="max-height: 300px;" class="pe-2">
											@forelse(getNotificationDashboard('') as $n)
												<div class="text-reset notification-item d-block dropdown-item">
													<div class="d-flex">
														@php
															if($n->table == 'CustomerNotes'){
																$profilePic = $n->CustomerNotes->customer->profile_pic_url;
																$firstLetter = $n->CustomerNotes->customer->first_letter;
																$fullName = $n->CustomerNotes->customer->full_name;
																$text = $n->CustomerNotes->limit_note_character;
															}else if($n->table == 'CustomersDocuments'){
																$profilePic = $n->CustomersDocuments->Customer->profile_pic_url;
																$firstLetter = $n->CustomersDocuments->Customer->first_letter;
																$fullName = $n->CustomersDocuments->Customer->full_name;
																$text = $n->CustomersDocuments->title.' document is signed by '.$fullName;
															}else if($n->table == 'Customer'){
																$profilePic = $n->Customer->profile_pic_url;
																$firstLetter = $n->Customer->first_letter;
																$fullName = $n->Customer->full_name;
																$text = 'Terms is signed by '.$fullName;
															}else if($n->table == 'CustomerDocumentsRequested'){
																$profilePic = $n->CustomerDocumentsRequested->Customer->profile_pic_url;
																$firstLetter = $n->CustomerDocumentsRequested->Customer->first_letter;
																$fullName = $n->CustomerDocumentsRequested->Customer->full_name;
																$text = $n->CustomerDocumentsRequested->content .' is uploded by '.$fullName;
															}else if($n->table == 'User'){
																$profilePic = $n->User->getPic();
																$firstLetter = $n->User->first_letter;
																$fullName = $n->User->full_name;
																$text = 'Granted Access by '.$fullName.' on '.date('m/d/Y',strtotime($n->display_date));
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
																	<div class="col-md-7">
																		<a @if($n->table != 'User') href="{{route('business_customer_show' ,['business_id'=> Auth::user()->cid, 'id' =>$n->customer_id])}}" @endif >
																			<h6 class="mt-0 mb-1 fs-13 fw-semibold">{{$fullName}}</h6>
																		</a>

																	</div>
																	<div class="col-md-2">
																		 @if($n->table != 'User') <a href="{{route('business_customer_show' ,['business_id'=> Auth::user()->cid, 'id' =>$n->customer_id])}}" class="mb-0">View</a> @endif 
																	</div>
																	<div class="col-md-3">
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
											@forelse(getNotificationDashboard('Alert') as $n)
												<input type="hidden" id="alertIds" value="{{ implode(',', getNotificationDashboard('Alert')->pluck('id')->toArray())}}">
												<div class="text-reset notification-item d-block dropdown-item">
													<div class="d-flex">
														@php
															if($n->table == 'CustomerNotes'){
																$profilePic = $n->CustomerNotes->customer->profile_pic_url;
																$firstLetter = $n->CustomerNotes->customer->first_letter;
																$fullName = $n->CustomerNotes->customer->full_name;
																$text = $n->CustomerNotes->limit_note_character;
															}else if($n->table == 'CustomersDocuments'){
																$profilePic = $n->CustomersDocuments->Customer->profile_pic_url;
																$firstLetter = $n->CustomersDocuments->Customer->first_letter;
																$fullName = $n->CustomersDocuments->Customer->full_name;
																$text = $n->CustomersDocuments->title.' document is signed by '.$fullName;
															}else if($n->table == 'Customer'){
																$profilePic = $n->Customer->profile_pic_url;
																$firstLetter = $n->Customer->first_letter;
																$fullName = $n->Customer->full_name;
																$text = 'Terms is signed by '.$fullName;
															}else if($n->table == 'CustomerDocumentsRequested'){
																$profilePic = $n->CustomerDocumentsRequested->Customer->profile_pic_url;
																$firstLetter = $n->CustomerDocumentsRequested->Customer->first_letter;
																$fullName = $n->CustomerDocumentsRequested->Customer->full_name;
																$text = $n->CustomerDocumentsRequested->content .' is uploded by '.$fullName;
															}else if($n->table == 'User'){
																$profilePic = $n->User->getPic();
																$firstLetter = $n->User->first_letter;
																$fullName = $n->User->full_name;
																$text = 'Granted Access by '.$fullName.' on '.date('m/d/Y',strtotime($n->display_date));
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
																	<div class="col-md-7">
																		<a @if($n->table != 'User') href="{{route('business_customer_show' ,['business_id'=> Auth::user()->cid, 'id' =>$n->customer_id])}}" @endif  >
																			<h6 class="mt-0 mb-1 fs-13 fw-semibold">{{$fullName}}</h6>
																		</a>

																	</div>
																	<div class="col-md-2">
																		<a @if($n->table != 'User') href="{{route('business_customer_show' ,['business_id'=> Auth::user()->cid, 'id' =>$n->customer_id])}}" @endif  class="mb-0">View</a>
																	</div>
																	<div class="col-md-3">
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

											@if(count(getNotificationDashboard('Alert')) > 0)
												<div class="text-center">
													<button type="button" class="btn btn-red text-center clearAlert">Clear All Alerts</button>
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

		@include('customers._add_new_client_modal')


		@include('layouts.business.businesssidebar')

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

	$(document).ready(function () {
     	var business_id = '{{Auth::user()->cid}}';
     	var url = "{{ url('/business/business_id/customers') }}";
     	url = url.replace('business_id', business_id);

     	$( "#serchclient_navbar" ).autocomplete({
         source: url,
         focus: function( event, ui ) {
              return false;
         },
         select: function( event, ui ) {
             window.location.href = "/business/"+business_id+"/customers/"+ui.item.id;
              return false;
         }
     	}).data( "ui-autocomplete" )._renderItem = function( ul, item ) {
         let profile_img = '<div class="collapse-img"><div class="company-list-text" style="height: 50px;width: 50px;"><p style="padding: 0;">' + item.fname.charAt(0).toUpperCase() + '</p></div></div> ';

         if(item.profile_pic_url){
             profile_img = '<img class="searchbox-img" src="' + (item.profile_pic_url ? item.profile_pic_url : '') + '" style="">';            
         }

         var inner_html = '<div class="row rowclass-controller"></div><div class="row"><div class="col-lg-3 col-md-3 col-3 nopadding text-center">' + profile_img + '</div><div class="col-lg-9 col-md-9 col-9 div-controller">' + 
                   '<p class="pstyle"><label class="liaddress">' + item.fname + ' ' +  item.lname  + (item.age ? ' (' + item.age+ '  Years Old)' : '') + '</label></p>' +
                   '<p class="pstyle liaddress">' + item.email +'</p>' + 
                   '<p class="pstyle liaddress">' + item.phone_number + '</p></div></div>';
        
         return $( "<li></li>" )
                 .data( "item.autocomplete", item )
                 .append(inner_html)
                 .appendTo( ul );
     	};

     	$( "#serchclient_navbar1" ).autocomplete({
         source: url,
         focus: function( event, ui ) {
              return false;
         },
         select: function( event, ui ) {
             window.location.href = "/business/"+business_id+"/customers/"+ui.item.id;
              return false;
         }
     	}).data( "ui-autocomplete" )._renderItem = function( ul, item ) {
         let profile_img = '<div class="collapse-img"><div class="company-list-text" style="height: 50px;width: 50px;"><p style="padding: 0;">' + item.fname.charAt(0).toUpperCase() + '</p></div></div> ';

         if(item.profile_pic_url){
             profile_img = '<img class="searchbox-img" src="' + (item.profile_pic_url ? item.profile_pic_url : '') + '" style="">';            
         }

         var inner_html = '<div class="row rowclass-controller"></div><div class="row"><div class="col-lg-3 col-md-3 col-3 nopadding text-center">' + profile_img + '</div><div class="col-lg-9 col-md-9 col-9 div-controller">' + 
                   '<p class="pstyle"><label class="liaddress">' + item.fname + ' ' +  item.lname  + (item.age ? ' (' + item.age+ '  Years Old)' : '') + '</label></p>' +
                   '<p class="pstyle liaddress">' + item.email +'</p>' + 
                   '<p class="pstyle liaddress">' + item.phone_number + '</p></div></div>';
        
         return $( "<li></li>" )
                 .data( "item.autocomplete", item )
                 .append(inner_html)
                 .appendTo( ul );
     	};

     	$('.clearAlert').click(function(e){
     		var id = $('#alertIds').val();  
     		deleteNoteFromNotification(id);
     	});
   });

</script>
