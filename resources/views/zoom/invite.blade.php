@include('emails.header')

  	Greetings !!!! 
	<br><br>

	{{ucfirst($user->firstname)}} {{ucfirst($user->lastname)}} has invited you to join the Meeiing !!<br><br>
	Meeting password id = {{$user->password}};
	<a href="{{route('call',['id'=>$user->mid,'user_id'=>$user->user_id])}}">Click here</a> to join meeting

@include('emails.footer')