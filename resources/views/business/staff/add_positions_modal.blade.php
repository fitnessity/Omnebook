
<h5 class="modal-title mt-10" id="myModalLabel">Add Positions</h5>
<div class="row">
	<form action="{{route('business.staff.position_modal.store')}}" method="post">
		@csrf
		<input type="hidden" name="business_id" value="{{$business_id}}">
		<div class="col-lg-12 col-md-12">
			<div class="form-group mt-10">
				<label>Manage Positions</label>
				<input type="hidden" id="positionCount" value="0">
				<div class="positionBlock">
					<input type="text" class="form-control mb-10" name="positions[]" id="positions0" placeholder="Positions" required>
				</div>
				<div class="col-md-12">
					<div class="addanother">
						<a class="add_position"> + Add More</a>
					</div>  
				</div>
			</div>
		</div>	
		<div class="col-md-12 col-12">
			<button type="submit" class="btn-red-primary btn-red float-right">Submit</button>
		</div>
	</form>					
</div>
<div class="scheduler-table mt-10">
	<div class="table-responsive">
		<table class="table mb-0">
			<thead>
				<tr>
					<th>No</th>
					<th>Position Name</th>
					<th></th>
				</tr>
			</thead>
			<tbody id="positionstbody">
				@foreach($positions as $i=>$position)
				<tr>
					<td>{{$i+1}}</td>
					<td>{{$position->name}}</td>
					<td><div class="scheduled-btns"><a data-business_id="{{$position->business_id}}" data-id="{{$position->id}}" class="btn btn-red delposition">Delete</a></div></td>
				</tr>
				@endforeach
			</tbody>
		</table>
	</div>
</div>
<script>
	$(document).on('click', '.delposition', function(e){
		e.preventDefault();
		let text = "Are you sure to delete this Position?";
		if (confirm(text) == true) {
			var token = $("meta[name='csrf-token']").attr("content");
		   	$.ajax({
		      	url: '/business/'+$(this).attr('data-business_id')+'/position_modal/delete/'+$(this).attr('data-id'),
		      	type: 'POST',
		      	data: {
		          	"_token": token,
		      	},
		      	success: function (){
		      		location.reload();
		      	}
		   	});
		}
	});

	$('.add_position').click(function(e){
		var cnt = $('#positionCount').val();
		cnt++;
		$('#positionCount').val(cnt);
		$('.positionBlock').append('<input type="text" class="form-control mb-10" name="positions[]" id="positions'+cnt+'" placeholder="Positions" required>');
	});

</script>