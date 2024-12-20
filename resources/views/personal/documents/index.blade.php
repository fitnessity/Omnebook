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
							<h1>Documents & Contracts </h1>
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
										<div class="col-lg-3 col-md-2 col-sm-2 col-12">
											 <div class="">
												<span><a @if(!$d->CustomerDocumentsRequested->isEmpty())  href="#" onclick="openDocumentModal('{{$d->id}}','load')"  @elseif($d->path) href="{{ route('download', ['id' => $d->id]) }}" target="_blank" @endif> {{$d->title}}</a></span>
											 </div>
										</div>
										<div class="col-lg-3 col-md-3 col-sm-2 col-12">
											 <div class="">
												<span><i class="fas fa-link"></i> Uploaded on {{date('m/d/Y', strtotime($d->created_at))}}</span>
											 </div>
										</div>
										<div class="col-lg-2 col-md-2 col-sm-2 col-12">
											@if($d->sign_date)
											<div class="">
												<span>Signed On {{date('m/d/Y', strtotime($d->sign_date))}}</span>
											</div>
											@endif
										</div>

										<div class="col-lg-1 col-md-2 col-sm-2 col-3">
											@if($d->status == 1)
											<div>
												<button type="button" class="btn btn-red mb-5 mmt-10 mmb-10" onclick="openModal('{{$d->id}}','{{$d->sign_path ? Storage::URL($d->sign_path) :''}}')"> @if($d->sign_date) Edit @else Sign @endif</button>
											</div>
											@endif
										</div>
										
										<div  class="col-lg-2 col-md-2 col-sm-3 col-8">
											@if(!$d->CustomerDocumentsRequested->isEmpty())
												<button type="button" class="btn btn-red mb-5 mmt-10 mmb-10" onclick="openDocumentModal('{{$d->id}}','{{ $d->checkUploadDocument() == 1 ? "load" : "upload"}}')"> @if($d->checkUploadDocument() == 1) Edit Document @else Document Requested @endif </button>

											@endif
										</div>

										<div class="col-lg-1 col-md-1 col-sm-1 col-1">
											<div class="multiple-options">
												<div class="setting-icon">
													<i class="ri-more-fill"></i>
													<ul>
														<li><a  @if(!$d->CustomerDocumentsRequested->isEmpty())  href="#" onclick="event.preventDefault(); openDocumentModal('{{$d->id}}','load')"  @elseif($d->path) href="{{Storage::URL(@$d->path)}}" target="_blank" @endif >  <i class="fas fa-plus text-muted"></i>View</a></li>
														<li class="dropdown-divider"></li>

														<li><a @if(!$d->CustomerDocumentsRequested->isEmpty())  href="#" onclick="event.preventDefault(); openDocumentModal('{{$d->id}}','load')"  @elseif($d->path) href="{{ route('download', ['id' => $d->id]) }}" target="_blank" @endif > <i class="fas fa-plus text-muted"></i>Download</a></li>
														<li class="dropdown-divider"></li>

														<li><a onclick="deleteDoc({{$d->id}},{{$d->business_id}})"><i class="ri-delete-bin-fill align-bottom me-2 text-muted"></i>Delete</a></li>
													</ul>
												</div>
											</div>
										</div>
									</div>
								@empty	
									Document Not Available
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
									<div class="col-lg-7 col-md-5 col-sm-5 col-7">
										 <div class="mmt-10 mmb-10">
											<span>Covid-19 Protocols @if(@$customer->terms_covid) agreed on {{date('m/d/Y',strtotime(@$customer->terms_covid))}} @endif </span>
										 </div>
									</div>
									<div class="col-lg-3 col-md-3 col-sm-3 col-7">
										@if(@$customer->terms_covid)
										 	<div class="mmt-10 mmb-10">
												<span>Signed on {{date('m/d/Y',strtotime(@$customer->terms_covid))}} </span>
										 	</div>
										@endif
									</div>
									
									<div class="col-lg-1 col-md-2 col-sm-2 col-3">
										@if(!@$customer->terms_covid)
										<div>
											<button type="button" class="btn btn-red float-right mb-5 mt-5" onclick="openTermsModal('{{$customer->id}}','{{$customer->covid_sign_path ? Storage::URL($customer->covid_sign_path) :''}}','covid')">Sign </button>
										</div>
										@endif
									</div>
									
									<div class="col-lg-1 col-md-2 col-sm-2 col-2">
										<div class="multiple-options">
											<div class="setting-icon">
												<i class="ri-more-fill"></i>
												<ul>
													<li><a onclick="downloadPdf('{{request()->business_id}}', 'covid');"><i class="fas fa-plus text-muted"></i>Download</a></li>
													<li><a onclick="viewPdf('covidDiv');"><i class="fas fa-plus text-muted"></i>View</a></li>
												</ul>
											</div>
										</div>
									</div>									
								</div>
								<div class="row y-middle border-bottom-documents">
									<div class="col-lg-7 col-md-5 col-sm-5 col-7">
										 <div class="mmt-10 mmb-10">
											<span>Liability Waiver @if(@$customer->terms_liability) agreed on {{date('m/d/Y',strtotime(@$customer->terms_liability))}}  @endif</span>
										 </div>
									</div>

									<div class="col-lg-3 col-md-3 col-sm-3 col-7">
										@if(@$customer->terms_liability)
										 	<div class="mmt-10 mmb-10">
												<span>Signed on {{date('m/d/Y',strtotime(@$customer->terms_liability))}} </span>
										 	</div>
										@endif
									</div>
									
									<div class="col-lg-1 col-md-2 col-sm-2 col-3">
										@if(!@$customer->terms_liability)
										<div>
											<button type="button" class="btn btn-red float-right mb-5 mt-5" onclick="openTermsModal('{{$customer->id}}','{{$customer->liability_sign_path ? Storage::URL($customer->liability_sign_path) :''}}','liability')">Sign </button>
										</div>
										@endif
									</div>
									<div class="col-lg-1 col-md-2 col-sm-2 col-2">
										<div class="multiple-options">
											<div class="setting-icon">
												<i class="ri-more-fill"></i>
												<ul>
													<li><a onclick="downloadPdf('{{request()->business_id}}', 'liability');"><i class="fas fa-plus text-muted"></i>Download</a></li>
													<li><a onclick="viewPdf('liabilityDiv');"><i class="fas fa-plus text-muted"></i>View</a></li>
												</ul>
											</div>
										</div>
									</div>								
								</div>
								<div class="row y-middle border-bottom-documents">
									<div class="col-lg-7 col-md-5 col-sm-5 col-7">
										 <div class="mmt-10 mmb-10">
											<span>Contract Terms @if(@$customer->terms_contract) agreed on {{date('m/d/Y',strtotime(@$customer->terms_contract))}}  @endif</span>
										 </div>
									</div>

									<div class="col-lg-3 col-md-3 col-sm-3 col-7">
										@if(@$customer->terms_contract)
										 	<div class="mmt-10 mmb-10">
												<span>Signed on {{date('m/d/Y',strtotime(@$customer->terms_contract))}} </span>
										 	</div>
										@endif
									</div>
									
									<div class="col-lg-1 col-md-2 col-sm-2 col-3">
										@if(!@$customer->terms_contract)
										<div>
											<button type="button" class="btn btn-red float-right mb-5 mt-5" onclick="openTermsModal('{{$customer->id}}','{{$customer->contract_sign_path ? Storage::URL($customer->contract_sign_path) :''}}','contract')">Sign </button>
										</div>
										@endif
									</div>
									
									<div class="col-lg-1 col-md-2 col-sm-2 col-2">
										<div class="multiple-options">
											<div class="setting-icon">
												<i class="ri-more-fill"></i>
												<ul>
													<li><a onclick="downloadPdf('{{request()->business_id}}', 'contract');"><i class="fas fa-plus text-muted"></i>Download</a></li>
													<li><a onclick="viewPdf('contractDiv');"><i class="fas fa-plus text-muted"></i>View</a></li>
												</ul>
											</div>
										</div>
									</div>									
								</div>
								@php 
									$refundDate = @$lastBooking->created_at != '' ? date('m/d/Y',strtotime(@$lastBooking->created_at)) : date('m/d/Y',strtotime(@$customer->terms_refund)); 
								@endphp
								<div class="row y-middle border-bottom-documents">
									<div class="col-lg-7 col-md-5 col-sm-5 col-7">
										 <div class="mmt-10 mmb-10">
											<span>Refund Policy @if(@$refundDate) agreed on {{$refundDate}} @endif</span>
										 </div>
									</div>

									<div class="col-lg-3 col-md-3 col-sm-3 col-7">
										@if(@$refundDate)
										 	<div class="mmt-10 mmb-10">
												<span>Signed on {{$refundDate}} </span>
										 	</div>
										@endif
									</div>
									
									<div class="col-lg-1 col-md-2 col-sm-2 col-3">
										@if(!@$lastBooking->created_at)
										<div>
											<button type="button" class="btn btn-red float-right mb-5 mt-5" onclick="openTermsModal('{{$customer->id}}','{{$customer->refund_sign_path ? Storage::URL($customer->refund_sign_path) :''}}','refund')">{{$customer->refund_sign_path != '' ?  'Edit' : 'Sign' }} </button>
										</div>
										@endif
									</div>
									<div class="col-lg-1 col-md-2 col-sm-2 col-2">
										<div class="multiple-options">
											<div class="setting-icon">
												<i class="ri-more-fill"></i>
												<ul>
													<li><a onclick="downloadPdf('{{request()->business_id}}', 'refund');"><i class="fas fa-plus text-muted"></i>Download</a></li>
													<li><a onclick="viewPdf('refundDiv');"><i class="fas fa-plus text-muted"></i>View</a></li>
												</ul>
											</div>
										</div>
									</div>								
								</div>

								@php 
									$termsDate = @$lastBooking->created_at != '' ? date('m/d/Y',strtotime(@$lastBooking->created_at)) : date('m/d/Y',strtotime(@$customer->terms_condition)); 
								@endphp
								<div class="row y-middle border-bottom-documents">
									<div class="col-lg-7 col-md-5 col-sm-5 col-7">
										 <div class="mmt-10 mmb-10">
											<span>Terms, Conditions, FAQ  @if(@$termsDate) agreed on {{@$termsDate}} @endif</span>
										 </div>
									</div>

									<div class="col-lg-3 col-md-3 col-sm-3 col-7">
										@if(@$termsDate)
										 	<div class="mmt-10 mmb-10">
												<span>Signed on {{$termsDate}} </span>
										 	</div>
										@endif
									</div>

									<div class="col-lg-1 col-md-2 col-sm-2 col-3">
										@if(!@$lastBooking->created_at)
										<div>
											<button type="button" class="btn btn-red float-right mb-5 mt-5" onclick="openTermsModal('{{$customer->id}}','{{$customer->terms_sign_path ? Storage::URL($customer->terms_sign_path) :''}}','terms')">{{$customer->terms_sign_path != '' ?  'Edit' : 'Sign' }} </button>
										</div>
										@endif
									</div>
									<div class="col-lg-1 col-md-2 col-sm-2 col-2">
										<div class="multiple-options">
											<div class="setting-icon">
												<i class="ri-more-fill"></i>
												<ul>
													<li><a onclick="downloadPdf('{{request()->business_id}}', 'terms');"><i class="fas fa-plus text-muted"></i>Download</a></li>
													<li><a onclick="viewPdf('termsDiv');"><i class="fas fa-plus text-muted"></i>View</a></li>
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
				<button type="submit" class="btn btn-primary btn-red" id="saveSignature" data-did = "" data-type="">Submit</button>
			</div>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div>	

