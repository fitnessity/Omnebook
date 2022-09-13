@include('emails.header')

  Hello {!! $data['name'] !!},<br><br>

  Thank you for writing to us! Your feedback matters to us.
  We will definitely work on to make Fitnessity more better.
  <br><br>
  Below are details you write about us:<br><br>
  <strong>Rating:</strong> {!! $data['rating'] !!}<br>
  <strong>Comments:</strong>
  <p>{!! $data['comment'] !!}</p>
  <strong>Suggestions:</strong>
  <p>{!! $data['suggestion'] !!}</p><br><br>

  <a href="{!! url('/') !!}">Click here</a> to to login to Fitnessity.<br>
  
@include('emails.footer')