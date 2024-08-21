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

    <ul class="event-list">

    <li>

    <a href="#"><img src="<?php echo Config::get('constants.FRONT_IMAGE'); ?>event/1.jpg" height="310" width="219" /></a>

    <div class="event-title">

    <span>APRIL</span>

    <p>01</p>

    <a href="#">Vestibulum tortor</a>

    </div>

    </li>

     <li>

    <a href="#"><img src="<?php echo Config::get('constants.FRONT_IMAGE'); ?>event/2.jpg" height="310" width="219" /></a>

    <div class="event-title">

    <span>APRIL</span>

    <p>01</p>

    <a href="#">Vestibulum tortor</a>

    </div>

    </li>

     <li>

    <a href="#"><img src="<?php echo Config::get('constants.FRONT_IMAGE'); ?>event/3.jpg" height="310" width="219" /></a>

    <div class="event-title">

    <span>APRIL</span>

    <p>01</p>

    <a href="#">Vestibulum tortor</a>

    </div>

    </li>

     <li>

    <a href="#"><img src="<?php echo Config::get('constants.FRONT_IMAGE'); ?>event/4.jpg" height="310" width="219" /></a>

    <div class="event-title">

    <span>APRIL</span>

    <p>01</p>

    <a href="#">Vestibulum tortor</a>

    </div>

    </li>

     <li>

    <a href="#"><img src="<?php echo Config::get('constants.FRONT_IMAGE'); ?>event/5.jpg" height="310" width="219" /></a>

    <div class="event-title">

    <span>APRIL</span>

    <p>01</p>

    <a href="#">Vestibulum tortor</a>

    </div>

    </li>

     <li>

    <a href="#"><img src="<?php echo Config::get('constants.FRONT_IMAGE'); ?>event/6.jpg" height="310" width="219" /></a>

    <div class="event-title">

    <span>APRIL</span>

    <p>01</p>

    <a href="#">Vestibulum tortor</a>

    </div>

    </li>

    

    </ul>

      

    

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

  @include('includes.sidebar_profile_right')

</div>


@endsection