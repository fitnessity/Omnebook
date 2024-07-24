@inject('request', 'Illuminate\Http\Request')
@extends('layouts.business.header')
@section('content')
@include('layouts.business.new-header')
    <div class="page-content-home">
        <div class="container-fuild">
            <div class="bg-cover home-banner-title" style="background-image: url({{ asset('public/uploads/cms/'.@$topBanner->banner_image) }});">
                <div class="pro-background-overlay-banner"></div>
                <div class="container">
                    <div class="row">
                        <div class="col-xxl-9 col-lg-9 col-md-12">
                            <div class="fit-widget-container-banner">
                                <label class="fs-65 mb-15">{!!@$topBanner->content_title!!}</label>
                                {!!@$topBanner->content!!}
                            </div>
                            <div class="mt-25">
                                <div class="searchwrapper shadow">
                                    <form id="searchform" method="get" action="/activities/">
                                        <div class="searchbox">
                                            <div class="row">
                                                <div class="col-lg-6 col-sm-12 col-md-6 col-12">
                                                    <input name="label" id="activity_label" type="text" class="form-control padding-lrtb-one" placeholder="Search by Activity, Business, Person, Username">
                                                    <div id="suggesstion-box-search-activity"></div>
                                                </div>
                                                <div class="col-lg-4 col-sm-12 col-md-4 col-12">
                                                    <input name="address"  id="b_address1" type="text" class="form-control no-side-border padding-lrtb" placeholder="Search by country, city, state, zip" oninput="initMapCall1()" value="">
                                                    <div id="map" class="d-none p-relative" style="overflow: hidden;"></div>
                                                    <div id="suggesstion-box-search-location"></div>
                                                    <input type="hidden"  name="city" id="b_city1" value="">
                                                    <input type="hidden"  name="state" id="b_state1" value="">
                                                    <input type="hidden"  name="country" id="country1" value="">
                                                    <input type="hidden"  name="zip_code" id="b_zipcode1" value="">
                                                </div>
                                                <div class="col-lg-2 col-sm-12 col-md-2 col-12">
                                                    <button type="submit" class="btn btn-red" class="form-control"><i class="fa fa-search livesearch"></i>Search</button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>          
            </div>
        </div>

        <div class="bg-grey hpt-100 hpb-100">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="home-main-title mb-30">
                            <h2>View All Activities</h2>
                        </div>
                    </div>  
                    
                    @php $asi=0; @endphp
                    @foreach($activitySlider as $i=>$sldr)
                        @php if($i == 5){
                                $asi = 0;
                            }
                        @endphp
                        <div class=" @if($asi == 0) col-lg-6 col-md-6 @else col-lg-3 col-md-3 @endif col-sm-6 col-xs-12 col-12 ">
                            <div class="taxonomy-item taxonomy-card">
                                <a class="taxonomy-link hover-effect" href="{{env('APP_URL')}}{{@$sldr['link']}}">
                                    <div class="taxonomy-title">{{@$sldr['title']}} </div>
                                    <img class="img-responsive" src="{{asset('uploads/slider/thumb/'.@$sldr['image'])}}" alt="Fitnessity" loading="lazy">
                                </a>
                            </div>
                        </div>
                        @php $asi++; @endphp
                    @endforeach
                    
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 col-12 text-center">
                        <a href="{{url('/activities')}}" class="btn btn-red fs-15 btn-w-130 mt-30">Find More</a>
                    </div>
                    
                </div>
            </div>
        </div>

        <div class="hpb-100">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12 col-xs-12 nopadding">
                        @include('includes.next_8_hours_home') 
                    </div>
                </div>
            </div>
        </div>
        
        <div class="bg-grey hpt-100 hpb-100">
            <div class="container">
                <div class="row justify-content-md-center">
                    <div class="col-lg-12">
                        <div class="home-main-title mb-30">
                            <h2>Discover Our Top Destinations</h2>
                        </div>
                    </div>      
                    
                    @foreach($top4Cities as $city)
                        <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                            <div class="taxonomy-item taxonomy-item-v2">
                                <div class="taxonomy-item-image">
                                    <a class="taxonomy-link hover-effect" href="/activities/?city={{$city}}">
                                        <img class="img-responsive" src="{{asset('uploads/slider/thumb/1646834734-ACTIVITES BACKGROUND.jpg')}}" alt="Fitnessity" loading="lazy">
                                    </a>    
                                </div>
                                <div class="taxonomy-item-content">
                                    <h3 class="taxonomy-title">
                                        <a href="/activities/?city={{$city}}">{{$city}}</a>
                                        <a href="/activities/?country={{countryName($city)}}">{{countryName($city)}}</a>
                                    </h3>
                                    <div class="taxonomy-description">{{cityCount($city)}} Activities</div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                    
                </div>
            </div>
        </div>
        
        @if($whyFitnessity)
        <div class="hpt-100 hpb-100">
            <div class="container">
                <div class="row">
                    <div class="col-lg-4">
                        @if($bepart_data)
                            <div class="">
                                <div class="join-title mb-5">
                                    <h1>{!! $bepart_data->content_title !!}</h1>
                                </div>
                                <div class="join-box-text mb-25">
                                    {!!$bepart_data->content!!}

                                    @if(Auth::check())
                                        <a class="btn btn-red" href="/activities">START TODAY</a>
                                    @else
                                        <a href="{{route('registration')}}" class="btn btn-red">START TODAY</a>
                                    @endif
                                </div>
                            </div>
                        @endif
                    </div>


                    <div class="col-lg-8 hpl-50">
                        <div class="amazonaws mb-10">
                            <img src="{{ asset('public/uploads/cms/'.$whyFitnessity->banner_image) }}" alt="Fitnessity" loading="lazy">
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="info-imgs">
                            <img src="{{ asset('public/'.$whyFitnessity->video) }}" alt="Fitnessity" loading="lazy">
                        </div>
                    </div>
                    <div class="col-lg-8 hpl-50">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="fitness-title mb-5 mt-10">
                                    <h1>{!! $whyFitnessity->content_title !!}</h1>
                                </div>
                            </div>
                                
                            {!!$whyFitnessity->content!!}

                            <div class="col-lg-12">
                                <div class="text-center">
                                    @if(Auth::check())
                                        <a class="btn btn-red" href="/activities">Join Today</a>
                                    @else
                                        <a class="btn btn-red" href="{{route('registration')}}">Join Today</a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endif
        
        <div class="bg-grey hpt-100 hpb-100">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="home-main-title mb-30">
                            <h2>Discover Activities</h2>
                            <p> Get connected to Activities you love or explore a new one</p>
                        </div>
                    </div>

                    @foreach($sliders as $slider)
                        <div class="col-lg-3 col-sm-6 col-md-6">
                            <div class="fit-project-item mb-30">
                                <a href="{{$slider->link}}">
                                    <div class="project-img">
                                        <img src="{{asset('/public/uploads/slider/thumb/'.$slider->image)}}" alt="Fitnessity" loading="lazy">
                                        <div class="discover-title">
                                            <h2>{{$slider->title}}</h2>
                                        </div>
                                    </div>
                                    <div class="project-content"> 
                                        <div class="project-inner">
                                            <span class="category">{{$slider->stext}} </span>
                                        </div>
                                    </div>
                                </a>
                            </div>                      
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

        @if($connectBusiness)
            <div class="hpt-100 hpb-100 ">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="providers-bg-image" style="background-image: url('public/uploads/cms/{{@$connectBusiness->banner_image}}');">
                                <div class="pro-background-overlay"></div>
                                <div class="fit-widget-container">
                                    <h2>{!!@ $connectBusiness->content_title !!}</h2>
                                     {!!@$connectBusiness->content!!}
                                    <div>
                                        <a href="{{route('businessClaim')}}" class="btn btn-border-white btn-w-180 fs-15 mb-10">List My Business</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif
   
    </div><!-- End Page-content -->
