@include('emails.header')

  	Hello {!! $professional['firstname'] !!} {!! $professional['lastname'] !!},<br><br>

	<h2>Congratulations !!!<h2>
        <br><br>
        Your have been awarded for a lesson of <a href="{!! url('/') !!}"> {{ @$sportsList[$booking['user_booking_detail']['sport']] }} </a> by <a href="{!! url('/') !!}">{{ $user['firstname'] }} {{ $user['lastname'] }}</a>        
	<br><br>
        You need to confirm this request by login to Fitnessity
        <br>
        <br><br>
        <a href="{!! url('/viewBoking/'.$booking['booking_id']) !!}">Click here</a> to confirm or reject this booking after <a href="{!! url('/') !!}">login</a> to Fitnessity.<br>
    
@include('emails.footer')