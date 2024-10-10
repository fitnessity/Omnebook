<div class="col-md-12 col-sm-12 mb-12 {{$type}}" >
	<div class="text-left">
		<h6 class=" mt-5 fs-13">Who's Participating</h6>
	</div>
	<div class="hstack gap-3 px-3 mx-n3">
		<select class="price-select-control fs-13 familypart form-control" name="participat[]" id="participats">
			<option value="" data-cnt="0" data-priceid="" >Choose or Add Participant</option>
			@if($customer)
				<option value="{{$customer->id}}" data-cnt="0" data-priceid="{{$priceid}}" data-type="customer" >{{$customer->full_name}}</option>
			@else
				<option value="{{Auth::user()->id}}" data-cnt="0" data-priceid="{{$priceid}}" data-type="user" >{{Auth::user()->full_name}}</option>
			@endif

			@foreach($family as $fa)
        		<option value="{{$fa['id']}}" data-name="{{$fa['full_name']}}" data-cnt="0" data-priceid="{{$priceid}}" data-age="" data-type="{{$fa['type']}}">
                {{$fa['full_name']}}</option>
        	@endforeach
		
			{{-- <option value="addparticipate">+ Add New Participant</option> --}}
		</select>
	</div>
</div>


<script>
	$('.familypart').change(function() {
		var $this = $(this);
		var selectedOption = $this.children("option:selected");
		var value = selectedOption.val();
		if(value == 'addparticipate'){
			$('.newparticipant').modal('show');
		}
		else{
			var data = {
				  _token: $('meta[name="csrf-token"]').attr('content'),
				  act: selectedOption.data('priceid'),
				  familyid: value,
				  counter: selectedOption.data('cnt'),
				  type: selectedOption.data('type')
			};
			console.log(data);
		$.post('{{ route("form_participate") }}', data).done(function() {
			$(".participaingdiv" + data.act).load(" .participaingdiv" + data.act + ">*");
			});
		}
	});
</script>