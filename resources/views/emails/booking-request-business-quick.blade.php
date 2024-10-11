<!DOCTYPE html>
<html lang="en">
<head>
  <title>Bootstrap Example</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
  <style>
    p {
    color: #8c8b8b;
    font-weight: 400;
}
    h5 {
    color: #5d5d5d;
}

    .send_quote_btn{
      margin: 0 39%;
      color: #fff;
    font-size: 18px;
    transition: 0.5s;
    background: #f53b49;
    padding: 5px 15px;
    border: 1px solid #f53b49;
    }
    iframe {
    height: 200px;
    width: 100%;
}
.main_content .container {
    padding: 0px 5%;
}
</style>
</head>
<body style="background-color: #efefef;">
  <header style="background-color: #000; width: 80%; margin: 0 auto;text-align: center;padding: 1% 0px;">
   <div style="background: black;text-align: center;">
      <img src="https://fitnessity.raursoft.org/public/images/logo-300x63.png" class="header_logo">
    </div>
  </header>
  <div class="main_content" style="background-color: #fff; width: 80%; margin: 0 auto;height: auto;box-shadow: 1px 4px 17px #d8d8d8;">
    <div class="map_div" style="width:600;height:450;">
      <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m12!1m3!1d15258072.40570261!2d82.75252935!3d20.98801345!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!5e0!3m2!1sen!2sin!4v1593250830057!5m2!1sen!2sin" width="600" height="450" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>

    </div>
    <div class="container">
    <div class="row">
      <div class="col-md-3">
        <div style="padding-left: 27px;padding-top: 21px;">
          <img src="https://fitnessity.raursoft.org/public/uploads/profile_pic/thumb/{{$user['profile_pic']}}" style="width: 100px;" class="img-fluid">
        </div>
      </div>
      <div class="col-md-9" style="padding-left: 27px;">
        <h4>{{ @$user['firstname']." ".@$user['lastname'] }}</h4>
        <p>{{@$user['customer_detail']['cities']." ".@$user['customer_detail']['states']."  ".@$user['country']." - ".@$user['zipcode']}}</p>
       
      </div>
    </div>
    <div style="padding: 0px 27px;">
      <p style="text-algn:center">Greetings from Fitnessity!</p>
      <h4 style="text-algn:center"><b>Lesson Details</b></h4>
      <p>{{ @$user['firstname']." ".@$user['lastname'] }} is looking for {{@$booking['jobpostquestions'][19]['answer']}} training in {{@$user['customer_detail']['cities']." ".@$user['customer_detail']['states']." ".@$user['country']."  ".@$user['zipcode']}}
He has requested for {{ $booking['jobpostquestions'][0]['answer'] }} professionals to send him a quote.

Get started by submitting your quote for this verified client.

</p>
    </div>
    <br>
    <div style="padding-left: 27px;">
      <h4 style="text-algn:center; margin-top:0px"><b>Customer Details</b></h4>
      <?php $jobpostquestions = $booking['jobpostquestions']; ?>
      @if(count($jobpostquestions) > 0)              
        @foreach($jobpostquestions as $k => $job)
          <h5>{{$job['question']}}</h5>
            <p>
              @if($job['full_answer'] == '')
                {{$job['answer']}}
              @else
                {{$job['full_answer']}}
              @endif
            </p>
            <p>{{$job['other']}}</p>
            <hr>
            <br>
        @endforeach
      @endif
     
     <p>Your Next Steps </p>
  <p>Please read the details of the instant match and decide if you are qualified, interested and available to meet {{ @$user['firstname']." ".@$user['lastname'] }} needs. Then respond to {{ @$user['firstname']." ".@$user['lastname'] }} by clicking the button “Respond To Match” below. Send a personalized message, a competitive price, and details about how you are the right professional for them.</p>
     
     
   <div id="outer" style="text-align: center; width: 100%;">
  <div class="inner" style="display: inline-block;"> <a href="{!! url('/') !!}" style="
    color: #fff;
    font-size: 18px;
    transition: 0.5s;
    background: #f53b49;
    padding: 5px 15px;
    text-decoration: none;
    cursor: pointer !important;
    border: 1px solid #f53b49;">Respond To Match</a></div>
  <div class="inner" style="display: inline-block; text-align: center;"> <a href="{!! url('/') !!}" style="
    color: #fff;
    font-size: 18px;
    transition: 0.5s;
    background: #f53b49;
    padding: 5px 15px;
    text-decoration: none;
    cursor: pointer !important;
    border: 1px solid #f53b49;"> Pass</a></div>
  <div class="inner" style="display: inline-block;"> <a href="{!! url('/') !!}" style="
    color: #fff;
    font-size: 18px;
    transition: 0.5s;
    background: #f53b49;
    padding: 5px 15px;
    text-decoration: none;
    cursor: pointer !important;
    border: 1px solid #f53b49;">Report</a></div>
</div>
      <div class="signature_text">
        <p>Regards,</p>
        <p>Team Fitnessity <br>
Unleash the Power of Sports</p>
      </div>
      <br>
      <a href="{!! url('/booking/postquote/'.$booking['booking_id']) !!}" style="margin: 0 39%;color: #fff;
    font-size: 18px;
    transition: 0.5s;
    background: #f53b49;
    padding: 5px 15px;
    text-decoration: none;
    border: 1px solid #f53b49;">Send Quote</a>
      <br>
      <br><br>
    </div>
  </div>
  </div>

  <footer style="background-color: #000; width: 80%; margin: 0 auto;text-align: center;padding: 1% 0px;">
    <div style="text-align: center;background: black;padding: 7px; ">
      <a href="https://www.facebook.com/fitnessityofficial/" ><img src="https://pngimg.com/uploads/facebook_logos/facebook_logos_PNG19751.png" class="img-fluid footer_icon" style="width: 50px;"></a>
      <a href="https://twitter.com/Fitnessitynyc" ><img src="https://image.flaticon.com/icons/png/512/124/124021.png"  class="img-fluid footer_icon" style="width: 35px;margin-right: 10px;"></a>
      <a href="https://www.linkedin.com/company/fitnessity/" ><img src="https://cdn2.iconfinder.com/data/icons/on-point-social-media/141/LinkedIn-512.png"  class="img-fluid footer_icon" style="width: 35px; border-radius: 1px;"></a>
    </div>
    
  </footer>
    
  </div> 
</body>
</html>
