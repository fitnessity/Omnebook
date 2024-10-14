<form action="{{route('uploadDocsName')}}" method="post">
	@csrf
	<input type="hidden" id="customerId" name="customerId" value="{{$customerId}}">
	<div class="row y-middle" id="mainRow">

		<div class="col-md-2">
			<label class="mb-0">Title</label>
		</div>
		<div class="col-md-8">
			<input type="text" name="title" id="title" class="form-control mt-10">
		</div>
		<div id="append">
			<div class="row y-middle">
				<div class="col-md-2">
					<label class="mb-0">Content</label>
				</div>
				<div class="col-md-8">
					<input type="text" name="docName[]" id="docName" class="form-control mt-10">
				</div>
			</div>
		</div>
	</div>
	<div class="mt-10 text-right">
		<button class="btn btn-red add_more" type="button">Add More</button>
		<button class="btn btn-red">Submit</button>
	</div>
</form>

<script type="text/javascript">
	var deletIds = [];
	$('.add_more').on('click',function(e){
		$('#mainRow').append('<div id="append"><div class="row y-middle"><div class="col-md-2"><label class="mb-0">Content</label></div><div class="col-md-8"><input type="text" name="docName[]" id="docName" class="form-control mt-10"></div></div></div>');
	});

	/*$('.delete').on('click',function(e){
		var dataDid = $(this).data('did');
		deletIds.push(dataDid);
		$(this).parent().parent().parent().remove();
		 updateDeletIdsInput();
	});*/

	function updateDeletIdsInput() {
        var deletIdsString = deletIds.join(',');
        $('#deletIds').val(deletIdsString);
    }
	
</script>
