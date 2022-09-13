
@include('emails.header')

    Hello {!! $user['first_name'] !!} {!! $user['last_name'] !!},<br><br>

  We have received a new booking request from you.
  <br><br>

    <h1><center><b style="color:red">Lesson Detail</b></center></h1>
    <hr><br>
   
      Sport: {{ @$sportsList[$booking['user_booking_detail']['sport']] }} </a> <br>
      Detail: {{ $booking['user_booking_detail']['booking_detail'] }}<br>
      Sport Price: {{ $booking['user_booking_detail']['price'] }}<br>
      Booking Status: {{ $booking['status'] }}<br>

     <h1><center><b style="color:red">Trainer Detail</b></center></h1>
      <hr><br>
      
      <div style="width: 100%;height:100px;display:inline-block;">
      <span style="width: 25%;float:left;display:inline-block;">
        <?php
        if($professional['profile_pic'] != '' && file_exists(public_path().DIRECTORY_SEPARATOR.'uploads'.DIRECTORY_SEPARATOR.'profile_pic'.DIRECTORY_SEPARATOR.'thumb150'.DIRECTORY_SEPARATOR.$professional['profile_pic'])) {
          echo '<img src="'.Config::get('constants.USER_IMAGE_THUMB150').$professional['profile_pic'].'" width="100" height="100" id="display_user_profile_pic" />';
        }
        else {
          echo '<img src="'.Config::get('constants.FRONT_IMAGE').'user.png" width="100" height="100" id="display_user_profile_pic" />';
        }
        ?>
      </span>
      <span style="width: 75%;float:right;display:inline-block;">
        <p><b>{{ $professional['firstname']." ".$professional['lastname'] }}</b></p>
        <p>{{ $professional['professional_detail']['cities'].",".$professional['professional_detail']['states'].", ".$professional['country']." - ".$professional['zipcode']}}</p>
        
        <a  href="{!! url('/viewBooking/'.$booking['booking_id']) !!}" style="font-size: 16px;">View Booking</a>
      </span>
    </div>
      <br><br>
    Please wait for professional's confirmation on this.
    <br><br>
  <a href="{!! url('/viewBooking/'.$booking['booking_id']) !!}">Click here</a> to know more about this request after <a href="{!! url('/') !!}">login</a> to Fitnessity.<br>
  <a href="{!! url('/mypostedjobs') !!}">Click here</a> to see all your bookings after login.
    
@include('emails.footer')