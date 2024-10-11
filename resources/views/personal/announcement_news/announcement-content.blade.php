@forelse($announcement as $a)
	<div class="mb-10">
		<div class="row y-middle">
			<div class="col-lg-1 col-md-2 col-3">
				<div class="announcement-day">
					<span>{{$a->formatDateTime($a->announcement_date.' '.$a->announcement_time)}}</span>
				</div>
			</div>
			<div class="col-lg-10 col-md-10 col-9 border-left">
				<div class="announcement-heading">
					<h5>{{$a->title}}</h5>
					<p>{{$a->short_description ?? "N/A"}}</p>
				</div>
			</div>
			<div class="col-lg-1">
				<div class="text-right">
					<button class="btn btn-red btn-sm dropdown" data-bs-toggle="modal" data-bs-target="#detail-modal{{$a->id}}" ><i class="ri-eye-fill fs-14" ></i></button>
				</div>
			</div>
		</div>
	</div>

	<div class="modal fade" tabindex="-1" id="detail-modal{{$a->id}}" aria-labelledby="staticBackdropLabel" aria-modal="true" role="dialog" >
		<div class="modal-dialog modal-dialog-centered modal-50">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<div class="modal-body html-content">
					<h5 class="modal-title text-center" id="staticBackdropLabel">{{$a->title}}</h5>
					<div class="row y-middle mt-10">
						<div class="col-lg-12 col-sm-12 col-md-12">
							<div class="mb-3 ck-content">{!! $a->announcement ?? 'N/A' !!}</div>
						</div>
						<div class="col-lg-12 col-sm-12 col-md-12 text-center">
							<div class="mb-3"> Announcement Posted On {{date('m/d/Y', strtotime($a->created_at))}}</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

@empty
@endforelse