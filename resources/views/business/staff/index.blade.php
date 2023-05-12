@extends('layouts.header')
@section('content')
@include('layouts.userHeader')

<div class="p-0 col-md-12 inner_top nopadding">
    <div class="row">
        <div class="col-md-2" style="background: black;">
        	 @include('business.businessSidebar')
        </div>
		<div class="col-md-10">
            <div class="container-fluid p-0">
                <div class="tab-hed">Manage Staff</div>
                <hr style="border: 15px solid black;width: 104%;margin-left: -38px;">
            </div>
			<div class="row">
				<div class="col-md-2">
					<div class="staff-main">
						<a  class="btn-grey" href="#" data-behavior="ajax_html_modal" data-url="{{route('business.staff.create')}}"  data-modal-width="1150px"> Add Staff</a>
					</div>
				</div>
				<div class="col-md-5">
					<div class="staff-main top-nav search-staff">
						<input type="text" placeholder="Search Staff Name">
					</div>
				</div>
				<div class="col-md-2">
					<div class="staff-main">
						<button type="button" class="button-fitness search-staff fix-width">Search</button>
					</div>
				</div>
			</div>
			<div class="table-staff table-responsive">
				<table id="example" class="table table-striped table-bordered" style="width:100%">
					<thead>
						<tr>
							<th>Name</th>
							<th>Phone</th>
							<th>Email</th>
							<th>Position</th>
							<th>Activities Scheduled</th>
							<th></th>
						</tr>
					</thead>
					<tbody>
						@foreach($companyStaff as $cf)
						<tr>
							<td>{{$cf->last_name}} {{$cf->first_name}}</td>
							<td>{{$cf->phone}}</td>
							<td>{{$cf->email}}</td>
							<td>{{$cf->position}}</td>
							<td>0</td>
							<td>
								<div class="table-icons-staff">
									<a href="{{route('business.staff.show',['business_id'=>$cf->business_id ,'staff' =>$cf->id])}}" title="Staff Scheduled Activities"><i class="fa fa-table"></i></a>
									<a title="Edit" ><i class="fa fa-pencil-square-o"></i></a>
									<i class="fa fa-trash" aria-hidden="true" title="Delete"></i>	
								</div>
							</td>
						</tr>
						@endforeach
						<!-- <tr>
							<td>Purvi Patel</td>
							<td>558-456-2309</td>
							<td>Purvi@gmail.com</td>
							<td>Instructor</td>
							<td>5</td>
							<td>
								<div class="table-icons-staff">
									<a href="{{route('staff-scheduled-activities')}}" title="Staff Scheduled Activities"><i class="fa fa-table"></i></a>
									<a title="Edit" ><i class="fa fa-pencil-square-o"></i></a>
									<i class="fa fa-trash" aria-hidden="true" title="Delete"></i>	
								</div>
							</td>
						</tr>
						
						<tr>
							<td>Mathilda M. Jackson</td>
							<td>558-456-2309</td>
							<td>mathilda@gmail.com</td>
							<td>Instructor</td>
							<td>5</td>
							<td>
								<div class="table-icons-staff">
									<a href="{{route('staff-scheduled-activities')}}" title="Staff Scheduled Activities"><i class="fa fa-table"></i></a>
									<a title="Edit" ><i class="fa fa-pencil-square-o"></i></a>
									<i class="fa fa-trash" aria-hidden="true" title="Delete"></i>	
								</div>
							</td>
						</tr>
						
						<tr>
							<td>John S. Saucedo</td>
							<td>558-456-2309</td>
							<td>john@gmail.com</td>
							<td>Instructor</td>
							<td>5</td>
							<td>
								<div class="table-icons-staff">
									<a href="{{route('staff-scheduled-activities')}}" title="Staff Scheduled Activities"><i class="fa fa-table"></i></a>
									<a title="Edit" ><i class="fa fa-pencil-square-o"></i></a>
									<i class="fa fa-trash" aria-hidden="true" title="Delete"></i>	
								</div>
							</td>
						</tr> -->
						
					</tbody>
				</table>
			</div>
		</div>
	</div>							
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
@include('layouts.footer')

<script>
	$(document).ready(function() {
		$('#example').DataTable();
	} );	
	
	$('#example').dataTable( {
		"searching": false,
		"paging": false
	} );
</script>
<script>
	$(document).ready(function() {
		$('#scheduled-activities').DataTable();
	} );	
	
	$('#scheduled-activities').dataTable( {
		"searching": false
	} );
</script>

@endsection
