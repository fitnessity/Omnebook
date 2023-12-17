<div class="row y-middle" id="mainRow">
	<div class="display-msg fs-16 mb-10"></div>
	@forelse($content as $c)
		<form id="image-upload-form{{$c->id}}" method="post" enctype="multipart/form-data">
			@method('PUT')
			@csrf
			<input type="hidden" name="id" name="id" value="{{$c->id}}">
			<div class="row y-middle">
				<div class="col-md-4">
					<lable> {{$c->content}}</lable>
				</div>
				
				<div class="col-md-3">
					@if($c->path)
						<a href="{{Storage::URL($c->path)}}" target="_blank" class="mr-10"><i class="fas fa-eye"></i> View </a>
					@endif
				</div>
				<div class="col-md-5">
					<input type="hidden" name="old_profile_pic" value="">
					<div class="avatar-xs p-0 rounded-circle profile-photo-edit">
						<input id="profile-img-file-input" name ="image" type="file" class="profile-img-file-input" data-cid="{{$c->id}}">
					</div>
				</div>
				
			</div>
		</form>
	@empty
	@endforelse
	
</div>

<script type="text/javascript">
	$('.profile-img-file-input').change(function() {
        // Trigger form submission when an image is selected
        var cid = $(this).attr('data-cid');
        var formData = new FormData($("#image-upload-form"+cid)[0]);
        $.ajax({
            type: 'POST',
            url: '/personal/documents-contract/' + cid,
            data: formData,
            contentType: false,
            processData: false,
            success: function (response) {
            	$('.display-msg').removeClass('font-green');
            	$('.display-msg').removeClass('font-red');
            	if(response.status == '200'){
            		$('.display-msg').addClass('font-green');
            	}else{
            		$('.display-msg').addClass('font-red');
            	}
            	$('.display-msg').html(response.message);
            }
        });
    });
</script>
