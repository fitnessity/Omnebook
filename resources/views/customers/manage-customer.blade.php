@extends('layouts.header')
@section('content')
@include('layouts.userHeader')
@php 
	use Carbon\Carbon;
@endphp
<div class="p-0 col-md-12 inner_top padding-0">
    <div class="row">
        <div class="col-md-2 col-sm-12" style="background: black;">
        	 @include('business.businessSidebar')
        </div>
		<div class="col-md-10 col-sm-12">
            <div class="container-fluid p-0">
				<div class="row">
					<div class="col-md-4 col-xs-6">
						<div class="tab-hed ">Manage Customers</div>
					</div>
					<div class="col-md-8 col-xs-6">
						<div class="row">
							<div class="col-md-3">
								<a href="#" class="btn-nxt manage-cus-btn" data-toggle="modal" data-target="#newclient">Add New Client</a>
							</div>
							<div class="col-md-6">
								<div class="manage-search serchcustomer">
									<form>
										<input type="text" name="serchclient" id="serchclient" placeholder="Search for client" autocomplete="off" value="">
										<div id="option-box1"></div>
										<button ><i class="fa fa-search"></i></button>
									</form>
								</div>
							</div>

							<div class="col-md-3">
								<button  id="serchbtn" type="button" class="btn-nxt search-btn-sp" onclick="getcustomerlist();">Search</button>
							</div>
						</div>
					</div>
				</div>
                <!--<div class="tab-hed manage-cus">Manage Customers</div>
				<button type="button" class="btn-nxt manage-cus-btn">Add New Client</button>-->
				<hr style="border: 3px solid black; width: 115%; margin-left: -38px; margin-top: 5px;">
            </div>

			<div id="systemMessage1" style="padding-top:10px;"></div>
			<div class="row">
				<div class="col-md-6 col-xs-12">
				</div>
				<div class="col-md-6 col-xs-12">
					<div class="staff-main">
						<button href="#" data-toggle="modal" data-target="#exampleModal"  class="btn-bck btn-black">Import List</button>
						<form method="get" action='{{route("export")}}'>
							<input type="hidden" name="chk" id="chk" value="empty">
							<input type="hidden" name="id" id="id" value="{{$companyId}}">
							<button type="submit" class="btn-nxt" >Export List</button> 
						</form>
						
						<!-- <button type="button" class="btn-nxt" onclick="exportcustomer();">Export List</button> -->
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12 col-xs-12" id="customerlist">
					<div class="total-clients">
						<i class="fas fa-user-circle"></i>
						<label>You Have {{$customer_count}} Clients</label>
					</div>
					<div class="panel-group" id="accordion-customer">
						@php  $i= 0;@endphp
						@foreach ($customers as $section=>$cust) 
						<div class="custom-panel panel panel-default">
							<div class="custom panel-heading">
								<h4 class="panel-title">
									<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion-customer" href="#collapse_{{$i}}">
									{{$section}}
									</a>
								</h4>
							</div>
							<div id="collapse_{{$i}}" class="panel-collapse collapse" data-parent="#accordion-customer">
								<div class="panel-body">
									<div class="row">
										<div class="col-md-12">
											@foreach ($cust as $dt) 
											@php $age = $dt->getcustage(); @endphp
											<div class="collapse-inner-box mrb-2">
												<div class="row">
													<div class="col-md-1 col-xs-3 col-sm-1">
														<div class="collapse-img">
															{!! $dt->getimage() !!}
															
														</div>
													</div>
													<div class="col-md-2 col-xs-8 col-sm-2">
														<div class="client-name">
															<span>{{$dt->fname}} {{$dt->lname}}</span>
															<p>Last Attended: 20/09/2019</p>
														</div>
													</div>
													<div class="col-md-1 col-xs-12 col-sm-1">
														<div class="client-age">
															<span>Age: {{$age}}</span>
														</div>
													</div>
													<div class="col-md-2 col-xs-12 col-sm-2">
														<div class="client-status">
															<label>Status: </label>
															
															<span class="green-fonts">
																@if($dt->status == 0)
																	InActive
																@else
																	Active;
																@endif</span>
														</div>
													</div>
													<div class="col-md-2 col-xs-12 col-sm-3">
														<div class="client-status">
															<label>Active Memberships: </label>
															<span class="green-fonts">2</span>
														</div>
													</div>
													<div class="col-md-1 col-xs-12 col-sm-2">
														<div class="client-status">
															<label>Expiring Soon: </label>
															<span class="red-fonts">1</span>
														</div>
													</div>
													<div class="col-md-2 col-xs-12 col-sm-1">
														<div class=" scheduled-btns">
															<button onclick="sendmail({{$dt->id}},{{$companyId}});" class="btn-edit btn-sp">Send Welcome Email</button>
															<a href="{{ route('viewcustomer',['id'=>$dt->id]) }}" class="btn-edit">View</a>
														</div>
													</div>
													<div class="col-md-1 col-xs-12 col-sm-1">
														<div class=" scheduled-btns">
															<a href="{{ route('deletecustomer',['id'=>$dt->id]) }}" class="delcustomer">
																<i class="fa fa-trash"></i></a>
															<!-- <a href="{{ route('deletecustomer',['id'=>$dt->id]) }}" class="btn-edit">Delete</a> -->
														</div>
													</div>
												</div>
											</div>	
											@endforeach									
										</div>
									</div>
								</div>
							</div>
						</div>
						<script type="text/javascript">
							$("#collapse_{{$i}}").click(function(){
								$(".panel-collapse").removeClass(' show in');
								$("#collapse_{{$i}}").addClass(' show in');
							});
						</script>
						@php  $i++;  @endphp
						@endforeach
					</div>
				</div>
			</div>
		</div>
	</div>

