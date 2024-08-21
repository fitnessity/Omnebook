@extends('layouts.profile')

@section('content')


<div class="profile-div">

  <div class="container">

    <div class="row">

      <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

        <div class="src_topics">

          <div class="src_topic_block">

            <input type="text" placeholder="Search topics"/>

            <button><i class="fa fa-search"></i></button>

          </div>

          <a href="#" class="start_topic">start a new topic</a> <span class="forum_user"><img src="<?php echo Config::get('constants.FRONT_IMAGE'); ?>img2.jpg" alt="" width="70" height="70"/><a href="#" class="forum_user_point"></a></span> </div>

      </div>

      <div class="clearfix"></div>

      <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">

        <div class="signup-block forum_block_main">

        <div class="row">

        <div class="col-lg-2 col-md-2 col-sm-12 col-xs-12 forum_user_block">

          <span class="forum_user_block_img"><img src="<?php echo Config::get('constants.FRONT_IMAGE'); ?>img2.jpg" alt="" width="331" height="468"/></span>

        <span class="viewer_list">

                <img src="<?php echo Config::get('constants.FRONT_IMAGE'); ?>arrow-t.png" alt="" width="13" height="8"/>

                3403</span>

        </div>

        <div class="col-lg-10 col-md-10 col-sm-12 col-xs-12">

           <h1>consectetuer adipiscing elit, sed diam nonummy nibh</h1>

             <div class="forum_update">

              <a href="#"><i class="fa fa-clock-o"></i>02 hrs</a>

                <a href="#"><i class="fa fa-share"></i>Share</a>

                <a href="#"><i class="fa fa-pencil-square-o"></i>Edit</a>

             </div>

          <p>Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat. Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat, vel illum dolore eu feugiat nulla facilisis at vero eros et accumsan et iusto odio dignissim qui blandit praesent luptatum</p>

        </div>

        </div>

         

        </div>

        <div class="forum_reply">

          <div class="profilecon-left forum_reply"> 

            <div class="profile-div-padding">

              <div class="profile-list-main forum_reply_list">

                <div class="profile-list"> <span>1hrs <i class="fa fa-circle" aria-hidden="true"></i></span>

                  <div class="profile-left-avtar"> <img src="<?php echo Config::get('constants.FRONT_IMAGE'); ?>img1.jpg" height="70" width="70" /> </div>

                  <div class="profile-post-detail">

                    <h4><strong>Pellentesque habitant</strong></h4>

                    <p>Senectus et netus et malesuada fames ac turpis egestas. Vestibulum tortor quam, feugiat vitae, ultricies eget, tempor sit amet, ante pellentesque habitant morbi tristique </p>

                    

                  </div>

                </div>

                <div class="profile-list"> <span>1hrs <i class="fa fa-circle" aria-hidden="true"></i></span>

                  <div class="profile-left-avtar"> <img src="<?php echo Config::get('constants.FRONT_IMAGE'); ?>img2.jpg" height="70" width="70" /> </div>

                 <div class="profile-post-detail">

                    <h4><strong>Pellentesque habitant</strong></h4>

                    <p>Senectus et netus et malesuada fames ac turpis egestas. Vestibulum tortor quam, feugiat vitae, ultricies eget, tempor sit amet, ante pellentesque habitant morbi tristique </p>

                    

                  </div>

                </div>

                <div class="profile-list"> <span><i class="fa fa-circle" aria-hidden="true"></i></span>

                  <div class="profile-left-avtar"> <img src="<?php echo Config::get('constants.FRONT_IMAGE'); ?>img3.jpg" height="70" width="70" /> </div>

                 <div class="profile-post-detail no-bdr">

                    <div class="add_comments"> <input type="text" />

            <input type="submit" value="Add Comment" /></div>

                   

                  </div>

                </div>

                

              </div>

            </div>

          </div>

        </div>

        <div class="signup-block forum_block_main">

        <div class="row">

        <div class="col-lg-2 col-md-2 col-sm-12 col-xs-12 forum_user_block">

          <span class="forum_user_block_img"><img src="<?php echo Config::get('constants.FRONT_IMAGE'); ?>img2.jpg" alt="" width="331" height="468"/></span>

        <span class="viewer_list">

                <img src="<?php echo Config::get('constants.FRONT_IMAGE'); ?>arrow-t.png" alt="" width="13" height="8"/>

                3403</span>

        </div>

        <div class="col-lg-10 col-md-10 col-sm-12 col-xs-12">

           <h1>consectetuer adipiscing elit, sed diam nonummy nibh</h1>

             <div class="forum_update">

              <a href="#"><i class="fa fa-clock-o"></i>02 hrs</a>

                <a href="#"><i class="fa fa-share"></i>Share</a>

                <a href="#"><i class="fa fa-pencil-square-o"></i>Edit</a>

             </div>

          <p>Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat. Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat, vel illum dolore eu feugiat nulla facilisis at vero eros et accumsan et iusto odio dignissim qui blandit praesent luptatum</p>

        </div>

        </div>

         

        </div>

         <div class="signup-block forum_block_main">

        <div class="row">

        <div class="col-lg-2 col-md-2 col-sm-12 col-xs-12 forum_user_block">

          <span class="forum_user_block_img"><img src="<?php echo Config::get('constants.FRONT_IMAGE'); ?>img2.jpg" alt="" width="331" height="468"/></span>

        <span class="viewer_list">

                <img src="<?php echo Config::get('constants.FRONT_IMAGE'); ?>arrow-t.png" alt="" width="13" height="8"/>

                3403</span>

        </div>

        <div class="col-lg-10 col-md-10 col-sm-12 col-xs-12">

           <h1>consectetuer adipiscing elit, sed diam nonummy nibh</h1>

             <div class="forum_update">

              <a href="#"><i class="fa fa-clock-o"></i>02 hrs</a>

                <a href="#"><i class="fa fa-share"></i>Share</a>

                <a href="#"><i class="fa fa-pencil-square-o"></i>Edit</a>

             </div>

          <p>Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat. Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat, vel illum dolore eu feugiat nulla facilisis at vero eros et accumsan et iusto odio dignissim qui blandit praesent luptatum</p>

        </div>

        </div>

         

        </div>

      </div>

      <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">

        <div class="profile-sidebar signup-sidebar">

          <div class="get-start"> <img src="<?php echo Config::get('constants.FRONT_IMAGE'); ?>get-start-img.jpg" height="308"  width="333" />

            <p>Vestibulum tortor quam, feugiat vitae, ultricies eget, tempor sit amet, ante pellentesque habitant morbi tristique </p>

            <a href="#">GET STARTED</a> </div>

          

            <div class="category_left">

              <h1 class="cat_title">Category</h1>

                <div class="category_left categ_listing_block">

                  <ul class="categ_listing_list">

                      <li><a href="#">LOREM ISPUM DOLOR....</a><span>22</span></li>

                        <li><a href="#">LOREM ISPUM DOLOR....</a><span>22</span></li>

                        <li><a href="#">LOREM ISPUM DOLOR....</a><span>22</span></li>

                        <li><a href="#">LOREM ISPUM DOLOR....</a><span>22</span></li>

                        <li><a href="#">LOREM ISPUM DOLOR....</a><span>22</span></li>

                        <li><a href="#">LOREM ISPUM DOLOR....</a><span>22</span></li>

                        <li><a href="#">LOREM ISPUM DOLOR....</a><span>22</span></li>

                    </ul>

                </div>

            </div>

            <div class="category_left no-mrgn-btm">

              <h1 class="cat_title">Active Threads</h1>

                <div class="category_left categ_listing_block">

                  <ul class="active_threads">

                      <li><a href="#">Duis autem vel eum iriure dolor in hendrerit in 

vulputate velit</a></li>

<li><a href="#">Duis autem vel eum iriure dolor in hendrerit in 

vulputate velit</a></li>

<li><a href="#">Duis autem vel eum iriure dolor in hendrerit in 

vulputate velit</a></li>

<li><a href="#">Duis autem vel eum iriure dolor in hendrerit in 

vulputate velit</a></li>

                       

                    </ul>

                </div>

            </div>

          

           </div>

      </div>

    </div>

  </div>

</div>


@endsection