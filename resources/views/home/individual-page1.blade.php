@extends('layouts.profile')
<style>
    *{
  margin: 0;
  padding: 0;
  box-sizing: border-box;
}
body{
	font-family: Poppins,Helvetica Neue,Helvetica,Arial,sans-serif;
}
.banner{
	/*background-image: url(img/banner1.jpg);*/
	background-repeat: no-repeat;
	background-size: cover;
	min-height: 427px;
	position: relative;
}
.banner-content{
	position: absolute;
	bottom: 20px;
	color: #fff;
}
.banner-content h1{
	font-size: 48px;
    line-height: 54px;
    font-weight: 900
}
.write_a_review_btn{
	background-color: #f43939;
	color: #fff;
	font-weight: bold;
}
.banner .star_btn{
	display: flex;
	margin: 10px 0px;
}
.star_btn .btn{
	margin: 0 2px;
    font-size: 14px;
    padding: 3px 8px;
}
.star_btn h5{
	margin: 7px;
	font-weight: bold;
	font-size: 17px;
}
.star_btn .label{
	font-size: 13px;
	background-color: #464646d1;
	padding: 4px 8px;
	border-radius: 2px;
}
.open_time{
	font-size: 17px;
}
.open_time span{
	color: #09a882;
}
h5.Unclaimed{
	font-size: 18px;
}
.covid-alert h6{
	margin: 30px 0px;
}

