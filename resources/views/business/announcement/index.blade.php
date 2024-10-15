@inject('request', 'Illuminate\Http\Request')

@extends('layouts.business.header')

@section('content')


	@include('layouts.business.business_topbar')
		
	<div class="main-content">
		<div class="page-content">
			<div class="container-fluid">
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
											<th data-ordering="false">Start Date</th>
											<th data-ordering="false">End Date</th>
											<th data-ordering="false"class="d-none">Post Date</th>
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
											<td>@if($a->start_date) {{date('m/d/Y', strtotime($a->start_date))}}  @if($a->start_time) {{date('h:i A', strtotime($a->start_time))}} @else No Start Time @endif @else No Start Date @endif </td>
											<td>@if($a->end_date) {{date('m/d/Y', strtotime($a->end_date))}}  @if($a->end_time) {{date('h:i A', strtotime($a->end_time))}} @else No End Time @endif  @else No End Date @endif</td>
											<td class="d-none">{{date('m/d/Y', strtotime($a->created_at))}}</td>
											<td>
												<div class="dropdown d-inline-block">
													<button class="btn btn-red btn-sm dropdown" type="button" data-bs-toggle="dropdown" aria-expanded="false">
														<i class="ri-more-fill align-middle fs-10"></i>
													</button>
													<ul class="dropdown-menu dropdown-menu-end">
														<li><a class="dropdown-item edit-item-btn" onclick="editAnnouncement({{$a->id}})"><i class="ri-pencil-fill align-bottom me-2 text-muted"></i> Edit</a></li>
														<li>
															<a class="dropdown-item remove-item-btn" onclick="deleteAnnouncement({{$a->id}})">
																<i class="ri-delete-bin-fill align-bottom me-2 text-muted"></i> Delete
															</a>
														</li>
													</ul>
												</div>
											</td>
										</tr>
										@empty
										@endforelse()
									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div><!-- END layout-wrapper -->

<!-- Modal -->
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

@include('layouts.business.footer')
@include('layouts.business.scripts')

	<script>
		new DataTable('#announcement_list', {
			responsive: true,
			order: [[5, 'desc']],
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

		function editAnnouncement(id) {
			$('.html-content').html('');
			$.ajax({
				url:"/business/"+'{{request()->business_id}}'+"/announcement/"+id,
				type:'GET',
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
@endsection