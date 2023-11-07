@inject('request', 'Illuminate\Http\Request')
@extends('layouts.business.header')

@section('content')

	@include('layouts.business.business_topbar')
	<!-- ============================================================== -->
    <!-- Start right Content here -->
    <!-- ============================================================== -->
   <div class="main-content">
		<div class="page-content">
         <div class="container-fluid">
            <div class="row">
               <div class="col">
                  <div class="h-100">
                     <div class="row mb-3">
								<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
									<div class="page-heading">
										<label>Membership Expirations</label>
									</div>
								</div><!--end col-->
							</div><!--end row-->
						
							<div class="row">
								<div class="col-xl-12">
									<div class="card">
										<div class="card-header align-items-center d-flex">
											<h4 class="card-title mb-0 flex-grow-1">{{$today->format('l, F j, Y')}}</h4>
										</div><!-- end card header -->
										<div class="card-body">
											<input type="hidden" id="type" value="">
										   <div class="live-preview">
												<div class="accordion custom-accordionwithicon accordion-border-box" id="accordionnesting">
													<div class="accordion-item shadow">
														<h2 class="accordion-header" id="accordionnestingExample30">
															<button class="accordion-button collapsed uppercase" type="button" data-bs-toggle="collapse" data-bs-target="#accor_nestingExamplecollapse30" aria-expanded="false" aria-controls="accor_nestingExamplecollapse30"  onclick="getData('30')">Expiring in 30 days</button>
														</h2>
														<div id="accor_nestingExamplecollapse30" class="accordion-collapse collapse" aria-labelledby="accordionnestingExample30" data-bs-parent="#accordionnesting">
															<div class="accordion-body" id="targetDiv30"></div>
														</div>
													</div>

													<div class="accordion-item shadow">
														<h2 class="accordion-header" id="accordionnestingExample90">
															<button class="accordion-button collapsed uppercase" type="button" data-bs-toggle="collapse" data-bs-target="#accor_nestingExamplecollapse90" aria-expanded="false" aria-controls="accor_nestingExamplecollapse90"  onclick="getData('90')">Expiring in 90 days</button>
														</h2>
														<div id="accor_nestingExamplecollapse90" class="accordion-collapse collapse" aria-labelledby="accordionnestingExample90" data-bs-parent="#accordionnesting">
															<div class="accordion-body" id="targetDiv90"></div>
														</div>
													</div>

													<div class="accordion-item shadow">
														<h2 class="accordion-header" id="accordionnestingExampleall">
															<button class="accordion-button collapsed uppercase" type="button" data-bs-toggle="collapse" data-bs-target="#accor_nestingExamplecollapseall" aria-expanded="false" aria-controls="accor_nestingExamplecollapseall" onclick="getData('all')">All Expired Members </button>
														</h2>
														<div id="accor_nestingExamplecollapseall" class="accordion-collapse collapse scroll-customer" aria-labelledby="accordionnestingExampleall" data-bs-parent="#accordionnesting">
															<div class="accordion-body" id="targetDivall"></div>
														</div>
													</div>
												</div>
											</div>
										</div><!-- end card-body -->
									</div><!-- end card -->
								</div><!--end col-->
							</div><!--end row-->						
						</div> <!-- end .h-100-->
               </div> <!-- end col -->
            </div>
         </div><!-- container-fluid -->
      </div><!-- End Page-content -->
    </div><!-- end main content-->
</div><!-- END layout-wrapper -->
    
@include('layouts.business.footer')
	
<script>

	let offset  = 10;
 	var isLoading = false;

	function getData(days){
		$('#type').val(days);
		offset = 10;
		isLoading = false;
		$.ajax({
	  		type: "post",
         url: "{{route('business.member_expirations.getMemberships')}}",
         data: {
         	days: days,
         	_token: '{{csrf_token()}}',
         },
         success: function(response){
         	$('#targetDiv'+days).html(response);
         }
		});
	}	

	$(document).ready(function () {
      $(window).scroll(function () {
      	var type = $('#type').val();
   		if(type != ''){
	         if ($(window).scrollTop() + $(window).height() > $("#accor_nestingExamplecollapse"+type).height()) {
	            // Check if not already loading more records and not all records are loaded
	            if (!isLoading && offset !== -1) {
	               loadMoreRecords(type);
	            }
	         }
	      }
      });
   });


   function loadMoreRecords(days) {
     isLoading = true;
     $.ajax({
         url: "{{route('business.member_expirations.getMoreMemberships')}}",
         method: 'GET',
         data: { 
         	offset: offset,
         	days: days,
         },
         success: function (response) {
            if (response != '') {
               $('#targetDiv'+days).html(response);
               offset = offset + 10;
               isLoading = false;
            }else {
               // All records have been loaded
               offset = -1;
            }
         }
     });
   }

</script>

@endsection