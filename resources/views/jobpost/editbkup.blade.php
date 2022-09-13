 <?php
                        $selected_sport = null;
                        $user = getLoggedInUser();                        
                            

                            @$cart = @$cartinfo[0];
                            $selected_sport = @$cart['service_choice'];
                            $who = json_decode(@$note[0]['booking_detail'],true);
                            $hours = json_decode(@$note[0]['schedule'],true);
                            //print_r($hours);die;
                            
                            
                            
                        ?>
                        <div class="modal-dialog modal-lg">
            <!-- Modal content-->
            <div class="modal-content">
            <button class="stepbtn" onclick="$('.cartedit').empty().hide();">X</button>
              <div class="modal-body">
<p id="msg" style="display:none"></p>

<form id="firststepsupdate" method="post">
<input type="hidden" id="duestaxpercentage" name="duestaxpercentage" value="{{$cart['duestaxpercentage']}}">
<input type="hidden" id="salestaxpercentage" name="salestaxpercentage" value="{{$cart['salestaxpercentage']}}">
<input type="hidden" name="bookid" value="{{$bookid}}">
<input type="hidden" name="cid" value="{{$cid}}">
<input type="hidden" name="user_id" value="{{$user_id}}">
<input type="hidden" id="price" name="price" value="{{$user_id}}">
<div id="clonedInput1" class="clonedInput">
<br>
<p class="step_para">Please select from services this provider offers.</p>
<br>
<div class="row">
  <div class="col-md-4">
    <div class="form-group">
      <label for="sel1" style="color: #f53b49;">Select Catagory</label>
      <select class="form-control selectcatagory" id="frm1" name="selectcatagory">
        <option value="">Select Catagory</option> <?php 
            ksort($userSport);
            foreach ($userSport as $sportKey => $sportValue) {
                if(@count(@$sportValue['child']) > 0){
                  asort($sportValue['child']);
                  echo "<optgroup label='".$sportKey."'>";
                    foreach ($sportValue['child'] as $key => $value) {
                      echo "<option value='$key'";
                      if($selected_sport == $key) echo 'selected';
                      echo ">$value</option>";  
                    }
                  echo "</optgroup>";
                } else {
                  foreach ($sportValue['self'] as $key1 => $value1) {
                    echo "<option value='$key1'";
                    if($selected_sport == $key1) echo 'selected';
                    echo ">".$value1."</option>";
                  }
                }
            }
          ?>
      </select>
    </div>
  </div>
  <div class="col-md-4">
    <div class="form-group">
      <label for="sel1" style="color: #f53b49;">Choose Activity Type</label>
      <select class="form-control frm2" id="frm2" name="activitytype">
      <option value="">Choose Activity Type</option>
      <option value="personal_training">PERSONAL TRAINING</option>
      <option value="coaching">COACHING</option>
      <option value="therapy">THERAPY</option></select>
    </div>
  </div>
  <div class="col-md-4">
  <input type="hidden" id="pricepop" name="price" value="{{$cart['price']}}">
    <div class="form-group">
    <input type="hidden" id="checkseats" value="">
      <label for="sel1" style="color: #f53b49;">Number of Persons - Available seats <span class="available">NA</span></label>
      <input type="text" class="form-control" id="frm3" name="numberofpersons"  value="{{$cart['numberofpersons']}}" placeholder="Number of Persons">
    </div>
  </div>
</div>
<br>
<div class="row">

  <div class="col-md-6">
    <div class="form-group">
      <label for="email" style="color: #f53b49;">Who is Training</label>
      <select class="form-control" name="whoistraining">
      <option>who isTraining</option>
      
        @foreach ($family as $record)
       <option value="{{$record['first_name']}}{{$record['first_name']}}"  @if($who['whoistraining']==$record['first_name'].$record['first_name']) selected @endif>
        {{$record['first_name']}} {{$record['last_name']}} ({{$record['relationship']}})
       </option>
      @endforeach
      <option value="me">Me</option>
      </select>
    </div>
  </div>
  <div class="col-md-6">
    <div class="form-group">
      <label for="email" style="color: #f53b49;">Activity Location</label>
      <select class="form-control activitylocation" name="activitylocation">
      <?php if(!empty($location)){ ?>
      @foreach (@$location as $op)
           <?php $op1 = str_replace('_',' ',strtoupper($op)); ?>
          <option value="{{$op}}" @if($op==$who["activitylocation"]) selected @endif>{{$op1}}</option>
      @endforeach
  <?php  } else{
    echo "<option>No selected</option>";
  } ?>
      </select>
    </div>
  </div>
