<h5 class="modal-title text-center mb-20" id="myModalLabel">Add A New {{$name}} </h5>
				
<div class="fs-18 text-center"id="success"></div>
<div class="modal-body">
	<div class="row y-middle"> 
		<div class="col-lg-4">
			<div>
				<label class="fs-15">{{$name}} Name </label>
			</div>
		</div>
		<div class="col-lg-8">
			<div>
				<input type="text" class="form-control" name="{{strtolower($name)}}_name" id="{{strtolower($name)}}_name" placeholder="Enter {{$name}}">
			</div>
		</div>
	</div>
    <div class="row">
        <div class="col-md-12">
            <button type="button" class="btn btn-primary btn-red float-right mt-10" onclick="addVariant('{{strtolower($name)}}')">Add</button>
        </div>
    </div>
</div>

<script type="text/javascript">
	
	function addVariant(type){
		var name = $('#'+type+'_name').val();

		if(name){
	        $.ajax({
	            url: '/business/'+'{{$business_id}}'+'/addVariant/',
	            type: 'POST',
	            data: {
	                _token: '{{csrf_token()}}',
	                type: type,
	                name: name,
	            },
	            success: function(response){
	            	$('#'+type+'_name').val('');
	            	if(response.success){
	            		var select = new SlimSelect({
				            select: '#'+type,
				            data: response.data // Assuming data is an array of new options
				        });

	            		$('#success').addClass('font-green').removeClass('font-red').html(response.success);
	            	}else{
	            		$('#success').addClass('font-red').removeClass('font-green').html(response.error);
	            	}
	                
	            }
	        });
	    }else{
	    	alert('Please Enter Name')
	    }
    }


</script>
	