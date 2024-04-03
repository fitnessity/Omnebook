@if(request()->customer_type == 'suspended')
	<div class="table-responsive">
        <table class="table align-middle table-nowrap mb-0">
            <thead>
                <tr>
                    <th scope="col">Member</th>
                    <th scope="col"></th>
                    <th scope="col">Amount</th>
                    <th scope="col">Membership Title</th>
                    <th scope="col">Freeze Period</th>
                </tr>
            </thead>
            <tbody>
            	@foreach ($customers as $ubd) 
                    <tr>
                        <th scope="row">
                        	<div class="mini-stats-wid d-flex align-items-center mt-3">
	                        	<div class="flex-shrink-0 avatar-sm">
									@if($ubd->Customer->profile_pic)
										<img class='mini-stat-icon avatar-title rounded-circle text-success bg-soft-red fs-4' src="{{Storage::Url($ubd->Customer->profile_pic)}}" width=60 height=60 alt=""> 
										<!-- //change image  -->
									@else
										<span class="mini-stat-icon avatar-title rounded-circle text-success bg-soft-red fs-4 uppercase">{{$char}}</span>
									@endif
								</div>
							</div>
                        </th>
                        <td><h6 class="mb-1">{{$ubd->Customer->full_name}}</h6></td>
                        <td>${{$ubd->subtotal}}</td>
                        <td>{{@$ubd->business_price_detail_with_trashed->business_price_details_ages_with_trashed->category_title}}</td>
                        <td>Freeze from {{date('m/d/Y',strtotime($ubd->suspend_started))}}	to {{date('m/d/Y',strtotime($ubd->suspend_ended))}}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@elseif(request()->customer_type == 'at-risk')
	<div class="table-responsive">
        <table class="table align-middle table-nowrap mb-0">
            <thead>
                <tr>
                    <th scope="col">Member</th>
                    <th scope="col"></th>
                    <th scope="col">Member Since</th>
                    <th scope="col">Status</th>
                    <th scope="col">Days since last attended</th>
                </tr>
            </thead>
            <tbody>
            	@foreach ($customers as $cus) 
                    <tr>
                        <th scope="row">
                        	<div class="mini-stats-wid d-flex align-items-center mt-3">
	                        	<div class="flex-shrink-0 avatar-sm">
									@if($cus->profile_pic)
										<img class='mini-stat-icon avatar-title rounded-circle text-success bg-soft-red fs-4' src="{{Storage::Url($cus->profile_pic)}}" width=60 height=60 alt=""> 
										<!-- //change image  -->
									@else
										<span class="mini-stat-icon avatar-title rounded-circle text-success bg-soft-red fs-4 uppercase">{{$char}}</span>
									@endif
								</div>
							</div>
                        </th>
                        <td><h6 class="mb-1">{{$cus->full_name}}</h6></td>
                        <td>{{date('m/d/Y',strtotime($cus->created_at))}}</td>
                        <td>{{$cus->is_active()}}</td>
                        <td>@if($cus->lastDays() == 0) Never Attend @else Attend before {{$cus->lastDays()}} days @endif</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@elseif(request()->customer_type == 'prospect')
	<div class="table-responsive">
        <table class="table align-middle table-nowrap mb-0">
            <thead>
                <tr>
                    <th scope="col">Member</th>
                    <th scope="col"></th>
                    <th scope="col">Age</th>
                    <th scope="col">Member Since</th>
                    <th scope="col">Total Bookings</th>
                </tr>
            </thead>
            <tbody>
            	@foreach($customers as $customer) 
                    <tr>
                        <th scope="row">
                        	<div class="mini-stats-wid d-flex align-items-center mt-3">
	                        	<div class="flex-shrink-0 avatar-sm">
									@if($customer->profile_pic)
										<img class='mini-stat-icon avatar-title rounded-circle text-success bg-soft-red fs-4' src="{{Storage::Url($customer->profile_pic)}}" width=60 height=60 alt=""> 
									@else
										<span class="mini-stat-icon avatar-title rounded-circle text-success bg-soft-red fs-4 uppercase">{{$customer->first_letter}}</span>
									@endif
								</div>
							</div>
                        </th>
                        <td><h6 class="mb-1">{{$customer->full_name}}</h6></td>
                        <td>{{ $customer->age != '' ? $customer->age : "-"}}</td>
                        <td>{{date('m/d/Y',strtotime($customer->created_at))}}</td>
                        <td>{{@$customer->bookingDetail()->count()}}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@elseif(request()->customer_type == 'owed')
	<div class="table-responsive">
        <table class="table align-middle table-nowrap mb-0">
            <thead>
                <tr>
                    <th scope="col">Member</th>
                    <th scope="col"></th>
                    <th scope="col">Amount</th>
                    <th scope="col">Membership Title</th>
                    <th scope="col">Status</th>
                    <th scope="col"></th>
                    <th scope="col"></th>
                </tr>
            </thead>
            <tbody>
            	@foreach ($customers as $rec) 
                    <tr>
                        <th scope="row">
                        	<div class="mini-stats-wid d-flex align-items-center mt-3">
	                        	<div class="flex-shrink-0 avatar-sm">
									@if($rec->Customer->profile_pic)
										<img class='mini-stat-icon avatar-title rounded-circle text-success bg-soft-red fs-4' src="{{Storage::Url($rec->Customer->profile_pic)}}" width=60 height=60 alt=""> 
										<!-- //change image  -->
									@else
										<span class="mini-stat-icon avatar-title rounded-circle text-success bg-soft-red fs-4 uppercase">{{$char}}</span>
									@endif
								</div>
							</div>
                        </th>
                        <td><h6 class="mb-1">{{$rec->Customer->full_name}}</h6></td>
                        <td>${{$rec->total_amount}} <br><span class="font-red">Recurring</span></td>
                        <td>{{@$rec->membership_name}}</td>
                        <td>{{$rec->payment_date}}<br> 
                        	@if($rec->error_msg)
                        		<span class="font-red" data-bs-toggle="tooltip" data-bs-placement="top" title="{{$rec->error_msg}}">Reason</span>
							 @endif
						</td>
                        <td><a href="{{ route('business_customer_show',['business_id' => $rec->Customer->business_id, 'id'=>$rec->Customer->id]) }}">Account</a><td>
                        <td><a class="float-end" href="#" data-bs-toggle="modal" data-bs-target=".rec-info{{$rec->id}}"> Charge </a> </td>
                    </tr>

                    <div class="modal fade rec-info{{$rec->id}}" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
						<div class="modal-dialog modal-dialog-centered  modal-30">
							<div class="modal-content">
								<div class="modal-header">
									<h5 class="modal-title" id="myModalLabel">Pay Now</h5>
									<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
								</div>
								<div class="modal-body">
									<!-- <div class="scheduler-table">
										<div class="table-responsive">
											<table class="table mb-0">
												<thead>
													<tr>
														<th>Scheduled</th>
														<th>Memberships Name</th>
														<th>Amount</th>
														<th></th>
														<th></th>
													</tr>
												</thead>
												<tbody>
													<tr>
														<td>${{$rec->payment_date}} </td>
														<td>{{@$rec->membership_name}}</td>
														<td>${{$rec->total_amount}} </td>
													</tr>
												</tbody>
											</table>
										</div>
									</div>-->


									<div class="row">
										<div>
											<label class="font-black">Scheduled : </label> {{@$rec->payment_date}}
										</div>

										<div>
											<label class="font-black">Memberships Name : </label> {{@$rec->membership_name}}
										</div>

										<div>
											<label class="font-black">Amount: </label> ${{@$rec->total_amount}}
										</div>

										<div class="col-lg-12 btns-modal mt-10 text-right">
											<a class="btn btn-red" href="{{ route('business_customer_show',['business_id' => $rec->Customer->business_id, 'id'=>$rec->Customer->id]) }}"> Pay</a>
											<a data-bs-dismiss="modal" aria-label="Close" class="btn btn-black">Cancel</a>
										</div>
									</div> 


								</div>
							</div><!-- /.modal-content -->
						</div><!-- /.modal-dialog -->
					</div>

                @endforeach
            </tbody>
        </table>
    </div>
