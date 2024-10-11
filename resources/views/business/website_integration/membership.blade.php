
<div class="row">
	<div id="message" class="text-center"></div>
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<h5 class="text-center font-red fs-20 mb-15"> Purchase Membership</h5>
	</div>
	<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
		<label class="mb-10">Step: 1 </label> <span>Select Service</span>
		<div class="activityselect3 special-date mb-15">
			<select id="services" class="form-control" >
				<option value="">Select Service</option>
				@foreach($services as $s)
			    	<option value="{{$s->id}}">{{$s->program_name}}</option>
			    @endforeach
			</select>
		</div>
	</div>
	<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
		<label class="mb-10">Step: 2 </label> <span>Select Date</span>
		<div class="activityselect3 special-date mb-15">
			<input type="text" name="actfildate_forcart" id="actfildate_forcart" placeholder="Date" class="form-control" autocomplete="off"  onchange="updatedetail('{{ $companyId }}','','date','');" >
		</div>
	</div>
			
	@php 
		$date = date('l').', '.date('F d,  Y'); 
		$totalquantity = 0;
	@endphp 
	<div id="updatefilterforcart">
	</div>

	<div class="row">
		<div class="col-md-12">
			<div class="font-red text-center mb-10" id="spoterror"></div>
			<div class="font-green text-center mb-10" id="successMsg"></div>
		</div>
	</div> 
</div>


{{-- <!-- activity booking  -->
<div class="modal fade" id="ActivtityFail" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog counter-modal-size">
		<div class="modal-content">
			<div class="modal-body conuter-body">
				<div class="row">
					<div class="col-lg-12">
						 <h4 class="modal-title partcipate-model">You can't book this activity for today.Please add another time.</h4>
					</div>
				</div>
			</div>
		</div>                                                                       
	</div>                                          
</div> --}}

