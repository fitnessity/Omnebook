<div class="participant-selection btn-group">
	<div class="row">
		<div class="col-md-12 col-xs-12">
			@forelse(@$addOnServices as $aos)
				<div class="select">
					<label class="btn button_select">
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
						<div class="qty count-members ">
							<span class="minus bg-darkbtn addonminus" aid="{{$aos->id}}" chk="{{$ajax}}"><i class="fa fa-minus"></i></span>
							<input type="text" class="count" name="add-one" id="add-one{{$aos->id}}" min="0" value="{{ in_array($aos->id, $idsArray) ? @$qtysArray[array_search($aos->id, $idsArray)] : 0 }}" readonly="" apirce="{{$aos->service_price}}">
							<span class="plus bg-darkbtn addonplus" aid="{{$aos->id}}" chk="{{$ajax}}"><i class="fa fa-plus"></i></span>
						</div>   
					</div>
				</div>
		  	@empty
				<p>Not Available</p>
			@endforelse
		</div>
	</div>
</div>