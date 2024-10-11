<div class="col-md-12 col-sm-12 col-xs-12">
    <div class="">
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <label class="mb-10 fw-600">Step: 2 </label> <span class="">Select Schedule</span>
                <select id="selcatpr" name="selcatpr" class="price-select-control"
                    onchange="updatedetail('{{ $companyId }}','{{ $serviceId }}','category',this.value)">
                    @foreach ($categories as $sc)
                        <option value="{{ $sc->id }}" @if ($categoryId == $sc->id) selected @endif>
                            {{ $sc->category_title }}</option>
                    @endforeach
                </select>
                <div class="border-bottom-grey mb-15"></div>

                <label class="mb-10 fw-600">Step: 3 </label> <span class="">Select Price Option</span>
                <div class="priceoption" id="pricechng{{ $serviceId }}{{ $serviceId }}">
                    <select id="selprice" name="selprice" class="price-select-control"
                        onchange="updatedetail('{{ $companyId }}','{{ $serviceId }}','price',this.value)">
                        {!! $priceOption !!}
                    </select>
                </div>
                <div class="border-bottom-grey mb-15"></div>

                <label class="mb-10 fw-600">Step: 4 </label> <span class=""> Select Time</span>
                <div class="row" id="timeschedule">
                    @forelse (@$bschedule as $s=>$bdata)
                        <?php
                        $SpotsLeftdis = 0;
                        $SpotsLeft = App\UserBookingDetail::where('act_schedule_id', $bdata['id'])
                            ->whereDate('bookedtime', '=', date('Y-m-d', strtotime($activityDate)))
                            ->get();
                        $totalquantity = 0;
                        foreach ($SpotsLeft as $data1) {
                            $totalquantity += $data1->userBookingDetailQty();
                        }
                        $SpotsLeftdis = $bdata['spots_available'] != '' ? $bdata['spots_available'] - $totalquantity : 0;
                        $shift_start = $bdata['shift_start'];
                        //$converted_date = date('Y-m-d',strtotime($activityDate));
                        //$st_time = date('Y-m-d H:i:s', strtotime("$converted_date $shift_start"));
                        
                        $start = new DateTime($shift_start);
                        
                        $current = new DateTime();
                        $current_time = $current->format('Y-m-d H:i');
                        
                        $timePassedChk = 0;
                        if (date('Y-m-d', strtotime($activityDate)) == date('Y-m-d')) {
                            if ($service->can_book_after_activity_starts == 'No' && $service->beforetime != '' && $service->beforetimeint != '') {
                                $matchTime = $start->modify('-' . $service->beforetimeint . ' ' . $service->beforetime)->format('Y-m-d H:i');
                                $timePassedChk = $current_time < $matchTime ? 0 : 1;
                            } elseif ($service->can_book_after_activity_starts == 'Yes' && $service->aftertime != '' && $service->aftertimeint != '') {
                                $matchTime = $start->modify('+' . $service->aftertimeint . ' ' . $service->aftertime)->format('Y-m-d H:i');
                                $timePassedChk = $current_time < $matchTime ? 0 : 1;
                            }
                        }
                        
                        $timePassedChk = $SpotsLeftdis == 0 ? 2 : $timePassedChk;
                        ?>
                        <div class="col-md-6 col-sm-4 col-xs-4">
                            <div class="donate-now">
                                <input type="radio" id="{{ $bdata->id }}" name="amount" class="checkbox-option" 
                                    value="{{ $bdata->shift_start }}"
                                    @if ($timePassedChk != 2) onclick="addhiddentime({{ $bdata->id }},'{{ $serviceId }}',{{ $timePassedChk }});" @else disabled @endif
                                    @if ($scheduleId == $bdata->id && $timePassedChk != 2) checked @endif>
                                <label for="{{ $bdata->id }}"
                                    @if ($timePassedChk != 0) class="btn-grey" @endif>{{ date('h:i a', strtotime($bdata->shift_start)) }}</label>
                                <p class="end-hr text-center">
                                    @if ($SpotsLeftdis == 0)
                                        Sold Out
                                    @else
                                        {{ $SpotsLeftdis }}/{{ $bdata->spots_available }} Spots Left.
                                    @endif
                                </p>
                            </div>
                        </div>
                    @empty
                        <p class="notimeoption">No time option available. Select category to view available times</p>
                    @endforelse
                </div>
                <div class="border-bottom-grey mb-15"></div>

                <label class="mb-10 fw-600">Step: 5 </label> <span class=""> Select # of participants</span>
                <div class="live-preview">
                    <div class="accordion" id="parti-default-accordion-example">
                        <div class="accordion-item shadow">
                            <h2 class="accordion-header" id="headingParOne">
                                <button class="accordion-button collapsed fs-14" type="button" data-bs-toggle="collapse" data-bs-target="#collapseParOne" aria-expanded="false" aria-controls="collapseParOne">
                                    Participant
                                </button>
                            </h2>
                            <div id="collapseParOne" class="accordion-collapse collapse" aria-labelledby="headingParOne" data-bs-parent="#parti-default-accordion-example">
                                <div class="accordion-body">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="participant-selection btn-group">
                                                <div class="row">
                                                    <div class="col-md-12 col-xs-12 participateDiv">
                                                        @if (
                                                            ($adultPrice != '' ||
                                                                $adultPrice != 0 ||
                                                                $infantPrice != '' ||
                                                                $infantPrice != 0 ||
                                                                $childPrice != '' ||
                                                                $childPrice != 0) &&
                                                                $timePassedChk == 0)
                                                            @if ($adultPrice != '' || $adultPrice != 0)
                                                                <div class="select">
                                                                    <label class="btn button_select">Adults (Ages 13
                                                                        & Up) </label>
                                                                    <div class="qtyButtons">
                                                                        <div class="qty count-members mt-5">
                                                                            <span
                                                                                class="minus bg-darkbtn adultminus"><i
                                                                                    class="fa fa-minus"></i></span>
                                                                            <input type="text" class="count"
                                                                                name="adultcnt" id="adultcnt"
                                                                                min="0" value="0"
                                                                                readonly="">
                                                                            <span
                                                                                class="plus bg-darkbtn adultplus"><i
                                                                                    class="fa fa-plus"></i></span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            @endif

                                                            @if ($childPrice != '' || $childPrice != 0)
                                                                <div class="select">
                                                                    <label class="btn button_select"
                                                                        for="item_2">Children (Ages 2-12)</label>
                                                                    <div class="qtyButtons">
                                                                        <div class="qty count-members mt-5">
                                                                            <span
                                                                                class="minus bg-darkbtn childminus"><i
                                                                                    class="fa fa-minus"></i></span>
                                                                            <input type="text" class="count"
                                                                                name="childcnt" id="childcnt"
                                                                                min="0" value="0"
                                                                                readonly="">
                                                                            <span
                                                                                class="plus bg-darkbtn childplus"><i
                                                                                    class="fa fa-plus"></i></span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            @endif

                                                            @if ($infantPrice != '' || $infantPrice != 0)
                                                                <div class="select">
                                                                    <label class="btn button_select"
                                                                        for="item_3">Infants (Under 2)</label>
                                                                    <div class="qtyButtons">
                                                                        <div class="qty count-members mt-5">
                                                                            <span
                                                                                class="minus bg-darkbtn infantminus"><i
                                                                                    class="fa fa-minus"></i></span>
                                                                            <input type="text" class="count"
                                                                                name="infantcnt" id="infantcnt"
                                                                                value="0" min="0"
                                                                                readonly="">
                                                                            <span
                                                                                class="plus bg-darkbtn infantplus"><i
                                                                                    class="fa fa-plus"></i></span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            @endif
                                                        @else
                                                            <p>No Participate Available</p>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
               
                <div class="border-bottom-grey mb-15"></div>
                @php 
                    $company_data = null;
                        if (Auth::check()) {
                            $company_data = Auth::user()->current_company;
                        }
                @endphp
                @if(Auth::check() && !empty($company_data))
                <label class="mb-10 fw-600">Step: 6 </label> <span class=""> Select Who's Participating</span>
                <div class="border-bottom-grey mb-15"></div>

                <div class="row" id="participantDiv">
                </div>
                @else
                    <label class="mb-10 fw-600">Step: 6 </label> <span class=""> Select Who's Participating</span>
                    <div class="border-bottom-grey mb-15"></div>
                    <div class="row" id="participantDiv">
                        <p class="text-center font-red mb-15">Login to select who's participating now or select in the cart.</p>
                    </div>
                @endif

                <label class="mb-10 fw-600">Step: 7 </label> <span class=""> Select Add-On Service (Optional)</span>
                <div class="live-preview">
                    <div class="accordion" id="Adddefault-accordion-example">
                        <div class="accordion-item shadow">
                            <h2 class="accordion-header" id="headingAddOne">
                                <button class="accordion-button collapsed fs-14" type="button" data-bs-toggle="collapse" data-bs-target="#collapseAddOne" aria-expanded="false" aria-controls="collapseAddOne">
                                    Add-On Services
                                </button>
                            </h2>
                            <div id="collapseAddOne" class="accordion-collapse collapse" aria-labelledby="headingAddOne" data-bs-parent="#Adddefault-accordion-example">
                                <div class="accordion-body">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="add-onservice btn-group">
                                                <div class="row">
                                                    <div class="col-md-12 col-xs-12">
                                                        @forelse($addOnServices as $aos)
                                                            <div class="select">
                                                                <label class="btn button_select" for="item_4">
                                                                    <div class="row">
                                                                        <div class="col-md-6">
                                                                            {{ $aos->service_name }}
                                                                            <a class="single-service-price d-grid font-red service-desc"
                                                                                data-behavior="ajax_html_modal"
                                                                                data-url="{{ route('getAddOnData', ['id' => $aos->id]) }}">Description</a>
                                                                        </div>
                                                                        <div class="col-md-6">
                                                                            <span
                                                                                class="single-service-price">${{ $aos->service_price }}</span>
                                                                        </div>
                                                                    </div>
                                                                </label>
                                                                <div class="qtyButtons">
                                                                    <div class="qty count-members mt-5">
                                                                        <span class="minus bg-darkbtn addonminus"
                                                                            aid="{{ $aos->id }}"><i
                                                                                class="fa fa-minus"></i></span>
                                                                        <input type="text" class="count"
                                                                            name="add-one"
                                                                            id="add-one{{ $aos->id }}"
                                                                            min="0" value="0"
                                                                            readonly=""
                                                                            apirce="{{ $aos->service_price }}">
                                                                        <span class="plus bg-darkbtn addonplus"
                                                                            aid="{{ $aos->id }}"><i
                                                                                class="fa fa-plus"></i></span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        @empty
                                                            <p>Not Available</p>
                                                        @endforelse
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-6 col-sm-6 col-xs-6 col-6">
        <div class="booking-summery mt-15">
            <a onclick="getUrl({{ $priceId }},{{ @$bschedulefirst->id }});" class="font-red" data-bs-toggle="modal" data-bs-target="#ajax_html_modal">Booking Summary
            </a>
            <div class="d-none hiddenALink"></div>
        </div>
    </div>
    <div class="col-md-6 col-sm-6 col-xs-6 col-6">
        <div class="book0total-price mt-15">
            <label>Total Price </label>
        </div>
        <div class="book0total-price">
            <span id="textPrice">$0 USD</span>
        </div>
    </div>
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="text-right mt-10">
            <div id="cartadd">
                <input type="hidden" id="maxQty" value="{{ $maxSports }}">
                <input type="hidden" id="totalQty" value="0">
                <input type="hidden" id="adultDiscountPrice" value="{{ $adultDiscountPrice }}" />
                <input type="hidden" id="childDiscountPrice" value="{{ $childDiscountPrice }}" />
                <input type="hidden" id="infantDiscountPrice" value="{{ $infantDiscountPrice }}" />
                <form method="post" id="addtocartform">
                    @csrf
                    <input type="hidden" name="pid" value="{{ $serviceId }}" />
                    <input type="hidden" name="quantity" id="pricequantity" value="1" />
                    <input type="hidden" name="aduquantity" id="adultCount" value="0" />
                    <input type="hidden" name="childquantity" id="childCount" value="0" />
                    <input type="hidden" name="infantquantity" id="infantCount" value="0" />

                    <input type="hidden" name="cartaduprice" id="adultPrice" value="{{ $adultPrice }}" />
                    <input type="hidden" name="cartchildprice" id="childPrice" value="{{ $childPrice }}" />
                    <input type="hidden" name="cartinfantprice" id="infantPrice" value="{{ $infantPrice }}" />

                    <input type="hidden" name="pricetotal" id="priceTotal" value="0" />
                    <input type="hidden" name="price" id="price" value="0" />
                    <input type="hidden" name="session" id="session" value="{{ $paySession }}" />
                    <input type="hidden" name="priceid" value="{{ $priceId }}" id="priceid" />
                    <input type="hidden" name="actscheduleid" value="{{ $scheduleId }}" id="actscheduleid" />
                    <input type="hidden" name="timechk" value="{{ $timeChk }}" id="timechk" />
                    <input type="hidden" name="sesdate" value="{{ date('Y-m-d', strtotime($activityDate)) }}"
                        id="sesdate" />
                    <input type="hidden" name="cate_title" id="cate_title" value="{{ $categoryId }}"
                        id="categoryTitle" />
                    <input type="hidden" name="categoryid" id="categoryid" value="{{ $categoryId }}"
                        id="categoryId" />
                    <input type="hidden" name="addOnServicesId" value="" id="addOnServicesId" />
                    <input type="hidden" name="addOnServicesQty" value="" id="addOnServicesQty" />
                    <input type="hidden" name="addOnServicesTotalPrice" value="0"
                        id="addOnServicesTotalPrice" />
                    <input type="hidden" name="totalcnt" value="0" id="totalcnt" />
                    <input type="hidden" name="totparticipate" value="" id="totparticipate" />

                    <div id="addcartdiv">
                        <button type="button" id="btnaddcart" class="btn btn-red"  data-bs-toggle="modal" data-bs-target="#confirmredirection">Purchase</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

