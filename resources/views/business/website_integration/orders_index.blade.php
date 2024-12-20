@inject('request', 'Illuminate\Http\Request')
<style>
     @media screen and (min-width: 768px) and (max-width: 992px){
        .desktop-none-booking {
			display: none;
		}
    }
    @media screen and (min-width: 1000px) and (max-width: 2000px){
		.desktop-none-booking {
			display: none;
		}
	}
    #bookingModal .modal-dialog{
        max-width: 90%;
    }
</style>
    <meta name="csrf-token" content="{{ csrf_token() }}">
        <div class="container-fluid">
           <div class="row mb-3">
                <div class="col-12">
                    <div class="page-heading">
                        <h1>BOOKINGS INFO  - {{strtoupper($name)}}  </h1>
                    </div>
                </div>
            </div><!--end row-->
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-12 col-md-6 col-12">
                                    <div class="form-group mmt-10 desktop-none-booking">
                                        <select class="form-select" name="filterOption" id="filterOption" onchange="changeType(this)">
                                            <option value="all" @if(request()->serviceType == '' || request()->serviceType == 'all') selected @endif>All</option>
                                            <option value="individual" @if(request()->serviceType == 'individual') selected @endif>Personal Trainer </option>
                                            <option value="classes" @if(request()->serviceType == 'classes') selected @endif>Classes </option>
                                            <option value="events" @if(request()->serviceType == 'events') selected @endif>Events</option>
                                            <option value="experience" @if(request()->serviceType == 'experience') selected @endif>Experiences </option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-12 col-md-6 col-12">
                                    <div class="form-group mmt-10 desktop-none-booking">
                                        <select class="form-select" name="changeTab" id="changeTab" onchange="changeTab(this.value ,'mobile')">
                                            <option value="current">Active Memberships</option>
                                            <option value="today">Today </option>
                                            <option value="upcoming">Upcoming</option>
                                            <option value="past">Past</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="nav-custom-grey nav-custom mb-3">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="btn-group mobile-none">
                                            <button class="btn btn-booking-activity dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                Filter Options
                                            </button>
                                            <div class="dropdown-menu" style="">
                                                <!-- {{-- <a class="dropdown-item" href="{{route('personal.orders.index',array_merge(request()->query(), ['serviceType'=> null]))}}">All</a>
                                                <a class="dropdown-item" href="{{route('personal.orders.index',array_merge(request()->query(), ['serviceType'=>'individual']))}}">Personal Trainer </a>
                                                <a class="dropdown-item" href="{{route('personal.orders.index', array_merge(request()->query(), ['serviceType'=>'classes']))}}">Classes </a>
                                                <a class="dropdown-item" href="{{route('personal.orders.index',array_merge(request()->query(), ['serviceType'=>'events']))}}">Events </a>
                                                <a class="dropdown-item" href="{{route('personal.orders.index',array_merge(request()->query(), ['serviceType'=>'experience']))}}">Experiences </a> --}} -->

                                                <!-- <a class="dropdown-item" href="#" data-service-type="null">All</a>
                                                <a class="dropdown-item" href="#" data-service-type="individual">Personal Trainer</a>
                                                <a class="dropdown-item" href="#" data-service-type="classes">Classes</a>
                                                <a class="dropdown-item" href="#" data-service-type="events">Events</a>
                                                <a class="dropdown-item" href="#" data-service-type="experience">Experiences</a> -->


                                                <a class="dropdown-item ajax-link" href="#" data-servicetype="">All</a>
                                                <a class="dropdown-item ajax-link" href="#" data-servicetype="individual">Personal Trainer</a>
                                                <a class="dropdown-item ajax-link" href="#" data-servicetype="classes">Classes</a>
                                                <a class="dropdown-item ajax-link" href="#" data-servicetype="events">Events</a>
                                                <a class="dropdown-item ajax-link" href="#" data-servicetype="experience">Experiences</a>

                                            </div>
                                        </div>
                                    </div>
                                        
                                    <div class="col-lg-6">
                                        <!-- Nav tabs -->
                                        <ul class="nav nav-pills float-right mobile-none" role="tablist">
                                            <li class="nav-item">
                                                <a class="nav-link active" data-bs-toggle="tab" href="#nav-current" role="tab" onclick="changeTab('curernt','')">Active Memberships</a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" data-bs-toggle="tab" href="#nav-today" role="tab" onclick="changeTab('today','')">Today</a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" data-bs-toggle="tab" href="#nav-upcoming" role="tab" onclick="changeTab('upcoming','')">Upcoming</a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" data-bs-toggle="tab" href="#nav-past" role="tab" onclick="changeTab('past','')">Past</a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-content text-muted">
                                <input type="hidden" id="serchType" value="current">
                                <div class="row">
                                    <div class="col-lg-5 col-md-5 col-12">
                                        <label class="text-muted">
                                            Today Date: {{ date('l, F d, Y')}}
                                        </label>
                                    </div>
                                    <div class="col-lg-7 col-md-7 col-12">
                                        <div class="float-right mb-20">
                                            <div class="search-set mr-5">
                                                <div class="position-relative">
                                                    <input type="text" class="form-control" placeholder="Search By Activity" autocomplete="off" onkeyup="serchByActivty()" id="activityName">
                                                    <!--<span class="mdi mdi-magnify search-widget-icon"></span>-->
                                                </div>
                                            </div>
                                            
                                            {{-- <div class="multiple-options">
                                                <a class="setting-icon" data-bs-toggle="modal" data-bs-target=".accessControl" >
                                                    <i class="ri-more-fill"></i>
                                                </a>
                                            </div> --}}
                                        </div>
                                    </div>
                                    <div class="col-lg-12 col-12">
                                        <div class="active-member">
                                            <h3>Active Membership Available For Bookings</h3>
                                            <p>You can use an available membership below to reserve your spot in an activity</p>
                                        </div>
                                    </div>
                                </div>

                                <div class="tab-pane active" id="nav-current" role="tabpanel">
                                    <div class="">
                                        <div class="live-preview">
                                            <div class="accordion custom-accordionwithicon accordion-border-box tabdatacurrent" id="accordionnesting">
                                                @include('business.website_integration.user_booking_detail', ['orderDetails' =>$currentBooking,'tabName' => 'current'])
                                            </div>
                                        </div>
                                    </div><!-- end card-body -->
                                </div>
                                <div class="tab-pane" id="nav-today" role="tabpanel">
                                    <div class="">
                                        <div class="live-preview">
                                            @php  
                                                $todayBooking= [];
                                                $br = new \App\Repositories\BookingRepository;
                                                $BookingDetail = $br->tabFilterData($bookingDetails,'today',request()->serviceType ,date('Y-m-d'));
                                                foreach($BookingDetail as $i=>$book_details){
                                                    $todayBooking[@$book_details->business_services_with_trashed->id .'!~!'.@$book_details->business_services_with_trashed->program_name] [] = $book_details;
                                                }
                                            @endphp
                                            <div class="accordion custom-accordionwithicon accordion-border-box tabdatatoday" id="accordionnesting">
                                                @include('business.website_integration.user_booking_detail', ['orderDetails' => @$todayBooking, 'tabName' => 'today','customer'=>$customer])
                                            </div>
                                        </div>
                                    </div><!-- end card-body -->
                                </div>
                                <div class="tab-pane" id="nav-upcoming" role="tabpanel">
                                    <div class="">
                                        <div class="live-preview">
                                            @php
                                                $upcomimgBooking= [];
                                                $br = new \App\Repositories\BookingRepository;
                                                $BookingDetail = $br->tabFilterData($bookingDetails,'upcoming',request()->serviceType ,date('Y-m-d'));
                                                foreach($BookingDetail as $i=>$book_details){
                                                    $upcomimgBooking[@$book_details->business_services_with_trashed->id .'!~!'.@$book_details->business_services_with_trashed->program_name] [] = $book_details;
                                                }
                                            @endphp
                                            <div class="accordion custom-accordionwithicon accordion-border-box tabdataupcoming" id="accordionnesting">
                                                @include('business.website_integration.user_booking_detail', ['orderDetails' => @$upcomimgBooking, 'tabName' => 'upcoming','customer'=>$customer])
                                            </div>
                                        </div>
                                    </div><!-- end card-body -->
                                </div>
                                <div class="tab-pane" id="nav-past" role="tabpanel">
                                    <div class="">
                                        <div class="live-preview">
                                            @php
                                                $upcomimgBooking= [];
                                                $br = new \App\Repositories\BookingRepository;
                                                $BookingDetail = $br->tabFilterData($bookingDetails,'past',request()->serviceType ,date('Y-m-d'));
                                                foreach($BookingDetail as $i=>$book_details){
                                                    $upcomimgBooking[@$book_details->business_services_with_trashed->id .'!~!'.@$book_details->business_services_with_trashed->program_name] [] = $book_details;
                                                }
                                            @endphp
                                            <div class="accordion custom-accordionwithicon accordion-border-box tabdatapast" id="accordionnesting" >
                                                @include('business.website_integration.user_booking_detail', ['orderDetails' => @$upcomimgBooking, 'tabName' => 'past','customer'=>$customer])
                                            </div>
                                        </div>
                                    </div><!-- end card-body -->
                                </div>
                            </div>
                        </div><!-- end card-body -->
                    </div>
                </div><!-- end col -->
            </div><!-- end row -->				
        </div><!-- container-fluid -->
    {{-- </div><!-- END layout-wrapper --> --}}

    <div class="modal fade removeaccess" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-modal="true">
    <div class="modal-dialog modal-dialog-centered" id="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="text-center">
                    <p class="fs-14">You are about to remove your sync with Fitness {{@$business->public_company_name}} denying access, the provider will no longer be able to link with your account. This allows the provider to automatically update your account and booking information with them.</p>
                    <a class="addbusiness-btn-modal btn btn-red" href="{{route('personal.grantAccess',['business_id'=>request()->business_id ,'customerId'=>@$customer->id ,'type' => request()->type,'status' =>'deny'])}}">Deny Access</a>
                </div>
            </div>
        </div>
    </div>
    </div>

    <div class="modal fade accessControl" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-modal="true">
    <div class="modal-dialog modal-dialog-centered" id="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="text-center">
                    <h4 class="mb-10">Access Control</h4>
                    @if(@$customer->user_id)
                        <a class="btn btn-success">Access Granted</a>
                        <a class="addbusiness-btn-modal btn btn-red" data-bs-toggle="modal" data-bs-target=".removeaccess" >Deny Access</a>
                    @else
                        <a class=" btn btn-red" href="{{route('personal.grantAccess',['business_id'=>request()->business_id ,'customerId'=>@$customer->id ,'type' => request()->type,'status' =>'grant'])}}">No-Access Granted</a>
                    @endif
                </div>
            </div>
        </div>
    </div>
    </div>


    {{-- recceipt --}}

		<!-- Modal Structure -->
		<div class="modal fade" id="receiptModal" tabindex="-1" aria-labelledby="receiptModalLabel" aria-hidden="true">
			<div class="modal-dialog modal-dialog-centered modal-70">
			<div class="modal-content">
				<div class="modal-header">
				<h5 class="modal-title" id="receiptModalLabel">Receipt</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<div class="modal-body">
				<!-- Content will be loaded here via AJAX -->
				</div>
			</div>
			</div>
		</div>
		
		{{-- end --}}

