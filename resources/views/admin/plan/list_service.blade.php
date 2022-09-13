@extends('admin.layouts.layout')

@section('content')

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





.nw-user-detail-block .nw-user-detail p {

    margin-bottom: 0px;

}



.youpage-img-text {

    width: 55px;

    height: 55px;

    display: inline-block;

    border-radius: 100%;

    overflow: hidden;

    border: 3px solid #ddd;

    vertical-align: middle;

    background-color: #ea1515;

}



.youpage-img-text p {

    font-size: 20px;

    text-align: center;

    padding: 24% 0px;

    color: #fff;

    font-weight: bold;

    text-transform: uppercase;

}

.nw-user-detail p {

    float: left;

    width: 100%;

    color: #777;

    font-size: 16px;

    margin-bottom: 15px;

}

.texttr {

    text-transform: capitalize;

}

.nw-profile_block {

    float: left;

    width: 100%;

    margin-top: 30px;

    padding: 20px;

}

.btn {

    border-radius: 3px;

    -webkit-box-shadow: none;

    box-shadow: none;

    border: 1px solid transparent;

}

.btn {

    border-radius: 3px;

    -webkit-box-shadow: none;

    box-shadow: none;

    border: 1px solid transparent;

}

.btn-black {

    color: #ffffff;

    background-color: #000000;

    border-color: #000000;

    transition: 0.5s;

}

.btn-red {

    color: #ffffff;

    background-color: #ed1b24;

    border-color: #ea1515;

    transition: 0.5s;

}



.network_block {

    float: left;

    width: 100%;

    padding: 15px;

    background: #fff;

    box-shadow: 0px 1px 3px -1px #777;

    -webkit-box-shadow: 0px 1px 3px -1px #777;

    /* margin-bottom: 10px; */

}

.btn-success, .btn-success:hover, .btn-success:active, .btn-success:focus {

    color: #fff !important;

    background-color: #367fa9 !important;

    border-color: #367fa9 !important;

}





h1, h2, h3, h4, h5, p, ul, li, p {

    margin: 0;

    padding: 0;

    list-style: none;

    font-weight: normal;

}

 </style>

<?php 
    use App\BusinessPriceDetailsAges;
    use App\BusinessPriceDetails;
    use App\BusinessActivityScheduler;
    use App\UserBookingDetail;
?>

