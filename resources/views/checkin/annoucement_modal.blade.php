
<h5 class="modal-title text-center" id="staticBackdropLabel">{{$an->title}}</h5>
<div class="row y-middle mt-10">
	<div class="col-lg-12 col-sm-12 col-md-12">
		<div class="mb-3 ck-content">{!! $an->announcement ?? 'N/A' !!}</div>
	</div>
	<div class="col-lg-12 col-sm-12 col-md-12 text-center">
		<div class="mb-3"> Announcement Posted On {{date('m/d/Y', strtotime($an->created_at))}}</div>
	</div>
</div>
