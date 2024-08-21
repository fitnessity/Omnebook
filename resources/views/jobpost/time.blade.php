<?php
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