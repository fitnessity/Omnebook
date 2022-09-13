@extends('layouts.header')
@section('content')
    <!-- Modal content-->

  <div class="modal-body login-pad" style="width: 100%">


    <div class="pop-title">

      <!-- <h3>Sub Level Sports</h3> -->
      <h3>{{$parent_sport_name}}</h3>

    </div>

    <button type="button" class="close modal-close" data-dismiss="modal">

      <img src="<?php echo Config::get('constants.FRONT_IMAGE'); ?>close.jpg" height="70" width="34"/>

    </button>

   <div class="cat-container">

    <div class="cate-list" style="width: 100% !important;">
    @foreach($child_sports as $sports_key => $sports_value)
        <div class="cat-item style_prevu_sp" style="width: 315px !important;">
            <span>
            <div class="cat-img-name width-img">
            <span><div class="sports_name"><span>{{ $sports_value->sport_name }}</span></div></span>
                <img src="<?php echo Config::get('constants.SPORTS_IMAGE_THUMB'); ?>{{ $sports_value->image }}" height="466" width="313" />
                <p>&nbsp;</p>
                <div class="pop-search-detail-sports">
                    <h4>{{ $sports_value->sport_name }}</h4>
                    @if(!empty($sports_value->description))
                    <h5>{{ $sports_value->description }}</h5>@endif
                </div>
            </div>
            <div class="cat-detail">
                <h1>{{ $sports_value->sport_name }}</h1>
                @if(Auth::user())
                    <!-- <a href="direct-hire?selected_sport={{ $sports_value->id }}" title="Click here to book professional">
                        Book Now
                    </a> -->
                     @if($sports_value->booking_option == 'Professional')
                       {{-- <a title="Click here to book professional" data-toggle="modal" data-target="#lesson_modal" href="/lesson/jsModallesson/booklesson/{{ $sports_value->id }}">
                            Book Now
                        </a> --}}
                        <a title="Click here to book professional" class="gf" sp_id="{{$sports_value->booking_option}}" data-toggle="modal" data-target="#lesson_modal" href="/lesson/jsModallesson/booklesson/{{ $sports_value->id }}">
                            Book Now
                        </a>
                        @elseif($sports_value->booking_option == 'All') 
                                <a title="Click here to book professional" class="gf" sp_id="{{$sports_value->booking_option}}" data-toggle="modal" data-target="#lesson_modal" href="/lesson/jsModallesson/booklesson/{{ $sports_value->id }}">
                                Book Now
                            </a>
                        @else
                        <a class="gf" sp_id="{{$sports_value->booking_option}}" href= "<?php echo '/direct-hire?selected_sport='.$sports_value->id; ?>">Book Now</a>
                        @endif
                @else
                    <a type="button" data-toggle="modal" data-target="#login_modal" href="/auth/jsModallogin/{{ $sports_value->id }}" title="Login to book professional" onclick="$('#child_sports_modal').modal('hide');">Book Now</a>
                 @endif
            </div>
            <br><br>
            <span>
        </div>
    @endforeach
    </div>
    </div>
  </div>
  <script>
      $(document).ready(function(){
           $('.gf').click(function(){
                localStorage.setItem('myData',$(this).attr('sp_id'))
            })
      })
  </script>
  @include('layouts.footer')
@endsection