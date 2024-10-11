@include('emails.header')

Hello {!! $user->firstname !!} {!! $user->lastname !!}, 
<br><br>

Welcome to Fitnessity !!<br><br>

You can login to Fitnessity using Email address and Password you provided at the time of registration.<br><br>

<a href="{!! url('/') !!}">Click here</a> to login to Fitnessity

@include('emails.footer')