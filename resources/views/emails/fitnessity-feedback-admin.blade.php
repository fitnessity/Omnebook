@include('emails.header')

  Hello {!! $admin['firstname'] !!} {!! $admin['lastname'] !!},<br><br>

  Fitnessity got one new feedback !
  <br><br>
  Below are details of feedback.<br><br>
  <strong>Name:</strong> {!! $data['name'] !!}<br>
  <strong>Email:</strong> {!! $data['email'] !!}<br>
  <strong>Rating:</strong> {!! $data['rating'] !!}<br>
  <strong>Comments:</strong>
  <p>{!! $data['comment'] !!}</p>
  <strong>Suggestions:</strong>
  <p>{!! $data['suggestion'] !!}</p><br><br>

  <a href="{!! url('/admin') !!}">Click here</a> to to login to Fitnessity.<br>
  
@include('emails.footer')