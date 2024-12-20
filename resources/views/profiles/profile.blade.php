@extends('layouts.profile')

@section('content')


<div class="business-offer-main">

  <div class="business-left">

    <div class="business-left-pic">

      <img src="<?php echo Config::get('constants.FRONT_IMAGE'); ?>profile-left.jpg" height="314" width="352" />

      <h2>LOREM IPSUM DOLOR</h2>

      <p>Nam ei solum indoctum, reque dolorem persecuti ea qui. Doctus nominati ne priNam ei solum indoctum, reque dolorem persecuti ea qui. Doctus nominati ne pri</p>

    </div>



    <div class="verification">

      <h2>VERIFICATION</h2>

      <div class="veri-icon">

        <a href="#"><i class="fa fa-phone" aria-hidden="true"></i></a>

        <a href="#"><i class="fa fa-envelope" aria-hidden="true"></i></a>

        <a href="#"><i class="fa fa-link" aria-hidden="true"></i></a>

        <a href="#"><i class="fa fa-map-marker" aria-hidden="true"></i></a>

      </div>

    </div>

    <ul class="verifi-list">

      <li><a href="#"><img src="<?php echo Config::get('constants.FRONT_IMAGE'); ?>business-offer-list/1.jpg" height="117" width="117" /></a></li>

      <li><a href="#"><img src="<?php echo Config::get('constants.FRONT_IMAGE'); ?>business-offer-list/2.jpg" height="117" width="117" /></a></li>

      <li><a href="#"><img src="<?php echo Config::get('constants.FRONT_IMAGE'); ?>business-offer-list/3.jpg" height="117" width="117" /></a></li>

      <li><a href="#"><img src="<?php echo Config::get('constants.FRONT_IMAGE'); ?>business-offer-list/4.jpg" height="117" width="117" /></a></li>

      <li><a href="#"><img src="<?php echo Config::get('constants.FRONT_IMAGE'); ?>business-offer-list/5.jpg" height="117" width="117" /></a></li>

      <li><a href="#"><img src="<?php echo Config::get('constants.FRONT_IMAGE'); ?>business-offer-list/6.jpg" height="117" width="117" /></a></li>

      <li><a href="#"><img src="<?php echo Config::get('constants.FRONT_IMAGE'); ?>business-offer-list/7.jpg" height="117" width="117" /></a></li>

      <li><a href="#"><img src="<?php echo Config::get('constants.FRONT_IMAGE'); ?>business-offer-list/1.jpg" height="117" width="117" /></a></li>

      <li><a href="#"><img src="<?php echo Config::get('constants.FRONT_IMAGE'); ?>business-offer-list/8.jpg" height="117" width="117" /></a></li>

    </ul>

    <div class="business-activites">
      <h2>ACTIVITIES</h2>
      <a href="#">- Solum indoctum reque dolorem</a>
      <a href="#">- Solum indoctum reque dolorem</a>
      <a href="#">- Solum indoctum reque dolorem</a>
      <a href="#">- Solum indoctum reque dolorem</a>
    </div>
  </div>

  <div class="business-middle">
    <div class="business-title">
      <h1>WELCOME TO OMNEBOOK</h1>
      <p>Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. 

        Vestibulum tortor quam, feugiat vitae, ultricies eget, tempor sit amet, ante.</p>
    </div>

    <div class="business-menu">

      <ul>
        <li><a href="#">POST TO WALL  </a></li>
        <li><a href="#"> OUR PROGRAM 	</a></li>
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

        <ul id="myTab_1" class="job_topic">

          <li class="active"><a href="#tab_1" data-toggle="tab" >LATEST JOBS</a></li>

          <li><a href="#tab_2" data-toggle="tab" >LATEST RESUME</a></li>

          <li><a href="#tab_3" data-toggle="tab" >companies</a></li>

        </ul>

        <div id="myTabContent" class="tab-content"> 

          <div id="tab_1" class="tab-pane fade in active job_listing_block">

            <div class="job_listing">

              <div class="row">

                <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 job_lst_img"> <span><img src="<?php echo Config::get('constants.FRONT_IMAGE'); ?>job-img.png" alt="" width="109" height="109"/></span> </div>

                <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12 job_lst_dtls">

                  <div class="jb-title">

                    <h1>Job title</h1>

                    <span><a href="#">FULL TIME</a><a href="#">$20 hrs</a></span> </div>

                  <p>Nam ei solum indoctum, reque dolorem persecuti ea qui. Doctus nominati 

                    ne priNam ei solum indoctum, reque dolorem persecuti ea qui. </p>

                  <div class="job_post_dtls"><a href="#"><i class="fa fa-map-marker"></i>New York</a> <a href="#"><i class="fa fa-calendar"></i>20 - March - 2016</a> <a href="#"><i class="fa fa-file-text-o"></i>Upload Resume</a> </div>

                </div>

              </div>

            </div>

            <div class="job_listing">

              <div class="row">

                <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 job_lst_img"> <span><img src="<?php echo Config::get('constants.FRONT_IMAGE'); ?>job-img.png" alt="" width="109" height="109"/></span> </div>

                <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12 job_lst_dtls">

                  <div class="jb-title">

                    <h1>Job title</h1>

                    <span><a href="#">FULL TIME</a><a href="#">$20 hrs</a></span> </div>

                  <p>Nam ei solum indoctum, reque dolorem persecuti ea qui. Doctus nominati 

                    ne priNam ei solum indoctum, reque dolorem persecuti ea qui. </p>

                  <div class="job_post_dtls"><a href="#"><i class="fa fa-map-marker"></i>New York</a> <a href="#"><i class="fa fa-calendar"></i>20 - March - 2016</a> <a href="#"><i class="fa fa-file-text-o"></i>Upload Resume</a> </div>

                </div>

              </div>

            </div>

            <div class="job_listing">

              <div class="row">

                <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 job_lst_img"> <span><img src="<?php echo Config::get('constants.FRONT_IMAGE'); ?>job-img.png" alt="" width="109" height="109"/></span> </div>

                <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12 job_lst_dtls">

                  <div class="jb-title">

                    <h1>Job title</h1>

                    <span><a href="#">FULL TIME</a><a href="#">$20 hrs</a></span> </div>

                  <p>Nam ei solum indoctum, reque dolorem persecuti ea qui. Doctus nominati 

                    ne priNam ei solum indoctum, reque dolorem persecuti ea qui. </p>

                  <div class="job_post_dtls"><a href="#"><i class="fa fa-map-marker"></i>New York</a> <a href="#"><i class="fa fa-calendar"></i>20 - March - 2016</a> <a href="#"><i class="fa fa-file-text-o"></i>Upload Resume</a> </div>

                </div>

              </div>

            </div>

            <div class="job_listing">

              <div class="row">

                <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 job_lst_img"> <span><img src="<?php echo Config::get('constants.FRONT_IMAGE'); ?>job-img.png" alt="" width="109" height="109"/></span> </div>

                <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12 job_lst_dtls">

                  <div class="jb-title">

                    <h1>Job title</h1>

                    <span><a href="#">FULL TIME</a><a href="#">$20 hrs</a></span> </div>

                  <p>Nam ei solum indoctum, reque dolorem persecuti ea qui. Doctus nominati 

                    ne priNam ei solum indoctum, reque dolorem persecuti ea qui. </p>

                  <div class="job_post_dtls"><a href="#"><i class="fa fa-map-marker"></i>New York</a> <a href="#"><i class="fa fa-calendar"></i>20 - March - 2016</a> <a href="#"><i class="fa fa-file-text-o"></i>Upload Resume</a> </div>

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

          <div id="tab_2" class="tab-pane fade job_listing_block">

            <div class="job_listing">

              <div class="row">

                <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 job_lst_img"> <span><img src="<?php echo Config::get('constants.FRONT_IMAGE'); ?>job-img1.png" alt="" width="109" height="109"/></span> </div>

                <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12 job_lst_dtls">

                  <div class="jb-title">

                    <h1>Job title</h1>

                    <span><a href="#">FULL TIME</a><a href="#">$20 hrs</a></span> </div>

                  <p>Nam ei solum indoctum, reque dolorem persecuti ea qui. Doctus nominati 

                    ne priNam ei solum indoctum, reque dolorem persecuti ea qui. </p>

                  <div class="job_post_dtls"><a href="#"><i class="fa fa-map-marker"></i>New York</a> <a href="#"><i class="fa fa-calendar"></i>20 - March - 2016</a> <a href="#"><i class="fa fa-file-text-o"></i>Upload Resume</a> </div>

                </div>

              </div>

            </div>

            <div class="job_listing">

              <div class="row">

                <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 job_lst_img"> <span><img src="<?php echo Config::get('constants.FRONT_IMAGE'); ?>job-img1.png" alt="" width="109" height="109"/></span> </div>

                <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12 job_lst_dtls">

                  <div class="jb-title">

                    <h1>Job title</h1>

                    <span><a href="#">FULL TIME</a><a href="#">$20 hrs</a></span> </div>

                  <p>Nam ei solum indoctum, reque dolorem persecuti ea qui. Doctus nominati 

                    ne priNam ei solum indoctum, reque dolorem persecuti ea qui. </p>

                  <div class="job_post_dtls"><a href="#"><i class="fa fa-map-marker"></i>New York</a> <a href="#"><i class="fa fa-calendar"></i>20 - March - 2016</a> <a href="#"><i class="fa fa-file-text-o"></i>Upload Resume</a> </div>

                </div>

              </div>

            </div>

            <div class="job_listing">

              <div class="row">

                <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 job_lst_img"> <span><img src="<?php echo Config::get('constants.FRONT_IMAGE'); ?>job-img1.png" alt="" width="109" height="109"/></span> </div>

                <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12 job_lst_dtls">

                  <div class="jb-title">

                    <h1>Job title</h1>

                    <span><a href="#">FULL TIME</a><a href="#">$20 hrs</a></span> </div>

                  <p>Nam ei solum indoctum, reque dolorem persecuti ea qui. Doctus nominati 

                    ne priNam ei solum indoctum, reque dolorem persecuti ea qui. </p>

                  <div class="job_post_dtls"><a href="#"><i class="fa fa-map-marker"></i>New York</a> <a href="#"><i class="fa fa-calendar"></i>20 - March - 2016</a> <a href="#"><i class="fa fa-file-text-o"></i>Upload Resume</a> </div>

                </div>

              </div>

            </div>

            <div class="job_listing">

              <div class="row">

                <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 job_lst_img"> <span><img src="<?php echo Config::get('constants.FRONT_IMAGE'); ?>job-img1.png" alt="" width="109" height="109"/></span> </div>

                <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12 job_lst_dtls">

                  <div class="jb-title">

                    <h1>Job title</h1>

                    <span><a href="#">FULL TIME</a><a href="#">$20 hrs</a></span> </div>

                  <p>Nam ei solum indoctum, reque dolorem persecuti ea qui. Doctus nominati 

                    ne priNam ei solum indoctum, reque dolorem persecuti ea qui. </p>

                  <div class="job_post_dtls"><a href="#"><i class="fa fa-map-marker"></i>New York</a> <a href="#"><i class="fa fa-calendar"></i>20 - March - 2016</a> <a href="#"><i class="fa fa-file-text-o"></i>Upload Resume</a> </div>

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

          <div id="tab_3" class="tab-pane fade job_listing_block">

            <div class="job_listing">

              <div class="row">

                <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 job_lst_img"> <span><img src="<?php echo Config::get('constants.FRONT_IMAGE'); ?>job-img.png" alt="" width="109" height="109"/></span> </div>

                <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12 job_lst_dtls">

                  <div class="jb-title">

                    <h1>Job title</h1>

                    <span><a href="#">FULL TIME</a><a href="#">$20 hrs</a></span> </div>

                  <p>Nam ei solum indoctum, reque dolorem persecuti ea qui. Doctus nominati 

                    ne priNam ei solum indoctum, reque dolorem persecuti ea qui. </p>

                  <div class="job_post_dtls"><a href="#"><i class="fa fa-map-marker"></i>New York</a> <a href="#"><i class="fa fa-calendar"></i>20 - March - 2016</a> <a href="#"><i class="fa fa-file-text-o"></i>Upload Resume</a> </div>

                </div>

              </div>

            </div>

            <div class="job_listing">

              <div class="row">

                <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 job_lst_img"> <span><img src="<?php echo Config::get('constants.FRONT_IMAGE'); ?>job-img.png" alt="" width="109" height="109"/></span> </div>

                <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12 job_lst_dtls">

                  <div class="jb-title">

                    <h1>Job title</h1>

                    <span><a href="#">FULL TIME</a><a href="#">$20 hrs</a></span> </div>

                  <p>Nam ei solum indoctum, reque dolorem persecuti ea qui. Doctus nominati 

                    ne priNam ei solum indoctum, reque dolorem persecuti ea qui. </p>

                  <div class="job_post_dtls"><a href="#"><i class="fa fa-map-marker"></i>New York</a> <a href="#"><i class="fa fa-calendar"></i>20 - March - 2016</a> <a href="#"><i class="fa fa-file-text-o"></i>Upload Resume</a> </div>

                </div>

              </div>

            </div>

            <div class="job_listing">

              <div class="row">

                <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 job_lst_img"> <span><img src="<?php echo Config::get('constants.FRONT_IMAGE'); ?>job-img.png" alt="" width="109" height="109"/></span> </div>

                <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12 job_lst_dtls">

                  <div class="jb-title">

                    <h1>Job title</h1>

                    <span><a href="#">FULL TIME</a><a href="#">$20 hrs</a></span> </div>

                  <p>Nam ei solum indoctum, reque dolorem persecuti ea qui. Doctus nominati 

                    ne priNam ei solum indoctum, reque dolorem persecuti ea qui. </p>

                  <div class="job_post_dtls"><a href="#"><i class="fa fa-map-marker"></i>New York</a> <a href="#"><i class="fa fa-calendar"></i>20 - March - 2016</a> <a href="#"><i class="fa fa-file-text-o"></i>Upload Resume</a> </div>

                </div>

              </div>

            </div>

            <div class="job_listing">

              <div class="row">

                <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 job_lst_img"> <span><img src="<?php echo Config::get('constants.FRONT_IMAGE'); ?>job-img.png" alt="" width="109" height="109"/></span> </div>

                <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12 job_lst_dtls">

                  <div class="jb-title">

                    <h1>Job title</h1>

                    <span><a href="#">FULL TIME</a><a href="#">$20 hrs</a></span> </div>

                  <p>Nam ei solum indoctum, reque dolorem persecuti ea qui. Doctus nominati 

                    ne priNam ei solum indoctum, reque dolorem persecuti ea qui. </p>

                  <div class="job_post_dtls"><a href="#"><i class="fa fa-map-marker"></i>New York</a> <a href="#"><i class="fa fa-calendar"></i>20 - March - 2016</a> <a href="#"><i class="fa fa-file-text-o"></i>Upload Resume</a> </div>

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







    </div>







  </div>







  <div class="business-right">

    <div class="business-star">

      <div class="grey-star">

        <h2>4.00</h2>

        <div class="start-list">

          <i class="fa fa-star" aria-hidden="true"></i>

          <i class="fa fa-star" aria-hidden="true"></i>

          <i class="fa fa-star" aria-hidden="true"></i>

          <i class="fa fa-star" aria-hidden="true"></i>

          <i class="fa fa-star grey-star-i" aria-hidden="true"></i>

        </div>



        <span><i class="fa fa-user" aria-hidden="true"></i> 34,567</span>





      </div>





      <ul class="star-line">



        <li><i class="fa fa-star" aria-hidden="true"></i> 5 <span class="green">&nbsp;</span></li>

        <li><i class="fa fa-star" aria-hidden="true"></i> 4 <span class="perrot">&nbsp;</span></li>

        <li><i class="fa fa-star" aria-hidden="true"></i> 3 <span class="yellow">&nbsp;</span></li>

        <li><i class="fa fa-star" aria-hidden="true"></i> 2 <span class="orange">&nbsp;</span></li>

        <li><i class="fa fa-star" aria-hidden="true"></i> 1 <span class="red">&nbsp;</span></li>



      </ul>



    </div>



    <div class="activity-ranking">

      <ul>

        <li>

          <i class="fa fa-long-arrow-up" aria-hidden="true"></i>

          <div class="activity-rank">

            <h3>ACTIVITY RANKING</h3>

            <p>382</p>

          </div>

          <ul>

            <li>  

              <h3>NEW YORK RANK</h3>

              <p>382</p>

            </li>

            <li>  

              <h3>WORLD RANK</h3>

              <p>582</p>

            </li>

            <li>  

              <h3>NO. WORKOUT BOOKINGS</h3>

              <p>12,345</p>

            </li>

            <li>  

              <h3>REVIEW POSTED</h3>

              <p>12,345</p>

            </li>





          </ul>

        </li>

        <li>

          <h3>PROFILE VIEWS</h3>

          <p>24,345,678</p>



        </li>

        <li>

          <h3>FOLLOWERS</h3>

          <p>13,456</p>

        </li>

        <li>

          <span> <img src="<?php echo Config::get('constants.FRONT_IMAGE'); ?>usa-round.png" height="47" width="47" /> </span>

          <p>New York,  United State, 11:00 PM <br/>

            Member Since: 12th April 2016</p>



        </li>

      </ul>

    </div>

    <div class="view-location">

      <h2>VIEW LOCATION</h2>



      <button type="button" class="btn btn-info" data-toggle="collapse" data-target="#demo"> MORE  <i class="fa fa-angle-down" aria-hidden="true"></i></button>

      <div id="demo" class="collapse">

        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d599044.1555133432!2d-0.4816621971529401!3d51.58361523399559!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47d8a00baf21de75%3A0x52963a5addd52a99!2sLondon%2C+UK!5e0!3m2!1sen!2sin!4v1459681379267" width="100%" height="300" frameborder="0" style="border:0" allowfullscreen></iframe>



      </div>

    </div>

    <div class="sponsered">

      <h2>SPONSERED</h2>

      <img src="<?php echo Config::get('constants.FRONT_IMAGE'); ?>sidebarimg-3.jpg" height="226" width="322" />

      <img src="<?php echo Config::get('constants.FRONT_IMAGE'); ?>sidebarimg-2.jpg" height="461" width="322" />


    </div>


  </div>



</div>


@endsection