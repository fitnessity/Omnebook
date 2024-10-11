<h5 class="modal-title text-center" id="staticBackdropLabel">Add Category</h5>
<form action="{{route('business.announcement-category.store')}}"  class="needs-validation" method="post">
	@csrf
	<div class="row y-middle">
		<div class="col-lg-12 col-sm-12 col-md-12">
			<div class="mb-3">
				<label class="form-label">Category Name</label>
				<input type="text"  name="name" class="form-control" required="">
			</div>
		</div>
		<div class="col-lg-12 col-sm-12 col-md-12 text-center">
			<button type="submit" class="btn btn-red">Add</button>
		</div>
	</div>
</form>