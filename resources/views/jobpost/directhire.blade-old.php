@extends('layouts.app')



@section('content')

<style>
    .direc-list-detail p span {
        font-size: 14px !important;
    }

    .direc-right ul li i {
        padding-right: 0px;
    }

    .book-professional-link,
    .book-professional-link:hover {
        color: #ffffff !important;
        background: #f53b49 !important;
        padding: 6px;
    }

    /* td.booking_btn{
        background:  !important;
    }*/
    .modal-header .close {
        margin-top: -2px !important;
    }

    @media (min-width: 992px) {
        .modal-lg {
            width: 980px;
        }
    }

    .contentPop {
        width: 100% !important;
        margin-left: 0 !important;
        height: auto !important;
        padding: 0px 10px !important;
    }

    tr.d_none {
        display: none;
    }

    td.bg_color {
        background: #f53b49;
        color: #fff;
        font-weight: bold;
        border: 1px dotted white !important;
        border-left: 1px solid #575656 !important;
    }

    div#id01 {
        padding: 0px !important;

    }

    table.compareItemParent.relPos.comparetable {
        margin: 0 !important;
    }

    a.whiteFont.w3-padding.w3-closebtn.closeBtn {
        color: #fff !important;
        padding: 8px 16px !important;
        background: #f53b49 !important;
        position: initial !important;
        margin-right: 14.2% !important;
        float: right !important;
    }

    .w3-row.contentPop.w3-margin-top {
        margin-top: 0px !important;
    }

    .compareThumb {
        height: 150px;
        width: 150px;
        border: 3px solid #f53b49;
        border-radius: 50%;
        box-shadow: 3px 3px 7px 0px #808080ab;
    }

</style>

<link rel="stylesheet" href="<?php echo Config::get('constants.FRONT_CSS'); ?>compare/style.css">

<link rel="stylesheet" href="<?php echo Config::get('constants.FRONT_CSS'); ?>compare/w3.css">

<script src="<?php echo Config::get('constants.FRONT_JS'); ?>compare/Compare.js"></script>

<script src="<?php echo Config::get('constants.FRONT_JS'); ?>compare/jquery-1.9.1.min.js"></script>

<section class="direc-hire">

    @include('includes.search_category_sidebar')

    <div class="direc-right">

        <!-- <h1>PROFESSIONAL IN YOUR AREA</h1> -->
        <h1>RECOMMENDED BUSIENSSES NEAR YOU</h1>
        <div id="buisnessuser">
            <ul id="" class="drecthire-wrapper">

                @if(count($AllProfessionals) > 0)

                <?php $i=0; ?>

                @foreach($AllProfessionals as $professional)

                <?php $i++; ?>

                <li class="product selectProduct" data-id="{{ $professional['id'] }}" data-title="{{ $professional['first_name'] }}{{ $professional['id'] }}" data-name="{{ $professional['first_name'] }} {{ $professional['last_name'] }}" data-companyname="{{ $professional['company_name'] }}" data-email="{{ $professional['email'] }}" data-address="{{ $professional['state'] }}">



                    <div class="direc-right-listdiv">

                        <a href="#">

                            @if($professional['logo'] != '' && file_exists(public_path().DIRECTORY_SEPARATOR.'uploads'.DIRECTORY_SEPARATOR.'profile_pic'.DIRECTORY_SEPARATOR.'thumb'.DIRECTORY_SEPARATOR.$professional['logo']))

                            <img src="<?php echo Config::get('constants.USER_IMAGE_THUMB').$professional['logo'] ?>" class="productImg" />

                            @else

                            <img src="<?php echo Config::get('constants.FRONT_IMAGE').'user.png' ?>" class="productImg" />

                            @endif

                        </a>

                        <div class="direc-list-name">

                            <p>{{$professional['company_name'] }} {{ $professional['first_name'] }} {{ $professional['last_name'] }} </p>

                            <a href="#"><i class="fa fa-thumbs-up" aria-hidden="true"></i>18</a>

                        </div>

                        <div class="direc-list-detail">





                            <span> <i class="fa fa-map-marker" aria-hidden="true"></i>

                                {{ $professional['state'] }} {{ $professional['zip_code'] }} </span>

                            </p>

                        </div>

                        <a href="/directhire/viewprofile/{{ $professional['id'] }}" class="view-more-right">VIEW MORE

                            <i class="fa fa-angle-right" aria-hidden="true"></i>

                        </a>



                    </div>

                    <a class="addToCompare" title="Add to Compare">+ Add to Compare</a>

                </li>

                @endforeach

                @else

                No Record Found

                @endif

            </ul>

            <div class="pagination_div" style="">
                {!! $AllProfessionals->render() !!}
                <div>
                </div>


            </div>

