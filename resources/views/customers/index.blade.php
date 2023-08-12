@inject('request', 'Illuminate\Http\Request')
@extends('layouts.business.header')

@section('content')

	@include('layouts.business.business_topbar')
   <div class="main-content">
		<div class="page-content">
         <div class="container-fluid">
            <div class="row">
               <div class="col">
                  <div class="h-100">
                     <div class="row mb-3">
								<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
									<div class="page-heading">
										<label>Manage Customers</label>
									</div>
								</div>
								<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
									<div class="import-export float-end mt-10">
										<button href="#" data-bs-toggle="modal" data-bs-target=".uploadfileall" class="btn btn-red">Upload</button>
										<form method="get" action="/exportcustomer">
											<input type="hidden" name="chk" id="chk" value="empty">
											<input type="hidden" name="id" id="id" value="{{$company->id}}">
											<button type="submit" class="btn btn-black">Export List</button> 
										</form>
									</div>
								</div>
							</div>

							<div class="">
								<label id="systemMessage1" class="font-16"></label>
							</div>
							
							<div class="row">
								<div class="col-xl-12">
									<div class="card">
										<div class="card-header align-items-center d-flex">
											<h4 class="card-title mb-0 flex-grow-1">Customers</h4>
										</div><!-- end card header -->
										<div class="card-body">
										   <div class="total-clients">
												<i class="fas fa-user-circle"></i>
												<label>You Have {{$customerCount}} Clients</label>
											</div>
											<input type="hidden" name="char" id="char" value="">
										   <div class="live-preview">
												<div class="accordion custom-accordionwithicon accordion-border-box" id="accordionnesting">
													@for($asciiValue = ord('A'); $asciiValue <= ord('Z'); $asciiValue++)
														<div class="accordion-item shadow">
															<h2 class="accordion-header" id="accordionnestingExample{{chr($asciiValue)}}">
																<button class="accordion-button collapsed uppercase" type="button" data-bs-toggle="collapse" data-bs-target="#accor_nestingExamplecollapse{{chr($asciiValue)}}" aria-expanded="false" aria-controls="accor_nestingExamplecollapse{{chr($asciiValue)}}" onclick="getData('{{chr($asciiValue)}}')">{{chr($asciiValue)}}</button></h2>
															<div id="accor_nestingExamplecollapse{{chr($asciiValue)}}" class="accordion-collapse collapse scroll-customer" aria-labelledby="accordionnestingExample{{chr($asciiValue)}}" data-bs-parent="#accordionnesting">
																<div class="accordion-body" id="targetDiv{{chr($asciiValue)}}"></div>
															</div>
														</div>
													@endfor
												</div>
											</div>
										</div><!-- end card-body -->
									</div><!-- end card -->
								</div>
								<!--end col-->
							</div>				
						</div> 
               </div> 
            </div>
         </div>
      </div>
   </div>
   
</div>
<div class="modal fade uploadfile" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="myModalLabel">Upload file for customer</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body">
				<div class="form-group mt-10">
					<label for="img">Choose File: </label>
					<input type="file" class="form-control" name="file" id="file" onchange="readURL(this)">
					<p class='err mt-10 font-red'></p>
					<div class="row">
						<div class="col-md-12">
							<div class="loading-container text-center loading-width d-none">
							  	<img src="{{'/public/images/processing.gif'}}" alt="Processing..." />
							</div>
						</div>
					</div>
				</div>					
			</div>
			<div class="modal-footer">
				<button type="button" id="upload-csv" class="btn btn-primary btn-red">Upload File</button>
			</div>
		</div>
	</div>
</div><!-- /.modal -->

<div class="modal fade uploadmembership" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="myModalLabel">Upload file for Membership Details</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body">
				<div class="form-group mt-10">
					<label for="img">Choose File: </label>
					<input type="file" class="form-control" name="membershipFile" id="file" onchange="readURL(this)">
					<p class='err mt-10 font-red'></p>
					<div class="row">
						<div class="col-md-12">
							<div class="loading-container text-center loading-width d-none">
							  	<img src="{{'/public/images/processing.gif'}}" alt="Processing..." />
							</div>
						</div>
					</div>
				</div>					
			</div>
			<div class="modal-footer">
				<button type="button" id="upload-membership" class="btn btn-primary btn-red">Upload File</button>
			</div>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<div class="modal fade uploadfileall" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered modal-50">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="myModalLabel">Upload file for customer</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body text-center">
				<div class="upload-files">
					<button type="button"  data-bs-toggle="modal" data-bs-target=".uploadfile" id="upload-csv1" class="btn btn-primary btn-red mb-10">Upload Client List</button>
					<button type="button" id="upload-csv2" class="btn btn-primary btn-black mb-10" data-bs-toggle="modal" data-bs-target=".uploadmembership" >Upload Membership Details</button>
					<button type="button" id="upload-csv3" class="btn btn-primary btn-red mb-10" data-bs-toggle="modal" data-bs-target=".uploadAttendance" >Upload Attendance Details</button>
				</div>
			</div>
		</div>
	</div>
