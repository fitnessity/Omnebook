@inject('request', 'Illuminate\Http\Request')
@extends('subdomain.layouts.header')

@section('content')

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
								<a class="profile-user position-relative d-inline-block mx-auto mb-4 ml-1 mr-1"  href="#">
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
									<a class="profile-user position-relative d-inline-block mx-auto mb-4 ml-1 mr-1" href="#">
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

								<a data-behavior="ajax_html_modal" data-url="{{route('manage_account_create')}}" data-modal-width="modal-70">
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


<div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true"  id="ajax_html_modal" data-bs-focus="false">
	<div class="modal-dialog modal-dialog-centered" id="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" id="close-btn-modal"></button>
			</div>
			<div class="modal-body"></div>
		</div>
	</div>
</div>

<script>
flatpickr('.flatpickr-range',{
	dateFormat: "m/d/Y",
	maxDate: "today",
});
</script>
<script>
$(document).on('focus', '[data-behavior~=text-phone]', function(e){
	//jQuery.noConflict();
	$('[data-behavior~=text-phone]').usPhoneFormat({
		format: '(xxx) xxx-xxxx',
	});
});
	
</script>

<script>
	$(document).on('click', '[data-behavior~=ajax_html_modal]', function(e){
		$("#modal-dialog").removeClass();
		$("#modal-dialog").addClass('modal-dialog modal-dialog-centered');
        var width = $(this).data('modal-width');
        var reload = $(this).data('reload');
        if(width == undefined){
            // width = 'modal-50';
        }
         var chkbackdrop  =   $(this).attr('data-modal-chkBackdrop');            
        e.preventDefault()
        $.ajax({
            url: $(this).data('url'),
            success: function(html){
            	$('#ajax_html_modal .modal-body').html(html)
                $('#ajax_html_modal .modal-dialog').addClass(width);
                if(reload == 1 ){
                	$('#close-btn-modal').attr('onclick', 'window.location.reload()');
                }else{
                	$('#close-btn-modal').removeAttr('onclick');
                }
            	if(chkbackdrop == 1){
            		$('#ajax_html_modal').modal({ backdrop: 'static', keyboard: false });
            		$('#ajax_html_modal').modal('show')

        		}else{
                    $('#ajax_html_modal').modal('show')
        		}
            }
        })
    });
</script>
	

@endsection