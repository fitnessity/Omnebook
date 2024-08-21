@include('emails.header')

    Hello {!! $BookingDetail['businessuser']['firstname'] !!} {!! $BookingDetail['businessuser']['lastname'] !!}, 
    <br><br>

    You have rejected a booking request of {!! $BookingDetail['user']['firstname'] !!} {!! $BookingDetail['user']['lastname'] !!} for {{ @$sportsList[$BookingDetail['user_booking_detail']['sport']] }} lessons.<br><br>

    Reason for rejection is: {{ $BookingDetail['rejected_reason'] }}<br><br>

    <a href="{!! url('/viewBooking/'.$BookingDetail['id']) !!}">Click here</a> to know more about this request after <a href="{!! url('/') !!}">login</a> to Fitnessity.<br>
    After login you can see all your booking requests by <a href="{!! url('/mybooking') !!}">clicking here.</a>

@include('emails.footer')