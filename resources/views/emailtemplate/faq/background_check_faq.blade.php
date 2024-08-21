@extends('layouts.profile')



@section('content')

<?php /*




<link href="<?php echo Config::get('constants.FRONT_CSS'); ?>sweet-alert/sweetalert.css" rel="stylesheet">



<script src="<?php echo Config::get('constants.FRONT_JS'); ?>sweet-alert/sweetalert.min.js"></script>

<script src="<?php echo Config::get('constants.FRONT_JS'); ?>ratings.js"></script>

*/ ?>

<style>
     .panel-group {
    margin-bottom: 35px !important;
}
.col-sm-12.text-center.wow.fadeInDown {
    margin: 3% 0px !important;
}

     .faq .panel-group{padding:30px 0; padding: 20px 30px; box-shadow: 0 0 20px #ddd;  }

    .faq .panel-default > .panel-heading{ border: none; background: none; padding: 0;}

    .faq .panel-default{ border: none;}

    .faq .panel-body{ position: relative; border: none!important; box-shadow: none; }

   

    background: -moz-linear-gradient(left, rgba(100,168,236,1) 0%, rgba(70,132,215,1) 100%); /* FF3.6-15 */

    background: -webkit-linear-gradient(left, rgba(100,168,236,1) 0%,rgba(70,132,215,1) 100%); /* Chrome10-25,Safari5.1-6 */

    background: linear-gradient(to right, rgba(100,168,236,1) 0%,rgba(70,132,215,1) 100%); /* W3C, IE10+, FF16+, Chrome26+, Opera12+, Safari7+ */

  filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#64a8ec', endColorstr='#4684d7',GradientType=1 ); /* IE6-9 */}

  .faq h4 a.collapsed{ background: #fff; color: #1c1c1c; padding: 15px; font-size: 20px; font-family: 'Roboto-Medium'; text-decoration: none; display: block; border-radius: 0; position: relative;}

  .faq h4 a{ position: relative; padding: 15px; font-size: 20px; font-family: 'Roboto-Medium'; text-decoration: none; display: block; border-radius: 0; color: #fff; border-bottom: 1px #ddd solid; background: rgb(100,168,236); /* Old browsers */

  background: -moz-linear-gradient(left, rgba(100,168,236,1) 0%, rgba(70,132,215,1) 100%); /* FF3.6-15 */

  background: -webkit-linear-gradient(left, rgba(100,168,236,1) 0%,rgba(70,132,215,1) 100%); /* Chrome10-25,Safari5.1-6 */

  background: linear-gradient(to right, rgba(100,168,236,1) 0%,rgba(70,132,215,1) 100%); /* W3C, IE10+, FF16+, Chrome26+, Opera12+, Safari7+ */

filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#64a8ec', endColorstr='#4684d7',GradientType=1 ); /* IE6-9 */}



.faq h4 a.collapsed:before{ background: url(../img/plus.png) no-repeat; position: absolute; top: 10px; right: 10px; content: ''; width: 33px; height: 33px; }

.faq h4 a:before{ background: url(../img/minus.png) no-repeat; position: absolute; top: 10px; right: 10px; content: ''; width: 33px; height: 33px;  }

</style>

<?php /*

    <div class="business-offer-main">

    @include('includes.sidebar_profile_left')

*/?>



  <?php // <div class="business-middle"> ?>

    

    <?php // @include('includes.profile_tab_menu') ?>



        

          <!-- FAQ -->

          <div class="midsection faq">

            <div class="container">

              <div class="row">

                <div class="col-sm-12 text-center wow fadeInDown">

                  <h2>Background Check FAQ</h2>

                </div>

                <div class="col-sm-12 wow fadeInUp">

                  <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">

                    @foreach ($data as $help)

                    @if($loop->iteration == 1)

                    <div class="panel panel-default">

                      <div class="panel-heading" role="tab" id="heading{{$help->id}}">

                        <h4 class="panel-title">

                          <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse{{$help->id}}" aria-expanded="true" aria-controls="collapse{{$help->id}}">

                            {{$help->qustion}}

                          </a>

                        </h4>

                      </div>

                      <div id="collapse{{$help->id}}" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="heading{{$help->id}}">

                        <div class="panel-body">

                          <p>{!!$help->answer!!}</p>

                        </div>

                      </div>

                    </div>

                    @else

                    <div class="panel panel-default">

                      <div class="panel-heading" role="tab" id="heading{{$help->id}}">

                        <h4 class="panel-title">

                          <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse{{$help->id}}" aria-expanded="false" aria-controls="collapse{{$help->id}}">

                            {{$help->qustion}}

                          </a>

                        </h4>

                      </div>

                      <div id="collapse{{$help->id}}" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading{{$help->id}}">

                        <div class="panel-body">

                          <p>{!!$help->answer!!}</p>

                        </div>

                      </div>

                    </div>

                    @endif

                    @endforeach

                  </div>

                </div>

              </div>

            </div>

          </div>



  <?php // </div> ?>



<?php /*

  @include('includes.sidebar_profile_right')



</div>



*/?>
@endsection