@inject('request', 'Illuminate\Http\Request')

@extends('layouts.header')

@section('content')

@include('layouts.cart')

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
    .volarimg img{
        width: 60px;
        height: 60px;
        border-radius: 50%;
        max-width: 100%;
    }
    .kickboxing-block1 .topimg-content {
        height: 190px;
        overflow: hidden;
    }
    .btn-addtocart {
        background-color: #ed1b24;
        color: #fff !important;
        text-transform: uppercase;
        border-radius: 10px;
        border: 1px solid #ed1b24;
        text-align: center;
        font-size:10px;
        font-weight: bold;
    }
    #milesnew {
        -webkit-appearance: none;
        -moz-appearance: none;
        background: transparent;
        background-image: url("data:image/svg+xml;utf8,<svg fill='black' height='24' viewBox='0 0 24 24' width='24' xmlns='http://www.w3.org/2000/svg'><path d='M7 10l5 5 5-5z'/><path d='M0 0h24v24H0z' fill='none'/></svg>");
        background-repeat: no-repeat;
        background-position-x: 100%;
        background-position-y: 13px;
        border: 1px solid #dfdfdf;
        border-radius: 2px;
        margin-right: 2rem;
        padding: 1rem;
        padding-right: 2rem;
        border:0;
    }
    #instantbook {
        -webkit-appearance: none;
        -moz-appearance: none;
        background: transparent;
        background-image: url("data:image/svg+xml;utf8,<svg fill='black' height='24' viewBox='0 0 24 24' width='24' xmlns='http://www.w3.org/2000/svg'><path d='M7 10l5 5 5-5z'/><path d='M0 0h24v24H0z' fill='none'/></svg>");
        background-repeat: no-repeat;
        background-position-x: 100%;
        background-position-y: 13px;
        border: 1px solid #dfdfdf;
        border-radius: 2px;
        margin-right: 2rem;
        padding: 1rem;
        padding-right: 2rem;
        border:0;
    }
</style>
<link rel="stylesheet" href="<?php echo Config::get('constants.FRONT_CSS'); ?>compare/style.css">
<link rel="stylesheet" href="<?php echo Config::get('constants.FRONT_CSS'); ?>compare/w3.css">
<link href="https://code.jquery.com/ui/1.12.1/themes/pepper-grinder/jquery-ui.css" type="text/css" rel="stylesheet" />
<script src="<?php echo Config::get('constants.FRONT_JS'); ?>compare/Compare.js"></script>
<script src="<?php echo Config::get('constants.FRONT_JS'); ?>compare/jquery-1.9.1.min.js"></script>
<script src="{{ url('public/js/jquery-ui.min.js') }}"></script>
<script src="{{ url('public/js/jquery-ui.multidatespicker.js') }}"></script>

