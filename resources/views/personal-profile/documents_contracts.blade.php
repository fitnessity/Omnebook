@inject('request', 'Illuminate\Http\Request')
@extends('layouts.business.header')

@section('content')

	@include('layouts.profile.business_topbar')
	
	<div class="main-content">
		<div class="page-content">
			<div class="container-fluid">
				<div class="row mb-3">
					<div class="col-12">
						<div class="page-heading">
							<label>Documents & Contracts </label>
						</div>
					</div>
				</div><!--end row-->
				<div class="row">
					<div class="col-xl-12">
						<div class="card">
							<div class="card-header align-items-center d-flex">
								<h4 class="card-title mb-0 flex-grow-1">Documents</h4>
							</div><!-- end card header -->
							<div class="card-body">
								@forelse($documents as $d)
									<div class="row y-middle border-bottom-documents mt-5">
										<div class="col-lg-4 col-md-4 col-12">
											 <div class="">
												<span><a href="{{ route('download', ['id' => $d->id]) }}" target="_blank"> {{$d->title}}</a></span>
											 </div>
										</div>
										<div class="col-lg-3 col-md-3 col-9">
											 <div class="">
												<span><i class="fas fa-link"></i> Uploaded on {{date('m/d/Y', strtotime($d->created_at))}}</span>
											 </div>
										</div>

										<div class="col-lg-2 col-md-2 col-3">
											@if($d->status == 1)
											<div>
												<button type="button" class="btn btn-red float-right mb-5" onclick="openModal('{{$d->id}}','{{$d->sign_path ? Storage::URL($d->sign_path) :''}}')">Sign </button>
											</div>
											@endif
										</div>
										
										<div  class="col-lg-2 col-md-2 col-1">
											@if(!$d->CustomerDocumentsRequested->isEmpty())
												<button type="button" class="btn btn-red float-right mb-5" onclick="openDocumentModal('{{$d->id}}')">Upload Document </button>

											@endif
										</div>

										<div class="col-lg-1 col-md-2 col-12">
											<div class="multiple-options">
												<div class="setting-icon">
													<i class="ri-more-fill"></i>
													<ul>
														<li><a  @if(@$d->path) href="{{Storage::URL(@$d->path)}}" @endif target="_blank"> <i class="fas fa-plus text-muted"></i>View</a></li>
														<li class="dropdown-divider"></li>

														<li><a href="{{ route('download', ['id' => $d->id]) }}" target="_blank"> <i class="fas fa-plus text-muted"></i>Download</a></li>
														<li class="dropdown-divider"></li>

														<li><a onclick="deleteDoc({{$d->id}},{{$d->business_id}})"><i class="ri-delete-bin-fill align-bottom me-2 text-muted"></i>Delete</a></li>
													</ul>
												</div>
											</div>
										</div>
									</div>
								@empty
								@endforelse
							</div>
						</div>
					</div>
				</div>
				
				<div class="row">
					<div class="col-xl-12">
						<div class="card">
							<div class="card-header align-items-center d-flex">
								<h4 class="card-title mb-0 flex-grow-1">Agreed Terms & Contracts</h4>
							</div><!-- end card header -->
							<div class="card-body">							
								<div class="row y-middle border-bottom-documents">
									<div class="col-lg-10 col-md-9 col-7">
										 <div class="">
											<span>Covid-19 Protocols @if(@$customer->terms_covid) agreed on {{date('m/d/Y',strtotime(@$customer->terms_covid))}} @endif </span>
										 </div>
									</div>
									
									<div class="col-lg-1 col-md-2 col-3">
										@if(!@$customer->terms_covid)
										<div>
											<button type="button" class="btn btn-red float-right mb-5" data-bs-toggle="modal" data-bs-target=".sign">Sign </button>
										</div>
										@endif
									</div>
									
									<div class="col-lg-1 col-md-1 col-2">
										<div class="multiple-options">
											<div class="setting-icon">
												<i class="ri-more-fill"></i>
												<ul>
													<li><a href=""><i class="fas fa-plus text-muted"></i>Download</a></li>
												</ul>
											</div>
										</div>
									</div>									
								</div>
								<div class="row y-middle border-bottom-documents">
									<div class="col-lg-10 col-md-9 col-7">
										 <div class="">
											<span>Liability Waiver @if(@$customer->terms_liability) agreed on {{date('m/d/Y',strtotime(@$customer->terms_liability))}}  @endif</span>
										 </div>
									</div>
									
									<div class="col-lg-1 col-md-2 col-3">
										@if(!@$customer->terms_liability)
										<div>
											<button type="button" class="btn btn-red float-right mb-5" data-bs-toggle="modal" data-bs-target=".sign">Sign </button>
										</div>
										@endif
									</div>
									<div class="col-lg-1 col-md-1 col-2">
										<div class="multiple-options">
											<div class="setting-icon">
												<i class="ri-more-fill"></i>
												<ul>
													<li><a href=""><i class="fas fa-plus text-muted"></i>Download</a></li>
												</ul>
											</div>
										</div>
									</div>								
								</div>
								<div class="row y-middle border-bottom-documents">
									<div class="col-lg-10 col-md-9 col-7">
										 <div class="">
											<span>Contract Terms @if(@$customer->terms_contract) agreed on {{date('m/d/Y',strtotime(@$customer->terms_contract))}}  @endif</span>
										 </div>
									</div>
									
									<div class="col-lg-1 col-md-2 col-3">
										@if(!@$customer->terms_contract)
										<div>
											<button type="button" class="btn btn-red float-right mb-5" data-bs-toggle="modal" data-bs-target=".sign">Sign </button>
										</div>
										@endif
									</div>
									
									<div class="col-lg-1 col-md-1 col-2">
										<div class="multiple-options">
											<div class="setting-icon">
												<i class="ri-more-fill"></i>
												<ul>
													<li><a href=""><i class="fas fa-plus text-muted"></i>Download</a></li>
												</ul>
											</div>
										</div>
									</div>									
								</div>
								<div class="row y-middle border-bottom-documents">
									<div class="col-lg-10 col-md-9 col-7">
										 <div class="">
											<span>Refund Policy  @if(@$lastbooking->created_at) agreed on {{date('m/d/Y',strtotime(@$lastbooking->created_at))}} @endif</span>
										 </div>
									</div>
									<div class="col-lg-1 col-md-2 col-3">
										@if(!@$lastbooking->created_at)
										<div>
											<button type="button" class="btn btn-red float-right mb-5" data-bs-toggle="modal" data-bs-target=".sign">Sign </button>
										</div>
										@endif
									</div>
									<div class="col-lg-1 col-md-1 col-2">
										<div class="multiple-options">
											<div class="setting-icon">
												<i class="ri-more-fill"></i>
												<ul>
													<li><a href=""><i class="fas fa-plus text-muted"></i>Download</a></li>
												</ul>
											</div>
										</div>
									</div>								
								</div>
								<div class="row y-middle border-bottom-documents">
									<div class="col-lg-10 col-md-9 col-7">
										 <div class="">
											<span>Terms, Conditions, FAQ  @if(@$lastbooking->created_at) agreed on {{date('m/d/Y',strtotime(@$lastbooking->created_at))}} @endif</span>
										 </div>
									</div>
									<div class="col-lg-1 col-md-2 col-3">
										@if(!@$lastbooking->created_at)
										<div>
											<button type="button" class="btn btn-red float-right mb-5" data-bs-toggle="modal" data-bs-target=".sign">Sign </button>
										</div>
										@endif
									</div>
									<div class="col-lg-1 col-md-1 col-2">
										<div class="multiple-options">
											<div class="setting-icon">
												<i class="ri-more-fill"></i>
												<ul>
													<li><a href=""><i class="fas fa-plus text-muted"></i>Download</a></li>
												</ul>
											</div>
										</div>
									</div>									
								</div>
								
							</div><!-- end card Body -->
						</div>
					</div>
				</div>
									
			</div><!-- container-fluid -->
		</div>
	</div><!-- end main content-->