</div>

</div>

<div class="step2_table">
<?php
date_default_timezone_get();
@$time=json_decode($time,true);
//print_r($time);die;
$sunday_satrt = date("H:i", strtotime($time['sunday_start']));
$sunday_end = date("H:i", strtotime($time['sunday_end']));
$time1 = new DateTime($sunday_satrt);
$time2 = new DateTime( $sunday_end);
$loopsunday = $time1->diff($time2)->format('%h')-1;

$monday_start = date("H:i", strtotime($time['monday_start']));
$monday_end = date("H:i", strtotime($time['monday_end']));
$time1 = new DateTime($monday_start);
$time2 = new DateTime( $monday_end);
$loopmonday = $time1->diff($time2)->format('%h')-1;


$tuesday_start = date("H:i", strtotime($time['tuesday_start']));
$tuesday_end = date("H:i", strtotime($time['tuesday_end']));
$time1 = new DateTime($tuesday_start);
$time2 = new DateTime( $tuesday_end);
$looptuesday = $time1->diff($time2)->format('%h')-1;


$wednesday_start = date("H:i", strtotime($time['wednesday_start']));
$wednesday_end = date("H:i", strtotime($time['wednesday_end']));
$time1 = new DateTime($wednesday_start);
$time2 = new DateTime( $wednesday_end);
$loopwednesday = $time1->diff($time2)->format('%h')-1;


$thursday_start = date("H:i", strtotime($time['thursday_start']));
$thursday_end = date("H:i", strtotime($time['thursday_end']));
$time1 = new DateTime($thursday_start);
$time2 = new DateTime( $thursday_end);
$loopthursday = $time1->diff($time2)->format('%h')-1;

$friday_satrt = date("H:i", strtotime($time['friday_start']));
$friday_end = date("H:i", strtotime($time['friday_end']));
$time1 = new DateTime($friday_satrt);
$time2 = new DateTime( $friday_end);
$loopfriday = $time1->diff($time2)->format('%h')-1;

$saturday_start = date("H:i", strtotime($time['saturday_start']));
$saturday_end = date("H:i", strtotime($time['satureay_end']));
$time1 = new DateTime($saturday_start);
$time2 = new DateTime( $sunday_end);
$loopsaturday = $time1->diff($time2)->format('%h')-1;






?>
<br>
<p class="step_para">Below you can find list of available time slots for <span id="sportname"></span> with {{ $UserProfileDetail['firstname']." ".$UserProfileDetail['lastname'] }}.</p>
<p class="step_para">Click on a time slot to proceed with the booking.</p>
<p>The selected time is not available anymore. Please, choose another time slot.</p>
<br>
<div class="form-group" style="width: 25%;">
      <select class="form-control" id="sel1" name="sellist1">
<option value="est"> Eastern Standard Time (EST)</option>
<option value="cst"> Central Standard Time (CST)</option>
<option value="mst"> Mountain Standard Time (MST)</option>
<option value="pst"> Pacific Standard Time (PST)</option>
      </select>
    </div>
<table class="table table-bordered">
  <thead>
    <tr>
      <th>{{date('D, d F')}}</th>
    </tr>
  </thead>
  <tbody>
    @for($i=0;$i<=$loopsunday;$i++)
      @if(date('H:i a')>date( 'H:i a', strtotime( '+'.$i.' hour' , strtotime($sunday_satrt))))
@else 
<tr><td><input type="radio" class="form-check-input" name="hours[{{strtolower(date('D'))}}]" @if(@$hours['sun']==date( 'H:i a', strtotime( '+'.$i.' hour' , strtotime($sunday_satrt) ) )) checked @endif value="{{date('Y-m-d')}}_{{date( 'H:i a', strtotime( '+'.$i.' hour' , strtotime($sunday_satrt) ) )}}"> 
{{date( 'H:i a', strtotime( '+'.$i.' hour' , strtotime($sunday_satrt) ) )}}</td></tr>
@endif



