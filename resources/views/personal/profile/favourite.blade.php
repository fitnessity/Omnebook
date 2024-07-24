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
               <div class="row mb-3">
					<div class="col-12">
						<div class="page-heading">
							<label>Favorite</label>
						</div>
					</div>
                </div><!--end row-->
				<div class="row">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-body">
                                    <div class="live-preview">
                                    	@forelse ($favDetail as $data)
                                    	
                                        <div class="d-flex align-items-center text-muted mb-4">
                                            <div class="flex-shrink-0 me-3 position-relative">
                                                <img src="{{ Storage::exists($data->BusinessServices->first_profile_pic()) ? Storage::URL($data->BusinessServices->first_profile_pic()) :  url('/public/images/service-nofound.jpg') }}" class="rounded avatar-xl shadow opacity-6" alt="...">
												<div class="ratings-txt"><span>{{$data->reviews_avg}}</span> / 5</div>
                                            </div>

                                            <div class="flex-grow-1">
                                                <h5 class="fs-14">{{$data->program_name}}</h5>
												<span><i class="fas fa-asterisk"></i> {{$data->sport_activity}}</span>
                                            </div>
											
											<div class="flex-grow-1">
                                                <div class="multiple-options">
													<div class="setting-icon">
														<i class="ri-more-fill"></i>
														<ul>
															<li>
																<a href="/activity-details/{{$data->id}}"><i class="fas fa-plus text-muted"></i>View Listing</a>
															</li>
															<li>
																<a onclick="deletefromfav({{$data->id}});"><i class="ri-delete-bin-fill text-muted"></i>Delete</a>
															</li>
														</ul>
													</div>
												</div>
                                            </div>
                                        </div>
                                        @empty
                                        	Favorite Activity Not Available
                                        @endforelse
                                    
                                    </div>
                                </div><!-- end card-body -->
                            </div><!-- end card -->
                        </div><!-- end col -->
                    </div><!-- end row -->
            </div><!-- container-fluid -->
        </div><!-- End Page-content -->
     </div><!-- end main content-->
</div><!-- END layout-wrapper -->

@include('layouts.business.footer')
@include('layouts.business.scripts')
<script type="text/javascript">
    function  deletefromfav(ser_id) {
        var _token = $('meta[name="csrf-token"]'). attr('content');
        $.ajax({
            type: 'POST',
            url: '{{route("service_fav")}}',
            data: {
                _token: _token,
                ser_id: ser_id
            },
            success: function (data) {
                window.location.reload();
            }
        });
    }
</script>

@endsection