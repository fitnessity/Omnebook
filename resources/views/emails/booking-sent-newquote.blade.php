@include('emails.header')



  	Hello {{$quote_user['firstname']}} {{ $quote_user['lastname']}} <br><br>



	<p>Greeting from Fitnessity! This email is to inform you that your quote was submitted successfully.</p>

  

        <h1><center><b style="color:red">Next Steps</b></center></h1>
        <p>
Please wait for a response from the customer. If your quote was chosen or the customer would like to message you, we will send you an email when that time comes.
Log in to tack the details of your quote.
</p>
        <hr><br>

        <a href="{!! url('/') !!}">Click here</a> to view all quotes for this lesson <a href="{!! url('/') !!}">login</a> to Fitnessity.<br>

        <a href="{!! url('/mypostedjobs') !!}">Click here</a> to see all your bookings after login.

        

@include('emails.footer')