.sidebox1 a{
	color: #3ba0a9;
	font-weight: bold;
}
.sidebox1 h5{
	font-size: 17px;
	font-weight: 600;
	color: #676565;
}
.sidebox1 p{
	font-size: 15px;
	color: #676565;
	margin-bottom: 0px;
}
.sidebox1,.sidebox2{
	border: 1px solid lightgray;
	border-radius: 5px;
	padding: 25px;
}
.sidebox2 h6{
	font-weight: bold;
	margin: 20px 0px 10px;
}
.sidebox2 p{
	font-size: 15px;
	color: gray;
}
.btn-outline-secondary{
	font-weight: 600;
	color: #4e4e4e;
}
.btn-outline-secondary:hover{
	transition: 0.9s;
}
.map_content{
	position: relative;
}
.get_direction{
	position: absolute;
	right: 0;
	top: 0;
}
.edit_business_info{
	color: #3ba0a9;
}
.Unclaimed .label{
	font-size: 13px;
	background-color: #464646d1;
	padding: 4px 8px;
	border-radius: 2px;
}
.sponsored{
	color: gray;
	font-size: 14px;
}
h6.heading {
    font-size: 20px;
    font-weight: 700;
}
.comment_section .star_btn{
	display: flex;
}
.comment_section .comment{
    margin: 10px 0 5px;
    font-size: 15px;
}
.comment_section .comment span a{
	font-weight: 600;
	color: #3ba0a9;
}
.comment_author{
	color: gray;
	font-size: 13px;
}
.comment_img{
	width: 100px;
    border-radius: 5px;
}
</style>
@section('content')
<section class="direc-hire">
    <div class="banner">
    <div class="container">
      <div class="banner-content">
        <h1>{{$company->dba_business_name}}</h1>
        <div class="star_btn">
          <button class="btn write_a_review_btn"><i class="fa fa-star"></i></button>
          <button class="btn write_a_review_btn"><i class="fa fa-star"></i></button>
          <button class="btn write_a_review_btn"><i class="fa fa-star"></i></button>
          <button class="btn write_a_review_btn"><i class="fa fa-star"></i></button>
          <button class="btn write_a_review_btn"><i class="fa fa-star"></i></button>
          <h5>5 reviews <span class="label">Details</span></h5>
        </div>
        <div class="banner_btm_content">
          <h5 class="Unclaimed">Claimed . {{$company->dba_business_name}} <span class="label">Edit</span></h5>
          <h5 class="open_time"><span>Open</span> 11:00AM - 1:30PM</h5>
        </div>
      </div>
    </div>
  </div>
  
  <br>

  <div class="container">
    <div class="row">
      <div class="col-md-8">
        <button class="btn btn-danger write_a_review_btn"><i class="fa fa-star-o"></i> Write a Review</button>
        <button class="btn btn-outline-secondary"><i class="fa fa-camera" aria-hidden="true"></i> Add Photo</button>
        <button class="btn btn-outline-secondary"><i class="fa fa-share-square-o" aria-hidden="true"></i> Share</button>
        <hr>
        <div class="covid-alert">
          <h6 class="heading">COVID-19 Updates</h6>
          <p>{{$company->about_company}}</p>
          <hr>
        </div>
        <h6 class="heading">Location & Hours</h6><br>
          <div class="row">
            <div class="col-md-6">
              <iframe src="{{'https://www.google.com/maps/embed/v1/place?key=AIzaSyCK4fSC1gA6qWJTio-djkKgW8WgS9vQG48&q='.$company->latitude.','.$company->longitude}}" width="100%" height="150" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
              <div class="map_content">
                <h5>{{$company->city}}</h5>
                <p>{{$company->address}}</p>
                <button type="button" class="btn btn-outline-secondary get_direction">Get directions</button>
              </div>
            </div>
            <div class="col-md-6">
                @if($user_professional_detail->availability != null)
              <h6><b>Mon &nbsp;&nbsp; {{$user_professional_detail->availability->monday_start}} - {{$user_professional_detail->availability->monday_end}}</b></h6>
              <h6><b>Tue &nbsp;&nbsp;&nbsp; {{$user_professional_detail->availability->tuesday_start}} - {{$user_professional_detail->availability->tuesday_end}}</b></h6>
              <h6><b>Wed &nbsp;&nbsp; {{$user_professional_detail->availability->wednesday_start}} - {{$user_professional_detail->availability->wednesday_end}}</b></h6>
              <h6><b>Thu &nbsp;&nbsp;&nbsp; {{$user_professional_detail->availability->monday_start}} - {{$user_professional_detail->availability->monday_end}}</b></h6>
              <h6><b>Fri &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; {{$user_professional_detail->availability->friday_start}} - {{$user_professional_detail->availability->friday_end}}</b></h6>
              <h6><b>Sat &nbsp;&nbsp;&nbsp;&nbsp; {{$user_professional_detail->availability->saturday_start}} - {{$user_professional_detail->availability->saturday_end}}</b></h6>
              <h6><b>Sun &nbsp;&nbsp;&nbsp; {{$user_professional_detail->availability->sunday_start}} - {{$user_professional_detail->availability->sunday_end}}</b></h6><br>
              @else
              <h6><b>Mon &nbsp;&nbsp; -</b></h6>
              <h6><b>Tue &nbsp;&nbsp;&nbsp; -</b></h6>
              <h6><b>Wed &nbsp;&nbsp; -</b></h6>
              <h6><b>Thu &nbsp;&nbsp;&nbsp; -</b></h6>
              <h6><b>Fri &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; -</b></h6>
              <h6><b>Sat &nbsp;&nbsp;&nbsp;&nbsp; -</b></h6>
              <h6><b>Sun &nbsp;&nbsp;&nbsp; -</b></h6><br>
              @endif
              <a href="#">
                <h6 class="edit_business_info"><b><i class="fa fa-pencil" aria-hidden="true"></i> Edit business Info</b></h6>
              </a>
            </div>
          </div>
          <hr>
          <div class="comment_section">
            <h6 class="heading">You Might Also Consider <span class="sponsored">Sponsored</span></h6><br>
            <div class="row">
              <div class="col-md-2">
                <img src="https://s3-media0.fl.yelpcdn.com/bphoto/705mSY8sb2A4q2XKYtuRQw/60s.jpg" class="comment_img">
              </div>
              <div class="col-md-10">
                <h6><b>Body Mechanix Fitness</b></h6>
                <div class="star_btn">
                  <button class="btn write_a_review_btn"><i class="fa fa-star"></i></button>
                  <button class="btn write_a_review_btn"><i class="fa fa-star"></i></button>
                  <button class="btn write_a_review_btn"><i class="fa fa-star"></i></button>
                  <button class="btn write_a_review_btn"><i class="fa fa-star"></i></button>
                  <button class="btn write_a_review_btn"><i class="fa fa-star"></i></button>
                  <h5>23</h5>
                </div>
                <p class="comment">Kellen H. said"I signed up for this gym because it's close to my house. I hadn't been to the gym in over 6 months and really needed to kick start my fitness. It's been 12 weeks and I feel great! Although I've only been seeing Troy 1x/week for…" <span><a href="#">read more</a></span></p>
                <p class="comment_author">in Martial Arts</p>
              </div>
            </div>
