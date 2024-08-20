@inject('request', 'Illuminate\Http\Request')

@extends('layouts.business.header')

@section('content')

@include('layouts.business.business_topbar')

    <!-- ========================= Main ==================== -->
    @include('business.engage-clients.engage_clients_sidebar')
    <div id="page-content-wrapper">
        <div class="container-fluid">
            <a href="#menu-toggle" class="btn btn-black mb-15" id="menu-toggle"><i class="fas fa-bars"></i></a>

            <div class="card">
                <div class="card-body">
                    
					<div class="row mb-3">
						<div class="col-12">
							<div class="page-heading">
								<label>Announcement</label>
							</div>
						</div>
					</div><!--end row-->

					<div class="col-md-12" id="announcement-msg">
		        	</div>
					<div class="row">
						<div class="col-xxl-12">
							<div class="card">	
								<div class="card-header align-items-center d-flex">
									<h4 class="card-title mb-0 flex-grow-1">Action</h4>
								</div>
								<div class="card-body">
									<div class="row y-middle">
										<div class="col-sm-auto">
											<div class="mb-20">
												<button type="button" class="btn btn-red" onclick="createAnnouncement()" data-bs-target="#add_announcements"><i class="ri-add-line align-bottom me-1"></i> Add Announcement</button>
											</div>
										</div>
										<div class="col-sm-auto">
											<div class="mb-20">
												<a class="btn btn-red" href="{{route('business.announcement-category.index')}}"><i class="fas fa-list me-1"></i> Categories </a>
											</div>
										</div>
									</div>
									<div class="row y-middle">
										<div class="col-lg-3">
											<label for="choices-publish-status-input" class="form-label">Category</label>
											<select class="form-select mmb-10" id="category">
												<option value="all"> -All- </option>
												@foreach($category as $c)
												<option value="{{$c->id}}" @if(request()->category == $c->id) selected @endif >{{$c->name}}</option>
												@endforeach
											</select>
										</div>
										<div class="col-lg-3">
											<label for="choices-publish-status-input" class="form-label">Visibility</label>
											<select class="form-select"  id="announcement-status">
												<option value="all" @if(!request()->status) selected @endif > All </option>
												<option value="active" @if(request()->status == 'active') selected @endif > Active </option>
												<option value="inactive" @if(request()->status == 'inactive') selected @endif > Inactive </option>
											</select>
										</div>
									</div>
								</div>
								
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-lg-12">
							<div class="card">
								<div class="card-header">
									<h5 class="card-title mb-0">Announcement</h5>
								</div>
								<div class="card-body">
									<table id="announcement_list" class="table table-bordered dt-responsive nowrap table-striped align-middle" style="width:100%">
										<thead>
											<tr>
												<th data-ordering="false">Title</th>
												<th data-ordering="false">Category</th>
												<th data-ordering="false">List</th>
												<th data-ordering="false">Sent</th>
												<th data-ordering="false">Open</th>
												<th data-ordering="false">Send Date & Time</th>
												<th data-ordering="false">Status</th>
												<th data-ordering="false">Actions</th>
											</tr>
										</thead>
										<tbody>
											@forelse($announcement as $a)
												<tr>
													<td>{{$a->title}}
														@if(@$a->status == 'active') 
															<span class="badge badge-soft-success p-2">Active</span> 
														@else 
															<span class="badge badge-soft-danger p-2"> InActive </span> 
														@endif </td>
													<td>{{$a->category_name}}</td>
													<td>{{count($a->announcementContactList)}}</td>
													<td><a class="openModal"  data-id="{{$a->id}}" >{{$a->announcementContactCustomerList()->sum('is_sent_email')}}</a></td>
													<td><a class="openModal" data-id="{{$a->id}}" >{{$a->announcementContactCustomerList()->sum('is_opened_email')}}</a></td>
													<td id="time{{$a->id}}">@if($a->announcement_date) {{date('m/d/Y', strtotime($a->announcement_date))}}  @if($a->announcement_time) {{date('h:i A', strtotime($a->announcement_time))}} @else No Announcement Time @endif @else No Announcement Date @endif </td>
													<td>{{$a->announcement_status}}</td>
													<td>
														<div class="dropdown d-inline-block">
															<button class="btn btn-red btn-sm dropdown" type="button" data-bs-toggle="dropdown" aria-expanded="false">
																<i class="ri-more-fill align-middle fs-10"></i>
															</button>
															<ul class="dropdown-menu dropdown-menu-end">
																@if ($a->announcement_date > date('Y-m-d') || ($a->announcement_date == date('Y-m-d') && $a->announcement_time > date('H:i')))
																	<li><a class="dropdown-item edit-item-btn" onclick="editAnnouncement('{{$a->id}}','edit')"><i class="ri-pencil-fill align-bottom me-2 text-muted"></i> Edit</a></li>
																@else
																	<li><a class="dropdown-item edit-item-btn" onclick="editAnnouncement('{{$a->id}}','duplicate')"><i class="ri-pencil-fill align-bottom me-2 text-muted"></i> Duplicate</a></li>
																@endif
																<li>
																	<a class="dropdown-item remove-item-btn" onclick="deleteAnnouncement({{$a->id}})">
																		<i class="ri-delete-bin-fill align-bottom me-2 text-muted"></i> Delete
																	</a>
																</li>

																<li>
																	<a class="dropdown-item">
																		<i class="ri-share-fill align-bottom me-2 text-muted"></i> Share
																	</a>
																</li>

															</ul>
														</div>
													</td>
												</tr>
												@empty
											@endforelse
										</tbody>
									</table>
								</div>
							</div>
						</div>
					</div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="add_announcements" tabindex="-1" aria-labelledby="staticBackdropLabel" data-bs-focus="false" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered modal-50">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="btn-close" aria-label="Close" onclick="window.location.reload();"></button>
				</div>
				<div class="modal-body html-content"></div>
			</div>
		</div>
	</div>

	<div class="modal fade" id="statsMpdal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-60">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Peroformance</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="modalContent"></div>
            </div>
        </div>
    </div>

 </div>

