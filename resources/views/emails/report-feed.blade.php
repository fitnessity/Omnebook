@include('emails.header')

  Hello {!! $reported_user_name !!},<br><br>

  Thank you for writing to us! We will definitely look into this.
  <br><br>
  Below are details you reported:<br><br>
  <strong>Post Title:</strong> {!! $data['content'] !!}<br>
  <strong>Post's Owner:</strong> {!! $data['User']['firstname'] !!} {!! $data['User']['lastname'] !!}<br>
  <p>@if(isset($data['timelineComments']) && isset($data['timelineComments'][0]))<strong>Comment Description:</strong> {!! $data['timelineComments'][0]['content'] !!}<br> 
    <strong>Comment's Owner:</strong> {!! $data['timelineComments'][0]['user']['firstname']!!} {!! $data['timelineComments'][0]['user']['lastname']!!}
  @endif
  </p><br>
  <strong>Report Notes:</strong> {!! $report_notes !!}<br><br>


  <a href="{!! url('/') !!}">Click here</a> to to login to Fitnessity.<br>
  
@include('emails.footer')