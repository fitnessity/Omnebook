<link href="<?php echo Config::get('constants.FRONT_CSS'); ?>jquery.lineProgressbar.css" rel="stylesheet" type="text/css">
<script src="<?php echo Config::get('constants.FRONT_JS'); ?>jquery.lineProgressbar.js"></script>
<script type="text/javascript">
$(document).ready(function() {
  $('#5star').LineProgressbar({
    percentage:$('#5star').data('percentage'),
    usercount:$('#5star').data('value'),
    radius: '3px',
    height: '20px',
    fillBackgroundColor: '#9fc05a'
  });

  $('#4star').LineProgressbar({
    percentage:$('#4star').data('percentage'),
    usercount:$('#4star').data('value'),
    radius: '3px',
    height: '20px',
    fillBackgroundColor: '#b1dc33'
  });

  $('#3star').LineProgressbar({
    percentage:$('#3star').data('percentage'),
    usercount:$('#3star').data('value'),
    radius: '3px',
    height: '20px',
    fillBackgroundColor: '#ffd834'
  });

  $('#2star').LineProgressbar({
    percentage:$('#2star').data('percentage'),
    usercount:$('#2star').data('value'),
    radius: '3px',
    height: '20px',
    fillBackgroundColor: '#ffb234'
  });

  $('#1star').LineProgressbar({
    percentage:$('#1star').data('percentage'),
    usercount:$('#1star').data('value'),
    radius: '3px',
    height: '20px',
    fillBackgroundColor: '#ff8b5a'
  });

});
</script>
<div class="business-right">
    <div class="business-star business-profile-star">
      <?php $userRatings = getUserRatings(Auth::user()->id);?>
      <?php $userFollowersCount = getUserFollowerCount(Auth::user()->id); ?>
<a href="/reviews"><button class="nw-view-profile">Write a review</button></a>
      <div class="grey-star">
      <a href="/reviews" title="Click for more details.">
        <h2>{{ $userRatings['totalAvg'] }}</h2>
        <div class="start-list">
        @for($i=1; $i<=round($userRatings['totalAvg']); $i++)
          <i class="fa fa-star" aria-hidden="true"></i>
        @endfor                              
        <?php $remaining_rating = 5 - round($userRatings['totalAvg']); ?>
        @for($i=1; $i<=$remaining_rating; $i++)
          <i class="fa fa-star grey-star-i" aria-hidden="true"></i>
        @endfor
        </div>
        <span><i class="fa fa-user" aria-hidden="true"></i>{{ $userRatings['totalRatingsUserCount'] }}</span>
      </a>
      </div>

      @if(count($userRatings['ratings']) > 0)
        <ul class="star-line">
        @foreach($userRatings['ratings'] as $key=>$value)
          <?php
            $ratingpercentage = $value['ratingPercentage'];
           ?>
          <li class="desc-popover" data-container="body" data-toggle="popover" data-placement="left" data-content="{{ $value['ratingUserCount'] }}" data-original-title="">
            <i class="fa fa-star" aria-hidden="true"> {{$key}}</i>
            <span id="{{$key}}star" data-percentage="{{$ratingpercentage}}" data-value="{{ $value['ratingUserCount'] }}"></span>
          </li>
        @endforeach
        </ul>
      @endif
    </div>

    <div class="activity-ranking">
      <ul>
        @if(Auth::user()['role'] == "business")
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
        @endif
        <li>

          <h3 style="color:white">PROFILE REVIEWS</h3>
          <p>24,345,678</p>
        </li>
        <li>
          @if($userFollowersCount > 1 )
          <h3 style="color:white">FOLLOWERS</h3>
          @else
          <h3 style="color:white">FOLLOWERS</h3>
          @endif
          <p>{{ $userFollowersCount }}</p>
        </li>
        <li>
          <span> <img src="<?php echo Config::get('constants.FRONT_IMAGE');; ?>usa-round.png" height="47" width="47" /> </span>
          <p>New York,  United State, 11:00 PM <br/>
            Member Since: 12th April 2016</p>
        </li>
      </ul>
    </div>

    <div class="sponsered">
      <h2>SPONSERED</h2>
        <img src="<?php echo Config::get('constants.FRONT_IMAGE'); ?>sidebarimg-3.jpg" height="226" width="322" />
        <img src="<?php echo Config::get('constants.FRONT_IMAGE'); ?>sidebarimg-2.jpg" height="461" width="322" />
    </div>
  </div>