<form action="{{route('uploadDocsName')}}" method="post">
	@csrf
	<input type="hidden" id="docId" name="docId" value="{{$id}}">
	<div class="row y-middle" id="mainRow">
		@forelse($content as $c)

			<input type="hidden" name="Ids[]" id="Ids" value="{{$c->id}}">
			<input type="hidden" name="deletIds[]" id="deletIds" value="">
			<div id="append">
				<div class="row y-middle">
					<div class="col-md-2">
						<label class="mb-0">Content</label>
					</div>
					<div class="col-md-8">
						<input type="hidden" name="contentID[]" value="{{$c->id}}">
						<input type="text" name="docName[]" id="docName" class="form-control mt-10" value="{{$c->content}}">
					</div>
					<div class="col-md-2">
						<a class="delete" data-did="{{$c->id}}"><i class="ri-delete-bin-fill"></i></a>
					</div>
				</div>
			</div>
		@empty
			<div id="append">
				<div class="row y-middle">
					<div class="col-md-2">
						<label class="mb-0">Content</label>
					</div>
					<div class="col-md-8">
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
	var deletIds = [];
	$('.add_more').on('click',function(e){
		$('#mainRow').append('<div id="append"><div class="row y-middle"><div class="col-md-2"><label class="mb-0">Content</label></div><div class="col-md-8"><input type="hidden" name="contentID[]" value=""><input type="text" name="docName[]" id="docName" class="form-control mt-10"></div></div></div>');
	});

	$('.delete').on('click',function(e){
		var dataDid = $(this).data('did');
		deletIds.push(dataDid);
		$(this).parent().parent().parent().remove();
		 updateDeletIdsInput();
	});

	function updateDeletIdsInput() {
        var deletIdsString = deletIds.join(',');
        $('#deletIds').val(deletIdsString);
    }
	
</script>
