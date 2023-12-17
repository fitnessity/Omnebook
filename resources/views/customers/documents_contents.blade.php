<form action="{{route('uploadDocsName')}}" method="post">
	@csrf
	<input type="hidden" id="docId" name="docId" value="{{$id}}">
	<div class="row y-middle" id="mainRow">

		@forelse($content as $c)
			<div id="append">
				<div class="row y-middle">
					<div class="col-md-2">
						<label class="mb-0">Content</label>
					</div>
					<div class="col-md-10">
						<input type="hidden" name="contentID[]" value="{{$c->id}}">
						<input type="text" name="docName[]" id="docName" class="form-control mt-10" value="{{$c->content}}">
					</div>
				</div>
			</div>
		@empty
			<div id="append">
				<div class="row y-middle">
					<div class="col-md-2">
						<label class="mb-0">Content</label>
					</div>
					<div class="col-md-10">
						<input type="hidden" name="contentID[]" value="">
						<input type="text" name="docName[]" id="docName" class="form-control mt-10">
					</div>
				</div>
			</div>
		@endforelse
		
	</div>
	<div class="mt-10 text-right">
		<button class="btn btn-red add_more" type="button">Add More</button>
		<button class="btn btn-red">Submit</button>
	</div>
</form>

<script type="text/javascript">
	$('.add_more').on('click',function(e){
		$('#mainRow').append('<div id="append"><div class="row y-middle"><div class="col-md-2"><label class="mb-0">Content</label></div><div class="col-md-10"><input type="hidden" name="contentID[]" value=""><input type="text" name="docName[]" id="docName" class="form-control mt-10"></div></div></div>');
	});
</script>
