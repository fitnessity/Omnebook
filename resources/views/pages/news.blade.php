@extends('layouts.profile')

@section('content')


<div class="business-offer-main">

  @include('includes.sidebar_profile_left')

    <div class="business-middle">

      <div class="business-title">

        <h1>WELCOME TO FITNESSITY</h1>

        <p>Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. 

Vestibulum tortor quam, feugiat vitae, ultricies eget, tempor sit amet, ante.</p>

        </div>

        

    <div class="business-menu">

      <ul>

          <li><a href="#">POST TO WALL  </a></li>

            

            <li><a href="#"> OUR PROGRAM  </a></li>

            

            <li><a href="#">STORE        </a></li>

            

            <li><a href="#">EMPLOYEES       </a></li>

            

            <li><a href="#">JOB       </a></li>

            

            <li><a href="#">REVIEWS</a></li>

            

            <li><a href="#">NEWS</a></li>

             <li><a href="#">EVENTS  </a></li>

        

        

        </ul>

    

    

    </div>

    

    <div class="busines-offer-list busines-off-profile-list">

    <div class="job_block">

    <div class="job_listing">

              <div class="row">

                <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 job_lst_img"> <span><img width="109" height="109" alt="" src="<?php echo Config::get('constants.FRONT_IMAGE'); ?>job-img.png"></span> </div>

                <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12 job_lst_dtls">

                  <div class="jb-title">

                    <h1>LOREM IPSUM</h1>

                     </div>

                  <p>Nam ei solum indoctum, reque dolorem persecuti ea qui. Doctus nominati 

                    ne priNam ei solum indoctum, reque dolorem persecuti ea qui. </p>

                  <div class="job_post_dtls"><a href="#"><i class="fa fa-map-marker"></i>New York</a> <a href="#"><i class="fa fa-calendar"></i>20 - March - 2016</a> 

                <a class="view-pro-event" href="#">View More  <i class="fa fa-angle-right" aria-hidden="true"></i>

</a>

                </div>

                </div>

              </div>

            </div>

            

            

            <div class="job_listing">

              <div class="row">

                <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 job_lst_img"> <span><img width="109" height="109" alt="" src="<?php echo Config::get('constants.FRONT_IMAGE'); ?>job-img.png"></span> </div>

                <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12 job_lst_dtls">

                  <div class="jb-title">

                    <h1>LOREM IPSUM</h1>

                     </div>

                  <p>Nam ei solum indoctum, reque dolorem persecuti ea qui. Doctus nominati 

                    ne priNam ei solum indoctum, reque dolorem persecuti ea qui. </p>

                  <div class="job_post_dtls"><a href="#"><i class="fa fa-map-marker"></i>New York</a> <a href="#"><i class="fa fa-calendar"></i>20 - March - 2016</a> 

                <a class="view-pro-event" href="#">View More  <i class="fa fa-angle-right" aria-hidden="true"></i>

</a>

                </div>

                </div>

              </div>

            </div>

            

            

            

            <div class="job_listing">

              <div class="row">

                <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 job_lst_img"> <span><img width="109" height="109" alt="" src="<?php echo Config::get('constants.FRONT_IMAGE'); ?>job-img.png"></span> </div>

                <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12 job_lst_dtls">

                  <div class="jb-title">

                    <h1>LOREM IPSUM</h1>

                     </div>

                  <p>Nam ei solum indoctum, reque dolorem persecuti ea qui. Doctus nominati 

                    ne priNam ei solum indoctum, reque dolorem persecuti ea qui. </p>

                  <div class="job_post_dtls"><a href="#"><i class="fa fa-map-marker"></i>New York</a> <a href="#"><i class="fa fa-calendar"></i>20 - March - 2016</a> 

                <a class="view-pro-event" href="#">View More  <i class="fa fa-angle-right" aria-hidden="true"></i>

</a>

                </div>

                </div>

              </div>

            </div>

            

            

            

            <div class="job_listing">

              <div class="row">

                <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 job_lst_img"> <span><img width="109" height="109" alt="" src="<?php echo Config::get('constants.FRONT_IMAGE'); ?>job-img.png"></span> </div>

                <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12 job_lst_dtls">

                  <div class="jb-title">

                    <h1>LOREM IPSUM</h1>

                     </div>

                  <p>Nam ei solum indoctum, reque dolorem persecuti ea qui. Doctus nominati 

                    ne priNam ei solum indoctum, reque dolorem persecuti ea qui. </p>

                  <div class="job_post_dtls"><a href="#"><i class="fa fa-map-marker"></i>New York</a> <a href="#"><i class="fa fa-calendar"></i>20 - March - 2016</a> 

                <a class="view-pro-event" href="#">View More  <i class="fa fa-angle-right" aria-hidden="true"></i>

</a>

                </div>

                </div>

              </div>

            </div>

            

            

            

             <div class="pagination_last">

                <ul class="pagination_list">

                  <li class="active"><a href="#">1</a></li>

                    <li><a href="#">2</a></li>

                    <li><a href="#">3</a></li>

                    <li><a href="#">4</a></li>

                    <li><a href="#">5</a></li>

                </ul>

              </div>

           </div> 

      

    

   

    </div>

    

    

    

    </div>


  @include('includes.sidebar_profile_right')

</div>

@endsection