<!-- <script>
    $(document).on('click', '.dropdown-item', function (e) {
        e.preventDefault();    
        let serviceType = $(this).data('service-type');    
        var user = @json($user);
        var business = @json($business->id);
        $.ajax({
            url: '{{ route("personal_orders") }}', 
            type: 'GET',
            data: {
                serviceType: serviceType,
                user: user,
                business: business,
            },
            success: function (response) {
                $('#results-container').html(response);
            },
            error: function (xhr) {
                console.log('Error:', xhr);
            }
        });
    });
    </script> -->
    <script>
        $(document).on('click', '.openreceiptmodel', function(e) {
            e.preventDefault();
            let url = $(this).data('url');	
            $.ajax({
                url: url,
                type: 'GET',
                success: function(response) {
                    $('#receiptModal .modal-body').html(response);
                    $('#receiptModal').modal('show');
                },
                error: function(xhr) {
                    console.log('Error:', xhr);
                }
            });
        });
    </script>
    <script>
    function changeTab(type,from){
		$('#serchType').val(type);
		if(from == 'mobile'){
			$('.nav-link').removeClass('active');
			$('[data-bs-toggle="tab"][href="#nav-' + type + '"]').addClass('active');
	        $('.tab-pane').removeClass('active');
         	$('#nav-' + type).addClass('active');
		}
	}
    </script>
   <script>
    // function searchActivity(){
    //     var text = $('#activityName').val();
    //     var type = $('#serchType').val();
    //     var csrfToken = $('meta[name="csrf-token"]').attr('content');

    //     $.ajax({
    //         type: "POST", 
    //         url: '{{ route("orders_searchActivity") }}',
    //         data: {
    //             "_token": csrfToken,  
    //             "text": text,
    //             "type": type,
    //             "businessId": @json($business->id),
    //             "serviceType": "{{ request()->serviceType }}"
    //         },
    //         success: function(data){
    //             $(".tabdata" + type).html(data);
    //         },
    //         error: function(xhr, status, error) {
    //             console.log('Error:', error);
    //         }
    //     });
    // }
