@include('emails.header')
Hello {!! $user->firstname !!} {!! $user->lastname !!}, 
<br><br>

Click here to reset your password:<br><br>

<a href="{!! url('password/reset?token='.$token) !!}">{{ url('password/reset/?token='.$token) }}</a>

@include('emails.footer')