@else
	@foreach ($customers as $customer) 
	    <div class="mini-stats-wid d-flex align-items-center mt-3 scheduler-box">
			<a class="w-100" href="{{ route('business_customer_show',['business_id' => $company->id, 'id'=>$customer->id]) }}" target="_blank">
				<div class="row">
					<div class="flex-shrink-0 avatar-sm customer-avatar">
						@if($customer->profile_pic)
							<img class='mini-stat-icon avatar-title rounded-circle text-success bg-soft-red fs-4' src="{{Storage::Url($customer->profile_pic)}}" width=60 height=60 alt="">
						@else
							<span class="mini-stat-icon avatar-title rounded-circle text-success bg-soft-red fs-4 uppercase">{{$char}}</span>
						@endif
					</div>
				
					<div class="col-lg-2 col-md-3 col-sm-3 col-5">
						<h6 class="mb-1">{{$customer->full_name}}</h6>
						<p class="text-muted mb-0">Last Attended:  {{$customer->get_last_seen()}}</p>
					</div>
					<div class="col-lg-3 col-md-4 col-sm-4 col-3">
						<div class="client-age">
							<h6 class="mb-1">Age</h6>
							<span>{{ $customer->age != '' ? $customer->age : "-"}}</span>
						</div>
					</div>
				</div>
			</a>
			<div class="flex-grow-1 ">
				<a class="float-end" href="#" data-bs-toggle="modal" data-bs-target=".customer-info{{$customer->id}}"><i class="ri-more-fill"></i></a>
			</div>
		</div>

		<div class="modal fade customer-info{{$customer->id}}" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
			<div class="modal-dialog modal-dialog-centered customer-modal-width">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="myModalLabel">Manage Customers</h5>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					</div>
					<div class="modal-body">
						<div class="scheduler-table">
							<div class="table-responsive">
								<table class="table mb-0">
									<thead>
										<tr>
											<th>Status</th>
											<th>Active Memberships</th>
											<th>Expiring Soon</th>
											<th></th>
											<th></th>
										</tr>
									</thead>
									<tbody>
										<tr>
											<td><p class="mb-0 {{ $customer->is_active() == 'InActive' ? 'font-red' : 'font-green'}}">{{ $customer->is_active()}}</p>
											</td>
											<td>
												<p class="mb-0">{{$customer->active_memberships()->get()->count()}}</p>
											</td>
											<td>
												<p class="mb-0">{{$customer->expired_soon()}}</p>
											</td>
											<td>
												<div class="scheduled-btns">
													<button type="submit" class="btn btn-red mb-10" onclick="sendmailTocustomer({{$customer->id}},{{$company->id}});">Send Welcome Email</button>
													<a type="button" class="btn btn-black mb-10" href="{{ route('business_customer_show',['business_id' => $company->id, 'id'=>$customer->id]) }}" target="_blank">View Account</a>
												</div>
											</td>
											<td>
												<div class="scheduled-btns">
													<a data-business_id = "{{$company->id}}" data-id="{{$customer->id}}" class="btn btn-red delcustomer">Delete
													</a>
												</div>
											</td>
										</tr>
									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div><!-- /.modal-content -->
			</div><!-- /.modal-dialog -->
		</div>
 	@endforeach
@endif