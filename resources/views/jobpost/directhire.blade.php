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
    /* td.booking_btn{ background:  !important; }*/
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
    tr.d_none { display: none; }
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
<link href="https://code.jquery.com/ui/1.12.1/themes/pepper-grinder/jquery-ui.css" type="text/css" rel="stylesheet" />
<script src="<?php echo Config::get('constants.FRONT_JS'); ?>compare/Compare.js"></script>
<script src="<?php echo Config::get('constants.FRONT_JS'); ?>compare/jquery-1.9.1.min.js"></script>
<script src="{{ url('public/js/jquery-ui.min.js') }}"></script>
<script src="{{ url('public/js/jquery-ui.multidatespicker.js') }}"></script>
<section class="direc-hire">
    @include('includes.search_category_sidebar')
    <div class="direc-right direc-right-new">
        <div class="distance-block">
            <div class="distanceb">Distance <img src="{{ url('public/img/arrow-down.png') }}"></div>
            <div class="instantb">Instant Book <img src="{{ url('public/img/arrow-down.png') }}"></div>
            <div class="mapsb">Show Maps
                <label class="switch" for="maps">
                    <input type="checkbox" name="maps" id="maps" checked>
                    <span class="slider round"></span>
                </label>
            </div>
            <div class="barsb"><img src="{{ url('public/img/bars1.svg') }}"><img src="{{ url('public/img/bars2.svg') }}"></div>
        </div>

        <div class="twoblock">

            <!--<div class="miles-block">
                <span class="mitxt">5 miles</span>
                <div class="show-travel">
                    <p>
                        Show providers who are wiling to travel to me.
                        <a href="#" class="btn btn-web-btn">Search</a>
                    </p>
                    <p>
                        <label class="switch" for="travels">
                            <input type="checkbox" name="travels" id="travels">
                            <span class="slider round"></span>
                        </label>
                    </p>
                </div>
            </div>

            <div class="booking-blocka">
                <p>Show providers who accept booking instanly</p>
                <label class="switch" for="bookinginstanly">
                    <input type="checkbox" name="bookinginstanly" id="bookinginstanly">
                    <span class="slider round"></span>
                </label>
            </div>-->

        </div>

        <div class="col-md-8 leftside-kickboxing">
            <div class="col-md-12">
                <!--<h1>Recommended for Kickboxing</h1>-->
                <div class="col-md-6 kickboxing-block1">
                    <div class="topimg-content">
                        <img src="{{ url('public/img/adult-kickboxing.jpg') }}">
                        <div class="sorttext">
                            <div class="fromtxt">From #25 - #3000</div>
                            <div class="claimedtxt">CLAIMED</div>
                            <div class="favoritetxt"><i class="fa fa-heart-o"></i>FAVORITE</div>
                        </div>
                    </div>
                    <div class="bottom-content">
                        <div class="ratset-img">
                            <div class="rattxt"><i class="fa fa-star" aria-hidden="true"></i> 4.6 (146)</div>
                            <div class="volarimg"><img src="{{ url('public/img/volar.png') }}"></div>
                            <div class="verifiedimg"><img src="{{ url('public/images/verified-logo.png') }}"></div>
                        </div>
                        <h3>Adult Kickboxing Group Class</h3>
                        <h6>1. Volar Mixed Martial Arts</h6>
                        <p>New York, USA, 10023</p>
                        <h5>More Activites Offred: Kickboxing, MMA, Yoga, Self-Defense, Bjj <img src="{{ url('public/img/arrow-down.png') }}"></h5>
                        <hr>
                        <a href="#" class="moredetails-btn" data-toggle="modal" data-target="#mykickboxing">More Details</a>
                        <p>COMPARE SIMILAR OPTION +</p>
                    </div>
                </div>
                <div class="col-md-6 kickboxing-block1">
                    <div class="topimg-content">
                        <img src="{{ url('public/img/adult-kickboxing.jpg') }}">
                        <div class="sorttext">
                            <div class="fromtxt">From #25 - #3000</div>
                            <div class="claimedtxt">CLAIMED</div>
                            <div class="favoritetxt"><i class="fa fa-heart-o"></i>FAVORITE</div>
                        </div>
                    </div>
                    <div class="bottom-content">
                        <div class="ratset-img">
                            <div class="rattxt"><i class="fa fa-star" aria-hidden="true"></i> 4.6 (146)</div>
                            <div class="volarimg"><img src="{{ url('public/img/volar.png') }}"></div>
                            <div class="verifiedimg"><img src="{{ url('public/images/verified-logo.png') }}"></div>
                        </div>
                        <h3>Adult Kickboxing Group Class</h3>
                        <h6>1. Volar Mixed Martial Arts</h6>
                        <p>New York, USA, 10023</p>
                        <h5>More Activites Offred: Kickboxing, MMA, Yoga, Self-Defense, Bjj <img src="{{ url('public/img/arrow-down.png') }}"></h5>
                        <hr>
                        <a href="#" class="moredetails-btn" data-toggle="modal" data-target="#mykickboxing">More Details</a>
                        <p>COMPARE SIMILAR OPTION +</p>
                    </div>
                </div>
                <div class="col-md-6 kickboxing-block1">
                    <div class="topimg-content">
                        <img src="{{ url('public/img/adult-kickboxing.jpg') }}">
                        <div class="sorttext">
                            <div class="fromtxt">From #25 - #3000</div>
                            <div class="claimedtxt">CLAIMED</div>
                            <div class="favoritetxt"><i class="fa fa-heart-o"></i>FAVORITE</div>
                        </div>
                    </div>
                    <div class="bottom-content">
                        <div class="ratset-img">
                            <div class="rattxt"><i class="fa fa-star" aria-hidden="true"></i> 4.6 (146)</div>
                            <div class="volarimg"><img src="{{ url('public/img/volar.png') }}"></div>
                            <div class="verifiedimg"><img src="{{ url('public/images/verified-logo.png') }}"></div>
                        </div>
                        <h3>Adult Kickboxing Group Class</h3>
                        <h6>1. Volar Mixed Martial Arts</h6>
                        <p>New York, USA, 10023</p>
                        <h5>More Activites Offred: Kickboxing, MMA, Yoga, Self-Defense, Bjj <img src="{{ url('public/img/arrow-down.png') }}"></h5>
                        <hr>
                        <a href="#" class="moredetails-btn" data-toggle="modal" data-target="#mykickboxing">More Details</a>
                        <p>COMPARE SIMILAR OPTION +</p>
                    </div>
                </div>
                <div class="col-md-6 kickboxing-block1">
                    <div class="topimg-content">
                        <img src="{{ url('public/img/adult-kickboxing.jpg') }}">
                        <div class="sorttext">
                            <div class="fromtxt">From #25 - #3000</div>
                            <div class="claimedtxt">CLAIMED</div>
                            <div class="favoritetxt"><i class="fa fa-heart-o"></i>FAVORITE</div>
                        </div>
                    </div>
                    <div class="bottom-content">
                        <div class="ratset-img">
                            <div class="rattxt"><i class="fa fa-star" aria-hidden="true"></i> 4.6 (146)</div>
                            <div class="volarimg"><img src="{{ url('public/img/volar.png') }}"></div>
                            <div class="verifiedimg"><img src="{{ url('public/images/verified-logo.png') }}"></div>
                        </div>
                        <h3>Adult Kickboxing Group Class</h3>
                        <h6>1. Volar Mixed Martial Arts</h6>
                        <p>New York, USA, 10023</p>
                        <h5>More Activites Offred: Kickboxing, MMA, Yoga, Self-Defense, Bjj <img src="{{ url('public/img/arrow-down.png') }}"></h5>
                        <hr>
                        <a href="#" class="moredetails-btn" data-toggle="modal" data-target="#mykickboxing">More Details</a>
                        <p>COMPARE SIMILAR OPTION +</p>
                    </div>
                </div>
                <div class="col-md-6 kickboxing-block1">
                    <div class="topimg-content">
                        <img src="{{ url('public/img/adult-kickboxing.jpg') }}">
                        <div class="sorttext">
                            <div class="fromtxt">From #25 - #3000</div>
                            <div class="claimedtxt">CLAIMED</div>
                            <div class="favoritetxt"><i class="fa fa-heart-o"></i>FAVORITE</div>
                        </div>
                    </div>
                    <div class="bottom-content">
                        <div class="ratset-img">
                            <div class="rattxt"><i class="fa fa-star" aria-hidden="true"></i> 4.6 (146)</div>
                            <div class="volarimg"><img src="{{ url('public/img/volar.png') }}"></div>
                            <div class="verifiedimg"><img src="{{ url('public/images/verified-logo.png') }}"></div>
                        </div>
                        <h3>Adult Kickboxing Group Class</h3>
                        <h6>1. Volar Mixed Martial Arts</h6>
                        <p>New York, USA, 10023</p>
                        <h5>More Activites Offred: Kickboxing, MMA, Yoga, Self-Defense, Bjj <img src="{{ url('public/img/arrow-down.png') }}"></h5>
                        <hr>
                        <a href="#" class="moredetails-btn" data-toggle="modal" data-target="#mykickboxing">More Details</a>
                        <p>COMPARE SIMILAR OPTION +</p>
                    </div>
                </div>
                <div class="col-md-6 kickboxing-block1">
                    <div class="topimg-content">
                        <img src="{{ url('public/img/adult-kickboxing.jpg') }}">
                        <div class="sorttext">
                            <div class="fromtxt">From #25 - #3000</div>
                            <div class="claimedtxt">CLAIMED</div>
                            <div class="favoritetxt"><i class="fa fa-heart-o"></i>FAVORITE</div>
                        </div>
                    </div>
                    <div class="bottom-content">
                        <div class="ratset-img">
                            <div class="rattxt"><i class="fa fa-star" aria-hidden="true"></i> 4.6 (146)</div>
                            <div class="volarimg"><img src="{{ url('public/img/volar.png') }}"></div>
                            <div class="verifiedimg"><img src="{{ url('public/images/verified-logo.png') }}"></div>
                        </div>
                        <h3>Adult Kickboxing Group Class</h3>
                        <h6>1. Volar Mixed Martial Arts</h6>
                        <p>New York, USA, 10023</p>
                        <h5>More Activites Offred: Kickboxing, MMA, Yoga, Self-Defense, Bjj <img src="{{ url('public/img/arrow-down.png') }}"></h5>
                        <hr>
                        <a href="#" class="moredetails-btn" data-toggle="modal" data-target="#mykickboxing">More Details</a>
                        <p>COMPARE SIMILAR OPTION +</p>
                    </div>
                </div>
                <div class="col-md-6 kickboxing-block1">
                    <div class="topimg-content">
                        <img src="{{ url('public/img/adult-kickboxing.jpg') }}">
                        <div class="sorttext">
                            <div class="fromtxt">From #25 - #3000</div>
                            <div class="claimedtxt">CLAIMED</div>
                            <div class="favoritetxt"><i class="fa fa-heart-o"></i>FAVORITE</div>
                        </div>
                    </div>
                    <div class="bottom-content">
                        <div class="ratset-img">
                            <div class="rattxt"><i class="fa fa-star" aria-hidden="true"></i> 4.6 (146)</div>
                            <div class="volarimg"><img src="{{ url('public/img/volar.png') }}"></div>
                            <div class="verifiedimg"><img src="{{ url('public/images/verified-logo.png') }}"></div>
                        </div>
                        <h3>Adult Kickboxing Group Class</h3>
                        <h6>1. Volar Mixed Martial Arts</h6>
                        <p>New York, USA, 10023</p>
                        <h5>More Activites Offred: Kickboxing, MMA, Yoga, Self-Defense, Bjj <img src="{{ url('public/img/arrow-down.png') }}"></h5>
                        <hr>
                        <a href="#" class="moredetails-btn" data-toggle="modal" data-target="#mykickboxing">More Details</a>
                        <p>COMPARE SIMILAR OPTION +</p>
                    </div>
                </div>
                <div class="col-md-6 kickboxing-block1">
                    <div class="topimg-content">
                        <img src="{{ url('public/img/adult-kickboxing.jpg') }}">
                        <div class="sorttext">
                            <div class="fromtxt">From #25 - #3000</div>
                            <div class="claimedtxt">CLAIMED</div>
                            <div class="favoritetxt"><i class="fa fa-heart-o"></i>FAVORITE</div>
                        </div>
                    </div>
                    <div class="bottom-content">
                        <div class="ratset-img">
                            <div class="rattxt"><i class="fa fa-star" aria-hidden="true"></i> 4.6 (146)</div>
                            <div class="volarimg"><img src="{{ url('public/img/volar.png') }}"></div>
                            <div class="verifiedimg"><img src="{{ url('public/images/verified-logo.png') }}"></div>
                        </div>
                        <h3>Adult Kickboxing Group Class</h3>
                        <h6>1. Volar Mixed Martial Arts</h6>
                        <p>New York, USA, 10023</p>
                        <h5>More Activites Offred: Kickboxing, MMA, Yoga, Self-Defense, Bjj <img src="{{ url('public/img/arrow-down.png') }}"></h5>
                        <hr>
                        <a href="#" class="moredetails-btn" data-toggle="modal" data-target="#mykickboxing">More Details</a>
                        <p>COMPARE SIMILAR OPTION +</p>
                    </div>
                </div>
                <div class="col-md-6 kickboxing-block1">
                    <div class="topimg-content">
                        <img src="{{ url('public/img/adult-kickboxing.jpg') }}">
                        <div class="sorttext">
                            <div class="fromtxt">From #25 - #3000</div>
                            <div class="claimedtxt">CLAIMED</div>
                            <div class="favoritetxt"><i class="fa fa-heart-o"></i>FAVORITE</div>
                        </div>
                    </div>
                    <div class="bottom-content">
                        <div class="ratset-img">
                            <div class="rattxt"><i class="fa fa-star" aria-hidden="true"></i> 4.6 (146)</div>
                            <div class="volarimg"><img src="{{ url('public/img/volar.png') }}"></div>
                            <div class="verifiedimg"><img src="{{ url('public/images/verified-logo.png') }}"></div>
                        </div>
                        <h3>Adult Kickboxing Group Class</h3>
                        <h6>1. Volar Mixed Martial Arts</h6>
                        <p>New York, USA, 10023</p>
                        <h5>More Activites Offred: Kickboxing, MMA, Yoga, Self-Defense, Bjj <img src="{{ url('public/img/arrow-down.png') }}"></h5>
                        <hr>
                        <a href="#" class="moredetails-btn" data-toggle="modal" data-target="#mykickboxing">More Details</a>
                        <p>COMPARE SIMILAR OPTION +</p>
                    </div>
                </div>
                <div class="col-md-6 kickboxing-block1">
                    <div class="topimg-content">
                        <img src="{{ url('public/img/adult-kickboxing.jpg') }}">
                        <div class="sorttext">
                            <div class="fromtxt">From #25 - #3000</div>
                            <div class="claimedtxt">CLAIMED</div>
                            <div class="favoritetxt"><i class="fa fa-heart-o"></i>FAVORITE</div>
                        </div>
                    </div>
                    <div class="bottom-content">
                        <div class="ratset-img">
                            <div class="rattxt"><i class="fa fa-star" aria-hidden="true"></i> 4.6 (146)</div>
                            <div class="volarimg"><img src="{{ url('public/img/volar.png') }}"></div>
                            <div class="verifiedimg"><img src="{{ url('public/images/verified-logo.png') }}"></div>
                        </div>
                        <h3>Adult Kickboxing Group Class</h3>
                        <h6>1. Volar Mixed Martial Arts</h6>
                        <p>New York, USA, 10023</p>
                        <h5>More Activites Offred: Kickboxing, MMA, Yoga, Self-Defense, Bjj <img src="{{ url('public/img/arrow-down.png') }}"></h5>
                        <hr>
                        <a href="#" class="moredetails-btn" data-toggle="modal" data-target="#mykickboxing">More Details</a>
                        <p>COMPARE SIMILAR OPTION +</p>
                    </div>
                </div>
                <div class="col-md-6 kickboxing-block1">
                    <div class="topimg-content">
                        <img src="{{ url('public/img/adult-kickboxing.jpg') }}">
                        <div class="sorttext">
                            <div class="fromtxt">From #25 - #3000</div>
                            <div class="claimedtxt">CLAIMED</div>
                            <div class="favoritetxt"><i class="fa fa-heart-o"></i>FAVORITE</div>
                        </div>
                    </div>
                    <div class="bottom-content">
                        <div class="ratset-img">
                            <div class="rattxt"><i class="fa fa-star" aria-hidden="true"></i> 4.6 (146)</div>
                            <div class="volarimg"><img src="{{ url('public/img/volar.png') }}"></div>
                            <div class="verifiedimg"><img src="{{ url('public/images/verified-logo.png') }}"></div>
                        </div>
                        <h3>Adult Kickboxing Group Class</h3>
                        <h6>1. Volar Mixed Martial Arts</h6>
                        <p>New York, USA, 10023</p>
                        <h5>More Activites Offred: Kickboxing, MMA, Yoga, Self-Defense, Bjj <img src="{{ url('public/img/arrow-down.png') }}"></h5>
                        <hr>
                        <a href="#" class="moredetails-btn" data-toggle="modal" data-target="#mykickboxing">More Details</a>
                        <p>COMPARE SIMILAR OPTION +</p>
                    </div>
                </div>
                <div class="col-md-6 kickboxing-block1">
                    <div class="topimg-content">
                        <img src="{{ url('public/img/adult-kickboxing.jpg') }}">
                        <div class="sorttext">
                            <div class="fromtxt">From #25 - #3000</div>
                            <div class="claimedtxt">CLAIMED</div>
                            <div class="favoritetxt"><i class="fa fa-heart-o"></i>FAVORITE</div>
                        </div>
                    </div>
                    <div class="bottom-content">
                        <div class="ratset-img">
                            <div class="rattxt"><i class="fa fa-star" aria-hidden="true"></i> 4.6 (146)</div>
                            <div class="volarimg"><img src="{{ url('public/img/volar.png') }}"></div>
                            <div class="verifiedimg"><img src="{{ url('public/images/verified-logo.png') }}"></div>
                        </div>
                        <h3>Adult Kickboxing Group Class</h3>
                        <h6>1. Volar Mixed Martial Arts</h6>
                        <p>New York, USA, 10023</p>
                        <h5>More Activites Offred: Kickboxing, MMA, Yoga, Self-Defense, Bjj <img src="{{ url('public/img/arrow-down.png') }}"></h5>
                        <hr>
                        <a href="#" class="moredetails-btn" data-toggle="modal" data-target="#mykickboxing">More Details</a>
                        <p>COMPARE SIMILAR OPTION +</p>
                    </div>
                </div>
                <!--<a href="#" class="showlink">Show All 105 ></a>-->

                <div class="pagenation">
                    <a href="#" class="active">1</a>
                    <a href="#">2</a>
                </div>
            </div>


        </div>

        <div class="col-md-4 kickboxing_map">
            <div class="maparea">
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d24176.251535935986!2d-73.96828678121815!3d40.76133318281456!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x89c258c4d85a0d8d%3A0x11f877ff0b8ffe27!2sRoosevelt%20Island!5e0!3m2!1sen!2sin!4v1620041765199!5m2!1sen!2sin" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
            </div>
        </div>

        <div id="mykickboxing" class="modal kickboxing-moredetails" tabindex="-1">
            <div class="modal-dialog" role="document">
                <div class="modal-content">

                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <div class="header-content">
                            <div class="addcompare"><a href="#" class="btnaddc">Add To Compare</a> <a href="#" class="inquirylink"><i class="fa fa-question-circle" aria-hidden="true"></i></a></div>
                            <div class="ratset-righthead">                                
                                <div class="ratset-threetxt">
                                    <p><i class="fa fa-star" aria-hidden="true"></i> 4.6 (146)</p>
                                    <div class="favtxt"><img src="{{ url('public/img/heartplus-icon.png') }}"> Favorite</div>
                                    <div class="reviewtxt"><img src="{{ url('public/img/comment-icon.png') }}"> Submit Review</div>
                                    <div class="sharetxt"><img src="{{ url('public/img/share-icon.png') }}"> Share</div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="modal-body">

                        <img src="{{ url('public/img/adult-kickboxing-big.jpg') }}" class="kickboximg-big">

                        <div class="col-md-7">
                            <h3>Adult Kickboxing Group Class</h3>
                            <p>
                                About <br>
                                Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.
                            </p>
                            <div class="review-blockkick">
                                <h5>Add Review & Rate</h5>
                                <div class="ratestar">
                                    <div>
                                        <span>Quality</span>
                                        <i class="fa fa-star" aria-hidden="true"></i>
                                        <i class="fa fa-star" aria-hidden="true"></i>
                                        <i class="fa fa-star" aria-hidden="true"></i>
                                        <i class="fa fa-star" aria-hidden="true"></i>
                                        <i class="fa fa-star" aria-hidden="true"></i>
                                        <i class="fa fa-star" aria-hidden="true"></i>
                                        <i class="fa fa-star" aria-hidden="true"></i>
                                        <i class="fa fa-star" aria-hidden="true"></i>
                                        <i class="fa fa-star" aria-hidden="true"></i>
                                        <i class="fa fa-star" aria-hidden="true"></i>
                                        <span><img src="{{ url('public/img/emoji.png') }}"> Excellent</span>
                                    </div>
                                    <div>
                                        <span>Location</span>
                                        <i class="fa fa-star" aria-hidden="true"></i>
                                        <i class="fa fa-star" aria-hidden="true"></i>
                                        <i class="fa fa-star" aria-hidden="true"></i>
                                        <i class="fa fa-star" aria-hidden="true"></i>
                                        <i class="fa fa-star" aria-hidden="true"></i>
                                        <i class="fa fa-star" aria-hidden="true"></i>
                                        <i class="fa fa-star" aria-hidden="true"></i>
                                        <i class="fa fa-star" aria-hidden="true"></i>
                                        <i class="fa fa-star" aria-hidden="true"></i>
                                        <i class="fa fa-star" aria-hidden="true"></i>
                                        <span><img src="{{ url('public/img/emoji.png') }}"> Excellent</span>
                                    </div>
                                    <div>
                                        <span>Space</span>
                                        <i class="fa fa-star" aria-hidden="true"></i>
                                        <i class="fa fa-star" aria-hidden="true"></i>
                                        <i class="fa fa-star" aria-hidden="true"></i>
                                        <i class="fa fa-star" aria-hidden="true"></i>
                                        <i class="fa fa-star" aria-hidden="true"></i>
                                        <i class="fa fa-star" aria-hidden="true"></i>
                                        <i class="fa fa-star" aria-hidden="true"></i>
                                        <i class="fa fa-star" aria-hidden="true"></i>
                                        <i class="fa fa-star" aria-hidden="true"></i>
                                        <i class="fa fa-star" aria-hidden="true"></i>
                                        <span><img src="{{ url('public/img/emoji.png') }}"> Excellent</span>
                                    </div>
                                    <div>
                                        <span>Service</span>
                                        <i class="fa fa-star" aria-hidden="true"></i>
                                        <i class="fa fa-star" aria-hidden="true"></i>
                                        <i class="fa fa-star" aria-hidden="true"></i>
                                        <i class="fa fa-star" aria-hidden="true"></i>
                                        <i class="fa fa-star" aria-hidden="true"></i>
                                        <i class="fa fa-star" aria-hidden="true"></i>
                                        <i class="fa fa-star" aria-hidden="true"></i>
                                        <i class="fa fa-star" aria-hidden="true"></i>
                                        <i class="fa fa-star" aria-hidden="true"></i>
                                        <i class="fa fa-star" aria-hidden="true"></i>
                                        <span><img src="{{ url('public/img/emoji.png') }}"> Excellent</span>
                                    </div>
                                    <div>
                                        <span>Price</span>
                                        <i class="fa fa-star" aria-hidden="true"></i>
                                        <i class="fa fa-star" aria-hidden="true"></i>
                                        <i class="fa fa-star" aria-hidden="true"></i>
                                        <i class="fa fa-star" aria-hidden="true"></i>
                                        <i class="fa fa-star" aria-hidden="true"></i>
                                        <i class="fa fa-star" aria-hidden="true"></i>
                                        <i class="fa fa-star" aria-hidden="true"></i>
                                        <i class="fa fa-star" aria-hidden="true"></i>
                                        <i class="fa fa-star" aria-hidden="true"></i>
                                        <i class="fa fa-star" aria-hidden="true"></i>
                                        <span><img src="{{ url('public/img/emoji.png') }}"> Excellent</span>
                                    </div>
                                </div>
                                <form class="review-submit">
                                    <textarea cols="5" rows="5" class="form-control" placeholder="Your review"></textarea>
                                    <div class="imgUp">
                                        <div class="imagePreview"></div>
                                        <label class="img-tab-btn">
                                            Drop images to upload <br> or <br> <img src="{{ url('public/img/upload.png') }}"> <br> <span> Gallery Images</span>
                                            <input type="file" class="uploadFile img" value="Upload Photo" style="width: 0px;height: 0px;overflow: hidden;">
                                        </label>
                                    </div>
                                    <input type="submit" value="Submit Review" class="btn btn-web-btn">
                                </form>
                            </div>
                        </div>

                        <div class="col-md-5 right-person">

                            <div class="fromblock">

                                <h3>From $150 <span> / person</span></h3>

                                <div class="multiselect-block">

                                    <select id="" name="" class="form-control activityselect1">
                                        <option hidden>Activity Offered</option>
                                        <option>Activity1</option>
                                    </select>

                                    <select id="" name="" class="form-control activityselect2">
                                        <option hidden>Location</option>
                                        <option>Location1</option>
                                    </select>

                                    <div class="activityselect3 special-date">
                                        <input type="text" name="" id="date" placeholder="Date" class="form-control">
                                        <i class="fa fa-calendar"></i>
                                    </div>

                                    <script type="text/javascript">
