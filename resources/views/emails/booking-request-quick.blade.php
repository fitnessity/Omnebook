<!--@include('emails.header')-->

<body style="background-color: #efefef;">
 <header style="background-color: #000; width: 80%; margin: 0 auto;text-align: center;padding: 1% 0px;">
    <div style="background:black;text-align: center; ">
      <img src="https://fitnessity.raursoft.org/public/images/logo-300x63.png" class="header_logo">
    </div>
  </header>
  
    <div class="main_content" style="background-color: #fff; width: 80%; margin: 0 auto;height: auto;padding-left:27px;box-shadow: 1px 4px 17px #d8d8d8;">
        <p style="margin-top:15px">
  	Hello {!! $user['firstname'] !!} {!! $user['lastname'] !!},</p><br>


<p>
Thank you for booking with the Fitnessity Instant Match. This email is to inform you that we have received your match request and your match request has been send out to qualified professionals. </p>
	<br>

	

    <h1><center><b style="color:red">Booking Details</b></center></h1>

    <hr><br>

    
<p>Participant Name : {!! $user['firstname'] !!}</p>
      <p>Activity Booked: {{ $sportsList[$booking['user_booking_detail']['sport']] }} </p>

      <p>Zipcode: {{ $booking['user_booking_detail']['zipcode'] }}</p>

      <p>Matches: 0/{{ $booking['jobpostquestions'][0]['answer'] }}</p>

     <br>
<p><b> Your Next Step</b></p>
Stay up to date and please continue to check your emails & notifications to respond to quotes & professionals fast. Once you receive a notification or email, you can read the quote, respond, negotiate, or accept the offer. Once you have found the right pro, complete the booking process. You and the professional will be notified of the booking.
Click here to know more about this Instant Match request after you log in to Fitnessity.

    <br>

	<a href="{!! url('/viewBooking/'.$booking['booking_id']) !!}">Click here</a> to know more about this request after <a href="{!! url('/') !!}">login</a> to Fitnessity.<br><br>

	<a href="{!! url('/mybooking') !!}">Click here</a> to see all your bookings after login.

   </div> 
  <footer style="background-color: #000; width: 80%; margin: 0 auto;text-align: center;padding: 1% 0px;">
    <div style="text-align: center;background: black;padding: 7px; ">
      <a href="https://www.facebook.com/fitnessityofficial/" ><img src="https://pngimg.com/uploads/facebook_logos/facebook_logos_PNG19751.png" class="img-fluid footer_icon" style="width: 50px;"></a>
      <a href="https://twitter.com/Fitnessitynyc" ><img src="https://image.flaticon.com/icons/png/512/124/124021.png"  class="img-fluid footer_icon" style="width: 35px;margin-right: 10px;"></a>
      <a href="https://www.linkedin.com/company/fitnessity/" ><img src="https://cdn2.iconfinder.com/data/icons/on-point-social-media/141/LinkedIn-512.png"  class="img-fluid footer_icon" style="width: 35px; border-radius: 1px;"></a>
    </div>
    
  </footer>
  
  </body>