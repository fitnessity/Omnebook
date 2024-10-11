@if(@count($myservice) > 0)
                <?php $service_index = 0; ?>
                @foreach($myservice as $serv)
                    <?php $service_index++; ?>
                    <div id="service_{{$service_index}}">
                           <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                            <div class="services-list">
                                <a href="javascript:editService({{$serv->id}})" class="decoration-none">
                                    <span class=""><i class="fa fa-briefcase"></i></span>
                                </a>
                                <div class="clearfix"></div>
                                <h3>
                                    <input type="hidden" name="servicesport[]" value="{{ $serv->sport }}" title="servicesport">
                                    <!-- <a href="javascript:editService({{$serv->id}})" class="decoration-none"> -->
                                        <span class="display_servicesport"> {{ @$sport_dd[$serv->sport] }} </span>
                                    <!-- </a> -->

                                    <a href="javascript:deleteRow('service_{{$service_index}}')" class="delete_icon" title="Delete this Service" disabled><i class="fa fa-trash"></i></a>

                                    <a href="javascript:editService({{$serv->id}})" title="Edit this Service" class="delete_icon"  style="padding-right: 7px;"><i class="fa fa-pencil"></i></a>
                                </h3>
                                <div class="clearfix"></div>
                                <input type="hidden" name="servicetitle[]" value="{{ $serv->title }}" title="servicetitle">

                                <p class="display_servicetitle"><strong> {{ $serv->title }} ({{ $serv->price }})</strong></p>
                                <div class="clearfix"></div>
                                <input type="hidden" name="serviceprice[]" value="{{ $serv->price }}" title="serviceprice">
                                <div class="clearfix"></div>
                                <input type="hidden" name="servicedesc[]" value="{{ $serv->servicedesc }}" title="servicedesc">
                                <p class="display_servicedesc">{{ substr($serv->servicedesc, 0,20) }}...</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            @endif