@extends('layouts.profile')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" integrity="sha512-tS3S5qG0BlhnQROyJXvNjeEM4UpMXHrQfTGmbQ1gKmelCxlSEBUaxhRBj/EFTzpbP4RVSrpEikbmdJobCvhE3g==" crossorigin="anonymous" /><style>
.outer { margin:0 auto; max-width:800px;}
#big .item {padding: 0px 0px; margin:2px; color: #FFF; border-radius: 3px; text-align: center; }
#thumbs .item {height:70px; line-height:70px; padding: 0px; margin:8px 4px 0px; color: #FFF;text-align: center; cursor: pointer; }
#thumbs .item h1 { font-size: 18px; }
/*#thumbs .current .item { background:#FF5722; }*/
.owl-theme .owl-nav [class*='owl-'] { -webkit-transition: all .3s ease; transition: all .3s ease; }
.owl-theme .owl-nav [class*='owl-'].disabled:hover { background-color: #D6D6D6; }
#big.owl-theme { position: relative; }
#big.owl-theme .owl-next, #big.owl-theme .owl-prev { background:#ff4d4d; width: 40px;border-radius:50px; line-height:40px; height: 40px; margin-top: -20px; position: absolute; text-align:center; top: 50%; }
#big.owl-theme .owl-prev { left: 10px; }
#big.owl-theme .owl-next { right: 10px; }
.owl-carousel.owl-drag .owl-item{height: 375px !important;}
div#thumbs {
    height: 100px !important;
}
/*.owl-item.active .item img{*/
/*    height: 100px !important;*/
/*}*/
.fa.fa-arrow-right, .fa.fa-arrow-left{color: #fff;}
#thumbs.owl-theme .owl-next, #thumbs.owl-theme .owl-prev { background:#333; }
#sync1 {
  .item {
    background: #0c83e7;
    padding: 80px 0px;
    margin: 5px;
    color: #FFF;
    -webkit-border-radius: 3px;
    -moz-border-radius: 3px;
    border-radius: 3px;
    text-align: center;
  }
}

#sync2 {
  .item {
    background: #C9C9C9;
    padding: 10px 0px;
    margin: 5px;
    color: #FFF;
    -webkit-border-radius: 3px;
    -moz-border-radius: 3px;
    border-radius: 3px;
    text-align: center;
    cursor: pointer;
    h1 {
      font-size: 18px;
    }
  }
  .current .item{
    background: #0c83e7;
  }
}



.owl-theme {
  .owl-nav {
    /*default owl-theme theme reset .disabled:hover links */
    [class*='owl-'] {
      transition: all .3s ease;
      &.disabled:hover {
       background-color: #D6D6D6;
      }   
    }
    
  }
}