</script>

<script>
    var selectedServiceType = "{{ request()->serviceType || '' }}";
    $(document).on('click', '.ajax-link', function(e) {
    e.preventDefault();    
    selectedServiceType = $(this).data('servicetype'); // Update the selected serviceType

    var serviceType = $(this).data('servicetype');
    var business_id = {{ $business->id }};
    var user = JSON.parse(localStorage.getItem('user'));  // Parse the user object from localStorage
    var user_id = user ? user.id : null;
    var data = {
        serviceType: serviceType,
        business_id: business_id, 
        user_id: user_id 
    };    
    var urlParams = new URLSearchParams(window.location.search);
    urlParams.forEach(function(value, key) {
        data[key] = value;
    });    
    // console.log('Request Data:', data);
    $.ajax({
        url: "{{ route('orders.viewbooking_get') }}",
        type: 'GET',    
        data: data,
        success: function(response) {
            console.log('Response received:', response);
            if (response.html) {
                $('#bookingModal .modal-body').html(response.html);
                $('#bookingModal').modal('show');
            } else {
                console.error('No HTML content in response');
            }
        },
        error: function(xhr, status, error) {
            console.error('AJAX Error:', {
                status: status,
                error: error,
                response: xhr.responseText
            });
        }
    });
});


function searchActivity(){
        var text = $('#activityName').val();
        var type = $('#serchType').val();
        var csrfToken = $('meta[name="csrf-token"]').attr('content');

        $.ajax({
            type: "POST", 
            url: '{{ route("orders_searchActivity") }}',
            data: {
                "_token": csrfToken,  
                "text": text,
                "type": type,
                "businessId": @json($business->id),
                // "serviceType": "{{ request()->serviceType }}"
                "serviceType": selectedServiceType 
            },
            success: function(data){
                $(".tabdata" + type).html(data);
            },
            error: function(xhr, status, error) {
                console.log('Error:', error);
            }
        });
    }
</script>