$('#date').datepicker();

                                    </script>

                                    <select id="" name="" class="form-control activityselect4">
                                        <option hidden>Participant #</option>
                                        <option>Participant</option>
                                    </select>

                                    <select id="" name="" class="form-control activityselect5">
                                        <option hidden>Service Type</option>
                                        <option>Service Type1</option>
                                    </select>

                                </div>

                                <div class="kickshow-block">
                                    <div class="topkick intro" id="kickboxing1">

                                        <ul>
                                            <h5><span>Kickboxing for Adults</span></h5>
                                            <li>Friday, May 7th, 2021</li>
                                            <li>9:00am - 10:00am</li>
                                            <li>Service: Group Class</li>
                                            <li>Duration: 1 hour</li>
                                            <li>Activity Location: At Business</li>
                                            <li>Spots Left: 2/50</li>
                                            <li>Great For: Adults</li>
                                            <li>Age: 18+</li>
                                            <li>Language: English, Spanish</li>
                                            <li>Skill Level: All Levels</li>
                                        </ul>
                                        <div class="righthalf">
                                            <label>Choose Price Option</label>
                                            <select name="price" id="price1" multiple>
                                                <option value="0">Breathing Problem</option>
                                                <option value="1">Back Problem</option>
                                                <option value="2">Pregnant</option>
                                                <option value="3">Special Needs</option>
                                                <option value="4">Doesnt Matter</option>
                                                <option value="5">Others</option>
                                            </select>
                                            <script>
                                                var p = new SlimSelect({
                                                    select: '#price1'
                                                });

                                            </script>
                                            <p>Price Option: 01 Session</p>
                                            <p>Participants: 1</p>
                                            <p>Total: $25</p>
                                            <a href="#" class="addtocart-btn" style="float:right;" data-toggle="modal" data-target="#successAddCart">Add to Cart</a>
                                        </div>
                                    </div>
                                    <div class="bottomkick">
                                        <div class="viewmore_links">
                                            <a id="viewmore1">View More <img src="{{ url('public/img/arrow-down.png') }}" alt=""></a>
                                            <a id="viewless1">View Less <img src="{{ url('public/img/arrow-down.png') }}" alt=""></a>
                                        </div>
                                    </div>
                                </div>

                                <div class="kickshow-block">
                                    <div class="topkick" id="kickboxing2">

                                        <ul>
                                            <h5><span>MMA for Kids</span></h5>
                                            <li>Friday, May 7th, 2021</li>
                                            <li>10:00am - 10:30am</li>
                                            <li>Service: Group Class</li>
                                            <li>Duration: 30 min</li>
                                            <li>Activity Location: At Business</li>
                                            <li>Spots Left: 2/50</li>
                                            <li>Great For: Adults</li>
                                            <li>Age: 18+</li>
                                            <li>Language: English, Spanish</li>
                                            <li>Skill Level: All Levels</li>
                                        </ul>
                                        <div class="righthalf">
                                            <label>Choose Price Option</label>
                                            <select name="price" id="price2" multiple>
                                                <option value="0">Breathing Problem</option>
                                                <option value="1">Back Problem</option>
                                                <option value="2">Pregnant</option>
                                                <option value="3">Special Needs</option>
                                                <option value="4">Doesnt Matter</option>
                                                <option value="5">Others</option>
                                            </select>
                                            <script>
                                                var p = new SlimSelect({
                                                    select: '#price2'
                                                });

                                            </script>
                                            <p>Price Option: None</p>
                                            <p>Participants: 0</p>
                                            <p>Total: 0</p>
                                            <a href="#" class="addtocart-btn" style="float:right;" data-toggle="modal" data-target="#successAddCart">Add to Cart</a>
                                        </div>
                                    </div>
                                    <div class="bottomkick">
                                        <div class="viewmore_links">
                                            <a id="viewmore2">View More <img src="{{ url('public/img/arrow-down.png') }}" alt=""></a>
                                            <a id="viewless2">View Less <img src="{{ url('public/img/arrow-down.png') }}" alt=""></a>
                                        </div>
                                    </div>
                                </div>

                                <div class="kickshow-block">
                                    <div class="topkick" id="kickboxing3">

                                        <ul>
                                            <h5><span>Brazilian Jiu-Jitsu for Adults</span></h5>
                                            <li>Friday, May 7th, 2021</li>
                                            <li>8:00am - 10:00am</li>
                                            <li>Service: Group Class</li>
                                            <li>Duration: 3 hour</li>
                                            <li>Activity Location: At Business</li>
                                            <li>Spots Left: 2/50</li>
                                            <li>Great For: Adults</li>
                                            <li>Age: 18+</li>
                                            <li>Language: English, Spanish</li>
                                            <li>Skill Level: All Levels</li>
                                        </ul>
                                        <div class="righthalf">
                                            <label>Choose Price Option</label>
                                            <select name="price" id="price3" multiple>
                                                <option value="0">Breathing Problem</option>
                                                <option value="1">Back Problem</option>
                                                <option value="2">Pregnant</option>
                                                <option value="3">Special Needs</option>
                                                <option value="4">Doesnt Matter</option>
                                                <option value="5">Others</option>
                                            </select>
                                            <script>
                                                var p = new SlimSelect({
                                                    select: '#price3'
                                                });

                                            </script>
                                            <p>Price Option: None</p>
                                            <p>Participants: 0</p>
                                            <p>Total: 0</p>
                                            <a href="#" class="addtocart-btn" style="float:right;" data-toggle="modal" data-target="#successAddCart">Add to Cart</a>
                                        </div>
                                    </div>
                                    <div class="bottomkick">
                                        <div class="viewmore_links">
                                            <a id="viewmore3">View More <img src="{{ url('public/img/arrow-down.png') }}" alt=""></a>
                                            <a id="viewless3">View Less <img src="{{ url('public/img/arrow-down.png') }}" alt=""></a>
                                        </div>
                                    </div>
                                </div>

                            </div>

                        </div>

                    </div>

                </div>
            </div>
        </div>

        <div id="successAddCart" class="modal successaddcart-block" tabindex="-1">
            <div class="modal-dialog" role="document">
                <div class="modal-content">

                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <h3 class="modal-title" id="exampleModalLabel">SUCCESSFULLY ADD TO YOUR CART</h3>
                    </div>

                    <div class="modal-body">

                        <div class="col-md-4">
                            <div class="connect-boxsuccadd">
                                <h5>Connect With The Company</h5>
                                <div class="d-flex align-items-center">
                                    <img src="{{ url('public/img/volar.png') }}">
                                    <h5>Valor Mixed Martial Arts</h5>
                                </div>
                                <div class="iconsuccadd">
                                    <!--<i class="fa fa-user" aria-hidden="true"></i>
                                    <i class="fa fa-comment" aria-hidden="true"></i>-->
                                </div>
                                <p>Just Added: (1 item) $1,200 <br> Previously Added: (5 items) $,1000</p>
                                <p><b>Cart Subtotal</b>: (6 items) $2,500</p>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="imgsuccadd">
                                <img src="{{ url('public/img/adult-kickboxing-big.jpg') }}">
                                <a href="/lesson/jsModallesson/booklesson" id="booklessonbtn" class="btn btn-web-btn conti" data-toggle="modal" data-target="#lesson_modal">Continue Shopping</a>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="connect-boxsuccadd1">
                                <h5>Kickboxing for Adults</h5>
                                <p>Price: $1,200</p>
                                <p>Payment Type: 05 Sessions</p>
                                <p>Date Reserved: Monday, April 12, 2021</p>
                                <p>Reserved for Time: 8:00 am - 8:30 am</p>
                                <p>Service: Group Class</p>
                                <p>Duration: 30 min.</p>
                                <p>Activity Location: Business Location</p>
                                <p>Group Size: 2</p>
                                <p>Great For: Adults</p>
                                <p>Age: 18+</p>
                                <p>language: English, Spanish</p>
                                <p>Skill Level: All Levels</p>
                                <a href="{{ Config::get('constants.SITE_URL') }}/direct-hire/cart-payment" class="btn btn-web-btn">View Cart & Checkout</a>
                            </div>
                        </div>

                        <div class="discover-block">

                            <h3 class="distitle">DISCOVER MORE BELOW</h3>

                            <h5 class="sldertitle">View Other Activities Provided by Valor Mixed Martial Arts (4 items) <a href="#">View All</a> </h5>

                            <div id="carousel-reviews" class="carousel kickboxing-slider slide" data-ride="carousel">

                                <div class="carousel-inner">
                                    <div class="item active">
                                        <div class="col-md-4 col-sm-6">
                                            <div class="kickboxing-slider-block item">
                                                <div class="kickboxing-block1">
                                                    <div class="topimg-content">
                                                        <img src="/public/img/adult-kickboxing.jpg">
                                                        <div class="sorttext">
                                                            <div class="fromtxt">From #25 - #3000</div>
                                                            <div class="claimedtxt">CLAIMED</div>
                                                            <div class="favoritetxt"><i class="fa fa-heart-o"></i>FAVORITE</div>
                                                        </div>
                                                    </div>
                                                    <div class="bottom-content">
                                                        <div class="ratset-img">
                                                            <div class="rattxt"><i class="fa fa-star" aria-hidden="true"></i> 4.6 (146)</div>
                                                            <div class="volarimg"><img src="/public/img/volar.png"></div>
                                                            <div class="verifiedimg"><img src="/public/images/verified-logo.png"></div>
                                                        </div>
                                                        <h3>Adult Kickboxing Group Class</h3>
                                                        <h6>1. Volar Mixed Martial Arts</h6>
                                                        <p>New York, USA, 10023</p>
                                                        <h5>More Activites Offred: Kickboxing, MMA, Yoga, Self-Defense, Bjj <img src="/public/img/arrow-down.png"></h5>
                                                        <hr>
                                                        <a href="#" class="moredetails-btn">More Details</a>
                                                        <p>COMPARE SIMILAR OPTION +</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-sm-6">
                                            <div class="kickboxing-slider-block item">
                                                <div class="kickboxing-block1">
                                                    <div class="topimg-content">
                                                        <img src="/public/img/adult-kickboxing.jpg">
                                                        <div class="sorttext">
                                                            <div class="fromtxt">From #25 - #3000</div>
                                                            <div class="claimedtxt">CLAIMED</div>
                                                            <div class="favoritetxt"><i class="fa fa-heart-o"></i>FAVORITE</div>
                                                        </div>
                                                    </div>
                                                    <div class="bottom-content">
                                                        <div class="ratset-img">
                                                            <div class="rattxt"><i class="fa fa-star" aria-hidden="true"></i> 4.6 (146)</div>
                                                            <div class="volarimg"><img src="/public/img/volar.png"></div>
                                                            <div class="verifiedimg"><img src="/public/images/verified-logo.png"></div>
                                                        </div>
                                                        <h3>Adult Kickboxing Group Class</h3>
                                                        <h6>1. Volar Mixed Martial Arts</h6>
                                                        <p>New York, USA, 10023</p>
                                                        <h5>More Activites Offred: Kickboxing, MMA, Yoga, Self-Defense, Bjj <img src="/public/img/arrow-down.png"></h5>
                                                        <hr>
                                                        <a href="#" class="moredetails-btn">More Details</a>
                                                        <p>COMPARE SIMILAR OPTION +</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-sm-6">
                                            <div class="kickboxing-slider-block item">
                                                <div class="kickboxing-block1">
                                                    <div class="topimg-content">
                                                        <img src="/public/img/adult-kickboxing.jpg">
                                                        <div class="sorttext">
                                                            <div class="fromtxt">From #25 - #3000</div>
                                                            <div class="claimedtxt">CLAIMED</div>
                                                            <div class="favoritetxt"><i class="fa fa-heart-o"></i>FAVORITE</div>
                                                        </div>
                                                    </div>
                                                    <div class="bottom-content">
                                                        <div class="ratset-img">
                                                            <div class="rattxt"><i class="fa fa-star" aria-hidden="true"></i> 4.6 (146)</div>
                                                            <div class="volarimg"><img src="/public/img/volar.png"></div>
                                                            <div class="verifiedimg"><img src="/public/images/verified-logo.png"></div>
                                                        </div>
                                                        <h3>Adult Kickboxing Group Class</h3>
                                                        <h6>1. Volar Mixed Martial Arts</h6>
                                                        <p>New York, USA, 10023</p>
                                                        <h5>More Activites Offred: Kickboxing, MMA, Yoga, Self-Defense, Bjj <img src="/public/img/arrow-down.png"></h5>
                                                        <hr>
                                                        <a href="#" class="moredetails-btn">More Details</a>
                                                        <p>COMPARE SIMILAR OPTION +</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="item">
                                        <div class="col-md-4 col-sm-6">
                                            <div class="kickboxing-slider-block item">
                                                <div class="kickboxing-block1">
                                                    <div class="topimg-content">
                                                        <img src="/public/img/adult-kickboxing.jpg">
                                                        <div class="sorttext">
                                                            <div class="fromtxt">From #25 - #3000</div>
                                                            <div class="claimedtxt">CLAIMED</div>
                                                            <div class="favoritetxt"><i class="fa fa-heart-o"></i>FAVORITE</div>
                                                        </div>
                                                    </div>
                                                    <div class="bottom-content">
                                                        <div class="ratset-img">
                                                            <div class="rattxt"><i class="fa fa-star" aria-hidden="true"></i> 4.6 (146)</div>
                                                            <div class="volarimg"><img src="/public/img/volar.png"></div>
                                                            <div class="verifiedimg"><img src="/public/images/verified-logo.png"></div>
                                                        </div>
                                                        <h3>Adult Kickboxing Group Class</h3>
                                                        <h6>1. Volar Mixed Martial Arts</h6>
                                                        <p>New York, USA, 10023</p>
                                                        <h5>More Activites Offred: Kickboxing, MMA, Yoga, Self-Defense, Bjj <img src="/public/img/arrow-down.png"></h5>
                                                        <hr>
                                                        <a href="#" class="moredetails-btn">More Details</a>
                                                        <p>COMPARE SIMILAR OPTION +</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-sm-6 hidden-xs">
                                            <div class="kickboxing-slider-block item">
                                                <div class="kickboxing-block1">
                                                    <div class="topimg-content">
                                                        <img src="/public/img/adult-kickboxing.jpg">
                                                        <div class="sorttext">
                                                            <div class="fromtxt">From #25 - #3000</div>
                                                            <div class="claimedtxt">CLAIMED</div>
                                                            <div class="favoritetxt"><i class="fa fa-heart-o"></i>FAVORITE</div>
                                                        </div>
                                                    </div>
                                                    <div class="bottom-content">
                                                        <div class="ratset-img">
                                                            <div class="rattxt"><i class="fa fa-star" aria-hidden="true"></i> 4.6 (146)</div>
                                                            <div class="volarimg"><img src="/public/img/volar.png"></div>
                                                            <div class="verifiedimg"><img src="/public/images/verified-logo.png"></div>
                                                        </div>
                                                        <h3>Adult Kickboxing Group Class</h3>
                                                        <h6>1. Volar Mixed Martial Arts</h6>
                                                        <p>New York, USA, 10023</p>
                                                        <h5>More Activites Offred: Kickboxing, MMA, Yoga, Self-Defense, Bjj <img src="/public/img/arrow-down.png"></h5>
                                                        <hr>
                                                        <a href="#" class="moredetails-btn">More Details</a>
                                                        <p>COMPARE SIMILAR OPTION +</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-sm-6 hidden-sm hidden-xs">
                                            <div class="kickboxing-slider-block item">
                                                <div class="kickboxing-block1">
                                                    <div class="topimg-content">
                                                        <img src="/public/img/adult-kickboxing.jpg">
                                                        <div class="sorttext">
                                                            <div class="fromtxt">From #25 - #3000</div>
                                                            <div class="claimedtxt">CLAIMED</div>
                                                            <div class="favoritetxt"><i class="fa fa-heart-o"></i>FAVORITE</div>
                                                        </div>
                                                    </div>
                                                    <div class="bottom-content">
                                                        <div class="ratset-img">
                                                            <div class="rattxt"><i class="fa fa-star" aria-hidden="true"></i> 4.6 (146)</div>
                                                            <div class="volarimg"><img src="/public/img/volar.png"></div>
                                                            <div class="verifiedimg"><img src="/public/images/verified-logo.png"></div>
                                                        </div>
                                                        <h3>Adult Kickboxing Group Class</h3>
                                                        <h6>1. Volar Mixed Martial Arts</h6>
                                                        <p>New York, USA, 10023</p>
                                                        <h5>More Activites Offred: Kickboxing, MMA, Yoga, Self-Defense, Bjj <img src="/public/img/arrow-down.png"></h5>
                                                        <hr>
                                                        <a href="#" class="moredetails-btn">More Details</a>
                                                        <p>COMPARE SIMILAR OPTION +</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="item">
                                        <div class="col-md-4 col-sm-6">
                                            <div class="kickboxing-slider-block item">
                                                <div class="kickboxing-block1">
                                                    <div class="topimg-content">
                                                        <img src="/public/img/adult-kickboxing.jpg">
                                                        <div class="sorttext">
                                                            <div class="fromtxt">From #25 - #3000</div>
                                                            <div class="claimedtxt">CLAIMED</div>
                                                            <div class="favoritetxt"><i class="fa fa-heart-o"></i>FAVORITE</div>
                                                        </div>
                                                    </div>
                                                    <div class="bottom-content">
                                                        <div class="ratset-img">
                                                            <div class="rattxt"><i class="fa fa-star" aria-hidden="true"></i> 4.6 (146)</div>
                                                            <div class="volarimg"><img src="/public/img/volar.png"></div>
                                                            <div class="verifiedimg"><img src="/public/images/verified-logo.png"></div>
                                                        </div>
                                                        <h3>Adult Kickboxing Group Class</h3>
                                                        <h6>1. Volar Mixed Martial Arts</h6>
                                                        <p>New York, USA, 10023</p>
                                                        <h5>More Activites Offred: Kickboxing, MMA, Yoga, Self-Defense, Bjj <img src="/public/img/arrow-down.png"></h5>
                                                        <hr>
                                                        <a href="#" class="moredetails-btn">More Details</a>
                                                        <p>COMPARE SIMILAR OPTION +</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-sm-6 hidden-xs">
                                            <div class="kickboxing-slider-block item">
                                                <div class="kickboxing-block1">
                                                    <div class="topimg-content">
                                                        <img src="/public/img/adult-kickboxing.jpg">
                                                        <div class="sorttext">
                                                            <div class="fromtxt">From #25 - #3000</div>
                                                            <div class="claimedtxt">CLAIMED</div>
                                                            <div class="favoritetxt"><i class="fa fa-heart-o"></i>FAVORITE</div>
                                                        </div>
                                                    </div>
                                                    <div class="bottom-content">
                                                        <div class="ratset-img">
                                                            <div class="rattxt"><i class="fa fa-star" aria-hidden="true"></i> 4.6 (146)</div>
                                                            <div class="volarimg"><img src="/public/img/volar.png"></div>
                                                            <div class="verifiedimg"><img src="/public/images/verified-logo.png"></div>
                                                        </div>
                                                        <h3>Adult Kickboxing Group Class</h3>
                                                        <h6>1. Volar Mixed Martial Arts</h6>
                                                        <p>New York, USA, 10023</p>
                                                        <h5>More Activites Offred: Kickboxing, MMA, Yoga, Self-Defense, Bjj <img src="/public/img/arrow-down.png"></h5>
                                                        <hr>
                                                        <a href="#" class="moredetails-btn">More Details</a>
                                                        <p>COMPARE SIMILAR OPTION +</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-sm-6 hidden-sm hidden-xs">
                                            <div class="kickboxing-slider-block item">
                                                <div class="kickboxing-block1">
                                                    <div class="topimg-content">
                                                        <img src="/public/img/adult-kickboxing.jpg">
                                                        <div class="sorttext">
                                                            <div class="fromtxt">From #25 - #3000</div>
                                                            <div class="claimedtxt">CLAIMED</div>
                                                            <div class="favoritetxt"><i class="fa fa-heart-o"></i>FAVORITE</div>
                                                        </div>
                                                    </div>
                                                    <div class="bottom-content">
                                                        <div class="ratset-img">
                                                            <div class="rattxt"><i class="fa fa-star" aria-hidden="true"></i> 4.6 (146)</div>
                                                            <div class="volarimg"><img src="/public/img/volar.png"></div>
                                                            <div class="verifiedimg"><img src="/public/images/verified-logo.png"></div>
                                                        </div>
                                                        <h3>Adult Kickboxing Group Class</h3>
                                                        <h6>1. Volar Mixed Martial Arts</h6>
                                                        <p>New York, USA, 10023</p>
                                                        <h5>More Activites Offred: Kickboxing, MMA, Yoga, Self-Defense, Bjj <img src="/public/img/arrow-down.png"></h5>
                                                        <hr>
                                                        <a href="#" class="moredetails-btn">More Details</a>
                                                        <p>COMPARE SIMILAR OPTION +</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <a class="left carousel-control" href="#carousel-reviews" role="button" data-slide="prev">
                                    <span class="glyphicon glyphicon-chevron-left"></span>
                                </a>
                                <a class="right carousel-control" href="#carousel-reviews" role="button" data-slide="next">
                                    <span class="glyphicon glyphicon-chevron-right"></span>
                                </a>
                            </div>

                            <h5 class="sldertitle">Explore Products Provided by Valor Mixed Martial Arts (05 items) <a href="#">View All</a> </h5>

                            <div id="carousel-reviews" class="carousel kickboxing-slider slide" data-ride="carousel">

                                <div class="carousel-inner">
                                    <div class="item active">
                                        <div class="col-md-4 col-sm-6">
                                            <div class="kickboxing-slider-block item">
                                                <div class="kickboxing-block1">
                                                    <div class="topimg-content">
                                                        <img src="/public/img/adult-kickboxing.jpg">
                                                        <div class="sorttext">
                                                            <div class="fromtxt">From #25 - #3000</div>
                                                            <div class="claimedtxt">CLAIMED</div>
                                                            <div class="favoritetxt"><i class="fa fa-heart-o"></i>FAVORITE</div>
                                                        </div>
                                                    </div>
                                                    <div class="bottom-content">
                                                        <div class="ratset-img">
                                                            <div class="rattxt"><i class="fa fa-star" aria-hidden="true"></i> 4.6 (146)</div>
                                                            <div class="volarimg"><img src="/public/img/volar.png"></div>
                                                            <div class="verifiedimg"><img src="/public/images/verified-logo.png"></div>
                                                        </div>
                                                        <h3>Title Classic Pro Style Training Gloves 3.0</h3>
                                                        <h6>1. Volar Mixed Martial Arts</h6>
                                                        <p>New York, USA, 10023</p>
                                                        <hr>
                                                        <a href="#" class="moredetails-btn">More Details</a>
                                                        <p>COMPARE SIMILAR OPTION +</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-sm-6">
                                            <div class="kickboxing-slider-block item">
                                                <div class="kickboxing-block1">
                                                    <div class="topimg-content">
                                                        <img src="/public/img/adult-kickboxing.jpg">
                                                        <div class="sorttext">
                                                            <div class="fromtxt">From #25 - #3000</div>
                                                            <div class="claimedtxt">CLAIMED</div>
                                                            <div class="favoritetxt"><i class="fa fa-heart-o"></i>FAVORITE</div>
                                                        </div>
                                                    </div>
                                                    <div class="bottom-content">
                                                        <div class="ratset-img">
                                                            <div class="rattxt"><i class="fa fa-star" aria-hidden="true"></i> 4.6 (146)</div>
                                                            <div class="volarimg"><img src="/public/img/volar.png"></div>
                                                            <div class="verifiedimg"><img src="/public/images/verified-logo.png"></div>
                                                        </div>
                                                        <h3>Title Classic Pro Style Training Gloves 3.0</h3>
                                                        <h6>1. Volar Mixed Martial Arts</h6>
                                                        <p>New York, USA, 10023</p>
                                                        <hr>
                                                        <a href="#" class="moredetails-btn">More Details</a>
                                                        <p>COMPARE SIMILAR OPTION +</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-sm-6">
                                            <div class="kickboxing-slider-block item">
                                                <div class="kickboxing-block1">
                                                    <div class="topimg-content">
                                                        <img src="/public/img/adult-kickboxing.jpg">
                                                        <div class="sorttext">
                                                            <div class="fromtxt">From #25 - #3000</div>
                                                            <div class="claimedtxt">CLAIMED</div>
                                                            <div class="favoritetxt"><i class="fa fa-heart-o"></i>FAVORITE</div>
                                                        </div>
                                                    </div>
                                                    <div class="bottom-content">
                                                        <div class="ratset-img">
                                                            <div class="rattxt"><i class="fa fa-star" aria-hidden="true"></i> 4.6 (146)</div>
                                                            <div class="volarimg"><img src="/public/img/volar.png"></div>
                                                            <div class="verifiedimg"><img src="/public/images/verified-logo.png"></div>
                                                        </div>
                                                        <h3>Title Classic Pro Style Training Gloves 3.0</h3>
                                                        <h6>1. Volar Mixed Martial Arts</h6>
                                                        <p>New York, USA, 10023</p>
                                                        <hr>
                                                        <a href="#" class="moredetails-btn">More Details</a>
                                                        <p>COMPARE SIMILAR OPTION +</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="item">
                                        <div class="col-md-4 col-sm-6">
                                            <div class="kickboxing-slider-block item">
                                                <div class="kickboxing-block1">
                                                    <div class="topimg-content">
                                                        <img src="/public/img/adult-kickboxing.jpg">
                                                        <div class="sorttext">
                                                            <div class="fromtxt">From #25 - #3000</div>
                                                            <div class="claimedtxt">CLAIMED</div>
                                                            <div class="favoritetxt"><i class="fa fa-heart-o"></i>FAVORITE</div>
                                                        </div>
                                                    </div>
                                                    <div class="bottom-content">
                                                        <div class="ratset-img">
                                                            <div class="rattxt"><i class="fa fa-star" aria-hidden="true"></i> 4.6 (146)</div>
                                                            <div class="volarimg"><img src="/public/img/volar.png"></div>
                                                            <div class="verifiedimg"><img src="/public/images/verified-logo.png"></div>
                                                        </div>
                                                        <h3>Title Classic Pro Style Training Gloves 3.0</h3>
                                                        <h6>1. Volar Mixed Martial Arts</h6>
                                                        <p>New York, USA, 10023</p>
                                                        <hr>
                                                        <a href="#" class="moredetails-btn">More Details</a>
                                                        <p>COMPARE SIMILAR OPTION +</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-sm-6 hidden-xs">
                                            <div class="kickboxing-slider-block item">
                                                <div class="kickboxing-block1">
                                                    <div class="topimg-content">
                                                        <img src="/public/img/adult-kickboxing.jpg">
                                                        <div class="sorttext">
                                                            <div class="fromtxt">From #25 - #3000</div>
                                                            <div class="claimedtxt">CLAIMED</div>
                                                            <div class="favoritetxt"><i class="fa fa-heart-o"></i>FAVORITE</div>
                                                        </div>
                                                    </div>
                                                    <div class="bottom-content">
                                                        <div class="ratset-img">
                                                            <div class="rattxt"><i class="fa fa-star" aria-hidden="true"></i> 4.6 (146)</div>
                                                            <div class="volarimg"><img src="/public/img/volar.png"></div>
                                                            <div class="verifiedimg"><img src="/public/images/verified-logo.png"></div>
                                                        </div>
                                                        <h3>Title Classic Pro Style Training Gloves 3.0</h3>
                                                        <h6>1. Volar Mixed Martial Arts</h6>
                                                        <p>New York, USA, 10023</p>
                                                        <hr>
                                                        <a href="#" class="moredetails-btn">More Details</a>
                                                        <p>COMPARE SIMILAR OPTION +</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-sm-6 hidden-sm hidden-xs">
                                            <div class="kickboxing-slider-block item">
                                                <div class="kickboxing-block1">
                                                    <div class="topimg-content">
                                                        <img src="/public/img/adult-kickboxing.jpg">
                                                        <div class="sorttext">
                                                            <div class="fromtxt">From #25 - #3000</div>
                                                            <div class="claimedtxt">CLAIMED</div>
                                                            <div class="favoritetxt"><i class="fa fa-heart-o"></i>FAVORITE</div>
                                                        </div>
                                                    </div>
                                                    <div class="bottom-content">
                                                        <div class="ratset-img">
                                                            <div class="rattxt"><i class="fa fa-star" aria-hidden="true"></i> 4.6 (146)</div>
                                                            <div class="volarimg"><img src="/public/img/volar.png"></div>
                                                            <div class="verifiedimg"><img src="/public/images/verified-logo.png"></div>
                                                        </div>
                                                        <h3>Title Classic Pro Style Training Gloves 3.0</h3>
                                                        <h6>1. Volar Mixed Martial Arts</h6>
                                                        <p>New York, USA, 10023</p>
                                                        <hr>
                                                        <a href="#" class="moredetails-btn">More Details</a>
                                                        <p>COMPARE SIMILAR OPTION +</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="item">
                                        <div class="col-md-4 col-sm-6">
                                            <div class="kickboxing-slider-block item">
                                                <div class="kickboxing-block1">
                                                    <div class="topimg-content">
                                                        <img src="/public/img/adult-kickboxing.jpg">
                                                        <div class="sorttext">
                                                            <div class="fromtxt">From #25 - #3000</div>
                                                            <div class="claimedtxt">CLAIMED</div>
                                                            <div class="favoritetxt"><i class="fa fa-heart-o"></i>FAVORITE</div>
                                                        </div>
                                                    </div>
                                                    <div class="bottom-content">
                                                        <div class="ratset-img">
                                                            <div class="rattxt"><i class="fa fa-star" aria-hidden="true"></i> 4.6 (146)</div>
                                                            <div class="volarimg"><img src="/public/img/volar.png"></div>
                                                            <div class="verifiedimg"><img src="/public/images/verified-logo.png"></div>
                                                        </div>
                                                        <h3>Title Classic Pro Style Training Gloves 3.0</h3>
                                                        <h6>1. Volar Mixed Martial Arts</h6>
                                                        <p>New York, USA, 10023</p>
                                                        <hr>
                                                        <a href="#" class="moredetails-btn">More Details</a>
                                                        <p>COMPARE SIMILAR OPTION +</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-sm-6 hidden-xs">
                                            <div class="kickboxing-slider-block item">
                                                <div class="kickboxing-block1">
                                                    <div class="topimg-content">
                                                        <img src="/public/img/adult-kickboxing.jpg">
                                                        <div class="sorttext">
                                                            <div class="fromtxt">From #25 - #3000</div>
                                                            <div class="claimedtxt">CLAIMED</div>
                                                            <div class="favoritetxt"><i class="fa fa-heart-o"></i>FAVORITE</div>
                                                        </div>
                                                    </div>
                                                    <div class="bottom-content">
                                                        <div class="ratset-img">
                                                            <div class="rattxt"><i class="fa fa-star" aria-hidden="true"></i> 4.6 (146)</div>
                                                            <div class="volarimg"><img src="/public/img/volar.png"></div>
                                                            <div class="verifiedimg"><img src="/public/images/verified-logo.png"></div>
                                                        </div>
                                                        <h3>Title Classic Pro Style Training Gloves 3.0</h3>
                                                        <h6>1. Volar Mixed Martial Arts</h6>
                                                        <p>New York, USA, 10023</p>
                                                        <hr>
                                                        <a href="#" class="moredetails-btn">More Details</a>
                                                        <p>COMPARE SIMILAR OPTION +</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-sm-6 hidden-sm hidden-xs">
                                            <div class="kickboxing-slider-block item">
                                                <div class="kickboxing-block1">
                                                    <div class="topimg-content">
                                                        <img src="/public/img/adult-kickboxing.jpg">
                                                        <div class="sorttext">
                                                            <div class="fromtxt">From #25 - #3000</div>
                                                            <div class="claimedtxt">CLAIMED</div>
                                                            <div class="favoritetxt"><i class="fa fa-heart-o"></i>FAVORITE</div>
                                                        </div>
                                                    </div>
                                                    <div class="bottom-content">
                                                        <div class="ratset-img">
                                                            <div class="rattxt"><i class="fa fa-star" aria-hidden="true"></i> 4.6 (146)</div>
                                                            <div class="volarimg"><img src="/public/img/volar.png"></div>
                                                            <div class="verifiedimg"><img src="/public/images/verified-logo.png"></div>
                                                        </div>
                                                        <h3>Title Classic Pro Style Training Gloves 3.0</h3>
                                                        <h6>1. Volar Mixed Martial Arts</h6>
                                                        <p>New York, USA, 10023</p>
                                                        <hr>
                                                        <a href="#" class="moredetails-btn">More Details</a>
                                                        <p>COMPARE SIMILAR OPTION +</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <a class="left carousel-control" href="#carousel-reviews" role="button" data-slide="prev">
                                    <span class="glyphicon glyphicon-chevron-left"></span>
                                </a>
                                <a class="right carousel-control" href="#carousel-reviews" role="button" data-slide="next">
                                    <span class="glyphicon glyphicon-chevron-right"></span>
                                </a>
                            </div>

                            <h5 class="sldertitle">Booking History: Book item again <a href="#">View All</a> </h5>

                            <div class="kickboxing-slider kickboxing-slider1">
                                <h4>No History</h4>
                            </div>

                            <h5 class="sldertitle">Your Save For Later Items <a href="#">View All</a> </h5>

                            <div class="kickboxing-slider kickboxing-slider1">
                                <h4>No History</h4>
                            </div>

                            <hr style="border-bottom:1px solid #000;">

                            <h5 class="sldertitle">Your Recently View Items <a href="#">View All</a> </h5>

                            <div class="kickboxing-slider kickboxing-slider1">
                                <h4>No History</h4>
                            </div>

                            <h5 class="sldertitle">View Similar Items from other providers <a href="#">View All</a> </h5>

                            <div class="kickboxing-slider kickboxing-slider1">
                                <h4>No History</h4>
                            </div>

                        </div>

                    </div>

                </div>
            </div>
        </div>

        <script>
            $(document).ready(function () {
                $(".mapsb .switch .slider").click(function () {
                    $(".kickboxing_map").toggleClass("mapskick");
                    $(".leftside-kickboxing").toggleClass("kicks");
                });
            });

            $(document).ready(function () {
                // Close modal on button click
                $(".addtocart-btn").click(function () {
                    $("#mykickboxing").modal('hide');
                });
            });

            $(document).ready(function () {
                // Close modal on button click
                $(".conti").click(function () {
                    $("#successAddCart").modal('hide');
                });
            });

            $(document).on("click", "i.del", function () {
                // 	to remove card
                $(this).parent().remove();
                // to clear image
                // $(this).parent().find('.imagePreview').css("background-image","url('')");
            });
            
            $(function () {
                $(document).on("change", ".uploadFile", function () {
                    var uploadFile = $(this);
                    var files = !!this.files ? this.files : [];
                    if (!files.length || !window.FileReader)
                        return; // no file selected, or no FileReader support

                    if (/^image/.test(files[0].type)) { // only image file
                        var reader = new FileReader(); // instance of the FileReader
                        reader.readAsDataURL(files[0]); // read the local file

                        reader.onloadend = function () { // set image data as background of div
                            //alert(uploadFile.closest(".upimage").find('.imagePreview').length);
                            uploadFile.closest(".imgUp").find('.imagePreview').css("background-image", "url(" + this.result + ")");
                        }
                    }

                });
            });

            $("#viewmore1").click(function () {
                $("#kickboxing1").addClass("intro");
                $("#viewless1").show();
                $("#viewmore1").hide();
            });
            $("#viewless1").click(function () {
                $("#kickboxing1").removeClass("intro");
                $("#viewless1").hide();
                $("#viewmore1").show();
            });
            $("#viewmore2").click(function () {
                $("#kickboxing2").addClass("intro1");
                $("#viewless2").show();
                $("#viewmore2").hide();
            });
            $("#viewless2").click(function () {
                $("#kickboxing2").removeClass("intro1");
                $("#viewless2").hide();
                $("#viewmore2").show();
            });
            $("#viewmore3").click(function () {
                $("#kickboxing3").addClass("intro2");
                $("#viewless3").show();
                $("#viewmore3").hide();
            });
            $("#viewless3").click(function () {
                $("#kickboxing3").removeClass("intro2");
                $("#viewless3").hide();
                $("#viewmore3").show();
            });

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