<section class="direc-hire" style="margin-top:50px">
    @include('includes.search_location_sidebar')
    
    <div class="direc-right direc-right-new">
        <div class="distance-block">
            
            <?php
            $ZipCode = $Country = "";
            $miles_arr = array('1'=>'1 Mile','3'=>'3 Miles','5'=>'5 Miles','10'=>'10 Miles','15'=>'15 Miles','20'=>'20 Miles');
            ?>
            <select name="distance" id="milesnew">
                <option value="0">Distance (1 Mile)</option>
                <?php foreach($miles_arr as $key=>$value) { ?>
                <option value="<?= $key; ?>"><?php echo $value; ?></option>
                <?php } ?>
            </select>
            
            <select name="instantbook" id="instantbook" style="display:none">
                <option value="">Instant Book</option>
                <option>Instant Hire</option>
                <option>Other</option>
            </select>
            
            <div class="mapsb">Show Maps
                <label class="switch" for="maps">
                    <input type="checkbox" name="maps" id="maps" checked>
                    <span class="slider round"></span>
                </label>
            </div>
            
        </div>
        <div class="col-md-8 leftside-kickboxing">
        	<div class="row">
            <div class="col-md-12" id="buisnessuser">
                @if(count($resultnew) != 0)
                    @foreach($resultnew as $value)
                        @if(($loop->iteration % 2) !=  0)
                        <div class="row">
                        @endif
                       <?php /*?> if company/business<?php */?>
                        @if(@$value['business_name']!="" && @$value['business_name']!= 'undefined')
                            <div class="col-md-6 kickboxing-block1">
                                <div class="topimg-content">
                                    <?php
                                    $companyid = $value['id'];
                                    if (isset($value['company_images'][0]) && ($value['company_images'][0]!="") && File::exists(public_path("/uploads/profile_pic/thumb/" . $value['company_images'][0]))) {
                                        $profilePic = url('/public/uploads/profile_pic/thumb/' . $value['company_images'][0]);
                                    } else {
                                        $profilePic = '/public/images/claim-bg.jpeg';
                                    }
                                    ?>
                                    <img src="{{ $profilePic }}">
                                    <div class="sorttext">
                                        <div class="fromtxt hide">${{@$value['min_price']}} - ${{@$value['max_price']}}</div>
                                        <div class="claimedtxt hide">CLAIMED</div>
                                        <div class="favoritetxt hide"><i class="fa fa-heart-o"></i>FAVORITE</div>
                                    </div>
                                </div>
                                <?php
                                if (@$value['logo']!="" && File::exists(public_path("/uploads/profile_pic/thumb/" . @$value['logo']))) {
                                    $companyLogo = url('/public/uploads/profile_pic/thumb/' . $value['logo']);
                                } else {
                                    $companyLogo = '/public/images/default-avatar.png';
                                }
                                ?>
                                <div class="bottom-content">
                                    <div class="ratset-img">
                                        <div class="rattxt"><!--<i class="fa fa-star" aria-hidden="true"></i> 4.6 (146)--></div>
                                        <div class="volarimg"><img src="{{ $companyLogo }}"></div>
                                        <div class="verifiedimg"><!--<img src="/public/images/verified-logo.png">--></div>
                                    </div>
                                    <h3><?php if(@$value['service_name']!="" && @$value['service_name']!= 'undefined')  echo $value['service_name']; else echo $value['firstname']." ".$value['lastname'];  ?></h3>
                                    <h6 class="card-title card-claimed-businessnew" myposition="{{($loop->iteration -1 )}}" company_id="{{$value['id']}}" business_name="{{$value['business_name']}}" logo="{{$value['logo']}}" latitude="{{$value['latitude']}}" longitude="{{$value['longitude']}}"><a href="/blade-check/<?=$value['id']?>" target="_blank" style="font-size:15px; font-weight:bold; color:red"><?= $value['business_name'] ?></a> </h6>
                                    <p><?= $value['location'] ?></p>
                                    <h5><?= $value['service_name'] ?></h5>
                                    <hr>
                                    <a href="#" class="moredetails-btn" data-toggle="modal" data-target="#mykickboxing<?= $value['id'] ?>">Company Profile</a>
                                    <p>VIEW ALL SERVICES +</p>
                                </div>
                            </div>
                        @else <?php /*?> if personal profile<?php */?>
                        	<div class="col-md-6 kickboxing-block1">
                                <div class="topimg-content">
                                    <?php
                                    $companyid = $value['id'];
                                    if (isset($value['cover_photo'][0]) && ($value['cover_photo'][0]!="") && File::exists(public_path("/uploads/profile_pic/thumb/" . $value['cover_photo'][0]))) {
                                        $profilePic = url('/public/uploads/profile_pic/thumb/' . $value['profile_pic'][0]);
                                    } else {
                                        $profilePic = '/public/images/claim-bg.jpeg';
                                    }
                                    ?>
                                    <img src="{{ $profilePic }}">
                                    <div class="sorttext">
                                        <div class="fromtxt hide"><?php /*?>${{@$value['min_price']}} - ${{@$value['max_price']}}<?php */?></div>
                                        <div class="claimedtxt hide">CLAIMED</div>
                                        <div class="favoritetxt hide"><i class="fa fa-heart-o"></i>FAVORITE</div>
                                    </div>
                                </div>
                                <?php
                                if (@$value['profile_pic']!="" && File::exists(public_path("/uploads/profile_pic/thumb/" . @$value['profile_pic']))) {
                                    $companyLogo = url('/public/uploads/profile_pic/thumb/'.$value['profile_pic']);
                                } else {
                                    $companyLogo = '/public/images/default-avatar.png';
                                }
                                ?>
                                <div class="bottom-content">
                                    <div class="ratset-img">
                                        <div class="rattxt"><!--<i class="fa fa-star" aria-hidden="true"></i> 4.6 (146)--></div>
                                        <div class="volarimg"><img src="{{ $companyLogo }}"></div>
                                        <div class="verifiedimg"><!--<img src="/public/images/verified-logo.png">--></div>
                                    </div>
                                    <h3><?php echo $value['firstname']." ".$value['lastname'];  ?></h3>
                                    <h6 class="card-title card-claimed-businessnew" myposition="{{($loop->iteration -1 )}}" company_id="{{$value['id']}}" business_name="{{$value['username']}}" logo="{{$value['profile_pic']}}" latitude="{{$value['latitude']}}" longitude="{{$value['longitude']}}"><a href="/blade-check/<?=$value['id']?>" target="_blank" style="font-size:15px; font-weight:bold; color:red"><?= $value['username'] ?></a> </h6>
                                    <p><?php echo $value['location'] ?></p>
                                    <h5><?= $value['firstname']." ".$value['lastname'] ?></h5>
                                    <hr>
                                    <a href="#" class="moredetails-btn" data-toggle="modal" data-target="#mykickboxing<?= $value['id'] ?>">Personal Profile</a>
                                    <p>VIEW Profile +</p>
                                </div>
                        	</div>	
                        @endif
                        @if(($loop->iteration % 2) ==  0 || (($loop->iteration) == count($resultnew)))
                        </div>
                        @endif
                        @include('home.view_companyprofile')
                        @endforeach
                        @else
                        <p>No Result Found</p>
                        @endif
                        <div>{!! $resultnew->links() !!}</div>
                {{--@include('jobpost.instanthire_checkout')--}}
                
            </div>
            </div>
        </div>
        
        <div class="col-md-2 kickboxing_map">
            <div class="mysrchmap" style="display:none; position:relative; height:100vh;">
                <div id="map_canvas" style="position: absolute; top: 0; right: 0; bottom: 0; left: 0;"></div>
            </div>
            <div class="maparea hide">
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d24176.251535935986!2d-73.96828678121815!3d40.76133318281456!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x89c258c4d85a0d8d%3A0x11f877ff0b8ffe27!2sRoosevelt%20Island!5e0!3m2!1sen!2sin!4v1620041765199!5m2!1sen!2sin" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
            </div>
        </div>

    </div>
