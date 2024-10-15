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
								<div class="col-6">
									<div class="page-heading">
										<label>Manage Company </label>
									</div>
								</div>
								<div class="col-6">
									<div class="mt-10 float-right">
										<a href="{{route('personal.company.create')}}" class="btn btn-red" name="btnedit" id="btnedit" value="Edit">Create Company</a>
									</div>
								</div>
							</div>
                  
							<div class="row">
								<div class="col-md-12">
 								@if(isset($companies) && !empty($companies))
              					@foreach($companies as $cp => $company)
										<?php
	                              $personaltrainercount = App\BusinessServices::where(['cid'=>$company->id,'service_type'=>'individual'])->count(); 
	                              $gymtrainercount = App\BusinessServices::where(['cid'=>$company->id,'service_type'=>'classes'])->count(); 
	                              $experiencetrainercount = App\BusinessServices::where(['cid'=>$company->id,'service_type'=>'experience'])->count(); 
	                              $eventstrainercount = App\BusinessServices::where(['cid'=>$company->id,'service_type'=>'events'])->count(); 

	                              $BookingCheckinDetails  = App\BookingCheckinDetails::whereBetween('checkin_date', [Carbon\Carbon::now()->startOfWeek(), Carbon\Carbon::now()->endOfWeek()])->get();
	                              $personlbookingcount = $gymbookingcount =$experiencebookingcount = $eventsbookingcount= 0;
	                              foreach ($BookingCheckinDetails as $key => $detail) {
	                              	if($detail->UserBookingDetail != ''){
		                                	$serviceid = $detail->UserBookingDetail->sport;
		                                	$getdata = App\BusinessServices::where('id',$serviceid)->first();
		                                	if($getdata && $getdata->cid == $company->id && $getdata->service_type == 'individual'){
		                                  	$personlbookingcount++;
		                                	}
		                                	if($getdata && $getdata->cid == $company->id && $getdata->service_type == 'classes'){
		                                 	$gymbookingcount++;
		                                	}	
		                                	if($getdata && $getdata->cid == $company->id && $getdata->service_type == 'experience'){
		                                  	$experiencebookingcount++;
		                                	}
		                                	if($getdata && $getdata->cid == $company->id && $getdata->service_type == 'events'){
		                                  	$eventsbookingcount++;
		                                	}
		                              }
	                              }
	                           ?>
	                           <div class="card">
											<div class="card-body pt-0 card-350-body ">
												<h6 class="text-uppercase fw-semibold mt-4 mb-3 text-muted"></h6>
												<div class="nw-user-detail-block  nw-user-detail">
													<div class="row">
														<div class="col-lg-1 col-md-2 col-sm-2 col-3">
															@if(Storage::disk('s3')->exists($company->logo) && !empty($company->logo) )
					                                <img src="{{Storage::URL($company->logo)}}" alt="{{$company->dba_business_name}}" class="avatar">
					                              @else 
					                                <div class="company-list-text mb-10">
					          								@php $cp=substr($company->dba_business_name, 0, 1); @endphp
					          								<p class="character">{{$cp}}</p></div>
					                              @endif
															
														</div>
														<div class="col-lg-10 col-md-8 col-sm-8 col-7">
															<p class="texttr">{{$company->dba_business_name != '' ? $company->dba_business_name : $company->company_name }}</p>
															<p class="texttr">{{$company->first_name}} {{$company->last_name}}</p>
														</div>
														<div class="col-lg-1 col-md-2 col-sm-2 col-2">

															<a class="float-end" href="#" data-bs-toggle="modal" data-bs-target=".company{{$company->id}} "><i class="ri-more-fill"></i></a>

															<div class="modal fade company{{$company->id}}" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
																<div class="modal-dialog modal-dialog-centered modal-70">
																	<div class="modal-content">
																		<div class="modal-header">
																			<h5 class="modal-title" id="myModalLabel">Manage Company </h5>
																			<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
																		</div>
																		<div class="modal-body">
																			<div class="row">
																				<div class="col-lg-6 col-md-12 col-sm-12">
																					<div class="manage-txt mb-10">
																						<label class="mmt-10">OVERVIEW</label>
																						<span>{{$personaltrainercount}} PERSONAL TRAINER SERVICES | {{$personlbookingcount}} BOOKINGS THIS WEEK | 0 PROGRAM EXPIRING SOON </span>
																						<span>{{ $gymtrainercount}} GYM / STUDIO SERVICES  | {{$gymbookingcount}} BOOKINGS THIS WEEK | 5 PROGRAM EXPIRING SOON </span>
																						<span>{{$experiencetrainercount}} EXPERIEINCE SERVICES | {{ $experiencebookingcount}} BOOKINGS THIS WEEK | 1 PROGRAM EXPIRING SOON </span>
																						<span>{{$eventstrainercount}} EVENTS SERVICES | 0 BOOKINGS THIS WEEK | {{ $eventsbookingcount}} PROGRAM EXPIRING SOON </span>
																					</div>
																				</div>
																				<div class="col-lg-3 col-md-12 col-sm-12 col-xs-12">
																					<div class="btn-inline">
																						<a type="submit" class="btn btn-red mb-10 width-100 mwidth-50" href="{{route('personal.company.create',['company'=>$company->id])}}">Edit Business Info</a>

																						<a class="btn btn-black mb-10 width-100 mwidth-50" href="{{route('business.service.select',['business_id'=>$company->id])}}">Create Service</a>

																						<a class="btn btn-red mb-10 width-100 mwidth-30" href="{{route('profile-viewbusinessProfile',['page_id'=>$company->id])}}"> View Business Profile</a>
																					</div>
																				</div>
																				<div class="col-lg-3 col-md-12 col-sm-12 col-xs-12">
																					<div class="btn-inline">
												                              @if(count($company->service)==0)
												                                <input type="submit" class="btn btn-black mb-10 width-100 mwidth-30" name="btnmanageservice" id="btnmanageservice" value="Manage Service" Disabled />
												                              @else
												                                <a class="btn btn-black mb-10 width-100 mwidth-30" href="{{route('business.services.index',['business_id'=> $company->id])}}">Manage Service</a>
												                              @endif

																						@if($company->status==0)
												                              	<input type="button" class="btn btn-red mb-10 width-100 mwidth-30" id="changestatus_{{$company->id}}" value="ACTIVATE"  onclick="statuschange('{{$company->id}}');" />
												                              @else
												                              	<input type="button" class="btn btn-red mb-10 width-100 mwidth-30" id="changestatus_{{$company->id}}" value="DEACTIVATE"  onclick="statuschange('{{$company->id}}');" />
												          					      @endif

																						<input type="button" class="btn btn-black mb-10 width-100 mwidth-30" id="btndelete" data-id="{{$company->id}}" value="Delete"  >
																					</div>
																				</div>
																			</div>
																		</div>
																	</div>
																</div>
															</div>
														</div>
													</div>	
												</div>										
											</div>
										</div>

										<div class="modal fade delete{{$company->id}}" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
                                 <div class="modal-dialog modal-dialog-centered modal-80">
                                    <div class="modal-content">
													<div class="modal-header">
														<h5 class="modal-title fonts-red" id="myModalLabel">Warning</h5>
														<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
													</div>
													<div class="modal-body">
														<div class="row">
															<h6>Hitting the delete button will erase all services and information about this company.</h6>
														</div>
													</div>
													<div class="modal-footer">
														<button type="button" class="btn btn-primary btn-red" id="delete" data-id="{{$company->id}}">Delete All</button>
														<button type="button" class="btn btn-primary btn-black" data-bs-dismiss="modal">close</button>
													</div>
												</div>
                                 </div>
                              </div> 
									@endforeach
								@endif
								</div>
							</div>			
						</div> 
               </div>
            </div>
         </div>
      </div>
   </div>
