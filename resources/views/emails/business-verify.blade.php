@include('emails.header')
Hello , 
<br><br>

Click here to verify your business:<br><br>

<a href="{!! url('verify-my-business/reset?code='.$code) !!}">{{ url('verify-my-business/reset?code='.$code) }}</a>

@include('emails.footer')