<div class="row" id="mainRow">
	<div class="display-msg fs-16 mb-10"></div>
	@forelse($content as $i=>$c)
		<form id="image-upload-form{{$c->id}}" method="post" enctype="multipart/form-data">
			@method('PUT')
			@csrf
			<input type="hidden" name="id" name="id" value="{{$c->id}}">
			<div class="row border-bottom-grey">
				<div class="col-md-2 col-sm-2 col-12">
					<label class="mt-10">{{$i+1}}. {{$c->content}}</label>
				</div>
				
				<div class="col-md-2 col-sm-2 col-6 @if(!$c->path) d-none @endif">
					@if($c->path)
						<a href="{{Storage::URL($c->path)}}" target="_blank" class=""><i class="fas fa-eye"></i> View </a>
					@endif
				</div>
				<div class="col-md-4 col-sm-4 col-6">
					<input type="hidden" name="old_profile_pic" value="">
					<div class="avatar-xs p-0 rounded-circle profile-photo-edit mt-10">
						<input id="profile-img-file-input" name ="image" type="file" class="profile-img-file-input" data-cid="{{$c->id}}">
					</div>
				</div>

				<div class="col-md-1 col-sm-1 col-6 @if(!$c->path) d-none @endif">
					@if($c->path)
						<img src="{{Storage::URL($c->path)}}" class="avatar-xs rounded-circle me-2 shadow">
					@endif
				</div>

				<div class="col-md-3 col-sm-3 col-12 mt-10 mmb-10" id="statusDiv{{$c->id}}">
					@if($c->path)
						<span class="font-green">Document Uploaded</span>
					@else
						<span class="font-red">Document Not Uploaded</span>
					@endif
				</div>
				
			</div>
		</form>
	@empty
	@endforelse
	
</div>

<script type="text/javascript">
	$('.profile-img-file-input').change(function() {
        var fileInput = this;
        if (fileInput.files.length > 0) {
	        var fileType = fileInput.files[0].type;

	        if (fileType.startsWith('image/')) {
		        var cid = $(this).attr('data-cid');
		        var formData = new FormData($("#image-upload-form"+cid)[0]);
		        $.ajax({
		            type: 'POST',
		            url: '/personal/documents-contract/' + cid,
		            data: formData,
		            contentType: false,
		            processData: false,
		            success: function (response) {
		            	openDocumentModal('{{$id}}','upload')
		            	/*alert(response.message);
		            	$('#statusDiv'+cid).html('<span class="font-green">Document Uploaded</span>');*/
		            }
		        });
		    } else {
	            alert('Please select a valid image file.');
	            $(this).val('');
	        }
	    }
    });
</script>