<div class="business-offer-main" style="margin-top:50px;min-height:500px;">
    <section class="row">
    <?php
    $companyid = $companyname =  $is_verified = "";
    if(isset($companyInfo)) {
        if(isset($companyInfo[0]) && !empty($companyInfo[0])) {
            $companyid = $companyInfo[0]->id;
            $companyname = $companyInfo[0]->company_name;
            $is_verified = $companyInfo[0]->is_verified;
        }
    }

    $popupserid = '';
    if(@$popupserviceid != ''){
        $popupserid = $popupserviceid;
    }

    ?>

    <div class="col-md-12 text-center">
        <h2>Manage <?=$companyname?> Services</h2>
    </div>

    <div>
        <div class="col-md-10"></div>
        <div class="col-md-2">
        <a href="{{route('add_activity',['id'=>$companyid])}}" class="btn btn-red" name="btncreateservice" id="btncreateservice">Create Service</a>
        </div>
    </div>

    @if(isset($companyservice) && !empty($companyservice[0]))
    @foreach($companyservice as $cs => $cservice)
        <?php
            $businessschedulecount = 0;
            $dataarray = [];
            $cattotal=  BusinessPriceDetailsAges::where('serviceid',$cservice->id)->where('cid',$cservice->cid)->count();
            $catdata=  BusinessPriceDetailsAges::where('serviceid',$cservice->id)->where('cid',$cservice->cid)->get();
            foreach($catdata as $data){
                $businessschedule = BusinessActivityScheduler::where('category_id', $data['id'])->get();
                foreach($businessschedule as $scdata){
                    $dataarray[]= $scdata['category_id'];
                }
            }
            $dataarray =array_unique($dataarray);
            $firstday = date('Y-m-d', strtotime("this week"));
            $UserBookingDetailcount = UserBookingDetail::where('sport',$cservice->id)->where('bookedtime',">=", $firstday)->count();
        ?>
        <div class="col-md-12">
            <form id="" name=""  action="">
                <div class="col-md-12">
                @csrf
                    <input type="hidden" name="cid" value="{{ $cservice->cid }}" style="width:50px" />
                    <input type="hidden" name="serviceid" value="{{ $cservice->serviceid }}" style="width:50px" />
                    <input type="hidden" name="service_type" value="{{ $cservice->service_type }}" style="width:50px" />
                    <div class="network_block nw-profile_block">
                        <div class="row">
                            <div class="nw-user-detail-block">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 nw-user-detail">
                                    <div class="row">
                                        <div class="col-lg-1 col-md-1 col-sm-1">	
                                        	@if(File::exists(public_path("/uploads/profile_pic/thumb/".$cservice->profile_pic)) && !empty($cservice->profile_pic) )
                                            <img src="{{url('/').'/public/uploads/profile_pic/thumb/'.$cservice->profile_pic}}" alt="Avatar" class="avatar">
                                            @else <?php
                                           		echo '<div class="youpage-img-text">';
            									$pf=substr($cservice->program_name, 0, 1);
            									echo '<p>'.$pf.'</p></div>';
                                           		?>
                                			@endif
                                        </div>
                                        <?php /*?><div class="col-lg-7 col-md-7 col-sm-7"><?php */?>
                                        <div class="col-lg-3 col-md-3 col-sm-3">
                                            <p class="texttr">{{$cservice->program_name}} ({{$cservice->sport_activity}}) <b>{{ ($cservice->is_active==1) ? "Active" : "Inactive"}}</b></p>
                                            <p class="texttr"><b>{{ ($cservice->service_type=='individual') ? 'Personal Training' : $cservice->service_type }}</b></p>
                                        </div>

                                        <div class="col-lg-2 col-md-3 col-sm-3">
                                            <div class="manage-txt">
                                                <label>OVERVIEW</label>
                                                <span>{{$UserBookingDetailcount}} Bookings This Week   </span>
                                                <span>Expires on: 1/26/2023</span>
                                                @if($cservice->is_active==0)
                                                   <p>Note: This activity is inactive and is No longer available for bookings. Click edit to update expiration</p>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="col-lg-3 col-md-2 col-sm-2">
                                            <div class="manage-txt">
                                                <label>SCHEDULE</label>
                                                <span>{{ $cattotal}} CATEGORIES CREATED | <br> {{ count($dataarray)}} CATEGORIES SCHEDULED | <br> <a href="#" data-toggle="modal" data-target="#editschedule{{$cservice->id}}{{$cservice->cid}}"> + EDIT SCHEDULE</a>   </span>
                                                <!--<span>{{ $cattotal}} Catagories Scheduled | <br> <a href="{{route('businesspricedetails')}}"> + Edit Schedule</a>   </span>-->
                                            </div>
                                        </div>

                                        <div class="col-lg-1 col-md-1 col-sm-1">
                                            <a href="{{route('edit_services',['sid'=>$cservice->id , 'cid'=>$cservice->cid ])}}" class="btn btn-success" name="btnedit" id="btnedit" > Edit </a>
                                        </div>

                                        <?php /*?><div class="col-lg-1 col-md-1 col-sm-1">
                                            <input type="submit" class="btn btn-black" name="btnview" id="btnview" value="View" />
                                        </div><?php */?>

                                        <div class="col-lg-2 col-md-2 col-sm-2">
                                            <input type="button" class="btn btn-red" name="btnactive" id="btnactive{{$cservice->id}}{{$cservice->cid}}" value="{{ ($cservice->is_active==0) ? "Active" : "Inactive"}} " onclick="chagestatus({{$cservice->is_active}},{{$cservice->id}},{{$cservice->cid}});" />
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
                                                $bpdata = BusinessPriceDetails::where('serviceid',$cservice->id)->where('cid',$cservice->cid)->where('category_id', $data['id'])->first();

                                                $btdatacount = BusinessActivityScheduler::where('serviceid',$cservice->id)->where('cid',$cservice->cid)->where('category_id', $data['id'])->count(); 

                                                $btdatschedle = BusinessActivityScheduler::where('serviceid',$cservice->id)->where('cid',$cservice->cid)->where('category_id', $data['id'])->first();

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
                                                <div class="col-md-4">
                                                    <span>{{$i}}. {{$data['category_title']}}</span><span class="schedle-separator"> | </span>
                                                </div>
                                                <div class="col-md-3">
                                                    <span>{{ $time}}</span><span class="schedle-separator"> | </span>
                                                </div>
                                                
                                                <div class="col-md-3">
                                                    <span> {{$btdatacount}} TIMESLOTS SCHEDULED</span><span class="schedle-separator"> | </span>
                                                </div>
                                                <div class="col-md-2"> 
                                                    <span> <a href="{{route('admin_businesspricedetails', ['catid' =>$data['id'] ]) }}">+ EDIT SCHEDULE</a></span>
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
    @endforeach
    @else

    <div class="col-md-12 text-center" style="padding:100px">
        No company service records found.
    </div>

    @endif

    <div class="col-md-12 text-center back-comp">
        @if($is_verified == 0)
            <a href="/admin/unclaimbusiness">Back to Manage Company</a>
        @else
            <a href="/admin/claimbusiness">Back to Manage Company</a>
        @endif
    </div>
    </section>
</div>

<script src="/public/js/jquery-ui.min.js"></script>
<link href="https://cdn.jsdelivr.net/npm/zebra_datepicker@latest/dist/css/default/zebra_datepicker.min.css"/>
<script src="//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.js"></script>

<script>
    $(document).ready(function(){
        @if(isset($firstCompany))
        $('#display_user_profile_pic').attr('src',"{{url('/').'/public/uploads/profile_pic/thumb/'.$firstCompany->logo}}")
        $('.username').html("{{'@'.$firstCompany->business_user_tag}}")
        $('#intro-user').html("{{$firstCompany->about_company}}")
        $('.coemail').attr('href',"{{'mailto:'.$firstCompany->email}}")
        $('.cophone').attr('href',"{{'tel:'.$firstCompany->contact_number}}")
        @endif

        $(".deletec").click(function(){
            $.ajax({
                url:"{{url('/pcompany/delete/')}}"+"/"+$(this).attr('company_id'),
                type:'GET',
                dataType: 'json',
                processData: false,
                contentType: false,
                headers: {'X-CSRF-TOKEN': $("#_token").val()},
                beforeSend: function () {
                    $('.deletec').prop('disabled', true);
                    showSystemMessages('#systemMessage', 'info', 'Please wait while we delete a company with Fitnessity.');
                },
                complete: function () {
                    $('#deletec').prop('disabled', false);
                },

                success: function (response) {
                    showSystemMessages('#systemMessage', response.type, response.msg);
                    window.location.reload()
                }
            });
        });
    });  

    function chagestatus(status,sid,cid) {
        var status = $('#btnactive'+sid+cid).val();
      /*  alert(status);*/
        $.ajax({
          url: "{{route('editBusinessServiceadmin')}}",
          type: 'post',
          data:{
            _token: '<?php echo csrf_token(); ?>',
            btnactive:status,
            cid:cid,
            serviceid : sid,
          },
          success: function (data) {
            location.reload(true);
          }
        });
    }  

</script>

@endsection

