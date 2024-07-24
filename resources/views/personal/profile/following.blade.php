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
							<label>Following</label>
						</div>
					</div>
            </div><!--end row-->
				<div class="row">
					<div class="col-md-12">
						<div class="card">
							<div class="card-body pt-0 card-350-body">

								@forelse ($followDetail as $data) 
								<div class="mini-stats-wid mt-3 scheduler-box">
									<div class="row  d-flex align-items-center">
										<div class="col-lg-1 col-md-2 col-sm-2 col-3">
											<div class="flex-shrink-0 avatar-sm customer-avatar">
												@if($data->getUser()->getPic())
													<img class="mini-stat-icon avatar-title rounded-circle text-success bg-soft-red fs-4" src="{{$data->getUser()->getPic()}}" alt="">
												@else
													<span class="mini-stat-icon avatar-title rounded-circle text-success bg-soft-red fs-4 uppercase">{{$data->getUser() ? $data->getUser()->first_letter : ''}}</span>
												@endif
											</div>
										</div>
										<div class="col-lg-2 col-md-3 col-sm-3 col-5">
											<h6 class="mb-1">{{$data->getUser()->full_name}}</h6>
										</div>
										<div class="col-lg-3 col-md-2 col-sm-2 col-4">
											<div class="d-grid follow-counter">
												<span>Follower  {{count(App\UserFollow::where("follower_id",$data->getUser()->id)->get())}}</span>
												<span>Following {{count(App\UserFollow::where("user_id",$data->getUser()->id)->get())}}</span>
											</div>
										</div>
										<div class="col-lg-3 col-md-3 col-sm-3 col-6">
											<div class="d-grid text-center mmt-10">
												<label class="mb-0">Member Since</label>
												<span>{{date('F Y',strtotime($data->getUser()->created_at))}}</span>
											</div>
										</div>
										<div class="col-lg-3 col-md-2 col-sm-2 col-6">
											<div class="text-right">
												<button type="button" class="btn btn-red unfollow"  id="{{$data->getUser()->id}}">Unfollow</button>
											</div>
										</div>
									</div>
								</div>
								@empty
									Following data is not available
								@endforelse
									
							</div><!-- end cardbody -->
						</div><!-- end card -->
					</div><!--end col-->
				</div><!--end row-->
            </div><!-- container-fluid -->
        </div><!-- End Page-content -->
     </div><!-- end main content-->
</div><!-- END layout-wrapper -->

	
	@include('layouts.business.footer')
	@include('layouts.business.scripts')
<script>
	flatpickr('.flatpickr-range',{
		dateFormat: "m/d/Y",
        maxDate: "today",
	});

	$(".unfollow").click(function(){

    	var _token = $("input[name='_token']").val();
    	var fid = $(this).attr('id');
    	$.ajax({
        	type: 'POST',
        	url: '{{route("personal.following-update")}}',
        	data: {
          	"_token": "{{ csrf_token() }}",
          	fid:fid
        	},
        	success: function(data) {
          	window.location.reload();
        }
    	});
	});	
</script>
	

@endsection