@include('emails.header')
  <!-- <strong>Suggestions:</strong> -->
  <p>{!! $data['content'] !!}</p><br><br>

  <a href="{!! url('/unsubscribe') !!}">Click here</a> to Unsubscribe<br>
  
@include('emails.footer')