</section>
<style>
    ul.pagination li {
        width: 0px;
        padding: 1px 20px;
    }

    ul.pagination {
        width: 100%;
        display: inline-flex !important;
    }

</style>


<!--preview panel-->

<div class="w3-container  w3-center">

    <div class="w3-row w3-card-4 w3-round-large w3-border comparePanle w3-margin-top">

        <div class="w3-row">

            <div class="w3-col l12 m12 s12 w3-margin-top">

                <h4 style="text-transform: uppercase;">Added for Comparison</h4>

            </div>

            <!--  <div class="w3-col l3 m4 s6 w3-margin-top">

                    &nbsp;
                    <button type="button" class="btn btn-primary notActive cmprBtn" data-toggle="modal" data-target="#myModal" disabled>Compare</button>
                     <button class="w3-round-small w3-border notActive cmprBtn" disabled>Compare</button> 

                </div> -->

        </div>

        <div class=" titleMargin w3-container comparePan">
            <button type="button" class="btn btn-primary notActive cmprBtn addtcmpr-btn" data-toggle="modal" data-target="#myModal" disabled>Compare</button>
        </div>

    </div>

</div>

<!--end of preview panel-->










<!-- The Modal -->
<div class="modal fade" id="myModal">
    <div class="modal-dialog modal-lg">
        <div class="modal-content" style="background: #cecece !important;">

            <!-- Modal Header -->
            <div class="modal-header">
                <!-- <h4 class="modal-title">Modal Heading</h4> -->
                <button type="button" class="close" data-dismiss="modal" onclick="location.reload();">&times;</button>
            </div>

            <!-- Modal body -->
            <div class="modal-body" style="padding: 0px;">
                <!--  <div id="id01" class="w3-animate-zoom w3-white w3-modal modPos"> -->
                <div class="w3-row contentPop w3-margin-top">

                </div>

                <!--  </div> -->
            </div>

            <!-- Modal footer -->
            <!-- <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div> -->

        </div>
    </div>
</div>
<!-- comparision popup-->



<!--end of comparision popup-->



<!--  warning model  -->

<div id="WarningModal" class="w3-modal">

    <div class="w3-modal-content warningModal">

        <header class="w3-container w3-teal" style="background-color:#f53b49 !important;">

            <h3>

                <span>&#x26a0;</span>Error

                <button id="warningModalClose" onclick="document.getElementById('id01').style.display='none'" class="w3-btn w3-hexagonBlue w3-margin-bottom" style="float:right;background-color:#f53b49 !important;">X</button>

            </h3>

        </header>

        <div class="w3-container">

            <h4>Maximum of Three products are allowed for comparision</h4>

        </div>

    </div>

</div>

<!--  end of warning model  -->

</div>



<script>
    // function favourite(id,type)

    // {

    //     $.ajax({

    //         type:"POST",

    //         data:{fav_user_id:id,type:type},

    //         url:"{{url('/isfavourite')}}",

    //         headers: {'X-XSRF-TOKEN': '{{\Illuminate\Support\Facades\Crypt::encrypt(csrf_token())}}'},

    //         success:function()

    //         {

    //             var html="";

    //             var selectetype;

    //             if(type == "favourite")

    //             {

    //                 selectetype = "unfavourite";

    //                  html +='<a onclick="favourite(' + id + ',\'' + selectetype + '\')" class="removefavourite_'+id+'"><i class="fa fa-star"></i></a>';



    //                 $('#userFavourite_'+id).html('');

    //                 $('#userFavourite_'+id).append(html);



    //             }

    //             else

    //             {

    //                 selectetype = "favourite";

    //                 html +='<a onclick="favourite(' + id + ',\'' + selectetype + '\')" class="makefavourite_'+id+'"><i class="fa fa-star-o"></i></a>';

    //                  $('#userFavourite_'+id).html('');

    //                  $('#userFavourite_'+id).append(html);

    //             }

    //         }

    //     });       

    // }

</script>

@endsection
<style>
    a.page-link:focus {
        background-color: #f53b49 !important;
        color: #fff !important;
    }

    li.page-item {
        width: auto !important;
        margin: 0px !important;
        padding: 0px !important;
    }

</style>
