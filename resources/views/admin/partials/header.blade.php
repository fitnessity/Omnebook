<header class="main-header">

    <!-- Logo -->

    <a href="/admin/dashboard" class="logo">

      <img src="<?php echo Config::get('constants.FRONT_IMAGE'); ?>logo.png" style="height:auto;width:190px;" />

      <!-- mini logo for sidebar mini 50x50 pixels -->

      <!-- <span class="logo-mini"><b>A</b>LT</span> -->

      <!-- logo for regular state and mobile devices -->

      <!-- <span class="logo-lg"><b>Fit</b>nessity</span> -->

    </a>

    <!-- Header Navbar: style can be found in header.less -->

    <nav class="navbar navbar-static-top">

      <!-- Sidebar toggle button-->

      <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">

        <span class="sr-only">Toggle navigation</span>

      </a>



      <div class="navbar-custom-menu">

        <ul class="nav navbar-nav">

          <!-- Messages: style can be found in dropdown.less-->

          

          <!-- Notifications: style can be found in dropdown.less -->

          

          <!-- Tasks: style can be found in dropdown.less -->

          

          <!-- User Account: style can be found in dropdown.less -->

          <li class="dropdown user user-menu">

            <a href="#" class="dropdown-toggle" data-toggle="dropdown">

              <?php

              if(Auth::user() && Auth::user()->profile_pic != '' && file_exists(public_path().DIRECTORY_SEPARATOR.'uploads'.DIRECTORY_SEPARATOR.'profile_pic'.DIRECTORY_SEPARATOR.'thumb150'.DIRECTORY_SEPARATOR.Auth::user()->profile_pic)) {

                echo '<img src="'.Config::get('constants.USER_IMAGE_THUMB150').Auth::user()->profile_pic.'" class="user-image"/>';

              }

              else {

                echo '<img src="'.Config::get('constants.FRONT_IMAGE').'user.png" class="user-image" />';

              }

              ?>

              <span class="hidden-xs">{{Auth::user()->firstname}} {{Auth::user()->lastname}}</span>

            </a>

            <ul class="dropdown-menu">

              <!-- User image -->

              <li class="user-header">

                <?php

                if(Auth::user()->profile_pic != '' && file_exists(public_path().DIRECTORY_SEPARATOR.'uploads'.DIRECTORY_SEPARATOR.'profile_pic'.DIRECTORY_SEPARATOR.Auth::user()->profile_pic)) {

                  echo '<img src="'.Config::get('constants.USER_IMAGE').Auth::user()->profile_pic.'" class="img-circle"/>';

                }

                else {

                  echo '<img src="'.Config::get('constants.FRONT_IMAGE').'user.png" class="img-circle" />';

                }

                ?>

                <p>

                  {{Auth::user()->firstname}} {{Auth::user()->lastname}}

                  <!-- <small>Member since Nov. 2012</small> -->

                </p>

              </li>

              <!-- Menu Body -->

              <!-- <li class="user-body">

                <div class="row">

                  <div class="col-xs-4 text-center">

                    <a href="#">Followers</a>

                  </div>

                  <div class="col-xs-4 text-center">

                    <a href="#">Sales</a>

                  </div>

                  <div class="col-xs-4 text-center">

                    <a href="#">Friends</a>

                  </div>

                </div>

              </li> -->

              <!-- Menu Footer-->

              <li class="user-footer">

                <div class="pull-left">

                  <a href="/admin/profile/editprofiledetail" class="btn btn-default btn-flat">Profile</a>

                </div>

                <div class="pull-right">

                  <a href="/admin/logout" class="btn btn-default btn-flat">Sign out</a>

                </div>

              </li>

            </ul>

          </li>

          <!-- Control Sidebar Toggle Button -->

         <!--  <li>

            <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>

          </li> -->

        </ul>

      </div>

    </nav>

  </header>

  