//arrows on first carousel
#sync1.owl-theme {
  position: relative;
  .owl-next, .owl-prev {
    width: 22px;
    height: 40px;
    margin-top: -20px;
    position: absolute;
    top: 50%;
  }
  .owl-prev {
    left: 10px;
  }
  .owl-next {
    right: 10px;
  }
}
*{
         margin: 0;
         padding: 0;
         box-sizing: border-box;
         scroll-behavior: smooth;
         }
         body{
         font-family: Poppins,Helvetica Neue,Helvetica,Arial,sans-serif;
         background-color: #ececec;
         }
         .banner-content{
         position: relative;
         top: 260px;
         color: #fff;
         }
         .banner_add a {
         color: #fff;
         margin: 0px 15px;
         }
         .banner-content img{
            border-radius: 50%;
    border: 3px solid #fff;
    width: 90%;
    height: 150px;
    margin: -20px 0px 0px 0px;
         }
         .banner{
         background-image: url(img/banner1.jpg);
         background-repeat: no-repeat;
         background-size: cover;
         min-height: 427px;
         position: relative;
         }
         li.nav-item {
         margin: 8px 15px;
         }
         #photo, #map, #menu_price, #business_info, #price_range, #description, #Amenties, #rating_average, #reviews{
         margin: 30px 0px;
         background: #fdfdfd;
         border-radius: 10px;
         padding: 30px 30px;
         box-shadow: 0px 0px 20px 0px #80808026;
         }
         /*#photo img{
         border-radius: 10px;
         }*/
         #description h5{
         margin-bottom: 23px;
         color: #000;
         }
         #description p{
         color: gray;
         font-size: 15px;
         line-height: 26px;
         }
         #Amenties a{
         color: gray;
         }
         table{
         margin: 30px 0px;
         background: #fdfdfd;
         border-radius: 10px;
         box-shadow: 0px 0px 20px 0px #80808026;
         }
         thead{
         background-color: #4c4b4b;
         color: #fff;
         }
         .table td{
         font-size: 15px;
         color: gray;
         padding: 15px !important;
         }
         #business_info p>a{
         color: #0e0e0d;
         font-size: 15px;
         }
         nav.navbar.navbar-expand-sm.bg-light.navbar-light.sticky-top{
             position: sticky;
             top: 0;
             z-index: 7;
             background-color: #fdfdfd;
             width: 100%;
             padding: 17px 0px;
             box-shadow: 0px 0px 15px 0px #80808066;
         }
         nav.navbar.navbar-expand-sm.bg-light.navbar-light.sticky-top a{
             color: rgba(0,0,0,.5);
             font-size: 16px;
         }
         h3.indi_com_name {
    font-size: 30px;
    margin-bottom: 10px;
}
p.indi_com_para {
    font-size: 17px;
    margin-bottom: 10px;
}
h5.indi_banner_right_cont {
    font-size: 15px !important;
    margin: 40px 0 10px;
}
.banner_save_comment{
    font-size: 15px;
}
.indi_banner_right_cont_b{
    font-size: 18px;
    font-weight: bold;
}
p.business_info_para {
    margin: 20px 0px;
}
h5{
    font-size: 20px !important;
}
iframe{margin-top: 15px !important;}
</style>
@section('content')
<section class="direc-hire">
  <div class="banner">
         <div class="container">
            <div class="banner-content">
               <div class="row">
                  <div class="col-md-2">
                     <img src="<?php echo Config::get('constants.USER_IMAGE_THUMB').$company['logo']; ?>" class="img-fluid" alt="Fitnessity">
                  </div>
                  <div class="col-md-6">
                     <h3 class="indi_com_name">{{$company->company_name}}</h3>
                     <p class="indi_com_para">{{$company->short_description}}</p>
                     <div class="banner_add">
                        <a href="#" style="margin-left: 0px;"><i class="fa fa-phone" aria-hidden="true"></i> {{$company->contact_number}}</a>
                        <a href="#"><i class="fa fa-map-marker" aria-hidden="true"></i> {{$company->address}}</a>
                     </div>
                  </div>
                  <div class="col-md-4" style="text-align: right;">
                     <h5 class="indi_banner_right_cont"><span class="indi_banner_right_cont_b">8.6</span> / 10 Ratings</h5>
                     <p class="banner_save_comment"><i class="fa fa-heart-o" aria-hidden="true"></i> &nbsp; Save &nbsp;| &nbsp; <i class="fa fa-commenting" aria-hidden="true"></i> &nbsp; Submit Review</p>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <!-- Sticky Navbar Start Here -->
      <nav class="navbar navbar-expand-sm bg-light navbar-light sticky-top">
         <div class="container">
            <ul class="navbar-nav">
               <li class="nav-item">
                  <a class="nav-link" href="#description">Description</a>
               </li>
               <li class="nav-item">
                  <a class="nav-link" href="#Amenties">Services</a>
               </li>
               <li class="nav-item">
                  <a class="nav-link" href="#photo">Photos</a>
               </li>
               <li class="nav-item">
                  <a class="nav-link" href="#reviews">Reviews</a>
               </li>
            </ul>
         </div>
      </nav>
      <!-- Sticky Navbar End Here -->
      <div class="container">
      <div class="row">
         <div class="col-md-8">
            <div id="description">
               <h5>Description</h5>
               {{$company->about_company}}
             </div>
            <div id="Amenties">
               <h5>Services</h5>
               <br>
               <div class="row">
                  @foreach($services as $service)
                    <div class="col-md-4">
                        <a href="#">{{$service['amenties']}}</a>
                    </div>
                  @endforeach
               </div>
            </div>
            @if(count($company->company_images) != 0)
            <div id="photo">
                <h5>Photos</h5><br/>
                <div class="outer">
