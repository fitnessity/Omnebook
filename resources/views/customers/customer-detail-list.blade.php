@foreach ($customers as $customer) 
    <div class="mini-stats-wid d-flex align-items-center mt-3 scheduler-box">
		<div class="flex-shrink-0 avatar-sm">
			@if($customer->profile_pic)
				<img class='mini-stat-icon avatar-title rounded-circle text-success bg-soft-red fs-4' src="{{Storage::Url($customer->profile_pic)}}" width=60 height=60 alt="">
			@else
				<span class="mini-stat-icon avatar-title rounded-circle text-success bg-soft-red fs-4 uppercase">{{$char}}</span>
			@endif
		</div>
		<div class="col-lg-2 col-md-3 col-sm-3 ms-3">
			<h6 class="mb-1">{{$customer->full_name}}</h6>
			<p class="text-muted mb-0">Last Attended:  {{$customer->get_last_seen()}}</p>
		</div>
		<div class="col-lg-3 col-md-4 col-sm-4 ms-3">
			<div class="client-age">
				<h6 class="mb-1">Age</h6>
				<span>{{ $customer->age != '' ? $customer->age : "-"}}</span>
			</div>
		</div>

		<div class="flex-grow-1 ms-3">
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
										<td><p class="mb-0 {{ $customer->is_active() == 0 ? 'font-red' : 'font-green'}}">{{ $customer->is_active() == 0 ? "InActive" : "Active"}}</p>
										</td>
										<td>
											<p class="mb-0">{{$customer->active_memberships()->get()->count()}}</p>
										</td>
										<td>
											<p class="mb-0">{{$customer->expired_soon()}}</p>
										</td>
										<td>
											<div class="scheduled-btns">
												<button type="submit" class="btn btn-red mb-10" onclick="sendmail({{$customer->id}},{{$company->id}});">Send Welcome Email</button>
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