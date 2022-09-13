@include('emails.header')
  	Hello <?=$mailData['professionalDetails']->firstname; ?> <?=$mailData['professionalDetails']->lastname; ?>,<br><br>

    Thank you for submitting your profile to Fitnessity Review Process. <br>
    Please wait while we review it. You will get full Fitnessity access once your profile is approved.

@include('emails.footer')