<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title" id="exampleModalLabel">Upload File for Customer</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form>
              <label>Choose File: </label>
              <input type="file" name="file" id="file" onchange="readURL(this)" />
              <p class='err' style="color:red;padding-top:10px;"></p>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="button" id="upload-csv" class="btn btn-secondary">Upload File</button>
        </div>
      </div>
    </div>
</div>

<!-- The Modal Add Business-->
@include('includes.add_new_client')
<!-- end modal -->
</div>


<!-- Latest compiled and minified JavaScript -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<!--<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>-->
@include('layouts.footer')
<script type="text/javascript">
    function initMap() {
        var map = new google.maps.Map(document.getElementById('map'), {
            center: {lat: -33.8688, lng: 151.2195},
            zoom: 13
        });

        var input = document.getElementById('b_address');
        map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);
        var autocomplete = new google.maps.places.Autocomplete(input);
        autocomplete.bindTo('bounds', map);
        var infowindow = new google.maps.InfoWindow();
        var marker = new google.maps.Marker({
            map: map,
            anchorPoint: new google.maps.Point(0, -29)
        });

        autocomplete.addListener('place_changed', function() {
            infowindow.close();
            marker.setVisible(false);
            var place = autocomplete.getPlace();
            if (!place.geometry) {
                window.alert("Autocomplete's returned place contains no geometry");
                return;
            }

            // If the place has a geometry, then present it on a map.
            if (place.geometry.viewport) {
                map.fitBounds(place.geometry.viewport);
            } else {
                map.setCenter(place.geometry.location);
                map.setZoom(17);
            }

            marker.setIcon(({
                url: place.icon,
                size: new google.maps.Size(71, 71),
                origin: new google.maps.Point(0, 0),
                anchor: new google.maps.Point(17, 34),
                scaledSize: new google.maps.Size(35, 35)
            }));

            marker.setPosition(place.geometry.location);
            marker.setVisible(true);
            var address = '';
            var badd = '';
            var sublocality_level_1 = '';
            if (place.address_components) {
                address = [
                  (place.address_components[0] && place.address_components[0].short_name || ''),
                  (place.address_components[1] && place.address_components[1].short_name || ''),
                  (place.address_components[2] && place.address_components[2].short_name || '')
                ].join(' ');
            }

            infowindow.setContent('<div><strong>' + place.name + '</strong><br>' + address);
            infowindow.open(map, marker);
            // Location details
            for (var i = 0; i < place.address_components.length; i++) {
                if(place.address_components[i].types[0] == 'postal_code'){
                  $('#b_zipcode').val(place.address_components[i].long_name);
                }
                if(place.address_components[i].types[0] == 'country'){
                  $('#b_country').val(place.address_components[i].long_name);
                }

                if(place.address_components[i].types[0] == 'locality'){
                    $('#b_city').val(place.address_components[i].long_name);
                }

                if(place.address_components[i].types[0] == 'sublocality_level_1'){
                    sublocality_level_1 = place.address_components[i].long_name;
                }

                if(place.address_components[i].types[0] == 'street_number'){
                   badd = place.address_components[i].long_name ;
                }

                if(place.address_components[i].types[0] == 'route'){
                   badd += ' '+place.address_components[i].long_name ;
                } 

                if(place.address_components[i].types[0] == 'administrative_area_level_1'){
                  $('#b_state').val(place.address_components[i].long_name);
                }
            }

            if(badd == ''){
              $('#b_address').val(sublocality_level_1);
            }else{
              $('#b_address').val(badd);
            }
            
            $('#modeladdress').html('Business Address : ' + place.formatted_address);
            $('#lat').val(place.geometry.location.lat());
            $('#lon').val(place.geometry.location.lng());
        });
    }
</script>

<script src="https://maps.googleapis.com/maps/api/js?libraries=places&key=AIzaSyCr7-ilmvSu8SzRjUfKJVbvaQZYiuntduw&callback=initMap" async defer></script>
<script>
  	var profile_pic_var = '';
  	var ext = '';

  	function readURL(input) {
	    if (input.files && input.files[0]) {
	      const name = input.files[0].name;
	      const lastDot = name.lastIndexOf('.');
	      const fileName = name.substring(0, lastDot);
	      ext = name.substring(lastDot + 1);
	      //console.log(ext)
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
		  $("#collapse_0").addClass('show in');
      $('#upload-csv').click(function(){
        	if(profile_pic_var == ''){
        		$('.err').html('Select file to upload.');
        	}else if(ext != 'csv' && ext != 'csvx' && ext != 'xls' && ext != 'xlsx'){
            	$('.err').html('File format is not supported.')
        	}else{
            	var formdata = new FormData();
            	formdata.append('import_file',profile_pic_var);
            	formdata.append('business_id','{{$companyId}}');
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
                  beforeSend: function () {
                     $('.loader').show();
                  },
                  complete: function () {
                     $('.loader').hide();
                  },
                  success: function (response) { 
                      if(response.status == 200){
                          $('#exampleModal').modal('hide');
                          $('#systemMessage1').html(response.message).addClass('alert alert-success');
                          setTimeout(function(){
                              window.location.reload();
                          },2000)
                      }
                      else{
                      	$('#systemMessage1').html(response.message).addClass('alert alert-danger alert-dismissible');
                          $('#file').val('')
                          $('#exampleModal').modal('hide');
                      }
                  }
            	});
        	}
    	})
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

@endsection