</div><!-- /.modal -->
    
<div class="modal fade uploadAttendance" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="myModalLabel">Upload file for Attendance Details</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body">
				<div class="form-group mt-10">
					<label for="img">Choose File: </label>
					<input type="file" class="form-control" name="attendanceFile" id="file" onchange="readURL(this)">
					<p class='err mt-10 font-red'></p>
					<div class="row">
						<div class="col-md-12">
							<div class="loading-container text-center loading-width d-none">
							  	<img src="{{'/public/images/processing.gif'}}" alt="Processing..." />
							</div>
						</div>
					</div>
				</div>					
			</div>
			<div class="modal-footer">
				<button type="button" id="upload-attendance" class="btn btn-primary btn-red">Upload File</button>
			</div>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div>
	@include('layouts.business.footer')

<script>
	var profile_pic_var = '';
	var ext = '';
	function readURL(input) {
	   if (input.files && input.files[0]) {
	      const name = input.files[0].name;
	  		const lastDot = name.lastIndexOf('.');
	  		const fileName = name.substring(0, lastDot);
	   	ext = name.substring(lastDot + 1);
	   	var reader = new FileReader();
         reader.onload = function (e) {
             
         };
         profile_pic_var = input.files[0];
         reader.readAsDataURL(input.files[0]);
     }
	}
</script>