<br>
            <div class="row">
              <div class="col-md-2">
                <img src="https://s3-media0.fl.yelpcdn.com/bphoto/705mSY8sb2A4q2XKYtuRQw/60s.jpg" class="comment_img">
              </div>
              <div class="col-md-10">
                <h6><b>Body Mechanix Fitness</b></h6>
                <div class="star_btn">
                  <button class="btn write_a_review_btn"><i class="fa fa-star"></i></button>
                  <button class="btn write_a_review_btn"><i class="fa fa-star"></i></button>
                  <button class="btn write_a_review_btn"><i class="fa fa-star"></i></button>
                  <button class="btn write_a_review_btn"><i class="fa fa-star"></i></button>
                  <button class="btn write_a_review_btn"><i class="fa fa-star"></i></button>
                  <h5>23</h5>
                </div>
                <p class="comment">Kellen H. said"I signed up for this gym because it's close to my house. I hadn't been to the gym in over 6 months and really needed to kick start my fitness. It's been 12 weeks and I feel great! Although I've only been seeing Troy 1x/week for…" <span><a href="#">read more</a></span></p>
                <p class="comment_author">in Martial Arts</p>
              </div>
            </div>
          </div>
      </div>







      <div class="col-md-4">
        <div class="sidebox1">
            <div class="row">
              <div class="col-md-10">
                <a href="#">{{$company->website}}</a>
              </div>
              <div class="col-md-2">
                <i class="fa fa-external-link" aria-hidden="true"></i>
              </div>
            </div>
            <hr>
            <div class="row">
              <div class="col-md-10">
                <h5>{{$company->contact_number}}</h5>
              </div>
              <div class="col-md-2">
                <i class="fa fa-phone" aria-hidden="true"></i>
              </div>
            </div>
            <hr>
            <div class="row">
              <div class="col-md-10">
                <a href="#">Get Directions</a>
                <p>{{$company->address}}</p>
              </div>
              <div class="col-md-2">
                <i class="fa fa-location-arrow" aria-hidden="true"></i>
              </div>
            </div>
        </div>
<br>
        <div class="sidebox2">
          <div class="row">
            <div class="col-md-6">
              <img src="https://s3-media0.fl.yelpcdn.com/assets/public/40x40_claim_your_page_v2@2x.yji-3cb722f5f279036ab19cd949748f4296.png" class="img-fluid">
            </div>
            <div class="col-md-6">
              <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
          </div>
          <h6>Is this your business?</h6>
          <p>Claim your business to immediately update business information, respond to reviews, and more!</p>
          <!--<button type="button" class="btn btn-outline-secondary">Claim This Business</button>-->
          <button type="button" class="btn btn-outline-secondary">Claimed</button>
        </div>
      </div>
    </div>
 
    
  </div>
<br>
</section>
<script>
    $(document).ready(function(){
        var imageUrl = "<?php echo Config::get('constants.USER_IMAGE_THUMB'); ?>"
        var logo = "{{$company->logo}}"
       // console.log(imageUrl)
       imageUrl = imageUrl+logo
    					
        $(".banner").css("background-image", "url(" + imageUrl + ")");
    })
</script>
@endsection