</div><!-- END layout-wrapper -->
	
<div class="modal fade sign" tabindex="-1" aria-labelledby="mySmallModalLabel" aria-modal="true" role="dialog">
	<div class="modal-dialog modal-dialog-centered width-345">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="myModalLabel">Sign Below</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body">
				<div class="row">
					<div class="col-lg-12">
						<canvas id="signatureCanvas"></canvas>
					</div>						
				</div>
			</div>
			<div class="modal-footer">
				<button type="submit" id="clearButton" class="btn btn-primary btn-black">Clear</button>
				<button type="submit" class="btn btn-primary btn-red" id="saveSignature" data-did = "">Submit</button>
			</div>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div>	

<div class="modal fade modalDocument" tabindex="-1" aria-labelledby="mySmallModalLabel">
	<div class="modal-dialog modal-dialog-centered">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="myModalLabel">Documents</h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body" id="modalDocumentHtml">

			</div>
		</div>
	</div>
</div>

@include('layouts.business.footer')

<script type="text/javascript">

	function openDocumentModal(id){
		$.ajax({
         type: 'GET',
         url: '/docContentForCustomer/'+id,
         success: function (response) {
            $('#modalDocumentHtml').html(response);
				$('.modalDocument').modal('show');
         }
      });
	}

    function openModal(id,path){
 		context.clearRect(0, 0, canvas.width, canvas.height);
    	$('#saveSignature').attr('data-did',id);
    	loadImage(path);
    	$('.sign').modal('show');
    }

	function deleteDoc(id,cid){
		let text = "You are about to delete the document. Are you sure you want to continue?";
		if (confirm(text)) {
	      $.ajax({
	         type: 'GET',
	         url: '/removeDoc/'+id,
	         success: function (data) {
	            window.location.reload();
	         }
	      });
	   }
	}

	$('#upload-pdf').click(function(){
    	$('.err').html('');
     	var formdata = new FormData();
     	formdata.append('file',docToUpload);
     	formdata.append('id','{{$customer->id}}');
     	formdata.append('title',$('#docTitle').val());
      	formdata.append('_token','{{csrf_token()}}')
      	$.ajax({
            url: '{{ route('upload_docs', ['business_id' => request()->business_id]) }}',
           type:'post',
           dataType: 'json',
           enctype: 'multipart/form-data',
           data:formdata,
           processData: false,
           contentType: false,
           headers: {'X-CSRF-TOKEN': $("#_token").val()},
           success: function (response) { 
           	$('#docMessage').removeClass();
              if(response.status == 200){
                 $('#docMessage').addClass('font-green font-16');
                 $('#docTitle').val('');
                 $('#docMessage').html(response.message);
                 setTimeout(function() {
					        window.location.reload();
					   }, 1000);
              }
              else{
            		$('#docMessage').addClass('font-red font-16');
            		$('#docMessage').html(response.message).addClass('alert alert-danger alert-dismissible');
              }
              $('#file').val('')
           }
     	});
	});

