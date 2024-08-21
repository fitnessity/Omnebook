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
								<label>Announcement Category</label>
							</div>
						</div>
					</div><!--end row-->
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
												<button type="button" onclick="getCategoryModal()" data-bs-target="#staticBackdrop" class="btn btn-red">
													<i class="ri-add-line align-bottom me-1"></i>Add Categories 
												</button>
											</div>
										</div>
										<div class="col-sm-auto">
											<div class="mb-20">
												<a class="btn btn-red" href="{{route('business.announcement.index')}}"><i class="fas fa-bullhorn me-1"></i> Announcement </a>
											</div>
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
												<th data-ordering="false">Category</th>
												<th data-ordering="false">Number of Announcements</th>
												<th data-ordering="false">Actions</th>
											</tr>
										</thead>
										<tbody>		
											@foreach($category as $c)								
											<tr>
												<td>{{$c->name}}</td>
												<td>{{$c->announcementCount()}}</td>
												<td>
													<div class="dropdown d-inline-block">
														<button class="btn btn-red btn-sm dropdown" type="button" data-bs-toggle="dropdown" aria-expanded="false">
															<i class="ri-more-fill align-middle fs-10"></i>
														</button>
														<ul class="dropdown-menu dropdown-menu-end">
															<li><a class="dropdown-item edit-item-btn" onclick="getEditCategoryModal({{$c->id}});"><i class="ri-pencil-fill align-bottom me-2 text-muted"></i> Edit</a></li>
															<li>
																<a class="dropdown-item remove-item-btn" onclick="deleteCategory({{$c->id}});">
																	<i class="ri-delete-bin-fill align-bottom me-2 text-muted"></i> Delete
																</a>
	                                                       </li>
														</ul>
													</div>
												</td>
											</tr>
											@endforeach
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

	<div class="modal fade announcement-categoty" id="staticBackdrop" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body html-content"></div>
		</div>
	</div>
</div>
</div>

@include('layouts.business.footer')

<script>
		new DataTable('#announcement_list', {
			responsive: true
		});

		function getCategoryModal(){
			$.ajax({
				url:"/business/"+'{{request()->business_id}}'+"/announcement-category/create",
				type:'GET',
				success: function(data){
					$('.html-content').html(data);
					$('.announcement-categoty').modal('show');
				},
			});
		}

		function getEditCategoryModal(id){
			$.ajax({
				url:"/business/"+'{{request()->business_id}}'+"/announcement-category/"+id,
				type:'GET',
				success: function(data){
					$('.html-content').html(data);
					$('.announcement-categoty').modal('show');
				},
			});
		}

		function deleteCategory(id) {
			if(confirm('If you remove this category then related announcements are also removed. Are you sure you want to remove this category?')){
				$.ajax({
					url:"/business/"+'{{$business_id}}'+"/announcement-category/delete/"+id,
					method: "GET",
					success: function(data){
						alert('Category deleted successfully');
						window.location.reload();
					},
				});
			}
		}

	</script>
	<script>
        $("#menu-toggle").click(function(e) {
            e.preventDefault();
            $("#client_wrapper").toggleClass("toggled");
        });
    </script>
@endsection