<script type="text/javascript">
	$(document).ready(function () {
		var uniqueAids = {};

		$('#add-one').prop('readonly', true);
		$(document).on('click','.addonplus',function(){
			id = $(this).attr('aid');
			$('#add-one'+id).val(parseInt($('#add-one'+id).val()) + 1 );
			if (!uniqueAids[id]) {
		      	uniqueAids[id] = true; // Mark aid as unique
		    }

		    var commaSeparatedAids = Object.keys(uniqueAids).join(',');
		    $('#addOnServicesId').val(commaSeparatedAids);
		    setAddOnServiceTotal();
		});

    	$(document).on('click','.addonminus',function(){
    		id = $(this).attr('aid');
    		if (!uniqueAids[id]) {
		      	uniqueAids[id] = true; // Mark aid as unique
		    }

			$('#add-one'+id).val(parseInt($('#add-one'+id).val()) - 1 );
			if ($('#add-one'+id).val() <= 0) {
				$('#add-one'+id).val(0);
		    	delete uniqueAids[id];
			}
			
		    var commaSeparatedAids = Object.keys(uniqueAids).join(',');
		    $('#addOnServicesId').val(commaSeparatedAids);

		    setAddOnServiceTotal();
	    });

	    $('#adultcnt').prop('readonly', true);
		$(document).on('click','.adultplus',function(){
		    $('#adultcnt').val(parseInt($('#adultcnt').val()) + 1 );
		    $('#adultCount').val(parseInt($('#adultcnt').val()));
		    $('#totalcnt').val(parseInt($('#totalcnt').val() + 1));
		    calculateTotal();
		    participateCnt('adult');
		});

    	$(document).on('click','.adultminus',function(){
			$('#adultcnt').val(parseInt($('#adultcnt').val()) - 1 );
			if ($('#adultcnt').val() <= 0) {
				$('#adultcnt').val(0);
			}
			$('#totalcnt').val(parseInt($('#totalcnt').val() - 1));
			if ($('#totalcnt').val() <= 0) {
				$('#totalcnt').val(0);
			}
			$('#adultCount').val(parseInt($('#adultcnt').val()));
			calculateTotal();
			
			removeParticipateCnt('adult');
			
	    });

	    $('#childcnt').prop('readonly', true);
		$(document).on('click','.childplus',function(){
			$('#childcnt').val(parseInt($('#childcnt').val()) + 1 );
			$('#totalcnt').val(parseInt($('#totalcnt').val() + 1));
			$('#childCount').val(parseInt($('#childcnt').val()));
			calculateTotal();
			
			participateCnt('child');
			
		});
    	$(document).on('click','.childminus',function(){
			$('#childcnt').val(parseInt($('#childcnt').val()) - 1 );
			$('#totalcnt').val(parseInt($('#totalcnt').val() - 1));
			if ($('#childcnt').val() <= 0) {
				$('#childcnt').val(0);
			}
			if ($('#totalcnt').val() <= 0) {
				$('#totalcnt').val(0);
			}
			$('#childCount').val(parseInt($('#childcnt').val()));
			calculateTotal();
			
			removeParticipateCnt('child');
			
	    }); 

	    $('#infantcnt').prop('disabled', true);
		$(document).on('click','.infantplus',function(){
			$('#infantcnt').val(parseInt($('#infantcnt').val()) + 1 );
			$('#totalcnt').val(parseInt($('#totalcnt').val()) + 1 );
			$('#infantCount').val(parseInt($('#infantcnt').val()));
			calculateTotal();
			
			participateCnt('infant');
			
		});

    	$(document).on('click','.infantminus',function(){
			$('#infantcnt').val(parseInt($('#infantcnt').val()) - 1 );
			$('#totalcnt').val(parseInt($('#totalcnt').val()) - 1 );
			if ($('#infantcnt').val() <= 0) {
				$('#infantcnt').val(0);
			}
			if ($('#totalcnt').val() <= 0) {
				$('#totalcnt').val(0);
			}
			$('#infantCount').val(parseInt($('#infantcnt').val()));
			calculateTotal();
			removeParticipateCnt('infant');
	    });
	});


    function participateCnt(type){
		$.ajax({
            type: "POST",
            url: '{{route("get-participatedata")}}',
            data: {
            	'_token' : '{{csrf_token()}}',
            	'cid' : '{{$companyId}}',
            	'priceid' : $('#selprice').val(),
            	'type' : type,
            	'cus_id' : '{{$customerId}}',
            },
            success: function(data) {
                $('#participantDiv').append(data);
            }
        });
	}

	function removeParticipateCnt(type){
		$('#participantDiv').children('.'+type).last().remove();
	}

	function  setAddOnServiceTotal() {
		var totalQty =  0;
		var sQty = '';
		var addOnServicesId = $('#addOnServicesId').val();
		var idArray = addOnServicesId.split(','); 
		for (var i = 0; i < idArray.length; i++) {
			sQty +=  $('#add-one' + idArray[i]).val() + ',';
		    qty  =   parseFloat($('#add-one' + idArray[i]).val()) || 0;
		    price =   parseFloat($('#add-one' + idArray[i]).attr('apirce')) || 0;
			totalQty += qty * price;
		}
		if (sQty.endsWith(",")) {
		  	sQty = sQty.slice(0, -1);
		}
		sQty = (addOnServicesId != '') ? sQty : '';
		$('#addOnServicesQty').val(sQty);
		$('#addOnServicesTotalPrice').val(totalQty);		
		calculateTotal();
	}

	function calculateTotal(){
		var adultCount = parseInt($('#adultCount').val()) || 0;
		var childCount = parseInt($('#childCount').val()) || 0;
		var infantCount = parseInt($('#infantCount').val()) || 0;
		var adultPrice = parseFloat($('#adultDiscountPrice').val()) || 0;
		var childPrice = parseFloat($('#childDiscountPrice').val()) || 0;
		var infantPrice = parseFloat($('#infantDiscountPrice').val()) || 0;
		var addOnServicesTotalPrice = parseFloat($('#addOnServicesTotalPrice').val()) || 0;

		var total = (adultCount * adultPrice) + (childCount * childPrice) + (infantCount * infantPrice);
		var totalQty =  adultCount + childCount + infantCount;
		total = (addOnServicesTotalPrice != '') ? ( total + addOnServicesTotalPrice) : total;
		$('#totalQty').val(totalQty);
		$('#textPrice').html('$'+ parseFloat(total)+' USD' || '$0 USD');
		$('#priceTotal').val(parseFloat(total) || 0);
		$('#price').val(parseFloat(total) || 0);

		var formattedTotal = '$' + parseFloat(total).toFixed(2) + ' USD';
		localStorage.setItem('textPrice', formattedTotal);
		localStorage.setItem('totalPrice', parseFloat(total).toFixed(2));
	}



	function addhiddentime(id,sid,chk) {
		if(chk == 1)
		{
			$('#schedulebody').html('<div class="row "> <div class="col-lg-12 text-center"> <div class="modal-inner-txt scheduler-time-txt label-space"><label>You can\'t book this activity for today.</label><label> The time has passed.</label><label>Please choose another time.</label></div> </div></div>');
			setTimeout(function() {
				$('.participateDiv').html('<p>No Participate Available</p>');
			}, 2000);
			$('#scheduleModal').modal('show');
		}
		else{
			updatedetail('{{$companyId}}',sid,'schedule',id);
		}
	}

	function updatedetail(cid,sid,type,val){
		var sid = $('#services').val();
		var actdate = $('#actfildate_forcart').val();
		var serviceid = sid;
		var categoryId = $('#selcatpr').val();
		var priceId = $('#selprice').val();
		var scheduleId = $('.checkbox-option:checked').attr('id');
		// var users={{$users}};
		var users = @json($users);
		var cid =@json($companyId);
		// var cid ={{$companyId}};
		if(type == 'date'){
			categoryId = '';
			scheduleId = '';
			priceId = '';
			scheduleId = '';
		}else if(type == 'category'){
			categoryId = val;
			scheduleId = '';
			priceId = '';
		}else if(type == 'price'){
			priceId = val;
			scheduleId = ''
		}else if(type == 'schedule'){
			scheduleId = val;
		}
		
	
		$.ajax({
			url: "{{route('act_detailfilterforcart')}}",
			type: 'POST',
			dataType: 'JSON',
			data:{
				_token: '{{csrf_token()}}',
				actdate:actdate,
				serviceid:serviceid,
				companyid:cid,
				categoryId:categoryId,
				priceId:priceId,
				scheduleId:scheduleId,
				scheduleId:scheduleId,
				users:users,
				type: 'checkin_portal'
			},
			success: function (response) {
				if(response != ''){
					$('#updatefilterforcart').html(response.html);
					$('#sesdate'+sid).val(actdate);
					$('.date-title').html(response.date);
				}else{
					$('#updatefilterforcart').html('');
				}
			}
		});
	}

	$(document).ready(function() {

		function initializeDatePicker(active_days) {
	        $('#actfildate_forcart').datepicker('destroy').datepicker({
	            minDate: 0,
	            changeMonth: true,
	            changeYear: true,
	            yearRange: "1960:2060",
	            dateFormat: "M-dd-yy",
	            beforeShowDay: function(date) {
	                const days = ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'];
	                for (var i = 0; i < active_days.length; i++) {
	                    var start = new Date(active_days[i][0]);
	                    var end = new Date(active_days[i][1]);
	                    if (date >= start && date <= end) {
	                        if (active_days[i][2].match(days[date.getDay()])) {
	                            return [1];
	                        }
	                    }
	                }
	                return [0];
	            }
	        });
	    }

	    $('#services').change(function() {
	        var sid = $(this).val();
            const csrfToken = $('meta[name="csrf-token"]').attr('content');
	        $.ajax({
	            url: '{{ route('getActivityDates') }}',
	            method: 'POST',
	            data: {
	                sid: sid,
	                _token: '{{ csrf_token() }}'
	            },
	            success: function(response) {
	                updateDatePicker(response.active_days);
	                $('#actfildate_forcart').val(response.next_available_date);
	                updatedetail('{{ $companyId }}', sid, 'date', '');
	            }
	        });
	    });

	     initializeDatePicker([]);

	    function updateDatePicker(active_days) {
	        $('#actfildate_forcart').datepicker('destroy').datepicker({
	            minDate: 0,
	            changeMonth: true,
	            changeYear: true,
	            yearRange: "1960:2060",
	            dateFormat: "M-dd-yy",
	            beforeShowDay: function(date) {
	                const days = ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'];
	                for (var i = 0; i < active_days.length; i++) {
	                    var start = new Date(active_days[i][0]);
	                    var end = new Date(active_days[i][1]);
	                    if (date >= start && date <= end) {
	                        if (active_days[i][2].match(days[date.getDay()])) {
	                            return [1];
	                        }
	                    }
	                }
	                return [0];
	            }
	        });
	    }
	});

	var uniqueIdCounter = 1; // Initialize a counter to generate unique IDs

	function updateDropdownIds() {
		$('select[id^="participats_"]').each(function() {
			let currentId = $(this).attr('id');
			let newId = `participats_${uniqueIdCounter++}`; // Create a new unique ID
			$(this).attr('id', newId); // Update the ID attribute
		});
	}


	function getUrl(pid, sid) {
		$('.hiddenALink').html('');
		var adultCount = $('#adultCount').val();
		var childCount = $('#childCount').val();
		var infantCount = $('#infantCount').val();
		var aosId = $('#addOnServicesId').val();
		var aosQty = $('#addOnServicesQty').val();
		var aosPrice = $('#addOnServicesTotalPrice').val();
		var date = $('#actfildate_forcart').val();

		// Initialize an array to hold participant values
		var participants = [];
		$('select[id^="participats_"]').each(function() {
			participants.push($(this).val());
		});

		console.log(participants); // Check participant values

		if (sid !== undefined) {
			// Use the route() helper to generate the base URL
			var url = '{{ route('getBookingsSummary') }}';

			// Use AJAX to fetch the content with parameters passed in data
			$.ajax({
				url: url,
				type: 'GET', // or 'POST' if your route expects POST data
				data: {
					priceId: pid,
					schedule: sid,
					adultCount: adultCount,
					childCount: childCount,
					infantCount: infantCount,
					date: date,
					aosPrice: aosPrice,
					aosId: aosId,
					aosQty: aosQty,
					participants: participants.join(',')
				},
				success: function(response) {
					// Create a new modal for the booking summary
					var newModalHtml = `
						<div class="modal fade booking_modal" id="bookingSummaryModal" tabindex="-1" role="dialog" aria-labelledby="bookingSummaryModalLabel" aria-hidden="true">
							<div class="modal-dialog modal-dialog-centered">
								<div class="modal-content">
									<div class="modal-header">
										<h5 class="modal-title" id="bookingSummaryModalLabel"></h5>
										<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
									</div>
									<div class="modal-body">
										${response}
									</div>
								</div>
							</div>
						</div>
					`;

					// Append the new modal to the body
					$('body').append(newModalHtml);

					// Initialize and show the new modal
					var bookingSummaryModal = new bootstrap.Modal(document.getElementById('bookingSummaryModal'));
					bookingSummaryModal.show();

					// Remove the modal from DOM after it's hidden
					$('#bookingSummaryModal').on('hidden.bs.modal', function () {
						$(this).remove();
					});
				}
			});
		}
	}
	$(document).on("click", "#btnaddcart", function() {
		$('#spoterror').html('');
		var timechk = $('#timechk').val();
		var totalQty = parseInt($('#totalQty').val());
		var maxQty = parseInt($('#maxQty').val());

		if(timechk == 1) {
			if(totalQty == 0) {
				var message = '';

				if($('#cate_title').val() == '') {
					message = "Please select category.";
				} else if($('#priceid').val() == '') {
					message = "Please select price option.";
				} else if($('#actscheduleid').val() == '') {
					if($('.notimeoption').html() != '' && $('.notimeoption').html() != undefined) {
						message = "<br>Please select time.";
					} else {
						message = "<br>Please select time.";
					}
				} else {
					message = "Please select a participant.";
				}

				$('#spoterror').html(message);
			} else if(totalQty > maxQty) {
				$('#spoterror').html("You have " + maxQty + " sports left.");
			} else {	
				var form = $("#addtocartform");
				var formdata = new FormData(form[0]); 
				var selectedOptions = getAllSelectedOptions(); // Get selected participants
				var cartData = {
					// customer_id: '{{$customerId}}',
					customer_id: @json($customerId),
					cate_title: $('#cate_title').val(),
					priceid: $('#priceid').val(),
					actscheduleid: $('#actscheduleid').val(),
					totalQty: totalQty,
					selectedOptions: selectedOptions // Pass selected participants as array
				};
				var totalPrice = localStorage.getItem('totalPrice') || 0;
				// var users={{$users}};
				var users= @json($users);
				var allSelected = true;
		        $('.familypart').each(function() {
		            if ($(this).find('option:selected').not('[value=""]').length === 0) {
		                allSelected = false;
		                return false;
		            }
		        });
    			if (allSelected) {
						var selectedOptions = getAllSelectedOptions();
						$.each(selectedOptions, function(index, option) {
							formdata.append('participateAry[' + index + '][id]', option.id);
							formdata.append('participateAry[' + index + '][from]', option.from);

				        });
					}
				// end
				$.ajax({
					type: "POST",
					url: '{{route("addto_cart")}}',
					data: formdata,  
					// contentType: "application/json",  
					contentType: false, // Required for FormData
					processData: false, // Required for FormData
					success: function(response) {
						if (response.message == 'no_spots') {
							$('#spoterror').html("There are no spots left.");
						} else {
							$('#successMsg').html('memberhsip added successfully');
							let cartWidgetIds = response.cartWidgetIds;
							// Send data to getMembershipPayment
							$.ajax({
								type: "POST",
								url: "{{route('checkin.getMembership-Payment')}}",
								data: {
									_token: '{{csrf_token()}}',
									// customer_id: '{{$customerId}}',
									customer_id: @json($customerId),
									cart_items: cartData, // Pass cart data directly
									totalPrice: totalPrice,
									users:users,			
									cartWidgetIds: cartWidgetIds 						 
								},
								success: function(data) {
									// console.log(data);
									$('#anotherModal').modal('hide');
									$('#ajax_html_modal').modal('hide');
									$('.membership-modal').modal('show');
									$('.membership-modal-content').html(data);
								}
							});
						}
					}
				});
			}
		} else {
			var errorMessage = `
				<h5>You can't book this activity for today. Please add another time.</h5><hr>`;
			$('#message').html(errorMessage);
		}
	});


	function getAllSelectedOptions() {
        var selectedOptions = [];

        $('#participantDiv').find('select').each(function() {
            var selectedValue = $(this).val();
            var dataType = $(this).find('option:selected').data('type');
            selectedOptions.push({ id: selectedValue, from: dataType });
        });
        
        return selectedOptions;
    }


	function getInsModal(scid) {	
		var url = '{{route("getInstructureDataUrl")}}';
		$.ajax({
			url: url,
			method: 'GET',
			data: {
                scheduleId: scid
            },
			success: function(response) {
			$('#instructorContent').html(response);
			var bookingSummaryModal = document.getElementById('bookingSummaryModal');
            var bsModal = bootstrap.Modal.getInstance(bookingSummaryModal);
            if (bsModal) {
                bsModal.hide();
            }
			var myModal = new bootstrap.Modal(document.getElementById('instructorModal'), {
				keyboard: false
			});
			myModal.show();
			},
			error: function() {
			   alert('An error occurred while fetching the instructor details.');
			}
		});
	}
	

	
</script>

<script>
	function sendHeight() {
		var height = document.body.scrollHeight;      
		window.parent.postMessage({
			height: 1000
		}, '*');  
	}
	sendHeight();
	window.addEventListener('message', function(event) {
		if (event.data.action === 'getHeight') {
			sendHeight(); 
		}
	});
</script>