@endfor
  </tbody>
</table>
   <table class="table table-bordered">
    <thead>
      <tr>
        <th>{{date('D, d F', strtotime(' +1 day'))}}</th>
      </tr>
    </thead>
    <tbody>
    @for($i=0;$i<=$loopmonday;$i++)
<tr><td><input type="radio" class="form-check-input" name="hours[{{strtolower(date('D', strtotime(' +1 day')))}}]" @if(@$hours['mon']==date( 'H:i a', strtotime( '+'.$i.' hour' , strtotime($monday_start) ) )) checked @endif value="{{date('Y-m-d', strtotime(' +1 day'))}}_{{date( 'H:i a', strtotime( '+'.$i.' hour' , strtotime($monday_start) ) )}}"> 
{{date( 'H:i a', strtotime( '+'.$i.' hour' , strtotime($monday_start) ) )}}</td></tr>
@endfor
    
    </tbody>
  </table>
   <table class="table table-bordered">
    <thead>
      <tr>
        <th>{{date('D, d F', strtotime(' +2 day'))}}</th>
      </tr>
    </thead>
    <tbody>
      @for($i=0;$i<=$looptuesday;$i++)
<tr><td><input type="radio" class="form-check-input" name="hours[{{strtolower(date('D',strtotime(' +2 day')))}}]" @if(@$hours['tue']==date( 'H:i a', strtotime( '+'.$i.' hour' , strtotime($tuesday_start) ) )) checked @endif value="{{date('Y-m-d', strtotime(' +2 day'))}}_{{date( 'H:i a', strtotime( '+'.$i.' hour' , strtotime($tuesday_start) ) )}}"> 
{{date( 'H:i a', strtotime( '+'.$i.' hour' , strtotime($tuesday_start) ) )}}</td></tr>
@endfor
    </tbody>
  </table>
   <table class="table table-bordered">
    <thead>
      <tr>
        <th>{{date('D, d F', strtotime(' +3 day'))}}</th>
      </tr>
    </thead>
    <tbody>
     @for($i=0;$i<=$loopwednesday;$i++)
<tr><td><input type="radio" class="form-check-input" name="hours[{{strtolower(date('D', strtotime(' +3 day')))}}]" @if(@$hours['wed']==date( 'H:i a', strtotime( '+'.$i.' hour' , strtotime($wednesday_start) ) )) checked @endif value="{{date('Y-m-d', strtotime(' +3 day'))}}_{{date( 'H:i a', strtotime( '+'.$i.' hour' , strtotime($wednesday_start) ) )}}"> 
{{date( 'H:i a', strtotime( '+'.$i.' hour' , strtotime($wednesday_start) ) )}}</td></tr>
@endfor
    </tbody>
  </table>
   <table class="table table-bordered">
    <thead>
      <tr>
        <th>{{date('D, d F', strtotime(' +4 day'))}}</th>
      </tr>
    </thead>
    <tbody>
    @for($i=0;$i<=$loopthursday;$i++)
     <tr><td><input type="radio" class="form-check-input" name="hours[{{strtolower(date('D', strtotime(' +4 day')))}}]" @if(@$hours['thu']==date( 'H:i a', strtotime( '+'.$i.' hour' , strtotime($thursday_start) ) )) checked @endif value="{{date('Y-m-d', strtotime(' +4 day'))}}_{{date( 'H:i a', strtotime( '+'.$i.' hour' , strtotime($thursday_start) ) )}}"> 
{{date( 'H:i a', strtotime( '+'.$i.' hour' , strtotime($thursday_start) ) )}}</td></tr>

@endfor
    </tbody>
  </table>
   <table class="table table-bordered">
    <thead>
      <tr>
        <th>{{date('D, d F', strtotime(' +5 day'))}}</th>
      </tr>
    </thead>
    <tbody>
    @for($i=0;$i<=$loopfriday;$i++)
