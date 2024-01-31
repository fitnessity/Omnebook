@inject('request', 'Illuminate\Http\Request')
@extends('layouts.business.header')
@section('content')

	@include('layouts.business.business_topbar')

    <div class="main-content">
		<div class="page-content">
            <div class="container-fluid">
               <div class="row">
                  <div class="col">
                    <div class="h-100">
                        <div class="row mb-3">
							<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
								<div class="page-heading">
									<label>Check-in Settings</label>
								</div>
							</div>
							
                            <!--end col-->
						</div>
                        <!--end row-->
						
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="card">
                                    <div class="card-header">
                                        <h4 class="card-title mb-0">Upload cover Photo</h4>
                                    </div><!-- end card header -->

                                    <div class="card-body">
                                  
                                    </div>
                                    <!-- end card body -->
                                </div>
                                <!-- end card -->  
                            </div> <!-- end col -->                                                  
                        </div><!-- end row -->	
					</div> <!-- end .h-100-->
                  </div> <!-- end col -->
                </div>
            </div><!-- container-fluid -->
        </div><!-- End Page-content -->
     </div><!-- end main content-->
</div><!-- END layout-wrapper -->



@include('layouts.business.footer')
@endsection