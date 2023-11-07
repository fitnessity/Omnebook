<div class="accordion nesting2-accordion custom-accordionwithicon accordion-border-box mt-3" id="addOnService{{$i}}{{$j}}">
    <div class="accordion-item shadow">
        <h2 class="accordion-header" id="acc_nestingaddOn{{$i}}{{$j}}">
            <button class="accordion-custom-btn accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#accor_nestingpriceaddOn{{$i}}{{$j}}" aria-expanded="true" aria-controls="accor_nestingpriceaddOn{{$i}}{{$j}}">
                <div class="container-fluid nopadding">
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-8">
                            Add On Service {{@$addOnService->service_name != '' ? " : ".@$addOnService->service_name :'' }}
                        </div>
                        @if($j!= 0)
                        <div class="col-lg-6 col-md-6 col-4">
                            <div class="priceoptionsettings">
                                <div class="setting-icon">
                                    <i class="ri-more-fill"></i>
                                    <ul id="uladdOn{{$i}}{{$j}}">
                                        <!-- <li class="non-collapsing" data-bs-toggle="collapse" data-bs-target><a onclick=" return add_another_price_duplicate_session({{$i}},{{$j}});"><i class="fas fa-plus text-muted"></i>Duplicate This Price Option Only</a></li> -->
                                       
                                        <li class="dropdown-divider"></li>
                                        <li><a href="" onclick="deleteAddOnService({{$i}},{{$j}})"><i class="ri-delete-bin-fill align-bottom me-2 text-muted"></i>Delete</a></li>
                                      
                                    </ul>
                                </div>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
            </button>
        </h2>
        <div id="accor_nestingpriceaddOn{{$i}}{{$j}}" class="accordion-collapse collapse" aria-labelledby="acc_nestingaddOn{{$i}}{{$j}}" data-bs-parent="#addOnService{{$i}}{{$j}}">
            <div class="accordion-body">
                <input type="hidden" name="add_on_service_id_db_{{$i}}{{$j}}" id="add_on_service_id_db{{$i}}{{$j}}" value="{{@$addOnService->id}}" />
                <div class="row">
                    <div class="col-lg-3 col-md-6">
                        <div class="set-price mb-0">
                            <label>Service Name</label>
                            <input name="service_name_{{$i}}{{$j}}" id="service_name{{$i}}{{$j}}" value ="{{@$addOnService->service_name}}" class="form-control" type="text" placeholder="Enter Name">
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="set-price mb-0">
                            <label>Service Price</label>
                            <input name="service_price_{{$i}}{{$j}}" id="service_price{{$i}}{{$j}}" value="{{@$addOnService->service_price}}" class="form-control" placeholder="Enter Price">
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6">
                        <div class="set-price mb-0">
                            <label>Service Description</label>
                            <textarea class="form-control" id="service_description{{$i}}{{$j}}" name="service_description_{{$i}}{{$j}}" placeholder="Enter description" rows="3" spellcheck="false"  class="form-control" >{{@$addOnService->service_description}}</textarea>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>