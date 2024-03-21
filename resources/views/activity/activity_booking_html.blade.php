<div class="col-md-12 col-sm-12 col-xs-12">
	<div class="">
		<div class="row">
			<div class="col-md-12 col-sm-12 col-xs-12">
				<label class="mb-10 fw-600">Step: 2 </label> <span class="">Select Category</span>
				<select id="selcatpr" name="selcatpr" class="price-select-control" onchange="updatedetail('{{$companyId}}','{{$serviceId}}','category',this.value)">
					@foreach($categories as  $sc) 
                        <option value="{{$sc->id}}" @if($categoryId == $sc->id) selected @endif>{{$sc->category_title}}</option>
                    @endforeach
				</select>
			
				<label class="mb-10 fw-600">Step: 3 </label> <span class="">Select Price Option</span>
				<div class="priceoption" id="pricechng{{$serviceId}}{{$serviceId}}">
					<select id="selprice" name="selprice" class="price-select-control" onchange="updatedetail('{{$companyId}}','{{$serviceId}}','price',this.value)">
						{!!$priceOption!!}
					</select>
				</div>  
				
				<label class="mb-10 fw-600">Step: 4 </label> <span class=""> Select Time</span>
				<div class="row" id="timeschedule">
					@forelse (@$bschedule as $s=>$bdata)
	            		<?php 
	            			$SpotsLeftdis = 0; 
	                        $SpotsLeft = App\UserBookingDetail::where('act_schedule_id',$bdata['id'])->whereDate('bookedtime', '=',date('Y-m-d',strtotime($activityDate)))->get();
	                        $totalquantity = 0;
							foreach($SpotsLeft as $data1){
								$totalquantity += $data1->userBookingDetailQty();
							}
							$SpotsLeftdis = $bdata['spots_available'] != '' ? $bdata['spots_available'] - $totalquantity : 0;
							$shift_start = $bdata['shift_start'];
							$converted_date = date('Y-m-d',strtotime($activityDate));
							$st_time = date('Y-m-d H:i:s', strtotime("$converted_date $shift_start"));

							$timePassedChk = date('Y-m-d',strtotime($activityDate)) == date('Y-m-d') && $st_time <  date('Y-m-d H:i:s') ? 1 : 0;

							$timePassedChk = $SpotsLeftdis == 0 ? 2 : $timePassedChk;
	            		?>
						<div class="col-md-6 col-sm-4 col-xs-4">
                        	<div class="donate-now">
								<input type="radio" id="{{$bdata->id}}" name="amount" class="checkbox-option" value="{{$bdata->shift_start}}"  @if($timePassedChk != 2) onclick="addhiddentime({{$bdata->id}},'{{$serviceId}}',{{$timePassedChk}});" @else disabled  @endif @if($scheduleId == $bdata->id && $timePassedChk != 2) checked  @endif >
								<label for="{{$bdata->id}}" @if($timePassedChk != 0) class="btn-grey" @endif>{{date('h:i a', strtotime($bdata->shift_start))}}</label>
								<p class="end-hr text-center"> @if($SpotsLeftdis == 0)  Sold Out @else {{$SpotsLeftdis}}/{{$bdata->spots_available}} Spots Left.  @endif </p>
                        	</div>
                        </div>
                    @empty
						<p class="notimeoption">No time option available. Select category to view available times</p>
					@endforelse
				</div>
			
				<label class="mb-10 fw-600">Step: 5 </label> <span class=""> Select # of participants</span>
				<div class="participant-accordion">
					<div class="content1">
						<div class="panel-group" id="accordion">
							<div class="panel panel-default">
								<div class="panel-heading">
									<h4 class="panel-title">
										<a data-toggle="collapse" data-parent="#accordion" href="#collapseOne">Participant</a>
									</h4>
								</div>
								<div id="collapseOne" class="panel-collapse collapse">
									<div class="panel-body">
										<div class="row">
											<div class="col-md-12">
												<div class="participant-selection btn-group">
													<div class="row">
														<div class="col-md-12 col-xs-12">
															@if(($adultPrice != '' || $adultPrice != 0  || $infantPrice != '' || $infantPrice != 0 || $childPrice != '' || $childPrice != 0)  && $timeChk !== 0 )
																@if($adultPrice != '' || $adultPrice != 0 )
																	<div class="select">
																		<label class="btn button_select">Adults (Ages 13 & Up) </label>
																		<div class="qtyButtons">
																			<div class="qty count-members mt-5">
																				<span class="minus bg-darkbtn adultminus"><i class="fa fa-minus"></i></span>
																				<input type="text" class="count" name="adultcnt" id="adultcnt" min="0" value="0" readonly="">
																				<span class="plus bg-darkbtn adultplus"><i class="fa fa-plus"></i></span>
																			</div>   
																		</div>
																	</div>
																@endif
															  	
															  	@if($childPrice != '' || $childPrice != 0 )
																	<div class="select">
																		 <label class="btn button_select" for="item_2">Children (Ages 2-12)</label>
																		 <div class="qtyButtons">
																			<div class="qty count-members mt-5">
																				<span class="minus bg-darkbtn childminus"><i class="fa fa-minus"></i></span>
																				<input type="text" class="count" name="childcnt" id="childcnt" min="0" value="0" readonly="">
																				<span class="plus bg-darkbtn childplus"><i class="fa fa-plus"></i></span>
																			</div>
																		 </div>
																	</div>
																@endif

															  	@if($infantPrice != '' || $infantPrice != 0 )
																	<div class="select">
																		  <label class="btn button_select" for="item_3">Infants (Under 2)</label>
																		  <div class="qtyButtons">
																				<div class="qty count-members mt-5">
																					<span class="minus bg-darkbtn infantminus"><i class="fa fa-minus"></i></span>
																					<input type="text" class="count" name="infantcnt" id="infantcnt" value="0" min="0" readonly="">
																					<span class="plus bg-darkbtn infantplus"><i class="fa fa-plus"></i></span>
																				</div>
																		  </div>
																	</div>
																@endif
														  	@else
														  		<p>No Participate Available</p>
														  	@endif
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				
				<label class="mb-10 fw-600">Step: 6 </label> <span class=""> Select Who's Participating</span>

				<div class="row" id="participantDiv">

					
				</div>
																																	

				<label class="mb-10 fw-600">Step: 7 </label> <span class=""> Select Add-On Service (Optional)</span>
				<div class="participant-accordion">
					<div class="content1">
						<div class="panel-group" id="accordiontwo">
							<div class="panel panel-default">
								<div class="panel-heading">
									<h4 class="panel-title">
									   	<a data-toggle="collapse" data-parent="#accordiontwo" href="#collapseTwo">Add-On Services</a>
									</h4>
								</div>
								<div id="collapseTwo" class="panel-collapse collapse">
									<div class="panel-body">
										<div class="row">
											<div class="col-md-12">
												<div class="add-onservice btn-group">
													<div class="row">
														<div class="col-md-12 col-xs-12">
															@forelse($addOnServices as $aos)
																<div class="select">
																	<label class="btn button_select" for="item_4">
																		<div class="row">
																			<div class="col-md-6">
																				{{ $aos->service_name}}
																				<a class="single-service-price d-grid font-red service-desc" data-behavior="ajax_html_modal" data-url="{{route('getAddOnData',['id' => $aos->id])}}">Description</a>
																			</div>
																			<div class="col-md-6">
																				<span class="single-service-price">${{ $aos->service_price}}</span>
																			</div>
																		</div>
																	</label>
																	<div class="qtyButtons">
																		<div class="qty count-members mt-5">
																			<span class="minus bg-darkbtn addonminus" aid="{{$aos->id}}" ><i class="fa fa-minus"></i></span>
																			<input type="text" class="count" name="add-one" id="add-one{{$aos->id}}" min="0" value="0" readonly="" apirce="{{$aos->service_price}}">
																			<span class="plus bg-darkbtn addonplus" aid="{{$aos->id}}"><i class="fa fa-plus"></i></span>
																		</div>   
																	</div>
																</div>
															@empty
																<p>Not Available</p>
															@endforelse
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="">
	<div class="col-md-6 col-sm-6 col-xs-12">
		<div class="booking-summery">
			<a href="#"  onclick="getUrl({{$priceId}} , {{@$bschedulefirst->id}});" class="font-red">Booking Summary </a>
			<div class="d-none hiddenALink"></div>
		</div>
	</div>
	<div class="col-md-6 col-sm-6 col-xs-12">
		<div class="book0total-price">	
			<label>Total Price </label>
		</div>
		<div class="book0total-price text-center">	
			<span id="textPrice">$0 USD</span>
		</div>
	</div>
	<div class="col-md-12 col-sm-12 col-xs-12">
		<div class="text-right mt-10">
			<div id="cartadd">
				<input type="hidden"  id="maxQty" value="{{$maxSports}}">
				<input type="hidden"  id="totalQty" value="0">
				<input type="hidden" id="adultDiscountPrice" value="{{$adultDiscountPrice}}" />
                <input type="hidden" id="childDiscountPrice" value="{{$childDiscountPrice}}" />
                <input type="hidden" id="infantDiscountPrice" value="{{$infantDiscountPrice}}" />
				<form method="post" id="addtocartform">
					@csrf
					<input type="hidden" name="pid" value="{{$serviceId}}"  />
                    <input type="hidden" name="quantity" id="pricequantity" value="1" />
                    <input type="hidden" name="aduquantity" id="adultCount" value="0" />
                    <input type="hidden" name="childquantity" id="childCount" value="0" />
                    <input type="hidden" name="infantquantity" id="infantCount" value="0" />

                    <input type="hidden" name="cartaduprice" id="adultPrice" value="{{$adultPrice}}" />
                    <input type="hidden" name="cartchildprice" id="childPrice" value="{{$childPrice}}" />
                    <input type="hidden" name="cartinfantprice" id="infantPrice" value="{{$infantPrice}}" />

                   	<input type="hidden" name="pricetotal" id="priceTotal" value="0" />
                   	<input type="hidden" name="price" id="price" value="0"/>
                    <input type="hidden" name="session" id="session" value="{{$paySession}}" />
                    <input type="hidden" name="priceid" value="{{$priceId}}" id="priceid" />
                    <input type="hidden" name="actscheduleid" value="{{$scheduleId}}" id="actscheduleid" /> 
                    <input type="hidden" name="timechk" value="{{$timeChk }}" id="timechk" />
                    <input type="hidden" name="sesdate" value="{{date('Y-m-d',strtotime($activityDate))}}" id="sesdate" />
                    <input type="hidden" name="cate_title" id="cate_title"  value="{{$categoryId}}" id="categoryTitle" />
                    <input type="hidden" name="addOnServicesId" value="" id="addOnServicesId" />
                    <input type="hidden" name="addOnServicesQty" value="" id="addOnServicesQty" />
                    <input type="hidden" name="addOnServicesTotalPrice" value="0" id="addOnServicesTotalPrice" />
                    <input type="hidden" name="totalcnt" value="0" id="totalcnt" />
                    <input type="hidden" name="totparticipate" value="" id="totparticipate" />

					<div id="addcartdiv">
						<button type="button" id="btnaddcart" class="btn btn-red"> Add to Cart</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript">
	function getUrl(pid , sid){
		$('.hiddenALink').html('');
		var adultCount = $('#adultCount').val();
		var childCount = $('#childCount').val();
		var infantCount = $('#infantCount').val();

		var aosId = $('#addOnServicesId').val();
		var aosQty = $('#addOnServicesQty').val();
		var aosPrice = $('#addOnServicesTotalPrice').val();

		if(sid != undefined){
			var url= "/getBookingSummary/?priceId="+pid+"&schedule="+sid+"&adultCount="+adultCount+"&childCount="+childCount+"&infantCount="+infantCount+"&date="+"{{$date->format('Y-m-d')}}"+"&aosPrice="+aosPrice+"&aosId="+aosId+"&aosQty="+aosQty;
			$('.hiddenALink').html('<a data-behavior="ajax_html_modal" data-url="'+url+'" id="hiddenALink"></a>');
			$('#hiddenALink')[0].click();
		}
	}

</script>