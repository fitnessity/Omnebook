<div class="srch-lction-wrap">
    <div class="search-result-location">
        <div class="container">
            <div class="row">
                <div class="col-md-8 mysrchloc">
                    @foreach($resultnew as $value)
                    @if(($loop->iteration % 2) !=  0)
                    <div class="row">
                        @endif
                        <div class="col-md-6 offset-md-2">
                            <br/>
                            <div class="card profile-card-2">
                                <div class="card-img-block">
                                    @if($value['type'] == 'claimed')
                                    @if(count($value['company_images'])!= 0)
                                    <img class="img-fluid" src="<?php echo Config::get('constants.USER_IMAGE_THUMB') . $value['company_images'][0]; ?>" alt="Card image cap">
                                    @else
                                    <img class="img-fluid" src="{{url('/public/images/')}}/claim-bg.jpeg" alt="Card image cap">
                                    @endif
                                    @else
                                    <img class="img-fluid" src="<?php echo Config::get('constants.FRONT_IMAGE'); ?>business_large_square.png" alt="Card image cap">
                                    @endif
                                </div>
                                <div class="card-body">
                                    @if($value['type'] == 'claimed' && $value['max_price'] != $value['min_price'])
                                    <span class="badge badge-pill badge-light">${{$value['min_price']}} - ${{$value['max_price']}}</span>
                                    @endif
                                    @if($value['type'] == 'claimed' && $value['max_price'] == $value['min_price'])
                                    <span class="badge badge-pill badge-light">${{$value['max_price']}}</span>
                                    @endif
                                    <div class="row on-img-data">
                                        <div class="col-md-5">
                                            <button class="btn btn-danger card-btn" style="cursor:default;">3.7</button>
                                        </div>
                                        <div class="col-md-4 offset-md-3">
                                            <p><i class="fa fa-heart-o" aria-hidden="true"></i> Save</p>
                                        </div>
                                    </div>
                                    @if($value['type'] == 'claimed')
                                    <img  src="<?php echo Config::get('constants.USER_IMAGE_THUMB') . $value['logo']; ?>" alt="profile-image" class="profile"/>
                                    <div class="row">
                                        <div class="col-sm-9" style="margin-left: 45px;">
                                            @if(Auth::check() && Auth::user()->id == $value['user_id'])
                                            <a href="{{url('/pcompany/view/'.$value['id'])}}">
                                            @else
                                            <a href="{{url('/blade-check/'.$value['id'])}}">
                                            @endif 
                                            <h5 class="card-title card-claimed-businessnew" myposition="{{($loop->iteration -1 )}}" company_id="{{$value['id']}}" business_name="{{$value['business_name']}}" logo="{{$value['logo']}}" latitude="{{$value['latitude']}}"  longitude="{{$value['longitude']}}"> {{$loop->iteration}}.  {{$value['business_name']}}</a> <br><span>{{$value['short_description']}}</span></h5>
                                        </div>
                                        <div class="col-sm-3 text-right" style="margin-top: -138px;float: right;margin-right: 14px;"><p class="open-option">Claimed</p></div>
                                    </div>
                                    @else
                                    <img  src="<?php echo Config::get('constants.FRONT_IMAGE'); ?>user.png" alt="profile-image" class="profile"/>
                                    <div class="row">
                                        <div class="col-sm-9" style="margin-left: 45px;">
                                            <a href="{{url('/get-business-detail/'.$value['id'])}}"><h5 class="card-title"> {{$value['business_name']}} <br><span></span></h5></a>
                                        </div>
                                        <div class="col-sm-3 text-right" style="margin-top: -124px;float: right;margin-right: 14px;"><p class="open-option">Unclaimed</p></div>
                                    </div>
                                    @endif
                                    <div class="row show-btn-row">
                                        <div class="col-md-6">
                                            @if($value['type'] == 'claimed')
                                            <p><i class="fa fa-map-marker" aria-hidden="true"></i> {{$value['city']}}</p>
                                            @else
                                            <p><i class="fa fa-map-marker" aria-hidden="true"></i> {{$value['location']}}</p>
                                            @endif
                                        </div>
                                        <div class="col-md-6">
                                            <p>
                                                @if($value['type'] == 'claimed')
                                                <i class="fa fa-phone" aria-hidden="true"></i> {{$value['contact_number']}}
                                                @else
                                                <i class="fa fa-phone" aria-hidden="true"></i> {{$value['phone']}}
                                                @endif
                                            </p>             
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        @if($value['type'] == 'claimed')
                                        <div class="col-md-9 card-footer-left">
                                            <p class="card_para">{{$value['service_name']}}</p>
                                        </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                        @if(($loop->iteration % 2) ==  0 || (($loop->iteration) == count($resultnew)))
                    </div>
                    @endif
                    @endforeach
                    <div>{!! $resultnew->links() !!}</div>
                </div>
                <div class="col-md-2 mysrchmap" style="display:none;position:relative;height:100vh;">
                    <div id="map_canvas" style="position: absolute; top: 0; right: 0; bottom: 0; left: 0;"></div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
$(document).ready(function () {
    var locations = @json($locations);
    console.log(locations.length)
    var map = ''
    var infowindow = ''
    var marker = ''
    var markers = []
    var circle = ''
    $(".card-claimed-businessnew").mouseenter(function () {
        console.log("enter run")
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
        //var infowindow = new google.maps.InfoWindow();
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
        console.log("leave run")
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
        // var infowindow = new google.maps.InfoWindow();
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
            url: "https://fitnessity.co/public/images/hoverout2.png", // url
            scaledSize: new google.maps.Size(50, 50), // size
            labelOrigin: {x: 25, y: 16}
        };
        for (i = 0; i < locations.length; i++) {
            var labelText = i + 1
            marker = new google.maps.Marker({
                // position: new google.maps.LatLng(locations[i][1], locations[i][2]),
                // map: map,
                // icon:icon,
                //  zIndex: .8
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
            console.log(marker.position)
            // bounds.extend(marker.position);
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
            //var labelText = i+1
            //  var myOptionsnew = {
            //     content: labelText
            //     ,boxStyle: {
            //       textAlign: "center"
            //     ,color: "#000000"
            //     ,fontSize: "9pt",
            //     fontWeight:'bold',
            //     marginTop:'-10.5%',
            //     marginLeft:'-.8%',
            //     zIndex:9999999
            //     }
            //     ,disableAutoPan: true
            //     ,position: new google.maps.LatLng(locations[i][1], locations[i][2])
            //     ,closeBoxURL: ""
            //     ,isHidden: false
            //     ,pane: "mapPane"
            //     ,enableEventPropagation: true
            // };

            // var ibLabel = new InfoBox(myOptionsnew);
            // ibLabel.open(map);
            google.maps.event.addListener(marker, 'mouseover', (function (marker, contents, infowindow) {
                return function () {
                    infowindow.setPosition(marker.latLng);
                    infowindow.setContent(contents);
                    infowindow.open(map, this);

                    // ibLabel.setPosition(marker.latLng);
                    // ibLabel.setContent(contents);
                    // ibLabel.open(map,this);
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