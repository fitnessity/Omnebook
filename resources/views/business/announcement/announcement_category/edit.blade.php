<h5 class="modal-title text-center" id="staticBackdropLabel">Edit Category</h5>
<form action="{{route('business.announcement-category.update',['business_id' => $business_id,'announcement_category'=>$c->id])}}"  class="needs-validation" method="post">
	@method('PATCH')
	@csrf
	<input type="hidden" name="id" value="{{$c->id}}">
	<div class="row y-middle">
		<div class="col-lg-12 col-sm-12 col-md-12">
			<div class="mb-3">
				<label class="form-label">Category Name</label>
				<input type="text"  name="name" class="form-control" required="" value="{{$c->name}}">
			</div>
		</div>
		<div class="col-lg-12 col-sm-12 col-md-12 text-center">
			<button type="submit" class="btn btn-red">Cubmit</button>
		</div>
	</div>
</form>