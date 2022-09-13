@include('emails.header')

  	Greetings !!!! 
	<br><br>

	{{ucfirst($inviteeUser->firstname)}} {{ucfirst($inviteeUser->lastname)}} has invited you to join Fitnessity !!<br><br>

	Register yourself to Fitnessity as a Customer or Business to get/provide training of your favorite sport.<br><br>

	<a href="{!! url('/') !!}">Click here</a> to join Fitnessity

@include('emails.footer')