<div class="modal fade modalDocument" tabindex="-1" aria-labelledby="mySmallModalLabel">
	<div class="modal-dialog modal-dialog-centered modal-50" id="doc-width">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="myModalLabel">Requested Documents</h5>
					<button type="button" class="btn-close"  aria-label="Close"  onclick="window.location.reload()"></button>
			</div>
			<div class="modal-body" id="modalDocumentHtml">

			</div>
		</div>
	</div>
</div>

<div class="modal fade modalTerms" tabindex="-1" aria-labelledby="mySmallModalLabel">
	<div class="modal-dialog modal-dialog-centered modal-70" id="doc-width">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="myModalLabel">Terms</h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body" >
				<div class="col-md-12 text-justify mb-10 fs-14" id="termsHtml"></div>
			</div>
		</div>
	</div>
</div>

<div class="row mt-25">
	<div id="covidDiv" class="d-none">{!!@$terms->covidtext!!}</div>

	<div id="liabilityDiv"  class="d-none">{!!@$terms->liabilitytext!!}</div>

	<div id="contractDiv"  class="d-none">{!!@$terms->contracttermstext!!}</div>

	<div id="refundDiv"  class="d-none">{!!@$terms->refundpolicytext!!}</div>

	<div id="termsDiv"  class="d-none">{!!@$terms->termcondfaqtext!!}</div>
