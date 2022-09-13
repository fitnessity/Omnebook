@include('emails.header')
  	Hello <?=$mailData['adminDetails']->firstname; ?> <?=$mailData['adminDetails']->lastname; ?>,<br><br><br>

    <?=$mailData['professionalDetails']['firstname']; ?> <?=$mailData['professionalDetails']['lastname']; ?> has submitted profile for Fitnessity Review.
    <br><br>

    Below is profile detail.
    <br><br>
    <b>Professional's Name :</b> <?=$mailData['professionalDetails']['firstname']; ?> <?=$mailData['professionalDetails']['lastname']; ?><br>
    <b>Email :</b> <?=$mailData['professionalDetails']['email']; ?><br>
    <b>Phone Number :</b> <?=@$mailData['professionalDetails']['phone_number']; ?><br>
    <b>Company Name :</b> <?=@$mailData['professionalDetails']['company_name']; ?>

    <br><br>
    <a href="<?php echo url('/admin/professionals/view/'.$mailData['professionalDetails']['id']);?>">Click here</a> to view full profile.
  	
@include('emails.footer')