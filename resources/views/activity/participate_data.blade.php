<div class="col-md-12 col-sm-12 mb-12 {{$type}}" >
	<div class="text-left mt-40 mmt-10">
		<h6 class="mb-3 mt-3 fs-13">Who's Participating</h6>
	</div>
	<div class="hstack gap-3 px-3 mx-n3">
		<select class="price-select-control fs-13 familypart" name="participat[]" id="participats">
			<option value="" data-cnt="0" data-priceid="" >Choose or Add Participant</option>
			<option value="{{Auth::user()->id}}" data-cnt="0" data-priceid="{{$priceid}}" data-type="user" >{{Auth::user()->full_name}}</option>
			@foreach($family as $fa)
        		<option value="{{$fa['id']}}"  data-name="{{$fa['full_name']}}" data-cnt="0" data-priceid="{{$priceid}}" data-age="" data-type="{{$fa['type']}}">
                {{$fa['full_name']}}</option>
        	@endforeach
		</select>
	</div>
</div>
