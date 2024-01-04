@inject('request', 'Illuminate\Http\Request')
@extends('layouts.business.header')

@section('content')
@include('layouts.profile.business_topbar')
	
	<div class="main-content">
		<div class="page-content">
			<div class="container-fluid">
				<div class="row mb-3">
					<div class="col-12">
						<div class="page-heading"><label>Announcement & News</label></div>
					</div>
				</div><!--end row-->
				<div class="row">
					<div class="col-xl-12">
						<div class="card">
							<div class="row">
								<div class="col-lg-12">
									<div class="position-relative ">
										<div class="header-img-announcement">
											<img src="{{url('/dashboard-design/images/announcement.jpg')}}" alt="" class="" />
										</div>
										<div class="announcement-text-format">
											<div class="announcement-banner">
												<label>Announcements</label>
											</div>
											<div class="top-area-announcement">
												<div class="top-search-announcement">
													<form method="get" action="/">
														<input type="text" id="announcement-search" placeholder="Search articles" autocomplete="off" value="">
															<button type="button" id="serchbtn" onclick="getAnnouncement()"><i class="fa fa-search"></i></button>
													</form>
												</div>
											</div>
										</div>
									</div>
								</div>
								<div class="col-lg-12">
									<div class="">
										<div class="card-body">
											<div class="row">
												<div class="col-lg-3 col-md-3 col-12">
													<div class="text-right">
														<input type="text" class="form-control flatpickr" placeholder="Select date" id="announcement-date" value="{{request()->date}}" />
													</div>
												</div>
											</div>
											<!-- Nav tabs -->
											<ul class="nav nav-tabs mb-3 mt-3" role="tablist">
												<li class="nav-item">
													<a class="nav-link @if(!request()->category) active @endif" onclick="changeCategory('all',)" >All</a>
												</li>
												@forelse($categories as $c)
													<li class="nav-item">
														<a class="nav-link @if(request()->category == $c->id) active @endif" onclick="changeCategory({{$c->id}})" >{{$c->name}}</a>
													</li>
												@empty
												@endforelse

											</ul>
											<!-- Tab panes -->
											<div class="tab-content text-muted">
												<div class="tab-pane active" id="All" role="tabpanel">
													@include('personal.announcement_news.announcement-content',['announcement' => $announcement])
												</div>
											</div>
										</div><!-- end card-body -->
									</div><!-- end card -->
								</div>
							</div>
						</div>
					</div>
				</div>
			</div><!-- container-fluid -->
		</div>
	</div><!-- end main content-->
</div><!-- END layout-wrapper -->
	
	
@include('layouts.business.footer')

<script> 

	flatpickr(".flatpickr", {
		altInput: true,
		altFormat: "m/d/Y",
		dateFormat: "Y-m-d",
		onChange: function(selectedDates, dateStr, instance) {
	        changeCategory('{{request()->category}}');
	    }
	});		

	function changeCategory(id) {
		var baseUrl  = window.location.href;
	    baseUrl = baseUrl.replace(/(\?|&)category=[^&]*(&|$)/g, '$2');
	    baseUrl = baseUrl.replace(/(\?|&)date=[^&]*(&|$)/g, '$2');
		var date = $('#announcement-date').val();
		if(date){
			baseUrl += (baseUrl.includes('?') ? '&' : '?') + "date=" + date;
		}
	    if (id !== 'all' && id != '') {
	        // Append the new category parameter
	        baseUrl += (baseUrl.includes('?') ? '&' : '?') + "category=" + id;
	    }
        window.location.href = baseUrl;
	}

	function getAnnouncement(){
		var search = $('#announcement-search').val();
		var date = $('#announcement-date').val();
		$.ajax({
			url:'{{route('personal.announcement_date_filter')}}',
			type:'post',
			data:{
				_token:'{{csrf_token()}}',
				category:'{{request()->category}}',
				business_id:'{{request()->business_id}}',
				search:search,
				date:date,
			},
			success: function(response){
				$('#All').html(response);
			},
		});
	}

	$('#announcement-search').on('input', function() {
		if ($(this).val() == '') {
        	getAnnouncement();
        }
    });

</script>
@endsection