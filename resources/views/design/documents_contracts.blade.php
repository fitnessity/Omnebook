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
								<div class="row y-middle border-bottom-documents mt-5">
									<div class="col-lg-4 col-md-4 col-12">
										 <div class="">
											<span>Lorem Ipsum</span>
										 </div>
									</div>
									<div class="col-lg-4 col-md-4 col-9">
										 <div class="">
											<span><i class="fas fa-link"></i> Uploaded on 11/19/2023</span>
										 </div>
									</div>
									<div class="col-lg-3 col-md-2 col-3">
										<div>
											<button type="button" class="btn btn-red float-right mb-5" data-bs-toggle="modal" data-bs-target=".sign">Sign </button>
										</div>
									</div>
									<div class="col-lg-1 col-md-2 col-12">
										<div class="multiple-options">
											<div class="setting-icon">
												<i class="ri-more-fill"></i>
												<ul>
													<li><a href=""><i class="fas fa-plus text-muted"></i>Download</a></li>
													<li class="dropdown-divider"></li>
													<li><a href=""><i class="ri-delete-bin-fill align-bottom me-2 text-muted"></i>Delete</a></li>
												</ul>
											</div>
										</div>
									</div>
								</div>
								<div class="row y-middle border-bottom-documents mt-5">
									<div class="col-lg-4 col-md-4 col-12">
										 <div class="">
											<span>Lorem Ipsum</span>
										 </div>
									</div>
									<div class="col-lg-4 col-md-4 col-9">
										 <div class="">
											<span><i class="fas fa-link"></i> Uploaded on 11/19/2023</span>
										 </div>
									</div>
									<div class="col-lg-3 col-md-2 col-3">
										<div>
											<button type="button" class="btn btn-red float-right mb-5 " data-bs-toggle="modal" data-bs-target=".sign">Sign </button>
										</div>
									</div>
									<div class="col-lg-1 col-md-2 col-12">
										<div class="multiple-options">
											<div class="setting-icon">
												<i class="ri-more-fill"></i>
												<ul>
													<li><a href=""><i class="fas fa-plus text-muted"></i>Download</a></li>
													<li class="dropdown-divider"></li>
													<li><a href=""><i class="ri-delete-bin-fill align-bottom me-2 text-muted"></i>Delete</a></li>
												</ul>
											</div>
										</div>
									</div>
								</div>
							</div><!-- end card Body -->
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
											<span>Covid-19 Protocols agreed on 06/07/2023 </span>
										 </div>
									</div>
									<div class="col-lg-1 col-md-2 col-3">
										<div>
											<button type="button" class="btn btn-red float-right mb-5" data-bs-toggle="modal" data-bs-target=".sign">Sign </button>
										</div>
									</div>
									<div class="col-lg-1 col-md-1 col-2">
										<div class="multiple-options">
											<div class="setting-icon">
												<i class="ri-more-fill"></i>
												<ul>
													<li><a href=""><i class="fas fa-plus text-muted"></i>Download</a></li>
													<li class="dropdown-divider"></li>
													<li><a href=""><i class="ri-delete-bin-fill align-bottom me-2 text-muted"></i>Delete</a></li>
												</ul>
											</div>
										</div>
									</div>									
								</div>
								<div class="row y-middle border-bottom-documents">
									<div class="col-lg-10 col-md-9 col-7">
										 <div class="">
											<span>Liability Waiver agreed on 06/07/2023 </span>
										 </div>
									</div>
									<div class="col-lg-1 col-md-2 col-3">
										<div>
											<button type="button" class="btn btn-red float-right mb-5" data-bs-toggle="modal" data-bs-target=".sign">Sign </button>
										</div>
									</div>
									<div class="col-lg-1 col-md-1 col-2">
										<div class="multiple-options">
											<div class="setting-icon">
												<i class="ri-more-fill"></i>
												<ul>
													<li><a href=""><i class="fas fa-plus text-muted"></i>Download</a></li>
													<li class="dropdown-divider"></li>
													<li><a href=""><i class="ri-delete-bin-fill align-bottom me-2 text-muted"></i>Delete</a></li>
												</ul>
											</div>
										</div>
									</div>								
								</div>
								<div class="row y-middle border-bottom-documents">
									<div class="col-lg-10 col-md-9 col-7">
										 <div class="">
											<span>Contract Terms agreed on 06/07/2023 </span>
										 </div>
									</div>
									<div class="col-lg-1 col-md-2 col-3">
										<div>
											<button type="button" class="btn btn-red float-right mb-5" data-bs-toggle="modal" data-bs-target=".sign">Sign </button>
										</div>
									</div>
									<div class="col-lg-1 col-md-1 col-2">
										<div class="multiple-options">
											<div class="setting-icon">
												<i class="ri-more-fill"></i>
												<ul>
													<li><a href=""><i class="fas fa-plus text-muted"></i>Download</a></li>
													<li class="dropdown-divider"></li>
													<li><a href=""><i class="ri-delete-bin-fill align-bottom me-2 text-muted"></i>Delete</a></li>
												</ul>
											</div>
										</div>
									</div>									
								</div>
								<div class="row y-middle border-bottom-documents">
									<div class="col-lg-10 col-md-9 col-7">
										 <div class="">
											<span>Refund Policy agreed on 06/07/2023  </span>
										 </div>
									</div>
									<div class="col-lg-1 col-md-2 col-3">
										<div>
											<button type="button" class="btn btn-red float-right mb-5" data-bs-toggle="modal" data-bs-target=".sign">Sign </button>
										</div>
									</div>
									<div class="col-lg-1 col-md-1 col-2">
										<div class="multiple-options">
											<div class="setting-icon">
												<i class="ri-more-fill"></i>
												<ul>
													<li><a href=""><i class="fas fa-plus text-muted"></i>Download</a></li>
													<li class="dropdown-divider"></li>
													<li><a href=""><i class="ri-delete-bin-fill align-bottom me-2 text-muted"></i>Delete</a></li>
												</ul>
											</div>
										</div>
									</div>								
								</div>
								<div class="row y-middle border-bottom-documents">
									<div class="col-lg-10 col-md-9 col-7">
										 <div class="">
											<span>Terms, Conditions, FAQ agreed on 06/07/2023 </span>
										 </div>
									</div>
									<div class="col-lg-1 col-md-2 col-3">
										<div>
											<button type="button" class="btn btn-red float-right mb-5" data-bs-toggle="modal" data-bs-target=".sign">Sign </button>
										</div>
									</div>
									<div class="col-lg-1 col-md-1 col-2">
										<div class="multiple-options">
											<div class="setting-icon">
												<i class="ri-more-fill"></i>
												<ul>
													<li><a href=""><i class="fas fa-plus text-muted"></i>Download</a></li>
													<li class="dropdown-divider"></li>
													<li><a href=""><i class="ri-delete-bin-fill align-bottom me-2 text-muted"></i>Delete</a></li>
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
					<button type="submit" class="btn btn-primary btn-red">Submit</button>
				</div>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div>	

@include('layouts.business.footer')
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


</script>