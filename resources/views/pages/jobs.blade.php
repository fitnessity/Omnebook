@extends('layouts.profile')

@section('content')

<div class="profile-div">

  <div class="container">

    <div class="row">

      <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

        <div class="job_menu">

          <ul class="job_menu_list">

            <li><a href="#">Jobs</a></li>

            <li><a href="#">resume</a></li>

            <li><a href="#">companies</a></li>

            <li><a href="#">features</a></li>

            <li><a href="#">page</a></li>

          </ul>

          <a href="#" class="start_topic">add new job</a></div>

      </div>

      <div class="clearfix"></div>

      <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">

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

      <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">

        <div class="profile-sidebar signup-sidebar">

          <div class="get-start"> <img src="<?php echo Config::get('constants.FRONT_IMAGE'); ?>get-start-img.jpg" height="308"  width="333" />

            <p>Vestibulum tortor quam, feugiat vitae, ultricies eget, tempor sit amet, ante pellentesque habitant morbi tristique </p>

            <a href="#">GET STARTED</a> </div>

          <div class="category_left no-mrgn-btm">

            <h1 class="cat_title">Browse all jobs</h1>

            <div class="category_left categ_listing_block">

              <ul class="categ_listing_list">

                <li><a href="#">LOREM ISPUM DOLOR....</a></li>

                <li><a href="#">LOREM ISPUM DOLOR....</a></li>

                <li><a href="#">LOREM ISPUM DOLOR....</a></li>

                <li><a href="#">LOREM ISPUM DOLOR....</a></li>

                <li><a href="#">LOREM ISPUM DOLOR....</a></li>

                <li><a href="#">LOREM ISPUM DOLOR....</a></li>

                <li><a href="#">LOREM ISPUM DOLOR....</a></li>

                <li><a href="#">LOREM ISPUM DOLOR....</a></li>

              </ul>

            </div>

          </div>

          

        </div>

      </div>

    </div>

  </div>

</div>

@endsection