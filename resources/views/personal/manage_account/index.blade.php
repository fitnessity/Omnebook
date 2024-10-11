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
							<label>Manage Accounts</label>
						</div>
					</div>
                </div><!--end row-->
				<div class="row">
					<div class="col-12">
						<div class="card" id="contact-view-detail">
							<div class="card-header align-items-center d-flex mb-20">
								<h4 class="card-title mb-0 flex-grow-1">Select Account To Manage</h4>
							</div>
							<div class="card-body text-center">
								<a class="profile-user position-relative d-inline-block mx-auto mb-4 ml-1 mr-1"  href="{{route('personal.provider')}}">
									@if($user->getPic())
										<img src="{{$user->getPic()}}" class="rounded-circle avatar-xl img-thumbnail user-profile-image  shadow" alt="user-profile-image">
									@else
										<div class="rounded-circle avatar-xl img-thumbnail user-profile-image shadow no-img-latter">
											<p class="character character-renovate">{{$user->first_letter}}</p>
										</div>
									@endif
									<div class="manage-account-name">
										<h5 class="mb-1 mt-2">{{$user->full_name}}</h5>
									</div>
								</a>
								
								@foreach($UserFamilyDetails as $family)
									<a class="profile-user position-relative d-inline-block mx-auto mb-4 ml-1 mr-1" href="{{route('personal.provider',['customer_id' => $family->id ,'type'=> $family->parent_cus_id != '' ? 'customer' : 'user'])}}">
										@if(Storage::disk('s3')->exists(@$family->profile_pic))
											<img src="{{ Storage::URL(@$family->profile_pic)}}" class="rounded-circle avatar-xl img-thumbnail user-profile-image  shadow" alt="user-profile-image">
										@else
											<div class="rounded-circle avatar-xl img-thumbnail user-profile-image shadow no-img-latter">
												<p class="character character-renovate">{{$family->first_letter}}</p>
											</div>
										@endif

										<div class="manage-account-name">
											<h5 class="mb-1 mt-2">{{$family->full_name}}</h5>
										</div>
									</a>
								@endforeach

								<a data-behavior="ajax_html_modal" data-url="{{route('personal.manage-account.create')}}" data-modal-width="modal-70">
									<div class="profile-user position-relative d-inline-block mx-auto ml-1 mr-1">
										<div class="rounded-circle add-plus-option">
											<div class="round0plus">
												<i class="fas fa-plus"></i>
											</div>
										</div>
										<div class="manage-account-name">
											<h5 class="mb-1 mt-2">Add Family</h5>
										</div>
									</div>
								</a>
                     </div>
						</div>
					</div>
				</div>
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
</script>
	

@endsection