<script type="text/javascript">
	$(document).ready(function () {

      $('#upload-csv').click(function(){
        	if(profile_pic_var == ''){
        		$('.err').html('Select file to upload.');
        	}else if(ext != 'csv' && ext != 'csvx' && ext != 'xls' && ext != 'xlsx'){
            	$('.err').html('File format is not supported.')
        	}else{
        		$('.loading-container').removeClass('d-none');
         	var formdata = new FormData();
         	formdata.append('import_file',profile_pic_var);
         	formdata.append('business_id','{{$company->id}}');
          	formdata.append('_token','{{csrf_token()}}')
          	$.ajax({
               url:'/import-customer',
               type:'post',
               dataType: 'json',
               enctype: 'multipart/form-data',
               data:formdata,
               processData: false,
               contentType: false,
               headers: {'X-CSRF-TOKEN': $("#_token").val()},
               success: function (response) { 
                  $('.loading-container').addClass('d-none');
               	$('#systemMessage1').removeClass();
                  if(response.status == 200){
                     $('.uploadfile').modal('hide');
                     $('#systemMessage1').addClass('font-green font-16');
                     $('#systemMessage1').html(response.message);
                    /* setTimeout(function(){
                        window.location.reload();
                     },2000)*/
                  }
                  else{
                		$('.uploadfile').modal('hide');
                		$('#systemMessage1').addClass('font-red font-16');
                		$('#systemMessage1').html(response.message).addClass('alert alert-danger alert-dismissible');
                  }
                  $('#file').val('')
               }
         	});
        	}
    	});

    	$('#upload-membership').click(function(){
        	if(profile_pic_var == ''){
        		$('.err').html('Select file to upload.');
        	}else if(ext != 'csv' && ext != 'csvx' && ext != 'xls' && ext != 'xlsx'){
            	$('.err').html('File format is not supported.')
        	}else{
        			$('.loading-container').removeClass('d-none');
            	var formdata = new FormData();
            	formdata.append('import_file',profile_pic_var);
            	formdata.append('business_id','{{$company->id}}');
             	formdata.append('_token','{{csrf_token()}}')
             	$.ajax({
                  url:'/import-membership',
                  type:'post',
                  dataType: 'json',
                  enctype: 'multipart/form-data',
                  data:formdata,
                  processData: false,
                  contentType: false,
                  headers: {'X-CSRF-TOKEN': $("#_token").val()},
                  success: function (response) { 
                  	$('.loading-container').addClass('d-none');
                  	$('#systemMessage1').removeClass();
                     if(response.status == 200){
                        $('.uploadmembership').modal('hide');
                        $('#systemMessage1').addClass('font-green font-16');
                        $('#systemMessage1').html(response.message);
                        /*setTimeout(function(){
                           window.location.reload();
                        },2000)*/
                     }
                     else{
                   		$('.uploadmembership').modal('hide');
                   		$('#systemMessage1').addClass('font-red font-16');
                   		$('#systemMessage1').html(response.message).addClass('alert alert-danger alert-dismissible');
                     }
							$('#file').val('')
                  }
            	});
        	}
    	})

    	$('#upload-attendance').click(function(){
        	if(profile_pic_var == ''){
        		$('.err').html('Select file to upload.');
        	}else if(ext != 'csv' && ext != 'csvx' && ext != 'xls' && ext != 'xlsx'){
            	$('.err').html('File format is not supported.')
        	}else{
        		$('.loading-container').removeClass('d-none');
         	var formdata = new FormData();
         	formdata.append('import_file',profile_pic_var);
         	formdata.append('business_id','{{$company->id}}');
          	formdata.append('_token','{{csrf_token()}}')
          	$.ajax({
               url:'/import-attendance',
               type:'post',
               dataType: 'json',
               enctype: 'multipart/form-data',
               data:formdata,
               processData: false,
               contentType: false,
               headers: {'X-CSRF-TOKEN': $("#_token").val()},
               success: function (response) { 
               	$('.loading-container').addClass('d-none');
               	$('#systemMessage1').removeClass();
                  if(response.status == 200){
                     $('.uploadAttendance').modal('hide');
                     $('#systemMessage1').addClass('font-green font-16');
                     $('#systemMessage1').html(response.message);
                     /*setTimeout(function(){
                        window.location.reload();
                     },2000)*/
                  }
                  else{
                		$('.uploadAttendance').modal('hide');
                		$('#systemMessage1').addClass('font-red font-16');
                		$('#systemMessage1').html(response.message).addClass('alert alert-danger alert-dismissible');
                  }
						$('#file').val('')
               }
         	});
        	}
    	})
    	
    	$(document).on('click', '.delcustomer', function(e){
			e.preventDefault();
			let text = "Are you sure to delete this customer?";
			if (confirm(text) == true) {
				var token = $("meta[name='csrf-token']").attr("content");
			   $.ajax({
			      url: '/business/'+$(this).attr('data-business_id')+'/customers/delete/'+$(this).attr('data-id'),
			      type: 'DELETE',
			      data: {
			          "_token": token,
			      },
			      success: function (){
			      	location.reload();
			      }
			   });
			}
		});
	});

	function  sendmail(cid,bid) {
		$.ajax({
			url:'{{route("sendemailtocutomer")}}',
			type:"GET",
			xhrFields: {
            withCredentials: true
         },
			data:{
				cid:cid,
				bid:bid,
			},
			success:function(response){
				if(response == 'success'){
                    //$('.reviewerro').html('Email Successfully Sent..');
                  alert('Email Successfully Sent..');
                }else{
                    //$('.reviewerro').html("Can't Mail on this Address. Plese Check your Email..");
                  alert("Can't Mail on this Address. Plese Check Email..");
                }
			}
		});
	}
</script>

<script type="text/javascript">

	let offset  = 20;
 	var isLoading = false;

 	function getData(char){
		$('#char').val(char);
		offset = 20;
		isLoading = false;
		$.ajax({
         url: '{{ route("load.view") }}',
         type: 'GET',
         data: {
            char: char // Pass the variable here
         },
         success: function(response) {
             // On success, set the HTML of the target div with the loaded view
             $('#targetDiv'+char).html(response);
         },
         error: function(xhr) {
             // Handle the error if the AJAX request fails
             console.log(xhr.responseText);
         }
     });
	}

	$(document).ready(function () {
      $(window).scroll(function () {
   		var char = $('#char').val();
   		if(char != ''){
            if ($(window).scrollTop() + $(window).height() > $("#accor_nestingExamplecollapse"+char).height()) {
               // Check if not already loading more records and not all records are loaded
               if (!isLoading && offset !== -1) {
                  loadMoreRecords(char);
               }
            }
         }
      });
   });

   function loadMoreRecords(char) {
     isLoading = true;
     $.ajax({
         url: '/get-more-records',
         method: 'GET',
         data: { 
         	offset: offset,
         	char: char,
         },
         success: function (response) {
            if (response != '') {
               $('#targetDiv'+char).append(response);
               offset = offset + 20;
               isLoading = false;
            }else {
               // All records have been loaded
               offset = -1;
            }
         },
         error: function (xhr, status, error) {
             console.error(error);
             isLoading = false;
         }
     });
   }

</script>
@endsection