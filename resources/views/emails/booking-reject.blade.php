@include('emails.header')

  	Hello {!! $BookingDetail['user']['firstname'] !!} {!! $BookingDetail['user']['lastname'] !!},<br><br>

  	{{ $BookingDetail['businessuser']['firstname'] }} {{ $BookingDetail['businessuser']['lastname'] }} has passed on your request to hire @if($BookingDetail['businessuser']['gender'] == "Male")him @else her @endif for {{ @$sportsList[$BookingDetail['user_booking_detail']['sport']] }} lessons due to schedule conflict. <br>
    We appologize for the inconvenience. <br><br>
    We want to help get you a lesson fast. Here are your options. You can use our Quick Hire option. This option makes the professionals email you if they are interested. Or we have found several professionals in your area based on your request that can perform the service. <a href="{!! url('/') !!}">Click here</a> to see Professionals in your area.
	<br><br>

    <br>
	<a href="{!! url('/viewBooking/'.$BookingDetail['id']) !!}">Click here</a> to know more about this request after <a href="{!! url('/') !!}">login</a> to Fitnessity.<br>
	<a href="{!! url('/mypostedjobs') !!}">Click here</a> to see all your bookings after login.
    
@include('emails.footer')