@inject('request', 'Illuminate\Http\Request')
@extends('layouts.business.header')

@section('content')
@include('layouts.profile.business_topbar')

<div class="main-content">
		<div class="page-content">
			<div class="container-fluid">
				<div class="row mb-3">
					<div class="col-12">
						<div class="page-heading">
							<label>Promote</label>
						</div>
					</div>
				</div><!--end row-->
				<div class="row">
					<div class="col-xl-12">
						<div class="card">
							<div class="card-body">
                                <div class="alert alert-primary shadow" role="alert">                                   
                                    Jane Jones has been selected for promotion. Select a level to confirm
                                </div>       
                                <table id="announcement_list" class="table table-bordered dt-responsive nowrap table-striped align-middle" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th data-ordering="false">Client Name</th>
                                            <th data-ordering="false">Current Level</th>
                                            <th data-ordering="false">Skills Completed </th>
                                            <th data-ordering="false">Promote</th>
                                            <th data-ordering="false">Details </th>
                                        </tr>
                                    </thead>
                                    <tbody>										
                                        <tr>
                                            <td>Nipa Soni</td>
                                            <td>Green Belt</td>
                                            <td>00/00</td>
                                            <td><button type="button" class="btn btn-red">Update</button></td>
                                            <td>
                                                <ul class="list-inline hstack gap-2 mb-0">
                                                    <li class="list-inline-item" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="top" aria-label="View" data-bs-original-title="View">
                                                        <a href="#" class="text-red d-inline-block">
                                                            <i class="ri-eye-fill fs-16"></i>
                                                        </a>
                                                    </li>
                                                </ul>
                                            </td>                                            
                                        </tr>                                  
                                    </tbody>
                                </table>           
							</div><!-- end card Body -->
						</div>
					</div>
				</div>
										
			</div><!-- container-fluid -->
		</div>
	</div><!-- end main content-->
	
</div><!-- END layout-wrapper -->


@include('layouts.business.footer')
<script>
	new DataTable('#announcement_list', {
		responsive: true
	});
</script>

@endsection