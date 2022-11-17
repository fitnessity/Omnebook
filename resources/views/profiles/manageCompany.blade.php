@inject('request', 'Illuminate\Http\Request')
@extends('layouts.header')
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
.manage-txt span{
	font-size: 13px;
	color: #000;
	margin-bottom: 8px;
}
.manage-txt {display: grid;}

 </style>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
<?php /*?><link href="https://cdn.rawgit.com/dubrox/Multiple-Dates-Picker-for-jQuery-UI/master/jquery-ui.multidatespicker.css" rel="stylesheet"/>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Zebra_datepicker/1.9.15/zebra_datepicker.src.js"></script><?php */?>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>

<div class="business-offer-main bus-rp-offer" style="margin-top:50px; padding:50px; min-height:500px;" >
  <section class="row" id="maindiv">
    <?php
      use App\BusinessServices;
      use App\UserBookingDetail;
      use Carbon\Carbon;
      $loggedinUser = Auth::user();
      $customerName = $loggedinUser->firstname . ' ' . $loggedinUser->lastname;
      $profilePicture = $loggedinUser->profile_pic;
    ?>
    <div class="col-md-12 text-center">
        <h2>Manage Company</h2>
    </div>
    @if(isset($company) && !empty($company[0]))
    @foreach($company as $cp => $comp)
    <form id="frmCompany<?=$cp?>" name="frmCompany<?=$cp?>" method="post" action="{{route('editBusinessProfile')}}">
      <div class="col-md-12">
        @csrf
          <input type="hidden" name="cid" value="{{ $comp->id }}" />
          <input type="hidden" name="serviceid" value="{{ $comp->serviceid }}" />
          <div class="network_block nw-profile_block border-radius6">
          <div class="row">
            <div class="nw-user-detail-block">
              <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 nw-user-detail">
                <div class="row">
                  <div class="col-lg-1 col-md-1 col-sm-2 col-xs-12 text-center">
                    @if(File::exists(public_path("/uploads/profile_pic/thumb/".$comp->logo)) && !empty($comp->logo) )
                      <img src="{{url('/').'/public/uploads/profile_pic/thumb/'.$comp->logo}}" alt="{{$comp->company_name}}" class="avatar">
                    @else <?php
                      echo '<div class="company-list-text">';
									    $pf=substr($comp->company_name, 0, 1);
									    echo '<p>'.$pf.'</p></div>';
                    ?>
                    @endif
                  </div>
                  <div class="col-lg-2 col-md-2 col-sm-3 col-xs-12">
                    <p class="texttr">{{$comp->company_name}}</p>
                    <p class="texttr">{{$comp->first_name}} {{$comp->last_name}}</p>
                  </div>
                  <?php 
                    $personaltrainercount = BusinessServices::where(['cid'=>$comp->id,'service_type'=>'individual'])->count(); 
                    $gymtrainercount = BusinessServices::where(['cid'=>$comp->id,'service_type'=>'classes'])->count(); 
                    $experiencetrainercount = BusinessServices::where(['cid'=>$comp->id,'service_type'=>'experience'])->count(); 
                    
                    $current_weekdata  = UserBookingDetail::whereBetween('bookedtime', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->get();
                    $i = 0;
                    $y = 0;
                    $z = 0;
                    foreach ($current_weekdata as $key => $value) {
                      $serviceid = $value->sport;
                      $getdata = BusinessServices::where('id',$serviceid)->first();
                      // echo $getdata;exit();
                      if($getdata && $getdata->cid == $comp->id && $getdata->service_type == 'individual'){
                        $i++;
                      }
                      if($getdata && $getdata->cid == $comp->id && $getdata->service_type == 'classes'){
                        $y++;
                      }
                      if($getdata && $getdata->cid == $comp->id && $getdata->service_type == 'experience'){
                        $z++;
                      }
                    }

                    $personlbookingcount = $i;
                    $gymbookingcount = $y;
                    $experiencebookingcount = $z;
                  ?>
					<div class="col-lg-5 col-md-5 col-sm-4 col-xs-12">
    					<div class="manage-txt">
    						<label>OVERVIEW</label>
    						<span>{{$personaltrainercount}} PERSONAL TRAINER SERVICES | {{$personlbookingcount}} BOOKINGS THIS WEEK | 0 PROGRAM EXPIRING SOON </span>
    						<span>{{ $gymtrainercount}} GYM / STUDIO SERVICES  | {{$gymbookingcount}} BOOKINGS THIS WEEK | 5 PROGRAM EXPIRING SOON </span>
    						<span>{{$experiencetrainercount}} EXPERIEINCE SERVICES | {{ $experiencebookingcount}} BOOKINGS THIS WEEK | 1 PROGRAM EXPIRING SOON </span>
    					</div>
    				</div>
  					
                  <div class="col-lg-2 col-md-2 col-sm-3 col-xs-12">
                    <input type="submit" class="btn btn-red" name="btnedit" id="btnedit" value="Edit" />
                    <input type="submit" class="btn btn-black" name="btncreateservice" id="btncreateservice" value="Create Service" />
                  </div>
                  <div class="col-lg-2 col-md-2 col-sm-3 col-xs-12">
                    <input type="submit" class="btn btn-red" name="btnview" id="btnview" value="View" />
                   
                    @php  $datacount = BusinessServices::where(['cid'=>$comp->id,'userid'=>Auth::user()->id])->count(); @endphp
                    @if($datacount==0)
                      <input type="submit" class="btn btn-black" name="btnmanageservice" id="btnmanageservice" value="Manage Service" Disabled />
                    @else
                      <input type="submit" class="btn btn-black" name="btnmanageservice" id="btnmanageservice" value="Manage Service" />
                    @endif
                    
                    @if($comp->status==0)
                    	<input type="button" class="btn btn-red" id="changestatus_{{$comp->id}}" value="ACTIVATE" data-cid="{{$comp->id}}" onclick="statuschange(this.getAttribute('data-cid'));" />
                    @else
                    	<input type="button" class="btn btn-red" id="changestatus_{{$comp->id}}" value="DEACTIVATE" data-cid="{{$comp->id}}" onclick="statuschange(this.getAttribute('data-cid'));" />
					         @endif
                    
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </form>
    @endforeach
    @else
    <div class="col-md-12 text-center" style="padding:100px">
        No company listed
    </div>
    @endif
  </section>
</div>
@include('layouts.footer')
<script src="/public/js/jquery-ui.min.js"></script>
<?php /*?><link href="https://cdn.jsdelivr.net/npm/zebra_datepicker@latest/dist/css/default/zebra_datepicker.min.css"/>
<script src="//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.js"></script><?php */?>
<script>
$(document).ready(function(){
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

function statuschange(cid){
  var status = $("#changestatus_"+cid).val();
  var _token = $("input[name='_token']").val();
  $.ajax({
    url:"{{route('changecompanystatus')}}",
    type:'post',
    dataType: 'json',
    headers: {'X-CSRF-TOKEN': _token},
    data: {
        'status': status,
        'cid': cid
      },
    success: function (response) {
      $("#maindiv").load(" #maindiv");
    }
  });
} 
</script>
@endsection