<tr><td><input type="radio" class="form-check-input" name="hours[{{strtolower(date('D', strtotime(' +5 day')))}}]" @if(@$hours['fri']==date( 'H:i a', strtotime( '+'.$i.' hour' , strtotime($friday_satrt) ) )) checked @endif value="{{date('Y-m-d', strtotime(' +5 day'))}}_{{date( 'H:i a', strtotime( '+'.$i.' hour' , strtotime($friday_satrt) ) )}}"> 
{{date( 'H:i a', strtotime( '+'.$i.' hour' , strtotime($friday_satrt) ) )}}</td></tr>
@endfor
    </tbody>
  </table>
   <table class="table table-bordered">
    <thead>
      <tr>
        <th>{{date('D, d F', strtotime(' +6 day'))}}</th>
      </tr>
    </thead>
    <tbody>
    @for($i=0;$i<=$loopsaturday;$i++)
<tr><td><input type="radio" class="form-check-input" name="hours[{{strtolower(date('D', strtotime(' +6 day')))}}]" @if(@$hours['sat']==date( 'H:i a', strtotime( '+'.$i.' hour' , strtotime($saturday_start) ) )) checked @endif value="{{date('Y-m-d', strtotime(' +6 day'))}}_{{date( 'H:i a', strtotime( '+'.$i.' hour' , strtotime($saturday_start) ) )}}"> 
{{date( 'H:i a', strtotime( '+'.$i.' hour' , strtotime($saturday_start) ) )}}</td></tr>
@endfor
    </tbody>
  </table>
</div>
<div class="row">
  <div class="col-md-6">
    <div class="form-group">
      <label for="F_name" style="color: #f53b49;">First Name:</label>
      <input type="text" class="form-control" id="usr" value="{{ Auth::user()->firstname. ' ' . Auth::user()->lastname }}" name="username">
    </div>
  </div>
  <div class="col-md-6">
     <div class="form-group">
      <label for="l_name" style="color: #f53b49;">Last Name:</label>
      <input type="text" class="form-control" id="usr" value="{{Auth::user()->lastname}}" name="lastname">
    </div>
  </div>
  <div class="col-md-6">
     <div class="form-group">
      <label for="phone" style="color: #f53b49;">Phone:</label>
      <input type="text" class="form-control" id="usr" value="{{Auth::user()->phone_number}}" name="phone">
    </div>
  </div>
  <div class="col-md-6">
     <div class="form-group">
      <label for="email" style="color: #f53b49;">Email:</label>
      <input type="text" class="form-control" id="usr" value="{{ Auth::user()->email }}" name="email">
    </div>
  </div>
  <div class="col-md-12">
     <div class="form-group">
      <label for="email" style="color: #f53b49;">Notes (medical issue, request, etc.)</label>
      <textarea class="form-control" rows="5" name="comment" id="comment">{{@$note[0]['note']}}</textarea>
    </div>
  </div>
</div>
<div class="modal-footer">
<button type="submit" class="stepbtn" style="float: right;">Update</button>
          
        </div>

<form>
</div>
  </div>
</div>

<script>
$(document).ready(function()
    {
       var x = new SlimSelect({
    select: '.whois'
  });
  $('#firststepsupdate').submit(function(e) {
        e.preventDefault();
        if($('#frm1').val()==''){
          $('#msg').text('Please fill the form').show();
          return false
        }
        var inputData = new FormData($(this)[0]);
        inputData.append('_token','{{csrf_token()}}');
         inputData.append('business_id','{{$user_id}}');
         inputData.append('price',$('#pricepop').val());
        $.ajax({
                url:'/updatecart',
                type:'POST',
                dataType: 'json',
                data:inputData,
                processData:false,
                contentType:false,
                 beforeSend: function () {
                    $('.loader').show();
                  },
                  complete: function () {
                    $('.loader').hide();
                  },
                success: function (response) {
                  
                  if(response.status==1){
                     $('#msg').text('Update successfull').show();
                     setTimeout($('.cartedit').empty().hide(), 5000);
                     $.ajax({
          url:'/cart',
          type:'GET',
          beforeSend: function () {
             $('.loader').show();
           },
           complete: function () {
             $('.loader').hide();
           },
          success: function (response) {
               $('#tbcrt').html(response);
            }
        });
                    
                  }
                 
                }
          });
      });
  });
</script>