@include('layouts.business.footer')
<<<<<<< HEAD
@include('layouts.business.scripts')
=======
>>>>>>> ce3ab0fefd0bf653e3a91b71d818121ea9ec8394

<script>
	new DataTable('#announcement_list', {
		responsive: true,
		order: false,
	});

	function createAnnouncement() {
		$('.html-content').html('');
		$.ajax({
			url:"/business/"+'{{request()->business_id}}'+"/announcement/create",
			type:'GET',
			success: function(data){
				$('.html-content').html(data);
				$('#add_announcements').modal('show');
			},
		});
	}

	function editAnnouncement(id,type) {
		$('.html-content').html('');
		$.ajax({
			url:"/business/"+'{{request()->business_id}}'+"/announcement/"+id,
			type:'GET',
			data:{
				type:type
			},
			success: function(data){
				$('.html-content').html(data);
				$('#add_announcements').modal('show');
			},
		});
	}

	function deleteAnnouncement(id) {
		if(confirm('Are you sure you want to remove this announcement?')){
			$.ajax({
				url:"/business/"+'{{$business_id}}'+"/announcement/"+id,
				method: "DELETE",
				data: {
					_token: '{{csrf_token()}}'
				},
				success: function(data){
					$('#announcement-msg').html('<div class="alert alert-success fade in alert-dismissible show"> Announcement deleted sucessfully. </div>');
					setTimeout(function(){
						location.reload();
					},2000);
					
				},
			});
		}
	}

	$(document).ready(function() {

        $('.openModal').on('click', function(e) {
            e.preventDefault();
            var id = $(this).data('id');

            $.ajax({
                url: "{{route('business.get-announcement-stats')}}", 
                type: 'GET',
                data: { id: id },
                success: function(response) {
                	$('#exampleModalLabel').html('Peroformance <label class="fs-14"> Sent on ' + $('#time'+id).html() + '</label>');
                    $('#modalContent').html(response);
                    $('#statsMpdal').modal('show');
                },
                error: function(xhr) {
                    console.log('Error:', xhr);
                }
            });
        });

        function updateUrl() {
            var baseUrl = window.location.origin + window.location.pathname;
            var categoryId = $('#category').val();
            var status = $('#announcement-status').val();

            var updatedUrl = baseUrl;

            if (categoryId && categoryId !== 'all') {
                updatedUrl += "?category=" + categoryId;
            }

            if (status && status !== 'all') {
                updatedUrl += (updatedUrl.includes('?') ? '&' : '?') + "status=" + status;
            }

            window.location.href = updatedUrl;
        }

    	$('#category, #announcement-status').change(updateUrl);
	});

</script>
<script>
    $("#menu-toggle").click(function(e) {
        e.preventDefault();
        $("#client_wrapper").toggleClass("toggled");
    });
</script>

 <script>
    function removeClassIfNecessary() {
        var div = document.getElementById('client_wrapper');
        if (window.innerWidth <= 768) { // Example breakpoint
            div.classList.remove('toggled');
        } else {
        div.classList.add('toggled');
        }
    }
    window.addEventListener('resize', removeClassIfNecessary);
    window.addEventListener('DOMContentLoaded', removeClassIfNecessary); // To handle initial load
</script>
@endsection