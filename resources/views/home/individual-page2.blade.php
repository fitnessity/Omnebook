@extends('layouts.profile')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/owl-carousel/1.3.3/owl.carousel.min.css" integrity="sha512-X/RSQYxFb/tvuz6aNRTfKXDnQzmnzoawgEQ4X8nZNftzs8KFFH23p/BA6D2k0QCM4R0sY1DEy9MIY9b3fwi+bg==" crossorigin="anonymous" />
<style>
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
         top: 280px;
         color: #fff;
         }
         .banner_add a {
         color: #fff;
         margin: 0px 15px;
         }
         .banner-content img{
         border-radius: 50%;
         border: 3px solid white;
         }
         .banner{
        // background-image: url(../public/images/banner1new.jpg);
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
         #photo img{
         border-radius: 10px;
         }
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
         }
         #business_info p>a{
         color: #0e0e0d;
         font-size: 15px;
         }
</style>
@section('content')
<section class="direc-hire">
     <div class="banner">
         <div class="container">
            <div class="banner-content">
               <div class="row">
                  <div class="col-md-2">
                     <img src="<?php echo Config::get('constants.USER_IMAGE_THUMB').$company['logo']; ?>" class="img-fluid">
                  </div>
                  <div class="col-md-6">
                     <h3>{{$company->company_name}}</h3>
                     <p>{{$company->short_description}}</p>
                     <div class="banner_add">
                        <a href="#"><i class="fa fa-phone" aria-hidden="true"></i> {{$company->contact_number}}</a>
                        <a href="#"><i class="fa fa-map-marker" aria-hidden="true"></i> {{$company->address}}</a>
                     </div>
                  </div>
                  <div class="col-md-4" style="text-align: right;">
                     <h6><b>8.6</b>/10 Ratings</h6>
                     <p> <i class="fa fa-heart-o" aria-hidden="true"></i> Save &nbsp;| &nbsp; <i class="fa fa-commenting" aria-hidden="true"></i> Submit Review &nbsp; | &nbsp; <i class="fa fa-share-alt" aria-hidden="true"></i> Share</p>
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
                  <a class="nav-link" href="#Amenties">Amenties</a>
               </li>
               <li class="nav-item">
                  <a class="nav-link" href="#photo">Photos</a>
               </li>
               <li class="nav-item">
                  <a class="nav-link" href="#">Video</a>
               </li>
               <li class="nav-item">
                  <a class="nav-link" href="#map">Map</a>
               </li>
               <li class="nav-item">
                  <a class="nav-link" href="#menu_price">Menu Prices</a>
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
               <p>{{$company->about_company}}</p>
                   
               </div>
            <div id="Amenties">
               <h5>Amenties</h5>
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
                
            <div id="sync1" class="owl-carousel owl-theme">
                @foreach($company->company_images as $value)
              <div class="item">
                <img src="<?php echo Config::get('constants.USER_IMAGE_THUMB').$value; ?>"></img>
                </div>
                @endforeach
            </div>
            </div>
            @endif
            <div id="map">
               <div class="row">
                  <div class="col-md-6">
                     <h5>Map</h5>
                  </div>
                  <div class="col-md-6" style="text-align: right;font-size: 13px;">
                     <a href="#" style="color: red;"><i class="fa fa-map-o" aria-hidden="true"></i> Map</a> &nbsp;&nbsp;&nbsp;
                     <a href="#" style="color: #000;"><i class="fa fa-hand-o-right" aria-hidden="true" style="color: red;"></i> Get Directions</a>
                  </div>
               </div>
               <iframe src="{{'https://www.google.com/maps/embed/v1/place?key=AIzaSyCK4fSC1gA6qWJTio-djkKgW8WgS9vQG48&q='.$company->latitude.','.$company->longitude}}" width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
            </div>
            <div id="menu_price">
               <h5>Menu Prices</h5>
               <br>
               <div class="row">
                  <div class="col-md-6">
                     <h6>French Crostini</h6>
                  </div>
                  <div class="col-md-6" style="text-align: right;">
                     <h6 style="color: red;">£12.5</h6>
                  </div>
               </div>
               <p style="color: gray;font-size:13px;border-bottom: 2px dotted #bbbbbb;padding-bottom: 15px;">Whilst he may be known to most as one of the greatest American 20th century novelists, to us, Hemingway helped put Cuban cocktails on the map. Lime juice, grapefruit and juice, shaken and strained.</p>
               <div class="row">
                  <div class="col-md-6">
                     <h6>One Night at Hemingway's</h6>
                  </div>
                  <div class="col-md-6" style="text-align: right;">
                     <h6 style="color: red;">£7.5</h6>
                  </div>
               </div>
               <p style="color: gray;font-size:13px;border-bottom: 2px dotted #bbbbbb;padding-bottom: 15px;">Whilst he may be known to most as one of the greatest American 20th century novelists, to us, Hemingway helped put Cuban cocktails on the map. Lime juice, grapefruit and juice, shaken and strained.</p>
            </div>

            <div id="reviews">
               <h5>Reviews</h5>
               <br>
               <div class="row" style="border-bottom: 1px solid lightgray;">
                <div class="col-md-2">
                  <img src="https://demoapus.com/cityo/place-demo/wp-content/plugins/wp-first-letter-avatar/images/default/96/latin_o.png" class="img-fluid">
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
                     <th><span>Open</span></th>
                     <th><span>4:30 am - 10:00 pm</span></th>
                  </tr>
               </thead>
               <tbody>
                  <tr>
                     <td>Monday</td>
                     <td></td>
                     @if($user_professional_detail->availability != null)
                     <td>{{$user_professional_detail->availability->monday_start}} - {{$user_professional_detail->availability->monday_end}}</td>
                     @else
                     <td>-</td>
                     @endif
                  </tr>
                  <tr>
                     <td>Tuesday</td>
                     <td></td>
                      @if($user_professional_detail->availability != null)
                     <td>{{$user_professional_detail->availability->tuesday_start}} - {{$user_professional_detail->availability->tuesday_end}}</td>
                     @else
                     <td>-</td>
                     @endif
                  </tr>
                  <tr>
                     <td>Wednesday</td>
                     <td></td>
                      @if($user_professional_detail->availability != null)
                     <td>{{$user_professional_detail->availability->wednesday_start}} - {{$user_professional_detail->availability->wednesday_end}}</td>
                     @else
                     <td>-</td>
                     @endif
                  </tr>
                  <tr>
                     <td>Thursday</td>
                     <td></td>
                      @if($user_professional_detail->availability != null)
                     <td>{{$user_professional_detail->availability->thrusday_start}} - {{$user_professional_detail->availability->thrusday_end}}</td>
                     @else
                     <td>-</td>
                     @endif
                  </tr>
                  <tr>
                     <td>Friday</td>
                     <td></td>
                      @if($user_professional_detail->availability != null)
                     <td>{{$user_professional_detail->availability->friday_start}} - {{$user_professional_detail->availability->friday_end}}</td>
                     @else
                     <td>-</td>
                     @endif
                  </tr>
                  <tr>
                     <td>Saturday</td>
                     <td></td>
                      @if($user_professional_detail->availability != null)
                     <td>{{$user_professional_detail->availability->saturday_start}} - {{$user_professional_detail->availability->saturday_end}}</td>
                     @else
                     <td>-</td>
                     @endif
                  </tr>
                  <tr>
                     <td>Sunday</td>
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
                     <h5>Business Info</h5>
                  </div>
                  <div class="col-md-6" style="text-align: right;">
                     <a href="#" style="color: #000;font-size: 14px;"> <i class="fa fa-hand-o-right" aria-hidden="true" style="color: red;"></i> Get Directions</a>
                  </div>
               </div>
               <iframe src="{{'https://www.google.com/maps/embed/v1/place?key=AIzaSyCK4fSC1gA6qWJTio-djkKgW8WgS9vQG48&q='.$company->latitude.','.$company->longitude}}" width="100%" height="200px" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
               <br><br>
               <p><a href="#"><i class="fa fa-map-marker" aria-hidden="true"></i> &nbsp;&nbsp; {{$company->address}}</a></p>
               <p><a href="#"><i class="fa fa-phone" aria-hidden="true"></i> &nbsp;&nbsp; {{$company->contact_number}}</a></p>
               <p><a href="#"><i class="fa fa-envelope-o" aria-hidden="true"></i> &nbsp;&nbsp; {{$company->email}}</a></p>
               <p><a href="#"><i class="fa fa-globe" aria-hidden="true"></i> &nbsp;&nbsp; {{$company->website}}</a></p>
            </div>
            <div id="price_range">
               <h5>Price Range</h5>
               <br>
               <p style="color: gray;"><span style="color: red;">Price Range </span> &nbsp; ${{$min_price}} @if($min_price != $max_price) - ${{$max_price}} @endif</p>
            </div>
            <div id="rating_average">
              <h5>Rating Average</h5>
              <h2 style="color: red;">8.58 <span style="font-size: 13px;">/10 Average</span></h2>
              <div class="row">
                <div class="col-md-3">
                  <p style="font-size: 13px; color: gray;">Quality<br><span style="font-size: 20px; color: red;">9</span></p>
                </div>
                <div class="col-md-3">
                  <p style="font-size: 13px; color: gray;">Location<br><span style="font-size: 20px; color: red;">9.38</span></p>
                </div>
                <div class="col-md-3">
                  <p style="font-size: 13px; color: gray;">Space<br><span style="font-size: 20px; color: red;">8.75</span></p>
                </div>
                <div class="col-md-3">
                  <p style="font-size: 13px; color: gray;">Service<br><span style="font-size: 20px; color: red;">8</span></p>
                </div>
                <div class="col-md-3">
                  <p style="font-size: 13px; color: gray;">Price<br><span style="font-size: 20px; color: red;">7.75</span></p>
                </div>
              </div>
            </div>
         </div>
      </div>
      <br><br>
</section>
<script src="https://cdnjs.cloudflare.com/ajax/libs/owl-carousel/1.3.3/owl.carousel.min.js" integrity="sha512-9CWGXFSJ+/X0LWzSRCZFsOPhSfm6jbnL+Mpqo0o8Ke2SYr8rCTqb4/wGm+9n13HtDE1NQpAEOrMecDZw4FXQGg==" crossorigin="anonymous"></script>
<script>
    $(document).ready(function(){
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
        var logo = images.length != 0 && images[0] != "" ? images[0] : "claim-bg.jpeg"
       // console.log(imageUrl)
       
       imageUrl = imageUrl+logo
    					
        $(".banner").css("background-image", "url(" + imageUrl + ")");
    })
</script>
@endsection