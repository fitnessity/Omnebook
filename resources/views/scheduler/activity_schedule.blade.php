@extends('layouts.header')
@section('content')
@include('layouts.userHeader')

<div class="container-fluid p-0 inner-top-activity">
	<div class="row">
		<div class="col-md-7 col-md-offset-3-custom">
			<div class="valor-mix-title">
				<h2>Valor Mixed Martial Arts</h2>
				<p>Booking Schedule</p>
			</div>
			<div class="member-txt">
				<p>If you already have a memerbship with multiple sessions. Reserve your spot here. If you don’t already have a membership, <a>Book Here </a></p>
			</div>
			<div>
				<button type="button" class="btn-nxt manage-search">SELECT AN OPTION </button>
			</div>
			<div class="activity-schedule-tabs">
				<ul class="nav nav-tabs" role="tablist">
					<li class="active">
						<a class="nav-link" data-toggle="tab" href="#tabs-1" role="tab" aria-expanded="true">CLASSES </a>
					</li>
                    <li class="">
                        <a class="nav-link" data-toggle="tab" href="#tabs-2" role="tab" aria-expanded="false">PRIVATE LESSONS</a>
					</li>
                    <li class="">
						<a class="nav-link" data-toggle="tab" href="#tabs-3" role="tab" aria-expanded="false">EVENTS</a>
					</li>
                    <li class="">
                         <a class="nav-link" data-toggle="tab" href="#tabs-4" role="tab" aria-expanded="false">EXPERIENCES</a>
					</li>
				</ul>
				<div class="tab-content">
					<div class="tab-pane active" id="tabs-1" role="tabpanel">
						<div class="row">
							@foreach ($days as $date)
								@php
									$hint_class = ($filter_date->format('Y-m-d') == $date->format('Y-m-d')) ? 'pairets' : 'pairets-inviable';
								@endphp
							
								<div class="col-md-2 col-sm-2 col-xs-6">


									<div class="{{$hint_class}}">
										<!-- <div class="pairets-inviable"> -->
										<a href="" class="calendar-btn">{{$date->format("D d")}}</a>
									</div>
								</div>
							@endforeach
							<!-- <div class="col-md-12 col-xs-12">
								<div class="weeks-name">
									<ul>
										<li><a>SUN 4</a></li>
										<li><a>MON 5</a></li>
										<li><a>TUE 6</a></li>
										<li><a>WED 7</a></li>
										<li><a>THU 8</a></li>
										<li><a class="disable">FRI 9</a></li>
										<li><a>SAT 10</a></li>
									</ul>
								</div>
							</div> -->

						</div>
						<div class="tab-data">
							<div class="row">
								<div class="col-md-3 col-sm-4 col-xs-12">
									<div class="checkout-sapre-tor">
									</div>
								</div>
								<div class="col-md-6 col-sm-4 col-xs-12 valor-mix-title">
									<label>Classes on {{$filter_date->format("l, F j")}}</label>
								</div>
								<div class="col-md-3 col-sm-4 col-xs-12">
									<div class="checkout-sapre-tor">
									</div>
								</div>
							</div>
							
							<div class="row">
								<div class="col-md-6 col-sm-6 col-xs-12">
									<div class="classes-info">
										<div class="row">
											<div class="col-md-12 col-xs-12">
												<h2>Martial Arts - MMA</h2>
												<label>Program Name: </label><span> Valor Kids Martial Arts Classes</span>
											</div>
											<div class="col-md-12 col-xs-12">
												<label>Category Name: </label><span> Mini Ninjas (Ages 3 to 4 yrs old)</span>
											</div>
											<div class="col-md-12 col-xs-12">
												<label>Duration: </label><span> 30 Min</span>
											</div>
											<div class="col-md-12 col-xs-12">
												<label>Instructor: </label><span> Darryl Phipps</span>
											</div>
										</div>
									</div>
								</div>
								<div class="col-md-6 col-sm-6 col-xs-12 nopadding">
									<div class="row">
										<div class="col-md-4 col-xs-12">
											<div class="classes-time">
												<button class="post-btn activity-scheduler" type="button">9:00 am</button>
												<label>10/20 Spots Left</label>	
											</div>
										</div>
									</div>
								</div>
								<div class="col-md-12 col-xs-12">
									<div class="checkout-sapre-tor">
									</div>
								</div>
							</div>
							
							<div class="row">
								<div class="col-md-6 col-sm-6 col-xs-12">
									<div class="classes-info">
										<div class="row">
											<div class="col-md-12 col-xs-12">
												<h2>Martial Arts - MMA</h2>
												<label>Program Name: </label><span> Valor Kids Martial Arts Classes</span>
											</div>
											<div class="col-md-12 col-xs-12">
												<label>Category Name: </label><span> Little Ninjas (Ages 5 to 7 yrs old)</span>
											</div>
											<div class="col-md-12 col-xs-12">
												<label>Duration: </label><span> 30 Min</span>
											</div>
											<div class="col-md-12 col-xs-12">
												<label>Instructor: </label><span> Darryl Phipps</span>
											</div>
										</div>
									</div>
								</div>
								<div class="col-md-6 col-sm-6 col-xs-12 nopadding">
									<div class="row">
										<div class="col-md-4 col-xs-12">
											<div class="classes-time">
												<button class="post-btn activity-scheduler" type="button">9:30 am</button>
												<label>10/20 Spots Left</label>	
											</div>
										</div>
									</div>
								</div>
								<div class="col-md-12 col-xs-12">
									<div class="checkout-sapre-tor">
									</div>
								</div>
							</div>
							
							<div class="row">
								<div class="col-md-6 col-sm-6 col-xs-12">
									<div class="classes-info">
										<div class="row">
											<div class="col-md-12 col-xs-12">
												<h2>Martial Arts - MMA</h2>
												<label>Program Name: </label><span> Valor Kids Martial Arts Classes</span>
											</div>
											<div class="col-md-12 col-xs-12">
												<label>Category Name: </label><span> Begiiners (Ages 7 & Up)</span>
											</div>
											<div class="col-md-12 col-xs-12">
												<label>Duration: </label><span> 45 Min</span>
											</div>
											<div class="col-md-12 col-xs-12">
												<label>Instructor: </label><span> Darryl Phipps</span>
											</div>
										</div>
									</div>
								</div>
								<div class="col-md-6 col-sm-6 col-xs-12 nopadding">
									<div class="row">
										<div class="col-md-4 col-xs-12">
											<div class="classes-time">
												<button class="post-btn activity-scheduler" type="button">10:00 am</button>
												<label>10/20 Spots Left</label>	
											</div>
										</div>
									</div>
								</div>
								<div class="col-md-12 col-xs-12">
									<div class="checkout-sapre-tor">
									</div>
								</div>
							</div>
							
							<div class="row">
								<div class="col-md-6 col-sm-6 col-xs-12">
									<div class="classes-info">
										<div class="row">
											<div class="col-md-12 col-xs-12">
												<h2>Martial Arts - MMA</h2>
												<label>Program Name: </label><span> Valor Kids Martial Arts Classes</span>
											</div>
											<div class="col-md-12 col-xs-12">
												<label>Category Name: </label><span> Int./Adv. </span>
											</div>
											<div class="col-md-12 col-xs-12">
												<label>Duration: </label><span> 45 Min</span>
											</div>
											<div class="col-md-12 col-xs-12">
												<label>Instructor: </label><span> Darryl Phipps</span>
											</div>
										</div>
									</div>
								</div>
								<div class="col-md-6 col-sm-6 col-xs-12 nopadding">
									<div class="row">
										<div class="col-md-4 col-xs-12">
											<div class="classes-time">
												<button class="post-btn activity-scheduler" type="button">10:45 am</button>
												<label>10/20 Spots Left</label>	
											</div>
										</div>
									</div>
								</div>
								<div class="col-md-12 col-xs-12">
									<div class="checkout-sapre-tor">
									</div>
								</div>
							</div>
							
							<div class="row">
								<div class="col-md-6 col-sm-6 col-xs-12">
									<div class="classes-info">
										<div class="row">
											<div class="col-md-12 col-xs-12">
												<h2>Martial Arts - MMA</h2>
												<label>Program Name: </label><span> Adult Kickboxing </span>
											</div>
											<div class="col-md-12 col-xs-12">
												<label>Category Name: </label><span> Kickboxing Mixed Levels </span>
											</div>
											<div class="col-md-12 col-xs-12">
												<label>Duration: </label><span> 45 Min</span>
											</div>
											<div class="col-md-12 col-xs-12">
												<label>Instructor: </label><span> Darryl Phipps</span>
											</div>
										</div>
									</div>
								</div>
								<div class="col-md-6 col-sm-6 col-xs-12 nopadding">
									<div class="row">
										<div class="col-md-4 col-sm-4 col-xs-4">
											<div class="classes-time">
												<button class="post-btn activity-scheduler" type="button">9:00 am</button>
												<label>10/20 Spots Left</label>	
											</div>
										</div>
										<div class="col-md-4 col-sm-4 col-xs-4">
											<div class="classes-time">
												<button class="post-btn activity-scheduler" type="button">11:00 am</button>
												<label>10/20 Spots Left</label>	
											</div>
										</div>
										<div class="col-md-4 col-sm-4 col-xs-4">
											<div class="classes-time">
												<button class="post-btn activity-scheduler" type="button">6:15 pm</button>
												<label>10/20 Spots Left</label>	
											</div>
										</div>
									</div>
								</div>
							</div>
							
						</div>
					</div>
					<div class="tab-pane" id="tabs-2" role="tabpanel">
						<div class="tab-data">
							<p> ... </p>
						</div>
					</div>
                    <div class="tab-pane" id="tabs-3" role="tabpanel">
						<div class="tab-data">
							<p> ... </p>
						</div>
					</div>
					<div class="tab-pane" id="tabs-4" role="tabpanel">
						<div class="tab-data">
                           <p> ... </p>                                                             
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<script>
   $( '.activity-schedule-tabs .nav-tabs a' ).on('click',
   function () {
     $( '.activity-schedule-tabs .nav-tabs' ).find( 'li.active' )
         .removeClass( 'active' );
         $( this ).parent( 'li' ).addClass( 'active' );
      });
</script>
@include('layouts.footer')

@endsection