</div><!-- END layout-wrapper -->

@include('layouts.business.footer')

<script type="text/javascript">
    $("#activity_label").keyup(function(){
        var _token = $('input[name="_token"]').val();
        $.ajax({
            type: "POST",
            url: "/searchactionactivity",
            data:{query:$(this).val(), _token:'{{csrf_token()}}'},
            beforeSend: function(){
                //$("#label").css("background","#FFF url(LoaderIcon.gif) no-repeat 165px");
            },
            success: function(data){ 
                $("#suggesstion-box-search-activity").show();
                $("#suggesstion-box-search-activity").html(data);
            }
        });
    });

    $(document).on('click', '.searchclickactivity', function(){
        $("#activity_label").val($(this).attr('data-num'));
        $("#suggesstion-box-search-activity").hide();
    });

     function initMapCall1() {
        $('#activity_label').val('');
        $('#b_city1').val('');
        $('#b_state1').val('');
        $('#country1').val('');
        $('#b_zipcode1').val('');
        var map = new google.maps.Map(document.getElementById('map'), {
            center: {lat: -33.8688, lng: 151.2195},
            zoom: 13
        });

        var input = document.getElementById('b_address1');
        map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);
        var autocomplete = new google.maps.places.Autocomplete(input);
        autocomplete.bindTo('bounds', map);
        var infowindow = new google.maps.InfoWindow();
        var marker = new google.maps.Marker({
            map: map,
            anchorPoint: new google.maps.Point(0, -29)
        });

        autocomplete.addListener('place_changed', function() {
            infowindow.close();
            marker.setVisible(false);
            var place = autocomplete.getPlace();
            if (!place.geometry) {
                window.alert("Autocomplete's returned place contains no geometry");
                return;
            }

            // If the place has a geometry, then present it on a map.
            if (place.geometry.viewport) {
                map.fitBounds(place.geometry.viewport);
            } else {
                map.setCenter(place.geometry.location);
                map.setZoom(17);
            }

            marker.setIcon(({
                url: place.icon,
                size: new google.maps.Size(71, 71),
                origin: new google.maps.Point(0, 0),
                anchor: new google.maps.Point(17, 34),
                scaledSize: new google.maps.Size(35, 35)
            }));

            marker.setPosition(place.geometry.location);
            marker.setVisible(true);
            var address = '';
            var badd = '';
            var sublocality_level_1 = '';
            if (place.address_components) {
                address = [
                  (place.address_components[0] && place.address_components[0].short_name || ''),
                  (place.address_components[1] && place.address_components[1].short_name || ''),
                  (place.address_components[2] && place.address_components[2].short_name || '')
                ].join(' ');
            }

            infowindow.setContent('<div><strong>' + place.name + '</strong><br>' + address);
            infowindow.open(map, marker);

            // Location details
            for (var i = 0; i < place.address_components.length; i++) {
              //alert(place.address_components[i].types[0]);
                if(place.address_components[i].types[0] == 'locality'){
                    $('#b_city1').val(place.address_components[i].long_name);
                }
                if(place.address_components[i].types[0] == 'country'){
                    $('#country1').val(place.address_components[i].long_name);
                }
                if(place.address_components[i].types[0] == 'administrative_area_level_1'){
                  $('#b_state1').val(place.address_components[i].long_name);
                }
                if(place.address_components[i].types[0] == 'postal_code'){
                  $('#b_zipcode1').val(place.address_components[i].long_name);
                }
            }
        });
    }

</script>
@endsection