@inject('request', 'Illuminate\Http\Request')
@extends('layouts.header')

@section('content')

<link href="{{ url('public/css/jquery-ui.css') }}" rel="stylesheet" type="text/css">

<style>
.avatar {
  vertical-align: middle;
  width: 70px;
  height: 70px;
  border-radius: 50%;
}
.texttr{
  text-transform:capitalize;
}
input,select {
  margin: 2.2% 0.5%;
  border: 1px solid #828282;
  padding: 16px 10px;
  width: 100%;
}
 </style>
<?php 
    use App\BusinessPriceDetailsAges;
    use App\BusinessPriceDetails;
    use App\BusinessActivityScheduler;
    use App\UserBookingDetail;
    $popupserid = '';
    if(@$popupserviceid != ''){
        $popupserid = $popupserviceid;
    }
?>
<div class="p-0 col-md-12 inner_top padding-0">
    <div class="row">
        <div class="col-md-2" style="background: black;">
           @include('business.businessSidebar')
        </div>

        <div class="col-md-10 nopadding">   
            <div class="business-offer-main manageservice-page">
                <section class="row">
                    <div class="col-md-12 text-center">
                        <h2>Manage <?=$companyname?> Services</h2>
                    </div>
                    
                    <form id="frmservice" name="frmservice" method="post" action="{{route('business.service_redirection')}}">
                        <div class="col-md-10"></div>
                        <div class="col-md-2">
                        @csrf
                        <input type="hidden" name="cid" value="{{ $companyid }}" style="width:50px" />
                        <input type="hidden" name="serviceid" value="0" style="width:50px" />
                        <input type="submit" class="btn btn-red" name="btncreateservice" id="btncreateservice" value="Create Service" />
                        </div>
                    </form>
                    @if(isset($companyservice) && !empty($companyservice[0]))
                        @foreach($companyservice as $cs => $cservice)
                        @if($cservice->serviceid != 0)
                            <?php
                                $businessschedulecount = 0;
                                $catdata =  $cservice->BusinessPriceDetailsAges;
                                $sc_cat_cnt = $cservice->get_scheduled_categories($catdata);
                                $UserBookingDetailcount = $cservice->this_week_booking();
                                $profilePic = '';
                                if ($cservice->first_profile_pic() !="" && file_exists( public_path() . '/uploads/profile_pic/' . $cservice->first_profile_pic()) ) {
                                    $profilePic = url('/public/uploads/profile_pic/' . $cservice->first_profile_pic());
                                }
                            ?>
                            <div class="col-md-12">
                                <form id="frmCompany<?=$cs?>" name="frmCompany<?=$cs?>" method="post" action="{{route('business.service_redirection')}}">
                                    <div class="col-md-12">
                                        @csrf
                                        <input type="hidden" name="cid" value="{{ $cservice->cid }}" style="width:50px" />
                                        <input type="hidden" name="serviceid" value="{{ $cservice->id }}" style="width:50px" />
                                        <input type="hidden" name="service_type" value="{{ $cservice->service_type }}" style="width:50px" />
                                        <div class="network_block nw-profile_block">
                                            <div class="row">
                                                <div class="nw-user-detail-block">
                                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 nw-user-detail">
                                                        <div class="row">
                                                            <div class="col-lg-1 col-md-1 col-sm-2 col-xs-12">	

                                                                @if($profilePic != '')
                                                                    <img src="{{ $profilePic }}" alt="Avatar" class="avatar">
                                                                @else 
                                                                <?php
                                                               		echo '<div class="youpage-img-text">';
                                									$pf=substr($cservice->program_name, 0, 1);
                                									echo '<p>'.$pf.'</p></div>';
                                                               		?>
                                                    			@endif
                                                            </div>
                                                            <div class="col-xs-12 col-lg-3 col-md-3 col-sm-3">
                                                                <p class="texttr">{{$cservice->program_name}} ({{$cservice->sport_activity}}) <b>{{ ($cservice->is_active==1) ? "Active" : "Inactive"}}</b></p>
                                                                <p class="texttr"><b>{{ ($cservice->service_type=='individual') ? 'Personal Training' : $cservice->service_type }}</b></p>
                                                            </div>
                                							<div class="col-xs-12 col-lg-2 col-md-2 col-sm-3">
                                								<div class="manage-txt">
                                									<label>OVERVIEW</label>
                                									<span>{{$UserBookingDetailcount}} Bookings This Week   </span>
                                									<span>Expires on: {{$cservice->get_expired_time()}}</span>
                                                                    @if($cservice->is_active==0)
                                									   <p>Note: This activity is inactive and is No longer available for bookings. Click edit to update expiration</p>
                                                                    @endif
                                								</div>
                                							</div>
                                							<div class="col-xs-12 col-lg-3 col-md-3 col-sm-4">
                                								<div class="manage-txt">
                                									<label>SCHEDULE</label>
                                									<span>{{ count($cservice->BusinessPriceDetailsAges)}} CATEGORIES CREATED | <br> {{ $sc_cat_cnt}} CATEGORIES SCHEDULED | <br> <a href="#" data-toggle="modal" data-target="#editschedule{{$cservice->id}}{{$cservice->cid}}"> + EDIT SCHEDULE</a>
                                                                    <a href="#" onclick="getbookingmodel({{$cservice->id}},'simple');"> | VIEW BOOKINGS</a>
                    												</span>
                                								</div>
                                							</div>
                                                            <div class="col-xs-12 col-lg-1 col-md-1 col-sm-2">
                                                                <input type="submit" class="btn btn-black" name="btnedit" id="btnedit" value="Edit" />
                                                            </div>
                                                           <div class="col-lg-1 col-md-1 col-sm-1"></div>
                                                            <div class="col-xs-12 col-lg-2 col-md-2 col-sm-2">
                                                                <input type="submit" class="btn btn-red" name="btnactive" id="btnactive" value="{{ ($cservice->is_active==0) ? 'Active' : 'Inactive'}} " />
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <?php $i=1; ?>
                            <!-- The Modal Add Business-->
                            <div class="modal fade compare-model" id="editschedule{{$cservice->id}}{{$cservice->cid}}">
                                <div class="modal-dialog schedule-model-width">
                                    <div class="modal-content">
                                        <div class="modal-header" style="text-align: right;"> 
                                            <div class="closebtn">
                                                <button type="button" class="close close-btn-schedule" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">×</span>
                                                </button>
                                            </div>
                                        </div>
                                        <!-- Modal body -->
                                        <div class="modal-body">
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <div class="schedule-modal-title">
                                                        <h4 class="modal-title">SELECT THE CATEGORY YOU WOULD LIKE TO SCHEDULE FOR {{$cservice->program_name}}</h4>
                                                    </div>
                                                </div>
                                                <div class="col-lg-12">
                                                    <div class="modal-inner-txt">
                                                        <h4>CATEGORY</h4>
                                                    </div>
                        							<div class="modal-inner-txt border-modal-data">
                                                        @if(!empty($catdata))
                                                            @foreach($catdata as $data)
                                                                @php
                                                                    $bpdata = BusinessPriceDetails::where('serviceid',$cservice->id)->where('userid',Auth::user()->id)->where('cid',$cservice->cid)->where('category_id', $data['id'])->first();

                                                                    $btdatacount = BusinessActivityScheduler::where('serviceid',$cservice->id)->where('userid',Auth::user()->id)->where('cid',$cservice->cid)->where('category_id', $data['id'])->count(); 

                                                                    $btdatschedle = BusinessActivityScheduler::where('serviceid',$cservice->id)->where('userid',Auth::user()->id)->where('cid',$cservice->cid)->where('category_id', $data['id'])->first();

                                                                    $time = 'Not Scheduled';
                                                                    if(!empty($btdatschedle)){ 
                                                                        if($btdatschedle['set_duration']!=''){
                                                                            $tm=explode(' ',$btdatschedle['set_duration']);
                                                                            $hr=''; $min=''; $sec='';
                                                                            if($tm[0]!=0){ $hr=$tm[0].'hr. '; }
                                                                            if($tm[2]!=0){ $min=$tm[2].'min. '; }
                                                                            if($tm[4]!=0){ $sec=$tm[4].'sec.'; }
                                                                            if($hr!='' || $min!='' || $sec!='')
                                                                            { $time = $hr.$min.$sec; } 
                                                                        }
                                                                    } 
                                                                @endphp
                                                                <div class="row">
                            										<div class="col-md-4 col-sm-3 col-xs-12">
                            											<span>{{$i}}. {{$data['category_title']}}</span><span class="schedle-separator"> | </span>
                            										</div>
                            										<div class="col-md-3 col-sm-3 col-xs-12">
                            											<span>{{ $time}}</span><span class="schedle-separator"> | </span>
                            										</div>
                            										
                            										<div class="col-md-3 col-sm-4 col-xs-12">
                            											<span> {{$btdatacount}} TIMESLOTS SCHEDULED</span><span class="schedle-separator"> | </span>
                            										</div>
                            										<div class="col-md-2 col-sm-3 col-xs-12"> 
                            											<span> <a href="{{route('businesspricedetails', ['catid' =>$data['id'] ]) }}">+ EDIT SCHEDULE</a></span>
                            										</div>
                            									</div>
                                                                @php $i++; @endphp
                                                            @endforeach
                                                        @else
                                                            <p>There Is No Category.</p>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- end modal -->
                        @endif
                        @endforeach
                    @else
                        <div class="col-md-12 text-center" style="padding:100px">
                            No company service records found.
                        </div>
                    @endif
                	<div class="modal fade compare-model" id="modalviewbookings">
                		<div class="modal-dialog schedule-model-width">
                			<div class="modal-content">
                				<div class="modal-header" style="text-align: right;"> 
                					<div class="closebtn">
                						<button type="button" class="close close-btn-schedule" data-dismiss="modal" aria-label="Close">
                							<span aria-hidden="true">×</span>
                						</button>
                					</div>
                				</div>
                				<!-- Modal body -->
                				<div class="modal-body">
                					<div class="row" id="bookingmodel">
                					</div>
                				</div>
                			</div>
                		</div>
                    </div>
                   <!-- end modal -->
                    <div class="col-md-12 text-center back-comp">
                        <a href="/manage/company">Back to Manage Company</a>
                    </div>
                </section>
            </div>
        </div>
    </div>
</div>


<script src="{{ url('public/js/jquery-ui.min.js') }}"></script>
@include('layouts.footer')
<script src="/public/js/jquery-ui.min.js"></script>
<link href="https://cdn.jsdelivr.net/npm/zebra_datepicker@latest/dist/css/default/zebra_datepicker.min.css"/>
<script src="//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.js"></script>

<script>

    function getbookingmodel(sid,chk){  
        let date = '';
        if(chk == 'ajax'){
            date = $('#managecalendarservice').val();
        }else if(chk == 'simple'){
            date = new Date().toLocaleDateString();
            $('#bookingmodel').html('');
        }
 
        $.ajax({
            url:"{{route('getbookingmodeldata')}}",
            xhrFields: {
                withCredentials: true
            },
            type:"get",
            data:{
                sid:sid,
                date:date,
            },
            success:function(data){
                $('#bookingmodel').html(data);
                if(chk == 'simple'){
                    $('#modalviewbookings').modal('show');
                }
            }
        });
    }  
</script>
<script>
$(document).ready(function(){
    
    var popupid = '{{$popupserid}}';
    var companyid = '{{$companyid}}';
    if(popupid != ''){
        $('#editschedule'+popupid+companyid).modal('show');
    }
});  
</script>
@endsection