</section>
@include('layouts.footer')

<script>
$(document).ready(function () {
    
    $("#milesnew").on("change", function() {
        
        var distance = $(this).val();
        var zipcode = '<?=$ZipCode?>';
        var country = '<?=$Country?>';
        var searchString = "new delhi";
        
        if(zipcode != '' || country != '') {
        searchString = zipcode + '&amp;' + country;
        } else {
        searchString = ($("#exp_city").val() != "") ? $("#exp_city").val() : "new delhi";
        }
        
        /*
        var mapURL = "https://maps.google.com/maps?width=400&amp;height=300&amp;hl=en&amp;t=&amp;ie=UTF8&amp;iwloc=B&amp;output=embed";
        mapURL += "&amp;q=" + searchString;
        mapURL += "&amp;z=" + distance;

        var frame = '<iframe id="gmap_iframe" src="' + mapURL + '" style="border:0;" allowfullscreen="" loading="lazy"></iframe>';
        $(".maparea").html(frame);
        */
    });
    
    $(".mapsb .switch .slider").click(function () {
        $(".kickboxing_map").toggleClass("mapskick");
        $(".leftside-kickboxing").toggleClass("kicks");
    });
});

$(document).ready(function () {
    // Close modal on button click
    $(".btn-addtocart").click(function () {
        $(".mykickboxing").modal('hide');
    });
});

$(document).ready(function () {
    // Close modal on button click
    $(".conti").click(function () {
        $(".successAddCart").modal('hide');
    });
});

