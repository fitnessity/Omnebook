@extends('layouts.headertest')
@section('content')

<!-- Navigation-->
<div class="p-0 col-md-12 inner_top padding-0">
    <div class="row">
        <div class="col-md-2" style="background: black;">
        	
        </div>

        <div class="col-md-10">
        	
            <div class="container-fluid p-0" id="creServicediv">
            	<div class="tab-hed">Create Services & Prices</div>
                
                <section class="row" style="padding: 40px 10px;">
                	<div class="col-md-2">
						<input type="button" class="btn btn-red" name="btnCreateService" id="btnCreateService" value="Create Service" />
					</div>
                    <div class="col-md-2">
                    	<div class="dropdown">
                        	<form method="POST" action="">
                            @csrf
                        	<button class="btn btn-primary dropdown-toggle" type="button" name="btnManageService" id="btnManageService" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Manage Service
							<span class="caret"></span>
							</button>
                            <ul class="dropdown-menu manageserviceUL" aria-labelledby="manage-service">
                            	<li class="individual"><a href="javascript:void(0);" data-sid="2" class="clsManageService">Aerobics - Aerobics in Central Park with the best </a></li>
                                <li class="individual"><a href="javascript:void(0);" data-sid="1" class="clsManageService">Aerobics - Aerobics in Central Park </a></li>
                            </ul>
                            </form>
						</div>
                    </div>
                
                
            </div>
        
        </div>
	</div>
</div>
<script src="https://code.jquery.com/jquery.min.js"></script>
<script>
$(document).ready(function(){ 
	//$(".clsManageService").click(function () { 
	$( ".clsManageService" ).on( "click", function() {
		//alert('call');
		var sid = $(this).data('sid');
		var token= '{{csrf_token()}}';
		alert(token);
		$.ajax({
			url: '{{route("getTestServiceData")}}',
			type: 'POST',
			crossDomain: false,
			cache: false,
			"dataType": "json",
            contentType:false,
			headers: {'X-CSRF-TOKEN': token},
			data:{
				'_token': token,
				'sid':sid,
			},
			success: function (data) { 
			alert(data);
			}
		});
	});
});
</script>
@endsection
