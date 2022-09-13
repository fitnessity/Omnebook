@include('emails.header')

  Hello {!! $admin['firstname'] !!} {!! $admin['lastname'] !!},<br><br>


  {!! $reported_user_name !!} has reported a post/comment. Please see below details.<br><br>
  @if($is_post_reported)
    <strong>Reported Post Post:</strong> {!! $data['content'] !!}<br>
    <strong>Post's Owner:</strong> {!! $data['User']['firstname'] !!} {!! $data['User']['lastname'] !!} ({!! $data['User']['email'] !!})<br>
  @else
    <strong>Post Title:</strong> {!! $data['content'] !!}<br>
    <strong>Post's Owner:</strong> {!! $data['User']['firstname'] !!} {!! $data['User']['lastname'] !!} ({!! $data['User']['email'] !!})<br>
    <p>@if(isset($data['timelineComments']) && isset($data['timelineComments'][0]))<strong>Comment Description:</strong> {!! $data['timelineComments'][0]['content'] !!}<br> 
    <strong>Comment's Owner:</strong> {!! $data['timelineComments'][0]['user']['firstname']!!} {!! $data['timelineComments'][0]['user']['lastname']!!}
  @endif
  </p>
  @endif
 
  <br>
  <strong>Reported By:</strong> {!! $reported_user_name !!}({!! $report_user_email !!})<br>
  <strong>Report Notes:</strong> {!! $report_notes !!}<br><br>
  <a href="{!! url('/admin/reportedfeeds/view/'.$id) !!}">Click here</a> to view this post detail after login to Fitnessity.
  
@include('emails.footer')