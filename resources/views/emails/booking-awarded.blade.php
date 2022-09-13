@include('emails.header')

  	Hello {!! $user['firstname'] !!} {!! $user['lastname'] !!},<br><br>

	<br>
        We have successfully placed your booking request for <a href="{!! url('/') !!}"> <u> {{ $professional['firstname'] }} {{ $professional['lastname'] }} </u> </a> to learn a lesson of a href="{!! url('/') !!}"> {{ @$sportsList[$booking['user_booking_detail']['sport']] }} </a>
        <br><br>
        Please wait for professional's confirmation on this.
        <br>
        <br><br>
        <a href="{!! url('/viewBoking/'.$booking['booking_id']) !!}">Click here</a> to login into Fitnessity.<br>
    
@include('emails.footer')