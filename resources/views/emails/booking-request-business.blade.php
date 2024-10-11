@include('emails.header')

    Hello {!! $professional['firstname'] !!} {!! $professional['lastname'] !!}, 
    <br><br>

    Greetings from Fitnessity!! <br><br>

    You have recieved a new booking request.<br>
    This booking will be confirmed only after your confirmation. So please check these details and let the system know your favorable reply.<br><br>

   <h1><center><b style="color:red">Lesson Detail</b></center></h1>
    <hr><br>
      Sport: {{ @$sportsList[$booking['user_booking_detail']['sport']] }} </a> <br>
      Detail: {{ $booking['user_booking_detail']['booking_detail'] }}<br>
      Sport Price: {{ $booking['user_booking_detail']['price'] }}<br>
      Booking Status: {{ $booking['status'] }}<br>
    <h1><center><b style="color:red">Customer Detail</b></center></h1>
    <hr><br>
       <div style="width: 100%;height:100px;display:inline-block;">
      <span style="width: 25%;float:left;display:inline-block;">
        <?php
        if($user['profile_pic'] != '' && file_exists(public_path().DIRECTORY_SEPARATOR.'uploads'.DIRECTORY_SEPARATOR.'profile_pic'.DIRECTORY_SEPARATOR.'thumb150'.DIRECTORY_SEPARATOR.$user['profile_pic'])) {
          echo '<img src="'.Config::get('constants.USER_IMAGE_THUMB150').$user['profile_pic'].'" width="100" height="100" id="display_user_profile_pic" />';
        }
        else {
          echo '<img src="'.Config::get('constants.FRONT_IMAGE').'user.png" width="100" height="100" id="display_user_profile_pic" />';
        }
        ?>
      </span>
      <span style="width: 75%;float:right;display:inline-block;">
        <p><b>{{ $user['firstname']." ".$user['lastname'] }}</b></p>
        <p>{{ $user['customer_detail']['cities'].",".$user['customer_detail']['states'].", ".$user['country']." - ".$user['zipcode']}}</p>
        
        <a  href="{!! url('/viewBooking/'.$booking['booking_id']) !!}" style="font-size: 16px;">View Booking</a>
      </span>
    </div>
    <br><br>
    <!-- </div> -->

    To confirm or reject booking or to see more about this customer <a href="{!! url('/viewBooking/'.$booking['booking_id']) !!}">Click here</a> after <a href="{!! url('/') !!}">login</a> to Fitnessity.<br><br>
    After login you can see all your booking requests by <a href="{!! url('/mybooking') !!}">clicking here.</a>

@include('emails.footer')