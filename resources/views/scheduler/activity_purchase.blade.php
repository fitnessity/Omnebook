@extends('layouts.header')
@section('content')
@include('layouts.userHeader')



<div class="p-0 col-md-12 inner_top padding-0">
    <div class="row">
        <div class="col-md-2 col-sm-12" style="background: black;">
        	 @include('business.businessSidebar')
        </div>
		<div class="col-md-10 col-sm-12">
            <div class="container-fluid p-0">
				<div class="row">
					<div class="col-md-6 col-xs-12 col-sm-12">
						<div class="tab-hed scheduler-txt"><span>Check Out Register </span> </div>
					</div>
				</div>
				<hr style="border: 3px solid black; width: 127%; margin-left: -38px; margin-top: 5px;">
				<div class="row">
					<div class="col-md-6">
						<div class="manage-search search-checkout">
							<form>
								<input type="text" name="serchclient" id="serchclient" placeholder="Search for previous client who is making a purchase?" autocomplete="off" value="">
								<div id="option-box1" style="display: none;"></div>
								<button><i class="fa fa-search"></i></button>
							</form>
						</div>
						<button type="button" class="btn-nxt btn-search-checkout" id="">Add New Client </button>
						<button type="button" class="btn-bck btn-search-checkout" id=""> Quick Sale </button>
						<div class="check-client-info">
							<label>Client Name: </label><span>Darryl Phipps (39 yrs Old)  |  New York, NY United States</span>
							<label>Previous Visits: </label><span>20</span> |
							<label>Last Membership: </label><span>3 Month Kickboxing (20 pack)</span>
							<label>Status: </label><span>Completed</span> | <label>Current Membership: </label><span>None</span>
						</div>
						<div class="check-client-info">
							<div class="row">
								<div class="col-md-4">
									<label>Catagory</label>
									<select name="cars" id="" class="form-control">
										<option value="1">Select Option</option>
										<option value="2">2</option>
										<option value="3">3</option>
										<option value="4">4</option>
									</select>
								</div>
								<div class="col-md-4">
									<label>Program Name </label>
									<select name="cars" id="" class="form-control">
										<option value="1">Select Option</option>
										<option value="2">2</option>
										<option value="3">3</option>
										<option value="4">4</option>
									</select>
								</div>
								<div class="col-md-4">
									<label> Membership Option  </label>
									<select name="cars" id="" class="form-control">
										<option value="1">Select Option</option>
										<option value="2">2</option>
										<option value="3">3</option>
										<option value="4">4</option>
									</select>
								</div>
							</div>							
						</div>
						<div class="row">
							<div class="col-md-4">
								<label>Price</label>
								<input type="text" class="form-control valid" name="" id="" placeholder="$1200.00">
							</div>
							<div class="col-md-8">
								<label>Tip</label>
								<div>
									<label class="color-grey"> Choose $ or %  </label>
									<select name="cars" id="" class="form-control">
										<option value="1">Select</option>
										<option value="2">2</option>
										<option value="3">3</option>
										<option value="4">4</option>
									</select>
									<label class="color-grey">Amount</label>
									<input type="text" class="form-control valid" name="" id="" placeholder="$1200.00">
								</div>
							</div>
						</div>
					</div>
					<div class="col-md-6">
						
					</div>
				</div>
			</div>
		</div>
	</div>
</div>








@include('layouts.footer')

@endsection