</script>

<script>

	// Get the canvas element and create a drawing context
	const canvas = document.getElementById('signatureCanvas');
	const context = canvas.getContext('2d');

	let isDrawing = false;
	let lastX = 0;
	let lastY = 0;

	// Add event listeners to track mouse movements
	canvas.addEventListener('mousedown', startDrawing);
	canvas.addEventListener('mousemove', draw);
	canvas.addEventListener('mouseup', stopDrawing);
	canvas.addEventListener('mouseout', stopDrawing);
	canvas.addEventListener('touchstart', startDrawing);
	canvas.addEventListener('touchmove', draw);
	canvas.addEventListener('touchend', stopDrawing);
	canvas.addEventListener('touchcancel', stopDrawing);

	// Function to start drawing
	function startDrawing(event) {
  		var isTouch = event.type.startsWith('touch'); // Check if it's a touch event
  
  		if (isTouch) {
		    var touch = event.touches[0]; // Get the first touch point
		    lastX = touch.clientX;
		    lastY = touch.clientY;
		} else {
		    lastX = event.offsetX;
		    lastY = event.offsetY;
		}
    
  		isDrawing = true;
  		// [lastX, lastY] = [event.offsetX, event.offsetY];
	}

	// Function to draw
	function draw(event) {
	  	if (!isDrawing) return;
	  	var isTouch = event.type.startsWith('touch'); // Check if it's a touch event
	  	var x, y;

	  	if (isTouch) {
		    var touch = event.touches[0]; // Get the first touch point
		    x = touch.clientX;
		    y = touch.clientY;
		} else {
		    x = event.offsetX;
		    y = event.offsetY;
		}
	  
	  	context.beginPath();
	  	context.moveTo(lastX, lastY);
	  	context.lineTo(x, y);
	  	context.stroke();
	  
	  	lastX = x;
	  	lastY = y;
	}

	// Function to stop drawing
	function stopDrawing() {
  		isDrawing = false;
	}

	// Clear the canvas when the clear button is clicked
	const clearButton = document.getElementById('clearButton');
	clearButton.addEventListener('click', clearCanvas);

	function clearCanvas() {
  		context.clearRect(0, 0, canvas.width, canvas.height);
	}

	$('#saveSignature').click(function() {
    	// Convert the canvas to an image (data URL)
    	var signatureDataUrl = canvas.toDataURL();

    	// Submit the signature using AJAX
   	 	$.ajax({
	        type: 'POST',
	        url: "{{ route('save.signature') }}",
	        data: {
	            _token: "{{ csrf_token() }}",
	            signature: signatureDataUrl,
	            id: $('#saveSignature').attr('data-did'),
	        },
	        success: function(response) {
	            alert('Signature saved successfully.');
	            window.location.reload();
	        },
	        error: function(error) {
	            alert('Error saving signature.');
	        }
    	});
    });

    function  loadImage(imageData) {
        var proxyUrl = '/image-proxy?url=' + encodeURIComponent(imageData);
        var img = new Image();
        img.crossOrigin = 'anonymous'; // Enable CORS for the image
        img.onload = function() {
            context.drawImage(img, 0, 0, canvas.width, canvas.height);
        };
        img.src = proxyUrl;
    }

</script>
@endsection