<div id="big" class="owl-carousel owl-theme">
     @foreach($company->company_images as $value)
  <div class="item">
    <img src="<?php echo Config::get('constants.USER_IMAGE_THUMB').$value; ?>" style="width: 100%;border-radius:10px;" alt="Fitnessity"></img>
  </div>
  @endforeach
  
</div>
<div id="thumbs" class="owl-carousel owl-theme">
     @foreach($company->company_images as $value)
  <div class="item">
    <img src="<?php echo Config::get('constants.USER_IMAGE_THUMB').$value; ?>" style="width: 100%;height: 100px;border-radius: 5px;" alt="Fitnessity"></img>
  </div>
   @endforeach
  
</div>
</div>
                
            <div id="sync1" class="owl-carousel owl-theme">
                @foreach($company->company_images as $value)
              <!--<div class="item">-->
              <!--  <img src="<?php echo Config::get('constants.USER_IMAGE_THUMB').$value; ?>" style="width: 100%;"></img>-->
              <!--  </div>-->
                @endforeach
            </div>
            </div>
            @endif
            <div id="reviews">
               <h5>Reviews</h5>
               <br>
               <div class="row" style="border-bottom: 1px solid lightgray;">
                <div class="col-md-2">
                  <img src="https://demoapus.com/cityo/place-demo/wp-content/plugins/wp-first-letter-avatar/images/default/96/latin_o.png" class="img-fluid" alt="Fitnessity">
                </div>
                <div class="col-md-7">
                     <h6><b>Owner</b><br><span style="color: gray;font-size: 13px;">June 18, 2019</span></h6>
                     <p style="color: gray;font-size:13px;">Whilst he may be known to most as one of the greatest American 20th century novelists, to us, Hemingway helped put Cuban cocktails on the map. Lime juice, grapefruit and juice, shaken and strained.</p>
                     <div class="row">
                       <div class="col-md-6">
                         <p style="color: red;">
                      <i class="fa fa-thumbs-o-up" aria-hidden="true"></i> 7 &nbsp;&nbsp; 
                      <span style="color: lightgray;"><i class="fa fa-thumbs-o-down" aria-hidden="true"></i> 1</span> &nbsp;&nbsp; 
                      <span style="color: gray;"><i class="fa fa-heart-o" aria-hidden="true"></i> 5</span></p>
                       </div>
                       <div class="col-md-6" style="text-align: right;">
                         <p style="font-size:13px;"><i class="fa fa-commenting-o" aria-hidden="true"></i> Reply</p>
                       </div>
                     </div>
                  </div>
                  <div class="col-md-3" style="text-align: right;">
                     <h6 style="color: red;"><b>7.8</b><span style="color: gray; font-size: 13px;">/10 Ratings</span></h6>
                  </div>
               </div>
            </div>
         </div>








         <div class="col-md-4">
            <table class="table">
               <thead>
                  <tr>
                     <th>Today </th>
                     <th>
                         <span>
                            @if($user_professional_detail->availability != null) 
                                @if(\Carbon\Carbon::now()->format( 'l' ) == 'Monday')
                                    @if((\DateTime::createFromFormat('h:i a', \Carbon\Carbon::now()->format( 'h:i a' ))) > (\DateTime::createFromFormat('h:i a',$user_professional_detail->availability->monday_start)) && (\DateTime::createFromFormat('h:i a', \Carbon\Carbon::now()->format( 'h:i a' ))) < (\DateTime::createFromFormat('h:i a',$user_professional_detail->availability->monday_end)))
                                        Open
                                    @else
                                        Closed
                                    @endif
                                @endif
                                @if(\Carbon\Carbon::now()->format( 'l' ) == 'Tuesday')
                                    @if((\DateTime::createFromFormat('h:i a', \Carbon\Carbon::now()->format( 'h:i a' ))) > (\DateTime::createFromFormat('h:i a',$user_professional_detail->availability->tuesday_start)) && (\DateTime::createFromFormat('h:i a', \Carbon\Carbon::now()->format( 'h:i a' ))) < (\DateTime::createFromFormat('h:i a',$user_professional_detail->availability->tuesday_end)))
                                        Open
                                    @else
                                        Closed
                                    @endif
                                @endif
                                @if(\Carbon\Carbon::now()->format( 'l' ) == 'Wednesday')
                                    @if((\DateTime::createFromFormat('h:i a', \Carbon\Carbon::now()->format( 'h:i a' ))) > (\DateTime::createFromFormat('h:i a',$user_professional_detail->availability->wednesday_start)) && (\DateTime::createFromFormat('h:i a', \Carbon\Carbon::now()->format( 'h:i a' ))) < (\DateTime::createFromFormat('h:i a',$user_professional_detail->availability->wednesday_end)))
                                        Open
                                    @else
                                        Closed
                                    @endif
                                @endif
                                @if(\Carbon\Carbon::now()->format( 'l' ) == 'Thursday')
                                    @if((\DateTime::createFromFormat('h:i a', \Carbon\Carbon::now()->format( 'h:i a' ))) > (\DateTime::createFromFormat('h:i a',$user_professional_detail->availability->thrusday_start)) && (\DateTime::createFromFormat('h:i a', \Carbon\Carbon::now()->format( 'h:i a' ))) < (\DateTime::createFromFormat('h:i a',$user_professional_detail->availability->thrusday_end)))
                                        Open
                                    @else
                                        Closed
                                    @endif
                                @endif
                                @if(\Carbon\Carbon::now()->format( 'l' ) == 'Friday')
                                    @if((\DateTime::createFromFormat('h:i a', \Carbon\Carbon::now()->format( 'h:i a' ))) > (\DateTime::createFromFormat('h:i a',$user_professional_detail->availability->friday_start)) && (\DateTime::createFromFormat('h:i a', \Carbon\Carbon::now()->format( 'h:i a' ))) < (\DateTime::createFromFormat('h:i a',$user_professional_detail->availability->friday_end)))
                                        Open
                                    @else
                                        Closed
                                    @endif
                                @endif
                                @if(\Carbon\Carbon::now()->format( 'l' ) == 'Saturday')
                                    @if((\DateTime::createFromFormat('h:i a', \Carbon\Carbon::now()->format( 'h:i a' ))) > (\DateTime::createFromFormat('h:i a',$user_professional_detail->availability->saturday_start)) && (\DateTime::createFromFormat('h:i a', \Carbon\Carbon::now()->format( 'h:i a' ))) < (\DateTime::createFromFormat('h:i a',$user_professional_detail->availability->saturday_end)))
                                        Open
                                    @else
                                        Closed
                                    @endif
                                @endif
                                @if(\Carbon\Carbon::now()->format( 'l' ) == 'Sunday')
                                    @if((\DateTime::createFromFormat('h:i a', \Carbon\Carbon::now()->format( 'h:i a' ))) > (\DateTime::createFromFormat('h:i a',$user_professional_detail->availability->sunday_start)) && (\DateTime::createFromFormat('h:i a', \Carbon\Carbon::now()->format( 'h:i a' ))) < (\DateTime::createFromFormat('h:i a',$user_professional_detail->availability->sunday_end)))
                                        Open
                                    @else
                                        Closed
                                    @endif
                                @endif
                            @else 
                                Closed 
                            @endif
                        </span>
                     </th>
                     <th>
                         <span>
                             @if($user_professional_detail->availability != null)
                                @if(\Carbon\Carbon::now()->format( 'l' ) == 'Monday')
                                    {{$user_professional_detail->availability->monday_start}} - {{$user_professional_detail->availability->monday_end}}
                                @endif
                                @if(\Carbon\Carbon::now()->format( 'l' ) == 'Tuesday')
                                    {{$user_professional_detail->availability->tuesday_start}} - {{$user_professional_detail->availability->tuesday_end}}
                                @endif
                                @if(\Carbon\Carbon::now()->format( 'l' ) == 'Wednesday')
                                    {{$user_professional_detail->availability->wednesday_start}} - {{$user_professional_detail->availability->wednesday_end}}
                                @endif
                                @if(\Carbon\Carbon::now()->format( 'l' ) == 'Thursday')
                                    {{$user_professional_detail->availability->thrusday_start}} - {{$user_professional_detail->availability->thrusday_end}}
                                @endif
                                @if(\Carbon\Carbon::now()->format( 'l' ) == 'Friday')
                                    {{$user_professional_detail->availability->friday_start}} - {{$user_professional_detail->availability->friday_end}}
                                @endif
                                @if(\Carbon\Carbon::now()->format( 'l' ) == 'Saturday')
                                    {{$user_professional_detail->availability->saturday_start}} - {{$user_professional_detail->availability->saturday_end}}
                                @endif 
                                @if(\Carbon\Carbon::now()->format( 'l' ) == 'Sunday')
                                    {{$user_professional_detail->availability->sunday_start}} - {{$user_professional_detail->availability->sunday_end}}
                                @endif
                            @else - 
                            @endif
                        </span>
                     </th>
                  </tr>
               </thead>
              <tbody>
                  <tr>
                     <td  @if(($user_professional_detail->availability != null) && (\Carbon\Carbon::now()->format( 'l' ) == 'Monday')) style="color:red" @endif>Monday</td>
                     <td></td>
                     @if($user_professional_detail->availability != null)
                     <td>{{$user_professional_detail->availability->monday_start}} - {{$user_professional_detail->availability->monday_end}}</td>
                     @else
                     <td>-</td>
                     @endif
                  </tr>
                  <tr>
                     <td @if(($user_professional_detail->availability != null) && (\Carbon\Carbon::now()->format( 'l' ) == 'Tuesday')) style="color:red" @endif>Tuesday</td>
                     <td></td>
                      @if($user_professional_detail->availability != null)
                     <td>{{$user_professional_detail->availability->tuesday_start}} - {{$user_professional_detail->availability->tuesday_end}}</td>
                     @else
                     <td>-</td>
                     @endif
                  </tr>
                  <tr>
                     <td @if(($user_professional_detail->availability != null) && (\Carbon\Carbon::now()->format( 'l' ) == 'Wednesday')) style="color:red" @endif>Wednesday</td>
                     <td></td>
                      @if($user_professional_detail->availability != null)
                     <td>{{$user_professional_detail->availability->wednesday_start}} - {{$user_professional_detail->availability->wednesday_end}}</td>
                     @else
                     <td>-</td>
                     @endif
                  </tr>
                  <tr>
                     <td @if(($user_professional_detail->availability != null) && (\Carbon\Carbon::now()->format( 'l' ) == 'Thursday')) style="color:red" @endif>Thursday</td>
                     <td></td>
                      @if($user_professional_detail->availability != null)
                     <td>{{$user_professional_detail->availability->thrusday_start}} - {{$user_professional_detail->availability->thrusday_end}}</td>
                     @else
                     <td>-</td>
                     @endif
                  </tr>
                  <tr>
                     <td @if(($user_professional_detail->availability != null) && (\Carbon\Carbon::now()->format( 'l' ) == 'Friday')) style="color:red" @endif>Friday</td>
                     <td></td>
                      @if($user_professional_detail->availability != null)
                     <td>{{$user_professional_detail->availability->friday_start}} - {{$user_professional_detail->availability->friday_end}}</td>
                     @else
                     <td>-</td>
                     @endif
                  </tr>
                  <tr>
                     <td @if(($user_professional_detail->availability != null) && (\Carbon\Carbon::now()->format( 'l' ) == 'Saturday')) style="color:red" @endif>Saturday</td>
                     <td></td>
                      @if($user_professional_detail->availability != null)
                     <td>{{$user_professional_detail->availability->saturday_start}} - {{$user_professional_detail->availability->saturday_end}}</td>
                     @else
                     <td>-</td>
                     @endif
                  </tr>
                  <tr>
                     <td @if(($user_professional_detail->availability != null) && (\Carbon\Carbon::now()->format( 'l' ) == 'Sunday')) style="color:red" @endif>Sunday</td>
                     <td></td>
                      @if($user_professional_detail->availability != null)
                     <td>{{$user_professional_detail->availability->sunday_start}} - {{$user_professional_detail->availability->sunday_end}}</td>
                     @else
                     <td>-</td>
                     @endif
                  </tr>
               </tbody>
            </table>
            <div id="business_info">
               <div class="row">
                  <div class="col-md-6">
                     <h5 class="busi_info_title">Business Info</h5>
                  </div>
                  <div class="col-md-6" style="text-align: right;">
                     <a href="#" style="color: #000;font-size: 14px;"> <i class="fa fa-hand-o-right" aria-hidden="true" style="color: red;"></i> Get Directions</a>
                  </div>
               </div>
               <iframe src="{{'https://www.google.com/maps/embed/v1/place?key=AIzaSyCK4fSC1gA6qWJTio-djkKgW8WgS9vQG48&q='.$company->latitude.','.$company->longitude}}" width="100%" height="200px" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
               <br><br>
               <p><a href="#"><i class="fa fa-map-marker" aria-hidden="true"></i> &nbsp;&nbsp; {{$company->address}}</a></p>
               <p class="business_info_para"><a href="#"><i class="fa fa-phone" aria-hidden="true"></i> &nbsp;&nbsp; {{$company->contact_number}}</a></p>
               <p class="business_info_para"><a href="#"><i class="fa fa-envelope-o" aria-hidden="true"></i> &nbsp;&nbsp; {{$company->email}}</a></p>
               <p class="business_info_para"><a href="#"><i class="fa fa-globe" aria-hidden="true"></i> &nbsp;&nbsp; {{$company->website}}</a></p>
            </div>
            <div id="price_range">
               <h5>Price Range</h5>
               <br>
               <p style="color: gray;"><span style="color: red;">$$$ Price Range </span> &nbsp; ${{$min_price}} @if($min_price != $max_price) - ${{$max_price}} @endif</p>
            </div>
         </div>
      </div>
      <br><br>
