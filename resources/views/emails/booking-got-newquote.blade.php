<!--@include('emails.header')-->
<body style="background-color: #efefef;">
 <header style="background-color: #000; width: 80%; margin: 0 auto;text-align: center;padding: 1% 0px;">
   <div style="background:black;text-align: center; ">
      <img src="https://fitnessity.raursoft.org/public/images/logo-300x63.png" class="header_logo">
    </div>
  </header>

<div class="main_content" style="background-color: #fff; width: 80%; margin: 0 auto;height: auto;box-shadow: 1px 4px 17px #d8d8d8;">
      <div class="container" style="margin-top: -30px;">

       <div class="row" style="text-align: center;">
            <h4>	Hello {!! $booking_user['firstname'] !!} {!! $booking_user['lastname'] !!} !!!</h4>
            <p>Greetings from Fitnessity! This email is to inform you that you have received a new quote for your Instant Match request for {{ @$sportsList[$UserBookingDetail['sport']] }}. To get started, view the details below. </p>
        </div>


<h4>Quote:</h4>
<p>{{$quote_user['address']}}</p>
 <p>@if(!is_null($UserBookingDetail['zipcode'])) Zipcode: {{ $UserBookingDetail['zipcode'] }}<br>@endif</p>
 <p>Below is more details.</p>
<div class="greetings">
          <h4 style="text-align: center;color: #f53b49;"><b>Business Detail</b></h4>
          <hr>
       <p> {{ $quote_user['total_quotes'] }}/{{$quote_user['max_quotes']}} Quotes Submitted in this area.</p>
<p>Business details are fine.</p>

       
<p>
 Your Next Steps :
Take your time to review the offer(s) you have received. If you have any questions, want to negotiate the price,  please contact the provider below. If you like what you see, complete the booking.
</p>
        </div>
      
 <div id="outer" style="text-align: center; width: 100%;">
  <div class="inner" style="display: inline-block;"> <a  href="{!! url('/') !!}" style="
    color: #fff;
    font-size: 18px;
    transition: 0.5s;
    background: #f53b49;
    padding: 5px 15px;
    text-decoration: none;
    cursor: pointer !important;
    border: 1px solid #f53b49;">Messgae</a></div>
  <div class="inner" style="display: inline-block; text-align: center;"> <a href="{!! url('/') !!}" style="
    color: #fff;
    font-size: 18px;
    transition: 0.5s;
    background: #f53b49;
    padding: 5px 15px;
    text-decoration: none;
    cursor: pointer !important;
    border: 1px solid #f53b49;"> Complete Booking</a></div>
  <div class="inner" style="display: inline-block;"> <a href="{!! url('/') !!}" style="
    color: #fff;
    font-size: 18px;
    transition: 0.5s;
    background: #f53b49;
    padding: 5px 15px;
    text-decoration: none;
    cursor: pointer !important;
    border: 1px solid #f53b49;">Pass</a></div>
  <div class="inner" style="display: inline-block;"> <a href="{!! url('/') !!}" style="
    color: #fff;
    font-size: 18px;
    transition: 0.5s;
    background: #f53b49;
    padding: 5px 15px;
    text-decoration: none;
    cursor: pointer !important;
    border: 1px solid #f53b49;">Report</a></div>
</div>
<!--<a href="{!! url('/') !!}">Click here</a> to view all quotes for this lesson <a href="{!! url('/') !!}">Messgae</p>-->
<!--<a href="{!! url('/') !!}">Click here</a> to view all quotes for this lesson <a href="{!! url('/') !!}">Complete Booking</p>-->
<!--<a href="{!! url('/') !!}">Click here</a> to view all quotes for this lesson <a href="{!! url('/') !!}">Pass</a> </p>-->
           
            <p><a href="{!! url('/') !!}">Click here</a> to view all quotes for this lesson <a href="{!! url('/') !!}">login</a> to Fitnessity.</p>
            
        
            <p><a href="{!! url('/mypostedjobs') !!}">Click here</a> to see all your bookings after login.
            
            </div>
  <footer style="background-color: #000; width: 80%; margin: 0 auto;text-align: center;padding: 1% 0px;">
    <div style="text-align: center;background: black;padding: 7px; ">
      <a href="https://www.facebook.com/fitnessityofficial/" ><img src="https://pngimg.com/uploads/facebook_logos/facebook_logos_PNG19751.png" class="img-fluid footer_icon" style="width: 50px;"></a>
      <a href="https://twitter.com/Fitnessitynyc" ><img src="https://image.flaticon.com/icons/png/512/124/124021.png"  class="img-fluid footer_icon" style="width: 35px;margin-right: 10px;"></a>
      <a href="https://www.linkedin.com/company/fitnessity/" ><img src="https://cdn2.iconfinder.com/data/icons/on-point-social-media/141/LinkedIn-512.png"  class="img-fluid footer_icon" style="width: 35px; border-radius: 1px;"></a>
    </div>
    
  </footer>
  
  </body>