$(document).on("click", "i.del", function () {
    // to remove card
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
<script>
$(document).ready(function () {
    var locations = @json($locations);
    console.log(locations)
    var map = ''
    var infowindow = ''
    var marker = ''
    var markers = []
    var circle = ''
    $(".card-claimed-businessnew").mouseenter(function () {
        markers[parseInt($(this).attr('myposition'))].setMap(null);
        var icon = {
            url: "https://fitnessity.co/public/images/hoverin2.png", // url
            scaledSize: new google.maps.Size(50, 50), // size
            labelOrigin: {x: 25, y: 16}
        };
        marker = new google.maps.Marker({
            position: new google.maps.LatLng($(this).attr('latitude'), $(this).attr('longitude')),
            map: map,
            icon: icon,
            title: ((parseInt($(this).attr('myposition'))) + 1).toString(),
            label: {
                text: ((parseInt($(this).attr('myposition'))) + 1).toString(),
                color: '#222222',
                fontSize: '12px',
                fontWeight: 'bold'
            }
        });

        var img_path = "{{Config::get('constants.USER_IMAGE_THUMB')}}";
        var contents =
                '<div class="card-claimed-business">' +
                '<div class="img-claimed-business">' +
                '<img src=' + img_path + encodeURIComponent($(this).attr('logo')) + ' alt="">' +
                '</div>' +
                '<div class="content-claimed-business">' +
                '<div class="content-claimed-business-inner">' +
                '<div class="content-left-claimed">' +
                '<a href="/pcompany/view/' + $(this).attr('company_id') + '">' + $(this).attr('business_name') + '</a>' +
                '<ul>' +
                '<li class="fill-str"><i class="fa fa-star"></i></li>' +
                '<li class="fill-str"><i class="fa fa-star"></i></li>' +
                '<li class="fill-str"><i class="fa fa-star "></i></li>' +
                '<li><i class="fa fa-star"></i></li>' +
                '<li><i class="fa fa-star"></i></li>' +
                '<li class="count">25</li>' +
                '</ul>' +
                '</div>' +
                '<div class="content-right-claimed"></div>' +
                '</div>' +
                '</div>' +
                '</div>';

        google.maps.event.addListener(marker, 'mouseover', (function (marker, contents, infowindow) {
            return function () {
                infowindow.setPosition(marker.latLng);
                infowindow.setContent(contents);
                infowindow.open(map, this);
            };
        })(marker, contents, infowindow));

        markers[parseInt($(this).attr('myposition'))] = marker;
        var center = new google.maps.LatLng($(this).attr('latitude'), $(this).attr('longitude'));
        map.panTo(center);
    });

    $(".card-claimed-businessnew").mouseleave(function () {
        markers[parseInt($(this).attr('myposition'))].setMap(null);
        var icon = {
            url: "https://fitnessity.co/public/images/hoverout2.png", // url
            scaledSize: new google.maps.Size(50, 50), // size
            labelOrigin: {x: 25, y: 16}
        };
        marker = new google.maps.Marker({
            position: new google.maps.LatLng($(this).attr('latitude'), $(this).attr('longitude')),
            map: map,
            icon: icon,
            title: ((parseInt($(this).attr('myposition'))) + 1).toString(),
            label: {
                text: ((parseInt($(this).attr('myposition'))) + 1).toString(),
                color: '#222222',
                fontSize: '12px',
                fontWeight: 'bold'
            }
        });

        var img_path = "{{Config::get('constants.USER_IMAGE_THUMB')}}";
        var contents =
                '<div class="card-claimed-business">' +
                '<div class="img-claimed-business">' +
                '<img src=' + img_path + encodeURIComponent($(this).attr('logo')) + ' alt="">' +
                '</div>' +
                '<div class="content-claimed-business">' +
                '<div class="content-claimed-business-inner">' +
                '<div class="content-left-claimed">' +
                '<a href="/pcompany/view/' + $(this).attr('company_id') + '">' + $(this).attr('business_name') + '</a>' +
                '<ul>' +
                '<li class="fill-str"><i class="fa fa-star"></i></li>' +
                '<li class="fill-str"><i class="fa fa-star"></i></li>' +
                '<li class="fill-str"><i class="fa fa-star "></i></li>' +
                '<li><i class="fa fa-star"></i></li>' +
                '<li><i class="fa fa-star"></i></li>' +
                '<li class="count">25</li>' +
                '</ul>' +
                '</div>' +
                '<div class="content-right-claimed"></div>' +
                '</div>' +
                '</div>' +
                '</div>';

        google.maps.event.addListener(marker, 'mouseover', (function (marker, contents, infowindow) {
            return function () {
                infowindow.setPosition(marker.latLng);
                infowindow.setContent(contents);
                infowindow.open(map, this);
            };
        })(marker, contents, infowindow));

        markers[parseInt($(this).attr('myposition'))] = marker;
        var center = new google.maps.LatLng($(this).attr('latitude'), $(this).attr('longitude'));
        map.panTo(center);
    });


    $('#map_canvas').empty();
    if (locations.length != 0) {
        map = new google.maps.Map(document.getElementById('map_canvas'), {
            zoom: 13,
            center: new google.maps.LatLng(locations[0][1], locations[0][2]),
            mapTypeId: google.maps.MapTypeId.ROADMAP,
        });
        infowindow = new google.maps.InfoWindow();
        var bounds = new google.maps.LatLngBounds();
        var marker, i;
        var icon = {
            url: "https://fitnessity.co/public/images/hoverout2.png",
            scaledSize: new google.maps.Size(50, 50),
            labelOrigin: {x: 25, y: 16}
        };
        for (i = 0; i < locations.length; i++) {
            var labelText = i + 1
            marker = new google.maps.Marker({
                position: new google.maps.LatLng(locations[i][1], locations[i][2]),
                map: map,
                icon: icon,
                title: labelText.toString(),
                label: {
                    text: labelText.toString(),
                    color: '#222222',
                    fontSize: '12px',
                    fontWeight: 'bold'
                }
            });

            bounds.extend(marker.position);

            var img_path = "{{Config::get('constants.USER_IMAGE_THUMB')}}";
            var contents =
                    '<div class="card-claimed-business">' +
                    '<div class="img-claimed-business">' +
                    '<img src=' + img_path + encodeURIComponent(locations[i][4]) + ' alt="">' +
                    '</div>' +
                    '<div class="content-claimed-business">' +
                    '<div class="content-claimed-business-inner">' +
                    '<div class="content-left-claimed">' +
                    '<a href="/pcompany/view/' + locations[i][3] + '">' + locations[i][0] + '</a>' +
                    '<ul>' +
                    '<li class="fill-str"><i class="fa fa-star"></i></li>' +
                    '<li class="fill-str"><i class="fa fa-star"></i></li>' +
                    '<li class="fill-str"><i class="fa fa-star "></i></li>' +
                    '<li><i class="fa fa-star"></i></li>' +
                    '<li><i class="fa fa-star"></i></li>' +
                    '<li class="count">25</li>' +
                    '</ul>' +
                    '</div>' +
                    '<div class="content-right-claimed"></div>' +
                    '</div>' +
                    '</div>' +
                    '</div>';

            google.maps.event.addListener(marker, 'mouseover', (function (marker, contents, infowindow) {
                return function () {
                    infowindow.setPosition(marker.latLng);
                    infowindow.setContent(contents);
                    infowindow.open(map, this);
                };
            })(marker, contents, infowindow));
            markers.push(marker);
        }

        map.fitBounds(bounds);
        map.panToBounds(bounds);
        $('.mysrchmap').show()
    } else {
        map = new google.maps.Map(document.getElementById('map_canvas'), {
            zoom: 13,
            center: new google.maps.LatLng(40.6976701, -74.2598688),
            mapTypeId: google.maps.MapTypeId.ROADMAP
        });
        $('.mysrchmap').show()
    }
})
</script>
@endsection
<style>
    .mysrchmap{
        position: sticky !important;
        top: 0;
    }
    div#map_canvas{
        width: 200% !important;
    }
    .direc-right ul li{
        padding: 0 !important;
        margin: 30% 5px !important;
        width: auto !important;
    }
    .card-claimed-business .content-left-claimed {
        width: 100% !important;
    }
    .card-claimed-business .content-left-claimed ul{display: inline-flex !important;}
</style>
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