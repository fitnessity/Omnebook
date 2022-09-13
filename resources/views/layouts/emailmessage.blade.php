@include('emails.header')

    Hello {!! $mail_data['touser']['firstname'] !!} {!! $mail_data['touser']['lastname'] !!}, 
    <br>
    Below is a message from {!! $mail_data['fromuser']['firstname'] !!} {!! $mail_data['fromuser']['lastname'] !!} for project : {{ $mail_data['sportsName']}} Training.
    <br><br>
    {!! $mail_data['date'] !!}<br><br>
	{!! $mail_data['message'] !!}<br>
    <center style="padding-top: 35px;">
    	<a href="{!! url('/messages/view/'.$mail_data['booking_id']) !!}" style="background:#f53b49;
    color: #fff;width: auto;font-size: 16px;padding:10px;text-decoration: none;">View Message -></a>
	</center>

@include('emails.footer')