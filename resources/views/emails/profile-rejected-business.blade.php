@include('emails.header')

  	Hello <?=$mailData['professionalDetail']['firstname'];?> <?=$mailData['professionalDetail']['lastname'];?>,<br><br>

  	Your profile is rejected by Fitnessity Review Process due to below reason.
  	<br><br>
    <b>Rejected reason :</b> <p><?php echo nl2br($mailData['rejectedReason']); ?></p>
    <br><br>
    Please update your profile and resend it to Fitnessity Review.

@include('emails.footer')