</section>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js" integrity="sha512-qTXRIMyZIFb8iQcfjXWCO8+M5Tbc38Qi5WzdPOYZHIlZpzBHG3L3by84BBBOiRGiEb7KKtAOAs5qYdUiZiQNNQ==" crossorigin="anonymous"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js" integrity="sha512-bPs7Ae6pVvhOSiIcyUClR7/q2OAsRiovw4vAkX+zJbw3ShAeeqezq50RIIcIURq7Oa20rW2n2q+fyXBNcU9lrw==" crossorigin="anonymous"></script><script>
    $(document).ready(function(){
        
        var today = moment().day() 
        console.log("today")
        console.log(today)
        console.log("today")
        
        var bigimage = $("#big");
  var thumbs = $("#thumbs");
  //var totalslides = 10;
  var syncedSecondary = true;

  bigimage
    .owlCarousel({
    items: 1,
    slideSpeed: 2000,
    nav: true,
    autoplay: true,
    dots: false,
    loop: true,
    responsiveRefreshRate: 200,
    navText: [
      '<i class="fa fa-arrow-left" aria-hidden="true"></i>',
      '<i class="fa fa-arrow-right" aria-hidden="true"></i>'
    ]
  })
    .on("changed.owl.carousel", syncPosition);

  thumbs
    .on("initialized.owl.carousel", function() {
    thumbs
      .find(".owl-item")
      .eq(0)
      .addClass("current");
  })
    .owlCarousel({
    items: 4,
    dots: true,
    nav: true,
    navText: [
      '<i class="fa fa-arrow-left" aria-hidden="true"></i>',
      '<i class="fa fa-arrow-right" aria-hidden="true"></i>'
    ],
    smartSpeed: 200,
    slideSpeed: 500,
    slideBy: 4,
    responsiveRefreshRate: 100
  })
    .on("changed.owl.carousel", syncPosition2);

  function syncPosition(el) {
    //if loop is set to false, then you have to uncomment the next line
    //var current = el.item.index;

    //to disable loop, comment this block
    var count = el.item.count - 1;
    var current = Math.round(el.item.index - el.item.count / 2 - 0.5);

    if (current < 0) {
      current = count;
    }
    if (current > count) {
      current = 0;
    }
    //to this
    thumbs
      .find(".owl-item")
      .removeClass("current")
      .eq(current)
      .addClass("current");
    var onscreen = thumbs.find(".owl-item.active").length - 1;
    var start = thumbs
    .find(".owl-item.active")
    .first()
    .index();
    var end = thumbs
    .find(".owl-item.active")
    .last()
    .index();

    if (current > end) {
      thumbs.data("owl.carousel").to(current, 100, true);
    }
    if (current < start) {
      thumbs.data("owl.carousel").to(current - onscreen, 100, true);
    }
  }

  function syncPosition2(el) {
    if (syncedSecondary) {
      var number = el.item.index;
      bigimage.data("owl.carousel").to(number, 100, true);
    }
  }

  thumbs.on("click", ".owl-item", function(e) {
    e.preventDefault();
    var number = $(this).index();
    console.log("number")
    console.log(number)
    console.log("number")
    bigimage.data("owl.carousel").to(number, 300, true);
  });
        
        
        
  var sync1 = $("#sync1");
  


  function syncPosition(el) {
    //if you set loop to false, you have to restore this next line
    //var current = el.item.index;
    
    //if you disable loop you have to comment this block
    var count = el.item.count-1;
    var current = Math.round(el.item.index - (el.item.count/2) - .5);
    
    if(current < 0) {
      current = count;
    }
    if(current > count) {
      current = 0;
    }
    
    //end block

    
  }
  var images = [<?php echo '"'.implode('","', $company->company_images).'"' ?>];
  if(images.length != 0 && images[0] != ""){
      var slidesPerPage = 4; //globaly define number of elements per page
  var syncedSecondary = true;

  sync1.owlCarousel({
    items : 1,
    slideSpeed : 2000,
    nav: true,
    autoPlay: true,
    dots: true,
    loop: true,
    responsiveRefreshRate : 200,
  }).on('changed.owl.carousel', syncPosition);
  }
      var imageUrl = images.length != 0 && images[0] != "" ? "<?php echo Config::get('constants.USER_IMAGE_THUMB'); ?>" : "{{url('/public/images')}}/" 
        var logo = (images.length != 0 && images[0] != "") ? images[0] : "claim-bg.jpeg"
        console.log(imageUrl)
        console.log(images[0])
       
       imageUrl = "https://fitnessity.co/"+imageUrl+logo
       
    setTimeout(function(){
        console.log(imageUrl)
        console.log("this one run")
         $(".banner").css("background-image", "url('" + imageUrl + "')", 'important');
    },20)					
       
    })
</script>
@endsection