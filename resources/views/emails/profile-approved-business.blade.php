@include('emails.header')

  	Hello <?=$ProfessionalDetail['firstname'];?> <?=$ProfessionalDetail['lastname'];?>,<br><br>

  	<h2>Congratulations !!!</h2>
    <br><br>
    Your profile is approved by Fitnessity Review Process.
    <br>
    You can now login to Fitnessity and get full access to system. Know who are interested in taking teaching lessons of your sports, and get your booking done in few steps.
	  <br><br>
    <a href="<?php echo url('/');?>">Click here</a> to login into Fitnessity.<br>
    
@include('emails.footer')