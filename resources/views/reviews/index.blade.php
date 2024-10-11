<?php /*
@extends('layouts.profile')

@section('content')

<link href="<?php echo Config::get('constants.FRONT_CSS'); ?>sweet-alert/sweetalert.css" rel="stylesheet">

<script src="<?php echo Config::get('constants.FRONT_JS'); ?>sweet-alert/sweetalert.min.js"></script>
<script src="<?php echo Config::get('constants.FRONT_JS'); ?>ratings.js"></script>
*/ ?>

<?php /*
    <div class="business-offer-main">
    @include('includes.sidebar_profile_left')
*/?>

  <?php // <div class="business-middle"> ?>
    
    <?php // @include('includes.profile_tab_menu') ?>

    
    <div id="write-tab">
      <div class=" review-dtl-block">
        @if(count($reviews) > 0)
          @foreach($reviews as $review)
          <div class="review-list-block">
            <div class="row">
                 <div class="col-lg-2 col-md-2 col-sm-7 col-xs-12">
                    <span class="review-user">
                      <?php
                       $reviewByUser = getUserById($review['reviewby_userid']);
                      
                      if($reviewByUser->profile_pic != '' && file_exists(public_path().DIRECTORY_SEPARATOR.'uploads'.DIRECTORY_SEPARATOR.'profile_pic'.DIRECTORY_SEPARATOR.'thumb150'.DIRECTORY_SEPARATOR.$reviewByUser->profile_pic)) 
                      {
                        echo '<img src="'.Config::get('constants.USER_IMAGE_THUMB150').$reviewByUser->profile_pic.'" width="352" height="314" title="'.$reviewByUser->firstname. ' '.$reviewByUser->lastname .'" />';
                        }
                        else {
                          echo '<img src="'.Config::get('constants.FRONT_IMAGE').'user.png" width="352" height="314" title="'.$reviewByUser->firstname. ' '.$reviewByUser->lastname .'" />';
                        }
                      ?>
                    </span>
                   </div>
                   <div class="col-lg-10 col-md-10 col-sm-9 col-xs-12">
                    <div class="review-detail">
                       
                        <h1>{{ ucwords($reviewByUser->firstname. ' '.$reviewByUser->lastname)  }}</h1>  
                        <p>{{ $review->title }}</p>
                          <div class="review-rate-block">
                            <div class="rate-star">
                              <?php 
                                $remaining_rating = 5 - $review->rating; ?>
                                @for($i=1; $i<=$remaining_rating; $i++)
                                  <span class="glyphicon .glyphicon-star-empty glyphicon-star-empty"></span>
                                @endfor
                                @for($i=1; $i<=$review->rating; $i++)
                                  <span class="glyphicon .glyphicon-star-empty glyphicon-star"></span>
                                @endfor                              
                            </div>
                            <span class="fontt14"><?php echo date('j<\s\up>S</\s\up> M Y', strtotime($review->created_at)); ?></span>
                          </div>
                          <div class="clearfix"></div>
                          <p>{{ $review->review }}</p>
                      </div>
                   </div>
              </div>
          </div>
          @endforeach
        @else
          <div class="review-list-block">
            <div class="row">
              <div class="col-lg-2 col-md-2 col-sm-7 col-xs-12">
                <span class="review-user">
                  <img src="{{ Config::get('constants.FRONT_IMAGE').'user.png' }}" alt="" width="352" height="314"></span>
               </div>
               <div class="col-lg-10 col-md-10 col-sm-9 col-xs-12">
                <div class="review-detail">
                  <div class="review-detail">
                    <h1></h1>
                      <div class="review-rate-block">
                        <span></span>
                      </div>
                      <div class="clearfix"></div>
                      <p>No reviews found</p>
                  </div>
                </div>
              </div>            
            </div>
          </div>
          
        @endif

        <div class="clearfix"></div>
        <div class="pagination_last">
          {!! $reviews->render() !!}
        </div>
      </div>
    </div>

  <?php // </div> ?>

<?php /*
  @include('includes.sidebar_profile_right')

</div>
@endsection
*/?>