</div>
{{-- my code starts from here --}}


<div class="modal fade in newparticipant" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" role="dialog">
    <div class="modal-dialog modal-dialog-centered mw-70">
        <div class="modal-content">
            <div class="modal-header p-3">
                <h5 class="modal-title" id="exampleModalLabel">Add Family or Friends</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                    id="close-modal"></button>
            </div>
            <form action="{{ route('personal.manage-accountfu')}}" method="post">
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-4 col-md-4 col-sm-6">
                            <div class="photo-select product-edit user-dash-img mb-10">
                                <input type="hidden" name="old_pic" value="">
                                <img src="{{ '/images/service-nofound.jpg' }}" class="pro_card_img blah"
                                    id="showimg">
                                <input type="file" id="profile_pic" name="profile_pic" class="text-center fs-12 mt-25">
                            </div>
                        </div>
                        <div class="col-lg-8 col-md-8 fs-12">
                            <div class="row">
                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6">
                                    <div class="form-group mb-10">
                                        @php 
                                             if (Auth::check()) {
                                            $company_data=Auth::user()->current_company;
                                             }
                                        @endphp
                                        @if(!empty($company_data))
                                            <input type="hidden" name="business_id" value="{{$company_data->id}}">
                                        @endif
                                        <label>First Name</label>
                                        <input type="text" name="fname" class="form-control fs-12"
                                            required="required" value="">
                                    </div>
                                </div>
                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6">
                                    <div class="form-group mb-10">
                                        <label>Last Name</label>
                                        <input type="text" name="lname" id="lname"
                                            class="form-control fs-12" required="required" value="">
                                    </div>
                                </div>
                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6">
                                    <div class="form-group mb-10">
                                        <label>Gender</label>
                                        <select name="gender" id="gender" class="form-select fs-12"
                                            required="required">
                                            <option value="" hidden="">Select Gender</option>
                                            <option value="Male">Male</option>
                                            <option value="Female">Female</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6">
                                    <div class="form-group mb-10">
                                        <label>Email</label>
                                        <input type="email" name="email" id="email"
                                            class="form-control fs-12" value="" required="required">
                                    </div>
                                </div>
                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6">
                                    <div class="form-group mb-10">
                                        <label>Relationship</label>
                                        <select name="relationship" id="relationship" class="form-select fs-12"
                                            required="required">
                                            <option value="" hidden="">Select Relationship</option>
                                            <option value="Brother">Brother</option>
                                            <option value="Sister">Sister</option>
                                            <option value="Father">Father</option>
                                            <option value="Mother">Mother</option>
                                            <option value="Wife">Wife</option>
                                            <option value="Husband">Husband</option>
                                            <option value="Son">Son</option>
                                            <option value="Daughter">Daughter</option>
                                            <option value="Friend">Friend</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6">
                                    <div class="form-group mb-10">
                                        <label>Birth date</label>
                                        <input type="text" class="fs-12 form-control flatpickr-input"
                                            name="birthdate" id="birthdate" readonly="readonly">
                                    </div>
                                </div>
                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6">
                                    <div class="form-group mb-10">
                                        <label>Mobile Number</label>
                                        <input type="text" name="mobile" id="mobile"
                                            class="form-control fs-12" value="" data-behavior="text-phone"
                                            maxlength="14">
                                    </div>
                                </div>
                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6">
                                    <div class="form-group mb-10">
                                        <label>Emergency Contact Number</label>
                                        <input type="text" name="emergency_contact" id="emergency_contact"
                                            class="form-control fs-12" maxlength="14" value=""
                                            data-behavior="text-phone">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="hstack gap-2 justify-content-end">
                        <button type="submit" id="btn_family" class="btn-cart-checkout fs-12">Submit</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
{{-- ends --}}
<script>
    flatpickr('.flatpickr-input', {
        dateFormat: "m-d-Y",
        maxDate: "today",
    });
