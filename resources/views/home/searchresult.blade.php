@extends('layouts.header')



@section('content')



<section class="popular-search inner_top">

    <div class="container">

        <h2>SEARCH &nbsp;&nbsp; RESULT</h2>

        <ul>

            @if(count($result) > 0)
<?php // print_r($result[0]);die;?>
                @foreach($result as $professional)

                    <li>
                        
                      

                        @if($professional['logo'] != '' && file_exists(public_path().DIRECTORY_SEPARATOR.'uploads'.DIRECTORY_SEPARATOR.'profile_pic'.DIRECTORY_SEPARATOR.$professional['logo']))

                            <img src="<?php echo Config::get('constants.USER_IMAGE_THUMB').$professional['logo'] ?>" height="415" width="354"/>

                        @else

                            <img src="<?php echo Config::get('constants.FRONT_IMAGE').'user.png' ?>" height="415" width="354"/>

                        @endif



                         @if(Auth::user() && Auth::user()->role === 'customer')

                            <a href="/directhire/viewprofile/{{ $professional['id'] }}" data-toggle="modal" data-target="#profiledetail_modal" class="question-icon" title="Click here to view full profile">

                                <i class="fa fa-info" aria-hidden="true"></i>

                            </a>

                         @elseif(!Auth::user())

                            <a data-toggle="modal" data-target="#login_modal" href="/auth/jsModallogin" class="question-icon" title="Login to view full profile">

                                <i class="fa fa-info" aria-hidden="true"></i>

                            </a>

                         @else

                            <a href="/directhire/viewprofile/{{ $professional['id'] }}" class="question-icon" title="">

                                <i class="fa fa-info" aria-hidden="true"></i>

                            </a>

                         @endif

                            

                        <div class="pop-search-detail">

                            <h4>{{ $professional['company_name'] }}</h4>

                            <p>{{$professional['user_sports']}}</p>

                             @if(Auth::user() && Auth::user()->role === 'customer')
                           
                                <a title="Click here to book professional" href="/directhire/viewprofile/{{ $professional['id'] }}">
                                    <button type="button" class="btn btn-info btn-lg" style="background: #f53b49;" >Book Activity<i class="fa fa-angle-double-right" aria-hidden="true"></i></button>
                                </a>
                            @elseif(!Auth::user())
                                <a data-toggle="modal" data-target="#login_modal" href="/auth/jsModallogin">
                                    <button type="button" class="btn btn-info btn-lg" style="background: #f53b49;">LOGIN TO HIRE <i class="fa fa-angle-double-right" aria-hidden="true"></i></button>
                                </a>
                            @endif

                        </div>

                    </li>

                @endforeach

            @else

            <li> <h3>No Result Found</h3> </li>

            @endif                

        </ul>                 

    </div>

</section>

@include('includes.network_profile_details')

<!-- professional detail modal -->

<div class="modal fade" id="professionaldetail_modal" role="dialog">

  <div class="modal-dialog modal-lg">

        <div  id="professionaldetail_modal_content"></div>

        <div class="modal-body login-pad">

            <div class="pop-title employe-title">

                <h3>Profile</h3>

            </div>

            <button type="button" class="close modal-close" data-dismiss="modal">

                <img src="<?php echo Config::get('constants.FRONT_IMAGE'); ?>close.jpg" height="70" width="34"/>

            </button>

            <div class="modal-content signup">                

            </div>

        </div>

  </div>

</div>

@include('layouts.footer')

<script src="<?php echo Config::get('constants.FRONT_JS'); ?>owl.carousel.js"></script>



<script defer src="<?php echo Config::get('constants.FRONT_JS'); ?>jquery.flexslider.js"></script>



<script type="text/javascript" src="<?php echo Config::get('constants.FRONT_JS'); ?>lightbox.js"></script>



<script type="text/javascript" src="<?php echo Config::get('constants.FRONT_JS'); ?>home.js"></script>



<script>

    $(document).ready(function(){

        $("body, html").animate({

            scrollTop: $(".banner-bottom").position().top

        });

    });

</script>



@endsection