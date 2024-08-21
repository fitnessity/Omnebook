@include('emails.header')
Hello {!! $mailObj['firstname'] !!} {!! $mailObj['lastname'] !!}, 
<br><br>

<p><h4>We have added new courses for {!! $mailObj['main_sport'] !!}. So please select specific course from your profile for which you provide services.</h4></p>
<p><h4>Incase you don't update your profile, interested persons will not be able to find you on Fitnessity. So <a>Update Your Profile</a> now!</h4></p>

@include('emails.footer')