</script>

<script type="text/javascript">
    function getUrl(pid, sid) {
        $('.hiddenALink').html('');
        // alert('11');
        var adultCount = $('#adultCount').val();
        var childCount = $('#childCount').val();
        var infantCount = $('#infantCount').val();
        var aosId = $('#addOnServicesId').val();
        var aosQty = $('#addOnServicesQty').val();
        var aosPrice = $('#addOnServicesTotalPrice').val();
        // my code start
        var participantValues = [];
        $('.familypart').each(function() {
            var value = $(this).val();
            if (value) {
                if (Array.isArray(value)) {
                    participantValues = participantValues.concat(value);
                } else {
                    participantValues.push(value);
                }
            }
        });

        var participants = participantValues.join(',');
        // alert(participants);

        // ends

        // if (sid != undefined) {
        //     var url = "/getBookingSummary/?priceId=" + pid + "&schedule=" + sid + "&adultCount=" + adultCount +
        //         "&childCount=" + childCount + "&infantCount=" + infantCount + "&date=" +
        //         "{{ $date->format('Y-m-d') }}" + "&aosPrice=" + aosPrice + "&aosId=" + aosId + "&aosQty=" + aosQty;
        //     $('.hiddenALink').html('<a data-behavior="ajax_html_modal" data-url="' + url + '" id="hiddenALink"></a>');
        //     $('#hiddenALink')[0].click();
        // }
        // my code starts
        if (sid != undefined) {
            var url = "/getBookingSummary/?priceId=" + pid + "&schedule=" + sid + "&adultCount=" + adultCount +
                "&childCount=" + childCount + "&infantCount=" + infantCount + "&date=" +
                "{{ $date->format('Y-m-d') }}" + "&aosPrice=" + aosPrice + "&aosId=" + aosId + "&aosQty=" + aosQty +
                "&participants=" + participants; // Append participants to the URL
            $('.hiddenALink').html('<a data-bs-toggle="modal" data-bs-target="#ajax_html_modal" data-behavior="ajax_html_modal" data-url="' + url + '" id="hiddenALink"></a>');
            $('#hiddenALink')[0].click();
        }
        // ends
    }
</script>