</div>

@include('layouts.business.footer')
@include('layouts.business.scripts')
<script>
	flatpickr(".flatpickr-range", {
        dateFormat: "m/d/Y",
        maxDate: "01/01/2050",
		defaultDate: [new Date()],
     });

	function statuschange(cid){
	  var status = $("#changestatus_"+cid).val();
	  var _token = $("input[name='_token']").val();
	  $.ajax({
	    url:"{{route('changecompanystatus')}}",
	    type:'post',
	    dataType: 'json',
	    headers: {'X-CSRF-TOKEN': _token},
	    data: {
	        'status': status,
	        'cid': cid
	      },
	    success: function (response) {
	      $("#maindiv").load(" #maindiv");
	    }
	  });
	} 

	$(document).on('click', '#btndelete', function(event) {
		var sid = $(this).attr('data-id');
		$('.company'+sid).modal('hide');
		$('.delete'+sid).modal('show');
   });

   $(document).on('click', '#delete', function(event) {
		var sid = $(this).attr('data-id');
		$.ajax({ 
        	url:"/personal/company/"+sid,
        	xhrFields: {
            withCredentials: true
        	},
        	type:"delete",
        	data: { 
            _token: '{{csrf_token()}}', 
        	},
        	success: function(html){
           	location.reload();
        	}
    	});
		
   });

</script>

@endsection