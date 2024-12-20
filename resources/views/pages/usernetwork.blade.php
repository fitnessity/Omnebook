@extends('layouts.profile')

@section('content')


<div class="business-offer-main">


      @include('includes.sidebar_profile_left')

  
  <div class="business-middle">

    <div class="business-title">

      <h1>WELCOME TO OMNEBOOK</h1>

      <p>Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. 

        Vestibulum tortor quam, feugiat vitae, ultricies eget, tempor sit amet, ante.</p>

    </div>

    <div class="network_block">

      <ul class="network-list">

          <li>

              <div class="network-img">

                  <img src="<?php echo Config::get('constants.FRONT_IMAGE'); ?>freinds.jpg" alt="" width="219" height="310"/>

                    <a href="#" class="remove-network"><img src="<?php echo Config::get('constants.FRONT_IMAGE'); ?>no-friend.png" alt="" width="30" height="30"/></a>

                </div>

                <div class="network-name">

                  <a href="#" class="remove-network"><img src="<?php echo Config::get('constants.FRONT_IMAGE'); ?>add-friend.png" alt="" width="30" height="30"/></a>

                    <p>Vestibulum tortor</p>

                </div>

            </li>

            <li>

              <div class="network-img">

                  <img src="<?php echo Config::get('constants.FRONT_IMAGE'); ?>freinds1.jpg" alt="" width="219" height="310"/>

                    <a href="#" class="remove-network"><img src="<?php echo Config::get('constants.FRONT_IMAGE'); ?>no-friend.png" alt="" width="30" height="30"/></a>

                    

                </div>

                <div class="network-name">

                  <a href="#" class="remove-network"><img src="<?php echo Config::get('constants.FRONT_IMAGE'); ?>add-friend.png" alt="" width="30" height="30"/></a>

                    <p>Vestibulum tortor</p>

                </div>

            </li>

            <li>

              <div class="network-img">

                  <img src="<?php echo Config::get('constants.FRONT_IMAGE'); ?>freinds2.jpg" alt="" width="219" height="310"/>

                    <a href="#" class="remove-network"><img src="<?php echo Config::get('constants.FRONT_IMAGE'); ?>no-friend.png" alt="" width="30" height="30"/></a>

                </div>

                <div class="network-name">

                  <a href="#" class="remove-network"><img src="<?php echo Config::get('constants.FRONT_IMAGE'); ?>add-friend.png" alt="" width="30" height="30"/></a>

                    <p>Vestibulum tortor</p>

                </div>

            </li>

            <li>

              <div class="network-img">

                  <img src="<?php echo Config::get('constants.FRONT_IMAGE'); ?>freinds.jpg" alt="" width="219" height="310"/>

                    <a href="#" class="remove-network"><img src="<?php echo Config::get('constants.FRONT_IMAGE'); ?>no-friend.png" alt="" width="30" height="30"/></a>

                </div>

                <div class="network-name">

                  <a href="#" class="remove-network"><img src="<?php echo Config::get('constants.FRONT_IMAGE'); ?>add-friend.png" alt="" width="30" height="30"/></a>

                    <p>Vestibulum tortor</p>

                </div>

            </li>

            <li>

              <div class="network-img">

                  <img src="<?php echo Config::get('constants.FRONT_IMAGE'); ?>freinds1.jpg" alt="" width="219" height="310"/>

                    <a href="#" class="remove-network"><img src="<?php echo Config::get('constants.FRONT_IMAGE'); ?>no-friend.png" alt="" width="30" height="30"/></a>

                    

                </div>

                <div class="network-name">

                  <a href="#" class="remove-network"><img src="<?php echo Config::get('constants.FRONT_IMAGE'); ?>add-friend.png" alt="" width="30" height="30"/></a>

                    <p>Vestibulum tortor</p>

                </div>

            </li>

            <li>

              <div class="network-img">

                  <img src="<?php echo Config::get('constants.FRONT_IMAGE'); ?>freinds2.jpg" alt="" width="219" height="310"/>

                    <a href="#" class="remove-network"><img src="<?php echo Config::get('constants.FRONT_IMAGE'); ?>no-friend.png" alt="" width="30" height="30"/></a>

                </div>

                <div class="network-name">

                  <a href="#" class="remove-network"><img src="<?php echo Config::get('constants.FRONT_IMAGE'); ?>add-friend.png" alt="" width="30" height="30"/></a>

                    <p>Vestibulum tortor</p>

                </div>

            </li>

            <li>

              <div class="network-img">

                  <img src="<?php echo Config::get('constants.FRONT_IMAGE'); ?>freinds.jpg" alt="" width="219" height="310"/>

                    <a href="#" class="remove-network"><img src="<?php echo Config::get('constants.FRONT_IMAGE'); ?>no-friend.png" alt="" width="30" height="30"/></a>

                </div>

                <div class="network-name">

                  <a href="#" class="remove-network"><img src="<?php echo Config::get('constants.FRONT_IMAGE'); ?>add-friend.png" alt="" width="30" height="30"/></a>

                    <p>Vestibulum tortor</p>

                </div>

            </li>

            <li>

              <div class="network-img">

                  <img src="<?php echo Config::get('constants.FRONT_IMAGE'); ?>freinds1.jpg" alt="" width="219" height="310"/>

                    <a href="#" class="remove-network"><img src="<?php echo Config::get('constants.FRONT_IMAGE'); ?>no-friend.png" alt="" width="30" height="30"/></a>

                    

                </div>

                <div class="network-name">

                  <a href="#" class="remove-network"><img src="<?php echo Config::get('constants.FRONT_IMAGE'); ?>add-friend.png" alt="" width="30" height="30"/></a>

                    <p>Vestibulum tortor</p>

                </div>

            </li>

            <li>

              <div class="network-img">

                  <img src="<?php echo Config::get('constants.FRONT_IMAGE'); ?>freinds2.jpg" alt="" width="219" height="310"/>

                    <a href="#" class="remove-network"><img src="<?php echo Config::get('constants.FRONT_IMAGE'); ?>no-friend.png" alt="" width="30" height="30"/></a>

                </div>

                <div class="network-name">

                  <a href="#" class="remove-network"><img src="<?php echo Config::get('constants.FRONT_IMAGE'); ?>add-friend.png" alt="" width="30" height="30"/></a>

                    <p>Vestibulum tortor</p>

                </div>

            </li>

           

        </ul>

      <span class="loading-text">Loading...</span>

    </div>

    

  </div>

  @include('includes.sidebar_profile_right')

</div>

@endsection