</div>

@include('layouts.business.footer')
@include('layouts.business.scripts')

<script type="text/javascript">
	$(document).ready(function() {
		$('.sign').modal({
        backdrop: 'static',
        keyboard: false
    	});
   });

	function openDocumentModal(id,type){
		$.ajax({
         type: 'GET',
         url: '/personal/getContent/'+id+'/'+type,
         success: function (response) {
         	
         		$('#doc-width').addClass('modal-50');
         	
            $('#modalDocumentHtml').html(response);
				$('.modalDocument').modal('show');
         }
      });
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

	function downloadPdf(cid,name){
		var downloadUrl = '{{ route("personal.export") }}' +'?cid=' + cid +'&type=' + name;
		filename = name+'.pdf';
		var link = document.createElement('a');
		link.href = downloadUrl;
		link.download = filename;
		document.body.appendChild(link);
		link.click();
		document.body.removeChild(link);
	}

	function viewPdf(name){
		var data = $('#'+name).html(); 
		if (!data) {
			data = 'No Terms Available';
		}
		$('#termsHtml').html(data);
		$('.modalTerms').modal('show');
	}



</script>

<script>

        const canvas = document.getElementById('signatureCanvas');
        const ctx = canvas.getContext('2d');
        var drawing = false;

         function startDrawing(e) {
            e.preventDefault();
            var pos = getMouseOrTouchPos(canvas, e);
            ctx.beginPath();
            ctx.moveTo(pos.x, pos.y);
            drawing = true;
         }

         function draw(e) {
            e.preventDefault();
            if (!drawing) return;

            var pos = getMouseOrTouchPos(canvas, e);
            ctx.lineTo(pos.x, pos.y);
            ctx.stroke();
         }

         function stopDrawing(e) {
            e.preventDefault();
            drawing = false;
        }

        function getMouseOrTouchPos(canvas, e) {
            var rect = canvas.getBoundingClientRect();
            var clientX, clientY;

            if (e.touches && e.touches.length > 0) {
                clientX = e.touches[0].clientX;
                clientY = e.touches[0].clientY;
            } else {
                clientX = e.clientX;
                clientY = e.clientY;
            }

            return {
                x: clientX - rect.left,
                y: clientY - rect.top
            };
        }

        // Add unified event listeners
        canvas.addEventListener('mousedown', startDrawing);
        canvas.addEventListener('mousemove', draw);
        canvas.addEventListener('mouseup', stopDrawing);
        canvas.addEventListener('mouseout', stopDrawing);

        canvas.addEventListener('touchstart', startDrawing);
        canvas.addEventListener('touchmove', draw);
        canvas.addEventListener('touchend', stopDrawing);
        canvas.addEventListener('touchcancel', stopDrawing);

        	const clearButton = document.getElementById('clearButton');
			clearButton.addEventListener('click', clearCanvas);

			function clearCanvas() {
		  		ctx.clearRect(0, 0, canvas.width, canvas.height);
			}

			$('#saveSignature').click(function() {
	    	// Convert the canvas to an image (data URL)
		    	var signatureDataUrl = canvas.toDataURL();

		    	// Submit the signature using AJAX
	   	 	$.ajax({
		        type: 'POST',
		        url: "{{ route('personal.save.signature') }}",
		        data: {
		            _token: "{{ csrf_token() }}",
		            signature: signatureDataUrl,
		            id: $('#saveSignature').attr('data-did'),
		            type: $('#saveSignature').attr('data-type'),
		            cus_id: '{{@$customer->id}}',
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
	        var proxyUrl = 'image-proxy?url=' + encodeURIComponent(imageData);
	        var img = new Image();
	        img.crossOrigin = 'anonymous'; // Enable CORS for the image
	        img.onload = function() {
	            ctx.drawImage(img, 0, 0, canvas.width, canvas.height);
	        };
	        img.src = proxyUrl;
	    	}
    


   	function openTermsModal(id,path,type){
		 		ctx.clearRect(0, 0, canvas.width, canvas.height);
		    	$('#saveSignature').attr('data-did',id);
		    	$('#saveSignature').attr('data-type',type);
		    	loadImage(path);
		    	$('.sign').modal('show');
		   }

		   function openModal(id,path){
		 		ctx.clearRect(0, 0, canvas.width, canvas.height);
		    	$('#saveSignature').attr('data-did',id);
		    	loadImage(path);
		    	$('.sign').modal('show');
		   }
</script>

@endsection